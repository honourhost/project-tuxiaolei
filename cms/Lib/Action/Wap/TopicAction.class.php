<?php

class TopicAction extends BaseAction{
	public function gansu(){
		$this->display();
	}

	public function index(){
		//获取主题
		$topic=strval($_GET['topic']);
		$chan_where=array(
			"url"=>$topic,
			"status"=>1
			);
		//查询频道名称
		$channel=D("Channel")->where($chan_where)->find();
		//查询频道下分类
		$cat_where=array(
			"c_id"=>$channel['id'],
			"status"=>1
			);
		$categories=D("Channel_category")->where($cat_where)->order("sort desc")->select();
		//查询当前频道下的轮播图
		$banner_where=array(
			"c_id"=>$channel['id'],
			"status"=>1
			);
		$banners=D("Channel_banner")->where($banner_where)->order("sort desc")->select();
		$this->assign("banners",$banners);
		//查询对应分类下商品放到common方法中
		$this->assign("channel",$channel);
		$this->assign("categories",$categories);
		$this->display($channel['templatename']);
		
	}
	
		public function getCatGoods(){
        //获取主题
        $topic=strval($_GET['topic']);
        $chan_where=array(
            "url"=>$topic,
            "status"=>1
        );
        //查询频道名称
        $channel=D("Channel")->where($chan_where)->find();
		//echo json_encode($this->getCatGoodsLists($channel['id']));
		$this->assign("channel",$channel);
		$this->assign("goods",$this->getCatGoodsLists($channel['id']));
		$this->display();
      
 

    }
			public function getCatGoods2(){
        //获取主题
        $topic=strval($_GET['topic']);
        $chan_where=array(
            "url"=>$topic,
            "status"=>1
        );
        //查询频道名称
        $channel=D("Channel")->where($chan_where)->find();
		//echo json_encode($this->getCatGoodsLists($channel['id']));
		$this->assign("channel",$channel);
		$this->assign("goods",$this->getCatGoodsLists2($channel['id']));
	//	$this->display();
      
 

    }
	
		function getCatGoodsLists($id){
    if(!empty($id)){
        $goods=D("Channel_category_goods")->where("c_id=".$id)->select();
        $goods=array_filter($goods);
        if(!empty($goods)){
            foreach($goods as $key=>$val){
                $list[]=D('Group')->get_group_by_groupId($val['goods_id']);
            }
	
 
   	return  $this->my_sort($list,"group_id",SORT_DESC,SORT_NUMERIC);
        }else{
            return "";
        }
    }else{
        return "";
    }
}
	
	function getCatGoodsLists2($id){
    if(!empty($id)){
        $goods=D("Channel_category_goods")->where("c_id=".$id)->select();
        $goods=array_filter($goods);
	
        if(!empty($goods)){
            foreach($goods as $key=>$val){
                $list[]=D('Group')->get_group_by_groupId($val['goods_id']);
            }
			foreach($list as $adam){
				
			}
	
	return  $this->my_sort($list,"group_id",SORT_DESC,SORT_NUMERIC);
 
  
        }else{
            return "";
        }
    }else{
        return "";
    }
}

   function my_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC ){   
        if(is_array($arrays)){   
            foreach ($arrays as $array){   
                if(is_array($array)){   
                    $key_arrays[] = $array[$sort_key];   
                }else{ 
			          echo "123456";
                    return false;   
                }   
            }   
        }else{   
		 
            return false;   
        }  
        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);   
        return $arrays;   
    } 
	
	  //特卖搜索
    public function search(){
        //判断分类信息
        $cat_url = !empty($_GET['cat_url']) ? $_GET['cat_url'] : '';
        //根据分类信息获取分类
        if(!empty($cat_url)){
            $now_category = D('Group_category')->get_category_by_catUrl($cat_url);
            if(empty($now_category)){
                $this->error_tips('此分类不存在！');
            }
            $this->assign('now_category',$now_category);
            
            if(!empty($now_category['cat_fid'])){
                $f_category = D('Group_category')->get_category_by_id($now_category['cat_fid']);
                $all_category_url = $f_category['cat_url'];
                $category_cat_field = $f_category['cat_field'];
            
                $top_category = $f_category;
                $this->assign('top_category',$f_category);
            
                $get_grouplist_catfid = 0;
                $get_grouplist_catid = $now_category['cat_id'];
            }else{
                $all_category_url = $now_category['cat_url'];
                $category_cat_field = $now_category['cat_field'];
                $top_category = $now_category;
                $this->assign('top_category',$now_category);
            
                $get_grouplist_catfid = $now_category['cat_id'];
                $get_grouplist_catid = 0;
        }
        }
        $result=D('Group')->wap_get_group_list_by_catid($get_grouplist_catid,$get_grouplist_catfid,$area_id,$sort_id, $long_lat['lat'], $long_lat['long'], $circle_id);
        //print_r($result);
        if(!empty($result)){
            $this->assign("list",$result['group_list']);
            $this->display();
        }else{
            $this->display();
        }
    }

}