<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-gear gear-icon"></i>
                <a href="{pigcms{:U('Jicai/category')}">集采管理</a>
            </li>
            <li class="active"><a href="{pigcms{:U('Jicai/category')}"></a></li>
            <li class="active">添加分类</li>
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
                                <a href="">添加分类</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="grid-view">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="sort_name">分类名称</label></label>
                                    <input class="col-sm-2" size="20" name="sort_name" id="sort_name" type="text" value=""/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="sort">店铺排序</label></label>
                                    <input class="col-sm-1" size="10" name="sort" id="sort" type="text" value=""/>
                                    <span class="form_tips">默认添加顺序排序！手动调值，数值越大，排序越前</span>
                                </div>


                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button class="btn btn-info" type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            保存
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<include file="Public:footer"/>
