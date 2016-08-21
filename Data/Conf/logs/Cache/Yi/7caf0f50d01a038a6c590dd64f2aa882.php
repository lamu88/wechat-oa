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
<p>短信设置</p>
<a class="text-muted pull-right m-t pointer" href="javascript:history.go(-1)" title="返回" data-toggle="back">
<i class="fa fa-reply"></i>
</a>
</header>		
        <section class="scrollable wrapper">
            <section class="panel panel-default">
                <div class="panel-body">
                    <div class="form-horizontal form-validate" >
                       
						
					
					 <form id="myform" action="<?php echo U('Admin/insert');?>" method="post">
					  <div class="form-group">
                            <label class="col-sm-2 control-label must">短信注册</label>
                            <div class="col-sm-3">
                                <a href='http://www.smsbao.com/reg?r=33012'>点击注册</a>
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">短信账号</label>
                            <div class="col-sm-3">
                                <input type="text"  name="username" value="<?php echo C('username');?>" class="form-control" data-rule-required="true" data-rule-rangelength="[6,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">短信密码</label>
                            <div class="col-sm-3">
                                <input type="text" name="psd"  value="<?php echo C('psd');?>" class="form-control" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
						<input type="hidden" name="files" value="sms.php" />
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