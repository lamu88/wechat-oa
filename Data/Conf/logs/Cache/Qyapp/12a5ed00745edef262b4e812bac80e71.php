<?php if (!defined('THINK_PATH')) exit();?> <header class="header bg-white b-b clearfix">
	<form class="talbe-search" method="get" action=""  target="_self" >
		<div class="row m-t-sm">
			<div class="col-sm-8 m-b-xs">
				 <div class="btn-group m-l">
					<input type="hidden" name="type" value="0">
					<a href="javascript:void();" class="btn btn-sm btn-default  nodeid" onclick="selectMember('<?php echo ($nodeid); ?>',0)" nodeid="" status="0" title="全部">
						全部
					</a>
					<a href="javascript:void();" class="btn btn-sm btn-default  nodeid" onclick="selectMember('<?php echo ($nodeid); ?>',1)" nodeid="" status="1" title="已关注">
						已关注
					</a>
					<a href="javascript:void();" class="btn btn-sm btn-default nodeid" onclick="selectMember('<?php echo ($nodeid); ?>',4)"  nodeid="" status="4" title="未关注">
						未关注
					</a>
					<a href="javascript:void();" class="btn btn-sm btn-default nodeid" onclick="selectMember('<?php echo ($nodeid); ?>',2)"  nodeid="" status="2" title="已禁用">
						已禁用
					</a>
					<a href="javascript:void();" class="btn btn-sm btn-default nodeid" onclick="menberAdd();" nodeid="" title="新增成员">
						新增成员
					</a>  
					<a href="<?php echo U('Index/userup');?>" target="_self" class="btn btn-sm btn-default nodeid" nodeid="" title="一键同步通讯录">
						一键同步通讯录
					</a>  
				</div>
			</div>	
			<div class="col-sm-3 m-b-xs">
				<div class="input-group js_show_date js_show_date_0 " id="select_4" >
					<input type="text" class="form-control input-sm" name="username" id="autoComplete" value="" placeholder="请输入用户名"/>									
					<span class="input-group-addon btn-sm" onclick="searchInfo();" id="clickSearch" nodeid="<?php echo ($nodeid); ?>" style="cursor:pointer;"><i class="fa fa-search"></i></span>									
				</div>	
		  </div>					
	<div id="memberAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>  
		</div>
		
		<input type="hidden" name="pageNumber" id="pageNumber" value="1">
		<input type="hidden" name="orderBy" id="orderBy" value="desc">
		<input type="hidden" name="order" id="order" value="depart">
		<input type="hidden" name="bdid" value="">
	</form>
</header>

<section class="vbox">

	<section class="scrollable wrapper w-f">
		<section class="panel panel-default  ">
			<div class="table-responsive">
				<table class="table table-hover m-b-none entity-view">
					<thead>
						<tr>
							<th>姓名</th>
							<th>帐号</th>
							<th>职位</th>
							<th>电话</th>
							<th>邮箱</th>
							<th>状态</th>
						</tr>
					</thead>
					
					<tbody id="mytable">
					<?php if($userlist): if(is_array($userlist)): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$userlist): $mod = ($i % 2 );++$i;?><tr id="<?php echo ($userlist["userid"]); ?>">
							<td  ><?php echo ($userlist["name"]); ?></td>
							<td ><?php echo ($userlist["userid"]); ?></td>
							<td  ><?php echo ($userlist["position"]); ?></td>
							<td ><?php echo ($userlist["mobile"]); ?></td>
							<td  ><?php echo ($userlist["email"]); ?></td>
							<td >
							<?php if($userlist['status'] == 1): ?>已关注<?php endif; ?>
							<?php if($userlist['status'] == 2): ?>已禁用<?php endif; ?>
							<?php if($userlist['status'] == 4): ?>未关注<?php endif; ?>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
						<tr>
							<td colspan="6"><center>             					
							   暂无数据</center>
							</td>				
						</tr><?php endif; ?>					
					</tbody>

				
				</table>
			</div>
		</section>
		<!-- <footer class="footer bg-white b-t clearfix"> -->
		<!-- <div style="position:fixed;width:100%;left:0;bottom:0;background-color:#fff;">	 --> 
	<!-- 				<footer class="footer bg-white b-t">
			<div class="row text-center-xs">
				<div class="col-md-6 hidden-sm">
					<p class="text-muted m-t">总共0条 当前为第1页</p>
				</div>
				<div class="col-md-6 col-sm-12 text-right text-center-xs">
					<ul class="pagination pagination-sm m-t-sm m-b-none" data-pages-total="0" data-page-current="1" style="display: none;"></ul>
				</div>
			</div>
		</footer> -->
		<footer class="footer bg-white b-t">
			<div class="row text-center-xs">
				<div class="col-md-6 hidden-sm">
					<p class="text-muted m-t"><?php echo ($page); ?></p>
				</div>
				<div class="col-md-6 col-sm-12 text-right text-center-xs">
					<ul class="pagination pagination-sm m-t-sm m-b-none" data-pages-total="" data-page-current=""></ul>
				</div>
			</div>
		</footer>				
		<!-- </div> -->	
	</section>	
</section>
<script src="./Tpl/Qyapp/Static/Js/weiyi.js" type="text/javascript"></script>
<script type="text/javascript">
$('#mytable tr').click(function(){
	$(this).each(function(){
        var userId = $(this).attr('id');
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
				$('#info').load("index.php?g=Qyapp&m=Member&a=memberInfo&id="+userId+'&node=<?php echo ($node["id"]); ?>');
				$('.entity-panel').removeClass('hd');
				$('.entity-panel').css('right','0px');				    
			}
		}else{
		    $('#info').empty();   
			$('#info').load("index.php?g=Qyapp&m=Member&a=memberInfo&id="+userId+'&node=<?php echo ($node["id"]); ?>');
			$('.entity-panel').removeClass('hd');
			$('.entity-panel').css('right','0px');			    
		}
	});
});	
function selectMember(nodeid,status){
	$('#userList').load("index.php?g=Qyapp&m=Tree&a=getMember&nodeid="+nodeid+'&status='+status);
}

function selectAuto(){
	 $.ajax({
		type:"POST",
		url:"index.php?g=Qyapp&m=Common&a=searchUsers",
		//data:"id="+id,
		dataType:'json',
		success:function(json){
		var status = json.status;
		  if(status==1)
		  {
			var data = json.data;
				$('#autoComplete').AutoComplete({
					'data': data,
					'width':200,
					'listStyle': 'custom',
					'maxHeight': 240,
					'createItemHandler': function(index, data){
						var div = $("<div style='height:36px;padding-top:2px'></div>")
						var cell1 = $("<div style='display:table-cell;vertical-align:top;'></div>").appendTo(div);
						var cell1_1 = $("<img style='width:32px;height:32px;'></img>").attr('src', data.image).appendTo(cell1);
						var cell2 = $("<div style='display:table-cell;vertical-align:middle;padding-right:10px'></div>").appendTo(div);
						var cell2_1 = $("<div></div>").append(data.label).appendTo(cell2);
						var cell2_2 = $("<div style='vertical-align:top;'></div>").appendTo(cell2);
						return div;
					}
				});			
		  }
		  else
		  {
			  alert('该成员不存在');
		  }
		}
	}); 
		
}

function searchInfo(){
    var searchValue = $('#autoComplete').val();
	if(searchValue == null || searchValue.length ==0){
	    alert('请输入用户名！');
		return false;
	}
	var nodeid =  $('#clickSearch').attr('nodeid');
	$('#userList').load("index.php?g=Qyapp&m=Tree&a=getOne&nodeid="+nodeid+'&name='+searchValue);
}
</script>			
<script type="text/javascript">
$(document).ready(function(){
	selectAuto();	
});
</script>