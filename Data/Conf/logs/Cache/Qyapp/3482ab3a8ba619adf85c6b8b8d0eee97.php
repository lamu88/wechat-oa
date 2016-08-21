<?php if (!defined('THINK_PATH')) exit();?><section class="entity-panel-wrapper" id="user<?php echo ($data["id"]); ?>">
	<header class="entity-panel-header header">
		<p>考勤地点详情</p>
		<button type="button" class="close m-t" data-dismiss="entity" onclick="panelClose();">&times;</button>
	</header>
	<div class="entity-panel-body form-horizontal">
	   
		<div class="form-group">
			<label class="col-sm-3 control-label">考勤地点</label>
			<div class="col-sm-7">
				<p class="form-control-static"><?php echo ($data["address"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		 <div class="form-group">
			<label class="col-sm-3 control-label">考勤范围</label>
			<div class="col-sm-7">
				<p class="form-control-static"><?php echo ($data["long"]); ?></p>
			</div>
		</div>
		<div class="line line-dashed line-lg pull-in"></div>
		<div class="form-group">
			<label class="col-sm-3 control-label">地图标注</label>
			<div class="col-sm-8">
				<p class="form-control-static" style="height:300px;" id="l-map">
				
				</p>
			</div>
		</div>
		 <input type="hidden" id="latitude" value="<?php echo ($data["latitude"]); ?>" />
		<input type="hidden" id="longitude" value="<?php echo ($data["longitude"]); ?>"/>
		<div class="line line-dashed line-lg pull-in"></div>
	</div>
	<footer class="entity-panel-footer footer  text-right">
	  <!-- <button type="button" class="btn btn-default" data-remote=""  onclick="editadress('<?php echo ($data["id"]); ?>');"  data-toggle="ajaxModal">编辑</button> -->
	  <a href="<?php echo U('Attendance/editadress',array('mid'=>$_GET['mid'],'id'=>$data['id']));?>" target="_self" class="btn btn-default">编辑</a>
	  <button type="button" class="btn btn-default" data-confirm="true" onclick='del("<?php echo ($data["id"]); ?>")' data-msg="确定删除该地点吗？" >删除</button>    
	</footer> 
</section>
<script type="text/javascript">
function panelClose(){
   $('.entity-panel').addClass('hd');
}
function del(id){
	$.ajax({
		type:"POST",
		url:"index.php?g=Qyapp&m=Attendance&a=deladress&mid=<?php echo $_GET['mid'];?>",
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
<!-- <script language="javascript">
new PCAS("province3","city3","area3");  
</script> -->
<script type="text/javascript">
var map = new BMap.Map("l-map");
var point = new BMap.Point($('#latitude').val(),$('#longitude').val());
map.centerAndZoom(point,12);
map.enableScrollWheelZoom();                            //启用滚轮放大缩小
function myFun(result){
	var cityName = result.name;
	if($('#longitude').val()==0||$('#longitude').val()==''){
		map.setCenter(cityName);
		p = new BMap.Point(result.center.lat,result.center.lng);
	}else{
		p = new BMap.Point($('#longitude').val(),$('#latitude').val());
	}
	var marker = new BMap.Marker(p);
	marker.enableDragging();
	map.addOverlay(marker);

	marker.addEventListener("dragend", function(e){
		$('#longitude').attr('value',e.point.lat)
		$('#latitude').attr('value',e.point.lng)
	})
}
var myCity = new BMap.LocalCity();
var p=myCity.get(myFun);

</script>