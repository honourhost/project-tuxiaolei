<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>{pigcms{$config.seo_title}</title>
    <meta name="keywords" content="{pigcms{$config.seo_keywords}" />
    <meta name="description" content="{pigcms{$config.seo_description}" />
    <link href="http://www.xiaonongding.com/upload/icon/icon.jpg" rel="SHORTCUT ICON" />
    <!-- 王强新增 -->
    <link href="{pigcms{$static_path}css/xnd_css/frame_block.css" rel="stylesheet" /><!-- 全局基础样式 -->
    <link href="{pigcms{$static_path}css/xnd_css/index_block.css" rel="stylesheet" /> <!--首页版块样式 -->
    <link href="{pigcms{$static_path}css/xnd_css/shop-list.css" rel="stylesheet" type="text/css"><!-- 底部公用样式 -->
    <link href="{pigcms{$static_path}css/xnd_css/headerfoot_black.css" rel="stylesheet" /><!-- 头部样式 -->
    <link href="{pigcms{$static_path}css/xnd_css/footer.css.css" rel="stylesheet" type="text/css"><!-- 底部公用样式 -->
    <script src="{pigcms{$static_path}js/xnd_js/frame_block.js"></script><!-- 焦点图左侧大导航js -->
    <script src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
    <!--[if lte IE 8]>
    <script src="{pigcms{$static_path}js/xnd_js/respond.min.js"></script>
    <![endif]-->
    <!-- 王强新增end -->



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

    </head>
<body>
<include file="Public:head_topnew"/>
<include file="Public:footer"/>
</body>
</html>