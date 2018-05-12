<include file="Public:header"/>
<div class="mainbox">
    <div id="nav" class="mainnav_title">
        <ul>
            <a href="{pigcms{:U('Else/fastcash')}" class="on">市场人员统计</a>
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
                    <th class="textcenter">快捷付款销售额</th>
                    <th class="textcenter">今日快捷付款销售额</th>

                </tr>
                </thead>
                <tbody>
                <if condition="is_array($marketers)">
                    <volist name="marketers" id="vo">
                        <tr>
                            <td  class="textcenter">{pigcms{$vo.id}</td>
                            <td  class="textcenter">{pigcms{$vo.name}</td>
                            <td  class="textcenter">{pigcms{$vo.phone}</td>
                            <td class="textcenter">{pigcms{$vo.totalmoney}</td>
                            <td class="textcenter">{pigcms{$vo.totaltoday}</td>

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