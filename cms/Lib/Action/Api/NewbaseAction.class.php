<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/19
 * Time: 9:42
 */
class NewbaseAction extends CommonAction
{

    public $is_wexin_browser = false;
    protected function _initialize()
    {

        parent::_initialize();

        //基础登录
        $this->mobileAutoLogin();
        if (strpos($_SERVER["HTTP_USER_AGENT"], "MicroMessenger") !== false) {
            $this->is_wexin_browser = true;
        }

        $this->assign("is_wexin_browser", $this->is_wexin_browser);
        if ($this->is_wexin_browser && empty($_SESSION["openid"])) {
      //      $this->authorize_openid();
        }
        //如果使用户信息的部分则必须先登录
        if(MODULE_NAME=="User"||MODULE_NAME=="Rates"||MODULE_NAME=="Usercard"||MODULE_NAME=="Neworder"||MODULE_NAME=="Express"||MODULE_NAME=="Usercoupon"){
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
                // if(count($_GET) > 0) {
                // $_GET = array();
                // }
            }else{
                $_SESSION['selectcityid']=$_GET['cityid'];
                // if(count($_GET) > 0) {
                //     $_GET = array();
                // }
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


        //如果为空跳转到全国页
        $this->returnAjax("未找到该方法",0);
    }

    //验证登录
    private function verifyLogin(){
        if (empty($this->user_session)) {
            $this->returnAjax("请先登录才能查看用户的相关信息!",0);
        }
        $now_user = d('User')->get_user($this->user_session['uid']);
        if (empty($now_user)) {
            $this->returnAjax("未获取到您的帐号信息，请重试！",0);
        }
        $now_user['now_money'] = floatval($now_user['now_money']);
        $this->now_user = $now_user;
    }

    //返回json的封装
    protected function returnAjax($str,$status,$success="小农丁",$version=1){
        if(is_array($str)){
            $data=array(
                "data"=>$str,
                "errorMsg"=>"获取数据成功",
                "search_placeholder"=>$success,
                "status"=>$status,
                "version"=>$version
            );
        }else{
            if(empty($str)){
                $data=array(
                    "data"=>array(),
                    "errorMsg"=>"未获取到数据！",
                    "search_placeholder"=>$success,
                    "status"=>$status,
                    "version"=>$version
                );
            }else{
                $data=array(
                    "data"=>array(),
                    "errorMsg"=>$str,
                    "search_placeholder"=>$success,
                    "status"=>$status,
                    "version"=>$version
                );
            }
        }
        echo json_encode($data);
        die;
    }

    private function mobileAutoLogin(){
        if(isset($_REQUEST['token'])&&isset($_REQUEST['uid'])&&!empty($_REQUEST['token'])&&!empty($_REQUEST['uid'])){
            //如果存在token和uid则先进行验证，如果session为空则赋值
            $user=session("user");
            if(empty($user)){
                //则查询再赋值
                if(!empty($_REQUEST['token'])&&!empty($_REQUEST['uid'])){
                    //查询数据库并赋值session
                    $condition=array(
                        "token"=>$_REQUEST['token'],
                        "uid"=>$_REQUEST['uid']
                    );
                    $result=D("User")->mobileUser($condition);
                    if(!empty($result)){
                        session("user",$result);
                        $this->user_session=session("user");
                    }else{
                        $this->returnAjax("登录出现问题！",0);
                    }
                }else{
                    $this->returnAjax("传参出错！",0);
                }
            }
        }
    }


}