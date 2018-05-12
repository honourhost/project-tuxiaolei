
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
    <script src="http://gf.lixiaopeng.top/assets/public/js/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
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

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
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
            <div class="user-panel">
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
                    <a href="/user/node">
                        <i class="fa fa-sitemap"></i> <span>订单统计</span>
                    </a>
                </li>

                <li>
                    <a href="/user/profile">
                        <i class="fa fa-user"></i> <span>销售额统计</span>
                    </a>
                </li>




            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>