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
        //已完成status=4
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

                $result[$key]['price'] = round(floatval($val['price']),2);
                $result[$key]['total_money'] = round(floatval($val['total_money']),2);
            }else{
                if($val['tuan_type']!=2){
                    $result[$key]['qrcode_url']=C('config.site_url')."/wap.php?c=Storestaff&a=group_qrcode&order_id=".$val['order_id']."&id=".$val['group_pass'];
                }
                $group_list_pics=$group_image->get_allImage_by_path($val['image']);
                $result[$key]['list_pic']=$group_list_pics[0]['image'];

                $result[$key]['url']=$this->get_group_url($val['order_detail_id']);

                $result[$key]['price'] = round(floatval($val['price']),2);
                $result[$key]['total_money'] = round(floatval($val['total_money']),2);
            }
            }
        }
        //$result=array_filter($result);
        if(!empty($result)) {
            $this->returnAjax($result, 1);
        }else{
            $this->returnAjax("没查到当前用户的订单信息！",0);
        }
    }
	
	/**
     * 拼团订单
     */
    public function getPinOrder(){
        //p为页码
        //根据get到的status值判断对应的查询
        //全部没有status
        //待付款status=1
        //待收货status=2
        //待评价status=3
        //已完成status=4
        //根据传来的参数判断选择的订单内容
        $result=D('Group')->getMobilePinOrderList($this->now_user['uid'],intval($_GET['status']),true);
        //循环根据结果类型区分所取图片类
        $meal_image=new store_image();
        $group_image=new group_image();
        foreach($result as $key=>$val){
            if(!empty($val['image'])){
                if($val['name']==1){
                    $meal_list_pics=$meal_image->get_allImage_by_path($val['image']);;
                    $result[$key]['list_pic']=$meal_list_pics[0];

                    $result[$key]['price'] = round(floatval($val['price']),2);
                    $result[$key]['total_money'] = round(floatval($val['total_money']),2);
                }else{
                    if($val['tuan_type']!=2){
                        $result[$key]['qrcode_url']=C('config.site_url')."/wap.php?c=Storestaff&a=group_qrcode&order_id=".$val['order_id']."&id=".$val['group_pass'];
                    }
                    $group_list_pics=$group_image->get_allImage_by_path($val['image']);
                    $result[$key]['list_pic']=$group_list_pics[0]['image'];

                    $result[$key]['url']=$this->get_group_url($val['order_detail_id']);

                    $result[$key]['price'] = round(floatval($val['price']),2);
                    $result[$key]['total_money'] = round(floatval($val['total_money']),2);
                }
            }
        }
        //$result=array_filter($result);
        if(!empty($result)) {
            $this->returnAjax($result, 1);
        }else{
            $this->returnAjax("没查到当前用户的订单信息！",0);
        }
    }

    /**
     * 获取抽奖团订单
     */
    public function getLotteryOrder(){
        //p为页码
        //根据get到的status值判断对应的查询
        //全部没有status
        //待付款status=1
        //待收货status=2
        //待评价status=3
        //已完成status=4
        //根据传来的参数判断选择的订单内容
        $result=D('Group')->getMobileLotteryOrderList($this->now_user['uid'],intval($_GET['status']),true);
        //循环根据结果类型区分所取图片类
        $meal_image=new store_image();
        $group_image=new group_image();
        foreach($result as $key=>$val){
            if(!empty($val['image'])){
                if($val['name']==1){
                    $meal_list_pics=$meal_image->get_allImage_by_path($val['image']);;
                    $result[$key]['list_pic']=$meal_list_pics[0];

                    $result[$key]['price'] = round(floatval($val['price']),2);
                    $result[$key]['total_money'] = round(floatval($val['total_money']),2);
                }else{
                    if($val['tuan_type']!=2){
                        $result[$key]['qrcode_url']=C('config.site_url')."/wap.php?c=Storestaff&a=group_qrcode&order_id=".$val['order_id']."&id=".$val['group_pass'];
                    }
                    $group_list_pics=$group_image->get_allImage_by_path($val['image']);
                    $result[$key]['list_pic']=$group_list_pics[0]['image'];

                    $result[$key]['url']=$this->get_group_url($val['order_detail_id']);

                    $result[$key]['price'] = round(floatval($val['price']),2);
                    $result[$key]['total_money'] = round(floatval($val['total_money']),2);
                }
            }
        }
        //$result=array_filter($result);
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
            $this->returnAjax("未获取到地址信息",2);
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
    public function  addAddressnew(){
        if(IS_POST){
            if(empty($_POST["adress"])){
                $this->returnAjax(array("addressid"=>""),0);
            }
            if($addressid=D('User_adress')->post_form_save($this->user_session['uid'])){
                $this->returnAjax(array("addressid"=>$addressid),1);
            }else{
                $this->returnAjax(array("addressid"=>""),0);
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
        if(empty($_POST['uid'])||empty($_POST['token'])||empty($_POST['nickname'])){
            $this->returnAjax("传参中存在空值！",0);
        }
        //更新数据库
        $condition=array(
                "uid"=>$_POST['uid'],
                "token"=>$_POST['token'],
                );
       if(D("User")->where($condition)->setField("nickname",$_POST['nickname'])){
                $this->returnAjax($_POST['nickname'],1);
        }else{
                $this->returnAjax("昵称修改失败！",0);
        }
    }

     //获取用户参加的活动列表
    public function getJoinActivities(){
        $uid=$this->user_session['uid'];
         $long=$_GET['long'];
        $lat=$_GET['lat'];
        if(empty($lat)||empty($long)){
            $this->returnAjax("没有获取到经纬度信息！",0);
        }
        $result=D("Extension_activity_record")->getJoinActivity($uid,$lat,$long);
        if(!empty($result['activites'])) {
            $extension_image_class = new extension_image();
            foreach ($result['activites'] as $k => $val) {
                $all_pic = $extension_image_class->get_allImage_by_path($val['pic']);
                $result['activites'][$k]['pic'] = $all_pic[0]['s_image'];

                 $result['activites'][$k]['url']=$this->getActivityUrl($val['activity_list_id']);
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
         $long=$_GET['long'];
        $lat=$_GET['lat'];
        if(empty($lat)||empty($long)){
            $this->returnAjax("没有获取到经纬度信息！",0);
        }
        $result=D("Extension_activity_record")->getIngActivity($uid,$lat,$long);
        if(!empty($result['activites'])) {
            $extension_image_class = new extension_image();
            foreach ($result['activites'] as $k => $val) {
                $all_pic = $extension_image_class->get_allImage_by_path($val['pic']);
                $result['activites'][$k]['pic'] = $all_pic[0]['s_image'];

                 $result['activites'][$k]['url']=$this->getActivityUrl($val['activity_list_id']);
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
         $long=$_GET['long'];
        $lat=$_GET['lat'];
        if(empty($lat)||empty($long)){
            $this->returnAjax("没有获取到经纬度信息！",0);
        }
        $result=D("Extension_activity_record")->getEndActivity($uid,$lat,$long);
        if(!empty($result['activites'])) {
            $extension_image_class = new extension_image();
            foreach ($result['activites'] as $k => $val) {
                $all_pic = $extension_image_class->get_allImage_by_path($val['pic']);
                $result['activites'][$k]['pic'] = $all_pic[0]['s_image'];
                $result['activites'][$k]['url']=$this->getActivityUrl($val['activity_list_id']);
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
    //删除地址
    public function deleteAddress(){
        $adress_id=$_GET["adress_id"];
        if(empty($adress_id)){
            $this->returnAjax("未获取到地址id！",0);
        }
        $res=D("User_adress")->where("adress_id IN (".$adress_id.")")->delete();
        if($res){
            $this->returnAjax("删除地址成功！",1);
        }else{
            $this->returnAjax("删除地址失败！",0);
        }
    }

    //删除地址
    public function deleteCollect(){
         $collect_id=$_GET["collect_id"];
        if(empty($collect_id)){
            $this->returnAjax("获取参数不正确",0);
        }
        $res=D("User_collect")->where("collect_id IN (".$collect_id.")")->delete();
        if($res){
            $this->returnAjax("删除收藏成功！",1);
        }else{
            $this->returnAjax("删除收藏失败！",0);
        }
    }
    //用户积分记录
    //获取用户积分明细
    public function getPoint(){
        $list=D('User_score_list')->get_Mobile_list($this->now_user['uid']);
        if(!empty($list)){
        $this->returnAjax($list,1);
        }else{
            $this->returnAjax("获取记录失败！",0);
        }
    }
    //获取用户订单详情接口
    //根据获取的type类型判断是什么类型，然后获取具体订单详情参数
    public function getOrderDetail(){
        $type=intval($_GET['type']);
        //type=1,为group类型订单
        //type=2,为meal类型订单
        $order_id=intval($_GET['order_id']);
        $uid=$this->user_session['uid'];
        if(empty($uid)){
            $this->returnAjax("未获取到登录信息！",0);
        }
        if(empty($order_id)){
            $this->returnAjax("未获取到订单id!",0);
        }
        if($type==1){
            $now_order = D('Group_order')->get_order_detail_by_id($uid,$_GET['order_id']);
            if(empty($now_order)){
                $this->returnAjax("未获取到订单详情信息！",0);
            }else{
                $this->returnAjax($now_order,1);
            }
        }elseif($type==2){
            $now_order = D('Meal_order')->get_order_by_id($uid,$_GET['order_id']);
            if(empty($now_order)){
                $this->returnAjax("未获取到订单详情信息！",0);
            }
            $now_order['info'] = unserialize($now_order['info']);

            $now_order['pay_type_txt'] = D('Pay')->get_pay_name($now_order['pay_type'], $now_order['is_mobile_pay']);
        
            if ($now_order['meal_pass']) {
            $now_order['meal_pass_txt'] = preg_replace('#(\d{4})#','$1 ',$now_order['meal_pass']);
            }
            $this->returnAjax($now_order,1);
        }else{
            $this->returnAjax("订单类型不正确！",0);
        }
    }
    //取消用户订单接口（仅支持未支付订单）
    //根据获取的type类型判断是什么类型，然后获取具体订单详情参数
    public function orderCancle(){
        $type=intval($_GET['type']);
        //type=1,为group类型订单
        //type=2,为meal类型订单
        $order_id=intval($_GET['order_id']);
        $uid=$this->user_session['uid'];
        if(empty($uid)){
            $this->returnAjax("未获取到登录信息！",0);
        }
        if(empty($order_id)){
            $this->returnAjax("未获取到订单id!",0);
        }
        if($type==1){
            $now_order = D('Group_order')->get_order_detail_by_id($uid,$_GET['order_id']);
            if(empty($now_order)){
                $this->returnAjax("未获取到订单详情信息！",0);
            }else{
                //修改订单状态
                if($now_order['paid']==1){
                    $this->returnAjax("已支付订单无法取消！",0);
                }else{
                    if(D("Group_order")->where("order_id=".$order_id)->setField("status",4)){
                        $this->returnAjax("订单已取消！",1);
                    }else{
                        $this->returnAjax("订单取消失败！",0);
                    }
                }
            }
        }elseif($type==2){
            $now_order = D('Meal_order')->get_order_by_id($uid,$_GET['order_id']);
            if(empty($now_order)){
                $this->returnAjax("未获取到订单详情信息！",0);
            }else{
                //修改订单状态
                if($now_order['paid']==1){
                    $this->returnAjax("已支付订单无法取消！",0);
                }else{
                    if(D("Meal_order")->where("order_id=".$order_id)->setField("status",3)){
                        $this->returnAjax("订单已取消！",1);
                    }else{
                        $this->returnAjax("订单取消失败！",0);
                    }
                }
            }
        }else{
            $this->returnAjax("订单类型不正确！",0);
        }
    }
    
}