<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/11
 * Time: 9:53
 */
class SearchAction extends BaseAction{
    public function index(){
        $keywords=$_GET['keywords'];
        if(empty($keywords)){
            $this->returnAjax("关键字为空！",0);
        }
        //获取经纬度
        $lat=$_GET['lat'];
        $long=$_GET['long'];
        if(empty($lat)||empty($long)){
            $this->returnAjax("未获取到经纬度信息！",0);
        }
        //获取查询类型
        $type=$_GET['type'];
        if(!empty($type)) {
            if ($type == 1) {
                $type = "goods";
                //针对特卖的排序
                $order="";
                $price=$_GET['price'];
                $distance=$_GET['distance'];
                $sale_count=$_GET['sale_count'];
                if(!empty($price)){
                    if($price==1){
                        $order.=" price ASC ";
                    }elseif($price==2){
                        $order.=" price DESC ";
                    }else{
                        $order.=" price ASC ";
                    }
                }
                if(!empty($order)){
                if(!empty($distance)){
                    if($distance==1){
                        $order.=",distance ASC ";
                    }elseif($distance==2){
                        $order.=",distance DESC ";
                    }else{
                        $order.=",distance ASC ";
                    }
                 }
                }else{
                    if($distance==1){
                        $order.=" distance ASC ";
                    }elseif($distance==2){
                        $order.=" distance DESC ";
                    }
                }
                 if(!empty($order)){
                if(!empty($sale_count)){
                    if($sale_count==1){
                        $order.=",sale_count ASC ";
                    }elseif($sale_count==2){
                        $order.=",sale_count DESC ";
                    }else{
                        $order.=",sale_count DESC ";
                    }
                    }
                }else{
                    if($sale_count==1){
                        $order.=" sale_count ASC ";
                    }elseif($sale_count==2){
                        $order.=" sale_count DESC ";
                    }
                }
            } elseif ($type == 2) {
                $type = "farm";
                //针对农场的排序
                $order="";
                $distance=$_GET['distance'];
                $fans_count=$_GET['fans_count'];
                if(!empty($distance)){
                    if($distance==1){
                        $order.=" distance ASC ";
                    }elseif($distance==2){
                        $order.=" distance DESC ";
                    }else{
                        $order.=" distance ASC ";
                    }
                }
                if(!empty($order)){
                if(!empty($fans_count)){
                    if($fans_count==1){
                        $order.=",fans_count ASC ";
                    }elseif($distance==2){
                        $order.=",fans_count DESC ";
                    }else{
                        $order.=",fans_count DESC ";
                    }
                }
                }else{
                    if($fans_count==1){
                        $order.=" fans_count ASC ";
                    }elseif($distance==2){
                        $order.=" fans_count DESC ";
                    }
                }
            }else{
                $this->returnAjax("查询类型有错误！",0);
            }
        }else{
            $type="goods";
        }
        if(!empty($order)){
            $result=D("Search")->findnopin($type,$keywords,$lat,$long,$order);
        }else{
            $result=D("Search")->findnopin($type,$keywords,$lat,$long);
        }
        if(!empty($result)){
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("未查询到信息",0);
        }
    }
     public function getKeywords(){
        $database_search_hot = D('Search_hot');
        $search_hot_list = $database_search_hot->field("id,name,add_time,type")->order('`sort` DESC,`id` ASC')->select();
        if(!empty($search_hot_list)){
            $this->returnAjax($search_hot_list,1);
        }else{
            $this->returnAjax("未获取到关键字信息！",0);
        }
    }
}