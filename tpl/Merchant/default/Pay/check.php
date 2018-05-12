<include file="Public:header" />

<div class="main-content">
	<div class="sysmsgw common-tip" id="sysmsg-error" style="display:none;"></div>
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				交纳押金
			</li>
		</ul>
	</div>
	<style>
		.form-xinxi {
			width: 100%;
			height: 40px;
			background: #f8f9fd;
			line-height: 40px;
			margin-bottom: 30px;
		}
		
		.form-xinxi h3 {
			font-size: 16px;
			margin-left: 10px;
			color: #a1a1a1;
			line-height: 40px;
		}
		
		.form-xinxi2 {
			width: 100%;
			height: 40px;
			background: #f8f9fd;
		}
		
		.form-xinxi2 h3 {
			font-size: 16px;
			margin-left: 10px;
			color: #a1a1a1;
			line-height: 40px;
		}
		
		.form-page-nav {
			width: 100%;
			margin: 10px auto;
			height: 150px;
		}
		
		.form-page-nav ul {
			height: 60px;
			margin-left: 10%;
		}
		
		.form-page-nav ul li {
			float: left;
			list-style-type: none;
			height: 60px;
			padding: 0px 40px;
			font-size: 18px;
			line-height: 60px;
			text-align: center;
			color: #fff;
			font-family: "microsoft yahei";
		}
		
		#page-nav-01 {
			background: #2bb0db;
			border-radius: 30px 0px 0px 30px;
		}
		
		#page-nav-02 {
			background: #4bb9dc;
		}
		
		#page-nav-03 {
			background: #6bc6e3;
			height: 70px;
			position: relative;
			top: -5px;
			line-height: 70px;
			font-size: 20px;
		}
		
		#page-nav-04 {
			background: #88d4ec;
		}
		
		.page-nav-05 {
			background: #a1def1;
		}
		
		.page-nav-06 {
			background: #b8e6f5;
		}
		
		.page-nav-07 {
			background: #d3f1fb;
		}
		
		.form-page-nav p {
			text-align: center;
			width: 100%;
			font-size: 14px;
			color: #a2a2a2;
			padding-top: 10px;
		}
		
		.tab-content {
			border: 0;
		}
		
		.form-group {
			height: 50px;
		}
		
		.tab-content-bzj {
			width: 80%;
			margin: 0px auto;
		}
		
		.tab-content-price {
			width: 100%;
			height: 60px;
			margin-top: 20px;
		}
		
		.tab-content-price label {
			float: left;
			width: 80px;
			font-size: 16px;
			color: #888888;
			height: 55px;
			line-height: 55px;
		}
		
		.tab-content-price-sp {
			display: inline-block;
			float: left;
			width: 170px;
			height: 55px;
			line-height: 55px;
			font-size: 28px;
			font-family: "microsoft yahei";
			color: #ff8b27;
			text-align: center;
			margin-right: 10px;
			background: #ededed;
		}
		
		.tab-content-price img {
			height: 47px;
		}
		
		.tab-content-btn {
			clear: both;
			display: block;
			margin: 0px auto;
			width: 358px;
			height: 65px;
			line-height: 65px;
			text-align: center;
			background: #ff8b26;
			color: #fff;
			font-size: 28px;
			border-radius: 5px;
			text-decoration: none;
			font-weight: bold;
		}
		
		.wx-onclick {
			display: inline-block;
			float: left;
			width: 170px;
			height: 55px;
			line-height: 45px;
			font-size: 28px;
			font-family: "microsoft yahei";
			color: #ff8b27;
			text-align: center;
			margin-right: 10px;
			border: 2px solid #f8f9fd;
			background: #f8f9fd;
		}
		
		.zfb-onclick {
			display: inline-block;
			float: left;
			width: 170px;
			height: 55px;
			line-height: 45px;
			font-size: 28px;
			font-family: "microsoft yahei";
			color: #ff8b27;
			text-align: center;
			margin-right: 10px;
			border: 2px solid #ededed;
			background: #ededed;
		}
		
		.wx-onclick-border {
			border: 2px solid #4fb640;
		}
		
		.tab-content-btn:hover {
			color: #fff;
			text-decoration: none;
		}
	</style>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="form-xinxi">
			<h3>商户信息</h3>
		</div>
		<div class="form-page-nav">
			<ul>
				<li id="page-nav-01">申请</li>
				<li id="page-nav-02">提交信息</li>
				<li id="page-nav-03">交保证金</li>
				<li id="page-nav-04">完成审核</li>
				<li class="page-nav-05"></li>
				<li class="page-nav-06"></li>
				<li class="page-nav-07"></li>
			</ul>

			<p>备注：申请过程中，可能会由于资料问题需重新申请</p>
		</div>
		<div class="form-xinxi2">
			<h3>交保证金</h3>
		</div>
		<div class="tab-content">
			<div class="tab-content-bzj">
				<form action="{pigcms{:U('Pay/go_pay')}" method="post" id="deal-buy-form">
			            <div class="mainbox cf" style="min-height:0px;display:none;">
			            	<div class="table-section summary-table tj-table">
			                    <table cellspacing="0" class="buy-table">
			                        <tr class="order-table-head-row">
			                        	<th class="desc">项目</th>
			                        	<th class="unit-price">单价</th>
                                        <th class="amount">数量</th>
                                        <th class="col-total">总价</th>
			                    	</tr>
				                    <volist name="order_info['order_content']" id="vo">
				                        <tr>
					                        <td class="desc">{pigcms{$vo.name}</td>
					                        <td class="money J-deal-buy-price">
					                            ¥<span id="deal-buy-price">{pigcms{$vo.price}</span>
					                        </td>
					                        <td class="deal-component-quantity ">{pigcms{$vo.num}</td>
					                        <td class="money total rightpadding col-total">
	                                            ¥<span id="J-deal-buy-total">{pigcms{$vo.money}</span>
	                                        </td>
					                    </tr>
				                    </volist>
			                        <tr>						
			                        	<td>
										  <if condition="!empty($leveloff) AND is_array($leveloff)">
										  		<span style="float: right;">会员等级<strong style="color:#EA4F01;">{pigcms{$leveloff['lname']}</strong> &nbsp;{pigcms{$leveloff['offstr']}</span>   
										  </if>
										</td>										
				                        <td colspan="3" class="extra-fee total-fee rightpadding">
											<strong><if condition="!empty($leveloff) AND is_array($leveloff)">优惠后</if>订单总额</strong>：
				                            <span class="inline-block money">
				                                ¥<strong id="deal-buy-total-t">{pigcms{$order_info.order_total_money}</strong>
				                            </span>
				                        </td>
			                    	</tr>
			                	</table>
			            	</div>
			            </div>
				<div class="tab-content-price">
					<if condition="$order_info['order_type'] != 'recharge'">
					<label>支付金额</label>
					<span class="tab-content-price-sp" id="deal-buy-total-t">
						{pigcms{$pay_money}元
					</span>
					</if>
				</div>
				<div class="tab-content-price">
					<label>支付方式</label>
					<input name="pay_type" type="hidden" value="weixin" id="pay_type"/>
					<span class="wx-onclick wx-onclick-border"><img src="http://demo.24so.com/xnd/img/wx-icon.jpg"></span>
					<span class="zfb-onclick"><img src="http://demo.24so.com/xnd/img/zfb-icon.jpg"></span>
				</div>
				<div class="form-submit">
							<input type="hidden" name="order_id" value="{pigcms{$order_info.order_id}"/>
				    		<input type="hidden" name="order_type" value="{pigcms{$order_info.order_type}"/>    		
							<input id="J-order-pay-button" class="tab-content-btn" name="commit" type="submit" value="去支付">
			            </div>
			        </form>
			</div>
		</div>
	</div>
</div>
	<script src="http://hf.pigcms.com/static/js/artdialog/jquery.artDialog.js"></script>
	<script src="http://hf.pigcms.com/static/js/artdialog/iframeTools.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#sysmsg-error .close').click(function(){
				$('#sysmsg-error').remove();
			});
			$('.see_tmp_qrcode').click(function(){
				var qrcode_href = $(this).attr('href');
				art.dialog.open(qrcode_href+"&"+Math.random(),{
					init: function(){
						var iframe = this.iframe.contentWindow;
						window.top.art.dialog.data('login_iframe_handle',iframe);
					},
					id: 'login_handle',
					title:'请使用微信扫描二维码',
					padding: 0,
					width: 430,
					height: 433,
					lock: true,
					resize: false,
					background:'black',
					button: null,
					fixed: false,
					close: null,
					left: '50%',
					top: '38.2%',
					opacity:'0.4'
				});
				return false;
			});
			$('#deal-buy-form').submit(function(){			
				if($('input[name="pay_type"]').val() == 'weixin'){
					art.dialog({
						title: '提示信息',
						id: 'weixin_pay_tip',
						opacity:'0.4',
						lock:true,
						fixed: true,
						resize: false,
						content: '正在获取微信支付相关信息，请稍等...'
					});
					$.post($('#deal-buy-form').attr('action'),$('#deal-buy-form').serialize(),function(result){
						art.dialog.list['weixin_pay_tip'].close();			
						if(result.status == 1){
							art.dialog({
								title: '请使用微信扫码支付',
								id: 'weixin_pay_qrcode',
								width:'350px',
								opacity:'0.4',
								lock:true,
								fixed: true,
								resize: false,
								content: '<p style="margin-top:20px;margin-bottom:20px;text-align:center;font-size:16px;color:black;">请使用微信扫描二维码进行支付</p><p style="text-align:center;"><img src="{pigcms{:U('Recognition/get_own_qrcode')}&qrCon='+result.info+'" style="width:240px;height:240px;"></p><p style="text-align:center;margin-top:20px;margin-bottom:20px;"><input id="J-order-weixin-button" type="button" class="btn btn-large btn-pay" value="已支付完成"/></p>'
							});
						}else{
							art.dialog({
								title: '错误提示：',
								id: 'weixin_pay_error',
								opacity:'0.4',
								lock:true,
								fixed: true,
								resize: false,
								content: result.info
							});
						}
					});
					return false;
				}
				});
				$('#J-order-weixin-button').live('click',function(){
				window.location.href="{pigcms{:U('Pay/weixin_back',array('order_type'=>$order_info['order_type'],'order_id'=>$order_info['order_id']))}";
				});
		});
	$('.wx-onclick').click(function() {
		$('.wx-onclick').addClass('wx-onclick-border');
		$('.zfb-onclick').removeClass('wx-onclick-border');
		$("#pay_type").val("weixin");
	});
	$('.zfb-onclick').click(function() {
		$('.zfb-onclick').addClass('wx-onclick-border');
		$('.wx-onclick').removeClass('wx-onclick-border');
		$("#pay_type").val("alipay");
	});
</script>
<include file="Public:footer" />