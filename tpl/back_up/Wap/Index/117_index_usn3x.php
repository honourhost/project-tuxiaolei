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
<link href="{pigcms{$static_path}css/allcss/cate17_{pigcms{$tpl.color_id}.css" rel="stylesheet" type="text/css" />

        <!-- <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/117/common.css" media="all"> -->
        <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/117/reset.css" media="all">
        <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/117/font-awesome.css" media="all">
        <!-- <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/117/home-51.css" media="all"> -->
        <script type="text/javascript" src="{pigcms{$static_path}css/116/jQuery.js"></script>

    </head>
    <body onselectstart="return true;" ondragstart="return false;">
    
    <!--背景音乐-->
<if condition="$homeInfo['musicurl'] neq false">
<include file="Index:music"/>
</if>

        <style type="text/css">
.body{
    display:block;

    <volist name="flashbg" id="so">
        background:url('{pigcms{$so.img}') no-repeat center 0;
    </volist>
        background-size:100% 100%;
}


</style>
<div class="body">
    
    <section>
        <div class="box_title">
            <hgroup>
              <h1>{pigcms{$homeInfo.title}</h1>
                <h3>{pigcms{$homeInfo.info}</h3>
            </hgroup>
        </div>
        <ul class="list_ul">
            <volist name="info" id="vo">
				<if condition="$i%3 == 1"><li class="box"></if>
				
				                                
				<a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>">
										<label><small>{pigcms{$vo.name}</small></label>
						<span ><img src="{pigcms{$vo.img}" class="icon-smile" style="width:60px;position:relative;right:-16px;"></span>
					</a>
				
			   
													
				<if condition="$i%3 == 0"></li></if>
			</volist>
  
             </ul>
    </section>

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
</div>

    <include file="Index:styleInclude"/>
    <include file="$cateMenuFileName"/>
	<if condition="$homeInfo['radiogroup'] eq 10">
		<style>
			.top_bar .top_menu>li>a {
				line-height:0px;
			}
		</style>
	</if>
<!-- share -->
<include file="Index:share" />
</body></html>
