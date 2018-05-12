<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2015/12/31
 * Time: 13:29
 */
class MerchantAction extends BaseAction{
    //农场缴纳押金的页面
    public function recharge(){
        if(!empty($_POST)){
            $data_merchant_recharge_order['mer_id'] = $this->merchant_session["mer_id"];
            $money = floatval($_POST['money']);
            if(empty($money) || $money > 10000 || $money!=0.01){
                $this->error('请输入有效的金额，目前为1000！最高不能超过1万元。');
            }
            $data_merchant_recharge_order['money'] = $money;
            // $data_user_recharge_order['order_name'] = '帐户余额在线充值';
            $data_merchant_recharge_order['add_time'] = $_SERVER['REQUEST_TIME'];
            if($order_id = D('Merchant_recharge_order')->data($data_merchant_recharge_order)->add()){
                redirect(U('Merchant/Pay/check',array('order_id'=>$order_id,'type'=>'merchant_recharge')));
            }else{
                $this->error('订单处理失败！请重试。');
            }
        }else {
            //查询看是否存在已经缴纳押金
            $deposit=D('Merchant_pay_deposite')->where("mer_id=".$this->merchant_session["mer_id"])->find();
            if(!empty($deposit)){
                $this->assign("deposite",$deposit);
                $this->display("Merchant/depositeReturn");
            }else{
            $this->display();
            }
        }
    }
    //缴纳完成回调页
    public function depositeReturn(){
       $order_id=$_GET['order_id'];
        if(!empty($order_id)){
            $deposit=D('Merchant_pay_deposite')->where(array("order_id"=>$order_id,"mer_id"=>$this->merchant_session["mer_id"]))->find();
            $this->assign("deposite",$deposit);
            $this->display();
        }else{
            $this->display();
        } 
    }
}