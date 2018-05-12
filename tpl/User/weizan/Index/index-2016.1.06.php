<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>{pigcms{$config.group_alias_name}订单| {pigcms{$config.site_name}</title>
<meta name="keywords" content="{pigcms{$config.seo_keywords}" />
<meta name="description" content="{pigcms{$config.seo_description}" />
<link href="{pigcms{$static_path}css/xnd_css/common.css" type="text/css"  rel="stylesheet" />
<link href="{pigcms{$static_path}css/header.css"  rel="stylesheet"  type="text/css" />
<link href="{pigcms{$static_path}css/meal_order_list.css"  rel="stylesheet"  type="text/css" />
<script src="{pigcms{$static_path}js/jquery-1.7.2.js"></script>
<script src="{pigcms{$static_public}js/jquery.lazyload.js"></script>
	<script type="text/javascript">
	   var  meal_alias_name = "{pigcms{$config.meal_alias_name}";
	</script>
<script src="{pigcms{$static_path}js/common.js"></script>
<script src="{pigcms{$static_path}js/category.js"></script>
<!--[if IE 6]>
<script  src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js" mce_src="{pigcms{$static_path}js/DD_belatedPNG_0.0.8a.js"></script>
<script type="text/javascript">
   DD_belatedPNG.fix('.enter,.enter a,.enter a:hover');
</script>
<script type="text/javascript">DD_belatedPNG.fix('*');</script>
<style type="text/css"> 
body{behavior:url("{pigcms{$static_path}css/csshover.htc");}
.category_list li:hover .bmbox {filter:alpha(opacity=50);}
.gd_box{display: none;}
</style>
<![endif]-->
<script src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
</head>
<body id="orders" class="has-order-nav" style="position:static;">
<include file="Public:header_top"/>
 <div class="body pg-buy-process"> 
	<div id="doc" class="bg-for-new-index">
		<include file="liuchang/moban/nav.php"/>
		<div id="bdw" class="bdw">
			<div id="bd" class="cf">
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/order-nav.v0efd44e8.css" />
				<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/order-list.v04de2fe7.css" />
				<include file="Public:sidebar"/>
				<div id="content" class="coupons-box">
					<div class="mainbox mine">
						<select class="J-orders-filter orders-filter dropdown--small">
							<option value="0" <if condition="$_GET['status'] eq 0">selected="selected"</if>>全部状态</option>
							<option value="-1" <if condition="$_GET['status'] eq -1">selected="selected"</if>>未付款</option>
							<option value="1" <if condition="$_GET['status'] eq 1">selected="selected"</if>>未消费</option>
							<option value="2" <if condition="$_GET['status'] eq 2">selected="selected"</if>>未评论</option>
							<option value="3" <if condition="$_GET['status'] eq 3">selected="selected"</if>>已完成</option>
						</select>
						<div class="orders-wrapper" id="order-list">
							<div class="orders-head">
								<div class="order-cell order-info">{pigcms{$config.group_alias_name}信息</div>
								<div class="order-cell order-quantity">数量</div>
								<div class="order-cell order-money">总价</div>
								<div class="order-cell order-status">订单状态</div>
								<div class="order-cell order-op">操作</div>
							</div>
							<volist name="order_list" id="vo">
								<div class="J-order-w">
									<div class="order-title">订单编号：<a href="{pigcms{:U('Index/group_order_view',array('order_id'=>$vo['order_id']))}" target="_blank">{pigcms{$vo.order_id}</a><if condition="empty($vo['paid'])"><a class="del order-cancel" href="{pigcms{:U('Index/group_order_del',array('order_id'=>$vo['order_id']))}"></a></if></div>
									<div class="order-row">
										<div class="order-cell order-op order-cell--right">
										   <if condition="$vo['status'] eq 3">	
											<elseif condition="empty($vo['paid'])" />
												<a class="btn-hot btn-mini" href="{pigcms{:U('Index/Pay/check',array('type'=>'group','order_id'=>$vo['order_id']))}">付款</a>
											<elseif condition="$vo['status'] == 1"/>
											 <if condition="$vo['user_confirm']==0">
												   <a href="{pigcms{:U('Index/group_order_confirm',array('order_id'=>$vo['order_id']))}">点击确认商品（不点击15天后自动确认）</a>
											   <else/>
												   <p>已确认</p>
											   </if>
												<a href="{pigcms{:U('Rates/index')}">评价</a>
											</if>
										</div>
										<div class="order-row--sub order-row--last">
											<div class="order-cell order-info">
												<div class="deal-info cf">
													<a class="img-w" href="{pigcms{$vo.url}" target="_blank" title="{pigcms{$vo.s_name}">
														<img src="{pigcms{$vo.list_pic}" width="81" height="50"/>
													</a>
													<div class="info-detail">
														<a class="deal-title" href="{pigcms{$vo.url}" title="{pigcms{$vo.s_name}" target="_blank">{pigcms{$vo.s_name}</a>
														<p>{pigcms{$config.group_alias_name}结束：{pigcms{$vo.end_time|date='Y-m-d',###}</p>
														<!--a target="_blank" class="biz-info" href="{pigcms{:U('Index/Shop/index',array('mer_id'=>$vo['mer_id']))}">商家信息</a-->
													</div>
												</div>
											</div>
											<div class="order-cell order-quantity">{pigcms{$vo.num}</div>
											<div class="order-cell order-money"><span class="money">¥</span>{pigcms{$vo.total_money}</div>
											<div class="order-cell order-status">
											<if condition="$vo['status'] == '3'">已取消并退款
											<elseif condition="empty($vo['paid'])" />未付款<elseif condition="empty($vo['status'])"/>未消费<elseif condition="$vo['status'] == '1'"/>已使用 <elseif condition="$vo['status'] == '2'"/>已完成</if><div><a target="_blank" href="{pigcms{:U('Index/group_order_view',array('order_id'=>$vo['order_id']))}">订单详情</a></div></div>
										</div>
									</div>
								</div>
							</volist>
                        </div>
						{pigcms{$pagebar}
					</div>
				</div>
			</div> <!-- bd end -->
		</div>
	</div>	
	<include file="Public:footer"/>
	<script>
		$(function(){
			$('.J-orders-filter').change(function(){
				window.location.href = "{pigcms{:U('Index/index')}"+'&status='+$(this).val();
			});
			
			$('.order-cancel').click(function(){
				if(!confirm('确定删除订单？删除后本订单将从订单列表消失，且不能恢复。')){
					return false;
				}
			});
		});
	</script>
</body>
</html>
