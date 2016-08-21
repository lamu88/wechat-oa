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
                            <a href="<?php echo U('Userinfo/info', array('token' => $token));?>" target="_self"><i class="iconfont icon-account m-r-xs icon-size20"></i>帐号信息</a>
                        </li>
						<li>
                            <a href="<?php echo U('Userinfo/upfile', array('token' => $token));?>"><i class="iconfont icon-binding m-r-xs icon-size20"></i>存储设置</a>
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
<link rel="stylesheet" type="text/css" href="./Tpl/Qyapp/Static/Js/autocomplete/src/jquery.autocomplete.css">	
<script src="./Tpl/Qyapp/Static/Js/jquery-migrate.min.js" type="text/javascript"></script>	
<script src="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/js/bootstrap.min.js"></script>		
<script src="./Tpl/Qyapp/Static/Js/artTemplate/dist/template.js" type="text/javascript"></script>	
<script type="text/javascript" src="./Tpl/Qyapp/Static/Js/autocomplete/src/jquery.autocomplete.js"></script>	
<script src="./Tpl/Qyapp/Static/Js/autocomplete/test/test.js"></script>
<link href="./Tpl/Qyapp/Static/Js/autocomplete/lib/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="./Tpl/Qyapp/Static/Js/autocomplete/lib/google-code-prettify/prettify.js"></script>
<script type="text/javascript" src="./Tpl/Qyapp/Static/Js/autocomplete/lib/google-code-prettify/beautify.min.js"></script>
<body>
<script type="text/javascript">
	$(document).ready(function(){
		selectAuto();	
	});
</script>	
<section class="hbox stretch">
    <aside class="aside-md bg-white b-r" id="subNav">
     
 <div class="wrapper b-b header"><b>微信绩效</b></div>
        <ul class="nav">
		
			 <li class="b-b b-light open"><a href="<?php echo U('Performance/index',array('mid'=>$_GET['mid']));?>"  target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>薪酬设置</a></li>
			<!--<li class="b-b b-light"><a href="<?php echo U('Performance/norm',array('mid'=>$_GET['mid']));?>"  target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>绩效/评分标准</a></li>-->
			<li class="b-b b-light"><a href="<?php echo U('Performance/usersInfo3',array('mid'=>$_GET['mid']));?>"  target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>项目清单</a></li>
			<li class="b-b b-light"><a href="<?php echo U('Performance/usersInfo2',array('mid'=>$_GET['mid']));?>"  target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>KPI指标</a></li>
			<li class="b-b b-light"><a href="<?php echo U('Performance/myteam',array('mid'=>$_GET['mid']));?>"  target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>团队配置</a></li>					
			<li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
			<li class="b-b b-light">
			<a href="<?php echo U('Appmsg/conf',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
		</li>
            
        </ul>
    </aside>
      <aside>
<section class="entity-panel-wrapper" id="user<?php echo ($data["id"]); ?>">
	<header class="entity-panel-header header">

			<a class="btn btn-default" onclick='editsss("<?php echo ($info["id"]); ?>")'>添加类别</a>  
	<!--	<button class="btn btn-default" id="delsubmit" type="button">删除</button>-->
	</header>
		
	
	
	<div class="entity-panel-body form-horizontal">
	 <section class="scrollable  wrapper">
                    <section class="panel panel-default">
                         <div class="table-responsive">
				
                            <table class="table table-hover m-b-none entity-view" data-path="">
							<thead>
                                    <tr>
                                        <th>类别名称</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody id="mytable">
								<?php if($score_projectdata): if(is_array($score_projectdata)): $i = 0; $__LIST__ = $score_projectdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
									
										<?php if($data["pid"] == 0): ?><td><a href="<?php echo U('kpiinfo',array('id'=>$data['id']));?>" target="_self"><span class="caname" id="<?php echo ($data["id"]); ?>"><?php echo ($data["name"]); ?></span>	</a></td>
								
											<td><a class="btn-default" onclick='editsadd("<?php echo ($data['id']); ?>")'>编辑</a> <a class="btn-default" onclick='delsubmit("<?php echo ($data['id']); ?>")'>删除</a> </td><?php endif; ?>
									</tr>
									
									<!--<tr id="<?php echo ($data["id"]); ?>">
											href="<?php echo U('kpiinfo',array('id'=>$data['id']));?>"
											<?php if($data["pid"] != 0): ?><td><input type="checkbox"  name="dataid" value="<?php echo ($data["id"]); ?>"/>&nbsp&nbsp&nbsp&nbsp积分项目--<span class="caname" id="<?php echo ($data["id"]); ?>"><?php echo ($data["name"]); ?></span><input type="hidden" value="<?php echo ($data["id"]); ?>"/></td>  
											
												<td>分值：<span class="caname" id="<?php echo ($data["id"]); ?>" name="score"><?php echo ($data["score"]); ?></span></td><?php endif; ?>
									 </tr>--><?php endforeach; endif; else: echo "" ;endif; ?>
								<?php else: ?>
								<tr><td colspan='6' style='text-align: center'>暂无信息</td></tr><?php endif; ?>									
								</tbody>
                            </table>
                        </div>
                    </section>
                </section>
	</div>

</section>

   <div id="apply_edit" class="modal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  </div>
        </aside>
</section>
 <section class="entity-panel hd" id="info" style=" width:35%; right:5;">
</section>	
<script type="text/javascript">

function lookss(d){
	var userId=d;

		if($('#user'+userId).length>0){
			var curId = $('#info').children().attr('id');			
		    if(curId == 'user'+userId){
				if($('.entity-panel').hasClass('hd')){
					$('.entity-panel').removeClass('hd');
				}else{
					$('.entity-panel').addClass('hd');
				}			    
			}else{
				$('#info').empty();   
				$('#info').load("index.php?g=Qyapp&m=Performance&a=kpiinfo&mid=<?php echo $_GET['mid'];?>&id="+userId);
				$('.entity-panel').removeClass('hd');
				$('.entity-panel').css('right','0px');				    
			}
		}else{

		    $('#info').empty();   
			$('#info').load("index.php?g=Qyapp&m=Performance&a=kpiinfo&id="+userId); 
			$('.entity-panel').removeClass('hd');
			$('.entity-panel').css('right','0px');			    
		}
}
	//删除
function delsubmit(data){
	
	//	var data =<?php echo ($_GET['id']); ?>;
		
			$.ajax({
					type: "post",  
					url:"<?php echo U('usersInfo3');?>",
					dataType:'json',
					data:{'deldata':data},
					success:function(json){
						if(json==4){
							alert('删除失败：类别下还有数据噢');
						}else{
							alert('删除成功');
							window.location.reload();
						}
					}
			});

};
function edit(id){
		$('#apply_edit').load("index.php?g=Qyapp&m=Performance&a=users_edit&mid=<?php echo $_GET['mid'];?>&id="+id, function(){
			 $('#apply_edit').modal();
			 if($('.modal-backdrop').length>0){
			     $('.modal-backdrop').remove();
			 }
		});		   
	}
function editsadd(id){

		$('#apply_edit').load("index.php?g=Qyapp&m=Performance&a=score_projectedit&mid=<?php echo $_GET['mid'];?>&id="+id, function(){
			 $('#apply_edit').modal();
			 if($('.modal-backdrop').length>0){
			     $('.modal-backdrop').remove();
			 }
		});		   
	}
	function editsss(id){
		$('#apply_edit').load("index.php?g=Qyapp&m=Performance&a=score_projectedit&mid=<?php echo $_GET['mid'];?>&id="+id, function(){
			 $('#apply_edit').modal();
			 if($('.modal-backdrop').length>0){
			     $('.modal-backdrop').remove();
			 }
		});		   
	}
	//删除操作
	function users_Del(id){

	$.post("index.php?g=Qyapp&m=Borrow_books&a=users_Del&mid=<?php echo $_GET['mid'];?>",
			{'id':id},
			function(d){
				if(d == 1){
					alert("删除成功");
					window.location.reload();
				}else{
					alert('删除失败');
					window.location.reload();
				}
			},
			"json"
		);

	}
	
		
	function panelClose(){
	   $('.entity-panel').addClass('hd');
	}

	function users_borrows(wecha_id){
	
		window.location.href="index.php?g=Qyapp&m=Performance&a=score_projectedit&mid=<?php echo $_GET['mid'];?>&wecha_id="+wecha_id;
	}
	//修改
	$(function() { // 相当于在页面中的body标签加上onload事件 
		$(".caname").click(function() { // 给页面中有caname类的标签加上click函数
		var objTD = $(this);
		var idss =  objTD.attr("id");
		var score =  objTD.attr("name");
		//alert(score);
		var oldText = $.trim(objTD.text()); // 保存老的类别名称
		var input = $("<input type='text' id='<?php echo ($data["id"]); ?>' value='" + oldText + "' />"); // 文本框的HTML代码
		objTD.html(input); // 当前td的内容变为文本框
		// 设置文本框的点击事件失效
		input.click(function() {
			return false;
		}); 
		// 设置文本框的样式
		input.css("border-width", "0px"); //边框为0
		input.height(objTD.height()); //文本框的高度为当前td单元格的高度
		input.width(objTD.width()); // 宽度为当前td单元格的宽度
		input.css("font-size", "14px"); // 文本框的内容文字大小为14px
		input.css("text-align", "center"); // 文本居中
		input.trigger("focus").trigger("select"); // 全选
		// 文本框失去焦点时重新变为文本
		input.blur(function() {
			var newText = $(this).val(); // 修改后的名称
			if(newText==0){
				alert('文字不能为空');
				objTD.html(oldText);
				return false;
			}
			var input_blur = $(this);
			// 当老的类别名称与修改后的名称不同的时候才进行数据的提交操作
			if (oldText != newText) {
				// 获取该类别名所对应的ID(序号)
				//var caid = $.trim(objTD.prev().text());
				//var dataid = $(this).attr("id");
			
				// AJAX异步更改数据库
				if(!score){
					$.ajax({
					type: "post",  
					url:"<?php echo U('usersInfo3');?>",
					dataType:'json',
					data:{'name':newText,'id':idss},
					success:function(json){
						if(json==1){
							
							objTD.html(newText);
						}else{
							alert('修改失败');
						}
					}
					});
				}else{
					if(isNaN(newText)){
						alert('不是数字来的噢');
						objTD.html(oldText);
						return false;
					}
					$.ajax({
					type: "post",  
					url:"<?php echo U('usersInfo3');?>",
					dataType:'json',
					data:{'score':newText,'id':idss,'scoreid':score},
					success:function(json){
						if(json==1){
							objTD.html(newText);
						}else{
							objTD.html(oldText);
							alert('修改失败');
						}
					}
					});
				}
				/*
				var url = "../handler/ChangeCaName.ashx?caname=" + encodeURI(encodeURI(newText)) + "&caid=" + caid + "&t=" + new Date().getTime();
				$.get(url, function(data) {
					if (data == "false") {
						$("#test").text("类别修改失败,请检查是否类别名称重复!");
						input_blur.trigger("focus").trigger("select"); // 文本框全选
					} else {
						$("#test").text("");
						objTD.html(newText);
					}
				});**/
			} else {
			// 前后文本一致,把文本框变成标签
			objTD.html(newText);
			}
		});
	
		});
	});

	// 屏蔽Enter按键
	/*$(document).keydown(function(event) {
		switch (event.keyCode) {
		case 13: return false;
		}
	}); */
</script>