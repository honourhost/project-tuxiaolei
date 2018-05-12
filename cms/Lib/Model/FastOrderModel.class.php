<?php
class FastOrderModel extends Model{
	//生成订单
	public function save_post_form($fastinfo,$user){

		$data_fast_order['mer_id'] = $fastinfo['mer_id'];
		

		$data_fast_order['order_name'] = $fastinfo['s_name'];
		$data_fast_order['price'] = $fastinfo['price'];
		$data_fast_order['total_money'] = $fastinfo['price'];

		$data_fast_order['add_time'] = $_SERVER['REQUEST_TIME'];
		$data_fast_order['openid'] = $user['openid'];
		$data_fast_order['uid'] = $user['uid'];
		$data_fast_order['submit_order_time'] = time();
		
		if($order_id = $this->data($data_fast_order)->add()){
				$data_fast_order['order_id']=$order_id;
				return array('error'=>0,'msg'=>'订单产生成功！','order_info'=>$data_fast_order);
			}else{
				print_r($this->getLastSql());die;
				return array('error'=>1,'msg'=>'订单产生失败！请重试');
		}
	}
	
	public function get_order_by_id($uid,$order_id){
		$condition_group_order['order_id'] = $order_id;
		$condition_group_order['uid'] = $uid;
		return $this->field(true)->where($condition_group_order)->find();
	}
	
	//支付之后
	public function after_pay($order_param){
		unset($_SESSION['group_order']);
		$condition_fast_order['order_id'] = $order_param['order_id'];
		$now_order = $this->field(true)->where($condition_fast_order)->find();
		if(empty($now_order)){
			return array('error'=>1,'msg'=>'当前订单不存在！');
		}else if($now_order['paid'] == 1){
			if($order_param['is_mobile']){
				return array('error'=>1,'msg'=>'该订单已付款！');
			}else{
				return array('error'=>1,'msg'=>'该订单已付款！');
			}
		}else{
			//得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
			$now_user = D('User')->get_user($now_order['uid']);
			if(empty($now_user)){
				return array('error'=>1,'msg'=>'没有查找到此订单归属的用户，请联系管理员！');
			}
			$condition_fast_order['order_id'] = $order_param['order_id'];
			
			$data_group_order['pay_time'] = $_SERVER['REQUEST_TIME'];
			$data_group_order['payment_money'] = floatval($order_param['pay_money']);
			$data_group_order['pay_type'] = $order_param['pay_type'];
			$data_group_order['third_id'] = $order_param['third_id'];
			$data_group_order['is_mobile_pay'] = $order_param['is_mobile'];
			$data_group_order['paid'] = 1;
			$data_group_order['last_time'] = time();
			$data_group_order['status'] = 1;
			//开启事务
			$this->startTrans();
			if($this->where($condition_fast_order)->data($data_group_order)->save()){
				$this->commit();
				/* 粉丝行为分析 */
				D('Merchant_request')->add_request($now_order['mer_id'],array('group_buy_count'=>$now_order['num'],'group_buy_money'=>$now_order['total_money']));

                if ($now_user['openid'] && $order_param['is_mobile']) {
                    $href = C('config.site_url').'/wap.php';
                    $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));

                    $model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => '快捷付款支付提醒', 'keyword1' => $now_order['order_name'], 'keyword2' => $now_order['order_id'], 'keyword3' => $now_order['total_money'], 'remark' => '支付成功！'));

                }
				$sms_data = array('mer_id' => $now_order['mer_id'], 'store_id' => 0, 'type' => 'fastorder');
				if (C('config.sms_success_order') == 2 || C('config.sms_success_order') == 3) {
					$merchant = D('Merchant')->where(array('mer_id' => $now_order['mer_id']))->find();
					$sms_data['uid'] = 0;
					$sms_data['mobile'] = $merchant["phone"];
					$sms_data['sendto'] = 'merchant';
					$sms_data['content'] = '顾客购买的' . $now_order['order_name'] . '的订单(订单号：' . $now_order['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已经完成了支付！金额'.$now_order['price']."元";
					Sms::sendSms($sms_data);
				}
				
				if($order_param['is_mobile']){
					return array('error'=>0,'url'=>str_replace('/source/','/',U('My/group_order',array('order_id'=>$now_order['order_id']))));
				}else{
					return array('error'=>0,'url'=>U('User/Index/group_order_view',array('order_id'=>$now_order['order_id'])));
				}
			}else{
				$this->rollback();
				return array('error'=>1,'msg'=>'修改订单状态失败，请联系系统管理员！');
			}
		}
	}

	
	/*获得订单链接*/
	public function get_order_url($order_id,$is_wap=false){
		if($is_wap){
			return U('My/group_order',array('order_id'=>$order_id));
		}else{
			return U('User/Index/group_order_view',array('order_id'=>$order_id));
		}
	}
	

	public function get_group_url($group_id,$is_wap){
		if($is_wap){
			return U('Wap/Group/detail',array('group_id'=>$group_id));
		}else{
			return C('config.site_url').'/group/'.$group_id.'.html';
		}
	}


    public function get_all_oreder_sum($type = 'day'){

        $stime = $etime = 0;
        switch ($type) {
            case 'day' :
                $stime = strtotime(date("Y-m-d") . " 00:00:00");
                $etime = strtotime(date("Y-m-d") . " 23:59:59");
                break;
            case 'week' :
                $d = date("w");
                $stime = strtotime(date("Y-m-d") . " 00:00:00") - $d * 86400;
                $etime = strtotime(date("Y-m-d") . " 23:59:59") + (6 - $d) * 86400;
                break;
            case 'month' :
                $stime = mktime(0, 0, 0, date("m"), 1, date("Y"));
                $etime = mktime(0, 0, 0, date("m") + 1, 1, date("Y"));
                break;
            case 'year' :
                $stime = mktime(0, 0, 0, 1, 1, date("Y"));
                $etime = mktime(0, 0, 0, 1, 1, date("Y")+1);
                break;
            default :;
        }
        $total = $this->field('sum(payment_money) as totalmoney')->where("`paid`=1 AND `add_time`>'$stime' AND `add_time`<'$etime'")->select();
        return $total[0]["totalmoney"];

    }


    //获取某个时间段的订单总数
    public function get_all_oreder_count($type = 'day'){
        $stime = $etime = 0;
        switch ($type) {
            case 'day' :
                $stime = strtotime(date("Y-m-d") . " 00:00:00");
                $etime = strtotime(date("Y-m-d") . " 23:59:59");
                break;
            case 'week' :
                $d = date("w");
                $stime = strtotime(date("Y-m-d") . " 00:00:00") - $d * 86400;
                $etime = strtotime(date("Y-m-d") . " 23:59:59") + (6 - $d) * 86400;
                break;
            case 'month' :
                $stime = mktime(0, 0, 0, date("m"), 1, date("Y"));
                $etime = mktime(0, 0, 0, date("m") + 1, 1, date("Y"));
                break;
            case 'year' :
                $stime = mktime(0, 0, 0, 1, 1, date("Y"));
                $etime = mktime(0, 0, 0, 1, 1, date("Y")+1);
                break;
            default :;
        }
        $total = $this->where("`paid`=1 AND `add_time`>'$stime' AND `add_time`<'$etime'")->count();
        return $total;
    }

}
?>