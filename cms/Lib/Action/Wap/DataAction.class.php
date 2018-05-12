<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/5/11
 * Time: 15:04
 */
class DataAction extends BaseAction
{
    /**
     * 统计今日数据
     */
     public function  today(){

      $todayzero=  strtotime(date("Y-m-d"));
      $data=D("Group_order")->field("COUNT(order_id) as co,SUM(payment_money) as mo ")->where("paid =1 AND pay_time>".$todayzero)->find();
       echo "截至".date("Y年m月d日 H:i:s")."今日订单数据统计："."<br>";


         $data2=D("Group_order")->field()->where("paid =1 AND pay_time>".$todayzero)->select();



       echo "订单数：".$data["co"]."<br>";
       echo "交易额：".$data["mo"]."<br>";
       echo "明细:"."<br>";
       foreach ($data2 as $key=>$value){

           echo $value["order_name"]."  支付金额:".$value["payment_money"]."<br>";

       }

       $localdata=D("Fast_order")->field("COUNT(order_id) as co,SUM(payment_money) as mo ")->where("paid =1 AND pay_time>".$todayzero)->find();
         echo "截至".date("Y年m月d日 H:i:s")."今日线下实体订单数据统计："."<br>";
         $datalocal2=D("Fast_order")->field()->where("paid =1 AND pay_time>".$todayzero)->select();
         echo "订单数：".$localdata["co"]."<br>";
         echo "交易额：".$localdata["mo"]."<br>";
         echo "明细:"."<br>";
         foreach ($datalocal2 as $key1=>$value1){

             echo $value1["order_name"]."  支付金额:".$value1["payment_money"]."<br>";

         }


     }

    /**
     * 某年某月数据    默认当年
     */
     public function  month(){
         $month=$_GET["month"];
         $year=!empty($_GET["year"])?$_GET["year"]:date("Y");
         $daysinmonth=$this->days_in_month($month,$year);
      //   echo $year."/".$month."/1"." 0:0:0";
         $start=strtotime($year."/".$month."/1"." 0:0:0");
         $end=strtotime($year."/".$month."/".$daysinmonth." 23:59:59");
         $userdata=D("User")->field("COUNT(uid) as co")->where("add_time>".$start." AND add_time < ".$end)->find();
         $usercount=D("User")->count();
         echo $year."年".$month."月数据统计："."<br>";
         echo $month."月用户增长：".$userdata["co"]."<br>";
         echo "用户总数：".$usercount."<br>";
         $grouporder=D("Group_order")->field("SUM(payment_money)  as mo,COUNT(order_id) as co")->where("pay_time > ".$start." AND pay_time < ".$end."  AND paid =1")->find();
         echo $month."月特卖交易额：".$grouporder["mo"]."<br>";
         echo $month."月特卖销量：".$grouporder["co"]."<br>";
         $fastorder=D("Fast_order")->field("SUM(payment_money)  as mo,COUNT(order_id) as co")->where("pay_time > ".$start." AND pay_time < ".$end."  AND paid =1")->find();
         echo $month."月快捷支付交易额：".$fastorder["mo"]."<br>";
         echo $month."月快捷支付销量：".$fastorder["co"]."<br>";
         $groupordersum=D("Group_order")->field("SUM(payment_money)  as mo")->where("paid =1")->find();
         echo "特卖总交易额：".$groupordersum["mo"]."<br>";

         $fastordersum=D("Fast_order")->field("SUM(payment_money)  as mo")->where("paid =1")->find();
         echo "快捷支付总交易额：".$fastordersum["mo"]."<br>";

         $thisweekgroupimportsum=D("Group_order")->field('sum(payment_money) as totalmoney')->where("`paid`=1 AND `add_time`>'$start' AND `add_time` < '$end'  AND `mer_id` <> 812 ")->count();

         echo $month."月特卖实际订单量：".$thisweekgroupimportsum."<br>";




     }

    /**
     * 本周订单数据
     */
     public function  thisweekdata(){


         $thismonday=strtotime('0 week last monday');
         $lastmonday=strtotime('-1 week last monday');
         $user=D("User");
         $group_order=D("Group_order");
         $fast_order=D("Fast_order");
     //    echo  $thismonday;die;
         $thisweekusercount=$user->where(array("add_time"=>array("gt",$thismonday)))->count();
         echo "本周用户增长：".$thisweekusercount."<br>";
        // $where['add_time']=array(array("gt",$lastmonday),array("lt",$thismonday),"AND");
       //  $lastweekusercount=$user->where($where)->count();
       //  $thisweekgocount=$group_order->where(array("paid"=>1,"add_time"=>array("gt",$thismonday)))->count();   //本周特卖订单数量
       //  $lastweekwhere['add_time']=array(array("gt",$lastmonday),array("lt",$thismonday),"AND");
        // $lastweekwhere["paid"]=1;
      //   $lastweekgocount=$group_order->where($lastweekwhere)->count(); //上周特卖订单量
         $thisweekgosum=$group_order->field("SUM(payment_money) as total")->where(array("paid"=>1,"add_time"=>array("gt",$thismonday)))->find();   //本周特卖交易额
         echo "本周特卖交易额：".$thisweekgosum["total"]."<br>";
         //  $lastweekgosum=$group_order->field("SUM(payment_money) as total")->where($lastweekwhere)->find(); //上周特卖交易额
        // $thisweekfastcount=$fast_order->where(array("paid"=>1,"add_time"=>array("gt",$thismonday)))->count();  //本周快捷付款笔数
       //  $lastweekfastcount=$fast_order->where($lastweekwhere)->count(); //上周快捷付款笔数
         $thisweekfastsum=$fast_order->field("SUM(payment_money) as total" )->where(array("paid"=>1,"add_time"=>array("gt",$thismonday)))->find();
         echo "本周快捷支付交易额：".$thisweekfastsum["total"]."<br>";

         $thisweekgongzhongsum=$group_order->field("SUM(payment_money) as total" )->where(array("paid"=>1,"add_time"=>array("gt",$thismonday),"distribution_id"=>"hxYfTpMc_297964"))->find();
         $thisweekgongzhongtotal=$group_order->field("COUNT(*) as total" )->where(array("paid"=>1,"add_time"=>array("gt",$thismonday),"distribution_id"=>"hxYfTpMc_297964"))->find();
         echo "本周公众号总量：".$thisweekgongzhongsum["total"]."<br>";
         echo "本周公众号数量：".$thisweekgongzhongtotal["total"]."<br>";

      //   $lastweekfastsum=$fast_order->field("SUM(payment_money) as total" )->where($lastweekwhere)->find();

     //    $this->assign("thisweekcount",$thisweekgocount+$thisweekfastcount);  //本周总订单数目
      //   $this->assign("thisweekgocount",$thisweekgocount);
       //  $this->assign("thisweekfastcount",$thisweekfastcount);
      //   $this->assign("thisweeksum",$thisweekgosum['total']+$thisweekfastsum['total']);
      //   $this->assign("thisweekgosum",$thisweekgosum['total']);
     //    $this->assign("thisweekfastsum",$thisweekfastsum['total']);
   //      $this->assign("thisweekusercount",$thisweekusercount);


        // $this->assign("lastweekcount",$lastweekgocount+$lastweekfastcount);  //上周总订单数目
        // $this->assign("lastweekgocount",$lastweekgocount);
        // $this->assign("lastweekfastcount",$lastweekfastcount);
       //  $this->assign("lastweeksum",$lastweekgosum['total']+$lastweekfastsum['total']);
       //  $this->assign("lastweekgosum",$lastweekgosum['total']);
       //  $this->assign("lastweekfastsum",$lastweekfastsum['total']);
        // $this->assign("lastweekusercount",$lastweekusercount);
        // $this->display();
     }

     public function  t(){

     }

     private  function days_in_month($month, $year)
     {
         return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
     }


     public function daycash(){
         $begin=date("Y/m/d");
         $t= strtotime($begin." 0:0:0");
         $Bank_cash_info=D("Merchant_cash_record");
         $Bank_cash_info2=D("Fast_bank_cash_info");
         $bankcash=D("Bank_cash_info");
         $cashdata=$Bank_cash_info->where("status = 1 AND record_time > ".$t)->select();

         echo "截至".date("Y/m/d H:i:s")."当日特卖商家提现成功记录"."<br><br>";
         foreach ($cashdata as $k=>$v){
             $people=$bankcash->where(array("id"=>$v["cash_info_id"]))->find();
             echo  $people["merchant_real_name"]."- 创建时间：".date("Y/m/d H:i:s", $people["create_time"])."-  银行：".$people["bank_name"]."- 卡号：".$people["bank_card"].
                 "- 金额：".$v["cash_num"]."- 提现时间：".date("Y/m/d H:i:s", $v["record_time"])."<br>";

         }

         echo "当日快捷付款提交记录："."<br><br>";

         $fashcash=$Bank_cash_info2->where("status = 1 AND tixian_time > ".$t)->select();
         foreach ($fashcash as $kk=>$vv){
             echo $vv["merchant_real_name"]."- 创建时间：".date("Y/m/d H:i:s", $vv["create_time"])."-  银行：".$vv["bank_name"]."- 卡号：".$vv["bank_card"].
                 "- 金额：".$vv["cash_num"]."- 提现时间：".date("Y/m/d H:i:s", $vv["tixian_time"])."<br>";
         }

     }

     public function day(){

           if(strpos($_GET['when'],"-")==-1){
               exit("请输入正确的时间格式");

           }
         $todayzero=  strtotime($_GET['when']);
         $data=D("Group_order")->field("COUNT(order_id) as co,SUM(payment_money) as mo ")->where("paid =1 AND pay_time>".$todayzero." AND pay_time< ".strtotime($_GET['when']." 23:59:59")." AND group_id  NOT IN(1563,1578,1581,1582,1609,1607,1642,1462,1510,1488,1509,2639) AND mer_id <> 812 ")->find();
         echo $_GET["when"]."订单数据统计："."<br>";
  //echo  D()->getLastSql();die;



         $data2=D("Group_order")->field()->where("paid =1 AND pay_time>".$todayzero." AND pay_time< ".strtotime($_GET['when']." 23:59:59")." AND mer_id <> 812 "." AND group_id NOT IN(1563,1578,1581,1582,1609,1607,1642,1462,1510,1488,1509,2639) AND mer_id <> 812 ")->order("pay_time ASC  ")->select();



         echo "订单数：".$data["co"]."<br>";
         echo "交易额：".$data["mo"]."<br>";
         echo "明细:"."<br>";
         $merchant=D("Merchant");
         foreach ($data2 as $key=>$value){
             $merdata=$merchant->where(array("mer_id"=>$value["mer_id"]))->find();
             echo $value["order_name"]."  支付金额:".$value["payment_money"]."  支付时间:".date("Y-m-d H:i:s",$value["pay_time"])."农场主：".$merdata["name"]."<br>";

         }

         $localdata=D("Fast_order")->field("COUNT(order_id) as co,SUM(payment_money) as mo ")->where("paid =1 AND pay_time>".$todayzero." AND pay_time< ".strtotime($_GET['when']." 23:59:59"))->find();
         echo $_GET["when"]."线下实体订单数据统计："."<br>";
         $datalocal2=D("Fast_order")->field()->where("paid =1 AND pay_time>".$todayzero." AND pay_time< ".strtotime($_GET['when']." 23:59:59"))->order(" pay_time ASC ")->select();
         echo "订单数：".$localdata["co"]."<br>";
         echo "交易额：".$localdata["mo"]."<br>";
         echo "明细:"."<br>";
         foreach ($datalocal2 as $key1=>$value1){
             $merdata2=$merchant->where(array("mer_id"=>$value["mer_id"]))->find();
             echo $value1["order_name"]."  支付金额:".$value1["payment_money"]."  支付时间:".date("Y-m-d H:i:s",$value1["pay_time"])."农场主：".$merdata["name"]."<br>";

         }

     }

    public function thisweekdetail(){

//        if(strpos($_GET['when'],"-")==-1){
//            exit("请输入正确的时间格式");
//
//        }
        $date=new DateTime();
        $date->modify('this week -2 days ');
        $first_day_of_week=$date->format('Y-m-d');
       // echo  $first_day_of_week;die;
//        $todayzero=  strtotime($_GET['when']);
        $todayzero=strtotime($first_day_of_week);
        $data=D("Group_order")->field("COUNT(order_id) as co,SUM(payment_money+balance_pay) as mo ")->where("paid =1 AND pay_time>".$todayzero." AND pay_time< ".strtotime($_GET['when']." 23:59:59")." AND group_id  NOT IN(1563,1578,1581,1582,1609,1607,1642,1462,1510,1488,1509,2639) AND mer_id <> 812 ")->find();
        echo $_GET["when"]."订单数据统计："."<br>";
        //echo  D()->getLastSql();die;



        $data2=D("Group_order")->field()->where("paid =1 AND pay_time>".$todayzero." AND pay_time< ".strtotime($_GET['when']." 23:59:59")." AND mer_id <> 812 "." AND group_id NOT IN(1563,1578,1581,1582,1609,1607,1642,1462,1510,1488,1509,2639) AND mer_id <> 812 ")->order("pay_time ASC  ")->select();



        echo "订单数：".$data["co"]."<br>";
        echo "交易额：".$data["mo"]."<br>";
        echo "明细:"."<br>";
        $merchant=D("Merchant");
        foreach ($data2 as $key=>$value){
            $merdata=$merchant->where(array("mer_id"=>$value["mer_id"]))->find();
            echo $value["order_name"]."  支付金额:".($value["payment_money"]+$value["balance_pay"])."  支付时间:".date("Y-m-d H:i:s",$value["pay_time"])."农场主：".$merdata["name"]."<br>";

        }

        $localdata=D("Fast_order")->field("COUNT(order_id) as co,SUM(payment_money) as mo ")->where("paid =1 AND pay_time>".$todayzero." AND pay_time< ".strtotime($_GET['when']." 23:59:59"))->find();
        echo $_GET["when"]."线下实体订单数据统计："."<br>";
        $datalocal2=D("Fast_order")->field()->where("paid =1 AND pay_time>".$todayzero." AND pay_time< ".strtotime($_GET['when']." 23:59:59"))->order(" pay_time ASC ")->select();
        echo "订单数：".$localdata["co"]."<br>";
        echo "交易额：".$localdata["mo"]."<br>";
        echo "明细:"."<br>";
        foreach ($datalocal2 as $key1=>$value1){
            $merdata2=$merchant->where(array("mer_id"=>$value["mer_id"]))->find();
            echo $value1["order_name"]."  支付金额:".$value1["payment_money"]."  支付时间:".date("Y-m-d H:i:s",$value1["pay_time"])."<br>";

        }

    }


    public function  wangyuanyuan(){
        $thismonday=strtotime('0 week last monday')-48*3600;
        $thissatday=$thismonday+7*3600*24;
      //  $lastmonday=strtotime('-1 week last monday',$thismonday);
       // echo  date("Y/m/d H:i:s",$thismonday);
        $user=D("User");
        $group_order=D("Group_order");
        $fast_order=D("Fast_order");
        $thisweekusercount=$user->where(array("add_time"=>array("gt",$thismonday)))->count();
        echo "本周用户增长：".$thisweekusercount."<br>";
    //    $thisweekgosum=$group_order->field("SUM(payment_money) as total")->where(array("paid"=>1,"add_time"=>array("gt",$thismonday)))->find();   //本周特卖交易额
       // echo "本周特卖交易额：".$thisweekgosum["total"]."<br>";
     //   $thisweekfastsum=$fast_order->field("SUM(payment_money) as total" )->where(array("paid"=>1,"add_time"=>array("gt",$thismonday)))->find();
      //  echo "本周快捷支付交易额：".$thisweekfastsum["total"]."<br>";


        //统计本周订单  本月订单  本周导入  本月导入     本周实际  本月实际
    //    $thisweekgroupsum=D("Group_order")->get_all_oreder_sum("week");
        $thisweekgroupsum=D("Group_order")->field('sum(payment_money) as totalmoney')->where("`paid`=1 AND `add_time`>'$thismonday' AND `add_time`<'$thissatday'")->select()[0]["totalmoney"];
        $thisweekxianshengsum=D("Group_order")->field('sum(balance_pay) as totalmoney')->where("`paid`=1 AND `add_time`>'$thismonday' AND `add_time`<'$thissatday' AND payment_money=0 ")->select()[0]["totalmoney"];
        $thisweekgzhsum=D("Group_order")->field('sum(balance_pay+payment_money) as totalmoney')->where("`paid`=1 AND `add_time`>'$thismonday' AND `add_time`<'$thissatday' AND distribution_id='hxYfTpMc_297964'  ")->select()[0]["totalmoney"];
        $thisweekxianshengcount=D("Group_order")->where("`paid`=1 AND `add_time`>'$thismonday' AND `add_time`<'$thissatday' AND payment_money=0 ")->count();
        $thisweekgzhsumcount=D("Group_order")->where("`paid`=1 AND `add_time`>'$thismonday' AND `add_time`<'$thissatday' AND distribution_id='hxYfTpMc_297964'  ")->count();

        $thismonthgroupsum=D("Group_order")->get_all_oreder_sum("month");
        $thisweekgroupsumreal=D("Group_order")->field('sum(payment_money) as totalmoney')->where("`paid`=1 AND `add_time`>'$thismonday' AND `add_time`<'$thissatday'  AND `mer_id` <> 812  ")->select()[0]["totalmoney"];
       $thisweekgroupimportsum=D("Group_order")->field('sum(payment_money) as totalmoney')->where("`paid`=1 AND `add_time`>'$thismonday'  AND `mer_id` = 812 ")->select()[0]["totalmoney"];
        $thismonthgroupimportsum=D("Group_order")->get_all_oreder_sum_import("month",812);

  //      $thisweekfastsum=D("FastOrder")->get_all_oreder_sum("week");
        $thisweekfastsum=D("FastOrder")->field('sum(payment_money) as totalmoney')->where("`paid`=1 AND `add_time`>'$thismonday' AND `add_time`<'$thissatday'")->select()[0]["totalmoney"];
        $thismonthfastsum=D("FastOrder")->get_all_oreder_sum("month");
        echo "特卖流水统计：<br>";
        echo  "本周特卖实际总流水：".$thisweekgroupsumreal."<br>"."本月实际特卖总流水：".($thismonthgroupsum-$thismonthgroupimportsum)."<br>"."本周青岛仓：".$thisweekgroupimportsum."<br>"
            ."本月青岛仓总流水".$thismonthgroupimportsum."<br>";
      //  echo "本周实际特卖流水：".($thisweekgroupsum-$thisweekgroupimportsum)."<br>"."本月实际特卖总流水".($thismonthgroupsum-$thismonthgroupimportsum)."<br>";
        echo "<br><br>快捷付款流水统计：<br>";
        echo "本周快捷付款流水：".$thisweekfastsum."<br>"."本月快捷付款流水：".$thismonthfastsum."<br>";
        echo "本周农丁鲜生：".$thisweekxianshengsum."单数".$thisweekxianshengcount."--";
        echo "本周公众号文章：".$thisweekgzhsum."单数".$thisweekgzhsumcount;




        echo "汇总： <br>";
        echo "本周总流水（特卖+导入+快捷支付）".($thisweekfastsum+$thisweekgroupsum)."<br>";
        echo "本月总流水（特卖+导入+快捷支付）".($thismonthfastsum+$thismonthgroupsum)."<br>";


        $usercount=D("User")->count();
        echo "平台用户总数：".$usercount."<br>";
        $groupordersum=D("Group_order")->field("SUM(payment_money)  as mo")->where("paid =1")->find();
        echo "特卖总交易额：".$groupordersum["mo"]."<br>";

        $fastordersum=D("Fast_order")->field("SUM(payment_money)  as mo")->where("paid =1")->find();
        echo "快捷支付总交易额：".$fastordersum["mo"]."<br>";

    }

}