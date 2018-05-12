<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2015/12/11
 * Time: 14:28
 */
class IndexAction extends BaseAction{
    public function index(){
		//echo "404";die;
    	// import('@.ORG.group_page');
     //    $farm_group = D('Merchant')->where(array("status"=>1))->count();
     //    $p = new Page($farm_group,10,C('config.group_page_val'));
     //    $farm_list = D('Merchant')->where(array("status"=>1))->limit($p->firstRow.','.$p->listRows)->select();
     //    $merchant_image_class=new merchant_image();
     //    foreach($farm_list as $key=>$val) {
     //        if (!empty($val['person_image'])) {
     //            $farm_list[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
     //        }
     //        if (!empty($val['merchant_theme_image'])) {
     //            $farm_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
     //        }
     //    }
     //    $this->assign("farm_list",$farm_list);
     //    $page=$p->show();
     //    $this->assign("page",$page);
     //    $this->display();


         //所有分类 包含2级分类
        $all_category_list = D('Group_category')->get_farmcategory();
        $this->assign('all_category_list',$all_category_list);

        //所有分类 页面上
        $list_all_category_list = D('Group_category')->get_all_farmcategory();
        $this->assign('list_all_category_list',$list_all_category_list);


        //参数
        $pigcms_param = $this->get_uri_param();
        $attrs = urldecode($pigcms_param['attrs']);


        $area_url = !empty($_GET['area_url']) ? $_GET['area_url'] : 'all';
        $cat_url = !empty($_GET['cat_url']) ? $_GET['cat_url'] : 'all';
        $order = $_GET['order'];
        //地区
        if($area_url != 'all'){
            $tmp_area = D('Area')->get_area_by_areaUrl($area_url,$cat_url);
            if(empty($tmp_area)){
                $this->error('当前区域不存在！');
            }
            if($tmp_area['area_type'] == 3){
                $now_area = $tmp_area;
            }else{
                $now_circle = $tmp_area;
                $this->assign('now_circle',$now_circle);
                $now_area = D('Area')->get_area_by_areaId($tmp_area['area_pid'],true,$cat_url);
                if(empty($tmp_area)){
                    $this->error('当前区域不存在！');
                }
                $circle_url = $now_circle['area_url'];
                $area_url = $now_area['area_url'];
            }
            $area_id = $now_area['area_id'];
            $circle_list = D('Area')->get_arealist_by_areaPid($now_area['area_id'],true,$cat_url);
            if($now_circle && $circle_list){
                foreach($circle_list as &$value){
                    if($value['area_id'] == $now_circle['area_id']){
                        //$vlaue['is_hover'] = true;
                        $value['is_hover'] = true;
                    }
                }
            }
            $this->assign('now_area',$now_area);
            $this->assign('circle_list',$circle_list);
        }else{
            $area_id = 0;
        }

        if($cat_url != 'all'){

            $now_category = D('Group_category')->get_farmcategory_by_catUrl($cat_url);
            if(empty($now_category)){
                $this->error('此分类不存在！');
            }
            $this->assign('now_category',$now_category);
            if(!empty($now_category['cat_fid'])){
                $f_category = D('Group_category')->get_farmcategory_by_id($now_category['cat_fid']);
                $all_category_url = $f_category['cat_url'];
                $category_cat_field = $f_category['cat_field'];

                $top_category = $f_category;
                $this->assign('top_category',$f_category);

                $get_grouplist_catfid = 0;
                $get_grouplist_catid = $now_category['cat_id'];
            }else{
                $all_category_url = $now_category['cat_url'];
                $category_cat_field = $now_category['cat_field'];
                $top_category = $now_category;
                $this->assign('top_category',$now_category);

                $get_grouplist_catfid = $now_category['cat_id'];
                $get_grouplist_catid = 0;
            }
            $son_category_list = D('Group_category')->get_son_farmcategory_list_byid($now_category['cat_fid'],$now_category['cat_id']);
            $this->assign('son_category_list',$son_category_list);

            //小于等于一个子分类的不显示
            if(count($son_category_list) > 1 && $now_category['cat_id'] == $top_category['cat_id']){
                array_unshift($son_category_list,array('cat_name'=>'全部','cat_url'=>$all_category_url));
                $cat_option_list[] = array('txt_desc'=>'分类','row_type'=>'category','category_list'=>$son_category_list);
            }
        }else {
            $get_grouplist_catid = 0;
            $get_grouplist_catfid = 0;

            //顶部广告
            $index_top_adver = D('Adver')->get_adver_by_key('index_top');
            $this->assign('index_top_adver',$index_top_adver);

            //所有区域
            $all_area_list = D('Area')->get_area_list();
            $this->assign('all_area_list',$all_area_list);


            $category_list = $list_all_category_list;
            array_unshift($category_list,array('cat_name'=>'全部','cat_url'=>'all'));
            $cat_option_list[] = array('txt_desc'=>'分类','row_type'=>'category','category_list'=>$category_list);
            //加入是否是全国区域的判断，如果是全国的情况下不显现地区和商圈
            if(empty($circle_list)&&$_SESSION['areaarr']!="all"){
                array_unshift($all_area_list,array('area_name'=>'全部','area_url'=>'all'));
                $cat_option_list[] = array('txt_desc'=>'区域','row_type'=>'area','area_list'=>$all_area_list);
            }
            /*elseif($_SESSION['areaarr']!="all"&&!empty($circle_list)){
                $this->assign('area_list',$all_area_list);
                array_unshift($circle_list,array('area_name'=>'全部商圈','area_url'=>''));
                $cat_option_list[] = array('txt_desc'=>'商圈','row_type'=>'circle','circle_list'=>$circle_list);
            }*/
        }
        $this->assign(D('Merchant')->get_farm_list_by_catid($get_grouplist_catid,$get_grouplist_catfid,$cat_url,$area_id,$now_circle['area_id'],$order,$attrs,$category_cat_field));
        //顶部条件输出
        $cat_option_html = $this->get_cat_option_html($cat_option_list,$cat_url,$area_url,$circle_url,$order,$attrs);
        $this->assign('cat_option_html',$cat_option_html);
        $this->assign("farm_category_all",$this->config['site_url'] . '/farm/all/all');
        $this->display();

    }

    public function searchByArea(){
            //所有地区
            $allareas=null;
        if(!empty($_GET['area_name'])){
            $area_name=$_GET['area_name'];
            $Area=D("area");
            $areas=$Area->where("is_open=1 AND area_name like '%".$area_name."%'")->select();
            foreach ($areas as $key => $val) {
                $allareas[]=$val['area_id'];
                $childareas=$Area->where("area_pid=".$val['area_id'])->select();
                if(!empty($childareas)){
                foreach($childareas as $childval){
                    $allareas[]=$childval['area_id'];
                }
                }
            }
        }

        if(!empty($_POST['area_name'])){
            $area_name=$_POST['area_name'];
            $Area=D("area");
            $areas=$Area->where("is_open=1 AND area_name like '%".$area_name."%'")->select();
            foreach ($areas as $key => $val) {
                $allareas[]=$val['area_id'];
                $childareas=$Area->where("area_pid=".$val['area_id'])->select();
                if(!empty($childareas)){
                foreach($childareas as $childval){
                    $allareas[]=$childval['area_id'];
                }
                }   
            }
        }
        if(!empty($allareas)){
            $area_idstr=implode(',',$allareas);
            import('@.ORG.group_page');
            $farm_group = D('Merchant')->where("status=1 AND area_id IN (".$area_idstr.") AND `person_name` <> '' AND `person_image` <> '' AND `person_info` <> ''")->count();
            $p = new Page($farm_group,10,C('config.group_page_val'));
            $farm_list = D('Merchant')->where("status=1 AND area_id IN (".$area_idstr.") AND `person_name` <> '' AND `person_image` <> '' AND `person_info` <> ''")->limit($p->firstRow.','.$p->listRows)->select();
            $merchant_image_class=new merchant_image();
            foreach($farm_list as $key=>$val) {
            if (!empty($val['person_image'])) {
                $farm_list[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
            }
            if (!empty($val['merchant_theme_image'])) {
                $farm_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            }
            }
             $page=$p->show();
             $this->assign("page",$page);
            $this->assign("farm_list",$farm_list);
            $this->display("index/searchResult");
        }else{
            $this->display("index/searchResult");
        }
    }

    public function searchByTitle(){
            import('@.ORG.group_page');
            $title=$_POST['title_name'];
            $farm_group = D('Merchant')->where("status=1  AND `person_name` <> '' AND `person_image` <> '' AND `person_info` <> '' AND name like '%".$title."%' OR txt_info like '%".$title."%' OR person_name like '%".$title."%' OR person_info like '%".$title."%'")->count();
            $p = new Page($farm_group,10,C('config.group_page_val'));
            $farm_list = D('Merchant')->where("status=1  AND `person_name` <> '' AND `person_image` <> '' AND `person_info` <> '' AND name like '%".$title."%' OR txt_info like '%".$title."%' OR person_name like '%".$title."%' OR person_info like '%".$title."%'")->limit($p->firstRow.','.$p->listRows)->select();
            $merchant_image_class=new merchant_image();
            foreach($farm_list as $key=>$val) {
            if (!empty($val['person_image'])) {
                $farm_list[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
            }
            if (!empty($val['merchant_theme_image'])) {
                $farm_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            }
            }
            $page=$p->show();
            $this->assign("page",$page);
            $this->assign("farm_list",$farm_list);
            $this->display("index/searchResult");
    }

    public function searchByKw(){
        $keyword=$_GET['kw'];
        if(!empty($keyword)){
            $farm_group = D('Merchant')->where("status=1 AND `person_name` <> '' AND `person_image` <> '' AND `person_info` <> '' AND name like '%".$keyword."%' OR txt_info like '%".$keyword."%' OR person_name like '%".$keyword."%' OR person_info like '%".$keyword."%'")->count();
            $p = new Page($farm_group,10,C('config.group_page_val'));
            $farm_list = D('Merchant')->where("status=1 AND `person_name` <> '' AND `person_image` <> '' AND `person_info` <> '' AND name like '%".$keyword."%' OR txt_info like '%".$keyword."%' OR person_name like '%".$keyword."%' OR person_info like '%".$keyword."%'")->limit($p->firstRow.','.$p->listRows)->select();
            $merchant_image_class=new merchant_image();
            foreach($farm_list as $key=>$val) {
            if (!empty($val['person_image'])) {
                $farm_list[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
            }
            if (!empty($val['merchant_theme_image'])) {
                $farm_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            }
            }
            $page=$p->show();
            $this->assign("page",$page);
            $this->assign("farm_list",$farm_list);
            $this->display("index/searchResult");
        }else{
            $this->display("index/searchResult");
        }
    }




    //头部条件
    protected function get_cat_option_html($cat_option_list,$cat_url,$area_url,$circle_url,$order,$attrs){
        if(!empty($attrs)){
            $attr_tmp_arr = explode(';',$attrs);
            if(!empty($attr_tmp_arr)){
                foreach($attr_tmp_arr as $key=>$value){
                    $attr_tmp_value = explode(':',$value);
                    $attrs_arr[$attr_tmp_value[0]] = $attr_tmp_value[1];
                }
            }
        }
        $cat_option_html = '';
        foreach($cat_option_list as $key=>$value){
            $cat_option_html .= '<div class="filter-label-list filter-section category-filter-wrapper log-mod-viewed '.($key==0 ? 'first-filter' :'').($value['row_type']=='custom_1' ? 'filter-sect--multi' : '').'">';
            $cat_option_html .= '<div class="label has-icon">'.$value['txt_desc'].'：</div>';
            $cat_option_html .= '<ul class="filter-sect-list">';

            if($value['row_type'] == 'category'){
                foreach($value['category_list'] as $k=>$v){
                    $cat_option_html .= '<li class="item'.($cat_url==$v['cat_url'] ? ' current' : '').'"><a '.($v['is_hot'] ? 'class="briber"' : '').' href="'.$this->get_cat_option_url($v['cat_url'],$area_url,$order,$attrs).'">'.$v['cat_name'].'</a></li>';
                }
            }else if($value['row_type'] == 'area'){
                foreach($value['area_list'] as $k=>$v){
                    $cat_option_html .= '<li '.($area_url==$v['area_url'] ? 'class="current"' : '').'><a href="'.$this->get_cat_option_url($cat_url,$v['area_url'],$order,$attrs).'">'.$v['area_name'].'</a></li>';
                }
            }
            else if($value['row_type'] == 'circle'){
                foreach($value['circle_list'] as $k=>$v){
                    if(empty($v) && empty($circle_url)){
                        $tmp_current = true;
                    }else if($circle_url == $v['area_url']){
                        $tmp_current = true;
                    }else{
                        $tmp_current = false;
                    }
                    $cat_option_html .= '<li '.($tmp_current ? 'class="current"' : '').'><a href="'.$this->get_cat_option_url($cat_url,$v['area_url'],$order,$attrs,$area_url).'">'.$v['area_name'].'</a></li>';
                }
            }
            $cat_option_html .= '</ul>';
            $cat_option_html .= '</div>';
        }
        return $cat_option_html;
    }

    protected function get_cat_option_url($cat_url,$area_url,$order,$attrs,$p_url=''){
        if($order){
            if($attrs){
                return C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'/'.$order.'?attrs='.urlencode($attrs);
            }else{
                return C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'/'.$order;
            }
        }else{
            if($attrs){
                return C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'?attrs='.urlencode($attrs);
            }else if(!empty($area_url)){
                return C('config.site_url').'/farm/'.$cat_url.'/'.$area_url;
            }else{
                return C('config.site_url').'/farm/'.$cat_url.'/'.$p_url;
            }
        }
    }
    protected function get_cat_sort_url($cat_url,$area_url,$attrs){
        if($attrs){
            $return['default_sort_url'] = C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'?attrs='.urlencode($attrs);
            $return['hot_sort_url'] = C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'/hot?attrs='.urlencode($attrs);
            $return['price_asc_sort_url'] = C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'/price-asc?attrs='.urlencode($attrs);
            $return['price_desc_sort_url'] = C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'/price-desc?attrs='.urlencode($attrs);
            $return['rating_sort_url'] = C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'/rating?attrs='.urlencode($attrs);
            $return['time_sort_url'] = C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'/time?attrs='.urlencode($attrs);
        }else{
            $return['default_sort_url'] = C('config.site_url').'/farm/'.$cat_url.'/'.$area_url;
            $return['hot_sort_url'] = C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'/hot';
            $return['price_asc_sort_url'] = C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'/price-asc';
            $return['price_desc_sort_url'] = C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'/price-desc';
            $return['rating_sort_url'] = C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'/rating';
            $return['time_sort_url'] = C('config.site_url').'/farm/'.$cat_url.'/'.$area_url.'/time';
        }
        return $return;
    }
}