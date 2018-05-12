<include file="Public:header"/>

<div class="main-content">
	<!-- 内容头部 -->
	<div class="breadcrumbs" id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-wechat"></i>
				<a href="{pigcms{:U('Weixin/index')}">公众号设置</a>
			</li>
			<li class="active">公众号绑定</li>
		</ul>
	</div>
	<!-- 内容头部 -->
	<div class="page-content">
		<div class="page-content-area">
			<div class="row">
				<div class="col-xs-12">
					<if condition="empty($bind)">
						<if condition="$url">
							<div id="shopList" class="grid-view">
								<div class="span12" style="margin-top:10px;">
									<div class="form-actions">
										<a class="btn btn-success cert-setting-btn js-wxauth-btn" target="_blank" data-url="{pigcms{$url}" href="{pigcms{$url}"><i class="ace-icon fa fa-wechat"></i>我有微信公众号，立即设置</a>
									</div>
								</div>
							</div>
						<else />
							<div id="shopList" class="grid-view">
								<div class="span12" style="margin-top:10px;">
									<div class="form-actions">
										<a class="btn btn-error cert-setting-btn">平台还没有开启网页授权，或管理员配置错误，请联系系统管理者！</a>
									</div>
								</div>
							</div>
						</if>
					<else />
					<form enctype="multipart/form-data" class="form-horizontal" action="{pigcms{:U('weixin/create_account')}" method="post" id="edit_form">
						<div class="tab-content">
							<style>
                        	  .form-group .col-sm-1{
                        	  	width: 200px;
                        	  	margin-left: 5px;
                        	  }
                        	  .form-group .col-sm-2{
                        	  	width: 400px;
                        	  }
                        	  .form-group .col-sm-3{
                        	  	width: 100px;
                        	  	margin-right: 10px;
                        	  }
                        	  .form-group button{
                        	  	margin-left: 15px;
                        	  }
                        	  .normalTitle{
									padding: 5px 0px 15px 0px;
									background: #f4f4f4;
									border-bottom: 1px solid #d7dde6;
								}
								.normalTitle h2{
									font-size: 20px;
									font-weight: bold;
									text-indent: 20px;
								}
								.lastSection{
									padding: 15px 0px;
								}
								.CollapsiblePanelTab{
									background: #D7DDE6;
									padding: 20px 0px;
									border: 1px solid #C1C9D4;
									border-radius: 3px;
									text-shadow: 0 1px 0 white;
									font-size: 18px;
									text-indent: 20px;
								}
                        	</style>
                        	<div class="tabbable">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active">
										<a data-toggle="tab" href="#basicinfo">绑定公众号</a>
									</li>
									<li>
										<a data-toggle="tab" href="#txtstore">绑定说明</a>
									</li>
									
								</ul>
							</div>
							<div style="width: 100%; height: 20px;"></div>
							<div id="basicinfo" class="tab-pane active">
								<input type="hidden" name="pigcms_id" value="{pigcms{$bind['pigcms_id']}">
								<div class="form-group">
									<label class="col-sm-1"><label>微信初始url</label></label>
									<label>
                                    	{pigcms{$bind['qrcode_url']}
                                    	<span><a>复制</a></span>
                                    </label>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>微信appid</label></label>
									<input class="col-sm-2" size="20" value="{pigcms{$bind['authorizer_appid']}"  name="authorizer_appid" type="text"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>微信appsecret</label></label>
									<input class="col-sm-2" size="20" value="{pigcms{$bind['authorizer_refresh_token']}"  name="authorizer_refresh_token" type="text"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>TOKEN</label></label>
									<input class="col-sm-2" size="20" value="{pigcms{$bind['func_info']}"  name="func_info" type="text"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>EncodingAESKey</label></label>
									<input class="col-sm-2" size="20" value="{pigcms{$bind['user_name']}"  name="wechat_encodingaeskey" type="text"/>
								</div>
								<div class="form-group">
									<label class="col-sm-1"><label>微信类型</label></label>
									<input class="col-sm-2 col-sm-3" size="20" value="{pigcms{$bind['service_type_info']}"  name="service_type_info" type="text"/>
									<br />(其中1为订阅号；2为服务号)
									
									<!--<div id="upload_pic_box"><img width="158" height="158" src="http://open.weixin.qq.com/qr/code/?username={pigcms{$bind['alias']}"/></div>-->
								</div>
								<div class="form-group">
									<button class="btn btn-info" type="submit">提交</button>
								</div>
							</div>
						    
						    <div id="txtstore" class="tab-pane">
						    	<div class="normalTitle">
						    		<h2>
										如何为微信公众号配置接口？
									</h2>
						    	</div>
								<div class="lastSection">
									<p>请务必认真阅读以下2步内容，才能更有效的完成配置工作，有疑问的请联系QQ： 2895408403提问。
										<br/>你的接口URL是：
										<font color="red">http://p.24so.com/index.php/api/nnzcxc1429254545</font>
											<br>您的token是：
												<font color="red">nnzcxc1429254545</font>
									</p>
								</div>
								<div class="CollapsiblePanelTab">
									第一步、在小农丁平台绑定你的公众号。
								</div>
								<div class="lastSection">
	                                <p>1、注册并登录<a href="http://www.xiaonongding.com/merchant.php?g=Merchant&c=Login&a=index">小农丁商家后台</a></p>
	                                <p>2、后台左侧导航 → 公众号设置 → 公众号绑定</p>									
									<p><img src="http://demo.24so.com/xnd/img/ruzhu-img01.jpg" width="790px"></p>
									<p><img src="http://demo.24so.com/xnd/img/ruzhu-img02.jpg" width="790px"></p>
									<p><img src="http://demo.24so.com/xnd/img/ruzhu-img03.jpg" width="790px"></p>
	                            </div>
	                            <div class="CollapsiblePanelTab">
									第二步、到微信公众平台设置接口。
								</div>
								<div class="lastSection">
	                                <p>1、登录 微信公众平台（http://mp.weixin.qq.com/），进行身份认证，填写信息，提交身份证。</p>
	                                <p>认证后，点击高级功能 → 进入开发模式</p>									
									<p><img src="http://p.24so.com/tpl/static/help/help002.jpg" width="790px"></p>
								    <p>2、点击"成为开发者"按钮</p>
								    <p><img src="http://p.24so.com/tpl/static/help/help003.jpg" width="790px"></p>
								    <p>3、填写接口配置信息</p>
									<p>你的URL是 
										<font color="red">http://p.24so.com/index.php/api/nnzcxc1429254545</font>
									</p>									<p>Token填写 <font color="red">nnzcxc1429254545</font></p>
						            <p>
						            	<img src="http://p.24so.com/tpl/static/help/help004.jpg" width="790px">
						            </p>
									<p>4、确认开启</p>
									<p>5、在手机上用微信给你的公众号输入"帮助"，测试你的接口是否配置正常！</p>
								</div>
							</div>
						</div>
					</form>
					</if>
				</div>
			</div>
		</div>
	</div>
</div>

<if condition="empty($bind)">
<script type="text/javascript">
	$(document).ready(function(){
// 		$.get('merchant.php?g=Merchant&c=Weixin&a=get_url',function(response){
// 			if (response.err_code) {
// 			} else {
// 				$('.js-wxauth-btn').attr('data-url', response.err_msg);
// 			}
// 		},'json');

		$('.js-wxauth-btn').click(function(){

// 			$(".modal").dialog({
// 			    autoOpen: false,
// 			    modal: true,
// 			    buttons: {
// 			        Ok: function () {
// 			            $(this).dialog("close");
// 			        }
// 			    }
// 			});
// 			return false;
			var url = $(this).attr('data-url');
			if(url == ''){
// 				layer_tips(1,'授权网址获取失败，请联系管理员！');
// 				return false;
			}
// 			window.open(url); 
			var html = '';
			html += '<div class="modal fade in" style="width: 400px;height:165px;margin-top:-5px; " aria-hidden="false"><div class="modal-header">';
			html += '<a class="close" data-dismiss="modal">×</a>提示</div>';
			html += '<div class="modal-body">';
			html += '<p>请在新窗口中完成微信公众号授权&nbsp;&nbsp;<a href="" target="_blank"></a></p>';
			html += '</div>';
			html += '<div class="modal-footer">';
			html += '<div style="text-align: center;">';
			html += '<button type="button" class="btn btn-success js-refresh">已成功设置</button>';
			html += '<a class="btn btn-default js-retry" href="'+url+'" target="_blank" data-loading-text="地址读取中..">授权失败，重试</a>';
			html += '</div>';
			html += '</div></div>';//<div class="modal-backdrop fade in"></div>';
			$('body').append(html);
		});
		$('.close').live('click', function(){
			$(this).parents('.modal').remove();
			$('.modal-backdrop').remove();
		});
		$('.js-refresh').live('click', function(){
			location.reload();
		});
	});
</script>
</if>

<link rel="stylesheet" href="{pigcms{$static_path}css/base.css">
<style>
.form-actions {
background-color: #fff;
}
.modal{
display:block;
}
</style>
<include file="Public:footer"/>
