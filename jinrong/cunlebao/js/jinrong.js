/* @update: 2016-6-29 12:10:10 */ 
function ScrollBar(t){this.leftBtn=t.leftBtn||null,this.rightBtn=t.rightBtn||null,this.scrollBody=t.scrollBody,this.holder=t.holder,this.indexBtn=t.indexBtn||null,this.indexBtnClass=t.indexBtnClass||null,this._autoPlay=t._autoPlay||!1,this.scrollType=t.scrollType||"opacity",this.css3Animate=t.css3Animate||!1,this.isFixFirst=t.isFixFirst||!1,this._init()}function getCss3Animation(){var t=document.createElement("div"),i=!1;return"oninput"in t&&["","ms","webkit"].forEach(function(e){var n=e+(e?"A":"a")+"nimation";n in t.style&&(i=!0)}),i}$(document).ready(function(){function t(){$(window).scroll(function(){var t=parseInt($(".hot-pro").offset().top),i=parseInt($(window).height()-$(".hot-pro").height()),e=parseInt($(window).scrollTop());e>t-i-550?$(".top-menu").stop(!0,!0).slideDown():$(".top-menu").stop(!0,!0).slideUp()})}function i(){var t=$("#homeBanner");if(!t[0])return!1;var i=null,e=null,n=t.find(".indexBtn"),o=t.find(".pic-layer"),s=o.find("li"),a=getCss3Animation();s.each(function(t){var i=$(this),e=i.attr("data-bkg");if(e&&!a){var n=new Image;n.src=e,n.index=t,n.onload=function(){s.eq(this.index).css("backgroundImage","url("+e+")")}}}),new ScrollBar({leftBtn:i,rightBtn:e,scrollBody:t,holder:s,indexBtn:n,indexBtnClass:"current",_autoPlay:!0,css3Animate:a,isFixFirst:!0})}$(".li-bg1").click(function(){$("body,html").animate({scrollTop:$(".vault").offset().top-82},1e3,"easeInOutQuint")}),$(".li-bg2").click(function(){$("body,html").animate({scrollTop:$(".J-Loan").offset().top-82},1e3,"easeInOutQuint")}),$(".li-bg3").click(function(){$("body,html").animate({scrollTop:$(".J-Baby").offset().top-82},1e3,"easeInOutQuint")}),$(".li-bg4").click(function(){$("body,html").animate({scrollTop:$(".Buy-Loan").offset().top-82},1e3,"easeInOutQuint")}),$(".menu-box ul li").hover(function(){$(this).find("i").addClass("swing")},function(){$(this).find("i").removeClass("swing")}),t(),i()}),ScrollBar.prototype={_init:function(){this.currentIndex=0,this.targetIndex=0,this.itemNum=this.holder.length,this.scrollSpeed=500,this.css3Animate&&this.checkPicLoaded(this.holder.eq(this.currentIndex).show()),this._autoPlay&&(this.autoPlayLag=8e3,this.autoPlay()),this.bindEvent()},bindEvent:function(){var t=this;return this.leftBtn&&this.leftBtn.bind("click",function(){t.targetIndex--,t.targetIndex<0&&(t.targetIndex=t.itemNum-1),t.scroll("left")}),this.rightBtn&&this.rightBtn.bind("click",function(){t.targetIndex++,t.targetIndex>=t.itemNum&&(t.targetIndex=0),t.scroll("right")}),this.indexBtn&&this.indexBtn.bind("mouseover",function(){$(this).index()>t.targetIndex?(t.targetIndex=$(this).index(),t.scroll("right")):$(this).index()<t.targetIndex&&(t.targetIndex=$(this).index(),t.scroll("left"))}),this._autoPlay&&this.scrollBody.bind("mouseenter",function(){clearInterval(t.timer),t.leftBtn&&t.leftBtn.show(),t.rightBtn&&t.rightBtn.show()}).bind("mouseleave",function(){t.autoPlay(),t.leftBtn&&t.leftBtn.hide(),t.rightBtn&&t.rightBtn.hide()}),this},scroll:function(){var t=this;this.indexBtn.removeClass(this.indexBtnClass).eq(this.targetIndex).addClass(this.indexBtnClass);var i=this.holder.eq(this.currentIndex).show();this.css3Animate&&t.resetLayer(i);var e=this.holder.eq(this.targetIndex).show();switch(this.title&&(this.title.eq(this.currentIndex).hide(),this.title.eq(this.targetIndex).show()),t.css3Animate&&t.checkPicLoaded(e),this.scrollType){case"opacity":e.css("opacity",0),i.stop().animate({opacity:0},t.scrollSpeed,function(){i.hide()}),e.stop().animate({opacity:1},t.scrollSpeed,function(){t.holder.removeClass("active"),setTimeout(function(){e.addClass("active")},20)})}this.currentIndex=this.targetIndex,this.isFixFirst&&(0===this.targetIndex?($(".con-btn-1").fadeIn(200),$(".con-btn-2").fadeOut(200)):($(".con-btn-2").fadeIn(200),$(".con-btn-1").fadeOut(200)))},autoPlay:function(){var t=this;this.timer&&clearInterval(this.timer),this.timer=setInterval(function(){t.targetIndex++,t.targetIndex>=t.itemNum&&(t.targetIndex=0),t.scroll("right")},t.autoPlayLag)},checkPicLoaded:function(t){for(var i=this,e=t.children("div"),n=e.length,o=0,s=0;n>s;s++){var a=new Image;a.src=e.eq(s).attr("data-bkg"),a.onload=function(){o++,o==n&&(t.css("backgroundImage","none"),i.animateLayer(t))}}},resetLayer:function(t){var i=t.children("div");i.each(function(){$(this).removeClass($(this).attr("data-type")),$(this).attr("data-isBg")||$(this).hide()})},animateLayer:function(t){var i=this,e=t.children("div"),n=0,o=[],s=[];e.each(function(){o.push($(this)),$(this).removeClass($(this).attr("data-type"));var t=$(this).attr("data-delay");s[t-1]?s[t-1].push($(this)):s[t-1]=[$(this)]}),clearInterval(this.animateTimer),this.animateTimer=setInterval(function(){if(s[n])for(var t=0;t<s[n].length;t++){var e=s[n][t];e.css("backgroundImage","url("+e.attr("data-bkg")+")").show().addClass(e.attr("data-type"))}n>s.length&&clearTimeout(i.animateTimer),n++},100)}},function($){$.qqScroll={defaults:{direction:"right",step:1,speed:800,time:4e3,auto:!0,prev:".prev",next:".next",inner:".inner",list:".list",split:".split"}},$.fn.qqScroll=function(t){var i=$.extend({},$.qqScroll.defaults,t),e=$(this),n={};if(n.box=e.find(i.inner),n.list=n.box.find(i.list),n.items=n.list.find(i.split),n.itemSum=n.items.length,n.prevBtn=e.find(i.prev),n.nextBtn=e.find(i.next),n.itemWidth=n.items.outerWidth(),n.itemHeight=n.items.outerHeight(),n.fn={start:function(){i.auto&&(n.fn.stop(),n.run=setTimeout(function(){n.fn.goto(i.direction)},i.time))},stop:function(){"undefined"!=typeof n.run&&clearTimeout(n.run)},addControl:function(){n.prevBtn.length&&n.prevBtn.bind("click",function(){n.fn.goto(n.prevVal)}),n.nextBtn.length&&n.nextBtn.bind("click",function(){n.fn.goto(n.nextVal)})},removeControl:function(){n.prevBtn.length&&n.prevBtn.unbind("click"),n.nextBtn.length&&n.nextBtn.unbind("click")},"goto":function(t){n.fn.stop(),n.fn.removeControl(),n.box.stop(!0);var e,o;switch(t){case"left":case"top":e=0,"left"==t?(0==parseInt(n.box.scrollLeft(),10)&&n.box.scrollLeft(n.itemSum*n.moveVal),o=n.box.scrollLeft()-n.moveVal*i.step,e>o&&(o=e),n.box.animate({scrollLeft:o},i.speed,function(){parseInt(n.box.scrollLeft(),10)<=e&&n.box.scrollLeft(0),n.fn.addControl()})):(0==parseInt(n.box.scrollTop(),10)&&n.box.scrollTop(n.itemSum*n.moveVal),o=n.box.scrollTop()-n.moveVal*i.step,e>o&&(o=e),n.box.animate({scrollTop:o},i.speed,function(){parseInt(n.box.scrollTop(),10)<=e&&n.box.scrollTop(0),n.fn.addControl()}));break;case"right":case"bottom":e=n.itemSum*n.moveVal,"right"==t?(o=n.box.scrollLeft()+n.moveVal*i.step,o>e&&(o=e),n.box.animate({scrollLeft:o},i.speed,function(){parseInt(n.box.scrollLeft(),10)>=e&&n.box.scrollLeft(0)})):(o=n.box.scrollTop()+n.moveVal*i.step,o>e&&(o=e),n.box.animate({scrollTop:o},i.speed,function(){parseInt(n.box.scrollTop(),10)>=e&&n.box.scrollTop(0)}))}n.box.queue(function(){n.fn.addControl(),n.fn.start(),$(this).dequeue()})},init:function(){if(!(n.itemSum<=1)){if("left"==i.direction||"right"==i.direction){if(n.itemWidth*n.itemSum<=n.box.outerWidth())return;n.prevVal="left",n.nextVal="right",n.moveVal=n.itemWidth}else{if(n.itemHeight*n.itemSum<=n.box.outerHeight())return;n.prevVal="top",n.nextVal="bottom",n.moveVal=n.itemHeight}n.list.append(n.list.html()),("left"==i.direction||"right"==i.direction)&&n.list.css({width:n.itemWidth*n.itemSum*2+"px"}),n.box.hover(function(){n.fn.stop()},function(){n.fn.start()}),n.fn.addControl(),n.fn.start()}}},n.fn.init(),"Microsoft Internet Explorer"==navigator.appName&&"7."==navigator.appVersion.match(/7./i))$(".split").hover(function(){$(this).find(".positive").stop().animate({opacity:0},800),$(this).find(".negative").stop().animate({opacity:1},600)},function(){$(this).find(".positive").stop().animate({opacity:1},600),$(this).find(".negative").stop().animate({opacity:0},600)});else if("Microsoft Internet Explorer"==navigator.appName&&"8."==navigator.appVersion.match(/8./i))$(".split").hover(function(){$(this).find(".positive").stop().animate({opacity:0},800),$(this).find(".negative").stop().animate({opacity:1},600)},function(){$(this).find(".positive").stop().animate({opacity:1},600),$(this).find(".negative").stop().animate({opacity:0},600)});else if("Microsoft Internet Explorer"==navigator.appName&&"9."==navigator.appVersion.match(/9./i))$(".split").hover(function(){$(this).find(".positive").stop().animate({opacity:0},800),$(this).find(".negative").stop().animate({opacity:1},600)},function(){$(this).find(".positive").stop().animate({opacity:1},600),$(this).find(".negative").stop().animate({opacity:0},600)});else{$(".split").bind({mouseenter:function(){var t=$(this);$(this).removeClass("flip"),t.addClass("flip")},mouseleave:function(){$(this).removeClass("flip")}})}}}(jQuery);