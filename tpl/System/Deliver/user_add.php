<include file="Public:header"/>
<style>

</style>
	<form id="myform" method="post" action="{pigcms{:U('Deliver/user_add')}" frame="true" refresh="true">
		<input type="hidden" name="uid" value="{pigcms{$now_user.uid}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="15%">姓名</th>
				<td width="35%"><input type="text" class="input fl" name="name" size="20" validate="maxlength:50,required:true" value="{pigcms{$now_user.nickname}"/></td>
				<th width="15%">手机号</th>
				<td width="35%"><input type="text" class="input fl" name="phone" size="20" validate="mobile:true,required:true" value="{pigcms{$now_user.phone}"/></td>
			</tr>
			<tr>
				<th width="15%">密码</th>
				<td width="35%"><input type="text" class="input fl" name="pwd" size="20" value="123456" tips="不修改则不填写" validate="required:true"/></td>
				<th width="15%">状态</th>
				<td width="35%" class="radio_box">
					<span class="cb-enable"><label class="cb-enable <if condition="$now_user['status'] eq 1">selected</if>"><span>正常</span><input type="radio" name="status" value="1"  <if condition="$now_user['status'] eq 1">checked="checked"</if>/></label></span>
					<span class="cb-disable"><label class="cb-disable <if condition="$now_user['status'] eq 0">selected</if>"><span>禁止</span><input type="radio" name="status" value="0"  <if condition="$now_user['status'] eq 0">checked="checked"</if>/></label></span>
				</td>
			</tr>
			<tr>
			 	<th width="15%">所在地</th>
				<td id="choose_cityarea" colspan=3></td>
			<tr>
			<tr>
				<th width="15%">配送范围</th>
				<td colspan=3><input type="text" class="input fl" name="range" size="20" validate="required:true" value="5"/>公里</td>
			<tr>
			</tr>
			<tr>
				<th width="15%">配送员常驻地区</th>
				<td width="35%"><input type="text" class="input fl" readonly="readonly" name="adress" id="adress" validate="required:true"/></td>
				<th width="15%">配送员经纬度</th>
				<td width="35%" class="radio_box"><input class="input fl" size="20" name="long_lat" id="long_lat" type="text" readonly="readonly" validate="required:true"/></td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
	<div id="modal-table" class="modal fade" tabindex="-1" style="display:block;">
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content" style="width:100%;">
				<div class="modal-header no-padding" style="width:100%;">
					<div class="table-header">
						   拖动红色图标，经纬度框内将自动填充经纬度。
					</div>
				</div>
				<div class="modal-body no-padding" style="width:100%;">
					<form id="map-search" style="margin:10px;">
						<input id="map-keyword" type="textbox" style="width:300px;" placeholder="尽量填写城市、区域、街道名"/>
						<input type="submit" value="搜索"/>
					</form>
					<div style="width: 650px; height: 300px; min-height: 300px;" id="cmmap"></div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	var static_public="{pigcms{$static_public}",static_path="{pigcms{$static_path}",merchant_index="{pigcms{:U('Index/index')}",choose_province="{pigcms{:U('Area/ajax_province')}",choose_city="{pigcms{:U('Area/ajax_city')}",choose_area="{pigcms{:U('Area/ajax_area')}",choose_circle="{pigcms{:U('Area/ajax_circle')}";
	</script>
	<script type="text/javascript" src="{pigcms{$static_path}js/area.js"></script>
	<script type="text/javascript" src="{pigcms{$static_path}js/map.js"></script>
<include file="Public:footer"/>