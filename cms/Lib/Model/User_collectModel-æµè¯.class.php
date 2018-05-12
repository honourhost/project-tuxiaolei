<?php
/**
 * time 2016.1.7
 * by sunny
 */
class User_collectModel extends Model{
		//根据用户id获取对应的收藏列表
        public function getCollects($type,$uid)
        {
            //如果是商品类型，即特卖和农小店
            if($type=="goods"){
                $condition="collect.type='group_detail' OR collect.type='meal_detail' AND collect.uid=".$uid;
                import('@.ORG.collect_page');
                $count_collect = $this->where($condition)->count();
                //加入页码最大限制，超过最大值返回空
                $req_page=$_GET['p'];
                $max_page=ceil($count_collect/15);
                if($req_page>$max_page){
                    return "";
                }

                $p = new Page($count_collect, 15,"p");
                $Model=new Model();
                $sql="SELECT 1 as type,guc.collect_id,guc.id,g.name,g.old_price,g.price,g.pic as image,g.sale_count as sale_count FROM ". C('DB_PREFIX') ."user_collect guc JOIN " . C('DB_PREFIX') . "group g ON guc.id=g.group_id WHERE guc.type='group_detail' AND guc.uid=".$uid;
                $sql .= ' UNION ALL ';
                $sql.="SELECT 2 as type,muc.collect_id,muc.id,m.name,m.old_price,m.price,m.image as image,m.sell_count as sale_count  FROM ". C('DB_PREFIX') ."user_collect muc JOIN " . C('DB_PREFIX') . "meal m ON muc.id=m.meal_id WHERE muc.type='meal_detail' AND muc.uid=".$uid;
                $sql.= " ORDER BY collect_id DESC LIMIT {$p->firstRow}, {$p->listRows}";
                $collect_list = $Model->query($sql);
                $return['pagebar'] = $p->show();
                //循环根据结果类型区分所取图片类
                $meal_image=new meal_image();
                $group_image=new group_image();
                foreach($collect_list as $k=>$val){
                    if(!empty($val['image'])) {
                        if ($val['type'] == 1) {
                            //说明是特卖类型，则输出第一张图
                            $list_pic=$group_image->get_allImage_by_path($val['image']);
                            $collect_list[$k]['image']=$list_pic[0]['s_image'];

                            $collect_list[$k]['url']=C('config.site_url').'/mobile.php?g=Mobile&c=Group&a=detail&group_id='.$val['id'];
                        } else {
                            //说明是农小店的商品
                            $list_pic=$meal_image->get_image_by_path($val['image'],C('config.site_url'));
                            $collect_list[$k]['image']=$list_pic["s_image"];
                        }
                    }
                }
            }elseif($type=="merchant_id"){
                //如果存在order则按照传来的order排序
                if(!empty($_GET['order'])&&$_GET['order']=="distance"){
                    $order=1;
                }
                //如果是农场
                $condition="collect.type='merchant_id' AND collect.uid=".$uid;
                import('@.ORG.collect_page');
                $count_collect = $this->where($condition)->count();

                //加入页码最大限制，超过最大值返回空
                $req_page=$_GET['p'];
                $max_page=ceil($count_collect/15);
                if($req_page>$max_page){
                    return "";
                }


                $p = new Page($count_collect,15,"p");
                $Model=new Model();
                //如果存在经纬度的Get参数，则计算距离
                if(!empty($_GET['lat'])&&!empty($_GET['long'])) {
                    $x = $_GET['lat'];
                    $y = $_GET['long'];
                    $sql = "SELECT mucres.*,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$x}*PI()/180-ms.`lat`*PI()/180)/2),2)+COS({$x}*PI()/180)*COS(ms.`lat`*PI()/180)*POW(SIN(({$y}*PI()/180-ms.`long`*PI()/180)/2),2)))*1000) AS distance from (SELECT muc.collect_id,m.name,m.phone,m.fans_count,m.merchant_theme_image as image,m.mer_id  FROM " . C('DB_PREFIX')
                        . "user_collect muc LEFT JOIN " . C('DB_PREFIX') . "merchant m ON muc.id=m.mer_id WHERE muc.type='merchant_id' AND muc.uid=" . $uid .
                        ") as mucres LEFT JOIN " . C('DB_PREFIX') . "merchant_store ms ON mucres.mer_id=ms.mer_id WHERE ms.ismain=1";
                    if($order==1){
                        $sql .= " ORDER BY distance ASC LIMIT {$p->firstRow}, {$p->listRows}";
                    }else{
                        $sql .= " ORDER BY collect_id DESC LIMIT {$p->firstRow}, {$p->listRows}";
                    }
                }else {
                    $sql = "SELECT mucres.*,'unknown' as distance from (SELECT muc.collect_id,m.name,m.phone,m.fans_count,m.merchant_theme_image as image,m.mer_id FROM " . C('DB_PREFIX')
                        . "user_collect muc LEFT JOIN " . C('DB_PREFIX') . "merchant m ON muc.id=m.mer_id WHERE muc.type='merchant_id' AND muc.uid=" . $uid .
                        ") as mucres LEFT JOIN " . C('DB_PREFIX') . "merchant_store ms ON mucres.mer_id=ms.mer_id WHERE ms.ismain=1";
                    $sql .= " ORDER BY collect_id DESC LIMIT {$p->firstRow}, {$p->listRows}";
                }
                $collect_list = $Model->query($sql);
                //存在农场主题图则获取到数据
                //图片显示
                    $merchant_image_class = new merchant_image();
                    foreach ($collect_list as $k => $val) {
                        if(!empty($val['image'])) {
                            $collect_list[$k]['image'] = $merchant_image_class->get_image_by_path($val['image']);
                        }
                    }
                $return["pagebar"]=$p->show();
            }elseif($type="activity_detail"){
                //如果是活动
                //暂时没有活动收藏先返回空
                $collect_list="";
            }
            $return['collect_list']=$collect_list;

            return $return;
        }

        public function addCollect($type,$id,$uid){
            $data=array(
                "type"=>$type,
                "id"=>$id,
                "uid"=>$uid
            );
            //先查询看是否已经存在
            $res=$this->where($data)->find();
            if(!empty($res)){
                //如果已经存在则删除收藏
                //删除收藏
                $result=$this->where($data)->delete();
                if($result){
                    return true;
                }else{
                    return false;
                }
            }
            if($this->data($data)->add()){
                return true;
            }else{
                return false;
            }
        }

        public function deleteCollect(){
            $data=array(
                "type"=>$type,
                "id"=>$id,
                "uid"=>$uid
            );
            //先查询看是否已经存在
            $res=$this->where($data)->find();
            if(!empty($res)){
                //如果已经存在则删除收藏
                //删除收藏
                $result=$this->where($data)->delete();
                if($result){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
}
?>