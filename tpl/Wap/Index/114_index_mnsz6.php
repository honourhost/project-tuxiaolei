<html>
        <head>
       <if condition="$zd['status'] eq 1">
            {pigcms{$zd['code']}
        </if>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>{pigcms{$tpl.wxname}</title>
        <base href="." />
        <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="format-detection" content="telephone=no" />
        
        
        <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/114/iscroll.css" media="all">
<!-- <link href="{pigcms{$static_path}css/114/cate14_.css" rel="stylesheet" type="text/css"> -->
<link href="{pigcms{$static_path}css/allcss/cate14_{pigcms{$tpl.color_id}.css" rel="stylesheet" type="text/css" />
<!--背景音乐start-->

<script src="{pigcms{$static_path}js/audio.js" type="text/javascript"></script>

<script type="text/javascript">
// 两秒后模拟点击
setTimeout(function() {
    // IE
    if(document.all) {
        document.getElementById("playbox").click();
    }
    // 其它浏览器
    else {
        var e = document.createEvent("MouseEvents");
        e.initEvent("click", true, true);
        document.getElementById("playbox").dispatchEvent(e);
    }
}, 2000);
</script>
<!--背景音乐end-->
<script src="{pigcms{$static_path}css/114/iscroll.js" type="text/javascript"></script>
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
</head>

<body id="cate16">
<!--背景音乐-->
<style>
.btn_music {
display: inline-block;
width: 35px;
height: 35px;
background: url('{pigcms{$static_path}images/play.png') no-repeat center center;
background-size: 100% auto;
position: absolute;
z-index: 100;
left: 15px;
top: 20px;
}
.btn_music.on {
    background-image: url("{pigcms{$static_path}images/stop.png");
}

</style>
<if condition="$homeInfo['musicurl'] neq false">
<span id="playbox" class="btn_music" onclick="playbox.init(this).play();" >
    <audio src="{pigcms{$homeInfo.musicurl}" loop="" id="audio"></audio>
</span>
</if>
<div class="banner">
<div id="wrapper" style="overflow: hidden;">
<div id="scroller" style="width: {pigcms{$num*1366}px; -webkit-transition: 0ms; transition: 0ms; -webkit-transform: translate3d(-382.48px, 0px, 0px) scale(1);">
<ul id="thelist">
    <volist name="flashbg" id="so">             
        <li><p>{pigcms{$so.info}</p><img src="{pigcms{$so.img}" style="width: 1366px;"></li>
    </volist>
</ul>
</div>
</div>
    <div id="nav">
<div id="prev" onclick="myScroll.scrollToPage(&#39;prev&#39;, 0,400,3);return false">← prev</div>
<ul id="indicator">
            
<volist name="flashbg" id="so">
    <li <if condition="$i eq 1">class="active"</if> ></li>
</volist>
 
</ul>
<div id="next" onclick="myScroll.scrollToPage(&#39;next&#39;, 0,400,3);return false">next →</div>
</div>
    <div class="clr"></div>
</div>

<div class="mainmenu">
<ul>
<volist name="info" id="vo">   
<li>
<div class="menubtn"><a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
            <div class="menuimg"><img src="{pigcms{$vo.img}"></div>
<div class="menutitle">{pigcms{$vo.name}</div></a>
</div>

</li>
 </volist>

    
<div class="clr"></div>
        
       
</ul>
</div>





 <div style="display:none"> </div>

<script>
var count = document.getElementById("thelist").getElementsByTagName("img").length;  

var count2 = document.getElementsByClassName("menuimg").length;
for(i=0;i<count;i++){
 document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

}
document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";

 setInterval(function(){
myScroll.scrollToPage('next', 0,400,count);
},3500 );
window.onresize = function(){ 
for(i=0;i<count;i++){
document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

}
 document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";
} 


</script>

<if condition="$homeInfo['copyright']">
<div class="copyright">{pigcms{$homeInfo.copyright}</div> 
</if>
<include file="Index:styleInclude"/>
<include file="$cateMenuFileName"/>
<!-- share -->
<include file="Index:share" />
</body></html>