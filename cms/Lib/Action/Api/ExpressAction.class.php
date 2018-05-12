<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/8/22
 * Time: 9:44
 */
class ExpressAction extends NewbaseAction
{
    protected  $juhekey="85f3f4d77da5feccd2035db1fdc3ace1";
    protected  $baseurl="http://v.juhe.cn/exp/index?";
    protected function _initialize()
    {
        parent::_initialize();
    }


    public function  express_query(){

        $date=date("Y-m-d-H");
        $expresskey=md5($date."xiaonongding2016");
        $postkey=$_POST["key"];
        if($postkey!=$expresskey){
            $this->returnAjax("手机时间与服务器时间不匹配哦",0);
        }else{
            $juhecode=$_POST["expresscode"];
            $expressnum=$_POST["expressid"];
            $result=file_get_contents($this->baseurl."key=".$this->juhekey."&com=".$juhecode."&no=".$expressnum);
            if(!$result){
                $this->returnAjax("未获取到快递信息".$result,0);
            }
            $resultarray=json_decode($result,true);
            if($resultarray["resultcode"]!=200){
                $this->returnAjax("未查询到快递信息".$result,0);
            }else{
                $this->returnAjax($resultarray["result"],1);
            }
        }

    }


}