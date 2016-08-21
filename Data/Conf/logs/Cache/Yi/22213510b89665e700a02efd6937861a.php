<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn" class="app fadeInUp animated">
<head>
    <meta charset="utf-8" />
    <title>微易科技</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta content="" name="Keywords" />
    <meta content="" name="Description" />
	<link href="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./Tpl/Qyapp/Static/Css/animate.min.css" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/font-awesome.min.css" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/style.min.css" rel="stylesheet">
	<script src="./Tpl/Qyapp/Static/Js/jquery-1.9.1.min.js" type="text/javascript"></script>
</head>
<body>
    <section class="vbox">
<header class="header bg-white b-b b-light">
<p>邮箱设置</p>
<a class="text-muted pull-right m-t pointer" href="javascript:history.go(-1)" title="返回" data-toggle="back">
<i class="fa fa-reply"></i>
</a>
</header>		
        <section class="scrollable wrapper">
            <section class="panel panel-default">
                <div class="panel-body">
                    <div class="form-horizontal form-validate" >
                        <div class="form-group">
						
					 <form id="myform" action="<?php echo U('Admin/insert');?>" method="post">
                            <label class="col-sm-2 control-label must">SMTP邮箱</label>
                            <div class="col-sm-3">
                                <input type="text" name="email_server" value="<?php echo C('email_server');?>" class="form-control" data-rule-required="true" data-rule-rangelength="[1,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">系统发件邮箱</label>
                            <div class="col-sm-3">
                                <input type="text" id="new_password" name="email_user" value="<?php echo C('email_user');?>" class="form-control" data-rule-required="true" data-rule-rangelength="[6,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">发件邮箱密码</label>
                            <div class="col-sm-3">
                                <input type="text" name="email_pwd" value="<?php echo C('email_pwd');?>" id="new_password_verify" class="form-control" data-rule-equalTo="#new_password" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						<div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">邮件发送端口</label>
                            <div class="col-sm-3">
                                <input type="text" name="email_port" value="<?php echo C('email_port');?>" id="new_password_verify" class="form-control"  />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						
						<div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">邮件邮件标题</label>
                            <div class="col-sm-3">
                                <input type="text" name="pwd_email_title" value="<?php echo C('pwd_email_title');?>" id="new_password_verify" class="form-control" data-rule-equalTo="#new_password" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						<div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">邮件提醒内容</label>
                            <div class="col-sm-3">
                                <input type="text" name="pwd_email_content" value="<?php echo C('pwd_email_content');?>" id="new_password_verify" class="form-control" data-rule-equalTo="#new_password" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						<div class="line line-dashed line-lg pull-in"></div>
						<div class="form-group">
                            <label class="col-sm-2 control-label must">状态：</label>
                            <div class="col-sm-3 ">
                                 <div class="pull-left m-t-sm" id="mySwitch" style="width:500px;"> 
								
									<label><input type="radio" name="email_status" value="1" <?php if(C('email_status')=='1')echo checked; ?> />开启 </label>
									<label><input type="radio" name="email_status" value="0" <?php if(C(email_status)=='0')echo checked; ?> />关闭 </label>
									
									
									</div>
                            </div>
                        </div>
						 <input type="hidden" name="files" value="email.php" />
						 
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
								<button type="submit" class="btn btn-primary" id="submit" data-loading-text="保存中..." >保存</button>
                                <button type="button" class="btn btn-default" data-toggle="back">取消</button>
                            </div>
							</form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

</html>