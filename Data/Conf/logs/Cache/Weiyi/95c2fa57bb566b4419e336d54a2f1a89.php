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
            <li><a class="item" href="<?php echo U('index');?>">首页</a></li>
            <li class="active"><a class="item" href="<?php echo U('service');?>"">套餐</a></li>
            <li><a class="item" href="<?php echo U('help');?>">帮助</a></li>
            <li><a class="item" href="<?php echo U('agent');?>">渠道代理</a></li>
            <li><a class="item" href="<?php echo U('about');?>">关于我们</a></li>
            <li class="register-item"><a class="btn primary" href="<?php echo U('register');?>">注册</a></li>
            <li class="login-item"><a class="btn login" href="<?php echo U('login');?>">登录</a></li>
        </ul>
    </div>
	
	
	
</div>    </div>
    <div class="bodyer combo-bodyer">
        <div class="bodyer-p combo-warp">
            <div class="combo-table-box">
                <table class="combo-table">
                    <thead id="thead_fixed" class="hide" style="">
                        <tr>
                            <td width="243">服务项</td>
                            <td width="486">服务明细</td>
                            <td width="105">基础版</td>
                            <td width="105">基础开源版</td>
                            <td width="105">代理版</td>
                            <td width="105" class="last">代理开源版</td>
                        </tr>
                        </thead>
                        <thead>
                        <tr>
                            <td>服务项</td>
                            <td>服务明细</td>
                            <td>基础版</td>
                            <td>基础开源版</td>
                            <td>代理版</td>
                            <td class="last">代理开源版</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="6" class="row-title">素材管理</td>
                            <td>文本管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>图片管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>语音管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>视频管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>图文管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>文件管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="2" class="row-title">群发消息</td>
                            <td>不限次数群发消息</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>历史消息记录</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="2" class="row-title">系统通知</td>
                            <td>平台通知</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>应用消息</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td class="row-title">组织架构</td>
                            <td>建立企业组织架构，添加上下属</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="2" class="row-title">通讯录管理</td>
                            <td>部门管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>人员管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="4" class="row-title"><i class="combo-icon icon06"></i>企业邮箱应用</td>
                            <td>邮箱绑定</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>写邮件</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>快速查收邮件</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>快速获取企业员工邮箱</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="5" class="row-title"><i class="combo-icon icon07"></i>通讯录应用</td>
                            <td>通讯录列表</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>通讯录搜索</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>常用联系人</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>存入手机通讯录</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>通讯录管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="6" class="row-title"><i class="combo-icon icon08"></i>日程管理应用</td>
                            <td>创建日程</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>日程提醒</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>日程批注</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>日程标签</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>日程处理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>自定义菜单</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="7" class="row-title"><i class="combo-icon icon09"></i>微名片应用</td>
                            <td>名片夹</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>创建名片</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>扫描纸张名片，自动保存电子版</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>名片互赠</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>名片保存到手机通讯录</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>名片模板管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>名片管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="7" class="row-title"><i class="combo-icon icon10"></i>微考勤应用</td>
                            <td>签到</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>摇一摇签到</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>签退</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>考勤记录</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>月度时长</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>考勤规则、地点设置</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>考勤统计</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="6" class="row-title"><i class="combo-icon icon11"></i>报销应用</td>
                            <td>报销申请</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>报销审批</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>报销单打印</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>报销管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>审核人配置</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>自定义菜单</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="5" class="row-title"><i class="combo-icon icon12"></i>投票应用</td>
                            <td>发起投票（可定时）</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>匿名投票、实名投票</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>图片投票、文字投票</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>投票管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>投票结果查看</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="7" class="row-title"><i class="combo-icon icon13"></i>请假应用</td>
                            <td>请假申请</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>请假审批</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>请假管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>审核人配置</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>自定义菜单</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>年假导入</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>请假查询</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="7" class="row-title"><i class="combo-icon icon14"></i>任务管理应用</td>
                            <td>任务创建</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>任务转发</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>任务讨论</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>任务管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>消息中心</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>任务重启</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>任务提醒</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="9" class="row-title"><i class="combo-icon icon15"></i>悬赏招聘应用</td>
                            <td>企业招聘</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>推荐得红包</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>红包兑现</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>职位管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>简历管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>赏金管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>企业信息管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>自定义菜单</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>消息通知</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="5" class="row-title"><i class="combo-icon icon16"></i>流程审批应用</td>
                            <td>发起审批</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>审批处理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>审批管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>自定义菜单</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>流程自定义</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="6" class="row-title"><i class="combo-icon icon17"></i>会议室管理应用</td>
                            <td>会议室预定</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>摇一摇找会议室</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>会议室查询</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>消息通知</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>会议室管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>会议室预定设置</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td rowspan="6" class="row-title"><i class="combo-icon icon18"></i>调研应用</td>
                            <td>答卷</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>新调研问卷提醒</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>问卷信息管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>问卷问题管理</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr>
                            <td>调研结果统计分析</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                        <tr class="even">
                            <td>导出调研结果</td>
                            <td><i class="combo-right"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-error"></i></td>
                            <td><i class="combo-right"></i></td>
                        </tr>
                    </tbody>
                </table>
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
    </div>
    
<div class="footer">
    <div class="foot-content w1170 clearfix">
        <div class="foot-logo"><img src="<?php echo ($webinfo["site_logo"]); ?>" ></div>
        <div class="foot-info">
            <dl class="about-us">
                <dt>关于</dt>
                <dd><a href="<?php echo U('Weiyi/about');?>">关于我们</a></dd>
                
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


    <!--feedback dialog start-->
    <div id="myModal1" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <form id="feedback" action="" method="post">
            <div class="modal-dialog modal-dialog1">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>亲爱的用户：</h2>
                        <p class="p1">欢迎您访问微易官方网站！您对我们有任何意见和建议，或在使用过程中遇到问题，请在本页面反馈。我们会实时关注您的反馈不断优化，您的建议将帮助我们改进，为您提供更好的服务！</p>
                        <h3>请留下您的宝贵意见和建议！（请填写）</h3>
                        <p class="placeholder-label texta">
                            <textarea class="blue-border placeholder" id="content" name="content" placeholder="输入文本..."></textarea>
                        </p>
                        <h3>您常用的电子邮箱是？（请填写）</h3>
                        <p class="p2"><i></i>请尽量填写，以便我们尽快回复您！</p>
                        <p class="placeholder-label">
                            <input class="blue-border input1 mt10 placeholder" type="text" id="email" name="email" placeholder="如：@163.com">
                        </p>
                        <h3>验证码</h3>
                        <div class="clearfix">
                            <input class="fl blue-border input2" id="code" name="code" type="text">
                            <img class="fl code_img" onClick="this.src+Math.random()" src="./Tpl/Weiyi/Weiyiservice_files/code">
                        </div>
                        <input class="sub" id="feedback_sub" type="button" value="提交" data-loading-text="提交中...">
                        <div id="errorInfo" class="hint-box">请填写正确的邮箱</div>
                        <div id="emptyInfo" class="hint-box">请填写完整信息</div>
                        <div id="hintInfo" class="hint-box"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--feedback dialog end-->

    <script type="text/javascript">
        var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fb1331a132230581e02d9672cd9b95b22' type='text/javascript'%3E%3C/script%3E"));
    </script><script src="./Tpl/Weiyi/WeiyiJs/h.js" type="text/javascript"></script><a href="http://tongji.baidu.com/hm-web/welcome/ico?s=b1331a132230581e02d9672cd9b95b22" target="_blank"><img border="0" src="./Tpl/Weiyi/Weiyiservice_files/21.gif" width="20" height="20"></a>
</div>    

<div id="fixed-icons" class="fixed-icons"><a href="" target="_blank" class="consulting"><span>在线咨询</span></a><ul><li class="icon2">免费电话<p>400-6330-112<i></i></p></li><li class="icon3" id="modal-box1">我要反馈</li><li class="icon4"><img src="./Tpl/Weiyi/Weiyiservice_files/two-dim-code.png"></li><li class="icon5" title="回到顶部" style="display: none;"></li></ul></div></body></html>