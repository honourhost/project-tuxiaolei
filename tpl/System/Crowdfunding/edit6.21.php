<include file="Public:crowdheader"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-gear gear-icon"></i>
                <a href="{pigcms{:U('Crowdfunding/index')}">众筹管理</a>
            </li>
            <li class="active">添加众筹</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <div class="page-content-area">
            <style>
                .ace-file-input a {
                    display: none;
                }

                #levelcoupon select {
                    width: 150px;
                    margin-right: 20px;
                }
            </style>
            <div class="row">
                <div class="col-xs-12">
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a data-toggle="tab" href="#basicinfo">基本信息</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#txtintro">众筹详情</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#txtimage">众筹图片</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#crowdlevel">众筹档次</a>
                            </li>
                        </ul>
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" method="post" id="add_form">
                        <div class="tab-content">
                            <div id="basicinfo" class="tab-pane active">
                                <div class="form-group">
                                    <label class="col-sm-1">相关特卖id：</label>
                                    <input class="col-sm-3" maxlength="100" type="number"
                                           value=""/><span class="form_tips">选填，填写要自动抽取内容的特卖id</span><a
                                        href="javascript:;" id="get_group_content">获取内容</a>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">众筹标题：</label>
                                    <input class="col-sm-3" maxlength="100" name="title" type="text"
                                           value="{pigcms{$now_group.title}"/><span
                                        class="form_tips">众筹的名称，100字段以内。</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">众筹描述：</label>
                                    <textarea class="col-sm-3" rows="5"
                                              name="digest">{pigcms{$now_group.digest}</textarea><span
                                        class="form_tips">众筹的简短介绍，建议为100字以下。</span>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1">目标筹款（元）：</label>
                                    <input class="col-sm-3" maxlength="100" type="number" name="funds"
                                           value="{pigcms{$now_group.funds}"/><span class="form_tips">填写目标筹款金额</span>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-1">众筹开始时间：</label>
                                    <input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;"
                                           onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'{pigcms{:date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])}',vel:'begin_time'})"
                                           value="{pigcms{:date('Y年m月d日 H时i分s秒',$now_group['starttime'])}"/>
                                    <input name="starttime" id="begin_time" type="hidden"
                                           value="{pigcms{:date('Y-m-d H:i:s',$now_group['starttime'])}"/>
                                    <span class="form_tips">到了众筹开始时间，商品才会显示！</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">众筹结束时间：</label>
                                    <input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;"
                                           onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'{pigcms{:date('Y-m-d H:i:s',strtotime('+1 day'))}',vel:'end_time'})"
                                           value="{pigcms{:date('Y年m月d日 H时i分s秒',$now_group['endtime'])}"/>
                                    <input name="endtime" id="end_time" type="hidden"
                                           value="{pigcms{:date('Y-m-d H:i:s',$now_group['endtime'])}"/>
                                    <span class="form_tips">超过众筹结束时间，会结束众筹！</span>
                                </div>


                            </div>
                            <div id="txtintro" class="tab-pane">


                                <div class="form-group">
                                    <label class="col-sm-1">众筹详情：<br/><span style="font-size:12px;color:#999;">必填</span></label>
                                    <textarea name="content" id="content" style="width:702px;">{pigcms{$now_group.content}</textarea>
                                </div>
                            </div>
                            <div id="txtimage" class="tab-pane">
                                <div class="form-group">
                                    <label class="col-sm-1">上传图片</label>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success"
                                       id="J_selectImage">上传图片</a>
                                    <span class="form_tips">第一张将作为列表页图片展示！最多上传5个图片！<php>if(!empty($config['group_pic_width'])){$group_pic_width=explode(',',$config['group_pic_width']);echo '图片宽度建议为：'.$group_pic_width[0].'px，';}</php><php>if(!empty($config['group_pic_height'])){$group_pic_height=explode(',',$config['group_pic_height']);echo '高度建议为：'.$group_pic_height[0].'px';}</php></span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">图片预览</label>
                                    <div id="upload_pic_box">
                                        <ul id="upload_pic_ul">
                                            <li class="upload_pic_li"><img
                                                    src="{pigcms{$now_group.webpic}">
                                                <input type="hidden" name="webpic" value="{pigcms{$now_group.webpic}">
                                                <br>
                                                <a href="#" onclick="deleteImage('{pigcms{$now_group.webpic}',this);return false;">
                                                    [删除]</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="crowdlevel" class="tab-pane">

                                <volist name="crowdgrades" id="crow" key="k" >
                                    <div id="div<?php echo $k;?>">
                                        <div class="form-group">
                                            <label class="col-sm-1">标题：</label>
                                            <input class="col-sm-3" maxlength="100" name="grade<?php echo $k;?>[]" type="text" id="grade<?php echo $k;?>"
                                                   value="{pigcms{$crow.title}"/><span class="form_tips">众筹档次标题。</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-1">描述：</label>
                                            <textarea class="col-sm-3" maxlength="100" name="grade<?php echo $k;?>[]" type="text" id="grade<?php echo $k;?>"
                                            >{pigcms{$crow.digest}</textarea><span
                                                class="form_tips">众筹档次描述。</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-1">价格：</label>
                                            <input class="col-sm-3" maxlength="100" name="grade<?php echo $k;?>[]" type="text"
                                                   id="grade1" value="{pigcms{$crow.price}"/><span
                                                class="form_tips">档次价格。</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-1">众筹最多人数目：</label>
                                            <input class="col-sm-3" maxlength="100" name="grade<?php echo $k;?>[]" type="number"
                                                   id="grade1" value="{pigcms{$crow.limitnum}"/><span
                                                class="form_tips">大于0的整数。</span>
                                        </div>

                                    </div>
                                </volist>
                                <input type="hidden" name="gradeindex" id="gradeindex" value="<?php echo count($crowdgrades);?>">
                                <input type="hidden" name="crowd_id" id="crowdid" value="<?php echo $now_group['crowd_id'];?>">





                            </div>

                            <div class="form-group" style="margin-bottom:0px;margin-top:20px;"><label
                                    class="col-sm-1"></label>
                                <a href="javascript:;" id="insert_crowd_grade">插入众筹档次</a></div>
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-info" type="submit" id="save_btn">
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
        height: 150px;
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
</style>
<script type="text/javascript" src="{pigcms{$static_public}js/date/WdatePicker.js"></script>
<!--<script src="{pigcms{$static_public}kindeditor/kindeditor.js"></script>-->
<script src="{pigcms{$static_public}kindeditor2/kindeditor-all-min.js"></script>
<script src="{pigcms{$static_public}kindeditor2/lang/zh-CN.js"></script>
<script type="text/javascript">
    KindEditor.ready(function (K) {
        var content_editor = K.create("#content", {
            resizeType: 1,
            allowPreviewEmoticons: false,
            allowImageUpload: true,


            afterCreate: function () {
                this.loadPlugin('autoheight');
            },
            items: [
                'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
                'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
                'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
                'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
                'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
                'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
                'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
                'anchor', 'link', 'unlink', '|', 'about'

            ],
            emoticonsPath: './static/emoticons/',
            uploadJson: "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_upload&upload_dir=group/content",
            cssPath: "/tpl/Merchant/static/css/group_editor.css"
        });

        var editor = K.editor({
            allowFileManager: true
        });
        K('#J_selectImage').click(function () {
            if ($('.upload_pic_li').size() >= 5) {
                alert('最多上传5个图片！');
                return false;
            }
            editor.uploadJson = "{pigcms{:U('Group/ajax_upload_pic')}";
            editor.loadPlugin('image', function () {
                editor.plugin.imageDialog({
                    showRemote: false,
                    imageUrl: K('#course_pic').val(),
                    clickFn: function (url, title, width, height, border, align) {
                        $('#upload_pic_ul').append('<li class="upload_pic_li"><img src="' + url + '"/><input type="hidden" name="webpic" value="' + title + '"/><br/><a href="#" onclick="deleteImage(\'' + title + '\',this);return false;">[ 删除 ]</a></li>');
                        editor.hideDialog();
                    }
                });
            });
        });


        $('#add_form').submit(function () {
            content_editor.sync();
            $('#save_btn').prop('disabled', true);
            $.post("{pigcms{:U('Crowdfunding/editaction')}", $('#add_form').serialize(), function (result) {
                if (result.status == 1) {
                    alert(result.info);
                    window.location.href = "{pigcms{:U('Crowdfunding/index')}";
                } else {
                    alert(result.info);
                }
                $('#save_btn').prop('disabled', false);
            })
            return false;
        });
        $("#insert_crowd_grade").click(function () {
            var crindex = $("#gradeindex").val();
            var newindex = parseInt(crindex) + 1;
            $("#crowdlevel").append(
                " <div id=\"div" + newindex + "\"> " +
                "<div class=\"form-group\"> " +
                "<label class=\"col-sm-1\">标题：</label> " +
                "<input class=\"col-sm-3\" maxlength=\"100\" name=\"grade" + newindex + "[]\" type=\"text\" id=\"grade" + newindex + "\" />" +
                "<span class=\"form_tips\">众筹档次标题。</span> " +
                "</div> " +
                "<div class=\"form-group\"> " +
                "<label class=\"col-sm-1\">描述：</label> " +
                "<textarea class=\"col-sm-3\" maxlength=\"100\" name=\"grade" + newindex + "[]\" type=\"text\" id=\"grade" + newindex + "\" />" +
                "<span class=\"form_tips\">众筹档次描述。</span> </div> <div class=\"form-group\"> <label class=\"col-sm-1\">价格：</label> " +
                "<input class=\"col-sm-3\" maxlength=\"100\" name=\"grade" + newindex + "[]\" type=\"text\" id=\"grade" + newindex + "\" /><spanclass=\"form_tips\">档次价格。</span> </div> " +
                "<div class=\"form-group\"> <label class=\"col-sm-1\">众筹最多人数目：</label> <input class=\"col-sm-3\" maxlength=\"100\" name=\"grade" + newindex + "[]\" type=\"number\" id=\"grade" + newindex + "\" /><span class=\"form_tips\">大于0的整数。</span> </div> </div>"
            );
            $("#gradeindex").val(newindex);


        });
    });
    function deleteImage(path, obj) {
        $.post("{pigcms{:U('Group/ajax_del_pic')}", {path: path});
        $(obj).closest('.upload_pic_li').remove();
    }
</script>
<include file="Public:footer"/>