<?php
/*
 * 图文后台管理
 *
 * @  Writers    sunny
 * @  BuildTime  2016/4/28 10.18
 * 
 */

class TextAction extends BaseAction{
    /**
     * 图文分类列表
     */
    public function index(){
        import('@.ORG.system_page');
        $count = M("Text_category")->count();
        $p = new Page($count, 20);
        $res=M("Text_category")->limit($p->firstRow.','.$p->listRows)->order("sort ASC")->select();
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);
        $this->assign("categories",$res);
        $this->display();
    }
    //图文分类添加
    public function addCat(){
    	if(IS_POST){
    	$Text_category=M("Text_category");

    	$data=$Text_category->create();

    	if($data){
    		$data['create_time']=time();
    		if($Text_category->add($data)){
    			 $this->success("新增图文分类成功！",U("Text/index"),true);
    		}else{
    			$this->error("新增图文分类失败！");
    		}
    	}else{
    		$this->error("新增图文分类失败！");
    	}
    	}else{
    	$this->display();
    	}
    }
    //图文分类编辑
    public function editCat(){
    	$Text_category=M("Text_category");
    	if(IS_POST){
    	$data=$Text_category->create();
    	if($data){
    		if($Text_category->save($data)){
    			 $this->success("修改图文分类成功！",U("Text/index"),true);
    		}else{
    			$this->error("修改图文分类失败！");
    		}
    	}else{
    		$this->error("修改图文分类失败！");
    	}
    	}else{
    	$id=intval($_GET['id']);
    	$cat=$Text_category->where("id=".$id)->find();
    	$this->assign("category",$cat);
    	$this->display();
    	}
    }
    //删除图文分类
    public function delCat(){
        if(IS_POST){
            $id=intval($_POST['id']);
            $Text_category=M("Text_category");
            //查看分类下是否有文章，有的话禁止删除
            $Image_text=M("Image_text");
            $res=$Image_text->where("cat_id=".$id)->find();
            if(!empty($res)){
                $this->error("该分类下存在图文内容，必须先删除内容后才能删除分类！");
            }
            if($Text_category->where("id=".$id)->delete()){
                $this->success("删除图文分类成功！");
            }else{
                $this->error("删除图文分类失败！");
            }
        }else{
            $this->error("传参出错！");
        }
    }
    //分类下图文列表管理
    public function textList(){
    	$id=intval($_GET['id']);
    	$this->assign("id",$id);
    	$Image_text=M("Image_text");
    	import('@.ORG.system_page');
        $count = $Image_text->where("cat_id=".$id)->count();
        $p = new Page($count, 20);
        $res=$Image_text->where("cat_id=".$id)->limit($p->firstRow.','.$p->listRows)->order("dateline DESC")->select();
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);
        $this->assign("text",$res);
    	$this->display();
    }
    //通过审核推荐方法
    public function confirm_manage(){
        $type=strval($_GET['type']);
        $id=intval($_GET['id']);
        if($type=="recommend"){
            $result=M("Image_text")->where("pigcms_id=".$id)->setField("recommend",1);
            if($result){
                $this->success("操作成功！");
            }else{
                $this->error("操作失败！");
            }
        }elseif($type=="check"){
            $result=M("Image_text")->where("pigcms_id=".$id)->setField("checkone",1);
            if($result){
                $this->success("操作成功！");
            }else{
                $this->error("操作失败！");
            }
        }else{
            $this->error("操作出错！");
        }
    }

    //取消审核推荐方法
    public function cancle_manage(){
        $type=strval($_GET['type']);
        $id=intval($_GET['id']);
        if($type=="recommend"){
            $result=M("Image_text")->where("pigcms_id=".$id)->setField("recommend",0);
            if($result){
                $this->success("操作成功！");
            }else{
                $this->error("操作失败！");
            }
        }elseif($type=="check"){
            $result=M("Image_text")->where("pigcms_id=".$id)->setField("checkone",0);
            if($result){
                $this->success("操作成功！");
            }else{
                $this->error("操作失败！");
            }
        }else{
            $this->error("操作出错！");
        }
    }
}