<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/13
 * Time: 9:24
 */
class CrowdorderAction extends  BaseAction
{


    public function  index(){
        $condition_table = array(C('DB_PREFIX').'crowdorder'=>'co', C('DB_PREFIX').'crowdfunding'=>'cf',C('DB_PREFIX').'crowdgrade'=>'cg', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m');
        $condition_where="`co`.`uid`=`u`.`uid` AND `co`.`mer_id`=`m`.`mer_id` AND `co`.`cgrade_id`=`cg`.`grade_id` AND `co`.`crowd_id`=`cf`.`crowd_id` AND `co`.`paid`='1'";

        if(empty($_GET['keyword'])){
            $order_count = D('')->where($condition_where)->table($condition_table)->count();
         //   echo  D()->getLastSql();die;
            import('@.ORG.system_page');
            $p = new Page($order_count,30);

            $order_list = D('')->field('`co`.`phone` AS `group_phone`,`co`.*,`cg`.`title`,`cg`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`cg`.`crowd_id`')->where($condition_where)->table($condition_table)->order('`co`.`status` ASC,`co`.`corder_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
            if(empty($order_list)){
                $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
            }

            //print_r($order_list);die;
            $this->assign('order_list',$order_list);

            $pagebar = $p->show();
            $this->assign('pagebar',$pagebar);
            $this->display();die;
        }else{
            if ($_GET['searchtype'] == 'corder_id') {
                $condition_where .= " AND `co`.`corder_id`=" . intval($_GET['keyword']);
            } elseif ($_GET['searchtype'] == 'name') {
                $condition_where .= " AND `u`.`nickname`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'phone') {
                $condition_where .= " AND `u`.`phone`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'title') {
                $condition_where .= " AND `cg`.`title`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'grade_id') {
                $condition_where .= " AND `o`.`cgrade_id`='" . htmlspecialchars($_GET['keyword']) . "'";
            }

            $order_count = D('')->where($condition_where)->table($condition_table)->count();
            import('@.ORG.system_page');
            $p = new Page($order_count,30);

            $order_list = D('')->field('`co`.`phone` AS `group_phone`,`co`.*,`cg`.`title`,`cg`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`cg`.`crowd_id`')->where($condition_where)->table($condition_table)->order('`o`.`status` ASC,`o`.`order_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
            if(empty($order_list)){
                $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
            }


            //print_r($order_list);die;
            $this->assign('order_list',$order_list);

            $pagebar = $p->show();
            $this->assign('pagebar',$pagebar);
            $this->display();die;
        }

        $this->display();

    }

    /**
     * 操作订单
     */
    public function order_edit(){
        $this->assign('bg_color','#F3F3F3');

        $database_group_order = D('Crowdorder');
        $database_group=D('Crowdgrade');
        $condition_group_order['corder_id'] = $_GET['order_id'];
        $order = $database_group_order->field('*')->where($condition_group_order)->find();
        $condition_group['grade_id']=$order['cgrade_id'];
        $fuzeren=$database_group->field(true)->where($condition_group)->find();
        if( $order['paid'] == 1){
            $express_list = D('Express')->get_express_list();
            $this->assign('express_list',$express_list);
        }

        $this->assign('now_order',$order);
        $this->assign('fuzeren',$fuzeren);
        $this->display();
    }


    public function group_express(){
      //  $now_order = D('Crowdorder')->get_order_detail_by_id_and_merId($_GET['mer_id'],$_GET['order_id'],false);
        $now_order = D('Crowdorder')->where("mer_id =".$_GET['mer_id']." and corder_id = ".$_GET['order_id'])->find();
      //  $this->error(D()->getLastSql());
        if(empty($now_order)){
            $this->error('此订单不存在！');
        }
        if($now_order['paid']!=1){
            $this->error('此订单尚未支付！');
        }
        if($now_order['status']>=2){
            $this->error('订单已经发货了，请勿重复填写！');
        }

        $condition_group_order['corder_id'] = $now_order['corder_id'];
        $data_group_order['express_type'] = $_POST['express_type'];
        $data_group_order['express_id'] = $_POST['express_id'];
        //    $data_group_order['last_staff'] = $this->staff_session['name'];
        if($now_order['paid'] == 1 && $now_order['status'] ==1){
            $data_group_order['status'] = 2;
            $data_group_order['use_time'] = $_SERVER['REQUEST_TIME'];
        }

        if(D('Crowdorder')->where($condition_group_order)->data($data_group_order)->save()){

            //加入快递信息
            $now_order['express_type']=$data_group_order['express_type'];
            $now_order['express_id']=$data_group_order['express_id'];
            $this->group_notice($now_order);

            $this->success('修改成功！');
        }else{
            $this->error('修改失败！请重试。');
        }
    }




    private function group_notice($order)
    {
        //积分
        D('User')->add_score($order['uid'],floor($order['total_money']*C('config.user_score_get')),'购买 '.$order['order_name'].' 消费'.floatval($order['total_money']).'元 获得积分');
        D('Userinfo')->add_score($order['uid'], $order['mer_id'], $order['total_money'], '购买 '.$order['order_name'].' 消费'.floatval($order['total_money']).'元 获得积分');

        //短信
        $sms_data = array('mer_id' => $order['mer_id'], 'type' => 'group');
        if ($this->config['sms_finish_order'] == 1 || $this->config['sms_finish_order'] == 3) {
            $sms_data['uid'] = $order['uid'];
            $sms_data['mobile'] = $order['phone'];
            $sms_data['sendto'] = 'user';


            //区分如果没有快递则直接发送消费
            if(!empty($order['express_type'])){
                //发送订单信息
                $order_name=$order['name'];
                if(strripos($order_name,"*")){
                    $send_name=substr($order_name,0,strripos($order_name,"*"))."共".substr($order_name,(strripos($order_name,"*")+1))."份";
                }else{
                    $send_name=$order_name;
                }
                //查询对应的快递信息
                $express=D("Express")->where("id=".$order['express_type'])->find();
                $user=D('user')->where(array("uid"=>$order['uid']))->find();
                if(!empty($user["openid"])){
                    $href = C('config.site_url').'/wap.php';
                    $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));

                    $model->sendTempMsg('OPENTM201541214', array('href' => $href, 'wecha_id' => $user['openid'], 'first' => '订单发货提醒', 'keyword1' => $order['corder_id'], 'keyword2' => $express['name'], 'keyword3' =>  $order['express_id'], 'remark' => '发货成功！'));
                }

                $sms_data['content'] = '您购买众筹 '.$send_name.'的订单(订单号：' . $order['corder_id'] . ')已经发货，物流信息：'.$express['name'].$order['express_id'].',亲有任何问题可随时咨询小农丁客服：400-665-7170';
            }
            Sms::sendSms($sms_data);
        }
        if ($this->config['sms_finish_order'] == 2 || $this->config['sms_finish_order'] == 3) {
            $sms_data['uid'] = 0;
            $sms_data['mobile'] = $order['phone'];
            $sms_data['sendto'] = 'merchant';
            $sms_data['content'] = '顾客购买的众筹' . $order['name'] . '的订单(订单号：' . $order['order_id'] . '),已经发货！';
            Sms::sendSms($sms_data);
        }


    }


}