<?php if (!defined('THINK_PATH')) exit();?>        <div class="wrapper b-b header"><b>考试</b></div>
        <ul class="nav">
			<li class="b-b b-light">
                <a href="<?php echo U('Test/index',array('mid'=>$_GET['mid']));?>" target="_self" ><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>试卷管理</a>
            </li>
			<li class="b-b b-light">
                <a href="<?php echo U('Test/lists',array('mid'=>$_GET['mid']));?>" target="_self" ><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>用户管理</a>
            </li>		
            <li class="b-b b-light">
                <a href="<?php echo U('Test/test_question',array('mid'=>$_GET['mid']));?>" target="_self" ><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>题库管理</a>
            </li>			
			<li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('mid'=>$_GET['mid']));?>" target="_self" ><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
            <li class="b-b b-light">
                <a href="<?php echo U('Appmsg/conf',array('mid'=>$_GET['mid']));?>" target="_self" ><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
            </li>
            
        </ul>