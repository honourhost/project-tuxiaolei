<?php
class PayAction extends BaseAction{
	public function check(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！',U('Login/index'));
		}
		if(!in_array($_GET['type'],array('group','meal','takeout','food','recharge','appoint'))){
			$this->error_tips('订单来源无法识别，请重试。');
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
			$this->error_tips('非法的订单');
		}
		if($now_order['error'] == 1){
			if($now_order['url']){
				$this->error_tips($now_order['msg'],$now_order['url']);
			}else{
				$this->error_tips($now_order['msg']);
			}
		}
		
		$order_info = $now_order['order_info'];
		$this->assign('order_info',$order_info);
		$leveloff=isset($order_info['leveloff']) && !empty($order_info['leveloff']) ? unserialize($order_info['leveloff']) : false;

		$this->assign('leveloff',$leveloff);
		$now_user = D('User')->get_user($this->user_session['uid']);
		if(empty($now_user)){
			$this->error_tips('未获取到您的帐号信息，请重试！');
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
		$this->assign('now_user',$now_user);
		if($_GET['type'] != 'recharge'){
			$pay_money = floatval($order_info['order_total_money']) - floatval($now_user['now_money']);
		}else{
			$pay_money = $order_info['order_total_money'];
		}
		$this->assign('pay_money',round($pay_money,2));
		
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
			$this->error_tips('系统管理员没开启任一一种支付方式！');
		}
		$this->assign('pay_method',$pay_method);
		
		// $address_id = isset($_GET['adress_id']) ? $_GET['adress_id'] : 0;
		// $address = D('User_adress')->get_order_adress($this->user_session['uid'],$address_id);
		 $address_id=intval($_GET['adress_id']);
        if(empty($address_id)){
        //选择地址信息
        $defaultAdd=D("User_adress")->where("uid=".$this->user_session['uid'])->order("default desc")->find();
        $address = D('User_adress')->get_one_adress($this->user_session['uid'],$defaultAdd['adress_id']);
        }else{
            $address=D("User_adress")->get_one_adress($this->user_session['uid'],$address_id);
        }
		$this->assign('address',$address);
		
		$this->display();
	}
	public function go_pay(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！',U('Login/index'));
		}
		if(!in_array($_GET['order_type'],array('group','meal','takeout','food','recharge','appoint','waimai'))){
			$this->error_tips('订单来源无法识别，请重试。');
		}
		if($_GET['order_type'] == 'group'){
			$now_order = D('Group_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']),true);
		}else if($_GET['order_type'] == 'meal' || $_GET['order_type'] == 'takeout' || $_GET['order_type'] == 'food'){
			$now_order = D('Meal_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']),true, $_GET['order_type']);
		}else if($_GET['order_type'] == 'recharge'){
			$now_order = D('User_recharge_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']),true);
		}else if($_GET['order_type'] == 'appoint'){
			$now_order = D('Appoint_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']),true);
		}else if($_GET['order_type'] == 'waimai'){
			$now_order = D('Waimai_order')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']),true);
			if ($now_order['order_info']['pay_type'] !== $_GET['pay_type']) {
				$this->error_tips('非法的订单');
			}
		}else{
			$this->error_tips('非法的订单');
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
			$this->error_tips('未获取到您的帐号信息，请重试！');
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
			$this->error($save_result['msg']);exit();
		}else if($save_result['url']){
			$this->assign('jumpUrl',$save_result['url']);
			$this->success($save_result['msg']);exit();
		}

		//需要支付的钱
		$pay_money = $save_result['pay_money'];	
		$pay_method = D('Config')->get_pay_method();
		if(empty($pay_method)){
			$this->error_tips('系统管理员没开启任一一种支付方式！');
		}
		if(empty($pay_method[$_GET['pay_type']])){
			$this->error_tips('您选择的支付方式不存在，请更新支付方式！');
		}
		if($order_info['order_type'] == 'recharge' && $_GET['pay_type'] == 'offline'){
			$this->error_tips('在线充值只能使用在线支付');
		}
		$pay_class_name = ucfirst($_GET['pay_type']);
		$import_result = import('@.ORG.pay.'.$pay_class_name);
		if(empty($import_result)){
			$this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
		}
		$pay_class = new $pay_class_name($order_info,$pay_money,$_GET['pay_type'],$pay_method[$_GET['pay_type']]['config'],$this->user_session,0);
		$go_pay_param = $pay_class->mobile_app_pay();
//		json_decode($go_pay_param);
//		json_encode($go_pay_param);die;
		print_r($go_pay_param);
		if(empty($go_pay_param['error'])){
			if($pay_class_name == 'Weixin'){
				$this->success($go_pay_param['qrcode']);
				exit;
			}else if(!empty($go_pay_param['url'])){
				$this->assign('url',$go_pay_param['url']);
			}else if(!empty($go_pay_param['form'])){
				$this->assign('form',$go_pay_param['form']);
			}else{
				$this->error_tips('调用支付发生错误，请重试。');
			}
		}else{
			$this->error_tips($go_pay_param['msg']);
		}
		
		$this->display();
	}
	
	//异步通知
	public function notify_url(){
		$pay_method = D('Config')->get_pay_method();
		if(empty($pay_method)){
			$this->error_tips('系统管理员没开启任一一种支付方式！');
		}
		if(empty($pay_method[$_GET['pay_type']])){
			$this->error_tips('您选择的支付方式不存在，请更新支付方式！');
		}
		
		$pay_class_name = ucfirst($_GET['pay_type']);
		$import_result = import('@.ORG.pay.'.$pay_class_name);
		if(empty($import_result)){
			$this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
		}
		
		$pay_class = new $pay_class_name('','',$_GET['pay_type'],$pay_method[$_GET['pay_type']]['config'],$this->user_session,0);
		$notify_return = $pay_class->notice_url();
		
		if(empty($notify_return['error'])){

		}else{
			$this->error_tips($notify_return['msg']);
		}
	}
	
	//跳转通知
	public function return_url(){
		$pay_type = $_GET['pay_type'];
		$pay_method = D('Config')->get_pay_method();
		if(empty($pay_method)){
			$this->error_tips('系统管理员没开启任一一种支付方式！');
		}
		if(empty($pay_method[$pay_type])){
			$this->error_tips('您选择的支付方式不存在，请更新支付方式！');
		}

		$pay_class_name = ucfirst($pay_type);
		$import_result = import('@.ORG.pay.'.$pay_class_name);
		if(empty($import_result)){
			$this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
		}
	
		$pay_class = new $pay_class_name('','',$pay_type,$pay_method[$pay_type]['config'],$this->user_session,0);
		$get_pay_param = $pay_class->return_url();
		if(empty($get_pay_param['error'])){
			if($get_pay_param['order_param']['order_type'] == 'group'){
				$pay_info = D('Group_order')->after_pay($get_pay_param['order_param']);			
			}else if($get_pay_param['order_param']['order_type'] == 'meal' || $get_pay_param['order_param']['order_type'] == 'takeout' || $get_pay_param['order_param']['order_type'] == 'food'){
				$pay_info = D('Meal_order')->after_pay($get_pay_param['order_param']);			
			}else if($get_pay_param['order_param']['order_type'] == 'recharge'){
				$pay_info = D('User_recharge_order')->after_pay($get_pay_param['order_param']);			
			}else if($get_pay_param['order_param']['order_type'] == 'appoint'){
				$pay_info = D('Appoint_order')->after_pay($get_pay_param['order_param']);			
			}else if($get_pay_param['order_param']['order_type'] == 'waimai'){
				$pay_info = D('Waimai_order')->after_pay($get_pay_param['order_param']);			
			}else{
				$this->error_tips('订单类型非法！请重新下单。');
			}
			// if($get_pay_param['order_param']['pay_type'] == 'yeepay' && $pay_info['url']){
				// $pay_info['url'] = str_replace('/source/web_yeepay.php','/index.php',$pay_info['url']);
			// }
			if($pay_info['url']){
				$pay_info['url'] = preg_replace('#/source/(\w+).php#','/index.php',$pay_info['url']);
			} 
			if(empty($pay_info['error'])){
				if($get_pay_param['order_param']['pay_type'] == 'weixin'){
					exit('<xml><return_code><![CDATA[SUCCESS]]></return_code></xml>');
				}
				if(!empty($pay_info['url'])){
					$this->assign('jumpUrl',$pay_info['url']);
					$this->success('订单付款成功！现在跳转.');
					exit();
				}
			}
			if(empty($pay_info['url'])){
				$this->error_tips($pay_info['msg']);
			}else{
				$this->error_tips($pay_info['msg'],$pay_info['url']);
			}
		}else{
			$this->error_tips($get_pay_param['msg']);
		}
	}
	//微信同步回调页面
	public function weixin_back(){
		switch($_GET['order_type']){
			case 'group':
				$now_order = D('Group_order')->get_order_by_id($this->user_session['uid'],intval($_GET['order_id']));
				break;
			case 'meal':
			case 'takeout':
			case 'food':
				$now_order = D('Meal_order')->get_order_by_id($this->user_session['uid'],intval($_GET['order_id']));
				break;
			case 'recharge':
				$now_order = D('User_recharge_order')->get_order_by_id($this->user_session['uid'],intval($_GET['order_id']));
				break;
			case 'appoint':
				$now_order = D('Appoint_order')->get_order_by_id($this->user_session['uid'],intval($_GET['order_id']));
				break;
			case 'waimai':
				$now_order = D('Waimai_order')->get_order_by_id($this->user_session['uid'],intval($_GET['order_id']));
			default:
				$this->error_tips('非法的订单');
		}
		$now_order['order_type'] = $_GET['order_type'];
		if(empty($now_order)){
			$this->error_tips('该订单不存在');
		}
		if($now_order['paid']){
			switch($_GET['order_type']){
				case 'group':
					$redirctUrl = C('config.site_url').'/index.php?g=User&c=Index&a=group_order_view&order_id='.$now_order['order_id'];
					break;
				case 'meal':
				case 'takeout':
				case 'food':
					$redirctUrl = C('config.site_url').'/index.php?g=User&c=Index&a=meal_order_view&order_id='.$now_order['order_id'];
					break;
				case 'recharge':
					$redirctUrl = C('config.site_url').'/index.php?g=User&c=Credit&a=index';
					break;
				case 'appoint':
					$redirctUrl = C('config.site_url').'/index.php?g=User&c=Index&a=appoint_order_view&order_id='.$now_order['order_id'];
					break;
				case 'waimai':
					$redirctUrl = C('config.site_url').'/index.php?g=Waimai&c=Order&a=detail&order_id='.$now_order['order_id'];
					break;
			}
			redirect($redirctUrl);exit;
		}
		$import_result = import('@.ORG.pay.Weixin');
		$pay_method = D('Config')->get_pay_method();
		if(empty($pay_method)){
			$this->error_tips('系统管理员没开启任一一种支付方式！');
		}
		$pay_class = new Weixin($now_order,0,'weixin',$pay_method['weixin']['config'],$this->user_session,1);
		$go_query_param = $pay_class->query_order();
		if($go_query_param['error'] === 0){
			switch($_GET['order_type']){
				case 'group':
					D('Group_order')->after_pay($go_query_param['order_param']);
					break;
				case 'meal':
				case 'takeout':
				case 'food':
					D('Meal_order')->after_pay($go_query_param['order_param']);
					break;
				case 'recharge':
					D('User_recharge_order')->after_pay($go_query_param['order_param']);
					break;
				case 'appoint':
					D('Appoint_order')->after_pay($go_query_param['order_param']);
					break;
				case 'waimai':
					D('Appoint_order')->after_pay($go_query_param['order_param']);
					break;
			}
		}
		switch($_GET['order_type']){
			case 'group':
				$redirctUrl = C('config.site_url').'/index.php?g=User&c=Index&a=group_order_view&order_id='.$now_order['order_id'];
				break;
			case 'meal':
				$redirctUrl = C('config.site_url').'/index.php?g=User&c=Index&a=meal_order_view&order_id='.$now_order['order_id'];
				break;
			case 'recharge':
				$redirctUrl = C('config.site_url').'/index.php?g=User&c=Credit&a=index';
				break;
			case 'appoint':
				$redirctUrl = C('config.site_url').'/index.php?g=User&c=Index&a=appoint_order_view&order_id='.$now_order['order_id'];
				break;
			case 'waimai':
				$redirctUrl = C('config.site_url').'/index.php?g=Waimai&c=Order&a=detail&order_id='.$now_order['order_id'];
				break;
		}
		redirect($redirctUrl);
	}
	//支付宝支付同步回调
	public function alipay_return(){
		$order_id_arr = explode('_',$_GET['out_trade_no']);				
		$order_type = $order_id_arr[0];
		$order_id = $order_id_arr[1];
		switch($order_type){
			case 'group':
				$now_order = D('Group_order')->where(array('order_id'=>$order_id))->find();
				break;
			case 'meal':
			case 'takeout':
			case 'food':
				$now_order = D('Meal_order')->where(array('order_id'=>$order_id))->find();
				break;
			case 'recharge':
				$now_order = D('User_recharge_order')->where(array('order_id'=>$order_id))->find();
				break;
			case 'appoint':
				$now_order = D('Appoint_order')->where(array('order_id'=>$order_id))->find();
				break;
			case 'waimai':
				$now_order = D('Waimai_order')->where(array('order_id'=>$order_id))->find();
				break;
			default:
				$this->error('非法的订单');
		}
		if($now_order['paid']){
			switch($order_type){
				case 'group':
					$redirctUrl = C('config.site_url').'/index.php?g=User&c=Index&a=group_order_view&order_id='.$now_order['order_id'];
					break;
				case 'meal':
				case 'takeout':
				case 'food':
					$redirctUrl = C('config.site_url').'/index.php?g=User&c=Index&a=meal_order_view&order_id='.$now_order['order_id'];
					break;
				case 'recharge':
					$redirctUrl = C('config.site_url').'/index.php?g=User&c=Credit&a=index';
					break;
				case 'appoint':
					$redirctUrl = C('config.site_url').'/index.php?g=User&c=Index&a=appoint_order_view&order_id='.$now_order['order_id'];
					break;
				case 'waimai':
					$redirctUrl = C('config.site_url').'/index.php?g=Waimai&c=Order&a=detail&order_id='.$now_order['order_id'];
					break;
			}
			redirect($redirctUrl);exit;
		}
		$pay_method = D('Config')->get_pay_method();
		if(empty($pay_method)){
			$this->error_tips('系统管理员没开启任一一种支付方式！');
		}
		$import_result = import('@.ORG.pay.Alipay');
		$pay_class = new Alipay('','',$pay_type,$pay_method['alipay']['config'],$this->user_session,0);
		$go_query_param = $pay_class->query_order();
		if($go_query_param['error'] === 0){
			switch($order_type){
				case 'group':
					D('Group_order')->after_pay($go_query_param['order_param']);
					break;
				case 'meal':
				case 'takeout':
				case 'food':
					D('Meal_order')->after_pay($go_query_param['order_param']);
					break;
				case 'recharge':
					D('User_recharge_order')->after_pay($go_query_param['order_param']);
					break;
				case 'appoint':
					D('Appoint_order')->after_pay($go_query_param['order_param']);
					break;
				case 'waimai':
					D('Waimai_order')->after_pay($go_query_param['order_param']);
					break;
			}
		}
		switch($order_type){
			case 'group':
				$redirctUrl = C('config.site_url').'/index.php?g=User&c=Index&a=group_order_view&order_id='.$now_order['order_id'];
				break;
			case 'meal':
			case 'takeout':
			case 'food':
				$redirctUrl = C('config.site_url').'/index.php?g=User&c=Index&a=meal_order_view&order_id='.$now_order['order_id'];
				break;
			case 'recharge':
				$redirctUrl = C('config.site_url').'/index.php?g=User&c=Credit&a=index&order_id='.$now_order['order_id'];
				break;
			case 'appoint':
				$redirctUrl = C('config.site_url').'/index.php?g=User&c=Index&a=appoint_order_view&order_id='.$now_order['order_id'];
				break;
			case 'waimai':
				$redirctUrl = C('config.site_url').'/index.php?g=Waimai&c=Order&a=detail&order_id='.$now_order['order_id'];
				break;
		}
		redirect($redirctUrl);
	}
}
?>