<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/2 0002
 * Time: 13:24
 */
class QrpayAction extends BaseAction
{
    public function client(){
		 if(empty($this->user_session)){
          $this->error_tips('购买前，请先进行登陆或注册',U('Login/index'));
      }
		
        $this->display("newclient");
    }


  public function  test2(){
      if(empty($this->user_session)){
          $this->error_tips('请先进行登录！',U('Login/index'));
      }
      if(empty($_POST['money'])){
          $this->error_tips("请输入正确的钱数");
      }
      $data_group_order['group_id']=1524;
      $data_group_order['mer_id'] = 747;
      $data_group_order['store_id'] = 700;
      $data_group_order['num'] = 1;
      $data_group_order['order_name'] = "现场扫码购买";
      $data_group_order['price'] = $_POST['money'];
      $data_group_order['total_money'] = $_POST['money'];
      $data_group_order['tuan_type'] = 2;
      $data_group_order['add_time'] = $_SERVER['REQUEST_TIME'];
      $data_group_order['contact_name'] = "现场扫码购买";
      $data_group_order['phone'] = "8888888";
      $data_group_order['zipcode'] = "0";
      $data_group_order['adress'] = "现场扫码购买,不必发货";

      $data_group_order['delivery_type'] = 1;
      $data_group_order['delivery_comment'] = "现场扫码购买";
      $data_group_order['uid'] = session('user')['uid'];

      $order_id = D("Group_order")->data($data_group_order)->add();

      if($order_id){
        $this->go_pay($order_id);
      }else{
        $this->error_tips("生成订单失败！");
      }
  }

    public function go_pay($orderid){
       $now_order=D("Group_order")->where(array("order_id"=>$orderid))->find();
        if(empty($now_order)||$now_order['paid']==1){
            $this->error_tips("订单不错在或已发货！");
        }

        $order_info = $now_order;
    //$this->ajaxReturn( $now_order);die;
        $order_info['order_type'] = "group";

        if($_POST['order_type'] != 'recharge'){
            //优惠券
            if(!empty($_POST['card_id'])){
                $now_coupon = D('Member_card_coupon')->get_coupon_by_recordid($_POST['card_id'],$this->user_session['uid']);
            }

            //商家会员卡余额
            $merchant_balance = D('Member_card')->get_balance($this->user_session['uid'],$order_info['mer_id']);
            $this->assign('merchant_balance',$merchant_balance);
        }
        //需要支付的钱
     $pay_money = $now_order['total_money'];

        $pay_method = D('Config')->get_pay_method();
        if(empty($pay_method)){
            $this->error_tips('系统管理员没开启任一一种支付方式！');
        }
     /*   if(empty($pay_method[$_POST['pay_type']])){
            $this->error_tips('您选择的支付方式不存在，请更新支付方式！');
        }*/


       // $pay_class_name = ucfirst($_POST['pay_type']);
        $pay_class_name = ucfirst('weixin');
        $otherwc = session('otherwc');

        $import_result = import('@.ORG.pay.'.$pay_class_name);
        if(empty($import_result)){
            $this->error_tips('系统管理员暂未开启该支付方式，请更换其他的支付方式');
        }
        $order_id = $order_info['order_id'];
       //  echo  $pay_money."支付钱"; die;
        $pay_class = new $pay_class_name($order_info,$pay_money,$_POST['weixin'],$pay_method["weixin"]['config'],$this->user_session,1);
        $go_pay_param = $pay_class->pay();

        if(empty($go_pay_param['error'])){
            if(!empty($go_pay_param['url'])){
                $this->assign('url',$go_pay_param['url']);
                $this->display();
            }else if(!empty($go_pay_param['form'])){
                $this->assign('form',$go_pay_param['form']);
                $this->display();
            }else if(!empty($go_pay_param['weixin_param'])){
              //  $redirctUrl = C('config.site_url').'/wap.php?g=Wap&c=Pay&a=weixin_back&order_type='.$order_info['order_type'].'&order_id='.$order_info['order_id'];
                $redirctUrl = C('config.site_url').'/wap.php?g=Wap&c=Qrpay&a=paysuccess';
                $this->assign('redirctUrl',$redirctUrl);
                $this->assign('pay_money',$pay_money);
                $this->assign('weixin_param',json_decode($go_pay_param['weixin_param']));
                $this->display('weixin_pay');
            }else{
                $this->error_tips('调用支付发生错误，请重试。');
            }
        }else{
            $this->error_tips($go_pay_param['msg']);
        }
    }
    public  function  paysuccess(){
        $this->success_tips("恭喜您！支付成功！");
    }

}