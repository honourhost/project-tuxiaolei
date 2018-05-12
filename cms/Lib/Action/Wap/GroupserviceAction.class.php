<?php

//团购 AJAX服务
class GroupserviceAction extends BaseAction{
	public function indexRecommendList(){
		$this->header_json();
		$new_group_list = D('Group')->new_get_group_list('index_tui',8,true);
		$user_long_lat = D('User_long_lat')->getLocation($_SESSION['openid']);
		//判断是否微信浏览器，
		if($new_group_list && $user_long_lat){
			$group_store_database = D('Group_store');
			$rangeSort = array();
			foreach($new_group_list as &$storeGroupValue){
				$tmpStoreList = $group_store_database->get_storelist_by_groupId($storeGroupValue['group_id']);
				if($tmpStoreList){
					foreach($tmpStoreList as &$tmpStore){
						$tmpStore['Srange'] = getDistance($user_long_lat['lat'],$user_long_lat['long'],$tmpStore['lat'],$tmpStore['long']);
						$tmpStore['range'] = getRange($tmpStore['Srange'],false);
						$rangeSort[] = $tmpStore['Srange'];
					}
					array_multisort($rangeSort, SORT_ASC, $tmpStoreList);
					$storeGroupValue['store_list'] = $tmpStoreList;	
					$storeGroupValue['range'] = $tmpStoreList[0]['range'];
				}
			}
		}
		echo json_encode($new_group_list);
	}
	//得到搜索的团购列表
	public function search(){
		$this->header_json();

		
		$group_return = D('Group')->get_group_list_by_keywords($_GET['w'],$_GET['sort'],true);
		echo json_encode($group_return);
	}
}

?>