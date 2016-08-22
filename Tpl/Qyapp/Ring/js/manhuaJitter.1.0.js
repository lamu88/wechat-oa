/***
 * ����Jquery�������
 * ��дʱ�䣺2012��9��27��
 * version:manhuaJitter.1.0.js
 * http://www.jq-school.com
***/
$(function() {
	$.fn.manhuaJitter = function(options) {
		var defaults = {
			Event : "click",								//������Ӧ�¼�
			direction : 0,									//Ĭ��Ϊ0�����ҷ���1�����·���
			isAuto : false,									//�Ƿ��Զ�����			
			time : 2000,									//�����Զ�����ʱ�䣬ǰ����isAuto=true
			speed : 50,										//�������ٶ�
			isCycle : false  								//�Ƿ�ѭ��	
		};
		var options = $.extend(defaults,options);		
		var $this = $(this);								//��Ȼ��Ӧ�¼�����		
		//�ı�����¼�
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

