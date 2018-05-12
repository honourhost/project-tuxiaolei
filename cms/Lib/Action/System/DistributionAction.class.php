<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/3/29
 * Time: 14:57
 */
class DistributionAction extends BaseAction{
    /**
     * 分销用户列表
     */
    public function index(){
        import('@.ORG.system_page');
        $count = D("Distribution_person")->count();
        $p = new Page($count, 20);
        $res=D("Distribution_person")->limit($p->firstRow.','.$p->listRows)->select();
        $pagebar = $p->show();
        $this->assign('pagebar',$pagebar);
        $this->assign("persons",$res);
        $this->display();
    }

    /**
     * 新增分销用户
     */
    public function add(){
        if(IS_POST){
            $type=intval($_POST['type']);
            $value=$_POST['content'];
            if(empty($type)||empty($value)){
                $this->error("所传数据有误！");
            }
            $Distribution_person = D("Distribution_person");
            //先判断用户是否存在，不存在不添加
            $res=$this->personExist($type,$value);
            if(!$res){
                $this->error("不存在该用户！");
            }
            //判断是否该用户已经存在分销权限
            $dis_where=array(
                "user_id"=>$res['uid'],
                );
            $dis_res=$Distribution_person->where($dis_where)->find();
            if(!empty($dis_res)){
                $this->error("该用户已经存在分销权限禁止重复添加！");
            }
            //创建随机的分销id
            $user_id=$res['uid'];
            $num=15-strlen($user_id)-1;
            $str=$this->createRandStr($num);
            $distribution_id=$str."_".$user_id;
            $insertdata=array(
                    "user_id"=>$user_id,
                    "distribution_id"=>$distribution_id,
                    "create_time"=>time()
            );
            $data['create_time']=time();
            if($Distribution_person->add($insertdata)){
                $this->success("新增分销用户成功！",U("Distribution/index"),true);
            }else{
                $this->error("新增分销用户失败！");
            }
        }else{
            $this->display();
        }
    }

    /**
     * 删除用户分销权限
     */
    public function del(){
        $Distribution_person=D("Distribution_person");
        $id=intval($_POST['id']);
        //先查看该用户是否是股东用户，如果是则只能在股东管理处删除
        $res=$Distribution_person->where("id=".$id)->find();
        //查询股东表
        $res=D("Channel_person")->where("user_id=".$res['user_id'])->find();
        if(!empty($res)){
            $this->error("无法删除股东身份的分销用户！");
        }
        if($Distribution_person->where("id=".$id)->delete()){
            $this->success("删除分销用户成功！");
        }else{
            $this->error("删除分销用户失败！");
        }
    }

    //判断是否存在该用户
    private function personExist($type,$value){
        switch($type){
            case 1:
            $where['phone']=$value;
            break;
            case 2:
            $where['nickname']=$value;
            break;
            case 3:
            $where['uid']=$value;
            break;
            default:
            $flag=true;
            break;
        }
        if($flag){
            return false;
        }
        $where['status']=1;
        $res=D("User")->where($where)->find();
        if(!empty($res)){
            return $res;
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

}