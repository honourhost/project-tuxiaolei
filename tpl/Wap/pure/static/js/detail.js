var myScroll;
$(function(){
	// 根据机型判断是否允许点击事件
	function iScrollClick(){
	if (/iPhone|iPad|iPod|Macintosh/i.test(navigator.userAgent)) return false;
	if (/Chrome/i.test(navigator.userAgent)) return (/Android/i.test(navigator.userAgent));
	if (/Silk/i.test(navigator.userAgent)) return false;
	if (/Android/i.test(navigator.userAgent)) {
	   var s=navigator.userAgent.substr(navigator.userAgent.indexOf('Android')+8,3);
	   return parseFloat(s[0]+s[3]) < 44 ? false : true
   	 }
	}
	$('#scroller').css({'min-height':($(window).height()+1)+'px'});

	myScroll = new IScroll('#container', { probeType: 1,disableMouse:true,disablePointer:true,mouseWheel: true,scrollX: false, scrollY:true,click:iScrollClick()});
	myScroll.on("scrollEnd",function(){
		if(this.y < -250){
			$('.positionDiv').fadeIn('slow');
		}else{
			$('.positionDiv').fadeOut('fast');
		}
	});
	/*myScroll.on("scroll",function(){
		if(this.y >= 0){
			$('.imgBox img').height(200+this.y+'px');
		}else{
			$('.imgBox img').height('200px');
		}
		
		if(maxY >= 50){
			!upHasClass && upIcon.addClass("reverse_icon");
			return "";
		}else if(maxY < 50 && maxY >=0){
			upHasClass && upIcon.removeClass("reverse_icon");
			return "";
		}
	});*/
	if(user_long == '10'){
		getUserLocation({okFunction:'refresh'});
		// getUserLocation();
	}
	/* $(window).resize(function(){
		window.location.reload();
	}); */
	
	$('.back').click(function(){
		window.history.go(-1);
	});
	
	$('.storeProList .more').click(function(){
		$(this).remove();
		$('.storeProList li').show();
		myScroll.refresh();
	});
	//评论
	if($('.introList.comment').size() > 0){
		var cOver = false;
		$.each($('.comment .text'),function(i,item){
			if($(item).height() > 63){
				$(item).closest('.textDiv').addClass('overflow');
				cOver = true;
			}
		});
		cOver && myScroll.refresh();
		$('.comment .textDiv').click(function(){
			$(this).hasClass('overflow') && $(this).removeClass('overflow');
			myScroll.refresh();
		});
	}
	if(motify.checkWeixin()){
		$('.imgBox img').click(function(){
			var album_array = $(this).data('pics').split(',');
			wx.previewImage({
				current:album_array[0],
				urls:album_array
			});
		});
		$('.imgList img').click(function(){
			var album_array = $(this).closest('.imgList').data('pics').split(',');
			wx.previewImage({
				current:album_array[0],
				urls:album_array
			});
		});
	}
});