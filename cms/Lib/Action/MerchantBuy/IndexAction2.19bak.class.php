<?php
function strExists($haystack, $needle)
{
	return !(strpos($haystack, $needle) === FALSE);
}
class IndexAction extends BaseAction
{
		
	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index()
	{	
		echo 111;
	}

	public function clear(){
		session(null);
		echo "清除session成功！";die;
	}

	public function pay(){
		$mer_id=intval($_GET['mer_id']);
		if(!empty($mer_id)){
			session('mer_id',$mer_id);
		}else{
		    $this->error_tips("商家id不能为空！");
        }
		   $this->assign("mer_id",$mer_id);
		$this->display();
	}

	public function goPay(){
		$mer_id=session('mer_id');
		if(empty($mer_id)){
			$this->error_tips('未获取到商户id!');
		}
		$money=floatval($_POST['money']);
		if(empty($money)){
			$this->error_tips('请输入正确的金额信息!');
		}
		$merchant=M('merchant')->find($mer_id);
		if(empty($merchant)){
			$this->error_tips('未获取到该商家的信息!');
		}
		$fastinfo=array(
			"mer_id"=>$mer_id,
			"s_name"=>$merchant['name'].date('Ymd H:i:s')."的现金快速支付订单",
			"price"=>$money,
			);
		$uid=$this->user_session['uid'];
		if(empty($uid)){
			$this->error_tips('未获取到用户信息!');
		}
		//保存订单返回保存的信息
		$result=D("FastOrder")->save_post_form($fastinfo,$this->user_session);
		if($result['error']){
			$this->error_tips($result['msg']);
		}
		//获取返回的订单信息
		$order_info=$result['order_info'];

		$pay_money=$order_info['total_money'];
		//支付方式
		$paytype="weixin";
		$pay_method = D('Config')->get_pay_method();

		$pay_class_name = ucfirst($paytype);

		$import_result = import('@.ORG.pay.'.$pay_class_name);
		if(empty($import_result)){
			$this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
		}
		$order_id = $order_info['order_id'];
            D("Merchant")->saveRelation($this->user_session["openid"],$mer_id,false);
		$pay_class = new $pay_class_name($order_info,$pay_money,$paytype,$pay_method[$paytype]['config'],$this->user_session,2);

		$go_pay_param = $pay_class->pay();
		
		if(empty($go_pay_param['error'])){
			if(!empty($go_pay_param['url'])){
				$this->assign('url',$go_pay_param['url']);
				$this->display();
			}else if(!empty($go_pay_param['form'])){
				$this->assign('form',$go_pay_param['form']);
				$this->display();
			}else if(!empty($go_pay_param['weixin_param'])){
				$redirctUrl = C('config.site_url').'/merchantbuy.php?g=MerchantBuy&c=Index&a=weixin_back&order_id='.$order_info['order_id'];
				$this->assign('redirctUrl',$redirctUrl);
				$this->assign('pay_money',$pay_money);
				$this->assign('weixin_param',json_decode($go_pay_param['weixin_param']));
				$this->display('weixin_pay');
			}else{
				$this->error_tips('调用支付发生错误，请重试。');
			}
		}else{
			$this->error_tips($go_pay_param['msg']);
		}
	}

	//微信同步回调页面
	public function weixin_back(){
		$now_order = D('FastOrder')->get_order_by_id($this->user_session['uid'],intval($_GET['order_id']));

		if(empty($now_order)){
			$this->error_tips('该订单不存在');
		}
		if($now_order['paid']){
			$redirctUrl=C('config.site_url').'/merchantbuy.php?g=MerchantBuy&c=Index&a=index&order_id='.$now_order['order_id'];
			redirect($redirctUrl);exit;
		}
		$import_result = import('@.ORG.pay.Weixin');
		$pay_method = D('Config')->get_pay_method();
		if(empty($pay_method)){
			$this->error_tips('系统管理员没开启任一一种支付方式！');
		}
		$pay_class = new Weixin($now_order,0,'weixin',$pay_method['weixin']['config'],$this->user_session,1);
		$go_query_param = $pay_class->query_order();
		//如果支付后同步查询支付成功，修改订单状态
		if($go_query_param['error'] === 0){
			D('FastOrder')->after_pay($go_query_param['order_param']);
		}
		$redirctUrl=C('config.site_url').'/merchantbuy.php?g=MerchantBuy&c=Index&a=showResult&order_id='.$now_order['order_id'];
		redirect($redirctUrl);
	}

	public function showResult(){
		print_r($_GET);
		echo "支付结束！";
	}
}

