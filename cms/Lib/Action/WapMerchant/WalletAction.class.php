<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/18 0018
 * Time: 14:12
 */
class WalletAction extends  BaseAction
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


    public function  index(){
        $today= strtotime(date('Y-m-d'));

        //计算总已提现金额
        $sql="SELECT sum(c.cash_num) as countcash FROM ".C('DB_PREFIX') ."fast_bank_cash_info as c WHERE c.status in(0,1) and c.mer_id = ".$this->merid;
        $countcah=M()->query($sql);



       $mer_id=$this->merchant_session["mer_id"];
        //计算总可提现金额
        $mode = new Model();
        $mer_id=$this->merid;
        $sql = "SELECT sum(morder.payment_money) as price FROM ". C('DB_PREFIX') . "fast_order as morder  WHERE morder.mer_id={$mer_id} AND morder.paid=1 ";
        $res = $mode->query($sql);
        $sqltoday="SELECT sum(morder.payment_money) as price FROM ". C('DB_PREFIX') . "fast_order as morder  WHERE morder.mer_id={$mer_id} AND morder.paid=1 and morder.pay_time > ".$today;
        $restoday = $mode->query($sqltoday);
        $real_can_cash=0;
        if($countcah){
            $real_can_cash=$res["0"]["price"]-$countcah[0]["countcash"];
        }else{
            $real_can_cash=$res["0"]["price"];
        }
        $merchant_image=new merchant_image();

      $person_image=  $merchant_image->get_image_by_path($this->merchant_session["person_image"]);

        $person_name=$this->merchant_session["person_name"];
      //  echo json_encode($restoday);die;
        $this->assign("shouyitoday",$restoday["0"]["price"]);
        $this->assign("shouyi",$res["0"]["price"]);
        $this->assign("pimage",$person_image);
        $this->assign("pname",$person_name);
        $this->assign("mimage",$merchant_image->get_image_by_path($this->merchant_session["merchant_theme_image"]));

       //收益列表

        //计算总已提现金额
        $sql="SELECT sum(c.cash_num) as countcash FROM ".C('DB_PREFIX') ."fast_bank_cash_info as c WHERE c.status in(0,1) and c.mer_id = ".$this->merid;
        $countcah=M()->query($sql);



        $mer_id=$this->merchant_session["mer_id"];
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

        // $sql2 = "SELECT * FROM ". C('DB_PREFIX') . "fast_order as morder  WHERE morder.mer_id={$mer_id} AND morder.paid=1 ";
        $sql3 = "SELECT morder.* , u.nickname, u.avatar  FROM " . C('DB_PREFIX') . "fast_order as morder LEFT JOIN ".C('DB_PREFIX') . "user u ON morder.uid=u.uid WHERE morder.mer_id={$mer_id} AND morder.paid=1 order by morder.order_id DESC ";
        $mingxi = $mode->query($sql3);
        foreach ($mingxi as $key=>$value){
            if(empty($value['avatar'])){
                $mingxi[$key]['avatar']="http://www.xiaonongding.com/xnd.png";
            }elseif (substr($value['avatar'], 0, 4) == 'http'){

            }else{
                $merchant_image=new avatar_image();
                $mingxi[$key]['avatar']=   "http://www.xiaonongding.com".$merchant_image->get_image_by_path($value['avatar'])['image'];
            }

        }
        // echo  json_encode($mingxi);die;

        $this->assign("shouyilist",$mingxi);





        $this->display();
    }

    public function  detail(){
        //计算总已提现金额
        $sql="SELECT sum(c.cash_num) as countcash FROM ".C('DB_PREFIX') ."fast_bank_cash_info as c WHERE c.status in(0,1) and c.mer_id = ".$this->merid;
        $countcah=M()->query($sql);



        $mer_id=$this->merchant_session["mer_id"];
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

       // $sql2 = "SELECT * FROM ". C('DB_PREFIX') . "fast_order as morder  WHERE morder.mer_id={$mer_id} AND morder.paid=1 ";
        $sql3 = "SELECT morder.* , u.nickname, u.avatar  FROM " . C('DB_PREFIX') . "fast_order as morder LEFT JOIN ".C('DB_PREFIX') . "user u ON morder.uid=u.uid WHERE morder.mer_id={$mer_id} AND morder.paid=1 order by morder.order_id DESC ";
        $mingxi = $mode->query($sql3);
       // echo  json_encode($mingxi);die;

       $this->assign("shouyi",$res["0"]["price"]);
        $this->assign("shouyilist",$mingxi);
        $this->display();

    }

}