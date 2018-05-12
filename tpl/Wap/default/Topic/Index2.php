<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telphone=no, email=no"/>
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <title>{pigcms{$channel.name}</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public-01.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/style-01.css"/>
    <script type="text/javascript" src="http://www.xiaonongding.com/tpl/Wap/default/static/js/hhSwipe.js"></script>
    <script type="text/javascript" src="http://www.xiaonongding.com/tpl/Wap/default/static/js/jquery-1.9.1.min.js"></script>
</head>
<body>
<div class="public-cen">
    <!-- 轮播图 -->
    <div class="phone-index-slide" id="iswipe">

    </div>

    <!-- nav 导航条 -->
    <div class="nav mag-10 bg-fff">
        <ul>
            <volist name="categories" id="cat" key="k">
                <if condition="$k neq 1">
                    <li>
                    <a href="#{pigcms{$cat.cat_url}">
                            {pigcms{$cat.name}
                    </a>
                    </li>
                </if>
            </volist>

        </ul>
        <div style="clear: both;"></div>
    </div>

    <!-- 精品推荐-->

    <div class="shop-list">
        <volist name="categories" id="cat" key="k">
            <if condition="$k eq 1">
                <php>$goodslist=getCatGoodsList($cat['id']);</php>
                <if condition="$goodslist">
                    <h3 class="tj-title mag-10 bg-fff" id="{pigcms{$cat.cat_url}"><span></span>	{pigcms{$cat.name}</h3>
                    <ul class=" mag-10 bg-fff">
                        <volist name="goodslist" id="goods">

                            <li>
                                <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id={pigcms{$goods.group_id}">
                                    <div class="list-left" style="background-image: url({pigcms{$goods.all_pic.0.m_image});">
                                    </div>
                                    <div class="list-right">
                                        <h3>{pigcms{$goods.s_name}</h3>
                                        <p>{pigcms{$goods.group_name}</p>
                                        <span>价格：<b>{pigcms{$goods.price}</b>元</span>
                                        <span>销售：<b><php>echo $goods['sale_count']+$goods['virtual_num'];</php></b>件</span>
                                        <i>我要买</i>
                                    </div>
                                </a>
                            </li>
                        </volist>
                    </ul>

                    </if>
                <else/>


                <php>$goodslist=getCatGoodsList($cat['id']);</php>
                <if condition="$goodslist">
                    <h3 class="tj-title mag-10 bg-fff" id="{pigcms{$cat.cat_url}"><span></span>	{pigcms{$cat.name}</h3>
                    <ul class=" mag-10 bg-fff">
                        <volist name="goodslist" id="goods">

                            <li>
                                <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id={pigcms{$goods.group_id}">
                                    <div class="list-left" style="background-image: url({pigcms{$goods.all_pic.0.m_image});">
                                    </div>
                                    <div class="list-right">
                                        <h3>{pigcms{$goods.s_name}</h3>
                                        <p>{pigcms{$goods.group_name}</p>
                                        <span>价格：<b>{pigcms{$goods.price}</b>元</span>
                                        <span>销售：<b><php>echo $goods['sale_count']+$goods['virtual_num'];</php></b>件</span>
                                        <i>我要买</i>
                                    </div>
                                </a>
                            </li>
                        </volist>
                    </ul>

                </if>

                </if>
            </volist>
    </div>


    <div class="footer">
        <img src="http://www.xiaonongding.com/tpl/Wap/default/static/images/xnd-logo.png">
    </div>
</div>
<script id="swipe" type="text/tmpl">
			<div class="addWrap">
			<div class="swipe" id="mySwipe">
				<div class="swipe-wrap">
				<volist name="banners" id="banner" key="k">
									<div><a href="{pigcms{$banner.url}"><img class="img-responsive" src="{pigcms{$config.site_url}/upload/channelbanner/{pigcms{$banner.pic}" /></a></div>

					</volist>
				</div>
			</div>
			<ul id="position">
				<li class="cur"></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
			</div>
	    </script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#iswipe").html($('#swipe').html());
        var bullets = document.getElementById('position').getElementsByTagName('li');
        var banner = Swipe(document.getElementById('mySwipe'), {
            auto: 4000,
            continuous: true,
            disableScroll:false,
            callback: function(pos) {
                var i = bullets.length;
                while (i--) {
                    bullets[i].className = ' ';
                }
                if(pos<=bullets.length){
                    bullets[pos].className = 'cur';
                }
            }
        })
        $('.drawer').drawer();
    });
</script>

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
