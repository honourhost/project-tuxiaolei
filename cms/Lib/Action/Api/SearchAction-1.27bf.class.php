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
            } elseif ($type == 2) {
                $type = "farm";
            }else{
                $this->returnAjax("查询类型有错误！",0);
            }
        }else{
            $type="goods";
        }
        //如果存在排序信息则传入
        $order=$_GET["order"];
        if(!empty($order)){
            $result=D("Search")->find($type,$keywords,$lat,$long,$order);
        }else{
            $result=D("Search")->find($type,$keywords,$lat,$long);
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