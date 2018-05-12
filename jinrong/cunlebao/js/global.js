

/* $(document).ready(function(){
	$('body').hide().after("<div id='loading'><em></em><div><img src='../img/logo.png'><p>0%</p></div></div>");
	var loadEm = $('#loading').find('em');
	var loadP = $('#loading').find('p');

	var aImg = $('img');
	var aImgSrc = [];
	for (var i = 0; i < aImg.length; i++) {
		aImgSrc.push(aImg.eq(i).attr('src'));
	}
	preloadImgs(aImgSrc, show, function(){
		$('#loading').html('image loading errors, please reflash.');
	}, function (rate){
		rate = Math.ceil(rate)+'%';
		loadEm.stop().animate({width:rate},200);
		loadP.html(rate);
	})
})
function preloadImgs(arr, fnSucc, fnFaild, fnProgress){
	var loaded = 0;
	for(var i = 0; i < arr.length; i++){
		var oImg = new Image();
		oImg.onload = function (){
			loaded++;
			fnProgress && fnProgress(loaded/arr.length * 100);
			if(loaded == arr.length) fnSucc && fnSucc();
			this.onload = this.onerror = null;
			this.src = '';
		}
		oImg.onerror = function (){
			fnFaild && fnFaild(this.src);
			fnFaild = fnSucc = fnProgress = null;
		}
		oImg.src = arr[i];
	}
}
function show(){
	setTimeout(function(){
		$('#loading').addClass('ed');
		$('body').fadeIn();
		setTimeout(function(){
			$('#loading').hide()
		},2000);
		try {
			verticalB();
		}catch(err){
		}
	},1000)
} */