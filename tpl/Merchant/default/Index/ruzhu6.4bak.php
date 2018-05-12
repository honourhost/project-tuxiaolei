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
											<form enctype="multipart/form-data" class="form-horizontal" method="post" action="{pigcms{:U('Index/companyVerify')}">
											<div class="form-group">
												<label class="col-sm-1">
													<label>公司名称</label>
												</label>
												<input class="col-sm-2" size="20" value="" type="text" name="company_name" />
											</div>
											<div class="form-group">
												<label class="col-sm-1">公司简介</label>
												<textarea class="col-sm-5" rows="5" name="company_info"></textarea>
											</div>
											<div class="form-group">
												<label class="col-sm-1">
													<label>营业执照号</label>
												</label>
												<input class="col-sm-2" size="20" value="" type="text" name="business_liscence_no" />
											</div>
											<div class="form-group">
												<label class="col-sm-1">上传营业执照</label>
										<span class="col-sm-2" style="padding-left:0px;">
										<input id="ytimage-file" type="hidden" value="" name="business_liscence_image"/>
										<input class="col-sm-1" id="business_liscence_image-file" size="200" onchange="preview_business_liscence_image(this)" name="business_liscence_image" type="file"/>
											<span class="form_tips">上传营业执照请保持字体清晰 大小不超过1M，请参考右侧示例</span>
										</span>
												<div class="sc-zhao-img">
													<img src="http://demo.24so.com/xnd/img/zhao.jpg">
													<span>(营业执照示例)</span>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-1">图片预览</label>
												<div id="business_liscence_image_preview_box">
													<if condition="$now_merchant['merchant_theme_image']">
														<img style="width:400px;height:200px" src="{pigcms{$now_merchant.business_licence_image}" alt="图片预览" title="图片预览"/>
													</if>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-1">
													<label>法人代表</label>
												</label>
												<input class="col-sm-2" size="20" value="" type="text" name="legal_represent" />
												<span class="form_tips">必须与公司营业执照一致</span>
											</div>
											<div class="form-group">
												<label class="col-sm-1">
													<label>法人身份证</label>
												</label>
												<input class="col-sm-2" size="20" value="" type="text" name="legal_represent_cardno" />
											</div>
											<div class="form-group sc-zhao">
												<label class="col-sm-1">身份证正面</label>
												<div class="sc-zhao-left">
													<input id="ytimage-file" type="hidden" value="" name="legal_represent_cardimage"/>
													<input class="col-sm-1" id="legal_represent_cardimage-file" size="200" onchange="preview_legal_represent_cardimage(this)" name="legal_represent_cardimage" type="file"/>
													<span class="form_tips">身份证照片正面，如右图所示</span>
												</div>
												<div class="sc-zhao-img">
											      <img src="http://demo.24so.com/xnd/img/shenfezheng.jpg">
											      <span>(身份证拍照示例)</span>
												</div>
											</div>
											<div style="clear: both;"></div>
											<div class="form-group">
												<label class="col-sm-1">图片预览</label>
												<div id="legal_represent_cardimage_box">
													<if condition="$now_merchant['legal_represent_cardimage']">
														<img style="width:600px;height:400px" src="{pigcms{$now_merchant.legal_represent_cardimage_other}" alt="图片预览" title="图片预览"/>
													</if>
												</div>
											</div>
											<div class="form-group sc-zhao">
												<label class="col-sm-1">身份证反面</label>
												<div class="sc-zhao-left">
													<input id="ytimage-file" type="hidden" value="" name="legal_represent_cardimage_other"/>
													<input class="col-sm-1" id="legal_represent_cardimage_other-file" size="200" onchange="preview_legal_represent_cardimage_other(this)" name="legal_represent_cardimage_other" type="file"/>
													<span class="form_tips">身份证照片反面，如右图所示</span>
												</div>
												<div class="sc-zhao-img">
											      <img src="http://demo.24so.com/xnd/img/shenfezheng.jpg">
											      <span>(身份证拍照示例)</span>
												</div>
											</div>
											<div style="clear: both;"></div>
											<div class="form-group">
												<label class="col-sm-1">图片预览</label>
												<div id="legal_represent_cardimage_other_box">
													<if condition="$now_merchant['legal_represent_cardimage_other']">
														<img style="width:600px;height:400px" src="{pigcms{$now_merchant.legal_represent_cardimage_other}" alt="图片预览" title="图片预览"/>
													</if>
												</div>
											</div>
											<!-- <div class="form-group sc-zhao">
												<label class="col-sm-1">手持身份证照</label>
												<div class="sc-zhao-left">
													<input id="ytimage-file" type="hidden" value="" name="company_handcardimage"/>
													<input class="col-sm-1" id="company_handcardimage-file" size="200" onchange="preview_company_handcardimage(this)" name="company_handcardimage" type="file"/>
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
												<div id="hand_cardimage_box">
													<if condition="$now_merchant['company_handcardimage']">
														<img style="width:400px;height:200px" src="{pigcms{$now_merchant.company_handcardimage}" alt="图片预览" title="图片预览"/>
													</if>
												</div>
											</div> -->
												<div class="clearfix form-actions">
													<div class="col-md-offset-3 col-md-9">
														<button class="btn btn-info" type="submit">
															<i class="ace-icon fa fa-check bigger-110"></i> 提交申请
														</button>
													</div>
												</div>
											</form>
										</div>
										<div id="txtstore" class="tab-pane">
											<form enctype="multipart/form-data" class="form-horizontal" method="post" action="{pigcms{:U('Index/personVerify')}">
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
												<input class="col-sm-2" size="20" value="" type="text" name="person_cardno" />
											</div>
											<div class="form-group sc-zhao">
												<label class="col-sm-1">身份证正面</label>
												<div class="sc-zhao-left">
													<input id="ytimage-file" type="hidden" value="" name="person_cardimage"/>
													<input class="col-sm-1" id="person_cardimage-file" size="200" onchange="preview_person_cardimage(this)" name="person_cardimage" type="file"/>
													<span class="form_tips">身份证照片正面，如右图所示</span>
												</div>
												<div class="sc-zhao-img">
											      <img src="http://demo.24so.com/xnd/img/shenfezheng.jpg">
											      <span>(身份证拍照示例)</span>
												</div>
											</div>
											<div style="clear: both;"></div>
											<div class="form-group">
												<label class="col-sm-1">图片预览</label>
												<div id="person_cardimage_box">
													<if condition="$now_merchant['person_cardimage']">
														<img style="width:600px;height:400px" src="{pigcms{$now_merchant.person_cardimage}" alt="图片预览" title="图片预览"/>
													</if>
												</div>
											</div>
											<div class="form-group sc-zhao">
												<label class="col-sm-1">身份证反面</label>
												<div class="sc-zhao-left">
													<input id="ytimage-file" type="hidden" value="" name="person_cardimage_other"/>
													<input class="col-sm-1" id="person_cardimage_other-file" size="200" onchange="preview_person_cardimage_other(this)" name="person_cardimage_other" type="file"/>
													<span class="form_tips">身份证照片反面，如右图所示</span>
												</div>
												<div class="sc-zhao-img">
											      <img src="http://demo.24so.com/xnd/img/shenfezheng.jpg">
											      <span>(身份证拍照示例)</span>
												</div>
											</div>
											<div style="clear: both;"></div>
											<div class="form-group">
												<label class="col-sm-1">图片预览</label>
												<div id="person_cardimage_other_box">
													<if condition="$now_merchant['person_cardimage_other']">
														<img style="width:600px;height:400px" src="{pigcms{$now_merchant.person_cardimage_other}" alt="图片预览" title="图片预览"/>
													</if>
												</div>
											</div>
											<!-- <div class="form-group sc-zhao">
												<label class="col-sm-1">手持身份证照</label>
												<div class="sc-zhao-left">
													<input id="ytimage-file" type="hidden" value="" name="person_handcardimage"/>
													<input class="col-sm-1" id="person_handcardimage-file" size="200" onchange="preview_person_handcardimage(this)" name="person_handcardimage" type="file"/>
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
												<div id="person_handcardimage_box">
													<if condition="$now_merchant['person_handcardimage']">
														<img style="width:400px;height:200px" src="{pigcms{$now_merchant.person_handcardimage}" alt="图片预览" title="图片预览"/>
													</if>
												</div>
											</div> -->
											<div class="form-group">
												<label class="col-sm-1">个人农场简介</label>
												<textarea class="col-sm-5" rows="5" name="person_farm_info"></textarea>
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
<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
	$(function(){
		$('#business_liscence_image-file').ace_file_input({
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
		$('#legal_represent_cardimage-file').ace_file_input({
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
		$('#legal_represent_cardimage_other-file').ace_file_input({
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
		$('#company_handcardimage-file').ace_file_input({
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
		$('#person_cardimage-file').ace_file_input({
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
		$('#person_cardimage_other-file').ace_file_input({
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
		$('#person_handcardimage-file').ace_file_input({
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

	});
	function preview_business_liscence_image(input){
		if (input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e) {$('#business_liscence_image_preview_box').html('<img style="width:600px;height:400px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
			reader.readAsDataURL(input.files[0]);
		}
	}
	function preview_legal_represent_cardimage(input){
		if (input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e) {$('#legal_represent_cardimage_box').html('<img style="width:600px;height:400px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
			reader.readAsDataURL(input.files[0]);
		}
	}
	function preview_legal_represent_cardimage_other(input){
		if (input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e) {$('#legal_represent_cardimage_other_box').html('<img style="width:600px;height:400px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
			reader.readAsDataURL(input.files[0]);
		}
	}
	function preview_company_handcardimage(input){
		if (input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e) {$('#hand_cardimage_box').html('<img style="width:600px;height:400px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
			reader.readAsDataURL(input.files[0]);
		}
	}
	function preview_person_cardimage(input){
		if (input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e) {$('#person_cardimage_box').html('<img style="width:600px;height:400px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
			reader.readAsDataURL(input.files[0]);
		}
	}
	function preview_person_cardimage_other(input){
		if (input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e) {$('#person_cardimage_other_box').html('<img style="width:600px;height:400px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
			reader.readAsDataURL(input.files[0]);
		}
	}
	function preview_person_handcardimage(input){
		if (input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e) {$('#person_handcardimage_box').html('<img style="width:600px;height:400px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<include file="Public:footer"/>
