<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/27
 * Time: 15:42
 */
class UserAction extends BaseAction{
    public function recharge(){
        $data_user_recharge_order['uid'] = $this->now_user['uid'];
        $money = floatval($_GET['money']);
        if(empty($money) || $money > 10000){
            $this->error('请输入有效的金额！最高不能超过1万元。');
        }
        $data_user_recharge_order['money'] = $money;
        // $data_user_recharge_order['order_name'] = '帐户余额在线充值';
        $data_user_recharge_order['add_time'] = $_SERVER['REQUEST_TIME'];
        if($order_id = D('User_recharge_order')->data($data_user_recharge_order)->add()){
            redirect(U('Mobile/Pay/check',array('order_id'=>$order_id,'type'=>'recharge')));
        }else{
            $this->error('订单处理失败！请重试。');
        }
    }
    /*地址操作*/
    public function adress(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！');
        }
        
        $adress_list = D('User_adress')->get_adress_list($this->user_session['uid']);

        if(empty($adress_list)){
            redirect(U('User/edit_adress',$_GET));
        }else{
            if($_GET['order_id']&&$_GET['type']){
                $select_url = U("Pay/check",array("order_id"=>$_GET['order_id'],"type"=>$_GET['type']));
            }
            /*if($select_url){
                $this->assign('back_url',U($select_url,$_GET));
            }else{
                $this->assign('back_url',U('My/myinfo'));
            }*/
            
            $param = $_GET;
                
            foreach($adress_list as $key=>$value){
                $param['adress_id'] = $value['adress_id'];
                if(!empty($select_url)){
                    $adress_list[$key]['select_url'] = U($select_url,$param);
                }
                $adress_list[$key]['edit_url'] = U('User/edit_adress',$param);
                $adress_list[$key]['del_url'] = U('User/del_adress',$param);
            }
            
            
            $this->assign('adress_list',$adress_list);
            $this->display();
        }
    }
    /*添加编辑地址*/
    public function edit_adress(){
        if(IS_POST){
            if(D('User_adress')->post_form_save($this->user_session['uid'])){
                $this->success('保存成功！');
            }else{
                $this->error('地址保存失败！请重试');
            }
        }else{
            $database_area = D('Area');
            if($_GET['adress_id']){
                $now_adress = D('User_adress')->get_adress($this->user_session['uid'],$_GET['adress_id']);
                if(empty($now_adress)){
                    $this->error_tips('该地址不存在');
                }
                $this->assign('now_adress',$now_adress);
                
                $province_list = $database_area->get_arealist_by_areaPid(0);
                $this->assign('province_list',$province_list);
                    
                $city_list = $database_area->get_arealist_by_areaPid($now_adress['province']);
                $this->assign('city_list',$city_list);
                    
                $area_list = $database_area->get_arealist_by_areaPid($now_adress['city']);
                $this->assign('area_list',$area_list);
            }else{
                $now_city_area = $database_area->where(array('area_id'=>$this->config['now_city']))->find();
                $this->assign('now_city_area',$now_city_area);
                
                $province_list = $database_area->get_arealist_by_areaPid(0);
                $this->assign('province_list',$province_list);
                    
                $city_list = $database_area->get_arealist_by_areaPid($now_city_area['area_pid']);
                $this->assign('city_list',$city_list);
                    
                $area_list = $database_area->get_arealist_by_areaPid($now_city_area['area_id']);
                $this->assign('area_list',$area_list);
            }
            
            $params = $_GET;
            unset($params['adress_id']);
            $this->assign('params',$params);
        }
        
        $this->display();
    }

    /*删除地址*/
    public function del_adress(){
        if(empty($this->user_session)){
            $this->error_tips('请先进行登录！');
        }
        $result = D('User_adress')->delete_adress($this->user_session['uid'],$_GET['adress_id']);
        if($result){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }
    public function select_area(){
        $area_list = D('Area')->get_arealist_by_areaPid($_POST['pid']);
        if(!empty($area_list)){
            $return['error'] = 0;
            $return['list'] = $area_list;
        }else{
            $return['error'] = 1;
        }
        echo json_encode($return);
    }

    //收益列表
    public function commission_list(){
        
        $this->assign("now_money",$this->now_user['now_money']);
        $this->display();
    }
    //获取json信息
    public function getCommissionList(){
        $uid=$this->now_user['uid'];
        //查找订单列表中含有用户佣金的订单信息，并查找对应的商品信息
        $return=D('User_money_list')->get_list($this->now_user['uid']);
        $money_list=$return['money_list'];
        
        foreach($money_list as $key=>$val){
            $money_list[$key]['image']=$this->showpic($val['desc']);
            $money_list[$key]['time']=date("Y-m-d",$val['time']);
        }
        $this->success($money_list,"",true);
    }
    //根据内容区分图片
    private function showpic($str){

    $arr=array("后台操作","充值","买","款","活动","佣金");
        if(strrpos($str,$arr[0])){
            return "admin";
        }elseif(strrpos($str,$arr[1])){
            return "recharge";
        }elseif(strrpos($str,$arr[2])){
            return "buy";
        }elseif(strrpos($str,$arr[3])){
            return "refund";
        }elseif(strrpos($str,$arr[4])){
            return "activity";
        }elseif(strrpos($str,$arr[5])){
            return "commission";
        }else{
            return "default";
        }
    }
}
