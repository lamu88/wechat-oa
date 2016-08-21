<?php if (!defined('THINK_PATH')) exit();?><section class="entity-panel-wrapper" id="user<?php echo ($data["id"]); ?>">

	<header class="entity-panel-header header">
		<p>名片详情</p>
		<button type="button" class="close m-t" data-dismiss="entity" onclick="panelClose();">&times;</button>
	</header>
	<div class="entity-panel-body form-horizontal">
	   
		<div class="form-group">
			<label class="col-sm-3 control-label">客户姓名</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($data["userinfo"]["name"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">所属员工</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($data["wecha_id"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">公司名称</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo ($data["companyinfo"]["公司名称"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">创建时间</label>
			<div class="col-sm-9">
				<p class="form-control-static"><?php echo (date("Y-m-d",$data["time"])); ?></p>
			</div>
		</div>		
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">联系方式</label>
			<div class="col-sm-9">
				<p class="form-control-static">
                <?php echo ($data["connectinfo"]["手机号码"]); ?>
				</p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">其他信息</label>
			<div class="col-sm-9">
				<p class="form-control-static">
                <?php echo ($data["info"]); ?>
				</p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>	   
	</div>
	<footer class="entity-panel-footer footer  text-right">
		<button type="button" class="btn btn-default" data-confirm="true"  onclick='del("<?php echo ($data["id"]); ?>")' data-toggle="ajaxPost" data-msg="确定删除该客户吗？" >删除</button>
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
		url:"index.php?g=Qyapp&m=Card&a=del&mid=<?php echo $_GET['mid'];?>&id="+id,
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