<?php

class BaseAction extends CommonAction
{
    protected function _initialize()
    {
        parent::_initialize();
		//按照首字母查询出所有城市信息
        $cities=null;
        $letters=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
        //按照字母顺序查询出所有城市的内容
        $database_area=D("Area");
        foreach($letters as $key=>$val){
            $cities[$val]=$database_area->where(array("first_pinyin"=>$val,"area_type"=>2,"is_open"=>1))->select();
        }
        $this->assign("cities",$cities);

        if($_GET['cityid'] ){
            //如果城市id为all，则按照全国处理
            if($_GET['cityid']=="all"){
                //删除其他涉及城市的信息
                unset($_SESSION['selectcityid']);
                unset($_SESSION['cityarr']);
                unset($_SESSION['areaarr']);
                $_SESSION['areaarr']="all";
                $_SESSION['cityarr'][0]['area_name']="全国";
                $_SESSION['area_all']=1;
                if(count($_GET) > 0) {
                $_GET = array();
                }
            }else{
            $_SESSION['selectcityid']=$_GET['cityid'];
            if(count($_GET) > 0) {
                $_GET = array();
            }
            unset($_SESSION['area_all']);
            unset($_SESSION['areaarr']);
            unset($_SESSION['cityarr']);
            $condition['area_id'] = $_SESSION['selectcityid'];
            $cityarr = $database_area->where($condition)->select();    // 把查询条件传入查询方法
            $_SESSION['cityarr']=$cityarr;
            $this->assign('cityarr',$cityarr);
            $this->assign('cityname',$cityarr['0']['area_name']);



        //组建当前城市下县或区的数组
        $condition_area['area_pid'] = $_SESSION['selectcityid'];
        $areayarr = $database_area->where($condition_area)->select();    //把查询条件传入查询方法
        $_SESSION['areaarr']=$areayarr;

        foreach($_SESSION['areaarr'] as $k=>$v){
            $_SESSION['areaarr'][$k]=$_SESSION['areaarr'][$k]['area_id'];
        }
        }
        }elseif(empty($_SESSION['selectcityid'])  &&  empty($_GET['cityid']) && empty($_SESSION['area_all'])){
                $this->_empty();
        }/*elseif(empty($_SESSION['selectcityid'])  &&  empty($_GET['cityid'])){
            $this->_empty();
        }*/
        //城市名称输出
        
	}

   public function _empty()
    {

        //echo "<script>alert('您无权访问当前页面，即将为您转向到网站首页！')</script>";
        //$url='http://'. $_SERVER['HTTP_HOST'].'?cityid=2268';
        
        //$_SESSION['selectcityid']="2268";
//      $url='http://xnd.winworlds.cn'.'?cityid=2268';
        //$url='http://xnd.winworlds.cn/?cityid=2268';
        //header("Refresh:3;url=$url");
        //如果为空跳转到全国页
        $_SESSION['areaarr']="all";
        $_SESSION['cityarr'][0]['area_name']="全国";
        $_SESSION['area_all']=1;
    }
}


?>
