<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/12 0012
 * Time: 17:13
 * 小程序首页数据API
 */
class IndexAction extends BaseAction
{
    /**
     * 轮播图数据
     */
    public function  index(){
        $condationhome=array(
            "cat_id"=>18,
            "status"=>1
        );
        $pin_main=M("App_slider")->field("name,pic,desc")->where($condationhome)->limit(3)->select();
        foreach ($pin_main as $key=>$value){
            $pin_main[$key]['pic']="http://www.xiaonongding.com/upload/appslider/".$pin_main[$key]['pic'];
        }
        $this->returnAjax($pin_main,1);
    }

}