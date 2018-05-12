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
            $now_time = $_SERVER['REQUEST_TIME'];
            $area_str=implode(',',$_SESSION['areaarr']);
            $condition_where="`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `term`.`begin_time`<'$now_time' AND `term`.`end_time`>'$now_time' AND `m`.`area_id` IN (".$area_str.")";
        }else{
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where="`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `term`.`begin_time`<'$now_time' AND `term`.`end_time`>'$now_time'";
        }
        $field_condition="`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.pic,`eal`.all_count,`eal`.part_count,`eal`.type,`eal`.price,`eal`.mer_id,`eal`.money,`eal`.pigcms_id,term.begin_time,term.end_time";
        $table_condition=array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'extension_activity'=>'term');
        $tp_count = D('')->field('count(distinct(`eal`.`pigcms_id`)) AS `picms_count`')->table($table_condition)->where($condition_where)->find();
        if($tp_count){
            //加入页码最大限制，超过最大值返回空
            $req_page=$_GET['p'];
            $max_page=ceil($tp_count['picms_count']/15);
            if($req_page>$max_page){
                $this->returnAjax("没有更多数据了",0);
            }

            import('@.ORG.activity_page');
            $P = new Page($tp_count['picms_count'],15,'p');


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

    //分类活动列表
    public function getTypeActivity(){
        //首先获取类型参数
        $type=intval($_GET['type']);
        //根据传来的类型查询
        /**
         * 49、垂钓
         * 50、采摘
         * 51、烧烤
         * 52、自助行
         * 53、农场众筹
         * 54、种菜
         * 55、农家宴
         */
            if($_SESSION['areaarr']!="all"){
                $now_time = $_SERVER['REQUEST_TIME'];
                $area_str=implode(',',$_SESSION['areaarr']);
                $condition_where="`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `term`.`begin_time`<'$now_time' AND `term`.`end_time`>'$now_time' AND `m`.`area_id` IN (".$area_str.")AND `eal`.`activity_type_id`=".$type;
            }else{
                $now_time = $_SERVER['REQUEST_TIME'];
                $condition_where="`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `term`.`begin_time`<'$now_time' AND `term`.`end_time`>'$now_time' AND `eal`.`activity_type_id`=".$type;
            }
            $field_condition="`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.pic,`eal`.all_count,`eal`.part_count,`eal`.type,`eal`.price,`eal`.mer_id,`eal`.money,`eal`.pigcms_id,term.begin_time,term.end_time";
            $table_condition=array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'extension_activity'=>'term');
            $tp_count = D('')->field('count(distinct(`eal`.`pigcms_id`)) AS `picms_count`')->table($table_condition)->where($condition_where)->find();
            if($tp_count){
                //加入页码最大限制，超过最大值返回空
                $req_page=$_GET['p'];
                $max_page=ceil($tp_count['picms_count']/15);
                if($req_page>$max_page){
                    $this->returnAjax("没有更多数据了",0);
                }

                import('@.ORG.activity_page');
                $P = new Page($tp_count['picms_count'],15,'p');


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
    //更多
    public function getOtherTypeActivity(){
        //除去要去掉的5个分类
        $type="NOT IN (49,50,51,54,55)";
        //根据传来的类型查询
        /**
         * 49、垂钓
         * 50、采摘
         * 51、烧烤
         * 52、自助行
         * 53、农场众筹
         * 54、种菜
         * 55、农家宴
         */
        if($_SESSION['areaarr']!="all"){
            $now_time = $_SERVER['REQUEST_TIME'];
            $area_str=implode(',',$_SESSION['areaarr']);
            $condition_where="`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `term`.`begin_time`<'$now_time' AND `term`.`end_time`>'$now_time' AND `m`.`area_id` IN (".$area_str.") AND `eal`.`activity_type_id` ".$type;
        }else{
            $now_time = $_SERVER['REQUEST_TIME'];
            $condition_where="`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `term`.`begin_time`<'$now_time' AND `term`.`end_time`>'$now_time' AND `eal`.`activity_type_id` ".$type;
        }
        $field_condition="`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.pic,`eal`.all_count,`eal`.part_count,`eal`.type,`eal`.price,`eal`.mer_id,`eal`.money,`eal`.pigcms_id,term.begin_time,term.end_time";
        $table_condition=array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'extension_activity'=>'term');
        $tp_count = D('')->field('count(distinct(`eal`.`pigcms_id`)) AS `picms_count`')->table($table_condition)->where($condition_where)->find();
        if($tp_count){
            //加入页码最大限制，超过最大值返回空
            $req_page=$_GET['p'];
            $max_page=ceil($tp_count['picms_count']/15);
            if($req_page>$max_page){
                $this->returnAjax("没有更多数据了",0);
            }

            import('@.ORG.activity_page');
            $P = new Page($tp_count['picms_count'],15,'p');


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
    //最新3个活动
    public function getNewestActivity(){
        //当前时间
        $now_time = $_SERVER['REQUEST_TIME'];
        //一周前时间
        $oneweekearly=$now_time-7*24*60*60;

        if($_SESSION['areaarr']!="all"){
            $area_str=implode(',',$_SESSION['areaarr']);
            $condition_where="`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `term`.`begin_time`<'$now_time' AND `term`.`end_time`>'$now_time' AND `m`.`area_id` IN (".$area_str.")";
        }else{
            $condition_where="`eal`.`status`='1' AND `eal`.`mer_id`=`m`.`mer_id` AND `eal`.`activity_term`=term.activity_id AND `term`.`begin_time`<'$now_time' AND `term`.`end_time`>'$now_time'";
        }
        $field_condition="`eal`.`name` AS `product_name`,`m`.`name` AS `merchant_name`,`eal`.pic,`eal`.all_count,`eal`.part_count,`eal`.type,`eal`.price,`eal`.mer_id,`eal`.money,`eal`.pigcms_id,term.begin_time,term.end_time";
        $table_condition=array(C('DB_PREFIX').'extension_activity_list'=>'eal',C('DB_PREFIX').'merchant'=>'m',C('DB_PREFIX').'extension_activity'=>'term');

        $activity_list = D('')->field($field_condition)->table($table_condition)->where($condition_where)->group('`eal`.`pigcms_id`')->order('`eal`.`pigcms_id` DESC')->limit(1,3)->select();
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