<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/7/14
 * Time: 16:01
 */
class AppcateAction extends BaseAction
{
  public function  index(){
      $data=D("Appcate")->select();
      $this->assign("category_list",$data);
      $this->display();
  }


  public function  cat_add(){
      $this->display();
  }

  public function  cat_edit(){
      $catid=$_GET["cat_id"];
      $cat=D("Appcate")->where("id = ".$catid)->find();
      $this->assign("now_slider",$cat);
      $this->display();
  }

  public function  cate_modify(){
      if($_FILES['pic']['error'] != 4){
          $image = D('Image')->handle($this->system_session['id'], 'appslider');
          if (!$image['error']) {

              $_POST = array_merge($_POST, str_replace('/upload/appslider/', '', $image['url']));
          } else {
              $this->frame_submit_tips(0, $image['msg']);
          }

      }
    $database_appcate=D("Appcate");
      $_POST['last_time'] = $_SERVER['REQUEST_TIME'];
      if($id = $database_appcate->data($_POST)->add()){
          D('Image')->update_table_id('/upload/appslider/' . $_POST['pic'], $id, 'appslider');
          S('app_slider_list_'.$_POST['cat_id'],NULL);
          $this->frame_submit_tips(1,'添加成功！');
      }else{
          $this->frame_submit_tips(0,'添加失败！请重试~');
      }
  }


  public function cat_amend(){
      $database_slider = D('Appcate');
      $condition_slider['id'] = $_POST['id'];
      $now_slider = $database_slider->field(true)->where($condition_slider)->find();

      if($_FILES['pic']['error'] != 4){

          $image = D('Image')->handle($this->system_session['id'], 'appslider');
          if (!$image['error']) {
              $_POST = array_merge($_POST, str_replace('/upload/appslider/', '', $image['url']));
              //$_POST = array_merge($_POST, $image['url']);
          } else {
              $this->frame_submit_tips(0, $image['msg']);
          }
      }
      $_POST['last_time'] = $_SERVER['REQUEST_TIME'];
      if($database_slider->data($_POST)->save()){
          D('Image')->update_table_id('/upload/appslider/' . $_POST['pic'], $_POST['id'], 'appslider');
          S('app_slider_list_'.$_POST['cat_id'],NULL);
          if($_POST['pic']){
              if(strpos($now_slider['pic'],'2014/') === false){
                  unlink('./upload/appslider/'.$now_slider['pic']);
              }
          }
          $this->frame_submit_tips(1,'编辑成功！');
      }else{
          $this->frame_submit_tips(0,'编辑失败！请重试~');
      }
  }

  public function  cat_del(){
      $database_slider = D('Appcate');
      $condition_slider['id'] = $_POST['cat_id'];
      $now_slider = $database_slider->field(true)->where($condition_slider)->find();
      if($database_slider->where($condition_slider)->delete()){
        // S('app_slider_list_'.$now_slider['cat_id'],NULL);
          if($now_slider['pic']){
              if(strpos($now_slider['pic'],'2014/') === false){
                  unlink('./upload/appslider/'.$now_slider['pic']);
              }
          }
          $this->success('删除成功');
      }else{
          $this->error('删除失败！请重试~');
      }
  }

  public function  slider_list(){


      $now_category = D("Appcate")->where("id = ".$_GET["cat_id"])->find();
      if(empty($now_category)){
          $this->error_tips('分类不存在！');
      }
      $this->assign('now_category',$now_category);
      $database_slider = D('Appcategood');
      $condition_slider['cat_id'] = $now_category['id'];
      $slider_list = $database_slider->field(true)->where($condition_slider)->order('`sort` DESC,`id` ASC')->select();
      $groupdata=D("Group");
      foreach ($slider_list as $key=>$value){
          $group=$groupdata->where(array("group_id"=>$value["group_id"]))->find();
          $slider_list[$key]["status"]=$group["status"];
          $slider_list[$key]["end_time"]=$group["end_time"];
      }
      $this->assign('slider_list',$slider_list);

      $this->display();
  }
  public function slider_add(){
      $this->assign('bg_color','#F3F3F3');
      $cat_id=intval($_GET['cat_id']);
      $now_category = D("Appcate")->where("id = ".$cat_id)->find();
      $this->assign('now_category',$now_category);

      $this->display();
  }

    public function slider_modify(){
        if($_FILES['pic']['error'] != 4){
            $image = D('Image')->handle($this->system_session['id'], 'appslider');
            if (!$image['error']) {

                $_POST = array_merge($_POST, str_replace('/upload/appslider/', '', $image['url']));
            } else {
                $this->frame_submit_tips(0, $image['msg']);
            }

        }
        $_POST['last_time'] = $_SERVER['REQUEST_TIME'];
        $database_slider = D('Appcategood');

        //如果当前用户存在地区分类

        if($id = $database_slider->data($_POST)->add()){
            D('Image')->update_table_id('/upload/appslider/' . $_POST['pic'], $id, 'appslider');
            S('app_slider_list_'.$_POST['cat_id'],NULL);
            $this->frame_submit_tips(1,'添加成功！');
        }else{
            $this->frame_submit_tips(0,'添加失败！请重试~');
        }
    }


    public function slider_del(){
        $database_slider = D('Appcategood');
        $condition_slider['id'] = $_POST['id'];
        $now_slider = $database_slider->field(true)->where($condition_slider)->find();
        if($database_slider->where($condition_slider)->delete()){
          //  S('app_slider_list_'.$now_slider['cat_id'],NULL);
            if($now_slider['pic']){
                if(strpos($now_slider['pic'],'2014/') === false){
                    unlink('./upload/appslider/'.$now_slider['pic']);
                }
            }
            $this->success('删除成功');
        }else{
            $this->error('删除失败！请重试~');
        }
    }

    public function slider_edit(){
        $this->assign('bg_color','#F3F3F3');

        $database_slider = D('Appcategood');
        $condition_slider['id'] = $_GET['id'];
        $now_slider = $database_slider->field(true)->where($condition_slider)->find();
        if(empty($now_slider)){
            $this->frame_error_tips('该导航不存在！');
        }
        $this->assign('now_slider',$now_slider);

        $this->display();
    }



    public function slider_amend(){
        $database_slider = D('Appcategood');
        $condition_slider['id'] = $_POST['id'];
        $now_slider = $database_slider->field(true)->where($condition_slider)->find();

        if($_FILES['pic']['error'] != 4){

            $image = D('Image')->handle($this->system_session['id'], 'appslider');
            if (!$image['error']) {
                $_POST = array_merge($_POST, str_replace('/upload/appslider/', '', $image['url']));
                //$_POST = array_merge($_POST, $image['url']);
            } else {
                $this->frame_submit_tips(0, $image['msg']);
            }
        }
        $_POST['last_time'] = $_SERVER['REQUEST_TIME'];
        if($database_slider->data($_POST)->save()){
            D('Image')->update_table_id('/upload/appslider/' . $_POST['pic'], $_POST['id'], 'appslider');
            S('app_slider_list_'.$_POST['cat_id'],NULL);
            if($_POST['pic']){
                if(strpos($now_slider['pic'],'2014/') === false){
                    unlink('./upload/appslider/'.$now_slider['pic']);
                }
            }
            $this->frame_submit_tips(1,'编辑成功！');
        }else{
            $this->frame_submit_tips(0,'编辑失败！请重试~');
        }
    }
}