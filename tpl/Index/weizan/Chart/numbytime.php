<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/echarts/3.7.1/echarts.min.js"></script>
</head>
<body style="text-align: center;">
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 600px;height:400px;text-align: center;"></div>
<div id="main2" style="width: 600px;height:400px;text-align: center;"></div>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'));
    var myChart2 = echarts.init(document.getElementById('main2'));
    // 显示标题，图例和空的坐标轴
    myChart.setOption({
        title: {
            text: '小农丁17年销售额统计'
        },
        tooltip: {},
        legend: {
            data:['销售额']
        },
        xAxis: {
            data: []
        },
        yAxis: {},
        series: [{
            name: '销售额',
            type: 'bar',
            data: []
        }]
    });
    // 显示标题，图例和空的坐标轴
    myChart2.setOption({
        title: {
            text: '小农丁17年销量统计'
        },
        tooltip: {},
        legend: {
            data:['销量']
        },
        xAxis: {
            data: []
        },
        yAxis: {},
        series: [{
            name: '销量',
            type: 'bar',
            data: []
        }]
    });

    // 异步加载数据
    $.get('{pigcms{:U('Chart/ajaxdata')}').done(function (data) {
        var obj=JSON.parse(data);

        // 填入数据
        myChart.setOption({
            xAxis: {
                data: obj.categories
            },
            series: [{
                // 根据名字对应到相应的系列
                name: '销售额',
                data: obj.data
            }]
        });
        // 填入数据
        myChart2.setOption({
            xAxis: {
                data: obj.categories
            },
            series: [{
                // 根据名字对应到相应的系列
                name: '销量',
                data: obj.count
            }]
        });
    });
</script>

</body>
</html>