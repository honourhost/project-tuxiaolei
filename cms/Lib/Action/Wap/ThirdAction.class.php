<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/5/4
 * Time: 14:02
 */
class ThirdAction extends BaseAction
{

    public function meiya()
    {

        $this->display();
    }

    public function meiyaaction()
    {
        if (IS_POST) {
            if (empty($_POST['username'])) {
                $this->error_tips("Please enter your name 请填写您的姓名");
            }
            if (empty($_POST['phone'])) {
                $this->error_tips(" Please enter your phone 请填写您的电话");
            }
            if(empty($_POST['email'])){
                $this->error_tips("Please enter your email 请填写您的邮箱");
            }
            $form["username"]=$_POST["username"];
            $form["phone"]=$_POST["phone"];
            $form["email"]=$_POST["email"];
            $form["tendlanuange"]=$_POST["tendlanguage"];
            $form["whereknow"]=$_POST["whereknow"];
            $form["addtime"]=time();
            $form["wherehow"]=implode(";",$_POST["input_how"]);
            if($id=D("Meiyaform")->data($form)->add()){
                $formusercount=$_POST["userindex"];
                for ($index=0;$index<=$formusercount;$index++){
                    $this->saveformuser($_POST['user_'.$index],$id);

                }
                $studentcount=$_POST["studentnum"];
                for ($index=0;$index<=$studentcount;$index++){
                    $this->saveformstudent($_POST['student_'.$index],$id,$form["whereknow"]);

                }
                $this->success_tips("Success ! 恭喜，报名成功！");

            }else{
                $this->error_tips("Failed !报名失败");
            }

        } else {
            $this->error_tips("Illegal action 非法操作");
        }
    }

    private function saveformuser($userindex,$formid){
        $this->checkuser($userindex,$formid);
        $data['formid']=$formid;
        $data["name"]=$userindex[0];
        $data["age"]=$userindex[1];
        $data["nation"]=$userindex[2];
        $data["shirtsize"]=$userindex[3];
        $data["height"]=$userindex[4];
        $data["isschool"]=$userindex[5];
        $data["grade"]=$userindex[6];
        $data["addtime"]=time();
      D("Meiyauser")->data($data)->add();

    }
    private function checkuser($userindex,$formid){

        $newdata=array_slice($userindex,0,5);

        $noempty=0;
        foreach ($newdata as $key=>$value){
            if(!empty($value)){
                $noempty+=1;
                continue;

            }else{
              continue;
            }
        }
        if($noempty==0){

        }else if($noempty<5){
            D("Meiyaform")->where(array("id"=>$formid))->delete();
            $this->error_tips("Please fill in the complete information,请填写完整的参与者信息！");
        }


    }

    private function saveformstudent($userindex,$formid,$whereknow){
        $this->checkstudent($userindex,$formid,$whereknow);
        $data['formid']=$formid;
        $data["name"]=$userindex[0];
        $data["grade"]=$userindex[1];
        $data["addtime"]=time();
        D("Meiyastudent")->data($data)->add();
    }

    private function checkstudent($userindex,$formid,$whereknow){
        if($whereknow==0){

            $newdata=array_slice($userindex,0,2);
            $noempty=0;
            foreach ($newdata as $key=>$value){
                if(!empty($value)){
                    $noempty+=1;
                    continue;

                }else{
                    continue;
                }
            }
            if($noempty<2){
                D("Meiyaform")->where(array("id"=>$formid))->delete();
            //    $this->error_tips("Please fill in the complete information,请填写完整的学生信息！");
                echo  "<script>alert('Please fill in the complete information,请填写完整的学生信息！');window.history.back(); </script>";
            }


        }



    }

    public function  listform(){
        $data=D("Meiyaform")->where()->select();
        $meiyauser=D("Meiyauser");
        $meiyastudent=D("Meiyastudent");
        foreach ($data as $key=>$value){
            $formuser=$meiyauser->where(array("formid"=>$value['id']))->select();
            $formstudent=$meiyastudent->where(array("formid"=>$value["id"]))->select();
            $data[$key]['meiyauser']=$formuser;
            $data[$key]["meiyastudent"]=$formstudent;
        }
     //   echo json_encode($data);die;
        $this->assign("data",$data);
        $this->display();
    }

    public function listuser(){
        $formid=$_GET["formid"];
        $data=D("Meiyauser")->where(array("formid"=>$formid))->select();
        $this->assign("data",$data);
        $this->display();
    }

    public function  exportGroup(){

        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
        //输出Excel文件头，可把user.csv换成你要的文件名
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="form.csv"');
        header('Cache-Control: max-age=0');

        // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可

        $data=D("Meiyaform")->where()->select();
        $meiyauser=D("Meiyauser");
        foreach ($data as $key=>$value){
            $formuser=$meiyauser->where(array("formid"=>$value['id']))->select();
            $data[$key]['meiyauser']=$formuser;
        }
        // 打开PHP文件句柄，php://output 表示直接输出到浏览器
        $fp = fopen('php://output', 'a');

        // 输出Excel列名信息
        $head = array("NO编号","NAME","EMAIL","PHONE","PreferredLanguage","HowKnow","Add time","Party");
        foreach ($head as $i => $v) {
            // CSV的Excel支持GBK编码，一定要转换，否则乱码
            $head[$i] = iconv('utf-8', 'gbk', $v);
        }

        // 将数据通过fputcsv写到文件句柄
        fputcsv($fp, $head);


        // 计数器
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 500;
        // 逐行取出数据，不浪费内存
        $count = count($data);
        for($t=0;$t<$count;$t++) {

            $cnt ++;
            if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }
            $row = $data[$t];
            foreach ($row as $i => $v) {
                if($i=='addtime'){
                    $v=date("Y-m-d,H:i:s",$v);
                }
                if($i=='tendlanuange'){
                    switch ($v){
                        case 0:
                            $v="English";
                            break;
                        default:
                            $v="Chinese";
                            break;
                    }
                }
                if($i=="whereknow"){
                    switch ($v){
                        case 0:
                            $v="My kids go to QAIS. 我的孩子在青岛美亚国际学校就读";
                            break;
                        case 1:
                            $v="I'm a staff member 我是青岛美亚国际学校老师";
                            break;
                        default:
                            $v="I'm a guest 我是来访家长";
                            break;
                    }

                }
                if($i=="meiyauser"){
                    if($v==null){
                      $v="no party";
                    }else{
                        $da="";
                        foreach ($v as $kk=>$vv){

                            $da.=("Name:".$vv["name"].":age:".$vv["age"].":shirtsize:".$vv['shirtsize'].":nation:".$vv['nation'].":heitht:".$vv['height'])."\r";
                        }
                        $v=$da;
                    }
                }
                $row[$i] = iconv('utf-8', 'gbk', $v);
            }
           fputcsv($fp,$row);
        }
        fclose($fp);

    }


    public function exportSN(){
        //$objReader = PHPExcel_IOFactory::createReader('Excel5');
        header("Content-Type: text/html; charset=utf-8");
        header("Content-type:application/vnd.ms-execl");
        header("Content-Disposition:filename=form.xls");
        //   以下\t代表横向跨越一格，\n 代表跳到下一行，可以根据自己的要求，增加相应的输出相，要和循环中的对应哈
        //字段
        $letterArr=explode(',',strtoupper('a,b,c,d,e,f,g'));
        $arr=array(
            array('en'=>'id','cn'=>'NO 编号'),
            array('en'=>'username','cn'=>'Name 姓名'),
            array('en'=>'email','cn'=>'Email 邮箱'),
            array('en'=>'phone','cn'=>'phone 电话'),
            array('en'=>'tendlanuange','cn'=>'Preferred Language 偏向语言'),
            array('en'=>'whereknow','cn'=>'How know 从哪获知'),
            array('en'=>'addtime','cn'=>'Addtime 添加时间'),
            array('en'=>'meiyauser','cn'=>'Party '),
            array('en'=>'wherehow','cn'=>"Howfind 如何了解"),
            array('en'=>'meiyastudent','cn'=>"Name & Grade 姓名和年级"),

        );
 //       $chengItem=array('piaomianjia','shuifei','yingshoujine','yingfupiaomianjia','yingfushuifei','yingfujine','dailishouru','fandian','jichangjianshefei','ranyoufei');

        $i=0;
        $fieldCount=count($arr);
        $s=0;
        //thead
        foreach ($arr as $f){
            if ($s<$fieldCount-1){
                echo iconv('utf-8','gbk',$f['cn'])."\t";
            }else {
                echo iconv('utf-8','gbk',$f['cn'])."\n";
            }
            $s++;
        }
        //
        $data=D("Meiyaform")->where()->select();
//        $meiyauser=D("Meiyauser");
//        foreach ($data as $key=>$value){
//            $formuser=$meiyauser->where(array("formid"=>$value['id']))->select();
//            $data[$key]['meiyauser']=$formuser;
//        }
        $meiyauser=D("Meiyauser");
        $meiyastudent=D("Meiyastudent");
        foreach ($data as $key=>$value){
            $formuser=$meiyauser->where(array("formid"=>$value['id']))->select();
            $formstudent=$meiyastudent->where(array("formid"=>$value["id"]))->select();
            $data[$key]['meiyauser']=$formuser;
            $data[$key]["meiyastudent"]=$formstudent;
        }
        if ($data){

            foreach ($data as $sn){
                $j=0;
                foreach ($arr as $field){
                    $fieldValue=$sn[$field['en']];
                    switch ($field['en']){
                        default:
                            break;
                        case 'addtime':
                            if ($fieldValue){
                                $fieldValue=date('Y-m-d H:i:s',$fieldValue);
                            }else {
                                $fieldValue='';
                            }
                            break;
                        case 'tendlanuange':
                            if($fieldValue==0){
                                $fieldValue="English";
                            }else{
                                $fieldValue="Chinese";
                            }
                            break;
                        case 'whereknow':
                            if($fieldValue==0){
                                $fieldValue=iconv('utf-8','gbk',"My kids go to QAIS. 我的孩子在青岛美亚国际学校就读");
                            }else if($fieldValue==1){
                                $fieldValue=iconv('utf-8','gbk',"I'm a staff member 我是青岛美亚国际学校老师");
                            }else{
                                $fieldValue=iconv('utf-8','gbk',"I'm a guest 我是来访家长");
                            }
                            break;

                        case 'meiyauser':
                             $da="";
                            foreach ($fieldValue as $kk=>$vv){

                                $da.=("Name:".$vv["name"].":age:".$vv["age"].":shirtsize:".$vv['shirtsize'].":nation:".$vv['nation'].":heitht:".$vv['height'].'--');
                            }
                            $fieldValue=iconv('utf-8','gbk',$da);
                            break;
                        case 'meiyastudent':
                            $da="";
                            foreach ($fieldValue as $k=>$v){

                            $da.="NAME: ".$v["name"]."Grade:".$v["grade"]."--";
                            }
                            $fieldValue=iconv('utf-8','gbk',$da);
                            break;
                        case "wherehow":
                            $fieldValue=iconv('utf-8','gbk',$fieldValue);
                            break;
                    }
                    if ($j<$fieldCount-1){
                        echo $fieldValue."\t";
                    }else {
                        echo $fieldValue."\n";
                    }
                    $j++;
                }
                $i++;
            }
        }
        exit();
    }


}