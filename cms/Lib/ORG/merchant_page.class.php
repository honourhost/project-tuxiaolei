<?php
class Page{
	// 起始行数
    public $firstRow;
	//现在页数
	public $nowPage;
	//总页数
	public $totalPage;
	//总行数
	public $totalRows;
	//分页的条数
	public $page_rows;
	//架构函数
	public function __construct($totalRows,$listRows){
		$this->totalRows = $totalRows;
		$this->nowPage  = !empty($_GET['page']) ? intval($_GET['page']) : 1;
		$this->listRows = $listRows;
		$this->totalPage = ceil($totalRows/$listRows);
		if($this->nowPage > $this->totalPage && $this->totalPage>0){
			$this->nowPage = $this->totalPage;
		}
		$this->firstRow = $listRows*($this->nowPage-1);
	}
    public function show(){
		if($this->totalRows == 0) return false;
		$now = $this->nowPage;
		$total = $this->totalPage;
		
		$url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?");
        $parse = parse_url($url);
        if(isset($parse['query'])) {
            parse_str($parse['query'],$params);
            unset($params['page']);
            $url   =  $parse['path'].'?'.http_build_query($params);
        }
		$url .= '&page=';
		
		$str = '<div class="summary">'.$this->totalRows.' 条记录 '.$now.'/'.$total.'页</div>';
		$str.= '<div class="pager">';
		$str.= '<ul class="pagination" id="yw1">';
		
		if($now > 1){

			$str .= '<li class="prev"><a href="'.$url.($now-1).'"><i class="ace-icon fa fa-angle-double-left"></i></a></li>';
		}

		$str .='<li class="page"><a href="'.$url.(1).'" title="第一页">首页</a></li>';
		if($this->totalRows>3){
			//如果页码数大于3页则加入跳转页码
			$str.='<li class="page"><input type="text" size="10" placeholder="填页码数" id="jump_page"/></li>';
		}
		if($now!=1 && $now>4 && $total>6){
			$str .= '<li class="page"> … </li>';
		}
		for($i=1;$i<=5;$i++){
			if($now <= 1){
				$page = $i;
			}elseif($now > $total-1){
				$page = $total-5+$i;
			}else{
				$page = $now-3+$i;
			}
			if($page != $now  && $page>0){
				if($page<=$total){
					$str .= '<li class="page"><a href="'.$url.$page.'" title="第'.$page.'页">'.$page.'</a></li>';
				}else{
					break;
				}
			}else{
				if($page == $now) $str .= '<li class="page active"><a href="'.$url.$page.'" title="第'.$page.'页">'.$page.'</a></li>';
			}
		}
		if($total != $now && $now<$total-5 && $total>10){
			$str .= '<li class="page"> … </li><li><a href="'.$url.$total.'" title="第'.$total.'页">'.$total.'</a></li>';
		}
		
		$str .='<li class="page"><a href="'.$url.($total).'" title="最后一页">末页</a></li>';
		if($this->totalRows>3){
			//如果页码数大于3页则加入跳转页码
			$str.='<li><a onclick="jump();">跳转</a></li>';
		}
		if ($now != $total){
			$str .= '<li class="next"><a href="'.$url.($now+1).'"><i class="ace-icon fa fa-angle-double-right"></i></a></li>';
		}
		
		$str .= '</ul>';
		$str .= '</div>';
		if($this->totalRows>3){
			//如果页码数大于3页则加入跳转页码
			$str.='<script>function jump(){
				var jump_page=$("#jump_page").val();
				if(jump_page==""){
					alert("请先填写页码");
					return;
				}
				var current_url=window.location.href;
				//如果url存在page参数则截取至页码再加上，如果本身不存在则直接加上
				var flag=current_url.indexOf("&page");

				if(flag!=-1){
					var new_url=current_url.substring(0,flag);
				}else{
					var new_url=current_url;
				}
				window.location.href=new_url+"&page="+jump_page;
			}</script>';
		}
		return $str;
    }
}
?>