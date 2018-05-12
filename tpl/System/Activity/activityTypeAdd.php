<include file="Public:header"/>
<h1>活动类型添加</h1>
	<form id="myform" method="post" action="{pigcms{:U('Activity/activityTypeAdd')}">
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">类型名称</th>
				<td><input type="text" class="input fl" name="type_name" size="20" validate="maxlength:20,required:true" tips="活动类型名称"/></td>
			</tr>
		</table>
		<div class="btn">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>