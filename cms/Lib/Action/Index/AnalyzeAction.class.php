<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/2 0002
 * Time: 11:37
 */
class AnalyzeAction extends BaseAction
{

    /**
     * 根据省份  分析 订单交易额  订单总量
     */
    public function index(){
        $areas=D("area")->field("area_name")->where(array("area_pid"=>0))->select();
        $group_order=D("Group_order");
        $content=null;
        foreach ($areas as $key=>$value){
            $map['adress']=array('like','%'.$value["area_name"].'%');
            $map['paid']=1;
            $content[$value["area_name"]]=$group_order->field(" SUM(payment_money) as total,COUNT(total_money) as count")->where($map)->select();
          //  echo  D()->getLastSql(); die;



        }

        $map2["adress"]=array("eq","");
        $map['paid']=1;
        $other=$group_order->field("SUM(payment_money) as total,COUNT(total_money) as count")->where($map2)->select();
        $content['其他']=$other;
       $this->assign("content",$content);
     //   echo  json_encode($content);die;
        $this->display();
    }


    public function  analyzeUser(){
        $areas=D("area")->field("area_name")->where(array("area_pid"=>0))->select();
        $users=D("User");
        $content=null;
        foreach ($areas as $key=>$value){
            $map['province']=array('like','%'.$value["area_name"].'%');
            $content[$value["area_name"]]=$users->field(" COUNT(uid) as count")->where($map)->select();
        }
      $map2["province"]=array("eq","");
        $other=$users->field("COUNT(uid) as count")->where($map2)->select();
        $content['其他']=$other;
        $this->assign("content",$content);
        $this->display();
   //     echo  json_encode($content);die;

    }

    /**
     * top20单品分析
     */
    public function top20(){
        $sql="SELECT group_id,order_name,COUNT(*) as count FROM pigcms_group_order GROUP BY group_id  ORDER BY count DESC limit 20";
        $top20=D()->query($sql);
        foreach ($top20 as $key=>$value){
            $top20[$key]["count"]= $top20[$key]["count"];
        }
        $this->assign("content",$top20);
//        echo  json_encode($top20);die;
        $this->display();

}
}