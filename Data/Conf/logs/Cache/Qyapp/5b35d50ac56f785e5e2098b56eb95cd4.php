<?php if (!defined('THINK_PATH')) exit();?>        <div class="wrapper b-b header"><b>报销</b></div>
        <ul class="nav">
        <li class="b-b b-light open">
            <a href="<?php echo U('Applyflow/index',array('mid'=>$_GET['mid']));?>" target="_self">
                <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>配置审核人
            </a>
        </li>
        <li class="b-b b-light ">
        	<a href="<?php echo U('Applyflow/applytype',array('mid'=>$_GET['mid']));?>" target="_self">
        		<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>配置报销类型
        	</a>
        </li>
        <li class="b-b b-light">
            <a href="<?php echo U('Applyflow/details',array('mid'=>$_GET['mid']));?>" target="_self">
                <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>报销明细
            </a>
        </li>		
		<li class="b-b b-light">
		    <a href="<?php echo U('Menu/menu',array('mid'=>$_GET['mid']));?>" target="_self">
		    <i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a>
		</li>
		
		<li class="b-b b-light">
			<a href="<?php echo U('Appmsg/conf',array('mid'=>$_GET['mid']));?>" target="_self">
			<i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
		</li>
            
        </ul>