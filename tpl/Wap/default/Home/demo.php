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
    <!--组件依赖js end-->
</head>

<body >
<div class="wx-body">
    <!-- header  fix start-->
    <div class="header">
        <div class="header-top">

            <div class="header-location">
                <i class="col-fff font14">青岛</i>
                <img src="{pigcms{$static_path}newwx/img/icon-down.png" />
            </div>
      
            <a href="http://www.xiaonongding.com/wap.php?g=Wap&c=Search&a=index">
            <div class="top-select">
                <img src="{pigcms{$static_path}newwx/img/icon-select.png" />
                <i class="font14 searchtext">农丁原浆</i>
            </div>
            </a>
        </div>
        <div id="nav-smartSetup">
            <ul>
                <volist name="hometabs" id="hometab" key="i">
                    <if condition="$i eq 1">
                        <li><a class="cur" href="{pigcms{:U('Home/demo')}">{pigcms{$hometab.title}</a><li>
                        <else />
                        <li><a href="{pigcms{:U('Home/listtab',array('sliderid'=>$hometab['sliderid'],'cat_url'=>$hometab['id']))}">{pigcms{$hometab.title}</a><li>
                    </if>

                </volist>

            </ul>
        </div>
    </div>
    <!-- header fix end -->
    <div style="width: 100%; height: 80px;"></div>
















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
<script type="text/javascript" src="{pigcms{$static_path}newwx/js/jquery-1.7.2.min.js"></script>
<!-- swiper public JS -->
<script src="{pigcms{$static_path}newwx/js/swiper.min.js"></script>
<script src="{pigcms{$static_path}newwx/js/jquery.vticker-min.js"></script>

<!-- 轮播图 Swiper -->
<!--<script>-->
<!--    var swiper = new Swiper('.swiper-container', {-->
<!--        pagination: '.swiper-pagination',-->
<!--        paginationClickable: true,-->
<!--        loop: true,-->
<!--    });-->
<!--</script>-->
<!-- 农场推荐 -->
<!--<script>-->
<!--    var swiper2 = new Swiper('.swiper-container2', {-->
<!--        pagination: '.swiper-pagination2',-->
<!--        slidesPerView: 'auto',-->
<!--        paginationClickable: true,-->
<!--        spaceBetween: 30,-->
<!--        loop: true,-->
<!--    });-->
<!--</script>-->

<script>
    $(document).ready(function () {
        $.ajax({url:"http://www.xiaonongding.com/api.php?g=Api&c=newindex&a=header&long=120&lat=36"}).done(function (result) {
          var re=JSON.parse(result);
          if(re.status!=1){
              alert("加载数据出错");
          }else{
              $(".searchtext").text(re.search_placeholder);

              $.each(re.data,function (index, value) {
                if(value.styleID=='slider_00'){
                    $(".wx-body").append(buildslider(value));
                    var swiper = new Swiper('.swiper-container', {
                        pagination: '.swiper-pagination',
                        paginationClickable: true,
                        loop: true,
                    });
                  }else if(value.styleID=='slider_01'){
                    $(".wx-body").append(buildslider1(value));

                        $('#news-container').vTicker({
                            speed: 500,
                            pause: 2000,
                            animation: 'fade',
                            mousePause: false,
                            showItems: 3
                        });
                        $('#news-container1').vTicker({
                            speed: 700,
                            pause: 4000,
                            animation: 'fade',
                            mousePause: false,
                            showItems: 1
                        });



                }else if(value.styleID=='classify_00'){
                    $(".wx-body").append(buildclassify0(value));

                }else if(value.styleID=='goodrecommend_00'){
                    $(".wx-body").append(buildgoodrecommend00(value));
                }else if(value.styleID=='classify_01'){
                    $(".wx-body").append(buildclassify01(value));
                  //  alert(buildclassify01(value));
                }else if(value.styleID=='farmrecommend_00'){
                    $(".wx-body").append(buildfarmrecommend00(value));
                    var swiper2 = new Swiper('.swiper-container2', {
                        pagination: '.swiper-pagination2',
                        slidesPerView: 'auto',
                        paginationClickable: true,
                        spaceBetween: 30,
                        loop: true,
                    });
                }

                  else{

                  }
              })
          }
        }).always(function () {
            $.ajax({url:"http://www.xiaonongding.com/api.php?g=api&c=newindex&a=getallgoods&page=1&limit=20"}).done(function (result) {
                var youlike=JSON.parse(result);
                if(youlike.status!=1){
                    console.error("加载猜你喜欢数据失败");
                }else{

                    $(".wx-body").append(buildyoulike(youlike.data));

                }

            });
            
        });

    });
          /**
           *顶部轮播
           * */
    function buildslider(data) {
var htmlslider="  <div class=\"wx-swiper\"> <div class=\"swiper-container\"> <div class=\"swiper-wrapper\">";
$.each(data.items,function (index, res) {
    htmlslider+=("  <div class=\"swiper-slide\"><a href='http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id="+res.link.id+"'> <img src=\""+res.image+"\" /> </a></div>");
});
htmlslider+= "<div class=\"swiper-pagination\"></div> </div> </div>";
return htmlslider;
    }

    /**
     * 跑马灯数据
     */
    function buildslider1(data) {

        var htmlslider1="<div class=\"wx-bulletin mag-bom-10\"> <div class=\"bulletin-icon\"> <img src=\"http://www.xiaonongding.com/tpl/Wap/default/static/newwx/img/icon-kuaibao.png\" /> </div> <div class=\"bulletin-con\"> <div id=\"news-container1\">  <ul>";
      //  var htmlslider1="	<div class=\"wx-bulletin mag-bom-10\"> <div class=\"bulletin-icon\"> <img src=\"http://www.xiaonongding.com/tpl/Wap/default/static/newwx/img/icon-kuaibao.png\" /> </div> <a href='"+"http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id="+data.items[0].link.id+"'><div class=\"bulletin-con\">"+data.items[0].title+" </div></a> </div>";
       $.each(data.items,function (index, res) {
           htmlslider1+="<li><a href=\""+"http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id="+res.link.id+"\">"+res.title+"</a></li>";
       });
       htmlslider1+=" </ul> </div> </div> </div>";
        return htmlslider1;
    }


    function buildclassify0(data) {
        var classify0html="  <div class=\"wx-ad mag-bom-10\" > " ;
        $.each(data.items,function (index, res) {
            if(index==0){
                classify0html+="<div class=\"ad-left\"> <a href=\""+"http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id="+res.id+"\"><img src=\""+res.image+"\" /></a><span class=\"line\"></span></div><div class=\"ad-right\">"
            }else{
                classify0html+=" <a href=\""+"http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id="+res.id+"\"><img src=\""+res.image+"\" /></a>"
            }
        });

        classify0html+=" </div> <div class=\"f-clear\"></div> </div>"


           return classify0html;
    }


    function buildgoodrecommend00(data) {
        var goodrecommendhtml="<div class=\"wx-recommend mag-bom-10\"> <div class=\"wx-title\"> <h3 class=\"col-tit font14\">"+data.title+"</h3> <p class=\"col-i font12\">"+data.subtitle+"</p> </div> <ul>";
        $.each(data.items,function (index, res) {
            goodrecommendhtml+=" <li> <a href=\""+"http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id="+res.link.id+"\"><img src=\""+res.image+"\" /></a> </li>";
        });
        goodrecommendhtml+="</ul> </div>";
        return goodrecommendhtml;

    }


    function buildclassify01(data) {
        var classify01html="<div class=\"wx-public-div mag-bom-10\" > <div class=\"wx-title\"> <h3 class=\"col-tit font14\">"+data.title+"</h3><p class=\"col-i font12\">"+data.subtitle+"</p> </div> <div class=\"public-rows\"> <div class=\"rows-banner\"><a href=\""+"http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id="+data.link.id+"\"> <img src=\""+data.image+"\" /> </div> <div class=\"rows-list\"> <ul>";
              $.each(data.items,function (index, res) {
                  classify01html+="<li> <a href=\""+"http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id="+res.id+"\"> <div class=\"row-img\"> <img src=\""+res.image+"\" /> </div> <h3 class=\"font14\">"+res.title+"</h3> <p class=\"font16 col-prc\">&yen;"+res.current_price+"</p> </a> </li>";
              });

              classify01html+="  </ul> <div class=\"f-clear\"></div> </div> </div> </div>";


              return classify01html;



    }


    function buildfarmrecommend00(data) {
        var farmrecommendhtml="<div class=\"wx-public-div mag-bom-10\"> <div class=\"wx-title\"> <h3 class=\"col-tit font14\">"+data.title+"</h3> <p class=\"col-i font12\">"+data.subtitle+"</p> </div> <div class=\"public-rows\"> <div class=\"tuijian\"> <div class=\"swiper-container2\"> <div class=\"swiper-wrapper\"> ";

           $.each(data.items,function (index, res) {
               farmrecommendhtml+="  <div class=\"swiper-slide\"> <div class=\"rows-fram\"> <div class=\"fram-img\"> <a href=\""+"http://www.xiaonongding.com/wap.php?g=Wap&c=Index&a=index&token="+res.id+"+\"><img src=\""+res.image+"\" /></a> </div>  <a href=\""+"http://www.xiaonongding.com/wap.php?g=Wap&c=Index&a=index&token="+res.id+"\"><div class=\"fram-title\"> <div class=\"titles\"> <h3>"+res.title+"</h3> <p>"+res.subtitle+"</p> </div> </div></a> </div> </div>";
           });
        farmrecommendhtml+="</div> </div> </div> </div> </div>";

           return farmrecommendhtml;
    }


    function  buildyoulike(data) {

        var youlikehtml="	<div class=\"guess-rows\"> <div class=\"wx-title\"> <h3 class=\"col-tit font14\">猜你喜欢</h3> <p class=\"col-i font12\">你不说，我都懂，你想吃，我全有</p> </div> <div class=\"rows-list-more\"> <span class=\"more-line\"></span> <ul>";
        $.each(data.items,function (index, res) {
          youlikehtml+="<li> <a href=\""+"http://www.xiaonongding.com/wap.php?g=Wap&c=Group&a=detail&group_id="+res.id+"\"> <div class=\"more-img\" style=\"background-image: url("+res.image +");\"> </div> <h3>"+res.title+"</h3> <p class=\"col-prc\">&yen;"+res.current_price+"<del>"+res.origin_price+"</del></p> <span>立即购买</span> </a> </li>";
        });
        youlikehtml+="</ul> <div class=\"f-clear\"></div> </div> </div> <div style=\"width: 100%; height: 50px;\"></div>";

        return youlikehtml;
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