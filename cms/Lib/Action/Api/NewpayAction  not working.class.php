<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/27
 * Time: 14:14
 */
class NewpayAction extends  NewbaseAction
{
    /**
     *购物车支付
     */
    public function  go_cardpay(){
        if(empty($this->user_session)){
            $this->returnAjax('请先进行登录！',0);
        }
        if(!in_array($_POST['order_type'],array('group','meal','takeout','food','recharge','appoint','waimai','cardpay'))){
            $this->returnAjax('订单来源无法识别，请重试。',0);
        }
        $uid=$_SESSION["user"]["uid"];
        $recordid=$_POST["recordid"];
        $cardrecord=D("Usercardrecord")->where(array("record_id"=>$recordid,"uid"=>$uid))->find();
        if(empty($cardrecord)){
            $this->returnAjax("非法订单",0);
        }
        if($cardrecord['paid']==1){
            $this->returnAjax("订单已经支付了~",0);
        }
        $pay_method = D('Config')->get_pay_method();
        if(empty($pay_method)){
            $this->returnAjax('系统管理员没开启任一一种支付方式！',0);
        }
        if(empty($pay_method[$_POST['pay_type']])){
            $this->returnAjax('您选择的支付方式不存在，请更新支付方式！',0);
        }
        $pay_class_name = ucfirst($_POST['pay_type']);
        $import_result = import('@.ORG.pay.'.$pay_class_name);
        if(empty($import_result)){
            $this->returnAjax('系统管理员暂未开启该支付方式，请更换其他的支付方式',0);
        }
       // echo json_encode($cardrecord);die;
        $pay_class = new $pay_class_name($cardrecord,$cardrecord['totalmoney'],$_POST['pay_type'],$pay_method[$_POST['pay_type']]['config'],$this->user_session,1);
        $go_pay_param = $pay_class->cardapp_pay();
        if(empty($go_pay_param['error'])){
            if($pay_class_name == 'Weixin'){
                $this->returnAjax($go_pay_param['weixin_param'],1);
            }elseif($pay_class_name == 'Alipay'){
                $orderinfo=$this->getNewOrderInfo($go_pay_param['form']);
                $sign=$pay_class->sign($orderinfo);
                $go_pay_param['form']["sign"]=$sign;
                $this->returnAjax($go_pay_param['form'],1);
            }else{
                $this->returnAjax('调用支付发生错误，请重试。',0);
            }
        }else{
            $this->returnAjax($go_pay_param['msg'],0);
        }

    }

    /**
     *  微信端购物车支付
     */
    public function  wap_cardpay(){
        if(empty($this->user_session)){
            $this->returnAjax('请先进行登录！',0);
        }
        if(!in_array($_POST['order_type'],array('group','meal','takeout','food','recharge','appoint','waimai','cardpay'))){
            $this->returnAjax('订单来源无法识别，请重试。',0);
        }

        $uid=$_SESSION["user"]["uid"];
        $recordid=$_POST["recordid"];
        $cardrecord=D("Usercardrecord")->where(array("record_id"=>$recordid,"uid"=>$uid))->find();
        if(empty($cardrecord)){
            $this->returnAjax("非法订单",0);
        }
        if($cardrecord['paid']==1){
            $this->returnAjax("订单已经支付了~",0);
        }
        $pay_method = D('Config')->get_pay_method();
        if(empty($pay_method)){
            $this->returnAjax('系统管理员没开启任一一种支付方式！',0);
        }
        if(empty($pay_method[$_POST['pay_type']])){
            $this->returnAjax('您选择的支付方式不存在，请更新支付方式！',0);
        }
        $pay_class_name = ucfirst($_POST['pay_type']);
        $import_result = import('@.ORG.pay.'.$pay_class_name);
        if(empty($import_result)){
            $this->returnAjax('系统管理员暂未开启该支付方式，请更换其他的支付方式',0);
        }
        // echo json_encode($cardrecord);die;
        $pay_class = new $pay_class_name($cardrecord,$cardrecord['totalmoney'],$_POST['pay_type'],$pay_method[$_POST['pay_type']]['config'],$this->user_session,1);
        $go_pay_param = $pay_class->cardwap_pay();
        if(empty($go_pay_param['error'])){
            if($pay_class_name == 'Weixin'){
                $this->returnAjax($go_pay_param['weixin_param'],1);
            }elseif($pay_class_name == 'Alipay'){
                $orderinfo=$this->getNewOrderInfo($go_pay_param['form']);
                $sign=$pay_class->sign($orderinfo);
                $go_pay_param['form']["sign"]=$sign;
                $this->returnAjax($go_pay_param['form'],1);
            }else{
                $this->returnAjax('调用支付发生错误，请重试。',0);
            }
        }else{
            $this->returnAjax($go_pay_param['msg'],0);
        }

    }

    //购物车团购跳转通知
    public function  cardapp_weixin_return_url(){
        $pay_type = $_GET['pay_type'];
        $pay_method = D('Config')->get_pay_method();
        if(empty($pay_method)){
            exit('<xml><return_code><![CDATA[FAIL]]></return_code></xml>');
        }
        if(empty($pay_method[$pay_type])){
            exit('<xml><return_code><![CDATA[FAIL]]></return_code></xml>');
        }

        $pay_class_name = ucfirst($pay_type);
        $import_result = import('@.ORG.pay.'.$pay_class_name);
        if(empty($import_result)){
            exit('<xml><return_code><![CDATA[FAIL]]></return_code></xml>');
        }

        $pay_class = new $pay_class_name('','',$pay_type,$pay_method[$pay_type]['config'],$this->user_session,1);
        $get_pay_param = $pay_class->cardapp_return_url();
   //     file_put_contents("cardpay.txt",json_encode($get_pay_param),FILE_APPEND);
        if(empty($get_pay_param['error'])){
            if($get_pay_param['order_param']['order_type'] == 'cardpay'){
                $pay_info = D('Usercardrecord')->after_pay($get_pay_param['order_param']);
            }else{
                exit('<xml><return_code><![CDATA[FAIL]]></return_code></xml>');
            }
            if(empty($pay_info['error'])){
                if($get_pay_param['order_param']['pay_type'] == 'weixin'){
                    exit('<xml><return_code><![CDATA[SUCCESS]]></return_code></xml>');
                }
            }
        }else{
            exit('<xml><return_code><![CDATA[FAIL]]></return_code></xml>');
        }
    }

    public function  cardwap_weixin_return_url(){
        $pay_type = $_GET['pay_type'];
        $pay_method = D('Config')->get_pay_method();
        if(empty($pay_method)){
            exit('<xml><return_code><![CDATA[FAIL]]></return_code></xml>');
        }
        if(empty($pay_method[$pay_type])){
            exit('<xml><return_code><![CDATA[FAIL]]></return_code></xml>');
        }

        $pay_class_name = ucfirst($pay_type);
        $import_result = import('@.ORG.pay.'.$pay_class_name);
        if(empty($import_result)){
            exit('<xml><return_code><![CDATA[FAIL]]></return_code></xml>');
        }

        $pay_class = new $pay_class_name('','',$pay_type,$pay_method[$pay_type]['config'],$this->user_session,1);
        $get_pay_param = $pay_class->cardapp_return_url();
        file_put_contents("cardwappay.txt",json_encode($get_pay_param),FILE_APPEND);
        if(empty($get_pay_param['error'])){
            if($get_pay_param['order_param']['order_type'] == 'cardpay'){
                $pay_info = D('Usercardrecord')->after_pay($get_pay_param['order_param']);
            }else{
                exit('<xml><return_code><![CDATA[FAIL]]></return_code></xml>');
            }
            if(empty($pay_info['error'])){
                if($get_pay_param['order_param']['pay_type'] == 'weixin'){
                    exit('<xml><return_code><![CDATA[SUCCESS]]></return_code></xml>');
                }
            }
        }else{
            exit('<xml><return_code><![CDATA[FAIL]]></return_code></xml>');
        }
    }
    //跳转通知
    public function cardapp_alipay_return_url(){
      //  file_put_contents("cardalifirst.txt","first step",FILE_APPEND);
        $pay_type = $_GET['pay_type'];
        $pay_method = D('Config')->get_pay_method();

        if(empty($pay_method)){
            echo "fail";die;
        }
        if(empty($pay_method[$pay_type])){
            echo "fail";die;
        }

        $pay_class_name = ucfirst($pay_type);
        $import_result = import('@.ORG.pay.'.$pay_class_name);
        if(empty($import_result)){
            echo "fail";die;
        }

        $pay_class = new $pay_class_name('','',$pay_type,$pay_method[$pay_type]['config'],$this->user_session,1);
        $get_pay_param = $pay_class->cardapp_return_url();
        file_put_contents("alicard.txt",json_encode($get_pay_param),FILE_APPEND);
        if(empty($get_pay_param['error'])){
            if($get_pay_param['order_param']['order_type'] == 'cardpay'){
                //  $pay_info = D('Group_order')->after_pay($get_pay_param['order_param']);
                $pay_info=       D('Usercardrecord')->aliafter_pay($get_pay_param['order_param']);
            }else{
                echo "fail";die;
            }
            // if($get_pay_param['order_param']['pay_type'] == 'yeepay' && $pay_info['url']){
            // $pay_info['url'] = str_replace('/source/web_yeepay.php','/index.php',$pay_info['url']);
            // }
            if(empty($pay_info['error'])){
                if($get_pay_param['order_param']['pay_type'] == 'alipay'){
                    echo "success";die;
                }
            }
        }else{
            echo "fail";die;
        }
    }

    public function  test(){
        echo  $_SESSION["openid"];
    }


    /**
     * create the order info. 创建订单信息
     */
private function getNewOrderInfo($order) {
$orderinfo="partner=\"208822176505229\"&seller_id=\"xiaonongding@163.com\"&out_trade_no=\"".$order["order_sn"]."\"&subject=\"".$order["name"]."\"&body=\"".$order["name"]."\"&total_fee=\"".$order["amount"].
    "\"&notify_url=\"http://www.xiaonongding.com/source/cardapp_alipay_notice.php\"&service=\"mobile.securitypay.pay\"&payment_type=\"1\"&_input_charset=\"utf-8\"&it_b_pay=\"1m\"&return_url=\"m.alipay.com\"";
return $orderinfo;

}

}