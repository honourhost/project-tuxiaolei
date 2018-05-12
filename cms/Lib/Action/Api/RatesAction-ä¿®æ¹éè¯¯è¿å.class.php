<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/25
 * Time: 10:57
 */
class RatesAction extends BaseAction{

    private $pic_ids="";
    //用户确认接口
    public function user_confirm(){
    	$type=$_GET['type'];
    	if($type==1){
    		$this->group_order_confirm();
    	}else{
    		$this->meal_order_confirm();
    	}
    }

    private function save_images(){
        $order_id=$_POST['order_id'];
        $order_type = $_POST['order_type'];
        if($order_type == 0){
            $pic_filepath = 'group';
        }else{
            $pic_filepath = 'meal';
        }
        //遍历多个文件看是否有文件出错
        $error=0;
        foreach($_FILES as $key=>$val){
            $error+=$val['error'];
        }
        if($error==0){
            $param = array('size' => $this->config['reply_pic_size'], 'thumbMaxWidth' => $this->config['reply_pic_width'], 'thumbMaxHeight' => $this->config['reply_pic_height'], 'thumb' => true, 'imageClassPath' => 'ORG.Util.Image', 'thumbPrefix' => 'm_,s_', 'thumbRemoveOrigin' => false);
            $image = D('Image')->handle($this->merchant_session['mer_id'], 'reply/' . $pic_filepath, 2, $param);
            if ($image['error']) {
                $this->returnAjax("图片上传失败！",0);
            } else {
                $pics = array();
                foreach($_FILES as $key=>$val) {
                    $title = $image['title'][$key];
                    $database_reply_pic = D('Reply_pic');
                    $data_reply_pic['name'] = $val['name'];
                    $data_reply_pic['pic'] = $title;
                    $data_reply_pic['uid'] = $this->user_session['uid'];
                    $data_reply_pic['order_type'] = $order_type;
                    $data_reply_pic['order_id'] = $order_id;
                    $data_reply_pic['add_time'] = $_SERVER['REQUEST_TIME'];

                    if (!($pigcms_id = $database_reply_pic->data($data_reply_pic)->add())) {
                        $this->returnAjax("评论添加图片失败！", 0);
                    } else {
                        $pics[] = $pigcms_id;
                    }
                }
                $this->pic_ids=implode(",",$pics);
            }
        }else{
            $this->returnAjax("上传图片出错！",0);
        }
    }

    public function reply_to(){
        //先保存图片
        if(!empty($_FILES)){
        $this->save_images();
        }
        $order_type = intval($_POST['order_type']);
        if($order_type == 0){
            $now_order = D('Group_order')->get_order_detail_by_id($this->now_user['uid'],$_POST['order_id']);
            $data_reply['parent_id'] = $now_order['group_id'];
        }else{
            $now_order = D('Meal_order')->where(array('uid' => $this->now_user['uid'], 'order_id' => $_POST['order_id']))->find();
            $data_reply['parent_id'] = $now_order['store_id'];
        }
        if(empty($now_order)){
            $this->error('当前订单不存在！');
        }
        if(empty($now_order['paid'])){
            $this->error('当前订单未付款！无法评论。');
        }
        if(empty($now_order['status'])){
            $this->error('当前订单未消费！无法评论。');
        }
        $score = intval($_POST['score']);
        if($score > 5 || $score < 1){
            $this->error('评分只能1到5分！');
        }
        $database_reply = D('Reply');
        $data_reply['store_id'] = $now_order['store_id'];
        $data_reply['mer_id'] = $now_order['mer_id'];
        $data_reply['score'] = $score;
        $data_reply['order_type'] = $order_type;
        $data_reply['order_id'] = intval($_POST['order_id']);
        $data_reply['anonymous'] = intval($_POST['anonymous']);
        $data_reply['comment'] = $_POST['comment'];
        $data_reply['uid'] = $this->now_user['uid'];
        $data_reply['add_time'] = $_SERVER['REQUEST_TIME'];
        $data_reply['add_ip'] = get_client_ip(1);
        $data_reply['pic'] = $this->pic_ids;
        //$this->returnAjax($data_reply,1);
        if($database_reply->data($data_reply)->add()){
            if($order_type == 0){
                D('Group')->setInc_group_reply($now_order,$score);
                D('Group_order')->change_status($now_order['order_id'],2);
            }else{
                D('Merchant_store')->setInc_meal_reply($now_order['store_id'], $score);
                D('Meal_order')->change_status($now_order['order_id'],2);
            }

            $database_merchant_score = D('Merchant_score');
            $now_merchant_score = $database_merchant_score->field('`pigcms_id`,`score_all`,`reply_count`')->where(array('parent_id'=>$now_order['mer_id'],'type'=>'1'))->find();
            if(empty($now_merchant_score)){
                $data_merchant_score['parent_id'] = $now_order['mer_id'];
                $data_merchant_score['type'] = '1';
                $data_merchant_score['score_all'] = $score;
                $data_merchant_score['reply_count'] = 1;
                $database_merchant_score->data($data_merchant_score)->add();
            }else{
                $data_merchant_score['score_all'] = $now_merchant_score['score_all']+$score;
                $data_merchant_score['reply_count'] = $now_merchant_score['reply_count']+1;
                $database_merchant_score->where(array('pigcms_id'=>$now_merchant_score['pigcms_id']))->data($data_merchant_score)->save();
            }
            $now_store_score=$database_merchant_score->field('`pigcms_id`,`score_all`,`reply_count`')->where(array('parent_id'=>$now_order['store_id'],'type'=>'2'))->find();
            if(empty($now_store_score)){
                $data_store_score['parent_id'] = $now_order['store_id'];
                $data_store_score['type'] = '2';
                $data_store_score['score_all'] = $score;
                $data_store_score['reply_count'] = 1;
                $database_merchant_score->data($data_store_score)->add();
            }else{
                $data_store_score['score_all'] = $now_store_score['score_all']+$score;
                $data_store_score['reply_count'] = $now_store_score['reply_count']+1;
                $database_merchant_score->where(array('pigcms_id'=>$now_store_score['pigcms_id']))->data($data_store_score)->save();
            }
            $this->returnAjax('添加评论成功！',1);
        }else{
            $this->returnAjax('添加评论失败！',0);
        }
    }

    //获取评价详情
    public function getRated(){
        $order_type = intval($_POST['order_type']);
        if($order_type == 0){
            $pic_filepath = 'group';
            $reply = D('Group')->get_rated_order($this->now_user['uid'],$_POST['order_id']);
            $reply_pics=D("Reply_pic")->where("pigcms_id in (".$reply['pic'].")")->select();
            $reply_image_class = new reply_image();
            foreach($reply_pics as $key=>$val){
                $reply["reply_pics"][] = $reply_image_class->get_image_by_path($val['pic'],$pic_filepath,'s');
            }
        }else{
            $pic_filepath = 'meal';
            $reply = D('Meal_order')->get_rated_order($this->now_user['uid'],$_POST['order_id']);
            $reply_pics=D("Reply_pic")->where("pigcms_id in (".$reply['pic'].")")->select();
            $reply_image_class = new reply_image();
            foreach($reply_pics as $key=>$val){
                $reply["reply_pics"][] = $reply_image_class->get_image_by_path($val['pic'],$pic_filepath,'s');
            }
        }
        if(!empty($reply)){
            $this->returnAjax($reply,1);
        }else{
            $this->returnAjax("未获取到数据！",0);
        }
    }
    //group订单用户确认，确认之后直接变为对账状态
    private function group_order_confirm(){
        $now_order = D('Group_order')->get_order_detail_by_id($this->now_user['uid'],$_GET['order_id']);
        if(empty($now_order)){
            $this->returnAjax('当前订单不存在！',0);
        }else if(!($now_order['paid'])){
            $this->returnAjax('当前订单还未付款，付款后才能确认。',0);
        }
        
        $condition_group_order['order_id'] = $now_order['order_id'];
        $data_group_order['user_confirm'] = 1;
        $data_group_order['is_pay_bill']=1;
        if(!(D('Group_order')->where($condition_group_order)->data($data_group_order)->save())){
            $this->returnAjax('确认失败！请重试。',0);
        }else{
        	$this->returnAjax("订单确认成功！",1);
        }
    }

    //meal订单用户确认，确认之后直接变为对账状态
    private function meal_order_confirm()
    {
        $now_order = D('Meal_order')->get_order_by_id($this->now_user['uid'],$_GET['order_id']);
        if(empty($now_order)){
            $this->returnAjax('当前订单不存在！',0);
        }elseif(!$now_order['paid']){
            $this->error('当前订单还没有付款无法确认！');
        }else{
            $result=D('Meal_order')->where(array('uid' => $this->now_user['uid'], 'order_id' => $_GET['order_id']))->save(array('user_confirm' => 1,'is_pay_bill'=>1));
            if(!$result){
                $this->returnAjax('订单状态修改失败！',0);
            }else{
            	$this->returnAjax("订单确认成功！",1);
            }
        }
    }
}