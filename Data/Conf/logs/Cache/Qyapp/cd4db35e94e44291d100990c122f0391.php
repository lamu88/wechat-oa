<?php if (!defined('THINK_PATH')) exit();?><section class="entity-panel-wrapper" id="user<?php echo ($data["id"]); ?>">
	<header class="entity-panel-header header">
		<p>报销明细详情</p>
		<button class="close m-t" data-dismiss="entity" type="button" onclick="panelClose();">×</button>
	</header>
	<div class="entity-panel-body form-horizontal">
		<div class="form-group">
			<label class="col-sm-3 control-label">备注</label>
			<div class="col-sm-7">
			<p class="form-control-static"><?php echo ($data["name"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">类型</label>
			<div class="col-sm-7">
			<p class="form-control-static"><?php echo ($data["type"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">申请人</label>
			<div class="col-sm-7">
			<p class="form-control-static"><?php echo ($data["user"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">时间</label>
			<div class="col-sm-7">
			<p class="form-control-static"><?php echo (date("Y-m-d H:i",$data["time"])); ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">金额11</label>
			<div class="col-sm-7">
			<p class="form-control-static"><?php echo ($data["allmoney"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>	
		<div class="form-group">
			<label class="col-sm-3 control-label">报销明细</label>		
			<div class="col-sm-4">
			<p class="form-control-static"></p>
			</div>
		</div>	
		<?php if(is_array($detail)): $i = 0; $__LIST__ = $detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="form-group">
			<label class="col-sm-3 control-label">时间</label>
			<div class="col-sm-5">
			<p class="form-control-static"><?php echo ($vo["dotime"]); ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">金额</label>
			<div class="col-sm-7">
			<p class="form-control-static"><?php echo ($vo["money"]); ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">地点</label>
			<div class="col-sm-7">
			<p class="form-control-static"><?php echo ($vo["place"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div><?php endforeach; endif; else: echo "" ;endif; ?>		
		
	</div>
	<footer class="entity-panel-footer footer text-right">
		  <a class="btn btn-default"  onclick='edit("<?php echo ($data["id"]); ?>")'>编辑</a>  
		<button class="btn btn-default" onclick='del("<?php echo ($data["id"]); ?>")' type="button">删除</button>
	</footer>
</section>

   <div id="apply_edit" class="modal" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  </div>
<script type="text/javascript">
	function edit(id){
		$('#apply_edit').load("index.php?g=Qyapp&m=Applyflow&a=edit&mid=<?php echo $_GET['mid'];?>&id="+id, function(){
			 $('#apply_edit').modal();
			 if($('.modal-backdrop').length>0){
			     $('.modal-backdrop').remove();
			 }
		});		   
	}
	function del(id){	
 		$.ajax({
			type:"POST",
			url:"index.php?g=Qyapp&m=Applyflow&a=del&mid=<?php echo $_GET['mid'];?>",
			data:"id="+id,
			dataType:'json',
			success:function(json){
			var status = json.status;
			  if(status==1)
			  {
				alert('删除成功');
				window.location.reload();
			  }
			  else
			  {
				  alert('删除失败');
			  }
			}
		});       	
	}	
	function panelClose(){
	   $('.entity-panel').addClass('hd');
	}	
	
</script>