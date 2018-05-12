<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd-phone-show.css"/>
		<style>
			
			.addWrap{ position:relative; width:100%;background:#f4f4f4;margin:0; padding:0;}
.addWrap .swipe{overflow: hidden;visibility: hidden;position:relative;}
.addWrap .swipe-wrap{overflow:hidden;position:relative;}
.addWrap .swipe-wrap > div {float: left;width: 100%;position:relative;}
#position{ position:absolute; bottom:0; right:0; padding-left:8px; margin:0; opacity: 0.4; width:100%; filter: alpha(opacity=50);text-align:center;}
#position li{width:5px;height:5px;margin:0 2px;display:inline-block;-webkit-border-radius:5px;border-radius:5px;background-color:#ffffff;}
#position li.cur{background-color:#000;}
.img-responsive { display: block; height: 120px; text-align: center;}
		</style>
		<script type="text/javascript" src="{pigcms{$static_path}js/jquery.min.js"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/hhSwipe.js"></script>
	</head>
	<body class="xnd-phone-bg">
		
		<div class="xnd-phone-center">
			<header>
					
                    <style>
                         .areaname{
                             display: block;
                             width: 100%;
                             text-align: center;
                             height: 50px;
                             line-height: 52px;
                             border: none;
                             font-size: 16px;
                             color: #fff;

                         }
                         .areaname img{
                         	height: 20px;
                         	position: relative;
                         	top: 15px;
                         	margin-right: 10px;
                         }
                    </style>
                    <div class="areaname" ><img src="http://www.xiaonongding.com/tpl/Wap/pure/static/img/index/location.png">小农丁甘肃主题馆</div>


				</header>
			<!-- 农场大图 -->
			<div class="xnd-phont-header-img" style="display: none;" style="background-image: url({pigcms{$static_path}images/banner1.jpg);"></div>
			<div class="public_cen" id="iswipe"></div>
			<div class="phone-pinzhi" style="margin-top: 0px;">
				<ul>
					<li>
						<img src="{pigcms{$static_path}images/phone-pinzhi-img01.jpg" />
						原产地
					</li>
					<li>
						<img src="{pigcms{$static_path}images/phone-pinzhi-img02.jpg" />
						品质保证
					</li>
					<li>
						<img src="{pigcms{$static_path}images/phone-pinzhi-img03.jpg" />
						急速发货
					</li>
				</ul>
			</div>
			<ul class="Hundreds-nav">
	   	  	<li>
	   	  		<span><a href="#lanzhou"><img src="{pigcms{$static_path}images/xnd-img01.png"></a></span>
	   	  		
	   	  	</li>
	   	    <li>
	   	  		<span><a href="#tianshui"><img src="{pigcms{$static_path}images/xnd-img02.png"></a></span>
	   	  		
	   	  	</li>
	   	  	<li>
	   	  		<span><a href="#dingxi"><img src="{pigcms{$static_path}images/xnd-img03.png"></a></span>
	   	  		
	   	  	</li>
	   	  	<li>
	   	  		<span><a href="#pingliang"><img src="{pigcms{$static_path}images/xnd-img04.png"></a></span>
	   	  		
	   	  	</li>
	   	  	<li>
	   	  		<span><a href="#longnan"><img src="{pigcms{$static_path}images/xnd-img05.png"></a></span>
	   	  		
	   	  	</li>
	   	  	<li>
	   	  		<span><a href="#linxia"><img src="{pigcms{$static_path}images/xnd-img06.png"></a></span>
	   	  		
	   	  	</li>
	   	  	<li>
	   	  		<span><a href="#jiuquan"><img src="{pigcms{$static_path}images/xnd-img07.png"></a></span>
	   	  		
	   	  	</li>
	   	  	<li>
	   	  		<span><a href="#more"><img src="{pigcms{$static_path}images/xnd-img08.png"></a></span>
	   	  		
	   	  	</li>
	   	  	 <div style="clear: both;"></div>
	   	  </ul>
			<!-- 农场大图 end -->
		
			
			<!-- 农场精品推荐 -->
			<div class="xnd-phone-hot margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>农场特卖推荐</h3>
				</div>
				<div class="xnd-phone-list">
					<ul>
						<li>
							<a href="#">
							<div class="xnd-phone-list-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
							</div>
							<div class="xnd-phone-list-right">
								<h3 class="title">新闻标题新闻标题新闻标题</h3>
								<p>新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容</p>
								<div class="list-right-btm">
									<span>销售：1888</span>
									<h4><b>4.98</b>/斤</h4>
								</div>
							</div>
							</a>
							<div style="clear: both;"></div>
						</li>
						<li>
							<a href="#">
							<div class="xnd-phone-list-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
							</div>
							<div class="xnd-phone-list-right">
								<h3 class="title">新闻标题新闻标题新闻标题</h3>
								<p>新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容</p>
								<div class="list-right-btm">
									<span>销售：1888</span>
									<h4><b>4.98</b>/斤</h4>
								</div>
							</div>
							</a>
							<div style="clear: both;"></div>
						</li>
						<li>
							<a href="#">
							<div class="xnd-phone-list-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
							</div>
							<div class="xnd-phone-list-right">
								<h3 class="title">新闻标题新闻标题新闻标题</h3>
								<p>新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容新闻内容</p>
								<div class="list-right-btm">
									<span>销售：1888</span>
									<h4><b>4.98</b>/斤</h4>
								</div>
							</div>
							</a>
							<div style="clear: both;"></div>
						</li>
						<div style="clear: both;"></div>
					</ul>
				</div>
			</div>
			<!-- 农场精品推荐end -->
			<!-- 农场产品 -->
			<a name="lanzhou"></a>
			<div class="xnd-phone-more margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>兰州馆</h3>
				</div>
				<ul>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<a name="tianshui"></a>
			<div class="xnd-phone-more margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>天水馆</h3>
				</div>
				<ul>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<a name="dingxi"></a>
			<div class="xnd-phone-more margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>定西馆</h3>
				</div>
				<ul>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<a name="pingliang"></a>
			<div class="xnd-phone-more margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>平凉馆</h3>
				</div>
				<ul>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<a name="longnan"></a>
			<div class="xnd-phone-more margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>陇南馆</h3>
				</div>
				<ul>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<a name="linxia"></a>
			<div class="xnd-phone-more margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>临夏馆</h3>
				</div>
				<ul>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<a name="jiuquan"></a>
			<div class="xnd-phone-more margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>酒泉馆</h3>
				</div>
				<ul>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<a name="more"></a>
			<div class="xnd-phone-more margin-top10">
				<div class="xnd-phone-header">
					<span class="fl-span"></span>
					<h3>其他</h3>
				</div>
				<ul>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
					<li>
						<a href="#">
						<div class="xnd-phone-more-img" style="background-image: url({pigcms{$static_path}images/275x185.jpg);">
						</div>
						<h3 class="xnd-phone-more-tit">新闻标题新闻标题新闻标题新闻标题新闻标题</h3>
						<div class="xnd-phone-more-con">
							<span><b>4.98</b>/斤</span>
							<h3>销售：2911</h3>
						</div>
						</a>
						<div style="clear: both;"></div>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<div class="phone_footer">
				2015-2016&copy;小农丁
			</div>
		</div>
		<script id="swipe" type="text/tmpl">
	<div class="addWrap">
	<div class="swipe" id="mySwipe">
		<div class="swipe-wrap">
			<div><a href="javascript:;"><img class="img-responsive" src="{pigcms{$static_path}images/banner1.jpg" /></a></div>
			<div><a href="javascript:;"><img class="img-responsive" src="{pigcms{$static_path}images/banner2.jpg" /></a></div>
			<div><a href="javascript:;"><img class="img-responsive" src="{pigcms{$static_path}images/banner3.jpg" /></a></div>
		</div>
	</div>
	<ul id="position">
		<li class="cur"></li>
		<li></li>
		<li></li>
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
