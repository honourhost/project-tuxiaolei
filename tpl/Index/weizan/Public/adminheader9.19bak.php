<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>小农丁实时数据</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="http://gf.lixiaopeng.top/assets/public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="http://cdn.bootcss.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Ionicons -->
    <link href="http://cdn.bootcss.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link href="http://gf.lixiaopeng.top/assets/public/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="http://gf.lixiaopeng.top/assets/public/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>

    <!-- jQuery 2.1.3 -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/echarts/3.7.1/echarts.min.js"></script>
    <script src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.js?_v_=1504168215640"></script>
    <script src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js?_v_=1504168215640"></script>
    <script src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js?_v_=1504168215640"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<style>

	.main-header .logo{
		height: 100px;
		line-height: 100px;
		font-size: 22px;
	}
	.main-sidebar, .left-side{
		padding-top: 100px;
	}
	.main-header .sidebar-toggle{
		padding: 35px 15px;
		font-size: 22px;
	}
	.skin-blue .main-header .logo:hover{
		background: #222D32;
	}
	.skin-blue .main-header .logo{
		color: #86c131;
		background: #000000;
	}
	.skin-blue .sidebar-menu>li>a:hover, .skin-blue .sidebar-menu>li.active>a{
		color: #86c131;
		border-left-color: #86c131;
	}
	.skin-blue .sidebar-menu>li>a{
		margin-left: 35px;
	}
	.skin-blue .sidebar a{
		color: #86c131;
	}
	.skin-blue .main-header .navbar{
		background: #000000;
	}
	.skin-blue .main-header .navbar .sidebar-toggle{
		color: #86c131;
	}
	#number{
		font-size: 40px;
		position: relative;
		top: 5px;
	}
</style>
<body class="skin-blue">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <a href="/user" class="logo">小农丁实时数据</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu" style="float: left;margin-left: 10px;">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu" >
                        <div class="count" style="text-align: center;color: #91C7AE; position: relative; top: -20px; max-height: 100px;padding: 35px 15px; font-size: 22px;">当前订单：<span id="number"></span></div>
                    </li>

                </ul>
            </div>
            <div class="navbar-custom-menu" style="float: left;margin-left: 10px;">
                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu" >
                        <div class="count" style=" text-align: center;color: #D19844;  top: -20px; max-height: 100px;padding: 35px 15px; font-size: 22px;position: relative;">累计销售额：<span id="number1" style="font-size: 40px;    position: relative;
    top: 5px;"></span></div>
                    </li>
                </ul>
            </div>
            <div class="navbar-custom-menu" style="float: left;margin-left: 10px;">
                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu" >
                        <div class="count" style=" text-align: center;color: #DD4B39;  top: -20px; max-height: 100px;padding: 35px 15px; font-size: 22px;position: relative;">累计用户：<span id="number2" style="font-size: 40px;    position: relative;
    top: 5px;">249830</span></div>
                    </li>
                </ul>
            </div>
            <div class="navbar-custom-menu"  style="display: none;">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="ttps://secure.gravatar.com/avatar/d2d89795f65026f8986213e9d832f12b" class="user-image" alt="User Image"/>
                            <span class="hidden-xs">fuck</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="ttps://secure.gravatar.com/avatar/d2d89795f65026f8986213e9d832f12b" class="img-circle" alt="User Image"/>

                                <p>
                                    adam
                                    <small>adam</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/user/profile" class="btn btn-default btn-flat">个人信息</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/user/logout" class="btn btn-default btn-flat">退出</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel" style="display: none;">
                <div class="pull-left image">
                    <img src="https://secure.gravatar.com/avatar/d2d89795f65026f8986213e9d832f12b" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info" style="display: none;">
                    <p>ADAM</p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li>
                    <a href="{pigcms{:U('Chart/userstatis')}">
                        <i class="fa fa-dashboard"></i> <span>用户统计</span>
                    </a>
                </li>
                <li>
                    <a href="{pigcms{:U('Chart/chain')}">
                        <i class="fa fa-sitemap"></i> <span>供应链仓统计</span>
                    </a>
                </li>
                <li>
                    <a href="{pigcms{:U('Chart/orderstatis')}">
                        <i class="fa fa-sitemap"></i> <span>产品销售统计</span>
                    </a>
                </li>

                <li>
                    <a href="{pigcms{:U('Chart/salestatis')}">
                        <i class="fa fa-user"></i> <span>订单交易统计</span>
                    </a>
                </li>

<div style="clear: both;"></div>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>