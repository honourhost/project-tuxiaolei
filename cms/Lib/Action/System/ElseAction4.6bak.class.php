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
        $today = strtotime(date('Ymd'));
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


    public function allstatis(){

        //统计本周订单  本月订单  本周导入  本月导入     本周实际  本月实际
        $thisweekgroupsum=D("Group_order")->get_all_oreder_sum("week");
        $thismonthgroupsum=D("Group_order")->get_all_oreder_sum("month");

        $thisweekgroupimportsum=D("Group_order")->get_all_oreder_sum_import("week",812);
        $thismonthgroupimportsum=D("Group_order")->get_all_oreder_sum_import("month",812);

        $thisweekfastsum=D("FastOrder")->get_all_oreder_sum("week");
        $thismonthfastsum=D("FastOrder")->get_all_oreder_sum("month");
        echo "特卖流水统计：<br>";
        echo  "本周特卖总流水：".$thisweekgroupsum."<br>"."本月特卖总流水：".$thismonthgroupsum."<br>"
        ."本周导入特卖总流水:".$thisweekgroupimportsum."<br>"."本月导入特卖总流水".$thismonthgroupimportsum."<br>";
        echo "本周实际特卖流水：".($thisweekgroupsum-$thisweekgroupimportsum)."<br>"."本月实际特卖总流水".($thismonthgroupsum-$thismonthgroupimportsum)."<br>";
        echo "<br><br>快捷付款流水统计：<br>";
        echo "本周快捷付款流水：".$thisweekfastsum."<br>"."本月快捷付款流水：".$thismonthfastsum."<br>";

        //todo  统计销售人员负责的单品的  本月  本周
        $map["id"]=array("neq",6);
        $marketers=  D("Marketers")->where($map)->select();
        $group=D("Group");
        $grouporder=D("Group_order");
        $d = date("w");
        $sweektime = strtotime(date("Y-m-d") . " 00:00:00") - $d * 86400;
        $eweektime = strtotime(date("Y-m-d") . " 23:59:59") + (6 - $d) * 86400;
        $smonthtime = mktime(0, 0, 0, date("m"), 1, date("Y"));
        $emonthtime = mktime(0, 0, 0, date("m") + 1, 1, date("Y"));
        $moneykeey=$moneymonth=0;
        echo "<br><br>市场人员特卖单品流水统计：<br>";
        foreach ($marketers as $key=>$value){
            $groupids=$group->field("group_id")->where(array("marketer_id"=>$value['id']))->select();
        //    echo json_encode($groupids)."<br>";
            $moneyweek=0;
            $moneymonth=0;
            foreach ($groupids as $key1=>$value1){
              //  echo $value1["group_id"]."<br>";
                $groupid=$value1['group_id'];
              $groupmoney=$grouporder->field("SUM(payment_money) as singlemoney")->where("`group_id` = '$groupid' AND `paid` = 1  AND `add_time`>'$sweektime' AND `add_time`<'$eweektime'")->find();
             $moneyweek+=$groupmoney['singlemoney'];
                $groupmoneymonth=$grouporder->field("SUM(payment_money) as singlemoney")->where("`group_id` = '$groupid' AND `paid` = 1  AND `add_time`>'$smonthtime' AND `add_time`<'$emonthtime'")->find();
                $moneymonth+=$groupmoneymonth['singlemoney'];
              //  echo  $groupmoney['singlemoney']."<br>";

            }
             echo  $value['name']."特卖流水统计"."<br>";
            echo "周流水：".$moneyweek."<br>"."月流水：".$moneymonth."<br><br>";
        }

    }
}