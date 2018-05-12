<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/11
 * Time: 15:35
 */
class GroupAction extends BaseAction{
    public function index(){
        //根据获取的特卖id获取当前特卖详情
        $this->error("啥都没有");
    }
    public function detail(){
        //现在的团购
        if(empty($_GET['group_id'])){
            $this->error("未获取到特卖id");
        }
        $group_id=$_GET['group_id'];
        //重写获取特卖详情的内容
        $long=session('long');
        $lat=session('lat');
        //获取传来的经纬度信息
        if(empty($lat)||empty($long)){
            $this->error("未获取到经纬度信息！");
        }
        $Model=new Model();
        $sql="SELECT g.name as group_name,g.*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) AS distance,ms.* FROM "
            .C('DB_PREFIX')."group g LEFT JOIN (SELECT m.*,s.long,s.lat FROM ".C('DB_PREFIX')."merchant m LEFT JOIN ".C('DB_PREFIX').
            "merchant_store s ON m.mer_id=s.mer_id WHERE s.ismain=1 AND s.status=1) as ms ON g.mer_id=ms.mer_id WHERE g.group_id=".$group_id." AND g.status=1";
        $result=$Model->query($sql);
        if(empty($result)){
            $this->error("未查到相关特卖信息！");
        }
        //解析特卖的农场主信息
        $Merchant_class_image=new Merchant_image();
        $result[0]['person_image']=$Merchant_class_image->get_image_by_path($result[0]['person_image']);
        $result[0]['merchant_theme_image']=$Merchant_class_image->get_image_by_path($result[0]['merchant_theme_image']);
        //团购商品图
        $Group_class_image=new Group_image();
        $result[0]['pic']=$Group_class_image->get_allImage_by_path($result[0]['pic']);
        //判断是否被用户收藏
        $user=session("user");
        $collect=D("User_collect")->where(array("uid"=>$user['uid'],"type"=>"group_detail","id"=>$group_id))->find();
        if(!empty($collect)){
            $this->assign("is_collect",1);
        }else{
            $this->assign("is_collect",0);
        }
        $this->assign("now_group",$result[0]);
        $this->display();
    }

    public function buy(){
        //判断登录
        if(empty($this->user_session)){
            echo "<script>window.location.href='app:redirect:".C("config.site_url")."/mobile.php?g=Mobile&c=Group&a=shopcart&group_id=".intval($_GET['group_id'])."';</script>";die;
        }
        //现在的团购
         $now_group = D('Group')->get_group_by_groupId($_GET['group_id']);
        if(empty($now_group)){
            $this->group_noexit_tips();
        }
        
        if($now_group['begin_time'] > $_SERVER['REQUEST_TIME']){
            $this->error_tips('此单'.$this->config['group_alias_name'].'还未开始！');
        }
        if($now_group['type'] > 2){
            $this->error_tips('此单'.$this->config['group_alias_name'].'已结束！');
        }
        //用户等级 优惠
        $level_off=false;
        $finalprice=0;
        if(!empty($this->user_level) && !empty($this->user_session) && isset($this->user_session['level'])){
            $leveloff=!empty($now_group['leveloff']) ? unserialize($now_group['leveloff']) :'';
            /****type:0无优惠 1百分比 2立减*******/
            if(!empty($leveloff) && is_array($leveloff) && isset($this->user_level[$this->user_session['level']]) && isset($leveloff[$this->user_session['level']])){
                $level_off=$leveloff[$this->user_session['level']];
                if($level_off['type']==1){
                  $finalprice=$now_group['price']*($level_off['vv']/100);
                  $finalprice=$finalprice>0 ? $finalprice : 0;
                  $pigcms_assign['total_off_price'] = $pigcms_assign['num']*$finalprice; 
                  $level_off['offstr']='单价按原价'.$level_off['vv'].'%来结算';
                }elseif($level_off['type']==2){
                  $finalprice=$now_group['price']-$level_off['vv'];
                  $finalprice=$finalprice>0 ? $finalprice : 0;
                  $pigcms_assign['total_off_price'] = $pigcms_assign['num']*$finalprice;
                  $level_off['offstr']='单价立减'.$level_off['vv'].'元';
                }
            }
        }
        unset($leveloff);
        if(IS_POST){
            $request=$_POST['send'];
            //截取send
            $reqArr=explode(":",$request);
            $_POST['quantity'] = $reqArr[1];
            $finalprice > 0 && $now_group['price']=round($finalprice,2);
            $result = D('Group_order')->save_post_form($now_group,$this->user_session['uid'],0);
            if($result['error'] == 1){
                $this->error($result['msg']);
            }
            redirect(U('Mobile/Pay/check',array('order_id'=>$result['order_id'],'type'=>'group')));
        }else{
            $pigcms_get = $this->get_uri_param();

            $this->assign('now_group',$now_group);
            
            if($pigcms_get['q'] < $now_group['once_min']){
                $pigcms_assign['num'] = $now_group['once_min'];
            }else{
                $pigcms_assign['num'] = $pigcms_get['q'];
            }
            $pigcms_assign['total_price'] = $pigcms_assign['num']*$now_group['price'];

            $pigcms_assign['pigcms_phone'] = substr($this->user_session['phone'],0,3).'****'.substr($this->user_session['phone'],7);
            $pigcms_assign['total_off_price'] = $finalprice > 0 ? round(($pigcms_assign['num']*$finalprice),2) : $pigcms_assign['total_price'];
            is_array($level_off) && $level_off['price']=round($finalprice,2);
            $this->assign('leveloff',$level_off);
            $this->assign('finalprice',$finalprice);
            $this->assign($pigcms_assign);
            
            $this->display();
        }
    }

    public function shopcart(){
        if(empty($_GET['group_id'])){
            $this->error("未获取到商品id!");
        }
        $now_group = D('Group')->get_group_by_groupId($_GET['group_id']);
        $this->assign("now_group",$now_group);
        $this->display();
    }

    //保存订单的地址信息
    public function saveOrderAddress(){
        $address_id=$_POST['address_id'];
        $order_id=$_POST['order_id'];
        if(empty($address_id)||empty($order_id)){
            $this->error("未获取到相关信息！");
        }
        //先查询一下看是否已经存在
        $exit=D("Group_order")->where("order_id=".$order_id)->find();
        if(!empty($exit['adress'])){
            $this->success("已经存在地址了！");
        }

        $address = D('User_adress')->get_one_adress($this->user_session['uid'],$address_id);
        $data=array(
            "zipcode"=>$address['zipcode'],
            "contact_name"=>$address['name'],
            "adress"=>$address['province_txt']." ".$address['city_txt']." ".$address['area_txt']." ".$address['adress'],
            );

        $result=D("Group_order")->where("order_id=".$order_id)->setField($data);
        if($result){
            $this->success("保存地址成功！");
        }else{
            $this->error("保存地址失败！");
        }
    }
    //增加特卖的收藏功能
    public function addGroupCollect(){
        $id=$_POST['id'];
        $type="group_detail";
        $user=session("user");
        if(empty($user)){
            $data=array("msg"=>"login","status"=>0);
            echo json_encode($data);die;
        }
        $uid=$user['uid'];
        $result=D("User_collect")->addCollect($type,$id,$uid);
        if($result){
            $data=array("msg"=>"操作成功！","status"=>1);
            echo json_encode($data);die;
        }else{
            $data=array("msg"=>"操作失败！","status"=>0);
            echo json_encode($data);die;
        }
    }
}