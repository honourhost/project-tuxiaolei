<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>农丁头条</title>
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/public-toutiao.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/index-toutiao.css"/>
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}css/swiper.min-toutiao.css"/>
</head>
<body>
<!-- top浮动 -->
<div class="header-fixed">
    <div class="header-top">
        <span class="ruzhu" style="display: none;">企业入驻</span>
        <span class="logo"><img src="http://www.xiaonongding.com/tpl/Static/weizan/images/xnd_img/logo-phone.png" /></span>
        <div class="top-tab">
            <img src="{pigcms{$static_path}images/toutiao/r-nav.png" />
        </div>
    </div>

    <div class="header-nav">
        <ul class="nav-show">
            <if  condition="$nowcat eq 'all'">
                <li class="on">
                    <a href="{pigcms{:U('Toutiao/index')}">全部</a>
                </li>
                <else />
                <li >
                    <a href="{pigcms{:U('Toutiao/index')}">全部</a>
                </li>
                </if>

           <volist name="lists" id="item">
               <if  condition="$nowcat eq $item['cat_url']">
                   <li class="on">
                       <a href="{pigcms{:U('Toutiao/index',array('cat_id'=>$item['cat_url']))}">{pigcms{$item.name}</a>
                   </li>
                   <else />
                   <li >
                       <a href="{pigcms{:U('Toutiao/index',array('cat_id'=>$item['cat_url']))}">{pigcms{$item.name}</a>
                   </li>
               </if>

           </volist>
            <span class="show-btn"><img src="{pigcms{$static_path}images/toutiao/more-img.jpg" /></span>
        </ul>
        <ul class="more-nav">
            <if  condition="$nowcat eq 'all'">
                <li class="on">
                    <a href="{pigcms{:U('Toutiao/index')}">全部</a>
                </li>
                <else />
                <li >
                    <a href="{pigcms{:U('Toutiao/index')}">全部</a>
                </li>
            </if>

            <volist name="lists" id="item">
                <if  condition="$nowcat eq $item['cat_url']">
                    <li class="on">
                        <a href="{pigcms{:U('Toutiao/index',array('cat_id'=>$item['cat_url']))}">{pigcms{$item.name}</a>
                    </li>
                    <else />
                    <li >
                        <a href="{pigcms{:U('Toutiao/index',array('cat_id'=>$item['cat_url']))}">{pigcms{$item.name}</a>
                    </li>
                </if>

            </volist>
            <div class="clear-both"></div>
            <span class="hide-btn">
							<img src="{pigcms{$static_path}images/toutiao/header-top.jpg" />
						</span>
        </ul>
    </div>
</div>
<div style="width: 100%; height: 95px;"></div>
<div class="cen-main">
    <!-- 轮播图 -->
    <if condition="$nowcat eq 'all'">
        <div class="index-slide">
            <div class="swiper-container">
                <div class="swiper-wrapper">


                    <volist name="lunbo" id="lun">
                        <div class="swiper-slide">
                            <a href="{pigcms{$lun.url}">
                                <img src="{pigcms{$lun.pic}">
                                <div class="slide-bg">
                                    <h3>{pigcms{$lun.name}</h3>
                                </div>
                            </a>
                        </div>
                    </volist>

                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </if>


    <if condition="$nowcat eq 'all'">
        <!--灰色背景  独家、热门 -->
        <div class="dujia">
            <ul>
                <volist name="toptuijian" id="tuijian">
                    <li>
                        <a href="{pigcms{$tuijian.url}">
                            <i>推荐</i>
                            <h3>{pigcms{$tuijian.name}</h3>
                            <div class="dujia-img" style="background-image: url({pigcms{$tuijian.pic});"></div>
                            <div class="clear-both"></div>
                        </a>
                    </li>
                </volist>


            </ul>
        </div>
        </if>



    <!-- 话题 -->
    <div class="huati" style="display: none;">
        <ul>
            <li>
                <a href="#">
                    <h3><span>话题</span>获天力士千万美元融资的大象保险</h3>
                    <div class="huati-con">
                        <p>获天力士千万美元融资的大象保险，要做智能化保险服务平台,获天力士千万美元融资的大象保险，要做智能化保险服务平台</p>
                        <div class="huati-img" style="background-image: url(img/logo.jpg);"></div>
                    </div>
                </a>
                <div class="clear-both"></div>
                <div class="yuedu">
                    <a href="#"><span>点击订阅</span></a>
                    <b>899次阅读</b>
                    <b>6篇咨询</b>
                    <div class="clear-both"></div>
                </div>
                <div class="clear-both"></div>
            </li>
        </ul>
    </div>

    <!-- 带新闻图片 -->
    <div class="news-list">
        <ul>

         <volist name="content" id="onepage">

             <li>
                 <div class="new-cen">
                     <div class="list-times">
                         <span><?php echo date("y-m-d h:i:s",$onepage["dateline"]); ?></span>
                         <label>{pigcms{$onepage.author}</label>
                      <!--   <i>转载</i>-->
                     </div>
                     <a href="{pigcms{:U('Article/index',array('imid'=>$onepage['pigcms_id']))}">
                         <div class="list-con">
                             <h3 class="lf-title">{pigcms{$onepage.title}</h3>
                             <span style="background-image: url({pigcms{$onepage.cover_pic});"></span>
                         </div>
                     </a>
                     <div class="clear-both"></div>

                 </div>
             </li>
         </volist>
         <input name="pageIndex" value="1" style="display: none;">
        </ul>

    </div>


    <div class="clear-both"></div>
    <a class="click-more">点击查看更多</a>
</div>
<!-- 点击左侧更多按钮弹出框 -->
<div class="bg-main">

</div>
<div class="fl-nav">
    <ul>
        <if  condition="$nowcat eq 'all'">
            <li class="on">

                <a href="{pigcms{:U('Toutiao/index')}"><i><img src="{pigcms{$static_path}images/toutiao/icon-zixun.png" /></i>全部</a
            </li>
            <else />
            <li >
                <a href="{pigcms{:U('Toutiao/index')}"><i><img src="{pigcms{$static_path}images/toutiao/icon-zixun.png" /></i>全部</a
            </li>
        </if>

        <volist name="lists" id="item">
            <if  condition="$nowcat eq $item['cat_url']">
                <li class="on">
                    <a href="{pigcms{:U('Toutiao/index',array('cat_id'=>$item['cat_url']))}"><i><img src="{pigcms{$static_path}images/toutiao/icon-zixun.png" /></i>{pigcms{$item.name}</a>
                </li>
                <else />
                <li >
                    <a href="{pigcms{:U('Toutiao/index',array('cat_id'=>$item['cat_url']))}"><i><img src="{pigcms{$static_path}images/toutiao/icon-zixun.png" /></i>{pigcms{$item.name}</a
                </li>
            </if>

        </volist>

    </ul>
</div>

<script type="text/javascript">
    var shareData={
        imgUrl: "http://www.xiaonongding.com/xnd.png",
        link: "http://www.xiaonongding.com/wap.php?g=Wap&c=Toutiao&a=index&cat_id=all",
        title: "农丁头条",
        desc: "农丁头条 | 发现最新农业资讯，分享新农人创业故事 - 小农丁"
    };
</script>
<include file="Public:shares"/>
</body>
<script src="{pigcms{$static_path}js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>

<script>
    $(document).ready(function(){
        $(".show-btn").click(function(){
            $(".nav-show").hide();
            $(".more-nav").show();
        });
        $(".hide-btn").click(function(){
            $(".nav-show").show();
            $(".more-nav").hide();
        });
        $(".top-tab").click(function(){
            $(".bg-main").show();
            $(".fl-nav").show();
        });
        $(".bg-main").click(function(){
            $(".bg-main").hide();
            $(".fl-nav").hide();
        });
    });
</script>
<!-- 轮播图 -->
<script src="{pigcms{$static_path}js/swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        paginationClickable: true,
        loop: true,
        centeredSlides: true,
        autoplay: 2500,
        autoplayDisableOnInteraction: false

    });
</script>
<script>
    $(".click-more").click(
        function () {
            var lastPageIndex = $('input[name=pageIndex]:last').val();

            $.post("{pigcms{:U('Toutiao/nextpage')}",{pageIndex:lastPageIndex,cat_id:'{pigcms{$nowcat}'},function (data) {
                if(data){
                    $(".news-list").append(data);

                }else{
                    alert("没有内容啦");
                    $(".click-more").text("没有更多内容了");
                }

            })
            
        }
    );
</script>
</html>
