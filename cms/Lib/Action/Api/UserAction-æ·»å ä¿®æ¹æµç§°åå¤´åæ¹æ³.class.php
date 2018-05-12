<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/5
 * Time: 16:03
 */
class UserAction extends BaseAction{
    public function index(){
        //p为页码
        //根据get到的status值判断对应的查询
        //全部没有status
        //待付款status=1
        //待收货status=2
        //待评价status=3
        //根据传来的参数判断选择的订单内容
        //因为目前
        $result=D('Group')->getMobileOrderList($this->now_user['uid'],intval($_GET['status']),true);
        //循环根据结果类型区分所取图片类
        $meal_image=new store_image();
        $group_image=new group_image();
        foreach($result as $key=>$val){
            if($val['name']==1){
                $meal_list_pics=$meal_image->get_allImage_by_path($val['image']);;
                $result[$key]['list_pic']=$meal_list_pics[0];
            }else{
                $group_list_pics=$group_image->get_allImage_by_path($val['image']);
                $result[$key]['list_pic']=$group_list_pics[0]['image'];
            }
        }
        $result=array_filter($result);
        if(!empty($result)) {
            $this->returnAjax($result, 1);
        }else{
            $this->returnAjax("没查到当前用户的订单信息！",0);
        }
    }
}