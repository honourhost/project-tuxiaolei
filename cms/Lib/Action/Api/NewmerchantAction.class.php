<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/7/3
 * Time: 18:26
 */
class NewmerchantAction extends NewbaseAction
{


    public function merchantinfo()
    {
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

        if(empty($result)){
            $this->returnAjax("no data",0);
        }

      //  echo json_encode($result);die;

        $data["mer_id"]=$result["mer_id"];
        $data["mer_name"]=$result["name"];
        $data["personname"]=$result["person_name"];
        $data["mer_desc"]=$result["txt_info"];
        $data["avatar"]=$result["person_image"];
        $data["theme"]=$result['merchant_theme_image'];
        $data["share_url"]="http://www.xiaonongding.com/wap.php?g=Wap&c=Index&a=index&token=".$data["mer_id"];
        $areainfo=D("Area")->where(array("area_id"=>$result["area_id"]))->find();
        if(!empty($areainfo)){
            $data["area"]=$areainfo["area_ip_desc"];
        }else{
            $data["area"]="";
        }
        $data["distance"]=$result["distance"];
        $this->returnAjax($data,1);
    }

    public function  merchantgoods(){
        $mer_id=$_GET['mer_id'];
        if(empty($mer_id)){
            $this->returnAjax("没有获取到id值",0);
        }
        $now_time = $_SERVER['REQUEST_TIME'];
        $page=empty($_GET["page"])?1:$_GET["page"];
        $limit=empty($_GET["limit"])?16:$_GET["limit"];
        $countnum=D("Group")->where("mer_id = ".$mer_id." AND type=1 AND is_group_buy = 0  AND status = 1 AND begin_time < ".$now_time." AND end_time > ".$now_time)->count();
        $pagecount=ceil($countnum/$limit);
        if($pagecount<$page){
            $this->returnAjax("超出最大页码了",2);
        }
        $group_list=D("Group")->where("mer_id = ".$mer_id." AND type=1 AND is_group_buy = 0  AND status = 1 AND begin_time < ".$now_time." AND end_time > ".$now_time)->page($page,$limit)->order("sort desc,group_id desc")->select();
        if(!empty($group_list)){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$val){
                foreach($group_list as $k=>$v){
                    $tmp_pic_arr = explode(';',$v['pic']);
                    $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
                    $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
                }
            }

            $data=array();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                $data[$k]['image'] = $v["list_pic"];
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
            $result[0]=array("styleID"=>"merchantgoods_00","header"=>1,"title"=>"农场商品","subtitle"=>"农场商品","image"=>$this->baseurl."/xnd.png","link"=>array(),"items"=>$data);
            $this->returnAjax($result, 1);
        }

      //  echo  json_encode($group_list);



    }


    public function get_group_url($group_id){
        return C('config.site_url').'/api.php?g=Api&c=Group&a=detail&group_id='.$group_id;
    }


}