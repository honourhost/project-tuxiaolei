<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Frontmanag/index')}">商家管理</a>
			</li>
			<li class="active">商家视频管理</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.red{display:inline-block; font-size: 18px;margin-left: 70px;}
				 td,th {text-align: center;}
				.lastimg img{height: 100px;}
				.ke-dialog-row .ke-input-text{height: 35px;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<button class="btn btn-success" onclick="CreateVideo()">新建视频</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="7%">编号</th>
									<th width="7%">排序</th>
									<th width="15%">视频名称</th>
									<th width="25%">视频地址</th>
									<th width="10%">创建时间</th>
									<th style="text-align:center">操作</th>
								</tr>
							</thead>
							<tbody id="tbodyList">
								<if condition="$videos">
									<volist name="videos" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>{pigcms{$vo.id}</td>
											<td>{pigcms{$vo.sort}</td>
											<td>{pigcms{$vo.video_name}</td>
											<td>{pigcms{$vo.video_url}</td>
											<td><php>echo date("Y-m-d H:i:s",$vo['create_time']);</php></td>
											<td><a href="{pigcms{:U('Frontmanag/editvideo',array('id'=>$vo['id']))}">编辑</a> | <a href="{pigcms{:U('Frontmanag/deletevideo',array('id'=>$vo['id']))}">删除</a></td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="11" >无内容</td></tr>
								</if>
							</tbody>
						</table>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
function CreateVideo(){
	window.location.href = "{pigcms{:U('Frontmanag/addvideo')}";
}
</script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>

<include file="Public:footer"/>
