<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Activity/index')}" class="on">活动列表</a>|
					<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Activity/add')}','创建活动',480,300,true,false,false,addbtn,'add',true);">创建活动</a>|
					<a href="{pigcms{:U('Config/index',array('galias'=>'activity','header'=>'Activity/header'))}">活动配置</a>
				</ul>
			</div>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup>
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
								<th>名称</th>
								<th>期数</th>
								<th>开始时间</th>
								<th>结束时间</th>
								<th>活动列表</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($activity_list)">
								<volist name="activity_list" id="vo">
									<tr>
										<td>{pigcms{$vo.activity_id}</td>
										<td>{pigcms{$vo.name}</td>
										<td>{pigcms{$vo.term}</td>
										<td>{pigcms{$vo.begin_time|date='Y-m-d H:i',###}</td>
										<td>{pigcms{$vo.end_time|date='Y-m-d H:i',###}</td>
										<td><a href="{pigcms{:U('Activity/activity_list',array('id'=>$vo['activity_id']))}">活动列表</a></td>
										<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Activity/edit',array('id'=>$vo['activity_id']))}','编辑活动分类',480,370,true,false,false,editbtn,'add',true);">编辑</a> <!--| <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.activity_id}" url="{pigcms{:U('Activity/del')}">删除</a--></td>
									</tr>
								</volist>
							<else/>
								<tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>