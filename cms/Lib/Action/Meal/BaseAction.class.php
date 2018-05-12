<?php

class BaseAction extends CommonAction
{
    protected function _initialize()
    {
		$search_hot_list = D("Search_hot")->get_list(12, 1);//add
        $this->assign("search_hot_list", $search_hot_list);//add
		
        parent::_initialize();
        //按照首字母查询出所有城市信息
        $cities=null;
        $letters=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
        //按照字母顺序查询出所有城市的内容
        $database_area=D("Area");
        foreach($letters as $key=>$val){
            $cities[$val]=$database_area->where(array("first_pinyin"=>$val,"area_type"=>2,"is_open"=>1))->select();
        }
        $this->assign("cities",$cities);
    }
}


?>
