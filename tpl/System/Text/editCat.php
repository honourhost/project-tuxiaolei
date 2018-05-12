<!--/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/3/29
 * Time: 13:55
 */-->
<include file="Public:header"/>
<script type="text/javascript" src="{pigcms{$static_path}js/uploadify/jquery.uploadify.min.js?210" charset="utf-8"></script>
<link href="{pigcms{$static_path}css/uploadify/uploadify.css" rel="stylesheet"/>

<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Text/index')}">图文分类列表</a>
        </ul>
    </div>
    <form id="myform" method="post" action="{pigcms{:U('Text/editCat')}" frame="true" refresh="true">
        <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
            <input type="hidden" name="id" value="{pigcms{$category.id}"/>
            <tr>
                <th width="80">分类名称</th>
                <td><input type="text" class="input fl" id="name" name="name" size="25" placeholder="请填写分类名称" value="{pigcms{$category.name}" validate="maxlength:40,required:true" tips="请填写分类名称！，必填！"/></td>
            </tr>
            <tr>
                <th width="80">分类标识符(如：ceshi)</th>
                <td><input type="text" class="input fl" id="cat_url" name="cat_url" size="25" placeholder="请填写分类标识符：如ceshi" value="{pigcms{$category.cat_url}"  validate="maxlength:15,required:true" tips="请填写分类标识符！，必填！"/></td>
            </tr>
            <tr>
                <th width="80">排序(越小越靠前，填数字)</th>
                <td><input type="text" class="input fl" id="sort" name="sort" size="10" placeholder="排序(越小越靠前)" value="{pigcms{$category.sort}"   validate="maxlength:3,required:true" tips="排序(越小越靠前)！，必填！"/></td>
            </tr>
        </table>
        <div class="btn">
            <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
            <input type="reset" value="取消" class="button" onclick="history.back(-1);"/>
        </div>
    </form>
</div>
<include file="Public:footer"/>