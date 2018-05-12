<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/3/30
 * Time: 11:16
 */
class ElseAction extends BaseAction{
    //发布会人员列表
    public function conference(){
        import('@.ORG.system_page');
        $count = D("Conference")->count();
        $p = new Page($count, 20);
        $res=D("Conference")->limit($p->firstRow.','.$p->listRows)->select();
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);
        $this->assign("persons",$res);
        $this->display();
    }


    public function  fastcash(){
        $map["id"]=array("neq",6);
      $marketers=  D("Marketers")->where($map)->select();

        $merchant=D("Merchant");
        $fastorder=D("FastOrder");
        $today = strtotime(date('Ymd'));;
       foreach ($marketers as $key=>$value){
          $relamerchant= $merchant->field("mer_id")->where(array("marketer_id"=>$value['id']))->select();
           $payconut=0;
           $paytoday=0;
           foreach ($relamerchant as $key1=>$value1){
           $temp=    $fastorder->field("SUM(payment_money) as totalmoney")->where(array("mer_id"=>$value1["mer_id"]))->find();
               $map["add_time"]=array("gt",$today);
               $map["mer_id"]=$value1["mer_id"];
               $temp1=    $fastorder->field("SUM(payment_money) as totalmoney")->where($map)->find();
            //   echo  D()->getLastSql();die;
              if($temp["totalmoney"]!=null){
                  $payconut+=$temp["totalmoney"];
              }

               if($temp1["totalmoney"]!=null){
                   $paytoday+=$temp1["totalmoney"];
               }


           }

           $marketers[$key]["totalmoney"]=$payconut;
           $marketers[$key]["totaltoday"]=$paytoday;



       }

       $this->assign("marketers",$marketers);
 //echo  json_encode($marketers);die;
        $this->display();

    }

    /**
     * 首先列出所有的市场人员
     */
    public function  single(){

        $marketers=D("Marketers")->where(array("id"=>array("neq",6)))->select();
        $this->assign("marketers",$marketers);
       // echo json_encode($marketers);die;
        $this->display();

    }


    public function  singlelist(){
        $mar_id=$_GET["mar_id"];
        if(empty($mar_id)){
            $this->error_tips("市场人员id不能为空");
            return;
        }

        $count=D("Product")->where(array("marketer_id"=>$mar_id))->count();
        import('@.ORG.Page');
        $p = new Page($count, 20);
        $result=D("Group")->field("group_id,is_group_buy,s_name,name,price,old_price,begin_time,end_time,status,tuan_type,is_first_free,is_lottery_group_buy,remarks,deadline_time,sale_count")->where(array("marketer_id"=>$mar_id))->order("group_id DESC")->limit($p->firstRow.','.$p->listRows)->select();
     //   echo  D()->getLastSql();die;
       $pagebar= $p->show();
        $this->assign("group_list",$result);
        $this->assign("pagebar",$pagebar);
        $this->display();

      //  echo  json_encode($result);die;
    }
}