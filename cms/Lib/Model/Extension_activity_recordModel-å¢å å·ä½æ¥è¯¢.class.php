<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/8
 * Time: 10:59
 */
class Extension_activity_recordModel extends Model{

    //获取用户参加的活动列表
    public function getJoinActivity($uid){
        $Model=new Model();
        import('@.ORG.page');
        $count_activity=$this->where("uid=".$uid)->count();
        $p = new Page($count_activity, 10);
        $sql="SELECT record.*,realactivity.name,realactivity.pic,realactivity.begin_time,realactivity.end_time,realactivity.all_count,realactivity.part_count as has_part,realactivity.price from ".C('DB_PREFIX')."extension_activity_record record LEFT JOIN (SELECT activity.*,term.begin_time,term.end_time FROM ".
            C('DB_PREFIX')."extension_activity_list activity LEFT JOIN ".C('DB_PREFIX')."extension_activity term ON activity.activity_term=term.activity_id) AS realactivity ON record.activity_list_id=realactivity.pigcms_id WHERE record.uid=".$uid;
        $sql.= " ORDER BY time DESC LIMIT {$p->firstRow}, {$p->listRows}";
        $result=$Model->query($sql);
        $return['pagebar']=$p->show();
        $return['activites']=$result;
        return $return;
    }
    //获取正在进行的活动列表
    public function getIngActivity($uid){
        $Model=new Model();
        import('@.ORG.page');
        $count_activity=$this->where("uid=".$uid)->count();
        $p = new Page($count_activity, 10);
        $sql="SELECT record.*,realactivity.name,realactivity.pic,realactivity.begin_time,realactivity.end_time,realactivity.all_count,realactivity.part_count as has_part,realactivity.price from ".C('DB_PREFIX')."extension_activity_record record LEFT JOIN (SELECT activity.*,term.begin_time,term.end_time FROM ".
            C('DB_PREFIX')."extension_activity_list activity LEFT JOIN ".C('DB_PREFIX')."extension_activity term ON activity.activity_term=term.activity_id) AS realactivity ON record.activity_list_id=realactivity.pigcms_id WHERE record.uid=".$uid." AND time>begin_time AND time<end_time";
        $sql.= " ORDER BY time DESC LIMIT {$p->firstRow}, {$p->listRows}";
        $result=$Model->query($sql);
        $return['pagebar']=$p->show();
        $return['activites']=$result;
        return $return;
    }
    //获取正在进行的活动列表
    public function getEndActivity($uid){
        $Model=new Model();
        import('@.ORG.page');
        $count_activity=$this->where("uid=".$uid)->count();
        $p = new Page($count_activity, 10);
        $sql="SELECT record.*,realactivity.name,realactivity.pic,realactivity.begin_time,realactivity.end_time,realactivity.all_count,realactivity.part_count as has_part,realactivity.price from ".C('DB_PREFIX')."extension_activity_record record LEFT JOIN (SELECT activity.*,term.begin_time,term.end_time FROM ".
            C('DB_PREFIX')."extension_activity_list activity LEFT JOIN ".C('DB_PREFIX')."extension_activity term ON activity.activity_term=term.activity_id) AS realactivity ON record.activity_list_id=realactivity.pigcms_id WHERE record.uid=".$uid." AND time>end_time";
        $sql.= " ORDER BY time DESC LIMIT {$p->firstRow}, {$p->listRows}";
        $result=$Model->query($sql);
        $return['pagebar']=$p->show();
        $return['activites']=$result;
        return $return;
    }
}

?>