<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
					<if condition="empty($now_category)">
						<a href="{pigcms{:U('Classify/pickList')}" class="on">主分类列表</a>|
					<else/>
						<a href="{pigcms{:U('Classify/pickList')}">主分类列表</a>|
						<a href="{pigcms{:U('Classify/pickList',array('fcid'=>$fcid,'pfcid'=>$pfcid))}" class="on">{pigcms{$now_category.cat_name} - 子分类列表</a>|
						 <a <if condition="$now_category['subdir'] eq 1"> href="{pigcms{:U('Classify/pickList',array('fcid'=>0,'pfcid'=>0))}" <elseif condition="$now_category['subdir'] eq 2"/> href="{pigcms{:U('Classify/pickList',array('fcid'=>$now_category['fcid'],'pfcid'=>0))}" </if>>返回上级目录</a>
					</if>
			</div>
			<if condition="!empty($_GET['cat_fid'])">
				<div style="height:30px;line-height:30px;">提示：若主分类下只有一个子分类，网站上子分类不会显示。</div>
			</if>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup>
							<col/>
							<col/>
							<col/>
							<col/>
							<col/>
						</colgroup>
						<thead>
							<tr>
								<th>名称</th>
								<th>短标记(url)</th>
								<if condition="!isset($now_category)">
								 <th>查看子分类</th>
								 <th>状态</th>
								 <else/>
								 <th>设置更新目录</th>
								 <th>设置更新字段</th>
								  <th>状态</th>
								</if>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($category_list)">
								<volist name="category_list" id="vo">
									<tr>
										<td><if condition="$vo['is_hot']"><font color="red">{pigcms{$vo.cat_name}</font><else/>{pigcms{$vo.cat_name}</if></td>
										<td>{pigcms{$vo.cat_url}</td>
										<if condition="!isset($now_category)">
											<td><a href="{pigcms{:U('Classify/pickList',array('fcid'=>$vo['cid'],'pfcid'=>$vo['fcid']))}">查看子分类</a>
										</td>
 									  <else/>
									  	<php>$param=array('cid'=>$vo['cid'],'cyname'=>$vo['cat_name'],'fcid'=>$vo['fcid']);if(!empty($vo['pickset'])){$param['id']=$vo['pickset']['id'];}else{$param['id']=0;} $param=base64_encode(json_encode($param));</php>
										<td>
										<if condition="!$ishavefield">
										 <a class="btn" href="javascript:void(0);">没有更新分类</a>
										<else/>
										<a class="btn" href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Classify/getServerCy',array('cid'=>$vo['cid'],'param'=>$param))}','设置更新目录',800,550,true,false,false,submitbtn,'Csubmit',true);">设置更新分类</a>
										</if>
										</td>
										<td>
										<if condition="!$ishavefield">
										 <a class="btn" href="javascript:void(0);">没有更新字段</a>
										<else/>
										<a class="btn"  <if condition="empty($vo['pickset'])"> href="javascript:alert('请您先设置一下更新分类');"<else/>href="{pigcms{:U('Classify/updateFiield',array('cid'=>$vo['cid'],'fcid'=>$vo['fcid']))}"</if>>设置更新字段</a>
										</td>
										</if>
										</if>

										<td><if condition="$vo['cat_status'] eq 1"><font color="green">启用</font><elseif condition="$vo['cat_status'] eq 2"/><font color="red">待审核</font><else/><font color="red">关闭</font></if></td>
										
										<td class="textcenter">
										<if condition="!$ishavefield">
										<a href="javascript:void(0);">无更新</a>
										<else/>
										<a href="{pigcms{:U('Classify/updatedata',array('cid'=>$vo['cid'],'fcid'=>$vo['fcid']))}">更 新</a>
										</if>
										</td>
									</tr>
								</volist>
								<tr><td class="textcenter pagebar" colspan="9">{pigcms{$pagebar}</td></tr>
							<else/>
								<tr><td class="textcenter red" colspan="9">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<include file="Public:footer"/>