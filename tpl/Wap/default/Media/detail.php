<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>{pigcms{$config.site_name}</title>
    <meta name="description" content="{pigcms{$config.seo_description}">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <link href="/tpl/Wap/default/static/css/mp_news.css" rel="stylesheet"/>
    <style>
        img {
            -webkit-tap-highlight-color: transparent;
        }

        .header-top {
            width: 100%;
            background: url(/tpl/Wap/default/static/images/footer-bg.png);
            padding: 8px 0px 5px 0px;
            position: fixed;
            bottom: 0;
            left: 0;
            z-index: 1000000;
            color: #fff;
        }

        .header-logo {
            width: 38px;
            height: 38px;
            float: left;
            margin-left: 15px;
            margin-right: 5px;
            position: relative;
            top: 2px;
        }

        .header-logo img {
            width: 38px;
            height: 38px;
            border-radius: 5px;
        }

        .header-gz h3 {
            float: left;
            font-size: 14px;
            display: inline-block;
            max-width: 50%;
            overflow: hidden;
            margin-left: 5px;
        }

        .header-gz {
            float: right;
            display: block;
            margin-right: 15px;
            width: 70px;
            height: 30px;
            line-height: 30px;
            margin-top: 5px;
            font-size: 14px;
            text-align: center;
            border-radius: 15px;
            color: #fff;
            background: #f6d95a;
        }

        @font-face {
            font-family: "iconfont";
            src: url('/tpl/Wap/default/static/css/iconfont.eot'); /* IE9*/
            src: url('/tpl/Wap/default/static/css/iconfont.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */ url('/tpl/Wap/default/static/css/iconfont.woff') format('woff'), /* chrome, firefox */ url('/tpl/Wap/default/static/css/iconfont.ttf') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/ url('/tpl/Wap/default/static/css/iconfont.svg#iconfont') format('svg'); /* iOS 4.1- */
        }

        .iconfont {
            font-family: "iconfont" !important;
            font-size: 16px;
            font-style: normal;
            -webkit-font-smoothing: antialiased;
            -webkit-text-stroke-width: 0.2px;
            -moz-osx-font-smoothing: grayscale;
        }

        .icon-shoucang:before {
            content: "\e61f";
        }

        .icon-shoucang1:before {
            content: "\e66e";
        }

        .icon-dianzan:before {
            content: "\e680";
        }

        .icon-dianzan1:before {
            content: "\e699";
        }

        .icon-liuyan:before {
            content: "\e744";
        }

        .icon-fenxiang:before {
            content: "\e689";
        }

        .rich_media_meta_list {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .rich_media_title_main {
            width: 100%;
            position: relative;
        }

        .rich_media_title {
            width: 100%;
            height: auto;
            overflow: hidden;
            float: left;
            line-height: 24px;
            font-weight: 700;
            font-size: 20px;
            word-wrap: break-word;
            -webkit-hyphens: auto;
            -ms-hyphens: auto;
            -moz-hyphens: auto;
            hyphens: auto;
        }

        .rich_media_sc {
            float: right;
            width: 20%;
            display: inline-block;
            text-align: center;
            color: #aeaeae;
            height: 45px;
            border-left: 1px solid #cdcdcd;
            position: absolute;
            right: -15px;
            font-size: 14px;
        }

        .dq i {
            display: block;
            width: 100%;
            text-align: center;
            font-size: 26px;
            position: relative;
            line-height: 24px;
            color: #858585;
        }

        .on {
            display: none;
            color: #ce5c26;
        }

        .on i {
            display: block;
            width: 100%;
            text-align: center;
            font-size: 26px;
            position: relative;
            line-height: 24px;
            color: #ce5c26;
        }

        .rich_media_title .rich_media_meta {
            vertical-align: middle;
            position: relative;
        }

        .rich_footer {
            width: 100%;
            padding: 10px 0px;
        }

        .rich_footer a {
            display: inline-block;
            width: 33.333%;
            float: left;
            text-align: center;
            height: auto;
        }

        .rich_footer a i {
            font-size: 22px;
        }

        .rich_footer a span {
            position: relative;
            top: -2px;
            font-size: 16px;
            color: #d27377;
        }

        .rich_media_xnd {
            color: #fff;
            padding: 2px 5px;
            background: #f6d95a;
            border-radius: 10px;
            margin-right: 5px;
            font-size: 12px;
        }

        .public-footer-img {
            width: 100%;
            border-top: 1px dashed #ccc;
            padding-top: 10px;
        }

        .public-footer-img span {
            font-size: 14px;
            color: #888;
            line-height: 0px;
        }

        .new-more {
            max-width: 650px;
            min-width: 240px;
            margin: 0px auto;
            padding-bottom: 20px;
        }

        .new-more h3 {
            display: block;
            width: 100%;
            border-bottom: 1px solid #CCCCCC;
            height: 35px;
            line-height: 35px;
            font-size: 15px;
            position: relative;
            color: #666666;
        }

        .new-more h3 span {
            display: block;
            width: 60px;
            height: 35px;
            border-bottom: 2px solid #f6d95a;
        }

        .new-more ul.list01 li {
            display: block;
            width: 100%;
            height: 42px;
            line-height: 42px;
            overflow: hidden;
            color: #888888;
            border-bottom: 1px solid #f5f5f5;
        }

        .new-more ul.list01 li:last-child {
            border-bottom: 0px;
        }

        .new-more ul.list01 li a {
            color: #888888;
            display: block;
            width: 100%;
            height: 37px;
            overflow: hidden;
        }

        .new-more ul.list01 li span {
            float: right;
            font-size: 14px;
        }

        .new-more ul.list01 li h4 {
            font-size: 14px;
        }

        .db {
            display: block;
        }

        .weixinAudio {
            line-height: 1.5;
        }

        .audio_area {
            display: inline-block;
            width: 100%;
            vertical-align: top;
            margin: 0px 1px 0px 0;
            font-size: 0;
            position: relative;
            font-weight: 400;
            text-decoration: none;
            -ms-text-size-adjust: none;
            -webkit-text-size-adjust: none;
            text-size-adjust: none;
        }

        .audio_wrp {
            border: 1px solid #ebebeb;
            background-color: #fcfcfc;
            overflow: hidden;
            padding: 12px 20px 12px 12px;
        }

        .audio_play_area {
            float: left;
            margin: 9px 22px 10px 5px;
            font-size: 0;
            width: 18px;
            height: 25px;
        }

        .playing .audio_play_area .icon_audio_default {
            display: block;
        }

        .audio_play_area .icon_audio_default {
            background: transparent url(/tpl/Wap/default/static/img/iconloop.png) no-repeat 0 0;
            width: 18px;
            height: 25px;
            vertical-align: middle;
            display: inline-block;
            -webkit-background-size: 54px 25px;
            background-size: 54px 25px;
            background-position: -36px center;
        }

        .audio_play_area .icon_audio_playing {
            background: transparent url(/tpl/Wap/default/static/img/iconloop.png) no-repeat 0 0;
            width: 18px;
            height: 25px;
            vertical-align: middle;
            display: inline-block;
            -webkit-background-size: 54px 25px;
            background-size: 54px 25px;
            -webkit-animation: audio_playing 1s infinite;
            background-position: 0px center;
            display: none;
        }

        .audio_area .pic_audio_default {
            display: none;
            width: 18px;
        }

        .tips_global {
            color: #8c8c8c;
        }

        .audio_area .audio_length {
            float: right;
            font-size: 14px;
            margin-top: 3px;
            margin-left: 1em;
        }

        .audio_info_area {
            overflow: hidden;
        }

        .audio_area .audio_title {
            font-weight: 400;
            font-size: 17px;
            margin-top: -2px;
            margin-bottom: -3px;
            width: auto;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            word-wrap: normal;
        }

        .audio_area .audio_source {
            font-size: 14px;
        }

        .audio_area .progress_bar {
            position: absolute;
            left: 0;
            bottom: 0;
            background-color: #0cbb08;
            height: 2px;
        }

        .playing .audio_play_area .icon_audio_default {
            display: none;
        }

        .playing .audio_play_area .icon_audio_playing {
            display: inline-block;
        }

        @-webkit-keyframes audio_playing {
            30% {
                background-position: 0px center;
            }
            31% {
                background-position: -18px center;
            }
            61% {
                background-position: -18px center;
            }
            61.5% {
                background-position: -36px center;
            }
            100% {
                background-position: -36px center;
            }
        }
    </style>


</head>
<body id="activity-detail" class=" ">
<div class="rich_media container">
    <div class="header" style="display: none;"></div>


    <div class="rich_media_inner content" style="min-height: 431px;">
        <div class="rich_media_title_main">
            <h2 class="rich_media_title" id="activity-name" style="font-size: 22px; font-weight: normal;">
                {pigcms{$nowImage['title']}</h2>
            <div style="clear: both;"></div>
        </div>

        <div class="rich_media_meta_list">
            <em id="post-date" class="rich_media_meta text" style="font-size: 16px;"><a
                    href="{pigcms{$config.site_url}/wap.php" class="rich_media_xnd">兔小蕾</a>{pigcms{$nowImage['now']}</em>
            <em class="rich_media_meta text" style="font-size: 16px;"></em>
            <a href="{pigcms{$config.site_url}/wap.php?g=Wap&c=Index&a=index&token={pigcms{$nowImage['mer_id']}"
               class="rich_media_meta link nickname js-no-follow js-open-follow" style="font-size: 16px;"
               href="javascript:;" id="post-user">{pigcms{$nowImage['author']}</a>


        </div>
        <div><img src="/tpl/Wap/default/static/images/tuxiaoleitopad.jpg" style="width: 100%;"></div>


        <div>
            <p class="weixinAudio">
                <audio src="" id="media" width="1" height="1" preload></audio>
                <span id="audio_area" class="db audio_area">
	<span class="audio_wrp db">
	<span class="audio_play_area">
		<i class="icon_audio_default"></i>
		<i class="icon_audio_playing"></i>
	</span>
	<span id="audio_length" class="audio_length tips_global">3:07</span>
	<span class="db audio_info_area">
		<strong class="db audio_title">Title/标题</strong>
		<span class="audio_source tips_global">From/来源</span>
	</span>
	<span id="audio_progress" class="progress_bar" style="width: 0%;"></span>
	</span>
	</span>
            </p>

            <script type="text/javascript" src="/tpl/Wap/default/static//js/jquery.min.js"></script>
            <script src="/tpl/Wap/default/static//js/weixinAudio.js" type="text/javascript"></script>
            <script type="text/javascript">
                $('.weixinAudio').weixinAudio({
                    autoplay: true,
                    src: '/tpl/Wap/default/static//sound/sound.mp3',
                });
            </script>


        </div>

        <div id="page-content" class="content">
            <div id="img-content">
                <!-- 视频部分 -->
                <if condition="$nowImage['video_url']">
                    <iframe frameborder="0" width="320" height="240"
                            style="position: relative; left: 50%; margin-left: -160px; margin-top: 15px; margin-bottom: 10px; display: none"
                            src="http://v.qq.com/iframe/player.html?vid={pigcms{$nowImage['video_url']}&tiny=0&auto=0"
                            allowfullscreen></iframe>
                </if>
                <if condition="$nowImage['cover_pic'] && $nowImage['is_show']">
                    <div class="rich_media_thumb" id="media">
                        <img onerror="this.parentNode.removeChild(this)" src="{pigcms{$nowImage['cover_pic']}">
                    </div>
                </if>

                <div class="rich_media_content" id="js_content">
                    {pigcms{$nowImage['content']|htmlspecialchars_decode=ENT_QUOTES}
                    <div class="new-more">
                        <h3><span><b>相关阅读</b></span></h3>
                        <ul class="list01">
                            <volist name="tuijian" id="art">
                                <li>
                                    <a href="{pigcms{:U('Article/index',array('imid'=>$art['pigcms_id']))}"><span><?php echo date("Y-m-d", $art['dateline']); ?></span>
                                        <h4>{pigcms{$art.title}</h4></a></li>
                            </volist>


                        </ul>
                    </div>
                    <div class="public-footer-img">
                        <span>每天五分钟，免费轻松学，父母共成长，长按二维码关注兔小蕾!！</span><br>
                        <audio style="display:none" id="musicBox" preload="metadata" controls autoplay="false"></audio>
                        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
                        <script>
                            var media = document.getElementById("musicBox");
                            if (!media.src) {
                                media.src = "http://a.f265.com/project/shake-money/img/shake.mp3"
                            }
                            media.play();

                            wx.config({
                                // 配置信息
                            });
                            wx.ready(function () {
                                media.src = "http://a.f265.com/project/shake-money/img/shake.mp3"
                                media.play();
                            });
                        </script>

                        <img src="/tpl/Wap/default/static/images/public-footer-img.png">

                    </div>
                </div>

                <div class="rich_media_tool" id="js_toobar" style="color: #f6d95a;">
                    <a class="media_tool_meta meta_primary" href="{pigcms{$nowImage['url']}">阅读原文</a>阅读量：
                    <php> echo $nowImage['count']*21;</php>
                </div>


            </div>
        </div>
    </div>
</div>
<div class="rich_footer" style="display: none;">
    <a>
        <i class="icon iconfont">&#xe680;</i>
        <span>310</span>
    </a>
    <a>
        <i class="icon iconfont">&#xe744;</i>
        <span>48</span>
    </a>
    <a>
        <i class="icon iconfont">&#xe689;</i>
        <span></span>
    </a>
</div>
<div style="width: 100%; height: 50px;"></div>
<div class="header-top">
    <a href="{pigcms{$config.article_bottom_url}">
        <span class="header-gz">进入</span>
        <div class="header-logo">
            <img src="/tpl/Wap/default/static/images/logo.png"/>
        </div>
        <h3 style="font-size: 14px; color: #fff;">{pigcms{$config.article_bottom_title}<br/>{pigcms{$config.article_bottom_digest}
        </h3>
    </a>
    <div style="clear: both;"></div>
</div>
<div style="display:none;">{pigcms{$config.wap_site_footer}</div>
<script src="{pigcms{:C('JQUERY_FILE')}"></script>
<script type="text/javascript">
    var shareData = {
            imgUrl: "{pigcms{$config.site_url}{pigcms{$nowImage['cover_pic']}",
        <if condition = "$_SESSION['distribution_id']" >
        link:"{pigcms{$config.site_url}{pigcms{:U('Article/index', array('imid' => $nowImage['pigcms_id'],'share_distribution_id'=>$_SESSION['distribution_id']))}",
    <
    elseif
    condition = "$_SESSION['share_distribution_id']" / >
        link
    :
    "{pigcms{$config.site_url}{pigcms{:U('Article/index', array('imid' => $nowImage['pigcms_id'],'share_distribution_id'=>$_SESSION['share_distribution_id']))}",
    <else/>
    link: "{pigcms{$config.site_url}{pigcms{:U('Article/index', array('imid' => $nowImage['pigcms_id']))}",
    </if>
    title: "{pigcms{$nowImage['title']}",
        desc
    :
    "{pigcms{$nowImage['digest']}"
    }
    ;
</script>
<include file="Share:share"/>

<script type="text/javascript">
    $(document).ready(function () {
        $(".dq").click(function () {
            $(".dq").hide();
            $(".on").show();
        });
        $(".on").click(function () {
            $(".on").hide();
            $(".dq").show();
        });
    });
</script>
</body>
</html>