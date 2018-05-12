<?php
class GroupModel extends Model{
	/*得到指定类型，指定数量的团购*/

    protected  function delothercitydata($arr){

        //删除非当前地区的数据
     /*   foreach($arr as  $k2=>$v2)
        {
            foreach($arr[$k2]['group_list'] as $k=>$v)
            {
                if(!in_array($v['area_id'],$_SESSION['areaarr']))
                {
                    unset($arr[$k2]['group_list'][$k]);    //删除非当前地区的数据
                }
            }
        }*/
        //删除非当前地区的数据
    }

    //time 2016.1.06 by sunny
    //获取手机端请求的订单列表
   public function getMobileOrderList($uid,$status,$is_wap=false){

	   $groupcondition="`gorder`.`uid`='$uid' AND `gorder`.`sun_id` IS NULL";
	   $mealcondition="`mo`.`uid`='$uid'";

	  if($status==1){
		   $groupcondition.=" AND `gorder`.`paid`='0'";
		   $mealcondition.=" AND `mo`.`paid`='0'";
	   }elseif($status==2){
		   $groupcondition.=" AND `gorder`.`paid`='1'";
		   $groupcondition .= " AND `gorder`.`user_confirm`='0'";
		   $mealcondition.= " AND `mo`.`paid`='1'";
		   $mealcondition.= " AND `mo`.`user_confirm`='0'";
	   }elseif($status==3){
		   $groupcondition .= " AND `gorder`.`paid`='1'";
		   $groupcondition .= " AND `gorder`.`status`='1'";
		   $groupcondition .= " AND `gorder`.`user_confirm`='1'";
		   $mealcondition.= " AND `mo`.`paid`='1'";
		   $mealcondition.= " AND `mo`.`status`='1'";
		   $mealcondition.= " AND `mo`.`user_confirm`='1'";
	   }elseif($status==4){
	   	   $groupcondition .= " AND `gorder`.`paid`='1'";
		   $groupcondition .= " AND `gorder`.`status`='2'";
		   $mealcondition.= " AND `mo`.`paid`='1'";
		   $mealcondition.= " AND `mo`.`status`='2'";
	   }else{
		   $groupcondition.=" AND `gorder`.`status`<=3";
		   $mealcondition.= " AND `mo`.`status`<'3'";
	  }
	   $count1 = D('Meal_order')->alias("mo")->where($mealcondition)->count();
	   $count2 = D('Group_order')->alias("gorder")->where($groupcondition)->count();

	   $allcount=$count1+$count2;
	   //加入页码最大限制，超过最大值返回空
            $req_page=$_GET['p'];
            $max_page=ceil($allcount/15);
            if($req_page>$max_page){
                return "";
            }
       import('@.ORG.group_page');

	   $p = new Page($count1 + $count2, 15,'p');

	   $mode=new Model();
	   //用UNION ALL查询
	   // $sql = "SELECT 1 as name, mo.order_id, s.name as order_name, mo.uid, mo.mer_id, mo.store_id, mo.phone, mo.total, (mo.balance_pay+mo.payment_money) as price, mo.price as order_price, mo.dateline,mo.paid, mo.status, mo.pay_type, mo.pay_time, mo.third_id, mo.is_mobile_pay, mo.balance_pay, mo.payment_money, mo.card_id, mo.merchant_balance, mo.is_pay_bill,s.pic_info as image  FROM " . C('DB_PREFIX') . "meal_order mo LEFT JOIN ".C('DB_PREFIX') . "merchant_store s ON mo.store_id=s.store_id WHERE ".$mealcondition;
	   // $sql .= ' UNION ALL ';
	   // $sql .= "SELECT 2 as name, gorder.order_id, gorder.order_name, gorder.uid, gorder.mer_id, gorder.store_id,gorder.phone, gorder.num as total, (gorder.balance_pay+gorder.payment_money) as price, gorder.total_money as order_price, gorder.add_time as dateline, gorder.paid, gorder.status, gorder.pay_type, gorder.pay_time, gorder.third_id, gorder.is_mobile_pay, gorder.balance_pay, gorder.payment_money, gorder.card_id, gorder.merchant_balance, gorder.is_pay_bill ,g.pic as image FROM " . C('DB_PREFIX') . "group_order gorder LEFT JOIN ".C('DB_PREFIX') . "group g ON gorder.group_id=g.group_id WHERE ".$groupcondition;
	   // $sql .= " ORDER BY dateline DESC LIMIT {$p->firstRow}, {$p->listRows}";
	   $sql = "SELECT modetail.*,merchant.name as merchant_name from (SELECT 1 as name, 1 as tuan_type,2 as group_pass,mo.user_confirm,mo.order_id, s.name as order_name, mo.uid, mo.mer_id, mo.store_id, mo.phone, mo.total, (mo.balance_pay+mo.payment_money) as price, mo.price as order_price, mo.dateline,mo.paid, mo.status, mo.pay_type, mo.pay_time, mo.third_id, mo.store_id as order_detail_id,mo.is_mobile_pay, mo.balance_pay, mo.payment_money, mo.card_id, mo.merchant_balance, mo.is_pay_bill,s.pic_info as image  FROM " . C('DB_PREFIX') . "meal_order mo LEFT JOIN ".C('DB_PREFIX') . "merchant_store s ON mo.store_id=s.store_id WHERE ".$mealcondition.") as modetail LEFT JOIN ".C('DB_PREFIX') . "merchant merchant ON modetail.mer_id=merchant.mer_id";
	   $sql .= ' UNION ALL ';
	   $sql .= "SELECT godetail.*,merchant.name as merchant_name from (SELECT 2 as name, gorder.tuan_type as tuan_type,gorder.group_pass as group_pass,gorder.user_confirm,gorder.order_id, gorder.order_name, gorder.uid, gorder.mer_id, gorder.store_id,gorder.phone, gorder.num as total, (gorder.balance_pay+gorder.payment_money) as price, gorder.total_money as order_price, gorder.add_time as dateline, gorder.paid, gorder.status, gorder.pay_type, gorder.pay_time, gorder.third_id, gorder.group_id as order_detail_id,gorder.is_mobile_pay, gorder.balance_pay, gorder.payment_money, gorder.card_id, gorder.merchant_balance, gorder.is_pay_bill ,g.pic as image FROM " . C('DB_PREFIX') . "group_order gorder LEFT JOIN ".C('DB_PREFIX') . "group g ON gorder.group_id=g.group_id WHERE ".$groupcondition.") as godetail LEFT JOIN ".C('DB_PREFIX') . "merchant merchant ON godetail.mer_id=merchant.mer_id";
	   $sql .= " ORDER BY dateline DESC LIMIT {$p->firstRow}, {$p->listRows}";
	   //print_r(D("")->getLastSql());
	   $res = $mode->query($sql);
	   return $res;
   }
   
   
   
    public function getMobilePinOrderList($uid,$status,$is_wap=false){

        $groupcondition="`gorder`.`uid`='$uid' AND `gorder`.`sun_id` IS NOT NULL AND `gorder`.`is_lottery_group` <> '1'";
     //   $mealcondition="`mo`.`uid`='$uid'";

        if($status==1){
            $groupcondition.=" AND `gorder`.`paid`='0'";
          //  $mealcondition.=" AND `mo`.`paid`='0'";
        }elseif($status==2){
            $groupcondition.=" AND `gorder`.`paid`='1'";
            $groupcondition .= " AND `gorder`.`user_confirm`='0'";
          //  $mealcondition.= " AND `mo`.`paid`='1'";
          //  $mealcondition.= " AND `mo`.`user_confirm`='0'";
        }elseif($status==3){
            $groupcondition .= " AND `gorder`.`paid`='1'";
            $groupcondition .= " AND `gorder`.`status`='1'";
            $groupcondition .= " AND `gorder`.`user_confirm`='1'";
        //    $mealcondition.= " AND `mo`.`paid`='1'";
         //   $mealcondition.= " AND `mo`.`status`='1'";
        //    $mealcondition.= " AND `mo`.`user_confirm`='1'";
        }elseif($status==4){
            $groupcondition .= " AND `gorder`.`paid`='1'";
            $groupcondition .= " AND `gorder`.`status`='2'";
          //  $mealcondition.= " AND `mo`.`paid`='1'";
          //  $mealcondition.= " AND `mo`.`status`='2'";
        }else{
            $groupcondition.=" AND `gorder`.`status`<=3";
         //   $mealcondition.= " AND `mo`.`status`<'3'";
        }
     //   $count1 = D('Meal_order')->alias("mo")->where($mealcondition)->count();
        $count2 = D('Group_order')->alias("gorder")->where($groupcondition)->count();
	//	echo $count2; die;

        $allcount=$count2;
        //加入页码最大限制，超过最大值返回空
        $req_page=$_GET['p'];
        $max_page=ceil($allcount/15);
        if($req_page>$max_page){
            return "";
        }
        import('@.ORG.group_page');

        $p = new Page($count2, 15,'p');

        $mode=new Model();
        //用UNION ALL查询
        // $sql = "SELECT 1 as name, mo.order_id, s.name as order_name, mo.uid, mo.mer_id, mo.store_id, mo.phone, mo.total, (mo.balance_pay+mo.payment_money) as price, mo.price as order_price, mo.dateline,mo.paid, mo.status, mo.pay_type, mo.pay_time, mo.third_id, mo.is_mobile_pay, mo.balance_pay, mo.payment_money, mo.card_id, mo.merchant_balance, mo.is_pay_bill,s.pic_info as image  FROM " . C('DB_PREFIX') . "meal_order mo LEFT JOIN ".C('DB_PREFIX') . "merchant_store s ON mo.store_id=s.store_id WHERE ".$mealcondition;
        // $sql .= ' UNION ALL ';
        // $sql .= "SELECT 2 as name, gorder.order_id, gorder.order_name, gorder.uid, gorder.mer_id, gorder.store_id,gorder.phone, gorder.num as total, (gorder.balance_pay+gorder.payment_money) as price, gorder.total_money as order_price, gorder.add_time as dateline, gorder.paid, gorder.status, gorder.pay_type, gorder.pay_time, gorder.third_id, gorder.is_mobile_pay, gorder.balance_pay, gorder.payment_money, gorder.card_id, gorder.merchant_balance, gorder.is_pay_bill ,g.pic as image FROM " . C('DB_PREFIX') . "group_order gorder LEFT JOIN ".C('DB_PREFIX') . "group g ON gorder.group_id=g.group_id WHERE ".$groupcondition;
        // $sql .= " ORDER BY dateline DESC LIMIT {$p->firstRow}, {$p->listRows}";
      //  $sql = "SELECT modetail.*,merchant.name as merchant_name from (SELECT 1 as name, 1 as tuan_type,2 as group_pass,mo.user_confirm,mo.order_id, s.name as order_name, mo.uid, mo.mer_id, mo.store_id, mo.phone, mo.total, (mo.balance_pay+mo.payment_money) as price, mo.price as order_price, mo.dateline,mo.paid, mo.status, mo.pay_type, mo.pay_time, mo.third_id, mo.store_id as order_detail_id,mo.is_mobile_pay, mo.balance_pay, mo.payment_money, mo.card_id, mo.merchant_balance, mo.is_pay_bill,s.pic_info as image  FROM " . C('DB_PREFIX') . "meal_order mo LEFT JOIN ".C('DB_PREFIX') . "merchant_store s ON mo.store_id=s.store_id WHERE ".$mealcondition.") as modetail LEFT JOIN ".C('DB_PREFIX') . "merchant merchant ON modetail.mer_id=merchant.mer_id";
     //   $sql .= ' UNION ALL ';
        $sql="";
        $sql .= "SELECT godetail.*,merchant.name as merchant_name from (SELECT 2 as name, gorder.tuan_type as tuan_type,gorder.group_pass as group_pass,gorder.user_confirm,gorder.order_id, gorder.order_name, gorder.uid, gorder.mer_id, gorder.store_id,gorder.phone, gorder.num as total, (gorder.balance_pay+gorder.payment_money) as price, gorder.total_money as order_price, gorder.add_time as dateline, gorder.paid, gorder.status, gorder.pay_type, gorder.pay_time, gorder.third_id, gorder.group_id as order_detail_id,gorder.is_mobile_pay, gorder.balance_pay, gorder.payment_money, gorder.card_id, gorder.merchant_balance, gorder.is_pay_bill ,g.pic as image FROM " . C('DB_PREFIX') . "group_order gorder LEFT JOIN ".C('DB_PREFIX') . "group g ON gorder.group_id=g.group_id WHERE ".$groupcondition.") as godetail LEFT JOIN ".C('DB_PREFIX') . "merchant merchant ON godetail.mer_id=merchant.mer_id";
        $sql .= " ORDER BY dateline DESC LIMIT {$p->firstRow}, {$p->listRows}";
        //print_r(D("")->getLastSql());
        $res = $mode->query($sql);
        return $res;
    }


    public function getMobileLotteryOrderList($uid,$status,$is_wap=false){

        $groupcondition="`gorder`.`uid`='$uid' AND `gorder`.`sun_id`  IS NOT NULL  AND `gorder`.`is_lottery_group` = '1'";
        //   $mealcondition="`mo`.`uid`='$uid'";

        if($status==1){
            $groupcondition.=" AND `gorder`.`paid`='0'";
            //  $mealcondition.=" AND `mo`.`paid`='0'";
        }elseif($status==2){
            $groupcondition.=" AND `gorder`.`paid`='1'";
            $groupcondition .= " AND `gorder`.`user_confirm`='0'";
            //  $mealcondition.= " AND `mo`.`paid`='1'";
            //  $mealcondition.= " AND `mo`.`user_confirm`='0'";
        }elseif($status==3){
            $groupcondition .= " AND `gorder`.`paid`='1'";
            $groupcondition .= " AND `gorder`.`status`='1'";
            $groupcondition .= " AND `gorder`.`user_confirm`='1'";
            //    $mealcondition.= " AND `mo`.`paid`='1'";
            //   $mealcondition.= " AND `mo`.`status`='1'";
            //    $mealcondition.= " AND `mo`.`user_confirm`='1'";
        }elseif($status==4){
            $groupcondition .= " AND `gorder`.`paid`='1'";
            $groupcondition .= " AND `gorder`.`status`='2'";
            //  $mealcondition.= " AND `mo`.`paid`='1'";
            //  $mealcondition.= " AND `mo`.`status`='2'";
        }else{
            $groupcondition.=" AND `gorder`.`status`<=3";
            //   $mealcondition.= " AND `mo`.`status`<'3'";
        }
        //   $count1 = D('Meal_order')->alias("mo")->where($mealcondition)->count();
        $count2 = D('Group_order')->alias("gorder")->where($groupcondition)->count();

        $allcount=$count2;
        //加入页码最大限制，超过最大值返回空
        $req_page=$_GET['p'];
        $max_page=ceil($allcount/15);
        if($req_page>$max_page){
            return "";
        }
        import('@.ORG.group_page');

        $p = new Page($count2, 15,'p');

        $mode=new Model();
        //用UNION ALL查询
        // $sql = "SELECT 1 as name, mo.order_id, s.name as order_name, mo.uid, mo.mer_id, mo.store_id, mo.phone, mo.total, (mo.balance_pay+mo.payment_money) as price, mo.price as order_price, mo.dateline,mo.paid, mo.status, mo.pay_type, mo.pay_time, mo.third_id, mo.is_mobile_pay, mo.balance_pay, mo.payment_money, mo.card_id, mo.merchant_balance, mo.is_pay_bill,s.pic_info as image  FROM " . C('DB_PREFIX') . "meal_order mo LEFT JOIN ".C('DB_PREFIX') . "merchant_store s ON mo.store_id=s.store_id WHERE ".$mealcondition;
        // $sql .= ' UNION ALL ';
        // $sql .= "SELECT 2 as name, gorder.order_id, gorder.order_name, gorder.uid, gorder.mer_id, gorder.store_id,gorder.phone, gorder.num as total, (gorder.balance_pay+gorder.payment_money) as price, gorder.total_money as order_price, gorder.add_time as dateline, gorder.paid, gorder.status, gorder.pay_type, gorder.pay_time, gorder.third_id, gorder.is_mobile_pay, gorder.balance_pay, gorder.payment_money, gorder.card_id, gorder.merchant_balance, gorder.is_pay_bill ,g.pic as image FROM " . C('DB_PREFIX') . "group_order gorder LEFT JOIN ".C('DB_PREFIX') . "group g ON gorder.group_id=g.group_id WHERE ".$groupcondition;
        // $sql .= " ORDER BY dateline DESC LIMIT {$p->firstRow}, {$p->listRows}";
        //  $sql = "SELECT modetail.*,merchant.name as merchant_name from (SELECT 1 as name, 1 as tuan_type,2 as group_pass,mo.user_confirm,mo.order_id, s.name as order_name, mo.uid, mo.mer_id, mo.store_id, mo.phone, mo.total, (mo.balance_pay+mo.payment_money) as price, mo.price as order_price, mo.dateline,mo.paid, mo.status, mo.pay_type, mo.pay_time, mo.third_id, mo.store_id as order_detail_id,mo.is_mobile_pay, mo.balance_pay, mo.payment_money, mo.card_id, mo.merchant_balance, mo.is_pay_bill,s.pic_info as image  FROM " . C('DB_PREFIX') . "meal_order mo LEFT JOIN ".C('DB_PREFIX') . "merchant_store s ON mo.store_id=s.store_id WHERE ".$mealcondition.") as modetail LEFT JOIN ".C('DB_PREFIX') . "merchant merchant ON modetail.mer_id=merchant.mer_id";
        //   $sql .= ' UNION ALL ';
        $sql="";
        $sql .= "SELECT godetail.*,merchant.name as merchant_name from (SELECT 2 as name, gorder.tuan_type as tuan_type,gorder.group_pass as group_pass,gorder.user_confirm,gorder.order_id, gorder.order_name, gorder.uid, gorder.mer_id, gorder.store_id,gorder.phone, gorder.num as total, (gorder.balance_pay+gorder.payment_money) as price, gorder.total_money as order_price, gorder.add_time as dateline, gorder.paid, gorder.status, gorder.pay_type, gorder.pay_time, gorder.third_id, gorder.group_id as order_detail_id,gorder.is_mobile_pay, gorder.balance_pay, gorder.payment_money, gorder.card_id, gorder.merchant_balance, gorder.is_pay_bill ,g.pic as image FROM " . C('DB_PREFIX') . "group_order gorder LEFT JOIN ".C('DB_PREFIX') . "group g ON gorder.group_id=g.group_id WHERE ".$groupcondition.") as godetail LEFT JOIN ".C('DB_PREFIX') . "merchant merchant ON godetail.mer_id=merchant.mer_id";
        $sql .= " ORDER BY dateline DESC LIMIT {$p->firstRow}, {$p->listRows}";
        //print_r(D("")->getLastSql());
        $res = $mode->query($sql);
        return $res;
    }

	public function get_group_list($type,$limit=12,$is_wap=false){
		switch($type){
			case 'index_tui':
				$order = '`g`.`index_tui` DESC,`g`.`index_sort` DESC,`g`.`group_id` DESC';
				break;
			case 'new':
				$order = '`g`.`group_id` DESC';
				break;
			case 'index_sort':
				$order = '`g`.`index_sort` DESC,`g`.`group_id` DESC';
				break;
		}
		$now_time = $_SERVER['REQUEST_TIME'];
		//地区字符串获取
		// if($_SESSION['areaarr']!="all"){
		// $area_idstr=implode(',',$_SESSION['areaarr']);
		// if($type=="index_tui"){
		// 	$group_list = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where("`g`.`index_tui`='1' AND `g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `m`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `m`.`area_id` IN (".$area_idstr.")")->order($order)->limit($limit)->select();
		// }else{
		// //$group_list = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where("`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `m`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'")->order($order)->limit($limit)->select();
		// 	$group_list = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where("`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `m`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `m`.`area_id` IN (".$area_idstr.")")->order($order)->limit($limit)->select();
		// 	}
		// }else{
		//没有地区筛选了
			if($type=="index_tui"){
			$group_list = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where("`g`.`index_tui`='1' AND `g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `m`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`mer_id` <> '621' AND `g`.`mer_id` <> '890' AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3246' AND `g`.`group_id` <> '3254' AND `g`.`group_id` <> '3428' ")->order($order)->limit($limit)->select();
			}else{
			$group_list = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where("`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `m`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `m`.`mer_id` <> '621' AND `m`.`mer_id` <> '890' AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3246' AND `g`.`group_id` <> '3254' AND `g`.`group_id` <> '3428' ")->order($order)->limit($limit)->select();
			}
		//}
		if($group_list){
			$group_image_class = new group_image();

			foreach($group_list as $key=>$value){
				$tmp_pic_arr = explode(';',$value['pic']);
				$group_list[$key]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$key]['url'] = $this->get_group_url($value['group_id'],$is_wap);
				$group_list[$key]['price'] = floatval($value['price']);
				$group_list[$key]['old_price'] = floatval($value['old_price']);
				$group_list[$key]['wx_cheap'] = floatval($value['wx_cheap']);
				$group_list[$key]['sale_count'] = $value['sale_count']+$value['virtual_num'];
			}


			return $group_list;
		}else{
			return false;
		}
	}

	public function get_hits_log($mer_id)
	{

		import('@.ORG.merchant_page');
		$count_group = D('')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'index_group_hits'=>'i'))->where("`g`.`group_id`=`i`.`group_id` AND `g`.`status`='1' AND `g`.`mer_id`='$mer_id'")->count();
		$p = new Page($count_group,C('config.group_page_row'),C('config.group_page_val'));
		$group_list = D('')->field('`g`.`s_name`,`i`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'index_group_hits'=>'i'))->where("`g`.`group_id`=`i`.`group_id` AND `g`.`status`='1' AND `g`.`mer_id`='$mer_id'")->order('`i`.`time` DESC')->limit($p->firstRow.','.$p->listRows)->select();
		if($group_list){
// 			$group_image_class = new group_image();
			foreach($group_list as $key=>$value){
// 				$tmp_pic_arr = explode(';',$value['pic']);
// 				$group_list[$key]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$key]['url'] = $this->get_group_url($value['group_id'],false);
// 				$group_list[$key]['price'] = floatval($value['price']);
// 				$group_list[$key]['old_price'] = floatval($value['old_price']);
// 				$group_list[$key]['wx_cheap'] = floatval($value['wx_cheap']);
			}
			$return['group_list'] = $group_list;
			$return['pagebar'] = $p->show();
			return $return;
		}else{
			return false;
		}
	}
	/*得到指定分店的团购 不得到商家信息*/
	public function get_single_store_group_list($store_id,$limit=6,$is_wap=false){
		$now_time = $_SERVER['REQUEST_TIME'];
		$group_list = D('')->field('`g`.`group_id`,`g`.`name` AS `group_name`,`g`.`price`,`g`.`pic`,`g`.`old_price`,`g`.`wx_cheap`,`g`.`sale_count`,`g`.`virtual_num`,`g`.`end_time`')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_store'=>'gc'))->where("`g`.`group_id`=`gc`.`group_id` AND `gc`.`store_id`='$store_id' AND `g`.`status`='1' AND `g`.`is_group_buy`='0' AND `g`.`type`='1' AND `g`.`group_id`<>'3428' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'")->order('`g`.`sort` DESC,`g`.`group_id` DESC')->limit($limit)->select();
		if($group_list){
			$group_image_class = new group_image();

			foreach($group_list as $key=>$value){
				$tmp_pic_arr = explode(';',$value['pic']);
				$group_list[$key]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$key]['url'] = $this->get_group_url($value['group_id'],$is_wap);
				$group_list[$key]['price'] = floatval($value['price']);
				$group_list[$key]['old_price'] = floatval($value['old_price']);
				$group_list[$key]['wx_cheap'] = floatval($value['wx_cheap']);
				$group_list[$key]['sale_count'] = ($value['sale_count']+$value['virtual_num']);
			}
			return $group_list;
		}else{
			return false;
		}
	}
	/*得到指定分店的团购 且得到商家信息*/
	public function get_store_group_list($store_id,$limit=6,$is_wap=false){
		$now_time = $_SERVER['REQUEST_TIME'];
		$group_list = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`gc`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc'))->where("`g`.`group_id`=`gc`.`group_id` AND `gc`.`store_id`='$store_id' AND `g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`group_id` <> '3428' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `m`.`status`='1'")->order('`g`.`sort` DESC,`g`.`group_id` DESC')->limit($limit)->select();
		if($group_list){
			$group_image_class = new group_image();

			foreach($group_list as $key=>$value){
				$tmp_pic_arr = explode(';',$value['pic']);
				$group_list[$key]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$key]['url'] = $this->get_group_url($value['group_id'],$is_wap);
				$group_list[$key]['price'] = floatval($value['price']);
				$group_list[$key]['old_price'] = floatval($value['old_price']);
				$group_list[$key]['wx_cheap'] = floatval($value['wx_cheap']);
			}
			return $group_list;
		}else{
			return false;
		}
	}
	/*得到批量分类下的团购*/
	public function get_category_arr_group_list($category_list,$limit=6,$is_wap=false){
		if(is_array($category_list)){
			$group_image_class = new group_image();
			$now_time = $_SERVER['REQUEST_TIME'];
			foreach($category_list as $key=>$value){
				$cat_fid = $value['cat_id'];
				if($_SESSION['areaarr']!="all"){
				$area_idstr=implode(',',$_SESSION['areaarr']);
				$group_list = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where("`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`cat_fid`='$cat_fid' AND `m`.`status`='1'  AND `m`.`area_id` in (".$area_idstr.")")->order('`g`.`index_sort` DESC,`g`.`group_id` DESC')->limit($limit)->select();
				}else{
					$group_list=D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where("`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`cat_fid`='$cat_fid' AND `m`.`status`='1'")->order('`g`.`index_sort` DESC,`g`.`group_id` DESC')->limit($limit)->select();
				}
				//print_r(D('')->getLastSql());
				//$group_list = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where("`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`cat_fid`='$cat_fid' AND `m`.`status`='1'")->order('`g`.`index_sort` DESC,`g`.`group_id` DESC')->limit($limit)->select();
				if($group_list){
					foreach($group_list as $k=>$v){
						$tmp_pic_arr = explode(';',$v['pic']);
						$group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
						$group_list[$k]['url'] = $this->get_group_url($v['group_id'],$is_wap);
						$group_list[$k]['price'] = floatval($v['price']);
						$group_list[$k]['old_price'] = floatval($v['old_price']);
						$group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
					}
					$category_list[$key]['group_list'] = $group_list;
				}
			}




          //删除非当前地区的数据
         //print_r($category_list);
          // foreach($category_list as $k2=>$v2)
          // {
          // 	//print_r($v2);
          //     foreach($category_list[$k2]['group_list'] as $k=>$v)
          //     {
          //         if(!in_array($v['area_id'],$_SESSION['areaarr']))
          //         {
          //             unset($category_list[$k2]['group_list'][$k]);    //删除非当前地区的数据
          //         }
          //     }
          // }
          //删除非当前地区的数据

			return $category_list;
		}else{
			return false;
		}
	}
	/*得到指定分类ID或分类父ID下的分类，带有分页功能*/
	public function get_group_list_by_catid($get_grouplist_catid,$get_grouplist_catfid,$cat_url,$area_id,$circle_id,$order,$attrs,$category_cat_field){
		if($_SESSION['areaarr']!="all"){
		$area_idstr=implode(',',$_SESSION['areaarr']);
		$now_time = $_SERVER['REQUEST_TIME'];
		$condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (".$area_idstr.")  AND `g`.`mer_id` <> '890'  AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3246' AND `g`.`group_id` <> '3428' AND `g`.`group_id` <> '3254' ";
		}else{
		$now_time = $_SERVER['REQUEST_TIME'];
		$condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'  AND `g`.`mer_id` <> '890' AND `g`.`group_id` <> '3246' AND `g`.`group_id` <> '3254' AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3428' ";
		}
		//分类相关
		if(!empty($get_grouplist_catfid)){
			$condition_where .= " AND `g`.`cat_fid`='$get_grouplist_catfid'";
		}else if(!empty($get_grouplist_catid)){
			$condition_where .= " AND `g`.`cat_id`='$get_grouplist_catid'";
		}

		//区域或商圈
		if($circle_id){
			$condition_where .= " AND `gc`.`circle_id`='$circle_id' AND `gc`.`group_id`=`g`.`group_id`";
			$condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc');
			$condition_field  = 'DISTINCT `g`.`group_id`,`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
		}else if($area_id){
			$condition_where .= " AND `gc`.`area_id`='$area_id' AND `gc`.`group_id`=`g`.`group_id`";
			$condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc');
			$condition_field  = 'DISTINCT `g`.`group_id`,`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
		}else{
			$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
			$condition_field  = '`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
		}

		//自定义字段
		/*if(!empty($attrs)){
			$attrs_tmp_arr_old = explode(';',$attrs);
			if(!empty($attrs_tmp_arr_old)){
				foreach($attrs_tmp_arr_old as $key=>$value){
					$attrs_tmp_str = explode(':',$value);
					$attrs_arr[$attrs_tmp_str[0]] = $attrs_tmp_str[1];
				}
			}
			$cat_field_arr = unserialize($category_cat_field);
			foreach($cat_field_arr as $key=>$value){
				if(empty($value['use_field']) && isset($attrs_arr[$value['url']])){
					if($value['type'] == 0){
						$tmp_custom_value = $attrs_arr[$value['url']];
						$condition_where .= ' AND `g`.`custom_'.$key."`='$tmp_custom_value'";
					}else if($value['type'] == 1){
						$tmp_custom_value = $attrs_arr[$value['url']];
						$tmp_custom_arr = explode(',',$tmp_custom_value);
						foreach($tmp_custom_arr as $k=>$v){
							$condition_where .= " AND FIND_IN_SET('$v',`g`.`custom_".$key."`)";
						}

					}
				}
			}
		}*/
		//echo $condition_where;

		//排序
		switch($order){
			case 'price-asc':
				$order = '`g`.`price` ASC,`g`.`group_id` DESC';
				break;
			case 'price-desc':
				$order = '`g`.`price` DESC,`g`.`group_id` DESC';
				break;
			case 'hot':
				$order = '`g`.`sale_count` DESC,`g`.`group_id` DESC';
				break;
			case 'rating':
				$order = '`g`.`score_mean` DESC,`g`.`group_id` DESC';
				break;
			case 'time':
				$order = '`g`.`last_time` DESC,`g`.`group_id` DESC';
				break;
			default:
				$order = '`g`.`sort` DESC,`g`.`group_id` DESC';
		}

		import('@.ORG.group_page');
		$count_group = D('')->table($condition_table)->where($condition_where)->count();
		$p = new Page($count_group,C('config.group_page_row'),C('config.group_page_val'));
		$group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();

		$return['pagebar'] = $p->show();

		if($group_list){
			$group_image_class = new group_image();
			foreach($group_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$k]['url'] = C('config.site_url').'/group/'.$v['group_id'].'.html';
				$group_list[$k]['price'] = floatval($v['price']);
				$group_list[$k]['old_price'] = floatval($v['old_price']);
				$group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
			}
		}


        //删除非当前地区的数据
        //  print_r($group_list);
        // foreach($group_list as $k=>$v)
        // {
        //         if(!in_array($v['area_id'],$_SESSION['areaarr']))
        //         {
        //              unset($group_list[$k]);    //删除非当前地区的数据
        //         }

        // }
        //删除非当前地区的数据










		$return['group_list'] = $group_list;

		return $return;
	}

	/*得到团购搜索列表，带有分页功能*/
	public function get_group_list_by_keywords($keywords,$order,$is_wap=false){
		$now_time = $_SERVER['REQUEST_TIME'];
		$condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `m`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND (`g`.`name` LIKE '%$keywords%' OR `m`.`name` like '%$keywords%' OR `g`.`s_name` LIKE '%$keywords%' ) AND `g`.`mer_id` <> '747' AND `g`.`mer_id` <> '890'  AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3246' AND `g`.`group_id` <> '3254' AND `g`.`group_id` <> '3428' ";
		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
		$condition_field  = '`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';

		//排序
		switch($order){
			case 'price-asc':
			case 'price':
				$order = '`g`.`price` ASC,`g`.`group_id` DESC';
				break;
			case 'price-desc':
				$order = '`g`.`price` DESC,`g`.`group_id` DESC';
				break;
			case 'hot':
				$order = '`g`.`sale_count` DESC,`g`.`group_id` DESC';
				break;
			case 'rating':
				$order = '`g`.`score_mean` DESC,`g`.`group_id` DESC';
				break;
			case 'time':
				$order = '`g`.`last_time` DESC,`g`.`group_id` DESC';
				break;
			default:
				$order = '`g`.`sort` DESC,`g`.`group_id` DESC';
		}

		if(empty($is_wap)){
			import('@.ORG.group_search_page');
		}else{
			import('@.ORG.wap_group_search_page');
		}

		$count_group = D('')->table($condition_table)->where($condition_where)->count();
      //  $log =D()->getLastSql();
       // echo  "<script> console.log( $log)</script>" ;
		$p = new Page($count_group,C('config.group_page_row'),C('config.group_page_val'));
		$group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();
		$return['totalPage'] = $p->totalPage;
		$return['pagebar'] = $p->show();
		$return['group_count'] = $count_group;
		if($group_list){
			$group_image_class = new group_image();
			foreach($group_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$group_list[$k]['merchant_name'] = str_replace($keywords,'<em>'.$keywords.'</em>',$v['merchant_name']);
				$group_list[$k]['group_name'] = str_replace($keywords,'<em>'.$keywords.'</em>',$v['group_name']);
				$group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$k]['url'] = $this->search_get_group_url($v['group_id'],$is_wap,$keywords);
				$group_list[$k]['price'] = floatval($v['price']);
				$group_list[$k]['old_price'] = floatval($v['old_price']);
				$group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
			}
		}
		$return['group_list'] = $group_list;

		return $return;
	}

	/*得到团购搜索列表，带有分页功能*/
	public function get_group_list_by_group_ids($groupids, $order, $is_wap=false){
		$groupids = "'" . implode("','", $groupids) . "'";
		$now_time = $_SERVER['REQUEST_TIME'];
		$condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `m`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`group_id` IN ($groupids)";
		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
		$condition_field  = '`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';

		//排序
		switch($order){
			case 'price-asc':
				$order = '`g`.`price` ASC,`g`.`group_id` DESC';
				break;
			case 'price-desc':
				$order = '`g`.`price` DESC,`g`.`group_id` DESC';
				break;
			case 'hot':
				$order = '`g`.`sale_count` DESC,`g`.`group_id` DESC';
				break;
			case 'rating':
				$order = '`g`.`score_mean` DESC,`g`.`group_id` DESC';
				break;
			case 'time':
				$order = '`g`.`last_time` DESC,`g`.`group_id` DESC';
				break;
			default:
				$order = '`g`.`sort` DESC,`g`.`group_id` DESC';
		}

		if(empty($is_wap)){
			import('@.ORG.group_search_page');
		}else{
			import('@.ORG.wap_group_search_page');
		}

		$count_group = D('')->table($condition_table)->where($condition_where)->count();
		$p = new Page($count_group,C('config.group_page_row'),C('config.group_page_val'));
		$group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();

		$return['pagebar'] = $p->show();
		$return['group_count'] = $count_group;
		if($group_list){
			$group_image_class = new group_image();
			foreach($group_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$group_list[$k]['merchant_name'] = str_replace($keywords,'<em>'.$keywords.'</em>',$v['merchant_name']);
				$group_list[$k]['group_name'] = str_replace($keywords,'<em>'.$keywords.'</em>',$v['group_name']);
				$group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$k]['url'] = $this->search_get_group_url($v['group_id'],$is_wap,$keywords);
				$group_list[$k]['price'] = floatval($v['price']);
				$group_list[$k]['old_price'] = floatval($v['old_price']);
				$group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
			}
		}
		$return['group_list'] = $group_list;

		return $return;
	}

	/*wap版得到指定分类ID或分类父ID下的分类，带有分页功能*/
	public function wap_get_group_list_by_catid($get_grouplist_catid,$get_grouplist_catfid,$area_id,$order, $lat = 0, $long = 0, $circle_id = 0){
		$now_time = $_SERVER['REQUEST_TIME'];
		$condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`is_group_buy`='0' AND `g`.`type`='1' AND `m`.`status`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`mer_id` <> '747' AND `g`.`mer_id` <> '621' AND `g`.`mer_id` <> '890' AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3246' AND `g`.`group_id` <> '3254' AND `g`.`group_id` <> '3428'";
		//分类相关
		if(!empty($get_grouplist_catfid)){
			$condition_where .= " AND `g`.`cat_fid`='$get_grouplist_catfid'";
		}else if(!empty($get_grouplist_catid)){
			$condition_where .= " AND `g`.`cat_id`='$get_grouplist_catid'";
		}

		//区域
		if($area_id || $circle_id){
			$condition_field  = 'DISTINCT `g`.`group_id`,`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
			if ($circle_id) {
				$condition_where .= " AND `gc`.`circle_id`='$circle_id' AND `gc`.`group_id`=`g`.`group_id`";
			} else {
				$condition_where .= " AND `gc`.`area_id`='$area_id' AND `gc`.`group_id`=`g`.`group_id`";
			}
			if ($order == 'juli') {
				$condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc', C('DB_PREFIX').'merchant_store'=>'s');
				$condition_where .= " AND `m`.`mer_id`=`s`.`mer_id`";
				$condition_field .= ", ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS juli";
			} else {
				$condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc');
			}


		}else{
			$condition_field  = '`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
			if ($order == 'juli') {
				$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'merchant_store'=>'s');
				$condition_where .= " AND `m`.`mer_id`=`s`.`mer_id`";
				$condition_field .= ", ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS juli";
			} else {
				$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
			}

		}

		//排序
		switch($order){
			case 'price':
				$order = '`g`.`price` ASC,`g`.`group_id` DESC';
				break;
			case 'priceDesc':
				$order = '`g`.`price` DESC,`g`.`group_id` DESC';
				break;
			case 'solds':
				$order = '`g`.`sale_count` DESC,`g`.`group_id` DESC';
				break;
			case 'rating':
				$order = '`g`.`score_mean` DESC,`g`.`group_id` DESC';
				break;
			case 'start':
				$order = '`g`.`last_time` DESC,`g`.`group_id` DESC';
				break;
			case 'juli':
				$order = 'juli asc,`g`.`group_id` DESC';
				break;
// 			default:
// 				$order = 'juli asc,`g`.`group_id` DESC';
			default:
				$order = '`g`.`sort` DESC,`g`.`group_id` DESC';
		}

		import('@.ORG.wap_group_page');
		$count_group = D('')->table($condition_table)->where($condition_where)->count();
		$p = new Page($count_group,C('config.group_page_row'),C('config.group_page_val'));
		$group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->group('`g`.`group_id`, `m`.`mer_id`')->limit($p->firstRow.','.$p->listRows)->select();
// 		echo D('')->_sql();
		$return['pagebar'] = $p->show();

		if($group_list){
			$group_image_class = new group_image();
			foreach($group_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$k]['url'] = $this->get_group_url($v['group_id'],true);
				$group_list[$k]['price'] = floatval($v['price']);
				$group_list[$k]['old_price'] = floatval($v['old_price']);
				$group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
				$group_list[$k]['sale_count'] = $v['sale_count']+$v['virtual_num'];
			}
		}
		$return['group_list'] = $group_list;   
		$return['group_count'] = $count_group;
		$return['totalPage'] = ceil($count_group/C('config.group_page_row'));
		return $return;
	}

	/*wap版得到指定分类ID或分类父ID下的分类，带有分页功能*/
	public function wap_get_storeList_by_catid($get_grouplist_catid,$get_grouplist_catfid,$area_id,$order, $lat = 0, $long = 0, $circle_id = 0){
		$now_time = $_SERVER['REQUEST_TIME'];
		$condition_where = "`g`.`status`='1' AND `g`.`is_group_buy`='0' AND `g`.`type`='1' AND `s`.`status`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `gc`.`group_id`=`g`.`group_id` AND `gc`.`store_id`=`s`.`store_id` AND `g`.`mer_id` <> '629' AND `s`.`store_id` <> '700' AND `g`.`mer_id` <> '621' AND `g`.`mer_id` <> '890' AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3246'  AND `g`.`group_id` <> '3254' AND `g`.`group_id` <> '3428' ";
		//分类相关
		if(!empty($get_grouplist_catfid)){
			$condition_where .= " AND `g`.`cat_fid`='$get_grouplist_catfid'";
		}else if(!empty($get_grouplist_catid)){
			$condition_where .= " AND `g`.`cat_id`='$get_grouplist_catid'";
		}
		$condition_field  = '`s`.`store_id`,`s`.`name` AS `store_name`,`s`.`pic_info`';
		$condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_store'=>'gc', C('DB_PREFIX').'merchant_store'=>'s');
		//区域
		if($area_id || $circle_id){
			if ($circle_id) {
				$condition_where .= " AND `gc`.`circle_id`='$circle_id' AND `gc`.`group_id`=`g`.`group_id`";
			} else {
				$condition_where .= " AND `gc`.`area_id`='$area_id' AND `gc`.`group_id`=`g`.`group_id`";
			}
			if ($order == 'juli') {
				$condition_field .= ", ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS juli";
			}
		}else{
			if ($order == 'juli') {
				$condition_field .= ", ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS juli";
			}

		}


		//排序
		switch($order){
			case 'price':
				$order = '`g`.`price` ASC,`g`.`group_id` DESC';
				break;
			case 'priceDesc':
				$order = '`g`.`price` DESC,`g`.`group_id` DESC';
				break;
			case 'solds':
				$order = '`g`.`sale_count` DESC,`g`.`group_id` DESC';
				break;
			case 'rating':
				$order = '`g`.`score_mean` DESC,`g`.`group_id` DESC';
				break;
			case 'start':
				$order = '`g`.`last_time` DESC,`g`.`group_id` DESC';
				break;
			case 'juli':
				$order = '`juli` asc,`g`.`group_id` DESC';
				break;
			default:
				$order = '`g`.`sort` DESC,`g`.`group_id` DESC';
		}

		import('@.ORG.wap_group_page');
		$count_group = D('')->table($condition_table)->where($condition_where)->count('DISTINCT `s`.`store_id`');

		$p = new Page($count_group,10,'page');
		$store_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->group('`s`.`store_id`')->order($order)->limit($p->firstRow.','.$p->listRows)->select();
		$return['totalPage'] = ceil($count_group/10);
	// echo D('')->_sql();
		if($store_list){
			foreach($store_list as $k=>$v){
				$store_list[$k]['url'] = U('Group/shop',array('store_id'=>$v['store_id']));
			}
		}
		$return['store_list'] = $store_list;
		$return['store_count'] = count($store_list);

		return $return;
	}

	/*得到指定分类ID或分类父ID下的分类，带有分页功能*/
	public function get_group_collect_list($uid){
		$now_time = $_SERVER['REQUEST_TIME'];
		$condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`group_id`=`c`.`id` AND `c`.`uid`='$uid' AND `c`.`type`='group_detail'";

		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'user_collect'=>'c');
		$condition_field  = '`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';

		$order = '`c`.`collect_id` DESC';

		import('@.ORG.collect_page');
		$count_group = D('')->table($condition_table)->where($condition_where)->count();
		$p = new Page($count_group,10,'page');
		$group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();

		$return['pagebar'] = $p->show();

		if($group_list){
			$group_image_class = new group_image();
			foreach($group_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$k]['url'] = $this->get_group_url($v['group_id'],false);
				$group_list[$k]['price'] = floatval($v['price']);
				$group_list[$k]['old_price'] = floatval($v['old_price']);
				$group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
			}
		}
		$return['group_list'] = $group_list;

		return $return;
	}

	/*wap版得到指定分类ID或分类父ID下的分类，带有分页功能*/
	public function wap_get_group_collect_list($uid){
		$now_time = $_SERVER['REQUEST_TIME'];
		$condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`group_id`=`c`.`id` AND `c`.`uid`='$uid' AND `c`.`type`='group_detail'";

		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'user_collect'=>'c');
		$condition_field  = '`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';

		$order = '`c`.`collect_id` DESC';

		import('@.ORG.wap_collect_page');
		$count_group = D('')->table($condition_table)->where($condition_where)->count();
		$p = new Page($count_group,10,'page');
		$group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();

		$return['pagebar'] = $p->show();

		if($group_list){
			$group_image_class = new group_image();
			foreach($group_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$k]['url'] = $this->get_group_url($v['group_id'],true);
				$group_list[$k]['price'] = floatval($v['price']);
				$group_list[$k]['old_price'] = floatval($v['old_price']);
				$group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
			}
		}
		$return['group_list'] = $group_list;

		return $return;
	}

	public function get_group_by_groupId($group_id,$other=''){
		
		$condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1' AND `g`.`group_id`='$group_id'";
		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
		$condition_field  = '`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
		$database = D('');
		$now_group = D('')->field($condition_field)->table($condition_table)->where($condition_where)->find();
		if(!empty($now_group)){
			$now_group['price'] = floatval($now_group['price']);
			$now_group['old_price'] = floatval($now_group['old_price']);
			$now_group['wx_cheap'] = floatval($now_group['wx_cheap']);
			$now_group['secondprice']=floatval($now_group['secondprice']);
			$now_group['url'] = C('config.site_url').'/group/'.$now_group['group_id'].'.html';
			$now_group['buy_url'] = C('config.site_url').'/group/buy/'.$now_group['group_id'].'.html';

			$group_image_class = new group_image();
			$now_group['all_pic'] = $group_image_class->get_allImage_by_path($now_group['pic']);
            $now_group['all_thumb'] = $group_image_class->get_allImage_by_path($now_group['picthumb']);

			$now_group['store_list'] = D('Group_store')->get_storelist_by_groupId($now_group['group_id']);
			if(count($now_group['store_list']) == 1){
				$now_group['store_list'][0]['area'] = D('Area')->get_area_by_areaId($now_group['store_list'][0]['area_id']);
				$now_group['store_list'][0]['circle'] = D('Area')->get_area_by_areaId($now_group['store_list'][0]['circle_id']);
			}

			if($other){
				$condition_group['group_id'] = $group_id;
				switch($other){
					case 'hits-setInc':
						$this->where($condition_group)->setInc('hits');
						break;
				}
			}
		}
		return $now_group;
	}
	public function get_grouplist_by_MerchantId($mer_id,$limit=0,$is_wap=false,$group_id=0){
		$now_time = $_SERVER['REQUEST_TIME'];
		$condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`mer_id`='$mer_id'";
		if(!empty($group_id)){
			$condition_where .= " AND `g`.`group_id`<>'$group_id'";
		}
		$group_list = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where($condition_where)->order('`g`.`sort` DESC,`g`.`group_id` DESC')->limit($limit)->select();
		if($group_list){
			$group_image_class = new group_image();
			foreach($group_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$k]['url'] = $this->get_group_url($v['group_id'],$is_wap);
				$group_list[$k]['price'] = floatval($v['price']);
				$group_list[$k]['old_price'] = floatval($v['old_price']);
				$group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
			}
		}
		return $group_list;
	}

    public function get_groupbuylist_by_MerchantId($mer_id,$limit=0,$is_wap=false,$group_id=0){
        $now_time = $_SERVER['REQUEST_TIME'];
        $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1' AND `g`.`is_group_buy`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`mer_id`='$mer_id'";
        if(!empty($group_id)){
            $condition_where .= " AND `g`.`group_id`<>'$group_id'";
        }
        $group_list = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where($condition_where)->order('`g`.`sort` DESC,`g`.`group_id` DESC')->limit($limit)->select();
        if($group_list){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_groupbuy_url($v['group_id'],$is_wap);
                $group_list[$k]['price'] = floatval($v['price']);
                $group_list[$k]['old_price'] = floatval($v['old_price']);
                $group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
            }
        }
        return $group_list;
    }
	/*得到分类下的团购*/
	public function get_grouplist_by_catId($cat_id,$cat_fid,$limit=6,$is_wap=false,$sort=''){

		if($_SESSION['areaarr']!="all"){
		$area_idstr=implode(',',$_SESSION['areaarr']);
		$now_time = $_SERVER['REQUEST_TIME'];
		$condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `m`.`area_id` in (".$area_idstr.") AND `g`.`mer_id` <> '747' AND `g`.`mer_id` <> '890' AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3246' AND `g`.`group_id` <> '3254' AND `g`.`group_id` <> '3428' ";
		}else{
		$now_time = $_SERVER['REQUEST_TIME'];
		$condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`is_group_buy`='0' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`mer_id` <> '747' AND `g`.`group_id` <> '3254' AND `g`.`mer_id` <> '890' AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3428' ";
		}
		// $now_time = $_SERVER['REQUEST_TIME'];
		// $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'";
		if(empty($cat_fid) && !empty($cat_id)){
			$condition_where .= " AND `g`.`cat_fid`='$cat_id'";
		}else if(!empty($cat_id)){
			$condition_where .= " AND `g`.`cat_id`='$cat_id'";
		}
		if(empty($sort)){
			$condition_sort = "'`g`.`sort` DESC,`g`.`group_id` DESC'";
		}else{
			$condition_sort = $sort;
		}

		$group_list = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where($condition_where)->order($condition_sort)->limit($limit)->select();
		if($group_list){
			$group_image_class = new group_image();
			foreach($group_list as $k=>$v){
                if(!empty($v["picthumb"])){
                    $tmp_pic_arr = explode(';',$v['picthumb']);
                }
                elseif (!empty($v["picapp"])){
                    $tmp_pic_arr = explode(';',$v['picapp']);

                }else{
                    $tmp_pic_arr = explode(';',$v['pic']);
                }
				//$tmp_pic_arr = explode(';',$v['pic']);
				$group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$k]['url'] = $this->get_group_url($v['group_id'],$is_wap);
				$group_list[$k]['price'] = floatval($v['price']);
				$group_list[$k]['old_price'] = floatval($v['old_price']);
				$group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
			}
		}



        //删除非当前地区的数据
       // print_r($group_list);
       // echo $group_list['0']['area_id'];
      /*foreach($group_list as $k=>$v)
        {
            if(!in_array($v['area_id'],$_SESSION['areaarr']))
             {
                // echo $v['area_id'].'|';
                 unset($v);  //删除非当前地区的数据

              }
        }*/
        //删除非当前地区的数据



		return $group_list;
	}

    /*得到分类下的拼团*/
    public function get_groupbuylist_by_catId($cat_id,$cat_fid,$limit=6,$is_wap=false,$sort=''){

        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1' AND `g`.`is_group_buy`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `m`.`area_id` in (".$area_idstr.")";
        }else{
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1'  AND `g`.`is_group_buy`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'";
        }
        // $now_time = $_SERVER['REQUEST_TIME'];
        // $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `m`.`status`='1' AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'";
        if(empty($cat_fid) && !empty($cat_id)){
            $condition_where .= " AND `g`.`cat_fid`='$cat_id'";
        }else if(!empty($cat_id)){
            $condition_where .= " AND `g`.`cat_id`='$cat_id'";
        }
        if(empty($sort)){
            //$condition_sort = "'`g`.`sort` DESC,`g`.`group_id` DESC'";
			 $condition_sort = "'`g`.`group_id` DESC'";
        }else{
            $condition_sort = $sort;
        }

        $group_list = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where($condition_where)->order($condition_sort)->limit($limit)->select();
        if($group_list){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_groupbuy_url($v['group_id'],$is_wap);
                $group_list[$k]['price'] = floatval($v['price']);
                $group_list[$k]['old_price'] = floatval($v['old_price']);
                $group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
            }
        }



        //删除非当前地区的数据
        // print_r($group_list);
        // echo $group_list['0']['area_id'];
        /*foreach($group_list as $k=>$v)
          {
              if(!in_array($v['area_id'],$_SESSION['areaarr']))
               {
                  // echo $v['area_id'].'|';
                   unset($v);  //删除非当前地区的数据

                }
          }*/
        //删除非当前地区的数据



        return $group_list;
    }

	/*得到订单列表*/
	public function get_order_list($uid,$status,$is_wap=false){
		$condition_where = "`o`.`uid`='$uid' AND `o`.`group_id`=`g`.`group_id`";

		if($status == '0'){
			$condition_where .= " AND `o`.`status`<=3";
		}else if($status == '-1'){
			$condition_where .= " AND `o`.`paid`='0'";
			$condition_where .= " AND `o`.`status`='0'";
		}else if($status == '1'){
			$condition_where .= " AND `o`.`paid`='1'";
			$condition_where .= " AND `o`.`status`='0'";
		}else if($status == '2'){
			$condition_where .= " AND `o`.`paid`='1'";
			$condition_where .= " AND `o`.`status`='1'";
		}else if($status == '3'){
			$condition_where .= " AND `o`.`paid`='1'";
			$condition_where .= " AND `o`.`status`='2'";
		}
		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o');

		import('@.ORG.user_page');
		$count = $this->where($condition_where)->table($condition_table)->count();
		$p = new Page($count,10);

		$order_list = $this->field('`o`.*,`g`.`s_name`,`g`.`pic`,`g`.`end_time`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->limit($p->firstRow.',10')->select();

		if(!empty($order_list)){
			$group_image_class = new group_image();
			foreach($order_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$order_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$order_list[$k]['url'] = $this->get_group_url($v['group_id'],$is_wap);
				$order_list[$k]['price'] = floatval($v['price']);
				$order_list[$k]['total_money'] = floatval($v['total_money']);
			}
		}

		$return['pagebar'] = $p->show();
		$return['order_list'] = $order_list;

		return $return;
	}
	/*手机版得到订单列表*/
	public function wap_get_order_list($uid,$status = '0'){
		$condition_where = "`o`.`uid`='$uid' AND `o`.`sun_id` is null AND `o`.`group_id`=`g`.`group_id`";

		if($status == '0'){
			$condition_where .= " AND `o`.`status`<=3";
		}else if($status == '-1'){
			$condition_where .= " AND `o`.`paid`='0' AND `status`='0'";
		}else if($status == '1'){
			$condition_where .= " AND `o`.`paid`='1'";
			$condition_where .= " AND `o`.`status`='0'";
		}else if($status == '2'){
			$condition_where .= " AND `o`.`paid`='1'";
			$condition_where .= " AND `o`.`status`='1'";
		}else if($status == '3'){
			$condition_where .= " AND `o`.`paid`='1'";
			$condition_where .= " AND `o`.`status`='2'";
		}
		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o');

		$order_list = $this->field('`o`.*,`g`.`s_name`,`g`.`pic`,`g`.`end_time`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->select();

		if(!empty($order_list)){
			$group_image_class = new group_image();
			foreach($order_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$order_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$order_list[$k]['url'] = $this->get_newgroup_url($v['group_id'],$v['sun_id'],true);
				$order_list[$k]['order_url'] = D('Group_order')->get_order_url($v['order_id'],true);
				$order_list[$k]['price'] = floatval($v['price']);
				$order_list[$k]['total_money'] = floatval($v['total_money']);
			}
		}
		return $order_list;
	}

	/*手机版得到订单列表*/
	public function wap_get_buy_order_list($uid,$status = '0'){
		$condition_where = "`o`.`uid`='$uid' AND `o`.`sun_id` is not null  AND `o`.`group_id`=`g`.`group_id` AND `gb`.`user_id`='$uid' AND `gb`.`sun_id`=`o`.`sun_id`";

		if($status == '0'){
			$condition_where .= " AND `o`.`status`<=3";
		}else if($status == '-1'){
			$condition_where .= " AND `o`.`paid`='0' AND `status`='0'";
		}else if($status == '1'){
			$condition_where .= " AND `o`.`paid`='1'";
			$condition_where .= " AND `o`.`status`='0'";
		}else if($status == '2'){
			$condition_where .= " AND `o`.`paid`='1'";
			$condition_where .= " AND `o`.`status`='1'";
		}else if($status == '3'){
			$condition_where .= " AND `o`.`paid`='1'";
			$condition_where .= " AND `o`.`status`='2'";
		}
		$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o',C('DB_PREFIX').'group_buy'=>'gb');

		$order_list = $this->field('`o`.*,`g`.`s_name`,`g`.`pic`,`g`.`end_time`')->where($condition_where)->table($condition_table)->order('`o`.`add_time` DESC')->select();

		if(!empty($order_list)){
			$group_image_class = new group_image();
			foreach($order_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['pic']);
				$order_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$order_list[$k]['url'] = $this->get_newgroup_url($v['group_id'],$v['sun_id'],true);
				$order_list[$k]['order_url'] = D('Group_order')->get_order_url($v['order_id'],true);
				$order_list[$k]['price'] = floatval($v['price']);
				$order_list[$k]['total_money'] = floatval($v['total_money']);
			}
		}
		return $order_list;
	}

	public function get_newgroup_url($group_id,$sun_id,$is_wap){
        if($is_wap){
            if(!empty($sun_id)) {
                return U('Wap/NewGroup/detail', array('group_id' => $group_id));
            }else{
                return U('Wap/Group/detail', array('group_id' => $group_id));
            }
        }else{
            return C('config.site_url').'/group/'.$group_id.'.html';
        }
    }

	/*得到待评价订单列表*/
	public function get_rate_order_list($uid,$is_rate=false,$is_wap=false){
		$condition_where = "`o`.`uid`='$uid' AND `o`.`group_id`=`g`.`group_id`";
		if($is_rate){
			$condition_where .= " AND `o`.`paid`='1'";
			$condition_where .= " AND `o`.`status`='2'";
			$condition_where .= " AND `r`.`order_type`='0' AND `r`.`order_id`=`o`.`order_id`";
			$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o',C('DB_PREFIX').'reply'=>'r');
			$condition_field = '`o`.*,`g`.`s_name`,`g`.`pic` `group_pic`,`g`.`end_time`,`r`.*';
			$condition_order = '`r`.`pigcms_id` DESC';
		}else{
			$condition_where .= " AND `o`.`paid`='1'";
			$condition_where .= " AND `o`.`status`='1'";
			$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o');
			$condition_field = '`o`.*,`g`.`s_name`,`g`.`pic` `group_pic`,`g`.`end_time`';
			$condition_order = '`o`.`add_time` DESC';
		}

		$order_list = $this->field($condition_field)->where($condition_where)->table($condition_table)->order($condition_order)->select();
		if(!empty($order_list)){
			$group_image_class = new group_image();
			foreach($order_list as $k=>$v){
				$tmp_pic_arr = explode(';',$v['group_pic']);
				$order_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$order_list[$k]['url'] = $this->get_group_url($v['group_id'],$is_wap);
				$order_list[$k]['price'] = floatval($v['price']);
				$order_list[$k]['total_money'] = floatval($v['total_money']);
				if($is_rate){
					$order_list[$k]['comment'] = stripslashes($v['comment']);
					if($v['pic']){
						$tmp_array = explode(',',$v['pic']);
						$order_list[$k]['pic_count'] = count($tmp_array);
					}
				}
			}
		}

		return $order_list;
	}
	public function get_group_url($group_id,$is_wap){
		if($is_wap){
			return U('Wap/Group/detail',array('group_id'=>$group_id));
		}else{
			return C('config.site_url').'/group/'.$group_id.'.html';
		}
	}

    public function get_groupbuy_url($group_id,$is_wap){
        if($is_wap){
            return U('Wap/NewGroup/detail',array('group_id'=>$group_id));
        }else{
            return C('config.site_url').'/newgroup/'.$group_id.'.html';
        }
    }

	public function search_get_group_url($group_id,$is_wap,$keywords){
		if($is_wap){
			return U('Wap/Group/detail',array('group_id'=>$group_id,'keywords'=>urlencode($keywords)));
		}else{
			return C('config.site_url').'/group/'.$group_id.'.html';
		}
	}
	//新增评论详情
	public function get_rated_order($uid,$order_id){
		$condition_where = "`o`.`uid`='$uid' AND `o`.`group_id`=`g`.`group_id` AND `o`.`order_id`=".$order_id;
			$condition_where .= " AND `o`.`paid`='1'";
			$condition_where .= " AND `o`.`status`='2'";
			$condition_where .= " AND `r`.`order_type`='0' AND `r`.`order_id`=`o`.`order_id`";
			$condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'group_order'=>'o',C('DB_PREFIX').'reply'=>'r');
			$condition_field = '`o`.*,`g`.`s_name`,`g`.`pic` `group_pic`,`g`.`end_time`,`r`.*';
			$condition_order = '`r`.`pigcms_id` DESC';

		$order= $this->field($condition_field)->where($condition_where)->table($condition_table)->order($condition_order)->find();
		if(!empty($order)){
			$group_image_class = new group_image();
			$tmp_pic_arr = explode(';',$order['group_pic']);
			$order['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
			$order['url'] = $this->getMobileGroupUrl($order['group_id']);
			$order['price'] = floatval($order['price']);
			$order['total_money'] = floatval($order['total_money']);
			$order['comment'] = stripslashes($order['comment']);
					if($order['pic']){
						$tmp_array = explode(',',$order['pic']);
						$order['pic_count'] = count($tmp_array);
					}
		}
		return $order;
	}
	public function getMobileGroupUrl($group_id){
		return C('config.site_url').'/mobile.php?g=Mobile&c=Group&a=detail&group_id='.$group_id;
	}
	/*增加一次团购评论数*/
	public function setInc_group_reply($now_order,$score){
		$condition_group['group_id'] = $now_order['group_id'];
		$data_group['reply_count'] = $now_order['reply_count']+1;
		$data_group['score_all'] = $now_order['score_all']+$score;
		$data_group['score_mean'] = $data_group['score_all']/$data_group['reply_count'];
		if($this->where($condition_group)->data($data_group)->save()){
			return true;
		}else{
			return false;
		}
	}
	public function get_qrcode($id){
		$condition_group['group_id'] = $id;
		$now_group = $this->field('`group_id`,`qrcode_id`')->where($condition_group)->find();
		if(empty($now_group)){
			return false;
		}
		return $now_group;
	}
	public function save_qrcode($id,$qrcode_id){
		$condition_group['group_id'] = $id;
		$data_group['qrcode_id'] = $qrcode_id;
		if($this->where($condition_group)->data($data_group)->save()){
			return(array('error_code'=>false));
		}else{
			return(array('error_code'=>true,'msg'=>'保存二维码至'.C('config.group_alias_name').'失败！请重试。'));
		}
	}
	public function del_qrcode($id){
		$condition_group['group_id'] = $id;
		$data_group['qrcode_id'] = '';
		if($this->where($condition_group)->data($data_group)->save()){
			return(array('error_code'=>false));
		}else{
			return(array('error_code'=>true,'msg'=>'保存二维码至'.C('config.group_alias_name').'失败！请重试。'));
		}
	}
	/*得到团购的微信优惠*/
	public function get_group_cheap($id){
		$now_group = $this->field('`wx_cheap`')->where(array('group_id'=>$id))->find();
		return floatval($now_group['wx_cheap']);
	}
	//新的获取特卖推荐的方法
	public function new_get_group_list($type,$limit=12,$is_wap=false){
		switch($type){
			case 'index_tui':
				$order = '`g`.`index_tui` DESC,`g`.`group_id` DESC';
				break;
			case 'new':
				$order = '`g`.`group_id` DESC';
				break;
			case 'index_sort':
				$order = '`g`.`index_sort` DESC,`g`.`group_id` DESC';
				break;
		}
		$now_time = $_SERVER['REQUEST_TIME'];
		//先选出多有的特卖推荐
		$except_group="";
		$group_list_all = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where("`g`.`index_tui`='1' AND `g`.`mer_id`=`m`.`mer_id` AND `g`.`is_group_buy`='0' AND `g`.`status`='1' AND `m`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `m`.`mer_id` <> '621' AND `m`.`mer_id` <> '890' AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3246' AND `g`.`group_id` <> '3254' AND `g`.`group_id` <> '3428' ")->order($order)->select();
		foreach ($group_list_all as $key => $value) {
			$group_list_all[$key]['flag']=1;
			 $count=count($group_list_all);
			 if($key<($count-1)){
			 $except_group.=($value['group_id'].",");
			 }else{
			 	$except_group.=$value['group_id'];
			 }
		}
		//再选出地区对应的6个特卖
		$area_idstr=implode(',',$_SESSION['areaarr']);
		 $group_list_area = D('')->field('`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*')->table(array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m'))->where("`g`.`mer_id`=`m`.`mer_id` AND `g`.`is_group_buy`='0' AND `g`.`status`='1' AND `m`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `m`.`area_id` IN (".$area_idstr.") AND `g`.`group_id` NOT IN (".$except_group.") AND `m`.`mer_id` <> '747' AND `m`.`mer_id` <> '621' AND `m`.`mer_id` <> '890' AND `g`.`mer_id` <> '1115' AND `g`.`group_id` <> '3246' AND `g`.`group_id` <> '3254' AND `g`.`group_id` <> '3428' ")->order($order)->limit($limit)->select();
		 	foreach ($group_list_area as $key => $value) {
		 		$group_list_area[$key]['flag']=0;
		 }
		 $group_list_area=array_filter($group_list_area);
		 if(!empty($group_list_area)){
			$group_list=array_merge($group_list_all,$group_list_area);
		}else{
			$group_list=$group_list_all;
		}
		if($group_list){
			$group_image_class = new group_image();

			foreach($group_list as $key=>$value){
				$tmp_pic_arr = explode(';',$value['pic']);
				$group_list[$key]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
				$group_list[$key]['url'] = $this->get_group_url($value['group_id'],$is_wap);
				$group_list[$key]['price'] = floatval($value['price']);
				$group_list[$key]['old_price'] = floatval($value['old_price']);
				$group_list[$key]['wx_cheap'] = floatval($value['wx_cheap']);
				$group_list[$key]['sale_count'] = $value['sale_count']+$value['virtual_num'];
			}


			return $group_list;
		}else{
			return false;
		}
	}

    /*wap版得到指定分类ID或分类父ID下的分类，带有分页功能*/
    public function wap_get_group_buy_list_by_catid($get_grouplist_catid,$get_grouplist_catfid,$area_id,$order, $lat = 0, $long = 0, $circle_id = 0){
        $now_time = $_SERVER['REQUEST_TIME'];
        $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`is_group_buy`='1' AND `g`.`type`='1' AND `m`.`status`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'";
        //分类相关
        if(!empty($get_grouplist_catfid)){
            $condition_where .= " AND `g`.`cat_fid`='$get_grouplist_catfid'";
        }else if(!empty($get_grouplist_catid)){
            $condition_where .= " AND `g`.`cat_id`='$get_grouplist_catid'";
        }

        //区域
        if($area_id || $circle_id){
            $condition_field  = 'DISTINCT `g`.`group_id`,`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
            if ($circle_id) {
                $condition_where .= " AND `gc`.`circle_id`='$circle_id' AND `gc`.`group_id`=`g`.`group_id`";
            } else {
                $condition_where .= " AND `gc`.`area_id`='$area_id' AND `gc`.`group_id`=`g`.`group_id`";
            }
            if ($order == 'juli') {
                $condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc', C('DB_PREFIX').'merchant_store'=>'s');
                $condition_where .= " AND `m`.`mer_id`=`s`.`mer_id`";
                $condition_field .= ", ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS juli";
            } else {
                $condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc');
            }


        }else{
            $condition_field  = '`g`.`name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
            if ($order == 'juli') {
                $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'merchant_store'=>'s');
                $condition_where .= " AND `m`.`mer_id`=`s`.`mer_id`";
                $condition_field .= ", ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS juli";
            } else {
                $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
            }

        }

        //排序
        switch($order){
            case 'price':
                $order = '`g`.`price` ASC,`g`.`group_id` DESC';
                break;
            case 'priceDesc':
                $order = '`g`.`price` DESC,`g`.`group_id` DESC';
                break;
            case 'solds':
                $order = '`g`.`sale_count` DESC,`g`.`group_id` DESC';
                break;
            case 'rating':
                $order = '`g`.`score_mean` DESC,`g`.`group_id` DESC';
                break;
            case 'start':
                $order = '`g`.`last_time` DESC,`g`.`group_id` DESC';
                break;
            case 'juli':
                $order = 'juli asc,`g`.`group_id` DESC';
                break;
// 			default:
// 				$order = 'juli asc,`g`.`group_id` DESC';
            default:
                $order = '`g`.`sort` DESC,`g`.`group_id` DESC';
        }

        import('@.ORG.wap_group_page');
        $count_group = D('')->table($condition_table)->where($condition_where)->count();
        $p = new Page($count_group,C('config.group_page_row'),C('config.group_page_val'));
        $group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->group('`g`.`group_id`, `m`.`mer_id`')->limit($p->firstRow.','.$p->listRows)->select();
// 		echo D('')->_sql();
        $return['pagebar'] = $p->show();

        if($group_list){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_group_url($v['group_id'],true);
                $group_list[$k]['price'] = floatval($v['price']);
                $group_list[$k]['old_price'] = floatval($v['old_price']);
                $group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
                $group_list[$k]['sale_count'] = $v['sale_count']+$v['virtual_num'];
            }
        }
        $return['group_list'] = $group_list;
        $return['group_count'] = $count_group;
        $return['totalPage'] = ceil($count_group/C('config.group_page_row'));
        return $return;
    }


    /*wap版得到指定分类ID或分类父ID下的分类，带有分页功能*/
    public function new_wap_get_group_buy_list_by_catid($listrow=6,$get_grouplist_catid,$get_grouplist_catfid,$area_id,$order, $lat = 0, $long = 0, $circle_id = 0){
        $now_time = $_SERVER['REQUEST_TIME'];
        $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`is_group_buy`='1' AND `g`.`type`='1' AND `m`.`status`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`is_lottery_group_buy` <> '1'";
        //分类相关
        if(!empty($get_grouplist_catfid)){
            $condition_where .= " AND `g`.`cat_fid`='$get_grouplist_catfid'";
        }else if(!empty($get_grouplist_catid)){
            $condition_where .= " AND `g`.`cat_id`='$get_grouplist_catid'";
        }

        //区域
        if($area_id || $circle_id){
            $condition_field  = 'DISTINCT `g`.`group_id`,`g`.`s_name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
            if ($circle_id) {
                $condition_where .= " AND `gc`.`circle_id`='$circle_id' AND `gc`.`group_id`=`g`.`group_id`";
            } else {
                $condition_where .= " AND `gc`.`area_id`='$area_id' AND `gc`.`group_id`=`g`.`group_id`";
            }
            if ($order == 'juli') {
                $condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc', C('DB_PREFIX').'merchant_store'=>'s');
                $condition_where .= " AND `m`.`mer_id`=`s`.`mer_id`";
                $condition_field .= ", ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS juli";
            } else {
                $condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc');
            }


        }else{
            $condition_field  = '`g`.`s_name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
            if ($order == 'juli') {
                $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'merchant_store'=>'s');
                $condition_where .= " AND `m`.`mer_id`=`s`.`mer_id`";
                $condition_field .= ", ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS juli";
            } else {
                $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
            }

        }

        //排序
        switch($order){
            case 'price':
                $order = '`g`.`price` ASC,`g`.`group_id` DESC';
                break;
            case 'priceDesc':
                $order = '`g`.`price` DESC,`g`.`group_id` DESC';
                break;
            case 'solds':
                $order = '`g`.`sale_count` DESC,`g`.`group_id` DESC';
                break;
            case 'rating':
                $order = '`g`.`score_mean` DESC,`g`.`group_id` DESC';
                break;
            case 'start':
                $order = '`g`.`last_time` DESC,`g`.`group_id` DESC';
                break;
            case 'juli':
                $order = 'juli asc,`g`.`group_id` DESC';
                break;
// 			default:
// 				$order = 'juli asc,`g`.`group_id` DESC';
            default:
                $order = '`g`.`sort` DESC,`g`.`group_id` DESC';
        }

        import('@.ORG.wap_group_page');
        $count_group = D('')->table($condition_table)->where($condition_where)->count();
        $p = new Page($count_group,$listrow,C('config.group_page_val'));
        $group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->group('`g`.`group_id`, `m`.`mer_id`')->limit($p->firstRow.','.$p->listRows)->select();
// 		echo D('')->_sql();
        $return['pagebar'] = $p->show();

        if($group_list){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                 $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[1]?$tmp_pic_arr[1]:$tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_group_url($v['group_id'],true);
                $group_list[$k]['price'] = floatval($v['price']);
                $group_list[$k]['old_price'] = floatval($v['old_price']);
                $group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
                $group_list[$k]['sale_count'] = $v['sale_count']+$v['virtual_num'];
            }
        }
        $return['group_list'] = $group_list;
        $return['group_count'] = $count_group;
        $return['totalPage'] = ceil($count_group/C('config.group_page_row'));
        return $return;
    }
	
	
	
	
	   public function new_wap_get_group_buy_lottery_list_by_catid($listrow=6,$get_grouplist_catid,$get_grouplist_catfid,$area_id,$order, $lat = 0, $long = 0, $circle_id = 0){
        $now_time = $_SERVER['REQUEST_TIME'];
        $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`is_group_buy`='1' AND `g`.`type`='1' AND `m`.`status`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`is_lottery_group_buy`='1'";
        //分类相关
        if(!empty($get_grouplist_catfid)){
            $condition_where .= " AND `g`.`cat_fid`='$get_grouplist_catfid'";
        }else if(!empty($get_grouplist_catid)){
            $condition_where .= " AND `g`.`cat_id`='$get_grouplist_catid'";
        }

        //区域
        if($area_id || $circle_id){
            $condition_field  = 'DISTINCT `g`.`group_id`,`g`.`s_name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
            if ($circle_id) {
                $condition_where .= " AND `gc`.`circle_id`='$circle_id' AND `gc`.`group_id`=`g`.`group_id`";
            } else {
                $condition_where .= " AND `gc`.`area_id`='$area_id' AND `gc`.`group_id`=`g`.`group_id`";
            }
            if ($order == 'juli') {
                $condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc', C('DB_PREFIX').'merchant_store'=>'s');
                $condition_where .= " AND `m`.`mer_id`=`s`.`mer_id`";
                $condition_field .= ", ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS juli";
            } else {
                $condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc');
            }


        }else{
            $condition_field  = '`g`.`s_name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
            if ($order == 'juli') {
                $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'merchant_store'=>'s');
                $condition_where .= " AND `m`.`mer_id`=`s`.`mer_id`";
                $condition_field .= ", ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS juli";
            } else {
                $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
            }

        }

        //排序
        switch($order){
            case 'price':
                $order = '`g`.`price` ASC,`g`.`group_id` DESC';
                break;
            case 'priceDesc':
                $order = '`g`.`price` DESC,`g`.`group_id` DESC';
                break;
            case 'solds':
                $order = '`g`.`sale_count` DESC,`g`.`group_id` DESC';
                break;
            case 'rating':
                $order = '`g`.`score_mean` DESC,`g`.`group_id` DESC';
                break;
            case 'start':
                $order = '`g`.`last_time` DESC,`g`.`group_id` DESC';
                break;
            case 'juli':
                $order = 'juli asc,`g`.`group_id` DESC';
                break;
// 			default:
// 				$order = 'juli asc,`g`.`group_id` DESC';
            default:
                $order = '`g`.`sort` DESC,`g`.`group_id` DESC';
        }

        import('@.ORG.wap_group_page');
        $count_group = D('')->table($condition_table)->where($condition_where)->count();
        $p = new Page($count_group,$listrow,C('config.group_page_val'));
        $group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->group('`g`.`group_id`, `m`.`mer_id`')->limit($p->firstRow.','.$p->listRows)->select();
// 		echo D('')->_sql();
        $return['pagebar'] = $p->show();

        if($group_list){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[1]?$tmp_pic_arr[1]:$tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_group_url($v['group_id'],true);
                $group_list[$k]['price'] = floatval($v['price']);
                $group_list[$k]['old_price'] = floatval($v['old_price']);
                $group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
                $group_list[$k]['sale_count'] = $v['sale_count']+$v['virtual_num'];
            }
        }
        $return['group_list'] = $group_list;
        $return['group_count'] = $count_group;
        $return['totalPage'] = ceil($count_group/C('config.group_page_row'));
        return $return;
    }
	
	
	 public function new_wap_get_group_buy_firstfree_by_catid($listrow=6,$get_grouplist_catid,$get_grouplist_catfid,$area_id,$order, $lat = 0, $long = 0, $circle_id = 0){
        $now_time = $_SERVER['REQUEST_TIME'];
        $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`is_group_buy`='1' AND `g`.`type`='1' AND `m`.`status`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time' AND `g`.`is_lottery_group_buy` <> '1' AND `g`.`is_first_free` = '1'";
        //分类相关
        if(!empty($get_grouplist_catfid)){
            $condition_where .= " AND `g`.`cat_fid`='$get_grouplist_catfid'";
        }else if(!empty($get_grouplist_catid)){
            $condition_where .= " AND `g`.`cat_id`='$get_grouplist_catid'";
        }

        //区域
        if($area_id || $circle_id){
            $condition_field  = 'DISTINCT `g`.`group_id`,`g`.`s_name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
            if ($circle_id) {
                $condition_where .= " AND `gc`.`circle_id`='$circle_id' AND `gc`.`group_id`=`g`.`group_id`";
            } else {
                $condition_where .= " AND `gc`.`area_id`='$area_id' AND `gc`.`group_id`=`g`.`group_id`";
            }
            if ($order == 'juli') {
                $condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc', C('DB_PREFIX').'merchant_store'=>'s');
                $condition_where .= " AND `m`.`mer_id`=`s`.`mer_id`";
                $condition_field .= ", ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS juli";
            } else {
                $condition_table  = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'group_store'=>'gc');
            }


        }else{
            $condition_field  = '`g`.`s_name` AS `group_name`,`m`.`name` AS `merchant_name`,`g`.*,`m`.*';
            if ($order == 'juli') {
                $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'merchant_store'=>'s');
                $condition_where .= " AND `m`.`mer_id`=`s`.`mer_id`";
                $condition_field .= ", ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`s`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`s`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`s`.`long`*PI()/180)/2),2)))*1000) AS juli";
            } else {
                $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
            }

        }

        //排序
        switch($order){
            case 'price':
                $order = '`g`.`price` ASC,`g`.`group_id` DESC';
                break;
            case 'priceDesc':
                $order = '`g`.`price` DESC,`g`.`group_id` DESC';
                break;
            case 'solds':
                $order = '`g`.`sale_count` DESC,`g`.`group_id` DESC';
                break;
            case 'rating':
                $order = '`g`.`score_mean` DESC,`g`.`group_id` DESC';
                break;
            case 'start':
                $order = '`g`.`last_time` DESC,`g`.`group_id` DESC';
                break;
            case 'juli':
                $order = 'juli asc,`g`.`group_id` DESC';
                break;
// 			default:
// 				$order = 'juli asc,`g`.`group_id` DESC';
            default:
                $order = '`g`.`sort` DESC,`g`.`group_id` DESC';
        }

        import('@.ORG.wap_group_page');
        $count_group = D('')->table($condition_table)->where($condition_where)->count();
        $p = new Page($count_group,$listrow,C('config.group_page_val'));
        $group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order($order)->group('`g`.`group_id`, `m`.`mer_id`')->limit($p->firstRow.','.$p->listRows)->select();
// 		echo D('')->_sql();
        $return['pagebar'] = $p->show();

        if($group_list){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                 $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[1]?$tmp_pic_arr[1]:$tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_group_url($v['group_id'],true);
                $group_list[$k]['price'] = floatval($v['price']);
                $group_list[$k]['old_price'] = floatval($v['old_price']);
                $group_list[$k]['wx_cheap'] = floatval($v['wx_cheap']);
                $group_list[$k]['sale_count'] = $v['sale_count']+$v['virtual_num'];
            }
        }
        $return['group_list'] = $group_list;
        $return['group_count'] = $count_group;
        $return['totalPage'] = ceil($count_group/C('config.group_page_row'));
        return $return;
    }
}

?>