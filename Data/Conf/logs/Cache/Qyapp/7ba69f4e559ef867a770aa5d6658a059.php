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
						<!-- <li>
                            <a href="<?php echo U('Userinfo/version', array('token' => $token));?>" target="_self"><i class="iconfont icon-binding m-r-xs icon-size20"></i>版本升级</a>
                        </li> -->
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
<style>
    .portlet{
	    border: 1px solid #eee;
	    padding: 12px 20px 15px;
		border-radius: 4px;
		margin-bottom: 25px;
		margin: 15px;
		padding: 0px;	
	}
    .portlet p {
	padding:15px;
    border-bottom: 1px solid #eee;
    border-radius: 4px 4px 0 0;
    margin-bottom: 10px;
    min-height: 30px;
	font-size: 14px;
    font-weight: bold;
	}	
	.portlet > p > small {
		font-size: 70%;
		font-weight: normal;
		padding-left: 5px;
	}
</style>
<section class="vbox">
    <header class="header bg-white b-b clearfix">
        <p>
            我的应用<small><?php echo (date("Y年m月d日",$user["endtime"])); ?>到期</small>
        </p>
    </header>
   <section class="scrollable wrapper w-f" style="padding:0px;">
        <section class="panel panel-default ">
            <div class="row m-l-none m-r-none bg-light lter portlet" id="jichu">	
				<p>
				<?php echo ($jichu["head"]); ?>
				<small><?php echo ($jichu["info"]); ?></small>
				</p>
				<?php if(is_array($jichu["data"])): $i = 0; $__LIST__ = $jichu["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="app-item" style="padding-left:17px;padding-right:15px;width:170px;">
					<a href="<?php echo U($vo['module'].'/index',array('mid'=>$vo['id']));?>" target="_self">
					<img class="app-item-img" alt="<?php echo ($vo["name"]); ?>" src="<?php echo ($vo["logo"]); ?>"></a>
					<div class="app-item-name js_entity_view" data-path=""><?php echo ($vo["name"]); ?>                               
						<span class="pull-right text-muted" title="查看详情">
						<i class="fa fa-trash-o mypanel" id="<?php echo ($vo["id"]); ?>"></i>
						</span>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>				
				<a href="<?php echo U('Appslist/appCenter');?>" target="_self">
					<div class="app-item-add" title="添加应用" style="height:130px;width:130px;">
						<a  href="<?php echo U('Appslist/appCenter');?>" target="_self" class="fa fa-plus icon_add_pid "></a>
					</div>
				</a>               				
			</div>
            <div class="row m-l-none m-r-none bg-light lter portlet" id="sanji">	
				<p>
				<?php echo ($sanji["head"]); ?>
				<small><?php echo ($sanji["info"]); ?></small>
				</p>
				<?php if(is_array($sanji["data"])): $i = 0; $__LIST__ = $sanji["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="app-item" style="padding-left:17px;padding-right:15px;width:170px;">
					<a href="<?php echo U($vo['module'].'/index',array('mid'=>$vo['id']));?>" target="_self">
					<img class="app-item-img" alt="<?php echo ($vo["name"]); ?>" src="<?php echo ($vo["logo"]); ?>"></a>
					<div class="app-item-name js_entity_view" data-path=""><?php echo ($vo["name"]); ?>                               
						<span class="pull-right text-muted" title="查看详情">
						<i class="fa fa-trash-o mypanel" id="<?php echo ($vo["id"]); ?>"></i>
						</span>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>				
				<a href="<?php echo U('Appslist/appCenter');?>" target="_self">
					<div class="app-item-add" title="添加应用" style="height:130px;width:130px;">
						<a  href="<?php echo U('Appslist/appCenter');?>" target="_self" class="fa fa-plus icon_add_pid "></a>
					</div>
				</a>               				
			</div>
            <div class="row m-l-none m-r-none bg-light lter portlet" id="yingxiao">	
				<p>
				<?php echo ($yingxiao["head"]); ?>
				<small><?php echo ($yingxiao["info"]); ?></small>
				</p>
				<?php if(is_array($yingxiao["data"])): $i = 0; $__LIST__ = $yingxiao["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="app-item" style="padding-left:17px;padding-right:15px;width:170px;">
					<a href="<?php echo U($vo['module'].'/index',array('mid'=>$vo['id']));?>" target="_self">
					<img class="app-item-img" alt="<?php echo ($vo["name"]); ?>" src="<?php echo ($vo["logo"]); ?>"></a>
					<div class="app-item-name js_entity_view" data-path=""><?php echo ($vo["name"]); ?>                               
						<span class="pull-right text-muted" title="查看详情">
						<i class="fa fa-trash-o mypanel" id="<?php echo ($vo["id"]); ?>"></i>
						</span>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>				
				<a href="<?php echo U('Appslist/appCenter');?>" target="_self">
					<div class="app-item-add" title="添加应用" style="height:130px;width:130px;">
						<a  href="<?php echo U('Appslist/appCenter');?>" target="_self" class="fa fa-plus icon_add_pid "></a>
					</div>
				</a>                				
			</div>
            <div class="row m-l-none m-r-none bg-light lter portlet" id="hangye">	
				<p>
				<?php echo ($hangye["head"]); ?>
				<small><?php echo ($hangye["info"]); ?></small>
				</p>
				<?php if(is_array($hangye["data"])): $i = 0; $__LIST__ = $hangye["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="app-item" style="padding-left:17px;padding-right:15px;width:170px;">
					<a href="<?php echo U($vo['module'].'/index',array('mid'=>$vo['id']));?>" target="_self">
					<img class="app-item-img" alt="<?php echo ($vo["name"]); ?>" src="<?php echo ($vo["logo"]); ?>"></a>
					<div class="app-item-name js_entity_view" data-path=""><?php echo ($vo["name"]); ?>                               
						<span class="pull-right text-muted" title="查看详情">
						<i class="fa fa-trash-o mypanel" id="<?php echo ($vo["id"]); ?>"></i>
						</span>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>				
				<a href="<?php echo U('Appslist/appCenter');?>" target="_self">
					<div class="app-item-add" title="添加应用" style="height:130px;width:130px;">
						<a  href="<?php echo U('Appslist/appCenter');?>"  target="_self" class="fa fa-plus icon_add_pid "></a>
					</div>
				</a>               				
			</div>
            <div class="row m-l-none m-r-none bg-light lter portlet" id="shangwu">	
				<p>
				<?php echo ($shangwu["head"]); ?>
				<small><?php echo ($shangwu["info"]); ?></small>
				</p>
				<?php if(is_array($shangwu["data"])): $i = 0; $__LIST__ = $shangwu["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="app-item" style="padding-left:17px;padding-right:15px;width:170px;">
					<a href="<?php echo U($vo['module'].'/index',array('mid'=>$vo['id']));?>" target="_self">
					<img class="app-item-img" alt="<?php echo ($vo["name"]); ?>" src="<?php echo ($vo["logo"]); ?>"></a>
					<div class="app-item-name js_entity_view" data-path=""><?php echo ($vo["name"]); ?>                               
						<span class="pull-right text-muted" title="查看详情">
						<i class="fa fa-trash-o mypanel" id="<?php echo ($vo["id"]); ?>"></i>
						</span>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>				
				<a href="<?php echo U('Appslist/appCenter');?>" target="_self">
					<div class="app-item-add" title="添加应用" style="height:130px;width:130px;">
						<a  href="<?php echo U('Appslist/appCenter');?>" target="_self" class="fa fa-plus icon_add_pid "></a>
					</div>
				</a>               				
			</div>
<!--             <div class="row m-l-none m-r-none bg-light lter portlet" id="crm">	
				<p>
				<?php echo ($crm["head"]); ?>
				<small><?php echo ($crm["info"]); ?></small>
				</p>
				<?php if(is_array($crm["data"])): $i = 0; $__LIST__ = $crm["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="app-item" style="padding-left:17px;padding-right:15px;width:170px;">
					<a href="<?php echo U($vo['module'].'/index',array('mid'=>$vo['id']));?>" target="_self">
					<img class="app-item-img" alt="<?php echo ($vo["name"]); ?>" src="<?php echo ($vo["logo"]); ?>"></a>
					<div class="app-item-name js_entity_view" data-path=""><?php echo ($vo["name"]); ?>                               
						<span class="pull-right text-muted" title="查看详情">
						<i class="fa fa-trash-o mypanel" id="<?php echo ($vo["id"]); ?>"></i>
						</span>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>				
				<a href="<?php echo U('Appslist/appCenter');?>" target="_self">
					<div class="app-item-add" title="添加应用" style="height:130px;width:130px;">
						<a  href="<?php echo U('Appslist/appCenter');?>" target="_self" class="fa fa-plus icon_add_pid "></a>
					</div>
				</a>               				
			</div>
            <div class="row m-l-none m-r-none bg-light lter portlet" id="hudong">	
				<p>
				<?php echo ($hudong["head"]); ?>
				<small><?php echo ($hudong["info"]); ?></small>
				</p>
				<?php if(is_array($hudong["data"])): $i = 0; $__LIST__ = $hudong["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="app-item" style="padding-left:17px;padding-right:15px;width:170px;">
					<a href="<?php echo U($vo['module'].'/index',array('mid'=>$vo['id']));?>" target="_self">
					<img class="app-item-img" alt="<?php echo ($vo["name"]); ?>" src="<?php echo ($vo["logo"]); ?>"></a>
					<div class="app-item-name js_entity_view" data-path=""><?php echo ($vo["name"]); ?>                               
						<span class="pull-right text-muted" title="查看详情">
						<i class="fa fa-trash-o mypanel" id="<?php echo ($vo["id"]); ?>"></i>
						</span>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>				
				<a href="<?php echo U('Appslist/appCenter');?>" target="_self">
					<div class="app-item-add" title="添加应用" style="height:130px;width:130px;">
						<a  href="<?php echo U('Appslist/appCenter');?>" target="_self" class="fa fa-plus icon_add_pid "></a>
					</div>
				</a>                				
			</div>	 -->	
	        <style>
			.icon_add_pid{
			display:black;
			background-image: url(./Tpl/Qyapp/Appslist/images/icon_main_efa6f7de.png)!important;
			background-repeat: no-repeat!important;
			width:30px;
			height:30px;
			margin-top:55px;
			margin-left:10px;
			}
	        </style>			
        </section>
 </section>
</section>
<div class="msgbox"></div>
<section class="entity-panel hd" id="info">
</section>
<script src="./Tpl/Qyapp/Static/Js/weiyi.js" type="text/javascript"></script>
<script type="text/javascript">
var a = $('#jichu.portlet div.app-item div.js_entity_view span.pull-right i.mypanel');
var b = $('#sanji.portlet div.app-item div.js_entity_view span.pull-right i.mypanel');
var c = $('#yingxiao.portlet div.app-item div.js_entity_view span.pull-right i.mypanel');
var d = $('#hangye.portlet div.app-item div.js_entity_view span.pull-right i.mypanel');
var e = $('#shangwu.portlet div.app-item div.js_entity_view span.pull-right i.mypanel');
a.add(b).add(c).add(d).add(e).click(function(){
    //alert('gggggggggg');
	$(this).each(function(){
	    //获取每行用户的id
        var userId = $(this).attr('id');
		//alert(userId);
		if($('#user'+userId).length>0){
			//查看是否为当前的成员的信息
			var curId = $('#info').children().attr('id');			
		    if(curId == 'user'+userId){
				if($('.entity-panel').hasClass('hd')){
					$('.entity-panel').removeClass('hd');
				}else{
					$('.entity-panel').addClass('hd');
				}			    
			}else{
				$('#info').empty();   
				//并ajax加载点击行的数据信息
				$('#info').load("index.php?g=Qyapp&m=Appslist&a=panelInfo&mid=<?php echo $_GET['mid'];?>&id="+userId);
				$('.entity-panel').removeClass('hd');
				$('.entity-panel').css('right','0px');				    
			}
		}else{
		    $('#info').empty();   //清除点击其他行在id为memberInfo的div中产生的数据信息
			$('#info').load("index.php?g=Qyapp&m=Appslist&a=panelInfo&mid=<?php echo $_GET['mid'];?>&id="+userId);
			$('.entity-panel').removeClass('hd');
			$('.entity-panel').css('right','0px');			    
		}

		
	});
	
});	
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