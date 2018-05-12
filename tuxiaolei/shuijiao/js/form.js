var link =  document.location.toString();
if(document.getElementById("url")!=null){document.getElementById("url").value = link;}
document.getElementById("url2").value = link;
window.onload = function(){
		var nowDate = new Date();
		var str = nowDate.getFullYear()+"-"+(nowDate.getMonth() + 1)
		+"-"+nowDate.getDate()+" "+nowDate.getHours()+":"+nowDate.getMinutes()
		+":"+nowDate.getSeconds();
		if(document.getElementById("time")!=null){document.getElementById("time").value=str;}
		document.getElementById("time2").value=str;
	}
$(function(){
	if($('select').hasClass('pc-select-quyu')){
		//地区5
		var $ld5 = $(".pc-select-quyu");					  
		$ld5.ld({ajaxOptions : {"url" : "http://www.yuanjian-china.com/api.php?op=get_linkage&act=ajax_select&keyid=1"},defaultParentId : 0,style : {"width" : 120}})	 
		var ld5_api = $ld5.ld("api");
		ld5_api.selected();
		$ld5.bind("change",onchange);
		function onchange(e){
			var $target = $(e.target);
			var index = $ld5.index($target);
			$("#quyu").val($ld5.eq(index).show().val());
			index ++;
			$ld5.eq(index).show();
		}
	}
	var $ld6 = $(".pc-select-quyu2");					  
	$ld6.ld({ajaxOptions : {"url" : "http://www.yuanjian-china.com/api.php?op=get_linkage&act=ajax_select&keyid=1"},defaultParentId : 0})	 
	var ld6_api = $ld6.ld("api");
	ld6_api.selected();
	$ld6.bind("change",onchange2);
	function onchange2(e){
		var $target2 = $(e.target);
		var index2 = $ld6.index($target2);
		$("#quyu2").val($ld6.eq(index2).show().val());
		index2 ++;
		$ld6.eq(index2).show();
	}
	//表单验证
	$("#myform,#myform2").submit(function(){
		var tg = true;
		$(this).find('.yanzheng').each(function(){
			var bz = $(this).attr('data-bz');
			if($(this).val() == '') {
				alert(bz + "不能为空");
				$(this).focus();
				tg = false;
				return false;
			}else if(bz == "电话" && !$(this).val().match(/^(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/)) {
				alert(bz + "输入不正确");
				$(this).focus();
				tg = false;
				return false;
			}
		});
		if(tg) {
			alert("您的信息提交成功，我们的工作人员会尽快与您联系！");
			setTimeout(function(){
				window.location.reload();
			},500);
		};
		return tg;
	});
});