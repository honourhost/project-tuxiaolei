<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Appoint/cue_field',array('cat_id'=>$now_category['cat_id']))}" class="on">填写项列表</a>|
					<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Appoint/cue_field_add',array('cat_id'=>$now_category['cat_id']))}','添加填写项',460,250,true,false,false,addbtn,'add',true);">添加填写项</a>
				</ul>
			</div>
			<form name="myform" id="myform" action="" method="post">
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
								<th>排序</th>
								<th>名称</th>
								<th>类型</th>
								<th>必填</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($now_category['cue_field'])">
								<volist name="now_category['cue_field']" id="vo">
									<tr>
										<td>{pigcms{$vo.sort}</td>
										<td>{pigcms{$vo.name}</td>
										<td>
											<if condition="$vo['type'] eq 1">多行
											<elseif condition="$vo['type'] eq 2"/>地图
											<elseif condition="$vo['type'] eq 3"/>下拉框
											<elseif condition="$vo['type'] eq 4"/>数字
											<elseif condition="$vo['type'] eq 5"/>邮件
											<elseif condition="$vo['type'] eq 6"/>日期
											<elseif condition="$vo['type'] eq 7"/>时间
											<elseif condition="$vo['type'] eq 9"/>日期时间
											<elseif condition="$vo['type'] eq 8"/>手机
											<else/>单行
											</if>
										</td>
										<td>
											<if condition="$vo['iswrite'] eq 1">是<else/>否</if>
										</td>
										<td class="textcenter"><a href="javascript:void(0);" class="delete_row" parameter="cat_id={pigcms{$now_category.cat_id}&name={pigcms{$vo.name}" url="{pigcms{:U('Appoint/cue_field_del')}">删除</a></td>
									</tr>
								</volist>
							<else/>
								<tr><td class="textcenter red" colspan="6">预约表单须知预设选项列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>