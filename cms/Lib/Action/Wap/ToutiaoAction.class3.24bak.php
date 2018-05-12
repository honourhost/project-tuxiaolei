<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/22 0022
 * Time: 13:55
 */
class ToutiaoAction extends BaseAction
{

    public function index()
    {
        $cat_url = strval($_GET["cat_id"]);
        if (empty($cat_url)) {
            $cat_url = "all";
        }
        $this->assign("nowcat",$cat_url);
        $database_adver = D('Adver');
        if($cat_url=="all"){
            //轮播图
            $condition_adver['cat_id'] = 21;
            $adver_list = $database_adver->field(true)->where($condition_adver)->order('`id` DESC')->select();
            foreach ($adver_list as $key=>$value){
                if (!empty($value['pic'])){
                    $adver_list[$key]['pic']= C('config.site_url').'/upload/adver/'.$value['pic'];

                }
            }
            $this->assign("lunbo",$adver_list);

        }

        //顶部推荐
        $condition2_adver['cat_id'] = 24;
        $top_list = $database_adver->field(true)->where($condition2_adver)->order('`id` DESC')->select();
        foreach ($top_list as $key=>$value){
            if (!empty($value['pic'])){
                $top_list[$key]['pic']= C('config.site_url').'/upload/adver/'.$value['pic'];

            }
        }
        $this->assign("toptuijian",$top_list);
      //  echo  json_encode($top_list);die;
        //文章分类查询
        $textCat = M("Text_category");
        $catlist = $textCat->order("sort ASC")->select();
        $this->assign("lists", $catlist);
   //     echo json_encode($catlist);die;
        if ($cat_url != "all") {
            $category = $textCat->where("cat_url='" . $cat_url . "'")->find();
            $text = M("Image_text");
            $where = array(
                "cat_id" => $category['id'],
                "checkone" => 1
            );
            $count = $text->where($where)->count();
            $pagecount = ceil($count / 20);
            $pageone = $text->where($where)->limit(0, 20)->order("dateline DESC")->select();
            foreach ($pageone as $key => $value) {
                $pageone[$key]['cover_pic'] = C('config.site_url') . $pageone[$key]['cover_pic'];

            }
           $this->assign("pagecount",$pagecount);
            $this->assign("content",$pageone);

        }else{
            //查询对应分类下的内容
            $text=M("Image_text");
            $where=array(
                "checkone"=>1
            );
            $count = $text->where($where)->count();
            $pagecount = ceil($count / 20);
            $pageone = $text->where($where)->limit(0, 20)->order("dateline DESC")->select();
            foreach ($pageone as $key => $value) {
                $pageone[$key]['cover_pic'] = C('config.site_url') . $pageone[$key]['cover_pic'];

            }
            $this->assign("pagecount",$pagecount);
            $this->assign("content",$pageone);
         //   echo json_encode($pageone);die;
        }
        $this->display();
    }

    public function nextpage(){
        $page=$_POST["pageIndex"];
        $cat_url=$_POST["cat_id"];
        $textCat = M("Text_category");
        $text=M("Image_text");
        $str="<ul>";
        if ($cat_url != "all") {
            $category = $textCat->where("cat_url='" . $cat_url . "'")->find();
            $where = array(
                "cat_id" => $category['id'],
                "checkone" => 1
            );
            $count = $text->where($where)->count();
            $pagecount = ceil($count / 20);
            if($page<$pagecount){
                $pageone = $text->where($where)->limit($page*20, 20)->order("dateline DESC")->select();
                foreach ($pageone as $key => $value) {
                 $str.="<li>
  <div class=\"new-cen\">
    <div class=\"list-times\">
      <span>";
                    $str.=date("y-m-d h:i:s",$value['dateline']);
                    $str.="</span>
      <label>";
                    $str.=$value["author"];
                    $str.="</label></div>
    <a href=\"";
                    $str.=U('Article/index',array('imid'=>$value['pigcms_id']));
                    $str.="\">
      <div class=\"list-con\">
        <h3 class=\"lf-title\">";
                    $str.=$value["title"];
                    $str.="</h3>
        <span style=\"background-image: url(";
                    $str.=C('config.site_url') . $value['cover_pic'];
                    $str.=");\"></span>
      </div>
    </a>
    <div class=\"clear-both\"></div>
  </div>
</li>";

                }
                $str.="<input name=\"pageIndex\" value=\"";
                $str.=($page+1);
                $str.="\" style=\"display: none;\">";
                $str.="</ul>";
                return $this->ajaxReturn($str);
            }else{
                return $this->ajaxReturn("");
            }




        }else{
            //查询对应分类下的内容
            $text=M("Image_text");
            $where=array(
                "checkone"=>1
            );
            $count = $text->where($where)->count();
            $pagecount = ceil($count / 20);
            if($page<$pagecount){
                $pageone = $text->where($where)->limit($page*20, 20)->order("dateline DESC")->select();
                foreach ($pageone as $key => $value) {
                    $str.="<li>
  <div class=\"new-cen\">
    <div class=\"list-times\">
      <span>";
                    $str.=date("y-m-d h:i:s",$value['dateline']);
                    $str.="</span>
      <label>";
                    $str.=$value["author"];
                    $str.="</label></div>
    <a href=\"";
                    $str.=U('Article/index',array('imid'=>$value['pigcms_id']));
                    $str.="\">
      <div class=\"list-con\">
        <h3 class=\"lf-title\">";
                    $str.=$value["title"];
                    $str.="</h3>
        <span style=\"background-image: url(";
                    $str.=C('config.site_url') . $value['cover_pic'];
                    $str.=");\"></span>
      </div>
    </a>
    <div class=\"clear-both\"></div>
  </div>
</li>";


                }

                $str.="<input name=\"pageIndex\" value=\"";
                $str.=($page+1);
                $str.="\" style=\"display: none;\">";
                $str.="</ul>";
                return $this->ajaxReturn($str);

            }else{
                return $this->ajaxReturn("");
            }


        }
    }

}