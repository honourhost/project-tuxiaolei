<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/9/7
 * Time: 14:28
 */
class NewmyAction extends NewbaseAction
{

    private $cat_id=29;
    private  $commontools=31;  //常用工具
     public function showad(){
         $this->returnAjax($this->getListgood($this->cat_id),1);

     }

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
        $result=$app_spider->where($condition_where)->order("sort DESC")->find();

        $data["image"]=C('config.site_url')."/upload/appslider/".$result['pic'];
        $data["url"]=htmlspecialchars_decode($result["url"]);
        $data["title"]=$result["name"];
        return $data;

    }

    /**(
     * 常用工具API
     */

    public function  commonTools(){
        $data[0]['title']="常用工具";
        $data[0]['items']=$this->getList($this->commontools);
        $this->returnAjax($data,1,"",4);

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
                    $data[$key]['image_url']=C('config.site_url')."/upload/appslider/".$val['pic'];
                }else{
                    $data[$key]['image_url']=$this->logo;
                }
                $data[$key]["title"]=$val["name"];
                if(empty($this->user_session)){
                    $data[$key]["subtitle"]="";
                    $data[$key]["link"]=array("platform"=>$val['url_id'],"subtitle"=>"",'msg'=>htmlspecialchars_decode($val['url']),"url"=>htmlspecialchars_decode($val['url']));

                }else{
                    $now=$_SERVER["REQUEST_TIME"];
                    $uid=$_GET["uid"];
                    $condition="uid =".$uid;
                    $condition.=" AND comfirmed = 0 AND endtime > ".$now;
                    $result=D("Usercoupon")->where($condition)->order("id DESC")->count();
                    if($val["url_id"]=="transToDiscount"){
                        if($result>0){
                            $data[$key]["subtitle"]=$result."张可用";
                            $data[$key]["link"]=array("platform"=>$val['url_id'],"subtitle"=>$result."张可用",'msg'=>htmlspecialchars_decode($val['url']),"url"=>htmlspecialchars_decode($val['url']));

                        }else{
                            $data[$key]["subtitle"]="";
                            $data[$key]["link"]=array("platform"=>$val['url_id'],"subtitle"=>"",'msg'=>htmlspecialchars_decode($val['url']),"url"=>htmlspecialchars_decode($val['url']));

                        }

                    }else{
                        $data[$key]["subtitle"]="";
                        $data[$key]["link"]=array("platform"=>$val['url_id'],"subtitle"=>empty($val["desc"])?"":$val['desc'],'msg'=>htmlspecialchars_decode($val['url']),"url"=>htmlspecialchars_decode($val['url']));

                    }

                }
            }
            return $data;
        }else{
            return $data;
        }
    }

    /**
     * 获取待发货 待收货数量
     */
    public function getOrdercount(){
        $this->verifyLogin();
        $data['waitpaycount']=D("Group_order")->where(array("paid"=>0,"uid"=>$this->user_session['uid'],'status'=>0))->count();
        $data['waitsendcount']=D("Group_order")->where(array("paid"=>1,"uid"=>$this->user_session['uid'],"status"=>0,"user_confirm"=>0))->count();
        $this->returnAjax($data,1,"",1);


    }

    //验证登录
    private function verifyLogin(){
        if (empty($this->user_session)) {
            $this->returnAjax("请先登录才能查看用户的相关信息!",0);
        }
        $now_user = d('User')->get_user($this->user_session['uid']);
        if (empty($now_user)) {
            $this->returnAjax("未获取到您的帐号信息，请重试！",0);
        }
        $now_user['now_money'] = floatval($now_user['now_money']);
        $this->now_user = $now_user;
    }
}