<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
<link href='./Tpl/Qyapp/Attendance/js/fullcalendar/fullcalendar.css' rel='stylesheet' />
<!-- <link href='./Tpl/Qyapp/Attendance/js/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' /> -->
<script src='./Tpl/Qyapp/Attendance/js/fullcalendar/lib/moment.min.js'></script>
<script src='./Tpl/Qyapp/Attendance/js/fullcalendar/lib/jquery.min.js'></script>
<!-- <script src='./Tpl/Qyapp/Attendance/js/fullcalendar/fullcalendar.min.js'></script> -->
<script src='./Tpl/Qyapp/Attendance/js/fullcalendar/fullcalendar.js'></script>
<script src='./Tpl/Qyapp/Attendance/js/fullcalendar/lang/zh-cn.js'></script>
<script>

	$(document).ready(function() {
		$('#calendar').fullCalendar({
            header:{left: 'prev',center: 'title',right: 'next'},
            theme:false,
            contentHeight:370,			
			defaultDate: '2015-07-14',
			editable: true,		
			eventLimit: true,
			 dayClick: function(date, jsEvent, view) {
					if($(this).hasClass('active1')){
					    $(this).removeClass('active1');
						$(this).empty();
					}else{
					    var selectDay = date.format();
						$('.none-li').hide();
						$('#'+selectDay).show();
					    $('.circle').remove();
						$('.fc-day').removeClass('active1');
						$(this).addClass('active1');
						$(this).html('<span class="circle"><img src="./Tpl/Qyapp/Attendance/js/fullcalendar/1221.png" width="33px" height="33px"></span>');
					}						 
					//alert('Clicked on: ' + date.format());
					//alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
					//alert('Current view: ' + view.name);
			}				
		});		
	});

</script>
<style>
	body{margin: 20px 10px;padding: 0;font-family: "Microsoft YaHei","Lucida Grande",Helvetica,Arial,Verdana,sans-serif;font-size: 12px;color:;}
	#calendar {max-width: 900px;margin: 0 auto;}
	ul,li,p{margin:0px;padding:0px;}
	.active1{color:#fff;}
	.circle{position:absolute;top:2px;left:8px;}
	.record-li{height:55px;line-height:55px;font-size:14px;color: #333;border-bottom:1px solid rgba(169,169,169,0.6);}
	.none-li{display:none;}
</style>
</head>
<body>
	<div id='calendar'></div>
	<ul style="list-style:none;">
	    <li class="record-li">
		    <p>本月已经工作时间:<b style="color:#07f;"><?php echo ($workday); ?></b>天</p>
		</li>
		<li class="record-li">
		   <p>本月已经考勤次数:签到<b style="color:#07f;"><?php echo ($oncount); ?></b>次 签退<b style="color:orange;"><?php echo ($outcount); ?></b>次</p> 
		</li>
	</ul>
	<ul style="list-style:none;">
<!-- 	    <li class="record-li">
		    <p>本月已经工作时间:<b style="color:#07f;"><?php echo ($workday); ?></b>天</p>
		</li> -->
		<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lists): $mod = ($i % 2 );++$i;?><li class="record-li none-li" id="<?php echo (date("Y-m-d",$lists["creatime"])); ?>">
		   <p><?php if($lists['worktime']): ?>考勤签到时间<b style="color:#07f;"><?php echo (date("Y-m-d H:i:s",$lists["worktime"])); ?></b>&nbsp;&nbsp;<?php endif; ?> <?php if($lists['outtime']): ?>签退时间<b style="color:orange;"><?php echo (date("Y-m-d H:i:s",$lists["outtime"])); ?></b><?php endif; ?>
		   <?php if(($lists['worktime'] == '') AND ($lists['outtime'] == '')): ?>你今天未签到!<?php endif; ?>
		   </p>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>	
</body>
</html>