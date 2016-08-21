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
    <section class="hbox stretch">
<aside class="aside-md bg-white b-r" id="subNav">
<!-- 	<div class="wrapper b-b header"><b>请假</b></div>
	<ul class="nav">	
		<li class="b-b b-light">
		<a href="<?php echo U('Leave/index',array('id'=>$_GET['id']));?>">
			<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>请假查询
		</a>
	</li>
	<li class="b-b b-light ">
		<a href="<?php echo U('Leave/conf_man',array('id'=>$_GET['id']));?>">
			<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>配置审核人
		</a>
	</li>
	<li class="b-b b-light">
		<a href="<?php echo U('Leave/leaveType',array('id'=>$_GET['id']));?>">
			<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>配置请假类型
		</a>
	</li>
		<li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
		<li class="b-b b-light">
			<a href="<?php echo U('Appmsg/conf',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
		</li>
		
	</ul> -->
			<div class="wrapper b-b header"><b>请假</b></div>
	<ul class="nav">	
		<li class="b-b b-light">
		<a href="<?php echo U('Leave/index',array('mid'=>$_GET['mid']));?>" target="_self">
			<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>请假查询
		</a>
	</li>
	<li class="b-b b-light ">
		<a href="<?php echo U('Leave/conf_man',array('mid'=>$_GET['mid']));?>" target="_self">
			<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>配置审核人
		</a>
	</li>
	<li class="b-b b-light">
		<a href="<?php echo U('Leave/leaveType',array('mid'=>$_GET['mid']));?>" target="_self">
			<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>配置请假类型
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
                <header class="header bg-white b-b clearfix">
                </header>
                <section class="scrollable  wrapper">
                    <section class="panel panel-default">
                            <form class="form-horizontal form-validate"  target="_self" method="post" action="<?php echo U('Leave/leaveType',array('mid'=>$_GET['mid']));?>">
                            <div class="entity-panel-body form-horizontal">
                                
                                  
                                <div class="table-responsive b-b">
                                <table class="table table-hover m-b-none" >
                                    <thead>
                                        <tr>
                                            <th>
                                                显示顺序
                                            </th>
                                            <th>原名称</th>
                                            <th>自定义名称</th>
                                            <th>设置/天</th>
                                            <th>设置请假最小值</th>
                                            <th>启用</th>
                                        </tr>
                                    </thead>
                                            <tbody>
											    <?php if(is_array($data)): $k = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($k % 2 );++$k;?><tr data-id="1">
                                                        <td>
                                                           <input class="form-control" type="text" value="<?php echo ($data["disorder"]); ?>" name="leave[<?php echo ($k); ?>][disorder]" id="order_num_20832" />                                                        </td>

                                                        <td>
															<p class="form-control-static"><?php echo ($data["name"]); ?>
															<input class="form-control" type="hidden" value="<?php echo ($data["name"]); ?>" name="leave[<?php echo ($k); ?>][name]"/> 
															</p>
														</td>

                                                        <td>
                                                            <input class="form-control" type="text" value="<?php echo ($data["cname"]); ?>" name="leave[<?php echo ($k); ?>][cname]" id="other_name_20832" />                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" value="<?php echo ($data["days"]); ?>" name="leave[<?php echo ($k); ?>][days]" id="standard_day_20832" />                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="leave[<?php echo ($k); ?>][mintime]" id="min_unit_20832">
															<option value="24" <?php if($data['mintime'] == 24): ?>selected="selected"<?php endif; ?> >一天</option>
															<option value="12"<?php if($data['mintime'] == 12): ?>selected="selected"<?php endif; ?> >半天</option>
															<option value="1"<?php if($data['mintime'] == 1): ?>selected="selected"<?php endif; ?> >一小时</option>
															</select>                                                        
														</td>
                                                        <td>
                                                            <label class="checkbox-inline">
                                                                <input <?php if($data['status'] == 'on'): ?>checked="checked"<?php endif; ?> type="checkbox" name="leave[<?php echo ($k); ?>][status]" id="is_status_20832" />                                                            </label> 
                                                        </td>
                                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?> 	  								
													
													
													
													
													
													
													
													
													
<!-- 													
                                                                                                                                                        <tr data-id="1">
                                                        <td>
                                                           <input class="form-control" type="text" value="1" name="order_num[20833]" id="order_num_20833" />                                                        </td>

                                                        <td><p class="form-control-static">调休</p></td>

                                                        <td>
                                                            <input class="form-control" type="text" value="调休" name="other_name[20833]" id="other_name_20833" />                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" value="2" name="standard_day[20833]" id="standard_day_20833" />                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="min_unit[20833]" id="min_unit_20833">
<option value="1" selected="selected">一天</option>
<option value="2">半天</option>
<option value="3">一小时</option>
</select>                                                        </td>
                                                        <td>
                                                            <label class="checkbox-inline">
                                                                <input checked="checked" type="checkbox" value="1" name="is_status[20833]" id="is_status_20833" />                                                            </label> 
                                                        </td>
                                                    </tr>
                                                                                                                                                        <tr data-id="1">
                                                        <td>
                                                           <input class="form-control" type="text" value="1" name="order_num[20834]" id="order_num_20834" />                                                        </td>

                                                        <td><p class="form-control-static">事假</p></td>

                                                        <td>
                                                            <input class="form-control" type="text" value="事假" name="other_name[20834]" id="other_name_20834" />                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" value="1" name="standard_day[20834]" id="standard_day_20834" />                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="min_unit[20834]" id="min_unit_20834">
<option value="1" selected="selected">一天</option>
<option value="2">半天</option>
<option value="3">一小时</option>
</select>                                                        </td>
                                                        <td>
                                                            <label class="checkbox-inline">
                                                                <input checked="checked" type="checkbox" value="1" name="is_status[20834]" id="is_status_20834" />                                                            </label> 
                                                        </td>
                                                    </tr>
                                                                                                                                                        <tr data-id="1">
                                                        <td>
                                                           <input class="form-control" type="text" value="1" name="order_num[20835]" id="order_num_20835" />                                                        </td>

                                                        <td><p class="form-control-static">病假</p></td>

                                                        <td>
                                                            <input class="form-control" type="text" value="病假" name="other_name[20835]" id="other_name_20835" />                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" value="1" name="standard_day[20835]" id="standard_day_20835" />                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="min_unit[20835]" id="min_unit_20835">
<option value="1" selected="selected">一天</option>
<option value="2">半天</option>
<option value="3">一小时</option>
</select>                                                        </td>
                                                        <td>
                                                            <label class="checkbox-inline">
                                                                <input checked="checked" type="checkbox" value="1" name="is_status[20835]" id="is_status_20835" />                                                            </label> 
                                                        </td>
                                                    </tr>
                                                                                                                                                        <tr data-id="1">
                                                        <td>
                                                           <input class="form-control" type="text" value="1" name="order_num[20836]" id="order_num_20836" />                                                        </td>

                                                        <td><p class="form-control-static">婚假</p></td>

                                                        <td>
                                                            <input class="form-control" type="text" value="婚假" name="other_name[20836]" id="other_name_20836" />                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" value="7" name="standard_day[20836]" id="standard_day_20836" />                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="min_unit[20836]" id="min_unit_20836">
<option value="1" selected="selected">一天</option>
<option value="2">半天</option>
<option value="3">一小时</option>
</select>                                                        </td>
                                                        <td>
                                                            <label class="checkbox-inline">
                                                                <input checked="checked" type="checkbox" value="1" name="is_status[20836]" id="is_status_20836" />                                                            </label> 
                                                        </td>
                                                    </tr>
                                                                                                                                                        <tr data-id="1">
                                                        <td>
                                                           <input class="form-control" type="text" value="1" name="order_num[20837]" id="order_num_20837" />                                                        </td>

                                                        <td><p class="form-control-static">产假</p></td>

                                                        <td>
                                                            <input class="form-control" type="text" value="产假" name="other_name[20837]" id="other_name_20837" />                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" value="90" name="standard_day[20837]" id="standard_day_20837" />                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="min_unit[20837]" id="min_unit_20837">
<option value="1" selected="selected">一天</option>
<option value="2">半天</option>
<option value="3">一小时</option>
</select>                                                        </td>
                                                        <td>
                                                            <label class="checkbox-inline">
                                                                <input checked="checked" type="checkbox" value="1" name="is_status[20837]" id="is_status_20837" />                                                            </label> 
                                                        </td>
                                                    </tr>
                                                                                                                                                        <tr data-id="1">
                                                        <td>
                                                           <input class="form-control" type="text" value="1" name="order_num[20838]" id="order_num_20838" />                                                        </td>

                                                        <td><p class="form-control-static">丧假</p></td>

                                                        <td>
                                                            <input class="form-control" type="text" value="丧假" name="other_name[20838]" id="other_name_20838" />                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" value="15" name="standard_day[20838]" id="standard_day_20838" />                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="min_unit[20838]" id="min_unit_20838">
<option value="1" selected="selected">一天</option>
<option value="2">半天</option>
<option value="3">一小时</option>
</select>                                                        </td>
                                                        <td>
                                                            <label class="checkbox-inline">
                                                                <input checked="checked" type="checkbox" value="1" name="is_status[20838]" id="is_status_20838" />                                                            </label> 
                                                        </td>
                                                    </tr>
                                                                                                                                                        <tr data-id="1">
                                                        <td>
                                                           <input class="form-control" type="text" value="1" name="order_num[20839]" id="order_num_20839" />                                                        </td>

                                                        <td><p class="form-control-static">其它</p></td>

                                                        <td>
                                                            <input class="form-control" type="text" value="其它" name="other_name[20839]" id="other_name_20839" />                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" value="1" name="standard_day[20839]" id="standard_day_20839" />                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="min_unit[20839]" id="min_unit_20839">
<option value="1" selected="selected">一天</option>
<option value="2">半天</option>
<option value="3">一小时</option>
</select>                                                        </td>
                                                        <td>
                                                            <label class="checkbox-inline">
                                                                <input checked="checked" type="checkbox" value="1" name="is_status[20839]" id="is_status_20839" />                                                            </label> 
                                                        </td>
                                                    </tr> -->
													
													
													
													
                                                                                            </tbody>
                                        </table>
                                    </div>
                                   <div class="form-group m-t">
                                        <div class="col-sm-11 m-l">
                                        <p class="help-block">注：-1表示无天数限制，若未导入假期，则按设置内的天数执行，若已导入假期，则按导入后的假期为准。</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">

                                            <button type="submit" class="btn btn-primary"   data-loading-text="保存中...">保存</button>
                                            <button type="button" class="btn btn-default"  data-toggle="back">取消</button>
                                          
                                        </div>
                                        
                                    
                                </div>
                            </form>
                        </div>
                    </section>
                </section>
            </section>
        </aside>
    </section>  

				
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