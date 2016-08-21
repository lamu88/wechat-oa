<?php if (!defined('THINK_PATH')) exit();?>
	<div class="wrapper b-b header"><b>借书</b></div>
	<ul class="nav">
		<li class="b-b b-light open">
			<a href="<?php echo U('Borrow_books/index',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>用户管理</a>
		</li>				
		<li class="b-b b-light"><a href="<?php echo U('Borrow_books/msgs',array('mid'=>$_GET['mid']));?>"  target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>借书管理</a></li>
		<li class="b-b b-light">
			<a href="<?php echo U('Borrow_books/cat',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>分类管理</a>
		</li>
		<li class="b-b b-light">
			<a href="<?php echo U('Borrow_books/room',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>书库</a>
		</li>
		
		<li class="b-b b-light">
			<a href="<?php echo U('Borrow_books/message',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>读者留言</a>
		</li>			
		
		<li class="b-b b-light"><a href="<?php echo U('Menu/menu',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>自定义菜单</a></li>
		<li class="b-b b-light">
			<a href="<?php echo U('Appmsg/conf',array('mid'=>$_GET['mid']));?>" target="_self"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>应用管理</a>
		</li>			
	</ul>