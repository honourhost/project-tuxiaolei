<include file="Public:top"/>
<body style="background: url('http://www.xiaonongding.com/tpl/Static/default/images/xnd-shbg.jpg');background-size:100% 100%;">
	
	<div class="container container-fill" style='padding-top:50px'>
		<style>
	@media (max-height: 600px){
		.pigcms-main{
			padding-top: 10px;
		}
		.pigcms-container{
			margin-bottom: 10px;
		}
		.top-img-container{
			padding-bottom: 10px;
		}
		#login-container{
			width: 100%;
		}
		.pigcms-btn-block{
			padding: 10px 0;
		}
		#forget-password{
			margin: 10px 0;
			font-size: 12px;
		}
		#no-shop{
			margin: 20px 0 10px;
			font-size: 12px;
		}

	}
	.claim-text{
		background:#fff;
		text-align:center;
		width: 94%;
		margin: 0 3%;
		padding: 10px 0;
		color: #777;
		border-radius: 10px;
	}
</style>
<script>
	$(function(){
		$(".pigcms-main").css('height', $(window).height());
	})
</script>
	<form class="pigcms-main"  method="post" role="form" action="" enctype="multipart/form-data" onsubmit="return checkSubmit();">
		<div class="pigcms-container">
			<div class="top-img-container"><img src="http://www.xiaonongding.com/tpl/Static/default/images/xnd-shdl.png" alt="" class="top-img"></div>
		</div>
		<div class="pigcms-container">
			<div id="login-container">
				<div class="login-input-wrapper">
					<span class="login-input-after"><i class="iconfont icon-phone1"></i></span>
					<input type="text" class="login-input" name="account" placeholder="请输账号" style="text-indent: 0;" autocomplete='off'>
					<div class="clearfix"></div>
				</div>
				<div class="login-input-wrapper">
					<span class="login-input-after"><i class="iconfont icon-lock"></i></span>
					<input type="password" class="login-input" name="pwd" style="text-indent: 0;"  placeholder="请输入密码">
					<input type='hidden' value='login' name='type_id'>

					<input type='hidden' value='{pigcms{$refererUrl}' name='referurl' id="refererl">

					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<button type="submit" class="pigcms-btn-block pigcms-btn-block-info" name="submit" style="background: #4bc875;" value="登录">登录</button>
		<p id="no-shop">还没有入驻？</p>
		<a href="{pigcms{:U('Index/merreg')}" class="ruzhu" style='color:#4bc875; font-size: 18px; border: 1px solid #4bc875; '>我要入驻</a>
	</form>
</div>
</body>
	<include file="Public:footer"/>
</html>
