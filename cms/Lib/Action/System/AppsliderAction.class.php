<?php
/*
 * 导航管理
 *
 * @  Writers    sunny
 * @  BuildTime  2016/03/16 9:43
 * 
 */
class AppSliderAction extends BaseAction{
	public function index(){
		$database_slider_category  = D('App_slider_category');
		$category_list = $database_slider_category->field(true)->order('`cat_id` ASC')->select();
		$this->assign('category_list',$category_list);
		$this->display();
	}
	public function cat_add(){
		//如果当前用户存在地区分类
		if($_SESSION['system']['area_id']!=0){
			$this->error("您没有该权限");
		}
		$this->assign('bg_color','#F3F3F3');
		$this->display();
	}
	public function cat_modify(){
		//如果当前用户存在地区分类
		if($_SESSION['system']['area_id']!=0){
			$this->error("您没有该权限");
		}
		if(IS_POST){
			$database_slider_category  = D('App_slider_category');
			if($database_slider_category->data($_POST)->add()){
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function cat_edit(){
		
		$this->assign('bg_color','#F3F3F3');
		$now_category = $this->frame_check_get_category($_GET['cat_id']);
		$this->assign('now_category',$now_category);

		$this->display();
	}
	public function cat_amend(){
		//如果当前用户存在地区分类
		if($_SESSION['system']['area_id']!=0){
			$this->error("您没有该权限");
		}
		if(IS_POST){
			$database_slider_category  = D('App_slider_category');
			if($database_slider_category->data($_POST)->save()){
				$this->success('编辑成功！');
			}else{
				$this->error('编辑失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function cat_del(){
		//如果当前用户存在地区分类
		if($_SESSION['system']['area_id']!=0){
			$this->error("您没有该权限");
		}
		if(IS_POST){
			$database_slider_category  = D('App_slider_category');
			$condition_slider_category['cat_id'] = $_POST['cat_id'];
			if($database_slider_category->where($condition_slider_category)->delete()){
				//删除所有广告
				$database_slider = D('App_slider');
				$condition_slider['cat_id'] = $now_category['cat_id'];
				$slider_list = $database_slider->field(true)->where($condition_slider)->order('`id` DESC')->select();
				foreach($slider_list as $key=>$value){
					unlink('./upload/appslider/'.$value['pic']);
				}
				$database_slider->where($condition_slider)->delete();

				S('slider_list_'.$_POST['cat_id'],NULL);
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function slider_list(){
		$now_category = $this->check_get_category($_GET['cat_id']);
		$this->assign('now_category',$now_category);
		$database_slider = D('App_slider');
		$condition_slider['cat_id'] = $now_category['cat_id'];
		//如果当前用户存在地区分类
		if($_SESSION['system']['area_id']!=0){
			$condition_slider['area_id'] = $_SESSION['system']['area_id'];
		}
		$slider_list = $database_slider->field(true)->where($condition_slider)->order('`sort` DESC,`id` ASC')->select();
		$this->assign('slider_list',$slider_list);

		$this->display();
	}
	public function slider_add(){
		$this->assign('bg_color','#F3F3F3');
		$cat_id=intval($_GET['cat_id']);
		$now_category = $this->frame_check_get_category($cat_id);
		$this->assign('now_category',$now_category);

		$this->display();
	}
	public function slider_modify(){
		if($_FILES['pic']['error'] != 4){
			$image = D('Image')->handle($this->system_session['id'], 'appslider');
			if (!$image['error']) {

				$_POST = array_merge($_POST, str_replace('/upload/appslider/', '', $image['url']));
			} else {
				$this->frame_submit_tips(0, $image['msg']);
			}
			//上传图片
// 			$rand_num = date('Y/m',$_SERVER['REQUEST_TIME']);
// 			$upload_dir = './upload/slider/'.$rand_num.'/';
// 			if(!is_dir($upload_dir)){
// 				mkdir($upload_dir,0777,true);
// 			}
// 			import('ORG.Net.Uploa dFile');
// 			$upload = new Upload File();
// 			$upload->maxSize = 10*1024*1024;
// 			$upload->allowExts = array('jpg','jpeg','png','gif');
// 			$upload->allowTypes = array('image/png','image/jpg','image/jpeg','image/gif');
// 			$upload->savePath = $upload_dir;
// 			$upload->saveRule = 'uniqid';
// 			if($upload->upload()){
// 				$uploadList = $upload->getUpload FileInfo();
// 				$_POST['pic'] = $rand_num.'/'.$uploadList[0]['savename'];
// 			}else{
// 				$this->frame_submit_tips(0,$upload->getErrorMsg());
// 			}
		}
		$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
		$database_slider = D('App_slider');

		//如果当前用户存在地区分类
		if($_SESSION['system']['area_id']!=0){
			$_POST['area_id'] = $_SESSION['system']['area_id'];
		}
		if($id = $database_slider->data($_POST)->add()){
			D('Image')->update_table_id('/upload/appslider/' . $_POST['pic'], $id, 'appslider');
			S('app_slider_list_'.$_POST['cat_id'],NULL);
			$this->frame_submit_tips(1,'添加成功！');
		}else{
			$this->frame_submit_tips(0,'添加失败！请重试~');
		}
	}
	public function slider_edit(){
		$this->assign('bg_color','#F3F3F3');

		$database_slider = D('App_slider');
		$condition_slider['id'] = $_GET['id'];
		$now_slider = $database_slider->field(true)->where($condition_slider)->find();
		if(empty($now_slider)){
			$this->frame_error_tips('该导航不存在！');
		}
		$this->assign('now_slider',$now_slider);

		$this->display();
	}

	public function slider_amend(){
		$database_slider = D('App_slider');
		$condition_slider['id'] = $_POST['id'];
		$now_slider = $database_slider->field(true)->where($condition_slider)->find();

		if($_FILES['pic']['error'] != 4){

			$image = D('Image')->handle($this->system_session['id'], 'appslider');
			if (!$image['error']) {
				$_POST = array_merge($_POST, str_replace('/upload/appslider/', '', $image['url']));
				//$_POST = array_merge($_POST, $image['url']);
			} else {
				$this->frame_submit_tips(0, $image['msg']);
			}
		}
		$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
		if($database_slider->data($_POST)->save()){
			D('Image')->update_table_id('/upload/appslider/' . $_POST['pic'], $_POST['id'], 'appslider');
			S('app_slider_list_'.$_POST['cat_id'],NULL);
			if($_POST['pic']){
				if(strpos($now_slider['pic'],'2014/') === false){
					unlink('./upload/appslider/'.$now_slider['pic']);
				}
			}
			$this->frame_submit_tips(1,'编辑成功！');
		}else{
			$this->frame_submit_tips(0,'编辑失败！请重试~');
		}
	}

	public function slider_del(){
		$database_slider = D('App_slider');
		$condition_slider['id'] = $_POST['id'];
		$now_slider = $database_slider->field(true)->where($condition_slider)->find();
		if($database_slider->where($condition_slider)->delete()){
			S('app_slider_list_'.$now_slider['cat_id'],NULL);
			if($now_slider['pic']){
				if(strpos($now_slider['pic'],'2014/') === false){
					unlink('./upload/appslider/'.$now_slider['pic']);
				}
			}
			$this->success('删除成功');
		}else{
			$this->error('删除失败！请重试~');
		}
	}

	protected function get_category($cat_id){
		$database_slider_category  = D('App_slider_category');
		$condition_slider_category['cat_id'] = $cat_id;
		$now_category = $database_slider_category->field(true)->where($condition_slider_category)->find();
		return $now_category;
	}
	protected function frame_check_get_category($cat_id){
		$now_category = $this->get_category($cat_id);
		if(empty($now_category)){
			$this->frame_error_tips('分类不存在！');
		}else{
			return $now_category;
		}
	}
	protected function check_get_category($cat_id){
		$now_category = $this->get_category($cat_id);
		if(empty($now_category)){
			$this->error_tips('分类不存在！');
		}else{
			return $now_category;
		}
	}


	public function  catgoodslist(){
	  //  echo  json_encode($this->catgoodsearch($_GET["url"]));die;
        $result=$this->catgoodsearch($_GET["url"]);
        $this->assign("group_list",$result);
	    $this->display();


    }


    public function  catgoodsearch($caturl){

        //判断分类信息
        $cat_url = !empty($caturl) ? $caturl : 'xgrm';
        //根据分类信息获取分类
        if(!empty($cat_url)){
            $now_category = D('Group_category')->get_category_by_catUrl($cat_url);
            if(empty($now_category)){
                return  array();
            }

            if(!empty($now_category['cat_fid'])){
                $get_grouplist_catfid = 0;
                $get_grouplist_catid = $now_category['cat_id'];
            }else{
                $get_grouplist_catfid = $now_category['cat_id'];
                $get_grouplist_catid = 0;
            }
        }
        $result=$this->getgroupbycat($get_grouplist_catid,$get_grouplist_catfid);
        return $result;
    }

    /**
     * 根据分类id获取特卖
     * @param $catid
     * @param $catfid
     * @return mixed
     * item:    id,image,title,subtitle,sale_count,origin_price,current_price,link(platform(web,native),url()
     */
    private function getgroupbycat($catid,$catfid){
        $now_time = $_SERVER['REQUEST_TIME'];
        $condition="";
        if(!empty($catfid)){
            $condition.="status = 1 AND is_group_buy = 0 AND type = 1 AND begin_time< ".$now_time." AND end_time"." > ".$now_time." AND cat_fid = ".$catfid;
        }else{
            $condition.="status = 1 AND is_group_buy = 0 AND type = 1 AND begin_time< ".$now_time." AND end_time"." > ".$now_time." AND cat_id = ".$catid;
        }

        $data=  D("Group")->field("group_id,s_name,name,sale_count,virtual_num,old_price,price,wx_cheap,mer_id,pic,picapp,mer_id")->where($condition)->order("group_id DESC")->limit(6)->select();
        //     echo  D()->getLastSql();die;
        $groupimage=new group_image();
        $result=array();
        foreach ($data as $key=>$value){
            $result[$key]["id"]=$value["group_id"];
            if(empty($value["picapp"])){
                $images=$groupimage->get_image_by_path($value["pic"]);

            }else{
                $images=$groupimage->get_image_by_path($value["picapp"]);

            }
            $result[$key]["image"]=$images['image'];
            $result[$key]["title"]=$value["s_name"];
            $result[$key]["subtitle"]=$value["name"];
            $result[$key]["sale_count"]=intval($value["sale_count"])+intval($value["virtual_num"]);
            $result[$key]["origin_price"]=$value["old_price"];
            $result[$key]["current_price"]=$value["price"];
            $result[$key]["distance"]=0;
            $result[$key]["mer_id"]=$value["mer_id"];
            $result[$key]["link"]=array("platform"=>"good","url"=>$value["group_id"],"id"=>$value["group_id"],"title"=>$value["s_name"]);
            //   $data[$key]["link"]=array("platform"=>"good","url"=>$value["group_id"],"id"=>$value["group_id"],"title"=>$value["s_name"]);
            if($key%2==0){
                $result[$key]["promotion"]=array("text"=>"下单立省10元","background"=>"");
            }else{
                $result[$key]["promotion"]=array("text"=>"","background"=>"");
            }



        }
        return $result;

    }
}