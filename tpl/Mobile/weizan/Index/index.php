<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>今日特卖</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-phone-show.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-index.css"/>
		<script type="text/javascript" src="{pigcms{$static_path}js/hhSwipe.js"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
	</head>
	<body class="phone-index-body">
		<div class="public_cen">
			<!-- 焦点图 -->
			<div class="phone-index-slide" id="iswipe">
				
			</div>
			
			<!-- nav -->
			<div class="phone-index-nav">
				<ul>
					<volist name="catresult" id="cat">
						<li>
						<a href="{pigcms{$cat.url}">
						<img src="{pigcms{$cat.pic}" />
						<h3>{pigcms{$cat.name}</h3>
						</a>
					</li>
					</volist>
					<div style="clear: both;"></div>
				</ul>
			</div>
			
			<!-- 舌尖上的...banner图 -->
			<div class="phone-index-xnd">
				<a href="{pigcms{$themeresult.0.url}">
					<img src="{pigcms{$themeresult.0.pic}" />
				</a>
			</div>
			
			<!-- 快报 -->
			<div class="phone-index-news">
				<div class="index-news-icon"><img src="{pigcms{$static_path}images/xnd_img/phone-index-kb.jpg" /></div>
				<div class="index-news-title apple" style="top: 3px;">
					<ul>
						<volist name="pushgoods" id="goods">
						<li>
							<a href="{pigcms{$goods.url}">{pigcms{$goods.name}</a>
						</li>
						</volist>
					</ul>
				</div>
				<div style="clear: both;"></div>
			</div>
			
			<!-- 特卖&农场 -->
			<div class="phone-index-sales">
				<div class="index-sales-title">
					<span></span>
					<h3>特卖&农场</h3>
				</div>
				<div class="index-sales">
					<div class="index-sales-top">
						<a href="{pigcms{$addresult.0.url}">
						<h3>{pigcms{$addresult.0.name}</h3>
						<span class="sales-top-con">{pigcms{$addresult.0.desc}</span>
						<div class="index-sales-img" style="background-image: url({pigcms{$addresult.0.pic});"></div>
					    <span class="rg-line"></span>
					    </a>
					</div>
					<div class="index-sales-btm">
						<div class="index-sales-btm-left">
							<a href="{pigcms{$addresult.1.url}">
							<h3>{pigcms{$addresult.1.name}</h3>
							<span class="sales-top-con">{pigcms{$addresult.1.desc}</span>
							<div class="index-sales-img" style="background-image: url({pigcms{$addresult.1.pic});"></div>
						    <span class="rg-line"></span>
						    </a>
						</div>
						
						<div class="index-sales-btm-left">
							<a href="{pigcms{$addresult.2.url}">
							<h3>{pigcms{$addresult.2.name}</h3>
							<span class="sales-top-con">{pigcms{$addresult.2.desc}</span>
							<div class="index-sales-img" style="background-image: url({pigcms{$addresult.2.pic});"></div>
						    <span class="rg-line"></span>
						    </a>
						</div>
					</div>
				</div>
				<div class="index-sales">
					<div class="index-sales-top">
						<a href="{pigcms{$addresult.3.url}">
						<h3>{pigcms{$addresult.3.name}</h3>
						<span class="sales-top-con">{pigcms{$addresult.3.desc}</span>
						<div class="index-sales-img" style="background-image: url({pigcms{$addresult.3.pic});"></div>
					    <span class="rg-line"></span>
					    </a>
					</div>
					<div class="index-sales-btm">
						<div class="index-sales-btm-left">
							<a href="{pigcms{$addresult.4.url}">
							<h3>{pigcms{$addresult.4.name}</h3>
							<span class="sales-top-con">{pigcms{$addresult.4.desc}</span>
							<div class="index-sales-img" style="background-image: url({pigcms{$addresult.4.pic});"></div>
						    <span class="rg-line"></span>
						    </a>
						</div>
						
						<div class="index-sales-btm-left">
							<a href="{pigcms{$addresult.5.url}">
							<h3>{pigcms{$addresult.5.name}</h3>
							<span class="sales-top-con">{pigcms{$addresult.5.desc}</span>
							<div class="index-sales-img" style="background-image: url({pigcms{$addresult.5.pic});"></div>
						    <span class="rg-line"></span>
						    </a>
						</div>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
			
			<!-- 推荐农场 -->
			<div class="phone-index-photo">
				<div class="index-sales-title">
					<span></span>
					<h3>推荐农场</h3>
				</div>
				<div class="index-photo-con">
					<ul>
						<if condition="$pictures">
							<volist name="pictures" id="picture">
								<li>
									<a href="{pigcms{$picture.url}">
										<h3>{pigcms{$picture.name}</h3>
										<span class="sales-top-con">{pigcms{$picture.person_name}的农场</span>
										<div class="index-sales-img" style="background-image: url({pigcms{$picture.images.0});"></div>
									</a>
								</li>
							</volist>

							<else/>
							<li>未获取到数据。。。</li>
						</if>
						<div style="clear: both;"></div>
					</ul>
					<div style="clear: both;"></div>
					<!-- 最新提醒 -->
					<div class="phone-index-tx">
						<span class="index-news-more">更多></span>
						<div class="index-news-icon">
							<img src="{pigcms{$static_path}images/xnd_img/phone-index-news.jpg" />
						</div>
						<div class="index-news-title2 apple">
							<ul>
								<if condition="$tuifarms">
									<volist name="tuifarms" id="farm" key="k">
										<li>
									<a href="{pigcms{$farm.url}">{pigcms{$k}、{pigcms{$farm.name}</a>
								</li>
									</volist>
									<else/>
									<li><a href="#">未获取到最新的农场信息</a></li>
								</if>
							</ul>
							  
						</div>
						<div style="clear: both;"></div>
					</div>
				</div>
			</div>
			
			<!-- 农场活动 -->
			<div class="photo-index-activity">
				<div class="index-sales-title">
					<span></span>
					<h3>农场活动</h3>
				</div>
				<div class="index-activity-con">
					<ul>
						<if condition="$activities">
							<volist name="activities" id="activity">
								<li>
									<if condition="$activity['type'] eq 2">
									<a href="{pigcms{$activity.url}">
										<div class="activity-con-img" style="background-image: url({pigcms{$activity.pic});"></div>
										<div class="activity-con-right">
											<h3>{pigcms{$activity.product_name}</h3>
											<span>&yen; {pigcms{$activity.money}</span>
											<h4>截止时间：<php>echo date("Y-m-d",$activity['end_time']);</php></h4>
										</div>
									</a>
									<else/>
									<a href="{pigcms{$activity.url}">
										<div class="activity-con-img" style="background-image: url({pigcms{$activity.pic});"></div>
										<div class="activity-con-right">
											<h3>{pigcms{$activity.product_name}</h3>
											<span>&yen;<php>echo sprintf(" %1\$.2f",$activity['money']);</php></span>
											<h4>截止时间：<php>echo date("Y-m-d",$activity['end_time']);</php></h4>
										</div>
									</a>
									</if>
								</li>
							</volist>
							<else/>
							<li>未获取到数据。。。</li>
						</if>
						<div style="clear: both;"></div>
					</ul>
				</div>
				<!-- 最新提醒 -->
					<div class="phone-index-tx">
						<span class="index-news-more">更多></span>
						<div class="index-news-icon">
							<img src="{pigcms{$static_path}images/xnd_img/phone-index-news.jpg" />
						</div>
						<div class="index-news-title apple">
							<ul>
								<if condition="$tuiactivities">
									<volist name="tuiactivities" id="activity" key="k">
										<li>
									<a href="{pigcms{$activity.url}">{pigcms{$k}、{pigcms{$activity.product_name}</a>
								</li>
									</volist>
									<else/>
									<li><a href="#">未获取到最新的活动信息</a></li>
								</if>
							</ul>
							  
						</div>
						<div style="clear: both;"></div>
					</div>
			</div>
			
			<!-- 猜你喜欢 -->
			<div class="photo-index-cai">
				<div class="index-sales-title">
					<span></span>
					<h3>猜你喜欢</h3>
				</div>
				<div class="xnd-phone-more">
				<ul>
					<if condition="$groups">
						<volist name="groups" id="group">
							<li>
								<a href="{pigcms{$group.url}">
									<div class="xnd-phone-more-img" style="background-image: url({pigcms{$group.list_pic});">
									</div>
									<h3 class="xnd-phone-more-tit">{pigcms{$group.name}</h3>
									<div class="xnd-phone-more-con">
										<span><b>&yen;{pigcms{$group.price}</b></span>
										<h3>销售：<php>echo $group['sale_count']+$group['virtual_num'];</php></h3>
									</div>
								</a>
								<div style="clear: both;"></div>
							</li>
						</volist>
						<else/>
						<li>未获取到数据。。。</li>
					</if>
				</ul>
				<div style="clear: both;"></div>
			</div>
			</div>
			<div class="xnd-logo">
				<img src="{pigcms{$static_path}images/xnd_img/xnd-logo.png" />
			</div>
		</div>
		
		<script type="text/javascript"> 
			  function autoScroll(obj){  
					$(obj).find("ul").animate({  
						marginTop : "-20px"  
					},500,function(){  
						$(this).css({marginTop : "0px"}).find("li:first").appendTo(this);  
					})  
				}  
				$(function(){  
					setInterval('autoScroll(".apple")',3000);
					  
				}) 
		</script> 
		<script id="swipe" type="text/tmpl">
			<div class="addWrap">
			<div class="swipe" id="mySwipe">
				<div class="swipe-wrap">
					<volist name="bannerresult" id="banner">
					<div><a href="{pigcms{$banner.url}"><img class="img-responsive" src="{pigcms{$banner.pic}" /></a></div>
					</volist>
				</div>
			</div>
			<ul id="position">
			<volist name="bannerresult" id="banner" key="k">
			<if condition="$k eq 1">
				<li class="cur"></li>
				<else/>
				<li></li>
				</if>
				</volist>
			</ul>
			</div>
	    </script>
	    <script type="text/javascript">
			$(document).ready(function(){
				$("#iswipe").html($('#swipe').html());
				var bullets = document.getElementById('position').getElementsByTagName('li');
				var banner = Swipe(document.getElementById('mySwipe'), {
					auto: 4000,
					continuous: true,
					disableScroll:false,
					callback: function(pos) {
						var i = bullets.length;
						while (i--) {
							bullets[i].className = ' ';
						}
						if(pos<=bullets.length){
							bullets[pos].className = 'cur';
						}
					}
				})
				$('.drawer').drawer();
			});
        </script>
	</body>
</html>
