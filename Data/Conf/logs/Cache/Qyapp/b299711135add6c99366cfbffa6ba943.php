<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>发布公告</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>

<link href="./Tpl/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>

<link href="./Tpl/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/Qyapp/Announce/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="./Tpl/assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/assets/admin/layout/css/weiyi.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/Qyapp/Announce/css/ann.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="./Tpl/Qyapp/Workflow/js/swipe.js"></script>
  <script src="./Tpl/Qyapp/Static/Js/scroll/dev/jquery-1.9.1.js"></script>
  <script type="text/javascript" src="./Tpl/assets/global/plugins/plupload/2.1.3/js/plupload.full.min.js"></script>

<!-- <script type="text/javascript" src="./Tpl/assets/global/plugins/plupload/2.1.3/js/moxie.js"></script>
<script type="text/javascript" src="./Tpl/assets/global/plugins/plupload/2.1.3/js/plupload.dev.js"></script>
 -->
<!--    <script src="./Tpl/Qyapp/Static/Js/scroll/dev/js/mobiscroll.core-2.5.2.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/scroll/dev/js/mobiscroll.core-2.5.2-zh.js" type="text/javascript"></script>
	<link href="./Tpl/Qyapp/Static/Js/scroll/dev/css/mobiscroll.core-2.5.2.css" rel="stylesheet" type="text/css" />
	<link href="./Tpl/Qyapp/Static/Js/scroll/dev/css/mobiscroll.animation-2.5.2.css" rel="stylesheet" type="text/css" />
	<script src="./Tpl/Qyapp/Static/Js/scroll/dev/js/mobiscroll.datetime-2.5.1.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/scroll/dev/js/mobiscroll.datetime-2.5.1-zh.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/scroll/dev/js/mobiscroll.android-ics-2.5.2.js" type="text/javascript"></script>
	<link href="./Tpl/Qyapp/Static/Js/scroll/dev/css/mobiscroll.android-ics-2.5.2.css" rel="stylesheet" type="text/css" /> -->
	 
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="page-quick-sidebar-over-content ">
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper"> 
<div class="page-content">

<div class="page-quick-sidebar-wrapper" style="background-color:#fff;" id="allusers">

</div>
<!-- END QUICK SIDEBAR -->		

<form action="<?php echo U('Announce/wap_add_task',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" method="post">
<input type="hidden" value="<?php echo $_GET['a_id'];?>"  name="a_id">
<input type="hidden" value="<?php echo $_GET['token'];?>"  name="token">
<input type="hidden" value="<?php echo $_GET['wecha_id'];?>"  name="wecha_id">
<div class="row">
<div class="col-md-12">
<div class="clearfix">
<!-- <h4 class="block">With List Groups</h4> -->
<div class="panel" style="border-color:#35aa47;background-color:#35aa47;">
<!-- Default panel contents -->
<div class="panel-heading">
<h3 class="panel-title" style="color:#fff;"><i class="fa fa-plus">&nbsp;</i>添加公告</h3>
</div>

<!-- List group -->
<ul class="list-group">
<li class="list-group-item" onclick="selectDepart('truename','1');">
[发布部门] 
<span style="border:none;color:#35aa47;width:80%;height:30px;" id="myinput"></span>
<input name="todepart" id="todepart" value="<?php echo ($depart["id"]); ?>" type="hidden" style="border:none;color:#35aa47;" >
<span class="pull-right"><img src="./Tpl/Qyapp/Task/images/iconfont-tianjia.png" width="20px"></span>
<!-- <input type="hidden" value="<?php echo ($order["id"]); ?>" id="head" name="head"> -->
</li>										
<li class="list-group-item" onclick="selectAll('name','2');">
[指定人员] 
<span style="border:none;color:#35aa47;width:80%;height:30px;" id="myinput2"></span>
<input name="touser" class="px" id="name" type="hidden" value="">
<span class="pull-right"><img src="./Tpl/Qyapp/Task/images/iconfont-tianjia.png" width="20px"></span>
<input type="hidden" value="<?php echo ($user["id"]); ?>" id="follow" name="touser">												 

</li>
<li class="list-group-item">
[公告标题] <input type="text" class="px" name="title" id="dateline" style="border:none;" value="<?php echo ($data["title"]); ?>">
<!-- <span class="pull-right"><img src="./Tpl/Qyapp/Task/images/iconfont-tianjia.png" width="20px"></span> -->
</li>

<!-- <li class="list-group-item" id="plupload" data-url="<?php echo U('Plupload/upload',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>" >
[上传测试]
    <br/>
<div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
<br />

<div id="container">
    <a id="pickfiles" href="javascript:;">[选择图片]</a> 
    <a id="uploadfiles" href="javascript:;">[开始上传]</a>
</div>

<br />
<pre id="console"></pre>
 
<script type="text/javascript">  
    var uploadurl  = $('#plupload').attr('data-url');
    var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles', // you can pass in id...
	container: document.getElementById('container'), // ... or DOM Element itself
	url : uploadurl,
	flash_swf_url : '../js/Moxie.swf',
	silverlight_xap_url : '../js/Moxie.xap',
	
	filters : {
		max_file_size : '10mb',
		mime_types: [
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Zip files", extensions : "zip"}
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('filelist').innerHTML = '';

			document.getElementById('uploadfiles').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
			});
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},

		Error: function(up, err) {
			document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		}
	}
});

uploader.init();

</script>
</li> -->


<li class="list-group-item" id="liHeader" >
[选择图片]
    <br/>
    <div id="addImg"></div>
			
    <a href="javascript:;" id="chooseImage"><img src="./Tpl/Qyapp/Announce/images/iconfont-zengjia.png" width="50px" height="50px"></a>
</li>											
<li class="list-group-item">
<div class="form-group">
<p>[公告内容]</p>

<textarea class="form-control" rows="10" name="content" id="content"></textarea>
</div>
</li>
</ul>
</div>
</div>				
</div>
</div>
<!-- END PAGE CONTENT-->
<div class="row" style="margin-bottom:10px;">
<div class="col-md-12">
<div class="form-actions">
<div id="uploadPic">
	<div id="appendInput"></div>
</div>
<input type="button" class="btn green btn-block" value="提交" id="submitImg"/>
</div>				
</div>
</div>
</form>
</div>
<!--  -->
<!-- END CONTENT -->
</div>

<!-- <script src="./Tpl/assets/global/plugins/jquery.min.js" type="text/javascript"></script>  -->
<!-- <script src="./Tpl/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script> -->
<!-- <script src="./Tpl/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script> -->
<script src="./Tpl/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- <script src="./Tpl/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> -->
<script src="./Tpl/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- <script src="./Tpl/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="./Tpl/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="./Tpl/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="./Tpl/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./Tpl/assets/global/plugins/select2/select2.min.js"></script> -->

<script src="./Tpl/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./Tpl/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./Tpl/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<!-- <script src="./Tpl/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="./Tpl/assets/admin/pages/scripts/form-samples.js"></script> -->

<script>
jQuery(document).ready(function() {    
// initiate layout and plugins
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
//Demo.init(); // init demo features
//FormSamples.init();
$('#tab_0 div.portlet').each(function(){
$(this).children('.portlet-title').click(function(){
//alert($(this).siblings('.portlet-body').html());
if($(this).siblings('.portlet-body').css('display') == 'block'){
$(this).siblings('.portlet-body').css('display','none');
$(this).find('.tools').children().removeClass('collapse');
$(this).find('.tools').children().addClass('expand');
}else{
$(this).siblings('.portlet-body').css('display','block');
$(this).find('.tools').children().addClass('collapse');
$(this).find('.tools').children().removeClass('expand');			   
}
});
});
});
</script>
<script>
function selectDepart(id,type){
$('body').addClass('page-quick-sidebar-open');
$('#allusers').css('width','100%');
$('#allusers').css('top','0');
$('#allusers').load("<?php echo U('Adlu/wap_depart',array('wecha_id'=>$_GET['wecha_id'],'token'=>$_GET['token'],'type'=>2));?>");
$('#getdata').html('');
$('#submit').attr('mydata',type);
$('#media-list li.media').children('div.media-status').children().children().children().attr("class",'');

}

function selectOne(id,type){
	$('body').addClass('page-quick-sidebar-open');
	$('#allusers').css('width','100%');
	$('#allusers').css('top','0');
	$('#allusers').load("<?php echo U('Task/wap_one_user',array('wecha_id'=>$_GET['wecha_id'],'token'=>$_GET['token'],'type'=>2));?>");
	$('#getdata').html('');
	$('#submit').attr('mydata',type);
	$('#media-list li.media').children('div.media-status').children().children().children().attr("class",'');

}
function selectAll(id,type){
$('body').addClass('page-quick-sidebar-open');
$('#allusers').css('width','100%');
$('#allusers').css('top','0');
$('#allusers').load("<?php echo U('Adlu/wap_all',array('wecha_id'=>$_GET['wecha_id'],'token'=>$_GET['token'],'type'=>2));?>");
$('#getdata').html('');
$('#submit').attr('mydata',type);
$('#media-list li.media').children('div.media-status').children().children().children().attr("class",'');

}
function closeList(){
$('body').removeClass('page-quick-sidebar-open');
$('#allusers').css('width','0');
$('#getdata').html('');	
$('#allusers').html('');

}
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
<!-- END JAVASCRIPTS -->
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
wx.config({
debug: false,
appId: '<?php echo ($jsssdk_info["appId"]); ?>',
timestamp: <?php echo ($jsssdk_info["timestamp"]); ?>,
nonceStr: '<?php echo ($jsssdk_info["nonceStr"]); ?>',
signature: '<?php echo ($jsssdk_info["signature"]); ?>',
jsApiList: [
'checkJsApi',
'onMenuShareTimeline',
'onMenuShareAppMessage',
'onMenuShareQQ',
'onMenuShareWeibo',
'openCard',
'previewImage',
'chooseImage',
'uploadImage',
'downloadImage'
]
});
</script>
<!-- 
<script>
$('#chooseImage').click(function(){
	wx.chooseImage({
		success: function (res) {			
			var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
			$.each(localIds,function(k,v){
				var l = '';
				var num = Math.floor(Math.random()*999+1);
				l += '<div class="choose_pic"  id="appendsImg_'+num+'">';
				l +='<input type="hidden" value="'+v+'" name="pic'+num+'">';
				l += '<img src="'+v+'" width="35px" height="35px"/>';
				l += '<a href="javascript:;" onclick="delImg('+num+')">';
				l += '<img class="icon_reduce" src="./Tpl/Qyapp/Announce/images/iconfont-iconfontjian.png" width="15px" height="15px"/>';
				l += '</a></div>';
				$('#addImg').append(l);	
			});
		}
	});
});
</script> -->
<script>
$('#chooseImage').click(function(){
	wx.chooseImage({
		
		success: function (res) {			
			var localId = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片			
			uploadImage(localId,'');
			
		}
	});
	
function uploadImage(localIds){
var localId = localIds.pop();
	var token="<?php echo $_GET['token'];?>";
	var wecha_id="<?php echo $_GET['wecha_id'];?>";
	wx.uploadImage({
		localId: localId,
		isShowProgressTips: 1,
		success: function (res) {
			var serverId = res.serverId;			
			var l = '';
			var num = Math.floor(Math.random()*999+1);
			l += '<div class="choose_pic"  id="appendsImg_'+num+'">';
			l += '<img src="'+localId+'" width="35px" height="35px"/>';
			l += '<a href="javascript:;" onclick="delImg('+num+')">';
			l += '<img class="icon_reduce" src="./Tpl/Qyapp/Announce/images/iconfont-iconfontjian.png" width="15px" height="15px"/>';
			l += '</a></div>';
			$('#addImg').append(l);
			var imgInput = '<input type="hidden" value="'+serverId+'" name="pic['+num+']" id="chooseDoneimg_'+num+'"/>';
			$('#appendInput').append(imgInput);
			if(localIds.length > 0){
				setTimeout(function(){ uploadImage(localIds);},100);
			}
				
		}
	});

}
	
});
</script>
<script>
function delImg(m){
	//$('#appendsImg_'+m).remove();
	$('#appendsImg_'+m).remove();
	$('#chooseDoneimg_'+m).remove();	
}
</script>
<script>
$('#submitImg').click(function(){
	var localIds = new Array();
	var token="<?php echo $_GET['token'];?>";
	var wecha_id="<?php echo $_GET['wecha_id'];?>";
	var a_id="<?php echo $_GET['a_id'];?>";
	var touser=$('#follow').val();
	var todepart=$('#todepart').attr('todepart');
	var title=$('#dateline').val();
	var content=$('#content').val();	

	var pic='';
	$('#uploadPic input').each(function(k,v){
		 var value = $(this).attr('value');	
		 pic += ''+value+',';
	});
	//if(localIds.length!=0){
	//	syncUpload(localIds,'');
	//}else{
	    //alert(title);
		$.ajax({
			type: "post",  
			url:"<?php echo U('wap_add_task',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>",
			dataType:'json',
			data:{'token':token,'wecha_id':wecha_id,'a_id':a_id,'touser':touser,'todepart':todepart,'title':title,'content':content,'pic':pic},
			success:function(json){
				if(json){
					alert('发送成功');
					window.location.href="<?php echo U('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'pid'=>"+json+"));?>";
				}else{
					alert('发送失败');
					window.location.href="<?php echo U('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>";
				}				
			}
		});
	//}	
});
function syncUpload(localIds,id){
	var localId = localIds.pop();
	//var token="<?php echo $_GET['token'];?>";
	//var wecha_id="<?php echo $_GET['wecha_id'];?>";
	//var fuzeren=$('#truename').val();
	//var head=$('#head').val();
	//var helper=$('#name').val();
	//var follow=$('#follow').val();
	//var end_time=$('#dateline').val();
	//var order=$('#ysex').val();
	//var content=$('#contents').val();
	//alert(localId);
	var token="<?php echo $_GET['token'];?>";
	var wecha_id="<?php echo $_GET['wecha_id'];?>";
	var a_id="<?php echo $_GET['a_id'];?>";
	var touser=$('#follow').val();
	var todepart=$('#todepart').val();
	var title=$('#dateline').val();
	var content=$('#content').val();	
	//alert(token);
	//alert(wecha_id);
	//alert(a_id);
	//alert(touser);
	//alert(todepart);
	//alert(title);
	//alert(content);	
	wx.uploadImage({
		localId: localId,
		isShowProgressTips: 1,
		success: function (res) {
			var serverId = res.serverId;
			id += ''+serverId+',';
			
			if(localIds.length > 0){
				setTimeout(function(){ syncUpload(localIds,id);},100);
			}else{
				$.ajax({
					type: "post",  
					url:"<?php echo U('wap_add_task',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>",
					dataType:'json',
					data:{'token':token,'wecha_id':wecha_id,'a_id':a_id,'touser':touser,'todepart':todepart,'title':title,'content':content,'pic':id},
					success:function(json){
						if(json){
							alert('发送成功');
							window.location.href="<?php echo U('wap_act_info',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'pid'=>'"+json+"'));?>";
						}else{
							alert('发送失败');
							window.location.href="<?php echo U('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>";
						}						
					}
				});
			}
		}
	});
	
};
</script>







<script>
wx.ready(function () {
// 2.1 监听“分享给朋友”，按钮点击、自定义分享内容及分享结果接口
var newUrl="http://<?php echo $_SERVER['HTTP_HOST'];?>";
wx.onMenuShareAppMessage({
title: '分享招聘岗位挣红包',
desc: '分享招聘岗位挣红包',
link: newUrl+"<?php echo U('wap_positionInfo',array('token'=>$_GET['token'],'pid'=>$_GET['pid'],'wecha_id'=>$_GET['wecha_id'],'type'=>'up'));?>",
imgUrl: newUrl+"/Tpl/Qyapp/Hiring/images/logo.jpg",
trigger: function (res) {
},
success: function (res) {
},
cancel: function (res) {
},
fail: function (res) {
}
});
// 2.2 监听“分享到朋友圈”按钮点击、自定义分享内容及分享结果接口
wx.onMenuShareTimeline({
title: '分享招聘岗位挣红包',
link: newUrl+"<?php echo U('wap_positionInfo',array('token'=>$_GET['token'],'pid'=>$_GET['pid'],'wecha_id'=>$_GET['wecha_id'],'type'=>'up'));?>",
imgUrl: newUrl+"/Tpl/Qyapp/Hiring/images/logo.jpg",
trigger: function (res) {
},
success: function (res) {
},
cancel: function (res) {
},
fail: function (res) {
}
});

// 2.3 监听“分享到QQ”按钮点击、自定义分享内容及分享结果接口
wx.onMenuShareQQ({
title: '分享招聘岗位挣红包',
desc: '分享招聘岗位挣红包',
link: newUrl+"<?php echo U('wap_positionInfo',array('token'=>$_GET['token'],'pid'=>$_GET['pid'],'wecha_id'=>$_GET['wecha_id'],'type'=>'up'));?>",
imgUrl: newUrl+"/Tpl/Qyapp/Hiring/images/logo.jpg",
trigger: function (res) {
},
complete: function (res) {
},
success: function (res) {
},
cancel: function (res) {
},
fail: function (res) {
}
});
// 2.4 监听“分享到微博”按钮点击、自定义分享内容及分享结果接口
wx.onMenuShareWeibo({
title: '分享招聘岗位挣红包',
desc: '分享招聘岗位挣红包',
link:  newUrl+"<?php echo U('wap_positionInfo',array('token'=>$_GET['token'],'pid'=>$_GET['pid'],'wecha_id'=>$_GET['wecha_id'],'type'=>'up'));?>",
imgUrl: newUrl+"/Tpl/Qyapp/Hiring/images/logo.jpg",
trigger: function (res) {
},
complete: function (res) {
},
success: function (res) {
},
cancel: function (res) {
},
fail: function (res) {
}
});

});
</script>

</body>
<!-- END BODY -->
</html>