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

    public function searchByArea(){
            //所有地区
            $allareas=null;
        if(!empty($_GET['area_name'])){
            $area_name=$_GET['area_name'];
            $Area=D("area");
            $areas=$Area->where("area_name like %".$area_name."%")->select();
            foreach ($areas as $key => $val) {
                $allareas[]=$val['area_id'];
                $childareas=$Area->where("area_pid=".$val['area_id'])->select();
                if(!empty($childareas)){
                foreach($childareas as $childval){
                    $allareas[]=$childval['area_id'];
                }
                }
            }
        }

        if(!empty($_POST['area_name'])){
            $area_name=$_GET['area_name'];
            $Area=D("area");
            $areas=$Area->where("area_name like %".$area_name."%")->select();
            foreach ($areas as $key => $val) {
                $allareas[]=$val['area_id'];
                $childareas=$Area->where("area_pid=".$val['area_id'])->select();
                if(!empty($childareas)){
                foreach($childareas as $childval){
                    $allareas[]=$childval['area_id'];
                }
                }
            }
        }
        if(!empty($allareas)){
            $area_idstr=implode(',',$allareas);
            import('@.ORG.group_page');
            $farm_group = D('Merchant')->count();
            $p = new Page($farm_group,10,C('config.group_page_val'));
            $farm_list = D('Merchant')->where(array("status"=>1,"area_id"=>array("IN ".$area_idstr)))->limit($p->firstRow.','.$p->listRows)->select();
            $merchant_image_class=new merchant_image();
            foreach($farm_list as $key=>$val) {
            if (!empty($val['person_image'])) {
                $farm_list[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
            }
            if (!empty($val['merchant_theme_image'])) {
                $farm_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            }
            }
             $page=$p->show();
             $this->assign("page",$page);
            $this->assign("farm_list",$farm_list);
            $this->display("index/searchResult");
        }else{
            $this->display("index/searchResult");
        }
    }

    public function searchByTitle(){
            import('@.ORG.group_page');
            $title=$_POST['title_name'];
            $farm_group = D('Merchant')->where("status=1 AND name like '%".$title."%' OR txt_info like '%".$title."%' OR person_name like '%".$title."%' OR person_info like '%".$title."%'")->count();
            $p = new Page($farm_group,10,C('config.group_page_val'));
            $farm_list = D('Merchant')->where("status=1 AND name like '%".$title."%' OR txt_info like '%".$title."%' OR person_name like '%".$title."%' OR person_info like '%".$title."%'")->limit($p->firstRow.','.$p->listRows)->select();
            $merchant_image_class=new merchant_image();
            foreach($farm_list as $key=>$val) {
            if (!empty($val['person_image'])) {
                $farm_list[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
            }
            if (!empty($val['merchant_theme_image'])) {
                $farm_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            }
            }
            $page=$p->show();
            $this->assign("page",$page);
            $this->assign("farm_list",$farm_list);
            $this->display("index/searchResult");
    }

    public function searchByKw(){
        $keyword=$_GET['kw'];
        if(!empty($keyword)){
            $farm_group = D('Merchant')->where("status=1 AND name like '%".$keyword."%' OR txt_info like '%".$keyword."%' OR person_name like '%".$keyword."%' OR person_info like '%".$keyword."%'")->count();
            $p = new Page($farm_group,10,C('config.group_page_val'));
            $farm_list = D('Merchant')->where("status=1 AND name like '%".$keyword."%' OR txt_info like '%".$keyword."%' OR person_name like '%".$keyword."%' OR person_info like '%".$keyword."%'")->limit($p->firstRow.','.$p->listRows)->select();
            $merchant_image_class=new merchant_image();
            foreach($farm_list as $key=>$val) {
            if (!empty($val['person_image'])) {
                $farm_list[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
            }
            if (!empty($val['merchant_theme_image'])) {
                $farm_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            }
            }
            $page=$p->show();
            $this->assign("page",$page);
            $this->assign("farm_list",$farm_list);
            $this->display("index/searchResult");
        }else{
            $this->display("index/searchResult");
        }
    }
}