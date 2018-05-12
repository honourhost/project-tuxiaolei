<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2015/12/10
 * Time: 15:27
 */

class BaseAction extends CommonAction{
    protected function _initialize()
    {
        //基础登录
    	if(isset($_GET['token'])){
    		
    	}
        /*
         * power by taorong  begin
         */

        //产生城市参数session

        if($_GET['cityid'] ){
            $_SESSION['selectcityid']=$_GET['cityid'];

        }elseif(empty($_SESSION['selectcityid'])  &&  empty($_GET['cityid'])){

            $this->_empty();
        }


        //城市名称输出
        $condition['area_id'] = $_SESSION['selectcityid'];
        $cityarr = D('Area')->where($condition)->select();    // 把查询条件传入查询方法
        $_SESSION['cityarr']=$cityarr;
        $this->assign('cityarr',$cityarr);
        $this->assign('cityname',$cityarr['0']['area_name']);



        //组建当前城市下县或区的数组
        $condition_area['area_pid'] = $_SESSION['selectcityid'];
        $areayarr = D('Area')->where($condition_area)->select();    //把查询条件传入查询方法
        $_SESSION['areaarr']=$areayarr;

        foreach($_SESSION['areaarr'] as $k=>$v){
            $_SESSION['areaarr'][$k]=$_SESSION['areaarr'][$k]['area_id'];
        }

   }

   //返回json的封装
   protected function returnAjax($str,$status){
        $data=array("msg"=>$str,"status"=>$status);
        echo json_encode($data);
        die;
    }
}