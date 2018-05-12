<!--头部-->
<include file="Public:top"/>
<!--头部结束-->
<body>
	<!--头部结束-->
	<header class="pigcms-header mm-slideout">
		<a href="#" id="pigcms-header-left" class="iconfont icon-left">
			<i class="iconfont icon-menu "></i>
		</a>			
		<p id="pigcms-header-title">订单详情</p>
		<!--<a id="pigcms-header-right">操作日志</a>-->
	</header>
	<div class="container container-fill" style="padding-top:50px">


		<link rel="stylesheet" href="{pigcms{$static_path}css/shop_order.css">
<script type="text/javascript" src="{pigcms{$static_path}js/iscroll.js"></script>
<script>
	var url = "./index.php?i=1&c=pu&a=shop_order&";
</script>
	<style>
		.pigcms-container{
			padding: 15px;
			margin-bottom: 15px;
		}
	</style>
	<div class="pigcms-main">
		<div class="pigcms-container">
			<p class="order-detail-title">订单编号：<span class="order-detail-text">20150721131558112</span></p>
			<p class="order-detail-title">下单时间：<span class="order-detail-text">2015-07-21 13:15:58</span></p>
			<p class="order-detail-title">支付状态：<span class="order-detail-text">货到付款 </span></p>
						<p class="order-detail-title">订单状态：<span class="order-detail-text">订单超时</span></p>
			<p class="order-detail-title">资金结算：<span class="order-detail-text">交易取消</span></p>
							<p class="order-detail-title">取消时间：<span class="order-detail-text">2015-07-21 13:37:19</span></p>
				<p class="order-detail-title">取消类型：<span class="order-detail-text">订单超时</span></p>
													<p class="order-detail-title">客户姓名：<span class="order-detail-text">Hhhhhh</span></p>
			<p class="order-detail-title"><a href="tel:15956974877">联系电话：<span class="order-detail-text" style="color:#1791ad">15956974877</span></a></p>
			<p class="order-detail-title">送货地址：<span class="order-detail-text">Ggggghhhhh</span></p>
			<p class="order-detail-title">备注信息：<span class="order-detail-text">Hbbvcdrgvcd</span></p>
			<div style="background:#bbdb9c" class="order-operation">
				<a class="order-btn" href="./index.php?i=1&amp;c=pu&amp;a=shop_order&amp;do=confirm&amp;order_id=20150721170254294&amp;wxref=mp.weixin.qq.com#wechat_redirect">
					<i class="iconfont icon-yiguanzhu"></i>
					<p>接单</p>
				</a>
			</div>
			<div style="background:#ffae6c" class="order-operation">
				<a class="order-btn" href="./index.php?i=1&amp;c=pu&amp;a=shop_order&amp;do=change_cut&amp;order_id=20150721170254294&amp;wxref=mp.weixin.qq.com#wechat_redirect">
					<i class="iconfont icon-tuikuan"></i>
					<p>优惠</p>
				</a>
			</div>
			<div style="background:#ff8283;margin-right:0;" class="order-operation">
					<a class="order-btn" href="./index.php?i=1&amp;c=pu&amp;a=shop_order&amp;do=reject&amp;order_id=20150721170254294&amp;wxref=mp.weixin.qq.com#wechat_redirect">
						<i class="iconfont icon-shanchu"></i>
						<p>拒单</p>
					</a>
				</div>

				<div class="clearfix"></div>
		</div>
		<div class="pigcms-container">
			<p class="order-detail-count">配送费：<span class="strong">0.00</span>元<span style="margin-left:20px;">优惠：</span><span class="strong">0.00</span>元</p>
			<p class="order-detail-count">合计：<span class="strong">0.04</span>元<span class="count">(4份)</span></p>
						<div class="order-item-container">
				<img src="order_neiye_files/L6GGqw62mb0Q77mQWQw30T2XgY3W4q.jpg" alt="商品图片" class="order-item-img" onerror="this.src='http://static.xiaopupu.com/wx/resource/images/nopic.jpg'">
				<div style="width: 1770px;" class="order-item-text">
					<p class="order-item-title">一元夺宝fff</p>
					<p class="order-item-price">0.01元 x 2</p>
				</div>
				<div class="clearfix"></div>
			</div>
						<div class="order-item-container">
				<img src="order_neiye_files/q901X22U20CZ2DC2bXzzB92BDJQc90.jpg" alt="商品图片" class="order-item-img" onerror="this.src='http://static.xiaopupu.com/wx/resource/images/nopic.jpg'">
				<div style="width: 1770px;" class="order-item-text">
					<p class="order-item-title">dddd</p>
					<p class="order-item-price">0.01元 x 2</p>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<style>
		.log_wrap{text-align:left;margin-bottom:5px;padding:0 10px;}
		.log_wrap p{margin:0}
		.log_content{margin-left:30px!important}
	</style>
	</div>
	<script>
		$(".order-item-text").css('width', $(window).width()-150);
		$("#comment-container").css('width', $(window).width()-105);
		$("#pigcms-header-right").click(function(){
			$.post("./index.php?i=1&c=pu&a=shop_order&do=log&", {'order_id':'20150721131558112'}, function(data) {
				log_list = $.parseJSON(data);
				var log_content = '';
				for(var i=0;i<log_list.length;i++){
					log_content += "<div class='log_wrap'><p class='log_time'>" + log_list[i].created + "</p><p class='log_content'>" + log_list[i].content + "</p></div>";
				}
				alert_open('操作日志',log_content);
			});
		})
	</script>
</body>
</html>