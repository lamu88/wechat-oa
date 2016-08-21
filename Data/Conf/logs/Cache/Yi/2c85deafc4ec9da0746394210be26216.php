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
			<a href="<?php echo U('usernodeAdd');?>" class="btn btn-sm btn-default " title="新增用户等级">
				新增用户等级
			</a>
			 <span style="display:block;float:right;padding-top:10px;color:red; ">试用版本不能删除,用户可注册后试用天数可在"站点管理"设置</span> 
            </header>
            <section class="scrollable wrapper w-f">
                <section class="panel panel-default ">
                    <div class="table-responsive">
                        <table class="table table-hover m-b-none entity-view" data-path="/research/Detail?pid={0}">
                            <thead>
                            <tr>
                                <th >ID</th>
                                <th>等级名称</th>
								 <th class="th-sortable" data-sort-name="allnum">等级价格</th>
                                <th class="th-sortable" data-sort-name="depart">应用数量</th>
								<th class="th-sortable" data-sort-name="depart">状态</th>
								<th class="th-sortable" data-sort-name="employednum">管理操作</th>
                            </tr>
                            </thead>
                            <tbody id="mytable">
							    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userlist): $mod = ($i % 2 );++$i;?><tr data-id="xmZxUgKik1YMB-0UH3HPjsjaPgNmfsIk" id="">
                                        <td><?php echo ($userlist["id"]); ?></td>
										 <td><?php echo ($userlist["title"]); ?></td>
                                        <td><?php echo ($userlist["price"]); ?></td>
										 <td><?php echo ($userlist["nums"]); ?></td>
                                        <td>
										<?php if($userlist['status'] == '1'): ?>开启<?php endif; ?>
										<?php if($userlist['status'] == '0'): ?>关闭<?php endif; ?>
										</td>
										 <td>
										<a href="<?php echo U('usernodeAdd',array('id'=>$userlist['id']));?>" class="btn btn-sm btn-default">修改</a><?php if($userlist['id'] != '1'): ?><a href="<?php echo U('usernodeDel',array('id'=>$userlist['id']));?>" class="btn btn-sm btn-default">删除</a><?php endif; ?>
										</td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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