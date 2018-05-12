<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/vip/common22.css" media="all">
    <link rel="stylesheet" type="text/css" href="{pigcms{$static_path}/vip/color22.css" media="all">
    <script type="text/javascript" src="{pigcms{$static_path}/vip/jquery_min.js"></script>
    <script type="text/javascript" src="{pigcms{$static_path}vip/layer.js"></script>
    <title>商品兑换</title>
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <!-- Mobile Devices Support @begin -->
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- apple devices fullscreen -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- Mobile Devices Support @end -->
</head>
<style type="text/css">
    #dingcai_adress_info {
        border-top: 1px solid #ddd8ce;
        border-bottom: 1px solid #ddd8ce;
        position: relative;
    }

    #dingcai_adress_info:after {
        position: absolute;
        right: 8px;
        top: 50%;
        display: block;
        content: '';
        width: 13px;
        height: 13px;
        border-left: 3px solid #999;
        border-bottom: 3px solid #999;
        -webkit-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
        -moz-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
        -ms-transform: translateY(-50%) scaleY(0.7) rotateZ(-135deg);
    }

    #enter_im_div {
        bottom: 121px;
        z-index: 11;
        display: none;
        position: fixed;
        width: 100%;
        max-width: 640px;
        height: 1px;
    }

    #enter_im {
        width: 94px;
        margin-left: 110px;
        position: relative;
        left: -100px;
        display: block;
    }

    a {
        color: #323232;
        outline-style: none;
        text-decoration: none;
    }

    #to_user_list {
        height: 30px;
        padding: 7px 6px 8px 8px;
        background-color: #00bc06;
        border-radius: 25px;
        /* box-shadow: 0 0 2px 0 rgba(0,0,0,.4); */
    }

    #to_user_list_icon_div {
        width: 20px;
        height: 16px;
        background-color: #fff;
        border-radius: 10px;
    }

    .rel {
        position: relative;
    }

    .left {
        float: left;
    }

    .to_user_list_icon_em_a {
        left: 4px;
    }

    #to_user_list_icon_em_num {
        background-color: #f00;
    }

    #to_user_list_icon_em_num {
        width: 14px;
        height: 14px;
        border-radius: 7px;
        text-align: center;
        font-size: 12px;
        line-height: 14px;
        color: #fff;
        top: -14px;
        left: 68px;
    }

    89076208 .hide {
                 display: none;
             }

    .abs {
        position: absolute;
    }

    .to_user_list_icon_em_a,
    .to_user_list_icon_em_b,
    .to_user_list_icon_em_c {
        width: 2px;
        height: 2px;
        border-radius: 1px;
        top: 7px;
        background-color: #00ba0a;
    }

    .to_user_list_icon_em_a {
        left: 4px;
    }

    .to_user_list_icon_em_b {
        left: 9px;
    }

    .to_user_list_icon_em_c {
        right: 4px;
    }

    .to_user_list_icon_em_d {
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 4px;
        top: 14px;
        left: 6px;
        border-color: #fff transparent transparent transparent;
    }

    #to_user_list_txt {
        color: #fff;
        font-size: 13px;
        line-height: 16px;
        padding: 1px 3px 0 5px;
    }
    .all ul{
			margin-bottom: 20px;
			width: 86%;
			margin: 0px auto;
		}
		.all ul li{
			background: #fff;
			margin-bottom: 15px;
		}
</style>
<script type="text/javascript" src="{pigcms{$static_path}/vip/dialog.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}/vip/scroller.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}/vip/dmain.js"></script>
<script type="text/javascript" src="{pigcms{$static_path}/vip/menu.js"></script>

<body onselectstart="return true;" ondragstart="return false;">
<script type="text/javascript">

    var islock = false;

    function next() {
        totalPrice = parseFloat($.trim($('#allmoney').text()));
        totalNum = parseInt($.trim($('#menucount').text()));
        if((totalNum > 0) && (totalPrice > 0)) {
            var data = getMenuChecklist(); //[{'id':id,'count':count},{'id':id,'count':count}]
            if((data.length > 0) && !islock) {
                islock = true;
                $('#nextstep').removeClass('orange show').addClass('gray disabled');
                $.ajax({
                    type: "POST",
                    url: "/wap.php?g=Wap&c=Vip&a=processOrder&mer_id=629",
                    data: { "cart": data },
                    async: true,
                    success: function(res) {
                        islock = false;
                        $('#nextstep').removeClass('gray disabled').addClass('orange show');
                        if(res.error == 0) {
                            window.location.href = "/wap.php?g=Wap&c=Vip&a=sureorder&mer_id=629";
                        } else {
                            alert(res.msg);
                        }
                    },
                    dataType: "json"
                });
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
</script>
<style>
			body{
				background: #665b69;
			}
			.menudesc {
				width: 100%;
				height: 36px;
				line-height: 36px;
				overflow: hidden;
			}
			
			#menuList .licontent>div {
				display: block;
			}
			
			.menudesc h3 {
				float: left;
				display: inline-block;
				max-width: 100%;
				position: relative;
				left: -7px;
				font-size: 16px;
				font-weight: 100;
			}
			
			.menudesc p {
				float: right;
				display: inline-block;
				position: relative;
				top: -5px;
			}
			
			.salenum {
				padding-top: 0px;
				line-height: 20px;
			}
			
			.lf-img {
				float: left;
			}
			
			.price_wrap2 {
				width: 85px;
				float: right;
				margin: 0px auto;
			}
			
			.list-imgs {
				width: 100%;
				height: 230px;
				background-position: 50% 50%;
				background-repeat: no-repeat;
				background-size: cover;
			}
			
			.list-cons {
				margin: 0px 10px;
				margin-top: 15px;
				padding-bottom: 15px;
			}
			
			.list-left {
				float: left;
			}
			
			.list-left img {
				width: 130px;
				height: 130px;
				overflow: hidden;
			}
			
			.left-right {
				float: right;
				width: 51%;
				text-align: center;
				position: relative;
				top: 10px;
			}
			
			.left-right h4 {
				font-size: 16px;
				color: #000;
				height: 20px;
				line-height: 20px;
				overflow: hidden;
			}
			.left-right h5{
				font-size: 16px;
				height: 20px;
				overflow: hidden;
				line-height: 20px;
				color: #000;
			}
			.left-right p{
				height: 16px;
				font-size: 12px;
				line-height: 16px;
				overflow: hidden;
			}
			@media screen and (max-width: 320px) {
				.list-left img {
				width: 120px;
				height: 120px;
				overflow: hidden;
			   }
				.left-right {
					float: right;
					width: 50%;
					text-align: center;
					position: relative;
				}
				.left-right h4 {
				font-size: 15px;
				color: #000;
				height: 20px;
				line-height: 20px;
				overflow: hidden;
			}
			.left-right h5{
				font-size: 15px;
				height: 20px;
				overflow: hidden;
				line-height: 20px;
				color: #000;
			}
			}
			.banner-top {
				width: 100%;
			}
			
			.banner-top img {
				width: 100%;
				display: block;
				
			}
			
			.list-nav {
				width: 100%;
				height: 45px;
				background: #fff;
			}
			
			.list-nav ul li {
				float: left;
				width: 33.333%;
				text-align: center;
				height: 45px;
				line-height: 45px;
				text-align: center;
			}
			
			.list-nav ul li a {
				display: block;
				width: 100%;
				font-size: 16px;
			}
			.fix{
				position: fixed;
				left: 0;
				top: 0;
				width: 100%;
				height: 45px;
				z-index: 10000;
				background: #fff;
			}
			.list-nav li.on{
				background: #fead78;
				
			}
			.list-nav li.on a{
				color: #fff;
			}
			.nav-banner{
				width: 100%;
				margin-bottom: 15px;
			}
			.nav-banner img{
				width: 100%;
			}
		</style>
<div data-role="container" class="container">
    <section data-role="body">
    	<div class="banner-top">
			<img src="{pigcms{$static_path}vip/list-banner.jpg" />
		</div>
		<div class="list-nav" style="display: none;">
			<ul>
				<li class="on">
					<a href="#fenlei01">肉类</a>
				</li>
				<li>
					<a href="#fenlei02">菌类</a>
				</li>
				<li>
					<a href="#fenlei03">饮品类</a>
				</li>
			</ul>
		</div>
        <div class="right" id="usermenu">
            <div class="all" id="menuList">
            	<a name="fenlei01"></a>
            	<div class="nav-banner">
					<img src="{pigcms{$static_path}vip/nav01.jpg"  style="display: none;"/>
				</div>
                <ul id="ul_type284">
                	
                    <li id="dish_li2953">
                            <div class="list-imgs" style="background-image: url(http://www.xiaonongding.com/tpl/Wap/default/static/vip/goods-img01.jpg);">
                                <input type="hidden" class="goodprice" value="198.00">
                                <input type="hidden" class="goodname" value="壹加壹带骨腹肉1kg">
                                <input type="hidden" class="gooddigest" value="位于牛胸腹部，第2肋-第5肋。主要由肋间内肌、肋间外肌、腹外斜肌等肌肉组织。带骨腹肉又称：小牛排、牛仔骨肌间有脂肪，有筋膜层，表面有不均匀脂肪覆盖。用作火锅切片、韩式牛排火锅、韩式烤肉及西餐牛排。">
                                <input type="hidden" class="goodimage" value="http://www.xiaonongding.com/tpl/Wap/default/static/vip/goods-img01.jpg">
                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="http://www.xiaonongding.com/tpl/Wap/default/static/vip/goods-icon-01.jpg" />
                                </div>
                                <div class="left-right">
                                    <h4>壹加壹牛肉</h4>
										<h5>增肌强身精选带骨腹肉</h5>
										<p >第2肋-第5肋</p>
                                    <div class="price_wrap">
                                        <strong>&yen;<span class="unit_price">198<i >.00</i><input type="hidden" class="tureunit_price" value="198.00"><b>会员品鲜价</b></span>
                                            <del>&yen;:268.00</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="2953">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[2953]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li><li id="dish_li2954">
                            <div class="list-imgs" style="background-image: url(http://www.xiaonongding.com/upload/group/000/000/890/s_59803f3936688.jpg);">
                                <input type="hidden" class="goodprice" value="398.00">
                                <input type="hidden" class="goodname" value="壹加壹雪花牛肉家庭套餐礼盒">
                                <input type="hidden" class="gooddigest" value=" 所有肉品都是A3、A2以上级别的雪花牛肉，家庭套餐内的雪花牛肉适合亲们在自家厨房煎、炒、烹、炸，还可以包饺子哦。雪花牛肉比起普通牛肉口感上有很大的差别，瘦而不柴、肥而不腻。">
                                <input type="hidden" class="goodimage" value="http://www.xiaonongding.com/upload/group/000/000/890/s_59803f3936688.jpg">
                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="http://www.xiaonongding.com/upload/group/000/000/890/59804670370d5.jpg" />
                                </div>
                                <div class="left-right">
                                    <h4 style="display: none;">壹加壹牛肉</h4>
										<h5>壹加壹雪花牛肉家庭套餐礼盒</h5>
										<p > 所有肉品都是A3、A2以上级别的雪花牛肉，家庭套餐内的雪花牛肉适合亲们在自家厨房煎、炒、烹、炸，还可以包饺子哦。雪花牛肉比起普通牛肉口感上有很大的差别，瘦而不柴、肥而不腻。</p>
                                    <div class="price_wrap">
                                        <strong>&yen;<span class="unit_price">398<i >.00</i><input type="hidden" class="tureunit_price" value="398.00"><b>会员品鲜价</b></span>
                                            <del>&yen;:599.00</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="2954">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[2954]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li><li id="dish_li2955">
                            <div class="list-imgs" style="background-image: url(http://www.xiaonongding.com/upload/group/000/000/890/s_5980506e952b2.jpg);">
                                <input type="hidden" class="goodprice" value="388.00">
                                <input type="hidden" class="goodname" value="盐池滩羊-精分割大排1600g  ">
                                <input type="hidden" class="gooddigest" value="盐池滩羊国家农牧局保育品种（古老的土种羊），盐池地属灰钙土半干旱草原，生产茎类植物被称为“甘草之乡”，据权威部门检测唯一一款偏弱碱性羊肉，肉质腥膻味轻，不弹牙，胆固醇含量相比其它羊肉最低，经科学家研究羊肉溶点为43度，高于人体温度，所以不会被人体所吸收，更不用担心发胖问题。大排可以煲汤 ，原味手抓，烤。">
                                <input type="hidden" class="goodimage" value="http://www.xiaonongding.com/upload/group/000/000/890/s_5980506e952b2.jpg">
                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="http://www.xiaonongding.com/upload/group/000/000/890/59707eaae9cfb.jpg" />
                                </div>
                                <div class="left-right">
                                    <h4 style="display: none;">壹加壹牛肉</h4>
										<h5>盐池滩羊-精分割大排1600g  </h5>
										<p >盐池滩羊国家农牧局保育品种（古老的土种羊），盐池地属灰钙土半干旱草原，生产茎类植物被称为“甘草之乡”，据权威部门检测唯一一款偏弱碱性羊肉，肉质腥膻味轻，不弹牙，胆固醇含量相比其它羊肉最低，经科学家研究羊肉溶点为43度，高于人体温度，所以不会被人体所吸收，更不用担心发胖问题。大排可以煲汤 ，原味手抓，烤。</p>
                                    <div class="price_wrap">
                                        <strong>&yen;<span class="unit_price">388<i >.00</i><input type="hidden" class="tureunit_price" value="388.00"><b>会员品鲜价</b></span>
                                            <del>&yen;:458.00</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="2955">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[2955]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li><li id="dish_li2957">
                            <div class="list-imgs" style="background-image: url(http://www.xiaonongding.com/upload/group/000/000/890/s_59715d57571c1.jpg);">
                                <input type="hidden" class="goodprice" value="99.00">
                                <input type="hidden" class="goodname" value="小蘑菇光伏灵芝切片 3*60g">
                                <input type="hidden" class="gooddigest" value="《神农本草经》中记载灵芝乃上上之药，灵芝含大量有机锗、多醣体和三萜类，其中有机锗含量比人参还高出4-6倍。能有效增强人体免疫力，改善亚健康体质，且无任何毒副作用。">
                                <input type="hidden" class="goodimage" value="http://www.xiaonongding.com/upload/group/000/000/890/s_59715d57571c1.jpg">
                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="http://www.xiaonongding.com/upload/group/000/000/890/597ad142ca4e4.jpg" />
                                </div>
                                <div class="left-right">
                                    <h4 style="display: none;">壹加壹牛肉</h4>
										<h5>小蘑菇光伏灵芝切片 3*60g</h5>
										<p >《神农本草经》中记载灵芝乃上上之药，灵芝含大量有机锗、多醣体和三萜类，其中有机锗含量比人参还高出4-6倍。能有效增强人体免疫力，改善亚健康体质，且无任何毒副作用。</p>
                                    <div class="price_wrap">
                                        <strong>&yen;<span class="unit_price">99<i >.00</i><input type="hidden" class="tureunit_price" value="99.00"><b>会员品鲜价</b></span>
                                            <del>&yen;:139.00</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="2957">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[2957]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li><li id="dish_li2969">
                            <div class="list-imgs" style="background-image: url(http://www.xiaonongding.com/upload/group/000/000/890/s_5972ec473ecc7.jpg);">
                                <input type="hidden" class="goodprice" value="430.00">
                                <input type="hidden" class="goodname" value="香格里拉新鲜松茸500g">
                                <input type="hidden" class="gooddigest" value="500g  7cm-12cm出口级一级品/500g ">
                                <input type="hidden" class="goodimage" value="http://www.xiaonongding.com/upload/group/000/000/890/s_5972ec473ecc7.jpg">
                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="http://www.xiaonongding.com/upload/group/000/000/890/597ad063e06aa.jpg" />
                                </div>
                                <div class="left-right">
                                    <h4 style="display: none;">壹加壹牛肉</h4>
										<h5>香格里拉新鲜松茸500g</h5>
										<p >500g  7cm-12cm出口级一级品/500g </p>
                                    <div class="price_wrap">
                                        <strong>&yen;<span class="unit_price">430<i >.00</i><input type="hidden" class="tureunit_price" value="430.00"><b>会员品鲜价</b></span>
                                            <del>&yen;:566.00</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="2969">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[2969]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li><li id="dish_li2970">
                            <div class="list-imgs" style="background-image: url(http://www.xiaonongding.com/upload/group/000/000/890/s_59759afc2ec61.jpg);">
                                <input type="hidden" class="goodprice" value="138.00">
                                <input type="hidden" class="goodname" value="四川大凉山猴头菇500g">
                                <input type="hidden" class="gooddigest" value="猴头菇又叫猴头菌，只因外形酷似猴头而得名。又因像刺猬，故又有“刺猬菌”之称。猴蘑、猴头、猴菇，都是中国传统的名贵菜肴，肉嫩、味香、鲜美可口。">
                                <input type="hidden" class="goodimage" value="http://www.xiaonongding.com/upload/group/000/000/890/s_59759afc2ec61.jpg">
                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="http://www.xiaonongding.com/upload/group/000/000/890/59759bbf4cf5f.jpg" />
                                </div>
                                <div class="left-right">
                                    <h4 style="display: none;">壹加壹牛肉</h4>
										<h5>四川大凉山猴头菇500g</h5>
										<p >猴头菇又叫猴头菌，只因外形酷似猴头而得名。又因像刺猬，故又有“刺猬菌”之称。猴蘑、猴头、猴菇，都是中国传统的名贵菜肴，肉嫩、味香、鲜美可口。</p>
                                    <div class="price_wrap">
                                        <strong>&yen;<span class="unit_price">138<i >.00</i><input type="hidden" class="tureunit_price" value="138.00"><b>会员品鲜价</b></span>
                                            <del>&yen;:268.00</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="2970">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[2970]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li><li id="dish_li2971">
                            <div class="list-imgs" style="background-image: url(http://www.xiaonongding.com/upload/group/000/000/890/s_5972f1dd75a07.jpg);">
                                <input type="hidden" class="goodprice" value="219.00">
                                <input type="hidden" class="goodname" value="青岛农丁原浆啤酒20斤">
                                <input type="hidden" class="gooddigest" value="最纯的酒，敬最纯的兄弟。青岛农丁原浆浆啤酒，当天灌装当天发货，只为一杯更新鲜的啤酒！德国酵母、崂山泉水、新疆雪域啤酒花，够劲爽，够正宗。">
                                <input type="hidden" class="goodimage" value="http://www.xiaonongding.com/upload/group/000/000/890/s_5972f1dd75a07.jpg">
                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="http://www.xiaonongding.com/upload/group/000/000/890/5972f2e16459e.jpg" />
                                </div>
                                <div class="left-right">
                                    <h4 style="display: none;">壹加壹牛肉</h4>
										<h5>青岛农丁原浆啤酒20斤</h5>
										<p >最纯的酒，敬最纯的兄弟。青岛农丁原浆浆啤酒，当天灌装当天发货，只为一杯更新鲜的啤酒！德国酵母、崂山泉水、新疆雪域啤酒花，够劲爽，够正宗。</p>
                                    <div class="price_wrap">
                                        <strong>&yen;<span class="unit_price">219<i >.00</i><input type="hidden" class="tureunit_price" value="219.00"><b>会员品鲜价</b></span>
                                            <del>&yen;:289.00</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="2971">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[2971]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li><li id="dish_li2972">
                            <div class="list-imgs" style="background-image: url(http://www.xiaonongding.com/upload/group/000/000/890/s_5972f40716e9d.jpg);">
                                <input type="hidden" class="goodprice" value="32.00">
                                <input type="hidden" class="goodname" value="青岛农丁原浆1.5L ">
                                <input type="hidden" class="gooddigest" value="没有什么比一杯清冽的啤酒更能爽快。无论整杯豪饮，还是细细品味，啤酒的甘甜清爽、细腻如丝，都能让人神往。农丁原浆，当天灌装，只为一杯更新鲜的啤酒！德国酵母、崂山泉水、新疆雪域啤酒花，够劲爽，够正宗。">
                                <input type="hidden" class="goodimage" value="http://www.xiaonongding.com/upload/group/000/000/890/s_5972f40716e9d.jpg">
                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="http://www.xiaonongding.com/upload/group/000/000/890/5972f4f2ece61.jpg" />
                                </div>
                                <div class="left-right">
                                    <h4 style="display: none;">壹加壹牛肉</h4>
										<h5>青岛农丁原浆1.5L </h5>
										<p >没有什么比一杯清冽的啤酒更能爽快。无论整杯豪饮，还是细细品味，啤酒的甘甜清爽、细腻如丝，都能让人神往。农丁原浆，当天灌装，只为一杯更新鲜的啤酒！德国酵母、崂山泉水、新疆雪域啤酒花，够劲爽，够正宗。</p>
                                    <div class="price_wrap">
                                        <strong>&yen;<span class="unit_price">32<i >.00</i><input type="hidden" class="tureunit_price" value="32.00"><b>会员品鲜价</b></span>
                                            <del>&yen;:45.00</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="2972">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[2972]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li><li id="dish_li2973">
                            <div class="list-imgs" style="background-image: url(http://www.xiaonongding.com/upload/group/000/000/890/s_598057c721240.jpg);">
                                <input type="hidden" class="goodprice" value="268.00">
                                <input type="hidden" class="goodname" value="盐池滩羊寸排1000g">
                                <input type="hidden" class="gooddigest" value="每100克盐池滩羊肉所含蛋白质总量为93.2%（风干样），不饱和脂肪酸含量较高，矿物质元素种类丰富，含量适中，具有极强的保健功能。">
                                <input type="hidden" class="goodimage" value="http://www.xiaonongding.com/upload/group/000/000/890/s_598057c721240.jpg">
                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="http://www.xiaonongding.com/upload/group/000/000/890/5980552af409f.jpg" />
                                </div>
                                <div class="left-right">
                                    <h4 style="display: none;">壹加壹牛肉</h4>
										<h5>盐池滩羊寸排1000g</h5>
										<p >每100克盐池滩羊肉所含蛋白质总量为93.2%（风干样），不饱和脂肪酸含量较高，矿物质元素种类丰富，含量适中，具有极强的保健功能。</p>
                                    <div class="price_wrap">
                                        <strong>&yen;<span class="unit_price">268<i >.00</i><input type="hidden" class="tureunit_price" value="268.00"><b>会员品鲜价</b></span>
                                            <del>&yen;:328.00</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="2973">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[2973]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li><li id="dish_li2974">
                            <div class="list-imgs" style="background-image: url(http://www.xiaonongding.com/upload/group/000/000/890/s_59758554dbffa.jpg);">
                                <input type="hidden" class="goodprice" value="478.00">
                                <input type="hidden" class="goodname" value="盐池滩羊前腿 蝴蝶排4斤礼盒  ">
                                <input type="hidden" class="gooddigest" value="每100克盐池滩羊肉所含蛋白质总量为93.2%（风干样），不饱和脂肪酸含量较高，矿物质元素种类丰富，含量适中，具有极强的保健功能。">
                                <input type="hidden" class="goodimage" value="http://www.xiaonongding.com/upload/group/000/000/890/s_59758554dbffa.jpg">
                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="http://www.xiaonongding.com/upload/group/000/000/890/5972f776dff76.jpg" />
                                </div>
                                <div class="left-right">
                                    <h4 style="display: none;">壹加壹牛肉</h4>
										<h5>盐池滩羊前腿 蝴蝶排4斤礼盒  </h5>
										<p >每100克盐池滩羊肉所含蛋白质总量为93.2%（风干样），不饱和脂肪酸含量较高，矿物质元素种类丰富，含量适中，具有极强的保健功能。</p>
                                    <div class="price_wrap">
                                        <strong>&yen;<span class="unit_price">478<i >.00</i><input type="hidden" class="tureunit_price" value="478.00"><b>会员品鲜价</b></span>
                                            <del>&yen;:538.00</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="2974">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[2974]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li>                </ul>
                
                
                
                <a name="fenlei02"></a>
                <div class="nav-banner" style="display: none;">
						<img src="{pigcms{$static_path}vip/nav02.jpg" />
					</div>
                <ul id="ul_type284" style="display: none;">
                	
                    <volist name="groups" id="group">
                        <li id="dish_li{pigcms{$group.group_id}">
                            <div class="list-imgs" style="background-image: url({pigcms{$group.pic});" data-url="{pigcms{$group.pic}">
                                <input type="hidden" class="goodprice" value="{pigcms{$group.price}">
                                <input type="hidden" class="goodname" value="{pigcms{$group.s_name}">
                                <input type="hidden" class="gooddigest" value="{pigcms{$group.intro}">
                                <input type="hidden" class="gooddigest" value="{pigcms{$group.intro}">



                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="{pigcms{$group.pic}" />
                                </div>
                                <div class="left-right">
                                    <h4 style="display: none;">壹加壹牛肉</h4>
										<h5>{pigcms{$group.s_name}</h5>
										<p style="display: none;">增肌强身精选带骨腹肉增肌强身精选带骨腹肉</p>
                                    <div class="price_wrap">
                                        <strong>&yen;<span class="unit_price"><?php echo  explode('.', $group['price'])[0];?><i >.<?php echo  end(explode('.', $group['price']));?></i><input type="hidden" class="tureunit_price" value="{pigcms{$group.price}"><b>会员品鲜价</b></span>
                                            <del>&yen;:{pigcms{$group.old_price}</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="{pigcms{$group.group_id}">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[{pigcms{$group.group_id}]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li>
                    </volist>
                </ul>
                <a name="fenlei03"></a>
                <div class="nav-banner" style="display: none;">
						<img src="{pigcms{$static_path}vip/nav03.jpg" />
					</div>
                <ul id="ul_type284" style="display: none;">
                	
                    <volist name="groups" id="group">
                        <li id="dish_li{pigcms{$group.group_id}">
                            <div class="list-imgs" style="background-image: url({pigcms{$group.pic});">

                            </div>
                            <div class="list-cons">
                                <div class="list-left">
                                    <img src="{pigcms{$group.pic}" />
                                </div>
                                <div class="left-right">
                                    <h4 style="display: none;">壹加壹牛肉</h4>
										<h5>{pigcms{$group.s_name}</h5>
										<p style="display: none;">增肌强身精选带骨腹肉增肌强身精选带骨腹肉</p>
                                    <div class="price_wrap">
                                        <strong>&yen;<span class="unit_price"><?php echo  explode('.', $group['price'])[0];?><i >.<?php echo  end(explode('.', $group['price']));?></i><input type="hidden" class="tureunit_price" value="{pigcms{$group.price}"><b>会员品鲜价</b></span>
                                            <del>&yen;:{pigcms{$group.old_price}</del>
                                        </strong>
                                        <input autocomplete="off" class="thisdid" type="hidden" value="{pigcms{$group.group_id}">
                                        <div class="price_wrap2">
                                            <div class="fr" max="-1">
                                                <a href="javascript:void(0);" class="btn plus" data-num="0"></a>
                                            </div>
                                            <input autocomplete="off" class="number" type="hidden" name="dish[{pigcms{$group.group_id}]" value="0">
                                        </div>

                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>

                        </li>
                    </volist>
                </ul>
            </div>
            <style>
            	.list-img{
            		width: 100%;
            		display: block;
            		font-size: 0;
            	}
            	.list-img img{
            		width: 100%;
            	}
            </style>
            <div class="list-img">
            	<img src="{pigcms{$static_path}vip/list-footer.png">
            </div>
            <div style="width: 100%; height: 1;"></div>
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
<div class="alert-div">
    <div class="alert-bg"> </div>
    <div class="dialog mask">
        <div class="dialog_wrap">
            <div class="dialog_tt">壹加壹带骨腹肉1kg</div>
            <a href="javascript:void(0);" class="dialog_close"></a>
            <div class="dialog_scroller" style="height: 398px;">
                <div class="menu_detail dialog_content" id="menuDetail" style="display: block;">
                    <img style="" class="alertimage" src="http://www.xiaonongding.com/upload/group/000/000/890/s_59707ada7f9d3.jpg">
                    <div class="nopic" style="display: none;"></div>
                    
                    <dl>
                        <dt>价格：</dt>
                        <dd class="highlight">￥<span class="price">166.00</span></dd>
                    </dl>
                    <p class="sale_desc"></p>
                    <dl class="desc">
                        <dt>介绍：</dt>
                        <dd class="info">位于牛胸腹部，第2肋-第5肋。主要由肋间内肌、肋间外肌、腹外斜肌等肌肉组织。带骨腹肉又称：小牛排、牛仔骨肌间有脂肪，有筋膜层，表面有不均匀脂肪覆盖。用作火锅切片、韩式牛排火锅、韩式烤肉及西餐牛排。</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>


<input type="hidden" class="nowmoney" value="{pigcms{$user.cardmoney}">
</body>
<script>
    $(document).ready(function(){
        $(".list-imgs").on("click",function(){
        var price=    $(this).children(".goodprice").val();
        var title=$(this).children(".goodname").val();
        var digest=$(this).children(".gooddigest").val();
        var image=$(this).children(".goodimage").val();
        $(".dialog_tt").text(title);
            $(".price").text(price);
            $(".info").text(digest);
            $(".alertimage").attr("src",image);
            $('.alert-div').show();
        });
        $(".alert-bg").click(function(){
            $('.alert-div').hide();
        });
    });
</script>
<script>
			$(function() {
				var nav = $(".list-nav"); //得到导航对象
				var banner = $('.banner-top').height();
				var win = $(window); //得到窗口对象
				var sc = $(document); //得到document文档对象。
				win.scroll(function() {

					if(sc.scrollTop() >= banner) {
						nav.addClass("fix");
					} else {

						nav.removeClass("fix");
					}

				});
			});
		</script>
		<script>
			$(document).ready(function() {
				$(".list-nav ul li").click(function() {
					$(this).addClass('on');
					$(this).siblings('.on').removeClass('on');
				});
			
			});
			
			
		</script>
<script type="text/javascript">
    window.shareData = {
        "moduleName":"Vip",
        "moduleID":"0",
        "imgUrl": "{pigcms{$static_path}/vip/share.jpg",
        "sendFriendLink": "http://www.xiaonongding.com/wap.php?g=Wap&c=Vip",
        "tTitle": "农丁鲜生品鲜白金会员专享",
        "tContent": "小农丁为有品の您甄选原产地最优品、最健康的生鲜食材～"
    };
</script>
<script>
</script>
<include file="Public:vipshare"/>

</html>