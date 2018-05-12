<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/8/15
 * Time: 13:44
 */
class ZhunongAction extends  BaseAction
{


    public function  index(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！',U('Login/index'));
        }

        $user=D("User")->where(array("uid"=>$this->user_session["uid"]))->find();
        if(strpos($user,"http")===0){

        }else{
            $avatarimage=new avatar_image();
            if(strpos($user["avatar"],"http")===0){

            }else{
                $user['avatar']=$avatarimage->get_image_by_path($user['avatar'],"http://www.xiaonongding.com")["image"];

            }


        }
        $this->assign("user",$user);
        $topic=strval($_GET['topic']);
        $chan_where=array(
            "url"=>$topic,
            "status"=>1
        );
        //查询频道名称
        $channel=D("Channel")->where($chan_where)->find();
        //echo json_encode($this->getCatGoodsLists($channel['id']));
        $this->assign("channel",$channel);
        $goods=$this->getCatGoodsLists($channel['id']);
        $count=0;
        foreach ($goods as $key=>$value){
            $count+=$value['success_num'];
            $count+=$value["virtual_num"];

        }
        $zhunongshare=D("Zhunongshare")->find();
        $this->assign("zhunongshare",$zhunongshare["zhunongshare"]);
        $this->assign("goods",$goods);
        $this->assign("successnum",$count);
       // echo  json_encode($user);die;


        //众筹

        $crowdfunding=D("Crowdfunding")->field("title,digest,hit,webpic,mer_id,crowd_id,progress,invator,invatorpic,crowdplace")->where(" status = 1 ")->order("crowd_id DESC")->find();
        $group_image_class = new group_image();
        $crowdfunding['invatorpic']=$group_image_class->get_image_by_path($crowdfunding['invatorpic'], 's');
        $crowdfunding['webpic']=  $group_image_class->get_image_by_path($crowdfunding['webpic'], 's');
        $this->assign("crowdfunding",$crowdfunding);
        $this->display();
    }


    function getCatGoodsLists($id){
        if(!empty($id)){
            $goods=D("Channel_category_goods")->where("c_id=".$id)->order("create_time ASC")->select();
            $goods=array_filter($goods);
            if(!empty($goods)){
                foreach($goods as $key=>$val){
                    $list[]=D('Group')->get_group_by_groupId($val['goods_id']);
                }

                 return $list;
              //  return  $this->my_sort($list,"create_time",SORT_ASC,SORT_NUMERIC);
            }else{
                return "";
            }
        }else{
            return "";
        }
    }

    function my_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC ){
        if(is_array($arrays)){
            foreach ($arrays as $array){
                if(is_array($array)){
                    $key_arrays[] = $array[$sort_key];
                }else{
                    echo "123456";
                    return false;
                }
            }
        }else{

            return false;
        }
        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
        return $arrays;
    }
}