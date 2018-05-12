$(function(){
	//$('#container').height($(window).height()-$('header').height()-$('footer').height()-5).css('overflow-y','scroll');
	$('.nav-dropdown-btn').click(function(){
		if($('#nav-dropdown').hasClass('active')){
			$('#nav-dropdown').removeClass('active');
		}else{
			$('#nav-dropdown').addClass('active');
		}
		return false;
	});
	$('body').bind('click',function(e){
		$('#nav-dropdown').removeClass('active');
	});
	
	$(window).scroll(function(){
		if($(window).scrollTop()>150){
			$('.top-btn').show();
		}else{
			$('.top-btn').hide();
		}
	});
	
	$('.top-btn').click(function(){
		$(window).scrollTop(0);
	});
	
	$('.phone').click(function(){

		if($(this).attr('data-phone')){
			var bg_height = $(window).height();
			var msg_dom = '<div class="msg-bg" style="height:'+bg_height+'px;display: none;position: fixed;"></div>';
			msg_dom+= '<div id="msg" class="msg-doc msg-option" style="bottom:-100%">';
            
            //刘畅 - 新增 电话号分割
            phone=$(this).attr('data-phone');
            phone_arr=phone.split(" ");

            if(phone_arr.length > 1)
            {
                for(var i=0;i<phone_arr.length;i++)
                {
                    msg_dom+= '<div class="msg-option-btns" style="margin-top:0px;"><a class="btn msg-btn" href="tel:'+phone_arr[i]+'">商家电话: '+phone_arr[i]+'</a></div>';
                }
            }
            else
            {
			     msg_dom+= '<div class="msg-option-btns" style="margin-top:0px;"><a class="btn msg-btn" href="tel:'+phone+'">商家电话: '+phone+'</a></div>';
		  	}
            msg_dom+= '		<button class="btn msg-btn-cancel" type="button" onclick="phone_on()">取消</button>';
			msg_dom+= '</div>';
			
			$('body').append(msg_dom);
            $('.msg-bg').fadeIn();
            $('#msg').animate({bottom:"0"});
		}
	});
	
    
     //刘畅 - 轮播图 高度 自适应
     $(".banner").css("height",$(".swiper-slide img").height()+"px");
});

function phone_on()
{
		$('.msg-doc,.msg-bg').remove();
}

function is_weixin(){
    var ua = navigator.userAgent.toLowerCase();
    if(is_mobile() && ua.match(/MicroMessenger/i)=="micromessenger") {  
        return true;  
    } else {  
        return false;  
    }  
}

function is_mobile(){
	if ((navigator.userAgent.match(/(iPhone|iPod|Android|ios|iPad)/i))){
		if((navigator.platform.indexOf("Win") == 0) || (navigator.platform.indexOf("Mac") == 0) || ((navigator.platform.indexOf("Linux") == 0) || (navigator.platform == 'X11'))){
			return false;
		}else{
			return true;
		}
	}else{
		return false;
	}
}