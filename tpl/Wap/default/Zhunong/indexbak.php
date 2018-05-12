<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <title>为爱分享</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/zhunong/base.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/zhunong/style.css"/>
</head>
<body>
<div class="public-main">
    <div class="tops">
        <div class="banner">
            <img src="{pigcms{$static_path}image/zhunong/banner.jpg" />
        </div>
        <div class="my-logo">
            <div class="logos" style="background-image: url({pigcms{$user.avatar});">
            </div>
            <h3>{pigcms{$user.nickname}</h3>
            <p>我是资深小吃货,<br />第<b>{pigcms{$successnum}</b>位爱心助农者,我不会为贫穷老农捐款,但我一定会为匠心精神买单。</p>
        </div>
    </div>
    <div class="fenxiang">
        <img src="{pigcms{$static_path}image/zhunong/biaoti.jpg" />
    </div>
    <div class="list">
        <ul>
            <volist name="goods" id="good">
                <li>
                    <a href="{pigcms{:U('Group/detail',array('group_id'=>$good['group_id']))}">
                        <div class="imgs" style="background-image: url(<?php echo $good['all_pic'][0]['image'];?>);"></div>
                        <div class="con">
							<span class="xnd-logo">
								<img src="{pigcms{$static_path}image/zhunong/xnd-logos.jpg">
							</span>
                            <div class="xnd-con">
                                <?php echo $good['intro'];?>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </a>
                </li>
            </volist>


        </ul>
    </div>
    <div class="footer">
        <img src="{pigcms{$static_path}image/zhunong/logo.png" />
    </div>
</div>
<script type="text/javascript">
    window.shareData = {
        "moduleName":"Zhunong",
        "moduleID":"0",
        "imgUrl": "http://www.xiaonongding.com/upload/channelshare/{pigcms{$channel.share_pic}",
        "sendFriendLink": "{pigcms{$config.site_url}{pigcms{:U('Zhunong/index', array('topic' => 'aixinzhunong1'))}",
        "tTitle": "{pigcms{$channel.share_title}",
        "tContent": "{pigcms{$channel.share_desc}"
    };
</script>
<include file="Public:crowdshare"/>
</body>
</html>
