<?php

class TestAction extends BaseAction{
	public function index(){
        $chan_where2 = array(
            "url" => C("PAY_RANGE_TOPIC"),
            "status" => 1
        );
        $channel = D("Channel")->where($chan_where2)->find();
        $goodsid = D("Channel_category_goods")->field("goods_id")->where(array("c_id" => $channel['id']))->select();
        if (in_array(array("goods_id"=>2169), $goodsid)) {
           echo "1";
        } else {
           echo "2";
        }
        var_dump(array("goods_id"=>2169));
        echo  "<br>";
        var_dump($goodsid);
	}


  public  function randStr($len)
    {
     //  $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz'; // characters to build the password from
        $chars='0123456789'; // characters to build the password from

        $string='';
        for(;$len>=1;$len--)
        {
            $position=rand()%strlen($chars);
            $string.=substr($chars,$position,1);
        }
        return $string;
    }


    public function  code(){
	    $database=D("Vipcard");
	    for ($i=0;$i<500;$i++){
	        $code=$this->randStr(10);
	        $database->data(array("unique_id"=>$code,"denomination"=>200))->add("",array(),true);
           // $database->data(array("unique_id"=>$code,"denomination"=>1000))->add();
        }
    }

    public function  upush(){
        $res=  umeng_push(1,"adam");
        echo  $res;

    }
}