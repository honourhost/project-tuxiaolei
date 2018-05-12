

$("#subform").click(function(){
	if($("#name").val()==""){
		alert("请填写姓名！");
		return;
	}
	if($("#telephone").val()==""){
		alert("请填写联系方式！");
		return;
	}
	$.post("/index.php?g=Index&c=Fabu&a=addConference",$("#participate").serialize(),function(data){
	if(data.status==1){
		alert(data.info);
	}else if(data.status==0){
		alert(data.info);
	}else{
		alert("参加失败，请重试！");
	}
	});
	}
	);
