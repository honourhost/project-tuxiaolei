<include file="Public:header"/>
<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-gear gear-icon"></i>
				<a href="{pigcms{:U('Meal/index')}">{pigcms{$config.meal_alias_name}管理</a>
			</li>
			<li class="active">{pigcms{$now_store.name}</li>
			<li class="active">点击分类添加商品</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<style>
				.ace-file-input a {display:none;}
			</style>
			<div class="row">
				<div class="col-xs-12">
					<div id="shopList" class="grid-view">
						<h3 style="text-align:center">点击下面任意分类名称后可添加商品</h3>
						<table class="table table-striped table-bordered table-hover">
							<tbody>
								<if condition="$sort_list">
									<tr class="odd">
									<volist name="sort_list" id="vo"><!--<td><a href="{pigcms{:U('Meal/meal_list',array('sort_id'=>$vo['sort_id']))}">{pigcms{$vo.sort_name}</a></td>-->
										<td onclick="addGoods({pigcms{$vo['sort_id']});"><a href="{pigcms{:U('Meal/meal_list',array('sort_id'=>$vo['sort_id']))}">{pigcms{$vo.sort_name}</a></td>
										<if condition="$i%6 eq 0">
											</tr><tr class="odd">
										</if>
									</volist>
								</tr>
								<else/>
									<tr class="odd"><td class="button-column" colspan="8" >暂时还没有分类请先添加</td></tr>
								</if>
							</tbody>
						</table>
						{pigcms{$pagebar}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function addGoods(store_id){
		window.location.href = "/merchant.php?g=Merchant&c=Meal&a=meal_list&sort_id="+store_id;
	}
</script>
<include file="Public:footer"/>
