<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Footer/index')}" class="on">文章管理</a>|
					<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Footer/add')}','添加导航',800,460,true,false,false,addbtn,'add',true);">添加文章</a>
				</ul>
			</div>
			<div class="table-list">
				<table width="100%" cellspacing="0">
					<colgroup>
						<col/>
						<col/>
						<col/>
						<col width="180" align="center"/>
					</colgroup>
					<thead>
						<tr>
							<th>编号</th>
							<th>名称</th>
							<th>标题</th>
							<th class="textcenter">操作</th>
						</tr>
					</thead>
					<tbody>
						<if condition="is_array($link_list)">
							<volist name="link_list" id="vo">
								<tr>
									<td>{pigcms{$vo.id}</td>
									<td>{pigcms{$vo.name}</td>
									<td>{pigcms{$vo.title}</td>
									<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Footer/edit',array('id'=>$vo['id']))}','编辑导航',800,460,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Footer/del')}">删除</a></td>
								</tr>
							</volist>
							<tr><td class="textcenter pagebar" colspan="4">{pigcms{$pagebar}</td></tr>
						<else/>
							<tr><td class="textcenter red" colspan="4">列表为空！</td></tr>
						</if>
					</tbody>
				</table>
			</div>
		</div>
<include file="Public:footer"/>