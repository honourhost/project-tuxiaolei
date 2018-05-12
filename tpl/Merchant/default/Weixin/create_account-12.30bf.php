<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-gear gear-icon"></i>
                <a href="{pigcms{:U('weixin/create_account')}">商家微信设置</a>
            </li>
            <li class="active">商家微信设置</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <style>
                .ace-file-input a {display:none;}
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a data-toggle="tab" href="#basicinfo">微信基本设置</a>
                            </li>
                        </ul>
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" method="post" id="edit_form">
                        <div class="tab-content">
                        	<style>
                        	  .form-group .col-sm-1{
                        	  	width: 200px;
                        	  	margin-left: 5px;
                        	  }
                        	  .form-group .col-sm-2{
                        	  	width: 300px;
                        	  }
                        	  .form-group button{
                        	  	margin-left: 15px;
                        	  }
                        	</style>
                            <div id="basicinfo" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-sm-1"><label>微信设置的url</label></label>
                                    <input type="hidden" name="url" value="http://www.xiaonongding.com/merchant.php?g=Merchant&c=weixinResponse&a=index&mer_id={pigcms{$mer_id}">
                                    <label>
                                    	http://www.xiaonongding.com/merchant.php?g=Merchant&c=weixinResponse&a=index&mer_id={pigcms{$mer_id}
                                    	<span><a>复制</a></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label>微信appid</label></label>
                                    <input class="col-sm-2" size="20" value="{pigcms{$authorizer_appid}" name="authorizer_appid" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label>微信appsecret</label></label>
                                    <input class="col-sm-2" size="20" value="{pigcms{$authorizer_refresh_token}" name="authorizer_refresh_token" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label>TOKEN</label></label>
                                    <input class="col-sm-2" size="20" value="{pigcms{$func_info}" name="func_info" type="text"/>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-1"><label>EncodingAESKey</label></label>
                                    <input class="col-sm-2" size="20" value="{pigcms{$user_name}"  name="wechat_encodingaeskey" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="phone">微信类型(注：订阅号无法配置菜单，服务号才可以)</label></label>
                                    <select name="service_type_info">
                                        <option value="1">订阅号</option>
                                        <option value="2">服务号</option>
                                    </select>
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <label class="col-sm-1"><label for="phone">认证类型</label></label>-->
<!--                                    <select name="verify_type_info">-->
<!--                                        <option value="1">已认证</option>-->
<!--                                        <option value="0">未认证</option>-->
<!--                                    </select>-->
<!--                                </div>-->
                                <div class="form-group">
                                    <button class="btn btn-info" type="submit">提交</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    input.ke-input-text {
        background-color: #FFFFFF;
        background-color: #FFFFFF!important;
        font-family: "sans serif",tahoma,verdana,helvetica;
        font-size: 12px;
        line-height: 24px;
        height: 24px;
        padding: 2px 4px;
        border-color: #848484 #E0E0E0 #E0E0E0 #848484;
        border-style: solid;
        border-width: 1px;
        display: -moz-inline-stack;
        display: inline-block;
        vertical-align: middle;
        zoom: 1;
    }
    .form-group>label{font-size:12px;line-height:24px;}
    #upload_pic_box{margin-top:20px;height:150px;}
    #upload_pic_box .upload_pic_li{width:130px;float:left;list-style:none;}
    #upload_pic_box img{width:100px;height:70px;}

    .small_btn{
        margin-left: 10px;
        padding: 6px 8px;
        cursor: pointer;
        display: inline-block;
        text-align: center;
        line-height: 1;
        letter-spacing: 2px;
        font-family: Tahoma, Arial/9!important;
        width: auto;
        overflow: visible;
        color: #333;
        border: solid 1px #999;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        background: #DDD;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFF', endColorstr='#DDDDDD');
        background: linear-gradient(top, #FFF, #DDD);
        background: -moz-linear-gradient(top, #FFF, #DDD);
        background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FFF), to(#DDD));
        text-shadow: 0px 1px 1px rgba(255, 255, 255, 1);
        box-shadow: 0 1px 0 rgba(255, 255, 255, .7), 0 -1px 0 rgba(0, 0, 0, .09);
        -moz-transition: -moz-box-shadow linear .2s;
        -webkit-transition: -webkit-box-shadow linear .2s;
        transition: box-shadow linear .2s;
        outline: 0;
    }
    .small_btn:active{
        border-color: #1c6a9e;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#33bbee', endColorstr='#2288cc');
        background: linear-gradient(top, #33bbee, #2288cc);
        background: -moz-linear-gradient(top, #33bbee, #2288cc);
        background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#33bbee), to(#2288cc));
    }
</style>
<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">
<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>
<script src="{pigcms{$static_public}kindeditor/lang/zh_CN.js"></script>
<!--<script type="text/javascript">
        $('#edit_form').submit(function(){
            $.post("{pigcms{:U('weixin/create_account')}",$('#edit_form').serialize(),function(result){
                if(result.status == 1){
                    alert(result.info);
                    window.location.href = "{pigcms{:U('weixin/index')}";
                }else{
                    alert(result.info);
                }
            })
            return false;
        });

</script>-->
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_public}js/artdialog/iframeTools.js"></script>
<include file="Public:footer"/>
