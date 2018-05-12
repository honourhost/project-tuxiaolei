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
}