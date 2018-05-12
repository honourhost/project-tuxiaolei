<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/9
 * Time: 13:03
 */
class AreaAction extends BaseAction{
        //获取省一级所有地区
    public function getProvince(){
        $condition="is_open=1 AND area_pid=0 AND area_type=1";
        $result=D('Area')->where($condition)->select();
        if(!empty($result)) {
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("未获取到信息",0);
        }
    }
    public function getProvincenew(){
        $condition="is_open=1 AND area_pid=0 AND area_type=1";
        $result=D('Area')->where($condition)->select();
        if(!empty($result)) {
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("未获取到信息",2);
        }
    }
    //根据传来的省一级ID获取城市
    public function getCity(){
        if(!empty($_GET['province'])){
            $condition="is_open=1 AND area_pid=".$_GET['province']." AND area_type=2";
        }else{
            $condition="is_open=1 AND area_type=2";
        }
        $result=D('Area')->where($condition)->select();
        if(!empty($result)) {
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("未获取到信息",0);
        }
    }
    public function getCitynew(){
        if(!empty($_GET['province'])){
            $condition="is_open=1 AND area_pid=".$_GET['province']." AND area_type=2";
        }else{
            $condition="is_open=1 AND area_type=2";
        }
        $result=D('Area')->where($condition)->select();
        if(!empty($result)) {
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("未获取到信息",2);
        }
    }
    //根据传来的市一级ID获取城市
    public function getArea(){
        if(!empty($_GET['city'])){
            $condition="is_open=1 AND area_pid=".$_GET['city']." AND area_type=3";
        }else{
            $condition="is_open=1 AND area_type=3";
        }
        $result=D('Area')->where($condition)->select();
        if(!empty($result)) {
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("未获取到信息",0);
        }
    }
    public function getAreanew(){
        if(!empty($_GET['city'])){
            $condition="is_open=1 AND area_pid=".$_GET['city']." AND area_type=3";
        }else{
            $condition="is_open=1 AND area_type=3";
        }
        $result=D('Area')->where($condition)->select();
        if(!empty($result)) {
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("未获取到信息",2);
        }
    }
     //根据传来的市一级ID获取城市
    public function getCircle(){
        if(!empty($_GET['area'])){
            $condition="is_open=1 AND area_pid=".$_GET['area']." AND area_type=4";
        }else{
            $condition="is_open=1 AND area_type=4";
        }
        $result=D('Area')->where($condition)->select();
        if(!empty($result)) {
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("未获取到信息",0);
        }
    }
    //根据传来的城市名返回对应的id
    public function getCityId(){
        if(!empty($_GET['city_name'])){
            $condition="is_open=1 AND area_name LIKE '%".$_GET['city_name']."%' AND area_type=2";
        }else{
            $this->returnAjax("没有城市名参数",0);
        }
        $result=D('Area')->where($condition)->find();
        if(!empty($result)) {
            $this->returnAjax($result['area_id'],1);
        }else{
            $this->returnAjax("未获取到信息",0);
        }
    }
}