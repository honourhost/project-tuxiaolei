<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-file-excel-o"></i>
				<a href="{pigcms{:U('Media/index')}">多媒体管理</a>
			</li>
			<li>文件列表</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<div>
						<a href="{pigcms{:U('Media/one')}" class="btn btn-success">上传视频</a>　
						<a href="{pigcms{:U('Media/multi')}" class="btn btn-success">上传音频</a>
					</div>
					<div id="shopList" class="grid-view">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th id="shopList_c1" width="100">标题</th>
									<th id="shopList_c1" width="100">创建时间</th>
									<th id="shopList_c11" width="180">操作</th>
								</tr>
							</thead>
							<tbody>
								<if condition="$list">
									<volist name="list" id="vo">
										<tr class="<if condition="$i%2 eq 0">odd<else/>even</if>">
											<td>

											<p>{pigcms{$vo.title}</p>

											</td>
											<td>{pigcms{$vo.dateline}</td>
											<td class="button-column" nowrap="nowrap">

												<a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U('Media/one',array('pigcms_id'=>$vo['pigcms_id']))}">
													<i class="ace-icon fa fa-pencil bigger-130"></i>
												</a>

												<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Media/del_image',array('pigcms_id'=>$vo['pigcms_id']))}">
													<i class="ace-icon fa fa-trash-o bigger-130"></i>
												</a>
												<a href="{pigcms{$config['site_url']}/wap.php?c=Media&a=index&imid={pigcms{$row['pigcms_id']}" target="_blank">预览</a>
											</td>
										</tr>
									</volist>
								<else/>
									<tr class="odd"><td class="button-column" colspan="3" >无内容</td></tr>
								</if>
							</tbody>
						</table>
						{pigcms{$page}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{pigcms{:C('JQUERY_FILE')}"></script>
<script src="{pigcms{$static_public}js/jquery.qrcode.min.js"></script>
<script src="{pigcms{$static_path}layer/layer.m.js"></script>
<script>
	$(function(){

		$('.see_article_qrcode').click(function(){
			var qrcode_width = $(window).width()*0.6 > 256 ? 256 : $(window).width()*0.6;
			var href=$(this).attr("href");
			layer.open({
				title:['预览二维码','background-color:#8DCE16;color:#fff;'],
				content:'预览在微信中的效果！<br/><br/><div id="qrcode"></div>',
				success:function(){
					$('#qrcode').qrcode({
						width:qrcode_width,
						height:qrcode_width,
						text:href
					});
				}
			});
			$('.layermbox0 .layermchild').css({width:qrcode_width+30+'px','max-width':qrcode_width+30+'px'});

		});
	});
</script>
<script type="text/javascript">
$(function(){
	jQuery(document).on('click','#shopList a.red',function(){
		if(!confirm('确定要删除这条数据吗?不可恢复。')) return false;
	});
});
</script>
<include file="Public:footer"/>
