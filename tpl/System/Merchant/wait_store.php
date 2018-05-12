<include file="Public:header"/>
		<div class="mainbox">
			<table class="search_table" width="100%">
				<tr>
					<td>
						<form action="{pigcms{:U('Merchant/wait_store')}" method="get">
							<input type="hidden" name="c" value="Merchant"/>
							<input type="hidden" name="a" value="wait_store"/>
							筛选: <input type="text" name="keyword" class="input-text" value="{pigcms{$_GET['keyword']}"/>
							<select name="searchtype">
								<option value="name" <if condition="$_GET['searchtype'] eq 'name'">selected="selected"</if>>店铺名称</option>								
								<option value="phone" <if condition="$_GET['searchtype'] eq 'phone'">selected="selected"</if>>联系电话</option>
								<option value="store_id" <if condition="$_GET['searchtype'] eq 'store_id'">selected="selected"</if>>店铺编号</option>
							</select>
							<input type="submit" value="查询" class="button"/>
						</form>
					</td>
				</tr>
			</table>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup><col> <col> <col><col><col><col><col><col><col width="180" align="center"> </colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>店铺名称</th>
								<th>联系电话</th>
								<th>最后编辑时间</th>
								<th>平台点击数</th>
								<th>{pigcms{$config.meal_alias_name}</th>
								<th>{pigcms{$config.group_alias_name}</th>
								<th>状态</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($store_list)">
								<volist name="store_list" id="vo">
									<tr>
										<td>{pigcms{$vo.store_id}</td>
										<td>{pigcms{$vo.name}</td>
										<td>{pigcms{$vo.phone}</td>
										<td><if condition="$vo['last_time']">{pigcms{$vo.last_time|date='Y-m-d H:i:s',###}<else/>无</if></td>
										<td>{pigcms{$vo.hits}</td>
										<td><if condition="$vo['have_meal'] eq 1"><font color="green">开启</font><else/><font color="red">关闭</font></if></td>
										<td><if condition="$vo['have_group'] eq 1"><font color="green">开启</font><else/><font color="red">关闭</font></if></td>
										<td><if condition="$vo['status'] eq 1"><font color="green">启用</font><elseif condition="$vo['status'] eq 2"/><font color="red">审核中</font><else/><font color="red">关闭</font></if></td>
										<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/store_edit',array('store_id'=>$vo['store_id'],'frame_show'=>true))}','查看店铺信息',520,440,true,false,false,false,'detail',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Merchant/store_edit',array('store_id'=>$vo['store_id']))}','编辑店铺信息',520,440,true,false,false,editbtn,'store_add',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="store_id={pigcms{$vo.store_id}" url="{pigcms{:U('Merchant/store_del')}">删除</a></td>
									</tr>
								</volist>
								<tr><td class="textcenter pagebar" colspan="10">{pigcms{$pagebar}</td></tr>
							<else/>
								<tr><td class="textcenter red" colspan="10">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>