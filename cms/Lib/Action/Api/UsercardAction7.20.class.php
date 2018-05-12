<?php

/**
 * Created by PhpStorm.
 * User: adamin90
 * Date: 2017/6/26
 * Time: 13:50
 */
class UsercardAction extends  NewbaseAction
{
     private  $uid;
     private $token;
     private $userCard;  //购物车model
    private  $groupModel; //group model

    protected function _initialize()
    {
        parent::_initialize();
        $this->uid=$_REQUEST["uid"];
        $this->token=$_REQUEST["token"];
        $this->userCard=D("Usercard");
        $this->groupModel=D("Group");
    }


    /**
     * 添加商品到购物车\
     * 必要参数 uid token  group_id num
     */
    public function addgoodtocard(){
        if(IS_POST){
            $num=$_POST["num"];
           if(!is_int(intval($num))){
               $this->returnAjax("非法数量请求",0);
           }
            $group_id=$_POST["group_id"];
            $groupnow=$this->groupModel->where("group_id = ".$group_id." AND begin_time < ".time()." AND end_time > ".time()." AND status = 1 AND is_group_buy = 0 ")->find();
            if(empty($groupnow)){
                $this->returnAjax("未找到该特卖",0);
            }
            $cardgoods=$this->userCard->where("uid = ".$this->uid." AND group_id = ".$group_id)->find();
            if(!empty($cardgoods)){
                if($this->userCard->where("uid = ".$this->uid." AND group_id = ".$group_id)->setInc("pro_num",$num)){
                    $this->returnAjax("购物车追加数量成功",1);
                }else{
                    $this->returnAjax("添加购物车失败，请重试",0);
                }

            }else{
                if($this->userCard->data(array("uid"=>$this->uid,"mer_id"=>$groupnow["mer_id"],"group_id"=>$group_id,"pro_num"=>$num,"price"=>$groupnow["price"],"add_time"=>time(),"selected"=>1))->add()){
                    $this->returnAjax("添加到购物车成功",1);
                }else{
                    $this->returnAjax("添加购物车失败，请重试",0);
                }
            }


        }else{
            $this->returnAjax("非法请求",0);
        }

    }

    /**
     * 列出某用户的购物车
     */
    public function  listcard(){
      $cards=  $this->userCard->where("uid = ".$this->uid)->order("add_time ASC ")->select();
      $groupdata=D("Group");
      if(empty($cards)){
          $this->returnAjax("购物车数据为空",2);
      }else{
          $groupimage=new group_image();

          foreach ($cards as $key=>$value){
              $group=$groupdata->where("group_id = ".$value["group_id"]." AND begin_time < ".time()." AND end_time > ".time()." AND status = 1 AND is_group_buy = 0 ")->find();
              if(empty($group)){
                  $this->userCard->where("group_id = ".$value["group_id"])->delete();  //删除过期数据
                  unset($cards[$key]);
              }else{
                  $cards[$key]["mer_id"]=$group["mer_id"];
                  $cards[$key]["title"]=$group["name"];
               //   $cards[$key]['image']=$groupimage->get_image_by_path($group["pic"],s);
                  if(!empty($group["picthumb"])){
                      $tmp_pic_arr = explode(';',$group['picthumb']);
                  }
                  elseif (!empty($group["picapp"])){
                      $tmp_pic_arr = explode(';',$group['picapp']);

                  }else{
                      $tmp_pic_arr = explode(';',$group['pic']);
                  }
                  $cards[$key]['image'] = $groupimage->get_image_by_path($tmp_pic_arr[0])['image'];

              }
          }
          $this->returnAjax($cards,1);

      }


    }

    /**
     * 购物车选中数量
     */
    public function  selectedcardnum(){
       // $cards=  $this->userCard->where("uid = ".$this->uid." AND selected = 1 ")->order("add_time ASC ")->select();
        $cards=  $this->userCard->where("uid = ".$this->uid)->order("add_time ASC ")->select();
        $groupdata=D("Group");
        if(empty($cards)){
            $this->returnAjax(array("num"=>0),1);
        }
        $num=0;
        foreach ($cards as $key=>$value){
          $num+=$value["pro_num"];
        }
        $this->returnAjax(array("num"=>$num
        ),1);
    }

    /**
     * 购物车某件商品减量
     */
    public function delnumfromcard(){
        if(IS_POST){
            $groupid=$_POST["group_id"];
            $num=$_POST["num"];
            $groupnow=$this->groupModel->where("group_id = ".$groupid." AND begin_time < ".time()." AND end_time > ".time()." AND status = 1 AND is_group_buy = 0 ")->find();
            if(empty($groupnow)){
                $this->returnAjax("未找到该特卖",0);
            }
            $cardnow=$this->userCard->where("group_id = ".$groupid." AND uid = ".$this->uid)->find();
            if(empty($cardnow)){
                $this->returnAjax("未找到该购物车",0);
            }
            $numnow=intval($cardnow["pro_num"]);
            if(intval($num)>=$numnow){
                if($this->userCard->where("group_id = ".$groupid." AND uid = ".$this->uid)->delete()){
                    $this->returnAjax("操作成功",1);
                }else{
                    $this->returnAjax("操作失败1",0);
                }
            }else{
                if($this->userCard->where("group_id = ".$groupid." AND uid = ".$this->uid)->setDec("pro_num",$num)){

                    $this->returnAjax("操作成功",1);
                }else{
                    $this->returnAjax("操作失败",0);
                }
            }


        }else{
            $this->returnAjax("非法请求",0);
        }


    }

    public function  changecardgoodsnum(){

        if(IS_POST){
            $groupid=$_POST["group_id"];
            $num=$_POST["num"];
            $groupnow=$this->groupModel->where("group_id = ".$groupid." AND begin_time < ".time()." AND end_time > ".time()." AND status = 1 AND is_group_buy = 0 ")->find();
            if(empty($groupnow)){
                $this->returnAjax("未找到该特卖",0);
            }
            $cardnow=$this->userCard->where("group_id = ".$groupid." AND uid = ".$this->uid)->find();
            if(empty($cardnow)){
                $this->returnAjax("未找到该购物车",0);
            }
            $numnow=intval($cardnow["pro_num"]);
            if(intval($num)<=0){
                if($this->userCard->where("group_id = ".$groupid." AND uid = ".$this->uid)->delete()){
                    $this->returnAjax("操作成功",1);
                }else{
                    $this->returnAjax("操作失败1",0);
                }
            }else{
                if($this->userCard->where("group_id = ".$groupid." AND uid = ".$this->uid)->setField("pro_num",$num)){

                    $this->returnAjax("操作成功",1);
                }else{
                    $this->returnAjax("操作失败",0);
                }
            }


        }else{
            $this->returnAjax("非法请求",0);
        }

    }

    /**
     * 删除购物车某件商品
     */
    public function  delgoodfromcard(){
        if(IS_POST){
            $cardid=$_POST["cardid"];
           $data= $this->userCard->where("uid = ".$this->uid." AND id = ".$cardid)->find();
           if(empty($data)){
               $this->returnAjax("不存在的购物车",0);
           }
           if($this->userCard->where("uid = ".$this->uid." AND id = ".$cardid)->delete()){
               $this->returnAjax("操作成功",1);
           }else{
               $this->returnAjax("操作失败",0);
           }

        }else{
            $this->returnAjax("非法请求",0);
        }


    }


    /**
     * 清空购物车
     */
    public function  cleargoodcard(){
        if(IS_POST){
            if($this->userCard->where("uid = ".$this->uid)->delete()){
                $this->returnAjax("购物车清空成功",1);
            }else{
                $this->returnAjax("购物车清空失败",0);
            }

        }else{
            $this->returnAjax("非法请求",0);
        }


    }

    /**
     * 购物车点击选中或者去选中
     */
    public function  cardgoodclick(){
        if(IS_POST){
           $selectall=$_POST["all"];
           $select=$_POST["select"];
           if(!in_array($select,array(0,1))){
               $this->returnAjax("非法请求",0);
           }
           if($selectall){
               if($this->userCard->where("uid = ".$this->uid)->setField("selected",$select)){
                   $this->returnAjax("操作成功",1);
               }else{
                   $this->returnAjax("操作失败",0);
               }

           }else{
               $cardid=$_POST["cardid"];
               if($this->userCard->where("uid = ".$this->uid." AND id= ".$cardid)->setField("selected",$select)){
                   $this->returnAjax("操作成功",1);
               }else{
                   $this->returnAjax("操作失败",0);
               }
           }

        }else{
            $this->returnAjax("非法请求",0);
        }

    }

}