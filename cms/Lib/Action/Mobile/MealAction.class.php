<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/11
 * Time: 16:34
 */
class MealAction extends BaseAction{
    public function index(){
        //根据获取的特卖id获取当前特卖详情
        $_GET["meal_id"]=261;
        //现在的团购
        if(empty($_GET['meal_id'])){
            $this->error("未获取到农小店商品id");
        }
        $now_meal = D('Meal')->where(array("meal_id"=>$_GET['meal_id'],"status"=>1))->select();
        print_r($now_meal);
    }
}