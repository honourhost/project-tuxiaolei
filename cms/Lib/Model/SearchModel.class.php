<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/27
 * Time: 10:19
 */
class SearchModel extends Model{
    //搜索，根据类型和关键字
    public function find($type,$keywords,$lat,$long,$order){
        if(!empty($type)){
            import('@.ORG.group_page');
            if($type=="goods") {
                if(empty($order)){
                    $condition_order = "sale_count DESC";
                }else{
                    $condition_order = $order;
                }
                if($_SESSION['areaarr']!="all"){
                    $area_idstr=implode(',',$_SESSION['areaarr']);
                    $now_time = $_SERVER['REQUEST_TIME'];
                    $condition_where = " g.status=1 AND (`g`.`name` like '%" . $keywords . "%' OR `g`.`prefix_title` like '%" . $keywords . "%' OR `g`.`s_name` like '%" . $keywords . "%' OR `g`.`intro` like '%" . $keywords . "%') AND `g`.`mer_id`=`m`.`mer_id` AND `ms`.`mer_id`=`m`.`mer_id` AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `m`.`area_id` in (".$area_idstr.")";
                }else{
                    $now_time = $_SERVER['REQUEST_TIME'];
                    $condition_where = " g.status=1 AND (`g`.`name` like '%" . $keywords . "%' OR `g`.`prefix_title` like '%" . $keywords . "%' OR `g`.`s_name` like '%" . $keywords . "%' OR `g`.`intro` like '%" . $keywords . "%') AND `g`.`mer_id`=`m`.`mer_id` AND `ms`.`mer_id`=`m`.`mer_id` AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'";
                }
                $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'merchant_store'=>'ms');
                $condition_field = "DISTINCT `g`.`group_id`,`g`.`name`,`g`.`status`,`g`.`virtual_num`,`g`.`s_name`,`g`.`intro`,(g.sale_count+g.virtual_num) as sale_count,`g`.`pic` `group_pic`,`g`.`price`,`g`.`wx_cheap`,`g`.`end_time`,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) AS distance";

                $count_goods = D('')->table($condition_table)->where($condition_where)->count();
                $req_page=$_GET['p'];
                $max_page=ceil($count_goods/15);
                if($req_page>$max_page){
                    return "";
                }
                $p = new Page($count_goods,"15","p");
                $result = $this->field($condition_field)->where($condition_where)->table($condition_table)->group('`g`.`group_id`, `m`.`mer_id`')->limit($p->firstRow.','.$p->listRows)->order($condition_order)->select();
                //print_r(D()->getLastSql());
                if(!empty($result)) {
                    $group_image_class = new group_image();
                    foreach ($result as $k => $val) {
                        //转换图片URL
                        $tmp_pic_arr = explode(';', $val['group_pic']);
                        $result[$k]['group_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
                        $result[$k]['url'] = $this->get_group_url($val['group_id']);
                    }
                }
            }elseif($type=="farm"){
                if(empty($order)){
                    $condition_order = "fans_count DESC";
                }else{
                    $condition_order = $order;
                }
                if($_SESSION['areaarr']!="all"){
                     $area_idstr=implode(',',$_SESSION['areaarr']);
                     $condition_where = "`m`.`merchant_theme_image` <> '' AND (`m`.`name` like '%" . $keywords . "%' OR `m`.`person_name` like '%" . $keywords . "%' OR `m`.`person_info` like '%" . $keywords . "%' OR `m`.`txt_info` like '%" . $keywords . "%') AND `m`.`mer_id`=`ms`.`mer_id` AND `m`.`area_id` in (".$area_idstr.")";
                 }else{
                    $condition_where = "`m`.`merchant_theme_image` <> '' AND (`m`.`name` like '%" . $keywords . "%' OR `m`.`person_name` like '%" . $keywords . "%' OR `m`.`person_info` like '%" . $keywords . "%' OR `m`.`txt_info` like '%" . $keywords . "%') AND `m`.`mer_id`=`ms`.`mer_id`";
                }
                $condition_where = "`m`.`name` like '%" . $keywords . "%' OR `m`.`person_name` like '%" . $keywords . "%' OR `m`.`person_info` like '%" . $keywords . "%' OR `m`.`txt_info` like '%" . $keywords . "%'AND `m`.`mer_id`=`ms`.`mer_id`";
                $condition_table = array(C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'merchant_store'=>'ms');
                $condition_field = "DISTINCT m.mer_id,m.name,m.phone,m.fans_count,m.person_name,m.person_image,m.person_info,m.txt_info,m.merchant_theme_image,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) AS distance";

                $count_farm = D('')->table($condition_table)->where($condition_where)->count();
                $req_page=$_GET['p'];
                $max_page=ceil($count_farm/15);
                if($req_page>$max_page){
                    return "";
                }
                $p = new Page($count_farm,"15","p");
                $result = $this->field($condition_field)->where($condition_where)->table($condition_table)->group('`m`.`mer_id`')->limit($p->firstRow.','.$p->listRows)->order($condition_order)->select();
                //转换图片url
                if(!empty($result)) {
                    $merchant_image_class = new merchant_image();
                    foreach ($result as $k => $val) {
                        //转换图片URL
                        if(!empty($val['merchant_theme_image'])) {
                            $result[$k]['merchant_theme_image'] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
                        }
                        if(!empty($val['person_image'])) {
                            $result[$k]['person_image'] = $merchant_image_class->get_image_by_path($val['person_image']);
                        }
                        //判断是否已被收藏
                        if($this->ifCollect($val['mer_id'])){
                        $result[$k]['collect']=1;
                        }else{
                        $result[$k]['collect']=0;
                        }
                        $result[$k]['url'] = $this->getMerchantUrl($val['mer_id']);
                    }
                }
            }else{
                return "";
            }
        }else{
            return "";
        }
        return $result;
    }
      //搜索  无拼团
    public function findnopin($type,$keywords,$lat,$long,$order){
        if(!empty($type)){
            import('@.ORG.group_page');
            if($type=="goods") {
                if(empty($order)){
                    $condition_order = "sale_count DESC";
                }else{
                    $condition_order = $order;
                }
                if($_SESSION['areaarr']!="all"){
                    $area_idstr=implode(',',$_SESSION['areaarr']);
                    $now_time = $_SERVER['REQUEST_TIME'];
                    $condition_where = " g.status=1 AND (`g`.`name` like '%" . $keywords . "%' OR `g`.`prefix_title` like '%" . $keywords . "%' OR `g`.`s_name` like '%" . $keywords . "%' OR `g`.`intro` like '%" . $keywords . "%') AND `g`.`mer_id`=`m`.`mer_id` AND `ms`.`mer_id`=`m`.`mer_id` AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `m`.`area_id` in (".$area_idstr.")";
                }else{
                    $now_time = $_SERVER['REQUEST_TIME'];
                    $condition_where = " g.status=1 AND (`g`.`name` like '%" . $keywords . "%' OR `g`.`prefix_title` like '%" . $keywords . "%' OR `g`.`s_name` like '%" . $keywords . "%' OR `g`.`intro` like '%" . $keywords . "%') AND `g`.`mer_id`=`m`.`mer_id` AND `ms`.`mer_id`=`m`.`mer_id` AND `g`.`is_group_buy` ='0' AND  `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'";
                }
                $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'merchant_store'=>'ms');
                $condition_field = "DISTINCT `g`.`group_id`,`g`.`name`,`g`.`status`,`g`.`virtual_num`,`g`.`s_name`,`g`.`intro`,(g.sale_count+g.virtual_num) as sale_count,`g`.`pic` `group_pic`,`g`.`price`,`g`.`wx_cheap`,`g`.`end_time`,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) AS distance,`g`.`old_price` ";

                $count_goods = D('')->table($condition_table)->where($condition_where)->count();
                $req_page=$_GET['p'];
                $max_page=ceil($count_goods/15);
                if($req_page>$max_page){
                    return "";
                }
                $p = new Page($count_goods,"15","p");
                $result = $this->field($condition_field)->where($condition_where)->table($condition_table)->group('`g`.`group_id`, `m`.`mer_id`')->limit($p->firstRow.','.$p->listRows)->order($condition_order)->select();
                //print_r(D()->getLastSql());
                if(!empty($result)) {
                    $group_image_class = new group_image();
                    foreach ($result as $k => $val) {
                        //转换图片URL
                        $tmp_pic_arr = explode(';', $val['group_pic']);
                        $result[$k]['group_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
                        $result[$k]['url'] = $this->get_group_url($val['group_id']);
                    }
                }
            }elseif($type=="farm"){
                if(empty($order)){
                    $condition_order = "fans_count DESC";
                }else{
                    $condition_order = $order;
                }
                if($_SESSION['areaarr']!="all"){
                    $area_idstr=implode(',',$_SESSION['areaarr']);
                    $condition_where = "`m`.`merchant_theme_image` <> '' AND (`m`.`name` like '%" . $keywords . "%' OR `m`.`person_name` like '%" . $keywords . "%' OR `m`.`person_info` like '%" . $keywords . "%' OR `m`.`txt_info` like '%" . $keywords . "%') AND `m`.`mer_id`=`ms`.`mer_id` AND `m`.`area_id` in (".$area_idstr.")";
                }else{
                    $condition_where = "`m`.`merchant_theme_image` <> '' AND (`m`.`name` like '%" . $keywords . "%' OR `m`.`person_name` like '%" . $keywords . "%' OR `m`.`person_info` like '%" . $keywords . "%' OR `m`.`txt_info` like '%" . $keywords . "%') AND `m`.`mer_id`=`ms`.`mer_id`";
                }
                $condition_where = "`m`.`name` like '%" . $keywords . "%' OR `m`.`person_name` like '%" . $keywords . "%' OR `m`.`person_info` like '%" . $keywords . "%' OR `m`.`txt_info` like '%" . $keywords . "%'AND `m`.`mer_id`=`ms`.`mer_id`";
                $condition_table = array(C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'merchant_store'=>'ms');
                $condition_field = "DISTINCT m.mer_id,m.name,m.phone,m.fans_count,m.person_name,m.person_image,m.person_info,m.txt_info,m.merchant_theme_image,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) AS distance";

                $count_farm = D('')->table($condition_table)->where($condition_where)->count();
                $req_page=$_GET['p'];
                $max_page=ceil($count_farm/15);
                if($req_page>$max_page){
                    return "";
                }
                $p = new Page($count_farm,"15","p");
                $result = $this->field($condition_field)->where($condition_where)->table($condition_table)->group('`m`.`mer_id`')->limit($p->firstRow.','.$p->listRows)->order($condition_order)->select();
                //转换图片url
                if(!empty($result)) {
                    $merchant_image_class = new merchant_image();
                    foreach ($result as $k => $val) {
                        //转换图片URL
                        if(!empty($val['merchant_theme_image'])) {
                            $result[$k]['merchant_theme_image'] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
                        }
                        if(!empty($val['person_image'])) {
                            $result[$k]['person_image'] = $merchant_image_class->get_image_by_path($val['person_image']);
                        }
                        //判断是否已被收藏
                        if($this->ifCollect($val['mer_id'])){
                            $result[$k]['collect']=1;
                        }else{
                            $result[$k]['collect']=0;
                        }
                        $result[$k]['url'] = $this->getMerchantUrl($val['mer_id']);
                    }
                }
            }else{
                return "";
            }
        }else{
            return "";
        }
        return $result;
    }
    //获取特卖地址
    public function get_group_url($group_id){
        return C('config.site_url').'/mobile.php?g=Mobile&c=Group&a=detail&group_id='.$group_id;
    }
    //获取农场url
    private function getMerchantUrl($mer_id){
        return C('config.site_url').'/mobile.php?g=Mobile&c=Merchant&a=detail&mer_id='.$mer_id;
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
}