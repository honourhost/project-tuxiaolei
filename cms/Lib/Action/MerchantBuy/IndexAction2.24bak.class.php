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
		$this->display();
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
		    $this->error_tips("商家id不能为空！");die;
        }

        $merinfo=D("Merchant")->where(array("mer_id"=>$mer_id))->find();
        if($merinfo){
            $merchant_image=new merchant_image();
            $merinfo['person_image']=$merchant_image->get_image_by_path($merinfo['person_image']);



        }else{
            $this->error_tips("没有查找到商家信息！");die;
        }
        $this->assign("merinfo",$merinfo);
        $this->assign("mer_id",$mer_id);
     //   echo  json_encode($merinfo);die;
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
       D("Merchant")->saveRelation($this->user_session["openid"],$mer_id,false);   //关注商家
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
	    $this->weixin($_GET['order_id']);
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


    public function weixin($order_id){
      //  $_SESSION['weixin']['referer'] = !empty($_GET['referer']) ? htmlspecialchars_decode($_GET['referer']) : U('Home/index');
        $_SESSION['weixin']['state']   = md5(uniqid());

        $customeUrl = $this->config['site_url'].'/MerchantBuy.php?c=Index&a=weixin_back2&order_id='.$order_id;
        $oauthUrl='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->config['wechat_appid'].'&redirect_uri='.urlencode($customeUrl).'&response_type=code&scope=snsapi_userinfo&state='.$_SESSION['weixin']['state'].'#wechat_redirect';
        redirect($oauthUrl);
    }
    public function weixin_back2(){


        if (isset($_GET['code'])){
            unset($_SESSION['weixin']['state']);
            import('ORG.Net.Http');
            $http = new Http();
            $return = $http->curlGet('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->config['wechat_appid'].'&secret='.$this->config['wechat_appsecret'].'&code='.$_GET['code'].'&grant_type=authorization_code');
            $jsonrt = json_decode($return,true);
            if($jsonrt['errcode']){
                $error_msg_class = new GetErrorMsg();
                $this->error_tips('授权发生错误：'.$error_msg_class->wx_error_msg($jsonrt['errcode']));
            }

            $return = $http->curlGet('https://api.weixin.qq.com/sns/userinfo?access_token='.$jsonrt['access_token'].'&openid='.$jsonrt['openid'].'&lang=zh_CN');
            $jsonrt = json_decode($return,true);
            if ($jsonrt['errcode']) {
                $error_msg_class = new GetErrorMsg();
                $this->error_tips('授权发生错误：'.$error_msg_class->wx_error_msg($jsonrt['errcode']));
            }


            /*注册用户*/
            $data_user = array(
                'openid' 	=> $jsonrt['openid'],
                'union_id' 	=> ($jsonrt['unionid'] ? $jsonrt['unionid'] : ''),
                'nickname' 	=> $jsonrt['nickname'],
                'sex' 		=> $jsonrt['sex'],
                'province' 	=> $jsonrt['province'],
                'city' 		=> $jsonrt['city'],
                'avatar' 	=> $jsonrt['headimgurl'],
            );
            $_SESSION['weixin']['user'] = $data_user;
            $user=D("User");
          $info=  $user->field("nickname")->where(array("openid"=>$data_user["openid"]))->find();
            if(empty($info["nickname"])){
                if($user->data($data_user)->where(array("openid"=>$data_user["openid"]))->save()){

                }else{
                    $this->error_tips("保存用户信息失败！".json_encode($data_user));
                }
            }


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

        }else{
            $this->error_tips('访问异常！请重新登录。');
        }
    }
}

