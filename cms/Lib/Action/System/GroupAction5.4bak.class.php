<?php
/*
 * 团购管理
 *
 */

class GroupAction extends BaseAction{
    public function index(){
		$database_group_category = D('Group_category');
		$condition_group_category['cat_fid'] = intval($_GET['cat_fid']);
		
		$count_group_category = $database_group_category->where($condition_group_category)->count();
		import('@.ORG.system_page');
		$p = new Page($count_group_category,50);
		$category_list = $database_group_category->field(true)->where($condition_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->limit($p->firstRow.','.$p->listRows)->select();
	
		$this->assign('category_list',$category_list);
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
		
		if($_GET['cat_fid']){
			$condition_now_group_category['cat_id'] = intval($_GET['cat_fid']);
			$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
			if(empty($now_category)){
				$this->error_tips('没有找到该分类信息！',3,U('Group/index'));
			}
			$this->assign('now_category',$now_category);
		}
		
		$this->display();
    }
	public function cat_add(){
		$this->assign('bg_color','#F3F3F3');
		$this->display();
	}
	public function cat_modify(){
		if(IS_POST){
			$database_group_category = D('Group_category');
			if($database_group_category->data($_POST)->add()){
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
		
		$database_group_category = D('Group_category');
		$condition_now_group_category['cat_id'] = intval($_GET['cat_id']);
		$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
		if(empty($now_category)){
			$this->frame_error_tips('没有找到该分类信息！');
		}
		$this->assign('now_category',$now_category);
		$this->display();
	}
	public function cat_amend(){
		if(IS_POST){
			//上传图片
// 			$rand_num = date('Y/m',$_SERVER['REQUEST_TIME']);
// 			$upload_dir = './upload/system/'.$rand_num.'/'; 
// 			if(!is_dir($upload_dir)){
// 				mkdir($upload_dir,0777,true);
// 			}
// 			import('ORG.Net.Upload File');
// 			$upload = new Upload File();
// 			$upload->maxSize = 10*1024*1024;
// 			$upload->allowExts = array('jpg','jpeg','png','gif');
// 			$upload->allowTypes = array('image/png','image/jpg','image/jpeg','image/gif');
// 			$upload->savePath = $upload_dir; 
// 			$upload->saveRule = 'uniqid';
// 			if($upload->upload()){
// 				$uploadList = $upload->getUpload FileInfo();
// 				$_POST['cat_pic'] = $rand_num.'/'.$uploadList[0]['savename'];
// 			}else{
// 				$this->frame_submit_tips(0,$upload->getErrorMsg());
// 			}
		

			$image = D('Image')->handle($this->system_session['id'], 'system', 0, array('size' => 10));
			if (!$image['error']) {
				$_POST = array_merge($_POST, str_replace('/upload/system/', '', $image['url']));
				$_POST ['cat_pic']=$_POST['pic'];
				//$_POST = array_merge($_POST, $image['url']);
			} else {
				//$this->frame_submit_tips(0, $image['msg']);
			}
			
			
			$database_group_category = D('Group_category');
			if($database_group_category->data($_POST)->save()){
				D('Image')->update_table_id('/upload/system/' . $_POST['cat_pic'], $_POST['cat_id'], 'group_category');
				$this->frame_submit_tips(1,'编辑成功！');
			}else{
				$this->frame_submit_tips(0,'编辑失败！请重试~');
			}
		}else{
			$this->frame_submit_tips(0,'非法提交,请重新提交~');
		}
	}
	public function cat_del(){
		if(IS_POST){
			$database_group_category = D('Group_category');
			$condition_now_group_category['cat_id'] = intval($_POST['cat_id']);
			$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
			if($database_group_category->where($condition_now_group_category)->delete()){
				if(empty($now_category['cat_fid'])){
					$condition_son_group_category['cat_fid'] = $now_category['cat_id'];
					$database_group_category->where($condition_son_group_category)->delete();
					$condition_group['cat_fid'] = $now_category['cat_id'];
				}else{
					$condition_group['cat_id'] = $now_category['cat_id'];
				}
				D('Group')->where($condition_group)->delete();
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function cat_field(){
		$database_group_category = D('Group_category');
		$condition_now_group_category['cat_id'] = intval($_GET['cat_id']);
		$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
		if(empty($now_category)){
			$this->frame_error_tips('没有找到该分类信息！');
		}
		if(!empty($now_category['cat_fid'])){
			$this->frame_error_tips('该分类不是主分类，无法使用商品字段功能！');
		}
		if(!empty($now_category['cat_field'])){
			$now_category['cat_field'] = unserialize($now_category['cat_field']);
			foreach($now_category['cat_field'] as $key=>$value){
				if($value['use_field'] == 'area'){
					$now_category['cat_field'][$key]['name'] = '区域(内置)';
					$now_category['cat_field'][$key]['url'] = 'area';
				}
				if($value['use_field'] == 'price'){
					$now_category['cat_field'][$key]['name'] = '价格(内置)';
					$now_category['cat_field'][$key]['url'] = 'area';
				}
			}
		}
		$this->assign('now_category',$now_category);
		
		$this->display();
	}
	public function cat_field_add(){
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	public function cat_field_modify(){
		if(IS_POST){
			$database_group_category = D('Group_category');
			$condition_now_group_category['cat_id'] = intval($_POST['cat_id']);
			$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
			
			if(!empty($now_category['cat_field'])){
				$cat_field = unserialize($now_category['cat_field']);
				foreach($cat_field as $key=>$value){
					if( (!empty($_POST['use_field']) && $value['use_field'] == $_POST['use_field']) || (!empty($_POST['url']) && $value['url'] == $_POST['url']) ){
						$this->error('字段已经添加，请勿重复添加！');
					}
				}
			}else{
				$cat_field = array();
			}
			if(count($cat_field) >= 5){
				$this->error('添加字段失败，最多5个自定义字段！');
			}
			if(empty($_POST['use_field'])){
				$post_data['name'] = $_POST['name'];
				$post_data['url'] = $_POST['url'];
				$post_data['value'] = explode(PHP_EOL,$_POST['value']);
				$post_data['type'] = $_POST['type'];
				
				//$post_data['sort'] = strval($_POST['sort']);
				//$post_data['status'] = strval($_POST['status']);
			}else{
				$post_data['use_field'] = $_POST['use_field'];
				
				//$post_data['sort'] = strval($_POST['sort']);
				//$post_data['status'] = strval($_POST['status']);
			}

			array_push($cat_field,$post_data);
			$data_group_category['cat_field'] = serialize($cat_field);
			$data_group_category['cat_id'] = $now_category['cat_id'];
			if($database_group_category->data($data_group_category)->save()){
				$this->success('添加字段成功！');
			}else{
				$this->error('添加失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function cue_field(){
		$database_group_category = D('Group_category');
		$condition_now_group_category['cat_id'] = intval($_GET['cat_id']);
		$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
		if(empty($now_category)){
			$this->frame_error_tips('没有找到该分类信息！');
		}
		if(!empty($now_category['cat_fid'])){
			$this->frame_error_tips('该分类不是主分类，无法使用商品字段功能！');
		}
		if(!empty($now_category['cue_field'])){
			$now_category['cue_field'] = unserialize($now_category['cue_field']);
		}
		$this->assign('now_category',$now_category);
		
		$this->display();
	}
	public function cue_field_add(){
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	public function cue_field_modify(){
		if(IS_POST){
			$database_group_category = D('Group_category');
			$condition_now_group_category['cat_id'] = intval($_POST['cat_id']);
			$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
			
			if(!empty($now_category['cue_field'])){
				$cue_field = unserialize($now_category['cue_field']);
				foreach($cue_field as $key=>$value){
					if($value['name'] == $_POST['name']){
						$this->error('该填写项已经添加，请勿重复添加！');
					}
				}
			}else{
				$cue_field = array();
			}

			$post_data['name'] = $_POST['name'];
			$post_data['type'] = $_POST['type'];
			$post_data['sort'] = strval($_POST['sort']);

			array_push($cue_field,$post_data);
			$data_group_category['cue_field'] = serialize($cue_field);
			$data_group_category['cat_id'] = $now_category['cat_id'];
			if($database_group_category->data($data_group_category)->save()){
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function cue_field_del(){
		if(IS_POST){
			$database_group_category = D('Group_category');
			$condition_now_group_category['cat_id'] = intval($_POST['cat_id']);
			$now_category = $database_group_category->field(true)->where($condition_now_group_category)->find();
			
			if(!empty($now_category['cue_field'])){
				$cue_field = unserialize($now_category['cue_field']);
				$new_cue_field = array();
				foreach($cue_field as $key=>$value){
					if($value['name'] != $_POST['name']){
						array_push($new_cue_field,$value);
					}
				}
			}else{
				$this->error('此填写项不存在！');
			}
			$data_group_category['cue_field'] = serialize($new_cue_field);
			$data_group_category['cat_id'] = $now_category['cat_id'];
			if($database_group_category->data($data_group_category)->save()){
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function store_add(){
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = intval($_GET['mer_id']);
		$merchant = $database_merchant->field(true)->where($condition_merchant)->find();
		if(empty($merchant)){
			$this->frame_error_tips('数据库中没有查询到该商户的信息！无法添加店铺。',5);
		}
		$this->assign('merchant',$merchant);
		
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	public function store_modify(){
		if(IS_POST){
			$long_lat = explode(',',$_POST['long_lat']);
			$_POST['long'] = $long_lat[0];
			$_POST['lat'] = $long_lat[1];
			$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
			$_POST['add_from'] = '1';
			$database_merchant_store = D('Merchant_store');
			if($database_merchant_store->data($_POST)->add()){
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	
	public function store_edit(){
		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['store_id'] = intval($_GET['store_id']);
		$store = $database_merchant_store->field(true)->where($condition_merchant_store)->find();
		if(empty($store)){
			$this->frame_error_tips('数据库中没有查询到该店铺的信息！',5);
		}
		$this->assign('store',$store);
		
		$this->assign('bg_color','#F3F3F3');
		
		$this->display();
	}
	
	public function store_amend(){
		if(IS_POST){
			$long_lat = explode(',',$_POST['long_lat']);
			$_POST['long'] = $long_lat[0];
			$_POST['lat'] = $long_lat[1];
			$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
			$database_merchant_store = D('Merchant_store');
			if($database_merchant_store->data($_POST)->save()){
				$this->success('修改成功！');
			}else{
				$this->error('修改失败！请检查内容是否有过修改（必须修改）后重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	public function store_del(){
		if(IS_POST){
			$database_merchant_store = D('Merchant_store');
			$condition_merchant_store['store_id'] = intval($_POST['store_id']);
			if($database_merchant_store->where($condition_merchant_store)->delete()){
				$this->success('删除成功！');
			}else{
				$this->error('删除失败！请重试~');
			}
		}else{
			$this->error('非法提交,请重新提交~');
		}
	}
	/*待商品列表*/
	public function wait_product(){
		//搜索
		$condition_where = "`gs`.`group_id`=`g`.`group_id` AND `g`.`status`='2'";
		if ($this->system_session['area_id']) {
			$condition_where .= " AND `gs`.`area_id`='{$this->system_session['area_id']}' ";
		}
		if(!empty($_GET['keyword'])){
			if($_GET['searchtype'] == 'group_id'){
				$condition_where .= " AND `g`.`group_id`=" . intval($_GET['keyword']);
			}else if($_GET['searchtype'] == 's_name'){
				$condition_where .= " AND `g`.`s_name` LIKE '%" . $_GET['keyword'] . "%'";
			}else if($_GET['searchtype'] == 'name'){
				$condition_where .= " AND `g`.`name` LIKE '%" . $_GET['keyword'] . "%'";
			}
		}
		//指定商家
		if(!empty($_GET['mer_id'])){
			$condition_where .= " AND `g`.`mer_id`=" . intval($_GET['mer_id']);
		}
		
		$condition_table  = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_store'=>'gs');
		$condition_field  = '`g`.*,`gs`.*';

		import('@.ORG.system_page');
		$count_group = D('')->table($condition_table)->where($condition_where)->count('DISTINCT `g`.`group_id`');
		$p = new Page($count_group, 20);
		$group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order('`g`.`group_id` DESC')->group('`g`.`group_id`')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('group_list', $group_list);

		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		
		$this->display();
	}
	/*商品管理*/
	public function product(){
		//搜索
		$condition_where = "`gs`.`group_id`=`g`.`group_id`";
		if(empty($_GET['mer_id'])){
			$condition_where .= " AND `g`.`status`<>'2'";
		}
		if ($this->system_session['area_id']) {
			$condition_where .= " AND `gs`.`area_id`='{$this->system_session['area_id']}' ";
		}
		if(!empty($_GET['keyword'])){
			if($_GET['searchtype'] == 'group_id'){
				$condition_where .= " AND `g`.`group_id`=" . intval($_GET['keyword']);
			}else if($_GET['searchtype'] == 's_name'){
				$condition_where .= " AND `g`.`s_name` LIKE '%" . $_GET['keyword'] . "%'";
			}else if($_GET['searchtype'] == 'name'){
				$condition_where .= " AND `g`.`name` LIKE '%" . $_GET['keyword'] . "%'";
			}
		}
		//指定商家
		if(!empty($_GET['mer_id'])){
			$condition_where .= " AND `g`.`mer_id`=" . intval($_GET['mer_id']);
		}
		
		$condition_table  = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_store'=>'gs');
		$condition_field  = '`g`.*,`gs`.*';

		import('@.ORG.system_page');
		$count_group = D('')->table($condition_table)->where($condition_where)->count('DISTINCT `g`.`group_id`');
		$p = new Page($count_group, 20);
		$group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order('`g`.`group_id` DESC')->group('`g`.`group_id`')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('group_list', $group_list);

		$pagebar = $p->show();
		$this->assign('pagebar', $pagebar);
		
		$this->display();
	}
    /*锁定商品*/
    public function lockGroup(){
        $id=$_GET['group_id'];
        $result=M("Group")->where(array("group_id"=>$id))->setField("group_lock",1);
        if($result){
            $this->success("锁定成功！");
        }else{
            $this->error("锁定失败！");
        }
    }
	/*商品编辑*/
	public function group_edit(){
		
		$this->display();
	}
	/*
     * 删除特卖商品
     * 
     */
    public function group_cancle(){
       if(IS_POST){
            $group_id = intval($_POST['group_id']);
		    if($group_id){
		    	$result=D("Group")->where(array("group_id"=>$group_id))->delete();
				$result1=D("Group_store")->where(array("group_id"=>$group_id))->delete();
                if($result){
	                $this->success('删除特卖商品成功');
	            }else{
	                $this->error('删除特卖商品失败！请重试~');
	            }
            }else{
                $this->error('缺少参数！请重试~');
            }
        }else{
            $this->error('非法提交,请重新提交~');
        }
    }
	/*订单列表*/
	public function order_list(){
		//团购信息
		$database_group = D('Group');
		$condition_group['group_id'] = $_GET['group_id'];
		$now_group = $database_group->field(true)->where($condition_group)->find();
		if(empty($now_group)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
		}
		$this->assign('now_group',$now_group);
		
		//商家信息
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = $now_group['mer_id'];
		$now_merchant = $database_merchant->field(true)->where($condition_merchant)->find();
		if(empty($now_merchant)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'所属的商家不存在！');
		}
		$this->assign('now_merchant',$now_merchant);
		
		//订单列表
		$group_id = $now_group['group_id'];
		$condition_where = "`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `o`.`group_id`='$group_id'";//AND `o`.`paid`='1' 现在查询所有订单
		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o',C('DB_PREFIX').'user'=>'u');
		
		$order_count = D('')->where($condition_where)->table($condition_table)->count();
		import('@.ORG.system_page');
		$p = new Page($order_count,30);
		
		$order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`u`.`uid`,`u`.`nickname`,`u`.`phone`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->limit($p->firstRow.','.$p->listRows)->select();
		if(empty($order_list)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
		}
		$this->assign('order_list',$order_list);
		
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
		
		$this->display();
	}
	/*操作订单*/
	public function order_edit(){
		$this->assign('bg_color','#F3F3F3');
		
		$database_group_order = D('Group_order');
        $database_group=D('group');
		$condition_group_order['order_id'] = $_GET['order_id'];
		$order = $database_group_order->field('*')->where($condition_group_order)->find();
        $condition_group['group_id']=$order['group_id'];
        $fuzeren=$database_group->field('`market_leader`,`brands_editor`')->where($condition_group)->find();
		$now_order = $database_group_order->get_order_detail_by_id_and_merId($order['mer_id'],$order['order_id'],false);
		if(empty($now_order)){
			$this->frame_error_tips('此订单不存在！');
		}

		if($now_order['store_id']){
			$now_store = D('Merchant_store')->field('`name`')->where(array('store_id'=>$now_order['store_id']))->find();
			$now_order['store_name'] = $now_store['name'];
		}
		
		   if($order['tuan_type'] == 2 && $order['paid'] == 1){
            $express_list = D('Express')->get_express_list();
            $this->assign('express_list',$express_list);
        }
		
		$this->assign('now_order',$now_order);
        $this->assign('fuzeren',$fuzeren);
		$this->display();
	}
	/*评论列表*/
	public function reply_list(){
		//团购信息
		$database_group = D('Group');
		$condition_group['group_id'] = $_GET['group_id'];
		$now_group = $database_group->field(true)->where($condition_group)->find();
		if(empty($now_group)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
		}
		$this->assign('now_group',$now_group);
		
		//商家信息
		$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = $now_group['mer_id'];
		$now_merchant = $database_merchant->field(true)->where($condition_merchant)->find();
		if(empty($now_merchant)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'所属的商家不存在！');
		}
		$this->assign('now_merchant',$now_merchant);
		
		//评论列表
		$group_id = $now_group['group_id'];
		$table = array(C('DB_PREFIX').'reply'=>'r',C('DB_PREFIX').'group_order'=>'o');
		$condition = "`r`.`order_type`='0' AND `r`.`order_id`=`o`.`order_id` AND `o`.`group_id`='$group_id'";
	
		$reply_count = D('')->table($table)->where($condition)->count();
		import('@.ORG.system_page');
		$p = new Page($reply_count,20);
		
		$reply_list = D('')->table($table)->where($condition)->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('reply_list',$reply_list);
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
	
		$this->display();
	}
	public function reply_detail(){
		$this->assign('bg_color','#F3F3F3');
		
		$pigcms_id = $_GET['id'];
		$table = array(C('DB_PREFIX').'reply'=>'r',C('DB_PREFIX').'group_order'=>'o');
		$condition = "`r`.`order_type`='0' AND `r`.`order_id`=`o`.`order_id` AND `r`.`pigcms_id`='$pigcms_id'";
		$reply_detail = D('')->table($table)->where($condition)->find();
		
		if(empty($reply_detail)){
			$this->frame_error_tips('该评论不存在！');
		}
		$this->assign('reply_detail',$reply_detail);
		
		if($reply_detail['pic']){
			$reply_image_class = new reply_image();
			$image_list = $reply_image_class->get_image_by_id($reply_detail['order_id'],0);
			$this->assign('image_list',$image_list);
		}
		
		$this->display();
	}
	public function reply_del(){
		$database_reply = D('Reply');
		$condition_reply['pigcms_id'] = $_POST['id'];
		$now_reply = $database_reply->field(true)->where($condition_reply)->find();
		if(empty($now_reply)){
			$this->frame_error_tips('该评论不存在！');
		}
		if($database_reply->where($condition_reply)->delete()){
			if($now_reply['pic']){
				$reply_image_class = new reply_image();
				$reply_image_class->del_image_by_id($now_reply['order_id'],0);
			}
			//减少团购一个评论数
			$database_group = D('Group');
			$condition_group['group_id'] = $now_reply['parent_id'];
			$database_group->where($condition_group)->setDec('reply_count');
			
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}
	}
	
	public function order()
	{

		if($_GET['searchtype']=="groupbuy"){

			$condition_where = "`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `m`.`mer_id`=`o`.`mer_id` AND `o`.`sun_id` is not null AND `o`.`sun_id`=`gb`.`sun_id`";

                $condition_where .= "  AND `o`.`paid`=1 AND `gb`.`status`=1";


			if(!empty($_GET['keyword'])){
			if ($_GET['searchtype'] == 'order_id') {
				$condition_where .= " AND `o`.`order_id`=" . intval($_GET['keyword']);
			} elseif ($_GET['searchtype'] == 'name') {
				$condition_where .= " AND `u`.`nickname`='" . htmlspecialchars($_GET['keyword']) . "'";
			} elseif ($_GET['searchtype'] == 'phone') {
				$condition_where .= " AND `u`.`phone`='" . htmlspecialchars($_GET['keyword']) . "'";
			} elseif ($_GET['searchtype'] == 's_name') {
				$condition_where .= " AND `g`.`s_name`='" . htmlspecialchars($_GET['keyword']) . "'";
			}
			//增加未发货订单筛选
			}
			$condition_table = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_order'=>'o', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_buy'=>'gb');
			//$condition_table = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_order'=>'o', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_buy'=>'gb');
		
			$order_count = D('')->where($condition_where)->table($condition_table)->count();
			import('@.ORG.system_page');
			$p = new Page($order_count,30);
		
			$order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`g`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`g`.`group_id`,gb.status as gbstatus')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->limit($p->firstRow.','.$p->listRows)->select();
			if(empty($order_list)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
			}

			foreach($order_list as $k=>$val){
			if(!empty($val['sun_id'])){
				$groupbuy=M("GroupBuy")->field("u.nickname,u.uid")->alias('gb')->join("LEFT JOIN ".C('DB_PREFIX')."user u ON gb.user_id=u.uid")->where("gb.sun_id='".$val['sun_id']."'")->find();
				if(!empty($groupbuy)){
					$order_list[$k]['pinnickname']=$groupbuy['nickname'];
				}
			}
			}
			//print_r($order_list);die;
			$this->assign('order_list',$order_list);
		
			$pagebar = $p->show();
			$this->assign('pagebar',$pagebar);
			$this->display();die;
		}
		elseif ($_GET['searchtype']=="groupbuyunsend"){

            $condition_where = "`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `m`.`mer_id`=`o`.`mer_id` AND `o`.`sun_id` is not null AND `o`.`sun_id`=`gb`.`sun_id` AND `g`.`is_lottery_group_buy` <> '1'";
            $condition_where.="AND `o`.`paid`=1 AND `o`.`status`=0 AND `gb`.`status`=1";



            if(!empty($_GET['keyword'])){
                if ($_GET['searchtype'] == 'order_id') {
                    $condition_where .= " AND `o`.`order_id`=" . intval($_GET['keyword']);
                } elseif ($_GET['searchtype'] == 'name') {
                    $condition_where .= " AND `u`.`nickname`='" . htmlspecialchars($_GET['keyword']) . "'";
                } elseif ($_GET['searchtype'] == 'phone') {
                    $condition_where .= " AND `u`.`phone`='" . htmlspecialchars($_GET['keyword']) . "'";
                } elseif ($_GET['searchtype'] == 's_name') {
                    $condition_where .= " AND `g`.`s_name`='" . htmlspecialchars($_GET['keyword']) . "'";
                }
                //增加未发货订单筛选
            }
            $condition_table = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_order'=>'o', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_buy'=>'gb');
            //$condition_table = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_order'=>'o', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_buy'=>'gb');

            $order_count = D('')->where($condition_where)->table($condition_table)->count();
            import('@.ORG.system_page');
            $p = new Page($order_count,30);

            $order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`g`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`g`.`group_id`,gb.status as gbstatus')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->limit($p->firstRow.','.$p->listRows)->select();
            if(empty($order_list)){
                $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
            }

            foreach($order_list as $k=>$val){
                if(!empty($val['sun_id'])){
                    $groupbuy=M("GroupBuy")->field("u.nickname,u.uid")->alias('gb')->join("LEFT JOIN ".C('DB_PREFIX')."user u ON gb.user_id=u.uid")->where("gb.sun_id='".$val['sun_id']."'")->find();
                    if(!empty($groupbuy)){
                        $order_list[$k]['pinnickname']=$groupbuy['nickname'];
                    }
                }
            }
            //print_r($order_list);die;
            $this->assign('order_list',$order_list);

            $pagebar = $p->show();
            $this->assign('pagebar',$pagebar);
            $this->display();die;

        }


		$condition_where = "`o`.`uid`=`u`.`uid` AND `o`.`group_id`=`g`.`group_id` AND `m`.`mer_id`=`o`.`mer_id` AND `o`.`sun_id` is null";
		
		if(!empty($_GET['keyword'])){
			if ($_GET['searchtype'] == 'order_id') {
				$condition_where .= " AND `o`.`order_id`=" . intval($_GET['keyword']);
			} elseif ($_GET['searchtype'] == 'name') {
				$condition_where .= " AND `u`.`nickname` like'" . htmlspecialchars('%'.$_GET['keyword'].'%') . "'";
			} elseif ($_GET['searchtype'] == 'phone') {
				$condition_where .= " AND `u`.`phone`='" . htmlspecialchars($_GET['keyword']) . "'";
			} elseif ($_GET['searchtype'] == 's_name') {
				$condition_where .= " AND `g`.`s_name` like'" . htmlspecialchars('%'.$_GET['keyword'].'%') . "'";
			}
			//增加未发货订单筛选
		}elseif($_GET['searchtype']=="unsend"){
			$condition_where .= " AND `o`.`status`=0 AND `o`.`paid`=1 AND `o`.`sun_id` is null";
		}
		$condition_table = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_order'=>'o', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m');
			//$condition_table = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_order'=>'o', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_buy'=>'gb');
		
		$order_count = D('')->where($condition_where)->table($condition_table)->count();
		import('@.ORG.system_page');
		$p = new Page($order_count,30);
		
		$order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`g`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`g`.`group_id`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->limit($p->firstRow.','.$p->listRows)->select();
		if(empty($order_list)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
		}
		// foreach($order_list as $k=>$val){
		// 	if(!empty($val['sun_id'])){
		// 		$groupbuy=M("GroupBuy")->field("u.nickname,u.uid")->alias('gb')->join("LEFT JOIN ".C('DB_PREFIX')."user u ON gb.user_id=u.uid")->where("gb.sun_id='".$val['sun_id']."'")->find();
		// 		if(!empty($groupbuy)){
		// 			$order_list[$k]['pinnickname']=$groupbuy['nickname'];
		// 		}
		// 	}
		// }
		$this->assign('order_list',$order_list);
		
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
		
		$this->display();
	}

    //取消订单接口
    public function order_cancle(){
       if(IS_POST){
            $group_order = D('Group_order');
            $order_id = intval($_POST['order_id']);
            $result=$group_order->where("order_id=".$order_id)->setField("status",3);
            if($result){
                $this->success('取消订单成功');
            }else{
                $this->error('取消失败失败！请重试~');
            }
        }else{
            $this->error('非法提交,请重新提交~');
        }
    }
	    public function group_express(){
        $this->check_group($_GET['store_id']);
        $now_order = D('Group_order')->get_order_detail_by_id_and_merId($_GET['mer_id'],$_GET['order_id'],false);
        if(empty($now_order)){
            $this->error('此订单不存在！');
        }
        if(empty($now_order['paid'])){
            $this->error('此订单尚未支付！');
        }

        $condition_group_order['order_id'] = $now_order['order_id'];
        $data_group_order['express_type'] = $_POST['express_type'];
        $data_group_order['express_id'] = $_POST['express_id'];
    //    $data_group_order['last_staff'] = $this->staff_session['name'];
        if($now_order['paid'] == 1 && $now_order['status'] == 0){
            if (empty($now_order['third_id']) && $now_order['pay_type'] == 'offline') {
                $data_group_order['third_id'] = $now_order['order_id'];
            }
            $data_group_order['status'] = 1;
            $data_group_order['use_time'] = $_SERVER['REQUEST_TIME'];
            $data_group_order['store_id'] =$_GET['store_id'];
        }

        if(D('Group_order')->where($condition_group_order)->data($data_group_order)->save()){

            //加入快递信息
            $now_order['express_type']=$data_group_order['express_type'];
            $now_order['express_id']=$data_group_order['express_id'];
            $this->group_notice($now_order);

            $this->success('修改成功！');
        }else{
            $this->error('修改失败！请重试。');
        }
    }


    private function group_notice($order)
    {
        //积分
        D('User')->add_score($order['uid'],floor($order['total_money']*C('config.user_score_get')),'购买 '.$order['order_name'].' 消费'.floatval($order['total_money']).'元 获得积分');
        D('Userinfo')->add_score($order['uid'], $order['mer_id'], $order['total_money'], '购买 '.$order['order_name'].' 消费'.floatval($order['total_money']).'元 获得积分');

        //短信
        $sms_data = array('mer_id' => $order['mer_id'], 'store_id' => $order['store_id'], 'type' => 'group');
        if ($this->config['sms_finish_order'] == 1 || $this->config['sms_finish_order'] == 3) {
            $sms_data['uid'] = $order['uid'];
            $sms_data['mobile'] = $order['phone'];
            $sms_data['sendto'] = 'user';


            //区分如果没有快递则直接发送消费
            if(!empty($order['express_type'])){
                //发送订单信息
                $order_name=$order['order_name'];
                if(strripos($order_name,"*")){
                    $send_name=substr($order_name,0,strripos($order_name,"*"))."共".substr($order_name,(strripos($order_name,"*")+1))."份";
                }else{
                    $send_name=$order_name;
                }
                //查询对应的快递信息
                $express=D("Express")->where("id=".$order['express_type'])->find();
                $user=D('user')->where(array("uid"=>$order['uid']))->find();
                if(!empty($user["openid"])){
                    $href = C('config.site_url').'/wap.php';
                    $model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));

                    $model->sendTempMsg('OPENTM201541214', array('href' => $href, 'wecha_id' => $user['openid'], 'first' => '订单发货提醒', 'keyword1' => $order['order_id'], 'keyword2' => $express['name'], 'keyword3' =>  $order['express_id'], 'remark' => '发货成功！'));
                }

                $sms_data['content'] = '您购买 '.$send_name.'的订单(订单号：' . $order['order_id'] . ')已经发货，物流信息：'.$express['name'].$order['express_id'].',亲有任何问题可随时咨询小农丁客服：400-665-7170';
            }else{
                $sms_data['content'] = '您在 ' . $this->store['name'] . '店中下的订单(订单号：' . $order['order_id'] . '),已经完成了消费，亲有任何问题可随时咨询小农丁客服：400-665-7170';
            }
            Sms::sendSms($sms_data);
        }
        if ($this->config['sms_finish_order'] == 2 || $this->config['sms_finish_order'] == 3) {
            $sms_data['uid'] = 0;
            $sms_data['mobile'] = $order['phone'];
            $sms_data['sendto'] = 'merchant';
            $sms_data['content'] = '顾客购买的' . $order['order_name'] . '的订单(订单号：' . $order['order_id'] . '),已经发货！';
            Sms::sendSms($sms_data);
        }

        //打印
        $msg = ArrayToStr::array_to_str($order['order_id'], 'group_order');
        $op = new orderPrint($this->config['print_server_key'], $this->config['print_server_topdomain']);
        $op->printit($order['mer_id'], $order['store_id'], $msg, 1);
    }


    protected function check_group($store_id){
        $database_merchant_store = D('Merchant_store');
        $condition_merchant_store['store_id'] = $store_id;
        $store = $database_merchant_store->field(true)->where($condition_merchant_store)->find();
        if(empty($store)){
            $this->error('店铺不存在！');
        }
        if(empty($store['have_group'])){
            $this->error('该产品店铺没有开通'.$this->config['group_alias_name'].'功能！');
        }
    }
	
	    public function  pin_order(){
         $condition_table = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_order'=>'o', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_buy'=>'gb');
            $condition_where="`o`.`is_lottery_group` ='0' AND `o`.`uid`=`u`.`uid` AND `o`.`mer_id`=`m`.`mer_id` AND `o`.`group_id`=`g`.`group_id` AND `o`.`sun_id`=`gb`.`sun_id` AND `o`.`paid`='1' AND `gb`.`status`='1' ";
        if(empty($_GET['keyword'])){

            $order_count = D('')->where($condition_where)->table($condition_table)->count();
            import('@.ORG.system_page');
            $p = new Page($order_count,30);

            $order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`g`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`g`.`group_id`,gb.status as gbstatus ,`g`.`remarks`')->group('`o`.`order_id`,`o`.`sun_id`')->where($condition_where)->table($condition_table)->order('`o`.`status` ASC,`o`.`sun_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
            if(empty($order_list)){
                $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
            }

            foreach($order_list as $k=>$val){
                if(!empty($val['sun_id'])){
                    $groupbuy=M("GroupBuy")->field("u.nickname,u.uid")->alias('gb')->join("LEFT JOIN ".C('DB_PREFIX')."user u ON gb.user_id=u.uid")->where("gb.sun_id='".$val['sun_id']."'")->find();
                    if(!empty($groupbuy)){
                        $order_list[$k]['pinnickname']=$groupbuy['nickname'];
                    }
                }
            }
            //print_r($order_list);die;
            $this->assign('order_list',$order_list);

            $pagebar = $p->show();
            $this->assign('pagebar',$pagebar);
            $this->display();die;
        }else{
            if ($_GET['searchtype'] == 'order_id') {
                $condition_where .= " AND `o`.`order_id`=" . intval($_GET['keyword']);
            } elseif ($_GET['searchtype'] == 'name') {
                $condition_where .= " AND `u`.`nickname`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'phone') {
                $condition_where .= " AND `u`.`phone`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 's_name') {
                $condition_where .= " AND `g`.`s_name`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'group_id') {
                $condition_where .= " AND `o`.`group_id`='" . htmlspecialchars($_GET['keyword']) . "'";
            }

            $order_count = D('')->where($condition_where)->table($condition_table)->count();
            import('@.ORG.system_page');
            $p = new Page($order_count,30);

            $order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`g`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`g`.`group_id`,gb.status as gbstatus ,`g`.`remarks`')->group('`o`.`order_id`,`o`.`sun_id`')->where($condition_where)->table($condition_table)->order('`o`.`status` ASC,`o`.`sun_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
            if(empty($order_list)){
                $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
            }

            foreach($order_list as $k=>$val){
                if(!empty($val['sun_id'])){
                    $groupbuy=M("GroupBuy")->field("u.nickname,u.uid")->alias('gb')->join("LEFT JOIN ".C('DB_PREFIX')."user u ON gb.user_id=u.uid")->where("gb.sun_id='".$val['sun_id']."'")->find();
                    if(!empty($groupbuy)){
                        $order_list[$k]['pinnickname']=$groupbuy['nickname'];
                    }
                }
            }
            //print_r($order_list);die;
            $this->assign('order_list',$order_list);

            $pagebar = $p->show();
            $this->assign('pagebar',$pagebar);
            $this->display();die;

        }
        $this->display();
    }
	
	  public function  lottery_pin_order(){

        
        $condition_table = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_order'=>'o', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_buy'=>'gb');
          $condition_where="`o`.`is_lottery_order`='1' AND `o`.`uid`=`u`.`uid` AND `o`.`mer_id`=`m`.`mer_id` AND `o`.`group_id`=`g`.`group_id` AND `o`.`sun_id`=`gb`.`sun_id`";

          if(empty($_GET['keyword'])){
            $order_count = D('')->where($condition_where)->table($condition_table)->count();
            import('@.ORG.system_page');
            $p = new Page($order_count,30);

            $order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`g`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`g`.`group_id`,gb.status as gbstatus ,`g`.`remarks`')->where($condition_where)->table($condition_table)->order('`o`.`status` ASC,`o`.`order_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
            if(empty($order_list)){
                $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
            }

            foreach($order_list as $k=>$val){
                if(!empty($val['sun_id'])){
                    $groupbuy=M("GroupBuy")->field("u.nickname,u.uid")->alias('gb')->join("LEFT JOIN ".C('DB_PREFIX')."user u ON gb.user_id=u.uid")->where("gb.sun_id='".$val['sun_id']."'")->find();
                    if(!empty($groupbuy)){
                        $order_list[$k]['pinnickname']=$groupbuy['nickname'];
                    }
                }
            }
            //print_r($order_list);die;
            $this->assign('order_list',$order_list);

            $pagebar = $p->show();
            $this->assign('pagebar',$pagebar);
            $this->display();die;
        }else{
            if ($_GET['searchtype'] == 'order_id') {
                $condition_where .= " AND `o`.`order_id`=" . intval($_GET['keyword']);
            } elseif ($_GET['searchtype'] == 'name') {
                $condition_where .= " AND `u`.`nickname`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'phone') {
                $condition_where .= " AND `u`.`phone`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 's_name') {
                $condition_where .= " AND `g`.`s_name`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'group_id') {
                $condition_where .= " AND `o`.`group_id`='" . htmlspecialchars($_GET['keyword']) . "'";
            }

              $order_count = D('')->where($condition_where)->table($condition_table)->count();
              import('@.ORG.system_page');
              $p = new Page($order_count,30);

              $order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`g`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`g`.`group_id`,gb.status as gbstatus ,`g`.`remarks`')->where($condition_where)->table($condition_table)->order('`o`.`status` ASC,`o`.`order_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
              if(empty($order_list)){
                  $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
              }

              foreach($order_list as $k=>$val){
                  if(!empty($val['sun_id'])){
                      $groupbuy=M("GroupBuy")->field("u.nickname,u.uid")->alias('gb')->join("LEFT JOIN ".C('DB_PREFIX')."user u ON gb.user_id=u.uid")->where("gb.sun_id='".$val['sun_id']."'")->find();
                      if(!empty($groupbuy)){
                          $order_list[$k]['pinnickname']=$groupbuy['nickname'];
                      }
                  }
              }
              //print_r($order_list);die;
              $this->assign('order_list',$order_list);

              $pagebar = $p->show();
              $this->assign('pagebar',$pagebar);
              $this->display();die;
        }

        $this->display();
    }
	
	
	   public function  temai_order_new (){

        $condition_table = array(C('DB_PREFIX').'group'=>'g', C('DB_PREFIX').'group_order'=>'o', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m');
           $condition_where="`o`.`uid`=`u`.`uid` AND `o`.`mer_id`=`m`.`mer_id` AND `o`.`group_id`=`g`.`group_id` AND `g`.`is_group_buy` <> '1' AND `o`.`paid`='1'";

           if(empty($_GET['keyword'])){
            $order_count = D('')->where($condition_where)->table($condition_table)->count();
            import('@.ORG.system_page');
            $p = new Page($order_count,30);

            $order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`g`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`g`.`group_id`,`g`.`remarks`')->where($condition_where)->table($condition_table)->order('`o`.`status` ASC,`o`.`order_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
            if(empty($order_list)){
                $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
            }

            foreach($order_list as $k=>$val){
                if(!empty($val['sun_id'])){
                    $groupbuy=M("GroupBuy")->field("u.nickname,u.uid")->alias('gb')->join("LEFT JOIN ".C('DB_PREFIX')."user u ON gb.user_id=u.uid")->where("gb.sun_id='".$val['sun_id']."'")->find();
                    if(!empty($groupbuy)){
                        $order_list[$k]['pinnickname']=$groupbuy['nickname'];
                    }
                }
            }
            //print_r($order_list);die;
            $this->assign('order_list',$order_list);

            $pagebar = $p->show();
            $this->assign('pagebar',$pagebar);
            $this->display();die;
        }else{
               if ($_GET['searchtype'] == 'order_id') {
                   $condition_where .= " AND `o`.`order_id`=" . intval($_GET['keyword']);
               } elseif ($_GET['searchtype'] == 'name') {
                   $condition_where .= " AND `u`.`nickname`='" . htmlspecialchars($_GET['keyword']) . "'";
               } elseif ($_GET['searchtype'] == 'phone') {
                   $condition_where .= " AND `u`.`phone`='" . htmlspecialchars($_GET['keyword']) . "'";
               } elseif ($_GET['searchtype'] == 's_name') {
                   $condition_where .= " AND `g`.`s_name`='" . htmlspecialchars($_GET['keyword']) . "'";
               } elseif ($_GET['searchtype'] == 'group_id') {
                $condition_where .= " AND `o`.`group_id`='" . htmlspecialchars($_GET['keyword']) . "'";
            }

               $order_count = D('')->where($condition_where)->table($condition_table)->count();
               import('@.ORG.system_page');
               $p = new Page($order_count,30);

               $order_list = D('')->field('`o`.`phone` AS `group_phone`,`o`.*,`g`.`s_name`,`g`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`g`.`group_id`')->where($condition_where)->table($condition_table)->order('`o`.`status` ASC,`o`.`order_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
               if(empty($order_list)){
                   $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
               }

               foreach($order_list as $k=>$val){
                   if(!empty($val['sun_id'])){
                       $groupbuy=M("GroupBuy")->field("u.nickname,u.uid")->alias('gb')->join("LEFT JOIN ".C('DB_PREFIX')."user u ON gb.user_id=u.uid")->where("gb.sun_id='".$val['sun_id']."'")->find();
                       if(!empty($groupbuy)){
                           $order_list[$k]['pinnickname']=$groupbuy['nickname'];
                       }
                   }
               }
               //print_r($order_list);die;
               $this->assign('order_list',$order_list);

               $pagebar = $p->show();
               $this->assign('pagebar',$pagebar);
               $this->display();die;
           }

        $this->display();


    }
	
}