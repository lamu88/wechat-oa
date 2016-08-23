<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn" class="app fadeInUp animated js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
$(document).ready(function(){
	$("#update").click(function(){
		$.ajax({
				type: "post", 
				url:"/index.php?g=Yi&m=Appstore&a=query",
				dataType:'json',
				data:'query=1',
				success:function(json){
					var status = json.status;
					if(status==6){
						alert('升级版本成功');
						window.location.reload();
					}else if(status==3){
						alert('下载失败');
					}else if(status==5){
						alert('解压失败');
					}else if(status==2){
						alert('您已经是最高的版本了');
						
					}else if(status==7){

						alert('版权归属：深度实业集团网络科技有限公司,授权后可免费升级，授权可到论坛bbs.wxopen.cn做任务。QQ交流群：451493529');	
						
						
					}else{
						alert('升级失败可能是目录没有权限');
					}
				}
			});
	  });
});
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
                                <label class="col-sm-1 control-label m-l"><img src="./Tpl/Yi/Appstore/css/version.png" style="width:80px"></label>
                                <div class="col-sm-9 m-l-xl">
                                    <h4 style="padding-top:10px" class="relative"><strong><?php echo ($info["No_id"]); ?>(<?php if($status == 1): ?><font color="red">有更新</font><?php else: ?>暂无更新<?php endif; ?>)</strong></h4>
                                    <p class="relative" style="padding-top:5px">您所用版本为<?php echo ($nowversion); ?>版</p>
                                </div>
                            </div>
                            <div class="line line-dashed line-lg pull-in"></div>
                            
                            <div class="line line-dashed line-lg pull-in"></div>
                            <div class="form-group padding-left">
                                <label class="col-sm-12"><h5><strong>版本升级</strong></h5></label>
                                <div class="col-sm-12">
                                    <p class="form-control-static relative">官方最新版本:<?php echo ($info["No_id"]); ?>(<?php echo (date('Y-m-d',$info["date"])); ?>)
									<?php if($isinstall['id'] != ''): else: ?>
									<a  href="javascript:void()" id="update" class="absoluter btn btn-default isub" style="margin-right:100px;"><font color="red">一键升级</font></a><?php endif; ?>
									</p>
                                </div>
                            </div>
							<div class="line line-dashed line-lg pull-in"></div>
							
							
							
							<div class="line line-dashed line-lg pull-in"></div>
                            <div class="form-group padding-left">
                                <label class="col-sm-12"><h5><strong>更新记录</strong></h5></label>
                                <div class="col-sm-12" style="margin-left:80px;">
									<?php if(is_array($up_record)): $i = 0; $__LIST__ = $up_record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$up_record): $mod = ($i % 2 );++$i;?><p class="form-control-static relative">版本号:<?php echo ($up_record["No_id"]); ?>-升级时间:(<?php echo (date('Y-m-d H:i:s',$up_record["date"])); ?>)-适用版本:<?php if($up_record['free'] == 1): ?>免费版<?php endif; if($up_record['enterprise'] == 1): ?>单用户版<?php endif; if($up_record['advanced'] == 1): ?>多用户版<?php endif; ?>
									</p><?php endforeach; endif; else: echo "" ;endif; ?>
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
<div class="progressBox">
	<div id="upload" >
		<div id="top" >
			<img src="./Tpl/System/System/info.gif" /><br/>
		</div>
		<span>正在更新中，请稍后 ...</span>
	</div>
	<div id="ok" >
		<div id="bottom">
			更新成功！请点击关闭此页面
		</div>
		<a href="javascript:void()" onclick="javascript:location.reload()" >关闭</a>
	</div>
</div>




</body>
</html>