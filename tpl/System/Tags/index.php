<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Tags/index')}" class="on">标签列表</a>|
            <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Tags/add')}','添加标签',500,200,true,false,false,addbtn,'add',true);">添加标签</a>
        </ul>
    </div>
    <form name="myform" id="myform" action="" method="post">
        <div class="table-list">
            <table width="100%" cellspacing="0">
                <colgroup><col> <col> <col> <col><col> <col width="140" align="center"> </colgroup>
                <thead>
                <tr>
                    <th>排序</th>
                    <th>编号</th>
                    <th>标签名称</th>
                    <th>添加时间</th>
                    <th class="textcenter">操作</th>
                </tr>
                </thead>
                <tbody>
                <if condition="is_array($tags)">
                    <volist name="tags" id="vo">
                        <tr>
                            <td>{pigcms{$vo.sort}</td>
                            <td>{pigcms{$vo.id}</td>
                            <td>{pigcms{$vo.tagname}</td>
                            <td>{pigcms{$vo.addtime|date='Y-m-d H:i:s',###}</td>
                            <td class="textcenter"><a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Tags/edit',array('id'=>$vo['id'],'frame_show'=>true))}','查看详细信息',500,200,true,false,false,false,'add',true);">查看</a> | <a href="javascript:void(0);" onclick="window.top.artiframe('{pigcms{:U('Tags/edit',array('id'=>$vo['id']))}','编辑热门搜索词',500,200,true,false,false,editbtn,'add',true);">编辑</a> | <a href="javascript:void(0);" class="delete_row" parameter="id={pigcms{$vo.id}" url="{pigcms{:U('Tags/del')}">删除</a></td>
                        </tr>
                    </volist>
                    <tr><td class="textcenter pagebar" colspan="8">{pigcms{$pagebar}</td></tr>
                    <else/>
                    <tr><td class="textcenter red" colspan="8">列表为空！</td></tr>
                </if>
                </tbody>
            </table>
        </div>
    </form>
</div>
<include file="Public:footer"/>