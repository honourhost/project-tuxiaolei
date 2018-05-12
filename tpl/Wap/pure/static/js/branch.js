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
	$('#container').css({top:'53px'});
	$('#scroller').css({'min-height':($(window).height()-52)+'px'});
	myScroll = new IScroll('#container', { probeType: 1,disableMouse:true,disablePointer:true,mouseWheel: false,scrollX: false, scrollY:true,click:iScrollClick()});
	
	// $(window).resize(function(){
		// window.location.reload();
	// });
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
});