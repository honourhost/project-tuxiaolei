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
        if($_SESSION['areaarr']!="all"){
            $area_idstr=implode(',',$_SESSION['areaarr']);
            $condition_where= "`status`='1' AND merchant_theme_image <> '' AND `area_id` in (".$area_idstr.")";
        }else{
            $condition_where= "`status`='1' AND merchant_theme_image <> ''";
        }
        $condition_field="mer_id,merchant_theme_image,name,person_image";
        $order="reg_time desc";
        import('@.ORG.group_page');
        $count_group = D('Merchant')->where($condition_where)->count();
        $p = new Page($count_group,10,C('config.group_page_val'));
        $farm_list =  D('Merchant')->field($condition_field)->where($condition_where)->order($order)->limit($p->firstRow.','.$p->listRows)->select();

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