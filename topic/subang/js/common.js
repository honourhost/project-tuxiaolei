/**
 * Created by tanytree on 2015/9/22.
 */
window.onload=function(){
	if($(window).width()<500){
		$(".benefit").remove();
		return false;
	}else{
	$(".benefit").show();
	$(".benefit").addClass("bounceInShow");
	window.setTimeout(function(){
		$(".benefit").removeClass("bounceInShow").addClass("swingShow");
	},3000)
	}
}

$(function(){
    setInterval(function(){
        $('#scrollNews li:last').css({'height':'0px','opacity': '0'}).insertBefore('#scrollNews li:first').animate({'height':'20px','opacity': '1'}, 'slow', function() {
            $(this).removeAttr('style');
        });
    },3000);

    setInterval(function(){
        $('#year3 li:last').css({'height':'0px','opacity': '0'}).insertBefore('#year3 li:first').animate({'height':'20px','opacity': '1'}, 'slow', function() {
            $(this).removeAttr('style');
        });
    },1000);

	$(".benefit .xclosed").click(function(){
		$(".benefit").slideUp(200);
		return false;
	});
});


$(function(){
    //$(".subNav").find(".row").eq(0).show();
    //$(".navAndLogo .bigNav ul li").hover(function(){
    //    $(".navAndLogo .bigNav ul li").removeClass('hover');
    //    if($(this).hasClass("product")){
    //        $(this).addClass('hover');
    //        $(".subNav").slideDown();
    //        $(".subNav").find(".row").hide();
    //        $(".subNav").find(".row").eq(0).show();
    //    }else if($(this).hasClass("about")){
    //        $(this).addClass('hover');
    //        $(".subNav").slideDown();
    //        $(".subNav").find(".row").hide();
    //        $(".subNav").find(".row").eq(1).show();
    //    }else{
    //        $(".subNav").slideUp();
    //        $(".subNav").find(".row").hide();
    //    }
    //}).eq(1).trigger('mouseover');
    //
    //$(".aboutRow").mouseleave(function(){
    //    $(".navAndLogo .bigNav ul li").removeClass('hover');
    //    $(".subNav").slideUp();
    //    $(".subNav").find(".row").hide();
    //});

    var oUrl = "http://www.pigcms.com/";
    var localurl= window.location.href;
    // if( localurl==oUrl)
    // {
    //     $(".navAndLogo .bigNav ul li.product ").addClass("hover");
    //     $(".subNav").show();
    // }else{
    //     $(".navAndLogo .bigNav ul li.product ").removeClass("hover");
    //     $(".subNav").hide();
    // }


    $(".navAndLogo .bigNav ul li.product ").hover(function(){
        $(".navAndLogo .bigNav ul li.product ").addClass("hover");
        $(".subNav").slideDown();
    })


    //绐楀彛婊氬姩鍚庯紝瀵艰埅鎮诞
	$(window).scroll(function() {
		if ($(window).scrollTop() > 0) {
			$(".header").addClass('fixedStyle');
            //$(".navAndLogo .bigNav ul li.product ").removeClass("hover");
            //$(".subNav").slideUp();

        }
		else {
			$(".header").removeClass('fixedStyle');
            //$(".navAndLogo .bigNav ul li.product ").addClass("hover");
            //$(".subNav").slideDown();
        }
	});
	//鍥炲埌椤堕儴鎸夐挳
    $(window).scroll(function() {
        if ($(window).scrollTop() > 200) {
            $(".backTop").fadeIn(0);
        }
        else {
            $(".backTop").fadeOut(500);
        }
    });
    $(".backTop").click(function() {
        $('body,html').animate({
                scrollTop: 0
            },
            500);
        return false;
    });



$(".lastUpdate li").hover(function(){
    $(this).find(".coverQr").slideDown();
},function(){
    $(this).find(".coverQr").slideUp();
});

    //鏂囩珷鍘嗗彶璁板綍

    $(".articleTimeLine li:even").addClass('left');
    $(".articleTimeLine li:odd").addClass('right');
    $(".articleTimeLine").hide().slideDown(3000);


    bigScroll();
	
	    $(".detail .news ul").each(function(){
        $(this).find("li").last().addClass('last');
    });
	
	  //鎷涜仒淇℃伅绗竴鏉″鐞�
    $(".job").each(function(){
       $(this).find('.jobLi') .eq(0).find('.jobArrow').addClass('on');
        $(this).find('.jobLi') .eq(0).find(".jobDetail").show();
    });
    //鎷涜仒淇℃伅鐐瑰嚮鏁堟灉
    $(".jobOl li.jobArrow").on('click',function(){
        if($(this).hasClass('on')){
            $(this).removeClass('on');
        }
        else{
            $(this).addClass('on');
        }
        if( $(this).parent().next().is(':visible')){
            $(this).parent().next().slideUp();
        }else{
            $(this).parent().next().slideDown();
        }
    });
});





//鍒囨崲澶勭悊
$(function(){
    myFun.tabs(".tabThis .nav ul li",".detail>.row","on");
    $(".tabThis .nav ul li").on("click",function(){
        myFun.tab(".subTab");
    });
	
	 $(".indexTab .tabThis .nav ul li").click(function(){
        if($('.header').hasClass('fixedStyle')){
            $('body,html').animate({
                    scrollTop: ($(".indexTab").offset().top)-60 +'px'
                },
                500);

        }else{
            $('body,html').animate({
                    scrollTop: ($(".indexTab").offset().top)-150 +'px'
                },
                500);
        }
        //$('body,html').animate({
        //        scrollTop: ($(".indexTab").offset().top) +'px'
        //    },
        //    500);
        return false;
    });
    myFun.tab(".subTab");
    myFun.tabFade(".whyPigTab");
    myFun.tabFade(".singleTab");

    feedBack();

    myFun.rowlastLi('.otherProducts','3');

    jsRect();
    js3Rect();
});

//鎶€鏈鏄庢ā鍧楀鐞�

function jsRect(){
    $(".jsRect").each(function(){
        var i=0;
        var time=800;
        var li=$(this).find("ul li");
        var iOdd=$(this).find("ul li:odd");
        var iEven=$(this).find("ul li:even");

        $(iOdd).hover(function(){
            $(this).addClass('on');
            $(this).prev().stop().animate({'width':'100px'},time).find(".desc").hide();
            $(this).stop().animate({'width':'800px'},time);
        },function(){
            $(this).removeClass('on');
            $(this).prev().stop().animate({'width':'50%'},time).find(".desc").show();
            $(this).animate({'width':'50%'},time);
        });
        $(iEven).hover(function(){
            $(this).addClass('on');
            $(this).next().stop().animate({'width':'100px'},time).find(".desc").hide();
            $(this).stop().animate({'width':'800px'},time);
        },function(){
            $(this).removeClass('on');
            $(this).next().stop().animate({'width':'50%'},time).find(".desc").show();
            $(this).stop().animate({'width':'50%'},time);
        });
    });
};

function js3Rect(){
    var i=0;
    var li=$(".js3Rect").find("ul li");
    var Len=li.length;
    var time=800;

    for(i=1;i<Len;i+=3){
        $(".js3Rect ul li").eq(i).hover(function(){
            $(this).prev().stop().animate({'width':'100px'},time).find(".desc").hide();
            $(this).next().stop().animate({'width':'100px'},time).find(".desc").hide();
            $(this).addClass('on').stop().animate({'width':'730px','right':'100px'},time);
        },function(){
            $(this).prev().stop().animate({'width':'33%'},time).find(".desc").show();
            $(this).next().stop().animate({'width':'33%'},time).find(".desc").show();
            $(this).removeClass('on').stop().animate({'width':'33%','right':'33%'},time);
        });
    }
    for(i=0;i<Len;i+=3){
        $(".js3Rect ul li").eq(i).hover(function(){
            $(this).next().stop().animate({'width':'100px','right':'100px'},time).find(".desc").hide();
            $(this).next().next().stop().animate({'width':'100px'},time).find(".desc").hide();;
            $(this).addClass('on').stop().animate({'width':'730px'},time);
        },function(){
            $(this).next().stop().animate({'width':'33%','right':'33%'},time).find(".desc").show();
            $(this).next().next().stop().animate({'width':'33%'},time).find(".desc").show();
            $(this).removeClass('on').stop().animate({'width':'33%'},time);
        });
    }
     for(i=2;i<Len;i+=3){
        $(".js3Rect ul li").eq(i).hover(function(){
            $(this).prev().stop().animate({'width':'100px','right':'79%'},time).find(".desc").hide();
            $(this).prev().prev().stop().animate({'width':'100px'},time).find(".desc").hide();
            $(this).addClass('on').stop().animate({'width':'730px'},time);
        },function(){
            $(this).prev().stop().animate({'width':'33%','right':'33%'},time).find(".desc").show();
            $(this).prev().prev().stop().animate({'width':'33%'},time).find(".desc").show();
            $(this).removeClass('on').stop().animate({'width':'33%'},time);
        });
    }
}




//鍔熻兘鐗规€�
$(function(){
    var li=$(".feaTures .ftUl .ftUlLi");
    li.find('tagsCell').css('width','0');
    li.on('click',function() {
        if($(this).find(".tagsCell").is(":hidden")){
        $(this).find(".tagsCell").show().animate({'width':'328px'},600).parent().siblings().find(".tagsCell").hide().css('width','0');
        }
    }).eq(0).trigger('click');
});






//澶у浘杞挱
function bigScroll(){
    $(".flashBox").each(function(){
        var i=0;
        var timer=0;
        var prev=$(this).find(".bannerBtn a.prev");
        var next=$(this).find(".bannerBtn a.next");
        var pageI=$(this).find("ol li");
        var imgLi=$(this).find("ul li");
        function right() {
            i++;
            if (i == imgLi.length) {
                i = 0
            }
        }
        function left() {
            i--;
            if (i < 0) {
                i = imgLi.length - 1
            }
        }
        function run(){
            pageI.eq(i).addClass("active").siblings().removeClass("active");
            imgLi.eq(i).fadeIn(600).siblings().fadeOut(600).hide();
        }
        pageI.each(function(index){
            $(this).click(function(){
                i=index;
                run();
            });
        }).eq(0).trigger("click");
        function runn(){
            right();
            run();
        }
        timer= setInterval(runn, 8000);
        $(".flashBox").hover(function(){
            clearInterval(timer);
            $(".bannerBtn a").fadeIn(600);
        },function(){
            timer = setInterval(runn, 8000);
            $(".bannerBtn a").fadeOut(600);
        });
        prev.click(function(){
            left();
            run();
        });
        next.click(function(){
            right();
            run();
        });
    })
}





//feedback
function feedBack(){
    $(".fbScroll").each(function(){
        var i=0;
        var timer=0;
        var pageI=$(this).find(".scrollPage i");
        var imgLi=$(this).find("ul li");
        var imgLen=imgLi.length;
        var li2=Math.ceil(imgLen/2);
        var li2W=imgLi.outerWidth(true)*2;
        var scroll=$(".fbScroll ul");
        var scrollW=imgLi.outerWidth(true)*imgLen;
        scroll.width(scrollW);
        function right() {
            i++;
            if (i == li2) {
                i = 0
            }
        }
        function left() {
            i--;
            if (i < 0) {
                i = li2 - 1
            }
        }
        function run(){
            pageI.eq(i).addClass("on").siblings().removeClass("on");
            scroll.stop().animate({ //鍥剧墖鍒囨崲
                    'margin-left': -li2W * i + 'px'
                },
                1000);        }
        pageI.each(function(index){
            $(this).click(function(){
                i=index;
                run();
            });
        }).eq(0).trigger("click");
        function runn(){
            right();
            run();
        }
        timer= setInterval(runn, 3000);
        $(this).hover(function(){
            clearInterval(timer);
        },function(){
            timer = setInterval(runn, 3000);
        });
    })
}

//宸ヤ綔鐜
$(function(){
    var t=null;
    var i=0;
    var li=$(".showImg ul li");
    var len=li.length;
    var oli=$(".showImg ol li");
    var olen=oli.length;
    var oliW=oli.outerWidth(true);
    $(".showImg ol").width(olen*oliW);
    oli.each(function(index){
        $(this).click(function(){
            i=index;
            $(this).addClass('on').siblings().removeClass('on');
            li.eq(i).fadeIn(1000).siblings().fadeOut(600);
            $(".showImg .title").text($(this).find('img').attr('alt'));
        })
    }).eq(0).trigger('click');
});

//椤甸潰鍒濆鍖栧悗js鎿嶄綔
$(function(){
    var $bannerH=$('.banner').outerHeight(true);
    var $subNav=$(".subNav");
    var subLi=$('.indexTab .tabThis .nav ul li');
    $(".productRow").find(" a[href*=#],area[href*=#]").click(function() {
        var reg = /^\.?\//;

        if (location.pathname.replace(reg, '') == this.pathname.replace(reg, '')) {
            var $target = $(this.hash);
            $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
            //$target.trigger('click');


            $target.addClass('on').siblings().removeClass('on');
            var oI=subLi.index($target);
            $(".indexTab .tabThis .detail>.row").hide().eq(oI).show();
            $(".banner").animate({
                height:$subNav.outerHeight(true)-90+"px"
            },500);

            if ($target.length) {
                var targetOffset = $target.offset().top;
                if($('.header').hasClass('fixedStyle')){
                    $('body,html').animate({
                            scrollTop: 0
                        },
                        1000);
                }else{
                    $('body,html').animate({
                            scrollTop: 0
                        },
                        1000);
                }
                return false;
            }
        }
    });
    $(".subNav .navClosed").click(function(){
        $(".navAndLogo .bigNav ul li").removeClass('hover');
        $(".subNav").slideUp();
        $(".banner").animate({
            height:$bannerH + 'px'
        },500);
    });

});
// $(window).scroll(function() {
//     if ($(window).scrollTop() > 145) {
//         $(".navAndLogo .bigNav ul li.product ").removeClass("hover");
//         $(".subNav").slideUp();
//         $(".banner").css('height','auto');

//     }
//     else {
//         $(".navAndLogo .bigNav ul li.product ").addClass("hover");
//         //$(".subNav").slideDown();
//     }
// });

$(window).load(function(){
    (function hashJump(){
        var hashs=window.location.hash;

        if(!hashs==''){
            console.log(hashs);
            $(".navAndLogo .bigNav ul li.product ").removeClass("hover");
            $(".subNav").slideUp();

            $(hashs).trigger('click');
            $('body,html').animate({
                    scrollTop:($(hashs).offset().top)-150 +'px'
                },
                1000);

        }else{
            return false;
        }
    })();

});


var myFun = {
    //璁＄畻姣忚鏈€鍚庝竴涓紝娓呴櫎姣忚鏈€鍚庝竴涓殑margin
    rowlastLi: function(a, b) {
        $(a).each(function() {
            var li = $(this).find("ul>li");
            var len = $(this).find("ul>li").length;
            var y = len / b;
            for (var i = 1; i <= y; i++) {
                li.eq(i * b - 1).css({
                    'margin-right': '0'
                });
            }
        })
    },
    //tab鍒囨崲涓€涓弬鏁�
    tab: function(obj) {
        var tabObj = $(obj);
        tabObj.each(function() {
            var len = $(this).find('.hd ul li');
            var row = $(this).find('.row');
            len.bind("click", function() {
                var index = 0;
                $(this).addClass('on').siblings().removeClass('on');
                index = len.index(this);
                row.eq(index).show().siblings(".row").hide();
                return false;
            }).eq(0).trigger("click");
        });
    },
    //tab鍒囨崲涓€涓弬鏁�
    tabFade: function(obj) {
        var tabObj = $(obj);
        tabObj.each(function() {
            var len = $(this).find('.hd ul li');
            var row = $(this).find('.row');
            len.bind("click", function() {
                var index = 0;
                $(this).addClass('on').siblings().removeClass('on');
                index = len.index(this);
                row.eq(index).fadeIn(1000).siblings(".row").hide();
                return false;
            }).eq(0).trigger("click");
        });
    },
    //tab鍒囨崲涓変釜鍙傛暟
    tabs: function(a, b, c) {
        var len = $(a);
        len.bind("click", function() {
            var index = 0;
            $(this).addClass(c).siblings().removeClass(c);
            index = len.index(this);
            $(b).eq(index).addClass("animate").show().siblings().removeClass("animate").hide();
            return false;
        }).eq(0).trigger("click");
    },
    //娓呮鏈€鍚庝竴涓猯i鐨刡order
    lastLi: function(a) {
        $(a).find("li").last().css('borderBottom', '0');
    },
    //娓呮鏈€鍚庝竴涓猯i鐨刴argin-right
    lastLimr: function(a) {
        $(a).find("li").last().css('marginRight', '0');
    },

    //璁剧疆鐩稿灞忓箷锛堜笉鏄暣涓枃妗ｇ殑锛夌殑top鍊�
    marginTop: function(a) {
        var wHeight = $(window).height();
        var boxHeight = $(a).height();
        //var scrollTop = $(window).scrollTop();
        var top = (wHeight - boxHeight) / 2;
        $(a).css('marginTop', top);
    },
    animate: function (sum){
    var t = $(window).scrollTop();
    var h = $(window).height();

    for(var i = 1; i < sum + 1; i ++){
        var off = $('.floor' + i).offset().top + 100;

        if(t + h > off){
            $('.floor' + i).addClass('animate');
            };
        };
    }
};



//鏃堕棿杞�
$(function(){
    systole();
});

function systole(){
    if(!$(".history").length){
        return;
    }
    var $warpEle = $(".history-date"),
        $targetA = $warpEle.find("h2 a,ul li dl dt a"),
        parentH,
        eleTop = [];

    parentH = $warpEle.parent().height();
    $warpEle.parent().css({"height":59});

    setTimeout(function(){

        $warpEle.find("ul").children(":not('h2:first')").each(function(idx){
            eleTop.push($(this).position().top);
            $(this).css({"margin-top":-eleTop[idx]}).children().hide();
        }).animate({"margin-top":0}, 1600).children().fadeIn();

        $warpEle.parent().animate({"height":parentH}, 2600);

        $warpEle.find("ul").children(":not('h2:first')").addClass("bounceInDown").css({"-webkit-animation-duration":"2s","-webkit-animation-delay":"0","-webkit-animation-timing-function":"ease","-webkit-animation-fill-mode":"both"}).end().children("h2").css({"position":"relative"});

    }, 600);

    $targetA.click(function(){
        $(this).parent().css({"position":"relative"});
        $(this).parent().siblings().slideToggle();
        $warpEle.parent().removeAttr("style");
        return false;
    });
};







	$(function() {
		
    if($(".year3Window").length){
		timeShow();
		function timeShow() {
    var show_time = $(".timeIcon");
    endtime = new Date("6/8/2016 23:59:59"); //缁撴潫鏃堕棿
    today = new Date(); //褰撳墠鏃堕棿
    delta_T = endtime.getTime() - today.getTime(); //鏃堕棿闂撮殧
    if (delta_T < 0) {
        //clearInterval(auto);
        //$(".header .Places i").text(0);
        alert("娲诲姩宸茬粡缁撴潫鍟�");
        $(".header .Places i").text("0");
        return;
    }
    window.setTimeout(timeShow, 1000);
    total_days = delta_T / (24 * 60 * 60 * 1000); //鎬诲ぉ鏁�
    total_show = Math.floor(total_days); //瀹為檯鏄剧ず鐨勫ぉ鏁�
    total_hours = (total_days - total_show) * 24; //鍓╀綑灏忔椂
    hours_show = Math.floor(total_hours); //瀹為檯鏄剧ず鐨勫皬鏃舵暟
    total_minutes = (total_hours - hours_show) * 60; //鍓╀綑鐨勫垎閽熸暟
    minutes_show = Math.floor(total_minutes); //瀹為檯鏄剧ず鐨勫垎閽熸暟
    total_seconds = (total_minutes - minutes_show) * 60; //鍓╀綑鐨勫垎閽熸暟
    seconds_show = Math.floor(total_seconds); //瀹為檯鏄剧ず鐨勭鏁�
    if (total_show <= 15) {

    }

    if (total_show < 10) {
        total_show = String(total_show);
        total_show = "0" + total_show;
    }
    if (hours_show < 10) {
        hours_show = "0" + hours_show;
    }
    if (minutes_show < 10) {
        minutes_show = "0" + minutes_show;
    }
    if (seconds_show < 10) {
        seconds_show = "0" + seconds_show;
    }

    show_time.find("i").eq(0).text(total_show); //鏄剧ず鍦ㄩ〉闈笂
    show_time.find("i").eq(1).text(hours_show);
    show_time.find("i").eq(2).text(minutes_show);
    show_time.find("i").eq(3).text(seconds_show);
}
		
		
		var endtime = new Date("6/8/2016 23:59:59"); //缁撴潫鏃堕棿
    var today = new Date(); //褰撳墠鏃堕棿
   var delta_T = endtime.getTime() - today.getTime(); //鏃堕棿闂撮殧
		
		var dayss = Math.floor(delta_T/(24 * 60 * 60 * 1000));    
		
        //days=days<0?'0':days;
        
        console.log(dayss);
        //console.log(places);
		//var url='/a/statics/js/www/places.txt';
		var url='/product/o2o/statics/js/www/places.txt';
        $.get(url,function(sta){
			var obj = eval("("+sta+")");
			console.log(obj.rows.length);
			if(obj.rows.length>=dayss){
							console.log(dayss);
				if(dayss>=0){
					$(".year3Window .places em").text(obj.rows[parseInt(dayss+1)].place);
				}else if(dayss<0){
					$(".year3Window .places em").text(obj.rows[0].place);
				}
			}else{
			$(".year3Window .places em").text('150');
			}
        });

       
		 
      
			$(".fullBg").show();
			$(".year3Window").show();		
			$(".fullBg").css('z-index','99999999999999999999');
			$(".year3Window").css('z-index','99999999999999999999');		
        $(".fullBg").click(function(){
            $(".year3Window").hide();
            $(".fullBg").hide();
			$(".fullBg").css('z-index','1000');
			$(".year3Window").css('z-index','1109');		

        });
		$(".year3Window").click(function(){
			window.open('http://www.pigcms.com/special/threecelebrate/');
		})
	  //$.cookie('year3' ,'yeae3Now' , { path: '/',expires: 1 });
    }
});



jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};

try {
            if (window.console && window.console.log) {
                console.log("\n\n");
                console.log("鏈€缇庡勾鍗庯紝鍋氭渶濂界殑鎶€鏈憳锛乗n\n");
                console.log('濡備綍璁╂垜閬囪浣狅紝鍦ㄤ綘鏈€缇庣殑鏃跺€橽n鍔犲叆灏忕尓CMS锛屾敼鍙樼敓娲伙紝鏀瑰彉绀句細锛屾敼鍙樻湭鏉ワ紝鍦ㄨ繖閲屽惎绋嬶紒\n');
                console.log("璇峰皢绠€鍘嗗彂閫佽嚦 %c hr@pigcms.cn锛堥偖浠舵爣棰樿浠モ€滃鍚�-搴旇仒XX鑱屼綅-鏉ヨ嚜console鈥濆懡鍚嶏級", "color:red");
                console.log("鑱屼綅浠嬬粛锛歨ttp://www.pigcms.com/contact/job/\n\n");
            }
        } catch (e) {}