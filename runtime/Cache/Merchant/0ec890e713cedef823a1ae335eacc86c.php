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
                <a href="<?php echo U('Crowdfunding/index');?>">众筹管理</a>
            </li>
            <li class="active">添加众筹</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <style>
                .ace-file-input a {
                    display: none;
                }

                #levelcoupon select {
                    width: 150px;
                    margin-right: 20px;
                }
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a data-toggle="tab" href="#basicinfo">基本信息</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#txtintro">众筹详情</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#txtimage">众筹图片</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#crowdlevel">众筹档次</a>
                            </li>
                        </ul>
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" method="post" id="add_form">
                        <div class="tab-content">
                            <div id="basicinfo" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-sm-1">发起人姓名：</label>
                                    <input class="col-sm-3" maxlength="100" name="invator" type="text"
                                           /><span
                                            class="form_tips">发起人姓名。</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">众筹标题：</label>
                                    <input class="col-sm-3" maxlength="100" name="title" type="text" value=""/><span
                                            class="form_tips">众筹的名称，7-30个汉字以内。</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">众筹类别：</label>
                                    <select class="col-sm-3"  name="crowdcat" type="text" >
                                        <option value="3">
                                            其他
                                        </option>
                                        <option value="0">
                                            美食
                                        </option>
                                        <option value="1">
                                            农业
                                        </option>
                                        <option value="2">
                                            民宿
                                        </option>
                                    </select>
                                    <span class="form_tips">众筹类别。</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">一句话描述：</label>
                                    <textarea class="col-sm-3" rows="5" name="digest"></textarea><span
                                            class="form_tips">众筹的简短介绍，建议为100字以下。</span>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1">目标筹款（元）：</label>
                                    <input class="col-sm-3" maxlength="100" type="number" name="funds"
                                           /><span class="form_tips">填写目标筹款金额</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">地区：</label>
                                    <input class="col-sm-3" maxlength="100" type="text" name="crowdplace"
                                    /><span class="form_tips">填写目标筹款地区</span>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-1">众筹开始时间：</label>
                                    <input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;"
                                           onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'<?php echo date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);?>',vel:'begin_time'})"
                                           value="<?php echo date('Y年m月d日 H时i分s秒',$_SERVER['REQUEST_TIME']);?>"/>
                                    <input name="starttime" id="begin_time" type="hidden"
                                           value="<?php echo date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);?>"/>
                                    <span class="form_tips">到了众筹开始时间，商品才会显示！</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">众筹结束时间：</label>
                                    <input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;"
                                           onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'<?php echo date('Y-m-d H:i:s',strtotime('+1 day'));?>',vel:'end_time'})"
                                           value="<?php echo date('Y年m月d日 H时i分s秒',strtotime('+1 day'));?>"/>
                                    <input name="endtime" id="end_time" type="hidden"
                                           value="<?php echo date('Y-m-d H:i:s',strtotime('+1 day'));?>"/>
                                    <span class="form_tips">超过众筹结束时间，会结束众筹！</span>
                                </div>


                            </div>
                            <div id="txtintro" class="tab-pane">


                                <div class="form-group">
                                    <label class="col-sm-1">众筹详情：<br/><span style="font-size:12px;color:#999;">必填</span></label>
                                    <textarea name="content" id="content" style="width:702px;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">相关特卖id：</label>
                                    <input class="col-sm-3" maxlength="100" type="number"
                                           value=""/><span class="form_tips">选填，填写要自动抽取内容的特卖id</span><a
                                            href="javascript:;" id="get_group_content">获取内容</a>
                                </div>
                            </div>
                            <div id="txtimage" class="tab-pane">
                                <div class="form-group">
                                    <label class="col-sm-1">上传图片</label>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success"
                                       id="J_selectImage">上传图片</a>
                                    <span class="form_tips">第一张将作为封面图展示！最多上传5张图片！尺寸要求：宽度：650像素，高度：350像素</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">图片预览</label>
                                    <div id="upload_pic_box">
                                        <ul id="upload_pic_ul"></ul>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1">上传视频</label>
                                    <input type="text" id="url" value="" name="videourl" /> <input type="button" id="insertfile" value="选择文件" />
                                    <span class="form_tips">视频请保持20M以内！</span>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1">上传视频封面图片</label>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success"
                                       id="J_selectvideoImage">上传视频封面图片</a>
                                    <span class="form_tips"></span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">图片预览</label>
                                    <div id="upload_pic_box">
                                        <ul id="upload_pic_ulv"></ul>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1">上传发起人头像图片</label>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success"
                                       id="J_selectinvatorImage">上传发起人头像图片</a>
                                    <span class="form_tips"></span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">图片预览</label>
                                    <div id="upload_pic_box">
                                        <ul id="upload_pic_uli">


                                        </ul>
                                    </div>
                            </div>
                            </div>
                            <div id="crowdlevel" class="tab-pane">
                                <div id="div1">
                                    <div class="form-group">
                                        <label class="col-sm-1">标题：</label>
                                        <input class="col-sm-3" maxlength="100" name="grade1[]" type="text" id="grade1"
                                               value=""/><span class="form_tips">众筹档次标题。</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1">描述：</label>
                                        <textarea class="col-sm-3"  name="grade1[]" type="text" id="grade1" rows="5"></textarea>
                                        <span class="form_tips">众筹档次描述。</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1">价格：</label>
                                        <input class="col-sm-3" maxlength="100" name="grade1[]" type="text"
                                               id="grade1" value=""/><span
                                                class="form_tips">档次价格。</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1">众筹最多人数目：</label>
                                        <input class="col-sm-3" maxlength="100" name="grade1[]" type="number"
                                               id="grade1" value=""/><span
                                                class="form_tips">大于0的整数</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1">是否抽奖：</label>
                                        <select class="col-sm-3"  name="grade1[]" type="text" id="grade1" rows="5">
                                            <option value="1">
                                                否
                                            </option>
                                            <option value="2">
                                                是
                                            </option>
                                        </select>
                                        <span class="form_tips">是否是抽奖众筹。</span>
                                    </div>
                                    <input class="col-sm-3" maxlength="100" name="grade1[]" type="hidden"
                                           id="grade1" value="0"/>
                                    <div class="form-group">
                                        <label class="col-sm-1">众筹多少人开一次奖：</label>
                                        <input class="col-sm-3" maxlength="100" name="grade1[]" type="number"
                                               id="grade1" value="20"/><span
                                                class="form_tips">非抽奖众筹可以不填写</span>
                                    </div>


                                </div>


                                <input type="hidden" name="gradeindex" id="gradeindex" value="1">
                            </div>

                            <div class="form-group" style="margin-bottom:0px;margin-top:20px;"><label class="col-sm-1">&nbsp;</label><a
                                        href="javascript:;" id="insert_crowd_grade">插入众筹档次</a></div>
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-info" type="submit" id="save_btn">
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
<style>
    input.ke-input-text {
        background-color: #FFFFFF;
        background-color: #FFFFFF !important;
        font-family: "sans serif", tahoma, verdana, helvetica;
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

    .form-group > label {
        font-size: 12px;
        line-height: 24px;
    }

    #upload_pic_box {
        margin-top: 20px;
        height: 150px;
    }

    #upload_pic_box .upload_pic_li {
        width: 130px;
        float: left;
        list-style: none;
    }

    #upload_pic_box img {
        width: 100px;
        height: 70px;
    }
</style>
<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script>
<!--<script src="<?php echo ($static_public); ?>kindeditor/kindeditor.js"></script>-->
<script src="<?php echo ($static_public); ?>kindeditor2/kindeditor-all-min.js"></script>
<script src="<?php echo ($static_public); ?>kindeditor2/lang/zh-CN.js"></script>
<script type="text/javascript">
    KindEditor.ready(function (K) {
        var content_editor = K.create("#content", {
            resizeType: 1,
            allowPreviewEmoticons: false,
            allowImageUpload: true,


            afterCreate: function () {
                this.loadPlugin('autoheight');
            },
            items: [
                'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
                'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
                'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
                'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
                'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
                'anchor', 'link', 'unlink', '|', 'about'

            ],
            emoticonsPath: './static/emoticons/',
            uploadJson: "<?php echo ($config["site_url"]); ?>/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=group/content",
            cssPath: "<?php echo ($static_path); ?>css/group_editor.css"
        });

        var editor = K.editor({
            allowFileManager: true
        });
        K('#J_selectImage').click(function () {
            if ($('.upload_pic_li').size() >= 5) {
                alert('最多上传5个图片！');
                return false;
            }
            editor.uploadJson = "<?php echo U('Group/ajax_upload_pic');?>";
            editor.loadPlugin('image', function () {
                editor.plugin.imageDialog({
                    showRemote: false,
                    imageUrl: K('#course_pic').val(),
                    clickFn: function (url, title, width, height, border, align) {
                        $('#upload_pic_ul').append('<li class="upload_pic_li"><img src="' + url + '"/><input type="hidden" name="webpic" value="' + title + '"/><br/><a href="#" onclick="deleteImage(\'' + title + '\',this);return false;">[ 删除 ]</a></li>');
                        editor.hideDialog();
                    }
                });
            });
        });

        K('#insertfile').click(function() {
            editor.uploadJson = "<?php echo ($config["site_url"]); ?>/index.php?g=Index&c=Upload&a=editor_ajax_uploadfile&upload_dir=group/content";
            editor.loadPlugin('insertfile', function() {
                editor.plugin.fileDialog({
                    fileUrl : K('#url').val(),
                    clickFn : function(url, title) {
                        K('#url').val(url);
                        editor.hideDialog();
                    }
                });
            });
        });

        K('#J_selectvideoImage').click(function () {
            if ($('.upload_pic_liv').size() >= 5) {
                alert('最多上传5个图片！');
                return false;
            }
            editor.uploadJson = "<?php echo U('Group/ajax_upload_pic');?>";
            editor.loadPlugin('image', function () {
                editor.plugin.imageDialog({
                    showRemote: false,
                    imageUrl: K('#course_pic').val(),
                    clickFn: function (url, title, width, height, border, align) {
                        $('#upload_pic_ulv').append('<li class="upload_pic_liv"><img src="' + url + '"/><input type="hidden" name="videopic" value="' + title + '"/><br/><a href="#" onclick="deletevideoImage(\'' + title + '\',this);return false;">[ 删除 ]</a></li>');
                        editor.hideDialog();
                    }
                });
            });
        });

        K('#J_selectinvatorImage').click(function () {
            if ($('.upload_pic_lii').size() >= 5) {
                alert('最多上传5个图片！');
                return false;
            }
            editor.uploadJson = "<?php echo U('Group/ajax_upload_pic');?>";
            editor.loadPlugin('image', function () {
                editor.plugin.imageDialog({
                    showRemote: false,
                    imageUrl: K('#course_pic').val(),
                    clickFn: function (url, title, width, height, border, align) {
                        $('#upload_pic_uli').append('<li class="upload_pic_lii"><img src="' + url + '"/><input type="hidden" name="invatorpic" value="' + title + '"/><br/><a href="#" onclick="deleteinvatorImage(\'' + title + '\',this);return false;">[ 删除 ]</a></li>');
                        editor.hideDialog();
                    }
                });
            });
        });


        $('#add_form').submit(function () {
            content_editor.sync();
            $('#save_btn').prop('disabled', true);
            $.post("<?php echo U('Crowdfunding/addaction');?>", $('#add_form').serialize(), function (result) {
                if (result.status == 1) {
                    alert(result.info);
                    window.location.href = "<?php echo U('Crowdfunding/index');?>";
                } else {
                    alert(result.info);
                }
                $('#save_btn').prop('disabled', false);
            })
            return false;
        });
        $("#insert_crowd_grade").click(function () {
            var crindex = $("#gradeindex").val();
            var newindex = parseInt(crindex) + 1;
            $("#crowdlevel").append(
             " <div id=\"div"+newindex+"\"> " +
             "<div class=\"form-group\"> " +
             "<label class=\"col-sm-1\">标题：</label> " +
             "<input class=\"col-sm-3\" maxlength=\"100\" name=\"grade"+newindex+"[]\" type=\"text\" id=\"grade"+newindex+"\" />" +
             "<span class=\"form_tips\">众筹档次标题。</span> " +
             "</div> " +
             "<div class=\"form-group\"> " +
             "<label class=\"col-sm-1\">描述：</label> " +
             "<textarea class=\"col-sm-3\" maxlength=\"100\" name=\"grade"+newindex+"[]\" type=\"text\" id=\"grade"+newindex+"\" />" +
             "<span class=\"form_tips\">众筹档次描述。</span> </div> <div class=\"form-group\"> <label class=\"col-sm-1\">价格：</label> " +
             "<input class=\"col-sm-3\" maxlength=\"100\" name=\"grade"+newindex+"[]\" type=\"text\" id=\"grade"+newindex+"\" /><spanclass=\"form_tips\">档次价格。</span> </div> " +
             "<div class=\"form-group\"> <label class=\"col-sm-1\">众筹最多人数目：</label> <input class=\"col-sm-3\" maxlength=\"100\" name=\"grade"+newindex+"[]\" type=\"number\" id=\"grade"+newindex+"\" /><span class=\"form_tips\">大于0的整数。</span> </div>" +
            " <div class=\"form-group\"> <label class=\"col-sm-1\">是否抽奖：</label> <select class=\"col-sm-3\"  name=\"grade"+newindex+"[]\" type=\"text\" id=\"grade"+newindex+"\" > <option value=\"1\">否 </option> <option value=\"2\">是 </option> </select> <span class=\"form_tips\">是否是抽奖众筹。</span></div>"
               +"     <input class=\"col-sm-3\" maxlength=\"100\" name=\"grade"+newindex+"[]\" type=\"hidden\" id=\"grade"+newindex+"\" value=\"0\"/>"+
                 " <div class=\"form-group\"> <label class=\"col-sm-1\">众筹多少人开一次奖：</label> <input class=\"col-sm-3\" maxlength=\"100\" name=\"grade"+newindex+"[]\" type=\"number\" id=\"grade"+newindex+"\" value=\"20\"/><spanclass=\"form_tips\">非抽奖众筹可以不填写</span> </div>"
                 +
             " </div>"
            );
            $("#gradeindex").val(newindex);


        });

        $('#editor_plan_btn').click(function () {
            var dialog = K.dialog({
                width: 200,
                title: '输入欲插入表格行数',
                body: '<div style="margin:10px;"><input id="edit_plan_input" style="width:100%;"/></div>',
                closeBtn: {
                    name: '关闭',
                    click: function (e) {
                        dialog.remove();
                    }
                },
                yesBtn: {
                    name: '确定',
                    click: function (e) {
                        var value = $('#edit_plan_input').val();
                        if (!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value)) {
                            alert('请输入数字！');
                            return false;
                        }
                        value = parseInt(value);
                        var html = '<table class="deal-menu">';
                        html += '<tr><th class="name" colspan="2">套餐内容</th><th class="price">单价</th><th class="amount">数量/规格</th><th class="subtotal">小计</th></tr>';
                        for (var i = 0; i < value; i++) {
                            html += '<tr><td class="name" colspan="2">内容' + (i + 1) + '</td><td class="price">¥</td><td class="amount">1份</td><td class="subtotal">¥</td></tr>';
                        }
                        html += '</table>';
                        html += '<p class="deal-menu-summary">价值: <span class="inline-block worth">¥</span><?php echo ($config["group_alias_name"]); ?>价： <span class="inline-block worth price">¥</span></p><br/><br/>介绍...';
                        content_editor.appendHtml(html);

                        dialog.remove();
                    }
                },
                noBtn: {
                    name: '取消',
                    click: function (e) {
                        dialog.remove();
                    }
                }
            });
        });

        $('#get_key_btn').click(function () {
            var s_name = $('input[name="s_name"]');
            s_name.val($.trim(s_name.val()));
            $('#keywords').val($.trim($('#keywords').val()));
            if (s_name.val().length == 0) {
                alert('请先填写商品名称！');
                s_name.focus();
            } else if ($('#keywords').val().length != 0) {
                alert('请先删除您填写的关键词！');
                $('#keywords').focus();
            } else {
                $.get("<?php echo U('Index/Scws/ajax_getKeywords');?>", {title: s_name.val()}, function (result) {
                    result = $.parseJSON(result);
                    if (result.num == 0) {
                        alert('您的商品名称没有提取到关键词，请手动填写关键词！');
                        $('#keywords').focus();
                    } else {
                        $('#keywords').val(result.list.join(' ')).focus();
                    }
                });
            }
        });
    });
    function deleteImage(path, obj) {
        $.post("<?php echo U('Group/ajax_del_pic');?>", {path: path});
        $(obj).closest('.upload_pic_li').remove();
    }
    function deletevideoImage(path, obj) {
        $.post("<?php echo U('Group/ajax_del_pic');?>", {path: path});
        $(obj).closest('.upload_pic_liv').remove();
    }

    function deleteinvatorImage(path, obj) {
        $.post("<?php echo U('Group/ajax_del_pic');?>", {path: path});
        $(obj).closest('.upload_pic_lii').remove();
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