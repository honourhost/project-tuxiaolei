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
            <a href="<?php echo U('Else/single');?>" class="on">市场人员负责单品特卖列表</a>
        </ul>
    </div>

    <div class="table-list">
        <table width="100%" cellspacing="0">
            <colgroup><col> <col> <col><col><col><col><col><col><col width="180" align="center"> </colgroup>
            <thead>
            <tr>
                <th class="textcenter">人员id</th>
                <th class="textcenter">姓名</th>
                <th class="textcenter">电话</th>
                <th class="textcenter">操作</th>

            </tr>
            </thead>
            <tbody>
            <?php if(is_array($marketers)): if(is_array($marketers)): $i = 0; $__LIST__ = $marketers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td  class="textcenter"><?php echo ($vo["id"]); ?></td>
                        <td  class="textcenter"><?php echo ($vo["name"]); ?></td>
                        <td  class="textcenter"><?php echo ($vo["phone"]); ?></td>
                        <td class="textcenter"><a href="<?php echo U('Else/singlelist',array('mar_id'=>$vo['id']));?>">单品列表</a></td>


                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr><td class="textcenter pagebar" colspan="10"><?php echo ($pagebar); ?></td></tr>
                <?php else: ?>
                <tr><td class="textcenter red" colspan="10">列表为空！</td></tr><?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
	</body>
</html>