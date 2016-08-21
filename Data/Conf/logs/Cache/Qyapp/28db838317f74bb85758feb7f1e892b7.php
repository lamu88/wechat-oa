<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="cn" class="app fadeInUp animated js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
	 <title>我的报销</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta content=" " name="Keywords">
    <meta content="" name="Description">
	<link href="./Tpl/Qyapp/Workflow/css/m.css" rel="stylesheet" type="text/css" />
	<link href="./Tpl/Qyapp/Workflow/css/cate24_0.css" rel="stylesheet" type="text/css" />
	<link href="./Tpl/Qyapp/Workflow/css/index.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="./Tpl/Qyapp/Applyflow/css/m2265a.css">
    <script src="./Tpl/Qyapp/Applyflow/js/jquery-1.9.1.min.js" type="text/javascript"></script>

	<style>
	.btomx{
	bottom:solid 1px #eee;
	
	
	}
	
	
	</style>
	</head>
		<body id="cate12" style="background-color:#FFF;" >
		
<!--		<div id="menu" style="position:fixed;top:0px;bottom:0px;width:100%;height:44px;line-height:44px;z-index:999;">
	<ul style="margin:0 auto;list-style-type:none;width:100%;height:100%;">
		<a href="<?php echo U('wap_act_my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'] ,'status'=>1));?>"><li  <?php if(($_GET["status"] == 1) OR ($_GET["status"] == NULL)): ?>style="border-bottom:solid 2px #01bd52;"<?php endif; ?>><img class="img_front" src="./Tpl/Qyapp/Workflow/images/front.png"><div class="menu_li">&nbsp;审批中</div>

		<div style="z-index:999;width:1px;height:22px;position:absolute;right:1px;top:12px;border-right:solid 1px #ccc"></div>
		</li>

		
		
		</a>
		<a href="<?php echo U('wap_act_my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'status'=>2));?>"><li <?php if($_GET["status"] == 2): ?>style="border-bottom:solid 2px #01bd52;"<?php endif; ?>><img class="img_front" src="./Tpl/Qyapp/Workflow/images/front.png"><div class="menu_li">&nbsp;通过</div>
		<div style="z-index:999;width:1px;height:22px;position:absolute;right:1px;top:12px;border-right:solid 1px #ccc"></div>
		</li>
		
		</a>
		<a href="<?php echo U('wap_act_my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'status'=>3));?>"><li <?php if($_GET["status"] == 3): ?>style="border-bottom:solid 2px #01bd52;"<?php endif; ?>><img class="img_front" src="./Tpl/Qyapp/Workflow/images/front.png" ><div class="menu_li">&nbsp;驳回</div>
		
		</li>
		</a>
	</ul>
</div>
-->
<div id="content"> 
<div class="softload"> 
<?php if($list): ?><ul style="margin-top:20px;margin-bottom:46px;">
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li >
	<span class="icon_cont"> 
	<span class="apply_time fll"><p><?php echo (date("m-d",$list["time"])); ?><span><?php echo (date("H:i",$list["time"])); ?></span></p></span>
	<div class="apply_type fll"><span class="type_bd"><img src="./Tpl/Qyapp/Applyflow/images/iconfont-qiandai.png" ></span><span class="type_line"></span></div> 
	<span class="icon_dis fll"> 
	<a href="<?php echo U('wap_act_info',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$list['id']));?>">
	<span class="title" style="font-size:13px;color:#444;">姓名：<?php echo ($list["info"]["name"]); ?></span>
	<span class="title" style="font-size:13px;color:#444;">金额：<span style="font-size:12px;color:#999;">￥<?php echo ($list["allmoney"]); ?></span></span>
	<span class="down"><?php if($list['status'] == 1): ?><span class="nows">正在审核</span><?php endif; if($list['status'] == 2): ?><span class="nows">已通过</span><?php endif; if($list['status'] == 3): ?><span class="nows">已驳回</span><?php endif; ?></span>
	<span class="down">类型：<?php echo ($list["msg_type"]["name"]); ?></span>
	</a> 
	
	</span>
	</span>
	<span class="clear"></span>
	</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<?php else: endif; ?> 
</div> 
</div> 
		
<div id="frame">
<link href="./Tpl/Qyapp/Static/Css/sign.css" rel="stylesheet" type="text/css" />
	<!-- -->
    <!--<div id="Btm">
        <div class="btm_float" style="border-top:1px solid #ccc;">
        	<ul>
            	<a href="<?php echo U('wap_act_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>"><li>待报销</li></a>
                <a href="<?php echo U('wap_act_my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>"><li class="border">我的报销</li></a>
                <a href="<?php echo U('wap_post',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>"><li>申请报销</li></a>
            </ul>
        </div>
    </div> -->
    <div id="menu">
	<ul>
		<li>
			<div class="menu_li">我的审批</div>
			<span>
				<img src="./Tpl/Qyapp/Applyflow/images/navbg3.png" width="90%">
				<div>
					<a href="<?php echo U('wap_act_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'status'=>0));?>">审批中</a>
					<a href="<?php echo U('wap_act_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'status'=>1));?>">通过</a>
					<a href="<?php echo U('wap_act_list',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'status'=>2));?>">驳回</a>
				</div>
			</span>
		</li>
		<li>
			<div class="menu_li border">我的报销</div>
			<span>
				<img src="./Tpl/Qyapp/Applyflow/images/navbg3.png" width="90%" />
				<div>
					<a href="<?php echo U('wap_act_my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'status'=>1));?>">审批中</a>
					<a href="<?php echo U('wap_act_my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'status'=>2));?>">通过</a>
					<a href="<?php echo U('wap_act_my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'status'=>3));?>">驳回</a>
				</div>
			</span>
		</li>
		 <a href="<?php echo U('wap_post',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">
         <li>
			<div class="menu_li">申请审核</div>
<!--			<span>
				<img src="./Tpl/Qyapp/Applyflow/images/navbg5.png" width="100%">
				<div>
					<a href="http://www.17sucai.com">咨询购买</a>
					<a href="http://www.17sucai.com">咨询购买</a>
					<a href="http://www.17sucai.com">咨询购买</a>
					<a href="http://www.17sucai.com">咨询购买</a>
					<a href="http://www.17sucai.com">咨询购买</a>
				</div>
			</span>
-->		</li>
		</a>
	</ul>
</div>
<div class="footer_front"><img src="./Tpl/Qyapp/Applyflow/images/front.png" width="100%" height="100%"></div>

<style>
/*#menu ul li{float:left;width:33.3%;height:100%;text-align:center;position:relative;font-size:14px;border-bottom:solid 1px #eee}
#menu ul li .line{position:absolute;top:0px;right:0px;z-index:30;}
#menu ul li .menu_li{position:absolute;top:0px;left:0px;z-index:20;width:100%;height:100%;color:#454545;}
#menu ul li .img_front{position:absolute;top:0px;left:0px;z-index:30;width:100%;height:100%;}
#menu ul li .img_front img{width:100%;height:100%;}
#menu ul li span{position:absolute;bottom:-300px;left:50%;width:104px;margin-left:-52px;height:auto;text-align:center;z-index:10;}
#menu ul li span a{float:left;width:100%;height:43px;line-height:43px;color:#454545;text-decoration:none;}
*/
#menu{position:fixed;bottom:0px;width:100%;height:44px;line-height:44px;z-index:999; background-color:#fff;border-top:solid 1px #ccc;}
#menu ul{margin:0 auto;list-style-type:none;width:100%;height:100%;}
#menu ul li{float:left;width:33.3%;height:100%;text-align:center;position:relative;font-size:14px; background-color:#fff;}
#menu ul li .line{position:absolute;top:0px;right:0px;z-index:30;}
#menu ul li .border{ border-left:1px solid #eee; border-right:1px solid #eee;}
#menu ul li .menu_li{position:absolute;top:0px;left:0px;z-index:20;width:100%;height:100%;color:#454545;}
#menu ul li .img_front{position:absolute;top:0px;left:0px;z-index:30;width:100%;height:100%;}
#menu ul li .img_front img{width:100%;height:100%;}
#menu ul li span{position:absolute;bottom:-300px;left:50%;width:104px;margin-left:-52px;height:auto;text-align:center;z-index:-10;}
#menu ul li span div{position:absolute;top:0px;left:0px;}
#menu ul li span a{float:left;width:100%;height:43px;line-height:43px;color:#454545;text-decoration:none;}

.footer_front{position:fixed;width:100%;height:100%;top:0px;left:0px;z-index:888;display:none;}
.fll{
	float: left;
}
.apply_time{
	width: 14%;
	height: 45px;
	text-align: center;
	color: #35aa47;
	font-size: 9px;
	margin: 0px 5px 0 8px;
	line-height: 12px;
	background:url(./Tpl/Qyapp/Applyflow/images/iconfont-rili.png) no-repeat center / 43px;
}
.apply_time span{display: block;font-size: 11px;}
.apply_time p{
	margin-top: 15px;
}
.apply_type{
	width: 12%;position: relative;
}
.type_bd{
	width: 26px;
	height: 26px;
	display: block;
	border:1px solid #ccc;
	border-radius: 100%;
	background:#fff;
	z-index: 123;
}
.type_bd img{
	border: none;
	width: 24px !important;
	height: 24px !important;
	margin:1px;
}
.type_line{
	width: 0;
	height: 63px;
	border-left: 1px solid #ccc;
	position: absolute;
	top:27px;
	left: 13px;
}
.icon_dis{
	width: 62%;
	padding: 6px;
	border: 1px solid #ccc;
	border-radius: 6px;
	margin-bottom: 10px;
	position: relative;
}
.nows{
	position: absolute;right: 10px;bottom: 6px;
}
</style>
<script type="text/javascript">
window.onload = function(){
	$('#menu ul li').each(function(j){
		$('#menu ul li').eq(j).removeClass("on");
		$('#menu ul li span').eq(j).animate({bottom:-$('#menu ul li span').eq(j).height()},100);
	});
}

$('#menu ul li').each(function(i){
	$(this).click(function(){
		if($(this).attr("class")!="on"){
			$('#menu ul .on span').animate({bottom:-$('#menu ul .on span').height()},200);
			$('#menu ul .on').removeClass("on");
			$(this).addClass("on");
			$('#menu ul li span').eq(i).animate({bottom:50},300);
			$('.footer_front').show();
		}else{
			$('#menu ul li span').eq(i).animate({bottom:-$('#menu ul li span').eq(i).height()},200);
			$(this).removeClass("on");
			$('.footer_front').hide();
		}
	});
});

$('.footer_front').click(function(){
	$('#menu ul .on span').animate({bottom:-$('#menu ul .on span').height()},200);
	$('#menu ul .on').removeClass("on");
	$(this).hide();
});
</script>

</div>
</body>