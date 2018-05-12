<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/9/25
 * Time: 15:10
 */
class GroupBuyLog{
    private $filename="groupBuyLog.log";
    public function insertLog($uid,$order_id,$content){
        $fo=fopen("./data/log/".$this->filename,"a+");
        $detail=date("Y-m-d H:i:s",time()).":uid:".$uid.":order_id:".$order_id."-----detail:".$content."\t\n";
        $result=fwrite($fo,$detail);
        fclose($fo);
        if($result){
            return true;
        }else{
            return false;
        }
    }
}