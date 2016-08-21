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
<div id="myModal" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<section class="hbox stretch">
    <aside>
        <section class="vbox">
			<header class="header bg-white b-b clearfix">
				<form class="talbe-search" method="post" action="">
                <div class="row m-t-sm">					
                        <div class="col-sm-4 m-b-xs">							
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
										<span class="dropdown-label" id="searchTypeTxt1">按用户名查询</span>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-select js_select_search" id="searchMenu">
                                        <li >
                                            <a href="javascript:;">
                                                <input type="radio" value="0" name="searchBy"/>按代理查询
                                            </a>
                                        </li> 
                                        <li >
                                            <a href="javascript:;">
                                                <input type="radio" value="1" name="searchBy" />按用户名查询
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="input-group js_show_date js_show_date_0 " id="select_4" >
									<input type="text" class="form-control input-sm" name="name" id="searchUsername" value="<?php echo ($username); ?>" 	placeholder="请输用户名"/>
										<input type="text" class="form-control input-sm" style="display:none" name="agency" id="searchDepartname" value="<?php echo ($departname); ?>" placeholder="请输代理名称" />									
										<span class="input-group-addon btn-sm" onclick="searchInfo();" id="clickSearch" style="cursor:pointer;"><i class="fa fa-search"></i></span>									
								</div>																		
                            </div>
                        </div>													
                    </div>
					   <script>  
						function searchInfo(){
						   $('form').submit();						   
						}									
						$('#searchMenu li').each(function(){
						    $(this).click(function(){
							    if($(this).index() == 0){
								    $('#searchTypeTxt1').text('按用户名查询');
									$('#searchDepartname').css('display','block');
									$('#searchUsername').css('display','none');
								}else{
								    $('#searchTypeTxt1').text('按代理名称查询');
									$('#searchUsername').css('display','block');
									$('#searchDepartname').css('display','none');																		
									
								}
								
							});
						
						});
                        </script>
                </form>
			</header>
            <section class="scrollable wrapper w-f">
                <section class="panel panel-default ">
                    <div class="table-responsive">
                        <table class="table table-hover m-b-none entity-view" data-path="/research/Detail?pid={0}">
                            <thead>
                            <tr>
                                <th class="th-sortable" data-sort-name="allnum">用户ID</th>
                                <th class="th-sortable" data-sort-name="allnum">用户名</th>
                                <th class="th-sortable" data-sort-name="depart">电话</th>
                                <th class="th-sortable" data-sort-name="number">加入时间</th>
								<th class="th-sortable" data-sort-name="number">到期时间</th>
                                <th class="th-sortable" data-sort-name="employednum">状态</th>
								<th class="th-sortable" data-sort-name="employednum">操作</th>
                            </tr>
                            </thead>
                            <tbody id="mytable">
								<?php if($data): if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userlist): $mod = ($i % 2 );++$i;?><tr data-id="xmZxUgKik1YMB-0UH3HPjsjaPgNmfsIk" id="">
                                        <td><?php echo ($userlist["id"]); ?></td>
                                        <td><?php echo ($userlist["username"]); ?></td>
										<td><?php if($userlist['tel'] == ''): ?>未填写<?php else: echo ($userlist["tel"]); endif; ?></td>
                                        <td><?php echo (date("Y-m-d ",$userlist["addtime"])); ?></td>
										<td><font <?php if($userlist['endtime'] < time()): ?>color="red"<?php endif; ?>><?php echo (date("Y-m-d",$userlist["endtime"])); ?></font></td>
                                        <td>
										<?php echo ($userlist["ty"]["title"]); ?>
										</td>
										 <td>
										 <a href="<?php echo U('useredit',array('id'=>$userlist['id']));?>" class="btn btn-sm btn-default">修改</a>
										  <a href="<?php echo U('userdel',array('id'=>$userlist['id']));?>" class="btn btn-sm btn-default">删除</a>
										</td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
								<?php else: ?>
								<tr><td colspan='10' class="nodata">暂无信息</td></tr><?php endif; ?>		
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