<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>商家中心 - {pigcms{$config.site_name}</title>
		<link href="{pigcms{$static_path}login/userAccounts.css" rel="stylesheet" type="text/css" media="screen" />
		<script src="{pigcms{$static_path}login/jquery-1.11.2.min.js" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript">if(self!=top){window.top.location.href = "{pigcms{:U('Login/index')}";}</script>
	</head>

	<body>
		<div class="main">
			<div class="login-container">
				<div class="wrapper">
					<div class="login-logo">
						<img src="{pigcms{$static_path}login/img/logodi.png" alt="小农丁">

					</div>
					<div class="section">
						<div class="qui-login-section section-login">
							<div class="qui-login-tabs">
								<a class="change-tab change-login-type change-login-mail current login">
									账号登录
								</a>
								<a class="change-tab change-login-type change-login-mail reg">
									新用户注册
								</a>
							</div>
							<form method="post" id="login_form">
							<div class="qui-login-form login-form">

								<div class="qui-login-input input-control input-control-login-phone">
									<input name="account" id="login_account" type="text" class="ui3_input field_valid" title="手机号" placeholder="手机号">
									
								</div>
								<div class="qui-login-input">
									<input name="pwd" id="login_pwd" type="password" class="ui3_input field_valid" title="密码" tabindex="2" placeholder="密码">
									
								</div>
								<div class="qui-login-input">
									<input class="ui2_input field_valid" style="position: relative; top: -10px;" placeholder="验证码"  class="text-input" type="text" id="login_verify" style="width:60px;" maxlength="4" name="verify"/>&nbsp;&nbsp;
									<span class="verify_box">
										<img src="/merchant.php?g=Merchant&c=Login&a=verify&type=reg" id="reg_verifyImg" onclick="reg_fleshVerify('/merchant.php?g=Merchant&c=Login&a=verify&type=reg')" title="换一张" alt="换一张"/>
										<a href="javascript:reg_fleshVerify('/merchant.php?g=Merchant&c=Login&a=verify&type=reg')">换一张</a>
									</span>
									
								</div>
								<div class="qui-login-input qui-login-btn">
									<input type="submit" class="ui_button btn_submit login_btn" value="登录">
								</div>
							</div>
							</form>
							<form method="post" id="reg_form">
							<div class="qui-login-form reg-form">

								<div class="qui-login-input input-control input-control-register-phone">
									<input type="text" name="account" id="reg_account" class="ui3_input field_valid" title="手机号" placeholder="请设置6~16位登陆账户">
									
								</div>
								<div class="qui-login-input">
									<input type="password" name="pwd" id="reg_pwd" class="ui3_input field_valid" maxlength="16" title="密码" tabindex="4" placeholder="设置大于6位的登录密码">
									
								</div>
								<div class="qui-login-input input-control input-control-register-phone">
									<input type="text" name="name" id="reg_name" class="ui3_input field_valid" title="商家名称" placeholder="商家名称">
									
								</div>
								<div class="qui-login-input input-control input-control-register-phone">
									<span id="choose_cityarea"></span>
								</div>
								<div class="qui-login-input input-control input-control-register-phone">
									<input type="text" name="email" id="reg_email" class="ui3_input field_valid" title="邮箱" placeholder="请输入您的邮箱">
									
								</div>
								<div class="qui-login-input input-control input-control-register-phone">
									<input type="text" name="phone" id="reg_phone" class="ui3_input field_valid" title="手机号" placeholder="请输入您的手机号码">
									
								</div>
								<div class="qui-login-input">
									<input  class="ui2_input field_valid" style="position: relative; top: -10px;" type="text" id="reg_verify" style="width:60px;" maxlength="4" name="verify" placeholder="验证码"/>
									<span class="verify_box">
										<img src="/merchant.php?g=Merchant&c=Login&a=verify&type=reg" id="reg_verifyImg" onclick="reg_fleshVerify('/merchant.php?g=Merchant&c=Login&a=verify&type=reg')" title="换一张" alt="换一张"/>
										<a href="javascript:reg_fleshVerify('/merchant.php?g=Merchant&c=Login&a=verify&type=reg')">换一张</a>
									</span>
									
								</div>
								<div class="qui-login-input qui-login-btn">
									<input type="submit" class="ui_button btn_submit" value="注册" data-value="注册">
								</div>

							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
	<script type="text/javascript" src="{pigcms{:C('JQUERY_FILE')}"></script>
		<script type="text/javascript">
			var static_public="{pigcms{$static_public}",static_path="{pigcms{$static_path}",login_check="{pigcms{:U('Login/check')}",reg_check="{pigcms{:U('Login/reg_check')}",merchant_index="{pigcms{:U('Index/index')}",choose_province="{pigcms{:U('Area/ajax_province')}",choose_city="{pigcms{:U('Area/ajax_city')}",choose_area="{pigcms{:U('Area/ajax_area')}",choose_circle="{pigcms{:U('Area/ajax_circle')}", show_circle = 1;
		</script>
		<script type="text/javascript" src="{pigcms{$static_path}login/login.js"></script>
		<script type="text/javascript" src="{pigcms{$static_path}js/area.js"></script>
	<script>
		$(document).ready(function() {
			$('.qui-login-tabs a.login').click(function() {
				$('.login-form').show();
				$('.reg-form').hide();
				$('.qui-login-tabs a.login').addClass('current');
				$('.qui-login-tabs a.reg').removeClass('current');
			})
			$('.qui-login-tabs a.reg').click(function() {
				$('.login-form').hide();
				$('.reg-form').show();
				$('.qui-login-tabs a.reg').addClass('current');
				$('.qui-login-tabs a.login').removeClass('current');
			})
		})
	</script>

</html>