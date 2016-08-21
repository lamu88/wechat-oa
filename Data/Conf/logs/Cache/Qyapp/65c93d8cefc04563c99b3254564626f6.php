<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>发布任务</title>
    <link rel="stylesheet" href="./Tpl/Qyapp/Task/css/style1.css">
    <link rel="stylesheet" href="./Tpl/Qyapp/Task/css/date.css">
<style>
.item-span{font-size: 16px;font-family: microsoft yahei;height: 45px;line-height: 45px;color: #444;}
#add-con{color: #535353;font-size: 14px;font-family: "arial","微软雅黑";background: #fff;width: 100%;overflow: hidden;width: 100%;min-height: 100%;background: #e5e5e5;position: absolute;top: 0;left: 0;z-index: 999;overflow-x: hidden;overflow-y: auto;padding-bottom: 20px;}
.address-content{color: #535353;font-size: 14px;font-family: "arial","微软雅黑";background: #fff;width: 100%;overflow: hidden;width: 100%;min-height: 100%;background: #e5e5e5;position: absolute;top: 0;left: 0;z-index: 999;overflow-x: hidden;overflow-y: auto;padding-bottom: 20px;}
.letter{font-size:16px;height:24px;width:16%;float:left;background-color:#fff;margin:1px;padding:12px 0px 10px 0px;text-align:center;}
.img-status{display:none;}
.bg-circle{float:left;width:40px; border-radius:50%;height:40px; line-height:40px;margin-right:3px;margin-bottom:6px;overflow:hidden;}
.bg-circle-a{float:left;width:40px;height:40px; line-height:40px;margin-right:3px;margin-bottom:6px;overflow:hidden;}
.bg-text{height:40px; line-height:40px; display:block; color:#FFF; text-align:center;font-size:12px;}
</style>	
</head>
<body class="bg1" style="position:relative;padding-top:0px;margin-top:0px;">
<section class="sec02-01">
	
	<form action="<?php echo U('Task/wap_add_task',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" method="post">
	<input type="hidden" value="<?php echo $_GET['a_id'];?>"  name="a_id">
	<input type="hidden" value="<?php echo $_GET['token'];?>"  name="token" id="token">
	<input type="hidden" value="<?php echo $_GET['wecha_id'];?>"  name="wecha_id" id="wecha_id">
	
    <ul>
		<li style="height:auto;overflow:hidden">
            <i></i>
			<span class="tj_tt">项目名称</span>
			 <span class="span"></span>
            <input class="input1 fr tj_wd" type="text" id="title" name="title" value=""  placeholder="请输入"> 
            <!--<input type="hidden" name="fuzeren1" id="fuzeren1" value=""/>-->
			</div>
        </li>
        <li style="height:auto;">
		    <div id="send-li-p" style="margin-left: 5%;">
				<div class="item-span" style="width:80px;" id="send-li">负责人</div>
				<div id="list-fuzeren1">
				    <span onclick="address('2','fuzeren1','1')" id="add-fuzeren1"><img src="/Tpl/Qyapp/Applyflow/images/sec02-06.png" width="40px" height="40px"></span>
				</div>
                <input type="hidden" name="fuzeren1" id="fuzeren1" value=""/>				
            </div>	
			<div style="clear:both;"></div>
        </li>
        <li style="height:auto;">
		    <div id="send-li-p" style="margin-left: 5%;">
				<div class="item-span" style="width:80px;" id="send-li">协助人</div>
				<div id="list-helper1">
				    <span onclick="address('2','helper1','n')" id="add-helper1"><img src="/Tpl/Qyapp/Applyflow/images/sec02-06.png" width="40px" height="40px"></span>
				</div>
                <input type="hidden" name="helper1" id="helper1" value=""/>					
            </div>	
			<div style="clear:both;"></div>
        </li>		
		<li>
            <i></i>
			<span class="item-span tj_tt">起始时间</span>
            <input value="" class="kbtn time tj_wd fr" placeholder="请选择" name="start_time" readonly="readonly" id="start_time"/></div>
        </li>
		<li>
            <i></i>
			<span class="item-span tj_tt">截止时间</span>
            <input value="" class="kbtn time tj_wd fr" placeholder="请选择" name="end_time" readonly="readonly" id="end_time"/></div>
        </li>
		<li>
            <i></i>
			<span class="tj_tt">优先级</span>
			<span class="badge badge-default" id="high" style="margin-left:10%;margin-right:10%;" onclick="selectIt('high')">低 </span>
			<span class="badge badge-default" id="medium" style="margin-left:10%;margin-right:10%;" onclick="selectIt('medium')">中 </span>
			<span class="badge badge-default" style="margin-left:10%;margin-right:10%;" id="low" onclick="selectIt('low')">高 </span>
			<input type="hidden" name="order" id="ysex">
        </li>
         <li class="li1">
            <textarea type="text" class="newimg info" name="content" id="content" placeholder="请输入任务详情"></textarea>
			<!-- <div class="pic_list">
			[选择图片]
				<br/>
				<div id="addImg"></div>
				<a href="javascript:;" id="chooseImage"><img src="./Tpl/Qyapp/Announce/images/iconfont-zengjia.png" width="50px" height="50px"></a>
				<input type="hidden" id="pic" name="pic" value="" />
			</div> -->
        </li>
		<li class="li1" id="liHeader" >
			<!-- <input type="hidden" id="pic_1" name="pic" value="" /> -->
			<div class="add">
				[选择图片]
				<br/>
				<div></div>
				<div id="addImg_1"></div>
				<a href="javascript:;" class="chooseImage" onclick="chooseImage($(this));" data-n="1"><img src="./Tpl/Qyapp/Announce/images/iconfont-zengjia.png" style="margin-bottom:10px;width:80px;height:80px;"></a><input type="hidden" id="pic" name="pic" value="" />						
			</div>				
		</li>		
		<!-- <li class="li1" id="liHeader" >
		<div class="pic_list">
		[选择图片]
			<br/>
			<div id="addImg"></div>
			<a href="javascript:;" id="chooseImage"><img src="./Tpl/Qyapp/Announce/images/iconfont-zengjia.png" width="50px" height="50px"></a>
		<span class="pull-right"><img src="./Tpl/Qyapp/Task/images/iconfont-tianjia.png" width="20px"></span>
		</div>
		</li> -->	
    </ul>
    <div style="width:100%;height:50px;"></div>
    <div class="button-w submit"><input type="button" id="submitImging" name="1" value="提交"/></div>
	
	</form>
</section>
<div id="address-btn" style="position: fixed;bottom: 0px;width: 100%;height: 36px;line-height: 36px;background: #fff;z-index:10000;padding-bottom: 10px;padding-top:10px;padding-right:2px;display:none;">
	<ul style="margin:0 auto;list-style-type:none;width:100%;height:100%;padding-left:2px;padding-right:2px;margin-right:2px;">
	<a href="javascript:;" id="fanhui" onclick="fanhui()">
		<li style="float:left;background:#de5045;width: 47%;height: 100%;text-align: center;position: relative;font-size: 14px;border-radius: 3px;margin-left:2px;margin-right:2px;"><div style="position: absolute;top: 0px;left: 0px;z-index: 20;width: 100%;height: 100%;color: #fff;">返回</div></li>
	</a>				
	<a href="javascript:;" id="queding" onclick="queding()" data-id="" data-num="">
		<li style="float:right;background:#35aa47;width: 47%;height: 100%;text-align: center;position: relative;font-size: 14px;border-radius: 3px;margin-right:5px;padding-right:5px;"><div style="position: absolute;top: 0px;left: 0px;z-index: 20;width: 100%;height: 100%;color: #fff;">确定</div></li>
	</a>			
	</ul>
</div>
<script type="text/javascript" src="Tpl/Qyapp/Task/js/jquery-1.10.1.min.js" ></script>
<script src="./Tpl/Qyapp/Task/js/mobiscroll/js/mobiscroll.core.js"></script>
<script src="./Tpl/Qyapp/Task/js/mobiscroll/js/mobiscroll.frame.js"></script>
<script src="./Tpl/Qyapp/Task/js/mobiscroll/js/mobiscroll.scroller.js"></script>

<script src="./Tpl/Qyapp/Task/js/mobiscroll/js/mobiscroll.util.datetime.js"></script>
<script src="./Tpl/Qyapp/Task/js/mobiscroll/js/mobiscroll.datetimebase.js"></script>
<script src="./Tpl/Qyapp/Task/js/mobiscroll/js/mobiscroll.datetime.js"></script>
<script src="./Tpl/Qyapp/Task/js/mobiscroll/js/mobiscroll.select.js"></script>
<script src="./Tpl/Qyapp/Task/js/mobiscroll/js/mobiscroll.frame.ios.js"></script>
<script src="./Tpl/Qyapp/Task/js/mobiscroll/js/mobiscroll.frame.jqm.js"></script>
<script src="./Tpl/Qyapp/Task/js/mobiscroll/js/i18n/mobiscroll.i18n.zh.js"></script>

<link href="./Tpl/Qyapp/Task/js/mobiscroll/css/mobiscroll.animation.css" rel="stylesheet" type="text/css" />
<link href="./Tpl/Qyapp/Task/js/mobiscroll/css/mobiscroll.icons.css" rel="stylesheet" type="text/css" />
<link href="./Tpl/Qyapp/Task/js/mobiscroll/css/mobiscroll.frame.css" rel="stylesheet" type="text/css" />
<link href="./Tpl/Qyapp/Task/js/mobiscroll/css/mobiscroll.frame.ios.css" rel="stylesheet" type="text/css" />
<link href="./Tpl/Qyapp/Task/js/mobiscroll/css/mobiscroll.frame.jqm.css" rel="stylesheet" type="text/css" />
<link href="./Tpl/Qyapp/Task/js/mobiscroll/css/mobiscroll.scroller.css" rel="stylesheet" type="text/css" />
<link href="./Tpl/Qyapp/Task/js/mobiscroll/css/mobiscroll.scroller.ios.css" rel="stylesheet" type="text/css" />
<link href="./Tpl/Qyapp/Task/js/mobiscroll/css/mobiscroll.scroller.jqm.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8">   
$(function() {   
	$('#type').mobiscroll().select({
		theme: 'ios',     // Specify theme like: theme: 'ios' or omit setting to use default 
		mode: 'mixed',       // Specify scroller mode like: mode: 'mixed' or omit setting to use default 
		display: 'bottom', // Specify display mode like: display: 'bottom' or omit setting to use default 
		lang: 'zh'        // Specify language like: lang: 'pl' or omit setting to use default 		
	});
	$('.time').mobiscroll().date({
		theme: 'ios',     // Specify theme like: theme: 'ios' or omit setting to use default 
		mode: 'mixed',       // Specify scroller mode like: mode: 'mixed' or omit setting to use default 
		display: 'bottom', // Specify display mode like: display: 'bottom' or omit setting to use default			
		lang: 'zh'        // Specify language like: lang: 'pl' or omit setting to use default 
	});		
});   
</script>

<script type="text/javascript">
	function selectIt(type){
		var level = 3;
		if(type == 'low'){
		$('#low').css('background-color','red');
		$('#medium').css('background-color','');
		$('#high').css('background-color','');		
		level = 1;
		}else if(type == 'medium'){
		$('#low').css('background-color','');
		$('#medium').css('background-color','#e4ca38');	
		$('#high').css('background-color','');			
		level = 2;		
		}else if(type == 'high'){	
		$('#low').css('background-color','');
		$('#medium').css('background-color','');
		$('#high').css('background-color','green');		
		level = 3;			
		}
		$('#ysex').attr('value',level);	
	}
</script>
<script>
$('#submitImging').click(function(){
	var content = $('#content').val();
	//var fuzeren = $('#fuzeren1').val();
	var end_time = $('#end_time').val();
	var start_time = $('#start_time').val();
	var title = $('#title').val();
	var token = $('#token').val();
	var wecha_id = $('#wecha_id').val();
	var ysex = $('#ysex').val();
	var fuzeren = $('#fuzeren1').val();
	var helper = $('#helper1').val();
	var pic='';
	$('#liHeader .choose_pic input').each(function(k,v){
		 var value = $(this).attr('value');	
		 pic += ''+value+',';
	});	
	var subdata='token=<?php echo $_GET['token'];?>&wecha_id=<?php echo $_GET['wecha_id'];?>&content='+content + '&pic='+ pic +'&end_time='+ end_time +'&helper='+ helper +'&fuzeren='+ fuzeren +'&order='+ ysex +'&title='+ title+'&start_time='+ start_time;
	$.ajax({
		type: "post",  
		url:"<?php echo U('wap_add_task',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>",
		dataType:'json',
		data:subdata,
		success:function(data){
			var data = data.status
			//alert(data);
			if(data==1){
				window.location.href="index.php?g=Qyapp&m=Task&a=wap_index&token="+token+"&wecha_id="+wecha_id;
			}
			if(data==2){
				window.location.href="index.php?g=Qyapp&m=Task&a=wap_index&token="+token+"&wecha_id="+wecha_id;
			}				
		},
		error:function(data){
			alert('添加成功');
			window.location.href="index.php?g=Qyapp&m=Task&a=wap_index&token="+token+"&wecha_id="+wecha_id;
		},
	});
	//}	
});
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
<script>
$('#tab_0').show();
$('#top-menu li:first-child').css('border-bottom','3px solid red');

$('#top-menu li').each(function(){
    $(this).click(function(){
	    $('#top-menu li').css('border-bottom','none');
		$(this).css('border-bottom','3px solid red');	
	    var index = $(this).index();
		if(index == 0){
		    $('#letter').hide();		
		    $('#tab_0').show();
			$('#tab_1').hide();
		    $('#tab_2').hide();
		    $('#tab_3').hide();			
		}else if(index == 1){
		    $('#letter').hide();		
		    $('#tab_0').hide();		
		    $('#tab_1').show();
			$('#tab_2').hide();
		    $('#tab_3').hide();	
            $('div.userletter').show();				
		}else if(index == 2){
		    $('#letter').hide();		
		    $('#tab_0').hide();		
		    $('#tab_1').hide();
			$('#tab_2').show();
		    $('#tab_3').hide();
		}else if(index == 3){
		    $('#letter').show();
		    $('#tab_0').hide();		
		    $('#tab_1').show();
		    $('#tab_2').hide();			
		}
	});
});
function find(letter){
    $('#letter').hide();
    var letter = letter.toLowerCase();
    $('div.userletter').hide();
	$('#'+letter).show();
}
$('.add-user').click(function(){
    if($(this).find('.img-status').is(':visible')){
	    $(this).find('.img-status').hide();
	}else{
	    $(this).find('.img-status').show();
	}
});
function address(type,id,num){
    $('#queding').attr('data-id',id);
	$('#queding').attr('data-num',num);
	var selected = $('#'+id).attr('value');
	var url = "index.php?g=Qyapp&m=Common&a=wap_address&token=<?php echo $_GET['token'];?>&wecha_id=<?php echo $_GET['wecha_id'];?>&type="+type+"&sign="+id+"&selected="+selected;
	$.ajax({
		type: "GET",
		cache: false,
		url: url,
		dataType: "html",
		success: function (res) {
			$('body').append(res);
		},
		error: function (xhr, ajaxOptions, thrownError) {
		
		}
	});	
    $('#address-btn').show();	
}
function fanhui(){
	$('.address-content').hide();
	$('#address-btn').hide();
}

function queding(){
	var id = $('#queding').attr('data-id');
    var num = $('#queding').attr('data-num');	
	$('#list-'+id+' div.bg-circle').remove();
	var dept_id = '';
	var dept_name = '';
	var users_id = '';
	var users_name = '';
	$('#selected-users li').each(function(){
		var id_2 = $(this).attr('id');
		var str_2 = id_2.replace('selected-users-','');		
		var users_name = $('#selected-users-name-'+str_2).text();
		var deptcolor = getColor();		
		$('#add-'+id).before('<div class="bg-circle" style="background:'+deptcolor+';" id="my-users-'+str_2+'"><span class="bg-text">'+users_name+'</span></div>');	
		//users_id += str_2+',';
		users_id += id_2+',';
	});	
	
	$('#'+id).attr('value',users_id);
    $('#address-'+id).remove();
    $('#address-btn').hide();	
}
function getColor(){
	var mycolor=new Array("#008cee","#38adff","#ff4141","#858e99","#929292","#5ec9f6","#78c06e","#f65e8d","#f6bf26","#3bc2b5","#5c6bc0","#f65e5e","#5e97f6","#9a89b9","#bd84cd","#6bb5ce");
	var ran = Math.random();
	var len =mycolor.length;
	var ar =ran*len;
	var rancolor = Math.floor(ar);
	var color = mycolor[rancolor];
    return color;	
}
</script>
</body>
</html>