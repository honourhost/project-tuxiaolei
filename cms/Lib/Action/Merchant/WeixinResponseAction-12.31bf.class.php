<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2015/12/8
 * Time: 10:35
 */
class WeixinResponseAction extends Action
{
    private $weixinConfig;
    private $mer_id;
    private $wechat;

    public function index() {
        if(isset($_GET['mer_id'])) {
            $this->mer_id=$_GET['mer_id'];
            $weixin_bind = D('Weixin_bind')->where(array('mer_id' => $this->mer_id))->find();
            $this->weixinConfig=array(
                "wechat_encode"=>$weixin_bind['wechat_encode'],
                "wechat_encodingaeskey"=>$weixin_bind['user_name'],
                "wechat_appid"=>$weixin_bind['authorizer_appid'],
                "wechat_token"=>$weixin_bind['func_info'],
            );
            $this->wechat = new Wechat($this->weixinConfig);
            $data = $this->wechat->request();
            switch ($data['MsgType']) {//
                case 'event':
                    if ($data['Event'] == 'subscribe') {
                            $this->eventSub();
                    }
                    if ($data['Event'] == 'SCAN') {
                        $this->event();
                    }
                    break;
                case 'location':

                    $this->location($data);
                    break;

                default: //其余的类型都算关键词
                    $this->keyword($data);
                    break;
            }
        }else{
            exit();
        }
    }

    private function location() {

            $this->weixin->response('很抱歉没有合适的商家推荐给您', 'text');
    }

    private function keyword($data) {
        if (empty($data['Content']))
            return;
        /* D('Weixinmsg')->add(array(
          'FromUserName' => $data['FromUserName'],
          'ToUserName' => $data['ToUserName'],
          'Content' => htmlspecialchars($data['Content']),
          'create_time' => NOW_TIME
          )); */

        if ($this->mer_id != 0) {
            $keyword = D('Keyword')->where(array("mer_id"=>$this->mer_id,"content"=>$data['Content']))->find();
            if ($keyword) {
                switch ($keyword['table']) {
                    case 'Text':
                        $return = D('Text')->where(array("pigcms_id"=>$keyword['from_id']))->find();
                        $this->wechat->response($return['content'], 'text');
                        break;
                    case 'Source_material':
                        if ($data = D('Source_material')->where(array('pigcms_id' => $keyword['from_id']))->find()) {
                            $it_ids = unserialize($data['it_ids']);
                            $id = isset($it_ids[0]) ? intval($it_ids[0]) : 0;
                            $image_text = D('Image_text')->where(array('pigcms_id' => $id, 'mer_id' => $this->mer_id))->find();
                        }
                        $content = array();
                        $content[] = array(
                            $image_text['title'],
                            $image_text['content'],
                            $this->getImage($image_text['cover_pic']),
                            $image_text['url'],
                        );
                        $this->wechat->response($content, 'news');
                        break;
                }
            } else {
                return;
            }
        } else{
            return;
        }
    }

    function eventSub(){
        $reply=D('Reply_other')->where(array("is_open"=>1,"mer_id"=>$this->mer_id))->find();
        if($reply){
            switch ($reply['reply_type']) {
                //如果是文字回复
                case 0:
                $this->wechat->response($reply['content'], 'text');
                break;
                case 1:
                if ($data = D('Source_material')->where(array('pigcms_id' => $reply['from_id']))->find()) {
                            $it_ids = unserialize($data['it_ids']);
                            $id = isset($it_ids[0]) ? intval($it_ids[0]) : 0;
                            $image_text = D('Image_text')->where(array('pigcms_id' => $id, 'mer_id' => $this->mer_id))->find();
                        }
                        $content = array();
                        $content[] = array(
                            $image_text['title'],
                            $image_text['content'],
                            $this->getImage($image_text['cover_pic']),
                            $image_text['url'],
                        );
                $this->wechat->response($content, 'news');
                break;
            }
        }else {
                return;
         }
    }

    //响应用户的事件
    private function event() {
        exit;
    }
    private function getImage($img) {
        return "http://xnd.winworlds.cn".$img;
    }

}