<include file="Jicai:header" />
<script type="text/javascript" src="{pigcms{$static_path}meal/js/dialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/scroller.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/dmain.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}meal/js/menu.js"></script>
<body onselectstart="return true;" ondragstart="return false;">
<script type="text/javascript">


    var islock=false;
    function next()
    {
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
<style>
    .menudesc{
        width: 100%;
        height: 30px;
        line-height: 30px;
        overflow: hidden;
    }
    #menuList .licontent > div{
        display: block;
    }
    .menudesc h3{
        float: left;
        display: inline-block;
        max-width: 120px;
        position: relative;
        left: -7px;
    }
    .menudesc p{
        float: right;
        display: inline-block;
        position: relative;
        top: -5px;
    }
    .menu .right{
        width:100%;
    }
    .salenum{
        padding-top: 0px;
        line-height: 20px;
    }
    .lf-img{
        float: left;
    }
    .price_wrap{
        float: right;
    }
</style>
<div data-role="container" class="container menu">
    <section data-role="body">

        <div class="right" id="usermenu">
            <div class="all" id="menuList">
                <if condition="!empty($jicais)">

                        <ul id="ul_type">
                            <volist name="jicais" id="meal">
                                <li id="dish_li{pigcms{$meal['group_id']}" >
                                <div class="licontent">
                                    <div class="menudesc showPop">
                                        <h3>{pigcms{$meal['name']}</h3>
                                        <p class="mylovedish"> <span class="icon hart"><input autocomplete="off" class="thisdid" type="hidden" value="{pigcms{$meal['group_id']}"></span></p>
                                        <p class="salenum">出售<span class="sale_num"> {pigcms{$meal['sale_count']} </span><span class="theunit"><if condition="!empty($meal[''])">{pigcms{$meal['']}<else/>份</if></span></p>
                                        <div class="info">{pigcms{$meal['intro']|htmlspecialchars_decode=ENT_QUOTES}</div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div class="span showPop lf-img">
                                        <if condition="!empty($meal['pic'])">
                                            <img src="{pigcms{$meal['pic']}" alt="" url="{pigcms{$meal['pic']}">
                                        </if>
                                    </div>
                                    <div class="price_wrap">
                                        <strong>￥<span class="unit_price">{pigcms{$meal['price']}<input type="hidden" class="tureunit_price" value="{pigcms{$meal['price']}"></span></strong>
                                        <div class="fr" max="-1">
                                            <a href="javascript:void(0);" class="btn plus" data-num="{pigcms{$meal['num']}"></a>
                                        </div>
                                        <input autocomplete="off" class="number" type="hidden" name="dish[{pigcms{$meal['group_id']}]" value="0">
                                    </div>
                                </div>
                                </li>
                            </volist>
                        </ul>

                </if>
            </div>
        </div>
    </section>
</div>
<footer data-role="footer">
    <nav class="g_nav">
        <div>
            <span class="cart"></span>
            <span> <span class="money">￥<label id="allmoney">0</label> </span>/<label id="menucount">0</label>个商品</span>
            <a href="javascript:next();" class="btn gray disabled" id="nextstep">选好了</a>
        </div>
    </nav>
</footer>

<div class="menu_detail" id="menuDetail">
    <img style="display: none;">
    <div class="nopic"></div>
    <a href="javascript:void(0);" class="comm_btn" id="detailBtn">来一份</a>
    <dl>
        <dt>价格：</dt>
        <dd class="highlight">￥<span class="price"></span></dd>
    </dl>
    <p class="sale_desc"></p>
    <dl class="desc">
        <dt>介绍：</dt>
        <dd class="info"></dd>
    </dl>
</div>

<script type="text/javascript">
    var shareData={
        imgUrl: "http://www.xiaonongding.com/xnd.png",
        link: "http://www.xiaonongding.com/wap.php?g=Wap&c=Jicai&a=index&mer_id=<?php echo $merid;?>",
        title: "农丁集采",
        desc: "农丁集采"
    };
</script>
<include file="Share:share"/>

</body>
</html>
