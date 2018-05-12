<!--/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/1/19
 * Time: 13:55
 */-->
<include file="Public:header"/>
<script type="text/javascript" src="{pigcms{$static_path}js/uploadify/jquery.uploadify.min.js?210" charset="utf-8"></script>
<link href="{pigcms{$static_path}css/uploadify/uploadify.css" rel="stylesheet"/>

<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
                <a href="{pigcms{:U('App/index')}">版本列表</a>
        </ul>
    </div>
        <form id="myform" method="post" action="{pigcms{:U('App/add')}" frame="true" refresh="true">
            <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
                <tr>
                    <th width="80">名称</th>
                    <td><input type="text" class="input fl" id="name" name="name" size="25" placeholder="名称" validate="maxlength:20,required:true" tips="版本名称！"/></td>
                </tr>
                <tr>
                    <th width="80">版本号</th>
                    <td><input type="text"  check_width="180" class="input fl" name="version_no" size="25" placeholder="版本号" validate="required:true,minlength:1" tips="版本号，必填"/></td>
                </tr>
                <tr>
                    <th width="80">版本说明</th>
                    <td><textarea type="text" style="width:200px;height:150px;" name="version_detail"></textarea></td>
                </tr>
                <tr>
                    <th width="80">文件上传</th>
                    <td><input type="file" class="input fl" id="file_upload" size="25" placeholder="文件" validate="maxlength:20,required:true"/></td>
                </tr>
            </table>
            <input id='has_file' type='hidden' name='file_id' value="">
            <div class="btn">
                <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
                <input type="reset" value="取消" class="button" onclick="history.back(-1);"/>
            </div>
        </form>
    <script>
        $(function() {
            $("#file_upload").uploadify({
                height        : 30,
                swf           : '{pigcms{$static_path}css/uploadify/uploadify.swf',
                fileObjName   : "download",
                'multi'    : false,
                uploader      : '{pigcms{:U("File/upload")}',
                width         : 120,
                "onUploadSuccess" : uploadFilefile_id,
            });
            function uploadFilefile_id(file, data){
                var data = $.parseJSON(data);
                var returnFile= $.parseJSON(data.data);
                if(data.status){
                   $("#has_file").val(returnFile.id);
                    $("#name").val(file.name);
                } else {
                   alert("上传失败！");
                }
            }
        });
    </script>
</div>
<include file="Public:footer"/>