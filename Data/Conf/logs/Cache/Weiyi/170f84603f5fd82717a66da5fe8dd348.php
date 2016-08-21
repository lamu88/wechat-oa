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
        <a href="javascript:void(0);">
            <img src="<?php echo ($webinfo["site_logo"]); ?>" >
        </a>
    </div>
    <div class="nav-box">
        <ul class="nav-list">
            <li ><a class="item" href="<?php echo U('index');?>">首页</a></li>
            <li><a class="item" href="<?php echo U('service');?>">套餐</a></li>
            <li><a class="item" href="<?php echo U('help');?>">帮助</a></li>
            <li class="active"><a class="item" href="<?php echo U('agent');?>">渠道代理</a></li>
            <li><a class="item" href="<?php echo U('about');?>">关于我们</a></li>
            <li class="register-item"><a class="btn primary" href="<?php echo U('register');?>">注册</a></li>
            <li class="login-item"><a class="btn login" href="<?php echo U('login');?>">登录</a></li>
        </ul>
    </div>
</div>    </div>
    <div class="bodyer">
        <div class="bodyer-p">
            <div class="agent-banner">
                <img class="agent-img" src="./Tpl/Weiyi/Weiyi/Images/agent-banner.jpg" >
            </div>
            <div class="agent-cooperation-box w1170">
                <div class="title-box">代理合作</div>
                <div class="cooperation-info-box clearfix">
                    <div class="cooperation-list-box">
                        <span class="list-ico ico1"></span>
                        <p><span>信任是合作的基础</span>
                            尊敬的合作伙伴，非常感谢您对平台的认可和支持，信任是合作的基础，这是我们一直强调的核心价值观。</p>
                    </div>
                    <div class="cooperation-list-box">
                        <span class="list-ico ico2"></span>
                        <p><span>全国发展代理伙伴</span>
                            我们的目标是：通过发展一批有实力的区域和行业代理商作为稳定的合作伙伴来承担销售业务，建立的战略合作伙伴体系。</p>
                    </div>
                    <div class="cooperation-list-box">
                        <span class="list-ico ico3"></span>
                        <p><span>我们全力顶你</span>
                            平台通过市场与技术支持、各种媒体宣传、促销活动及完善的售后服务，为代理商提供及时的、量身定做的高效特色服务及全面支持。</p>
                    </div>
                    <div class="cooperation-list-box cooperation-last-box">
                        <span class="list-ico ico4"></span>
                        <p><span>实现双赢</span>
                            平台希望每个人都能实现价值，我们将与您始终保持零距离的接触，提供零距离的服务，欢迎全国各地、各广告商、渠道代理商踊跃加盟。</p>
                    </div>
                </div>
            </div>
            <div class="angent-warp-box">
                <div class="title-box">总部支持</div>
                <div class="agent-support w1170">
                    <ul class="support-list">
                        <li class="items">1、总部提供专业的研发团队，优先处理和研发代理商反馈的需求，定制模块开发支持；</li>
                        <li class="items">2、提供平台的产品介绍、使用手册及相关操作培训；</li>
                        <li class="items">3、总部通过网络推广得到的资源将全部转交给当地代理商，代理商无需承担推广费用；</li>
                        <li class="items">4、总部对独家代理商所在地区不参与直销，全权交给代理商，充分保护代理商的利益；</li>
                        <li class="items">5、平台提供7×12小时的技术支持，随时提供响应；</li>
                        <li class="items">6、总部为全国代理商提供统一的行业应用PPT；</li>
                        <li class="items">7、总部会定期在代理商所在城市与代理商一起协作举办企业移动办公类主题会议，从而扩大代理商在当地的影响力和的品牌知名度</li>
                        <li class="items">8、渠道经理后期会定期亲临代理商公司给予产品培训，销售技巧培训等，并协助代理商销售客户。</li>
                    </ul>
                </div>
            </div>
            <div class="title-box">联系渠道经理</div>
            <div class="anget-table-box w1170">
                <table class="agent-table">
                    <thead>
                    <tr class="even">
                        <td><i class="ico1 table-ico"></i>区域负责人</td>
                        <td><i class="ico2 table-ico"></i>负责区域</td>
                        <td><i class="ico6 table-ico"></i>座机</td>
                        <td><i class="ico4 table-ico"></i>手机</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>陈经理</td>
                        <td>北京、天津、河北、山东、辽宁、吉林、黑龙江</td>
                        <td>027-87382925</td>
                        <td>13308658831</td>
                    </tr>
                    <tr class="even">
                        <td>张经理</td>
                        <td>宁夏、新疆、青海、陕西、河南、山西、内蒙古、甘肃</td>
                        <td>027-87382925</td>
                        <td>13308658831</td>
                    </tr>
                    <tr>
                        <td>陈经理</td>
                        <td>广东、湖南、湖北、海南</td>
                        <td>027-87382925</td>
                        <td>13308658831</td>
                    </tr>
                    <tr class="even">
                        <td>张经理</td>
                        <td>四川、重庆、贵州、云南、广西、西藏</td>
                        <td>027-87382925</td>
                        <td>13308658831</td>
                    </tr>
                    <tr>
                        <td>王经理</td>
                        <td>江苏、安徽、浙江、福建、江西</td>
                        <td>027-87382925</td>
                        <td>13308658831</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="use-register w1170">
                <p>简单一步，即可使用</p>
                <div class="nav-search">
                    <form id="searchTopForm" class="searchForm-box" action="" method="post">
                        <input id="search_top" name="search_top" onKeyPress="if(event.keyCode == 13){return false;}" class="search-inp email-register" type="text" placeholder="输入您的邮箱地址" value="">
                        <button type="button" class="btn btn-register">免费注册</button>
                        <span class="hit-info"></span>
                    </form>
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
                <dd><a href="./about.html">关于我们</a></dd>
                
            </dl>
            <dl class="cooperation">
                <dt>合作</dt>
                <dd>商务合作： <?php echo ($webinfo["site_tel"]); ?></dd>
                <dd>地址： <?php echo ($webinfo["address"]); ?></dd>
            </dl>
            <dl class="contact-us">
                <dt>联系我们</dt>
                <dd>热线：<?php echo ($webinfo["site_tel"]); ?></dd>
                <dd>反馈：<a href="mailto:lanrain@wxopen.cn"><?php echo ($webinfo["site_email"]); ?></a></dd>
                <dd>招聘：<a href="mailto:lanrain@wxopen.cn"><?php echo ($webinfo["site_email"]); ?></a></dd>
            </dl>
        </div>
    </div>
    <p class="copyright">Copyright © 2014-2014  All Rights Reserved <?php echo ($webinfo["site_ipc"]); ?>2</p>


    <!--feedback dialog start-->
  
    <!--feedback dialog end-->

</div>    <!-- Modal -->


<div id="fixed-icons" class="fixed-icons"><a href="" target="_blank" class="consulting"><span>在线咨询</span></a><ul><li class="icon2">免费电话<p>400-0503-365<i></i></p></li><li class="icon3" id="modal-box1">我要反馈</li><li class="icon4"><img src="./Tpl/Weiyi/agent_files/two-dim-code.png"></li><li class="icon5" title="回到顶部" style="display:none;"></li></ul></div></body></html>