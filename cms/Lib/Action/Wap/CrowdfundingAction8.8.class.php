<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/5
 * Time: 17:51
 */
class CrowdfundingAction extends BaseAction
{


    public function index(){

        $catid=($_REQUEST["catid"]==0)?0:empty($_REQUEST["catid"])?-1:$_REQUEST["catid"];
        if($catid==-1){
            $crowdfundings=D("Crowdfunding")->field("title,digest,hit,webpic,mer_id,crowd_id,progress")->page(1,8)->order("crowd_id DESC")->select();
        }else{
            $crowdfundings=D("Crowdfunding")->field("title,digest,hit,webpic,mer_id,crowd_id,progress")->where(array("crowdcat"=>$catid))->page(1,8)->order("crowd_id DESC")->select();
        }
        $this->assign("catid",$catid);
        $group_image_class = new group_image();
        $merchant_image=new merchant_image();
        $merchant=D("Merchant");
        foreach ($crowdfundings as $key=>$value){
            $crowdfundings[$key]['webpic']=  $group_image_class->get_image_by_path($crowdfundings[$key]['webpic'], 's');
          $mer=  $merchant->field("name,person_image")->where(array("mer_id"=>$value["mer_id"]))->find();
          $mer["person_image"]=$merchant_image->get_image_by_path($mer["person_image"]);
          $crowdfundings[$key]["merchant"]=$mer;
        }
    //    echo  json_encode($crowdfundings);die;
        $this->assign("crowdfundings",$crowdfundings);
        $slides=D("Adver")->where(array("cat_id"=>27))->order("sort DESC")->limit(8)->select();

        $this->assign("advers",$slides);
        $this->display();
    }

    public function  ajaxcrowd(){
        $page=I("post.page");
        $count=D("Crowdfunding")->count();
        $pagecount=ceil($count/8);
        if($page>$pagecount){
            $this->returnAjax("没有数据啦哟~",0);
        }
        $crowdfundings=D("Crowdfunding")->field("title,digest,hit,webpic,mer_id,crowd_id,progress")->page($page,8)->order("crowd_id DESC")->select();
        $group_image_class = new group_image();
        $merchant_image=new merchant_image();
        $merchant=D("Merchant");
        foreach ($crowdfundings as $key=>$value){
            $crowdfundings[$key]['webpic']=  $group_image_class->get_image_by_path($crowdfundings[$key]['webpic'], 's');
            $mer=  $merchant->field("name,person_image")->where(array("mer_id"=>$value["mer_id"]))->find();
            $mer["person_image"]=$merchant_image->get_image_by_path($mer["person_image"]);
            $crowdfundings[$key]["merchant"]=$mer;
        }

        $this->returnAjax($crowdfundings,1);



    }

    public function detail(){
        $crowdid=empty($_REQUEST["crowdid"])?1:$_REQUEST["crowdid"];
        $crowdfunding=D("Crowdfunding")->where(array("crowd_id"=>$crowdid))->find();
        if(empty($crowdfunding)) {
            $this->error("不存在该众筹~");
        }
        D("Crowdfunding")->where(array("crowd_id"=>$crowdid))->setInc('hit',1);
        $group_image_class = new group_image();
        $crowdfunding['webpic']=  $group_image_class->get_image_by_path($crowdfunding['webpic'], 's');
         $crowdfunding["videopic"]=$group_image_class->get_image_by_path($crowdfunding['videopic'],"s");
        $crowdfunding["video"]="http://www.xiaonongding.com".$crowdfunding["video"];
        $crowdfunding["leftday"]=round((intval($crowdfunding['endtime'])-time())/3600/24);
            $this->assign("crowdfunding",$crowdfunding);
            $merchant=D("Merchant")->where(array("mer_id"=>$crowdfunding["mer_id"]))->find();
            $merimage=new merchant_image();
          $merchant['person_image']=  $merimage->get_image_by_path($merchant['person_image']);
        $this->assign("merchant",$merchant);
      //  echo  json_encode($crowdfunding);die;
        $buyrecords=D('Crowdrecord')->where(array('crowd_id'=>$crowdid))->limit(5)->select();
        if(!empty($buyrecords)){
            foreach ($buyrecords as $key=>$value){
               $user= D("User")->where(array("uid"=>$value['uid']))->find();
               if(strpos($user['avatar'],'http')===0){
                   $buyrecords[$key]['avatar']=$user['avatar'];
               }else{
                   $avatar_image_class=new avatar_image();
                   $res=$avatar_image_class->get_image_by_path($user['avatar'],C('config.site_url'));
                   $buyrecords[$key]['avatar']=$res['image'];
               }

            }
            $this->assign("buyrecords",$buyrecords);
        }
        $this->display();

    }


    public function  supporters(){
        $crowdid=$_GET["crowdid"];
        $crowd=D("Crowdfunding")->where(array("crowd_id"=>$crowdid))->find();
        if(empty($crowd)){
            $this->error_tips("不存在对的众筹");
        }
        $supporters=D("Crowdorder")->field("uid,payment_money,paytime")->where(array("crowd_id"=>$crowdid,"paid"=>1))->select();
        $userdata=D("User");
        $avatar=new avatar_image();
        foreach ($supporters as $key=>$value){
            $user=$userdata->where(array("uid"=>$value["uid"]))->find();
            $supporters[$key]["avator"]=$avatar->get_image_by_path($user['avatar']);
            $supporters[$key]['name']=$user["nickname"];


        }
     //  echo json_encode($supporters);die;
        $this->assign("supporters",$supporters);
        $this->display();

    }
}