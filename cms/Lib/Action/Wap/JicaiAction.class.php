<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/10/24
 * Time: 17:23
 */
class JicaiAction   extends  BaseAction
{


    public  $mer_id=0;
    public $session_jicai = '';
    public function __construct()
    {

        parent::__construct();
        $this->mer_id=isset($_REQUEST["mer_id"])?$_REQUEST["mer_id"]:629;
        $this->assign("mer_id",$this->mer_id);
    }


    public function  index(){
    $mer_id=$_GET["mer_id"];
    if(empty($mer_id)){
        $this->error_tips("未知商家");
    }
    $now=$_SERVER["REQUEST_TIME"];
    $condition="`begin_time` < ".$now." AND `end_time` > ".$now." AND `mer_id`= ".$mer_id;
    $jicais=D("Jicai")->where($condition)->select();
    if(empty($jicais)){
        $this->error_tips("没有产品");
    }
    $groupimage=new group_image();
    foreach ($jicais as $key=>$value){
        $jicais[$key]['pic']=$groupimage->get_image_by_path($value["pic"],"s");
    }
    $this->assign("merid",$mer_id);
    $this->assign("jicais",$jicais);
    $this->display();
}

    public function  test(){
        $mer_id=$_GET["mer_id"];
        if(empty($mer_id)){
            $this->error_tips("未知商家");
        }
        $database_group = D('Jicai');
        $now=$_SERVER["REQUEST_TIME"];
        $condition1="mer_id =".$mer_id;
        $condition="`begin_time` < ".$now." AND `end_time` > ".$now." AND `mer_id`= ".$mer_id;
        $group_image_class = new group_image();
        $recommends=$database_group->where($condition." AND recommend =1 ")->select();
        foreach ( $recommends as $key=>$value){
            $tmp_pic_arr = explode(';', $value['pic']);
            $recommends[$key]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
        }

        $this->assign("recommends",$recommends);


        $jicaicates=D("Jicai_cate")->where($condition1)->order('sort DESC')->select();

        foreach ($jicaicates as $key=>$value){

            $group_list = $database_group->field(true)->where($condition." AND `jicaitype` = ".$value["sort_id"])->order('`group_id` DESC')->select();

            if(empty($group_list)){
                unset($jicaicates[$key]);
            }else{
                foreach ($group_list as $key1 => $value1) {
                    $tmp_pic_arr = explode(';', $value1['pic']);
                    $group_list[$key1]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
                }

                $jicaicates[$key]["jicais"]=$group_list;
            }

        }
     $this->assign("jicaicates",$jicaicates);
     //   echo  json_encode($jicaicates);die;
        $this->display("test");
    }


    public function  detail(){
        $group_id=$_GET["groupid"];

        $jicai=D("Jicai")->where(array("group_id"=>$group_id))->find();
        if(empty($jicai)){
            $this->error_tips("未找到产品");
        }

        $groupimage=new group_image();
        $jicai["pic"]=$groupimage->get_image_by_path($jicai['pic'],'s');
        $this->assign("jicai",$jicai);
        $merid=$jicai["mer_id"];
        $now=$_SERVER["REQUEST_TIME"];
        $condition="`begin_time` < ".$now." AND `end_time` > ".$now." AND `mer_id`= ".$merid." AND group_id <> ".$group_id;
        $youlikes=D("Jicai")->where($condition)->select();

        foreach ($youlikes as $key=>$value){


            $youlikes[$key]['pic']=$groupimage->get_image_by_path($value["pic"],"s");
        }

        $this->assign("youlikes",$youlikes);

        $merchant=D("Merchant")->where(array("mer_id"=>$merid))->find();
        $merimage=new merchant_image();
        $merchant['pic']="http://www.xiaonongding.com/jicai.jpg";
        $this->assign("merchant",$merchant);
        $this->display();




    }


public function  processOrder(){
    $this->isLogin(true);
    $foods = $_POST['cart'];
    $disharr = array();
    $sure_dish = unserialize($_SESSION[$this->session_jicai]);
    foreach ($foods as $kk => $vv) {
        $count = $vv['count'] ? intval($vv['count']) : 0;
        if ($count > 0) {
            $disharr[$vv['id']] = array('id' => $vv['id'], 'num' => $count, 'omark' => '');
            if (isset($sure_dish[$vv['id']]['omark']) && $sure_dish[$vv['id']]['omark']) {
                $disharr[$vv['id']]['omark'] = $sure_dish[$vv['id']]['omark'];
            }
        }
    }

    empty($disharr) && exit(json_encode(array('error' => 1, 'msg' => '您尚未点菜！')));
    $_SESSION[$this->session_jicai] = serialize($disharr);
 //   echo json_encode( unserialize($_SESSION[$this->session_jicai]) );die;
    exit(json_encode(array('error' => 0, 'msg' => 'ok')));


}



    public function sureorder(){
        $this->isLogin();
        $sure_dish = unserialize($_SESSION[$this->session_jicai]);
        if(empty($sure_dish)){
            $this->error_tips("请先选择商品");
        }

        $group=D("Jicai");
        $goods=array();
        foreach ($sure_dish as  $k=>$v){
            $good=$group->field("name,price")->where("group_id = ".$k)->find();
            $good['num']=$v['num'];
            array_push($goods,$good);


        }
     //   echo json_encode($goods);die;
        $groupdatabase=D("Jicai");
        $money=0;
        foreach ($sure_dish as $key=>$value){
            $group=$groupdatabase->where("group_id = ".$value["id"])->find();
            if(empty($group)){
                $this->error_tips("非法请求");
            }
            $money+=round($group["price"],2)*intval($value["num"]);


        }
        $usernow=D("User")->where(array("uid"=>$this->user_session["uid"]))->find();

        $this->assign("totalmoney",$money);
        $_SESSION["totalmoney"]=$money;
        $user_info = D('User_adress')->get_one_adress($this->user_session['uid'], intval($_GET['adress_id']));
        $this->assign('date', date('Y-m-d'));
        $this->assign('time', date('H:i', time() + 1200));
        $this->assign('user_info', $user_info);
        $this->assign("goods",$goods);
        $this->display();
    }


    public function  saveorder(){
        $this->isLogin();
        $sure_dish = unserialize($_SESSION[$this->session_jicai]);
        if(empty($sure_dish)){
            //  $this->error_tips("请先选择商品");
            echo  json_encode(array("status"=>0,"message"=>"请先选择商品"));die;
        }

        $contact=$_POST["name"];
        $phone=$_POST["tel"];
        $address=$_POST["address"];
        $groupdatabase=D("Jicai");
        $grouporder=D("Jicaiorder");
        $adamid=create_uuid("adam");
        $nowtime=$_SERVER["REQUEST_TIME"];
        $totalmoney=0;
        foreach ($sure_dish as $key=>$value){

            //  echo  $key."<br>";
            $group=$groupdatabase->where("group_id = ".$value["id"])->find();
            if(empty($group)){
                // $this->error_tips("非法请求");
                echo  json_encode(array("status"=>0,"message"=>"非法请求"));die;
            }
            $totalmoney+=round($group["price"],2)*intval($value["num"]);
            $data_group_order["order_name"]=$group["name"]."*".$value["num"];
            $data_group_order["uid"]=$this->user_session["uid"];
            $data_group_order["mer_id"]=$group["mer_id"];
            $data_group_order["group_id"]=$group["group_id"];
            $data_group_order["num"]=$value["num"];
            $data_group_order["price"]=$group["price"];
            $data_group_order["total_money"]=round($group['price'],2)*intval($value['num']);
            $data_group_order["contact_name"]=$contact;
            $data_group_order["phone"]=$phone;
            $data_group_order["adress"]=$address;
            $data_group_order["total_money"]= $data_group_order["total_money"];
            $data_group_order["add_time"]=time();
            $data_group_order["submit_order_time"]=time();
            $data_group_order["tuan_type"]=2;
            $data_group_order["adam_id"]=$adamid;
            if(  $grouporder->data($data_group_order)->add()){

            }else{
                echo  json_encode(array("status"=>0,"message"=>"非法请求"));die;
            }


        }
       if(D("Jicaicard")->data(array("add_time"=>$nowtime,"uid"=>$this->user_session["uid"],"totalmoney"=>$totalmoney,"adam_id"=>$adamid))->add()) {
            $adamorder=D("Jicaicard")->where(array("adam_id"=>$adamid))->find();
            if(!empty($adamorder)){
                $_SESSION[$this->session_index]=null;
                $_SESSION["totalmoney"]=0;
                echo  json_encode(array("status"=>1,"message"=>"提交订单成功，跳转支付","url"=>U('Pay/check', array('order_id' => $adamorder["record_id"], 'type'=>'jicaicard'))));die;
            }else{
                echo  json_encode(array("status"=>0,"message"=>"非法请求"));die;
            }

       }else{
           echo  json_encode(array("status"=>0,"message"=>"非法请求"));die;
       }

//
//        $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
//        $model->sendTempMsg('OPENTM201752540', array('href' => "http://www.xiaonongding.com/wap.php", 'wecha_id' => "oJfc-wc_lcbTtjLD6JHSQVfR5hXY", 'first' => '农丁鲜生消费提醒', 'keyword1' => "农丁鲜生VIP馆商品", 'keyword2' => "0", 'keyword3' => $_SESSION["totalmoney"], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => "请DM登录农丁鲜生商家后台发货"));

     //   echo  json_encode(array("status"=>1,"message"=>"恭喜您，兑换成功"));die;
    }


    /**
     * 确认购物车
     */
    public function cart()
    {
        $this->isLogin();
        $isclean = $this->_get('isclean', 'trim');
        $orid = $this->_get('orid', 'intval');

        if ($this->check_order($orid)) {
            $this->assign('action_url', U('Jicai/saveorder', array('mer_id' => $this->mer_id, 'orid' => $orid)));
            $this->assign('orid', $orid);
        } else {
            $this->assign('action_url', U('Jicai/sureorder', array('mer_id' => $this->mer_id)));
            $this->assign('orid', 0);
        }
        $level_off=false;
        $this->assign('level_off', $level_off);
        if ($isclean == 1) {
            $_SESSION[$this->session_index] = '';
            $disharr = '';
        } else {
            $disharr = unserialize($_SESSION[$this->session_index]);
        }
        if (!empty($disharr)) {
            $idarr = array_keys($disharr);
            $meal_image_class = new group_image();
            $dish = M("Jicai")->where(array('mer_id' => $this->mer_id, 'group_id' => array('in', $idarr), 'status' => 1))->select();
            foreach ($dish as $val) {
                $val['image'] = $meal_image_class->get_image_by_path($val['pic'],'s');
                $disharr[$val['group_id']] = array_merge($disharr[$val['group_id']], $val);
            }
        }

        $allmark = $_SESSION["allmark" .$this->mer_id];
        $this->assign('allmark', $allmark);
        $this->assign('ordishs', $disharr);
        $this->display();
    }

    private function check_order($order_id)
    {
        if ($order = D('Jicaiorder')->where(array('uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'order_id' => $order_id))->find()) {
            return $order;
        } else {
            return false;
        }
    }

    private function isLogin($ajax=false)
    {
        if(empty($this->user_session)){
            if(!$ajax){
                $this->error_tips('请先进行登录！',U('Login/index'));
            }else{
                exit(json_encode(array('error' => 0, 'msg' => '请先进行登录')));
            }

        }
    }


}