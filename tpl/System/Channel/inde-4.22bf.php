<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
                <a href="{pigcms{:U('Channel/index')}" class="on">频道列表</a>
                <a href="{pigcms{:U('Channel/add')}">添加新频道</a>
        </ul>
    </div>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup><col> <col> <col><col><col><col><col><col><col width="180" align="center"> </colgroup>
                <thead>
                <tr>
                    <th class="textcenter">频道id</th>
                    <th class="textcenter">名称</th>
                    <th class="textcenter">频道url</th>
                    <th class="textcenter">频道总营收</th>
                    <th class="textcenter">品频道总收益</th>
                    <th class="textcenter">创建时间</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($channels)">
                    <volist name="channels" id="vo">
                        <tr>
                            <td  class="textcenter">{pigcms{$vo.id}</td>
                            <td  class="textcenter">{pigcms{$vo.name}</td>
                            <td  class="textcenter">{pigcms{$vo.url}</td>
                            <td  class="textcenter">{pigcms{$vo.income}</td>
                            <td class="textcenter">{pigcms{$vo.profit}</td>
                            <td><php>echo date("Y-m-d H:i:s",$vo['create_time']);</php></td>
                            <td class="textcenter"><a href="{pigcms{:U('Channel/personList',array('id'=>$vo['id']))}">分类下股东列表</a> | <a href="{pigcms{:U('Channel/catList',array('id'=>$vo['id']))}">频道分类管理</a> | <a href="{pigcms{:U('Channel/edit',array('id'=>$vo['id']))}">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Channel/del')}">删除</a></td>
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