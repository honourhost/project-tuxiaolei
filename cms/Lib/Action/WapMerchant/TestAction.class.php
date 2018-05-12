<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/9/12
 * Time: 14:13
 */
class TestAction extends BaseAction
{
public function  index(){

    $pay_class_name = ucfirst("Alipay");
    $import_result = import('@.ORG.pay.'.$pay_class_name);
    $order_info=D("Group_order")->where(array("order_id"=>261510))->find();

    $pay_method = D('Config')->get_pay_method();
    $user=D("User")->where(array("uid"=>753))->find();
  //  echo json_encode($pay_method);die;
    $pay_class = new $pay_class_name($order_info,0.01,"alipay",$pay_method['alipay']['config'],$user,0);
    $go_pay_param = $pay_class->pay();
}
}