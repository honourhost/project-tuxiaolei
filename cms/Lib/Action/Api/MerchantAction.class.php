<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/8
 * Time: 13:21
 */
class MerchantAction extends BaseAction{

    //首页顶上轮播的农场
    public function indexBanner(){
        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $condition_where= " AND `area_id` in (".$area_idstr.")";
        }
        //首先查出3个首页推荐的农场(没有农场主题图的先不选)
        if(!empty($condition_where)) {
            $threeTuiMerchant = D("Merchant")->field("mer_id,merchant_theme_image,name")->limit(3)->where("`status`='1' AND merchant_theme_image <> ''" . $condition_where)->order("share_open desc,reg_time desc")->select();
        }else{
            $threeTuiMerchant = D("Merchant")->field("mer_id,merchant_theme_image,name")->limit(3)->where("`status`='1' AND merchant_theme_image <> ''")->order("share_open desc,reg_time desc")->select();
        }
            //转换图片，只转换主题图
        $Merchant_image_class=new Merchant_image();
        foreach($threeTuiMerchant as $k=>$val){
            $pic=$Merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            $threeTuiMerchant[$k]['merchant_theme_image']=$pic;
            $threeTuiMerchant[$k]['url']=$this->getMerchantUrl($val['mer_id']);
        }
        $result=$threeTuiMerchant;
        if(!empty($result)){
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("获取信息失败",0);
        }
    }
    //首页三个最新的农场信息
    public function indexNewest(){
        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $condition_where= "  AND `area_id` in (".$area_idstr.")";
        }
        //首先查出3个首页最新的农场(没有农场主题图的先不选)
        if(!empty($condition_where)) {
            $threeNewMerchant = D("Merchant")->field("mer_id,merchant_theme_image,name")->limit(3)->where("`status`='1' AND merchant_theme_image <> ''" . $condition_where)->order("reg_time desc")->select();
        }else{
            $threeNewMerchant = D("Merchant")->field("mer_id,merchant_theme_image,name")->limit(3)->where("`status`='1' AND merchant_theme_image <> ''")->order("reg_time desc")->select();
        }
        $Merchant_image_class=new Merchant_image();
        foreach($threeNewMerchant as $k=>$val){
            $pic=$Merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            $threeNewMerchant[$k]['merchant_theme_image']=$pic;
            $threeNewMerchant[$k]['url']=$this->getMerchantUrl($val['mer_id']);
        }
        $result=$threeNewMerchant;
        if(!empty($result)){
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("获取信息失败",0);
        }
    }
    //农场推荐页
    public function index(){
        $lat=$_GET['lat'];
        $long=$_GET['long'];
        if(empty($lat)||empty($long)){
            $this->returnAjax("未获取到经纬度信息",0);
        }
        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $condition_where= "m.`status`='1' AND m.merchant_theme_image <> '' AND m.`share_open`='1' AND m.`area_id` in (".$area_idstr.")";
        }else{
            $condition_where= "m.`status`='1' AND m.merchant_theme_image <> '' AND m.`share_open`='1'";
        }
        $condition_field="m.mer_id,m.name,m.phone,m.person_name,m.person_image,m.person_info,m.fans_count,m.merchant_theme_image,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) AS distance";
        $order="reg_time desc";
        import('@.ORG.group_page');
        $count_group = D('Merchant')->alias("m")->where($condition_where)->count();
        //加入页码最大限制，超过最大值返回空
            $req_page=$_GET['p'];
            $max_page=ceil($count_group/15);
            if($req_page>$max_page){
                $this->returnAjax("没有更多数据了",0);
            }

        $p = new Page($count_group,15,'p');
        //加入主店判断
        $condition_where=$condition_where." AND ms.ismain=1";

        $farm_list =  D('Merchant')->alias("m")->field($condition_field)->join(C("DB_PREFIX")."merchant_store ms ON m.mer_id=ms.mer_id")->where($condition_where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();

        $return['pagebar'] = $p->show();

        if($farm_list){
            $merchant_image_class = new merchant_image();
            foreach ($farm_list as $key => $val) {
                if (!empty($val['person_image'])) {
                    $farm_list[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
                }
                if (!empty($val['merchant_theme_image'])) {
                    $farm_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
                }
                //判断是否已被收藏
                if($this->ifCollect($val['mer_id'])){
                    $farm_list[$key]['collect']=1;
                }else{
                    $farm_list[$key]['collect']=0;
                }
                $farm_list[$key]['url']=$this->getMerchantUrl($val['mer_id']);
            }
        }
        if(!empty($farm_list)){
            $this->returnAjax($farm_list,1);
        }else{
            $this->returnAjax("获取信息失败",0);
        }
    }
    //是否被收藏
    private function ifCollect($id){
        $uid=$this->user_session['uid'];
        if(!empty($uid)){
            $condition=array(
                "id"=>$id,
                "type"=>"merchant_id",
                "uid"=>$uid
                );
            $res=D("User_collect")->where($condition)->find();
            if(!empty($res)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    //获取农场url
    // private function getMerchantUrl($mer_id){
    //     return C('config.site_url').'/mobile.php?g=Mobile&c=Merchant&a=detail&mer_id='.$mer_id;
    // }

    public function detail(){
        //根据获取的mer_id查到对应的农场距离差以及详细信息
        $mer_id=$_GET['mer_id'];
        if(empty($mer_id)){
            $this->returnAjax("没有获取到id值",0);
        }
        $long=session('long');
        $lat=session('lat');
        if(empty($lat)||empty($long)){
            $this->returnAjax("没有获取到经纬度信息！",0);
        }
        $result=D("Merchant")->alias("m")->field("m.*,s.*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) as distance")->join(C('DB_PREFIX')."merchant_store s ON m.mer_id=s.mer_id")->where("m.mer_id=".$mer_id." AND s.ismain=1")->find();
        $merchant_class_image=new Merchant_image();
        $result['merchant_theme_image']=$merchant_class_image->get_image_by_path($result['merchant_theme_image']);
        $result['person_image']=$merchant_class_image->get_image_by_path($result['person_image']);
        //选出对应的店铺下的特卖商品
        $group_list=D("Group")->where(array("mer_id"=>$result['mer_id'],"status"=>1))->limit(6)->order("sort desc,group_id desc")->select();
        if(!empty($group_list)){
        $group_image_class = new group_image();
        foreach($group_list as $k=>$val){
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
            }
        }
        }
        //搜索查看用户是否收藏
        $user=session("user");
        $collect=D("User_collect")->where(array("uid"=>$user['uid'],"type"=>"merchant_id","id"=>$mer_id))->find();
        if(!empty($collect)){
            $result['collect']=1;
        }else{
            $result['collect']=0;
        }
        $data['group_list']=$group_list;
        $data['farm']=$result;
        $this->returnAjax($data,1);
    }

    public function addMerchantCollect(){
        $id=$_POST['id'];
        $type="merchant_id";
        $user=session("user");
        if(empty($user)){
            $this->returnAjax("请先登录！",0);
        }
        $uid=$user['uid'];
        $result=D("User_collect")->addCollect($type,$id,$uid);
        if($result){
            $this->returnAjax("操作成功！",1);
        }else{
            $this->returnAjax("操作失败！",0);
        }
    }



    //展示农场特卖数据
    public function getGroups(){
        $mer_id=$_GET['mer_id'];
        if(empty($mer_id)){
            $this->returnAjax("未获取到农场id!",0);
        }
        $order=$_GET['order'];
        switch($order){
            case 'price-asc':
                $order = '`g`.`price` ASC,`g`.`group_id` DESC';
                break;
            case 'price-desc':
                $order = '`g`.`price` DESC,`g`.`group_id` DESC';
                break;
            case 'hot':
                $order = 'all_count DESC,`g`.`group_id` DESC';
                break;
            default:
                $order = '`g`.`sort` DESC,`g`.`group_id` DESC';
        }
        $now_time = $_SERVER['REQUEST_TIME'];
        $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`mer_id`='$mer_id'";
        $count=D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where($condition_where)->count();

        import('@.ORG.group_page');

        $p = new Page($count,10,'p');

        $group_list = D('')->field('`g`.`name` AS `group_name`,(`g`.`sale_count`+`g`.`virtual_num`) AS all_count,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where($condition_where)->order($order)->limit($p->firstRow,$p->listRows)->select();
        //print_r(D()->getLastSql());
        if($group_list){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
                $group_list[$k]['price'] = floatval($v['price']);
                $group_list[$k]['old_price'] = floatval($v['old_price']);
                $group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
            }
        }
        $this->returnAjax($group_list,1);
    }
    //展示农场对应的平台活动
    public function getActivityList(){
        // $mer_id=$_GET['mer_id'];
        // if(empty($mer_id)){
        //     $this->returnAjax("未获取到农场id!",0);
        // }
        // //距离获取
        // $lat=session("lat");
        // $long=session("long");
        // $result=D("Merchant_store")->alias("s")->field("ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS distance")->where(array("mer_id"=>$mer_id,"is_main"=>1,"status"=>1))->find();
        // $this->assign("distance",$result['distance']);
        // //获取农场发布的平台活动
        // $order=$_GET['order'];
        // $result=D("Extension_activity_list")->getActivityListByMerchantOrder($mer_id,$order);
        // $this->assign("list",$result);
        // //选出几个最新推送活动
        // if($_SESSION['areaarr']!="all"){
        //     $area_str=implode(',',$_SESSION['areaarr']);
        //     $condition_where="`eal`.`mer_id` <> $mer_id AND `eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `m`.`area_id` IN (".$area_str.")";
        // }else{
        //     $condition_where="`eal`.`mer_id` <> $mer_id AND `eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id";
        // }
        // $field_condition="`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.pic,`eal`.part_count,`eal`.price,`eal`.mer_id,`eal`.money,`eal`.pigcms_id,term.begin_time,term.end_time";
        // $table_condition=array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'extension_activity'=>'term');
        // $tuiactivity = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->order('`eal`.`last_time` DESC')->limit(3)->select();
        //  if(!empty($tuiactivity)){
        //     foreach($tuiactivity as $k=>$val) {
        //         $tuiactivity[$k]['url'] = $this->config['site_url'].'/mobile.php?g=Mobile&c=Activity&a=detail&activity_id='.$val['pigcms_id'];
        //     }
        // }
         $mer_id=$_GET['mer_id'];
        if(empty($mer_id)){
            $this->returnAjax("未获取到农场id",0);
        }
        //距离获取
        $lat=session("lat");
        $long=session("long");
        $result=D("Merchant_store")->alias("s")->field("ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS distance")->where(array("mer_id"=>$mer_id,"is_main"=>1,"status"=>1))->find();
        $this->assign("distance",$result['distance']);
        //获取农场发布的平台活动
        $order=$_GET['order'];
        $result=D("Extension_activity_list")->getActivityListByMerchantOrder($mer_id,$order);
        $this->assign("list",$result);
        //选出几个最新推送活动
        if($_SESSION['areaarr']!="all"){
            $area_str=implode(',',$_SESSION['areaarr']);
            $condition_where="`eal`.`mer_id` <> $mer_id AND `eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `m`.`area_id` IN (".$area_str.")";
        }else{
            $condition_where="`eal`.`mer_id` <> $mer_id AND `eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id";
        }
        $field_condition="`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.pic,`eal`.part_count,`eal`.price,`eal`.mer_id,`eal`.money,`eal`.pigcms_id,term.begin_time,term.end_time";
        $table_condition=array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'extension_activity'=>'term');
        $tuiactivity = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->order('`eal`.`last_time` DESC')->limit(3)->select();
         if(!empty($tuiactivity)){
            foreach($tuiactivity as $k=>$val) {
                $tuiactivity[$k]['url'] = $this->config['site_url'].'/api.php?g=Api&c=Activity&a=detail&activity_id='.$val['pigcms_id'];
            }
        }
        $this->returnAjax($tuiactivity,1);
    }

    //展示农场对应的农小店信息
    public function getInfo(){
        $mer_id=$_GET['mer_id'];
        if(empty($mer_id)){
            $this->returnAjax("没有获取到id值",0);
        }
        // $_GET['lat']="24.5283";
        // $_GET['long']="118.151899";
        $long=session('long');
        $lat=session('lat');
        if(empty($lat)||empty($long)){
            $this->returnAjax("没有获取到经纬度信息！",0);
        }
        $result=D("Merchant")->alias("m")->field("m.*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) as distance")->join(C('DB_PREFIX')."merchant_store s ON m.mer_id=s.mer_id")->where("m.mer_id=".$mer_id." AND s.ismain=1")->find();
        $merchant_class_image=new Merchant_image();
        $result['merchant_theme_image']=$merchant_class_image->get_image_by_path($result['merchant_theme_image']);
        $result['person_image']=$merchant_class_image->get_image_by_path($result['person_image']);
        
        $data['farm']=$result;

        //搜索查看用户是否收藏
        $user=session("user");
        $collect=D("User_collect")->where(array("uid"=>$user['uid'],"type"=>"merchant_id","id"=>$mer_id))->find();
        
        if(!empty($collect)){
            $data['collect']=1;
        }else{
            $data['collect']=0;
        }
        $this->returnAjax($data,1);
    }
    //展示农场对应的相册信息
    public function getPicturesList(){
        $mer_id=$_GET['mer_id'];
        if(empty($mer_id)){
            $this->returnAjax("未获取到农场id!",0);
        }
        $result=D("Merchant")->where("mer_id=".intval($mer_id))->find();
        $merchant_class_image=new Merchant_image();
        $result['merchant_theme_image']=$merchant_class_image->get_image_by_path($result['merchant_theme_image']);
        $result['person_image']=$merchant_class_image->get_image_by_path($result['person_image']);
        $result['images']=$merchant_class_image->get_allImage_by_path($result['pic_info']);
        //查询收藏数
        $number=D("User_collect")->where(array("type"=>"merchant_id","id"=>$mer_id))->count();
        
        $data['farm']=$result;
        $data['collects']=$number;
        $this->returnAjax($data,1);
    }
    //获取特卖地址
    public function get_group_url($group_id){
        return C('config.site_url').'/api.php?g=Api&c=Group&a=detail&group_id='.$group_id;
    }
    //获取农场url
    private function getMerchantUrl($mer_id){
        return C('config.site_url').'/api.php?g=Api&c=Merchant&a=detail&mer_id='.$mer_id;
    }
    public function gansu(){
        $this->display();
    }
}