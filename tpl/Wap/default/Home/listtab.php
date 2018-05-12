<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <title>小农丁微信端</title>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}newwx/css/swiper.min.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}newwx/css/public.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}newwx/css/index.css" />



    <!--组件依赖css begin-->
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}newwx/css/widget/navigator/navigator.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}newwx/css/widget/navigator/navigator.iscroll.css" />
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}newwx/css/widget/navigator/navigator.default.css" /><!--皮肤文件，若不使用该皮肤，可以不加载-->
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}newwx/css/widget/navigator/navigator.iscroll.default.css" /><!--皮肤文件，若不使用该皮肤，可以不加载-->
    <!--组件依赖css end-->
    <!--组件依赖js begin-->
    <script type="text/javascript" src="{pigcms{$static_path}newwx/js/zepto.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}newwx/js/zepto.extend.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}newwx/js/zepto.ui.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}newwx/js/zepto.iscroll.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}newwx/js/widget/navigator.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}newwx/js/widget/navigator.iscroll.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}newwx/js/jquery-1.7.2.min.js"></script>
    <!--组件依赖js end-->
    <style>
        .banners img{
            max-width: 100%;
        }
    </style>
</head>
<body>
<div class="wx-body">
    <!-- header  fix start-->
    <div class="header">
        <div class="header-top">
            <div class="header-location">
                <i class="col-fff font14">全国</i>
                <img src="{pigcms{$static_path}newwx/img/icon-down.png" />
            </div>
            <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Search&a=index">
            <div class="top-select">
                <img src="{pigcms{$static_path}newwx/img/icon-select.png" />
                <i class="font14">农丁原浆</i>
            </div>
            </a>
        </div>
        <div id="nav-smartSetup">
            <ul>
                <volist name="hometabs" id="hometab" key="i">
                    <if condition="$i eq 1">
                        <li><a  href="{pigcms{:U('Home/demo')}">{pigcms{$hometab.title}</a><li>
                            <elseif  condition="$hometab.sliderid eq $sliderid"/>
                        <li><a class="cur" href="{pigcms{:U('Home/listtab',array('sliderid'=>$hometab['sliderid']))}">{pigcms{$hometab.title}</a><li>
                        <else />
                        <li><a href="{pigcms{:U('Home/listtab',array('sliderid'=>$hometab['sliderid'],'cat_url'=>$hometab['id']))}">{pigcms{$hometab.title}</a><li>
                    </if>

                </volist>

            </ul>
        </div>
    </div>

    <!-- header fix end -->
    <div style="width: 100%; height: 80px;"></div>
    <div class="banners">
    </div>
    <!-- 猜你喜欢 -->
    <div class="guess-rows">

        <div class="rows-list-more">
            <span class="more-line"></span>
            <ul>

            </ul>
            <div class="f-clear"></div>
            <a class="btn-more">加载更多</a>
            <div style="width: 100%; height: 20px;"></div>
        </div>
    </div>
    <div style="width: 100%; height: 50px;"></div>
    <!-- footer -->
    <div class="wx-footer">
        <ul>
            <li class="act">
                <a href="#">
                    <i><img src="{pigcms{$static_path}newwx/img/footer_home_active.png" /></i>
                    <h4>首页</h4>
                </a>
            </li>
            <li>
                <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=index">
                    <i><img src="{pigcms{$static_path}newwx/img/footer_group.png" /></i>
                    <h4>特卖</h4>
                </a>
            </li>
            <li>
                <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Groupbuy&a=index">
                    <i><img src="{pigcms{$static_path}newwx/img/footer_store.png" /></i>
                    <h4>农小拼</h4>
                </a>
            </li>
            <li>
                <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=My&a=index">
                    <i><img src="{pigcms{$static_path}newwx/img/footer_my.png" /></i>
                    <h4>我的</h4>
                </a>
            </li>
        </ul>

    </div>

</div>

</body>
<script>
    $(document).ready(function () {
        var caturl="{pigcms{$caturl}";
        var sliderid="{pigcms{$sliderid}";
        var page="{pigcms{$page}";
        $.ajax({url:"http://www.xiaonongding.com/api.php?g=api&c=newindex&a=searchMenulist&cat_url="+caturl+"&page="+page+"&sliderid="+sliderid}).done(function (result) {
            var re=JSON.parse(result);
            if(re.status!=1){
                alert("加载数据出错");
            }else{

                $.each(re.data,function (index, value) {
                    if(value.styleID=="banner_02"){
                        $(".banners").append(buildbanner02(value));

                    }else if(value.styleID=="menugoods_00"){
                        $(".rows-list-more ul").append(buildmenugoods(value));

                    }

                });

            }
        });

    });

    function buildbanner02(value) {
        var banner02html=" <a href=\""+"\"> <img src=\""+value.image+"\" /></a>";
        return banner02html;
    }

    function buildmenugoods(data) {
        var htmldata="";
        $.each(data.items,function (index, res) {
            htmldata+="  <li> <a href=\""+"http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id="+res.id+"\"> <div class=\"more-img\" style=\"background-image: url("+res.image+");\"> </div> <h3>"+res.title+"</h3> <p class=\"col-prc\">&yen;"+res.current_price+"<del>"+res.origin_price+"</del></p> <span>立即购买</span> </a> </li>";

        });
        return htmldata;
    }
</script>
<!-- 导航横向滚动 -->
<script type="text/javascript">
    (function () {
        window.$$=window.Zepto = Zepto;
        /*组件初始化js begin*/
        $$('#nav-smartSetup').navigator();    //smart setup方式创建 推荐方式
    })();
</script>
</html>
