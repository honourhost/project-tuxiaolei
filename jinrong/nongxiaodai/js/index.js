$(document).ready(function(){
	var isIE = !/msie 10/.test(navigator.userAgent.toLowerCase()) && /msie/.test(navigator.userAgent.toLowerCase());
	var curPage = 0;
	var newPage = null;
	var pageB = 1;
	var pageC = 1;
	var coordinate = [{top:-4.7+'%', right:13.8+'%', opacity:1}, {top:39+'%', right:-12+'%', opacity:1}, {bottom:-5+'%', right:13.8+'%', opacity:1}, {bottom:-5+'%', left:13.8+'%', opacity:1}, {top:39+'%', left:-12+'%', opacity:1}, {top:-4.7+'%', left:13.8+'%', opacity:1}];
	function pageSwitch(newPage){
		if (newPage == curPage || $('#wrap').is(':animated'))return;
		curPage = newPage;
		$('#wrap').animate({top:-100*curPage+"%"},600,'easeOutQuad');
		$('#nav_page').find('li').eq(curPage).addClass('act').siblings().removeClass();
		if (curPage == 1 && pageB) {
			$('.main').delay(300).fadeIn();
			if (isIE) {
				var showTime = 800;
			}else{
				var showTime = 3400;
			}
			setTimeout(function(){
				$('#pointer').find('div').each(function(index){
					$(this).delay(index * 250).animate(coordinate[index],500,function(){
						$(this).addClass('ed').css({'filter':'alpha(opacity=100)','pointerEvents':'auto'});
					});
				});
			},showTime)
			pageB = 0;
		}
		if (curPage == 2 && pageC) {
			$('.news').delay(600).animate({left:0, opacity:1},600);
			$('.special').delay(600).animate({right:0, opacity:1},600,function(){
				$('footer').animate({bottom:0, opacity:1},600);
			});
			pageC = 0;
		}
	}

	$('body').on('mousewheel', function(event) {
		var dir = event.deltaY;
		if (dir > 0 && curPage > 0) {
			newPage = curPage-1;
		}else if(dir < 0 && curPage < 3){
			newPage = curPage+1;
		}else{
			return;
		}
		pageSwitch(newPage);
	});

	$('#nav_page').find('li').on('click',function(){
		pageSwitch($(this).index());
	})


	// --------------------------------------------------


	var aBanner = -1;
	$('.feature').on('click',function(){
		aBanner = $(this).index('.feature');
		console.log(aBanner);
		$('.banner').eq(aBanner).stop().animate({top:0},600,'easeOutQuad').siblings('.banner').stop().animate({top:'-100%'},600,'easeOutQuad');
		$('#ammeter').attr('class','ammeter_'+aBanner);
	})

	$('.back').on('click',function(){
		aBanner = -1;
		$('.banner').stop().animate({top:'-100%'},600,'easeOutQuad');
		$('#ammeter').removeClass();
	})

	$('#ammeter').on('click',function(){
		aBanner++;
		if (aBanner > 2 ){
		aBanner = -1;
		$('.banner').stop().animate({top:'-100%'},600,'easeOutQuad');
		$('#ammeter').removeClass();
		return;
		}
		console.log(aBanner);

		$('.banner').eq(aBanner).stop().animate({top:0},600,'easeOutQuad').siblings('.banner').stop().animate({top:'-100%'},600,'easeOutQuad');
		$('#ammeter').attr('class','ammeter_'+aBanner);
	})


	// --------------------------------------------------


	var specialNum = $('#special_con').find('li').size();
	var sNow = 0;
	$('#special_con').css('width',specialNum*386);
	$('#s_prev').on('click',function(){
		if (sNow <= 0)return;
		sNow--;
		$('#special_con').animate({left:sNow*-386},300);
	})
	$('#s_next').on('click',function(){
		if (sNow >= specialNum-1)return;
		sNow++;
		$('#special_con').animate({left:sNow*-386},300);
	})


	// --------------------------------------------------


	var pagecCon = ($(window).height() - 360 - 358) / 2 + 360;
	$('#page_c').find('.container').css('bottom',pagecCon);


})

window.onresize = function(){
	var pagecCon = ($(window).height() - 360 - 358) / 2 + 360;
	$('#page_c').find('.container').css('bottom',pagecCon);
	verticalB();
}

window.onload = function(){
	verticalB();
}

function verticalB(){
	var objB = $('#page_b').find('.main');
	var objBDis = objB.css('display');
	objB.css('display','block');
	var bVerticle = ($(window).height() - objB.height()) / 2;
	objB.css({marginTop:bVerticle, display:objBDis});
}