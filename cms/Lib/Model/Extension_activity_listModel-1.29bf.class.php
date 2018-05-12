<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/25
 * Time: 15:42
 */
class Extension_activity_listModel extends Model{
    //根据农场id获取对应的农场活动信息
    public function getActivityListByMerchant($mer_id){
        import('@.ORG.page');
        $count_activity=$this->where(array("status"=>1,"mer_id"=>$mer_id))->count();
        $p = new Page($count_activity, 10,"p");
        $result=$this->alias("a")->field("a.*,t.begin_time,t.end_time")->join(C("DB_PREFIX")."extension_activity t ON a.activity_term=t.activity_id")->where(array("a.status"=>1,"a.mer_id"=>$mer_id,"t.begin_time"=>array("lt",$now_time),"t.end_time"=>array("gt",$now_time)))->limit($p->firstRow,$p->listRows)->select();
        if(!empty($result)) {
            foreach($result as $k=>$val) {
                $extend_image = new Extension_image();
                $result[$k]['pic'] = $extend_image->get_allImage_by_path($val['pic']);
            }
        }
        return $result;
    }
    //根据农场id和排序获取对应的农场活动信息
    public function getActivityListByMerchantOrder($mer_id,$order){
        $now_time = $_SERVER['REQUEST_TIME'];
        switch($order){
            case 'price-asc':
                $order = 'newprice ASC,`a`.`pigcms_id` DESC';
                break;
            case 'price-desc':
                $order = 'newprice DESC,`a`.`pigcms_id` DESC';
                break;
            case 'hot':
                $order = '`a`.`part_count` DESC,`a`.`pigcms_id` DESC';
                break;
            default:
                $order = '`a`.`index_sort` DESC,`a`.`pigcms_id` DESC';
        }
        import('@.ORG.page');
        $count_activity=$this->where(array("status"=>1,"mer_id"=>$mer_id))->count();
        $p = new Page($count_activity, 10,"p");
        $result=$this->alias("a")->field("a.*,t.begin_time,t.end_time,(a.price+a.money) AS newprice")->join(C("DB_PREFIX")."extension_activity t ON a.activity_term=t.activity_id")->where(array("a.status"=>1,"a.mer_id"=>$mer_id,"t.begin_time"=>array("lt",$now_time),"t.end_time"=>array("gt",$now_time)))->limit($p->firstRow,$p->listRows)->order($order)->select();
        if(!empty($result)) {
            foreach($result as $k=>$val) {
                $extend_image = new Extension_image();
                $result[$k]['pic'] = $extend_image->get_allImage_by_path($val['pic']);
                $result[$k]['url'] = $this->config['site_url'].'/mobile.php?g=Mobile&c=Activity&a=detail&activity_id='.$val['pigcms_id'];
            }
        }
        return $result;
    }
}