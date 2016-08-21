<?php if (!defined('THINK_PATH')) exit();?>
<div class="wrapper b-b header"><b>微信考勤</b></div>
<ul class="nav">
	 <li class="b-b b-light open"><a href="<?php echo U('Attendance/index',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>考勤设置</a></li>
	<li class="b-b b-light"><a href="<?php echo U('Attendance/rule',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>考勤规则</a></li>
	<li class="b-b b-light"><a href="<?php echo U('Attendance/address',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>考勤地点</a></li>
	<li class="b-b b-light"><a href="<?php echo U('Attendance/tongji',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>考勤统计</a></li>
				
	<li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
	<li class="b-b b-light">
		<a href="<?php echo U('Appmsg/conf',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
	</li>
	
</ul>