<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/8/8
 * Time: 11:54
 */
class CrowdfundingAction extends BaseAction
{
public function  detail(){
    $crowdid=$_GET["crowd_id"];
    $crowdfunding=D("Crowdfunding")->where("crowd_id = ".$crowdid)->find();
    $group_image_class = new group_image();
    $merchant_image=new merchant_image();
    $merchant=D("Merchant");
    $crowdfunding['webpic']=  $group_image_class->get_image_by_path($crowdfunding['webpic'], 's');
    $mer=  $merchant->field("name,person_image")->where(array("mer_id"=>$crowdfunding["mer_id"]))->find();
    $mer["person_image"]=$merchant_image->get_image_by_path($mer["person_image"]);
    $crowdfunding["merchant"]=$mer;
    $this->assign("article",$crowdfunding);
    $textlist= $crowdfunding=D("Crowdfunding")->where("crowd_id <> ".$crowdid." AND status = 1 ")->limit(5)->select();
    foreach ($textlist as $key=>$value){
        $textlist[$key]['webpic']=$group_image_class->get_image_by_path($value['webpic'], 's');
    }
    $this->assign("textlist",$textlist);
  //  echo  json_encode($crowdfunding);die;
    $this->display();
}
}