<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19 0019
 * Time: 18:07
 */
class QrcodeAction extends BaseAction
{


    protected $merchant_session;

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

        $this->assign('merid', $this->merid);
        $this->assign('mer_name', $this->merchant_session['name']);
        $this->assign('site_URl', trim($this->config['site_url'], '/'));
        $this->assign('merchantstatic_path', $this->config['site_url'] . '/tpl/Merchant/static/');
    }


    public function index(){

        if(empty($this->merid)){
            $this->error_tips("商户id不存在");die;
        }
        $merinfo=D("Merchant")->where(array("mer_id"=>$this->merid))->find();
        if($merinfo){
            $merchant_image=new merchant_image();
            $merinfo['person_image']=$merchant_image->get_image_by_path($merinfo['person_image']);



        }else{
            $this->error_tips("没有查找到商家信息！");die;
        }
        $this->assign("merinfo",$merinfo);
        $this->assign("merid",$this->merid);
        $this->display();
    }

    public function qrpng(){
        import('@.ORG.phpqrcode');
        QRcode::png('http://www.xiaonongding.com/merchantbuy.php?g=MerchantBuy&c=index&a=pay&mer_id='.$this->merid);

    }

    public function  fensi(){
        $fanscount=D("Merchant_user_relation")->where(array("mer_id"=>$this->merid))->count();
        $mode = new Model();
  //$sql="SELECT allst.* FROM(SELECT uinfo.nickname,uinfo.avatar, orinfo.openid , orinfo.paycount,orinfo.totalmoney FROM (SELECT mur.openid ,u.nickname,u.avatar FROM pigcms_merchant_user_relation mur LEFT JOIN pigcms_user u ON mur.openid=u.openid WHERE mur.mer_id=".$this->merid.") uinfo LEFT JOIN (SELECT  COUNT(go.payment_money) as paycount ,SUM(go.payment_money) as totalmoney,go.openid FROM pigcms_fast_order  go GROUP BY go.openid) orinfo ON uinfo.openid=orinfo.openid WHERE orinfo.openid is not null) as allst GROUP BY allst.openid order by allst.paycount desc";
        $sql="SELECT allst.* FROM(SELECT uinfo.nickname,uinfo.avatar, orinfo.openid , orinfo.paycount,orinfo.totalmoney FROM (SELECT mur.openid ,u.nickname,u.avatar FROM pigcms_merchant_user_relation mur LEFT JOIN pigcms_user u ON mur.openid=u.openid WHERE mur.mer_id=".$this->merid.") uinfo LEFT JOIN (SELECT  COUNT(go.payment_money) as paycount ,SUM(go.payment_money) as totalmoney,go.openid,go.mer_id FROM pigcms_fast_order  go  WHERE go.mer_id = ".$this->merid." GROUP BY go.openid ) orinfo ON uinfo.openid=orinfo.openid WHERE orinfo.openid is not null ) as allst GROUP BY allst.openid order by allst.paycount desc";
        $mingxi = $mode->query($sql);
        if($mingxi){
            foreach ($mingxi as $key=>$value){
                if(empty($value['avatar'])){
                    $mingxi[$key]['avatar']="http://www.xiaonongding.com/xnd.png";
                }elseif (substr($value['avatar'], 0, 4) == 'http'){

                }else{
                    $merchant_image=new avatar_image();
                    $mingxi[$key]['avatar']=   "http://www.xiaonongding.com".$merchant_image->get_image_by_path($value['avatar'])['image'];
                }

            }
            $this->assign("fans",$mingxi);
        }
       // echo  json_encode($mingxi);die;
        $this->assign("fanscount",count($mingxi));
        $this->display();
    }

}