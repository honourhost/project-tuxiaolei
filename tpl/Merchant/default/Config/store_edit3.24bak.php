<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Config/store')}">店铺管理</a>
			</li>
			<li class="active">编辑店铺</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
				.col-sm-1 b{
					font-weight: normal; color: red; margin-right: 2px;
				}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active">
								<a data-toggle="tab" href="#basicinfo">基本设置</a>
							</li>
							<li>
								<a data-toggle="tab" href="#txtpwd">修改密码</a>
							</li>
						</ul>
					</div>
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form">
						<div class="tab-content">
							<div id="basicinfo" class="tab-pane active">
								<input type="hidden" name="store_id" value="{pigcms{$now_store.store_id}"/>
								<div class="form-group">
									<label class="col-sm-1">
										<b>*</b>
										<label for="unit">农场主头像</label>
									</label>
									<span class="col-sm-2" style="padding-left:0px;">
										<input id="ytimage-file" type="hidden" value="" name="person_image"/>
										<input class="col-sm-1" id="image-file" size="200" onchange="previewimage(this)" name="image" type="file"/>
									</span>
									<span class="form_tips" style="color:red;">必填。（图片文件大小不能超过{pigcms{$config.meal_pic_size}M,建议上传大尺寸的图片。） 图片宽度建议为200px，高度建议为200px</span>
								</div>
								<div id="image_preview_box">
									<if condition="$now_merchant['person_image']">
										<img style="width:200px;height:200px" src="{pigcms{$now_merchant.person_image}" alt="图片预览" title="图片预览"/>
										<else/>
										<img style="width:200px;height:200px" src="./upload/merchant/no/face.jpg" alt="图片预览" title="图片预览"/>
									</if>
								</div>
								<div class="form-group">
									<label class="col-sm-1">
										<b>*</b>
										<label for="name">农场名称</label>
									</label>
									<input class="col-sm-2" size="20" name="name" id="name" value="{pigcms{$now_merchant.name}" type="text"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><b>*</b><label for="phone">农场主名称</label></label>
									<input class="col-sm-2" size="20" name="person_name" value="{pigcms{$now_merchant.person_name}" type="text"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><b>*</b><label for="permoney">人均消费</label></label>
									<input class="col-sm-2" size="20" name="permoney" id="permoney" type="text" value="{pigcms{$now_store.permoney}" onkeyup="value=value.replace(/[^1234567890]+/g,'')"/>
									<span class="form_tips"> 元（必填）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><b>*</b><label for="feature">农场主简介</label></label>
									<textarea class="col-sm-5" rows="5" name="person_info">{pigcms{$now_merchant.person_info}</textarea>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><b>*</b>农场描述</label>
									<textarea class="col-sm-5" rows="5" name="txt_info">{pigcms{$now_merchant.txt_info}</textarea>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><b>*</b><label for="trafficroute">交通路线</label></label>
									<input class="col-sm-2" name="trafficroute" id="trafficroute" type="text" value="{pigcms{$now_store.trafficroute}" style="width:600px"/>
									<span class="form_tips">简单描述本店交通路线80字以内（必填）</span>
								</div>
								<input type="hidden" value="{pigcms{$now_store.store_id}">
								<style>
									.more-btn{
										display: block;
										width: 150px;
										height: 40px;
										border-radius: 5px;
										text-align: center;
										line-height: 40px;
										margin: 0px auto;
										border: 1px solid #ccc;
										background: #f5f5f5;
										font-size: 14px;
										color: #000;
									}
									.more-btn:hover{
										text-decoration: none;
									}
								</style>
									<a class="more-btn">继续完善信息</a>
								
								<div class="more-div" style="display: none;">
								<div class="form-group"><input type="hidden" name="ismain" value="1">
								</div>
								<div class="form-group"><input type="hidden" name="feature" value="{pigcms{$now_store.name}">
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="phone">联系电话</label></label>
									<input class="col-sm-2" size="20" name="phone" id="phone" value="{pigcms{$now_store.phone}" type="text"/>
									<span class="form_tips">多个电话号码以空格分开</span>

								</div>
								
							   <div class="form-group">
									<label class="col-sm-1"><label for="weixin">联系微信</label></label>
									<input class="col-sm-2" size="20" name="weixin" id="weixin" type="text" value="{pigcms{$now_store.weixin}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="qq">联系Q Q</label></label>
									<input class="col-sm-2" size="20" name="qq" id="qq" type="text" value="{pigcms{$now_store.qq}"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1">农场关键词：</label>
									<input class="col-sm-3" maxlength="30" name="keywords" type="text" value="{pigcms{$now_store.keywords}" id="keywords"/><span class="form_tips">选填。<font color="red">（用空格分隔不同的关键词，最多5个）</font>，用户在微信将按此值搜索！</span> <a href="javascript:;" id="get_key_btn">按店铺名称获取</a>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="long_lat">地图位置标点</label></label>
									<input class="col-sm-2" size="10" name="long_lat" id="long_lat" value="{pigcms{$now_store.long},{pigcms{$now_store.lat}" type="text" readonly="readonly"/>
									&nbsp;&nbsp;&nbsp;&nbsp;<a href="#modal-table" class="btn btn-sm btn-success" id="show_map_frame" data-toggle="modal">点击选取经纬度</a>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-1"><label>农场地址</label></label>
									<fieldset id="choose_cityarea" province_id="{pigcms{$now_store.province_id}" city_id="{pigcms{$now_store.city_id}" area_id="{pigcms{$now_store.area_id}" circle_id="{pigcms{$now_store.circle_id}"></fieldset>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="adress">店铺地址</label></label>
									<input class="col-sm-2" size="20" name="adress" id="adress" value="{pigcms{$now_store.adress}" type="text"/>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">店铺排序</label></label>
									<input class="col-sm-1" size="10" name="sort" id="sort" type="text" value="{pigcms{$now_store.sort}" />
									<span class="form_tips">默认添加顺序排序！手动调值，数值越大，排序越前</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">农场分类</label></label>
									<select id="choose_catfid" name="merchant_cat_fid" class="col-sm-1" style="margin-right:10px;">
										<volist name="f_category_list" id="vo">
											<if condition="$now_merchant['merchant_cat_fid']==$vo['cat_id']">
												<option value="{pigcms{$vo.cat_id}" selected>{pigcms{$vo.cat_name}</option>
												<else/>
											<option value="{pigcms{$vo.cat_id}">{pigcms{$vo.cat_name}</option>
											</if>
										</volist>
									</select>
								</div>
								<div class="form-group">
									<label class="col-sm-1">农场主题图</label>
									<span class="col-sm-2" style="padding-left:0px;">
										<input id="ytimage-file" type="hidden" value="" name="merchant_theme_image"/>
										<input class="col-sm-1" id="merchantimage-file" size="200" onchange="previewmerchantimage(this)" name="merchant_theme_image" type="file"/>
									</span>
									<span class="form_tips" style="color:red;">必填。（图片文件大小不能超过5M,建议上传大尺寸的图片。） 图片宽度建议为750px，高度建议为300px</span>
								</div>
								<div id="merchantimage_preview_box">
									<if condition="$now_merchant['merchant_theme_image']">
										<img style="width:750px;height:300px" src="{pigcms{$now_merchant.merchant_theme_image}" alt="图片预览" title="图片预览"/>
										<else/>
										<img style="width:750px;height:300px" src="./upload/merchant/no/theme.jpg" alt="图片预览" title="图片预览"/>
									</if>
								</div>
								<if condition="$config['store_open_meal']">
									<div class="form-group" style="display: none;">
										<label class="col-sm-1" for="have_meal">{pigcms{$config.meal_alias_name}</label>
										<select name="have_meal" id="have_meal">
											<option value="0" <if condition="$now_store['have_meal'] eq 0">selected="selected"</if>>关闭</option>
											<option value="1" <if condition="$now_store['have_meal'] eq 1">selected="selected"</if>>开启</option>
										</select>
									</div>
								</if>
								<if condition="$config['store_open_meal']">
									<div class="form-group" style="display: none;">
										<label class="col-sm-1" for="store_type">{pigcms{$config.meal_alias_name}类型</label>
										<select name="store_type" id="store_type">
											<option value="0" <if condition="$now_store['store_type'] eq 0">selected="selected"</if>>订餐和外卖</option>
											<option value="1" <if condition="$now_store['store_type'] eq 1">selected="selected"</if>>订餐</option>
											<option value="2" <if condition="$now_store['store_type'] eq 2">selected="selected"</if>>其他</option>
										</select>
										<span class="form_tips">【其他】是指（外卖，超市，花店...）</span>
									</div>
								</if>
								<if condition="$config['store_open_group']">
									<div class="form-group" style="display: none;">
										<label class="col-sm-1" for="have_group">{pigcms{$config.group_alias_name}</label>
										<select name="have_group" id="have_group">
											<option value="0" <if condition="$now_store['have_group'] eq 0">selected="selected"</if>>关闭</option>
											<option value="1" <if condition="$now_store['have_group'] eq 1">selected="selected"</if>>开启</option>
										</select>
									</div>
								</if>
								<div class="alert alert-info">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>
									假设您的营业时间为晚上20:00-凌晨02:00，请填写两个时间段，第一个为“20:00-23:59”，第二个为“00:00-02:00”
								</div>
								<div class="tabbable">
									<ul class="nav nav-tabs" id="myTab">
										<li class="active">
											<a data-toggle="tab" href="#shop_time_1">
												营业时间段1
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#shop_time_2">
												营业时间段2
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#shop_time_3">
												营业时间段3
											</a>
										</li>
									</ul>
									<div class="tab-content">
										<div id="shop_time_1" class="tab-pane in active">
											<div>
												<input id="Config_shop_start_time" type="text" value="{pigcms{$now_store.office_time.0.open|default='00:00'}" name="office_start_time" />	至
												<input id="Config_shop_stop_time" type="text" value="{pigcms{$now_store.office_time.0.close|default='00:00'}" name="office_stop_time" />
												<div class="errorMessage" id="Config_shop_start_time_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_em_" style="display:none"></div>
											</div>
										</div>
										<div id="shop_time_2" class="tab-pane">
											<div>
												<input id="Config_shop_start_time_2" type="text" value="{pigcms{$now_store.office_time.1.open|default='00:00'}" name="office_start_time2" />	至
												<input id="Config_shop_stop_time_2" type="text" value="{pigcms{$now_store.office_time.1.close|default='00:00'}" name="office_stop_time2" />
												<div class="errorMessage" id="Config_shop_start_time_2_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_2_em_" style="display:none"></div>
											</div>
										</div>
										<div id="shop_time_3" class="tab-pane">
											<div>
												<input id="Config_shop_start_time_3" type="text" value="{pigcms{$now_store.office_time.2.open|default='00:00'}" name="office_start_time3" />	至
												<input id="Config_shop_stop_time_3" type="text" value="{pigcms{$now_store.office_time.2.close|default='00:00'}" name="office_stop_time3" />
												<div class="errorMessage" id="Config_shop_start_time_3_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_3_em_" style="display:none"></div>
											</div>
										</div>
									</div>
								</div>
								</div>
								
							</div>

							<div id="txtpwd" class="tab-pane">
								<div class="form-group">
									<label class="col-sm-1"><label for="email">原密码</label></label>
									<input class="col-sm-2" size="20" name="old_pass" type="password"/>
									<span class="form_tips">不修改密码可不填写</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="email">新密码</label></label>
									<input class="col-sm-2" size="20" name="new_pass" type="password"/>
									<span class="form_tips">不修改密码请留空，最少6个字符</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="email">确认密码</label></label>
									<input class="col-sm-2" size="20" name="re_pass" type="password"/>
									<span class="form_tips">请再输入一次上面的新密码，以便确保输对了</span>
								</div>
							</div>
							
						</div>
						<div class="space"></div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">
										<i class="ace-icon fa fa-check bigger-110"></i>
										保存
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modal-table" class="modal fade" tabindex="-1" style="display:block;">
	<div class="modal-dialog" style="width:80%;">
		<div class="modal-content" style="width:100%;">
			<div class="modal-header no-padding" style="width:100%;">
				<div class="table-header">
					<button id="close_button" type="button" class="close" data-dismiss="modal" aria-hidden="true">
						<span class="white">&times;</span>
					</button>
					(用鼠标滚轮可以缩放地图)    拖动红色图标，经纬度框内将自动填充经纬度。
				</div>
			</div>
			<div class="modal-body no-padding" style="width:100%;">
				<form id="map-search" style="margin:10px;">
					<input id="map-keyword" type="textbox" style="width:500px;" placeholder="尽量填写城市、区域、街道名"/>
					<input type="submit" value="搜索"/>
				</form>
				<div style="width:100%;height:600px;min-height:600px;" id="cmmap"></div>
			</div>

			<div class="modal-footer no-margin-top">
				<button class="btn btn-sm btn-success pull-right" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					关闭
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- PAGE CONTENT ENDS -->
<script type="text/javascript">
		$(document).ready(function(){
		  $(".more-btn").click(function(){
		  $(".more-div").show();
		   $(".more-btn").hide();
		  });
		});
</script>
<script type="text/javascript">
var static_public="{pigcms{$static_public}",static_path="{pigcms{$static_path}",merchant_index="{pigcms{:U('Index/index')}",choose_province="{pigcms{:U('Area/ajax_province')}",choose_city="{pigcms{:U('Area/ajax_city')}",choose_area="{pigcms{:U('Area/ajax_area')}",choose_circle="{pigcms{:U('Area/ajax_circle')}";
</script>
<script type="text/javascript" src="{pigcms{$static_path}js/area.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}js/map.js"></script>
<script type="text/javascript">
$(function($){
	$('#Config_shop_start_time').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_stop_time').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_start_time_2').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_stop_time_2').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_start_time_3').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
	$('#Config_shop_stop_time_3').timepicker($.extend($.datepicker.regional['zh-cn'], {'timeFormat':'hh:mm','hour':'10','minute':'52','second':'25'}));
});
</script>

<style>
.BMap_cpyCtrl{display:none;}
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
#upload_pic_box img{width:100px;height:70px;border:1px solid #ccc;}
</style>
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
		
	});
	function previewimage(input){
		if (input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e) {$('#image_preview_box').html('<img style="width:200px;height:200px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
			reader.readAsDataURL(input.files[0]);
		}
	}
	function previewmerchantimage(input){
		if (input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e) {$('#merchantimage_preview_box').html('<img style="width:750px;height:300px" src="'+e.target.result+'" alt="图片预览" title="图片预览"/>');}
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
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
		editor.uploadJson = "{pigcms{:U('Config/store_ajax_upload_pic')}";
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
	
	// $('#edit_form').submit(function(){
	// 	$.post("{pigcms{:U('Config/store_edit')}",$('#edit_form').serialize(),function(result){
	// 		if(result.status == 1){
	// 			alert(result.info);
	// 			window.location.href = "{pigcms{:U('Config/store_edit',array('id'=>$now_store['store_id']))}";
	// 		}else{
	// 			alert(result.info);
	// 		}
	// 	})
	// 	return false;
	// });
	
	$('#get_key_btn').click(function(){
		var s_name = $('input[name="name"]');
		s_name.val($.trim(s_name.val()));
		$('#keywords').val($.trim($('#keywords').val()));
		if(s_name.val().length == 0){
			alert('请先填写店铺名称！');
			s_name.focus();
		}else if($('#keywords').val().length != 0){
			alert('请先删除您填写的关键词！');
			$('#keywords').focus();
		}else{
			$.get("{pigcms{:U('Index/Scws/ajax_getKeywords')}",{title:s_name.val()},function(result){
				result = $.parseJSON(result);
				if(result.num == 0){
					alert('您的店铺名称没有提取到关键词，请手动填写关键词！');
					$('#keywords').focus();
				}else{
					$('#keywords').val(result.list.join(' ')).focus();
				}
			});
		}
	});
});
function deleteImage(path,obj){
	$.post("{pigcms{:U('Config/store_ajax_del_pic')}",{path:path});
	$(obj).closest('.upload_pic_li').remove();
}
</script>

<include file="Public:footer"/>
