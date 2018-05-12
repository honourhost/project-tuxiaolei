<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="#">活动类型列表</a>|
					<a href="{pigcms{:U('Activity/activityTypeAdd')}" class="on">新增活动类型</a>
				</ul>
			</div>
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup>
							<col/>
							<col/>
							<col/>
							<col/>
							<col/>
							<col/>
							<col/>
							<col width="180" align="center"/>
						</colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>分类名称</th>
								<th>创建时间</th>
								<th>状态值（1：可用；0：不可用）</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($type_list)">
								<volist name="type_list" id="vo">
									<tr>
										<td>{pigcms{$vo.id}</td>
										<td>{pigcms{$vo.type_name}</td>
										<td><php>echo date("Y-m-d H:i:s",$vo['create_time']);</php></td>
										<td>{pigcms{$vo.status}</td>
										<td class="textcenter"><a href="{pigcms{:U('Activity/activityTypeEdit',array('id'=>$vo['id']))}">编辑</a> | 
										<if condition="$vo[status]==1">	
										<a href="{pigcms{:U('Activity/activityTypeDel',array('id'=>$vo['id']))}">删除</a>
										<else/>
										<a href="{pigcms{:U('Activity/activityTypeRes',array('id'=>$vo['id']))}">恢复</a>
										</if>
										</td>
										</tr>
								</volist>
							<else/>
								<tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
		</div>
<include file="Public:footer"/>