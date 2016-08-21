<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn" class="app fadeInUp animated js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta content=" " name="Keywords">
    <meta content="" name="Description">
	<link href="./Tpl/Qyapp/Static/Css/custom_menu.css" rel="stylesheet">		
	<link href="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./Tpl/Qyapp/Static/Css/animate.min.css" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/font-awesome.min.css" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/style.min.css" rel="stylesheet">
	<script src="./Tpl/Qyapp/Static/Js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/js/bootstrap.min.js"></script>		
	<script type="text/javascript">
	function save(){
		$('#addfirst').load("<?php echo U('appvip',array('id'=>$_GET['id']));?>", function(){
			 $('#addfirst').modal();
		});		   
	}
</script> 
	</head>
<body>
 <div id="addfirst" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>  
<section class="hbox stretch">
    <aside>
<body>
<section class="hbox stretch">
    <aside>
        <section class="vbox">
            <section class="scrollable  wrapper">
                <section class="panel panel-default">
                    <div class="panel-body">
                        <div class="entity-panel-body form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-1 control-label m-l"><img src="<?php echo ($info["icon"]); ?>" style="width:80px"></label>
                                <div class="col-sm-9 m-l-xl">
                                    <h4 style="padding-top:10px" class="relative"><strong><?php echo ($info["name"]); ?></strong></h4>
                                    <p class="relative" style="padding-top:5px"><?php echo ($info["desc"]); ?></p>
                                </div>
                            </div>
                            <div class="line line-dashed line-lg pull-in"></div>
                            
                            <div class="line line-dashed line-lg pull-in"></div>
                            <div class="form-group padding-left">
                                <label class="col-sm-12"><h5><strong>应用升级管理</strong></h5></label>
                                <div class="col-sm-12">
                                    <p class="form-control-static relative">官方升级时间:<?php echo (date('Y-m-d',$info["update"])); ?>
									<?php if($isinstall['id'] != ''): ?><a class="absoluter btn btn-default" style="margin-right:100px;"><font color="green">已安装</font></a>
									<?php else: ?>
									<a href="<?php echo U('install_d',array('appid'=>$_GET['id']));?>" class="absoluter btn btn-default" style="margin-right:100px;"><font color="red">安装</font></a><?php endif; ?>
									
									<?php if($_GET['type'] == '2'): ?><a href="<?php echo U('install_d',array('appid'=>$_GET['id']));?>" class="absoluter btn btn-default" style="margin-right:300px;"><font color="orange">可升级</font></a><?php endif; ?>
									
									<?php if($_GET['type'] != ''): ?><a href="<?php echo U('install_d',array('appid'=>$_GET['id']));?>" class="absoluter btn btn-default" style="margin-right:200px;"><font color="blue">卸载</font></a><?php endif; ?>
									</p>
                                </div>
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>

                        </div>
                    </div>
                </section>
            </section>
        </section>
    </aside>
</section>

</body>
</html>