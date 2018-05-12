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
            <a href="{pigcms{:U('Channel/catList',array('id'=>$c_id))}">频道分类列表</a>
            <a href="{pigcms{:U('Channel/goodsList',array('id'=>$cat_id))}">频道分类商品列表</a>
        </ul>
    </div>
    <form id="myform" method="post" action="{pigcms{:U('Channel/addGoods')}" frame="true" refresh="true">
        <table cellpadding="0" cellspacing="0" class="frame_form" width="100%">
            <input type="hidden" name="c_id" value="{pigcms{$c_id}"/>
            <input type="hidden" name="cat_id" value="{pigcms{$cat_id}"/>
            <tr>
                <th width="80">商品id</th>
                <td><input type="text" class="input fl" id="goods_id" name="goods_id" size="25" placeholder="商品id" validate="maxlength:40,required:true" tips="商品id！，必填！"/></td>
            </tr>
        </table>
        <div class="btn">
            <input type="submit" name="dosubmit" id="dosubmit" value="提交" class="button" />
            <input type="reset" value="取消" class="button" onclick="history.back(-1);"/>
        </div>
    </form>
</div>
<include file="Public:footer"/>
