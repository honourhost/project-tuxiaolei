<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/19
 * Time: 16:33
 */
class VersionAction extends BaseAction{
    public function getNewestVersion(){
        //先看是否有传来的版本号
        $version_no=$_GET['version_no'];
        if(empty($version_no)){
            $this->returnAjax("没有版本号参数",0);
        }
        $nowNew=D("App_version")->where("status=1")->order("id desc")->find();
        if($nowNew['version_no']>$version_no){
            $file=D("File")->where("id=".$nowNew['file_id'])->find();
            if(!empty($file)){
                //非空则获取下载路径
                $url=C("config.site_url")."/upload/Download/".$file["savepath"].$file['savename'];
                $this->returnAjax($url,1);
            }
            else{
                $this->returnAjax("未获取到文件信息！",0);
            }
        }else{
            $this->returnAjax("没有最新的可更新版本！",0);
        }
    }
}