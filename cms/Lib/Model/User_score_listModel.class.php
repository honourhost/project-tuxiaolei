<?php
class User_score_listModel extends Model{
	/*增加记录行数*/
	public function add_row($uid,$type,$score,$msg,$record_ip = true){
		$data_user_score_list['uid'] = $uid;
		$data_user_score_list['type'] = $type;
		$data_user_score_list['score'] = $score;
		$data_user_score_list['desc'] = $msg;
		$data_user_score_list['time'] = $_SERVER['REQUEST_TIME'];
		if($record_ip){
			$data_user_score_list['ip'] = get_client_ip(1);
		}
		if($this->data($data_user_score_list)->add()){
			return true;
		}else{
			return false;
		}
	}
	/*获取列表*/
	public function get_list($uid){
		$condition_user_score_list['uid'] = $uid;
		
		import('@.ORG.user_page');
		$count = $this->where($condition_user_score_list)->count();
		$p = new Page($count,10);
		
		$return['score_list'] = $this->field(true)->where($condition_user_score_list)->order('`time` DESC')->limit($p->firstRow.',10')->select();
		$return['pagebar'] = $p->show();
		return $return;
	}

	/*获取手机用户积分列表*/
	public function get_Mobile_list($uid){
		$condition_user_score_list['uid'] = $uid;

		import('@.ORG.page');
		$count = $this->where($condition_user_score_list)->count();

		//加入页码最大限制，超过最大值返回空
        $req_page=$_GET['p'];
        $max_page=ceil($count/15);
        if($req_page>$max_page){
                return "";
        }
		$p = new Page($count,15,"p");

		$return = $this->field(true)->where($condition_user_score_list)->order('`time` DESC')->limit($p->firstRow,$p->listRows)->select();
		return $return;
	}
}
?>