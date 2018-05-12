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
<link href="{pigcms{$static_path}css/allcss/cate24_{pigcms{$tpl.color_id}.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/124/common.css" media="all">  -->   
      
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/124/reset.css" media="all">
<!-- <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/124/cate12_2.css" media="all"> -->
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/124/iscroll.css" media="all">

<script type="text/javascript" src="{pigcms{$static_path}css/116/jQuery.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}css/124/jquery_min.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}css/124/idangerous_swiper.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}css/124/iscroll.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}css/124/swipe.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}css/124/zepto.js"></script>
    </head>
    <body onselectstart="return true;" ondragstart="return false;" id="cate12">
<!--背景音乐-->
<if condition="$homeInfo['musicurl'] neq false">
<include file="Index:music"/>
</if>
<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/124/font-awesome.css" media="all">
<script type="text/javascript">
    var myScroll;
    function loaded() {
        myScroll = new iScroll('wrapper', {
            snap: true,
            momentum: false,
            hScrollbar: false,
            onScrollEnd: function() {
                document.querySelector('#indicator > li.active').className = '';
                document.querySelector('#indicator > li:nth-child(' + (this.currPageX + 1) + ')').className = 'active';
            }
        });
    }
    document.addEventListener('DOMContentLoaded', loaded, false);
</script>


<div class="body">
        <!--
    幻灯片管理
    -->
    <div style="-webkit-transform:translate3d(0,0,0);">
        <div id="banner_box" class="box_swipe" style="visibility: visible;">
            <ul style="list-style: none; transition: 0ms; -webkit-transition: 0ms; -webkit-transform: translate3d(0px, 0, 0);">
            <volist name="flash" id="so">
                <li style="vertical-align: top;">
                    <a href="{pigcms{$so.url}">
                        <img src="{pigcms{$so.img}"  style="width:100%;">
                    </a>
                </li>
                </volist>
                
            </ul>
            <ol>
                <volist name="flash" id="so">
                    <li <if condition="$i eq 1">class="on"</if>></li>
                </volist>
            </ol>
        </div>
    </div>
        <script>
        $(function(){
            new Swipe(document.getElementById('banner_box'), {
                speed:500,
                auto:3000,
                callback: function(){
                    var lis = $(this.element).next("ol").children();
                    lis.removeClass("on").eq(this.index).addClass("on");
                }
            });
        });
    </script>
            <!--
        用户分类管理
        -->
        <div id="insert1"></div>
            <volist name="info" id="vo">
            <div class="Category">
                <div class="cname">
                    {pigcms{$vo.name}                <a href="<if condition="$vo['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token']))}<else/>{pigcms{$vo.url|htmlspecialchars_decode}</if>" class="more"><!-- 查看更多 --></a>
                </div>
                <div class="clist clist1 swiper-container">
                    <div class="swiper-wrapper" style="width: 100%">
                        <div class="swiper-slide swiper-slide-visible swiper-slide-active" style="width: 100%;">
                    <ul>
                    <volist name="vo['sub']" id="res">
                        <li>
                            
                            <a href="<if condition="$res['url'] eq ''">{pigcms{:U('Wap/Index/lists',array('classid'=>$res['id'],'token'=>$res['token']))}<else/>{pigcms{$res.url|htmlspecialchars_decode}</if>">
                            <div>
                                <img src="{pigcms{$res.img}">
                            </div>
                                <span>{pigcms{$res.name}</span>
                            </a>
                            
                        </li>
                    </volist>
                    </ul>
                        </div>
                        </div>
                    <div class="cpager"><span class="swiper-pagination-switch swiper-visible-switch swiper-active-switch"></span></div>
                    
                </div>
            </div>
            </volist>        
    

           
</div>
<if condition="$homeInfo['copyright']">
<div class="copyright" style="text-align:center;padding:10px 0">{pigcms{$homeInfo.copyright}</div> 
</if> 
<include file="Index:styleInclude"/>
<include file="$cateMenuFileName"/>
<!-- share -->
<include file="Index:share" />
</body></html>