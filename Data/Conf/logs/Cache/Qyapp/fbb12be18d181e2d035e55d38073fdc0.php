<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn" class="app frameset js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?php echo $_SESSION['site_title'];?></title>
    <base href="." target="mainFrame">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content=" " name="Keywords">
    <meta content="" name="Description">
	<link href="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/css/bootstrap.min.css?v=<?php echo time();?>" rel="stylesheet" />
    <link href="./Tpl/Qyapp/Static/Css/animate.min.css?v=<?php echo time();?>" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/font-awesome.min.css?v=<?php echo time();?>" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/style.min.css?v=<?php echo time();?>" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/iconfont.css?v=<?php echo time();?>" rel="stylesheet">
	<script src="./Tpl/Qyapp/Static/Js/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/jquery-migrate.min.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/js/bootstrap.min.js"></script>	    
    <style type="text/css">
        .hidden-bsection {
            display: none;  
        }
        .pageload-overlay {  
            position: fixed;  
            width: 100%;  
            height: 100%;
            top: 0;
            left: 0;
            background: #fff;
            z-index: 1000;
        }
        #loading_done {
            background: url('./Tpl/Qyapp/Static/Images/loading2.gif') no-repeat left top;
            position: fixed;
            width: 52px;
            height: 72px;
            top: 50%;
            left: 50%;
            margin-left: -52px;
            margin-top: -72px;
            z-index: 1001;
        }
    </style>
	
</head>
<script>
$(function(){
  $(".weiyi").click(function() {
	$('.weiyi').removeClass('active');
	$(this).addClass('active');
  });
  $('#bars').on('click',function(){
	  $('.nav-user').addClass('hidden-xs');
	  if($('#nav').hasClass('hidden-xs')){
	      $('#nav').removeClass('hidden-xs');
		  $('.nav-primary').removeClass('hidden-xs');
	  }else{
	      $('#nav').addClass('hidden-xs');
		  $('.nav-primary').addClass('hidden-xs');			  
	  }
  });
    $('#users').on('click',function(){
	  $('.nav-primary').addClass('hidden-xs');
	  if($('.nav-users').hasClass('hidden-xs')){
	      $('#nav').removeClass('hidden-xs');
		  $('.nav-users').removeClass('hidden-xs');
	  }else{
	      $('#nav').addClass('hidden-xs');
		  $('.nav-users').addClass('hidden-xs');			  
	  }
    });
})
</script>

<body>
    <section class="vbox hidden-bsection" style="display: block;">
        <header class="bg-dark header navbar navbar-fixed-top-xs">
            <div class="navbar-header">
                <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav" id="bars">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="javascript:;" class="navbar-brand" data-toggle="fullscreen">
                    <img src="<?php echo $_SESSION['headimg'];?>" class="m-r-sm" style="max-height: 40px;">
                </a>
                <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user" id="users">
                    <i class="fa fa-cog"></i>
                </a>
            </div>
            <div class="msgbox"></div>
            <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
                <li class="hidden-xs">
                    <a href="/index.php?g=Qyapp&m=Appslist&a=appCenter" target="_self" class="nav-new-style nav-border-right" title="应用中心">
                        应用中心
                    </a>
                </li>
                <li class="hidden-xs">
                    <a href="" target="_blank" class="nav-new-style nav-border-right nav-border-left" title="帮助">
                        帮助
                    </a>
                </li>

                <!-- 通知中心 @begin -->
                <li class="hidden-xs hidden">
                    <a href="#" class="dropdown-toggle nav-border-right nav-border-left nav-new-style" data-toggle="dropdown">
                        <i class="iconfont icon-newsnotice icon-size30"></i>
                        <span class="badge badge-sm up bg-danger m-l-n-sm js_msg_count"></span>
                    </a>
                    <section class="dropdown-menu aside-xl ">
                        <section class="panel bg-white js_msg_content">
                        </section>
                        <script type="text/html" id="js_msg_content_footer">
                            <footer class="panel-footer text-sm no-border">
                                <a href="/System/SetAccountNumber?t=" class="pull-right" title="消息通知设置"><i class="iconfont icon-noticeset"></i></a>
                                <a href="/System/NoticeMessageList?t=">查看所有消息</a>
                                <a href="javascript:;" data-path="/System/EmptyNoticeMessage?t=" class="m-l-sm js_msg_empty">清空全部未读</a>
                            </footer>
                        </script>
                    </section>  
                </li>
                <!-- 通知中心 @end -->
                <li class="dropdown" id="down">
                    <a href="javascript:void(0);" class="dropdown-toggle h54 nav-border-left" data-toggle="dropdown" id="show">
                        <span class="thumb-sm avatar pull-left">
                            <img src="./Tpl/Qyapp/Static/Images/avatar1.jpg" alt="">
                        </span>
                        <?php echo $_SESSION['contact'];?>              <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight" id="b">
                        <span class="arrow top"></span>
                        <li>
                            <a href="<?php echo U('Userinfo/info', array('token' => $token));?>" target="_self"><i class="iconfont icon-account m-r-xs icon-size20"></i>帐号信息</a>
                        </li>
						<li>
                            <a href="<?php echo U('Userinfo/upfile', array('token' => $token));?>" target="_self"><i class="iconfont icon-binding m-r-xs icon-size20"></i>存储设置</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Userinfo/edit', array('token' => $token));?>" target="_self"><i class="iconfont icon-pwd m-r-xs icon-size20"></i>修改密码</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Userinfo/bind', array('token' => $token));?>" target="_self"><i class="iconfont icon-binding m-r-xs icon-size20"></i>帐号绑定</a>
                        </li>
						<li>
                            <a href="<?php echo U('Userinfo/version', array('token' => $token));?>" target="_self"><i class="iconfont icon-binding m-r-xs icon-size20"></i>版本升级</a>
                        </li>
						<li>
                            <a href="<?php echo U('Userinfo/appList', array('token' => $token));?>" target="_self"><i class="iconfont icon-binding m-r-xs icon-size20"></i>应用商店</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo U('Userinfo/logout', array('token' => $token));?>" data-toggle="ajaxModal" target="_self"><i class="iconfont icon-logout m-r-xs icon-size20"></i>退出</a>
                        </li>
                    </ul>
					
					<script>
						$b = $("#b");
						$("#show").on({
							"click": function(){
								$b.toggle();
								return false;
							}
						});
						$(document).on({
							"click": function(e){
								var src = e.target;

								if(src.id && src.id ==="b"){
									return false;
								}else{
									$b.hide();
								}
							}
						});
	
					</script>					
                </li>
            </ul>
        </header>
        <section>
            <section class="hbox stretch">
                <aside class="bg-dark lter aside-md hidden-print hidden-xs nav-xs" id="nav">
                    <section class="vbox">
                        <section class="w-f scrollable">
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 564px;"><div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333" style="overflow: hidden; width: auto; height: 564px;">
                                <nav class="nav-primary hidden-xs">
                                    <ul class="nav">
                                        <li class="active weiyi">
										<?php if(MODULE_NAME == 'Appslist'): ?><li class="active weiyi"><?php else: ?> <li class=" weiyi"><?php endif; ?>
                                            <a href="<?php echo U('Appslist/appList');?>" target="_self" class="active">
                                                <i class="iconfont icon-myapp fa-lg"></i><span>我的应用</span>
                                            </a>
                                        </li>
                                        <?php if(MODULE_NAME == 'Index'): ?><li class="active weiyi"><?php else: ?> <li class=" weiyi"><?php endif; ?>
                                            <a href="<?php echo U('Index/userList');?>" target="_self" class="">
                                                <i class="iconfont icon-contacts fa-lg"></i><span>通讯录</span>
                                            </a>
                                        </li>
                                        <?php if(MODULE_NAME == 'Organic'): ?><li class="active weiyi"><?php else: ?> <li class=" weiyi"><?php endif; ?>
                                            <a href="<?php echo U('Organic/index');?>" target="_self" class="">
                                                <i class="iconfont icon-org fa-lg"></i><span>组织架构</span>
                                            </a>
                                        </li>
                                       <?php if(MODULE_NAME == 'Msg'): ?><li class="active weiyi"><?php else: ?> <li class=" weiyi"><?php endif; ?>
                                            <a href="<?php echo U('Msg/appMsg');?>" target="_self" class="">
                                                <i class="iconfont icon-groupsend fa-lg"></i><span>群发消息</span>
                                            </a>
                                        </li>
										<?php if($_SESSION['node_id'] == ''): if(MODULE_NAME == 'Showadmin'): ?><li class="active weiyi"><?php else: ?> <li class=" weiyi"><?php endif; ?>
                                            <a href="<?php echo U('Showadmin/Group');?>" target="_self" class="">
                                                <i class="iconfont icon-permission fa-lg"></i><span>权限管理</span>
                                            </a>
                                        </li><?php endif; ?>									
                                    </ul>
                                </nav>
                            </div><div class="slimScrollBar" style="width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 0px; height: 564px; background: rgb(51, 51, 51);"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 0px; background: rgb(51, 51, 51);"></div></div>
                        </section>
                    </section>
                </aside>
                <section id="content">
                    <section class="vbox">
	<link href="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./Tpl/Qyapp/Static/Css/animate.min.css" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/font-awesome.min.css" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/style.min.css" rel="stylesheet">
	<script src="./Tpl/Qyapp/Static/Js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/js/bootstrap.min.js"></script>	
<script>
function a(){
    $('#upload').hide();
	$('#ok').show();
      }
function yjj(){

     if($('.Free').has("#zzx").size() ==0){
	      $('#upload').hide();
	      $('#ok').show();
	 }else{
	 var dx=new Date().getTime();
	 $('#tishi').html('正在安装<span style="font-weight:bold">'+$('.Free').has("#zzx").first().children('#xxx').first().text()+'</span>请您耐心等待!');
    var x=$('.Free').has("#zzx").first().attr('href').split("=");
	
				 var xx=x[4];
				 x.length=0;
				 $.ajax({
					url:'/index.php?g=Yi&m=Appstore&a=install_d&appid='+xx,
					success:function(){
					var wx=new Date().getTime();
					   if((wx-dx)>30000){
					      $('#tishi').html('<span style="font-weight:bold">'+$('.Free').has("#zzx").first().children('#xxx').first().text()+'</span>没有安装成功，自动进行下一个安装');
					   }
					   $('.Free').has("#zzx").first().children('#zzx').first().attr('id','yza');
					   setTimeout('yjj()',2000);
					 }
				   });
				 }
}	  

$(document).ready(function(){
	$(".Box_top").hover(function(){
		$(this).find(".img").stop().show(300);
	},function(){
		$(this).find(".img").stop().hide(300);
	});
	$(".Free").show();
	$(".Charge").hide();
	$("#Charge").click(function(){
		$(".Free").hide();
		$(".Charge").show();
	});
	$("#Free").click(function(){
		$(".Free").show();
		$(".Charge").hide();
	});

	$('#anzhuang').click(function(){
		$('.progressBox').css('display','block');
		$('.bg').css('display','block');
		yjj();
	});

	$("#ok a").click(function(){
		$(".progressBox").hide();
	});

});
$(document).ready(function(){
	$("#xiezai").click(function(){
		$('.progressBox').css('display','block');
		$('.bg').css('display','block');
		$('#tishi').html('正在卸载应用，请耐心等待');
		typeID = $('.a_img').attr('typeID');
		$.post("/index.php?g=System&m=Xiezai&a=index",{typeID:typeID},function(data){
			$('#bottom').html(data);
			$('#upload').hide();
			$('#ok').show();
		});
	});
});
</script>
<style>.bg{width:100%;height:100%;position:fixed;background-color: rgba(0, 0, 0, 0.5);z-index:888;display:none;}.progressBox{position:fixed;left:200px;background-color:rgba(0,0,0,0.5);top:100px;width:600px;height:300px;z-index:999;display:none;text-overflow: ellipsis;white-space: nowrap;color:#fff;}#top{width:128px;height:128px;margin:20px auto;position:relative;}#bottom{width:auto;height:30px;line-height:30px;margin:0 auto;text-align:center;margin-top:100px;}#upload span{margin:10px auto;height:30px;line-height:30px;width:auto;display:block;text-align:center;}#ok a{display:block;width:100px;height:30px;padding:0 10px;line-height:30px;margin:10px auto;text-align:center;text-decoration:none;border: 1px #ccc solid;background: #eee;color:#333;}#ok a:hover{background:#999; color:#fff;}#upload{position:relative;margin:20px auto;}#ok{position:relative;display:none;margin:20px auto;}.update p b{color:#ff0000;margin:0 5px;}.update a.isub{width:73px;}.kjinfo span{font-family: inherit;font-size:13px;color: #5A5A5A;height:23px;line-height:23px;border-bottom:1px dashed #8eb0d0;display:block;padding-bottom:5px;height:auto;margin-bottom:10px;}.kjinfo span a{color:#ff0000;font-size:14px;padding-left:10px;}.kjinfo span a:hover{text-decoration:none;}.kjinfo span b{color:#333;font-size:14px;}::-webkit-scrollbar-track-piece { background-color: #f5f5f5; border-left: 1px solid #d2d2d2;}::-webkit-scrollbar { width: 8px; height: 13px;}::-webkit-scrollbar-thumb { background-color: #c2c2c2; background-clip: padding-box; border: 1px solid #979797; min-height: 28px;}::-webkit-scrollbar-thumb:hover { border: 1px solid #636363; background-color: #929292;}.update div p a{margin-right:10px;line-height:30px;height:30px;margin-top:10px;}.update div p a span{padding:0 10px 0 5px;color:#ff0000;}.key_install{ padding:5px 10px; border:1px solid #ddd; border-radius:3px;}</style>

<section class="vbox">
<header class="header bg-white b-b b-light">
<p>欢迎进入应用商店</p>
<button type="button" class="btn btn-primary key_install" id="anzhuang" style="margin-bottom:10px;">一键安装/升级</button>
<a class="text-muted pull-right m-t pointer" href="javascript:history.go(-1)" title="返回" data-toggle="back">
<i class="fa fa-reply"></i>
</a>
</header>	
    <section class="scrollable wrapper w-f">
        <section class="panel panel-default ">
            <div class="row m-l-none m-r-none bg-light lter">
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="app-item center js_entity_view" style="height:200px;" data-path="">
					   <a href="<?php echo U('appInfo',array('id'=>$vo['id'],type=>$vo['upstatus']));?>" class="Free">
					     <?php if($vo['upstatus'] == '1'): ?><div  id="yaz"></div> <?php else: ?><div id="zzx"></div><?php endif; ?>
						<?php if($vo['upstatus'] == '1'): ?><span class="installed" >已安装</span><?php endif; ?>
					   <?php if($vo['upstatus'] == '2'): ?><span class="installed" style="background: red;">请升级</span><?php endif; ?>
						<?php if($vo['upstatus'] == ''): ?><span class="installed"  style="background: blue;">未安装</span><?php endif; ?>
							 <img class="app-item-img" alt="<?php echo ($vo["name"]); ?>" src="<?php echo ($vo["icon"]); ?>">
                            <div class="app-item-name" style="margin-left:30px;" id="xxx"><?php echo ($vo["name"]); ?> </div> </a>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                       </div>
        </section>
    </section>
</section>
<div class="msgbox">
</div>
<div class="bg"></div>
<div class="progressBox">
	<div id="upload" >
		<div id="top" >
			<img src="./Tpl/Yi/Appstore/image/info.gif" /><br/>
		</div>
		<span id="tishi"></span>
	</div>
	<div id="ok" >
		<div id="bottom">
			全部应用已经安装成功！请点击关闭此页面
		</div>
		<a href="javascript:void()" onclick="javascript:location.reload()" >关闭</a>
	</div>
</div>
<div class="page"><?php echo ($page); ?></div>
				
                    </section>
                </section>
            </section>
        </section>
    </section>
    <div class="pageload-overlay" style="display: none;"></div>
    <div id="loading_done" style="display: none;"></div>

<!--feedback-->
<div class="modal fade in" id="feedback" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class=" icon-comment-alt"></i>反馈建议 </h4>
            </div>
            <form class="form-horizontal" target="_self" >
                <div class="modal-body" style="overflow: visible">
                    <div class="row-fluid">
                        <div id="pp">
                            <p>亲爱的用户</p>

                            <p class="bbottom">
                                欢迎您访问官方网站！我们很乐意分享您的感受，欢迎提出意见和建议，我们会认真对待您的反馈，感谢您的关注和支持，您的建议将帮助我们改进，为您提供更好的服务！</p>

                            <p><b>请留下您的宝贵意见和建议！（请填写）</b></p>

                            <textarea name="content" class="input-block-level" placeholder="输入文本..." rows="4" id="feedback-text"></textarea>

                            <p style="margin-top:10px">
                                您常用的电子邮箱是？（请填写）<span style="margin-left:20px">*请尽量填写，以便我们尽快回复您！</span></p>
                            <input type="text" placeholder="如：...@163.com" name="email" class="input-block-level" id="feedback-input">

                            <p style="margin-top:10px">请输入下图中的字符：</p>
                            <input type="text" name="code" maxlength="4" class="input-block-level" id="feedback-checkcode" style="width:160px;display: inline">
                            <img style="cursor: pointer;width:60px;height:30px;margin-top:-2px" onClick="this.src=&#39;/feedback/code?w=60&amp;h=30&amp;_t=&#39;+Math.random()" src="">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit_but" data-path="/feedback/index">提交
                    </button>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true" id="close_but">取消</button>
                </div>
            </form>
        </div>
    </div>
</div>



</body></html>