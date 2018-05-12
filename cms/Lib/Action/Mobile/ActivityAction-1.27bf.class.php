<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/15
 * Time: 14:02
 */
class ActivityAction extends BaseAction{
    public function  index(){
        $this->error("还未开放");
    }
    public function detail(){
        $activity_id=$_GET['activity_id'];
        if(empty($activity_id)){
            $this->error("未获取到活动id");
        }
        $long=session('long');
        $lat=session('lat');
        //获取传来的经纬度信息
        if(empty($lat)||empty($long)){
            $this->error("未获取到经纬度信息！");
        }
        $Model=new Model();
        $sql="SELECT activity.*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) AS distance,ms.* FROM (SELECT a.*,term.begin_time,term.end_time FROM "
            .C('DB_PREFIX')."extension_activity_list a LEFT JOIN ".C('DB_PREFIX')."extension_activity term ON a.activity_term=term.activity_id WHERE a.pigcms_id=".$activity_id.") AS activity LEFT JOIN ( SELECT m.*,s.long,s.lat,s.store_id FROM ".C('DB_PREFIX')."merchant m LEFT JOIN ".C('DB_PREFIX').
            "merchant_store s ON m.mer_id=s.mer_id WHERE s.ismain=1 AND s.status=1) as ms ON activity.mer_id=ms.mer_id";
        $result=$Model->query($sql);
        if(empty($result)){
            $this->error("未获取到活动信息！");
        }
        //将农场信息整理
        $activity=$result[0];
        $Merchant_class_image=new Merchant_image();
        $activity['person_image']=$Merchant_class_image->get_image_by_path($activity['person_image']);
        $activity['merchant_theme_image']=$Merchant_class_image->get_image_by_path($activity['merchant_theme_image']);
        //活动图
        $Activity_class_image=new extension_image();
        $activity['pic']=$Activity_class_image->get_allImage_by_path($activity['pic']);
        $this->assign("now_activity",$activity);
        //获取农场下的特卖数
        $group_count=D("Group")->where(array("mer_id"=>$activity['mer_id'],"status"=>1))->count();
        $meal_count=D("Meal")->where(array("store_id"=>$activity['store_id'],"status"=>1))->count();
        $this->assign("group_count",$group_count);
        $this->assign("meal_count",$meal_count);
        //查出最先参加活动的5个用户(不重复)
        $five=D("Extension_activity_record")->alias("re")->distinct(true)->field("u.uid,u.nickname,u.avatar")->join(C("DB_PREFIX")."user u ON re.uid=u.uid")->where("activity_list_id=".$activity['pigcms_id'])->order("(time+msec) asc")->select();
        foreach($five as $k=>$now_user){
        if(strstr($now_user['avatar'],",")) {
            //如果头像字段存在,证明为后期上传的则获取真实地址
            $avatar_image_class = new avatar_image();
            $return= $avatar_image_class->get_image_by_path($now_user['avatar'], C('config.site_url'));
            $five[$k]['avatar']=$return['image'];
        }
        }
        $this->assign("five",$five);
        $this->display();
    }

    public function submit(){
        header('Content-Type: application/json; charset=utf-8');
        $quantity = intval($_POST['q']);
        if($quantity < 1){
            exit(json_encode(array('status'=>0,'info'=>'最少需要参与1次')));
        }else if($quantity > 200){
            exit(json_encode(array('status'=>0,'info'=>'一次性最多参加200次，请分批次参与')));
        }
        if(empty($this->user_session)){
            exit(json_encode(array('status'=>-3,'info'=>'请先进行登录')));
        }
        $database_extension_activity_list = D('Extension_activity_list');
        $condition_extension_activity_list['pigcms_id'] = $_GET['id'];
        $now_activity = $database_extension_activity_list->field(true)->where($condition_extension_activity_list)->find();
        if(empty($now_activity)){
            exit(json_encode(array('status'=>0,'info'=>'该活动不存在')));
        }
        $surplus_count = $now_activity['all_count']-$now_activity['part_count'];
        if($surplus_count == 0){
            exit(json_encode(array('status'=>-2,'info'=>'该活动已经结束，点击确定按钮 刷新页面！')));
        }
        if($surplus_count < $quantity){
            exit(json_encode(array('status'=>-1,'info'=>'您最多只能参加 '.($surplus_count).' 次','count'=>$surplus_count)));
        }
        $now_activity['money'] = floatval($now_activity['money']);

        if(!empty($now_activity['mer_score']) && !in_array($_POST['score_type'],array('1','2'))){
            exit(json_encode(array('status'=>0,'info'=>'该活动是以积分兑换，但是您提交的积分类别有误')));
        }
        $now_user = D('User')->get_user($this->user_session['uid']);
        if(empty($now_user)){
            exit(json_encode(array('status'=>0,'info'=>'未获取到您的帐号信息，请重试')));
        }
        if($now_activity['type'] == 1 && !M('User_adress')->where(array('uid'=>$this->user_session['uid']))->find()){
            exit(json_encode(array('status'=>0,'info'=>'您必须在用户中心添加一个收货地址才能进行一元夺宝')));
        }


        //判断是用钱还是用积分
        if($now_activity['money'] != 0){
            $use_money = $now_activity['money']*$quantity;
            if($now_user['now_money'] < $use_money){
                exit(json_encode(array('status'=>-4,'info'=>'您的帐户余额为 <span>'.$now_user['now_money'].'</span> 元，请先充值帐户余额','recharge'=>$use_money-$now_user['now_money'])));
            }
            $save_result = D('User')->user_money($now_user['uid'],$use_money,'参加一元夺宝活动');
            if($save_result['error_code']){
                exit(json_encode(array('status'=>0,'info'=>$save_result['error_code'])));
            }
        }else{
            if($_POST['score_type'] == '2'){
                $use_score = $now_activity['mer_score']/$this->config['activity_score_scale']*$quantity;
                if($now_user['score_count'] < $use_score){
                    exit(json_encode(array('status'=>0,'info'=>'您的帐户积分为 '. $now_user['score_count'].' ，不足以兑换此奖品')));
                }
                $save_result = D('User')->user_score($now_user['uid'],$use_score,'兑换优惠券');
                if($save_result['error_code']){
                    exit(json_encode(array('status'=>0,'info'=>$save_result['error_code'])));
                }
            }else{
                $use_score = $now_activity['mer_score']*$quantity;
                $database_userinfo = D('Userinfo');
                //得到商家积分
                $user_mer_score = $database_userinfo->get_score($now_user['uid'],$now_activity['mer_id']);
                if($user_mer_score < $use_score){
                    exit(json_encode(array('status'=>0,'info'=>'您的商家会员卡积分为 '. $user_mer_score.' ，不足以兑换此奖品')));
                }
                $save_result = $database_userinfo->user_score($now_user['uid'],$now_activity['mer_id'],$use_score,'兑换优惠券');
                if($save_result['error_code']){
                    exit(json_encode(array('status'=>0,'info'=>$save_result['error_code'])));
                }
            }
        }

        $save_ok = false;
        if($database_extension_activity_list->where($condition_extension_activity_list)->setInc('part_count',$quantity)){
            list($usec, $sec) = explode(" ", microtime());
            $msec = floor($usec*1000);
            if($msec < 10){
                $msec = '00'.$msec;
            }if($msec < 100){
                $msec = '0'.$msec;
            }
            $data_extension_activity_record['activity_list_id'] = $now_activity['pigcms_id'];
            $data_extension_activity_record['activity_id'] = $now_activity['activity_term'];
            $data_extension_activity_record['time'] = $sec;
            $data_extension_activity_record['msec'] = $msec;
            $data_extension_activity_record['ip'] = get_client_ip(1);
            $data_extension_activity_record['uid'] = $now_user['uid'];
            $data_extension_activity_record['part_count'] = $quantity;
            $record_id = M('Extension_activity_record')->data($data_extension_activity_record)->add();
            $save_ok = true;
        }
        if($save_ok){
            $result = array();
            switch($now_activity['type']){
                case '1':
                    $result = $this->_yiyuanduobao($now_activity,$quantity,$record_id);
                    exit(json_encode(array('status'=>1,'info'=>'参与成功')));
                    break;
                case '2':
                    $result = $this->_coupon($now_activity,$quantity,$record_id);
                    exit(json_encode(array('status'=>1,'info'=>'参与成功')));
                    break;
            }
        }else{
            exit(json_encode(array('status'=>0,'info'=>'系统发生异常，请联系管理员协助解决')));
        }

        $this->error('错误');
    }
}