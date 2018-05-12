<?php
class User_long_latModel extends Model{
	/*保存地理位置*/
	public function saveLocation($openid,$long,$lat){
		//现在不在数据库保存位置信息，所以不判断openid了$openid
		if(true){
			import('@.ORG.longlat');
			$longlat_class = new longlat();
			$location2 = $longlat_class->gpsToBaidu($lat, $long);
			$result=file_get_contents("http://api.map.baidu.com/geocoder/v2/?ak=4c1bb2055e24296bbaef36574877b4e2&location=".$location2['lat'].",".$location2['lng']."&output=json&pois=1");
			$arrResult=json_decode($result);
			//获取到市
			$resultObj=$arrResult->result;
			$addressObj=$resultObj->addressComponent;
			$area_name=$addressObj->city;
			//截取到市，然后重新给当前城市信息赋值
			if(!empty($area_name)) {
				$now_area=$this->resetCity($area_name);
			}
			//暂时不保存数据库了
			// if ($this->field(true)->where(array('open_id' => $openid))->find()) {
			// 	$this->where(array('open_id' => $openid))->save(array('long' => $long, 'lat' => $lat, 'dateline' => $_SERVER['REQUEST_TIME']));
			// } else {
			// 	$this->add(array('long' => $long, 'lat' => $lat, 'dateline' => $_SERVER['REQUEST_TIME'], 'open_id' => $openid));
			// }
			if(!empty($now_area)){
				return array('errCode'=>false,'errMsg'=>$now_area['area_name']);
			}
		}else{
			return array('errCode'=>true,'errMsg'=>'没有携带openid');
		}
	}
	/*
	 * 得到地理位置
	 *
	 * 时效120秒
	 *
	 * 存的是 GPS定位，系统使用的是百度地图，进行转换
	 * 
	*/
	public function getLocation($openid,$timeout=120){
		if($openid){
			$user_long_lat = $this->where(array('open_id' => $openid))->find();
			if($user_long_lat && $user_long_lat['long']){
				if($timeout != 0 && $user_long_lat['dateline'] < $_SERVER['REQUEST_TIME'] - $timeout){
					return array();
				}
				import('@.ORG.longlat');
				$longlat_class = new longlat();
				$location2 = $longlat_class->gpsToBaidu($user_long_lat['lat'], $user_long_lat['long']);
				return array('long'=>$location2['lng'],'lat'=>$location2['lat'],'dateline'=>$user_long_lat['dateline']);
			}else{
				return array();
			}
		}else{
			return array();
		}
	}

	/**
	 * 重新给当前定位的城市赋值
	 */
	public function resetCity($area_name){
		$area=D("Area")->where("area_ip_desc like '%".$area_name."%' AND area_type=2 AND is_open=1")->find();
		//判断如果和默认的相同则直接返回
		if($_SESSION['selectcityid']==$area['area_id']){
			return $_SESSION['cityarr'][0];
		}else{
		$_SESSION['selectcityid']=$area['area_id'];
		$condition['area_id'] = $_SESSION['selectcityid'];
		$cityarr = D('Area')->where($condition)->select();    // 把查询条件传入查询方法
		$_SESSION['cityarr']=$cityarr;
		C("config.now_city",$cityarr['0']['area_id']);

		//组建当前城市下县或区的数组
		$condition_area['area_pid'] = $_SESSION['selectcityid'];
		$areayarr = D('Area')->where($condition_area)->select();    //把查询条件传入查询方法
		$_SESSION['areaarr']=$areayarr;

		foreach($_SESSION['areaarr'] as $k=>$v){
			$_SESSION['areaarr'][$k]=$_SESSION['areaarr'][$k]['area_id'];
		}
		return $area;
		}
	}
}
?>