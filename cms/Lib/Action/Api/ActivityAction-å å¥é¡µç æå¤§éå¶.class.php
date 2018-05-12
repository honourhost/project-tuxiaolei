<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/8
 * Time: 14:03
 */
class ActivityAction extends BaseAction{
    //活动列表
    public function index(){
        if($_SESSION['areaarr']!="all"){
            $area_str=implode(',',$_SESSION['areaarr']);
            $condition_where="`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `m`.`area_id` IN (".$area_str.")";
        }else{
            $condition_where="`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id";
        }
        $field_condition="`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.pic,`eal`.all_count,`eal`.part_count,`eal`.price,`eal`.mer_id,`eal`.money,`eal`.pigcms_id,term.begin_time,term.end_time";
        $table_condition=array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'extension_activity'=>'term');
        $tp_count = D('')->field('count(distinct(`eal`.`pigcms_id`)) AS `picms_count`')->table($table_condition)->where($condition_where)->find();
        if($tp_count){
            import('@.ORG.activity_page');
            $P = new Page($tp_count['picms_count'],20,'page');
            $activity_list = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->order('`eal`.`pigcms_id` DESC')->limit($P->firstRow.','.$P->listRows)->select();
        }
        if($activity_list){
            $extension_image_class = new extension_image();
            foreach($activity_list as &$value){
                $value['list_pic'] = $extension_image_class->get_image_by_path(array_shift(explode(';',$value['pic'])),'s');
                $value['url'] = $this->config['site_url'].'/mobile.php?g=Mobile&c=Activity&a=detail&activity_id='.$value['pigcms_id'];
                $value['money'] = floatval($value['money']);
            }
        }
       if(!empty($activity_list)){
            $this->returnAjax($activity_list,1);
        }else{
            $this->returnAjax("没有获取到数据",0);
        }
    }
}