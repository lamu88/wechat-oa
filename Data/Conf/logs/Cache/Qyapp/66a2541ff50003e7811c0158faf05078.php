<?php if (!defined('THINK_PATH')) exit();?><form class="form-horizontal form-validate form-modal" method="post"  target="_self" action="<?php echo U('editMember');?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">修改成员</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label must">姓名</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" data-rule-required="true" name="name" 
                        value="<?php echo ($memberinfo["name"]); ?>"  maxlength='40'/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label must">帐号</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" data-rule-required="true" placeholder="成员唯一标识，设定后不可更改，不支持中文" name="useridc"
                         value='<?php echo ($memberinfo["userid"]); ?>'   maxlength='120'
                        />
                    </div>
					<input type="hidden"  name="userid"   value='<?php echo ($memberinfo["userid"]); ?>'  />
                </div>
<!--                 <div class="form-group">
                    <label class="col-sm-2 control-label must">所在部门</label>
                    <div class="col-sm-7">
                    <input type="text" class="form-control " data-rule-required="true"  data-toggle="tokeninputtree" name="department" 
                            data-path='/wAddressList/getDepartment' data-selected=""                             aria-required="true"  />
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-sm-2 control-label must">所在部门</label>
                    <div class="col-sm-7">
                    <input type="text" class="form-control " data-rule-required="true"  name="depart" 
                              onclick="editDepart();" id="depart" aria-required="true"  value="<?php echo ($str); ?>"/>
							 <input  id="departId" type="hidden"  name="departid"  value=""/>					 
                    </div>
                </div>					
                <div class="form-group">
                    <label class="col-sm-2 control-label">职位</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="position" value="<?php echo ($memberinfo["position"]); ?>" maxlength='600'/>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-2 control-label">姓别</label>
                     <div class="col-sm-1">
                            <div class="pull-left m-t-sm" id="mySwitch"  style="width:500px;"> 
							<input   type="radio" name="gender"  value="1" <?php if($memberinfo["gender"] == 1): ?>checked<?php endif; ?> />男&nbsp;&nbsp;&nbsp;&nbsp;
							<span><input type="radio" name="gender"   value="2"  <?php if($memberinfo["gender"] == 2): ?>checked<?php endif; ?> />女</span>
                            </div>
                        </div>	
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">工作电话</label>
                    <div class="col-sm-10">
                             <div class="form-group col-sm-3">
                            <input type="text" class="form-control" name="t1" placeholder="区号" value="" maxlength='5'/>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="t2" placeholder="固话" value=''  maxlength='10'/>
                        </div>
                        <div class="form-group col-sm-3">
                            <input type="text" class="form-control" name="t3" placeholder="分机" value='' maxlength='8'/>
                        </div>

                    </div>
                </div>
               <!--  <div class="form-group">
                    <label class="col-sm-2 control-label">工作地点</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="place" value='' maxlength='300'/>
                    </div>
                </div> -->
                <div class="col-sm-offset-2">  <div class="text-muted m-xs js_form_tips">以下三项信息至少填写一项</div></div>    
                <div class="form-group">
                    <label class="col-sm-2 control-label">手机号</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control js_partial_require" name="mobile" value='<?php echo ($memberinfo["mobile"]); ?>' maxlength='120'/>
                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">邮箱</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control js_partial_require" name="email" value='<?php echo ($memberinfo["email"]); ?>' maxlength='220'/>
                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">微信号</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control js_partial_require" name="weixinid" value='<?php echo ($memberinfo["weixinid"]); ?>' maxlength='120'/>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-loading-text="保存中..."  >保存</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</form>
   <div id="departModal" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  </div>
 <script src="./Tpl/Qyapp/Userlist/Js/Jstree/dist/jstree.min.js"></script>
<script>
function editDepart(){
    //alert('gggggg');
	//alert($('#depart').val());
	//alert($('#departId').val());	
    $('#depart').attr("value",'');
	$('#departId').attr("value",'');
	//alert($('#depart').val());
	//alert($('#departId').val());
	
	$('#departModal').load("<?php echo U('Tree/myTree');?>", function(){
	    $('#departModal').removeClass('fade');
		 $('#departModal').modal();
		 if($('.modal-backdrop').length>0){
			 $('.modal-backdrop').remove();
		 }		 
	});	
}

function cancel(){
    
    //$('#depart').attr("value",'');
	//$('#departId').attr("value",'');
	$('#departModal').modal('hide');
    //$('#departModal').empty();
}

function guanbi(){
    $('#departModal').modal('hide');
    //$('#departModal').empty();
}
</script>
<!-- </html> -->