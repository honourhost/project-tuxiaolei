<include file="Public:header"/>
	<form id="myform" method="post" action="{pigcms{:U('Appslider/slider_modify')}" enctype="multipart/form-data">
		<input type="hidden" name="cat_id" value="{pigcms{$now_category.cat_id}"/>
		<table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
			<tr>
				<th width="80">名称</th>
				<td><input type="text" class="input fl" name="name" size="20" placeholder="请输入名称" validate="maxlength:20,required:true"/></td>
			</tr>
			<tr>
				<th width="80">描述</th>
				<td><input type="text" class="input fl" name="desc" size="60" placeholder="请输入描述（可不填）" validate="maxlength:60"/></td>
			</tr>
			<tr>
				<th width="80">图片</th>
				<td><input type="file" class="input fl" name="pic" style="width:180px;" placeholder="请上传图片" tips="可不上传"/></td>
			</tr>
			<tr>
				<th width="80">链接地址</th>
				<td>
				<input type="text" class="input fl" name="url" id="url" style="width:180px;" placeholder="请填写链接地址" />
				<if condition="$now_category['cat_id'] neq 1">
				<a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url',0)" data-toggle="modal">从功能库选择</a>
				</if>
				</td>
			</tr>

            <tr>
                <th width="80">原生APP地址/ID</th>
                <td>
                    <input type="text" class="input fl" name="url_id" id="url_id"  style="width:200px;" placeholder="请填写链接地址id" />
                    <if condition="$now_category['cat_id'] neq 1">
                        <a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url_id',0)" data-toggle="modal">从功能库选择</a>
                    </if>
                </td>
            </tr>
			<tr>
				<th width="80">排序</th>
				<td><input type="text" class="input fl" name="sort" style="width:80px;" value="0" validate="maxlength:10,required:true,number:true"/></td>
			</tr>
			<if condition="$_SESSION['system']['area_id'] eq 0">
			<tr>
				<th width="80">使用地区id</th>
				<td><input type="text" class="input fl" name="area_id" style="width:80px;" value="0" validate="maxlength:10,required:true,number:true" tips="自行查看区域管理中的id,并填写"/></td>
			</tr>
				</if>
			<tr>
				<th width="80">是否显示网页</th>
				<td><input type="text" class="input fl" name="flag" style="width:80px;" value="0" validate="maxlength:10,required:true,number:true" tips="默认0为显示，1为不是显示"/></td>
			</tr>
			<tr>
				<th width="80">状态</th>
				<td>
					<span class="cb-enable"><label class="cb-enable selected"><span>启用</span><input type="radio" name="status" value="1" checked="checked" /></label></span>
					<span class="cb-disable"><label class="cb-disable"><span>关闭</span><input type="radio" name="status" value="0" /></label></span>
				</td>
			</tr>
		</table>
		<div class="btn hidden">
			<input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
			<input type="reset" value="取消" class="button" />
		</div>
	</form>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script>
function addLink(domid,iskeyword){
	art.dialog.data('domid', domid);
	art.dialog.open('?g=Admin&c=Link&a=insert&iskeyword='+iskeyword,{lock:true,title:'插入链接或关键词',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.45});
}
</script>
<include file="Public:footer"/>