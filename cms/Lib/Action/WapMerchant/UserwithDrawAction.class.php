<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/7/31
 * Time: 16:18
 */
class UserwithdrawAction extends BaseAction
{
    public function __construct()
    {

        parent::__construct();
    }


    protected function _initialize()
    {
        parent::_initialize();
        if (empty($this->user_session)) {
            $location_param['referer'] = urlencode($_SERVER['REQUEST_URI']);
            redirect(U('Wap/Login/index', $location_param));
        }
        $this->static_path = '/tpl/WapMerchant/' . C('DEFAULT_THEME') . '/static/';
        $this->assign('merchantstatic_path', $this->config['site_url'] . '/tpl/Merchant/static/');
        // echo  $this->static_path;die;


    }

    public function index()
    {
        $nowmoney = D("User")->where(array("uid" => $this->user_session['uid']))->find()['distribute_money'];
        //  echo  $nowmoney;die;
        $this->assign("moneynow", $nowmoney);
        $this->assign('site_URl', trim($this->config['site_url'], '/'));
        $this->display();
    }

    public function  withdraw(){
        if(IS_POST){
            $uid=intval($this->user_session["uid"]);
            $user=D("User")->where("uid = ".$this->user_session["uid"])->find();
          //  echo  json_encode($user);die;
            if(empty($user)){
                $this->error("未查询到您的当前用户");
            }
            $data["uid"]=$user["uid"];
            $datas=D("Usercash")->where(" uid = ".$uid." AND status =0 ")->find();
            if(!empty($datas)){
                $this->error("您有一笔提现正在审核，无法提现");
            }
            if(empty($_POST['real_name'])){
                $this->error("请输入真实姓名");
            }
            $data['real_name']=$_POST['real_name'];
            if(empty($_POST['bank_name'])){
                $this->error("请输入银行名");
            }
            $data['bank_name']=$_POST['bank_name'];
            if(!preg_match("/^0{0,1}(13[0-9]|15[0-9]|153|156|18[5-9])[0-9]{8}$/",$_POST['real_telephone'])){
                $this->error("请输入正确的电话号码！");
            }
            $data['real_telephone']=$_POST['real_telephone'];
            if(empty($_POST['bank_card'])){
                $this->error("请输入正确的银行卡号！");
            }
            $data["bank_card"]=$_POST['bank_card'];
            if(empty($_POST['cash_money'])){
                $this->error("请输提现金额 ");
            }
            $data['cash_money']=$_POST['cash_money'];
            if(floatval($data["cash_money"])>floatval($user["distribute_money"])){
                $this->error("您的余额不足 ");
            }
            $data["add_time"]=time();
            if(D("Usercash")->data($data)->add()){
                $this->success("提交成功",U("Userwithdraw/index"));
            }else{
                $this->error("提交失败 ");
            }

        }else{

            $this->display();

        }
    }

}