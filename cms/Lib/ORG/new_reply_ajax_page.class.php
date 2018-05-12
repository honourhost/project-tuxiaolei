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

	//架构函数
	public function __construct($totalRows,$listRows){
		$this->totalRows = $totalRows;
		$this->nowPage  = !empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
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
		if($total == 1) return false;
		
		$str = '<div class="up_page"><div class="up_page_img"></div>';
		if($now > 1){
			$str .= '<div class="up_page_txt" style="display:block;float:left"><a href="javascript:void(0);" onclick="get_reply_list('.($now-1).')" data-index="1">上一页 &nbsp;&nbsp;</a></div></div>';
		}else{
			$str .= '<div class="up_page_txt" style="display:block;float:left">上一页 &nbsp;&nbsp;</div></div>';
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
					$str .= '<dd style="display:block;float:left"><a href="javascript:void(0);" onclick="get_reply_list('.$page.')" data-index="'.$page.'"> &nbsp;&nbsp;'.$page.' &nbsp;&nbsp;</a></dd>';
				}else{
					break;
				}
			}else{
				if($page == $now) $str .= '<dd class="cur" style="display:block;float:left"><span onclick="get_reply_list('.$page.')" data-index="'.$page.'"> &nbsp;&nbsp;'.$page.'&nbsp;&nbsp; </span></dd>';
			}
		}
		$str .= '<div class="next_page">';
		if ($now != $total){
			$str .= '<div class="next_page_txt" style="display:block;float:left"><a href="javascript:void(0);" onclick="get_reply_list('.($now+1).')" data-index="'.($now+1).'"> &nbsp;&nbsp;下一页</a></div>';
		}else{
			$str .= '<div class="next_page_txt" style="display:block;float:left">&nbsp;&nbsp; 下一页</div>';
		}
		$str .= '<div class="next_page_img"></div><div style="clear:both"></div></div>';
		
		return $str;
    }
}
?>