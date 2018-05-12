<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-gear gear-icon"></i>
                <a href="{pigcms{:U('Count/bill')}">商家账单</a>
            </li>
            <li class="active">商家提现</li>
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
                                <a data-toggle="tab" href="#basicinfo">提现内容填写</a>
                            </li>
                        </ul>
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{pigcms{:U('Count/getCash')}">
                        <div class="tab-content">
                            <div id="basicinfo" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="merchant_real_name">店主真实姓名</label></label>
                                    <input class="col-sm-2" size="20" name="merchant_real_name" id="merchant_real_name" type="text" value="{pigcms{$cash_info.merchant_real_name}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="merchant_real_telephone">联系电话</label></label>
                                    <input class="col-sm-2" size="20" name="merchant_real_telephone" id="merchant_real_telephone" type="text" value="{pigcms{$cash_info.merchant_real_telephone}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="bank_name">银行名称</label></label>
                                    <input class="col-sm-2" size="20" name="bank_name" id="bank_name" type="text" value="{pigcms{$cash_info.bank_name}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="bank_card">银行卡号</label></label>
                                    <input class="col-sm-2" size="20" name="bank_card" id="bank_card" type="text" value="{pigcms{$cash_info.bank_card}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="cash_num">申请提现金额</label></label>
                                    <input class="col-sm-2" size="20" name="cash_num" id="cash_num" type="text"/>
                                </div>
                        </div>
                        <div class="space"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    保存
                                </button>
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
    .BMap_cpyCtrl{display:none;}
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
    #upload_pic_box img{width:100px;height:70px;border:1px solid #ccc;}
</style>
<link rel="stylesheet" href="{pigcms{$static_public}kindeditor/themes/default/default.css">

<include file="Public:footer"/>
