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
<!--     <div class="wrapper b-b header"><b>悬赏招聘</b></div>
	<ul class="nav">
		<li class="b-b b-light "><a href="<?php echo U('Hiring/index',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>首页</a></li>
        <li class="b-b b-light "><a href="<?php echo U('Hiring/position',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>职位管理</a></li>
        <li class="b-b b-light "><a href="<?php echo U('Hiring/resume',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>简历管理</a></li>
		<li class="b-b b-light "><a href="<?php echo U('Hiring/reward',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>赏金管理</a></li>
		<li class="b-b b-light "><a href="<?php echo U('Hiring/info',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>企业信息</a></li>
		<li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
		<li class="b-b b-light">
			<a href="<?php echo U('Appmsg/conf',array('id'=>$_GET['id']));?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
		</li>
    </ul>  -->    
    <div class="wrapper b-b header"><b>悬赏招聘</b></div>
	<ul class="nav">
		<li class="b-b b-light "><a href="<?php echo U('Hiring/index',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>首页</a></li>
        <li class="b-b b-light "><a href="<?php echo U('Hiring/position',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>职位管理</a></li>
        <li class="b-b b-light "><a href="<?php echo U('Hiring/resume',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>简历管理</a></li>
		<li class="b-b b-light "><a href="<?php echo U('Hiring/reward',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>赏金管理</a></li>
		<li class="b-b b-light "><a href="<?php echo U('Hiring/info',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>企业信息</a></li>
		<li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
		<li class="b-b b-light">
			<a href="<?php echo U('Appmsg/conf',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
		</li>
    </ul> 
  	
</aside>  
 <aside>
    <section class="vbox">
       
     <!-- <iframe name="content" id="content" src="<?php echo U('conf',array('id'=>$_GET['id']));?>" frameborder="0" width="100%" height="100%" scrolling="no"></iframe> -->
	 
    <section class="hbox stretch">
   <aside>
            <section class="vbox">
                <header class="header bg-white b-b b-light">  
                   <p>首页</p>
            <a class="text-muted pull-right m-t pointer" data-toggle="back" title="返回" href="javascript:history.go(-1)"><i class="fa fa-reply"></i></a>				   
                </header>
                <section class="scrollable  wrapper">
                    <section class="panel panel-default ">
                        <div class="panel-body">
                            <div class="entity-panel-body form-horizontal">
                                <div class="col-sm-12 m-t-lg">
                                    <div class="col-sm-2 text-center">
                                        <i class="fa fa-user text-muted" style="font-size:50px"></i>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <i class="fa fa-copy text-muted" style="font-size:50px"></i>
                                    </div>
                                    <div class="col-sm-4 text-center">
                                        <i class="fa fa-star text-muted" style="font-size:50px"></i>
                                    </div>
                                    <div class="col-sm-4 text-center">
                                        <i class="fa fa-heart text-muted" style="font-size:50px"></i>
                                    </div>
                                </div>
                                <div class="col-sm-12 m-t">
                                    <div class="col-sm-2" style="margin-top:110px">
                                        <p class="form-control-static m-l-xl">所有职位:<span class="maroon"><?php echo ($count1); ?></span>个</p>
                                        <p class="form-control-static m-l-xl">发布中:<span class="maroon"><?php echo ($count2); ?></span>个</p>
                                    </div>
                                    <div class="col-sm-2" style="margin-top:95px">
                                        <p class="form-control-static m-l-xl">所有简历:<span class="maroon"><?php echo ($count3); ?></span>个</p>
                                        <p class="form-control-static m-l-xl">未读简历:<span class="maroon"><?php echo ($count4); ?></span>个</p>
                                        <p class="form-control-static m-l-xl">成功录用:<span class="maroon"><?php echo ($count5); ?></span>个</p>
                                    </div>
                                    <div class="col-sm-4">
                                      
										
										
										 <div class="form-group">
                                            <label class="col-sm-5 control-label" >悬赏金额</label>
											
                                            <div class="col-sm-7 ">
                                                <p class="form-control-static">悬赏总额:<span class="maroon"><?php if($leftsum): echo ($leftsum); else: ?>0<?php endif; ?></span>元</p>
                                            </div>
											
                                            <div class="col-sm-7 col-sm-offset-5">
                                                <p class="form-control-static">已发送金额:<span class="maroon"><?php if($allSum): echo ($allSum); else: ?>0<?php endif; ?></span>元</p>
                                            </div>
                                        </div>
										
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label" >分享被查看</label>
											
                                            <div class="col-sm-7 ">
                                                <p class="form-control-static">发放红包:<span class="maroon"><?php echo ($sharecount); ?></span>个</p>
                                            </div>
											
                                            <div class="col-sm-7 col-sm-offset-5">
                                                <p class="form-control-static">发放金额:<span class="maroon"><?php echo ($shareSum); ?></span>元</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label" >获得简历</label>
                                            <div class="col-sm-7 ">
                                                <p class="form-control-static">发放红包:<span class="maroon"><?php echo ($getcount); ?></span>个</p>
                                            </div>
                                            <div class="col-sm-7 col-sm-offset-5">
                                                <p class="form-control-static">发放金额:<span class="maroon"><?php echo ($getSum); ?></span>元</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label" >成功录用</label>
                                            <div class="col-sm-7 ">
                                                <p class="form-control-static">发放红包:<span class="maroon"><?php echo ($successcount); ?></span>个</p>
                                            </div>
                                            <div class="col-sm-7 col-sm-offset-5">
                                                <p class="form-control-static">发放金额:<span class="maroon"><?php if($successSum): echo ($successSum); else: ?>0<?php endif; ?></span>元</p>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label class="col-sm-5 control-label">剩余总额</label>
                                             <div class="col-sm-7 ">
                                                <p class="form-control-static"><span class="maroon">10</span>元</p>
                                            </div>
                                        </div> -->
                                       
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="form-group m-t-xl">
                                            <label class="col-sm-5 control-label">提现总额</label>
                                             <div class="col-sm-7 ">
                                                <p class="form-control-static"><span class="maroon"><?php if($sum1): echo ($sum1); else: ?>0<?php endif; ?></span>元</p>
                                            </div>
                                        </div>
                                       <div class="form-group">
                                            <label class="col-sm-5 control-label">兑现总额</label>
                                             <div class="col-sm-7 ">
                                                <p class="form-control-static"><span class="maroon"><?php if($sum1): echo ($sum2); else: ?>0<?php endif; ?></span>元</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label">待审核</label>
                                             <div class="col-sm-7 ">
                                                <p class="form-control-static"><span class="maroon"><?php echo ($count6); ?></span>个</p>
                                            </div>
                                        </div>
                                       <!--  <div class="form-group">
                                            <label class="col-sm-5 control-label">待兑现</label>
                                             <div class="col-sm-7 ">
                                                <p class="form-control-static"><span class="maroon"><?php echo ($count5); ?></span>个</p>
                                            </div>
                                        </div> -->
                                        <!-- <div class="form-group">
                                            <label class="col-sm-5 control-label">申请提现最低额</label>
                                             <div class="col-sm-7 ">
                                                <p class="form-control-static"><span class="maroon"><?php echo ($res["withdrawal_sum"]); ?></span>元</p>
                                            </div>
                                        </div> -->
                                       
                                    </div>
                                </div>
                                <div class="col-sm-12 m-t">
                                    <div class="col-sm-2 text-center">
                                        <a href="<?php echo U('Hiring/addPosition',array('mid'=>$_GET['mid']));?>" target="_self" class="btn btn-primary">发布职位</a>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <a href="<?php echo U('Hiring/resume',array('is_read'=>0,'mid'=>$_GET['mid']));?>" target="_self" class="btn btn-info">查看未读简历</a>
                                    </div>
                                    <div class="col-sm-4 text-center">
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#js_addMoneyModal">加赏</button>
                                    </div>
                                    <div class="col-sm-4 text-center">
                                        <a href="<?php echo U('Hiring/reward',array('mid'=>$_GET['mid'],'status'=>1));?>" target="_self" class="btn btn-warning">去审核</a>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#js_updateMoneyModal">调整最低额</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
        		</section>
        	</section>
        </aside>
   </section> 
   <div class="modal fade in" id="js_addMoneyModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <form class="form-horizontal form-validate form-modal" method="post" target="_self"  action="<?php echo U('Hiring/addMoney',array('mid'=>$_GET['mid']));?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">加赏</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group m-t">
                            <label class="col-sm-3 control-label">增加悬赏总金额</label>
                            <div class="col-sm-5 ">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="addmoney" data-rule-decimal="2">
                                    <div class="input-group-addon">元</div>
                                </div>
                                <span class="help-block">请输入正数，仅支持两位小数</span>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >确认</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </div>
        	</form>
        </div>
    </div>

    <div class="modal fade in" id="js_updateMoneyModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <form class="form-horizontal form-validate form-modal" method="post" target="_self"  action="<?php echo U('Hiring/upMoney',array('mid'=>$_GET['mid']));?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">修改下限</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group m-t">
                            <label class="col-sm-4 control-label">允许申请提现的最低金额</label>
                            <div class="col-sm-5 ">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="updatemoney" data-rule-positiveInteger="true">
                                    <div class="input-group-addon">元</div>
                                </div>
                                <span class="help-block">请输入正整数</span>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="hidden" value="752">
                        <button type="submit" class="btn btn-primary" >确认</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </div>
        	</form>
        </div>
    </div>
   
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