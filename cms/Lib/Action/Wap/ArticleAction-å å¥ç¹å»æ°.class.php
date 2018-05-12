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
			$image_text['now'] = date('Y-m-d');
			$this->assign('url', U('Article/index', array('imid' => $image_text['pigcms_id'])));
		} elseif (isset($_GET['sid'])) {
			$id = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
			$image_text = D('Platform')->where(array('id' => $id))->find();
			$image_text['cover_pic'] = $this->config['site_url'] . $image_text['pic'];
			$image_text['now'] = date('Y-m-d');
			$this->assign('url', U('Article/index', array('sid' => $image_text['id'])));
		}
		isset($image_text['content']) && !empty($image_text['content']) && $image_text['content']=htmlspecialchars_decode($image_text['content'],ENT_QUOTES);
		$this->assign('nowImage', $image_text);
		$this->display();
	}
}
?>