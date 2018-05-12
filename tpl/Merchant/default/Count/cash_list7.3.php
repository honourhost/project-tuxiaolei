
<include file="Public:header" />
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<i class="ace-icon fa fa-bar-chart-o bar-chart-o-icon"></i>
			<li class="active">商家账单</li>
			<li class="active">提现统计列表</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-sm-12">
					<div class="breadcrumbs-price">
						<span>
							<a href="{pigcms{:U('Count/getCash')}" class="btn btn-success">立即提现</a>
						</span>
						<h3>累计成功提现：<b>{pigcms{$allGetCash}</b>元</h3>
						<h3>可提现金额：<b>{pigcms{$all_totalfinish_percent-$allGetCash}</b>元</h3>
					</div>
					<div class="tabbable" style="margin-top:20px;">
						<div class="row">
							<div class="col-xs-12">
								<div class="grid-view">
									<table class="table table-striped table-bordered table-hover">
										<thead class="wq-tbody">
											<tr>
												<th style="text-align:center">
													编号
												</th>
												<th style="text-align:center">提现金额</th>
												<th style="text-align:center">提现申请时间</th>
												<th style="text-align:center">提现反馈时间</th>
												<th style="text-align:center">提现反馈状态</th>
												<th style="text-align:center">备注</th>
											</tr>
										</thead>
										<tbody class="wq-tbody">
												<if condition="$cash_list">
												<volist name="cash_list" id="vo">
													<tr class="odd">
													<td>{pigcms{$vo.id}</td>
													<td>{pigcms{$vo.cash_num}</td>
													<td><php>echo date("Y-m-d H:i:s",$vo['create_time']);</php></td>
													<td><if condition="$vo['record_time']"><php>echo date("Y-m-d H:i:s",$vo['record_time']);</php><else/>还没有进行处理的申请</if></td>
													<td><if condition="$vo['record_status']==1">提现成功<elseif condition="$vo['record_status']==2"/>提现被驳回<else/>正在申请中</if></td>
													<td class="textcenter font12">{pigcms{$vo.note}</td>
													</tr>
												</volist>
												<else/>
														<tr class="odd"><td class="textcenter red" colspan="16" >该的店铺暂时还没有提现记录。</td></tr>
													</if>
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
<include file="Public:footer" />