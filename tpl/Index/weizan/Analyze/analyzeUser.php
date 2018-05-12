<!doctype html>

<html>

<head>

    <meta charset="utf-8">

    <style>

        /* css 代码  */

    </style>

    <script src="{pigcms{$static_public}js/jquery.min.js"></script>
    <script src="https://img.hcharts.cn/highcharts/highcharts.js"></script>

    <script src="https://img.hcharts.cn/highcharts/modules/exporting.js"></script>

    <script src="https://img.hcharts.cn/highcharts/themes/sand-signika.js"></script>

</head>

<body>

<div id="container" style="min-width:400px;height:400px"></div>
<div id="container2" style="min-width:400px;height:400px"></div>

<script>

    $(function () {
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '小农丁各省份用户统计表'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage} %</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        formatter: function() {
                            return this.point.name+Highcharts.numberFormat(this.percentage*this.total/100,0) +"人";
                        },
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: '统计图',
                data: [
                    <?php foreach ($content as $key=>$value) { ?>
                    <?php echo "[ '".$key."' , ".$value[0]['count']."],";  ?>

                    <?php } ?>

                ]
            }]
        });
    });


</script>



</body>

</html>

​
