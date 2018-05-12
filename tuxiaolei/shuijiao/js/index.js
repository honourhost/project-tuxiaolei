$(function(){
		//bootstrap触屏事件
	var isTouch=('ontouchstart' in window);
	if(isTouch){
		$(".carousel").on('touchstart', function(e){
			var that=$(this);
			var touch = e.originalEvent.changedTouches[0];
			var startX = touch.pageX;
			var startY = touch.pageY;
			$(document).on('touchmove',function(e){
				touch = e.originalEvent.touches[0] ||e.originalEvent.changedTouches[0];
				var endX=touch.pageX - startX;
				var endY=touch.pageY - startY;
				if(Math.abs(endY)<Math.abs(endX)){
					if(endX > 10){
						$(this).off('touchmove');
						that.carousel('prev');  
					}else if (endX < -10){
						$(this).off('touchmove');
						that.carousel('next');
					}
					return false;
				}
			});
		});
		$(document).on('touchend',function(){
			$(this).off('touchmove');
		});	
	}
	$("header a.menu").click(function(){
		$("nav").slideToggle();
	});
	$('.phone_nav .son_nav').click(function(){
		$(this).find('ul').slideToggle();
	})
	//产品展示
    var $this = $(".pro_pic ul");
	var left = $(".icon_left");
    var right = $(".icon_right");
    var scrollTimer;
	
    $(".pro_pic").hover(function(){//鼠标经过停止滚动
          clearInterval(scrollTimer);
     },function(){
       scrollTimer = setInterval(function(){
                     scrollProduct($this);
                }, 5000 );
    }).trigger("mouseout");

    function scrollProduct(){//左侧滚动函数
      var lineWidth = $this.find("li:first").width();
      $this.animate({"margin-left":-lineWidth+"px"},1000, function(){
        $this.css("margin-left","0px").find("li:first").appendTo($this);
      })
    }
	function scrollProduct2(){//右侧滚动函数
      var lineWidth = $this.find("li:first").width();
	  $this.css("margin-left",-lineWidth+"px");
	   $this.animate({"margin-left":"0px"},1000);
	  $this.find("li:last").prependTo($this);
    }
	left.click(function(){
		scrollProduct($this);
	});
	right.click(function(){
		scrollProduct2($this);
	});
//返回顶部
$(window).scroll(function(){
		var Top = $(this).scrollTop();
		if(Top > 500){
			$("#gotop").fadeIn();
		}else {
			$("#gotop").fadeOut();
		}
	});
	$("#gotop").click(function(){
		$("html,body").animate({
			scrollTop:0
		},500);
	});
	
	
});