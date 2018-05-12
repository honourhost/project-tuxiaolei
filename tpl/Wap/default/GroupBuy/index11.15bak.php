<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>农小拼</title>
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
				height: 225px;
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
			.xnd-index{
				width: 40px;
				position: fixed;
				top: 80px;
				left: 10px;
				z-index: 2000000;
			}
			.xnd-index img{
				width: 100%;
			}
			.xnd-phone-po-bg{
				position: fixed;
				left: 0;
				top: 0;
				background: #000000;
				opacity: 0.5;
				z-index: 100000;
				width: 100%;
				height: 100%;
			}
			.xnd-phone-po-div{
				width: 200px;
				margin: 0px auto;
				position: fixed;
				z-index: 100001;
				top: 20%;
				left: 50%;
				text-align: center;
				margin-left: -130px;
			}
			.po-img{
				width: 260px;
				text-align: center;
				margin: 20px auto;
			}
			.po-close{
				width: 35px;
				height: 35px;
				position: absolute;
				right: -60px;
				top: -10px;
			}

		</style>
	</head>
	<body>
	<!--	<div class="xnd-phone-po-bg"></div>
		<div class="xnd-phone-po-div">
			<img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/xnd-phone-po-close.png" class="po-close" />
			<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Topic&a=index&topic=duoshou">
				<img src="http://www.xiaonongding.com/tpl/Wap/pure/static/images/1111.png" class="po-img" />
			</a>
		</div>-->

		<!-- 最新订单提醒 -->
		 <div class="news-dingdan" style=" display:none;">
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
			<div class="xnd-index" style="display: none;">
				<a href="./wap.php">
				<img src="{pigcms{$static_path}img/xnd-icon.png" />
				</a>
			</div>
			<div class="pin-jieshao">
				<a href="{pigcms{:U('groupbuy/more')}">
				<img src="{pigcms{$static_path}img/index-header.jpg" />
				<span><i></i><b>查看规则</b></span>
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
		            <volist name="group_list" id="groupbuy" key="k">
		            	<if condition="$k lt 4">
		            <a href="{pigcms{:U('NewGroup/detail',array('group_id'=>$groupbuy['group_id']))}">
							<div class="slide-list">
								<div class="hot-img" style="background-image: url({pigcms{$groupbuy.list_pic});">
									
								</div>
								<h3 class="hot-title">{pigcms{$groupbuy.group_name}</h3>
								<div class="hot-fot">
									<div class="left hot-price">
										<h3>&yen;{pigcms{$groupbuy.price}</h3>
										<span>{pigcms{$groupbuy.need_num}人成团</span>
									</div>
									<span class="hot-btn">去开团</span>
									<div style="clear: both;"></div>
								</div>
								<span class="hot-line"></span>
							</div>
						</a>
						</if>
		            </volist>
		            </div>
		            <div class="swiper-slide">
		            <volist name="group_list" id="groupbuy" key="k">
		            	<if condition="$k gt 3">
		            <a href="{pigcms{:U('NewGroup/detail',array('group_id'=>$groupbuy['group_id']))}">
							<div class="slide-list">
								<div class="hot-img" style="background-image: url({pigcms{$groupbuy.list_pic});">
									
								</div>
								<h3 class="hot-title">{pigcms{$groupbuy.group_name}</h3>
								<div class="hot-fot">
									<div class="left hot-price">
										<h3>&yen;{pigcms{$groupbuy.price}</h3>
										<span>{pigcms{$groupbuy.need_num}人成团</span>
									</div>
									<span class="hot-btn">去开团</span>
									<div style="clear: both;"></div>
								</div>
								<span class="hot-line"></span>
							</div>
						</a>
						</if>
		            </volist>
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
						<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=NewGroup&a=detail&group_id=1424"><img src="{pigcms{$static_path}img/tuijian.jpg" /></a>
					</li>
					<li>
						<a href="http://www.xiaonongding.com/wap.php?g=Wap&c=NewGroup&a=detail&group_id=1423"><img src="{pigcms{$static_path}img/tuijian2.jpg" /></a>
					</li>
				</ul>
				<div style="clear: both;"></div>
				<div class="index-guanggao">
				<img src="{pigcms{$static_path}img/index-guanggao.jpg" />
			</div>
			</div>
			
			<a name="fenlei"></a>
			<div class="tuan-nav">
				<ul id="tags">
					<li class="selectTag">
						<A onClick="selectTag('tagContent0',this)" href="#fenlei">
						<img src="{pigcms{$static_path}img/icon-shuiguo.png">
						<h3>水果</h3>
						<span></span>
						</a>
					</li>
					<li>
						<A onClick="selectTag('tagContent1',this)" href="#fenlei">
						<img src="{pigcms{$static_path}img/icon-jianguo.png">
						<h3>坚果</h3>
						<span></span>
						</a>
					</li>
					<li>
						<A onClick="selectTag('tagContent2',this)" href="#fenlei">
						<img src="{pigcms{$static_path}img/icon-shengxian.png">
						<h3>生鲜</h3>
						<span></span>
						</a>
					</li>
					<li>
						<A onClick="selectTag('tagContent3',this)" href="#fenlei">
						<img src="{pigcms{$static_path}img/icon-techan.png">
						<h3>地方特产</h3>
						<span></span>
						</a>
					</li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<div class="tuan-list" id="tagContent">
				<DIV class="tagContent selectTag" id="tagContent0">
				<ul>
				  <volist name="new_group_lists" id="groupbuy">
				  <li>
						<a href="{pigcms{:U('NewGroup/detail',array('group_id'=>$groupbuy['group_id']))}">
						<div class="tuan-list-img" style="background-image: url({pigcms{$groupbuy.list_pic});"></div>
						<h3>{pigcms{$groupbuy.s_name}{pigcms{$groupbuy.group_name}</h3>
						<h3 style="display:none">{pigcms{$groupbuy.name}</h3>
						<div class="tuan-icon">
							 <i>产地直供</i>
							<i>团长免单</i>
							<i>七天退换</i> 
						</div>
						<div class="tuan-list-foot">
							<span class="right tuan-btn">去开团<img src="{pigcms{$static_path}img/jiantou.png" /></span>
							<span class="left num"><img src="{pigcms{$static_path}img/tuan.png">{pigcms{$groupbuy.need_num}人团</span>
							<span class="left price">&yen;<i>{pigcms{$groupbuy.price}</i></span>
							<del class="left old-price">单买价：&yen;<?php echo getGroupPrice($groupbuy['related_id']);?></del>
						</div>
						<div style="clear: both;"></div>
						</a>
					</li>
				  </volist>
					
				</ul>
				<div style="clear: both;"></div>
				</DIV><!-- 
				<DIV class="tagContent" id="tagContent1">
					<ul>
					<li>
						<a href="details.html">
						<div class="tuan-list-img" style="background-image: url({pigcms{$static_path}img/img.png);"></div>
						<h3>只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠</h3>
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
				</DIV>
				<DIV class="tagContent" id="tagContent2">
					<ul>
					<li>
						<a href="details.html">
						<div class="tuan-list-img" style="background-image: url({pigcms{$static_path}img/img.png);"></div>
						<h3>松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠</h3>
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
				</DIV>
				<DIV class="tagContent" id="tagContent3">
					<ul>
					<li>
						<a href="details.html">
						<div class="tuan-list-img" style="background-image: url({pigcms{$static_path}img/img.png);"></div>
						<h3>鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠三只松鼠</h3>
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
				</DIV> -->
				<div style="clear: both;"></div>
			</div>
			<style>
				.xnd-btn-index{
					display: block;
					width: 96%;
					margin: 0px auto;
					height: 45px;
					line-height: 45px;
					text-align: center;
					border-radius: 5px;
					background: #ff6735;
					color: #fff;
					font-size: 14px;
				}
				.xnd-btn-index a{
					display: block;
					width: 100%;
					height: 40px;
					color: #fff;
				}
			</style>
			<div class="xnd-btn-index">
				<a href="./wap.php">进入小农丁商城</a>
			</div>
			<div class="footer-kong"></div>
			<div class="pub-footer">
				<ul>
					<li class="ft-on">
						<a href="{pigcms{:U('GroupBuy/index')}">
							<img src="{pigcms{$static_path}img/icon-shouye.png" />
							<h3>今日拼团</h3><!-- 跳转到小农丁首页 -->
                        </a>
					</li>
					<li>
						<a href="{pigcms{:U('GroupBuy/lists')}">
							<img src="{pigcms{$static_path}img/icon-pintuan.png" />
							<h3>团长免单</h3><!-- 跳转到拼团首页 -->
                        </a>
					</li>
					<li>
						<a href="{pigcms{:U('My/group_buy_list')}">
							<img src="{pigcms{$static_path}img/icon-my.png" />
							<h3>个人中心</h3><!-- 跳转到个人中心 -->
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
<SCRIPT type=text/javascript>
	function selectTag(showContent, selfObj) {
		// 操作标签
		var tag = document.getElementById("tags").getElementsByTagName("li");
		var taglength = tag.length;
		for(i = 0; i < taglength; i++) {
			tag[i].className = "";
		}
		selfObj.parentNode.className = "selectTag";
		// 操作内容
		for(i = 0; j = document.getElementById("tagContent" + i); i++) {
			j.style.display = "none";
		}
		document.getElementById(showContent).style.display = "block";

	}
</SCRIPT>
<script type="text/javascript">
		$(document).ready(function(){
		  $(".po-close").click(function(){
		  $(".xnd-phone-po-bg").hide();
		  $(".xnd-phone-po-div").hide();
		  });
		  $(".po-img").click(function(){
		  $(".xnd-phone-po-bg").hide();
		  $(".xnd-phone-po-div").hide();
		  });
		  $(".xnd-phone-po-bg").click(function(){
		  $(".xnd-phone-po-bg").hide();
		  $(".xnd-phone-po-div").hide();
		  });
		});
	</script>

<script type="text/javascript">
            var shareData={
                        imgUrl: "{pigcms{$static_path}/pinlogo.jpg", 
                        link: "{pigcms{$config.site_url}{pigcms{:U('GroupBuy/index')}",
                        title: "农小拼，好便宜",
                        desc: "小农丁官方拼团频道，史上最牛的农产品特卖平台"
            };
        </script>
         <include file="Share:share"/>
	</body>
</html>
