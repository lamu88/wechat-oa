<?php if (!defined('THINK_PATH')) exit();?>
 <div class="wrapper b-b header"><b>工作日志</b></div>
        <ul class="nav">
			 <li class="b-b b-light open"><a href="<?php echo U('Log/index',array('mid'=>$_GET['mid']));?>"  target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>日志查看</a></li>	
			 <li class="b-b b-light"><a href="<?php echo U('Log/type',array('mid'=>$_GET['mid']));?>"  target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>日志分类</a></li>				 
			<li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
			<li class="b-b b-light">
			<a href="<?php echo U('Appmsg/conf',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
		</li>
            
        </ul>