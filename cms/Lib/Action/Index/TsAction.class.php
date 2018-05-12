<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/9/5
 * Time: 9:53
 */
class TsAction  extends BaseAction
{
public function index(){
    $this->display();
}

public function  test(){
    echo  json_encode(array("adam"=>1,"adam1"=>2));die;
}
}