<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/8
 * Time: 10:59
 */
class Extension_activity_recordModel extends Model{

    //获取用户参加的活动列表
    public function getJoinActivity($uid,$x,$y){
        $Model=new Model();
        import('@.ORG.page');
        $count_activity=$this->where("uid=".$uid)->count();

        //加入页码最大限制，超过最大值返回空
                $req_page=$_GET['p'];
                $max_page=ceil($count_activity/15);
                if($req_page>$max_page){
                    return "";
                }


        $p = new Page($count_activity, 15,"p");
        // $sql="SELECT record.*,realactivity.name,realactivity.pic,realactivity.begin_time,realactivity.end_time,realactivity.all_count,realactivity.part_count as has_part,realactivity.price from ".C('DB_PREFIX')."extension_activity_record record LEFT JOIN (SELECT activity.*,term.begin_time,term.end_time FROM ".
        //     C('DB_PREFIX')."extension_activity_list activity LEFT JOIN ".C('DB_PREFIX')."extension_activity term ON activity.activity_term=term.activity_id) AS realactivity ON record.activity_list_id=realactivity.pigcms_id WHERE record.uid=".$uid;
        // $sql.= " ORDER BY time DESC LIMIT {$p->firstRow}, {$p->listRows}";
        $sql="SELECT result.*,mr.name as farm_name,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$x}*PI()/180-mr.`lat`*PI()/180)/2),2)+COS({$x}*PI()/180)*COS(mr.`lat`*PI()/180)*POW(SIN(({$y}*PI()/180-mr.`long`*PI()/180)/2),2)))*1000) AS distance FROM (SELECT record.*,realactivity.mer_id,realactivity.name,realactivity.pic,realactivity.begin_time,realactivity.end_time,realactivity.all_count,realactivity.part_count as has_part,realactivity.price,realactivity.type,realactivity.money from ".C('DB_PREFIX')."extension_activity_record record LEFT JOIN (SELECT activity.*,term.begin_time,term.end_time FROM ".
            C('DB_PREFIX')."extension_activity_list activity LEFT JOIN ".C('DB_PREFIX')."extension_activity term ON activity.activity_term=term.activity_id) AS realactivity ON record.activity_list_id=realactivity.pigcms_id WHERE record.uid=".$uid;
        $sql.= ") as result LEFT JOIN (SELECT m.name,m.mer_id,s.long,s.lat FROM ".C('DB_PREFIX')."merchant m LEFT JOIN ".C('DB_PREFIX')."merchant_store s ON m.mer_id=s.mer_id) as mr ON result.mer_id=mr.mer_id  ORDER BY time DESC LIMIT {$p->firstRow}, {$p->listRows}";
         
        $result=$Model->query($sql);
        $return['pagebar']=$p->show();
        $return['activites']=$result;
        return $return;
    }
    //获取正在进行的活动列表
    public function getIngActivity($uid,$x,$y){
        $Model=new Model();
        import('@.ORG.page');
        $count_activity=$this->where("uid=".$uid)->count();

        //加入页码最大限制，超过最大值返回空
                $req_page=$_GET['p'];
                $max_page=ceil($count_activity/15);
                if($req_page>$max_page){
                    return "";
                }


        $p = new Page($count_activity, 15,"p");
        // $sql="SELECT record.*,realactivity.name,realactivity.pic,realactivity.begin_time,realactivity.end_time,realactivity.all_count,realactivity.part_count as has_part,realactivity.price from ".C('DB_PREFIX')."extension_activity_record record LEFT JOIN (SELECT activity.*,term.begin_time,term.end_time FROM ".
        //     C('DB_PREFIX')."extension_activity_list activity LEFT JOIN ".C('DB_PREFIX')."extension_activity term ON activity.activity_term=term.activity_id) AS realactivity ON record.activity_list_id=realactivity.pigcms_id WHERE record.uid=".$uid." AND time>begin_time AND time<end_time";
        // $sql.= " ORDER BY time DESC LIMIT {$p->firstRow}, {$p->listRows}";
         $sql="SELECT result.*,mr.name as farm_name,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$x}*PI()/180-mr.`lat`*PI()/180)/2),2)+COS({$x}*PI()/180)*COS(mr.`lat`*PI()/180)*POW(SIN(({$y}*PI()/180-mr.`long`*PI()/180)/2),2)))*1000) AS distance FROM (SELECT record.*,realactivity.mer_id,realactivity.name,realactivity.pic,realactivity.begin_time,realactivity.end_time,realactivity.type,realactivity.money,realactivity.price from ".C('DB_PREFIX')."extension_activity_record record LEFT JOIN (SELECT activity.*,term.begin_time,term.end_time FROM ".
            C('DB_PREFIX')."extension_activity_list activity LEFT JOIN ".C('DB_PREFIX')."extension_activity term ON activity.activity_term=term.activity_id) AS realactivity ON record.activity_list_id=realactivity.pigcms_id WHERE record.uid=".$uid." AND time>begin_time AND time<end_time";
        $sql.= ") as result LEFT JOIN (SELECT m.name,m.mer_id,s.long,s.lat FROM ".C('DB_PREFIX')."merchant m LEFT JOIN ".C('DB_PREFIX')."merchant_store s ON m.mer_id=s.mer_id) as mr ON result.mer_id=mr.mer_id  ORDER BY time DESC LIMIT {$p->firstRow}, {$p->listRows}";
        
        $result=$Model->query($sql);
        $return['pagebar']=$p->show();
        $return['activites']=$result;
        return $return;
    }
    //获取正在进行的活动列表
    public function getEndActivity($uid,$x,$y){
        $Model=new Model();
        import('@.ORG.page');
        $count_activity=$this->where("uid=".$uid)->count();

        //加入页码最大限制，超过最大值返回空
                $req_page=$_GET['p'];
                $max_page=ceil($count_activity/15);
                if($req_page>$max_page){
                    return "";
                }


        $p = new Page($count_activity, 15,"p");
        // $sql="SELECT record.*,realactivity.name,realactivity.pic,realactivity.begin_time,realactivity.end_time,realactivity.all_count,realactivity.part_count as has_part,realactivity.price from ".C('DB_PREFIX')."extension_activity_record record LEFT JOIN (SELECT activity.*,term.begin_time,term.end_time FROM ".
        //     C('DB_PREFIX')."extension_activity_list activity LEFT JOIN ".C('DB_PREFIX')."extension_activity term ON activity.activity_term=term.activity_id) AS realactivity ON record.activity_list_id=realactivity.pigcms_id WHERE record.uid=".$uid." AND time>end_time";
        // $sql.= " ORDER BY time DESC LIMIT {$p->firstRow}, {$p->listRows}";
        $sql="SELECT result.*,mr.name as farm_name,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$x}*PI()/180-mr.`lat`*PI()/180)/2),2)+COS({$x}*PI()/180)*COS(mr.`lat`*PI()/180)*POW(SIN(({$y}*PI()/180-mr.`long`*PI()/180)/2),2)))*1000) AS distance FROM (SELECT record.*,realactivity.mer_id,realactivity.name,realactivity.pic,realactivity.begin_time,realactivity.end_time,realactivity.type,realactivity.money,realactivity.price from ".C('DB_PREFIX')."extension_activity_record record LEFT JOIN (SELECT activity.*,term.begin_time,term.end_time FROM ".
            C('DB_PREFIX')."extension_activity_list activity LEFT JOIN ".C('DB_PREFIX')."extension_activity term ON activity.activity_term=term.activity_id) AS realactivity ON record.activity_list_id=realactivity.pigcms_id WHERE record.uid=".$uid." AND time>end_time";
        $sql.= ") as result LEFT JOIN (SELECT m.name,m.mer_id,s.long,s.lat FROM ".C('DB_PREFIX')."merchant m LEFT JOIN ".C('DB_PREFIX')."merchant_store s ON m.mer_id=s.mer_id) as mr ON result.mer_id=mr.mer_id  ORDER BY time DESC LIMIT {$p->firstRow}, {$p->listRows}";
        
        $result=$Model->query($sql);
        $return['pagebar']=$p->show();
        $return['activites']=$result;
        return $return;
    }
}

?>