<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Card/index')}" class="on">会员卡列表</a>|
					<a href="{pigcms{:U('Card/design')}">添加会员卡</a>
				</ul>
			</div>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup><col> <col> <col> <col><col><col><col> <col width="140" align="center"> </colgroup>
						<thead>
							<tr>
								<th>名称</th>
								<th>卡片总数</th>
								<th>已开卡会员</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($cards)">
								<volist name="cards" id="vo">
									<tr>
										<td>{pigcms{$vo.cardname}</td>
										<td>{pigcms{$vo.cardcount}</td>
										<td>{pigcms{$vo.usercount}</td>
										
										<td class="textcenter">
												<a href="{pigcms{:U('Card/members', array('id' => $vo['id']))}">会员卡管理</a> 
												|
												<a href="{pigcms{:U('Card/notice', array('id' => $vo['id']))}">会员通知</a>
												|
												<a href="{pigcms{:U('Card/exchange', array('id' => $vo['id']))}">积分设置</a> 
												|
												<a href="{pigcms{:U('Card/create', array('id' => $vo['id']))}">会员开卡</a> 
												|
												<a title="修改" class="green" style="padding-right:8px;" href="{pigcms{:U('Card/design',array('id'=>$vo['id']))}">编辑</a>
												|
												<a title="删除" class="red" style="padding-right:8px;" href="{pigcms{:U('Card/delete',array('id'=>$vo['id']))}">删除</a>
										</td>
									</tr>
								</volist>
								<tr><td class="textcenter pagebar" colspan="8">{pigcms{$pagebar}</td></tr>
							<else/>
								<tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>