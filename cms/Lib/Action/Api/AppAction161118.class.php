<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/4/27
 * Time: 14:28
 */
class AppAction extends BaseAction{
    //获取首页轮播图
    public function homeTopBanner(){
        $list=$this->getList(7);
        if(!empty($list)){
            $this->returnAjax($list,1);
        }else{
            $this->returnAjax("未获取到数据！",0);
        }
    }
    //获取首页分类查询内容
    public function homeCatBanner(){
        $list=$this->getList(9);
        if(!empty($list)){
            $this->returnAjax($list,1);
        }else{
            $this->returnAjax("未获取到数据！",0);
        }
    }
    //获取首页主题推荐
    public function homeThemeBanner(){
        $list=$this->getList(11);
        if(!empty($list)){
            $this->returnAjax($list,1);
        }else{
            $this->returnAjax("未获取到数据！",0);
        }
    }
    //获取首页主题推荐
    public function homeAdvBanner(){
        $list=$this->getList(12);
        if(!empty($list)){
            $this->returnAjax($list,1);
        }else{
            $this->returnAjax("未获取到数据！",0);
        }
    }
    private function getList($cat_id){
        if(empty($cat_id)){
            return "";
        }
        if(session('areaarr')!="all"){
            $area_id=session("selectcityid");
        }else{
            $area_id=0;
        }
        // $database_slider_category  = D('App_slider_category');
        // $where=array(
        //      "cat_key"=>"home_app_banner",
        //     );
        // $category = $database_slider_category->field("cat_id")->where($where)->find();
        $where_slider=array(
                "cat_id"=>$cat_id,
                "area_id"=>$area_id,
                "status"=>1
            );
        $database_slider=D("App_slider");
        $list = $database_slider->field(true)->where($where_slider)->order("sort DESC")->select();
        $list=array_filter($list);
        if(!empty($list)){
            foreach($list as $key=>$val){
                if(!empty($val)){
                    $list[$key]['pic']=$this->config["site_url"]."/upload/appslider/".$val['pic'];
                }
            }
            return $list;
        }else{
            return "";
        }
    }
}