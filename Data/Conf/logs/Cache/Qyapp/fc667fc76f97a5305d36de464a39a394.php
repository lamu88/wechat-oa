<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>日程列表</title>
    <link rel="stylesheet" href="Tpl/Qyapp/Day/css/style.css">
	<link rel="stylesheet" href="Tpl/Qyapp/Day/css/style1.css">
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
		<li style="width:53%;margin-left:2%;">
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
<!-- <section class="sec-banner01" >
    <div class="date">
        <div class="txt" id="beginTime"><?php echo $showtime=date("m");?>月</div>
    </div>
	<div class="message" id="riqi">日期：<?php echo date("Y-m-d",strtotime("+0 day"));?></div>
</section> -->
<!--sec-banner01 end-->
<!--sec01-01 start-->
<section class="sec01-01">
    <div class="slideTxtBox">
        <div class="hd" id="hdtab">
            <ul id="tab">
                <li>
                    <div class="li-c">
                    <div class="li-txt">周<?php echo $week[1];?><span><?php echo date("m/d",strtotime("+0 day"));?></span></div>
                    </div>
                </li>
				<li>
                    <div class="li-c">
                    <div class="li-txt">周<?php echo $week[2];?><span><?php echo date("m/d",strtotime("+1 day"));?></span></div>
                    </div>
                </li>
				<li>
                    <div class="li-c">
                    <div class="li-txt">周<?php echo $week[3];?><span><?php echo date("m/d",strtotime("+2 day"));?></span></div>
                    </div>
                </li>
				<li>
                    <div class="li-c">
                    <div class="li-txt">周<?php echo $week[4];?><span><?php echo date("m/d",strtotime("+3 day"));?></span></div>
                    </div>
                </li>
				<li>
                    <div class="li-c">
                    <div class="li-txt">周<?php echo $week[5];?><span><?php echo date("m/d",strtotime("+4 day"));?></span></div>
                    </div>
                </li>
                <li>
                    <div class="li-c">
                    <div class="li-txt">周<?php echo $week[6];?><span><?php echo date("m/d",strtotime("+5 day"));?></span></div>
                    </div>
                </li>
                <li>
                    <div class="li-c">
                    <div class="li-txt">周<?php echo $week[7];?><span><?php echo date("m/d",strtotime("+6 day"));?></span></div>
                    </div>
                </li>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="bd" id="content">
			 <script>
				function max(obj){
					if(obj.style.whiteSpace == 'nowrap' && obj.style.textOverflow == 'ellipsis'){
						obj.style.whiteSpace = '';
						obj.style.textOverflow = '';
					}else{
						obj.style.whiteSpace = 'nowrap';
						obj.style.textOverflow = 'ellipsis';
					}
				}
			 </script>
			<ul style="display:block;">
               <?php foreach($list[0] as $k0=>$v0){?>
			   <li>
			   <span class="shuxian"></span>
				   <a href="javascript:void(0)">
                   <div class="li-w">
					   <div class="fl">
						   <div class="li-c">
							 <div class="fl_time">
								<?php echo (date("H:i",$v0["d_time"])); ?>
							 </div>
							 
						   </div>
					   </div>				   
                       <div class="fr" style="width:87%;">
                           <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">					   
                               <div class="fr-c ">	
                                   <dl>
										<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon0<?php if($v0['type'] == 1){echo '1';}else{echo 3;}?>.png" class="pic1"></dd>						   
                                       <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">
									       主题：<font><?php echo ($v0["date_zt"]); ?></font></br>
										   详情：<?php echo ($v0["date_content"]); ?></br>
										   <img src="<?php if($v0['type'] == 0){echo './Tpl/Qyapp/Day/images/stop.png';}else{ echo './Tpl/Qyapp/Day/images/start.png';}?>" id="<?php echo ($v0["id"]); ?>" onclick="onmsg(this)"/>
                                       </dd>
                                       <!-- <div class="clear"></div>
									   <div class="time">
										时间：<span><?php echo (date("Y-m-d",$v0["d_time"])); ?></span></br>
								   </div> -->
                                   </dl>
                               </div>
							   <span class="span-border"></span>
                           </div>
                       </div>
                       <div class="clear"></div>
                   </div>
				   </a> 
                </li>
			<?php }?>	
			<?php if($list[0] == ''){?>
				<p class="content_no">
					<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">
					<span>亲！暂无相关信息哦！！！</span>
				</p>
			<?php }?>
            </ul>	
			<ul style="display:none;">
               <?php foreach($list[1] as $k0=>$v0){?>
			    <li>
			   <span class="shuxian"></span>
				   <a href="javascript:void(0)">
                   <div class="li-w">
					   <div class="fl">
						   <div class="li-c">
							 <div class="fl_time">
								<?php echo (date("H:i",$v0["d_time"])); ?>
							 </div>
							 
						   </div>
					   </div>				   
                       <div class="fr" style="width:87%;">
                           <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">					   
                               <div class="fr-c ">	
                                   <dl>
										<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon0<?php if($v0['type'] == 1){echo '1';}else{echo 3;}?>.png" class="pic1"></dd>						   
                                       <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">
									       主题：<font><?php echo ($v0["date_zt"]); ?></font></br>
										   详情：<?php echo ($v0["date_content"]); ?></br>
										   <img src="<?php if($v0['type'] == 0){echo './Tpl/Qyapp/Day/images/stop.png';}else{ echo './Tpl/Qyapp/Day/images/start.png';}?>" id="<?php echo ($v0["id"]); ?>" onclick="onmsg(this)"/>
                                       </dd>
                                       <!-- <div class="clear"></div>
									   <div class="time">
										时间：<span><?php echo (date("Y-m-d",$v0["d_time"])); ?></span></br>
								   </div> -->
                                   </dl>
                               </div>
							   <span class="span-border"></span>
                           </div>
                       </div>
                       <div class="clear"></div>
                   </div>
				   </a> 
                </li>
			<?php }?>
			<?php if($list[1] == ''){?>
			<p class="content_no">
				<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">
				<span>亲！暂无相关信息哦！！！</span>
			</p>
			<?php }?>		
            </ul>	
            <ul style="display:none;">
               <?php foreach($list[2] as $k0=>$v0){?>
                <li>
			   <span class="shuxian"></span>
				   <a href="javascript:void(0)">
                   <div class="li-w">
					   <div class="fl">
						   <div class="li-c">
							 <div class="fl_time">
								<?php echo (date("H:i",$v0["d_time"])); ?>
							 </div>
							 
						   </div>
					   </div>				   
                       <div class="fr" style="width:87%;">
                           <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">					   
                               <div class="fr-c ">	
                                   <dl>
										<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon0<?php if($v0['type'] == 1){echo '1';}else{echo 3;}?>.png" class="pic1"></dd>						   
                                       <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">
									       主题：<font><?php echo ($v0["date_zt"]); ?></font></br>
										   详情：<?php echo ($v0["date_content"]); ?></br>
										   <img src="<?php if($v0['type'] == 0){echo './Tpl/Qyapp/Day/images/stop.png';}else{ echo './Tpl/Qyapp/Day/images/start.png';}?>" id="<?php echo ($v0["id"]); ?>" onclick="onmsg(this)"/>
                                       </dd>
                                       <!-- <div class="clear"></div>
									   <div class="time">
										时间：<span><?php echo (date("Y-m-d",$v0["d_time"])); ?></span></br>
								   </div> -->
                                   </dl>
                               </div>
							   <span class="span-border"></span>
                           </div>
                       </div>
                       <div class="clear"></div>
                   </div>
				   </a> 
                </li>
			<?php }?>	
			<?php if($list[2] == ''){?>
				<p class="content_no">
					<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">
					<span>亲！暂无相关信息哦！！！</span>
				</p>
			<?php }?>
            </ul>	
           	<ul style="display:none;">
               <?php foreach($list[3] as $k0=>$v0){?>
                <li>
			   <span class="shuxian"></span>
				   <a href="javascript:void(0)">
                   <div class="li-w">
					   <div class="fl">
						   <div class="li-c">
							 <div class="fl_time">
								<?php echo (date("H:i",$v0["d_time"])); ?>
							 </div>
							 
						   </div>
					   </div>				   
                       <div class="fr" style="width:87%;">
                           <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">					   
                               <div class="fr-c ">	
                                   <dl>
										<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon0<?php if($v0['type'] == 1){echo '1';}else{echo 3;}?>.png" class="pic1"></dd>						   
                                       <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">
									       主题：<font><?php echo ($v0["date_zt"]); ?></font></br>
										   详情：<?php echo ($v0["date_content"]); ?></br>
										   <img src="<?php if($v0['type'] == 0){echo './Tpl/Qyapp/Day/images/stop.png';}else{ echo './Tpl/Qyapp/Day/images/start.png';}?>" id="<?php echo ($v0["id"]); ?>" onclick="onmsg(this)"/>
                                       </dd>
                                       <!-- <div class="clear"></div>
									   <div class="time">
										时间：<span><?php echo (date("Y-m-d",$v0["d_time"])); ?></span></br>
								   </div> -->
                                   </dl>
                               </div>
							   <span class="span-border"></span>
                           </div>
                       </div>
                       <div class="clear"></div>
                   </div>
				   </a> 
                </li>
			<?php }?>
			<?php if($list[3] == ''){?>
				<p class="content_no">
					<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">
					<span>亲！暂无相关信息哦！！！</span>
				</p>
			<?php }?>
            </ul>	
			<ul style="display:none;">
               <?php foreach($list[4] as $k0=>$v0){?>
                <li>
			   <span class="shuxian"></span>
				   <a href="javascript:void(0)">
                   <div class="li-w">
					   <div class="fl">
						   <div class="li-c">
							 <div class="fl_time">
								<?php echo (date("H:i",$v0["d_time"])); ?>
							 </div>
							 
						   </div>
					   </div>				   
                       <div class="fr" style="width:87%;">
                           <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">					   
                               <div class="fr-c ">	
                                   <dl>
										<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon0<?php if($v0['type'] == 1){echo '1';}else{echo 3;}?>.png" class="pic1"></dd>						   
                                       <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">
									       主题：<font><?php echo ($v0["date_zt"]); ?></font></br>
										   详情：<?php echo ($v0["date_content"]); ?></br>
										   <img src="<?php if($v0['type'] == 0){echo './Tpl/Qyapp/Day/images/stop.png';}else{ echo './Tpl/Qyapp/Day/images/start.png';}?>" id="<?php echo ($v0["id"]); ?>" onclick="onmsg(this)"/>
                                       </dd>
                                       <!-- <div class="clear"></div>
									   <div class="time">
										时间：<span><?php echo (date("Y-m-d",$v0["d_time"])); ?></span></br>
								   </div> -->
                                   </dl>
                               </div>
							   <span class="span-border"></span>
                           </div>
                       </div>
                       <div class="clear"></div>
                   </div>
				   </a> 
                </li>
			<?php }?>
			<?php if($list[4] == ''){?>
				<p class="content_no">
					<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">
					<span>亲！暂无相关信息哦！！！</span>
				</p>
			<?php }?>
            </ul>	
			<ul style="display:none;">
               <?php foreach($list[5] as $k0=>$v0){?>
                <li>
			   <span class="shuxian"></span>
				   <a href="javascript:void(0)">
                   <div class="li-w">
					   <div class="fl">
						   <div class="li-c">
							 <div class="fl_time">
								<?php echo (date("H:i",$v0["d_time"])); ?>
							 </div>
							 
						   </div>
					   </div>				   
                       <div class="fr" style="width:87%;">
                           <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">					   
                               <div class="fr-c ">	
                                   <dl>
										<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon0<?php if($v0['type'] == 1){echo '1';}else{echo 3;}?>.png" class="pic1"></dd>						   
                                       <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">
									       主题：<font><?php echo ($v0["date_zt"]); ?></font></br>
										   详情：<?php echo ($v0["date_content"]); ?></br>
										   <img src="<?php if($v0['type'] == 0){echo './Tpl/Qyapp/Day/images/stop.png';}else{ echo './Tpl/Qyapp/Day/images/start.png';}?>" id="<?php echo ($v0["id"]); ?>" onclick="onmsg(this)"/>
                                       </dd>
                                       <!-- <div class="clear"></div>
									   <div class="time">
										时间：<span><?php echo (date("Y-m-d",$v0["d_time"])); ?></span></br>
								   </div> -->
                                   </dl>
                               </div>
							   <span class="span-border"></span>
                           </div>
                       </div>
                       <div class="clear"></div>
                   </div>
				   </a> 
                </li>
			<?php }?>
			<?php if($list[5] == ''){?>
				<p class="content_no">
					<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">
					<span>亲！暂无相关信息哦！！！</span>
				</p>
			<?php }?>
            </ul>	
			<ul style="display:none;">
               <?php foreach($list[6] as $k0=>$v0){?>
                <li>
			   <span class="shuxian"></span>
				   <a href="javascript:void(0)">
                   <div class="li-w">
					   <div class="fl">
						   <div class="li-c">
							 <div class="fl_time">
								<?php echo (date("H:i",$v0["d_time"])); ?>
							 </div>
							 
						   </div>
					   </div>				   
                       <div class="fr" style="width:87%;">
                           <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">					   
                               <div class="fr-c ">	
                                   <dl>
										<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon0<?php if($v0['type'] == 1){echo '1';}else{echo 3;}?>.png" class="pic1"></dd>						   
                                       <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">
									       主题：<font><?php echo ($v0["date_zt"]); ?></font></br>
										   详情：<?php echo ($v0["date_content"]); ?></br>
										   <img src="<?php if($v0['type'] == 0){echo './Tpl/Qyapp/Day/images/stop.png';}else{ echo './Tpl/Qyapp/Day/images/start.png';}?>" id="<?php echo ($v0["id"]); ?>" onclick="onmsg(this)"/>
                                       </dd>
                                       <!-- <div class="clear"></div>
									   <div class="time">
										时间：<span><?php echo (date("Y-m-d",$v0["d_time"])); ?></span></br>
								   </div> -->
                                   </dl>
                               </div>
							   <span class="span-border"></span>
                           </div>
                       </div>
                       <div class="clear"></div>
                   </div>
				   </a> 
                </li>
			<?php }?>
			<?php if($list[6] == ''){?>
				<p class="content_no">
					<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">
					<span>亲！暂无相关信息哦！！！</span>
				</p>
			<?php }?>
            </ul>	
        </div>
    </div>
</section>
<!--sec01-01 end-->
<!---#mdnu staart-->
<!-- <div id="menu">
    <img class="img" src="Tpl/Qyapp/Applyflow/images/menu01.png">
    <div id="menu-btn1">
        <a class="a1" href=""><img src="Tpl/Qyapp/Applyflow/images/menu01.png"></a>
        <a class="a2" href=""><img src="Tpl/Qyapp/Applyflow/images/menu01.png"></a>
        <a class="a3" href=""><img src="Tpl/Qyapp/Applyflow/images/menu01.png"></a>
    </div>
</div> -->
<style type="text/css">
body{ margin-bottom:60px !important;}
a,button,input{-webkit-tap-highlight-color:rgba(255,0,0,0);}
ul,li{ list-style:none; margin:0;padding:0}
#plug-wrap {
    position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background: rgba(0, 0, 0, 0);
    z-index:800;
}
.top_bar {
    position:fixed;
    bottom:0;
    right:0px;
    z-index:900;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    font-family: Helvetica, Tahoma, Arial, Microsoft YaHei, sans-serif;
}
.plug-menu {
  -webkit-appearance: button;
  display: inline-block;
  width: 50px;
  height: 50px;
  border-radius: 36px;
  position: absolute;
  bottom: 35px;
  right: 20px;
  z-index: 999;
  -webkit-transition: -webkit-transform 200ms;
  -webkit-transform: rotate(1deg);
  color: #fff;
  background-image: url('images/ico/plug.png');
  background-repeat: no-repeat;
  -webkit-background-size: 80% auto;
  background-size: 100% auto;
  background-position: center center;
}
.plug-menu:before {
    font-size:20px;
    margin:9px 0 0 9px;
}
.plug-menu:checked {
    -webkit-transform:rotate(135deg);
}
.top_menu>li {
    width: 32px;
    height:32px;
    border-radius:32px;
    box-shadow: 0 0 0 3px #FFFFFF, 0 2px 5px 3px rgba(0, 0, 0, 0.25);
    background:#B70000;
    position:absolute;
    bottom:0;
    right:0;
    margin-bottom: 40px;
    margin-right:40px;
    z-index:900;
    -webkit-transition: -webkit-transform 200ms;
}
.top_menu>li a {
    <!-- color:#fff; -->
    font-size:20px;
    display: block;
    height: 100%;
    line-height: 33px;
    text-align: center;
	background:none;
}
.top_menu>li>a label{
display:none;
}
.top_menu>li a img {
display: block;
width: 60px;
height: 60px;
text-indent: -999px;
position: absolute;
top: 100%;
left: 100%;
margin-top: -40px;
margin-left: -40px;
background:none;
}
.top_menu>li.on:nth-of-type(1) {
-webkit-transform: translate(-0, -100px) rotate(720deg);
}
.top_menu>li.on:nth-of-type(2) {
-webkit-transform: translate(-68px, -68px) rotate(720deg);
}
.top_menu>li.on:nth-of-type(3) {
-webkit-transform: translate(-100px, 0) rotate(720deg);
}
 
#sharemcover {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background: rgba(0, 0, 0, 0.7);
display: none;
z-index: 20000;
}
#sharemcover img {
position: fixed;
right: 18px;
top: 5px;
width: 260px;
height: 180px;
z-index: 20001;
border:0;
background-color:none;
}
#upmenu {
  background: #000;
  width: 100%;
  height: 100%;
  filter: alpha(opacity=50);
  -moz-opacity: 0.8;
  -khtml-opacity: 0.8;
  opacity: 0.8;
  position: absolute;
  top: 600px;
  display: none;
}
</style>
<div class="top_bar" style="-webkit-transform:translate3d(0,0,0)">
 <nav>
    <ul id="top_menu" class="top_menu">
      <input type="checkbox" id="plug-btn" class="plug-menu themeStyle" style="border-radius:64px;background-image:url('./Tpl/Qyapp/Applyflow/images/menu01.png');background-color:none;border:0px;">   
	  <input type="hidden" id="dates" value="<?php echo ($times); ?>"/>
	</ul>
  </nav>
</div>
<!-- <div class="top_bar" style="-webkit-transform:translate3d(0,0,0)">
 <nav>
    <ul id="top_menu" class="top_menu">
      <input type="checkbox" id="plug-btn" class="plug-menu themeStyle" style="border-radius:64px;background-image:url('./Tpl/Qyapp/Applyflow/images/menu01.png');background-color:none;border:0px;">
       <li class="themeStyle out" style="background:none"> <a href="<?php echo U('wap_wait_check',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>"><img src="./Tpl/Qyapp/Applyflow/images/plugmenu1.png" style="border-radius:64px;"><label>我的审核</label></a></li>	
       <li class="themeStyle out" style="background:none"> <a href="<?php echo U('wap_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" ><img src="./Tpl/Qyapp/Applyflow/images/plugmenu6.png" style="border-radius:64px;"><label>我的假单</label></a></li>
       <li class="themeStyle out" style="background:none"> <a href="<?php echo U('rcday',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" ><img src="./Tpl/Qyapp/Applyflow/images/plugmenu8.png" style="border-radius:64px;"><label>请假</label></a></li>	   
	</ul>
  </nav>
</div> -->
<div id="plug-wrap" style="display: none;" ></div>
<div class="hd" id="upmenu">
	<ul id="tab1" style="position:absolute;bottom:10px;z-index:8888;width:75%;">
		<!-- <a href="javascript:void(0)" onclick="chaxun(2)" alt="3" value="<?php echo ($times); ?>">
		<li style="width: 25%;float: left;">
			<div class="li-c">
			<img src="Tpl/Qyapp/Applyflow/images/14.png" height="50px" width="50px" style="display: block;max-width: 100%;margin: 0 auto;">
			<div class="li-txt" style="font-size: 14px;line-height: 24px;text-align: center;color:#FFF">负责</div>
			</div>
		</li>
		</a>	
		<a href="javascript:void(0)" onclick="chaxun(1)" alt="2" value="<?php echo ($times); ?>">
		<li style="width: 25%;float: left;">
			<div class="li-c">
			<img src="Tpl/Qyapp/Applyflow/images/14.png" height="50px" width="50px" style="display: block;max-width: 100%;margin: 0 auto;">
			<div class="li-txt" style="font-size: 14px;line-height: 24px;text-align: center;color:#FFF">协助</div>
			</div>
		</li>
		</a> -->
		<a href="<?php echo U('wap_log',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" >
		<li style="width: 50%;float: left;">
			<div class="li-c">
			<img src="Tpl/Qyapp/Applyflow/images/16.png" height="50px" width="50px" style="display: block;max-width: 100%;margin: 0 auto;">
			<div class="li-txt" style="font-size: 14px;line-height: 24px;text-align: center;color:#FFF">日志</div>
			</div>
		</li>
		</a>
		<a href="<?php echo U('rcday',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">
		<li style="width: 50%;float: left;">
			<div class="li-c">
			<img src="Tpl/Qyapp/Applyflow/images/15.png" height="50px" width="50px" style="display: block;max-width: 100%;margin: 0 auto;">
			<div class="li-txt" style="font-size: 14px;line-height: 24px;text-align: center;color:#FFF">新增</div>
			</div>
		</li>
		</a>		
		<div class="clear"></div>
	</ul>
</div>
<!--menu end-->
<!--rili start-->
<div id="datePlugin"></div>
<!--rili end-->
<!--js start-->
<script type="text/javascript" src="Tpl/Qyapp/Applyflow/js/jquery.js" ></script>
<script type="text/javascript" src="Tpl/Qyapp/Day/js/date.js" ></script>
<script type="text/javascript" src="Tpl/Qyapp/Applyflow/js/iscroll.js" ></script>
<script src="http://g.alicdn.com/ilw/ding/0.2.7/scripts/dingtalk.js"></script>
<!-- <script src="Tpl/Qyapp/Applyflow/js/main.js"></script> -->
<script type="text/javascript">
    $(function(){
        $('#beginTime').date();
    //});
    //$(function() {
		tab();
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
function onmsg(obj){
	//alert(obj.id);
	subdata= 'token=<?php echo $_GET['token'];?>&wecha_id=<?php echo $_GET['wecha_id'];?>&id=' + obj.id;
	$.ajax({
		type: "post",  
		url:"<?php echo U('wap_edit');?>",
		dataType:'json',
		data:subdata,
		success:function(json){
			if(json.status == 1){
				obj.src = './Tpl/Qyapp/Day/images/start.png';
				alertsuccess('日程修改成功');
			}
			if(json.status == 2){
				alertsuccess('修改失败，请稍候重试');
			}
			if(json.status == 3){
				alertsuccess('网路延迟，请稍候重试');
			}
			if(json.status == 0){
				obj.src = './Tpl/Qyapp/Day/images/stop.png';
				alerterror('日程修改成功');
			}
		},
		error:function(){
			//alerterror('数据提交失败');
		}
	});
	
}
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
	
	yue = d.substr(5,2); // 获取子字符串。
	nian = d.substr(0,4);
	document.getElementById('yue').innerHTML = yue + '<label style="font-size:12px;color:#fff;">月</label>';
	document.getElementById('nian').innerHTML = nian;
	yue = yue.replace('0','');
	subdata= 'token=<?php echo $_GET['token'];?>&wecha_id=<?php echo $_GET['wecha_id'];?>&date=' + d;
	//document.getElementById("beginTime").innerHTML = yue + '月';
	//document.getElementById("riqi").innerHTML = '日期 : ' + d;
	//alert(subdata);return false;
	$.ajax({
		type: "post",  
		url:"<?php echo U('wap_index_ajax');?>",
		dataType:'json',
		data:subdata,
		success:function(json){
				if(json.status == 0){
						alerterror('暂无数据');
						document.getElementById("content").innerHTML = '';
				}else{
					lists = json.list;
					riqis = json.riqi;
					
					var html = '';
					 html += '<ul id="tab">';
					for(var i=0;i<=riqis.length-1;i++){
						 html += '	<li>';
						 html += '		<div class="li-c">';
						 html += '		<div class="li-txt">'+ riqis[i].zhouqi +'<span>'+ riqis[i].riqi +'</span></div>';
						 html += '		</div>';
						 html += '	</li>';
					}
					html += '<div class="clear"></div>';
					html += '</ul>';
					document.getElementById("hdtab").innerHTML = '';
					document.getElementById("hdtab").innerHTML = html;
					var code = ''
					code +=  '<ul style="display:block">';
					if(lists[0].status != '-1'){
						for(var i=0;i<=lists[0].length-1;i++){
							code +=  '<li>';
							code +=  '<span class="shuxian"></span>';
							code +=  '<a href="javascript:void(0)">';
							code +=  '<div class="li-w">';
							code +=  '<div class="fl">';
							code +=  '  <div class="li-c">';
							code +=  '	 <div class="fl_time">';
							code +=  '		'+ lists[0][i].hour +'';
							code +=  '	 </div>';
							code +=  '   </div>';
							code +=  '</div>		';		   
							code +=  '<div class="fr" style="width:87%;">';
							code +=  '   <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">	';				   
							code +=  '       <div class="fr-c ">	';
							code +=  '           <dl>';
							if(lists[0][i].type == 1){
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon01.png" class="pic1"></dd>';	
							}else{
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon03.png" class="pic1"></dd>';	
							}										   
							code +=  '               <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">';
							code +=  '			       主题：<font>'+ lists[0][i].date_zt +'</font></br>';
							code +=  '				   详情：'+ lists[0][i].date_content +'</br>';
							if(lists[0][i].type == 1){
								code +=  '<img src="./Tpl/Qyapp/Day/images/start.png" id="'+ lists[0][i].id +'" onclick="onmsg(this)"/>';
							}else{	
								code +=  '<img src="./Tpl/Qyapp/Day/images/stop.png" id="'+ lists[0][i].id +'" onclick="onmsg(this)"/>';
							}
							code +=  '               </dd>';
							code +=  '               <!-- <div class="clear"></div>';
							code +=  '			   <div class="time">';
							code +=  '				时间：<span>'+ lists[0][i].time +'</span></br>';
							code +=  '		   </div> -->';
							code +=  '           </dl>';
							code +=  '       </div>';
							code +=  '	   <span class="span-border"></span>';
							code +=  '   </div>';
							code +=  '</div>';
							code +=  '<div class="clear"></div>';
							code +=  '</div>';
							code +=  '</a> ';
							code +=  '</li>';
						}
					}else{
						code +=  '<p class="content_no">';
						code +=  '<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">';
						code +=  '<span>亲！暂无相关信息哦！！！</span>';
						code +=  '</p>';
					}
					code +=  '</ul>';
					
					code +=  '<ul style="display:none">';
					if(lists[1].status != '-1'){
						for(var i=0;i<=lists[1].length-1;i++){
							code +=  '<li>';
							code +=  '<span class="shuxian"></span>';
							code +=  '<a href="javascript:void(0)">';
							code +=  '<div class="li-w">';
							code +=  '<div class="fl">';
							code +=  '  <div class="li-c">';
							code +=  '	 <div class="fl_time">';
							code +=  '		'+ lists[1][i].hour +'';
							code +=  '	 </div>';
							code +=  '   </div>';
							code +=  '</div>		';		   
							code +=  '<div class="fr" style="width:87%;">';
							code +=  '   <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">	';				   
							code +=  '       <div class="fr-c ">	';
							code +=  '           <dl>';
							if(lists[1][i].type == 1){
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon01.png" class="pic1"></dd>';	
							}else{
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon03.png" class="pic1"></dd>';	
							}										   
							code +=  '               <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">';
							code +=  '			       主题：<font>'+ lists[1][i].date_zt +'</font></br>';
							code +=  '				   详情：'+ lists[1][i].date_content +'</br>';
							if(lists[1][i].type == 1){
								code +=  '<img src="./Tpl/Qyapp/Day/images/start.png" id="'+ lists[1][i].id +'" onclick="onmsg(this)"/>';
							}else{	
								code +=  '<img src="./Tpl/Qyapp/Day/images/stop.png" id="'+ lists[1][i].id +'" onclick="onmsg(this)"/>';
							}
							code +=  '               </dd>';
							code +=  '               <!-- <div class="clear"></div>';
							code +=  '			   <div class="time">';
							code +=  '				时间：<span>'+ lists[1][i].time +'</span></br>';
							code +=  '		   </div> -->';
							code +=  '           </dl>';
							code +=  '       </div>';
							code +=  '	   <span class="span-border"></span>';
							code +=  '   </div>';
							code +=  '</div>';
							code +=  '<div class="clear"></div>';
							code +=  '</div>';
							code +=  '</a> ';
							code +=  '</li>';
						}
					}else{
						code +=  '<p class="content_no">';
						code +=  '<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">';
						code +=  '<span>亲！暂无相关信息哦！！！</span>';
						code +=  '</p>';
					}
					code +=  '</ul>';
					code +=  '<ul style="display:none">';
					if(lists[2].status != '-1'){
						for(var i=0;i<=lists[2].length-1;i++){
							code +=  '<li>';
							code +=  '<span class="shuxian"></span>';
							code +=  '<a href="javascript:void(0)">';
							code +=  '<div class="li-w">';
							code +=  '<div class="fl">';
							code +=  '  <div class="li-c">';
							code +=  '	 <div class="fl_time">';
							code +=  '		'+ lists[2][i].hour +'';
							code +=  '	 </div>';
							code +=  '   </div>';
							code +=  '</div>		';		   
							code +=  '<div class="fr" style="width:87%;">';
							code +=  '   <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">	';				   
							code +=  '       <div class="fr-c ">	';
							code +=  '           <dl>';
							if(lists[2][i].type == 1){
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon01.png" class="pic1"></dd>';	
							}else{
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon03.png" class="pic1"></dd>';	
							}										   
							code +=  '               <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">';
							code +=  '			       主题：<font>'+ lists[2][i].date_zt +'</font></br>';
							code +=  '				   详情：'+ lists[2][i].date_content +'</br>';
							if(lists[2][i].type == 1){
								code +=  '<img src="./Tpl/Qyapp/Day/images/start.png" id="'+ lists[2][i].id +'" onclick="onmsg(this)"/>';
							}else{	
								code +=  '<img src="./Tpl/Qyapp/Day/images/stop.png" id="'+ lists[2][i].id +'" onclick="onmsg(this)"/>';
							}
							code +=  '               </dd>';
							code +=  '               <!-- <div class="clear"></div>';
							code +=  '			   <div class="time">';
							code +=  '				时间：<span>'+ lists[2][i].time +'</span></br>';
							code +=  '		   </div> -->';
							code +=  '           </dl>';
							code +=  '       </div>';
							code +=  '	   <span class="span-border"></span>';
							code +=  '   </div>';
							code +=  '</div>';
							code +=  '<div class="clear"></div>';
							code +=  '</div>';
							code +=  '</a> ';
							code +=  '</li>';
						}
					}else{
						code +=  '<p class="content_no">';
						code +=  '<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">';
						code +=  '<span>亲！暂无相关信息哦！！！</span>';
						code +=  '</p>';
					}
					code +=  '</ul>';
					code +=  '<ul style="display:none">';
					if(lists[3].status != '-1'){
						for(var i=0;i<=lists[3].length-1;i++){
							code +=  '<li>';
							code +=  '<span class="shuxian"></span>';
							code +=  '<a href="javascript:void(0)">';
							code +=  '<div class="li-w">';
							code +=  '<div class="fl">';
							code +=  '  <div class="li-c">';
							code +=  '	 <div class="fl_time">';
							code +=  '		'+ lists[3][i].hour +'';
							code +=  '	 </div>';
							code +=  '   </div>';
							code +=  '</div>		';		   
							code +=  '<div class="fr" style="width:87%;">';
							code +=  '   <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">	';				   
							code +=  '       <div class="fr-c ">	';
							code +=  '           <dl>';
							if(lists[3][i].type == 1){
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon01.png" class="pic1"></dd>';	
							}else{
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon03.png" class="pic1"></dd>';	
							}										   
							code +=  '               <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">';
							code +=  '			       主题：<font>'+ lists[3][i].date_zt +'</font></br>';
							code +=  '				   详情：'+ lists[3][i].date_content +'</br>';
							if(lists[3][i].type == 1){
								code +=  '<img src="./Tpl/Qyapp/Day/images/start.png" id="'+ lists[3][i].id +'" onclick="onmsg(this)"/>';
							}else{	
								code +=  '<img src="./Tpl/Qyapp/Day/images/stop.png" id="'+ lists[3][i].id +'" onclick="onmsg(this)"/>';
							}
							code +=  '               </dd>';
							code +=  '               <!-- <div class="clear"></div>';
							code +=  '			   <div class="time">';
							code +=  '				时间：<span>'+ lists[3][i].time +'</span></br>';
							code +=  '		   </div> -->';
							code +=  '           </dl>';
							code +=  '       </div>';
							code +=  '	   <span class="span-border"></span>';
							code +=  '   </div>';
							code +=  '</div>';
							code +=  '<div class="clear"></div>';
							code +=  '</div>';
							code +=  '</a> ';
							code +=  '</li>';
						}
					}else{
						code +=  '<p class="content_no">';
						code +=  '<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">';
						code +=  '<span>亲！暂无相关信息哦！！！</span>';
						code +=  '</p>';
					}
					code +=  '</ul>';
					code +=  '<ul style="display:none">';
					if(lists[4].status != '-1'){
						for(var i=0;i<=lists[4].length-1;i++){
							code +=  '<li>';
							code +=  '<span class="shuxian"></span>';
							code +=  '<a href="javascript:void(0)">';
							code +=  '<div class="li-w">';
							code +=  '<div class="fl">';
							code +=  '  <div class="li-c">';
							code +=  '	 <div class="fl_time">';
							code +=  '		'+ lists[4][i].hour +'';
							code +=  '	 </div>';
							code +=  '   </div>';
							code +=  '</div>		';		   
							code +=  '<div class="fr" style="width:87%;">';
							code +=  '   <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">	';				   
							code +=  '       <div class="fr-c ">	';
							code +=  '           <dl>';
							if(lists[4][i].type == 1){
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon01.png" class="pic1"></dd>';	
							}else{
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon03.png" class="pic1"></dd>';	
							}										   
							code +=  '               <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">';
							code +=  '			       主题：<font>'+ lists[4][i].date_zt +'</font></br>';
							code +=  '				   详情：'+ lists[4][i].date_content +'</br>';
							if(lists[4][i].type == 1){
								code +=  '<img src="./Tpl/Qyapp/Day/images/start.png" id="'+ lists[4][i].id +'" onclick="onmsg(this)"/>';
							}else{	
								code +=  '<img src="./Tpl/Qyapp/Day/images/stop.png" id="'+ lists[4][i].id +'" onclick="onmsg(this)"/>';
							}
							code +=  '               </dd>';
							code +=  '               <!-- <div class="clear"></div>';
							code +=  '			   <div class="time">';
							code +=  '				时间：<span>'+ lists[4][i].time +'</span></br>';
							code +=  '		   </div> -->';
							code +=  '           </dl>';
							code +=  '       </div>';
							code +=  '	   <span class="span-border"></span>';
							code +=  '   </div>';
							code +=  '</div>';
							code +=  '<div class="clear"></div>';
							code +=  '</div>';
							code +=  '</a> ';
							code +=  '</li>';
						}
					}else{
						code +=  '<p class="content_no">';
						code +=  '<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">';
						code +=  '<span>亲！暂无相关信息哦！！！</span>';
						code +=  '</p>';
					}
					code +=  '</ul>';
					code +=  '<ul style="display:none">';
					if(lists[5].status != '-1'){
						for(var i=0;i<=lists[5].length-1;i++){
							code +=  '<li>';
							code +=  '<span class="shuxian"></span>';
							code +=  '<a href="javascript:void(0)">';
							code +=  '<div class="li-w">';
							code +=  '<div class="fl">';
							code +=  '  <div class="li-c">';
							code +=  '	 <div class="fl_time">';
							code +=  '		'+ lists[5][i].hour +'';
							code +=  '	 </div>';
							code +=  '   </div>';
							code +=  '</div>		';		   
							code +=  '<div class="fr" style="width:87%;">';
							code +=  '   <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">	';				   
							code +=  '       <div class="fr-c ">	';
							code +=  '           <dl>';
							if(lists[5][i].type == 1){
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon01.png" class="pic1"></dd>';	
							}else{
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon03.png" class="pic1"></dd>';	
							}										   
							code +=  '               <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">';
							code +=  '			       主题：<font>'+ lists[5][i].date_zt +'</font></br>';
							code +=  '				   详情：'+ lists[5][i].date_content +'</br>';
							if(lists[5][i].type == 1){
								code +=  '<img src="./Tpl/Qyapp/Day/images/start.png" id="'+ lists[5][i].id +'" onclick="onmsg(this)"/>';
							}else{	
								code +=  '<img src="./Tpl/Qyapp/Day/images/stop.png" id="'+ lists[5][i].id +'" onclick="onmsg(this)"/>';
							}
							code +=  '               </dd>';
							code +=  '               <!-- <div class="clear"></div>';
							code +=  '			   <div class="time">';
							code +=  '				时间：<span>'+ lists[5][i].time +'</span></br>';
							code +=  '		   </div> -->';
							code +=  '           </dl>';
							code +=  '       </div>';
							code +=  '	   <span class="span-border"></span>';
							code +=  '   </div>';
							code +=  '</div>';
							code +=  '<div class="clear"></div>';
							code +=  '</div>';
							code +=  '</a> ';
							code +=  '</li>';
						}
					}else{
						code +=  '<p class="content_no">';
						code +=  '<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">';
						code +=  '<span>亲！暂无相关信息哦！！！</span>';
						code +=  '</p>';
					}
					code +=  '</ul>';
					code +=  '<ul style="display:none">';
					if(lists[6].status != '-1'){
					for(var i=0;i<=lists[6].length-1;i++){
							code +=  '<li>';
							code +=  '<span class="shuxian"></span>';
							code +=  '<a href="javascript:void(0)">';
							code +=  '<div class="li-w">';
							code +=  '<div class="fl">';
							code +=  '  <div class="li-c">';
							code +=  '	 <div class="fl_time">';
							code +=  '		'+ lists[6][i].hour +'';
							code +=  '	 </div>';
							code +=  '   </div>';
							code +=  '</div>		';		   
							code +=  '<div class="fr" style="width:87%;">';
							code +=  '   <div class="li-c" style="position:relative;border-left:4px solid #38adff;margin-left:24px;">	';				   
							code +=  '       <div class="fr-c ">	';
							code +=  '           <dl>';
							if(lists[6][i].type == 1){
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon01.png" class="pic1"></dd>';	
							}else{
								code +=  '	<dd style="float:left;width:30px;"><img src="Tpl/Qyapp/Applyflow/images/icon03.png" class="pic1"></dd>';	
							}										   
							code +=  '               <dd style="float:left;white-space: nowrap;text-overflow: ellipsis;" class="qj_dd" onclick="max(this)">';
							code +=  '			       主题：<font>'+ lists[6][i].date_zt +'</font></br>';
							code +=  '				   详情：'+ lists[6][i].date_content +'</br>';
							if(lists[6][i].type == 1){
								code +=  '<img src="./Tpl/Qyapp/Day/images/start.png" id="'+ lists[6][i].id +'" onclick="onmsg(this)"/>';
							}else{	
								code +=  '<img src="./Tpl/Qyapp/Day/images/stop.png" id="'+ lists[6][i].id +'" onclick="onmsg(this)"/>';
							}
							code +=  '               </dd>';
							code +=  '               <!-- <div class="clear"></div>';
							code +=  '			   <div class="time">';
							code +=  '				时间：<span>'+ lists[6][i].time +'</span></br>';
							code +=  '		   </div> -->';
							code +=  '           </dl>';
							code +=  '       </div>';
							code +=  '	   <span class="span-border"></span>';
							code +=  '   </div>';
							code +=  '</div>';
							code +=  '<div class="clear"></div>';
							code +=  '</div>';
							code +=  '</a> ';
							code +=  '</li>';
						}
					}else{
						code +=  '<p class="content_no">';
						code +=  '<img src="Tpl/Qyapp/Day/images/error.png" class="pic_no">';
						code +=  '<span>亲！暂无相关信息哦！！！</span>';
						code +=  '</p>';
					}
					code +=  '</ul>';
					//alert(code)
					//alert(code);
					document.getElementById("content").innerHTML = '';
					document.getElementById("content").innerHTML = code;
					tab();
					alertsuccess('查询成功');
				}
				
		},
		error:function(){
			alert('数据提交失败');
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