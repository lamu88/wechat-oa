<?php if (!defined('THINK_PATH')) exit();?><section class="entity-panel-wrapper" id="user<?php echo ($data["id"]); ?>">

	<header class="entity-panel-header header">
		<p>会议室预定详情</p>
		<button type="button" class="close m-t" data-dismiss="entity" onclick="panelClose();">&times;</button>
	</header>
	<div class="entity-panel-body form-horizontal">
	   
		<div class="form-group">
			<label class="col-sm-3 control-label">会议室名称</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($data["name"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">地址</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($data["place"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>		
		<div class="form-group">
			<label class="col-sm-3 control-label">楼层</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($data["floors"]); ?></p>
			</div>
		</div>		
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">区域</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($data["area"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">容纳人数</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($data["num"]); ?>人</p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>		
		<div class="form-group">
			<label class="col-sm-3 control-label">预定状态</label>
			<div class="col-sm-9">
				<p class="form-control-static">
				<?php if($data['status'] == 1): ?>已预订<?php endif; ?>
				<?php if($data['status'] == 0): ?>未预定<?php endif; ?>
				</p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">备注</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($data["note"]); ?></p>
			</div>
		</div>   
	</div>
	<footer class="entity-panel-footer footer  text-right">
		<a href="<?php echo U('Meet/edit',array('id'=>$data['id'],'mid'=>$_GET['mid']));?>" target="_self" class="btn btn-default">编辑</a>
		<button type="button" class="btn btn-default" data-confirm="true"  onclick='del("<?php echo ($data["id"]); ?>")' data-toggle="ajaxPost" data-msg="确定删除吗？" >删除</button>
	</footer>

</section>
<script type="text/javascript">
function panelClose(){
   $('.entity-panel').addClass('hd');
}
//删除操作
function del(id){
	$.ajax({
		type:"POST",
		url:"index.php?g=Qyapp&m=Meet&a=del&mid=<?php echo $_GET['mid'];?>&id="+id,
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