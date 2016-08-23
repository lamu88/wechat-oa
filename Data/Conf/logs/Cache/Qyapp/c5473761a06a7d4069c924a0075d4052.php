<?php if (!defined('THINK_PATH')) exit();?><section class="entity-panel-wrapper" id="user<?php echo ($data["id"]); ?>">

	<header class="entity-panel-header header">
		<p>自定义流程详情</p>
		<button type="button" class="close m-t" data-dismiss="entity" onclick="panelClose();">&times;</button>
	</header>
	<div class="entity-panel-body form-horizontal">
	   
		<div class="form-group">
			<label class="col-sm-3 control-label">流程名称</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($data["name"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">创建人</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo $_SESSION['contact'];?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">创建时间</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo (date("Y-m-d H:i:s",$data["time"])); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">状态</label>
			<div class="col-sm-9">
				<p class="form-control-static">
				<?php if($data['status'] == 1): ?>启用<?php endif; ?>
				<?php if($data['status'] == 0): ?>禁用<?php endif; ?>
				</p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
	   
	</div>
	<footer class="entity-panel-footer footer  text-right">
		<a href="<?php echo U('Workflow/edit',array('mid'=>$_GET['mid'],'id'=>$data['id']));?>" target="_self" class="btn btn-default">编辑</a>
		<a href="<?php echo U('Workflow/type',array('mid'=>$_GET['mid'],'id'=>$data['id']));?>" target="_self" class="btn btn-default">分类管理</a>		
		<?php if($data['status'] == 1): ?><button type="button" class="btn btn-default" data-confirm="true" data-toggle="ajaxPost" data-msg="您确定要冻结该流程吗？"  onclick='freeze("<?php echo ($data["id"]); ?>")' >禁用</button><?php endif; ?>
		<?php if($data['status'] == 0): ?><button type="button" class="btn btn-default" data-confirm="true" data-toggle="ajaxPost" data-msg="您确定要冻结该流程吗？"  onclick='start("<?php echo ($data["id"]); ?>")' >启用</button><?php endif; ?>
		<?php if($data['is_default'] != 1): ?><button type="button" class="btn btn-default" data-confirm="true"  onclick='del("<?php echo ($data["id"]); ?>")' data-toggle="ajaxPost" data-msg="确定删除 当前流程吗？" >删除当前流程</button><?php endif; ?>
	</footer>

</section>
<script type="text/javascript">
function panelClose(){
   $('.entity-panel').addClass('hd');
}
//禁用成员操作
function freeze(id){
	$.ajax({
		type:"POST",
		url:"index.php?g=Qyapp&m=Workflow&a=freeze&mid=<?php echo $_GET['mid'];?>&id="+id,
		data:"id="+id,
		dataType:"json",
		success:function(data){
		alert('禁用成功');
		location.reload();
			var status = json.status;
		  if(status==1)
		  {
			alert('禁用成功');
			location.reload();
			  $('.m-r-xs').html('禁用');
		  }
		  else
		  {
			alert('禁用失败');
			location.reload();
			  $('.m-r-xs').html('启用');
		  }
		}
	});	
}

function start(id){
	$.ajax({
		type:"POST",
		url:"index.php?g=Qyapp&m=Workflow&a=start&mid=<?php echo $_GET['mid'];?>&id="+id,
		data:"id="+id,
		dataType:"json",
		success:function(data){
		alert('开启成功');
		location.reload();
			var status = json.status;
		  if(status==1)
		  {
			alert('开启成功');
			location.reload();
			  $('.m-r-xs').html('禁用');
		  }
		  else
		  {
			alert('开启失败');
			location.reload();
			  $('.m-r-xs').html('启用');
		  }
		}
	});	
}
//删除操作
function del(id){
	$.ajax({
		type:"POST",
		url:"index.php?g=Qyapp&m=Workflow&a=del&mid=<?php echo $_GET['mid'];?>&id="+id,
		data:"id="+id,
		dataType:'json',
		success:function(json){
		var status = json.status;
		  if(status==1)
		  {
			alert('删除成功');location.reload();
			  $('#cont').html('删除成功');
			  $('#delMember').model();
		  }
		  else
		  {
			alert('删除失败');location.reload();
			  $('#cont').html('删除失败');
			  $('#delMember').model();
		  }
		}
	});       	
}		 
</script>