$(document).ready(function(){
	$('#create_wrap').css('height',$(window).height()-75);
	var pages = $('#create_wrap').find('section');
	var pageNum = pages.size();
	var container = $('.container');
	container.css('height',pageNum*100+'%');
	pages.css('height',100/pageNum+'%').attr('off','true');

	var curPage = -1;

	$('body').on('mousewheel', function(event) {
		var dir = event.deltaY;
		if (dir > 0 && curPage > 0) {
			newPage = curPage-1;
		}else if(dir < 0 && curPage < pageNum-1){
			newPage = curPage+1;
		}else{
			return;
		}
		pageSwitch(newPage);
	});

	$('#create_indicator').find('li').on('click',function(){
		pageSwitch($(this).index());
	})

	function pageSwitch(newPage){
		if (newPage == curPage || container.is(':animated'))return;
		curPage = parseInt(newPage);

		container.animate({top:-100*curPage+"%"},1000,'easeInOutExpo',function(){
			if(pages.eq(newPage).attr('off')){
				pages.eq(newPage).removeAttr('off');
				pages.eq(newPage).find('.content').eq(0).fadeIn();
				if (newPage == 3) try{
						$("#proa_d_menu").stop().fadeIn()
					}catch(err){}
				if (newPage == 1) try{
						if ($('#vresources').size()>0) {
							setTimeout(function(){
								$('#vresources').css('display','block');
							},2000);
						};
					}catch(err){}
			}
		});
		$('#create_indicator').find('li').eq(curPage).addClass('act').siblings().removeClass();
	}

	var iPointer = window.location.hash.substr(1) && window.location.hash.substr(1)<pageNum ? window.location.hash.substr(1) : 0;
	pageSwitch(iPointer);

	$('body').append('<script src="http://s4.cnzz.com/z_stat.php?id=1253876584&web_id=1253876584" language="JavaScript"></script>');
	

})

window.onload = function(){
	var pages = $('#create_wrap').find('section');
	$('.content').each(function(){
		var iDis = $(this).css('display');
		$(this).css('display','block');
		$(this).css('top',(pages.height()-$(this).outerHeight())/2);
		$(this).css('display',iDis);
	})
}
window.onresize = function(){
	$('#create_wrap').css('height',$(window).height()-75);
	var pages = $('#create_wrap').find('section');
	$('.content').each(function(){
		var iDis = $(this).css('display');
		$(this).css('display','block');
		$(this).css('top',(pages.height()-$(this).outerHeight())/2);
		$(this).css('display',iDis);
	})
}