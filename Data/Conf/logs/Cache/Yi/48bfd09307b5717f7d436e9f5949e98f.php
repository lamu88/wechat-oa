<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>后台登陆</title>
<link href="./Tpl/Yi/Public/css/login.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	background-color: #666666;
	background-image: url("");
	background-repeat: no-repeat;
	background-position: center top;
	background-attachment: fixed;
	background-clip: border-box;
	background-size: cover;
	background-origin: padding-box;
	width: 100%;
	padding: 0;
}
</style>
</head>
<body style="background-image: url(./Tpl/Yi/Public/css/bg_4.jpg);">
<div class="bg-dot"></div>
<div class="login-layout">
  <div class="top">
    <h5>微易科技企业号系统<em></em></h5>
    <h2>平台管理中心</h2>
    </div>
  <div class="box">
    <form method="post" action="<?php echo U('checklogin');?>" id="form_login">
      <span>
      <label>帐号</label>
      <input name="username" id="user_name" autocomplete="off" type="text" class="input-text" required="">
      </span> <span>
      <label>密码</label>
      <input name="password" id="password" class="input-password" autocomplete="off" type="password" required="" >
      </span> <span>
     <span>
      <input name="" class="input-button" type="submit" value="登录">
      </span>
    </form>
  </div>
</div>
<div class="bottom">
  <h5>Powered by 武汉微易科技</h5>
  <h6 title="">© 2013-2014 <a href="" target="_blank">武汉微易科技</a></h6>
</div>
</body></html>