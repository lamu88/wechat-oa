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
            <li ><a class="item" href="<?php echo U('index');?>">首页</a></li>
            <li><a class="item" href="<?php echo U('service');?>">套餐</a></li>
            <li><a class="item" href="<?php echo U('help');?>">帮助</a></li>
            <li><a class="item" href="<?php echo U('agent');?>">渠道代理</a></li>
            <li class="active"><a class="item" href="<?php echo U('about');?>">关于我们</a></li>
            <li class="register-item"><a class="btn primary" href="<?php echo U('register');?>">注册</a></li>
            <li class="login-item"><a class="btn login" href="<?php echo U('login');?>">登录</a></li>
        </ul>
    </div>
</div>    </div>
    <div class="bodyer abouts-biggest">
        <div class="w1170 about-box">
            <div >
                
                <ul class="pic">
                    <li>
                        <img src="./Tpl/Weiyi/Weiyi/Images/aboutUs-banner1.jpg">
                    </li>
                </ul>
            </div>
            <div class="aboutUs-info">
                <div class="abouts-info-left">
                    <span class="about-ico icon1"></span>
                    <h2>深度简介</h2>
                </div>
                <div class="abouts-info-right">
                    <p class="mb30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;企业号,让工作更简单、高效，爱工作365天。是基于微信企业号，以任务管理为核心，提供报销、请假、签到、邮箱、招聘、名片、通知、调研、投票、外勤、会议室、通讯录、日程等多项社交管理应用为一体的移动协作平台。</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;企业号不仅避免了传统办公信息化系统操作复杂、维护成本高、使用频次低、受时间地域约束等一系列问题，还为商家提供了时尚有趣的移动办公应用以及银行级数据安全保障。让您的团队无论在何时何地，都可以快速、便捷、高效的处理各项事务。爱上工作从此开始！</p>
                </div>
            </div>
            <ul class="about-bg clearfix">
                <li>
                    <div class="about-bg-list img1-1">
                        <p>中国最佳微应用服务商奖杯</p>
                    </div>
                </li>
                <li>
                    <div class="about-bg-list img1-2">
                        <p>入驻商家已突破50万家</p>
                    </div>
                </li>
                <li>
                    <div class="about-bg-list img1-3">
                        <p>全球代理商已突破700家</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    
<div class="footer">
    <div class="foot-content w1170 clearfix">
        <div class="foot-logo"><img src="<?php echo ($webinfo["site_logo"]); ?>" ></div>
        <div class="foot-info">
            <dl class="about-us">
                <dt>关于</dt>
                <dd><a href="<?php echo U('about');?>">关于我们</a></dd>
                
            </dl>
             <dl class="cooperation">
                <dt>合作</dt>
                <dd>QQ交流群：451493529</dd>
				<dd>版权归属：深度实业集团网络科技有限公司</dd>
				
                <dd>地址：中国-安徽-淮北</dd>
            </dl>
            <!-- <dl class="contact-us">
                <dt>联系我们</dt>
                <dd>热线：<?php echo ($webinfo["site_tel"]); ?></dd>
                <dd>反馈：<a href="mailto:lanrain@wxopen.cn"><?php echo ($webinfo["site_email"]); ?></a></dd>
                <dd>招聘：<a href="mailto:lanrain@wxopen.cn"><?php echo ($webinfo["site_email"]); ?></a></dd>
            </dl> -->
        </div>
    </div>
    <p class="copyright">Copyright © 2014-2014  All Rights Reserved <?php echo ($webinfo["site_ipc"]); ?>2</p>


    <!--feedback dialog start-->
  
    <!--feedback dialog end-->

</div>    <!-- Modal -->

<div id="fixed-icons" class="fixed-icons"><a href="" target="_blank" class="consulting"><span>在线咨询</span></a><ul><li class="icon2">免费电话<p>400-0503-365<i></i></p></li><li class="icon3" id="modal-box1">我要反馈</li><li class="icon4"><img src="./Tpl/Weiyi/Weiyiabout_files/two-dim-code.png"></li><li class="icon5" title="回到顶部" style="display:none;"></li></ul></div></body></html>