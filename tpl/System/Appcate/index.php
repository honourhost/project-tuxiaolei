<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Appcate/index')}" class="on">推荐分类列表</a>
                <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Appcate/cat_add')}','添加推荐分类',400,180,true,false,false,addbtn,'add',true);">添加推荐分类</a>

        </ul>
    </div>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup><col> <col> <col><col>  <col width="180" align="center"> </colgroup>
                <thead>
                <tr>
                    <th>排序</th>
                    <th>名称</th>
                    <th>类别</th>
                    <th>商品列表</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($category_list)">
                    <volist name="category_list" id="vo">
                        <tr>
                            <td>{pigcms{$vo.sort}</td>
                            <td>{pigcms{$vo.name}</td>
                            <td><?php if($vo["isthree"]==1){ ?>3产品<?php }else {?>6件产品<?php }?></td>
                            <td><a href="{pigcms{:U('Appcate/slider_list',array('cat_id'=>$vo['id']))}">导航列表</a></td>
                            <td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Appcate/cat_edit',array('cat_id'=>$vo['id'],'frame_show'=>true))}','查看推荐分类',400,180,true,false,false,false,'add',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Appcate/cat_edit',array('cat_id'=>$vo['id']))}','编辑导航分类',400,180,true,false,false,editbtn,'add',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="cat_id={pigcms{$vo.id}" url="{pigcms{:U('Appcate/cat_del')}">删除</a></td>
                        </tr>
                    </volist>
                    <else/>
                    <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>