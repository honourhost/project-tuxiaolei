<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>会员卡</title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="{pigcms{$static_path}css/style.css" rel="stylesheet" type="text/css">
<script src="/static/js/jquery.min.js" type="text/javascript"></script>

<link href="{pigcms{$static_path}tpl/com/css/iscroll.css" rel="stylesheet" type="text/css" />
<script src="{pigcms{$static_path}tpl/com/js/iscroll.js" type="text/javascript"></script>
</head>
<script type="text/javascript">
var myScroll;

function loaded() {
myScroll = new iScroll('wrapper', {
snap: true,
momentum: false,
hScrollbar: false,
onScrollEnd: function () {
document.querySelector('#indicator > li.active').className = '';
document.querySelector('#indicator > li:nth-child(' + (this.currPageX+1) + ')').className = 'active';
}
 });
 
}

document.addEventListener('DOMContentLoaded', loaded, false);
</script>
<body id="cardunion" class="mode_webapp2" >


<!--	focus start	-->
 
<div class="banner">
<div id="wrapper">
<div id="scroller">
<ul id="thelist">
<volist name="flash" id="so">    
	<li><p>{pigcms{$so.info}</p><a href="{pigcms{$so.url|default='javascript:void(0)'}"><img src="{pigcms{$so.img}" /></a></li>
</volist>
</ul>
</div>
</div>


<div id="nav">
<div id="prev" onclick="myScroll.scrollToPage('prev', 0,400,2);return false">&larr; prev</div>
<ul id="indicator">
	<volist name="flash" id="so">
		<li <if condition="$i eq 1">class="active"</if> ></li>
	</volist>
</ul>
<div id="next" onclick="myScroll.scrollToPage('next', 0);return false">next &rarr;</div>
</div>

<div class="clr"></div>
</div>

<!--	focus End	-->


<div class="cardexplain"> 
<ul class="round">
<li><if condition="$cardsCount eq 0"><a href="javascript:void(0);"><span>您还没有领取任何会员卡</span></a><else/><a href="/wap.php?g=Wap&c=Card&a=index&token={pigcms{$token}&mycard=1"><span>我的会员卡<em class="ok">{pigcms{$cardsCount}</em></span></a></if></li>
</ul>
<ul class="round">
<if condition="$allCardsCount neq 0">
<volist id="c" name="allCards">
<li class="dandanb"><a href="/wap.php?g=Wap&c=Card&a=card&token={pigcms{$token}&cardid={pigcms{$c.id}"><span class="none"><img src="{pigcms{$c.logo}"><h2>{pigcms{$c.cardname}</h2>
<p>{pigcms{$c.msg}</p> <php>if($c['applied']){</php><em class="error">用卡</em><php>}else{</php><em class="ok">领卡</em><php>}</php></span></a>
</li>
</li>
</volist>
<else/>
<li class="dandanb"><a href="###"><span>商家暂时未设置会员卡</span></a>
</li>
</if>
</ul>


<ul class="round">
<li class="tel"><a href="tel:{pigcms{$thisCompany.phone}"><span><if condition="$thisCompany.phone neq ''">{pigcms{$thisCompany.phone}<else/>商家未设置电话</if></span></a></li>
<!--li class="address"><a href="/wap.php?g=Wap&c=Card&a=companyMap&token={pigcms{$token}&companyid={pigcms{$thisCompany.mer_id}"><span><if condition="$thisCompany.address neq ''">{pigcms{$thisCompany.address}<else/>商家未设置地址</if></span></a></li-->
<li class="detail"><a href="/wap.php?g=Wap&c=Card&a=companyDetail&token={pigcms{$token}&companyid={pigcms{$thisCompany.mer_id}"><span>查看商家详情</span></a></li>
</ul>
</div>
<script>


var count = document.getElementById("thelist").getElementsByTagName("img").length;	
var count2 = document.getElementsByClassName("menuimg").length;


for(i=0;i<count;i++){
 document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

}
for(i=0;i<count2;i++){
  
document.getElementsByClassName("menuimg").item(i).style.cssText = " HEIGHT:"+(document.body.clientWidth/320)*111+"px";
document.getElementsByClassName("menumesg").item(i).style.cssText = " HEIGHT:"+(document.body.clientWidth/320)*111+"px";
 
}

document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";


 setInterval(function(){
myScroll.scrollToPage('next', 0,400,count);
},3500 );

window.onresize = function(){ 
for(i=0;i<count;i++){
document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

}
for(i=0;i<count2;i++){
 
 
document.getElementsByClassName("menuimg").item(i).style.cssText = " HEIGHT:"+(document.body.clientWidth/320)*111+"px";
document.getElementsByClassName("menumesg").item(i).style.cssText = " HEIGHT:"+(document.body.clientWidth/320)*111+"px";
  
}

 document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";
} 

</script>
<include file="Card:bottom"/>

<include file="Card:share"/>
</body>
</html>
