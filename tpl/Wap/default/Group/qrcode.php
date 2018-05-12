<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>微信分享</title>

	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/weixin.css"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
	   <style>
        .circleimg{
            width: 30px;
            height: 30px;
            border-radius: 30px;
        }
    </style>
</head>
<body>
<div class="weixin">
    <div class="weixin-main">
        <div class="wx-top-lf"></div>
        <div class="wx-top-rg"></div>
        <div class="wx-btm-lf"></div>
        <div class="wx-btm-rg"></div>
        <h2 class="wx-title">{pigcms{$s_title}</h2>
        <p>{pigcms{$title}</p>
        <div class="wx-line">
            <p></p><span><i></i><i></i><i></i></span>
        </div>
        <h3>&yen;<b>{pigcms{$price}</b></h3>
        <div class="wx-ma">
            <img class="ma-img" src="{pigcms{:U('Group/qrpng',array('groupid'=>$groupid ,'shareid'=>$shareid))}">
			<img class="circleimg user-img" src="{pigcms{$avators}"/>
        </div>
		
		
     <p>该宝贝由<span>{pigcms{$merchantinfo}</span>强烈推荐<br />请您放心购买哦~
        <a class="wx-btn" href="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id={pigcms{$groupid}&share_distribution_id={pigcms{$shareid}">点击或长按二维码识别</a>
        <p class="wx-footer"><span>本活动解释权归小农丁</span></p>
		
    </div>
    <div class="footer-logo">
        <img src="http://demo.xiaonongding.com/xnd/wx/xnd-logo.png">
    </div>
</div>

<script type="text/javascript">
    var shareData={
            imgUrl: "{pigcms{$merchantimage}",
    
        link: "http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id={pigcms{$groupid}&share_distribution_id={pigcms{$shareid}",
 
    title: "{pigcms{$merchantinfo}推荐:{pigcms{$s_title}",
        desc: "{pigcms{$title}"
    };
</script>
<include file="Public:shares"/>
</body>
</html>
