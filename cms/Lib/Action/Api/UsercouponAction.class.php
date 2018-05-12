<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/9/5
 * Time: 15:04
 */
class UsercouponAction  extends NewbaseAction
{

    /**
     * 列出红包列表 status 1 未使用  2 已使用   3已失效
     */
    public function listcoupon(){
        $status=$_GET['status'];
        $uid=$_GET["uid"];
        $condition="uid =".$uid;
        $now=$_SERVER["REQUEST_TIME"];
        switch ($status){

            case 1:
                $condition.=" AND comfirmed = 0 AND endtime > ".$now;
                break;
            case 2:
                $condition.=" AND comfirmed = 1 ";
                break;
                $condition.=" AND comfirmed = 0 AND endtime < ".$now;
            case 3:
                break;
            default:
                break;
        }
        $result=D("Usercoupon")->where($condition)->order("id DESC")->select();

        if(empty($result)){
            $this->returnAjax("未获取到数据",2);
        }else{
            foreach ($result as $key=>$value){
                if($value["endtime"]<$now){
                    $result[$key]["comfirmed"]=2;
                }
            if($value["type"]==1){
                $result[$key]['desc']="新人红包";
              if($value["ranges"]<=0){
                  $result[$key]["shortdesc"]="立减".$value["denomination"]."元";
                  $result[$key]["longdesc"]="新人下单无门槛立减".$value["denomination"]."元";
              }else{
                  $result[$key]["shortdesc"]="立减".$value["denomination"]."元";
                  $result[$key]["longdesc"]="新人下单"."满".$value["ranges"]."立减".$value["denomination"]."元";
              }
            }elseif ($value["type"]==2){
                $result[$key]["desc"]="普通红包";
                if($value["ranges"]<=0){
                    $result[$key]["shortdesc"]="立减".$value["denomination"]."元";
                    $result[$key]["longdesc"]="下单无门槛立减".$value["denomination"]."元";
                }else{
                    $result[$key]["shortdesc"]="满".$value["ranges"]."立减".$value["denomination"]."元";
                    $result[$key]["longdesc"]="下单满".$value["ranges"]."立减".$value["denomination"]."元";
                }
            }
            }
            $this->returnAjax($result,1);
        }


    }

}