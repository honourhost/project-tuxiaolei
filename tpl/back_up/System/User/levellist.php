<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('User/levellist')}" class="on">等级管理</a>
					<a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('User/addlevel')}','添加一个等级',650,500,true,false,false,addbtn,'add',true);" style="margin-left:20px;">添加等级</a>
				</ul>
			</div>
			<!--<table class="search_table" width="100%">
				<tr>
					<td>
						<form action="{pigcms{:U('User/index')}" method="get">
							<input type="hidden" name="c" value="User"/>
							<input type="hidden" name="a" value="index"/>
							筛选: <input type="text" name="keyword" class="input-text" value="{pigcms{$_GET['keyword']}"/>
							<select name="searchtype">
								<option value="uid" <if condition="$_GET['searchtype'] eq 'uid'">selected="selected"</if>>用户ID</option>
								<option value="nickname" <if condition="$_GET['searchtype'] eq 'nickname'">selected="selected"</if>>昵称</option>
								<option value="phone" <if condition="$_GET['searchtype'] eq 'phone'">selected="selected"</if>>手机号</option>
							</select>
							<input type="submit" value="查询" class="button"/>
						</form>
					</td>
				</tr>
			</table>-->
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup>
							<col/>
							<col/>
							<col/>
							<col/>
							<col/>
							<col width="180" align="center"/>
						</colgroup>
						<thead>
							<tr>
								<th width="50px">ID</th>
								<th width="100px">等级名称</th>
								<th width="50px">等级级别</th>
								<th width="100px">等级图标</th>
								<th width="200px">等级福利</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($userlevel)">
								<volist name="userlevel" id="vo">
									<tr>
										<td>{pigcms{$vo.id}</td>
										<td>{pigcms{$vo.lname}</td>
										<td>{pigcms{$vo.level}</td>
										<td><img src="{pigcms{$config['site_url']}{pigcms{$vo.icon}" style="width:90px; height: 80px;"></td>
										<td><if condition="$vo['type'] eq 1">商品按原价{pigcms{$vo.boon}%计算<elseif condition="$vo['type'] eq 2" />商品价格立减{pigcms{$vo.boon}元<else />无</if></td>
										<td><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('User/addlevel',array('lid'=>$vo['id']))}','编辑等级信息',650,500,true,false,false,editbtn,'edit',true);">编 辑</a></td>
									</tr>
								</volist>
								<tr><td class="textcenter pagebar" colspan="6">{pigcms{$pagebar}</td></tr>
							<else/>
								<tr><td class="textcenter red" colspan="6">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>