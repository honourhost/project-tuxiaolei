<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="#">商户入驻</a>
			</li>
			<li class="active">入驻申请</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
							.ace-file-input a {
								display: none;
							}
							.sc-zhao{
								height: 150px;
							}
							.sc-zhao-left{
								float: left;
								width: 600px;
							}
							
							.sc-zhao-img{
								height: auto;
								margin-left: 20px;
								float: left;
								width: 170px;
								text-align: center;
							}
							.sc-zhao-img img{
								width: 170px;
							}
							.sc-zhao-img span{
								display: block;
								width: 100%;
								text-align: center;
								color: #FF0000;
								font-size: 14px;
							}
						</style>
			<div class="row">
				<div class="col-xs-12">
								<form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form">
									<div class="tab-content">
										<div class="tabbable">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#basicinfo">公司入驻申请</a>
												</li>
												<li>
													<a data-toggle="tab" href="#txtstore">个人入驻申请</a>
												</li>
												
											</ul>
										</div>
										<div style="width: 100%; height: 20px;"></div>
										<div id="basicinfo" class="tab-pane active">
											<div class="form-group">
												<label class="col-sm-1">
													<label>公司名称</label>
												</label>
												<input class="col-sm-2" size="20" value="" type="text" name="person_name" />
											</div>
											<div class="form-group">
												<label class="col-sm-1">公司简介</label>
												<textarea class="col-sm-5" rows="5" name="person_info"></textarea>
											</div>
											<div class="form-group">
												<label class="col-sm-1">
													<label>营业执照号</label>
												</label>
												<input class="col-sm-2" size="20" value="" type="text" name="person_name" />
											</div>
											<div class="form-group sc-zhao">
												<label class="col-sm-1">上传营业执照</label>
												<div class="sc-zhao-left">
												<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage">上传图片</a>
												<span class="form_tips">上传营业执照请保持字体清晰 大小不超过1M，请参考右侧示例</span>
												</div>
												<div class="sc-zhao-img">
													<img src="http://demo.xiaonongding.com/xnd/img/zhao.jpg">
														<span>(营业执照示例)</span>
												</div>
												
											</div>
											<div style="clear: both;"></div>
											<div class="form-group">
												<label class="col-sm-1">图片预览</label>
												<div id="upload_pic_box">
													<ul id="upload_pic_ul">
														<li class="upload_pic_li"><img src="http://www.xiaonongding.com/upload/merchant/000/000/583/56726748c4933.jpg"/><input type="hidden" name="pic[]" value="000/000/583,56726748c4933.jpg"/><br/><a href="#" onclick="deleteImage('000/000/583,56726748c4933.jpg',this);return false;">[ 删除 ]</a></li>										</ul>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-1">
													<label>法人代表</label>
												</label>
												<input class="col-sm-2" size="20" value="" type="text" name="person_name" />
												<span class="form_tips">必须与公司营业执照一致</span>
											</div>
											<div class="form-group">
												<label class="col-sm-1">
													<label>法人身份证</label>
												</label>
												<input class="col-sm-2" size="20" value="" type="text" name="person_name" />
											</div>
											<div class="form-group sc-zhao">
												<label class="col-sm-1">身份证正反面</label>
												<div class="sc-zhao-left">
													<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage2">上传图片</a>
													<span class="form_tips">身份证照片为正反两面扫描件，须字体清晰，合并到一张图片上传即可，如右图所示</span>
												</div>
												<div class="sc-zhao-img">
											      <img src="http://demo.24so.com/xnd/img/shenfezheng.jpg">
											      <span>(身份证拍照示例)</span>
												</div>
											</div>
											<div style="clear: both;"></div>
											<div class="form-group">
												<label class="col-sm-1">图片预览</label>
												<div id="upload_pic_box">
													<ul id="upload_pic_ul2">
														<li class="upload_pic_li"><img src="http://www.xiaonongding.com/upload/merchant/000/000/583/56726748c4933.jpg"/><input type="hidden" name="pic[]" value="000/000/583,56726748c4933.jpg"/><br/><a href="#" onclick="deleteImage('000/000/583,56726748c4933.jpg',this);return false;">[ 删除 ]</a></li>										</ul>
												</div>
											</div>
											<div class="form-group sc-zhao">
												<label class="col-sm-1">手持身份证照</label>
												<div class="sc-zhao-left">
													<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage2">上传图片</a>
													<span class="form_tips">个人手持身份证拍照，如右图所示需要五官清楚，身份证上面的文字清楚</span>
												</div>
												<div class="sc-zhao-img">
											      <img src="http://demo.24so.com/xnd/img/my.jpg">
											      <span>(身份证拍照示例)</span>
												</div>
											</div>
											<div style="clear: both;"></div>
											<div class="form-group">
												<label class="col-sm-1">图片预览</label>
												<div id="upload_pic_box">
													<ul id="upload_pic_ul2">
														<li class="upload_pic_li"><img src="http://www.xiaonongding.com/upload/merchant/000/000/583/56726748c4933.jpg"/><input type="hidden" name="pic[]" value="000/000/583,56726748c4933.jpg"/><br/><a href="#" onclick="deleteImage('000/000/583,56726748c4933.jpg',this);return false;">[ 删除 ]</a></li>										</ul>
												</div>
											</div>
										</div>
										<div id="txtstore" class="tab-pane">
											<div class="form-group">
												<label class="col-sm-1">
													<label>农场主名称</label>
												</label>
												<input class="col-sm-2" size="20" value="" type="text" name="person_name" />
											</div>
											<div class="form-group">
												<label class="col-sm-1">
													<label>身份证号</label>
												</label>
												<input class="col-sm-2" size="20" value="" type="text" name="person_name" />
											</div>
											<div class="form-group sc-zhao">
												<label class="col-sm-1">身份证正反面</label>
												<div class="sc-zhao-left">
													<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage2">上传图片</a>
													<span class="form_tips">身份证照片为正反两面扫描件，须字体清晰，合并到一张图片上传即可，如右图所示</span>
												</div>
												<div class="sc-zhao-img">
											      <img src="http://demo.24so.com/xnd/img/shenfezheng.jpg">
											      <span>(身份证拍照示例)</span>
												</div>
											</div>
											<div style="clear: both;"></div>
											<div class="form-group">
												<label class="col-sm-1">图片预览</label>
												<div id="upload_pic_box">
													<ul id="upload_pic_ul2">
														<li class="upload_pic_li"><img src="http://www.xiaonongding.com/upload/merchant/000/000/583/56726748c4933.jpg"/><input type="hidden" name="pic[]" value="000/000/583,56726748c4933.jpg"/><br/><a href="#" onclick="deleteImage('000/000/583,56726748c4933.jpg',this);return false;">[ 删除 ]</a></li>										</ul>
												</div>
											</div>
											<div class="form-group sc-zhao">
												<label class="col-sm-1">手持身份证照</label>
												<div class="sc-zhao-left">
													<a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectImage2">上传图片</a>
													<span class="form_tips">个人手持身份证拍照，如右图所示需要五官清楚，身份证上面的文字清楚</span>
												</div>
												<div class="sc-zhao-img">
											      <img src="http://demo.24so.com/xnd/img/my.jpg">
											      <span>(身份证拍照示例)</span>
												</div>
											</div>
											<div style="clear: both;"></div>
											<div class="form-group">
												<label class="col-sm-1">图片预览</label>
												<div id="upload_pic_box">
													<ul id="upload_pic_ul2">
														<li class="upload_pic_li"><img src="http://www.xiaonongding.com/upload/merchant/000/000/583/56726748c4933.jpg"/><input type="hidden" name="pic[]" value="000/000/583,56726748c4933.jpg"/><br/><a href="#" onclick="deleteImage('000/000/583,56726748c4933.jpg',this);return false;">[ 删除 ]</a></li>										</ul>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-1">个人农场简介</label>
												<textarea class="col-sm-5" rows="5" name="person_info"></textarea>
											</div>
										</div>
										<div class="clearfix form-actions">
											<div class="col-md-offset-3 col-md-9">
												<button class="btn btn-info" type="submit">
													<i class="ace-icon fa fa-check bigger-110"></i> 提交申请
												</button>
											</div>
										</div>
								</form>
								
								</div>
							</div>
			</div>
		</div>
	</div>
</div>
<style>
.col-sm-2{width: 465px;}
input.ke-input-text {
background-color: #FFFFFF;
background-color: #FFFFFF!important;
font-family: "sans serif",tahoma,verdana,helvetica;
font-size: 12px;
line-height: 24px;
height: 24px;
padding: 2px 4px;
border-color: #848484 #E0E0E0 #E0E0E0 #848484;
border-style: solid;
border-width: 1px;
display: -moz-inline-stack;
display: inline-block;
vertical-align: middle;
zoom: 1;
}
.form-group>label{font-size:12px;line-height:24px;}
#upload_pic_box{margin-top:20px;height:150px;}
#upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
#upload_pic_box img{width:100px;height:70px;}

.small_btn{
margin-left: 10px;
padding: 6px 8px;
cursor: pointer;
display: inline-block;
text-align: center;
line-height: 1;
letter-spacing: 2px;
font-family: Tahoma, Arial/9!important;
width: auto;
overflow: visible;
color: #333;
border: solid 1px #999;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
background: #DDD;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFF', endColorstr='#DDDDDD');
background: linear-gradient(top, #FFF, #DDD);
background: -moz-linear-gradient(top, #FFF, #DDD);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FFF), to(#DDD));
text-shadow: 0px 1px 1px rgba(255, 255, 255, 1);
box-shadow: 0 1px 0 rgba(255, 255, 255, .7), 0 -1px 0 rgba(0, 0, 0, .09);
-moz-transition: -moz-box-shadow linear .2s;
-webkit-transition: -webkit-box-shadow linear .2s;
transition: box-shadow linear .2s;
outline: 0;
}
.small_btn:active{
border-color: #1c6a9e;
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#33bbee', endColorstr='#2288cc');
background: linear-gradient(top, #33bbee, #2288cc);
background: -moz-linear-gradient(top, #33bbee, #2288cc);
background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#33bbee), to(#2288cc));
}
</style>
<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
KindEditor.ready(function(K){
	var editor = K.editor({
		allowFileManager : true
	});
	K('#J_selectImage').click(function(){
		if($('.upload_pic_li').size() >= 10){
			alert('最多上传10个图片！');
			return false;
		}
		editor.uploadJson = "{pigcms{:U('Config/ajax_upload_pic')}";
		editor.loadPlugin('image', function(){
			editor.plugin.imageDialog({
				showRemote : false,
				imageUrl : K('#course_pic').val(),
				clickFn : function(url, title, width, height, border, align) {
					$('#upload_pic_ul').append('<li class="upload_pic_li"><img src="'+url+'"/><input type="hidden" name="pic[]" value="'+title+'"/><br/><a href="#" onclick="deleteImage(\''+title+'\',this);return false;">[ 删除 ]</a></li>');
					editor.hideDialog();
				}
			});
		});
	});
	
	$('#edit_form').submit(function(){
		$.post("{pigcms{:U('Config/merchant')}",$('#edit_form').serialize(),function(result){
			if(result.status == 1){
				alert(result.info);
				window.location.href = "{pigcms{:U('Config/merchant')}";
			}else{
				alert(result.info);
			}
		})
		return false;
	});
	
	$('#indexsort_edit_btn').click(function(){
		$(this).prop('disabled',true).html('提交中...');
		$.post("{pigcms{:U('Config/merchant_indexsort')}",{group_indexsort:$('#group_indexsort').val(),indexsort_groupid:$('#indexsort_groupid').val()},function(result){
			alert('处理完成！正在刷新页面。');
			window.location.href = window.location.href;
		});
	});
});
function deleteImage(path,obj){
	$.post("{pigcms{:U('Config/ajax_del_pic')}",{path:path});
	$(obj).closest('.upload_pic_li').remove();
}
</script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<script type="text/javascript">
	$(function(){
		$('.see_qrcode').click(function(){
			art.dialog.open($(this).attr('href'),{
				init: function(){
					var iframe = this.iframe.contentWindow;
					window.top.art.dialog.data('iframe_handle',iframe);
				},
				id: 'handle',
				title:'查看渠道二维码',
				padding: 0,
				width: 430,
				height: 433,
				lock: true,
				resize: false,
				background:'black',
				button: null,
				fixed: false,
				close: null,
				left: '50%',
				top: '38.2%',
				opacity:'0.4'
			});
			return false;
		});
	});
</script>
<include file="Public:footer"/>
