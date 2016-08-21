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
	
<script charset="utf-8" src="./Tpl/Qyapp/Index/index/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="./Tpl/Qyapp/Index/index/kindeditor/lang/zh_CN.js"></script>
<link rel="stylesheet" href="./Tpl/Qyapp/Index/index/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="./Tpl/Qyapp/Static/Css/uploadify.min.css" />
</head><script type="text/javascript">
	KindEditor.ready(function(K) {
		var editor;
		editor = K.create('textarea[name="content"]', {
			resizeType : 0,
			allowPreviewEmoticons :false,
			allowImageUpload :true,
			uploadJson:'<?php echo U("Qyapp/Adminupload/ajaxUpload",array("is_url"=>1,"file_type"=>"image"));?>',
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
			uploadJson:'<?php echo U("Qyapp/Adminupload/ajaxUpload",array("is_url"=>1,"file_type"=>"image"));?>',
			formatUploadUrl:false
		});				
		//K('#image3').click(function() {
		K('#image3').click(function() {

			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : K('#url3').val(),
					clickFn : function(url, title, width, height, border, align) {
						//alert(url);
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
<p>站点设置</p>
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
                            <label class="col-sm-2 control-label must">网站名称</label>
                            <div class="col-sm-3">

                                <input type="text" name="site_name" id="old_password" class="form-control" data-rule-required="true" value="<?php echo ($data["site_name"]); ?>" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">网站标题</label>
                            <div class="col-sm-3">
                                <input type="text" id="new_password" name="site_title" value="<?php echo ($data["site_title"]); ?>" class="form-control" data-rule-required="true"  />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label must">网站LOGO</label>
                            <div class="col-sm-3">
                                <input type="text" name="site_logo" id="new_password_verify imgurl"<?php if($data['site_logo'] != ''): ?>value="<?php echo ($data["site_logo"]); ?>" <?php else: ?> value='http://qy.wxopen.cn/Tpl/Qyapp/Static/Css/logo.png'<?php endif; ?>class="form-control imgurl" data-rule-equalTo="#new_password" />
								<button class="btn btn-default btn-sm js_add_img_btn" type="button" data-toggle="selectimg" href="javascript:void();" id="image3">选择上传图片</button>
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						

						<div class="form-group">
                            <label class="col-sm-2 control-label must">注册免费试用</label>
                            <div class="col-sm-3">
                                <input type="text" name="day" class="form-control" placeholder="请填上试用天数" value="<?php echo ($data["day"]); ?>"/>
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 control-label must">注册短信验证</label>
                            <div class="col-sm-3">
								 <label class="radio-inline"><input type="radio" <?php if($data['status'] == 1): ?>checked<?php endif; ?> value="1" name="status">开启</label>
								 <label class="radio-inline"><input type="radio" <?php if($data['status'] == 2): ?>checked<?php endif; ?> value="2" name="status">关闭</label>
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 control-label must">网站地址：</label>
                            <div class="col-sm-3">
                                <input type="text" name="site_url" id="old_password" class="form-control" value="<?php echo ($data["site_url"]); ?>" placeholder="qy.wxopen.cn"  data-rule-required="true" data-rule-rangelength="[1,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 control-label must">网站备案：</label>
                            <div class="col-sm-3">
                                <input type="text" name="ipc" id="old_password" class="form-control"  value="<?php echo ($data["ipc"]); ?>" data-rule-required="true" data-rule-rangelength="[1,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-2 control-label must">联系电话：</label>
                            <div class="col-sm-3">
                                <input type="text" name="site_tel" id="old_password" class="form-control" value="<?php echo ($data["site_tel"]); ?>" data-rule-required="true" data-rule-rangelength="[1,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 control-label must">联系地址：</label>
                            <div class="col-sm-3">
                                <input type="text" name="address" id="old_password" class="form-control" value="<?php echo ($data["address"]); ?>" placeholder="湖北省武汉市"  data-rule-required="true" data-rule-rangelength="[1,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 control-label must">站长QQ：</label>
                            <div class="col-sm-3">
                                <input type="text" name="site_qq" id="old_password" class="form-control"  value="<?php echo ($data["site_qq"]); ?>" data-rule-required="true" data-rule-rangelength="[1,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-2 control-label must">百度地图API：</label>
                            <div class="col-sm-3">
                                <input type="text" name="baidu_map_api" id="old_password" value="<?php echo ($data["baidu_map_api"]); ?>"  class="form-control" data-rule-required="true" data-rule-rangelength="[1,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						
						
						<div class="form-group">
                            <label class="col-sm-2 control-label must">站长Email：</label>
                            <div class="col-sm-3">
                                <input type="text" name="site_email" id="old_password"  value="<?php echo ($data["site_email"]); ?>" class="form-control" data-rule-required="true" data-rule-rangelength="[1,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-2 control-label must">网站关键词：</label>
                            <div class="col-sm-3">
                                <input type="text" name="keyword" id="old_password"  value="<?php echo ($data["keyword"]); ?>" class="form-control" data-rule-required="true" data-rule-rangelength="[1,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-2 control-label must">网站　描述：</label>
                            <div class="col-sm-3">
                                <input type="text" name="content" id="old_password"   value="<?php echo ($data["content"]); ?>" class="form-control" data-rule-required="true" data-rule-rangelength="[1,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-2 control-label must">底部　版权：</label>
                            <div class="col-sm-3">
                                <input type="text" name="copyright" id="old_password"    value="<?php echo ($data["copyright"]); ?>"  class="form-control" data-rule-required="true" data-rule-rangelength="[1,16]" />
                            </div>
                            <div class="col-sm-3"><p class="form-control-static"></p></div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
						 <input  name="uid"    value="<?php echo ($_GET['id']); ?>"  class="form-control" type="hidden" />
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