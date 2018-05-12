<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/19 0019
 * Time: 19:33
 */
class QrUserAction extends CommonAction
{
    public function _initialize(){
        $this->static_path = '/tpl/WapMerchant/' . C('DEFAULT_THEME') . '/static/';
        $this->assign('static_path', $this->static_path);
        $share = new WechatShare($this->config, $GLOBALS['_SESSION']['openid']);
        $this->shareScript = $share->getSgin();
        $this->assign('shareScript', $this->shareScript);
    }
    public function index(){
        if($_GET["mer_id"]){
            $this->assign("merid",$_GET["mer_id"]);
            $merinfo=D("Merchant")->where(array("mer_id"=>$_GET["mer_id"]))->find();
            if($merinfo){
                $merchant_image=new merchant_image();
                $merinfo['person_image']=$merchant_image->get_image_by_path($merinfo['person_image']);



            }else{
                $this->error_tips("没有查找到商家信息！");die;
            }
            $this->assign("merinfo",$merinfo);
           $this->display();
        }else{
            $this->error_tips("分发请求！");
        }
    }

    public function qrpng(){
        import('@.ORG.phpqrcode');
        QRcode::png("http://www.xiaonongding.com/merchantbuy.php?g=MerchantBuy&c=Index&a=pay&mer_id=".$_GET['mer_id']);

    }

}