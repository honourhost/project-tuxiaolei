<?php
/*
 * 微信图文的文章页
 *
 */
class ArticleAction extends BaseAction{
	public function __construct()
	{
		parent::__construct();
	}
	public function index(){
		
		if (isset($_GET['imid'])) {
			$id = isset($_GET['imid']) ? intval($_GET['imid']) : 0;
			$image_text = D('Image_text')->where(array('pigcms_id' => $id))->find();
			$image_text['now'] = date('Y-m-d',$image_text['dateline']);
			//点击数+1
			D('Image_text')->where(array('pigcms_id' => $id))->setInc('count'); 
			$this->assign('url', U('Article/index', array('imid' => $image_text['pigcms_id'])));
		} elseif (isset($_GET['sid'])) {
			$id = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
			$image_text = D('Platform')->where(array('id' => $id))->find();
			$image_text['cover_pic'] = $this->config['site_url'] . $image_text['pic'];
			$image_text['now'] = date('Y-m-d');
			$this->assign('url', U('Article/index', array('sid' => $image_text['id'])));
		}
		//自动成为自营店粉丝
		if(!empty($_SESSION['openid'])){
			D("Merchant")->saveRelation($_SESSION['openid'],629,false);
		}
		isset($image_text['content']) && !empty($image_text['content']) && $image_text['content']=htmlspecialchars_decode($image_text['content'],ENT_QUOTES);
        $condition["cat_id"]=$image_text["cat_id"];
        $condition["pigcms_id"]=array("neq",$id);
        $tuijian=D("Image_text")->where($condition)->order('dateline DESC')->limit(6)->select();
        $this->assign("tuijian",$tuijian);
		$this->assign('nowImage', $image_text);
		$this->display();
	}
}
?>