<include file="Public:header"/>
   <style type="text/css">
    .table-list p{font-size: 18px; margin-left: 25px; line-height: 1em;}
	</style>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
			 <a href="javascript:;">生成网站地图</a>
			</div>

			
			<table class="search_table" width="100%">
				<tr>
					<td>
					<div style="margin-left: 50px;">
					<span>生成网站地图</span>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="button" onclick="exeGenerate()">立刻生成</button>
					</div>
					</td>
				</tr>
			</table>
			<div class="table-list">
			<p>生成可能需要较长时间，请不要关闭窗口，静静等待！</p>
			</div>

		</div>

<script type="text/javascript">
var islock=false;
function exeGenerate(){
   if(islock){
      alert('正在执行生成万丈地图，请勿重复点击！');
	  return false;
   }
      islock=true;
	  $('.table-list').append('<p>正在执行生成，请稍等......</p>');
	  	$.ajax({
			url:"{pigcms{:U('Index/exeGenerate')}",
			type:"post",
			data:{pam:'嘿嘿！'},
			dataType:"JSON",
			success:function(ret){
			   ret.error=parseInt(ret.error);
			   islock=false;
			  if(!ret.error){
			    $('.table-list').append('<p>'+ret.msg+'&nbsp;&nbsp;&nbsp;<a href="{pigcms{$config.site_url}/{pigcms{$xmlfilepath}" target="_blank" style="color:#1083F2;">访问文件</a></p>');
			  }else{
			     $('.table-list').append('<p>'+ret.msg+'</p>');
				 alert(ret.msg);
			  }
			  /*setTimeout(function(){
			      window.location.href="";
			  },5000);*/
			}
		});
}
</script>
<include file="Public:footer"/>