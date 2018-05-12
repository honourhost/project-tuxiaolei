<?php
/**
 * 
 * 预约服务
 * @author yww
 *
 */
class AppointAction extends BaseAction{
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
		
		//判断排序信息   默认排序就是按照手动设置项排序
		$sort_id = !empty($_GET['sort_id']) ? $_GET['sort_id'] : 'juli';

		$long_lat = array('lat' => 0, 'long' => 0);
		$_SESSION['openid'] && $long_lat = D('User_long_lat')->field('long,lat')->where(array('open_id' => $_SESSION['openid']))->find();
		if (empty($long_lat['long']) || empty($long_lat['lat'])) {
			$sort_id = $sort_id == 'juli' ? 'defaults' : $sort_id;
			$sort_array = array(
					array('sort_id'=>'defaults','sort_value'=>'默认排序'),
					array('sort_id'=>'appointNum','sort_value'=>'按预约数'),
					array('sort_id'=>'start','sort_value'=>'最新发布'),
					array('sort_id'=>'price','sort_value'=>'价格最低'),
					array('sort_id'=>'priceDesc','sort_value'=>'价格最高'),
			);
		} else {
			import('@.ORG.longlat');
			$longlat_class = new longlat();
			$location2 = $longlat_class->gpsToBaidu($long_lat['lat'], $long_lat['long']);//转换腾讯坐标到百度坐标
			$long_lat['lat'] = $location2['lat'];
			$long_lat['long'] = $location2['lng'];
			$sort_array = array(
					array('sort_id'=>'juli','sort_value'=>'离我最近'),
					array('sort_id'=>'appointNum','sort_value'=>'按预约数'),
					array('sort_id'=>'start','sort_value'=>'最新发布'),
					array('sort_id'=>'price','sort_value'=>'价格最低'),
					array('sort_id'=>'priceDesc','sort_value'=>'价格最高'),
			);
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
		$all_category_list = D('Appoint_category')->get_all_category();
		$this->assign('all_category_list',$all_category_list);
		
		//根据分类信息获取分类
		if(!empty($cat_url)){
			$now_category = D('Appoint_category')->get_category_by_catUrl($cat_url);
			if(empty($now_category)){
				$this->error_tips('此分类不存在！');
			}
			$this->assign('now_category',$now_category);
			
			if(!empty($now_category['cat_fid'])){
				$f_category = D('Appoint_category')->get_category_by_id($now_category['cat_fid']);
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
		}else{
			//所有区域
		}
		$all_area_list = D('Area')->get_all_area_list();
		$this->assign('all_area_list',$all_area_list);
		
		$this->assign(D('Appoint')->wap_get_appoint_list_by_catid($get_grouplist_catid,$get_grouplist_catfid,$area_id,$sort_id, $long_lat['lat'], $long_lat['long'], $circle_id));
		$this->display();
	}
	
	// 预约详情
	public function detail(){
		if(empty($_GET['appoint_id'])){
			$this->error_tips('当前预约项不存在！');
		}
		$now_group = D('Appoint')->get_appoint_by_appointId($_GET['appoint_id'],'hits-setInc');
		if(empty($now_group)){
			$this->error_tips('当前预约项不存在！');
		}
		
		$this->assign('now_group',$now_group);
		if(!empty($_GET['store_id'])){
			$this->assign('store_id',$_GET['store_id']);
		}
		$merchant_group_list = D('Appoint')->get_appointlist_by_MerchantId($now_group['mer_id'],3,true,$now_group['appoint_id']);
		$this->assign('merchant_group_list',$merchant_group_list);
		$product_condition['appoint_id'] = $_GET['appoint_id'];
		$appoint_product_list = D('Appoint_product')->field(true)->where($product_condition)->select();
		$this->assign('appoint_product_list', $appoint_product_list);
		$this->display();
	}
	
	// 店铺详情
	public function shop(){
	    if(empty($_GET['store_id'])){
			$this->error_tips('当前店铺不存在！');
		}
		$now_store = D('Merchant_store')->get_store_by_storeId($_GET['store_id']);
		if(empty($now_store)){
			$this->error_tips('该店铺不存在！');
		}
		
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
		$store_group_list = D('Appoint')->get_store_appoint_list($now_store['store_id'],5,true);
		$this->assign('store_group_list',$store_group_list);
		$this->display();
	}
	
	// 预约
	public function order(){
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！',U('Login/index'));
		}
		$now_user = D('User')->get_user($this->user_session['uid']);
		if(empty($this->user_session['phone']) && !empty($now_user['phone'])){
			$_SESSION['user']['phone'] = $this->user_session['phone'] = $now_user['phone'];
		}
		$this->assign('now_user',$now_user);
		if(empty($_GET['appoint_id'])){
			$this->error_tips('当前服务不存在！');
		}
		
		$appoint_id = $_GET['appoint_id'];
		$now_group = D('Appoint')->get_appoint_by_appointId($appoint_id,'hits-setInc');
		if(empty($now_group)){
			$this->error_tips('当前预约项不存在！');
		}
		
		if($now_group['start_time'] > $_SERVER['REQUEST_TIME']){
			$this->error_tips('此单还未开始！');
		}
		// 产品列表
		$appointProduct = D('Appoint_product')->get_productlist_by_appointId($appoint_id);
		$this->assign('appoint_product',$appointProduct);
		
		$now_group['store_list'] = D('Appoint_store')->get_storelist_by_appointId($now_group['appoint_id']);
		
		$_SESSION['openid'] && $long_lat = D('User_long_lat')->field('long,lat')->where(array('open_id' => $_SESSION['user']['openid']))->find();
		if($long_lat){
			foreach($now_group['store_list'] as &$value){
				$value['range'] = getDistance($value['lat'],$value['long'],$long_lat['lat'],$long_lat['long']);
				$value['range_txt'] = getRange($value['range']);
				$rangeSort[] = $value['range'];
				array_multisort($rangeSort, SORT_ASC, $now_group['store_list']);
			}
			$this->assign('long_lat',$long_lat);
		}else{
			$now_city = D('Area')->get_area_by_areaId($this->config['now_city']);
			$this->assign('city_name',$now_city['area_name']);
		}
		// 预约开始时间 结束时间
		$office_time = unserialize($now_group['office_time']);
		
		// 如果设置的营业时间为0点到0点则默认是24小时营业
		if(count($office_time)<1){
			$office_time[0]['open'] = '00:00';
			$office_time[0]['close'] = '24:00';
		}else{
			foreach ($office_time as $i=>$time){
				if($time['open'] == '00:00' && $time['close'] == '00:00'){
					unset($office_time[$i]);
				}
			}
		}
		// 发起预约时候的起始时间 还有提前多长时间可预约
		$currentTime = date('H');
		$timeArray = $timeArray1 = $dateArray = array();
		
		foreach ($office_time as $i=>$time){
			$beforeTime = $now_group['before_time']>0?($now_group['before_time'])/60:0;
			$timeArray[$time['open']]['time']    = $timeArray1[$time['open']]['time'] = $time['open'] ;
			$timeArray[$time['open']]['order']   = $time['open']>($currentTime+$beforeTime)?'yes':'no';
			$timeArray1[$time['open']]['order']  = 'yes';
			$timeArray[$time['close']]['time']   = $timeArray1[$time['close']]['time'] = $time['close'];
			$timeArray[$time['close']]['order']  = $time['close']>($currentTime+$beforeTime)?'yes':'no';
			$timeArray1[$time['close']]['order'] = 'yes';
			
			$startTime = strtotime(date('Y-m-d').' '.$time['open']);
			$endTime   = strtotime(date('Y-m-d').' '.$time['close']);
			$gap = $now_group['time_gap']*60>0?$now_group['time_gap']*60:1800;
			for($time = $startTime;$time<$endTime;$time=$time+$gap){
				$tempTime[date('H:i',$time)]['time'] = date('H:i',$time);
				$tempTime[date('H:i',$time)]['order'] = date('H',$time)>($currentTime+$beforeTime)?'yes':'no';
				$timeArray = array_merge($timeArray,$tempTime);
				
				$tempTime1[date('H:i',$time)]['time'] = date('H:i',$time);
				$tempTime1[date('H:i',$time)]['order'] = 'yes';
				$timeArray1 = array_merge($timeArray1,$tempTime1);
			}
		}
		$startTimeAppoint = $now_group['start_time']>strtotime('now')?$now_group['start_time']:strtotime('now');
		$endTimeAppoint   = $now_group['end_time']>strtotime('+3 day')?strtotime('+3 day'): $now_group['end_time'];

		$dateArray[date('Y-m-d',$startTimeAppoint)] = date('Y-m-d',$startTimeAppoint);
		$dateArray[date('Y-m-d',$endTimeAppoint)] = date('Y-m-d',$endTimeAppoint);
		for($date=$startTimeAppoint;$date<$endTimeAppoint;$date=$date+86400){
			$dateArray[date('Y-m-d',$date)] = date('Y-m-d',$date);	
		}
		ksort($timeArray);ksort($timeArray1);
		foreach ($dateArray as $i=>$date){
			$timeOrder[$date] = $timeArray1;
			if(strtotime($date)<=strtotime(date('Y-m-d'))){	
				$timeOrder[$date] = $timeArray;
			}
		}
		ksort($timeOrder);
		foreach($timeOrder as $i=>$tem){
			foreach ($tem as $key=>$temval)
					if(strtotime($i.' '.$key)<strtotime('now') && ($temval['order'] == 'yes')){
						$timeOrder[$i][$key]['order'] = 'no';
					}
		}
		// 查询可预约时间点 
		$appoint_num = D('Appoint_order')->get_appoint_num($now_group['appoint_id'],$now_group['appoint_people']);
		if(count($appoint_num)>0){
			foreach ($appoint_num as $val){				
				$key = date('Y-m-d',strtotime($val['appoint_date']));
				if($timeOrder[$key][$val['appoint_time']]['order'] != 'no'){
					if(isset($timeOrder[$key]) && $timeOrder[$key]['time'] == $val['appoint_num']){
						$timeOrder[$key][$val['appoint_time']]['order'] = 'all';
					}
				}
			}
		}
		
		// 自定义表单项
		$category = D('Appoint_category')->get_category_by_id($now_group['cat_id']);
		if(empty($category['cue_field'])){
			$category = D('Appoint_category')->get_category_by_id($category['cat_fid']);
		}
		if($category){
			$cuefield = unserialize($category['cue_field']);
			foreach ($cuefield as $val){
				$sort[] = $val['sort'];
			}
			array_multisort($sort, SORT_DESC, $cuefield);
		}
		$this->assign('formData',$cuefield);
		
		if(IS_POST){
			$now_group['product_id'] = $_POST['service_type'];
			$now_group['cue_field'] = serialize($_POST['custom_field']);
			$now_group['appoint_date'] = $_POST['service_date'];
			$now_group['appoint_time'] = $_POST['service_time'];
			$now_group['store_id'] = $_POST['store_id']?$_POST['store_id']:0;
			$result = D('Appoint_order')->save_post_form($now_group,$this->user_session['uid'],0);		
			if($result['error'] == 1){
				$this->error($result['msg']);
			}
			
			// 如果需要定金
			if(intval($now_group['payment_status']) == 1){
				$href = U('Pay/check',array('order_id'=>$result['order_id'],'type'=>'appoint'));
			}else{
				$resultOrder = D('Appoint_order')->no_pay_after($result['order_id'],$now_group);
				if($resultOrder['error'] == 1){
					$this->error($resultOrder['msg']);
				}
				$href = U('My/appoint_order',array('order_id'=>$result['order_id']));
			}
			$this->success($href);
		}else{
			if($this->user_session['phone']){
				$this->assign('pigcms_phone',substr($this->user_session['phone'],0,3).'****'.substr($this->user_session['phone'],7));
			}else{
				$this->assign('pigcms_phone','您需要绑定手机号码');
			}
			$this->assign('now_group',$now_group);
			$this->assign('timeOrder',$timeOrder);
			$this->display();
		}
	}
	
	// 分店
	public function branch(){
		$now_group = D('Appoint')->get_appoint_by_appointId($_GET['appoint_id'],'hits-setInc');
		if(empty($now_group)){
			$this->error_tips('当前预约项不存在！');
		}
		$this->assign('now_group',$now_group);
		
		$this->display();
	}
	
}
?>