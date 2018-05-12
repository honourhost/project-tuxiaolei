<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>{pigcms{$config.seo_title}</title>
    <meta name="keywords" content="{pigcms{$config.seo_keywords}" />
    <meta name="description" content="{pigcms{$config.seo_description}" />
    <link href="http://www.xiaonongding.com/upload/icon/icon.jpg" rel="SHORTCUT ICON" />
    <!-- 王强新增 -->
    <link href="{pigcms{$static_path}css/xnd_css/frame_block.css" rel="stylesheet" /><!-- 全局基础样式 -->
    <link href="{pigcms{$static_path}css/xnd_css/index_block.css" rel="stylesheet" /> <!--首页版块样式 -->
    <link href="{pigcms{$static_path}css/xnd_css/shop-list.css" rel="stylesheet" type="text/css"><!-- 底部公用样式 -->
    <link href="{pigcms{$static_path}css/xnd_css/headerfoot_black.css" rel="stylesheet" /><!-- 头部样式 -->
    <link href="{pigcms{$static_path}css/xnd_css/footer.css.css" rel="stylesheet" type="text/css"><!-- 底部公用样式 -->
    <script src="{pigcms{$static_path}js/xnd_js/frame_block.js"></script><!-- 焦点图左侧大导航js -->
    <script src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/public.css"/>
	<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/index.css"/>
    <!--[if lte IE 8]>
    <script src="{pigcms{$static_path}js/xnd_js/respond.min.js"></script>
    <![endif]-->
    <!-- 王强新增end -->



    <if condition="$config['wap_redirect']">
        <script>
            if(/(iphone|ipod|android|windows phone)/.test(navigator.userAgent.toLowerCase())){
            <if condition="$config['wap_redirect'] eq 1">
                window.location.href = './wap.php';
            <else/>
                if(confirm('系统检测到您可能正在使用手机访问，是否要跳转到手机版网站？')){
                    window.location.href = './wap.php';
                }
            </if>
            }
        </script>
    </if>

    </head>
<body style="background: #fff;">
	
<include file="Public:head_topnew"/>
<div class="main-public" style="margin-top: 10px;">
	
		<!-- 4张广告图 -->
		<div class="banner-four">
			 <div class="four-left">
				 <volist name="topleft" id="left" key="index">
					 <div class="four-0{pigcms{$index}">
						<a href="{pigcms{$left.url}"><img src="{pigcms{$left.pic}" /></a>
					 </div>
				 </volist>

			 </div>
			<volist name="topright" id="right">
			 <div class="four-right">

					 <a href="{pigcms{$right.url}"><img src="{pigcms{$right.pic}" /></a>

			 </div>
			</volist>
			<div style="clear: both;"></div>
		</div>
	
			<!-- 主题游 -->
	<volist name="fenlei" id="vo" key="keys">
		<div class="main-fenlei">
			<div class="fenlei-title">
				<a href="http://www.xiaonongding.com/category/{pigcms{$vo.cat_url}/all" target="_blank"><span>查看更多></span></a>
				<h3><i><img src="{pigcms{$static_path}images/xnd_img/icon-title.png" /></i>{pigcms{$vo.title}</h3>
				<ul class="ul-tag">
					<volist name="vo.childfenlei" id="vo1" key="index">
						<if condition="$index eq 1">
							<li class="on"><a href="http://www.xiaonongding.com/category/{pigcms{$vo1.cat_url}/all">{pigcms{$vo1.cat_name}</a></li>
							<else />
							<li><a href="http://www.xiaonongding.com/category/{pigcms{$vo1.cat_url}/all">{pigcms{$vo1.cat_name}</a></li>
						</if>

					</volist>

				</ul>
				<div style="clear: both;"></div>
			</div>
			<div class="fenlei-main">
				<div class="fenlei-left">
					<div class="left-img">
						<img src="{pigcms{$static_path}images/xnd_img/shanshuilouceng1.png" />
					</div>
					<div class="left-list">
						<ul>
							<li>
								<a href="#">
									<span><i></i>50252</span>
									<h3>古北水镇</h3>
								</a>
							</li>
							<li>
								<a href="#">
									<span><i></i>50252</span>
									<h3>古北水镇</h3>
								</a>
							</li>
							<li>
								<a href="#">
									<span><i></i>50252</span>
									<h3>古北水镇</h3>
								</a>
							</li>
							<li>
								<a href="#">
									<span><i></i>50252</span>
									<h3>古北水镇</h3>
								</a>
							</li>
							<li>
								<a href="#">
									<span><i></i>50252</span>
									<h3>古北水镇</h3>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="fenlei-right">

					<volist name="vo.childfenlei" id="vo2" key="index1">
						<if condition="$index1 eq 1">
							<ul class="list">
                            <if condition="$vo2.groups neq null">
								<volist name="vo2.groups" id="group">
									<li>
										<a href="http://www.xiaonongding.com/group/{pigcms{$group.group_id}.html" target="_blank">
											<div class="pic" style="background-image: url({pigcms{$group.pic.s_image});">
									<span class="pic-ceng">
									</span>
												<h3 class="pic-title">{pigcms{$group.s_name}</h3>
											</div>
											<div class="price">
												<span>&yen;</span>{pigcms{$group.price}
												<span>元/份</span>
												<span class="myd">
										原价：<i>{pigcms{$group.old_price}</i>
									</span>
											</div>
											<div class="name">
												<h3 >{pigcms{$group.name}</h3>
											</div>
										</a>
									</li>
								</volist>
								<else/>
							<h3  style="font-size:14px; padding-top:10px;">没有数据</h3>
							</if>


							</ul>
							<else/>
							<ul class="list" style="display: none;">
								<if condition="$vo2.groups neq null">
									<volist name="vo2.groups" id="group">
										<li>
											<a href="http://www.xiaonongding.com/group/{pigcms{$group.group_id}.html" target="_blank">
												<div class="pic" style="background-image: url({pigcms{$group.pic.s_image});">
									<span class="pic-ceng">
									</span>
													<h3 class="pic-title">{pigcms{$group.s_name}</h3>
												</div>
												<div class="price">
													<span>&yen;</span>{pigcms{$group.price}
													<span>元/份</span>
													<span class="myd">
										原价：<i>{pigcms{$group.old_price}</i>
									</span>
												</div>
												<div class="name">
													<h3>{pigcms{$group.name}</h3>
												</div>
											</a>
										</li>
									</volist>
									<else/>
									<h3  style="font-size:14px; padding-top:10px;">没有数据</h3>
								</if>

							</ul>
							</if>


					</volist>


				</div>
			</div>
			<div style="clear: both;"></div>
		</div>

	</volist>

		    

		  
		  
			
		
		</div>
<include file="Public:footer"/>

<script>
	$(".ul-tag li").mouseenter(function () {
		//$(window).scrollTop($(window).scrollTop() - 1), $(window).scrollTop($(window).scrollTop() + 1);
		var t = $(this).index();
		$(this).addClass("on").siblings().removeClass("on");
		 $(this).parents(".fenlei-title").siblings(".fenlei-main").find(".list").hide().eq(t).show();
	});
</script>
</body>
</html>