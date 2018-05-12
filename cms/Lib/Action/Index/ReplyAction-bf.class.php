<?php
/*
 * 异步加载评论
 *
 */
class ReplyAction extends BaseAction{
    public function ajax_get_list(){
		$reply_return = D('Reply')->get_page_reply_list($_GET['parent_id'],$_GET['order_type'],$_POST['tab'],$_POST['order'],$_GET['store_count']);
		if($reply_return['count']){
			$avatar_image_class = new avatar_image();
			foreach($reply_return['list'] as $k=>$val){
				//如果头像字段存在,证明为后期上传的则获取真实地址
				if(strstr($val['avatar'],",")) {
					 $image= $avatar_image_class->get_image_by_path($val['avatar'], C('config.site_url'));
					 $reply_return['list'][$k]['avatar']=$image['s_image'];
				}
			}
			echo json_encode($reply_return);
		}else{
			echo '0';
		}
    }
}