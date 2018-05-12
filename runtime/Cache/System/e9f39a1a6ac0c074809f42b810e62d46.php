<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset={:C('DEFAULT_CHARSET')}" />
		<title>网站后台管理 Powered by Adam</title>
		<script type="text/javascript">
			if(self==top){window.top.location.href="<?php echo U('Index/index');?>";}
			var kind_editor=null,static_public="<?php echo ($static_public); ?>",static_path="<?php echo ($static_path); ?>",system_index="<?php echo U('Index/index');?>",choose_province="<?php echo U('Area/ajax_province');?>",choose_city="<?php echo U('Area/ajax_city');?>",choose_area="<?php echo U('Area/ajax_area');?>",choose_circle="<?php echo U('Area/ajax_circle');?>",choose_map="<?php echo U('Map/frame_map');?>",get_firstword="<?php echo U('Words/get_firstword');?>",frame_show=<?php if($_GET['frame_show']): ?>true<?php else: ?>false<?php endif; ?>;
 var  meal_alias_name = "<?php echo ($config["meal_alias_name"]); ?>";
		</script>
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/style.css" />
		<script type="text/javascript" src="<?php echo C('JQUERY_FILE');?>"></script> 
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.form.js"></script>
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.cookie.js"></script>
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.validate.js"></script> 
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/date/WdatePicker.js"></script> 
		<script type="text/javascript" src="<?php echo ($static_public); ?>js/jquery.colorpicker.js"></script>
		<script type="text/javascript" src="<?php echo ($static_path); ?>js/common.js"></script>
	</head>
	<body width="100%" <?php if($bg_color): ?>style="background:<?php echo ($bg_color); ?>;"<?php endif; ?>>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">
				<ul>
					<?php if(empty($now_category)): ?><a href="<?php echo U('Group/index');?>" class="on">分类列表</a>|
						<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Group/cat_add',array('cat_fid'=>intval($_GET['cat_fid'])));?>','添加主分类',480,260,true,false,false,addbtn,'add',true);">添加主分类</a>
					<?php else: ?>
						<a href="<?php echo U('Group/index');?>">分类列表</a>|
						<a href="<?php echo U('Group/index',array('cat_fid'=>$_GET['cat_fid']));?>" class="on"><?php echo ($now_category["cat_name"]); ?> - 子分类列表</a>|
						<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Group/cat_add',array('cat_fid'=>intval($_GET['cat_fid'])));?>','添加子分类',520,370,true,false,false,addbtn,'add',true);">添加子分类</a><?php endif; ?>
				</ul>
			</div>
			<?php if(!empty($_GET['cat_fid'])): ?><div style="height:30px;line-height:30px;">提示：若主分类下只有一个子分类，网站上子分类不会显示。</div><?php endif; ?>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup>
							<col/>
							<col/>
							<col/>
							<col/>
							<?php if(empty($_GET['cat_fid'])): ?><col/>
								<col/>
								<col/><?php endif; ?>
							<col/>
							<col width="180" align="center"/>
						</colgroup>
						<thead>
							<tr>
								<th>排序</th>
								<th>编号</th>
								<th>名称</th>
								<th>短标记(url)</th>
								<?php if(empty($_GET['cat_fid'])): ?><th>查看子分类</th>
									<th>购买须知填写项</th>
									<th>商品字段管理</th><?php endif; ?>
								<th>状态</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($category_list)): if(is_array($category_list)): $i = 0; $__LIST__ = $category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo ($vo["cat_sort"]); ?></td>
										<td><?php echo ($vo["cat_id"]); ?></td>
										<td><?php if($vo['is_hot']): ?><font color="red"><?php echo ($vo["cat_name"]); ?></font><?php else: echo ($vo["cat_name"]); endif; ?></td>
										<td><?php echo ($vo["cat_url"]); ?></td>
										<?php if(empty($_GET['cat_fid'])): ?><td><a href="<?php echo U('Group/index',array('cat_fid'=>$vo['cat_id']));?>">查看子分类</a></td>
											<td><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Group/cue_field',array('cat_id'=>$vo['cat_id']));?>','购买须知填写项',580,420,true,false,false,false,'detail',true);">购买须知填写项</a></td>
											<td><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Group/cat_field',array('cat_id'=>$vo['cat_id']));?>','管理商品属性字段',580,420,true,false,false,false,'detail',true);">商品字段管理</a></td><?php endif; ?>
										<td><?php if($vo['cat_status'] == 1): ?><font color="green">启用</font><?php elseif($vo['cat_status'] == 2): ?><font color="red">待审核</font><?php else: ?><font color="red">关闭</font><?php endif; ?></td>
										<td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Group/cat_edit',array('cat_id'=>$vo['cat_id'],'frame_show'=>true));?>','查看分类信息',480,260,true,false,false,false,'detail',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Group/cat_edit',array('cat_id'=>$vo['cat_id']));?>','编辑分类信息',480,<?php if($vo['cat_fid']): ?>240<?php else: ?>340<?php endif; ?>,true,false,false,editbtn,'edit',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="cat_id=<?php echo ($vo["cat_id"]); ?>" url="<?php echo U('Group/cat_del');?>">删除</a></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
								<tr><td class="textcenter pagebar" colspan="9"><?php echo ($pagebar); ?></td></tr>
							<?php else: ?>
								<tr><td class="textcenter red" colspan="9">列表为空！</td></tr><?php endif; ?>
						</tbody>
					</table>
				</div>
			</form>
		</div>
	</body>
</html>