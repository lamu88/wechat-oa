<?php if (!defined('THINK_PATH')) exit();?><form class="form-horizontal form-validate form-modal"  target="_self"  >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">修改基本信息</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">账号</label>
                    <div class="col-sm-7 ">
                        <p class="form-control-static"><?php echo ($info['username']); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label must">联系人   </label>
                    <div class="col-sm-7 ">
                        <input type="text" class="form-control" data-rule-required="true" name="contacts" id="contact"  value="<?php echo ($info['contact']); ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label must">手机号</label>
                    <div class="col-sm-7 ">
                        <input type="text" class="form-control" data-rule-required="true" name="mp"  id="mp"  data-rule-phone="true" value="<?php echo ($info['mp']); ?>"/>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-2 control-label must">可信网址</label>
                    <div class="col-sm-7 ">
                        <input type="text" class="form-control" data-rule-required="true" name="host" id="host" value="<?php echo ($info['host']); ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label must">企业名称</label>
                    <div class="col-sm-7 ">
                        <input type="text" class="form-control" data-rule-required="true" name="qyname" id="qyname" value="<?php echo ($info['qyname']); ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label must">企业所在地</label>
                    <div class="col-sm-10">
                        <div class="form-inline" data-toggle="location" id="city_a" >
							<div class="form_" id="city_a" data-toggle="location1">
                                           <select  class="form-control mn120 text tip" name="province3" id="provinces" title="请填写省"  style="min-height:30px;"></select>
											<select  class="form-control mn120 text tip" name="city3" id="city" title="请填写市"  style="min-height:30px;"></select>
											<select  class="form-control mn120 text tip" name="area3" id="district" title="请填写县区域"  style="min-height:30px;"></select>
										 </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">所属行业</label>
                    <div class="col-sm-7 ">
                        <select class="form-control" name="business" id="business">
                            <option value="">请选择</option>
							<option value="互联网/电子商务">互联网/电子商务</option>
								<option value="IT服务(系统/数据/维护)">IT服务(系统/数据/维护)</option>
								<option value="电子技术/半导体/集成电路">电子技术/半导体/集成电路</option>
								<option value="计算机硬件">计算机硬件</option>
								<option value="通信/电信/网络设备">通信/电信/网络设备</option>
								<option value="通信/电信运营、增值服务">通信/电信运营、增值服务</option>
								<option value="网络游戏">网络游戏</option>
								<option value="基金/证券/期货/投资">基金/证券/期货/投资</option>
								<option value="保险">保险</option>
								<option value="银行">银行</option>
								<option value="信托/担保/拍卖/典当">信托/担保/拍卖/典当</option>
								<option value="房地产/建筑/建材/工程">房地产/建筑/建材/工程</option>
								<option value="家居/室内设计/装饰装潢">家居/室内设计/装饰装潢</option>
								<option value="物业管理/商业中心">物业管理/商业中心</option>
								<option value="专业服务/咨询(财会/法律/人力资源等)">专业服务/咨询(财会/法律/人力资源等)</option>
								<option value="广告/会展/公关">广告/会展/公关</option>
								<option value="中介服务">中介服务</option>
								<option value="检验/检测/认证">检验/检测/认证</option>
								<option value="外包服务">外包服务</option>
								<option value="快速消费品(食品/饮料/烟酒/日化)">快速消费品（食品/饮料/烟酒/日化）</option>
								<option value="耐用消费品(服饰/纺织/皮革/家具/家电)">耐用消费品（服饰/纺织/皮革/家具/家电）</option>
								<option value="贸易/进出口">贸易/进出口</option>
								<option value="零售/批发">零售/批发</option>
								<option value="租赁服务">租赁服务</option>
								<option value="教育/培训/院校">教育/培训/院校</option>
								<option value="礼品/玩具/工艺美术/收藏品/奢侈品">礼品/玩具/工艺美术/收藏品/奢侈品</option>
								<option value="汽车/摩托车">汽车/摩托车</option>
								<option value="大型设备/机电设备/重工业">大型设备/机电设备/重工业</option>
								<option value="加工制造(原料加工/模具)">加工制造（原料加工/模具）</option>
								<option value="仪器仪表及工业自动化">仪器仪表及工业自动化</option>
								<option value="印刷/包装/造纸">印刷/包装/造纸</option>
								<option value="办公用品及设备">办公用品及设备</option>
								<option value="医药/生物工程">医药/生物工程</option>
								<option value="医疗设备/器械">医疗设备/器械</option>
								<option value="航空/航天研究与制造">航空/航天研究与制造</option>
								<option value="交通/运输">交通/运输</option>
								<option value="物流/仓储">物流/仓储</option>
								<option value="医疗/护理/美容/保健/卫生服务">医疗/护理/美容/保健/卫生服务</option>
								<option value="酒店/餐饮">酒店/餐饮</option>
								<option value="旅游/度假">旅游/度假</option>
								<option value="媒体/出版/影视/文化传播">媒体/出版/影视/文化传播</option>
								<option value="娱乐/体育/休闲">娱乐/体育/休闲</option>
								<option value="能源/矿产/采掘/冶炼">能源/矿产/采掘/冶炼</option>
								<option value="石油/石化/化工">石油/石化/化工</option>
								<option value="环保">环保</option>
								<option value="政府/公共事业/非盈利机构">政府/公共事业/非盈利机构</option>
								<option value="学术/科研">学术/科研</option>
								<option value="农/林/牧/渔">农/林/牧/渔</option>
								<option value="跨领域经营">跨领域经营</option>
								<option value="其他">其他</option>
						</select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submit" class="btn btn-primary" data-loading-text="保存中..." >保存修改</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
<script>
$(function(){
  $("#submit").click(function() {
	var btn = $(this);
    var contact = $("#contact").val();
    var mp 	  = $("#mp").val();
	var host 	  = $("#host").val();
	var qyname 	  = $("#qyname").val();
	var provinces 	  = $("#provinces").val();
	var city 	  = $("#city").val();
	var district 	  = $("#district").val();
	var address 	  = $("#address").val();
	var business 	  = $("#business").val();
	var submitData = {
			contact : contact,
			mp 	  : mp,
			host  : host,
			qyname        : qyname,
			provinces 	  : provinces,
			city  : city,
			district   : district,
			business 	  : business,
			address 	  : address
			};
	$.ajax({
			type: "post",  
			url:"<?php echo U('Userinfo/editCompany');?>",
			dataType:'json',
			data: submitData,
			success:function(json){
				var status = json.status;
				if(status==0){
					alert('修改成功');
					window.location.reload();
				}else{
				   alert('修改失败');
				   window.location.reload();
				}
			}
		});
  });
  
})
</script>
<script type="text/javascript" src="./Tpl/Qyapp/Public/Js/PCASClass.js" charset="utf-8"></script>
<script language="javascript" >
new PCAS("province3","city3","area3");
</script>
<!-- </body>
</html> -->