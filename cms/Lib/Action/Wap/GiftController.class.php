<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/10/27
 * Time: 15:00
 */
class GiftController  extends BaseAction
{

    public $is_wexin_browser = false;
    public $is_alipay_browser=false;
    public function __construct()
    {
echo 222;die;
        parent::__construct();

        if (strpos($_SERVER["HTTP_USER_AGENT"], "MicroMessenger") !== false) {
            $this->is_wexin_browser = true;
        }
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') !== false){
            $this->is_alipay_browser=true;
        }
        $this->assign("is_wexin_browser", $this->is_wexin_browser);
        if(!empty($_SESSION["openid"])){
        }
        if ($this->is_wexin_browser && empty($_SESSION["user"])) {
            $this->authorize_openid();
        }
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
            /*   $return = $http->curlGet('https://api.weixin.qq.com/sns/userinfo?access_token='.$jsonrt['access_token'].'&openid='.$jsonrt['openid'].'&lang=zh_CN');
               $jsonrt = json_decode($return,true);
               if ($jsonrt['errcode']) {
                   $error_msg_class = new GetErrorMsg();
                   $this->error_tips('授权发生错误：'.$error_msg_class->wx_error_msg($jsonrt['errcode']));
               }*/
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


    /**
     * 礼物充值
     */
    public function  giftrecharge(){
        if(empty($this->user_session)){
            $this->error_tips("请先登录",U('Login/index'));

        }
        echo  json_encode($this->user_session);die;
        $this->assign("userinfo",$this->user_session);
      //  $this->display();

    }


}