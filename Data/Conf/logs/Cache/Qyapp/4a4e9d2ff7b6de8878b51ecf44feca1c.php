<?php if (!defined('THINK_PATH')) exit();?> <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">安装方式</h4>
            </div>
			<?php if($_GET['status'] == 1): ?><div class="modal-footer" style="padding-left:190px;border-top:0px;">
					<div class="app-item center js_entity_view" data-path="">
							<a >
								 <img class="app-item-img" alt="" src="/Tpl/Qyapp/Appslist/images/haveinstall.png">
								  <div class="app-item-count"></div>
								  <p></p>
								<div class="app-item-name"  style="margin-left:40px;">  已安装</div></a>
							</div> 
				</div>
			<?php else: ?>
				<?php if($appinfo['az'] == 1): ?><div class="modal-footer" style="padding-left:190px;border-top:0px;">
					<div class="app-item center js_entity_view" data-path="">
							<a >
								 <img class="app-item-img" alt="" src="/Tpl/Qyapp/Appslist/images/haveinstall.png">
								  <div class="app-item-count"></div>
								  <p></p>
								<div class="app-item-name">  您所在的等级不能安装，请升级！</div></a>
							</div> 
					</div>
				<?php else: ?>
					  <div class="modal-footer" style="padding-left:110px;border-top:0px;">
					   <div class="app-item center js_entity_view" data-path="">
								<a href="<?php echo U('Install/page_one',array('id'=>$_GET['appid']));?>" target="_self">
									 <img class="app-item-img" alt="" src="/Tpl/Qyapp/Appslist/images/in.png">
									  <div class="app-item-count"></div>
									<div class="app-item-name" style="margin-left:20px;"> 使用系统安装</div></a>
						</div> 
						<if condition="$appinfo['suit_id']">
						<div class="app-item center js_entity_view" data-path="">
								<a target="_blank"  href="<?php echo U('Suite/pass',array('id'=>$_GET['appid']));?>" target="_self" >
									 <img class="app-item-img" alt="" src="/Tpl/Qyapp/Appslist/images/wei.png">
									  <div class="app-item-count"></div>
									<div class="app-item-name"  style="margin-left:20px;">  使用套件安装</div></a>
								</div><?php endif; endif; ?>
				</div>
			</if>
			
          
			
			
			
        </div>
    </div>