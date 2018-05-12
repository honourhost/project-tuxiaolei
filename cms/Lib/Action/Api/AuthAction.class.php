<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2018/2/23
 * Time: 14:10
 */

class AuthAction  extends NewbaseAction
{


    public  function index(){
          $redicturi=$_REQUEST["redirect_uri"];
          if(empty($redicturi)){
              echo  "redirect_uri不能为空";die;
          }
        if($this->is_wexin_browser){
       $this->authorize_openid($redicturi);
        }else{

            echo  "非微信端不用授权哦";die;
        }
    }

    public function authorize_openid($redicturl)
    {
        if (empty($_GET["code"])) {
            $_SESSION["weixin"]["state"] = md5(uniqid());
       //     $customeUrl = $this->config["site_url"] . $_SERVER["REQUEST_URI"];
            //用户同意授权，获取code
            $oauthUrl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->config["wechat_appid"] . "&redirect_uri=" . urlencode($redicturl) . "&response_type=code&scope=snsapi_base&state=" . $_SESSION["weixin"]["state"] . "#wechat_redirect";

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
                $this->error_tips("授权发生错误：" . $error_msg_class->wx_error_msg($jsonrt["errcode"]), U("Home/index"));
            }
            //授权成功
            if ($jsonrt["openid"]) {
                $_SESSION["openid"] = $jsonrt["openid"];
                $result = D("User")->autologin("openid", $jsonrt["openid"]);

                if (empty($result['error_code'])) {
                    $now_user = $result['user'];
                    //如果当前用户属于分销用户，则将分销id存入session
                    $res=D("Distribution_person")->where("user_id=".$now_user['uid'])->find();
                    if(!empty($res)) {
                        session("distribution_id", $res['distribution_id']);
                    }
                    session('user', $now_user);
                    $this->user_session = session('user');
                }
            }
            else {
                redirect("http://www.xiaonongding.com/mobile");
            }
        }
        else {
            redirect("http://www.xiaonongding.com/mobile");
        }
    }
}