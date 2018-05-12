<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/26 0026
 * Time: 23:21
 */

namespace Api\Controller;


use Api\Common\BaseController;

/**
 * Class DtkController
 * @package Api\Controller
 * 自动导入辣品数据
 */
class DtkController extends  BaseController
{
protected $bar=array();
protected  $foo=array();

    public function __construct()
    {

        $this->bar=array(81,20,110,52,191,154,10,49,73,193,50,108,186,183,88,138,36,98);
         $this->foo=array(1,2,3,4,5,6,7,8,9,10,7,7,7,4,5,12,8,8);
    }

    public function  import(){
        $this->getfulldata($this->bar,$this->foo);

    }

   private function getfulldata($fo,$ba){
        for ($i=0;$i<count($fo);$i++){
            echo $i."-------------------------------------------------------".$ba[$i];
            echo "start get data ".$fo[$i]."\n";
            $this->getData($fo[$i],"",$ba[$i]);
        }

    }

   private  function getData($catid,$productid="",$fulicatid){
        if(empty($productid)){
            $url="http://s.lapin365.com/callback/search?catid=".$catid."&count=100&ip=192.168.123.8&platform=lapinapp_android&userid=";
        }else{
            $url="http://s.lapin365.com/callback/search?catid=".$catid."&count=100&productid=".$productid."&ip=192.168.1.62&platform=lapinapp_android&userid=";
        }

        $data=parent::curlGet($url);
        if($data!=false){
            $dataarray=json_decode($data,true);
            if($dataarray["success"]){
                $content=$dataarray["content"];
                $end= end($content);
                $endid=$end["productid"];
                foreach ($content as $key=>$value){
                    if($value["DiscountRate"]==0){
                        echo "rate is zero ".$key."\n";
                        unset($content[$key]);
                        continue;
                    }
                    if($value["OriginStoreName"]=="京东"){
                        echo "good from goudong ".$key."\n";
                        unset($content[$key]);
                        continue;

                    }
                    $quanurl=$value["QuanUrl"];

                    preg_match("/(&pid=mm_){1}[0-9_]{2,}(&itemId=){1}/",$quanurl,$datapid);
                    if(strpos($quanurl,"&dx=")){
                        preg_match("/(&itemId=){1}[0-9]{2,}(&dx=){1}/",$quanurl,$dataid);
                    }else{
                        echo "no dt"."\n";
                        preg_match("/(&itemId=){1}[0-9]{2,}$/",$quanurl,$dataid);  //没有&dx=1
                        //  print_r($dataid);
                    }

                    $oldpid=$datapid[0];
                    $newpid1=    str_replace("&pid=","",$oldpid);
                    $newpid2=    str_replace("&itemId=","",$newpid1);   //三段式id
                    $oldid=$dataid[0];
                    $newid1=str_replace("&itemId=","",$oldid);
                    $newid2=str_replace("&dx=","",$newid1);   //商品id
                    if(strpos($quanurl,"&dx=")){
                        $itemid=$newid2;
                    }else{

                        $itemid=$newid1;
                    }
                    $content[$key]["Picture"]="http://img.lapin365.com/productpictures".$content[$key]["Picture"];
                    $content[$key]["PromotionInfo"]=str_replace("元券","",$content[$key]["PromotionInfo"]);
                    $content[$key]["ExpiredTime"]=strtotime($content[$key]["ExpiredTime"]);
                    $content[$key]["QuanUrl"]=str_replace($newpid2,"mm_110692041_19064760_66684786",$content[$key]["QuanUrl"]);
                    $content[$key]["itemgoodid"]=$itemid;
                }
                $this->saveContent($content,$catid,$endid,$fulicatid);

            }else{
                echo  "fatal exception,fetch api error !"."\n";
            }
        }

    }

   private function saveContent($content,$catid,$endid,$fulicatid){
        echo "\n\n"."saving data to database"."\n\n";
       $products=D("Product");
        foreach ($content as $k=>$v){
            $product["product_name"]=$v["ProductName"];
            $product["product_main_image"]=$v["Picture"];
            $product["product_url"]=$v["QuanUrl"];
            $product["product_pure_provice"]=$v["RealPrice"];
            $product["coupon_denomination"]=$v["PromotionInfo"];
            $product["pure_provice"]=$v["RealPrice"]-$v["PromotionInfo"];
            $product["coupon_end"]=$v["ExpiredTime"];
            $product["add_time"]=time();
            $product["coupon_url"]=$v["QuanUrl"];
            $product["is_import"]=1;
            $product["qrcodeurl"]="";
            $product["taotoken"]="";
            $product["goodid"]=$v["itemgoodid"];
            $product["cid"]=$fulicatid;
            $product["introduce"]=$v["ProductName"];
            $product["importtype2"]=2;
              if($products->data(array("product_name"=>$product["product_name"],"product_main_image"=>$product["product_main_image"],"product_url"=>$product["product_url"],
                  "product_pure_provice"=>$product["product_pure_provice"],"coupon_denomination"=>$product["coupon_denomination"],
                  "pure_provice"=>$product["pure_provice"],"coupon_end"=>$product["coupon_end"],"add_time"=>time(),"coupon_url"=>$product["coupon_url"],
                  "is_import"=>1,"qrcodeurl"=>"","taotoken"=>"","goodid"=>$product["goodid"],"cid"=>$product["cid"],"introduce"=>$product["introduce"],
                  "importtype2"=>2))->add("",array(),true)){
                  echo "插入成功"."\n";

              }else{
                  echo "插入失败"."\n";
              }



        }




    }


}