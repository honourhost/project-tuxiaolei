<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/19
 * Time: 9:43
 */
class NewindexAction extends NewbaseAction
{
    private $logo="http://www.xiaonongding.com/xnd.png";
    private $homeappbanner = 7;    //APP轮播图
    private $homeappcate = 9;  //菜单
    private  $homeappcatenew=22; //菜单new
    private $homeapptheme = 11;  //获取首页主题推荐广告
    private  $hometextbanner=19; //获取跑马灯广告
    private $homegoodcate=21; //特卖分类推荐
    private $homefarmrecommend=26;  //农场推荐
    private $splashad=27;  //开屏广告
    /**
     * 顶部数据
     * styleID    slider:轮播图,menu：菜单 ,banner: 大图banner,textbanner：跑马灯banner,goodrecommend ：精品推荐,classify ：分类推荐,farmrecommend ：农场推荐
     * category: styleID, title,subtitle,image,link,items
     * item:    id,image,title,subtitle,sale_count,origin_price,current_provice,link(platform(web,native),url()'))
     */
public function  header(){

    $long =$_REQUEST['long'];
    $lat=$_REQUEST['lat'];
    if(empty($long)||empty($lat)){
        $this->returnAjax("没有传递经纬度!",0);
    }
    $cat_id = $this->homeappbanner;

    if ($_SESSION['areaarr'] != "all") {
        $area_id = $_SESSION['selectcityid'];
    } else {
        $area_id = 0;
    }
    $data=array();
    //slider
 //   $result = $this->getList($cat_id, $area_id);
    $result = $this->getListgood($cat_id, $area_id);
    $data[0]=array("styleID"=>"slider_00","header"=>0,"headertype"=>"0","title"=>"顶部轮播","subtitle"=>"顶部轮播","image"=>$this->logo,"link"=>array(),"items"=>$result);
    //菜单
    //$menu = $this->getList($this->homeappcate, $area_id);
   // $menu = $this->getListnative($this->homeappcatenew, $area_id);
  //  $menu = $this->getListnative($this->homeappcate, $area_id);
  //  $data[1]=array("styleID"=>"menu_00","header"=>0,"headertype"=>"0","title"=>"主页菜单","subtitle"=>"主页菜单","image"=>$this->logo,"link"=>array(),"items"=>$menu);

   //获取首页主题推荐广告管理
 //   $banner = $this->getListgood($this->homeapptheme, $area_id);
  //  $data[1]=array("styleID"=>"banner_00","header"=>0,"headertype"=>"0","title"=>"主题推荐广告","subtitle"=>"主题推荐广告","image"=>$this->logo,"link"=>array(),"items"=>$banner);
    $textbanner=$this->getListgood($this->hometextbanner,$area_id,"good");
    $data[1]=array("styleID"=>"slider_01","header"=>0,"headertype"=>"0","title"=>"跑马灯","subtitle"=>"怕吗等广告","image"=>$this->logo,"link"=>array(),"items"=>$textbanner);

    //精品推荐
 //   $goodtuijian=$this->goodtuijian();
    $goodtuijian=$this->getListnativegood(25);
    $data[2]=array("styleID"=>"goodrecommend_00","header"=>1,"headertype"=>"1","title"=>"精品推荐","subtitle"=>"精品推荐","image"=>$this->logo,"link"=>array(),"items"=>$goodtuijian);

   //特卖推荐分类
//    $condition_where=array(
//        "cat_id"=>$this->homegoodcate,
//        "status"=>1
//    );
//    $app_spider=D("App_slider");
//    $goodcat=$app_spider->where($condition_where)->order("sort DESC")->select();
//    $goodcount=count($goodcat);  //计算特卖推荐分类的数量
//
//    for($i=0;$i<count($goodcat);$i++){
//       $goods=$this->catgoodsearch($goodcat[$i]['url']);
//        if($i%2==0){
//            $data[$i+5]=array("styleID"=>"classify_00","header"=>1,"title"=>$goodcat[$i]['name'],"subtitle"=>"特卖分类推荐","image"=>C('config.site_url')."/upload/appslider/".$goodcat[$i]['pic'],"link"=>array(),"items"=>array_slice($goods,0,3));
//        }else{
//            $data[$i+5]=array("styleID"=>"classify_01","header"=>1,"title"=>$goodcat[$i]['name'],"subtitle"=>"特卖分类推荐","image"=>C('config.site_url')."/upload/appslider/".$goodcat[$i]['pic'],"link"=>array(),"items"=>$goods);
//        }
//
//    }


    $appcate=$this->getAppcate();
    $goodcount=count($appcate);
    foreach ($appcate as $k=>$v){
        $data[3+$k]=$v;
    }
    //placeholderss
      $placeholder = empty($this->config["app_search_placeholder"])?"小农丁生鲜":$this->config["app_search_placeholder"];
    //带距离的农场推荐
  // $merchants=$this->getrecommendfarms($long,$lat);
    $merchants=$this->getListfarm($this->homefarmrecommend);
    $data[3+$goodcount]=array("styleID"=>"farmrecommend_00","header"=>1,"headertype"=>"1","title"=>"农场推荐","subtitle"=>"农场推荐","image"=>$this->logo,"link"=>array(),"items"=>$merchants);
     $this->returnAjax($data, 1,$placeholder);




}

    /**
     * @param $cat_id
     * @param $area_id
     * @return string
     *  * styleID    slider:轮播图,menu：菜单 ,banner: 大图banner,textbanner：跑马灯banner,goodrecommend ：精品推荐,classify ：分类推荐,farmrecommend ：农场推荐
     * category: styleID, title,subtitle,image,link,items
     * item:    id,image,title,subtitle,sale_count,origin_price,current_price,link(platform(web,native),url()'))
     */
    private function getList($cat_id,$area_id){
//        $condition_where=array(
//            "cat_id"=>$cat_id,
//            "area_id"=>$area_id,
//            "status"=>1
//        );
        $condition_where=array(
            "cat_id"=>$cat_id,
            "status"=>1
        );
        $app_spider=D("App_slider");
        $result=$app_spider->where($condition_where)->order("sort DESC")->select();
         $data=array();
        if(!empty($result)){
            foreach($result as $key=>$val){
                if(!empty($val['pic'])){
                    $data[$key]['image']=C('config.site_url')."/upload/appslider/".$val['pic'];
                }else{
                    $data[$key]['image']=$this->logo;
                }
                $data[$key]['id']=$key;
                $data[$key]["title"]=$val["name"];
                $data[$key]["subtitle"]=$val["desc"];
                $data[$key]["sale_count"]=0;
                $data[$key]["origin_price"]=0;
                $data[$key]["current_price"]=0;
                $data[$key]["distance"]=0;
            //    $data[$key]["link"]=array("platform"=>"web","url"=>$val["url"]);
                $data[$key]["link"]=array("platform"=>"good","url"=>$val["url"],"id"=>$val["url"],"title"=>$val["name"]);
                $data[$key]["promotion"]=array("text"=>"","background"=>"");
            }
            return $data;
        }else{
            return $data;
        }
    }

    /**
     * @param $cat_id
     * @param $area_id
     * @return string
     *  * styleID    slider:轮播图,menu：菜单 ,banner: 大图banner,textbanner：跑马灯banner,goodrecommend ：精品推荐,classify ：分类推荐,farmrecommend ：农场推荐
     * category: styleID, title,subtitle,image,link,items
     * item:    id,image,title,subtitle,sale_count,origin_price,current_price,link(platform(web,native),url()'))
     */
    private function getListgood($cat_id,$area_id="all",$platform="good"){
//        $condition_where=array(
//            "cat_id"=>$cat_id,
//            "area_id"=>$area_id,
//            "status"=>1
//        );
        $condition_where=array(
            "cat_id"=>$cat_id,
            "status"=>1
        );
        $app_spider=D("App_slider");
        $result=$app_spider->where($condition_where)->order("sort DESC")->select();
        $data=array();
        if(!empty($result)){
            foreach($result as $key=>$val){
                if(!empty($val['pic'])){
                    $data[$key]['image']=C('config.site_url')."/upload/appslider/".$val['pic'];
                }else{
                    $data[$key]['image']=$this->logo;
                }
                $data[$key]['id']=$key;
                $data[$key]["title"]=$val["name"];
                $data[$key]["subtitle"]=$val["desc"];
                $data[$key]["sale_count"]=0;
                $data[$key]["origin_price"]=0;
                $data[$key]["current_price"]=0;
                $data[$key]["distance"]=0;
                //    $data[$key]["link"]=array("platform"=>"web","url"=>$val["url"]);
                $data[$key]["link"]=array("platform"=>$platform,"url"=>$val["url"],"id"=>$val["url_id"],"title"=>$val["name"]);
                $data[$key]["promotion"]=array("text"=>"","background"=>"");
            }
            return $data;
        }else{
            return $data;
        }
    }
    public function  test(){
        die;
        echo  json_encode($this->getListnative($this->homeappcatenew));
    }

    private function getListnative($cat_id,$area_id){
//        $condition_where=array(
//            "cat_id"=>$cat_id,
//            "area_id"=>$area_id,
//            "status"=>1
//        );
        $condition_where=array(
            "cat_id"=>$cat_id,
            "status"=>1
        );
        $app_spider=D("App_slider");
        $result=$app_spider->where($condition_where)->order("sort DESC")->select();
        $data=array();
        if(!empty($result)){
            foreach($result as $key=>$val){
                if(!empty($val['pic'])){
                    $data[$key]['image']=C('config.site_url')."/upload/appslider/".$val['pic'];
                }else{
                    $data[$key]['image']=$this->logo;
                }
                $data[$key]['id']=$key;
                $data[$key]["title"]=$val["name"];
                $data[$key]["subtitle"]=$val["desc"];
                $data[$key]["sale_count"]=0;
                $data[$key]["origin_price"]=0;
                $data[$key]["current_price"]=0;
                $data[$key]["distance"]=0;
                //    $data[$key]["link"]=array("platform"=>"web","url"=>$val["url"]);
                if($val["iswebjump"]==1){
                    $data[$key]["link"]=array("platform"=>"web","url"=>htmlspecialchars_decode($val["url"]),"id"=>$val["url_id"],"title"=>$val["name"]);

                }else{
                    $data[$key]["link"]=array("platform"=>"menulist","url"=>$val["url"],"id"=>$val["url_id"],"title"=>$val["name"]);

                }
                $data[$key]["promotion"]=array("text"=>"","background"=>"");
            }
            return $data;
        }else{
            return $data;
        }
    }

    private function getListnativegood($cat_id,$area_id){
//        $condition_where=array(
//            "cat_id"=>$cat_id,
//            "area_id"=>$area_id,
//            "status"=>1
//        );
        $condition_where=array(
            "cat_id"=>$cat_id,
            "status"=>1
        );
        $app_spider=D("App_slider");
        $result=$app_spider->where($condition_where)->order("sort DESC")->select();
        $data=array();
        if(!empty($result)){
            foreach($result as $key=>$val){
                if(!empty($val['pic'])){
                    $data[$key]['image']=C('config.site_url')."/upload/appslider/".$val['pic'];
                }else{
                    $data[$key]['image']=$this->logo;
                }
                $data[$key]['id']=$key;
                $data[$key]["title"]=$val["name"];
                $data[$key]["subtitle"]=$val["desc"];
                $data[$key]["sale_count"]=0;
                $data[$key]["origin_price"]=0;
                $data[$key]["current_price"]=0;
                $data[$key]["distance"]=0;
                //    $data[$key]["link"]=array("platform"=>"web","url"=>$val["url"]);
                $data[$key]["link"]=array("platform"=>"good","url"=>$val["url"],"id"=>$val["url_id"],"title"=>$val["name"]);
                $data[$key]["promotion"]=array("text"=>"","background"=>"");
            }
            return $data;
        }else{
            return $data;
        }
    }

    public function  catgoodsearch($caturl){
        //判断分类信息
        $cat_url = !empty($caturl) ? $caturl : 'xgrm';
        //根据分类信息获取分类
        if(!empty($cat_url)){
            $now_category = D('Group_category')->get_category_by_catUrl($cat_url);
            if(empty($now_category)){
                return  array();
            }

            if(!empty($now_category['cat_fid'])){
                $get_grouplist_catfid = 0;
                $get_grouplist_catid = $now_category['cat_id'];
            }else{
                $get_grouplist_catfid = $now_category['cat_id'];
                $get_grouplist_catid = 0;
            }
        }
        $result=$this->getgroupbycat($get_grouplist_catid,$get_grouplist_catfid);
      return  $result;
    }

    /**
     * 根据分类id获取特卖
     * @param $catid
     * @param $catfid
     * @return mixed
     * item:    id,image,title,subtitle,sale_count,origin_price,current_price,link(platform(web,native),url()
     */
    private function getgroupbycat($catid,$catfid){
        $now_time = $_SERVER['REQUEST_TIME'];
        $condition="";
        if(!empty($catfid)){
            $condition.="status = 1 AND is_group_buy = 0 AND type = 1 AND begin_time< ".$now_time." AND end_time"." > ".$now_time." AND cat_fid = ".$catfid;
        }else{
            $condition.="status = 1 AND is_group_buy = 0 AND type = 1 AND begin_time< ".$now_time." AND end_time"." > ".$now_time." AND cat_id = ".$catid;
        }

      $data=  D("Group")->field("group_id,s_name,name,sale_count,virtual_num,old_price,price,wx_cheap,mer_id,pic,picapp")->where($condition)->order("group_id DESC")->limit(6)->select();
   //     echo  D()->getLastSql();die;
        $groupimage=new group_image();
        $result=array();
        foreach ($data as $key=>$value){
            $result[$key]["id"]=$value["group_id"];
            if(empty($value["picapp"])){
                $images=$groupimage->get_image_by_path($value["pic"]);

            }else{
                $images=$groupimage->get_image_by_path($value["picapp"]);

            }
            $result[$key]["image"]=$images['image'];
            $result[$key]["title"]=$value["s_name"];
            $result[$key]["subtitle"]=$value["name"];
            $result[$key]["sale_count"]=intval($value["sale_count"])+intval($value["virtual_num"]);
            $result[$key]["origin_price"]=$value["old_price"];
            $result[$key]["current_price"]=$value["price"];
            $result[$key]["distance"]=0;
            $result[$key]["link"]=array("platform"=>"good","url"=>$value["group_id"],"id"=>$value["group_id"],"title"=>$value["s_name"]);
         //   $data[$key]["link"]=array("platform"=>"good","url"=>$value["group_id"],"id"=>$value["group_id"],"title"=>$value["s_name"]);
            if($key%2==0){
                $result[$key]["promotion"]=array("text"=>"","background"=>"");
            }else{
                $result[$key]["promotion"]=array("text"=>"","background"=>"");
            }



        }
        return $result;

}

    /**
     * 精品推荐接口
     */

public function  goodtuijian(){

        $now_time = $_SERVER['REQUEST_TIME'];
        $condition_where= "`g`.`status`='1' AND `g`.`index_tui`='1' and `g`.`is_group_buy` = '0' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'";

    $condition_table = array(C('DB_PREFIX').'group'=>'g');

    $group_list = D('')->table($condition_table)->where($condition_where)->limit(6)->order("g.group_id DESC")->select();



    if($group_list){
        $group_image_class = new group_image();
        $data=array();
        foreach($group_list as $k=>$v){
            $tmp_pic_arr = explode(';',$v['pic']);
            $data[$k]['image'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
            $data[$k]['id']=$v["group_id"];
            $data[$k]["title"]=$v["s_name"];
            $data[$k]["subtitle"]=$v["name"];
            $data[$k]["sale_count"]=intval($v["sale_count"])+intval($v["virtual_num"]);
            $data[$k]["origin_price"]=$v["old_price"];
            $data[$k]["current_price"]=$v["price"];
            $data[$k]["distance"]=0;
          //  $data[$k]["link"]=array("platform"=>"native","url"=>$v["group_id"]);
            $data[$k]["link"]=array("platform"=>"good","url"=>$v["group_id"],"id"=>$v["group_id"],"title"=>$v["s_name"]);
            $data[$k]["promotion"]=array("text"=>"","background"=>"");
        }
        return $data;
    }
    return array();


}

    /**
     * @param $long
     * @param $lat
     * 获取农场推荐
     */
private function getrecommendfarms($long,$lat){
    $condition_where = "  `m`.`status`='1' AND `m`.`mer_id`=`ms`.`mer_id` AND `ms`.`long` <> 0 AND `m`.`merchant_theme_image` <> '' ";
    $field_condition = "  ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) as distance ,
    `m`.`name` as name , `m`.`mer_id` as mer_id ,`ms`.`adress` as adress,`m`.`merchant_theme_image` as image  ";
    $condition_table=array( C('DB_PREFIX') . 'merchant' => 'm',C('DB_PREFIX') . 'merchant_store' => 'ms');
    $merchants=  D('')->field($field_condition)->table($condition_table)->where($condition_where)->limit(12)->select();
    $merimage=new merchant_image();
    $data=array();
    foreach ($merchants as $k=>$v){
        $data[$k]['image'] = $merimage->get_image_by_path($v["image"]);
        $data[$k]['id']=$v["mer_id"];
        $data[$k]["title"]=$v["name"];
        $data[$k]["subtitle"]=$v["adress"];
        $data[$k]["sale_count"]=0;
        $data[$k]["origin_price"]=0;
        $data[$k]["current_price"]=0;
        $data[$k]["distance"]=$v["distance"];
    //    $data[$k]["link"]=array("platform"=>"native","url"=>$v["mer_id"]);
        $data[$k]["link"]=array("platform"=>"farm","url"=>$v["mer_id"],"id"=>$v["mer_id"],"title"=>$v["name"]);
        $data[$k]["promotion"]=array("text"=>"","background"=>"");
    }
    return $data;

}

    /**
     * @return array
     * 猜你喜欢
     */
public function  getallgoods(){
    $page=$_REQUEST["page"];
    $limit=empty($_REQUEST["limit"])?16:$_REQUEST["limit"];
    $now_time = $_SERVER['REQUEST_TIME'];
    $condition_where= "`g`.`status`='1' AND `g`.`is_group_buy`='0' AND `g`.`type`='1' AND `g`.`begin_time`< ".$now_time." AND `g`.`end_time`> ".$now_time;

    $condition_table = array(C('DB_PREFIX').'group'=>'g');

    $groupcount = D('')->table($condition_table)->where($condition_where)->count();

    $pagecount=ceil($groupcount/intval($limit));
   // echo  $pagecount;die;
    if($pagecount<$page){
        $this->returnAjax("超出最大页码了",2);
    }
    $group_list=D("")->table($condition_table)->where($condition_where)->page($page,$limit)->order('picthumb DESC')->select();
   // echo D()->getLastSql();die;



    if($group_list){

        $group_image_class = new group_image();
        $data=array();
        foreach($group_list as $k=>$v){
            if(!empty($v["picthumb"])){
                $tmp_pic_arr = explode(';',$v['picthumb']);
            }
           elseif (!empty($v["picapp"])){
                $tmp_pic_arr = explode(';',$v['picapp']);

            }else{
                $tmp_pic_arr = explode(';',$v['pic']);
            }
            $data[$k]['image'] = $group_image_class->get_image_by_path($tmp_pic_arr[0])['image'];
            $data[$k]['id']=$v["group_id"];
            $data[$k]["title"]=$v["s_name"];
            $data[$k]["subtitle"]=$v["name"];
            $data[$k]["sale_count"]=intval($v["sale_count"])+intval($v["virtual_num"]);
            $data[$k]["origin_price"]=$v["old_price"];
            $data[$k]["current_price"]=$v["price"];
            $data[$k]["distance"]=0;
         //   $data[$k]["link"]=array("platform"=>"native","url"=>$v["group_id"]);
            $data[$k]["link"]=array("platform"=>"good","url"=>$v["group_id"],"id"=>$v["group_id"],"title"=>$v["s_name"]);
            $data[$k]["promotion"]=array("text"=>"","background"=>"");
        }
        $result=array("styleID"=>"youlike_00","header"=>1,"headertype"=>"0","title"=>"猜你喜欢","subtitle"=>"猜你喜欢","image"=>$this->logo,"link"=>array(),"items"=>$data);
        $this->returnAjax($result, 1);
    }else{
        $this->returnAjax("没有获取到数据",0);
    }

}


    public function getCities(){
        $cities=null;
        $letters=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
        //按照字母顺序查询出所有城市的内容
        $database_area=D("Area");
        foreach($letters as $key=>$val){
            $cities[$val]=$database_area->field("area_id,area_pid,area_name,first_pinyin,area_url")->where(array("first_pinyin"=>$val,"area_type"=>2,"is_open"=>1))->select();
        }
        if(!empty($cities)){
            $this->returnAjax(array_filter($cities),1);
        }else{
            $this->returnAjax("未获取到数据！",1);
        }
    }
    public function getCitiesandroid(){
        $cities=null;
        $letters=array("#","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
        //按照字母顺序查询出所有城市的内容
        $database_area=D("Area");
        $hotcitiesarray=D("Area")->field("area_id,area_pid,area_name,first_pinyin,area_url")->where(" area_name IN('青岛','佛山','北京','上海','深圳','广州','重庆','天津','武汉','南京','长沙','沈阳')")->group('area_name')->select();
        foreach($letters as $key=>$val){
            if($key==0){
                $cities[$val]=$hotcitiesarray;
            }else{
                $cities[$val]=$database_area->field("area_id,area_pid,area_name,first_pinyin,area_url")->where(array("first_pinyin"=>$val,"area_type"=>2,"is_open"=>1))->select();

            }
        }
        if(!empty($cities)){
            $this->returnAjax(array_filter($cities),1);
        }else{
            $this->returnAjax("未获取到数据！",1);
        }
    }

    /**
     *
     */
    public function  getCitiesnoabc(){
     //   $hotcitiey="青岛市:佛山市:北京市:上海市:深圳市:广州市:重庆市:天津市:武汉市:南京市:长沙市:沈阳市";
     //   $hotarray=explode(":",$hotcitiey);
        $hotcitiesarray=D("Area")->where(" area_name IN('青岛','佛山','北京','上海','深圳','广州','重庆','天津','武汉','南京','长沙','沈阳')")->group('area_name')->select();
    //    echo  json_encode($hotcitiesarray);die;
        $database_area=D("Area");
            $cities=$database_area->field("area_id,area_pid,area_name,first_pinyin,area_url")->where(array("area_type"=>2,"is_open"=>1))->select();
      $data["hotcities"]=$hotcitiesarray;
      $data["allcities"]=array_filter($cities);
        if(!empty($cities)){
            $this->returnAjax($data,1);
        }else{
            $this->returnAjax("未获取到数据！",0);
        }
    }

    public function  searchMenulist()
    {

        $page=empty($_GET["page"])?1:$_GET["page"];
        $limit=empty($_GET["limit"])?16:$_GET["limit"];
        //判断分类信息
        $cat_url = !empty($_GET['cat_url']) ? $_GET['cat_url'] : '';
        //根据分类信息获取分类
        if (!empty($cat_url)) {
            $now_category = D('Group_category')->get_category_by_catUrl($cat_url);
            if (empty($now_category)) {
                $this->returnAjax("分类不存在", 0);
            }

        }
        $now_time = $_SERVER['REQUEST_TIME'];
        if(empty($now_category["cat_fid"])){
            $condition=" is_group_buy =0 AND type=1 AND begin_time < ".$now_time." AND end_time > ".$now_time." AND mer_id <> 747 AND mer_id <> 621 AND mer_id <> 821 AND cat_fid =".$now_category['cat_id'];

        }else{
            $condition=" is_group_buy =0 AND type=1 AND begin_time < ".$now_time." AND end_time > ".$now_time." AND mer_id <> 747 AND mer_id <> 621 AND mer_id <> 821 AND cat_id =".$now_category['cat_id'];

        }
        $count=D("Group")->where($condition)->count();
       // echo  D()->getLastSql();die;
        $pagecount=ceil($count/$limit);
        if($page>$pagecount){
            $this->returnAjax("超出最大页码了",2);
        }
        $result=D("Group")->where($condition)->page($page,$limit)->order("picthumb DESC")->select();
        if(empty($result)){
            $this->returnAjax("没有查询到相关数据",0);
        }
        $groupimage=new group_image();
        $data=array();
        foreach ($result as $key=>$value){
            if(!empty($value["picthumb"])){
                $tmp_pic_arr = explode(';',$value['picthumb']);
            }
            elseif (!empty($value["picapp"])){
                $tmp_pic_arr = explode(';',$value['picapp']);

            }else{
                $tmp_pic_arr = explode(';',$value['pic']);
            }
            $data[$key]['image'] = $groupimage->get_image_by_path($tmp_pic_arr[0])['image'];
        //    $data[$key]["image"]=$groupimage->get_image_by_path($value["pic"],"s");
            $data[$key]["id"]=$value["group_id"];
            $data[$key]["title"]=$value["name"];
            $data[$key]["subtitle"]=$value["s_name"];
            $data[$key]["sale_count"]=intval($value["virtual_num"])+intval($value["success_num"]);
            $data[$key]["origin_price"]=$value["old_price"];
            $data[$key]["current_price"]=$value["price"];
            $data[$key]["distance"]=0;
            $data[$key]["link"]=array("platform"=>"good","url"=>$value["group_id"],"id"=>$value["group_id"],"title"=>$value["name"]);
            $data[$key]["promotion"]=array("text"=>"","background"=>"");

        }
        $end[0]["styleID"]="menugoods_00";
        $end[0]["header"]=0;
        $end[0]["headertype"]="1";
        $end[0]["title"]="";
        $end[0]["subtitle"]="";
        $end[0]["image"]="";
        $end[0]["link"]=array();
        $end[0]["items"]=$data;
        $this->returnAjax($end,1);





    }


    private function getListfarm($cat_id,$area_id){
//        $condition_where=array(
//            "cat_id"=>$cat_id,
//            "area_id"=>$area_id,
//            "status"=>1
//        );
        $condition_where=array(
            "cat_id"=>$cat_id,
            "status"=>1
        );
        $app_spider=D("App_slider");
        $result=$app_spider->where($condition_where)->order("sort DESC")->select();
        $data=array();
        if(!empty($result)){
            foreach($result as $key=>$val){

                if(!empty($val['pic'])){
                    $data[$key]['image']=C('config.site_url')."/upload/appslider/".$val['pic'];
                }else{
                    $data[$key]['image']=$this->logo;
                }
                $data[$key]['id']=$val["url_id"];
                $data[$key]["title"]=$val["name"];
                $data[$key]["subtitle"]=$val["desc"];
                $data[$key]["sale_count"]=0;
                $data[$key]["origin_price"]=0;
                $data[$key]["current_price"]=0;
                $data[$key]["distance"]=0;
                //    $data[$key]["link"]=array("platform"=>"web","url"=>$val["url"]);
                $data[$key]["link"]=array("platform"=>"farm","url"=>$val["url"],"id"=>$val["url_id"],"title"=>$val["name"]);
                $data[$key]["promotion"]=array("text"=>"","background"=>"");
            }
            return $data;
        }else{
            return $data;
        }
    }

    /**
     * 获取APP首页 推荐分类列表和产品  3个 6个 两种type
     * @return bool
     */
    public function  getAppcate(){
        $appcate=D("Appcate")->where(" status =1 ")->order("sort DESC")->select();
        if(empty($appcate)){
            return false;
        }else{
            $appcategood_database=D("Appcategood");
            $group_database=D("Group");
            foreach ($appcate as $key=>$value){
                $goods=$appcategood_database->where("cat_id = ".$value["id"])->select();
                foreach ($goods as $k=>$v){
                    $good=$group_database->where("group_id =".$v["group_id"])->find();
                    $goods[$k]["price"]=$good["price"];
                    $goods[$k]["pic"]=C('config.site_url')."/upload/appslider/".$v['pic'];
                }
                $appcate[$key]["goods"]=$goods;
                $appcate[$key]["pic"]=C('config.site_url')."/upload/appslider/".$value['pic'];
                if($value["isthree"]==1){
                    $appcate[$key]["classify"]="classify_00";
                }else{
                    $appcate[$key]["classify"]="classify_01";
                }
            }


        }
        $data=array();
        foreach ($appcate as $kk=>$vv){
            $data[$kk]["styleID"]=$vv["classify"];
            $data[$kk]["header"]=0;
            $data[$kk]["headertype"]="1";
            $data[$kk]["title"]=$vv["name"];
            $data[$kk]["subtitle"]=$vv["desc"];
            $data[$kk]["image"]=$vv["pic"];
            $data[$kk]["link"]=array();
            $item=array();
            foreach ($vv["goods"] as $kkk=>$vvv){
                $item[$kkk]["id"]=$vvv["group_id"];
                $item[$kkk]["image"]=$vvv["pic"];
                $item[$kkk]["title"]=$vvv["name"];
                $item[$kkk]["subtitle"]=$vvv["desc"];
                $item[$kkk]["sale_count"]=0;
                $item[$kkk]["origin_price"]=$vvv["price"];
                $item[$kkk]["current_price"]=$vvv["price"];
                $item[$kkk]["distance"]=0;
                $item[$kkk]["link"]=array("platform"=>"good","url"=>$vvv["group_id"],"id"=>$vvv["group_id"],"title"=>$vvv["name"]);
                $item[$kkk]["promotion"]=array("text"=>"","background"=>"");

            }
            $data[$kk]["items"]=$item;
        }
     //  $this->returnAjax($data,1);
        return $data;

    }

    /**
     * 获取开屏广告
     */
    public function  getsplashad(){
        $condition_where=array(
            "cat_id"=>$this->splashad,
            "status"=>1
        );
        $app_spider=D("App_slider");
        $result=$app_spider->where($condition_where)->order("sort DESC")->find();
        if(empty($result)){
            $this->returnAjax("未获取到数据",2);
        }
          $data["id"]=$result["id"];
        $data["title"]=$result["name"];
        $data["subtitle"]=$result["desc"];
        if(!empty($result['pic'])){
            $data['image']=C('config.site_url')."/upload/appslider/".$result['pic'];
        }else{
            $data['image']=$this->logo;
        }
        $data["sale_count"]=0;
        $data["origin_price"]=0;
        $data["current_price"]=0;
        $data["distance"]=0;
        if($result["status"]==1){
            $data["show"]=1;
        }else{
            $data["show"]=0;
        }
        if($result["iswebjump"]==1){
            $data["link"]=array("platform"=>"web","url"=>htmlspecialchars_decode($result["url"]),"id"=>$result["url_id"],"title"=>$result["name"]);
        }else{
            $data["link"]=array("platform"=>"good","url"=>$result["url"],"id"=>$result["url_id"],"title"=>$result["name"]);
        }


        $data["promotion"]=array("text"=>"","background"=>"");
        $end[0]=$data;
        $this->returnAjax($end,1);


    }




}