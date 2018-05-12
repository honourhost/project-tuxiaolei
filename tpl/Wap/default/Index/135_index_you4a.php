<!DOCTYPE html>
<html>    <head>
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
<link href="{pigcms{$static_path}css/allcss/cate35_{pigcms{$tpl.color_id}.css" rel="stylesheet" type="text/css" />
<!-- <link href="{pigcms{$static_path}css/135/cate25_.css" rel="stylesheet" type="text/css"> -->
<link href="{pigcms{$static_path}css/135/iscroll.css" rel="stylesheet" type="text/css">

<script src="{pigcms{$static_path}css/135/jquery.min.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}css/135/idangerous.swiper.js" type="text/javascript"></script>
<script src="{pigcms{$static_path}css/135/iscroll.js" type="text/javascript"></script>
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

<body id="cate25">
<if condition="$homeInfo['musicurl'] neq false">
<include file="Index:music"/>
</if>
<div class="banner">
<div id="wrapper" style="overflow: hidden;">
<div id="scroller" style="width: {pigcms{$num*1366}px; -webkit-transition: -webkit-transform 0ms; transition: -webkit-transform 0ms; -webkit-transform-origin: 0px 0px; -webkit-transform: translate3d(-2698px, 0px, 0px) scale(1);">
<ul id="thelist">
<volist name="flash" id="so">               
<li><p>{pigcms{$so.info}</p>
    <a href="{pigcms{$so.url}">
        <img src="{pigcms{$so.img}" style="width: 1366px;">
    </a>
</li>
</volist>
</ul>
</div>
</div>
      <div id="nav">
<div id="prev" onclick="myScroll.scrollToPage(&#39;prev&#39;, 0,400,3);return false">← prev</div>
<ul id="indicator">
            
<volist name="flash" id="so">
    <li <if condition="$i eq 1">class="active"</if>></li>
</volist>
 
</ul>
<div id="next" onclick="myScroll.scrollToPage(&#39;next&#39;, 0,400,3);return false">next →</div>
</div>
    <div class="clr"></div>
</div>

 
 <div id="insert1"></div>
 
                 



<div class="imgmenu">
<ul>

<volist name="info" id="vo"> 
<if condition="$i lt 5">
<li><a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>"><img src="{pigcms{$vo.img}"><p>{pigcms{$vo.name}</p></a></li> 
</if>
</volist>           
 </ul>
</div>

<volist name="info" id="vo" key="tt"> 
<if condition="$tt gt 4">
<div class="catemenu " >
<div class="cname"><a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>"><img src="{pigcms{$vo.img}"><p>{pigcms{$vo.name}</p></a></div>
<ul>
<li>
<?php if ($vo['sub']){
	foreach ($vo['sub'] as $res){
		if ($res['url']==''){
			$url=U('Wap/Index/lists',array('classid'=>$res['id'],'token'=>$res['token']));
		}else {
			$url=htmlspecialchars_decode($res['url']);
		}
		echo '<a href="'.$url.'">'.$res['name'].'</a>';
	}
}
?>


<div class="clr"></div>
</li>
</ul>
</div>
</if>                  
</volist>

  <script>


var count = document.getElementById("thelist").getElementsByTagName("img").length;  


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

 <div id="insert2"></div>
<if condition="$homeInfo['copyright']">
<div class="copyright">{pigcms{$homeInfo.copyright}</div> 
</if>
<div style="display:none"> </div>
 <include file="Index:styleInclude"/>
 <include file="$cateMenuFileName"/>
<!-- share -->
<include file="Index:share" />
</body></html>