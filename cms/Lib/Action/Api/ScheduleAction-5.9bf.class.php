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
}

