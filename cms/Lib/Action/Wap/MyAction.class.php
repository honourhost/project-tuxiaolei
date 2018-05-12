<?php
class MyAction extends BaseAction{
	public $now_user;
	public $user_level;

    protected  $juhekey="85f3f4d77da5feccd2035db1fdc3ace1";
    protected  $baseurl="http://v.juhe.cn/exp/index?";
	public function __construct(){
		parent::__construct();

		if(empty($this->user_session)){
			$location_param['referer'] = urlencode($_SERVER['REQUEST_URI']);
			redirect(U('Login/index',$location_param));
		}
		
		$now_user = D('User')->get_user($this->user_session['uid']);
		if(empty($now_user)){
			session('user',null);
			$this->error_tips('未获取到您的帐号信息，请重新登录！',U('Login/index'));
		}
		$now_user['now_money'] = floatval($now_user['now_money']);
		$this->now_user = $now_user;
		if(strstr($now_user['avatar'],",")) {
		$avatar_image_class = new avatar_image();
		
		$image= $avatar_image_class->get_image_by_path($now_user['avatar'], C('config.site_url'));
		$now_user['avatar']=$image['s_image'];
		}
		$this->assign('now_user',$now_user);
		$levelDb=M('User_level');
		$tmparr=$levelDb->where('22=22')->order('id ASC')->select();
		$levelarr=array();
		if($tmparr){
		   foreach($tmparr as $vv){
		      $levelarr[$vv['level']]=$vv;
		   }
		}
		
		$this->user_level=$levelarr;
		unset($tmparr,$levelarr);
		$this->assign('levelarr', $this->user_level);
	}
	public function index(){
		/*if($this->config['im_appid'] && $_SESSION['openid']){
			redirect(U('Api/go_im',array('hash'=>'myList','title'=>urlencode('会员中心'))));
            exit;
		}*/
		if($_GET['secret']==66588){
		$this->assign("show",1);
		}

		if($_GET['secret618']==20170618){
            $this->assign("show",1);
        }

		$this->display();
	}
	public function index_new(){
		$this->display();
	}
	public function myinfo(){
		$this->display();
	}
	public function username(){
		if(IS_POST){
			if(empty($_POST['nickname'])){
				$this->assign('error','请输入新用户名！');
			}else if($_POST['nickname'] == $this->now_user['nickname']){
				$this->assign('error','您还没有修改用户名！');
			}else{
				$result = D('User')->save_user($this->now_user['uid'],'nickname',$_POST['nickname']);
				if($result['error']){
					$this->assign('error',$result['msg']);
				}else{
					redirect(U('My/myinfo',array('OkMsg'=>urlencode('昵称修改成功'))));
				}
			}
		}
		$this->display();
	}
	public function password(){
		if(IS_POST){
			if(!empty($this->now_user['pwd']) && md5($_POST['currentpassword']) != $this->now_user['pwd']){
				$this->assign('error','当前密码输入错误！');
			}else if($_POST['currentpassword'] == $_POST['password']){
				$this->assign('error','新密码不能和当前密码相同！');
			}else if($_POST['password2'] != $_POST['password']){
				$this->assign('error','两次新密码输入不一致！');
			}else{
				$result = D('User')->save_user($this->now_user['uid'],'pwd',md5($_POST['password']));
				if($result['error']){
					$this->assign('error',$result['msg']);
				}else{
					redirect(U('My/myinfo',array('OkMsg'=>urlencode('密码修改成功'))));
				}
			}
		}
		$this->display();
	}
	public function bind_user(){
		if(IS_POST){
			if(!empty($this->now_user['phone'])){
				$_SESSION['user']['phone'] = $this->now_user['phone'];
				$this->error('您已经绑定过手机号！不允许多次绑定。');
			}
			if(empty($_POST['phone'])){
				$this->error('请输入手机号码！');
			}
			if(empty($_POST['password'])){
				$this->error('请输入密码！');
			}
			$database_user = D('User');
			$condition_user['phone'] = $_POST['phone'];
			if($exituser=$database_user->where($condition_user)->find()){
				//$this->error('手机号码已经存在！');
				//更新已有的手机用户
				foreach($exituser as $key=>$val){
					if(empty($exituser[$key])){
						if(!empty($this->now_user[$key])){
							$exituser[$key]=$this->now_user[$key];
						}
					}
				}
				//更新数据库
				$result=$database_user->save($exituser);
				if($result){
				//合并之后将之前用户的订单相关信息改成当前用户
				M("Group_order")->where("uid=".$this->now_user['uid'])->setField("uid",$exituser['uid']);
				M("Meal_order")->where("uid=".$this->now_user['uid'])->setField("uid",$exituser['uid']);
				//将原用户的地址改为现在用户的，并删除用户的默认地址
				M("User_adress")->where("uid=".$this->now_user['uid'])->setField(array("uid"=>$exituser['uid'],"default"=>0));
				//删除原来的微信用户
				if($database_user->where($this->now_user)->delete()){

				//如果已经存在手机号在APP注册过，将微信用户删除然后合并到已有的手机用户中，当然必须重新登录
				$this->now_user = $exituser;
				session('user', $now_user);
				$this->user_session = session('user');
				$this->success('手机号码绑定成功,因为属于已经存在的账号，密码依旧按照原手机号密码！');
				}else{
					$this->error("未成功绑定账号！！");
				}
				}else{
					$this->error("绑定手机出错！！");
				}
			}
			$condition_save_user['uid'] = $this->now_user['uid'];

			$data_save_user['phone'] = $_POST['phone'];
			$data_save_user['pwd'] = md5($_POST['password']);
			if($database_user->where($condition_save_user)->data($data_save_user)->save()){
				$_SESSION['user']['phone'] = $_POST['phone'];
				$this->success('手机号码绑定成功,因为属于已经存在的账号，密码依旧按照原手机号密码！');
			}else{
				$this->error('手机号码绑定失败！请重试。');
			}
		}
		if(!empty($this->now_user['phone'])){
			$this->error_tips('您已经绑定过手机号！不允许多次绑定。');
		}
		$referer = !empty($_GET['referer']) ? $_GET['referer'] : $_SERVER['HTTP_REFERER'];
		$this->assign('referer',$referer);
		$this->display();
	}
	/*优惠券操作*/
	public function card(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		
		$coupon_list = D('Member_card_coupon')->get_all_coupon($this->user_session['uid']);
		$this->assign('coupon_list',$coupon_list);
		
		$this->display();
	}
	
	/*选择优惠券*/
	public function select_card(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		
		//以下代码是为了得到商户的mer_id ，并且判断此订单是否存在！
		if($_GET['type'] == 'group'){
			$now_order = D('Group_order')->get_order_by_id($this->user_session['uid'],$_GET['order_id']);
		}else if($_GET['type'] == 'meal' || $_GET['type'] == 'food' || $_GET['type'] == 'takeout'){
			$now_order = D('Meal_order')->get_order_by_id($this->user_session['uid'],$_GET['order_id']);
		}else if($_GET['type'] == 'weidian'){
			$now_order = D('Weidian_order')->get_order_by_id($this->user_session['uid'],$_GET['order_id']);
		}else if($_GET['type'] == 'appoint'){
			$now_order = D('Appoint_order')->get_order_by_id($this->user_session['uid'],$_GET['order_id']);
		}else{
			$this->error_tips('来源非法，请检查后再访问。');
		}
		if(empty($now_order)){
			$this->error_tips('当前订单不存在！');
		}
		
		$this->assign('back_url',U('Pay/check',$_GET));
		
		$card_list = D('Member_card_coupon')->get_coupon($now_order['mer_id'],$this->user_session['uid']);
		if(!empty($card_list)){
			$param = $_GET;
			foreach($card_list as &$value){
				$param['card_id'] =$value['record_id'];
				$value['select_url'] = U('Pay/check',$param);
			}
			$this->assign('card_list',$card_list);
		}
		$this->display();
	}
	
	/*地址操作*/
	public function adress(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$adress_list = D('User_adress')->get_adress_list($this->user_session['uid']);

		if(empty($adress_list)){
			redirect(U('My/edit_adress',$_GET));
		}else{
			if($_GET['group_id']){
				$select_url = 'Group/buy';
			} elseif ($_GET['store_id']) {
				if ($_GET['buy_type'] == 'waimai') {
					$select_url = 'Takeout/sureOrder';
				} else {
					$select_url = 'Meal/cart';
				}
			}elseif($_GET["gradeid"]){
                $select_url = 'Crowdgrade/buy';
            }

			if($select_url){
				$this->assign('back_url',U($select_url,$_GET));
			}else{
				$this->assign('back_url',U('My/myinfo'));
			}
			
			$param = $_GET;
				
			foreach($adress_list as $key=>$value){
				$param['adress_id'] = $value['adress_id'];
				if(!empty($select_url)){
					$adress_list[$key]['select_url'] = U($select_url,$param);
				}
				$adress_list[$key]['edit_url'] = U('My/edit_adress',$param);
				$adress_list[$key]['del_url'] = U('My/del_adress',$param);
			}
			
			
			$this->assign('adress_list',$adress_list);
			$this->display();
		}
	}
	/*添加编辑地址*/
	public function edit_adress(){
		if(IS_POST){
			if(D('User_adress')->post_form_save($this->user_session['uid'])){
				$this->success('保存成功！');
			}else{
				$this->error('地址保存失败！请重试');
			}
		}else{
			$database_area = D('Area');
			if($_GET['adress_id']){
				$now_adress = D('User_adress')->get_adress($this->user_session['uid'],$_GET['adress_id']);
				if(empty($now_adress)){
					$this->error_tips('该地址不存在');
				}
				$this->assign('now_adress',$now_adress);
				
				$province_list = $database_area->get_arealist_by_areaPid(0);
				$this->assign('province_list',$province_list);
					
				$city_list = $database_area->get_arealist_by_areaPid($now_adress['province']);
				$this->assign('city_list',$city_list);
					
				$area_list = $database_area->get_arealist_by_areaPid($now_adress['city']);
				$this->assign('area_list',$area_list);
			}else{
				$now_city_area = $database_area->where(array('area_id'=>$this->config['now_city']))->find();
				$this->assign('now_city_area',$now_city_area);
				
				$province_list = $database_area->get_arealist_by_areaPid(0);
				$this->assign('province_list',$province_list);
					
				$city_list = $database_area->get_arealist_by_areaPid($now_city_area['area_pid']);
				$this->assign('city_list',$city_list);
					
				$area_list = $database_area->get_arealist_by_areaPid($now_city_area['area_id']);
				$this->assign('area_list',$area_list);
			}
			
			$params = $_GET;
			unset($params['adress_id']);
			$this->assign('params',$params);
		}
		
		$this->display();
	}
	/*删除地址*/
	public function del_adress(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$result = D('User_adress')->delete_adress($this->user_session['uid'],$_GET['adress_id']);
		if($result){
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}
	}
	public function select_area(){
		$area_list = D('Area')->get_arealist_by_areaPid($_POST['pid']);
		if(!empty($area_list)){
			$return['error'] = 0;
			$return['list'] = $area_list;
		}else{
			$return['error'] = 1;
		}
		echo json_encode($return);
	}
	/*全部团购*/
	public function group_order_list(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		if(intval($_GET['status'])==233){
			$order_list = D('Group')->wap_get_buy_order_list($this->user_session['uid'],0);
		}else{
		$order_list = D('Group')->wap_get_order_list($this->user_session['uid'],intval($_GET['status']));
		}
		$this->assign('order_list',$order_list);

		$this->display();
	}
	/*全部预约*/
	public function appoint_order_list(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$order_list = D('Appoint')->wap_get_order_list($this->user_session['uid'], intval($_GET['status']));
		$this->assign('order_list', $order_list);
		$this->display();
	}
	/*团购收藏*/
	public function group_collect(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		
		$this->assign(D('Group')->wap_get_group_collect_list($this->user_session['uid']));
		
		$this->display();
	}
	/*预约详情*/
	public function appoint_order(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$now_order = D('Appoint_order')->get_order_detail_by_id($this->user_session['uid'],intval($_GET['order_id']),true);
		if(empty($now_order)){
			$this->error_tips('当前订单不存在');
		}
		
		$this->assign('now_order',$now_order);
		$this->display();
	}
	/*团购详情*/
	public function group_order(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$otherrm = isset($_GET['otherrm']) ? intval($_GET['otherrm']) : 0;
		$otherrm && $_SESSION['otherwc'] = null;
		$now_order = D('Group_order')->get_order_detail_by_id($this->user_session['uid'],intval($_GET['order_id']),true);
		if(empty($now_order)){
			$this->error_tips('当前订单不存在');
		}
		if(empty($now_order['paid'])){
			$now_order['status_txt'] = '未付款';
		}else if(empty($now_order['third_id']) && $now_order['pay_type'] == 'offline'){
			$now_order['status_txt'] = '线下未付款';
		}else if(empty($now_order['status'])){
			if($now_order['tuan_type'] != 2){
				$now_order['status_txt'] = '未消费';
			}else{
				$now_order['status_txt'] = '未发货';
			}
		}else if($now_order['status'] == '1'){
			$now_order['status_txt'] = '待评价';
		}else if($now_order['status'] == '2'){
			$now_order['status_txt'] = '已完成';
		}else if($now_order['status'] == '3'){
			$now_order['status_txt'] = '已退款';
			$now_order['group_pass_txt'] = '退款订单无法查看';
		}
		$this->assign('now_order',$now_order);
		// dump($now_order);

		$this->display();
	}


	public function  crowdorder(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！');
        }
        $now_order = D('Crowdorder')->where(array("uid"=>$this->user_session['uid'],"corder_id"=>$_GET['order_id']))->find();
        $mer=D("Merchant")->where(array("mer_id"=>$now_order['mer_id']))->find();
        $ima=new merchant_image();
        $now_order['webpic']=$ima->get_image_by_path($mer['merchant_theme_image']);
      //  echo  json_encode($now_order);die;
        if(empty($now_order)){
            $this->error_tips('当前订单不存在');
        }
        if(empty($now_order['paid'])){
            $now_order['status_txt'] = '未付款';
        }else if($now_order['status'] == '1'){
            $now_order['status_txt'] = '待发货';
        }else if($now_order['status'] == '2'){
            $now_order['status_txt'] = '待评价';
        }else if($now_order['status'] == '3'){
            $now_order['status_txt'] = '已完成';

        }else if($now_order['status'] == '4'){
            $now_order['status_txt'] = '已退款';
            $now_order['group_pass_txt'] = '退款订单无法查看';
        }
        $this->assign('now_order',$now_order);
        // dump($now_order);
	    $this->display();
    }
	/*团购详情*/
	public function meal_order_refund(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		
		$orderid = intval($_GET['orderid']);
		$store_id = intval($_GET['store_id']);
		$now_order = M("Meal_order")->where(array('order_id' => $orderid, 'mer_id' => $this->mer_id, 'store_id' => $store_id))->find();
		if (empty($now_order)) {
			$this->error_tips('当前订单不存在');
		}
		if(empty($now_order['paid'])){
			$this->error_tips('当前订单还未付款！');
		}
		if(!empty($now_order['status'])){
			if ($now_order['meal_type']) {
				$this->error_tips('订单必须是未消费状态才能取消！',U('Takeout/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
			} else {
				$this->error_tips('订单必须是未消费状态才能取消！',U('Food/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
			}
		}
		$now_order['price'] = $now_order['pay_money'];
		$this->assign('now_order',$now_order);
		$this->display();
	}
	//取消订单
	public function meal_order_check_refund(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$orderid = intval($_GET['orderid']);
		$store_id = intval($_GET['store_id']);
		$now_order = M("Meal_order")->where(array('order_id' => $orderid, 'mer_id' => $this->mer_id, 'store_id' => $store_id))->find();
		if(empty($now_order)){
			$this->error_tips('当前订单不存在');
		}
		if(empty($now_order['paid'])){
			$this->error_tips('当前订单还未付款！');
		}
		if(!empty($now_order['status'])){
			if ($now_order['meal_type']) {
				$this->error_tips('订单必须是未消费状态才能取消！',U('Takeout/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
			} else {
				$this->error_tips('订单必须是未消费状态才能取消！',U('Food/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
			}
		}
// 		$now_order['price'] = $now_order['pay_money'];
// 		$data_meal_order['pay_money'] = 0;
// 		$data_meal_order['paid'] = 0;
		//在线付款退款
		if($now_order['pay_type'] == 'offline'){
			$data_meal_order['order_id'] = $now_order['order_id'];
			$data_meal_order['refund_detail'] = serialize(array('refund_time'=>time()));
			$data_meal_order['status'] = 3;
			if(D('Meal_order')->data($data_meal_order)->save()){
				if ($now_order['meal_type']) {
					$this->success_tips('您使用的是线下支付！订单状态已修改为已退款。',U('Takeout/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
				} else {
					$this->success_tips('您使用的是线下支付！订单状态已修改为已退款。',U('Food/order_detail',array('order_id'=>$now_order['order_id'], 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
				}
				exit;
			}else{
				$this->error_tips('取消订单失败！请重试。');
			}
		}
		if($now_order['payment_money'] != '0.00'){
			$pay_method = D('Config')->get_pay_method();
			if(empty($pay_method)){
				$this->error_tips('系统管理员没开启任一一种支付方式！');
			}
			if(empty($pay_method[$now_order['pay_type']])){
				$this->error_tips('您选择的支付方式不存在，请更新支付方式！');
			}
		
			$pay_class_name = ucfirst($now_order['pay_type']);
			$import_result = import('@.ORG.pay.'.$pay_class_name);
			if(empty($import_result)){
				$this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
			}
			
			if ($now_order['meal_type']) {
				$now_order['order_type'] = 'takeout';
			} else {
				$now_order['order_type'] = 'food';
			}
			$order_id = $now_order['order_id'];
			$now_order['order_id'] = $now_order['orderid'];
			$pay_class = new $pay_class_name($now_order,$now_order['payment_money'],$now_order['pay_type'],$pay_method[$now_order['pay_type']]['config'],$this->user_session,1);
			$go_refund_param = $pay_class->refund();
			$data_meal_order['order_id'] = $order_id;
			$data_meal_order['refund_detail'] = serialize($go_refund_param['refund_param']);
			if(empty($go_refund_param['error']) && $go_refund_param['type'] == 'ok'){
				$data_meal_order['status'] = 3;			
			}
			D('Meal_order')->data($data_meal_order)->save();
			if($data_meal_order['status'] != 3){	
				$this->error_tips($go_refund_param['msg']);
			}
		}
		//如果使用了优惠券
		if($now_order['card_id']){
			$result = D('Member_card_coupon')->add_card($now_order['card_id'],$now_order['mer_id'],$now_order['uid']);
			
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $now_order['order_id'];
			}
			
			$data_meal_order['order_id'] = $now_order['order_id'];
			$data_meal_order['refund_detail'] = serialize($param);
			$result['error_code'] || $data_meal_order['status'] = 3;
			D('Meal_order')->data($data_meal_order)->save();
			if ($result['error_code']) {
				$this->error_tips($result['msg']);
			}
			$go_refund_param['msg'] = $result['msg'];
		}
		//平台余额退款
		if($now_order['balance_pay'] != '0.00'){
			$result = D('User')->add_money($now_order['uid'],$now_order['balance_pay'],'退款 '.$now_order['order_name'].' 增加余额');
			
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $now_order['order_id'];
			}
			
			$data_meal_order['order_id'] = $now_order['order_id'];
			$data_meal_order['refund_detail'] = serialize($param);
			$result['error_code'] || $data_meal_order['status'] = 3;
			D('Meal_order')->data($data_meal_order)->save();
			if ($result['error_code']) {
				$this->error_tips($result['msg']);
			}
			$go_refund_param['msg'] = $result['msg'];
			
// 			if($add_result['error_code']){
// 				$this->error_tips($add_result['msg']);
// 			}
// 			$go_refund_param['msg'] = $add_result['msg'];
			
// 			$data_meal_order['order_id'] = $now_order['order_id'];
// 			$data_meal_order['refund_detail'] = serialize(array('refund_time'=>time()));
// 			$data_meal_order['status'] = 3;
// 			D('Meal_order')->data($data_meal_order)->save();
		}
		//商家会员卡余额退款
		if($now_order['merchant_balance'] != '0.00'){
			$result = D('Member_card')->add_card($now_order['uid'],$now_order['mer_id'],$now_order['merchant_balance'],'退款 '.$now_order['order_name'].' 增加余额');
			
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $now_order['order_id'];
			}
			
			$data_meal_order['order_id'] = $now_order['order_id'];
			$data_meal_order['refund_detail'] = serialize($param);
			$result['error_code'] || $data_meal_order['status'] = 3;
			D('Meal_order')->data($data_meal_order)->save();
			if ($result['error_code']) {
				$this->error_tips($result['msg']);
			}
			$go_refund_param['msg'] = $result['msg'];
		}
		
		
		//退款时销量回滚
		if ($now_order['paid'] == 1 && date('m', $now_order['dateline']) == date('m')) {
			foreach (unserialize($now_order['info']) as $menu) {
				D('Meal')->where(array('meal_id' => $menu['id'], 'sell_count' => array('gt', $menu['num'])))->setDec('sell_count', $menu['num']);
			}
		}
		D("Merchant_store_meal")->where(array('store_id' => $now_order['store_id']))->setDec('sale_count', 1);
		
		//退款打印
		$msg = ArrayToStr::array_to_str($now_order['order_id']);
		$op = new orderPrint($this->config['print_server_key'], $this->config['print_server_topdomain']);
		$op->printit($this->mer_id, $store_id, $msg, 1);
		
		$mer_store = D('Merchant_store')->where(array('mer_id' => $this->mer_id, 'store_id' => $store_id))->find();
		$sms_data = array('mer_id' => $mer_store['mer_id'], 'store_id' => $mer_store['store_id'], 'type' => 'food');
		if ($this->config['sms_cancel_order'] == 1 || $this->config['sms_cancel_order'] == 3) {
			$sms_data['uid'] = $now_order['uid'];
			$sms_data['mobile'] = $now_order['phone'];
			$sms_data['sendto'] = 'user';
			$sms_data['content'] = '您在 ' . $mer_store['name'] . '店中下的订单(订单号：' . $orderid . '),在' . date('Y-m-d H:i:s') . '时已被您取消并退款，欢迎再次光临！';
			Sms::sendSms($sms_data);
		}
		if ($this->config['sms_cancel_order'] == 2 || $this->config['sms_cancel_order'] == 3) {
			$sms_data['uid'] = 0;
			$sms_data['mobile'] = $merchant['phone'];
			$sms_data['sendto'] = 'merchant';
			$sms_data['content'] = '顾客' . $now_order['name'] . '的预定订单(订单号：' . $orderid . '),在' . date('Y-m-d H:i:s') . '时已客户取消并退款！';
			Sms::sendSms($sms_data);
		}
		
		if ($now_order['meal_type']) {
			$this->success_tips($go_refund_param['msg'], U('Takeout/order_detail',array('order_id'=>$orderid, 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
		} else {
			$this->success_tips($go_refund_param['msg'], U('Food/order_detail',array('order_id'=>$orderid, 'store_id' => $store_id, 'mer_id' => $this->mer_id)));
		}
	}
	/*团购详情*/
	public function group_order_refund(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$now_order = D('Group_order')->get_order_detail_by_id($this->user_session['uid'],intval($_GET['order_id']),true);
		if(empty($now_order)){
			$this->error_tips('当前订单不存在');
		}
		if(empty($now_order['paid'])){
			$this->error_tips('当前订单还未付款！');
		}
		if(!empty($now_order['status'])){
			$this->error_tips('订单必须是未消费状态才能取消！',U('My/group_order',array('order_id'=>$now_order['order_id'])));
		}
		$this->assign('now_order',$now_order);
		$this->display();
	}
	//取消订单
	public function group_order_check_refund(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$now_order = D('Group_order')->get_order_detail_by_id($this->user_session['uid'],intval($_GET['order_id']),true);
		if(empty($now_order)){
			$this->error_tips('当前订单不存在');
		}
		if(empty($now_order['paid'])){
			$this->error_tips('当前订单还未付款！');
		}
		if(!empty($now_order['status'])){
			$this->error_tips('订单必须是未消费状态才能取消！',U('My/group_order',array('order_id'=>$now_order['order_id'])));
		}
		//在线付款退款
		if($now_order['pay_type'] == 'offline'){
			$data_group_order['order_id'] = $now_order['order_id'];
			$data_group_order['refund_detail'] = serialize(array('refund_time'=>time()));
			$data_group_order['status'] = 3;
			if(D('Group_order')->data($data_group_order)->save()){
				$this->success_tips('您使用的是线下支付！订单状态已修改为已退款。',U('My/group_order',array('order_id'=>$now_order['order_id'])));
				exit;
			}else{
				$this->error_tips('取消订单失败！请重试。');
			}
		}
		if($now_order['payment_money'] != '0.00'){
			$pay_method = D('Config')->get_pay_method();
			if(empty($pay_method)){
				$this->error_tips('系统管理员没开启任一一种支付方式！');
			}
			if(empty($pay_method[$now_order['pay_type']])){
				$this->error_tips('您选择的支付方式不存在，请更新支付方式！');
			}
		
			$pay_class_name = ucfirst($now_order['pay_type']);
			$import_result = import('@.ORG.pay.'.$pay_class_name);
			if(empty($import_result)){
				$this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
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
				$this->error_tips($go_refund_param['msg']);
			}
		}
		//如果使用了优惠券
		if($now_order['card_id']){
			$result = D('Member_card_coupon')->add_card($now_order['card_id'],$now_order['mer_id'],$now_order['uid']);
			
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $now_order['order_id'];
			}
			
			$data_group_order['order_id'] = $now_order['order_id'];
			$data_group_order['refund_detail'] = serialize($param);
			$result['error_code'] || $data_group_order['status'] = 3;
			D('Group_order')->data($data_group_order)->save();
			if ($result['error_code']) {
				$this->error_tips($result['msg']);
			}
			$go_refund_param['msg'] = $result['msg'];
// 			$use_result = D('Member_card_coupon')->add_card($now_order['card_id'],$now_order['mer_id'],$now_order['uid']);
// 			if($use_result['error_code']){
// 				$this->error_tips($use_result['msg']);
// 			}
			
		}
		//平台余额退款
		if($now_order['balance_pay'] != '0.00'){
			$result = D('User')->add_money($now_order['uid'],$now_order['balance_pay'],'退款 '.$now_order['order_name'].' 增加余额');
			
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $now_order['order_id'];
			}
			
			$data_group_order['order_id'] = $now_order['order_id'];
			$data_group_order['refund_detail'] = serialize($param);
			$result['error_code'] || $data_group_order['status'] = 3;
			D('Group_order')->data($data_group_order)->save();
			if ($result['error_code']) {
				$this->error_tips($result['msg']);
			}
			$go_refund_param['msg'] = $result['msg'];
		}
		//商家会员卡余额退款
		if($now_order['merchant_balance'] != '0.00'){
			$result = D('Member_card')->add_card($now_order['uid'],$now_order['mer_id'],$now_order['merchant_balance'],'退款 '.$now_order['order_name'].' 增加余额');
			$param = array('refund_time' => time());
			if($result['error_code']){
				$param['err_msg'] = $result['msg'];
			} else {
				$param['refund_id'] = $now_order['order_id'];
			}
			$data_group_order['order_id'] = $now_order['order_id'];
			$data_group_order['refund_detail'] = serialize($param);
			$result['error_code'] || $data_group_order['status'] = 3;
			D('Group_order')->data($data_group_order)->save();
			if ($result['error_code']) {
				$this->error_tips($result['msg']);
			}
			$go_refund_param['msg'] = $result['msg'];
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
		$this->success_tips($go_refund_param['msg'],U('My/group_order',array('order_id'=>$now_order['order_id'])));
	}
	
	/*删除团购订单*/
	public function group_order_del(){
		$now_order = D('Group_order')->get_order_detail_by_id($this->user_session['uid'],intval($_GET['order_id']));
		if(empty($now_order)){
			$this->error_tips('当前订单不存在！');
		}else if($now_order['paid']){
			$this->error_tips('当前订单已付款，不能删除。');
		}
		$condition_group_order['order_id'] = $now_order['order_id'];
		$data_group_order['status'] = 4;
		if(D('Group_order')->where($condition_group_order)->data($data_group_order)->save()){
			$this->success_tips('删除成功！',U('My/group_order_list'));
		}else{
			$this->error_tips('删除失败！请重试。');
		}
	}
	/*店铺收藏*/
	public function group_store_collect(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		
		$this->assign(D('Merchant_store')->wap_get_store_collect_list($this->user_session['uid']));
		$this->display();
	}
	/*商家收藏***商家中心暂时没有手机版***/
	public function merchant_collect(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		
		$this->assign(D('Merchant')->get_collect_list($this->user_session['uid']));
		$this->display();
	}
	    /*     * *图片上传** */

    public function ajaxImgUpload() {
		$mulu=isset($_GET['ml']) ? trim($_GET['ml']):'group';
		$mulu=!empty($mulu) ? $mulu : 'group';
        $filename = trim($_POST['filename']);
        $img = $_POST[$filename];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $imgdata = base64_decode($img);
		$img_order_id = sprintf("%09d",$this->user_session['uid']);
		$rand_num = mt_rand(10,99).'/'.substr($img_order_id,0,3).'/'.substr($img_order_id,3,3).'/'.substr($img_order_id,6,3);
        $getupload_dir = "/upload/reply/".$mulu."/" .$rand_num;

        $upload_dir = "." . $getupload_dir;
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $newfilename = $mulu.'_' . date('YmdHis') . '.jpg';
        $save = file_put_contents($upload_dir . '/' . $newfilename, $imgdata);
		$save = file_put_contents($upload_dir . '/m_' . $newfilename, $imgdata);
		$save = file_put_contents($upload_dir . '/s_' . $newfilename, $imgdata);
        if ($save) {
            $this->dexit(array('error' => 0, 'data' => array('code' => 1, 'siteurl'=>$this->config['site_url'],'imgurl' =>$getupload_dir . '/' . $newfilename, 'msg' => '')));
        } else {
            $this->dexit(array('error' => 1, 'data' => array('code' => 0, 'url' => '', 'msg' => '保存失败！')));
        }
    }
	/*团购评价*/
	public function group_feedback(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$now_order = D('Group_order')->get_order_detail_by_id($this->user_session['uid'],intval($_GET['order_id']),true);
		$this->assign('now_order',$now_order);
		if(empty($now_order)){
			$this->error_tips('当前订单不存在！');
		}
		if(empty($now_order['paid'])){
			$this->error_tips('当前订单未付款！无法评论');
		}
		if(empty($now_order['status'])){
			$this->error_tips('当前订单未消费！无法评论');
		}
		if($now_order['status'] == 2){
			$this->error_tips('当前订单已评论');
		}
		if ($now_order['user_confirm'] == 0) {
			//确认订单
			if (!(D('Group_order')->orderConfirm($now_order['order_id']))) {
				$this->error_tips('确认失败！请重试。');
			}
		}
		if(IS_POST){
			$score = intval($_POST['score']);
			if($score > 5 || $score < 1){
				$this->error_tips('评分只能1到5分');
			}
			$inputimg=isset($_POST['inputimg']) ? $_POST['inputimg'] :'';
			$pic_ids=array();
			if(!empty($inputimg)){
				$database_reply_pic = D('Reply_pic');
				foreach($inputimg as $imgv){
					$imgv=str_replace('/upload/reply/group/','',$imgv);
					$imgtmp=explode('/',$imgv);
					$imgname=$imgtmp[count($imgtmp)-1];
					$reply_pic['name'] = $imgname;
					$reply_pic['pic'] = str_replace('/'.$imgname,'',$imgv).','.$imgname;
					$reply_pic['uid'] = $this->user_session['uid'];
					$reply_pic['order_type'] = '0';
					$reply_pic['order_id'] = intval($now_order['order_id']);
					$reply_pic['add_time'] = $_SERVER['REQUEST_TIME'];
					$pic_ids[] = $database_reply_pic->data($reply_pic)->add();
				}
			 }
			$database_reply = D('Reply');
			$data_reply['parent_id'] = $now_order['group_id'];
			$data_reply['store_id'] = $now_order['store_id'];
			$data_reply['mer_id'] = $now_order['mer_id'];
			$data_reply['score'] = $score;
			$data_reply['order_type'] = '0';
			$data_reply['order_id'] = intval($now_order['order_id']);
			$data_reply['anonymous'] = intval($_POST['anonymous']);
			$data_reply['comment'] = $_POST['comment'];
			$data_reply['uid'] = $this->user_session['uid'];
			$data_reply['pic'] = !empty($pic_ids) ? implode(',',$pic_ids):'';
			$data_reply['add_time'] = $_SERVER['REQUEST_TIME'];
			$data_reply['add_ip'] = get_client_ip(1);
			if($database_reply->data($data_reply)->add()){
				D('Group')->setInc_group_reply($now_order,$score);
				D('Group_order')->change_status($now_order['order_id'],2);
			$database_merchant_score = D('Merchant_score');
			$now_merchant_score = $database_merchant_score->field('`pigcms_id`,`score_all`,`reply_count`')->where(array('parent_id'=>$now_order['mer_id'],'type'=>'1'))->find();
			if(empty($now_merchant_score)){
				$data_merchant_score['parent_id'] = $now_order['mer_id'];
				$data_merchant_score['type'] = '1';
				$data_merchant_score['score_all'] = $score;
				$data_merchant_score['reply_count'] = 1;
				$database_merchant_score->data($data_merchant_score)->add();
			}else{
				$data_merchant_score['score_all'] = $now_merchant_score['score_all']+$score;
				$data_merchant_score['reply_count'] = $now_merchant_score['reply_count']+1;
				$database_merchant_score->where(array('pigcms_id'=>$now_merchant_score['pigcms_id']))->data($data_merchant_score)->save();
			}
			$now_store_score=$database_merchant_score->field('`pigcms_id`,`score_all`,`reply_count`')->where(array('parent_id'=>$now_order['store_id'],'type'=>'2'))->find();
			if(empty($now_store_score)){
				$data_store_score['parent_id'] = $now_order['store_id'];
				$data_store_score['type'] = '2';
				$data_store_score['score_all'] = $score;
				$data_store_score['reply_count'] = 1;
				$database_merchant_score->data($data_store_score)->add();
			}else{
				$data_store_score['score_all'] = $now_store_score['score_all']+$score;
				$data_store_score['reply_count'] = $now_store_score['reply_count']+1;
				$database_merchant_score->where(array('pigcms_id'=>$now_store_score['pigcms_id']))->data($data_store_score)->save();
			}
				$this->success_tips('评论成功',U('My/group_order',array('order_id'=>$now_order['order_id'])));
			}else{
				$this->error_tips('评论失败');
			}
		}
		$this->display();
	}
	/*订餐OR外卖评价*/
	public function meal_feedback(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$now_order = D('Meal_order')->where(array('uid' => $this->user_session['uid'], 'order_id' => intval($_GET['order_id'])))->find();
		$this->assign('now_order',$now_order);
		if(empty($now_order)){
			$this->error_tips('当前订单不存在！');
		}
		if(empty($now_order['paid'])){
			$this->error_tips('当前订单未付款！无法评论');
		}
		if(empty($now_order['status'])){
			$this->error_tips('当前订单未消费！无法评论');
		}
		if($now_order['status'] == 2){
			$this->error_tips('当前订单已评论');
		}
		if($now_order['user_confirm']==0){
			$result=D('Meal_order')->where(array('uid' => $this->now_user['uid'], 'order_id' => $_GET['order_id']))->save(array('user_confirm' => 1,'is_pay_bill'=>1));
			if(!$result){
				$this->error_tips('订单状态修改失败！');
			}
		}
		if(IS_POST){
			$score = intval($_POST['score']);
			if($score > 5 || $score < 1){
				$this->error_tips('评分只能1到5分');
			}
			$inputimg=isset($_POST['inputimg']) ? $_POST['inputimg'] :'';
			$pic_ids=array();
			if(!empty($inputimg)){
				$database_reply_pic = D('Reply_pic');
				foreach($inputimg as $imgv){
					$imgv=str_replace('/upload/reply/meal/','',$imgv);
					$imgtmp=explode('/',$imgv);
					$imgname=$imgtmp[count($imgtmp)-1];
					$reply_pic['name'] = $imgname;
					$reply_pic['pic'] = str_replace('/'.$imgname,'',$imgv).','.$imgname;
					$reply_pic['uid'] = $this->user_session['uid'];
					$reply_pic['order_type'] = '1';
					$reply_pic['order_id'] = intval($now_order['order_id']);
					$reply_pic['add_time'] = $_SERVER['REQUEST_TIME'];
					$pic_ids[] = $database_reply_pic->data($reply_pic)->add();
				}
			 }
			$database_reply = D('Reply');
			$data_reply['parent_id'] = $now_order['store_id'];
			$data_reply['store_id'] = $now_order['store_id'];
			$data_reply['mer_id'] = $now_order['mer_id'];
			$data_reply['score'] = $score;
			$data_reply['order_type'] = '1';
			$data_reply['order_id'] = intval($now_order['order_id']);
			$data_reply['anonymous'] = intval($_POST['anonymous']);
			$data_reply['comment'] = $_POST['comment'];
			$data_reply['uid'] = $this->user_session['uid'];
			$data_reply['pic'] = !empty($pic_ids) ? implode(',',$pic_ids):'';
			$data_reply['add_time'] = $_SERVER['REQUEST_TIME'];
			$data_reply['add_ip'] = get_client_ip(1);
			if ($database_reply->data($data_reply)->add()) {
				D('Merchant_store')->setInc_meal_reply($now_order,$score);
				D('Meal_order')->change_status($now_order['order_id'],2);

			$database_merchant_score = D('Merchant_score');
			$now_merchant_score = $database_merchant_score->field('`pigcms_id`,`score_all`,`reply_count`')->where(array('parent_id'=>$now_order['mer_id'],'type'=>'1'))->find();
			if(empty($now_merchant_score)){
				$data_merchant_score['parent_id'] = $now_order['mer_id'];
				$data_merchant_score['type'] = '1';
				$data_merchant_score['score_all'] = $score;
				$data_merchant_score['reply_count'] = 1;
				$database_merchant_score->data($data_merchant_score)->add();
			}else{
				$data_merchant_score['score_all'] = $now_merchant_score['score_all']+$score;
				$data_merchant_score['reply_count'] = $now_merchant_score['reply_count']+1;
				$database_merchant_score->where(array('pigcms_id'=>$now_merchant_score['pigcms_id']))->data($data_merchant_score)->save();
			}
			$now_store_score=$database_merchant_score->field('`pigcms_id`,`score_all`,`reply_count`')->where(array('parent_id'=>$now_order['store_id'],'type'=>'2'))->find();
			if(empty($now_store_score)){
				$data_store_score['parent_id'] = $now_order['store_id'];
				$data_store_score['type'] = '2';
				$data_store_score['score_all'] = $score;
				$data_store_score['reply_count'] = 1;
				$database_merchant_score->data($data_store_score)->add();
			}else{
				$data_store_score['score_all'] = $now_store_score['score_all']+$score;
				$data_store_score['reply_count'] = $now_store_score['reply_count']+1;
				$database_merchant_score->where(array('pigcms_id'=>$now_store_score['pigcms_id']))->data($data_store_score)->save();
			}

				if ($now_order['meal_type']) {
					$this->success_tips('评论成功', U('Takeout/order_detail', array('order_id' => $now_order['order_id'], 'mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'])));
				} else {
					$this->success_tips('评论成功', U('Food/order_detail', array('order_id' => $now_order['order_id'], 'mer_id' => $now_order['mer_id'], 'store_id' => $now_order['store_id'])));
				}
			} else{
				$this->error_tips('评论失败');
			}
		}
		$this->display();
	}
	/*全部订餐订单列表*/
	public function meal_order_list(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！');
		}
		$status = isset($_GET['status']) ? intval($_GET['status']) : 0;
		$where = " uid={$this->user_session['uid']} AND status<=3";//array('uid' => $this->user_session['uid'], 'status' => array('lt', 3));
		if ($status == -1) {
			$where .= " AND paid=0";
			$where['paid'] = 0;
		} elseif ($status == 1) {
			$where .= " AND paid=1 AND status=0";
		} elseif ($status == 2) {
			$where .= " AND paid=1 AND status=1";
		}
// 		$status == -1 && $where['paid'] = 0;
// 		$status == 1 && $where['status'] = 0;
// 		$status == 2 && $where['status'] = 1;
		$order_list = D("Meal_order")->field(true)->where($where)->order('order_id DESC')->select();
		$temp = $store_ids = array();
		foreach ($order_list as $st) {
			$store_ids[] = $st['store_id'];
		}
		$m = array();
		if ($store_ids) {
			$store_image_class = new store_image();
			$merchant_list = D("Merchant_store")->where(array('store_id' => array('in', $store_ids)))->select();
			foreach ($merchant_list as $li) {
				$images = $store_image_class->get_allImage_by_path($li['pic_info']);
				$li['image'] = $images ? array_shift($images) : array();
				unset($li['status']);
				$m[$li['store_id']] = $li;
			}
		}
		$list = array();
		foreach ($order_list as $ol) {
			if (isset($m[$ol['store_id']]) && $m[$ol['store_id']]) {
				$list[] = array_merge($ol, $m[$ol['store_id']]);
			} else {
				$list[] = $ol;
			}
		}
		$this->assign('order_list', $list);
		
		$this->display();
	}
	
	/*优惠券列表*/
	public function card_list(){
		// if(!$this->is_wexin_browser){
			// $this->error_tips('请使用微信浏览优惠券！');
		// }
		$use = empty($_GET['use']) ? '0' : '1';
		$card_list = D('Member_card_coupon')->get_all_coupon($this->user_session['uid'],$use);

		$this->assign('card_list',$card_list);
		
		$this->display();
	}
	
	
	public function cards()
	{

		$card_list = D('Member_card_set')->get_all_card($this->user_session['uid']);
		
		$this->assign('card_list',$card_list);
		
		$this->display();
	}
	public function order_list()
	{
		$type = isset($_GET['type']) ? intval($_GET['type']) : 1 ;
		if ($type == 1) {
			$order_list = D('Group')->wap_get_order_list($this->user_session['uid']);
			$this->assign('order_list',$order_list);
		} else {
			$where = array('uid' => $this->user_session['uid'], 'status' => array('lt', 3));
			$order_list = D("Meal_order")->field(true)->where($where)->order('order_id DESC')->select();
			$temp = $store_ids = array();
			foreach ($order_list as $st) {
				$store_ids[] = $st['store_id'];
			}
			$m = array();
			if ($store_ids) {
				$store_image_class = new store_image();
				$merchant_list = D("Merchant_store")->where(array('store_id' => array('in', $store_ids)))->select();
				foreach ($merchant_list as $li) {
					$images = $store_image_class->get_allImage_by_path($li['pic_info']);
					$li['image'] = $images ? array_shift($images) : array();
					unset($li['status']);
					$m[$li['store_id']] = $li;
				}
			}
			$list = array();
			foreach ($order_list as $ol) {
				if (isset($m[$ol['store_id']]) && $m[$ol['store_id']]) {
					$list[] = array_merge($ol, $m[$ol['store_id']]);
				} else {
					$list[] = $ol;
				}
			}
			$this->assign('order_list', $list);
		}
		$this->assign('type', $type);
		$this->display();
	}
	public function join_activity(){
		$uid = $this->user_session['uid'];
		import('@.ORG.wap_group_page');
		$tp_count = D('')->table(array(C('DB_PREFIX').'extension_activity_record'=>'ear',C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m'))->where("`ear`.`activity_list_id`=`eal`.`pigcms_id` AND `eal`.`mer_id`=`m`.`mer_id` AND `ear`.`uid`='$uid'")->group('`eal`.`pigcms_id`')->count();
		$P = new Page($tp_count,20,'page');
		$order_list = D('')->field('`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.*,`m`.*')->table(array(C('DB_PREFIX').'extension_activity_record'=>'ear',C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m'))->where("`ear`.`activity_list_id`=`eal`.`pigcms_id` AND `eal`.`mer_id`=`m`.`mer_id` AND `ear`.`uid`='$uid'")->group('`eal`.`pigcms_id`')->order('`eal`.`pigcms_id` DESC')->limit($P->firstRow.','.$P->listRows)->select();
		// dump($order_list);
		if($order_list){
			$extension_image_class = new extension_image();
			foreach($order_list as &$value){
				$value['list_pic'] = $extension_image_class->get_image_by_path(array_shift(explode(';',$value['pic'])),'s');
				$value['url'] = U('My/join_activity_detail',array('id'=>$value['pigcms_id']));
				$value['money'] = floatval($value['money']);
				$value['type_txt'] = $this->activity_type_txt($value['type']);
			}
		}
		$this->assign('order_list',$order_list);
		$this->assign('pagebar',$P->show());
		$this->display();
	}
	public function join_activity_detail(){
		$condition_extension_activity_list['pigcms_id'] = $_GET['id'];
		$now_activity = D('Extension_activity_list')->field(true)->where($condition_extension_activity_list)->find();
		if(empty($now_activity)){
			$this->error_tips('该活动不存在');
		}
		$now_activity['type_txt'] = $this->activity_type_txt($now_activity['type']);
		$extension_image_class = new extension_image();
		$now_activity['list_pic'] = $extension_image_class->get_image_by_path(array_shift(explode(';',$now_activity['pic'])),'s');
		$now_activity['url'] = U('Wapactivity/detail',array('id'=>$now_activity['pigcms_id']));
		$now_activity['money'] = floatval($now_activity['money']);
		
		//活动归属的商家信息
		$now_merchant = D('Merchant')->field(true)->where(array('mer_id'=>$now_activity['mer_id']))->find();
		
		$record_list = D('Extension_activity_record')->field(true)->where(array('activity_list_id'=>$now_activity['pigcms_id'],'uid'=>$this->user_session['uid']))->order('`pigcms_id` DESC')->select();
		if(empty($record_list)){
			$this->error_tips('您未参与该活动');
		}
		$record_id_arr = array();
		foreach($record_list as $value){
			$record_id_arr[] = $value['pigcms_id'];
		}
		if($now_activity['type'] == 1){
			$number_list = D('Extension_yiyuanduobao_record')->field('`number`')->where(array('record_id'=>array('in',$record_id_arr)))->select();
			// shuffle($number_list);
			$this->assign('number_list',$number_list);
		}else if($now_activity['type'] == 2){
			$number_list = D('Extension_coupon_record')->field('`number`,`check_time`')->where(array('record_id'=>array('in',$record_id_arr)))->select();
			$this->assign('number_list',$number_list);
		}
		$this->assign('now_merchant',$now_merchant);
		$this->assign('now_activity',$now_activity);
		$this->assign('number_list',$number_list);
		$this->display();
	}
	protected function activity_type_txt($type){
		switch($type){
			case '1':
				return '一元夺宝';
			case '2':
				return '优惠券';
			case '3':
				return '秒杀';
			case '4':
				return '红包';
			case '5':
				return '卡券';
		}
	}
	public function join_lottery()
	{
		$result = D('Lottery')->join_lottery($this->user_session['uid']);
		$this->assign($result);
		$this->display();
	}
	
	public function follow_merchant()
	{
		$mod = new Model();
		//$_SESSION['openid'] = 'onfo6tySRgO5tYJtkJ4tAueQI51g';
		$sql = "SELECT b.* FROM  ". C('DB_PREFIX') . "merchant_user_relation AS a INNER JOIN  ". C('DB_PREFIX') . "merchant as b ON a.mer_id=b.mer_id WHERE a.openid='{$_SESSION['openid']}'";
		$res = $mod->query($sql);
		
		$merchant_image_class = new merchant_image();
		foreach ($res as &$r) {
			// $images = explode(";", $r['pic_info']);
			// $images = explode(";", $images[0]);
			// $r['img'] = $merchant_image_class->get_image_by_path($images[0]);
			$r['img'] = $merchant_image_class->get_image_by_path($r['person_image']);
			$r['url'] = C('config.site_url').'/wap.php?c=Index&a=index&token=' . $r['mer_id'];
		}
		$this->assign('follow_list', $res);
		$this->display();
	}
	
	public function cancel_follow()
	{
		$mer_id = isset($_GET['mer_id']) ? intval($_GET['mer_id']) : 0;
		if (D('Merchant_user_relation')->where(array('mer_id' => $mer_id, 'openid' => $_SESSION['openid']))->delete()) {
			D('Merchant')->where(array('mer_id' => $mer_id, 'fans_count' => array('gt', 0)))->setDec('fans_count');
			$this->success_tips('取消关注成功', U('My/follow_merchant'));
		} else {
			$this->error_tips('取消关注失败，请稍后重试', U('My/follow_merchant'));
		}
	}
	
	public function recharge(){
		if(IS_POST){
			$data_user_recharge_order['uid'] = $this->now_user['uid'];
			$money = floatval($_POST['money']);
			if(empty($money) || $money > 10000){
				$this->error('请输入有效的金额！最高不能超过1万元。');
			}
			$data_user_recharge_order['money'] = $money;
			// $data_user_recharge_order['order_name'] = '帐户余额在线充值';
			$data_user_recharge_order['add_time'] = $_SERVER['REQUEST_TIME'];
			if($order_id = D('User_recharge_order')->data($data_user_recharge_order)->add()){
				redirect(U('Pay/check',array('order_id'=>$order_id,'type'=>'recharge')));
			}
		}else{
			$this->display();
		}
	}


    /**
     * 品鲜卡充值
     */
    public function  cardmoneyrecharge(){
        if(IS_POST){
            $data_user_recharge_order['uid'] = $this->now_user['uid'];
            $money = floatval($_POST['money']);
            if(empty($money) || $money > 10000){
                $this->error('请输入有效的金额！最高不能超过1万元。');
            }
            $data_user_recharge_order['money'] = $money;
            // $data_user_recharge_order['order_name'] = '帐户余额在线充值';
            $data_user_recharge_order['add_time'] = $_SERVER['REQUEST_TIME'];
            if($order_id = D('User_cardrecharge_order')->data($data_user_recharge_order)->add()){
                redirect(U('Pay/check',array('order_id'=>$order_id,'type'=>'cardrecharge')));
            }
        }else{
            $this->display();
        }

    }

    
	public function lifeservice(){
		$order_list = D('Service_order')->field(true)->where(array('uid'=>$this->user_session['uid'],'status'=>array('neq','0')))->order('`order_id` DESC')->select();
		foreach($order_list as &$value){
			$value['type_txt'] = $this->lifeservice_type_txt($value['type']);
			$value['type_eng'] = $this->lifeservice_type_eng($value['type']);
			$value['infoArr'] = unserialize($value['info']);
			$value['order_url'] = U('My/lifeservice_detail',array('id'=>$value['order_id']));
		}
		$this->assign('order_list', $order_list);
		// dump($order_list);
		$this->display();
	}
	public function lifeservice_detail(){
		$now_order = D('Service_order')->field(true)->where(array('order_id'=>$_GET['id']))->find();
		$now_order['infoArr'] = unserialize($now_order['info']);
		$now_order['type_txt'] = $this->lifeservice_type_txt($now_order['type']);
		$now_order['type_eng'] = $this->lifeservice_type_eng($now_order['type']);
		$now_order['pay_money'] = floatval($now_order['pay_money']);
		$this->assign('now_order', $now_order);
		// dump($order_list);
		$this->display();
	}
	protected function lifeservice_type_txt($type){
		switch($type){
			case '1':
				$type_txt = '水费';
				break;
			case '2':
				$type_txt = '电费';
				break;
			case '3':
				$type_txt = '煤气费';
				break;
			default:
				$type_txt = '生活服务';
		}
		return $type_txt;
	}
	protected function lifeservice_type_eng($type){
		switch($type){
			case '1':
				$type_txt = 'water';
				break;
			case '2':
				$type_txt = 'electric';
				break;
			case '3':
				$type_txt = 'gas';
				break;
			default:
				$type_txt = 'life';
		}
		return $type_txt;
	}

    /****等级升级****/
	public function levelUpdate(){
	    
	   $this->display();
	}

	/*     * json 格式封装函数* */

    private function dexit($data = '') {
        if (is_array($data)) {
            echo json_encode($data);
        } else {
            echo $data;
        }
        exit();
    }

    //佣金页面
    public function commission(){
    	//查询对应的频道
		$res=M("Channel_person")->alias("p")->field("c.id,c.name")->join(C('DB_PREFIX')."channel c ON p.c_id=c.id")->where("user_id=".$this->now_user['uid'])->select();
		if(!empty($res)){
		$this->assign("channels",$res);
		}
    	$this->assign('user',$this->now_user);
    	$this->display();
    }

    //收益列表
    public function commission_list(){
    	
    	$this->assign("now_money",$this->now_user['distribute_money']);
    	$this->display();
    }
    //获取json信息
    public function getCommissionList(){
    	$uid=$this->now_user['uid'];
    	//查找订单列表中含有用户佣金的订单信息，并查找对应的商品信息
    	$return=D('User_money_list')->get_list($this->now_user['uid']);
    	$money_list=$return['money_list'];
    	
    	foreach($money_list as $key=>$val){
    		$money_list[$key]['image']=$this->showpic($val['desc']);
    		$money_list[$key]['time']=date("Y-m-d",$val['time']);
    	}
    	$this->success($money_list,"",true);
    }
    //根据内容区分图片
    private function showpic($str){

    $arr=array("后台操作","充值","买","款","活动","佣金");
    	if(strrpos($str,$arr[0])){
        	return "admin";
    	}elseif(strrpos($str,$arr[1])){
        	return "recharge";
    	}elseif(strrpos($str,$arr[2])){
        	return "buy";
    	}elseif(strrpos($str,$arr[3])){
        	return "refund";
    	}elseif(strrpos($str,$arr[4])){
        	return "activity";
    	}elseif(strrpos($str,$arr[5])){
        	return "commission";
    	}else{
        	return "default";
    	}
	}
	//查询出对用的频道总营收收益和个人收益
	public function getChannelList(){
		$c_id=intval($_GET['c_id']);
		$channel=M("Channel")->where("id=".$c_id)->find();
		if(!empty($channel)){
		$res=M("Channel_person")->where("user_id=".$this->now_user['uid']." AND c_id=".$c_id)->find();
		if(!empty($res)){
			$this->assign("person",$res);
			$this->assign("channel",$channel);
		}else{
			$this->error("未获取到股东信息！");
		}
		}else{
			$this->error("未获取到频道信息！");
		}
		$this->display();
	}

	public function NewAddress(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！');
        }
        $adress_list = D('User_adress')->get_adress_list($this->user_session['uid']);

        if(empty($adress_list)){
            redirect(U('My/newedit_adress',$_GET));
        }else{
            if($_GET['group_id']){
                $select_url = 'NewGroup/buy';
            } elseif ($_GET['store_id']) {
                if ($_GET['buy_type'] == 'waimai') {
                    $select_url = 'Takeout/sureOrder';
                } else {
                    $select_url = 'Meal/cart';
                }
            }
            if($select_url){
                $this->assign('back_url',U($select_url,$_GET));
            }else{
                $this->assign('back_url',U('My/myinfo'));
            }

            $param = $_GET;

            foreach($adress_list as $key=>$value){
                $param['adress_id'] = $value['adress_id'];
                if(!empty($select_url)){
                    $adress_list[$key]['select_url'] = U($select_url,$param);
                }
                $adress_list[$key]['edit_url'] = U('My/newedit_adress',$param);
                $adress_list[$key]['del_url'] = U('My/newdel_adress',$param);
            }


            $this->assign('adress_list',$adress_list);
            $this->display();
        }
    }

    /*添加编辑地址*/
    public function newedit_adress(){
        if(IS_POST){
            if(D('User_adress')->post_form_save($this->user_session['uid'])){
                $this->success('保存成功！');
            }else{
                $this->error('地址保存失败！请重试');
            }
        }else{
            $database_area = D('Area');
            if($_GET['adress_id']){
                $now_adress = D('User_adress')->get_adress($this->user_session['uid'],$_GET['adress_id']);
                if(empty($now_adress)){
                    $this->error_tips('该地址不存在');
                }
                $this->assign('now_adress',$now_adress);

                $province_list = $database_area->get_arealist_by_areaPid(0);
                $this->assign('province_list',$province_list);

                $city_list = $database_area->get_arealist_by_areaPid($now_adress['province']);
                $this->assign('city_list',$city_list);

                $area_list = $database_area->get_arealist_by_areaPid($now_adress['city']);
                $this->assign('area_list',$area_list);
            }else{
                $now_city_area = $database_area->where(array('area_id'=>$this->config['now_city']))->find();
                $this->assign('now_city_area',$now_city_area);

                $province_list = $database_area->get_arealist_by_areaPid(0);
                $this->assign('province_list',$province_list);

                $city_list = $database_area->get_arealist_by_areaPid($now_city_area['area_pid']);
                $this->assign('city_list',$city_list);

                $area_list = $database_area->get_arealist_by_areaPid($now_city_area['area_id']);
                $this->assign('area_list',$area_list);
            }

            $params = $_GET;
            unset($params['adress_id']);
            $this->assign('params',$params);
        }

        $this->display();
    }
    /*删除地址*/
    public function newdel_adress(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！');
        }
        $result = D('User_adress')->delete_adress($this->user_session['uid'],$_GET['adress_id']);
        if($result){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }

    //获取用户拼团的信息
    public function group_buy_list(){
    	//$status=($_GET['status']==1)?$_GET['status']:1;
		$status=$_GET['status'];
    	if($status!=1){
    		$condition_where="gb.status=0 AND g.is_group_buy=1 AND o.uid=".$this->user_session['uid']." AND o.paid=1 AND o.status<=3";
    	}else{
    		$condition_where="gb.status<>0 AND g.is_group_buy=1 AND o.uid=".$this->user_session['uid']." AND o.paid=1 AND o.status<=3";
    	}
    	$group_buy_list=D('GroupBuy')->alias("gb")->field('gb.sun_id,gb.user_id,gb.status,g.group_id,o.order_id,g.related_id,g.s_name as group_name,g.name,g.pic,g.price,g.need_num,g.cat_id,g.cat_fid,o.is_lottery_order,g.is_lottery_group_buy')->join("LEFT JOIN ".C("DB_PREFIX")."group_order o ON `o`.`sun_id`=`gb`.`sun_id` AND `o`.`group_id`=`gb`.`group_id`")
    	->join("LEFT JOIN ".C("DB_PREFIX")."group g ON `gb`.`group_id`=`g`.`group_id`")->where($condition_where)->order("`gb`.`create_time` DESC")->select();
    	if($group_buy_list){
			$group_image_class = new group_image();
			foreach($group_buy_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$group_buy_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'m');
				$group_buy_list[$k]['price'] = floatval($v['price']);
			}
			 //分类下其他拼团
        $category_group_list = D('Group')->get_groupbuylist_by_catId($group_buy_list['cat_id'],$group_buy_list['cat_fid'],20,true);
        // exit(json_encode($group_buy_list));
        foreach($category_group_list as $key=>$value){
            if($value['group_id'] == $now_group['group_id']){
                unset($category_group_list[$key]);
            }
        }
	//	var_dump($category_group_list);
	//echo json_encode($category_group_list);
	//die;
        $this->assign('category_group_list',$category_group_list);
		}
		else {
			$now_time = $_SERVER['REQUEST_TIME'];
			$conditionwhere="`g`.`end_time` >'$now_time' AND `g`.`is_group_buy`='1' AND `g`.`status`='1'";
			 $category_group_list = D('Group')->alias("g")->where($conditionwhere)->limit(20)->order('g.group_id DESC')->select();
			 	$group_image_class = new group_image();
			foreach($category_group_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$category_group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'m');
			
			}
			   $this->assign('category_group_list',$category_group_list);
		}
		$this->assign('uid',session('user')['uid']);
		$this->assign("group_buy_list",$group_buy_list);
	 //  echo json_encode($group_buy_list);
		$this->display();
    }


    /**
     * 众筹订单列表
     */
    public function  crowd_buy_list(){
        $status=empty($_GET['status'])?0:$_GET['status'];
        if($status==1){   //普通订单
            $orderlist=D("Crowdorder")->where(" paid =1 AND is_lottery_order = 0 AND uid =  ".$this->user_session['uid']." AND status <> 5 ")->order("corder_id DESC")->select();
            $this->assign("islottery",0);

        }elseif ( $status==0){ //抽奖订单
            $orderlist=D("Crowdorder")->where(" paid =1 AND is_lottery_order = 1 AND uid = ".$this->user_session['uid']." AND status <> 5 ")->order("corder_id DESC")->select();
            $this->assign("islottery",1);
         //   echo  D()->getLastSql();
        }else{
            $this->error('传参失败！');
        }
     //   $gradedata=D("Crowdgrade");
        $group_image_class = new group_image();
        $crowdfundingdata=D("Crowdfunding");
        foreach ($orderlist as  $key=>$value){
            $crowd=$crowdfundingdata->where(array("crowd_id"=>$value["crowd_id"]))->find();
            $orderlist[$key]['webpic']=  $group_image_class->get_image_by_path($crowd['webpic'], 's');


        }

       // echo  json_encode($orderlist);die;
       $this->assign("group_buy_list",$orderlist);
        $this->display();
    }

    /**
     * 集采订单列表
     */
    public function  jicai_buy_list(){

            $orderlist=D("Jicaiorder")->where(" paid =1  AND uid =  ".$this->user_session['uid']." ")->order("order_id DESC")->select();


        $group_image_class = new group_image();
        $crowdfundingdata=D("Jicai");
        foreach ($orderlist as  $key=>$value){
            $crowd=$crowdfundingdata->where(array("group_id"=>$value["group_id"]))->find();
            $orderlist[$key]['pic']=  $group_image_class->get_image_by_path($crowd['pic'], 's');


        }

        // echo  json_encode($orderlist);die;
        $this->assign("group_buy_list",$orderlist);
        $this->display();
    }

    public function delorder(){
        $orderid=$_GET["order_id"];
        if(D("Crowdorder")->where(array("corder_id"=>$orderid))->data(array('status'=>5))->save()){
            $this->success_tips("删除订单成功",U('My/crowd_buy_list',array('status'=>1)));
        }else{
            $this->error_tips("删除订单失败");
        }
    }

    public function distribute_list(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！');
        }
        $distribution= D("Distribution_person")->where("user_id = ".$this->user_session["uid"])->find();
        if(empty($distribution)){
            $this->error_tips("您尚未有分销权限");
        }
        $this->assign("now_money",$this->user_session["distribute_money"]);

//        $distrions=D("Group_order")->where(array("distribution_id"=>$distribution["distribution_id"]))->order("order_id DESC ")->select();
//        //echo D()->getLastSql();die;
//      //  echo  json_encode($distrions);
//        $this->assign("distributeorders",$distrions);
        $this->display();
    }


    public function  getdistribute(){
        $uid=$this->now_user['uid'];
        $nowuser=D("Distribution_person")->where(array("user_id"=>$uid))->find();
     //   echo  json_encode($nowuser);die;

		import('@.ORG.user_page');
      //  $count = D("Group_order")->where(array("distribution_id"=>$nowuser["distribution_id"],"add_time"=>array("gt",strtotime("2017/08/01 00:00:00"))))->count();
 //  $count=   D("")-> table(array(C('DB_PREFIX').'Group_order'=>'go',C('DB_PREFIX').'group'=>'g'))->where("`go`.`distribution_id` = '".$nowuser['distribution_id']."' AND `go`.`add_time` > ".strtotime("2017/08/01 00:00:00")." AND `g`.`commission` > 0"." AND `go`.`uid` = ".$uid)->count();
//        $count=       D("Group_order")->alias("go")->join(" LEFT JOIN ".C('DB_PREFIX').'group g ON `go`.`group_id` =`g`.`group_id`')->where("go.distribution_id = ".$nowuser['distribution_id']." AND go.add_time > ".strtotime("2017/08/01 00:00:00")." AND g.commission > 0"." AND go.uid = ".$uid)->count();
       $model=new Model();
        $SQLCOUNT=" SELECT COUNT(*) as ccc FROM pigcms_group_order as go LEFT  JOIN  pigcms_group g ON  go.group_id =g.group_id WHERE "."go.distribution_id = '".$nowuser['distribution_id']."' AND go.add_time > ".strtotime("2017/08/01 00:00:00")." AND g.commission > 0  ";
        $SQLCOUNTR=$model->query($SQLCOUNT);
        $p = new Page($SQLCOUNTR['ccc'],1000);
		$req_page=empty($_GET['page'])?1:$_GET['page'];
//        if($req_page>($p->totalPage)){
//            return "";
//        }
        $SQL=" SELECT go.status,go.order_name,go.contact_name, g.commission as cm ,g.picthumb,go.add_time,go.add_time,go.order_id,go.num,go.group_id FROM pigcms_group_order as go LEFT  JOIN  pigcms_group as g ON  go.group_id =g.group_id WHERE "."go.distribution_id = '".$nowuser['distribution_id']."' AND go.add_time > ".strtotime("2017/08/01 00:00:00")." AND g.commission > 0 "." ORDER BY go.order_id DESC LIMIT ".strval((intval($req_page)-1)*1000).",1000";

        //  $this->success($SQL,"",true);
          $return["money_list"]=$model->query($SQL);

      //  $return['money_list'] = D("Group_order")->field(true)->where(array("distribution_id"=>$nowuser["distribution_id"],"add_time"=>array("gt",strtotime("2017/08/01 00:00:00"))))->order('`order_id` DESC')->limit($p->firstRow.',10')->select();
    //    $return['money_list'] =   D("Group_order")->alias("go")->join(" LEFT JOIN ".C('DB_PREFIX').'group g ON `go`.`group_id` =`g`.`group_id`')->where("go.distribution_id = ".$nowuser['distribution_id']." AND go.add_time > ".strtotime("2017/08/01 00:00:00")." AND g.commission > 0"." AND go.uid = ".$uid)->order('`go`.`order_id` DESC')->limit($p->firstRow.',10')->select();

    //    $return=D()->getLastSql();
     //   $this->success($return,"",true);
      $datagroup=D("Group");
      if(empty($return['money_list'])){
          $this->error("没有订单了","",true);
      }
      $groupimage=new group_image();
       foreach ($return['money_list'] as $key=>$value)
       {
          // $return["money_list"][$key]["commission"]=round(floatval($value["cm"])*intval($value['num'])*0.6,2);
           $return["money_list"][$key]["commission"]=$value['group_id'];
           $return["money_list"][$key]["picthumb"]=   $groupimage->get_image_by_path($value["picthumb"],"s");
           $return["money_list"][$key]["add_time"]=   date("Y/m/d H:i:s");
           $groupvalue=$datagroup->where(array("group_id"=>$value["group_id"]))->find();
           switch ($value["status"]){
               case 0:
                   $return["money_list"][$key]["distributestatus"]="待付款";
                   break;
               case 1:
                   $return["money_list"][$key]["distributestatus"]="待结算";
                   break;
               case 2:
                   $return["money_list"][$key]["distributestatus"]="已结算";
                   break;
               case 3:
                   $return["money_list"][$key]["distributestatus"]="已失效";
                   break;
               case 4:
                   $return["money_list"][$key]["distributestatus"]="已失效";
                   break;
           }
//           if(floatval($groupvalue['commission'])<=0){
//               unset($return["money_list"][$key]);
//
//           }else{

               $return["money_list"][$key]["commission"]=round(floatval($groupvalue['commission'])*$value["num"]*1,2);
//           }

       }
        $return["money_list"]=  array_values($return["money_list"]);
       $return['pagebar'] = $p->show();
      // echo D()->getLastSql();die;
        $this->success($return,"",true);
    }
    public function  getdisnew(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！');
        }
        $distribution= D("Distribution_person")->where("user_id = ".$this->user_session["uid"])->find();
        if(empty($distribution)){
            $this->error_tips("您尚未有分销权限");
        }
        $this->assign("now_money",$this->user_session["distribute_money"]);

   $dislist=$this->getdistributenotajax();
 //  echo json_encode($dislist);die;
   $this->assign("fans",$dislist);
   $this->display("distribute_listnew");

    }
    public function  getdistributenotajax(){
        $uid=$this->now_user['uid'];
        $nowuser=D("Distribution_person")->where(array("user_id"=>$uid))->find();
        //   echo  json_encode($nowuser);die;

        import('@.ORG.user_page');
        //  $count = D("Group_order")->where(array("distribution_id"=>$nowuser["distribution_id"],"add_time"=>array("gt",strtotime("2017/08/01 00:00:00"))))->count();
        //  $count=   D("")-> table(array(C('DB_PREFIX').'Group_order'=>'go',C('DB_PREFIX').'group'=>'g'))->where("`go`.`distribution_id` = '".$nowuser['distribution_id']."' AND `go`.`add_time` > ".strtotime("2017/08/01 00:00:00")." AND `g`.`commission` > 0"." AND `go`.`uid` = ".$uid)->count();
//        $count=       D("Group_order")->alias("go")->join(" LEFT JOIN ".C('DB_PREFIX').'group g ON `go`.`group_id` =`g`.`group_id`')->where("go.distribution_id = ".$nowuser['distribution_id']." AND go.add_time > ".strtotime("2017/08/01 00:00:00")." AND g.commission > 0"." AND go.uid = ".$uid)->count();
        $model=new Model();
        $SQLCOUNT=" SELECT COUNT(*) as ccc FROM pigcms_group_order as go LEFT  JOIN  pigcms_group g ON  go.group_id =g.group_id WHERE "."go.distribution_id = '".$nowuser['distribution_id']."' AND go.add_time > ".strtotime("2017/08/01 00:00:00")." AND g.commission > 0  ";
        $SQLCOUNTR=$model->query($SQLCOUNT);
        $p = new Page($SQLCOUNTR['ccc'],1000);
        $req_page=empty($_GET['page'])?1:$_GET['page'];
//        if($req_page>($p->totalPage)){
//            return "";
//        }
        $SQL=" SELECT go.paid,go.is_pay_bill, go.status,go.uid,go.order_name,go.contact_name, g.commission as cm ,g.picthumb,go.add_time,go.add_time,go.order_id,go.num,go.group_id FROM pigcms_group_order as go LEFT  JOIN  pigcms_group as g ON  go.group_id =g.group_id WHERE "."go.distribution_id = '".$nowuser['distribution_id']."' AND go.add_time > ".strtotime("2017/08/01 00:00:00")." AND g.commission > 0 "." ORDER BY go.order_id DESC LIMIT ".strval((intval($req_page)-1)*1000).",1000";

        //  $this->success($SQL,"",true);
        $return["money_list"]=$model->query($SQL);

        //  $return['money_list'] = D("Group_order")->field(true)->where(array("distribution_id"=>$nowuser["distribution_id"],"add_time"=>array("gt",strtotime("2017/08/01 00:00:00"))))->order('`order_id` DESC')->limit($p->firstRow.',10')->select();
        //    $return['money_list'] =   D("Group_order")->alias("go")->join(" LEFT JOIN ".C('DB_PREFIX').'group g ON `go`.`group_id` =`g`.`group_id`')->where("go.distribution_id = ".$nowuser['distribution_id']." AND go.add_time > ".strtotime("2017/08/01 00:00:00")." AND g.commission > 0"." AND go.uid = ".$uid)->order('`go`.`order_id` DESC')->limit($p->firstRow.',10')->select();

        //    $return=D()->getLastSql();
        //   $this->success($return,"",true);
        $datagroup=D("Group");
        if(empty($return['money_list'])){
            return "";
        }
        $groupimage=new group_image();
        $avatarimage=new avatar_image();
        $userdata=D("User");

        foreach ($return['money_list'] as $key=>$value)
        {
            // $return["money_list"][$key]["commission"]=round(floatval($value["cm"])*intval($value['num'])*0.6,2);
            $return["money_list"][$key]["commission"]=$value['group_id'];
            $return["money_list"][$key]["picthumb"]=   $groupimage->get_image_by_path($value["picthumb"],"s");
            $return["money_list"][$key]["add_time"]=   date("Y/m/d H:i:s",$value['add_time']);
            $groupvalue=$datagroup->where(array("group_id"=>$value["group_id"]))->find();
            $user=$userdata->where("uid = ".$value['uid'])->find();
            $return['money_list'][$key]['username']=$user["nickname"];
            if(empty($user["avatar"])){
                $return["money_list"][$key]["avatar"]= "http://www.xiaonongding.com/xnd.png";
            }else{
                if(strpos($user["avatar"],"http")===0){
                    $return["money_list"][$key]["avatar"]=$user['avatar'];
                }else{
                    $return["money_list"][$key]["avatar"]= $avatarimage->get_image_by_path($user['avatar'])["image"];
                }
            }
            switch ($value["paid"]){
                case 0:
                    $return["money_list"][$key]["distributestatus"]="待付款";
                    break;
                case 1:
                    if($value["status"]<2){
                        if($value["is_pay_bill"]==1){
                            $return["money_list"][$key]["distributestatus"]="已结算";
                        }else{
                            $return["money_list"][$key]["distributestatus"]="待结算";

                        }
                    }elseif ($value["status"]==2){
                        $return["money_list"][$key]["distributestatus"]="已结算";
                    }else{
                        $return["money_list"][$key]["distributestatus"]="已取消";
                    }
                    break;

            }
//           if(floatval($groupvalue['commission'])<=0){
//               unset($return["money_list"][$key]);
//
//           }else{

            $return["money_list"][$key]["commission"]=round(floatval($groupvalue['commission'])*$value["num"]*1,2);
//           }

        }
        $return["money_list"]=  array_values($return["money_list"]);
        $return['pagebar'] = $p->show();
      return $return["money_list"];
    }




    public function  express_query(){

        $juhecode=$_GET["expresscode"];
        $expressnum=$_GET["expressid"];
        $result=file_get_contents($this->baseurl."key=".$this->juhekey."&com=".$juhecode."&no=".$expressnum);
        if(!$result){
            $this->error_tips("未获取到快递信息",U("My/group_order_list"));
        }
        $resultarray=json_decode($result,true);
        $resultarray['result']["list"]=array_reverse($resultarray['result']["list"]);
        if($resultarray["resultcode"]!=200){
            $this->error_tips("未查询到快递信息",U("My/group_order_list"));
        }else{
         //   echo json_encode($resultarray);die;
            $this->assign("results",$resultarray['result']);
            $this->display();
        }
    }
}
	
?>