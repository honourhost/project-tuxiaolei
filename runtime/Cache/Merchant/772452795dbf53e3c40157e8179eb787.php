<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
		<title>跳转提示</title>
	</head>
	<body id="body">
		<style>
		body {margin:0;padding:0;background:#f8f8f8}
		div { font-size:12px;}
		a:link {COLOR: #0a4173; text-decoration:none;}
		a:visited {COLOR: #0a4173; text-decoration:none;}
		a:hover {COLOR: #1274ba; text-decoration:none;}
		a:active {COLOR: #1274ba; text-decoration:none;}
		
		@media all and (min-width:750px) and (max-width:1980px){
			.public-cen{
			   display: none;
	    	}
		}
		@media all and (min-width:240px) and (max-width:750px){
			.max-width{
				display: none;
			}
			.public-cen{
				max-width: 650px;
				min-width: 240px;
				margin: 0px auto;
				text-align: center;
			}
			.error-img{
				width: 100px;
				text-align: center;
				margin: 0px auto;
				padding-top: 50px;
			}
			.error-img img{
				width: 100%;
			}
			h3.title{
				font-size: 16px;
				display: block;
				padding-top: 5px;
				color: #404040;
			}
			p.tz{
				font-size: 12px;
				padding-top: 20px;
				color: #acacac;
			}
			p.tz a{
				color:#ff7466;
			}
			.fuwu{
				width: 100%;
				text-align: center;
				color: #acacac;
				padding-bottom: 10px;
				position: absolute;
				bottom: 0;
				left: 0;
				font-size: 12px;
			}
		}
		</style>
		<div class="max-width" style="background:#fff;font-size:14px;max-width:600px; min-width: 240px; margin:60px auto; line-height:48px;height:28px;text-align:center;padding:60px 30px 100px 30px;border:5px solid #f3f3f3">
			<?php if(isset($message)): ?><img src="<?php echo ($config["site_url"]); ?>/static/js/artdialog/skins/icons/face-smile.png" align="absmiddle" />
				&nbsp;&nbsp;<?php echo($message); ?>
					<?php else: ?>
					<img src="<?php echo ($config["site_url"]); ?>/static/js/artdialog/skins/icons/face-sad.png" align="absmiddle" />
					&nbsp;&nbsp;<?php echo($error); endif; ?>
					<br/>
					<span style="font-size:12px;color:#999">
						<b id="wait"><?php echo($waitSecond); ?></b> 秒后将自动跳转，如果您的浏览器不能跳转
						</span> 
						<a style="font-size:12px;" id="href" href="<?php echo($jumpUrl);?>">请点击</a>
		</div>
		<div class="public-cen">
			<?php if(isset($message)): ?><div class="error-img">
				<img src="http://www.xiaonongding.com/tpl/Static/weizan/images/chengg.png" />
			</div>
			<h3 class="title"><?php echo($message); ?></h3>
			<?php else: ?>
			<div class="error-img">
				<img src="http://www.xiaonongding.com/tpl/Static/weizan/images/error.png" />
			</div>
			<h3 class="title"><?php echo($error); ?></h3><?php endif; ?>
			<p class="tz" id="wait2"><?php echo($waitSecond); ?>秒后自动跳转，如果没有跳转<a href="<?php echo($jumpUrl);?>" id="href2" >请点击</a></p>
		    <div class="fuwu">
				本服务由小农丁提供
			</div>
		</div>
		<script type="text/javascript">
			(function(){
				var wait = document.getElementById('wait'),href = document.getElementById('href').href;
				var interval = setInterval(function(){
					var time = --wait.innerHTML;
					if(time <= 0) {
						location.href = href;
						clearInterval(interval);
					};
				}, 1000);
			})();
			
		</script>
	</body>
</html>