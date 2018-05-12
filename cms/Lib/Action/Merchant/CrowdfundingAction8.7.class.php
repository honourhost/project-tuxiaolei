<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/1
 * Time: 16:56
 */
class CrowdfundingAction extends BaseAction
{
    public function index()
    {
        $database_group = D('Crowdfunding');
        $condition_group['mer_id'] = $this->merchant_session['mer_id'];
        $group_count = $database_group->where($condition_group)->count();

        import('@.ORG.merchant_page');
        $p = new Page($group_count, 20);
        $group_list = $database_group->field(true)->where($condition_group)->order('`crowd_id` DESC')->limit($p->firstRow . ',' . $p->listRows)->select();

        $group_image_class = new group_image();
        $crowdgradedata=D("Crowdgrade");
        foreach ($group_list as $key => $value) {
            $tmp_pic_arr = explode(';', $value['webpic']);
            $group_list[$key]['list_pic'] = $group_image_class->get_image_by_path($tmp_pic_arr[0], 's');
            $crwowgrades=$crowdgradedata->where(array("crowd_id"=>$value["crowd_id"]))->select();
            $group_list[$key]["grades"]=$crwowgrades;

        }
        $this->assign('group_list', $group_list);

        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->display();
    }

    /**
     * 添加众筹
     */
    public function add()
    {
        $this->display();
    }

    public function addaction()
    {
        if (IS_POST) {
            if (empty($_POST['title'])) {
                $this->error('请填写众筹标题');
            }
            if (empty($_POST['digest'])) {
                $this->error('请填写众筹描述');
            }
            if (empty($_POST['funds'])) {
                $this->error('请填写目标筹款');
            }
            if(empty($_POST["crowdplace"])){
                $this->error('请上传众筹地区');
            }
            if (empty($_POST['webpic'])) {
                $this->error('请上传众筹宣传图');
            }
            if (empty($_POST['content'])) {
                $this->error('请填写众筹详情');
            }
            if(empty($_POST["videourl"])){
                $this->error('请上传众筹视频');
            }
            if(empty($_POST["videopic"])){
                $this->error('请上传众筹视频封面图');
            }
            $gradeindex=intval($_POST["gradeindex"]);



            $_POST['content'] = fulltext_filter($_POST['content']);
            $database=D("Crowdfunding");
            if($crowdid=$database->data(array("title"=>$_POST["title"],"digest"=>$_POST["digest"],"funds"=>$_POST["funds"],"webpic"=>$_POST["webpic"],"content"=>$_POST["content"],"starttime"=>strtotime($_POST["starttime"]),
                "endtime"=>strtotime($_POST["endtime"]),"mer_id"=>$this->merchant_session["mer_id"],"video"=>$_POST["videourl"],"videopic"=>$_POST["videopic"],"crowdplace"=>$_POST["crowdplace"],"crowdcat"=>$_POST["crowdcat"]))->add()){
                for ($i=1;$i<=$gradeindex;$i++){
                    if(!($this->isgradenotempty($_POST["grade".$i]))){
                        $database->where(array("crowd_id"=>$crowdid))->delete();
                        $this->error("请填写完整的众筹档次信息");

                    }

                }
                for ($i=1;$i<=$gradeindex;$i++){
                    $this->insertgrade($_POST["grade".$i],$crowdid,$this->merchant_session["mer_id"]);
                }
            $this->success("添加成功");
            }else{
                $this->error('添加失败');
            }
        }

    }

    /**
     * @param $data
     * @return bool
     * 判断是档次内容是否含空
     */
    private function isgradenotempty($data){
        foreach ($data as $key=>$value){
            if(empty($value)){
                return false;
            }
        }
        return true;

    }

    private function  insertgrade($grade,$crowdid,$merid){
        $database=D("Crowdgrade");
        if($grade[5]==0){
            $database->data(array("crowd_id"=>$crowdid,"title"=>$grade[0],"digest"=>$grade[1],
                "price"=>$grade[2],"limitnum"=>$grade[3],"mer_id"=>$merid,"is_lottery_grade"=>intval($grade[4])))->add();
        }else{
            $database->where("grade_id = ".$grade[5])->data(array("crowd_id"=>$crowdid,"title"=>$grade[0],"digest"=>$grade[1],
                "price"=>$grade[2],"limitnum"=>$grade[3],"mer_id"=>$merid,"is_lottery_grade"=>intval($grade[4])))->save();
        }


    }

    /**
     * @param $crowd_id
     * 删除套餐
     */
    private function delegegrade($crowd_id){
        D("Crowdgrade")->where(array("crowd_id"=>$crowd_id))->delete();

    }


    public function  edit(){
        $database_group = D('Crowdfunding');
        $condition_group['crowd_id'] = $_GET['crowd_id'];
        $now_group = $database_group->field(true)->where($condition_group)->find();
        if (empty($now_group)) {
            $this->error('该众筹'  . '不存在！');
        }
        $group_image_class = new group_image();
        $now_group['webpicture']=  $group_image_class->get_image_by_path($now_group['webpic'], 's');
        $now_group["videopicture"]=$group_image_class->get_image_by_path($now_group['videopic'],'s');
        $this->assign('now_group', $now_group);
        $crowdgrades=D("Crowdgrade")->where(array("crowd_id"=>$now_group["crowd_id"]))->select();
        $this->assign("crowdgrades",$crowdgrades);
   //     echo  json_encode($crowdgrades);die;
        $this->display();
    }

    public function  editaction(){
        if (IS_POST) {
            if (empty($_POST['title'])) {
                $this->error('请填写众筹标题');
            }
            if (empty($_POST['digest'])) {
                $this->error('请填写众筹描述');
            }
            if (empty($_POST['funds'])) {
                $this->error('请填写目标筹款');
            }
            if(empty($_POST["crowdplace"])){
                $this->error('请上传众筹地区');
            }
            if (empty($_POST['webpic'])) {
                $this->error('请上传众筹宣传图');
            }
            if (empty($_POST['content'])) {
                $this->error('请填写众筹详情');
            }
            if(empty($_POST["videourl"])){
                $this->error('请上传众筹视频');
            }
            if(empty($_POST["videopic"])){
                $this->error('请上传众筹视频封面图');
            }
            $gradeindex=intval($_POST["gradeindex"]);



            $_POST['content'] = fulltext_filter($_POST['content']);
            $database=D("Crowdfunding");
            $datacrowd=$database->where(array("crowd_id"=>$_POST["crowd_id"]))->find();
            if(empty($datacrowd)){
                $this->error("不错在的众筹");
            }
            if($database->where(array("crowd_id"=>$_POST["crowd_id"]))->data(array("title"=>$_POST["title"],"digest"=>$_POST["digest"],"funds"=>$_POST["funds"],"webpic"=>$_POST["webpic"],"content"=>$_POST["content"],"starttime"=>strtotime($_POST["starttime"]),
                "endtime"=>strtotime($_POST["endtime"]),"mer_id"=>$datacrowd['mer_id'],"video"=>$_POST["videourl"],"videopic"=>$_POST["videopic"],"crowdplace"=>$_POST["crowdplace"],"crowdcat"=>$_POST["crowdcat"],"update"=>time()))->save()){
                for ($i=1;$i<=$gradeindex;$i++){
                    if(!($this->isgradenotempty($_POST["grade".$i]))){
                       // $database->where(array("crowd_id"=>$crowdid))->delete();
                        $this->error("请填写完整的众筹档次信息");

                    }

                }
              //    $this->delegegrade($_POST["crowd_id"]);
                for ($i=1;$i<=$gradeindex;$i++){
                    $this->insertgrade($_POST["grade".$i],$_POST["crowd_id"],$datacrowd['mer_id']);
                }
                $this->success("添加成功");
            }else{
                $this->error('添加失败');
            }
        }
    }


    /*
 * 删除众筹
 *
 */
    public function group_cancle(){
        if(IS_POST){
            $group_id = intval($_POST['crowd_id']);
            if($group_id){
                $result=D("Crowdfunding")->where(array("crowd_id"=>$group_id))->delete();
                if($result){
                    $this->success('删除众筹商品成功');
                }else{
                    $this->error('删除众筹商品失败！请重试~');
                }
            }else{
                $this->error('缺少参数！请重试~');
            }
        }else{
            $this->error('非法提交,请重新提交~');
        }
    }



}