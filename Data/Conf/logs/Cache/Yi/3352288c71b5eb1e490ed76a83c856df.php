<?php if (!defined('THINK_PATH')) exit();?><script>
$(function(){
  $("#submit").click(function() {
	var btn = $(this);
	var keyword 	  = $(".keyword").val();
	
	$.ajax({
			type: "post",  
			url:"<?php echo U('appvip');?>",
			dataType:'json',
			data:'vip='+keyword+'&appid=<?php echo $_GET["id"];?>',
			success:function(json){
				var status = json.status;
				if(status==0){
					alert('设置成功');
					window.location.reload();
				}else{
					alert('设置失败');
				}
			}
		});
  });
  
})
</script> 
<div class="form-horizontal form-validate form-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">设置vip等级</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" style="width:120px;">选择vip等级</label>
                    <div class="col-sm-7 "  style="width:200px;">
                        <select class="form-control keyword" name="keyword" id="business">
                            <option value="">请选择</option>
							<?php if(is_array($vip)): $i = 0; $__LIST__ = $vip;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $info['vip']): ?>selected=selected<?php endif; ?>><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							
						</select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit" class="btn btn-primary" data-loading-text="保存中..." >保存修改</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>