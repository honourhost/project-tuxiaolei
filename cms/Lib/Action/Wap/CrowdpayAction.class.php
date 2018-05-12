<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/6
 * Time: 18:10
 */
class CrowdpayAction extends  BaseAction
{

    public function  check(){

        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！',U('Login/index'));
        }

        if(!in_array($_GET['type'],array('crowdfunding','meal','weidian','takeout', 'food','recharge','appoint','wxapp'))){
            $this->error_tips('订单来源无法识别，请重试。');
        }
        if($_GET['type'] == 'crowdfunding'){
         //   $now_order = D('Crowdorder')->get_pay_order($this->user_session['uid'],intval($_GET['order_id']));
            $now_order = D('Crowdorder')->where(array("uid"=>$this->user_session['uid'],"corder_id"=>$_GET['order_id']))->find();
        }else{
            $this->error_tips('非法的订单');
        }

        if(!empty($now_order)){
            if($now_order['paid']==1){
                $this->error_tips("订单已经支付了");
            }else{
            }
        }else{
            $this->error_tips("未查询到该订单");
        }
        $this->assign('order_info',$now_order);



        //用户信息
        $now_user = D('User')->get_user($this->user_session['uid']);
        if(empty($now_user)){
            $this->error_tips('未获取到您的帐号信息，请重试！');
        }

        $this->assign('now_user',$now_user);


            $pay_money = $now_order['total_money'];

        //需要支付的钱
        $this->assign('pay_money',$pay_money);

        $this->display();
    }

    public function go_pay(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！',U('Login/index'));
        }



                $now_order = D('Crowdorder')->where(array("uid"=>$this->user_session['uid'],"corder_id"=>$_POST['order_id']))->find();

        if(empty($now_order)){
            $this->error_tips("不错在的订单");
        }
        if($now_order['paid']==1){
            $this->error_tips("订单已经支付啦");
        }
        $order_info = $now_order;


        //用户信息
        $now_user = D('User')->get_user($this->user_session['uid']);
        if(empty($now_user)){
            $this->error_tips('未获取到您的帐号信息，请重试！');
        }

        $_POST['pay_type']="weixin";

        $pay_method = D('Config')->get_pay_method();
        if(empty($pay_method)){
            $this->error_tips('系统管理员没开启任一一种支付方式！');
        }
        if(empty($pay_method[$_POST['pay_type']])){
            $this->error_tips('您选择的支付方式不存在，请更新支付方式！');
        }


        $pay_class_name = "weixin";

        $import_result = import('@.ORG.pay.'.$pay_class_name);
        if(empty($import_result)){
            $this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
        }

        $pay_class = new $pay_class_name($order_info,$order_info['total_money'],$_POST['pay_type'],$pay_method[$_POST['pay_type']]['config'],$this->user_session,3);
        $go_pay_param = $pay_class->pay();
      file_put_contents("crowdfunding3.txt",$go_pay_param,FILE_APPEND);
        if(empty($go_pay_param['error'])){
            if(!empty($go_pay_param['url'])){
                $this->assign('url',$go_pay_param['url']);
                $this->display();
            }else if(!empty($go_pay_param['form'])){
                $this->assign('form',$go_pay_param['form']);
                $this->display();
            }else if(!empty($go_pay_param['weixin_param'])){
                $redirctUrl = C('config.site_url').'/wap.php?g=Wap&c=Crowdpay&a=weixin_back&order_type=crowd'.'&order_id='.$order_info['corder_id'];
                $this->assign('redirctUrl',$redirctUrl);
                $this->assign('pay_money',$order_info['total_money']);
                $this->assign('weixin_param',json_decode($go_pay_param['weixin_param']));
                $this->display('weixin_pay');
            }else{
                $this->error_tips('调用支付发生错误，请重试。');
            }
        }else{
            $this->error_tips($go_pay_param['msg']);
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

        $pay_class = new $pay_class_name('','',$pay_type,$pay_method[$pay_type]['config'],$this->user_session,3);
        $get_pay_param = $pay_class->return_url();

        if(empty($get_pay_param['error'])){
            if($get_pay_param['order_param']['order_type'] == 'crowd'){
             //   $pay_info = D('Group_order')->after_pay($get_pay_param['order_param']);
            }else{
                $this->error_tips('订单类型非法！请重新下单。');
            }
            if(empty($pay_info['error'])){
                if($get_pay_param['order_param']['pay_type'] == 'weixin'){
                    exit('<xml><return_code><![CDATA[SUCCESS]]></return_code></xml>');
                }
                $pay_info['msg'] = '订单付款成功！现在跳转.';
            }
            if(empty($pay_info['url'])){
                $this->error_tips($pay_info['msg']);
            }else{
                $pay_info['url'] = preg_replace('#/source/(\w+).php#','/wap.php',$pay_info['url']);
                $this->assign('pay_info',$pay_info);
                $this->display('after_pay');
            }
        }else{
            $this->error_tips($get_pay_param['msg']);
        }
    }

    //微信同步回调页面
    public function weixin_back(){
        switch($_GET['order_type']){
            case 'crowd':
                $now_order = D('Crowdorder')->where(array("uid"=>$this->user_session['uid'],"corder_id"=>$_GET['order_id']))->find();
                break;
            default:
                $this->error_tips('非法的订单');
        }
        $now_order['order_type'] = $_GET['order_type'];
        if(empty($now_order)){
            $this->error_tips('该订单不存在');
        }
        if($now_order['paid']){
            switch($_GET['order_type']){
                case 'crowd':
                    $redirctUrl = C('config.site_url').'/wap.php?c=My&a=crowdorder&order_id='.$now_order['corder_id'];
                    break;

            }
            redirect($redirctUrl);exit;
        }
        $import_result = import('@.ORG.pay.Weixin');
        $pay_method = D('Config')->get_pay_method();
        if(empty($pay_method)){
            $this->error_tips('系统管理员没开启任一一种支付方式！');
        }
        $pay_class = new Weixin($now_order,0,'weixin',$pay_method['weixin']['config'],$this->user_session,3);
        $go_query_param = $pay_class->crowdquery_order();
        file_put_contents("crowdorder.txt",json_encode($go_query_param),FILE_APPEND);
        if($go_query_param['error'] === 0){
            switch($_GET['order_type']){
                case 'crowd':
                    D('Crowdorder')->after_pay($go_query_param['order_param']);
                    break;

            }
        }
        switch($_GET['order_type']){
            case 'crowd':
                $redirctUrl = C('config.site_url').'/wap.php?g=Wap&c=My&a=crowdorder&order_id='.$now_order['corder_id'];
                break;

        }
        redirect($redirctUrl);
    }


}