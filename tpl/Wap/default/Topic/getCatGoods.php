<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{pigcms{$channel.name}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telphone=no, email=no"/>
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/new-common.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/new-xnd-gansu.css"/>
    <script type="text/javascript" src="{pigcms{$static_path}js/hhSwipe.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
</head>
<body style="background: #ae0001;">
<div class="public_cen">


    <!-- nav -->
    <div class="phone-gansu-tj-nav">

        <ul>
            <volist name="goods" id="good">
                <li>
                    <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id={pigcms{$good.group_id}">
                        <div class="phone-gansu-tj-img" style="background-image: url({pigcms{$good.all_pic.0.m_image});"></div>
                        <div class="phone-gansu-tj-right">
                            <h3>{pigcms{$good.s_name}</h3>
                            <p>{pigcms{$good.group_name}</p>
                            <div class="phone-gansu-tj-btm">
                                <span>销售：<php>echo $good['sale_count']+$goods['virtual_num'];</php></span>
                                <h4><b>{pigcms{$good.price}元</b>/份</h4>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </a>
                </li>
            </volist>
        </ul>
        <div style="clear: both;"></div>
    </div>

    <div class="copy_footer"><img src="{pigcms{$static_path}images/xnd-logo.png"></div>
</div>

<style>
    .fox-right{
        position: fixed;
        bottom: 20px;
        right: 2%;
        z-index: 10000000;
        display: none;
    }
    .fox-right img{
        width: 40px;
    }
</style>
<div class="fox-right" id="btn_top">
    <a href="#"><img src="{pigcms{$static_path}images/gansu-top.png" /></a>
</div>
<script>
    $(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 150) {
                $('#btn_top').fadeIn();
            }
            else {
                $('#btn_top').fadeOut();
            }
        });
    });
    $('#btn_top').click(function () {
        $('html,body').animate({ scrollTop: 0 }, 500);
    });
</script>


<!--分享-->
<script type="text/javascript">
    var shareData={
            imgUrl: "{pigcms{$config.site_url}/upload/channelshare/{pigcms{$channel.share_pic}",
        <if condition="$_SESSION['distribution_id']">
        link: "{pigcms{$config.site_url}{pigcms{:U('Topic/index', array('topic' => $channel['url'],'share_distribution_id'=>$_SESSION['distribution_id']))}",
    <elseif condition="$_SESSION['share_distribution_id']"/>
        link: "{pigcms{$config.site_url}{pigcms{:U('Topic/index', array('topic' => $channel['url'],'share_distribution_id'=>$_SESSION['share_distribution_id']))}",
    <else/>
    link: "{pigcms{$config.site_url}{pigcms{:U('Topic/index', array('topic' => $channel['url']))}",
    </if>
    title: "{pigcms{$channel.share_title}",
        desc: "{pigcms{$channel.share_desc}"
    };
</script>
<include file="Share:share"/>
</body>
</html>
