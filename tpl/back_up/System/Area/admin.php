<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Area/index')}" <if condition="$_GET['type'] eq 1">class="on"</if>>根列表</a>|
					<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Area/addadmin',array('area_id'=>$_GET['area_id']))}','添加区域管理账号',450,320,true,false,false,addbtn,'add',true);">添加区域管理账号</a>
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
							<col/>
							<col/>
							<col/>
						</colgroup>
						<thead>
							<tr>
								<th>账号</th>
								<th>真实姓名</th>
								<th>电话</th>
								<th>邮箱</th>
								<th>QQ</th>
								<th>最后登录时间</th>
								<th>登录次数</th>
								<th>状态</th>	
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($admin)">
								<volist name="admin" id="vo">
									<tr>
										<td>{pigcms{$vo.account}</td>
										<td>{pigcms{$vo.realname}</td>
										<td>{pigcms{$vo.phone}</td>
										<td>{pigcms{$vo.email}</td>
										<td>{pigcms{$vo.qq}</td>
										<td>{pigcms{$vo.last_time|date="Y-m-d H:i:s",###}</td>
										<td>{pigcms{$vo.login_count}</td>
										<td><if condition="$vo['status'] eq 1"><span style="color:green">正常</span><else /><span style="color:red">关闭</span></if></td>
										<td>
											<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Area/addadmin',array('id'=>$vo['id'], 'area_id'=>$vo['area_id']))}','编辑区域管理账号',450,320,true,false,false,editbtn,'add',true);">编辑</a> 
										</td>
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