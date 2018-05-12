<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/7/19
 * Time: 12:55
 */
class VipAction extends BaseAction
{
    public function __construct()
    {
        parent::__construct();
        if(isset($_REQUEST['token'])&&isset($_REQUEST['uid'])&&!empty($_REQUEST['token'])&&!empty($_REQUEST['uid'])){
            //如果存在token和uid则先进行验证，如果session为空则赋值
            $user=session("user");
            if(empty($user)){
                //则查询再赋值
                if(!empty($_REQUEST['token'])&&!empty($_REQUEST['uid'])){
                    //查询数据库并赋值session
                    $condition=array(
                        "token"=>$_REQUEST['token'],
                        "uid"=>$_REQUEST['uid']
                    );
                    $result=D("User")->mobileUser($condition);
                    if(!empty($result)){
                        session("user",$result);
                        $this->user_session=session("user");
                    }else{
                        $this->error_tips('登录出现问题！');
                    }
                }else{
                    $this->error_tips('传参出错！');
                }
            }
        }
    }


    public $session_index = '';
    public function  index(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！',U('Login/index'));
        }

        $user=D("User")->where(array("uid"=>$this->user_session["uid"]))->find();
        if(strpos($user,"http")===0){

        }else{
            $avatarimage=new avatar_image();
            if(strpos($user["avatar"],"http")===0){

            }else{
                $user['avatar']=$avatarimage->get_image_by_path($user['avatar'],"http://www.xiaonongding.com")["image"];

            }


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
        $this->success_tips("恭喜您获取".$usercard["denomination"]."元白金体验金！",U("Vip/vipgoods"));

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

//    public function  vipgoods(){
//        if(empty($this->user_session)){
//            $this->error_tips('请先进行登录！',U('Login/index'));
//        }
//       // echo json_encode($this->user_session);die;
//        $now_time = $_SERVER['REQUEST_TIME'];
//        $condition_where= "`g`.`status`='1' AND `g`.`is_group_buy`='0' AND `g`.`type`='1' AND `g`.`begin_time`< ".$now_time." AND `g`.`end_time`> ".$now_time." AND `g`.`mer_id` = '890'";
//
//        $condition_table = array(C('DB_PREFIX').'group'=>'g');
//
//        $groups = D('')->table($condition_table)->where($condition_where)->select();
//        $groupimage=new group_image();
//        $keydata=D("Keywords");
//        foreach ($groups as $key=>$value){
//            $groups[$key]["pic"]=$groupimage->get_image_by_path($value["pic"],"s");
//            if(!empty($value["picthumb"])){
//                $tmp_pic_arr = explode(';',$value['picthumb']);
//            }
//            elseif (!empty($value["picapp"])){
//                $tmp_pic_arr = explode(';',$value['picapp']);
//
//            }else{
//                $tmp_pic_arr = explode(';',$value['pic']);
//            }
//            $groups[$key]['thumb'] = $groupimage->get_image_by_path($tmp_pic_arr[0])['image'];
//            $groups[$key]["keyword"]=$keydata->where(" third_id = ".$value['group_id']." AND third_type = 'group'")->find()['keyword'];
//        }
//      //  echo json_encode($groups);die;
//        $user=D("User")->where(array("uid"=>$this->user_session["uid"]))->find();
//        $this->assign("user",$user);
//        $this->assign("groups",$groups);
//        $this->display();
//      //  echo xml_encode($groups);
//
//    }


//    public function vipgoods(){
//        if(empty($this->user_session)){
//            $this->error_tips('请先进行登录！',U('Login/index'));
//        }
//        $now_time = $_SERVER['REQUEST_TIME'];
////        $categorys=D("Group_category")->where("cat_fid =182 AND cat_status= 1 AND cat_id <> 185")->limit(3)->select();
//        $categorys=D("Group_category")->where("cat_fid =182 AND cat_status= 1 ")->select();
//        $res=array();
//        $condition_table = array(C('DB_PREFIX').'group'=>'g');
//        $groupimage=new group_image();
//        $keydata=D("Keywords");
//        foreach ($categorys as $k=>$v){
//            $cid=$v["cat_id"];
//            $res[$k]['cid']=$cid;
//            $condition_where= "`g`.`status`='1' AND `g`.`is_group_buy`='0' AND `g`.`type`='1' AND `g`.`begin_time`< ".$now_time." AND `g`.`end_time`> ".$now_time." AND `g`.`mer_id` = '890' AND `g`.`cat_id` = ".$cid;
//            $groups = D('')->table($condition_table)->where($condition_where)->select();
//            foreach ($groups as $key=>$value){
//                $groups[$key]["pic"]=$groupimage->get_image_by_path($value["pic"],"s");
//                if(!empty($value["picthumb"])){
//                    $tmp_pic_arr = explode(';',$value['picthumb']);
//                }
//                elseif (!empty($value["picapp"])){
//                    $tmp_pic_arr = explode(';',$value['picapp']);
//
//                }else{
//                    $tmp_pic_arr = explode(';',$value['pic']);
//                }
//                $groups[$key]['thumb'] = $groupimage->get_image_by_path($tmp_pic_arr[0])['image'];
//                $groups[$key]["keyword"]=$keydata->where(" third_id = ".$value['group_id']." AND third_type = 'group'")->find()['keyword'];
//            }
//            $res[$k]["goods"]=$groups;
//            $res[$k]["catpic"]=$v['cat_pic'];
//            $res[$k]["cat_name"]=$v["cat_name"];
//        }
//        // echo json_encode($this->user_session);die;
//
//
//
//       // echo json_encode($res);die;
//        $user=D("User")->where(array("uid"=>$this->user_session["uid"]))->find();
//        $this->assign("user",$user);
//        $this->assign("res",$res);
//        $this->display("vipgoods666");
//        //  echo xml_encode($groups);
//    }

    public function vipgoods(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！',U('Login/index'));
        }
        $now_time = $_SERVER['REQUEST_TIME'];
//        $categorys=D("Group_category")->where("cat_fid =182 AND cat_status= 1 AND cat_id <> 185")->limit(3)->select();
        $categorys=D("Group_category")->where("cat_fid =182 AND cat_status= 1 ")->order("cat_sort DESC")->select();
        $res=array();
        $condition_table = array(C('DB_PREFIX').'group'=>'g');
        $groupimage=new group_image();

        $nowcat=$categorys[0]["cat_id"];
        $now_time = $_SERVER['REQUEST_TIME'];
        $nowcategory=D("Group_category")->where("cat_id =".$nowcat)->find();
//        $categorys=D("Group_category")->where("cat_fid =182 AND cat_status= 1 AND cat_id <> 185")->limit(3)->select();
        //     $categorys=D("Group_category")->where("cat_fid =182 AND cat_status= 1 ")->limit(4)->select();
        $res=array();
        $condition_table = array(C('DB_PREFIX').'group'=>'g');
        $groupimage=new group_image();
        $keydata=D("Keywords");
        $res['cid']=$nowcat;
        $condition_where= "`g`.`status`='1' AND `g`.`is_group_buy`='0' AND `g`.`type`='1' AND `g`.`begin_time`< ".$now_time." AND `g`.`end_time`> ".$now_time." AND `g`.`mer_id` = '890' AND `g`.`cat_id` = ".$nowcat;
        $groups = D('')->table($condition_table)->where($condition_where)->select();
        foreach ($groups as $key=>$value){
            $groups[$key]["pic"]=$groupimage->get_image_by_path($value["pic"],"s");
            if(!empty($value["picthumb"])){
                $tmp_pic_arr = explode(';',$value['picthumb']);
            }
            elseif (!empty($value["picapp"])){
                $tmp_pic_arr = explode(';',$value['picapp']);

            }else{
                $tmp_pic_arr = explode(';',$value['pic']);
            }
            $groups[$key]['thumb'] = $groupimage->get_image_by_path($tmp_pic_arr[0])['image'];
            $groups[$key]["keyword"]=$keydata->where(" third_id = ".$value['group_id']." AND third_type = 'group'")->find()['keyword'];
        }
        $res["goods"]=$groups;
        $res["catpic"]=$nowcategory['cat_pic'];
        $res["cat_name"]=$nowcategory["cat_name"];
        $user=D("User")->where(array("uid"=>$this->user_session["uid"]))->find();
        $this->assign("user",$user);
        $this->assign("categorys",$categorys);
        $this->assign("res",$res);
        $this->display("viptest");


    }

    public function viptest(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！',U('Login/index'));
        }
        $now_time = $_SERVER['REQUEST_TIME'];
//        $categorys=D("Group_category")->where("cat_fid =182 AND cat_status= 1 AND cat_id <> 185")->limit(3)->select();
        $categorys=D("Group_category")->where("cat_fid =182 AND cat_status= 1 ")->order("cat_sort DESC")->select();
        $res=array();
        $condition_table = array(C('DB_PREFIX').'group'=>'g');
        $groupimage=new group_image();

        $nowcat=$categorys[0]["cat_id"];
        $now_time = $_SERVER['REQUEST_TIME'];
        $nowcategory=D("Group_category")->where("cat_id =".$nowcat)->find();
//        $categorys=D("Group_category")->where("cat_fid =182 AND cat_status= 1 AND cat_id <> 185")->limit(3)->select();
        //     $categorys=D("Group_category")->where("cat_fid =182 AND cat_status= 1 ")->limit(4)->select();
        $res=array();
        $condition_table = array(C('DB_PREFIX').'group'=>'g');
        $groupimage=new group_image();
        $keydata=D("Keywords");
        $res['cid']=$nowcat;
        $condition_where= "`g`.`status`='1' AND `g`.`is_group_buy`='0' AND `g`.`type`='1' AND `g`.`begin_time`< ".$now_time." AND `g`.`end_time`> ".$now_time." AND `g`.`mer_id` = '890' AND `g`.`cat_id` = ".$nowcat;
        $groups = D('')->table($condition_table)->where($condition_where)->select();
        foreach ($groups as $key=>$value){
            $groups[$key]["pic"]=$groupimage->get_image_by_path($value["pic"],"s");
            if(!empty($value["picthumb"])){
                $tmp_pic_arr = explode(';',$value['picthumb']);
            }
            elseif (!empty($value["picapp"])){
                $tmp_pic_arr = explode(';',$value['picapp']);

            }else{
                $tmp_pic_arr = explode(';',$value['pic']);
            }
            $groups[$key]['thumb'] = $groupimage->get_image_by_path($tmp_pic_arr[0])['image'];
            $groups[$key]["keyword"]=$keydata->where(" third_id = ".$value['group_id']." AND third_type = 'group'")->find()['keyword'];
        }
        $res["goods"]=$groups;
        $res["catpic"]=$nowcategory['cat_pic'];
        $res["cat_name"]=$nowcategory["cat_name"];
        $user=D("User")->where(array("uid"=>$this->user_session["uid"]))->find();
        $this->assign("user",$user);
        $this->assign("categorys",$categorys);
        $this->assign("res",$res);
        $this->display();


    }

    public function  vipgoodsajax(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！',U('Login/index'));
        }
        $nowcat=$_GET["cat_id"];
        $now_time = $_SERVER['REQUEST_TIME'];
        $nowcategory=D("Group_category")->where("cat_id =".$nowcat)->find();
//        $categorys=D("Group_category")->where("cat_fid =182 AND cat_status= 1 AND cat_id <> 185")->limit(3)->select();
   //     $categorys=D("Group_category")->where("cat_fid =182 AND cat_status= 1 ")->limit(4)->select();
        $res=array();
        $condition_table = array(C('DB_PREFIX').'group'=>'g');
        $groupimage=new group_image();
        $keydata=D("Keywords");
   //     foreach ($categorys as $k=>$v){
            $res['cid']=$nowcat;
            $condition_where= "`g`.`status`='1' AND `g`.`is_group_buy`='0' AND `g`.`type`='1' AND `g`.`begin_time`< ".$now_time." AND `g`.`end_time`> ".$now_time." AND `g`.`mer_id` = '890' AND `g`.`cat_id` = ".$nowcat;
            $groups = D('')->table($condition_table)->where($condition_where)->select();
            foreach ($groups as $key=>$value){
                $groups[$key]["pic"]=$groupimage->get_image_by_path($value["pic"],"s");
                if(!empty($value["picthumb"])){
                    $tmp_pic_arr = explode(';',$value['picthumb']);
                }
                elseif (!empty($value["picapp"])){
                    $tmp_pic_arr = explode(';',$value['picapp']);

                }else{
                    $tmp_pic_arr = explode(';',$value['pic']);
                }
                $groups[$key]['thumb'] = $groupimage->get_image_by_path($tmp_pic_arr[0])['image'];
                $groups[$key]["keyword"]=$keydata->where(" third_id = ".$value['group_id']." AND third_type = 'group'")->find()['keyword'];
            }
            $res["goods"]=$groups;
            $res["catpic"]=$nowcategory['cat_pic'];
            $res["cat_name"]=$nowcategory["cat_name"];
    //   }
        // echo json_encode($this->user_session);die;
    $str="";
    foreach ($res["goods"] as $kk=>$vv){
        $str.="          <li id=\"dish_li2953\">
                                    <div class=\"cen\">
                                        <div class=\"list-imgs shop-img\"
                                             style=\"background-image: url(".$vv['thumb'].");\">
                                            <input type=\"hidden\" class=\"goodprice\" value=\"".$vv['price']."\">
                                            <input type=\"hidden\" class=\"goodname\" value=\"".$vv['s_name']."\">
                                            <input type=\"hidden\" class=\"gooddigest\" value=\"".$vv['intro']."\">
                                            <input type=\"hidden\" class=\"goodimage\" value=\"".$vv['pic']."\">
                                        </div>
                                        <div class=\"list-cons\">
                                            <div class=\"left-right\">
                                                <h5 >".$vv['s_name']."</h5>
                                                <p>".$vv['name']."</p>
                                                <div class=\"price_wrap\">
                                                    <strong><span
                                                                class=\"unit_price\">&yen;".explode('.',$vv['price'])[0]."
                                               <input type=\"hidden\" class=\"tureunit_price\" value=\"".$vv['price']."\"></span>
                                                        <del>&yen;".$vv['old_price']."</del>
                                                    </strong>
                                                    <input autocomplete=\"off\" class=\"thisdid\" type=\"hidden\"
                                                           value=\"".$vv['group_id']."\">
                                                    <div class=\"price_wrap2\">
                                                        <div class=\"fr\" max=\"-1\">
                                                            <a href=\"javascript:void(0);\" class=\"btn plus\"
                                                               data-num=\"0\"></a>
                                                        </div>
                                                        <input autocomplete=\"off\" class=\"number\" type=\"hidden\"
                                                               name=\"dish[".$vv['group_id']."]\" value=\"0\">
                                                    </div>

                                                </div>
                                            </div>
                                            <div style=\"clear: both;\"></div>
                                        </div>
                                    </div>
                                </li>";

}

         echo $str;die;

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

        $group=D("Group");
        $goods=array();
        foreach ($sure_dish as  $k=>$v){
            $good=$group->field("s_name,price")->where("group_id = ".$k)->find();
            $good['num']=$v['num'];
            array_push($goods,$good);


        }
       //echo json_encode($goods);die;
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
        $this->assign("goods",$goods);
        $this->display();
    }
    public function test(){
        echo  json_encode(unserialize($_SESSION[$this->session_index]));



    }

    public function  saveorder(){
        $this->isLogin();
        $sure_dish = unserialize($_SESSION[$this->session_index]);
        if(empty($sure_dish)){
          //  $this->error_tips("请先选择商品");
            echo  json_encode(array("status"=>0,"message"=>"请先选择商品"));die;
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
                echo  json_encode(array("status"=>0,"message"=>"非法请求"));die;
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
        $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
        $model->sendTempMsg('OPENTM201752540', array('href' => "http://www.xiaonongding.com/wap.php", 'wecha_id' => "oJfc-wc_lcbTtjLD6JHSQVfR5hXY", 'first' => '农丁鲜生消费提醒', 'keyword1' => "农丁鲜生VIP馆商品", 'keyword2' => "0", 'keyword3' => $_SESSION["totalmoney"], 'keyword4' => date('Y-m-d H:i:s'), 'remark' => "请DM登录农丁鲜生商家后台发货"));
        $_SESSION["totalmoney"]=0;
        echo  json_encode(array("status"=>1,"message"=>"恭喜您，兑换成功"));die;

    }
}