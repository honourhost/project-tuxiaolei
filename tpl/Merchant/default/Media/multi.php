<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-file-excel-o"></i>
                <a href="{pigcms{:U('Media/index')}">多媒体管理</a>
            </li>
            <li>上传音频</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <style>
                .ace-file-input a {
                    display: none;
                }
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div class="tab-content">
                        <div class="grid-view">
                            <form enctype="multipart/form-data" class="form-horizontal" method="post">
                                <div class="form-group">
                                    <label class="col-sm-1"><label for="contact_name">
                                            <span class="required"  style="color:red;">*</span>标题</label></label>
                                    <input type="hidden" value="{pigcms{$data['pigcms_id']}" name="pigcms_id"/>
                                    <input type="hidden" value="{pigcms{$data['type']}" name="type"/>
                                   <!-- <input type="hidden" value="{pigcms{$data['pigcms_id']}" name="thisid"/>-->
                                    <input type="text" class="col-sm-3" id="title" name="title"
                                           value="{pigcms{$data['title']}"/>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-1">音频</label>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success" id="J_selectVideo">从我的电脑上传音频</a>
                                    &nbsp;&nbsp;&nbsp;支持的格式：mp3
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1">音频试听</label>
                                    <input type="hidden" name="video_url" id="video_url"
                                           value="{pigcms{$data['video_url']}"/>
                                    <div id="upload_video_box">
                                        <ul id="upload_video_ul">
                                            <if condition="$data['video_url']">
                                                <li class="upload_pic_li">

                                                    <audio controls>
                                                        <source src="{pigcms{$data['video_url']}" type="audio/mp3">
                                                        您的浏览器不支持Video标签。
                                                    </audio>

                                                    <br/>
                                                    <a href="#"
                                                       onclick="deleteImage('{pigcms{$data['video_url']}',this);return false;">[
                                                        删除 ]</a>
                                                </li>
                                            </if>
                                        </ul>
                                    </div>
                                </div>

                                <!--<div class="form-group">
                                    <label class="col-sm-1"><label for="sort">腾讯视频vid</label></label>
                                    <input class="col-sm-3" name="video_url" id="video_url" type="text"
                                           value="{pigcms{$data['video_url']}"/>请填写腾讯视频的vid</br></br>　
                                    腾讯视频vid示例：<img width="50%" height="100%"
                                                   src="http://www.xiaonongding.com/upload/merchant/no/tenvideo.jpg">
                                </div>-->


                                <div class="form-group">
                                    <label class="col-sm-1"><label for="contact_name">作者</label></label>
                                    <input type="text" class="col-sm-3" name="author" value="{pigcms{$data['author']}"/>
                                </div>
                                <if condition="$categories">
                                    <div class="form-group">
                                        <label class="col-sm-1"><label for="text_cat">分类</label></label>
                                        <select name="cat_id">
                                            <volist name="categories" id="cat">
                                                <if condition="$cat['id'] eq $data['cat_id']">
                                                    <option value="{pigcms{$cat.id}" selected>{pigcms{$cat.name}
                                                    </option>
                                                    <else/>
                                                    <option value="{pigcms{$cat.id}">{pigcms{$cat.name}</option>
                                                </if>
                                            </volist>
                                        </select>
                                    </div>
                                </if>

                                <div class="form-group">
                                    <label class="col-sm-1">封面图</label>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success"
                                       id="J_selectImage">上传图片</a>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1">封面图预览</label>
                                    <input type="hidden" name="cover_pic" id="cover_pic"
                                           value="{pigcms{$data['cover_pic']}"/>
                                    <div id="upload_pic_box">
                                        <ul id="upload_pic_ul">
                                            <if condition="$data['cover_pic']">
                                                <li class="upload_pic_li">
                                                    <img src="{pigcms{$data['cover_pic']}"/><br/>
                                                    <a href="#"
                                                       onclick="deleteImage('{pigcms{$data['cover_pic']}',this);return false;">[
                                                        删除 ]</a>
                                                </li>
                                            </if>
                                        </ul>
                                        <if condition="$data['cover_pic']">
                                            <label>
                                                <input name="is_show" value="1" type="checkbox" class="ace"
                                                <if condition="$data['is_show']">checked</if>
                                                >
                                                <span class="lbl" style="z-index: 1">封面图片显示在正文中</span>
                                            </label>
                                        </if>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1"><label for="info">摘要</label></label>
                                    <textarea class="col-sm-3" id="digest" name="digest" style="height:125px">{pigcms{$data['digest']}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1"><label for="sort"><span class="required" style="color:red;">*</span>内容</label></label>
                                    <textarea class="col-sm-3" id="content" name="content"
                                              style="width: 680px; height: 400px; display: none;">{pigcms{$data['content']}</textarea>
                                </div>

                                <!--<div class="form-group">
                                    <label class="col-sm-1"><label for="sort">外链</label></label>
                                    <input class="col-sm-3" name="url" id="url" type="text" value="{pigcms{$data['url']}"/>　
                                    <a href="#modal-table" class="btn btn-sm btn-success" onclick="addLink('url',0)" data-toggle="modal">从功能库选择</a>
                                </div>-->


                                <!--<div class="form-group">
                                    <label class="col-sm-1"><label for="sort">所属类别</label></label>
                                    <input class="col-sm-1" name="classname" id="classname" type="text" value="{pigcms{$data['classname']}"/>　
                                    <input class="col-sm-1" name="classid" id="classid" type="hidden" value="{pigcms{$data['classid']}"/>
                                    <a href="javascript:void(0);" onclick="editClass('classid','classname',0)" class="btn btn-sm btn-success">选择所属分类</a>　
                                </div>-->

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
<style>
    input.ke-input-text {
        background-color: #FFFFFF;
        background-color: #FFFFFF !important;
        font-family: "sans serif", tahoma, verdana, helvetica;
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

    .form-group > label {
        font-size: 12px;
        line-height: 24px;
    }

    #upload_pic_box {
        margin-top: 20px;
        height: 60px;
    }

    #upload_pic_box .upload_pic_li {
        width: 130px;
        float: left;
        list-style: none;
    }

    #upload_pic_box img {
        width: 100px;
        height: 70px;
    }

    .small_btn {
        margin-left: 10px;
        padding: 6px 8px;
        cursor: pointer;
        display: inline-block;
        text-align: center;
        line-height: 1;
        letter-spacing: 2px;
        /* font-family: Tahoma, Arial/9 !important;*/
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

    .small_btn:active {
        border-color: #1c6a9e;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#33bbee', endColorstr='#2288cc');
        background: linear-gradient(top, #33bbee, #2288cc);
        background: -moz-linear-gradient(top, #33bbee, #2288cc);
        background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#33bbee), to(#2288cc));
    }
</style>
<link rel="stylesheet" href="{pigcms{$static_public}kindeditor2/themes/default/default.css">
<script src="{pigcms{$static_public}kindeditor2/kindeditor-all-min.js"></script>
<script src="{pigcms{$static_public}kindeditor2/lang/zh-CN.js"></script>
<script type="text/javascript" src="./static/js/artdialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./static/js/artdialog/iframeTools.js"></script>
<script type="text/javascript" src="./static/js/upyun.js"></script>

<script type="text/javascript">
    var diyTool = "{pigcms{:U('Article/diytool')}";


    KindEditor.ready(function (K) {

        editor = K.create('#content', {
            cssData: 'body {font-family: "微软雅黑"; font-size: 16px; color: #666666; }',
            resizeType: 1,
            allowPreviewEmoticons: false,
            allowImageUpload: true,
            uploadJson: '/merchant.php?g=Merchant&c=Upyun&a=kindedtiropic',
            items: ['source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
                'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
                'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
                'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
                'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
                'anchor', 'link', 'unlink'
            ]
        });

        K('#J_selectImage').click(function () {
            if ($('.upload_pic_li').size() >= 10) {
                alert('最多上传10个图片！');
                return false;
            }
            /*    editor.uploadJson = "222{pigcms{:U('Config/ajax_upload_pic')}";*/
            editor.loadPlugin('image', function () {
                editor.plugin.imageDialog({
                    showRemote: false,
                    imageUrl: K('#course_pic').val(),
                    clickFn: function (url, title, width, height, border, align) {
                        $('#upload_pic_ul').html('<li class="upload_pic_li"><img src="' + url + '"/><br/><a href="#" onclick="deleteImage(\'' + title + '\',this);return false;">[ 删除 ]</a></li>');
// 					$('#show_cover_pic').attr('src', url);
                        $('#upload_pic_box').find('label').remove();
                        $('#upload_pic_box').append('<label><input name="is_show" value="1" type="checkbox" class="ace"><span class="lbl" style="z-index: 1">封面图片显示在正文中</span></label>');
                        $('#cover_pic').val(url);
                        $('input[name="cover_pic"]').val(url);
                        editor.hideDialog();
                    }
                });
            });
        });


        K('#J_selectVideo').click(function () {
            if ($('.upload_video_li').size() >= 1) {
                alert('最多上传1个图片！');
                return false;
            }

            editor.loadPlugin('media', function () {
                editor.plugin.fileDialog({
                    showRemote: false,
                    imageUrl: K('#video_url').val(),
                    clickFn: function (url, title, width, height, border, align) {

                        $('#upload_video_ul').html('<li class="upload_pic_li"><audio  controls> <source src="' + url + '"  type="audio/mp3"> 您的浏览器不支持Video标签。 </audio><br/><a href="#" onclick="deleteImage(\'' + title + '\',this);return false;">[ 删除 ]</a></li>');
                        $('#video_url').val(url);
                        $('input[name="video_url"]').val(url);
                        editor.hideDialog();
                    }
                });
            });
        });


    });


    function deleteImage(path, obj) {
        $.post("{pigcms{:U('Config/ajax_del_pic')}", {path: path});
        $(obj).closest('.upload_pic_li').remove();
        $('#upload_pic_box').find('label').remove();
    }
</script>

<style>
    .paixu2 {
        position: fixed;
        width: 650px;
        top: 0;
        z-index: 10000;
    }
</style>
<script>
    $(window).bind("scroll",
        function () {
            var st = $(document).scrollTop();//往下滚的高度
            if (st > 600) {
                $('.ke-toolbar').addClass('paixu2')
            } else {
                $('.ke-toolbar').attr("class", "ke-toolbar");
            }
        });
</script>

<include file="Public:footer"/>