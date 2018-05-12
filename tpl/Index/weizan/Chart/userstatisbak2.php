
<include file="Public:adminheader"/>
    <div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header" style="display: none;">
    <h1>
        用户统计
        <small>User statistics</small>
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

    <div class="row" id="main" style="width: 100%;height:600px;text-align: center;">

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
     
     // 显示标题，图例和空的坐标轴
//     myChart.setOption({
//         title: {
//             text: '小农丁17年销售额统计'
//         },
//         tooltip: {},
//         legend: {
//             data:['销售额']
//         },
//         xAxis: {
//             data: []
//         },
//         yAxis: {},
//         series: [{
//             name: '销售额',
//             type: 'bar',
//             data: []
//         }]
//     });
     option = {
     	
     	backgroundColor: '#f3f3f3',
         title: {
             text: '',
             subtext: ''
         },
         tooltip: {
             trigger: 'axis',
             axisPointer: {
                 type: 'shadow'
             }
         },
         legend: {
             data: ['2017年']
         },
         grid: {
             left: '3%',
             right: '4%',
             bottom: '3%',
             containLabel: true
         },
         xAxis: {
             type: 'value',
             boundaryGap: [0, 0.01]
         },
         yAxis: {
             type: 'category',
             data: ['山东','广东','江苏','湖南','浙江','北京',"河北","上海","湖北","河南"]
         },
         series: [
             {
                 name: '9月',
                 type: 'bar',
                 data: [57746, 23489, 29034, 14970, 13174, 30230,35887,28800,20122,25667],
                 color: ['#86c131'],
             }
         ]
     };
myChart.setOption(option);

//     // 异步加载数据
//     $.get('{pigcms{:U('Chart/ajaxdata')}').done(function (data) {
//         var obj=JSON.parse(data);
//
//         // 填入数据
//         myChart.setOption({
//             xAxis: {
//                 data: obj.categories
//             },
//             series: [{
//                 // 根据名字对应到相应的系列
//                 name: '销售额',
//                 data: obj.data
//             }]
//         });
//
//     });
 });
</script>


