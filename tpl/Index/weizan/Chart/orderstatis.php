
<include file="Public:adminheader"/>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="display: none;">
        <h1>
            订单统计
            <small>Order statistics</small>
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
                $(".row").height($(window).height()-100);
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
        var data = genData(10);

        option = {
            title : {
                text: '',
                subtext: '',
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                type: 'scroll',
                orient: 'vertical',
                right: 100,
                top: 20,
                bottom: 20,
                data: data.legendData
            },
           
            
            series : [
                {
                    name: '订单',
                    type: 'pie',
                    radius : '55%',
                    center: ['40%', '50%'],
                    data: data.seriesData,
                    label : {
					normal : {
					formatter: '{b}:({d}%)',
					textStyle : {
					fontWeight : 'normal',
					fontSize : 16
					}
					}
					}, 
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };




        function genData(count) {
            var nameList = [
                '赵', '钱', '孙', '李', '周', '吴', '郑', '王', '冯', '陈', '褚', '卫', '蒋', '沈', '韩', '杨', '朱', '秦', '尤', '许', '何', '吕', '施', '张', '孔', '曹', '严', '华', '金', '魏', '陶', '姜', '戚', '谢', '邹', '喻', '柏', '水', '窦', '章', '云', '苏', '潘', '葛', '奚', '范', '彭', '郎', '鲁', '韦', '昌', '马', '苗', '凤', '花', '方', '俞', '任', '袁', '柳', '酆', '鲍', '史', '唐', '费', '廉', '岑', '薛', '雷', '贺', '倪', '汤', '滕', '殷', '罗', '毕', '郝', '邬', '安', '常', '乐', '于', '时', '傅', '皮', '卞', '齐', '康', '伍', '余', '元', '卜', '顾', '孟', '平', '黄', '和', '穆', '萧', '尹', '姚', '邵', '湛', '汪', '祁', '毛', '禹', '狄', '米', '贝', '明', '臧', '计', '伏', '成', '戴', '谈', '宋', '茅', '庞', '熊', '纪', '舒', '屈', '项', '祝', '董', '梁', '杜', '阮', '蓝', '闵', '席', '季', '麻', '强', '贾', '路', '娄', '危'
            ];
            var legendData1 = ['海南贵妃芒','青岛农丁原浆','陕西高原红富士','徐闻菠萝','稷山板枣','广西融安金桔','四川金艳猕猴桃','广西恭城月柿','泰国金枕头榴莲','海南夏威夷红心木瓜','秭归伦晚脐橙','神农架野生猕猴桃','烟台大红灯樱桃','栖霞红富士苹果','带料包青岛即食海蜇','杠六九西红柿','平和琯溪蜜柚','新疆薄皮核桃','肇庆肥仔伟裹蒸粽子','四川大凉山特产油桃'];
            var legendData2 = ['海南贵妃芒','青岛农丁原浆','陕西高原红富士','徐闻菠萝','稷山板枣','广西融安金桔','四川金艳猕猴桃','广西恭城月柿','泰国金枕头榴莲','海南夏威夷红心木瓜','秭归伦晚脐橙','神农架野生猕猴桃','烟台大红灯樱桃','栖霞红富士苹果','带料包青岛即食海蜇','杠六九西红柿','平和琯溪蜜柚','新疆薄皮核桃'];
          var   seriesData1= [4622376.00,2307889.00,1902718.60,1042905.80,3448424.00,2079026.80,2088515.00,2394446.40,1912845.00,1671789.60,1454161,1845520,2199483,1603290,1233250,992366,1204390,1386339,689988,999900]
            var seriesData = [];
            var legendData=[];
            for (var i = 0; i < 20; i++) {
//                name = Math.random() > 0.65
//                    ? makeWord(4, 1) + '·' + makeWord(3, 0)
//                    : makeWord(2, 1);
                legendData.push(legendData1[i]);
                seriesData.push({
                    name: legendData1[i],
                    value: seriesData1[i]
                });
            }

            return {
                legendData: legendData,

                seriesData: seriesData,
                legendData2: legendData2
            };

            function makeWord(max, min) {
                var nameLen = Math.ceil(Math.random() * max + min);
                var name = [];
                for (var i = 0; i < nameLen; i++) {
                    name.push(nameList[Math.round(Math.random() * nameList.length - 1)]);
                }
                return name.join('');
            }
        }

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


        setTimeout(function () {
            var orderc=$("#number").text();
            var moneyc=$("#number1").text();
            var userc=$("#number2").text();
            console.error("orderstatis----"+orderc);
            window.location.href="http://www.xiaonongding.com/index.php?c=Chart&a=userstatis&orderc="+orderc+"&moneyc="+moneyc+"&userc="+userc;

        },30000);
    });
</script>


