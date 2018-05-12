<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19 0019
 * Time: 19:33
 */
class QrUserAction extends CommonAction
{

    public $is_wexin_browser = false;
    public function _initialize(){
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'icroMessenger') !== false) {
            $this->is_wexin_browser = true;
        }

        $this->assign('is_wexin_browser', $this->is_wexin_browser);
        if ($this->is_wexin_browser && empty($GLOBALS['_SESSION']['openid'])) {
            $this->authorize_openid();
        }
        $this->static_path = '/tpl/WapMerchant/' . C('DEFAULT_THEME') . '/static/';
        $this->assign('static_path', $this->static_path);
        $share = new WechatShare($this->config, $GLOBALS['_SESSION']['openid']);
        $this->shareScript = $share->getSgin();
        $this->assign('shareScript', $this->shareScript);
    }
    public function index(){
        if($_GET["mer_id"]){
            $this->assign("merid",$_GET["mer_id"]);
            $merinfo=D("Merchant")->where(array("mer_id"=>$_GET["mer_id"]))->find();
            if($merinfo){
                $merchant_image=new merchant_image();
                $merinfo['person_image']=$merchant_image->get_image_by_path($merinfo['person_image']);



            }else{
                $this->error_tips("没有查找到商家信息！");die;
            }
            $this->assign("merinfo",$merinfo);
           $this->display();
        }else{
            $this->error_tips("分发请求！");
        }
    }

    public function qrpng(){
        import('@.ORG.phpqrcode');
        QRcode::png("http://www.xiaonongding.com/merchantbuy.php?g=MerchantBuy&c=Index&a=pay&mer_id=".$_GET['mer_id']);

    }

    public function authorize_openid()
    {
        if (empty($_GET['code'])) {
            $GLOBALS['_SESSION']['weixin']['state'] = md5(uniqid());
            $customeUrl = $this->config['site_url'] . $_SERVER['REQUEST_URI'];
            $oauthUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->config['wechat_appid'] . '&redirect_uri=' . urlencode($customeUrl) . '&response_type=code&scope=snsapi_base&state=' . $GLOBALS['_SESSION']['weixin']['state'] . '#wechat_redirect';
            redirect($oauthUrl);
            exit();
        }
        else {
            if (isset($_GET['code']) && isset($_GET['state']) && ($_GET['state'] == $GLOBALS['_SESSION']['weixin']['state'])) {
                unset($GLOBALS['_SESSION']['weixin']);
                import('ORG.Net.Http');
                $http = new Http();
                $return = $http->curlGet('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->config['wechat_appid'] . '&secret=' . $this->config['wechat_appsecret'] . '&code=' . $_GET['code'] . '&grant_type=authorization_code');
                $jsonrt = json_decode($return, true);

                if ($jsonrt['errcode']) {
                    $error_msg_class = new GetErrorMsg();
                    $this->error_tips('授权发生错误：' . $error_msg_class->wx_error_msg($jsonrt['errcode']), U('Home/index'));
                }

                if ($jsonrt['openid']) {
                    $GLOBALS['_SESSION']['openid'] = $jsonrt['openid'];
                    $result = D('User')->autologin('openid', $jsonrt['openid']);

                    if (empty($result['error_code'])) {
                        $now_user = $result['user'];
                        session('user', $now_user);
                        $this->user_session = session('user');
                    }
                }
                else {
                    redirect(U('Home/index'));
                }
            }
            else {
                redirect(U('Home/index'));
            }
        }
    }

}