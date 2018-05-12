<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>{pigcms{$config.seo_title}</title>
    <meta name="keywords" content="{pigcms{$config.seo_keywords}" />
    <meta name="description" content="{pigcms{$config.seo_description}" />
    <link href="{pigcms{$static_path}css/css.css" type="text/css"  rel="stylesheet" />
    <link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/ydyfx.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/index-slider.css"/>
    <script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
    <script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
    <script src="{pigcms{$static_path}js/jquery.nav.js"></script>
    <script src="{pigcms{$static_path}js/navfix.js"></script>
    <script src="{pigcms{$static_path}js/common.js"></script>
    <script src="{pigcms{$static_path}js/index.js"></script>
    <script src="{pigcms{$static_path}js/index.slider.js"></script>
    <if condition="$config['wap_redirect']">
        <script>
            if(/(iphone|ipod|android|windows phone)/.test(navigator.userAgent.toLowerCase())){
            <if condition="$config['wap_redirect'] eq 1">
                window.location.href = './wap.php';
            <else/>
                if(confirm('系统检测到您可能正在使用手机访问，是否要跳转到手机版网站？')){
                    window.location.href = './wap.php';
                }
            </if>
            }
        </script>
    </if>
    <!--[if IE 6]>
    <script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
    <script type="text/javascript">
        /* EXAMPLE */
        DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');

        /* string argument can be any CSS selector */
        /* .png_bg example is unnecessary */
        /* change it to what suits you! */
    </script>
    <script type="text/javascript">DD_belatedPNG.fix('*');</script>
    <style type="text/css">
        body{behavior:url("{pigcms{$static_path}css/csshover.htc");}
        .category_list li:hover .bmbox {filter:alpha(opacity=50);}
        .gd_box{display:none;}
    </style>
    <![endif]-->
</head>
<body>
<div class="header_top">
    <div class="hot cf">
        <div class="loginbar cf">
            <if condition="empty($user_session)">
                <div class="login"><a href="{pigcms{:U('Index/Login/index')}"> 登陆 </a></div>
                <div class="regist"><a href="{pigcms{:U('Index/Login/reg')}">注册 </a></div>
                <else/>
                <p class="user-info__name growth-info growth-info--nav">
					<span>
						<a rel="nofollow" href="{pigcms{:U('User/Index/index')}" class="username">{pigcms{$user_session.nickname}</a>
					</span>
                    <a class="user-info__logout" href="{pigcms{:U('Index/Login/logout')}">退出</a>
                </p>
            </if>
            <div class="span">|</div>
            <div class="weixin cf">
                <div class="weixin_txt"><a href="{pigcms{$config.site_url}/topic/weixin.html" target="_blank"> 微信版</a></div>
                <div class="weixin_icon"><p><span>|</span><a href="{pigcms{$config.site_url}/topic/weixin.html" target="_blank">访问微信版</a></p><img src="{pigcms{$config.wechat_qrcode}"/></div>
            </div>
        </div>
        <div class="list">
            <ul class="cf">
                <li>
                    <div class="li_txt"><a href="{pigcms{:U('User/Index/index')}">我的订单</a></div>
                    <div class="span">|</div>
                </li>
                <li class="li_txt_info cf">
                    <div class="li_txt_info_txt"><a href="{pigcms{:U('User/Index/index')}">我的信息</a></div>
                    <div class="li_txt_info_ul">
                        <ul class="cf">
                            <li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Index/index')}">我的订单</a></li>
                            <li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Rates/index')}">我的评价</a></li>
                            <li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Collect/index')}">我的收藏</a></li>
                            <li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Point/index')}">我的积分</a></li>
                            <li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Credit/index')}">帐户余额</a></li>
                            <li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{:U('User/Adress/index')}">收货地址</a></li>
                        </ul>
                    </div>
                    <div class="span">|</div>
                </li>
                <li class="li_liulan">
                    <div class="li_liulan_txt"><a href="#">最近浏览</a></div>
                    <div class="history" id="J-my-history-menu"></div>
                    <div class="span">|</div>
                </li>
                <li class="li_shop">
                    <div class="li_shop_txt"><a href="#">我是商家</a></div>
                    <ul class="li_txt_info_ul cf">
                        <li><a class="dropdown-menu__item first" rel="nofollow" href="{pigcms{$config.site_url}/merchant.php">商家中心</a></li>
                        <li><a class="dropdown-menu__item" rel="nofollow" href="{pigcms{$config.site_url}/merchant.php">我想合作</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<header class="header cf">
    <pigcms:one_adver cat_key="index_top">
        <div class="content">
            <div class="banner" style="background:{pigcms{$one_adver.bg_color}">
                <div class="hot"><a href="{pigcms{$one_adver.url}" title="{pigcms{$one_adver.name}"><img src="{pigcms{$one_adver.pic}" /></a></div>
            </div>
        </div>
    </pigcms:one_adver>
    <div class="nav cf">
        <div class="logo">
            <a href="{pigcms{$config.site_url}" title="{pigcms{$config.site_name}">
                <img  src="{pigcms{$config.site_logo}" />
            </a>
        </div>
        <div class="search">
            <form action="{pigcms{:U('Group/Search/index')}" method="post" group_action="{pigcms{:U('Group/Search/index')}" meal_action="{pigcms{:U('Meal/Search/index')}">
                <div class="form_sec">
                    <div class="form_sec_txt group">{pigcms{$config.group_alias_name}</div>
                    <div class="form_sec_txt1 meal">{pigcms{$config.meal_alias_name}</div>
                </div>
                <input name="w" class="input" type="text" placeholder="请输入商品名称、地址等"/>
                <button value="" class="btnclick"><img src="{pigcms{$static_path}images/o2o1_20.png"  /></button>
            </form>
            <div class="search_txt">
                <volist name="search_hot_list" id="vo">
                    <a href="{pigcms{$vo.url}"><span>{pigcms{$vo.name}</span></a>
                </volist>
            </div>
        </div>
        <div class="menu">
            <div class="ment_left">
                <div class="ment_left_img"><img src="{pigcms{$static_path}images/o2o1_13.png" /></div>
                <div class="ment_left_txt">随时退</div>
            </div>
            <div class="ment_left">
                <div class="ment_left_img"><img src="{pigcms{$static_path}images/o2o1_15.png" /></div>
                <div class="ment_left_txt">不满意免单</div>
            </div>
            <div class="ment_left">
                <div class="ment_left_img"><img src="{pigcms{$static_path}images/o2o1_17.png" /></div>
                <div class="ment_left_txt">过期退</div>
            </div>
        </div>
    </div>
</header>

<menu class="shop_menu">
    <div class="box_menu" id="mealallprolist">
        <ul>
            <li <if condition="$isindex">class="crun"</if>><a href="{pigcms{$config.site_url}/merindex/{pigcms{$merid}.html">首页</a></li>
            <volist name="navmanag" id="nv">
                <li <if condition="$nv['currenturl']">class="crun"</if>><a href="{pigcms{$config.site_url}/{pigcms{$nv['url']}/{pigcms{$merid}.html">{pigcms{$nv['zhname']}</a></li>
            </volist>
            <div style="clear:both"></div>
        </ul>
    </div>
</menu>
<!---<menu class="shop_menu">
  <div class="box_menu">
    <ul>
      <li class="crun"><a href="shop_shop.html">首页</a></li>
      <li><a href="shop_introduction.html">商家介绍</a></li>
      <li><a href="shop_dynamics.html">商家动态 </a></li>
      <li><a href="shop_photo.html">商家相册</a></li>
      <li><a href="shop_video.html">全景视频 </a></li>
      <li><a href="shop_goods.html">商品大全</a></li>
      <li><a href="shop_activity.html">{pigcms{$config.group_alias_name}活动 </a></li>
      <li><a href="shop_server.html">客户服务</a></li>
      <li><a href="shop_jion.html">招商加盟</a></li>
      <li><a href="shop_comment.html">网友点评</a></li>
      <div style="clear:both"></div>
    </ul>
  </div>
</menu>--->