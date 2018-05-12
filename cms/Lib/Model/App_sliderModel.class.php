<?php
class App_sliderModel extends Model{

	public function getList($cat_id,$area_id){
         $condition_where=array(
                    "cat_id"=>$cat_id,
                    "area_id"=>$area_id,
                    "status"=>1
              );
        $app_spider=M("App_slider");
        $result=$app_spider->where($condition_where)->order("sort DESC")->select();
        if(!empty($result)){
            foreach($result as $key=>$val){
            if(!empty($val['pic'])){
                $result[$key]['pic']=C('config.site_url')."/upload/appslider/".$val['pic'];
            }
        }
            return $result;
        }else{
        	return "";
        }
	}
}