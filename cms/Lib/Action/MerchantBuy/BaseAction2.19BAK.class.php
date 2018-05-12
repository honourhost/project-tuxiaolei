<?php

class BaseAction extends CommonAction
{
    public $is_wexin_browser = false;

    public function __construct()
    {
        parent::__construct();

        if (strpos($_SERVER["HTTP_USER_AGENT"], "MicroMessenger") !== false) {
            $this->is_wexin_browser = true;
        }
        $this->assign("is_wexin_browser", $this->is_wexin_browser);
        if ($this->is_wexin_browser && empty($_SESSION["openid"])) {
            $this->authorize_openid();
        }

		$this->static_path = $this->config['site_url'] . '/tpl/Wap/' . C('DEFAULT_THEME') . '/static/';
	
		//启用pure
	
		if(false == in_array(MODULE_NAME,array('Group',"Home",'Meal_list','Merchant','Search'))){
			$this->assign("no_footer", true);
		}
		
		
		
		$this->assign('static_path', $this->static_path);
		$this->common_url['group_category_all'] = u('Wap/Group/index');
        $this->assign($this->common_url);
    }

	public function error_tips($msg, $url = 'javascript:history.back(-1);')
    {
        $this->assign("msg", $msg);
        $this->assign("url", $url);
        $this->display("Home/error");
        exit();
    }

	public function success_tips($msg, $url = 'javascript:history.back(-1);')
    {
        $this->assign("msg", $msg);
        $this->assign("url", $url);
        $this->display("Home/success");
        exit();
    }

    public function authorize_openid()
    {
        if (empty($_GET["code"])) {
            $_SESSION["weixin"]["state"] = md5(uniqid());
            $customeUrl = $this->config["site_url"] . $_SERVER["REQUEST_URI"];
            //用户同意授权，获取code
            $oauthUrl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->config["wechat_appid"] . "&redirect_uri=" . urlencode($customeUrl) . "&response_type=code&scope=snsapi_base&state=" . $_SESSION["weixin"]["state"] . "#wechat_redirect";
            
            redirect($oauthUrl);
            exit();
        }
		else if (isset($_GET['code']) && (true == isset($_GET['state'])) && ( $_GET['state'] == $_SESSION['weixin']['state'])) {
			unset($_SESSION['weixin']);
			import('ORG.Net.Http');
                $http = new Http();
                //获取access_token
                $return = $http->curlGet("https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $this->config["wechat_appid"] . "&secret=" . $this->config["wechat_appsecret"] . "&code=" . $_GET["code"] . "&grant_type=authorization_code");
                $jsonrt = json_decode($return, true);
                //授权失败
                if ($jsonrt["errcode"]) {
                    $error_msg_class = new GetErrorMsg();
                    $this->error_tips("授权发生错误：" . $error_msg_class->wx_error_msg($jsonrt["errcode"]));
                }
                //授权成功
                if ($jsonrt["openid"]) {
                    $_SESSION["openid"] = $jsonrt["openid"];
                    $result = D("User")->newautologin("openid", $jsonrt["openid"]);

				if (empty($result['error_code'])) {
					$now_user = $result['user'];
					session('user', $now_user);
					$this->user_session = session('user');
                    }else{
                         $this->error_tips($result['error_code'].":".$result['msg']);
                    }
                }
                else {
                    $this->error_tips("授权发生错误：" . $error_msg_class->wx_error_msg($jsonrt["errcode"]));
                }
            }
            else {
			    $this->error_tips("支付过程出错，请重试！！");
            }
        }

	public function behavior($param = array(), $extra_param = false)
    {
		$openid = $_SESSION['openid'];
		if (empty($param) || (true == empty($openid))) {
            return false;
        }

		if (empty($param['model'])) {
			$param['model'] = MODULE_NAME . '_' . ACTION_NAME;
        }

		$database_behavior = m('Behavior');
        $data_behavior = $param;
		$data_behavior['openid'] = $openid;
		$data_behavior['date'] = $data_behavior['last_date'] = $_SERVER['REQUEST_TIME'];
        $database_behavior->data($data_behavior)->add();
    }

    public function _modules()
    {
		return array('Home_index' => '首页', 'Search_group' => $this->config['group_alias_name'] . '搜索', 'Search_meal' => $this->config['meal_alias_name'] . '搜索', 'Group_index' => $this->config['group_alias_name'] . '列表', 'Group_detail' => $this->config['group_alias_name'] . '内页', 'Group_feedback' => $this->config['group_alias_name'] . '评论列表', 'Group_branch' => $this->config['group_alias_name'] . '页店铺列表', 'Group_buy' => '提交' . $this->config['group_alias_name'] . '订单', 'Group_shop' => '店铺' . $this->config['group_alias_name'] . '页面', 'Group_addressinfo' => '店家地图', 'Group_get_route' => '店家路线', 'Pay_group' => $this->config['group_alias_name'] . '确认订单', 'Pay_meal' => $this->config['meal_alias_name'] . '确认订单', 'Meal_index' => '店铺介绍', 'Meal_menu' => '店铺菜单', 'Meal_thissort' => '菜品分类', 'Meal_cart' => '确认我的菜单', 'Meal_saveorder' => '提交我的菜单', 'Meal_detail' => '订单详情', 'Meal_my' => '我的' . $this->config['meal_alias_name'] . '记录', 'Meal_order' => $this->config['meal_alias_name'] . '订单列表', 'Meal_selectmeal' => $this->config['meal_alias_name'] . '点菜', 'Index_index' => '微网站');
    }

    public function get_encrypt_key($array, $app_key)
    {
        $new_arr = array();
        ksort($array);

        foreach ($array as $key => $value ) {
            $new_arr[] = $key . "=" . $value;
        }

        $new_arr[] = "app_key=" . $app_key;
        $string = implode("&", $new_arr);
        return md5($string);
    }
	protected function get_im_encrypt_key($array, $app_key)
	{
		$new_arr = array();
		ksort($array);
		foreach ($array as $key => $value) {
			$new_arr[] = $key . '=' . $value;
		}
		$new_arr[] = 'app_key=' . $app_key;
		$string = implode('&', $new_arr);
		return md5($string);
	}
	public function _wapthisCard()
	{
		$thisCard = m('Member_card_set')->where(array('token' => $this->token, 'id' => intval($_GET['cardid'])))->find();
		return $thisCard;
	}
	protected function _waptodaySigned()
	{
		$signined = 0;
		$now = time();
		$where = array('token' => $this->token, 'wecha_id' => $this->user_session['uid'], 'score_type' => 1);
		$sign = m('Member_card_sign')->where($where)->order('sign_time desc')->find();
		$today = date('Y-m-d', $now);
		$itoday = date('Y-m-d', intval($sign['sign_time']));
		if ($sign && ($itoday == $today)) {
			$signined = 1;
		}
		return $signined;
	}
	protected function wapIsLogin()
	{
		if (empty($this->user_session)) {
			$this->error_tips('请先进行登录！', u('Login/index'));
		}
	}
	public function header_json(){
		header('Content-type: application/json'); 
	}
	
	
	
	 //返回json的封装
   protected function returnAjax($str,$status){
        if(is_array($str)){
            $data=array(
                "msg"=>$str,
                "errorMsg"=>"获取数据成功！",
                "status"=>$status
                );
        }else{
            if(empty($str)){
                $data=array(
            "msg"=>array(),
            "errorMsg"=>"未获取到数据！",
            "status"=>$status
            );
            }else{
            $data=array(
            "msg"=>array(),
            "errorMsg"=>$str,
            "status"=>$status
            );
            }
        }
        echo json_encode($data);
        die;
    }
}


?>
