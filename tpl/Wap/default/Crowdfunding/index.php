<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<meta charset="utf-8" />
		<title>农丁众筹</title>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/base.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/css.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/swiper.min.css"/>
	</head>
	<body>
		<div class="wpc-zc">
			
			<!-- 下载 -->
			<div class="topbar-outer"> 
				<div class="topbar clearfix" style=""> 
					<div class="app-logo"> 
						<img src="{pigcms{$static_path}img/logo2.png" width="36" height="36"> 
					</div> 
					<div class="app-info"> 
						<p>
							<span class="app-title">小农丁</span>
							<span class="app-ico">
								<img src="{pigcms{$static_path}img/andriod-ad.png" width="12">
								<img src="{pigcms{$static_path}img/apple-ad.png" width="12">
						    </span>
						</p> 
						<p class="intro nowrap down-desc">
							给有品的你，最有品的生活
						</p> 
					</div>
					<a class="app-btn-download" href="javascript:void(0)" onclick="downApp()">立即下载</a>
					<a class="app-close">
						<img src="{pigcms{$static_path}img/btn_close.png" width="16">
					</a> 
				</div> 
				<div class="topbar-bottom"></div> 
			</div>
			<div class="height-kong" style="width: 100%; height: 8px;">
				
			</div>
			<!-- 下载 -->
			<div class="swiper-container">
		        <div class="swiper-wrapper">
                    <volist name="advers" id="adver">

                            <div class="swiper-slide">
                                <a href="{pigcms{$adver.url}">
                                <img src="http://www.xiaonongding.com/upload/adver/{pigcms{$adver.pic}" />
                                </a>
                            </div>


                    </volist>


		        </div>
		        <!-- Add Pagination -->
		        <div class="swiper-pagination"></div>
		    </div>
		    <div class="wpc-nav">
		    	<ul>
                    <li class="<?php if($catid==-1){echo 'on';}?>">
                        <a href="{pigcms{:U('Crowdfunding/index',array('catid'=>'-1'))}">最新</a>
                    </li>
                    <li class="<?php if($catid==0){echo 'on';}?>">
                        <a href="{pigcms{:U('Crowdfunding/index',array('catid'=>'0'))}" >美食</a>
                    </li>
                    <li class="<?php if($catid==1){echo 'on';}?>">
                        <a href="{pigcms{:U('Crowdfunding/index',array('catid'=>'1'))}" >农业</a>
                    </li>
                    <li class="<?php if($catid==2){echo 'on';}?>">
                        <a href="{pigcms{:U('Crowdfunding/index',array('catid'=>'2'))}" >民宿</a>
                    </li>
                    <li class="<?php if($catid==3){echo 'on';}?>">
                        <a href="{pigcms{:U('Crowdfunding/index',array('catid'=>'3'))}" >其他</a>
                    </li>
		    	</ul>
		    </div>
		    <a name="tuijian"></a>
		    <!-- 众筹列表 -->
		    <div class="wpc-list">
		    	<ul>
                    <volist name="crowdfundings" id="crowdfunding">
                        <a href="{pigcms{:U('Crowdfunding/detail',array('crowdid'=>$crowdfunding['crowd_id']))}">
				<style>
					.wpc-list ul li h3 i{
						display: inline-block;
						width: 20px;
						margin-right: 5px;
						position: relative;
						top: -2px;
					}
					.wpc-list ul li h3 i img{
						width: 20px;
						height: 20px;
						border-radius: 20px;
					}
					.wpc-list ul li h3 b{
						font-weight: 100;
						position: relative; 
						top: -8px;
						/*top: 0;*/
					}
					.wpc-list ul li h3{
						padding-bottom: 6px;
					}
				</style>
                        <li>
                            <h3>
		    				<span>
		    					<img src="{pigcms{$static_path}img/icon-tel.png" />
		    					{pigcms{$crowdfunding.crowdplace}
		    				</span>
                             <i><img src="{pigcms{$crowdfunding.invatorpic}"></i>
                             <b>{pigcms{$crowdfunding.invator}</b>
                            </h3>
                            <div class="list-img" style="background-image: url({pigcms{$crowdfunding.webpic});">
                            	
                                <?php if($crowdfunding['progress']==0){?>
                                <i>进行中</i>
                                <?php } else { ?>
                                <?php }?>
                            </div>
                            <h4>{pigcms{$crowdfunding.title}</h4>
                            <p>
                                {pigcms{$crowdfunding.digest}
                            </p>
                            <div class="wpc-icon">
		    				<span>
		    					<i><img src="{pigcms{$static_path}images/see.png" /></i>{pigcms{$crowdfunding.hit}
		    				</span>

                            </div>
                            <div class="wpc-user" style="display: none;">
		    				<span>
		    					<i><img src="http://www.xiaonongding.com/xnd.png" /></i>
		    					<p>
		    						客房使用代金券需要补多少差价
		    					</p>
		    				</span>
                                <span>
		    					<i><img src="http://www.xiaonongding.com/xnd.png" /></i>
		    					<p>
		    						客房使用代金券需要补多少差价
		    					</p>
		    				</span>
                            </div>
                        </li>
                        </a>
                    </volist>


		    	</ul>
		    </div>
		</div>
			<style>
			.footer-kong{
	width: 100%;
	height: 60px;
}
.pub-footer{
	position: fixed;
	left: 0;
	bottom: 0;
	width: 100%;
	height: auto;
	background: #fff;
	border-top: 1px solid #f2efee;
	padding: 5px 0px;
}
.pub-footer ul li{
	width: 33.3333%;
	text-align: center;
	float: left;
}
.pub-footer ul li img{
	height: 21px;
	margin-bottom: 0px;
}
.pub-footer ul li h3{
	font-size: 12px;
	color: #8a8a8a;
}
.pub-footer ul li.ft-on h3{
	color:#5cb975;
}
		</style>
		<div class="footer-kong"></div>
		<div class="pub-footer">
				        <ul>
            <li class="ft-on">
                <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Crowdfunding&a=index&catid=-1">
                    <img src="http://www.xiaonongding.com/tpl/Wap/default/static/img/icon-indexs-on.png">
                    <h3>主页</h3><!-- 跳转到小农丁首页 -->
                </a>
            </li>
			  <li>
                <a href="#tuijian">
                    <img src="http://www.xiaonongding.com/tpl/Wap/default/static/img/icon-tjs.png">
                    <h3>推荐</h3><!-- 跳转到小农丁首页 -->
                </a>
            </li>
            <li>
                <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=My&a=crowd_buy_list&status=1">
                    <img src="http://www.xiaonongding.com/tpl/Wap/default/static/img/icon-mys.png">
                    <h3>我的</h3><!-- 跳转到拼团首页 -->
                </a>
            </li>
        </ul>
			</div>
	</body>
	<script src="{pigcms{$static_path}js/swiper.min.js"></script>
	<script src="{pigcms{$static_path}js/jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>
    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        spaceBetween: 0,
        loop:true
    });
    </script>
    <script>
		$(document).ready(function(){
		  $(".app-close").click(function(){
		    $('.topbar-outer').hide();
		    $('.height-kong').hide();
		  });
		});
   </script>
   <script>
   	function downApp(){
	var u = navigator.userAgent, 
	isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1,
	isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/),
	urls = {
		'android':'market://details?id=com.so.xiaonongding',
		'ios':'https://itunes.apple.com/cn/app/小农丁/id1069287983?mt=8',
		'other':'http://www.xiaonongding.com/app/index.html'
	};
	//三元运算
	// window.location.href = isAndroid? urls.android : isiOS? urls.ios : urls.other;
	//简化
	if(isAndroid){
		window.location.href=urls.android;
	}else if(isiOS){
		window.location.href=urls.ios;
	}else{
		window.location.href=urls.other;
	}
}
   </script>
</body>
</html>
