<?php if (!defined('THINK_PATH')) exit();?><section class="entity-panel-wrapper"  id="user<?php echo ($memberinfo["userid"]); ?>">
	<header class="entity-panel-header header">
		<p>成员资料</p>
		<button type="button" class="close m-t" data-dismiss="entity" onclick="panelClose();">&times;</button>
	</header>
	<div class="entity-panel-body form-horizontal">
		<div class="col-sm-offset-1  m-t-sm m-b-sm">
			<div class="media m-xs">
				<span class="pull-left thumb-md">
					<img src="<?php if($memberinfo['pic'] == $host): ?>./assets/images/avatar1.jpg<?php else: echo ($memberinfo["pic"]); endif; ?>" alt="<?php echo ($memberinfo["name"]); ?>" />
					
				</span>
				<div class="pull-right">
					<label class="label label-default">
					<?php if($memberinfo['status'] == 1): ?>已关注<?php endif; ?> <?php if($memberinfo['status'] == 2): ?>已冻结<?php endif; if($memberinfo['status'] == 3): ?>未关注<?php endif; ?>   </label>
				</div>
				<div class="media-body">
					<h3 class="m-t-none"><b><?php echo ($memberinfo["name"]); ?></b></h3>
					<p><?php echo ($memberinfo["position"]); ?></p>
					<p></p>
				</div>
			</div>
		</div>
					<div class="form-group">
			<label class="col-sm-3 control-label">手机</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($memberinfo["mobile"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group">
			<label class="col-sm-3 control-label">微信号</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($memberinfo["weixinid"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group">
			<label class="col-sm-3 control-label">是否为主管</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php if($memberinfo['status'] == 1): ?>是<?php endif; ?> <?php if($memberinfo['status'] == 0): ?>否<?php endif; ?></p>
			</div>
		</div>		
		<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group">
			<label class="col-sm-3 control-label">部门</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($str); ?></p>
			</div>
		</div>	
		
<!-- 		<div class="form-group">
			<label class="col-sm-3 control-label">部门</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($str); ?></p>
			</div>
		</div> -->
		

	</div>
	<footer class="entity-panel-footer footer  text-right">
		<button type="button" class="btn btn-default"  onclick='addleader("<?php echo ($memberinfo["userid"]); ?>","<?php echo ($memberinfo["id"]); ?>")'>设置为部门领导</button>
		<button type="button" class="btn btn-default"  onclick='editMember("<?php echo ($memberinfo["userid"]); ?>")'>修改</button>
		<div class="btn-group dropup">
			<?php if($memberinfo['enable'] == 0): ?><button type="button" class="btn btn-default m-r-xs"  onclick='start("<?php echo ($memberinfo["userid"]); ?>")'>开启</button>
			<?php else: ?>
			<button type="button" class="btn btn-default m-r-xs"  onclick='forbidden("<?php echo ($memberinfo["userid"]); ?>")'>禁用</button><?php endif; ?>
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">更多</button>
			<ul class="dropdown-menu  text-left">
				<li>
						<a href="javascript:;" onclick='moveMember("<?php echo ($memberinfo["userid"]); ?>")'>移动到</a>
				</li>
				<li>
					<a href="javascript:;" data-confirm="true"  onclick='delMember("<?php echo ($memberinfo["userid"]); ?>")' data-msg="确定删除 该成员？">删除</a>
				</li>
			</ul>
		</div>
	</footer>
</section>
<input type="hidden" name="moveid" id="moveId" data-userid="<?php echo ($memberinfo["userid"]); ?>" value=""/>
<div id="editMember" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<div id="addleader" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>


<div id="moveMember" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>
<div id="delMember" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">

		<div class="modal-header">
		  <button type="button" class="close" onclick="guanbi();">&times;</button>
		  <h4 class="modal-title" id="myModalLabel">选择部门</h4>
		</div>
		<div class="modal-body">
		<aside>
			 <div id="cont"></div> 
		
		</aside>

		 </div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-primary" onclick="guanbi();">确定</button> 		
		  <button type="button" class="btn btn-default" onclick="cancel();">取消</button> 
		</div>

	  </div>
	</div>
</div>
<script type="text/javascript">
function panelClose(){
   $('.entity-panel').addClass('hd');
}

	function editMember(userId){
		$('#editMember').load("index.php?g=Qyapp&m=Member&a=editMember&userid="+userId, function(){
			 $('#editMember').modal();
			 if($('.modal-backdrop').length>0){
			     $('.modal-backdrop').remove();
			 }
		});		   
	}
	
	
	function addleader(userId,id){
		$('#addleader').load("index.php?g=Qyapp&m=Member&a=addleader&mid=<?php echo $_GET['mid'];?>&id="+id+'&nodeid=<?php echo $_GET['node'];?>', function(){
			 $('#addleader').modal();
			 if($('.modal-backdrop').length>0){
			     $('.modal-backdrop').remove();
			 }
		});		   
	}

	function moveMember(userId){
		$('#moveMember').load("index.php?g=Qyapp&m=Tree&a=moveUser&userid="+userId, function(){
			 $('#moveMember').modal();
			 
			 if($('.modal-backdrop').length>0){
			     $('.modal-backdrop').remove();
			 }			 
		});		   
	}

	function forbidden(userId){
	
        $.ajax({
			type:"POST",
			url:"index.php?g=Qyapp&m=Member&a=forbidden&mid=<?php echo $_GET['mid'];?>&userid="+userId,
			data:"userid="+userId,
			dataType:"json",
			success:function(data){
			alert('禁用成功');
				var status = json.status;
			  if(status==1)
			  {
				alert('禁用成功');
				window.location.reload();
			      $('.m-r-xs').html('禁用');
			  }
			  else
			  {
				alert('禁用失败');
				window.location.reload();
				  $('.m-r-xs').html('启用');
			  }
			}
		});	
	}
	
	
	function start(userId){
        $.ajax({
			type:"POST",
			url:"index.php?g=Qyapp&m=Member&a=start&mid=<?php echo $_GET['mid'];?>&userid="+userId,
			data:"userid="+userId,
			dataType:"json",
			success:function(data){
			alert('开启成功');
				var status = json.status;
			  if(status==1)
			  {
				alert('开启成功');
				window.location.reload();
			      $('.m-r-xs').html('开启');
			  }
			  else
			  {
				alert('开启失败');
				window.location.reload();
				  $('.m-r-xs').html('启用');
			  }
			}
		});	
	}

	function delMember(userId){
 		$.ajax({
			type:"POST",
			url:"index.php?g=Qyapp&m=Member&a=delMember&mid=<?php echo $_GET['mid'];?>&userid="+userId,
			data:"userid="+userId,
			dataType:'json',
			success:function(json){
			var status = json.status;
			  if(status==1)
			  {
				alert('删除成功');
				window.location.reload();
			      $('#cont').html('删除成功');
				  $('#delMember').model();
			  }
			  else
			  {
				alert('删除失败');
				window.location.reload();
				  $('#cont').html('删除失败');
				  $('#delMember').model();
			  }
			}
		});       	
	}	
	
	function cancel(){
		$('#moveMember').modal('hide');
	}

	function moveUser(){
	    var  moveTo= $('#moveId').val();
		var userid = $('#moveId').attr('data-userid');
		//alert(moveTo);
		//alert(userid);
 		$.ajax({
			type:"POST",
			url:"index.php?g=Qyapp&m=Member&a=moveMember&mid=<?php echo $_GET['mid'];?>",
			data:{userid:userid,moveto:moveTo},
			dataType:'json',
			success:function(json){
			var status = json.status;
			  //alert('删除成功');
			  //window.location.reload();
			  if(status==1)
			  {
				alert('移动成功');
			    window.location.reload();
			      //$('#cont').html('删除成功');
				  $('#delMember').model();
			  }
			  else
			  {
				alert('移动失败');
				window.location.reload();
				  //$('#cont').html('删除失败');
				  $('#delMember').model();
			  }
			}
		}); 
	}
	
	function guanbi(){
		$('#moveMember').modal('hide');
	}	
</script>