<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
                <a href="{pigcms{:U('App/add')}">添加新版本</a>
        </ul>
    </div>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup><col> <col> <col><col><col><col><col><col><col width="180" align="center"> </colgroup>
                <thead>
                <tr>
                    <th>编号</th>
                    <th>名字</th>
                    <th>对应的文件id</th>
                    <th>创建时间</th>
                    <th class="textcenter">版本号</th>
                    <th class="textcenter">版本信息</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($apps)">
                    <volist name="apps" id="vo">
                        <tr>
                            <td>{pigcms{$vo.id}</td>
                            <td>{pigcms{$vo.name}</td>
                            <td>{pigcms{$vo.file_id}</td>
                            <td><php>echo date("Y-m-d H:i:s",$vo['create_time']);</php></td>
                             <td class="textcenter">{pigcms{$vo.version_no}</td>
                            <td class="textcenter">{pigcms{$vo.version_detail}</td>
                            <td class="textcenter"><a href="{pigcms{:U('App/delete',array('id'=>$vo['id']))}">删除</a></td>
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