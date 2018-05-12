<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/8
 * Time: 13:44
 */
class GroupAction extends BaseAction{
    //首页的特卖推荐列表选出10个先
    public function index(){
        $condition_where=" g.index_tui=1 AND ";
        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where.= "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (".$area_idstr.")";
        }else{
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where.= "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
        }
        import('@.ORG.group_page');
        $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
        $count_group = D('')->table($condition_table)->where($condition_where)->count();
        $p = new Page($count_group,15,"p");

        //加入页码最大限制，超过最大值返回空
            $req_page=$_GET['p'];
            $max_page=ceil($count_group/15);
            if($req_page>$max_page){
                $this->returnAjax("没有更多数据了",0);
            }

        $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,(g.sale_count+g.virtual_num) as sale_count,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.index_sort desc")->limit($p->firstRow.','.$p->listRows)->select();
        if($group_list){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
            }
        }
        $return['pagebar'] = $p->show();
        $return['group_list']=$group_list;
        if(!empty($return['group_list'])){
            $this->returnAjax($return['group_list'],1);
        }else{
            $this->returnAjax("未获取到信息",0);
        }
    }
    public function get_group_url($group_id){
            return C('config.site_url').'/mobile.php?g=Mobile&c=Group&a=detail&group_id='.$group_id;
    }
    //精品推荐
    public function recommend(){
        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where= "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`index_tui`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (".$area_idstr.")";
        }else{
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where= "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`index_tui`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
        }
        import('@.ORG.group_page');
        $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');

        $count_group = D('')->table($condition_table)->where($condition_where)->count();

        $maxPage=ceil($count_group/15);

        if($_GET['p']>$maxPage){
            $this->returnAjax("没有更多数据了！",0);
        }
        $p = new Page($count_group,15,"p");
        $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,(g.sale_count+g.virtual_num) as sale_count,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.sale_count desc")->limit($p->firstRow.','.$p->listRows)->select();
        
        if($group_list){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
            }
        }
        $return['pagebar'] = $p->show();
        $return['group_list']=$group_list;
        if(!empty($return['group_list'])){
            $this->returnAjax($return['group_list'],1);
        }else{
            $this->returnAjax("未获取到信息",0);
        }
    }
    //详情
public function detail(){
        if(empty($_GET['group_id'])){
            $this->returnAjax("未获取到特卖id",0);
        }
        $group_id=$_GET['group_id'];
        //重写获取特卖详情的内容
        $long=session('long');
        $lat=session('lat');
        //获取传来的经纬度信息
        if(empty($lat)||empty($long)){
            $this->returnAjax("未获取到经纬度信息！",0);
        }
        $Model=new Model();
        $sql="SELECT g.name as group_name,g.*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) AS distance,ms.* FROM "
            .C('DB_PREFIX')."group g LEFT JOIN (SELECT m.*,s.long,s.lat FROM ".C('DB_PREFIX')."merchant m LEFT JOIN ".C('DB_PREFIX').
            "merchant_store s ON m.mer_id=s.mer_id WHERE s.ismain=1 AND s.status=1) as ms ON g.mer_id=ms.mer_id WHERE g.group_id=".$group_id." AND g.status=1";
        $result=$Model->query($sql);
        if(empty($result)){
            $this->returnAjax("未查到相关特卖信息！",0);
        }
        //解析特卖的农场主信息
        $Merchant_class_image=new Merchant_image();
        $result[0]['person_image']=$Merchant_class_image->get_image_by_path($result[0]['person_image']);
        $result[0]['merchant_theme_image']=$Merchant_class_image->get_image_by_path($result[0]['merchant_theme_image']);
        //团购商品图
        $Group_class_image=new Group_image();
        $result[0]['pic']=$Group_class_image->get_allImage_by_path($result[0]['pic']);
        //判断是否被用户收藏
        $now_group=$result[0];
        $user=session("user");
        $collect=D("User_collect")->where(array("uid"=>$user['uid'],"type"=>"group_detail","id"=>$group_id))->find();
        if(!empty($collect)){
            $now_group['collect']=1;
        }else{
            $now_group['collect']=0;
        }
        $now_group=array_filter($now_group);
        if(!empty($now_group)){
            $this->returnAjax($now_group,1);
        }else{
            $this->returnAjax("为获取到商品详情信息",0);
        }
}
//购物车
 public function shopcart(){
        if(empty($_GET['group_id'])){
            $this->returnAjax("未获取到商品id!",0);
        }
        $now_group = D('Group')->get_group_by_groupId($_GET['group_id']);
        $now_group=array_filter($now_group);
        if(!empty($now_group)){
            $this->returnAjax($now_group,1);
        }else{
            $this->returnAjax("为获取到商品详情信息",0);
        }
}

//购买
public function buy(){
        //判断登录
        if(empty($this->user_session)){
            $this->returnAjax("请先登录！",0);
        }
        //现在的团购
         $now_group = D('Group')->get_group_by_groupId($_GET['group_id']);
        if(empty($now_group)){
            $this->returnAjax("当前特卖不存在！",0);
        }
        
        if($now_group['begin_time'] > $_SERVER['REQUEST_TIME']){
            $this->returnAjax('此单'.$this->config['group_alias_name'].'还未开始！',0);
        }
        if($now_group['type'] > 2){
            $this->returnAjax('此单'.$this->config['group_alias_name'].'已结束！',0);
        }
        //用户等级 优惠
        $level_off=false;
        $finalprice=0;
        if(!empty($this->user_level) && !empty($this->user_session) && isset($this->user_session['level'])){
            $leveloff=!empty($now_group['leveloff']) ? unserialize($now_group['leveloff']) :'';
            /****type:0无优惠 1百分比 2立减*******/
            if(!empty($leveloff) && is_array($leveloff) && isset($this->user_level[$this->user_session['level']]) && isset($leveloff[$this->user_session['level']])){
                $level_off=$leveloff[$this->user_session['level']];
                if($level_off['type']==1){
                  $finalprice=$now_group['price']*($level_off['vv']/100);
                  $finalprice=$finalprice>0 ? $finalprice : 0;
                  $pigcms_assign['total_off_price'] = $pigcms_assign['num']*$finalprice; 
                  $level_off['offstr']='单价按原价'.$level_off['vv'].'%来结算';
                }elseif($level_off['type']==2){
                  $finalprice=$now_group['price']-$level_off['vv'];
                  $finalprice=$finalprice>0 ? $finalprice : 0;
                  $pigcms_assign['total_off_price'] = $pigcms_assign['num']*$finalprice;
                  $level_off['offstr']='单价立减'.$level_off['vv'].'元';
                }
            }
        }
        unset($leveloff);
        if(IS_POST){
            $request=$_POST['send'];
            //截取send
            $reqArr=explode(":",$request);
            $_POST['quantity'] = $reqArr[1];
            $finalprice > 0 && $now_group['price']=round($finalprice,2);
            $result = D('Group_order')->save_post_form($now_group,$this->user_session['uid'],0);
            if($result['error'] == 1){
                $this->returnAjax($result['msg'],0);
            }
            //这里成功之后返回order_id和order_type
            redirect(U('Api/Pay/check',array('order_id'=>$result['order_id'],'type'=>'group')));
        }else{
            $pigcms_get = $this->get_uri_param();

            $this->assign('now_group',$now_group);
            
            if($pigcms_get['q'] < $now_group['once_min']){
                $pigcms_assign['num'] = $now_group['once_min'];
            }else{
                $pigcms_assign['num'] = $pigcms_get['q'];
            }
            $pigcms_assign['total_price'] = $pigcms_assign['num']*$now_group['price'];

            $pigcms_assign['pigcms_phone'] = substr($this->user_session['phone'],0,3).'****'.substr($this->user_session['phone'],7);
            $pigcms_assign['total_off_price'] = $finalprice > 0 ? round(($pigcms_assign['num']*$finalprice),2) : $pigcms_assign['total_price'];
            is_array($level_off) && $level_off['price']=round($finalprice,2);
           
            $pigcms_assign['leveloff']=$leveloff;
            $pigcms_assign['finalprice']=$finalprice;
            if(!empty($pigcms_assign)){
                $this->returnAjax($pigcms_assign,1);
            }else{
                $this->returnAjax("为获取到数据",0);
            }
        }
    }

    //保存订单的地址信息
    public function saveOrderAddress(){
        $address_id=$_POST['address_id'];
        $order_id=$_POST['order_id'];
        if(empty($address_id)||empty($order_id)){
            $this->returnAjax("未获取到相关信息！",0);
        }
        //先查询一下看是否已经存在
        $exit=D("Group_order")->where("order_id=".$order_id)->find();
        if(!empty($exit['adress'])){
            $this->returnAjax("已经存在地址了！",0);
        }

        $address = D('User_adress')->get_one_adress($this->user_session['uid'],$address_id);
        $data=array(
            "zipcode"=>$address['zipcode'],
            "contact_name"=>$address['name'],
            "adress"=>$address['province_txt']." ".$address['city_txt']." ".$address['area_txt']." ".$address['adress'],
            );

        $result=D("Group_order")->where("order_id=".$order_id)->setField($data);
        if($result){
            $this->returnAjax("保存地址成功！",1);
        }else{
            $this->returnAjax("保存地址失败！",0);
        }
    }

}