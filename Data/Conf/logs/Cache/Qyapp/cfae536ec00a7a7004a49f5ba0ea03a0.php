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
                            <a href="<?php echo U('Userinfo/upfile', array('token' => $token));?>"><i class="iconfont icon-binding m-r-xs icon-size20"></i>存储设置</a>
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
	<script src="./Tpl/Qyapp/Static/Js/artTemplate/dist/template.js" type="text/javascript"></script>
	<style>
	.icon-bg{background-color:#dbdbdb;}
	</style>
    <section class="hbox stretch"> 
<aside class="aside-md bg-white b-r" id="subNav">
<!-- 	<div class="wrapper b-b header"><b>名片</b></div>
	<ul class="nav">
		<li class="b-b b-light "><a href="<?php echo U('Card/index',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>名片设置</a></li>
        <li class="b-b b-light"><a href="<?php echo U('Card/tpl',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>模板设置</a></li>
        <li class="b-b b-light "><a href="<?php echo U('Card/cardManage',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>名片管理</a></li>
		<li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
            <li class="b-b b-light">
                <a href="<?php echo U('Appmsg/conf',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
            </li>
    </ul> -->
	
	<div class="wrapper b-b header"><b>名片</b></div>
	<ul class="nav">
		<li class="b-b b-light "><a href="<?php echo U('Card/index',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>名片设置</a></li>
        <li class="b-b b-light"><a href="<?php echo U('Card/tpl',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>模板设置</a></li>
        <li class="b-b b-light "><a href="<?php echo U('Card/cardManage',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>名片管理</a></li>
		<li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
            <li class="b-b b-light">
                <a href="<?php echo U('Appmsg/conf',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
            </li>
    </ul>

</aside> 
    <aside>
	<section class="vbox">
    <header class="header bg-white b-b b-light">
        <p>名片设置</p>
        <a class="text-muted pull-right m-t pointer" data-toggle="back" href="javascript:history.go(-1)" title="返回"><i class="fa fa-reply"></i></a>
    </header>
    <section class="scrollable  wrapper">
        <section class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal form-validate" method="post"  target="_self" action="<?php echo U('Card/index',array('mid'=>$_GET['mid']));?>">
                    <div class="form-group">
					    <div class="col-sm-7">
                                    <label class="checkbox-block" data-toggle="refresh">
                                        <b class="" style="font-size:16px">设置名片信息</b>
                                    </label>												
                        </div> 
                    </div>	
              <div class="form-group">					
              <div class="col-md-12 col-sm-12">
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                         个人信息
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in somename">
                        <div class="panel-body">	
							<div class="form-group">
                                <div class="col-sm-1 control-label">
								    <label class="checkbox-inline"><input type="checkbox" name="chinaname[status]" <?php if($geren_default['chinaname']['status'] =='on'): ?>checked<?php endif; ?> ></label> 
                                    <input type="hidden" class="form-control" name="chinaname[name]" value="中文姓名" data-rule-required="true" placeholder="自定义信息"/>
                                </div>							
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" >显示图标&nbsp;<i class="fa fa-user"></i><input type="hidden" class="form-control" name="chinaname[icon]" value="fa fa-user"/></button>
									
                                </div>
                                <div class="col-sm-2">
								    <label class="checkbox-inline">中文姓名</label> 
                                </div>								
<!--                                 <div class="col-sm-2">
								    <label class="checkbox-inline"><input type="checkbox" name="chinaname[status]" <?php if($geren_default['chinaname']['status'] =='on'): ?>checked<?php endif; ?> >中文姓名</label> 
                                    <input type="hidden" class="form-control" name="chinaname[name]" value="中文姓名" data-rule-required="true" placeholder="自定义信息"/>
                                </div> -->								
                            </div>

							<div class="line line-dashed line-lg pull-in"></div>
							<div class="form-group">
                                <div class="col-sm-1 control-label">
								    <label class="checkbox-inline"><input type="checkbox" name="englishname[status]" <?php if($geren_default['englishname']['status'] =='on'): ?>checked<?php endif; ?> ></label> 
                                    <input type="hidden" class="form-control" name="englishname[name]" value="英文名" data-rule-required="true" placeholder="自定义信息"/>
                                </div>							
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm">显示图标&nbsp;<i class="fa fa-female"></i><input type="hidden" class="form-control" name="englishname[icon]" value="fa fa-user"/></button>
									
                                </div>
                                <div class="col-sm-2">
								    <label class="checkbox-inline">英文名</label> 
                                </div>								
<!--                                 <div class="col-sm-2">
								    <label class="checkbox-inline"><input type="checkbox" <?php if($geren_default['englishname']['status'] =='on'): ?>checked<?php endif; ?> name="englishname[status]">英文名</label>
                                    <input type="hidden" class="form-control" name="englishname[name]" value="英文名" data-rule-required="true" placeholder="自定义信息"/>
                                </div> -->
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>
                            <div id="js_custom_personal">
							
                            </div>
						
                            <script type="text/html" id="js_custom_personal_tem">
                            <div class="form-group" data-num="{{m}}">
								<div class="col-sm-1 control-label">
                                    <label class="checkbox-inline"><input type="checkbox" name="personal[{{m}}][status]"></label>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" id="personal_{{m}}" onclick="selectIcon('personal_{{m}}')" >选择图标&nbsp;<i class="fa fa-flag"></i><input type="hidden" class="form-control" name="personal[{{m}}][icon]"/></button>
									
                                </div>								
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="personal[{{m}}][name]" data-rule-required="true" placeholder="自定义信息"/>
                                </div>

                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" onclick="delPersonal($(this))">删除</button>
                                </div>
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>
                            </script>
							
                            <script type="text/html" id="js_custom_personal_tem_1">
							{{each list as value i}}
                            <div class="form-group" data-num="{{i}}">
								<div class="col-sm-1 control-label">
                                    <label class="checkbox-inline"><input type="checkbox" {{if value.status == 1}}checked{{/if}} name="personal[{{i}}][status]"></label>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" id="personal_{{i}}" onclick="selectIcon('personal_{{i}}')">选择图标&nbsp;
									{{if value.icon}}<i class="{{value['icon']}}"></i>{{else}}<i class="fa fa-flag"></i>{{/if}}
									<input type="hidden" class="form-control" name="personal[{{i}}][icon]" value="{{value['icon']}}"/>
									</button>
									
                                </div>								
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="personal[{{i}}][name]" value="{{value['name']}}" data-rule-required="true" placeholder="自定义信息"/>
                                </div>

                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" onclick="delPersonal($(this))">删除</button>
                                </div>
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>							
							{{/each}}							
                            </script>						
						
						
                        <div class="form-group">
                            <div class="col-sm-2 col-sm-offset-2">
                                <button type="button" class="btn btn-default js_addfield btn-sm" onclick="addPersonal()">自定义添加</button>
                            </div>
                        </div>								
					</div>						
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                          联系方式
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse somephone">
                         <div class="panel-body">	
							<div class="form-group">
                                <div class="col-sm-1 control-label">
								    <label class="checkbox-inline"><input type="checkbox" name="mobile[status]" <?php if($shouji_default['mobile']['status'] =='on'): ?>checked<?php endif; ?> ></label> 
                                    <input type="hidden" class="form-control" name="mobile[name]" value="手机号码" data-rule-required="true" placeholder="自定义信息"/>
                                </div>							
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" >显示图标&nbsp;<i class="fa fa-flag"></i><input type="hidden" class="form-control" name="mobile[icon]" value="fa fa-user"/></button>
									
                                </div>
                                <div class="col-sm-2">
								    <label class="checkbox-inline">手机号码</label> 
                                </div>								
<!--                                 <div class="col-sm-2">
								    <label class="checkbox-inline"><input type="checkbox" name="mobile[status]" <?php if($shouji_default['mobile']['status'] =='on'): ?>checked<?php endif; ?> >手机号码</label> 
                                    <input type="hidden" class="form-control" name="mobile[name]" value="手机号码" data-rule-required="true" placeholder="自定义信息"/>
                                </div> -->
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>							
							<div class="form-group">
                                <div class="col-sm-1 control-label">
								    <label class="checkbox-inline"><input type="checkbox" name="telephone[status]" <?php if($shouji_default['telephone']['status'] =='on'): ?>checked<?php endif; ?> ></label> 
                                    <input type="hidden" class="form-control" name="telephone[name]" value="工作电话" data-rule-required="true" placeholder="自定义信息"/>
                                </div>							
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm">显示图标&nbsp;<i class="fa fa-mobile-phone"></i><input type="hidden" class="form-control"  name="telephone[icon]" value="fa fa-user"/></button>
									
                                </div>
                                <div class="col-sm-2">
								    <label class="checkbox-inline">工作电话</label> 
                                </div>							
<!--                                 <div class="col-sm-2">
								    <label class="checkbox-inline"><input type="checkbox" name="telephone[status]" <?php if($shouji_default['telephone']['status'] =='on'): ?>checked<?php endif; ?> >工作电话</label> 
                                    <input type="hidden" class="form-control" name="telephone[name]" value="工作电话" data-rule-required="true" placeholder="自定义信息"/>
                                </div> -->
                            </div>	
							<div class="line line-dashed line-lg pull-in"></div>							
							<div class="form-group">
                                <div class="col-sm-1 control-label">
								    <label class="checkbox-inline"><input type="checkbox" name="mail[status]" <?php if($shouji_default['mail']['status'] =='on'): ?>checked<?php endif; ?> ></label> 
                                    <input type="hidden" class="form-control" name="mail[name]" value="QQ邮箱" data-rule-required="true" placeholder="自定义信息"/>
                                </div>							
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm">显示图标&nbsp;<i class="fa fa-flag"></i><input type="hidden" class="form-control"  name="mail[icon]" value="fa fa-user"/></button>
									
                                </div>
                                <div class="col-sm-2">
								    <label class="checkbox-inline">QQ邮箱</label> 
                                </div>
								
<!--                                 <div class="col-sm-2">								
								    <label class="checkbox-inline"><input type="checkbox" name="mail[status]" <?php if($shouji_default['mail']['status'] =='on'): ?>checked<?php endif; ?> >QQ邮箱</label> 
                                    <input type="hidden" class="form-control" name="mail[name]" value="QQ邮箱" data-rule-required="true" placeholder="自定义信息"/>
                                </div> -->
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>							
							<div class="form-group">
                                <div class="col-sm-1 control-label">
								    <label class="checkbox-inline"><input type="checkbox" name="weixin[status]" <?php if($shouji_default['weixin']['status'] =='on'): ?>checked<?php endif; ?> ></label> 
                                    <input type="hidden" class="form-control" name="weixin[name]" value="微信号" data-rule-required="true" placeholder="自定义信息"/>
                                </div>							
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm">显示图标&nbsp;<i class="fa fa-flag"></i><input type="hidden" class="form-control" name="weixin[icon]" value="fa fa-user"/></button>
									
                                </div>
                                <div class="col-sm-2">
								    <label class="checkbox-inline">微信号</label> 
                                </div>							
<!--                                 <div class="col-sm-2">
								    <label class="checkbox-inline"><input type="checkbox" name="weixin[status]" <?php if($shouji_default['weixin']['status'] =='on'): ?>checked<?php endif; ?> >微信号</label> 
                                    <input type="hidden" class="form-control" name="weixin[name]" value="微信号" data-rule-required="true" placeholder="自定义信息"/>
                                </div> -->
                            </div>	
							<div class="line line-dashed line-lg pull-in"></div>							
                            <div id="js_custom_contact">
							
                            </div>
						
                            <script type="text/html" id="js_custom_contact_tem">
                            <div class="form-group" data-num="{{m}}">
								<div class="col-sm-1 control-label">
                                    <label class="checkbox-inline"><input type="checkbox" name="contact[{{m}}][status]"></label>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" id="contact_{{m}}" onclick="selectIcon('contact_{{m}}')">选择图标&nbsp;
									<i class="fa fa-flag"></i>
									<input type="hidden" class="form-control" name="contact[{{m}}][icon]"/></button>
									
                                </div>								
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="contact[{{m}}][name]" data-rule-required="true" placeholder="自定义信息"/>
                                </div>

                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" onclick="delContact($(this))">删除</button>
                                </div>
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>							
                            </script>
							
                            <script type="text/html" id="js_custom_contact_tem_1">
							{{each list as value i}}
                            <div class="form-group" data-num="{{i}}">
								<div class="col-sm-1 control-label">
                                    <label class="checkbox-inline"><input type="checkbox" name="contact[{{i}}][status]" {{if value.status == 1}}checked{{/if}} ></label>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" id="contact_{{i}}" onclick="selectIcon('contact_{{i}}')">选择图标&nbsp;
									{{if value.icon}}<i class="{{value['icon']}}"></i>{{else}}<i class="fa fa-flag"></i>{{/if}}
									</i><input type="hidden" class="form-control" name="contact[{{i}}][icon]" value="{{value['icon']}}"/></button>
									
                                </div>								
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="contact[{{i}}][name]" value="{{value['name']}}" data-rule-required="true" placeholder="自定义信息"/>
                                </div>

                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" onclick="delContact($(this))">删除</button>
                                </div>
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>							
							{{/each}}							
                            </script>							
						
						
                        <div class="form-group">
                            <div class="col-sm-2 col-sm-offset-2">
                                <button type="button" class="btn btn-default js_addfield btn-sm" onclick="addContact()">自定义添加</button>
                            </div>
                        </div>								
						
					        </div>
                  </div>
				  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                         公司信息
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse somegs">
                      <div class="panel-body">
					  
							<div class="form-group">
                                <div class="col-sm-1 control-label">
								    <label class="checkbox-inline"><input type="checkbox" name="companyname[status]" <?php if($gongshi_default['companyname']['status'] =='on'): ?>checked<?php endif; ?> ></label> 
                                    <input type="hidden" class="form-control" name="companyname[name]" value="公司名称" data-rule-required="true" placeholder="自定义信息"/>
                                </div>							
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm">显示图标&nbsp;<i class="fa fa-flag"></i><input type="hidden" class="form-control"  name="companyname[icon]" value="fa fa-user"/></button>
									
                                </div>
                                <div class="col-sm-2">
								    <label class="checkbox-inline">公司名称</label> 
                                </div>							
<!--                                 <div class="col-sm-2">
								    <label class="checkbox-inline"><input type="checkbox" name="companyname[status]" <?php if($gongshi_default['companyname']['status'] =='on'): ?>checked<?php endif; ?> >公司名称</label> 
                                    <input type="hidden" class="form-control" name="companyname[name]" value="公司名称" data-rule-required="true" placeholder="自定义信息"/>
                                </div> -->
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>							
							<div class="form-group">
                                <div class="col-sm-1 control-label">
								    <label class="checkbox-inline"><input type="checkbox" name="companyaddress[status]" <?php if($gongshi_default['companyaddress']['status'] =='on'): ?>checked<?php endif; ?> ></label> 
                                    <input type="hidden" class="form-control" name="companyaddress[name]" value="公司地址" data-rule-required="true" placeholder="自定义信息"/>
                                </div>							
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm">选择图标&nbsp;<i class="fa fa-flag"></i><input type="hidden" class="form-control" name="companyaddress[icon]" value="fa fa-user"/></button>
									
                                </div>
                                <div class="col-sm-2">
								    <label class="checkbox-inline">公司地址</label> 
                                </div>							
<!--                                 <div class="col-sm-2">
								    <label class="checkbox-inline"><input type="checkbox" name="companyaddress[status]" <?php if($gongshi_default['companyaddress']['status'] =='on'): ?>checked<?php endif; ?> >公司地址</label> 
                                    <input type="hidden" class="form-control" name="companyaddress[name]" value="公司地址" data-rule-required="true" placeholder="自定义信息"/>
                                </div> -->
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>							
					  
                            <div id="js_custom_company">
						
                            </div>
						
                            <script type="text/html" id="js_custom_company_tem">
                            <div class="form-group" data-num="{{m}}">
								<div class="col-sm-1 control-label">
                                    <label class="checkbox-inline"><input type="checkbox" name="company[{{m}}][status]"></label>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" id="company_{{m}}" onclick="selectIcon('company_{{m}}')">选择图标&nbsp;
									<i class="fa fa-flag"></i>
									<input type="hidden" class="form-control" name="company[{{m}}][icon]"/></button>
									
                                </div>								
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="company[{{m}}][name]" data-rule-required="true" placeholder="自定义信息"/>
                                </div>

                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" onclick="delCompany($(this))">删除</button>
                                </div>
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>							
                            </script>
							
                            <script type="text/html" id="js_custom_company_tem_1">
							{{each list as value i}}
                            <div class="form-group" data-num="{{i}}">
								<div class="col-sm-1 control-label">
                                    <label class="checkbox-inline"><input type="checkbox" name="company[{{m}}][status]" {{if value.status == 1}}checked{{/if}} ></label>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" id="company_{{i}}" onclick="selectIcon('company_{{i}}')">选择图标&nbsp;
									{{if value.icon}}<i class="{{value['icon']}}"></i>{{else}}<i class="fa fa-flag"></i>{{/if}}
									<input type="hidden" class="form-control" name="company[{{i}}][icon]" value="{{value['icon']}}"/></button>
									
                                </div>								
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="company[{{i}}][name]" value="{{value['name']}}" data-rule-required="true" placeholder="自定义信息"/>
                                </div>

                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" onclick="delCompany($(this))">删除</button>
                                </div>
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>							
							{{/each}}							
                            </script>							
						
                        <div class="form-group">
                            <div class="col-sm-2 col-sm-offset-2">
                                <button type="button" class="btn btn-default js_addfield btn-sm" onclick="addCompany()">自定义添加</button>
                            </div>
                        </div>								
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                         其他信息
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse mysome"> 
                      <div class="panel-body">
							
                        <div id="js_custom_other">
                        </div>
						
						<script type="text/html" id="js_custom_other_tem">
						<div class="form-group" data-num="{{m}}">
							<div class="col-sm-1 control-label">
								<label class="checkbox-inline"><input type="checkbox" name="other[{{m}}][status]"></label>
							</div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" id="other_{{m}}" onclick="selectIcon('other_{{m}}')">选择图标&nbsp;
									<i class="fa fa-flag"></i>
									<input type="hidden" class="form-control" name="other[{{m}}][icon]"/></button>
									
                                </div>							
							<div class="col-sm-2">
								<input type="text" class="form-control" name="other[{{m}}][name]" data-rule-required="true" placeholder="自定义信息"/>
							</div>

							<div class="col-sm-2">
								<button type="button" class="btn btn-default js_delfield btn-sm" onclick="delOther($(this))">删除</button>
							</div>
						</div>
						<div class="line line-dashed line-lg pull-in"></div>							
						</script>
						
						<script type="text/html" id="js_custom_other_tem_1">
						{{each list as value i}}
						<div class="form-group" data-num="{{i}}">
							<div class="col-sm-1 control-label">
								<label class="checkbox-inline"><input type="checkbox" name="other[{{i}}][status]" {{if value.status == 1}}checked{{/if}} ></label>
							</div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-default js_delfield btn-sm" id="other_{{i}}" onclick="selectIcon('other_{{i}}')">选择图标&nbsp;
									{{if value.icon}}<i class="{{value['icon']}}"></i>{{else}}<i class="fa fa-flag"></i>{{/if}}
									<input type="hidden" class="form-control" name="other[{{i}}][icon]" value="{{value['icon']}}"/></button>
									
                                </div>							
							<div class="col-sm-2">
								<input type="text" class="form-control" name="other[{{i}}][name]" value="{{value['name']}}" data-rule-required="true" placeholder="自定义信息"/>
							</div>

							<div class="col-sm-2">
								<button type="button" class="btn btn-default js_delfield btn-sm" onclick="delOther($(this))">删除</button>
							</div>
						</div>
						<div class="line line-dashed line-lg pull-in"></div>							
						{{/each}}							
						</script>						
						
                        <div class="form-group">
                            <div class="col-sm-2 col-sm-offset-2">
                                <button type="button" class="btn btn-default js_addfield btn-sm" onclick="addOther()">自定义添加</button>
                            </div>
                        </div>							
						
                      </div>
                    </div>
                  </div>				  
                </div>
              </div> 						
			</div>			
					<div class="form-group">
					<div class="col-sm-4 col-sm-offset-2">
				    <button type="submit" class="btn btn-primary" data-alert="true"  data-loading-text="保存中...">保存</button>
                    <button type="submit" data-toggle="method" data-method="release" class="btn btn-default" data-confirm="false" data-loading-text="保存中...">取消
                    </button>					
					</div>
					</div>					
					
                </form>
            </div>
        </section>
    </section>
</section>
        </aside>
    </section> 

<link href="./Tpl/assets/global/css/gfonts1.css?v=<?php echo time();?>" rel="stylesheet" type="text/css" />
<link href="./Tpl/assets/global/plugins/font-awesome/css/font-awesome.css?v=<?php echo time();?>" rel="stylesheet" type="text/css" />
<link href="./Tpl/assets/global/plugins/simple-line-icons/simple-line-icons.min.css?v=<?php echo time();?>" rel="stylesheet" type="text/css" />
<div class="modal fade in" id="js_type_modal" tabindex="-2" role="dialog" aria-labelledby="myModelLabel" aria-hidden="true">
<!-- <form class="form-horizontal form-validate form-modal" action="" method="post"> --> 
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="form-horizontal form-validate form-modal" >            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">设置名片信息图标</h4>
            </div>

            <div class="modal-body">
				   <div class="row" id="iconlist">
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-automobile"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bank"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-behance"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-behance-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bomb"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-building"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-cab"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-car"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-child"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-circle-o-notch"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-circle-thin"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-codepen"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-cube"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-cubes"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-database"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-delicious"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-deviantart"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-digg"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-drupal"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-empire"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-envelope-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-fax"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-archive-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-audio-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-code-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-excel-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-image-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-movie-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-pdf-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-photo-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-picture-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-powerpoint-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-sound-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-video-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-word-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-zip-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-ge"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-git"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-git-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-google"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-graduation-cap"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-hacker-news"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-header"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-history"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-institution"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-joomla"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-jsfiddle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-language"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-life-bouy"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-life-ring"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-life-saver"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-mortar-board"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-openid"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-paper-plane"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-paper-plane-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-paragraph"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-paw"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-pied-piper"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-pied-piper-alt"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-pied-piper-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-qq"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-ra"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-rebel"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-recycle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-reddit"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-reddit-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-send"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-send-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-share-alt"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-share-alt-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-slack"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sliders"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-soundcloud"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-space-shuttle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-spoon"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-spotify"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-steam"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-steam-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-stumbleupon"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-stumbleupon-circle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-support"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-taxi"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-tencent-weibo"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-tree"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-university"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-vine"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-wechat"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-weixin"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-wordpress"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-yahoo"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-adjust"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-anchor"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-archive"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrows"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrows-h"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrows-v"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-asterisk"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-ban"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bar-chart-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-barcode"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bars"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-beer"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bell"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bell-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bolt"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-book"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bookmark"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bookmark-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-briefcase"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bug"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-building-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bullhorn"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bullseye"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-calendar"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-calendar-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-camera"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-camera-retro"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-caret-square-o-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-caret-square-o-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-caret-square-o-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-caret-square-o-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-certificate"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-check"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-check-circle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-check-circle-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-check-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-check-square-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-circle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-circle-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-clock-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-cloud"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-cloud-download"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-cloud-upload"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-code"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-code-fork"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-coffee"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-cog"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-cogs"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-comment"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-comment-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-comments"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-comments-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-compass"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-credit-card"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-crop"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-crosshairs"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-cutlery"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-dashboard"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-desktop"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-dot-circle-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-download"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-edit"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-ellipsis-h"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-ellipsis-v"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-envelope"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-envelope-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-eraser"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-exchange"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-exclamation"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-exclamation-circle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-exclamation-triangle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-external-link"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-external-link-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-eye"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-eye-slash"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-female"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-fighter-jet"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-film"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-filter"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-fire"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-fire-extinguisher"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-flag"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-flag-checkered"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-flag-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-flash"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-flask"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-folder"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-folder-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-folder-open"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-folder-open-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-frown-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-gamepad"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-gavel"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-gear"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-gears"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-gift"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-glass"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-globe"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-group"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-hdd-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-headphones"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-heart"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-heart-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-home"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-image"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-inbox"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-info"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-info-circle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-key"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-keyboard-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-laptop"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-leaf"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-legal"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-lemon-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-level-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-level-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-lightbulb-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-location-arrow"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-lock"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-magic"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-magnet"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-mail-forward"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-mail-reply"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-mail-reply-all"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-male"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-map-marker"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-meh-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-microphone"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-microphone-slash"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-minus"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-minus-circle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-minus-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-minus-square-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-mobile"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-mobile-phone"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-money"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-moon-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-music"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-navicon"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-pencil"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-pencil-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-pencil-square-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-phone"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-phone-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-photo"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-picture-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-plane"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-plus"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-plus-circle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-plus-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-plus-square-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-power-off"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-print"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-puzzle-piece"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-qrcode"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-question"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-question-circle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-quote-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-quote-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-random"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-refresh"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-reorder"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-reply"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-reply-all"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-retweet"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-road"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-rocket"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-rss"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-rss-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-search"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-search-minus"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-search-plus"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-share"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-share-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-share-square-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-shield"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-shopping-cart"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sign-in"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sign-out"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-signal"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sitemap"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-smile-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sort"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sort-alpha-asc"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sort-alpha-desc"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sort-amount-asc"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sort-amount-desc"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sort-asc"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sort-desc"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sort-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sort-numeric-asc"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sort-numeric-desc"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sort-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-spinner"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-square-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-star"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-star-half"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-star-half-empty"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-star-half-full"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-star-half-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-star-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-suitcase"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-sun-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-tablet"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-tachometer"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-tag"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-tags"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-tasks"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-terminal"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-thumb-tack"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-thumbs-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-thumbs-o-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-thumbs-o-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-thumbs-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-ticket"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-times"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-times-circle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-times-circle-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-tint"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-toggle-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-toggle-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-toggle-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-toggle-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-trash-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-trophy"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-truck"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-umbrella"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-unlock"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-unlock-alt"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-unsorted"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-upload"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-user"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-users"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-video-camera"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-volume-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-volume-off"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-volume-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-warning"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-wheelchair"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-wrench"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-text"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-file-text-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-align-center"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-align-justify"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-align-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-align-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bold"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-chain"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-chain-broken"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-clipboard"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-columns"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-copy"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-cut"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-dedent"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-files-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-floppy-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-font"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-indent"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-italic"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-link"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-list"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-list-alt"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-list-ol"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-list-ul"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-outdent"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-paperclip"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-paste"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-repeat"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-rotate-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-rotate-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-save"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-scissors"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-strikethrough"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-subscript"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-superscript"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-table"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-text-height"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-text-width"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-th"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-th-large"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-th-list"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-underline"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-undo"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-unlink"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-angle-double-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-angle-double-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-angle-double-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-angle-double-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-angle-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-angle-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-angle-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-angle-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrow-circle-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrow-circle-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrow-circle-o-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrow-circle-o-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrow-circle-o-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrow-circle-o-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrow-circle-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrow-circle-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrow-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrow-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrow-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrow-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrows-alt"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-caret-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-caret-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-caret-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-caret-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-chevron-circle-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-chevron-circle-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-chevron-circle-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-chevron-circle-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-chevron-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-chevron-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-chevron-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-chevron-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-hand-o-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-hand-o-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-hand-o-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-hand-o-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-long-arrow-down"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-long-arrow-left"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-long-arrow-right"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-long-arrow-up"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-adn"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-android"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-apple"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bitbucket"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bitbucket-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bitcoin"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-btc"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-css3"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-dribbble"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-dropbox"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-facebook"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-facebook-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-flickr"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-foursquare"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-github"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-github-alt"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-github-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-gittip"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-google-plus"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-google-plus-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-html5"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-instagram"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-linkedin"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-linkedin-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-linux"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-maxcdn"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-pagelines"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-pinterest"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-pinterest-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-renren"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-skype"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-stack-exchange"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-stack-overflow"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-trello"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-tumblr"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-tumblr-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-twitter"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-twitter-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-vimeo-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-vk"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-weibo"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-windows"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-xing"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-xing-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-youtube"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-youtube-play"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-youtube-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-ambulance"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-h-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-hospital-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-medkit"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-stethoscope"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-user-md"></i></a></div>						
				   </div>
				   <div class="row" id="myicon" dataId=""><i class=""></i></div>				   
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-primary" id="submit" name="submit"  >确认</button> -->
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">取消</button> -->
            </div>
            </div>        </div>
    </div>
	<!-- </form> -->
</div>	
<script>
function getIcon(obj){
   var className = obj.children('i').attr('class');
   $('#iconlist div.col-sm-1').removeClass('icon-bg');
   obj.addClass('icon-bg');
   var getId = $('#myicon').attr('dataId');
   //alert(getId);return false;
   $('#'+getId).children('i').attr('class',className);
   $('#'+getId).children('input').attr('value',className);
   $('#js_type_modal').modal('hide');
}
function selectIcon(id){
    $('#js_type_modal').modal();
	$('#myicon').attr('dataId',id);
	var sIcon = $('#myicon').children('i').attr('class');
	$('#'+id).children('input').attr('value',sIcon);
	$('#'+id).children('i').attr('class',sIcon);				
}

</script>
<script>
var audit1 =<?php echo $geren_add;?>;
var data1 = {
	list:audit1,
};
var html1 = template('js_custom_personal_tem_1', data1);
$('#js_custom_personal').append(html1);

var audit2 =<?php echo $shouji_add;?>;
var data2 = {
	list:audit2,
};
var html2 = template('js_custom_contact_tem_1', data2);
$('#js_custom_contact').append(html2);

var audit3 =<?php echo $gongshi_add;?>;
var data3 = {
	list:audit3,
};
var html3 = template('js_custom_company_tem_1', data3);
$('#js_custom_company').append(html3);

var audit4 =<?php echo $newqita_add;?>;
var data4 = {
	list:audit4,
};
var html4 = template('js_custom_other_tem_1', data4);
$('#js_custom_other').append(html4);
var i = $('#js_custom_personal').find('.form-group').length;	
var j = $('#js_custom_company').find('.form-group').length;	
var r = $('#js_custom_contact').find('.form-group').length;	
var s = $('#js_custom_other').find('.form-group').length;	
function addPersonal(){
	var m = i++;
	var data = {
	m: m,
	};	
	var html = template('js_custom_personal_tem', data);
	$('#js_custom_personal').append(html);
}
function addCompany(){
	var m = j++;
	var data = {
	m: m,
	};	
	var html = template('js_custom_company_tem', data);
	$('#js_custom_company').append(html);
}
function addContact(){
	var m = r++;
	var data = {
	m: m,
	};	
	var html = template('js_custom_contact_tem', data);
	$('#js_custom_contact').append(html);
}
function addOther(){
	var m = s++;
	var data = {
	m: m,
	};	
	var html = template('js_custom_other_tem', data);
	$('#js_custom_other').append(html);
}						 
function delPersonal(obj){
	obj.parent().parent().remove();
}
function delCompany(obj){
	obj.parent().parent().remove();
}	
function delContact(obj){
	obj.parent().parent().remove();
}	
function delOther(obj){
	obj.parent().parent().remove();
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



</body></html>a fa-soundcloud"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-space-shuttle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-spoon"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-spotify"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-steam"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-steam-square"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-stumbleupon"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-stumbleupon-circle"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-support"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-taxi"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-tencent-weibo"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-tree"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-university"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-vine"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-wechat"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-weixin"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-wordpress"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-yahoo"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-adjust"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-anchor"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-archive"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrows"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrows-h"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-arrows-v"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-asterisk"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-ban"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bar-chart-o"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-barcode"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bars"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-beer"></i></a></div>
						<div class="col-sm-1" style="height:20px;"><a href="javascript:;" target="_self" onclick="getIcon($(this))"><i class="fa fa-bell"></i>