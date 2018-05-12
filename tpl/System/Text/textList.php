<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<a href="{pigcms{:U('Text/index')}">图文分类列表</a>
                    <a href="{pigcms{:U('Text/textList',array('id'=>$id))}" class="on">分类下图文列表</a>
				</ul>
			</div>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup><col> <col> <col><col>  <col width="180" align="center"> </colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>名称</th>
								<th>创建时间</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($text)">
								<volist name="text" id="vo">
									<tr>
										<td>{pigcms{$vo.pigcms_id}</td>
										<td>{pigcms{$vo.title}</td>
										<td>{pigcms{$vo.dateline|date='Y-m-d H:i:s',###}</td>
										<td class="textcenter"><if condition="$vo['checkone']">
											<a href="javascript:void(0);" class="cancle_row" parameter="id={pigcms{$vo.pigcms_id}" url="{pigcms{:U('Text/cancle_manage',array('type'=>'check','id'=>$vo['pigcms_id']))}">取消审核通过</a>
											<else/>
											<a href="javascript:void(0);" class="cancle_row" parameter="id={pigcms{$vo.pigcms_id}" url="{pigcms{:U('Text/confirm_manage',array('type'=>'check','id'=>$vo['pigcms_id']))}">审核通过</a>
											</if>
											 | <if condition="$vo['recommend']">
											 <a href="javascript:void(0);" class="cancle_row" parameter="id={pigcms{$vo.pigcms_id}" url="{pigcms{:U('Text/cancle_manage',array('type'=>'recommend','id'=>$vo['pigcms_id']))}">取消推荐</a>
											 <else/>
											 <a href="javascript:void(0);" class="cancle_row" parameter="id={pigcms{$vo.pigcms_id}" url="{pigcms{:U('Text/confirm_manage',array('type'=>'recommend','id'=>$vo['pigcms_id']))}">推荐</a>
											 </if>
											  | <a href="{pigcms{$config.site_url}/wap.php?g=Wap&c=Article&a=index&imid={pigcms{$vo.pigcms_id}" target="blank;">预览</a></td>
									</tr>
								</volist>
								<tr><td class="textcenter pagebar" colspan="11">{pigcms{$pagebar}</td></tr>
							<else/>
								<tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>