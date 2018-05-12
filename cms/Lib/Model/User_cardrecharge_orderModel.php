<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/10/7
 * 品鲜卡
 * Time: 10:46
 */
class User_cardrecharge_order extends  Model{

    public function get_pay_order($uid,$order_id,$is_web=false){
        $now_order = $this->get_order_by_id($uid,$order_id);
        // dump($this);exit;
        if(empty($now_order)){
            return array('error'=>1,'msg'=>'当前订单不存在！');
        }

        if($is_web){
            $order_info = array(
                'order_id'			=>	$now_order['order_id'],
                'order_type'		=>	'recharge',
                'order_total_money'	=>	floatval($now_order['money']),
                'order_content'    =>  array(
                    0=>array(
                        'name'  		=> '在线充值',
                        'num'   		=> 1,
                        'price' 		=> floatval($now_order['money']),
                        'money' 	=> floatval($now_order['money']),
                    )
                )
            );
        }else{
            $order_info = array(
                'order_id'			=>	$now_order['order_id'],
                'order_type'		=>	'recharge',
                'order_name'		=>	'在线充值',
                'order_num'			=>	1,
                'order_price'		=>	floatval($now_order['money']),
                'order_total_money'	=>	floatval($now_order['money']),
            );
        }
        return array('error'=>0,'order_info'=>$order_info);
    }


    public function get_order_by_id($uid,$order_id){
        $condition_user_recharge_order['uid'] = $uid;
        $condition_user_recharge_order['order_id'] = $order_id;
        return $this->field(true)->where($condition_user_recharge_order)->find();
    }
}