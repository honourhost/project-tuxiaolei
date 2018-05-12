<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Else/single')}" class="on">市场人员负责单品特卖列表</a>
        </ul>
    </div>

    <div class="table-list">
        <table width="100%" cellspacing="0">
            <colgroup><col> <col> <col><col><col><col><col><col><col width="180" align="center"> </colgroup>
            <thead>
            <tr>
                <th class="textcenter">人员id</th>
                <th class="textcenter">姓名</th>
                <th class="textcenter">电话</th>
                <th class="textcenter">操作</th>

            </tr>
            </thead>
            <tbody>
            <if condition="is_array($marketers)">
                <volist name="marketers" id="vo">
                    <tr>
                        <td  class="textcenter">{pigcms{$vo.id}</td>
                        <td  class="textcenter">{pigcms{$vo.name}</td>
                        <td  class="textcenter">{pigcms{$vo.phone}</td>
                        <td class="textcenter"><a href="{pigcms{:U('Else/singlelist',array('mar_id'=>$vo['id']))}">单品列表</a></td>


                    </tr>
                </volist>
                <tr><td class="textcenter pagebar" colspan="10">{pigcms{$pagebar}</td></tr>
                <else/>
                <tr><td class="textcenter red" colspan="10">列表为空！</td></tr>
            </if>
            </tbody>
        </table>
    </div>

</div>
<include file="Public:footer"/>