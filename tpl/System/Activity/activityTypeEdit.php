<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Activity/activityTypeEdit')}">
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">类型名称</th>
				<td><input type="text" class="input fl" name="type_name" value="{pigcms{$type.type_name}" size="20" validate="maxlength:20,required:true" tips="活动类型名称"/></td>
				<input type="hidden" value="{pigcms{$id}" name="id"/>
			</tr>
		</table>
		<div class="btn">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<include file="Public:footer"/>