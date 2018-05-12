<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<meta name="format-detection" content="telphone=no, email=no"/> 
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/common.css"/>
		<link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/xnd_css/xnd-phone-show.css"/>
		<script src="{pigcms{$static_path}js/jquery-1.9.1.min.js"></script>
    </head>
	<body class="phone-order-body">
		<div class="phone-order public_cen">
			<div class="phone-order-header">
				<!-- <input type="radio" class="radio" id="check_all" />
				<h3>全部
					<span class="order-header-bj">编辑</span>
					<span class="order-header-wc">完成</span>
				</h3>
				<div style="clear: both;"></div> -->
			</div>
			<div style="clear: both;"></div>
			<ul class="phone-order-ul">
				<li>
					<input type="checkbox" class="checkbox" name="chk_list" value="{pigcms{$now_group.group_id}">
					<div class="phone-order-right">
						<div class="order-right-shop" style="background-image: url({pigcms{$now_group.all_pic.0.s_image});">
						</div>
						<div class="order-right-title">
							<h3 class="order-h3">
								{pigcms{$now_group.group_name}
							</h3>
							<div class="order-number">
								<div class="Spinner"></div>
								<input type="hidden" id="once_min" value="{pigcms{$now_group.once_min}">
								<input type="hidden" id="once_max" value="{pigcms{$now_group.once_max}">
							</div>
							<b class="order-num-price">
								&yen;<span id='onemoney'>{pigcms{$now_group.price}<span>
							</b>
						</div>
					</div>
				   <div style="clear: both;"></div>
				</li> 
				<div style="clear: both;"></div>
			</ul>
			</div>
			<form id="myform" method="post" action="{pigcms{:U('Group/buy',array('group_id'=>$now_group['group_id']))}">
			
			<div style="width: 100%; height: 60px;"></div>
			<div class="phone-order-footer">
				<div class="order-footer-left">
					<input type="hidden" name="send" id="send">
					<h3>合计：<b>&yen;<span id="total">{pigcms{$now_group.price}</span></b></h3>
					<h4>总额：&yen;<span id="money">{pigcms{$now_group.price}</span></h4>
				</div>
				<a class="order-footer-a" href="#" id="go_pay">
					去结算
				</a>
			</div>
			<div class="phone-order-footer-del" style="display: none;">
				<div class="order-footer-left">
					<p>选择要删除的商品</p>
				</div>
				<a class="order-footer-a" href="#" id="delete">
					删除
				</a>
			</div>
			
		
		</form>
		<script type="text/javascript">
		function  conculateTotal(){
    	var check_all=$("input[type='checkbox']");
    	var total=0;
    		check_all.each(function(){
    			if($(this).attr("checked")){
    				var amount=$(this).next().find(".Amount").val();
    				var price=$(this).next().find("#onemoney").text();
    				total+=price*amount;
    			}
    		});
    	$("#total").html(total);
    	$("#money").html(total);
    	}
		</script>
	<!-- 购买数量加减 -->
	<script type="text/javascript" src="{pigcms{$static_path}js/xnd_js/jquery.Spinner.js"></script>
   <!-- 购买数量加减 -->
	<!-- 复选框样式定义js -->
    <script type="text/javascript" src="{pigcms{$static_path}js/xnd_js/common.js"></script>
    <!-- 复选框样式定义end -->
	</body>
</html>