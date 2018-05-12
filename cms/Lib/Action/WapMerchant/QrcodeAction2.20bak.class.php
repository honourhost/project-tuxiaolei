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

}