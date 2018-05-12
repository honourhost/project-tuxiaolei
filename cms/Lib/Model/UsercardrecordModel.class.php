<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/7/7
 * Time: 15:37
 */
class UsercardrecordModel extends Model
{

    public function  after_pay($order_param)
    {
        //file_put_contents("cardapppay.txt",json_encode($order_param),FILE_APPEND);
        $condition_group_order['record_id'] = $order_param['order_id'];
      //  file_put_contents("paystatus.txt","failedDDDDD",FILE_APPEND);
        $now_order = $this->field(true)->where($condition_group_order)->find();

        if (empty($now_order)) {
            return array('error' => 1, 'msg' => '当前订单不存在！');
        } else if ($now_order['paid'] == 1) {

            return array('error' => 1, 'msg' => '该订单已付款！', 'record_id' => $now_order["record_id"]);

        } else {


            //得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
            $now_user = D('User')->get_user($now_order['uid']);
            if (empty($now_user)) {
                return array('error' => 1, 'msg' => '没有查找到此订单归属的用户，请联系管理员！');
            }

            $data_group_order['pay_time'] = $_SERVER['REQUEST_TIME'];
            $data_group_order['payment_money'] = floatval($order_param['pay_money']);
            $data_group_order['pay_type'] = $order_param['pay_type'];
            $data_group_order['third_id'] = $order_param['third_id'];
            $data_group_order['is_mobile_pay'] = $order_param['is_mobile'];
            $data_group_order['paid'] = 1;
            //开启事务
            $this->startTrans();
            if ($this->where($condition_group_order)->data($data_group_order)->save()) {
                $this->commit();
                //    $condition_group['group_id'] = $now_order['group_id'];
                //   D('Group')->where($condition_group)->setInc('sale_count',$now_order['num']);
                $orders = D("Group_order")->where(array("adam_id" => $now_order["adam_id"]))->select();
                if (empty($orders)) {
                    return array('error' => 1, 'msg' => '没有查询到相关订单');
                }
                $cardrecord=D("Usercardrecord")->where("record_id=".$order_param['order_id'])->find();
                if($cardrecord["couponid"]!=0){
                    D("Usercoupon")->where("id=".$cardrecord['couponid'])->data(array("comfirmed"=>1))->save();
                }

                $grouporderdata = D("Group_order");
                foreach ($orders as $key => $value) {
                    $condition_item["order_id"] = $value["order_id"];
                    $data_group_order1['pay_time'] = $_SERVER['REQUEST_TIME'];
                    $data_group_order1['payment_money'] = floatval($value["total_money"]);
                    $data_group_order1['pay_type'] = $order_param['pay_type'];
                    $data_group_order1['third_id'] = $order_param['third_id'];
                    $data_group_order1['is_mobile_pay'] = $order_param['is_mobile'];
                    $data_group_order1['paid'] = 1;
                    $grouporderdata->where($condition_item)->data($data_group_order1)->save();

                    if (C('config.sms_success_order') == 2 || C('config.sms_success_order') == 3) {
                        $merchant = D('Merchant')->where(array('mer_id' => $value['mer_id']))->find();
                        $sms_data['uid'] = 0;
                        $sms_data['mobile'] = $merchant['phone'];
                        $sms_data['sendto'] = 'merchant';
                        $sms_data['content'] = '顾客购买的' . $value['order_name'] . '的订单(订单号：' . $value['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已经完成了支付！';
                        Sms::sendSms($sms_data);
                    }


                }

                if ($now_user['openid'] && $order_param['is_mobile']) {
                    $href = C('config.site_url') . '/wap.php?g=Wap&c=My&a=group_order_list&status=1' ;
                    $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                    $model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->config['group_alias_name'] . '提醒', 'keyword1' => "购物车订单", 'keyword2' => $now_order['record_id'], 'keyword3' => $now_order['totalmoney'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => $this->config['group_alias_name'] . '成功，感谢您的使用'));

                }

                $sms_data = array('mer_id' => '629', 'store_id' => 0, 'type' => 'group');
                if (C('config.sms_success_order') == 1 || C('config.sms_success_order') == 3) {
                    $sms_data['uid'] = $now_order['uid'];
                    $sms_data['mobile'] = $now_user['phone'];
                    $sms_data['sendto'] = 'user';
                    $sms_data['content'] = '您的购物车订单(订单号：' . $now_order['record_id'] . ')已经完成支付!';
                    Sms::sendSms($sms_data);
                }


                if ($order_param['is_mobile']) {
                    return array('error' => 0, 'url' => str_replace('/source/', '/', U('My/group_order', array('order_id' => $now_order['order_id']))));
                } else {
                    return array('error' => 0, 'url' => U('User/Index/group_order_view', array('order_id' => $now_order['order_id'])));
                }
            } else {
                $this->rollback();
                return array('error' => 1, 'msg' => '修改订单状态失败，请联系系统管理员！');

            }

        }
    }
    public function  aliafter_pay($order_param)
    {
    //   file_put_contents("alicardapppay.txt",json_encode($order_param),FILE_APPEND);
        $condition_group_order['record_id'] = $order_param['order_id'];
        $now_order = $this->field(true)->where($condition_group_order)->find();

        if (empty($now_order)) {
            return array('error' => 1, 'msg' => '当前订单不存在！');
        } else if ($now_order['paid'] == 1) {

            return array('error' => 1, 'msg' => '该订单已付款！', 'record_id' => $now_order["record_id"]);

        } else {


            //得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
            $now_user = D('User')->get_user($now_order['uid']);
            if (empty($now_user)) {
                return array('error' => 1, 'msg' => '没有查找到此订单归属的用户，请联系管理员！');
            }

            $data_group_order['pay_time'] = $_SERVER['REQUEST_TIME'];
            $data_group_order['payment_money'] = floatval($order_param['pay_money']);
            $data_group_order['pay_type'] = $order_param['pay_type'];
            $data_group_order['third_id'] = $order_param['third_id'];
            $data_group_order['is_mobile_pay'] = $order_param['is_mobile'];
            $data_group_order['paid'] = 1;
            //开启事务
            $this->startTrans();
            if ($this->where($condition_group_order)->data($data_group_order)->save()) {
                $this->commit();

                $cardrecord=D("Usercardrecord")->where("record_id=".$order_param['order_id'])->find();
                if($cardrecord["couponid"]!=0){
                    D("Usercoupon")->where("id=".$cardrecord['couponid'])->data(array("comfirmed"=>1))->save();
                }
                //    $condition_group['group_id'] = $now_order['group_id'];
                //   D('Group')->where($condition_group)->setInc('sale_count',$now_order['num']);
                $orders = D("Group_order")->where(array("adam_id" => $now_order["adam_id"]))->select();
                if (empty($orders)) {
                    return array('error' => 1, 'msg' => '没有查询到相关订单');
                }
                $grouporderdata = D("Group_order");
                foreach ($orders as $key => $value) {
                    $condition_item["order_id"] = $value["order_id"];
                    $data_group_order1['pay_time'] = $_SERVER['REQUEST_TIME'];
                    $data_group_order1['payment_money'] = floatval($value["total_money"]);
                    $data_group_order1['pay_type'] = $order_param['pay_type'];
                    $data_group_order1['third_id'] = $order_param['third_id'];
                    $data_group_order1['is_mobile_pay'] = $order_param['is_mobile'];
                    $data_group_order1['paid'] = 1;
                    $grouporderdata->where($condition_item)->data($data_group_order1)->save();

                    if (C('config.sms_success_order') == 2 || C('config.sms_success_order') == 3) {
                        $merchant = D('Merchant')->where(array('mer_id' => $value['mer_id']))->find();
                        $sms_data['uid'] = 0;
                        $sms_data['mobile'] = $merchant['phone'];
                        $sms_data['sendto'] = 'merchant';
                        $sms_data['content'] = '顾客购买的' . $value['order_name'] . '的订单(订单号：' . $value['order_id'] . '),在' . date('Y-m-d H:i:s') . '时已经完成了支付！';
                        Sms::sendSms($sms_data);
                    }


                }

                if ($now_user['openid'] && $order_param['is_mobile']) {
                    $href = C('config.site_url') . '/wap.php?g=Wap&c=My&a=group_order_list&status=1' ;
                    $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                    $model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->config['group_alias_name'] . '提醒', 'keyword1' => "购物车订单", 'keyword2' => $now_order['record_id'], 'keyword3' => $now_order['totalmoney'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => $this->config['group_alias_name'] . '成功，感谢您的使用'));

                }

                $sms_data = array('mer_id' => '629', 'store_id' => 0, 'type' => 'group');
                if (C('config.sms_success_order') == 1 || C('config.sms_success_order') == 3) {
                    $sms_data['uid'] = $now_order['uid'];
                    $sms_data['mobile'] = $now_user['phone'];
                    $sms_data['sendto'] = 'user';
                    $sms_data['content'] = '您的购物车订单(订单号：' . $now_order['record_id'] . ')已经完成支付!';
                    Sms::sendSms($sms_data);
                }


                if ($order_param['is_mobile']) {
                    return array('error' => 0, 'url' => str_replace('/source/', '/', U('My/group_order', array('order_id' => $now_order['order_id']))));
                } else {
                    return array('error' => 0, 'url' => U('User/Index/group_order_view', array('order_id' => $now_order['order_id'])));
                }
            } else {
                $this->rollback();
                return array('error' => 1, 'msg' => '修改订单状态失败，请联系系统管理员！');

            }

        }
    }
}