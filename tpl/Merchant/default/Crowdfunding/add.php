<include file="Public:header"/>
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
                                    <label class="col-sm-1">发起人姓名：</label>
                                    <input class="col-sm-3" maxlength="100" name="invator" type="text"
                                           /><span
                                            class="form_tips">发起人姓名。</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">众筹标题：</label>
                                    <input class="col-sm-3" maxlength="100" name="title" type="text" value=""/><span
                                            class="form_tips">众筹的名称，7-30个汉字以内。</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">众筹类别：</label>
                                    <select class="col-sm-3"  name="crowdcat" type="text" >
                                        <option value="3">
                                            其他
                                        </option>
                                        <option value="0">
                                            美食
                                        </option>
                                        <option value="1">
                                            农业
                                        </option>
                                        <option value="2">
                                            民宿
                                        </option>
                                    </select>
                                    <span class="form_tips">众筹类别。</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">一句话描述：</label>
                                    <textarea class="col-sm-3" rows="5" name="digest"></textarea><span
                                            class="form_tips">众筹的简短介绍，建议为100字以下。</span>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1">目标筹款（元）：</label>
                                    <input class="col-sm-3" maxlength="100" type="number" name="funds"
                                           /><span class="form_tips">填写目标筹款金额</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">地区：</label>
                                    <input class="col-sm-3" maxlength="100" type="text" name="crowdplace"
                                    /><span class="form_tips">填写目标筹款地区</span>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-1">众筹开始时间：</label>
                                    <input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;"
                                           onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'{pigcms{:date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])}',vel:'begin_time'})"
                                           value="{pigcms{:date('Y年m月d日 H时i分s秒',$_SERVER['REQUEST_TIME'])}"/>
                                    <input name="starttime" id="begin_time" type="hidden"
                                           value="{pigcms{:date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])}"/>
                                    <span class="form_tips">到了众筹开始时间，商品才会显示！</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">众筹结束时间：</label>
                                    <input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;"
                                           onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'{pigcms{:date('Y-m-d H:i:s',strtotime('+1 day'))}',vel:'end_time'})"
                                           value="{pigcms{:date('Y年m月d日 H时i分s秒',strtotime('+1 day'))}"/>
                                    <input name="endtime" id="end_time" type="hidden"
                                           value="{pigcms{:date('Y-m-d H:i:s',strtotime('+1 day'))}"/>
                                    <span class="form_tips">超过众筹结束时间，会结束众筹！</span>
                                </div>


                            </div>
                            <div id="txtintro" class="tab-pane">


                                <div class="form-group">
                                    <label class="col-sm-1">众筹详情：<br/><span style="font-size:12px;color:#999;">必填</span></label>
                                    <textarea name="content" id="content" style="width:702px;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">相关特卖id：</label>
                                    <input class="col-sm-3" maxlength="100" type="number"
                                           value=""/><span class="form_tips">选填，填写要自动抽取内容的特卖id</span><a
                                            href="javascript:;" id="get_group_content">获取内容</a>
                                </div>
                            </div>
                            <div id="txtimage" class="tab-pane">
                                <div class="form-group">
                                    <label class="col-sm-1">上传图片</label>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success"
                                       id="J_selectImage">上传图片</a>
                                    <span class="form_tips">第一张将作为封面图展示！最多上传5张图片！尺寸要求：宽度：650像素，高度：350像素</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">图片预览</label>
                                    <div id="upload_pic_box">
                                        <ul id="upload_pic_ul"></ul>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1">上传视频</label>
                                    <input type="text" id="url" value="" name="videourl" /> <input type="button" id="insertfile" value="选择文件" />
                                    <span class="form_tips">视频请保持20M以内！</span>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1">上传视频封面图片</label>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success"
                                       id="J_selectvideoImage">上传视频封面图片</a>
                                    <span class="form_tips"></span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">图片预览</label>
                                    <div id="upload_pic_box">
                                        <ul id="upload_pic_ulv"></ul>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1">上传发起人头像图片</label>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success"
                                       id="J_selectinvatorImage">上传发起人头像图片</a>
                                    <span class="form_tips"></span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">图片预览</label>
                                    <div id="upload_pic_box">
                                        <ul id="upload_pic_uli">


                                        </ul>
                                    </div>
                            </div>
                            </div>
                            <div id="crowdlevel" class="tab-pane">
                                <div id="div1">
                                    <div class="form-group">
                                        <label class="col-sm-1">标题：</label>
                                        <input class="col-sm-3" maxlength="100" name="grade1[]" type="text" id="grade1"
                                               value=""/><span class="form_tips">众筹档次标题。</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1">描述：</label>
                                        <textarea class="col-sm-3"  name="grade1[]" type="text" id="grade1" rows="5"></textarea>
                                        <span class="form_tips">众筹档次描述。</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1">价格：</label>
                                        <input class="col-sm-3" maxlength="100" name="grade1[]" type="text"
                                               id="grade1" value=""/><span
                                                class="form_tips">档次价格。</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1">众筹最多人数目：</label>
                                        <input class="col-sm-3" maxlength="100" name="grade1[]" type="number"
                                               id="grade1" value=""/><span
                                                class="form_tips">大于0的整数</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1">是否抽奖：</label>
                                        <select class="col-sm-3"  name="grade1[]" type="text" id="grade1" rows="5">
                                            <option value="1">
                                                否
                                            </option>
                                            <option value="2">
                                                是
                                            </option>
                                        </select>
                                        <span class="form_tips">是否是抽奖众筹。</span>
                                    </div>
                                    <input class="col-sm-3" maxlength="100" name="grade1[]" type="hidden"
                                           id="grade1" value="0"/>
                                    <div class="form-group">
                                        <label class="col-sm-1">众筹多少人开一次奖：</label>
                                        <input class="col-sm-3" maxlength="100" name="grade1[]" type="number"
                                               id="grade1" value="20"/><span
                                                class="form_tips">非抽奖众筹可以不填写</span>
                                    </div>


                                </div>


                                <input type="hidden" name="gradeindex" id="gradeindex" value="1">
                            </div>

                            <div class="form-group" style="margin-bottom:0px;margin-top:20px;"><label class="col-sm-1">&nbsp;</label><a
                                        href="javascript:;" id="insert_crowd_grade">插入众筹档次</a></div>
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
            cssPath: "{pigcms{$static_path}css/group_editor.css"
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

        K('#insertfile').click(function() {
            editor.uploadJson = "{pigcms{$config.site_url}/index.php?g=Index&c=Upload&a=editor_ajax_uploadfile&upload_dir=group/content";
            editor.loadPlugin('insertfile', function() {
                editor.plugin.fileDialog({
                    fileUrl : K('#url').val(),
                    clickFn : function(url, title) {
                        K('#url').val(url);
                        editor.hideDialog();
                    }
                });
            });
        });

        K('#J_selectvideoImage').click(function () {
            if ($('.upload_pic_liv').size() >= 5) {
                alert('最多上传5个图片！');
                return false;
            }
            editor.uploadJson = "{pigcms{:U('Group/ajax_upload_pic')}";
            editor.loadPlugin('image', function () {
                editor.plugin.imageDialog({
                    showRemote: false,
                    imageUrl: K('#course_pic').val(),
                    clickFn: function (url, title, width, height, border, align) {
                        $('#upload_pic_ulv').append('<li class="upload_pic_liv"><img src="' + url + '"/><input type="hidden" name="videopic" value="' + title + '"/><br/><a href="#" onclick="deletevideoImage(\'' + title + '\',this);return false;">[ 删除 ]</a></li>');
                        editor.hideDialog();
                    }
                });
            });
        });

        K('#J_selectinvatorImage').click(function () {
            if ($('.upload_pic_lii').size() >= 5) {
                alert('最多上传5个图片！');
                return false;
            }
            editor.uploadJson = "{pigcms{:U('Group/ajax_upload_pic')}";
            editor.loadPlugin('image', function () {
                editor.plugin.imageDialog({
                    showRemote: false,
                    imageUrl: K('#course_pic').val(),
                    clickFn: function (url, title, width, height, border, align) {
                        $('#upload_pic_uli').append('<li class="upload_pic_lii"><img src="' + url + '"/><input type="hidden" name="invatorpic" value="' + title + '"/><br/><a href="#" onclick="deleteinvatorImage(\'' + title + '\',this);return false;">[ 删除 ]</a></li>');
                        editor.hideDialog();
                    }
                });
            });
        });


        $('#add_form').submit(function () {
            content_editor.sync();
            $('#save_btn').prop('disabled', true);
            $.post("{pigcms{:U('Crowdfunding/addaction')}", $('#add_form').serialize(), function (result) {
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
             " <div id=\"div"+newindex+"\"> " +
             "<div class=\"form-group\"> " +
             "<label class=\"col-sm-1\">标题：</label> " +
             "<input class=\"col-sm-3\" maxlength=\"100\" name=\"grade"+newindex+"[]\" type=\"text\" id=\"grade"+newindex+"\" />" +
             "<span class=\"form_tips\">众筹档次标题。</span> " +
             "</div> " +
             "<div class=\"form-group\"> " +
             "<label class=\"col-sm-1\">描述：</label> " +
             "<textarea class=\"col-sm-3\" maxlength=\"100\" name=\"grade"+newindex+"[]\" type=\"text\" id=\"grade"+newindex+"\" />" +
             "<span class=\"form_tips\">众筹档次描述。</span> </div> <div class=\"form-group\"> <label class=\"col-sm-1\">价格：</label> " +
             "<input class=\"col-sm-3\" maxlength=\"100\" name=\"grade"+newindex+"[]\" type=\"text\" id=\"grade"+newindex+"\" /><spanclass=\"form_tips\">档次价格。</span> </div> " +
             "<div class=\"form-group\"> <label class=\"col-sm-1\">众筹最多人数目：</label> <input class=\"col-sm-3\" maxlength=\"100\" name=\"grade"+newindex+"[]\" type=\"number\" id=\"grade"+newindex+"\" /><span class=\"form_tips\">大于0的整数。</span> </div>" +
            " <div class=\"form-group\"> <label class=\"col-sm-1\">是否抽奖：</label> <select class=\"col-sm-3\"  name=\"grade"+newindex+"[]\" type=\"text\" id=\"grade"+newindex+"\" > <option value=\"1\">否 </option> <option value=\"2\">是 </option> </select> <span class=\"form_tips\">是否是抽奖众筹。</span></div>"
               +"     <input class=\"col-sm-3\" maxlength=\"100\" name=\"grade"+newindex+"[]\" type=\"hidden\" id=\"grade"+newindex+"\" value=\"0\"/>"+
                 " <div class=\"form-group\"> <label class=\"col-sm-1\">众筹多少人开一次奖：</label> <input class=\"col-sm-3\" maxlength=\"100\" name=\"grade"+newindex+"[]\" type=\"number\" id=\"grade"+newindex+"\" value=\"20\"/><spanclass=\"form_tips\">非抽奖众筹可以不填写</span> </div>"
                 +
             " </div>"
            );
            $("#gradeindex").val(newindex);


        });

        $('#editor_plan_btn').click(function () {
            var dialog = K.dialog({
                width: 200,
                title: '输入欲插入表格行数',
                body: '<div style="margin:10px;"><input id="edit_plan_input" style="width:100%;"/></div>',
                closeBtn: {
                    name: '关闭',
                    click: function (e) {
                        dialog.remove();
                    }
                },
                yesBtn: {
                    name: '确定',
                    click: function (e) {
                        var value = $('#edit_plan_input').val();
                        if (!/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value)) {
                            alert('请输入数字！');
                            return false;
                        }
                        value = parseInt(value);
                        var html = '<table class="deal-menu">';
                        html += '<tr><th class="name" colspan="2">套餐内容</th><th class="price">单价</th><th class="amount">数量/规格</th><th class="subtotal">小计</th></tr>';
                        for (var i = 0; i < value; i++) {
                            html += '<tr><td class="name" colspan="2">内容' + (i + 1) + '</td><td class="price">¥</td><td class="amount">1份</td><td class="subtotal">¥</td></tr>';
                        }
                        html += '</table>';
                        html += '<p class="deal-menu-summary">价值: <span class="inline-block worth">¥</span>{pigcms{$config.group_alias_name}价： <span class="inline-block worth price">¥</span></p><br/><br/>介绍...';
                        content_editor.appendHtml(html);

                        dialog.remove();
                    }
                },
                noBtn: {
                    name: '取消',
                    click: function (e) {
                        dialog.remove();
                    }
                }
            });
        });

        $('#get_key_btn').click(function () {
            var s_name = $('input[name="s_name"]');
            s_name.val($.trim(s_name.val()));
            $('#keywords').val($.trim($('#keywords').val()));
            if (s_name.val().length == 0) {
                alert('请先填写商品名称！');
                s_name.focus();
            } else if ($('#keywords').val().length != 0) {
                alert('请先删除您填写的关键词！');
                $('#keywords').focus();
            } else {
                $.get("{pigcms{:U('Index/Scws/ajax_getKeywords')}", {title: s_name.val()}, function (result) {
                    result = $.parseJSON(result);
                    if (result.num == 0) {
                        alert('您的商品名称没有提取到关键词，请手动填写关键词！');
                        $('#keywords').focus();
                    } else {
                        $('#keywords').val(result.list.join(' ')).focus();
                    }
                });
            }
        });
    });
    function deleteImage(path, obj) {
        $.post("{pigcms{:U('Group/ajax_del_pic')}", {path: path});
        $(obj).closest('.upload_pic_li').remove();
    }
    function deletevideoImage(path, obj) {
        $.post("{pigcms{:U('Group/ajax_del_pic')}", {path: path});
        $(obj).closest('.upload_pic_liv').remove();
    }

    function deleteinvatorImage(path, obj) {
        $.post("{pigcms{:U('Group/ajax_del_pic')}", {path: path});
        $(obj).closest('.upload_pic_lii').remove();
    }
</script>
<include file="Public:footer"/>