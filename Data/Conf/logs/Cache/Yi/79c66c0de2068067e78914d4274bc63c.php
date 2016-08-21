<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn" class="app fadeInUp animated js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>work微信，爱工作爱生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta content="微信企业号 微信办公 移动OA 微信打卡 微信审批 移动协作平台 " name="Keywords">
    <meta content="" name="Description">
	<link href="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./Tpl/Qyapp/Static/Css/animate.min.css" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/font-awesome.min.css" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/style.min.css" rel="stylesheet">
</head>
<body>
<section class="vbox">
<header class="header bg-white b-b b-light">
<p>应用列表</p>
<a class="text-muted pull-right m-t pointer" href="javascript:history.go(-1)" title="返回" data-toggle="back">
<i class="fa fa-reply"></i>
</a>
</header>	
    <section class="scrollable wrapper w-f">
        <section class="panel panel-default ">
            <div class="row m-l-none m-r-none bg-light lter">
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="app-item center js_entity_view" style="height:200px;" data-path=""><a href="<?php echo U('appinfo',array('id'=>$vo['id']));?>">
							 <img class="app-item-img" alt="<?php echo ($vo["name"]); ?>" src="<?php echo ($vo["logo"]); ?>">
                            <div class="app-item-name" style="margin-left:30px;"><?php echo ($vo["name"]); ?> </div> </a>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                       </div>
        </section>
    </section>
</section>
<div class="msgbox">
</div>
</body>
</html>