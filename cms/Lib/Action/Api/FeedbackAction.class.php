<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/9/12
 * Time: 14:34
 */
class FeedbackAction extends  NewbaseAction
{
    public function feedback()
    {

        //先保存图片
        if (!empty($_FILES)) {
            $pic_filepath = 'feedback';
            //遍历多个文件看是否有文件出错
            $error = 0;
        //    echo  json_encode($_FILES);die;
            foreach ($_FILES as $key => $val) {

                $error += $val['error'];
            }
            if ($error == 0) {
                $param = array('size' => $this->config['reply_pic_size'], 'thumbMaxWidth' => $this->config['reply_pic_width'], 'thumbMaxHeight' => $this->config['reply_pic_height'], 'thumb' => true, 'imageClassPath' => 'ORG.Util.Image', 'thumbPrefix' => 'm_,s_', 'thumbRemoveOrigin' => false);
                $image = D('Image')->handle("753", 'feedback/' . $pic_filepath, 2, $param);
                if ($image['error']) {
                    $this->returnAjax("图片上传失败！", 0);
                } else {
                    $pics = array();
                    foreach ($_FILES as $key => $val) {
                        $title = $image['title'][$key];

                        $pics[] = $title;

                    }

                }
            } else {
            }
        }
        $context=$_POST["content"];
        $image=implode(";",$pics);

   $data["text"]=$context;
   $data["images"]=$image;
   $data["addtime"]=time();
   $data["uid"]=$_POST["uid"];


    if(D("Feedback")->data($data)->add()){
        $this->returnAjax("感谢您的反馈",1);
    }else{
        $this->returnAjax("接收反馈信息失败，请重试或者联系我们",2);
    }
    }



}