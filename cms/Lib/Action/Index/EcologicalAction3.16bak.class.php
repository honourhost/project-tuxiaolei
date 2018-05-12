<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/22 0022
 * Time: 13:31
 */
class EcologicalAction extends BaseAction
{

    public function  index(){
        $topleft=$this->merchant_list(25);
        $topright=$this->merchant_list(26);
         $this->assign("topleft",$topleft);
        $this->assign("topright",$topright);
        $fenlei["生态游"]["cat_id"]=3;
        $fenlei["生态游"]["pic"]="http://www.xiaonongding.com/upload/adver/000/000/001/58b8c9d24e0aa.jpg";
        $fenlei["生态游"]["title"]="生态游";
        $fenlei["生态游"]["cat_url"]="sty";
        $fenlei["主题游"]["cat_id"]=151;
        $fenlei["主题游"]["pic"]="http://www.xiaonongding.com/upload/adver/000/000/001/58b8c9d24e0aa.jpg";
        $fenlei["主题游"]["title"]="主题游";
        $fenlei["主题游"]["cat_url"]="maintitle";
       foreach ($fenlei as $key=>$value){
             $childcategory= D("Group_category")->where(array("cat_fid"=>$value["cat_id"]))->select();

           foreach($childcategory as $key1=>$value1){
               $map["end_time"]=array("gt",time());
               $map["cat_id"]=$value1['cat_id'];
             $childgroups=  D("Group")->field("group_id,cat_id,name,s_name,price,old_price,pic")->where($map)->limit(8)->order("group_id DESC")->select();
               $group_image=new group_image();
               foreach ($childgroups as $key2=>$value2){
                   $tmp_pic_arr = explode(';', $childgroups[$key2]['pic']);
                   $childgroups[$key2]['pic']=$group_image->get_image_by_path($tmp_pic_arr[0]);

               }

               $topfive=D("Group")->field("group_id,cat_id,name,s_name,sale_count,virtual_num")->where($map)->limit(5)->order("sale_count+virtual_num DESC")->select();
               foreach ($topfive as $key3=>$value3){
                   if(mb_strlen($value3['s_name'],'UTF8')>8){
                //   $topfive[$key3]['s_name'] =   str_replace(substr($value3["s_name"],5),$value3["s_name"],"...");
                       $topfive[$key3]['s_name'] =   mb_substr($value3["s_name"],0,8,"UTF8");
                   }
               }



               $childcategory[$key1]["groups"]=$childgroups;
               $childcategory[$key1]["topfile"]=$topfive;


           }
          $fenlei[$key]["childfenlei"]=$childcategory;


       }
 //echo  json_encode($fenlei);die;
       $this->assign("fenlei",$fenlei);

        $this->display();
    }

    /**
     * 获取生态游顶部分类广告列表
     * @param $cat_id
     * @return mixed
     */
    protected function merchant_list($cat_id){


        $database_adver = D('Adver');
        $condition_adver['cat_id'] = $cat_id;
        $merchant_list = $database_adver->field(true)->where($condition_adver)->order('`id` DESC')->select();
        foreach ($merchant_list as $key=>$value){

            $merchant_list[$key]['pic']="http://www.xiaonongding.com/upload/adver/".$merchant_list[$key]['pic'];
        }


        return $merchant_list;
    }



}