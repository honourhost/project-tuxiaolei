<?php
/*
 * 系统配置
 *
 * @  Writers    Jaty
 * @  BuildTime  2014/11/05 15:28
 * 
 */

class ConfigAction extends BaseAction{

	//将所有的get获取store_id的方法改为构造方法初始化的本类私有变量$store_id获取
	private function getStoreId()
	{
		if(empty($this->store_id)){
			$mer_id=$this->merchant_session['mer_id'];
			$condition_where=array(
				"mer_id"=>$mer_id,
				"ismain"=>1,
				"status"=>1
			);
			$store=D("Merchant_store")->where($condition_where)->find();
			if(empty($store)){
				//只有不为store_add的方法才能跳转
				redirect(U("Config/store_add"));die;
			}else{
				return $store['store_id'];
			}
		}
	}

	/* 商家设置 */
    public function merchant(){
		$database_merchant = D('Merchant');
		if(IS_POST){
			$data_merchant['phone'] = $_POST['phone'];
			if(empty($data_merchant['phone'])){
				$this->error('请输入联系人电话');
			}
			
			$data_merchant['email'] = $_POST['email'];
			//修改之前先查看是否本身不存在那四个字段的值，则必须都判断是否为空
			$oldmerchant=$database_merchant->where("mer_id=".$this->merchant_session['mer_id'])->find();
			if(empty($oldmerchant['person_name'])||empty($oldmerchant['person_info'])||empty($oldmerchant['merchant_theme_image'])||empty($oldmerchant['person_image'])||empty($oldmerchant['merchant_phone'])){
					//如果某个值为空，则必须判断所有传值是否为空
					if(empty($_POST['person_name'])){
						$this->error("农场主名字不能为空！");
					}
					if(empty($_POST['person_info'])){
						$this->error("农场主简介不能为空！");
					}
					if(empty($_POST['merchant_phone'])){
						$this->error("农场主电话不能为空！");
					}
					if($_FILES['image']['error'] == 4){
						$this->error("农场主头像不能为空！");
					}
					if($_FILES['merchant_theme_image']['error'] == 4){
						$this->error("农场主题图不能为空！");
					}
			}
			if(!empty($_POST['new_pass'])){
				$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
				$now_merchant = $database_merchant->field('`pwd`')->where($condition_merchant)->find();
				if(md5($_POST['old_pass']) != $now_merchant['pwd']){
					$this->error('原密码输入错误');
				}else if(strlen($_POST['new_pass']) < 6){
					$this->error('新密码最少6个字符');
				}else if($_POST['new_pass'] != $_POST['re_pass']){
					$this->error('两次新密码输入不一致，请重新输入');
				}else{
					$data_merchant['pwd'] = md5($_POST['new_pass']);
				}
			}
			
			if(empty($_POST['pic'])){
				$this->error('请至少上传一张图片');
			}
			//新增头像和主题图上传存储
			if(!empty($_FILES)){
			if($_FILES['image']['error'] != 4||$_FILES['merchant_theme_image']['error']!=4){
				$param = array('size' => $this->config['meal_pic_size']);
				$param['thumb'] = true;
				$param['imageClassPath'] = 'ORG.Util.Image';
				$param['thumbPrefix'] = 'm_,s_';
				$param['thumbMaxWidth']  = $this->config['meal_pic_width'];
				$param['thumbMaxHeight'] = $this->config['meal_pic_height'];
				$param['thumbRemoveOrigin'] = false;
				$image = D('Image')->handle($this->merchant_session['mer_id'], 'merchant', 1, $param);
				if ($image['error']) {
					$this->error('图片上传过程出错');
				} else {
					$_POST = array_merge($_POST, $image['title']);
					if($_FILES['image']['error'] != 4){
						$data_merchant['person_image']=$_POST['image'];
					}
					if($_FILES['merchant_theme_image']['error']!=4){
						$data_merchant['merchant_theme_image']=$_POST['merchant_theme_image'];
					}
				}
			}else{
				unset($_POST['image']);
				unset($_POST['merchant_theme_image']);
			}
			}
			$data_merchant['merchant_phone']=$_POST['merchant_phone'];
			$data_merchant['person_info']=$_POST['person_info'];
			$data_merchant['person_name']=$_POST['person_name'];
			$data_merchant['pic_info'] = implode(';',$_POST['pic']);
			$data_merchant['merchant_cat_fid']=$_POST['merchant_cat_fid'];
			$data_merchant['merchant_cat_id']=$_POST['merchant_cat_id'];
			$data_merchant['txt_info'] = $_POST['txt_info'];
			if(empty($data_merchant['txt_info'])){
				$this->error('请输入商家描述信息');
			}
			$data_merchant['adverimg']=isset($_POST['adverimg']) ? trim($_POST['adverimg']) : '';
			$data_merchant['mer_id'] = $this->merchant_session['mer_id'];

			if($database_merchant->data($data_merchant)->save()){
				// $meal_image_class = new meal_image();
				// $t_image = $meal_image_class->get_image_by_path($_POST['image'], '', -1);
				// D('Image')->update_table_id($t_image['image'], $_POST['mer_id'], 'merchant');
				// //删除原有图片
				// if(!empty($_POST['image']) && !empty($data_merchant['image'])){
				// 	//$meal_image_class = new meal_image();
				// 	$meal_image_class->del_image_by_path($data_merchant['image']);
				// }
				// //删除第二张
				// $t2_image = $meal_image_class->get_image_by_path($_POST['merchant_theme_image'], '', -1);
				// D('Image')->update_table_id($t2_image['image'], $_POST['mer_id'], 'merchant');
				// //删除原有图片
				// if(!empty($_POST['merchant_theme_image']) && !empty($data_merchant['merchant_theme_image'])){
				// 	//$meal_image_class = new meal_image();
				// 	$meal_image_class->del_image_by_path($data_merchant['merchant_theme_image']);
				// }
				/*
				$meal_image_class = new meal_image();
				$now_meal['see_image'] = $meal_image_class->get_image_by_path($_POST['image'],$this->config['site_url'],'s');*/
				$this->success('保存成功！',U("Config/merchant"));
				die;
			}else{
				$this->error('保存失败！请检查是否有修改过内容后重试');
			}
		}else{
			$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
			$now_merchant = $database_merchant->field(true,'pwd')->where($condition_merchant)->find();
			if(!empty($now_merchant['pic_info'])){
				$merchant_image_class = new merchant_image();
				$now_merchant['adverimgurl']=!empty($now_merchant['adverimg']) ? $merchant_image_class->get_image_by_path($now_merchant['adverimg']) :'';
				$tmp_pic_arr = explode(';',$now_merchant['pic_info']);
				foreach($tmp_pic_arr as $key=>$value){
					$now_merchant['pic'][$key]['title'] = $value;
					$now_merchant['pic'][$key]['url'] = $merchant_image_class->get_image_by_path($value);
				}
			}
			//头像显示
			$merchant_image_class = new merchant_image();
			$now_merchant['person_image'] = $merchant_image_class->get_image_by_path($now_merchant['person_image'],$this->config['site_url'],'s');

			$now_merchant['merchant_theme_image'] = $merchant_image_class->get_image_by_path($now_merchant['merchant_theme_image'],$this->config['site_url'],'s');

			$merchant_group_list = D('Group')->get_grouplist_by_MerchantId($now_merchant['mer_id']);

			$this->assign('now_merchant',$now_merchant);

			//分类开始
			$database_group_category = D('Group_category');
			$condition_f_group_category['cat_fid'] = 0;
			$condition_f_group_category['cat_status'] = 1;
			$f_category_list = $database_group_category->field('`cat_id`,`cat_name`,`cat_field`,`cue_field`')->where($condition_f_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
			$this->assign('f_category_list', $f_category_list);
			if (empty($f_category_list)) {
				$this->error('管理员没有添加' . $this->config['group_alias_name'] . '分类！');
			}
			$condition_s_group_category['cat_fid'] = $now_merchant['merchant_cat_fid'];
			$condition_s_group_category['cat_status'] = 1;
			$s_category_list = $database_group_category->field('`cat_id`,`cat_name`')->where($condition_s_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
			$this->assign('s_category_list', $s_category_list);
//			if (empty($s_category_list)) {
//				$this->error($f_category_list[0]['cat_name'] . ' 分类下没有添加子分类！');
//			}
			//分类结束
			$this->assign('merchant_group_list',$merchant_group_list);
		}
		$this->display();
    }

    //新的保存农场信息的方法、
    private function saveMerchant(){
    	$database_merchant = D('Merchant');
		if(IS_POST){
			$data_merchant['phone'] = $_POST['phone'];
			if(empty($data_merchant['phone'])){
				$this->error('请输入联系人电话');
			}
			$data_merchant['email'] = $_POST['email'];
			//修改之前先查看是否本身不存在那四个字段的值，则必须都判断是否为空
			$oldmerchant=$database_merchant->where("mer_id=".$this->merchant_session['mer_id'])->find();
			//修改密码
			if(!empty($_POST['new_pass'])){
				$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
				$now_merchant = $database_merchant->field('`pwd`')->where($condition_merchant)->find();
				if(md5($_POST['old_pass']) != $now_merchant['pwd']){
					$this->error('原密码输入错误');
				}else if(strlen($_POST['new_pass']) < 6){
					$this->error('新密码最少6个字符');
				}else if($_POST['new_pass'] != $_POST['re_pass']){
					$this->error('两次新密码输入不一致，请重新输入');
				}else{
					$data_merchant['pwd'] = md5($_POST['new_pass']);
				}
			}

			//新增头像和主题图上传存储
			if(!empty($_FILES)){
			if($_FILES['image']['error'] != 4||$_FILES['merchant_theme_image']['error']!=4){
				$param = array('size' => $this->config['meal_pic_size']);
				$param['thumb'] = true;
				$param['imageClassPath'] = 'ORG.Util.Image';
				$param['thumbPrefix'] = 'm_,s_';
				$param['thumbMaxWidth']  = $this->config['meal_pic_width'];
				$param['thumbMaxHeight'] = $this->config['meal_pic_height'];
				$param['thumbRemoveOrigin'] = false;
				$image = D('Image')->handle($this->merchant_session['mer_id'], 'merchant', 1, $param);
				if ($image['error']) {
					$this->error('图片上传过程出错');
				} else {
					$_POST = array_merge($_POST, $image['title']);
					if($_FILES['image']['error'] != 4){
						$data_merchant['person_image']=$_POST['image'];
					}
					if($_FILES['merchant_theme_image']['error']!=4){
						$data_merchant['merchant_theme_image']=$_POST['merchant_theme_image'];
					}
				}
			}else{
				unset($_POST['image']);
				unset($_POST['merchant_theme_image']);
			}
			}
			//$data_merchant['merchant_phone']=$_POST['merchant_phone'];
			if(!empty($_POST['person_info'])){
				$data_merchant['person_info']=$_POST['person_info'];
			}
			if(!empty($_POST['person_name'])){
				$data_merchant['person_name']=$_POST['person_name'];
			}
			if(!empty($_POST['merchant_cat_fid'])){
				$data_merchant['merchant_cat_fid']=$_POST['merchant_cat_fid'];
			}
			$data_merchant['txt_info'] = $_POST['txt_info'];
			if(!empty($_POST['txt_info'])){
				$data_merchant['txt_info']=$_POST['txt_info'];
			}
			// if(empty($data_merchant['txt_info'])){
			// 	$this->error('请输入商家描述信息');
			// }
			$data_merchant['adverimg']=isset($_POST['adverimg']) ? trim($_POST['adverimg']) : '';
			$data_merchant['mer_id'] = $this->merchant_session['mer_id'];

			$result=$database_merchant->data($data_merchant)->save();
			//不必检测是否保存成功
			// if(!$result){
			// 	$this->error('保存失败！请检查是否有修改过内容后重试');
			// }
		}
    } 
    
    public function merchant_promote()
    {
    	$database_merchant = D('Merchant');
		$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
		$now_merchant = $database_merchant->field(true,'pwd')->where($condition_merchant)->find();

		if(!empty($now_merchant['pic_info'])){
			$merchant_image_class = new merchant_image();
			$tmp_pic_arr = explode(';',$now_merchant['pic_info']);
			foreach($tmp_pic_arr as $key=>$value){
				$now_merchant['pic'][$key]['title'] = $value;
				$now_merchant['pic'][$key]['url'] = $merchant_image_class->get_image_by_path($value);
			}
		}
		$this->assign('now_merchant',$now_merchant);
		
		$merchant_group_list = D('Group')->get_grouplist_by_MerchantId($now_merchant['mer_id']);

		$this->assign('merchant_group_list',$merchant_group_list);
		
		
		$hits = D('Group')->get_hits_log($now_merchant['mer_id']);
		$this->assign('hits', $hits['group_list']);
		
		$this->assign('pagebar', $hits['pagebar']);
		
    	$this->display();
    }
	public function merchant_indexsort(){
		if(IS_POST){
			$database_merchant = D('Merchant');
			//转存首页储存值
			$group_indexsort = intval($_POST['group_indexsort']);
			if($group_indexsort){
				$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
				$now_merchant = $database_merchant->field('`storage_indexsort`')->where($condition_merchant)->find();
				if($now_merchant['storage_indexsort']){
					$condition_group['group_id'] = $group_indexsort;
					if(D('Group')->where($condition_group)->setInc('index_sort',$now_merchant['storage_indexsort'])){
						$database_merchant->where($condition_merchant)->setField('storage_indexsort','0');
					}
				}
			}
			
			//设置团购自动增长
			$indexsort_groupid = intval($_POST['indexsort_groupid']);
			$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
			$database_merchant->where($condition_merchant)->setField('auto_indexsort_groupid',$indexsort_groupid);
		}
	}
	public function ajax_upload_pic(){
		if($_FILES['imgFile']['error'] != 4){
			$image = D('Image')->handle($this->merchant_session['mer_id'], 'merchant', 1);
			if ($image['error']) {
				exit(json_encode($image));
			} else {
				$title = $image['title']['imgFile'];
				$merchant_image_class = new merchant_image();
				$url = $merchant_image_class->get_image_by_path($title);
				exit(json_encode(array('error' => 0, 'url' => $url, 'title' => $title)));
			}
		} else {
			exit(json_encode(array('error' => 1,'message' =>'没有选择图片')));
		}
	}
	public function ajax_del_pic(){
		$merchant_image_class = new merchant_image();
		$merchant_image_class->del_image_by_path($_POST['path']);
	}
	/* 店铺管理 */
	public function store(){
		$mer_id = $this->merchant_session['mer_id'];
		//$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['mer_id'] = $mer_id;
		//$count_store = $database_merchant_store->where($condition_merchant_store)->count();
		$db_arr = array(C('DB_PREFIX').'area'=>'a',C('DB_PREFIX').'merchant_store'=>'s');
		//import('@.ORG.merchant_page');
		//$p = new Page($count_store,15);
		$store_list = D()->table($db_arr)->field(true)->where("`s`.`mer_id`='$mer_id' AND `s`.`area_id`=`a`.`area_id` AND s.status!=4")->order('`sort` DESC,`store_id` ASC')->find();
		//$store_list = D()->table($db_arr)->field(true)->where("`s`.`mer_id`='$mer_id' AND `s`.`area_id`=`a`.`area_id` AND s.status!=4")->order('`sort` DESC,`store_id` ASC')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('store',$store_list);
		//$pagebar = $p->show();
		//$this->assign('pagebar',$pagebar);

		$this->display();
	}
	public function store_ajax_upload_pic() {
		if ($_FILES['imgFile']['error'] != 4) {
			$image = D('Image')->handle($this->merchant_session['mer_id'], 'store', 1);
			if ($image['error']) {
				exit(json_encode($image));
			} else {
				$title = $image['title']['imgFile'];
				$store_image_class = new store_image();
				$url = $store_image_class->get_image_by_path($title);
				exit(json_encode(array('error' => 0, 'url' => $url, 'title' => $title)));
			}
		} else {
			exit(json_encode(array('error' => 1,'message' =>'没有选择图片')));
		}
	}
	public function store_ajax_del_pic(){
		$store_image_class = new store_image();
		$store_image_class->del_image_by_path($_POST['path']);
	}
	/* 添加店铺 */
	public function store_add(){
		$database_merchant_store = D('Merchant_store');
		$database_merchant = D('Merchant');
		if(IS_POST){
			
			//先保存农场信息
			$this->saveMerchant();

			if(empty($_POST['name'])){
				$this->error('店铺名称必填！');
			}
			if(empty($_POST['phone'])){
				$this->error('联系电话必填！');
			}
			if(empty($_POST['long_lat'])){
				$this->error('店铺经纬度必填！');
			}
			if(empty($_POST['adress'])){
				$this->error('店铺地址必填！');
			}
			if(empty($_POST['permoney'])){
				$this->error('人均消费必填！');
			}
			if(empty($_POST['feature'])){
				$this->error('店铺特色必填！');
			}
			if(empty($_POST['trafficroute'])){
				$this->error('交通路线必填！');
			}
			// if(empty($_POST['pic'])){
			// 	$this->error('请至少上传一张图片');
			// }
			// $_POST['pic_info'] = implode(';',$_POST['pic']);
				
			if(empty($_POST['txt_info'])){
				$this->error('请输入店铺描述信息');
			}
			
			//判断关键词
			$keywords = trim($_POST['keywords']);
			if(!empty($keywords)){
				$tmp_key_arr = explode(' ',$keywords);
				$key_arr = array();
				foreach($tmp_key_arr as $value){
					if(!empty($value)){
						array_push($key_arr,$value);
					}
				}
				if(count($key_arr)>5){
					$this->error('关键词最多5个。');
				}
			}
			
			//营业时间
			$office_time = array();
			if($_POST['office_start_time'] != '00:00' || $_POST['office_stop_time'] != '00:00'){
				array_push($office_time,array('open'=>$_POST['office_start_time'],'close'=>$_POST['office_stop_time']));
			}
			if($_POST['office_start_time2'] != '00:00' || $_POST['office_stop_time2'] != '00:00'){
				array_push($office_time,array('open'=>$_POST['office_start_time2'],'close'=>$_POST['office_stop_time2']));
			}
			if($_POST['office_start_time3'] != '00:00' || $_POST['office_stop_time3'] != '00:00'){
				array_push($office_time,array('open'=>$_POST['office_start_time3'],'close'=>$_POST['office_stop_time3']));
			}
			$_POST['office_time'] = serialize($office_time);
			
			$_POST['sort'] = intval($_POST['sort']);
			$long_lat = explode(',',$_POST['long_lat']);
			$_POST['long'] = $long_lat[0];
			$_POST['lat'] = $long_lat[1];
			$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
			$_POST['add_from'] = '0';
			$_POST['mer_id'] = $this->merchant_session['mer_id'];
			$ismain=intval($_POST['ismain']);
			if($this->config['store_verify']){
				$_POST['status'] = $this->merchant_session['issign'] ? '1' :'2';
			}else{
				$_POST['status'] = '1';
			}
			
			if($ismain==1){
			   $database_merchant_store->where(array('mer_id'=>$_POST['mer_id']))->save(array('ismain'=>0));
			}
			if($merchant_store_id = $database_merchant_store->data($_POST)->add()){
				M('Merchant_score')->add(array('parent_id'=>$insert_id,'type'=>2));
				//判断关键词
				if(!empty($key_arr)){
					$database_keywords = D('Keywords');
					$data_keywords['third_id'] = $merchant_store_id;
					$data_keywords['third_type'] = 'Merchant_store';
					foreach($key_arr as $value){
						$data_keywords['keyword'] = $value;
						$database_keywords->data($data_keywords)->add();
					}
				}
				
				$this->success('添加成功！',U("Config/store_edit"));
			}else{
				$this->error('添加失败！请重试~');
			}
		}else{
			//农场信息查询
			$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
			$now_merchant = $database_merchant->field(true,'pwd')->where($condition_merchant)->find();
			if(!empty($now_merchant['pic_info'])){
				$merchant_image_class = new merchant_image();
				$now_merchant['adverimgurl']=!empty($now_merchant['adverimg']) ? $merchant_image_class->get_image_by_path($now_merchant['adverimg']) :'';
				$tmp_pic_arr = explode(';',$now_merchant['pic_info']);
				foreach($tmp_pic_arr as $key=>$value){
					$now_merchant['pic'][$key]['title'] = $value;
					$now_merchant['pic'][$key]['url'] = $merchant_image_class->get_image_by_path($value);
				}
			}
			//头像显示
			$merchant_image_class = new merchant_image();
			$now_merchant['person_image'] = $merchant_image_class->get_image_by_path($now_merchant['person_image'],$this->config['site_url'],'s');

			$now_merchant['merchant_theme_image'] = $merchant_image_class->get_image_by_path($now_merchant['merchant_theme_image'],$this->config['site_url'],'s');

			$merchant_group_list = D('Group')->get_grouplist_by_MerchantId($now_merchant['mer_id']);

			$this->assign('now_merchant',$now_merchant);
			//先查看是否已经有店铺
			$store=$database_merchant_store->where(array('mer_id'=>$this->merchant_session['mer_id'],'status'=>1))->find();
			if(!empty($store)){
				$this->error('已经存在开启店铺禁止添加新店铺！');
			}
			//农场信息查询
			$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
			$now_merchant = $database_merchant->field(true,'pwd')->where($condition_merchant)->find();
			if(!empty($now_merchant['pic_info'])){
				$merchant_image_class = new merchant_image();
				$now_merchant['adverimgurl']=!empty($now_merchant['adverimg']) ? $merchant_image_class->get_image_by_path($now_merchant['adverimg']) :'';
				$tmp_pic_arr = explode(';',$now_merchant['pic_info']);
				foreach($tmp_pic_arr as $key=>$value){
					$now_merchant['pic'][$key]['title'] = $value;
					$now_merchant['pic'][$key]['url'] = $merchant_image_class->get_image_by_path($value);
				}
			}
			//头像显示
			$merchant_image_class = new merchant_image();
			$now_merchant['person_image'] = $merchant_image_class->get_image_by_path($now_merchant['person_image'],$this->config['site_url'],'s');

			$now_merchant['merchant_theme_image'] = $merchant_image_class->get_image_by_path($now_merchant['merchant_theme_image'],$this->config['site_url'],'s');

			$merchant_group_list = D('Group')->get_grouplist_by_MerchantId($now_merchant['mer_id']);

			$this->assign('now_merchant',$now_merchant);
			
			//分类开始
			$database_group_category = D('Group_category');
			$condition_f_group_category['cat_fid'] = 0;
			$condition_f_group_category['cat_status'] = 1;
			$f_category_list = $database_group_category->field('`cat_id`,`cat_name`,`cat_field`,`cue_field`')->where($condition_f_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
			$this->assign('f_category_list', $f_category_list);
			if (empty($f_category_list)) {
				$this->error('管理员没有添加' . $this->config['group_alias_name'] . '分类！');
			}
			$condition_s_group_category['cat_fid'] = $now_merchant['cat_fid'];
			$condition_s_group_category['cat_status'] = 1;
			$s_category_list = $database_group_category->field('`cat_id`,`cat_name`')->where($condition_s_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
			$this->assign('s_category_list', $s_category_list);

			//选取当前农场的所在地区
			$database_area = D('Area');
			$nowarea=$database_area->where("area_id=".$nowmerchant['area_id'])->find();
			$parearea=$database_area->where("area_id=".$nowarea['area_pid'])->find();
			$this->assign("province_id",$parearea['area_pid']);
			$this->assign("city_id",$parearea['area_id']);
			$this->assign("area_id",$nowarea['area_id']);
		   $merchant_mstore = $database_merchant_store->where(array('mer_id' => $this->merchant_session['mer_id'], 'ismain' => 1))->find();
		   $ismainno=true;
		   if(!empty($merchant_mstore)) $ismainno=false;
		   $this->assign('ismainno',$ismainno);
		   $this->display();
		}
	}
	/* 编辑店铺 */
	public function store_edit(){
		$database_merchant_store = D('Merchant_store');
		$database_merchant = D('Merchant');
		if(IS_POST){
			//调用保存农场信息的方法

			$this->saveMerchant();

			if(empty($_POST['name'])){
				$this->error('店铺名称必填！');
			}
			if(empty($_POST['phone'])){
				$this->error('联系电话必填！');
			}
			if(empty($_POST['long_lat'])){
				$this->error('店铺经纬度必填！');
			}
			if(empty($_POST['adress'])){
				$this->error('店铺地址必填！');
			}
			if(empty($_POST['permoney'])){
				$this->error('人均消费必填！');
			}
			if(empty($_POST['feature'])){
				$this->error('店铺特色必填！');
			}
			if(empty($_POST['trafficroute'])){
				$this->error('交通路线必填！');
			}	
			
			//$_POST['pic_info'] = implode(';',$_POST['pic']);
			
			if(empty($_POST['txt_info'])){
				$this->error('请输入店铺描述信息');
			}
			
			//判断关键词
			$keywords = trim($_POST['keywords']);
			if(!empty($keywords)){
				$tmp_key_arr = explode(' ',$keywords);
				$key_arr = array();
				foreach($tmp_key_arr as $value){
					if(!empty($value)){
						array_push($key_arr,$value);
					}
				}
				if(count($key_arr)>5){
					$this->error('关键词最多5个。');
				}
			}
			
			//营业时间
			$office_time = array();
			if($_POST['office_start_time'] != '00:00' || $_POST['office_stop_time'] != '00:00'){
				array_push($office_time,array('open'=>$_POST['office_start_time'],'close'=>$_POST['office_stop_time']));
			}
			if($_POST['office_start_time2'] != '00:00' || $_POST['office_stop_time2'] != '00:00'){
				array_push($office_time,array('open'=>$_POST['office_start_time2'],'close'=>$_POST['office_stop_time2']));
			}
			if($_POST['office_start_time3'] != '00:00' || $_POST['office_stop_time3'] != '00:00'){
				array_push($office_time,array('open'=>$_POST['office_start_time3'],'close'=>$_POST['office_stop_time3']));
			}
			$_POST['office_time'] = serialize($office_time);
			
			$_POST['sort'] = intval($_POST['sort']);
			$long_lat = explode(',',$_POST['long_lat']);
			$_POST['long'] = $long_lat[0];
			$_POST['lat'] = $long_lat[1];
			$_POST['last_time'] = $_SERVER['REQUEST_TIME'];
			$condition_merchant_store['store_id'] = $_POST['store_id'];
			$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
			unset($_POST['store_id']);
			$ismain=intval($_POST['ismain']);
			if($ismain==1){
			   $database_merchant_store->where(array('mer_id'=>$this->merchant_session['mer_id']))->save(array('ismain'=>0));
			}
			if($database_merchant_store->where($condition_merchant_store)->data($_POST)->save()){
				$data_keywords['third_id'] = $condition_merchant_store['store_id'];
				$data_keywords['third_type'] = 'Merchant_store';
				$database_keywords = D('Keywords');
				$database_keywords->where($data_keywords)->delete();
				//判断关键词
				if(!empty($key_arr)){
					foreach($key_arr as $value){
						$data_keywords['keyword'] = $value;
						$database_keywords->data($data_keywords)->add();
					}
				}
				
				$this->success('保存成功！');
			}else{
				$this->error('保存失败！！您是不是没做过修改？请重试~');
			}
		}else{

			//获取店铺id
			$store_id=$this->getStoreId();

			//农场信息查询
			$condition_merchant['mer_id'] = $this->merchant_session['mer_id'];
			$now_merchant = $database_merchant->field(true,'pwd')->where($condition_merchant)->find();
			if(!empty($now_merchant['pic_info'])){
				$merchant_image_class = new merchant_image();
				$now_merchant['adverimgurl']=!empty($now_merchant['adverimg']) ? $merchant_image_class->get_image_by_path($now_merchant['adverimg']) :'';
				$tmp_pic_arr = explode(';',$now_merchant['pic_info']);
				foreach($tmp_pic_arr as $key=>$value){
					$now_merchant['pic'][$key]['title'] = $value;
					$now_merchant['pic'][$key]['url'] = $merchant_image_class->get_image_by_path($value);
				}
			}
			//头像显示
			$merchant_image_class = new merchant_image();
			$now_merchant['person_image'] = $merchant_image_class->get_image_by_path($now_merchant['person_image'],$this->config['site_url'],'s');

			$now_merchant['merchant_theme_image'] = $merchant_image_class->get_image_by_path($now_merchant['merchant_theme_image'],$this->config['site_url'],'s');

			$merchant_group_list = D('Group')->get_grouplist_by_MerchantId($now_merchant['mer_id']);

			$this->assign('now_merchant',$now_merchant);

			$condition_merchant_store['store_id'] = $store_id;
			$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
			$now_store = $database_merchant_store->where($condition_merchant_store)->find();
			if(empty($now_store)){
				$this->error('店铺不存在！');
			}
			$now_store['office_time'] = unserialize($now_store['office_time']);
			
			if(!empty($now_store['pic_info'])){
				$store_image_class = new store_image();
				$tmp_pic_arr = explode(';',$now_store['pic_info']);
				foreach($tmp_pic_arr as $key=>$value){
					$now_store['pic'][$key]['title'] = $value;
					$now_store['pic'][$key]['url'] = $store_image_class->get_image_by_path($value);
				}
			}
			$keywords = D('Keywords')->where(array('third_type' => 'Merchant_store', 'third_id' => $condition_merchant_store['store_id']))->select();
			$str = "";
			foreach ($keywords as $key) {
				$str .= $key['keyword'] . " ";
			}
			$now_store['keywords'] = $str;
			$this->assign('now_store',$now_store);
			//分类开始
			$database_group_category = D('Group_category');
			$condition_f_group_category['cat_fid'] = 0;
			$condition_f_group_category['cat_status'] = 1;
			$f_category_list = $database_group_category->field('`cat_id`,`cat_name`,`cat_field`,`cue_field`')->where($condition_f_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
			$this->assign('f_category_list', $f_category_list);
			if (empty($f_category_list)) {
				$this->error('管理员没有添加' . $this->config['group_alias_name'] . '分类！');
			}
			$condition_s_group_category['cat_fid'] = $now_merchant['cat_fid'];
			$condition_s_group_category['cat_status'] = 1;
			$s_category_list = $database_group_category->field('`cat_id`,`cat_name`')->where($condition_s_group_category)->order('`cat_sort` DESC,`cat_id` ASC')->select();
			$this->assign('s_category_list', $s_category_list);
//			if (empty($s_category_list)) {
//				$this->error($f_category_list[0]['cat_name'] . ' 分类下没有添加子分类！');
//			}
			//分类结束
			$this->assign('merchant_group_list',$merchant_group_list);
			
			$this->display();
		}
	}
	/* 店铺状态 */
	public function store_status(){
		$database_merchant_store = D('Merchant_store');
		$data_merchant_store['status'] = $_POST['type'] == 'open' ? '1' : '0';
		$condition_merchant_store['store_id'] = $_POST['id'];
		$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
		if($database_merchant_store->where($condition_merchant_store)->data($data_merchant_store)->save()){
			exit('1');
		}else{
			exit;
		}
	}
	/* 删除店铺 */
	public function store_del(){
		$condition_merchant_store['store_id'] = intval(trim($_GET['id']));
		$group_storeDb = D('Group_store');
		if($group_storeDb->where($condition_merchant_store)->order('group_id desc')->find()){
		     $this->error('该店铺下有'.$this->config['group_alias_name'].'，请先解除店铺与对应'.$this->config['group_alias_name'].'的关系才能删除！');
			 exit();
		}
		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
		/***$database_merchant_store->where($condition_merchant_store)->delete()**改软删除*4禁用***/
		if($database_merchant_store->where($condition_merchant_store)->save(array('status'=>4))){
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}
	}
	
	public function staff(){
		//获取店铺id
		$store_id=$this->getStoreId();

		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['store_id'] = $store_id;
		$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
		$now_store = $database_merchant_store->where($condition_merchant_store)->find();
		if(empty($now_store)){
			$this->error('店铺不存在！');
		}
		$this->assign('now_store',$now_store);
		
			
		$condition_store_staff['token'] = $this->token;
		$condition_store_staff['store_id'] = $store_id;
		$staff_list = D('Merchant_store_staff')->where($condition_store_staff)->order('`id` desc')->select();
		$this->assign('staff_list', $staff_list);
		$this->display();
	}
	public function staffSet(){
		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['store_id'] = $_GET['store_id'];
		$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
		$now_store = $database_merchant_store->where($condition_merchant_store)->find();
		if(empty($now_store)){
			$this->error('店铺不存在！');
		}
		$this->assign('now_store',$now_store);
		
		$_POST['store_id'] = $now_store['store_id'];
		$company_staff_db = M('Merchant_store_staff');
		if(IS_POST){
			if (!trim($_POST['name']) || !trim($_POST['username'])){
				$this->error('姓名、帐号都不能为空');
			}
			$_POST['token'] = $this->token;
			$_POST['time'] = time();
			
			if (!isset($_GET['itemid'])){
				$condition_store_staff_username['username'] = $_POST['username'];
				if($company_staff_db->field('`id`')->where($condition_store_staff_username)->find()){
					$this->error('帐号已经存在！请换一个。');
				}
				if(!trim($_POST['password'])){
					$this->error('密码不能为空');
				}
				$_POST['password'] = md5($_POST['password']);
				
				if(!$company_staff_db->add($_POST)){
					$this->error('添加失败，请重试。');
				}
			}else{
				/* 检测帐号 */
				$condition_store_staff_username['username'] = $_POST['username'];
				$username_staff = $company_staff_db->field('`id`')->where($condition_store_staff_username)->find();
				if($username_staff['id'] != $_GET['itemid']){
					$this->error('帐号已经存在！请换一个。');
				}

				if(!trim($_POST['password'])){
					unset($_POST['password']);
				}else{
					$_POST['password'] = md5($_POST['password']);
				}
				if(!$company_staff_db->where(array('id'=>intval($_GET['itemid'])))->save($_POST)){
					$this->error('修改失败，请重试。');
				}
			}
			$this->success('操作成功',U('Config/staff',array('store_id'=>$now_store['store_id'])));
		}else{
			if (isset($_GET['itemid'])) {
				$thisItem = $company_staff_db->where(array('id'=>intval($_GET['itemid'])))->find();
			} else {
				$thisItem['companyid'] = 0;
			}
			$this->assign('item', $thisItem);
			$this->display('staffSet');
		}
	}
	public function staffDelete(){
		$database_merchant_store = D('Merchant_store');
		$condition_merchant_store['store_id'] = $_GET['store_id'];
		$condition_merchant_store['mer_id'] = $this->merchant_session['mer_id'];
		$now_store = $database_merchant_store->where($condition_merchant_store)->find();
		if(empty($now_store)){
			$this->error('店铺不存在！');
		}
		$this->assign('now_store',$now_store);
		
		$company_staff_db = M('Merchant_store_staff');
		
		$condition_store_staff['token'] = $this->token;
		$condition_store_staff['id'] = $_GET['itemid'];
		if($company_staff_db->where($condition_store_staff)->delete()){
			$this->success('操作成功',U('Config/staff',array('store_id'=>$now_store['store_id'])));
		}else{
			$this->error('操作失败，请重试。');
		}
		
	}
}