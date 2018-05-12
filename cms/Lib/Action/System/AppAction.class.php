<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/19
 * Time: 13:15
 */
class AppAction extends BaseAction{
    public function index(){
        import('@.ORG.system_page');
        $count = D("App_version")->where(array('status'=>1))->count();
        $p = new Page($count, 20);
        $res=D("App_version")->where("status=1")->limit($p->firstRow.','.$p->listRows)->select();
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);
        $this->assign("apps",$res);
        $this->display();
    }

    public function add(){
        if(!empty($_POST)){
            $file_id=$_POST['file_id'];
            $name=$_POST['name'];
            $version_no=$_POST['version_no'];
            $version_detail=$_POST['version_detail'];
            if(empty($file_id)||empty($name)||empty($version_no)||empty($version_detail)){
                $this->error("参数传递出现空值！");
            }
            $create_time=time();
            $status=1;
            $data=array(
                "file_id"=>$file_id,
                "name"=>$name,
                "version_no"=>$version_no,
                "version_detail"=>$version_detail,
                "create_time"=>$create_time,
                "status"=>$status
            );
            if(D("App_version")->data($data)->add()){
                $this->success("添加成功！",U("App/index"));
            }else{
                $this->error("添加失败！");
            }
        }else {
            $this->display();
        }
    }

    public function delete(){
        $id=$_GET['id'];
        $res=D("App_version")->where("id=".$id)->setField("status",0);
        if($res){
            $this->success("删除成功！");
        }else{
            $this->error("删除失败！");
        }
    }
}