
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css2/style.css"/>
<script>
    var phpData = {uid:0, jsVersion:1 };
    window.QYER = {
        uid:phpData.uid,
        FED:{
            config:{
                version:phpData.jsVersion,
                pageID:"a32a91d5-4fc2-606a-5956-354177696857",
                pagePath:"project/web/lm/promotion/20151029lmApp/"
            }
        }
    };
    phpData=null;
    
</script>

<script type="text/javascript" src="js2/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js2/a32a91d5-4fc2-606a-5956-354177696857.js"></script>
<script type="text/javascript" src="js2/jquery.fullPage.min.js"></script>
</head>
<body>

<!-- 页面主体 start -->
<ul id="menu">
    <li class="menu-cell" data-menuanchor="page1"><a href="#page1"></a></li>
    <li class="menu-cell" data-menuanchor="page2"><a href="#page2"></a></li>
    <li class="menu-cell" data-menuanchor="page3"><a href="#page3"></a></li>
    <li class="menu-cell" data-menuanchor="page4"><a href="#page4"></a></li>
    <li class="menu-cell" data-menuanchor="page5"><a href="#page5"></a></li>
</ul>

<div id="fullpage">
	<include file="Public:header_top_app"/>
    <div class="pages pages1 section" id="cont1" data-anchor="page1">
        <div class="pages-inner clearfix">
            <img class="view-img" src="img2/page-1-left-img.png" />
            <img class="view-text" src="img2/page-1-right-text.png" />
            <div class="btn-wrap">
                <a class="btn-1" target="_blank" href="https://itunes.apple.com/us/app/xiao-nong-ding/id1069287983?l=zh&ls=1&mt=8"></a>
                
                <a class="btn-3" target="_blank" href="http://fir.im/lscu"></a>
                <img class="img-sao" src="img2/page-1-right-sao.png" />
            </div>
        </div>
    </div>

    <div class="pages pages2 section" id="cont2" data-anchor="page2">
        <div class="pages-inner clearfix">
            <img class="view-text" src="img2/page-2-text.png" />
            <img class="view-img" src="img2/page-2-img-1.png" />
        </div>
    </div>

    <div class="pages pages3 section" id="cont3" data-anchor="page3">
        <div class="pages-inner clearfix">
            <div class="text-wrap">
                <img class="view-text" src="img2/page-3-text.png" />
                <img class="view-ico" src="img2/page-3-ico.png" />
            </div>
            <img class="view-img" src="img2/page-3-img.png" />
        </div>
    </div>

    <div class="pages pages4 section" id="cont4" data-anchor="page4">
        <div class="pages-inner clearfix">
            <img class="view-img" src="img2/page-4-img.png" />
            <div class="text-wrap">
                <img class="view-text" src="img2/page-4-text.png" />
                <img class="view-ico" src="img2/page-4-ico.png" />
            </div>
        </div>
    </div>

    <div class="pages pages5 section" id="cont5" data-anchor="page5">
        <div class="pages-inner clearfix">
            <img class="view-text" src="img2/page-5-text.png" />
            <div class="btn-wrap">
                 <a class="btn-1" target="_blank" href="https://itunes.apple.com/us/app/xiao-nong-ding/id1069287983?l=zh&ls=1&mt=8"></a>
                
                 <a class="btn-3" target="_blank" href="http://fir.im/lscu"></a>
                <img class="img-sao" src="img2/page-5-sao.png" />
            </div>
        </div>
    </div>
</div>
<!-- 页面主体 start -->
<!-- 页面尾部 start -->
<div class="footer-fixed">
	<div class="footer-fixed-main">
		<img src="img2/big_img.png" class="lf">
		<div class="footer-fixed-btn">
			<a class="footer-fixed-login" target="_blank" href="http://www.xiaonongding.com/index.php?g=Index&c=Login&a=index">登录</a>或
			<a class="footer-fixed-register" target="_blank" href="http://www.xiaonongding.com/index.php?g=Index&c=Login&a=reg">注册小农丁</a>
		</div>
		<div class="footer-fixed-close"></div>
	</div>
</div>
<script>
$(function(){
setTimeout('$(".footer-fixed").slideDown("slow")');
$(document).ready(function(){
  $(".footer-fixed-close").click(function(){
    $(".footer-fixed").slideUp("slow");
  });
});
});
</script>
</body>
</html>