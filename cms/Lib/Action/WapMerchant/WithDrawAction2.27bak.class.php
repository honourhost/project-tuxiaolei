<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/18 0018
 * Time: 10:48
 */
class WithDrawAction extends BaseAction
{

    protected $merchant_session;
    protected $store;
    protected $meal_orderDb;
    protected $group_orderDb;
    protected $merid;
    protected function _initialize() {
        parent::_initialize();
        $this->merchant_session = session('merchant_session');
        $this->merchant_session = !empty($this->merchant_session) && !is_array($this->merchant_session) ? unserialize($this->merchant_session) : array();
        if (!in_array(ACTION_NAME, array('login', 'merreg', 'mer_reg', 'verify'))) {
            if (empty($this->merchant_session)) {
				//echo $_SERVER['REQUEST_URI']; die;
                redirect(U('Index/login', array('referer' => urlencode('http://' . $_SERVER['HTTP_HOST'] . (!empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'])))));
                exit();
            }
            //$this->check_merchant_file();
            //$this->init_opt();
        }

        $this->merid = $this->merchant_session['mer_id'];
        $this->meal_orderDb = M('Meal_order');
        $this->group_orderDb = M('Group_order');
     
        $this->assign('merid', $this->merid);
        $this->assign('mer_name', $this->merchant_session['name']);
        $this->assign('site_URl', trim($this->config['site_url'], '/'));
        $this->assign('merchantstatic_path', $this->config['site_url'] . '/tpl/Merchant/static/');
    }


    public  function index(){
        //计算总已提现金额
        $sql="SELECT sum(c.cash_num) as countcash FROM ".C('DB_PREFIX') ."fast_bank_cash_info as c WHERE c.status in(0,1) and c.mer_id = ".$this->merid;
        $countcah=M()->query($sql);




        //计算总可提现金额
        $mode = new Model();
        $mer_id=$this->merid;
        $sql = "SELECT sum(morder.payment_money) as price FROM ". C('DB_PREFIX') . "fast_order as morder  WHERE morder.mer_id={$mer_id} AND morder.paid=1 ";
        $res = $mode->query($sql);

        $real_can_cash=0;
        if($countcah){
            $real_can_cash=$res["0"]["price"]-$countcah[0]["countcash"];
        }else{
            $real_can_cash=$res["0"]["price"];
        }
        $this->assign("lingqian",round($real_can_cash,2));
        $database_cash=D("Fast_bank_cash_info");
        $mer_id=$this->merchant_session['mer_id'];
        $cashing=$database_cash->where(array("status"=>0,"mer_id"=>$mer_id))->find();
        if($cashing){
            $this->assign("cashing",1);
        }

       $this->display();
    }

    /**
     * 提现页
     */
public function  withdraw(){


    if(IS_POST){

        $data['mer_id']=$this->merid;
        if (empty( $this->merid)){
            $this->error("不存在的农场！");
        }
        if(empty($_POST['merchant_real_name'])){
            $this->error("请输入真实姓名");
        }
        $data['merchant_real_name']=$_POST['merchant_real_name'];
        if(empty($_POST['bank_name'])){
            $this->error("请输入银行名");
        }
        $data['bank_name']=$_POST['bank_name'];
        if(!preg_match("/^0{0,1}(13[0-9]|15[0-9]|153|156|18[5-9])[0-9]{8}$/",$_POST['merchant_real_telephone'])){
            $this->error("请输入正确的电话号码！");
        }
        $data['merchant_real_telephone']=$_POST['merchant_real_telephone'];
        if(empty($_POST['bank_card'])){
            $this->error("请输入正确的银行卡号！");
        }
        if(empty($_POST['cash_num'])){
            $this->error("请输入正确的金额");
        }
        if($_POST['cash_num']<50){
            $this->error("提现金额不能小于50");
        }
        if($_POST['cash_num']>5000){
            $this->error("提现金额不能大于5000");
        }
        //判断是否可用提现大于当前请求提现，否则禁止提交申请

        $database_cash=D("Fast_bank_cash_info");
        $mer_id=$this->merchant_session['mer_id'];
        $cashing=$database_cash->where(array("status"=>0,"mer_id"=>$mer_id))->find();
        if($cashing){
            $this->error("您已有正在提现的款项！请等待上笔提现结束");
            return;
        }

        //start
        //计算总已提现金额
      //  $sql="status in (0,1) and merid =".$mer_id;
        $sql="SELECT sum(c.cash_num) as countcash FROM ".C('DB_PREFIX') ."fast_bank_cash_info as c WHERE c.status in(0,1) and c.mer_id = ".$this->merid;
        $countcah=M()->query($sql);




        //计算总可提现金额
        $mode = new Model();

        $sql = "SELECT sum(morder.payment_money) as price FROM ". C('DB_PREFIX') . "fast_order as morder  WHERE morder.mer_id={$mer_id} AND morder.paid=1 ";
        $res = $mode->query($sql);

        $real_can_cash=0;
       if($countcah){
           $real_can_cash=$res["0"]["price"]-$countcah[0]["countcash"];
       }else{
           $real_can_cash=$res["0"]["price"];
       }



        if($_POST['cash_num']>$real_can_cash){
            $this->error("申请提现金额超过可提现金额，禁止申请！");
        }
        $data['bank_card']=$_POST['bank_card'];

        $data['cash_num']=$_POST['cash_num'];
        $data['create_time']=time();
        $data['status']=0;
        $result=D("Fast_bank_cash_info")->add($data);
        if($result){
            $this->success("提交提现申请成功！", U("WithDraw/detail"));
        }else{
            $this->error("提交提现申请失败！");
        }

    }else{

        $mode = new Model();
        $mer_id=$this->merid;

        $sql2="SELECT sum(c.cash_num) as countcash FROM ".C('DB_PREFIX') ."fast_bank_cash_info as c WHERE c.status in(0,1) and c.mer_id = ".$this->merid;
        $countcah=M()->query($sql2);

        $sql = "SELECT sum(morder.payment_money) as price FROM ". C('DB_PREFIX') . "fast_order as morder  WHERE morder.mer_id={$mer_id} AND morder.paid=1 ";
        $res = $mode->query($sql);

        $real_can_cash=0;
        if($countcah){
            $real_can_cash=$res["0"]["price"]-$countcah[0]["countcash"];
        }else{
            $real_can_cash=$res["0"]["price"];
        }
        $this->assign("can_cash",$real_can_cash);

        $merchant_card=D("Merchant_bank_card")->where(array("mer_id"=>$this->merid))->find();
        if($merchant_card){
            $this->assign("merchant_card",$merchant_card);


        }else{
            //$this->error("请先绑定银行卡",U("WithDraw/bandCard"));
            redirect(U("WithDraw/bandCard"));

        }
//        $database_cash=D("Fast_bank_cash_info");
//        $mer_id=$this->merchant_session['mer_id'];
//        $cashing2=$database_cash->where(array("mer_id"=>$mer_id))->order("id DESC")->find();
//        if($cashing2){
//            $this->assign("lastinfo",$cashing2);
//        }
        $this->display();
    }


}

    /**
     * 提现明细
     */
public function  detail(){
    //计算总已提现金额
    $sql="SELECT sum(c.cash_num) as countcash FROM ".C('DB_PREFIX') ."fast_bank_cash_info as c WHERE c.status in(0,1) and c.mer_id = ".$this->merid;
    $countcah=M()->query($sql);




    //计算总可提现金额
//    $mode = new Model();
//    $mer_id=$this->merid;
//    $sql = "SELECT sum(morder.payment_money) as price FROM ". C('DB_PREFIX') . "fast_order as morder  WHERE morder.mer_id={$mer_id} AND morder.paid=1 ";
//    $res = $mode->query($sql);

    $real_can_cash=0;
//    if($countcah){
//        $real_can_cash=$res["0"]["price"]-$countcah[0]["countcash"];
//    }else{
//        $real_can_cash=$res["0"]["price"];
//    }

    $sql2="SELECT * FROM ".C('DB_PREFIX') ."fast_bank_cash_info as c WHERE c.status in(0,1,2) and c.mer_id = ".$this->merid." order by c.id DESC ";
    $cashlist=M()->query($sql2);
   // $this->assign('lingqian',round($real_can_cash,2));
    $this->assign('lingqian',$countcah[0]["countcash"]);
    $this->assign("cashlist",$cashlist);
  //  echo  json_encode($cashlist);die;
    $this->display();
}

public function bandCard(){

    if(IS_POST){
        $data['mer_id']=$this->merid;
        if (empty( $this->merid)){
            $this->error("不存在的农场！");
        }
        if(empty($_POST['merchant_real_name'])){
            $this->error("请输入真实姓名");
        }
        $data['merchant_real_name']=$_POST['merchant_real_name'];
        if(empty($_POST['bank_name'])){
            $this->error("请输入银行名");
        }
        $data['bank_name']=$_POST['bank_name'];
        if(!preg_match("/^0{0,1}(13[0-9]|15[0-9]|153|156|18[5-9])[0-9]{8}$/",$_POST['merchant_real_telephone'])){
            $this->error("请输入正确的电话号码！");
        }
        $data['merchant_real_telephone']=$_POST['merchant_real_telephone'];
        if(!preg_match("/(([0-9]{16})|([0-9]{19}))$/",$_POST['bank_card'])){
            $this->error("请输入正确的银行卡号！");
        }
        $card["mer_id"]=$this->merid;
        $card["bank_name"]=$_POST['bank_name'];
        $card["bank_card"]=$_POST['bank_card'];
        $card["user_name"]=$_POST['merchant_real_name'];
        $card["phone"]=$_POST['merchant_real_telephone'];
        if(D("Merchant_bank_card")->data($card)->add()){
            $this->success("绑定成功",U("WithDraw/index"));
            return;
        }else{
       $this->error("绑定失败！");
            return;
        }
    }
    $this->display();
}


public function  modifyCard(){

    if(IS_POST){
        $data['mer_id']=$this->merid;
        if (empty( $this->merid)){
            $this->error("不存在的农场！");
        }
        if(empty($_POST['merchant_real_name'])){
            $this->error("请输入真实姓名");
        }
        $data['merchant_real_name']=$_POST['merchant_real_name'];
        if(empty($_POST['bank_name'])){
            $this->error("请输入银行名");
        }
        $data['bank_name']=$_POST['bank_name'];
        if(!preg_match("/^0{0,1}(13[0-9]|15[0-9]|153|156|18[5-9])[0-9]{8}$/",$_POST['merchant_real_telephone'])){
            $this->error("请输入正确的电话号码！");
        }
        $data['merchant_real_telephone']=$_POST['merchant_real_telephone'];
        if(!preg_match("/(([0-9]{16})|([0-9]{19}))$/",$_POST['bank_card'])){
            $this->error("请输入正确的银行卡号！");
        }
        $card["mer_id"]=$this->merid;
        $card["bank_name"]=$_POST['bank_name'];
        $card["bank_card"]=$_POST['bank_card'];
        $card["user_name"]=$_POST['merchant_real_name'];
        $card["phone"]=$_POST['merchant_real_telephone'];
        if(D("Merchant_bank_card")->data($card)->where(array("mer_id"=>$this->merid))->save()){
            $this->success("修改绑定成功",U("WithDraw/withdraw"));
            return;
        }else{
            $this->error("修改绑定失败！");
            return;
        }
    }else{
        $cardinfo=D("Merchant_bank_card")->where(array("mer_id"=>$this->merid))->find();
        if($cardinfo){
            $this->assign("cardinfo",$cardinfo);
         //   echo  json_encode($cardinfo);die;
            $this->display();
        }else{
            $this->error("您没有绑定过银行卡，请先绑定",U("WithDraw/bandCard"));
        }
    }

}

}