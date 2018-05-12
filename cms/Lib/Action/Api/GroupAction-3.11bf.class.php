<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/8
 * Time: 13:44
 */
class GroupAction extends BaseAction{
    //首页的特卖推荐列表选出10个先
    public function index(){
        $condition_where=" g.index_tui=1 AND ";
        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where.= "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (".$area_idstr.")";
        }else{
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where.= "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
        }
        import('@.ORG.group_page');
        $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');
        $count_group = D('')->table($condition_table)->where($condition_where)->count();
        $p = new Page($count_group,15,"p");

        //加入页码最大限制，超过最大值返回空
            $req_page=$_GET['p'];
            $max_page=ceil($count_group/15);
            if($req_page>$max_page){
                $this->returnAjax("没有更多数据了",0);
            }

        $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.index_sort desc")->limit($p->firstRow.','.$p->listRows)->select();
        if($group_list){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
            }
        }
        $return['pagebar'] = $p->show();
        $return['group_list']=$group_list;
        if(!empty($return['group_list'])){
            $this->returnAjax($return['group_list'],1);
        }else{
            $this->returnAjax("未获取到信息",0);
        }
    }
    public function get_group_url($group_id){
            return C('config.site_url').'/mobile.php?g=Mobile&c=Group&a=detail&group_id='.$group_id;
    }
    //精品推荐
    public function recommend(){
        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where= "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1' AND `m`.`area_id` in (".$area_idstr.")";
        }else{
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where= "`g`.`mer_id`=`m`.`mer_id` AND `g`.`status`='1' AND `g`.`type`='1' AND `g`.`begin_time`<'$now_time' AND `g`.`end_time`>'$now_time'  AND `m`.`status`='1'";
        }
        import('@.ORG.group_page');
        $condition_table = array(C('DB_PREFIX').'group'=>'g',C('DB_PREFIX').'merchant'=>'m');

        $count_group = D('')->table($condition_table)->where($condition_where)->count();

        $maxPage=ceil($count_group/15);

        if($_GET['p']>$maxPage){
            $this->returnAjax("没有更多数据了！",0);
        }
        $p = new Page($count_group,15,"p");
        $group_list = D('')->field("g.group_id,g.name,g.s_name,g.prefix_title,g.pic,g.price,g.old_price,g.sale_count,g.wx_cheap")->table($condition_table)->where($condition_where)->order("g.sale_count desc")->limit($p->firstRow.','.$p->listRows)->select();
        if($group_list){
            $group_image_class = new group_image();
            foreach($group_list as $k=>$v){
                $tmp_pic_arr = explode(';',$v['pic']);
                $group_list[$k]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0],'s');
                $group_list[$k]['url'] = $this->get_group_url($v['group_id']);
            }
        }
        $return['pagebar'] = $p->show();
        $return['group_list']=$group_list;
        if(!empty($return['group_list'])){
            $this->returnAjax($return['group_list'],1);
        }else{
            $this->returnAjax("未获取到信息",0);
        }
    }
}