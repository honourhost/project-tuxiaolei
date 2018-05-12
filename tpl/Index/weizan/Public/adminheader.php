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
	*{
		margin: 0;
		padding: 0;
	}
	ul,li{
		list-style-type: none;
	}
	body{
		background: #222d32;
	}
	.main-header{
		background: #000;
		height: 100px;
		overflow: hidden;
	}
	.main-header .logo{
		height: 100px;
		line-height: 100px;
		float: left;
	}
	.main-header>.navbar{
		margin-left: 0;
	}
	.main-sidebar, .left-side{
		position: static;
		width: 18%;
		float: left;
		display: inline-block;
		height: 100%;
		padding-top: 20px;
	}
	.content-wrapper, .right-side{
		margin-left: 18%;
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
		display: block;
		width: 20%;
		text-align: center;
		font-size: 30px;
	}
	.skin-blue .sidebar-menu>li>a:hover, .skin-blue .sidebar-menu>li.active>a{
		color: #86c131;
		border-left-color: #86c131;
	}
	.skin-blue .sidebar-menu>li>a{
		margin-left: 0px;
	}
	.skin-blue .sidebar-menu li a{
		margin-left: 0;
		display: block;
		width: 100%;
	}
	.skin-blue .sidebar a{
		color: #86c131;
	}
	.sidebar-menu li{
		height: auto;
		padding: 5px 0px;
	}
	.skin-blue .main-header .navbar{
		background: #000000;
		width: 80%;
		float: left;
	}
	.skin-blue .main-header .navbar .sidebar-toggle{
		color: #86c131;
		display: none;
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