<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/9/25
 * Time: 10:16
 */
class TagsAction  extends BaseAction
{

    /**
     * 列出所有标签
     */
    public function  index(){

        $tags=D("Tags")->where(array("status"=>1))->select();
        $this->assign("tags",$tags);
        $this->display();
    }


    public function add()
    {
        $this->assign("bg_color", "#F3F3F3");
        $this->display();
    }



    public function modify()
    {
        if (IS_POST) {
            $_POST["addtime"] = $_SERVER["REQUEST_TIME"];
            $database_search_hot = D("Tags");

            if ($database_search_hot->data($_POST)->add()) {
                $this->success("添加成功！");
            }
            else {
                $this->error("添加失败！请重试~");
            }
        }
        else {
            $this->error("非法提交,请重新提交~");
        }
    }



    public function edit()
    {
        $this->assign("bg_color", "#F3F3F3");
        $database_search_hot = D("Tags");
        $condition_search_hot["id"] = intval($_GET["id"]);
        $search_hot = $database_search_hot->field(true)->where($condition_search_hot)->find();
        $this->assign("tag", $search_hot);
        $this->display();
    }

    public function amend()
    {
        if (IS_POST) {
            $_POST["addtime"] = $_SERVER["REQUEST_TIME"];
            $database_search_hot = D("Tags");

            if ($database_search_hot->data($_POST)->save()) {
                $this->success("修改成功！");
            }
            else {
                $this->error("修改失败！请重试~");
            }
        }
        else {
            $this->error("非法提交,请重新提交~");
        }
    }


    public function del()
    {
        if (IS_POST) {
            $database_search_hot = D("Tags");
            $condition_search_hot["id"] = intval($_POST["id"]);

            if ($database_search_hot->where($condition_search_hot)->delete()) {
                $this->success("删除成功！");
            }
            else {
                $this->error("删除失败！请重试~");
            }
        }
        else {
            $this->error("非法提交,请重新提交~");
        }
    }


}