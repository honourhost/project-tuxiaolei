<?php
//定时执行修改订单的确认状态的代码
class ScheduleAction extends BaseAction{
	public function changeConfirm(){
		//首先查看处于消费状态的订单，status in (1,2)中是否有use_time小于time()-15*24*60*60秒之前并且没有经过用户确认的信息，将这些订单的用户确认直接改为1
		//先查出未修改订单状态的订单，然后执行订单确认（这里只针对特卖）
		$Group_order=D("Group_order");
		
		$group_order_list=$Group_order->where(array('pay_type' => array('NEQ', 'offline'), 'paid' => 1, 'status' => array('in', '1, 2'),'use_time'=>array('LT',time()-15*24*60*60),"user_confirm"=>0))->select();
		
		foreach($group_order_list as $key=>$val){
			$Group_order->orderConfirm($val['order_id']);
		}
		$result1=D('Meal_order')->where(array('paid' => 1, 'pay_type' => array('NEQ', 'offline'), 'status' => array('in', '1, 2'),'use_time'=>array('LT',time()-15*24*60*60),"user_confirm"=>0))->setField(array("user_confirm"=>1,"is_pay_bill"=>1));
		//$result2=D('Group_order')->where(array('pay_type' => array('NEQ', 'offline'), 'paid' => 1, 'status' => array('in', '1, 2'),'use_time'=>array('LT',time()-15*24*60*60),"user_confirm"=>0))->setField(array("user_confirm"=>1,"is_pay_bill"=>1));
		echo "完成";
	}

	public function cancleOrder(){
		$result2=M("Group_order")->where(array('pay_type' => array('NEQ', 'offline'), 'paid' => 0, 'status' => 0,'add_time'=>array('LT',time()-3*24*60*60),"user_confirm"=>0))->setField(array("status"=>4));
		
		$result1=M('Meal_order')->where(array('paid' => 0, 'pay_type' => array('NEQ', 'offline'), 'status' => 0,'add_time'=>array('LT',time()-3*24*60*60),"user_confirm"=>0))->setField(array("status"=>3));
		
		echo "Finish!!";
	}

	//先查询是否存在到期的拼团,存在则走退款程序
    public function checkGroupBuy(){
        $now=time();
        $lttime=$now-24*60*60;
 	    $gttime=$now-48*60*60;
        $where['status']=0;
        $group_buys=M("Group_buy")->where("create_time>".$gttime." AND create_time<".$lttime." AND status=0")->select();
        if(!empty($group_buys)){
            foreach($group_buys as $k=>$v){
                $this->groupRefund($v['sun_id']);
            }
        }
    }
	//定时取消订单然后退款
    private function groupRefund($group_buy_id){
        if(empty($group_buy_id)){
            return false;
        }
        $where['sun_id']=$group_buy_id;
        $where['paid']=1;
        $where['third_id']=array("NEQ","");
        //查出所有该拼团的订单
        $groups=M("group_order")->where($where)->select();
        if(!empty($groups)) {
            //退订单
            foreach ($groups as $k => $val) {
                $this->refundOrder($val['order_id'], $val['uid']);
            }
	    //完成之后修改拼团状态为结束
            $conditionwhere['sun_id']=$group_buy_id;
            M("GroupBuy")->where($conditionwhere)->setField("status",2);
        }
    }
    //退款流程，并且将错误日志记录
    private function refundOrder($order_id,$uid){

        $now_order = D('Group_order')->get_order_detail_by_id($uid,intval($order_id),true);

        import('@.ORG.log.GroupBuyLog');
        $groupLog=new GroupBuyLog();
        if(empty($now_order)){
            $groupLog->insertLog($now_order['uid'],$now_order['order_id'],'当前订单不存在');
        }
        if(empty($now_order['paid'])){
            $groupLog->insertLog($now_order['uid'],$now_order['order_id'],'当前订单还未付款！');
        }
        if(!empty($now_order['status'])){
            $groupLog->insertLog($now_order['uid'],$now_order['order_id'],'订单必须是未消费状态才能取消！');
        }
        //在线付款退款
        if($now_order['pay_type'] == 'offline'){
            $data_group_order['order_id'] = $now_order['order_id'];
            $data_group_order['refund_detail'] = serialize(array('refund_time'=>time()));
            $data_group_order['status'] = 3;
            if(D('Group_order')->data($data_group_order)->save()){
                $groupLog->insertLog($now_order['uid'],$now_order['order_id'],'使用的是线下支付！订单状态已修改为已退款。');
                exit;
            }else{
                $groupLog->insertLog($now_order['uid'],$now_order['order_id'],'取消订单失败！请重试。');
            }
        }
        if($now_order['payment_money'] != '0.00'){
            $pay_method = D('Config')->get_pay_method();
            if(empty($pay_method)){
                $groupLog->insertLog($now_order['uid'],$now_order['order_id'],'系统管理员没开启任一一种支付方式！');
            }
            if(empty($pay_method[$now_order['pay_type']])){
                $groupLog->insertLog($now_order['uid'],$now_order['order_id'],'选择的支付方式不存在，请更新支付方式！');
            }

            $pay_class_name = ucfirst($now_order['pay_type']);
            $import_result = import('@.ORG.pay.'.$pay_class_name);
            if(empty($import_result)){
                $groupLog->insertLog($now_order['uid'],$now_order['order_id'],'系统管理员暂未开启该支付方式，请更换其他的支付方式');
            }
            $now_order['order_type'] = 'group';
            $pay_class = new $pay_class_name($now_order,$now_order['payment_money'],$now_order['pay_type'],$pay_method[$now_order['pay_type']]['config'],$this->user_session,1);
            $go_refund_param = $pay_class->refund();
            $data_group_order['order_id'] = $now_order['order_id'];
            $data_group_order['refund_detail'] = serialize($go_refund_param['refund_param']);
            if(empty($go_refund_param['error']) && $go_refund_param['type'] == 'ok'){
                $data_group_order['status'] = 3;
            }
            D('Group_order')->data($data_group_order)->save();
            if($data_group_order['status'] != 3){
                $groupLog->insertLog($now_order['uid'],$now_order['order_id'],$go_refund_param['msg']);
            }
        }

        //退款时销量回滚
        D('Group')->where(array('group_id' => $now_order['group_id']))->setDec('sale_count', $now_order['num']);

        //短信提醒
        $sms_data = array('mer_id' => $now_order['mer_id'], 'store_id' => 0, 'type' => 'group');
        if ($this->config['sms_cancel_order'] == 1 || $this->config['sms_cancel_order'] == 3) {
            $sms_data['uid'] = $now_order['uid'];
            $sms_data['mobile'] = $now_order['phone'];
            $sms_data['sendto'] = 'user';
            $sms_data['content'] = '您购买 '.$now_order['order_name'].'的订单(订单号：' . $now_order['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已被您取消并退款，欢迎再次光临！';
            Sms::sendSms($sms_data);
        }
        if ($this->config['sms_cancel_order'] == 2 || $this->config['sms_cancel_order'] == 3) {
            $merchant = D('Merchant')->where(array('mer_id' => $now_order['mer_id']))->find();
            $sms_data['uid'] = 0;
            $sms_data['mobile'] = $merchant['phone'];
            $sms_data['sendto'] = 'merchant';
            $sms_data['content'] = '顾客购买的' . $now_order['order_name'] . '的订单(订单号：' . $now_order['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已被客户取消并退款！';
            Sms::sendSms($sms_data);
        }
    }
}

