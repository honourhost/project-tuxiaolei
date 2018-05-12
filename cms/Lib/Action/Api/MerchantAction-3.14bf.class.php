<?php
/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/8
 * Time: 13:21
 */
class MerchantAction extends BaseAction{

    //首页顶上轮播的农场
    public function indexBanner(){
        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $condition_where= " AND `area_id` in (".$area_idstr.")";
        }
        //首先查出3个首页推荐的农场(没有农场主题图的先不选)
        if(!empty($condition_where)) {
            $threeTuiMerchant = D("Merchant")->field("mer_id,merchant_theme_image,name")->limit(3)->where("`status`='1' AND merchant_theme_image <> ''" . $condition_where)->order("share_open desc,reg_time desc")->select();
        }else{
            $threeTuiMerchant = D("Merchant")->field("mer_id,merchant_theme_image,name")->limit(3)->where("`status`='1' AND merchant_theme_image <> ''")->order("share_open desc,reg_time desc")->select();
        }
            //转换图片，只转换主题图
        $Merchant_image_class=new Merchant_image();
        foreach($threeTuiMerchant as $k=>$val){
            $pic=$Merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            $threeTuiMerchant[$k]['merchant_theme_image']=$pic;
            $threeTuiMerchant[$k]['url']=$this->getMerchantUrl($val['mer_id']);
        }
        $result=$threeTuiMerchant;
        if(!empty($result)){
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("获取信息失败",0);
        }
    }
    //首页三个最新的农场信息
    public function indexNewest(){
        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $condition_where= "  AND `area_id` in (".$area_idstr.")";
        }
        //首先查出3个首页最新的农场(没有农场主题图的先不选)
        if(!empty($condition_where)) {
            $threeNewMerchant = D("Merchant")->field("mer_id,merchant_theme_image,name")->limit(3)->where("`status`='1' AND merchant_theme_image <> ''" . $condition_where)->order("reg_time desc")->select();
        }else{
            $threeNewMerchant = D("Merchant")->field("mer_id,merchant_theme_image,name")->limit(3)->where("`status`='1' AND merchant_theme_image <> ''")->order("reg_time desc")->select();
        }
        $Merchant_image_class=new Merchant_image();
        foreach($threeNewMerchant as $k=>$val){
            $pic=$Merchant_image_class->get_image_by_path($val['merchant_theme_image']);
            $threeNewMerchant[$k]['merchant_theme_image']=$pic;
            $threeNewMerchant[$k]['url']=$this->getMerchantUrl($val['mer_id']);
        }
        $result=$threeNewMerchant;
        if(!empty($result)){
            $this->returnAjax($result,1);
        }else{
            $this->returnAjax("获取信息失败",0);
        }
    }
    //农场推荐页
    public function index(){
        $lat=$_GET['lat'];
        $long=$_GET['long'];
        if(empty($lat)||empty($long)){
            $this->returnAjax("未获取到经纬度信息",0);
        }
        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $condition_where= "m.`status`='1' AND m.merchant_theme_image <> '' AND m.`area_id` in (".$area_idstr.")";
        }else{
            $condition_where= "m.`status`='1' AND m.merchant_theme_image <> ''";
        }
        $condition_field="m.mer_id,m.name,m.phone,m.person_name,m.person_image,m.person_info,m.fans_count,m.merchant_theme_image,ROUND(6378.138 * 2 * ASIN(SQRT(POW(SIN(({$lat}*PI()/180-`ms`.`lat`*PI()/180)/2),2)+COS({$lat}*PI()/180)*COS(`ms`.`lat`*PI()/180)*POW(SIN(({$long}*PI()/180-`ms`.`long`*PI()/180)/2),2)))*1000) AS distance";
        $order="reg_time desc";
        import('@.ORG.group_page');
        $count_group = D('Merchant')->alias("m")->where($condition_where)->count();
        //加入页码最大限制，超过最大值返回空
            $req_page=$_GET['p'];
            $max_page=ceil($count_group/15);
            if($req_page>$max_page){
                $this->returnAjax("没有更多数据了",0);
            }

        $p = new Page($count_group,15,'p');

        $farm_list =  D('Merchant')->alias("m")->field($condition_field)->join(C("DB_PREFIX")."merchant_store ms ON m.mer_id=ms.mer_id")->where($condition_where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();

        $return['pagebar'] = $p->show();

        if($farm_list){
            $merchant_image_class = new merchant_image();
            foreach ($farm_list as $key => $val) {
                if (!empty($val['person_image'])) {
                    $farm_list[$key]["person_image"] = $merchant_image_class->get_image_by_path($val['person_image']);
                }
                if (!empty($val['merchant_theme_image'])) {
                    $farm_list[$key]["merchant_theme_image"] = $merchant_image_class->get_image_by_path($val['merchant_theme_image']);
                }
                $farm_list[$key]['url']=$this->getMerchantUrl($val['mer_id']);
            }
        }
        if(!empty($farm_list)){
            $this->returnAjax($farm_list,1);
        }else{
            $this->returnAjax("获取信息失败",0);
        }
    }
    //获取农场url
    private function getMerchantUrl($mer_id){
        return C('config.site_url').'/mobile.php?g=Mobile&c=Merchant&a=detail&mer_id='.$mer_id;
    }
}