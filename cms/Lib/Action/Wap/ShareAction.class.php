<?php
class ShareAction extends BaseAction{
	public function index(){
		$this->display();
	}

    public function sharerequest(){
	   // echo  "fuck";die;
        $module=$_POST["module"];
        file_put_contents("zhunong.txt","2222",FILE_APPEND);
        D("Zhunongshare")->where(array("id"=>1))->setInc("zhunongshare",1);

    }
}