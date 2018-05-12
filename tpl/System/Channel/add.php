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
                <a href="{pigcms{:U('Channel/index')}">频道列表</a>
        </ul>
    </div>
        <form id="myform" method="post" action="{pigcms{:U('Channel/add')}" enctype="multipart/form-data">
            <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
                <tr>
                    <th width="80">频道名称</th>
                    <td><input type="text" class="input fl" id="name" name="name" size="25" placeholder="频道名称" validate="maxlength:40,required:true" tips="频道名称！，必填！"/></td>
                </tr>
                <tr>
                    <th width="80">频道短url（如：gansu）</th>
                    <td><input type="text"  check_width="180" class="input fl" name="url" size="80" placeholder="频道短url" validate="required:true,minlength:1" tips="频道短url，必填！"/></td>
                </tr>
                <tr>
                    <th width="80">频道分享标题</th>
                    <td><input type="text"  check_width="180" class="input fl" id="share_title" name="share_title" size="100" placeholder="频道分享标题" validate="required:true,minlength:1" tips="频道分享标题，必填！"/></td>
                </tr>
                <tr>
                    <th width="80">频道分享描述</th>
                    <td><input type="text"  check_width="180" class="input fl" id="share_desc" name="share_desc" size="100" placeholder="频道分享描述" validate="required:true,minlength:1" tips="频道分享描述，必填！"/></td>
                </tr>
                <tr>
                    <th width="80">频道分享图片</th>
                    <td><input type="file"  check_width="180" class="input fl" id="share_pic" name="share_pic" size="100" placeholder="频道分享图片" validate="required:true,minlength:1" tips="频道分享图片，必填！"/></td>
                </tr>
            </table>
            <input id='has_file' type='hidden' name='file_id' value="">
            <div class="btn">
                <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
                <input type="reset" value="取消" class="button" onclick="history.back(-1);"/>
            </div>
        </form>
</div>
<include file="Public:footer"/>