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
	var myScroll = new IScroll('#container', { probeType: 1,disableMouse:true,disablePointer:true,mouseWheel: false,scrollX: false, scrollY:true,click:iScrollClick()});
	
	$('.storeProList .more').click(function(){
		$(this).remove();
		$('.storeProList li').show();
		myScroll.refresh();
	});
});