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
	<link rel="stylesheet" type="text/css" href="./Tpl/Qyapp/Static/Js/autocomplete/src/jquery.autocomplete.css">	
	<script type="text/javascript" src="./Tpl/Qyapp/Static/Js/autocomplete/src/jquery.autocomplete.js"></script>	
	<script src="./Tpl/Qyapp/Static/Js/autocomplete/test/test.js"></script>
	<link href="./Tpl/Qyapp/Static/Js/autocomplete/lib/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="./Tpl/Qyapp/Static/Js/autocomplete/lib/google-code-prettify/prettify.js"></script>
	<script type="text/javascript" src="./Tpl/Qyapp/Static/Js/autocomplete/lib/google-code-prettify/beautify.min.js"></script>
	
	<link href="./Tpl/Qyapp/Static/Js/jstree/3.0.2/themes/default/style.min.css" rel="stylesheet">	
	<link href="./Tpl/Qyapp/Static/Js/bootstrap/switch/docs/css/highlight.css" rel="stylesheet">		
    <link href="./Tpl/Qyapp/Static/Js/bootstrap/switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">	
	<link href="./Tpl/Qyapp/Static/Js/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">			
	<script src="./Tpl/Qyapp/Static/Js/artTemplate/dist/template.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/jstree/3.0.2/jstree.min.js"></script>	
	<script src="./Tpl/Qyapp/Static/Js/bootstrap/switch/docs/js/highlight.js" type="text/javascript"></script>	
	<script src="./Tpl/Qyapp/Static/Js/bootstrap/switch/dist/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/daterangepicker/moment.min.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/daterangepicker/daterangepicker.js" type="text/javascript"></script>

    <script type="text/javascript">
	$(document).ready(function(){
		selectAuto();	
	});
    </script>
<div id="myModal" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<script type="text/javascript">
	$(document).ready(function() {
		var cb1 = function(start, end, label) {  
			//console.log(start.toISOString(), end.toISOString(), label);
			//$('#select_0 input').val(start.format('YYYY/MM/DD'));
			$('#select_0 input').attr('value',start.format('YYYY/MM/DD'));
		}
		var cb2 = function(start, end, label) {
			//console.log(start.toISOString(), end.toISOString(), label);
			//$('#select_3 input').val(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
			$('#select_3 input').attr('value',start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
		}

		var optionSet1 = {
			singleDatePicker: true,
			ranges: {
				'今天': [moment(), moment()],
				'昨天': [moment().subtract('days', 1), moment().subtract('days', 1)],
				'最近7天': [moment().subtract('days', 6), moment()],
				'最近30天': [moment().subtract('days', 29), moment()],
				'这个月': [moment().startOf('month'), moment().endOf('month')],
				'上个月': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
			},
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
		var optionSet2 = {
			startDate: moment().subtract('days', 29),
			endDate: moment(),
			dateLimit: {
				days: 60
			},
			showDropdowns: true,
			showWeekNumbers: true,
			timePicker: true,
			timePickerIncrement: 1,
			timePicker12Hour: true,
			ranges: {
				'今天': [moment(), moment()],
				'昨天': [moment().subtract('days', 1), moment().subtract('days', 1)],
				'最近7天': [moment().subtract('days', 6), moment()],
				'最近30天': [moment().subtract('days', 29), moment()],
				'这个月': [moment().startOf('month'), moment().endOf('month')],
				'上个月': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
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
		//按天查询
		//$('#select_0 input').val(moment().format('YYYY/MM/DD'));
		$('#select_0').daterangepicker(optionSet1, cb1);
		//$('#select_0').on('apply.daterangepicker', function(ev, picker) {
		//   $('form').submit(); 
		//});		
		//按月查询select_1
		//按时间段查询
		//$('#select_3 input').val(moment().subtract('days', 29).format('YYYY/MM/DD') + ' - ' + moment().format('YYYY/MM/DD'));
		$('#select_3').daterangepicker(optionSet2, cb2);	
		//$('#select_3').on('apply.daterangepicker', function(ev, picker) {
		//   $('form').submit(); 
		//});
	});
</script>
 
    <section class="hbox stretch">
		<aside class="aside-md bg-white b-r" id="subNav">
        
<div class="wrapper b-b header"><b>微信考勤</b></div>
<ul class="nav">
	 <li class="b-b b-light open"><a href="<?php echo U('Attendance/index',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>考勤设置</a></li>
	<li class="b-b b-light"><a href="<?php echo U('Attendance/rule',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>考勤规则</a></li>
	<li class="b-b b-light"><a href="<?php echo U('Attendance/address',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>考勤地点</a></li>
	<li class="b-b b-light"><a href="<?php echo U('Attendance/tongji',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>考勤统计</a></li>
				
	<li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
	<li class="b-b b-light">
		<a href="<?php echo U('Appmsg/conf',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
	</li>
	
</ul>
				
		</aside>
        <aside>
            <section class="vbox">
                 <header class="header bg-white b-b clearfix">
                    <form class="talbe-search" method="post" target="_self" action="<?php echo U('Attendance/tongji',array('mid'=>$_GET['mid']));?>" id="form">
                        <div class="row m-t-sm">					
                            <div class="col-sm-4 m-b-xs">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <span class="dropdown-label" id="searchTypeTxt1">按用户名查询</span>
                                            <span class="caret"></span>
                                        </button>
                                       <ul class="dropdown-menu dropdown-select js_select_search" id="searchMenu">
                                             <li >
                                                <a href="javascript:;" target="_self">
                                                    <input type="radio" value="0" name="searchBy"/>按部门名称查询
                                                </a>
                                            </li> 
                                            <li >
                                                <a href="javascript:;" target="_self">
                                                    <input type="radio" value="1" name="searchBy" />按用户名查询
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="input-group js_show_date js_show_date_0 " id="select_4" >
										<input type="text" class="form-control input-sm" name="username" id="searchUsername" value="<?php echo ($username); ?>" placeholder="请输入用户名"/>
										<input type="text" class="form-control input-sm" style="display:none" name="departname" id="depart" value="<?php echo ($departname); ?>" placeholder="请输入部门名称" onclick="openModel()"/>
										<input type="hidden" name="type" id="type" value="1">								
										<span class="input-group-addon btn-sm" onclick="searchInfo();" style="cursor:pointer;"><i class="fa fa-search"></i></span>									
									</div>									
									
                                </div> 
															
								
                            </div>
						<a class="btn btn-default" href="index.php?g=Qyapp&m=Attendance&a=exportSN" target="_self" style="display:black; float:right;margin-right:20px;">导出数据</a>
                        	
														 
                        </div>
						<script>
							function openModel(){
								$('#depart').attr("value",'');
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
							function searchInfo(){
							    $('#form').submit();
							}
						</script>
<!-- 						<script>
							function searchInfo(){
								var type = $('#type').val();
								var data = '';
								if(type == 1){
									data = $('#searchUsername').val();
								}else if(type == 0 ){
									data = $('#depart').val();
								}
								$.ajax({
									type:"POST",
									url:"index.php?g=Qyapp&m=Attendance&a=tongji&mid=<?php echo $_GET['mid'];?>",
									data:{data:data,type:type},
									dataType:'json',
									success:function(json){
									var status = json.status;
									  if(status==1)
									  {
										location.reload();
									  }
									  else
									  {
										location.reload();
									  }
									}
								});							
													   
							}						
						</script> -->
                        <script>  								
							$('#searchMenu li').each(function(){
								$(this).click(function(){
									if($(this).index() == 0){
										$('#searchTypeTxt1').text('按部门名称查询');
										$('#depart').css('display','block');
										$('#searchUsername').css('display','none');
										$('#searchUsername').attr('value','');
										$('#depart').attr('value','');
										$('#type').attr('value',0);									
									}else{
										$('#searchTypeTxt1').text('按用户名查询');
										$('#searchUsername').css('display','block');
										$('#depart').css('display','none');	
										$('#searchUsername').attr('value','');
										$('#depart').attr('value','');										
										$('#type').attr('value',1);										
										
									}
									
								});
							
							});
                        </script>
                    </form>
                </header>
                <section class="scrollable  wrapper">
                    <section class="panel panel-default">
                         <div class="table-responsive">
                            <table class="table table-hover m-b-none entity-view">
                                <colgroup>
                                <col style="width:5%" />
                                <col style="width:20%" />
                                <col style="width:30%" />
                                <col style="width:15%" />
                                <col style="width:15%" />
                                </colgroup>						
                                <thead>
                                    <tr>
                                        <!-- <th>部门</th> -->
										<th>ID</th>
                                        <th>员工姓名</th>
                                        <th>所属部门</th>
                                        <th>职位</th>								
										<th>操作</th>
                                        <!-- <th>状态</th> -->
                                    </tr>
                                </thead>
                                <tbody id="mytable">
								<?php if($data): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($vo["id"]); ?>">
                                        <!-- <td class="nodata"><?php echo ($vo["id"]); ?></td> -->
                                        <td><?php echo ($vo["id"]); ?></td>
                                        <!--<td> <?php if($vo['creatime']): echo (date("Y-m-d H:i",$vo["creatime"])); else: echo ($vo["creatime"]); ?> &nbsp;<?php endif; ?> </td>-->
										<td><?php echo ($vo["name"]); ?></td>
										
                                        <td>
										<!-- <?php if(is_array($vo['department'])): $i = 0; $__LIST__ = $vo['department'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; echo ($v["name"]); ?>&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?> -->
										<?php echo ($vo["departmnet"]); ?>
										</td>
										<?php if(!empty($vo['position'])): ?><td><?php echo ($vo["position"]); ?></td>
										<?php else: ?>
										<td>无职位</td><?php endif; ?>
										<td>
											<a href="index.php?g=Qyapp&m=Attendance&a=userinfo&mid=<?php echo ($_GET['mid']); ?>&id=<?php echo ($vo["uid"]); ?>" target="_self">
												<!-- <span class="dropdown-label" >查询</span> -->
												<span class="dropdown-label" >查看<!-- <i class="fa fa-search"></i> --></span>
											</a>
											<a href="javascript:void(0);" onclick="del(<?php echo ($vo["id"]); ?>)"  target="_self">
												<!-- <span class="dropdown-label" >查询</span> -->
												<span class="dropdown-label" >删除<!-- <i class="fa fa-search"></i> --></span>
											</a>
										</td>
                                      						
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?> 
								<?php else: ?>
								<tr><td colspan='10' class="nodata">暂无信息</td></tr><?php endif; ?>								
								</tbody>
                            </table>
                        </div>
					
                    </section>
                </section>
				<footer class="footer bg-white b-t">
                    <div class="row text-center-xs">
                        <div class="col-md-6 hidden-sm">
                            <p class="text-muted m-t"><?php echo ($page); ?></p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right text-center-xs">
                            <ul class="pagination pagination-sm m-t-sm m-b-none" data-pages-total="" data-page-current=""></ul>
                        </div>
                    </div>
                </footer>
            </section>
        </aside>
    </section> 		
<!-- <script>	
function selectAuto(){
	 $.ajax({
		type:"POST",
		url:"index.php?g=Qyapp&m=Common&a=searchUsers",
		//data:"id="+id,
		dataType:'json',
		success:function(json){
		var status = json.status;
		  if(status==1)
		  {
			var data = json.data;
			//alert(data);				
			$('#autoComplete div.form-group').each(function(){
				var Obj = $('#autoComplete div.form-group').find('div.col-sm-3 input');
				Obj.AutoComplete({
					'data': data,
					'width':225,
					'listStyle': 'custom',
					'maxHeight': 240,
					'createItemHandler': function(index, data){
						var div = $("<div style='height:36px;padding-top:2px'></div>")
						var cell1 = $("<div style='display:table-cell;vertical-align:top;'></div>").appendTo(div);
						var cell1_1 = $("<img style='width:32px;height:32px;'></img>").attr('src', data.image).appendTo(cell1);
						var cell2 = $("<div style='display:table-cell;vertical-align:middle;padding-right:10px'></div>").appendTo(div);
						var cell2_1 = $("<div></div>").append(data.label).appendTo(cell2);
						var cell2_2 = $("<div style='vertical-align:top;'></div>").appendTo(cell2);
						return div;
					}
				});
			});				
		  }
		  else
		  {
			  alert('删除失败');
		  }
		}
	}); 
		
}	
</script> -->	
<script type="text/javascript">	
	function del(id){
		if(confirm("将删除该人员的所有记录，确定要删除么") == true){
			$.ajax({
				type:"POST",
				url:"index.php?g=Qyapp&m=Attendance&a=record_del",
				dataType:'json',
				data:{'id':id},
				success:function(json){
					var status = json.status;
					if(status==1){
						window.location.href="index.php?g=Qyapp&m=Attendance&a=tongji&mid=<?php echo ($_GET['mid']); ?>"; 
					}else{
						  alert('删除失败');
					}
				}
			}); 
		}
	}
	function selectAuto(){
		$.ajax({
			type:"POST",
			url:"index.php?g=Qyapp&m=Common&a=searchUsers",
			dataType:'json',
			success:function(json){
			var status = json.status;
			  if(status==1)
			  {
			    var users = json.data;			
					$('#searchUsername').AutoComplete({
						'data': users,
						'width':190,
						'listStyle': 'custom',
						'maxHeight': 240,
						'createItemHandler': function(index, data){
							var div = $("<div style='height:36px;padding-top:2px'></div>")
							var cell1 = $("<div style='display:table-cell;vertical-align:top;'></div>").appendTo(div);
							var cell1_1 = $("<img style='width:32px;height:32px;'></img>").attr('src', data.image).appendTo(cell1);
							var cell2 = $("<div style='display:table-cell;vertical-align:middle;padding-right:10px'></div>").appendTo(div);
							var cell2_1 = $("<div></div>").append(data.label).appendTo(cell2);
							var cell2_2 = $("<div style='vertical-align:top;'></div>").appendTo(cell2);
							return div;
						}
					});				
			  }
			  else
			  {
				  alert('你查找的用户不存在');
			  }
			}
		}); 
			
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