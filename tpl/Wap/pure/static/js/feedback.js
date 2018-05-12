var myScroll,nowPage=1;

//var flag=true;

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
	$('#container').css({top:'52px'});
	$('#scroller').css({'min-height':($(window).height()+1)+'px'});
	var upIcon = $("#pullUp"),
		downIcon = $("#pullDown");
	// myScroll = new IScroll('#container', { probeType: 3,disableMouse:true,disablePointer:true,mouseWheel: false,scrollX: false, scrollY:true,click:false,scrollbars:true,shrinkScrollbars: 'scale',resizeScrollbars:false,fadeScrollbars:true});
	myScroll = new IScroll('#container', { probeType: 3,disableMouse:true,disablePointer:true,mouseWheel: false,scrollX: false, scrollY:true,click:iScrollClick()});
	myScroll.on("scroll",function(){	
		if(this.y >= 50){
			if(!downIcon.hasClass("reverse_icon")) downIcon.addClass("reverse_icon").find('.pullDownLabel').html('松开可以刷新');
			return "";
		}else if(this.y < 50 && this.y > 0){
			if(downIcon.hasClass("reverse_icon")) downIcon.removeClass("reverse_icon").find('.pullDownLabel').html('下拉可以刷新');
			return "";
		}
		if(totalPage > nowPage){
			var maxY = this.maxScrollY - this.y;
			if(maxY >= 50){
				!upIcon.hasClass("reverse_icon") && upIcon.addClass("reverse_icon");
				return "";
			}else if(maxY < 50 && maxY >=0){
				upIcon.hasClass("reverse_icon") && upIcon.removeClass("reverse_icon");
				return "";
			}
		}
	});
	
	myScroll.on("slideDown",function(){
		if(this.y > 50){
			$('#container').css({'bottom':0});
			$('.footerMenu,#pullDown').hide();
			$('#scroller').animate({'top':$(window).height()+'px'},function(){
				upIcon.removeClass("reverse_icon");
				pageLoadTip();
				window.addEventListener("pagehide", function(){
					$('#container').css({'bottom':'49px'});
					$('#scroller').css({'top':'0px'});
					$('.footerMenu,#pullDown').show();
					pageLoadTipHide();
				},false);
				window.location.href =window.location.href;
			});
		}
	});
	
	myScroll.on("slideUp",function(){
		if(this.maxScrollY - this.y > 50 && totalPage > nowPage){
			upIcon.addClass('noMore').hide();
		}
	});

	myScroll.on("scrollEnd",function(){
		//if(flag){
		if(totalPage > nowPage && !upIcon.hasClass('noMore') && !upIcon.hasClass('loading')){
			$('.introList.list').after('<div class="loadMoreList">正在加载</div>');
			myScroll.refresh();
			//myScroll.scrollTo(0,this.maxScrollY);
			upIcon.addClass('loading');
			getList(true);
		}
		//}
	});
	
	$(window).resize(function(){
		window.location.reload();
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
		$(document).on('click','.imgList img',function(){
			//先判断最后一个是否是,
			var str=$(this).closest('.imgList').data('pics');
			var i = str.lastIndexOf(',');
			if((str.length-1)==i){
				var album_str=str.substring(0,i);
				var album_array=album_str.split(",");
			}else{
				var album_array = $(this).closest('.imgList').data('pics').split(',');
			}
			wx.previewImage({
				current:album_array[0],
				urls:album_array
			});
		});
		// $('.imgList img').click(function(){
		// 	var album_array = $(this).closest('.imgList').data('pics').split(',');
		// 	wx.previewImage({
		// 		current:album_array[0],
		// 		urls:album_array
		// 	});
		// });
	}
});

function getList(){
	flag=false;
	var go_url = ajaxUrl;
	nowPage += 1;
	go_url += "&page="+nowPage;
	$.post(go_url,function(result){
		laytpl($('#feedbackListBoxTpl').html()).render(result, function(html){
			if(totalPage > nowPage){
				$("#pullUp").removeClass('noMore loading').show();
			}
			$('.loadMoreList').remove();
			$('.introList.list dl').append(html);
		});

		if(totalPage <= nowPage){
			$('.introList.list').after('<div class="noMore">没有更多评论了！</div>');
		}

		pageLoadTipHide();
		myScroll.refresh();
		//setTimeout("flag=true",4000);
	});
}
