<?php

/*
 * 商家前台展示信息后台管理 控制器
 *
 * @  Writers    LiHongShun
 * @  BuildTime  2015/06/06
 * 
 */

class FrontmanagAction extends BaseAction {

    public $mer_id = 0;

    public function _initialize() {
        parent::_initialize();
        $this->mer_id = $this->merchant_session['mer_id'];
    }

    /* 商家介绍设置 */

    public function index() {
        $this->introduce();
    }

    public function introduce() {
        $merchant_inDb = D('Merchant_introduce');
        $introduce = $merchant_inDb->field('id,mer_id,title,sort,isfabu,addtime')->where(array('mer_id' => $this->mer_id, 'comefrom' => '0'))->order('sort DESC,id ASC')->select();
        $this->assign('introduce', $introduce);
        $this->display('introduce');
    }
    
     //农场视频管理 by sunny 2015.12.15
    public function videomanag(){
        $merchant_video=D("Merchant_video");
        $videos = $merchant_video->field('id,mer_id,video_name,video_url,sort,create_time')->where(array('mer_id' => $this->mer_id, 'status' => '1'))->order('sort DESC')->select();
        $this->assign('videos', $videos);
        $this->display('allvideos');
    }

    public function addvideo(){
        if(!empty($_POST)){
            $merchant_video=D("Merchant_video");
            $data['video_name']=$_POST['video_name'];
            $data['video_url']=$_POST['video_url'];
            $data['create_time']=time();
            $data['status']=1;
            $data['sort']=$_POST['sort'];
            $data['mer_id']=$this->mer_id;
            if($merchant_video->data($data)->add($data)){
                $this->success('保存成功！', U("Frontmanag/videomanag"));
            }else{
                $this->error('保存失败！请检查是否有填写错误内容后重试');
            }
        }else{
            $this->display('addvideo');
        }
    }

    public function editvideo(){
        $merchant_video=D("Merchant_video");
        if(!empty($_POST)){
            $data['video_name']=$_POST['video_name'];
            $data['video_url']=$_POST['video_url'];
            $data['id']=$_POST['id'];
            $data['create_time']=time();
            $data['sort']=$_POST['sort'];
            $data['status']=1;
            $data['mer_id']=$this->mer_id;
            if($merchant_video->data($data)->save()){
                $this->success('修改成功！', U("Frontmanag/videomanag"));
            }else{
                $this->error('保存失败！请检查是否有修改过内容后重试');
            }
        }else{
            $id = intval($_GET['id']);
            $where = array('id' => $id, 'mer_id' => $this->mer_id);
            $video = $merchant_video->where($where)->find();
            $this->assign("video",$video);
            $this->display('editvideo');
        }
    }

    public function deletevideo(){
        $merchant_video=D("Merchant_video");
        $result=$merchant_video->where("id=".$_GET['id'])->setField("status",0);
        if($result){
            $this->success('删除成功！', U("Frontmanag/videomanag"));
        }else{
            $this->error('删除失败');
        }
    }

    //详细内容的模块管理
    public function detailmodulemanag(){
        $merchant_detailmodule=D("Merchant_detailmodule");
        $modules = $merchant_detailmodule->field('id,mer_id,module_name,create_time,sort')->where(array('mer_id' => $this->mer_id, 'status' => '1'))->order('sort DESC')->select();
        $this->assign('alldetailmodules', $modules);
        $this->display('alldetailmodules');
    }

    public function addmodule(){
        if(!empty($_POST)){
            $merchant_detailmodule=D("Merchant_detailmodule");
            $data['module_name']=$_POST['module_name'];
            $data['create_time']=time();
            $data['sort']=$_POST['sort'];
            $data['status']=1;
            $data['mer_id']=$this->mer_id;
            if($merchant_detailmodule->data($data)->add()){
                $this->success('保存成功！', U("Frontmanag/detailmodulemanag"));
            }else{
                $this->error('保存失败！请检查是否有填写错误内容后重试');
            }
        }else{
            $this->display('addmodule');
        }
    }

    public function editmodule(){
        $merchant_detailmodule=D("Merchant_detailmodule");
        if(!empty($_POST)){
            $data['module_name']=$_POST['module_name'];
            $data['id']=$_POST['id'];
            $data['create_time']=time();
            $data['status']=1;
            $data['sort']=$_POST['sort'];
            $data['mer_id']=$this->mer_id;
            if($merchant_detailmodule->data($data)->save()){
                $this->success('修改成功！', U("Frontmanag/detailmodulemanag"));
            }else{
                $this->error('保存失败！请检查是否有修改过内容后重试');
            }
        }else{
            $id = intval($_GET['id']);
            $where = array('id' => $id, 'mer_id' => $this->mer_id);
            $module = $merchant_detailmodule->where($where)->find();
            $this->assign("module",$module);
            $this->display('editmodule');
        }
    }

    public function deletemodule(){
        $merchant_detailmodule=D("Merchant_detailmodule");
        $result=$merchant_detailmodule->where("id=".$_GET['id'])->setField("status",0);
        if($result){
            $this->success('删除成功！', U("Frontmanag/detailmodulemanag"));
        }else{
            $this->error('删除失败');
        }
    }

    public function fbintroduce() {
        $merchant_inDb = D('Merchant_introduce');
        if (IS_POST) {
            $id = intval($_POST['idx']);
            $_POST['mer_id'] = $this->mer_id;
            $_POST['content'] = trim($_POST['description']);
            $notitle = intval($_POST['notitle']);
            if (empty($_POST['title']) && !$notitle) {
                $this->error('标题不能为空，请填写！');
                exit();
            }
            unset($_POST['description'], $_POST['idx'], $_POST['notitle']);
            if ($id > 0) {
                unset($_POST['mer_id']);
                $insert_id = $merchant_inDb->where(array('id' => $id, 'mer_id' => $this->mer_id))->save($_POST);
            } else {
                $_POST['addtime'] = time();
                $insert_id = $merchant_inDb->data($_POST)->add();
            }
            if ($insert_id > 0) {
                $this->success('保存成功！', $notitle ? U('Frontmanag/navmanag') : U('Frontmanag/introduce'));
            } else {
                $this->error('保存失败！请检查是否有修改过内容后重试');
            }
        } else {
            $id = intval($_GET['id']);
            $where = array('id' => $id, 'mer_id' => $this->mer_id, 'comefrom' => '0');
            $fbintroduce = $merchant_inDb->where($where)->find();
            //echo $merchant_inDb->getLastSql();
            if (empty($fbintroduce))
                $fbintroduce = array('id' => 0, 'mer_id' => $this->mer_id, 'title' => '', 'content' => '', 'sort' => 0, 'isfabu' => 1);
             $modules=D("Merchant_detailmodule")->where(array("mer_id"=>$this->mer_id,"status"=>1))->order("sort asc")->select();
            $this->assign("modules",$modules);
            $this->assign('notitle', 0);
            $this->assign('fbintroduce', $fbintroduce);
            $this->display('fbintroduce');
        }
    }

    /*     * ****导航内容发布****** */

    public function fbcontent() {
        $navid = intval($_GET['navid']);
        $Db_navset = D('Merchant_navset');
        $merchant_inDb = D('Merchant_introduce');
        $navtmp = D('Merchant_navcom')->where(array('navid' => $navid, 'iscontent' => '1'))->find();
        $navset = $Db_navset->where(array('navid' => $navid, 'mer_id' => $this->mer_id))->find();
        $fbintroduce = array('mer_id' => $this->mer_id, 'title' => $navtmp['zhname'], 'sort' => 0, 'isfabu' => 1, 'content' => '', 'addtime' => time(), 'comefrom' => 7);
        if (empty($navset)) {
            $navset_id = $Db_navset->add(array('navid' => $navid, 'mer_id' => $this->mer_id, 'isshow' => 1, 'intrid' => 0));
            $insert_id = $merchant_inDb->data($fbintroduce)->add();
            $Db_navset->where(array('navid' => $navid, 'mer_id' => $this->mer_id))->save(array('intrid' => $insert_id));
            $fbintroduce['id'] = $insert_id;
        } elseif (!($navset['intrid'] > 0)) {
            $insert_id = $merchant_inDb->data($fbintroduce)->add();
            $Db_navset->where(array('navid' => $navid, 'mer_id' => $this->mer_id))->save(array('intrid' => $insert_id));
            $fbintroduce['id'] = $insert_id;
        } else {
            $fbintroduce = $merchant_inDb->where(array('id' => $navset['intrid'], 'mer_id' => $this->mer_id, 'comefrom' => '7'))->find();
        }
        $this->assign('notitle', 1);
        $this->assign('fbintroduce', $fbintroduce);
        $this->display('fbintroduce');
    }

    public function fbStatus() {
        $id = intval($_POST['idx']);
        if ($id > 0) {
            $insert_id = D('Merchant_introduce')->where(array('id' => $id, 'mer_id' => $this->mer_id))->save(array('isfabu' => 1));
            if ($insert_id) {
                $this->dexit(array('error' => 0));
            }
        }
        $this->dexit(array('error' => 1));
    }

    public function delintroduce() {
        $id = intval($_POST['idx']);
        if ($id > 0) {
            $insert_id = D('Merchant_introduce')->where(array('id' => $id, 'mer_id' => $this->mer_id))->delete();
            if ($insert_id) {
                $this->dexit(array('error' => 0));
            }
        }
        $this->dexit(array('error' => 1));
    }

    public function renews() {
        $merchant_inDb = D('Merchant_introduce');
        $jointable = C('DB_PREFIX') . 'merchant_classify';
        $merchant_inDb->join('as mi LEFT JOIN ' . $jointable . ' as mc on mi.cyid=mc.id');
        $introduce = $merchant_inDb->field('mi.id,mi.mer_id,mi.title,mi.sort,mi.isfabu,mi.addtime,mi.cyid,mc. 	cyname')->where(array('mi.mer_id' => $this->mer_id, 'mi.comefrom' => '1'))->order('mi.sort DESC,mi.id ASC')->select();
        $this->assign('introduce', $introduce);
        $this->display();
    }

    public function fbrenews() {
        $merchant_cyDb = D('Merchant_classify');
        $merchant_inDb = D('Merchant_introduce');
        if (IS_POST) {
            $id = intval($_POST['idx']);
            $_POST['mer_id'] = $this->mer_id;
            $_POST['content'] = trim($_POST['description']);
            if (empty($_POST['title'])) {
                $this->error('标题不能为空，请填写！');
                exit();
            }
            unset($_POST['description'], $_POST['idx']);
            if ($id > 0) {
                unset($_POST['mer_id']);
                $insert_id = $merchant_inDb->where(array('id' => $id, 'mer_id' => $this->mer_id, 'comefrom' => '1'))->save($_POST);
            } else {
                $_POST['comefrom'] = 1;
                $_POST['addtime'] = time();
                $insert_id = $merchant_inDb->data($_POST)->add();
            }
            if ($insert_id > 0) {
                $this->success('保存成功！', U('Frontmanag/renews'));
            } else {
                $this->error('保存失败！请检查是否有修改过内容后重试');
            }
        } else {
            $id = intval($_GET['id']);
            $fbintroduce = $merchant_inDb->where(array('id' => $id, 'mer_id' => $this->mer_id, 'comefrom' => '1'))->find();
            //echo $merchant_inDb->getLastSql();
            if (empty($fbintroduce))
                $fbintroduce = array('id' => 0, 'mer_id' => $this->mer_id, 'title' => '', 'content' => '', 'sort' => 0, 'isfabu' => 1, 'cyid' => 0);
            $classifyarr = $merchant_cyDb->where(array('mer_id' => $this->mer_id, 'typ' => '0'))->order('sort DESC,id ASC')->select();
            $this->assign('classifyarr', $classifyarr);
            $this->assign('fbintroduce', $fbintroduce);
            $this->display();
        }
    }

    /*     * *****分类管理******** */

    public function mclassify() {
        /*         * *typ 0商家动态1相册***** */
        $merchant_cyDb = D('Merchant_classify');
        $classifyarr = $merchant_cyDb->where(array('mer_id' => $this->mer_id))->order('sort DESC,id ASC')->select();
        $this->assign('classifyarr', $classifyarr);
        $this->display();
    }

    public function classify() {
        $merchant_cyDb = D('Merchant_classify');
        if (IS_POST) {
            $id = intval($_POST['idx']);
            $cyname = trim($_POST['cyname']);
            $typ = intval($_POST['typ']);
            $sort = intval($_POST['sort']);
            $datas = array('cyname' => $cyname, 'typ' => $typ, 'sort' => $sort, 'addtime' => time());
            if ($id > 0) {
                $insert_id = $merchant_cyDb->where(array('id' => $id, 'mer_id' => $this->mer_id))->save($datas);
            } else {
                $datas['mer_id'] = $this->mer_id;
                $insert_id = $merchant_cyDb->data($datas)->add();
            }
            if ($insert_id > 0) {
                if ($id > 0) {
                    $this->success('保存成功！', U('Frontmanag/mclassify'));
                } else {
                    $this->success('保存成功！');
                }
            } else {
                $this->error('保存失败！请检查是否有修改过内容后重试');
            }
        } else {
            $id = intval($_GET['id']);
            $typ = intval($_GET['typ']);
            $classify = $merchant_cyDb->where(array('id' => $id, 'mer_id' => $this->mer_id))->find();
            //echo $merchant_cyDb->getLastSql();
            if (empty($classify))
                $classify = array('id' => 0, 'mer_id' => $this->mer_id, 'cyname' => '', 'sort' => 0, 'typ' => $typ);
            $this->assign('classify', $classify);
            $this->display();
        }
    }

    public function gallery() {
        /*         * *typ 0商家动态1相册***** */
        $merchant_cyDb = D('Merchant_classify');
        $classifyarr = $merchant_cyDb->where(array('mer_id' => $this->mer_id, 'typ' => 1))->order('sort DESC,id ASC')->select();
        if (!empty($classifyarr)) {
            $merchant_imgDb = D('Merchant_imgs');
            foreach ($classifyarr as $kk => $vv) {
                $imgs = $merchant_imgDb->where(array('mer_id' => $this->mer_id, 'cyid' => $vv['id']))->order('id DESC')->find();
                $classifyarr[$kk]['lastimg'] = !empty($imgs) ? $imgs['imgstr'] : '';
            }
        }
        $this->assign('classifyarr', $classifyarr);
        $this->display();
    }

    public function navmanag() {
        $merchant_inDb = D('Merchant_navcom');
        $navmanag = $merchant_inDb->where('22=22')->order('navid ASC')->select();
        $tmp = array();
        foreach ($navmanag as $nmvv) {
            $tmp[$nmvv['navid']] = $nmvv;
        }

        $navset = D('Merchant_navset')->where(array('mer_id' => $this->mer_id))->select();
        if (!empty($navset)) {
            foreach ($navset as $vv) {
                $tmp[$vv['navid']]['isshow'] = $vv['isshow'];
				!empty($vv['zhname']) && $tmp[$vv['navid']]['zhname'] = $vv['zhname'];
            }
        }
        unset($navmanag, $navset);
        $this->assign('navmanag', $tmp);
        $this->display();
    }

    public function upnavS() {
        $navid = intval($_POST['idx']);
        $s = intval($_POST['num']);
        $msg = '';
        if ($s == 1) {
            $s = 0;
            $msg = '隐藏';
        } else {
            $s = 1;
            $msg = '显示';
        }
        $Db_navset = D('Merchant_navset');
        $navset = $Db_navset->where(array('navid' => $navid, 'mer_id' => $this->mer_id))->find();
        if (!empty($navset)) {
            if ($navset['isshow'] == 1) {
                $s = 0;
                $msg = '隐藏';
            } else {
                $s = 1;
                $msg = '显示';
            }
            $Db_navset->where(array('navid' => $navid, 'mer_id' => $this->mer_id))->save(array('isshow' => $s));
        } else {
            $Db_navset->add(array('navid' => $navid, 'mer_id' => $this->mer_id, 'isshow' => $s));
        }
        $this->dexit(array('error' => 0, 'msg' => $msg));
    }

    public function upnavN() {
	    $navid = intval($_POST['idx']);
        $navm = trim($_POST['navm']);
		if(empty($navm)) $this->dexit(array('error' => 1, 'msg' =>'导航名不能为空！'));
        $Db_navset = D('Merchant_navset');
        $navset = $Db_navset->where(array('navid' => $navid, 'mer_id' => $this->mer_id))->find();
		if(!empty($navset)){
			$Db_navset->where(array('navid' => $navid, 'mer_id' => $this->mer_id))->save(array('zhname' => $navm));
		}else{
		   $Db_navset->add(array('navid' => $navid, 'mer_id' => $this->mer_id, 'isshow' => 1,'zhname' => $navm));
		}
		$this->dexit(array('error' => 0, 'msg' => '修改成功'));
	}
    public function save_pic() {
        $cyid = intval($_POST['cyid']);
        $imgurl = trim($_POST['imgurl']);
        $insert_id = 0;
        if (($cyid > 0) && !empty($imgurl)) {
            $imgurl = ltrim($imgurl, '.');
            $merchant_imgDb = D('Merchant_imgs');
            $insert_id = $merchant_imgDb->add(array('mer_id' => $this->mer_id, 'imgstr' => $imgurl, 'cyid' => $cyid, 'addtime' => time()));
        }
        $this->dexit(array('error' => 0, 'insertid' => $insert_id));
    }

    public function allpic() {
        $cyid = intval($_GET['cyid']);
        $where = array('mer_id' => $this->mer_id);
        if ($cyid > 0)
            $where['cyid'] = $cyid;
        $merchant_imgDb = D('Merchant_imgs');
        $img_count = $merchant_imgDb->where($where)->count();
        import('@.ORG.merchant_page');
        $p = new Page($img_count, 20);
        $imgs = $merchant_imgDb->where($where)->limit($p->firstRow . ',' . $p->listRows)->select();
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $merchant_cyDb = D('Merchant_classify');
        $where['typ'] = 1;
        $classifyarr = $merchant_cyDb->where($where)->select();
        $classifytmp = array();
        foreach ($classifyarr as $vv) {
            $classifytmp[$vv['id']] = $vv['cyname'];
        }

        $this->assign('bg_color', '#F3F3F3');
        $this->assign('imgs', $imgs);
        $this->assign('classify', $classifytmp);
        $this->display();
    }

    /*     * ****删除分类****** */

    public function delclassify() {
        $id = intval($_POST['idx']);
        $classify_Db = D('Merchant_classify');
        $tmpCY = $classify_Db->where(array('id' => $id, 'mer_id' => $this->mer_id))->find();
        if ($classify_Db->where(array('id' => $id, 'mer_id' => $this->mer_id))->delete()) {
            if ($tmpCY['typ'] == 1) {
                $imgs_Db = D('Merchant_imgs');
                $imgs = $imgs_Db->where(array('cyid' => $tmpCY['id'], 'mer_id' => $this->mer_id))->select();
                foreach ($imgs as $vv) {
                    unlink('.' . $vv['imgstr']);
                }
                $imgs_Db->where(array('cyid' => $tmpCY['id'], 'mer_id' => $this->mer_id))->delete();
            } elseif ($tmpCY['typ'] == 0) {
                D('Merchant_introduce')->where(array('cyid' => $tmpCY['id'], 'mer_id' => $this->mer_id, 'comefrom' => 1))->delete();
            }
            $this->dexit(array('error' => 0));
        }
        $this->dexit(array('error' => 1));
    }

    public function delImg() {
        $id = intval($_POST['idx']);
        $imgs_Db = D('Merchant_imgs');
        $tmpImg = $imgs_Db->where(array('id' => $id, 'mer_id' => $this->mer_id))->find();
        if ($imgs_Db->where(array('id' => $tmpImg['id'], 'mer_id' => $this->mer_id))->delete()) {
            unlink('.' . $tmpImg['imgstr']);
            $this->dexit(array('error' => 0));
        }
        $this->dexit(array('error' => 1));
    }

    /*     * json 格式封装函数* */

    private function dexit($data = '') {
        if (is_array($data)) {
            echo json_encode($data);
        } else {
            echo $data;
        }
        exit();
    }

}

?>