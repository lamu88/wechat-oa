<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo ($webinfo["site_title"]); ?>管理后台</title>
  <meta name="description" content="这是一个 index 页面">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="./Tpl/Yi/assets/css/amazeui.min.css"/>
  <link rel="stylesheet" href="./Tpl/Yi/assets/css/admin.css">
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <strong></strong> <small>后台管理平台</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <!-- <li><a href="javascript:;"><span class="am-icon-envelope-o"></span> 收件箱 <span class="am-badge am-badge-warning">5</span></a></li> -->
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="<?php echo U('userinfo');?>" target="menuFrame"><span class="am-icon-user"></span> 个人中心</a></li>
          <li><a href="<?php echo U('Public/loginout');?>"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
     <!--  <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li> -->
    </ul>
  </div>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        <li><a href="<?php echo U('index');?>"><span class="am-icon-home"></span> 首页</a></li>
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav1'}"><span class="am-icon-cogs"></span> 站点管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-nav1">
            <li><a href="<?php echo U('website');?>" class="am-cf" target="menuFrame"><span class="am-icon-check"></span> 站点设置</a></li>
			<li><a href="<?php echo U('login');?>" class="am-cf" target="menuFrame"><span class="am-icon-check"></span> 企业号登录</a></li>
		<li><a href="<?php echo U('Appstore/version');?>" target="menuFrame"><span class="am-icon-th"></span> 版本升级</a></li>
            <li><a href="<?php echo U('userinfo');?>" target="menuFrame"><span class="am-icon-puzzle-piece"></span> 个人中心</a></li>
          </ul>
        </li>

        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav2'}"><span class="am-icon-user"></span> 用户管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-nav2">
            <li><a href="<?php echo U('User/userlist');?>" class="am-cf" target="menuFrame"><span class="am-icon-check"></span> 前台用户</a></li>
            <li><a href="<?php echo U('User/user_node');?>" target="menuFrame"><span class="am-icon-puzzle-piece"></span> 用户等级</a></li>
          </ul>
        </li> 	
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav3'}"><span class="am-icon-briefcase"></span> 应用管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-nav3">
            <li><a href="<?php echo U('App/appcenter');?>" class="am-cf" target="menuFrame"><span class="am-icon-check"></span> 应用列表</a></li>
            
			<li ><a href="<?php echo U('App/suite');?>" target="menuFrame"><span class="am-icon-check"></span>套件管理</a></li>
          </ul>
        </li>		
		
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav4'}"><span class="am-icon-th"></span> 扩展管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub" id="collapse-nav4">
            <li><a href="javascript:;" class="am-cf" target="menuFrame"><span class="am-icon-check"></span> 充值记录</a></li>
            <li><a href="javascript:;"><span class="am-icon-puzzle-piece" target="menuFrame"></span> 用户案例</a></li>
            <li><a href="javascript:;"><span class="am-icon-th" target="menuFrame"></span> 友情链接</a></li>
          </ul>
        </li>	
      </ul>

       <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 公告</p>
          <p>版本正在更新中。。。</p>
        </div>
      </div> 

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><!-- <span class="am-icon-tag"></span> --> &nbsp;</p>
          <p>&nbsp;</p>
        </div>
      </div>
    </div>
  </div>
  <!-- sidebar end -->

  <!-- content start -->
  <div class="admin-content">
<!-- 
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>一些常用模块</small></div>
    </div>

    <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><a href="#" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br/>新增页面<br/>2300</a></li>
      <li><a href="#" class="am-text-warning"><span class="am-icon-btn am-icon-briefcase"></span><br/>成交订单<br/>308</a></li>
      <li><a href="#" class="am-text-danger"><span class="am-icon-btn am-icon-recycle"></span><br/>昨日访问<br/>80082</a></li>
      <li><a href="#" class="am-text-secondary"><span class="am-icon-btn am-icon-user-md"></span><br/>在线用户<br/>3000</a></li>
    </ul> -->

		<iframe src ="<?php echo U('website');?>" frameborder="0" marginheight="0" marginwidth="0" frameborder="0" scrolling="auto" id="menuFrame" name="menuFrame" onload="javascript:dyniframesize('menuFrame');" width="100%" height="1000px"></iframe>    


  </div>
  <!-- content end -->

</div>

<a class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<footer>
  <hr>
  <p class="am-padding-left">© 2014 </p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/polyfill/rem.min.js"></script>
<script src="assets/js/polyfill/respond.min.js"></script>
<script src="assets/js/amazeui.legacy.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="./Tpl/Yi/assets/js/jquery.min.js"></script>
<script src="./Tpl/Yi/assets/js/amazeui.min.js"></script>
<!--<![endif]-->
<script src="./Tpl/Yi/assets/js/app.js"></script>
</body>
</html>