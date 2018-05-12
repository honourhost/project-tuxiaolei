<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/10/28
 * Time: 9:39
 */
class GiftorderModel  extends Model
{



    //生成订单
    public function save_post_form($fastinfo,$user){


        $data_fast_order['order_name'] = $fastinfo['s_name'];
        $data_fast_order['total_money'] = $fastinfo['total_money'];

        $data_fast_order['add_time'] = $_SERVER['REQUEST_TIME'];
        $data_fast_order['openid'] = $user['openid'];
        $data_fast_order['uid'] = $user['uid'];
        $data_fast_order['submit_order_time'] = time();
        $data_fast_order["desc"]=$fastinfo['desc'];

        if($order_id = $this->data($data_fast_order)->add()){
            $data_fast_order['order_id']=$order_id;
            return array('error'=>0,'msg'=>'订单产生成功！','order_info'=>$data_fast_order);
        }else{
            print_r($this->getLastSql());die;
            return array('error'=>1,'msg'=>'订单产生失败！请重试');
        }
    }


    //支付之后
    public function after_pay($order_param){
    //    unset($_SESSION['group_order']);
        $condition_fast_order['order_id'] = $order_param['order_id'];
        $now_order = $this->field(true)->where($condition_fast_order)->find();
        if(empty($now_order)){
            return array('error'=>1,'msg'=>'当前订单不存在！');
        }else if($now_order['paid'] == 1){
            if($order_param['is_mobile']){
                return array('error'=>1,'msg'=>'该订单已付款！');
            }else{
                return array('error'=>1,'msg'=>'该订单已付款！');
            }
        }else{
            //得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
            $now_user = D('User')->get_user($now_order['uid']);
            if(empty($now_user)){
                return array('error'=>1,'msg'=>'没有查找到此订单归属的用户，请联系管理员！');
            }
            $condition_fast_order['order_id'] = $order_param['order_id'];

            $data_group_order['pay_time'] = $_SERVER['REQUEST_TIME'];
            $data_group_order['payment_money'] = floatval($order_param['pay_money']);
            $data_group_order['pay_type'] = $order_param['pay_type'];
            $data_group_order['third_id'] = $order_param['third_id'];
            $data_group_order['is_mobile_pay'] = $order_param['is_mobile'];
            $data_group_order['paid'] = 1;
            $data_group_order['last_time'] = time();
            $data_group_order['status'] = 1;
            //开启事务
            $this->startTrans();
            if($this->where($condition_fast_order)->data($data_group_order)->save()){
                $this->commit();

                if ($now_user['openid'] && $order_param['is_mobile']) {
                    $href = C('config.site_url').'/wap.php';
                    $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));

                    $model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => '支付提醒', 'keyword1' => $now_order['order_name'], 'keyword2' => $now_order['order_id'], 'keyword3' => $now_order['total_money'], 'remark' => '支付成功！'));

                }


                if($order_param['is_mobile']){
                    return array('error'=>0,'url'=>str_replace('/source/','/',U('My/gift
                    
                    7_order',array('order_id'=>$now_order['order_id']))));
                }else{
                    return array('error'=>0,'url'=>U('User/Index/group_order_view',array('order_id'=>$now_order['order_id'])));
                }
            }else{
                $this->rollback();
                return array('error'=>1,'msg'=>'修改订单状态失败，请联系系统管理员！');
            }
        }
    }


    public function get_order_by_id($uid,$order_id){
        $condition_group_order['order_id'] = $order_id;
        $condition_group_order['uid'] = $uid;
        return $this->field(true)->where($condition_group_order)->find();
    }


}