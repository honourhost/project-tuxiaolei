<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/9
 * Time: 15:25
 */
class CrowdfundingAction extends BaseAction
{
    /**
     * 众筹列表
     */
    public function  index(){

        //搜索  只显示已经通过审核的众筹列表
        $condition_where="status = 1  ";

        if(!empty($_GET['keyword'])){
            if($_GET['searchtype'] == 'crowd_id'){
                $condition_where .= " AND `g`.`crowd_id`=" . intval($_GET['keyword']);
            }else if($_GET['searchtype'] == 'title'){
                $condition_where .= " AND `g`.`title` LIKE '%" . $_GET['keyword'] . "%'";
            }
        }
        //指定商家
        if(!empty($_GET['mer_id'])){
            $condition_where .= " AND `g`.`mer_id`=" . intval($_GET['mer_id']);
        }

        $condition_table  = array(C('DB_PREFIX').'crowdfunding'=>'g');
        $condition_field  = '`g`.*';

        import('@.ORG.system_page');
        $count_group = D('')->table($condition_table)->where($condition_where)->count('DISTINCT `g`.`crowd_id`');
        $p = new Page($count_group, 20);
        $group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order('`g`.`crowd_id` DESC')->group('`g`.`crowd_id`')->limit($p->firstRow.','.$p->listRows)->select();
     //   echo  D()->getLastSql();
        $this->assign('group_list', $group_list);

        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->display();

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
                $this->error('请填写众筹地区');
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
              //  $this->delegegrade($_POST["crowd_id"]);
                for ($i=1;$i<=$gradeindex;$i++){
                    $this->insertgrade($_POST["grade".$i],$_POST["crowd_id"],$datacrowd['mer_id']);
                }
                $this->success("添加成功");
            }else{
                $this->error('添加失败'.D()->getLastSql());
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
//        $database=D("Crowdgrade");
//        $database->data(array("crowd_id"=>$crowdid,"title"=>$grade[0],"digest"=>$grade[1],
//            "price"=>$grade[2],"limitnum"=>$grade[3],"mer_id"=>$merid,"is_lottery_grade"=>intval($grade[4])))->add();
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


    /**
     * 众筹列表
     */
    public function  waitcrowding(){

        //搜索
        $condition_where="status = 0  ";

        if(!empty($_GET['keyword'])){
            if($_GET['searchtype'] == 'crowd_id'){
                $condition_where .= " AND `g`.`crowd_id`=" . intval($_GET['keyword']);
            }else if($_GET['searchtype'] == 'title'){
                $condition_where .= " AND `g`.`title` LIKE '%" . $_GET['keyword'] . "%'";
            }
        }
        //指定商家
        if(!empty($_GET['mer_id'])){
            $condition_where .= " AND `g`.`mer_id`=" . intval($_GET['mer_id']);
        }

        $condition_table  = array(C('DB_PREFIX').'crowdfunding'=>'g');
        $condition_field  = '`g`.*';

        import('@.ORG.system_page');
        $count_group = D('')->table($condition_table)->where($condition_where)->count('DISTINCT `g`.`crowd_id`');
        $p = new Page($count_group, 20);
        $group_list = D('')->field($condition_field)->table($condition_table)->where($condition_where)->order('`g`.`crowd_id` DESC')->group('`g`.`crowd_id`')->limit($p->firstRow.','.$p->listRows)->select();
      //  echo  D()->getLastSql();
        $this->assign('group_list', $group_list);

        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->display();

    }

    /**
     * 通过审核
     */
    public function  passwait(){
        $crowd_id=$_GET["crowd_id"];
        $crowd=D("Crowdfunding")->where(array("crowd_id"=>$crowd_id))->find();
        if(empty($crowd)){
            $this->error("不存在~");
        }
        if($crowd["status"]==1){
            $this->error("已经审核通过啦，别点了哟~");
        }

        if(D("Crowdfunding")->where(array("crowd_id"=>$crowd_id))->data(array("status"=>1))->save()){
            $this->success("审核通过");
        }else{
            $this->error("失败，重试把~");
        }

    }

    /**
     * 反审核
     */
    public function  anticheck(){
        $crowd_id=$_GET["crowd_id"];
        $crowd=D("Crowdfunding")->where(array("crowd_id"=>$crowd_id))->find();
        if(empty($crowd)){
            $this->error("不存在~");
        }
        if($crowd["status"]==0){
            $this->error("已经在审核状态了，别点了哟~");
        }

        if(D("Crowdfunding")->where(array("crowd_id"=>$crowd_id))->data(array("status"=>0))->save()){
            $this->success("反审核通过");
        }else{
            $this->error("失败，重试把~");
        }
    }

    /**
     * 普通众筹订单列表
     */
    public function  order_list(){
        $crowdid=$_GET["crowd_id"];
        $condition_table = array(C('DB_PREFIX').'crowdorder'=>'co', C('DB_PREFIX').'crowdfunding'=>'cf',C('DB_PREFIX').'crowdgrade'=>'cg', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m');
        $condition_where="`co`.`uid`=`u`.`uid` AND `co`.`mer_id`=`m`.`mer_id` AND `co`.`cgrade_id`=`cg`.`grade_id` AND `co`.`crowd_id`=`cf`.`crowd_id` AND `co`.`paid`='1' AND `co`.`crowd_id` = ".$crowdid." AND `cg`.`is_lottery_grade` = 1 ";

        if(empty($_GET['keyword'])){
            $order_count = D('')->where($condition_where)->table($condition_table)->count();
            //   echo  D()->getLastSql();die;
            import('@.ORG.system_page');
            $p = new Page($order_count,30);

            $order_list = D('')->field('`co`.`phone` AS `group_phone`,`co`.*,`cg`.`title`,`cg`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`cg`.`crowd_id`')->where($condition_where)->table($condition_table)->order('`co`.`status` ASC,`co`.`corder_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
            if(empty($order_list)){
                $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
            }

            //print_r($order_list);die;
            $this->assign('order_list',$order_list);

            $pagebar = $p->show();
            $this->assign('pagebar',$pagebar);
            $this->display();die;
        }else{
            if ($_GET['searchtype'] == 'corder_id') {
                $condition_where .= " AND `co`.`corder_id`=" . intval($_GET['keyword']);
            } elseif ($_GET['searchtype'] == 'name') {
                $condition_where .= " AND `u`.`nickname`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'phone') {
                $condition_where .= " AND `u`.`phone`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'title') {
                $condition_where .= " AND `cg`.`title`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'grade_id') {
                $condition_where .= " AND `o`.`cgrade_id`='" . htmlspecialchars($_GET['keyword']) . "'";
            }

            $order_count = D('')->where($condition_where)->table($condition_table)->count();
            import('@.ORG.system_page');
            $p = new Page($order_count,30);

            $order_list = D('')->field('`co`.`phone` AS `group_phone`,`co`.*,`cg`.`title`,`cg`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`cg`.`crowd_id`')->where($condition_where)->table($condition_table)->order('`o`.`status` ASC,`o`.`order_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
            if(empty($order_list)){
                $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
            }


            //print_r($order_list);die;
            $this->assign('order_list',$order_list);

            $pagebar = $p->show();
            $this->assign('pagebar',$pagebar);
            $this->display();die;
        }

        $this->display();

    }

    /**
     * 抽奖众筹订单列表
     */
    public function  lottery_order_list(){
        $crowdid=$_GET["crowd_id"];
        $condition_table = array(C('DB_PREFIX').'crowdorder'=>'co', C('DB_PREFIX').'crowdfunding'=>'cf',C('DB_PREFIX').'crowdgrade'=>'cg', C('DB_PREFIX').'user'=>'u', C('DB_PREFIX').'merchant'=>'m');
        $condition_where="`co`.`uid`=`u`.`uid` AND `co`.`mer_id`=`m`.`mer_id` AND `co`.`cgrade_id`=`cg`.`grade_id` AND `co`.`crowd_id`=`cf`.`crowd_id` AND `co`.`paid`='1' AND `co`.`crowd_id` = ".$crowdid." AND `cg`.`is_lottery_grade` = 2 ";

        if(empty($_GET['keyword'])){
            $order_count = D('')->where($condition_where)->table($condition_table)->count();
            //   echo  D()->getLastSql();die;
            import('@.ORG.system_page');
            $p = new Page($order_count,30);

            $order_list = D('')->field('`co`.`phone` AS `group_phone`,`co`.*,`cg`.`title`,`cg`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`cg`.`crowd_id`')->where($condition_where)->table($condition_table)->order('`co`.`status` ASC,`co`.`corder_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
            if(empty($order_list)){
                $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
            }

            //print_r($order_list);die;
            $this->assign('order_list',$order_list);

            $pagebar = $p->show();
            $this->assign('pagebar',$pagebar);
            $this->display();die;
        }else{
            if ($_GET['searchtype'] == 'corder_id') {
                $condition_where .= " AND `co`.`corder_id`=" . intval($_GET['keyword']);
            } elseif ($_GET['searchtype'] == 'name') {
                $condition_where .= " AND `u`.`nickname`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'phone') {
                $condition_where .= " AND `u`.`phone`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'title') {
                $condition_where .= " AND `cg`.`title`='" . htmlspecialchars($_GET['keyword']) . "'";
            } elseif ($_GET['searchtype'] == 'grade_id') {
                $condition_where .= " AND `o`.`cgrade_id`='" . htmlspecialchars($_GET['keyword']) . "'";
            }

            $order_count = D('')->where($condition_where)->table($condition_table)->count();
            import('@.ORG.system_page');
            $p = new Page($order_count,30);

            $order_list = D('')->field('`co`.`phone` AS `group_phone`,`co`.*,`cg`.`title`,`cg`.`price` as g_price,`u`.`uid`,`u`.`nickname`,`u`.`phone`,`m`.`phone` as m_phone,`m`.`name` as m_name,`m`.`mer_id`,`cg`.`crowd_id`')->where($condition_where)->table($condition_table)->order('`o`.`status` ASC,`o`.`order_id` DESC')->limit($p->firstRow.','.$p->listRows)->select();
            if(empty($order_list)){
                $this->error_tips('当前'.$this->config['group_alias_name'].'并未产生订单！');
            }


            //print_r($order_list);die;
            $this->assign('order_list',$order_list);

            $pagebar = $p->show();
            $this->assign('pagebar',$pagebar);
            $this->display();die;
        }

        $this->display();

    }



}