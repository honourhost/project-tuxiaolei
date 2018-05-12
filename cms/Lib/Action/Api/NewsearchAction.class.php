<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/28
 * Time: 13:11
 */
class NewsearchAction  extends NewbaseAction
{
    /**
     * 获取热门搜索
     */
    public function getHotsearch(){
        $database_search_hot = D('Search_hot');
        $search_hot_list = $database_search_hot->field("id,name")->order('`sort` DESC,`id` ASC')->select();
        if(!empty($search_hot_list)){
            $this->returnAjax($search_hot_list,1);
        }else{
            $this->returnAjax("未获取到关键字信息！",0);
        }
    }

    /**
     * 搜索特卖
     */
    public function  searchGroup(){
        $keywords=$_GET['keywords'];
        if(empty($keywords)){
            $this->returnAjax("关键字为空！",0);
        }
        //获取经纬度
        $lat=$_GET['lat'];
        $long=$_GET['long'];
        if(empty($lat)||empty($long)){
            $this->returnAjax("未获取到经纬度信息！",0);

        }

        $type = "goods";
        //针对特卖的排序
        $order="";
        $price=$_GET['price'];
        $distance=$_GET['distance'];
        $sale_count=$_GET['sale_count'];
        if(!empty($price)){
            if($price==1){
                $order.=" price ASC ";
            }elseif($price==2){
                $order.=" price DESC ";
            }else{
                $order.=" price ASC ";
            }
        }
        if(!empty($order)){
            if(!empty($distance)){
                if($distance==1){
                    $order.=",distance ASC ";
                }elseif($distance==2){
                    $order.=",distance DESC ";
                }else{
                    $order.=",distance ASC ";
                }
            }
        }else{
            if($distance==1){
                $order.=" distance ASC ";
            }elseif($distance==2){
                $order.=" distance DESC ";
            }
        }
        if(!empty($order)){
            if(!empty($sale_count)){
                if($sale_count==1){
                    $order.=",sale_count ASC ";
                }elseif($sale_count==2){
                    $order.=",sale_count DESC ";
                }else{
                    $order.=",sale_count DESC ";
                }
            }
        }else{
            if($sale_count==1){
                $order.=" sale_count ASC ";
            }elseif($sale_count==2){
                $order.=" sale_count DESC ";
            }
        }

        if(!empty($order)){
            $result=$this->searchgoodaction($keywords,$lat,$long,$order);
         //   $result=D("Search")->findnopin($type,$keywords,$lat,$long,$order);
        }else{
          //  $result=D("Search")->findnopin($type,$keywords,$lat,$long);
            $result=$this->searchgoodaction($keywords,$lat,$long);
        }
        if($result=="1"){
            $this->returnAjax("没有更多数据了",2);
        }elseif ($result=="0"){
            $this->returnAjax("未搜索到数据",0);
        }
        else{
            $itemss=array();
            foreach ($result as $key=>$value){
                $itemss[$key]["image"]=$value["group_pic"];
                $itemss[$key]["id"]=$value["group_id"];
                $itemss[$key]["title"]=$value["name"];
                $itemss[$key]["subtitle"]=$value["s_name"];
                $itemss[$key]["sale_count"]=$value["sale_count"];
                $itemss[$key]["origin_price"]=$value["old_price"];
                $itemss[$key]["current_price"]=$value["price"];
                $itemss[$key]["distance"]=$value["distance"];
           //    $itemss[$key]["link"]=array("platform"=>"native","url"=>$value["group_id"]);
                $itemss[$key]["link"]=array("platform"=>"good","url"=>$value["group_id"],"id"=>$value["group_id"],"title"=>$value["s_name"]);
                $itemss[$key]["promotion"]=array("text"=>"","background"=>"");

            }
            $data["styleID"]="searchgoods_00";
            $data["header"]=0;
            $data["title"]="".$keywords;
            $data["subtitle"]="".$keywords;
            $data["image"]="";
            $data["link"]=array();
            $data["items"]=$itemss;
            $adam[0]=$data;

            $this->returnAjax($adam,1);


        }


    }


    private function  searchgoodaction($keywords,$lat,$long,$order){
        if(empty($order)){
            $condition_order = "sale_count DESC";
        }else{
            $condition_order = $order;
        }
        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = " g.status=1 AND (`g`.`name` like '%" . $keywords . "%' OR `g`.`prefix_title` like '%" . $keywords . "%' OR `g`.`s_name` like '%" . $keywords . "%') AND `g`.`mer_id`=`m`.`mer_id` AND `ms`.`mer_id`=`m`.`mer_id` AND `g`.`is_group_buy`='0' AND `g`.`mer_id` <> '890' AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3246' AND `g`.`group_id` <> '3254' AND `g`.`group_id` <> '3428' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `m`.`area_id` in (".$area_idstr.")";
        }else{
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = " g.status=1 AND (`g`.`name` like '%" . $keywords . "%' OR `g`.`prefix_title` like '%" . $keywords . "%' OR `g`.`s_name` like '%" . $keywords . "%') AND `g`.`mer_id`=`m`.`mer_id` AND `ms`.`mer_id`=`m`.`mer_id` AND `g`.`is_group_buy` ='0' AND  `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`mer_id` <> '890' AND `g`.`mer_id` <> '1115' AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3246' AND `g`.`group_id` <> '3428' AND `g`.`group_id` <> '3254'";
        }
        $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'merchant_store'=>'ms');
        $condition_field = "DISTINCT `g`.`group_id`,`g`.`name`,`g`.`status`,`g`.`virtual_num`,`g`.`s_name`,`g`.`intro`,(g.sale_count+g.virtual_num) as sale_count,`g`.`pic` `group_pic`,`g`.`price`,`g`.`wx_cheap`,`g`.`end_time`,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) AS distance,`g`.`old_price` ";

        $count_goods = D('')->table($condition_table)->where($condition_where)->count();
        $req_page=$_GET['p'];
        $max_page=ceil($count_goods/15);
        if($req_page>$max_page){
            return "1";
        }
        $p = new Page($count_goods,"15","p");
        $result = D()->field($condition_field)->where($condition_where)->table($condition_table)->group('`g`.`group_id`, `m`.`mer_id`')->limit($p->firstRow.','.$p->listRows)->order($condition_order)->select();
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
        if(!empty($result)){
            return $result;
        }else{
            return "0";
        }
    }


    //获取特卖地址
    public function get_group_url($group_id){
        return C('config.site_url').'/mobile.php?g=Mobile&c=Group&a=detail&group_id='.$group_id;
    }



}