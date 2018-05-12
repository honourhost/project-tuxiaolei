<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/5
 * Time: 16:03
 */
class UserAction extends BaseAction{
    public function index(){
        //p为页码
        //根据get到的status值判断对应的查询
        //全部没有status
        //待付款status=1
        //待收货status=2
        //待评价status=3
        //根据传来的参数判断选择的订单内容
        $result=D('Group')->getMobileOrderList($this->now_user['uid'],intval($_GET['status']),true);
        //循环根据结果类型区分所取图片类
        $meal_image=new store_image();
        $group_image=new group_image();
        foreach($result as $key=>$val){
            if(!empty($val['image'])){
            if($val['name']==1){
                $meal_list_pics=$meal_image->get_allImage_by_path($val['image']);;
                $result[$key]['list_pic']=$meal_list_pics[0];
            }else{
                $group_list_pics=$group_image->get_allImage_by_path($val['image']);
                $result[$key]['list_pic']=$group_list_pics[0]['image'];

                $result[$key]['url']=$this->get_group_url($val['order_detail_id']);
            }
            }
        }
        $result=array_filter($result);
        if(!empty($result)) {
            $this->returnAjax($result, 1);
        }else{
            $this->returnAjax("没查到当前用户的订单信息！",0);
        }
    }

    //收藏列表
    public function getCollects(){
        //获取get的type
        $type=$_GET['type'];
        //测试查询商品
        //$type="goods";
        //测试查询农场
        //$type="merchant_id";
        //$_GET['lat']="24.5283";
        //$_GET['long']="118.151899";
        $result=D("User_collect")->getCollects($type,$this->now_user['uid']);
        $realresult=array_merge(array_filter($result));
        //如果为农场收藏，还要计算评分
        if($type=="merchant_id"){
            foreach($realresult['collect_list'] as $k=>$val) {
                //先选出回复表中所有的关于该农场的回复，然后计算平均分
                $avg = D("Reply")->where("mer_id=".$val['mer_id'])->avg("score");
                if(empty($avg)){
                    $avg=0;
                }
                $realresult['collect_list'][$k]['score']=floatval($avg);
                $realresult['collect_list'][$k]['url']=$this->getMerchantUrl($val['mer_id']);
            }
        }
        if(!empty($realresult)){
            $this->returnAjax($realresult['collect_list'],1);
        }else{
            $this->returnAjax("未查询到收藏信息",0);
        }
    }
    //获取地址列表
    public function showAddress(){
        $user_adress_list = D('User_adress')->get_adress_list($this->now_user['uid']);
        if(!empty($user_adress_list)){
            $this->returnAjax($user_adress_list,1);
        }else{
            $this->returnAjax("未获取到地址信息",0);
        }
    }
    //添加收货地址
    public function addAddress(){
        if(IS_POST){
            if(D('User_adress')->post_form_save($this->user_session['uid'])){
                $this->returnAjax("成功保存地址信息！",1);
            }else{
                $this->returnAjax("未成功保存地址信息！",0);
            }
        }else{
            $this->returnAjax("必须是post提交的表单！",0);
        }
    }
    //添加收藏
    public function addCollect(){
        $type=$_GET['type'];
        $uid=$this->user_session['uid'];
        $id=$_GET['id'];
        if(empty($type)||empty($uid)||empty($id)){
            $this->returnAjax("有参数为空",0);
        }
        if(D("User_collect")->addCollect($type,$id,$uid)){
            $this->returnAjax("添加收藏成功",1);
        }else{
            $this->returnAjax("添加收藏失败",1);
        }
    }
    //更改头像
    public function changeAvatar(){
        if(empty($_POST['uid'])||empty($_POST['token'])){
            $this->returnAjax("传参中存在空值！",0);
        }
        //如果存在头像则存储头像
            if($_FILES['avatar']['error'] != 4){
            $param = array('size' => $this->config['meal_pic_size']);
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
            }else{
                $this->returnAjax("头像上传过程出错！",0);
            }
            //更新数据库
            $condition=array(
                "uid"=>$_POST['uid'],
                "token"=>$_POST['token'],
                );
            if(D("User")->where($condition)->setField("avatar",$_POST['avatar'])){
                //如果存在头像则返回新头像地址
                if(!empty($_POST['avatar'])){
                        $avatar_image_class=new avatar_image();
                        $res=$avatar_image_class->get_image_by_path($_POST['avatar'],C('config.site_url'));
                }
                $this->returnAjax($res['image'],1);
            }else{
                $this->returnAjax("头像修改失败！",0);
            }
    }
    //修改昵称
    public function changeNickname(){
        if(empty($_POST['uid'])||empty($_POST['token'])||empty($_POST['nikename'])){
            $this->returnAjax("传参中存在空值！",0);
        }
        //更新数据库
        $condition=array(
                "uid"=>$_POST['uid'],
                "token"=>$_POST['token'],
                );
       if(D("User")->where($condition)->setField("nickname",$_POST['nickname'])){
                $this->returnAjax("昵称修改成功！",1);
        }else{
                $this->returnAjax("昵称修改失败！",0);
        }
    }

     //获取用户参加的活动列表
    public function getJoinActivities(){
        $uid=$this->user_session['uid'];
        $result=D("Extension_activity_record")->getJoinActivity($uid);
        if(!empty($result['activites'])) {
            $extension_image_class = new extension_image();
            foreach ($result['activites'] as $k => $val) {
                $all_pic = $extension_image_class->get_allImage_by_path($val['pic']);
                $result['activites'][$k]['pic'] = $all_pic[0]['s_image'];

                 $result['activites'][$k]['url']=$this->getActivityUrl($val['pigcms_id']);
            }
        }
        if(!empty($result['activites'])){
            $this->returnAjax($result['activites'],1);
        }else{
            $this->returnAjax("未获取到数据",0);
        }
    }
    //获取用户参加的正在进行的活动列表
    public function getJoinIngActivities(){
        $uid=$this->user_session['uid'];
        $result=D("Extension_activity_record")->getIngActivity($uid);
        if(!empty($result['activites'])) {
            $extension_image_class = new extension_image();
            foreach ($result['activites'] as $k => $val) {
                $all_pic = $extension_image_class->get_allImage_by_path($val['pic']);
                $result['activites'][$k]['pic'] = $all_pic[0]['s_image'];

                 $result['activites'][$k]['url']=$this->getActivityUrl($val['pigcms_id']);
            }
        }
        if(!empty($result['activites'])){
            $this->returnAjax($result['activites'],1);
        }else{
            $this->returnAjax("未获取到数据",0);
        }
    }
    //获取用户参加的已经结束的活动列表
    public function getJoinEndActivities(){
        $uid=$this->user_session['uid'];
        $result=D("Extension_activity_record")->getEndActivity($uid);
        if(!empty($result['activites'])) {
            $extension_image_class = new extension_image();
            foreach ($result['activites'] as $k => $val) {
                $all_pic = $extension_image_class->get_allImage_by_path($val['pic']);
                $result['activites'][$k]['pic'] = $all_pic[0]['s_image'];
                $result['activites'][$k]['url']=$this->getActivityUrl($val['pigcms_id']);
            }
        }
        if(!empty($result['activites'])){
            $this->returnAjax($result['activites'],1);
        }else{
            $this->returnAjax("未获取到数据",0);
        }
    }
    //特卖URL
    public function get_group_url($group_id){
            return C('config.site_url').'/mobile.php?g=Mobile&c=Group&a=detail&group_id='.$group_id;
    }

    //获取农场url
    private function getMerchantUrl($mer_id){
        return C('config.site_url').'/mobile.php?g=Mobile&c=Merchant&a=detail&mer_id='.$mer_id;
    }
    //活动URL
    private function getActivityUrl($id){
        return C('config.site_url').'/mobile.php?g=Mobile&c=Activity&a=detail&activity_id='.$id;
    }   
}