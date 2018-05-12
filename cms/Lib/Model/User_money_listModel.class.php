<?php
class User_money_listModel extends Model{
	/*增加记录行数*/
	public function add_row($uid,$type,$money,$msg,$record_ip = true){
		$data_user_money_list['uid'] = $uid;
		$data_user_money_list['type'] = $type;
		$data_user_money_list['money'] = $money;
		$data_user_money_list['desc'] = $msg;
		$data_user_money_list['time'] = $_SERVER['REQUEST_TIME'];
		if($record_ip){
			$data_user_money_list['ip'] = get_client_ip(1);
		}
		if($this->data($data_user_money_list)->add()){
			return true;
		}else{
			return false;
		}
	}
	/*获取列表*/
	public function get_list($uid){
		$condition_user_money_list['uid'] = $uid;
        $condition_user_money_list['desc'] = array('like','%佣金%');
        $condition_user_money_list['time'] = array('gt',strtotime("2017/08/01 00:00:00"));
		
		import('@.ORG.user_page');
	//	$count = $this->where("uid = ".$uid." AND desc LIKE '%佣金%' AND  time > ".strtotime("2017/08/01 00:00:00"))->count();
        $count = $this->where($condition_user_money_list)->count();
		//echo D()->getLastSql();die;
		$p = new Page($count,10);
		$req_page=$_GET['page'];
        if($req_page>($p->totalPage)){
                return "";
        }
		//$return['money_list'] = $this->field(true)->where("uid = ".$uid." AND desc LIKE '%佣金%' AND  time > ".strtotime("2017/08/01 00:00:00"))->order('`time` DESC')->limit($p->firstRow.',10')->select();
        $return['money_list'] = $this->field(true)->where($condition_user_money_list)->order('`time` DESC')->limit($p->firstRow.',10')->select();
        $return['pagebar'] = $p->show();
		return $return;
	}
}
?>