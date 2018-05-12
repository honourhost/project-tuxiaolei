<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>小农拼</title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/groupbuy/newtuan.css"/>
		<link rel="stylesheet" href="{pigcms{$static_path}css/groupbuy/idangerous.swiper.css?4.14">
		<script type="text/javascript" src="{pigcms{$static_path}js/groupbuy/jquery-1.9.1.min.js"></script>
		<style>
			.swiper-container{
				width: 100%;
				height: 240px;
				position: relative;
				background: #fff;
			}
			.swiper-pagination{
				position: absolute;
				bottom: 5px;
				left: 0px;
				text-align: center;
				left: 50%;
				margin-left: -20px;
			}
		</style>
	</head>
	<body>
		
		<!-- 最新订单提醒 -->
		 <div class="news-dingdan">
            <a href="{pigcms{:U('GroupBuy/show',array('sun_id'=>$now_pin_order['sun_id']))}">
            <span></span>
            <div class="news-dingdan-c">
            <if condition="$now_pin_order">
                <img src="{pigcms{$now_pin_order.list_pic}" />最新订单来自{pigcms{$now_pin_order.contact_name}，<?php echo time()-$now_pin_order['add_time'];?>秒前
            </if>
            </div>
            </a>
        </div>
		<div class="public-cen">
			<div class="pin-jieshao">
				<a href="{pigcms{:U('groupbuy/more')}">
				<img src="{pigcms{$static_path}img/index-header.jpg" />
				<span>查看规则</span>
				</a>
			</div>
			
			<!-- 今日必拼 -->
			<div class="day-pin">
				<span></span>
				<h3><b>今日必拼</b>生态美味白菜价拼回家</h3>
			</div>
			<!-- 三款推荐商品 -->
			<div class="swiper-container">
		        <div class="swiper-wrapper">
		            <div class="swiper-slide">
		            	<a href="">
							<div class="slide-list">
								<div class="hot-img" style="background-image: url({pigcms{$static_path}img/img2.png);">
									<span>热销</span>
								</div>
								<h3 class="hot-title">5悠乐果悠乐果越南青芒4悠乐果越南青芒4越南青芒4.5斤</h3>
								<div class="hot-fot">
									<div class="left hot-price">
										<h3>&yen;29.90</h3>
										<span>2人成团</span>
									</div>
									<span class="hot-btn">去开团</span>
									<div style="clear: both;"></div>
								</div>
								<span class="hot-line"></span>
							</div>
						</a>
						<a href="">
							<div class="slide-list">
								<div class="hot-img" style="background-image: url({pigcms{$static_path}img/img2.png);">
									<span>热销</span>
								</div>
								<h3 class="hot-title">5悠乐果悠乐果越南青芒4悠乐果越南青芒4越南青芒4.5斤</h3>
								<div class="hot-fot">
									<div class="left hot-price">
										<h3>&yen;29.90</h3>
										<span>2人成团</span>
									</div>
									<span class="hot-btn">去开团</span>
									<div style="clear: both;"></div>
								</div>
								<span class="hot-line"></span>
							</div>
						</a>
						<a href="">
							<div class="slide-list">
								<div class="hot-img" style="background-image: url({pigcms{$static_path}img/img2.png);">
									<span>热销</span>
								</div>
								<h3 class="hot-title">5悠乐果悠乐果越南青芒4悠乐果越南青芒4越南青芒4.5斤</h3>
								<div class="hot-fot">
									<div class="left hot-price">
										<h3>&yen;29.90</h3>
										<span>2人成团</span>
									</div>
									<span class="hot-btn">去开团</span>
									<div style="clear: both;"></div>
								</div>
								<span class="hot-line"></span>
							</div>
						</a>
		            </div>
		            <div class="swiper-slide">
		            	<a href="">
							<div class="slide-list">
								<div class="hot-img" style="background-image: url({pigcms{$static_path}img/img2.png);">
									<span>热销</span>
								</div>
								<h3 class="hot-title">5悠乐果悠乐果越南青芒4悠乐果越南青芒4越南青芒4.5斤</h3>
								<div class="hot-fot">
									<div class="left hot-price">
										<h3>&yen;29.90</h3>
										<span>2人成团</span>
									</div>
									<span class="hot-btn">去开团</span>
									<div style="clear: both;"></div>
								</div>
								<span class="hot-line"></span>
							</div>
						</a>
						<a href="">
							<div class="slide-list">
								<div class="hot-img" style="background-image: url({pigcms{$static_path}img/img2.png);">
									<span>热销</span>
								</div>
								<h3 class="hot-title">5悠乐果悠乐果越南青芒4悠乐果越南青芒4越南青芒4.5斤</h3>
								<div class="hot-fot">
									<div class="left hot-price">
										<h3>&yen;29.90</h3>
										<span>2人成团</span>
									</div>
									<span class="hot-btn">去开团</span>
									<div style="clear: both;"></div>
								</div>
								<span class="hot-line"></span>
							</div>
						</a>
						<a href="">
							<div class="slide-list">
								<div class="hot-img" style="background-image: url({pigcms{$static_path}img/img2.png);">
									<span>热销</span>
								</div>
								<h3 class="hot-title">5悠乐果悠乐果越南青芒4悠乐果越南青芒4越南青芒4.5斤</h3>
								<div class="hot-fot">
									<div class="left hot-price">
										<h3>&yen;29.90</h3>
										<span>2人成团</span>
									</div>
									<span class="hot-btn">去开团</span>
									<div style="clear: both;"></div>
								</div>
								<span class="hot-line"></span>
							</div>
						</a>
		            </div>
		            
		        </div>
		        <!-- Add Pagination -->
		        <div class="swiper-pagination"></div>
		    </div>
			
			<!-- 拼团广场 -->
			<div class="day-pin" style="margin-top: 10px;">
				<span></span>
				<h3><b>拼团广场</b>达人精选产品邀您直接参团</h3>
			</div>
			<div class="pin-tuijian">
				<ul>
					<li>
						<a href="#"><img src="{pigcms{$static_path}img/tuijian.jpg" /></a>
					</li>
					<li>
						<a href="#"><img src="{pigcms{$static_path}img/tuijian2.jpg" /></a>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<div class="index-guanggao">
				<img src="{pigcms{$static_path}img/index-guanggao.jpg" />
			</div>
			<div class="tuan-nav">
				<ul>
					<li class="ons">
						<a href="pintuan.html">
						<img src="{pigcms{$static_path}img/icon-shuiguo.png">
						<h3>水果</h3>
						<span></span>
						</a>
					</li>
					<li>
						<a href="pintuan.html">
						<img src="{pigcms{$static_path}img/icon-jianguo.png">
						<h3>坚果</h3>
						<span></span>
						</a>
					</li>
					<li>
						<a href="pintuan.html">
						<img src="{pigcms{$static_path}img/icon-shengxian.png">
						<h3>生鲜</h3>
						<span></span>
						</a>
					</li>
					<li>
						<a href="pintuan.html">
						<img src="{pigcms{$static_path}img/icon-techan.png">
						<h3>地方特产</h3>
						<span></span>
						</a>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<div class="tuan-list">
				<ul>
					<li>
						<a href="details.html">
						<div class="tuan-list-img" style="background-image: url({pigcms{$static_path}img/img.png);"></div>
						<h3>三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠</h3>
						<div class="tuan-icon">
							<i>海南直发</i>
							<i>清凉爽口</i>
							<i>携带方便</i>
						</div>
						<div class="tuan-list-foot">
							<span class="right tuan-btn">去开团<img src="{pigcms{$static_path}img/jiantou.png" /></span>
							<span class="left num"><img src="{pigcms{$static_path}img/tuan.png">10人团</span>
							<span class="left price">&yen;<i>1.2</i></span>
							<del class="left old-price">单买价：&yen;128</del>
						</div>
						<div style="clear: both;"></div>
						</a>
					</li>
					<li>
						<a href="details.html">
						<div class="tuan-list-img" style="background-image: url({pigcms{$static_path}img/img.png);"></div>
						<h3>三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠</h3>
						<div class="tuan-icon">
							<i>海南直发</i>
							<i>清凉爽口</i>
							<i>携带方便</i>
						</div>
						<div class="tuan-list-foot">
							<span class="right tuan-btn">去开团<img src="{pigcms{$static_path}img/jiantou.png" /></span>
							<span class="left num"><img src="{pigcms{$static_path}img/tuan.png">10人团</span>
							<span class="left price">&yen;<i>1.2</i></span>
							<del class="left old-price">单买价：&yen;128</del>
						</div>
						<div style="clear: both;"></div>
						</a>
					</li>
					<li>
						<a href="details.html">
						<div class="tuan-list-img" style="background-image: url({pigcms{$static_path}img/img.png);"></div>
						<h3>三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠</h3>
						<div class="tuan-icon">
							<i>海南直发</i>
							<i>清凉爽口</i>
							<i>携带方便</i>
						</div>
						<div class="tuan-list-foot">
							<span class="right tuan-btn">去开团<img src="{pigcms{$static_path}img/jiantou.png" /></span>
							<span class="left num"><img src="{pigcms{$static_path}img/tuan.png">10人团</span>
							<span class="left price">&yen;<i>1.2</i></span>
							<del class="left old-price">单买价：&yen;128</del>
						</div>
						<div style="clear: both;"></div>
						</a>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<div class="footer-kong"></div>
			<div class="pub-footer">
				<ul>
					<li>
						<a href="/wap.php">
							<img src="{pigcms{$static_path}img/icon-shouye.png" />
							<h3>首页</h3><!-- 跳转到小农丁首页 -->
                        </a>
					</li>
					<li>
						<a href="#">
							<img src="{pigcms{$static_path}img/icon-pintuan.png" />
							<h3>拼团</h3><!-- 跳转到拼团首页 -->
                        </a>
					</li>
					<li>
						<a href="{pigcms{:U('My/index')}">
							<img src="{pigcms{$static_path}img/icon-my.png" />
							<h3>我的</h3><!-- 跳转到个人中心 -->
                        </a>
					</li>
				</ul>
			</div>
		</div>
     <script src="{pigcms{$static_path}js/groupbuy/idangerous.swiper.min.js"></script>
	 <script>
    var swiper = new Swiper('.swiper-container', {
    	loop:true,
        pagination: '.swiper-pagination',
        paginationClickable: true,
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: 4000,
       
    });
    </script>
    <!-- 滑动板块 -->

   <script>
   $(window).scroll( function (){   
var  h_num=$(window).scrollTop();   
     if (h_num>700){
     	$(".tuan-nav").css("position","fixed");
    } else {   
        $(".tuan-nav").css("position","initial");
    }              
});  
</script>
	</body>
</html>
