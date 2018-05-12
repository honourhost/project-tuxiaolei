<?php
require_once("alipay_core.function.php");
require_once("alipay_rsa.function.php");
class Alipaysign
{
    public function  sign($data,$private){
        return rsaSign($data,$private);
    }
}