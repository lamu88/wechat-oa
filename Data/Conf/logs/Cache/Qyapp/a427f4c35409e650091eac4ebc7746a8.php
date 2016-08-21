<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>企业公告</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="./Tpl/assets/global/css/gfonts1.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/Qyapp/Static/Css/style.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="./Tpl/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="./Tpl/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="./Tpl/assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/assets/admin/layout/css/weiyi.css" rel="stylesheet" type="text/css"/>
<link href="./Tpl/Qyapp/Announce/css/ann.css" rel="stylesheet" type="text/css">

	<link href="./Tpl/static/bootstrap/todo.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body style="background-color:#f7f7f7;">

    <div class="announce_all">
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a class="pull-left" style="width:100%; color:#333;" href="<?php echo U('wap_act_info',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'pid'=>$v['id']));?>">
			<div class="announce_row">
				<div class="ann_group">
				    <?php if($v['img']): ?><div class="ann_pic">
						<img src="<?php echo ($v["img"]["0"]); ?>" width="100%" height="150px">
					</div><?php endif; ?>
					<div class="ann_content">
						<div class="ann_title"><?php echo ($v["title"]); ?></div>
						<div class="ann_time"><?php echo (date("Y-m-d H:m",$v["time"])); ?></div>
					</div>
				</div>
			</div>
		 </a><?php endforeach; endif; else: echo "" ;endif; ?>


    </div>
<div id="frame" >
<div id="menu" style="position:fixed;bottom:0px;width:100%;height:44px;line-height:44px;z-index:999;background:#fff; border-top:1px solid #ccc;">
	<ul style="margin:0 auto;list-style-type:none;width:100%;height:100%;padding-left: 0;">
	
<!--		<a href="<?php echo U('wap_sent',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">
            <li style="border-right:solid 1px #ccc;padding-left: 0;">
                <img class="img_front" src="./Tpl/Qyapp/Workflow/images/front.png">
                <div class="menu_li">&nbsp;收到公告</div>
            </li>
        </a>
-->		<li>
			<div class="menu_li border">公告查询</div>
			<span>
				<img src="./Tpl/Qyapp/Task/images/navbg2.png" width="90%" />
				<div class="sec_nav">
                    <a href="<?php echo U('wap_sent',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">收到公告</a>
                    <a href="<?php echo U('wap_index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">我发布的</a>
				</div>
			</span>
		</li>
		<a href="<?php echo U('wap_add_task',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>">
            <li>
            	<img class="img_front" src="./Tpl/Qyapp/Workflow/images/front.png">
                <div class="menu_li">&nbsp;发布公告</div>
            </li>
        </a>
		 
		<!-- <a href="<?php echo U('wap_message',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>"><li style="border-right:solid 1px #ccc"><img class="img_front" src="./Tpl/Qyapp/Workflow/images/front.png"><div class="menu_li">&nbsp;消息中心</div>
		</li></a> -->
		
	</ul>
</div>
<style>
#menu{position:fixed;bottom:0px;width:100%;height:44px;line-height:44px;z-index:999; background-color:#fff; border-top:1px solid #CCC;}
#menu ul{margin:0 auto;list-style-type:none;width:100%;height:100%;}
#menu ul li{float:left;width:49.7%;height:100%;text-align:center;position:relative;font-size:14px; background-color:#fff;}
#menu .border{ border-right:1px solid #ccc;}
.sec_nav{ margin-left:7px;}
#menu ul li .menu_li{position:absolute;top:0px;left:0px;z-index:20;width:100%;height:100%;color:#454545;}
#menu ul li .img_front{position:absolute;top:0px;left:0px;z-index:30;width:100%;height:100%;}
#menu ul li .img_front img{width:100%;height:100%;}
#menu ul li span{position:absolute;bottom:-300px;left:50%;width:104px;margin-left:-52px;height:auto;text-align:center;z-index:-1;}
#menu ul li span div{position:absolute;top:0px;left:0px;}
#menu ul li span a{float:left;width:100%;height:40px;line-height:40px;color:#454545;text-decoration:none;}

.footer_front{position:fixed;width:100%;height:100%;top:0px;left:0px;z-index:888;display:none;}
</style>
</div>	

</div>
<!-- END CONTAINER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="./Tpl/assets/global/plugins/respond.min.js"></script>
<script src="./Tpl/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="./Tpl/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="./Tpl/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script type="text/javascript">
window.onload = function(){
	$('#menu ul li').each(function(j){
		$('#menu ul li').eq(j).removeClass("on");
		$('#menu ul li span').eq(j).animate({bottom:-$('#menu ul li span').eq(j).height()},100);
	});
}

$('#menu ul li').each(function(i){
	$(this).click(function(){
		if($(this).attr("class")!="on"){
			$('#menu ul .on span').animate({bottom:-$('#menu ul .on span').height()},200);
			$('#menu ul .on').removeClass("on");
			$(this).addClass("on");
			$('#menu ul li span').eq(i).animate({bottom:50},200);
			$('.footer_front').show();
		}else{
			$('#menu ul li span').eq(i).animate({bottom:-$('#menu ul li span').eq(i).height()},200);
			$(this).removeClass("on");
			$('.footer_front').hide();
		}
	});
});

$('.footer_front').click(function(){
	$('#menu ul .on span').animate({bottom:-$('#menu ul .on span').height()},200);
	$('#menu ul .on').removeClass("on");
	$(this).hide();
});
</script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="./Tpl/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="./Tpl/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./Tpl/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="./Tpl/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="./Tpl/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="./Tpl/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="./Tpl/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="./Tpl/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
 <script type="text/javascript" src="./Tpl/assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="./Tpl/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./Tpl/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./Tpl/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./Tpl/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="./Tpl/assets/admin/pages/scripts/form-samples.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- END JAVASCRIPTS -->
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  wx.config({
      debug: false,
      appId: '<?php echo ($jsssdk_info["appId"]); ?>',
      timestamp: <?php echo ($jsssdk_info["timestamp"]); ?>,
      nonceStr: '<?php echo ($jsssdk_info["nonceStr"]); ?>',
      signature: '<?php echo ($jsssdk_info["signature"]); ?>',
      jsApiList: [
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'openCard'
      ]
  });
</script>

<script>
wx.ready(function () {
  // 2.1 监听"分享给朋友"，按钮点击、自定义分享内容及分享结果接口
	var newUrl="http://<?php echo $_SERVER['HTTP_HOST'];?>";
    wx.onMenuShareAppMessage({
      title: '分享招聘岗位挣红包',
      desc: '分享招聘岗位挣红包',
      link: newUrl+"<?php echo U('wap_positionInfo',array('token'=>$_GET['token'],'pid'=>$_GET['pid'],'wecha_id'=>$_GET['wecha_id'],'type'=>'up'));?>",
      imgUrl: newUrl+"/Tpl/Qyapp/Hiring/images/logo.jpg",
      trigger: function (res) {
      },
      success: function (res) {
      },
      cancel: function (res) {
      },
      fail: function (res) {
      }
    });
  // 2.2 监听"分享到朋友圈"按钮点击、自定义分享内容及分享结果接口
    wx.onMenuShareTimeline({
      title: '分享招聘岗位挣红包',
      link: newUrl+"<?php echo U('wap_positionInfo',array('token'=>$_GET['token'],'pid'=>$_GET['pid'],'wecha_id'=>$_GET['wecha_id'],'type'=>'up'));?>",
      imgUrl: newUrl+"/Tpl/Qyapp/Hiring/images/logo.jpg",
      trigger: function (res) {
      },
      success: function (res) {
      },
      cancel: function (res) {
      },
      fail: function (res) {
      }
    });

  // 2.3 监听"分享到QQ"按钮点击、自定义分享内容及分享结果接口
    wx.onMenuShareQQ({
      title: '分享招聘岗位挣红包',
      desc: '分享招聘岗位挣红包',
      link: newUrl+"<?php echo U('wap_positionInfo',array('token'=>$_GET['token'],'pid'=>$_GET['pid'],'wecha_id'=>$_GET['wecha_id'],'type'=>'up'));?>",
      imgUrl: newUrl+"/Tpl/Qyapp/Hiring/images/logo.jpg",
      trigger: function (res) {
      },
      complete: function (res) {
      },
      success: function (res) {
      },
      cancel: function (res) {
      },
      fail: function (res) {
      }
    });
  // 2.4 监听"分享到微博"按钮点击、自定义分享内容及分享结果接口
    wx.onMenuShareWeibo({
      title: '分享招聘岗位挣红包',
      desc: '分享招聘岗位挣红包',
      link:  newUrl+"<?php echo U('wap_positionInfo',array('token'=>$_GET['token'],'pid'=>$_GET['pid'],'wecha_id'=>$_GET['wecha_id'],'type'=>'up'));?>",
      imgUrl: newUrl+"/Tpl/Qyapp/Hiring/images/logo.jpg",
      trigger: function (res) {
      },
      complete: function (res) {
      },
      success: function (res) {
      },
      cancel: function (res) {
      },
      fail: function (res) {
      }
    });
  
});
</script>
</body>
<!-- END BODY -->
</html>