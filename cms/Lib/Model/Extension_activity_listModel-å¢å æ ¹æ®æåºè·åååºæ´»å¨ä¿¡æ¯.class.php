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
        $result=$this->alias("a")->field("a.*,t.begin_time,t.end_time")->join(C("DB_PREFIX")."extension_activity t ON a.activity_term=t.activity_id")->where(array("a.status"=>1,"a.mer_id"=>$mer_id))->limit($p->firstRow,$p->listRows)->select();
        if(!empty($result)) {
            foreach($result as $k=>$val) {
                $extend_image = new Extension_image();
                $result[$k]['pic'] = $extend_image->get_allImage_by_path($val['pic']);
            }
        }
        return $result;
    }
}