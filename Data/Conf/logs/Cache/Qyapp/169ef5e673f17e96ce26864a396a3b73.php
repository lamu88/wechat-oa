<?php if (!defined('THINK_PATH')) exit();?><div class="modal-dialog">
  <div class="modal-content">

	<div class="modal-header">
	  <button type="button" class="close" onclick="guanbi();">&times;</button>
	  <h4 class="modal-title" id="myModalLabel">选择部门</h4>
	</div>
	<div class="modal-body">
	<aside>
		 <div class="js_party_tree  tree_box" id="mytree"></div> 
	</aside>

	 </div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-primary" onclick="guanbi();">确定</button> 		
	  <button type="button" class="btn btn-default" onclick="cancel();">取消</button> 
	</div>

  </div>
</div>
<script>
$(function () {
		$('#mytree')
		.jstree({
			'core' : {
				'data' : {
					'url' : "<?php echo U('Tree/operate',array('operation'=>'get_node'));?>",
					'data' : function (node) {
						return { 'id' : node.id };
					}
				},
				'check_callback' : true,
				'themes' : {
					'responsive' : false,
					'icons'      : true // string for custom								
				}
			},
			'themes' : {
				'responsive' : false,
				'variant' : 'small',
				'stripes' : true
			},
			'checkbox' : {
				'three_state' : false
			},			
			'plugins' : ['state','wholerow','checkbox']
		})
		.on('changed.jstree', function (e, data) {
			if(data && data.selected && data.selected.length) {
				var str = data.node.text+';';
				var name = $('#depart').val();
				if(name.indexOf(str)==-1){
					name += str;				

				}else{
					name.replace(str,'');
				
				}
				$('#depart').attr('value',name);					
				var ref = $('#mytree').jstree(true),
				sel = ref.get_checked();	
				$('#departId').attr('value',sel);		
			}	
		});		
});	 
</script>