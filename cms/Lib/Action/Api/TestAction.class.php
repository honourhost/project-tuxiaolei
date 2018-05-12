<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/8
 * Time: 14:03
 */
class TestAction extends BaseAction{
    //活动列表
    public function index(){
    	$sql='SELECT user_name FROM pigcms_member WHERE user_id>=2569522 AND user_name REGEXP "^[0-9]{1,}$"';
        $result=M('')->query($sql);
        //password="96e79218965eb72c92a549dd5a330112"
        //查处后遍历
        foreach($result as $key=>$val){
        	if(strlen($val['user_name'])>10){
        	$user_name=substr_replace($val['user_name'],'*****',3,5);
        	}else{
        		$user_name=substr_replace($val['user_name'],'**',2,2);
        	}
        	$password="96e79218965eb72c92a549dd5a330112";
        	$result[$key]['nickname']=$user_name;
        	$result[$key]['pwd']=$password;
        	$result[$key]['phone']=$val['user_name'];
        	$result[$key]['add_time']=time();
        	$result[$key]['status']=1;
        	unset($result[$key]['user_name']);
        }
       	$res=M("User")->addAll($result);
       	print_r($res);
    }

    public function getMd5(){
    	echo md5('111111');
    }


    public function  test(){
        $sql="SELECT gb.* ,unix_timestamp(),g.is_lottery_group_buy,g.is_first_free FROM pigcms_group_buy gb LEFT JOIN pigcms_group g ON gb.group_id=g.group_id WHERE gb.`create_time` > unix_timestamp()-48*60*60 AND gb.`create_time` < unix_timestamp()-24*60*60 AND gb.status = 0";
         $result=M('')->query($sql);
        if(!empty($result)){
            foreach ($result as $key=>$value){
                if($value["is_lottery_group_buy"]==1){
                    echo  "抽奖团".$value['sun_id'];
                }elseif ($value["is_first_fee"]==1){
                    echo "团长免单".$value['sun_id'];
                }else{
                    echo "普通拼团".$value['sun_id'];
                 //  D("Group_buy")->where(array("sun_id"=>$value["sun_id"]))->data(array("status"=>1))->save();
                }
            }

        }

        echo  json_encode($result);
    }

    public function test1(){
        $now=time();
        $lttime=$now-24*60*60;
        $gttime=$now-48*60*60;
        $where['status']=0;
        $group_buys=M("Group_buy")->where("create_time>".$gttime." AND create_time<".$lttime." AND status=0")->select();
        echo  json_encode($group_buys);
    }
}