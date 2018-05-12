<?php

/*
 * 用户中心
 *
 * @  Writers    yanleilei
 * @  BuildTime  2015/8/18 18:25
 * 
 */

class DeliverAction extends BaseAction {
	protected $deliver_user, $deliver_store, $deliver_location, $deliver_supply;
	
	protected function _initialize() {
		parent::_initialize();
		$this->deliver_user = D("Deliver_user");
		$this->deliver_store = D("Deliver_store");
		$this->deliver_location = D("Deliver_location");
		$this->deliver_supply = D("Deliver_supply");
	}
	/**
	 * 配送员列表
	 */
    public function user() {
        $condition_user['mer_id'] = $this->merchant_session['mer_id'];
        $condition_user['group'] = 2;
        $count_user = $this->deliver_user->where($condition_user)->count();
        import('@.ORG.system_page');
        $p = new Page($count_user, 15);
        $user_list = $this->deliver_user->field(true)->where($condition_user)->order('`uid` DESC')->limit($p->firstRow . ',' . $p->listRows)->select();
        
        $storeInfoNew = array();
        if(count($user_list)>0){
        	foreach ($user_list as $uinfo){
        		$store_id[$uinfo['store_id']] = $uinfo['store_id'];
        	}
        	$store_ids = join(',', $store_id);
        	$storeInfos = D('merchant_store')->field('name,store_id')->where(array('store_id'=>array('in',$store_ids)))->select();
        	foreach ($storeInfos as $storeOne){
        		$storeInfoNew[$storeOne['store_id']] = $storeOne;
        	}
        }
 
        $this->assign('storeInfoNew',$storeInfoNew);
        $this->assign('user_list', $user_list);
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->display();
    }
    
    /**
     * 配送员添加
     */
    public function user_add() {
    	$mer_id = $this->merchant_session['mer_id'];
    	if($_POST){
    		$column['name'] = $_POST['name'];
    		$column['phone'] = $_POST['phone'];
    		$column['pwd'] = $_POST['pwd'];
    		$column['mer_id'] = $mer_id;
    		$column['store_id'] = $_POST['store_id'];
    		$column['city_id'] = $_POST['city_id'];
    		$column['province_id'] = $_POST['province_id'];
    		$column['circle_id'] = $_POST['circle_id'];
    		$column['area_id'] = $_POST['area_id'];
    		$column['site'] = $_POST['adress'];
    		$long_lat = explode(',',$_POST['long_lat']);
    		$column['lng'] = $long_lat[0];
    		$column['lat'] = $long_lat[1];
    		$column['create_time'] = $_SERVER['REQUEST_TIME'];
    		$column['status'] = intval($_POST['status']);
    		$column['last_time'] = $_SERVER['REQUEST_TIME'];
    		$column['group'] = 2;
    		$column['range'] = intval($_POST['range']);
    		
    		$id = D('deliver_user')->data($column)->add();
    		
    		if(!$id){
    			$this->error('保存失败，请重试');
    		}
    		$this->success('保存成功');
    	}else{
    		// 该商家下的所有外卖店铺
    		$merstore['mer_id'] = $mer_id;
    		$merstore['have_waimai'] = 1;
    		$waimai_store = D('merchant_store')->where($merstore)->order('sort DESC')->select();
    		$this->assign('waimai_store',$waimai_store);
    	}
    	
    	$this->display();
    }
    
    /**
     * 配送员修改
     */
    public function user_edit() {
    	$mer_id = $this->merchant_session['mer_id'];
    	if($_POST){
    		$uid = intval($_POST['uid']);
    		$column['name'] = $_POST['name'];
    		$column['phone'] = $_POST['phone'];
    		$column['store_id'] = $_POST['store_id'];
    		if($_POST['pwd']){
    			$column['pwd'] = md5($_POST['pwd']);
    		}
    		$column['city_id'] = $_POST['city_id'];
    		$column['province_id'] = $_POST['province_id'];
    		$column['circle_id'] = $_POST['circle_id'];
    		$column['area_id'] = $_POST['area_id'];
    		$column['site'] = $_POST['adress'];
    		$long_lat = explode(',',$_POST['long_lat']);
    		$column['lng'] = $long_lat[0];
    		$column['lat'] = $long_lat[1];
    		$column['status'] = intval($_POST['status']);
    		$column['range'] = intval($_POST['range']);
    		$column['last_time'] = $_SERVER['REQUEST_TIME'];
    		if(D('deliver_user')->where(array('uid'=>$uid,'mer_id'=>$mer_id))->data($column)->save()){
    			$this->success('修改成功！');
    		}else{
    			$this->error('修改失败！请检查内容是否有过修改（必须修改）后重试~');
    		}
    	}else{
    		$uid = $_GET['uid'];
    		if(!$uid){
    			$this->error('非法操作');
    		}
    		$deliver = D('deliver_user')->where(array('uid'=>$uid,'mer_id'=>$mer_id))->find();
    		if(!$deliver){
    			$this->error('非法操作');
    		}
    		$this->assign('now_user',$deliver);
    		
    		$merstore['mer_id'] = $mer_id;
    		$merstore['have_waimai'] = 1;
    		$waimai_store = D('merchant_store')->where($merstore)->order('sort DESC')->select();
    		$this->assign('waimai_store',$waimai_store);
    	}
    	$this->display();
    }
    
    public function user_del(){
    	$uid = $_GET['uid'];
    	if(!$uid){
    		$this->error('非法操作');
    	}
    	$mer_id = $this->merchant_session['mer_id'];
    	$condition_user['mer_id'] = $mer_id;
    	$condition_user['uid'] = $uid;
    	$count_user = $this->deliver_user->where($condition_user)->find();
    	if(!$count_user){
    		$this->error('非法操作');
    	}
    	
    	$result = $this->deliver_user->where($condition_user)->save(array('status'=>0));
    	if(!$result){
    		$this->error('删除失败，请稍后重试');
    	}
    	$this->success('操作成功');
    }
}