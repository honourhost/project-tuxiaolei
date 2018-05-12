<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/27
 * Time: 15:42
 */
class UserAction extends BaseAction{
    public function recharge(){
        $data_user_recharge_order['uid'] = $this->now_user['uid'];
        $money = floatval($_GET['money']);
        if(empty($money) || $money > 10000){
            $this->error('请输入有效的金额！最高不能超过1万元。');
        }
        $data_user_recharge_order['money'] = $money;
        // $data_user_recharge_order['order_name'] = '帐户余额在线充值';
        $data_user_recharge_order['add_time'] = $_SERVER['REQUEST_TIME'];
        if($order_id = D('User_recharge_order')->data($data_user_recharge_order)->add()){
            redirect(U('Mobile/Pay/check',array('order_id'=>$order_id,'type'=>'recharge')));
        }else{
            $this->error('订单处理失败！请重试。');
        }
    }
}
