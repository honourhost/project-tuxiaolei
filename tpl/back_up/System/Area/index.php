<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Area/index')}" <if condition="$_GET['type'] eq 1">class="on"</if>>根列表</a>|
					<if condition="$_GET['type'] gt 1"><a href="{pigcms{:U('Area/index',array('pid'=>$_GET['pid'],'type'=>$_GET['type']))}" class="on">{pigcms{$now_type_str}列表</a></if>
					<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Area/add',array('pid'=>$_GET['pid'],'type'=>$_GET['type']))}','添加{pigcms{$now_type_str}',450,280,true,false,false,addbtn,'add',true);">添加{pigcms{$now_type_str}</a>
				</ul>
			</div>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup>
							<col/>
							<col/>
							<col/>
							<if condition="$_GET['type'] eq 2 || $_GET['type'] eq 4">
								<col/>
							</if>
							<col/>
							<if condition="$_GET['type'] gt 1">
								<col/>
								<if condition="$_GET['type'] lt 4">
									<col/>
								</if>
							</if>
							<if condition="$_GET['type'] lt 4">
								<col/>
							</if>
							<col width="240" align="center"/>
						</colgroup>
						<thead>
							<tr>
								<th>排序</th>
								<th>编号</th>
								<th>名称</th>
								<if condition="$_GET['type'] eq 2 || $_GET['type'] eq 4">
									<th>首字母</th>
								</if>
								<th>状态</th>
								<if condition="$_GET['type'] gt 1">
									<th>网址标识</th>
									<if condition="$_GET['type'] lt 4">
										<th>IP标识</th>
									</if>							
								</if>
								<if condition="$_GET['type'] lt 4">
									<th>进入下级分类</th>	
								</if>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($area_list)">
								<volist name="area_list" id="vo">
									<tr>
										<td>{pigcms{$vo.area_sort}</td>
										<td>{pigcms{$vo.area_id}</td>
										<td>{pigcms{$vo.area_name}</td>
										<if condition="$_GET['type'] eq 2 || $_GET['type'] eq 4">
											<td>{pigcms{$vo.first_pinyin}</td>
										</if>
										<td><if condition="$vo['is_open']"><font color="green">显示</font><else/><font color="red">隐藏</font></if></td>
										<if condition="$_GET['type'] gt 1">
											<td>{pigcms{$vo.area_url}</td>
											<if condition="$_GET['type'] lt 4">
												<td>{pigcms{$vo.area_ip_desc}</td>
											</if>
										</if>
										<if condition="$_GET['type'] lt 4">
											<td><a href="{pigcms{:U('Area/index',array('type'=>$_GET['type']+1,'pid'=>$vo['area_id']))}">进入下级</a></td>
										</if>
										<td>
											<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Area/edit',array('area_id'=>$vo['area_id']))}','编辑{pigcms{$now_type_str}',450,280,true,false,false,editbtn,'add',true);">编辑</a> | 
											<a href="javascript:void(0);" class="delete_row" parameter="area_id={pigcms{$vo.area_id}" url="{pigcms{:U('Area/del')}">删除</a>
											<if condition="$_GET['type'] eq 3">
											 | <a href="{pigcms{:U('Area/admin', array('area_id' => $vo['area_id']))}">区域管理员</a>
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
			</form>
		</div>
<include file="Public:footer"/>