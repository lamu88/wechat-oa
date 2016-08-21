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
	<link href="./Tpl/Qyapp/Static/Js/jstree/3.0.2/themes/default/style.min.css" rel="stylesheet">
	<script src="./Tpl/Qyapp/Static/Js/jstree/3.0.2/jstree.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./Tpl/Qyapp/Static/Js/autocomplete/src/jquery.autocomplete.css">	
	<script src="./Tpl/Qyapp/Static/Js/artTemplate/dist/template.js" type="text/javascript"></script>
	<script type="text/javascript" src="./Tpl/Qyapp/Static/Js/autocomplete/src/jquery.autocomplete.js"></script>	
    <script src="./Tpl/Qyapp/Static/Js/autocomplete/test/test.js"></script>
    <link href="./Tpl/Qyapp/Static/Js/autocomplete/lib/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="./Tpl/Qyapp/Static/Js/autocomplete/lib/google-code-prettify/prettify.js"></script>
    <script type="text/javascript" src="./Tpl/Qyapp/Static/Js/autocomplete/lib/google-code-prettify/beautify.min.js"></script>	
	<script charset="utf-8" src="./Tpl/static/kindeditor/kindeditor-min.js"></script>
	<script charset="utf-8" src="./Tpl/static/kindeditor/lang/zh_CN.js"></script>
	<link rel="stylesheet" href="./Tpl/static/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="./Tpl/Qyapp/Static/Css/uploadify.min.css" />
	<script type="text/javascript">
		KindEditor.ready(function(K) {
			var editor;
			editor = K.create('textarea[name="content"]', {
				resizeType : 0,
				allowPreviewEmoticons :false,
				allowImageUpload :true,
				uploadJson:'/index.php?g=Qyapp&m=Adminupload&a=uploadType&is_url=1&file_type=image',
				formatUploadUrl:false,
				items : [
					'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
					'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
					'insertunorderedlist', '|', 'emoticons', 'image', 'link']
			});		
		});	
	</script>
	<script type="text/javascript">
		KindEditor.ready(function(K) 
		{
			var editor = K.editor({
				allowFileManager : false,
				uploadJson:'/index.php?g=Qyapp&m=Adminupload&a=uploadType&is_url=1&file_type=image',
				formatUploadUrl:false
			});	
			K('#upload').click(function() {

				editor.loadPlugin('image', function() {
					editor.plugin.imageDialog({
						showRemote : false,
						imageUrl : K('#url3').val(),
						clickFn : function(url, title, width, height, border, align) {
							$('#icon').val(url);					
							$('#preicon').attr('src',url);		
							editor.hideDialog();
						}
					});
				});
			});			
		});
	</script>	
	<script type="text/javascript">
	$(document).ready(function(){
		selectAuto();	
	});
    </script>
	<style>
	.icon{margin-bottom:15px;}
	</style>
	</head>	
	<div id="myModal" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	
    </div>
	<div class="modal fade" id="preModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	   <div class="modal-dialog">
		  <div class="modal-content">
			 <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">图标预览</h4>
			 </div>
			 <div class="modal-body">
				<div class="row" style="padding-bottom:15px;">
				    <div class="col-md-12" style="margin:0 auto;" align="center">
					        <img src="" width="128px" height="128px" id="preicon">
					</div>							
				</div>				
			 </div>
		  </div>
		</div>	
	</div>		
	<div class="modal fade" id="iconModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	   <div class="modal-dialog">
		  <div class="modal-content">
			 <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">请选择图标</h4>
			 </div>
			 <div class="modal-body">
				<div class="row" style="padding-bottom:15px;">
				    <div class="col-md-2 icon">
					    <a href="javascript:;" target="_self">
					        <img src="./Tpl/Qyapp/Workflow/images/icon/01.png" width="64px" height="64px">
						</a>
					</div>
				    <div class="col-md-2 icon">
					    <a href="javascript:;" target="_self">
					        <img src="./Tpl/Qyapp/Workflow/images/icon/02.png" width="64px" height="64px">
						</a>
					</div>
				    <div class="col-md-2 icon">
					    <a href="javascript:;" target="_self">
					        <img src="./Tpl/Qyapp/Workflow/images/icon/03.png" width="64px" height="64px">
						</a>
					</div>
				    <div class="col-md-2 icon">
					    <a href="javascript:;" target="_self">
					        <img src="./Tpl/Qyapp/Workflow/images/icon/04.png" width="64px" height="64px">
						</a>
					</div>
				    <div class="col-md-2 icon">
					    <a href="javascript:;" target="_self">
					        <img src="./Tpl/Qyapp/Workflow/images/icon/05.png" width="64px" height="64px">
						</a>
					</div>
				    <div class="col-md-2 icon">
					    <a href="javascript:;" target="_self">
					        <img src="./Tpl/Qyapp/Workflow/images/icon/06.png" width="64px" height="64px">
						</a>
					</div>					
				    <div class="col-md-2 icon">
					    <a href="javascript:;" target="_self">
					        <img src="./Tpl/Qyapp/Workflow/images/icon/07.png" width="64px" height="64px">
						</a>
					</div>							
				</div>				
			 </div>
			 <!-- <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary"> 确定</button>
			 </div> -->
		  </div>
		</div>	
	</div>	
	<div class="modal fade bs-modal-lg" id="range" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" style="width:760px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h4 class="modal-title">选择范围</h4>
				</div>
				<div class="modal-body" style="padding-bottom:0px;">	
					<div class="row">
						<div class="col-md-12" id="selectObj" style="margin-top:-20px;">													
						
						
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="queding" onclick="queding()" data-id="" data-num="">确定</button>									
					<button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
				</div>
			</div>
		</div>
	</div>	
	<section class="hbox stretch">
		<aside class="aside-md bg-white b-r" id="subNav">
		
	<div class="wrapper b-b header"><b>流程审批</b></div>
	<ul class="nav">
		<li class="b-b b-light open">
			<a href="<?php echo U('Workflow/index',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义流程</a>
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
					<p>新增自定义流程</p>
					<a class="text-muted pull-right m-t pointer" data-toggle="back" href="javascript:history.go(-1)" title="返回"><i class="fa fa-reply"></i></a>
				</header>
				<section class="scrollable  wrapper">
					<section class="panel panel-default">
						<div class="panel-body">
							<form class="form-horizontal form-validate" method="post" target="_self" action="<?php echo U('Workflow/add',array('mid'=>$_GET['mid']));?>">
								<div class="form-group">
									<label class="col-sm-2 control-label must">流程名称</label>
									<div class="col-sm-3 ">
										<input class="form-control" data-rule-required="true" type="text" value="" name="flow_name" id="flow_name" />
								    </div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label must">自定义图标</label>
									<div class="col-sm-3 ">
										<input class="form-control" data-rule-required="true" type="text" value="" name="icon" id="icon"/>                            
                                    </div>
									<div class="col-sm-1">
										<button type="button" class="btn btn-default js_delfield btn-sm" data-toggle="modal" data-target="#preModal">图标预览</button>
									</div>									
									<div class="col-sm-1">
										<button type="button" class="btn btn-default js_delfield btn-sm" data-toggle="modal" data-target="#iconModal">选择图标</button>
									</div>
									<div class="col-sm-1">
										<button type="button" class="btn btn-default js_delfield btn-sm" id="upload">上传图标</button>
									</div>
									
								</div>							
<!-- 								<div class="form-group">
									<label class="col-sm-2 control-label must">流程人员范围</label>
									<div class="col-sm-8 ">
										<input class="form-control" data-rule-required="true" data-toggle="tokeninputtree" name="flow_area" onclick="openModel()" placeholder="+请选择部门" type="text" value="" id="mydepart"/>                            
										<input  id="departId" type="hidden"  name="mydepartid"  value=""/>
									</div>

								</div> -->
<!-- 								<div class="form-group">
									<label class="col-sm-2 control-label must">适用范围</label>

									<div class="col-sm-3">
										<input type="text" class="form-control" data-rule-required="true" data-toggle="tokeninputtree" name="flow_area" id="depart" onclick="openModel()" data-selected-contact="" placeholder="+请选择相关部门" />
										 <input  id="departId" type="hidden"  name="departid"  value=""/>	
									</div>
								</div>	 -->							
								
								<div class="form-group">
									<label class="col-sm-2 control-label must">流程人员范围</label>

									<div class="col-sm-3">
										<input type="text" class="form-control" data-rule-required="true" data-toggle="tokeninputtree" name="flow_area" id="depart" onclick="openModel()" data-selected-contact="" placeholder="+请选择相关部门" />
										 <input  id="departId" type="hidden"  name="departid"  value=""/>	
									</div>
								</div>								
								
								<div id="js_custom_fields">
									<script type="text/html" id="js_custom_fields_tem">
									<div class="form-group" data-num="{{m}}">
										<label class="col-sm-2 control-label">自定义字段{{m}}</label>
										<div class="col-sm-2">
											<input type="text" class="form-control" name="field[{{m}}][name]" data-rule-required="true" placeholder="名称"/>
										</div>
										<label class="col-sm-1 control-label">类型</label>
										<div class="col-sm-2 ">
											<select class="form-control" name="field[{{m}}][type]" id="{{m}}" onchange="selectType($(this))" >
												<option value="1">单行文本</option>
												<option value="2">数字</option>
												<option value="3">日期</option>
												<option value="4">时间</option>
												<option value="5" data-type="select">下拉框</option>
												<option value="6">多行文本</option>
												<option value="7" data-type="select">图片上传</option>
												<option value="8" data-type="select">语音</option>
												<option value="9">单选按钮</option>
												<option value="10">复选框</option>												
											</select>
										</div>
										<div class="col-sm-2">
											<label class="checkbox-inline"><input type="checkbox" name="field[{{m}}][status]">是否必填</label>
										</div>
										<div class="col-sm-2">
											<button type="button" class="btn btn-default js_delfield btn-sm" onclick="delField($(this))">删除</button>
										</div>
									</div>
									</script>
									<script type="text/html" id="js_field_select_tem">
										<div class="col-sm-7 col-sm-offset-2 m-t" >
											<textarea rows="4" class="form-control" name="field[{{index}}][info]" placeholder='请输入下拉框选项（每个选项以半角逗号"，"隔开，100字以内）' data-rule-maxlength="100"></textarea>
										</div> 
									</script>
									<script type="text/html" id="js_field_select_radio">
										<div class="col-sm-7 col-sm-offset-2 m-t">
										<textarea rows="4" class="form-control" name="field[{{index}}][radio]" placeholder='请输入单选选项（每个选项以半角逗号"，"隔开，100字以内）' data-rule-maxlength="100"></textarea>
										</div>									
									</script>
									<script type="text/html" id="js_field_select_checkbox">
										<div class="col-sm-7 col-sm-offset-2 m-t" >
											<textarea rows="4" class="form-control" name="field[{{index}}][checkbox]" placeholder='请输入复选框选项（每个选项以半角逗号"，"隔开，100字以内）' data-rule-maxlength="100"></textarea>
										</div> 
									</script>									
								</div>
								<div class="form-group">
									<div class="col-sm-2 col-sm-offset-2">
										<button type="button" class="btn btn-default js_addfield btn-sm" onclick="addField()">添加自定义字段</button>
									</div>
								</div>
							   
								
								<div class="line line-dashed line-lg pull-in"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label must">审核人类型</label>

									<div class="col-sm-9">
										<label class="radio-inline"><input type="radio" checked value="1" name="audittype" onclick="auditType(1)">固定审核人</label>
										<label class="radio-inline"><input type="radio" value="2" name="audittype" onclick="auditType(2)">临时审核人</label>
									</div>
								</div>								
								
								<div id="autoComplete" class="js_audit_div">
									<div class="form-group" data-num="1">
										<label class="col-sm-2 control-label">第1级审核人</label>
										<div class="col-sm-2">
											 <select class="form-control js_audit_select" data-rule-required="true"  name="level[1][auditname]" onchange="selectAudit($(this))">
												<option value="">请选择</option>
												<option value="1">直接上级</option>
												<option value="3" data-type="assign">指定人员</option>
											</select>
										</div>
									</div>
									<script type="text/html" id="js_audit_tem">
										<div class="form-group" data-num="{{index}}">
											<label class="col-sm-2 control-label">第{{index}}级审核人</label>
											<div class="col-sm-2">
												<select class="form-control js_audit_select" name="level[{{index}}][auditname]" onchange="selectAudit($(this))">
													<option value="">请选择</option>
													<option value="1">直接上级</option>
													<option value="3" data-type="assign">指定人员</option>
												</select>
											</div>
											
											<div class="col-sm-1">
												<button type="button" class="btn btn-default js_delaudit btn-sm" onclick="delLevel($(this))">删除</button>
											</div>
										</div>
									</script>
									<script type="text/html" id="js_add_select">
										<div class="col-sm-3">
										 <input type="text" class="form-control js_select_people autoComplete"  data-toggle="tokeninputtree" name="level[{{index}}][auditselect]" data-rule-required="true"  placeholder="+请选择相关人"/>
											
										</div>
									</script>
								</div>							
								
<!-- 								<div id="autoComplete" class="js_audit_div">
									<div class="form-group" data-num="1">
										<label class="col-sm-2 control-label">第1级审核人</label>
										<div class="col-sm-2">
											 <select class="form-control js_audit_select" data-rule-required="true"  name="level[1][auditname]" onchange="selectAudit($(this))">
												<option value="">请选择</option>
												<option value="1">直接上级</option>
												<option value="3" data-type="assign">指定人员</option>
											</select>
										</div>
										
										
									</div>
									<script type="text/html" id="js_audit_tem">
										<div class="form-group" data-num="{{index}}">
											<label class="col-sm-2 control-label">第{{index}}级审核人</label>
											<div class="col-sm-2">
												<select class="form-control js_audit_select" name="level[{{index}}][auditname]" onchange="selectAudit($(this))">
													<option value="">请选择</option>
													<option value="1">直接上级</option>
													<option value="3" data-type="assign">指定人员</option>
												</select>
											</div>
											
											<div class="col-sm-1">
												<button type="button" class="btn btn-default js_delaudit btn-sm" onclick="delLevel($(this))">删除</button>
											</div>
										</div>
									</script>
									<script type="text/html" id="js_add_select">
										<div class="col-sm-3">
										 <input type="text" class="form-control js_select_people autoComplete"  data-toggle="tokeninputtree" name="level[{{index}}][auditselect]" data-rule-required="true"  placeholder="+请选择相关人"/>
											
										</div>
									</script>
								</div> -->
							   
								<div class="form-group" id="add-btm">
									<div class="col-sm-2 col-sm-offset-2">
										<button type="button" class="btn btn-default js_addaudit btn-sm" onclick="addLevel()">增加一级</button>
									</div>
								</div>
								
								<div class="line line-dashed line-lg pull-in"></div>
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">

										<button type="submit" class="btn btn-primary" data-alert="true"  data-loading-text="保存中...">保存</button>
										<button type="button" class="btn btn-default"  data-toggle="back" onclick="javascript:history.go(-1)">取消</button>
									</div>
								</div>
							</form>
						</div>
					</section>
				</section>
			</section>
	    <aside>
	</section>
<!-- 	<script>
    var i = 0;	
	var j = $('.js_audit_div').find('.form-group').attr('data-num');
	function addField(){
		var m = ++i;
		var data = {
		m: m,
		};	
		var html = template('js_custom_fields_tem', data);
		$('#js_custom_fields').append(html);
	}						 
	function selectType(obj){
		
		if(obj.parent().parent().find(':last-child').hasClass('col-sm-7')){
			obj.parent().siblings(':last').remove();
		}						
		index = obj.attr('id');
		var data = {	
		index: index,
		};	
		var val = obj.find('option:selected').val();							
		if(val == 5){
			if(!obj.parent().parent().find(':last-child').hasClass('col-sm-offset-2')){
				var html = template('js_field_select_tem',data);
				obj.parent().parent().append(html);								
			}
		}else if(val == 9){
			if(!obj.parent().parent().find(':last-child').hasClass('col-sm-offset-2')){
				var html = template('js_field_select_radio',data);
				obj.parent().parent().append(html);								
			}		    
		}else if(val == 10){
			if(!obj.parent().parent().find(':last-child').hasClass('col-sm-offset-2')){
				var html = template('js_field_select_checkbox',data);
				obj.parent().parent().append(html);								
			}		
		}
	}
	function delField(obj){
		obj.parent().parent().remove();
	}
	function addLevel(){
		var id = ++j;
		var data = {
		index: id,
		};	
		var html = template('js_audit_tem', data);
		$('.js_audit_div').append(html);
	}
	function delLevel(obj){
	    //alert('tttt');
		obj.parent().parent().remove();
	}	
	function selectAudit(obj){
		if(obj.parent().parent().find(':last-child').hasClass('col-sm-3')){
			obj.parent().siblings(':last').remove();
		}						
		var id = obj.parent().parent().attr('data-num');
		var data = {	
		index: id,
		};	
		var val = obj.find('option:selected').val();							
		if(val == 3){
			if(!obj.parent().parent().find(':last-child').hasClass('col-sm-3')){
				var html = template('js_add_select',data);
				obj.parent().parent().append(html);								
			}
			
		}	
		selectAuto();
	}

	function selectAuto(){
		 $.ajax({
			type:"POST",
			url:"index.php?g=Qyapp&m=Common&a=searchUsers&mid=<?php echo $_GET['mid'];?>",
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
					//alert('aaaaaaaaaaaaaa');
				});				
			  }
			  else
			  {
				  alert('删除失败');
			  }
			}
		}); 
			
	}	
	
	//function openModel1(){
	//    $('#myModal').load("<?php echo U('Common/department');?>",function(){
	//	$('#myModal').modal();
	//	$('#departname').attr("value",'');
	//	$('#departid').attr("value",'');		
	//	});
	//}
	
	function openModel(){
		$('#depart').attr("value",'');
		$('#departId').attr("value",'');
		
		$('#myModal').load("<?php echo U('Tree/myTree');?>", function(){
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
	    var departname = $('#departname').attr('value');
	    var departid = $('#departid').attr('value');
        $('#mydepart').attr('value',departname);
        $('#mydepartid').attr('value',departid);		
		$('#myModal').modal('hide');
		$('#myModal').empty();
	}

	</script>
	<script>
	$('body').on('change','.js_select_people1',function(){
	    var auditname = $(this).val();
		 $.ajax({
			type:"POST",
			url:"index.php?g=Qyapp&m=Common&a=isExist",
			data:"auditname="+auditname,
			dataType:'json',
			success:function(json){
			var status = json.status;
			  if(status==1)
			  {
			    return true;
			    //var data = json.data;	
                //alert('该审核人不存在，请输入正确的审核人');				
			  }
			  else
			  {
				  alert('该审核人不存在，请输入正确的审核人');
			  }
			}
		}); 
	});
	</script> -->
	<script type="text/javascript">
    $('.icon').click(function(){
	    var pic = $(this).find('img').attr('src');
		$('#icon').attr('value',pic);
		$('#preicon').attr('src',pic);	
		$('#iconModal').modal('hide');
		
	});
    </script>
	<script>
	function address(type,id,num){
		$("#range").modal('show');
		$('#queding').attr('data-id',id);
		$('#queding').attr('data-num',num);
		var selected = $('#'+id).attr('value');
		$('#selectObj').load("<?php echo U('Common/address',array('type'=>'"+type+"','sign'=>'"+id+"','selected'=>'"+selected+"'));?>");
	}	
	function queding(){
		$("#range").modal('hide');
		var id = $('#queding').attr('data-id');
		var num = $('#queding').attr('data-num');	
		//$('#list-'+id+' div.bg-circle').remove();
		var dept_id = '';
		var dept_name = '';
		var follow = '';
		var users_id = '';
		var users_name = '';
		$('#selected-dept li').each(function(){
			var id_1 = $(this).attr('id');
			var str_1 = id_1.replace('selected-dept-','');		
			var dept_name = $('#selected-dept-name-'+str_1).text().replace(/[\r\n]/g,"").trim();
            follow += dept_name+',';			
			users_id += id_1+',';
		});		
		$('#selected-users li').each(function(){
			var id_2 = $(this).attr('id');
			var str_2 = id_2.replace('selected-users-','');		
			var users_name = $('#selected-users-name-'+str_2).text().replace(/[\r\n]/g,"").trim();
            follow += users_name+',';			
			users_id += id_2+',';
		});	 		
		$('#'+id).attr('value',follow);
		$('#follow').attr('value',users_id);
	}
	String.prototype.trim=function() {
		return this.replace(/(^\s*)|(\s*$)/g,'');
	}	
	</script>	
		<script>
    var i = 0;	
	var j = $('.js_audit_div').find('.form-group').attr('data-num');
	function addField(){
		var m = ++i;
		var data = {
		m: m,
		};	
		var html = template('js_custom_fields_tem', data);
		$('#js_custom_fields').append(html);
	}						 
	function selectType(obj){
		
		if(obj.parent().parent().find(':last-child').hasClass('col-sm-7')){
			obj.parent().siblings(':last').remove();
		}						
		index = obj.attr('id');
		var data = {	
		index: index,
		};	
		var val = obj.find('option:selected').val();							
		if(val == 5){
			if(!obj.parent().parent().find(':last-child').hasClass('col-sm-offset-2')){
				var html = template('js_field_select_tem',data);
				obj.parent().parent().append(html);								
			}
		}else if(val == 9){
			if(!obj.parent().parent().find(':last-child').hasClass('col-sm-offset-2')){
				var html = template('js_field_select_radio',data);
				obj.parent().parent().append(html);								
			}		    
		}else if(val == 10){
			if(!obj.parent().parent().find(':last-child').hasClass('col-sm-offset-2')){
				var html = template('js_field_select_checkbox',data);
				obj.parent().parent().append(html);								
			}		
		}
	}
	function delField(obj){
		obj.parent().parent().remove();
	}
	function addLevel(){
		var id = ++j;
		var data = {
		index: id,
		};	
		var html = template('js_audit_tem', data);
		$('.js_audit_div').append(html);
	}
	function delLevel(obj){
	    //alert('tttt');
		obj.parent().parent().remove();
	}	
	function selectAudit(obj){
		if(obj.parent().parent().find(':last-child').hasClass('col-sm-3')){
			obj.parent().siblings(':last').remove();
		}						
		var id = obj.parent().parent().attr('data-num');
		var data = {	
		index: id,
		};	
		var val = obj.find('option:selected').val();							
		if(val == 3){
			if(!obj.parent().parent().find(':last-child').hasClass('col-sm-3')){
				var html = template('js_add_select',data);
				obj.parent().parent().append(html);								
			}
			
		}	
		selectAuto();
	}

	function selectAuto(){
		 $.ajax({
			type:"POST",
			url:"index.php?g=Qyapp&m=Common&a=searchUsers&mid=<?php echo $_GET['mid'];?>",
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
					//alert('aaaaaaaaaaaaaa');
				});				
			  }
			  else
			  {
				  alert('删除失败');
			  }
			}
		}); 
			
	}	
	
	//function openModel1(){
	//    $('#myModal').load("<?php echo U('Common/department');?>",function(){
	//	$('#myModal').modal();
	//	$('#departname').attr("value",'');
	//	$('#departid').attr("value",'');		
	//	});
	//}
	
	function openModel(){
		$('#depart').attr("value",'');
		$('#departId').attr("value",'');
		
		$('#myModal').load("<?php echo U('Tree/myTree');?>", function(){
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
	    var departname = $('#departname').attr('value');
	    var departid = $('#departid').attr('value');
        $('#mydepart').attr('value',departname);
        $('#mydepartid').attr('value',departid);		
		$('#myModal').modal('hide');
		$('#myModal').empty();
	}
	function auditType(type){
	    if(type == 1){
		    $('#autoComplete').show();
			$('#add-btm').show();
		}else if(type == 2){
		    $('#autoComplete').hide();
			$('#add-btm').hide();		    
		}
	}
	</script>
	<script>
	$('body').on('change','.js_select_people1',function(){
	    var auditname = $(this).val();
		 $.ajax({
			type:"POST",
			url:"index.php?g=Qyapp&m=Common&a=isExist",
			data:"auditname="+auditname,
			dataType:'json',
			success:function(json){
			var status = json.status;
			  if(status==1)
			  {
			    return true;
			    //var data = json.data;	
                //alert('该审核人不存在，请输入正确的审核人');				
			  }
			  else
			  {
				  alert('该审核人不存在，请输入正确的审核人');
			  }
			}
		}); 
	});
	</script>
	<script type="text/javascript">
    $('.icon').click(function(){
	    var pic = $(this).find('img').attr('src');
		$('#icon').attr('value',pic);
		$('#preicon').attr('src',pic);	
		$('#iconModal').modal('hide');
		
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