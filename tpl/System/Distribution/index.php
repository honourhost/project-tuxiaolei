<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Distribution/index')}" class="on">分销权限用户列表</a>
            <a href="{pigcms{:U('Distribution/add')}">添加新的分销用户</a>
        </ul>
    </div>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup><col> <col> <col><col><col><col><col><col><col width="180" align="center"> </colgroup>
                <thead>
                <tr>
                    <th class="textcenter">id</th>
                    <th class="textcenter">用户id</th>
                    <th class="textcenter">用户分销id</th>
                    <th class="textcenter">创建时间</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($persons)">
                    <volist name="persons" id="vo">
                        <tr>
                            <td  class="textcenter">{pigcms{$vo.id}</td>
                            <td  class="textcenter">{pigcms{$vo.user_id}</td>
                            <td  class="textcenter">{pigcms{$vo.distribution_id}</td>
                            <td class="textcenter"><php>echo date("Y-m-d H:i:s",$vo['create_time']);</php></td>
                            <td class="textcenter"><a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Distribution/del')}">删除</a></td>
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