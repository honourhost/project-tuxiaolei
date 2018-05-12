<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>农丁集采</title>
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telphone=no, email=no" />
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/jicai/css/tuan.css" />
    <link rel="stylesheet" href="{pigcms{$static_path}/jicai/css/idangerous.swiper.css?4.14">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/jicai/css/common22.css" media="all">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/jicai/css/color22.css" media="all">
    <!--组件依赖css begin-->
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/jicai/js/widget/navigator/navigator.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/jicai/js/widget/navigator/navigator.iscroll.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/jicai/js/widget/navigator/navigator.default2.css" />
    <!--皮肤文件，若不使用该皮肤，可以不加载-->
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/jicai/js/widget/navigator/navigator.iscroll.default.css" />
    <script type="text/javascript" src="{pigcms{$static_path}/jicai/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript">
        var islock = false;

        function next() {
            totalPrice = parseFloat($.trim($('#allmoney').text()));
            totalNum = parseInt($.trim($('#menucount').text()));
            if((totalNum>0) && (totalPrice>0)){
                var data=getMenuChecklist();//[{'id':id,'count':count},{'id':id,'count':count}]
                if((data.length>0) && !islock){
                    islock=true;
                    $('#nextstep').removeClass('orange show').addClass('gray disabled');
                    $.ajax({
                        type: "POST",
                        url: "{pigcms{:U('Jicai/processOrder', array('mer_id' => $mer_id))}",
                        data: {"cart":data},
                        async:true,
                        success: function(res){
                            islock=false;
                            $('#nextstep').removeClass('gray disabled').addClass('orange show');
                            if (res.error ==0) {
                                window.location.href = "{pigcms{:U('Jicai/sureorder', array('mer_id' => $mer_id))}";
                            } else {
                                alert(res.msg);
                            }
                        },
                        dataType: "json"
                    });
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

    </script>
    <script type="text/javascript" src="{pigcms{$static_path}/jicai/js/layer.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}/jicai/js/dialog.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}/jicai/js/scroller.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}/jicai/js/dmain2.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}/jicai/js/menu2.js"></script>
    <!--皮肤文件，若不使用该皮肤，可以不加载-->
    <!--组件依赖css end-->
    <!--组件依赖js begin-->
    <script type="text/javascript" src="{pigcms{$static_path}/jicai/js/zepto.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}/jicai/js/zepto.extend.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}/jicai/js/zepto.ui.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}/jicai/js/zepto.iscroll.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}/jicai/js/widget/navigator.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}/jicai/js/widget/navigator.iscroll.js"></script>
    <script src="{pigcms{$static_path}/jicai/js/idangerous.swiper.min.js"></script>
    <style>
        .top-b {
            width: 100%;
            height: 32px;
            line-height: 32px;
            font-size: 14px;
            position: relative;
            background: #EF7F2C;
        }

        .font-gd {
            width: 80%;
            margin-left: 10px;
            font-size: 12px;
        }

        .font-gd a {
            color: #fff;
        }

        .top-b img {
            position: absolute;
            width: 18px;
            height: 18px;
            right: 10px;
            top: 7px;
        }
    </style>

    <style>
        .switch-tab {
            height: 50px;
        }

        .switch-tab li a {
            height: 50px;
            line-height: 40px;
            font-size: 14px;
            color: #000;
            text-decoration: none;
            outline: none;
            font-family: arial, helvetica, sans-serif;
            font-weight: 100;
            text-align: center;
            float: left;
            margin: 0px 15px;
        }

        .ui-navigator .ui-navigator-list li {}

        .list-nav ul li.active {
            border-bottom: 3px solid #24ad65;
            color: #24ad65;
        }
        .list-nav ul li.active a{
            color: #24ad65;
            font-weight: bold;
        }
        .ui-navigator .ui-navigator-list li a.cur, .ui-navigator .ui-navigator-fix.cur{

        }
        #nav-smartSetup{
            background: #fff;
        }
    </style>
</head>
