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
            <a href="{pigcms{:U('Channel/personList',array('id'=>$c_id))}">频道股东列表</a>
        </ul>
    </div>
        <form id="myform" method="post" action="{pigcms{:U('Channel/addPerson')}" frame="true" refresh="true">
            <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
                <input type="hidden" name="c_id" value="{pigcms{$c_id}"/>
                <tr>
                    <th width="80">用户id</th>
                    <td><input type="text" class="input fl" id="user_id" name="user_id" size="25" placeholder="用户id" validate="maxlength:40,required:true" tips="用户id！，必填！"/></td>
                </tr>
                <tr>
                    <th width="80">用户频道提成百分比</th>
                    <td><input type="text" class="input fl" id="percent" name="percent" size="25" placeholder="用户频道提成百分比" validate="maxlength:3,required:true" tips="用户频道提成百分比！，必填！"/></td>
                </tr>
            </table>
            <div class="btn">
                <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
                <input type="reset" value="取消" class="button" onclick="history.back(-1);"/>
            </div>
        </form>
</div>
<include file="Public:footer"/>