<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/3/30
 * Time: 11:16
 */
class ElseAction extends BaseAction{
    //发布会人员列表
    public function conference(){
        import('@.ORG.system_page');
        $count = D("Conference")->count();
        $p = new Page($count, 20);
        $res=D("Conference")->limit($p->firstRow.','.$p->listRows)->select();
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);
        $this->assign("persons",$res);
        $this->display();
    }
}