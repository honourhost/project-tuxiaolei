<?php
/*
 * 首页
 *
 */
class IndexAction extends BaseAction {
    public function index(){
		//顶部广告
		// $index_top_adver = D('Adver')->get_adver_by_key('index_top');
		// $this->assign('index_top_adver',$index_top_adver);

		// //热门搜索词
  //   	$search_hot_list = D('Search_hot')->get_list(12);
  //   	$this->assign('search_hot_list',$search_hot_list);

		// //右侧广告
		// $index_right_adver = D('Adver')->get_adver_by_key('index_right',3);
		// $this->assign('index_right_adver',$index_right_adver);

		// //所有分类 包含2级分类
		$all_category_list = D('Group_category')->get_category();
		$this->assign('all_category_list',$all_category_list);

		//热门二级分类
		$hot_group_category = D('Group_category')->get_hot_category();
		$this->assign('hot_group_category',$hot_group_category);

		// //所有区域
		// $all_area_list = D('Area')->get_area_list();
		// $this->assign('all_area_list',$all_area_list);

		// //热门商圈
		// $hot_circle_list = D('Area')->get_circle_list();
		// $this->assign('hot_circle_list',$hot_circle_list);

		// //最新团购
		// $new_group_list = D('Group')->get_group_list('new',12);
		// $this->assign('new_group_list',$new_group_list);

		// //手动首页排序团购
		// $index_sort_group_list = D('Group')->get_group_list('index_sort',12);
		// $this->assign('index_sort_group_list',$index_sort_group_list);

		//taorong
		// 首页tuijian团购
		$index_tui_group_list =D('Group')->get_group_list('index_tui',6);
		$this->assign('index_tui_group_list',$index_tui_group_list);
		$Merchant=M('Merchant');
		//首页推荐农场
		$list=$Merchant->where(array("status"=>1))->limit(6)->order("fans_count DESC,reg_time DESC")->select();
		$merchant_image_class=new merchant_image();
        foreach($list as $key=>$val) {
            if (!empty($val['merchant_theme_image'])) {
                $list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            }
            if(!empty($val['person_image'])){
            	$list[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
            }
        }
        $this->assign("farmlist",$list);

        //查询文章分类
		$res=M("Text_category")->order("sort ASC")->select();
		$this->assign("text_cat",$res);
		//查询分类对应的文章，每个分类取6个
		//为了对应相应的分类，必须按照顺序取数组，然后对应存到相应的数组中
		$Image_text=M("Image_text");
		foreach($res as $key=>$val){
			$artlist[]=$Image_text->alias("t")->field("t.pigcms_id,t.title,t.digest,t.cover_pic,m.area_id")->join(C("DB_PREFIX")."merchant m ON t.mer_id=m.mer_id")->where("t.cat_id=".$val['id']." AND checkone=1")->order("dateline DESC")->limit(6)->select();
		}
		$this->assign("artList",$artlist);
		//首页农场，目前为三个分类，每个分类选6个

		// $Merchant=D('Merchant');
		// $farm_cat1_list = $Merchant->where(array("status"=>1,"merchant_cat_fid"=>2,"share_open"=>1))->limit(6)->order("reg_time desc")->select();
  //       $merchant_image_class=new merchant_image();
  //       foreach($farm_cat1_list as $key=>$val) {
  //           if (!empty($val['merchant_theme_image'])) {
  //               $farm_cat1_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
  //           }
  //       }
  //       $this->assign("farm_cat1_list",$farm_cat1_list);

  //       $farm_cat2_list = $Merchant->where(array("status"=>1,"merchant_cat_fid"=>3,"share_open"=>1))->limit(6)->order("reg_time desc")->select();
  //       $merchant_image_class=new merchant_image();
  //       foreach($farm_cat2_list as $key=>$val) {
  //           if (!empty($val['merchant_theme_image'])) {
  //               $farm_cat2_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
  //           }
  //       }
  //       $this->assign("farm_cat2_list",$farm_cat2_list);

  //       $farm_cat3_list = $Merchant->where(array("status"=>1,"merchant_cat_fid"=>4,"share_open"=>1))->limit(6)->order("reg_time desc")->select();
  //       $merchant_image_class=new merchant_image();
  //       foreach($farm_cat3_list as $key=>$val) {
  //           if (!empty($val['merchant_theme_image'])) {
  //               $farm_cat3_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
  //           }
  //       }
  //       $this->assign("farm_cat3_list",$farm_cat3_list);

        //活动分类查询、
        //先查询活动分类
 /*   $activity_type_list=D("Extension_activity_type")->where("status=1")->limit(4)->select();
        //按照类型查询对应的活动分类
        foreach($activity_type_list as $key => $val){
        	$activity_cat_list=D("Extension_activity_list")->where(array("activity_type_id"=>$val['id'],"status"=>1))->limit(6)->order("index_sort desc")->select();
        	if($activity_cat_list){
			$extension_image_class = new extension_image();
			foreach($activity_cat_list as &$value){
				$value['list_pic'] = $extension_image_class->get_image_by_path(array_shift(explode(';',$value['pic'])),'s');
				$value['url'] = $this->config['site_url'].'/activity/'.$value['pigcms_id'].'.html';
				$value['money'] = floatval($value['money']);
			}
			$activity_lists[$key]=$activity_cat_list;
			}
        }
        $this->assign("activity_type_list",$activity_type_list);
        $this->assign("activity_lists",$activity_lists);  */
		
	   if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where= "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.tuan_type IN (1,0) AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (".$area_idstr.") AND `g`.`mer_id` <> '621' ";
        }else{
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where= "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.tuan_type IN (1,0) AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `g`.`mer_id` <> '621' ";

        }
        $field_condition="`g`.`name` AS `product_name`,`g`.`s_name` AS `merchant_name`,`g`.pic,`g`.price,`g`.mer_id,'' AS `all_count`, '' AS `part_count`, `g`.price AS `money`,
        '' AS `pigcms_id`,`g`.begin_time , `g`.end_time ,`g`.group_id,`m`.`name` AS `mer_name`, `m`.phone AS `mer_phone`,`m`.`person_image` AS `mer_persion_image`";
        $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
        if($_SESSION['areaarr']!="all"){
            $count=D('')->field($field_condition)->table($condition_table)->where($condition_where)->count();
            if($count!=0){
                $activity_lists = D('')->field($field_condition)->table($condition_table)->where($condition_where)->limit(6)->order("g.index_tui desc")->select();
            }else{
                $now_time = $_SERVER['REQUEST_TIME'];
                $condition_where= "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
                $activity_lists = D('')->field($field_condition)->table($condition_table)->where($condition_where)->limit(6)->order("g.index_tui desc")->select();
            }
        }else{
            $activity_lists = D('')->field($field_condition)->table($condition_table)->where($condition_where)->limit(6)->order("g.index_tui desc")->select();
        }
        if(!empty($activity_lists)) {
            $group_image_class = new group_image();
            foreach ($activity_lists as $k => $v) {
                $tmp_pic_arr = explode(';', $v['pic']);
                $mer_image = str_replace(',', '/', $v['mer_persion_image']);
                $image = $group_image_class->get_image_by_path($tmp_pic_arr[0]);
                $activity_lists[$k]['list_pic'] = $image["s_image"];
                $activity_lists[$k]['url'] = $this->get_group_url($v['group_id']);
                $activity_lists[$k]['mer_person'] = C('config.site_url') . '/upload/merchant/' . $mer_image;
            }
//              print_r(json_encode($activity_lists));
//            die();
            $this->assign("activity_lists", $activity_lists);

        } 

		//首页大分类下的团购列表
		// $index_group_list = D('Group')->get_category_arr_group_list($all_category_list,8);

		// $this->assign('index_group_list',$index_group_list);

		//活动列表
		if($this->config['activity_open']){
			$now_activity = D('Extension_activity')->where(array('begin_time'=>array('lt',$_SERVER['REQUEST_TIME']),'end_time'=>array('gt',$_SERVER['REQUEST_TIME'])))->order('`activity_id` ASC')->find();
			if($now_activity){
				// list($time_array['j'],$time_array['h'],$time_array['m'],$time_array['s']) = explode(' ',date('j H i s',$now_activity['end_time'] - $_SERVER['REQUEST_TIME']));
				$time = $now_activity['end_time'] - $_SERVER['REQUEST_TIME'];
				$time_array['j'] = floor($time/86400);
				$time_array['h'] = floor($time%86400/3600);
				$time_array['m'] = floor($time%86400%3600/60);
				$time_array['s'] = floor($time%86400%60);
				$activity_list = D('Extension_activity_list')->field('`pigcms_id`,`name`,`title`,`index_pic`,`part_count`')->where(array('activity_term'=>$now_activity['activity_id'],'status'=>'1','index_sort'=>array('neq','0')))->order('`index_sort` DESC,`pigcms_id` DESC')->limit(6)->select();
				if(empty($activity_list)){
					unset($now_activity);
				}
				$this->assign('now_activity',$now_activity);
				$this->assign('time_array',$time_array);

				$activity_list = D('Extension_activity_list')->field('`pigcms_id`,`name`,`title`,`index_pic`,`part_count`')->where(array('activity_term'=>$now_activity['activity_id'],'status'=>'1','index_sort'=>array('neq','0')))->order('`index_sort` DESC,`pigcms_id` DESC')->limit(6)->select();

				$extension_image_class = new extension_image();
				foreach($activity_list as &$value){
					$value['index_pic'] = $this->config['site_url'].'/upload/activity/index_pic/'.$value['index_pic'];
					$value['url'] = $this->config['site_url'].'/activity/'.$value['pigcms_id'].'.html';
				}
				$this->assign('activity_list',$activity_list);
				$this->assign('activity_url',$this->config['site_url'].'/activity/');
			}

			//本站信息
			$index_site_info = S('index_site_info');
			if(empty($index_site_info)){
				$today_zero_time = strtotime(date('Y-m-d',$_SERVER['REQUEST_TIME']) . ' 00:00:00');
				$index_site_info = array();
				$index_site_info['user_count'] = D('User')->where(array('add_time'=>array('gt',$today_zero_time)))->count('uid');
				$index_site_info['merchant_count'] = D('Merchant')->where(array('reg_time'=>array('gt',$today_zero_time)))->count('mer_id');
				$index_site_info['merchant_store_count'] = D('Merchant_store')->where(array('last_time'=>array('gt',$today_zero_time)))->count('store_id');
				$index_site_info['group_count'] = D('Group')->where(array('last_time'=>array('gt',$today_zero_time)))->count('group_id');
				$index_site_info['meal_store_count'] = D('Merchant_store_meal')->where(array('last_time'=>array('gt',$today_zero_time)))->count('store_id');
				// dump($index_site_info);
			}
			$this->assign('index_site_info',$index_site_info);
		}
		//友情链接
		$flink_list = D('Flink')->get_flink_list();
		$this->assign('flink_list',$flink_list);
		$this->assign("merchant_list",$this->merchant_list());
		$this->display();
    }

	public function group_index_sort(){
		$group_id = $_POST['id'];
		$database_index_group_hits = D('Index_group_hits_'.substr(dechex($group_id),-1));
		$data_index_group_hits['group_id'] = $group_id;
		$data_index_group_hits['ip']		= get_client_ip();
		if(!$database_index_group_hits->field('`group_id`')->where($data_index_group_hits)->find()){
			$condition_group['group_id'] = $group_id;
			if(M('Group')->where($condition_group)->setDec('index_sort')){
				$data_index_group_hits['time'] = $_SERVER['REQUEST_TIME'];
				$database_index_group_hits->data($data_index_group_hits)->add();
			}
		}
	}
	
	  public function get_group_url($group_id){
        return C('config.site_url').'/mobile.php?g=Mobile&c=Group&a=detail&group_id='.$group_id;
    }
	
    /**
     * 首页发现农场
     */
    public function merchant_list(){


        $database_adver = D('Adver');
        $condition_adver['cat_id'] = 22;
        $merchant_list = $database_adver->field(true)->where($condition_adver)->order('`id` DESC')->select();
        foreach ($merchant_list as $key=>$value){
            $merchant_list[$key]["merinfo"]=$this->getmerinfo($value["desc"]);
        }
      
        return $merchant_list;
    }
    protected  function  getmerinfo($merid){
        $list=M("Merchant")->where(array("mer_id"=>$merid))->find();
        $merchant_image_class=new merchant_image();

            if (!empty($list['merchant_theme_image'])) {
				//echo "fffff";die;
                $list["merchant_theme_image"] = $merchant_image_class->get_image_by_path($list['merchant_theme_image']);
            }
            if(!empty($list['person_image'])){
                $list["person_image"] = $merchant_image_class->get_image_by_path($list['person_image']);
            }
  return $list;
    }
	
	
	  public function  statistic(){
	
		 if(IS_POST){
              $pwd=$_POST["password"];
              if($pwd!="xiaonongding"){
                 // $this->error_tips("请输入正确的",U("Index/Index/pwd"));
				  redirect(U("Index/Index/pwd"));
              }else{
                  session("ppwwdd",$pwd);
              }
          }

          if(empty($_SESSION["ppwwdd"])||$_SESSION["ppwwdd"]!="xiaonongding"){
              //$this->error_tips("请输入密码",U("Index/Index/pwd"));
			   redirect(U("Index/Index/pwd"));
          }
        //网站统计
        $pigcms_assign['website_user_count'] = M('User')->count();
        $pigcms_assign['website_merchant_count'] = M('Merchant')->count();
        $pigcms_assign['website_merchant_store_count'] = M('Merchant_store')->count();
        //团购统计
        $pigcms_assign['group_group_count'] = M('Group')->count();
        $pigcms_assign['group_today_order_count'] = D('Group_order')->get_all_oreder_count('day');
        $pigcms_assign['group_week_order_count'] = D('Group_order')->get_all_oreder_count('week');
        $pigcms_assign['group_month_order_count'] = D('Group_order')->get_all_oreder_count('month');
        $pigcms_assign['group_year_order_count'] = D('Group_order')->get_all_oreder_count('year');
        $pigcms_assign['group_order_unsend'] = M('Group_order')->where(array("paid"=>1,"status"=>0))->count();
        $pigcms_assign['group_day_order_sum']=D('Group_order')->get_all_oreder_sum("day");
		  $pigcms_assign['group_month_order_sum']=D('Group_order')->get_all_oreder_sum("month");


        $pigcms_assign["group_order_count"]=D("Group_order")->where(array("paid"=>1))->count();
        $pigcms_assign["group_money_count"]=D("Group_order")->sum("payment_money");
        $this->assign($pigcms_assign);
        $this->display();
    }
	
	   public  function pwd(){
        if($_SESSION["ppwwdd"]=="xiaonongding"){
            redirect(U("Index/Index/statistic"));
        }else{
            $this->display("pwd");
        }


    }
}