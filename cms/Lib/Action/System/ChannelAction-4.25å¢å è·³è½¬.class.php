<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/3/28
 * Time: 14:49
 */
class ChannelAction extends BaseAction{
    /**
     * 频道列表
     */
    public function index(){
        import('@.ORG.system_page');
        $count = D("Channel")->where(array('status'=>1))->count();
        $p = new Page($count, 20);
        $res=D("Channel")->where("status=1")->limit($p->firstRow.','.$p->listRows)->select();
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);
        $this->assign("channels",$res);
        $this->display();
    }

    /**
     * 新增频道
     */
    public function add(){
        if(IS_POST){
            $Channel=D("Channel");
            if($data=$Channel->create()){
                $data=array_filter($data);
                if(empty($data)){
                    $this->error("所传数据为空！");
                }
                $data['create_time']=time();
                $data['status']=1;
                if($Channel->add($data)){
                    $this->success("新增频道成功！",U("Channel/index"));
                }else{
                    $this->error("新增频道失败！");
                }
            }else{
                $this->error("数据传输出错！");
            }
        }else{
            $this->display();
        }
    }

    /**
     * 编辑频道
     */
    public function edit(){
        $Channel=D("Channel");
        if(IS_POST){
            if($data=$Channel->create()){
                $data=array_filter($data);
                if(empty($data)){
                    $this->error("所传数据为空！");
                }
                if($Channel->save($data)){
                    $this->success("修改频道成功！");
                }else{
                    $this->error("修改频道失败！");
                }
            }else{
                $this->error("数据传输出错！");
            }
        }else{
            $id=intval($_GET['id']);
            $channel=$Channel->where("id=".$id)->find();
            $this->assign("channel",$channel);
            $this->display();
        }
    }

    /**
     * 删除频道
     */
    public function del(){
        $Channel=D("Channel");
        $id=intval($_POST['id']);
        if($Channel->where("id=".$id)->setField("status",0)){
            $this->success("删除频道成功！");
        }else{
            $this->error("删除频道失败！");
        }
    }
    //频道分类列表
    public function catList(){
        $id=intval($_GET['id']);
        import('@.ORG.system_page');
        $condition=array('status'=>1,"c_id"=>$id);
        $count = D("Channel_category")->where($condition)->count();
        $p = new Page($count, 20);
        $res=D("Channel_category")->where($condition)->limit($p->firstRow.','.$p->listRows)->select();
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);
        $this->assign("c_id",$id);
        $this->assign("categories",$res);
        $this->display();
    }
    //添加频道分类
    public function catAdd(){
        if(IS_POST){
            $Channel_cat=D("Channel_category");
            if($data=$Channel_cat->create()){
                $data=array_filter($data);
                if(empty($data)){
                    $this->error("所传数据为空！");
                }
                $data['create_time']=time();
                $data['status']=1;
                if($Channel_cat->add($data)){
                   $this->success("频道分类添加成功！",U("Channel/catList",array("id"=>$data['c_id'])));
                }else{
                    $this->error("频道分类添加失败！");
                }
            }else{
                $this->error("传输数据出错！");
            }
        }else{
            $id=intval($_GET['id']);
            $this->assign("c_id",$id);
            $this->display();
        }
    }
    //编辑频道分类
    public function catEdit(){
        $Channel_cat=D("Channel_category");
        if(IS_POST){
            if($data=$Channel_cat->create()){
                $data=array_filter($data);
                if(empty($data)){
                    $this->error("所传数据为空！");
                }
                if($Channel_cat->save($data)){
                    $this->success("频道分类修改成功！",U("Channel/catList",array("id"=>$data['c_id'])));
                }else{
                    $this->error("频道分类修改失败！");
                }
            }else{
                $this->error("传输数据出错！");
            }
        }else{
            $id=intval($_GET['id']);
            $channel=$Channel_cat->where("id=".$id)->find();
            $this->assign("cat",$channel);
            $this->display();
        }
    }
    //删除频道分类
    public function catDel(){
        $Channel_cat=D("Channel_category");
        $id=intval($_POST['id']);
        if($Channel_cat->where("id=".$id)->setField("status",0)){
            $this->success("删除频道分类成功！");
        }else{
            $this->error("删除频道分类失败！");
        }
    }
    //频道分类下商品列表
    public function goodsList(){
        $id=intval($_GET['id']);
        //先查询出对应的分类信息
        $Channel_cat=D("Channel_category");
        $cat=$Channel_cat->where(array("id"=>$id))->find();
        $this->assign("c_id",$cat['c_id']);
        $this->assign("cat_id",$id);
        //分页查询商品信息
        import('@.ORG.system_page');
        $condition=array('status'=>1,"cat_id"=>$id);
        $count = D("Channel_category_goods")->where($condition)->count();
        $p = new Page($count, 20);
        $res=D("Channel_category_goods")->where($condition)->limit($p->firstRow.','.$p->listRows)->select();
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);
        $this->assign("goods",$res);
        $this->display();
    }
    //频道分类下商品添加
    public function addGoods(){
        if(IS_POST){
            $Channel_category_goods=D("Channel_category_goods");
            if($data=$Channel_category_goods->create()){
                    $data=array_filter($data);
                    if(empty($data)){
                    $this->error("所传数据为空！");
                    }
                    //判断是否存在该商品
                    if(!($this->goodsExist($data['goods_id']))){
                        $this->error("要添加的商品不存在或者被关闭！");
                    }
                    $data['create_time']=time();
                    $data['status']=1;
                    if($Channel_category_goods->add($data)){
                        $this->success("新增分类下商品成功！");
                    }else{
                        $this->error("新增分类下商品出错！");
                    }
            }else{
                $this->error("传参出错！");
            }
        }else {
            //频道id
            $c_id = intval($_GET['c_id']);
            //频道分类id
            $cat_id = intval($_GET['cat_id']);
            $this->assign("c_id",$c_id);
            $this->assign("cat_id",$cat_id);
            $this->display();
        }
    }
    //频道分类下商品添加
    public function editGoods(){
        if(IS_POST){
            $Channel_category_goods=D("Channel_category_goods");
            if($data=$Channel_category_goods->create()){
                $data=array_filter($data);
                if(empty($data)){
                    $this->error("所传数据为空！");
                }
                if($Channel_category_goods->save($data)){
                    $this->success("编辑分类下商品成功！");
                }else{
                    $this->error("编辑分类下商品出错！");
                }
            }else{
                $this->error("传参出错！");
            }
        }else {
            //对应的编辑
            $id=intval($_GET['id']);
            //频道id
            $c_id = intval($_GET['c_id']);
            //频道分类id
            $cat_id = intval($_GET['cat_id']);
            $goods=D("Channel_category_goods")->where(array("id"=>$id))->find();
            $this->assign("goods",$goods);
            $this->assign("c_id",$c_id);
            $this->assign("cat_id",$cat_id);
            $this->display();
        }
    }
    //频道分类下商品添加
    public function delGoods(){
        $Channel_category_goods=D("Channel_category_goods");
        $id=intval($_POST['id']);
        if($Channel_category_goods->where("id=".$id)->setField("status",0)){
            $this->success("删除频道分类成功！");
        }else{
            $this->error("删除频道分类失败！");
        }
    }
    //频道下股东列表
    public function personList(){
        $id=intval($_GET['id']);
        $this->assign("c_id",$id);
        //分页查询商品信息
        import('@.ORG.system_page');
        $condition=array("c_id"=>$id);
        $count = D("Channel_person")->where($condition)->count();
        $p = new Page($count, 20);
        $res=D("Channel_person")->where($condition)->limit($p->firstRow.','.$p->listRows)->select();
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);
        $this->assign("persons",$res);
        $this->display();
    }

    /**
     * 新增股东
     */
    public function addPerson(){
        if(IS_POST){
            $Channel_person=D("Channel_person");
            if($data=$Channel_person->create()){

                $data=array_filter($data);
                if(empty($data)){
                    $this->error("所传数据为空！");
                }

                $data['create_time']=time();
                $data['status']=1;

                //先判断用户是否存在，不存在不添加
                if(!($this->personExist($data['user_id']))){
                  $this->error("不存在该用户！");
                }
                //查看用户是否已经有权限，有的话不再添加
                $person=$Channel_person->where("user_id=".$data['user_id'])->find();
                if(!empty($person)){
                    $this->error("该用户已经有分销权限，请勿重新添加");
                }
                if($Channel_person->add($data)){
                    //新增之后再新增分销信息
                    //生成15位字符，前面是随机字符串后面是用户id，中间加0连接
                    $user_id=$data['user_id'];
                    $num=15-strlen($user_id)-1;
                    $str=$this->createRandStr($num);
                    $distribution_id=$str."_".$user_id;
                    $disdata=array(
                        "user_id"=>$user_id,
                        "distribution_id"=>$distribution_id,
                        "create_time"=>time()
                    );
                    if(D("Distribution_person")->add($disdata)) {
                        $this->success("频道股东添加成功且分销权限也新增成功！", U("Channel/personList", array("id" => $data['c_id'])));
                    }else{
                        $this->error("频道股东添加成功但是分销权限新增失败！");
                    }
                }else{
                    $this->error("频道股东添加失败！");
                }
            }else{
                $this->error("传输数据出错！");
            }
        }else{
            $id=intval($_GET['id']);
            $this->assign("c_id",$id);
            $this->display();
        }
    }

    /**
     * 内容太少不要编辑股东了
     */
    public function editPerson(){
        $this->display();
    }

    /**
     * 删除股东（直接删除）
     */
    public function delPerson(){
        $Channel_person=D("Channel_person");
        $id=intval($_POST['id']);
        //先查询出对应的用户，为了之后删除分销表的关系数据
        $condition=array(
            "id"=>$id,
        );
        $res=$Channel_person->where($condition)->find();
        if($Channel_person->where($condition)->delete()){
            //删除当前股东信息之后再删除分销信息
            $condition_where=array(
                "user_id"=>$res['user_id'],
            );
            if(D("Distribution_person")->where($condition_where)->delete()) {
                $this->success("删除频道股东成功，且删除分销信息成功！");
            }else{
                $this->success("删除频道股东成功，但是删除分销信息失败！");
            }
        }else{
            $this->error("删除频道股东失败！");
        }
    }
    //判断商品是否存在
    private function goodsExist($id){
        $condition=array(
            "group_id"=>$id,
            "status"=>1
        );
        $res=D("Group")->where($condition)->find();
        if(!empty($res)){
            return true;
        }else{
            return false;
        }
    }
    //判断是否存在该用户
    private function personExist($id){
        $condition=array(
            "uid"=>$id,
            "status"=>1
        );
        $res=D("User")->where($condition)->find();
        if(!empty($res)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 为了生成总长度15位的分销id
     * 按照长度随机生成字符串
     * @param $num
     * @return string
     */
    private function createRandStr($num){
        $letters=array(
            "A","a","B","b","C","c","D","d","E","e","F","f","G","g","H","h","I","i","J","j","K","k","L","l","M","m",
            "N","n","O","o","P","p","Q","q","R","r","S","s","T","t","U","u","V","v","W","w","X","x","Y","y","Z","z",
        );
        $str="";
        for($i=0;$i<$num;$i++){
           $j=rand(0,51);
            $str.=$letters[$j];
        }
        return $str;
    }

    public function banner_list(){
        $now_category = $this->check_get_category($_GET['id']);
        $this->assign('now_category',$now_category);
        $database_slider = D('Channel_banner');
        $condition_slider['c_id'] = $now_category['id'];
        $slider_list = $database_slider->field(true)->where($condition_slider)->order('`sort` DESC,`id` ASC')->select();
        $this->assign('slider_list',$slider_list);

        $this->display();
    }
    public function banner_add(){
        $this->assign('bg_color','#F3F3F3');
        $cat_id=intval($_GET['c_id']);
        $now_category = $this->frame_check_get_category($cat_id);
        $this->assign('now_category',$now_category);

        $this->display();
    }
    public function banner_modify(){
        if($_FILES['pic']['error'] != 4){
            $image = D('Image')->handle($this->system_session['id'], 'channelbanner');
            if (!$image['error']) {

                $_POST = array_merge($_POST, str_replace('/upload/channelbanner/', '', $image['url']));
            } else {
                $this->frame_submit_tips(0, $image['msg']);
            }
        }
        $_POST['create_time'] = $_SERVER['REQUEST_TIME'];
        $database_slider = D('Channel_banner');

        if($id = $database_slider->data($_POST)->add()){
            D('Image')->update_table_id('/upload/channelbanner/' . $_POST['pic'], $id, 'channelbanner');
            S('banner_list_'.$_POST['c_id'],NULL);
            $this->frame_submit_tips(1,'添加成功！');
        }else{
            $this->frame_submit_tips(0,'添加失败！请重试~');
        }
    }
    public function banner_edit(){
        $this->assign('bg_color','#F3F3F3');

        $database_slider = D('Channel_banner');
        $condition_slider['id'] = $_GET['id'];
        $now_slider = $database_slider->field(true)->where($condition_slider)->find();
        if(empty($now_slider)){
            $this->frame_error_tips('该导航不存在！');
        }
        $this->assign('now_slider',$now_slider);

        $this->display();
    }

    public function banner_amend(){
        $database_slider = D('Channel_banner');
        $condition_slider['id'] = $_POST['id'];
        $now_slider = $database_slider->field(true)->where($condition_slider)->find();

        if($_FILES['pic']['error'] != 4){

            $image = D('Image')->handle($this->system_session['id'], 'channelbanner');
            if (!$image['error']) {
                $_POST = array_merge($_POST, str_replace('/upload/channelbanner/', '', $image['url']));
                //$_POST = array_merge($_POST, $image['url']);
            } else {
                $this->frame_submit_tips(0, $image['msg']);
            }
        }
        $_POST['create_time'] = $_SERVER['REQUEST_TIME'];
        if($database_slider->data($_POST)->save()){
            D('Image')->update_table_id('/upload/channelbanner/' . $_POST['pic'], $_POST['id'], 'channelbanner');
            S('banner_list_'.$_POST['c_id'],NULL);
            if($_POST['pic']){
                if(strpos($now_slider['pic'],'2014/') === false){
                    unlink('./upload/channelbanner/'.$now_slider['pic']);
                }
            }
            $this->frame_submit_tips(1,'编辑成功！');
        }else{
            $this->frame_submit_tips(0,'编辑失败！请重试~');
        }
    }

    public function banner_del(){
        $database_slider = D('Channel_banner');
        $condition_slider['id'] = $_POST['id'];
        $now_slider = $database_slider->field(true)->where($condition_slider)->find();
        if($database_slider->where($condition_slider)->delete()){
            S('banner_list_'.$now_slider['c_id'],NULL);
            if($now_slider['pic']){
                if(strpos($now_slider['pic'],'2014/') === false){
                    unlink('./upload/channelbanner/'.$now_slider['pic']);
                }
            }
            $this->success('删除成功');
        }else{
            $this->error('删除失败！请重试~');
        }
    }

    protected function get_category($cat_id){
        $database_slider_category  = D('Channel');
        $condition_slider_category['id'] = $cat_id;
        $now_category = $database_slider_category->field(true)->where($condition_slider_category)->find();
        return $now_category;
    }
    protected function frame_check_get_category($cat_id){
        $now_category = $this->get_category($cat_id);
        if(empty($now_category)){
            $this->frame_error_tips('分类不存在！');
        }else{
            return $now_category;
        }
    }
    protected function check_get_category($cat_id){
        $now_category = $this->get_category($cat_id);
        if(empty($now_category)){
            $this->error_tips('分类不存在！');
        }else{
            return $now_category;
        }
    }
}