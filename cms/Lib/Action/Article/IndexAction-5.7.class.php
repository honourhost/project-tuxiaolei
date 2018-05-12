<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/5/6
 * Time: 10:19
 */
class IndexAction extends BaseAction{
	
    public function index(){
    	//文章分类查询
    	$textCat=M("Text_category");
    	$catlist=$textCat->order("sort ASC")->select();
    	$this->assign("lists",$catlist);
    	//推荐文章查询
    	$text=M("Image_text");
    	import('@.ORG.group_page');
    	$where=array(
    		"t.recommend"=>1,
            "t.check"=>1
    		);
		$count_text = $text->alias("t")->join(C('DB_PREFIX')."merchant as m ON t.mer_id=m.mer_id")->where($where)->count();
		$p = new Page($count_text,10,C('config.group_page_val'));
    	$texts=$text->alias("t")->join(C('DB_PREFIX')."merchant as m ON t.mer_id=m.mer_id")->where($where)->limit($p->firstRow.','.$p->listRows)->select();
    	$merchant_image_class=new merchant_image();
        foreach($texts as $key=>$val) {
            if (!empty($val['merchant_theme_image'])) {
                $texts[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            }
            if(!empty($val['person_image'])){
            	$texts[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
            }
        }
    	$this->assign("texts",$texts);
    	$this->assign("pagebar",$p->show());
    	
        $this->display();
    }

    public function artList(){
    	$cat_url=strval($_GET["cat_id"]);
    	if(empty($cat_url)){
    		$this->error("分类不存在或者传参出错！");
    	}

        //文章分类查询
        $textCat=M("Text_category");
        $catlist=$textCat->order("sort ASC")->select();
        $this->assign("lists",$catlist);

        if($cat_url!="all"){
    	//文章分类查询
    	$category=$textCat->where("cat_url='".$cat_url."'")->find();
    	//查询对应分类下的内容
    	$text=M("Image_text");
    	import('@.ORG.group_page');
    	$where=array(
    		"cat_id"=>$category['id'],
            "check"=>1
    		);
    	$count_text = $text->alias("t")->join(C('DB_PREFIX')."merchant as m ON t.mer_id=m.mer_id")->where($where)->count();
    	$p = new Page($count_text,10,C('config.group_page_val'));
    	$texts=$text->alias("t")->join(C('DB_PREFIX')."merchant as m ON t.mer_id=m.mer_id")->where($where)->limit($p->firstRow.','.$p->listRows)->select();
    	$merchant_image_class=new merchant_image();
        foreach($texts as $key=>$val) {
            if (!empty($val['merchant_theme_image'])) {
                $texts[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            }
            if(!empty($val['person_image'])){
            	$texts[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
            }
        }
        }else{
        //查询对应分类下的内容
        $text=M("Image_text");
        import('@.ORG.group_page');
        $where=array(
            "check"=>1
            );
        $count_text = $text->alias("t")->join(C('DB_PREFIX')."merchant as m ON t.mer_id=m.mer_id")->where($where)->count();
        $p = new Page($count_text,10,C('config.group_page_val'));
        $texts=$text->alias("t")->join(C('DB_PREFIX')."merchant as m ON t.mer_id=m.mer_id")->where($where)->limit($p->firstRow.','.$p->listRows)->select();
        $merchant_image_class=new merchant_image();
        foreach($texts as $key=>$val) {
            if (!empty($val['merchant_theme_image'])) {
                $texts[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            }
            if(!empty($val['person_image'])){
                $texts[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
            }
        }
        }
    	$this->assign("texts",$texts);
    	$this->assign("pagebar",$p->show());
    	$this->display();
    }
    public function detail(){
    	$id=intval($_GET['article_id']);
    	if(empty($id)){
    		$this->error("文章不存在或者传参出错！");
    	}
    	$text=M("Image_text");
    	$article=$text->where("pigcms_id=".$id)->find();
    	$this->assign("article",$article);
    	$this->display();
    }
}