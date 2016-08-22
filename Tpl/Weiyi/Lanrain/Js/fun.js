function navFun(){
	$('.nav').animate({left: ($(window).width()-1200)/2+40}, 200);	
	}
//--
var fadeFlashNow=0;
function fadeFlashFun(){
	 $('.indexTop').find('.btnDiv').find('a').removeClass('aNow');
	 $('.fadeFlash').find('li').eq(fadeFlashNow).fadeOut(500);	
	 if(fadeFlashNow<$('.fadeFlash').find('li').length-1){
		 fadeFlashNow++;
		 }else{
			 fadeFlashNow=0;
			 }
	 $('.fadeFlash').find('li').eq(fadeFlashNow).fadeIn(500);	
	 $('.indexTop').find('.btnDiv').find('a').eq(fadeFlashNow).addClass('aNow');
	}	
//--
var programPart2Now=0;
function programPart2Fun(){
	$('.programPart2').find('.list').find('li').eq(programPart2Now).fadeOut(500);
	if(programPart2Now<$('.programPart2').find('.list').find('li').length-1){
		programPart2Now++;
		}else{
			programPart2Now=0;
			}
	$('.programPart2').find('.list').find('li').eq(programPart2Now).fadeIn(500);		
	}	