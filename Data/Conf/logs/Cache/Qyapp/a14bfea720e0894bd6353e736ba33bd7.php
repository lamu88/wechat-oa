<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
<title>签到</title>
<link href="./Tpl/Qyapp/Attendance/css/kaoqin.css" type="text/css" rel="stylesheet">

</head>
<body style=" background:url(./Tpl/Qyapp/Attendance/images/522ae53376ca3.jpg);">
	
	<div class="bg_s" >
    <!--头部开始-->
    	<div class="check-row">
        	<div class="check-top">
            	<div class="check-rili">
                    <div class="check-mouth"><?php echo ($date["month"]); ?>月</div>
                    <div class="check-day"><?php echo ($date["day"]); ?></div>
                </div>
                    <div class="check-record"><!-- 当天记录1条 --></div>
                    <div class="allrecord"><a href="<?php echo U('wap_records',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">所有记录</a></div>
            </div>
            
        </div>
    <!--头部结束-->
     
     
    <!--中部开始-->  
     	<div class="check-mid" id="list">
		    <div id="on">
		    <?php if($on): ?><div class="check-content">
                <div class="circle">上班</div>
                <div class="qiandao">
                    <div class="arrow-left"></div>
                    <div class="time-address"><!-- 9:04 在广东省广州市海珠区艺苑路 -->签到成功<span class="later">（签到时间<?php echo ($on["worktime"]); if($on['latime']){echo '迟到'.$on['latime'].'分钟';}?>）</span></div>
                </div>
            </div><?php endif; ?>
			</div>
		    <div id="out">			
		    <?php if($out): ?><div class="check-content">
                <div class="circle">下班</div>
                <div class="qiandao">
                    <div class="arrow-left"></div>
                    <div class="time-address"><!-- 9:04 在广东省广州市海珠区艺苑路 -->签退成功<span class="later">（签退时间<?php echo ($out["outtime"]); if($out['earlytime']){echo '早退'.$out['earlytime'].'分钟';}?>）</span></div>
                </div>
            </div><?php endif; ?>
			</div>			
        </di 
    	<div class="check-btm1" style="height:53px;width: 100%;position: fixed;bottom:0;z-index:100;background:url(Tpl/Qyapp/Attendance/images/btm03.png) repeat-x;">
        <img src="./Tpl/Qyapp/Attendance/images/btm05.png" height="130px" style="position:absolute;bottom:0;left:30%;z-index:1000;" id="btn">
		</div>	
<input type="hidden" id="pic" name="pic" value="" />
<input type="hidden" id="pic1" name="pic1" value="" />
<input type="hidden" id="longitude" name="longitude" value=""/>
<input type="hidden" id="latitude" name="latitude" value=""/>
<input type="hidden" id="place" name="place" value=""/>
<input type="hidden" id="desc" name="desc" value=""/>
<input type="hidden" id="key_2" value="<?php echo ($list["place"]); ?>" />				
    </div>
</body>
<script type="text/javascript" src="./Tpl/Qyapp/Attendance/js/jquery-1.9.1.min.js"></script>