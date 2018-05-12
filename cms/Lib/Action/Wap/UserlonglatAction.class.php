<?php
//保存用户的地理位置
class UserlonglatAction extends BaseAction{
	public function report(){
		if(IS_POST){
			//去掉微信浏览器的判断$_SESSION['openid'] && 
			if($_POST['userLong'] && $_POST['userLat']){
				$result=D('User_long_lat')->saveLocation($_SESSION['openid'],$_POST['userLong'],$_POST['userLat']);
				empty($_COOKIE['userLocationHasRecord']) && setcookie('userLocationHasRecord','1',$_SERVER['REQUEST_TIME']+120,'/');
				echo json_encode($result);die;
			}
		}
	}
}
?>