<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2015/12/10
 * Time: 15:29
 */
class IndexAction extends BaseAction{
	//返回城市列表
	public function getCities(){
		$cities=null;
        $letters=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
        //按照字母顺序查询出所有城市的内容
        $database_area=D("Area");
        foreach($letters as $key=>$val){
            $cities[$val]=$database_area->where(array("first_pinyin"=>$val,"area_type"=>2,"is_open"=>1))->select();
        }
        if(!empty($cities)){
        $this->returnAjax(array_filter($cities),1);
    	}else{
    	$this->returnAjax("未获取到数据！",1);
    	}
	}
    //生成6位数字验证码方法
    private function createCode(){
        $code="";
        for($i=0;$i<6;$i++){
            $code.=rand(0,9);
        }
        return $code;
    }
    //检验手机号已被注册方法
    public function phoneExist(){
        $phone=$_POST['mobile'];
        if(!preg_match("/^0{0,1}(13[0-9]|15[7-9]|153|156|17[0-9]|18[0-9])[0-9]{8}$/",$phone)){
            $this->returnAjax("手机号格式不正确，请重新输入！",0);
        }
        $user=D("User")->where("phone=".$phone)->find();
        if($user){
            //存在则返回已经存在
            $this->returnAjax("该手机已经注册，请直接登录或者填写新的手机号注册！",0);
        }else{
            $this->returnAjax("可以用该手机注册！",1);
        }
    }


    public function  test(){


        if(!preg_match("/^0{0,1}(13[0-9]|15[0-35-9]|17[0-9]|18[0-9])[0-9]{8}$/","15725266012")){
            $this->returnAjax("手机号格式不正确，请重新输入！",0);
        }else{
            $this->returnAjax("手机号格式正确！",0);
        }
    }
    //发送验证码

    public function sendVerifyCode(){
        $verify_code=$this->createCode();
        $sms_data['mobile']=$_POST['mobile'];
        //先查一下手机号是否可用
        $user=D("User")->where("phone=".$sms_data['mobile'])->find();
        if($user){
            //存在则返回已经存在
            $this->returnAjax("该手机已经注册，请直接登录或者填写新的手机号注册！",0);
        }
        //if(!preg_match("/^0{0,1}(13[0-9]|15[7-9]|153|156|17[0-9]|18[0-9])[0-9]{8}$/",$sms_data['mobile'])){
			  if(!preg_match("/^0{0,1}(13[0-9]|15[0-35-9]|17[0-9]|18[0-9])[0-9]{8}$/",$sms_data['mobile'])){
            $this->returnAjax("手机号".$sms_data['mobile']."格式不正确，请重新输入！",0);
        }
        $sms_data['content']="您的验证码为：".$verify_code.",有效期为10分钟，请不要把验证码泄露给其他人。如非本人操作，可不用理会！";
      //  file_put_contents("duanxinjilu.txt",$verify_code,FILE_APPEND);
        $result=Sms::sendVerifySms($sms_data,"","utf-8",$verify_code);
        if($result==0){
            //存在则返回已经存在
            $this->returnAjax("验证码发送成功！",1);
        }else{
            //存在则返回已经存在
            $this->returnAjax("验证码发送失败！",0);
        }
    }
    //发送验证码
    public function sendNewVerifyCode(){
        $verify_code=$this->createCode();
        $sms_data['mobile']=$_POST['mobile'];
        // //先查一下手机号是否可用
        // $user=D("User")->where("phone=".$sms_data['mobile'])->find();
        // if(empty($user)){
        //     //存在则返回已经存在
        //     $this->returnAjax("该手机对应的用户不存在！",0);
        // }
        if(!preg_match("/^0{0,1}(13[0-9]|15[0-35-9]|17[0-9]|18[0-9])[0-9]{8}$/",$sms_data['mobile'])){
            $this->returnAjax("手机号格式不正确，请重新输入！",0);
        }
        $sms_data['content']="您的验证码为：".$verify_code.",有效期为10分钟，请不要把验证码泄露给其他人。如非本人操作，可不用理会！";
      //  file_put_contents("duanxinjilu.txt",$verify_code,FILE_APPEND);
        $result=Sms::sendVerifySms($sms_data,"","utf-8",$verify_code);

        if($result==0){
            //存在则返回已经存在
            $this->returnAjax("验证码发送成功！",1);
        }else{
            //存在则返回已经存在
            $this->returnAjax("验证码发送失败！",0);
        }
    }
    //验证码验证
    public function verifyCode(){
        $verify_code = isset($_POST['verify_code']) ? $_POST['verify_code'] : '';
        $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
        if(empty($mobile)||empty($verify_code)){
            $this->returnAjax("传递的验证码信息为空！",0);
        }
        $time=$_SERVER['REQUEST_TIME'];
        $condition=array(
            "mobile"=>$mobile,
            "verify_code"=>$verify_code,
            "status"=>1,
        );
        //查询验证码
        $result=D("Mobile_login_verify")->where($condition)->order("create_time desc")->find();
        if(!empty($result)){
            if($time>($result['create_time']+10*60)){
                $this->returnAjax("验证码已过期，请重新生成并验证",0);
            }else{
                $this->returnAjax("验证码验证成功！",1);
            }
        }else{
            $this->returnAjax("该手机号还没有产生验证码",0);
        }
    }

    /**
     * 验证短信并注册
     */
    public function veryfyCodeAndRegist(){
        $verify_code = isset($_POST['verify_code']) ? $_POST['verify_code'] : '';
        $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
        if(empty($mobile)||empty($verify_code)){
            $this->returnAjax("传递的验证码信息为空！",0);
        }
        $time=$_SERVER['REQUEST_TIME'];
        $condition=array(
            "mobile"=>$mobile,
            "verify_code"=>$verify_code,
            "status"=>1,
        );
        //查询验证码
        $result=D("Mobile_login_verify")->where($condition)->order("create_time desc")->find();
        if(!empty($result)){
            if($time>($result['create_time']+10*60)){
                $this->returnAjax("验证码已过期，请重新生成并验证",0);
            }else{

                $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
                $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
                $verify_code=isset($_POST['verify_code']) ? $_POST['verify_code'] : '';
                //是否加密
                $encrypt=isset($_POST['encrypt']) ? $_POST['encrypt'] : '';
                if(empty($mobile)||empty($verify_code)||empty($pwd)){
                    $this->returnAjax("传递的参数中存在空值！",0);
                }
                //首先查看验证码是否存在
                $condition=array(
                    "mobile"=>$mobile,
                    "verify_code"=>$verify_code,
                    "status"=>1,
                );
                $res=D("Mobile_login_verify")->where($condition)->order("create_time desc")->find();
                if(!empty($res)) {
                    //如果存在头像则存储头像
                    if($_FILES['avatar']['error'] != 4){
                        $param = array('size' => "5");
                        $param['thumb'] = true;
                        $param['imageClassPath'] = 'ORG.Util.Image';
                        $param['thumbPrefix'] = 'm_,s_';
                        $param['thumbMaxWidth']  = $this->config['meal_pic_width'];
                        $param['thumbMaxHeight'] = $this->config['meal_pic_height'];
                        $param['thumbRemoveOrigin'] = false;
                        //选出当前用户表中的id最大值+1
                        $oldid=D("User")->max("uid");
                        $newid=$oldid+1;
                        $image = D('Image')->handle($newid, 'avatar', 1, $param);
                        if ($image['error']) {
                            $this->returnAjax("头像上传过程出错！",0);
                        } else {
                            $_POST = array_merge($_POST, $image['title']);
                        }
                    }
                    if($encrypt==1){
                        $result = D('User')->checkMobileReg($mobile, $pwd);
                    }else{
                        $result = D('User')->checkreg($mobile, $pwd);
                    }
                    //注册成功后先记录session，之后返回用户信息
                    if (!empty($result['user'])) {
                        session('user', $result['user']);
                        //注册成功后返回token和uid
                        $mobilereturn=$result['user'];
                        $this->returnAjax($mobilereturn,1);
                    }else{
                        $this->returnAjax("注册失败！",0);
                    }
                }else{
                    $this->returnAjax("验证码无效！",0);
                }
            }
        }else{
            $this->returnAjax("该手机号还没有产生验证码",0);
        }


    }
    //已有账号登录
    public function login(){
       // $mobile = isset($_GET['mobile']) ? $_GET['mobile'] : '';
       // $pwd = isset($_GET['pwd']) ? $_GET['pwd'] : '';
       $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
       $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
       //是否加密
       $encrypt=isset($_POST['encrypt']) ? $_POST['encrypt'] : '';
        if(empty($mobile)||empty($pwd)){
            $this->returnAjax("传递的参数中存在空值！",0);
        }
        if($encrypt==1){
        $result=D('User')->checkMobileIn($mobile,$pwd);
        }else{
            $result=D('User')->checkin($mobile,$pwd);
        }
        //注册成功后先记录session，之后返回用户信息
        if (!empty($result['user'])) {
            session('user', $result['user']);
            //登录成功后返回token和uid
            $mobilereturn=$result['user'];
            $this->returnAjax($mobilereturn,1);
        }else{
            $this->returnAjax("登录失败！",0);
        }
    }
    //忘记密码
    public function forgetPwd(){
        //测试先用get
        // $mobile = isset($_GET['mobile']) ? $_GET['mobile'] : '';
        // $pwd = isset($_GET['pwd']) ? $_GET['pwd'] : '';
        // $verify_code=isset($_GET['verify_code']) ? $_GET['verify_code'] : '';
       $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
       $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
       $verify_code=isset($_POST['verify_code']) ? $_POST['verify_code'] : '';
       //是否加密
       $encrypt=isset($_POST['encrypt']) ? $_POST['encrypt'] : '';
        if(empty($mobile)||empty($verify_code)||empty($pwd)){
            $this->returnAjax("传递的参数中存在空值！",0);
        }
        //先检测验证码是否过期
        $time=$_SERVER['REQUEST_TIME'];
        $condition=array(
            "mobile"=>$mobile,
            "verify_code"=>$verify_code,
            "status"=>1,
        );
        //查询验证码
        $result=D("Mobile_login_verify")->where($condition)->order("create_time desc")->find();
        if(!empty($result)){
            if($time>($result['create_time']+10*60)){
                $this->returnAjax("验证码已过期，请重新生成并验证",0);
            }else{
                //验证码验证成功后先检测用户是否存在
                $User=D('User');
                $now_user = $User->field(true)->where(array('phone' => $mobile))->find();
                if(!empty($now_user)){
                    if($encrypt==1){
                    $result=$User->where(array('phone' => $mobile,"uid"=>$now_user['uid']))->setField("pwd",$pwd);
                    }else{
                        $result=$User->where(array('phone' => $mobile,"uid"=>$now_user['uid']))->setField("pwd",md5($pwd));
                    }
                    //修改成功后先记录session，之后返回用户信息
                    if ($result) {
                        //如果存在头像则返回完整地址
                        if(!empty($now_user['avatar'])){
                        if(!strstr($now_user['avatar'],"http://")){
                            $avatar_image_class=new avatar_image();
                            $res=$avatar_image_class->get_image_by_path($now_user['avatar'],C('config.site_url'));
                            $now_user['avatar']=$res['image'];
                        }
                        }
                        session('user', $now_user);
                        //登录成功后返回token和uid
                        $mobilereturn=$now_user;
                        $this->returnAjax($mobilereturn,1);
                    }else{
                        $this->returnAjax("修改密码失败！",0);
                    }
                }else{
                    $this->returnAjax("不存在该手机号的用户！",0);
                }
            }
        }else{
            $this->returnAjax("该手机号还没有产生验证码",0);
        }
    }
    //注册过程
    public function register(){
        //测试先用get
         // $mobile = isset($_GET['mobile']) ? $_GET['mobile'] : '';
         // $pwd = isset($_GET['pwd']) ? $_GET['pwd'] : '';
         // $verify_code=isset($_GET['verify_code']) ? $_GET['verify_code'] : '';
       $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
       $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
       $verify_code=isset($_POST['verify_code']) ? $_POST['verify_code'] : '';
       //是否加密
       $encrypt=isset($_POST['encrypt']) ? $_POST['encrypt'] : '';
        if(empty($mobile)||empty($verify_code)||empty($pwd)){
            $this->returnAjax("传递的参数中存在空值！",0);
        }
        //首先查看验证码是否存在
        $condition=array(
            "mobile"=>$mobile,
            "verify_code"=>$verify_code,
            "status"=>1,
        );
        $res=D("Mobile_login_verify")->where($condition)->order("create_time desc")->find();
        if(!empty($res)) {
            //如果存在头像则存储头像
//            if($_FILES['avatar']['error'] != 4){
//            $param = array('size' => "5");
//            $param['thumb'] = true;
//            $param['imageClassPath'] = 'ORG.Util.Image';
//            $param['thumbPrefix'] = 'm_,s_';
//            $param['thumbMaxWidth']  = $this->config['meal_pic_width'];
//            $param['thumbMaxHeight'] = $this->config['meal_pic_height'];
//            $param['thumbRemoveOrigin'] = false;
//            //选出当前用户表中的id最大值+1
//            $oldid=D("User")->max("uid");
//            $newid=$oldid+1;
//            $image = D('Image')->handle($newid, 'avatar', 1, $param);
//            if ($image['error']) {
//                $this->returnAjax("头像上传过程出错！",0);
//            } else {
//                $_POST = array_merge($_POST, $image['title']);
//            }
//            }
            if($encrypt==1){
            $result = D('User')->checkMobileReg($mobile, $pwd);
            }else{
                $result = D('User')->checkreg($mobile, $pwd);
            }
            //注册成功后先记录session，之后返回用户信息
            if (!empty($result['user'])) {
                session('user', $result['user']);
                //注册成功后返回token和uid
                $mobilereturn=$result['user'];
                $this->returnAjax($mobilereturn,1);
            }else{
                $this->returnAjax("注册失败！",0);
            }
        }else{
                $this->returnAjax("验证码无效！",0);
        }
    }
    //获取APP顶部菜单内容
    public function getMenus(){
        //APP菜单项的分类id为13
        $cat_id=13;
        //说明是默认的全国菜单
        if($_SESSION['areaarr']=="all"){
            //查询条件不带area_id
            $condition=array(
                "status"=>1,
                "area_id"=>0,
                "cat_id"=>$cat_id
                );
        }else{
            $area_id=$_SESSION['selectcityid'];
            $condition=array(
                "area_id"=>$area_id,
                "status"=>1,
                "cat_id"=>$cat_id
                );
        }
        $app_slider=M("App_slider");
        $result=$app_slider->where($condition)->order("sort ASC")->select();
        if(!empty($result)){
            foreach($result as $key=>$val){
            if(!empty($val['pic'])){
                $result[$key]['pic']=C('config.site_url')."/upload/appslider/".$val['pic'];
            }
            }
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("获取信息失败",0);
        }
    }


}