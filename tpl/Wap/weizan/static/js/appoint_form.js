var motify = {
	timer:null,
	log:function(msg){
		$('.motify').hide();
		if(motify.timer) clearTimeout(motify.timer);
		if($('.motify').size() > 0){
			$('.motify').show().find('.motify-inner').html(msg);
		}else{
			$('body').append('<div class="motify" style="display:block;"><div class="motify-inner">'+msg+'</div></div>');
		}
		motify.timer = setTimeout(function(){
			$('.motify').hide();
		},3000);
	}
};
var map = null;
var marker = null;
$(function(){
	
	$('section').css('min-height','100%');
	
	$('.comm-service').click(function(){
		if($('#service-type .service-list li').size() > 2){
			$('#service-type').show();
			$('#main').hide();
		}
	});
	
	$('#service-type .service-list li').click(function(){
		$(this).addClass('active').siblings('li').removeClass('active');
        $('.comm-service h2').html($(this).find('span[data-role="content"]').html());
		$('.comm-service h1').html($(this).find('h3[data-role="title"]').html());
		$('.comm-service em font').html($(this).find('span[data-role="payAmount"]').html());
		$('#service_name').val($(this).find('h3[data-role="title"]').html());
        $('#service_money').val($(this).find('span[data-role="payAmount"]').html());
		$('#main').show();
        $('#service-type').hide();
		$(window).scrollTop(0);
	});
	
	$('.arrow-wrapper').click(function(){
		closeWin();
	});
	
	$('[data-role="chooseTime"]').click(function(){
		$('#service-date').show();
		$('#main').hide();
	});
	
	$('.yxc-time-con dt[data-role="date"]').click(function(){
		$('.yxc-time-con dt[data-role="date"]').removeClass('active');
		$(this).addClass('active');
		$('.date-'+$(this).data('date')).show().siblings('div').hide();
	});
	
	$('.yxc-time-con dd[data-role="item"]').click(function(){
		if(!$(this).hasClass('disable') && !$(this).hasClass('all')){
			$('.yxc-time-con dd[data-role="item"]').removeClass('active');
			$(this).addClass('active');
			$('#serviceJobTime').val($('.yxc-time-con dt[data-role="date"].active').data('text') + ' ' +$(this).data('peroid'));
			$('#service_date').val($('.yxc-time-con dt[data-role="date"].active').data('date'));
			$('#service_time').val($(this).data('peroid'));
			closeWin();
		}
	});
	
	$('textarea.ipt-attr').focus(function(){
		$(this).css('height','60px');
	}).blur(function(){
		if($(this).val() == ''){
			$(this).css('height','24px');
		}
	});
	
	$('.select select').change(function(){
		if($(this).val() != ''){
			$(this).css('color','#555');
		}else{
			$(this).css('color','#999');
		}
	});
	
	$('input[data-role="position"]').click(function(){
		$('#service-position').css({'z-index':'1111','opacity':1}).show();
		$('#main').hide();
		if(map == null){
			$('#allmap').height($(window).height()-41);
		}
		selectPosition($(this));
	});
	
	$('.bt-sub-order').click(function(){
		var nowDom = $(this);
		if($('#store_id').val() == ''){
			$(window).scrollTop($('#store_id').offset().top-20);
			motify.log('请选择预约店铺');
			return false;
		}
		if($('#service_date').val() == ''){
			$(window).scrollTop($('#serviceJobTime').offset().top-20);
			motify.log('请选择预约时间');
			return false;
		}
 
	});
});

function formError(tmpDom){
	$('.form_error').removeClass('form_error');
	motify.log(tmpDom.attr('placeholder'));
	$(window).scrollTop(tmpDom.offset().top-20);
	tmpDom.closest('li').addClass('form_error');
}

var map = null;
var marker = null;
function selectPosition(objDom){
	// 百度地图API功能
	if(objDom.data('long')){
		// setTimeout(function(){
			map.centerAndZoom(new BMap.Point(objDom.data('long'),objDom.data('lat')), 18);
			marker.setPosition(new BMap.Point(objDom.data('long'),objDom.data('lat')));
		// },300);
	}else{
		map = new BMap.Map("allmap",{enableMapClick:false});
		if(user_long == 0){
			map.centerAndZoom(user_city, 11);  
		}else{
			map.centerAndZoom(new BMap.Point(user_long,user_lat), 18);
		}
		map.addControl(new BMap.ZoomControl()); //添加地图缩放控件
		
		var gc = new BMap.Geocoder();  
		map.addEventListener("click", function(e){
			var pt = e.point;
			if(map.getZoom() < 12){
				map.centerAndZoom(new BMap.Point(pt.lng,pt.lat), 18);
			}else{
				if(marker == null){
					marker = new BMap.Marker(new BMap.Point(pt.lng,pt.lat));
					map.addOverlay(marker);
				}else{
					marker.setPosition(new BMap.Point(pt.lng,pt.lat));
				}
				map.centerAndZoom(new BMap.Point(pt.lng,pt.lat), 18);
				gc.getLocation(pt, function(rs){
					var addComp = rs.addressComponents;
					var addressCon = addComp.province + " " + (addComp.city == addComp.province ? '' :addComp.city + " ") + addComp.district + " " + addComp.street + " " + addComp.streetNumber;
					layer.open({
						title:['位置提示','background-color:#8DCE16;color:#fff;'],
						content:'您选择的位置是：'+addressCon,
						btn: ['确定位置','重新选择'],
						yes:function(index){
							objDom.closest('li').find('input[data-type="long"]').val(pt.lng);
							objDom.closest('li').find('input[data-type="lat"]').val(pt.lat);
							objDom.closest('li').find('input[data-type="address"]').val(addressCon);
							objDom.data({'long':pt.lng,'lat':pt.lat,'address':addressCon}).val(addressCon);
							layer.close(index);
							closeWin();
						}
					});
				});  
			}
		});
	}
}

function closeWin(){
	$('#service-type').hide();
	$('#service-date').hide();
	$('#service-position').css({'z-index':'-999','opacity':0});
	$('#main').css('z-index','0').show();
}