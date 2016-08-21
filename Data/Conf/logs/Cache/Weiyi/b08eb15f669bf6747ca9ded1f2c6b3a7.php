<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class=" js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
   <title><?php echo ($webinfo["site_title"]); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content=" <?php echo ($webinfo["keyword"]); ?> " name="Keywords">
    <meta content="<?php echo ($webinfo["content"]); ?>" name="Description">
	<link href="./Tpl/Weiyi/Weiyi/Css/webSite.css" rel="stylesheet">
    <link rel="shortcut icon" href="./Tpl/Weiyi/Weiyi/Images/favicon.jpg">
</head>
<body>
    <div class="header">
        <div class="hd-box clearfix w1170">
    <div class="logo">
        <a  href="javascript:void(0);">
             <img src="<?php echo ($webinfo["site_logo"]); ?>" >
        </a>
    </div>
    <div class="nav-box">
        <ul class="nav-list">
            <li class="active"><a class="item" href="<?php echo U('Weiyi/index');?>">首页</a></li>
            <li><a class="item" href="<?php echo U('service');?>">套餐</a></li>
            <li><a class="item" href="<?php echo U('help');?>">帮助</a></li>
            <li><a class="item" href="<?php echo U('agent');?>">渠道代理</a></li>
            <li><a class="item" href="<?php echo U('about');?>">关于我们</a></li>
            <li class="register-item"><a class="btn primary" href="<?php echo U('register');?>">注册</a></li>
            <li class="login-item"><a class="btn login" href="<?php echo U('login');?>">登录</a></li>
        </ul>
    </div>
</div>    </div>
    <div class="bodyer">
        <div class="bodyer-p">
            <div class="banner_box">
                <img class="img_bg" src="./Tpl/Weiyi/Weiyi/Images/login_banner.jpg" >
                <div class="login_box">
                    <img src="<?php echo ($webinfo["site_logo"]); ?>" >
                    <div class="form-hint">
                        <div id="hintInfo" class="hint-box">您输入的帐号或密码不正确</div>
                        <div id="emptyInfo" class="hint-box">帐号或密码不能为空</div>
                    </div>
                    <form data-action="/login" action="/index.php?g=Weiyi&m=Weiyi&a=checklogin" method="post" id="login-form">
                        <p class="bor_bot">
                            <span class="login-ico ico1"></span>
                            <input type="text" id="username" class="username" name="username" placeholder="账号" style="width: 300px;">
                        </p>
                        <p class="bor_bot mt20">
                            <span class="login-ico ico2"></span>
                            <input type="password" id="password" class="password" name="password" placeholder="密码" style="width: 300px;">
                        </p>
                        <p class="rem">
                            <input type="checkbox" id="rem_pwd" name="rem_pwd" value="0">
                            <label for="rem_pwd">记住账号</label>
                            <a class="a1" href="<?php echo U('register');?>" target="_blank">免费注册</a>
                            <a class="a2" href="<?php echo U('Weiyi/forgotpwd');?>" target="_blank">忘记密码</a>
                        </p>
                        <input class="sub mt30" type="submit" value="登录" id="login-submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<div class="footer">
    <div class="foot-content w1170 clearfix">
        <div class="foot-logo"><img src="<?php echo ($webinfo["site_logo"]); ?>" ></div>
        <div class="foot-info">
            <dl class="about-us">
                <dt>关于</dt>
                <dd><a href="./about.html">关于我们</a></dd>
                
            </dl>
            <dl class="cooperation">
                <dt>合作</dt>
                <dd>商务合作： <?php echo ($webinfo["site_tel"]); ?></dd>
                <dd>地址： <?php echo ($webinfo["address"]); ?></dd>
            </dl>
            <dl class="contact-us">
                <dt>联系我们</dt>
                <dd>热线：<?php echo ($webinfo["site_tel"]); ?></dd>
                <dd>反馈：<a href="mailto:lanrain@wxopen.cn"><?php echo ($webinfo["site_email"]); ?></a></dd>
                <dd>招聘：<a href="mailto:lanrain@wxopen.cn"><?php echo ($webinfo["site_email"]); ?></a></dd>
            </dl>
        </div>
    </div>
    <p class="copyright">Copyright © 2014-2014  All Rights Reserved <?php echo ($webinfo["site_ipc"]); ?>2</p>


    <!--feedback dialog start-->
  
    <!--feedback dialog end-->

</div>    <!-- Modal -->

<div id="fixed-icons" class="fixed-icons"><a href="" target="_blank" class="consulting"><span>在线咨询</span></a><ul><li class="icon2">免费电话<p>400-0503-365<i></i></p></li><li class="icon3" id="modal-box1">我要反馈</li><li class="icon4"><img src="./Tpl/Weiyi/login_files/two-dim-code.png"></li><li class="icon5" title="回到顶部" style="display:none;"></li></ul></div></body></html>