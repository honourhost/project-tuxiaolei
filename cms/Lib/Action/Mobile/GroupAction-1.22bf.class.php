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
        $long=$_GET['long'];
        $lat=$_GET['lat'];
        //获取传来的经纬度信息
        if(empty($lat)||empty($long)){
            $this->error("未获取到经纬度信息！");
        }
        $Model=new Model();
        $sql="SELECT g.*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) AS distance,ms.* FROM "
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
        $this->assign("now_group",$result[0]);
        $this->display();
    }
}