<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="cn" class="app fadeInUp animated js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
	 <title>请假申请</title>
    <meta name="viewport" content="width=./assets/scroll/device-width, initial-scale=1, maximum-scale=1">
    <meta content=" " name="Keywords">
    <meta content="" name="Description">
	<link rel="stylesheet" href="./Tpl/Qyapp/Leave/css/MOA.common.css">
	<link rel="stylesheet" href="./Tpl/Qyapp/Attendance/css/MOA.dialog.css">
	<link rel="stylesheet" href="./Tpl/Qyapp/Attendance/css/MOA.timeslider.css">
    <script src="./Tpl/Qyapp/Static/Js/scroll/dev/jquery-1.9.1.js"></script>
    <script src="./Tpl/Qyapp/Static/Js/scroll/dev/js/mobiscroll.core-2.5.2.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/scroll/dev/js/mobiscroll.core-2.5.2-zh.js" type="text/javascript"></script>
	<link href="./Tpl/Qyapp/Static/Js/scroll/dev/css/mobiscroll.core-2.5.2.css" rel="stylesheet" type="text/css" />
	<link href="./Tpl/Qyapp/Static/Js/scroll/dev/css/mobiscroll.animation-2.5.2.css" rel="stylesheet" type="text/css" />
	<script src="./Tpl/Qyapp/Static/Js/scroll/dev/js/mobiscroll.datetime-2.5.1.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/scroll/dev/js/mobiscroll.datetime-2.5.1-zh.js" type="text/javascript"></script>
	<!-- S 可根据自己喜好引入样式风格文件 -->
	<script src="./Tpl/Qyapp/Static/Js/scroll/dev/js/mobiscroll.android-ics-2.5.2.js" type="text/javascript"></script>
	<link href="./Tpl/Qyapp/Static/Js/scroll/dev/css/mobiscroll.android-ics-2.5.2.css" rel="stylesheet" type="text/css" />
	<link href="./Tpl/Qyapp/Vote/css/iDialog.css?v=2014110717" rel="stylesheet">
    <script src="./Tpl/Qyapp/Vote/js/helper.js" type="text/javascript" charset="utf-8"></script>
    <link href="./Tpl/Qyapp/Leave/css/hadms.css" rel="stylesheet" type="text/css" />
	</head>
    
    <link rel="stylesheet" href="./Tpl/Qyapp/Leave/css/holiday.css" type="text/css">
	<style>
	html, body, div, span, applet, object, iframe,h1, h2, h3, h4, h5, h6, p, blockquote, pre,a, abbr, acronym, address, big, cite, code,del, dfn, em, font, img, ins, kbd, q, s, samp,small, strike, strong, sub, sup, tt, var,b, u, i, center,dl, dt, dd, ol, ul, li,fieldset, form, label, legend,table, caption, tbody, tfoot, thead, tr, th, td,p { margin: 0; padding: 0; border: 0; outline: 0; font-size: 100%; vertical-align: baseline; background: transparent;}
	input::-webkit-input-placeholder{
    font-size: 12px;
	color:#666;
}
textarea::-webkit-input-placeholder{
    font-size: 12px;
	color:#666;
}
	
</style>
<script type="text/javascript">
        $(function(){
			var currYear = (new Date()).getFullYear();	
			var opt={};
			opt.date = {preset : 'date'};
			//opt.datetime = { preset : 'datetime', minDate: new Date(2012,3,10,9,22), maxDate: new Date(2014,7,30,15,44), stepMinute: 5  };
			opt.datetime = {preset : 'datetime'};
			opt.time = {preset : 'time'};
			opt.default = {
				theme: 'android-ics light', //皮肤样式
		        display: 'modal', //显示方式 
		        mode: 'scroller', //日期选择模式
				lang:'zh',
		        startYear:currYear - 10, //开始年份
		        endYear:currYear + 10 //结束年份
			};
			$("#appDate").val('').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
			$(".appDate").val('').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
			$(".appDate1").val('').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
			$(".appDate2").val('').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
        });
</script>
<script>
$(document).ready(function(){
	$(".submit").click(function() {
	    
		var subdata='token=<?php echo $_GET['token'];?>&wecha_id=<?php echo $_GET['wecha_id'];?>&reson='+$('.info').val()+'&type='+$('.type').val()+'&start_time='+$('.starttime').val()+'&stop_time='+$('.endtime').val()+'&typetime='+$('.typetime').val()+'&hours='+$('.hours').val()+'&daytype='+$('.daytype').val();
		$.ajax({
				type: "post",  
				url:"<?php echo U('wap_holiday_post');?>",
				dataType:'json',
				data:subdata,
				success:function(json){
					var status = json.status;
					if(status==1){
						alert('提交成功');
						window.location.href="<?php echo U('Leave/wap_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>";
					}else if(status==2){
						alert('没有请假审核人');
					}else if(status==3){
						alert('审核人id不对');
					}else if(status==4){
						alert('该类型假期时间不够了');
					}else{
						alert('提交失败');
					}
				}
			});
  });
});
</script>
<script>
$(function(){

$(".appDate").change(function(){

var str=$("#endtime").val();
var ccs= str.replace(/-/g,'/');  
var date =new Date(ccs); 
var time = date.getTime(date);
var newstr=$("#appDate").val();
var newccs= newstr.replace(/-/g,'/');
var newdate = new Date(newccs); 
var newtime =newdate.getTime(newdate);
var da=new Date(parseInt(time)-parseInt(newtime));
var nnewstr="1970/1/1";
var nnewdate = new Date(nnewstr); 
var nnewtime =newdate.getTime(nnewdate);
var year=eval(da.getFullYear()-1970);
var month =eval(da.getMonth()-1)+1;
var date =eval(da.getDate()-1);
if(year!=0&month!=0&date!=0){
$("#nusbs").html(year+"年"+month+"月"+date+"天");
}
if(year==0&month!=0&date!=0){
$("#nusbs").html(month+"月"+date+"天");
}
if(year==0&month==0&date!=0){
$("#nusbs").html(+date+"天");

}
if(year!=0&month==0&date!=0){
$("#nusbs").html(year+"年零"+date+"天");
}
if(year!=0&month==0&date==0){
$("#nusbs").html(year+"年");
}
if(year==0&month==0&date==0){
$("#nusbs").html("未到满一天");
}
if(year==0&month!=0&date==0){
$("#nusbs").html(month+"个月");
}
if(year!=0&month!=0&date==0){
$("#nusbs").html(year+"年"+month+"个月");
}
});
})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#timeType').change(function(){
			var value=$(this).val();
			if(value==1){
				//$('#inputBtime').css('display','none');
				$('#inputEtime').css('display','none');
				$('#inputHour').css('display','block');
			}
			if(value==2){
				//$('#inputBtime').css('display','none');
				$('#inputEtime').css('display','none');
				$('#inputHour').css('display','none');
				$('#chooseTime').css('display','block');
			}
			if(value==3){
				$('#inputBtime').css('display','block');
				$('#inputEtime').css('display','block');
				$('#inputHour').css('display','none');
				$('#chooseTime').css('display','none');
			}
		});
	}); 
</script>
	<body>
    <div class="holiday_all">
    <div class="holiday_border">
    	<div class="holiday_title">
        	<div>提交请假申请</div>
        </div>
        
	<!--<div id="menu" style="position:fixed;top:0px;bottom:0px;width:100%;height:44px;line-height:44px;z-index:999; border-top:none;">
				<ul style="margin:0 auto;list-style-type:none;width:100%;height:100%;">
					<li style="width:100%;">
						<div class="menu_li" style="background:#fff; color:#fff; background:#35AA47; font-size:16px;">&nbsp;提交请假申请
						</div>
						</li>
				</ul>
	</div>-->
	
	
	<div class="container"  style=" width:100%;">
    <form action="<?php echo U('Leave/wap_holiday_post');?>" method="post"> 
		<input type="hidden" value="<?php echo $_GET['token'];?>"  name="token">
		<input type="hidden" value="<?php echo $_GET['wecha_id'];?>"  name="wecha_id">	
	
	</div>
	<div class="same">[请假类型]&nbsp;&nbsp;
	<select name="type" class="selsectedd type">
		<option selected="selected" value="0">请选择请假类型</option>
		<?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($type["id"]); ?>"><?php echo ($type["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    </select>
	</div>
	<div class="same">[时间类型]&nbsp;&nbsp;
		<select class="selsectedd typetime" id="timeType">
			<option selected="selected" value="0" >请选择时间类型</option>
			<option value="1" >小时</option>
			<option value="2" >半天</option>
			<option value="3" >整天</option>
		</select>
	</div>
	<div class="same" id="inputBtime">[开始日期]<input name="starttime" class="px appDate starttime samesp" id="appDate"  value="" placeholder="请输入开始日期"  style=" color: #666;"></div>
	<div class="same" id="inputEtime">[结束日期]<input name="endtime" class="px appDate endtime samesp" id="endtime" value="" placeholder="请输入结束日期" type="text" ></div>
	<div class="same" id="inputHour" style="display:none;">[输入小时]<span class="samesp"><input name="hours" class="hours" value="" placeholder="请输入时间数" type="text" ></span></div>
	<!-- <div class="same" id="chooseTime" style="display:none;">选择时间段&nbsp;&nbsp;
	<span class="samesp">
		<input type="radio" value="1"  name="slot" >上午&nbsp;&nbsp;
		<input type="radio" value="2" name="slot"   >下午&nbsp;&nbsp;
	</span></div> -->
	
	<table class="kuang same" border="0" cellpadding="0" cellspacing="0" width="100%"  id="chooseTime" style="display:none;">
				<tr>
					<td><div class="fonsz">[选择时间]</div></td>
					<td style="position:relative">
					<div class="yushd reds dw_left">上午</div>
					<div class="yushd geyushd dw_right">下午</div>
					<div class="xian"></div>
					<input type="hidden" value="" name="order" class='daytype' id="ysex">
					</td>
				</tr>
			</table>
	
	<div class="same">[请假天数]<span class="samesp" id="nusbs">0</span>
	<!-- <span class="btright">年假剩余<span style="color:red;font-size:14px;">10</span>天</span> -->
	</div>
    <div style="background-color:#fff;padding:2%;">
	<textarea style="width:96%;height:120px;padding:2%;border:1px solid #ccc;border-radius:3px;color:#666;margin-top:10px;" type="text" class="newimg info" name="info" placeholder="请写入请假事由" ></textarea>
	</div>
	<div id="frame" >
<!--<div id="menu">
	<ul>
		<a href="<?php echo U('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" ><li style="border-right:solid 1px #ccc;"><div class="menu_li"><font color="red">&nbsp;取消</font></div>
		</li></a>
		<a class="submit"><li><div class="menu_li"><font color="green">&nbsp;提交</font></div>
		</li></a>
	</ul>
</div>
--></div>
</div>
	<a class="submit"><div class="holiday_sub">提交</div></a>
</div>

		</form>

<script>
	$(function(){
		$(".reds").click(function(){
			$(this).css({"background":"#999","border":"none","color":"#fff"});
			$(".yushd").not($(this)).css({"background":"#fff","border":"solid 1px #ccc","color":"#999"})
			$("#ysex").val(1);
		})
		$(".geyushd").click(function(){
			$(this).css({"background":"#5acf00","border":"none","color":"#fff"});
			$(".yushd").not($(this)).css({"background":"#fff","border":"solid 1px #ccc","color":"#999"})
			$("#ysex").val(2);
		})
	})
	</script>
	
	
</body>