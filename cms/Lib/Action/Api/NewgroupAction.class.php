<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/23
 * Time: 15:54
 */
class NewgroupAction extends  NewbaseAction
{

    public function  detail(){
        $groupid=$_REQUEST["groupid"];
        $Model=new Model();
        $sql="SELECT g.name as group_name,g.group_id,g.end_time,g.s_name,g.price,g.intro,g.content,g.cat_id,g.cat_fid,g.old_price,g.pic,g.picapp,g.reply_count,ms.* FROM "
            .C('DB_PREFIX')."group g LEFT JOIN (SELECT m.*,s.long,s.lat FROM ".C('DB_PREFIX')."merchant m LEFT JOIN ".C('DB_PREFIX').
            "merchant_store s ON m.mer_id=s.mer_id WHERE s.ismain=1 AND s.status=1) as ms ON g.mer_id=ms.mer_id WHERE g.group_id=".$groupid." ";
        $result=$Model->query($sql);
        $address="";
        if(!empty(session("user"))){
            $uid=$_SESSION["user"]["uid"];
            $uaddress=D("User_adress")->get_one_adress($uid);
            if(!empty($uaddress)){
                $address=$uaddress['province_txt']." ".$uaddress['city_txt']." ".$uaddress['area_txt']." ".$uaddress['adress'];
            }
        }
        if(empty($result)){
            $this->returnAjax("未获取到商品信息",0);
        }else{
            $groupimage=new group_image();
     //  $result[0]['pic']= $groupimage->get_allImage_by_path($result[0]['pic'],"s");

           if (!empty($result[0]["picapp"])){
            //    $tmp_pic_arr = explode(';',$result[0]['picapp']);
               $result[0]['pic']= $groupimage->get_allImage_by_path($result[0]['picapp'],"s");
            }else{
             //   $tmp_pic_arr = explode(';',$result[0]['pic']);
               $result[0]['pic']= $groupimage->get_allImage_by_path($result[0]['pic'],"s");
            }
           // $result[0]['pic'] = $groupimage->get_image_by_path($tmp_pic_arr[0])['image'];
           $result[0]["city"]=getRealAreaName($result[0]["area_id"]);
           if($result[0]["reply_count"]){
               $reply_list = D('Reply')->get_reply_list2($groupid,0,1,3);
             //  echo  json_encode($reply_list);die;
               $replydata=array();
               foreach($reply_list as $key=>$value){
                   if($value['anonymous']){
                       $reply_list[$key]['nickname']="匿名用户";
                   }
                   $replydata[$key]["id"]=$value["uid"];
                   $replydata[$key]["icon"]=$value["avatar"];
                   $replydata[$key]["username"]=$value["nickname"];
                   $replydata[$key]["rating"]=$value["score"];
                   $replydata[$key]["comments"]=$value["comment"];
                   $replydata[$key]["images"]=$value["pics"];
                   $replydata[$key]['add_time'] = $value['add_time'];
               }
               $result["0"]["comments"]=$replydata;
           }else{
               $result["0"]["comments"]=array();
           }

            //推荐分类产品
            $category_group_list = D('Group')->get_grouplist_by_catId($result[0]["cat_id"],$result[0]['cat_fid'],5,true);
            //  $puregoods=array();
            foreach($category_group_list as $key=>$value){
                if($value['group_id'] == $result[0]['group_id']){
                    unset($category_group_list[$key]);
                }
            }
            $category_group_list=array_values($category_group_list);
           //  $this->returnAjax($category_group_list,1);
            foreach ($category_group_list as $key=>$value){
                $puregoods[$key]["id"]=$value["group_id"];
                $puregoods[$key]["image"]=$value["list_pic"];
                $puregoods[$key]["title"]=$value["group_name"];
                $puregoods[$key]["subtitle"]=$value["s_name"];
                $puregoods[$key]["current_price"]=$value["price"];
            }
            $result[0]["recommendgoods"]=$puregoods;
      $dataend["images"]=$result[0]["pic"];
      $dataend["id"]=$result[0]["group_id"];
      $dataend["mer_id"]=$result[0]["mer_id"];
      $dataend["title"]=$result[0]["group_name"];
      $dataend["subtitle"]=$result[0]["s_name"];
      $dataend["origin_price"]=$result[0]["old_price"];
      $dataend["current_price"]=$result[0]["price"];
      $dataend["city"]=$result[0]["city"];
      $dataend["transportation"]="坏品包赔";
      $dataend["picking"]="农场直供";
      $dataend["share_url"]="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id=".$dataend["id"];
      $dataend["good_details"]="http://www.xiaonongding.com".U("Newgroup/mobiledetail",array("groupid"=>$groupid));
      $dataend["comment_count"]=$result[0]["reply_count"];
      $dataend["comments"]=$result[0]["comments"];
      $dataend["recommend_items"]=$puregoods;
      $dataend['adress']=$address;


            $now=time();
            if($now<$result[0]['end_time']){
                $result[0]["expired"]=0;
            }else{
                $result[0]["expired"]=1;
            }
     $dataend['expired']=$result[0]["expired"];
            if(empty($_GET["uid"])||empty($_GET["groupid"])){
                $dataend["collected"]=0;
            }else{

                if(D("User_collect")->where("type = 'group_detail' AND id =".$_GET["groupid"]." AND uid = ".$_GET["uid"])->find()){
                   $dataend["collected"]=1;
                }else{
                    //  echo  json_encode(D()->getLastSql());die;
                    $dataend["collected"]=0;
                }
            }
       $this->returnAjax($dataend,1);
        }
    }

    /**
     * 手机端详情
     */
    public function  mobiledetail(){
        $groupid=$_REQUEST["groupid"];
        $group=D("Group")->where(array("group_id"=>$groupid))->find();
        $this->assign("content",$group["content"]);
        $this->display();
    }

    /**
     * 评论列表
     */
    public function  replylist(){
        $condition_order = '`r`.`add_time` DESC';
        $page=$_GET["page"];
        $group_id=$_GET["group_id"];
        $groupnow=D("Group")->where("group_id = ".$group_id)->find();
        $replycount=D("Reply")->where("parent_id = ".$group_id)->count();
        $pagecount=ceil($replycount/15);
        if($page>$pagecount){
            $this->returnAjax("未获取到评论数据",2);
        }
        $reply_list = D('')->field('`u`.`nickname`,`u`.`avatar`,`r`.*')->table(array(C('DB_PREFIX').'reply'=>'r',C('DB_PREFIX').'user'=>'u'))->where("`r`.`parent_id`='$group_id' AND `r`.`uid`=`u`.`uid`")->order($condition_order)->page($page,15)->select();

        if($reply_list){
            $pic_arr = array();
            $new_pic_arr = array();
            $userimages=new avatar_image();
            foreach($reply_list as $key=>$value){
                $reply_list[$key]['add_time'] = date('Y-m-d',$value['add_time']);
                if(empty($value["avatar"])){
                    $reply_list[$key]['avatar']="http://www.xiaonongding.com/xnd.png";
                }else{

                    if((strpos($value["avatar"],"http")===0)){

                    }else{
                        $image_tmp = explode(',',$value["avatar"]);
                        $reply_list[$key]['avatar']="http://www.xiaonongding.com".'/upload/avatar/'.$image_tmp[0].'/'.$image_tmp['1'];

                    }
                }
                if(!empty($value['pic'])){
                    $tmp_arr = explode(',',$value['pic']);
                    foreach($tmp_arr as $v){
                        $new_pic_arr[$v] = $key;
                    }
                    $pic_arr = array_merge($pic_arr,$tmp_arr);
                }
            }

                $pic_filepath = 'group';

            if($pic_arr){
                $condition_reply_pic['pigcms_id'] = array('in',implode(',',$pic_arr));
                $reply_pic_list = D('Reply_pic')->field('`pigcms_id`,`pic`')->where($condition_reply_pic)->select();
                $reply_image_class = new reply_image();
                foreach($reply_pic_list as $key=>$value){
                    $tmp_value=$reply_image_class->get_image_by_path($value['pic'],$pic_filepath)['image'];
                   // $tmp_value = $img[0];
                    $reply_list[$new_pic_arr[$value['pigcms_id']]]['pics'][] = $tmp_value;
                }
            }
           // echo  json_encode($reply_list);die;
            $replydata=array();
            foreach($reply_list as $key=>$value){
                if($value['anonymous']){
                    $reply_list[$key]['nickname']="匿名用户";
                }
                $replydata[$key]["id"]=$value["uid"];
                $replydata[$key]["icon"]=$value["avatar"];
                $replydata[$key]["username"]=$value["nickname"];
                $replydata[$key]["rating"]=$value["score"];
                $replydata[$key]["comments"]=$value["comment"];
                $replydata[$key]["images"]=$value["pics"];
                 $replydata[$key]["add_time"]=$value["add_time"];
                 $replydata[$key]["goodtitle"]=$groupnow["name"];
                $replydata[$key]["goodsubtitle"]=$groupnow["s_name"];
            }
            $this->returnAjax($replydata,1);
        }else{
            $this->returnAjax("没有评论数据",2);
        }
    }

    public function  isgroupcollected(){

        if(empty($_GET["uid"])||empty($_GET["group_id"])){
            $this->returnAjax("缺少参数",0);
        }else{

            if(D("User_collect")->where("type = 'group_detail' AND id =".$_GET["group_id"]." AND uid = ".$_GET["uid"])->find()){
                $this->returnAjax(array("collect"=>1),1);
            }else{
              //  echo  json_encode(D()->getLastSql());die;
                $this->returnAjax(array("collect"=>0),1);
            }
        }
    }


    public function test(){
//        $areadata=D("Area");
//    $province=   $areadata ->field("area_id,area_pid,area_name")->where("area_pid =0 ")->select();
//    foreach ($province as $key=>$value){
//        $province[$key]["city"]=$areadata->field("area_id,area_pid,area_name")->where("area_pid = ".$value["area_id"])->select();
//        foreach ($province[$key]["city"] as $k=>$v){
//            $province[$key]["city"][$k]["area"]=$areadata->field("area_id,area_pid,area_name")->where("area_pid = ".$v["area_id"])->select();
//        }
//    }
//   file_put_contents("xndarea.txt",json_encode($province),FILE_APPEND);
//    echo  json_encode($province);
     $arraysss=array("a","b","C");


        foreach ($arraysss as $key=> $value) {
            if($value===a){
                unset($arraysss[$key]);
            }
     }
        echo  json_encode($arraysss);die;
    }

}