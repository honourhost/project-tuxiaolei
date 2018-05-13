<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <title>兔小蕾课堂</title>
    <link href="/tpl/Wap/default/Media/css/mui.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/tpl/Wap/default/Media/css/style.css" type="text/css"/>

    <script type="text/javascript">
        !function (J) {
            function H() {
                var d = E.getBoundingClientRect().width;
                var e = (d / 7.5 > 100 * B ? 100 * B : (d / 7.5 < 42 ? 42 : d / 7.5));
                E.style.fontSize = e + "px", J.rem = e
            }

            var G, F = J.document, E = F.documentElement, D = F.querySelector('meta[name="viewport"]'), B = 0, A = 0;
            if (D) {
                var y = D.getAttribute("content").match(/initial\-scale=([\d\.]+)/);
                y && (A = parseFloat(y[1]), B = parseInt(1 / A))
            }
            if (!B && !A) {
                var u = (J.navigator.appVersion.match(/android/gi), J.navigator.appVersion.match(/iphone/gi)),
                    t = J.devicePixelRatio;
                B = u ? t >= 3 && (!B || B >= 3) ? 3 : t >= 2 && (!B || B >= 2) ? 2 : 1 : 1, A = 1 / B
            }
            if (E.setAttribute("data-dpr", B), !D) {
                if (D = F.createElement("meta"), D.setAttribute("name", "viewport"), D.setAttribute("content", "initial-scale=" + A + ", maximum-scale=" + A + ", minimum-scale=" + A + ", user-scalable=no"), E.firstElementChild) {
                    E.firstElementChild.appendChild(D)
                } else {
                    var s = F.createElement("div");
                    s.appendChild(D), F.write(s.innerHTML)
                }
            }
            J.addEventListener("resize", function () {
                clearTimeout(G), G = setTimeout(H, 300)
            }, !1), J.addEventListener("pageshow", function (b) {
                b.persisted && (clearTimeout(G), G = setTimeout(H, 300))
            }, !1), H()
        }(window);
        if (typeof(M) == 'undefined' || !M) {
            window.M = {};
        }
    </script>
</head>
<body>
<div class="eva-header">
    <div class="mui-row">
        <div class="mui-col-sm-6 mui-col-xs-6">
            <li class="mui-table-view-cell current">
                <a href="/wap.php?g=Wap&c=Media&a=index">今日推荐</a>
            </li>
        </div>
        <div class="mui-col-sm-6 mui-col-xs-6">
            <li class="mui-table-view-cell">
                <a href="/wap.php?g=Wap&c=Media&a=index1">家长课堂</a>
            </li>
        </div>
    </div>
</div>
<div class="mui-content">
    <!--图片轮播-->
    <div id="slider" class="mui-slider">
        <div class="mui-slider-group mui-slider-loop">
            <volist name="lunbo" id="lun">
                <div class="mui-slider-item">
                    <a href="{pigcms{$lun.url}">
                        <img src="{pigcms{$lun.pic}">
                    </a>
                </div>
            </volist>
        </div>
        <div class="mui-slider-indicator">
            <div class="mui-indicator mui-active"></div>
            <div class="mui-indicator"></div>
            <div class="mui-indicator"></div>
            <div class="mui-indicator"></div>
        </div>
    </div>
    <!--列表-->
    <ul class="evaluation">


        <volist name="content" id="item">
            <li>
                <a href="{pigcms{:U('Article/index',array('imid'=>$item['pigcms_id']))}">
                    <div class="eva-pic">
                        <img src="{pigcms{$item.cover_pic}" style="height: 276px;"/>
                        <label>{pigcms{$item.count *11}
                            <small></small>
                        </label>
                    </div>
                    <div class="eva-text">
                        <h2>{pigcms{$item.name}</h2>
                        <p>{pigcms{$item.name}。{pigcms{$item.digest}</p>
                    </div>
                </a>
            </li>
        </volist>


    </ul>

    <div class="clear-both"></div>
    <p class="click-more" style="line-height: 80px; text-align: center">点击查看更多</p>


    <div class="h60">
        <p style="line-height: 40px;">兔小蕾线上教育平台</p>
    </div>
    <div class="eva-adv" style="display: none">
        <a href=""><img src="/tpl/Wap/default/Media/images/adv.png"/></a>
        <div class="close"><img src="/tpl/Wap/default/Media/images/close-white.png"/></div>
    </div>
</div>

<script type="text/javascript" src="/tpl/Wap/default/Media/js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="/tpl/Wap/default/Media/js/mui.min.js"></script>
<script type="text/javascript" src="/tpl/Wap/default/Media/js/app.js"></script>

<script>
    $(".click-more").click(
        function () {
            var lastPageIndex = $('input[name=pageIndex]:last').val();

            $.post("{pigcms{:U('Toutiao/nextpage')}", {
                pageIndex: lastPageIndex,
                cat_id: '{pigcms{$nowcat}'
            }, function (data) {
                if (data) {
                    $(".news-list").append(data);

                } else {
                    alert("没有内容啦");
                    $(".click-more").text("没有更多内容了");
                }

            })

        }
    );
</script>

</body>
</html>
