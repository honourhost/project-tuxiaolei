<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/10/1
 * Time: 17:20
 */
class GroupBuyAction extends BaseAction
{
    public function index()
    {    $token=$_GET["token"];
        if(empty($token)){
            $this->assign(D("Group")->new_wap_get_group_buy_lottery_list_by_catid(6));
            $this->assign("new_group_lists",D("Group")->new_wap_get_group_buy_list_by_catid(20)['group_list']);
            if(session('user')['uid']==753){
                //   exit(json_encode(D("Group")->new_wap_get_group_buy_list_by_catid(20)['group_list']));
            }
            $condationmain=array(
                "cat_id"=>15,
                "status"=>1
            );
            $condationmainbig=array(
                "cat_id"=>16,
                "status"=>1
            );
            $pin_main=M("App_slider")->where($condationmain)->limit(2)->select();
            $pin_mainbig=M("App_slider")->where($condationmainbig)->find();
            $this->assign("pin_main",$pin_main);
            $this->assign("pin_mainbig",$pin_mainbig);

            $this->display();
        }else{

            $this->assign(D("Group")->new_wap_get_group_buy_lottery_list_by_merid(6,$_GET['token']));
            $this->assign("new_group_lists",D("Group")->new_wap_get_group_buy_list_by_merid(20,$_GET['token'])['group_list']);
            if(session('user')['uid']==753){
                //   exit(json_encode(D("Group")->new_wap_get_group_buy_list_by_catid(20)['group_list']));
            }
            $condationmain=array(
                "cat_id"=>15,
                "status"=>1
            );
            $condationmainbig=array(
                "cat_id"=>16,
                "status"=>1
            );
            $pin_main=M("App_slider")->where($condationmain)->limit(2)->select();
            $pin_mainbig=M("App_slider")->where($condationmainbig)->find();
            $this->assign("pin_main",$pin_main);
            $this->assign("pin_mainbig",$pin_mainbig);
            $this->assign("token",$token);

            $this->display("jixianfeng");
        }

    }

     public function show($sun_id){
        //选出一个最新的产品
        $this->assign("newest_groupbuy",D("Group")->new_wap_get_group_buy_list_by_catid(1)['group_list']);
        //拼团详情
        $group_buy=D('GroupBuy')->where('sun_id="'.$sun_id.'"')->find();
        if(empty($group_buy)){
            $this->error("当前拼团不存在",U('GroupBuy/index'));die;
        }
        // if($group_buy['status']!=0){
        //     $this->error("该拼团已经完成或者结束！");die;
        // }
        //团长信息
        $first=D("User")->field("nickname,avatar")->find($group_buy['user_id']);
        
        if (strstr($first['avatar'], ",")) {
            $avatar_image_class = new avatar_image();
            $image = $avatar_image_class->get_image_by_path($first['avatar'], C('config.site_url'));
            $first['avatar'] = $image['s_image'];
        }
        $this->assign("first",$first);
        //拼团商品详情
        $now_group = D('Group')->get_group_by_groupId($group_buy['group_id'],'hits-setInc');
		
			if($now_group['is_lottery_group_buy']){
				 
			  $lotteryorder=D('Group_order')->where(array("is_lottery_order"=>1,"sun_id"=>$sun_id))->find();
		
         $uid=$lotteryorder['uid'];
         $lottery=D('user')->field("nickname,avatar,uid")->where(array('uid'=>$uid))->find();
         if (strstr($lottery['avatar'], ",")) {
             $lavatar_image_class = new avatar_image();
             $limage = $lavatar_image_class->get_image_by_path($first['avatar'], C('config.site_url'));
             $lottery['avatar'] = $limage['s_image'];
         }
		// exit(json_encode($lottery));
         $this->assign("lottery",$lottery);
		  $this->assign("islotteryorder",1);
		}
        //查询出以及经参加该拼团的用户
        $where=array(
            "sun_id"=>$sun_id,
            "paid"=>1,
            "status"=>array(
              "elt",3
            ),
        );
        $users=D("GroupOrder")->field("uid,add_time")->where($where)->order("add_time ASC")->select();
        //分类下其他拼团
        $group_list = D("GroupBuy")->getNewLists(4);
		//	if(session('user')['uid']==753){
		//		echo json_encode($group_list);
			
		//}
        $category_group_list=$group_list['group_buy_list'];
        foreach($category_group_list as $key=>$value){
            if($value['group_id'] == $now_group['group_id']){
                unset($category_group_list[$key]);
            }
        }
		
        $this->assign('category_group_list',$category_group_list);
        $this->assign("users",$users);
        $this->assign("group_buy",$group_buy);
        $this->assign("now_group",$now_group);
        //计算倒计时
        $lefttime=24*60*60-(time()-$group_buy['create_time']);
        if($lefttime<=0){
            $lefttime=0;
        }
        $this->assign("username",session('user')['nickname']);
        $this->assign("lefttime",$lefttime);
		 $useruids=D("GroupOrder")->field("uid")->where($where)->order("add_time ASC")->select();
	
		   //  if(session("user")['uid']==753){
            if(in_array(array("uid"=>session('user')['uid']) ,$useruids)){
                $this->assign("participated",1);
                $this->assign("nowuserid",session('user')['uid']);
            }
       // }
        $this->display();
    }

    //拼团列表
    public function lists(){
    	$this->assign("new_group_lists",D("Group")->new_wap_get_group_buy_list_by_catid(20)['group_list']);
        //$this->assign(D("GroupBuy")->getLists(""));
        $this->display();
    }
	
	    public function listlottery(){
            $token=$_GET["token"];
            if(empty($token)){
                $this->assign("new_group_lists",D("Group")->new_wap_get_group_buy_lottery_list_by_catid(20)['group_list']);
                //$this->assign(D("GroupBuy")->getLists(""));
                $this->display();
            }else{
                $this->assign("new_group_lists",D("Group")->new_wap_get_group_buy_lottery_list_by_merid(20,$token)['group_list']);
                //$this->assign(D("GroupBuy")->getLists(""));
                $this->assign("token",$token);
                $this->display("jxflistlottery");
            }

    }
	    public function listfirstfree(){
            $token=$_GET["token"];
            if(empty($token)){
                $this->assign("new_group_lists",D("Group")->new_wap_get_group_buy_firstfree_by_catid(20)['group_list']);
                //$this->assign(D("GroupBuy")->getLists(""));
                $this->display();
            }else{
                $this->assign("new_group_lists",D("Group")->new_wap_get_group_buy_firstfree_by_merid(20,$token)['group_list']);
                //$this->assign(D("GroupBuy")->getLists(""));
                $this->assign("token",$token);
                $this->display("jxffirstfree");
            }

    }

    //more
    public function more(){
        $this->display();
    }

    //jieshao
    public function introduction(){
        $this->display();
    }

    //miandan
    public function miandan(){
        $this->display();
    }
	    public function qrpng(){
        $shareid=$_GET["shareid"];
        $groupid=$_GET["groupid"];

        import('@.ORG.phpqrcode');
        QRcode::png('http://www.xiaonongding.com/wap.php?g=Wap&c=NewGroup&a=detail&group_id='.$groupid.'&share_distribution_id='.$shareid);

    }
	
	  public function qrpng2(){
        $sunid=$_GET["sunid"];
       

        import('@.ORG.phpqrcode');
        QRcode::png('http://www.xiaonongding.com/wap.php?g=Wap&c=GroupBuy&a=show&sun_id='.$sunid);

    }

}