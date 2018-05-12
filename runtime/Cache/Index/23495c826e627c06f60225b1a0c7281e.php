<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>登录 | <?php echo ($config["site_name"]); ?></title>
    <!--[if IE 6]>
		<script src="<?php echo ($static_path); ?>js/DD_belatedPNG_0.0.8a-min.v86c6ab94.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="<?php echo ($static_path); ?>js/html5shiv.min-min.v01cbd8f0.js"></script>
    <![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo ($config["site_url"]); ?>/tpl/Static/default/css/common.v113ea197.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($config["site_url"]); ?>/tpl/Static/default/css/base.v492b572b.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($config["site_url"]); ?>/tpl/Static/default/css/login.v7e870f72.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($config["site_url"]); ?>/tpl/Static/default/css/login-section.vfa22738e.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($config["site_url"]); ?>/tpl/Static/default/css/qrcode.v74a11a81.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/footer.css" />
	<script src="<?php echo ($static_public); ?>js/jquery.min.js"></script>
</head>
<body id="login" class="theme--www" style="position: static;">
	<header id="site-mast" class="site-mast site-mast--mini">
	    <div class="site-mast__branding cf">
			<a href="<?php echo ($config["site_url"]); ?>"><img src="<?php echo ($static_path); ?>images/xnd_img/header_logo.gif" alt="<?php echo ($config["site_name"]); ?>" title="<?php echo ($config["site_name"]); ?>" style="height:34px;"/></a>
	    </div>
	</header>
	<div class="site-body pg-login cf">
	    <div class="promotion-banner">
	        <img src="<?php echo ($config["site_url"]); ?>/tpl/Static/default/css/img/web_login/<?php echo mt_rand(1,4);?>.jpg" width="480" height="370">    
	    </div>
	    <div class="component-login-section component-login-section--page mt-component--booted" >
		    <div class="origin-part theme--www">
			    <div class="validate-info" style="visibility:hidden"></div>
		        <h2 style="font-size: 14px;">账号登录</h2>
		        <form id="J-login-form" method="post" class="form form--stack J-wwwtracker-form">
			        <div class="form-field form-field--icon">
			            <i class="icon icon-user"></i>
			            <input type="text" id="login-phone" class="f-text" name="phone" placeholder="手机号" value="<?php echo ($_COOKIE["login_name"]); ?>"/>
			        </div>
			        <div class="form-field form-field--icon" >
			            <i class="icon icon-password"></i>
			            <input type="password" id="login-password" class="f-text" name="pwd" placeholder="密码"/>
			        </div>
			        <div class="form-field form-field--ops">
			            <input type="hidden" name="fingerprint" class="J-fingerprint"/>
			            <input type="hidden" name="origin" value="account-login"/>
			            <input type="submit" class="btn" id="commit" value="登录"/>
			        </div>
			    </form>
			    <p class="signup-guide">还没有账号？<a href="<?php echo U('Login/reg',array('referer'=>urlencode($referer)));?>">免费注册</a></p>
				<p style="float: right;display:none;" id="forgetpwd">忘记密码？<a href="#" onclick="$(this).attr('href','<?php echo U('Login/forgetpwd');?>&accphone='+$('#login-phone').val());">点这里</a></p> 
			    <div class="oauth-wrapper">
			        <h3 class="title-wrapper"><span class="title">用手机微信扫码登录</span></h3>
			        <div class="oauth cf">
			            <a class="oauth__link oauth__link--weixin" href="javascript:void(0);"></a>
			        </div>   
			    </div>
		    </div>
		</div>
	</div>
	<script src="<?php echo ($static_public); ?>js/artdialog/jquery.artDialog.js"></script>
	<script src="<?php echo ($static_public); ?>js/artdialog/iframeTools.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			if($('body').height() < $(window).height()){
				$('.site-info-w').css({'position':'absolute','width':'100%','bottom':'0'});
			}
			$("#J-login-form").submit(function(){
				$('.validate-info').css('visibility','hidden');
				$('#commit').val('登录中...').prop('disabled',true);
				var phone = $("#login-phone").val();
				var pwd = $("#login-password").val();
				if (phone == '' || phone == null) {
					$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>手机号不能为空').css('visibility','visible');
					$("#commit").val('登录').prop('disabled',false);
					return false;
				}
				if (pwd == '' || pwd == null) {
					$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>密码不能为空').css('visibility','visible');
					$("#commit").val('登录').prop('disabled',false);
					return false;
				}
				
				$.post("<?php echo U('Index/Login/index');?>", {'phone':phone, 'pwd':pwd}, function(data){
					if (data.error_code) {
						$("#commit").val('登录').prop('disabled',false);
						$('.validate-info').html('<i class="tip-status tip-status--opinfo"></i>'+data.msg).css('visibility','visible');
						if(data.msg=='密码不正确!'){
						  $('#forgetpwd').show();
						}
						return false;
					} else {
						$('.validate-info').html('<i class="tip-status tip-status--success"></i>登录成功！正在跳转.').css('visibility','visible');
						setTimeout("location.href='<?php echo ($referer); ?>'", 1000);
					}
				}, 'json');
				return false;
			});
			
			$('.oauth__link--weixin').click(function(){
				art.dialog.open("<?php echo U('Index/Recognition/see_login_qrcode',array('referer'=>urlencode($referer)));?>&"+Math.random(),{
					init: function(){
						var iframe = this.iframe.contentWindow;
						window.top.art.dialog.data('login_iframe_handle',iframe);
					},
					id: 'login_handle',
					title:'请使用微信扫描二维码登录',
					padding: 0,
					width: 430,
					height: 433,
					lock: true,
					resize: false,
					background:'black',
					button: null,
					fixed: false,
					close: null,
					left: '50%',
					top: '38.2%',
					opacity:'0.4'
				});
				return false;
			});
		});
	</script>
	<!-- 王强新增footer -->
<!--gulp_combine_model_start-->
		<!-- 右侧浮动 -->
		<link href="<?php echo ($static_path); ?>css/xnd_css/channel_block.css" rel="stylesheet" />
		<link href="<?php echo ($static_path); ?>css/xnd_css/frame_block.css" rel="stylesheet" />
		<div class="zw-module-sidefloater-wrap">
			
			<a class="zw-module-sidefloater-cell myorder" href="/index.php?g=User&c=Index&a=index" title="" target="_blank">
				<i class="zwui-iconfont icon-order"></i>
				<div class="sidefloater-cell-text">
					<p class="sidefloater-cell-text-inner">
						<span>我的</span>
						<span>订单</span>
					</p>
				</div>
			</a>
			<a class="zw-module-sidefloater-cell collect" href="/index.php?g=User&c=Collect&a=index" title="" target="_blank">
				<i class="zwui-iconfont icon-Collect"></i>
				<div class="sidefloater-cell-text">
					<p class="sidefloater-cell-text-inner">
						<span>我的</span>
						<span>收藏</span>
					</p>
				</div>
			</a>
			<div id="gototop" class="zw-module-sidefloater-cell totop">
				<i class="zwui-iconfont icon-top"></i>
			</div>
		</div>
		<!-- 右侧浮动 end -->
		<!--gulp_combine_model_end-->
		<link rel="stylesheet" type="text/css" href="<?php echo ($static_path); ?>css/xnd_css/footer.css">
		<!-- 公共尾部 -->
		<div class="zw-footerprepend">
			<ul class="zw-footer-nav">
				<li><a href="/intro/1.html">关于小农丁</a></li>
				<li><a href="/intro/27.html">七天无条件退货</a></li>
				<li><a href="/intro/12.html">农场入驻</a></li>
				<li><a href="/intro/11.html">邀约返利</a></li>
				<li><a href="/intro/5.html">联系我们</a></li>
			</ul>
			<ul class="zw-footer-feature">
				<li>
					<p class="icon zybz"></p>
					<h3 class="title">身份保障</h3>
					<p class="text">农场生产环节透明，产品加工过程安全，企业资质审核严格，用户服务担保交易</p>
				</li>
				<li>
					<p class="icon dcsh"></p>
					<h3 class="title">健康承诺</h3>
					<p class="text">倡导入驻企业，农场，商户与消费者签署《产品服务品质承诺书》</p>
				</li>
				<li>
					<p class="icon axph"></p>
					<h3 class="title">口碑监督</h3>
					<p class="text">靠谱商家以身作则，消费者亲历打造农场诚信评价档案，有机轨迹一网打尽</p>
				</li>
			</ul>
		</div>

		<!-- 公共尾部 -->
		<div class="zw-footer">
			<div class="zw-footer-wrap">
				<div class="zw-footer-line1 clearfix">
					<div class="zw-footer-intro">
						<p class="logo"><img alt="小农丁" src="<?php echo ($static_path); ?>images/xnd_img/foot_logo.png"></p>
						<p class="text">
							您有多久没有闻过泥土的芬芳？您的孩子是否从未在农田里奔跑？您是否厌倦了城市钢筋水泥般枯槁的生活？您是否渴望寻找一片属于自己和家人的乐园？您是否心中始终怀揣着回归田园的梦想？
						</p>
					</div>
					<dl class="zw-footer-concerns">
						<dt>关注我们</dt>
						<dd class="iphone">
							<p class="icons">
								<span class="zwui-iconfont icon-iphone"></span>
							</p>
							<div class="layer">
								<div class="box">
									<div class="clearfix">
										<p class="pics"><img src="<?php echo ($static_path); ?>images/xnd_img/foot-qrcode-app.jpg"></p>
										<div class="text">
											<p class="txt1">扫一扫下载</p>
											<p class="txt2">小农丁</p>
											<p class="txt3">APP</p>
										</div>
									</div>
								</div>
							</div>
						</dd>
						<dd class="wechat">
							<p class="icons">
								<span class="zwui-iconfont icon-wechat"></span>
							</p>
							<div class="layer">
								<div class="box">
									<div class="clearfix">
										<p class="pics"><img src="<?php echo ($static_path); ?>images/xnd_img/foot-qrcode-weixin.png"></p>
										<div class="text">
											<p class="txt1">扫一扫关注</p>
											<p class="txt2">小农丁</p>
											<p class="txt3">微信</p>
										</div>
									</div>
								</div>
							</div>
						</dd>
						<dd class="weibo">
							<p class="icons"><span class="zwui-iconfont icon-weibo"></span></p>
							<div class="layer">
								<div class="box">
									<div class="clearfixs">
										<a href="http://weibo.com/5786818471/profile?topnav=1&wvr=6&is_all=1" target="_blank" class="follow">+ 关注</a>
										<span class="text"><a href="http://weibo.com/5786818471/profile?topnav=1&wvr=6&is_all=1" target="_blank">@小农丁</a></span>
									</div>
								</div>
							</div>
						</dd>
						
					</dl>
				</div>
				<div class="zw-footer-line2">
					<div class="zw-footer-listlinks" style="text-align: center;">
						2015-2016 © 小农丁™ xiaonongding.com All rights reserved. 鲁ICP备14030686号-1
						&nbsp;&nbsp;&nbsp;&nbsp;所属公司：广东南海小农丁生态科技有限公司
                        <iframe src="http://wljg.gdgs.gov.cn/lz.ashx?vie=41BEF320E537FBF5BCFF028CECF113DC0F88F21F9E5DE7CF7B900DB7A3B0EF3A97F3CE4C54842EFBB364A2152BDEBA45897A4B9572EC77E9" allowtransparency="true" scrolling="no" style="overflow:hidden;text-align: center;float: right;" frameborder="0"></iframe>
					</div>
                    <div style="display: none;">

                    </div>

					<p class="zw-footer-frilinks">
						友情链接：
						<a href="http://www.joyvio.com/" target="_blank">佳沃农业</a>
						<a href="http://www.taobao.com/" target="_blank">淘宝</a>
						<a href="http://z.jd.com/new.html" target="_blank">京东众筹</a>
					</p>
				</div>
			</div>
		</div>
		<!-- app下载浮动广告 -->
<!-- 王强新增footer end -->






<!-- old footer -->
<footer style="display: none;">
	<div class="footer1">
		<div class="footer_txt cf">
			<div class="footer_list cf">
				<ul class="cf">
					<?php $footer_link_list = D("Footer_link")->get_list();if(is_array($footer_link_list)): $i = 0;if(count($footer_link_list)==0) : echo "列表为空" ;else: foreach($footer_link_list as $key=>$vo): ++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a><?php if($i != count($footer_link_list)): ?><span>|</span><?php endif; ?></li><?php endforeach; endif; else: echo "列表为空" ;endif; ?>
				</ul>
			</div>
			<div class="footer_txt"><?php echo nl2br(strip_tags($config['site_show_footer'],'<a>'));?></div>
		</div>
	</div>
</footer>
<div style="display:none;"><?php echo ($config["site_footer"]); ?></div>
<!--悬浮框-->
<?php if(MODULE_NAME != 'Login'): ?><div class="rightsead" style="display: none;">
		<ul>
			<li>
				<a href="javascript:void(0)" class="wechat">
					<img src="<?php echo ($static_path); ?>images/l02.png" width="47" height="49" class="shows"/>
					<img src="<?php echo ($static_path); ?>images/a.png" width="57" height="49" class="hides"/>
					<img src="<?php echo ($config["wechat_qrcode"]); ?>" width="145" class="qrcode"/>
				</a>
			</li>
			<?php if($config['site_qq']): ?><li>
					<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($config["site_qq"]); ?>&site=qq&menu=yes" target="_blank" class="qq">
						<div class="hides qq_div">
							<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll04.png"/></div>
							<div class="hides p2"><span style="color:#FFF;font-size:13px"><?php echo ($config["site_qq"]); ?></span></div>
						</div>
						<img src="<?php echo ($static_path); ?>images/l04.png" width="47" height="49" class="shows"/>
					</a>
				</li><?php endif; ?>
			<?php if($config['site_phone']): ?><li>
					<a href="javascript:void(0)" class="tel">
						<div class="hides tel_div">
							<div class="hides p1"><img src="<?php echo ($static_path); ?>images/ll05.png"/></div>
							<div class="hides p3"><span style="color:#FFF;font-size:12px"><?php echo ($config["site_phone"]); ?></span></div>
						</div>
						<img src="<?php echo ($static_path); ?>images/l05.png" width="47" height="49" class="shows"/>
					</a>
				</li><?php endif; ?>
			<li>
				<a class="top_btn">
					<div class="hides btn_div">
						<img src="<?php echo ($static_path); ?>images/ll06.png" width="161" height="49"/>
					</div>
					<img src="<?php echo ($static_path); ?>images/l06.png" width="47" height="49" class="shows"/>
				</a>
			</li>
		</ul>
	</div><?php endif; ?>
<script>
    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>

<!--leftsead end-->








</body>
</html>