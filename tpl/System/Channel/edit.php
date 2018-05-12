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
        <form id="myform" method="post" action="{pigcms{:U('Channel/edit')}" enctype="multipart/form-data">
            <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
                <input type="hidden" name="id" value="{pigcms{$channel.id}">
                <tr>
                    <th width="80">频道名称</th>
                    <td><input type="text" class="input fl" id="name" name="name" size="25" placeholder="频道名称" validate="maxlength:40,required:true" tips="频道名称！，必填！" value="{pigcms{$channel.name}"/></td>
                </tr>
                <tr>
                    <th width="80">频道url</th>
                    <td><input type="text"  check_width="180" class="input fl" name="url" size="80" placeholder="频道url" validate="required:true,minlength:1" tips="频道url，必填！" value="{pigcms{$channel.url}"/><a href="{pigcms{$config.site_url}/wap.php?g=Wap&c=Topic&a=index&topic={pigcms{$channel.url}" target="blank;">点击预览</a></td>
                </tr>
                <tr>
                    <th width="80">频道分享标题</th>
                    <td><input type="text"  check_width="180" class="input fl" id="share_title" name="share_title" size="100" placeholder="频道分享标题" value="{pigcms{$channel.share_title}" validate="required:true,minlength:1" tips="频道分享标题，必填！"/></td>
                </tr>
                <tr>
                    <th width="80">频道分享描述</th>
                    <td><input type="text"  check_width="180" class="input fl" id="share_desc" name="share_desc" size="100" placeholder="频道分享描述" value="{pigcms{$channel.share_desc}" validate="required:true,minlength:1" tips="频道分享描述，必填！"/></td>
                </tr>
                <if condition="$channel['share_pic']">
                <tr>
                    <th width="80">现图</th>
                    <td><img src="{pigcms{$config.site_url}/upload/channelshare/{pigcms{$channel.share_pic}" style="width:80px;height:80px;" class="view_msg"/></td>
                </tr>
                </if>
                <tr>
                    <th width="80">频道分享图片</th>
                    <td><input type="file"  check_width="180" class="input fl" id="share_pic" name="share_pic" size="100" placeholder="频道分享图片" validate="minlength:1" tips="不修改请不上传！上传新图片，老图片会被自动删除！"/></td>
                </tr>
				<tr>
				<th width="80">模板文件</th>
				<td>
				<select name="templatename">
				<option value="index">模板一</option>
				<option value="index2">模板二</option>
                    <option value="index3">模板三</option>
				</select>
				</td>
				</tr>
            </table>
            <div class="btn">
                <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
                <input type="reset" value="取消" class="button" onclick="history.back(-1);"/>
            </div>
        </form>
</div>
<include file="Public:footer"/>