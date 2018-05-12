
<include file="Public:adminheader"/>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="display: none;">
        <h1>
            小农丁销售统计
            <small>Sale statistics</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- START PROGRESS BARS -->

<style>
		.content{
		background: #f3f3f3;
	}
	.row{
		margin-left: 0;
	}
	.sidebar-menu>li>a{
		padding: 15px 5px 15px 15px;
		font-size: 16px;
	}
</style>

        <div class="row" id="main" style="width: 100%;text-align: center;">

        </div>


<script type="text/javascript">
            $(function(){
                //改变div的高度
                $(".row").height($(window).height()-130);
            });
        </script>

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

<include file="Public:adminfooter"/>
<script type="text/javascript">
    $(document).ready(function () {
        var myChart = echarts.init(document.getElementById('main'));
        option = {
            title: {
                text: '',
                subtext: ''
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross',
                    label: {
                        backgroundColor: '#283b56'
                    }
                }
            },
            legend: {
                data:['销售', '成交记录']
            },
            toolbox: {
                show: true,
                feature: {
                    dataView: {readOnly: false},
                    restore: {},
                    saveAsImage: {}
                }
            },
            dataZoom: {
                show: false,
                start: 0,
                end: 100
            },
            xAxis: [
                {
                    type: 'category',
                    boundaryGap: true,
                    data: (function (){
                        var now = new Date();
                        var res = [];
                        var len = 10;
                        while (len--) {
                            res.unshift(now.toLocaleTimeString().replace(/^\D*/,''));
                            now = new Date(now - 2000);
                        }
                        return res;
                    })()
                },
                {
                    type: 'category',
                    boundaryGap: true,
                    data: (function (){
                        var res = [];
                        var len = 10;
                        while (len--) {
                            res.push(len + 1);
                        }
                        return res;
                    })()
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    scale: true,
                    name: '价格',
                    max: 30,
                    min: 0,
                    boundaryGap: [0.2, 0.2]
                },
                {
                    type: 'value',
                    scale: true,
                    name: '下单量',
                    max: 20,
                    min: 0,
                    boundaryGap: [0.2, 0.2]
                }
            ],
            series: [
                {
                    name:'成交记录',
                    color: ['#86c131'],
                    type:'bar',
                    xAxisIndex: 1,
                    yAxisIndex: 1,
                    data:(function (){
                        var res = [];
                        var len = 10;
                        while (len--) {
                            res.push(Math.round(Math.random() *10+5));
                        }
                        return res;
                    })()
                },
                {
                    name:'销售',
                    type:'line',
                    color: ['#3C763D'],
                    data:(function (){
                        var res = [];
                        var len = 0;
                        while (len < 10) {
                            res.push((Math.random()*2 ).toFixed(1) - 0);
                            len++;
                        }
                        return res;
                    })()
                }
            ]
        };

         var count = 11;
        setInterval(function (){
            axisData = (new Date()).toLocaleTimeString().replace(/^\D*/,'');

            var data0 = option.series[0].data;
            var data1 = option.series[1].data;
            data0.shift();
            data0.push(Math.round(Math.random() * 20));
            data1.shift();
            data1.push((Math.random() * 2 + 5).toFixed(1) - 0);

            option.xAxis[0].data.shift();
            option.xAxis[0].data.push(axisData);
            option.xAxis[1].data.shift();
            option.xAxis[1].data.push(count++);

            myChart.setOption(option);
        }, 4100);


    });
</script>


