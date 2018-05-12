<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/23 0023
 * Time: 16:14
 */
class FastCashAction extends BaseAction
{

    public function index(){
        //查出所有的申请提现
        import('@.ORG.system_page');
        $Bank_cash_info=D("Fast_bank_cash_info");
        $count_cash=$Bank_cash_info->count();
        $p = new Page($count_cash,15);
        $cash_list=$Bank_cash_info->alias("b")->field("b.status as cash_status,b.*,m.*,mar.name as marname")->join(C('DB_PREFIX')."merchant as m ON b.mer_id=m.mer_id")->join(C('DB_PREFIX')."marketers as mar ON m.marketer_id =mar.id")->limit($p->firstRow . ',' . $p->listRows)->order("b.create_time asc ")->select();
       //   echo  json_encode($cash_list);die;
        $pagebar = $p->show();
        $this->assign('pagebar', $pagebar);
        $this->assign("cash_list",$cash_list);
        $this->display();
    }

    //完成提现
    public function finish(){
        $id=intval($_POST['id']);
        $cash=D("Fast_bank_cash_info")->where("id=".$id)->find();
        if(empty($cash)){
            $this->error("不存在的提现申请！");
        }
        $result=D("Fast_bank_cash_info")->where("id=".$id)->setField("status",1);
        if($result){
            //成功后插入到提现记录表中
            $data['cash_info_id']=$cash['id'];
            $data['cash_num']=$cash['cash_num'];
            $data['record_time']=time();
            $data['status']=1;
//            $res=D("Merchant_cash_record")->save($data);
//            if($res) {
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
            $result = D("Fast_bank_cash_info")->where("id=" . $id)->setField("status", 2);
            if($result){

                    $this->frame_submit_tips(1,"提现驳回操作成功！");

            }else{
                $this->frame_submit_tips(0,"提现驳回操作失败！");
            }
        } else {
            $id = intval($_GET['id']);
            $cash = D("Fast_bank_cash_info")->where("id=" . $id)->find();
            if (empty($cash)) {
                $this->frame_error_tips('不存在的提现申请！');
            }
            $this->assign("cash",$cash);
            $this->display();
        }
    }

}