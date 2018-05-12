<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/7/22
 * Time: 14:34
 * @param int $_REQUEST['long'] 经纬度信息
 * @param int $_REQUEST['lat'] 经纬度信息
 * @param string $_SESSION['areaarr'] 所在地信息
 */
class ssNewindexAction extends NewbaseAction
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
    private $hometab=28;  //顶部tab
    private  $hometabnew=30;  //根据标签的顶部tab  新API用
    private $bibuytop=32;//必买top模块
    /**
     * 顶部数据
     * styleID    slider:轮播图,menu：菜单 ,banner: 大图banner,textbanner：跑马灯banner,goodrecommend ：精品推荐,classify ：分类推荐,farmrecommend ：农场推荐
     * category: styleID, title,subtitle,image,link,items
     * item:    id,image,title,subtitle,sale_count,origin_price,current_provice,link(platform(web,native),url()'))
     */
    public function  header(){
        //获取前台传来的经纬度
        $long =$_REQUEST['long'];
        $lat=$_REQUEST['lat'];
        if(empty($long)||empty($lat)){
            $this->returnAjax("没有传递经纬度!",0);
        }
        $cat_id = $this->homeappbanner;//APP轮播图
        //当进来地区信息时,则获取该用户的地区id,以便推广同城的商品
        if ($_SESSION['areaarr'] != "all"){
            //获取城市id
            $area_id = $_SESSION['selectcityid'];
        }else{
            $area_id = 0;
        }
        $data=array();

        //获取小banner和分组商品-175行
        //传入模块id和地区id
        $result = $this->getListgood($cat_id, $area_id);
        //赋值顶部banner字段,发送(一个slider数组只是一部分样式)
        $data[0]=array("styleID"=>"slider_02","header"=>0,"headertype"=>"0","title"=>"顶部轮播","subtitle"=>"顶部轮播","image"=>$this->logo,"link"=>array(),"items"=>$result);
        //菜单
        //$menu = $this->getList($this->homeappcate, $area_id);
        // $menu = $this->getListnative($this->homeappcatenew, $area_id);
        //  $menu = $this->getListnative($this->homeappcate, $area_id);
        //  $data[1]=array("styleID"=>"menu_00","header"=>0,"headertype"=>"0","title"=>"主页菜单","subtitle"=>"主页菜单","image"=>$this->logo,"link"=>array(),"items"=>$menu);

        //获取首页主题推荐广告管理
        //   $banner = $this->getListgood($this->homeapptheme, $area_id);
        //  $data[1]=array("styleID"=>"banner_00","header"=>0,"headertype"=>"0","title"=>"主题推荐广告","subtitle"=>"主题推荐广告","image"=>$this->logo,"link"=>array(),"items"=>$banner);




        /**
        * 调用必买Top
        */
        $textbanner=$this->getBiBuyTop('2');//2对应isthree的必买Top要求
        //$data[1]=array("styleID"=>"topgoods_00","header"=>"必买Top","headertype"=>"推荐给懂吃 会选 有品位的你","link"=>array(),"items"=>$textbanner);
        $data[1]=$textbanner;

        /**
        * 调用有品生活模块
        *
        **/
        $appcatethree=$this->getypBuyTop('3');
        //因为已经有2个$data的下标了,为避免下标冲突,则将下标加2
        //$data[2]=array("styleID"=>"premiumLife_00","header"=>'有品生活',"headertype"=>"产地溯源 产地直供","image"=>$this->logo,"link"=>array(),"items"=>$appcatethree);
        $data[2]=$appcatethree;

        /**
         * 精选推荐模块
         **/
        //$goodtuijian=$this->goodtuijian();
        $goodtuijian=$this->getBiBuyTop('4');
        $data[3]=$goodtuijian;
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


//        $appcate=$this->getAppcate();
//        $goodcount=count($appcate);
//        foreach ($appcate as $k=>$v){
//            $data[3+$k]=$v;
//        }
        //placeholderss
        //判断搜索框是否为空
        $placeholder = empty($this->config["app_search_placeholder"])?"小农丁生鲜":$this->config["app_search_placeholder"];
        //带距离的农场推荐
        // $merchants=$this->getrecommendfarms($long,$lat);
        //$merchants=$this->getListfarm($this->homefarmrecommend);
        $merchants=$this->getNewfarm('33');
        $appcatesix=$this->getAppcatesix();
        $goodcountsix=count($appcatesix);
        foreach ($appcatesix as $kk=>$vv){
            $data[4+$goodcount+$kk]=$vv;
        }
        $data[4+$goodcount+$goodcountsix]=array("styleID"=>"farmrecommend_01","header"=>1,"headertype"=>"2","title"=>"农场推荐","subtitle"=>"科学管理，生态种植，我负责食材，您享受美味！","image"=>$this->logo,"link"=>array(),"items"=>$merchants);
        $this->returnAjax($data, 1,$placeholder);
        //发送异域诱惑模块
        /*$data[4]=array("styleID"=>"classify_33","header"=>1,"headertype"=>"2","title"=>"农场推荐","subtitle"=>"科学管理，生态种植，我负责食材，您享受美味！","image"=>$this->logo,"link"=>array(),"items"=>$merchants);
        $this->returnAjax($data, 1,$placeholder);*/


    }

    /**获取小banner,精简方法
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
        //查询首页轮播图信息表
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

    /** 获取小banner和分组商品
     * @param $cat_id int 轮播图显示id
     * @param $area_id int 地区id
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
        //查询首页轮播图信息表
        $app_spider=D("App_slider");
                            //where要求轮播字段为(值为7),状态为显示
        $result=$app_spider->where($condition_where)->order("sort DESC")->select();
        $data=array();
        if(!empty($result)){
            foreach($result as $key=>$val){
                //当查询到的首页图image字段内有值时,则拼接路径,当没有时,返回logo
                if(!empty($val['pic'])){
                    $data[$key]['image']=C('config.site_url')."/upload/appslider/".$val['pic'];
                }else{
                    $data[$key]['image']=$this->logo;
                }
                $data[$key]['id']=$key;
                $data[$key]["title"]=$val["name"];
                $data[$key]["subtitle"]=$val["desc"];//副标题
                $data[$key]["sale_count"]=0;//售卖统计
                $data[$key]["origin_price"]=0;//原价
                $data[$key]["current_price"]=0;//现价
                $data[$key]["distance"]=0;//距离
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
        exit;
        echo  json_encode($this->getListnative($this->bibuytop));
    }
    /**
    * 必买Top模块
    *
    */
    public function  getBiBuyTop($isthree='0'){
        //app首页推荐表,小banner
        $appcate=D("Appcate")->where("status=1 AND isthree=".$isthree)->order("sort DESC")->select();
        if(empty($appcate)){
            return false;
        }else{
            //app首页推荐商品表
            $appcategood_database=D("Appcategood");
            $group_database=D("Group");
            foreach ($appcate as $key=>$value){
                //根据小banner的分组,找到推荐商品的分组
                $goods=$appcategood_database->where("cat_id = ".$value["id"])->select();
                foreach ($goods as $k=>$v){
                    //根据查的的推荐商品分组的商品id找到商品
                    $good=$group_database->where("group_id =".$v["group_id"])->find();
                    $goods[$k]["price"]=$good["price"];
                    $goods[$k]["pic"]=C('config.site_url')."/upload/appslider/".$v['pic'];
                }
                $appcate[$key]["goods"]=$goods;
                $appcate[$key]["pic"]=C('config.site_url')."/upload/appslider/".$value['pic'];
                //如果2时则为必买Top的样式,如果为3时,则是优品生活
                if($value["isthree"]==2){
                    $appcate[$key]["classify"]="topgoods_00";
                }else if($value["isthree"]==3){
                    $appcate[$key]["classify"]="premiumLife_00";
                }else if($value["isthree"]==4){
                    $appcate[$key]["classify"]="jingxuangoods_00";
                }
            }
        }
        $data=array();
        //将查询到的推荐分组,依次遍历给$data并返回
        foreach ($appcate as $kk=>$vv){
            $data[$kk]["styleID"]=$vv["classify"];
            $data[$kk]["header"]=1;
            $data[$kk]["headertype"]="2";
            $data[$kk]["title"]=$vv["name"];
            $data[$kk]["subtitle"]=$vv["desc"];
            $data[$kk]["image"]='1';
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
        $datas = array();
        foreach($data as $key=>$value){
            $datas = $value;
        }
        return $datas;
    }

    /**
     * 有品生活
     * @param string $isthree
     * @return array|bool|mixed
     */
    public function  getypBuyTop($isthree='0'){
        //app首页推荐表,小banner
        $appcate=D("Appcate")->where("status=1 AND isthree=".$isthree)->order("sort DESC")->select();
        if(empty($appcate)){
            return false;
        }else{
            //app首页推荐商品表
            $appcategood_database=D("Appcategood");
            $group_database=D("Group");
            foreach ($appcate as $key=>$value){
                //根据小banner的分组,找到推荐商品的分组
                $goods=$appcategood_database->where("cat_id = ".$value["id"])->select();
                foreach ($goods as $k=>$v){
                    //根据查的的推荐商品分组的商品id找到商品
                    $good=$group_database->where("group_id =".$v["group_id"])->find();
                    $goods[$k]["price"]=$good["price"];
                    $goods[$k]["pic"]=C('config.site_url')."/upload/appslider/".$v['pic'];
                }
                $appcate[$key]["goods"]=$goods;
                $appcate[$key]["pic"]=C('config.site_url')."/upload/appslider/".$value['pic'];
                //如果2时则为必买Top的样式,如果为3时,则是优品生活
                if($value["isthree"]==2){
                    $appcate[$key]["classify"]="topgoods_00";
                }else if($value["isthree"]==3){
                    $appcate[$key]["classify"]="premiumLife_00";
                }else if($value["isthree"]==4){
                    $appcate[$key]["classify"]="jingxuangoods_00";
                }
            }
        }
        $data=array();
        //将查询到的推荐分组,依次遍历给$data并返回
        foreach ($appcate as $kk=>$vv){
            $data[$kk]["styleID"]=$vv["classify"];
            $data[$kk]["header"]=1;
            $data[$kk]["headertype"]="2";
            $data[$kk]["title"]=$vv["name"];
            $data[$kk]["subtitle"]=$vv["desc"];
            $data[$kk]["image"]='1';
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
                $item[$kkk]["link"]=array("platform"=>"catlist","url"=>$vvv["desc"],"id"=>$vvv["desc"],"title"=>$vvv["name"]);
                $item[$kkk]["promotion"]=array("text"=>"","background"=>"");

            }
            $data[$kk]["items"]=$item;
        }
        //  $this->returnAjax($data,1);
        $datas = array();
        foreach($data as $key=>$value){
            $datas = $value;
        }
        return $datas;
    }




    //获取小banner和下面的商品
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
        //商品推荐表
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
    //首页的精品推荐板块
    public function getListnativegood($cat_id,$area_id){
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
    private function getNewfarm($cat_id,$area_id){
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
        $result=$app_spider->where($condition_where)->order("sort ASC")->select();
        $data=array();
        if(!empty($result)){
            foreach($result as $key=>$val){

                if(!empty($val['pic'])){
                    $data[$key]['image']=C('config.site_url')."/upload/appslider/".$val['pic'];
                }else{
                    $data[$key]['image']=$this->logo;
                }
                $data[$key]['id']=$val["url_id"];
                $data[$key]["title"]='';
                $data[$key]["subtitle"]='';
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
        $condition_where= "`g`.`status`='1' AND `g`.`index_tui`='1' and `g`.`is_group_buy` = '0' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`cat_id` <> 181 ";

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



















    //////////////////////////***********该死的分割线**************////////////////////////////////////////////

    /**
     * @return array
     * 猜你喜欢
     */
    public function  getallgoods(){
        $page=$_REQUEST["page"];
        $limit=empty($_REQUEST["limit"])?16:$_REQUEST["limit"];
        $now_time = $_SERVER['REQUEST_TIME'];
        $condition_where= "`g`.`status`='1' AND `g`.`is_group_buy`='0' AND `g`.`type`='1' AND `g`.`begin_time`< ".$now_time." AND `g`.`end_time`> ".$now_time." AND `g`.`cat_id` <> 181 AND `g`.`mer_id` <> 890 AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3246' AND `g`.`group_id` <> '3254' ";

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
                $data[$k]["title"]=$v["name"];
                $data[$k]["subtitle"]=$v["s_name"];
                $data[$k]["sale_count"]=intval($v["sale_count"])+intval($v["virtual_num"]);
                $data[$k]["origin_price"]=$v["old_price"];
                $data[$k]["current_price"]=$v["price"];
                $data[$k]["distance"]=0;
                //   $data[$k]["link"]=array("platform"=>"native","url"=>$v["group_id"]);
                $data[$k]["link"]=array("platform"=>"good","url"=>$v["group_id"],"id"=>$v["group_id"],"title"=>$v["s_name"]);
                $data[$k]["promotion"]=array("text"=>"","background"=>"");
            }
            $result=array("styleID"=>"youlike_00","header"=>1,"headertype"=>"1","title"=>"猜你喜欢","subtitle"=>"你不说，我都懂  你想吃，我全有","image"=>$this->logo,"link"=>array(),"items"=>$data);
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

        $sliderid=$_GET["sliderid"];
        if(!empty($sliderid)){
            $slider=D("App_slider")->where("id = ".$sliderid)->find();
        }

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
            $this->returnAjax("没有查询到相关数据",2);
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
        $end[0]["styleID"]="banner_02";
        $end[0]["header"]=0;
        $end[0]["headertype"]="1";
        $end[0]["title"]="";
        $end[0]["subtitle"]="";
        if(!empty($slider)){
            $end[0]["image"]=C('config.site_url')."/upload/appslider/".$slider['pic'];
        }else{
            $end[0]["image"]=$this->config["site_url"]."/upload/system/".$now_category['cat_pic'];
        }

        $end[0]["link"]=array("platform"=>"good","url"=>$now_category["cat_group_id"],"id"=>$now_category["cat_group_id"],"title"=>$now_category["cat_name"],"canjump"=>empty($now_category['cat_group_id'])?0:1);
     //   $end[0]["items"]=$data;


        $end[1]["styleID"]="menugoods_00";
        $end[1]["header"]=0;
        $end[1]["headertype"]="1";
        $end[1]["title"]="";
        $end[1]["subtitle"]="";
        $end[1]["image"]=$this->config["site_url"]."/upload/system/".$now_category['cat_pic'];
        $end[1]["link"]=array();
        $end[1]["items"]=$data;

//
//                $end[0]["styleID"]="menugoods_00";
//        $end[0]["header"]=0;
//        $end[0]["headertype"]="1";
//        $end[0]["title"]="";
//        $end[0]["subtitle"]="";
//        $end[0]["image"]=$this->config["site_url"]."/upload/system/".$now_category['cat_pic'];
//        $end[0]["link"]=array();
//        $end[1]["items"]=$data;
        $this->returnAjax($end,1);
    }


    public function  searchMenulistonlygoods()
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
            $this->returnAjax("没有查询到相关数据",2);
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

        $this->returnAjax($data,1);





    }


    public function  searchMenulistnew(){
        $sliderid=$_GET["sliderid"];
        if(!empty($sliderid)){
            $slider=D("App_slider")->where("id = ".$sliderid)->find();
        }
        $tagid=$_GET["tagid"];
        if(empty($sliderid)||empty($tagid)){
            $this->returnAjax("传参不对",2);
        }
        $now_time = $_SERVER['REQUEST_TIME'];
        $page=empty($_GET['page'])?1:$_GET['page'];
        $condition=" is_group_buy = 0 AND type=1 AND begin_time < ".$now_time." AND end_time > ".$now_time." AND mer_id <> 747 AND mer_id <> 621 AND mer_id <> 821 AND tags LIKE '%;".$tagid.";%'";
        $condition1=" is_group_buy = 0 AND type=1 AND begin_time < ".$now_time." AND end_time > ".$now_time." AND mer_id <> 747 AND mer_id <> 621 AND mer_id <> 821 AND tags LIKE '".$tagid.";%'";
         $sql=" select * from pigcms_group WHERE ".$condition." union ALL "."select * from pigcms_group WHERE ".$condition1." order by group_id DESC  LIMIT  ".(($page-1)*16)." ,16 ";
         $res=M()->query($sql);
        if(empty($res)){
            $this->returnAjax('未查询到数据',2);
        }else{

            $end[0]["styleID"]="banner_02";
            $end[0]["header"]=0;
            $end[0]["headertype"]="1";
            $end[0]["title"]="";
            $end[0]["subtitle"]="";
            if(!empty($slider)){
                $end[0]["image"]=C('config.site_url')."/upload/appslider/".$slider['pic'];
            }else{
                $end[0]["image"]="";
            }
            $end[0]["link"]=array("platform"=>"good","url"=>$slider["url_id"],"id"=>$slider['url_id'],"title"=>$slider['name'],"canjump"=>1);

            $groupimage=new group_image();
            $data=array();
            foreach ($res as $key=>$value){
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
            $end[1]["styleID"]="menugoods_00";
            $end[1]["header"]=0;
            $end[1]["headertype"]="1";
            $end[1]["title"]="";
            $end[1]["subtitle"]="";
            $end[1]["image"]=C('config.site_url')."/upload/appslider/".$slider['pic'];
            $end[1]["link"]=array();
            $end[1]["items"]=$data;

            $this->returnAjax($end,2);
        }

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
     * 下面的嵌套查询语句示例:
     *  SELECT * FROM `pigcms_group` WHERE group_id=(
            SELECT `group_id` FROM `pigcms_appcategood` WHERE cat_id=(
                SELECT id FROM `pigcms_appcate` WHERE (  status =1  AND isthree=2  ) ORDER BY sort DESC
            ) LIMIT 1
     *  )
     */
    public function  getAppcatethree($isthree){
        //app首页推荐表,小banner
        $appcate=D("Appcate")->where("status=1 AND isthree=".$isthree)->order("sort DESC")->select();
        if(empty($appcate)){
            return false;
        }else{
            //app首页推荐商品表
            $appcategood_database=D("Appcategood");
            $group_database=D("Group");
            foreach ($appcate as $key=>$value){
                //根据小banner的分组,找到推荐商品的分组
                $goods=$appcategood_database->where("cat_id = ".$value["id"])->select();
                foreach ($goods as $k=>$v){
                    //根据查的的推荐商品分组的商品id找到商品
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
        //将查询到的推荐分组,依次遍历给$data并返回
        foreach ($appcate as $kk=>$vv){
            $data[$kk]["styleID"]=$vv["classify"];
            $data[$kk]["header"]=0;
            $data[$kk]["headertype"]="1";
            $data[$kk]["title"]=$vv["name"];
            $data[$kk]["subtitle"]=$vv["desc"];
            $data[$kk]["image"]=$vv["pic"];
            $data[$kk]["link"]=array("platform"=>"good","url"=>$vv["cat_group_id"],"id"=>$vv["cat_group_id"],"title"=>$vv["name"],"canjump"=>empty($vv["cat_group_id"])?0:1);
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

    public function  getAppcatesix(){
        $appcate=D("Appcate")->where(" status =1  AND isthree=0 ")->order("sort DESC")->select();
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
                    $appcate[$key]["classify"]="classify_01";
                }else{
                    $appcate[$key]["classify"]="classify_02";
                }
            }


        }
        $data=array();
        foreach ($appcate as $kk=>$vv){
            $data[$kk]["styleID"]=$vv["classify"];
            $data[$kk]["header"]=1;
            $data[$kk]["headertype"]="2";
            $data[$kk]["title"]=$vv["name"];
            $data[$kk]["subtitle"]=$vv["desc"];
            $data[$kk]["image"]=$vv["pic"];
            $data[$kk]["link"]=array("platform"=>"good","url"=>$vv["cat_group_id"],"id"=>$vv["cat_group_id"],"title"=>$vv["name"],"canjump"=>empty($vv["cat_group_id"])?0:1);
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
        if(empty($result['url_id'])){
            $data["canjump"]=0;

        }else{
            $data["canjump"]=1;
        }
        if($result["status"]==1){
            $data["show"]=1;
        }else{
            $data["show"]=0;
        }
        if($result["iswebjump"]==1){
            if(empty($result['url_id'])){
                $data["link"]=array("platform"=>"web","url"=>htmlspecialchars_decode($result["url"]),"id"=>$result["url_id"],"title"=>$result["name"],"canjump"=>0);

            }else{
                $data["link"]=array("platform"=>"web","url"=>htmlspecialchars_decode($result["url"]),"id"=>$result["url_id"],"title"=>$result["name"],"canjump"=>1);
            }
        }else{
            if(empty($result['url_id'])){
                $data["link"]=array("platform"=>"good","url"=>$result["url"],"id"=>$result["url_id"],"title"=>$result["name"],"canjump"=>0);
            }else{
                $data["link"]=array("platform"=>"good","url"=>$result["url"],"id"=>$result["url_id"],"title"=>$result["name"],"canjump"=>1);
            }

        }



        $data["promotion"]=array("text"=>"","background"=>"");
        $end=$data;
        $this->returnAjax($end,1);


    }


    public function  gethometab(){
        $placeholder = empty($this->config["app_search_placeholder"])?"小农丁生鲜":$this->config["app_search_placeholder"];
        $this->returnAjax($this->getListtab($this->hometab,"","menulist"),1,$placeholder);

    }

    public function  gethometabnew(){
        $placeholder = empty($this->config["app_search_placeholder"])?"小农丁生鲜":$this->config["app_search_placeholder"];
        $this->returnAjax($this->getListtab($this->hometabnew,"","menulist"),1,$placeholder);
    }

    /**
     * @param $cat_id
     * @param $area_id
     * @return string
     *  * styleID    slider:轮播图,menu：菜单 ,banner: 大图banner,textbanner：跑马灯banner,goodrecommend ：精品推荐,classify ：分类推荐,farmrecommend ：农场推荐
     * category: styleID, title,subtitle,image,link,items
     * item:    id,image,title,subtitle,sale_count,origin_price,current_price,link(platform(web,native),url()'))
     */
    private function getListtab($cat_id,$area_id="all",$platform="good"){
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
//                if(!empty($val['pic'])){
//                    $data[$key]['image']=C('config.site_url')."/upload/appslider/".$val['pic'];
//                }else{
//                    $data[$key]['image']=$this->logo;
//                }
//                $data[$key]['id']=$key;
//                $data[$key]["title"]=$val["name"];
//                $data[$key]["subtitle"]=$val["desc"];
//                $data[$key]["sale_count"]=0;
//                $data[$key]["origin_price"]=0;
//                $data[$key]["current_price"]=0;
//                $data[$key]["distance"]=0;
//                //    $data[$key]["link"]=array("platform"=>"web","url"=>$val["url"]);
//                $data[$key]["link"]=array("platform"=>$platform,"url"=>$val["url"],"id"=>$val["url_id"],"title"=>$val["name"]);
//                $data[$key]["promotion"]=array("text"=>"","background"=>"");
                $data[$key]["id"]=$val["url_id"];
                $data[$key]["title"]=$val["name"];
                $data[$key]["selected"]=0;
                $data[$key]["sliderid"]=$val['id'];

        }
        array_unshift($data,array("id"=>"0","title"=>"推荐","selected"=>1,"sliderid"=>0));
            return $data;
        }else{
            return $data;
        }
    }

}