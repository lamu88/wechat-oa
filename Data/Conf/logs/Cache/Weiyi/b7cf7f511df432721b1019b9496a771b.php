<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class=" js no-touch no-android chrome no-firefox no-iemobile no-ie no-ie10 no-ie11 no-ios"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?php echo ($webinfo["site_title"]); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content=" <?php echo ($webinfo["keyword"]); ?> " name="Keywords">
    <meta content="<?php echo ($webinfo["content"]); ?>" name="Description">
	<link href="./Tpl/Weiyi/Weiyi/Css/webSite.css" rel="stylesheet">
    <link rel="shortcut icon" href="./Tpl/Weiyi/Weiyi/Images/favicon.jpg">

</head>

<body>
    <div class="header">
        <div class="hd-box clearfix w1170">
    <div class="logo">
        <a  href="javascript:void(0);">
             <img src="<?php echo ($webinfo["site_logo"]); ?>" >
        </a>
    </div>
    <div class="nav-box">
        <ul class="nav-list">
            <li class="active"><a class="item" href="<?php echo U('Weiyi/index');?>">首页</a></li>
            <li><a class="item" href="<?php echo U('service');?>">套餐</a></li>
            <li><a class="item" href="<?php echo U('help');?>">帮助</a></li>
            <li><a class="item" href="<?php echo U('agent');?>">渠道代理</a></li>
            <li><a class="item" href="<?php echo U('about');?>">关于我们</a></li>
            <li class="register-item"><a class="btn primary" href="<?php echo U('register');?>">注册</a></li>
            <li class="login-item"><a class="btn login" href="<?php echo U('login');?>">登录</a></li>
        </ul>
    </div>
</div>    </div>
    <div class="bodyer">
        <div class="bodyer-p">
            <div class="bg_grey">
                <div class="main">
                    <div class="center">
                        <h1>创建企业账号</h1>
                        <p>您将<span>免费体验</span>企业账户15天</p>
                    </div>
                    <div class="forms">
                        <form class="form1" data-action="/register" action="/index.php?g=Weiyi&m=Weiyi&a=checkreg" method="post" id="form1" novalidate="novalidate">
						
                            <table width="684">
                                                                    <tbody><tr>
                                        <td><label class="labels mb25" for="username">用户名</label></td>
                                        <td><input class="inputs placeholder mb25" placeholder="请填登录ID,请不要带@符号" type="text" name="username" id="email"></td>
                                    </tr>
                                                                <tr>
                                    <td><label class="labels mb25" for="password">密码</label></td>
                                    <td><input class="inputs placeholder mb25" placeholder="长度为6~16位字符" type="password" name="password" id="pwd"></td>
                                </tr>
                                <tr>
                                    <td><label class="labels mb25" for="cf_password">确认密码</label></td>
                                    <td><input class="inputs mb25" type="password" name="cf_password" id="cf_pwd"></td>
                                </tr>
                                <tr>
                                    <td><label class="labels mb25" for="qyname">企业名称</label></td>
                                    <td><input class="inputs placeholder mb25" placeholder="必填" type="text" name="qyname" id="company_name"></td>
                                </tr>

                                <tr>
                                    <td><label class="labels mb25" for="contact">联系人</label></td>
                                    <td><input class="inputs placeholder mb25" placeholder="必填" type="text" name="contact" id="contacts_name"></td>
                                </tr>
                                <tr>
                                    <td><label class="labels mb25" for="company_province">企业所在地</label></td>
                                    <td>
                                        <div class="form_add" id="city_a" data-toggle="location1">
                                           <select  class="text tip" name="province3" id="province" title="请填写省"  style="min-height:30px;"></select>
											<select  class="text tip" name="city3" id="city" title="请填写市"  style="min-height:30px;"></select>
											<select  class="text tip" name="area3" id="area" title="请填写县区域"  style="min-height:30px;"></select>
										   </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="labels mb25" for="business">所属行业</label></td>
                                    <td>
                                        <select class="inputs mb25" name="business" id="business">
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
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="labels mb25" for="mp">手机号码</label></td>
                                    <td><input class="inputs placeholder mb25" placeholder="必填" type="text" name="mp" id="phone"></td>
                                </tr>
                                                             
                            </tbody></table>
                            <div class="center">
                                <div class="register-hint">
                                    <div class="register-info"></div>
                                </div>
                                <p class="p1 bottom-dashed">请确认以上信息，确保信息的准确性</p>
                                <input type="submit" data-loading-text="提交中..." class="sub" value="提交">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<div class="footer">
    <div class="foot-content w1170 clearfix">
        <div class="foot-logo"><img src="<?php echo ($webinfo["site_logo"]); ?>" ></div>
        <div class="foot-info">
            <dl class="about-us">
                <dt>关于</dt>
                <dd><a href="<?php echo U('about');?>">关于我们</a></dd>
                
            </dl>
           <dl class="cooperation">
                <dt>合作</dt>
                <dd>QQ交流群：451493529</dd>
				<dd>版权归属：深度实业集团网络科技有限公司</dd>
				
                <dd>地址：中国-安徽-淮北</dd>
            </dl>
            <!-- <dl class="contact-us">
                <dt>联系我们</dt>
                <dd>热线：<?php echo ($webinfo["site_tel"]); ?></dd>
                <dd>反馈：<a href="mailto:lanrain@wxopen.cn"><?php echo ($webinfo["site_email"]); ?></a></dd>
                <dd>招聘：<a href="mailto:lanrain@wxopen.cn"><?php echo ($webinfo["site_email"]); ?></a></dd>
            </dl> -->
        </div>
    </div>
    <p class="copyright">Copyright © 2014-2014  All Rights Reserved <?php echo ($webinfo["site_ipc"]); ?>2</p>

<script type="text/javascript" src="./Tpl/Weiyi/Weiyi/Js/PCASClass.js" charset="utf-8"></script>
<script language="javascript" defer>
new PCAS("province3","city3","area3");
</script>
    <!--feedback dialog start-->
  
    <!--feedback dialog end-->

</div>    <!-- Modal -->
    <!--feedback dialog end-->
<script type="text/javascript" src="./Tpl/Weiyi/Weiyi/Js/PCASClass.js" charset="utf-8"></script>

<div id="fixed-icons" class="fixed-icons"><a href="" target="_blank" class="consulting"><span>在线咨询</span></a><ul><li class="icon2">免费电话<p>400-0503-365<i></i></p></li><li class="icon3" id="modal-box1">我要反馈</li><li class="icon4"><img src="./Tpl/Weiyi/register_files/two-dim-code.png"></li><li class="icon5" title="回到顶部" style="display:none;"></li></ul></div><div class="msgbox"></div></body></html>