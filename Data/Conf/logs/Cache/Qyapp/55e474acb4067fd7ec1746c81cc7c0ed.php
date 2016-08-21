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
<link href="./Tpl/Qyapp/Static/Js/jstree/3.0.2/themes/default/style.min.css" rel="stylesheet">	
<link href="./Tpl/Qyapp/Static/Js/bootstrap/switch/docs/css/highlight.css" rel="stylesheet">			
<link href="./Tpl/Qyapp/Static/Js/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./Tpl/Qyapp/Static/Js/clockpicker/dist/bootstrap-clockpicker.min.css">
<link rel="stylesheet" type="text/css" href="./Tpl/Qyapp/Static/Js/clockpicker/assets/github.min.css">		
<script src="./Tpl/Qyapp/Static/Js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/js/bootstrap.min.js"></script>		
<script src="./Tpl/Qyapp/Static/Js/artTemplate/dist/template.js" type="text/javascript"></script>	
<script src="./Tpl/Qyapp/Static/Js/bootstrap/switch/docs/js/highlight.js" type="text/javascript"></script>	
<script src="./Tpl/Qyapp/Static/Js/bootstrap/switch/dist/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="./Tpl/Qyapp/Static/Js/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="./Tpl/Qyapp/Static/Js/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="./Tpl/Qyapp/Static/Js/clockpicker/dist/bootstrap-clockpicker.min.js" type="text/javascript"></script>
    <section class="hbox stretch">
        <aside class="aside-md bg-white b-r" id="subNav">
<!--     <div class="wrapper b-b header"><b>会议室预定</b></div>
    <ul class="nav">
        <li class="b-b b-light">
        	<a href="<?php echo U('Meet/index',array('id'=>$_GET['id']));?>">
        		<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>会议室设置
        	</a>
        </li>	
        <li class="b-b b-light">
        	<a href="<?php echo U('Meet/lists',array('id'=>$_GET['id']));?>">
        		<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>会议室查询
        	</a>
        </li>
        <li class="b-b b-light ">
        	<a href="<?php echo U('Meet/manage',array('id'=>$_GET['id']));?>">
        		<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>会议室管理
        	</a>
        </li>
		<li class="b-b b-light ">
        	<a href="<?php echo U('Meet/config_man',array('id'=>$_GET['id']));?>">
        		<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>配置审核人
        	</a>
        </li> 
       <li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
            <li class="b-b b-light">
                <a href="<?php echo U('Appmsg/conf',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
            </li>        
    </ul> -->
		
    <div class="wrapper b-b header"><b>会议室预定</b></div>
    <ul class="nav">
        <li class="b-b b-light">
        	<a href="<?php echo U('Meet/index',array('mid'=>$_GET['mid']));?>" target="_self">
        		<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>会议室设置
        	</a>
        </li>	
        <li class="b-b b-light">
        	<a href="<?php echo U('Meet/lists',array('mid'=>$_GET['mid']));?>" target="_self">
        		<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>会议室查询
        	</a>
        </li>
        <li class="b-b b-light ">
        	<a href="<?php echo U('Meet/manage',array('mid'=>$_GET['mid']));?>" target="_self">
        		<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>会议室管理
        	</a>
        </li>
		<li class="b-b b-light ">
        	<a href="<?php echo U('Meet/config_man',array('mid'=>$_GET['mid']));?>" target="_self">
        		<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>配置审核人
        	</a>
        </li> 
       <li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
            <li class="b-b b-light">
                <a href="<?php echo U('Appmsg/conf',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
            </li>        
    </ul>

</aside>      

 <aside>
    <section class="vbox">
        <header class="header bg-white b-b b-light">
            <p>会议室设置修改</p>
            <a class="text-muted pull-right m-t pointer" data-toggle="back" title="返回" href="javascript:history.go(-1)"><i class="fa fa-reply"></i></a>
        </header>
        <section class="scrollable  wrapper">
            <section class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal form-validate" method="post" target="_self" action="<?php echo U('Meet/config_man',array('mid'=>$_GET['mid']));?>">

						<div class="form-group">
							<label class="col-sm-2 control-label">是否开启摇一摇功能</label>
							<div class="col-sm-7">
								<ul class="list-unstyled list-inline img-temp">
								    <li class="m-t-xs active">
										<label class="radio-block" data-toggle="refresh">
										<input type="radio" name="wave" value="1" <?php if($info['wave'] == 1): ?>checked="checked"<?php endif; ?> >
										是
										</label>
									</li>
									<li class="m-t-xs">
										<label class="checkbox-block" data-toggle="refresh">
										<input type="radio" name="wave" value="0" <?php if($info['wave'] == 0): ?>checked="checked"<?php endif; ?> >
										否
										</label>
									</li>
								</ul>
							</div>
						</div>					

                        <div class="line line-dashed line-lg pull-in"></div>
						
						<div class="form-group js_standard">
							<label class="col-sm-2 control-label">会议室预定时间段</label>	
							<div class="col-sm-1 btn-s-lg" id="onworks">
								<div class="input-group" data-toggle="clockpicker"  readonly="readonly" >
									<input type="text" class="form-control" name="start_time" value="<?php echo ($info['start_time']); ?>">
									<span class="input-group-addon " disabled>
										<i class="fa fa-clock-o"></i>
									</span>
								</div>
							</div>
							<script type="text/javascript">
								$('#onworks').clockpicker();
							</script>	
							<div class="col-sm-1"><p class="form-control-static"></p></div>
							<div class="col-sm-1 "><p class="form-control-static">-</p></div> 						
							<div class="col-sm-1 btn-s-lg " id="offworks">
								 <div class="input-group" data-toggle="clockpicker" readonly="readonly">
									<input type="text" class="form-control" name="end_time" value="<?php echo ($info['end_time']); ?>" >
									<span class="input-group-addon " >
										<i class="fa fa-clock-o"></i>
									</span>
								</div>
							</div>
							<script type="text/javascript">
								$('#offworks').clockpicker();
							</script>							
						</div>						
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">设置可提前预定天数</label>
						<div class="col-sm-1 btn-s-lg">
							<select name="advance[type]" class="form-control set-select" onchange="expSelect()">
								<option  value="0" <?php if($advance['type'] == 0): ?>selected="selected"<?php endif; ?> >按分钟</option>
								<option value="1" <?php if($advance['type'] == 1): ?>selected="selected"<?php endif; ?> >按小时</option>
								<option <?php if($advance['type'] == 2): ?>selected="selected"<?php endif; ?> value="2">按天</option>
							</select>
						</div>
						<div class="col-sm-3 set-div-show" id="exphide2">
							<div class="col-sm-1 btn-s-lg ">
								 <div class="input-group" >
									<input type="text" class="form-control" name="advance[time]" value="<?php echo ($advance['time']); ?>" >
									<!-- <span class="input-group-addon " id="unit">天</span> -->
									<?php if($advance['type'] == 0): ?><span class="input-group-addon " id="unit">分钟</span><?php endif; ?>
									<?php if($advance['type'] == 1): ?><span class="input-group-addon " id="unit">小时</span><?php endif; ?>
									<?php if($advance['type'] == 2): ?><span class="input-group-addon " id="unit">天</span><?php endif; ?>
								</div>
							</div>
						</div>												
					</div>
						
						
					<div class="line line-dashed line-lg pull-in"></div>														
					<div class="form-group">
						<label class="col-sm-2 control-label">不可预订配置</label>
						<div class="col-sm-8 col-sm-offset-2">
							<button class="btn btn-default js_addaudit btn-sm" onclick="addRoom()" type="button">添加</button>
						</div>
					</div>
					<div class="form-group" id="adddate">
                <section class="scrollable wrapper w-f">
                    <section class="panel panel-default ">
                        <div class="table-responsive">
                            <table class="table m-b-none entity-view text-center">
								<colgroup>
								<col style="width:20%">
								<col style="width:35%">
								<col style="width:35%">
								<col style="width:10%">								
								</colgroup>                                
								<thead>
                                    <tr>
                                        <th class="text-left">会议室</th>
                                        <th class="text-left">日期</th>
										<th class="text-left">时间</th>
										<th class="text-left">操作</th>
                                    </tr>
                                </thead>
                                <tbody id="mytbody">
	
                                </tbody>

								<script type="text/html" id="js_room_edit">
							    {{each rule as value i}} 								
								<tr  data-num="{{i}}">
								
									<td>	
										<div class="col-sm-1 btn-s-lg">
											<select name="ruleout[{{i}}][room]" class="form-control set-select">
												<option value="">选择会议室</option>	
												{{each room as val j}}												
												<option value="{{j}}" {{if j == value.room}}selected{{/if}} >{{val.name}}</option>	
							                    {{/each}}													
											</select>
										</div>																					
									</td>
									
									<td>
										<div class="col-sm-3">
										<div class="input-group">
										<a class="btn btn-default btn-sm " data-toggle="reportrange" data-change="submit" id="range_{{i}}">
										<i class="fa fa-calendar fa-lg"></i>
										<small>时间</small>
										<span>{{value.time}}</span> <b class="caret"></b>
										<input type="hidden" value="{{value.time}}" name="ruleout[{{i}}][time]" />
										</a>										
										</div>
										</div>									
									
									</td>
									<td >
										<div class="col-sm-1 btn-s-lg" id="start_{{i}}">
											<div class="input-group" data-toggle="clockpicker"  readonly="readonly" >
												<input type="text" class="form-control" name="ruleout[{{i}}][start]" value="{{value.start}}">
												<span class="input-group-addon " disabled>
													<i class="fa fa-clock-o"></i>
												</span>
											</div>
										</div>
										<div class="col-sm-1 "><p class="form-control-static">-</p></div>						
										<div class="col-sm-1 btn-s-lg " id="end_{{i}}">
											 <div class="input-group" data-toggle="clockpicker" readonly="readonly">
												<input type="text" class="form-control" name="ruleout[{{i}}][end]" value="{{value.end}}" >
												<span class="input-group-addon " >
													<i class="fa fa-clock-o"></i>
												</span>
											</div>
										</div>																
									</td>
									<td >
										<div class="col-sm-8 col-sm-offset-2">
											<button class="btn btn-default js_addaudit btn-sm" onclick="delRoom($(this))" type="button">删除</button>
										</div>											
									</td>
								</tr>
							    {{/each}}								
								</script>



								
								<script type="text/html" id="js_room_list">
								<tr  data-num="{{index}}">
								
									<td>	
										<div class="col-sm-1 btn-s-lg">
											<select name="ruleout[{{index}}][room]" class="form-control set-select">
												<option value="">选择会议室</option>
												{{each list as value i}}							
												<option value="{{i}}">{{value.name}}</option>
												{{/each}}							
											</select>
										</div>																					
									</td>
									
									<td>
										<div class="col-sm-3">
										<div class="input-group">
										<a class="btn btn-default btn-sm " data-toggle="reportrange" data-change="submit" id="range_{{index}}">
										<i class="fa fa-calendar fa-lg"></i>
										<small>时间</small>
										<span></span> <b class="caret"></b>
										<input type="hidden" value="" name="ruleout[{{index}}][time]" />
										</a>										
										</div>
										</div>									
									
									</td>
									<td >
										<div class="col-sm-1 btn-s-lg" id="start_{{index}}">
											<div class="input-group" data-toggle="clockpicker"  readonly="readonly" >
												<input type="text" class="form-control" name="ruleout[{{index}}][start]" value="09:30">
												<span class="input-group-addon " disabled>
													<i class="fa fa-clock-o"></i>
												</span>
											</div>
										</div>
										<div class="col-sm-1 "><p class="form-control-static">-</p></div>						
										<div class="col-sm-1 btn-s-lg " id="end_{{index}}">
											 <div class="input-group" data-toggle="clockpicker" readonly="readonly">
												<input type="text" class="form-control" name="ruleout[{{index}}][end]" value="09:30" >
												<span class="input-group-addon " >
													<i class="fa fa-clock-o"></i>
												</span>
											</div>
										</div>																
									</td>
									<td >
										<div class="col-sm-8 col-sm-offset-2">
											<button class="btn btn-default js_addaudit btn-sm" onclick="delRoom($(this))" type="button">删除</button>
										</div>											
									</td>
								</tr>
								</script>								
                            </table>
                        </div>
                    </section>
                </section>						
                        </div>						
	
                        <div class="line line-dashed line-lg pull-in"></div>								
                        <div class="form-group" style="height:200px">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary"  data-loading-text="保存中...">保存</button>
                                <button type="button" class="btn btn-default"  data-toggle="back" onclick="javascript:history.go(-1)">取消</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </section>
    </section>	
			
    </aside>
    </section>  

<section class="entity-panel hd" id="leaveInfo">
</section>
<script>
var jsdata =<?php echo $jsdata;?>;
var ruleout =<?php echo $ruleout;?>;
var len =<?php echo $count;?>;
//alert(ruleout);
var data0 = {
	room:jsdata, 
	rule:ruleout,
};	
var html = template('js_room_edit', data0);
$('#mytbody').append(html);
var cb =[];
var optionSet =[];
for(var i=0;i<len;i++){
	cb[i] = function(start, end, label) {
	    //console.log(start.toISOString(), end.toISOString(), label);
		$('#range_'+i+' span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
		$('#range_'+i+' input').val(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
	}
	optionSet[i] = {
		//startDate: moment(),
		//endDate: moment().month(),
		//showDropdowns: true,
		//showWeekNumbers: true,
		//timePicker: true,
		//timePickerIncrement: 1,
		//timePicker12Hour: true,
		//ranges: {
		//	'今天': [moment(), moment()]
		//},
		//opens: 'right',
		buttonClasses: ['btn btn-default'],
		applyClass: 'btn-small btn-primary',
		cancelClass: 'btn-small',
		format: 'YYYY/MM/DD',
		separator: ' to ',
		locale: {
			applyLabel: '确定',
			cancelLabel: '取消',
			fromLabel: '开始时间',
			toLabel: '结束时间',
			customRangeLabel: '自定义',
			daysOfWeek: ['日', '一', '二', '三', '四', '五', '六'],
			monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
			firstDay: 1
		}
	};	
	//$('#range_'+i+' span').html(moment().format('YYYY/MM/DD') + ' - ' + moment().add('days', 30).format('YYYY/MM/DD'));
	//$('#range_'+i+' input').val(moment().format('YYYY/MM/DD') + ' - ' + moment().add('days', 30).format('YYYY/MM/DD'));
	$('#range_'+i).daterangepicker(optionSet[i], cb[i]);
	$('#start_'+i).clockpicker();
	$('#end_'+i).clockpicker();
}

var val1 = $('#mytbody').children(':last').attr('data-num');
var num = parseInt(val1);
function addRoom(){
	var id = ++num;
	var data = {
	index: id,
	list:jsdata,	
	};			
	var html = template('js_room_list', data);
	$('#mytbody').append(html);
	$('#start_'+id).clockpicker();
	$('#end_'+id).clockpicker();
	
	var cb = function(start, end, label) {
		//console.log(start.toISOString(), end.toISOString(), label);
		$('#range_'+id+' span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
		$('#range_'+id+' input').val(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));		
	}
var optionSet1 = {
	startDate: moment(),
	endDate: moment().month(),
	showDropdowns: true,
	showWeekNumbers: true,
	timePicker: true,
	timePickerIncrement: 1,
	timePicker12Hour: true,
	ranges: {
		'今天': [moment(), moment()]
	},
	opens: 'right',
	buttonClasses: ['btn btn-default'],
	applyClass: 'btn-small btn-primary',
	cancelClass: 'btn-small',
	format: 'YYYY/MM/DD',
	separator: ' to ',
	locale: {
		applyLabel: '确定',
		cancelLabel: '取消',
		fromLabel: '开始时间',
		toLabel: '结束时间',
		customRangeLabel: '自定义',
		daysOfWeek: ['日', '一', '二', '三', '四', '五', '六'],
		monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
		firstDay: 1
	}
};	
	$('#range_'+id+' span').html(moment().format('YYYY/MM/DD') + ' - ' + moment().add('days', 30).format('YYYY/MM/DD'));
	$('#range_'+id+' input').val(moment().format('YYYY/MM/DD') + ' - ' + moment().add('days', 30).format('YYYY/MM/DD'));	
	$('#range_'+id).daterangepicker(optionSet1, cb);	
}
function delRoom(obj){
    obj.parent().parent().parent().remove();		
}
</script>
<script>
function expSelect(){
    if($('select[name="advance[type]"]').val() == '0'){
	    $('#unit').text('分钟');
	}else if($('select[name="advance[type]"]').val() == '1'){
	    $('#unit').text('小时');	
	}else if($('select[name="advance[type]"]').val() == '2'){
	    $('#unit').text('天');	 
	}
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