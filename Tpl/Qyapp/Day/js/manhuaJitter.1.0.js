/***
 * 漫画Jquery抖动插件
 * 编写时间：2012年9月27号
 * version:manhuaJitter.1.0.js
 * http://www.jq-school.com
***/
$(function() {
	$.fn.manhuaJitter = function(options) {
		var defaults = {
			Event : "click",								//触发响应事件
			direction : 0,									//默认为0、左右方向，1、上下方向
			isAuto : false,									//是否自动抖动			
			time : 2000,									//设置自动抖动时间，前提是isAuto=true
			speed : 50,										//抖动的速度
			isCycle : false  								//是否循环	
		};
		var options = $.extend(defaults,options);		
		var $this = $(this);								//当然响应事件对象		
		//文本框绑定事件
		$this.die().live(options.Event,function(e){											  
			$(this).css({'position':'absolute'}); 
			var offset = $(this).offset();
			if (options.direction==0){
				for(var i=1; 4>=i; i++){   
					$this.animate({left:offset.left-(40-10*i)},options.speed);   
					$this.animate({left:offset.left+2*(40-10*i)},options.speed);   
				} 
			}else{
				for(var i=1; 4>=i; i++){   
					$this.animate({top:offset.top-(40-10*i)},options.speed);   
					$this.animate({top:offset.top+2*(40-10*i)},options.speed);   
				} 
			}	
		});	
		if (options.isAuto){
			var st = setInterval(function (){			
				$this.trigger(options.Event);
				if(!options.isCycle){
					clearTimeout(st);
				}
			},options.time);	
		}
	}
});

