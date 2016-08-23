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
                            <a  href="http://bbs.wxopen.cn" target="_self"><i class="iconfont icon-account m-r-xs icon-size20"></i>论坛交流</a>
                        </li>
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
<link href="./Tpl/Qyapp/Static/Js/jstree/3.0.2/themes/default/style.min.css" rel="stylesheet">	
<script src="./Tpl/Qyapp/Index/index/artDialog/jquery.artDialog.js?skin=default"></script>
<script src="./Tpl/Qyapp/Index/index/artDialog/plugins/iframeTools.js"></script>
<script src="./Tpl/Qyapp/Static/Js/jstree/3.0.2/jstree.min.js"></script>
 <script>
$(document).ready(function(){ 
	$('#btn-group-a').click(function(){
		$('#btn-group-b').slideToggle();				
	});
});
$(function(){
  $(".tile").click(function() {
	var id=$(this).attr('fileid');
	$('.fileid').val(id);
	$('.video_unit').removeClass('choose');
	$(".select_"+id).addClass('choose');
	var title=$(this).attr('title');
	$('.title').html(title);
  });
})

</script> 
  <script>

$(document).ready(function(){ 
	$(".sent_file").click(function() {
		var departid=$("#departId").val();
		var fileid = $('.fileid').val();
		var subdata='type=voice&fileid='+fileid+'&agentid=<?php echo $_GET['id'];?>&departid='+departid;
		//alert(subdata);//return false;
		$.ajax({
				type: "post",  
				url:"<?php echo U('Msg/post');?>",
				dataType:'json',
				data:subdata,
				success:function(json){
					var status = json.status;
					if(status==1){
						alert('群发成功');
						window.location.reload();
					}else{
						alert('群发失败');
					}
				}
			});
	
  });
});

</script>  	
</head>
<body>
<link href="./Tpl/Qyapp/Index/index/message.min.css" rel="stylesheet">
<section class="hbox stretch" ng-controller="MsgController">
    <aside class="bg-white">
        <header class="header bg-white b-b b-light">
            <p>
                群发新消息 <small><?php echo ($appinfo["name"]); ?></small>
            </p>
            <div class="thumb-sm">
                <img src="<?php echo ($appinfo["logo"]); ?>" class="img-circle">

            </div>
        </header>
        <div class="padder  b-b">
            <div class="m-t-xs m-b-xs">
                <span class="message_send_to_text dropdown-toggle" >发送给：</span>
				
                <div class="message_send_to_group">
                    <!-- <input onclick="addLink('depart')"  id="depart" type="text" class="form-control js_send_form"  name="return" placeholder="+请选择部门" /> -->
       <input onclick="openModel()" id="depart" type="text" class="form-control js_send_form" name="return" placeholder="+请选择部门" /> 
					<input  id="usertype" type="hidden"  name="usertype"  />
					<input  id="users" type="hidden"  name="users"  />
					<input  id="departId" type="hidden"  name="departid"  value=""/>	
				</div>
            </div>
        </div>
		
		
<section class="vbox ">



		<header class="header bg-light">

			<ul class="nav nav-tabs nav-white js_message_filetype">
				<li><a href="<?php echo U('group_post',array('id'=>$_GET['id']));?>" target="_self">文字</a></li>
				<li><a href="<?php echo U('image_post',array('id'=>$_GET['id']));?>"  target="_self">图片</a></li>
				<li class="active"><a href="<?php echo U('voice_post',array('id'=>$_GET['id']));?>" target="_self">语音</a></li>
				<li><a href="<?php echo U('vidio_post',array('id'=>$_GET['id']));?>" target="_self">视频</a></li>
				<li><a href="<?php echo U('news_post',array('id'=>$_GET['id']));?>" target="_self">图文</a>
					 <ul class="dropdown-menu text-left" id="btn-group-b">
						<li><a href="<?php echo U('add_new',array('a_id'=>$_GET['id']));?>" target="_self" class="js_new_message">新建单图文消息</a></li>
						<li><a href="<?php echo U('add_news',array('a_id'=>$_GET['id']));?>" target="_self" class="js_new_message">新建多图文消息</a></li>
					</ul>
	             </li>
				<li  class="nav_select"><a href="<?php echo U('file_post',array('id'=>$_GET['id']));?>" target="_self">文件</a></li>
			</ul>
		</header>
			
			<section class="scrollable message_block">

				
				<form action="" method="post" enctype="multipart/form-data" target="_self"> 	
				<!--语音素材-->
				<style>
		.choose{ border:4px solid #4a90e2}
	  </style>
				 <div class="tab-pane  wrapper  video_items js_file_container file" id="file_container"> 
					 <ul class="js_items clearfix" style="position: relative; height: 0px; margin-left:0px;"> 
						 <?php if($list == ''): ?><div class="empty_placeholder_wrap empty_placeholder_voice">
						<span class="icon_empty_placeholder"></span>
						<p class="empty_placeholder_text">没有语音素材</p>
					</div><?php endif; ?> 
						 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li class="tile" fileid="<?php echo ($li["id"]); ?>" style="list-style:none; "> 
						   <div class="video_unit select_<?php echo ($li["id"]); ?> selected"  style="width:140px; margin-bottom:2px;">
							<!-- selected --> 
							<p class="video_title"><?php echo ($li["title"]); ?></p> 
							 <a class="video_image"  style="border: 0px;" href="javascript:;" target="_self"> 
								<img src="./Tpl/Qyapp/Msg/img/voice.png" />  </a> 
						   </div> </li><?php endforeach; endif; else: echo "" ;endif; ?> 
						</ul>
				</div>
				<!--语音素材end-->	
                
					
                </div>
            </section>
		
     <footer class="footer message_footer bg-white b-t js_footer ">
	 <p class="text-muted pull-left m-t">
	<button type="button" class="btn btn-primary js_message_send button_file sent_file " style=" float:left;" >群发消息</button>
   <input type="submit" class="btn btn-default js_new_message  button_music" style=" float:left; margin-left:10px;" name="submit" value="上传语音" /> 
   <input type="file" class="btn js_message_send button_file " style="width:200px; float:left; margin-left:10px;" name="file" id="file" /> 
   <input type="hidden" id="fileid" class="fileid" value=""/>
	</p>
		<p class="m-l">
</form>
			<label class="checkbox inline ">
			</label>
		</p>
	</footer>
	
	
</section>

</aside>
    <aside class="aside-xxl-sm bg-white b-l js_preview"><section class="vbox">
    <div class="wrapper b-b header text-center "><b>预览</b>
    </div>
    <div class="mc_content">
        <div class="mc_content_item item_left">
            <div class="mc_content_wrap clearfix">
                <input type="checkbox" class="checkbox mc_checkbox">
                <div class="mc_avatar_wrap">
                    <img src="<?php echo ($appinfo["logo"]); ?>" class="border_alpha">
                </div>
                <div class="  " style="width:250px; float:right; margin-right:70px;">
              <img src="./Tpl/Qyapp/Msg/img/vol.png" width=170px height=40px />
           </div>
            </div>
        </div>
    </div>
</section>
</aside>
</section>
<div class="msgbox"></div><ul class="vakata-context"></ul><div id="jstree-marker" style="display: none;">&nbsp;</div><div class="token-input-dropdown memberDialog_selectTree" style="display: none;"><div id="token-input-dropdown-hint" style="display: none;"></div><div id="token-input-dropdown-searching" style="display: none;"></div><div id="token-input-dropdown-result" style="display: none;"></div></div>
   <div id="myModal" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  </div>
 <script>
function openModel(){
    $('#depart').attr("value",'');
	$('#departId').attr("value",'');
	
	$('#myModal').load("/index.php?g=Qyapp&m=Tree&a=myTree", function(){
		 $('#myModal').modal();
	});	
}

function cancel(){
    $('#depart').attr("value",'');
	$('#departId').attr("value",'');
	$('#myModal').modal('hide');
    $('#myModal').empty();
}

function guanbi(){
    $('#myModal').modal('hide');
    $('#myModal').empty();
}
</script> 
				
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