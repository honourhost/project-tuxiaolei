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
<body class="skin-blue" style="overflow-y: hidden;">
	<header class="main-header">
        <a href="#" class="logo">小农丁实时数据</a>
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
                        <div class="count" style="text-align: center;color: #91C7AE; position: relative; top: -20px; max-height: 100px;padding: 40px 15px; font-size: 22px;">当前订单：<span id="number"><?php echo empty($_GET['orderc'])?'256508':$_GET['orderc'];?></span></div>
                    </li>

                </ul>
            </div>
            <div class="navbar-custom-menu" style="float: left;margin-left: 10px;">
                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu" >
                        <div class="count" style=" text-align: center;color: #D19844;  top: -20px; max-height: 100px;padding: 40px 15px; font-size: 22px;position: relative;">累计销售额：<span id="number1" style="font-size: 40px;    position: relative;
    top: 5px;"><?php echo empty($_GET['moneyc'])?'32643207':$_GET['moneyc'];?></span></div>
                    </li>
                </ul>
            </div>
            <div class="navbar-custom-menu" style="float: left;margin-left: 10px;">
                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu" >
                        <div class="count" style=" text-align: center;color: #DD4B39;  top: -20px; max-height: 100px;padding: 40px 15px; font-size: 22px;position: relative;">累计用户：<span id="number2" style="font-size: 40px;    position: relative;
    top: 5px;"><?php echo empty($_GET['userc'])?'348832':$_GET['userc'];?></span></div>
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
    <iframe class="iframes" scrolling="no" src="http://www.xiaonongding.com/index.php?c=Chart&a=salestatis&orderc=&moneyc=&userc=" frameborder="0" framespacing="0" border="0" style="width: 100%; height: 100%;">
   	
   </iframe>
   <script type="text/javascript">
            $(function(){
                //改变div的高度
                $(".iframes").height($(window).height());
            });

            $(document).ready(function () {
                function magic_number(value) {
                    var num = $("#number");
                    var o=$("#orderc");
                    console.error("magic_number---"+num);
                    num.animate({count: value}, {
                        duration: 500,
                        step: function() {
                            num.text(String(parseInt(this.count)));
                            o.val(parseInt(this.count));

                        }
                    });
                };
                var sum=parseInt($("#number").text());
                console.error("ordercdatta----"+sum);
                function update() {

                    $.getJSON("{pigcms{:U('Chart/jsonreturn')}", function(data) {
                        sum+=data.n;
                        console.error("responsedata--------"+JSON.stringify(data));
                        console.error("updatefunction-------"+sum);
                        magic_number(sum);


                    });
                };

                setInterval(update, 6000);
                //    update();




                function magic_number1(value) {
                    var num1 = $("#number1");
                    var m=$("#moneyc");
                    num1.animate({count: value}, {
                        duration: 500,
                        step: function() {
                            num1.text(String(parseInt(this.count)));
                            m.val(parseInt(this.count));
                        }
                    });
                };
                var sum1 =parseInt($("#number1").text());
                function update1() {

                    $.getJSON("{pigcms{:U('Chart/jsonreturn1')}", function(data) {
                        sum1+=data.n;
                        magic_number1(sum1);
                    });
                };

                setInterval(update1, 6000);
                //      update1();



                function magic_number2(value) {
                    var num2 = $("#number2");
                    var u=$("#userc");
                    num2.animate({count: value}, {
                        duration: 500,
                        step: function() {
                            num2.text(String(parseInt(this.count)));
                            u.text(parseInt(this.count));
                        }
                    });
                };
                var sum2=parseInt($("#number2").text());
                function update2() {

                    $.getJSON("{pigcms{:U('Chart/jsonreturn2')}", function(data) {
                        sum2+=data.n;
                        magic_number2(sum2);
                    });
                };

                setInterval(update2, 6000);
                //   update2();



            });
        </script>
    </body>
    </html>
      

