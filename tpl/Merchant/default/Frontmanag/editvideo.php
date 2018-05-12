<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-gear gear-icon"></i>
                <a href="{pigcms{:U('Frontmanag/index')}">商家管理</a>
            </li>
            <li class="active">商家视频管理</li>
            <li class="active">新建视频</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                    <form enctype="multipart/form-data" class="form-horizontal" method="post">
                        <input  name="id" type="hidden" value="{pigcms{$video['id']}"/>
                        <div class="tab-content">
                            <div id="basicinfo" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="cyname">视频名称</label></label>
                                    <input class="col-sm-2" size="30" name="video_name" id="cyname" value="{pigcms{$video['video_name']}" type="text" />
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="cyname">视频url地址</label></label>
                                    <input class="col-sm-2" size="30" name="video_url" id="cyname" value="{pigcms{$video['video_url']}" type="text" />
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="sort">排序</label></label>
                                    <input class="col-sm-2" size="20" name="sort" id="sort" type="text" value="{pigcms{$video['sort']}" onkeyup="value=value.replace(/[^1234567890]+/g,'')"/>
                                </div>
                            </div>
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-info" type="submit" onclick="$(this).attr('type','text')">
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

<include file="Public:footer"/>
