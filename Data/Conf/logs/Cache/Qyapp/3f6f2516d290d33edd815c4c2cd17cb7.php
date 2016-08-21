<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="cn" class="app fadeInUp animated js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
	 <title>申请报销</title>
    <meta name="viewport" content="width=./Tpl/Qyapp/Static/Js/scroll/device-width, initial-scale=1, maximum-scale=1">
    <meta content=" " name="Keywords">
    <meta content="" name="Description">
	<link rel="stylesheet" href="./Tpl/Qyapp/Applyflow/css/MOA.common.css">
<link rel="stylesheet" href="./Tpl/Qyapp/Applyflow/css/MOA.dialog.css">
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
	</head>
	<style>
	html, body, div, span, applet, object, iframe,h1, h2, h3, h4, h5, h6, p, blockquote, pre,a, abbr, acronym, address, big, cite, code,del, dfn, em, font, img, ins, kbd, q, s, samp,small, strike, strong, sub, sup, tt, var,b, u, i, center,dl, dt, dd, ol, ul, li,fieldset, form, label, legend,table, caption, tbody, tfoot, thead, tr, th, td,p { margin: 0; padding: 0; border: 0; outline: 0; font-size: 100%; vertical-align: baseline; background: transparent;}

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
			$("#appDate_1").val('').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
			$("#appDate").val('').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
			$("#endtime").val('').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
			var num = 1;
			$('#zenjia').on('click',function(){
				num++;
				var html = '<div class="content_block" id="'+num+'"><div  class="same xm bgxiangmu" style="margin-top:20px;height:32px;line-height:32px;">项目'+num+'<a href="javascript:;" style="float:right;margin-right:10px;" onclick="removeProject($(this));">×</a></div><div  class="same">发生日期&nbsp;&nbsp;<br/><span class="samesp"><input name="project['+num+'][dotime]" class="px dotime" id="appDate_'+num+'" value="" placeholder="请输入发生日期" type="text" ></span></div><div  class="same ">金 额&nbsp;&nbsp;<br/><span class="samesp"><input name="project['+num+'][money]" onblur="total()" class="px money" id="money_'+num+'" value="" placeholder="请输入金额" type="text"></span></div><div class="same ">备 注&nbsp;&nbsp;<br/><span class="samesp"><input class="enter_font" type="text" value="" class="newimg info" name="project['+num+'][info]"></span></div></div>';
				$('#xm').append(html);
				$('#appDate_'+num).val('').scroller('destroy').scroller($.extend(opt['date'], opt['default']));
			});	          			
			
        });
		
    </script>
	<body style="background-color:#efedf2;">
	<div class="container">
    <form action="<?php echo U('Applyflow/wap_post');?>" method="post"> 
		<input type="hidden" value="<?php echo $_GET['token'];?>"  name="token">
		<input type="hidden" value="<?php echo $_GET['wecha_id'];?>"  name="wecha_id">	
	
	<div style="background-color:#fff;padding:2%;">
	<div class="same">费用类型&nbsp;&nbsp;<br/>
	<select name="type" class="selsectedd">
		<option selected="selected" value="0">请选择报销类型</option>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><option value="<?php echo ($list["id"]); ?>"><?php echo ($list["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
    </select>
	<!-- </span> --></div>
	<div class="same">出差地
        <span class="samesp">&nbsp;&nbsp;<br/>
            <input name="place" class="px" id="truename" value="" placeholder="请输入出差地" type="text">
        </span>
    </div>
    
	<div class="same">开始日期
        <span class="samesp"><br/>
            <input name="starttime" class="px appDate" id="appDate"  value="" placeholder="请输入开始日期" type="text" >
        </span>
    </div>
    
	<div class="same">结束日期
        <span class="samesp"><br/>
            <input name="endtime" class="px appDate" id="endtime" value="" placeholder="请输入结束日期" type="text" >
        </span>
    </div>
        <textarea class="enter_font" type="text" value="" class="newimg" name="info"></textarea>
	</div>
	
	<div class="content_down" id="xm" class="find">
	    <div class="content_block" id="1">
			<div  class="same xm bgxiangmu"  id="one" style="height:32px;line-height:32px;margin-right:4%;">项目1<a href="javascript:;" style="float:right;margin-right:2%;"></a></div>	
			
			<div  class="same ">发生日期&nbsp;&nbsp;<br/>
				<span class="samesp">
					<input name="project[1][dotime]" class="px dotime appDate" id="appDate_1" value="" placeholder="请选择发生日期" type="text" >
				</span>
			</div>
			
			<div  class="same ">金 额&nbsp;&nbsp;<br/>
				<span class="samesp">
					<input name="project[1][money]" class="px money" id="money_1" value="" onblur="total()" placeholder="请输入金额" type="text">
				</span>
			</div>
	  
			<div  class="same ">备 注&nbsp;&nbsp;<br/>
				<span class="samesp"> 
                    <textarea class="enter_font" type="text" value="" class="newimg info" name="project[1][info]"></textarea> 
				</span>
			</div>
        </div>		
	</div>
    
	<div class="btm_plus">
	    <div class="same ">合计金额:&nbsp;&nbsp;<br/>
			<span class="samesp">
				<input name="project[1][total]" class="px total" id="somemoney" value="" placeholder="请输入合计金额" type="text">
			</span>
        </div>
	<!-- <div class="same xm">大写<input name="big" class="px" id="truename" value="" placeholder="大写" type="text"></div> -->
	</div>
	<div class="more_add" id="zenjia">
        <span class="add_sign">
            +
        </span>
        增 加 一 条
    </div>
    
	<div>
	<input id="submit" class="submit" type="submit" value="提交">

	</div>
	</form>
		</div>
	<script>
	function removeProject(obj){
		obj.parent().parent().remove();
		total();
	}
	</script>
	<script>
	function total(){
		somemoney=0;
		$(".money").each(function(){
		somemoney+=Number($(this).val());
		$("#somemoney").val(somemoney+"元");
		})	    
	}
	</script>
	</body>