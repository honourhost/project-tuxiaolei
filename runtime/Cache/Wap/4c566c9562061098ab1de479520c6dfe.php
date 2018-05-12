<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
	<title>订单详情</title>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name='apple-touch-fullscreen' content='yes'>
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="address=no">
    <link href="<?php echo ($static_path); ?>css/eve.7c92a906.css" rel="stylesheet"/>
    <link href="<?php echo ($static_path); ?>css/wap_pay_check.css" rel="stylesheet"/>
	<style>
    .btn-wrapper {
        margin: .28rem .2rem;
    }
    .hotel-price {
        color: #ff8c00;
        font-size: 12px;
        display: block;
    }
    .dealcard .line-right {
        display: none;
    }
    .agreement li {
        display: inline-block;
        width: 50%;
        box-sizing: border-box;
        color: #666;
    }

    .agreement li:nth-child(2n) {
        padding-left: .14rem;
    }

    .agreement li:nth-child(1n) {
        padding-right: .14rem;
    }

    .agreement ul.agree li {
        height: .32rem;
        line-height: .32rem;
    }

    .agreement ul.btn-line li {
        vertical-align: middle;
        margin-top: .06rem;
        margin-bottom: 0;
    }

    .agreement .text-icon {
        margin-right: .14rem;
        vertical-align: top;
        height: 100%;
    }

    .agreement .agree .text-icon {
        font-size: .4rem;
        margin-right: .2rem;
    }


    #deal-details .detail-title {
        background-color: #F8F9FA;
        padding: .2rem;
        font-size: .3rem;
        color: #000;
        border-bottom: 1px solid #ccc;
    }

    #deal-details .detail-title p {
        text-align: center;
    }

    #deal-details .detail-group {
        font-size: .3rem;
        display: -webkit-box;
        display: -ms-flexbox;
    }

    .detail-group .left {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        display: block;
        padding: .28rem 0;
        padding-right: .2rem;
    }

    .detail-group .right {
        display: -webkit-box;
        display: -ms-flexbox;
        -webkit-box-align: center;
        -ms-box-align: center;
        width: 1.2rem;
        padding: .28rem .2rem;
        border-left: 1px solid #ccc;
    }

    .detail-group .middle {
        display: -webkit-box;
        display: -ms-flexbox;
        -webkit-box-align: center;
        -ms-box-align: center;
        width: 1.7rem;
        padding: .28rem .2rem;
        border-left: 1px solid #ccc;
    }

    ul.ul {
        list-style-type: initial;
        padding-left: .4rem;
        margin: .2rem 0;
    }

    ul.ul li {
        font-size: .3rem;
        margin: .1rem 0;
        line-height: 1.5;
    }
    .coupons small{
        float: right;
        font-size: .28rem;
    }
    strong {
        color: #FDB338;
    }
    .coupons-code {
        color: #666;
        text-indent: .2rem;
    }
    .voice-info {
        font-size: .3rem;
        color: #eb8706;
    }
</style>
</head>
<body id="index">
        <div id="tips" class="tips"></div>
		<a href="<?php echo ($now_order["url"]); ?>">
			<dl class="list">
				<dd class="dd-padding">
					<div class="more more-weak">
						<div class="dealcard">
							<div class="dealcard-img imgbox" style="background:none;"><img src="<?php echo ($now_order["list_pic"]); ?>" style="width:100%;height: 1.58rem;"/></div>
							<div class="dealcard-block-right">
								<div class="dealcard-brand single-line"><?php echo ($now_order["s_name"]); ?></div>
								<div class="title text-block">商品单价：<?php echo ($now_order["price"]); ?>元<br/>购买数量：<?php echo ($now_order["num"]); ?></div>
								<div class="price">
									订单总价：<span class="strong" style="color:#2bb2a3;"><?php echo ($now_order["total_money"]); ?></span><span class="strong-color">元</span>
								</div>
							</div>
						</div>
					</div>
				</dd>
			</dl>
		</a>
        <div class="wrapper-list">
			<dl class="list" style="border-bottom:none;"></dl>
			<dl class="list">
				<dd>
					<dl>
						<dd>
			                <a class="react" href="<?php echo U('Group/branch',array('group_id'=>$now_order['group_id']));?>">
			                    <div class="more more-weak">
			                        <h6>商家信息</h6>
			                        <span class="more-after">查看</span>
			                    </div>
			                </a>
		                </dd>
					</dl>
				</dd>
			</dl>
			<?php if($now_order['tuan_type'] != 2): ?><dl class="list coupons">
					<dd>
						<dl>
							<dt><?php echo ($config["group_alias_name"]); ?>券</dt>
							<dd class="dd-padding coupons-code">
								消费密码: <?php echo ($now_order["group_pass_txt"]); ?> <small><?php echo ($now_order["status_txt"]); ?></small>
							</dd>
							<?php if(($now_order['paid'] == 1 AND $now_order['pay_type'] != 'offline') OR ($now_order['paid'] == 1 AND $now_order['pay_type'] == 'offline' AND $now_order['third_id'])): ?><dd class="dd-padding coupons-code">
									消费二维码: <a id="see_storestaff_qrcode">查看二维码</a>
								</dd><?php endif; ?>
						</dl>
					</dd>
				</dl>
			<?php else: ?>
				<dl class="list coupons">
					<dd>
						<dl>
							<dt>快递信息</dt>
							<dd class="dd-padding coupons-code">
								收货人：<?php echo ($now_order["contact_name"]); ?>
							</dd>
							<dd class="dd-padding coupons-code">
								地址：<?php echo ($now_order["adress"]); ?>
							</dd>
							<dd class="dd-padding coupons-code">
								电话：<?php echo ($now_order["phone"]); ?>
							</dd>
							<?php if($now_order['express_type']): ?><dd class="dd-padding coupons-code">
									快递公司：<?php echo ($now_order["express_info"]["name"]); ?>
								</dd>
							<!--	<dd class="dd-padding coupons-code">
									快递单号：<?php echo ($now_order["express_id"]); ?><small><a href="http://m.kuaidi100.com/index_all.html?type=<?php echo ($now_order["express_info"]["code"]); ?>&postid=<?php echo ($now_order["express_id"]); ?>" target="_blank" style="color:#1B9C46;">查看物流信息</a></small>
								</dd>-->
                                <dd class="dd-padding coupons-code">
                                    快递单号：<?php echo ($now_order["express_id"]); ?><small><a href="<?php echo U('My/express_query',array('expresscode'=>$now_order['express_info']['juhecode'],'expressid'=>$now_order['express_id']));?>" target="_blank" style="color:#1B9C46;">查看物流信息</a></small>
                                </dd><?php endif; ?>
						</dl>
					</dd>
				</dl><?php endif; ?>
			<style>
			.phone-remind{
				font-size: 16px;
				color: #949494;
				text-align: center;
				font-family: "microsoft yahei";
			}
			.phone-remind-title{
				padding: 10px 0px;
				display: block;
				width: 100%;
				background: #f0efed;
			}
			.phone-remind-main{
				width: 100%;
				background: #fff;
				height: auto;
				border-top: 1px solid #ddd8ce;
				border-bottom: 1px solid #ddd8ce;
				padding: 5px 0px;
			}
			.phone-remind-main h4{
				font-size: 14px;
				font-family: "microsoft yahei";
				color: #949494;
				font-weight: normal;
				margin: 0px auto;
				padding: 10px 0px;
			}
			.phone-remind-main img{
				height: 120px;
		 	}
		    </style>
			<?php if($now_order['mer_id'] != 686): ?><div class="phone-remind">
				  <div class="phone-remind-title">
				  	 - - - - - - - - - - 友情提醒  - - - - - - - - - -
				  </div>
				  <div class="phone-remind-main">
				  	<h4>请关注小农丁公共号,避免关闭网页后无法查询订单</h4>
				  	<img src="<?php echo ($static_path); ?>images/remind-ma.png" />
				  </div>
			</div>
				<?php else: endif; ?>
			<dl class="list">
				<dd>
					<dl>
						<dt>订单详情</dt>
						<ul class="ul">
							<li>订单编号：<?php echo ($now_order["order_id"]); ?></li>
							<li>下单时间：<?php echo (date('Y-m-d H:i',$now_order["add_time"])); ?></li>
							<li>手机号：<?php echo ($now_order["phone"]); ?></li>
							<li>数量：<?php echo ($now_order["num"]); ?></li>
							<li>总价：<?php echo ($now_order["total_money"]); ?> 元</li>
							<?php if($now_order['third_id'] == '0' AND $now_order['pay_type'] == 'offline'): ?><li>线下需向商家付金额：<font color="red">￥<?php echo ($now_order['total_money']-$now_order['wx_cheap']-$now_order['merchant_balance']-$now_order['balance_pay']); ?>元</font></li>
							<?php elseif(($now_order['pay_type']=='offline' AND $now_order['paid'] AND !empty($now_order['third_id'])) OR ($now_order['pay_type']!='offline' AND $now_order['paid'])): ?>
								<li>付款方式：<?php echo ($now_order["pay_type_txt"]); ?></li>
								<li>付款时间：<?php echo (date('Y-m-d H:i',$now_order["pay_time"])); ?></li>
							   <?php if(!empty($now_order['use_time'])): ?><li>消费时间：<?php echo (date('Y-m-d H:i',$now_order["use_time"])); ?></li><?php endif; endif; ?>
							
							
						</ul>
					</dl>
				</dd>
			</dl>
			<?php if($now_order['status'] == 3): ?><div class="btn-wrapper">
					<span class="btn btn-larger btn-block" style="background-color:#BBB9B5;">订单已取消</span>
				</div>
			<?php elseif(empty($now_order['paid'])): ?>

				<div class="btn-wrapper">			
					<span onclick="window.location.href='<?php echo U('Pay/check',array('type'=>'group','order_id'=>$now_order['order_id']));?>'" class="btn btn-larger btn-block btn-strong" style="margin-bottom:15px;">付款</span>
					<a id="cancel_order">取消订单</a>
				</div>
			<?php elseif($now_order['status'] == 0): ?>
			<?php if($config['group_order_cancle']): ?><div class="btn-wrapper" style="display: none;">
					<span onclick="window.location.href='<?php echo U('My/group_order_refund',array('order_id'=>$now_order['order_id']));?>'" class="btn btn-larger btn-block btn-strong">取消订单</span>
				</div><?php endif; ?>
			<?php elseif($now_order['status'] == 1): ?>
				<div class="btn-wrapper">
					<span onclick="window.location.href='<?php echo U('My/group_feedback',array('order_id'=>$now_order['order_id']));?>'" class="btn btn-larger btn-block btn-strong">评价</span>
				</div><?php endif; ?>
		</div>
    	<script src="<?php echo C('JQUERY_FILE');?>"></script>
		<script src="<?php echo ($static_public); ?>js/jquery.qrcode.min.js"></script>
		<script src="<?php echo ($static_path); ?>js/common_wap.js"></script>		
		<script src="<?php echo ($static_path); ?>layer/layer.m.js"></script>
				<link href="<?php echo ($static_path); ?>css/footer.css" rel="stylesheet"/>
		<?php if(empty($no_gotop)): ?><div style="height:10px"></div>
			<div class="top-btn"><a class="react"><i class="text-icon">⇧</i></a></div><?php endif; ?>
		<?php if(empty($no_footer)): ?><footer class="footermenu">
				<ul>
					<li>
						<a <?php if(MODULE_NAME == 'Home'): ?>class="active"<?php endif; ?> href="<?php echo U('Home/index');?>">
							<em class="home"></em>
							<p>首页</p>
						</a>
					</li>
					<li>
						<a <?php if(MODULE_NAME == 'Group'): ?>class="active"<?php endif; ?> href="<?php echo U('Group/index');?>">
							<em class="group"></em>
							<p><?php echo ($config["group_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('Meal_list','Meal')) AND $store_type == 2): ?>class="active"<?php endif; ?> href="<?php echo U('Meal_list/index', array('store_type' => 2));?>">
							<em class="meal"></em>
							<p><?php echo ($config["meal_alias_name"]); ?></p>
						</a>
					</li>
					<li>
						<a <?php if(in_array(MODULE_NAME,array('My','Login'))): ?>class="active"<?php endif; ?> href="<?php echo U('My/index');?>">
							<em class="my"></em>
							<p>我的</p>
						</a>
					</li>
				</ul>
			</footer><?php endif; ?>
		<div style="display:none;"><?php echo ($config["wap_site_footer"]); ?></div>
        
		<script>
			$(function(){
				$('#cancel_order').click(function(){
					if(confirm('您确定取消订单吗？取消后不能恢复！')){
						window.location.href = "<?php echo U('My/group_order_del',array('order_id'=>$now_order['order_id']));?>";
					}
				});
				$('#see_storestaff_qrcode').click(function(){
					var qrcode_width = $(window).width()*0.6 > 256 ? 256 : $(window).width()*0.6;
					layer.open({
						title:['消费二维码','background-color:#8DCE16;color:#fff;'],
						content:'生成的二维码仅限提供给商家店铺员工扫描验证消费使用！<br/><br/><div id="qrcode"></div>',
						success:function(){
							$('#qrcode').qrcode({
								width:qrcode_width,
								height:qrcode_width,
								text:"<?php echo ($config["site_url"]); ?>/wap.php?c=Storestaff&a=group_qrcode&order_id=<?php echo ($now_order["order_id"]); ?>&id=<?php echo ($now_order["group_pass"]); ?>"
							});
						}
					});
					$('.layermbox0 .layermchild').css({width:qrcode_width+30+'px','max-width':qrcode_width+30+'px'});
				});
			});
		</script>
<?php echo ($hideScript); ?>
</body>
</html>