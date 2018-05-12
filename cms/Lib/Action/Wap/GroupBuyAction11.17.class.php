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
    {
        $this->assign(D("Group")->new_wap_get_group_buy_list_by_catid(6));
        $this->assign("new_group_lists",D("Group")->new_wap_get_group_buy_list_by_catid(20)['group_list']);
            if(session('user')['uid']==753){
         //   exit(json_encode(D("Group")->new_wap_get_group_buy_list_by_catid(20)['group_list']));
        }
	   $this->display();
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
        //查询出以及经参加该拼团的用户
        $where=array(
            "sun_id"=>$sun_id,
            "paid"=>1,
            "status"=>array(
              "lt",3
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
        $this->display();
    }

    //拼团列表
    public function lists(){
    	$this->assign("new_group_lists",D("Group")->new_wap_get_group_buy_list_by_catid(20)['group_list']);
        //$this->assign(D("GroupBuy")->getLists(""));
        $this->display();
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

}