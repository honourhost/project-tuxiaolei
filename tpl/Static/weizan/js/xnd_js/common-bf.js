// $(function(){
// 	//单独选择某一个
// 	$("input[type='radio']").click(function(){
// 			var index=$("input[type='radio']").index(this);
// 			$("input[type='radio']").eq(index).toggleClass("radioed");//伪复选
// 	});	
// 	//全选
// 	$("#check_all,#box_all").click(function(){
//      $("input[type='radio']").attr("radioed",$(this).attr("radioed"));
// 	 $("input[type='radio'],#check_all,#box_all").toggleClass("radioed");
// 	});

// });
$(function(){
	$(".Spinner").Spinner();
	//单独选择某一个
	$("input[type='checkbox']").click(function(){
			var index=$("input[type='checkbox']").index(this);
			if($(this).attr("checked")){
			$(this).removeAttr("checked");
			}else{
				$(this).attr("checked","true");
			}
			$("input[type='checkbox']").eq(index).toggleClass("checked");//伪复选
			var flag=checkAll();
			if(flag){
				if(!($("#check_all").attr("checked"))){
				$("#check_all").toggleClass("checked");
				}
				$("#check_all").attr("checked","true");
			}else{
				if($("#check_all").attr("checked")){
					$("#check_all").removeAttr("checked");
					$("#check_all").toggleClass("checked");
				}
			}
	});	
	//全选
	$("#check_all,#box_all").click(function(){
     if($("#check_all").attr("checked")){
     $("#check_all").removeAttr("checked");
     $("#check_all").removeClass("checked");
 	 }else{
 	 	$("#check_all").attr("checked",true);
 	 	$("#check_all").addClass("checked");
 	 }
 	 var flag=checkAll();
 	 if(flag){
 	 	$("input[type='checkbox']").removeAttr("checked");
 	 	$("input[type='checkbox']").removeClass("checked");
 	 }else{
 	 	$("input[type='checkbox']").attr("checked",true);
 	 	$("input[type='checkbox']").addClass("checked");
 	 }
	 
	});

	function checkAll(){
		var flag=true;
		$("input[type='checkbox']").each(function () {   
        if(!$(this).attr("checked")){
        	flag=false;
        } 
    	}); 
		if(!flag){
			return false;
		}else{
			return true;
		}
	}
	$('.order-header-bj').click(function(){
    		$('.order-header-bj').hide();
    		$('.order-header-wc').show();
    		$('.phone-order-footer-del').show();
    		$('.phone-order-footer').hide();
    	});
    	$('.order-header-wc').click(function(){
    		$('.order-header-bj').show();
    		$('.order-header-wc').hide();
    		$('.phone-order-footer-del').hide();
    		$('.phone-order-footer').show();
    	});
	$("#delete").click(function(){
    		var check_all=$("input[type='checkbox']");
    		check_all.each(function(){
    			if($(this).attr("checked")){
    				$(this).parent().remove();
    			}
    		});
    	});

});
