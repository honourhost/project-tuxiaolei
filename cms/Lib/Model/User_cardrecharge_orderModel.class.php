<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/10/7
 * 品鲜卡
 * Time: 10:46
 */
class User_cardrecharge_orderModel extends  Model{

    public function get_pay_order($uid,$order_id,$is_web=false){
        $now_order = $this->get_order_by_id($uid,$order_id);
        // dump($this);exit;
        if(empty($now_order)){
            return array('error'=>1,'msg'=>'当前订单不存在！');
        }

        if($is_web){
            $order_info = array(
                'order_id'			=>	$now_order['order_id'],
                'order_type'		=>	'cardrecharge',
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
                'order_type'		=>	'cardrecharge',
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


    //电脑站支付前订单处理
    public function web_befor_pay($order_info,$now_user){

        $data_user_recharge_order['last_time'] = $_SERVER['REQUEST_TIME'];
        $data_user_recharge_order['submit_order_time'] = $_SERVER['REQUEST_TIME'];
        $condition_user_recharge_order['order_id'] = $order_info['order_id'];
        if(!$this->where($condition_user_recharge_order)->data($data_user_recharge_order)->save()){
            return array('error_code'=>true,'msg'=>'保存订单失败！请重试或联系管理员。');
        }
        return array('error_code'=>false,'pay_money'=>$order_info['order_total_money']);

    }


    public function after_pay($order_param){
        $where['order_id'] = $order_param['order_id'];
        $now_order = $this->field(true)->where($where)->find();
        if(empty($now_order)){
            return array('error'=>1,'msg'=>'当前订单不存在');
        }else if($now_order['paid'] == 1){
            if($order_param['is_mobile']){
                return array('error'=>1,'msg'=>'该订单已付款！','url'=>U('My/index'));
            }else{
                return array('error'=>1,'msg'=>'该订单已付款！','url'=>U('User/Credit/index'));
            }
        }else{
            //得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
            $now_user = D('User')->get_user($now_order['uid']);
            if(empty($now_user)){
                return array('error'=>1,'msg'=>'没有查找到此订单归属的用户，请联系管理员！');
            }

            $data_user_recharge_order = array();
            $data_user_recharge_order['pay_time'] = $_SERVER['REQUEST_TIME'];
            $data_user_recharge_order['payment_money'] = floatval($order_param['pay_money']);
            $data_user_recharge_order['pay_type'] = $order_param['pay_type'];
            $data_user_recharge_order['third_id'] = $order_param['third_id'];
            $data_user_recharge_order['paid'] = 1;
            if($this->where($where)->save($data_user_recharge_order)){
                D('User')->add_vipcardmoney($now_order['uid'],$order_param['pay_money'],'在线充值');
            }else{
                return array('error'=>1,'msg'=>'修改订单状态失败，请联系系统管理员！');
            }
        }
    }
}