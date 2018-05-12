<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Config/merchant')}">商家设置</a>
			</li>
			<li class="active">商家设置</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
				.col-sm-2{
				  font-size:12px;
				}
			</style>
			<div class="row">
				<div class="col-xs-12">
					
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form">
						<div class="tab-content">
							<div id="basicinfo" class="tab-pane active">
								
								<div class="form-group">
									<label class="col-sm-1"><label for="phone">姓名：</label></label>
									<input style="font-size:12px;" class="col-sm-2" size="20" name="phone" value="请输入您的银行卡开户名" id="phone" type="text"/>
								
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="email">电话：</label></label>
									<input style="font-size:12px;" class="col-sm-2" size="20" name="email" value="请输入您的联系电话" id="email" type="text"/>
									
								</div>
								<div class="form-group">
									<label class="col-sm-1">开户行：</label>
									<select id="choose_catfid" name="merchant_cat_fid" class="col-sm-1" style="margin-right:10px; padding-left:0px;">
											<option value="1" selected>请选择</option>											
											<option value="2">中国银行</option>											
											<option value="3">中国银行</option>
											<option value="4">中国银行</option>
											<option value="5">中国银行</option>											
											<option value="6">中国银行</option>											
											<option value="7">中国银行</option>									
									</select>
								
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="email">银行卡号</label></label>
									<input style="font-size:12px;" class="col-sm-2" size="20" name="email" value="请输入您的银行卡号" id="email" type="text"/>
									
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="email">提现金额</label></label>
									<input style="font-size:12px;" class="col-sm-2" size="20" name="email" value="" id="email" type="text"/>
									
								</div>
								<div class="form-group" style="font-size:13px; margin:0px;">
									<p>备注：说明说明说明说明说明说明说明说明说明说明说明说明说明说明说明说明</p>
								</div>
							</div>
							
							

							
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">
										<i class="ace-icon fa fa-check bigger-110"></i>
										保存
									</button>
								</div>
							</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
<style>
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
	
//	$('#edit_form').submit(function(){
//		$.post("{pigcms{:U('Config/merchant')}",$('#edit_form').serialize(),function(result){
//			if(result.status == 1){
//				alert(result.info);
//				window.location.href = "{pigcms{:U('Config/merchant')}";
//			}else{
//				alert(result.info);
//			}
//		})
//		return false;
//	});
	
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
	$('#choose_catfid').change(function(){
		$.getJSON("/merchant.php?g=Merchant&c=Group&a=ajax_get_category",{cat_fid:$(this).val()},function(result){
			if(result.error == 0){
				var catid_html = '';
				$.each(result.cat_list,function(i,item){
					catid_html += '<option value="'+item.cat_id+'">'+item.cat_name+'</option>';
				});
				$('#choose_catid').html(catid_html);
				if(result.custom_html == ''){
					$('#custom_html_tips').hide();
				}else{
					$('#custom_html_tips').show();
				}
				if(result.cue_html == ''){
					$('#cue_html_tips').hide();
				}else{
					$('#cue_html_tips').show();
				}
				$('#custom_html').html(result.custom_html);
				$('#cue_html').html(result.cue_html);
			}else{
				// $('#choose_catid').html('<option value="0">请选择其他分类</option>');

				alert(result.msg);
				$('#choose_catfid option').eq(0).prop('selected',true);
				$('#choose_catfid').trigger('change');
			}
		});
	});
	$(function(){
		$('#image-file').ace_file_input({
			no_file:'gif|png|jpg|jpeg格式',
			btn_choose:'选择',
			btn_change:'重新选择',
			no_icon:'fa fa-upload',
			icon_remove:'',
			droppable:false,
			onchange:null,
			remove:false,
			thumbnail:false
		});
		$('#merchantimage-file').ace_file_input({
			no_file:'gif|png|jpg|jpeg格式',
			btn_choose:'选择',
			btn_change:'重新选择',
			no_icon:'fa fa-upload',
			icon_remove:'',
			droppable:false,
			onchange:null,
			remove:false,
			thumbnail:false
		});
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
	function previewimage(input){
		if (input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e) {$('#image_preview_box').html('<img style="width:120px;height:120px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
			reader.readAsDataURL(input.files[0]);
		}
	}
	function previewmerchantimage(input){
		if (input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e) {$('#merchantimage_preview_box').html('<img style="width:400px;height:200px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
<include file="Public:footer"/>
