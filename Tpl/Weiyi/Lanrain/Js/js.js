$(function(){
	navFun();
	$(window).resize(function(){
		navFun();
		})
	//--
	if($('.fadeFlash').length>0){
		//fadeFlashTime = setInterval("fadeFlashFun()",5000);
		}
	$('.fadeFlash').find('li:first').fadeIn(500);	
	$('.indexTop').find('.btnDiv').find('li').each(function(i){
		$(this).click(
		   function(){
			   //clearInterval(fadeFlashTime);
			   $('.indexTop').find('.btnDiv').find('a').removeClass('aNow');
			   $(this).find('a').addClass('aNow');
			   $('.fadeFlash').find('li').eq(fadeFlashNow).fadeOut(500);	
			   fadeFlashNow=i;
			   $('.fadeFlash').find('li').eq(fadeFlashNow).fadeIn(500);	
			   //fadeFlashTime = setInterval("fadeFlashFun()",5000);
			   }
		)
		})
	//--
	if($('.programPart2').length>0){
		setInterval("programPart2Fun()",5000);
		}	
	//--
	$('.topLoingA').hover(
	    function(){
			$('.loginLafyer').css('left',$(this).offset().left-155);
			$('.loginLafyer').show();
			},
		function(){
			$('.loginLafyer').hide();
			}
	)	
	$('.loginLafyer').hover(
	    function(){
			$('.loginLafyer').show();
			},
		function(){
			$('.loginLafyer').hide();
			}
	)	
	//--
	$('.programPart2').find('.list').find('li:first').fadeIn(500);
	//--
	var caseNow=new Array();
	for(i=0;i<50;i++){
	  caseNow[i]=0;	
	}
	$('.case').find('.wal').each(function(i){
		if($(this).find('li').length>2){
		$(this).find('ul').html($(this).find('ul').html()+$(this).find('ul').html());
		$(this).find('li').eq(2).addClass('liNow');
		}
		$(this).find('.rightBtn').click(function(){
				caseNow[i]++;
				$('.case').find('.wal').eq(i).find('li').removeClass('liNow');
				$('.case').find('.wal').eq(i).find('li').eq(caseNow[i]+2).addClass('liNow');
				$('.case').find('.wal').eq(i).find('.list').animate({scrollLeft: caseNow[i]*230}, 200,function(){
					if(caseNow[i]==$('.case').find('.wal').eq(i).find('li').length/2){
						caseNow[i]=0;
						$('.case').find('.wal').eq(i).find('.list').scrollLeft(0);
						}
					});	
			})
		$(this).find('.leftBtn').click(function(){
				if(caseNow[i]==0){
					caseNow[i]=$('.case').find('.wal').eq(i).find('li').length/2;
					$('.case').find('.wal').eq(i).find('.list').scrollLeft(caseNow[i]*230);
					$('.case').find('.wal').eq(i).find('li').removeClass('liNow');
					$('.case').find('.wal').eq(i).find('li').eq(caseNow[i]+2).addClass('liNow');
					}
				caseNow[i]--;
				$('.case').find('.wal').eq(i).find('li').removeClass('liNow');
				$('.case').find('.wal').eq(i).find('li').eq(caseNow[i]+2).addClass('liNow');
				$('.case').find('.wal').eq(i).find('.list').animate({scrollLeft: caseNow[i]*230}, 200);
			})	
		})
	//--
	$(window).scroll(function(){
		if($(window).scrollTop()>$(window).height()/2){
			$('.rightA').show();
			}else{
				$('.rightA').hide();
				}
		})	
	$('.rightA').find('.li_06').find('a').click(function(){
		$('body,html').animate({scrollTop: 0}, 500);
		})	
	//
	})