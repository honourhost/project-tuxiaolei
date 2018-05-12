<?php
class PayAction extends BaseAction{
	public function check(){
		if(empty($this->user_session)){
			$this->returnAjax('请先进行登录！',0);
		}
		if(!in_array($_GET['type'],array('group','meal','takeout','food','recharge','appoint'))){
			$this->returnAjax('订单来源无法识别，请重试。',0);
		}
		if($_GET['type'] == 'group'){
			$now_order = D('Group_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']),true);
		}else if($_GET['type'] == 'meal' || $_GET['type'] == 'takeout' || $_GET['type'] == 'food'){
			$now_order = D('Meal_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']),true, $_GET['type']);
		}else if($_GET['type'] == 'recharge'){
			$now_order = D('User_recharge_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']),true);
		}else if($_GET['type'] == 'appoint'){
			$now_order = D('Appoint_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']),true);
		}else{
			$this->returnAjax('非法的订单',0);
		}
		if($now_order['error'] == 1){
			if($now_order['url']){
				$this->returnAjax($now_order['msg'],0);
			}else{
				$this->returnAjax($now_order['msg'],0);
			}
		}
		
		$order_info = $now_order['order_info'];
		$data['order_info']=$order_info;
		$leveloff=isset($order_info['leveloff']) && !empty($order_info['leveloff']) ? unserialize($order_info['leveloff']) : false;
		
		$data['leveloff']=$leveloff;
		$now_user = D('User')->get_user($this->user_session['uid']);
		if(empty($now_user)){
			$this->returnAjax('未获取到您的帐号信息，请重试！',0);
		}
		$now_user['now_money'] = floatval($now_user['now_money']);
		// //如果可用余额大于20则，只取20作为可用余额
		// if(C("PAY_LIMIT")){
		// 	if($now_user['now_money']>C("PAY_LIMIT_NUMBER")){
		// 		$now_user['now_money']=floatval(C("PAY_LIMIT_NUMBER"));
		// 	}
		// }
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
		// if($now_user['now_money']>10){
		// 	$now_user['now_money']=floatval(10);
		// }
		$data['now_user']=$now_user;
		if($_GET['type'] != 'recharge'){
			$pay_money = floatval($order_info['order_total_money']) - floatval($now_user['now_money']);
		}else{
			$pay_money = $order_info['order_total_money'];
		}
		$data['pay_money']=round($pay_money,2);
		
		//调出支付方式
		$notOnline = intval($_GET['notOnline']);
		if($_GET['type'] != 'recharge' && $_GET['type'] != 'appoint'){
			$notOffline = intval($_GET['notOffline']);
		}else{
			$notOffline = 1;
		}
		$pay_method = D('Config')->get_pay_method($notOnline,$notOffline,true);
		// unset($pay_method['weixin']);
		if(empty($pay_method)){
			$this->returnAjax('系统管理员没开启任一一种支付方式！',0);
		}
		$data['pay_method']=$pay_method;

		$address_id=intval($_GET['adress_id']);
        if(empty($address_id)){
		//选择地址信息
        $defaultAdd=D("User_adress")->where("uid=".$this->user_session['uid'])->order("default desc")->find();
        $address = D('User_adress')->get_one_adress($this->user_session['uid'],$defaultAdd['adress_id']);
        }else{
            $address=D("User_adress")->get_one_adress($this->user_session['uid'],$address_id);
        }
        $data['address']=$address;

        $this->returnAjax($data,1);
	}
	//去支付
	public function go_pay(){
		if(empty($this->user_session)){
			$this->returnAjax('请先进行登录！',0);
		}
		if(!in_array($_POST['order_type'],array('group','meal','takeout','food','recharge','appoint','waimai'))){
			$this->returnAjax('订单来源无法识别，请重试。',0);
		}
		if($_POST['order_type'] == 'group'){
			$now_order = D('Group_order')->get_pay_order($this->user_session['uid'],intval($_POST['order_id']));
		}else if($_POST['order_type'] == 'meal' || $_POST['order_type'] == 'takeout' || $_POST['order_type'] == 'food'){
			$now_order = D('Meal_order')->get_pay_order($this->user_session['uid'],intval($_POST['order_id']),true, $_POST['order_type']);
		}else if($_POST['order_type'] == 'recharge'){
			$now_order = D('User_recharge_order')->get_pay_order($this->user_session['uid'],intval($_POST['order_id']),true);
		}else if($_POST['order_type'] == 'appoint'){
			$now_order = D('Appoint_order')->get_pay_order($this->user_session['uid'],intval($_POST['order_id']),true);
		}else if($_POST['order_type'] == 'waimai'){
			$now_order = D('Waimai_order')->get_pay_order($this->user_session['uid'],intval($_POST['order_id']),true);
			if ($now_order['order_info']['pay_type'] !== $_POST['pay_type']) {
				$this->returnAjax('非法的订单',0);
			}
		}else{
			$this->returnAjax('非法的订单',0);
		}
		if($now_order['error'] == 1){
			if($now_order['url']){
				$this->error_tips($now_order['msg'],$now_order['url']);
			}else{
				$this->error_tips($now_order['msg']);
			}
		}
		$order_info = $now_order['order_info'];
		
		//用户信息
		$now_user = D('User')->get_user($this->user_session['uid']);
		if(empty($now_user)){
			$this->returnAjax('未获取到您的帐号信息，请重试！',0);
		}
		
		//如果用户存在余额或使用了优惠券，则保存至订单信息。如果金额满足订单总价，则实时扣除并返回支付成功！若不够则不实时扣除，防止用户在付款过程中取消支付
		if($order_info['order_type'] == 'group'){
			$save_result = D('Group_order')->web_befor_pay($order_info,$now_user);
		}else if($order_info['order_type'] == 'meal' || $order_info['order_type'] == 'takeout' || $order_info['order_type'] == 'food'){
			$save_result = D('Meal_order')->web_befor_pay($order_info,$now_user);
		}else if($order_info['order_type'] == 'recharge'){
			$save_result = D('User_recharge_order')->web_befor_pay($order_info,$now_user);
		}else if($order_info['order_type'] == 'appoint'){
			$save_result = D('Appoint_order')->web_befor_pay($order_info,$now_user);
		}else if($order_info['order_type'] == 'waimai'){
			$save_result = D('Waimai_order')->web_befor_pay($order_info,$now_user);
		}
		
		if($save_result['error_code']){
			$this->returnAjax($save_result['msg'],0);
		}else if($save_result['url']){
			$this->returnAjax($save_result['msg'],0);
		}

		//需要支付的钱
		$pay_money = $save_result['pay_money'];	
		$pay_method = D('Config')->get_pay_method();
		if(empty($pay_method)){
			$this->returnAjax('系统管理员没开启任一一种支付方式！',0);
		}
		if(empty($pay_method[$_POST['pay_type']])){
			$this->returnAjax('您选择的支付方式不存在，请更新支付方式！',0);
		}
		if($order_info['order_type'] == 'recharge' && $_POST['pay_type'] == 'offline'){
			$this->returnAjax('在线充值只能使用在线支付',0);
		}
		$pay_class_name = ucfirst($_POST['pay_type']);
		$import_result = import('@.ORG.pay.'.$pay_class_name);
		if(empty($import_result)){
			$this->returnAjax('系统管理员暂未开启该支付方式，请更换其他的支付方式',0);
		}
		$pay_class = new $pay_class_name($order_info,$pay_money,$_POST['pay_type'],$pay_method[$_POST['pay_type']]['config'],$this->user_session,1);
	    
	    $go_pay_param = $pay_class->app_pay();
	    if(empty($go_pay_param['error'])){
            if($pay_class_name == 'Weixin'){
                $this->returnAjax($go_pay_param['weixin_param'],1);
            }elseif($pay_class_name == 'Alipay'){
                $this->returnAjax($go_pay_param['form'],1);
            }else{
                $this->returnAjax('调用支付发生错误，请重试。',0);
            }
        }else{
            $this->returnAjax($go_pay_param['msg'],0);
        }
	}
}
?>