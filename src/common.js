$(function(){
	var wid=window.innerWidth;
	$('html').css({fontSize:wid/7.5+'px'});
	$('#menuIcon').on('touchstart',function(){
		if($('nav').css('left')=='0px'){
			$('nav').animate({left: '-7.5rem'},800);
		}else{
			$('nav').animate({left: '0'},800);
		}
	})
})