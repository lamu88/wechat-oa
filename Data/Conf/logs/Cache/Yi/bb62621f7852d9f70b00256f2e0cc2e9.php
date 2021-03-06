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
	
<script charset="utf-8" src="./Tpl/Qyapp/Static/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="./Tpl/Qyapp/Static/kindeditor/lang/zh_CN.js"></script>
<link rel="stylesheet" href="./Tpl/Qyapp/Static/index/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="./Tpl/Qyapp/Static/Css/uploadify.min.css" />
</head><script type="text/javascript">
	KindEditor.ready(function(K) {
		var editor;
		editor = K.create('textarea[name="content"]', {
			resizeType : 0,
			allowPreviewEmoticons :false,
			allowImageUpload :true,
			uploadJson:'<?php echo U("Qyapp/Adminupload/uploadType",array("is_url"=>1,"file_type"=>"image"));?>',
			formatUploadUrl:false,
			items : [
				'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image', 'link']
		});		
	});	
</script>
<script type="text/javascript">
	KindEditor.ready(function(K) 
	{
		var editor = K.editor({
			allowFileManager : false,
			uploadJson:'<?php echo U("Qyapp/Adminupload/uploadType",array("is_url"=>1,"file_type"=>"image"));?>',
			formatUploadUrl:false
		});				
		K('#image3').click(function() {

			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : K('#url3').val(),
					clickFn : function(url, title, width, height, border, align) {
						$('.imgurl').val(url); 	
						editor.hideDialog();
					}
				});
			});
		});			
	});
</script>
<body>
	
    <section class="vbox">
	
<header class="header bg-white b-b b-light">
<p>企业号登录</p>
<a class="text-muted pull-right m-t pointer" href="javascript:history.go(-1)" title="返回" data-toggle="back">
<i class="fa fa-reply"></i>
</a>
</header>	
		<form action="" method="post">
        <section class="scrollable wrapper">
            <section class="panel panel-default">
                <div class="panel-body">
                    <div class="form-horizontal form-validate" >
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">登录授权发起域名</label>
                            <div class="col-sm-3">
								 <p class="relative" style="padding-top:5px">http://<?php echo ($login["site_url"]); ?></p>
                                
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">授权完成回调URL</label>
                            <div class="col-sm-3">
                                <p class="relative" style="padding-top:5px">http://<?php echo ($login["site_url"]); ?>/index.php/Login/code</p>
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                       
						
						
						<div class="form-group">
                            <label class="col-sm-2 control-label must">providersecret</label>
                            <div class="col-sm-3">
                                <input type="text" name="provider_secret" class="form-control" placeholder="" value="<?php echo ($login["provider_secret"]); ?>"/>
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						<div class="line line-dashed line-lg pull-in"></div>
						<div class="form-group">
                            <label class="col-sm-2 control-label must">CorpID</label>
                            <div class="col-sm-3">
                                <input type="text" name="corpid" id="old_password" class="form-control" value="<?php echo ($login["corpid"]); ?>"   data-rule-required="true" data-rule-rangelength="[1,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
								<button type="submit" class="btn btn-primary" id="submit" data-loading-text="保存中..." >保存</button>
                                <button type="button" class="btn btn-default" data-toggle="back">取消</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
	
	</form>
    </section>	
	
</html>