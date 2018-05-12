
<include file="Public:adminheader"/>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="display: none;">
        <h1>
            供应链展示
            <small>Chain </small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content" >
        <!-- START PROGRESS BARS -->

<style>
	.content{
		background: #000;
	}
	.row{
		margin-left: 0;
	}
	.sidebar-menu>li>a{
		padding: 15px 5px 15px 15px;
		font-size: 16px;
	}
</style>


        <div class="row" id="main" style="width: 100%;height: 600px;">

        </div>

<include file="Public:adminfooter"/>
<script type="text/javascript">
            $(function(){
                //改变div的高度
                $(".row").height($(window).height()-130);
            });
        </script>

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->


<script type="text/javascript">
    $(document).ready(function () {
        var myChart = echarts.init(document.getElementById('main'));


        var geoCoordMap = {
            '上海': [121.4648,31.2891],
            '东莞': [113.8953,22.901],
            '东营': [118.7073,37.5513],
            '中山': [113.4229,22.478],
            '临汾': [111.4783,36.1615],
            '临沂': [118.3118,35.2936],
            '丹东': [124.541,40.4242],
            '丽水': [119.5642,28.1854],
            '乌鲁木齐': [87.9236,43.5883],
            '佛山': [112.8955,23.1097],
            '保定': [115.0488,39.0948],
            '兰州': [103.5901,36.3043],
            '内蒙商都': [110.3467,41.4899],
            '北京': [116.4551,40.2539],
            '北海': [109.314,21.6211],
            '南京': [118.8062,31.9208],
            '南宁': [108.479,23.1152],
            '南昌': [116.0046,28.6633],
            '南通': [121.1023,32.1625],
            '厦门': [118.1689,24.6478],
            '台州': [121.1353,28.6688],
            '合肥': [117.29,32.0581],
            '呼和浩特': [111.4124,40.4901],
            '咸阳': [108.4131,34.8706],
            '哈尔滨': [127.9688,45.368],
            '唐山': [118.4766,39.6826],
            '嘉兴': [120.9155,30.6354],
            '大同': [113.7854,39.8035],
            '大连': [122.2229,39.4409],
            '天津': [117.4219,39.4189],
            '太原': [112.3352,37.9413],
            '威海': [121.9482,37.1393],
            '宁波': [121.5967,29.6466],
            '宝鸡': [107.1826,34.3433],
            '宿迁': [118.5535,33.7775],
            '常州': [119.4543,31.5582],
            '广州': [113.5107,23.2196],
            '廊坊': [116.521,39.0509],
            '延安': [109.1052,36.4252],
            '张家口': [115.1477,40.8527],
            '徐州': [117.5208,34.3268],
            '德州': [116.6858,37.2107],
            '惠州': [114.6204,23.1647],
            '成都': [103.9526,30.7617],
            '扬州': [119.4653,32.8162],
            '承德': [117.5757,41.4075],
            '拉萨': [91.1865,30.1465],
            '无锡': [120.3442,31.5527],
            '日照': [119.2786,35.5023],
            '昆明': [102.9199,25.4663],
            '杭州': [119.5313,29.8773],
            '枣庄': [117.323,34.8926],
            '柳州': [109.3799,24.9774],
            '株洲': [113.5327,27.0319],
            '武汉': [114.3896,30.6628],
            '汕头': [117.1692,23.3405],
            '江门': [112.6318,22.1484],
            '沈阳': [123.1238,42.1216],
            '沧州': [116.8286,38.2104],
            '河源': [114.917,23.9722],
            '泉州': [118.3228,25.1147],
            '泰安': [117.0264,36.0516],
            '泰州': [120.0586,32.5525],
            '济南': [117.1582,36.8701],
            '济宁': [116.8286,35.3375],
            '海口': [110.3893,19.8516],
            '淄博': [118.0371,36.6064],
            '淮安': [118.927,33.4039],
            '深圳': [114.5435,22.5439],
            '清远': [112.9175,24.3292],
            '温州': [120.498,27.8119],
            '渭南': [109.7864,35.0299],
            '湖州': [119.8608,30.7782],
            '湘潭': [112.5439,27.7075],
            '滨州': [117.8174,37.4963],
            '潍坊': [119.0918,36.524],
            '烟台': [120.7397,37.5128],
            '玉溪': [101.9312,23.8898],
            '珠海': [113.7305,22.1155],
            '盐城': [120.2234,33.5577],
            '盘锦': [121.9482,41.0449],
            '石家庄': [114.4995,38.1006],
            '福州': [119.4543,25.9222],
            '秦皇岛': [119.2126,40.0232],
            '绍兴': [120.564,29.7565],
            '聊城': [115.9167,36.4032],
            '肇庆': [112.1265,23.5822],
            '舟山': [122.2559,30.2234],
            '苏州': [120.6519,31.3989],
            '莱芜': [117.6526,36.2714],
            '菏泽': [115.6201,35.2057],
            '营口': [122.4316,40.4297],
            '葫芦岛': [120.1575,40.578],
            '衡水': [115.8838,37.7161],
            '衢州': [118.6853,28.8666],
            '西宁': [101.4038,36.8207],
            '西安': [109.1162,34.2004],
            '贵阳': [106.6992,26.7682],
            '连云港': [119.1248,34.552],
            '邢台': [114.8071,37.2821],
            '邯郸': [114.4775,36.535],
            '郑州': [113.4668,34.6234],
            '鄂尔多斯': [108.9734,39.2487],
            '重庆': [107.7539,30.1904],
            '金华': [120.0037,29.1028],
            '铜川': [109.0393,35.1947],
            '银川': [106.3586,38.1775],
            '镇江': [119.4763,31.9702],
            '长春': [125.8154,44.2584],
            '长沙': [113.0823,28.2568],
            '长治': [112.8625,36.4746],
            '阳泉': [113.4778,38.0951],
            '广西': [107,22],
            '广东': [113,23],
            '杨凌': [108,34],
            '大凉山': [103,27],
            '云南元江': [101,23],
            '青岛': [120.4651,36.3373],
            '韶关': [113.7964,24.7028]
        };

        var BJData = [
            [{name:'青岛'}, {name:'广西',value:95}],
            [{name:'青岛'}, {name:'广东',value:90}],
            [{name:'青岛'}, {name:'青岛',value:80}],
            [{name:'青岛'}, {name:'杨凌',value:70}],
            [{name:'青岛'}, {name:'大凉山',value:60}],
            [{name:'青岛'}, {name:'云南元江',value:50}],
            [{name:'青岛'}, {name:'内蒙商都',value:30}]

        ];

        var YLData = [
            [{name:'杨凌'}, {name:'广西',value:95}],
            [{name:'杨凌'}, {name:'广东',value:90}],
            [{name:'杨凌'}, {name:'杨凌',value:70}],
            [{name:'杨凌'}, {name:'青岛',value:80}],
            [{name:'杨凌'}, {name:'大凉山',value:60}],
            [{name:'杨凌'}, {name:'云南元江',value:50}],
            [{name:'杨凌'}, {name:'内蒙商都',value:30}]
        ];

        var DLSData = [
            [{name:'大凉山'}, {name:'广西',value:95}],
            [{name:'大凉山'}, {name:'广东',value:90}],
            [{name:'大凉山'}, {name:'杨凌',value:70}],
            [{name:'大凉山'}, {name:'青岛',value:80}],
            [{name:'大凉山'}, {name:'大凉山',value:60}],
            [{name:'大凉山'}, {name:'云南元江',value:50}],
            [{name:'大凉山'}, {name:'内蒙商都',value:30}]
        ];

        var YJSData = [
            [{name:'云南元江'}, {name:'广西',value:95}],
            [{name:'云南元江'}, {name:'广东',value:90}],
            [{name:'云南元江'}, {name:'杨凌',value:70}],
            [{name:'云南元江'}, {name:'青岛',value:80}],
            [{name:'云南元江'}, {name:'大凉山',value:60}],
            [{name:'云南元江'}, {name:'云南元江',value:50}],
            [{name:'云南元江'}, {name:'内蒙商都',value:30}]
        ];
        var GXSData = [
            [{name:'广西'}, {name:'广西',value:95}],
            [{name:'广西'}, {name:'广东',value:90}],
            [{name:'广西'}, {name:'杨凌',value:70}],
            [{name:'广西'}, {name:'青岛',value:80}],
            [{name:'广西'}, {name:'大凉山',value:60}],
            [{name:'广西'}, {name:'云南元江',value:50}],
            [{name:'广西'}, {name:'内蒙商都',value:30}]
        ];
        var GDSData = [
            [{name:'广东'}, {name:'广西',value:95}],
            [{name:'广东'}, {name:'广东',value:90}],
            [{name:'广东'}, {name:'杨凌',value:70}],
            [{name:'广东'}, {name:'青岛',value:80}],
            [{name:'广东'}, {name:'大凉山',value:60}],
            [{name:'广东'}, {name:'云南元江',value:50}],
            [{name:'广东'}, {name:'内蒙商都',value:30}]
        ];
        var SDSData = [
            [{name:'内蒙商都'}, {name:'广西',value:95}],
            [{name:'内蒙商都'}, {name:'广东',value:90}],
            [{name:'内蒙商都'}, {name:'杨凌',value:70}],
            [{name:'内蒙商都'}, {name:'青岛',value:80}],
            [{name:'内蒙商都'}, {name:'大凉山',value:60}],
            [{name:'内蒙商都'}, {name:'云南元江',value:50}],
            [{name:'内蒙商都'}, {name:'内蒙商都',value:30}]
        ];

        var planePath = 'path://M275.2 864c0 0 128-102.4 236.8-108.8 108.8 6.4 236.8 108.8 236.8 108.8-6.4-108.8-83.2-179.2-83.2-179.2C761.6 320 505.6 0 505.6 0S256 320 358.4 684.8C358.4 684.8 275.2 761.6 275.2 864zM473.6 192l64 0c0 0 83.2 0 83.2 192L396.8 384C390.4 192 473.6 192 473.6 192zM576 793.6l-70.4-12.8-70.4 12.8c0 0-44.8 19.2-38.4 44.8 6.4 25.6 57.6 153.6 102.4 179.2 44.8-19.2 96-147.2 102.4-179.2C620.8 812.8 576 793.6 576 793.6z';

        var convertData = function (data) {
            var res = [];
            for (var i = 0; i < data.length; i++) {
                var dataItem = data[i];
                var fromCoord = geoCoordMap[dataItem[0].name];
                var toCoord = geoCoordMap[dataItem[1].name];
                if (fromCoord && toCoord) {
                    res.push({
                        fromName: dataItem[0].name,
                        toName: dataItem[1].name,
                        coords: [fromCoord, toCoord]
                    });
                }
            }
            return res;
        };

        var color = ['#86c131', '#86c131', '#86c131', '#86c131', '#86c131', '#86c131', '#86c131', '#86c131'];
        var series = [];
        [['青岛', BJData],['杨凌', YLData],['大凉山', DLSData],['云南元江',YJSData],['广西',GXSData],['广东',GDSData],['内蒙商都',SDSData]].forEach(function (item, i) {
            series.push({
                    name: item[0] + '仓',
                    type: 'lines',
                    zlevel: 1,
                    
                    effect: {
                        show: true,
                        period: 6,
                        trailLength: 0.7,
                        color: '#fff',
                        symbolSize: 3
                    },
                    lineStyle: {
                        normal: {
                            color: color[i],
                            width: 0,
                            curveness: 0.2
                        }
                    },
                    data: convertData(item[1])
                },
                {
                    name: item[0] + '仓',
                    type: 'lines',
                    zlevel: 2,
                    symbol: ['none', 'arrow'],
                    symbolSize: 10,
                    effect: {
                        show: true,
                        period: 6,
                        trailLength: 0,
                        symbol: planePath,
                        symbolSize: 15
                    },
                    lineStyle: {
                        normal: {
                            color: color[i],
                            width: 1,
                            opacity: 0.6,
                            curveness: 0.2
                        }
                    },
                    data: convertData(item[1])
                },
                {
                    name: item[0] + '仓',
                    type: 'effectScatter',
                    coordinateSystem: 'geo',
                    zlevel: 2,
                    rippleEffect: {
                        brushType: 'stroke'
                    },
                    label: {
                        normal: {
                            show: true,
                            position: 'right',
                            formatter: '{b}',
                            fontSize : 18
                        }
                    },
                    symbolSize: function (val) {
                        return val[2] / 8;
                    },
                    itemStyle: {
                        normal: {
                            color: color[i]
                        }
                    },
                    data: item[1].map(function (dataItem) {
                        return {
                            name: dataItem[1].name,
                            value: geoCoordMap[dataItem[1].name].concat([dataItem[1].value])
                        };
                    })
                });
        });

        option = {
            backgroundColor: '#000',
            title : {
                text: '',
                subtext: '',
                left: 'center',
                textStyle : {
                    color: '#fff',
                   
                }
            },
            tooltip : {
                trigger: 'item',
               
            },
            legend: {
                orient: 'vertical',
                top: 'top',
                left: 'left',
            //    data:['青岛', '内蒙商都', '杨凌','大凉山',"云南元江","广西","广东"],
                data:['青岛仓', '杨凌仓','大凉山仓','云南元江仓','广西仓','广东仓','内蒙商都仓'],
                textStyle: {
                    color: '#86c131',
                   fontSize : 16
                },
                selectedMode: 'single'
            },
            geo: {
                map: 'china',
                label: {
                    emphasis: {
                        show: false
                    }
                },
                roam: true,
                itemStyle: {
                    normal: {
                        areaColor: '#323c48',
                        borderColor: '#404a59'
                    },
                    emphasis: {
                        areaColor: '#2a333d'
                    }
                }
            },
            series: series
        };
        myChart.setOption(option);

    });
</script>


