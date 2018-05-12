<?php
class Group_orderModel extends Model{
	public function save_post_form($group,$uid,$order_id){
		$data_group_order['group_id'] = $group['group_id'];
		$data_group_order['mer_id'] = $group['mer_id'];
		
		$data_group_order['num'] = intval($_POST['quantity']);

		if(empty($data_group_order['num'])){
			return array('error'=>1,'msg'=>'请输入正确的购买数量！');
		}else if($data_group_order['num'] < $group['once_min']){
			return array('error'=>1,'msg'=>'您最少需要购买'.$group['once_min'].'单！');
		}else if($group['once_max'] != 0 && $data_group_order['num'] > $group['once_max']){
			return array('error'=>1,'msg'=>'您最多只能购买'.$group['once_min'].'单！');
		}
		$data_group_order['order_name'] = $group['s_name'].'*'.$data_group_order['num'];
		$data_group_order['price'] = $group['price'];
		$data_group_order['total_money'] = $group['price'] * $data_group_order['num'];
		$data_group_order['tuan_type'] = $group['tuan_type'];
		$data_group_order['add_time'] = $_SERVER['REQUEST_TIME'];
		//先保存好拼团id
		if(empty($_GET['sun_id'])&&($group['is_group_buy']==1)){
			$data_group_order['sun_id'] = uniqid("xnd");
			  if($group['is_lottery_group_buy']){
                $data_group_order['is_lottery_group']=1;
            }
		}elseif(!empty($_GET['sun_id'])&&($group['is_group_buy']==1)){
			//判断拼团id是否合法
			$pinwhere['sun_id']=strval($_GET['sun_id']);
			if(!M("GroupBuy")->where($pinwhere)->find()){
				return array('error'=>1,'msg'=>'拼团id不合法！');
			}
			$data_group_order['sun_id'] = strval($_GET['sun_id']);
			  if($group['is_lottery_group_buy']){
                $data_group_order['is_lottery_group']=1;
            }
		}
		//实物
		if($_POST['delivery_type'] && $group['tuan_type']==2){
		    // if(!empty($_GET['sun_id'])) {
		    // 	$where['sun_id']=strval($_GET['sun_id']);
      //           $group_buy=M("GroupBuy")->where($where)->find();
      //           if(!empty($group_buy)) {
      //               $data_group_order['contact_name'] = $group_buy['contact_name'];
      //               $data_group_order['phone'] = $group_buy['phone'];
      //               //$data_group_order['zipcode'] = $now_adress['zipcode'];
      //               $data_group_order['adress'] = $group_buy['address'];
      //               $data_group_order['delivery_type'] = $group_buy['delivery_type'];
      //               $data_group_order['delivery_comment'] = $group_buy['delivery_comment'];
      //           }else{
      //               return array('error'=>1,'msg'=>'获取拼团订单地址失败！！','order_id'=>$order_id);
      //           }
      //       }else {
                $now_adress = D('User_adress')->get_one_adress($uid, $_POST['adress_id']);
                if (empty($now_adress)) {
                    return array('error' => 1, 'msg' => '请先添加收货地址！');
                }
                $data_group_order['contact_name'] = $now_adress['name'];
                $data_group_order['phone'] = $now_adress['phone'];
                $data_group_order['zipcode'] = $now_adress['zipcode'];
                $data_group_order['adress'] = $now_adress['province_txt'] . ' ' . $now_adress['city_txt'] . ' ' . $now_adress['area_txt'] . ' ' . $now_adress['adress'];

                $data_group_order['delivery_type'] = $_POST['delivery_type'];
                $data_group_order['delivery_comment'] = $_POST['delivery_comment'];
            //}
		}else{

			$now_user = D('User')->get_user($uid);
			if(empty($now_user)){
				return array('error'=>1,'msg'=>'未获取到您的帐号信息，请重试！');
			}
			$data_group_order['phone'] = $now_user['phone'];
		}
		if($order_id){
			$condition_group_order['order_id'] = $order_id;
			$condition_group_order['uid'] = $uid;
			$save_result = $this->where($condition_group_order)->data($data_group_order)->save();
			if($save_result){
				return array('error'=>0,'msg'=>'订单修改成功！','order_id'=>$order_id);
			}else{
				return array('error'=>1,'msg'=>'订单修改失败！请重试','order_id'=>$order_id);
			}
		}else{
			$data_group_order['uid'] = $uid;
			$Group_store=D('Group_store')->where(array('group_id'=>$group['group_id']))->select();
			if(!empty($Group_store) && (count($Group_store)==1) && ($group['tuan_type']==2)){
				/****当此团购为实物且只指定一个店铺时，将店铺id直接带入保存到订单里*************/
			    $data_group_order['store_id']=$Group_store['0']['store_id'];
			}

			//如果存在分销id则存到订单数据中
			if(session("?share_distribution_id")){
				$data_group_order["distribution_id"]=session("share_distribution_id");
				$res=D("Distribution_person")->where(array("distribution_id"=>$data_group_order["distribution_id"]))->find();
				if(empty($res)){
					$this->error("该分销id不合法！！");
				}
			}
			$order_id = $this->data($data_group_order)->add();
			
			if($order_id){
				if ($_SESSION['openid']) {
					$href = C('config.site_url').'/wap.php?c=My&a=group_order&order_id='.$order_id;
					$model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
				//	$model->sendTempMsg('OPENTM201682460', array('href' => $href, 'wecha_id' => $_SESSION['openid'], 'first' => '您好，您的订单已生成', 'keyword3' => $order_id, 'keyword1' => date('Y-m-d H:i:s'), 'keyword2' => $data_group_order['order_name'], 'remark' => '您的该次'.$this->config['group_alias_name'].'下单成功，感谢您的使用！'));
				$model->sendTempMsg('OPENTM201682460', array('href' => $href, 'wecha_id' => $_SESSION['openid'], 'first' => '您好，您的订单'.$data_group_order['order_name'].'已生成', 'orderno' =>$order_id, 'refundno' => $data_group_order['num'], 'refundproduct' => $data_group_order['total_money'], 'remark' => '您的该次'.$this->config['group_alias_name'].'下单成功，感谢您的使用！'));
				//$model->sendTempMsg('OPENTM201682460', array('href' => $href, 'wecha_id' => $_SESSION['openid'], 'first' => '您好，您的订单'.$data_group_order['order_name'].'已生成', 'orderno' =>$order_id, 'refundno' => 'test', 'refundproduct' => 'test233', 'remark' => '您的该次'.$this->config['group_alias_name'].'下单成功，感谢您的使用！'));
				}
				$sms_data = array('mer_id' => $group['mer_id'], 'store_id' => 0, 'type' => 'group');
				if (C('config.sms_place_order') == 1 || C('config.sms_place_order') == 3) {
					$sms_data['uid'] = $uid;
					$sms_data['mobile'] = $data_group_order['phone'];
					$sms_data['sendto'] = 'user';
					$sms_data['content'] = '您在' . date("Y-m-d H:i:s") . '时，购买了' . $group['s_name'] . '，已成功生产订单，订单号：' . $order_id;
					Sms::sendSms($sms_data);
				}
				if (C('config.sms_place_order') == 2 || C('config.sms_place_order') == 3) {
					$merchant = D('Merchant')->where(array('mer_id' => $group['mer_id']))->find();
					$sms_data['uid'] = 0;
					$sms_data['mobile'] = $merchant['phone'];
					$sms_data['sendto'] = 'merchant';
					$sms_data['content'] = '有份新的' . $group['s_name'] . '被购买，订单号：' . $order_id . '请您注意查看并处理!';
					Sms::sendSms($sms_data);
				}
				
				return array('error'=>0,'msg'=>'订单产生成功！','order_id'=>$order_id);
			}else{
				return array('error'=>1,'msg'=>'订单产生失败！请重试');
			}
		}
	}
	public function get_order_detail_by_id_and_merId($mer_id,$order_id,$is_wap=false){
		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o',C('DB_PREFIX').'user'=>'u');
		$condition_where .= "`o`.`order_id`='$order_id' AND `o`.`group_id`=`g`.`group_id` AND `g`.`mer_id`='$mer_id' AND `o`.`uid`=`u`.`uid`";
		$now_order = $this->field('`o`.*,`g`.`s_name`,`g`.`pic`,`g`.`end_time`,`u`.`nickname`,`u`.`phone` `user_phone`')->where($condition_where)->table($condition_table)->find();
		if(!empty($now_order)){
			$group_image_class = new group_image();
			$tmp_pic_arr = explode(';',$now_order['pic']);
			$now_order['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
			$now_order['url'] = D('Group')->get_newgroup_url($now_order['group_id'],$now_order['sun_id'],$is_wap);
			
			$now_order['price'] = floatval($now_order['price']);
			$now_order['total_money'] = floatval($now_order['total_money']);
			$now_order['pay_type_txt'] = D('Pay')->get_pay_name($now_order['pay_type'],$now_order['is_mobile_pay']);
			if($now_order['group_pass']){
				$now_order['group_pass_txt'] = preg_replace('#(\d{4})#','$1 ',$now_order['group_pass']);
			}
		}
		return $now_order;
	}
	
	//获取某时间段的交易额
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

    /**
     * 获取某段时间内特定商家订单的数量
     * @param string $type
     * @return mixed
     */
    public function get_all_oreder_sum_import($type = 'day',$mer_id=812 ){
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
        $total = $this->field('sum(payment_money) as totalmoney')->where("`paid`=1 AND `add_time`>'$stime' AND `add_time`<'$etime' AND `mer_id` = $mer_id ")->select();
        return $total[0]["totalmoney"];
    }
	public function get_order_detail_by_id($uid,$order_id,$is_wap=false,$check_user=true){
		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o');
		if($check_user){
			$condition_where = "`o`.`uid`='$uid' AND ";
		}else{
			$condition_where = '';
		}
		$condition_where .= "`o`.`order_id`='$order_id' AND `o`.`group_id`=`g`.`group_id`";
		$now_order = $this->field('`o`.*,`g`.`s_name`,`g`.`pic`,`g`.`end_time`,`g`.`reply_count`,`g`.`score_all`,`g`.`score_mean`,`g`.`picapp`')->where($condition_where)->table($condition_table)->find();
		if(!empty($now_order)){
			$group_image_class = new group_image();
			$tmp_pic_arr = explode(';',$now_order['pic']);
			$now_order['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
			$now_order['picapp']=$group_image_class->get_image_by_path($now_order['picapp'])['image'];
			$now_order['url'] = D('Group')->get_newgroup_url($now_order['group_id'],$now_order['sun_id'],$is_wap);
			$now_order['order_url'] = $this->get_order_url($now_order['group_id'],$is_wap);
			
			$now_order['price'] = floatval($now_order['price']);
			$now_order['total_money'] = floatval($now_order['total_money']);
			$now_order['pay_type_txt'] = D('Pay')->get_pay_name($now_order['pay_type'],$now_order['is_mobile_pay']);
			if($now_order['group_pass']){
				$now_order['group_pass_txt'] = preg_replace('#(\d{4})#','$1 ',$now_order['group_pass']);
			}
			if($now_order['express_type']){
				$now_order['express_info'] = D('Express')->get_express($now_order['express_type']);
			}
		}
		return $now_order;
	}


	public function get_order_by_id($uid,$order_id){
		$condition_group_order['order_id'] = $order_id;
		$condition_group_order['uid'] = $uid;
		return $this->field(true)->where($condition_group_order)->find();
	}
	public function get_pay_order($uid,$order_id,$is_web=false){
		$now_order = $this->get_order_by_id($uid,$order_id);
		if(empty($now_order)){
			return array('error'=>1,'msg'=>'当前订单不存在！');
		}
		if(!empty($now_order['paid'])){
			unset($_SESSION['group_order']);
			if($is_web){
				return array('error'=>1,'msg'=>'您已经支付过此订单！','url'=>U('User/Index/group_order_view',array('order_id'=>$now_order['order_id'])));
			}else{
				return array('error'=>1,'msg'=>'您已经支付过此订单！','url'=>U('My/group_order',array('order_id'=>$now_order['order_id'])));
			}
		}
		
		$now_group = D('Group')->get_group_by_groupId($now_order['group_id']);
		//加入活动到期限制条件
		$now_time = $_SERVER['REQUEST_TIME'];
		if($now_group['end_time']<$now_time){
			return array('error'=>1,'msg'=>'当前'.$this->config['group_alias_name'].'已过期！');
		}
		if(empty($now_group)){
			return array('error'=>1,'msg'=>'当前'.$this->config['group_alias_name'].'不存在或已过期！');
		}
		
		if($is_web){
			$order_info = array(
					'order_id'			=>	$now_order['order_id'],
					'mer_id'			=>	$now_order['mer_id'],
					'order_type'		=>	'group',
					'order_total_money'	=>	floatval($now_order['total_money']),
					'sun_id'            =>  $now_order['sun_id'],
					'order_content'    =>  array(
							0=>array(
									'name'  		=> $now_group['merchant_name'].'：'.$now_group['group_name'],
									'num'   		=> $now_order['num'],
									'price' 		=> floatval($now_order['price']),
									'money' 	=> floatval($now_order['num']*$now_order['price']),
							)
					)
			);
		}else{
			$order_info = array(
					'order_id'			=>	$now_order['order_id'],
					'group_id'			=>	$now_order['group_id'],
					'mer_id'			=>	$now_order['mer_id'],
					'order_type'		=>	'group',
					'sun_id'            =>  $now_order['sun_id'],
					'order_name'		=>	$now_group['s_name'],
					'order_num'			=>	$now_order['num'],
					'order_price'		=>	floatval($now_order['price']),
					'order_total_money'	=>	floatval($now_order['total_money']),
			);
		}
		//传递订单类型
		$order_info['tuan_type']=$now_order['tuan_type'];
		//实物
		if($now_order['tuan_type'] == 2){
			$order_info['adress'] = $now_order['contact_name'].'，'.$now_order['adress'].'，'.$now_order['zipcode'].'，'.$now_order['phone'];
			switch($now_order['delivery_type']){
				case '1':
					$order_info['delivery_type'] = '工作日、双休日与假日均可送货';
					break;
				case '2':
					$order_info['delivery_type'] = '只工作日送货';
					break;
				case '3':
					$order_info['delivery_type'] = '只双休日、假日送货';
					break;
				default:
					$order_info['delivery_type'] = '白天没人，其它时间送货';
					break;
			}
			$order_info['delivery_comment'] = $now_order['delivery_comment'];
		}
		return array('error'=>0,'order_info'=>$order_info);
	}
	
	//电脑站支付前订单处理
	public function web_befor_pay($order_info,$now_user){
		//判断大于20只能使用20
		// if(C("PAY_LIMIT")){
		// 	if($now_user['now_money']>C("PAY_LIMIT_NUMBER")){
		// 		$now_user['now_money']=floatval(C("PAY_LIMIT_NUMBER"));
		// 	}
		// }
		//判断大于C("PAY_LIMIT_NUMBER")只能使用C("PAY_LIMIT_NUMBER")
        $nowmoney=floatval($now_user['now_money']);
		if(C("PAY_LIMIT")){
			if(C("PAY_LIMIT_GROUP")){
				$result=D("Group_order")->field("group_id")->where("order_id=".$order_info['order_id'])->find();
				$arr=explode(",",C("PAY_LIMIT_GROUP"));
				//如果在过滤余额支付的商品中，则将其余额虚拟为0，禁止使用余额支付
				if(in_array($result['group_id'], $arr)){
					$now_user['now_money']=0;
				}else{
					//如果不在过滤的商品中，则使用余额，并使用限制余额支付的数额
				if($now_user['now_money']>C("PAY_LIMIT_NUMBER")){
				$now_user['now_money']=floatval(C("PAY_LIMIT_NUMBER"));
				}
				}
			}
		}

        if(C("PAY_RANGE")) {
            $result2 = D("Group_order")->field("group_id")->where("order_id=" . $order_info['order_id'])->find();
            $chan_where2 = array(
                "url" => C("PAY_RANGE_TOPIC"),
                "status" => 1
            );
            //查询频道名称
            $channel = D("Channel")->where($chan_where2)->find();
            $goodsid = D("Channel_category_goods")->field("goods_id")->where(array("c_id" => $channel['id']))->select();
            if (in_array(array("goods_id"=>$result2['group_id']), $goodsid)) {
                //如果不在过滤的商品中，则使用余额，并使用限制余额支付的数额
                if ($nowmoney > C("PAY_RANGE_NUMBER")) {
                    $now_user['now_money'] = floatval(C("PAY_RANGE_NUMBER"));
                }
            } else {
                $now_user['now_money'] = 0;
            }
        }
		// if($now_user['now_money']>10){
		// 	$now_user['now_money']=10;
		// }
		//判断是否需要在线支付
		if($now_user['now_money'] < $order_info['order_total_money']){
			$online_pay = true;
		}else{
			$online_pay = false;
		}
		//不使用在线支付，直接使用用户余额。
		if(empty($online_pay)){
			// $money_pay_result = D('User')->user_money($now_user['uid'],$order_info['order_total_money'],'购买 '.$order_info['order_name'].'*'.$order_info['order_num']);
			// if($money_pay_result['error_code']){
				// return $money_pay_result;
			// }
			$order_pay['balance_pay'] = $order_info['order_total_money'];
		}else{
			if(!empty($now_user['now_money'])){
				$order_pay['balance_pay'] = $now_user['now_money'];
			}
		}
		
		//将已支付用户余额等信息记录到订单信息里
		if(!empty($order_pay['balance_pay'])){
			$data_group_order['balance_pay'] = $order_pay['balance_pay'];	
		}
		if(!empty($data_group_order)){
			$data_group_order['wx_cheap'] 			= 0;
			$data_group_order['card_id'] 			= 0;
			$data_group_order['merchant_balance'] 	= 0;
			$data_group_order['last_time'] = $_SERVER['REQUEST_TIME'];
			$condition_group_order['order_id'] = $order_info['order_id'];
			if(!$this->where($condition_group_order)->data($data_group_order)->save()){
				return array('error_code'=>true,'msg'=>'保存订单失败！请重试或联系管理员。');
			}
		}
		
		if($online_pay){
			return array('error_code'=>false,'pay_money'=>$order_info['order_total_money'] - $now_user['now_money']);
		}else{
			$order_param = array(
				'order_id' => $order_info['order_id'],
				'pay_type' => '',
				'third_id' => '',
				'is_mobile' => 0,
			);
			$result_after_pay = $this->after_pay($order_param);
			if($result_after_pay['error']){
				return array('error_code'=>true,'msg'=>$result_after_pay['msg']);
			}

			return array('error_code'=>false,'msg'=>'支付成功！','url'=>U('User/Index/group_order_view',array('order_id'=>$order_info['order_id'])));
		}
	}
	//手机端支付前订单处理
	public function wap_befor_pay($order_info,$now_coupon,$merchant_balance,$now_user,$wx_cheap){
        $nowmoney=floatval($now_user['now_money']);
		//判断大于C("PAY_LIMIT_NUMBER")只能使用C("PAY_LIMIT_NUMBER")
		if(C("PAY_LIMIT")){
			if(C("PAY_LIMIT_GROUP")){
				$result=D("Group_order")->field("group_id")->where("order_id=".$order_info['order_id'])->find();
				$arr=explode(",",C("PAY_LIMIT_GROUP"));
				//如果在过滤余额支付的商品中，则将其余额虚拟为0，禁止使用余额支付
				if(in_array($result['group_id'], $arr)){
					$now_user['now_money']=0;
				}else{
					//如果不在过滤的商品中，则使用余额，并使用限制余额支付的数额
				if($now_user['now_money']>C("PAY_LIMIT_NUMBER")){
				$now_user['now_money']=floatval(C("PAY_LIMIT_NUMBER"));
				}
				}
			}
		}
        if(C("PAY_RANGE")) {
            $result2 = D("Group_order")->field("group_id")->where("order_id=" . $order_info['order_id'])->find();
            $chan_where2 = array(
                "url" => C("PAY_RANGE_TOPIC"),
                "status" => 1
            );
            //查询频道名称
            $channel = D("Channel")->where($chan_where2)->find();
            $goodsid = D("Channel_category_goods")->field("goods_id")->where(array("c_id" => $channel['id']))->select();
            if (in_array(array("goods_id"=>$result2['group_id']), $goodsid)) {
                //如果不在过滤的商品中，则使用余额，并使用限制余额支付的数额
                if ($nowmoney >= C("PAY_RANGE_NUMBER")) {
                    $now_user['now_money'] = floatval(C("PAY_RANGE_NUMBER"));
                }
            } else {
                $now_user['now_money'] = 0;
            }
        }
		// if($now_user['now_money']>10){
		// 	$now_user['now_money']=10;
		// }
		//去除微信优惠的金额
		$pay_money = $order_info['order_total_money'] - $wx_cheap;
		$data_group_order['wx_cheap'] = $wx_cheap;
		
		//判断优惠券
		if(!empty($now_coupon['price'])){
			$data_group_order['card_id'] = $now_coupon['record_id'];
			if($now_coupon['price'] >= $pay_money){
				$order_result = $this->wap_pay_save_order($order_info,$data_group_order);
				if($order_result['error_code']){
					return $order_result;
				}
				return $this->wap_after_pay_before($order_info);
			}
			$pay_money -= $now_coupon['price'];
		}

		//判断商家余额
		if(!empty($merchant_balance)){
			if($merchant_balance >= $pay_money){
				$data_group_order['merchant_balance'] = $pay_money;
				$order_result = $this->wap_pay_save_order($order_info,$data_group_order);
				if($order_result['error_code']){
					return $order_result;
				}
				return $this->wap_after_pay_before($order_info);
			}else{
				$data_group_order['merchant_balance'] = $merchant_balance;
			}
			$pay_money -= $merchant_balance;
		}
		
		//判断帐户余额
		if(!empty($now_user['now_money'])){

			if($now_user['now_money'] >= $pay_money){
				$data_group_order['balance_pay'] = $pay_money;
				$order_result = $this->wap_pay_save_order($order_info,$data_group_order);
				if($order_result['error_code']){
					return $order_result;
				}
				return $this->wap_after_pay_before($order_info);
			}else{
				$data_group_order['balance_pay'] = $now_user['now_money'];
			}
			$pay_money -= $now_user['now_money'];
		}else{
			//如果要支付的金额为0
			if($pay_money==0){
				$data_group_order['balance_pay'] = $pay_money;
				$order_result = $this->wap_pay_save_order($order_info,$data_group_order);
				if($order_result['error_code']){
					return $order_result;
				}
				return $this->wap_after_pay_before($order_info);
			}
		}		//在线支付
		$order_result = $this->wap_pay_save_order($order_info,$data_group_order);
		if($order_result['error_code']){
			return $order_result;
		}
		return array('error_code'=>false,'pay_money'=>$pay_money);
	}
	//手机端支付前保存各种支付信息
	public function wap_pay_save_order($order_info,$data_group_order){
		$data_group_order['wx_cheap'] 			= !empty($data_group_order['wx_cheap']) ? $data_group_order['wx_cheap'] : 0;
		$data_group_order['card_id'] 			= !empty($data_group_order['card_id']) ? $data_group_order['card_id'] : 0;
		$data_group_order['merchant_balance'] 	= !empty($data_group_order['merchant_balance']) ? $data_group_order['merchant_balance'] : 0;
		$data_group_order['balance_pay']	 	= !empty($data_group_order['balance_pay']) ? $data_group_order['balance_pay'] : 0;
		$data_group_order['last_time'] = $_SERVER['REQUEST_TIME'];
		$data_group_order['submit_order_time'] = $_SERVER['REQUEST_TIME'];
		$condition_group_order['order_id'] = $order_info['order_id'];
		if($this->where($condition_group_order)->data($data_group_order)->save()){
			return array('error_code'=>false,'msg'=>'保存订单成功！');
		}else{
			return array('error_code'=>true,'msg'=>'保存订单失败！请重试或联系管理员。');
		}
	}
	//如果无需调用在线支付，使用此方法即可。直接余额支付
	public function wap_after_pay_before($order_info){
		$order_param = array(
				'order_id' => $order_info['order_id'],
				'pay_type' => '',
				'third_id' => '',
				'is_mobile' => 0,
			);
			$result_after_pay = $this->after_pay($order_param);
			if($result_after_pay['error']){
				return array('error_code'=>true,'msg'=>$result_after_pay['msg']);
			}
			//判断返回值有没有sun_id的内容，有的话跳转到groupbuy
			if(strpos($result_after_pay['url'],"sun_id")===false){
			return array('error_code'=>false,'msg'=>'支付成功！','url'=>U('My/group_order',array('order_id'=>$order_info['order_id'])));
			}else{
			$sun_id=substr($result_after_pay['url'],strrpos($result_after_pay['url'],"sun_id=")+7);	
			return array('error_code'=>false,'msg'=>'支付成功！','url'=> U('GroupBuy/show', array('sun_id' => $sun_id)));
			}
	}
	//支付前订单处理
	public function befor_pay($order_info,$now_coupon,$now_user){
		//判断是否需要在线支付
		if($now_coupon['price']+$now_user['now_money'] < $order_info['order_total_money']){
			$online_pay = true;
		}else{
			$online_pay = false;
		}
		//不使用在线支付，直接使用会员卡和用户余额。
		if(empty($online_pay)){
			if(!empty($now_coupon)){
				$coupon_pay_result = D('Member_card_coupon')->user_card($now_coupon['record_id'],$order_info['mer_id'],$now_user['uid']);
				if($coupon_pay_result['error_code']){
					return $coupon_pay_result;
				}
				$order_pay['car_id'] = $now_coupon['record_id'];
			}
			if(!empty($now_user['now_money']) && $now_coupon['price'] < $order_info['order_total_money']){
				$money_pay_result = D('User')->user_money($now_user['uid'],$order_info['order_total_money']-$now_coupon['price']);
				if($money_pay_result['error_code']){
					//使用余额支付完成后处理订单
					return $money_pay_result;
				}
				$order_pay['balance_pay'] = $now_user['now_money'];
			}
		}else{
			//校验会员卡
			if(!empty($now_coupon)){
				$coupon_pay_result = D('Member_card_coupon')->check_card($now_coupon['record_id'],$order_info['mer_id'],$now_user['uid']);
				if($coupon_pay_result['error_code']){
					return $coupon_pay_result;
				}
				$order_pay['car_id'] = $now_coupon['record_id'];
			}
			if(!empty($now_user['now_money'])){
				$order_pay['balance_pay'] = $now_user['now_money'];
			}
		}
		
		//将会员卡ID，已支付用户余额等信息记录到订单信息里
		if(!empty($order_pay['car_id'])){
			$data_group_order['card_id'] = $order_pay['record_id'];
		}
		if(!empty($order_pay['balance_pay'])){
			$data_group_order['balance_pay'] = $order_pay['record_id'];	
		}
		if(!empty($data_group_order)){
			$data_group_order['last_time'] = $_SERVER['REQUEST_TIME'];
			$condition_group_order['order_id'] = $now_order['order_id'];
			if(!$this->where($condition_group_order)->data($data_group_order)->save()){
				return array('error_code'=>true,'msg'=>'保存订单失败！请重试或联系管理员。');
			}
		}
		
		if($online_pay){
			return array('error_code'=>false,'pay_money'=>$order_info['order_total_money'] - $now_coupon['price'] - $now_user['now_money']);
		}else{
			$order_param = array(
				'order_id' => $order_info['order_id'],
				'pay_type' => '',
				'third_id' => '',
				'is_mobile' => 0,
				'pay_money' => 0,
			);
			$result_after_pay = $this->after_pay($order_param);
			if($result_after_pay['error']){
				return array('error_code'=>true,'msg'=>$result_after_pay['msg']);
			}
			//判断返回值有没有sun_id的内容，有的话跳转到groupbuy
			if(strpos($result_after_pay['msg'],"sun_id")===false){
			return array('error_code'=>false,'url'=>U('My/group_order',array('order_id'=>$order_info['order_id'])));
			}else{
			$sun_id=substr($result_after_pay['msg'],strrpos($result_after_pay['msg'],"sun_id=")+7);	
			return array('error_code'=>false,'url'=> U('GroupBuy/show', array('sun_id' => $sun_id)));
			}
		}
	}
	
	
	//支付之后
	public function after_pay($order_param){
		unset($_SESSION['group_order']);
		$condition_group_order['order_id'] = $order_param['order_id'];
		$now_order = $this->field(true)->where($condition_group_order)->find();
		if(empty($now_order)){
			return array('error'=>1,'msg'=>'当前订单不存在！');
		}else if($now_order['paid'] == 1){
			if($order_param['is_mobile']){
				return array('error'=>1,'msg'=>'该订单已付款！','url'=>U('My/group_order',array('order_id'=>$now_order['order_id'])));
			}else{
				return array('error'=>1,'msg'=>'该订单已付款！','url'=>U('User/Index/group_order_view',array('order_id'=>$now_order['order_id'])));
			}
		}else{

            //添加自动成为分销
            $distributor=D("Distribution_person")->where(array("user_id"=>$now_order["uid"]))->find();

            if(empty($distributor)){
                $user_id=$now_order['uid'];
                $num=15-strlen($user_id)-1;
                $str=$this->createRandStr($num);
                $distribution_id=$str."_".$user_id;
                $insertdata=array(
                    "user_id"=>$user_id,
                    "distribution_id"=>$distribution_id,
                    "create_time"=>time()
                );
                D("Distribution_person")->data($insertdata)->add();
            }
//            if(!empty($now_order["distribution_id"])){
//                $fenxiaozhe= D("Distribution_person")->where(array("distribution_id"=>$now_order["distribution_id"]))->find();
//                if(!empty($fenxiaozhe)){
//                    $fenxiaouser=D("User")->where(array("uid"=>$fenxiaozhe["user_id"]))->find();
//                    if(!empty($fenxiaozhe)){
//                        $group=D("Group")->where(array("group_id"=>$now_order["group_id"]))->find();
//
//                        $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
//                        $model->sendTempMsg('OPENTM207873652', array('href' => 'http://www.xiaonongding.com/wap.php', 'wecha_id' => $fenxiaouser['openid'], 'first' => '分销消费提醒', 'keyword1' => $now_order['total_money'], 'keyword2' => ($group["commission"]*$now_order["num"]*0.6)."元", 'keyword3' => date("y/m/d H:i:s",time()) , 'remark' => '感谢您的分销'));
//                    }
//                }
//            }


			//得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
			$now_user = D('User')->get_user($now_order['uid']);
			if(empty($now_user)){
				return array('error'=>1,'msg'=>'没有查找到此订单归属的用户，请联系管理员！');
			}
			
			//判断优惠券是否正确
			if($now_order['card_id']){
				$now_coupon = D('Member_card_coupon')->get_coupon_by_recordid($now_order['card_id'],$now_order['uid']);
				if(empty($now_coupon)){
					return $this->wap_after_pay_error($now_order,$order_param,'您选择的优惠券不存在！');
				}
			}
			
			//判断会员卡余额
			$merchant_balance = floatval($now_order['merchant_balance']);
			if($merchant_balance){
				$user_merchant_balance = D('Member_card')->get_balance($now_order['uid'],$now_order['mer_id']);
				if($user_merchant_balance < $merchant_balance){
					return $this->wap_after_pay_error($now_order,$order_param,'您的会员卡余额不够此次支付！');
				}
			}
			//判断帐户余额
			$balance_pay = floatval($now_order['balance_pay']);
			if($balance_pay){
				if($now_user['now_money'] < $balance_pay){
					return $this->wap_after_pay_error($now_order,$order_param,'您的帐户余额不够此次支付！');
				}
			}
			
			//如果使用了优惠券
			if($now_order['card_id']){
				$use_result = D('Member_card_coupon')->user_card($now_order['card_id'],$now_order['mer_id'],$now_order['uid']);
				if($use_result['error_code']){
					return array('error'=>1,'msg'=>$use_result['msg']);
				}
			}
			
			//如果使用会员卡余额
			if($merchant_balance){
				$use_result = D('Member_card')->use_card($now_order['uid'],$now_order['mer_id'],$merchant_balance,'购买 '.$now_order['order_name'].' 扣除会员卡余额');
				if($use_result['error_code']){
					return array('error'=>1,'msg'=>$use_result['msg']);
				}
			}
			//如果用户使用了余额支付，则扣除相应的金额。
			if(!empty($balance_pay)){
				$use_result = D('User')->user_money($now_order['uid'],$balance_pay,'购买 '.$now_order['order_name'].' 扣除余额');
				if($use_result['error_code']){
					return array('error'=>1,'msg'=>$use_result['msg']);
				}
			}
			
			$condition_group_order['order_id'] = $order_param['order_id'];
			if($now_order['tuan_type'] < 2){
				$group_pass_array = array(
						date('y',$_SERVER['REQUEST_TIME']),
						date('m',$_SERVER['REQUEST_TIME']),
						date('d',$_SERVER['REQUEST_TIME']),
						date('H',$_SERVER['REQUEST_TIME']),
						date('i',$_SERVER['REQUEST_TIME']),
						date('s',$_SERVER['REQUEST_TIME']),
						mt_rand(10,99),
				);
				shuffle($group_pass_array);
				$data_group_order['group_pass'] = implode('',$group_pass_array);
			}
			
			$data_group_order['pay_time'] = $_SERVER['REQUEST_TIME'];
			$data_group_order['payment_money'] = floatval($order_param['pay_money']);
			$data_group_order['pay_type'] = $order_param['pay_type'];
			$data_group_order['third_id'] = $order_param['third_id'];
			$data_group_order['is_mobile_pay'] = $order_param['is_mobile'];
			$data_group_order['paid'] = 1;
			//开启事务
			$this->startTrans();
			if($this->where($condition_group_order)->data($data_group_order)->save()){
				$this->commit();
				$condition_group['group_id'] = $now_order['group_id'];
				D('Group')->where($condition_group)->setInc('sale_count',$now_order['num']);
				
				//D('User')->add_score($now_order['uid'],floor($now_order['total_money']*C('config.user_score_get')),'购买 '.$now_order['order_name'].' 消费'.floatval($now_order['total_money']).'元 获得积分');
				
				/* 粉丝行为分析 */
				D('Merchant_request')->add_request($now_order['mer_id'],array('group_buy_count'=>$now_order['num'],'group_buy_money'=>$now_order['total_money']));

				if ($now_user['openid'] && $order_param['is_mobile']) {
					$href = C('config.site_url').'/wap.php?c=My&a=group_order&order_id='.$now_order['order_id'];
					$model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
					if($now_order['tuan_type'] < 2){
						$model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->config['group_alias_name'].'提醒', 'keyword1' => $now_order['order_name'], 'keyword2' => $now_order['order_id'], 'keyword3' => $now_order['total_money'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => $this->config['group_alias_name'].'成功，您的消费码：'.$data_group_order['group_pass']));
					} else {
						$model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->config['group_alias_name'].'提醒', 'keyword1' => $now_order['order_name'], 'keyword2' => $now_order['order_id'], 'keyword3' => $now_order['total_money'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => $this->config['group_alias_name'].'成功，感谢您的使用'));
					}
				}


				$sms_data = array('mer_id' => $now_order['mer_id'], 'store_id' => 0, 'type' => 'group');
				if (C('config.sms_success_order') == 1 || C('config.sms_success_order') == 3) {
				
					
					
					$sms_data['uid'] = $now_order['uid'];
					$sms_data['mobile'] = $now_order['phone'];
					$sms_data['sendto'] = 'user';
					if ($data_group_order['group_pass']) {
						$sms_data['content'] = '您购买 '.$now_order['order_name'].'的订单(订单号：' . $now_order['order_id'] . ')已经完成支付,您的消费码：' . $data_group_order['group_pass'];
					} else {
						  
							       $now_group=D("Group")->field("is_group_buy,need_num,is_lottery_group_buy")->find($now_order['group_id']);
								   	 
						 $fo=fopen("choujiang.txt","a+");
                               fwrite($fo,"now_group ".json_encode($now_group).date("Y-m-d H:i:s",time())."\n");
                               fclose($fo);
						 
						 if($now_group['is_lottery_group_buy']){
                             $sms_data['content'] = '感谢您参与'.$now_order['order_name'].'抽奖团(订单号：' . $now_order['order_id'] . ')请等待抽奖结果';
						 }else{
                             $sms_data['content'] = '您购买 '.$now_order['order_name'].'的订单(订单号：' . $now_order['order_id'] . ')已经完成支付!';

						 }
					
						 
						
					}
					
					Sms::sendSms($sms_data);
				}
				if (C('config.sms_success_order') == 2 || C('config.sms_success_order') == 3) {
					$merchant = D('Merchant')->where(array('mer_id' => $now_order['mer_id']))->find();
					$sms_data['uid'] = 0;
					$sms_data['mobile'] = $merchant['phone'];
					$sms_data['sendto'] = 'merchant';
					$sms_data['content'] = '顾客购买的' . $now_order['order_name'] . '的订单(订单号：' . $now_order['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已经完成了支付！';
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


	public function cardafter_pay($order_param){
     $condition_record["record_id"]=$order_param["order_id"];
     $cardrecord=D("Usercardrecord")->where($condition_record)->find();
     if(empty($cardrecord)){
         return array("error"=>1,"msg"=>"当前订单不存在！");
     }
     $grouporders=$this->where("adam_id = ".$cardrecord['adam_id']." AND paid = 0")->select();
     if(empty($grouporders)){
         return  array("error"=>1,"msg"=>"未查找到当前购物车未支付订单！");
     }
        //得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
        $now_user = D('User')->get_user($cardrecord['uid']);
        if(empty($now_user)){
            return array('error'=>1,'msg'=>'没有查找到此订单归属的用户，请联系管理员！');
        }
        $success=false;   //是否成功修改订单状态
     foreach ($grouporders as $key=>$value){
       $dataorder["pay_time"]=$_SERVER["REQUEST_TIME"];
       $dataorder['paid']=1;
         $dataorderr['pay_type'] = $order_param['pay_type'];
         $dataorder['third_id'] = $order_param['third_id'];
         $dataorder['is_mobile_pay'] = $order_param['is_mobile'];
         $dataorder['payment_money'] = floatval($value['price']*$value['num']);
         $this->startTrans();
         if($this->where(array("order_id"=>$value["order_id"]))->data($dataorder)->save()){
             $success=true;
             $this->commit();
             $condition_group['group_id'] = $value['group_id'];
            D("Group")->where($condition_group)->setInc("sale_count",$value['num']);

            //短信提醒
             $sms_data = array('mer_id' => $value['mer_id'], 'store_id' => 0, 'type' => 'group');
             if (C('config.sms_success_order') == 2 || C('config.sms_success_order') == 3) {
                 $merchant = D('Merchant')->where(array('mer_id' => $value['mer_id']))->find();
                 $sms_data['uid'] = 0;
                 $sms_data['mobile'] = $merchant['phone'];
                 $sms_data['sendto'] = 'merchant';
                 $sms_data['content'] = '顾客购买的' . $value['order_name'] . '的订单(订单号：' . $value['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已经完成了支付！';
                 Sms::sendSms($sms_data);
             }

         }else{
             $success=false;
             $this->rollback();
             return array('error'=>1,'msg'=>'修改订单状态失败，请联系系统管理员！');
         }

     }
     if($success){
         if ($now_user['openid'] && $order_param['is_mobile']) {
             $href = C('config.site_url').'/wap.php?c=My&a=group_order';
             $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                 $model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->config['group_alias_name'].'提醒', 'keyword1' => "购物车订单", 'keyword2' => $cardrecord['record_id'], 'keyword3' => $cardrecord['totalmoney'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => $this->config['group_alias_name'].'成功，感谢您的使用'));

         }


     }

    }

    /**
     * 为了生成总长度15位的分销id
     * 按照长度随机生成字符串
     * @param $num
     * @return string
     */
    private function createRandStr($num){
        $letters=array(
            "A","a","B","b","C","c","D","d","E","e","F","f","G","g","H","h","I","i","J","j","K","k","L","l","M","m",
            "N","n","O","o","P","p","Q","q","R","r","S","s","T","t","U","u","V","v","W","w","X","x","Y","y","Z","z",
        );
        $str="";
        for($i=0;$i<$num;$i++){
            $j=rand(0,51);
            $str.=$letters[$j];
        }
        return $str;
    }

	//支付之后
	public function new_after_pay($order_param){
		unset($_SESSION['group_order']);
		$condition_group_order['order_id'] = $order_param['order_id'];
		$now_order = $this->field(true)->where($condition_group_order)->find();
		if(empty($now_order)){
			return array('error'=>1,'msg'=>'当前订单不存在！');
		}else if($now_order['paid'] == 1){
			if($order_param['is_mobile']){
				return array('error'=>1,'msg'=>'该订单已付款！','url'=>U('My/group_order',array('order_id'=>$now_order['order_id'])));
			}else{
				return array('error'=>1,'msg'=>'该订单已付款！','url'=>U('User/Index/group_order_view',array('order_id'=>$now_order['order_id'])));
			}
		}else{
                   //添加自动成为分销
		    $distributor=D("Distribution_person")->where(array("user_id"=>$now_order["uid"]))->find();

            if(empty($distributor)){
                $user_id=$now_order['uid'];
                $num=15-strlen($user_id)-1;
                $str=$this->createRandStr($num);
                $distribution_id=$str."_".$user_id;
                $insertdata=array(
                    "user_id"=>$user_id,
                    "distribution_id"=>$distribution_id,
                    "create_time"=>time()
                );
                D("Distribution_person")->data($insertdata)->add();
            }
//            if(!empty($now_order["distribution_id"])){
//                $fenxiaozhe= D("Distribution_person")->where(array("distribution_id"=>$now_order["distribution_id"]))->find();
//                if(!empty($fenxiaozhe)){
//                    $fenxiaouser=D("User")->where(array("uid"=>$fenxiaozhe["user_id"]))->find();
//                    if(!empty($fenxiaozhe)){
//                        $group=D("Group")->where(array("group_id"=>$now_order["group_id"]))->find();
//
//                        $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
//                        $model->sendTempMsg('OPENTM207873652', array('href' => 'http://www.xiaonongding.com/wap.php', 'wecha_id' => $fenxiaouser['openid'], 'first' => '分销消费提醒', 'keyword1' => $now_order['total_money'], 'keyword2' => ($group["commission"]*$now_order["num"]*0.6)."元", 'keyword3' => date("y/m/d H:i:s",time()) , 'remark' => '感谢您的分销'));
//                    }
//                }
//            }
			//得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
			$now_user = D('User')->get_user($now_order['uid']);
			if(empty($now_user)){
				return array('error'=>1,'msg'=>'没有查找到此订单归属的用户，请联系管理员！');
			}
			
			//判断优惠券是否正确
			if($now_order['card_id']){
				$now_coupon = D('Member_card_coupon')->get_coupon_by_recordid($now_order['card_id'],$now_order['uid']);
				if(empty($now_coupon)){
					return $this->wap_after_pay_error($now_order,$order_param,'您选择的优惠券不存在！');
				}
			}
			
			//判断会员卡余额
			$merchant_balance = floatval($now_order['merchant_balance']);
			if($merchant_balance){
				$user_merchant_balance = D('Member_card')->get_balance($now_order['uid'],$now_order['mer_id']);
				if($user_merchant_balance < $merchant_balance){
					return $this->wap_after_pay_error($now_order,$order_param,'您的会员卡余额不够此次支付！');
				}
			}
			//判断帐户余额
			$balance_pay = floatval($now_order['balance_pay']);
			if($balance_pay){
				if($now_user['now_money'] < $balance_pay){
					return $this->wap_after_pay_error($now_order,$order_param,'您的帐户余额不够此次支付！');
				}
			}
			
			//如果使用了优惠券
			if($now_order['card_id']){
				$use_result = D('Member_card_coupon')->user_card($now_order['card_id'],$now_order['mer_id'],$now_order['uid']);
				if($use_result['error_code']){
					return array('error'=>1,'msg'=>$use_result['msg']);
				}
			}
			
			//如果使用会员卡余额
			if($merchant_balance){
				$use_result = D('Member_card')->use_card($now_order['uid'],$now_order['mer_id'],$merchant_balance,'购买 '.$now_order['order_name'].' 扣除会员卡余额');
				if($use_result['error_code']){
					return array('error'=>1,'msg'=>$use_result['msg']);
				}
			}
			//如果用户使用了余额支付，则扣除相应的金额。
			if(!empty($balance_pay)){
				$use_result = D('User')->user_money($now_order['uid'],$balance_pay,'购买 '.$now_order['order_name'].' 扣除余额');
				if($use_result['error_code']){
					return array('error'=>1,'msg'=>$use_result['msg']);
				}
			}
			
			$condition_group_order['order_id'] = $order_param['order_id'];
			if($now_order['tuan_type'] < 2){
				$group_pass_array = array(
						date('y',$_SERVER['REQUEST_TIME']),
						date('m',$_SERVER['REQUEST_TIME']),
						date('d',$_SERVER['REQUEST_TIME']),
						date('H',$_SERVER['REQUEST_TIME']),
						date('i',$_SERVER['REQUEST_TIME']),
						date('s',$_SERVER['REQUEST_TIME']),
						mt_rand(10,99),
				);
				shuffle($group_pass_array);
				$data_group_order['group_pass'] = implode('',$group_pass_array);
			}
			
			$data_group_order['pay_time'] = $_SERVER['REQUEST_TIME'];
			$data_group_order['payment_money'] = floatval($order_param['pay_money']);
			$data_group_order['pay_type'] = $order_param['pay_type'];
			$data_group_order['third_id'] = $order_param['third_id'];
			$data_group_order['is_mobile_pay'] = $order_param['is_mobile'];
			$data_group_order['paid'] = 1;
			$sun_id="";
			$flag=1;
        	//记录拼团id
        	if(!empty($now_order['sun_id'])){
            $sun_id=$now_order['sun_id'];
            }
			
			//开启事务
			$this->startTrans();
			if($this->where($condition_group_order)->data($data_group_order)->save()){
			    //先判断是否是拼团商品
                $now_group=D("Group")->field("is_group_buy,need_num,is_lottery_group_buy")->find($now_order['group_id']);
                $group_buy_data=array();
		
                if($now_group['is_group_buy']) {
                        //如果session中存在说明是从拼团进入的，可以直接插入到订单表中，但是首先用改确认是否是对应的商品
                        $group_buy_data['sun_id']=$sun_id;
                        $group_buy_data['group_id']=$now_order['group_id'];
                        $res=M("Group_buy")->where($group_buy_data)->find();
                        //确定是当前商品才去加入到订单中，并且修改已参与人数
				
                        if($res) {
							  
                        		if(($res['status']==0)&&($res['user_id']!=$now_order['uid'])){
                                $react_num=$res['react_num']+1;
                                if($react_num>=$res['need_num']){
                                    $newdata['status']=1;
									                
									         if($now_group['is_lottery_group_buy']) {
												
                                        $randman =rand(0,(intval($res['need_num'])-1));  //生成随机数字  制定中奖者
                                        $conditionlottery['sun_id']=$sun_id;
                                        $conditionlottery['paid']=1;
                                        $grouporders=   D('group_order')->where($conditionlottery)->select();
                                        $order_id=$grouporders[ $randman]['order_id'];
                                       
                                        D('group_order')->where(array('order_id'=>$order_id))->setField('is_lottery_order', 1);   //设置中奖者
                                       $this->send_lottery_sms($grouporders[ $randman]);   //发送信息 

                                        $condition_group2['group_id'] = $now_order['group_id'];
                                        //增加成团数量判断
                                        D('group')->where($condition_group2)->setInc('now_group_num', 1);



                                        $data = D('group')->find($now_order['group_id']);

                                        if ($data['now_group_num'] >= $data['max_group_num']) {
                                            D('group')->where($condition_group2)->setField('end_time', 1477019471);   //大于最大开团次数  关闭该特卖

                                        }else{
											
										}

                                    }
                                }else{
                                    $newdata['status']=0;
                                }
                                $newdata['react_num']=$react_num;
                                $newdata['update_time']=time();
                                if(!M("Group_buy")->where($group_buy_data)->setField($newdata)){
                                	$this->rollback();
                            		return array('error'=>1,"msg"=>"更新拼团信息失败！");
                                }
                            }
                        }else{
                        	//不存在则新增
                        	$group_buy_data['sun_id'] = $sun_id;
                        	$group_buy_data['user_id'] = $now_order['uid'];
                        	$group_buy_data['group_id'] = $now_order['group_id'];
                        	$group_buy_data['need_num'] = $now_group['need_num'];
                        	$group_buy_data['react_num']=1;
                        	$group_buy_data['create_time'] = time();
                        	$group_buy_data['status']=0;
                        	if(!M("Group_buy")->data($group_buy_data)->add()) {
                        		$this->rollback();
                            	return array('error'=>1,"msg"=>"未找到该拼团信息！");
                        	}
					
                		}
            	}
				$this->commit();
			
				
				$condition_group['group_id'] = $now_order['group_id'];
				D('Group')->where($condition_group)->setInc('sale_count',$now_order['num']);
				
				//D('User')->add_score($now_order['uid'],floor($now_order['total_money']*C('config.user_score_get')),'购买 '.$now_order['order_name'].' 消费'.floatval($now_order['total_money']).'元 获得积分');
				
				/* 粉丝行为分析 */
				D('Merchant_request')->add_request($now_order['mer_id'],array('group_buy_count'=>$now_order['num'],'group_buy_money'=>$now_order['total_money']));

				if ($now_user['openid'] && $order_param['is_mobile']) {
					$href = C('config.site_url').'/wap.php?c=My&a=group_order&order_id='.$now_order['order_id'];
					$model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
					if($now_order['tuan_type'] < 2){
						$model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->config['group_alias_name'].'提醒', 'keyword1' => $now_order['order_name'], 'keyword2' => $now_order['order_id'], 'keyword3' => $now_order['total_money'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => $this->config['group_alias_name'].'成功，您的消费码：'.$data_group_order['group_pass']));
					} else {
						$model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->config['group_alias_name'].'提醒', 'keyword1' => $now_order['order_name'], 'keyword2' => $now_order['order_id'], 'keyword3' => $now_order['total_money'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => $this->config['group_alias_name'].'成功，感谢您的使用'));
					}
				}


				$sms_data = array('mer_id' => $now_order['mer_id'], 'store_id' => 0, 'type' => 'group');
				if (C('config.sms_success_order') == 1 || C('config.sms_success_order') == 3) {
				
		
				
					$sms_data['uid'] = $now_order['uid'];
					$sms_data['mobile'] = $now_order['phone'];
					$sms_data['sendto'] = 'user';
					if ($data_group_order['group_pass']) {
						$sms_data['content'] = '您购买 '.$now_order['order_name'].'的订单(订单号：' . $now_order['order_id'] . ')已经完成支付,您的消费码：' . $data_group_order['group_pass'];
					} else {
						
							       $now_group=D("Group")->field("is_group_buy,need_num,is_lottery_group_buy")->find($now_order['group_id']);
								   	 
						 $fo=fopen("choujiang.txt","a+");
                               fwrite($fo,"now_group ".json_encode($now_group).date("Y-m-d H:i:s",time())."\n");
                               fclose($fo);
						 
						 if($now_group['is_lottery_group_buy']){
							 	$sms_data['content'] = '感谢您参与'.$now_order['order_name'].'抽奖团(订单号：' . $now_order['order_id'] . ')请等待抽奖结果'; 
							
						 }else{
						 $sms_data['content'] = '您购买 '.$now_order['order_name'].'的订单(订单号：' . $now_order['order_id'] . ')已经完成支付!'; 
						 }
					}
					
					Sms::sendSms($sms_data);
				}
				if (C('config.sms_success_order') == 2 || C('config.sms_success_order') == 3) {
					$merchant = D('Merchant')->where(array('mer_id' => $now_order['mer_id']))->find();
					$sms_data['uid'] = 0;
					$sms_data['mobile'] = $merchant['phone'];
					$sms_data['sendto'] = 'merchant';
					$sms_data['content'] = '顾客购买的' . $now_order['order_name'] . '的订单(订单号：' . $now_order['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已经完成了支付！';
					Sms::sendSms($sms_data);
				}
				if($order_param['is_mobile']){
					if($flag) {
                        return array('error' => 0, 'url' => str_replace('/source/', '/', U('GroupBuy/show', array('sun_id' => $now_order['sun_id']))));
                    }else{
                        return array('error' => 0, 'url' => str_replace('/source/', '/', U('My/group_order', array('order_id' => $now_order['order_id']))));
                    }
				}else{
					if($flag) {
					return array('error' => 0, 'url' => str_replace('/source/', '/', U('GroupBuy/show', array('sun_id' => $group_buy_data['sun_id']))));
					}else{
					return array('error'=>0,'url'=>U('User/Index/group_order_view',array('order_id'=>$now_order['order_id'])));
					}
				}
			}else{
				$this->rollback();
				return array('error'=>1,'msg'=>'修改订单状态失败，请联系系统管理员！');
			}
		}
	}
	
	//给中奖者发信息 
	public function send_lottery_sms($grouporder){
		
             $sms_data2 = array('mer_id' => $grouporder['mer_id'], 'store_id' => 0, 'type' => 'group');
        if (C('config.sms_success_order') == 1 || C('config.sms_success_order') == 3) {
            $sms_data2['uid'] = $grouporder['uid'];
            $sms_data2['mobile'] = $grouporder['phone'];
            $sms_data2['sendto'] = 'user';

            $sms_data2['content'] = '恭喜！您参与的 '.$grouporder['order_name'].' 抽奖(订单号：' . $grouporder['order_id'] . ')成功!请登录个人中心查看！';


            Sms::sendSms($sms_data2);
			
				  $fo=fopen("lottery.txt","a+");
                               fwrite($fo,"now_lottery ".json_encode( $sms_data2)."  ".date("Y-m-d H:i:s",time())."\n");
                               fclose($fo);
		
			
			
        }


    }

	//支付时，金额不够，记录到帐号
	public function wap_after_pay_error($now_order,$order_param,$error_tips){
		//记录充值的金额，因为 Pay/return_url 处没有返回order的具体信息，故在此调用。
		$user_result = D('User')->add_money($now_order['uid'],$order_param['pay_money'],'在线充值');
		if($user_result['error_code']){
			return array('error'=>1,'msg'=>$user_result['msg']);
		}else{
			if($order_param['is_mobile']){
				$return_url = str_replace('/source/','/',U('My/group_order',array('order_id'=>$now_order['order_id'])));
			}else{
				$return_url = U('User/Index/group_order_view',array('order_id'=>$now_order['order_id']));
			}
			return array('error'=>1,'msg'=>$error_tips.'已将您充值的金额添加到您的余额内。','url'=>$return_url);
		}
	}
	//修改订单状态
	public function change_status($order_id,$status){
		$condition_group_order['order_id'] = $order_id;
		$data_group_order['status'] = $status;
		if($this->where($condition_group_order)->data($data_group_order)->save()){
			return true;
		}else{
			return false;
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
	//获取含有用户id（针对用户佣金）的订单
	public function getCommissionOrder($uid){


		$condition_where = "`o`.`distribution_id` like '%$uid'";

		$condition_where .= " AND `o`.`paid`='1'";
		$condition_where .= " AND `o`.`user_confirm`='1'";


		import('@.ORG.group_page');
		$count_order = $this->field('`o`.*,`g`.`s_name`,`g`.`pic`,`g`.`end_time`,`g`.`commission`')->alias("o")->join(C('DB_PREFIX')."group g ON o.group_id=g.group_id")->where($condition_where)->count();

		$p = new Page($count_order,C('config.group_page_row'),C('config.group_page_val'));

		$order_list = $this->field('`o`.*,`g`.`s_name`,`g`.`pic`,`g`.`end_time`,`g`.`commission`')->alias("o")->join(C('DB_PREFIX')."group g ON o.group_id=g.group_id")->where($condition_where)->order('`o`.`add_time` DESC')->limit($p->firstRow,$p->listRow)->select();

		if(!empty($order_list)){
			$group_image_class = new group_image();
			foreach($order_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$order_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$order_list[$k]['url'] = $this->get_group_url($v['group_id'],true);
				$order_list[$k]['price'] = floatval($v['price']);
				$order_list[$k]['total_money'] = floatval($v['total_money']);
			}
		}

		$return['pagebar']=$p->show();

		$return['order_list']=$order_list;

		return $return;
	}

	public function get_group_url($group_id,$is_wap){
		if($is_wap){
			return U('Wap/Group/detail',array('group_id'=>$group_id));
		}else{
			return C('config.site_url').'/group/'.$group_id.'.html';
		}
	}


	//订单确认
	public function orderConfirm($order_id){
		$condition_group_order['order_id'] = $order_id;
		$data_group_order['user_confirm'] = 1;
		$data_group_order['is_pay_bill'] = 1;
		if (!($this->where($condition_group_order)->data($data_group_order)->save())) {
			return false;
		}else{
			//如果确认订单则判断是否为分销订单，是的话则修改对应的用户的余额
			//获取当前订单信息
			$now_order=$this->alias("go")->field("go.order_name,go.num,go.group_id,go.distribution_id,go.total_money,g.commission")->join(C('DB_PREFIX')."group g ON go.group_id=g.group_id")->where("go.order_id=".$order_id)->find();
                        if(!empty($now_order["distribution_id"])){
                $fenxiaozhe= D("Distribution_person")->where(array("distribution_id"=>$now_order["distribution_id"]))->find();
                if(!empty($fenxiaozhe)){
                    $fenxiaouser=D("User")->where(array("uid"=>$fenxiaozhe["user_id"]))->find();
                    if(!empty($fenxiaozhe)){
                        $group=D("Group")->where(array("group_id"=>$now_order["group_id"]))->find();

                        $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                        $model->sendTempMsg('OPENTM207873652', array('href' => 'http://www.xiaonongding.com/wap.php', 'wecha_id' => $fenxiaouser['openid'], 'first' => '分销消费提醒', 'keyword1' => $now_order['total_money'], 'keyword2' => ($group["commission"]*$now_order["num"]*0.6)."元", 'keyword3' => date("y/m/d H:i:s",time()) , 'remark' => '感谢您的分销'));
                    }
                }
            }
			//$uid=substr($now_order['distribution_id'],(stripos($now_order['distribution_id'],"_")+1));
			$money=floatval($now_order['commission']*$now_order['num']*0.6);
			if(!empty($money)){
				//判断是否属于频道商品，如果是的话则增加频道总营收和收益
				$result=M("Channel_category_goods")->where("goods_id=".$now_order['group_id'])->find();
				$result=array_filter($result);
				if(!empty($result)){
					M("Channel")->where("id=".$result['c_id'])->setInc("income",$now_order['total_money']);
				}
				if(!empty($now_order['distribution_id'])){
					$uid=substr($now_order['distribution_id'],(stripos($now_order['distribution_id'],"_")+1));
					$this->commissionAddMoney($uid,$money,"分销".$now_order['order_name']."获取佣金");
					M("Channel")->where("id=".$result['c_id'])->setInc("profit",$now_order['commission']*$now_order['num']*0.4);
				}else{
					M("Channel")->where("id=".$result['c_id'])->setInc("profit",$now_order['commission']*$now_order['num']);
				}
			}else{
				//佣金为空也增加总营收
				M("Channel")->where("id=".$result['c_id'])->setInc("income",$now_order['total_money']);
			}
			return true;
		}
		return false;
	}

	//订单确认
	public function pinorderConfirm($order_id){
		//先查看该订单是否是拼团订单

		$thisorder=$this->find($order_id);
		//如果是拼团的话单独算
		if($thisorder['sun_id']!=""){

			//查询出参团的所有用户
			$where['sun_id']=$now_order['sun_id'];
			$where['group_id']=$now_order['group_id'];
			$order_list=D("GroupOrder")->field("order_id")->where($where)->select();
			$orderids=array();
			foreach ($order_list as $k => $val) {
				$orderids[]=$val['order_id'];
			}
			$condition_group_order['order_id'] = array("in",implode($orderids,","));
			if (!($this->where($condition_group_order)->data($data_group_order)->save())) {
			return false;
			}else{
				//如果确认订单则判断是否为分销订单，是的话则修改对应的用户的余额
			//获取当前订单信息
			$now_order_list=$this->alias("go")->field("go.order_name,go.num,go.group_id,go.distribution_id,go.total_money,g.commission")->join(C('DB_PREFIX')."group g ON go.group_id=g.group_id")->where($condition_group_order)->select();
			if(!empty($now_order_list)){
				foreach($now_order_list as $k=>$val){
					$money=floatval($val['commission']*$val['num']*0.6);
					if(!empty($money)){
					//判断是否属于频道商品，如果是的话则增加频道总营收和收益
					$result=M("Channel_category_goods")->where("goods_id=".$val['group_id'])->find();
					$result=array_filter($result);
					if(!empty($result)){
						M("Channel")->where("id=".$result['c_id'])->setInc("income",$val['total_money']);
					}
					if(!empty($val['distribution_id'])){
						$uid=substr($val['distribution_id'],(stripos($val['distribution_id'],"_")+1));
						$this->commissionAddMoney($uid,$money,"分销".$val['order_name']."获取佣金");
						M("Channel")->where("id=".$result['c_id'])->setInc("profit",$val['commission']*$val['num']*0.4);
						}else{
						M("Channel")->where("id=".$result['c_id'])->setInc("profit",$val['commission']*$val['num']);
						}
					}else{
						//佣金为空也增加总营收
						M("Channel")->where("id=".$result['c_id'])->setInc("income",$val['total_money']);
					}
				}
				return true;
				}else{
					return false;
				}
			}
			return false;
		}

		$condition_group_order['order_id'] = $order_id;
		$data_group_order['user_confirm'] = 1;
		$data_group_order['is_pay_bill'] = 1;
		if (!($this->where($condition_group_order)->data($data_group_order)->save())) {
			return false;
		}else{
			//如果确认订单则判断是否为分销订单，是的话则修改对应的用户的余额
			//获取当前订单信息
			$now_order=$this->alias("go")->field("go.order_name,go.num,go.group_id,go.distribution_id,go.total_money,g.commission")->join(C('DB_PREFIX')."group g ON go.group_id=g.group_id")->where("go.order_id=".$order_id)->find();
			
			//$uid=substr($now_order['distribution_id'],(stripos($now_order['distribution_id'],"_")+1));
			$money=floatval($now_order['commission']*$now_order['num']*0.6);
			if(!empty($money)){
				//判断是否属于频道商品，如果是的话则增加频道总营收和收益
				$result=M("Channel_category_goods")->where("goods_id=".$now_order['group_id'])->find();
				$result=array_filter($result);
				if(!empty($result)){
					M("Channel")->where("id=".$result['c_id'])->setInc("income",$now_order['total_money']);
				}
				if(!empty($now_order['distribution_id'])){
					$uid=substr($now_order['distribution_id'],(stripos($now_order['distribution_id'],"_")+1));
					$this->commissionAddMoney($uid,$money,"分销".$now_order['order_name']."获取佣金");
					M("Channel")->where("id=".$result['c_id'])->setInc("profit",$now_order['commission']*$now_order['num']*0.4);
				}else{
					M("Channel")->where("id=".$result['c_id'])->setInc("profit",$now_order['commission']*$now_order['num']);
				}
			}else{
				//佣金为空也增加总营收
				M("Channel")->where("id=".$result['c_id'])->setInc("income",$now_order['total_money']);
			}
			return true;
		}
		return false;
	}

	//修改对应分销用户的余额
	private function commissionAddMoney($uid,$money,$desc){
		//先增加余额，在增加对应的用户余额记录
		$condition_user=array("uid"=>$uid);
		D("User")->where($condition_user)->setInc('now_money',$money);
        D("User")->where($condition_user)->setInc('distribute_money',$money);
		if(D('User_money_list')->add_row($uid,1,$money,$desc)){
			return true;
		}else{
			return false;
		}
	}

}
?>