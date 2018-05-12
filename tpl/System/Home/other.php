<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Home/other')}" class="on">关键词回复列表</a>|
					<a href="{pigcms{:U('Home/other_add')}">添加关键词回复</a>
				</ul>
			</div>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup><col> <col> <col><col>  <col width="220" align="center"> </colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>关键词</th>
								<th>回复标题</th>
								<th>回复内容</th>
								<th>回复图片</th>
								<th>链接（URL）</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($list)">
								<volist name="list" id="vo">
									<tr>
										<td style="width:10%;">{pigcms{$vo.id}</td>
										<td style="width:10%;">{pigcms{$vo.key}</td>
										<td style="width:10%;">{pigcms{$vo.title}</td>
										<td style="width:20%;word-wrap:break-word;word-break:break-all;">{pigcms{$vo.info}</td>
										<td style="width:15%;"><img alt="" src="{pigcms{$vo.pic}" style="width:60px;height:50px;"></td>
										<td style="word-wrap:break-word;word-break:break-all;width:20%;">{pigcms{$vo.url}</td>
										<td style="width:15%;" class="textcenter">
											<a href="{pigcms{:U('Home/other_edit',array('id'=>$vo['id']))}">编辑</a> | 
											<a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Home/other_del')}">删除</a>
										</td>
									</tr>
								</volist>
							<else/>
								<tr><td class="textcenter red" colspan="5">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<script type="text/javascript">
$(document).ready(function(){

});
</script>
<include file="Public:footer"/>