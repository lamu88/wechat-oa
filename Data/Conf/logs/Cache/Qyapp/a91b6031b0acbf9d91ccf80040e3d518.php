<?php if (!defined('THINK_PATH')) exit();?>    <div class="wrapper b-b header"><b>悬赏招聘</b></div>
	<ul class="nav">
		<li class="b-b b-light "><a href="<?php echo U('Hiring/index',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>首页</a></li>
        <li class="b-b b-light "><a href="<?php echo U('Hiring/position',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>职位管理</a></li>
        <li class="b-b b-light "><a href="<?php echo U('Hiring/resume',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>简历管理</a></li>
		<li class="b-b b-light "><a href="<?php echo U('Hiring/reward',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>赏金管理</a></li>
		<li class="b-b b-light "><a href="<?php echo U('Hiring/info',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>企业信息</a></li>
		<li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
		<li class="b-b b-light">
			<a href="<?php echo U('Appmsg/conf',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
		</li>
    </ul>