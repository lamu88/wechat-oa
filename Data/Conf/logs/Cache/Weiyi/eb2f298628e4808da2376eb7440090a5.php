<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class=" js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./Tpl/Weiyi/Weiyi/Css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="./Tpl/Weiyi/Weiyi/Css/test.css">
<!-- <script language="javascript" type="text/javascript" src="./Tpl/Weiyi/Weiyi//Js/js.js"></script>
<script language="javascript" type="text/javascript" src="./Tpl/Weiyi/Weiyi//Js/fun.js"></script> -->
	<script src="./Tpl/Qyapp/Static/Js/jquery-1.9.1.min.js" type="text/javascript"></script>
<title><?php echo ($webinfo["site_title"]); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content=" <?php echo ($webinfo["keyword"]); ?> " name="Keywords">
    <meta content="<?php echo ($webinfo["content"]); ?>" name="Description">
    <link href="./Tpl/Weiyi/Weiyi//Css/webSite.css" rel="stylesheet">
<!--     <link rel="shortcut icon" href="./Tpl/Weiyi/Weiyi//Images/favicon.jpg"> -->
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
    <div class="bodyer m0" id="home-bodyer">
        <div class="bodyer-p">
            <img class="img_bg" src="./Tpl/Weiyi/Weiyi/Images/home-banner.jpg" >

       <div class="hd-register">
					<div class="register-box">
                    <div class="header-opacity-box"></div>
					
					
					
			
		
	<div class="indexTop">	
		<div class="btnDiv" style="margin-left: 21%;margin-bottom: 15%;">
            <div class="wal"
            <div class="fr">
                  <ul>
                      <li class="li_01"><a href="javascript:;"></a></li>
                      <li class="li_02"><a href="javascript:;"></a></li>
                      <li class="li_03"><a href="javascript:;"></a></li>
                      <li class="li_04"><a href="javascript:;"></a></li>
                  </ul>
            </div>
            </div>
			     <div class="nav-search home-top-form">
                            <div id="searchTopForm" class="searchForm-box" data-action="">
                                <input id="search_top" name="search_top" onKeyPress="if(event.keyCode == 13){return false;}" class="search-inp email-register" type="text" placeholder="输入您的用户名" value="">
                                <button type="button" class="btn btn-register" id="reg">免费注册</button>
                                <span class="hit-info"></span>
                            </div>
                        </div>
		</div>
					
	</div>
	               
					
					
                </div>
            </div>
            <div class="homebody-container w1170">
                <div class="container-info fadeInLeft animated">
                    <p><a id="modal-box"><i class="icos-info"></i><?php echo ($webinfo["site_name"]); ?>企业号公测上线了！</a></p>
                </div>
                <div class="container-list clearfix">
                    <div class="list-box list-box-first">
                        <ul>
                            <li class="list-box-left">
                                <i class="ico ico-ease"></i>
                                <span>简单高效</span>
                            </li>
                            <li class="list-box-right">
                                <p>无需安装&nbsp;&nbsp;微信移动办公</p>
                                <p>团队协同&nbsp;&nbsp;任务无缝对接</p>
                                <p>删繁就简&nbsp;&nbsp;让工作更简单</p>
                                <p>随时随地&nbsp;&nbsp;让工作更高效</p>
                            </li>
                        </ul>
                    </div>
                    <div class="list-box">
                        <ul>
                            <li class="list-box-left">
                                <i class="ico ico-safety"></i>
                                <span>安全稳定</span>
                            </li>
                            <li class="list-box-right">
                                <p>端到端加密，业界顶级数据中心</p>
                                <p>提供万全的服务质量保证</p>
                                <p>分布式运算提供银行级可靠性</p>
                                <p>7*24小时运维监控</p>
                            </li>
                        </ul>
                    </div>
                    <div class="list-box">
                        <ul>
                            <li class="list-box-left">
                                <i class="ico ico-fashion"></i>
                                <span>时尚有趣 </span>
                            </li>
                            <li class="list-box-right">
                                <p>工作也是一种生活</p>
                                <p>工作也可以摇一摇、抢红包</p>
                                <p>开启移动办公新模式</p>
                                <p>让您的团队更加热爱工作</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="bodyer-content-box w1170">
        <div class="bodyer-computer-view">
            <div class="view-box">
                <div class="view-header clearfix">
                    <div class="view-header-left"><img src="./Tpl/Weiyi/Weiyi//Images/view-logo.png"></div>
                    <div class="view-header-right">
                        <ul class="view-header-nav clearfix">
                            <li class="view-dropdown-toggle">
                                <a class="view-header-message view-header-manage" href="javascript:void(0)" title="应用中心"><i class="ico-manage"></i></a>
                            </li>
                            <li class="view-dropdown-toggle">
                                <a class="view-header-message" href="javascript:void(0)" title="消息"><i class="ico-bell"></i></a>
                                <ul class="dropdown-menu message-inform  animated fadeInRight">
                                    <li><a href="javascript:void(0)"><img src="./Tpl/Weiyi/Weiyi//Images/message-inform.png"></a></li><a href="javascript:void(0)">
                                </a></ul><a href="javascript:void(0)">
                            </a></li><a href="javascript:void(0)">
                            </a><li class="view-dropdown-toggle"><a href="javascript:void(0)">
                                </a><a class="view-header-message header-admin" href="javascript:void(0)" title="管理员">超级管理员admin</a>
                                <ul class="dropdown-menu animated fadeInRight">
                                    <li><span class="view-header-ioc"></span><a class="view-header-accounts" href="javascript:void(0)" data-account="./Tpl/Weiyi/Weiyi//Images/accounts-info.jpg" data-phone="accounts-home" data-src="./Tpl/Weiyi/Weiyi//Images/accounts-phone-home.jpg">帐号信息</a></li>
                                    <li><span class="view-header-ioc view-header-ioc1"></span><a href="javascript:void(0)">修改密码</a></li>
                                    <li><span class="view-header-ioc view-header-ioc3"></span><a href="javascript:void(0)">帮助</a></li>
                                    <li><span class="view-header-ioc view-header-ioc2"></span><a href="javascript:void(0)">退出</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="view-body clearfix">
                    <div class="box-left" id="product-info" data-url="/index/data">
                        <ul class="view-nav">
                            <li class="active" data-ajax="true" data-info="myapp"><a href="javascript:void(0)"><i class="ico my-app"></i><span>我的应用</span></a></li>
                            <li class="" data-ajax="false" data-info="address"><a href="javascript:void(0)"><i class="ico my-address"></i><span>通讯录</span></a></li>
                            <li class="" data-ajax="false" data-info="structure"><a href="javascript:void(0)"><i class="ico my-structure"></i><span>组织架构</span></a></li>
                            <li class="" data-ajax="false" data-info="message"><a href="javascript:void(0)"><i class="ico my-message"></i><span>群发消息</span></a></li>
                            <!--<li class="" data-ajax="false" data-info="material"><a href="javascript:void(0)"><i class="ico my-material"></i><span>素材管理</span></a></li>-->
                        </ul>
                    </div>
                    <div id="add-view" class="box-right" data-url="/index/childrenData">
                        <div class="template-box myapp visibility">
                            <div class="template-head"><strong>我的应用</strong></div>
                            <div class="view-select" id="select-box">
                                <div class="view-list">
                                    <ul class="app-nav">
                                        <li data-ajax="false" data-info="reward">
                                            <a href="javascript:void(0)" class="detail-top">

                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="reward-right.png">
                                                悬赏招聘
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>
                                        <li data-ajax="false" data-info="account">
                                            <a href="javascript:void(0)" class="detail-top detail-ico1">

                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="account-right.png">
                                                报销
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>
                                        <li data-ajax="false" data-info="approval">
                                            <a href="javascript:void(0)" class="detail-top detail-ico2">

                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="approval-right.png">
                                                流程审批
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>
                                        <li data-ajax="false" data-info="management">
                                            <a href="javascript:void(0)" class="detail-top detail-ico3">
                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="management-right.png">
                                                任务管理
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>

                                        <li data-ajax="false" data-info="leave">
                                            <a href="javascript:void(0)" class="detail-top detail-ico4">

                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="leave-right.png">
                                                请假
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>
                                        <li data-ajax="false" data-info="card">
                                            <a href="javascript:void(0)" class="detail-top detail-ico5">

                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="card-right.png">
                                                微名片
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>
                                        <li data-ajax="false" data-info="research">
                                            <a href="javascript:void(0)" class="detail-top detail-ico6">

                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="research-right.png">
                                                调研
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>
                                        <li data-ajax="false" data-info="letter">
                                            <a href="javascript:void(0)" class="detail-top detail-ico7">
                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="letter-right.png">
                                                微信考勤
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>
                                        <li data-ajax="false" data-info="vote">
                                            <a href="javascript:void(0)" class="detail-top detail-ico8">
                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="vote-right.png">
                                                投票
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>
                                        <li data-ajax="false" data-info="room">
                                            <a href="javascript:void(0)" class="detail-top detail-ico9">
                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="room-right.png">
                                                会议室预定
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>
                                        <li data-ajax="false" data-info="email">
                                            <a href="javascript:void(0)" class="detail-top detail-ico10">
                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="email-right.png">
                                                企业邮箱
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>
                                        <li data-ajax="false" data-info="schedule">
                                            <a href="javascript:void(0)" class="detail-top detail-ico11">
                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="schedule-right.png">
                                                日程管理
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>
                                        <li data-ajax="false" data-info="address">
                                            <a href="javascript:void(0)" class="detail-top detail-ico12">
                                            </a>
                                            <a href="javascript:void(0)" class="detail-bottom" data-pos="0" data-load="false" data-src="address-right.png">
                                                通讯录管理
                                                <i class="ico-detail"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="phnoe" class="view-phone">
                <div class="phone-img myapp-phone">
                    <img src="./Tpl/Weiyi/Weiyi//Images/myapp-phone.jpg" alt="">
                </div>
            </div>
            <div class="finger-box"><div class="finger-point"></div><div class="finger-ico"></div></div>
        </div>

		
		<div class="indexPart2">
<div class="wal">
<div class="list">
      <ul>
             <li class="li_01">
                 <div class="imgDiv"><a href=""><img src="./Tpl/Weiyi/Weiyi//Images/limg78_1.png" alt=""></a></div>
                 <div class="bg"></div>
                 <h1 class="title">服务</h1>
                 <div class="content">
                     <dl>
                       <dd><a href="">业务待办提醒</a></dd>
                       <dd><a href="">邮件处理</a></dd>
                       <dd><a href="">会议、行程、任务安排</a></dd>
                       <dd><a href="">企业公告、通知</a></dd>
                     </dl>
                 </div>
             </li>
             <li class="li_02">
                 <div class="imgDiv"><a href=""><img src="./Tpl/Weiyi/Weiyi//Images/limg78_2.png" alt=""></a></div>
                 <div class="bg"></div>
                 <h1 class="title">沟通</h1>
                 <div class="content">
                     <dl>
                       <dd><a href="">企业通讯录</a></dd>
                       <dd><a href="">主题讨论</a></dd>
                       <dd><a href="">公共电话簿</a></dd>
                       <dd><a href="">调研投票</a></dd>
                     </dl>
                 </div>
             </li>
             <li class="li_03">
                 <div class="imgDiv"><a href=""><img src="./Tpl/Weiyi/Weiyi//Images/limg78_3.png" alt=""></a></div>
                 <div class="bg"></div>
                 <h1 class="title">群组</h1>
                 <div class="content">
                     <dl>
                       <dd><a href="">工作安排任务下达</a></dd>
                       <dd><a href="">工作日志工作动态</a></dd>
                       <dd><a href="">分享经验和知识</a></dd>
                       <dd><a href="">即时讨论头脑风暴</a></dd>
                     </dl>
                 </div>
             </li>
             <li class="li_04">
                 <div class="imgDiv"><a href=""><img src="./Tpl/Weiyi/Weiyi//Images/limg78_4.png" alt=""></a></div>
                 <div class="bg"></div>
                 <h1 class="title">应用</h1>
                 <div class="content">
                     <dl>
                       <dd><a href="">一键安装</a></dd>
                       <dd><a href="">功能独立</a></dd>
                       <dd><a href="">无限群发</a></dd>
                       <dd><a href="">空中办公</a></dd>
                     </dl>
                 </div>
             </li>
      </ul>
</div>
</div>
</div>

    </div>
    </div>
    </br>
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="">公告</h4>
                </div>
                <div class="modal-body">
                    <p class="MsoNormal" align="left" style="background:white;">
	尊敬的用户：<span><br>
</span><span> </span> 
</p>
<p class="MsoNormal">
	&nbsp; &nbsp; &nbsp; 您好！<span> </span> 
</p>
<p class="MsoNormal">
	&nbsp; &nbsp; &nbsp; 通过我们一个多月的内测，企业邮箱应用正式对外开放！<span></span> 
</p>
<p class="MsoNormal">
	&nbsp; &nbsp; &nbsp;&nbsp;企业邮箱，打开微信即可轻松的收发邮件，及时、安全又高效！<span></span> 
</p>
<p class="MsoNormal">
	&nbsp; &nbsp; &nbsp;&nbsp;<img src="./Tpl/Weiyi/Weiyi//Images/69ba033f3bd4f838a244b61355931cf0.jpeg" alt=""> 
</p>
<p class="MsoNormal">
	<span style="line-height:1.5;">&nbsp; &nbsp; &nbsp; 邮箱自带企业通讯录， 指尖轻轻触碰，便可向公司里任何一位员工发送邮件。</span> 
</p>
<p class="MsoNormal">
	&nbsp; &nbsp; &nbsp;&nbsp;<img src="./Tpl/Weiyi/Weiyi//Images/297b6e657791fed029ce24fbfc05fa2e.png" alt=""><span style="line-height:1.5;">&nbsp; &nbsp; &nbsp; &nbsp;</span><img src="./Images/96eded6990003f844f0921373d58cb2a.png" alt=""> 
</p>
<p class="MsoNormal" style="text-indent:28.0pt;">
	如在产品使用中，有任何疑问或建议，请发邮件，您的每一个建议对我们都很重要！
</p>
<p class="MsoNormal" style="text-indent:19.5pt;">
	<br>
</p>
<p class="MsoNormal" align="right" style="text-align:right;text-indent:19.5pt;">
	<?php echo ($webinfo["site_name"]); ?>产品团队<span></span> 
</p>
<p class="MsoNormal" align="right" style="text-align:right;text-indent:19.5pt;">
	2014.10.23
</p>                </div>
            </div>
        </div>
    </div>

<div id="fixed-icons" class="fixed-icons"><a href="" target="_blank" class="consulting"><span>在线咨询</span></a>

<!-- <ul><li class="icon2">免费电话<p><?php echo ($webinfo["site_tel"]); ?><i></i></p></li><li class="icon3" id="modal-box1">我要反馈</li><li class="icon4"><img src="./index_files/two-dim-code.png"></li><li class="icon5" title="回到顶部" style="display:none;"></li></ul> -->
<ul>
<li class="icon2" id="telphone">
免费电话
<p style="display: none;">
<?php echo ($webinfo["site_tel"]); ?>
<i></i>
</p>
</li>
<!-- <li id="modal-box1" class="icon3">我要反馈</li> -->
<li class="icon4" id="code">
<img src="./Tpl/Weiyi/Weiyi//Images/qrcode_for_gzriich.jpg" style="display: none;" width="123px" height="119px">
</li>
<!-- <li class="icon5" style="" title="回到顶部"></li> -->
</ul>
</div>
<script>
$('#telphone').mouseover(function(){
$('#telphone p').css('display','block');
});
$('#telphone').mouseout(function(){
$('#telphone p').css('display','none');
});
$('#code').mouseover(function(){
$('#code img').css('display','inline');
});
$('#code').mouseout(function(){
$('#code img').css('display','none');
});
</script>
<script>
    $('#reg').on('click',function(){
	    var email = $('#search_top').val();
 		$.ajax({
			type:"POST",
			url:"index.php?g=Weiyi&m=Weiyi&a=regclick",
			data:"email="+email,
			dataType:'json',
			success:function(json){
			var status = json.status;
			  if(status==1)
			  {
				alert('提交成功，请注意查收您的邮件！');
			  }
			  else
			  {
				  alert('注册失败，请检查您的用户名！');
			  }
			}
		});	
	});

		</script>
</body></html>