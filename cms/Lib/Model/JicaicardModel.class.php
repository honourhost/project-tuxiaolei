<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/10/26
 * Time: 14:05
 */
class JicaicardModel extends Model
{


    public function get_pay_order($uid,$order_id,$is_web=false){
        $now_order = $this->get_order_by_id($uid,$order_id);
        // dump($this);exit;
        if(empty($now_order)){
            return array('error'=>1,'msg'=>'当前订单不存在！');
        }

        if($is_web){
            $order_info = array(
                'order_id'			=>	$now_order['record_id'],
                'order_type'		=>	'jicaicard',
                'order_total_money'	=>	floatval($now_order['totalmoney']),
                'order_content'    =>  array(
                    0=>array(
                        'name'  		=> '集采订单*'.$now_order["record_id"],
                        'num'   		=> 1,
                        'price' 		=> floatval($now_order['totalmoney']),
                        'money' 	=> floatval($now_order['totalmoney']),
                    )
                )
            );
        }else{
            $order_info = array(
                'order_id'			=>	$now_order['record_id'],
                'order_type'		=>		'jicaicard',
                'order_name'		=>	'集采订单*'.$now_order["record_id"],
                'order_num'			=>	1,
                'order_price'		=>	floatval($now_order['totalmoney']),
                'order_total_money'	=>	floatval($now_order['totalmoney']),
            );
        }
        return array('error'=>0,'order_info'=>$order_info);
    }



    public function get_order_by_id($uid,$order_id){
        $condition_user_recharge_order['uid'] = $uid;
        $condition_user_recharge_order['record_id'] = $order_id;
        return $this->field(true)->where($condition_user_recharge_order)->find();
    }


    //电脑站支付前订单处理
    public function web_befor_pay($order_info,$now_user){


        return array('error_code'=>false,'pay_money'=>$order_info['order_total_money']);

    }


    public function after_pay($order_param){
        $where['record_id'] = $order_param['order_id'];
        file_put_contents("jicai.txt",json_encode($order_param),FILE_APPEND);
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
            $jicaiorderdata=D("Jicaiorder");
          //  $jicaicard=D("Jicaicard")->where(array("record_id"=>$now_order["record_id"]))->find();
            $adamid=$now_order["adam_id"];
            if($this->where($where)->save($data_user_recharge_order)){
               $jicaiorderdata->where(array("adam_id"=>$adamid))->data(array("paid"=>1,"pay_time"=>time(),"third_id"=>$order_param["third_id"],"pay_type"=>$order_param['pay_type']))->save();
             //   return array("error"=>0,'msg'=>"修改稿订单状态成功");
                file_put_contents("jicai2.txt",D()->getLastSql(),FILE_APPEND);

            }else{
                return array('error'=>1,'msg'=>'修改订单状态失败，请联系系统管理员！');
            }
        }
    }



}