<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2015/12/11
 * Time: 14:28
 */
class IndexAction extends BaseAction{
    public function index(){
    	import('@.ORG.group_page');
        $farm_group = D('Merchant')->count();
        $p = new Page($farm_group,10,C('config.group_page_val'));
        $farm_list = D('Merchant')->where(array("status"=>1))->limit($p->firstRow.','.$p->listRows)->select();
        $merchant_image_class=new merchant_image();
        foreach($farm_list as $key=>$val) {
            if (!empty($val['person_image'])) {
                $farm_list[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
            }
            if (!empty($val['merchant_theme_image'])) {
                $farm_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            }
        }
        $this->assign("farm_list",$farm_list);
        $page=$p->show();
        $this->assign("page",$page);
        $this->display();
    }

}