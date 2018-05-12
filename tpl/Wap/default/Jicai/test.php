<include file="Jicai:headernew"/>
<body>

<div class="public-cen">
    <div class="wq-jicai-header">
        <span class="icon-index"><img src="{pigcms{$static_path}/jicai/img/icon-indexs.png"/></span>
        <span class="icon-logo"><img src="{pigcms{$static_path}/jicai/img/jc-logos.png"></span>
        <span class="icon-car"><a href="{pigcms{:U('My/jicai_buy_list')}"><img src="{pigcms{$static_path}/jicai/img/icon-mores.png"/></a></span>
    </div>
    <div class="pin-jieshao">
        <div class="swiper-container2">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="sl-img" style="background-image: url({pigcms{$static_path}/jicai/img/slide02.jpg);">

                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="sl-img" style="background-image: url({pigcms{$static_path}/jicai/img/slide03.jpg);">

                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="sl-img" style="background-image: url({pigcms{$static_path}/jicai/img/slide04.jpg);">

                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="sl-img" style="background-image: url({pigcms{$static_path}/jicai/img/slide05.jpg);">

                    </div>
                </div>
            </div>
            <!-- Add Pagination -->

            <div class="swiper-pagination2"></div>

        </div>

    </div>

    <!-- 今日推荐 -->
    <div class="day-pin">
        <span></span>
        <h3><b>今日推荐</b>生态美味白菜价抢回家</h3>
    </div>
    <!-- 三款推荐商品 -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <volist name="recommends" id="recommend" key="kkk">
                    <if condition="$kkk lt 4">
                        <a href="{pigcms{:U('Jicai/detail',array('groupid'=>$recommend['group_id']))}">
                            <div class="slide-list">
                                <div class="hot-img" style="background-image: url({pigcms{$recommend.list_pic});">

                                </div>
                                <h3 class="hot-title">{pigcms{$recommend.name}</h3>
                                <div class="hot-fot">
                                    <div class="left hot-price">
                                        <h3>&yen;{pigcms{$recommend.price}</h3>
                                        <span></span>
                                    </div>
                                    <span class="hot-btn" style="background-color:#24ad65;">立即抢</span>
                                    <div style="clear: both;"></div>
                                </div>
                                <span class="hot-line"></span>
                            </div>
                        </a>
                    </if>
                </volist>
            </div>
            <div class="swiper-slide">
                <volist name="recommends" id="recommend" key="kkk">
                    <if condition="$kkk gt 3">
                        <a href="{pigcms{:U('Jicai/detail',array('groupid'=>$recommend['group_id']))}">
                            <div class="slide-list">
                                <div class="hot-img" style="background-image: url({pigcms{$recommend.list_pic});">

                                </div>
                                <h3 class="hot-title">{pigcms{$recommend.name}</h3>
                                <div class="hot-fot">
                                    <div class="left hot-price">
                                        <h3>&yen;{pigcms{$recommend.price}</h3>
                                        <span></span>
                                    </div>
                                    <span class="hot-btn" style="background-color:#24ad65;">立即抢</span>
                                    <div style="clear: both;"></div>
                                </div>
                                <span class="hot-line"></span>
                            </div>
                        </a>
                    </if>
                </volist>
            </div>

        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- 推荐活动 -->
    <div class="day-pin" style="margin-top: 10px;">
        <span></span>
        <h3><b>推荐活动</b>达人精选产品邀您直接参团</h3>
    </div>
    <div class="pin-tuijian">
        <ul>
            <li>
                <a href="#"><img src="{pigcms{$static_path}/jicai/img/banner-img01.jpg"/></a>
            </li>
            <li>
                <a href="#"><img src="{pigcms{$static_path}/jicai/img/banner-img02.jpg"/></a>
            </li>
        </ul>
        <div style="clear: both;"></div>
        <div class="index-guanggao">
            <img src="{pigcms{$static_path}/jicai/img/index-guanggao.jpg"/>
        </div>
    </div>

    <a name="fenlei"></a>
    <!-- 新增 -->


    <div data-role="container" class="container">
        <section data-role="body">


            <div class="list-nav">
                <div class="navs" id="nav-smartSetup">
                    <ul class="switch-tab">
                        <volist name="jicaicates" id="jicais" key="kk">
                            <if condition="$kk eq 1">
                                <li class="active mytab" data="{pigcms{$jicais.sort_id}">
                                    <a href="javascript:; " class="cur">{pigcms{$jicais.sort_name}</a>
                                </li>
                                <else/>
                                <li class="mytab" data="{pigcms{$jicais.sort_id}">
                                    <a href="javascript:; " class="cur">{pigcms{$jicais.sort_name}</a>
                                </li>
                            </if>

                        </volist>

                    </ul>
                </div>
            </div>
            <div class="right" id="usermenu" style="background: #fff;">

                <div class="tab-content">
                    <volist name="jicaicates" id="jicais">
                        <div class="tab-panel" id="cpxq">
                            <div class="all" id="menuList">
                                <ul id="ul_type284">


                                    <volist name="jicais.jicais" id="jjs">
                                        <li id="dish_li{pigcms{$jjs.group_id}">
                                            <div class="cen">
                                                <div class="list-imgs shop-img"
                                                     style="background-image: url({pigcms{$jjs.list_pic});">
                                                    <input type="hidden" class="goodprice" value="{pigcms{$jjs.price}">
                                                    <input type="hidden" class="goodname" value="{pigcms{$jjs.name}">
                                                    <input type="hidden" class="gooddigest" value="{pigcms{$jjs.intro}">
                                                    <input type="hidden" class="goodimage"
                                                           value="{pigcms{$jjs.list_pic}">
                                                </div>
                                                <div class="list-cons">
                                                    <div class="left-right">

                                                        <h5 class="list-imgs">{pigcms{$jjs.name} <input type="hidden"
                                                                                                        class="goodprice"
                                                                                                        value="{pigcms{$jjs.price}">
                                                            <input type="hidden" class="goodname"
                                                                   value="{pigcms{$jjs.name}">
                                                            <input type="hidden" class="gooddigest"
                                                                   value="{pigcms{$jjs.intro}">
                                                            <input type="hidden" class="goodimage"
                                                                   value="{pigcms{$jjs.list_pic}"></h5>
                                                        <p>{pigcms{$jjs.s_name}</p>
                                                        <div class="price_wrap">
                                                            <strong><span
                                                                        class="unit_price">&yen;{pigcms{$jjs.price}                                                <input
                                                                            type="hidden" class="tureunit_price"
                                                                            value="{pigcms{$jjs.price}"></span>
                                                                <del>&yen;49.00</del>
                                                            </strong>
                                                            <input autocomplete="off" class="thisdid" type="hidden"
                                                                   value="{pigcms{$jjs.group_id}">
                                                            <div class="price_wrap2">
                                                                <div class="fr" max="-1">
                                                                    <a href="javascript:void(0);" class="btn plus"
                                                                       data-num="0"></a>
                                                                </div>
                                                                <input autocomplete="off" class="number" type="hidden"
                                                                       name="dish[{pigcms{$jjs.group_id}]" value="0">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div style="clear: both;"></div>
                                                </div>
                                            </div>
                                        </li>
                                    </volist>
                                </ul>

                            </div>
                        </div>
                    </volist>


                </div>
                <div class="alert-div">
                    <div class="alert-bg"></div>
                    <div class="dialog mask">
                        <div class="dialog_wrap">
                            <div class="dialog_tt">壹加壹带骨腹肉1kg</div>
                            <a href="javascript:void(0);" class="dialog_close"></a>
                            <div class="dialog_scroller" style="height: 398px;">
                                <div class="menu_detail dialog_content" id="menuDetail" style="display: block;">
                                    <img style="" class="alertimage" src="http://www.xiaonongding.com/xnd.png">
                                    <div class="nopic" style="display: none;"></div>

                                    <dl>
                                        <dt>价格：</dt>
                                        <dd class="highlight">￥<span class="price">166.00</span></dd>
                                    </dl>
                                    <p class="sale_desc"></p>
                                    <dl class="desc">
                                        <dt>介绍：</dt>
                                        <dd class="info">
                                            位于牛胸腹部，第2肋-第5肋。主要由肋间内肌、肋间外肌、腹外斜肌等肌肉组织。带骨腹肉又称：小牛排、牛仔骨肌间有脂肪，有筋膜层，表面有不均匀脂肪覆盖。用作火锅切片、韩式牛排火锅、韩式烤肉及西餐牛排。
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <style>
                    .list-img {
                        width: 100%;
                        display: block;
                        font-size: 0;
                    }

                    .list-img img {
                        width: 100%;
                    }
                </style>
                <div class="list-img">
                    <img src="{pigcms{$static_path}/jicai/img/list-footer.png">
                </div>
                <div style="width: 100%; height: 39px;"></div>
            </div>

        </section>

    </div>

    <footer data-role="footer">
        <nav class="g_nav">
            <div>
                <span class="cart"></span>
                <span> <span class="money">￥<label id="allmoney">0</label> </span>/<label
                            id="menucount">0</label>个商品</span>
                <a href="javascript:next();" class="btn gray disabled" id="nextstep">选好了</a>
            </div>
        </nav>
    </footer>

    <input type="hidden" class="nowmoney" value="123089.41">
    <script>
        $(document).ready(function () {
            $(".list-imgs").on("click", function () {
                var price = $(this).children(".goodprice").val();
                var title = $(this).children(".goodname").val();
                var digest = $(this).children(".gooddigest").val();
                var image = $(this).children(".goodimage").val();
                $(".dialog_tt").text(title);
                $(".price").text(price);
                $(".info").text(digest);
                $(".alertimage").attr("src", image);
                $('.alert-div').show();
            });
            $(".alert-bg").click(function () {
                $('.alert-div').hide();
            });
        });
    </script>

    <script>
        $(function () {
            var a = $('.navs'),
                b = a.offset();
            $(document).on('scroll', function () {
                var c = $(document).scrollTop();
                if (b.top <= c) {
                    a.css({'position': 'fixed', 'top': '0px', 'z-index': '100', 'width': '100%',})
                } else {
                    a.css({'position': 'absolute', 'top': '0px', 'width': '100%'})
                }
            })
        })
    </script>
    <script>
        $(document).ready(function () {
            $('.switch-tab>li').click(function () {
                var s = $('.switch-tab>li').index(this);
                $('body,html').animate({scrollTop: $('.tab-content>.tab-panel:eq(' + s + ')').offset().top - 45}, 200);
            });
            var DT = $('.switch-tab').offset().top;
            $(window).scroll(function () {
                var wt = $(window).scrollTop(),
                    l = $('.tab-content>.tab-panel'),
                    s = l.length - 1;
                if (wt < DT || wt >= l.last().offset().top + l.last().height() + 45) {
                    $('.switch-tab').removeClass('fixed');
                    $('.switch-tab>li:first').addClass('active').siblings().removeClass('active');
                } else {
                    $('.switch-tab').addClass('fixed');
                    for (var i = 0; i < s; i++) {
                        if (wt >= parseInt(l.eq(i).offset().top - 45) && wt < parseInt(l.eq(i + 1).offset().top - 45)) {
                            s = i;
                            break;
                        }
                    }
                    $('.switch-tab>li:eq(' + s + ')').addClass('active').siblings().removeClass('active');
                }
            });
        });
    </script>
    <script type="text/javascript">
        var shareData = {
            imgUrl: "http://www.xiaonongding.com/jicai.jpg",
            link: "http://www.xiaonongding.com/wap.php?g=Wap&c=Jicai&a=test&mer_id=1137",
            title: "农丁集采",
            desc: "专注原生态绿色健康蔬果生鲜一站式食材采购配送服务"
        };
    </script>
    <include file="Share:share"/>
    <script type="text/javascript">
        window.$$ = window.Zepto = Zepto;
        (function () {
            /*组件初始化js begin*/
            $$('#nav-smartSetup').navigator(); //smart setup方式创建 推荐方式
        })();
    </script>
</div>

<script>
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        pagination: '.swiper-pagination',
        paginationClickable: true,
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: 4000,

    });
</script>
<!-- 滑动板块 -->

<script>
    $(window).scroll(function () {
        var h_num = $(window).scrollTop();
        if (h_num > 750) {
            $(".tuan-nav").css("position", "fixed");
        } else {
            $(".tuan-nav").css("position", "initial");
        }
    });
</script>
<SCRIPT type=text/javascript>
    function selectTag(showContent, selfObj) {
        // 操作标签
        var tag = document.getElementById("tags").getElementsByTagName("li");
        var taglength = tag.length;
        for (i = 0; i < taglength; i++) {
            tag[i].className = "";
        }
        selfObj.parentNode.className = "selectTag";
        // 操作内容
        for (i = 0; j = document.getElementById("tagContent" + i); i++) {
            j.style.display = "none";
        }
        document.getElementById(showContent).style.display = "block";

    }
</SCRIPT>
<script>
    var swiper = new Swiper('.swiper-container2', {
        pagination: '.swiper-pagination2',
        paginationClickable: true,
        spaceBetween: 30,
        loop: true,
    });
</script>
</body>

</html>