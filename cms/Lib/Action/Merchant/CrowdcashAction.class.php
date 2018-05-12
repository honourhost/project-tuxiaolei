<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/8/11
 * Time: 10:54
 */
class CrowdcashAction extends BaseAction
{


    public function  index(){
        $mer_id = intval($this->merchant_session['mer_id']);
        if(empty($mer_id)){
            $this->error("操作出错，没有mer_id参数！");
        }
        $database_cash=D("Crowdcash");
        $count_cash = $database_cash->where("mer_id=".$mer_id)->count();
        import('@.ORG.merchant_page');
        $p = new Page($count_cash,15);
        $cash_list = $database_cash->order('create_time DESC')->select();
        $this->assign('cash_list',$cash_list);

        $all_cash_list = $database_cash->where(" status = 1 AND mer_id = ".$mer_id." AND is_lottery_order <> 1 ")->select();
        //start
        //计算总已提现金额
        $allGetCash=0;
        foreach($all_cash_list as $key=>$val){
            $allGetCash += intval($val['cash_num']);
        }
        //计算总可提现金额
        $mode = new Model();
        $alltotalfinsh = 0;

        $percent = '';
        if ($this->merchant_session['percent']) {
            $percent = $this->merchant_session['percent'];
        } elseif ($this->config['platform_get_merchant_percent']) {
            $percent = $this->config['platform_get_merchant_percent'];
        }
        $totalmoney=D("Crowdorder")->field("SUM(payment_money) as totalmoney")->where("paid =1 AND status > 1 AND mer_id = ".$mer_id." AND is_lottery_order <> 1 ")->find()["totalmoney"];  //总交易额
        $devisionmoney=$totalmoney*$percent*0.01; //扣点;

     //   $this->assign('all_totalfinish_percent', round($alltotalfinsh-$devisionmoney,2));


        $this->assign("allGetCash",round($allGetCash,2));
        $this->assign("devisionmoney",round($totalmoney,2));
        $this->assign("totalmoney",round($totalmoney,2));

        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);
        $this->display();

    }

    public function getCash(){

        if(!empty($_POST)){
            $data['mer_id']=$this->merchant_session['mer_id'];
                $database_cash=D("Crowdcash");
            $count_cash = $database_cash->where(array("mer_id"=>$data['mer_id'],"status"=>0))->find();
            if(!empty($count_cash)){
                $this->error("您有正在提现的款项，请耐心等待");
            }
            if(empty($_POST['merchant_real_name'])){
                $this->error("请输入真实姓名");
            }
            $data['merchant_real_name']=$_POST['merchant_real_name'];
            if(empty($_POST['bank_name'])){
                $this->error("请输入银行支行名称");
            }
            $data['bank_name']=$_POST['bank_name'];
            if(!preg_match("/^0{0,1}(13[0-9]|15[0-9]|153|156|18[0-9])[0-9]{8}$/",$_POST['merchant_real_telephone'])){
                $this->error("请输入正确的电话号码！");
            }
            $data['merchant_real_telephone']=$_POST['merchant_real_telephone'];
            if(!preg_match("/(([0-9]{16})|([0-9]{19}))$/",$_POST['bank_card'])){
                $this->error("请输入正确的银行卡号！");
            }
            if(empty($_POST['cash_num'])){
                $this->error("请输入正确的金额");
            }
            if($_POST['cash_num']<50){
                $this->error("提现金额不能小于50");
            }
            //判断是否可用提现大于当前请求提现，否则禁止提交申请
            //先查出所有已提现金额
            $database_cash=D("Crowdcash");
            $mer_id=$this->merchant_session['mer_id'];
            $all_cash_list = $database_cash->where("mer_id = ".$mer_id." AND status = 1 ")->select();
            //start
            //计算总已提现金额
            $allGetCash=0;
            foreach($all_cash_list as $key=>$val){
                $allGetCash += intval($val['cash_num']);
            }


            $percent = '';
            if ($this->merchant_session['percent']) {
                $percent = $this->merchant_session['percent'];
            } elseif ($this->config['platform_get_merchant_percent']) {
                $percent = $this->config['platform_get_merchant_percent'];
            }
            $totalmoney=D("Crowdorder")->field("SUM(payment_money) as totalmoney")->where("paid =1 AND status > 1 AND mer_id = ".$mer_id." AND is_lottery_order <> 1 ")->find()["totalmoney"];  //总交易额
            $devisionmoney=$totalmoney*$percent*0.01; //扣点;

            $real_can_cash=$totalmoney-round($allGetCash,2)-round($devisionmoney,2);
            if($_POST['cash_num']>$real_can_cash){
                $this->error("申请提现金额超过可提现金额，禁止申请！");
            }
            $data['bank_card']=$_POST['bank_card'];

            $data['cash_num']=$_POST['cash_num'];
            $data['create_time']=time();
            $data['status']=0;
            $result=D("Crowdcash")->add($data);
            if($result){

                    $this->success("提交提现申请成功！", U("Count/bill"));

            }else{
                $this->error("提交提现申请失败！");
            }
        }else{
            $newest=D("Crowdcash")->where("mer_id=".$this->merchant_session['mer_id'])->order("create_time DESC")->find();
            if(!empty($newest)){
                $this->assign("cash_info", $newest);
            }
            $this->display();
        }

    }
}