<include file="Public:header"/>
   <style type="text/css">
    .table-list p{font-size: 18px; margin-left: 25px; line-height: 1em;}
	</style>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
					<a href="#" class="on"><span>{pigcms{$mainname}</span> > <span>{pigcms{$subname}</span> >  <span>更新字段执行页面</span></a>
					 | <a href="javascript:history.back();">返回上级目录</a>
			</div>

			
			<table class="search_table" width="100%">
				<tr>
					<td>
					<div style="margin-left: 50px;">
					<span>选择三级分类：</span>&nbsp;&nbsp;
					<select id="select3" style="width: 160px;">
					<option value="0">请选择！</option>
					<if condition="!empty($subdir3)">
					   <volist name="subdir3" id="vo">
						<option value="{pigcms{$vo['cid']}">{pigcms{$vo['cat_name']}</option>
					   </volist>
					</if>
					</select>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="button" onclick="execupdate()">立刻更新</button>
					</div>
					</td>
				</tr>
			</table>
			<div class="table-list">
			<!--<p>每次更新最多<span class="red">1000</span>条，每次请求更新<span class="red">10</span>条总共<span class="red">{pigcms{$param['count']}</span>条。</p>-->
			<p>请选择一个对应的三级分类（也可以不选） 点击立刻更新按钮进行更新。</p>
			</div>

		</div>

<script type="text/javascript">
var totalnum="{pigcms{$param['count']}";
var b64param="{pigcms{$b64param}";
var islock=false;
function execupdate(){
   if(islock){
      alert('还有任务正在执行，请等待执行完！');
	  return false;
   }
  var sub3 = $('#select3').val();
   if(b64param){
      islock=true;
	  $('.table-list').append('<p>正在执行更新，请稍等......</p>');
	  	$.ajax({
			url:"{pigcms{:U('Classify/execupdateing')}",
			type:"post",
			data:{sub3:sub3,pm:b64param},
			dataType:"JSON",
			success:function(ret){
			  $('.table-list').append('<p>这次为您更新了<span class="red">'+ret.cj+'</span>条数据</p>');
			  setTimeout(function(){
			      window.location.href="{pigcms{:U('Classify/updatedata',array('cid'=>$param['cid'],'fcid'=>$param['fcid']))}";
			  },5000);
			}
		});
   }
}
</script>
<include file="Public:footer"/>