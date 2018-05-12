<?php
class MerchantAction extends BaseAction{
	public function around(){
		$long_lat = D('User_long_lat')->getLocation($_SESSION['openid']);
		$this->assign('long_lat',$long_lat);
		$this->display();
	}
	public function ajaxAround(){
		$this->header_json();
		$list = D('Merchant')->get_merchants_by_long_lat($_POST['lat'], $_POST['lng'],2000);
		echo json_encode($list);
	}
}
?>