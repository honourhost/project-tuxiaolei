<include file="Public:header" />
<style>
	.breadcrumbs-price {
		width: 100%;
		padding: 10px 0px;
	}
	
	.breadcrumbs-price h3 {
		font-size: 20px;
		float: left;
		margin-right: 50px;
	}
	
	.breadcrumbs-price h3 b {
		font-family: "microsoft yahei";
		font-size: 30px;
		color: #FF0000;
		margin: 0px 3px;
	}
	
	.breadcrumbs-price span {
		float: right;
		margin-right: 20px;
	}
	
	.breadcrumbs-price span a {}
	
	.wq-tbody {
		text-align: center;
	}
	
	.wq-tbody tr th {
		height: 35px;
		border: 1px solid #000;
	}
	
	.wq-tbody tr {
		height: 45px;
	}
	
	.wq-tbody tr td {
		font-size: 14px;
	}
	
	.wq-tbody .font12 {
		font-size: 12px;
	}
</style>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-bar-chart-o bar-chart-o-icon"></i>
			<li class="active">商家账单</li>
			<li class="active">提现列表</li>
		</ul>
	</div>
	<div class="alert alert-info" style="margin:10px;">
		<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>只统计已消费的订单
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-sm-12">
					<div class="breadcrumbs-price">
						<span>
							<a href="./price.php" class="btn btn-success">立即提现</a>
						</span>
						<h3>累计提现：<b>198</b>元</h3>
						<h3>可提现金额：<b>100</b>元</h3>
					</div>
					<div class="tabbable" style="margin-top:20px;">
						<div class="row">
							<div class="col-xs-12">
								<div class="grid-view">
									<table class="table table-striped table-bordered table-hover">
										<thead class="wq-tbody">
											<tr>
												<th style="text-align:center">
													<input type="checkbox" id="all_select" />
												</th>
												<th style="text-align:center">时间</th>
												<th style="text-align:center">提现金额</th>
												<th style="text-align:center">备注</th>
											</tr>
										</thead>
										<tbody class="wq-tbody">

											<tr class="odd">
												<td class="textcenter ">
													<input type="checkbox" id="all_select" />
												</td>
												<td class="textcenter ">2015-10-23</td>
												<td class="textcenter ">23</td>
												<td class="textcenter font12">备注备注备注</td>
											</tr>
											<tr class="odd">
												<td class="textcenter ">
													<input type="checkbox" id="all_select" />
												</td>
												<td class="textcenter ">2015-10-23</td>
												<td class="textcenter ">23</td>
												<td class="textcenter font12">备注备注备注</td>
											</tr>
											<tr class="odd">
												<td class="textcenter ">
													<input type="checkbox" id="all_select" />
												</td>
												<td class="textcenter ">2015-10-23</td>
												<td class="textcenter ">23</td>
												<td class="textcenter font12">备注备注备注</td>
											</tr>
											<tr class="odd">
												<td class="textcenter ">
													<input type="checkbox" id="all_select" />
												</td>
												<td class="textcenter ">2015-10-23</td>
												<td class="textcenter ">23</td>
												<td class="textcenter font12">备注备注备注</td>
											</tr>
											<tr class="odd">
												<td class="textcenter ">
													<input type="checkbox" id="all_select" />
												</td>
												<td class="textcenter ">2015-10-23</td>
												<td class="textcenter ">23</td>
												<td class="textcenter font12">备注备注备注</td>
											</tr>
											<tr class="odd">
												<td class="textcenter ">
													<input type="checkbox" id="all_select" />
												</td>
												<td class="textcenter ">2015-10-23</td>
												<td class="textcenter ">23</td>
												<td class="textcenter font12">备注备注备注</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#all_select').click(function() {
			if ($(this).attr('checked')) {
				$('.select').attr('checked', true);
			} else {
				$('.select').attr('checked', false);
			}
			total_price();
		});
		$('.select').click(function() {
			total_price();
		});
	});

	function total_price() {
		var total = 0;
		$('.select').each(function() {
			if ($(this).attr('checked')) {
				total += parseFloat($(this).attr('data-price'));
			}
		});
		total = Math.round(total * 100) / 100;
		var percent = $('#percent').val();
		if (total > 0) {
			$('#show_count').html('账单总计金额：<strong style=\'color:red\'>￥' + total + '</strong>, 平台对改商家的抽成比例是：<strong style=\'color:green\'>' + percent + '%</strong>, 平台应得金额：<strong style=\'color:green\'>￥' + Math.round(total * percent) / 100 + '</strong>,商家应得金额:<strong style=\'color:red\'>￥' + Math.round((total - Math.round(total * percent) / 100) * 100) / 100 + '</strong>');
		} else {
			$('#show_count').html('');
		}
	}
</script>
<include file="Public:footer" />