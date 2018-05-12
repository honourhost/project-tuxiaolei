<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>鲜蜂商城-拼团</title>
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telphone=no, email=no"/>
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link href="{pigcms{$static_path}css/groupbuy/newtuan.css" rel="stylesheet"/>
</head>
<body>
<div class="public-cen">
    <div class="tuan-nav" style="margin-top: 0; padding-bottom: 7px;">
        <ul>
            <li>
                <A  href="#fenlei">
                    <img src="{pigcms{$static_path}img/icon-shuiguo.png">
                    <h3>水果</h3>
                    <span></span>
                </a>
            </li>
            <li>
                <A  href="#fenlei">
                    <img src="{pigcms{$static_path}img/icon-jianguo.png">
                    <h3>坚果</h3>
                    <span></span>
                </a>
            </li>
            <li>
                <A  href="#fenlei">
                    <img src="{pigcms{$static_path}img/icon-shengxian.png">
                    <h3>生鲜</h3>
                    <span></span>
                </a>
            </li>
            <li>
                <A  href="#fenlei">
                    <img src="{pigcms{$static_path}img/icon-techan.png">
                    <h3>地方特产</h3>
                    <span></span>
                </a>
            </li>
        </ul>
        <div style="clear: both;"></div>
    </div>
    <div class="tuan-list">
        <ul>
            <if condition="$new_group_lists">
                <volist name="new_group_lists" id="group_buy">
                    <li>
                        <a href="{pigcms{:U('NewGroup/detail',array('group_id'=>$group_buy['group_id']))}">
                            <div class="tuan-list-img" style="background-image: url({pigcms{$group_buy.list_pic});"></div>
                            <h3>{pigcms{$group_buy.s_name}</h3>
                            <h3 style="display:none">{pigcms{$groupbuy.name}</h3>
                            <div class="tuan-icon">
                                <i>参团满{pigcms{$group_buy.need_num}人即刻开奖</i>
                                <i>失败自动退款</i>
                                <i>七天退换</i>
                            </div>
                            <div class="tuan-list-foot">
                                <span class="right tuan-btn" style="background-color:#01bda4;">去开奖<img src="{pigcms{$static_path}images/groupbuy/jiantou.png" /></span>
                                <span class="left num"><img src="{pigcms{$static_path}images/groupbuy/tuan.png">{pigcms{$group_buy.need_num}人抽奖团</span>
                                <span class="left price">&yen;<i>{pigcms{$group_buy.price}</i></span>
                                <del class="left old-price">单买价：&yen;<php>echo getGroupPrice($group_buy['related_id']);</php></del>
                            </div>
                            <div style="clear: both;"></div>
                        </a>
                    </li>
                </volist>
        </ul>
        <div style="clear: both;"></div>
    </div>
    <div class="footer-kong"></div>
    <div class="pub-footer">
        <ul>
            <li style="width:25%;">
                <a href="{pigcms{:U('GroupBuy/index',array('token'=>$token))}">
                    <img src="{pigcms{$static_path}img/icon-shouye-on.png" />
                    <h3>今日拼团</h3><!-- 跳转到小农丁首页 -->
                </a>
            </li>
            <li  style="width:25%;">
                <a href="{pigcms{:U('GroupBuy/listfirstfree',array('token'=>$token))}">
                    <img src="{pigcms{$static_path}img/icon-miandan.png" />
                    <h3>团长免单</h3><!-- 跳转到小农丁首页 -->
                </a>
            </li>
            <li class="ft-on" style="width:25%;">
                <a href="{pigcms{:U('GroupBuy/listlottery',array('token'=>$token))}">
                    <img src="{pigcms{$static_path}img/icon-pintuan-on.png" />
                    <h3>今日抽奖</h3><!-- 跳转到拼团首页 -->
                </a>
            </li>
            <li style="width:25%;">
                <a href="{pigcms{:U('My/group_buy_list')}">
                    <img src="{pigcms{$static_path}img/icon-my.png" />
                    <h3>个人中心</h3><!-- 跳转到个人中心 -->
                </a>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    var shareData={
        imgUrl: "{pigcms{$static_path}pinlogo.jpg",
        link: "{pigcms{$config.site_url}{pigcms{:U('GroupBuy/index',array('token'=>$token))}",
        title: "鲜蜂商城，好便宜",
        desc: "鲜蜂官方拼团频道，史上最牛的农产品特卖平台"
    };
</script>
<include file="Share:share"/>
</body>
</html>
