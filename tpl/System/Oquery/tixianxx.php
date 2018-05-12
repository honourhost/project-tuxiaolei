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
                      <!--  <form action="{pigcms{:U('Oquery/index')}" method="get">
                            <input type="hidden" name="c" value="Oquery"/>
                            <input type="hidden" name="a" value="index"/>
                            开始日期: <input name="kaishi" class="col-sm-2 Wdate" type="text" readonly="" style="height:30px;" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss',startDate:'',vel:'begin_time'})" value="{pigcms{$_GET['kaishi']}">
                            结束日期: <input name="jieshu" class="col-sm-2 Wdate" type="text" readonly="" style="height:30px;" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss',startDate:'',vel:'begin_time'})" value="{pigcms{$_GET['jieshu']}">
                            <input type="submit" value="查询" class="button"/>

                        </form>-->


                    </td>
                    <td>
                        <button class="button" onclick="GoodsOrder()">导出</button>
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
								<th>姓名</th>
								<th>电话</th>
								<th>银行名</th>
								<th>卡号</th>
								<th>提现金额</th>
                                <th>日期</th>
							</tr>
						</thead>
						<tbody>
							<if condition="is_array($category_list)">
								<volist name="category_list" id="vo">
									<tr>
										<td>{pigcms{$vo.merchant_real_name}</td>
										<td>{pigcms{$vo.merchant_real_telephone}</td>
                                        <td>{pigcms{$vo.bank_name}</td>
										<td>{pigcms{$vo.bank_card}</td>
                                        <td>{pigcms{$vo.cash_num}</td>
                                        <td>{pigcms{$vo.add_time|date='Y-m-d',###}</td>
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

        var mer_id='{pigcms{$_GET['mer_id']}';

        //alert(mer_id);

        if(islock){
            alert('正在执行生成订单文件，请勿重复点击！');
            return false;
        }
        islock=true;
        window.location.href="xnd_admin.php?g=System&c=Oquery&a=export_tixianxx&mer_id="+mer_id+"";

    }

</script>

<include file="Public:footer"/>