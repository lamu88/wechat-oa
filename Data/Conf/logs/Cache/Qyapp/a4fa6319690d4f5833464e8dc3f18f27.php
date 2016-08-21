<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title id="title"><?php echo ($title); ?></title>
    <link rel="stylesheet" href="Tpl/Qyapp/Task/css/style.css">
    <link rel="stylesheet" href="Tpl/Qyapp/Day/css/date.css">
</head>
<body class="bg1">
<!--header start-->
<!--<header>
    <a class="pre"><img src="images/header-pre.png"></a>
    <div class="txt">报 销</div>
</header>-->
<!--header end-->
<!--sec-banner01 start-->
<section class="top" >
	<ul style="">
		<li style="width:25%;">
			<?php if($users['pic']): ?><img src="<?php echo ($users["pic"]); ?>" width="72px" height="72px" style="border-radius:10px;"><?php else: ?><img src="./Tpl/Qyapp/Applyflow/images/que.png" width="72px" height="72px" style="border-radius:10px;"><?php endif; ?>
		</li>
		<li style="width:55%;">
			<p class="top-p" style="font-size:24px;margin-bottom:8px;"><?php echo ($users["name"]); ?></p>
			<p class="top-p">职务:<?php echo ($users["position"]); ?></p>
			<p class="top-p">部门:<?php echo ($users["department"]); ?></p>		
		</li>
		<li style="width:20%;text-align:center;padding-top:10px;position:relative;">
		    <img src="./Tpl/Qyapp/Applyflow/images/rili.png"  width="50px" height="50px" id="beginTime">
			<p style="position:absolute;top:21px;left:19px;color:#fff;">
			<span style="font-size:10px;color:#fff;" id="nian"><?php echo $showtime=date("Y");?></span><br>
			<span style="font-size:18px;color:#fff;" id="yue"><?php echo $showtime=date("m");?><label style="font-size:12px;color:#fff;">月</label></span>
			<input type="hidden" name="begintime" id="beginTime" class="input-text" value="">
			</p>	
		</li>
	</ul>
</section>
<!--sec-banner01 end-->
<!--sec01-01 start-->
<section class="sec01-01">
    <div class="slideTxtBox">
        <div class="hd">
            <ul id="tab">
				<li class="li-status" style="width:50%">
                    <div class="li-c" style="margin-left:10px;">
						<span class="span-center" style="color:#C5CB63;" id="jxshu"><?php if($count2): echo ($count2); else: ?>0<?php endif; ?></span>
						<div class="li-txt" style="color:#575757;" >进行中</div>
                    </div>
                </li>
                
				<li class="li-status" style="width:50%">
                    <div class="li-c" style="margin-left:10px;">
						<span class="span-center" style="color:#C5CB63;" id="wcshu"><?php if($count1): echo ($count1); else: ?>0<?php endif; ?></span>
						<div class="li-txt" style="color:#575757;" >已完成</div>
                    </div>
                </li>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="bd" id="content">
			 
			<ul style="display:block;" >
			<?php if($list1): if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list1): $mod = ($i % 2 );++$i; if($list1['status'] == 0){?>
               <li style="margin-top:10px;border:1px solid #dbdbdb;">
				   <a href="<?php echo U('wap_act_info',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$list1['id']));?>">
                   <div class="li-w">
                       <div>
                           <div class="li-c" style="position:relative;">					   
                               <div class="fr-c ">	
                                   <dl>
									  <dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Task/images/icon0<?php if($list1['order'] == 3){echo 4;}elseif($list1['order'] == 2){echo 5;}else{echo 6;}?>.png" class="pic1"></dd>
                                       <dd style="float:left;">
									       <span>协助主题：<?php echo ($list1["title"]); ?></span></br>
										   <span>发起人：<?php echo ($list1["name"]); ?></span></br>
										   <span>负责人：<?php echo ($list1["fuzeren"]); ?></span></br>
                                       </dd>
                                       <div class="clear"></div>
									   <div class="time task_time">
									提交时间：&nbsp;&nbsp;<span><?php echo (date("Y-m-d H:i:s",$list1["mktime"])); ?></span></br>
								   </div>
                                   </dl>
                               </div>
                           </div>
                       </div>
                       <div class="clear"></div>
                   </div>
				   </a> 
                </li>
				 <?php } endforeach; endif; else: echo "" ;endif; ?>
			
                <?php else: ?>
				   <p style="text-align:center;padding-top:30px;">
				   <img src="./Tpl/Qyapp/Applyflow/images/que.png" width="100px" height="100px">
				   <br>
                    暂无数据
					</p><?php endif; ?>	
            </ul>	
            <ul style="display:none;">
			<?php if($list): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list2): $mod = ($i % 2 );++$i; if($list2['status'] == 1){?>
               <li style="margin-top:10px;border:1px solid #dbdbdb;">
				   <a href="<?php echo U('wap_act_info',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$list2['id']));?>">
                   <div class="li-w">
                       <div>
                           <div class="li-c" style="position:relative;">					   
                               <div class="fr-c ">	
                                   <dl>
									  <dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Task/images/icon0<?php if($list2['order'] == 3){echo 4;}elseif($list2['order'] == 2){echo 5;}else{echo 6;}?>.png" class="pic1"></dd>
                                       <dd style="float:left;">
									       <span>协助主题：<?php echo ($list2["title"]); ?></span></br>
										   <span>发起人：<?php echo ($list2["name"]); ?></span></br>
										   <span>负责人：<?php echo ($list2["fuzeren"]); ?></span></br>
                                       </dd>
                                       <div class="clear"></div>
									   <div class="time task_time">
									提交时间：&nbsp;&nbsp;<span><?php echo (date("Y-m-d H:i:s",$list2["mktime"])); ?></span></br>
								   </div>
                                   </dl>
                               </div>
                           </div>
                       </div>
                       <div class="clear"></div>
                   </div>
				   </a> 
                </li>
				 <?php } endforeach; endif; else: echo "" ;endif; ?>
			
                <?php else: ?>
				   <p style="text-align:center;padding-top:30px;">
				   <img src="./Tpl/Qyapp/Applyflow/images/que.png" width="100px" height="100px">
				   <br>
                    暂无数据
					</p><?php endif; ?>	
            </ul>
           			
        </div>
    </div>
</section>
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
<div class="top_bar" style="-webkit-transform:translate3d(0,0,0)">
 <nav>
    <ul id="top_menu" class="top_menu">
      <input type="checkbox" id="plug-btn" class="plug-menu themeStyle" style="border-radius:64px;background-image:url('./Tpl/Qyapp/Task/images/menu01.png');background-color:none;border:0px;"> 	  
	  <input type="hidden" id="dates" value="<?php echo ($times); ?>"/>
	</ul>
  </nav>
</div>
<div id="plug-wrap" style="display: none;" ></div>

<div id="datePlugin"></div>
<div class="hd" id="upmenu">
	<ul id="tab1" style="position:absolute;bottom:10px;z-index:8888;width:75%;">
		<a href="<?php echo U('Task/wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'type'=>2));?>" alt="3" value="<?php echo ($times); ?>">
		<li style="width: 25%;float: left;">
			<div class="li-c">
			<img src="Tpl/Qyapp/Task/images/14.png" height="50px" width="50px" style="display: block;max-width: 100%;margin: 0 auto;">
			<div class="li-txt" style="font-size: 14px;line-height: 24px;text-align: center;color:#FFF">负责</div>
			</div>
		</li>
		</a>	
		<a href="<?php echo U('Task/wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'type'=>1));?>" alt="2" value="<?php echo ($times); ?>">
		<li style="width: 25%;float: left;">
			<div class="li-c">
			<img src="Tpl/Qyapp/Task/images/14.png" height="50px" width="50px" style="display: block;max-width: 100%;margin: 0 auto;">
			<div class="li-txt" style="font-size: 14px;line-height: 24px;text-align: center;color:#FFF">协助</div>
			</div>
		</li>
		</a>
		<a href="<?php echo U('Task/wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'type'=>3));?>" alt="1" value="<?php echo ($times); ?>">
		<li style="width: 25%;float: left;">
			<div class="li-c">
			<img src="Tpl/Qyapp/Task/images/16.png" height="50px" width="50px" style="display: block;max-width: 100%;margin: 0 auto;">
			<div class="li-txt" style="font-size: 14px;line-height: 24px;text-align: center;color:#FFF">托付</div>
			</div>
		</li>
		</a>
		<a href="<?php echo U('wap_add_task',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">
		<li style="width: 25%;float: left;">
			<div class="li-c">
			<img src="Tpl/Qyapp/Task/images/15.png" height="50px" width="50px" style="display: block;max-width: 100%;margin: 0 auto;">
			<div class="li-txt" style="font-size: 14px;line-height: 24px;text-align: center;color:#FFF">派发</div>
			</div>
		</li>
		</a>		
		<div class="clear"></div>
	</ul>
</div>

<div id="plug-wrap" style="display: none;" ></div>
<!--menu end-->
<!--rili start-->
<div id="datePlugin"></div>
<!--rili end-->
<!--js start-->
<script type="text/javascript" src="Tpl/Qyapp/Task/js/jquery.js" ></script>
<script type="text/javascript" src="Tpl/Qyapp/Task/js/date.js" ></script>
<script type="text/javascript" src="Tpl/Qyapp/Task/js/iscroll.js" ></script>
<script src="http://g.alicdn.com/ilw/ding/0.2.7/scripts/dingtalk.js"></script>
<!-- <script src="Tpl/Qyapp/Applyflow/js/main.js"></script> -->
<script type="text/javascript">
$(function(){
	tab();
	$('#beginTime').date();
	var $li = $('#tab li');
	var $ul = $('#content ul');
	
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
	$(".plug-menu").click(function(){
	var li = $(this).parents('nav').find('ul').find('li');
	if(li.attr("class") == "themeStyle on"){
		li.removeClass("themeStyle on");
		li.addClass("themeStyle out");
	}else{
		li.removeClass("themeStyle out");
		li.addClass("themeStyle on");
	}
	});
});
function tab(){
	var $li = $('#tab li');
	var $ul = $('#content ul');
	$('#tab').each(function(){
	  $("#tab li").removeClass("li-active-status");
	  $(this).children(':first').addClass('li-active-status');
	}) 	
	$li.click(function(){
		var $this = $(this);
		var $t = $this.index();
		$li.removeClass();
		$li.addClass('li-status');
		$this.addClass('li-active-status');
		$ul.css('display','none');
		$ul.eq($t).css('display','block');
	})
}

function chaxun(d){
    //alert(d);
	if(d == 3 || d == 2 || d == 1){
		var date = document.getElementById('dates').value;
		var type = d;
		subdata = 'token=<?php echo $_GET['token'];?>&wecha_id=<?php echo $_GET['wecha_id'];?>&date=' + date + '&type=' + type;
		$("#upmenu").hide();
	}else{
		yue = d.substr(5,2);
		nian = d.substr(0,4);
		document.getElementById('dates').value = d;
		document.getElementById('yue').innerHTML = yue + '<label style="font-size:12px;color:#fff;">月</label>';
		document.getElementById('nian').innerHTML = nian;
		subdata= 'token=<?php echo $_GET['token'];?>&wecha_id=<?php echo $_GET['wecha_id'];?>&date=' + d;
	}
	alert(subdata);
	return false;
	$.ajax({
		type: "post",  
		url:"<?php echo U('wap_index_ajax',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>",
		dataType:'json',
		data:subdata,
		success:function(json){
				if(json.status == 0){
						var code1 = '';
						code1 +=  '<ul style="display:block">';
						code1 += '<p style="text-align:center;padding-top:30px;">';
						code1 += '<img src="./Tpl/Qyapp/Applyflow/images/que.png" width="100px" height="100px">';
						code1 += '<br>';
						code1 += '暂无数据';
						code1 += '</p>';
						code1 += '</ul>';
						//alerterror('暂无数据');
						document.getElementById("content").innerHTML = '';
						document.getElementById("content").innerHTML = code1;
						document.getElementById("jxshu").innerHTML = json.jxshu;
						document.getElementById("wcshu").innerHTML = json.wcshu;
						
				}else{
					list = json.list;
					//alert(list);return false;
					var code = '';
					code +=  '<ul style="display:block">';
					for(var i=0;i<=list.length-1;i++){
					if(list[i].status == 0){
					code +=  '<li style="margin-top:10px;border:1px solid #dbdbdb;">';
					code += '<a href="<?php echo U('wap_act_info',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>"'+ list[i].id +'"));?>">';
					code +=  '<div class="li-w">';
                    code +=  '   <div>';
                    code +=  '       <div class="li-c" style="position:relative;">	';				   
                    code +=  '           <div class="fr-c ">	';
                    code +=  '               <dl>';
					if(list[i].order == 3){
						code += '		<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Task/images/icon04.png" class="pic1"></dd>';
					}else if(list[i].order == 2){
						code += '		<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Task/images/icon05.png" class="pic1"></dd>';
					}else{
						code += '		<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Task/images/icon06.png" class="pic1"></dd>';
					}
                    code +=  '                   <dd style="float:left;">';
					code +=  '				       <span>协助主题：'+ list[i].title +'</span></br>';
					code +=  '					   <span>发起人：'+ list[i].name +'</span></br>';
					code +=  '					   <span>负责人：'+ list[i].fuzeren +'</span></br>';
                    code +=  '                   </dd>';
                    code +=  '                   <div class="clear"></div>';
					code +=  '				   <div class="time">';
					code +=  '				提交时间：&nbsp;&nbsp;&nbsp;&nbsp;<span>'+ list[i].time +'</span></br>';
					code +=  '			   </div>';
                    code +=  '               </dl>';
                    code +=  '           </div>';
                    code +=  '       </div>';
                    code +=  '   </div>';
                    code +=  '   <div class="clear"></div>';
					code +=  '</div>';
					code +=  '</a> ';
					code +=  '</li>';
						}
					}
					code +=  '</ul>';
					code +=  '<ul style="display:none">';
					document.getElementById("title").innerText = '我协作的00';
					for(var i=0;i<=list.length-1;i++){
					if(list[i].status == 1){
					code +=  '<li style="margin-top:10px;border:1px solid #dbdbdb;">';
					code += '<a href="<?php echo U('wap_act_info',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>"'+ list[i].id +'"));?>">';
					code +=  '<div class="li-w">';
                    code +=  '   <div>';
                    code +=  '       <div class="li-c" style="position:relative;">	';				   
                    code +=  '           <div class="fr-c ">	';
                    code +=  '               <dl>';
					if(list[i].order == 3){
						code += '		<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Task/images/icon04.png" class="pic1"></dd>';
					}else if(list[i].order == 2){
						code += '		<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Task/images/icon05.png" class="pic1"></dd>';
					}else{
						code += '		<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Task/images/icon06.png" class="pic1"></dd>';
					}
                    code +=  '                   <dd style="float:left;">';
					code +=  '				       <span>协助主题：'+ list[i].title +'</span></br>';
					code +=  '					   <span>发起人：'+ list[i].name +'</span></br>';
					code +=  '					   <span>负责人：'+ list[i].fuzeren +'</span></br>';
                    code +=  '                   </dd>';
                    code +=  '                   <div class="clear"></div>';
					code +=  '				   <div class="time">';
					code +=  '				提交时间：&nbsp;&nbsp;&nbsp;&nbsp;<span>'+ list[i].time +'</span></br>';
					code +=  '			   </div>';
                    code +=  '               </dl>';
                    code +=  '           </div>';
                    code +=  '       </div>';
                    code +=  '   </div>';
                    code +=  '   <div class="clear"></div>';
					code +=  '</div>';
					code +=  '</a> ';
					code +=  '</li>';
					document.getElementById("title").innerText = '我协作的11';
						}
					}
					code +=  '</ul>';
					document.getElementById("content").innerHTML = '';
					document.getElementById("content").innerHTML = code;
					document.getElementById("jxshu").innerHTML = json.jxshu;
					document.getElementById("wcshu").innerHTML = json.wcshu;
					tab();
					document.getElementById("title").innerText = '我协作的2233';
					alertsuccess('查询成功');
				
				}
		},
		error:function(){
			//alerterror('数据提交失败');
		}
	}); 
}
function alertsuccess(msg){
	dd.ready(function(){
		dd.device.notification.toast({
			icon: 'success', //icon样式，有success和error，默认为空 0.0.2
			text: msg, //提示信息
			duration: '2', //显示持续时间，单位秒，默认按系统规范[android只有两种(<=2s >2s)]
			delay: '0', //延迟显示，单位秒，默认0
			onSuccess : function(result) {
				/*{}*/
			},
			onFail : function(err) {}
		})
	});
}
function alerterror(msg){
	dd.ready(function(){
		dd.device.notification.toast({
			icon: 'error', //icon样式，有success和error，默认为空 0.0.2
			text: msg, //提示信息
			duration: '2', //显示持续时间，单位秒，默认按系统规范[android只有两种(<=2s >2s)]
			delay: '0', //延迟显示，单位秒，默认0
			onSuccess : function(result) {
				/*{}*/
			},
			onFail : function(err) {}
		})
	});
}
</script> 
<!--js end-->
</body>
</html>