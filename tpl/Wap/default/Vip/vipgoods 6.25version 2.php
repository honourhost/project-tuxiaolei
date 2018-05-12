<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/vip/common22.css" media="all">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/vip/color22.css" media="all">
    <script type="text/javascript" src="{pigcms{$static_path}/vip/jquery_min.js"></script>
    <title>商品兑换</title>
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <!-- Mobile Devices Support @begin -->
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- apple devices fullscreen -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- Mobile Devices Support @end -->
</head>
<style type="text/css">
    #dingcai_adress_info {
        border-top: 1px solid #ddd8ce;
        border-bottom: 1px solid #ddd8ce;
        position: relative;
    }

    #dingcai_adress_info:after {
        position: absolute;
        right: 8px;
        top: 50%;
        display: block;
        content: '';
        width: 13px;
        height: 13px;
        border-left: 3px solid #999;
        border-bottom: 3px solid #999;
        -webkit-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
        -moz-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
        -ms-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
    }

    #enter_im_div {
        bottom: 121px;
        z-index: 11;
        display: none;
        position: fixed;
        width: 100%;
        max-width: 640px;
        height: 1px;
    }

    #enter_im {
        width: 94px;
        margin-left: 110px;
        position: relative;
        left: -100px;
        display: block;
    }

    a {
        color: #323232;
        outline-style: none;
        text-decoration: none;
    }

    #to_user_list {
        height: 30px;
        padding: 7px 6px 8px 8px;
        background-color: #00bc06;
        border-radius: 25px;
        /* box-shadow: 0 0 2px 0 rgba(0,0,0,.4); */
    }

    #to_user_list_icon_div {
        width: 20px;
        height: 16px;
        background-color: #fff;
        border-radius: 10px;
    }

    .rel {
        position: relative;
    }

    .left {
        float: left;
    }

    .to_user_list_icon_em_a {
        left: 4px;
    }

    #to_user_list_icon_em_num {
        background-color: #f00;
    }

    #to_user_list_icon_em_num {
        width: 14px;
        height: 14px;
        border-radius: 7px;
        text-align: center;
        font-size: 12px;
        line-height: 14px;
        color: #fff;
        top: -14px;
        left: 68px;
    }

    89076208 .hide {
                 display: none;
             }

    .abs {
        position: absolute;
    }

    .to_user_list_icon_em_a,
    .to_user_list_icon_em_b,
    .to_user_list_icon_em_c {
        width: 2px;
        height: 2px;
        border-radius: 1px;
        top: 7px;
        background-color: #00ba0a;
    }

    .to_user_list_icon_em_a {
        left: 4px;
    }

    .to_user_list_icon_em_b {
        left: 9px;
    }

    .to_user_list_icon_em_c {
        right: 4px;
    }

    .to_user_list_icon_em_d {
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 4px;
        top: 14px;
        left: 6px;
        border-color: #fff transparent transparent transparent;
    }

    #to_user_list_txt {
        color: #fff;
        font-size: 13px;
        line-height: 16px;
        padding: 1px 3px 0 5px;
    }
</style>
<script type="text/javascript" src="{pigcms{$static_path}/vip/dialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}/vip/scroller.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}/vip/dmain.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}/vip/menu.js"></script>

<body onselectstart="return true;" ondragstart="return false;">
<script type="text/javascript">

    var islock = false;

    function next() {
        totalPrice = parseFloat($.trim($('#allmoney').text()));
        totalNum = parseInt($.trim($('#menucount').text()));
        if((totalNum > 0) && (totalPrice > 0)) {
            var data = getMenuChecklist(); //[{'id':id,'count':count},{'id':id,'count':count}]
            if((data.length > 0) && !islock) {
                islock = true;
                $('#nextstep').removeClass('orange show').addClass('gray disabled');
                $.ajax({
                    type: "POST",
                    url: "/wap.php?g=Wap&c=Vip&a=processOrder&mer_id=629",
                    data: { "cart": data },
                    async: true,
                    success: function(res) {
                        islock = false;
                        $('#nextstep').removeClass('gray disabled').addClass('orange show');
                        if(res.error == 0) {
                            window.location.href = "/wap.php?g=Wap&c=Vip&a=sureorder&mer_id=629";
                        } else {
                            alert(res.msg);
                        }
                    },
                    dataType: "json"
                });
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
</script>
<style>
			body{
				background: #665b69;
			}
			.menudesc {
				width: 100%;
				height: 36px;
				line-height: 36px;
				overflow: hidden;
			}
			
			#menuList .licontent>div {
				display: block;
			}
			
			.menudesc h3 {
				float: left;
				display: inline-block;
				max-width: 100%;
				position: relative;
				left: -7px;
				font-size: 16px;
				font-weight: 100;
			}
			
			.menudesc p {
				float: right;
				display: inline-block;
				position: relative;
				top: -5px;
			}
			
			.salenum {
				padding-top: 0px;
				line-height: 20px;
			}
			
			.lf-img {
				float: left;
			}
			
			.price_wrap2 {
				
				width: 90px;
				margin: 0px auto;
			}
			
			.list-imgs {
				width: 100%;
				height: 230px;
				background-position: 50% 50%;
				background-repeat: no-repeat;
				background-size: cover;
			}
			
			.list-cons {
				margin: 0px 10px;
				margin-top: 15px;
				padding-bottom: 15px;
			}
			
			.list-left {
				float: left;
			}
			
			.list-left img {
				width: 90px;
				height: 90px;
				border-radius: 100%;
				overflow: hidden;
			}
			
			.left-right {
				float: right;
				width: 65%;
				text-align: center;
				position: relative;
			}
			
			.left-right h4 {
				font-size: 16px;
				color: #000;
				height: 40px;
				font-weight: 100;
				overflow: hidden;
			}
			
			.banner-top {
				width: 100%;
			}
			
			.banner-top img {
				width: 100%;
				display: block;
				
			}
			
			.list-nav {
				width: 100%;
				height: 45px;
				background: #fff;
			}
			
			.list-nav ul li {
				float: left;
				width: 33.333%;
				text-align: center;
				height: 45px;
				line-height: 45px;
				text-align: center;
			}
			
			.list-nav ul li a {
				display: block;
				width: 100%;
				font-size: 16px;
			}
			.fix{
				position: fixed;
				left: 0;
				top: 0;
				width: 100%;
				height: 45px;
				z-index: 10000;
				background: #fff;
			}
			.list-nav li.on{
				background: #fead78;
				
			}
			.list-nav li.on a{
				color: #fff;
			}
			.nav-banner{
				width: 100%;
				margin-bottom: 15px;
			}
			.nav-banner img{
				width: 100%;
			}
		</style>
<div data-role="container" class="container menu">
    <section data-role="body">
    	<div class="banner-top">
			<img src="{pigcms{$static_path}vip/list-banner.jpg" />
		</div>
		<div class="list-nav" style="display: none;">
			<ul>
				<li class="on">
					<a href="#fenlei01">肉类</a>
				</li>
				<li>
					<a href="#fenlei02">菌类</a>
				</li>
				<li>
					<a href="#fenlei03">饮品类</a>
				</li>
			</ul>
		</div>
        <div class="right" id="usermenu">
            <div class="all" id="menuList">
            	<a name="fenlei01"></a>
                <ul id="ul_type284">
                	<div class="nav-banner">
						<img src="{pigcms{$static_path}vip/nav-img01.jpg" />
					</div>
                    <volist name="groups" id="group">
                        
                        <li id="dish_li{pigcms{$group.group_id}">
                            <div class="list-imgs" style="background-image: url({pigcms{$group.pic});">

                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="{pigcms{$group.pic}" />
                                </div>
                                <div class="left-right">
                                    <h4>{pigcms{$group.s_name}</h4>
                                    <div class="price_wrap">
                                        <strong>￥<span class="unit_price">{pigcms{$group.price}<input type="hidden" class="tureunit_price" value="{pigcms{$group.price}"></span>
                                            <del>原价：{pigcms{$group.old_price}</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="{pigcms{$group.group_id}">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[{pigcms{$group.group_id}]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li>
                    </volist>
                </ul>
                
                
                
                <a name="fenlei02"></a>
                <ul id="ul_type284" style="display: none;">
                	<div class="nav-banner">
						<img src="{pigcms{$static_path}vip/nav-img01.jpg" />
					</div>
                    <volist name="groups" id="group">
                        <li id="dish_li{pigcms{$group.group_id}">
                            <div class="list-imgs" style="background-image: url({pigcms{$group.pic});">

                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="{pigcms{$group.pic}" />
                                </div>
                                <div class="left-right">
                                    <h4>{pigcms{$group.s_name}</h4>
                                    <div class="price_wrap">
                                        <strong>￥<span class="unit_price">{pigcms{$group.price}<input type="hidden" class="tureunit_price" value="{pigcms{$group.price}"></span>
                                            <del>原价：{pigcms{$group.old_price}</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="{pigcms{$group.group_id}">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[{pigcms{$group.group_id}]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li>
                    </volist>
                </ul>
                <a name="fenlei03"></a>
                <ul id="ul_type284" style="display: none;">
                	<div class="nav-banner">
						<img src="{pigcms{$static_path}vip/nav-img01.jpg" />
					</div>
                    <volist name="groups" id="group">
                        <li id="dish_li{pigcms{$group.group_id}">
                            <div class="list-imgs" style="background-image: url({pigcms{$group.pic});">

                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="{pigcms{$group.pic}" />
                                </div>
                                <div class="left-right">
                                    <h4>{pigcms{$group.s_name}</h4>
                                    <div class="price_wrap">
                                        <strong>￥<span class="unit_price">{pigcms{$group.price}<input type="hidden" class="tureunit_price" value="{pigcms{$group.price}"></span>
                                            <del>原价：{pigcms{$group.old_price}</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="{pigcms{$group.group_id}">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[{pigcms{$group.group_id}]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li>
                    </volist>
                </ul>
            </div>
            <div style="width: 100%; height: 50px;"></div>
        </div>
    </section>
</div>
<footer data-role="footer">
    <nav class="g_nav">
        <div>
            <span class="cart"></span>
            <span> <span class="money">￥<label id="allmoney">0</label> </span>/<label id="menucount">0</label>个商品</span>
            <a href="javascript:next();" class="btn gray disabled" id="nextstep">选好了</a>
        </div>
    </nav>
</footer>
<div class="alert-div">
    <div class="alert-bg"> </div>
    <div class="dialog mask">
        <div class="dialog_wrap">
            <div class="dialog_tt">壹加壹带骨腹肉1kg</div>
            <a href="javascript:void(0);" class="dialog_close"></a>
            <div class="dialog_scroller" style="height: 398px;">
                <div class="menu_detail dialog_content" id="menuDetail" style="display: block;">
                    <img style="" src="http://www.xiaonongding.com/upload/group/000/000/890/s_59707ada7f9d3.jpg">
                    <div class="nopic" style="display: none;"></div>
                    <a href="javascript:void(0);" class="comm_btn" id="detailBtn">来一</a>
                    <dl>
                        <dt>价格：</dt>
                        <dd class="highlight">￥<span class="price">166.00</span></dd>
                    </dl>
                    <p class="sale_desc"></p>
                    <dl class="desc">
                        <dt>介绍：</dt>
                        <dd class="info">位于牛胸腹部，第2肋-第5肋。主要由肋间内肌、肋间外肌、腹外斜肌等肌肉组织。带骨腹肉又称：小牛排、牛仔骨肌间有脂肪，有筋膜层，表面有不均匀脂肪覆盖。用作火锅切片、韩式牛排火锅、韩式烤肉及西餐牛排。</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>



</body>
<script>
    $(document).ready(function(){
        $(".list-imgs").click(function(){
            $('.alert-div').show();
        });
        $(".alert-bg").click(function(){
            $('.alert-div').hide();
        });
    });
</script>
<script>
			$(function() {
				var nav = $(".list-nav"); //得到导航对象
				var banner = $('.banner-top').height();
				var win = $(window); //得到窗口对象
				var sc = $(document); //得到document文档对象。
				win.scroll(function() {

					if(sc.scrollTop() >= banner) {
						nav.addClass("fix");
					} else {

						nav.removeClass("fix");
					}

				});
			});
		</script>
		<script>
			$(document).ready(function() {
				$(".list-nav ul li").click(function() {
					$(this).addClass('on');
					$(this).siblings('.on').removeClass('on');
				});
			
			});
			
			
		</script>
<script type="text/javascript">
    window.shareData = {
        "moduleName":"Vip",
        "moduleID":"0",
        "imgUrl": "{pigcms{$static_path}/vip/share.jpg",
        "sendFriendLink": "http://www.xiaonongding.com/wap.php?g=Wap&c=Vip",
        "tTitle": "农丁鲜生品鲜白金会员专享",
        "tContent": "小农丁为有品の您甄选原产地最优品、最健康的生鲜食材～"
    };
</script>
<script>
</script>
<include file="Public:vipshare"/>

</html>