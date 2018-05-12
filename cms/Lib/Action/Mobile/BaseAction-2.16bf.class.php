<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/11
 * Time: 10:47
 */
class BaseAction extends CommonAction{
    protected function _initialize()
    {

        parent::_initialize();

        //基础登录
        $this->mobileAutoLogin();

        //如果使用户信息的部分则必须先登录
        if(MODULE_NAME=="User"){
            $this->verifyLogin();
        }
        //如果传来了经纬度信息，则需要存储到session中方便使用
        $lat=$_GET['lat'];
        $long=$_GET['long'];
        if(!empty($lat)&&!empty($long)){
            session("lat",$lat);
            session("long",$long);
        }

        if($_GET['cityid'] ){
            $database_area=D("Area");
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
            $_SESSION['areaarr']="all";
            $_SESSION['cityarr'][0]['area_name']="全国";
            $_SESSION['area_all']=1;
        }

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
        $this->error("未找到该方法");
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
    //验证登录
    private function verifyLogin(){
        if (empty($this->user_session)) {
            $this->error("请先登录才能查看用户的相关信息!");
        }
        $now_user = d('User')->get_user($this->user_session['uid']);
        if (empty($now_user)) {
            $this->error("未获取到您的帐号信息，请重试！");
        }
        $now_user['now_money'] = floatval($now_user['now_money']);
        $this->now_user = $now_user;
    }

    private function mobileAutoLogin(){
        if(isset($_GET['token'])&&isset($_GET['uid'])){
            //如果存在token和uid则先进行验证，如果session为空则赋值
            $user=session("user");
            if(empty($user)){
                //则查询再赋值
                if(!empty($_GET['token'])&&!empty($_GET['uid'])){
                    //查询数据库并赋值session
                    $condition=array(
                        "token"=>$_GET['token'],
                        "uid"=>$_GET['uid']
                    );
                    $result=D("User")->mobileUser($condition);
                    if(!empty($result)){
                        session("user",$result);
                        $this->user_session=session("user");
                    }else{
                        $this->error("登录出现问题！");
                    }
                }else{
                    $this->error("传参出错！");
                }
            }
        }
        if(isset($_POST['token'])&&isset($_POST['uid'])){
            //如果存在token和uid则先进行验证，如果session为空则赋值
            $user=session("user");
            if(empty($user)){
                //则查询再赋值
                if(!empty($_POST['token'])&&!empty($_POST['uid'])){
                    //查询数据库并赋值session
                    $condition=array(
                        "token"=>$_POST['token'],
                        "uid"=>$_POST['uid']
                    );
                    $result=D("User")->mobileUser($condition);
                    if(!empty($result)){
                        session("user",$result);
                        $this->user_session=session("user");
                    }else{
                        $this->error("登录出现问题！");
                    }
                }else{
                    $this->error("传参出错！");
                }
            }
        }
    }
}