<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/9/25
 * Time: 15:36
 */
class NewGroupAction extends BaseAction {




    public function buy(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！',U('Login/index'));
        }
        if($_GET['group_id']=="3410"){
            $this->error_tips('当前人数过多，请稍候再试！');
        }

    $groupcount=D("Group_order")->where(array("uid"=>$this->user_session['uid'],"paid"=>1,"group_id"=>$_GET["group_id"]))->count();
        $now_user = D('User')->get_user($this->user_session['uid']);
        if(empty($this->user_session['phone']) && !empty($now_user['phone'])){
            $_SESSION['user']['phone'] = $this->user_session['phone'] = $now_user['phone'];
        }
        $this->assign('now_user',$now_user);

        $now_group = D('Group')->get_group_by_groupId($_GET['group_id']);
        if($now_group["once_max"]>0){
            if($groupcount>=$now_group["once_max"]){
                $this->error_tips('超过最大购买限额！');
            }
        }
//        $groupcount2=D("Group_order")->where(array("paid"=>1,"group_id"=>$_GET["group_id"]))->count();
//        if($now_group["count_num"]>0){
//            if($groupcount2>=$now_group['sale_count']){
//                $this->error_tips('该商品正在备货！');
//            }
//        }
        if(empty($now_group)){
            $this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
        }

        if($now_group['begin_time'] > $_SERVER['REQUEST_TIME']){
            $this->error_tips('此单'.$this->config['group_alias_name'].'还未开始！');
        }
        if($now_group['type'] > 2){
            $this->error_tips('此单'.$this->config['group_alias_name'].'已结束！');
        }

        //用户等级 优惠
        $level_off=false;
         if($now_group['is_first_free']&&empty($_GET['sun_id'])){
		
            $finalprice=round($now_group['first_free_fee'],2);
		
        }else{
		
            if(!empty($this->user_level) && !empty($this->user_session) && isset($this->user_session['level'])){
                if(session("user")['uid']==753){
                    exit(json_encode($this->user_session));
                }
                $leveloff=!empty($now_group['leveloff']) ? unserialize($now_group['leveloff']) :'';
                /****type:0无优惠 1百分比 2立减*******/
                if(!empty($leveloff) && isset($leveloff[$this->user_session['level']]) && isset($this->user_level[$this->user_session['level']])){
                    $level_off=$leveloff[$this->user_session['level']];
                    if($level_off['type']==1){
                        $finalprice=$now_group['price']*($level_off['vv']/100);
                        $finalprice=$finalprice>0 ? $finalprice : 0;
                        $level_off['offstr']='单价按原价'.$level_off['vv'].'%来结算';

                    }elseif($level_off['type']==2){
                        $finalprice=$now_group['price']-$level_off['vv'];
                        $finalprice=$finalprice>0 ? $finalprice : 0;
                        $level_off['offstr']='单价立减'.$level_off['vv'].'元';

                    }
                }
            }
            is_array($level_off) && $level_off['price']=round($finalprice,2);

        }
        unset($leveloff);

        if(IS_POST){
            //存在拼团的sun_id则查询确认可用并记录
            if(isset($_GET['sun_id'])){
            $sun_id=strval($_GET['sun_id']);
            $where['sun_id']=$sun_id;
            $group_buy=D("GroupBuy")->where($where)->find();
            if(empty($group_buy)){
                $this->error("拼团id有错误，请重试！");die;
            }
            }
            $finalprice > 0 && $now_group['price']=round($finalprice,2);
            $result = D('Group_order')->save_post_form($now_group,$this->user_session['uid'],0);
            if($result['error'] == 1){
                $this->error_tips($result['msg']);
            }
            //如果订单保存成功然后保存粉丝
            if(!empty($_SESSION['openid'])){
                D("Merchant")->saveRelation($_SESSION['openid'],$now_group['mer_id'],false);
            }
            if(!empty($sun_id)){
            redirect(U('NewPay/check',array('order_id'=>$result['order_id'],'type'=>'group','sun_id'=>$sun_id)));
            }else{
            redirect(U('NewPay/check',array('order_id'=>$result['order_id'],'type'=>'group')));
            }
        }else{
            if($now_group['tuan_type'] == 2){
                if(!empty($_GET["sun_id"])){
                    $where['sun_id']=$_GET["sun_id"];
                    $group_buy=M("GroupBuy")->where($where)->find();
                    if(!empty($group_buy)) {
                        //查询是否已经参加过该拼团
                        $where['uid']=session("user")['uid'];
                        $where['sun_id']=strval($_GET["sun_id"]);
                        $where['paid']=1;
                        $where['status']=array("lt",3);
                        if(D("GroupOrder")->where($where)->find()){
                            $this->error("您已经参加过该拼团了，每人只能参加一次！");die;
                        }
                         $now_group['user_adress'] = D('User_adress')->get_one_adress($this->user_session['uid'], intval($_GET['adress_id']));
                    }else{
                    	 $where['sun_id']=strval($_GET["sun_id"]);
                        if(M("GroupBuy")->where($where)->find()){
                            $now_group['user_adress'] = D('User_adress')->get_one_adress($this->user_session['uid'], intval($_GET['adress_id']));
                        }else{
                            $this->error("拼团id有错误，请重试！");die;
                        }   
                    }
                }else {
                    $now_group['user_adress'] = D('User_adress')->get_one_adress($this->user_session['uid'], intval($_GET['adress_id']));
                }
            }
            $now_group['wx_cheap'] = floatval($now_group['wx_cheap']);

            $this->assign('leveloff',$level_off);
            $this->assign('finalprice',$finalprice);
            $this->assign('now_group',$now_group);
			if($now_group['is_first_free']&&empty($_GET['sun_id'])){
				 $this->assign('is_tuanzhang',1);
			}
            if($this->user_session['phone']){
                $this->assign('pigcms_phone',substr($this->user_session['phone'],0,3).'****'.substr($this->user_session['phone'],7));
            }else{
                $this->assign('pigcms_phone','您需要绑定手机号码');
            }
            /* 粉丝行为分析 */
            D('Merchant_request')->add_request($now_group['mer_id'],array('group_hits'=>1));

            /* 粉丝行为分析 */
            $this->behavior(array('mer_id'=>$now_group['mer_id'],'biz_id'=>$now_group['group_id']));

            $this->display("NewGroup/buy");
        }
    }


    public function detail(){
        $now_group = D('Group')->get_group_by_groupId($_GET['group_id'],'hits-setInc');
		if(session("user")['uid']==753){
		//	echo json_encode( $now_group);
		//	die;
		}
        if(empty($now_group)||!$now_group['is_group_buy']){
            $this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
        }
        if($now_group['cue']){
            $now_group['cue_arr'] = unserialize($now_group['cue']);
        }
        if(!empty($now_group['pic_info'])){
            $merchant_image_class = new merchant_image();
            $now_group['merchant_pic'] = $merchant_image_class->get_allImage_by_path($now_group['pic_info']);
        }
        //判断是否微信浏览器，
        $long_lat = D('User_long_lat')->getLocation($_SESSION['openid']);
        if($long_lat){
            $rangeSort = array();
            foreach($now_group['store_list'] as &$storeValue){
                $storeValue['Srange'] = getDistance($long_lat['lat'],$long_lat['long'],$storeValue['lat'],$storeValue['long']);
                $storeValue['range'] = getRange($storeValue['Srange'],false);
                $rangeSort[] = $storeValue['Srange'];
            }
            array_multisort($rangeSort, SORT_ASC, $now_group['store_list']);
            $this->assign('long_lat',$long_lat);
        }

        if(!empty($this->user_session)){
            $database_user_collect = D('User_collect');
            $condition_user_collect['type'] = 'group_detail';
            $condition_user_collect['id'] = $now_group['group_id'];
            $condition_user_collect['uid'] = $this->user_session['uid'];
            if($database_user_collect->where($condition_user_collect)->find()){
                $now_group['is_collect'] = true;
            }
            if(!empty($_SESSION['openid'])&&!empty($now_group['mer_id'])){
                D("Merchant")->saveRelation($_SESSION['openid'],$now_group['mer_id'],false);
            }
        }
        $this->assign('now_group',$now_group);

        if($now_group['reply_count']){
            $reply_list = D('Reply')->get_reply_list($now_group['group_id'],0,count($now_group['store_list']),3);
            foreach($reply_list as $key=>$value){
                if($value['anonymous']){
                    $reply_list[$key]['nickname']="匿名用户";
                }
            }
            $this->assign('reply_list',$reply_list);
        }
        //商家的其他拼团
        $merchant_group_list = D('Group')->get_groupbuylist_by_MerchantId($now_group['mer_id'],3,true,$now_group['group_id']);
        $this->assign('merchant_group_list',$merchant_group_list);

        //分类下其他拼团
        $category_group_list = D('Group')->get_groupbuylist_by_catId($now_group['cat_id'],$now_group['cat_fid'],3,true);
		
        foreach($category_group_list as $key=>$value){
            if($value['group_id'] == $now_group['group_id']){
                unset($category_group_list[$key]);
            }
        }
			
	
		
        $this->assign('category_group_list',$category_group_list);



        /* 粉丝行为分析 */
        D('Merchant_request')->add_request($now_group['mer_id'],array('group_hits'=>1));

        /* 粉丝行为分析 */
        $this->behavior(array('mer_id'=>$now_group['mer_id'],'biz_id'=>$now_group['group_id'],'keyword'=>strval($_GET['keywords'])));


        if ($services = D('Customer_service')->where(array('mer_id' => $now_group['mer_id']))->select()) {
            $key = $this->get_encrypt_key(array('app_id'=>$this->config['im_appid'],'openid' => $_SESSION['openid']), $this->config['im_appkey']);
            $kf_url = 'http://im-link.winworlds.cn/?app_id=' . $this->config['im_appid'] . '&openid=' . $_SESSION['openid'] . '&key=' . $key . '#serviceList_' . $now_group['mer_id'];
            $this->assign('kf_url', $kf_url);
        }

        //获取最新的两个拼团
        $group_list = D("GroupBuy")->getListsByGroupId(intval($_GET['group_id']),8);
        $category_groupbuy_list=$group_list['group_buy_list'];
	       if(!empty($category_groupbuy_list)){
            foreach ($category_groupbuy_list as $key=>$value){
                $numarray[$key]=$value['react_num'];
            }
            $max=max($numarray);
            if(is_array($max)){
                $keynum=array_search($max,$numarray);

            }else{
                $keynum=array_search($max,$numarray);
            }
         $this->assign("maxnum",$category_groupbuy_list[$keynum]);
            if(session("user")['uid']==753){
           // echo  json_encode($keynum);die;
			  //  echo  $max;die;
            }
        }
		
        $this->assign('category_groupbuy_list',$category_groupbuy_list);
           $this->assign("username",session('user')['nickname']);
        $this->display();
    }
}