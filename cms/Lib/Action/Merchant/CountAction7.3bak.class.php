<?php
class CountAction extends BaseAction{
	public function index(){
		$condition_merchant_request['mer_id'] = $this->merchant_session['mer_id'];
		
		$today_zero_time = mktime(0,0,0,date('m',$_SERVER['REQUEST_TIME']),date('d',$_SERVER['REQUEST_TIME']), date('Y',$_SERVER['REQUEST_TIME']));
		
		if(empty($_GET['day'])){
			$_GET['day'] = date('d',$_SERVER['REQUEST_TIME']);
		}
		
		if($_GET['day'] < 1){
			$this->error('日期非法！');
		}else if($_GET['day'] > 180){
			$this->error('最长只能查询180天！');
		}
		
		$condition_merchant_request['time'] = array(array('egt',$today_zero_time-(($_GET['day']-1)*86400)),array('elt',$today_zero_time));

		
		$request_list = M('Merchant_request')->field(true)->where($condition_merchant_request)->order('`time` ASC')->select();

		foreach($request_list as $value){
			$tmp_time = date('Ymd',$value['time']);
			$tmp_array[$tmp_time] = $value;
		}
		for($i=1;$i<=$_GET['day'];$i++){
			$tmp_time = date('Ymd',$today_zero_time-(($i-1)*86400));
			if(empty($tmp_array[$tmp_time])){
				$tmp_array[$tmp_time] = array('time'=>$today_zero_time-(($i-1)*86400));
			}
		}
		//基础统计总数
		$StaticAll['follow_num_all']=0;
		$StaticAll['img_num_all']=0;
		$StaticAll['website_hits_all']=0;
		//特卖统计总数
		$StaticAll['group_hits_all']=0;
		$StaticAll['group_buy_money_all']=0;
		$StaticAll['group_buy_count_all']=0;
		//农小店统计总数
		$StaticAll["meal_hits_all"]=0;
		$StaticAll["meal_buy_count_all"]=0;
		$StaticAll['meal_buy_money_all']=0;


		foreach($tmp_array as $key=>$value){
			//基础统计
			$pigcms_list['xAxis_arr'][]  = '"'.date('j',$value['time']).'日"';
			$pigcms_list['follow_arr'][] = '"'.intval($value['follow_num']).'"';
			$pigcms_list['img_arr'][]   = '"'.intval($value['img_num']).'"';
			$pigcms_list['website_hits_arr'][]   = '"'.intval($value['website_hits']).'"';
			//基础总数统计
			$StaticAll['follow_num_all']=$StaticAll['follow_num_all']+intval($value['follow_num']);
			$StaticAll['img_num_all']=$StaticAll['img_num_all']+intval($value['img_num']);
			$StaticAll['website_hits_all']=$StaticAll['website_hits_all']+intval($value['website_hits']);
			//团购统计
			$pigcms_list['group_hits_arr'][] = '"'.intval($value['group_hits']).'"';
			$pigcms_list['group_buy_count_arr'][]   = '"'.intval($value['group_buy_count']).'"';
			$pigcms_list['group_buy_money_arr'][]   = '"'.floatval($value['group_buy_money']).'"';
			//团购总数统计
			$StaticAll['group_hits_all']=$StaticAll['group_hits_all']+intval($value['group_hits']);
			$StaticAll['group_buy_money_all']=$StaticAll['group_buy_money_all']+intval($value['group_buy_count']);
			$StaticAll['group_buy_count_all']=$StaticAll['group_buy_count_all']+floatval($value['group_buy_money']);
			//订餐统计
			$pigcms_list['meal_hits_arr'][] = '"'.intval($value['meal_hits']).'"';
			$pigcms_list['meal_buy_count_arr'][]   = '"'.intval($value['meal_buy_count']).'"';
			$pigcms_list['meal_buy_money_arr'][]   = '"'.floatval($value['meal_buy_money']).'"';
			//订餐总数统计
			$StaticAll["meal_hits_all"]=$StaticAll["meal_hits_all"]+intval($value['meal_hits']);
			$StaticAll["meal_buy_count_all"]=$StaticAll["meal_buy_count_all"]+intval($value['meal_buy_count']);
			$StaticAll['meal_buy_money_all']=$StaticAll["meal_buy_money_all"]+floatval($value['meal_buy_money']);
		}
		//基础统计
		$pigcms_list['xAxis_txt'] = implode(',',$pigcms_list['xAxis_arr']);
		$pigcms_list['follow_txt'] = implode(',',$pigcms_list['follow_arr']);
		$pigcms_list['img_txt'] = implode(',',$pigcms_list['img_arr']);
		$pigcms_list['website_hits_txt'] = implode(',',$pigcms_list['website_hits_arr']);
		//团购统计
		$pigcms_list['group_hits_txt'] = implode(',',$pigcms_list['group_hits_arr']);
		$pigcms_list['group_buy_count_txt'] = implode(',',$pigcms_list['group_buy_count_arr']);
		$pigcms_list['group_buy_money_txt'] = implode(',',$pigcms_list['group_buy_money_arr']);
		//订餐统计
		$pigcms_list['meal_hits_txt'] = implode(',',$pigcms_list['meal_hits_arr']);
		$pigcms_list['meal_buy_count_txt'] = implode(',',$pigcms_list['meal_buy_count_arr']);
		$pigcms_list['meal_buy_money_txt'] = implode(',',$pigcms_list['meal_buy_money_arr']);
		
		$this->assign($pigcms_list);
		krsort($tmp_array);
		$this->assign('StaticAll',$StaticAll);
		$this->assign('request_list',$tmp_array);
		
		$this->display();
	}
	
	public function order()
	{
		$this->assign(D("Meal_order")->get_order_by_mer_id($this->merchant_session['mer_id']));
		$this->display();
	}
	
	public function bill()
	{
		$mer_id = intval($this->merchant_session['mer_id']);
		$percent = '';
		if ($this->merchant_session['percent']) {
			$percent = $this->merchant_session['percent'];
		} elseif ($this->config['platform_get_merchant_percent']) {
			$percent = $this->config['platform_get_merchant_percent'];
		}
		$this->assign('percent', $percent);
		$merchant = D('Merchant')->field(true)->where('mer_id=' . $mer_id)->find();
		$result = D("Meal_order")->get_order_by_mer_id($mer_id);
		$this->assign($result);
		$this->assign('total_percent', $result['total'] * (100 - $percent) * 0.01);
		$this->assign('all_total_percent', ($result['alltotal'] + $result['alltotalfinsh']) * (100 - $percent) * 0.01);
		$this->assign('all_totalfinish_percent', $result['alltotalfinsh'] * (100 - $percent) * 0.01);
		$this->assign('now_merchant', $merchant);
		$this->assign('mer_id', $mer_id);
		$this->display();
	}
	//提现列表
	public function cash_list(){
		$mer_id = intval($this->merchant_session['mer_id']);
		if(empty($mer_id)){
			$this->error("操作出错，没有mer_id参数！");
		}
		$database_cash=D("Bank_cash_info");
		$count_cash = $database_cash->where("mer_id=".$mer_id)->count();
		import('@.ORG.merchant_page');
		$p = new Page($count_cash,15);
		$cash_list = $database_cash->alias("b")->field("b.status as info_status,m.status as record_status,b.*,m.*")->join(C('DB_PREFIX')."merchant_cash_record as m ON b.id=m.cash_info_id")->where("b.mer_id=".$mer_id)->order('b.`create_time` DESC')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('cash_list',$cash_list);

		$all_cash_list = $database_cash->alias("b")->field("b.status as info_status,m.status as record_status,b.*,m.*")->join(C('DB_PREFIX')."merchant_cash_record as m ON b.id=m.cash_info_id")->where(array("b.mer_id"=>$mer_id,"m.status"=>1))->select();
		//start
		//计算总已提现金额
		$allGetCash=0;
		foreach($all_cash_list as $key=>$val){
				$allGetCash += intval($val['cash_num']);
		}
		//计算总可提现金额
		$mode = new Model();

		// $sql = "SELECT sum(balance_pay + payment_money) as price, is_pay_bill FROM " . C('DB_PREFIX') . "meal_order WHERE mer_id={$mer_id} AND paid=1 AND status in (1,2) AND user_confirm=1 AND (pay_type<>'offline' OR balance_pay<>'0.00') GROUP BY is_pay_bill";
		// $sql .= ' UNION ALL ';
		// $sql .= "SELECT sum(balance_pay + payment_money) as price, is_pay_bill FROM " . C('DB_PREFIX') . "group_order WHERE mer_id={$mer_id} AND paid=1 AND status in (1,2) AND user_confirm=1 AND (pay_type<>'offline' OR balance_pay<>'0.00') GROUP BY is_pay_bill";
		$sql = "SELECT sum(morder.balance_pay + morder.payment_money) as price, morder.is_pay_bill,0 as commission FROM ". C('DB_PREFIX') . "meal_order as morder  WHERE morder.mer_id={$mer_id} AND morder.paid=1 AND morder.status in (1,2) AND (morder.pay_type<>'offline' OR morder.balance_pay<>'0.00') GROUP BY morder.is_pay_bill";
		$sql .= ' UNION ALL ';
		$sql .= "SELECT sum(gorder.balance_pay + gorder.payment_money) as price, gorder.is_pay_bill,sum(g.commission) as commission FROM ". C('DB_PREFIX') . "group_order as gorder LEFT JOIN pigcms_group as g ON gorder.group_id=g.group_id WHERE gorder.mer_id={$mer_id} AND gorder.paid=1 AND gorder.status in (1,2) AND (gorder.pay_type<>'offline' OR gorder.balance_pay<>'0.00') GROUP BY gorder.is_pay_bill";
		$res = $mode->query($sql);
		$alltotalfinsh = 0;
		foreach ($res as $r) {
			$r['is_pay_bill'] && $alltotalfinsh += $r['price'];//已对账的总额
			 $alltotalfinsh=$alltotalfinsh-$r['commission'];//除去佣金的已对帐总额
		}
		$percent = '';
		if ($this->merchant_session['percent']) {
			$percent = $this->merchant_session['percent'];
		} elseif ($this->config['platform_get_merchant_percent']) {
			$percent = $this->config['platform_get_merchant_percent'];
		}
		$this->assign('all_totalfinish_percent', $alltotalfinsh * (100 - $percent) * 0.01);
		//end


		$this->assign("allGetCash",$allGetCash);
		$pagebar = $p->show();
		$this->assign('pagebar',$pagebar);
		$this->display();
	}
	//申请提现
	public function getCash(){
		if(!empty($_POST)){
			$data['mer_id']=$this->merchant_session['mer_id'];
            $database_cash=D("Bank_cash_info");
            $count_cash = $database_cash->where(array("mer_id"=>$data['mer_id'],"status"=>0))->find();
            if(!empty($count_cash)){
                $this->error("您有正在提现的款项，请耐心等待");
            }
			if(empty($_POST['merchant_real_name'])){
				$this->error("请输入真实姓名");
			}
			$data['merchant_real_name']=$_POST['merchant_real_name'];
			if(empty($_POST['bank_name'])){
				$this->error("请输入银行支行名称");
			}
			$data['bank_name']=$_POST['bank_name'];
			if(!preg_match("/^0{0,1}(13[0-9]|15[0-9]|153|156|18[0-9])[0-9]{8}$/",$_POST['merchant_real_telephone'])){
				$this->error("请输入正确的电话号码！");
			}
			$data['merchant_real_telephone']=$_POST['merchant_real_telephone'];
			if(!preg_match("/(([0-9]{16})|([0-9]{19}))$/",$_POST['bank_card'])){
				$this->error("请输入正确的银行卡号！");
			}
			if(empty($_POST['cash_num'])){
				$this->error("请输入正确的金额");
			}
			if($_POST['cash_num']<50){
				$this->error("提现金额不能小于50");
			}
			//判断是否可用提现大于当前请求提现，否则禁止提交申请
			//先查出所有已提现金额
			$database_cash=D("Bank_cash_info");
			$mer_id=$this->merchant_session['mer_id'];
			$all_cash_list = $database_cash->alias("b")->field("b.status as info_status,m.status as record_status,b.*,m.*")->join(C('DB_PREFIX')."merchant_cash_record as m ON b.id=m.cash_info_id")->where(array("b.mer_id"=>$mer_id,"m.status"=>1))->select();
			//start
			//计算总已提现金额
			$allGetCash=0;
			foreach($all_cash_list as $key=>$val){
				$allGetCash += intval($val['cash_num']);
			}
			//计算总可提现金额
			$mode = new Model();

			// $sql = "SELECT sum(balance_pay + payment_money) as price, is_pay_bill FROM " . C('DB_PREFIX') . "meal_order WHERE mer_id={$mer_id} AND paid=1 AND status in (1,2) AND user_confirm=1 AND (pay_type<>'offline' OR balance_pay<>'0.00') GROUP BY is_pay_bill";
			// $sql .= ' UNION ALL ';
			// $sql .= "SELECT sum(balance_pay + payment_money) as price, is_pay_bill FROM " . C('DB_PREFIX') . "group_order WHERE mer_id={$mer_id} AND paid=1 AND status in (1,2) AND user_confirm=1 AND (pay_type<>'offline' OR balance_pay<>'0.00') GROUP BY is_pay_bill";
			$sql = "SELECT sum(morder.balance_pay + morder.payment_money) as price, morder.is_pay_bill,0 as commission FROM ". C('DB_PREFIX') . "meal_order as morder  WHERE morder.mer_id={$mer_id} AND morder.paid=1 AND morder.status in (1,2) AND (morder.pay_type<>'offline' OR morder.balance_pay<>'0.00') GROUP BY morder.is_pay_bill";
			$sql .= ' UNION ALL ';
			$sql .= "SELECT sum(gorder.balance_pay + gorder.payment_money) as price, gorder.is_pay_bill,sum(g.commission) as commission FROM ". C('DB_PREFIX') . "group_order as gorder LEFT JOIN pigcms_group as g ON gorder.group_id=g.group_id WHERE gorder.mer_id={$mer_id} AND gorder.paid=1 AND gorder.status in (1,2) AND (gorder.pay_type<>'offline' OR gorder.balance_pay<>'0.00') GROUP BY gorder.is_pay_bill";
			$res = $mode->query($sql);
			$alltotalfinsh = 0;
			foreach ($res as $r) {
				$r['is_pay_bill'] && $alltotalfinsh += $r['price'];//已对账的总额
				 $alltotalfinsh=$alltotalfinsh-$r['commission'];//除去佣金的已对帐总额
			}
			$percent = '';
			if ($this->merchant_session['percent']) {
				$percent = $this->merchant_session['percent'];
			} elseif ($this->config['platform_get_merchant_percent']) {
				$percent = $this->config['platform_get_merchant_percent'];
			}
			$real_can_cash=($alltotalfinsh * (100 - $percent) * 0.01)-$allGetCash;
			
			if($_POST['cash_num']>$real_can_cash){
			 		$this->error("申请提现金额超过可提现金额，禁止申请！");
			}
			$data['bank_card']=$_POST['bank_card'];

			$data['cash_num']=$_POST['cash_num'];
			$data['create_time']=time();
			$data['status']=0;
			$result=D("Bank_cash_info")->add($data);
			if($result){
				//插入到记录表中
				$record['cash_info_id']=$result;
				$record['cash_num']=$data['cash_num'];
				$record['status']=0;
				$record['create_time']=time();
				$res=D("Merchant_cash_record")->add($record);
				if($res) {
					$this->success("提交提现申请成功！", U("Count/bill"));
				}else{
					$this->error("提交提现申请记录失败，但是提交成功！");
				}
			}else{
				$this->error("提交提现申请失败！");
			}
		}else{
			$newest=D("Bank_cash_info")->where("mer_id=".$this->merchant_session['mer_id'])->order("create_time DESC")->find();
			if(!empty($newest)){
				$this->assign("cash_info", $newest);
			}
			$this->display();
		}
	}
	
	public function clerk()
	{
		$Model = new Model();
		$sql = "SELECT s.name as store_name, s.*, m.* FROM ". C('DB_PREFIX') . "merchant_store AS s INNER JOIN ". C('DB_PREFIX') . "merchant_store_staff AS m ON s.store_id=m.store_id WHERE `s`.`mer_id`={$this->merchant_session['mer_id']}";
		$res = $Model->query($sql);
				
		$this->assign('staff_list', $res);
		$this->display();
	}
	
	public function weidian()
	{
		$mer_id = intval($this->merchant_session['mer_id']);
		$percent = '';
		if ($this->merchant_session['percent']) {
			$percent = $this->merchant_session['percent'];
		} elseif ($this->config['platform_get_merchant_percent']) {
			$percent = $this->config['platform_get_merchant_percent'];
		}
		$this->assign('percent', $percent);
		$merchant = D('Merchant')->field(true)->where('mer_id=' . $mer_id)->find();
		$result = D("Weidian_order")->get_order_by_mer_id($mer_id);
		$this->assign($result);
		$this->assign('total_percent', $result['total'] * $percent * 0.01);
		$this->assign('all_total_percent', ($result['alltotal']+$result['alltotalfinsh']) * $percent * 0.01);
		$this->assign('now_merchant', $merchant);
		$this->assign('mer_id', $mer_id);
		$this->display();
	}
	
	/**
	 * 店员账单
	 */
	public function staff_bill()
	{
		$mer_id = intval($this->merchant_session['mer_id']);
		$staffid = isset($_GET['staffid']) ? intval($_GET['staffid']) : 0;
		$staffs = D('Merchant_store_staff')->where(array('token' => $mer_id))->select();
		$staff_name = '';
		foreach ($staffs as $row) {
			if ($row['id'] == $staffid) $staff_name = $row['name'];
		}
		$this->assign(D("Meal_order")->get_offlineorder_by_mer_id($mer_id, $staff_name));
		$this->assign('staffid', $staffid);
		$this->assign('staffs', $staffs);
		$this->display();
		
	}
	
	public function change()
	{
		$mer_id = intval($this->merchant_session['mer_id']);
		$strids = isset($_GET['strids']) ? htmlspecialchars($_GET['strids']) : '';
		if ($strids) {
			$array = explode(',', $strids);
			$mealids = $groupids = array();
			foreach ($array as $val) {
				$t = explode('_', $val);
				if ($t[0] == 1) {
					$mealids[] = $t[1];
				} else {
					$groupids[] = $t[1];
				}
			}
			$mealids && D('Meal_order')->where(array('mer_id' => $mer_id, 'order_id' => array('in', $mealids)))->save(array('is_pay_bill' => 1));
			$groupids && D('Group_order')->where(array('mer_id' => $mer_id, 'order_id' => array('in', $groupids)))->save(array('is_pay_bill' => 1));
		}
		exit(json_encode(array('error_code' => 0)));
	}
	
}
?>