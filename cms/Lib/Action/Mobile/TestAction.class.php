<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/23
 * Time: 10:11
 */
class TestAction extends Action{
    public function index(){
        import('@.ORG.pay.Weixin');
        $pay_method = D('Config')->get_pay_method();
        if(empty($pay_method)){
            $this->error_tips('系统管理员没开启任一一种支付方式！');
        }
        $now_order=array(
            "order_type"=>"merchant_recharge",
            "order_id"=>"60"
        );
        $pay_class = new Weixin($now_order,0,'weixin',$pay_method['weixin']['config'],$this->user_session,1);
        $_POST["out_trade_no"]="merchant_recharge_60";
        $go_query_param = $pay_class->query_order();
        print_r($go_query_param);
    }
}