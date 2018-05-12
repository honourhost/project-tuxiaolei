<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>绑定帐号</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name='apple-touch-fullscreen' content='yes'/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>

    <link href="{pigcms{$static_path}css/eve.7c92a906.css" rel="stylesheet"/>
    <link href="{pigcms{$static_path}css/index_wap.css" rel="stylesheet"/>
    <link href="{pigcms{$static_path}css/idangerous.swiper.css" rel="stylesheet"/>
    <style>
        /*#login{margin: 0.5rem 0.2rem;}*/
        .btn-wrapper{margin:.28rem 0;}
        dl.list{border-bottom:0;border:1px solid #ddd8ce;}
        dl.list:first-child{border-top:1px solid #ddd8ce;}
        dl.list dd dl{padding-right:0.2rem;}
        dl.list dd dl>.dd-padding, dl.list dd dl dd>.react, dl.list dd dl>dt{padding-right:0;}
        .nav{text-align: center;}
        .subline{margin:.28rem .2rem;}
        .subline li{display:inline-block;}
        .captcha img{margin-left:.2rem;}
        .captcha .btn{margin-top:-.15rem;margin-bottom:-.15rem;margin-left:.2rem;}
    </style>
</head>
<body id="index" data-com="pagecommon">
<!--header  class="navbar">
    <div class="nav-wrap-left">
        <a class="react back" href="javascript:history.back()"><i class="text-icon icon-back"></i></a>
    </div>
    <h1 class="nav-header">绑定帐号</h1>
    <div class="nav-wrap-right">
        <a class="react" href="{pigcms{:U('Home/index')}">
            <span class="nav-btn"><i class="text-icon">⟰</i>首页</span>
        </a>
    </div>
</header-->
<div id="container">
    <div id="tips" style="-webkit-transform-origin:0px 0px;opacity:1;-webkit-transform:scale(1, 1);"></div>
    <div id="login">
        <dl class="list">
            <dd class="nav">
                <ul class="taba taban noslide" data-com="tab">
                    <li class="active" tab-target="reg-form"><a class="react">注册新帐号</a>
                    </li><div class="slide" style="left:0px;width:0px;"></div>
                </ul>
            </dd>
        </dl>
        <form id="reg-form" action="{pigcms{:U('Ticket/weixin_bind_reg')}" autocomplete="off" method="post" location_url="{pigcms{$referer}">
            <dl class="list list-in">
                <dd>
                    <dl>
                        <dd class="dd-padding">
                            <input id="reg_phone" class="input-weak" type="tel" placeholder="手机号" name="phone" value="" required=""/>
                        </dd>
                        <dd class="kv-line-r dd-padding">
                            <input id="reg_pwd_password" class="input-weak kv-k" type="password" placeholder="6位以上的密码"/>
                            <input id="reg_txt_password" class="input-weak kv-k" type="text" placeholder="6位以上的密码" style="display:none;"/>
                            <input type="hidden" id="reg_password_type" value="0"/>
                            <button id="reg_changeWord" type="button" class="btn btn-weak kv-v">显示明文</button>
                        </dd>
                    </dl>
                </dd>
            </dl>
            <div class="btn-wrapper">
                <button type="submit" class="btn btn-larger btn-block">注册并绑定</button>
            </div>
        </form>
    </div>
    <a href="{pigcms{:U('Ticket/weixin_bind_show')}">点击绑定已有账号</a>
</div>
<script src="{pigcms{:C('JQUERY_FILE')}"></script>
<script src="{pigcms{$static_path}js/common_wap.js"></script>
<script src="{pigcms{$static_path}js/weixin_back.js"></script>
<script src="{pigcms{$static_path}layer/layer.m.js"></script>
<script>
    <if condition="!$config['weixin_login_bind']">
        $(document).ready(function(){
            layer.open({
                title:['提醒：','background-color:#8DCE16;color:#fff;'],
                content:'您可以直接将微信号作为用户登录，点击可以直接登录。<br/>如果您未注册过账号请点击：注册并绑定！',
                btn: ['注册并绑定', '直接登录'],
                shadeClose: false,
                no: function(){
                    layer.open({content: '直接登录，正在跳转！', time:3});
                    window.location.href = "{pigcms{:U('Ticket/weixin_nobind')}";
                }
            });
            return false;
        });
    </if>
</script>
<include file="Public:footer"/>

{pigcms{$hideScript}
</body>
</html>