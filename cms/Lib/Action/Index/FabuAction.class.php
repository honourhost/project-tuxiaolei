<?php
/*
 * 选择地址
 *
 */
class FabuAction extends BaseAction{
    public function index(){
		$this->display();
    }

    //添加用户
    public function addConference(){
    	if(IS_POST){

    		if($data=D("Conference")->create()){
    			if(!preg_match("/^0{0,1}(13[0-9]|16[0-9]|15[0-9]|17[0-9]|18[0-9])[0-9]{8}$/",$data['telephone'])){
            		$this->error("手机号格式不正确，请重新输入！","",true);
        		}
    			//查看用户是否已经存在
    			$res=D("Conference")->where("telephone=".$data['telephone'])->find();
    			if(!empty($res)){
    				$this->error("您的手机号码已经参加过一次了，请勿重复参加，谢谢合作！","",true);
    			}
    			$data=array_filter($data);
    			if(!empty($data)){
    			
    			$data['create_time']=time();
    			if(D("Conference")->add($data)){
    				$this->success("参加成功！","",true);
    			}
    			}else{
    				$this->error("参加失败！","",true);
    			}
    		}else{
    			$this->error("传参出错！","",true);
    		}
    	}
    }
}