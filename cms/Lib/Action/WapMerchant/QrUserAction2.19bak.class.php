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
    }
    public function index(){
        if($_GET["mer_id"]){
            $this->assign("merid",$_GET["mer_id"]);
           $this->display();
        }else{
            $this->error_tips("分发请求！");
        }
    }

    public function qrpng(){
        import('@.ORG.phpqrcode');
        QRcode::png('http://www.xiaonongding.com/index.php?g=WapMerchant&c=QrUser&a=index&mer_id='.$_GET["mer_id"]);

    }

}