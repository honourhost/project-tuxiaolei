<?php
class GroupBuyModel extends Model{

	//查询正在进行的拼团
	public function getLists($page_row,$order="create_time DESC"){
		$condition_where['gb.status']=0;
		import('@.ORG.wap_group_page');

		$count_buy_group = $this->alias("gb")->where($condition_where)->count();
		if(!empty($page_row)){
		$p = new Page($count_buy_group,$page_row,C('config.group_page_val'));
		}else{
		$p = new Page($count_buy_group,C('config.group_page_row'),C('config.group_page_val'));
		}
		$group_buy_list = $this->alias("gb")->field("gb.*,g.price,g.pic,g.name as group_name,g.s_name,g.related_id")->join(C("DB_PREFIX")."group as g ON gb.group_id=g.group_id")->where($condition_where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();
		$return['pagebar'] = $p->show();

		if($group_buy_list){
			$group_image_class = new group_image();
			foreach($group_buy_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$group_buy_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'m');
				$group_buy_list[$k]['price'] = floatval($v['price']);
			}
		}
		$return['group_buy_list'] = $group_buy_list;   
		$return['group_count'] = $count_buy_group;
		$return['totalPage'] = ceil($count_buy_group/C('config.group_page_row'));
		return $return;
	}


	//查询正在进行的拼团
	public function getListsByGroupId($group_id,$page_row,$order="create_time DESC"){
		$condition_where['gb.status']=0;
		import('@.ORG.wap_group_page');
		$condition_where['gb.group_id']=$group_id;
		$count_buy_group = $this->alias("gb")->where($condition_where)->count();
		if(!empty($page_row)){
		$p = new Page($count_buy_group,$page_row,C('config.group_page_val'));
		}else{
		$p = new Page($count_buy_group,C('config.group_page_row'),C('config.group_page_val'));
		}
		$group_buy_list = $this->alias("gb")->field("gb.*,g.price,g.pic,g.name as group_name,g.s_name,g.related_id")->join("LEFT JOIN ".C("DB_PREFIX")."group as g ON gb.group_id=g.group_id")->where($condition_where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();
		$return['pagebar'] = $p->show();

		if($group_buy_list){
			$group_image_class = new group_image();
			foreach($group_buy_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$group_buy_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'m');
				$group_buy_list[$k]['price'] = floatval($v['price']);
			}
		}
		$return['group_buy_list'] = $group_buy_list;   
		$return['group_count'] = $count_buy_group;
		$return['totalPage'] = ceil($count_buy_group/C('config.group_page_row'));
		return $return;
	}

	//查询正在进行的拼团
	public function getNewLists($page_row,$order="create_time DESC"){
		$condition_where['gb.status']=0;

		$groupbuylists=$this->distinct("true")->field("group_id,sun_id")->order("create_time")->limit(4)->group('group_id')->select();
	
			
		$wherecond=array();
		if(!empty($groupbuylists)){
		foreach($groupbuylists as $k=>$val){
			$wherecond[]=$val['sun_id'];
		}
		}
		$condition_where['gb.sun_id']=array("IN",implode(",",$wherecond));
		$condition_where['gb.status']=0;
		//$group_buy_list = $this->alias("gb")->field("gb.*,g.price,g.pic,g.name as group_name,g.s_name,g.related_id")->join(C("DB_PREFIX")."group as g ON gb.group_id=g.group_id")->where($condition_where)->limit(4)->select();
		
	    $group_buy_list = $this->alias("gb")->field("gb.*,g.price,g.pic,g.name as group_name,g.s_name,g.related_id")->join(C("DB_PREFIX")."group as g ON gb.group_id=g.group_id")->order('gb.group_id DESC')->limit(3)->select();

		if($group_buy_list){
			$group_image_class = new group_image();
			foreach($group_buy_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$group_buy_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'m');
				$group_buy_list[$k]['price'] = floatval($v['price']);
			}
		}
	//	if(session('user')['uid']==753){
		//		echo json_encode($group_buy_list);
	//}
		$return['group_buy_list'] = $group_buy_list;   
		return $return;
	}
}