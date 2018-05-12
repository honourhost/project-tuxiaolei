<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/6
 * Time: 14:47
 */
class CrowdgradeAction extends BaseAction
{
public function  index(){
    $crowdid=$_REQUEST["crowdid"];
    if(empty($crowdid)){
        $this->error("undifined error occured");
    }
    $crowdgrades=D("Crowdgrade")->where(array("crowd_id"=>$crowdid))->select();
    $this->assign("crowdgrades",$crowdgrades);
//    echo  json_encode($crowdgrades);die;
    $this->display();
}

public function buy(){
    if(empty($this->user_session)){
        $this->error_tips('请先进行登录！',U('Login/index'));
    }
    $now_user = D('User')->get_user($this->user_session['uid']);
    if(empty($this->user_session['phone']) && !empty($now_user['phone'])){
        $_SESSION['user']['phone'] = $this->user_session['phone'] = $now_user['phone'];
    }
    $this->assign('now_user',$now_user);
    $nowgrade=D("Crowdgrade")->where(array("grade_id"=>$_GET["gradeid"]))->find();
    $nowgrade['user_adress'] = D('User_adress')->get_one_adress($this->user_session['uid'],intval($_GET['adress_id']));
    if(empty($nowgrade)){
        $this->error_tips('当前众筹不存在！');
    }
    $this->assign("nowgrade",$nowgrade);

    $this->display();
}

public function buyaction(){
    $gradeid=$_GET["gradeid"];
    if(IS_POST){
        $adressid=$_POST['adress_id'];
        $nowgrade=D("Crowdgrade")->where(array("grade_id"=>$gradeid))->find();
        $nowgrade['user_adress'] = D('User_adress')->get_one_adress($this->user_session['uid'],intval($adressid));
        $nowgrade['adress_id']=$adressid;
        $result = D('Crowdorder')->save_post_form($nowgrade,$this->user_session['uid'],0);
        if($result['error'] == 1){
            $this->error_tips($result['msg']);
        }
        redirect(U('Crowdpay/check',array('order_id'=>$result['order_id'],'type'=>'crowdfunding')));
    }
}
}