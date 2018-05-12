<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/styles.css">
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script>
    <title><?php echo ($config["site_name"]); ?> - 商家中心</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="<?php echo ($static_path); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ($static_path); ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-fonts.css">
    <link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace.min.css" id="main-ace-style">
    <link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-skins.min.css">
    <link rel="stylesheet" href="<?php echo ($static_path); ?>css/ace-rtl.min.css">
    <link rel="stylesheet" href="<?php echo ($static_path); ?>css/global.css">
    <link rel="stylesheet" href="<?php echo ($static_path); ?>css/jquery-ui-timepicker-addon.css">
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ba-bbq.min.js"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-extra.min.js"></script>


    <script type="text/javascript" src="<?php echo ($static_path); ?>js/bootstrap.min.js"></script>

    <!-- page specific plugin scripts -->
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/bootbox.min.js"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.sparkline.min.js"></script>

    <!-- ace scripts -->
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/ace-elements.min.js"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/ace.min.js"></script>

    <script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery.yiigridview.js"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-i18n.min.js"></script>
    <script type="text/javascript" src="<?php echo ($static_path); ?>js/jquery-ui-timepicker-addon.min.js"></script>
    <style type="text/css">
        .jqstooltip {
            position: absolute;
            left: 0px;
            top: 0px;
            visibility: hidden;
            background: rgb(0, 0, 0) transparent;
            background-color: rgba(0, 0, 0, 0.6);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);
            -ms-filter:"progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
            color: white;
            font: 10px arial, san serif;
            text-align: left;
            white-space: nowrap;
            padding: 5px;
            border: 1px solid white;
            z-index: 10000;
        }

        .jqsfield {
            color: white;
            font: 10px arial, san serif;
            text-align: left;
        }

        .statusSwitch, .orderValidSwitch, .unitShowSwitch, .authTypeSwitch {
            display: none;
        }

        #shopList .shopNameInput, #shopList .tagInput, #shopList .orderPrefixInput
        {
            font-size: 12px;
            color: black;
            display: none;
            width: 100%;
        }
    </style>
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>
</head>
<body class='no-skin'>
<div id="navbar" class="navbar navbar-default"   >
	<div class="navbar-container" id="navbar-container" style="height:45px;">
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
			<span class="sr-only">Toggle sidebar</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<div class="navbar-header pull-left">
			<a href="<?php echo U('Index/index');?>" class="navbar-brand" style="padding: 5px 0 0 0;"> 
				<small> 
					<img src="<?php echo ($config["site_merchant_logo"]); ?>" style="height:38px;width:38px;"/> <?php echo ($config["site_name"]); ?> - 商家中心
				</small>
			</a>
		</div>
		<div class="navbar-buttons navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">
				<!--li class="red">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
						<i class="ace-icon fa fa-bell icon-animated-bell"></i> 
						<span class="badge badge-important">0</span>
					</a>
					<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-exclamation-triangle"></i> 0笔未处理订单
						</li>
						<li class="dropdown-footer">
							<a href="#">查看全部未处理订单 
								<i class="ace-icon fa fa-arrow-right"></i>
							</a>
						</li>
					</ul>
				</li>
				<li class="green">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
						<i class="ace-icon fa fa-envelope icon-animated-vertical"></i> 
						<span class="badge badge-success">0</span>
					</a>
		
					<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
						<li class="dropdown-header">
							<i class="ace-icon fa fa-envelope-o"></i> 0条未读消息
						</li>
						<li>
							<a href="#">
								有<span style="color: red;">0</span>条新留言
							</a>
						</li>
						<li>
							<a href="#">
								有<span style="color: red;">0</span>条新评论
							</a>
						</li>
						<li></li>
					</ul>
				</li-->
				<li class="light-blue">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle"> 
						<img class="nav-user-photo" src="<?php echo ($static_public); ?>images/user.jpg" alt="Jason&#39;s Photo" /> 
						<span class="user-info"> <small>欢迎您，</small> <?php echo ($merchant_session["name"]); ?></span> 
						<i class="ace-icon fa fa-caret-down"></i>
					</a>
					<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="<?php echo ($config["site_url"]); ?>" target="_blank">
								<i class="ace-icon fa fa-link"></i> 网站首页
							</a>
						</li>
						<!--li>
							<a href="#">
								<i class="ace-icon fa fa-share-alt"></i> 推荐好友
							</a>
						</li-->
						<li>
							<a href="<?php echo U('Index/ruzhu');?>">
								<i class="ace-icon fa fa-user"></i> 入驻资料修改
							</a>
						</li>
						<!--li>
							<a href="<?php echo U('Pay/index');?>"> 
								<i class="ace-icon fa fa-smile-o"></i> 对帐平台
							</a>
						</li-->
						<li class="divider"></li>
						<li>
							<a href="<?php echo U('Login/logout');?>"> 
								<i class="ace-icon fa fa-power-off"></i> 退出
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="main-container" id="main-container" >
    <div id="sidebar" class="sidebar responsive">
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<a class="btn btn-success" href="<?php echo U('Config/store_edit');?>" title="商家设置">
				<i class="ace-icon fa fa-gear"></i>
			</a>&nbsp;
			<a class="btn btn-info" href="<?php echo U('Meal/index');?>" title="<?php echo ($config["meal_alias_name"]); ?>管理"> 
				<i class="ace-icon fa fa-cutlery"></i>
			</a>&nbsp;
			<a class="btn btn-warning" href="<?php echo U('Group/index');?>" title="<?php echo ($config["group_alias_name"]); ?>管理"> 
				<i class="ace-icon fa fa-desktop"></i>
			</a>&nbsp;
			<!--a class="btn btn-danger" href="<?php echo U('Pay/index');?>"> 
				<i class="ace-icon fa fa-smile-o"></i>
			</a-->
		</div>
		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span> <span class="btn btn-info"></span>
			<span class="btn btn-warning"></span> <span class="btn btn-danger"></span>
		</div>
	</div>
	<ul class="nav nav-list" style="top: 0px;">
		<?php if(is_array($merchant_menu)): $i = 0; $__LIST__ = $merchant_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($vo["style_class"]); ?>">
				<a <?php if($vo['menu_list']): ?>href="#" class="dropdown-toggle"<?php else: ?>href="<?php echo ($vo["url"]); ?>"<?php endif; ?>> 
					<i class="menu-icon fa <?php echo ($vo["icon"]); ?>"></i>
					<span class="menu-text"><?php echo ($vo["name"]); ?></span>
					<?php if($vo['menu_list']): ?><b class="arrow fa fa-angle-down"></b><?php endif; ?>
				</a>
				<b class="arrow"></b>
				<?php if($vo['menu_list']): ?><ul class="submenu">
						<?php if(is_array($vo['menu_list'])): $i = 0; $__LIST__ = $vo['menu_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li <?php if($voo['is_active']): ?>class="active"<?php endif; ?>>
								<a href="<?php echo ($voo["url"]); ?>"> 
									<i class="menu-icon fa fa-caret-right"></i> <?php echo ($voo["name"]); ?>
								</a>
								<b class="arrow"></b>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endif; ?>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
	<!-- /.nav-list -->

	<!-- #section:basics/sidebar.layout.minimize -->
	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i class="ace-icon fa fa-angle-double-left"
			data-icon1="ace-icon fa fa-angle-double-left"
			data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>

	<!-- /section:basics/sidebar.layout.minimize -->
	<script type="text/javascript">
		try {
			ace.settings.check('sidebar', 'collapsed')
		} catch (e) {
		}
	</script>
</div>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="<?php echo U('Config/store');?>">店铺管理</a>
			</li>
			<li class="active">添加店铺</li>
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
							<!-- <li>
								<a data-toggle="tab" href="#txtstore">店铺描述</a>
							</li> -->
						</ul>
					</div>
					<form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form">
						<div class="tab-content">
							<div id="basicinfo" class="tab-pane active">
								<input type="hidden" name="store_id" value="<?php echo ($now_store["store_id"]); ?>"/>
								<div class="form-group">
									<label class="col-sm-1">
										<b>*</b>
										<label for="unit">农场主头像</label>
									</label>
									<span class="col-sm-2" style="padding-left:0px;">
										<input id="ytimage-file" type="hidden" value="" name="person_image"/>
										<input class="col-sm-1" id="image-file" size="200" onchange="previewimage(this)" name="image" type="file"/>
									</span>
									<span class="form_tips" style="color:red;">必填。（图片文件大小不能超过<?php echo ($config["meal_pic_size"]); ?>M,建议上传大尺寸的图片。） 图片宽度建议为200px，高度建议为200px</span>
								</div>
								<div id="image_preview_box">
									<?php if($now_merchant['person_image']): ?><img style="width:200px;height:200px" src="<?php echo ($now_merchant["person_image"]); ?>" alt="图片预览" title="图片预览"/>
										<?php else: ?>
										<img style="width:200px;height:200px" src="./upload/merchant/no/face.jpg" alt="图片预览" title="图片预览"/><?php endif; ?>
								</div>
								<div class="form-group">
									<label class="col-sm-1">
										<b>*</b>
										<label for="name">农场名称</label>
									</label>
									<input class="col-sm-2" size="20" name="name" id="name" value="<?php echo ($now_merchant["name"]); ?>" type="text"/>
								</div>
								<div class="form-group"><label class="col-sm-1">是否设置成主店</label><label><input type="radio" name="ismain" <?php if($ismainno): ?>checked="checked"<?php endif; ?> value="1">&nbsp;&nbsp;是</label>
									&nbsp;&nbsp;&nbsp;
									<label><input type="radio" name="ismain" value="0"  <?php if(!$ismainno): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;否</label>
									&nbsp;&nbsp;&nbsp;<span class="form_tips">必须设置一个店铺为主店铺，前端才会显示商家中心</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><b>*</b><label for="phone">农场主名称</label></label>
									<input class="col-sm-2" size="20" name="person_name" value="<?php echo ($now_merchant["person_name"]); ?>" type="text"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><b>*</b><label for="permoney">人均消费</label></label>
									<input class="col-sm-2" size="20" name="permoney" id="permoney" type="text" value="<?php echo ($now_store["permoney"]); ?>" onkeyup="value=value.replace(/[^1234567890]+/g,'')"/>
									<span class="form_tips"> 元（必填）</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><b>*</b><label for="feature">农场主简介</label></label>
									<textarea class="col-sm-5" rows="5" name="person_info"><?php echo ($now_merchant["person_info"]); ?></textarea>
								</div>
								<div class="form-group">
									<label class="col-sm-1">农场描述</label>
									<textarea class="col-sm-5" rows="5" name="txt_info"><?php echo ($now_merchant["txt_info"]); ?></textarea>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><b>*</b><label for="trafficroute">交通路线</label></label>
									<input class="col-sm-2" name="trafficroute" id="trafficroute" type="text" value="<?php echo ($now_store["trafficroute"]); ?>" style="width:600px"/>
									<span class="form_tips">简单描述本店交通路线80字以内（必填）</span>
								</div>
								<input type="hidden" value="<?php echo ($now_store["store_id"]); ?>">
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
								<div class="form-group">
								<input type="hidden" class="col-sm-2" size="20" name="ismain" id="ismain"  value="1"/>
								</div>
								<div class="form-group">
								<input type="hidden" class="col-sm-2" size="20" name="have_meal" id="have_meal"  value="1"/>
								</div>
								<div class="form-group">
								<input type="hidden" class="col-sm-2" size="20" name="have_group" id="have_group"  value="1"/>
								</div>
								<div class="form-group">
									<input type="hidden" class="col-sm-2" size="20" name="store_type" id="store_type"  value="2"/>
								</div>
								<div class="form-group"><input type="hidden" name="feature" value="<?php echo ($now_merchant["name"]); ?>">
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="phone">联系电话</label></label>
									<input class="col-sm-2" size="20" name="phone" id="phone" value="<?php echo ($now_store["phone"]); ?>" type="text"/>
									<span class="form_tips">多个电话号码以空格分开</span>

								</div>
								
							   <div class="form-group">
									<label class="col-sm-1"><label for="weixin">联系微信</label></label>
									<input class="col-sm-2" size="20" name="weixin" id="weixin" type="text" value="<?php echo ($now_store["weixin"]); ?>"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="qq">联系Q Q</label></label>
									<input class="col-sm-2" size="20" name="qq" id="qq" type="text" value="<?php echo ($now_store["qq"]); ?>"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1">农场关键词：</label>
									<input class="col-sm-3" maxlength="30" name="keywords" type="text" value="<?php echo ($now_store["keywords"]); ?>" id="keywords"/><span class="form_tips">选填。<font color="red">（用空格分隔不同的关键词，最多5个）</font>，用户在微信将按此值搜索！</span> <a href="javascript:;" id="get_key_btn">按店铺名称获取</a>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="long_lat">地图位置标点</label></label>
									<input class="col-sm-2" size="10" name="long_lat" id="long_lat" value="<?php echo ($now_store["long"]); ?>,<?php echo ($now_store["lat"]); ?>" type="text" readonly="readonly"/>
									&nbsp;&nbsp;&nbsp;&nbsp;<a href="#modal-table" class="btn btn-sm btn-success" id="show_map_frame" data-toggle="modal">点击选取经纬度</a>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>农场地址</label></label>
									<fieldset id="choose_cityarea" province_id="<?php echo ($now_store["province_id"]); ?>" city_id="<?php echo ($now_store["city_id"]); ?>" area_id="<?php echo ($now_store["area_id"]); ?>" circle_id="<?php echo ($now_store["circle_id"]); ?>"></fieldset>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="adress">店铺地址</label></label>
									<input class="col-sm-2" size="20" name="adress" id="adress" value="<?php echo ($now_store["adress"]); ?>" type="text"/>
								</div>
								
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">店铺排序</label></label>
									<input class="col-sm-1" size="10" name="sort" id="sort" type="text" value="<?php echo ($now_store["sort"]); ?>" />
									<span class="form_tips">默认添加顺序排序！手动调值，数值越大，排序越前</span>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label for="sort">农场分类</label></label>
									<select id="choose_catfid" name="merchant_cat_fid" class="col-sm-1" style="margin-right:10px;">
										<?php if(is_array($f_category_list)): $i = 0; $__LIST__ = $f_category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($now_merchant['merchant_cat_fid']==$vo['cat_id']): ?><option value="<?php echo ($vo["cat_id"]); ?>" selected><?php echo ($vo["cat_name"]); ?></option>
												<?php else: ?>
											<option value="<?php echo ($vo["cat_id"]); ?>"><?php echo ($vo["cat_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
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
									<?php if($now_merchant['merchant_theme_image']): ?><img style="width:750px;height:300px" src="<?php echo ($now_merchant["merchant_theme_image"]); ?>" alt="图片预览" title="图片预览"/>
										<?php else: ?>
										<img style="width:750px;height:300px" src="./upload/merchant/no/theme.jpg" alt="图片预览" title="图片预览"/><?php endif; ?>
								</div>
								
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
												<input id="Config_shop_start_time" type="text" value="<?php echo (($now_store["office_time"]["0"]["open"])?($now_store["office_time"]["0"]["open"]):'00:00'); ?>" name="office_start_time" />	至
												<input id="Config_shop_stop_time" type="text" value="<?php echo (($now_store["office_time"]["0"]["close"])?($now_store["office_time"]["0"]["close"]):'00:00'); ?>" name="office_stop_time" />
												<div class="errorMessage" id="Config_shop_start_time_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_em_" style="display:none"></div>
											</div>
										</div>
										<div id="shop_time_2" class="tab-pane">
											<div>
												<input id="Config_shop_start_time_2" type="text" value="<?php echo (($now_store["office_time"]["1"]["open"])?($now_store["office_time"]["1"]["open"]):'00:00'); ?>" name="office_start_time2" />	至
												<input id="Config_shop_stop_time_2" type="text" value="<?php echo (($now_store["office_time"]["1"]["close"])?($now_store["office_time"]["1"]["close"]):'00:00'); ?>" name="office_stop_time2" />
												<div class="errorMessage" id="Config_shop_start_time_2_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_2_em_" style="display:none"></div>
											</div>
										</div>
										<div id="shop_time_3" class="tab-pane">
											<div>
												<input id="Config_shop_start_time_3" type="text" value="<?php echo (($now_store["office_time"]["2"]["open"])?($now_store["office_time"]["2"]["open"]):'00:00'); ?>" name="office_start_time3" />	至
												<input id="Config_shop_stop_time_3" type="text" value="<?php echo (($now_store["office_time"]["2"]["close"])?($now_store["office_time"]["2"]["close"]):'00:00'); ?>" name="office_stop_time3" />
												<div class="errorMessage" id="Config_shop_start_time_3_em_" style="display:none"></div>
												<div class="errorMessage" id="Config_shop_stop_time_3_em_" style="display:none"></div>
											</div>
										</div>
									</div>
								</div>
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
var static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",merchant_index="<?php echo U('Index/index');?>",choose_province="<?php echo U('Area/ajax_province');?>",choose_city="<?php echo U('Area/ajax_city');?>",choose_area="<?php echo U('Area/ajax_area');?>",choose_circle="<?php echo U('Area/ajax_circle');?>";
</script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/area.js"></script>
<script type="text/javascript" src="<?php echo ($static_path); ?>js/map.js"></script>
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
<link rel="stylesheet" href="<?php echo ($static_public); ?>kindeditor/themes/default/default.css">
<script src="<?php echo ($static_public); ?>kindeditor/kindeditor.js"></script>
<script src="<?php echo ($static_public); ?>kindeditor/lang/zh_CN.js"></script>
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
		editor.uploadJson = "<?php echo U('Config/store_ajax_upload_pic');?>";
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
	// 	$.post("<?php echo U('Config/store_edit');?>",$('#edit_form').serialize(),function(result){
	// 		if(result.status == 1){
	// 			alert(result.info);
	// 			window.location.href = "<?php echo U('Config/store_edit',array('id'=>$now_store['store_id']));?>";
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
			$.get("<?php echo U('Index/Scws/ajax_getKeywords');?>",{title:s_name.val()},function(result){
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
	$.post("<?php echo U('Config/store_ajax_del_pic');?>",{path:path});
	$(obj).closest('.upload_pic_li').remove();
}
</script>

	<div id="orderAlert" style="position: fixed; z-index: 999999; bottom: 5px; right: 5px; background: #e5e5e5; display: none;">
		<div style="text-align: center; margin-top: 10px; font-size: 20px; color: red;">
			<b>新订单来啦!</b> <a class="oaright" href="javascript:closeoa()">[关闭]</a>
		</div>
		<div style="margin: 20px 30px 5px 30px; cursor: pointer;" onclick="tourl()">
			您好：有<span class="label label-info" id="oanum"></span>笔新订单来了！
		</div>
		<div style="margin: 5px 30px 5px 30px; cursor: pointer;" onclick="tourl()">
			截止目前，一共有<span class="label label-info" id="oatnum"></span>笔订单未处理
		</div>
		<div class="oaright" style="bottom: 10px; margin: 5px 30px 5px 30px;">
			时间：<a id="oatime" style="text-decoration: none;"></a>
		</div>
	</div>
	<div style="position: fixed; top: -9999px; right: -9999px; display: none;" id="soundsw"></div>
	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> 
		<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
	</a>
</div>

<script>
function newalert(title){
	bootbox.dialog({
		message: title, 
		buttons: {
			"success" : {
				"label" : "确认",
				"className" : "btn-sm btn-primary"
			}
		}
	});
}

function alertshow(content){
	$('#popalertwindowcontent').html(content);
	$('#popalertwindow').show();
}
setInterval(function(){
	$.post("<?php echo U('Index/ping');?>");
},60000);

</script>

<div style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; display: none;" id="popalertwindow">
	<div style="width: 100%; height: 100%; background: #eeeeee; filter: alpha(opacity = 50); -moz-opacity: 0.5; -khtml-opacity: 0.5; opacity: 0.5; position: absolute; z-index: 9999;"></div>
	<div style="position: relative; width: 500px; height: 200px; margin: 200px auto; filter: alpha(opacity = 100); -moz-opacity: 1; -khtml-opacity: 1; opacity: 1; z-index: 10000; background: #ffffff; -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px; -webkit-box-shadow: #666 0px 0px 10px; -moz-box-shadow: #666 0px 0px 10px; box-shadow: #666 0px 0px 10px;">
		<div style="height: 40px;"></div>
		<div style="width: 400px; height: 90px; margin: 0px auto; color: #999999; text-align: center; font-size: 20px;">
			<table style="width: 400px; height: 90px;">
				<tbody>
					<tr>
						<td id="popalertwindowcontent"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div style="height: 20px;"></div>
		<div style="width: 80px; height: 40px; background: #eeeeee; margin: 0 auto; line-height: 40px; text-align: center; font-size: 20px; border: 1px solid #999999; cursor: pointer;" onclick="$(&#39;#popalertwindow&#39;).hide();">确认</div>
	</div>
</div>
</body>
</html>