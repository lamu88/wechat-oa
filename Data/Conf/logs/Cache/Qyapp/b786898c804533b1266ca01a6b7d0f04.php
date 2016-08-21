<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>新增审批</title>
    <link rel="stylesheet" href="Tpl/Qyapp/Workflow/css/style1.css">
    <link rel="stylesheet" href="Tpl/Qyapp/Workflow/css/date.css">
<style type="text/css">
#plug-wrap {position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0, 0, 0, 0);z-index:800;}
.top_bar {position:fixed;bottom:0;right:0px;z-index:900;-webkit-tap-highlight-color: rgba(0, 0, 0, 0);font-family: Helvetica, Tahoma, Arial, Microsoft YaHei, sans-serif;}
.plug-menu {-webkit-appearance:button;display:inline-block;width:50px;height:50px;border-radius:36px;position: absolute;bottom:35px;right: 20px;z-index:999;-webkit-transition: -webkit-transform 200ms;-webkit-transform:rotate(1deg);color:#fff;background-image:url('images/ico/plug.png');background-repeat: no-repeat;-webkit-background-size: 80% auto;background-size: 100% auto;background-position: center center;}
#upmenu{background: #000; width:100%; height: 100%; filter:alpha(opacity=50);-moz-opacity:0.8;-khtml-opacity: 0.8;opacity: 0.8; position: absolute;top: 600px; display: none;}
#content1 {max-width: 640px;min-width: 320px; height: 600px;  margin: 0 auto; position: relative; border: 1px solid black; }
#bj1{background: black; width:100%; height: 100%; filter:alpha(opacity=50);-moz-opacity:0.8;-khtml-opacity: 0.8;opacity: 0.8; position: absolute;top: 600px; display: none; }
a {color:white;}
.menu1{-webkit-transition: 0.4s;-webkit-transition: -webkit-transform 0.4s ease-out;transition: transform 0.4s ease-out;-moz-transition: -moz-transform 0.4sease-out;}
.menu1:hover{transform: rotateZ(360deg);-webkit-transform: rotateZ(360deg);-moz-transform: rotateZ(360deg);}
</style>	
</head>
<body class="bg1">
<section class="sec_banner01" >
</section>
<section class="sec01-01">
    <div class="slideTxtBox">
        <div class="hd flow_no">
            <ul id="tab" class="bd_t">
				<?php if($list ): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class="flow_li">
				<!--li-w start-->
				   <a href="<?php echo U('post_act',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'a_id'=>$list['id']));?>">				
                    <div class="">
                    <img src="<?php echo ($list["icon"]); ?>" width="70px">
                    <div class="li-txt"><?php echo ($list["name"]); ?></div>
                    </div>
					</a> 
                </li><?php endforeach; endif; else: echo "" ;endif; ?>				
				<?php else: ?>
				<p style="text-align:center;height:30px;line-height:30px;padding:5px;">
					<span style="margin-bottom:10px;font-size:16px;padding-bottom:10px;position:relative;padding-left:30px;padding-top:3px;"><img src="./Tpl/Qyapp/Workflow/images/tishi.png" width="24px" height="24px" style="position:absolute;top:0;left:0;">暂无审批类型</span>
				</p><?php endif; ?>				
                <div class="clear"></div>
            </ul>
        </div>
       
    </div>
</section>
<div class="top_bar" style="-webkit-transform:translate3d(0,0,0)">
 <nav>
    <ul id="top_menu" class="top_menu">
      <input type="checkbox" id="plug-btn" class="plug-menu themeStyle" style="border-radius:64px;background-image:url('./Tpl/Qyapp/Applyflow/images/menu01.png');background-color:none;border:0px;"> 	   
	</ul>
  </nav>
</div>
<div id="plug-wrap" style="display: none;" ></div>
<!--menu end-->
<!--rili start-->
<div id="datePlugin"></div>
<div class="hd" id="upmenu">
	<ul id="tab" style="position:absolute;bottom:10px;z-index:8888;width:75%;">
		<a href="<?php echo U('Workflow/wap_act_my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">
		<li style="width: 33.333%;float: left;">
			<div class="li-c">
			<img src="Tpl/Qyapp/Applyflow/images/14.png" height="50px" width="50px" style="display: block;max-width: 100%;margin: 0 auto;">
			<div class="li-txt" style="font-size: 14px;line-height: 24px;text-align: center;">我的</div>
			</div>
		</li>
		</a>				
		<a href="<?php echo U('Workflow/wap_act_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">
		<li style="width: 33.333%;float: left;">
			<div class="li-c">
			<img src="Tpl/Qyapp/Applyflow/images/16.png" height="50px" width="50px" style="display: block;max-width: 100%;margin: 0 auto;">
			<div class="li-txt" style="font-size: 14px;line-height: 24px;text-align: center;">审批</div>
			</div>
		</li>
		</a>
		<a href="<?php echo U('Workflow/wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">
		<li style="width: 33.333%;float: left;">
			<div class="li-c">
			<img src="Tpl/Qyapp/Applyflow/images/15.png" height="50px" width="50px" style="display: block;max-width: 100%;margin: 0 auto;">
			<div class="li-txt" style="font-size: 14px;line-height: 24px;text-align: center;">新增</div>
			</div>
		</li>
		</a>		
		<div class="clear"></div>
	</ul>
</div>
<script src="./Tpl/Qyapp/Static/Js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
    $('#top_menu').click(function(){
	    var window_height = $(window).height()+'300px';
		if ($("#upmenu").css("display") == 'none')
		{
			$("#upmenu").show();		
			$("#upmenu").animate({ top: '0px' }, 300);
		} else {
			$("#upmenu").animate({ top: window_height }, 300, "", function(){
				$("#upmenu").hide();
			});
		}	
	});
});
</script> 
</body>
</html>