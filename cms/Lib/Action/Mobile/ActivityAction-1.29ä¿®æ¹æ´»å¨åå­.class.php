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
            "merchant_store s ON m.mer_id=s.mer_id WHERE s.ismain=1 AND s.status=1) as ms ON activity.mer_id=ms.mer_id WHERE activity.status=1";
        $result=$Model->query($sql);
        if(empty($result)){
            $this->error("未获取到活动信息或者该活动已经关闭或到期！");
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

    private function _coupon($now_activity,$quantity,$record_id){
        $database_extension_coupon_record = D('Extension_coupon_record');
        $data_all_extension_coupon_record = array();
        $data_extension_coupon_record['record_id'] = $record_id;
        $data_extension_coupon_record['activity_id'] = $now_activity['pigcms_id'];
        for($i=0;$i<$quantity;$i++){
            $coupon_pass_array = array(
                date('y',$_SERVER['REQUEST_TIME']),
                date('m',$_SERVER['REQUEST_TIME']),
                date('d',$_SERVER['REQUEST_TIME']),
                date('H',$_SERVER['REQUEST_TIME']),
                date('i',$_SERVER['REQUEST_TIME']),
                date('s',$_SERVER['REQUEST_TIME']),
                mt_rand(10,99),
                mt_rand(10,99),
            );
            shuffle($coupon_pass_array);
            $data_extension_coupon_record['number'] = implode('',$coupon_pass_array);
            array_push($data_all_extension_coupon_record,$data_extension_coupon_record);
        }
        $database_extension_coupon_record->addAll($data_all_extension_coupon_record);
        
        if($now_activity['all_count'] - $now_activity['part_count'] > $quantity){
            return false;
        }
        //修改结束信息
        D('Extension_activity_list')->where(array('pigcms_id'=>$now_activity['pigcms_id']))->data(array('is_finish'=>'1','finish_time'=>$_SERVER['REQUEST_TIME']))->save();
    }
    private function _yiyuanduobao($now_activity,$quantity,$record_id){
        //此处有三种方法，采用最简单的一种。
        //第一种 按上一次的号码累加
        //第二种 将号码输入号码池里，然后从号码池里取用户购买的数量出来
        //第三种 采用与彩票联合的方式，需要后台计划任务计算开奖时间
        $database_extension_yiyuanduobao_record = D('Extension_yiyuanduobao_record');
        $last_number = $database_extension_yiyuanduobao_record->where(array('activity_id'=>$now_activity['pigcms_id']))->order('`pigcms_id` DESC')->limit(1)->getField('number');

        if(empty($last_number)){
            $last_number = 1;
        }else{
            $last_number++;
        }
        $data_all_extension_yiyuanduobao_record = array();
        $data_extension_yiyuanduobao_record['record_id'] = $record_id;
        $data_extension_yiyuanduobao_record['activity_id'] = $now_activity['pigcms_id'];
        for($i=0;$i<$quantity;$i++){
            $data_extension_yiyuanduobao_record['number'] = $last_number+$i;
            array_push($data_all_extension_yiyuanduobao_record,$data_extension_yiyuanduobao_record);
        }
        $database_extension_yiyuanduobao_record->addAll($data_all_extension_yiyuanduobao_record);
        
        //抽奖
        //取50条最新购买记录进行判断抽奖
        if($now_activity['all_count'] - $now_activity['part_count'] > $quantity){
            return false;
        }
        $database_extension_activity_record = D('Extension_activity_record');
        $condition_extension_activity_record['activity_list_id'] = $now_activity['pigcms_id'];
        $activity_record_list = $database_extension_activity_record->field('`time`,`msec`')->where($condition_extension_activity_record)->order('`pigcms_id` DESC')->limit(50)->select();
        $allCount = 0;
        foreach($activity_record_list as $value){
            $tmp_time = date('His',$value['time']).$value['msec'];
            $allCount+=$tmp_time;
        }
        $lottery_number = fmod($allCount,$now_activity['all_count']);
        //找到数字对应的行
        $now_yiyuan_record = D('Extension_yiyuanduobao_record')->field('`record_id`')->where(array('activity_id'=>$now_activity['pigcms_id'],'number'=>$lottery_number))->find();
        
        //找到数字对应的购买列
        $now_activity_record = $database_extension_activity_record->field('`pigcms_id`,`uid`,`activity_list_id`')->where(array('pigcms_id'=>$now_yiyuan_record['record_id']))->find();
        
        //修改中奖信息
        $database_extension_activity_list = D('Extension_activity_list');
        $database_extension_activity_list->where(array('pigcms_id'=>$now_activity_record['activity_list_id']))->data(array('lottery_id'=>$now_activity_record['pigcms_id'],'lottery_uid'=>$now_activity_record['uid'],'lottery_number'=>$lottery_number,'is_finish'=>'1','finish_time'=>$_SERVER['REQUEST_TIME']))->save();
        $lottery_user = D('User')->field('`openid`,`phone`,`nickname`')->where(array('uid'=>$now_activity_record['uid']))->find();
        
        //模板消息通知、短信通知       
        if ($lottery_user['openid']) {
            $href = $this->config['site_url'].'/wap.php';
            $model = new templateNews($this->config['wechat_appid'],$this->config['wechat_appsecret']);
            $model->sendTempMsg('TM00785', array('href' => $href, 'wecha_id' => $lottery_user['openid'], 'first' => '恭喜您，您中奖了', 'program' => '一元夺宝【'.$now_activity['name'].'】', 'result' => '开奖号码:'.$lottery_number, 'remark' => '请及时上线联系商家进行兑奖！'));
        }
        
        //得到商家信息
        $now_merchant = D('Merchant')->field('`mer_id`,`phone`')->where(array('mer_id'=>$now_activity['mer_id']))->find();
        
        $sms_data = array('mer_id' =>$now_merchant['mer_id'], 'store_id' => 0, 'type' => 'activity');
        $sms_data['uid'] = $lottery_user['uid'];
        $sms_data['mobile'] = $lottery_user['phone'];
        $sms_data['sendto'] = 'user';
        $sms_data['content'] = '您参与的一元夺宝['.$now_activity['name'].']中奖了，幸运号码为：'.$lottery_number.' ，请及时上线联系商家进行兑奖！';
        Sms::sendSms($sms_data);
        
        
        $sms_data['uid'] = $lottery_user['uid'];
        $sms_data['mobile'] = $now_merchant['phone'];
        $sms_data['sendto'] = 'merchant';
        $sms_data['content'] = '您发布的一元夺宝['.$now_activity['name'].']于 '.date('m-d H时',$_SERVER['REQUEST_TIME']).' 出售成功，中奖用户手机号码为：'.$lottery_user['phone'].'，请及时联系用户领取！';
        Sms::sendSms($sms_data);
    }
}