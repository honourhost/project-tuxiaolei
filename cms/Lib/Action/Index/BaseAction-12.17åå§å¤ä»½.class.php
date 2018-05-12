<?php

class BaseAction extends CommonAction
{
    protected function _initialize()
    {
        parent::_initialize();



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

            // print_r($_SESSION['areaarr']);

        /*
         * power by taorong  end
         */




   }

    public function _empty()
    {

        //echo "<script>alert('您无权访问当前页面，即将为您转向到网站首页！')</script>";
        //$url='http://'. $_SERVER['HTTP_HOST'].'?cityid=2268';
        
        $_SESSION['selectcityid']="2268";
//      $url='http://xnd.winworlds.cn'.'?cityid=2268';
        $url='http://xnd.winworlds.cn/?cityid=2268';
        header("Refresh:3;url=$url");

    }



}



