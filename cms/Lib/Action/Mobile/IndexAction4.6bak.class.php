<?php

/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/11
 * Time: 13:45
 */
class IndexAction extends BaseAction
{

    private $homeappbanner = 7;
    private $actappbanner = 8;
    private $homeappcate = 9;
    private $actappcate = 10;
    private $homeapptheme = 11;
    private $homeappadd = 12;

    public function index()
    {
         if(!empty($_GET["long"])&&!empty($_GET["lat"])){
            $long=$_GET["long"];
            $lat=$_GET["lat"];
            session_start();
            $_SESSION["long"]=$long;
            $_SESSION["lat"]=$lat;
        }


        //地区id
        if ($_SESSION['areaarr'] != "all") {
            $area_id = $_SESSION['selectcityid'];
        } else {
            $area_id = 0;
        }
        //查询首页轮播
        $cat_id = $this->homeappbanner;

        $result = D("App_slider")->getList($cat_id, $area_id);

        if (!empty($result)) {
            $this->assign("bannerresult", $result);
        } else {
            $newresult = D("App_slider")->getList($cat_id, 0);
            if (!empty($newresult)) {
                $this->assign("bannerresult", $newresult);
            }
        }
        //查询首页分类
        $cat_id = $this->homeappcate;

        $result = D("App_slider")->getList($cat_id, $area_id);

        if (!empty($result)) {
            $this->assign("catresult", $result);
        } else {
            $newresult = D("App_slider")->getList($cat_id, 0);
            if (!empty($newresult)) {
                $this->assign("catresult", $newresult);
            }
        }
        //主题部分
        $cat_id = $this->homeapptheme;

        $result = D("App_slider")->getList($cat_id, $area_id);

        if (!empty($result)) {
            $this->assign("themeresult", $result);
        } else {
            $newresult = D("App_slider")->getList($cat_id, 0);
            if (!empty($newresult)) {
                $this->assign("themeresult", $newresult);
            }
        }
        //首页广告显示
        $cat_id = $this->homeappadd;

        $result = D("App_slider")->getList($cat_id, $area_id);

        if (!empty($result)) {
            $this->assign("addresult", $result);
        } else {
            $newresult = D("App_slider")->getList($cat_id, 0);
            if (!empty($newresult)) {
                $this->assign("addresult", $newresult);
            }
        }
        //首页推送特卖
        if ($_SESSION['areaarr'] != "all") {
            $area_idstr = implode(',', $_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (" . $area_idstr . ") AND `m`.`mer_id` <> '747'";
        } else {
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`mer_id` <> '747'";
        }
        $condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'merchant' => 'm');
        if ($_SESSION['areaarr'] != "all") {
            $count = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->count();
            if ($count != 0) {
                $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.last_time desc")->limit(2)->select();
            } else {
                $now_time = $_SERVER['REQUEST_TIME'];
                $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`mer_id` <> '747'";
                $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.last_time desc")->limit(2)->select();
            }
        } else {
            $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.last_time desc")->limit(2)->select();
        }

        if (!empty($group_list)) {
            $group_image_class = new group_image();
            foreach ($group_list as $k => $v) {
                $tmp_pic_arr = explode(';', $v['pic']);
                $image = $group_image_class->get_image_by_path($tmp_pic_arr[0]);
                $group_list[$k]['list_pic'] = $image["s_image"];
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
            }
            $this->assign("pushgoods", $group_list);
        }
        //查询农场相册内容3个
        if ($_SESSION['areaarr'] != "all") {
            $area_idstr = implode(',', $_SESSION['areaarr']);
            $condition_where = " AND `area_id` in (" . $area_idstr . ")";
        }
        if (!empty($condition_where)) {
            $count = D("Merchant")->field("mer_id,pic_info,name,person_name")->limit(3)->where("`status`='1' AND pic_info <> ''" . $condition_where)->count();
            if (($count < 3) && ($count != 0)) {
                $oldthreeTuiMerchant = D("Merchant")->field("mer_id,pic_info,name,person_name")->limit(3)->where("`status`='1' AND pic_info <> ''" . $condition_where)->order("share_open desc,reg_time desc")->select();
                $newthreeTuiMerchant = D("Merchant")->field("mer_id,pic_info,name,person_name")->limit((3 - $count))->where("`status`='1' AND pic_info <> ''")->order("share_open desc,reg_time desc")->select();
                $threeTuiMerchant = array_merge($oldthreeTuiMerchant, $newthreeTuiMerchant);
            } elseif ($count >= 3) {
                $threeTuiMerchant = D("Merchant")->field("mer_id,pic_info,name,person_name")->limit(3)->where("`status`='1' AND pic_info <> ''" . $condition_where)->order("share_open desc,reg_time desc")->select();
            } else {
                $threeTuiMerchant = D("Merchant")->field("mer_id,pic_info,name,person_name")->limit(3)->where("`status`='1' AND pic_info <> ''")->order("share_open desc,reg_time desc")->select();
            }
        } else {
            $threeTuiMerchant = D("Merchant")->field("mer_id,pic_info,name,person_name")->limit(3)->where("`status`='1' AND pic_info <> ''")->order("share_open desc,reg_time desc")->select();
        }
        //转换图片
        if (!empty($threeTuiMerchant)) {
            $Merchant_image_class = new Merchant_image();
            foreach ($threeTuiMerchant as $k => $val) {
                $threeTuiMerchant[$k]['images'] = $Merchant_image_class->get_allImage_by_path($val['pic_info']);
                $threeTuiMerchant[$k]['url'] = $this->getMerchantUrl($val['mer_id']);
            }
        }
        $this->assign("pictures", $threeTuiMerchant);
        //选出几个最新推送农场
        if ($_SESSION['areaarr'] != "all") {
            $area_idstr = implode(',', $_SESSION['areaarr']);
            $condition_where = " AND `area_id` in (" . $area_idstr . ")";
        }
        if (!empty($condition_where)) {
            $count = D("Merchant")->field("mer_id,name")->limit(3)->where("`status`='1' AND pic_info <> ''" . $condition_where)->count();
            if ($count != 0) {
                $threeTui = D("Merchant")->field("mer_id,name")->limit(3)->where("`status`='1' AND pic_info <> ''" . $condition_where)->order("reg_time desc")->select();
            } else {
                $threeTui = D("Merchant")->field("mer_id,name")->limit(3)->where("`status`='1' AND pic_info <> ''")->order("reg_time desc")->select();
            }
        } else {
            $threeTui = D("Merchant")->field("mer_id,name")->limit(3)->where("`status`='1' AND pic_info <> ''")->order("reg_time desc")->select();
        }
        //转换图片
        if (!empty($threeTui)) {
            foreach ($threeTui as $k => $val) {
                $threeTui[$k]['url'] = $this->getMerchantUrl($val['mer_id']);
            }
        }
        $this->assign("tuifarms", $threeTui);
        //查询三个活动
        if ($_SESSION['areaarr'] != "all") {
            $area_idstr = implode(',', $_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`tuan_type` IN (1,0) AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (" . $area_idstr . ")";
        } else {
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`tuan_type` IN (1,0) AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
        }
        $field_condition = "`g`.`name` AS `product_name`,`g`.`s_name` AS `merchant_name`,`g`.pic AS `pics`,`g`.price,`g`.mer_id,'' AS `all_count`, '' AS `part_count`, `g`.price AS `money`,
        '' AS `pigcms_id`,`g`.begin_time , `g`.end_time ,`g`.group_id";
        $condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'merchant' => 'm');
        if ($_SESSION['areaarr'] != "all") {
            $count = D('')->field($field_condition)->table($condition_table)->where($condition_where)->count();
            if ($count != 0) {
                $group_list = D('')->field($field_condition)->table($condition_table)->where($condition_where)->order("g.group_id desc")->limit(4)->select();
            } else {
                $now_time = $_SERVER['REQUEST_TIME'];
                $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`tuan_type` IN (1,0) AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
                $group_list = D('')->field($field_condition)->table($condition_table)->where($condition_where)->order("g.group_id desc")->limit(4)->select();
            }
        } else {
            $group_list = D('')->field($field_condition)->table($condition_table)->where($condition_where)->order("g.group_id desc")->limit(4)->select();
        }

        if (!empty($group_list)) {
            $group_image_class = new group_image();
            foreach ($group_list as $k => $v) {
                $tmp_pic_arr = explode(';', $v['pics']);
                $image = $group_image_class->get_image_by_path($tmp_pic_arr[0]);
                $group_list[$k]['list_pic'] = $image["s_image"];
                $group_list[$k]['pic'] = $image["s_image"];
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
            }
            $this->assign("activities", $group_list);
        } else {
        }

        //查询三个活动
        // $now_time = $_SERVER['REQUEST_TIME'];
        // $result=D("Extension_activity_list")->alias("a")->field("a.pigcms_id,a.name,a.title,a.pic,a.price,a.type,a.money,t.begin_time,t.end_time")->join(C("DB_PREFIX")."extension_activity t ON a.activity_term=t.activity_id")->where(array("a.status"=>1,"t.begin_time"=>array("lt",$now_time),"t.end_time"=>array("gt",$now_time)))->limit(3)->order("index_sort desc")->select();
        // if(!empty($result)){
        //     $extend_image = new Extension_image();
        //     foreach($result as $k=>$val) {
        //         $result[$k]['pic'] = $extend_image->get_allImage_by_path($val['pic']);
        //         $result[$k]['url'] = $this->config['site_url'].'/mobile.php?g=Mobile&c=Activity&a=detail&activity_id='.$val['pigcms_id'];
        //     }
        // }
        // $this->assign("activities",$result);

        //选出几个最新推送活动
        $now_time = $_SERVER['REQUEST_TIME'];
        if ($_SESSION['areaarr'] != "all") {
            $area_str = implode(',', $_SESSION['areaarr']);
            $condition_where = "`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `m`.`area_id` IN (" . $area_str . ") AND term.begin_time<" . $now_time . " AND term.end_time>" . $now_time;
        } else {
            $condition_where = "`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND term.begin_time<" . $now_time . " AND term.end_time>" . $now_time;
        }
        $field_condition = "`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.pic,`eal`.all_count,`eal`.part_count,`eal`.price,`eal`.mer_id,`eal`.money,`eal`.pigcms_id,term.begin_time,term.end_time";
        $table_condition = array(C('DB_PREFIX') . 'extension_activity_list' => 'eal', C('DB_PREFIX') . 'merchant' => 'm', C('DB_PREFIX') . 'extension_activity' => 'term');
        if ($_SESSION['areaarr'] != "all") {
            $count = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->count();
            if ($count != 0) {
                $tuiactivity = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->order('`eal`.`last_time` DESC')->limit(3)->select();
            } else {
                $condition_where = "`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND term.begin_time<" . $now_time . " AND term.end_time>" . $now_time;
                $tuiactivity = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->order('`eal`.`last_time` DESC')->limit(3)->select();
            }
        } else {
            $tuiactivity = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->order('`eal`.`last_time` DESC')->limit(3)->select();
        }
        if (!empty($tuiactivity)) {
            foreach ($tuiactivity as $k => $val) {
                $tuiactivity[$k]['url'] = $this->config['site_url'] . '/mobile.php?g=Mobile&c=Activity&a=detail&activity_id=' . $val['pigcms_id'];
            }
            $this->assign("tuiactivities", $tuiactivity);
        }
        //查询猜你喜欢的6个特卖
        //$condition_where=" g.index_tui=1 AND ";
        if ($_SESSION['areaarr'] != "all") {
            $area_idstr = implode(',', $_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (" . $area_idstr . ")";
        } else {
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
        }
        $condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'merchant' => 'm');
        if ($_SESSION['areaarr'] != "all") {
            $count = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->count();
            if ($count != 0) {
                $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.index_tui desc,g.index_sort desc")->limit(6)->select();
            } else {
                $now_time = $_SERVER['REQUEST_TIME'];
                $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
                $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.index_tui desc,g.index_sort desc")->limit(6)->select();
            }
        } else {
            $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.index_tui desc,g.index_sort desc")->limit(6)->select();
        }

        if (!empty($group_list)) {
            $group_image_class = new group_image();
            foreach ($group_list as $k => $v) {
                $tmp_pic_arr = explode(';', $v['pic']);
                $image = $group_image_class->get_image_by_path($tmp_pic_arr[0]);
                $group_list[$k]['list_pic'] = $image["s_image"];
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
            }
            $this->assign("groups", $group_list);
        }
        $this->display();
    }

    public function get_group_url($group_id)
    {
        return C('config.site_url') . '/mobile.php?g=Mobile&c=Group&a=detail&group_id=' . $group_id;
    }

    //获取农场url
    private function getMerchantUrl($mer_id)
    {
        return C('config.site_url') . '/mobile.php?g=Mobile&c=Merchant&a=detail&mer_id=' . $mer_id;
    }

    //获取首页轮播图
    public function getHomeAppBanner()
    {

        $cat_id = $this->homeappbanner;

        if ($_SESSION['areaarr'] != "all") {
            $area_id = $_SESSION['selectcityid'];
        } else {
            $area_id = 0;
        }

        $result = D("App_slider")->getList($cat_id, $area_id);

        if (!empty($result)) {
            $this->returnAjax($result, 1);
        } else {
            $newresult = D("App_slider")->getList($cat_id, 0);
            if (!empty($newresult)) {
                $this->returnAjax($newresult, 1);
            } else {
                $this->returnAjax("未获取到信息！", 0);
            }
        }
    }

    //获取活动页轮播图
    public function getActAppBanner()
    {

        $cat_id = $this->actappbanner;

        if ($_SESSION['areaarr'] != "all") {
            $area_id = $_SESSION['selectcityid'];
        } else {
            $area_id = 0;
        }

        $result = D("App_slider")->getList($cat_id, $area_id);

        if (!empty($result)) {
            $this->returnAjax($result, 1);
        } else {
            $newresult = D("App_slider")->getList($cat_id, 0);
            if (!empty($newresult)) {
                $this->returnAjax($newresult, 1);
            } else {
                $this->returnAjax("未获取到信息！", 0);
            }
        }
    }

    //获取今日上新分类
    public function getHomeAppCate()
    {

        $cat_id = $this->homeappcate;

        if ($_SESSION['areaarr'] != "all") {
            $area_id = $_SESSION['selectcityid'];
        } else {
            $area_id = 0;
        }
        $result = D("App_slider")->getList($cat_id, $area_id);

        if (!empty($result)) {
            $this->returnAjax($result, 1);
        } else {
            $newresult = D("App_slider")->getList($cat_id, 0);
            if (!empty($newresult)) {
                $this->returnAjax($newresult, 1);
            } else {
                $this->returnAjax("未获取到信息！", 0);
            }
        }
    }

    //获取活动分类
    public function getActAppCate()
    {

        $cat_id = $this->actappcate;

        if ($_SESSION['areaarr'] != "all") {
            $area_id = $_SESSION['selectcityid'];
        } else {
            $area_id = 0;
        }

        $result = D("App_slider")->getList($cat_id, $area_id);

        if (!empty($result)) {
            $this->returnAjax($result, 1);
        } else {
            $newresult = D("App_slider")->getList($cat_id, 0);
            if (!empty($newresult)) {
                $this->returnAjax($newresult, 1);
            } else {
                $this->returnAjax("未获取到信息！", 0);
            }
        }
    }

    //获取首页主题推荐广告管理
    public function getHomeAppTheme()
    {

        $cat_id = $this->homeapptheme;

        if ($_SESSION['areaarr'] != "all") {
            $area_id = $_SESSION['selectcityid'];
        } else {
            $area_id = 0;
        }

        $result = D("App_slider")->getList($cat_id, $area_id);

        if (!empty($result)) {
            $this->returnAjax($result, 1);
        } else {
            $newresult = D("App_slider")->getList($cat_id, 0);
            if (!empty($newresult)) {
                $this->returnAjax($newresult, 1);
            } else {
                $this->returnAjax("未获取到信息！", 0);
            }
        }
    }

    //获取首页广告位管理
    public function getHomeAppAdd()
    {

        $cat_id = $this->homeappadd;

        if ($_SESSION['areaarr'] != "all") {
            $area_id = $_SESSION['selectcityid'];
        } else {
            $area_id = 0;
        }

        $result = D("App_slider")->getList($cat_id, $area_id);

        if (!empty($result)) {
            $this->returnAjax($result, 1);
        } else {
            $newresult = D("App_slider")->getList($cat_id, 0);
            if (!empty($newresult)) {
                $this->returnAjax($newresult, 1);
            } else {
                $this->returnAjax("未获取到信息！", 0);
            }
        }
    }

    //选出首页的推荐的三个农场
    public function getRecommendFarms()
    {
        if ($_SESSION['areaarr'] != "all") {
            $area_idstr = implode(',', $_SESSION['areaarr']);
            $condition_where = " AND `area_id` in (" . $area_idstr . ")";
        }

        if (!empty($condition_where)) {
            $count = D("Merchant")->field("mer_id,pic_info,name,person_name")->limit(3)->where("`status`='1' AND pic_info <> ''" . $condition_where)->count();
            if ($count != 0) {
                $threeTuiMerchant = D("Merchant")->field("mer_id,pic_info,name,person_name")->limit(3)->where("`status`='1' AND pic_info <> ''" . $condition_where)->order("share_open desc,reg_time desc")->select();
            } else {
                $threeTuiMerchant = D("Merchant")->field("mer_id,pic_info,name,person_name")->limit(3)->where("`status`='1' AND pic_info <> ''")->order("share_open desc,reg_time desc")->select();
            }
        } else {
            $threeTuiMerchant = D("Merchant")->field("mer_id,pic_info,name,person_name")->limit(3)->where("`status`='1' AND pic_info <> ''")->order("share_open desc,reg_time desc")->select();
        }
        //转换图片
        if (!empty($threeTuiMerchant)) {
            $Merchant_image_class = new Merchant_image();
            foreach ($threeTuiMerchant as $k => $val) {
                $picres = $Merchant_image_class->get_allImage_by_path($val['pic_info']);
                $threeTuiMerchant[$k]['images'] = $picres[0];
                $threeTuiMerchant[$k]['url'] = $this->getMerchantUrl($val['mer_id']);
            }
            $this->returnAjax($threeTuiMerchant, 1);
        } else {
            $this->returnAjax("未获取到数据！", 0);
        }
    }

    //选出首页推送的农场
    public function getPushFarms()
    {
        if ($_SESSION['areaarr'] != "all") {
            $area_idstr = implode(',', $_SESSION['areaarr']);
            $condition_where = " AND `area_id` in (" . $area_idstr . ")";
        }
        if (!empty($condition_where)) {
            $count = D("Merchant")->field("mer_id,name")->limit(3)->where("`status`='1' AND pic_info <> ''" . $condition_where)->count();
            if ($count != 0) {
                $threeTui = D("Merchant")->field("mer_id,name")->limit(3)->where("`status`='1' AND pic_info <> ''" . $condition_where)->order("reg_time desc")->select();
            } else {
                $threeTui = D("Merchant")->field("mer_id,name")->limit(3)->where("`status`='1' AND pic_info <> ''")->order("reg_time desc")->select();
            }
        } else {
            $threeTui = D("Merchant")->field("mer_id,name")->limit(3)->where("`status`='1' AND pic_info <> ''")->order("reg_time desc")->select();
        }
        //转换图片
        if (!empty($threeTui)) {
            foreach ($threeTui as $k => $val) {
                $threeTui[$k]['url'] = $this->getMerchantUrl($val['mer_id']);
            }
            $this->returnAjax($threeTui, 1);
        } else {
            $this->returnAjax("未获取到数据！", 0);
        }
    }

    //查询首页三个推荐活动的信息
    public function getRecommendActivities()
    {


        if ($_SESSION['areaarr'] != "all") {
            $area_idstr = implode(',', $_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`tuan_type` IN (1,0) AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (" . $area_idstr . ")";
        } else {
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`tuan_type` IN (1,0) AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
        }
        $field_condition = "`g`.`name` AS `product_name`,`g`.`s_name` AS `merchant_name`,`g`.pic AS `pics`,`g`.price,`g`.mer_id,'' AS `all_count`, '' AS `part_count`, `g`.price AS `money`,
        '' AS `pigcms_id`,`g`.begin_time , `g`.end_time ,`g`.group_id";
        $condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'merchant' => 'm');
        if ($_SESSION['areaarr'] != "all") {
            $count = D('')->field($field_condition)->table($condition_table)->where($condition_where)->count();
            if ($count != 0) {
                $group_list = D('')->field($field_condition)->table($condition_table)->where($condition_where)->order("g.group_id desc")->limit(4)->select();
            } else {
                $now_time = $_SERVER['REQUEST_TIME'];
                $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`tuan_type` IN (1,0) AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
                $group_list = D('')->field($field_condition)->table($condition_table)->where($condition_where)->order("g.group_id desc")->limit(4)->select();
            }
        } else {
            $group_list = D('')->field($field_condition)->table($condition_table)->where($condition_where)->order("g.group_id desc")->limit(4)->select();
        }

        if (!empty($group_list)) {
            $group_image_class = new group_image();
            foreach ($group_list as $k => $v) {
                $tmp_pic_arr = explode(';', $v['pics']);
                $image = $group_image_class->get_image_by_path($tmp_pic_arr[0]);
                $group_list[$k]['list_pic'] = $image["s_image"];
                $group_list[$k]['pic'] = $image["s_image"];
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
            }
            $this->returnAjax($group_list, 1);
        } else {
            $this->returnAjax("未获取到数据！", 0);
        }


    }
	
    //查询首页三个推荐活动的信息  带距离
    public function getRecommendActivities2()
    {
       $long =$_REQUEST['long'];
	   $lat=$_REQUEST['lat'];
        


		

        if ($_SESSION['areaarr'] != "all") {
            $area_idstr = implode(',', $_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`tuan_type` IN (1,0) AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (" . $area_idstr . ") AND `g`.`mer_id`=`ms`.`mer_id`";
        } else {
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`tuan_type` IN (1,0) AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `g`.`mer_id`=`ms`.`mer_id`";
        }
		
        $field_condition = "`g`.`name` AS `product_name`,`g`.`s_name` AS `merchant_name`,`g`.pic AS `pics`,`g`.price,`g`.mer_id,'' AS `all_count`, '' AS `part_count`, `g`.price AS `money`,
        '' AS `pigcms_id`,`g`.begin_time ,`g`.group_id, `g`.end_time, ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) as distance ";
        $condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'merchant' => 'm',C('DB_PREFIX') . 'merchant_store' => 'ms');
        if ($_SESSION['areaarr'] != "all") {
            $count = D('')->field($field_condition)->table($condition_table)->where($condition_where)->count();
            if ($count != 0) {
                $group_list = D('')->field($field_condition)->table($condition_table)->where($condition_where)->order("g.group_id desc")->limit(4)->select();
            } else {
                $now_time = $_SERVER['REQUEST_TIME'];
                $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`tuan_type` IN (1,0) AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `g`.`mer_id`=`ms`.`mer_id`";
                $group_list = D('')->field($field_condition)->table($condition_table)->where($condition_where)->order("g.group_id desc")->limit(4)->select();
            }
        } else {
            $group_list = D('')->field($field_condition)->table($condition_table)->where($condition_where)->order("g.group_id desc")->limit(4)->select();
        }

        if (!empty($group_list)) {
            $group_image_class = new group_image();
            foreach ($group_list as $k => $v) {
                $tmp_pic_arr = explode(';', $v['pics']);
                $image = $group_image_class->get_image_by_path($tmp_pic_arr[0]);
                $group_list[$k]['list_pic'] = $image["s_image"];
                $group_list[$k]['pic'] = $image["s_image"];
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
            }
            $this->returnAjax($group_list, 1);
        } else {
            $this->returnAjax("未获取到数据！", 0);
        }



    }

    //查询首页三个推送活动的信息
    public function getPushActivities()
    {
        $now_time = $_SERVER['REQUEST_TIME'];
        if ($_SESSION['areaarr'] != "all") {
            $area_str = implode(',', $_SESSION['areaarr']);
            $condition_where = "`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `m`.`area_id` IN (" . $area_str . ") AND term.begin_time<" . $now_time . " AND term.end_time>" . $now_time;
        } else {
            $condition_where = "`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND term.begin_time<" . $now_time . " AND term.end_time>" . $now_time;
        }
        $field_condition = "`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.pic,`eal`.all_count,`eal`.part_count,`eal`.price,`eal`.mer_id,`eal`.money,`eal`.pigcms_id,term.begin_time,term.end_time";
        $table_condition = array(C('DB_PREFIX') . 'extension_activity_list' => 'eal', C('DB_PREFIX') . 'merchant' => 'm', C('DB_PREFIX') . 'extension_activity' => 'term');
        if ($_SESSION['areaarr'] != "all") {
            $count = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->count();
            if ($count != 0) {
                $tuiactivity = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->order('`eal`.`last_time` DESC')->limit(3)->select();
            } else {
                $condition_where = "`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND term.begin_time<" . $now_time . " AND term.end_time>" . $now_time;
                $tuiactivity = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->order('`eal`.`last_time` DESC')->limit(3)->select();
            }
        } else {
            $tuiactivity = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->order('`eal`.`last_time` DESC')->limit(3)->select();
        }
        if (!empty($tuiactivity)) {
            foreach ($tuiactivity as $k => $val) {
                $tuiactivity[$k]['url'] = $this->config['site_url'] . '/mobile.php?g=Mobile&c=Activity&a=detail&activity_id=' . $val['pigcms_id'];
            }
            $this->returnAjax($tuiactivity, 1);
        } else {
            $this->returnAjax("未获取到数据！", 0);
        }
    }

    //获取首页推荐的6个特卖
    public function getRecommendGoods()
    {
        if ($_SESSION['areaarr'] != "all") {
            $area_idstr = implode(',', $_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (" . $area_idstr . ")";
        } else {
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
        }
        $condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'merchant' => 'm');
        if ($_SESSION['areaarr'] != "all") {
            $count = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->count();
            if ($count != 0) {
                $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.index_tui desc,g.index_sort desc")->limit(6)->select();
            } else {
                $now_time = $_SERVER['REQUEST_TIME'];
                $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
                $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.index_tui desc,g.index_sort desc")->limit(6)->select();
            }
        } else {
            $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.index_tui desc,g.index_sort desc")->limit(6)->select();
        }

        if (!empty($group_list)) {
            $group_image_class = new group_image();
            foreach ($group_list as $k => $v) {
                $tmp_pic_arr = explode(';', $v['pic']);
                $image = $group_image_class->get_image_by_path($tmp_pic_arr[0]);
                $group_list[$k]['list_pic'] = $image["s_image"];
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
            }
            $this->returnAjax($group_list, 1);
        } else {
            $this->returnAjax("未获取到数据！", 0);
        }
    }

    //获取首页推荐的2个特卖
    public function getPushGoods()
    {
        if ($_SESSION['areaarr'] != "all") {
            $area_idstr = implode(',', $_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (" . $area_idstr . ")";
        } else {
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
        }
        $condition_table = array(C('DB_PREFIX') . 'group' => 'g', C('DB_PREFIX') . 'merchant' => 'm');
        if ($_SESSION['areaarr'] != "all") {
            $count = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->count();
            if ($count != 0) {
                $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.last_time desc")->limit(2)->select();
            } else {
                $now_time = $_SERVER['REQUEST_TIME'];
                $condition_where = "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
                $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.last_time desc")->limit(2)->select();
            }
        } else {
            $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.virtual_num,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.last_time desc")->limit(2)->select();
        }

        if (!empty($group_list)) {
            $group_image_class = new group_image();
            foreach ($group_list as $k => $v) {
                $tmp_pic_arr = explode(';', $v['pic']);
                $image = $group_image_class->get_image_by_path($tmp_pic_arr[0]);
                $group_list[$k]['list_pic'] = $image["s_image"];
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
            }
            $this->returnAjax($group_list, 1);
        } else {
            $this->returnAjax("未获取到数据！", 0);
        }
    }
	
	/**
*  @desc 根据两点间的经纬度计算距离
*  @param float $lat 纬度值
*  @param float $lng 经度值
*/
 function getDistance($lat1, $lng1, $lat2, $lng2)
 {
     $earthRadius = 6367000; //approximate radius of earth in meters

     /*
       Convert these degrees to radians
       to work with the formula
     */

     $lat1 = ($lat1 * pi() ) / 180;
     $lng1 = ($lng1 * pi() ) / 180;

     $lat2 = ($lat2 * pi() ) / 180;
     $lng2 = ($lng2 * pi() ) / 180;

     /*
       Using the
       Haversine formula

       http://en.wikipedia.org/wiki/Haversine_formula

       calculate the distance
     */

     $calcLongitude = $lng2 - $lng1;
     $calcLatitude = $lat2 - $lat1;
     $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);  $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
     $calculatedDistance = $earthRadius * $stepTwo;

     return round($calculatedDistance);
 }
}