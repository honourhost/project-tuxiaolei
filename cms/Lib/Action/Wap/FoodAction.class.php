<?php
class FoodAction extends BaseAction
{
	public $store_id = 0;
	
	public $_store = null;
	
	public $session_index = '';
	
	public $order_index = '';

	public $leveloff = '';
	
	public function __construct()
	{
		parent::__construct();
		
		$this->store_id = isset($_REQUEST['store_id']) ? intval($_REQUEST['store_id']) : 0;
		
		$this->assign('store_id', $this->store_id);
		
		/* 粉丝行为分析 */
		D('Merchant_request')->add_request($this->mer_id, array('meal_hits' => 1));
		
		//店铺详情
		$merchant_store = M("Merchant_store")->where(array('store_id' => $this->store_id))->find();
		$merchant_store['office_time'] = unserialize($merchant_store['office_time']);
		$store_image_class = new store_image();
		$merchant_store['images'] = $store_image_class->get_allImage_by_path($merchant_store['pic_info']);
		$t = $merchant_store['images'];
		$merchant_store['image'] = array_shift($t);
		
		$merchant_store_meal = M("Merchant_store_meal")->where(array('store_id' => $this->store_id))->find();
		if ($merchant_store_meal) $merchant_store = array_merge($merchant_store, $merchant_store_meal);
		$this->leveloff=!empty($merchant_store_meal['leveloff']) ? unserialize($merchant_store_meal['leveloff']) :'';
		$this->_store = $merchant_store;
		$this->assign('store', $this->_store);
		
		
		$this->session_index = "session_foods{$this->store_id}_{$this->mer_id}";
		$this->order_index = "order_id_{$this->store_id}_{$this->mer_id}";
		if ($services = D('Customer_service')->where(array('mer_id' => $this->mer_id))->select()) {
			$key = $this->get_encrypt_key(array('app_id'=>$this->config['im_appid'],'openid' => $_SESSION['openid']), $this->config['im_appkey']);
			$kf_url = 'http://im-link.winworlds.cn/?app_id=' . $this->config['im_appid'] . '&openid=' . $_SESSION['openid'] . '&key=' . $key . '#serviceList_' . $this->mer_id;
			$this->assign('kf_url', $kf_url);
		}
	}
	
	public function index()
	{
		$name = isset($_GET['searhkey']) ? htmlspecialchars($_GET['searhkey']) : '';
		$where = array('mer_id' => $this->mer_id, 'have_meal' => 1);
		if ($name) $where['name'] = array('like', '%'.$name.'%');
		$stores = D('Merchant_store')->field(true)->where($where)->select();
		$store_image_class = new store_image();
		$list = array();
		foreach ($stores as $row) {
			$temp = array();
			$temp['position'] = array('lng' => $row['long'], 'lat' => $row['lat']);
			$temp['name'] = $row['name'];
			$temp['btndisabled'] = 0;
			$temp['isShow'] = 0;
			$temp['seeURL'] = '';
			$temp['showList'] = array();
			$temp['btnText'] = '我买';
			$temp['btnUrl'] = U('Food/menu', array('mer_id' => $row['mer_id'], 'store_id' => $row['store_id']));
			$temp['address'] = $row['adress'];
			$images = $store_image_class->get_allImage_by_path($row['pic_info']);
			$temp['imgurl'] = array_shift($images);
		
			$temp['storeDetailsURL'] = U('Food/shop', array('mer_id' => $row['mer_id'], 'store_id' => $row['store_id']));//'wap.php?mod=takeout&action=menu&com_id=' . $row['com_id'] . '&id=' . $row['id'];
			$list[] = $temp;
		}
		$this->assign('list', json_encode($list));
		$this->assign('total', count($list));
		
		$this->display();
	}
	
	
	public function shop()
	{
		empty($this->_store) && $this->error("不存在的商家店铺!");
		if ($this->_store['store_type'] == 2) {
			$this->redirect(U('Takeout/menu', array('mer_id' => $this->mer_id, 'store_id' => $this->_store['store_id'])));
		}
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id));
		$this->display();
	}
	
	
	public function shop_detail()
	{
		empty($this->_store) && $this->error("不存在的商家店铺!");
		if($this->_store['reply_count']){
			$reply_list = D('Reply')->get_reply_list($this->_store['store_id'], 1, 0, 10);
			$this->assign('reply_list',$reply_list);
		}
		
		$this->display();
	}
	
	public function ajaxreply()
	{
		$page = isset($_GET['page']) ? intval($_GET['page']) : 2;
		$pagesize = isset($_GET['pagesize']) ? intval($_GET['pagesize']) : 10;
		$start = ($page - 1) * $pagesize;
		$reply_list = D('Reply')->ajax_reply_list($this->_store['store_id'], 1, 0, $pagesize, $start);
		exit(json_encode(array('data' => $reply_list)));
		
		$html = '';
		foreach ($reply_list as $vo) {
			$html .= '<dd class="dd-padding">';
			$html .= '<div class="feedbackCard">';
			$html .= '<div class="userInfo">';
			$html .= '<weak class="username">' . $vo['nickname'] . '</weak>';
			$html .= '</div>';
			$html .= '<div class="score">';
			$html .= '<span class="stars">';
			for($i = 0; $i < 6; $i++) {
				if ($vo['score'] > $i) {
					$html .= '<i class="text-icon icon-star"></i>';
				} else {
					$html .= '<i class="text-icon icon-star-gray"></i>';
				}
			}
			$html .= '</span>';
			$html .= '<weak class="time">' . $vo['add_time'] . '</weak>';
			$html .= '</div>';
			$html .= '<div class="comment">';
			$html .= '<p>' . $vo['comment'] . '</p>';
			$html .= '</div>';
			if ($vo['pics']) {
				$html .= '<div class="pics view_album" data-pics="';
				$i = 1;
				foreach ($vo['pics'] as $vvoo) {
					$html .= $vvoo['m_image'];
					if (count($vo['pics']) > $i) {
						$html .= ',';
					}
					$i ++;
				}
				$html .= '">';
				foreach ($vo['pics'] as $voo) {
					$html .= '<span class="pic-container imgbox" style="background:none;"><img src="' . $voo['s_image'] . '" style="width:100%;"/></span>&nbsp;';
				}
				$html .= '</volist>';
				$html .= '</div>';
			}
			$html .= '</div>';
			$html .= '</dd>';
		}
	}
	public function menu()
	{
		empty($this->_store) && $this->error("不存在的商家店铺!");
		$orid = isset($_GET['orid']) ? intval($_GET['orid']) : 0;


		//客户的购物车记录
		$disharr = unserialize($_SESSION[$this->session_index]);
		
		if ($order = $this->check_order($orid)) {
			if ($order['paid'] != 1) {
				$info = unserialize($order['info']);
				foreach ($info as $om) {
					if (isset($disharr[$om['id']])) {
						$disharr[$om['id']]['num'] += $om['num'];
					} else {
						$disharr[$om['id']]['num'] = $om['num'];
					}
				}
			}
			$this->assign('orid', $orid);
		} else {
			$this->assign('orid', 0);
		}

		$_SESSION['deposit'] = 1;
		/**************客户收藏的菜品*****************/
		$like = D('Meal_like')->field('meal_ids')->where(array('uid' => $this->user_session['uid'], 'store_id' => $this->store_id, 'mer_id' => $this->mer_id))->find();
		$meal_ids = array();
		$like && $meal_ids = unserialize($like['meal_ids']);
		/**************客户收藏的菜品*****************/
		
		//菜品分类
		$sorts = M("Meal_sort")->where(array('store_id' => $this->store_id))->order('sort DESC, sort_id DESC')->select();
		$t_meals = $meals = $list = array();
		$ids = array();
		foreach ($sorts as $sort) {
			if ($sort['is_weekshow']) {
				$week = explode(",", $sort['week']);
				if (in_array(date("w"), $week)) {
					$list[] = $sort;
					$ids[] = $sort['sort_id'];
				}
			} else {
				$list[] = $sort;
				$ids[] = $sort['sort_id'];
			}
		}
		
		$nowMouth = date('Ym');
		
		$meal_image_class = new meal_image();
		$temp = M("Meal")->where(array('store_id' => $this->store_id, 'sort_id' => array('in', $ids), 'status' => 1))->order('sort DESC')->select();
		foreach ($temp as $m) {
			if (isset($disharr[$m['meal_id']])) {
				$m['num'] = $disharr[$m['meal_id']]['num'];
			} else {
				$m['num'] = 0;
			}
			if (in_array($m['meal_id'], $meal_ids)) {
				$m['like'] = 1;
			} else {
				$m['like'] = 0;
			}
			if ($m['sell_mouth'] != $nowMouth) $m['sell_count'] = 0;//跨月销售额清零
			$m['image'] = $meal_image_class->get_image_by_path($m['image'], $this->config['site_url'], 's');
			if (isset($t_meals[$m['sort_id']]['list'])) {
				$t_meals[$m['sort_id']]['list'][] = $m;
			} else {
				$t_meals[$m['sort_id']]['list'] = array($m);
				$t_meals[$m['sort_id']]['sort_id'] = $m['sort_id'];
			}
		}
		
		foreach ($ids as $sort_id) {
			isset($t_meals[$sort_id]) && $meals[$sort_id] = $t_meals[$sort_id];
		}
		
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id,'keyword'=>strval($_GET['keywords'])));
		
		$this->assign('meals', $meals);
		$this->assign("sortlist", $list);
		$this->display();
	}
	
	/**
	 * 保存到购物车
	 */
	public function processOrder() 
	{
		empty($this->_store) && $this->error("不存在的商家店铺!");
		
		$foods = $_POST['cart'];
		$disharr = array();
		$sure_dish = unserialize($_SESSION[$this->session_index]);
		foreach ($foods as $kk => $vv) {
			$count = $vv['count'] ? intval($vv['count']) : 0;
			if ($count > 0) {
				$disharr[$vv['id']] = array('id' => $vv['id'], 'num' => $count, 'omark' => '');
				if (isset($sure_dish[$vv['id']]['omark']) && $sure_dish[$vv['id']]['omark']) {
					$disharr[$vv['id']]['omark'] = $sure_dish[$vv['id']]['omark'];
				}
			}
		}
		empty($disharr) && exit(json_encode(array('error' => 1, 'msg' => '您尚未点菜！')));
		$_SESSION[$this->session_index] = serialize($disharr);
		exit(json_encode(array('error' => 0, 'msg' => 'ok')));
	}
	
	private function check_order($order_id)
	{
		if ($order = D('Meal_order')->where(array('uid' => $this->user_session['uid'], 'store_id' => $this->store_id, 'order_id' => $order_id))->find()) {
			return $order;
		} else {
			return false;
		}
	}
	/**
	 * 确认购物车 
	 */
	public function cart()
	{
		$this->isLogin();
		$isclean = $this->_get('isclean', 'trim');
		$orid = $this->_get('orid', 'intval');
		
		if ($this->check_order($orid)) {
			$this->assign('action_url', U('Food/saveorder', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'orid' => $orid)));
			$this->assign('orid', $orid);
		} else {
			$this->assign('action_url', U('Food/sureorder', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id)));
			$this->assign('orid', 0);
		}
			$level_off=false;
			if(!empty($this->user_level) && !empty($this->leveloff) && !empty($this->user_session) && isset($this->user_session['level'])){
			     /****type:0无优惠 1百分比 2立减*******/
				if(isset($this->leveloff[$this->user_session['level']]) && isset($this->user_level[$this->user_session['level']])){
					$level_off=$this->leveloff[$this->user_session['level']];
					if($level_off['type']==1){
					  $level_off['offstr']='按此次总价'.$level_off['vv'].'%来结算';
					}elseif($level_off['type']==2){
					  $level_off['offstr']='此次总价立减'.$level_off['vv'].'元';
					}
				}
			}
			$this->assign('level_off', $level_off);		
		if ($isclean == 1) {
			$_SESSION[$this->session_index] = '';
			$disharr = '';
		} else {
			$disharr = unserialize($_SESSION[$this->session_index]);
		}
		if (!empty($disharr)) {
			$idarr = array_keys($disharr);
			$meal_image_class = new meal_image();
			$dish = M("Meal")->where(array('store_id' => $this->store_id, 'meal_id' => array('in', $idarr), 'status' => 1))->select();
			foreach ($dish as $val) {
				$val['image'] = $meal_image_class->get_image_by_path($val['image'],$this->config['site_url'],'s');
				$disharr[$val['meal_id']] = array_merge($disharr[$val['meal_id']], $val);
			}
		}
		
		$allmark = $_SESSION["allmark" . $this->store_id . $this->mer_id];
		$this->assign('allmark', $allmark);
		$this->assign('ordishs', $disharr);
		$this->display();
	}
	
	
	/**
	 * 填写客户的个人信息
	 */
	public function sureorder()
	{
		$this->isLogin();
		$deposit = isset($_GET['deposit']) ? intval($_GET['deposit']) : 1 ;
		$_SESSION['deposit'] = $deposit;
		$this->assign('deposit', $deposit);
        $disharr = $_POST['dish'];
        $allmark = htmlspecialchars(trim($_POST['allmark']), ENT_QUOTES);
        $_SESSION["allmark" . $this->store_id . $this->mer_id] = $allmark;
        $orid = $this->_get('orid') ? intval($this->_get('orid', "trim")) : 0;
        if ($this->_store) {
            $tmparr = array();
            foreach ($disharr as $dk => $dv) {
                if (!empty($dv)) {
                    $tmpnum = intval($dv['num']);
                    if ($tmpnum > 0) {
                        $tmparr[$dk] = array();
                        $tmparr[$dk]['id'] = $dk;
                        $tmparr[$dk]['num'] = $tmpnum;
                        $tmparr[$dk]['omark'] = htmlspecialchars(trim($dv['omark']), ENT_QUOTES);
                    }
                }
            }
            if ($tmparr) {
                $_SESSION[$this->session_index] = serialize($tmparr);
            }
			$totalmoney = trim($_POST['totalmoney']);
			$totalnum = trim($_POST['totalnum']);
			$level_off=false;
			$finaltotalprice=0;
			if(!empty($this->user_level) && !empty($this->leveloff) && !empty($this->user_session) && isset($this->user_session['level'])){
			     /****type:0无优惠 1百分比 2立减*******/
				if(isset($this->leveloff[$this->user_session['level']]) && isset($this->user_level[$this->user_session['level']])){
					$level_off=$this->leveloff[$this->user_session['level']];
					if($level_off['type']==1){
					  $finaltotalprice=$totalmoney *($level_off['vv']/100);
					  $finaltotalprice=$finaltotalprice>0 ? $finaltotalprice : 0;
					  $level_off['offstr']='按此次总价'.$level_off['vv'].'%来结算';
					}elseif($level_off['type']==2){
					  $finaltotalprice=$totalmoney-$level_off['vv'];
					  $finaltotalprice=$finaltotalprice>0 ? $finaltotalprice : 0;
					  $level_off['offstr']='此次总价立减'.$level_off['vv'].'元';
					}
				}
			}
			$this->assign('totalmoney', $totalmoney);
			$this->assign('totalnum', $totalnum);
			$this->assign('finaltotalprice', round($finaltotalprice,2));
			$this->assign('level_off', $level_off);

			$tables = D('Merchant_store_table')->where(array('store_id' => $this->store_id))->select();
			$this->assign('tables', $tables);
			if (empty($tables)) {
				$this->assign('seattype', 0);
			} else {
				$this->assign('seattype', $tables[0]['pigcms_id']);
			}
            $user_info = D('User_adress')->get_one_adress($this->user_session['uid'], intval($_GET['adress_id']));
            $this->assign('date', date('Y-m-d'));
            $this->assign('time', date('H:i', time() + 1200));
            $this->assign('user_info', $user_info);
            $this->display();
        } else {
            $jumpurl = U('Food/index', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id));
            $this->error('订单信息中店面信息出错', $jumpurl);
        }
	}
	
	/**
	 * 保存订单
	 */
	public function saveorder()
	{
		if(empty($this->user_session)){
			exit(json_encode(array('status' => 1, 'message' => '请先进行登录！', 'url' => U('Login/index'))));
		}
		
		$orid = isset($_REQUEST['orid']) ? intval($_REQUEST['orid']) : 0;

		$total = $price = $tmpprice=0;
		$disharr = unserialize($_SESSION[$this->session_index]);
		$idarr = array_keys($disharr);
		$store_meal = D('Merchant_store_meal')->where(array('store_id' => $this->store_id))->find();
		if ($old_order = $this->check_order($orid)) {//加菜
			$info = $old_order['info'] ? unserialize($old_order['info']) : array();
			$isadd = empty($info) ? 0 : 1;
			$oldmenus = array();
			if ($old_order['paid'] != 1) {
				foreach ($info as $om) {
					$oldmenus[$om['id']] = $om['num'];
				}
			}
			if ($idarr) {
				$dish = M("Meal")->where(array('store_id' => $this->store_id, 'meal_id' => array('in', $idarr), 'status' => 1))->select();
				foreach ($dish as $val) {
					$num = isset($disharr[$val['meal_id']]['num']) ? intval($disharr[$val['meal_id']]['num']) : 0;
					$omark = isset($disharr[$val['meal_id']]['omark']) ? htmlspecialchars($disharr[$val['meal_id']]['omark']) : '';
					if (isset($oldmenus[$val['meal_id']])) {
						for ($i = 0; $i < count($info); $i++) {
							if ($info[$i]['id'] == $val['meal_id']) {
								$isadd = $info[$i]['num'] == $num ? 0 : 1;
								$info[$i] = array('id' => $val['meal_id'], 'name' => $val['name'], 'price' => $val['price'], 'num' => $num, 'omark' => $omark, 'isadd' => $isadd, 'iscount' => 0);
							}
						}
					} else {
						$info[] = array('id' => $val['meal_id'], 'name' => $val['name'], 'price' => $val['price'], 'num' => $num, 'omark' => $omark, 'isadd' => 1, 'iscount' => 0);
					}
					
					$total += $num;
					$tmpprice += $val['price'] * $num;
				}

				//会员等级优惠
				$level_off = false;
				$finaltotalprice = 0;
				if(!empty($this->user_level) && !empty($this->leveloff) && !empty($this->user_session) && isset($this->user_session['level'])){
					 /****type:0无优惠 1百分比 2立减*******/
					if(isset($this->leveloff[$this->user_session['level']]) && isset($this->user_level[$this->user_session['level']])){
						$level_off = $this->leveloff[$this->user_session['level']];
						if($level_off['type'] == 1){
						  $finaltotalprice = $tmpprice *($level_off['vv'] / 100);
						  $finaltotalprice = $finaltotalprice > 0 ? $finaltotalprice : 0;
						  $level_off['offstr'] = '按此次总价' . $level_off['vv'] . '%来结算';
						} elseif($level_off['type'] == 2) {
						  $finaltotalprice = $tmpprice - $level_off['vv'];
						  $finaltotalprice = $finaltotalprice > 0 ? $finaltotalprice : 0;
						  $level_off['offstr'] = '此次总价立减' . $level_off['vv'] . '元';
						}
					}
				}

				if (!empty($old_order['leveloff'])) {
					$leveloff = unserialize($old_order['leveloff']);
					if ($old_order['paid'] == 1) {
						$price = $finaltotalprice > 0 ? $leveloff['totalprice']+$finaltotalprice : $leveloff['totalprice']+$tmpprice;
					} else {
						$price = $finaltotalprice > 0 ? $finaltotalprice : $tmpprice;
					}
					$price = round($price, 2);
					is_array($level_off) && $level_off['totalprice']=$price;
				}else{
					foreach ($info as $v) {
						$price += $v['price'] * $v['num'];
					}
					$price = max($price, $old_order['price']);
				}
				
				$total_price = $price;
				$minus_price = 0;
				if ($store_meal && !empty($store_meal['minus_money']) && $price > $store_meal['full_money']) {
					$price = $price - $store_meal['minus_money'];
					$minus_price = $store_meal['minus_money'];
				}
				
				$data = array('price' => $price, 'dateline' => time());
				if ($old_order['paid'] == 1) {
					$data['total'] = $total + $old_order['total'];
				} else {
					$data['total'] = $total;
				}
				$data['orderid'] = date("YmdHis") . sprintf("%08d", $this->user_session['uid']);
				$data['info'] = $info ? serialize($info) : '';
				
				$data['total_price'] = $total_price;
				$data['minus_price'] = $minus_price;
				
				$data['paid'] = $old_order['paid'] == 1 ? 2 : 0;
				
				!empty($level_off) && $data['leveloff']=serialize($level_off);
				
				if ($return = D("Meal_order")->where(array('order_id' => $orid, 'uid' => $this->user_session['uid']))->save($data)) {
					$_SESSION[$this->session_index]  = null;
					$_SESSION["allmark" . $this->store_id . $this->mer_id] = null;
					redirect(U('Pay/check', array('order_id' => $orid, 'type'=>'food')));
				} else {
					exit(json_encode(array('status' => 1, 'message' => '服务器繁忙，稍后重试！')));
					$this->error('服务器繁忙，稍后重试');
				}
			} else {
				$jumpurl = U('Food/menu', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'orid' => $orid));
				exit(json_encode(array('status' => 1, 'message' => '还没有加菜呢', 'url' => $jumpurl)));
				$this->error('还没有加菜呢', $jumpurl);
			}
		} else {//点菜的新单信息
			$phone = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '';
			$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
			$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
			$note = isset($_POST['mark']) ? htmlspecialchars($_POST['mark']) : '';
			$date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '';
			$time = isset($_POST['time']) ? htmlspecialchars($_POST['time']) : '';
			$sex = isset($_POST['sex']) ? intval($_POST['sex']) : 1;
			$num = isset($_POST['num']) ? intval($_POST['num']) : 2;
			$tableid = isset($_POST['seattype']) ? intval($_POST['seattype']) : 0;
			if (empty($date)) exit(json_encode(array('status' => 1, 'message' => '就餐日期不能为空')));
			if (empty($time)) exit(json_encode(array('status' => 1, 'message' => '就餐时间不能为空')));
			if (empty($name)) exit(json_encode(array('status' => 1, 'message' => '您的姓名不能为空')));
			if (empty($phone)) exit(json_encode(array('status' => 1, 'message' => '您的电话不能为空')));
			$arrive_time = strtotime($date . ' ' . $time . ":00");
			$info = array();
			if ($idarr) {//点餐
				$dish = M("Meal")->where(array('store_id' => $this->store_id, 'meal_id' => array('in', $idarr), 'status' => 1))->select();
				foreach ($dish as $val) {
					$num = isset($disharr[$val['meal_id']]['num']) ? intval($disharr[$val['meal_id']]['num']) : 0;
					$omark = isset($disharr[$val['meal_id']]['omark']) ? htmlspecialchars($disharr[$val['meal_id']]['omark']) : '';
					$info[] = array('id' => $val['meal_id'], 'name' => $val['name'], 'price' => $val['price'], 'num' => $num, 'omark' => $omark, 'isadd' => 0, 'iscount' => 0);
					$total += $num;
					$price += $val['price'] * $num;
				}
				//会员等级优惠
				$level_off=false;
				$finaltotalprice=0;
				if(!empty($this->user_level) && !empty($this->leveloff) && !empty($this->user_session) && isset($this->user_session['level'])){
					 /****type:0无优惠 1百分比 2立减*******/
					if(isset($this->leveloff[$this->user_session['level']]) && isset($this->user_level[$this->user_session['level']])){
						$level_off=$this->leveloff[$this->user_session['level']];
						if($level_off['type']==1){
						  $finaltotalprice=$price *($level_off['vv']/100);
						  $finaltotalprice=$finaltotalprice>0 ? $finaltotalprice : 0;
						  $level_off['offstr']='按此次总价'.$level_off['vv'].'%来结算';
						}elseif($level_off['type']==2){
						  $finaltotalprice=$price-$level_off['vv'];
						  $finaltotalprice=$finaltotalprice>0 ? $finaltotalprice : 0;
						  $level_off['offstr']='此次总价立减'.$level_off['vv'].'元';
						}
					}
				}
			  $price=$finaltotalprice > 0 ? round($finaltotalprice,2) : $price;
			  $level_off && is_array($level_off) && $level_off['totalprice']=$price;
			} else {//预定
				if ($_SESSION['deposit']) {
					$jumpurl = U('Food/menu', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id));
					exit(json_encode(array('status' => 1, 'message' => '您还没有买或订单已生成', 'url' => $jumpurl)));
					$this->error('您还没有买或订单已生成', $jumpurl);
				}
				$price = $this->_store['deposit'];
			}
			
			$total_price = $price;
			$minus_price = 0;
			
			if ($store_meal && !empty($store_meal['minus_money']) && $price > $store_meal['full_money']) {
				$price = $price - $store_meal['minus_money'];
				$minus_price = $store_meal['minus_money'];
			}
			
			$isdeposit = isset($_POST['isdeposit']) ? intval($_POST['isdeposit']) : 0;/***isdeposit 1 支付预定经***/
			$price = $isdeposit ? $this->_store['deposit'] : $price;

			if(isset($level_off) && $isdeposit && ($level_off['totalprice']<$price)){
			    $level_off['totalprice'] = $price;
			}

			
			$data = array('mer_id' => $this->mer_id, 'tableid' => $tableid, 'store_id' => $this->store_id, 'name' => $name, 'phone' => $phone, 'address' => $address, 'note' => $note, 'dateline' => time(), 'total' => $total, 'price' => $price, 'arrive_time' => $arrive_time);
			$data['orderid'] = date("YmdHis") . sprintf("%08d", $this->user_session['uid']);
			$data['uid'] = $this->user_session['uid'];
			$data['sex'] = $sex;
			$data['num'] = $num;
			$data['info'] = $info ? serialize($info) : '';
			
			$data['total_price'] = $total_price;
			$data['minus_price'] = $minus_price;
			
			isset($level_off) && !empty($level_off) && $data['leveloff']=serialize($level_off);
			$orderid = D("Meal_order")->add($data);
			if ($orderid) {
				$_SESSION[$this->session_index] = null;
				$_SESSION["allmark" . $this->store_id . $this->mer_id] = null;
				if ($this->user_session['openid']) {
					$keyword2 = '';
					$pre = '';
					foreach (unserialize($data['info']) as $menu) {
						$keyword2 .= $pre . $menu['name'] . ':' . $menu['price'] . '*' . $menu['num'];
						$pre = '\n\t\t\t';
					}
					$href = C('config.site_url').'/wap.php?c=Food&a=order_detail&order_id='. $orderid . '&mer_id=' . $data['mer_id'] . '&store_id=' . $data['store_id'];
					$model = new templateNews(C('config.wechat_appid'), C('config.wechat_appsecret'));
					$model->sendTempMsg('OPENTM201682460', array('href' => $href, 'wecha_id' => $this->user_session['openid'], 'first' => '您好，您的订单已生成', 'keyword3' => $orderid, 'keyword1' => date('Y-m-d H:i:s'), 'keyword2' => $keyword2, 'remark' => '您的该次'.$this->config['meal_alias_name'].'下单成功，感谢您的使用！'));
				}
				$msg = ArrayToStr::array_to_str($orderid);
				$op = new orderPrint($this->config['print_server_key'], $this->config['print_server_topdomain']);
				$op->printit($this->mer_id, $this->store_id, $msg, 0);
	
				$sms_data = array('mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'type' => 'food');
				if ($this->config['sms_place_order'] == 1 || $this->config['sms_place_order'] == 3) {
					$sms_data['uid'] = $this->user_session['uid'];
					$sms_data['mobile'] = $data['phone'];
					$sms_data['sendto'] = 'user';
					$sms_data['content'] = '您在' . $this->_store['name'] . '中预定的用餐的订单生产成功，订单号：' . $orderid;
					Sms::sendSms($sms_data);
				}
				if ($this->config['sms_place_order'] == 2 || $this->config['sms_place_order'] == 3) {
					$sms_data['uid'] = 0;
					$sms_data['mobile'] = $this->_store['phone'];
					$sms_data['sendto'] = 'merchant';
					$sms_data['content'] = '顾客' . $data['name'] . '刚刚下了一个订单，订单号：' . $orderid . '请您注意查看并处理';
					Sms::sendSms($sms_data);
				}
				/* 粉丝行为分析 */
				$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $orderid));
				if ($data['total_price'] - $data['minus_price'] <= 0) {
					D("Meal_order")->where(array('order_id' => $orderid))->save(array('paid' => 1));
					exit(json_encode(array('status' => 0, 'url' => U('Food/order_detail', array('order_id' => $orderid, 'mer_id'=> $this->mer_id, 'store_id' => $this->store_id)))));
				}
				exit(json_encode(array('status' => 0, 'url' => U('Pay/check', array('order_id' => $orderid, 'type'=>'food', 'isdeposit' => $isdeposit)))));
			} else {
				exit(json_encode(array('status' => 1, 'message' => '服务器繁忙，稍后重试')));
			}
		}
	}
	
	/**
	 * 订单列表
	 */
	public function order_list()
	{
		$this->isLogin();
        $sql = "SELECT `s`.`name` as s_name, `o`.* FROM " . C('DB_PREFIX') . 'merchant_store AS s INNER JOIN ' . C('DB_PREFIX') . "meal_order as o ON s.store_id=o.store_id WHERE o.store_id={$this->store_id} AND o.mer_id={$this->mer_id} AND o.uid={$this->user_session['uid']}  AND o.meal_type=0 AND o.status<3 ORDER BY o.order_id DESC LIMIT 0, 30";
        $mode = new Model();
        $meal_list = $mode->query($sql);
        $list = array();
        $weekarr = array('0' => '周日', '1' => '周一', '2' => '周二', '3' => '周三', '4' => '周四', '5' => '周五', '6' => '周六');
        $nowtime = time();
        foreach ($meal_list as $tmp) {
        	if ($tmp['pay_type'] == 'offline' && empty($tmp['thrid_id'])) $tmp['paid'] = 0;
        	$tmp['topay'] = false;
        	if ($tmp['paid'] == 1) {
        		if ($tmp['status']) {
        			$tmp['css'] = ' faild hasicon';
        			$tmp['show_status'] = '<label>√</label>已完成';
        		} else {
        			$tmp['css'] = ' processing';
        			$tmp['show_status'] = '已付款';
        		}
        	} else {
        		if ($tmp['paid'] == 2) {
        			$tmp['topay'] = true;
        			$tmp['css'] = 'processing';
        			$tmp['show_status'] = '处理中';
        		}elseif (intval($tmp['arrive_time']) + 10800 > time()) {//预定时间加3个小时
        			$tmp['topay'] = true;
        			$tmp['css'] = 'processing';
        			$tmp['show_status'] = '处理中';
        		} else {
		        	$tmp['css'] = ' faild hasicon';
		        	$tmp['show_status'] = '<label>×</label>已过期';
        		}
        	}
        	
            $tmp['otimestr'] = date('Y-m-d', $tmp['dateline']) . " " . $weekarr[date('w', $tmp['dateline'])] . " " . date('H:i', $tmp['dateline']);
            $list[] = $tmp;
        }
        $this->assign('orderList', $list);
        $this->display();
	}
	
	/**
	 * 订单详情
	 */
	public function order_detail()
	{
		$this->isLogin();
		
		$orderid = intval($_GET['order_id']);
// 		$otherrm = isset($_GET['otherrm']) ? intval($_GET['otherrm']) : 0;
// 		$otherrm && $_SESSION['otherwc'] = null;
		
		$order = M("Meal_order")->where(array('order_id' => $orderid, 'uid' => $this->user_session['uid'], 'store_id' => $this->store_id))->find();
		if (empty($order)) {
			$this->error('错误的订单信息', U('Meal/index'));
		}
		$meallist = unserialize($order['info']);
		//if ($order['pay_type'] == 'offline' && empty($order['third_id'])) $order['paid'] = 0;
		$order['topay'] = false;
		$order['jiaxcai'] = false;
		$order['cancel'] = 0;
		if ($order['paid'] == 1 && !($order['pay_type'] == 'offline' && empty($order['third_id']))) {
			if ($order['status']) {
				$order['css'] = ' faild hasicon';
				$order['show_status'] = '<label>√</label>已完成';
			} else {
				$order['css'] = ' processing';
				$order['show_status'] = '已付款';
				$order['jiaxcai'] = true;
				$order['cancel'] = 1;//退款
			}
		} else {
			if (intval($order['arrive_time']) + 10800 > time()) {//预定时间加3个小时
				$order['topay'] = true;
				if ($order['paid'] == 2) {
					//$order['cancel'] = 1;//退款
				} else {
					//$order['cancel'] = 2;//删除
					$order['jiaxcai'] = true;
				}
				$order['css'] = 'processing';
				$order['show_status'] = '处理中';
			} else {
				if ($order['paid'] == 2) {
					//$order['cancel'] = 1;//退款
			 	} else {
					//$order['cancel'] = 2;//删除
				}
				$order['css'] = ' faild hasicon';
				$order['show_status'] = '<label>×</label>已过期';
			}
		}
		$order['paytypestr'] = D('Pay')->get_pay_name($order['pay_type']);
		if ($order['paid'] == 0) {
			$order['paidstr'] = '未支付';
		} elseif ($order['paid'] == 1) {
			if ($order['pay_type'] == 'offline' && empty($order['third_id'])) {
				$order['paidstr'] = '还未付款';
			} else {
				$order['paidstr'] = '全额付款';
			}
		} else {
			$order['paidstr'] = '已付订金';
		}
		
		if ($order['status'] > 2) {
			$order['topay'] = false;
			$order['jiaxcai'] = false;
			$order['cancel'] = 0;
		}
		if (empty($order['tableid'])) {
			$order['tablename'] = '不限';
		} else {
			$table = D('Merchant_store_table')->where(array('pigcms_id' => $order['tableid'], 'store_id' => $this->store_id))->find();
			$order['tablename'] = isset($table['name']) ? $table['name'] : '不限';
		}
		if(!empty($order['leveloff'])) $order['leveloff']=unserialize($order['leveloff']);
		/* 粉丝行为分析 */
		$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id));
		$this->assign('meallist', $meallist);
		$this->assign('order', $order);
		$this->display();
	}
	
	/**
	 * 客户收藏
	 */
	public function dolike()
	{
		if(empty($this->user_session)) exit('no');
		$meal_id = isset($_POST['meal_id']) ? intval($_POST['meal_id']) : 0;
		$islove = isset($_POST['islove']) ? intval($_POST['islove']) : 0;
		$like = D('Meal_like')->where(array('uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id))->find();
		if ($like) {
			$meal_ids = unserialize($like['meal_ids']);
			if ($islove) {
				in_array($meal_id, $meal_ids) || $meal_ids[$meal_id] = $meal_id;
			} else {
				unset($meal_ids[$meal_id]);
			}
			D('Meal_like')->where(array('uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id))->save(array('meal_ids' => serialize($meal_ids)));
		} elseif ($islove) {
			$meal_ids = array();
			$meal_ids[$meal_id] = $meal_id;
			D('Meal_like')->add(array('uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'meal_ids' => serialize($meal_ids)));
		}
	}
	
	private function isLogin()
	{
		if(empty($this->user_session)){
			$this->error_tips('请先进行登录！',U('Login/index'));
		}
	}
	
	public function orderdel()
	{
		$this->isLogin();
		$id = isset($_GET['orderid']) ? intval($_GET['orderid']) : 0;
		if ($order = M('Meal_order')->where(array('order_id' => $id, 'uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id))->find()) {
			
			if ($order['paid'] == 1 && date('m', $order['dateline']) == date('m')) {
				foreach (unserialize($order['info']) as $menu) {
					D('Meal')->where(array('meal_id' => $menu['id'], 'sell_count' => array('gt', $menu['num'])))->setDec('sell_count', $menu['num']);
				}
			}
			D("Merchant_store_meal")->where(array('store_id' => $order['store_id']))->setDec('sale_count', 1);
			/* 粉丝行为分析 */
			$this->behavior(array('mer_id' => $this->mer_id, 'biz_id' => $this->store_id));
			
			M('Meal_order')->where(array('order_id' => $id, 'uid' => $this->user_session['uid'], 'mer_id' => $this->mer_id, 'store_id' => $this->store_id))->save(array('status' => 4));
			$this->success('订单取消成功', U('My/order_list', array('mer_id' => $this->mer_id, 'store_id' => $this->store_id, 'type' => 0)));
		} else {
			$this->error('订单取消失败！');
		}
		
	}
}
?>