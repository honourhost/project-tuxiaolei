<?php
class PayAction extends BaseAction{
	public function check(){
		if(empty($this->merchant_session["mer_id"])){
			$this->error_tips('请先进行登录！',U('Login/index'));
		}
		if(!in_array($_GET['type'],array('group','meal','takeout','food','merchant_recharge','appoint'))){
			$this->error_tips('订单来源无法识别，请重试。');
		}
		if($_GET['type'] == 'merchant_recharge'){
			$now_order = D('Merchant_recharge_order')->get_pay_order( $this->merchant_session["mer_id"],intval($_GET['order_id']),true);
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
		$now_merchant = D('Merchant')->get_info($this->merchant_session["mer_id"]);
		if(empty($now_merchant)){
			$this->error_tips('未获取到您的帐号信息，请重试！');
		}
		$this->assign('now_merchant',$now_merchant);
		//因为是充值，直接输出支付金额
		$pay_money = $order_info['order_total_money'];
		$this->assign('pay_money',$pay_money);
		
		//调出支付方式
		$notOnline = intval($_GET['notOnline']);
		if($_GET['type'] != 'merchant_recharge' && $_GET['type'] != 'appoint'){
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
		$this->display();
	}
	public function go_pay(){
		if(empty($this->merchant_session["mer_id"])){
			$this->error('请先进行登录！',U('Login/index'));
		}
		if(!in_array($_POST['order_type'],array('group','meal','takeout','food','merchant_recharge','appoint','waimai'))){
			$this->error('订单来源无法识别，请重试。');
		}
		if($_POST['order_type'] == 'group'){
			$now_order = D('Group_order')->get_pay_order($this->user_session['uid'],intval($_POST['order_id']),true);
		}else if($_POST['order_type'] == 'meal' || $_POST['order_type'] == 'takeout' || $_POST['order_type'] == 'food'){
			$now_order = D('Meal_order')->get_pay_order($this->user_session['uid'],intval($_POST['order_id']),true, $_POST['order_type']);
		}else if($_POST['order_type'] == 'merchant_recharge'){
			$now_order = D('Merchant_recharge_order')->get_pay_order($this->merchant_session["mer_id"],intval($_POST['order_id']),true);
		}else if($_POST['order_type'] == 'appoint'){
			$now_order = D('Appoint_order')->get_pay_order($this->user_session['uid'],intval($_POST['order_id']),true);
		}else if($_POST['order_type'] == 'waimai'){
			$now_order = D('Waimai_order')->get_pay_order($this->user_session['uid'],intval($_POST['order_id']),true);
			if ($now_order['order_info']['pay_type'] !== $_POST['pay_type']) {
				$this->error('非法的订单');
			}
		}else{
			$this->error('非法的订单');
		}
		if($now_order['error'] == 1){
			if($now_order['url']){
				$this->error($now_order['msg'],$now_order['url']);
			}else{
				$this->error($now_order['msg']);
			}
		}
		$order_info = $now_order['order_info'];
		
		//用户信息
		$now_merchant = D('Merchant')->get_info($this->merchant_session["mer_id"]);
		if(empty($now_merchant)){
			$this->error('未获取到您的帐号信息，请重试！');
		}
		
		//如果用户存在余额或使用了优惠券，则保存至订单信息。如果金额满足订单总价，则实时扣除并返回支付成功！若不够则不实时扣除，防止用户在付款过程中取消支付
		if($order_info['order_type'] == 'group'){
			$save_result = D('Group_order')->web_befor_pay($order_info,$now_merchant);
		}else if($order_info['order_type'] == 'meal' || $order_info['order_type'] == 'takeout' || $order_info['order_type'] == 'food'){
			$save_result = D('Meal_order')->web_befor_pay($order_info,$now_merchant);
		}else if($order_info['order_type'] == 'merchant_recharge'){
			$save_result = D('Merchant_recharge_order')->web_befor_pay($order_info,$now_merchant);
		}else if($order_info['order_type'] == 'appoint'){
			$save_result = D('Appoint_order')->web_befor_pay($order_info,$now_merchant);
		}else if($order_info['order_type'] == 'waimai'){
			$save_result = D('Waimai_order')->web_befor_pay($order_info,$now_merchant);
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
			$this->error('系统管理员没开启任一一种支付方式！');
		}
		if(empty($pay_method[$_POST['pay_type']])){
			$this->error('您选择的支付方式不存在，请更新支付方式！');
		}
		if($order_info['order_type'] == 'merchant_recharge' && $_POST['pay_type'] == 'offline'){
			$this->error('在线充值只能使用在线支付');
		}
		$pay_class_name = ucfirst($_POST['pay_type']);
		$import_result = import('@.ORG.pay.'.$pay_class_name);
		if(empty($import_result)){
			$this->error('系统管理员暂未开启该支付方式，请更换其他的支付方式');
		}
		$pay_class = new $pay_class_name($order_info,$pay_money,$_POST['pay_type'],$pay_method[$_POST['pay_type']]['config'],$this->merchant_session,0);

		$go_pay_param = $pay_class->pay();
		
		if(empty($go_pay_param['error'])){
			if($pay_class_name == 'Weixin'){
				$this->success($go_pay_param['qrcode']);
				exit;
			}else if(!empty($go_pay_param['url'])){
				$this->assign('url',$go_pay_param['url']);
			}else if(!empty($go_pay_param['form'])){
				$this->assign('form',$go_pay_param['form']);
			}else{
				$this->error('调用支付发生错误，请重试。');
			}
		}else{
			$this->error($go_pay_param['msg']);
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
		
		$pay_class = new $pay_class_name('','',$_GET['pay_type'],$pay_method[$_GET['pay_type']]['config'],$this->merchant_session,0);
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
	
		$pay_class = new $pay_class_name('','',$pay_type,$pay_method[$pay_type]['config'],$this->merchant_session,0);
		$get_pay_param = $pay_class->return_url();
		if(empty($get_pay_param['error'])){
			if($get_pay_param['order_param']['order_type'] == 'group'){
				$pay_info = D('Group_order')->after_pay($get_pay_param['order_param']);			
			}else if($get_pay_param['order_param']['order_type'] == 'meal' || $get_pay_param['order_param']['order_type'] == 'takeout' || $get_pay_param['order_param']['order_type'] == 'food'){
				$pay_info = D('Meal_order')->after_pay($get_pay_param['order_param']);			
			}else if($get_pay_param['order_param']['order_type'] == 'merchant_recharge'){
				$pay_info = D('Merchant_recharge_order')->after_pay($get_pay_param['order_param']);
			}else if($get_pay_param['order_param']['order_type'] == 'appoint'){
				$pay_info = D('Appoint_order')->after_pay($get_pay_param['order_param']);			
			}else if($get_pay_param['order_param']['order_type'] == 'waimai'){
				$pay_info = D('Waimai_order')->after_pay($get_pay_param['order_param']);			
			}else{
				$this->error_tips('订单类型非法！请重新下单。');
			}

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
			case 'merchant_recharge':
				$now_order = D('Merchant_recharge_order')->get_order_by_id($this->merchant_session["mer_id"],intval($_GET['order_id']));
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
				case 'merchant_recharge':
					$redirctUrl = C('config.site_url').'/merchant.php?g=Merchant&c=Merchant&a=depositeReturn&order_id='.$now_order['order_id'];
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
		$pay_class = new Weixin($now_order,0,'weixin',$pay_method['weixin']['config'],$this->merchant_session,1);
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
				case 'merchant_recharge':
					D('Merchant_recharge_order')->after_pay($go_query_param['order_param']);
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
			case 'merchant_recharge':
				$redirctUrl = C('config.site_url').'/merchant.php?g=Merchant&c=Merchant&a=depositeReturn&order_id='.$now_order['order_id'];
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
		/*$order_type = $order_id_arr[0];
		$order_id = $order_id_arr[1];*/
		$order_type = $order_id_arr[0].'_'.$order_id_arr[1];
		$order_id = $order_id_arr[2];
		switch($order_type){
			case 'group':
				$now_order = D('Group_order')->where(array('order_id'=>$order_id))->find();
				break;
			case 'meal':
			case 'takeout':
			case 'food':
				$now_order = D('Meal_order')->where(array('order_id'=>$order_id))->find();
				break;
			case 'merchant_recharge':
				$now_order = D('Merchant_recharge_order')->where(array('order_id'=>$order_id))->find();
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
				case 'merchant_recharge':
					$redirctUrl = C('config.site_url').'/merchant.php?g=Merchant&c=Merchant&a=depositeReturn&order_id='.$now_order['order_id'];
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
		$pay_class = new Alipay('','','',$pay_method['alipay']['config'],$this->merchant_session,0);
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
				case 'merchant_recharge':
					D('Merchant_recharge_order')->after_pay($go_query_param['order_param']);
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
			case 'merchant_recharge':
				$redirctUrl = C('config.site_url').'/merchant.php?g=Merchant&c=Merchant&a=depositeReturn&order_id='.$now_order['order_id'];
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

	//测试
    //重新缴纳押金的页面
    public function bzj(){
        $this->display();
    }
}
?>