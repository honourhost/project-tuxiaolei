<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/7/19
 * Time: 12:55
 */
class VipAction extends BaseAction
{

    public $session_index = '';
    public function  index(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！',U('Login/index'));
        }

        $user=D("User")->where(array("uid"=>$this->user_session["uid"]))->find();
        if(strpos($user,"http")===0){

        }else{
            $avatarimage=new avatar_image();
            $user['avatar']=$avatarimage->get_image_by_path($user['avatar'],"http://www.xiaonongding.com")["image"];

        }
        $this->assign("user",$user);
       // echo json_encode($this->user_session);
        $this->display("index3");
    }

    /**
     * 输入兑换
     */
    public function  exchangemoney(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！',U('Login/index'));
        }
        $now_user = D('User')->get_user($this->user_session['uid']);
        if(empty($this->user_session['phone']) && !empty($now_user['phone'])){
            $_SESSION['user']['phone'] = $this->user_session['phone'] = $now_user['phone'];
        }
        $code=$_POST["code"];
        if(empty($code)){
            $this->error_tips('兑换码不能为空！');
        }
        $usercard=D("Vipcard")->where(array("unique_id"=>$code))->find();
      //  echo  D()->getLastSql();die;
        if(empty($usercard)){
            $this->error_tips("未查询到该兑换码");
        }
        if($usercard["used"]==1){
            $this->error_tips("该兑换码已被使用");
        }

        D("Vipcard")->where(array("unique_id"=>$code))->data(array("used"=>1,"usetime"=>time()))->save();
        D("Vipcardrecord")->data(array("uid"=>$now_user["uid"],"usetime"=>time(),"denomination"=>$usercard["denomination"]))->add();
        D("User")->where("uid = ".$now_user['uid'])->setInc("cardmoney",$usercard['denomination']);
        $this->success_tips("恭喜您获取".$usercard["denomination"]."元白金会员体验金！",U("Vip/vipgoods"));

    }

    /**
     * 输入兑换ajax
     */
    public function  exchangemoneyajax(){
        if(empty($this->user_session)){
            echo json_encode(array("status"=>0,"message"=>"请先登录")); exit;
        }
        $now_user = D('User')->get_user($this->user_session['uid']);
        if(empty($this->user_session['phone']) && !empty($now_user['phone'])){
            $_SESSION['user']['phone'] = $this->user_session['phone'] = $now_user['phone'];
        }
        $code=$_POST["code"];
        if(empty($code)){
            echo json_encode(array("status"=>0,"message"=>"兑换码不能为空！")); exit;
        }
        $usercard=D("Vipcard")->where(array("unique_id"=>$code))->find();
        //  echo  D()->getLastSql();die;
        if(empty($usercard)){
            echo json_encode(array("status"=>0,"message"=>"未查询到该兑换码")); exit;
        }
        if($usercard["used"]==1){
            echo json_encode(array("status"=>0,"message"=>"该兑换码已被使用")); exit;

        }

        D("Vipcard")->where(array("unique_id"=>$code))->data(array("used"=>1,"usetime"=>time()))->save();
        D("Vipcardrecord")->data(array("uid"=>$now_user["uid"],"usetime"=>time(),"denomination"=>$usercard["denomination"]))->add();
        D("User")->where("uid = ".$now_user['uid'])->setInc("cardmoney",$usercard['denomination']);
        echo json_encode(array("status"=>1,"message"=>"恭喜您获取".$usercard["denomination"]."元VIP余额，赶紧去免费领取小农丁特色农产品吧！")); exit;

    }

    public function  vipgoods(){
       // echo json_encode($this->user_session);die;
        $now_time = $_SERVER['REQUEST_TIME'];
        $condition_where= "`g`.`status`='1' AND `g`.`is_group_buy`='0' AND `g`.`type`='1' AND `g`.`begin_time`< ".$now_time." AND `g`.`end_time`> ".$now_time." AND `g`.`mer_id` = '890'";

        $condition_table = array(C('DB_PREFIX').'group'=>'g');

        $groups = D('')->table($condition_table)->where($condition_where)->select();
        $groupimage=new group_image();
        foreach ($groups as $key=>$value){
            $groups[$key]["pic"]=$groupimage->get_image_by_path($value["pic"],"s");

        }
      //  echo json_encode($groups);die;
        $this->assign("groups",$groups);
        $user=D("User")->where(array("uid"=>$this->user_session["uid"]))->find();
        if(strpos($user,"http")===0){

        }else{
            $avatarimage=new avatar_image();
            $user['avatar']=$avatarimage->get_image_by_path($user['avatar'],"http://www.xiaonongding.com")["image"];

        }
        $this->assign("user",$user);
        $this->display();
      //  echo xml_encode($groups);

    }
    /**
     * 保存到购物车
     */
    public function processOrder()
    {

        $foods = $_POST['cart'];
        $disharr = array();
        $sure_dish = unserialize($_SESSION[$this->session_index]);

        foreach ($foods as $kk => $vv) {
            $count = $vv['count'] ? intval($vv['count']) : 0;
            if ($count > 0) {
                $disharr[$vv['id']] = array('id' => $vv['id'], 'num' => $count, 'omark' => '');
                if (isset($sure_dish[$vv['id']]['omark']) && $sure_dish[$vv['id']]['omark']) {
                    $disharr[$vv['id']]['omark'] = $sure_dish[$vv['id']]['omark'];
                }
            }
        }
        empty($disharr) && exit(json_encode(array('error' => 1, 'msg' => '您尚未选择兑换商品！')));
        $_SESSION[$this->session_index] = serialize($disharr);
    //    exit(json_encode($disharr));
        exit(json_encode(array('error' => 0, 'msg' => 'ok')));
    }


    private function isLogin()
    {
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！',U('Login/index'));
        }
    }


    private function check_order($order_id)
    {
        if ($order = D('Group_order')->where(array('uid' => $this->user_session['uid'],  'order_id' => $order_id))->find()) {
            return $order;
        } else {
            return false;
        }
    }


    public function sureorder(){
        $this->isLogin();
        $sure_dish = unserialize($_SESSION[$this->session_index]);
        if(empty($sure_dish)){
            $this->error_tips("请先选择商品");
        }
        $groupdatabase=D("Group");
        $money=0;
        foreach ($sure_dish as $key=>$value){
            $group=$groupdatabase->where("group_id = ".$value["id"])->find();
            if(empty($group)){
                $this->error_tips("非法请求");
            }
            $money+=round($group["price"],2)*intval($value["num"]);


        }
        $usernow=D("User")->where(array("uid"=>$this->user_session["uid"]))->find();

        if($usernow["cardmoney"]<$money){
            $this->error_tips("您的余额不足哦");
        }
        $this->assign("totalmoney",$money);
        $_SESSION["totalmoney"]=$money;
        $user_info = D('User_adress')->get_one_adress($this->user_session['uid'], intval($_GET['adress_id']));
        $this->assign('date', date('Y-m-d'));
       $this->assign('time', date('H:i', time() + 1200));
        $this->assign('user_info', $user_info);
        $this->display();
    }

    public function  saveorder(){
        $this->isLogin();
        $sure_dish = unserialize($_SESSION[$this->session_index]);
        if(empty($sure_dish)){
          //  $this->error_tips("请先选择商品");
            echo  json_encode(array("status"=>0,"message"=>"请先选择商品"));
        }
        $contact=$_POST["name"];
        $phone=$_POST["tel"];
        $address=$_POST["address"];
        $groupdatabase=D("Group");
        $groupstore=D("Group_store");
        $grouporder=D("Group_order");
        foreach ($sure_dish as $key=>$value){

          //  echo  $key."<br>";
            $group=$groupdatabase->where("group_id = ".$value["id"])->find();
            if(empty($group)){
               // $this->error_tips("非法请求");
                echo  json_encode(array("status"=>0,"message"=>"非法请求"));
            }
            $money=round($group["price"],2)*intval($value["num"]);
            $Group_store=$groupstore->where(array('group_id'=>$value['id']))->select();
            $data_group_order["order_name"]=$group["s_name"]."*".$value["num"];
            $data_group_order["uid"]=$this->user_session["uid"];
            $data_group_order["mer_id"]=$group["mer_id"];
            $data_group_order["group_id"]=$group["group_id"];
            $data_group_order["num"]=$value["num"];
            $data_group_order["price"]=$group["price"];
            $data_group_order["total_money"]=round($group['price'],2)*intval($value['num']);
            $data_group_order["contact_name"]=$contact;
            $data_group_order["phone"]=$phone;
            $data_group_order["adress"]=$address;
            $data_group_order["balance_pay"]= $data_group_order["total_money"];
            $data_group_order["paid"]=1;
            $data_group_order["add_time"]=time();
            $data_group_order["submit_order_time"]=time();
            $data_group_order["pay_time"]=time();
            $data_group_order["pay_type"]="vipcard";
            $data_group_order["tuan_type"]=2;
            if(!empty($Group_store) && (count($Group_store)==1) && ($group['tuan_type']==2)){
                /****当此团购为实物且只指定一个店铺时，将店铺id直接带入保存到订单里*************/
                $data_group_order['store_id']=$Group_store['0']['store_id'];
            }
           $grouporder->data($data_group_order)->add();
          //  echo  D('')->getLastSql();die;


        }
        $_SESSION[$this->session_index]=null;
        D("User")->where(array("uid"=>$this->user_session["uid"]))->setDec("cardmoney",$_SESSION["totalmoney"]);
        $_SESSION["totalmoney"]=0;
        echo  json_encode(array("status"=>1,"message"=>"恭喜您，兑换成功"));die;

    }
}