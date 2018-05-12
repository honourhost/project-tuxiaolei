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
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <?php if(empty($_GET['cat_fid'])): ?><col/>
                        <col/><?php endif; ?>
                    <col/>
                    <col width="180" align="center"/>
                </colgroup>
                <thead>
                <tr>
                    <th>编号</th>
                    <th>店铺名称</th>
                    <th>提交申请人真实姓名</th>
                    <th>电话</th>
                    <th>银行名称</th>
                    <th>银行卡号</th>
                    <th>申请提现金额</th>
                    <th>提现请求状态</th>
                    <th>操作</th>
					<th>申请时间</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($cash_list)): if(is_array($cash_list)): $i = 0; $__LIST__ = $cash_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td><?php echo ($vo["merchant_real_name"]); ?></td>
                            <td><?php echo ($vo["merchant_real_telephone"]); ?></td>
                            <td><?php echo ($vo["bank_name"]); ?></td>
                            <td><?php echo ($vo["bank_card"]); ?></td>
                            <td><?php echo ($vo["cash_num"]); ?></td>
                            <td><?php if($vo['cash_status']==0): ?>等待审核<?php elseif($vo['cash_status']==2): ?>已驳回<?php else: ?>已经完成提现<?php endif; ?></td>
                            <td><a href="javascript:void(0);" class="delete_row" parameter="id=<?php echo ($vo["id"]); ?>" url="<?php echo U('Cash/finish');?>">完成提现</a> | <a href="javascript:void(0);"  onclick="window.top.artiframe('<?php echo U('Cash/reject',array('id'=>$vo['id']));?>','编辑驳回信息',480,240,true,false,false,editbtn,'edit',true);"">驳回</a></td>
							 <td><?php echo (date('Y-m-d H:i',$vo["create_time"])); ?></td>
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