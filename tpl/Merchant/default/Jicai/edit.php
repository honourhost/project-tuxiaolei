<include file="Public:header"/>
<div class="main-content">
    <!-- 内容头部 -->
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-gear gear-icon"></i>
                <a href="{pigcms{:U('Jicai/index')}">集采管理</a>
            </li>
            <li class="active">编辑商品</li>
        </ul>
    </div>
    <!-- 内容头部 -->
    <div class="page-content">
        <style>
            .aui_outer {
                background: #fafafa;
                width: 550px;
                height: 230px;
                overflow-y: scroll;
                position: relative;
                left: 200px;
                top: -90px;
            }

            .aui_content label {
                width: 25%;
                display: block;
                float: left;
            }

            .aui_title {
                display: inline-block;
                text-indent: 20px;
                padding-top: 20px;
            }
        </style>
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
                                <a data-toggle="tab" href="#txtstore">选择店铺</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#txtintro">集采详情</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#txtimage">商品图片</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#txtnum">数量设置</a>
                            </li>
                        </ul>
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" method="post" id="add_form">
                        <div class="tab-content">
                            <div id="basicinfo" class="tab-pane active">


                                <div class="form-group">
                                    <label class="col-sm-1">商品标题：</label>
                                    <input class="col-sm-3" maxlength="100" name="name" type="text"
                                           value="{pigcms{$now_group.name}"/><span class="form_tips">商品的介绍标题，100字段以内,首页和列表页将显示。</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">商品名称：</label>
                                    <input class="col-sm-3" maxlength="30" name="s_name" type="text"
                                           value="{pigcms{$now_group.s_name}"/><span
                                            class="form_tips">必填。在订单页显示此名称！</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">商品简介：</label>
                                    <textarea class="col-sm-3" rows="5"
                                              name="intro">{pigcms{$now_group.intro}</textarea><span class="form_tips">商品的简短介绍，建议为100字以下。</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">集采类型：</label>
                                    <select name="jicaitype" class="col-sm-1">
                                        <volist name="jicaicates" id="jicaicate">
                                            <?php if ($now_group['jicaitype'] == $jicaicate['sort_id']) { ?>
                                                <option value="{pigcms{$jicaicate.sort_id}" selected>
                                                    {pigcms{$jicaicate.sort_name}
                                                </option>
                                            <?php } else { ?>
                                                <option value="{pigcms{$jicaicate.sort_id}">
                                                    {pigcms{$jicaicate.sort_name}
                                                </option>
                                            <?php } ?>
                                        </volist>


                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1">是否推荐：</label>
                                    <select name="recommend" class="col-sm-1">
                                        <?php if ($now_group['recommend'] == 1) { ?>

                                            <option value="0">不推荐</option>
                                            <option value="1" selected>推荐</option>
                                        <?php } else { ?>

                                            <option value="0" selected>不推荐</option>
                                            <option value="1">推荐</option>
                                        <?php } ?>


                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">关键词：</label>
                                    <input class="col-sm-3" maxlength="30" name="keywords" type="text"
                                           value="{pigcms{$keywords}" id="keywords"/><span class="form_tips">选填。<font
                                                color="red">（用空格分隔不同的关键词，最多5个）</font>，用户在微信将按此值搜索！</span> <a
                                            href="javascript:;" id="get_key_btn">按商品名称获取</a>
                                </div>


                                <div class="form-group"></div>
                                <div class="form-group">
                                    <label class="col-sm-1">原价：</label>
                                    <input class="col-sm-1" maxlength="100" name="old_price" type="text"
                                           value="{pigcms{$now_group.old_price|floatval=###}"/><span class="form_tips">必填。最多支持1位小数</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">集采价：</label>
                                    <input class="col-sm-1" maxlength="30" name="price" type="text"
                                           value="{pigcms{$now_group.price|floatval=###}"/><span class="form_tips">必填。最多支持1位小数</span>
                                </div>


                                <div class="form-group"></div>
                                <div class="form-group">
                                    <label class="col-sm-1">集采开始时间：</label>
                                    <input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;"
                                           onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'{pigcms{:date('Y-m-d H:i:s',$now_group['begin_time'])}',vel:'begin_time'})"
                                           value="{pigcms{:date('Y年m月d日 H时i分s秒',$now_group['begin_time'])}"/>
                                    <input name="begin_time" id="begin_time" type="hidden"
                                           value="{pigcms{:date('Y-m-d H:i:s',$now_group['begin_time'])}"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">集采结束时间：</label>
                                    <input class="col-sm-2 Wdate" type="text" readonly="readonly" style="height:30px;"
                                           onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日 HH时mm分ss秒',startDate:'{pigcms{:date('Y-m-d H:i:s',$now_group['end_time'])}',vel:'end_time'})"
                                           value="{pigcms{:date('Y年m月d日 H时i分s秒',$now_group['end_time'])}"/>
                                    <input name="end_time" id="end_time" type="hidden"
                                           value="{pigcms{:date('Y-m-d H:i:s',$now_group['end_time'])}"/>
                                    <span class="form_tips">超过集采结束时间，会结束集采！</span>
                                </div>

                            </div>
                            <div id="txtstore" class="tab-pane">
                                <div class="form-group">

                                </div>
                            </div>
                            <div id="txtintro" class="tab-pane">
                                <div class="form-group">
                                    <label class="col-sm-1">集采类型：</label>
                                    <select name="tuan_type" class="col-sm-1">
                                        <option value="0"
                                        <if condition="$now_group['tuan_type'] eq 0">selected="selected"</if>
                                        >普通集采</option>

                                    </select>
                                </div>

                                <div class="form-group" style="margin-bottom:0px;margin-top:20px;"><label
                                            class="col-sm-1">&nbsp;</label></div>
                                <div class="form-group">
                                    <label class="col-sm-1">本单详情：<br/><span style="font-size:12px;color:#999;">必填</span></label>
                                    <textarea name="content" id="content" style="width:702px;">{pigcms{$now_group.content}</textarea>
                                </div>
                            </div>
                            <div id="txtimage" class="tab-pane">
                                <div class="form-group">
                                    <label class="col-sm-1">上传图片</label>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success"
                                       id="J_selectImage">上传图片</a>
                                    <span class="form_tips">第一张将作为列表页图片展示！最多上传5个图片！</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">图片预览</label>
                                    <div id="upload_pic_box">
                                        <ul id="upload_pic_ul">
                                            <volist name="now_group['pic_arr']" id="vo">
                                                <li class="upload_pic_li"><img src="{pigcms{$vo.url}"/><input
                                                            type="hidden" name="pic[]" value="{pigcms{$vo.title}"/><br/><a
                                                            href="#"
                                                            onclick="deleteImage('{pigcms{$vo.title}',this);return false;">[
                                                        删除 ]</a></li>
                                            </volist>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <div id="relpackages" class="tab-pane">
                                <div class="form-group">
                                </div>
                                <div class="form-group">

                                    <span class="form_tips"></span>
                                </div>
                            </div>
                            <div id="txtnum" class="tab-pane">
                                <div class="form-group" style="display:none;">
                                    <label class="col-sm-1">成功集采人数要求：</label>
                                    <input class="col-sm-1" maxlength="20" name="success_num" type="text"
                                           value="{pigcms{$now_group.success_num}"/><span class="form_tips">最少需要多少人购买才算{pigcms{$config.group_alias_name}成功。</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">虚拟已购买人数：</label>
                                    <input class="col-sm-1" maxlength="20" name="virtual_num" type="text"
                                           value="{pigcms{$now_group.virtual_num}"/><span class="form_tips">前台购买人数会显示[ 虚拟购买人数+真实购买人数 ]</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">商品总数量：</label>
                                    <input class="col-sm-1" maxlength="20" name="count_num" type="text"
                                           value="{pigcms{$now_group.count_num}"/><span class="form_tips">0表示不限制，否则产品会出现“已卖光”状态</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">ID最多购买数量：</label>
                                    <input class="col-sm-1" maxlength="20" name="once_max" type="text"
                                           value="{pigcms{$now_group.once_max}"/><span class="form_tips">一个ID最多购买数量，0表示不限制</span>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1">一次最少购买数量：</label>
                                    <input class="col-sm-1" maxlength="20" name="once_min" type="text"
                                           value="{pigcms{$now_group.once_min}"/><span
                                            class="form_tips">购买数量低于此设定的不允许参团</span>
                                </div>

                            </div>
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
<script src="http://www.17sucai.com/preview/8768/2014-04-14/Demo/js/jquery.artDialog.js"></script>
<script type="text/javascript">
    KindEditor.ready(function (K) {
        var content_editor = K.create("#content", {
            resizeType: 1,
            allowPreviewEmoticons: false,
            allowImageUpload: true,
            filterMode: true,
            afterCreate: function () {
                this.loadPlugin('autoheight');
            },
            items: ['source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
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
                        $('#upload_pic_ul').append('<li class="upload_pic_li"><img src="' + url + '"/><input type="hidden" name="pic[]" value="' + title + '"/><br/><a href="#" onclick="deleteImage(\'' + title + '\',this);return false;">[ 删除 ]</a></li>');
                        editor.hideDialog();
                    }
                });
            });
        });

        K('#J_selectappImage').click(function () {
            if ($('.upload_pic_liapp').size() >= 5) {
                alert('最多上传5个图片！');
                return false;
            }
            editor.uploadJson = "{pigcms{:U('Jicai/ajax_upload_pic')}";
            editor.loadPlugin('image', function () {
                editor.plugin.imageDialog({
                    showRemote: false,
                    imageUrl: K('#course_pic').val(),
                    clickFn: function (url, title, width, height, border, align) {
                        $('#upload_pic_ulapp').append('<li class="upload_pic_liapp"><img src="' + url + '"/><input type="hidden" name="picapp[]" value="' + title + '"/><br/><a href="#" onclick="deleteappImage(\'' + title + '\',this);return false;">[ 删除 ]</a></li>');
                        editor.hideDialog();
                    }
                });
            });
        });


        $('#add_form').submit(function () {
            content_editor.sync();
            $('#save_btn').prop('disabled', true);
            $.post("{pigcms{:U('Jicai/edit',array('group_id'=>$now_group['group_id']))}", $('#add_form').serialize(), function (result) {
                if (result.status == 1) {
                    alert(result.info);
                    window.location.href = "{pigcms{:U('Jicai/index')}";
                } else {
                    alert(result.info);
                }
                $('#save_btn').prop('disabled', false);
            })
            return false;
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
    function deleteappImage(path, obj) {
        $.post("{pigcms{:U('Group/ajax_del_pic')}", {path: path});
        $(obj).closest('.upload_pic_liapp').remove();
    }

</script>


<include file="Public:footer"/>