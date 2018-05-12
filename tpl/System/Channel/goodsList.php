<!--/**
 * Created by PhpStorm.
 * User: sunny
 * Date: 2016/3/28
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
            <a href="{pigcms{:U('Channel/goodsList',array('id'=>$cat_id))}" class="on">频道商品分类列表</a>
            <a href="{pigcms{:U('Channel/addGoods',array('cat_id'=>$cat_id,'c_id'=>$c_id))}">新增分类商品</a>
        </ul>
    </div>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup><col> <col> <col><col><col><col><col><col><col width="180" align="center"> </colgroup>
                <thead>
                <tr>
                    <th class="textcenter">频道id</th>
                    <th class="textcenter">频道分类id</th>
                    <th class="textcenter">商品id</th>
                    <th class="textcenter">创建时间</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($goods)">
                    <volist name="goods" id="vo">
                        <tr>
                            <td  class="textcenter">{pigcms{$vo.c_id}</td>
                            <td  class="textcenter">{pigcms{$vo.cat_id}</td>
                            <td  class="textcenter">{pigcms{$vo.goods_id}</td>
                            <td class="textcenter"><php>echo date("Y-m-d H:i:s",$vo['create_time']);</php></td>
                            <td class="textcenter"><!-- <a href="{pigcms{:U('Channel/editGoods',array('id'=>$vo['id'],'c_id'=>$c_id,'cat_id'=>$cat_id))}">编辑</a> |  --><a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Channel/delGoods')}">删除</a></td>
                        </tr>
                    </volist>
                    <tr><td class="textcenter pagebar" colspan="10">{pigcms{$pagebar}</td></tr>
                    <else/>
                    <tr><td class="textcenter red" colspan="10">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>