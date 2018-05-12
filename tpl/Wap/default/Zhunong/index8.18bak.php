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
					<div class="banner-bg" style="background-image: url({pigcms{$static_path}image/zhunong/banner.jpg);">
					</div>
					<div class="zhunong">
						<img src="{pigcms{$static_path}image/zhunong/zhunong.png" />
					</div>
					<div class="fx-content">
						<div class="title-top">
						<p class="title" style="display: none;">
							<b>善良</b>是一种选择<br/>
							选择分享<br />
							即可为贫困农民创收<br />
						</p>
						<h3 style="display: none;">跟小农丁一起行动<br />让爱接力前行</h3>
						</div>
						<div class="fx-my">
							<div class="fx-my-img" style="background-image: url({pigcms{$user.avatar});"></div>
							<h3>{pigcms{$user.nickname}</h3>
							<p>
								<i>我是<b>{pigcms{$user.nickname}</b>，</i><br />
								第<b>{pigcms{$successnum}</b>位爱心助农者，我不会为贫困老农捐款，但我会为匠心精神买单。
							</p>
						</div>
					</div>
					<div class="ma">
						<img src="{pigcms{$static_path}image/zhunong//erweima.jpg" />
					</div>
				</div>
			</div>
			
			
			
    <div class="fenxiang">
        <h3>为爱分享</h3>
		<p>动动手指，或许就能改善他们的生活</p>
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
<script src="{pigcms{$static_path}js/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
            $(function(){
                //改变div的高度
                $(".banner").height($(window).height());
                $(".banner-bg").height($(window).height());
            });
        </script>
</body>
</html>
