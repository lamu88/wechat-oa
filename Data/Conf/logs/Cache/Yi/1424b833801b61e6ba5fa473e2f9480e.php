<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn" class="app fadeInUp animated">

<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta content="" name="Keywords" />
    <meta content="" name="Description" />
	<link href="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./Tpl/Qyapp/Static/Css/animate.min.css" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/font-awesome.min.css" rel="stylesheet">
    <link href="./Tpl/Qyapp/Static/Css/style.min.css" rel="stylesheet">
	<script src="./Tpl/Qyapp/Static/Js/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="./Tpl/Qyapp/Static/Js/bootstrap/3.1.1/dist/js/bootstrap.min.js"></script>		
</head>
<body>
<section class="hbox stretch">
    <aside>
        <section class="vbox">
          <header class="header bg-white b-b clearfix">
			<a href="<?php echo U('add');?>" class="btn btn-sm btn-default " title="新增连接">
				新增连接
			</a>
			 <span style="display:block;float:right;padding-top:10px;color:red; "></span> 
            </header>
            <section class="scrollable wrapper w-f">
                <section class="panel panel-default ">
                    <div class="table-responsive">
                        <table class="table table-hover m-b-none entity-view" data-path="/research/Detail?pid={0}">
                            <thead>
                            <tr>
								<th class="th-sortable" data-sort-name="depart">ID</th>
								<th class="th-sortable" data-sort-name="allnum">链接名称</th>
								<th class="th-sortable" data-sort-name="depart">链接地址</th>
								<th class="th-sortable" data-sort-name="depart">所属代理</th>
								<th class="th-sortable" data-sort-name="depart">状态</th>
								<th class="th-sortable" data-sort-name="employednum">管理操作</th>
                            </tr>
                            </thead>
                            <tbody id="mytable">
									<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="xmZxUgKik1YMB-0UH3HPjsjaPgNmfsIk" id="">
										<td><?php echo ($vo["id"]); ?></td>
										<td><?php echo ($vo["key"]); ?></td>
										<td><?php echo ($vo["link"]); ?></td>
										<td><?php echo ($vo["username"]); ?></td>
										<td ><?php if(($vo["status"]) == "1"): ?><font color="red">√</font><?php else: ?><font color="blue">×</font><?php endif; ?> </td>
										<td>
										<a href="<?php echo U('Links/edit/',array('id'=>$vo['id']));?>" class="btn btn-sm btn-default">修改</a>
										 
										 <a href="<?php echo U('Links/del/',array('id'=>$vo['id']));?>" class="btn btn-sm btn-default">删除</a>
										</td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>	
									<tr bgcolor="#FFFFFF"> 
									  <td colspan="8"><div class="listpage"><?php echo ($page); ?></div></td>
									</tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </section>
            <footer class="footer bg-white b-t">
                <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                        <p class="text-muted m-t"><?php echo ($page); ?></p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-sm m-b-none" data-pages-total="1" data-page-current="1"></ul>
                    </div>
                </div>
            </footer>

        </section>
    </aside>
</section>
<section class="entity-panel hd" id="info">
</section>
		
</body>

</html>
</html>