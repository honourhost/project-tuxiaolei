<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/11
 * Time: 10:32
 */
class MerchantAction extends BaseAction{
    public function index(){
        // $_GET['lat']="24.5283";
        // $_GET['long']="118.151899";
        $long=session('long');
        $lat=session('lat');
        if(empty($lat)||empty($long)){
            $this->error("没有获取到经纬度信息！");
        }
        $merchant_count=D("Merchant")->where("status=1")->count();
        import('@.ORG.merchant_page');
        $p = new Page($merchant_count, 10);
        $result=D("Merchant")->alias("m")
        ->field("m.*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) as distance")
        ->join(C('DB_PREFIX')."merchant_store s ON m.mer_id=s.mer_id")
        ->where("m.status=1 AND s.ismain=1 AND m.merchant_theme_image <> ''")->limit($p->firstRow,$p->listRows)->order("distance asc")->select();
        $merchant_class_image=new Merchant_image();
        foreach($result as $k=>$val){
            $result[$k]['merchant_theme_image']=$merchant_class_image->get_image_by_path($val['merchant_theme_image']);
            $result[$k]['person_image']=$merchant_class_image->get_image_by_path($val['person_image']);
        }
        $this->assign("merchant_list",$result);
        $this->display();
    }

    public function detail(){
        //根据获取的mer_id查到对应的农场距离差以及详细信息
        $mer_id=$_GET['mer_id'];
        if(empty($mer_id)){
            $this->error("没有获取到id值");
        }
        // $_GET['lat']="24.5283";
        // $_GET['long']="118.151899";
        $long=session('long');
        $lat=session('lat');
        if(empty($lat)||empty($long)){
            $this->error("没有获取到经纬度信息！");
        }
        $result=D("Merchant")->alias("m")->field("m.*,s.*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) as distance")->join(C('DB_PREFIX')."merchant_store s ON m.mer_id=s.mer_id")->where("m.mer_id=".$mer_id." AND s.ismain=1")->find();
        $merchant_class_image=new Merchant_image();
        $result['merchant_theme_image']=$merchant_class_image->get_image_by_path($result['merchant_theme_image']);
        $result['person_image']=$merchant_class_image->get_image_by_path($result['person_image']);
        //选出对应的店铺下的农小店商品
        $meals=D("Meal")->where(array("store_id"=>$result['store_id'],"status"=>1))->limit(6)->order("sort")->select();
        $meal_class_image=new Meal_image();
        foreach($meals as $k=>$val){
            $meals[$k]['image']=$meal_class_image->get_image_by_path($val['image'],C("config.site_url"));
        }
        //搜索查看用户是否收藏
        $user=session("user");
        $collect=D("User_collect")->where(array("uid"=>$user['uid'],"type"=>"merchant_id","id"=>$mer_id))->find();
        if(!empty($collect)){
            $this->assign("is_collect",1);
        }else{
            $this->assign("is_collect",0);
        }
        $this->assign("meals",$meals);
        $this->assign("merchant",$result);
        $this->display();
    }

    public function addMerchantCollect(){
        $id=$_POST['id'];
        $type="merchant_id";
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


    //展示农场特卖数据
    public function getGroups(){
        $mer_id=$_GET['mer_id'];
        if(empty($mer_id)){
            $this->error("未获取到农场id!");
        }
        $order=$_GET['order'];
        switch($order){
            case 'price-asc':
                $order = '`g`.`price` ASC,`g`.`group_id` DESC';
                break;
            case 'price-desc':
                $order = '`g`.`price` DESC,`g`.`group_id` DESC';
                break;
            case 'hot':
                $order = 'all_count DESC,`g`.`group_id` DESC';
                break;
            default:
                $order = '`g`.`sort` DESC,`g`.`group_id` DESC';
        }
        $now_time = $_SERVER['REQUEST_TIME'];
        $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`mer_id`='$mer_id'";
        $count=D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where($condition_where)->count();

        import('@.ORG.group_page');

        $p = new Page($count,10,'p');

        $group_list = D('')->field('`g`.`name` AS `group_name`,(`g`.`sale_count`+`g`.`virtual_num`) AS all_count,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where($condition_where)->order($order)->limit($p->firstRow,$p->listRows)->select();
        //print_r(D()->getLastSql());
        if($group_list){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
                $group_list[$k]['price'] = floatval($v['price']);
                $group_list[$k]['old_price'] = floatval($v['old_price']);
                $group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
            }
        }
        $this->assign("list",$group_list);
        $this->display();
    }
    //展示农场对应的平台活动
    public function getActivityList(){
        $mer_id=$_GET['mer_id'];
        if(empty($mer_id)){
            $this->error("未获取到农场id!");
        }
        //距离获取
        $lat=session("lat");
        $long=session("long");
        $result=D("Merchant_store")->alias("s")->field("ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS distance")->where(array("mer_id"=>$mer_id,"is_main"=>1,"status"=>1))->find();
        $this->assign("distance",$result['distance']);
        //获取农场发布的平台活动
        $order=$_GET['order'];
        $result=D("Extension_activity_list")->getActivityListByMerchantOrder($mer_id,$order);
        $this->assign("list",$result);
        //选出几个最新推送活动
        if($_SESSION['areaarr']!="all"){
            $area_str=implode(',',$_SESSION['areaarr']);
            $condition_where="`eal`.`mer_id` <> $mer_id AND `eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `m`.`area_id` IN (".$area_str.")";
        }else{
            $condition_where="`eal`.`mer_id` <> $mer_id AND `eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id";
        }
        $field_condition="`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.pic,`eal`.part_count,`eal`.price,`eal`.mer_id,`eal`.money,`eal`.pigcms_id,term.begin_time,term.end_time";
        $table_condition=array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'extension_activity'=>'term');
        $tuiactivity = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->order('`eal`.`last_time` DESC')->limit(3)->select();
         if(!empty($tuiactivity)){
            foreach($tuiactivity as $k=>$val) {
                $tuiactivity[$k]['url'] = $this->config['site_url'].'/mobile.php?g=Mobile&c=Activity&a=detail&activity_id='.$val['pigcms_id'];
            }
        }
        $this->assign("tuiactivities",$tuiactivity);
        $this->display();
    }
    //展示农场对应的农小店信息
    public function getInfo(){
        $mer_id=$_GET['mer_id'];
        if(empty($mer_id)){
            $this->error("没有获取到id值");
        }
        // $_GET['lat']="24.5283";
        // $_GET['long']="118.151899";
        $long=session('long');
        $lat=session('lat');
        if(empty($lat)||empty($long)){
            $this->error("没有获取到经纬度信息！");
        }
        $result=D("Merchant")->alias("m")->field("m.*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) as distance")->join(C('DB_PREFIX')."merchant_store s ON m.mer_id=s.mer_id")->where("m.mer_id=".$mer_id." AND s.ismain=1")->find();
        $merchant_class_image=new Merchant_image();
        $result['merchant_theme_image']=$merchant_class_image->get_image_by_path($result['merchant_theme_image']);
        $result['person_image']=$merchant_class_image->get_image_by_path($result['person_image']);
        $this->assign("farm",$result);
        //搜索查看用户是否收藏
        $user=session("user");
        $collect=D("User_collect")->where(array("uid"=>$user['uid'],"type"=>"merchant_id","id"=>$mer_id))->find();
        if(!empty($collect)){
            $this->assign("is_collect",1);
        }else{
            $this->assign("is_collect",0);
        }
        $this->display();
    }
    //展示农场对应的相册信息
    public function getPicturesList(){
        $mer_id=$_GET['mer_id'];
        if(empty($mer_id)){
            $this->error("未获取到农场id!");
        }
        $result=D("Merchant")->where("mer_id=".intval($mer_id))->find();
        $merchant_class_image=new Merchant_image();
        $result['merchant_theme_image']=$merchant_class_image->get_image_by_path($result['merchant_theme_image']);
        $result['person_image']=$merchant_class_image->get_image_by_path($result['person_image']);
        $result['images']=$merchant_class_image->get_allImage_by_path($result['pic_info']);
        //查询收藏数
        $number=D("User_collect")->where(array("type"=>"merchant_id","id"=>$mer_id))->count();
        $this->assign("farm",$result);
        $this->assign("collects",$number);
        $this->display();
    }
    //获取特卖地址
    public function get_group_url($group_id){
        return C('config.site_url').'/mobile.php?g=Mobile&c=Group&a=detail&group_id='.$group_id;
    }
    //获取农场url
    private function getMerchantUrl($mer_id){
        return C('config.site_url').'/mobile.php?g=Mobile&c=Merchant&a=detail&mer_id='.$mer_id;
    }
    public function gansu(){
        $this->display();
    }
}