<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/10/27
 * Time: 15:00
 */
class GiftAction  extends BaseAction
{

    public $is_wexin_browser = false;
    public $is_alipay_browser=false;
    public function __construct()
    {

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

        $avatar_image_class=new avatar_image();
        if(strpos($this->user_session['avatar'],"http")===0){
        }else{
            $this->user_session['avatar']=$avatar_image_class->get_image_by_path($this->user_session['avatar'],C('config.site_url'))['image'];
        }


        $this->assign("userinfo",$this->user_session);
       // echo json_encode($this->user_session);die;
        $this->display();

    }


    public function goPay(){


        $money=floatval($_POST['money']);
        if(empty($money)){
            $this->error_tips('请输入正确的金额信息!');
        }
        if($money>100000){
            $this->error_tips('付款金额不能大于100000!');
        }
        $uid=$_SESSION["user"]["uid"];
        if(empty($uid)){
            $this->error_tips('未获取到用户信息!');
        }

        $fastinfo=array(
            "s_name"=>"用户编号".$uid.date('Ymd H:i:s')."的赠礼订单",
            "total_money"=>$money,
            "desc"=>$_POST["desc"],
        );

        //保存订单返回保存的信息
        $result=D("Giftorder")->save_post_form($fastinfo,$this->user_session);
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
        $pay_class = new $pay_class_name($order_info,$pay_money,$paytype,$pay_method[$paytype]['config'],$this->user_session,5);

        $go_pay_param = $pay_class->pay();
       // file_put_contents("giftpay.txt",json_encode($go_pay_param),FILE_APPEND);

        if(empty($go_pay_param['error'])){
            if(!empty($go_pay_param['url'])){
                $this->assign('url',$go_pay_param['url']);
                $this->display();
            }else if(!empty($go_pay_param['form'])){
                $this->assign('form',$go_pay_param['form']);
                $this->display();
            }else if(!empty($go_pay_param['weixin_param'])){
                $redirctUrl = C('config.site_url').'/wap.php?g=Wap&c=Gift&a=weixin_back&order_id='.$order_info['order_id'];
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
        $now_order = D('Giftorder')->get_order_by_id($this->user_session['uid'],intval($_GET['order_id']));

        if(empty($now_order)){
            $this->error_tips('该订单不存在');
        }
        if($now_order['paid']){
            $redirctUrl=C('config.site_url').'/wap.php?g=wap&c=Gift&a=index&order_id='.$now_order['order_id'];
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
            D('Giftorder')->after_pay($go_query_param['order_param']);
        }
        $redirctUrl=C('config.site_url').'/wap.php?g=wap&c=Gift&a=showResult&order_id='.$now_order['order_id'];
        redirect($redirctUrl);
    }

    public function weixin($order_id){
        //  $_SESSION['weixin']['referer'] = !empty($_GET['referer']) ? htmlspecialchars_decode($_GET['referer']) : U('Home/index');
        $_SESSION['weixin']['state']   = md5(uniqid());

        $customeUrl = $this->config['site_url'].'/wap.php?c=Gift&a=weixin_back2&order_id='.$order_id;
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


            $now_order = D('Giftorder')->get_order_by_id($this->user_session['uid'],intval($_GET['order_id']));

            if(empty($now_order)){
                $this->error_tips('该订单不存在');
            }
            if($now_order['paid']){
                $redirctUrl=C('config.site_url').'/wap.php?g=Wap&c=Gift&a=showResult&order_id='.$now_order['order_id'];
                redirect($redirctUrl);exit;
            }
            $import_result = import('@.ORG.pay.Weixin');
            $pay_method = D('Config')->get_pay_method();
            if(empty($pay_method)){
                $this->error_tips('系统管理员没开启任一一种支付方式！');
            }
           // file_put_contents("giftorder.txt",json_encode($now_order),FILE_APPEND);
            $now_order["order_type"]="giftorder";
            $pay_class = new Weixin($now_order,0,'weixin',$pay_method['weixin']['config'],$this->user_session,1);
            $go_query_param = $pay_class->query_order();
            file_put_contents("adam222.txt",json_encode($go_query_param),FILE_APPEND);
            //如果支付后同步查询支付成功，修改订单状态
            if($go_query_param['error'] === 0){
                D('Giftorder')->after_pay($go_query_param['order_param']);
            }
            $redirctUrl=C('config.site_url').'/wap.php?g=Wap&c=Gift&a=showResult&order_id='.$now_order['order_id'];
            redirect($redirctUrl);

        }else{
            $this->error_tips('访问异常！请重新登录。');
        }
    }


    public function showResult(){
        if(empty($this->user_session)){
            $this->error_tips("请先登录",U('Login/index'));

        }
        $orderid=$_GET["order_id"];
         $giftorder=D("Giftorder")->where(array("order_id"=>$orderid))->find();
         if(empty($giftorder)){
             $this->error_tips("未查询到该礼品");
         }
         $userinfo=D("User")->where(array("uid"=>$giftorder['uid']))->find();
         if(empty($userinfo)){
             $this->error_tips("未查询到礼品用户信息");
         }
        $avatar=new avatar_image();
        if(strpos($userinfo['avatar'],"http")===0){
            $user['avatar']=$userinfo["avatar"];
        }else{
            $user['avatar']=$avatar->get_image_by_path($userinfo['avatar'],C('config.site_url'))['image'];
        }
        $user["nickname"]=$userinfo['nickname'];
        $this->assign("userinfo",$user);
        $this->assign("order_id",$orderid);
        $this->assign("orderinfo",$giftorder);
        $this->display();



    }


    public function  receive(){
        if(empty($this->user_session)){
            $this->error_tips("请先登录",U('Login/index'));

        }
        $orderid=$_GET["order_id"];
        $orderinfo=D("Giftorder")->where(array("order_id"=>$orderid,"used"=>0))->find();
        if(empty($orderinfo)){
            $this->error_tips("亲,该充值卡已经领完啦~",U('Vip/index'));
        }
        $userinfo=D("User")->where(array("uid"=>$orderinfo['uid']))->find();
        if(empty($userinfo)){
            $this->error_tips("未查询到礼品用户信息",U('Vip/index'));
        }
        $avatar=new avatar_image();
        if(strpos($userinfo['avatar'],"http")===0){
            $user['avatar']=$userinfo["avatar"];
        }else{
            $user['avatar']=$avatar->get_image_by_path($userinfo['avatar'],C('config.site_url'))['image'];
        }
        $user["nickname"]=$userinfo['nickname'];
        $this->assign("userinfo",$user);

        $this->assign("orderinfo",$orderinfo);
        $this->assign("uid",$this->user_session['uid']);
        $this->display();
    }

    public function  receiveaction(){
        if(empty($this->user_session)){
          echo json_encode(array("error"=>1,"message"=>"您未登录，无法领取"));die;

        }

        if($this->user_session['uid']!=$_POST['userid']){
            echo json_encode(array("error"=>1,"message"=>"领取用户不一致"));die;
        }
        $orderid=$_POST["order_id"];
        $orderinfo=D("Giftorder")->where(array("order_id"=>$orderid,"used"=>0))->find();
        if(empty($orderinfo)){
            echo json_encode(array("error"=>1,"message"=>"礼品无效或已被领取"));die;
        }
        if(D("User")->where(array("uid"=>$this->user_session['uid']))->setInc("cardmoney",$orderinfo['payment_money'])){
            D("Giftorder")->where(array("order_id"=>$orderid,"used"=>0))->data(array("used"=>1,"receivetime"=>$_SERVER['REQUEST_TIME'],"receiveruid"=>$this->user_session['uid']))->save();
            echo json_encode(array("error"=>0,"message"=>"恭喜您，礼品已经充值到您的账户，赶快免费兑换农丁鲜生礼品吧！",url=>"http://www.xiaonongding.com/wap.php?c=Vip"));die;
        }

    }
}