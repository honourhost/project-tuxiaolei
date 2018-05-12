<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/15
 * Time: 14:02
 */
class ActivityAction extends BaseAction{
    public function  index(){
        $this->error("还未开放");
    }
    public function detail(){
        $activity_id=$_GET['activity_id'];
        if(empty($activity_id)){
            $this->error("未获取到活动id");
        }
        $long=$_GET['long'];
        $lat=$_GET['lat'];
        //获取传来的经纬度信息
        if(empty($lat)||empty($long)){
            $this->error("未获取到经纬度信息！");
        }
        $Model=new Model();
        $sql="SELECT activity.*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) AS distance,ms.* FROM (SELECT a.*,term.begin_time,term.end_time FROM "
            .C('DB_PREFIX')."extension_activity_list a LEFT JOIN ".C('DB_PREFIX')."extension_activity term ON a.activity_term=term.activity_id WHERE a.pigcms_id=".$activity_id.") AS activity LEFT JOIN ( SELECT m.*,s.long,s.lat,s.store_id FROM ".C('DB_PREFIX')."merchant m LEFT JOIN ".C('DB_PREFIX').
            "merchant_store s ON m.mer_id=s.mer_id WHERE s.ismain=1 AND s.status=1) as ms ON activity.mer_id=ms.mer_id";
        $result=$Model->query($sql);
        if(empty($result)){
            $this->error("未获取到活动信息！");
        }
        //将农场信息整理
        $activity=$result[0];
        $Merchant_class_image=new Merchant_image();
        $activity['person_image']=$Merchant_class_image->get_image_by_path($activity['person_image']);
        $activity['merchant_theme_image']=$Merchant_class_image->get_image_by_path($activity['merchant_theme_image']);
        //活动图
        $Activity_class_image=new extension_image();
        $activity['pic']=$Activity_class_image->get_allImage_by_path($activity['pic']);
        $this->assign("now_activity",$activity);
        //获取农场下的特卖数
        $group_count=D("Group")->where(array("mer_id"=>$activity['mer_id'],"status"=>1))->count();
        $meal_count=D("Meal")->where(array("store_id"=>$activity['store_id'],"status"=>1))->count();
        $this->assign("group_count",$group_count);
        $this->assign("meal_count",$meal_count);
        //查出最先参加活动的5个用户(不重复)
        $five=D("Extension_activity_record")->alias("re")->distinct(true)->field("u.uid,u.nickname,u.avatar")->join(C("DB_PREFIX")."user u ON re.uid=u.uid")->where("activity_id=".$activity['pigcms_id'])->order("(time+msec) asc")->select();
        $this->assign("five",$five);
        $this->display();
    }
}