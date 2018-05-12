<include file="Public:header"/>
		<div class="mainbox">
			<div id="nav" class="mainnav_title">

			</div>
			<if condition="!empty($_GET['cat_fid'])">
				<div style="height:30px;line-height:30px;">提示：若主分类下只有一个子分类，网站上子分类不会显示。</div>
			</if>

            <table class="search_table" width="100%">
                <tr>
                    <td>
                        <form action="{pigcms{:U('Oquery/index')}" method="get">
                            <input type="hidden" name="c" value="Oquery"/>
                            <input type="hidden" name="a" value="merlist"/>
                           商户名称: <input type="text" name="keyword" class="input-text" value="{pigcms{$_GET['keyword']}"/>
                            <input type="submit" value="查询" class="button"/>

                        </form>


                    </td>
                    <td>
                        <!--<button class="button" onclick="GoodsOrder()">导出</button>-->
                    </td>
                    <td>

                    </td>
                </tr>
            </table>

			<form name="myform" id="myform" action="" method="post">
				<div class="table-list">
					<table width="100%" cellspacing="0">
						<colgroup>
							<col/>
							<col/>
							<col/>
							<col/>
							<if condition="empty($_GET['cat_fid'])">
								<col/>
								<col/>
								<col/>
							</if>
							<col/>
							<col width="180" align="center"/>
						</colgroup>
						<thead>
							<tr>
								<th>商户名称</th>
                                <th class="textcenter">操作</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($category_list)">
								<volist name="category_list" id="vo">
									<tr>
										<td>{pigcms{$vo.name}</td>
                                        <td class="textcenter"><a href="{pigcms{:U('Oquery/order_list',array('mer_id'=>$vo['mer_id']))}">订单列表</a> | <a href="{pigcms{:U('Oquery/tixian',array('mer_id'=>$vo['mer_id']))}">商户提现</a>  | <a href="{pigcms{:U('Oquery/tixianxx',array('mer_id'=>$vo['mer_id']))}">线下提现</a> </td>
									</tr>
								</volist>
								<tr><td class="textcenter pagebar" colspan="9">{pigcms{$pagebar}</td></tr>
							<else/>
								<tr><td class="textcenter red" colspan="9">列表为空！</td></tr>
							</if>
						</tbody>
					</table>
				</div>
			</form>
		</div>

<script type="text/javascript">
    var islock=false;
    function GoodsOrder(){

        var ks=$("input[name='kaishi']").val();
        var js=$("input[name='jieshu']").val();

        if(islock){
            alert('正在执行生成订单文件，请勿重复点击！');
            return false;
        }
        islock=true;
        window.location.href="xnd_admin.php?g=System&c=Oquery&a=export&kaishi="+ks+"&jieshu="+js;

    }

</script>

<include file="Public:footer"/>