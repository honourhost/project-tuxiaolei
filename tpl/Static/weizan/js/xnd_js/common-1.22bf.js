$(function(){
	//单独选择某一个
	$("input[type='radio']").click(function(){
			var index=$("input[type='radio']").index(this);
			$("input[type='radio']").eq(index).toggleClass("radioed");//伪复选
	});	
	//全选
	$("#check_all,#box_all").click(function(){
     $("input[type='radio']").attr("radioed",$(this).attr("radioed"));
	 $("input[type='radio'],#check_all,#box_all").toggleClass("radioed");
	});

});
$(function(){
	//单独选择某一个
	$("input[type='checkbox']").click(function(){
			var index=$("input[type='checkbox']").index(this);
			$("input[type='checkbox']").eq(index).toggleClass("checked");//伪复选
	});	
	//全选
	$("#check_all,#box_all").click(function(){
     $("input[type='checkbox']").attr("checked",$(this).attr("checked"));
	 $("input[type='checkbox'],#check_all,#box_all").toggleClass("checked");
	});

});
