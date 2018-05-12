<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/23
 * Time: 10:40
 */
class NewcategoryAction extends  NewbaseAction
{
   private  $placeholder;   //搜索占位
    private $baseurl;  //网站地址

    public function __construct()
    {

        parent::__construct();
        $this->placeholder = empty($this->config["app_category_placeholder"])?"小农丁生鲜":$this->config["app_category_placeholder"];
        $this->baseurl=$this->config["site_url"];
    }


    /**
     * 分类  热门分类  排除 生态游和花卉
     */
    public function  categoryList(){

        $database_group_category = D('Group_category');
        $condition_group_category['cat_fid'] = intval(0);
        $condition_group_category['cat_status'] = 1;


        $category_list = $database_group_category->field("cat_id as id , cat_name as title ")->where("cat_fid = 0 AND cat_status = 1 AND  is_hot = 1 AND cat_id NOT IN (1,3) ")->order('`cat_sort` DESC,`cat_id` ASC')->select();
       // echo  D()->getLastSql();die;
        if(!empty($category_list)){

            $this->returnAjax($category_list,1,$this->placeholder);
        }else{
            $this->returnAjax("没有查找到分类",0);
        }



    }

    /**
     * 分类详情
     */

    public function  categoryDetail(){
        $cid=$_REQUEST["cid"];
        $database_group_category = D('Group_category');
        $condition_group_category['cat_fid'] = intval(0);
        $condition_group_category['cat_id'] = $cid;
        $condition_group_category['cat_status'] = 1;
       $cateparent= $database_group_category->field("cat_id,cat_name,cat_desc,cat_url,cat_pic,cat_group_id")->where($condition_group_category)->find();


        if(empty($cateparent)){
            $this->returnAjax("没有查找到分类",0);
        }else{
            if(!empty($cateparent["cat_pic"])){
                $cateparent["cat_pic"]=$this->baseurl."/upload/system/".$cateparent["cat_pic"];
            }else{
                $cateparent["cat_pic"]=$this->baseurl."/xnd.png";
            }
            $conditionnew["cat_fid"]=intval($cid);
            $conditionnew["cat_status"]=1;
            $conditionnew["is_hot"]=1;
            $catechildren=$database_group_category->field("cat_id,cat_name,cat_desc,cat_url,cat_pic")->where($conditionnew)->select();
            $dataarray=array();
            foreach ($catechildren as $ke=>$va){
                if($ke==0){
                    $cateparent["ccid"]=$va["cat_id"];
                }
                $dataarray[$ke]["title"]=$va["cat_name"];
                $dataarray[$ke]['image']=!empty($va["cat_pic"])?$this->baseurl."/upload/system/".$va["cat_pic"]:$this->baseurl."/xnd.png";
           //     $dataarray[$ke]['link']=array("platform"=>"native","url"=>$va["cat_id"]);
                $dataarray[$ke]['link']=array("platform"=>"catlist","url"=>$va["cat_id"],"id"=>$va["cat_id"],"title"=>$va["cat_name"]);
                $dataarray[$ke]['id']=$va["cat_id"];

            }
            //   $data[$k]["link"]=array("platform"=>"good","url"=>$v["group_id"],"id"=>$v["group_id"],"title"=>$v["s_name"]);
           // $dataend[0]=array("styleID"=>"banner_01","header"=>0,"title"=>$cateparent["cat_name"],"subtitle"=>$cateparent["cat_desc"],"image"=>$cateparent["cat_pic"],"link"=>array("platform"=>"native","url"=>$cateparent["ccid"]),"items"=>array(0=>array("title"=>$cateparent["cat_name"],"image"=>$cateparent["cat_pic"],"link"=>array("platform"=>"native","url"=>$cateparent["ccid"]))));
            $dataend[0]=array("styleID"=>"banner_01","header"=>0,"title"=>$cateparent["cat_name"],"subtitle"=>$cateparent["cat_desc"],"image"=>$cateparent["cat_pic"],
                "link"=>array("platform"=>"good","url"=>$cateparent["cat_group_id"],"id"=>$cateparent["cat_group_id"],"title"=>$cateparent["cat_name"]),"items"=>array(0=>array("title"=>$cateparent["cat_name"],"image"=>$cateparent["cat_pic"],
                    "link"=>array("platform"=>"catlist","url"=>$cateparent["ccid"],"id"=>$cateparent["ccid"],"title"=>$cateparent["cat_name"]))));
            $dataend[1]=array("styleID"=>"catedetail_00","header"=>1,"title"=>$cateparent["cat_name"],"subtitle"=>$cateparent["cat_desc"],"image"=>$cateparent["cat_pic"],"link"=>array(),"items"=>$dataarray);
           // $dataend[0]=array("styleId"=>"banner_01","image"=>$cateparent["cat_pic"],"link"=>array("platform"=>"native","url"=>$cateparent["ccid"]),"title"=>$cateparent["cat_name"],"subtitle"=>$cateparent["cat_desc"],"items"=>$dataarray);
          $this->returnAjax($dataend,1);
        }



    }


    /**
     * 该分类的产品 排序规则  order :  1： 时间降序  2 ：时间升序  3： 价格降序  4 :价格升序   5 ： 销量降序 6: 价格升序   默认1时间降序
     */
    public function  categoods(){
        $order=empty($_GET["order"])?1:$_GET["order"];   //排序
        $page=empty($_GET["page"])?1:$_GET["page"];     //页码
        $cid=$_GET["cid"];  //分类id
        $gcat=D("Group_category")->where("cat_id = ".$cid)->find();
      //  echo  D()->getLastSql();die;
        if(empty($gcat)){
            $this->returnAjax("不存在的分类",0);
        }
        $limit=empty($_REQUEST["limit"])?16:$_REQUEST["limit"];

        switch ($order){
            case 1:
                $orderstring=" group_id DESC ";
                break;
            case 2:
                $orderstring=" group_id ASC ";
                break;
            case 3:
                $orderstring=" price DESC ";
                break;
            case 4:
                $orderstring=" price ASC ";
                break;
            case 5:
                $orderstring=" sale_count DESC ";
                break;
            case 6:
                $orderstring=" sale_count ASC ";
                break;
            default:
                $orderstring=" group_id DESC ";
                break;
        }

        $conditionwhere=" cat_id = ".$cid." AND is_group_buy = 0 AND begin_time < ".$_SERVER['REQUEST_TIME']." AND end_time > ".$_SERVER['REQUEST_TIME']." AND status = 1 AND type = 1 ";
        $count=D("Group")->where($conditionwhere)->count();
        $pagecount=ceil($count/intval($limit));
        if($pagecount<$page){
            $this->returnAjax("超出最大页码了",2);
        }
        else{
            $group_list=D("Group")->where($conditionwhere)->order($orderstring)->page($page,$limit)->select();
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
                   // $tmp_pic_arr = explode(';',$v['pic']);
                    $data[$k]['image'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
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
                $result[0]=array("styleID"=>"catgoods_00","header"=>0,"title"=>$gcat["cat_name"],"subtitle"=>$gcat["cat_name"],"image"=>!empty($gcat["cat_pic"])?$this->baseurl."/upload/system/".$gcat["cat_pic"]:$this->baseurl."/xnd.png","link"=>array(),"items"=>$data);
                $this->returnAjax($result, 1);
            }else{
                $this->returnAjax("没有获取到数据",0);
            }

        }


    }
}