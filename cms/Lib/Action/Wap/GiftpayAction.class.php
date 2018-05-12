<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/10/28
 * Time: 9:56
 */
class GiftpayAction  extends BaseAction
{
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
        // file_put_contents("giftpay.txt","zenglizhifu",FILE_APPEND);
        $pay_class = new $pay_class_name('','',$pay_type,$pay_method[$pay_type]['config'],$this->user_session,1);
        $get_pay_param = $pay_class->return_url();
        if(empty($get_pay_param['error'])){
            if($get_pay_param['order_param']['order_type'] == 'giftorder'){
                $pay_info = D('Giftorder')->after_pay($get_pay_param['order_param']);
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
                $pay_info['url'] = preg_replace('#/source/(\w+).php#','/adam.php',$pay_info['url']);
                $this->assign('pay_info',$pay_info);
                $this->display('after_pay');
            }
        }else{
            $this->error_tips($get_pay_param['msg']);
        }
    }
}