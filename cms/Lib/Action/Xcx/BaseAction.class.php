<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/12 0012
 * Time: 17:14
 */
class BaseAction extends CommonAction
{

    protected  function  _initialize(){

        parent::_initialize();
    }


    //返回json的封装
    protected function returnAjax($str,$status){
        if(is_array($str)){
            $data=array(
                "msg"=>$str,
                "errorMsg"=>"获取数据成功！",
                "status"=>$status
            );
        }else{
            if(empty($str)){
                $data=array(
                    "msg"=>array(),
                    "errorMsg"=>"未获取到数据！",
                    "status"=>$status
                );
            }else{
                $data=array(
                    "msg"=>array(),
                    "errorMsg"=>$str,
                    "status"=>$status
                );
            }
        }
        echo json_encode($data);
        die;
    }

}