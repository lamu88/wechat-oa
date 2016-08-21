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
	<link href="./Tpl/Qyapp/Static/Js/city/css/cityLayout.css" type="text/css" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Js/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">	
	<script src="./Tpl/Qyapp/Static/Js/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/js/bootstrap.min.js"></script>	
	<script src="./Tpl/Qyapp/Static/Js/artTemplate/dist/template.js" type="text/javascript"></script>	
	<script charset="utf-8" src="./Tpl/static/kindeditor/kindeditor-min.js"></script>
	<script charset="utf-8" src="./Tpl/static/kindeditor/lang/zh_CN.js"></script>
	<link rel="stylesheet" href="./Tpl/static/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="./Tpl/Qyapp/Static/Css/uploadify.min.css" />
	<script type="text/javascript">
		KindEditor.ready(function(K) {
			var editor;
			editor = K.create('textarea[name="info"]', {
				resizeType : 0,
				allowPreviewEmoticons :false,
				allowImageUpload :true,
				uploadJson:'<?php echo U("Adminupload/uploadType",array("is_url"=>1,"file_type"=>"image"));?>',
				formatUploadUrl:false,
				items : [
					'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
					'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
					'insertunorderedlist', '|', 'emoticons', 'image', 'link']
			});		
		});	
	</script>
	<section class="hbox stretch"> 
        <aside class="aside-md bg-white b-r" id="subNav">
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
        <header class="header bg-white b-b b-light">
            <p>添加职位</p>
            <a class="text-muted pull-right m-t pointer" data-toggle="back" href="javascript:history.go(-1)" title="返回"><i class="fa fa-reply"></i></a>
        </header>
        <section class="scrollable  wrapper">
            <section class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal form-validate" method="post" target="_self"  action="<?php echo U('Hiring/addPosition',array('mid'=>$_GET['mid']));?>">  				
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">部门</label>
                            <div class="col-sm-3 ">
                                  <input type="text" class="form-control" data-token-limit="1" data-rule-required="true" value="" data-toggle="tokeninputtree" name="department" data-selected="[]"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">职位名称</label>
                            <div class="col-sm-3 ">
                                <input type="text" class="form-control"  data-rule-required="true" name="postname" value=""  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">招聘人数</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="num" data-rule-digits="true" value="" />
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">工作地点</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="place" data-rule-digits="true" value="" />
                            </div>
                        </div>						
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">薪资待遇</label>
                            <div class="col-sm-3 ">
                                 <select name="salary" class="form-control set-select" data-rule-required="true">
                                    <option value="" >请选择薪资区间</option>
                                    <option value="1" >1000元/月以下</option>
                                    <option value="2" >1000-2000元/月</option>
                                    <option value="3" >2001-4000元/月</option>
                                    <option value="4" >4001-6000元/月</option>
                                    <option value="5" >6001-8000元/月</option>
                                    <option value="6" >8001-10000元/月</option>
                                    <option value="7" >10001-15000元/月</option>
                                    <option value="8" >15000-25000元/月</option>
                                    <option value="9" >25000元/月以上</option>
                                    <option value="set" >自定职位月薪范围</option>
                                    <option value="0" >面议</option>
                                </select>
                            </div>
                            <div class='col-sm-7 set-div-show hide'>  
                                <div class="col-sm-3">
                                    <div class="input-group">
                                      <input class="form-control" type="text" name="salary1" data-rule-positive="true" value="" >
                                      <div class="input-group-addon">元</div>
                                    </div>
                                </div>
                                <div class="col-sm-1" style="width:20px;padding:0">
                                    <p class="form-control-static">--</p>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                      <input class="form-control" type="text" name="salary2" data-rule-positive="true" value="" >
                                      <div class="input-group-addon">元</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">工作性质</label>
                            <div class="col-sm-3">
                                <select name="nature" class="form-control">
                                    <option value="CNY">全职</option>
                                    <option value="USD">兼职</option>
                                    <option value="HKD">实习</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">学历要求</label>
                            <div class="col-sm-3">
                                <select name="education" class="form-control">
                                    <option value="0">不限</option>
                                    <option value="1">大专</option>
                                    <option value="2">本科</option>
                                    <option value="3">硕士</option>
                                    <option value="4">博士</option>
                                    <option value="5">MBA</option>
                                    <option value="6">EMBA</option>
                                    <option value="7">中专</option>
                                    <option value="8">中技</option>
                                    <option value="9">高中</option>
                                    <option value="10">初中</option>
                                    <option value="11">其他</option>
                                </select>

                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="col-sm-2 control-label">工作经验</label>
                            <div class="col-sm-3">
                                <select name="experience" class="form-control set-select" onchange="expSelect()">
                                    <option value="0">不限</option>
                                    <option value="1">无经验</option>
                                    <option value="2">1年以下</option>
                                    <option value="3">1-3年</option>
                                    <option value="4">3-5年</option>
                                    <option value="5">5-10年</option>
                                    <option value="6">10年以上</option>
                                    <option value="set">自定义</option>
                                </select>
                            </div>
                            <div class="col-sm-3 set-div-show hide" id="exphide"> 
                                <div class="col-sm-5">
                                    <div class="input-group">
                                      <input class="form-control" type="text" name="experience1" data-rule-positive="true" value="" >
                                      <div class="input-group-addon">年</div>
                                    </div>
                                </div>
                                <div class="col-sm-1" >
                                    <p class="form-control-static">--</p>
                                </div>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                      <input class="form-control" type="text" name="experience2" data-rule-positive="true" value="" >
                                      <div class="input-group-addon">年</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label class="checkbox inline"><input type="checkbox">具有管理经验</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">职位描述</label>
                            <div class="col-sm-8 ">
                                <textarea rows="4" class="form-control" data-toggle="kindeditor" data-rule-rangelength="[1,10000]" data-rule-required="true" data-msg-required="职位描述不能为空" name="info">
								</textarea>
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">结束时间</label>
                            <div class="col-sm-3">
                                   <div class="input-group"> <input type="text" class="form-control" name="end_time" id="form_datetime" data-rule-required="true" value="" readonly="readonly" data-toggle="datepicker" data-startdate="now" /><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div> 
                            </div>
                        </div>
	                <script src="./Tpl/Qyapp/Static/Js/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>					
					<script src="./Tpl/Qyapp/Static/Js/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" type="text/javascript"></script>  
					<script type="text/javascript">
						$("#form_datetime").datetimepicker({
							format: 'yyyy-mm-dd hh:ii',
							language: 'zh-CN',					
						
						});
					</script>											
                        <div class="form-group">
                            <label class="col-sm-2 control-label">接收简历邮箱</label>
                            <div class="col-sm-3 ">
                               <input type="text" class="form-control" name="defaultemail[value]" data-rule-email="true"  value="<?php echo ($email_value); ?>" />
                            </div>
                             <div class="col-sm-2">
                                <label class="checkbox inline"><input type="checkbox" <?php if($email_status == 'on'): ?>checked="checked"<?php endif; ?> name="defaultemail[status]" >作为默认邮箱</label>
                            </div>
                        </div>
                        <div class="form-group">
                        	<label class="col-sm-2 control-label">职位列表排序序号</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="disorder" data-rule-digits="true"  value="" />
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">通知</label>
                            <div class="col-sm-3">
                                 <input type="text" class="form-control" data-toggle="tokeninputtree"  value="<?php echo ($reward_value["ndepartment"]); ?>" name="defaultreward[value][ndepartment]" data-path="/wAddressList/getDepartment"  data-selected="[]"/>
                            </div>
                             <div class="col-sm-5">
                                <p class="form-control-static"><label class="checkbox-inline"><input type="checkbox" <?php if($reward_value['notice'] == 'on'): ?>checked="checked"<?php endif; ?> name="defaultreward[value][notice]"  />开启（开启后，系统将告知员工新增此招聘职位）</label></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">分享悬赏</label>
                            <div class="col-sm-3">
                                <select name="defaultreward[value][shares]" class="form-control js_select_money">
                                    <option value="0" <?php if($reward_value['shares'] == 0): ?>selected="selected"<?php endif; ?> >随机红包</option>
                                    <option value="1" <?php if($reward_value['shares'] == 1): ?>selected="selected"<?php endif; ?> >自定义红包金额</option>
                                    <option value="2" <?php if($reward_value['shares'] == 2): ?>selected="selected"<?php endif; ?> >不给红包</option>
                                </select>
                            </div>
                            <div class="col-sm-1" >
                               <input type="text" class="form-control" name="defaultreward[value][shareset]"  value="<?php echo ($reward_value['shareset']); ?>" data-rule-positive="true">
                            </div>
                             <div class="col-sm-3" >
                                <p class="form-control-static"> 
								<?php if($reward_value['shares'] == 0): ?><span class="js_ceiling">上限</span><?php endif; ?>
								<?php if($reward_value['shares'] == 1): ?>元<?php endif; ?>
								<?php if($reward_value['shares'] == 2): endif; ?>
								</p>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">收到简历悬赏</label>
                            <div class="col-sm-3">
                                <select name="defaultreward[value][resume]" class="form-control js_select_money">
                                    <option value="0" <?php if($reward_value['resume'] == 0): ?>selected="selected"<?php endif; ?> >随机红包</option>
                                    <option value="1" <?php if($reward_value['resume'] == 1): ?>selected="selected"<?php endif; ?>>自定义红包金额</option>
                                    <option value="2" <?php if($reward_value['resume'] == 2): ?>selected="selected"<?php endif; ?>>不给红包</option>
                                </select>
                            </div>
                            <div class="col-sm-1" >
                               <input type="text" class="form-control" name="defaultreward[value][resumeset]"  value="<?php echo ($reward_value['resumeset']); ?>" data-rule-positive="true">
                            </div>
                             <div class="col-sm-3" >
                                <p class="form-control-static">
								<?php if($reward_value['resume'] == 0): ?><span class="js_ceiling">上限</span><?php endif; ?>
								<?php if($reward_value['resume'] == 1): ?>元<?php endif; ?>
								<?php if($reward_value['resume'] == 2): endif; ?>								
								</p>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">成功录用悬赏</label>
                            <div class="col-sm-3">
                                <select name="defaultreward[value][employed]" class="form-control js_select_money">
                                    <option value="0" <?php if($reward_value['employed'] == 0): ?>selected="selected"<?php endif; ?> >随机红包</option>
                                    <option value="1" <?php if($reward_value['employed'] == 1): ?>selected="selected"<?php endif; ?> >自定义红包金额</option>
                                </select>
                            </div>
                             <div class="col-sm-1">
                               <input type="text" class="form-control" name="defaultreward[value][employedset]"  value="<?php echo ($reward_value['employedset']); ?>" data-rule-positive="true">
                            </div>
                             <div class="col-sm-3">  
                                <p class="form-control-static">
								<?php if($reward_value['employed'] == 0): ?><span class="js_ceiling">上限</span><?php endif; ?>
								<?php if($reward_value['employed'] == 1): ?>元<?php endif; ?>								
								</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3 col-sm-offset-2"><label class="checkbox inline"><input type="checkbox" <?php if($reward_status == 'on'): ?>checked="checked"<?php endif; ?> name="defaultreward[status]" >均作为默认设置</label></div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-3 col-sm-offset-2"><label class="checkbox inline"><input type="checkbox" <?php if($fill_status == 'on'): ?>checked="checked"<?php endif; ?> name="defaultfill[status]">均作为默认设置（<small>姓名／联系电话为必填项</small>）</label></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">申请职位的填写项</label>
                             <div class="col-sm-9">
							     <?php if(is_array($fill_default)): $k = 0; $__LIST__ = $fill_default;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fill_default): $mod = ($k % 2 );++$k;?><label class="checkbox-inline"><input type="checkbox"  name="defaultfill[default][<?php echo ($k); ?>][status]" <?php if($fill_default['status'] == 'on'): ?>checked="checked"<?php endif; ?> ><?php echo ($fill_default["name"]); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>								
								<?php if(is_array($fill_defaults)): $k = 0; $__LIST__ = $fill_defaults;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fill_defaults): $mod = ($k % 2 );++$k;?><input name="defaultfill[default][<?php echo ($k); ?>][name]" value="<?php echo ($fill_defaults["name"]); ?>" type="hidden" /><?php endforeach; endif; else: echo "" ;endif; ?>								
                                                              
                                <label class="checkbox-inline" id="addOption"><input type="checkbox"  name="setapplypost" id="setapplypost" onclick="addLabel()">自定义</label>
                            </div>
                            <script type="text/html" id="addApplypost">
                                <label class="checkbox-inline"><input type="checkbox" checked style="display:inline-block;margin-top:20px" name="defaultfill[add][{{index}}][status]"><div class="form-group has-feedback" style="display:inline-block;width:100px;margin:10px"><input type="text" class="form-control" name="defaultfill[add][{{index}}][name]" data-rule-required="true"><i class="fa fa-times form-control-feedback delsetapplypost" style="right:0px" onclick="delLabel($(this))"></i></div></label>
                            </script>
                            <script type="text/html" id="myApplypost">
							{{each list as value i}}							
                                <label class="checkbox-inline"><input type="checkbox" {{if value.status == 'on'}}checked{{/if}} style="display:inline-block;margin-top:20px" name="defaultfill[add][{{i}}][status]"><div class="form-group has-feedback" style="display:inline-block;width:100px;margin:10px"><input type="text" class="form-control" name="defaultfill[add][{{i}}][name]" value="{{value['name']}}" data-rule-required="true"><i class="fa fa-times form-control-feedback delsetapplypost" style="right:0px" onclick="delLabel($(this))"></i></div></label>
							{{/each}}	                            
							</script>							
                        </div>                       
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <input type="hidden" name="method" id="method" />
                                <button type="submit" data-toggle="method" data-method="release" class="btn btn-primary" data-confirm="false" data-loading-text="保存中...">保存发布</button>
                                <button type="submit" data-toggle="method" data-method="save" class="btn btn-default" data-confirm="false" data-loading-text="保存中...">仅保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </section>
    </section>	
	</aside>
	    </section>	
<script>
var audit1 =<?php echo $fill_add;?>;
//alert(audit1);
var data1 = {
	list:audit1,
};
var html1 = template('myApplypost', data1);
$('#addOption').before(html1);
</script>
<script>
function expSelect(){
    if($('select[name="experience"]').val() == 'set'){
	    $('#exphide').removeClass('hide');
	}else{
	    $('#exphide').addClass('hide');
	}
}
$('.js_select_money').on('change',function(){
    if($(this).val() == 0){
	    $(this).parent().siblings('.col-sm-1').css('display','block');
		$(this).parent().siblings('.col-sm-3').css('display','block');
		$(this).parent().siblings('.col-sm-3').children().children().css('display','inline');
	}else if($(this).val() == 1){
	    $(this).parent().siblings('.col-sm-1').css('display','block');
		$(this).parent().siblings('.col-sm-3').css('display','block');
		$(this).parent().siblings('.col-sm-3').children().children().css('display','none');	
	}else if($(this).val() == 2){
	    $(this).parent().siblings('.col-sm-1').css('display','none');
		$(this).parent().siblings('.col-sm-3').css('display','none');
	}
});
</script>
<script>
var i = 0;	
function addLabel(){
	var id = i++;
	var data = {	
	index: id,
	};	
	var html = template('addApplypost', data);
	$('#setapplypost').parent().before(html);
	$('#setapplypost').attr('checked',false);
}
function delLabel(obj){
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



</body></html>