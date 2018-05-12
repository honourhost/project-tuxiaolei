<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/8/1
 * Time: 14:55
 */
class UsercashAction extends  BaseAction
{

    public function index(){

        import('@.ORG.system_page');
        $Bank_cash_info=D("Usercash");
        $count_cash=$Bank_cash_info->count();
        $p = new Page($count_cash,15);
        $cash_list=$Bank_cash_info->limit($p->firstRow . ',' . $p->listRows)->order("add_time DESC ")->select();
        //   echo  json_encode($cash_list);die;
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->assign("cash_list",$cash_list);
      //  echo D("")->getLastSql();die;
        $this->display();

    }


    //完成提现
    public function finish(){
        $id=intval($_POST['id']);
        $cash=D("Usercash")->where("id=".$id)->find();
        if(empty($cash)){
            $this->error("不存在的提现申请！");
        }
        $result=D("Usercash")->where("id=".$id)->setField("status",1);
        D("User")->where(array("uid"=>$cash["uid"]))->setDec("distribute_money",$cash['cash_money']);
        //echo  D()->getLastSql();die;
        if($result){
            //成功后插入到提现记录表中

            D("Usercash")->where("id=".$id)->setField("modify_time",time());
            D("User_money_list")->add_row($cash["uid"],2,$cash['cash_money'],"佣金提现".$cash['cash_money']."元",$record_ip = true);
            $this->success("提现操作成功！");
//            }else{
//                $this->error("提现操作记录失败，但是已经修改为成功状态！");
//            }
        }else{
            $this->error("提现操作失败！");
        }
    }


    //驳回状态修改
    public function reject()
    {
        if (!empty($_POST)) {
            $id=$_POST['id'];
            $result = D("Usercash")->where("id=" . $id)->setField("status", 2);
            D("Usercash")->where("id=" . $id)->setField("note", $_POST['note']);
            if($result){

                $this->frame_submit_tips(1,"提现驳回操作成功！");

            }else{
                $this->frame_submit_tips(0,"提现驳回操作失败！");
            }
        } else {
            $id = intval($_GET['id']);
            $cash = D("Usercash")->where("id=" . $id)->find();
            if (empty($cash)) {
                $this->frame_error_tips('不存在的提现申请！');
            }
            $this->assign("cash",$cash);
            $this->display();
        }
    }

}