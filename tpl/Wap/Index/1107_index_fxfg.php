<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       <if condition="$zd['status'] eq 1">
            {pigcms{$zd['code']}
        </if>

<title>{pigcms{$tpl.wxname}</title>

<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"> 
<meta name="format-detection" content="telephone=no">
<meta charset="utf-8">

<link rel="stylesheet" href="{pigcms{$static_path}tpl/com/css/idangerous.swiper.css">
<link href="{pigcms{$static_path}tpl/com/css/iscroll.css" rel="stylesheet" type="text/css" />

<link href="{pigcms{$static_path}tpl/1107/css/cate.css" rel="stylesheet" type="text/css" />
 
<style>
 
 
</style>
<script src="{pigcms{$static_path}tpl/com/js/iscroll.js" type="text/javascript"></script>
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
<body>
		<!--music-->
		<if condition="$homeInfo['musicurl'] neq false">
			<include file="Index:music"/>
		</if>
<div class="banner">
<div id="wrapper">
<div id="scroller">
<ul id="thelist">
				<volist name="flash" id="so">    
					<li><p>{pigcms{$so.info}</p><a href="{pigcms{$so.url}"><img src="{pigcms{$so.img}" /></a></li>
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

 <div id="insert1" ></div>
<div class="device">
    <a class="arrow-left" href="#"></a> 
    <a class="arrow-right" href="#"></a>
    <div class="swiper-container">
      <div class="swiper-wrapper">
      
      
         
           <volist name="info" id="vo">  
           
                            
                
         <if condition="$i%9 == 1">              
			<div class="swiper-slide">
            <div class="content-slide">
		</if>
          <a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
          <div class="mbg">
                    <p class="ico"><img src="{pigcms{$vo.img}" /></p>
                    <p class="title">{pigcms{$vo.name}</p></div>
                </a>
                                         
                
                            
          
		<if condition="$i%9 == 0 || $i == count($info)"> 
			</div>
			
			</div>
		</if>
</volist>
	
</div> 
<div class="pagination"></div>
</div>


<script src="{pigcms{$static_path}tpl/com/js/jquery-1.10.1.min.js" type="text/javascript"></script>
  <script src="{pigcms{$static_path}tpl/com/js/idangerous.swiper-2.1.min.js" type="text/javascript"></script>
  <script>
  var mySwiper = new Swiper('.swiper-container',{
    pagination: '.pagination',
    loop:true,
    grabCursor: true,
    paginationClickable: true
  })
  $('.arrow-left').on('click', function(e){
    e.preventDefault()
    mySwiper.swipePrev()
  })
  $('.arrow-right').on('click', function(e){
    e.preventDefault()
    mySwiper.swipeNext()
  })
  </script>

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
 </div>
<if condition="$homeInfo['copyright']">
<div class="copyright">{pigcms{$homeInfo.copyright}</div> 
</if>
<include file="Index:styleInclude"/>
<include file="$cateMenuFileName"/> 
<!-- share -->
<include file="Index:share" />
 </body>
</html>