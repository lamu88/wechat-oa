<?php if (!defined('THINK_PATH')) exit();?><section class="entity-panel-wrapper" id="user<?php echo ($data["id"]); ?>">

	<header class="entity-panel-header header">
		<p>任务详情</p>
		<button type="button" class="close m-t" data-dismiss="entity" onclick="panelClose();">&times;</button>
	</header>
	<div class="entity-panel-body form-horizontal">
	   
		<div class="form-group">
			<label class="col-sm-3 control-label">任务内容</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($info["content"]); ?></p>
								</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">创建者</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($info["wecha_id"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">创建时间</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo (date("Y-m-d H:i",$info["mktime"])); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">主负责人</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($info["fuzeren"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">任务参与人</label>
			<div class="col-sm-9">
				<p class="form-control-static">
				<?php echo ($info["helper"]); ?>                    </p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">到期时间</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo (date("Y-m-d ",$info["end_time"])); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">完成时间</label>
			<div class="col-sm-9">
				<p class="form-control-static">暂无</p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">优先级</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php if($info['order'] == '1'): ?>低<?php endif; if($info['order'] == '2'): ?>中<?php endif; if($info['order'] == '3'): ?>高<?php endif; ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
	</div>
	<footer class="entity-panel-footer footer  text-right">
	</footer>

</section>
<script type="text/javascript">	
function panelClose(){
	$('.entity-panel').addClass('hd');
}	
</script>