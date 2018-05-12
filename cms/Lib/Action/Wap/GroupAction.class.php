<?php
class GroupAction extends BaseAction{
	public function index(){
		
		//判断分类信息
		$cat_url = !empty($_GET['cat_url']) ? $_GET['cat_url'] : '';
		$this->assign('now_cat_url', $cat_url);
		
		//判断地区信息
		$area_url = !empty($_GET['area_url']) ? $_GET['area_url'] : '';
		$this->assign('now_area_url',$area_url);
		
		$circle_id = 0;
		if(!empty($area_url)){
			$tmp_area = D('Area')->get_area_by_areaUrl($area_url);
			if(empty($tmp_area)){
				$this->error('当前区域不存在！');
			}
			$this->assign('now_area', $tmp_area);
			
			if ($tmp_area['area_type'] == 3) {
				$now_area = $tmp_area;
			} else {
				$now_circle = $tmp_area;
				$this->assign('now_circle', $now_circle);
				$now_area = D('Area')->get_area_by_areaId($tmp_area['area_pid'], true, $cat_url);
				if (empty($tmp_area)) {
					$this->error('当前区域不存在！');
				}
				$circle_url = $now_circle['area_url'];
				$circle_id = $now_circle['area_id'];
				$area_url = $now_area['area_url'];
			}
			$this->assign('top_area', $now_area);
			$area_id = $now_area['area_id'];
		}else{
			$area_id = 0;
		}
		
		//判断排序信息
		$sort_id = !empty($_GET['sort_id']) ? $_GET['sort_id'] : 'juli';

		$long_lat = D('User_long_lat')->getLocation($_SESSION['openid']);
		if(empty($long_lat)){
			$sort_id = $sort_id == 'juli' ? 'defaults' : $sort_id;
			$sort_array = array(
				array('sort_id'=>'defaults','sort_value'=>'默认排序'),
				array('sort_id'=>'rating','sort_value'=>'评价最高'),
				array('sort_id'=>'start','sort_value'=>'最新发布'),
				array('sort_id'=>'solds','sort_value'=>'人气最高'),
				array('sort_id'=>'price','sort_value'=>'价格最低'),
				array('sort_id'=>'priceDesc','sort_value'=>'价格最高'),					
			);
		} else {
			$sort_array = array(
				array('sort_id'=>'juli','sort_value'=>'离我最近'),
				array('sort_id'=>'rating','sort_value'=>'评价最高'),
				array('sort_id'=>'start','sort_value'=>'最新发布'),
				array('sort_id'=>'solds','sort_value'=>'人气最高'),
				array('sort_id'=>'price','sort_value'=>'价格最低'),
				array('sort_id'=>'priceDesc','sort_value'=>'价格最高'),
			);
			$this->assign('long_lat',$long_lat);
		}
		foreach($sort_array as $key=>$value){
			if($sort_id == $value['sort_id']){
				$now_sort_array = $value;
				break;
			}
		}
		$this->assign('sort_array',$sort_array);
		$this->assign('now_sort_array',$now_sort_array);
		
		
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_all_category();
		$this->assign('all_category_list',$all_category_list);
		
		//根据分类信息获取分类
		if(!empty($cat_url)){
			$now_category = D('Group_category')->get_category_by_catUrl($cat_url);
			if(empty($now_category)){
				$this->error_tips('此分类不存在！');
			}
			$this->assign('now_category',$now_category);
			
			if(!empty($now_category['cat_fid'])){
				$f_category = D('Group_category')->get_category_by_id($now_category['cat_fid']);
				$all_category_url = $f_category['cat_url'];
				$category_cat_field = $f_category['cat_field'];
			
				$top_category = $f_category;
				$this->assign('top_category',$f_category);
			
				$get_grouplist_catfid = 0;
				$get_grouplist_catid = $now_category['cat_id'];
			}else{
				$all_category_url = $now_category['cat_url'];
				$category_cat_field = $now_category['cat_field'];
				$top_category = $now_category;
				$this->assign('top_category',$now_category);
			
				$get_grouplist_catfid = $now_category['cat_id'];
				$get_grouplist_catid = 0;
			}
			
// 			if(!empty($category_cat_field)){
// 				$cat_field = unserialize($category_cat_field);
// 				foreach($cat_field as $key=>$value){
					//包含区域
// 					if($value['use_field'] && $value['use_field'] == 'area'){
// 						$all_area_list = D('Area')->get_area_list();
// 						$this->assign('all_area_list',$all_area_list);
// 					}
// 				}
// 			}
		}else{
			//所有区域
// 			$all_area_list = D('Area')->get_all_area_list();
// 			$this->assign('all_area_list',$all_area_list);
		}
		$all_area_list = D('Area')->get_all_area_list();
		$this->assign('all_area_list',$all_area_list);
		//$long_lat['lat'] = 31.823263;
		//$long_lat['long'] = 117.235268;
		$this->assign(D('Group')->wap_get_group_list_by_catid($get_grouplist_catid,$get_grouplist_catfid,$area_id,$sort_id, $long_lat['lat'], $long_lat['long'], $circle_id));
		//if(session("user")['uid']==753){
		//    echo json_encode(D('Group')->wap_get_group_list_by_catid($get_grouplist_catid,$get_grouplist_catfid,$area_id,$sort_id, $long_lat['lat'], $long_lat['long'], $circle_id));die;
      //  }
		
		/* 粉丝行为分析 */
		$this->behavior(array('model'=>'Group_index'));
		
		$this->display();
	}
	public function ajaxList(){
		$this->header_json();
		//判断分类信息
		$cat_url = !empty($_GET['cat_url']) ? $_GET['cat_url'] : '';
	
		//判断地区信息
		$area_url = !empty($_GET['area_url']) ? $_GET['area_url'] : '';
		
		$circle_id = 0;
		if(!empty($area_url)){
			$tmp_area = D('Area')->get_area_by_areaUrl($area_url);
			if(empty($tmp_area)){
				$this->error('当前区域不存在！');
			}

			if ($tmp_area['area_type'] == 3) {
				$now_area = $tmp_area;
			} else {
				$now_circle = $tmp_area;
				$now_area = D('Area')->get_area_by_areaId($tmp_area['area_pid'], true, $cat_url);
				if (empty($tmp_area)) {
					$this->error('当前区域不存在！');
				}
				$circle_url = $now_circle['area_url'];
				$circle_id = $now_circle['area_id'];
				$area_url = $now_area['area_url'];
			}
			$area_id = $now_area['area_id'];
		}else{
			$area_id = 0;
		}
		
		//判断排序信息
		$sort_id = !empty($_GET['sort_id']) ? $_GET['sort_id'] : 'juli';

		$long_lat = D('User_long_lat')->getLocation($_SESSION['openid'],0);
		if(empty($long_lat)){
			$sort_id = $sort_id == 'juli' ? 'defaults' : $sort_id;
			$sort_array = array(
					array('sort_id'=>'defaults','sort_value'=>'默认排序'),
					array('sort_id'=>'rating','sort_value'=>'评价最高'),
					array('sort_id'=>'start','sort_value'=>'最新发布'),
					array('sort_id'=>'solds','sort_value'=>'人气最高'),
					array('sort_id'=>'price','sort_value'=>'价格最低'),
					array('sort_id'=>'priceDesc','sort_value'=>'价格最高'),
					
			);
		}else{
			$sort_array = array(
					array('sort_id'=>'juli','sort_value'=>'离我最近'),
					array('sort_id'=>'rating','sort_value'=>'评价最高'),
					array('sort_id'=>'start','sort_value'=>'最新发布'),
					array('sort_id'=>'solds','sort_value'=>'人气最高'),
					array('sort_id'=>'price','sort_value'=>'价格最低'),
					array('sort_id'=>'priceDesc','sort_value'=>'价格最高'),
			
			);
		}
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_all_category();

		//根据分类信息获取分类
		if(!empty($cat_url)){
			$now_category = D('Group_category')->get_category_by_catUrl($cat_url);
			if(empty($now_category)){
				$this->error_tips('此分类不存在！');
			}

			if(!empty($now_category['cat_fid'])){
				$f_category = D('Group_category')->get_category_by_id($now_category['cat_fid']);
				$all_category_url = $f_category['cat_url'];
				$category_cat_field = $f_category['cat_field'];
			
				$top_category = $f_category;

				$get_grouplist_catfid = 0;
				$get_grouplist_catid = $now_category['cat_id'];
			}else{
				$all_category_url = $now_category['cat_url'];
				$category_cat_field = $now_category['cat_field'];
				$top_category = $now_category;
				
				$get_grouplist_catfid = $now_category['cat_id'];
				$get_grouplist_catid = 0;
			}
			
		}
		if($sort_id == 'juli'){
			$return = D('Group')->wap_get_storeList_by_catid($get_grouplist_catid,$get_grouplist_catfid,$area_id,$sort_id, $long_lat['lat'], $long_lat['long'], $circle_id);
			foreach($return['store_list'] as &$storeValue){
				$storeValue['range_txt'] = $this->wapFriendRange($storeValue['juli']);
				$group_list = S('wap_store_group_'.$storeValue['store_id']);
				if(empty($group_list)){
					$group_list = D('Group')->get_single_store_group_list($storeValue['store_id'],0,true);
					S('wap_store_group_'.$storeValue['store_id'],$group_list,360);
				}else{
					foreach($group_list as &$groupValue){
						if($groupValue['end_time'] < $_SERVER['REQUEST_TIME']){
							unset($groupValue);
						}
					}
				}
				$storeValue['group_list'] = $group_list;
				$storeValue['group_count'] = count($group_list);
				if(empty($storeValue['group_count'])){
					unset($storeValue);
				}
			}
			$return['style'] = 'store';
		}else{
			$return = D('Group')->wap_get_group_list_by_catid($get_grouplist_catid,$get_grouplist_catfid,$area_id,$sort_id, $long_lat['lat'], $long_lat['long'], $circle_id);
			$return['style'] = 'group';
		}
		echo json_encode($return);
		/* 粉丝行为分析 */
		$this->behavior(array('model'=>'Group_index'));
	}
	public function detail(){
	    if($_GET["preview"]==1){
	        $group_id=$_GET['group_id'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1'  AND `g`.`group_id`='$group_id'";
            $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
            $condition_field  = '`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
            $database = D('');
            $now_group = D('')->field($condition_field)->table($condition_table)->where($condition_where)->find();
          //  echo  D()->getLastSql();die;
            if(!empty($now_group)){
                $now_group['price'] = floatval($now_group['price']);
                $now_group['old_price'] = floatval($now_group['old_price']);
                $now_group['wx_cheap'] = floatval($now_group['wx_cheap']);
                $now_group['url'] = C('config.site_url').'/group/'.$now_group['group_id'].'.html';
                $now_group['buy_url'] = C('config.site_url').'/group/buy/'.$now_group['group_id'].'.html';
                $now_group["secondprice"]=floatval($now_group['secondprice']);
                $group_image_class = new group_image();
                $now_group['all_pic'] = $group_image_class->get_allImage_by_path($now_group['pic']);

                $now_group['store_list'] = D('Group_store')->get_storelist_by_groupId($now_group['group_id']);
                if(count($now_group['store_list']) == 1){
                    $now_group['store_list'][0]['area'] = D('Area')->get_area_by_areaId($now_group['store_list'][0]['area_id']);
                    $now_group['store_list'][0]['circle'] = D('Area')->get_area_by_areaId($now_group['store_list'][0]['circle_id']);
                }


                $condition_group['group_id'] = $group_id;
                D("Group")->where($condition_group)->setInc('hits');


            }
        }else{
            $now_group = D('Group')->get_group_by_groupId($_GET['group_id'],'hits-setInc');
        }

		if(empty($now_group)||$now_group['is_group_buy']){
			$this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
		}
		if($now_group['cue']){
			$now_group['cue_arr'] = unserialize($now_group['cue']);
		}
		if(!empty($now_group['pic_info'])){
			$merchant_image_class = new merchant_image();
			$now_group['merchant_pic'] = $merchant_image_class->get_allImage_by_path($now_group['pic_info']);
		}
		//判断是否微信浏览器，
		$long_lat = D('User_long_lat')->getLocation($_SESSION['openid']);
		if($long_lat){
			$rangeSort = array();
			foreach($now_group['store_list'] as &$storeValue){
				$storeValue['Srange'] = getDistance($long_lat['lat'],$long_lat['long'],$storeValue['lat'],$storeValue['long']);
				$storeValue['range'] = getRange($storeValue['Srange'],false);
				$rangeSort[] = $storeValue['Srange'];
			}
			array_multisort($rangeSort, SORT_ASC, $now_group['store_list']);
			$this->assign('long_lat',$long_lat);
		}
		
		if(!empty($this->user_session)){
			$database_user_collect = D('User_collect');
			$condition_user_collect['type'] = 'group_detail';
			$condition_user_collect['id'] = $now_group['group_id'];
			$condition_user_collect['uid'] = $this->user_session['uid'];
			if($database_user_collect->where($condition_user_collect)->find()){
				$now_group['is_collect'] = true;
			}
			if(!empty($_SESSION['openid'])&&!empty($now_group['mer_id'])){
			D("Merchant")->saveRelation($_SESSION['openid'],$now_group['mer_id'],false);
			}
		}
			if($now_group['mer_id']==686){
			$this->assign("no_footer",true);
		}

//        if($now_group['group_id']==3174){
//            echo  json_encode($now_group);die;
//        }
		$this->assign('now_group',$now_group);
		
		if($now_group['reply_count']){
			$reply_list = D('Reply')->get_reply_list($now_group['group_id'],0,count($now_group['store_list']),3);
			foreach($reply_list as $key=>$value){
				if($value['anonymous']){
					$reply_list[$key]['nickname']="匿名用户";
				}
			}
			$this->assign('reply_list',$reply_list);
		}
		
		$merchant_group_list = D('Group')->get_grouplist_by_MerchantId($now_group['mer_id'],3,true,$now_group['group_id']);
		$this->assign('merchant_group_list',$merchant_group_list);
		
		//分类下其他团购
		$category_group_list = D('Group')->get_grouplist_by_catId($now_group['cat_id'],$now_group['cat_fid'],3,true);
		foreach($category_group_list as $key=>$value){
			if($value['group_id'] == $now_group['group_id']){
				unset($category_group_list[$key]);
			}
		}
		$this->assign('category_group_list',$category_group_list);
		
		

		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($now_group['mer_id'],array('group_hits'=>1));
		
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id'=>$now_group['mer_id'],'biz_id'=>$now_group['group_id'],'keyword'=>strval($_GET['keywords'])));
		
		
		if ($services = D('Customer_service')->where(array('mer_id' => $now_group['mer_id']))->select()) {
			$key = $this->get_encrypt_key(array('app_id'=>$this->config['im_appid'],'openid' => $_SESSION['openid']), $this->config['im_appkey']);
			$kf_url = 'http://im-link.winworlds.cn/?app_id=' . $this->config['im_appid'] . '&openid=' . $_SESSION['openid'] . '&key=' . $key . '#serviceList_' . $now_group['mer_id'];
			$this->assign('kf_url', $kf_url);
		}
		  $this->assign("isscan",($_GET['isscan']==0)?0:1);
		
		$this->display();
	}
	public function set(){
		$now_group = D('Group')->get_group_by_groupId($_GET['group_id'],'hits-setInc');
		if(empty($now_group)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
		}
		if($now_group['cue']){
			$now_group['cue_arr'] = unserialize($now_group['cue']);
		}
		if(!empty($now_group['pic_info'])){
			$merchant_image_class = new merchant_image();
			$now_group['merchant_pic'] = $merchant_image_class->get_allImage_by_path($now_group['pic_info']);
		}
		
		if(!empty($this->user_session)){
			$database_user_collect = D('User_collect');
			$condition_user_collect['type'] = 'group_detail';
			$condition_user_collect['id'] = $now_group['group_id'];
			$condition_user_collect['uid'] = $this->user_session['uid'];
			if($database_user_collect->where($condition_user_collect)->find()){
				$now_group['is_collect'] = true;
			}
		}
		
		$this->assign('now_group',$now_group);
		
		if($now_group['reply_count']){
			$reply_list = D('Reply')->get_reply_list($now_group['group_id'],0,count($now_group['store_list']),3);
			$this->assign('reply_list',$reply_list);
		}
		
		$merchant_group_list = D('Group')->get_grouplist_by_MerchantId($now_group['mer_id'],3,true,$now_group['group_id']);
		$this->assign('merchant_group_list',$merchant_group_list);
		
		//分类下其他团购
		$category_group_list = D('Group')->get_grouplist_by_catId($now_group['cat_id'],$now_group['cat_fid'],3,true);
		foreach($category_group_list as $key=>$value){
			if($value['group_id'] == $now_group['group_id']){
				unset($category_group_list[$key]);
			}
		}
		$this->assign('category_group_list',$category_group_list);
		
		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($now_group['mer_id'],array('group_hits'=>1));
		
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id'=>$now_group['mer_id'],'biz_id'=>$now_group['group_id'],'keyword'=>strval($_GET['keywords'])));
		
		$this->display();
	}
	public function feedback(){
		$now_group = D('Group')->get_group_by_groupId($_GET['group_id']);
		if(empty($now_group)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
		}
		$this->assign('now_group',$now_group);
		
		$_POST['page'] = $_GET['page'];
		$reply_return = D('Reply')->get_page_reply_list($now_group['group_id'],0,'','time',count($now_group['store_list']));
		$reply_return['pagebar'] = '';
		if($$reply_return['total'] > 1){
			if($reply_return['now'] == 1){
				$reply_return['pagebar'] .= '<a class="btn btn-weak btn-disabled">上一页</a>';
			}else{
				$reply_return['pagebar'] .= '<a class="btn btn-weak" href="'.(U('Group/feedback',array('group_id'=>$now_group['group_id'],'page'=>$reply_return['now']-1))).'">上一页</a>';
			}
			$reply_return['pagebar'] .= '<span class="pager-current">'.($reply_return['now']).'</span>';
			if($reply_return['now'] == $reply_return['total']){
				$reply_return['pagebar'] .= '<a class="btn btn-weak btn-disabled">下一页</a>';
			}else{
				$reply_return['pagebar'] .= '<a class="btn btn-weak" href="'.(U('Group/feedback',array('group_id'=>$now_group['group_id'],'page'=>$reply_return['now']+1))).'">下一页</a>';
			}
		}
		$this->assign($reply_return);
		
		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($now_group['mer_id'],array('group_hits'=>1));
		
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id'=>$now_group['mer_id'],'biz_id'=>$now_group['group_id']));
		
		$this->display();
	}
	public function ajaxFeedback(){
		$this->header_json();
		$now_group = D('Group')->get_group_by_groupId($_GET['group_id']);
		if(empty($now_group)){
			exit(json_encode(array('status'=>0,'info'=>'当前'.$this->config['group_alias_name'].'不存在！')));
		}
		$reply_return = D('Reply')->get_page_reply_list($now_group['group_id'],0,'','time',count($now_group['store_list']));
		$reply_return['status'] = 1;
		exit(json_encode($reply_return));
	}
	public function branch(){
		$now_group = D('Group')->get_group_by_groupId($_GET['group_id']);

		if(empty($now_group)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
		}
		
		//判断是否微信浏览器，
		if($_SESSION['openid']){
			$long_lat = D('User_long_lat')->field('long,lat')->where(array('open_id' => $_SESSION['openid']))->find();
			if($long_lat){
				import('@.ORG.longlat');
				$longlat_class = new longlat();
				$location2 = $longlat_class->gpsToBaidu($long_lat['lat'], $long_lat['long']);//转换腾讯坐标到百度坐标
				$rangeSort = array();
				foreach($now_group['store_list'] as &$storeValue){
					$storeValue['Srange'] = getDistance($location2['lat'],$location2['lng'],$storeValue['lat'],$storeValue['long']);
					$storeValue['range'] = getRange($storeValue['Srange'],false);
					$rangeSort[] = $storeValue['Srange'];
				}
				array_multisort($rangeSort, SORT_ASC, $now_group['store_list']);
			}
		}
		$this->assign('now_group',$now_group);
		
		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($now_group['mer_id'],array('group_hits'=>1));
		
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id'=>$now_group['mer_id'],'biz_id'=>$now_group['group_id']));
		
		$this->display();
	}
	public function map(){
		$now_group = D('Group')->get_group_by_groupId($_GET['group_id']);

		if(empty($now_group)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
		}
		
		//判断是否微信浏览器，
		if($_SESSION['openid']){
			$long_lat = D('User_long_lat')->field('long,lat')->where(array('open_id' => $_SESSION['openid']))->find();
			if($long_lat){
				import('@.ORG.longlat');
				$longlat_class = new longlat();
				$location2 = $longlat_class->gpsToBaidu($long_lat['lat'], $long_lat['long']);//转换腾讯坐标到百度坐标
				foreach($now_group['store_list'] as &$storeValue){
					$storeValue['range'] = getRange(getDistance($location2['lat'],$location2['lng'],$storeValue['lat'],$storeValue['long']),false);
				}
			}
		}
		
		$this->assign('now_group',$now_group);
		
		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($now_group['mer_id'],array('group_hits'=>1));
		
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id'=>$now_group['mer_id'],'biz_id'=>$now_group['group_id']));
		
		$this->display();
	}
	public function buy(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！',U('Login/index'));
		}
		$now_user = D('User')->get_user($this->user_session['uid']);
		if(empty($this->user_session['phone']) && !empty($now_user['phone'])){
			$_SESSION['user']['phone'] = $this->user_session['phone'] = $now_user['phone'];
		}
		$this->assign('now_user',$now_user);
		
		$now_group = D('Group')->get_group_by_groupId($_GET['group_id']);
		if(empty($now_group)){
			$this->error_tips('当前'.$this->config['group_alias_name'].'不存在！');
		}
		
		if($now_group['begin_time'] > $_SERVER['REQUEST_TIME']){
			$this->error_tips('此单'.$this->config['group_alias_name'].'还未开始！');
		}
		if($now_group['type'] > 2){
			$this->error_tips('此单'.$this->config['group_alias_name'].'已结束！');
		}

		//用户等级 优惠
		$level_off=false;
		$finalprice=0;
		if(!empty($this->user_level) && !empty($this->user_session) && isset($this->user_session['level'])){
			$leveloff=!empty($now_group['leveloff']) ? unserialize($now_group['leveloff']) :'';
			/****type:0无优惠 1百分比 2立减*******/
			if(!empty($leveloff) && isset($leveloff[$this->user_session['level']]) && isset($this->user_level[$this->user_session['level']])){
				$level_off=$leveloff[$this->user_session['level']];
				if($level_off['type']==1){
				  $finalprice=$now_group['price']*($level_off['vv']/100);
				  $finalprice=$finalprice>0 ? $finalprice : 0;
				  $level_off['offstr']='单价按原价'.$level_off['vv'].'%来结算';

				}elseif($level_off['type']==2){
				  $finalprice=$now_group['price']-$level_off['vv'];
				  $finalprice=$finalprice>0 ? $finalprice : 0;
				  $level_off['offstr']='单价立减'.$level_off['vv'].'元';
				  
				}
			}
		}
		is_array($level_off) && $level_off['price']=round($finalprice,2);
		unset($leveloff);

		if(IS_POST){
			$finalprice > 0 && $now_group['price']=round($finalprice,2);
			$result = D('Group_order')->save_post_form($now_group,$this->user_session['uid'],0);		
			if($result['error'] == 1){
				$this->error_tips($result['msg']);
			}
			//如果订单保存成功然后保存粉丝
			if(!empty($_SESSION['openid'])){
			D("Merchant")->saveRelation($_SESSION['openid'],$now_group['mer_id'],false);
			}
			redirect(U('Pay/check',array('order_id'=>$result['order_id'],'type'=>'group')));
		}else{
			if($now_group['tuan_type'] == 2){
				$now_group['user_adress'] = D('User_adress')->get_one_adress($this->user_session['uid'],intval($_GET['adress_id']));
			}
			$now_group['wx_cheap'] = floatval($now_group['wx_cheap']);

			$this->assign('leveloff',$level_off);
			$this->assign('finalprice',$finalprice);
			$this->assign('now_group',$now_group);
			   $this->assign('is_scan',$_GET['is_scan']==0?0:1);
			if($this->user_session['phone']){
				$this->assign('pigcms_phone',substr($this->user_session['phone'],0,3).'****'.substr($this->user_session['phone'],7));
			}else{
				$this->assign('pigcms_phone','您需要绑定手机号码');
			}
			/* 粉丝行为分析 */
			D('Merchant_request')->add_request($now_group['mer_id'],array('group_hits'=>1));
			
			/* 粉丝行为分析 */
			$this->behavior(array('mer_id'=>$now_group['mer_id'],'biz_id'=>$now_group['group_id']));

			$this->display();
		}
	}
	public function shop(){
		$now_store = D('Merchant_store')->get_store_by_storeId($_GET['store_id']);
		if(empty($now_store)){
			$this->error_tips('该店铺不存在！');
		}
		//查找对应的农场主头像
		$farm_person=D("Merchant")->field("person_image")->where("mer_id=".$now_store['mer_id'])->find();
		$merchant_image_class = new merchant_image();
		$person_image = $merchant_image_class->get_image_by_path($farm_person["person_image"]);
		
		$this->assign("person_image",$person_image);
		//得到当前店铺的评分
		$store_score = D('Merchant_score')->field('`score_all`,`reply_count`')->where(array('parent_id'=>$now_store['store_id'],'type'=>'2'))->find();
		$this->assign('store_score',$store_score);
		
		if(!empty($this->user_session)){
			$database_user_collect = D('User_collect');
			$condition_user_collect['type'] = 'group_shop';
			$condition_user_collect['id'] = $now_store['store_id'];
			$condition_user_collect['uid'] = $this->user_session['uid'];
			if($database_user_collect->where($condition_user_collect)->find()){
				$now_store['is_collect'] = true;
			}
		}
		
		$this->assign('now_store',$now_store);
		
		$store_group_list = D('Group')->get_store_group_list($now_store['store_id'],0,true);
		$this->assign('store_group_list',$store_group_list);
		
		//为粉丝推荐
		$index_sort_group_list = D('Group')->get_group_list('index_sort',10,true);
		//判断是否微信浏览器，
		if($_SESSION['openid'] && $index_sort_group_list){
			$long_lat = D('User_long_lat')->field('long,lat')->where(array('open_id' => $_SESSION['openid']))->find();
			if($long_lat){
				import('@.ORG.longlat');
				$longlat_class = new longlat();
				$location2 = $longlat_class->gpsToBaidu($long_lat['lat'], $long_lat['long']);//转换腾讯坐标到百度坐标
				$group_store_database = D('Group_store');
				foreach($index_sort_group_list as &$storeGroupValue){
					$tmpStoreList = $group_store_database->get_storelist_by_groupId($storeGroupValue['group_id']);
					if($tmpStoreList){
						foreach($tmpStoreList as &$tmpStore){
							$tmpStore['Srange'] = getDistance($location2['lat'],$location2['lng'],$tmpStore['lat'],$tmpStore['long']);
							$tmpStore['range'] = getRange($tmpStore['Srange'],false);
							$rangeSort[] = $tmpStore['Srange'];
						}
						array_multisort($rangeSort, SORT_ASC, $tmpStoreList);
						$storeGroupValue['store_list'] = $tmpStoreList;	
						$storeGroupValue['range'] = $tmpStoreList[0]['range'];
					}
				}
			}
		}
		$this->assign('index_sort_group_list',$index_sort_group_list);
		
		
		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($now_store['mer_id'],array('group_hits'=>1));
		
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id'=>$now_store['mer_id'],'store_id'=>$now_store['store_id']));
		
		$this->display();
	}
	public function addressinfo(){
		$now_store = D('Merchant_store')->get_store_by_storeId($_GET['store_id']);
		if(empty($now_store)){
			$this->error_tips('该店铺不存在！');
		}
		$this->assign('now_store',$now_store);
		
		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($now_store['mer_id'],array('group_hits'=>1));
		
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id'=>$now_store['mer_id'],'store_id'=>$now_store['store_id']));
		
		$this->display();
	}
	public function get_route(){
		$now_store = D('Merchant_store')->get_store_by_storeId($_GET['store_id']);
		if(empty($now_store)){
			$this->error_tips('该店铺不存在！');
		}
		$this->assign('now_store',$now_store);
		
		$this->assign('no_gotop',true);
		
		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($now_store['mer_id'],array('group_hits'=>1));
		
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id'=>$now_store['mer_id'],'store_id'=>$now_store['store_id']));
		
		$this->display();
	}
	
	public function around(){

		$long_lat['lat'] = $_COOKIE['around_lat'];
		$long_lat['long'] = $_COOKIE['around_long'];
		
		if(empty($long_lat['lat']) || empty($long_lat['long'])){
			$_SESSION['openid'] && $long_lat = D('User_long_lat')->field('long,lat')->where(array('open_id' => $_SESSION['openid']))->find();
		}
// 		$x = $_COOKIE['around_lat'];
// 		$y = $_COOKIE['around_long'];
// 		$adress = $_COOKIE['around_adress'];
		
		if(empty($long_lat['lat']) || empty($long_lat['long'])){
			redirect(U('Group/around_adress'));
		}
		
// 		if ($_SESSION['openid'] && ($long_lat = D('User_long_lat')->field('long,lat')->where(array('open_id' => $_SESSION['openid']))->find())) {
// 			$long_lat['lat'] = 31.841217;
// 			$long_lat['long'] = 117.207008;
			$this->assign('lat_long', $long_lat['lat'] . ',' . $long_lat['long']);
			$around_range = $this->config['group_around_range'];
			$stores = D("Merchant_store")->field("`store_id`,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$long_lat['lat']}*PI()/180-`lat`*PI()/180)/2),2)+COS({$long_lat['lat']}*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$long_lat['long']}*PI()/180-`long`*PI()/180)/2),2)))*1000) AS juli")->where("`have_group`='1' AND ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$long_lat['lat']}*PI()/180-`lat`*PI()/180)/2),2)+COS({$long_lat['lat']}*PI()/180)*COS(`lat`*PI()/180)*POW(SIN(({$long_lat['long']}*PI()/180-`long`*PI()/180)/2),2)))*1000) < '$around_range'")->select();
			$store_ids = array();
			foreach ($stores as $store){
				$store_ids[] = $store['store_id'];
				$store_around_range[$store['store_id']] = $store['juli'];
			}
			$groupids = array();
			if ($store_ids) {
				$gslist = D('Group_store')->field('`group_id`,`store_id`')->where(array('store_id' => array('in', $store_ids)))->select();
				foreach ($gslist as $gs){
					$groupids[] = $gs['group_id'];
					$group_around_range[$gs['group_id']] = $store_around_range[$gs['store_id']];
				}
			}
			$this->assign('group_around_range',$group_around_range);
// 			$this->assign('adress', $adress);
			
			//得到附近的团购列表
			$groupids && $group_return = D('Group')->get_group_list_by_group_ids($groupids,'', true);
			$this->assign($group_return);
// 		}

		$this->display();
	}
	public function around_adress(){
		if(!empty($_GET['long']) && !empty($_GET['lat'])){
			$map_center = 'new BMap.Point('.$_GET['long'].','.$_GET['lat'].')';
		}else{
			import('ORG.Net.IpLocation');
			$IpLocation = new IpLocation();
			$last_location = $IpLocation->getlocation();
			$map_center = '"'.iconv('GBK','UTF-8',$last_location['country']).'"';
		}
		$this->assign('map_center',$map_center);
		$this->display();
	}
	public function navigation(){
		
		//导购热门广告
		$wap_center_adver = D('Adver')->get_adver_by_key('wap_group_navigation',4);
		$this->assign('wap_center_adver',$wap_center_adver);
		// dump($wap_center_adver);
		//所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_all_category();
		$this->assign('all_category_list',$all_category_list);
		$this->assign('no_gotop',true);
		// dump($all_category_list);
		$this->display();
	}
	//异步加载详情
	public function getContent(){
		$group_id=intval($_POST['id']);
		$now_group = D('Group')->get_group_by_groupId($group_id,'hits-setInc');
		if(!empty($now_group)){
			echo $now_group['content'];
		}else{
			echo "加载失败！";
		}
	}
	//获取用户订单列表
	public function getOrderList(){
		$group_id=intval($_GET['group_id']);
		$mer_id=intval($_GET['mer_id']);

		$where="go.group_id=".$group_id." AND go.mer_id=".$mer_id." AND go.paid=1";

		import('@.ORG.wap_group_page');
		$count_group_order = D('Group_order')->alias("go")->join(C('DB_PREFIX')."user u ON go.uid=u.uid")->where($where)->count();

		$p = new Page($count_group_order,10,'page');

		$group_order_list=D('Group_order')->alias("go")->field("go.price,go.pay_time as last_time,u.nickname,u.avatar,go.num")->join(C('DB_PREFIX')."user u ON go.uid=u.uid")->where($where)->limit($p->firstRow.','.$p->listRows)->order("last_time DESC")->select();
		$total = ceil($count_group_order/10);
		$this->assign("group_order_list_totalpage",$total);
		if(!empty($group_order_list)){
			foreach($group_order_list as $key=>$val){
				//转换时间
				$group_order_list[$key]['last_time']=date("Y-m-d H:m:s",$val['last_time']);
				//如果存在头像则返回完整地址
				if(!empty($val['avatar'])){
					if(!strstr($val['avatar'],"http://")){
						$avatar_image_class=new avatar_image();
						$res=$avatar_image_class->get_image_by_path($val['avatar'],C('config.site_url'));
						$group_order_list[$key]['avatar']=$res['image'];
					}
				}
			}
			//判断上一页
			if($p->nowPage==1){
				$pre_page=1;
			}else{
				$pre_page=($p->nowPage-1);
			}
			//判断最后一页如果是当前页则下一页也为当前页
			if($p->nowPage==$total){
				$next_page=$total;
			}else{
				$next_page=($p->nowPage+1);
			}
			$data=array(
				"pre_page"=>$pre_page,
				"next_page"=>$next_page,
				"now_page"=>$p->nowPage,
				"total_page"=>$total,
				"group_order_list"=>$group_order_list
				);
			$this->success($data,"",true);
		}else{
			$this->error("未获取到数据...","",true);
		}
	}

	//获取用户订单列表
	public function getOrderListDemo(){
		$group_id=intval($_GET['group_id']);
		$mer_id=intval($_GET['mer_id']);
		$get_page=intval($_GET['page']);

		$where="go.group_id=".$group_id." AND go.mer_id=".$mer_id." AND go.paid=1 AND go.status<3";

		import('@.ORG.wap_group_page');
		$count_group_order = D('Group_order')->alias("go")->join(C('DB_PREFIX')."user u ON go.uid=u.uid")->where($where)->count();
		if($count_group_order==0){
			$this->error("未获取到数据...","",true);
		}
		$p = new Page($count_group_order,10,'page');

		$total = ceil($count_group_order/10);
		$this->assign("group_order_list_totalpage",$total);
		if($get_page==($total+1)){
			$group_order_list="";
			
			$next_page=($p->nowPage+1);
			
			$data=array(
					"next_page"=>$next_page,
					"list_row"=>$p->listRows,
					"group_order_list"=>$group_order_list
			);
			$this->success($data,"",true);
		}else{
			$group_order_list=D('Group_order')->alias("go")->field("go.price,go.pay_time as last_time,u.nickname,u.avatar,go.num,go.is_lottery_order,go.order_id as order_id")->join(C('DB_PREFIX')."user u ON go.uid=u.uid")->where($where)->order("last_time DESC")->limit($p->firstRow.','.$p->listRows)->select();
			if(!empty($group_order_list)){
				foreach($group_order_list as $key=>$val){
					//转换时间
					$group_order_list[$key]['last_time']=date("Y-m-d H:m:s",$val['last_time']);
					//如果存在头像则返回完整地址
					if(!empty($val['avatar'])){
						if(!strstr($val['avatar'],"http://")){
							$avatar_image_class=new avatar_image();
							$res=$avatar_image_class->get_image_by_path($val['avatar'],C('config.site_url'));
							$group_order_list[$key]['avatar']=$res['image'];
						}
					}
				}
				
				$next_page=$p->nowPage+1;
				
				$data=array(
						"next_page"=>$next_page,
						"list_row"=>$p->listRows,
						"group_order_list"=>$group_order_list
				);
				$this->success($data,"",true);
			}else{
				$this->error("未获取到数据...","",true);
			}
		}
	}

	public function detailDemo()
	{
		$now_group = D('Group')->get_group_by_groupId($_GET['group_id'], 'hits-setInc');
		if (empty($now_group)) {
			$this->error_tips('当前' . $this->config['group_alias_name'] . '不存在！');
		}
		if ($now_group['cue']) {
			$now_group['cue_arr'] = unserialize($now_group['cue']);
		}
		if (!empty($now_group['pic_info'])) {
			$merchant_image_class = new merchant_image();
			$now_group['merchant_pic'] = $merchant_image_class->get_allImage_by_path($now_group['pic_info']);
		}
		//判断是否微信浏览器，
		$long_lat = D('User_long_lat')->getLocation($_SESSION['openid']);
		if ($long_lat) {
			$rangeSort = array();
			foreach ($now_group['store_list'] as &$storeValue) {
				$storeValue['Srange'] = getDistance($long_lat['lat'], $long_lat['long'], $storeValue['lat'], $storeValue['long']);
				$storeValue['range'] = getRange($storeValue['Srange'], false);
				$rangeSort[] = $storeValue['Srange'];
			}
			array_multisort($rangeSort, SORT_ASC, $now_group['store_list']);
			$this->assign('long_lat', $long_lat);
		}

		if (!empty($this->user_session)) {
			$database_user_collect = D('User_collect');
			$condition_user_collect['type'] = 'group_detail';
			$condition_user_collect['id'] = $now_group['group_id'];
			$condition_user_collect['uid'] = $this->user_session['uid'];
			if ($database_user_collect->where($condition_user_collect)->find()) {
				$now_group['is_collect'] = true;
			}
		}
		$this->assign('now_group', $now_group);

		if ($now_group['reply_count']) {
			$reply_list = D('Reply')->get_reply_list($now_group['group_id'], 0, count($now_group['store_list']), 3);
			$this->assign('reply_list', $reply_list);
		}

		$merchant_group_list = D('Group')->get_grouplist_by_MerchantId($now_group['mer_id'], 3, true, $now_group['group_id']);
		$this->assign('merchant_group_list', $merchant_group_list);

		//分类下其他团购
		$category_group_list = D('Group')->get_grouplist_by_catId($now_group['cat_id'], $now_group['cat_fid'], 3, true);
		foreach ($category_group_list as $key => $value) {
			if ($value['group_id'] == $now_group['group_id']) {
				unset($category_group_list[$key]);
			}
		}
		$this->assign('category_group_list', $category_group_list);

		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($now_group['mer_id'], array('group_hits' => 1));

		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $now_group['mer_id'], 'biz_id' => $now_group['group_id'], 'keyword' => strval($_GET['keywords'])));


		if ($services = D('Customer_service')->where(array('mer_id' => $now_group['mer_id']))->select()) {
			$key = $this->get_encrypt_key(array('app_id' => $this->config['im_appid'], 'openid' => $_SESSION['openid']), $this->config['im_appkey']);
			$kf_url = 'http://im-link.winworlds.cn/?app_id=' . $this->config['im_appid'] . '&openid=' . $_SESSION['openid'] . '&key=' . $key . '#serviceList_' . $now_group['mer_id'];
			$this->assign('kf_url', $kf_url);
		}

		$this->display();
	}
	
		public function  qrcode(){
				$nickname=$_SESSION['user']['nickname'];
				$avators=$_SESSION['user']['avatar'];
		$this->assign("s_title",$_GET['s_title']);
		$this->assign("price",$_GET['price']);
		$this->assign("title",$_GET['title']);
		$this->assign("groupid",$_GET['groupid']);
		$this->assign('shareid',$_GET['shareid']);
			$this->assign('merchantinfo',$nickname);
				if(empty($avators)){
					$this->assign('avators','http://www.xiaonongding.com/upload/avatar/000/002/595/573c2bf6dd797.png');

		}else{
			if($this->startWith($avators,'http')){
              $this->assign('avators',$avators);

			}else{
				$this->assign('avators','http://www.xiaonongding.com/upload/avatar/'.str_replace(',','/',$avators));
			}
		}
		$this->assign('merchantimage',$_GET['images']);
		$this->display();
	}

	public function qrpng(){
		$shareid=$_GET["shareid"];
		$groupid=$_GET["groupid"];

		import('@.ORG.phpqrcode');
		QRcode::png('http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id='.$groupid.'&share_distribution_id='.$shareid);

	}
		//第一个是原串,第二个是 部份串
	function startWith($str, $needle) {

		return strpos($str, $needle) === 0;

	}
}
	
?>