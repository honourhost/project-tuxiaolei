<?php

class BaseAction extends CommonAction
{
    protected function _initialize()
    {
        parent::_initialize();



        /*
         * power by sunny  begin
         */

        //产生城市参数session
        if($_GET['provinceid']){
            $_SESSION['provinceid']=$_GET['provinceid'];
            //选择省之后删除市的session
            unset($_SESSION['selectcityid']);
            $condition['area_id'] = $_SESSION['provinceid'];
            $provincearr = D('Area')->where($condition)->select();    // 把查询条件传入查询方法
            $_SESSION['provincearr']=$provincearr;
            //选取当前省下的所有城市
            $pcondition['area_pid'] = $_SESSION['provinceid'];
            $cityarr = D('Area')->where($pcondition)->select();
            unset($_SESSION['areaarr']);
            //选取城市下的所有地区，用来以后筛选数据
            $_SESSION['areaarr']="";
            foreach($cityarr as $key=>$val){
                $condition_area['area_pid'] = $val['area_id'];
                $areayarr = D('Area')->where($condition_area)->select();    //把查询条件传入查询方法
                foreach($areayarr as $k=>$v){
                    $_SESSION['areaarr'][]=$v['area_id'];
                }
            }
            $_SESSION['area_name']=$provincearr['0']['area_name'];
            $this->assign('provincearr',$provincearr);
            $this->assign('provincename',$provincearr['0']['area_name']);
        }
        elseif($_GET['cityid']){
            $_SESSION['selectcityid']=$_GET['cityid'];
            //选择市之后删除省的session
            unset($_SESSION['provinceid']);
            unset($_SESSION['provincearr']);
            $condition['area_id'] = $_SESSION['selectcityid'];
            $cityarr = D('Area')->where($condition)->select();    // 把查询条件传入查询方法
            $_SESSION['cityarr']=$cityarr;
            $this->assign('cityarr',$cityarr);
            $this->assign('cityname',$cityarr['0']['area_name']);
            //组建当前城市下县或区的数组
            $condition_area['area_pid'] = $_SESSION['selectcityid'];
            $areayarr = D('Area')->where($condition_area)->select();    //把查询条件传入查询方法
            unset($_SESSION['areaarr']);
            $_SESSION['areaarr']="";
            foreach($areayarr as $k=>$v){
                $_SESSION['areaarr'][]=$v['area_id'];
            }
            $_SESSION['area_name']=$cityarr['0']['area_name'];
            $this->assign('cityarr',$cityarr);
            $this->assign('cityname',$cityarr['0']['area_name']);
        }elseif($_GET['area']=="all"){
            unset($_SESSION["selectcityid"]);
            unset($_SESSION['provinceid']);
            unset($_SESSION['provincearr']);
            unset( $_SESSION['cityarr']);
            $_SESSION['cityarr']="";
            $_SESSION['area_name']="全国";
            $_SESSION['areaarr']="all";
        }elseif(!isset($_SESSION['selectcityid'])&&!isset($_SESSION['provinceid'])){
            unset($_SESSION["selectcityid"]);
            unset($_SESSION['provinceid']);
            unset($_SESSION['provincearr']);
            unset( $_SESSION['cityarr']);
            $_SESSION['cityarr']="";
            $_SESSION['area_name']="全国";
            $_SESSION['areaarr']="all";
        }
   }

    public function _empty()
    {

        //echo "<script>alert('您无权访问当前页面，即将为您转向到网站首页！')</script>";
        //$url='http://'. $_SERVER['HTTP_HOST'].'?cityid=2268';
        
       /* $_SESSION['selectcityid']="2268";
//      $url='http://xnd.winworlds.cn'.'?cityid=2268';
        $url='http://www.xiaonongding.com/?cityid=2268';
        header("Refresh:3;url=$url");*/
        $_SESSION['areaarr']="all";
//      $url='http://xnd.winworlds.cn'.'?cityid=2268';
        $url='http://www.xiaonongding.com/';
        header("Refresh:3;url=$url");

    }



}



