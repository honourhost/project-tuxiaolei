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
					<a href="<?php echo U('Diymenu/index');?>" class="on">自定义菜单列表</a>|
					<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Diymenu/class_add');?>','添加自定义菜单',560,350,true,false,false,addbtn,'add',true);">添加自定义菜单</a>
				</ul>
			</div>
			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup><col> <col> <col><col>  <col width="180" align="center"> </colgroup>
						<thead>
							<tr>
								<th>编号</th>
								<th>主菜单名称</th>
								<th>菜单类型</th>
								<th>类型数值</th>
								<th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($class)): if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo ($vo["sort"]); ?></td>
										<td><?php echo ($vo["title"]); ?></td>
										<td>
											<?php if($vo["keyword"] != ''): ?>顶级菜单-【关键词回复菜单】
								        	<?php elseif($vo["url"] != ''): ?>
								        		顶级菜单-【url外链菜单】
								        	<?php elseif($vo["wxsys"] != ''): ?>
								        		顶级菜单-【微信扩展菜单】
								        	<?php else: ?>
								        		父级菜单<?php endif; ?>
										</td>
										<td>
											<?php if($vo["keyword"] != ''): echo ($vo["keyword"]); ?>
								        	<?php elseif($vo["url"] != ''): ?>
								        		<a href="<?php echo ($vo["url"]); ?>" target="_blank" title="<?php echo ($vo["url"]); ?>" style="color:blue;">链接预览(鼠标悬浮可显示)</a>
								        	<?php elseif($vo["wxsys"] != ''): ?>
								        		<?php echo ($vo["wxsys"]); ?>
								        	<?php else: ?>
								        		无<?php endif; ?>
										</td>
										<td class="textcenter">
											<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Diymenu/class_edit',array('id'=>$vo['id']));?>','编辑菜单',560,350,true,false,false,editbtn,'add',true);">编辑</a> | 
											<a href="javascript:void(0);" class="delete_row" parameter="id=<?php echo ($vo["id"]); ?>" url="<?php echo U('Diymenu/class_del');?>">删除</a>
										</td>
									</tr>
									<?php if(is_array($vo['class'])): $i = 0; $__LIST__ = $vo['class'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo ($vo1["sort"]); ?></td>
										<td>|----　<?php echo ($vo1["title"]); ?></td>
										<td>
											<?php if($vo1["keyword"] != ''): ?>关键词回复菜单
								        	<?php elseif($vo1["url"] != ''): ?>
								        		url外链菜单
								        	<?php elseif($vo1["wxsys"] != ''): ?>
								        		微信扩展菜单<?php endif; ?>
										</td>
										<td>
											<?php if($vo1["keyword"] != ''): echo ($vo1["keyword"]); ?>
								        	<?php elseif($vo1["url"] != ''): ?>
								        		<a href="<?php echo ($vo1["url"]); ?>" target="_blank" title="<?php echo ($vo1["url"]); ?>" style="color:blue;">链接预览(鼠标悬浮可显示)</a>
								        	<?php elseif($vo1["wxsys"] != ''): ?>
								        		<?php echo ($vo1["wxsys"]); ?>
								        	<?php else: ?>
								        		无<?php endif; ?>
										</td>
										<td class="textcenter">
											<a href="javascript:void(0);" onclick="window.top.artiframe('<?php echo U('Diymenu/class_edit',array('id'=>$vo1['id']));?>','编辑菜单',560,350,true,false,false,editbtn,'add',true);">编辑</a> | 
											<a href="javascript:void(0);" class="delete_row" parameter="id=<?php echo ($vo1["id"]); ?>" url="<?php echo U('Diymenu/class_del');?>">删除</a>
										</td>
									</tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
							<?php else: ?>
								<tr><td class="textcenter red" colspan="5">列表为空！</td></tr><?php endif; ?>
							<tr>
								<td>
									<div class="mainnav_title"><ul><a class="on" url="<?php echo U('Diymenu/class_send');?>" id="class_send" style="background-color:#44b549;cursor:pointer;">生成自定义菜单</a></ul></div>
								</td>
								<td class="red" colspan="4">注意：1级菜单最多只能开启3个，2级子菜单最多开启5个<br/>官方说明：修改后，需要重新关注，或者最迟隔天才会看到修改后的效果！</td>
							</tr>
						</tbody>
					</table>
				</div>
			</form>
		</div>
<script type="text/javascript">
$(document).ready(function(){

	$('#class_send').click(function(){
		var now_dom = $(this);
		window.top.art.dialog({
			icon: 'question',
			title: '请确认',
			id: 'msg' + Math.random(),
			lock: true,
			fixed: true,
			opacity:'0.4',
			resize: false,
			content: '自定义菜单最多勾选3个，每个菜单的子菜单最多5个，请确认!',
			ok:function (){
				$.get(now_dom.attr('url'),function(result){
					if(result.status == 1){
						window.top.msg(1,'自定义菜单生成成功！');
						window.top.main_refresh();
					}else{
						window.top.msg(0,result.info);
					}
				});
			},
			cancel:true
		});
		return false;
	});
});
</script>
	</body>
</html>