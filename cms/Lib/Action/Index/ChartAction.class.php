<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13 0013
 * Time: 14:00
 */
class ChartAction extends BaseAction
{
    public function index()
    {
        echo "fuck";
        die;
    }

    /**
     * 随时间增长
     */
    public function numbytime()
    {

        $this->display();
    }

    /**
     * 用户
     */
public function  userstatis(){
        $this->display();
}

    /**
     * 月交易额统计
     */
public function  monthmoneystatis(){

    $this->display();
}

    /**
     * 地区交易额
     */
public function provincemoney(){
    $this->display();
}

    /**
     * 月累计用户
     */
public function  monthuser(){
    $this->display();

}


public function  provinceuser(){
    $this->display();
}


public function  nianlinguser(){
    $this->display();
}

    /**
     * 社区圈子
     */
public function  quanzi(){
    $this->display();

}

    /**
     * 入驻商家饼图
     */
public function shangjia(){
    $this->display();

}



public function  chain(){
    $this->display();
}

public function  orderstatis(){
    $this->display();
}


public function  salestatis(){
    $this->display();
}

public function  newindex(){
    $this->display();
}


public function  jsonreturn(){
    $countdata=D("Group_order")->field("COUNT(*) as dingdanliang")->find();
    $count=$countdata['dingdanliang'];
    $total_data = array(
        'n' => rand(0,5),
        'co'=>$count
    );
    echo json_encode($total_data);
}
    public function  jsonreturn1(){
        $countdata=D("Group_order")->field("COUNT(*) as dingdanliang")->find();
        $count=$countdata['dingdanliang'];
        $total_data = array(
            'n' => rand(0,15),
            'co'=>$count
        );
        echo json_encode($total_data);
    }

    /**
     * 用户增长
     */
    public function  jsonreturn2(){
        $countdata=D("User")->field("COUNT(*) as yonghu")->find();
        $count=$countdata['yonghu'];
        $total_data = array(
            'n' => rand(0,5),
            'co'=>$count
        );
        echo json_encode($total_data);
    }
    public function ajaxdata()
    {
       // $data["categories"] = array("1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月");
        $data["categories"] = array("1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月");
        $go = D("Group_order");
        $sum = array();
        $total = array();
        for ($i = 1; $i <= 9; $i++) {
            $days = cal_days_in_month(CAL_GREGORIAN, $i, 2017);
            $res = $go->field("SUM(payment_money) as totalmoney,COUNT(order_id) as totalcount")->where("add_time >" . strtotime("2017-" . $i . "-01 00:00:00") . " AND add_time <" . strtotime("2017-" . $i . "-" . $days . " 23:59:59") . " AND paid=1")->find();
            $sum[$i - 1] = $res["totalmoney"];
            $total[$i - 1] = $res["totalcount"];
        }
        $data["data"] = $sum;
        $data["count"] = $total;
    echo json_encode($data);die;

    }

}