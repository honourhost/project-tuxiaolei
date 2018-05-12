<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/6
 * Time: 17:52
 */
class CrowdorderModel extends Model
{

    public function save_post_form($group,$uid,$order_id){
        $data_group_order['cgrade_id'] = $group['grade_id'];
        $data_group_order['crowd_id'] = $group['crowd_id'];
        $data_group_order['mer_id']=$group["mer_id"];

        $data_group_order['num'] = 1;
        if(empty($data_group_order['num'])){
            return array('error'=>1,'msg'=>'请输入正确的购买数量！');
        }
        $data_group_order['name'] = $group['title'].'*'.$data_group_order['num'];
        $data_group_order['price'] = $group['price'];
        $data_group_order['total_money'] = $group['price'] * $data_group_order['num'];
        $data_group_order['add_time'] = $_SERVER['REQUEST_TIME'];
            $now_adress = D('User_adress')->get_one_adress($uid, $group['adress_id']);
            if (empty($now_adress)) {
                return array('error' => 1, 'msg' => '请先添加收货地址！');
            }
            $data_group_order['contact_name'] = $now_adress['name'];
            $data_group_order['phone'] = $now_adress['phone'];
            $data_group_order['zipcode'] = $now_adress['zipcode'];
            $data_group_order['address'] = $now_adress['province_txt'] . ' ' . $now_adress['city_txt'] . ' ' . $now_adress['area_txt'] . ' ' . $now_adress['adress'];

            $data_group_order['delivery_comment'] = $_POST['delivery_comment'];

        if($order_id){
            $condition_group_order['corder_id'] = $order_id;
            $condition_group_order['uid'] = $uid;
            $save_result = $this->where($condition_group_order)->data($data_group_order)->save();
            if($save_result){
                return array('error'=>0,'msg'=>'订单修改成功！','order_id'=>$order_id);
            }else{
                return array('error'=>1,'msg'=>'订单修改失败！请重试','order_id'=>$order_id);
            }
        }else{
            $data_group_order['uid'] = $uid;

            $order_id = $this->data($data_group_order)->add();

            if($order_id){
                if ($_SESSION['openid']) {
                    $href = C('config.site_url').'/wap.php?c=My&a=crowdorder&order_id='.$order_id;
                    $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
                    $model->sendTempMsg('OPENTM201682460', array('href' => $href, 'wecha_id' => $_SESSION['openid'], 'first' => '您好，您的众筹订单'.$data_group_order['order_name'].'已生成', 'orderno' =>$order_id, 'refundno' => $data_group_order['num'], 'refundproduct' => $data_group_order['total_money'], 'remark' => '您的该次'.$this->config['group_alias_name'].'下单成功，感谢您的使用！'));
                }
                $sms_data = array('mer_id' => $group['mer_id'], 'store_id' => 0, 'type' => 'group');
                if (C('config.sms_place_order') == 1 || C('config.sms_place_order') == 3) {
                    $sms_data['uid'] = $uid;
                    $sms_data['mobile'] = $data_group_order['phone'];
                    $sms_data['sendto'] = 'user';
                    $sms_data['content'] = '您在' . date("Y-m-d H:i:s") . '时，购买了' . $group['s_name'] . '，已成功生产订单，订单号：' . $order_id;
                    Sms::sendSms($sms_data);
                }
                if (C('config.sms_place_order') == 2 || C('config.sms_place_order') == 3) {
                    $merchant = D('Merchant')->where(array('mer_id' => $group['mer_id']))->find();
                    $sms_data['uid'] = 0;
                    $sms_data['mobile'] = $merchant['phone'];
                    $sms_data['sendto'] = 'merchant';
                    $sms_data['content'] = '有份新的' . $group['s_name'] . '被购买，订单号：' . $order_id . '请您注意查看并处理!';
                    Sms::sendSms($sms_data);
                }

                return array('error'=>0,'msg'=>'订单产生成功！','order_id'=>$order_id);
            }else{
                return array('error'=>1,'msg'=>'订单产生失败！请重试');
            }
        }
    }


    //支付之后
    public function after_pay($order_param){
        unset($_SESSION['group_order']);
        $condition_group_order['corder_id'] = $order_param['order_id'];
        $now_order = $this->field(true)->where($condition_group_order)->find();
        if(empty($now_order)){
            return array('error'=>1,'msg'=>'当前订单不存在！');
        }else if($now_order['paid'] == 1){

                return array('error'=>1,'msg'=>'该订单已付款！','url'=>U('My/crowdorder',array('order_id'=>$now_order['corder_id'])));

        }else{



            //得到当前用户信息，不将session作为调用值，因为可能会失效或错误。
            $now_user = D('User')->get_user($now_order['uid']);
            if(empty($now_user)){
                return array('error'=>1,'msg'=>'没有查找到此订单归属的用户，请联系管理员！');
            }

            $condition_group_order['corder_id'] = $order_param['order_id'];

            $data_group_order['paytime'] = $_SERVER['REQUEST_TIME'];
            $data_group_order['payment_money'] = floatval($order_param['pay_money']);
            $data_group_order['paytype'] = $order_param['pay_type'];
            $data_group_order['third_id'] = $order_param['third_id'];
            $data_group_order['status'] = 1;
            $data_group_order['paid'] = 1;
            //开启事务
            $this->startTrans();
            if($this->where($condition_group_order)->data($data_group_order)->save()){
                $this->commit();
                $condition_grade['grade_id'] = $now_order['cgrade_id'];
                $condition_crowd["crowd_id"]=$now_order['crowd_id'];
                D('Crowdgrade')->where($condition_grade)->setInc('supportnum',1);
                D('Crowdfunding')->where($condition_crowd)->setInc('dealnum',1);
                D('Crowdfunding')->where($condition_grade)->setInc('funds',floatval($order_param['pay_money']));
                D("Crowdrecord")->data(array("uid"=>$now_order['uid'],"crowd_id"=>$now_order['crowd_id'],"grade_id"=>$now_order['cgrade_id'],"pay_time"=>$_SERVER['REQUEST_TIME']))->add();


                if ($now_user['openid'] && ($order_param['is_mobile']==3)) {
                    $href = C('config.site_url').'/wap.php?c=My&a=crowdorder&order_id='.$now_order['corder_id'];
                    $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));

                        $model->sendTempMsg('OPENTM201752540', array('href' => $href, 'wecha_id' => $now_user['openid'], 'first' => $this->config['group_alias_name'].'众筹提醒', 'keyword1' => $now_order['name'], 'keyword2' => $now_order['corder_id'], 'keyword3' => $now_order['total_money'], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => '成功，感谢您的使用'));

                }


                $sms_data = array('mer_id' => $now_order['mer_id'], 'store_id' => 0, 'type' => 'group');
                if (C('config.sms_success_order') == 1 || C('config.sms_success_order') == 3) {



                    $sms_data['uid'] = $now_order['uid'];
                    $sms_data['mobile'] = $now_order['phone'];
                    $sms_data['sendto'] = 'user';




                            $sms_data['content'] = '您购买 '.$now_order['name'].'的众筹(订单号：' . $now_order['corder_id'] . ')已经完成支付!';





                    Sms::sendSms($sms_data);
                }
                if (C('config.sms_success_order') == 2 || C('config.sms_success_order') == 3) {
                    $merchant = D('Merchant')->where(array('mer_id' => $now_order['mer_id']))->find();
                    $sms_data['uid'] = 0;
                    $sms_data['mobile'] = $merchant['phone'];
                    $sms_data['sendto'] = 'merchant';
                    $sms_data['content'] = '顾客购买的' . $now_order['name'] . '的众筹订单(订单号：' . $now_order['corder_id'] . '),在' . date('Y-m-d H:i:s') . '时已经完成了支付！';
                    Sms::sendSms($sms_data);
                }


                    return array('error'=>0,'url'=>str_replace('/source/','/',U('My/crowdorder',array('order_id'=>$now_order['corder_id']))));

            }else{
                $this->rollback();
                return array('error'=>1,'msg'=>'修改订单状态失败，请联系系统管理员！');
            }
        }
    }

}