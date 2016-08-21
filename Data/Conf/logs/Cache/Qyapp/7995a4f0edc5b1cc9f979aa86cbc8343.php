<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn" class="app frameset js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?php echo $_SESSION['site_title'];?></title>
    <base href="." target="mainFrame">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content=" " name="Keywords">
    <meta content="" name="Description">
	<link href="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/css/bootstrap.min.css?v=<?php echo time();?>" rel="stylesheet" />
    <link href="./Tpl/Qyapp/Static/Css/animate.min.css?v=<?php echo time();?>" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/font-awesome.min.css?v=<?php echo time();?>" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/style.min.css?v=<?php echo time();?>" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/iconfont.css?v=<?php echo time();?>" rel="stylesheet">
	<script src="./Tpl/Qyapp/Static/Js/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/jquery-migrate.min.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/js/bootstrap.min.js"></script>	    
    <style type="text/css">
        .hidden-bsection {
            display: none;  
        }
        .pageload-overlay {  
            position: fixed;  
            width: 100%;  
            height: 100%;
            top: 0;
            left: 0;
            background: #fff;
            z-index: 1000;
        }
        #loading_done {
            background: url('./Tpl/Qyapp/Static/Images/loading2.gif') no-repeat left top;
            position: fixed;
            width: 52px;
            height: 72px;
            top: 50%;
            left: 50%;
            margin-left: -52px;
            margin-top: -72px;
            z-index: 1001;
        }
    </style>
	
</head>
<script>
$(function(){
  $(".weiyi").click(function() {
	$('.weiyi').removeClass('active');
	$(this).addClass('active');
  });
  $('#bars').on('click',function(){
	  $('.nav-user').addClass('hidden-xs');
	  if($('#nav').hasClass('hidden-xs')){
	      $('#nav').removeClass('hidden-xs');
		  $('.nav-primary').removeClass('hidden-xs');
	  }else{
	      $('#nav').addClass('hidden-xs');
		  $('.nav-primary').addClass('hidden-xs');			  
	  }
  });
    $('#users').on('click',function(){
	  $('.nav-primary').addClass('hidden-xs');
	  if($('.nav-users').hasClass('hidden-xs')){
	      $('#nav').removeClass('hidden-xs');
		  $('.nav-users').removeClass('hidden-xs');
	  }else{
	      $('#nav').addClass('hidden-xs');
		  $('.nav-users').addClass('hidden-xs');			  
	  }
    });
})
</script>

<body>
    <section class="vbox hidden-bsection" style="display: block;">
        <header class="bg-dark header navbar navbar-fixed-top-xs">
            <div class="navbar-header">
                <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav" id="bars">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="javascript:;" class="navbar-brand" data-toggle="fullscreen">
                    <img src="<?php echo $_SESSION['headimg'];?>" class="m-r-sm" style="max-height: 40px;">
                </a>
                <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user" id="users">
                    <i class="fa fa-cog"></i>
                </a>
            </div>
            <div class="msgbox"></div>
            <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
                <li class="hidden-xs">
                    <a href="/index.php?g=Qyapp&m=Appslist&a=appCenter" target="_self" class="nav-new-style nav-border-right" title="应用中心">
                        应用中心
                    </a>
                </li>
                <li class="hidden-xs">
                    <a href="" target="_blank" class="nav-new-style nav-border-right nav-border-left" title="帮助">
                        帮助
                    </a>
                </li>

                <!-- 通知中心 @begin -->
                <li class="hidden-xs hidden">
                    <a href="#" class="dropdown-toggle nav-border-right nav-border-left nav-new-style" data-toggle="dropdown">
                        <i class="iconfont icon-newsnotice icon-size30"></i>
                        <span class="badge badge-sm up bg-danger m-l-n-sm js_msg_count"></span>
                    </a>
                    <section class="dropdown-menu aside-xl ">
                        <section class="panel bg-white js_msg_content">
                        </section>
                        <script type="text/html" id="js_msg_content_footer">
                            <footer class="panel-footer text-sm no-border">
                                <a href="/System/SetAccountNumber?t=" class="pull-right" title="消息通知设置"><i class="iconfont icon-noticeset"></i></a>
                                <a href="/System/NoticeMessageList?t=">查看所有消息</a>
                                <a href="javascript:;" data-path="/System/EmptyNoticeMessage?t=" class="m-l-sm js_msg_empty">清空全部未读</a>
                            </footer>
                        </script>
                    </section>  
                </li>
                <!-- 通知中心 @end -->
                <li class="dropdown" id="down">
                    <a href="javascript:void(0);" class="dropdown-toggle h54 nav-border-left" data-toggle="dropdown" id="show">
                        <span class="thumb-sm avatar pull-left">
                            <img src="./Tpl/Qyapp/Static/Images/avatar1.jpg" alt="">
                        </span>
                        <?php echo $_SESSION['contact'];?>              <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight" id="b">
                        <span class="arrow top"></span>
						
						 <li>
                            <a  href="http://bbs.wxopen.cn" target="_self"><i class="iconfont icon-account m-r-xs icon-size20"></i>论坛交流</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Userinfo/info', array('token' => $token));?>" target="_self"><i class="iconfont icon-account m-r-xs icon-size20"></i>帐号信息</a>
                        </li>
						<li>
                            <a href="<?php echo U('Userinfo/upfile', array('token' => $token));?>" target="_self"><i class="iconfont icon-binding m-r-xs icon-size20"></i>存储设置</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Userinfo/edit', array('token' => $token));?>" target="_self"><i class="iconfont icon-pwd m-r-xs icon-size20"></i>修改密码</a>
                        </li>
                        <li>
                            <a href="<?php echo U('Userinfo/bind', array('token' => $token));?>" target="_self"><i class="iconfont icon-binding m-r-xs icon-size20"></i>帐号绑定</a>
                        </li>
						<li>
                            <a href="<?php echo U('Userinfo/version', array('token' => $token));?>" target="_self"><i class="iconfont icon-binding m-r-xs icon-size20"></i>版本升级</a>
                        </li>
						<li>
                            <a href="<?php echo U('Userinfo/appList', array('token' => $token));?>" target="_self"><i class="iconfont icon-binding m-r-xs icon-size20"></i>应用商店</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo U('Userinfo/logout', array('token' => $token));?>" data-toggle="ajaxModal" target="_self"><i class="iconfont icon-logout m-r-xs icon-size20"></i>退出</a>
                        </li>
                    </ul>
					
					<script>
						$b = $("#b");
						$("#show").on({
							"click": function(){
								$b.toggle();
								return false;
							}
						});
						$(document).on({
							"click": function(e){
								var src = e.target;

								if(src.id && src.id ==="b"){
									return false;
								}else{
									$b.hide();
								}
							}
						});
	
					</script>					
                </li>
            </ul>
        </header>
        <section>
            <section class="hbox stretch">
                <aside class="bg-dark lter aside-md hidden-print hidden-xs nav-xs" id="nav">
                    <section class="vbox">
                        <section class="w-f scrollable">
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 564px;"><div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333" style="overflow: hidden; width: auto; height: 564px;">
                                <nav class="nav-primary hidden-xs">
                                    <ul class="nav">
                                        <li class="active weiyi">
										<?php if(MODULE_NAME == 'Appslist'): ?><li class="active weiyi"><?php else: ?> <li class=" weiyi"><?php endif; ?>
                                            <a href="<?php echo U('Appslist/appList');?>" target="_self" class="active">
                                                <i class="iconfont icon-myapp fa-lg"></i><span>我的应用</span>
                                            </a>
                                        </li>
                                        <?php if(MODULE_NAME == 'Index'): ?><li class="active weiyi"><?php else: ?> <li class=" weiyi"><?php endif; ?>
                                            <a href="<?php echo U('Index/userList');?>" target="_self" class="">
                                                <i class="iconfont icon-contacts fa-lg"></i><span>通讯录</span>
                                            </a>
                                        </li>
                                        <?php if(MODULE_NAME == 'Organic'): ?><li class="active weiyi"><?php else: ?> <li class=" weiyi"><?php endif; ?>
                                            <a href="<?php echo U('Organic/index');?>" target="_self" class="">
                                                <i class="iconfont icon-org fa-lg"></i><span>组织架构</span>
                                            </a>
                                        </li>
                                       <?php if(MODULE_NAME == 'Msg'): ?><li class="active weiyi"><?php else: ?> <li class=" weiyi"><?php endif; ?>
                                            <a href="<?php echo U('Msg/appMsg');?>" target="_self" class="">
                                                <i class="iconfont icon-groupsend fa-lg"></i><span>群发消息</span>
                                            </a>
                                        </li>
										<?php if($_SESSION['node_id'] == ''): if(MODULE_NAME == 'Showadmin'): ?><li class="active weiyi"><?php else: ?> <li class=" weiyi"><?php endif; ?>
                                            <a href="<?php echo U('Showadmin/Group');?>" target="_self" class="">
                                                <i class="iconfont icon-permission fa-lg"></i><span>权限管理</span>
                                            </a>
                                        </li><?php endif; ?>									
                                    </ul>
                                </nav>
                            </div><div class="slimScrollBar" style="width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 0px; height: 564px; background: rgb(51, 51, 51);"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 0px; background: rgb(51, 51, 51);"></div></div>
                        </section>
                    </section>
                </aside>
                <section id="content">
                    <section class="vbox">
<script charset="utf-8" src="./Tpl/static/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="./Tpl/static/kindeditor/lang/zh_CN.js"></script>
<link rel="stylesheet" href="./Tpl/static/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="./Tpl/Qyapp/Static/Css/uploadify.min.css" />
<script src="./Tpl/Qyapp/Static/Js/jquery-migrate.min.js" type="text/javascript"></script>
<script type="text/javascript">
	KindEditor.ready(function(K) {
		var editor;
		editor = K.create('textarea[name="content"]', {
			resizeType : 0,
			allowPreviewEmoticons :false,
			allowImageUpload :true,
			uploadJson:'<?php echo U("Adminupload/uploadType",array("is_url"=>1,"file_type"=>"image"));?>',
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
			uploadJson:'<?php echo U("Adminupload/uploadType",array("is_url"=>1,"file_type"=>"image"));?>',
			formatUploadUrl:false
		});	
		K('#image3').click(function() {

			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : K('#url3').val(),
					clickFn : function(url, title, width, height, border, align) {
						$('.imgurl').val(url); 
						$('.thumb_img').attr('src',url);		
						editor.hideDialog();
					}
				});
			});
		});			
	});
</script>
<script>
$(function(){
  $(".save_c").click(function() {
    var imgurl 	  = encodeURIComponent($(".imgurl").val());
	$.ajax({
			type: "post",  
			url:"<?php echo U('Userinfo/headimg');?>",
			dataType:'json',
			data:'imgurl='+imgurl,
			success:function(json){
				var status = json.status;
				if(status==0){
					alert('设置成功');
					window.location.reload();
				}else{
					alert('设置失败');
				}

			}
		});
  });
  
})
</script>
	 <div id="editCompany" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>  
	 <div id="editCorpId" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>  
	 <div id="editPassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>  
	<div id="editNotice" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>
	<div id="editUpdate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div> 	 	
    <section class="vbox">
        <header class="header bg-white b-b b-light">
            <p>账号信息</p>
        </header>
        <section class="scrollable  wrapper">
            <section class="panel panel-default panel-max-width">
                <div class="panel-body">
                    <div class="entity-panel-body form-horizontal">

                        <div class="form-group padding-left">
                            <div class="col-sm-12">
                                <div class="col-sm-2">
                                    <img class="thumb_img" src="<?php if($infos['headimg'] != ''): echo ($infos["headimg"]); else: ?>./assets/images/avatar1.jpg<?php endif; ?>" style="max-height: 100px;" />
									<input name="imgurl" class="imgurl" type="hidden" value="">
                                </div>
                                <div class="pull-right m-t-lg">
                                    <div class="fileinput" data-toggle="ajaxfile" data-type="img" data-target=".js_view_img" data-path="<?php echo U('Userinfo/editHead',array('token'=>$_GET['token']));?>">
									
									
                                    <span class="btn btn-default btn-file"><span class="fileinput-new"  id="image3">上传</span>						</span>
                                    </div>
									<div class="fileinput" data-toggle="ajaxfile" data-type="img" data-target=".js_view_img" data-path="<?php echo U('Userinfo/editHead',array('token'=>$_GET['token']));?>">
                                    <span class="btn btn-default btn-file"><span class="fileinput-new save_c"><font color=green>保存</font></span>
                                       </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">账号  </label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo ($infos["username"]); ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">联系人</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo ($infos["contact"]); ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">手机号</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo ($infos["mp"]); ?></p>
                            </div>
                        </div>
						 <div class="form-group">
                            <label class="col-sm-1 control-label">可信域名</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo ($infos["host"]); ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">企业名称 </label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo ($infos["qyname"]); ?></p>
                            </div>
                            <div class="col-sm-1">
								<p class="form-control-static pull-right">
								<a class="btn btn-default"  onclick="editCompany();" >修改</a>
								</p>
                            </div>
                        </div>											
                        <div class="form-group">
                            <label class="col-sm-1 control-label">企业地址 </label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo ($infos["address"]); ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">所属行业</label>
                            <div class="col-sm-10">
                                <p class="form-control-static"><?php echo ($infos["industry"]); ?></p>
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">套餐类型</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo ($data["title"]); ?></p>
                            </div>
                            <div class="col-sm-2">
                                <p class="form-control-static pull-right">
                                    <a href="javascript:;" target="_blank" class="btn btn-default" title="续费" onclick="editUpdate();">续费</a>
                                    <a href="javascript:;" target="_blank" class="btn btn-default" title="升级" onclick="editUpdate();">升级</a>
                                </p>
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">密码    </label>
                            <div class="col-sm-9">
                                <p class="form-control-static"></p>
                            </div>
                            <div class="col-sm-2">
                                <p class="form-control-static pull-right"><button type="button" class="btn btn-default" onclick="editPassword();">修改</button></p>
                            </div>


							
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group padding-left">
                            <div class="col-sm-12"><h5 class="relative"><strong>消息通知</strong><div class="absoluter">
                                        <button type="button" class="btn btn-default" onclick="editNotice();">修改</button>
                                    </div></h5></div>
 
						
                            <div class="col-sm-12">
                                <p class="form-control-static ">系统通知 官方通知 关注通知 其他消息</p>
                            </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group padding-left">
                            <div class="col-sm-12"><h5 class="relative"><strong>开发者凭据</strong><div class="absoluter">
                            <button type="button" class="btn btn-default" onclick="editCorpId();">修改</button>
                                    </div></h5></div>
					
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">CorpID:   </label>
                            <div class="col-sm-11">
                                <p class="form-control-static"><?php echo ($infos["corpid"]); ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label">CorpSecret:   </label>
                            <div class="col-sm-11">
                                <p class="form-control-static"><?php echo ($infos["corpsecret"]); ?></p>
                            </div>
                        </div>
						
						 <div class="line line-dashed line-lg pull-in"></div>
						
						 <div class="form-group">
                            <label class="col-sm-1 control-label">开源协议:   </label>
                            <div class="col-sm-11">
                                <p class="form-control-static">		<p style="padding-left:350px;">深度实业集团网络科技有限公司</P>

      <p>保留所有权利。感谢您选择深度实业集团企业号系统。希望我们的努力能为您提供一个高效快速和强大的微信办公管理系统。</P>

     <p>深度实业集团网络科技有限公司为本产品的开发商，依法独立拥有产品著作权(版权登记号：2015SR188575)。深度实业集团官方网站为http://www.wxopen.cn</P>

     <p>深度实业集团企业号著作权已在中华人民共和国国家版权局注册，著作权受到法律和国际公约保护。使用者：无论个人或组织、盈利与否、用途如何（包括以学习和研究为目的），均需仔细阅读本协议，在理解、同意、并遵守本协议的全部条款后，方可开始使用本软件。</P>

    <p> 本授权协议适用且仅适用于企业号3.4.0 版本，深度实业集团网络科技有限公司拥有对本授权协议的最终解释权。</P>

<p>I. 协议许可的权利 </P>
<p>1. 您可以在完全遵守本最终用户授权协议的基础上，将本软件应用于非商业用途(包括个人用户：不具备法人资格的自然人，以个人名义从事电子商务开设网店的；非盈利性用途：从事非盈利活动的商业机构及非盈利性组织，将深度实业集团企业号产品用且仅用于产品演示、展示及发布，而并不是用来买卖及盈利的运营活动的) </P>
<p>2. 您可以在协议规定的约束和限制范围内修改深度实业集团企业号源代码(如果被提供的话)或界面风格以适应您的网站要求。</P> 
<p>3. 您拥有使用本软件构建的商店中全部会员资料、文章、商品及相关信息的所有权，并独立承担与其内容的相关法律义务。 </P>
<p>4. 获得商业授权之后，您可以将本软件应用于商业用途，同时依据所购买的授权类型中确定的技术支持期限、技术支持方式和技术支持内容，自授权时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。商业授权用户享有反映和提出意见的权力，相关意见将被作为首要考虑，但没有一定被采纳的承诺或保证。 </P>

<p>II. 协议规定的约束和限制 </P>
<p>1. 未获商业授权之前，不得将本软件用于商业用途(包括但不限于企业法人经营的企业网站、经营性网站、以盈利为目或实现盈利的网站)。</P> 
<p>2. 不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。 </P>
<p>3. 无论如何，即无论用途如何、是否经过修改或美化、修改程度如何，只要使用深度实业集团企业号的整体或任何部分，未经书面许可，网站页面页脚处的深度实业集团企业号 名称和深度实业集团网络科技有限公司下属网站(http://www.wxopen.cn) 的链接都必须保留，而不能清除或修改。</P> 
<p>4. 禁止在深度实业集团企业号的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。 </P> 
<p>5. 如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回，并承担相应法律责任。 </P> 

<p>III. 有限担保和免责声明 </P> 
<p>1. 本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。 </P> 
<p>2. 用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。 </P> 
<p>3.深度实业集团网络科技有限公司不对使用本软件构建的商店中的文章或信息承担责任，但在不侵犯用户隐私信息的前提下，保留以任何方式获取用户及商品信息的权利。 </P> 
<p>有关深度实业集团企业号 最终用户授权协议、商业授权与技术服务的详细内容，均由深度实业集团企业号 </P> 官方网站独家提供。深度实业集团网络科技有限公司拥有在不事先通知的情况下，修改授权协议和服务价目表的权力，修改后的协议或价目表对自改变之日起的新授权用户生效。</P>  <p>电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦开始安装微易科技企业号，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权力的同时，</P>  <p>受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。</P>

                 <p style="float:right;padding-top:30px;"> 深度实业集团网络科技有限公司</P></p>
                            </div>
                        </div>
						
						
						
						
						
						
						
						
						
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
	
<script type="text/javascript">  
	function editNotice(){
		$('#editNotice').load("<?php echo U('Userinfo/editNotice',array('token'=>$_GET['token']));?>", function(){
			 $('#editNotice').modal();
		});		   
	}
	function editPassword(){
		$('#editPassword').load("<?php echo U('Userinfo/editPassword');?>", function(){
			 $('#editPassword').modal();
		});		   
	}
	function editCompany(){
		$('#editCompany').load("<?php echo U('Userinfo/editCompany');?>", function(){
			 $('#editCompany').modal();
		});		   
	}
	function editCorpId(){
		$('#editCorpId').load("<?php echo U('Userinfo/editCorpId',array('token'=>$_GET['token']));?>", function(){
			 $('#editCorpId').modal();
		});		   
	}
	function editUpdate(){
		$('#editUpdate').load("<?php echo U('Userinfo/editUpdate',array('token'=>$_GET['token']));?>", function(){
			 $('#editUpdate').modal();
		});		   
	}
</script> 		
				
                    </section>
                </section>
            </section>
        </section>
    </section>
    <div class="pageload-overlay" style="display: none;"></div>
    <div id="loading_done" style="display: none;"></div>

<!--feedback-->
<div class="modal fade in" id="feedback" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class=" icon-comment-alt"></i>反馈建议 </h4>
            </div>
            <form class="form-horizontal" target="_self" >
                <div class="modal-body" style="overflow: visible">
                    <div class="row-fluid">
                        <div id="pp">
                            <p>亲爱的用户</p>

                            <p class="bbottom">
                                欢迎您访问官方网站！我们很乐意分享您的感受，欢迎提出意见和建议，我们会认真对待您的反馈，感谢您的关注和支持，您的建议将帮助我们改进，为您提供更好的服务！</p>

                            <p><b>请留下您的宝贵意见和建议！（请填写）</b></p>

                            <textarea name="content" class="input-block-level" placeholder="输入文本..." rows="4" id="feedback-text"></textarea>

                            <p style="margin-top:10px">
                                您常用的电子邮箱是？（请填写）<span style="margin-left:20px">*请尽量填写，以便我们尽快回复您！</span></p>
                            <input type="text" placeholder="如：...@163.com" name="email" class="input-block-level" id="feedback-input">

                            <p style="margin-top:10px">请输入下图中的字符：</p>
                            <input type="text" name="code" maxlength="4" class="input-block-level" id="feedback-checkcode" style="width:160px;display: inline">
                            <img style="cursor: pointer;width:60px;height:30px;margin-top:-2px" onClick="this.src=&#39;/feedback/code?w=60&amp;h=30&amp;_t=&#39;+Math.random()" src="">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit_but" data-path="/feedback/index">提交
                    </button>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true" id="close_but">取消</button>
                </div>
            </form>
        </div>
    </div>
</div>



</body></html>