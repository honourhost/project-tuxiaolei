<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/10/12
 * Time: 16:05
 */
class XianshengAction extends BaseAction
{

    public   function  index(){

       $monday= mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y"));

       $mondaystr=date("Y年m月d日",mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y")));

       $todaystr=date("Y年m月d日");
      $this->assign("mondaystr",$mondaystr);
      $this->assign("todaystr",$todaystr);

      //本周推荐
      $weekrec=D("Adver")->where(array("cat_id"=>28))->order("sort DESC")->limit(4)->select();
       foreach ($weekrec as $key=>$value){

           $weekrec[$key]["pic"]="http://www.xiaonongding.com/upload/adver/".$value['pic'];
       }
        foreach ($weekrec as $key=>$value){
            $data=  explode("-", $value["desc"]);
            $weekrec[$key]["desc"]=$data[0];
            $weekrec[$key]["price"]=$data[1];

        }
       $this->assign("weekrec",$weekrec);

       //下周预告
       $trailerdata=D("Adver")->where(array("cat_id"=>29))->order("sort DESC")->limit(4)->select();
        foreach ($trailerdata as $key=>$value){

            $trailerdata[$key]["pic"]="http://www.xiaonongding.com/upload/adver/".$value['pic'];
        }
        foreach ($trailerdata as $key=>$value){
            $data=  explode("-", $value["desc"]);
            $trailerdata[$key]["desc"]=$data[0];
            $trailerdata[$key]["price"]=$data[1];

        }

        $this->assign("trailerdata",$trailerdata);


        $now_time = $_SERVER['REQUEST_TIME'];
        $condition_where= "`g`.`status`='1' AND `g`.`is_group_buy`='0' AND `g`.`type`='1' AND `g`.`begin_time`< ".$now_time." AND `g`.`end_time`> ".$now_time." AND `g`.`mer_id` = '890'";

        $condition_table = array(C('DB_PREFIX').'group'=>'g');

        $groups = D('')->table($condition_table)->where($condition_where)->limit(100)->select();
        $groupimage=new group_image();
        $keydata=D("Keywords");
        foreach ($groups as $key=>$value){
            $groups[$key]["pic"]=$groupimage->get_image_by_path($value["pic"],"s");
            if(!empty($value["picthumb"])){
                $tmp_pic_arr = explode(';',$value['picthumb']);
            }
            elseif (!empty($value["picapp"])){
                $tmp_pic_arr = explode(';',$value['picapp']);

            }else{
                $tmp_pic_arr = explode(';',$value['pic']);
            }
            $groups[$key]['thumb'] = $groupimage->get_image_by_path($tmp_pic_arr[0])['image'];
            $groups[$key]["keyword"]=$keydata->where(" third_id = ".$value['group_id']." AND third_type = 'group'")->find()['keyword'];
        }

        $this->assign("groups",$groups);








      $this->display();

}
}