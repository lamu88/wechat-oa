/*
Navicat MySQL Data Transfer

Source Server         : duo
Source Server Version : 50538
Source Host           : localhost:3306
Source Database       : qyh

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2015-11-09 19:51:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tp_agency_level`
-- ----------------------------
DROP TABLE IF EXISTS `tp_agency_level`;
CREATE TABLE `tp_agency_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `power` int(10) NOT NULL,
  `desc` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_agency_level
-- ----------------------------
INSERT INTO `tp_agency_level` VALUES ('1', '超级管理员', '1', '3', '这是超级管理员');
INSERT INTO `tp_agency_level` VALUES ('2', '高级管理1', '1', '1', '这是高级管理');
INSERT INTO `tp_agency_level` VALUES ('3', '低级代理', '1', '1', '这是低级代理');

-- ----------------------------
-- Table structure for `tp_agency_list`
-- ----------------------------
DROP TABLE IF EXISTS `tp_agency_list`;
CREATE TABLE `tp_agency_list` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `desc` varchar(128) NOT NULL,
  `last_ip` varchar(20) NOT NULL,
  `last_time` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tp_agency_list
-- ----------------------------
INSERT INTO `tp_agency_list` VALUES ('1', 'admin', '1', '', '1', 'asdasdasd', '', '0', 'admin');
INSERT INTO `tp_agency_list` VALUES ('17', '', '2', '666', '1', '666', '', '0', '666');
INSERT INTO `tp_agency_list` VALUES ('18', '', '3', '777', '1', '777', '', '0', '777');

-- ----------------------------
-- Table structure for `tp_announce_comment`
-- ----------------------------
DROP TABLE IF EXISTS `tp_announce_comment`;
CREATE TABLE `tp_announce_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` int(11) DEFAULT NULL,
  `news_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `content` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_announce_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_announce_news`
-- ----------------------------
DROP TABLE IF EXISTS `tp_announce_news`;
CREATE TABLE `tp_announce_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(64) DEFAULT NULL,
  `touser` varchar(300) DEFAULT NULL,
  `todepart` varchar(300) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `content` text,
  `time` varchar(16) DEFAULT NULL,
  `pic` varchar(300) DEFAULT NULL,
  `alldepart` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_announce_news
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_announce_pic`
-- ----------------------------
DROP TABLE IF EXISTS `tp_announce_pic`;
CREATE TABLE `tp_announce_pic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '公司ID',
  `picurl` varchar(300) DEFAULT NULL COMMENT '图片地址',
  `wecha_id` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_announce_pic
-- ----------------------------
INSERT INTO `tp_announce_pic` VALUES ('9', '25', './Uploads/Announce/25/0033/1429501164237.jpeg', '0033');
INSERT INTO `tp_announce_pic` VALUES ('10', '25', './Uploads/Announce/25/270636852/1429501233600.jpeg', '270636852');
INSERT INTO `tp_announce_pic` VALUES ('3', '25', './Uploads/Announce/25/270636852/1428714969386.jpeg', '270636852');
INSERT INTO `tp_announce_pic` VALUES ('8', '25', './Uploads/Announce/25/270636852/1429501136509.jpeg', '270636852');

-- ----------------------------
-- Table structure for `tp_announce_praise`
-- ----------------------------
DROP TABLE IF EXISTS `tp_announce_praise`;
CREATE TABLE `tp_announce_praise` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(11) DEFAULT NULL COMMENT '公告ID',
  `user_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT '0',
  `wecha_id` varchar(64) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_announce_praise
-- ----------------------------
INSERT INTO `tp_announce_praise` VALUES ('1', '45', '25', '1428740955', '270636852', '0');
INSERT INTO `tp_announce_praise` VALUES ('2', '46', '25', '1428744013', '270636852', '0');
INSERT INTO `tp_announce_praise` VALUES ('3', '46', '25', '1428888699', '270636852', '0');
INSERT INTO `tp_announce_praise` VALUES ('4', '47', '25', '1428910306', '0033', '0');
INSERT INTO `tp_announce_praise` VALUES ('5', '47', '25', '1428922057', '270636852', '0');
INSERT INTO `tp_announce_praise` VALUES ('6', '48', '25', '1428993307', '0033', '0');
INSERT INTO `tp_announce_praise` VALUES ('7', '47', '25', '1428993350', '0033', '0');
INSERT INTO `tp_announce_praise` VALUES ('8', '48', '25', '1429063202', '0033', '0');
INSERT INTO `tp_announce_praise` VALUES ('9', '14', '25', '1429064250', 'li_jun_6', '0');
INSERT INTO `tp_announce_praise` VALUES ('10', '46', '25', '1429239280', '270636852', '0');
INSERT INTO `tp_announce_praise` VALUES ('11', '47', '25', '1429500849', '0033', '0');
INSERT INTO `tp_announce_praise` VALUES ('12', '51', '25', '1429501252', '0033', '0');
INSERT INTO `tp_announce_praise` VALUES ('13', '51', '25', '1429501322', 'li_jun_6', '0');
INSERT INTO `tp_announce_praise` VALUES ('14', '50', '25', '1429525814', '0033', '0');

-- ----------------------------
-- Table structure for `tp_app_class`
-- ----------------------------
DROP TABLE IF EXISTS `tp_app_class`;
CREATE TABLE `tp_app_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(16) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `module` varchar(16) DEFAULT NULL,
  `name` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_app_class
-- ----------------------------
INSERT INTO `tp_app_class` VALUES ('1', '', '1', '/index.php?g=Qyapp&m=Address&a=wap_index', 'Address', '通讯录');
INSERT INTO `tp_app_class` VALUES ('5', null, '1', '/index.php?g=Qyapp&m=Attendance&a=wap_shark', 'Attendance', '签到');
INSERT INTO `tp_app_class` VALUES ('2', '', '1', '/index.php?g=Qyapp&m=Attendance&a=wap_out', 'Attendance', '签退');
INSERT INTO `tp_app_class` VALUES ('6', null, '1', '/index.php?g=Qyapp&m=Attendance&a=wap_records', 'Attendance', '查询记录');
INSERT INTO `tp_app_class` VALUES ('7', null, '1', '/index.php?g=Qyapp&m=Research&a=wap_index', 'Research', '我的调研');
INSERT INTO `tp_app_class` VALUES ('8', null, '1', '/index.php?g=Qyapp&m=Workflow&a=wap_act_list', 'Workflow', '待审批');
INSERT INTO `tp_app_class` VALUES ('9', null, '1', '/index.php?g=Qyapp&m=Workflow&a=wap_act_my', 'Workflow', '我的审批');
INSERT INTO `tp_app_class` VALUES ('10', null, '1', '/index.php?g=Qyapp&m=Workflow&a=wap_index', 'Workflow', '发起审批');
INSERT INTO `tp_app_class` VALUES ('11', null, '1', '/index.php?g=Qyapp&m=Email&a=wap_index', 'Email', '写邮件');
INSERT INTO `tp_app_class` VALUES ('12', null, '1', '/index.php?g=Qyapp&m=Vote&a=wap_index', 'Vote', '参与投票');
INSERT INTO `tp_app_class` VALUES ('13', null, '1', '/index.php?g=Qyapp&m=Applyflow&a=wap_act_list', 'Applyflow', '待审核');
INSERT INTO `tp_app_class` VALUES ('14', null, '1', '/index.php?g=Qyapp&m=Applyflow&a=wap_act_my', 'Applyflow', '我的报销');
INSERT INTO `tp_app_class` VALUES ('15', null, '1', '/index.php?g=Qyapp&m=Applyflow&a=wap_post', 'Applyflow', '申请报销');
INSERT INTO `tp_app_class` VALUES ('16', null, '1', '/index.php?g=Qyapp&m=Task&a=wap_add_task', 'Task', '添加任务');
INSERT INTO `tp_app_class` VALUES ('17', null, '1', '/index.php?g=Qyapp&m=Task&a=wap_index_one', 'Task', '任务管理');
INSERT INTO `tp_app_class` VALUES ('19', null, '1', '/index.php?g=Qyapp&m=Hiring&a=wap_index', 'Hiring', '我的推荐');
INSERT INTO `tp_app_class` VALUES ('20', null, '1', '/index.php?g=Qyapp&m=Hiring&a=wap_money', 'Hiring', '我的红包');
INSERT INTO `tp_app_class` VALUES ('21', null, '1', '/index.php?g=Qyapp&m=Leave&a=wap_wait_check', 'Leave', '待审核');
INSERT INTO `tp_app_class` VALUES ('22', null, '1', '/index.php?g=Qyapp&m=Leave&a=wap_list', 'Leave', '我的假单');
INSERT INTO `tp_app_class` VALUES ('23', null, '1', '/index.php?g=Qyapp&m=Leave&a=wap_holiday', 'Leave', '请假');
INSERT INTO `tp_app_class` VALUES ('24', null, '1', '/index.php?g=Qyapp&m=Card&a=wap_my_card', 'Card', '名片夹');
INSERT INTO `tp_app_class` VALUES ('25', null, '1', '/index.php?g=Qyapp&m=Card&a=wap_index', 'Card', '我的名片');
INSERT INTO `tp_app_class` VALUES ('26', null, '1', '/index.php?g=Qyapp&m=Meet&a=wap_index', 'Meet', '会议室预定');
INSERT INTO `tp_app_class` VALUES ('27', null, '1', '/index.php?g=Qyapp&m=Day&a=wap_index', 'Day', '日程管理');
INSERT INTO `tp_app_class` VALUES ('28', null, '1', '/index.php?g=Qyapp&m=Announce&a=wap_add_task', 'Announce', '发公告');
INSERT INTO `tp_app_class` VALUES ('29', null, '1', '/index.php?g=Qyapp&m=Announce&a=wap_index', 'Announce', '收到公告');
INSERT INTO `tp_app_class` VALUES ('30', null, '1', '/index.php?g=Qyapp&m=Home&a=wap_index', 'Home', '企业官网');
INSERT INTO `tp_app_class` VALUES ('31', null, '1', '/index.php?g=Qyapp&m=Knowledge&a=wap_index', 'Knowledge', '知识库');
INSERT INTO `tp_app_class` VALUES ('32', null, '1', '/index.php?g=Qyapp&m=Knowledge&a=wap_collect', 'Knowledge', '我的收藏');
INSERT INTO `tp_app_class` VALUES ('33', null, '1', '/index.php?g=Qyapp&m=Legwork&a=wap_index', 'Legwork', '外勤列表');
INSERT INTO `tp_app_class` VALUES ('34', null, '1', '/index.php?g=Qyapp&m=Legwork&a=wap_check', 'Legwork', '签到/退');
INSERT INTO `tp_app_class` VALUES ('35', null, '1', '/index.php?g=Qyapp&m=Legwork&a=wap_add', 'Legwork', '添加外勤');
INSERT INTO `tp_app_class` VALUES ('36', null, '1', '/index.php?g=Qyapp&m=Borrow_books&a=wap_index', 'Borrow_books', '企业图书馆');
INSERT INTO `tp_app_class` VALUES ('37', null, '1', '/index.php?g=Qyapp&m=Borrow_books&a=wap_my', 'Borrow_books', '我的借阅');
INSERT INTO `tp_app_class` VALUES ('38', null, '1', '/index.php?g=Qyapp&m=Distribution&a=wap_index', 'Distribution', '我的推荐');
INSERT INTO `tp_app_class` VALUES ('39', null, '1', '/index.php?g=Qyapp&m=Test&a=wap_index', 'Test', '在线考试');

-- ----------------------------
-- Table structure for `tp_department`
-- ----------------------------
DROP TABLE IF EXISTS `tp_department`;
CREATE TABLE `tp_department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL COMMENT '部门名称',
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `lvl` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `pos` int(10) unsigned NOT NULL,
  `wxpid` int(11) DEFAULT '0',
  `wxid` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `leaderid` int(11) DEFAULT NULL,
  `leaderuserid` varchar(16) DEFAULT NULL,
  `leadername` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1745 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_department
-- ----------------------------
INSERT INTO `tp_department` VALUES ('1743', '跑得快速递', '0', '4', '0', '0', '0', '0', '1', '25', null, null, null);
INSERT INTO `tp_department` VALUES ('1744', '111111', '2', '3', '1', '1743', '0', '1', '2', '25', null, null, null);

-- ----------------------------
-- Table structure for `tp_disturb_gener`
-- ----------------------------
DROP TABLE IF EXISTS `tp_disturb_gener`;
CREATE TABLE `tp_disturb_gener` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '公司ID',
  `gen_name` varchar(150) DEFAULT NULL COMMENT '推广标题',
  `gen_link` varchar(300) DEFAULT NULL COMMENT '推广链接',
  `status` tinyint(1) DEFAULT '0' COMMENT '发布状态',
  `gen_info` text COMMENT '推广内容',
  `time` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_disturb_gener
-- ----------------------------
INSERT INTO `tp_disturb_gener` VALUES ('1', '25', 'afjlawdkf', 'www.baidu.om', '0', 'lanrain:$data.gen_name		lanrain:$data.gen_name		lanrain:$data.gen_name		lanrain:$data.gen_name		lanrain:$data.gen_name		lanrain:$data.gen_name					', '1427704572');
INSERT INTO `tp_disturb_gener` VALUES ('2', '25', '123', 'www.baidu.om', '0', '  hahaha', '1427704825');

-- ----------------------------
-- Table structure for `tp_disturb_menu`
-- ----------------------------
DROP TABLE IF EXISTS `tp_disturb_menu`;
CREATE TABLE `tp_disturb_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `link` varchar(65) DEFAULT NULL,
  `file` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_disturb_menu
-- ----------------------------
INSERT INTO `tp_disturb_menu` VALUES ('1', '25', 'http://ec.ilovety.cn', 'qy_api.php');

-- ----------------------------
-- Table structure for `tp_disturb_my`
-- ----------------------------
DROP TABLE IF EXISTS `tp_disturb_my`;
CREATE TABLE `tp_disturb_my` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(128) DEFAULT NULL COMMENT '订单号',
  `money` float DEFAULT NULL COMMENT '现金分成',
  `point` float DEFAULT NULL COMMENT '积分分成',
  `separate_type` tinyint(1) DEFAULT NULL COMMENT '分成模式',
  `is_separate` tinyint(1) DEFAULT '0' COMMENT '分成状态',
  `user_id` int(11) NOT NULL COMMENT '公司ID',
  `uid` int(11) DEFAULT NULL COMMENT '人员ID',
  `time` int(11) DEFAULT NULL COMMENT '添加时间',
  `status` tinyint(1) DEFAULT '0' COMMENT '提现状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_disturb_my
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_disturb_order`
-- ----------------------------
DROP TABLE IF EXISTS `tp_disturb_order`;
CREATE TABLE `tp_disturb_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL COMMENT '订单ID',
  `user_id` int(11) DEFAULT NULL COMMENT '企业ID',
  `uid` int(11) DEFAULT NULL COMMENT '下订单用户',
  `parent_id` int(11) DEFAULT NULL COMMENT '分享人的ID',
  `order_sn` varchar(200) DEFAULT NULL COMMENT '订单号',
  `goods_id` int(11) DEFAULT NULL COMMENT '产品ID',
  `goods_name` varchar(200) DEFAULT NULL COMMENT '产品名称',
  `goods_sn` varchar(200) DEFAULT NULL COMMENT '产品编号',
  `market_price` float DEFAULT NULL COMMENT '产品市场价',
  `goods_price` float DEFAULT NULL COMMENT '产品价格',
  `goods_attr` varchar(200) DEFAULT NULL COMMENT '产品颜色',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_disturb_order
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_disturb_product`
-- ----------------------------
DROP TABLE IF EXISTS `tp_disturb_product`;
CREATE TABLE `tp_disturb_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '公司ID',
  `goods_id` int(11) DEFAULT NULL COMMENT '产品ID',
  `goods_name` varchar(300) DEFAULT NULL COMMENT '产品名称',
  `goods_sn` varchar(128) DEFAULT NULL COMMENT '产品编号',
  `price` float DEFAULT NULL COMMENT '产品市场价格',
  `money` float DEFAULT NULL COMMENT '产品实际价格',
  `scale` float DEFAULT NULL COMMENT '佣金比例',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_disturb_product
-- ----------------------------
INSERT INTO `tp_disturb_product` VALUES ('6', '25', '4', null, null, null, null, '0.5');
INSERT INTO `tp_disturb_product` VALUES ('5', '25', '1', null, null, null, null, '0.2');
INSERT INTO `tp_disturb_product` VALUES ('7', '25', '3', null, null, null, null, '0.32');
INSERT INTO `tp_disturb_product` VALUES ('8', '25', '5', null, null, null, null, '0.46');
INSERT INTO `tp_disturb_product` VALUES ('9', '25', '6', null, null, null, null, '0.23');
INSERT INTO `tp_disturb_product` VALUES ('10', '25', '7', null, null, null, null, '0.36');
INSERT INTO `tp_disturb_product` VALUES ('11', '25', '8', null, null, null, null, '0.42');
INSERT INTO `tp_disturb_product` VALUES ('12', '25', '9', null, null, null, null, '0.54');
INSERT INTO `tp_disturb_product` VALUES ('13', '25', '10', null, null, null, null, '0.2');
INSERT INTO `tp_disturb_product` VALUES ('14', '25', '11', null, null, null, null, '0.2');
INSERT INTO `tp_disturb_product` VALUES ('15', '25', '12', null, null, null, null, '0.3');

-- ----------------------------
-- Table structure for `tp_disturb_users`
-- ----------------------------
DROP TABLE IF EXISTS `tp_disturb_users`;
CREATE TABLE `tp_disturb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '公司ID',
  `uid` int(11) DEFAULT NULL COMMENT '分销人员ID',
  `name` varchar(45) DEFAULT NULL COMMENT '人员姓名',
  `parent_id` int(11) DEFAULT NULL COMMENT '所属上级',
  `bankcard` varchar(19) DEFAULT NULL COMMENT '银行卡号',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机号',
  `wxid` varchar(100) DEFAULT NULL COMMENT '微信号',
  `email` varchar(64) DEFAULT NULL COMMENT '邮箱',
  `rule` varchar(300) DEFAULT NULL COMMENT '分成规则',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_disturb_users
-- ----------------------------
INSERT INTO `tp_disturb_users` VALUES ('1', '228', '1', 'aaa', '0', null, '13245678901', null, null, null);
INSERT INTO `tp_disturb_users` VALUES ('2', '228', '2', 'bbb', '0', null, '13245678901', null, null, null);
INSERT INTO `tp_disturb_users` VALUES ('3', '228', '3', 'ccc', '1', null, '13245678901', null, null, null);
INSERT INTO `tp_disturb_users` VALUES ('4', '228', '4', 'ddd', '1', null, '13245678901', null, null, null);
INSERT INTO `tp_disturb_users` VALUES ('5', '228', '5', 'eee', '2', null, '13245678901', null, null, null);
INSERT INTO `tp_disturb_users` VALUES ('6', '228', '6', 'fff', '2', null, '13245678901', null, null, null);
INSERT INTO `tp_disturb_users` VALUES ('7', '228', '7', 'ggg', '3', null, '13245678901', null, null, null);
INSERT INTO `tp_disturb_users` VALUES ('8', '228', '8', 'hhh', '4', null, '13245678901', null, null, null);
INSERT INTO `tp_disturb_users` VALUES ('9', '228', '9', 'jjj', '3', null, '13245678901', null, null, null);
INSERT INTO `tp_disturb_users` VALUES ('10', '228', '10', 'kkk', '4', null, '13245678901', null, null, null);
INSERT INTO `tp_disturb_users` VALUES ('11', '228', '11', 'lll', '7', null, '13245678901', null, null, null);

-- ----------------------------
-- Table structure for `tp_disturb_wxusers`
-- ----------------------------
DROP TABLE IF EXISTS `tp_disturb_wxusers`;
CREATE TABLE `tp_disturb_wxusers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `wxid` varchar(64) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_disturb_wxusers
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_group`
-- ----------------------------
DROP TABLE IF EXISTS `tp_group`;
CREATE TABLE `tp_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `uid` int(10) DEFAULT NULL,
  `pwd` varchar(60) DEFAULT NULL,
  `group` varchar(60) DEFAULT NULL,
  `position` varchar(300) DEFAULT NULL,
  `number` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_group
-- ----------------------------
INSERT INTO `tp_group` VALUES ('10', '2222', '1', 'bcbe3365e6ac95ea2c0343a2395834dd', '2222', '2222', null);
INSERT INTO `tp_group` VALUES ('14', '666', '1', 'fae0b27c451c728867a567e8c1bb4e53', '666', '666', null);
INSERT INTO `tp_group` VALUES ('13', '555', '1', '15de21c670ae7c3f6f3f1f37029303c9', '555', '555', null);
INSERT INTO `tp_group` VALUES ('12', '222333', '1', 'bcbe3365e6ac95ea2c0343a2395834dd', '222333', '222333', null);
INSERT INTO `tp_group` VALUES ('15', '777', '1', 'f1c1592588411002af340cbaedd6fc33', '777', '777', null);
INSERT INTO `tp_group` VALUES ('18', 'xing', '25', '866a6cafcf74ab3c2612a85626f1c706', '8888', '35345', null);
INSERT INTO `tp_group` VALUES ('19', 'weiyi', '25', '0c05c555fa4fc34c474949f71615915f', 'weiyi', 'weiyi', null);
INSERT INTO `tp_group` VALUES ('28', 'molibao', '26', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '总监', null);
INSERT INTO `tp_group` VALUES ('21', '222', '87', 'e10adc3949ba59abbe56e057f20f883e', '222', '222', null);
INSERT INTO `tp_group` VALUES ('22', 'aaa', null, null, null, null, null);
INSERT INTO `tp_group` VALUES ('25', '123', '134', '202cb962ac59075b964b07152d234b70', '123', '123', null);
INSERT INTO `tp_group` VALUES ('24', 'yewu', '101', 'dc483e80a7a0bd9ef71d8cf973673924', '业务审批组', '审批', null);
INSERT INTO `tp_group` VALUES ('26', 'zmq5151', '140', 'ff0455d9cd4ae72506eccac98b1e8293', '懂事局', '懂事', null);
INSERT INTO `tp_group` VALUES ('30', 'TEST', '219', '033bd94b1168d7e4f0d644c3c95e35bf', 'TEST', '采购', null);

-- ----------------------------
-- Table structure for `tp_group_list`
-- ----------------------------
DROP TABLE IF EXISTS `tp_group_list`;
CREATE TABLE `tp_group_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(20) DEFAULT NULL,
  `appgroup` varchar(300) DEFAULT NULL,
  `setuserrule` int(1) DEFAULT '0',
  `setorgrule` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_group_list
-- ----------------------------
INSERT INTO `tp_group_list` VALUES ('1', '15', null, null, '0');
INSERT INTO `tp_group_list` VALUES ('2', '12', null, null, '0');
INSERT INTO `tp_group_list` VALUES ('13', '13', null, '0', '0');
INSERT INTO `tp_group_list` VALUES ('6', '16', null, '0', '0');
INSERT INTO `tp_group_list` VALUES ('5', '14', null, '0', '0');
INSERT INTO `tp_group_list` VALUES ('18', '18', null, '0', '0');
INSERT INTO `tp_group_list` VALUES ('19', '19', null, '1', '0');
INSERT INTO `tp_group_list` VALUES ('20', '20', null, '1', '1');
INSERT INTO `tp_group_list` VALUES ('21', null, null, '0', '0');
INSERT INTO `tp_group_list` VALUES ('22', null, null, '0', '0');
INSERT INTO `tp_group_list` VALUES ('24', '24', null, '1', '0');
INSERT INTO `tp_group_list` VALUES ('25', '23', null, '0', '0');
INSERT INTO `tp_group_list` VALUES ('26', '27', null, '0', '0');

-- ----------------------------
-- Table structure for `tp_indent`
-- ----------------------------
DROP TABLE IF EXISTS `tp_indent`;
CREATE TABLE `tp_indent` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `order` varchar(80) NOT NULL,
  `price` float NOT NULL,
  `time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `gid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `info` int(11) NOT NULL,
  `widtrade_no` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_indent
-- ----------------------------
INSERT INTO `tp_indent` VALUES ('8', '充值vip会员1个月', '25', 'weiyi', '_1421839001', '100', '0', '2', '2', '1421839001', '0', '0');
INSERT INTO `tp_indent` VALUES ('9', '充值vip会员1个月', '25', 'weiyi', '_1421894983', '100', '0', '0', '2', '1421894983', '0', '0');
INSERT INTO `tp_indent` VALUES ('10', '充值vip会员1个月', '25', 'weiyi', '_1421896321', '100', '0', '0', '2', '1421896321', '0', '0');
INSERT INTO `tp_indent` VALUES ('11', '充值vip会员2个月', '25', 'weiyi', '_1421901832', '200', '0', '0', '2', '1421901832', '0', '0');

-- ----------------------------
-- Table structure for `tp_log_comment`
-- ----------------------------
DROP TABLE IF EXISTS `tp_log_comment`;
CREATE TABLE `tp_log_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` int(11) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `content` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_log_comment
-- ----------------------------
INSERT INTO `tp_log_comment` VALUES ('18', '222', '0', '71', '1429082866', '阿斯顿');
INSERT INTO `tp_log_comment` VALUES ('19', null, '0', '68', '1429083048', '地理');
INSERT INTO `tp_log_comment` VALUES ('20', null, '0', '71', '1429083272', '阿斯顿');
INSERT INTO `tp_log_comment` VALUES ('21', '25', '2147483647', '68', '1429083295', '明');
INSERT INTO `tp_log_comment` VALUES ('22', null, '0', '71', '1429083844', '阿斯顿');
INSERT INTO `tp_log_comment` VALUES ('23', '25', '2147483647', '68', '1429083868', '闽');
INSERT INTO `tp_log_comment` VALUES ('24', null, '0', '71', '1429084126', 'as');
INSERT INTO `tp_log_comment` VALUES ('25', '25', '2147483647', '68', '1429084322', '插');
INSERT INTO `tp_log_comment` VALUES ('26', '25', '2147483647', '68', '1429084339', '妈妈');
INSERT INTO `tp_log_comment` VALUES ('27', '25', '0', '68', '1429084433', '说啥啊');
INSERT INTO `tp_log_comment` VALUES ('28', '25', '0', '68', '1429084465', '说啥啊！是不是真的啊你说你说你说你说你说你说你说你说你说你说你说你说你说你说你说的样子哦(⊙o⊙)哦(⊙o⊙)哦(⊙o⊙)哦(⊙o⊙)哦(⊙o⊙)哦(⊙o⊙)哦(⊙o⊙)哦(⊙o⊙)哦(⊙o⊙)哦(⊙o⊙)哦(⊙o⊙)哦(⊙o⊙)哦(⊙o⊙)哦！KTV新民');
INSERT INTO `tp_log_comment` VALUES ('29', '25', '270636852', '69', '1429085533', '素颜美女');
INSERT INTO `tp_log_comment` VALUES ('30', '25', '270636852', '69', '1429086653', '复古风改革');
INSERT INTO `tp_log_comment` VALUES ('31', '25', '33', '74', '1429165236', '热搜');
INSERT INTO `tp_log_comment` VALUES ('32', '25', '0', '75', '1429175194', '卧槽');
INSERT INTO `tp_log_comment` VALUES ('33', '25', '0', '75', '1429175206', '卧槽嗨喽');
INSERT INTO `tp_log_comment` VALUES ('34', '25', '0', '75', '1429175223', '还有什么时候回来的时候回来');
INSERT INTO `tp_log_comment` VALUES ('35', '25', '0', '81', '1429235397', '什么情况哦');
INSERT INTO `tp_log_comment` VALUES ('36', '25', '0', '81', '1429235428', '哎哟不错哦');
INSERT INTO `tp_log_comment` VALUES ('37', '25', '270636852', '83', '1429255631', '功夫 v');
INSERT INTO `tp_log_comment` VALUES ('38', '25', '33', '74', '1429501872', 'cnmm');
INSERT INTO `tp_log_comment` VALUES ('39', '25', '2147483647', '85', '1429510003', '你是熊去');
INSERT INTO `tp_log_comment` VALUES ('40', '25', '0', '110', '1429521212', '图片有点小');
INSERT INTO `tp_log_comment` VALUES ('41', '25', '0', '110', '1429521230', '图片有点小再来');
INSERT INTO `tp_log_comment` VALUES ('42', '25', '270636852', '83', '1429521684', '如果 v 吃');
INSERT INTO `tp_log_comment` VALUES ('43', '25', '270636852', '83', '1429521924', '刚刚幸福');
INSERT INTO `tp_log_comment` VALUES ('44', '25', '0', '96', '1429522284', '评论渣渣');
INSERT INTO `tp_log_comment` VALUES ('45', '25', '0', '96', '1429522292', '评论渣渣儿');

-- ----------------------------
-- Table structure for `tp_log_pic`
-- ----------------------------
DROP TABLE IF EXISTS `tp_log_pic`;
CREATE TABLE `tp_log_pic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '公司ID',
  `picurl` varchar(300) DEFAULT NULL COMMENT '图片地址',
  `wecha_id` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_log_pic
-- ----------------------------
INSERT INTO `tp_log_pic` VALUES ('25', '25', './Uploads/Log/25/li_jun_6/1429176542761.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('24', '25', './Uploads/Log/25/li_jun_6/1429175492390.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('23', '25', './Uploads/Log/25/li_jun_6/1429175492247.json', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('22', '25', './Uploads/Log/25/li_jun_6/1429175334159.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('21', '25', './Uploads/Log/25/li_jun_6/1429175333686.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('20', '25', './Uploads/Log/25/li_jun_6/1429175178111.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('19', '25', './Uploads/Log/25/0033/1429165211656.jpeg', '0033');
INSERT INTO `tp_log_pic` VALUES ('18', '25', './Uploads/Log/25/270636852/1429086890782.jpeg', '270636852');
INSERT INTO `tp_log_pic` VALUES ('17', '25', './Uploads/Log/25/li_jun_6/1429086546422.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('16', '25', './Uploads/Log/25/li_jun_6/1429070255742.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('26', '25', './Uploads/Log/25/li_jun_6/1429176543101.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('27', '25', './Uploads/Log/25/li_jun_6/1429177046879.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('28', '25', './Uploads/Log/25/li_jun_6/1429234626363.json', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('29', '25', './Uploads/Log/25/li_jun_6/1429235314978.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('30', '25', './Uploads/Log/25/0033/1429242357197.jpeg', '0033');
INSERT INTO `tp_log_pic` VALUES ('31', '25', './Uploads/Log/25/270636852/1429255606828.jpeg', '270636852');
INSERT INTO `tp_log_pic` VALUES ('32', '25', './Uploads/Log/25/270636852/1429255606676.jpeg', '270636852');
INSERT INTO `tp_log_pic` VALUES ('33', '25', './Uploads/Log/25/li_jun_6/1429492980729.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('34', '25', './Uploads/Log/25/77484824865/1429493599490.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('35', '25', './Uploads/Log/25/77484824865/1429493600408.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('36', '25', './Uploads/Log/25/77484824865/1429494096962.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('37', '25', './Uploads/Log/25/77484824865/1429494210170.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('38', '25', './Uploads/Log/25/77484824865/1429494491159.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('39', '25', './Uploads/Log/25/li_jun_6/1429494522689.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('40', '25', './Uploads/Log/25/li_jun_6/1429502181218.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('41', '25', './Uploads/Log/25/77484824865/1429509989685.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('42', '25', './Uploads/Log/25/li_jun_6/1429510131413.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('43', '25', './Uploads/Log/25/li_jun_6/1429510309207.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('44', '25', './Uploads/Log/25/270636852/1429510477742.jpeg', '270636852');
INSERT INTO `tp_log_pic` VALUES ('45', '25', './Uploads/Log/25/77484824865/1429510664183.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('46', '25', './Uploads/Log/25/77484824865/1429510712950.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('47', '25', './Uploads/Log/25/77484824865/1429511096293.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('48', '25', './Uploads/Log/25/77484824865/1429511255307.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('49', '25', './Uploads/Log/25/77484824865/1429511342785.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('50', '25', './Uploads/Log/25/li_jun_6/1429511433168.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('51', '25', './Uploads/Log/25/77484824865/1429512538345.json', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('52', '25', './Uploads/Log/25/77484824865/1429512538211.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('53', '25', './Uploads/Log/25/77484824865/1429513261743.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('54', '25', './Uploads/Log/25/77484824865/1429513261479.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('55', '25', './Uploads/Log/25/77484824865/1429513396994.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('56', '25', './Uploads/Log/25/77484824865/1429513397129.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('57', '25', './Uploads/Log/25/li_jun_6/1429513509337.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('58', '25', './Uploads/Log/25/li_jun_6/1429513510699.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('59', '25', './Uploads/Log/25/li_jun_6/1429513510132.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('60', '25', './Uploads/Log/25/77484824865/1429513546790.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('61', '25', './Uploads/Log/25/77484824865/1429513546981.jpeg', '77484824865');
INSERT INTO `tp_log_pic` VALUES ('62', '25', './Uploads/Log/25/li_jun_6/1429521148611.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('63', '25', './Uploads/Log/25/li_jun_6/1429521148717.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('64', '25', './Uploads/Log/25/li_jun_6/1429521149939.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('65', '25', './Uploads/Log/25/li_jun_6/1429521149256.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('66', '25', './Uploads/Log/25/li_jun_6/1429521149568.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('67', '25', './Uploads/Log/25/li_jun_6/1429521149213.jpeg', 'li_jun_6');
INSERT INTO `tp_log_pic` VALUES ('68', '25', './Uploads/Log/25/li_jun_6/1429521149267.jpeg', 'li_jun_6');

-- ----------------------------
-- Table structure for `tp_qyaftersale_comment`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyaftersale_comment`;
CREATE TABLE `tp_qyaftersale_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `list_id` int(11) DEFAULT NULL COMMENT '申请的ID',
  `wecha_id` varchar(64) DEFAULT NULL COMMENT '审核人',
  `content` text COMMENT '审核理由',
  `status` tinyint(1) DEFAULT NULL COMMENT '审核状态（通过还是拒绝）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyaftersale_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyaftersale_config`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyaftersale_config`;
CREATE TABLE `tp_qyaftersale_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `audit` text,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyaftersale_config
-- ----------------------------
INSERT INTO `tp_qyaftersale_config` VALUES ('18', '25', '1', 'a:2:{i:0;s:9:\"270636852\";i:1;s:8:\"li_jun_6\";}', '1429524049');

-- ----------------------------
-- Table structure for `tp_qyaftersale_list`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyaftersale_list`;
CREATE TABLE `tp_qyaftersale_list` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '公司ID',
  `wecha_id` varchar(32) DEFAULT NULL COMMENT '用户id',
  `type` varchar(64) DEFAULT NULL COMMENT '售后类型',
  `status` tinyint(1) DEFAULT '1' COMMENT '处理状态(1正在审核，2拒绝，3通过)',
  `pic` varchar(300) DEFAULT NULL COMMENT '上传图片',
  `video` varchar(300) DEFAULT NULL COMMENT '上传视频',
  `time` int(11) DEFAULT NULL COMMENT '发起时间',
  `pid` varchar(300) DEFAULT NULL COMMENT '审核人的ID',
  `title` varchar(150) DEFAULT NULL COMMENT '售后名称',
  `content` text COMMENT '售后申请描述',
  `audit` varchar(300) DEFAULT NULL COMMENT '审核情况',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyaftersale_list
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyaftersale_pic`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyaftersale_pic`;
CREATE TABLE `tp_qyaftersale_pic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pic` varchar(128) DEFAULT NULL COMMENT '申请的图片',
  `list_id` int(11) DEFAULT NULL COMMENT '申请的ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyaftersale_pic
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyaftersale_type`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyaftersale_type`;
CREATE TABLE `tp_qyaftersale_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `disorder` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyaftersale_type
-- ----------------------------
INSERT INTO `tp_qyaftersale_type` VALUES ('5', '修理类', '1', '1', null, null);
INSERT INTO `tp_qyaftersale_type` VALUES ('6', '服务类', '1', '2', null, null);
INSERT INTO `tp_qyaftersale_type` VALUES ('7', '指导类', '1', '3', null, null);

-- ----------------------------
-- Table structure for `tp_qyagent_config`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyagent_config`;
CREATE TABLE `tp_qyagent_config` (
  `uid` int(10) NOT NULL,
  `upload_type` varchar(20) DEFAULT NULL,
  `up_bucket` varchar(20) DEFAULT NULL,
  `up_form_api_secret` varchar(50) DEFAULT NULL,
  `up_username` varchar(50) DEFAULT NULL,
  `up_password` varchar(50) DEFAULT NULL,
  `up_domainname` varchar(100) DEFAULT NULL,
  `up_exts` varchar(100) DEFAULT NULL,
  `up_size` varchar(50) DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyagent_config
-- ----------------------------
INSERT INTO `tp_qyagent_config` VALUES ('25', 'local', 'zhumengliuyun', 'n9hQggLr+Q+1mKKlOzwlHp1zTMs=', 'zhumengliuyun', '1qazxsw23edc', 'zhumengliuyun.b0.upaiyun.com', 'jpg,png', '10000', '25');
INSERT INTO `tp_qyagent_config` VALUES ('235', 'upyun', '23423', '423423', '42342', '34234', '234234', '23424', '234234', '0');

-- ----------------------------
-- Table structure for `tp_qyapplist`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyapplist`;
CREATE TABLE `tp_qyapplist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `times` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1',
  `module` varchar(16) DEFAULT NULL,
  `vip` int(11) DEFAULT NULL,
  `install` tinyint(1) DEFAULT '0',
  `date` int(11) DEFAULT NULL,
  `suit_id` int(11) DEFAULT NULL,
  `suit_appid` int(11) DEFAULT NULL,
  `category` int(4) DEFAULT NULL COMMENT '1基础功能 2 3G网站 3营销活动 4行业模块 5商务模块 6CRM系统 7互动模块',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyapplist
-- ----------------------------
INSERT INTO `tp_qyapplist` VALUES ('1', '微信考勤', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', './Static/thumb/thumb_Attendance.jpg', '36', '1', 'Attendance', '1', '1', '1420624171', '3', '6', '1');
INSERT INTO `tp_qyapplist` VALUES ('2', '企业邮箱', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', './Static/thumb/thumb_Email.jpg', '45', '1', 'Email', '3', '0', null, '3', '2', '1');
INSERT INTO `tp_qyapplist` VALUES ('3', '投票', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', './Static/thumb/thumb_Vote.png', '439', '1', 'Vote', '1', '1', '1434198340', '3', '1', '3');
INSERT INTO `tp_qyapplist` VALUES ('4', '报销', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', './Static/thumb/thumb_Applyflow.png', '4', '1', 'Applyflow', '1', '1', null, '3', '1', '1');
INSERT INTO `tp_qyapplist` VALUES ('5', '流程审批', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', './Static/thumb/thumb_Workflow.png', '6', '1', 'Workflow', '1', '1', '1434198335', '3', '1', '1');
INSERT INTO `tp_qyapplist` VALUES ('6', '任务协作', '任务管理应用，轻松安排您与团队每一天的工作分派，实时掌握工作进度，有效提高您和团队的工作效率。', './Static/thumb/thumb_Task.png', '3', '1', 'Task', '2', '1', null, '3', '1', '1');
INSERT INTO `tp_qyapplist` VALUES ('8', '通讯录', '员工通讯录快速共享，常用、保密联系人自由设置。', './Static/thumb/thumb_Address.png', '4', '1', 'Address', '1', '1', '1434198321', '3', '1', '1');
INSERT INTO `tp_qyapplist` VALUES ('9', '调研', '调研应用，实时收集来自团队的宝贵意见，数据分析直观明了，有效提高您的调研质量。', './Static/thumb/thumb_Research.png', '3', '1', 'Research', '0', '1', '1434198330', '3', '1', '3');
INSERT INTO `tp_qyapplist` VALUES ('10', '招聘', '让一群小小HR在微信6亿用户中,帮企业搜寻符合招聘要求的潜在求职者。', './Static/thumb/thumb_Hiring.png', '27', '1', 'Hiring', '0', '1', null, '3', '1', '1');
INSERT INTO `tp_qyapplist` VALUES ('11', '请假', '及时的消息提醒,简单的处理方式,精简的审批流程,方便您及时高效处理请假申请。', './Static/thumb/thumb_Leave.png', '28', '1', 'Leave', '0', '1', '1434198332', '3', '1', '1');
INSERT INTO `tp_qyapplist` VALUES ('12', '微名片', '创建个性名片,收纳海量好友,是一款时尚又新潮,简单又好用的电子名片管理应用。', './Static/thumb/thumb_Card.png', '26', '1', 'Card', '0', '1', null, '3', '1', '5');
INSERT INTO `tp_qyapplist` VALUES ('13', '会议室预定', '高效的会议室预定管理应用,解决您烦恼的会议室预定管理问题。', './Static/thumb/thumb_Meet.png', '224', '1', 'Meet', '0', '1', null, '3', '1', '1');
INSERT INTO `tp_qyapplist` VALUES ('14', '日程管理', '简洁直观，方便易用，不论工作安排还是日常记事，有了它不再忘东忘西。', './Static/thumb/thumb_Day.png', '26', '1', 'Day', '0', '1', null, '3', '1', '1');
INSERT INTO `tp_qyapplist` VALUES ('15', '企业公告', '企业公告企业公告企业公告', './Static/thumb/thumb_Announce.png', null, '1', 'Announce', '0', '1', null, '3', '1', '1');
INSERT INTO `tp_qyapplist` VALUES ('17', '外勤', '微信外勤，时下最流行的考勤形式，高效掌控员工出勤状况。', './Static/thumb/thumb_Legwork.png', '29', '1', 'Legwork', '0', '1', null, '3', '1', '1');
INSERT INTO `tp_qyapplist` VALUES ('18', '企业知识库', '企业知识库', './Static/thumb/thumb_Knowledge.png', null, '1', 'Knowledge', '0', '1', null, '3', '1', '7');
INSERT INTO `tp_qyapplist` VALUES ('19', '离职', '离职', './Static/thumb/thumb_Quit.png', '233', '1', 'Quit', '0', '1', null, '3', '1', '1');
INSERT INTO `tp_qyapplist` VALUES ('20', '借书', '借书', './Static/thumb/thumb_Borrow_books.png', '236', '1', 'Borrow_books', '0', '1', null, '3', '1', '7');
INSERT INTO `tp_qyapplist` VALUES ('22', '考试', '在线考试', './Static/thumb/thumb_Test.png', null, '1', 'Test', '0', '1', null, '3', '1', '7');
INSERT INTO `tp_qyapplist` VALUES ('23', '企业分销', '企业分销', 'http://qy.workweixin.com/Logo/借书.png', null, '1', 'Distribution', '0', '1', null, '3', '1', '5');
INSERT INTO `tp_qyapplist` VALUES ('24', '绩效', '微信绩效', './Static/thumb/thumb_Performance.png', null, '1', 'Performance', '0', '1', null, '3', '1', '1');
INSERT INTO `tp_qyapplist` VALUES ('25', '售后', '售后', './Static/thumb/thumb_Aftersale.png', null, '1', 'Aftersale', '0', '1', null, '3', '2', '5');
INSERT INTO `tp_qyapplist` VALUES ('26', '工作日志', '工作日志', './Static/thumb/thumb_Log.png', null, '1', 'Log', '0', '1', null, '3', '2', '1');

-- ----------------------------
-- Table structure for `tp_qyapplyflow`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyapplyflow`;
CREATE TABLE `tp_qyapplyflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '报销类型',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `department` varchar(200) DEFAULT NULL COMMENT '所属部门',
  `info` text COMMENT '相关说明',
  `audit` text COMMENT '审核人',
  `time` varchar(16) DEFAULT NULL,
  `place` varchar(200) NOT NULL COMMENT '出差地点',
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间',
  `nums` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `starttime` (`starttime`,`endtime`,`nums`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='报销表';

-- ----------------------------
-- Records of tp_qyapplyflow
-- ----------------------------
INSERT INTO `tp_qyapplyflow` VALUES ('1', '1', '2', '1', null, '出差呗', 'BOSS', null, '', '0', '0', '0');
INSERT INTO `tp_qyapplyflow` VALUES ('2', '1', '1', '2', null, '医药', 'BOSS', null, '', '0', '0', '0');
INSERT INTO `tp_qyapplyflow` VALUES ('3', '1', '1', '3', null, '出差事由发广告', null, '1415521568', '大大方方', '344', '555', '0');
INSERT INTO `tp_qyapplyflow` VALUES ('4', '1', null, '1', null, null, 'a:2:{i:0;s:5:\"32423\";i:1;s:6:\"234234\";}', '1415615120', '', '0', '0', '0');
INSERT INTO `tp_qyapplyflow` VALUES ('5', '1', null, '1', null, null, 'a:3:{i:0;s:3:\"222\";i:1;i:0;i:2;s:3:\"326\";}', '1415619949', '', '0', '0', '0');
INSERT INTO `tp_qyapplyflow` VALUES ('6', '1', null, '1', null, null, 'a:2:{i:0;i:0;i:1;s:9:\"的奋斗\";}', '1415620138', '', '0', '0', '0');
INSERT INTO `tp_qyapplyflow` VALUES ('7', null, '0', '0', null, '出差事由', null, '1415758712', '', '0', '0', '0');

-- ----------------------------
-- Table structure for `tp_qyapplyflow_config`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyapplyflow_config`;
CREATE TABLE `tp_qyapplyflow_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `audit` text COMMENT '审核人',
  `time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COMMENT='报销审核配置表';

-- ----------------------------
-- Records of tp_qyapplyflow_config
-- ----------------------------
INSERT INTO `tp_qyapplyflow_config` VALUES ('18', '1', '1', 'a:3:{i:0;i:0;i:1;s:6:\"xtzlyp\";i:2;s:8:\"wangming\";}', '1416449749');
INSERT INTO `tp_qyapplyflow_config` VALUES ('23', '26', '1', 'a:3:{i:0;i:0;i:1;s:3:\"菅\";i:2;s:3:\"郑\";}', '1416557499');
INSERT INTO `tp_qyapplyflow_config` VALUES ('67', '21', '1', 'a:3:{i:0;i:0;i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1423649345');
INSERT INTO `tp_qyapplyflow_config` VALUES ('91', '25', '1', 'a:1:{i:0;s:6:\"xiaoan\";}', '1447067773');

-- ----------------------------
-- Table structure for `tp_qyapplyflow_type`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyapplyflow_type`;
CREATE TABLE `tp_qyapplyflow_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL COMMENT '报销类型名称',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `disorder` int(11) DEFAULT NULL COMMENT '显示顺序',
  `time` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='报销类型表';

-- ----------------------------
-- Records of tp_qyapplyflow_type
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyapplyflow_user`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyapplyflow_user`;
CREATE TABLE `tp_qyapplyflow_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `name_defined` text COMMENT '自定义字段',
  `exam_status` tinyint(4) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `next_wecha_id` varchar(100) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL,
  `next_num` varchar(200) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `place` varchar(16) DEFAULT NULL,
  `starttime` varchar(16) DEFAULT NULL,
  `endtime` varchar(16) DEFAULT NULL,
  `allmoney` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyapplyflow_user
-- ----------------------------
INSERT INTO `tp_qyapplyflow_user` VALUES ('103', '25', null, 'a:1:{i:1;a:3:{s:6:\"dotime\";s:10:\"2015-02-01\";s:5:\"money\";s:3:\"100\";s:4:\"info\";s:108:\"领导呀我想报告一下我这次出差的报销呀领导呀我想报告一下我这次出差的报销呀\";}}', null, 'xtzlyp', '1', 'xiangshenghong', '1422697903', 'a:3:{i:0;s:7:\"xtzlyp2\";i:1;s:4:\"ding\";i:2;s:14:\"xiangshenghong\";}', '13', '武汉', '2015-01-31', '2015-02-06', '100');
INSERT INTO `tp_qyapplyflow_user` VALUES ('104', '25', null, 'a:2:{i:1;a:3:{s:6:\"dotime\";s:10:\"2015-02-01\";s:5:\"money\";s:3:\"100\";s:4:\"info\";s:108:\"领导呀我想报告一下我这次出差的报销呀领导呀我想报告一下我这次出差的报销呀\";}i:2;a:3:{s:6:\"dotime\";s:10:\"2015-02-03\";s:5:\"money\";s:3:\"600\";s:4:\"info\";s:6:\"吃饭\";}}', null, 'xtzlyp', '1', 'ding', '1422697937', 'a:3:{i:0;s:7:\"xtzlyp2\";i:1;s:4:\"ding\";i:2;s:14:\"xiangshenghong\";}', '13', '武汉', '2015-01-31', '2015-02-06', '700');
INSERT INTO `tp_qyapplyflow_user` VALUES ('105', '25', null, 'a:1:{i:1;a:3:{s:6:\"dotime\";s:15:\"这可真不少\";s:5:\"money\";s:3:\"111\";s:4:\"info\";s:3:\"222\";}}', null, '270636852', '1', 'xiangshenghong', '1423105500', 'a:3:{i:0;s:8:\"wangming\";i:1;s:6:\"xtzlyp\";i:2;s:14:\"xiangshenghong\";}', '30', 'z j z b', '自己是在 v', '侠客行表示', '111');
INSERT INTO `tp_qyapplyflow_user` VALUES ('106', '25', null, 'a:1:{i:1;a:3:{s:6:\"dotime\";s:2:\"11\";s:5:\"money\";s:2:\"11\";s:4:\"info\";s:2:\"11\";}}', null, '270636852', '1', 'xiangshenghong', '1423105713', 'a:3:{i:0;s:8:\"wangming\";i:1;s:6:\"xtzlyp\";i:2;s:14:\"xiangshenghong\";}', '13', '11', '11', '11', '11');
INSERT INTO `tp_qyapplyflow_user` VALUES ('107', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:0:\"\";s:5:\"money\";s:0:\"\";s:4:\"info\";s:0:\"\";s:5:\"total\";s:0:\"\";}}', null, '270636852', '1', 'xiangshenghong', '1423123236', 'a:3:{i:0;s:8:\"wangming\";i:1;s:6:\"xtzlyp\";i:2;s:14:\"xiangshenghong\";}', '0', '', '', '', '0');
INSERT INTO `tp_qyapplyflow_user` VALUES ('108', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:12:\"格外好吃\";s:5:\"money\";s:4:\"hdjc\";s:4:\"info\";s:7:\"gei c\";s:5:\"total\";s:10:\"j f nv\";}}', null, '270636852', '1', 'xiangshenghong', '1423217387', 'a:3:{i:0;s:8:\"wangming\";i:1;s:6:\"xtzlyp\";i:2;s:14:\"xiangshenghong\";}', '30', '感动你', '很神秘', '坚持多久', '0');
INSERT INTO `tp_qyapplyflow_user` VALUES ('109', '233', null, 'N;', null, 'admin', '1', null, '1424934440', 'N;', '0', null, null, null, null);
INSERT INTO `tp_qyapplyflow_user` VALUES ('110', '25', null, 'a:2:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-20\";s:5:\"money\";s:3:\"100\";s:4:\"info\";s:9:\"呵呵呵\";s:5:\"total\";s:6:\"300元\";}i:3;a:3:{s:6:\"dotime\";s:10:\"2015-03-21\";s:5:\"money\";s:3:\"200\";s:4:\"info\";s:9:\"淡淡的\";}}', null, 'qiancheng', '1', 'li_jun_6', '1426833769', 'a:2:{i:0;s:9:\"270636852\";i:1;s:8:\"li_jun_6\";}', '30', '点点滴滴', '2015-03-20', '2015-03-21', '300');
INSERT INTO `tp_qyapplyflow_user` VALUES ('111', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-20\";s:5:\"money\";s:3:\"200\";s:4:\"info\";s:9:\"出差费\";s:5:\"total\";s:6:\"200元\";}}', null, '0033', '1', 'li_jun_6', '1426833875', 'a:2:{i:0;s:9:\"270636852\";i:1;s:8:\"li_jun_6\";}', '13', '广州', '2015-03-20', '2015-03-23', '200');
INSERT INTO `tp_qyapplyflow_user` VALUES ('112', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-20\";s:5:\"money\";s:3:\"588\";s:4:\"info\";s:6:\"哈哈\";s:5:\"total\";s:6:\"588元\";}}', null, 'li_jun_6', '1', 'li_jun_6', '1426834004', 'a:2:{i:0;s:9:\"270636852\";i:1;s:8:\"li_jun_6\";}', '30', '广州', '2015-03-20', '2015-03-26', '588');
INSERT INTO `tp_qyapplyflow_user` VALUES ('113', '25', null, 'a:2:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-21\";s:5:\"money\";s:3:\"100\";s:4:\"info\";s:6:\"霍霍\";s:5:\"total\";s:6:\"300元\";}i:2;a:3:{s:6:\"dotime\";s:10:\"2015-03-21\";s:5:\"money\";s:3:\"200\";s:4:\"info\";s:6:\"哈哈\";}}', null, 'qiancheng', '1', 'li_jun_6', '1426900611', 'a:2:{i:0;s:9:\"270636852\";i:1;s:8:\"li_jun_6\";}', '31', '大石', '2015-03-21', '2015-03-22', '300');
INSERT INTO `tp_qyapplyflow_user` VALUES ('114', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-24\";s:5:\"money\";s:4:\"5666\";s:4:\"info\";s:6:\"楼下\";s:5:\"total\";s:7:\"5666元\";}}', null, 'li_jun_6', '1', 'li_jun_6', '1427177329', 'a:2:{i:0;s:9:\"270636852\";i:1;s:8:\"li_jun_6\";}', '31', '解决了', '2015-03-24', '2015-03-24', '5666');
INSERT INTO `tp_qyapplyflow_user` VALUES ('115', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-12-24\";s:5:\"money\";s:4:\"8800\";s:4:\"info\";s:12:\"很基本的\";s:5:\"total\";s:7:\"8800元\";}}', null, '0033', '1', 'li_jun_6', '1427186017', 'a:2:{i:0;s:9:\"270636852\";i:1;s:8:\"li_jun_6\";}', '30', '好了', '2015-03-24', '2015-05-24', '8800');
INSERT INTO `tp_qyapplyflow_user` VALUES ('116', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-26\";s:5:\"money\";s:2:\"22\";s:4:\"info\";s:0:\"\";s:5:\"total\";s:5:\"22元\";}}', null, 'lanrain', '1', 'li_jun_6', '1427370789', 'a:2:{i:0;s:9:\"270636852\";i:1;s:8:\"li_jun_6\";}', '13', '正日', '2015-03-26', '2015-03-26', '22');
INSERT INTO `tp_qyapplyflow_user` VALUES ('117', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-27\";s:5:\"money\";s:3:\"600\";s:4:\"info\";s:12:\"一心一意\";s:5:\"total\";s:6:\"600元\";}}', null, 'li_jun_6', '1', 'li_jun_6', '1427420043', 'a:2:{i:0;s:9:\"270636852\";i:1;s:8:\"li_jun_6\";}', '30', '四川', '2015-03-27', '2015-03-28', '600');
INSERT INTO `tp_qyapplyflow_user` VALUES ('118', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-27\";s:5:\"money\";s:3:\"123\";s:4:\"info\";s:12:\"饿好好好\";s:5:\"total\";s:6:\"123元\";}}', null, 'ding', '1', 'xiangshenghong', '1427421666', 'a:2:{i:0;s:4:\"ding\";i:1;s:14:\"xiangshenghong\";}', '13', '武汉', '2015-03-27', '2015-03-31', '123');
INSERT INTO `tp_qyapplyflow_user` VALUES ('119', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-27\";s:5:\"money\";s:3:\"132\";s:4:\"info\";s:9:\"饿个不\";s:5:\"total\";s:6:\"132元\";}}', null, 'ding', '1', 'xiangshenghong', '1427421790', 'a:2:{i:0;s:4:\"ding\";i:1;s:14:\"xiangshenghong\";}', '13', '武汉', '2015-03-27', '2015-03-31', '132');
INSERT INTO `tp_qyapplyflow_user` VALUES ('120', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-27\";s:5:\"money\";s:3:\"144\";s:4:\"info\";s:12:\"是个就你\";s:5:\"total\";s:6:\"144元\";}}', null, 'ding', '1', 'xiangshenghong', '1427422789', 'a:2:{i:0;s:4:\"ding\";i:1;s:14:\"xiangshenghong\";}', '13', '武汉', '2015-03-27', '2015-03-31', '144');
INSERT INTO `tp_qyapplyflow_user` VALUES ('121', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-28\";s:5:\"money\";s:3:\"500\";s:4:\"info\";s:6:\"哈哈\";s:5:\"total\";s:6:\"500元\";}}', null, '0033', '1', 'xiangshenghong', '1427440113', 'a:2:{i:0;s:4:\"ding\";i:1;s:14:\"xiangshenghong\";}', '13', '广州', '2015-03-27', '2015-03-30', '500');
INSERT INTO `tp_qyapplyflow_user` VALUES ('122', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-27\";s:5:\"money\";s:1:\"1\";s:4:\"info\";s:9:\"紧迫了\";s:5:\"total\";s:4:\"1元\";}}', null, 'rongcheng', '1', 'xiangshenghong', '1427441014', 'a:2:{i:0;s:4:\"ding\";i:1;s:14:\"xiangshenghong\";}', '13', '阿里吗', '2015-03-27', '2015-03-28', '1');
INSERT INTO `tp_qyapplyflow_user` VALUES ('123', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-27\";s:5:\"money\";s:1:\"2\";s:4:\"info\";s:6:\"诺路\";s:5:\"total\";s:4:\"2元\";}}', null, 'rongcheng', '1', 'xiangshenghong', '1427441058', 'a:2:{i:0;s:4:\"ding\";i:1;s:14:\"xiangshenghong\";}', '13', '你就是', '2015-03-27', '2015-03-28', '2');
INSERT INTO `tp_qyapplyflow_user` VALUES ('124', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-31\";s:5:\"money\";s:3:\"600\";s:4:\"info\";s:6:\"差旅\";s:5:\"total\";s:6:\"600元\";}}', null, '0033', '1', 'xiangshenghong', '1427442183', 'a:2:{i:0;s:4:\"ding\";i:1;s:14:\"xiangshenghong\";}', '31', '广州', '2015-03-27', '2015-03-29', '600');
INSERT INTO `tp_qyapplyflow_user` VALUES ('125', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-28\";s:5:\"money\";s:3:\"123\";s:4:\"info\";s:9:\"饿好你\";s:5:\"total\";s:6:\"123元\";}}', null, 'ding', '1', 'xiangshenghong', '1427453399', 'a:2:{i:0;s:4:\"ding\";i:1;s:14:\"xiangshenghong\";}', '13', '武汉', '2015-03-27', '2015-03-31', '123');
INSERT INTO `tp_qyapplyflow_user` VALUES ('126', '25', null, 'a:2:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-29\";s:5:\"money\";s:5:\"12345\";s:4:\"info\";s:9:\"上半年\";s:5:\"total\";s:8:\"35801元\";}i:2;a:3:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:5:\"23456\";s:4:\"info\";s:9:\"下半年\";}}', null, 'ding', '2', 'lanrain', '1427538209', 'a:1:{i:0;s:7:\"lanrain\";}', '13', '武汉', '2015-03-28', '2015-03-31', '35801');
INSERT INTO `tp_qyapplyflow_user` VALUES ('127', '25', null, 'a:2:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-29\";s:5:\"money\";s:5:\"12345\";s:4:\"info\";s:9:\"出差一\";s:5:\"total\";s:8:\"35801元\";}i:2;a:3:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:5:\"23456\";s:4:\"info\";s:9:\"出差二\";}}', null, 'ding', '1', null, '1427540022', 'a:2:{i:0;s:7:\"lanrain\";i:1;s:4:\"2233\";}', '13', '上海', '2015-03-28', '2015-03-31', '35801');
INSERT INTO `tp_qyapplyflow_user` VALUES ('128', '25', null, 'a:3:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-29\";s:5:\"money\";s:5:\"12345\";s:4:\"info\";s:12:\"的好好个\";s:5:\"total\";s:8:\"70368元\";}i:2;a:3:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:5:\"23456\";s:4:\"info\";s:12:\"差旅费二\";}i:3;a:3:{s:6:\"dotime\";s:10:\"2015-03-31\";s:5:\"money\";s:5:\"34567\";s:4:\"info\";s:9:\"附近把\";}}', null, 'ding', '1', 'lanrain', '1427540620', 'a:2:{i:0;s:7:\"lanrain\";i:1;s:4:\"2233\";}', '13', '北京', '2015-03-28', '2015-03-31', '70368');
INSERT INTO `tp_qyapplyflow_user` VALUES ('129', '25', null, 'a:3:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-29\";s:5:\"money\";s:5:\"12345\";s:4:\"info\";s:3:\"上\";s:5:\"total\";s:8:\"70368元\";}i:2;a:3:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:5:\"23456\";s:4:\"info\";s:3:\"中\";}i:3;a:3:{s:6:\"dotime\";s:10:\"2015-03-31\";s:5:\"money\";s:5:\"34567\";s:4:\"info\";s:3:\"下\";}}', null, 'ding', '1', '2233', '1427541639', 'a:2:{i:0;s:7:\"lanrain\";i:1;s:4:\"2233\";}', '31', '广州', '2015-03-28', '2015-03-31', '70368');
INSERT INTO `tp_qyapplyflow_user` VALUES ('130', '25', null, 'a:2:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:3:\"123\";s:4:\"info\";s:9:\"核武器\";s:5:\"total\";s:5:\"68898\";}i:2;a:3:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:12:\"公司现在\";s:4:\"info\";s:12:\"刚洗完澡\";}}', null, 'li_jun_6', '1', '2233', '1427679394', 'a:2:{i:0;s:7:\"lanrain\";i:1;s:4:\"2233\";}', '31', '大连', '2015-03-30', '2015-03-30', '123');
INSERT INTO `tp_qyapplyflow_user` VALUES ('131', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:3:\"500\";s:4:\"info\";s:6:\"哈哈\";s:5:\"total\";s:6:\"500元\";}}', null, '0033', '1', '2233', '1427681289', 'a:2:{i:0;s:7:\"lanrain\";i:1;s:4:\"2233\";}', '13', '广州', '2015-03-30', '2015-03-30', '500');
INSERT INTO `tp_qyapplyflow_user` VALUES ('132', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:3:\"123\";s:4:\"info\";s:18:\"就是因为 v 说\";s:5:\"total\";s:6:\"123元\";}}', null, '270636852', '1', '0033', '1427683285', 'a:1:{i:0;s:4:\"0033\";}', '13', '广州', '2015-03-30', '2015-03-31', '123');
INSERT INTO `tp_qyapplyflow_user` VALUES ('133', '25', null, 'a:2:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:5:\"25966\";s:4:\"info\";s:9:\"体育生\";s:5:\"total\";s:9:\"395965元\";}i:2;a:3:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:6:\"369999\";s:4:\"info\";s:9:\"去医院\";}}', null, 'li_jun_6', '1', '0033', '1427683342', 'a:1:{i:0;s:4:\"0033\";}', '30', '继续下去', '2015-03-30', '2015-03-30', '395965');
INSERT INTO `tp_qyapplyflow_user` VALUES ('134', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:3:\"500\";s:4:\"info\";s:6:\"还没\";s:5:\"total\";s:6:\"500元\";}}', null, '0033', '1', '0033', '1427683703', 'a:1:{i:0;s:4:\"0033\";}', '13', '哈哈', '2015-03-30', '2015-03-30', '500');
INSERT INTO `tp_qyapplyflow_user` VALUES ('135', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-31\";s:5:\"money\";s:3:\"300\";s:4:\"info\";s:6:\"哈刚\";s:5:\"total\";s:6:\"300元\";}}', null, '0033', '1', '0033', '1427683782', 'a:1:{i:0;s:4:\"0033\";}', '31', '哈哈', '2015-03-30', '2015-03-31', '300');
INSERT INTO `tp_qyapplyflow_user` VALUES ('136', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:3:\"360\";s:4:\"info\";s:27:\"哈哈哈哈哈哈哈哈\";s:5:\"total\";s:6:\"360元\";}}', null, 'li_jun_6', '1', '0033', '1427686267', 'a:1:{i:0;s:4:\"0033\";}', '31', '广州', '2015-03-30', '2015-03-30', '360');
INSERT INTO `tp_qyapplyflow_user` VALUES ('137', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-31\";s:5:\"money\";s:3:\"500\";s:4:\"info\";s:6:\"好好\";s:5:\"total\";s:6:\"500元\";}}', null, '0033', '1', '0033', '1427701561', 'a:1:{i:0;s:4:\"0033\";}', '30', '广州', '2015-03-30', '2015-03-31', '500');
INSERT INTO `tp_qyapplyflow_user` VALUES ('138', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-04-30\";s:5:\"money\";s:4:\"9654\";s:4:\"info\";s:6:\"够了\";s:5:\"total\";s:7:\"9654元\";}}', null, '0033', '1', '0033', '1427701693', 'a:1:{i:0;s:4:\"0033\";}', '31', '上海', '2015-03-31', '2015-04-23', '9654');
INSERT INTO `tp_qyapplyflow_user` VALUES ('139', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:6:\"123456\";s:4:\"info\";s:12:\"好好学习\";s:5:\"total\";s:9:\"123456元\";}}', null, 'li_jun_6', '1', '0033', '1427706461', 'a:1:{i:0;s:4:\"0033\";}', '31', '华山论剑', '2015-03-30', '2015-03-30', '123456');
INSERT INTO `tp_qyapplyflow_user` VALUES ('140', '25', null, 'a:3:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-03-31\";s:5:\"money\";s:3:\"500\";s:4:\"info\";s:11:\"不知是 v\";s:5:\"total\";s:7:\"1790元\";}i:2;a:3:{s:6:\"dotime\";s:10:\"2015-04-30\";s:5:\"money\";s:3:\"600\";s:4:\"info\";s:15:\"回族是 v 说\";}i:3;a:3:{s:6:\"dotime\";s:10:\"2015-03-30\";s:5:\"money\";s:3:\"690\";s:4:\"info\";s:12:\"起司蛋糕\";}}', null, '270636852', '1', '0033', '1427768010', 'a:1:{i:0;s:4:\"0033\";}', '13', 'gz', '2015-03-31', '2015-03-31', '1790');
INSERT INTO `tp_qyapplyflow_user` VALUES ('141', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-04-01\";s:5:\"money\";s:3:\"580\";s:4:\"info\";s:6:\"天空\";s:5:\"total\";s:6:\"580元\";}}', null, '0033', '1', '0033', '1427877044', 'a:1:{i:0;s:4:\"0033\";}', '13', '感觉', '2015-03-26', '2015-04-01', '580');
INSERT INTO `tp_qyapplyflow_user` VALUES ('142', '25', null, 'a:2:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-04-02\";s:5:\"money\";s:16:\"2699996666666666\";s:4:\"info\";s:12:\"一心一意\";s:5:\"total\";s:5:\"32569\";}i:2;a:3:{s:6:\"dotime\";s:10:\"2015-04-03\";s:5:\"money\";s:12:\"具体位置\";s:4:\"info\";s:9:\"咯呕吐\";}}', null, 'li_jun_6', '1', '0033', '1427959392', 'a:1:{i:0;s:4:\"0033\";}', '13', '广州', '2015-04-02', '2015-04-04', '10');
INSERT INTO `tp_qyapplyflow_user` VALUES ('143', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-04-10\";s:5:\"money\";s:3:\"500\";s:4:\"info\";s:6:\"车费\";s:5:\"total\";s:6:\"500元\";}}', null, '0033', '1', '0033', '1428568136', 'a:1:{i:0;s:4:\"0033\";}', '13', '广州', '2015-04-09', '2015-04-11', '500');
INSERT INTO `tp_qyapplyflow_user` VALUES ('144', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-04-22\";s:5:\"money\";s:3:\"500\";s:4:\"info\";s:5:\"gkkbb\";s:5:\"total\";s:6:\"500元\";}}', null, '0033', '1', '2233', '1429523832', 'a:4:{i:0;s:7:\"lanrain\";i:1;s:14:\"xiangshenghong\";i:2;s:4:\"ding\";i:3;s:4:\"2233\";}', '30', '广州', '2015-04-20', '2015-04-20', '500');
INSERT INTO `tp_qyapplyflow_user` VALUES ('145', '25', null, 'a:1:{i:1;a:4:{s:6:\"dotime\";s:10:\"2015-05-21\";s:5:\"money\";s:3:\"800\";s:4:\"info\";s:5:\"fjkmb\";s:5:\"total\";s:6:\"800元\";}}', null, '0033', '1', '2233', '1429524198', 'a:4:{i:0;s:7:\"lanrain\";i:1;s:14:\"xiangshenghong\";i:2;s:4:\"ding\";i:3;s:4:\"2233\";}', '30', '广州', '2015-04-20', '2015-04-22', '800');

-- ----------------------------
-- Table structure for `tp_qyapplyflow_witer`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyapplyflow_witer`;
CREATE TABLE `tp_qyapplyflow_witer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `form_wecha_id` varchar(100) DEFAULT NULL COMMENT '需要审核人的id',
  `module` varchar(32) DEFAULT NULL,
  `time` int(11) DEFAULT NULL COMMENT '审核时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=212 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyapplyflow_witer
-- ----------------------------
INSERT INTO `tp_qyapplyflow_witer` VALUES ('131', '25', '103', 'xtzlyp', '0', 'xtzlyp2', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('132', '25', '103', 'xtzlyp', '0', 'ding', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('133', '25', '103', 'xtzlyp', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('134', '25', '104', 'xtzlyp', '0', 'xtzlyp2', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('135', '25', '104', 'xtzlyp', '0', 'ding', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('136', '25', '104', 'xtzlyp', '1', 'xiangshenghong', 'Applyflow', '1422700624');
INSERT INTO `tp_qyapplyflow_witer` VALUES ('137', '25', '105', '270636852', '0', 'wangming', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('138', '25', '105', '270636852', '0', 'xtzlyp', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('139', '25', '105', '270636852', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('140', '25', '106', '270636852', '0', 'wangming', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('141', '25', '106', '270636852', '0', 'xtzlyp', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('142', '25', '106', '270636852', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('143', '25', '107', '270636852', '0', 'wangming', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('144', '25', '107', '270636852', '0', 'xtzlyp', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('145', '25', '107', '270636852', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('146', '25', '108', '270636852', '0', 'wangming', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('147', '25', '108', '270636852', '0', 'xtzlyp', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('148', '25', '108', '270636852', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('149', '25', '110', 'qiancheng', '0', '270636852', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('150', '25', '110', 'qiancheng', '0', 'li_jun_6', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('151', '25', '111', '0033', '0', '270636852', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('152', '25', '111', '0033', '0', 'li_jun_6', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('153', '25', '112', 'li_jun_6', '0', '270636852', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('154', '25', '112', 'li_jun_6', '0', 'li_jun_6', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('155', '25', '113', 'qiancheng', '0', '270636852', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('156', '25', '113', 'qiancheng', '0', 'li_jun_6', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('157', '25', '114', 'li_jun_6', '0', '270636852', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('158', '25', '114', 'li_jun_6', '0', 'li_jun_6', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('159', '25', '115', '0033', '0', '270636852', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('160', '25', '115', '0033', '0', 'li_jun_6', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('161', '25', '116', 'lanrain', '0', '270636852', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('162', '25', '116', 'lanrain', '0', 'li_jun_6', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('163', '25', '117', 'li_jun_6', '0', '270636852', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('164', '25', '117', 'li_jun_6', '0', 'li_jun_6', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('165', '25', '118', 'ding', '0', 'ding', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('166', '25', '118', 'ding', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('167', '25', '119', 'ding', '0', 'ding', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('168', '25', '119', 'ding', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('169', '25', '120', 'ding', '0', 'ding', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('170', '25', '120', 'ding', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('171', '25', '121', '0033', '0', 'ding', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('172', '25', '121', '0033', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('173', '25', '122', 'rongcheng', '0', 'ding', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('174', '25', '122', 'rongcheng', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('175', '25', '123', 'rongcheng', '0', 'ding', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('176', '25', '123', 'rongcheng', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('177', '25', '124', '0033', '0', 'ding', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('178', '25', '124', '0033', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('179', '25', '125', 'ding', '0', 'ding', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('180', '25', '125', 'ding', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('181', '25', '126', 'ding', '1', 'lanrain', 'Applyflow', '1427539405');
INSERT INTO `tp_qyapplyflow_witer` VALUES ('182', '25', '127', 'ding', '1', 'lanrain', 'Applyflow', '1427540098');
INSERT INTO `tp_qyapplyflow_witer` VALUES ('183', '25', '127', 'ding', '0', '2233', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('184', '25', '128', 'ding', '1', 'lanrain', 'Applyflow', '1427540662');
INSERT INTO `tp_qyapplyflow_witer` VALUES ('185', '25', '128', 'ding', '1', '2233', 'Applyflow', '1427541486');
INSERT INTO `tp_qyapplyflow_witer` VALUES ('186', '25', '129', 'ding', '2', 'lanrain', 'Applyflow', '1427542118');
INSERT INTO `tp_qyapplyflow_witer` VALUES ('187', '25', '129', 'ding', '0', '2233', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('188', '25', '130', 'li_jun_6', '0', 'lanrain', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('189', '25', '130', 'li_jun_6', '0', '2233', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('190', '25', '131', '0033', '0', 'lanrain', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('191', '25', '131', '0033', '0', '2233', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('192', '25', '132', '270636852', '0', '0033', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('193', '25', '133', 'li_jun_6', '0', '0033', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('194', '25', '134', '0033', '0', '0033', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('195', '25', '135', '0033', '0', '0033', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('196', '25', '136', 'li_jun_6', '0', '0033', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('197', '25', '137', '0033', '0', '0033', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('198', '25', '138', '0033', '0', '0033', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('199', '25', '139', 'li_jun_6', '0', '0033', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('200', '25', '140', '270636852', '0', '0033', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('201', '25', '141', '0033', '0', '0033', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('202', '25', '142', 'li_jun_6', '0', '0033', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('203', '25', '143', '0033', '0', '0033', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('204', '25', '144', '0033', '0', 'lanrain', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('205', '25', '144', '0033', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('206', '25', '144', '0033', '0', 'ding', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('207', '25', '144', '0033', '0', '2233', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('208', '25', '145', '0033', '0', 'lanrain', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('209', '25', '145', '0033', '0', 'xiangshenghong', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('210', '25', '145', '0033', '0', 'ding', 'Applyflow', null);
INSERT INTO `tp_qyapplyflow_witer` VALUES ('211', '25', '145', '0033', '0', '2233', 'Applyflow', null);

-- ----------------------------
-- Table structure for `tp_qyattendance`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyattendance`;
CREATE TABLE `tp_qyattendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `depart` varchar(100) DEFAULT NULL,
  `week` varchar(100) DEFAULT NULL,
  `out_day` varchar(300) DEFAULT NULL,
  `work_type` tinyint(1) DEFAULT NULL,
  `w_start` varchar(64) DEFAULT NULL,
  `w_stop_type` tinyint(1) DEFAULT NULL,
  `w_stop` varchar(64) DEFAULT NULL,
  `rest_o_minute` varchar(16) DEFAULT NULL,
  `rest_o_houer` varchar(16) DEFAULT NULL,
  `retime` varchar(64) DEFAULT NULL,
  `work_t_houer` varchar(16) DEFAULT NULL,
  `work_t_minute` varchar(16) DEFAULT NULL,
  `rest_t_houer` varchar(16) DEFAULT NULL,
  `rest_t_minute` varchar(16) DEFAULT NULL,
  `long_houer` varchar(16) DEFAULT NULL,
  `long_minute` varchar(16) DEFAULT NULL,
  `retime_t` varchar(16) DEFAULT NULL,
  `date` varchar(32) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyattendance
-- ----------------------------
INSERT INTO `tp_qyattendance` VALUES ('12', 'qe3qwe', '103-', null, null, '1', '09:30', '0', '09:30', '5', '0', '300', '0', '5', '0', '5', '0', '5', '300', '0', '1');
INSERT INTO `tp_qyattendance` VALUES ('14', '规则1', '-', '1|2|3|4', null, '1', '09:00', '0', '18:00', '5', '0', '300', '0', '5', '0', '5', '0', '5', '300', '0', null);
INSERT INTO `tp_qyattendance` VALUES ('18', '公司介绍', '7-', '1|2|3|4|5|6', null, '1', '09:30', '0', '09:30', '5', '0', '300', '0', '5', '0', '5', '0', '5', '300', '0', '26');
INSERT INTO `tp_qyattendance` VALUES ('19', '业务部', '1-', '1|2|3|4|5', null, '1', '09:00', '0', '18:00', '5', '0', '300', '0', '5', '0', '5', '0', '5', '300', '0', '191');
INSERT INTO `tp_qyattendance` VALUES ('24', '123', '1-|2-', '1|2|3|4|5|6', null, '1', '09:00', '0', '18:00', '5', '0', '300', '0', '5', '0', '5', '0', '5', '300', '0', '233');
INSERT INTO `tp_qyattendance` VALUES ('25', '考勤规则1', '-', '1|2|3|4|5|6|7', null, '1', '09:00', '0', '18:00', '5', '0', '300', '0', '5', '0', '5', '0', '5', '300', '0', '230');
INSERT INTO `tp_qyattendance` VALUES ('31', '测试', '20-', '1|2|3|4|5', '2015/04/01|2015/04/02|2015/04/03|2015/04/04|2015/04/05|2015/04/06|2015/04/07', '1', '10:00', '0', '17:00', '10', '8', '29400', '1', '10', '1', '2', '3', '4', '3720', '0', '25');
INSERT INTO `tp_qyattendance` VALUES ('30', 'aaa', '16-|-', '1|2', '2015/04/10', '2', '09:00', '0', '18:00', '0', '0', '0', '0', '0', '15', '0', '0', '0', '54000', '0', '25');

-- ----------------------------
-- Table structure for `tp_qyattendance_conf`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyattendance_conf`;
CREATE TABLE `tp_qyattendance_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `startdate` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `mor_o_on` tinyint(4) DEFAULT NULL COMMENT '签到提醒',
  `mor_o_time` int(11) DEFAULT NULL COMMENT '提醒时间',
  `mor_o_type` tinyint(1) DEFAULT NULL COMMENT '早或者晚',
  `aft_o_on` tinyint(4) DEFAULT NULL,
  `aft_o_time` int(11) DEFAULT NULL,
  `aft_o_type` tinyint(4) DEFAULT NULL,
  `aft_t_on` tinyint(1) DEFAULT NULL,
  `aft_t_time` int(11) DEFAULT NULL,
  `mor_o_content` varchar(255) DEFAULT NULL,
  `aft_o_content` varchar(255) DEFAULT NULL,
  `aft_t_content` varchar(255) DEFAULT NULL,
  `time1` varchar(8) DEFAULT NULL,
  `time2` varchar(8) DEFAULT NULL,
  `time3` varchar(8) DEFAULT NULL,
  `time4` varchar(8) DEFAULT NULL,
  `time5` varchar(8) DEFAULT NULL,
  `time6` varchar(8) DEFAULT NULL,
  `time7` varchar(8) DEFAULT NULL,
  `time8` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyattendance_conf
-- ----------------------------
INSERT INTO `tp_qyattendance_conf` VALUES ('1', '1', '1398355200', '1398096000', '1', '19500', '0', '1', '43920', '1', '0', null, '你好上班了', '下班了', '工总正', '5', '2', '05', '25', '16', '15', '12', '12');
INSERT INTO `tp_qyattendance_conf` VALUES ('2', '25', '1446307200', '1448812800', '1', '28800', '0', '1', '32520', '1', '1', null, '上班了', '下班了', '', '01', '30', '08', '00', '17', '00', '09', '02');
INSERT INTO `tp_qyattendance_conf` VALUES ('3', '26', '1416412800', '1418140800', '0', '32400', '0', '0', '32400', '1', '0', null, '', '', '', '20', '10', '09', '00', '20', '00', '09', '00');
INSERT INTO `tp_qyattendance_conf` VALUES ('4', '191', '1398873600', '1398873600', '1', '32400', '0', '1', '0', '0', '0', null, '考情生效', '下班了', '', '1', '1', '09', '00', '18', '00', '00', '00');
INSERT INTO `tp_qyattendance_conf` VALUES ('5', '226', '1398873600', '1398873600', '0', '0', '0', '0', '0', '0', '0', null, '', '', '', '1', '1', '00', '00', '00', '00', '00', '00');
INSERT INTO `tp_qyattendance_conf` VALUES ('6', '233', '1422633600', '1427731200', '0', '0', '0', '0', '0', '0', '0', null, '', '', '', '1', '31', '00', '00', '00', '00', '00', '00');
INSERT INTO `tp_qyattendance_conf` VALUES ('7', '230', '1422633600', '1427731200', '0', '0', '0', '0', '0', '0', '0', null, '', '', '', '1', '31', '00', '00', '00', '00', '00', '00');

-- ----------------------------
-- Table structure for `tp_qyattendance_feel`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyattendance_feel`;
CREATE TABLE `tp_qyattendance_feel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(200) DEFAULT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyattendance_feel
-- ----------------------------
INSERT INTO `tp_qyattendance_feel` VALUES ('1', './Tpl/Qyapp/Attendance/images/beiju.gif', '悲剧--人生就像茶几，上面摆满了杯具啊！呜呜呜....', '悲剧');
INSERT INTO `tp_qyattendance_feel` VALUES ('2', './Tpl/Qyapp/Attendance/images/benkui.gif', '我的承受能力已经接近临界点,在这一刻,我的脑袋一片混乱...', '奔溃');
INSERT INTO `tp_qyattendance_feel` VALUES ('3', './Tpl/Qyapp/Attendance/images/jy.jpg', '如同雷轰电掣一般，我呆住了...', '惊讶');
INSERT INTO `tp_qyattendance_feel` VALUES ('4', './Tpl/Qyapp/Attendance/images/wl.jpg', '无聊的人做无聊的事说无聊的话想无聊的人', '无聊');
INSERT INTO `tp_qyattendance_feel` VALUES ('5', './Tpl/Qyapp/Attendance/images/tield.jpg', '累觉不爱', '好累');
INSERT INTO `tp_qyattendance_feel` VALUES ('6', './Tpl/Qyapp/Attendance/images/happy.jpg', '平静的湖面激起了浪花，我的心情也像浪花一样欢腾。', '开心');

-- ----------------------------
-- Table structure for `tp_qyattendance_place`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyattendance_place`;
CREATE TABLE `tp_qyattendance_place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `long` varchar(255) DEFAULT NULL,
  `province` varchar(32) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `area` varchar(64) DEFAULT NULL,
  `longitude` varchar(64) DEFAULT NULL,
  `latitude` varchar(64) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyattendance_place
-- ----------------------------
INSERT INTO `tp_qyattendance_place` VALUES ('3', '50', '', '', '', '114.370245', '30.538436', '1', '你好');
INSERT INTO `tp_qyattendance_place` VALUES ('4', '111', '', '', '', '114.393242', '30.507078', '1', '32');
INSERT INTO `tp_qyattendance_place` VALUES ('5', '30', '内蒙古自治区', '赤峰市', '巴林左旗', '113.333888', '23.107875', '1', '453453453');
INSERT INTO `tp_qyattendance_place` VALUES ('6', '11', '', '', '', '113.307873', '23.121577', '1', '1111');
INSERT INTO `tp_qyattendance_place` VALUES ('7', '50000', '湖北省', '武汉市', '洪山区', '114.408765', '30.510127', '1', '光谷广场');
INSERT INTO `tp_qyattendance_place` VALUES ('9', '100', '广东省', '深圳市', '宝安区', '113.874129', '22.573135', '26', '宝源路财富港国际中心');
INSERT INTO `tp_qyattendance_place` VALUES ('10', '1000000', 'null', 'null', 'null', '113.906459', '22.570582', '191', '宝民一路白金大厦');
INSERT INTO `tp_qyattendance_place` VALUES ('11', '500', '', '', '', '114.408809', '30.510115', '25', '武汉光谷广场尚都');
INSERT INTO `tp_qyattendance_place` VALUES ('12', '1500', '河北省', '石家庄市', '新华区', '114.334888', '30.590429', null, '打发似的');
INSERT INTO `tp_qyattendance_place` VALUES ('18', '300', '', '', '', '113.320654', '23.10196', '229', '客村');
INSERT INTO `tp_qyattendance_place` VALUES ('22', '', '', '', '', '113.32940693', '23.1034241017', null, '客村艺苑路19号');
INSERT INTO `tp_qyattendance_place` VALUES ('23', '1000', '广东省', '广州市', '海珠区', '113.329414', '23.103429', '233', '客村艺苑路19号');
INSERT INTO `tp_qyattendance_place` VALUES ('24', '1000', '广东省', '广州市', '海珠区', '113.329432', '23.10342', '230', '客村艺苑路19号');
INSERT INTO `tp_qyattendance_place` VALUES ('25', '1000', '', '', '', '113.343348', '23.10504', '25', '海珠区艺苑路');
INSERT INTO `tp_qyattendance_place` VALUES ('26', '34534', '天津市', '市辖县', '静海县', '', '', '25', '345345');
INSERT INTO `tp_qyattendance_place` VALUES ('27', '345345', '', '', '', '', '', '25', '郧县');
INSERT INTO `tp_qyattendance_place` VALUES ('28', '4444', '', '', '', '114.409672', '30.510884', '25', '光谷广场');

-- ----------------------------
-- Table structure for `tp_qyattendance_record`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyattendance_record`;
CREATE TABLE `tp_qyattendance_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `creatime` varchar(16) DEFAULT NULL,
  `outtime` varchar(16) DEFAULT NULL,
  `worktime` varchar(16) DEFAULT NULL,
  `creat_re` varchar(100) DEFAULT NULL,
  `creatmind` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date` varchar(32) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `conf_id` int(11) DEFAULT NULL,
  `outmind` int(11) DEFAULT NULL,
  `conf_type` tinyint(1) DEFAULT NULL,
  `dates` varchar(16) DEFAULT '0',
  `out_re` varchar(100) DEFAULT NULL,
  `earlytime` int(11) DEFAULT NULL,
  `latime` int(11) DEFAULT NULL,
  `place_id` int(11) DEFAULT NULL COMMENT '考勤地点',
  `add_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=313 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyattendance_record
-- ----------------------------
INSERT INTO `tp_qyattendance_record` VALUES ('13', 'xtzlyp', '23', '1416303511', '1416305348', '1416305348', null, '0', '1', '20141118', '1', '3', '0', null, '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('14', 'xtzlyp', '23', '1416364130', '1416387414', '1416387414', null, '0', '1', '20141119', '1', '3', '0', '2', '20141119', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('57', 'xtzlyp', '39', '1416473120', null, null, null, '0', '1', '20141120', '25', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('59', 'xtzlyp', '39', '1416648960', '1416648985', '1416648985', null, '0', '1', '20141122', '25', '12', '0', '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('60', 'xtzlyp', '39', '1417330494', '1417344394', '1417344394', null, '0', '1', '20141130', '25', '12', '0', '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('61', 'xiawenhua', null, '1419228072', null, null, null, '0', '1', '20141222', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('62', 'xiawenhua', null, '1419228077', null, null, null, '0', '1', '20141222', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('63', 'xiawenhua', null, '1419228078', null, null, null, '0', '1', '20141222', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('64', 'xiawenhua', null, '1419228079', null, null, null, '0', '1', '20141222', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('65', 'xiawenhua', null, '1419228079', null, null, null, '0', '1', '20141222', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('66', 'xiamumu', null, '1419228377', null, null, null, '0', '1', '20141222', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('67', 'xiawenhua', null, '1419250095', null, null, null, '0', '1', '20141222', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('68', 'xiawenhua', null, '1419259857', null, null, null, '0', '1', '20141222', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('69', 'xiawenhua', null, '1419259857', null, null, null, '0', '1', '20141222', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('70', 'xiawenhua', null, '1419260590', null, null, null, '0', '1', '20141222', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('71', 'xiawenhua', null, '1419300939', null, null, null, '0', '1', '20141223', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('72', 'xiawenhua', null, '1419300939', null, null, null, '0', '1', '20141223', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('73', 'xiawenhua', null, '1419300939', null, null, null, '0', '1', '20141223', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('74', 'xiawenhua', null, '1419300940', null, null, null, '0', '1', '20141223', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('75', 'xiawenhua', null, '1419300940', null, null, null, '0', '1', '20141223', '191', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('76', 'xtzlyp', '39', '1419481276', '1419481473', '1419481473', null, '0', '1', '20141225', '25', '12', '0', '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('85', 'xtzlyp', '39', '1419936467', null, null, 'wewerwerwer', '5', '1', '20141230', '25', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('97', 'xtzlyp', '186', '1420358818', null, null, 'Hgxhgc', '5', '1', '20150104', '25', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('98', 'xtzlyp', '186', '1420455133', null, null, null, '0', '1', '20150105', '25', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('99', 'wangming', '82', '1420455635', null, null, null, '0', '1', '20150105', '25', '12', null, '1', '0', null, null, null, null, null);
INSERT INTO `tp_qyattendance_record` VALUES ('105', 'xtzlyp', '186', '1421219033', '1421220310', '1421220310', null, '0', '1', '20150114', '25', '14', null, '1', '0', null, '3890', '20033', '11', null);
INSERT INTO `tp_qyattendance_record` VALUES ('106', 'ding', '52', '1421309778', '1421309824', '1421309824', '他怕啊哈了家好啦啦了', '0', '1', '20150115', '25', '16', null, '1', '0', null, '6176', '26178', '11', null);
INSERT INTO `tp_qyattendance_record` VALUES ('107', 'xtzlyp', '186', '1421580705', null, null, null, '0', '1', '20150118', '25', '16', null, '1', '0', null, null, '37905', '11', null);
INSERT INTO `tp_qyattendance_record` VALUES ('108', 'xtzlyp', '186', '1421810026', null, null, null, '0', '1', '20150121', '25', '16', null, '1', '0', null, null, '8026', '11', null);
INSERT INTO `tp_qyattendance_record` VALUES ('109', 'xiangshenghong', '187', '1422329196', '1422329247', '1422329247', 'Hard  work', '6', '1', '20150127', '25', '16', '0', '1', '0', '', '23553', '8796', '11', null);
INSERT INTO `tp_qyattendance_record` VALUES ('110', 'xtzlyp', '186', '1422329968', '1422329987', '1422329987', '内部努力', '6', '1', '20150127', '25', '16', '6', '1', '0', '汇报材料', '22813', '9568', '11', null);
INSERT INTO `tp_qyattendance_record` VALUES ('111', 'xtzlyp', '186', '1422946546', null, null, null, '0', '1', '20150203', '25', '16', null, '1', '0', null, null, '21346', '11', null);
INSERT INTO `tp_qyattendance_record` VALUES ('244', 'an', '191', '1425714832', '1425714859', '1425714859', null, '0', '1', '20150307', '25', '16', null, '1', '0', null, '7541', '24832', '19', null);
INSERT INTO `tp_qyattendance_record` VALUES ('264', 'admin', '211', '1425721355', null, null, null, '0', '1', '20150307', '233', '24', null, '1', '0', null, null, '31355', '23', null);
INSERT INTO `tp_qyattendance_record` VALUES ('272', 'zhc', '212', '1425721901', null, null, null, '0', '1', '20150307', '230', '25', null, '1', '0', null, null, '31901', '24', null);
INSERT INTO `tp_qyattendance_record` VALUES ('273', 'zhc', '212', '1425872795', null, null, null, '0', '1', '20150309', '230', '25', null, '1', '0', null, null, '9995', '24', null);
INSERT INTO `tp_qyattendance_record` VALUES ('275', 'admin', '221', '1426149739', '1426149841', '1426149841', '', '0', '1', '20150312', '230', '25', '0', '1', '0', '', '4559', '27739', '24', null);
INSERT INTO `tp_qyattendance_record` VALUES ('276', 'li_jun_6', '222', '1426226244', '1426226356', '1426226356', '', '0', '1', '20150313', '25', '16', null, '1', '0', null, '14444', '17844', '19', null);
INSERT INTO `tp_qyattendance_record` VALUES ('277', '270636852', '210', '1426494722', null, null, null, '0', '1', '20150316', '25', '16', null, '1', '0', null, null, '27122', '19', null);
INSERT INTO `tp_qyattendance_record` VALUES ('279', '77484824865', '227', '1426641893', null, null, 'U', '3', '1', '20150318', '25', '16', null, '1', '0', null, null, '1493', '19', null);
INSERT INTO `tp_qyattendance_record` VALUES ('280', 'admin', '221', '1426669061', null, null, null, '0', '1', '20150318', '230', '25', null, '1', '0', null, null, '28661', '24', null);
INSERT INTO `tp_qyattendance_record` VALUES ('294', 'qiancheng', '188', '1426671533', null, null, null, '0', '1', '20150318', '25', '26', null, '1', '0', null, null, '31133', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('295', 'an', '191', '1426671549', null, null, null, '0', '1', '20150318', '25', '26', null, '1', '0', null, null, '31149', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('296', 'an', '191', '1426734185', '1426751843', '1426751843', '哈哈', '4', '1', '20150319', '25', '26', '2', '1', '0', '555', '7357', '7385', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('297', 'li_jun_6', '222', '1426750994', null, null, null, '0', '1', '20150319', '25', '26', null, '1', '0', null, null, '24194', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('298', '0033', '230', '1426823554', null, null, null, '0', '1', '20150320', '25', '27', null, '1', '0', null, null, '6754', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('299', '0033', '230', '1426925983', '1426926046', '1426926046', '哈哈', '3', '1', '20150321', '25', '27', '2', '1', '0', '哈哈', '2354', '22783', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('300', 'admin', '221', '1427168723', null, null, null, '0', '1', '20150324', '230', '25', null, '1', '0', null, null, '9923', '24', null);
INSERT INTO `tp_qyattendance_record` VALUES ('301', '0033', '230', '1427178455', null, null, null, '0', '1', '20150324', '25', '27', null, '1', '0', null, null, '12455', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('302', '0033', '230', '1427359500', null, null, null, '0', '1', '20150326', '25', '27', null, '1', '0', null, null, '20700', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('303', '0033', '230', '1427443778', null, null, null, '0', '1', '20150327', '25', '27', null, '1', '0', null, null, '18578', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('304', 'li_jun_6', '222', '1427506796', null, null, null, '0', '1', '20150328', '25', '27', null, '1', '0', null, null, '0', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('305', '270636852', '210', '1427525579', null, null, null, '0', '1', '20150328', '25', '27', null, '1', '0', null, null, '13979', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('306', '0033', '230', '1427525616', null, null, '好', '6', '1', '20150328', '25', '27', null, '1', '0', null, null, '14016', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('307', '0033', '230', '1427770775', null, null, null, '0', '1', '20150331', '25', '27', null, '1', '0', null, null, '0', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('308', '270636852', '210', '1428388668', null, null, null, '0', '1', '20150407', '25', '27', null, '1', '0', null, null, '13068', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('309', '123456789', '232', '1428389040', null, null, null, '0', '1', '20150407', '25', '27', null, '1', '0', null, null, '13440', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('310', '0033', '230', '1428389111', null, null, null, '0', '1', '20150407', '25', '27', null, '1', '0', null, null, '13511', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('311', '0033', '230', '1428548182', '1428559878', '1428559878', '坑', '1', '1', '20150409', '25', '27', '0', '1', '0', '', '13722', '0', '25', null);
INSERT INTO `tp_qyattendance_record` VALUES ('312', '791344275', '234', '1428646341', '1428646496', '1428646496', '', '6', '1', '20150410', '25', '27', null, '1', '0', null, '13504', '11541', '25', null);

-- ----------------------------
-- Table structure for `tp_qybook_classify`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qybook_classify`;
CREATE TABLE `tp_qybook_classify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `info` varchar(100) NOT NULL,
  `sorts` int(5) DEFAULT NULL,
  `img` char(255) NOT NULL,
  `url` char(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `pid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qybook_classify
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qybook_login`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qybook_login`;
CREATE TABLE `tp_qybook_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `login_status` tinyint(1) NOT NULL DEFAULT '0',
  `add_time` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qybook_login
-- ----------------------------
INSERT INTO `tp_qybook_login` VALUES ('1', '25', 'mytery___', null, '123', '202cb962ac59075b964b07152d234b70', '1', '1', '1422944627');
INSERT INTO `tp_qybook_login` VALUES ('2', '25', 'mytery___', null, '456', '250cf8b51c773f3f8dc8b4be867a9a02', '1', '1', '1422944840');
INSERT INTO `tp_qybook_login` VALUES ('3', '25', 'mytery___', 'sfM02N1418439970', '321', 'caf1a3dfb505ffed0d024130f58c5cfa', '1', '1', '1422945278');

-- ----------------------------
-- Table structure for `tp_qybook_message`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qybook_message`;
CREATE TABLE `tp_qybook_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `subject` varchar(100) NOT NULL COMMENT '主题',
  `content` varchar(500) NOT NULL COMMENT '留言内容',
  `email` varchar(30) DEFAULT NULL,
  `tel` int(20) DEFAULT NULL,
  `add_time` int(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qybook_message
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qybook_room`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qybook_room`;
CREATE TABLE `tp_qybook_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(5) NOT NULL COMMENT '分类ID',
  `book_name` varchar(100) NOT NULL COMMENT '书名',
  `user_id` int(5) NOT NULL,
  `description` varchar(500) DEFAULT NULL COMMENT '描述',
  `add_time` int(20) NOT NULL,
  `book_No` varchar(50) NOT NULL COMMENT '书本编号',
  `book_press` varchar(100) NOT NULL COMMENT '出版社',
  `book_date` varchar(50) NOT NULL COMMENT '出版日期',
  `writer` varchar(50) NOT NULL COMMENT '作者',
  `number` int(20) NOT NULL COMMENT '数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qybook_room
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qybook_userinfo`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qybook_userinfo`;
CREATE TABLE `tp_qybook_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `add_time` int(30) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL COMMENT '备注',
  `wecha_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qybook_userinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qybook_users`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qybook_users`;
CREATE TABLE `tp_qybook_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wecha_id` varchar(100) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_name` varchar(60) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(5) DEFAULT NULL,
  `book_name` varchar(100) DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `return_time` int(11) DEFAULT NULL,
  `is_return` tinyint(1) DEFAULT '0' COMMENT '是否归还',
  `status` tinyint(1) DEFAULT '0',
  `add_time` int(11) DEFAULT NULL,
  `xu_num` int(11) DEFAULT '0',
  `xu_time` int(11) DEFAULT NULL,
  `tg_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qybook_users
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qycard_conf`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qycard_conf`;
CREATE TABLE `tp_qycard_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `geren` text,
  `shouji` text,
  `gongshi` text,
  `newqita` text,
  `muban` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qycard_conf
-- ----------------------------
INSERT INTO `tp_qycard_conf` VALUES ('25', '25', 'a:2:{s:7:\"default\";a:2:{s:9:\"chinaname\";a:3:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"中文姓名\";s:4:\"icon\";s:10:\"fa fa-user\";}s:11:\"englishname\";a:3:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:9:\"英文名\";s:4:\"icon\";s:10:\"fa fa-user\";}}s:3:\"add\";a:9:{i:0;a:3:{s:6:\"status\";i:0;s:4:\"name\";s:1:\"f\";s:4:\"icon\";s:16:\"fa fa-automobile\";}i:1;a:3:{s:6:\"status\";i:0;s:4:\"name\";s:1:\"f\";s:4:\"icon\";s:10:\"fa fa-bank\";}i:2;a:3:{s:6:\"status\";i:0;s:4:\"name\";s:1:\"f\";s:4:\"icon\";s:13:\"fa fa-behance\";}i:3;a:3:{s:6:\"status\";i:1;s:4:\"name\";s:3:\"f33\";s:4:\"icon\";s:10:\"fa fa-bomb\";}i:4;a:3:{s:6:\"status\";i:1;s:4:\"name\";s:12:\"出生年月\";s:4:\"icon\";s:14:\"fa fa-building\";}i:5;a:3:{s:6:\"status\";i:1;s:4:\"name\";s:6:\"族籍\";s:4:\"icon\";s:11:\"fa fa-child\";}i:6;a:3:{s:6:\"status\";i:1;s:4:\"name\";s:6:\"爱好\";s:4:\"icon\";s:13:\"fa fa-codepen\";}i:7;a:3:{s:6:\"status\";i:0;s:4:\"name\";s:12:\"额外任务\";s:4:\"icon\";s:11:\"fa fa-cubes\";}i:8;a:3:{s:6:\"status\";i:0;s:4:\"name\";s:6:\"测试\";s:4:\"icon\";s:15:\"fa fa-delicious\";}}}', 'a:2:{s:7:\"default\";a:4:{s:6:\"mobile\";a:3:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"手机号码\";s:4:\"icon\";s:10:\"fa fa-user\";}s:9:\"telephone\";a:3:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"工作电话\";s:4:\"icon\";s:10:\"fa fa-user\";}s:4:\"mail\";a:3:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:8:\"QQ邮箱\";s:4:\"icon\";s:10:\"fa fa-user\";}s:6:\"weixin\";a:3:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:9:\"微信号\";s:4:\"icon\";s:10:\"fa fa-user\";}}s:3:\"add\";a:2:{i:0;a:3:{s:6:\"status\";i:1;s:4:\"name\";s:18:\"通讯地址123123\";s:4:\"icon\";s:15:\"fa fa-picture-o\";}i:1;a:3:{s:6:\"status\";i:1;s:4:\"name\";s:6:\"123123\";s:4:\"icon\";s:14:\"fa fa-folder-o\";}}}', 'a:2:{s:7:\"default\";a:2:{s:11:\"companyname\";a:3:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"公司名称\";s:4:\"icon\";s:10:\"fa fa-user\";}s:14:\"companyaddress\";a:3:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"公司地址\";s:4:\"icon\";s:10:\"fa fa-user\";}}s:3:\"add\";a:3:{i:0;a:3:{s:6:\"status\";i:1;s:4:\"name\";s:12:\"公司简介\";s:4:\"icon\";s:10:\"fa fa-taxi\";}i:1;a:3:{s:6:\"status\";i:1;s:4:\"name\";s:12:\"企业文化\";s:4:\"icon\";s:13:\"fa fa-gamepad\";}i:2;a:3:{s:6:\"status\";i:1;s:4:\"name\";s:12:\"企业法人\";s:4:\"icon\";s:18:\"fa fa-phone-square\";}}}', 'a:1:{s:3:\"add\";a:2:{i:0;a:3:{s:6:\"status\";i:1;s:4:\"name\";s:12:\"经营范围\";s:4:\"icon\";s:17:\"fa fa-hacker-news\";}i:1;a:3:{s:6:\"status\";i:1;s:4:\"name\";s:12:\"合作伙伴\";s:4:\"icon\";s:11:\"fa fa-chain\";}}}', '2');
INSERT INTO `tp_qycard_conf` VALUES ('26', '116', 'a:1:{s:7:\"default\";a:2:{s:9:\"chinaname\";a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"中文姓名\";}s:11:\"englishname\";a:1:{s:4:\"name\";s:9:\"英文名\";}}}', 'a:1:{s:7:\"default\";a:4:{s:6:\"mobile\";a:1:{s:4:\"name\";s:12:\"手机号码\";}s:9:\"telephone\";a:1:{s:4:\"name\";s:12:\"工作电话\";}s:4:\"mail\";a:1:{s:4:\"name\";s:8:\"QQ邮箱\";}s:6:\"weixin\";a:1:{s:4:\"name\";s:9:\"微信号\";}}}', 'a:1:{s:7:\"default\";a:2:{s:11:\"companyname\";a:1:{s:4:\"name\";s:12:\"公司名称\";}s:14:\"companyaddress\";a:1:{s:4:\"name\";s:12:\"公司地址\";}}}', 'a:0:{}', '1');
INSERT INTO `tp_qycard_conf` VALUES ('27', '26', 'a:1:{s:7:\"default\";a:2:{s:9:\"chinaname\";a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"中文姓名\";}s:11:\"englishname\";a:1:{s:4:\"name\";s:9:\"英文名\";}}}', 'a:1:{s:7:\"default\";a:4:{s:6:\"mobile\";a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"手机号码\";}s:9:\"telephone\";a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"工作电话\";}s:4:\"mail\";a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:8:\"QQ邮箱\";}s:6:\"weixin\";a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:9:\"微信号\";}}}', 'a:1:{s:7:\"default\";a:2:{s:11:\"companyname\";a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"公司名称\";}s:14:\"companyaddress\";a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"公司地址\";}}}', 'a:0:{}', '1');

-- ----------------------------
-- Table structure for `tp_qycard_file`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qycard_file`;
CREATE TABLE `tp_qycard_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `others` varchar(100) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `otherid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qycard_file
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qycard_tpl`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qycard_tpl`;
CREATE TABLE `tp_qycard_tpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(300) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qycard_tpl
-- ----------------------------
INSERT INTO `tp_qycard_tpl` VALUES ('1', '/Tpl/Qyapp/Card/cardlist/2.png', '模板1');
INSERT INTO `tp_qycard_tpl` VALUES ('2', '/Tpl/Qyapp/Card/cardlist/1.png', '模板2');
INSERT INTO `tp_qycard_tpl` VALUES ('3', '/Tpl/Qyapp/Card/cardlist/3.png', '模板3');
INSERT INTO `tp_qycard_tpl` VALUES ('4', '/Tpl/Qyapp/Card/cardlist/4.png', '模板4');
INSERT INTO `tp_qycard_tpl` VALUES ('5', '/Tpl/Qyapp/Card/cardlist/5.png', '模板5');

-- ----------------------------
-- Table structure for `tp_qychatroom_check`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_check`;
CREATE TABLE `tp_qychatroom_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL COMMENT '用户名称',
  `applytime` int(10) DEFAULT NULL COMMENT '申请时间',
  `user_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL COMMENT '对应聊天室',
  `pic` varchar(255) DEFAULT NULL,
  `wecha_id` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='聊天室用户申请表';

-- ----------------------------
-- Records of tp_qychatroom_check
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qychatroom_conf`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_conf`;
CREATE TABLE `tp_qychatroom_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `audit` text COMMENT '审核人',
  `time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='聊天室审核配置表';

-- ----------------------------
-- Records of tp_qychatroom_conf
-- ----------------------------
INSERT INTO `tp_qychatroom_conf` VALUES ('2', '25', '1', 'a:1:{i:0;s:9:\"270636852\";}', '1426672539');

-- ----------------------------
-- Table structure for `tp_qychatroom_list`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_list`;
CREATE TABLE `tp_qychatroom_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL COMMENT '聊天室名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否可用1可用0不可用',
  `createname` varchar(100) DEFAULT NULL COMMENT '创建人',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `nums` int(11) DEFAULT '0' COMMENT '最大聊天人数',
  `user_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL COMMENT '对应聊天记录表',
  `depart_id` varchar(255) NOT NULL,
  `alldepart` text NOT NULL,
  `info` varchar(255) NOT NULL,
  `wecha_id` varchar(255) NOT NULL,
  `leader` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COMMENT='聊天室表';

-- ----------------------------
-- Records of tp_qychatroom_list
-- ----------------------------
INSERT INTO `tp_qychatroom_list` VALUES ('34', '天天聊天室', '1', 'weiyi', '1427376083', '1', '25', '5', '', '', '天天聊天室', 'ding', '丁进双');
INSERT INTO `tp_qychatroom_list` VALUES ('35', '老板聊天室', '1', 'weiyi', '1427376130', '1', '25', '5', '', '', '老板聊天室', 'lanrain', '陈雨');
INSERT INTO `tp_qychatroom_list` VALUES ('36', '扣扣聊天室', '1', 'weiyi', '1427376175', '1', '25', '5', '', '', '扣扣聊天室', 'ding', '丁进双');
INSERT INTO `tp_qychatroom_list` VALUES ('37', '歪歪聊天室5555', '1', 'weiyi', '1427376193', '1', '25', '5', '', '', '歪歪聊天室', 'lanrain', '陈雨');
INSERT INTO `tp_qychatroom_list` VALUES ('38', '微易科技聊天室555', '1', 'weiyi', '1427436921', '1', '25', '9', '', '', '微易科技聊天室', 'xiangshenghong', '向胜虹');
INSERT INTO `tp_qychatroom_list` VALUES ('40', '22', '1', 'weiyi', '1428999383', '1', '25', '3', '', '', '222', '77484824865', '麦伟良');

-- ----------------------------
-- Table structure for `tp_qychatroom_record_0`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_record_0`;
CREATE TABLE `tp_qychatroom_record_0` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '对应的聊天室id',
  `wecha_id` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '聊天记录内容',
  `time` varchar(16) NOT NULL COMMENT '发表记录时间',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qychatroom_record_0
-- ----------------------------
INSERT INTO `tp_qychatroom_record_0` VALUES ('4', '4', 'ding', '25', '风格让他', '1425098786');
INSERT INTO `tp_qychatroom_record_0` VALUES ('5', '4', 'ding', '25', 'fdsdf', '1425123213');
INSERT INTO `tp_qychatroom_record_0` VALUES ('6', '4', 'ding', '25', '规划法规', '1425123229');
INSERT INTO `tp_qychatroom_record_0` VALUES ('7', '4', 'ding', '25', '金龟换酒', '1425123243');
INSERT INTO `tp_qychatroom_record_0` VALUES ('43', '4', 'ding', '25', '9595959', '1425626824');
INSERT INTO `tp_qychatroom_record_0` VALUES ('44', '4', 'ding', '25', '大富大贵', '1425626896');
INSERT INTO `tp_qychatroom_record_0` VALUES ('45', '4', 'ding', '25', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1425629882');
INSERT INTO `tp_qychatroom_record_0` VALUES ('46', '4', 'ding', '25', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbcccccccccccccccccccccccccccccccccccccccccddddddddddddddddddddddddddddddddddddddddffffffffffffffffffffffffffffffffffffffffff', '1425629933');
INSERT INTO `tp_qychatroom_record_0` VALUES ('47', '4', 'ding', '25', '', '1425631125');
INSERT INTO `tp_qychatroom_record_0` VALUES ('48', '4', 'ding', '25', 'fgfdgdfhdfhf hfdh', '1425631805');
INSERT INTO `tp_qychatroom_record_0` VALUES ('49', '4', 'ding', '25', 'sdfsgasdgsdgdf', '1425632204');
INSERT INTO `tp_qychatroom_record_0` VALUES ('50', '4', 'ding', '25', '星尚大典', '1425725510');
INSERT INTO `tp_qychatroom_record_0` VALUES ('51', '4', 'ding', '25', '大夫敢死队风格', '1425726816');
INSERT INTO `tp_qychatroom_record_0` VALUES ('52', '4', 'ding', '25', '等方式地方', '1425727167');
INSERT INTO `tp_qychatroom_record_0` VALUES ('53', '4', 'ding', '25', '古典风格', '1425727317');
INSERT INTO `tp_qychatroom_record_0` VALUES ('54', '4', 'ding', '25', '黑寡妇', '1425728306');
INSERT INTO `tp_qychatroom_record_0` VALUES ('55', '4', 'ding', '25', '山东分公司', '1425866577');
INSERT INTO `tp_qychatroom_record_0` VALUES ('56', '4', 'ding', '25', '更加符合改革和', '1425866595');
INSERT INTO `tp_qychatroom_record_0` VALUES ('57', '4', 'ding', '25', 'sdfgsdgasdgsdg', '1425951909');
INSERT INTO `tp_qychatroom_record_0` VALUES ('58', '4', 'ding', '25', '11111111111111', '1425951918');
INSERT INTO `tp_qychatroom_record_0` VALUES ('59', '4', 'qiancheng', '25', '嘿嘿嘿', '1426664720');
INSERT INTO `tp_qychatroom_record_0` VALUES ('60', '4', '270636852', '25', '就是公司 v 说', '1426664729');
INSERT INTO `tp_qychatroom_record_0` VALUES ('61', '4', 'an', '25', '哈哈', '1426747486');
INSERT INTO `tp_qychatroom_record_0` VALUES ('62', '4', 'an', '25', '哈哈', '1426747506');
INSERT INTO `tp_qychatroom_record_0` VALUES ('63', '8', 'an', '25', '哈哈', '1426748116');
INSERT INTO `tp_qychatroom_record_0` VALUES ('64', '4', '0033', '25', '哈哈', '1426838236');
INSERT INTO `tp_qychatroom_record_0` VALUES ('65', '5', 'li_jun_6', '25', '李继龙', '1426904106');
INSERT INTO `tp_qychatroom_record_0` VALUES ('66', '5', 'li_jun_6', '25', '', '1426904109');
INSERT INTO `tp_qychatroom_record_0` VALUES ('67', '8', 'li_jun_6', '25', '嗯啦你好', '1426904152');
INSERT INTO `tp_qychatroom_record_0` VALUES ('68', '4', '270636852', '25', '基督教额 vs 金额', '1426904459');
INSERT INTO `tp_qychatroom_record_0` VALUES ('69', '8', '2233', '25', '', '1427091104');
INSERT INTO `tp_qychatroom_record_0` VALUES ('70', '8', 'lanrain', '25', '大概', '1427105732');
INSERT INTO `tp_qychatroom_record_0` VALUES ('71', '5', 'lanrain', '25', '大用的', '1427105780');
INSERT INTO `tp_qychatroom_record_0` VALUES ('72', '5', 'lanrain', '25', '任盈盈', '1427105798');
INSERT INTO `tp_qychatroom_record_0` VALUES ('73', '4', '2233', '25', '', '1427105814');
INSERT INTO `tp_qychatroom_record_0` VALUES ('74', '5', 'lanrain', '25', '砌墙的砖头', '1427105827');
INSERT INTO `tp_qychatroom_record_0` VALUES ('75', '8', 'lanrain', '25', '晨曦大道口', '1427106561');
INSERT INTO `tp_qychatroom_record_0` VALUES ('76', '4', '2233', '25', '春暖花开', '1427169499');
INSERT INTO `tp_qychatroom_record_0` VALUES ('77', '8', '0033', '25', '哈哈', '1427178674');
INSERT INTO `tp_qychatroom_record_0` VALUES ('78', '8', '0033', '25', '你好', '1427178696');
INSERT INTO `tp_qychatroom_record_0` VALUES ('79', '8', '0033', '25', '', '1427178706');
INSERT INTO `tp_qychatroom_record_0` VALUES ('80', '8', '0033', '25', '你好', '1427178711');
INSERT INTO `tp_qychatroom_record_0` VALUES ('81', '4', '0033', '25', '你好', '1427178727');
INSERT INTO `tp_qychatroom_record_0` VALUES ('82', '6', '0033', '25', '哈哈', '1427178766');
INSERT INTO `tp_qychatroom_record_0` VALUES ('83', '5', 'li_jun_6', '25', '具体', '1427255457');
INSERT INTO `tp_qychatroom_record_0` VALUES ('84', '8', '270636852', '25', '实际上就是 v 思考是不是代表', '1427255460');
INSERT INTO `tp_qychatroom_record_0` VALUES ('85', '8', '0033', '25', '哈哈', '1427255481');
INSERT INTO `tp_qychatroom_record_0` VALUES ('86', '5', 'li_jun_6', '25', 'asdfas', '1427263084');
INSERT INTO `tp_qychatroom_record_0` VALUES ('87', '5', 'li_jun_6', '25', '哎哟不错哦', '1427263101');

-- ----------------------------
-- Table structure for `tp_qychatroom_record_1`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_record_1`;
CREATE TABLE `tp_qychatroom_record_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '对应的聊天室id',
  `wecha_id` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '聊天内容',
  `time` varchar(16) NOT NULL COMMENT '发表记录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qychatroom_record_1
-- ----------------------------
INSERT INTO `tp_qychatroom_record_1` VALUES ('1', '3', 'ds', '0', '水电费', '');

-- ----------------------------
-- Table structure for `tp_qychatroom_record_2`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_record_2`;
CREATE TABLE `tp_qychatroom_record_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '对应的聊天室id',
  `wecha_id` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '聊天内容',
  `time` varchar(16) NOT NULL COMMENT '发表记录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qychatroom_record_2
-- ----------------------------
INSERT INTO `tp_qychatroom_record_2` VALUES ('1', '2', '', '0', '公会单个', '');
INSERT INTO `tp_qychatroom_record_2` VALUES ('2', '2', '', '0', '好机会就会', '');

-- ----------------------------
-- Table structure for `tp_qychatroom_record_3`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_record_3`;
CREATE TABLE `tp_qychatroom_record_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '对应的聊天室id',
  `wecha_id` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '聊天内容',
  `time` varchar(16) NOT NULL COMMENT '发表记录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qychatroom_record_3
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qychatroom_record_4`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_record_4`;
CREATE TABLE `tp_qychatroom_record_4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '对应的聊天室id',
  `wecha_id` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '聊天内容',
  `time` varchar(16) NOT NULL COMMENT '发表记录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qychatroom_record_4
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qychatroom_record_5`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_record_5`;
CREATE TABLE `tp_qychatroom_record_5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '对应的聊天室id',
  `wecha_id` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '聊天内容',
  `time` varchar(16) NOT NULL COMMENT '发表记录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=206 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qychatroom_record_5
-- ----------------------------
INSERT INTO `tp_qychatroom_record_5` VALUES ('1', '34', '0033', '25', '进来了', '1427423490');
INSERT INTO `tp_qychatroom_record_5` VALUES ('2', '34', '0033', '25', '', '1427423495');
INSERT INTO `tp_qychatroom_record_5` VALUES ('3', '34', '0033', '25', '进来了', '1427423503');
INSERT INTO `tp_qychatroom_record_5` VALUES ('4', '34', '0033', '25', '高级', '1427425418');
INSERT INTO `tp_qychatroom_record_5` VALUES ('5', '34', '2233', '25', '嗨', '1427425460');
INSERT INTO `tp_qychatroom_record_5` VALUES ('6', '34', 'ding', '25', '随便聊聊', '1427436330');
INSERT INTO `tp_qychatroom_record_5` VALUES ('7', '37', 'lanrain', '25', '日剧', '1427438626');
INSERT INTO `tp_qychatroom_record_5` VALUES ('8', '37', 'lanrain', '25', '奄尖锐', '1427438640');
INSERT INTO `tp_qychatroom_record_5` VALUES ('9', '35', 'lanrain', '25', '也有点', '1427438654');
INSERT INTO `tp_qychatroom_record_5` VALUES ('10', '34', 'ding', '25', '饿好好好', '1427438664');
INSERT INTO `tp_qychatroom_record_5` VALUES ('11', '35', 'lanrain', '25', '点左右', '1427438684');
INSERT INTO `tp_qychatroom_record_5` VALUES ('12', '37', 'lanrain', '25', '子弹飞', '1427438723');
INSERT INTO `tp_qychatroom_record_5` VALUES ('13', '37', 'lanrain', '25', '耶耶', '1427438794');
INSERT INTO `tp_qychatroom_record_5` VALUES ('14', '37', 'lanrain', '25', '瞄瞄', '1427438799');
INSERT INTO `tp_qychatroom_record_5` VALUES ('15', '37', 'lanrain', '25', '是可以', '1427438805');
INSERT INTO `tp_qychatroom_record_5` VALUES ('16', '34', 'ding', '25', '发他有', '1427456663');
INSERT INTO `tp_qychatroom_record_5` VALUES ('17', '34', 'ding', '25', '你回去', '1427456679');
INSERT INTO `tp_qychatroom_record_5` VALUES ('18', '35', 'ding', '25', '打个包', '1427458021');
INSERT INTO `tp_qychatroom_record_5` VALUES ('19', '35', 'ding', '25', 'gdkjh', '1427458096');
INSERT INTO `tp_qychatroom_record_5` VALUES ('20', '35', 'ding', '25', 'gfdfsdf', '1427458105');
INSERT INTO `tp_qychatroom_record_5` VALUES ('21', '35', 'ding', '25', '说说啥吗', '1427458135');
INSERT INTO `tp_qychatroom_record_5` VALUES ('22', '35', 'lanrain', '25', '梵天寺', '1427458417');
INSERT INTO `tp_qychatroom_record_5` VALUES ('23', '35', 'ding', '25', '恶搞把v', '1427458495');
INSERT INTO `tp_qychatroom_record_5` VALUES ('24', '35', 'ding', '25', '不担心v', '1427458528');
INSERT INTO `tp_qychatroom_record_5` VALUES ('25', '35', 'lanrain', '25', '46649', '1427458577');
INSERT INTO `tp_qychatroom_record_5` VALUES ('26', '35', '0033', '25', '好好', '1427511392');
INSERT INTO `tp_qychatroom_record_5` VALUES ('27', '35', '0033', '25', '好好', '1427511402');
INSERT INTO `tp_qychatroom_record_5` VALUES ('28', '35', '0033', '25', '你好', '1427511418');
INSERT INTO `tp_qychatroom_record_5` VALUES ('29', '37', 'li_jun_6', '25', 'hvvvbb讨论一下', '1427511466');
INSERT INTO `tp_qychatroom_record_5` VALUES ('30', '37', 'li_jun_6', '25', '哈哈', '1427512205');
INSERT INTO `tp_qychatroom_record_5` VALUES ('31', '37', 'li_jun_6', '25', '哈哈', '1427512217');
INSERT INTO `tp_qychatroom_record_5` VALUES ('32', '35', '0033', '25', '哈哈', '1427512326');
INSERT INTO `tp_qychatroom_record_5` VALUES ('33', '37', 'li_jun_6', '25', 'loli', '1427512340');
INSERT INTO `tp_qychatroom_record_5` VALUES ('34', '35', '0033', '25', '哈哈', '1427512344');
INSERT INTO `tp_qychatroom_record_5` VALUES ('35', '37', 'li_jun_6', '25', '构图', '1427513142');
INSERT INTO `tp_qychatroom_record_5` VALUES ('36', '35', '0033', '25', '哈哈', '1427513161');
INSERT INTO `tp_qychatroom_record_5` VALUES ('37', '35', '0033', '25', '', '1427514344');
INSERT INTO `tp_qychatroom_record_5` VALUES ('38', '35', '0033', '25', '', '1427514349');
INSERT INTO `tp_qychatroom_record_5` VALUES ('39', '37', 'li_jun_6', '25', '', '1427514383');
INSERT INTO `tp_qychatroom_record_5` VALUES ('40', '37', 'li_jun_6', '25', '楼', '1427514392');
INSERT INTO `tp_qychatroom_record_5` VALUES ('41', '37', 'li_jun_6', '25', '', '1427514395');
INSERT INTO `tp_qychatroom_record_5` VALUES ('42', '37', 'li_jun_6', '25', '歌舞剧', '1427514568');
INSERT INTO `tp_qychatroom_record_5` VALUES ('43', '37', 'li_jun_6', '25', '', '1427514887');
INSERT INTO `tp_qychatroom_record_5` VALUES ('44', '37', 'li_jun_6', '25', '哦吐苦水劲舞团旅途中', '1427523399');
INSERT INTO `tp_qychatroom_record_5` VALUES ('45', '37', 'li_jun_6', '25', 'vz', '1427523404');
INSERT INTO `tp_qychatroom_record_5` VALUES ('46', '37', 'li_jun_6', '25', '构图', '1427523410');
INSERT INTO `tp_qychatroom_record_5` VALUES ('47', '37', 'li_jun_6', '25', '1688天', '1427523416');
INSERT INTO `tp_qychatroom_record_5` VALUES ('48', '37', 'li_jun_6', '25', 'fly我好', '1427523422');
INSERT INTO `tp_qychatroom_record_5` VALUES ('49', '37', 'li_jun_6', '25', '', '1427523510');
INSERT INTO `tp_qychatroom_record_5` VALUES ('50', '37', '270636852', '25', '哈哈', '1427523762');
INSERT INTO `tp_qychatroom_record_5` VALUES ('51', '37', '270636852', '25', '哈哈', '1427523762');
INSERT INTO `tp_qychatroom_record_5` VALUES ('52', '37', '270636852', '25', '哈哈', '1427523763');
INSERT INTO `tp_qychatroom_record_5` VALUES ('53', '37', '270636852', '25', '', '1427523764');
INSERT INTO `tp_qychatroom_record_5` VALUES ('54', '37', '270636852', '25', '即使是不自觉地', '1427525842');
INSERT INTO `tp_qychatroom_record_5` VALUES ('55', '37', '270636852', '25', '即使是不自觉地', '1427525849');
INSERT INTO `tp_qychatroom_record_5` VALUES ('56', '37', '270636852', '25', '即使是不自觉地', '1427525853');
INSERT INTO `tp_qychatroom_record_5` VALUES ('57', '37', '270636852', '25', '即使是不自觉地', '1427525854');
INSERT INTO `tp_qychatroom_record_5` VALUES ('58', '37', 'li_jun_6', '25', '在家里', '1427525862');
INSERT INTO `tp_qychatroom_record_5` VALUES ('59', '35', '0033', '25', '', '1427525894');
INSERT INTO `tp_qychatroom_record_5` VALUES ('60', '37', 'li_jun_6', '25', '', '1427525905');
INSERT INTO `tp_qychatroom_record_5` VALUES ('61', '37', 'li_jun_6', '25', '', '1427525924');
INSERT INTO `tp_qychatroom_record_5` VALUES ('62', '37', 'li_jun_6', '25', '', '1427526355');
INSERT INTO `tp_qychatroom_record_5` VALUES ('63', '37', 'li_jun_6', '25', 'asdf asdfas f', '1427526358');
INSERT INTO `tp_qychatroom_record_5` VALUES ('64', '35', '0033', '25', '米豆', '1427526599');
INSERT INTO `tp_qychatroom_record_5` VALUES ('65', '35', '0033', '25', '', '1427526602');
INSERT INTO `tp_qychatroom_record_5` VALUES ('66', '35', '0033', '25', '', '1427526604');
INSERT INTO `tp_qychatroom_record_5` VALUES ('67', '37', 'li_jun_6', '25', '看具体说', '1427527026');
INSERT INTO `tp_qychatroom_record_5` VALUES ('68', '37', 'li_jun_6', '25', '后台', '1427527034');
INSERT INTO `tp_qychatroom_record_5` VALUES ('69', '37', 'li_jun_6', '25', '哦不行', '1427527042');
INSERT INTO `tp_qychatroom_record_5` VALUES ('70', '34', '270636852', '25', 'uuvu 个很好', '1427528053');
INSERT INTO `tp_qychatroom_record_5` VALUES ('71', '34', '0033', '25', '呵呵', '1427528155');
INSERT INTO `tp_qychatroom_record_5` VALUES ('72', '34', '0033', '25', '', '1427528158');
INSERT INTO `tp_qychatroom_record_5` VALUES ('73', '34', '0033', '25', '呵呵', '1427528163');
INSERT INTO `tp_qychatroom_record_5` VALUES ('74', '34', 'li_jun_6', '25', '抠图', '1427528192');
INSERT INTO `tp_qychatroom_record_5` VALUES ('75', '34', 'li_jun_6', '25', 'lay新坡1', '1427528513');
INSERT INTO `tp_qychatroom_record_5` VALUES ('76', '34', 'li_jun_6', '25', '咯五UPS', '1427528518');
INSERT INTO `tp_qychatroom_record_5` VALUES ('77', '34', 'li_jun_6', '25', 'only五', '1427528523');
INSERT INTO `tp_qychatroom_record_5` VALUES ('78', '35', 'lanrain', '25', '睡眠日', '1427555248');
INSERT INTO `tp_qychatroom_record_5` VALUES ('79', '35', 'lanrain', '25', '你好好', '1427555272');
INSERT INTO `tp_qychatroom_record_5` VALUES ('80', '35', 'lanrain', '25', '开开', '1427555289');
INSERT INTO `tp_qychatroom_record_5` VALUES ('81', '34', '0033', '25', '哦咯X5', '1427702173');
INSERT INTO `tp_qychatroom_record_5` VALUES ('82', '35', '0033', '25', '好听', '1427702199');
INSERT INTO `tp_qychatroom_record_5` VALUES ('83', '34', '0033', '25', '哈佛', '1427702248');
INSERT INTO `tp_qychatroom_record_5` VALUES ('84', '34', '0033', '25', '哈哈', '1427770230');
INSERT INTO `tp_qychatroom_record_5` VALUES ('85', '34', '270636852', '25', '我付出', '1427783737');
INSERT INTO `tp_qychatroom_record_5` VALUES ('86', '34', '0033', '25', '好好', '1427858634');
INSERT INTO `tp_qychatroom_record_5` VALUES ('87', '35', '0033', '25', '回扣', '1427858762');
INSERT INTO `tp_qychatroom_record_5` VALUES ('88', '37', '270636852', '25', '不知是 v 自己是不是大家', '1427859185');
INSERT INTO `tp_qychatroom_record_5` VALUES ('89', '37', '270636852', '25', '', '1427859188');
INSERT INTO `tp_qychatroom_record_5` VALUES ('90', '34', 'li_jun_6', '25', '', '1427869907');
INSERT INTO `tp_qychatroom_record_5` VALUES ('91', '37', 'li_jun_6', '25', 'as', '1427878845');
INSERT INTO `tp_qychatroom_record_5` VALUES ('92', '37', 'li_jun_6', '25', '', '1427878848');
INSERT INTO `tp_qychatroom_record_5` VALUES ('93', '35', '0033', '25', '感觉', '1427960505');
INSERT INTO `tp_qychatroom_record_5` VALUES ('94', '37', 'lanrain', '25', '里面有', '1427960690');
INSERT INTO `tp_qychatroom_record_5` VALUES ('95', '35', 'lanrain', '25', '我看看', '1427960714');
INSERT INTO `tp_qychatroom_record_5` VALUES ('96', '37', '2233', '25', '功能', '1427960942');
INSERT INTO `tp_qychatroom_record_5` VALUES ('97', '35', '0033', '25', '头', '1427961358');
INSERT INTO `tp_qychatroom_record_5` VALUES ('98', '37', '270636852', '25', '闪光灯不得不高帅富', '1427961844');
INSERT INTO `tp_qychatroom_record_5` VALUES ('99', '37', '270636852', '25', '', '1427961847');
INSERT INTO `tp_qychatroom_record_5` VALUES ('100', '34', 'li_jun_6', '25', '', '1427962354');
INSERT INTO `tp_qychatroom_record_5` VALUES ('101', '34', 'li_jun_6', '25', '', '1427962357');
INSERT INTO `tp_qychatroom_record_5` VALUES ('102', '34', 'li_jun_6', '25', '', '1427962361');
INSERT INTO `tp_qychatroom_record_5` VALUES ('103', '37', '270636852', '25', '', '1427962366');
INSERT INTO `tp_qychatroom_record_5` VALUES ('104', '34', 'li_jun_6', '25', '', '1427962432');
INSERT INTO `tp_qychatroom_record_5` VALUES ('105', '34', 'li_jun_6', '25', '', '1427962437');
INSERT INTO `tp_qychatroom_record_5` VALUES ('106', '34', 'li_jun_6', '25', '', '1427962463');
INSERT INTO `tp_qychatroom_record_5` VALUES ('107', '34', 'li_jun_6', '25', '', '1427962465');
INSERT INTO `tp_qychatroom_record_5` VALUES ('108', '34', 'li_jun_6', '25', '', '1427962477');
INSERT INTO `tp_qychatroom_record_5` VALUES ('109', '34', 'li_jun_6', '25', '', '1427962479');
INSERT INTO `tp_qychatroom_record_5` VALUES ('110', '34', 'li_jun_6', '25', '', '1427962495');
INSERT INTO `tp_qychatroom_record_5` VALUES ('111', '34', 'li_jun_6', '25', '', '1427962508');
INSERT INTO `tp_qychatroom_record_5` VALUES ('112', '34', 'li_jun_6', '25', '', '1427962782');
INSERT INTO `tp_qychatroom_record_5` VALUES ('113', '34', 'li_jun_6', '25', '', '1427963369');
INSERT INTO `tp_qychatroom_record_5` VALUES ('114', '34', 'li_jun_6', '25', '', '1427963371');
INSERT INTO `tp_qychatroom_record_5` VALUES ('115', '34', 'li_jun_6', '25', '', '1427963373');
INSERT INTO `tp_qychatroom_record_5` VALUES ('116', '34', 'li_jun_6', '25', '', '1427963377');
INSERT INTO `tp_qychatroom_record_5` VALUES ('117', '37', 'li_jun_6', '25', '', '1427963389');
INSERT INTO `tp_qychatroom_record_5` VALUES ('118', '37', 'li_jun_6', '25', '', '1427963391');
INSERT INTO `tp_qychatroom_record_5` VALUES ('119', '37', 'li_jun_6', '25', '', '1427963392');
INSERT INTO `tp_qychatroom_record_5` VALUES ('120', '37', 'li_jun_6', '25', '', '1427963399');
INSERT INTO `tp_qychatroom_record_5` VALUES ('121', '35', 'lanrain', '25', '日历', '1427965240');
INSERT INTO `tp_qychatroom_record_5` VALUES ('122', '37', 'lanrain', '25', '晨晨呢', '1427965458');
INSERT INTO `tp_qychatroom_record_5` VALUES ('123', '34', 'ding', '25', '都很好', '1427965551');
INSERT INTO `tp_qychatroom_record_5` VALUES ('124', '34', 'ding', '25', '大家好v', '1427965566');
INSERT INTO `tp_qychatroom_record_5` VALUES ('125', '37', '0033', '25', '空间', '1427966088');
INSERT INTO `tp_qychatroom_record_5` VALUES ('126', '37', '0033', '25', 'how', '1427966180');
INSERT INTO `tp_qychatroom_record_5` VALUES ('127', '37', 'li_jun_6', '25', '偶遇', '1427966208');
INSERT INTO `tp_qychatroom_record_5` VALUES ('128', '36', '0033', '25', '空', '1427966214');
INSERT INTO `tp_qychatroom_record_5` VALUES ('129', '36', '0033', '25', '', '1427966216');
INSERT INTO `tp_qychatroom_record_5` VALUES ('130', '34', '0033', '25', '和我', '1427966237');
INSERT INTO `tp_qychatroom_record_5` VALUES ('131', '36', '0033', '25', '噢耶', '1427966453');
INSERT INTO `tp_qychatroom_record_5` VALUES ('132', '36', '0033', '25', '很高兴', '1427966518');
INSERT INTO `tp_qychatroom_record_5` VALUES ('133', '34', 'ding', '25', '撒旦发射', '1427967154');
INSERT INTO `tp_qychatroom_record_5` VALUES ('134', '34', 'ding', '25', '东风公司', '1427967730');
INSERT INTO `tp_qychatroom_record_5` VALUES ('135', '34', 'ding', '25', '电话不', '1427971523');
INSERT INTO `tp_qychatroom_record_5` VALUES ('136', '34', 'ding', '25', '的就就就', '1427971535');
INSERT INTO `tp_qychatroom_record_5` VALUES ('137', '34', 'ding', '25', '好看看你', '1427971549');
INSERT INTO `tp_qychatroom_record_5` VALUES ('138', '35', 'lanrain', '25', '快压', '1427971568');
INSERT INTO `tp_qychatroom_record_5` VALUES ('139', '35', 'lanrain', '25', '快压', '1427971570');
INSERT INTO `tp_qychatroom_record_5` VALUES ('140', '35', 'lanrain', '25', '快压', '1427971573');
INSERT INTO `tp_qychatroom_record_5` VALUES ('141', '35', 'lanrain', '25', '快压', '1427971574');
INSERT INTO `tp_qychatroom_record_5` VALUES ('142', '35', 'lanrain', '25', '快压', '1427971574');
INSERT INTO `tp_qychatroom_record_5` VALUES ('143', '35', 'lanrain', '25', '快压', '1427971576');
INSERT INTO `tp_qychatroom_record_5` VALUES ('144', '35', 'lanrain', '25', '快压', '1427971577');
INSERT INTO `tp_qychatroom_record_5` VALUES ('145', '35', 'lanrain', '25', '号码是', '1427971590');
INSERT INTO `tp_qychatroom_record_5` VALUES ('146', '34', 'ding', '25', '是和好人', '1427971596');
INSERT INTO `tp_qychatroom_record_5` VALUES ('147', '34', 'ding', '25', '复活币', '1427972147');
INSERT INTO `tp_qychatroom_record_5` VALUES ('148', '34', 'ding', '25', '个就你没', '1427972157');
INSERT INTO `tp_qychatroom_record_5` VALUES ('149', '34', 'ding', '25', '的发不你你', '1427972186');
INSERT INTO `tp_qychatroom_record_5` VALUES ('150', '34', 'ding', '25', '个你你不', '1427972289');
INSERT INTO `tp_qychatroom_record_5` VALUES ('151', '34', 'ding', '25', '发好就不', '1427972302');
INSERT INTO `tp_qychatroom_record_5` VALUES ('152', '34', 'ding', '25', '发好就不', '1427972379');
INSERT INTO `tp_qychatroom_record_5` VALUES ('153', '34', 'ding', '25', '的他好你好好看', '1427972388');
INSERT INTO `tp_qychatroom_record_5` VALUES ('154', '34', 'ding', '25', '然后呢', '1427972510');
INSERT INTO `tp_qychatroom_record_5` VALUES ('155', '34', 'ding', '25', '高速度', '1427972585');
INSERT INTO `tp_qychatroom_record_5` VALUES ('156', '34', 'ding', '25', '撒旦法会让人', '1427973296');
INSERT INTO `tp_qychatroom_record_5` VALUES ('157', '34', 'ding', '25', '如汇丰银行费用', '1427973515');
INSERT INTO `tp_qychatroom_record_5` VALUES ('158', '34', 'ding', '25', '人好不不', '1427974058');
INSERT INTO `tp_qychatroom_record_5` VALUES ('159', '34', 'ding', '25', '饿好你你想好就就', '1427974082');
INSERT INTO `tp_qychatroom_record_5` VALUES ('160', '34', 'ding', '25', '如同有人提议让体育局', '1427975321');
INSERT INTO `tp_qychatroom_record_5` VALUES ('161', '34', 'ding', '25', '规范化的飞过海风格', '1427975364');
INSERT INTO `tp_qychatroom_record_5` VALUES ('162', '34', 'ding', '25', '还有点讨厌英语', '1427975370');
INSERT INTO `tp_qychatroom_record_5` VALUES ('163', '34', 'ding', '25', '公司的飞公司的风格的飞', '1427975383');
INSERT INTO `tp_qychatroom_record_5` VALUES ('164', '34', '2233', '25', '聊天', '1428033765');
INSERT INTO `tp_qychatroom_record_5` VALUES ('165', '35', '2233', '25', '话说还有', '1428033818');
INSERT INTO `tp_qychatroom_record_5` VALUES ('166', '34', 'li_jun_6', '25', '哎哟不错哦', '1429081299');
INSERT INTO `tp_qychatroom_record_5` VALUES ('167', '34', 'li_jun_6', '25', '哎哟不错哦', '1429081309');
INSERT INTO `tp_qychatroom_record_5` VALUES ('168', '34', 'li_jun_6', '25', '嗯哼嗯哼', '1429081353');
INSERT INTO `tp_qychatroom_record_5` VALUES ('169', '36', 'li_jun_6', '25', '什么', '1429081382');
INSERT INTO `tp_qychatroom_record_5` VALUES ('170', '36', 'li_jun_6', '25', '哎呀！', '1429081396');
INSERT INTO `tp_qychatroom_record_5` VALUES ('171', '34', 'li_jun_6', '25', '不科学啊', '1429081418');
INSERT INTO `tp_qychatroom_record_5` VALUES ('172', '36', 'li_jun_6', '25', '八成是你', '1429081446');
INSERT INTO `tp_qychatroom_record_5` VALUES ('173', '37', 'li_jun_6', '25', '奇怪你', '1429081463');
INSERT INTO `tp_qychatroom_record_5` VALUES ('174', '37', '0033', '25', '记录里', '1429083684');
INSERT INTO `tp_qychatroom_record_5` VALUES ('175', '37', '0033', '25', '给', '1429083693');
INSERT INTO `tp_qychatroom_record_5` VALUES ('176', '34', 'ding', '25', 'urjrj', '1429173870');
INSERT INTO `tp_qychatroom_record_5` VALUES ('177', '34', 'ding', '25', '好的好人好', '1429173879');
INSERT INTO `tp_qychatroom_record_5` VALUES ('178', '37', 'lanrain', '25', '屝乜场在', '1429174087');
INSERT INTO `tp_qychatroom_record_5` VALUES ('179', '37', 'lanrain', '25', '尴尬成', '1429174095');
INSERT INTO `tp_qychatroom_record_5` VALUES ('180', '35', 'lanrain', '25', '晨晨早⊙▽⊙', '1429174315');
INSERT INTO `tp_qychatroom_record_5` VALUES ('181', '35', 'lanrain', '25', '晨晨晨晨', '1429174365');
INSERT INTO `tp_qychatroom_record_5` VALUES ('182', '35', 'lanrain', '25', '人工', '1429174398');
INSERT INTO `tp_qychatroom_record_5` VALUES ('183', '35', 'lanrain', '25', '晨晨晨晨', '1429174405');
INSERT INTO `tp_qychatroom_record_5` VALUES ('184', '34', 'ding', '25', 'sddfgs', '1429261412');
INSERT INTO `tp_qychatroom_record_5` VALUES ('185', '34', 'ding', '25', 'sdf', '1429261419');
INSERT INTO `tp_qychatroom_record_5` VALUES ('186', '34', 'ding', '25', 'fgfdsdfs', '1429261430');
INSERT INTO `tp_qychatroom_record_5` VALUES ('187', '37', 'lanrain', '25', '恢恢民', '1429261433');
INSERT INTO `tp_qychatroom_record_5` VALUES ('188', '34', 'ding', '25', 'fdgdsfgsdf', '1429261440');
INSERT INTO `tp_qychatroom_record_5` VALUES ('189', '34', 'ding', '25', '电话你', '1429261896');
INSERT INTO `tp_qychatroom_record_5` VALUES ('190', '34', 'ding', '25', '电话你', '1429261909');
INSERT INTO `tp_qychatroom_record_5` VALUES ('191', '34', 'ding', '25', '电话你', '1429261910');
INSERT INTO `tp_qychatroom_record_5` VALUES ('192', '34', 'ding', '25', '电话你', '1429261912');
INSERT INTO `tp_qychatroom_record_5` VALUES ('193', '34', 'ding', '25', '电话你', '1429261912');
INSERT INTO `tp_qychatroom_record_5` VALUES ('194', '34', 'ding', '25', '电话你', '1429261915');
INSERT INTO `tp_qychatroom_record_5` VALUES ('195', '34', 'ding', '25', '电话你', '1429261917');
INSERT INTO `tp_qychatroom_record_5` VALUES ('196', '34', 'ding', '25', '电话你', '1429261917');
INSERT INTO `tp_qychatroom_record_5` VALUES ('197', '34', 'ding', '25', '电话你', '1429261918');
INSERT INTO `tp_qychatroom_record_5` VALUES ('198', '34', 'ding', '25', '电话你', '1429261918');
INSERT INTO `tp_qychatroom_record_5` VALUES ('199', '34', 'ding', '25', '电话你', '1429261918');
INSERT INTO `tp_qychatroom_record_5` VALUES ('200', '34', 'ding', '25', '电话你', '1429261918');
INSERT INTO `tp_qychatroom_record_5` VALUES ('201', '34', 'ding', '25', '电话你', '1429261918');
INSERT INTO `tp_qychatroom_record_5` VALUES ('202', '34', 'ding', '25', '电话你', '1429261918');
INSERT INTO `tp_qychatroom_record_5` VALUES ('203', '34', 'ding', '25', '电话你', '1429261920');
INSERT INTO `tp_qychatroom_record_5` VALUES ('204', '34', 'ding', '25', '电话你', '1429261922');
INSERT INTO `tp_qychatroom_record_5` VALUES ('205', '34', 'ding', '25', '饿个就不', '1429261937');

-- ----------------------------
-- Table structure for `tp_qychatroom_record_6`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_record_6`;
CREATE TABLE `tp_qychatroom_record_6` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '对应的聊天室id',
  `wecha_id` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '聊天内容',
  `time` varchar(16) NOT NULL COMMENT '发表记录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qychatroom_record_6
-- ----------------------------
INSERT INTO `tp_qychatroom_record_6` VALUES ('1', '12', 'ding', '25', '饿好不', '1425959374');
INSERT INTO `tp_qychatroom_record_6` VALUES ('2', '12', 'ding', '25', '是个不不', '1425959393');
INSERT INTO `tp_qychatroom_record_6` VALUES ('3', '12', 'ding', '25', '饿好不', '1425960453');
INSERT INTO `tp_qychatroom_record_6` VALUES ('4', '12', 'ding', '25', '撒旦发射', '1425980817');
INSERT INTO `tp_qychatroom_record_6` VALUES ('5', '12', 'ding', '25', '打发似的', '1425980985');
INSERT INTO `tp_qychatroom_record_6` VALUES ('6', '12', 'ding', '25', '法国地方', '1425980996');
INSERT INTO `tp_qychatroom_record_6` VALUES ('7', '12', 'ding', '25', '热管散热', '1425981419');
INSERT INTO `tp_qychatroom_record_6` VALUES ('8', '12', 'ding', '25', '汇添富亚豪', '1425981431');
INSERT INTO `tp_qychatroom_record_6` VALUES ('9', '12', 'ding', '25', '对方告诉对方', '1425981667');
INSERT INTO `tp_qychatroom_record_6` VALUES ('10', '12', 'ding', '25', '豆腐干地方', '1425981710');
INSERT INTO `tp_qychatroom_record_6` VALUES ('11', '12', '270636852', '25', '', '1426735388');
INSERT INTO `tp_qychatroom_record_6` VALUES ('12', '12', '270636852', '25', '手机电话设备先进', '1426735392');
INSERT INTO `tp_qychatroom_record_6` VALUES ('13', '12', 'lanrain', '25', '晶晶', '1427193643');

-- ----------------------------
-- Table structure for `tp_qychatroom_record_7`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_record_7`;
CREATE TABLE `tp_qychatroom_record_7` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '对应的聊天室id',
  `wecha_id` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '聊天内容',
  `time` varchar(16) NOT NULL COMMENT '发表记录时间',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qychatroom_record_7
-- ----------------------------
INSERT INTO `tp_qychatroom_record_7` VALUES ('1', '16', 'ding', '25', '发好不不不', '1425988585');
INSERT INTO `tp_qychatroom_record_7` VALUES ('2', '16', 'ding', '25', '', '1425988587');
INSERT INTO `tp_qychatroom_record_7` VALUES ('3', '16', 'lanrain', '25', '晶晶玻璃厂', '1425988623');
INSERT INTO `tp_qychatroom_record_7` VALUES ('4', '16', 'lanrain', '25', '日早⊙▽⊙', '1425988633');
INSERT INTO `tp_qychatroom_record_7` VALUES ('5', '16', 'lanrain', '25', '', '1425988639');
INSERT INTO `tp_qychatroom_record_7` VALUES ('6', '16', 'lanrain', '25', '是是非非', '1425988647');
INSERT INTO `tp_qychatroom_record_7` VALUES ('7', '16', 'lanrain', '25', '日里厢日历', '1425988663');
INSERT INTO `tp_qychatroom_record_7` VALUES ('8', '16', 'ding', '25', '饿个好发好好不', '1425988689');
INSERT INTO `tp_qychatroom_record_7` VALUES ('9', '16', 'lanrain', '25', '夏日', '1425988698');
INSERT INTO `tp_qychatroom_record_7` VALUES ('10', '16', 'lanrain', '25', '李晓晶', '1425988708');
INSERT INTO `tp_qychatroom_record_7` VALUES ('11', '16', 'lanrain', '25', '吴晶晶', '1425988740');
INSERT INTO `tp_qychatroom_record_7` VALUES ('12', '16', 'lanrain', '25', '大师兄', '1425988803');
INSERT INTO `tp_qychatroom_record_7` VALUES ('13', '16', 'lanrain', '25', '大家', '1425988815');
INSERT INTO `tp_qychatroom_record_7` VALUES ('14', '16', 'lanrain', '25', '日志', '1425989013');
INSERT INTO `tp_qychatroom_record_7` VALUES ('15', '16', 'lanrain', '25', '是是非非', '1425989018');
INSERT INTO `tp_qychatroom_record_7` VALUES ('16', '16', 'lanrain', '25', '晶晶玻璃厂', '1425989031');
INSERT INTO `tp_qychatroom_record_7` VALUES ('17', '16', 'ding', '25', '等你呢', '1425989040');
INSERT INTO `tp_qychatroom_record_7` VALUES ('18', '16', 'ding', '25', '如果不v', '1425989074');
INSERT INTO `tp_qychatroom_record_7` VALUES ('19', '16', 'ding', '25', '如果不v', '1425989075');
INSERT INTO `tp_qychatroom_record_7` VALUES ('20', '16', 'lanrain', '25', '在桂林', '1425989137');
INSERT INTO `tp_qychatroom_record_7` VALUES ('21', '16', 'lanrain', '25', '哈哈哈哈', '1425989158');
INSERT INTO `tp_qychatroom_record_7` VALUES ('22', '16', 'ding', '25', '', '1425989167');
INSERT INTO `tp_qychatroom_record_7` VALUES ('23', '16', 'lanrain', '25', '', '1425989172');
INSERT INTO `tp_qychatroom_record_7` VALUES ('24', '16', 'ding', '25', '', '1425989174');
INSERT INTO `tp_qychatroom_record_7` VALUES ('25', '16', 'lanrain', '25', '', '1425989178');
INSERT INTO `tp_qychatroom_record_7` VALUES ('26', '16', 'lanrain', '25', '', '1425989204');
INSERT INTO `tp_qychatroom_record_7` VALUES ('27', '15', 'lanrain', '25', '瞄瞄', '1427091092');
INSERT INTO `tp_qychatroom_record_7` VALUES ('28', '15', 'lanrain', '25', '瞄上', '1427091101');
INSERT INTO `tp_qychatroom_record_7` VALUES ('29', '15', 'lanrain', '25', '照相机', '1427091108');
INSERT INTO `tp_qychatroom_record_7` VALUES ('30', '13', 'ding', '25', '亚细亚希腊拉', '1427193971');

-- ----------------------------
-- Table structure for `tp_qychatroom_record_8`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_record_8`;
CREATE TABLE `tp_qychatroom_record_8` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '对应的聊天室id',
  `wecha_id` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '聊天内容',
  `time` varchar(16) NOT NULL COMMENT '发表记录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qychatroom_record_8
-- ----------------------------
INSERT INTO `tp_qychatroom_record_8` VALUES ('1', '30', '0033', '25', '哈哈', '1427356678');
INSERT INTO `tp_qychatroom_record_8` VALUES ('2', '27', '0033', '25', '哈哈', '1427359419');
INSERT INTO `tp_qychatroom_record_8` VALUES ('3', '30', '0033', '25', '哈哈', '1427359463');

-- ----------------------------
-- Table structure for `tp_qychatroom_record_9`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_record_9`;
CREATE TABLE `tp_qychatroom_record_9` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '对应的聊天室id',
  `wecha_id` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL COMMENT '聊天内容',
  `time` varchar(16) NOT NULL COMMENT '发表记录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qychatroom_record_9
-- ----------------------------
INSERT INTO `tp_qychatroom_record_9` VALUES ('1', '38', 'xiangshenghong', '25', '呵呵', '1427452410');
INSERT INTO `tp_qychatroom_record_9` VALUES ('2', '38', '0033', '25', '破例', '1427960602');
INSERT INTO `tp_qychatroom_record_9` VALUES ('3', '38', '0033', '25', '', '1427960605');
INSERT INTO `tp_qychatroom_record_9` VALUES ('4', '38', '0033', '25', '监狱里', '1427966100');
INSERT INTO `tp_qychatroom_record_9` VALUES ('5', '38', '0033', '25', '和天空', '1427966122');
INSERT INTO `tp_qychatroom_record_9` VALUES ('6', '38', '0033', '25', 'lol', '1427966136');
INSERT INTO `tp_qychatroom_record_9` VALUES ('7', '38', '0033', '25', '后来', '1427966149');
INSERT INTO `tp_qychatroom_record_9` VALUES ('8', '38', '0033', '25', '咯弄', '1427966164');
INSERT INTO `tp_qychatroom_record_9` VALUES ('9', '38', '0033', '25', '噘着嘴', '1427966249');
INSERT INTO `tp_qychatroom_record_9` VALUES ('10', '38', '0033', '25', '故意', '1427966260');
INSERT INTO `tp_qychatroom_record_9` VALUES ('11', '38', '0033', '25', '还以为', '1427966328');
INSERT INTO `tp_qychatroom_record_9` VALUES ('12', '38', '0033', '25', '关注一下', '1427966530');

-- ----------------------------
-- Table structure for `tp_qychatroom_userlist`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qychatroom_userlist`;
CREATE TABLE `tp_qychatroom_userlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL COMMENT '用户名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1已通过2审核中3未通过4已拒绝5待确认',
  `jiontime` int(10) DEFAULT NULL COMMENT '创建时间',
  `user_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL COMMENT '对应聊天室',
  `depart_id` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `wecha_id` varchar(255) NOT NULL,
  `isleader` tinyint(1) DEFAULT '0' COMMENT '1是群主0不是群主',
  `uid` int(10) NOT NULL COMMENT '成员的唯一标识',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 COMMENT='聊天室用户表';

-- ----------------------------
-- Records of tp_qychatroom_userlist
-- ----------------------------
INSERT INTO `tp_qychatroom_userlist` VALUES ('41', '丁进双', '1', '1427376083', '25', '34', null, 'http://qy.workweixin.com/', 'ding', '1', '52');
INSERT INTO `tp_qychatroom_userlist` VALUES ('42', '陈雨', '1', '1427376130', '25', '35', null, 'http://dexingky.wxopen.cn/icon/6bB9893U1416471209.jpg', 'lanrain', '1', '29');
INSERT INTO `tp_qychatroom_userlist` VALUES ('43', '丁进双', '1', '1427376175', '25', '36', null, 'http://qy.workweixin.com/', 'ding', '1', '52');
INSERT INTO `tp_qychatroom_userlist` VALUES ('44', '陈雨', '1', '1427376193', '25', '37', null, 'http://dexingky.wxopen.cn/icon/6bB9893U1416471209.jpg', 'lanrain', '1', '29');
INSERT INTO `tp_qychatroom_userlist` VALUES ('66', '向胜虹', '5', '1427431777', '25', '34', null, 'http://qy.workweixin.com/', 'xiangshenghong', '0', '187');
INSERT INTO `tp_qychatroom_userlist` VALUES ('67', '向胜虹', '1', '1427436921', '25', '38', null, 'http://qy.workweixin.com/', 'xiangshenghong', '1', '187');
INSERT INTO `tp_qychatroom_userlist` VALUES ('75', '陈雨', '2', '1427449673', '25', '34', null, 'http://dexingky.wxopen.cn/icon/6bB9893U1416471209.jpg', 'lanrain', '0', '29');
INSERT INTO `tp_qychatroom_userlist` VALUES ('84', '向胜虹', '5', '1427453194', '25', '36', null, 'http://qy.workweixin.com/', 'xiangshenghong', '0', '187');
INSERT INTO `tp_qychatroom_userlist` VALUES ('85', '安丽霞', '5', '1427453194', '25', '36', null, 'http://qy.workweixin.com/icon/wDkjNR3c1426762242.jpg', '2233', '0', '229');
INSERT INTO `tp_qychatroom_userlist` VALUES ('98', '丁进双', '1', '1427458301', '25', '35', null, 'http://qy.workweixin.com/', 'ding', '0', '52');
INSERT INTO `tp_qychatroom_userlist` VALUES ('99', '李俊', '1', '1427506744', '25', '34', null, 'http://qy.workweixin.com/', 'li_jun_6', '0', '222');
INSERT INTO `tp_qychatroom_userlist` VALUES ('100', '安秀英', '1', '1427510526', '25', '34', null, 'http://qy.workweixin.com/icon/O2DLC97W1426762951.jpg', '0033', '0', '230');
INSERT INTO `tp_qychatroom_userlist` VALUES ('101', '安秀英', '1', '1427510536', '25', '35', null, 'http://qy.workweixin.com/icon/O2DLC97W1426762951.jpg', '0033', '0', '230');
INSERT INTO `tp_qychatroom_userlist` VALUES ('102', '李俊', '1', '1427511146', '25', '37', null, 'http://qy.workweixin.com/', 'li_jun_6', '0', '222');
INSERT INTO `tp_qychatroom_userlist` VALUES ('103', '李俊', '2', '1427511292', '25', '38', null, 'http://qy.workweixin.com/', 'li_jun_6', '0', '222');
INSERT INTO `tp_qychatroom_userlist` VALUES ('104', '李俊', '2', '1427511299', '25', '35', null, 'http://qy.workweixin.com/', 'li_jun_6', '0', '222');
INSERT INTO `tp_qychatroom_userlist` VALUES ('106', '黎先生', '1', '1427523498', '25', '37', null, 'http://qy.workweixin.com/icon/5MjTj0M31423465563.jpg', '270636852', '0', '210');
INSERT INTO `tp_qychatroom_userlist` VALUES ('107', '安秀英', '1', '1427702159', '25', '36', null, 'http://qy.workweixin.com/icon/O2DLC97W1426762951.jpg', '0033', '0', '230');
INSERT INTO `tp_qychatroom_userlist` VALUES ('108', '荣成', '5', '1427858664', '25', '34', null, 'http://qy.workweixin.com/icon/a3hAFUgM1426833916.jpg', 'rongcheng', '0', '231');
INSERT INTO `tp_qychatroom_userlist` VALUES ('109', '李俊', '1', '1427869934', '25', '36', null, 'http://qy.workweixin.com/', 'li_jun_6', '0', '222');
INSERT INTO `tp_qychatroom_userlist` VALUES ('110', '安秀英', '1', '1427875056', '25', '38', null, 'http://qy.workweixin.com/icon/O2DLC97W1426762951.jpg', '0033', '0', '230');
INSERT INTO `tp_qychatroom_userlist` VALUES ('111', '安秀英', '1', '1427875060', '25', '37', null, 'http://qy.workweixin.com/icon/O2DLC97W1426762951.jpg', '0033', '0', '230');
INSERT INTO `tp_qychatroom_userlist` VALUES ('112', '朱海澄', '2', '1427941933', '25', '38', null, 'http://qy.workweixin.com/', 'qiancheng', '0', '188');
INSERT INTO `tp_qychatroom_userlist` VALUES ('113', '朱海澄', '1', '1427941965', '25', '34', null, 'http://qy.workweixin.com/', 'qiancheng', '0', '188');
INSERT INTO `tp_qychatroom_userlist` VALUES ('114', '安丽霞', '1', '1427957297', '25', '34', null, 'http://qy.workweixin.com/icon/wDkjNR3c1426762242.jpg', '2233', '0', '229');
INSERT INTO `tp_qychatroom_userlist` VALUES ('115', '安丽霞', '2', '1427957446', '25', '38', null, 'http://qy.workweixin.com/icon/wDkjNR3c1426762242.jpg', '2233', '0', '229');
INSERT INTO `tp_qychatroom_userlist` VALUES ('116', '安丽霞', '1', '1427960871', '25', '35', null, 'http://qy.workweixin.com/icon/wDkjNR3c1426762242.jpg', '2233', '0', '229');
INSERT INTO `tp_qychatroom_userlist` VALUES ('117', '安丽霞', '1', '1427960880', '25', '37', null, 'http://qy.workweixin.com/icon/wDkjNR3c1426762242.jpg', '2233', '0', '229');
INSERT INTO `tp_qychatroom_userlist` VALUES ('118', '汤科珍', '5', '1427962006', '25', '37', null, 'http://dexingky.wxopen.cn/icon/Szm3XwzB1416569353.jpg', 'tang', '0', '54');
INSERT INTO `tp_qychatroom_userlist` VALUES ('119', 'xtzlyp', '5', '1427962006', '25', '37', null, 'http://qy.workweixin.com/icon/IsOaHvyN1420344758.jpg', 'xtzlyp', '0', '186');
INSERT INTO `tp_qychatroom_userlist` VALUES ('120', '黎先生', '2', '1427966305', '25', '38', null, 'http://qy.workweixin.com/icon/5MjTj0M31423465563.jpg', '270636852', '0', '210');
INSERT INTO `tp_qychatroom_userlist` VALUES ('121', '黎先生', '2', '1427966313', '25', '36', null, 'http://qy.workweixin.com/icon/5MjTj0M31423465563.jpg', '270636852', '0', '210');
INSERT INTO `tp_qychatroom_userlist` VALUES ('122', '黄强', '1', '1428945009', '25', '39', null, 'http://dexingky.wxopen.cn/icon/HN5tKJqb1416471212.jpg', 'blue', '1', '30');
INSERT INTO `tp_qychatroom_userlist` VALUES ('123', '麦伟良', '1', '1428999383', '25', '40', null, 'http://qy.workweixin.com/icon/0bY8nLcE1426557727.jpg', '77484824865', '1', '227');
INSERT INTO `tp_qychatroom_userlist` VALUES ('124', '黄强', '5', '1429174613', '25', '35', null, 'http://dexingky.wxopen.cn/icon/HN5tKJqb1416471212.jpg', 'blue', '0', '30');
INSERT INTO `tp_qychatroom_userlist` VALUES ('125', '汤科珍', '5', '1429174613', '25', '35', null, 'http://dexingky.wxopen.cn/icon/Szm3XwzB1416569353.jpg', 'tang', '0', '54');
INSERT INTO `tp_qychatroom_userlist` VALUES ('126', 'wangming', '5', '1429174613', '25', '35', null, 'http://qy.wxopen.cn/icon/hwfrPGQw1417327988.jpg', 'wangming', '0', '82');
INSERT INTO `tp_qychatroom_userlist` VALUES ('127', '吴', '5', '1429174613', '25', '35', null, 'http://qy.workweixin.com/', 'sdt', '0', '111');
INSERT INTO `tp_qychatroom_userlist` VALUES ('128', 'xtzlyp', '5', '1429174613', '25', '35', null, 'http://qy.workweixin.com/icon/IsOaHvyN1420344758.jpg', 'xtzlyp', '0', '186');
INSERT INTO `tp_qychatroom_userlist` VALUES ('129', '黄强', '5', '1429174615', '25', '34', null, 'http://dexingky.wxopen.cn/icon/HN5tKJqb1416471212.jpg', 'blue', '0', '30');
INSERT INTO `tp_qychatroom_userlist` VALUES ('130', 'wangming', '5', '1429174615', '25', '34', null, 'http://qy.wxopen.cn/icon/hwfrPGQw1417327988.jpg', 'wangming', '0', '82');
INSERT INTO `tp_qychatroom_userlist` VALUES ('131', '陈雨', '2', '1429176579', '25', '40', null, 'http://dexingky.wxopen.cn/icon/6bB9893U1416471209.jpg', 'lanrain', '0', '29');
INSERT INTO `tp_qychatroom_userlist` VALUES ('132', '陈雨', '2', '1429176580', '25', '38', null, 'http://dexingky.wxopen.cn/icon/6bB9893U1416471209.jpg', 'lanrain', '0', '29');
INSERT INTO `tp_qychatroom_userlist` VALUES ('133', '陈雨', '2', '1429177132', '25', '36', null, 'http://dexingky.wxopen.cn/icon/6bB9893U1416471209.jpg', 'lanrain', '0', '29');
INSERT INTO `tp_qychatroom_userlist` VALUES ('134', '安秀英', '2', '1429513526', '25', '40', null, 'http://qy.workweixin.com/icon/O2DLC97W1426762951.jpg', '0033', '0', '230');

-- ----------------------------
-- Table structure for `tp_qyclassify`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyclassify`;
CREATE TABLE `tp_qyclassify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `info` varchar(90) NOT NULL COMMENT '分类描述',
  `sorts` int(6) NOT NULL COMMENT '显示顺序',
  `img` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `status` varchar(1) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `yanse` varchar(200) NOT NULL,
  `pid` varchar(200) NOT NULL,
  `tpl_list` varchar(20) NOT NULL,
  `tpl_content` varchar(20) NOT NULL,
  `tpltype` varchar(16) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyclassify
-- ----------------------------
INSERT INTO `tp_qyclassify` VALUES ('1', 'AAA', 'aaa', '1', 'http://qy.wxopen.cn/TempFile/admin/image/20141217174842680.jpg', '', '1', '', '', '0', 'tpl1', 'content001', 'Index', '25');
INSERT INTO `tp_qyclassify` VALUES ('2', 'bbb', 'bbb', '1', 'http://qy.wxopen.cn/TempFile/admin/image/20141217183255989.jpg', '', '1', '', '', '0', 'list001', 'content001', 'list', '25');
INSERT INTO `tp_qyclassify` VALUES ('3', 'ccc', 'ccc', '12', 'http://qy.wxopen.cn/TempFile/admin/image/20141217191212397.jpg', '', '1', '', '', '0', 'tpl1', 'content001', 'Index', '25');
INSERT INTO `tp_qyclassify` VALUES ('4', 'ddd', 'ddd', '2', 'http://qy.wxopen.cn/TempFile/admin/image/20141217193159633.jpg', '', '1', '', '', '1', 'tpl1', 'content002', 'Index', '25');
INSERT INTO `tp_qyclassify` VALUES ('5', 'eee', 'eee', '16', 'http://qy.wxopen.cn/TempFile/admin/image/20141217194615373.jpg', '', '0', '', '', '1', 'list001', 'content003', 'Index', '25');
INSERT INTO `tp_qyclassify` VALUES ('6', 'fff', 'fff', '11', 'http://qy.wxopen.cn/TempFile/admin/image/20141217194716260.jpg', '', '0', '', '', '4', 'list001', 'content001', 'Index', '25');
INSERT INTO `tp_qyclassify` VALUES ('7', 'ggg', 'ggg', '15', 'http://qy.wxopen.cn/TempFile/admin/image/20141217194716260.jpg', '', '1', 'ggg', 'ggg', '3', 'list002', 'content002', 'list', '25');
INSERT INTO `tp_qyclassify` VALUES ('8', 'hhh', 'hhh', '17', 'http://qy.wxopen.cn/TempFile/admin/image/20141217193159633.jpg', '', '1', 'hhh', 'hhh', '3', 'list001', 'content003', 'list', '25');
INSERT INTO `tp_qyclassify` VALUES ('10', 'ceshi', 'ceshiceshi', '11', 'http://qy.wxopen.cn/TempFile/admin/image/20141220122757793.jpg', '', '1', '', '', '0', 'list001', 'content003', 'list', '25');
INSERT INTO `tp_qyclassify` VALUES ('11', 'aaa', 'aaa', '11', 'http://qy.wxopen.cn/TempFile/admin/image/20141220123300280.jpg', '', '1', '', '', '0', 'list002', 'content002', 'list', '25');
INSERT INTO `tp_qyclassify` VALUES ('12', 'aaa', 'aaa', '11', 'http://qy.wxopen.cn/TempFile/admin/image/20141220124310154.jpg', '', '1', '', '', '0', 'list003', 'content005', 'list', '25');
INSERT INTO `tp_qyclassify` VALUES ('13', 'cecece', 'cecece', '14', 'http://qy.wxopen.cn/TempFile/admin/image/20141220124352178.jpg', '', '1', '', '', '0', 'list004', 'content001', 'list', '25');
INSERT INTO `tp_qyclassify` VALUES ('14', '模板测试', '模板测试模板测试模板测试模板测试模板测试', '111', 'http://qy.wxopen.cn/TempFile/admin/image/20141220134606489.jpg', '', '1', '', '', '0', 'list005', 'content002', 'list', '25');
INSERT INTO `tp_qyclassify` VALUES ('15', '测试1', '测试1测试1', '22', 'http://qy.wxopen.cn/TempFile/admin/image/20141220163449583.jpg', '', '1', '', '', '0', 'list003', 'content004', 'list', '25');
INSERT INTO `tp_qyclassify` VALUES ('16', '', '', '0', '', '', '1', '', '', '0', '', '1', 'Index', '25');

-- ----------------------------
-- Table structure for `tp_qycompany`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qycompany`;
CREATE TABLE `tp_qycompany` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `headpic` varchar(300) DEFAULT NULL,
  `banner` varchar(300) DEFAULT NULL,
  `territory` varchar(100) DEFAULT NULL COMMENT '领域',
  `size` varchar(64) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `desc` varchar(400) DEFAULT NULL,
  `area` varchar(64) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qycompany
-- ----------------------------
INSERT INTO `tp_qycompany` VALUES ('1', '25', 'http://qy.wxopen.cn/TempFile/admin/image/20141218162837348.jpg', null, '互联网/电子商务', '10000人以上', '撒范德萨的公司热吻哇', '而特人温温热', '台湾省 台北市 中正区', '微易');
INSERT INTO `tp_qycompany` VALUES ('2', '25', '', null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `tp_qycontent`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qycontent`;
CREATE TABLE `tp_qycontent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `uid` int(11) NOT NULL,
  `uname` varchar(90) NOT NULL,
  `text` text NOT NULL COMMENT '简介',
  `classid` int(11) NOT NULL,
  `classname` varchar(60) NOT NULL,
  `pic` char(255) NOT NULL COMMENT '封面图片',
  `showpic` varchar(1) NOT NULL COMMENT '图片是否显示封面',
  `info` text NOT NULL COMMENT '图文详细内容',
  `url` char(255) NOT NULL COMMENT '图文外链地址',
  `createtime` varchar(13) NOT NULL,
  `uptatetime` varchar(13) NOT NULL,
  `click` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `sorts` int(11) DEFAULT NULL,
  `ftype` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classid` (`classid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='图文表';

-- ----------------------------
-- Records of tp_qycontent
-- ----------------------------
INSERT INTO `tp_qycontent` VALUES ('5', '25', '25', 'weiyi', 'ffff', '8', 'ddd', 'http://qy.wxopen.cn/TempFile/admin/image/20141218190550626.jpg', '1', 'fff', '', '', '1418900756', '0', 'fff', null, null);
INSERT INTO `tp_qycontent` VALUES ('4', '25', '25', 'weiyi', 'eee', '8', 'eee', 'http://qy.wxopen.cn/TempFile/admin/image/20141218190508770.jpg', '0', 'eee', '', '', '1418900717', '0', 'eee', null, null);
INSERT INTO `tp_qycontent` VALUES ('3', '25', '25', 'weiyi', 'ccc', '10', 'ccc', 'http://qy.wxopen.cn/TempFile/admin/image/20141218190048498.jpg', '1', 'ccc', '', '', '1418900453', '0', 'ccc', null, null);
INSERT INTO `tp_qycontent` VALUES ('6', '138', '138', 'dianzan', '3鹅鹅鹅鹅鹅鹅饿', '9', '测试', 'http://qy.wxopen.cn/TempFile/admin/image/20141219173234540.jpg', '1', '的淡淡的淡淡的', '', '', '1418981558', '0', '233333', null, null);
INSERT INTO `tp_qycontent` VALUES ('7', '25', '25', 'weiyi', '豆腐干地方地方', '15', '测试1', 'http://qy.wxopen.cn/TempFile/admin/image/20141220190426573.jpg', '1', '金海金海狂欢节反对感豆腐干豆腐干购房应该会回家共和国呵呵规范化机构合计搞活搞活法规和韩国搞活搞活法规', '', '', '1419073489', '0', '发歌风格风格对方的方法', null, null);
INSERT INTO `tp_qycontent` VALUES ('8', '25', '25', 'weiyi', '三大分撒地方回复', '13', 'cecece', 'http://qy.wxopen.cn/TempFile/admin/image/20141220190556844.jpg', '1', '人如果广告费kg会更好丰东股份', '', '', '1419073564', '0', '跌幅高达股份', null, null);
INSERT INTO `tp_qycontent` VALUES ('9', '25', '25', 'weiyi', '股份刚刚换个环境回家合法规', '14', '模板测试', 'http://qy.wxopen.cn/TempFile/admin/image/20141220190631534.jpg', '1', '分豆腐干风格会更好加快加快回家好好计划就看见刻录机快乐看看了空间', '', '', '1419073599', '0', '刚刚换个环境和', null, null);
INSERT INTO `tp_qycontent` VALUES ('10', '25', '25', 'weiyi', '股份个很歌歌哈凤凰阁', '12', 'aaa', 'http://qy.wxopen.cn/TempFile/admin/image/20141220190702528.jpg', '1', '个发给换个环境回家加快回家客户均可将会更好感觉', '', '', '1419073628', '0', '他让他引入同样让他', null, null);
INSERT INTO `tp_qycontent` VALUES ('11', '25', '25', 'weiyi', '方法共和国换个环境棵', '10', 'ceshi', 'http://qy.wxopen.cn/TempFile/admin/image/20141220190730683.jpg', '1', '话甘快就快离开好艰苦好看看了空间看看', '', '', '1419073661', '0', '一会就看看空间', null, null);
INSERT INTO `tp_qycontent` VALUES ('12', '25', '25', 'weiyi', '发给分风格歌歌会发放购房的', '2', 'bbb', 'http://qy.wxopen.cn/TempFile/admin/image/20141220191345243.jpg', '1', '共和国个环境回家环境棵共和国看看个发给分发给和法国恢复感', '', '', '1419074033', '0', '个环境回家会更好风格', null, null);

-- ----------------------------
-- Table structure for `tp_qycontextual_performance`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qycontextual_performance`;
CREATE TABLE `tp_qycontextual_performance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL COMMENT '员工id',
  `leader` int(11) DEFAULT NULL COMMENT '领导id',
  `contextual_id` int(11) DEFAULT NULL COMMENT '关联的员工id',
  `createtime` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qycontextual_performance
-- ----------------------------
INSERT INTO `tp_qycontextual_performance` VALUES ('19', '189', null, '193', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('18', '189', null, '191', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('17', '189', null, '189', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('16', '189', null, '188', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('15', '188', null, '190', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('14', '188', null, '189', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('13', '188', null, '188', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('20', '227', '0', '188', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('21', '227', '191', '189', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('22', '227', '191', '190', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('23', '227', '191', '191', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('24', '29', '29', '29', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('25', '29', '29', '30', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('26', '29', '29', '52', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('27', '29', '29', '54', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('28', '188', '186', '29', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('29', '188', '186', '30', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('30', '188', '186', '52', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('31', '188', '186', '54', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('32', '230', '29', '29', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('33', '230', '29', '30', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('34', '230', '29', '52', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('35', '230', '29', '54', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('36', '230', '29', '82', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('37', '230', '29', '111', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('38', '230', '29', '186', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('39', '230', '29', '187', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('40', '227', '29', '29', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('41', '227', '29', '52', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('42', '227', '29', '54', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('43', '227', '29', '192', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('44', '227', '29', '210', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('45', '227', '29', '222', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('46', '227', '29', '229', null);
INSERT INTO `tp_qycontextual_performance` VALUES ('47', '227', '29', '235', null);

-- ----------------------------
-- Table structure for `tp_qycopy`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qycopy`;
CREATE TABLE `tp_qycopy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `logid` int(11) DEFAULT NULL COMMENT '日志表id',
  `comment` text COMMENT '评论',
  `userid` int(11) DEFAULT NULL COMMENT '员工id',
  `create_time` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=398 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qycopy
-- ----------------------------
INSERT INTO `tp_qycopy` VALUES ('353', '101', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('352', '101', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('351', '100', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('350', '100', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('349', '100', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('348', '99', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('347', '99', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('346', '99', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('345', '99', null, '29', '20150420');
INSERT INTO `tp_qycopy` VALUES ('344', '98', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('343', '98', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('342', '98', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('341', '97', null, '227', '20150420');
INSERT INTO `tp_qycopy` VALUES ('340', '97', null, '222', '20150420');
INSERT INTO `tp_qycopy` VALUES ('339', '97', null, '210', '20150420');
INSERT INTO `tp_qycopy` VALUES ('338', '97', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('337', '97', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('336', '97', null, '30', '20150420');
INSERT INTO `tp_qycopy` VALUES ('335', '97', null, '29', '20150420');
INSERT INTO `tp_qycopy` VALUES ('334', '96', null, '210', '20150420');
INSERT INTO `tp_qycopy` VALUES ('333', '96', null, '222', '20150420');
INSERT INTO `tp_qycopy` VALUES ('332', '96', null, '227', '20150420');
INSERT INTO `tp_qycopy` VALUES ('331', '96', null, '186', '20150420');
INSERT INTO `tp_qycopy` VALUES ('330', '96', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('329', '96', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('328', '96', null, '30', '20150420');
INSERT INTO `tp_qycopy` VALUES ('327', '96', null, '29', '20150420');
INSERT INTO `tp_qycopy` VALUES ('326', '95', null, '210', '20150420');
INSERT INTO `tp_qycopy` VALUES ('325', '95', null, '222', '20150420');
INSERT INTO `tp_qycopy` VALUES ('324', '95', null, '227', '20150420');
INSERT INTO `tp_qycopy` VALUES ('323', '95', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('322', '95', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('321', '95', null, '30', '20150420');
INSERT INTO `tp_qycopy` VALUES ('320', '95', null, '29', '20150420');
INSERT INTO `tp_qycopy` VALUES ('319', '94', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('318', '94', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('317', '93', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('316', '93', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('315', '93', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('314', '92', null, '227', '20150420');
INSERT INTO `tp_qycopy` VALUES ('313', '92', null, '222', '20150420');
INSERT INTO `tp_qycopy` VALUES ('312', '92', null, '210', '20150420');
INSERT INTO `tp_qycopy` VALUES ('311', '92', null, '29', '20150420');
INSERT INTO `tp_qycopy` VALUES ('310', '92', null, '30', '20150420');
INSERT INTO `tp_qycopy` VALUES ('309', '91', null, '210', '20150420');
INSERT INTO `tp_qycopy` VALUES ('308', '91', null, '222', '20150420');
INSERT INTO `tp_qycopy` VALUES ('307', '91', null, '230', '20150420');
INSERT INTO `tp_qycopy` VALUES ('306', '90', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('305', '90', null, '222', '20150420');
INSERT INTO `tp_qycopy` VALUES ('304', '90', null, '210', '20150420');
INSERT INTO `tp_qycopy` VALUES ('303', '90', null, '192', '20150420');
INSERT INTO `tp_qycopy` VALUES ('302', '90', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('301', '90', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('300', '89', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('299', '89', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('298', '89', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('297', '88', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('296', '88', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('295', '88', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('294', '87', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('293', '87', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('292', '86', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('291', '86', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('290', '86', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('289', '85', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('288', '85', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('287', '85', null, '30', '20150420');
INSERT INTO `tp_qycopy` VALUES ('286', '85', null, '29', '20150420');
INSERT INTO `tp_qycopy` VALUES ('285', '84', null, '222', '20150420');
INSERT INTO `tp_qycopy` VALUES ('284', '84', null, '210', '20150420');
INSERT INTO `tp_qycopy` VALUES ('283', '84', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('282', '84', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('281', '84', null, '187', '20150420');
INSERT INTO `tp_qycopy` VALUES ('280', '84', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('279', '84', null, '30', '20150420');
INSERT INTO `tp_qycopy` VALUES ('278', '83', null, '222', '20150417');
INSERT INTO `tp_qycopy` VALUES ('277', '83', null, '188', '20150417');
INSERT INTO `tp_qycopy` VALUES ('276', '83', null, '210', '20150417');
INSERT INTO `tp_qycopy` VALUES ('275', '82', null, '232', '20150417');
INSERT INTO `tp_qycopy` VALUES ('274', '82', null, '210', '20150417');
INSERT INTO `tp_qycopy` VALUES ('273', '82', null, '230', '20150417');
INSERT INTO `tp_qycopy` VALUES ('272', '81', null, '190', '20150417');
INSERT INTO `tp_qycopy` VALUES ('271', '81', null, '188', '20150417');
INSERT INTO `tp_qycopy` VALUES ('270', '81', null, '111', '20150417');
INSERT INTO `tp_qycopy` VALUES ('269', '81', null, '82', '20150417');
INSERT INTO `tp_qycopy` VALUES ('268', '81', null, '54', '20150417');
INSERT INTO `tp_qycopy` VALUES ('267', '81', null, '222', '20150417');
INSERT INTO `tp_qycopy` VALUES ('266', '81', null, '210', '20150417');
INSERT INTO `tp_qycopy` VALUES ('265', '81', null, '30', '20150417');
INSERT INTO `tp_qycopy` VALUES ('264', '81', null, '29', '20150417');
INSERT INTO `tp_qycopy` VALUES ('263', '80', null, '190', '20150417');
INSERT INTO `tp_qycopy` VALUES ('262', '80', null, '210', '20150417');
INSERT INTO `tp_qycopy` VALUES ('261', '80', null, '222', '20150417');
INSERT INTO `tp_qycopy` VALUES ('260', '80', null, '188', '20150417');
INSERT INTO `tp_qycopy` VALUES ('259', '80', null, '52', '20150417');
INSERT INTO `tp_qycopy` VALUES ('258', '80', null, '30', '20150417');
INSERT INTO `tp_qycopy` VALUES ('257', '79', null, '227', '20150416');
INSERT INTO `tp_qycopy` VALUES ('256', '79', null, '210', '20150416');
INSERT INTO `tp_qycopy` VALUES ('255', '79', null, '111', '20150416');
INSERT INTO `tp_qycopy` VALUES ('254', '79', null, '222', '20150416');
INSERT INTO `tp_qycopy` VALUES ('253', '78', null, '222', '20150416');
INSERT INTO `tp_qycopy` VALUES ('252', '78', null, '210', '20150416');
INSERT INTO `tp_qycopy` VALUES ('251', '78', null, '187', '20150416');
INSERT INTO `tp_qycopy` VALUES ('250', '78', null, '82', '20150416');
INSERT INTO `tp_qycopy` VALUES ('249', '78', null, '54', '20150416');
INSERT INTO `tp_qycopy` VALUES ('248', '78', null, '29', '20150416');
INSERT INTO `tp_qycopy` VALUES ('247', '78', null, '52', '20150416');
INSERT INTO `tp_qycopy` VALUES ('246', '78', null, '30', '20150416');
INSERT INTO `tp_qycopy` VALUES ('245', '77', null, '82', '20150416');
INSERT INTO `tp_qycopy` VALUES ('244', '77', null, '52', '20150416');
INSERT INTO `tp_qycopy` VALUES ('243', '77', null, '222', '20150416');
INSERT INTO `tp_qycopy` VALUES ('242', '77', null, '188', '20150416');
INSERT INTO `tp_qycopy` VALUES ('241', '77', null, '54', '20150416');
INSERT INTO `tp_qycopy` VALUES ('240', '77', null, '30', '20150416');
INSERT INTO `tp_qycopy` VALUES ('239', '77', null, '29', '20150416');
INSERT INTO `tp_qycopy` VALUES ('238', '76', null, '192', '20150416');
INSERT INTO `tp_qycopy` VALUES ('237', '76', null, '188', '20150416');
INSERT INTO `tp_qycopy` VALUES ('236', '76', null, '187', '20150416');
INSERT INTO `tp_qycopy` VALUES ('235', '76', null, '186', '20150416');
INSERT INTO `tp_qycopy` VALUES ('234', '76', null, '82', '20150416');
INSERT INTO `tp_qycopy` VALUES ('233', '76', null, '111', '20150416');
INSERT INTO `tp_qycopy` VALUES ('232', '76', null, '54', '20150416');
INSERT INTO `tp_qycopy` VALUES ('231', '76', null, '52', '20150416');
INSERT INTO `tp_qycopy` VALUES ('230', '76', null, '222', '20150416');
INSERT INTO `tp_qycopy` VALUES ('229', '76', null, '210', '20150416');
INSERT INTO `tp_qycopy` VALUES ('228', '76', null, '30', '20150416');
INSERT INTO `tp_qycopy` VALUES ('227', '76', null, '29', '20150416');
INSERT INTO `tp_qycopy` VALUES ('226', '75', null, '227', '20150416');
INSERT INTO `tp_qycopy` VALUES ('225', '75', null, '52', '20150416');
INSERT INTO `tp_qycopy` VALUES ('224', '75', null, '210', '20150416');
INSERT INTO `tp_qycopy` VALUES ('223', '75', null, '222', '20150416');
INSERT INTO `tp_qycopy` VALUES ('222', '75', null, '82', '20150416');
INSERT INTO `tp_qycopy` VALUES ('221', '75', null, '54', '20150416');
INSERT INTO `tp_qycopy` VALUES ('220', '74', null, '227', '20150416');
INSERT INTO `tp_qycopy` VALUES ('219', '74', null, '222', '20150416');
INSERT INTO `tp_qycopy` VALUES ('218', '74', null, '210', '20150416');
INSERT INTO `tp_qycopy` VALUES ('217', '74', null, '230', '20150416');
INSERT INTO `tp_qycopy` VALUES ('216', '73', null, '222', '20150415');
INSERT INTO `tp_qycopy` VALUES ('215', '73', null, '227', '20150415');
INSERT INTO `tp_qycopy` VALUES ('214', '73', null, '187', '20150415');
INSERT INTO `tp_qycopy` VALUES ('213', '73', null, '186', '20150415');
INSERT INTO `tp_qycopy` VALUES ('212', '72', null, '227', '20150415');
INSERT INTO `tp_qycopy` VALUES ('211', '72', null, '82', '20150415');
INSERT INTO `tp_qycopy` VALUES ('210', '72', null, '222', '20150415');
INSERT INTO `tp_qycopy` VALUES ('209', '72', null, '190', '20150415');
INSERT INTO `tp_qycopy` VALUES ('208', '72', null, '52', '20150415');
INSERT INTO `tp_qycopy` VALUES ('207', '72', null, '30', '20150415');
INSERT INTO `tp_qycopy` VALUES ('206', '71', null, '82', '20150415');
INSERT INTO `tp_qycopy` VALUES ('205', '71', null, '54', '20150415');
INSERT INTO `tp_qycopy` VALUES ('204', '71', null, '52', '20150415');
INSERT INTO `tp_qycopy` VALUES ('203', '70', null, '82', '20150415');
INSERT INTO `tp_qycopy` VALUES ('202', '70', null, '54', '20150415');
INSERT INTO `tp_qycopy` VALUES ('201', '70', null, '52', '20150415');
INSERT INTO `tp_qycopy` VALUES ('200', '69', null, '210', '20150415');
INSERT INTO `tp_qycopy` VALUES ('199', '69', null, '222', '20150415');
INSERT INTO `tp_qycopy` VALUES ('198', '69', null, '111', '20150415');
INSERT INTO `tp_qycopy` VALUES ('197', '69', null, '54', '20150415');
INSERT INTO `tp_qycopy` VALUES ('196', '69', null, '52', '20150415');
INSERT INTO `tp_qycopy` VALUES ('195', '68', null, '210', '20150415');
INSERT INTO `tp_qycopy` VALUES ('194', '68', null, '222', '20150415');
INSERT INTO `tp_qycopy` VALUES ('193', '68', null, '227', '20150415');
INSERT INTO `tp_qycopy` VALUES ('192', '68', null, '190', '20150415');
INSERT INTO `tp_qycopy` VALUES ('188', '68', null, '30', '20150415');
INSERT INTO `tp_qycopy` VALUES ('189', '68', null, '52', '20150415');
INSERT INTO `tp_qycopy` VALUES ('190', '68', null, '82', '20150415');
INSERT INTO `tp_qycopy` VALUES ('191', '68', null, '186', '20150415');
INSERT INTO `tp_qycopy` VALUES ('183', '67', null, '52', '20150415');
INSERT INTO `tp_qycopy` VALUES ('184', '67', null, '54', '20150415');
INSERT INTO `tp_qycopy` VALUES ('185', '67', null, '111', '20150415');
INSERT INTO `tp_qycopy` VALUES ('186', '67', null, '210', '20150415');
INSERT INTO `tp_qycopy` VALUES ('187', '67', null, '222', '20150415');
INSERT INTO `tp_qycopy` VALUES ('354', '101', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('355', '102', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('356', '102', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('357', '102', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('358', '102', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('359', '103', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('360', '103', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('361', '103', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('362', '103', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('363', '104', null, '30', '20150420');
INSERT INTO `tp_qycopy` VALUES ('364', '104', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('365', '104', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('366', '104', null, '186', '20150420');
INSERT INTO `tp_qycopy` VALUES ('367', '104', null, '210', '20150420');
INSERT INTO `tp_qycopy` VALUES ('368', '104', null, '222', '20150420');
INSERT INTO `tp_qycopy` VALUES ('369', '104', null, '227', '20150420');
INSERT INTO `tp_qycopy` VALUES ('370', '105', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('371', '105', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('372', '105', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('373', '106', null, '30', '20150420');
INSERT INTO `tp_qycopy` VALUES ('374', '106', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('375', '106', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('376', '107', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('377', '107', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('378', '107', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('379', '108', null, '30', '20150420');
INSERT INTO `tp_qycopy` VALUES ('380', '108', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('381', '108', null, '111', '20150420');
INSERT INTO `tp_qycopy` VALUES ('382', '108', null, '186', '20150420');
INSERT INTO `tp_qycopy` VALUES ('383', '108', null, '210', '20150420');
INSERT INTO `tp_qycopy` VALUES ('384', '108', null, '222', '20150420');
INSERT INTO `tp_qycopy` VALUES ('385', '108', null, '227', '20150420');
INSERT INTO `tp_qycopy` VALUES ('386', '109', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('387', '109', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('388', '109', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('389', '110', null, '54', '20150420');
INSERT INTO `tp_qycopy` VALUES ('390', '110', null, '82', '20150420');
INSERT INTO `tp_qycopy` VALUES ('391', '110', null, '192', '20150420');
INSERT INTO `tp_qycopy` VALUES ('392', '110', null, '222', '20150420');
INSERT INTO `tp_qycopy` VALUES ('393', '110', null, '210', '20150420');
INSERT INTO `tp_qycopy` VALUES ('394', '110', null, '227', '20150420');
INSERT INTO `tp_qycopy` VALUES ('395', '110', null, '30', '20150420');
INSERT INTO `tp_qycopy` VALUES ('396', '110', null, '52', '20150420');
INSERT INTO `tp_qycopy` VALUES ('397', '110', null, '29', '20150420');

-- ----------------------------
-- Table structure for `tp_qyday_date`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyday_date`;
CREATE TABLE `tp_qyday_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_zt` varchar(20) NOT NULL,
  `date_content` text NOT NULL,
  `date_dd` varchar(20) NOT NULL,
  `date_time` varchar(30) NOT NULL,
  `wecha_id` varchar(50) DEFAULT NULL,
  `d_time` varchar(50) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0',
  `subtime` varchar(50) DEFAULT NULL,
  `date_nub` int(11) DEFAULT NULL,
  `hour` varchar(4) NOT NULL DEFAULT '00',
  `min` varchar(4) NOT NULL DEFAULT '00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=287 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyday_date
-- ----------------------------
INSERT INTO `tp_qyday_date` VALUES ('39', '25', 'ad', 'sd ', '创建', '20141204', 'xtzlyp', '1417587862', '1', '1417588958', '4', '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('40', '25', '测试', '测试测试', '创建', '20141205', 'xtzlyp', '1417587895', '1', '1417589127', '5', '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('41', '25', '问请问请问', '请问请问q', '创建', '20141204', 'xtzlyp', '1417598259', '1', '1417602493', '4', '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('43', '25', '啊吧', '看看', '创建', '20141211', 'xtzlyp', '1417616422', '0', null, '11', '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('44', '25', '啊', '', '创建', '20141203', 'xtzlyp', '1417616471', '0', null, '3', '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('45', '25', 'ffgg', 'ggg', '创建', '20141204', '', '1417659742', '0', null, '4', '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('46', '25', 'rff', 'fgg', '创建', '20141205', '', '1417659833', '0', null, '5', '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('47', '25', '答录机', '八路军了', '创建', '20141211', 'xtzlyp', '1417845266', '1', '1418204816', '11', '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('48', '25', '的同哦', '测控拒绝', '创建', '20141206', 'xtzlyp', '1417845329', '1', '1417845349', '6', '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('49', '25', '咯恶露', '测量我我', '创建', '20141206', 'xtzlyp', '1417845342', '1', '1417845354', '6', '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('50', '25', '王', '月', '创建', '20141218', 'lanrain', '1417968084', '0', null, '18', '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('51', '25', '楼弄', '测控哦哦', '创建', '20141210', 'xtzlyp', '1418179200', '1', '1418204731', '10', '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('52', '25', '糊涂糊涂', '糊涂具体', '', '20141210', 'xtzlyp', '1418140800', '1', '1418204731', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('53', '25', '糊涂糊涂湖', '糊涂具体具体', '', '20141210', 'xtzlyp', '1418140800', '1', '1418202774', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('54', '25', '糊涂糊涂糊涂', '糊涂礼物具体', '', '20141210', 'xtzlyp', '1418140800', '1', '1418200323', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('55', '25', '糊涂', '继续', '', '20141210', 'xtzlyp', '1418140800', '1', '1418200323', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('56', '25', '糊涂糊涂', '继续下雨了', '', '20141210', 'xtzlyp', '1418140800', '1', '1418202161', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('57', '25', '入住。', '劲舞团', '', '20141210', 'xtzlyp', '1418140800', '1', '1418202147', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('58', '25', '入住。继续', '劲舞团胡须', '', '20141210', 'xtzlyp', '1418140800', '1', '1418202172', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('59', '25', '力图', '具体是是', '', '20141210', 'xtzlyp', '1418140800', '1', '1418202175', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('60', '25', '力图具体', '具体是是还下雨', '', '20141210', 'xtzlyp', '1418140800', '1', '1418204670', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('61', '25', '力图', '具体是是', '', '20141210', 'xtzlyp', '1418140800', '1', '1418204731', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('65', '25', '好了具体', '188888', '', '20141210', 'xtzlyp', '1418140800', '0', null, null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('66', '25', '好了具体糊涂', '188888了我具体', '', '20141210', 'xtzlyp', '1418140800', '0', null, null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('67', '25', '好了具糊涂体', '188888旅途跳舞图', '', '20141210', 'xtzlyp', '1418140800', '0', null, null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('68', '25', '啊呜', '步履蹒跚', '', '20141210', 'xtzlyp', '1418140800', '1', '1418202323', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('69', '25', '啊呜陆续', '步履蹒跚连续剧', '', '20141210', 'xtzlyp', '1418140800', '1', '1418210620', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('70', '25', '哦旅游了了', 'called', '', '20141211', 'xtzlyp', '1418227200', '1', '1418204808', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('71', '25', '哦咯涂卡', '快乐了了了了', '', '20141211', 'xtzlyp', '1418227200', '1', '1418204823', null, '0', '0');
INSERT INTO `tp_qyday_date` VALUES ('72', '25', '通讯录', '了继续他', '', '20141210', 'xtzlyp', '1418140800', '1', '1418210633', null, '4', '6');
INSERT INTO `tp_qyday_date` VALUES ('73', '25', '通讯录胡须', '了继续他金龙鱼', '', '20141210', 'xtzlyp', '1418140800', '0', null, null, '4', '6');
INSERT INTO `tp_qyday_date` VALUES ('74', '25', '咯具体', '1588', '', '20141210', 'xtzlyp', '1418140800', '0', null, null, '4', '4');
INSERT INTO `tp_qyday_date` VALUES ('75', '25', '咯具体陆续', '1588胡兔兔', '', '20141210', 'xtzlyp', '1418140800', '0', null, null, '4', '6');
INSERT INTO `tp_qyday_date` VALUES ('76', '25', '金龙鱼', '歌舞团', '', '20141210', 'xtzlyp', '1418140800', '0', null, null, '4', '4');
INSERT INTO `tp_qyday_date` VALUES ('77', '25', '金龙贾露露鱼', '歌舞团考虑图', '', '20141210', 'xtzlyp', '1418140800', '0', null, null, '5', '6');
INSERT INTO `tp_qyday_date` VALUES ('78', '25', '旅途', '歌舞团', '', '20141210', 'xtzlyp', '1418140800', '0', null, null, '005', '030');
INSERT INTO `tp_qyday_date` VALUES ('79', '25', '旅途1588', '歌舞团呼叫转移', '', '20141210', 'xtzlyp', '1418140800', '0', null, null, '12', '05');
INSERT INTO `tp_qyday_date` VALUES ('80', '25', '了我普通', '胡兔兔', '', '20141210', 'xtzlyp', '1418140800', '0', null, null, '04', '45');
INSERT INTO `tp_qyday_date` VALUES ('81', '25', '了我普考虑图通', '胡兔兔汇率。吐了了', '', '20141210', 'xtzlyp', '1418140800', '0', null, null, '03', '45');
INSERT INTO `tp_qyday_date` VALUES ('82', '25', '来咯哦了', '从来了', '', '20141213', 'xtzlyp', '1418400000', '0', null, null, '01', '10');
INSERT INTO `tp_qyday_date` VALUES ('83', '25', '来咯哦了', '从来了咯困哦', '', '20141213', 'xtzlyp', '1418400000', '0', null, null, '02', '35');
INSERT INTO `tp_qyday_date` VALUES ('84', '25', '', '', '', '', 'xtzlyp', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('85', '25', '', '', '', '', 'xtzlyp', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('86', '25', '', '123', '', '', 'xtzlyp', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('87', '25', '日子', 'ghhbn', '', '20141216', 'lanrain', '1418659200', '1', '1418732044', null, '04', '25');
INSERT INTO `tp_qyday_date` VALUES ('88', '25', '日子', 'ghhbn', '', '20141216', 'lanrain', '1418659200', '1', '1418732051', null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('89', '25', '来lol图YY', '老K五老K', '', '20141222', 'ding', '1419177600', '1', '1419240097', null, '11', '35');
INSERT INTO `tp_qyday_date` VALUES ('90', '25', '监狱兔', '糊涂', '', '20141227', 'ding', '1419609600', '1', '1419584155', null, '08', '00');
INSERT INTO `tp_qyday_date` VALUES ('91', '25', '啊咯', '空军总医院', '', '20141227', 'ding', '1419609600', '0', null, null, '09', '50');
INSERT INTO `tp_qyday_date` VALUES ('92', '25', '', '', '', '20150128', '270636852', '1422374400', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('93', '25', '', '', '', '20150128', '270636852', '1422374400', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('94', '25', '时刻需要 v 啊叫', '神来之笔思绪', '', '20150128', '270636852', '1422374400', '1', '1422412021', null, '02', '');
INSERT INTO `tp_qyday_date` VALUES ('95', '25', '俄军只是 v 自己在 v', '我看着今晚 v 最空虚的家', '', '20150228', '270636852', '1425052800', '0', null, null, '04', '40');
INSERT INTO `tp_qyday_date` VALUES ('96', '25', '俄军只是 v 自己在 v', '111111晚 v 最空虚的家', '', '20150228', '270636852', '1425052800', '0', null, null, '02', '45');
INSERT INTO `tp_qyday_date` VALUES ('97', '25', '', '', '', '', '270636852', '0', '0', null, null, '01', '10');
INSERT INTO `tp_qyday_date` VALUES ('98', '25', '', '', '', '', '270636852', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('99', '25', 'dsgsadg sdgsda g', 'fsdyertgadfh', '', '20150428', '270636852', '1430150400', '0', null, null, '04', '15');
INSERT INTO `tp_qyday_date` VALUES ('100', '25', '', '', '', '', 'an', '0', '0', null, null, '17', '45');
INSERT INTO `tp_qyday_date` VALUES ('101', '25', '副大好处', '', '', '发挥协会', '270636852', '0', '0', null, null, '02', '10');
INSERT INTO `tp_qyday_date` VALUES ('102', '25', 'xcvcxb', 'zxxcv', '', 'cv', '270636852', '0', '0', null, null, '02', '10');
INSERT INTO `tp_qyday_date` VALUES ('103', '25', '', '', '', '', 'an', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('104', '25', '', '11', '', '', 'an', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('105', '25', '', '', '', '', 'an', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('106', '25', '', '', '', '', '270636852', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('107', '25', '明天吧', '回家啦啦啦啦', '', '', 'idodo_2009', '0', '0', null, null, '13', '55');
INSERT INTO `tp_qyday_date` VALUES ('108', '25', '', '', '', '', 'an', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('109', '25', '', '', '', '', '270636852', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('110', '25', '世纪中国市场', '思考着噶K是 v 上班', '', 's j s v', '270636852', '0', '0', null, null, '02', '20');
INSERT INTO `tp_qyday_date` VALUES ('111', '25', '雷都没', '', '', '20150209', 'xtzlyp', '1423411200', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('112', '25', '比较累度', '露露把亏图', '', '20150210', 'xtzlyp', '1423497600', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('113', '25', '复活币', '人好就你', '', '20150210', 'ding', '1423497600', '0', null, null, '08', '20');
INSERT INTO `tp_qyday_date` VALUES ('114', '25', '个好你你', '恩好不没就', '', '20150211', 'ding', '1423584000', '0', null, null, '09', '30');
INSERT INTO `tp_qyday_date` VALUES ('115', '25', '人你没就', '饿好就好', '', '20150209', 'ding', '1423411200', '0', null, null, '16', '20');
INSERT INTO `tp_qyday_date` VALUES ('116', '25', 'j su s b', '是看着我不在家', '', '20150212', '270636852', '1423670400', '0', null, null, '02', '10');
INSERT INTO `tp_qyday_date` VALUES ('117', '25', '丝丝吧', '妻子恶霸哪款', '', '20150227', '270636852', '1424966400', '0', null, null, '02', '40');
INSERT INTO `tp_qyday_date` VALUES ('118', '25', '哈哈', '哈哈', '', '20150306', 'an', '1425571200', '1', '1425625889', null, '01', '15');
INSERT INTO `tp_qyday_date` VALUES ('119', '25', 'u 人拒绝', '', '', '20150307', '270636852', '1425657600', '0', null, null, '02', '10');
INSERT INTO `tp_qyday_date` VALUES ('120', '25', '', '', '', '20150312', 'xw9527520', '1426089600', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('121', '25', 'flower', '', '', '', 'li_jun_6', '0', '0', null, null, '10', '30');
INSERT INTO `tp_qyday_date` VALUES ('122', '25', 'flower', '', '', '', 'li_jun_6', '0', '0', null, null, '10', '30');
INSERT INTO `tp_qyday_date` VALUES ('123', '25', 'flower', '', '', '20150315', 'li_jun_6', '1426348800', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('124', '25', '', '', '', '', '270636852', '0', '0', null, null, '02', '25');
INSERT INTO `tp_qyday_date` VALUES ('125', '25', 'v 需要互相攻击', '和繁荣方法减肥', '', '20150313', '270636852', '1426176000', '0', null, null, '04', '20');
INSERT INTO `tp_qyday_date` VALUES ('126', '25', 'flower', 'vgdgh', '', '20150315', 'li_jun_6', '1426348800', '0', null, null, '06', '10');
INSERT INTO `tp_qyday_date` VALUES ('127', '25', 'flower', 'flower', '', '20150322', 'li_jun_6', '1426953600', '0', null, null, '06', '10');
INSERT INTO `tp_qyday_date` VALUES ('128', '25', '', '', '', '', 'li_jun_6', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('129', '25', '', 'ruguo；阿拉丁飞静安寺是；   垃圾撒 萨芬撒的发生发生法 手动阀风飒飒发是啊沙发是发顺丰爱上是撒啊沙发爱上洒水发上发生发生上发生发顺丰啊啊是发顺丰 啊沙发上发生发生发水电费爱上啊撒的发生发生法爱上啊沙发按时发生发生发生法上发生发顺丰啊啊萨芬啊发生按时发生是ruguo；阿拉丁飞静安寺是；   垃圾撒 萨芬撒的发生发生法 手动阀风飒飒发是啊沙发是发顺丰爱上是撒啊沙发爱上洒水发上发生发生上发生发顺丰啊啊是发顺丰 啊沙发上发生发生发水电费爱上啊撒的发生发生法爱上啊沙发按时发生发生发生法上发生发顺丰啊啊萨芬啊发生按时发生是ruguo；阿拉丁飞静安寺是；   垃圾撒 萨芬撒的发生发生法 手动阀风飒飒发是啊沙发是发顺丰爱上是撒啊沙发爱上洒水发上发生发生上发生发顺丰啊啊是发顺丰 啊沙发上发生发生发水电费爱上啊撒的发生发生法爱上啊沙发按时发生发生发生法上发生发顺丰啊啊萨芬啊发生按时发生是', '', '', 'li_jun_6', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('130', '25', '话', '嘿嘿', '', '20150318', '77484824865', '1426608000', '0', null, null, '06', '30');
INSERT INTO `tp_qyday_date` VALUES ('131', '25', '', '', '', '20150318', '77484824865', '1426608000', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('132', '25', '啊', '', '', '20150318', '77484824865', '1426608000', '0', null, null, '03', '30');
INSERT INTO `tp_qyday_date` VALUES ('133', '25', '哈哈', '回家', '', '20150317', 'an', '1426521600', '1', '1426561442', null, '04', '30');
INSERT INTO `tp_qyday_date` VALUES ('134', '25', '', '', '', '20150317', 'an', '1426521600', '1', '1426561442', null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('135', '25', '看看', '哈啊哈', '', '20150317', 'an', '1426521600', '1', '1426561442', null, '04', '10');
INSERT INTO `tp_qyday_date` VALUES ('136', '25', '', '', '', '', 'an', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('137', '25', '', '', '', '', 'an', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('138', '25', '', '', '', '', 'an', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('139', '25', '', '', '', '', 'li_jun_6', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('140', '25', '哈啊', '被你', '', '20150317', 'li_jun_6', '1426521600', '1', '1426577256', null, '04', '25');
INSERT INTO `tp_qyday_date` VALUES ('141', '25', '天空之城', '秘密花园', '', '20150318', 'li_jun_6', '1426608000', '0', null, null, '05', '20');
INSERT INTO `tp_qyday_date` VALUES ('142', '25', '快乐', '过来了吗', '', '20150317', 'li_jun_6', '1426521600', '1', '1426577256', null, '03', '25');
INSERT INTO `tp_qyday_date` VALUES ('143', '25', '哈哈', '快乐大本营', '', '20150317', 'li_jun_6', '1426521600', '0', null, null, '06', '20');
INSERT INTO `tp_qyday_date` VALUES ('144', '25', '快乐', '天空之城', '', '20150318', 'li_jun_6', '1426608000', '0', null, null, '07', '20');
INSERT INTO `tp_qyday_date` VALUES ('145', '25', '快乐2', '图', '', '20150318', 'li_jun_6', '1426608000', '0', null, null, '07', '40');
INSERT INTO `tp_qyday_date` VALUES ('146', '25', '电话对方会议', '大家庭 v 哈哈', '', '20150317', '270636852', '1426521600', '0', null, null, '01', '');
INSERT INTO `tp_qyday_date` VALUES ('147', '25', '哎哟不错哦', '哈哈哈哈', '', '20150317', 'li_jun_6', '1426521600', '0', null, null, '07', '25');
INSERT INTO `tp_qyday_date` VALUES ('148', '25', 'j g g j j', '讲粗口的', '', '20150317', '270636852', '1426521600', '0', null, null, '01', '');
INSERT INTO `tp_qyday_date` VALUES ('149', '25', 'h d h i', '', '', '20150317', '270636852', '1426521600', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('150', '25', 'u 打开吃饭', '', '', '20150317', '270636852', '1426521600', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('151', '25', '哈哈', '哈哈', '', '20150317', 'an', '1426521600', '0', null, null, '02', '30');
INSERT INTO `tp_qyday_date` VALUES ('152', '25', '哈哈', '哈哈哈', '', '20150318', 'li_jun_6', '1426608000', '0', null, null, '04', '20');
INSERT INTO `tp_qyday_date` VALUES ('153', '25', 'hello', 'vfd', '', '20150318', 'qiancheng', '1426608000', '0', null, null, '03', '25');
INSERT INTO `tp_qyday_date` VALUES ('154', '25', '吃', '妇女节', '', '20150318', 'qiancheng', '1426608000', '0', null, null, '06', '35');
INSERT INTO `tp_qyday_date` VALUES ('155', '25', 'ughh', '', '', '20150318', '270636852', '1426608000', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('156', '25', '怒付出', '', '', '20150318', '270636852', '1426608000', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('157', '25', '海关检查', '', '', '20150318', '270636852', '1426608000', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('158', '25', '哈哈', '咳咳', '', '20150318', 'an', '1426608000', '0', null, null, '04', '30');
INSERT INTO `tp_qyday_date` VALUES ('159', '25', '哎', '彼此', '', '20150318', 'an', '1426608000', '0', null, null, '05', '35');
INSERT INTO `tp_qyday_date` VALUES ('168', '25', 'asdfjklfdaf', 'hhifafafksfjlsad', '', '20150320', 'qiancheng', '1426780800', '0', null, null, '01', '00');
INSERT INTO `tp_qyday_date` VALUES ('208', '25', '哈哈哈哈', '哈哈', '', '', 'an', '0', '0', null, null, '02', '20');
INSERT INTO `tp_qyday_date` VALUES ('217', '25', '灯火辉煌', '开会开会', '', '20150321', 'ding', '1426867200', '0', null, null, '08', '00');
INSERT INTO `tp_qyday_date` VALUES ('218', '25', '人好就就个', '我发好就好的', '', '20150321', 'ding', '1426867200', '0', null, null, '09', '20');
INSERT INTO `tp_qyday_date` VALUES ('219', '25', '开赛', '肉刺', '', '20150323', 'li_jun_6', '1427040000', '0', null, null, '05', '30');
INSERT INTO `tp_qyday_date` VALUES ('220', '25', '溺', '徐爱爱', '', '20150323', 'li_jun_6', '1427040000', '0', null, null, '08', '35');
INSERT INTO `tp_qyday_date` VALUES ('221', '25', 'dfgsa g', 'asd fasdf asd as', '', '20150323', 'li_jun_6', '1427040000', '0', null, null, '03', '35');
INSERT INTO `tp_qyday_date` VALUES ('222', '25', '积分继续避风港', '降低妇女个', '', '20150323', 'rongcheng', '1427040000', '0', null, null, '02', '15');
INSERT INTO `tp_qyday_date` VALUES ('223', '25', '红尘女孩', '见佛 v 家', '', '20150323', 'rongcheng', '1427040000', '0', null, null, '06', '20');
INSERT INTO `tp_qyday_date` VALUES ('224', '25', '哈哈', '哈哈', '', '20150323', '0033', '1427040000', '0', null, null, '04', '15');
INSERT INTO `tp_qyday_date` VALUES ('225', '25', '呵呵', '哈哈', '', '20150323', '0033', '1427040000', '0', null, null, '07', '25');
INSERT INTO `tp_qyday_date` VALUES ('226', '25', '哈哈', '哈哈', '', '', '0033', '0', '0', null, null, '01', '25');
INSERT INTO `tp_qyday_date` VALUES ('227', '25', '返回韩国', '凤凰花 v', '', '20150323', '270636852', '1427040000', '0', null, null, '10', '35');
INSERT INTO `tp_qyday_date` VALUES ('228', '25', '发挥 v 吃', '福建牛奶', '', '20150323', '270636852', '1427040000', '0', null, null, '08', '55');
INSERT INTO `tp_qyday_date` VALUES ('229', '25', '回来', '哈哈', '', '20150926', '0033', '1443196800', '0', null, null, '04', '15');
INSERT INTO `tp_qyday_date` VALUES ('230', '25', '给你', '哦哦', '', '20150926', '0033', '1443196800', '0', null, null, '04', '20');
INSERT INTO `tp_qyday_date` VALUES ('231', '25', '明天', '鸵鸟', '', '20150926', '0033', '1443196800', '0', null, null, '04', '25');
INSERT INTO `tp_qyday_date` VALUES ('232', '25', '哈哈', '还睡懒觉', '', '20150324', '0033', '1427126400', '0', null, null, '03', '20');
INSERT INTO `tp_qyday_date` VALUES ('233', '25', '啦啦', '害怕', '', '20150324', '0033', '1427126400', '0', null, null, '02', '25');
INSERT INTO `tp_qyday_date` VALUES ('234', '25', '还得', '害后', '', '20150327', '0033', '1427385600', '0', null, null, '02', '30');
INSERT INTO `tp_qyday_date` VALUES ('235', '25', '个嗯估计', '破天', '', '20150327', '0033', '1427385600', '0', null, null, '04', '30');
INSERT INTO `tp_qyday_date` VALUES ('236', '25', '体育课', '嘻嘻', '', '20150325', 'li_jun_6', '1427212800', '0', null, null, '05', '30');
INSERT INTO `tp_qyday_date` VALUES ('237', '25', '你在说我是', '用搜狗', '', '20150325', 'li_jun_6', '1427212800', '0', null, null, '07', '40');
INSERT INTO `tp_qyday_date` VALUES ('238', '25', 'sdfgdsgsdgsdg', 'dsgsdgsdg', '', '20150325', '270636852', '1427212800', '0', null, null, '04', '20');
INSERT INTO `tp_qyday_date` VALUES ('239', '25', 'fsdfsdf', 'asdgsadgdsgg', '', '20150325', '270636852', '1427212800', '0', null, null, '03', '15');
INSERT INTO `tp_qyday_date` VALUES ('240', '25', '龙雨', 'know我了', '', '20150325', 'li_jun_6', '1427212800', '0', null, null, '06', '20');
INSERT INTO `tp_qyday_date` VALUES ('241', '25', '咯语气', 'joyo', '', '20150325', 'li_jun_6', '1427212800', '0', null, null, '06', '40');
INSERT INTO `tp_qyday_date` VALUES ('242', '25', '安静下来', '咯五', '', '20150326', 'li_jun_6', '1427299200', '0', null, null, '05', '30');
INSERT INTO `tp_qyday_date` VALUES ('243', '25', '回复 vu 改革', 'j g j b v g w', '', '20150326', '270636852', '1427299200', '0', null, null, '01', '20');
INSERT INTO `tp_qyday_date` VALUES ('244', '25', '客户 i 加班干活', '咖啡 i 方法会不会 v', '', '20150326', '270636852', '1427299200', '0', null, null, '06', '55');
INSERT INTO `tp_qyday_date` VALUES ('245', '25', '够啊咯', '取笑我', '', '20150326', 'li_jun_6', '1427299200', '0', null, null, '01', '25');
INSERT INTO `tp_qyday_date` VALUES ('246', '25', 'dkbcv他最后', '还可以', '', '20150327', 'li_jun_6', '1427385600', '0', null, null, '04', '30');
INSERT INTO `tp_qyday_date` VALUES ('247', '25', '还在于他', 'thorn揪心', '', '20150327', 'li_jun_6', '1427385600', '0', null, null, '07', '40');
INSERT INTO `tp_qyday_date` VALUES ('248', '25', '到北京', '2', '', '', 'lanrain', '0', '0', null, null, '', '');
INSERT INTO `tp_qyday_date` VALUES ('249', '25', '具体位置', '所以我就', '', '20150328', 'li_jun_6', '1427472000', '0', null, null, '04', '15');
INSERT INTO `tp_qyday_date` VALUES ('250', '25', '替我谢谢', '啊继续', '', '20150328', 'li_jun_6', '1427472000', '0', null, null, '05', '40');
INSERT INTO `tp_qyday_date` VALUES ('251', '25', '呵呵', '呵呵', '', '20150328', '0033', '1427472000', '0', null, null, '03', '25');
INSERT INTO `tp_qyday_date` VALUES ('252', '25', '好看了', '好货来咯', '', '20150328', '0033', '1427472000', '0', null, null, '05', '35');
INSERT INTO `tp_qyday_date` VALUES ('253', '25', 'djcghj', 'fhnn', '', '20150331', '0033', '1427731200', '0', null, null, '07', '30');
INSERT INTO `tp_qyday_date` VALUES ('254', '25', 'gjjbh', 'gjkbbb', '', '20150331', '0033', '1427731200', '0', null, null, '07', '25');
INSERT INTO `tp_qyday_date` VALUES ('255', '25', 'hkbvg', 'yjjv', '', '20150331', '0033', '1427731200', '0', null, null, '05', '25');
INSERT INTO `tp_qyday_date` VALUES ('256', '25', 'gkcru', 'jvkj', '', '20150331', '0033', '1427731200', '0', null, null, '05', '30');
INSERT INTO `tp_qyday_date` VALUES ('257', '25', '好听吗', '胡雨晴', '', '20150331', 'li_jun_6', '1427731200', '0', null, null, '02', '15');
INSERT INTO `tp_qyday_date` VALUES ('258', '25', '可以一起', '体育生', '', '20150331', 'li_jun_6', '1427731200', '0', null, null, '05', '30');
INSERT INTO `tp_qyday_date` VALUES ('259', '25', 'CK你XP', '太吸引人', '', '20150331', 'li_jun_6', '1427731200', '0', null, null, '07', '40');
INSERT INTO `tp_qyday_date` VALUES ('260', '25', '昂wps', 'V字形破', '', '20150331', 'li_jun_6', '1427731200', '0', null, null, '05', '25');
INSERT INTO `tp_qyday_date` VALUES ('261', '25', '好好学习', '回眸一笑', '', '20150401', 'li_jun_6', '1427817600', '0', null, null, '02', '15');
INSERT INTO `tp_qyday_date` VALUES ('262', '25', '脖子上', '家里有事', '', '20150401', 'li_jun_6', '1427817600', '0', null, null, '04', '35');
INSERT INTO `tp_qyday_date` VALUES ('263', '25', 'look', 'smoking', '', '20150401', '0033', '1427817600', '0', null, null, '02', '20');
INSERT INTO `tp_qyday_date` VALUES ('264', '25', '公告', '公告', '', '20150401', '0033', '1427817600', '0', null, null, '05', '25');
INSERT INTO `tp_qyday_date` VALUES ('265', '25', '后果', '够了没', '', '20150401', '0033', '1427817600', '0', null, null, '03', '25');
INSERT INTO `tp_qyday_date` VALUES ('266', '25', '体育', '空', '', '20150401', '0033', '1427817600', '0', null, null, '05', '25');
INSERT INTO `tp_qyday_date` VALUES ('267', '25', '安慰无聊老K哦无限视距哦呜PK哪里需要考', '安抑郁症上YY五兔兔咯老K哦了拒绝啦咯了来咯无图兔子屋头了来咯哦哦哦无图可就要做最咯了啦咯我性子急越狱兔空下午兔兔', '', '20150402', 'li_jun_6', '1427904000', '0', null, null, '05', '15');
INSERT INTO `tp_qyday_date` VALUES ('268', '25', '不用担心', 'T恤我pool了啦咯啦咯啦咯了啦就咯了监控墨迹咯OK了了来咯哦下午图兔兔兔兔监控看看咯嗯弄哦兔兔', '', '20150402', 'li_jun_6', '1427904000', '0', null, null, '06', '40');
INSERT INTO `tp_qyday_date` VALUES ('269', '25', '主题', 'lz嘴呢楼下等你', '', '20150402', 'li_jun_6', '1427904000', '0', null, null, '02', '25');
INSERT INTO `tp_qyday_date` VALUES ('270', '25', '主题', '内容', '', '20150402', '270636852', '1427904000', '0', null, null, '01', '15');
INSERT INTO `tp_qyday_date` VALUES ('271', '25', '主题1', '内容2', '', '20150402', '270636852', '1427904000', '0', null, null, '04', '25');
INSERT INTO `tp_qyday_date` VALUES ('272', '25', '阿里旺旺', '阿鲁特', '', '20150407', 'li_jun_6', '1428336000', '0', null, null, '03', '15');
INSERT INTO `tp_qyday_date` VALUES ('273', '25', '嗯呀', '阿鲁特', '', '20150407', 'li_jun_6', '1428336000', '0', null, null, '06', '30');
INSERT INTO `tp_qyday_date` VALUES ('274', '25', '阿拉伯', '嗯哦哦', '', '20150410', 'li_jun_6', '1428595200', '0', null, null, '02', '20');
INSERT INTO `tp_qyday_date` VALUES ('275', '25', '恶露', '啦啦舞1', '', '20150410', 'li_jun_6', '1428595200', '0', null, null, '07', '35');
INSERT INTO `tp_qyday_date` VALUES ('276', '25', '破网速', 'hall咯', '', '20150410', '0033', '1428595200', '0', null, null, '03', '15');
INSERT INTO `tp_qyday_date` VALUES ('277', '25', 'genuine', '规模兔子', '', '20150410', '0033', '1428595200', '0', null, null, '06', '35');
INSERT INTO `tp_qyday_date` VALUES ('278', '25', '你好', '拖拉机', '', '20150410', 'idodo_2009', '1428595200', '0', null, null, '08', '15');
INSERT INTO `tp_qyday_date` VALUES ('279', '25', '来看看', '看看看看看', '', '', 'idodo_2009', '0', '0', null, null, '14', '10');
INSERT INTO `tp_qyday_date` VALUES ('280', '25', '徐经理', '小雨', '', '', 'idodo_2009', '0', '0', null, null, '09', '20');
INSERT INTO `tp_qyday_date` VALUES ('281', '25', '将阿巴斯精神不振吧', '就暗示吧', '', '20150418', '270636852', '1429286400', '0', null, null, '02', '10');
INSERT INTO `tp_qyday_date` VALUES ('282', '25', '1111', 'vvvvvv', '', '20150418', '270636852', '1429286400', '0', null, null, '06', '00');
INSERT INTO `tp_qyday_date` VALUES ('283', '25', '购物券', '好磨叽', '', '20150420', '0033', '1429459200', '0', null, null, '03', '25');
INSERT INTO `tp_qyday_date` VALUES ('284', '25', '来咯提咯', '嘎都YY', '', '20150420', '0033', '1429459200', '0', null, null, '05', '35');
INSERT INTO `tp_qyday_date` VALUES ('285', '25', '购物券', '好磨叽', '', '20150420', '0033', '1429459200', '0', null, null, '03', '25');
INSERT INTO `tp_qyday_date` VALUES ('286', '25', '来咯提咯', '嘎都YY', '', '20150420', '0033', '1429459200', '0', null, null, '05', '35');

-- ----------------------------
-- Table structure for `tp_qyemail_record`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyemail_record`;
CREATE TABLE `tp_qyemail_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `touser` varchar(100) DEFAULT NULL,
  `from` varchar(32) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyemail_record
-- ----------------------------
INSERT INTO `tp_qyemail_record` VALUES ('1', '墨迹咯', 'xtzlyp', '1', 'wangming|xingceshi|', null, null);
INSERT INTO `tp_qyemail_record` VALUES ('2', '', 'xtzlyp', '1', 'wangming|xingceshi|', '1354937107@qq.com', null);
INSERT INTO `tp_qyemail_record` VALUES ('3', '为34234', 'xtzlyp', '1', 'wangming|xingceshi|', '1354937107@qq.com', null);
INSERT INTO `tp_qyemail_record` VALUES ('4', '卡KTV', 'wangming', '25', null, 'ilovety@ilovety.cn', null);
INSERT INTO `tp_qyemail_record` VALUES ('5', '哦咯宋体', 'xtzlyp', '25', '||', '1354937107@qq.com', '吧空间咯饿了了我了您');
INSERT INTO `tp_qyemail_record` VALUES ('6', null, null, null, null, null, null);
INSERT INTO `tp_qyemail_record` VALUES ('7', '啊咯开业咋了额', 'xtzlyp', '25', 'wangming|', '1354937107@qq.com', '嗯金额具体');
INSERT INTO `tp_qyemail_record` VALUES ('8', null, null, null, null, null, null);
INSERT INTO `tp_qyemail_record` VALUES ('9', '34534534', 'xtzlyp', '25', 'lanrain|blue|', '1354937107@qq.com', '5345345345345twwe');
INSERT INTO `tp_qyemail_record` VALUES ('10', 'rudhhffgg', 'xtzlyp', '25', null, '1354937107@qq.com', 'yggihfvv');
INSERT INTO `tp_qyemail_record` VALUES ('11', '', '270636852', '25', null, '13640652443@qq.com', 'i 个 v 机构');
INSERT INTO `tp_qyemail_record` VALUES ('12', '', '270636852', '25', null, '13640652443@qq.com', '');
INSERT INTO `tp_qyemail_record` VALUES ('13', '', '270636852', '25', null, '13640652443@qq.com', '');
INSERT INTO `tp_qyemail_record` VALUES ('14', '', '270636852', '25', null, '13640652443@qq.com', '给四脚朝天开车的日出');
INSERT INTO `tp_qyemail_record` VALUES ('15', '', 'an', '25', null, null, '111');
INSERT INTO `tp_qyemail_record` VALUES ('16', '', 'an', '25', null, null, '');
INSERT INTO `tp_qyemail_record` VALUES ('17', '数据数据指标', '270636852', '25', null, '13640652443@qq.com', '烧烤食物 v 召开的吧');
INSERT INTO `tp_qyemail_record` VALUES ('18', '', 'an', '25', null, null, '哈哈');
INSERT INTO `tp_qyemail_record` VALUES ('19', null, null, null, null, null, null);
INSERT INTO `tp_qyemail_record` VALUES ('20', '', '270636852', '25', null, '13640652443@qq.com', '德克士 v 我 i 西北四');
INSERT INTO `tp_qyemail_record` VALUES ('21', '', 'an', '25', null, null, '哈哈');
INSERT INTO `tp_qyemail_record` VALUES ('22', null, null, null, null, null, null);
INSERT INTO `tp_qyemail_record` VALUES ('23', 'd h f h h', '270636852', '25', null, '13640652443@qq.com', '电话电话会议');
INSERT INTO `tp_qyemail_record` VALUES ('24', null, null, null, null, null, null);
INSERT INTO `tp_qyemail_record` VALUES ('25', null, null, null, null, null, null);
INSERT INTO `tp_qyemail_record` VALUES ('26', '反反复复', '270636852', '25', null, '13640652443@qq.com', '公告g g g g');
INSERT INTO `tp_qyemail_record` VALUES ('27', null, null, null, null, null, null);
INSERT INTO `tp_qyemail_record` VALUES ('28', 'd d h d h f h h d', '270636852', '25', null, '13640652443@qq.com', '肺结核飞机发动机风景');
INSERT INTO `tp_qyemail_record` VALUES ('29', '好开心呢', '270636852', '25', null, '13640652443@qq.com', '123456啊大大');
INSERT INTO `tp_qyemail_record` VALUES ('30', 'ehjkb', '0033', '25', '270636852|', '672016921@qq.com', 'xhknb');
INSERT INTO `tp_qyemail_record` VALUES ('31', null, null, null, '', null, null);

-- ----------------------------
-- Table structure for `tp_qyfield`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyfield`;
CREATE TABLE `tp_qyfield` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyfield
-- ----------------------------
INSERT INTO `tp_qyfield` VALUES ('23', '217', '233', '1425830400');
INSERT INTO `tp_qyfield` VALUES ('24', '230', '25', '1429027200');
INSERT INTO `tp_qyfield` VALUES ('25', '210', '25', '1429459200');
INSERT INTO `tp_qyfield` VALUES ('26', '222', '25', '1429459200');
INSERT INTO `tp_qyfield` VALUES ('27', '231', '25', '1429459200');

-- ----------------------------
-- Table structure for `tp_qyfield_check`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyfield_check`;
CREATE TABLE `tp_qyfield_check` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `checktime` int(11) DEFAULT NULL,
  `place` varchar(300) DEFAULT NULL,
  `desc` varchar(300) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `long` varchar(128) DEFAULT NULL,
  `lat` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyfield_check
-- ----------------------------
INSERT INTO `tp_qyfield_check` VALUES ('20', '76', '1425974920', '广东省,广州市,海珠区,艺苑路,11号-102-1', '', '233', null, '113.329367707', '23.1035060091');
INSERT INTO `tp_qyfield_check` VALUES ('21', '76', '1425974943', '广东省,广州市,海珠区,艺苑路,11号-102-1', '反反复复', '233', null, '113.329367707', '23.1035060091');
INSERT INTO `tp_qyfield_check` VALUES ('22', '78', '1426123655', '广东省,广州市,海珠区,艺苑路,11号-102-1', '哈哈 走了', '233', 'teNV_pnyS3JcjAnUx8LeLev0Ujg_iJj1EUKxRXv2u9vxj__70JnLxdo_r4ggsHR3', '113.329787335', '23.1036141345');
INSERT INTO `tp_qyfield_check` VALUES ('23', '80', '1429084208', '广州', '哈哈', '25', null, null, null);
INSERT INTO `tp_qyfield_check` VALUES ('24', '82', '1429511518', '', '价格和 v 机会', '25', null, null, null);
INSERT INTO `tp_qyfield_check` VALUES ('25', '85', '1429521544', '将数不胜数', '紧追不舍精神病', '25', null, null, null);

-- ----------------------------
-- Table structure for `tp_qyfield_report`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyfield_report`;
CREATE TABLE `tp_qyfield_report` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  `outaim` varchar(200) NOT NULL,
  `outstyle` varchar(200) NOT NULL,
  `outplace` varchar(200) NOT NULL,
  `btime` int(11) NOT NULL,
  `etime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `wxid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyfield_report
-- ----------------------------
INSERT INTO `tp_qyfield_report` VALUES ('78', 'zhc', '233', '出差嘛', '吃饭', '广州市海珠区', '1426089600', '1426176000', '0', '217', '2');
INSERT INTO `tp_qyfield_report` VALUES ('77', 'zhc', '233', '吃饭', '睡觉', '广东省,广州市,海珠区,艺苑路,11号-102-1', '1425916800', '1426003200', '0', '217', '1');
INSERT INTO `tp_qyfield_report` VALUES ('80', '0033', '25', '很模糊', '33', '', '1429027200', '1434297600', '0', '230', '2');
INSERT INTO `tp_qyfield_report` VALUES ('81', '0033', '25', '很模糊', '33', '', '1429027200', '1434297600', '0', '230', '2');
INSERT INTO `tp_qyfield_report` VALUES ('85', '270636852', '25', '哈哈哈', 'ghhj', '额头沸腾沸腾', '1429459200', '1429545600', '0', '210', '2');
INSERT INTO `tp_qyfield_report` VALUES ('83', 'li_jun_6', '25', '有事待提交', '结果符合', '广州', '1429459200', '1429545600', '0', '222', '2');
INSERT INTO `tp_qyfield_report` VALUES ('84', 'rongcheng', '25', '和直属机关', '飞过海d', '就是说', '1429459200', '1429545600', '0', '231', '1');

-- ----------------------------
-- Table structure for `tp_qyfield_sign`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyfield_sign`;
CREATE TABLE `tp_qyfield_sign` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `checktime` int(11) DEFAULT NULL,
  `img` varchar(128) DEFAULT NULL,
  `desc` varchar(300) DEFAULT NULL,
  `record_id` int(11) NOT NULL,
  `long` varchar(128) DEFAULT NULL,
  `lat` varchar(128) DEFAULT NULL,
  `place` varchar(123) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyfield_sign
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyfield_type`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyfield_type`;
CREATE TABLE `tp_qyfield_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `inphoto` tinyint(1) NOT NULL,
  `outphoto` tinyint(1) NOT NULL,
  `style` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `in_remind` tinyint(1) DEFAULT NULL,
  `in_remind_time` tinyint(1) DEFAULT NULL,
  `in_remind_hour` smallint(4) DEFAULT NULL,
  `in_remind_minute` smallint(4) DEFAULT NULL,
  `out_remind` tinyint(1) DEFAULT NULL,
  `out_remind_time` tinyint(1) DEFAULT NULL,
  `out_remind_hour` smallint(4) DEFAULT NULL,
  `out_remind_minute` smallint(4) DEFAULT NULL,
  `range` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyfield_type
-- ----------------------------
INSERT INTO `tp_qyfield_type` VALUES ('1', '0', '1', '飞过海d,ghhj,结果符合', '25', '1', '1', '10', '9', '1', '0', '8', '7', '1001333');

-- ----------------------------
-- Table structure for `tp_qyfile`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyfile`;
CREATE TABLE `tp_qyfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `media_id` varchar(255) DEFAULT NULL,
  `created_time` varchar(16) DEFAULT NULL,
  `type` varchar(16) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyfile
-- ----------------------------
INSERT INTO `tp_qyfile` VALUES ('51', '25', '1q-4nilAb2QAYEE7RbAI5_pGgXVNtEBT-OQXwVadMEoeYRWRVeiJDNtxfxzhB73wQjoeuUHHxmbGf9FxcuIs9Jg', '1417926052', 'file', 'ewer', null);
INSERT INTO `tp_qyfile` VALUES ('53', '25', '1EpT-wrFmjxL3fr2NqTJD9affU5G5I7pXVCnIfa-R3hrb4JzqxrBpZ2Z5nb3kQnhxpVJHtarZPjxnFa2QUGFXzQ', '1417926103', 'file', 'werwe', null);
INSERT INTO `tp_qyfile` VALUES ('54', '25', '1ElSwy7Nghe1b-MBW5DkrRofwFmK9TCqhOg-kb7U_NjrYEWTPyUp0hhd-CwrgzEUvd5OlJ5H-v0kRPiGaaFJzAA', '1417927102', 'file', 'werwer', 'D:/wwwroot/xing--bac/qy.demo/TempFile/file/ktbr4v1417927095.html');
INSERT INTO `tp_qyfile` VALUES ('56', '25', '11RvQtko1h_iCGLrCwHOkyCGhPpMDhHwyE7BGYYl4-2bv4BabYu4o8L0C5Jx94jYC', '1417936150', 'file', '新建文本文档.txt', 'D:/wwwroot/xing--bac/qy.demo/TempFile/file/IlX1eS1417936144.txt');
INSERT INTO `tp_qyfile` VALUES ('58', '25', '1FakGn5gpkML3frRD51gIKczWynYbqWEORfecpvH6aPgR_BhhsWkcHDxvtwI05Vf2EcPKibS9oI8VU6Qb7jlLSg', '1417941659', 'voice', '5992698.mp3', 'D:/wwwroot/xing--bac/qy.demo/TempFile/voice/AYatpy1417941653.mp3');
INSERT INTO `tp_qyfile` VALUES ('59', '25', '1vqLSpptKvOt7VqTQxoLD9SNBsVM2M3UG2i7044W8834pirV7HuU1q1yMazA2cVYPy9EY8dPAFgsRvMYt4Qkvdw', '1417943973', 'voice', '5992698.mp3', 'D:/wwwroot/xing--bac/qy.demo/TempFile/voice/iZn4sR1417943965.mp3');
INSERT INTO `tp_qyfile` VALUES ('60', '25', '1q-4nilAb2QAYEE7RbAI5_pGgXVNtEBT-OQXwVadMEoeYRWRVeiJDNtxfxzhB73wQjoeuUHHxmbGf9FxcuIs9Jg', '1417926052', 'vidio', 'vodiesss', null);
INSERT INTO `tp_qyfile` VALUES ('61', '25', '15L7nTKeC19Gv9zip5XlN4-DCxDidNjBg7vUkIuNCRuwKWKTQe8H6N6SWuknGUzGe', '1417949872', 'file', '开发者文档.doc', 'D:/wwwroot/xing--bac/qy.demo/TempFile/file/jT0FOV1417949865.doc');
INSERT INTO `tp_qyfile` VALUES ('64', '25', '1ss9Jq_-hxFtGUUASEFXHVkquuEiKlcU7EIxDdde2LV7TJeVAk98YMB4bqEFPYp3a', '1419133939', 'file', '12.txt', 'D:/wwwroot/xing--bac/qy.demo/TempFile/file/QhkfGK1419133918.txt');
INSERT INTO `tp_qyfile` VALUES ('66', '25', '1_cVSi6RqXE9WyuTbfymTUZHI2f2EmO1wCCUAZvUu4o7-XuwxW6Q2890fZhmkx0vK', '1421403015', 'file', '2342.txt', 'D:/WWW/qy/TempFile/file/EELpl41421403013.txt');
INSERT INTO `tp_qyfile` VALUES ('67', '25', '1hyLoc6CgBXrk1l2jBKx42IuFVhzNwUkQ_ID7qlWIGXuFe5NS0IbDIt4vgOT9M5Mu', '1429014170', 'voice', '微信服务合同（广西）.mp3', 'D:/WWW/qy/TempFile/voice/ACorwD1429014168.mp3');
INSERT INTO `tp_qyfile` VALUES ('68', '25', '1hvQWorjhdiQF8HDzze7Rq_EmUDd5FnOJrCnuEepC9zkJC1a8XE1Z7U8cI4dxDYOJMuZPoY4jBs4TL03xM3Chaw', '1429014354', 'vidio', 'a:2:{s:5:\"title\";N;s:11:\"description\";N;}', 'D:/WWW/qy/TempFile/file/SRo4QK1429014352.rm');
INSERT INTO `tp_qyfile` VALUES ('69', '25', '1qmAIO86STLH0TV-qxmmXqZbmtTGDcVepN-Eq3qFf2SA08aZXTTiu4c01ef1R_stn', '1429197213', 'vidio', 'a:2:{s:5:\"title\";N;s:11:\"description\";N;}', 'D:/WWW/qy/TempFile/file/olSuUv1429197211.rm');
INSERT INTO `tp_qyfile` VALUES ('70', '25', '12tte31bUtv6FMx2uG8CAeg_qq2xtIzODAyttt8MDX1152hS6FX7ZAqOz2-hkSPL-', '1429197423', 'vidio', 'a:2:{s:5:\"title\";N;s:11:\"description\";N;}', 'D:/WWW/qy/TempFile/file/5GmMJN1429197421.rm');
INSERT INTO `tp_qyfile` VALUES ('71', '25', '1X26s44b5WEzSzXhI8nlQT_V7bbviEfp1W9-dyBLV540bYViuZJzS-yhGZPb4a-do0q1A0HQeZ-uwOkjdC6k98g', '1429197641', 'vidio', 'a:2:{s:5:\"title\";N;s:11:\"description\";N;}', 'D:/WWW/qy/TempFile/file/H9aRBM1429197639.rm');
INSERT INTO `tp_qyfile` VALUES ('72', '25', '1y8tBtZRaG2ANjEDkTgelF9rlke924TKoa2oYotp1j1Up-kPR24a4-Iu82nRCmj0v5U213T_jkic_vJT6aY3u1g', '1429197748', 'vidio', 'a:2:{s:5:\"title\";s:0:\"\";s:11:\"description\";N;}', 'D:/WWW/qy/TempFile/file/4FR3U61429197746.rm');
INSERT INTO `tp_qyfile` VALUES ('73', '25', '1atkTKl83-IKb0xWMx8Ipz_uGa_5jzIbWQSAdBafyMF3lwBya5As1A6t3Z6_Q02ybLFCQNWqeNnWtn4EOOtPE3Q', '1429197813', 'vidio', 'a:2:{s:5:\"title\";s:0:\"\";s:11:\"description\";N;}', 'D:/WWW/qy/TempFile/file/RaLQS11429197811.rm');
INSERT INTO `tp_qyfile` VALUES ('74', '25', '10NH0VrXSqGM--ug2A7r8LRD6n3aBSSyGfpoPW_95IJc4yySKO8cI3ksitjnYRaV8', '1429197960', 'vidio', 'a:2:{s:5:\"title\";s:0:\"\";s:11:\"description\";N;}', 'D:/WWW/qy/TempFile/file/6aczwl1429197958.rm');
INSERT INTO `tp_qyfile` VALUES ('75', '25', '18MJxFzR7CA8h_7ZulFQnbr5iV0-NcqjcVybCRaZize3v4hk_JQ-S5oqcV0FS0qEQ', '1429198205', 'vidio', '微信服务合同（广西）.rm', 'D:/WWW/qy/TempFile/file/I2i6PV1429198202.rm');

-- ----------------------------
-- Table structure for `tp_qyflash`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyflash`;
CREATE TABLE `tp_qyflash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `img` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `info` varchar(90) NOT NULL,
  `tip` tinyint(1) NOT NULL COMMENT '1幻灯片2轮播图',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='3g网站头部flash';

-- ----------------------------
-- Records of tp_qyflash
-- ----------------------------
INSERT INTO `tp_qyflash` VALUES ('3', '25', 'http://qy.wxopen.cn/TempFile/admin/image/20141216141148685.jpg', '', '呵呵几句话就看见对方股份', '1');
INSERT INTO `tp_qyflash` VALUES ('4', '25', 'http://qy.wxopen.cn/TempFile/admin/image/20141216141741724.jpg', '', '好好计划将加快加快规划局', '2');
INSERT INTO `tp_qyflash` VALUES ('5', '25', 'http://qy.wxopen.cn/TempFile/admin/image/20141220184437183.jpg', '', '发的风格', '1');
INSERT INTO `tp_qyflash` VALUES ('6', '25', 'http://qy.wxopen.cn/TempFile/admin/image/20141220184753766.jpg', '', '发送大幅度东方舵手', '1');
INSERT INTO `tp_qyflash` VALUES ('7', '25', 'http://qy.wxopen.cn/TempFile/admin/image/20141220184819147.jpg', '', '和发个和就可和就可', '1');
INSERT INTO `tp_qyflash` VALUES ('8', '25', 'http://qy.wxopen.cn/TempFile/admin/image/20141220184845503.jpg', '', '飞过海飞过海搞活', '1');
INSERT INTO `tp_qyflash` VALUES ('9', '25', 'http://qy.wxopen.cn/TempFile/admin/image/20141220184904521.jpg', '', '风格和规划和就高考', '1');
INSERT INTO `tp_qyflash` VALUES ('10', '25', 'http://qy.wxopen.cn/TempFile/admin/image/20141220184935757.jpg', '', '仿佛换个环境', '2');
INSERT INTO `tp_qyflash` VALUES ('11', '25', 'http://qy.wxopen.cn/TempFile/admin/image/20141220185008623.jpg', '', '很久很久很久客户均可', '2');
INSERT INTO `tp_qyflash` VALUES ('12', '25', 'http://qy.wxopen.cn/TempFile/admin/image/20141220185027894.jpg', '', '共和国换个环境和空间', '2');
INSERT INTO `tp_qyflash` VALUES ('13', '25', 'http://qy.wxopen.cn/TempFile/admin/image/20141220185059443.jpg', '', '好好计划款和高化工', '2');

-- ----------------------------
-- Table structure for `tp_qyhiring_default`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyhiring_default`;
CREATE TABLE `tp_qyhiring_default` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `defaultemail` varchar(100) NOT NULL COMMENT '默认设置邮箱',
  `defaultfill` text NOT NULL COMMENT '默认填写项',
  `defaultreward` text NOT NULL,
  `reward_sum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='招聘默认设置表';

-- ----------------------------
-- Records of tp_qyhiring_default
-- ----------------------------
INSERT INTO `tp_qyhiring_default` VALUES ('6', '25', 'a:2:{s:5:\"value\";s:10:\"123@qq.com\";s:6:\"status\";s:2:\"on\";}', 'a:3:{s:6:\"status\";s:2:\"on\";s:7:\"default\";a:8:{i:1;a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:6:\"性别\";}i:2;a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:6:\"年龄\";}i:3;a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"期望月薪\";}i:4;a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"现居住地\";}i:5;a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:6:\"学历\";}i:6;a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:6:\"邮箱\";}i:7;a:1:{s:4:\"name\";s:12:\"工作年限\";}i:8;a:1:{s:4:\"name\";s:9:\"现职位\";}}s:3:\"add\";a:3:{i:0;a:1:{s:4:\"name\";s:6:\"民族\";}i:1;a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:12:\"通讯地址\";}i:2;a:2:{s:6:\"status\";s:2:\"on\";s:4:\"name\";s:6:\"性格\";}}}', 'a:2:{s:5:\"value\";a:8:{s:11:\"ndepartment\";s:6:\"王总\";s:6:\"notice\";s:2:\"on\";s:6:\"shares\";s:1:\"1\";s:8:\"shareset\";s:1:\"0\";s:6:\"resume\";s:1:\"1\";s:9:\"resumeset\";s:3:\"100\";s:8:\"employed\";s:1:\"1\";s:11:\"employedset\";s:2:\"20\";}s:6:\"status\";s:2:\"on\";}', '199');

-- ----------------------------
-- Table structure for `tp_qyhiring_pay`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyhiring_pay`;
CREATE TABLE `tp_qyhiring_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(32) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '提现状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyhiring_pay
-- ----------------------------
INSERT INTO `tp_qyhiring_pay` VALUES ('7', '25', 'xtzlyp', '1418983041', '100', '0');
INSERT INTO `tp_qyhiring_pay` VALUES ('8', '25', 'xtzlyp', '1418983337', '100', '1');
INSERT INTO `tp_qyhiring_pay` VALUES ('9', '25', 'qiancheng', '1426845323', '100', '1');
INSERT INTO `tp_qyhiring_pay` VALUES ('10', '25', '0033', '1427871364', '100', '0');
INSERT INTO `tp_qyhiring_pay` VALUES ('11', '25', '791344275', '1428635899', '100', '0');

-- ----------------------------
-- Table structure for `tp_qyhiring_position`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyhiring_position`;
CREATE TABLE `tp_qyhiring_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `postname` varchar(100) NOT NULL DEFAULT '' COMMENT '招聘职位名称',
  `department` varchar(100) NOT NULL DEFAULT '' COMMENT '所属部门',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1发布中2未发布3已暂停4已结束',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '招聘人数',
  `place` varchar(100) NOT NULL DEFAULT '' COMMENT '工作地点',
  `salary` varchar(100) NOT NULL DEFAULT '' COMMENT '薪资待遇',
  `nature` varchar(200) DEFAULT '' COMMENT '工作性质',
  `education` int(10) DEFAULT '0' COMMENT '学历要求',
  `experience` varchar(200) DEFAULT '' COMMENT '工作经验',
  `experience1` int(10) DEFAULT '0',
  `experience2` int(10) DEFAULT '0',
  `manage` varchar(200) DEFAULT '' COMMENT '0无需管理经验1需要管理经验',
  `info` varchar(200) DEFAULT '' COMMENT '职位描述',
  `email` varchar(200) DEFAULT '' COMMENT '接收简历邮箱',
  `ndepartment` varchar(200) DEFAULT '' COMMENT '通知员工',
  `notice` varchar(200) DEFAULT '' COMMENT '开启系统告知0不开启1开启',
  `shares` tinyint(1) NOT NULL DEFAULT '0' COMMENT '分享悬赏：0随机红包1自定义2不给红包',
  `shareset` int(11) NOT NULL DEFAULT '0' COMMENT '分享悬赏金额上限',
  `resume` tinyint(1) NOT NULL DEFAULT '0' COMMENT '收到简历悬赏0随机红包1自定义2不给红包',
  `resumeset` int(11) NOT NULL DEFAULT '0' COMMENT '收到简历悬赏金额上限',
  `employed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '成功录用悬赏：0随机红包1自定义',
  `employedset` int(11) NOT NULL DEFAULT '0' COMMENT '成功录用悬赏金额上限',
  `applypost` varchar(200) NOT NULL DEFAULT '' COMMENT '申请职位填写项',
  `resume_num` int(11) NOT NULL DEFAULT '0' COMMENT '投递简历数',
  `disorder` int(11) NOT NULL DEFAULT '0' COMMENT '排序序号',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `end_time` int(10) NOT NULL DEFAULT '0' COMMENT '结束时间',
  `salary1` int(10) DEFAULT '0' COMMENT '自定义工资范围',
  `salary2` int(10) DEFAULT '0' COMMENT '自定义工资范围',
  `defaultemail` varchar(100) DEFAULT '' COMMENT '默认邮箱',
  `defaultreward` text COMMENT '悬赏',
  `defaultfill` text COMMENT '默认申请职位的填写项',
  `defaultaddfill` text COMMENT '自定义添加',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='招聘职位表';

-- ----------------------------
-- Records of tp_qyhiring_position
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyhiring_resume`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyhiring_resume`;
CREATE TABLE `tp_qyhiring_resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL COMMENT '姓名',
  `referees` varchar(60) DEFAULT NULL COMMENT '推荐人',
  `position` varchar(60) DEFAULT NULL COMMENT '应聘职位',
  `telphone` varchar(60) DEFAULT NULL COMMENT '联系电话',
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1已读2未读',
  `is_collect` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1收藏2不收藏',
  `is_employed` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1录用2不录用3审核中',
  `time` int(10) DEFAULT NULL COMMENT '投递时间',
  `pid` int(11) DEFAULT NULL COMMENT '职位id',
  `wecha_id` varchar(32) DEFAULT NULL COMMENT '推荐人',
  `sex` tinyint(1) DEFAULT NULL,
  `age` tinyint(2) DEFAULT NULL,
  `salary` tinyint(4) DEFAULT NULL,
  `img` text,
  `year` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='简历管理表';

-- ----------------------------
-- Records of tp_qyhiring_resume
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyhiring_reward`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyhiring_reward`;
CREATE TABLE `tp_qyhiring_reward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL COMMENT '姓名',
  `department` varchar(200) DEFAULT NULL COMMENT '部门',
  `telphone` varchar(60) DEFAULT NULL COMMENT '联系电话',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态未体现',
  `event` text COMMENT '悬赏事件',
  `money` int(10) DEFAULT NULL COMMENT '悬赏金额',
  `time` int(10) DEFAULT NULL COMMENT '悬赏时间',
  `wecha_id` varchar(32) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1' COMMENT '赏金类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='赏金管理表';

-- ----------------------------
-- Records of tp_qyhiring_reward
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyhiring_withdrawal`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyhiring_withdrawal`;
CREATE TABLE `tp_qyhiring_withdrawal` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL COMMENT '姓名',
  `department` varchar(200) DEFAULT NULL COMMENT '部门',
  `telphone` varchar(60) DEFAULT NULL COMMENT '联系电话',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1待审核2已通过待兑现3已兑现4被驳回',
  `money` decimal(10,2) DEFAULT NULL COMMENT '提现金额',
  `time` int(10) DEFAULT NULL COMMENT '提现时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='提现管理表';

-- ----------------------------
-- Records of tp_qyhiring_withdrawal
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyhome`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyhome`;
CREATE TABLE `tp_qyhome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `picurl` varchar(120) NOT NULL,
  `info` varchar(120) NOT NULL,
  `plugmenucolor` varchar(10) NOT NULL,
  `copyright` varchar(200) NOT NULL,
  `homeurl` varchar(300) NOT NULL,
  `advancetpl` tinyint(1) NOT NULL DEFAULT '0',
  `dianhua` varchar(20) NOT NULL,
  `musicurl` varchar(300) NOT NULL,
  `radiogroup` mediumint(3) NOT NULL,
  `tpltypeid` varchar(20) NOT NULL DEFAULT '1',
  `tpltypename` varchar(20) NOT NULL,
  `tpllistid` varchar(20) NOT NULL,
  `tpllistname` varchar(20) NOT NULL,
  `tplcontentid` varchar(20) NOT NULL,
  `tplcontentname` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyhome
-- ----------------------------
INSERT INTO `tp_qyhome` VALUES ('1', '25', '', '', '', '', 'aaa', 'http://qy.wxopen.cn/TempFile/admin/image/20141216113955630.jpg', '0', 'aaa', 'aaa', '0', '24', 'tpl8', '17', 'list001', '14', 'content004');
INSERT INTO `tp_qyhome` VALUES ('2', '138', '', '', '', '', '点赞科技', 'http://qy.wxopen.cn/TempFile/admin/image/20141219173108451.jpg', '0', '6730610', '', '0', '2', 'tpl2', '7', 'tpl7', '11', 'tpl11');

-- ----------------------------
-- Table structure for `tp_qyhome_setting`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyhome_setting`;
CREATE TABLE `tp_qyhome_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL COMMENT '网站标题',
  `pic` varchar(30) NOT NULL COMMENT '网站图片',
  `tpl` varchar(30) NOT NULL COMMENT '网站模板',
  `telphone` varchar(30) NOT NULL COMMENT '联系方式',
  `rights` varchar(30) NOT NULL COMMENT '底部版权',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `info` text COMMENT '3G网站介绍',
  `defaulttpl` int(10) NOT NULL DEFAULT '1',
  `tpl_index` varchar(60) DEFAULT NULL,
  `tpl_list` varchar(60) DEFAULT NULL,
  `tpl_show` varchar(60) DEFAULT NULL,
  `focus` varchar(255) DEFAULT NULL,
  `musicurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='3G网站设置';

-- ----------------------------
-- Records of tp_qyhome_setting
-- ----------------------------
INSERT INTO `tp_qyhome_setting` VALUES ('1', '25', '微易科技', 'http://qy.wxopen.cn/TempFile/a', '', '3G官网', '3G官网', '1', '3G官网', '1', null, null, null, null, null);

-- ----------------------------
-- Table structure for `tp_qyhome_tpl`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyhome_tpl`;
CREATE TABLE `tp_qyhome_tpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL COMMENT '3G模板名称',
  `type` tinyint(1) NOT NULL COMMENT '1首页模板2列表页模板3内容模板',
  `thumb` varchar(300) NOT NULL COMMENT '3G模板图片地址',
  `action` varchar(200) DEFAULT NULL COMMENT '3G网站模板',
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='3G模板';

-- ----------------------------
-- Records of tp_qyhome_tpl
-- ----------------------------
INSERT INTO `tp_qyhome_tpl` VALUES ('11', '模板11', '3', 'http://dexingky.wxopen.cn/Static/thumb/thumb_content001.png', 'content001', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('12', '模板12', '3', 'http://dexingky.wxopen.cn/Static/thumb/thumb_content002.png', 'content002', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('13', '模板13', '3', 'http://dexingky.wxopen.cn/Static/thumb/thumb_content003.png', 'content003', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('14', '模板14', '3', 'http://dexingky.wxopen.cn/Static/thumb/thumb_content004.png', 'content004', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('15', '模板15', '3', 'http://dexingky.wxopen.cn/Static/thumb/thumb_content007.png', 'content007', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('17', '模板6', '2', 'http://dexingky.wxopen.cn/Static/thumb/thumb_list001.png', 'list001', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('18', '模板7', '2', 'http://dexingky.wxopen.cn/Static/thumb/thumb_list002.png', 'list002', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('19', '模板8', '2', 'http://dexingky.wxopen.cn/Static/thumb/thumb_list003.png', 'list003', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('20', '模板9', '2', 'http://dexingky.wxopen.cn/Static/thumb/thumb_list004.png', 'list004', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('21', '模板10', '2', 'http://dexingky.wxopen.cn/Static/thumb/thumb_list005.png', 'list005', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('22', '模板16', '1', 'http://dexingky.wxopen.cn/Static/thumb/thumb_tpl6.png', 'tpl6', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('23', '模板17', '1', 'http://dexingky.wxopen.cn/Static/thumb/thumb_tpl7.png', 'tpl7', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('24', '模板18', '1', 'http://dexingky.wxopen.cn/Static/thumb/thumb_tpl8.png', 'tpl8', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('25', '模板19', '1', 'http://dexingky.wxopen.cn/Static/thumb/thumb_tpl9.png', 'tpl9', '0');
INSERT INTO `tp_qyhome_tpl` VALUES ('26', '模板20', '1', 'http://dexingky.wxopen.cn/Static/thumb/thumb_tpl10.png', 'tpl10', '0');

-- ----------------------------
-- Table structure for `tp_qyimg`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyimg`;
CREATE TABLE `tp_qyimg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `media_id` varchar(255) DEFAULT NULL,
  `created_time` varchar(16) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyimg
-- ----------------------------
INSERT INTO `tp_qyimg` VALUES ('1', '10', '1z3CQF2_Fz5tq2n8bS0oJrfFh7GlH0neH4E-ByVytK2sLtV-pFLJynCDafmSIbSok', '1414568891', 'http://dexingky.wxopen.cn/TempFile/image/20141029154809218.jpg');
INSERT INTO `tp_qyimg` VALUES ('2', '10', '1t_wJMQ93zoN_XR3_GfKWC8pO1GSSdlNzLd6HrAHcCTqWPT5A3N4nhA-CpxcER2XP', '1414569033', 'http://dexingky.wxopen.cn/TempFile/image/20141029155028915.jpg');
INSERT INTO `tp_qyimg` VALUES ('3', '10', '19axoQKkESonWL60Yyfiomp0nTPYrqz4r4uNifgA0a_H98Bqqnzj5BkMNFmWAxUKY', '1414569084', 'http://dexingky.wxopen.cn/TempFile/image/20141029155122520.jpg');
INSERT INTO `tp_qyimg` VALUES ('4', '10', '1z_58b7I2p0IHHvfnnFwwxNqOl3t8GOanoKekMHaizY9mQ9ec53VUnC4EPVblpW_p', '1414569141', 'http://dexingky.wxopen.cn/TempFile/image/20141029155219964.jpg');
INSERT INTO `tp_qyimg` VALUES ('5', '10', '1BFuOX6eOczvOb-3dwK2Nke6lJYBm0mV0voKv8ac7nhwt4Jo4DEAjhBluq3h09Zv5', '1414569248', 'http://dexingky.wxopen.cn/TempFile/image/20141029155405342.jpg');
INSERT INTO `tp_qyimg` VALUES ('6', '10', '1_upU5VBcGFGfh2u9tmg9yOl7T7Z2QFh_iaBe6ZSCKaGtDqSKj0FX9xclydp5x2VK', '1414569285', 'http://dexingky.wxopen.cn/TempFile/image/20141029155443387.jpg');
INSERT INTO `tp_qyimg` VALUES ('7', '10', '1mfVXauJel1yYRnW8t5ZQxvFztkEWkqybyPRjBNkEywZ6uFxFv-swxJUzKvygwO_P', '1414569333', 'http://dexingky.wxopen.cn/TempFile/image/20141029155531593.jpg');
INSERT INTO `tp_qyimg` VALUES ('8', '10', '1f4IOiNdoR_Jifon5yXZrNq4s57XHZGekmZy7X2--jTm_C2PM7Pec3-yEHTC2zkkc', '1414569692', 'http://dexingky.wxopen.cn/TempFile/image/20141029160129682.jpg');
INSERT INTO `tp_qyimg` VALUES ('9', '10', '1WPeyPSNPT0bFZ8ywVt5zmseR9Yn9-E3HXSIq__6w_b9Yx9Av8KCnfqTam9rsGr9f', '1414569868', 'http://dexingky.wxopen.cn/TempFile/image/20141029160425355.jpg');
INSERT INTO `tp_qyimg` VALUES ('10', '10', '1yP_B9L-DdHr7UQqN0HVk1XvxfPxd67_KjXuGgEQUicWuD4HwBI1sem3j44kubcQn', '1414570217', 'http://dexingky.wxopen.cn/TempFile/image/20141029161014333.jpg');
INSERT INTO `tp_qyimg` VALUES ('11', '1', '1RqFhA7oNSE7R6qkBzt8qJU-Xnv-P-skFRvMpsbVlEaOc1c6nOGPRLhG34jUpzW7U', '1414576661', 'http://dexingky.wxopen.cn/TempFile/image/20141029175739123.jpg');
INSERT INTO `tp_qyimg` VALUES ('12', '1', '1P6L-rdduP58VKRFYq7pLBXnDHmgjGLxRYAfpmDaEXrvfJf1caU08y_do0R3y0z90', '1414577021', 'http://dexingky.wxopen.cn/TempFile/image/20141029180337825.jpg');
INSERT INTO `tp_qyimg` VALUES ('13', '1', '1BaVaTJM4H5RZHXClIf2YEUWD7hIQ7RmGfuFX1QXcl81PtBbd4NZY_SgfZrDxmH61', '1414577048', 'http://dexingky.wxopen.cn/TempFile/image/20141029180405741.jpg');
INSERT INTO `tp_qyimg` VALUES ('14', '1', '1FqmnT89bC6YcHD5nUt5_y_JIVRNIUxHMDKR8XA787RyHAsYCUQrl7c7Ds4bQne0x', '1414577059', 'http://dexingky.wxopen.cn/TempFile/image/20141029180416132.jpg');
INSERT INTO `tp_qyimg` VALUES ('15', '1', '1sKCYKkIkBUl4PLK77IOARTx88lirc4JeUk2wD5Z4oUN1QQiDs588RzKgMARbJwDh', '1414577099', 'http://dexingky.wxopen.cn/TempFile/image/20141029180457830.jpg');
INSERT INTO `tp_qyimg` VALUES ('16', '1', '1BRVT9TgofCv1DogC-r41TPiYyw6tPcJFmeZHQO0nHRg7_9zt2GlbSF0YSO6Uuysw', '1414577996', 'http://dexingky.wxopen.cn/TempFile/image/20141029181953416.jpg');
INSERT INTO `tp_qyimg` VALUES ('17', '1', '1ExdjxN3Aya017FEfT7PygLzf_Z90TLCNA5zZyL8vwOkTcPKtS3CUcqtVCRDdU3pO', '1414578024', 'http://dexingky.wxopen.cn/TempFile/image/20141029182021837.jpg');
INSERT INTO `tp_qyimg` VALUES ('18', '1', '1ZXaow5cLlq3dzPqwQwUFguS66YY1B9YBmcJtyw-YT_UstxG82frVuk5yQKoMz_Sq', '1414578129', 'http://dexingky.wxopen.cn/TempFile/image/20141029182206240.jpg');
INSERT INTO `tp_qyimg` VALUES ('19', '1', '11B_spn8C157fPKwTbZj32qJOJ1Eth8gIq0gFKyR7Y85mdkZ7sCR7uaYOjn7d4Hg1', '1414578480', 'http://dexingky.wxopen.cn/TempFile/image/20141029182757110.jpg');
INSERT INTO `tp_qyimg` VALUES ('20', '1', '1Yv9Le4T6RyEa13Ja_TE4K-9cJYioTbO-hy_R0sITgh47uXeL_ARP2F8Uq71lMfYs', '1414578487', 'http://dexingky.wxopen.cn/TempFile/image/20141029182806314.jpg');
INSERT INTO `tp_qyimg` VALUES ('21', '1', '1nbz8TPQYjGXuCO8yM8x-_V9cHRVWUyGIIkQ9wT5ExIWos9p-mgbSxNQgIzc7mLxN', '1414578502', 'http://dexingky.wxopen.cn/TempFile/image/20141029182820908.jpg');
INSERT INTO `tp_qyimg` VALUES ('22', '1', '1JJornzamk2CRbJKQW4em0j1TYLTVYy8D1ArLVa6hlnfG-61KLfB1cM1EuzAywLZb', '1414578543', 'http://dexingky.wxopen.cn/TempFile/image/20141029182900724.jpg');
INSERT INTO `tp_qyimg` VALUES ('23', '1', '1frMAd2QKB7dH4PvKykZDkf_xGUwCWKCLrbaY9joQnzZhoSnPFKw1UQm4KgXwTizb', '1414578626', 'http://dexingky.wxopen.cn/TempFile/image/20141029183023689.jpg');
INSERT INTO `tp_qyimg` VALUES ('24', '1', '1yq73LgfgbvpCgPBSaLnbX0LW1K4fZimC7Oi4mxA78FchhVgu_RctQEUCtxCohh8n', '1414578669', 'http://dexingky.wxopen.cn/TempFile/image/20141029183107765.jpg');
INSERT INTO `tp_qyimg` VALUES ('25', '1', '1iNJ-9009Hpdvdyg-ktnve_JoPTVOrZ0tMXTny9ZqjUSvYMY_vn50zZ6Qi0LHopv7', '1414578811', 'http://dexingky.wxopen.cn/TempFile/image/20141029183328386.jpg');
INSERT INTO `tp_qyimg` VALUES ('26', '1', '1TH2hwsD4r1z7lXNmu59b-oHc-4TTTmjClU5uft6TccQ-_uv7YhUXvr-UmMAGtLTQ', '1414578930', 'http://dexingky.wxopen.cn/TempFile/image/20141029183528171.jpg');
INSERT INTO `tp_qyimg` VALUES ('27', '1', '19GCqzLLkNRrMVAZ9uCJSPRZpEgRWeyQVLo_b6d-dx8C9qp0VCGRXjm8GXYJLbV0B', '1414581334', 'http://dexingky.wxopen.cn/TempFile/image/20141029191531363.jpg');
INSERT INTO `tp_qyimg` VALUES ('28', '1', '15neK_lq6XGkCPjg2wajlGtrLhbKQw8AGnav6R6bN7FRLce7sZUwyNg3elOGdqHwb', '1414582071', 'http://dexingky.wxopen.cn/TempFile/image/20141029192749587.jpg');
INSERT INTO `tp_qyimg` VALUES ('29', '1', '1x-Am45-OUJjp3Ddc4stj3sCQoRQCSMwAPAClJKRiD5aV6JCIDa8bwaS6Z52qMFO-', '1414582392', 'http://dexingky.wxopen.cn/TempFile/image/20141029193309819.jpg');
INSERT INTO `tp_qyimg` VALUES ('30', '10', '1FqtIBwMUNn4rZ02erRJZHqw8l3hlAqW9VEn5fl0R4GvZSqmgwpxY_vjDcvIyGAtY', '1414636131', 'http://dexingky.wxopen.cn/TempFile/image/20141030102843762.jpg');
INSERT INTO `tp_qyimg` VALUES ('31', '1', '1YUgRgqh1ftftcRQFiY-kh5KhHTNHgK7WwLsxFyADlp4ggqSZEy5h8TvMATCPBSv8', '1414637005', 'http://dexingky.wxopen.cn/TempFile/image/20141030104320488.jpg');
INSERT INTO `tp_qyimg` VALUES ('32', '1', '1kKhql34NyF3C5He3ib3CdPDx_Q8mYZxWuoemBi_sJPrXPs4n3U6ExhLWEq0e1DUW', '1414639242', 'http://dexingky.wxopen.cn/TempFile/image/20141030112037289.jpg');
INSERT INTO `tp_qyimg` VALUES ('33', '1', '1V6iAk8JS6HS8BCejUR6td1p9bPrXGgMmsnvJAvZw_lWDPT9iaLfTnNCTerqjUwyU', '1414639328', 'http://dexingky.wxopen.cn/TempFile/image/20141030112204613.jpg');
INSERT INTO `tp_qyimg` VALUES ('34', '1', '17j8x7dgXEGESuIReaQtw4WbJdhP9iFSpsnNEZTAafuW-ib4xouNnC265LLUoucgF', '1414656302', 'http://dexingky.wxopen.cn/TempFile/image/20141030160542121.jpg');
INSERT INTO `tp_qyimg` VALUES ('35', '1', '11Z02RnssX5a56d1Oz8TFjrsSaoL9WPcWPDhmnMn97vsHAUmjxhzyzvQk805opcn0', '1414657649', 'http://dexingky.wxopen.cn/TempFile/image/20141030162812641.jpg');
INSERT INTO `tp_qyimg` VALUES ('36', '1', '1RgGfy8TJuWmzlGkoStqpkAbUTvYIrwSG4-0ANL9U0jdLop0al-3n4AVYFlpzRaU9', '1414837718', 'http://dexingky.wxopen.cn/TempFile/image/20141101182857199.jpg');
INSERT INTO `tp_qyimg` VALUES ('37', '1', '1pAlm2V1WNSlUF9b8ekAiLjxVo6mV7Ru2xndX4kxjoZLL9fLE7iX8HBdbIgEY2vEV', '1414837782', 'http://dexingky.wxopen.cn/TempFile/image/20141101182958311.jpg');
INSERT INTO `tp_qyimg` VALUES ('38', '1', '1qoU3GjALpcrblBl_4A1prztE45zQPexv4xVLhhlkO2HSGldJIaHJNfVV78R9DGCB', '1414837869', 'http://dexingky.wxopen.cn/TempFile/image/20141101183128856.jpg');
INSERT INTO `tp_qyimg` VALUES ('39', '1', '1G0ZmocasxQz0GddP0om5BwTmGATp0_s9CIhvET6uRX6D1jUhdf343lwbhwYgxQ3h', '1414837888', 'http://dexingky.wxopen.cn/TempFile/image/20141101183148833.jpg');
INSERT INTO `tp_qyimg` VALUES ('40', '1', '11zfysatJSu61KXfvOWlXwGh6wlGo_lGCYxdZ9ChwirXn2iL0bUenxMwgj7W9ZLWC', '1414837959', 'http://dexingky.wxopen.cn/TempFile/image/20141101183258495.jpg');
INSERT INTO `tp_qyimg` VALUES ('41', '1', null, null, 'http://dexingky.wxopen.cn/TempFile/image/20141101183848292.jpg');
INSERT INTO `tp_qyimg` VALUES ('42', '1', '1AuYSoxI2yqKqg-Kwq4HjTUtRJFvpTZ5bFq4UbmqvZDVic4JQEvVetfOc8FfXguqg', '1414838474', 'http://dexingky.wxopen.cn/TempFile/image/20141101184129113.jpg');
INSERT INTO `tp_qyimg` VALUES ('43', '1', '1mOEF0qCcgH4GePqIILrlEhbyy7nQUJ4tJilkuAR8qpUGfp3ZxOmOQAfUEcwRgQsj', '1415249199', 'http://dexingky.wxopen.cn/TempFile/image/20141106124631921.jpg');
INSERT INTO `tp_qyimg` VALUES ('44', '1', '1GHn43lr4jnwmXXMIH9o85hARmqHCBfFvfPH3e_tYpE5q-HTgqC7atGCHQfxJI6Jn', '1415249521', 'http://dexingky.wxopen.cn/TempFile/image/20141106125151297.jpg');
INSERT INTO `tp_qyimg` VALUES ('45', '1', '1_g65OSWuU1JibM2qDjypDJXWAAqT2ql2TzEm7DMxwj8dvLgoyE1W3r5XcHGQTTCd', '1415249576', 'http://dexingky.wxopen.cn/TempFile/image/20141106125248303.jpg');
INSERT INTO `tp_qyimg` VALUES ('46', '1', '1mRE687mWOa6gxtRJnWoLvtd0mgqZkcrt8xx8NX51VEbtMnRwbBWYlVz6l6KtsdNx', '1415617078', 'http://dexingky.wxopen.cn/TempFile/image/20141110185741337.jpg');
INSERT INTO `tp_qyimg` VALUES ('47', '1', '1n-p1T13Nyjp2R7mZkQaaIxj_2SQe9NGwi4JMB7ivFXSSy_HhUm94gp-iSMTlig5nuO_FHoLN8QGgE1ToPoZJZQ', '1415617101', 'http://dexingky.wxopen.cn/TempFile/image/20141110185803599.jpg');
INSERT INTO `tp_qyimg` VALUES ('48', '1', '19er-W_7_iX6tRGnyDPGJxacer-JvIRO3e77cE5gHV_fMiHuD7oIY0PBZdoZXUofN', '1416328255', 'http://dexingky.wxopen.cn/TempFile/image/20141119003021493.jpg');
INSERT INTO `tp_qyimg` VALUES ('49', '1', '1Qr9s08FyOEK1OOBnOOCx912XupkxFRxnukBOy5SlMYBXrlTp46ReNkBDZNFmT2-Q', '1416328377', 'http://dexingky.wxopen.cn/TempFile/image/20141119003223115.jpg');
INSERT INTO `tp_qyimg` VALUES ('50', '25', '1bVSr3sfnCL8jEMA753rX8xoduY0Zc7a_tKr9GrY7WUwftK4mhrlprZA5bcWaWt6l', '1417085634', 'http://dexingky.wxopen.cn/TempFile/image/20141127185418113.jpg');
INSERT INTO `tp_qyimg` VALUES ('51', '25', '1c1LRp4RTn_9bpuzWcLnvAbXP2YfAnJ-apctUEWtmi9yLw8rjKAGnULij8JK-OZyF', '1417924485', 'http://qy.wxopen.cn/TempFile/image/20141207115439885.jpg');
INSERT INTO `tp_qyimg` VALUES ('52', '25', '13DsiIfQa6W0TChh_RLoO3RoCy3wd5DFPLwhNlwAIvQf09zM-uoglQBym_9Q5h2Wj', '1417932900', 'http://qy.wxopen.cn/TempFile/image/20141207141453631.jpg');
INSERT INTO `tp_qyimg` VALUES ('53', '25', '1tMwpAzoyuK0_PI0xa8ZOp24XVHlrqhgp61QWxnM7sOyoMgtQwB_wbyBf-LKxWfri', '1417932915', 'http://qy.wxopen.cn/TempFile/image/20141207141508251.jpg');
INSERT INTO `tp_qyimg` VALUES ('54', '25', '1mqUb4CK4me7SmmEVAQwJyOj1ssCI-G7ZJJLBlB83VKI_h98s5M1NSpId1lynEM7h', '1417932938', 'http://qy.wxopen.cn/TempFile/image/20141207141531197.jpg');
INSERT INTO `tp_qyimg` VALUES ('55', '25', '1u7usTU68QUkWMUVCsxcTtNNX1o0qJXMhPV3CKUgbE4AuWKA7QYp-sj_1gynvqmEq', '1417933065', 'http://qy.wxopen.cn/TempFile/image/20141207141739979.jpg');
INSERT INTO `tp_qyimg` VALUES ('56', '25', '1vr3r6Ua2td-QiPdsHlI-WCTYBdqRO43knzCGnAR1t4blhHyIDjjLiDtqSUJ0mY8R', '1417933190', 'http://qy.wxopen.cn/TempFile/image/20141207141944236.jpg');
INSERT INTO `tp_qyimg` VALUES ('57', '25', '1xpFWfhvSGA3cGdCP8F4eRZAqos9elx4kI2IuXPakO4KNtB4-zvwLEc6OlROuTAQC', '1417933208', 'http://qy.wxopen.cn/TempFile/image/20141207142001450.jpg');
INSERT INTO `tp_qyimg` VALUES ('58', '25', '1eXHp21JmJCs-F8MBYftRhRUwuJiDAPRYjq6miGnV8peKbx43yk2uluoOykCrpPzk', '1417933238', 'http://qy.wxopen.cn/TempFile/image/20141207142032707.jpg');
INSERT INTO `tp_qyimg` VALUES ('59', '25', '15Zli1nBWLm9qKBerniX5n3gcpLUg8REV_N_uvxgPNGfcwr1Vb9wDYA-jKot4hZDG', '1417936419', 'http://qy.wxopen.cn/TempFile/image/20141207151332792.jpg');
INSERT INTO `tp_qyimg` VALUES ('60', '25', '1w11nwxbpul6c-_YRrCdjuZ8ba3V5dyL2N0o7fVtgBO1F_gul4DUUFgmT9jHSfwWW', '1417936583', 'http://qy.wxopen.cn/TempFile/image/20141207151617378.jpg');
INSERT INTO `tp_qyimg` VALUES ('61', '25', '1tJGUfZhqE9B2pcdl_hF5JhUf8nBVfo5yV3WNdbkoprv2JPACLBh0obiqoNBQ5ggy', '1417936906', 'http://qy.wxopen.cn/TempFile/image/20141207152139216.jpg');
INSERT INTO `tp_qyimg` VALUES ('62', '25', '1Fse1t6gva1-wDQvMJL_k5RZ34HQyuLJBXdyYaE6WNXlfA5lBS0iCWQuakUWhkMhs', '1417937027', 'http://qy.wxopen.cn/TempFile/image/20141207152340624.jpg');
INSERT INTO `tp_qyimg` VALUES ('63', '25', '1S209P-pqcoIoBjNfscp2UntzJrhtFnPk3pcT_np0dEgcU8tUUKaVL1-Jy6itbGbp', '1417937296', 'http://qy.wxopen.cn/TempFile/image/20141207152809575.jpg');
INSERT INTO `tp_qyimg` VALUES ('64', '25', '1Kyv7jAxc46XLANRWIB7zVdiZfGe4-DztKHdoTBOrUJDEFrKFsAKu-pgmW1rDyMiv', '1417937379', 'http://qy.wxopen.cn/TempFile/image/20141207152932765.jpg');
INSERT INTO `tp_qyimg` VALUES ('65', '25', '1LNpWJHICNfs7qYtVcehYkveCJHNVvrs3-bMpuuYfyTg7JURCV-Xer7TGTDg5F6_D', '1417940456', 'http://qy.wxopen.cn/TempFile/image/20141207162049996.jpg');
INSERT INTO `tp_qyimg` VALUES ('66', '229', '1CAp1aUvaNEwgRYj--odBCQy1B5N_vCrobBZG-rNkSgeqWyyx21SGLMnz19VzSrSk', '1423448093', 'http://qy.workweixin.com/TempFile/image/20150209101449542.jpg');
INSERT INTO `tp_qyimg` VALUES ('67', '229', '1ZDlaFUuU9V5bDPfvx-N9XV-j8fQSPuq7c6vJwUkPnpqUi5zkAgfynmuLf0DMlEH0', '1423448845', 'http://qy.workweixin.com/TempFile/image/20150209102720925.jpg');
INSERT INTO `tp_qyimg` VALUES ('68', '229', '16o3xipwgRxbSqZ9GTi0kMB-JZ57IGB5YUnWktPwyx9JeOwOHLxtd_3u1rCxTWihv', '1423448904', 'http://qy.workweixin.com/TempFile/image/20150209102819307.jpg');
INSERT INTO `tp_qyimg` VALUES ('69', '25', '1_FXW4mSftxPT21yiQj-TzqG-OTr9s1_BgiZO9sS7ghHcR9LPTXT-u0RADTdLEB2Z', '1429006199', 'http://qy.workweixin.com/TempFile/image/20150414180957384.jpg');

-- ----------------------------
-- Table structure for `tp_qyimgnews`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyimgnews`;
CREATE TABLE `tp_qyimgnews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(64) DEFAULT NULL,
  `pic` varchar(300) DEFAULT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `author` varchar(64) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `content` text,
  `type` tinyint(1) DEFAULT NULL,
  `pid` int(11) DEFAULT '0',
  `time` varchar(16) DEFAULT NULL,
  `times` tinyint(4) DEFAULT '0' COMMENT '发送次数',
  `thumb_media_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyimgnews
-- ----------------------------
INSERT INTO `tp_qyimgnews` VALUES ('9', '1', '我们服务器是不是又有问题了？', 'http://dexingky.wxopen.cn/TempFile/image/20141106125248303.jpg', '我们服务器是不', '234234', '534534', '<p>为日日日日日日日日日日日日日日</p>', null, '0', '1415249579', '0', '1_g65OSWuU1JibM2qDjypDJXWAAqT2ql2TzEm7DMxwj8dvLgoyE1W3r5XcHGQTTCd');
INSERT INTO `tp_qyimgnews` VALUES ('10', '1', '233453453', 'http://dexingky.wxopen.cn/TempFile/image/20141119003021493.jpg', '345345', '345', '34534', '<p>345345345345</p>', null, '0', '1416328236', '0', '19er-W_7_iX6tRGnyDPGJxacer-JvIRO3e77cE5gHV_fMiHuD7oIY0PBZdoZXUofN');
INSERT INTO `tp_qyimgnews` VALUES ('11', '25', 'rfwerwer', 'http://dexingky.wxopen.cn/TempFile/image/20141127185418113.jpg', 'werwer', 'dasdas', 'sdfsdfds', '<p>sdsdfsdfsdf</p>', null, '0', '1417085667', '0', '1bVSr3sfnCL8jEMA753rX8xoduY0Zc7a_tKr9GrY7WUwftK4mhrlprZA5bcWaWt6l');
INSERT INTO `tp_qyimgnews` VALUES ('12', '25', '3333', '3333', '3333', '333', '333', '3333', null, '0', '1429014482', '0', null);

-- ----------------------------
-- Table structure for `tp_qyknow_collect`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyknow_collect`;
CREATE TABLE `tp_qyknow_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL,
  `name` varchar(48) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `uid` int(11) NOT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyknow_collect
-- ----------------------------
INSERT INTO `tp_qyknow_collect` VALUES ('135', '28', '0033', '25', '1', '230', '1429521010');
INSERT INTO `tp_qyknow_collect` VALUES ('134', '30', 'lanrain', '25', '1', '29', '1429520719');

-- ----------------------------
-- Table structure for `tp_qyknow_feed`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyknow_feed`;
CREATE TABLE `tp_qyknow_feed` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `info` varchar(300) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `file_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyknow_feed
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyknow_files`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyknow_files`;
CREATE TABLE `tp_qyknow_files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `ctime` int(11) NOT NULL,
  `power` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` varchar(60) NOT NULL,
  `display` tinyint(1) NOT NULL,
  `url` varchar(300) NOT NULL,
  `info` text NOT NULL,
  `folder_id` int(11) NOT NULL,
  `furl` varchar(300) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `size` float DEFAULT NULL,
  `img_path` varchar(300) DEFAULT NULL,
  `created_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyknow_files
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyknow_folder`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyknow_folder`;
CREATE TABLE `tp_qyknow_folder` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` varchar(60) NOT NULL,
  `power` tinyint(1) DEFAULT NULL,
  `ctime` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `display` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyknow_folder
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyknow_record`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyknow_record`;
CREATE TABLE `tp_qyknow_record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `feed` int(11) DEFAULT '0',
  `praise` int(11) DEFAULT '0',
  `collect` int(11) DEFAULT '0',
  `relay` int(11) DEFAULT '0',
  `download` int(11) DEFAULT '0',
  `files_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyknow_record
-- ----------------------------
INSERT INTO `tp_qyknow_record` VALUES ('11', '0', '3', '4', '0', '0', '25', '233');
INSERT INTO `tp_qyknow_record` VALUES ('12', '0', '28', '28', '0', '0', '26', '25');
INSERT INTO `tp_qyknow_record` VALUES ('13', '0', '1', '6', '0', '0', '27', '25');
INSERT INTO `tp_qyknow_record` VALUES ('14', '0', '5', '17', '0', '0', '28', '25');
INSERT INTO `tp_qyknow_record` VALUES ('15', '0', '10', '18', '0', '0', '29', '25');
INSERT INTO `tp_qyknow_record` VALUES ('16', '0', '5', '11', '0', '0', '30', '25');

-- ----------------------------
-- Table structure for `tp_qyleave_check`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyleave_check`;
CREATE TABLE `tp_qyleave_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_one` varchar(100) DEFAULT NULL COMMENT '提交请假的人',
  `user_two` varchar(100) DEFAULT NULL COMMENT '审核人',
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0为未审核1为审核2为驳回',
  `pid` int(11) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0' COMMENT '1为审核通过2为拒绝',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=208 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyleave_check
-- ----------------------------
INSERT INTO `tp_qyleave_check` VALUES ('140', 'xtzlyp', 'xtzlyp', '25', '1', '70', '1422693295', '0');
INSERT INTO `tp_qyleave_check` VALUES ('141', 'xtzlyp', 'lanrain', '25', '0', '70', '1422692721', '0');
INSERT INTO `tp_qyleave_check` VALUES ('142', 'xtzlyp', 'xtzlyp', '25', '2', '71', '1422693377', '0');
INSERT INTO `tp_qyleave_check` VALUES ('143', 'xtzlyp', 'lanrain', '25', '0', '71', '1422693367', '0');
INSERT INTO `tp_qyleave_check` VALUES ('144', '270636852', 'wangming', '25', '0', '72', '1423276940', '0');
INSERT INTO `tp_qyleave_check` VALUES ('145', '270636852', 'xtzlyp', '25', '0', '72', '1423276940', '0');
INSERT INTO `tp_qyleave_check` VALUES ('146', '270636852', 'lanrain', '25', '0', '72', '1423276940', '0');
INSERT INTO `tp_qyleave_check` VALUES ('147', '270636852', 'wangming', '25', '0', '73', '1423623052', '0');
INSERT INTO `tp_qyleave_check` VALUES ('148', '270636852', 'xtzlyp', '25', '0', '73', '1423623052', '0');
INSERT INTO `tp_qyleave_check` VALUES ('149', '270636852', 'lanrain', '25', '0', '73', '1423623052', '0');
INSERT INTO `tp_qyleave_check` VALUES ('150', '270636852', 'wangming', '25', '0', '74', '1423708827', '0');
INSERT INTO `tp_qyleave_check` VALUES ('151', '270636852', 'xtzlyp', '25', '0', '74', '1423708827', '0');
INSERT INTO `tp_qyleave_check` VALUES ('152', '270636852', 'lanrain', '25', '0', '74', '1423708827', '0');
INSERT INTO `tp_qyleave_check` VALUES ('153', 'li_jun_6', 'xtzlyp', '25', '0', '75', '1426213378', '0');
INSERT INTO `tp_qyleave_check` VALUES ('154', 'li_jun_6', 'lanrain', '25', '0', '75', '1426213378', '0');
INSERT INTO `tp_qyleave_check` VALUES ('155', 'li_jun_6', 'xtzlyp', '25', '0', '76', '1426324464', '0');
INSERT INTO `tp_qyleave_check` VALUES ('156', 'li_jun_6', 'lanrain', '25', '0', '76', '1426324464', '0');
INSERT INTO `tp_qyleave_check` VALUES ('157', 'li_jun_6', 'xtzlyp', '25', '0', '77', '1426485472', '0');
INSERT INTO `tp_qyleave_check` VALUES ('158', 'li_jun_6', 'lanrain', '25', '0', '77', '1426485472', '0');
INSERT INTO `tp_qyleave_check` VALUES ('159', '77484824865', 'xtzlyp', '25', '0', '78', '1426558838', '0');
INSERT INTO `tp_qyleave_check` VALUES ('160', '77484824865', 'lanrain', '25', '0', '78', '1426558838', '0');
INSERT INTO `tp_qyleave_check` VALUES ('161', '77484824865', 'xtzlyp', '25', '0', '79', '1426558840', '0');
INSERT INTO `tp_qyleave_check` VALUES ('162', '77484824865', 'lanrain', '25', '0', '79', '1426558840', '0');
INSERT INTO `tp_qyleave_check` VALUES ('163', '77484824865', 'xtzlyp', '25', '0', '80', '1426558858', '0');
INSERT INTO `tp_qyleave_check` VALUES ('164', '77484824865', 'lanrain', '25', '0', '80', '1426558858', '0');
INSERT INTO `tp_qyleave_check` VALUES ('165', '77484824865', 'xtzlyp', '25', '0', '81', '1426558860', '0');
INSERT INTO `tp_qyleave_check` VALUES ('166', '77484824865', 'lanrain', '25', '0', '81', '1426558860', '0');
INSERT INTO `tp_qyleave_check` VALUES ('167', 'li_jun_6', 'xtzlyp', '25', '0', '82', '1426560515', '0');
INSERT INTO `tp_qyleave_check` VALUES ('168', 'li_jun_6', 'lanrain', '25', '0', '82', '1426560515', '0');
INSERT INTO `tp_qyleave_check` VALUES ('169', 'li_jun_6', 'xtzlyp', '25', '0', '83', '1426560552', '0');
INSERT INTO `tp_qyleave_check` VALUES ('170', 'li_jun_6', 'lanrain', '25', '0', '83', '1426560552', '0');
INSERT INTO `tp_qyleave_check` VALUES ('171', 'li_jun_6', 'xtzlyp', '25', '0', '84', '1426560561', '0');
INSERT INTO `tp_qyleave_check` VALUES ('172', 'li_jun_6', 'lanrain', '25', '0', '84', '1426560561', '0');
INSERT INTO `tp_qyleave_check` VALUES ('173', '270636852', 'wangming', '25', '0', '85', '1426584222', '0');
INSERT INTO `tp_qyleave_check` VALUES ('174', '270636852', 'xtzlyp', '25', '0', '85', '1426584222', '0');
INSERT INTO `tp_qyleave_check` VALUES ('175', '270636852', 'lanrain', '25', '0', '85', '1426584222', '0');
INSERT INTO `tp_qyleave_check` VALUES ('176', 'qiancheng', 'lijiahui_270636852', '25', '0', '86', '1426671755', '0');
INSERT INTO `tp_qyleave_check` VALUES ('177', 'qiancheng', 'ljh', '25', '0', '87', '1426671821', '0');
INSERT INTO `tp_qyleave_check` VALUES ('178', 'qiancheng', '270636852', '25', '1', '90', '1426672003', '0');
INSERT INTO `tp_qyleave_check` VALUES ('179', '270636852', '270636852', '25', '1', '91', '1426744579', '0');
INSERT INTO `tp_qyleave_check` VALUES ('180', '270636852', 'li_jun_6', '25', '1', '91', '1426744793', '0');
INSERT INTO `tp_qyleave_check` VALUES ('181', '0033', '270636852', '25', '1', '92', '1426838048', '0');
INSERT INTO `tp_qyleave_check` VALUES ('182', '0033', 'li_jun_6', '25', '1', '92', '1426838057', '0');
INSERT INTO `tp_qyleave_check` VALUES ('183', 'li_jun_6', '270636852', '25', '2', '93', '1426838276', '0');
INSERT INTO `tp_qyleave_check` VALUES ('184', 'li_jun_6', 'li_jun_6', '25', '0', '93', '1426838223', '0');
INSERT INTO `tp_qyleave_check` VALUES ('185', 'li_jun_6', '270636852', '25', '1', '94', '1427273539', '0');
INSERT INTO `tp_qyleave_check` VALUES ('186', 'li_jun_6', 'li_jun_6', '25', '0', '94', '1427167710', '0');
INSERT INTO `tp_qyleave_check` VALUES ('187', '0033', '270636852', '25', '1', '95', '1427273544', '0');
INSERT INTO `tp_qyleave_check` VALUES ('188', '0033', 'li_jun_6', '25', '0', '95', '1427188006', '0');
INSERT INTO `tp_qyleave_check` VALUES ('189', '0033', '270636852', '25', '0', '96', '1427370740', '0');
INSERT INTO `tp_qyleave_check` VALUES ('190', '0033', 'li_jun_6', '25', '0', '96', '1427370740', '0');
INSERT INTO `tp_qyleave_check` VALUES ('191', '270636852', '270636852', '25', '0', '97', '1427444683', '0');
INSERT INTO `tp_qyleave_check` VALUES ('192', '270636852', 'li_jun_6', '25', '0', '97', '1427444683', '0');
INSERT INTO `tp_qyleave_check` VALUES ('193', '0033', '270636852', '25', '0', '98', '1427445655', '0');
INSERT INTO `tp_qyleave_check` VALUES ('194', '0033', 'li_jun_6', '25', '0', '98', '1427445655', '0');
INSERT INTO `tp_qyleave_check` VALUES ('195', '0033', '270636852', '25', '0', '99', '1427857719', '0');
INSERT INTO `tp_qyleave_check` VALUES ('196', '0033', 'li_jun_6', '25', '0', '99', '1427857719', '0');
INSERT INTO `tp_qyleave_check` VALUES ('197', 'li_jun_6', '270636852', '25', '0', '100', '1427870398', '0');
INSERT INTO `tp_qyleave_check` VALUES ('198', 'li_jun_6', 'li_jun_6', '25', '0', '100', '1427870398', '0');
INSERT INTO `tp_qyleave_check` VALUES ('199', '0033', '270636852', '25', '0', '101', '1427877194', '0');
INSERT INTO `tp_qyleave_check` VALUES ('200', '0033', 'li_jun_6', '25', '0', '101', '1427877194', '0');
INSERT INTO `tp_qyleave_check` VALUES ('201', 'li_jun_6', '270636852', '25', '0', '102', '1427957477', '0');
INSERT INTO `tp_qyleave_check` VALUES ('202', 'li_jun_6', 'li_jun_6', '25', '0', '102', '1427957477', '0');
INSERT INTO `tp_qyleave_check` VALUES ('203', '0033', '270636852', '25', '0', '103', '1428568492', '0');
INSERT INTO `tp_qyleave_check` VALUES ('204', '0033', 'li_jun_6', '25', '0', '103', '1428568492', '0');
INSERT INTO `tp_qyleave_check` VALUES ('205', '0033', 'ding', '25', '0', '103', '1428568492', '0');
INSERT INTO `tp_qyleave_check` VALUES ('206', '0033', 'lanrain', '25', '0', '104', '1429523710', '0');
INSERT INTO `tp_qyleave_check` VALUES ('207', '0033', 'xiangshenghong', '25', '0', '104', '1429523710', '0');

-- ----------------------------
-- Table structure for `tp_qyleave_config`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyleave_config`;
CREATE TABLE `tp_qyleave_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `audit` text COMMENT '审核人',
  `time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='请假审核配置表';

-- ----------------------------
-- Records of tp_qyleave_config
-- ----------------------------
INSERT INTO `tp_qyleave_config` VALUES ('27', '26', '1', 'a:3:{i:0;N;i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1422860198');
INSERT INTO `tp_qyleave_config` VALUES ('41', '25', '1', 'a:2:{i:0;s:7:\"lanrain\";i:1;s:14:\"xiangshenghong\";}', '1429159176');

-- ----------------------------
-- Table structure for `tp_qyleave_index`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyleave_index`;
CREATE TABLE `tp_qyleave_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '姓名',
  `user_id` int(11) NOT NULL,
  `time` int(10) DEFAULT '0' COMMENT '请假日期',
  `nianjia` smallint(4) DEFAULT '0' COMMENT '年假',
  `tiaoxiu` float(10,1) NOT NULL DEFAULT '0.0' COMMENT '调休',
  `shijia` float(10,1) NOT NULL DEFAULT '0.0' COMMENT '事假',
  `bingjia` float(10,1) NOT NULL DEFAULT '0.0' COMMENT '病假',
  `hunjia` float(10,1) NOT NULL DEFAULT '0.0' COMMENT '婚假',
  `chanjia` smallint(4) NOT NULL DEFAULT '0' COMMENT '产假',
  `sangjia` float(10,1) NOT NULL DEFAULT '0.0' COMMENT '丧假',
  `qita` float(10,1) NOT NULL DEFAULT '0.0' COMMENT '其它',
  `note` varchar(255) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='请假记录表';

-- ----------------------------
-- Records of tp_qyleave_index
-- ----------------------------
INSERT INTO `tp_qyleave_index` VALUES ('1', '小王', '25', '1234567890', '30', '0.0', '0.0', '0.0', '0.0', '0', '0.0', '0.0', '');
INSERT INTO `tp_qyleave_index` VALUES ('2', '小张', '25', '1334567890', '0', '2.0', '0.0', '0.0', '0.0', '0', '0.0', '0.0', '');
INSERT INTO `tp_qyleave_index` VALUES ('3', '小周', '25', '1334569890', '0', '0.0', '0.0', '0.0', '3.0', '0', '0.0', '0.0', '');
INSERT INTO `tp_qyleave_index` VALUES ('4', '赵歌', '25', '0', '0', '0.0', '0.0', '0.0', '0.0', '0', '0.0', '1.5', '');
INSERT INTO `tp_qyleave_index` VALUES ('5', '钱老板', '25', '0', '0', '0.0', '3.0', '0.0', '0.0', '0', '0.0', '0.0', '');
INSERT INTO `tp_qyleave_index` VALUES ('6', '王金利', '25', '0', '0', '0.0', '0.0', '2.0', '0.0', '0', '0.0', '0.0', '');
INSERT INTO `tp_qyleave_index` VALUES ('7', '李德', '25', '0', '0', '0.0', '0.0', '0.0', '0.0', '60', '0.0', '0.0', '');
INSERT INTO `tp_qyleave_index` VALUES ('8', '东方', '25', '0', '0', '0.0', '0.0', '0.0', '0.0', '0', '10.0', '0.0', '');

-- ----------------------------
-- Table structure for `tp_qyleave_record`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyleave_record`;
CREATE TABLE `tp_qyleave_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wecha_id` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reson` varchar(500) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `start_time` varchar(16) DEFAULT NULL COMMENT '如果选择了半天就表示请假的时间',
  `stop_time` varchar(16) DEFAULT NULL,
  `check_now` varchar(32) DEFAULT NULL,
  `check_order` varchar(500) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0未审核1审核',
  `day` int(11) DEFAULT NULL,
  `timetype` tinyint(1) DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `daytype` tinyint(1) DEFAULT NULL COMMENT '1表示上午2表示下午',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyleave_record
-- ----------------------------
INSERT INTO `tp_qyleave_record` VALUES ('70', 'xtzlyp', '25', '请假测试一次了', '59', '2015-01-31', '', 'lanrain', 'a:2:{i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1422692721', '0', '0', '1', '12', '0');
INSERT INTO `tp_qyleave_record` VALUES ('71', 'xtzlyp', '25', '驳回测试', '59', '2015-01-29', '', 'xtzlyp', 'a:2:{i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1422693367', '2', '0', '2', null, '2');
INSERT INTO `tp_qyleave_record` VALUES ('72', '270636852', '25', '好的沟通', '58', '2015-02-07', '', 'wangming', 'a:3:{i:1;s:8:\"wangming\";i:2;s:6:\"xtzlyp\";i:3;s:7:\"lanrain\";}', '1423276940', '0', '0', '2', null, '1');
INSERT INTO `tp_qyleave_record` VALUES ('73', '270636852', '25', '', '57', '2015-02-11', '', 'wangming', 'a:3:{i:1;s:8:\"wangming\";i:2;s:6:\"xtzlyp\";i:3;s:7:\"lanrain\";}', '1423623052', '0', '0', '2', null, '1');
INSERT INTO `tp_qyleave_record` VALUES ('74', '270636852', '25', '', '57', '2015-02-12', '', 'wangming', 'a:3:{i:1;s:8:\"wangming\";i:2;s:6:\"xtzlyp\";i:3;s:7:\"lanrain\";}', '1423708827', '0', '0', '2', null, '1');
INSERT INTO `tp_qyleave_record` VALUES ('75', 'li_jun_6', '25', '嗨喽', '57', '2015-03-13', '2015-03-15', 'xtzlyp', 'a:2:{i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1426213378', '0', '2', '3', null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('76', 'li_jun_6', '25', '', '0', '', '', 'xtzlyp', 'a:2:{i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1426324464', '0', '0', null, null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('77', 'li_jun_6', '25', '肉溃疡', '59', '2015-03-16', '', 'xtzlyp', 'a:2:{i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1426485472', '0', '0', '2', null, '1');
INSERT INTO `tp_qyleave_record` VALUES ('78', '77484824865', '25', '很尴尬', '59', '2015-03-17', '2015-03-18', 'xtzlyp', 'a:2:{i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1426558838', '0', '1', '3', null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('79', '77484824865', '25', '', '0', '', '', 'xtzlyp', 'a:2:{i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1426558840', '0', '0', null, null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('80', '77484824865', '25', '', '0', '', '', 'xtzlyp', 'a:2:{i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1426558858', '0', '0', null, null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('81', '77484824865', '25', '', '0', '', '', 'xtzlyp', 'a:2:{i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1426558860', '0', '0', null, null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('82', 'li_jun_6', '25', '', '0', '', '', 'xtzlyp', 'a:2:{i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1426560515', '0', '0', null, null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('83', 'li_jun_6', '25', '', '0', '', '', 'xtzlyp', 'a:2:{i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1426560552', '0', '0', null, null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('84', 'li_jun_6', '25', '', '0', '2015-03-17', '', 'xtzlyp', 'a:2:{i:1;s:6:\"xtzlyp\";i:2;s:7:\"lanrain\";}', '1426560561', '0', '-16510', null, null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('85', '270636852', '25', '看似四角星花', '59', '2015-03-17', '2015-03-17', 'wangming', 'a:3:{i:1;s:8:\"wangming\";i:2;s:6:\"xtzlyp\";i:3;s:7:\"lanrain\";}', '1426584222', '0', '0', '3', null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('90', 'qiancheng', '25', '霍霍', '61', '2015-03-18', '2015-03-19', '270636852', 'a:1:{i:1;s:9:\"270636852\";}', '1426671931', '1', '1', '3', null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('91', '270636852', '25', '电话不是锦绣河山吧', '62', '2015-03-19', '', 'li_jun_6', 'a:2:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";}', '1426744556', '1', '0', '1', '6', '0');
INSERT INTO `tp_qyleave_record` VALUES ('92', '0033', '25', '有事', '59', '2015-03-20', '2015-03-22', 'li_jun_6', 'a:2:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";}', '1426837975', '1', '2', '3', null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('93', 'li_jun_6', '25', '提莫iOS', '61', '2015-03-20', '2015-03-21', '270636852', 'a:2:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";}', '1426838223', '2', '1', '3', null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('94', 'li_jun_6', '25', '意', '62', '2015-05-24', '2015-03-26', 'li_jun_6', 'a:2:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";}', '1427167710', '0', '-59', '3', null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('95', '0033', '25', '', '0', '', '', 'li_jun_6', 'a:2:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";}', '1427188006', '0', '0', null, null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('96', '0033', '25', '哈啦啦', '61', '2015-03-27', '', '270636852', 'a:2:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";}', '1427370740', '0', '0', '2', null, '2');
INSERT INTO `tp_qyleave_record` VALUES ('97', '270636852', '25', '', '0', '', '', '270636852', 'a:2:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";}', '1427444683', '0', '0', null, null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('98', '0033', '25', '有事', '59', '2015-03-27', '2015-03-31', '270636852', 'a:2:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";}', '1427445655', '0', '4', '3', null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('99', '0033', '25', '兔子', '60', '2015-04-02', '2015-04-01', '270636852', 'a:2:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";}', '1427857719', '0', '-1', '3', null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('100', 'li_jun_6', '25', '11本无图l路v', '62', '2015-06-01', '', '270636852', 'a:2:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";}', '1427870398', '0', '0', '2', null, '1');
INSERT INTO `tp_qyleave_record` VALUES ('101', '0033', '25', '好看了', '60', '2016-04-01', '', '270636852', 'a:2:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";}', '1427877194', '0', '0', '2', null, '1');
INSERT INTO `tp_qyleave_record` VALUES ('102', 'li_jun_6', '25', '', '57', '2015-04-02', '2015-04-05', '270636852', 'a:2:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";}', '1427957477', '0', '3', '3', null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('103', '0033', '25', '好好', '60', '2015-04-09', '2015-04-11', '270636852', 'a:3:{i:1;s:9:\"270636852\";i:2;s:8:\"li_jun_6\";i:3;s:4:\"ding\";}', '1428568492', '0', '2', '3', null, '0');
INSERT INTO `tp_qyleave_record` VALUES ('104', '0033', '25', '有事', '59', '2015-04-21', '2015-04-24', 'lanrain', 'a:2:{i:1;s:7:\"lanrain\";i:2;s:14:\"xiangshenghong\";}', '1429523710', '0', '3', '3', null, '0');

-- ----------------------------
-- Table structure for `tp_qyleave_type`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyleave_type`;
CREATE TABLE `tp_qyleave_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL COMMENT '请假类型原名称',
  `cname` varchar(200) DEFAULT NULL COMMENT '请假类型自定义名称',
  `status` varchar(20) NOT NULL,
  `days` int(11) DEFAULT NULL COMMENT '设置天数',
  `mintime` int(11) DEFAULT NULL COMMENT '请假最小值',
  `disorder` int(11) DEFAULT NULL COMMENT '显示顺序',
  `time` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COMMENT='请假类型表';

-- ----------------------------
-- Records of tp_qyleave_type
-- ----------------------------
INSERT INTO `tp_qyleave_type` VALUES ('57', '25', '年假', '年假1', 'on', '10', '12', '1', null);
INSERT INTO `tp_qyleave_type` VALUES ('58', '25', '调休', '调休', 'on', '10', '12', '2', null);
INSERT INTO `tp_qyleave_type` VALUES ('59', '25', '事假', '事假', 'on', '10', '12', '3', null);
INSERT INTO `tp_qyleave_type` VALUES ('60', '25', '病假', '病假', 'on', '10', '12', '4', null);
INSERT INTO `tp_qyleave_type` VALUES ('61', '25', '婚假', '婚假', 'on', '10', '12', '5', null);
INSERT INTO `tp_qyleave_type` VALUES ('62', '25', '产假', '产假', 'on', '10', '12', '6', null);
INSERT INTO `tp_qyleave_type` VALUES ('63', '25', '丧假', '丧假', 'on', '10', '12', '7', null);
INSERT INTO `tp_qyleave_type` VALUES ('64', '25', '其它', '其它1', 'on', '10', '12', '8', null);

-- ----------------------------
-- Table structure for `tp_qylog`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qylog`;
CREATE TABLE `tp_qylog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL COMMENT '日志标题',
  `content` text COMMENT '日志内容',
  `type` int(11) DEFAULT '0' COMMENT '日志类型：0为日报，1周报，2月报，3季报，4年报',
  `principal` varchar(30) DEFAULT NULL COMMENT '负责人',
  `relevance` varchar(30) DEFAULT NULL COMMENT '关联人',
  `submittype` tinyint(4) DEFAULT NULL COMMENT '提交类型 1为已提交 2为待提交',
  `create_time` int(11) DEFAULT NULL COMMENT '时间',
  `userid` int(11) DEFAULT NULL COMMENT '员工id',
  `img` varchar(100) DEFAULT NULL COMMENT '图片地址id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qylog
-- ----------------------------
INSERT INTO `tp_qylog` VALUES ('76', '干嘛呢哼哼哈嘿', '陌陌摸摸哦哦', '2', '29|30|210|222|', '30|52|54|111|82|186|187|188|19', '1', '20150416', '222', '21,22,');
INSERT INTO `tp_qylog` VALUES ('75', '哼哼哈嘿', '哎呀吧不错哦哼哼唧唧复唧唧', '1', '54|82|222|210|', '52|54|210|222|227|', '1', '20150416', '222', '20,');
INSERT INTO `tp_qylog` VALUES ('74', '好了', '宫', '0', '230|', '210|222|227|', '1', '20150416', '230', '19,');
INSERT INTO `tp_qylog` VALUES ('83', '就直接睡不着觉', '钱钱钱钱钱', '1', '210|', '188|222|', '1', '20150417', '210', '31,32,');
INSERT INTO `tp_qylog` VALUES ('72', '哎呀哎呀！', '阿里云', '1', '30|52|190|222|', '52|82|222|227|', '1', '20150415', '222', '17,');
INSERT INTO `tp_qylog` VALUES ('71', '哎哟不错哦', '啊咯哦哦wwwX5办了个毛线啊你是你说真的吗哦。安装包的样子，魔怔了我了哦哦最近家里有事快我做最1噢耶摸着咯是我是哦一月十五黯然无光', '4', '52|54|', '54|82|', '1', '20150415', '222', '16,');
INSERT INTO `tp_qylog` VALUES ('70', '哈哈哈哈哎哟', '啊咯哦哦wwwX5办了个毛线啊你是你说真的吗哦。安装包的样子，魔怔了我了哦哦最近家里有事快我做最1噢耶摸着咯是我是哦一月十五黯然无光', '4', '52|54|', '54|82|', '1', '20150415', '222', 'fileUrl');
INSERT INTO `tp_qylog` VALUES ('79', '锟斤拷锟结交', '不科学哦', '0', '222|', '111|210|227|', '1', '20150416', '222', '27,');
INSERT INTO `tp_qylog` VALUES ('69', '锟斤拷锟斤拷?锟斤拷锟斤拷锟斤拷哟', '啊咯哦哦wwwX5办了个毛线啊你是你说真的吗哦。安装包的样子，魔怔了我了哦哦最近家里有事快我做最1噢耶摸着咯是我是哦一月十五黯然无光', '4', '52|54|111|', '52|54|222|210|', '1', '20150415', '222', null);
INSERT INTO `tp_qylog` VALUES ('80', '待提交', '本激素药', '1', '30|52|188|222|210|', '30|52|188|190|210|222|', '1', '20150417', '222', '28,');
INSERT INTO `tp_qylog` VALUES ('81', '锟结交', '本激素药只能传一张', '1', '29|30|210|222|', '29|30|54|82|111|188|190|210|22', '1', '20150417', '222', '29,');
INSERT INTO `tp_qylog` VALUES ('82', 'soowlkmgjkcg', 'xhkkggmkjkjkkk\nfhklknbbhhjj\ndhknbvnkmk\ndhknvnmk\ngjkmnnbnnn', '1', '230|', '210|230|232|', '1', '20150417', '230', '30,');
INSERT INTO `tp_qylog` VALUES ('78', '待提交', '哎哟不错哦', '1', '30|52|29|', '54|82|187|210|222|', '1', '20150416', '222', '25,26,');
INSERT INTO `tp_qylog` VALUES ('84', '待提交', '逗我呢！', '1', '30|52|187|', '30|54|82|210|222|', '1', '20150420', '222', '33,');
INSERT INTO `tp_qylog` VALUES ('85', '嗨', '头', '0', '29|30|', '82|111|', '1', '20150420', '227', '34,35,');
INSERT INTO `tp_qylog` VALUES ('86', '嗨哦哟', '头', '0', '54|82|', '82|111|', '2', '20150420', '227', null);
INSERT INTO `tp_qylog` VALUES ('87', '嗨哦哟', '头你', '0', '82|111|', '82|111|', '1', '20150420', '227', '36,');
INSERT INTO `tp_qylog` VALUES ('88', '嗨哦哟我OK', '头你咯哦哦哦', '3', '82|111|', '82|54|', '1', '20150420', '227', '37,');
INSERT INTO `tp_qylog` VALUES ('89', 'MSN和', '喔岁', '2', '54|111|', '54|82|', '2', '20150420', '227', '38,');
INSERT INTO `tp_qylog` VALUES ('90', '待提交', '待提交', '2', '52|82|192|210|222|', '82|111|', '2', '20150420', '222', '39,');
INSERT INTO `tp_qylog` VALUES ('92', '待提交', '行不行', '4', '30|29|', '210|222|227|', '1', '20150420', '222', '40,');
INSERT INTO `tp_qylog` VALUES ('93', '明', '计算机', '0', '82|111|', '54|82|', '2', '20150420', '227', null);
INSERT INTO `tp_qylog` VALUES ('94', '明', '计算机闽', '3', '54|82|', '54|82|', '1', '20150420', '227', '41,');
INSERT INTO `tp_qylog` VALUES ('95', '提交了', 'DOM哦里', '4', '29|30|', '52|54|227|222|210|', '1', '20150420', '222', '42,');
INSERT INTO `tp_qylog` VALUES ('96', '好了吗', '好了吗', '4', '29|30|', '54|82|186|227|222|210|', '1', '20150420', '222', '43,');
INSERT INTO `tp_qylog` VALUES ('97', '好了', '共和军', '4', '29|30|', '52|54|210|222|227|', '1', '20150420', '210', '44,');
INSERT INTO `tp_qylog` VALUES ('107', '定位', '估计星期一', '0', '82|111|', '54|82|', '1', '20150420', '227', '55,56,');
INSERT INTO `tp_qylog` VALUES ('99', '喔婆婆儿女', '早睡早起', '2', '29|52|82|', '54|82|', '1', '20150420', '227', '46,');
INSERT INTO `tp_qylog` VALUES ('100', '喔婆婆儿女闽', '早睡早起hh', '2', '54|82|', '54|111|', '2', '20150420', '227', null);
INSERT INTO `tp_qylog` VALUES ('101', '喔婆婆儿女闽', '早睡早起hh', '2', '54|82|', '54|111|', '1', '20150420', '227', '47,');
INSERT INTO `tp_qylog` VALUES ('102', '喔婆婆儿女闽妙真', '早睡早起hh图片浏览　', '3', '82|52|54|', '82|111|', '1', '20150420', '227', '48,');
INSERT INTO `tp_qylog` VALUES ('103', '路线', '手机卡', '2', '82|111|', '52|54|', '2', '20150420', '227', '49,');
INSERT INTO `tp_qylog` VALUES ('104', '待提交', '暗无天日', '4', '30|52|', '111|186|210|222|227|', '2', '20150420', '222', '50,');
INSERT INTO `tp_qylog` VALUES ('105', '定位', '估计', '0', '54|82|', '54|111|', '2', '20150420', '227', '53,54,');
INSERT INTO `tp_qylog` VALUES ('108', '图片', '图片待提交', '4', '30|52|', '111|186|210|222|227|', '2', '20150420', '222', '57,58,59,');
INSERT INTO `tp_qylog` VALUES ('109', '明晚', '', '3', '54|82|', '52|54|', '1', '20150420', '227', '60,61,');
INSERT INTO `tp_qylog` VALUES ('110', '年报', '提交了', '4', '54|82|192|222|210|227|', '30|52|29|', '1', '20150420', '222', '62,63,64,65,66,67,68,');

-- ----------------------------
-- Table structure for `tp_qylog_type`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qylog_type`;
CREATE TABLE `tp_qylog_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `disorder` mediumint(8) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `user_id` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qylog_type
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qymailconf`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qymailconf`;
CREATE TABLE `tp_qymailconf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `appid` int(11) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `getmail` varchar(64) DEFAULT NULL,
  `get_type` tinyint(1) DEFAULT NULL,
  `get_port` varchar(16) DEFAULT NULL,
  `postmail` varchar(64) DEFAULT NULL,
  `post_type` tinyint(1) DEFAULT NULL,
  `post_port` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qymailconf
-- ----------------------------
INSERT INTO `tp_qymailconf` VALUES ('13', '25', '38', '1', 'imap.qq.comwerwrwerwe', '0', '993', 'smtp.qq.comwerwerwrwer', '0', '465');

-- ----------------------------
-- Table structure for `tp_qymeet_check`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qymeet_check`;
CREATE TABLE `tp_qymeet_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_one` varchar(100) DEFAULT NULL COMMENT '提交请假的人',
  `user_two` varchar(100) DEFAULT NULL COMMENT '审核人',
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0为未审核1为审核2为驳回',
  `pid` int(11) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0' COMMENT '1为审核通过2为拒绝',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=311 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qymeet_check
-- ----------------------------
INSERT INTO `tp_qymeet_check` VALUES ('147', 'xtzlyp', 'xtzlyp', '25', '0', '59', '1422961437', '0');
INSERT INTO `tp_qymeet_check` VALUES ('148', 'xtzlyp', 'lanrain', '25', '0', '59', '1422961437', '0');
INSERT INTO `tp_qymeet_check` VALUES ('149', 'xtzlyp', 'blue', '25', '0', '59', '1422961437', '0');
INSERT INTO `tp_qymeet_check` VALUES ('150', 'xtzlyp', 'xtzlyp', '25', '0', '60', '1422963856', '0');
INSERT INTO `tp_qymeet_check` VALUES ('151', 'xtzlyp', 'lanrain', '25', '0', '60', '1422963856', '0');
INSERT INTO `tp_qymeet_check` VALUES ('152', 'xtzlyp', 'blue', '25', '0', '60', '1422963856', '0');
INSERT INTO `tp_qymeet_check` VALUES ('153', '270636852', 'wangming', '25', '0', '61', '1423017883', '0');
INSERT INTO `tp_qymeet_check` VALUES ('154', '270636852', 'xtzlyp', '25', '0', '61', '1423017883', '0');
INSERT INTO `tp_qymeet_check` VALUES ('155', '270636852', 'lanrain', '25', '0', '61', '1423017883', '0');
INSERT INTO `tp_qymeet_check` VALUES ('156', '270636852', 'blue', '25', '0', '61', '1423017883', '0');
INSERT INTO `tp_qymeet_check` VALUES ('157', '270636852', 'wangming', '25', '0', '62', '1423038731', '0');
INSERT INTO `tp_qymeet_check` VALUES ('158', '270636852', 'xtzlyp', '25', '0', '62', '1423038731', '0');
INSERT INTO `tp_qymeet_check` VALUES ('159', '270636852', 'lanrain', '25', '0', '62', '1423038731', '0');
INSERT INTO `tp_qymeet_check` VALUES ('160', '270636852', 'blue', '25', '0', '62', '1423038731', '0');
INSERT INTO `tp_qymeet_check` VALUES ('161', '270636852', 'wangming', '25', '0', '63', '1423040649', '0');
INSERT INTO `tp_qymeet_check` VALUES ('162', '270636852', '270636852', '25', '2', '63', '1423473996', '0');
INSERT INTO `tp_qymeet_check` VALUES ('163', 'ding', 'xtzlyp', '25', '1', '64', '1423044462', '0');
INSERT INTO `tp_qymeet_check` VALUES ('164', 'ding', '270636852', '25', '0', '64', '1423044462', '0');
INSERT INTO `tp_qymeet_check` VALUES ('165', 'ding', 'ding', '25', '0', '64', '1423044462', '0');
INSERT INTO `tp_qymeet_check` VALUES ('166', 'ding', 'xtzlyp', '25', '0', '65', '1423123572', '0');
INSERT INTO `tp_qymeet_check` VALUES ('167', 'ding', '270636852', '25', '0', '65', '1423123572', '0');
INSERT INTO `tp_qymeet_check` VALUES ('168', 'ding', 'ding', '25', '0', '65', '1423123572', '0');
INSERT INTO `tp_qymeet_check` VALUES ('169', 'ding', 'xtzlyp', '25', '0', '66', '1423132482', '0');
INSERT INTO `tp_qymeet_check` VALUES ('170', 'ding', '270636852', '25', '0', '66', '1423132482', '0');
INSERT INTO `tp_qymeet_check` VALUES ('171', 'ding', 'ding', '25', '0', '66', '1423132482', '0');
INSERT INTO `tp_qymeet_check` VALUES ('172', 'ding', 'xtzlyp', '25', '2', '67', '1423277634', '0');
INSERT INTO `tp_qymeet_check` VALUES ('173', 'ding', '270636852', '25', '0', '67', '1423132893', '0');
INSERT INTO `tp_qymeet_check` VALUES ('174', 'ding', 'ding', '25', '0', '67', '1423132893', '0');
INSERT INTO `tp_qymeet_check` VALUES ('175', 'ding', 'xtzlyp', '25', '0', '68', '1423473080', '0');
INSERT INTO `tp_qymeet_check` VALUES ('176', 'ding', '270636852', '25', '0', '68', '1423473080', '0');
INSERT INTO `tp_qymeet_check` VALUES ('177', 'ding', 'ding', '25', '0', '68', '1423473080', '0');
INSERT INTO `tp_qymeet_check` VALUES ('178', 'idodo_2009', 'ding', '25', '0', '69', '1425973588', '0');
INSERT INTO `tp_qymeet_check` VALUES ('179', 'idodo_2009', 'xtzlyp', '25', '0', '69', '1425973588', '0');
INSERT INTO `tp_qymeet_check` VALUES ('180', 'li_jun_6', 'ding', '25', '0', '70', '1426226049', '0');
INSERT INTO `tp_qymeet_check` VALUES ('181', 'li_jun_6', 'xtzlyp', '25', '0', '70', '1426226049', '0');
INSERT INTO `tp_qymeet_check` VALUES ('182', '77484824865', 'ding', '25', '0', '71', '1426557772', '0');
INSERT INTO `tp_qymeet_check` VALUES ('183', '77484824865', 'xtzlyp', '25', '0', '71', '1426557772', '0');
INSERT INTO `tp_qymeet_check` VALUES ('184', '77484824865', 'ding', '25', '0', '72', '1426557954', '0');
INSERT INTO `tp_qymeet_check` VALUES ('185', '77484824865', 'xtzlyp', '25', '0', '72', '1426557954', '0');
INSERT INTO `tp_qymeet_check` VALUES ('186', '77484824865', 'ding', '25', '0', '73', '1426558298', '0');
INSERT INTO `tp_qymeet_check` VALUES ('187', '77484824865', 'xtzlyp', '25', '0', '73', '1426558298', '0');
INSERT INTO `tp_qymeet_check` VALUES ('188', 'li_jun_6', 'ding', '25', '0', '74', '1426559736', '0');
INSERT INTO `tp_qymeet_check` VALUES ('189', 'li_jun_6', 'xtzlyp', '25', '0', '74', '1426559736', '0');
INSERT INTO `tp_qymeet_check` VALUES ('190', 'qiancheng', 'ding', '25', '0', '75', '1426577732', '0');
INSERT INTO `tp_qymeet_check` VALUES ('191', 'qiancheng', 'xtzlyp', '25', '0', '75', '1426577732', '0');
INSERT INTO `tp_qymeet_check` VALUES ('192', 'qiancheng', 'lanrain', '25', '0', '75', '1426577732', '0');
INSERT INTO `tp_qymeet_check` VALUES ('193', 'qiancheng', 'ding', '25', '0', '76', '1426577739', '0');
INSERT INTO `tp_qymeet_check` VALUES ('194', 'qiancheng', 'xtzlyp', '25', '0', '76', '1426577739', '0');
INSERT INTO `tp_qymeet_check` VALUES ('195', 'qiancheng', 'lanrain', '25', '0', '76', '1426577739', '0');
INSERT INTO `tp_qymeet_check` VALUES ('196', 'an', 'ding', '25', '0', '77', '1426589730', '0');
INSERT INTO `tp_qymeet_check` VALUES ('197', 'an', 'xtzlyp', '25', '0', '77', '1426589730', '0');
INSERT INTO `tp_qymeet_check` VALUES ('198', 'an', 'lanrain', '25', '0', '77', '1426589730', '0');
INSERT INTO `tp_qymeet_check` VALUES ('199', 'li_jun_6', 'ding', '25', '0', '78', '1426645967', '0');
INSERT INTO `tp_qymeet_check` VALUES ('200', 'li_jun_6', 'xtzlyp', '25', '0', '78', '1426645967', '0');
INSERT INTO `tp_qymeet_check` VALUES ('201', 'li_jun_6', 'lanrain', '25', '0', '78', '1426645967', '0');
INSERT INTO `tp_qymeet_check` VALUES ('202', '270636852', 'wangming', '25', '0', '79', '1426662414', '0');
INSERT INTO `tp_qymeet_check` VALUES ('203', '270636852', 'ding', '25', '0', '79', '1426662414', '0');
INSERT INTO `tp_qymeet_check` VALUES ('204', '270636852', 'xtzlyp', '25', '0', '79', '1426662414', '0');
INSERT INTO `tp_qymeet_check` VALUES ('205', '270636852', 'lanrain', '25', '0', '79', '1426662414', '0');
INSERT INTO `tp_qymeet_check` VALUES ('206', 'li_jun_6', 'ding', '25', '0', '80', '1426662485', '0');
INSERT INTO `tp_qymeet_check` VALUES ('207', 'li_jun_6', 'xtzlyp', '25', '0', '80', '1426662485', '0');
INSERT INTO `tp_qymeet_check` VALUES ('208', 'li_jun_6', 'lanrain', '25', '0', '80', '1426662485', '0');
INSERT INTO `tp_qymeet_check` VALUES ('209', 'li_jun_6', 'ding', '25', '0', '81', '1426662503', '0');
INSERT INTO `tp_qymeet_check` VALUES ('210', 'li_jun_6', 'xtzlyp', '25', '0', '81', '1426662503', '0');
INSERT INTO `tp_qymeet_check` VALUES ('211', 'li_jun_6', 'lanrain', '25', '0', '81', '1426662503', '0');
INSERT INTO `tp_qymeet_check` VALUES ('212', 'li_jun_6', 'ding', '25', '0', '82', '1426662507', '0');
INSERT INTO `tp_qymeet_check` VALUES ('213', 'li_jun_6', 'xtzlyp', '25', '0', '82', '1426662507', '0');
INSERT INTO `tp_qymeet_check` VALUES ('214', 'li_jun_6', 'lanrain', '25', '0', '82', '1426662507', '0');
INSERT INTO `tp_qymeet_check` VALUES ('215', 'li_jun_6', 'ding', '25', '0', '83', '1426662514', '0');
INSERT INTO `tp_qymeet_check` VALUES ('216', 'li_jun_6', 'xtzlyp', '25', '0', '83', '1426662515', '0');
INSERT INTO `tp_qymeet_check` VALUES ('217', 'li_jun_6', 'lanrain', '25', '0', '83', '1426662515', '0');
INSERT INTO `tp_qymeet_check` VALUES ('218', 'an', 'ding', '25', '0', '84', '1426662517', '0');
INSERT INTO `tp_qymeet_check` VALUES ('219', 'an', 'xtzlyp', '25', '0', '84', '1426662517', '0');
INSERT INTO `tp_qymeet_check` VALUES ('220', 'an', 'lanrain', '25', '0', '84', '1426662517', '0');
INSERT INTO `tp_qymeet_check` VALUES ('221', 'an', 'ding', '25', '0', '85', '1426662645', '0');
INSERT INTO `tp_qymeet_check` VALUES ('222', 'an', 'xtzlyp', '25', '0', '85', '1426662645', '0');
INSERT INTO `tp_qymeet_check` VALUES ('223', 'an', 'lanrain', '25', '0', '85', '1426662645', '0');
INSERT INTO `tp_qymeet_check` VALUES ('224', 'an', 'ding', '25', '0', '86', '1426662658', '0');
INSERT INTO `tp_qymeet_check` VALUES ('225', 'an', 'xtzlyp', '25', '0', '86', '1426662658', '0');
INSERT INTO `tp_qymeet_check` VALUES ('226', 'an', 'lanrain', '25', '0', '86', '1426662658', '0');
INSERT INTO `tp_qymeet_check` VALUES ('227', 'qiancheng', '270636852', '25', '0', '87', '1426766370', '0');
INSERT INTO `tp_qymeet_check` VALUES ('228', 'qiancheng', 'li_jun_6', '25', '0', '87', '1426766370', '0');
INSERT INTO `tp_qymeet_check` VALUES ('229', 'ding', '270636852', '25', '0', '88', '1427108264', '0');
INSERT INTO `tp_qymeet_check` VALUES ('230', 'ding', 'li_jun_6', '25', '0', '88', '1427108264', '0');
INSERT INTO `tp_qymeet_check` VALUES ('231', 'lanrain', '270636852', '25', '0', '89', '1427108505', '0');
INSERT INTO `tp_qymeet_check` VALUES ('232', 'lanrain', 'li_jun_6', '25', '0', '89', '1427108505', '0');
INSERT INTO `tp_qymeet_check` VALUES ('233', 'lanrain', '270636852', '25', '0', '90', '1427108514', '0');
INSERT INTO `tp_qymeet_check` VALUES ('234', 'lanrain', 'li_jun_6', '25', '0', '90', '1427108514', '0');
INSERT INTO `tp_qymeet_check` VALUES ('235', 'lanrain', '270636852', '25', '0', '91', '1427108536', '0');
INSERT INTO `tp_qymeet_check` VALUES ('236', 'lanrain', 'li_jun_6', '25', '0', '91', '1427108536', '0');
INSERT INTO `tp_qymeet_check` VALUES ('237', 'lanrain', '270636852', '25', '0', '92', '1427108543', '0');
INSERT INTO `tp_qymeet_check` VALUES ('238', 'lanrain', 'li_jun_6', '25', '0', '92', '1427108543', '0');
INSERT INTO `tp_qymeet_check` VALUES ('239', 'lanrain', '270636852', '25', '0', '93', '1427108582', '0');
INSERT INTO `tp_qymeet_check` VALUES ('240', 'lanrain', 'li_jun_6', '25', '0', '93', '1427108582', '0');
INSERT INTO `tp_qymeet_check` VALUES ('241', 'lanrain', '270636852', '25', '0', '94', '1427108587', '0');
INSERT INTO `tp_qymeet_check` VALUES ('242', 'lanrain', 'li_jun_6', '25', '0', '94', '1427108587', '0');
INSERT INTO `tp_qymeet_check` VALUES ('243', '2233', '270636852', '25', '0', '95', '1427108954', '0');
INSERT INTO `tp_qymeet_check` VALUES ('244', '2233', 'li_jun_6', '25', '0', '95', '1427108954', '0');
INSERT INTO `tp_qymeet_check` VALUES ('245', 'lanrain', '270636852', '25', '0', '96', '1427109165', '0');
INSERT INTO `tp_qymeet_check` VALUES ('246', 'lanrain', 'li_jun_6', '25', '0', '96', '1427109165', '0');
INSERT INTO `tp_qymeet_check` VALUES ('247', 'lanrain', '270636852', '25', '0', '97', '1427109169', '0');
INSERT INTO `tp_qymeet_check` VALUES ('248', 'lanrain', 'li_jun_6', '25', '0', '97', '1427109169', '0');
INSERT INTO `tp_qymeet_check` VALUES ('249', 'lanrain', '270636852', '25', '0', '98', '1427110083', '0');
INSERT INTO `tp_qymeet_check` VALUES ('250', 'lanrain', 'li_jun_6', '25', '0', '98', '1427110084', '0');
INSERT INTO `tp_qymeet_check` VALUES ('251', '2233', '270636852', '25', '0', '99', '1427190644', '0');
INSERT INTO `tp_qymeet_check` VALUES ('252', '2233', 'li_jun_6', '25', '0', '99', '1427190644', '0');
INSERT INTO `tp_qymeet_check` VALUES ('253', 'lanrain', '270636852', '25', '0', '100', '1427194336', '0');
INSERT INTO `tp_qymeet_check` VALUES ('254', 'lanrain', 'li_jun_6', '25', '0', '100', '1427194336', '0');
INSERT INTO `tp_qymeet_check` VALUES ('255', '270636852', '270636852', '25', '0', '101', '1427253748', '0');
INSERT INTO `tp_qymeet_check` VALUES ('256', '270636852', 'li_jun_6', '25', '0', '101', '1427253748', '0');
INSERT INTO `tp_qymeet_check` VALUES ('257', '2233', '270636852', '25', '0', '102', '1427266056', '0');
INSERT INTO `tp_qymeet_check` VALUES ('258', '2233', 'li_jun_6', '25', '0', '102', '1427266056', '0');
INSERT INTO `tp_qymeet_check` VALUES ('259', 'lanrain', '270636852', '25', '0', '103', '1427286073', '0');
INSERT INTO `tp_qymeet_check` VALUES ('260', 'lanrain', 'li_jun_6', '25', '0', '103', '1427286073', '0');
INSERT INTO `tp_qymeet_check` VALUES ('261', '270636852', '270636852', '25', '0', '104', '1427334676', '0');
INSERT INTO `tp_qymeet_check` VALUES ('262', '270636852', 'li_jun_6', '25', '0', '104', '1427334676', '0');
INSERT INTO `tp_qymeet_check` VALUES ('263', '270636852', '270636852', '25', '0', '105', '1427334739', '0');
INSERT INTO `tp_qymeet_check` VALUES ('264', '270636852', 'li_jun_6', '25', '0', '105', '1427334739', '0');
INSERT INTO `tp_qymeet_check` VALUES ('265', '2233', '270636852', '25', '0', '106', '1427337958', '0');
INSERT INTO `tp_qymeet_check` VALUES ('266', '2233', 'li_jun_6', '25', '0', '106', '1427337958', '0');
INSERT INTO `tp_qymeet_check` VALUES ('267', '2233', '270636852', '25', '0', '107', '1427337958', '0');
INSERT INTO `tp_qymeet_check` VALUES ('268', '2233', 'li_jun_6', '25', '0', '107', '1427337958', '0');
INSERT INTO `tp_qymeet_check` VALUES ('269', '2233', '270636852', '25', '0', '108', '1427338004', '0');
INSERT INTO `tp_qymeet_check` VALUES ('270', '2233', 'li_jun_6', '25', '0', '108', '1427338004', '0');
INSERT INTO `tp_qymeet_check` VALUES ('271', '2233', '270636852', '25', '0', '109', '1427359706', '0');
INSERT INTO `tp_qymeet_check` VALUES ('272', '2233', 'li_jun_6', '25', '0', '109', '1427359706', '0');
INSERT INTO `tp_qymeet_check` VALUES ('273', 'lanrain', '270636852', '25', '0', '110', '1427370576', '0');
INSERT INTO `tp_qymeet_check` VALUES ('274', 'lanrain', 'li_jun_6', '25', '0', '110', '1427370576', '0');
INSERT INTO `tp_qymeet_check` VALUES ('275', '0033', '270636852', '25', '0', '111', '1427447632', '0');
INSERT INTO `tp_qymeet_check` VALUES ('276', '0033', 'li_jun_6', '25', '0', '111', '1427447632', '0');
INSERT INTO `tp_qymeet_check` VALUES ('277', 'lanrain', '270636852', '25', '0', '112', '1427450463', '0');
INSERT INTO `tp_qymeet_check` VALUES ('278', 'lanrain', 'li_jun_6', '25', '0', '112', '1427450463', '0');
INSERT INTO `tp_qymeet_check` VALUES ('279', 'li_jun_6', '270636852', '25', '0', '113', '1427527457', '0');
INSERT INTO `tp_qymeet_check` VALUES ('280', 'li_jun_6', 'li_jun_6', '25', '0', '113', '1427527457', '0');
INSERT INTO `tp_qymeet_check` VALUES ('281', 'li_jun_6', '270636852', '25', '0', '114', '1427536255', '0');
INSERT INTO `tp_qymeet_check` VALUES ('282', 'li_jun_6', 'li_jun_6', '25', '0', '114', '1427536255', '0');
INSERT INTO `tp_qymeet_check` VALUES ('283', '791344275', '270636852', '25', '0', '115', '1428636873', '0');
INSERT INTO `tp_qymeet_check` VALUES ('284', '791344275', 'li_jun_6', '25', '0', '115', '1428636873', '0');
INSERT INTO `tp_qymeet_check` VALUES ('285', '791344275', '270636852', '25', '0', '116', '1428636959', '0');
INSERT INTO `tp_qymeet_check` VALUES ('286', '791344275', 'li_jun_6', '25', '0', '116', '1428636959', '0');
INSERT INTO `tp_qymeet_check` VALUES ('287', '791344275', '270636852', '25', '0', '117', '1428637003', '0');
INSERT INTO `tp_qymeet_check` VALUES ('288', '791344275', 'li_jun_6', '25', '0', '117', '1428637003', '0');
INSERT INTO `tp_qymeet_check` VALUES ('289', '791344275', '270636852', '25', '0', '118', '1428637035', '0');
INSERT INTO `tp_qymeet_check` VALUES ('290', '791344275', 'li_jun_6', '25', '0', '118', '1428637035', '0');
INSERT INTO `tp_qymeet_check` VALUES ('291', '791344275', '270636852', '25', '0', '119', '1428637056', '0');
INSERT INTO `tp_qymeet_check` VALUES ('292', '791344275', 'li_jun_6', '25', '0', '119', '1428637056', '0');
INSERT INTO `tp_qymeet_check` VALUES ('293', '791344275', '270636852', '25', '0', '120', '1428637065', '0');
INSERT INTO `tp_qymeet_check` VALUES ('294', '791344275', 'li_jun_6', '25', '0', '120', '1428637065', '0');
INSERT INTO `tp_qymeet_check` VALUES ('295', '791344275', '270636852', '25', '0', '121', '1428637140', '0');
INSERT INTO `tp_qymeet_check` VALUES ('296', '791344275', 'li_jun_6', '25', '0', '121', '1428637140', '0');
INSERT INTO `tp_qymeet_check` VALUES ('297', '791344275', '270636852', '25', '0', '122', '1428637241', '0');
INSERT INTO `tp_qymeet_check` VALUES ('298', '791344275', 'li_jun_6', '25', '0', '122', '1428637241', '0');
INSERT INTO `tp_qymeet_check` VALUES ('299', '791344275', '270636852', '25', '0', '123', '1428637637', '0');
INSERT INTO `tp_qymeet_check` VALUES ('300', '791344275', 'li_jun_6', '25', '0', '123', '1428637637', '0');
INSERT INTO `tp_qymeet_check` VALUES ('301', '791344275', '270636852', '25', '0', '124', '1428637723', '0');
INSERT INTO `tp_qymeet_check` VALUES ('302', '791344275', 'li_jun_6', '25', '0', '124', '1428637723', '0');
INSERT INTO `tp_qymeet_check` VALUES ('303', '0033', '270636852', '25', '0', '125', '1428653609', '0');
INSERT INTO `tp_qymeet_check` VALUES ('304', '0033', 'li_jun_6', '25', '0', '125', '1428653609', '0');
INSERT INTO `tp_qymeet_check` VALUES ('305', '0033', '270636852', '25', '0', '126', '1428653617', '0');
INSERT INTO `tp_qymeet_check` VALUES ('306', '0033', 'li_jun_6', '25', '0', '126', '1428653617', '0');
INSERT INTO `tp_qymeet_check` VALUES ('307', '0033', '270636852', '25', '0', '127', '1428653692', '0');
INSERT INTO `tp_qymeet_check` VALUES ('308', '0033', 'li_jun_6', '25', '0', '127', '1428653692', '0');
INSERT INTO `tp_qymeet_check` VALUES ('309', 'li_jun_6', '270636852', '25', '0', '128', '1428994774', '0');
INSERT INTO `tp_qymeet_check` VALUES ('310', 'li_jun_6', 'li_jun_6', '25', '0', '128', '1428994774', '0');

-- ----------------------------
-- Table structure for `tp_qymeet_config`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qymeet_config`;
CREATE TABLE `tp_qymeet_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advance` varchar(100) NOT NULL DEFAULT '' COMMENT '可提前预定天数',
  `start_time` varchar(60) DEFAULT '' COMMENT '会议室预定开始时间',
  `end_time` varchar(60) DEFAULT '' COMMENT '会议室预定结束时间',
  `wave` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启摇一摇：0不开启1开启',
  `ruleout` text COMMENT '不可预定配置',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='会议室设置表';

-- ----------------------------
-- Records of tp_qymeet_config
-- ----------------------------
INSERT INTO `tp_qymeet_config` VALUES ('22', 'a:2:{s:4:\"type\";s:1:\"2\";s:4:\"time\";s:2:\"12\";}', '08:00', '18:00', '1', 'a:2:{i:0;a:4:{s:4:\"room\";s:18:\"多功能会议室\";s:4:\"time\";s:23:\"2014/12/22 - 2015/01/21\";s:5:\"start\";s:5:\"09:30\";s:3:\"end\";s:5:\"09:30\";}i:1;a:4:{s:4:\"room\";s:15:\"面试会议室\";s:4:\"time\";s:23:\"2014/12/22 - 2015/01/21\";s:5:\"start\";s:5:\"09:30\";s:3:\"end\";s:5:\"09:30\";}}', '191');
INSERT INTO `tp_qymeet_config` VALUES ('36', 'a:2:{s:4:\"type\";s:1:\"0\";s:4:\"time\";s:3:\"100\";}', '04:15', '17:00', '1', 'a:2:{i:0;a:4:{s:4:\"room\";s:1:\"0\";s:4:\"time\";s:23:\"2015/04/11 - 2015/04/11\";s:5:\"start\";s:5:\"05:30\";s:3:\"end\";s:5:\"21:30\";}i:1;a:4:{s:4:\"room\";s:1:\"0\";s:4:\"time\";s:23:\"2015/04/14 - 2015/05/14\";s:5:\"start\";s:5:\"09:30\";s:3:\"end\";s:5:\"09:30\";}}', '25');

-- ----------------------------
-- Table structure for `tp_qymeet_or`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qymeet_or`;
CREATE TABLE `tp_qymeet_or` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `audit` text COMMENT '审核人',
  `time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='请假审核配置表';

-- ----------------------------
-- Records of tp_qymeet_or
-- ----------------------------
INSERT INTO `tp_qymeet_or` VALUES ('28', '24', '1', 'a:3:{i:0;N;i:1;s:9:\"270636852\";i:2;s:4:\"ding\";}', '1423044433');
INSERT INTO `tp_qymeet_or` VALUES ('34', '25', '1', 'a:2:{i:0;s:9:\"270636852\";i:1;s:8:\"li_jun_6\";}', '1426733627');

-- ----------------------------
-- Table structure for `tp_qymeet_order`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qymeet_order`;
CREATE TABLE `tp_qymeet_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '会议室名称',
  `time` int(10) NOT NULL COMMENT '日期',
  `t_8_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_8_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_9_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_9_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_10_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_10_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_11_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_11_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_12_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_12_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_13_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_13_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_14_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_14_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_15_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_15_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_16_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_16_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_17_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_17_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_18_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `t_18_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `date` varchar(16) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COMMENT='会议室预定表';

-- ----------------------------
-- Records of tp_qymeet_order
-- ----------------------------
INSERT INTO `tp_qymeet_order` VALUES ('19', 'A103', '1422860138', '0', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150202', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('20', 'B307', '1422871294', '0', '1', '1', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '20150202', '7', '25');
INSERT INTO `tp_qymeet_order` VALUES ('21', 'A103', '1422960038', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150203', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('22', 'A104', '1422960826', '0', '1', '1', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150203', '5', '25');
INSERT INTO `tp_qymeet_order` VALUES ('23', 'D532', '1422963856', '0', '0', '0', '0', '0', '0', '1', '1', '1', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '1', '0', '0', '20150203', '8', '25');
INSERT INTO `tp_qymeet_order` VALUES ('24', 'A1010', '1423017883', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150204', '2', '25');
INSERT INTO `tp_qymeet_order` VALUES ('25', 'B307', '1423038732', '1', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150204', '7', '25');
INSERT INTO `tp_qymeet_order` VALUES ('26', 'A103', '1423044462', '0', '0', '0', '0', '0', '0', '1', '0', '1', '0', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150204', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('27', 'A103', '1423123573', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '0', '0', '20150205', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('28', 'A1010', '1423132482', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150205', '2', '25');
INSERT INTO `tp_qymeet_order` VALUES ('29', 'A104', '1423132893', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '20150205', '5', '25');
INSERT INTO `tp_qymeet_order` VALUES ('30', 'A103', '1423473080', '0', '0', '1', '1', '0', '0', '1', '0', '1', '0', '0', '0', '1', '0', '1', '0', '0', '0', '1', '0', '0', '0', '20150209', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('31', 'A103', '1425973588', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150310', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('32', 'A104', '1426226050', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150313', '5', '25');
INSERT INTO `tp_qymeet_order` VALUES ('33', 'A103', '1426557772', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150317', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('34', 'D532', '1426557954', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150317', '8', '25');
INSERT INTO `tp_qymeet_order` VALUES ('35', 'A1010', '1426559737', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150317', '2', '25');
INSERT INTO `tp_qymeet_order` VALUES ('36', 'A105', '1426577733', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '20150317', '6', '25');
INSERT INTO `tp_qymeet_order` VALUES ('37', 'B307', '1426645967', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150318', '7', '25');
INSERT INTO `tp_qymeet_order` VALUES ('38', 'A103', '1426662415', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '20150318', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('39', 'A104', '1426662485', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '0', '0', '20150318', '5', '25');
INSERT INTO `tp_qymeet_order` VALUES ('40', 'A1010', '1426766370', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '20150319', '2', '25');
INSERT INTO `tp_qymeet_order` VALUES ('41', 'A103', '1427108265', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150323', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('42', 'A104', '1427108505', '0', '0', '0', '1', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150323', '5', '25');
INSERT INTO `tp_qymeet_order` VALUES ('43', 'B307', '1427108536', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150323', '7', '25');
INSERT INTO `tp_qymeet_order` VALUES ('44', 'A105', '1427108582', '0', '0', '1', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150323', '6', '25');
INSERT INTO `tp_qymeet_order` VALUES ('45', 'A1010', '1427109165', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150323', '2', '25');
INSERT INTO `tp_qymeet_order` VALUES ('46', 'B307', '1427190644', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '1', '0', '0', '20150324', '7', '25');
INSERT INTO `tp_qymeet_order` VALUES ('47', 'A103', '1427253748', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '20150325', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('48', 'A105', '1427266056', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '20150325', '6', '25');
INSERT INTO `tp_qymeet_order` VALUES ('49', 'A1010', '1427286073', '0', '0', '0', '0', '0', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150325', '2', '25');
INSERT INTO `tp_qymeet_order` VALUES ('50', 'A1010', '1427334676', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150326', '2', '25');
INSERT INTO `tp_qymeet_order` VALUES ('51', 'A103', '1427337958', '0', '0', '0', '0', '0', '1', '1', '1', '0', '1', '0', '0', '0', '1', '0', '0', '0', '1', '0', '0', '0', '0', '20150326', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('52', 'A104', '1427370577', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150326', '5', '25');
INSERT INTO `tp_qymeet_order` VALUES ('53', 'A103', '1427447633', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150327', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('54', 'D532', '1427450463', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150327', '8', '25');
INSERT INTO `tp_qymeet_order` VALUES ('55', 'D532', '1427527457', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '20150328', '8', '25');
INSERT INTO `tp_qymeet_order` VALUES ('56', 'A103', '1428636874', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '1', '1', '1', '0', '0', '0', '1', '1', '0', '0', '20150410', '1', '25');
INSERT INTO `tp_qymeet_order` VALUES ('57', 'A104', '1428653610', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150410', '5', '25');
INSERT INTO `tp_qymeet_order` VALUES ('58', 'sss66', '1428994774', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '20150414', '11', '25');

-- ----------------------------
-- Table structure for `tp_qymeet_record`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qymeet_record`;
CREATE TABLE `tp_qymeet_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `timeid` varchar(64) DEFAULT NULL,
  `is_mail` tinyint(1) DEFAULT NULL,
  `mail_user` varchar(16) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL,
  `date` varchar(16) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `times` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '2' COMMENT '审核状态',
  `check_now` varchar(16) DEFAULT NULL,
  `check_order` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qymeet_record
-- ----------------------------
INSERT INTO `tp_qymeet_record` VALUES ('59', '5', '25', ';t_10_2;t_11_1', '0', '', '1422961437', '20150203', 'xtzlyp', '2', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('60', '8', '25', ';t_17_2;t_15_1;t_14_2;t_12_1;t_11_2;t_11_1', '0', '', '1422963855', '20150203', 'xtzlyp', '6', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('61', '2', '25', ';t_9_1', '0', '', '1423017883', '20150204', '270636852', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('62', '7', '25', ';t_8_1;t_10_2', '0', '', '1423038731', '20150204', '270636852', '2', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('63', '7', '25', '', '0', '黎先生', '1423040649', '20150204', '270636852', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('64', '1', '25', ';t_12_1;t_11_1;t_13_2;t_14_1', '0', '', '1423044462', '20150204', 'ding', '4', '2', 'xtzlyp', null);
INSERT INTO `tp_qymeet_record` VALUES ('65', '1', '25', ';t_17_1;t_17_2', '0', '', '1423123572', '20150205', 'ding', '2', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('66', '2', '25', ';t_8_1', '0', '', '1423132482', '20150205', 'ding', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('67', '5', '25', ';t_17_2', '0', '', '1423132893', '20150205', 'ding', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('68', '1', '25', ';t_9_2;t_9_1;t_11_1;t_14_1;t_15_1;t_12_1;t_17_1', '0', '', '1423473080', '20150209', 'ding', '7', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('69', '1', '25', '', '1', '', '1425973588', '20150310', 'idodo_2009', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('70', '5', '25', '', '1', '汤科珍', '1426226049', '20150313', 'li_jun_6', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('71', '1', '25', '', '0', '', '1426557772', '20150317', '77484824865', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('72', '8', '25', '', '0', '麦伟良', '1426557954', '20150317', '77484824865', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('73', '1', '25', '', '0', '麦伟良', '1426558298', '20150317', '77484824865', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('74', '2', '25', '', '0', '', '1426559736', '20150317', 'li_jun_6', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('75', '6', '25', '', '0', '朱海澄', '1426577732', '20150317', 'qiancheng', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('76', '6', '25', ';t_15_2', '0', '朱海澄', '1426577739', '20150317', 'qiancheng', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('77', '1', '25', '', '0', '向胜虹', '1426589730', '20150317', 'an', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('78', '7', '25', '', '0', '陈雨', '1426645967', '20150318', 'li_jun_6', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('79', '1', '25', ';t_14_2', '1', '安秀英', '1426662414', '20150318', '270636852', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('80', '5', '25', '', '0', '黎先生', '1426662485', '20150318', 'li_jun_6', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('81', '5', '25', '', '0', '黎先生', '1426662503', '20150318', 'li_jun_6', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('82', '5', '25', '', '0', '黎先生', '1426662507', '20150318', 'li_jun_6', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('83', '5', '25', ';t_17_1;t_17_2', '1', '', '1426662514', '20150318', 'li_jun_6', '2', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('84', '1', '25', '', '1', '黎先生', '1426662517', '20150318', 'an', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('85', '1', '25', '', '0', '黎先生', '1426662644', '20150318', 'an', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('86', '1', '25', '', '0', '黎先生', '1426662658', '20150318', 'an', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('87', '2', '25', ';t_16_2', '0', '', '1426766370', '20150319', 'qiancheng', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('88', '1', '25', ';t_8_1;t_8_2', null, null, '1427108264', '20150323', 'ding', '2', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('89', '5', '25', '', null, null, '1427108505', '20150323', 'lanrain', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('90', '5', '25', ';t_9_2;t_12_1', null, null, '1427108514', '20150323', 'lanrain', '2', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('91', '7', '25', '', null, null, '1427108536', '20150323', 'lanrain', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('92', '7', '25', ';t_9_1', null, null, '1427108543', '20150323', 'lanrain', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('93', '6', '25', '', null, null, '1427108582', '20150323', 'lanrain', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('94', '6', '25', ';t_9_1;t_11_2', null, null, '1427108586', '20150323', 'lanrain', '2', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('95', '1', '25', '', null, null, '1427108954', '20150323', '2233', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('96', '2', '25', '', null, null, '1427109165', '20150323', 'lanrain', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('97', '2', '25', ';t_9_2', null, null, '1427109169', '20150323', 'lanrain', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('98', '6', '25', ';t_12_1', null, null, '1427110083', '20150323', 'lanrain', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('99', '7', '25', ';t_14_2', null, null, '1427190644', '20150324', '2233', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('100', '7', '25', ';t_15_1;t_17_2', null, null, '1427194336', '20150324', 'lanrain', '2', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('101', '1', '25', ';t_17_1', null, null, '1427253748', '20150325', '270636852', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('102', '6', '25', ';t_17_1', null, null, '1427266056', '20150325', '2233', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('103', '2', '25', ';t_10_2;t_11_1;t_11_2;t_12_1', null, null, '1427286073', '20150325', 'lanrain', '4', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('104', '2', '25', '', null, null, '1427334676', '20150326', '270636852', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('105', '2', '25', ';t_10_2', null, null, '1427334739', '20150326', '270636852', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('106', '1', '25', ';t_10_2;t_11_1;t_11_2', null, null, '1427337958', '20150326', '2233', '3', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('107', '1', '25', ';t_10_2;t_11_1;t_11_2', null, null, '1427337958', '20150326', '2233', '3', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('108', '1', '25', ';t_10_2;t_11_1;t_11_2', null, null, '1427338004', '20150326', '2233', '3', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('109', '1', '25', ';t_12_2;t_14_2;t_16_2', null, null, '1427359706', '20150326', '2233', '3', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('110', '5', '25', ';t_14_1', null, null, '1427370576', '20150326', 'lanrain', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('111', '1', '25', '', null, null, '1427447632', '20150327', '0033', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('112', '8', '25', ';t_13_1;t_13_2', null, null, '1427450463', '20150327', 'lanrain', '2', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('113', '8', '25', '', null, null, '1427527457', '20150328', 'li_jun_6', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('114', '8', '25', ';t_17_1;t_16_2;t_14_1;t_14_2;t_15_1;t_13_2;t_16_1;t_17_2;t_15_2', null, null, '1427536255', '20150328', 'li_jun_6', '9', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('115', '1', '25', ';t_14_1;t_12_1;t_17_2;t_14_2;t_15_1', null, null, '1428636873', '20150410', '791344275', '5', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('116', '1', '25', '', null, null, '1428636959', '20150410', '791344275', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('117', '1', '25', '', null, null, '1428637003', '20150410', '791344275', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('118', '1', '25', '', null, null, '1428637035', '20150410', '791344275', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('119', '1', '25', '', null, null, '1428637056', '20150410', '791344275', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('120', '1', '25', '', null, null, '1428637065', '20150410', '791344275', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('121', '1', '25', ';t_17_1', null, null, '1428637140', '20150410', '791344275', '1', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('122', '1', '25', '', null, null, '1428637241', '20150410', '791344275', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('123', '1', '25', '', null, null, '1428637637', '20150410', '791344275', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('124', '1', '25', '', null, null, '1428637723', '20150410', '791344275', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('125', '5', '25', '', null, null, '1428653609', '20150410', '0033', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('126', '5', '25', '', null, null, '1428653617', '20150410', '0033', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('127', '1', '25', '', null, null, '1428653692', '20150410', '0033', '0', '2', null, null);
INSERT INTO `tp_qymeet_record` VALUES ('128', '11', '25', '', null, null, '1428994774', '20150414', 'li_jun_6', '0', '2', null, null);

-- ----------------------------
-- Table structure for `tp_qymeet_room`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qymeet_room`;
CREATE TABLE `tp_qymeet_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '' COMMENT '会议室名称',
  `place` varchar(100) NOT NULL DEFAULT '' COMMENT '会议室地点',
  `note` varchar(255) DEFAULT '' COMMENT '备注',
  `floors` varchar(40) NOT NULL DEFAULT '' COMMENT '楼层',
  `num` smallint(6) DEFAULT '0' COMMENT '可容纳人数',
  `area` varchar(100) DEFAULT '' COMMENT '区域',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否预定：0未预定1已预定',
  `start_time` int(10) DEFAULT '0' COMMENT '开始时间',
  `end_time` int(10) DEFAULT '0' COMMENT '结束时间',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='会议室表';

-- ----------------------------
-- Records of tp_qymeet_room
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qymenu`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qymenu`;
CREATE TABLE `tp_qymenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `appid` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `pid` int(11) DEFAULT '0',
  `link` varchar(450) DEFAULT NULL,
  `keyword` varchar(64) DEFAULT NULL,
  `type` varchar(32) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=650 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qymenu
-- ----------------------------
INSERT INTO `tp_qymenu` VALUES ('6', '1', '12', '邮箱设置', '0', null, '企业邮箱', '1');
INSERT INTO `tp_qymenu` VALUES ('7', '1', '12', '邮箱更新', '0', null, '企业邮箱', '1');
INSERT INTO `tp_qymenu` VALUES ('14', '1', '12', '更新', '7', 'http://dexingky.wxopen.cn/index.php?g=Qyapp&m=Index&a=index', '投票', '1');
INSERT INTO `tp_qymenu` VALUES ('25', '1', '12', '张三', '6', 'http://dexingky.wxopen.cn/index.php?g=Qyapp&m=Index&a=index', '企业邮箱', '1');
INSERT INTO `tp_qymenu` VALUES ('26', '1', '17', 'aaa', '0', 'aaa', '流程审批', '1');
INSERT INTO `tp_qymenu` VALUES ('29', '1', '18', '流程审批23', '0', '', '流程审批', '1');
INSERT INTO `tp_qymenu` VALUES ('30', '1', '18', '任务协做', '0', '', '任务协作', '1');
INSERT INTO `tp_qymenu` VALUES ('31', '1', '21', '通讯录', '0', '', '通讯录', '1');
INSERT INTO `tp_qymenu` VALUES ('32', '1', '18', '修长', '29', '', '企业邮箱', '1');
INSERT INTO `tp_qymenu` VALUES ('33', '17', '24', '123', '0', '123', '企业邮箱', '1');
INSERT INTO `tp_qymenu` VALUES ('34', '1', '33', '签到', '0', 'http://dexingky.wxopen.cn/index.php?g=Qyapp&m=Attendance&a=wap_index&token=tsns2b1415255458', '报销', '1');
INSERT INTO `tp_qymenu` VALUES ('35', '1', '33', '退签', '0', 'http://dexingky.wxopen.cn/index.php?g=Qyapp&m=Attendance&a=wap_index&token=tsns2b1415255458', '流程审批', '1');
INSERT INTO `tp_qymenu` VALUES ('37', '1', '33', '记录', '0', 'http://dexingky.wxopen.cn/index.php?g=Qyapp&m=Attendance&a=wap_records&token=tsns2b1415255458', '', '1');
INSERT INTO `tp_qymenu` VALUES ('38', '1', '27', '参加投票', '0', '', '投票', '1');
INSERT INTO `tp_qymenu` VALUES ('44', '26', '48', '签到', '0', '', '微信考勤', '1');
INSERT INTO `tp_qymenu` VALUES ('45', '26', '42', '通讯录', '0', '', '通讯录', '1');
INSERT INTO `tp_qymenu` VALUES ('46', '26', '42', '常用联系人', '0', '', '通讯录', '1');
INSERT INTO `tp_qymenu` VALUES ('47', '26', '48', '签退', '0', '', '微信考勤', '1');
INSERT INTO `tp_qymenu` VALUES ('48', '26', '48', '记录查询', '0', '', '微信考勤', '1');
INSERT INTO `tp_qymenu` VALUES ('49', '26', '45', '待审批', '0', '', '报销', '1');
INSERT INTO `tp_qymenu` VALUES ('50', '26', '45', '我的报销', '0', '', '报销', '1');
INSERT INTO `tp_qymenu` VALUES ('51', '26', '45', '申请报销', '0', '', '报销', '1');
INSERT INTO `tp_qymenu` VALUES ('52', '26', '45', '未处理', '49', '', '报销', '1');
INSERT INTO `tp_qymenu` VALUES ('53', '26', '45', '已处理', '49', '', '报销', '1');
INSERT INTO `tp_qymenu` VALUES ('54', '26', '44', '待审批', '0', '', '流程审批', '1');
INSERT INTO `tp_qymenu` VALUES ('55', '26', '44', '我的审批', '0', '', '流程审批', '1');
INSERT INTO `tp_qymenu` VALUES ('56', '26', '44', '发起审批', '0', '', '流程审批', '1');
INSERT INTO `tp_qymenu` VALUES ('57', '26', '44', '未处理', '54', '', '流程审批', '1');
INSERT INTO `tp_qymenu` VALUES ('58', '26', '44', '已处理', '54', '', '流程审批', '1');
INSERT INTO `tp_qymenu` VALUES ('59', '26', '45', '差旅费', '51', '', '报销', '1');
INSERT INTO `tp_qymenu` VALUES ('60', '26', '45', '办公费', '51', '', '报销', '1');
INSERT INTO `tp_qymenu` VALUES ('61', '26', '45', '餐费', '51', '', '报销', '1');
INSERT INTO `tp_qymenu` VALUES ('62', '26', '45', '招待费', '51', '', '报销', '1');
INSERT INTO `tp_qymenu` VALUES ('63', '26', '45', '机票/火车票/汽车票等', '51', '', '报销', '1');
INSERT INTO `tp_qymenu` VALUES ('71', '28', '53', '4524', '70', '454545', '投票', '1');
INSERT INTO `tp_qymenu` VALUES ('72', '28', '53', '45454', '70', '4545', '流程审批', '1');
INSERT INTO `tp_qymenu` VALUES ('79', '28', '53', '12312321', '0', '', '企业邮箱', '1');
INSERT INTO `tp_qymenu` VALUES ('83', '81', '86', '一级菜单', '0', '', '', '1');
INSERT INTO `tp_qymenu` VALUES ('86', '99', '106', '我的投票', '0', '', '投票', '1');
INSERT INTO `tp_qymenu` VALUES ('87', '99', '106', '发起投票', '0', '', '投票', '1');
INSERT INTO `tp_qymenu` VALUES ('88', '26', '90', '我的日程', '0', '', '日程管理', '1');
INSERT INTO `tp_qymenu` VALUES ('89', '26', '90', '新建日程', '0', '', '日程管理', '1');
INSERT INTO `tp_qymenu` VALUES ('90', '26', '88', '名片夹', '0', '', '微名片', '1');
INSERT INTO `tp_qymenu` VALUES ('91', '26', '88', '我的名片', '0', '', '微名片', '1');
INSERT INTO `tp_qymenu` VALUES ('92', '99', '105', '我的任务', '0', '', '任务协作', '1');
INSERT INTO `tp_qymenu` VALUES ('93', '99', '105', '发布任务', '0', '', '任务协作', '1');
INSERT INTO `tp_qymenu` VALUES ('94', '26', '89', '预定', '0', '', '会议室预定', '1');
INSERT INTO `tp_qymenu` VALUES ('95', '26', '89', '我的预定', '0', '', '会议室预定', '1');
INSERT INTO `tp_qymenu` VALUES ('96', '26', '87', '待审批', '0', '', '请假', '1');
INSERT INTO `tp_qymenu` VALUES ('97', '26', '87', '我的假单', '0', '', '请假', '1');
INSERT INTO `tp_qymenu` VALUES ('98', '26', '87', '请假', '0', '', '请假', '1');
INSERT INTO `tp_qymenu` VALUES ('99', '26', '58', '我参与的', '0', '', '任务协作', '1');
INSERT INTO `tp_qymenu` VALUES ('100', '26', '58', '我负责的', '0', '', '任务协作', '1');
INSERT INTO `tp_qymenu` VALUES ('101', '26', '58', '我委托的', '0', '', '任务协作', '1');
INSERT INTO `tp_qymenu` VALUES ('105', '101', '111', '234234', '0', '', '通讯录', '1');
INSERT INTO `tp_qymenu` VALUES ('106', '101', '110', '1', '102', '', '流程审批', '1');
INSERT INTO `tp_qymenu` VALUES ('107', '101', '110', '流程', '0', '', '流程审批', '1');
INSERT INTO `tp_qymenu` VALUES ('108', '80', '129', '通讯录', '0', '', '通讯录', '1');
INSERT INTO `tp_qymenu` VALUES ('109', '80', '83', '报销', '0', '', '报销', '1');
INSERT INTO `tp_qymenu` VALUES ('110', '151', '142', '企业邮箱', '0', '', '企业邮箱', '1');
INSERT INTO `tp_qymenu` VALUES ('113', '176', '167', '依依', '0', '', '微名片', '1');
INSERT INTO `tp_qymenu` VALUES ('114', '191', '195', '会议室预定', '0', '', '会议室预定', '1');
INSERT INTO `tp_qymenu` VALUES ('115', '191', '178', '考勤', '0', '', '微信考勤', '1');
INSERT INTO `tp_qymenu` VALUES ('116', '225', '201', 'asdfsa', '0', '', '企业邮箱', '1');
INSERT INTO `tp_qymenu` VALUES ('117', '26', '88', '拍名片', '0', '', '微名片', '1');
INSERT INTO `tp_qymenu` VALUES ('590', '25', '211', '通讯录', '0', 'http://qy.workweixin.com/index.php?g=Qyapp&m=Address&a=wap_index&token=cS4j5p1419663723', null, '1');
INSERT INTO `tp_qymenu` VALUES ('613', '25', '35', '通讯录', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Address&a=wap_index&token=j2SH7Q1416453775', null, '1');
INSERT INTO `tp_qymenu` VALUES ('629', '25', '77', '我的名片', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Card&a=wap_index&token=iZYLo81417145013', null, '1');
INSERT INTO `tp_qymenu` VALUES ('628', '25', '77', '名片夹', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Card&a=wap_my_card&token=iZYLo81417145013', null, '1');
INSERT INTO `tp_qymenu` VALUES ('649', '25', '60', '请假', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Leave&a=wap_holiday&token=QVKcXC1416800879', null, '1');
INSERT INTO `tp_qymenu` VALUES ('648', '25', '60', '我的假单', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Leave&a=wap_list&token=QVKcXC1416800879', null, '1');
INSERT INTO `tp_qymenu` VALUES ('647', '25', '60', '待审核', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Leave&a=wap_wait_check&token=QVKcXC1416800879', null, '1');
INSERT INTO `tp_qymenu` VALUES ('192', '25', '228', '签到', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_index&token=TLPF211421382417', null, '1');
INSERT INTO `tp_qymenu` VALUES ('193', '25', '228', '签退', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_out&token=TLPF211421382417', null, '1');
INSERT INTO `tp_qymenu` VALUES ('194', '25', '228', '查询记录', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_records&token=TLPF211421382417', null, '1');
INSERT INTO `tp_qymenu` VALUES ('619', '25', '78', '会议室预定', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Meet&a=wap_index&token=oPjyWy1417145458', null, '1');
INSERT INTO `tp_qymenu` VALUES ('199', '25', '228', '外出签到', '192', 'http://qy.workweixin.com/index.php?g=Qyapp&m=Attendance&a=wap_index&token=TLPF211421382417', '', '1');
INSERT INTO `tp_qymenu` VALUES ('200', '25', '228', '工作期间签退', '193', 'http://qy.workweixin.com/index.php?g=Qyapp&m=Attendance&a=wap_index&token=TLPF211421382417', '', '1');
INSERT INTO `tp_qymenu` VALUES ('201', '25', '228', '按事件查询', '194', 'http://qy.workweixin.com/index.php?g=Qyapp&m=Attendance&a=wap_index&token=TLPF211421382417', '', '1');
INSERT INTO `tp_qymenu` VALUES ('634', '25', '257', '在线考试', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Test&a=wap_index&token=gYMA821426058325', null, '1');
INSERT INTO `tp_qymenu` VALUES ('644', '25', '134', '收到公告', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Announce&a=wap_index&token=trgB6j1418179850', null, '1');
INSERT INTO `tp_qymenu` VALUES ('228', '229', '233', '写邮件', '0', 'http://qy.workweixin.com/index.php?m=Email&a=wap_index&token=RNnUtn1422935566', null, '1');
INSERT INTO `tp_qymenu` VALUES ('232', '229', '235', '待审批', '0', 'http://qy.workweixin.com/index.php?m=Workflow&a=wap_act_list&token=1sAm3K1422948536', null, '1');
INSERT INTO `tp_qymenu` VALUES ('233', '229', '235', '我的审批', '0', 'http://qy.workweixin.com/index.php?m=Workflow&a=wap_act_my&token=1sAm3K1422948536', null, '1');
INSERT INTO `tp_qymenu` VALUES ('234', '229', '235', '发起审批', '0', 'http://qy.workweixin.com/index.php?m=Workflow&a=wap_index&token=1sAm3K1422948536', null, '1');
INSERT INTO `tp_qymenu` VALUES ('236', '232', '243', '签到', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_index&token=fFsPAT1423218386', null, '1');
INSERT INTO `tp_qymenu` VALUES ('237', '232', '243', '签退', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_out&token=fFsPAT1423218386', null, '1');
INSERT INTO `tp_qymenu` VALUES ('238', '232', '243', '查询记录', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_records&token=fFsPAT1423218386', null, '1');
INSERT INTO `tp_qymenu` VALUES ('239', '232', '246', '待审核', '0', 'http://qy.workweixin.com/index.php?m=Applyflow&a=wap_act_list&token=GjaWr21423219490', null, '1');
INSERT INTO `tp_qymenu` VALUES ('240', '232', '246', '我的报销', '0', 'http://qy.workweixin.com/index.php?m=Applyflow&a=wap_act_my&token=GjaWr21423219490', null, '1');
INSERT INTO `tp_qymenu` VALUES ('241', '232', '246', '申请报销', '0', 'http://qy.workweixin.com/index.php?m=Applyflow&a=wap_post&token=GjaWr21423219490', null, '1');
INSERT INTO `tp_qymenu` VALUES ('242', '232', '247', '待审批', '0', 'http://qy.workweixin.com/index.php?m=Workflow&a=wap_act_list&token=cBQAAt1423219661', null, '1');
INSERT INTO `tp_qymenu` VALUES ('243', '232', '247', '我的审批', '0', 'http://qy.workweixin.com/index.php?m=Workflow&a=wap_act_my&token=cBQAAt1423219661', null, '1');
INSERT INTO `tp_qymenu` VALUES ('244', '232', '247', '发起审批', '0', 'http://qy.workweixin.com/index.php?m=Workflow&a=wap_index&token=cBQAAt1423219661', null, '1');
INSERT INTO `tp_qymenu` VALUES ('245', '232', '249', '通讯录', '0', 'http://qy.workweixin.com/index.php?m=Address&a=wap_index&token=c3z7Km1423220140', null, '1');
INSERT INTO `tp_qymenu` VALUES ('594', '25', '147', '企业官网', '0', 'http://qy.workweixin.com/index.php?g=Qyapp&m=Home&a=wap_index&token=sfM02N1418439970', null, '1');
INSERT INTO `tp_qymenu` VALUES ('247', '229', '234', '签到', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_index&token=sPYAc41422943640', null, '1');
INSERT INTO `tp_qymenu` VALUES ('248', '229', '234', '签退', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_out&token=sPYAc41422943640', null, '1');
INSERT INTO `tp_qymenu` VALUES ('249', '229', '234', '查询记录', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_records&token=sPYAc41422943640', null, '1');
INSERT INTO `tp_qymenu` VALUES ('250', '231', '250', '', '0', 'http://qy.workweixin.com/index.php?g=Qyapp&m=Vote&a=wap_index&token=POimyH1423301916', '', '1');
INSERT INTO `tp_qymenu` VALUES ('251', '229', '251', '知识库', '0', 'http://qy.workweixin.com/index.php?m=Knowledge&a=wap_index&token=vAI8K41423533794', null, '1');
INSERT INTO `tp_qymenu` VALUES ('252', '229', '251', '我的收藏', '0', 'http://qy.workweixin.com/index.php?m=Knowledge&a=wap_my&token=vAI8K41423533794', null, '1');
INSERT INTO `tp_qymenu` VALUES ('625', '25', '232', '添加外勤', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Legwork&a=wap_add&token=VgabEh1421482391', null, '1');
INSERT INTO `tp_qymenu` VALUES ('624', '25', '232', '签到/退', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Legwork&a=wap_check&token=VgabEh1421482391', null, '1');
INSERT INTO `tp_qymenu` VALUES ('295', '233', '256', '签到', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_shark&token=AxWhmz1425264447', null, '1');
INSERT INTO `tp_qymenu` VALUES ('296', '233', '256', '签退', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_out&token=AxWhmz1425264447', null, '1');
INSERT INTO `tp_qymenu` VALUES ('297', '233', '256', '查询记录', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_records&token=AxWhmz1425264447', null, '1');
INSERT INTO `tp_qymenu` VALUES ('304', '233', '253', '外勤列表', '0', 'http://qy.workweixin.com/index.php?m=Legwork&a=wap_index&token=L76KGT1423713755', null, '1');
INSERT INTO `tp_qymenu` VALUES ('305', '233', '253', '签到/退', '0', 'http://qy.workweixin.com/index.php?m=Legwork&a=wap_check&token=L76KGT1423713755', null, '1');
INSERT INTO `tp_qymenu` VALUES ('306', '233', '253', '添加外勤', '0', 'http://qy.workweixin.com/index.php?m=Legwork&a=wap_add&token=L76KGT1423713755', null, '1');
INSERT INTO `tp_qymenu` VALUES ('307', '233', '252', '知识库', '0', 'http://qy.workweixin.com/index.php?m=Knowledge&a=wap_index&token=lZl3YJ1423539172', null, '1');
INSERT INTO `tp_qymenu` VALUES ('308', '233', '252', '我的收藏', '0', 'http://qy.workweixin.com/index.php?m=Knowledge&a=wap_my&token=lZl3YJ1423539172', null, '1');
INSERT INTO `tp_qymenu` VALUES ('309', '230', '238', '签到', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_shark&token=jidMq91423117631', null, '1');
INSERT INTO `tp_qymenu` VALUES ('310', '230', '238', '签退', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_out&token=jidMq91423117631', null, '1');
INSERT INTO `tp_qymenu` VALUES ('311', '230', '238', '查询记录', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_records&token=jidMq91423117631', null, '1');
INSERT INTO `tp_qymenu` VALUES ('312', '233', '258', '企业图书馆', '0', 'http://qy.workweixin.com/index.php?m=Borrow_books&a=wap_index&token=bXeJAy1426123935', null, '1');
INSERT INTO `tp_qymenu` VALUES ('313', '233', '258', '我的借阅', '0', 'http://qy.workweixin.com/index.php?m=Borrow_books&a=wap_my&token=bXeJAy1426123935', null, '1');
INSERT INTO `tp_qymenu` VALUES ('314', '25', '0', '1111', '0', '1111', '', '1');
INSERT INTO `tp_qymenu` VALUES ('315', '235', '259', '签到', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_shark&token=SXKScs1426486015', null, '1');
INSERT INTO `tp_qymenu` VALUES ('316', '235', '259', '签退', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_out&token=SXKScs1426486015', null, '1');
INSERT INTO `tp_qymenu` VALUES ('317', '235', '259', '查询记录', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_records&token=SXKScs1426486015', null, '1');
INSERT INTO `tp_qymenu` VALUES ('626', '25', '39', '参与投票', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Vote&a=wap_index&token=xJhBup1416454418', null, '1');
INSERT INTO `tp_qymenu` VALUES ('631', '25', '236', '我的收藏', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Knowledge&a=wap_collect&token=BmKNFK1423105135', null, '1');
INSERT INTO `tp_qymenu` VALUES ('630', '25', '236', '知识库', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Knowledge&a=wap_index&token=BmKNFK1423105135', null, '1');
INSERT INTO `tp_qymenu` VALUES ('643', '25', '134', '发公告', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Announce&a=wap_add_task&token=trgB6j1418179850', null, '1');
INSERT INTO `tp_qymenu` VALUES ('641', '25', '40', '申请报销', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Applyflow&a=wap_post&token=Xq72pX1416454549', null, '1');
INSERT INTO `tp_qymenu` VALUES ('640', '25', '40', '我的报销', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Applyflow&a=wap_act_my&token=Xq72pX1416454549', null, '1');
INSERT INTO `tp_qymenu` VALUES ('639', '25', '40', '待审核', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Applyflow&a=wap_act_list&token=Xq72pX1416454549', null, '1');
INSERT INTO `tp_qymenu` VALUES ('339', '25', '0', '大塞弗', '0', 'http://qy.workweixin.com/index.php?g=Qyapp&m=Research&a=wap_index&token=BnQr0b1416453945', '', '1');
INSERT INTO `tp_qymenu` VALUES ('627', '25', '36', '我的调研', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Research&a=wap_index&token=BnQr0b1416453945', null, '1');
INSERT INTO `tp_qymenu` VALUES ('638', '25', '37', '发起审批', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Workflow&a=wap_index&token=H5P8FO1416454149', null, '1');
INSERT INTO `tp_qymenu` VALUES ('633', '25', '240', '我的借阅', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Borrow_books&a=wap_my&token=ChNAUP1423191617', null, '1');
INSERT INTO `tp_qymenu` VALUES ('632', '25', '240', '企业图书馆', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Borrow_books&a=wap_index&token=ChNAUP1423191617', null, '1');
INSERT INTO `tp_qymenu` VALUES ('356', '25', '0', '111', '0', 'http://111.html', '', '1');
INSERT INTO `tp_qymenu` VALUES ('646', '25', '57', '任务管理', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Task&a=wap_index_one&token=bCE4yc1416799692', null, '1');
INSERT INTO `tp_qymenu` VALUES ('645', '25', '57', '添加任务', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Task&a=wap_add_task&token=bCE4yc1416799692', null, '1');
INSERT INTO `tp_qymenu` VALUES ('635', '25', '262', '我的推荐', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Distribution&a=wap_index&token=vHGekh1427512616', null, '1');
INSERT INTO `tp_qymenu` VALUES ('471', '25', '34', '查询记录', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_records&token=dAVk6B1416453534', null, '1');
INSERT INTO `tp_qymenu` VALUES ('470', '25', '34', '签退', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_out&token=dAVk6B1416453534', null, '1');
INSERT INTO `tp_qymenu` VALUES ('469', '25', '34', '签到', '0', 'http://qy.workweixin.com/index.php?m=Attendance&a=wap_shark&token=dAVk6B1416453534', null, '1');
INSERT INTO `tp_qymenu` VALUES ('637', '25', '37', '我的审批', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Workflow&a=wap_act_my&token=H5P8FO1416454149', null, '1');
INSERT INTO `tp_qymenu` VALUES ('615', '25', '59', '我的红包', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Hiring&a=wap_money&token=xkFbOs1416800816', null, '1');
INSERT INTO `tp_qymenu` VALUES ('623', '25', '232', '外勤列表', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Legwork&a=wap_index&token=VgabEh1421482391', null, '1');
INSERT INTO `tp_qymenu` VALUES ('614', '25', '59', '我的推荐', '0', 'http://anlixia.com/index.php?g=Qyapp&m=Hiring&a=wap_index&token=xkFbOs1416800816', null, '1');
INSERT INTO `tp_qymenu` VALUES ('604', '25', '38', '写邮件', '0', 'http://qy.workweixin.com/index.php?g=Qyapp&m=Email&a=wap_index&token=OR3B9Q1416454281', null, '1');
INSERT INTO `tp_qymenu` VALUES ('636', '25', '37', '待审批', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Workflow&a=wap_act_list&token=H5P8FO1416454149', null, '1');
INSERT INTO `tp_qymenu` VALUES ('642', '25', '84', '日程管理', '0', 'http://121.40.76.167/index.php?g=Qyapp&m=Day&a=wap_index&token=O2W7Ai1417402380', null, '1');

-- ----------------------------
-- Table structure for `tp_qymyapp`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qymyapp`;
CREATE TABLE `tp_qymyapp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) DEFAULT NULL,
  `name` varchar(16) DEFAULT NULL,
  `appid` int(11) DEFAULT NULL COMMENT '微信那边的id',
  `userid` int(11) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `outh_host` varchar(32) DEFAULT NULL,
  `encodingkey` varchar(255) DEFAULT NULL,
  `fun_id` int(11) DEFAULT NULL COMMENT '微易平台应用id',
  `module` varchar(16) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '安装完成',
  `reply_img` varchar(300) DEFAULT NULL,
  `suit_id` varchar(64) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '1' COMMENT '1为正常安装,2为s授权安装',
  `category` smallint(4) DEFAULT NULL COMMENT '1基础功能 2 3G网站 3营销活动 4行业模块 5商务模块 6CRM系统 7互动模块',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=272 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qymyapp
-- ----------------------------
INSERT INTO `tp_qymyapp` VALUES ('12', 'CZKmr91414308718', '企业邮箱', '9', '1', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', '/Tpl/static/images/icon/youxiang.png', 'dexingky.wxopen.cn', 'KlxUgtJdStpyGwnTgoZHKg5WGR25cqE7SEhtOLN9Btv', '2', 'Email', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('17', 'tsns2b1415255458', '报销', '15', '1', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', '/Tpl/static/images/icon/baoxiao.png', 'qy.wxopen.cn', 'WJbRbSudsm2sz9siUJOYj3Hc5Ada7jXDJH1NLHZozNY', '4', 'Applyflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('18', 'E4XvXj1415255487', '流程审批', '6', '1', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'qy.wxopen.cn', '3iuj6U45F423SZfdjn324uhtJ0h1oaTBFGsJCMPlSam', '5', 'Workflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('21', 'xGQVsR1415255573', '通讯录', '8', '1', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', 'Zt1mQsdM7cvc1yQdiSIV805VhhqiWxHEO8n49UqaFcj', '8', 'Address', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('22', 'yGwnTg1415255595', '调研', '12', '1', '调研应用，实时收集来自团队的宝贵意见，数据分析直观明了，有效提高您的调研质量。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140905/62cc0bd387a920806df82266079d8d7a.png', 'dexingky.wxopen.cn', 'oZHKg5WGR25cqE7SEhtOLN9BtvBk1gNA7qduYPOBjO4', '9', 'Research', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('24', '0bFb6p1415262145', '企业邮箱', '3', '17', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'dexingky.wxopen.cn', '6QDpDwN1eMjAmKpXYZNtzDHZ5ePQ1UqRjebpskkjpLz', '2', 'Email', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('26', 'YuxvR31415529469', '报销', '6', '17', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'dexingky.wxopen.cn', 'd3mwimX01hC56aNRKRtVHG8mavIMSFHg104plRhj35i', '4', 'Applyflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('27', 'vzvxi31415763497', '投票', '11', '1', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'dexingky.wxopen.cn', '0KEbOFrWxZ0MhYaGBij7Ddf3WpkXD7pNi4O22toEq2v', '3', 'Vote', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('28', '6boyG81415763636', '任务协作', '6', '1', '任务管理应用，轻松安排您与团队每一天的工作分派，实时掌握工作进度，有效提高您和团队的工作效率。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/73b78dd4a9986ac6fb9ba95cb25f10ed.png', 'dexingky.wxopen.cn', 'F7M5SF6muhSPuxOOjz99XXAdSLmO2DakVCfzukiTdRy', '6', 'Task', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('29', 'oyG8F71415932753', '调研', '33', '17', '调研应用，实时收集来自团队的宝贵意见，数据分析直观明了，有效提高您的调研质量。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140905/62cc0bd387a920806df82266079d8d7a.png', 'dexingky.wxopen.cn', 'M5SF6muhSPuxOOjz99XXAdSLmO2DakVCfzukiTdRy94', '9', 'Research', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('30', 'tuolSu1415954553', '流程审批', '0', '17', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'dexingky.wxopen.cn', 'Uv5GmMJN4FR3U66aczwlM1Kk1XQkLkp3jByKyKR5Peq', '5', 'Workflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('31', 'tYx4Wp1415954580', '通讯录', '0', '17', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', 'JFpCIUkIHDHircYq7r7JtHBiHPpHyaY3eyiWrlQsqmz', '8', 'Address', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('32', 'pAZmty1415954769', '投票', '5', '17', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'dexingky.wxopen.cn', 'kXka8qchnnNdwTmPyzAtUvHYAiqG21Yseh3CEaU1fif', '3', 'Vote', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('33', 'Qmn7M51416044546', '微信考勤', '10', '1', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'dexingky.wxopen.cn', 'uXkSbaPbAX9Zh1BLlC3tnrPAuIN4gahpNZ7yFVGYZcM', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('268', '6nizf71429166031', '微信考勤', '0', '250', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.workweixin.com', '3xOUhGJnEluAqn49i8V9vq2cLCRngymhLz20svO84Jc', '1', 'Attendance', '1', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('269', 'Ous4ib1429268618', '微信考勤', '18', '25', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', './Static/thumb/thumb_Attendance.jpg', '121.40.76.167', 'mPxYhfpON1eb1mQ3v0CTo9nFfxtQanKoKnxM5MHZMhz', '1', 'Attendance', '1', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('35', 'j2SH7Q1416453775', '通讯录', '15', '25', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'anlixia.com', 'CNliijlPXtXqe0wxb5TaruqK4oVhFwMcl6NvFRlEL0f', '8', 'Address', '2', 'http://pic.yesky.com/42/36897542d_7.shtml', null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('36', 'BnQr0b1416453945', '调研', '16', '25', '调研应用，实时收集来自团队的宝贵意见，数据分析直观明了，有效提高您的调研质量。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140905/62cc0bd387a920806df82266079d8d7a.png', 'anlixia.com', 'Fb6p6QDpDwN1eMjAmKpXYZNtzDHZ5ePQ1UqRjebpskk', '9', 'Research', '2', null, null, '1', '3');
INSERT INTO `tp_qymyapp` VALUES ('37', 'H5P8FO1416454149', '流程审批', '19', '25', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', '121.40.76.167', 'PPwziWQ2CXJtBRMzC55zvDfaAXlAJ2Zygkgh2NKupWz', '5', 'Workflow', '1', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('38', 'OR3B9Q1416454281', '企业邮箱', '18', '25', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'qy.workweixin.com', 'N5L6HyMSAXKTNLNlcWvZ7XY0oMN8oT3AWfl5njLQz4V', '2', 'Email', '2', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('39', 'xJhBup1416454418', '投票', '19', '25', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'anlixia.com', 'ewFyM5apLhAGvy0ASU1RcMJHj9JQAu7uQLsnrrTIduY', '3', 'Vote', '2', null, null, '1', '3');
INSERT INTO `tp_qymyapp` VALUES ('40', 'Xq72pX1416454549', '报销', '20', '25', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', '121.40.76.167', 'Yovf3VO2J7qvPWYpHQvWcOEPDjujTjC4hh7lFaBRot9', '4', 'Applyflow', '1', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('41', 'srb4bD1416455824', '微信考勤', '0', '17', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'dexingky.wxopen.cn', 'zk34GgDvTn291ARHqpboWMBWVbezcADZ8sVqyLGANY0', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('42', 'GFWACb1416467572', '通讯录', '3', '26', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', 'Q4DQyMzDHoN0k97W4KUUZr0SIVKjjqYaoE2W1PMAPGx', '8', 'Address', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('43', 'QxFkZ21416467820', '调研', '1', '26', '调研应用，实时收集来自团队的宝贵意见，数据分析直观明了，有效提高您的调研质量。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140905/62cc0bd387a920806df82266079d8d7a.png', 'qy.wxopen.cn', 'I0AzXLu6Zj25TR5wh9XReow3lj5BI7xtWwb66LTuOxZ', '9', 'Research', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('44', 'Iy9LsM1416468173', '流程审批', '2', '26', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'qy.wxopen.cn', 'xU9wDDEL0EiYLbW8uWUGh93BKxJnXiLXwbvOxnNUADZ', '5', 'Workflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('45', 'R3d3mw1416468921', '报销', '4', '26', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'qy.wxopen.cn', 'imX01hC56aNRKRtVHG8mavIMSFHg104plRhj35izR1A', '4', 'Applyflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('46', '6PwaZR1416472170', '投票', '5', '26', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'dexingky.wxopen.cn', '7eO17eUMDm75flMq3pKLEgmz78tP4JpYAi1ZgwFlcDa', '3', 'Vote', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('47', 'YUKCth1416472759', '企业邮箱', '6', '26', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'dexingky.wxopen.cn', 'NhzRCSuvc1XxZNbPXMUGA6jYQk92byCHBoslxURMXIz', '2', 'Email', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('48', 'Ejzs6d1416479765', '微信考勤', '7', '26', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'dexingky.wxopen.cn', 'jG0iqA4UnexS9f6ycGZNuaVVuM7Nc7jK2hGD1QZMAVr', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('49', 'YXbivP1416542217', '企业邮箱', '0', '27', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'dexingky.wxopen.cn', '2kd4ywr8Q622tNlcxOdCESXKScszQv2yD0yEPrklw0d', '2', 'Email', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('50', 'cTc91h1416625633', '微信考勤', '0', '28', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'dexingky.wxopen.cn', 'Ur3joXiym4a71CFA6Vg4PQV9UJ6VzqNZwfrqZ41QGe1', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('51', 'whLg5J1416625758', '企业邮箱', '0', '28', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'dexingky.wxopen.cn', '6p1HqvWU4ZVyUQzngyYzZ4JTqRVxpU9dhFwaU7B6BIv', '2', 'Email', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('52', 'aqzagc1416625779', '投票', '0', '28', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'dexingky.wxopen.cn', 'AfTEb70p486xt97D7uyOc1lEs3Ze6traRAbyWg9Y3PR', '3', 'Vote', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('53', 'sVkcXk1416625807', '报销', '0', '28', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'dexingky.wxopen.cn', 'SNs3GhQ6lnqVWi4v5L6iR0nhQIfUa8x9oXAvCrgUrgU', '4', 'Applyflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('54', 'NlADht1416625824', '流程审批', '0', '28', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'dexingky.wxopen.cn', 'q31EinsXqqBYyzSOSEi47ZiQurRHJmrK2z2B9r5jhNA', '5', 'Workflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('55', 'Hu2RAh1416625844', '通讯录', '0', '28', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', 'UKCRZzMSYEwo6RQZ5wbN9uwo07kRTdzOu9Ik2MJ0gp6', '8', 'Address', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('56', 'WnULJ61416625861', '调研', '0', '28', '调研应用，实时收集来自团队的宝贵意见，数据分析直观明了，有效提高您的调研质量。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140905/62cc0bd387a920806df82266079d8d7a.png', 'dexingky.wxopen.cn', 'CdsEoqIKyPCBXrJWWHaYmzwrxxSxlzPZ68t1FcpmmdJ', '9', 'Research', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('57', 'bCE4yc1416799692', '任务协作', '23', '25', 'iWork365任务管理应用，轻松安排您与团队每一天的工作分派，实时掌握工作进度，有效提高您和团队的工作效率。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/73b78dd4a9986ac6fb9ba95cb25f10ed.png', '121.40.76.167', 'TAfuyIQcZVsy2dEg31yxRkK7PBjdLOQx3rsjvqJfufL', '6', 'Task', '1', './TempFile/admin/image/20141225160620775.jpg', null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('58', 'hTkqXX1416799815', '任务协作', '8', '26', 'iWork365任务管理应用，轻松安排您与团队每一天的工作分派，实时掌握工作进度，有效提高您和团队的工作效率。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/73b78dd4a9986ac6fb9ba95cb25f10ed.png', 'qy.wxopen.cn', 'Nc1yeU4n11bEYwX6sQtVjZmSRpG8Y42rYsw1JwJAyKL', '6', 'Task', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('59', 'xkFbOs1416800816', '招聘', '87', '25', '招聘招聘招聘招聘', './Static/thumb/thumb_Hiring.png', 'anlixia.com', 'QuxBdRzLm2fnpdprU8poZ05eexNoJYmS4089mRX9bgb', '10', 'Hiring', '2', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('60', 'QVKcXC1416800879', '请假', '24', '25', '请假请假请假', './Static/thumb/thumb_Performance.png', '121.40.76.167', 'Csn95VACorwDelHhQv29Ve3lIoGrVkpyMTbfYouELHi', '11', 'Leave', '1', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('61', '1mQsdM1416820546', '流程审批', '1', '34', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'qy.wxopen.cn', '7cvc1yQdiSIV805VhhqiWxHEO8n49UqaFcj0yR1bye0', '5', 'Workflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('62', 'mokYQI1416822380', '微信考勤', '5', '35', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'ROGRJKfh30lWpkmkTT6p7sVD9dGYATIUxIRpAnsWP8m', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('63', 'x4D3Lw1416836519', '微信考勤', '1', '37', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'OwacszfcO2W7AiI2Z9yyLYWL6BOgKnD8U8pZieAV7v9', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('64', 'HzhdHS1416836714', '投票', null, '37', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'dexingky.wxopen.cn', 'e5mcxcUo8b4Nw53fFxA61CSbyVERKy8Xz52PtDzjrMs', '3', 'Vote', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('65', '5c7i9K1416845487', '微信考勤', null, '40', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'dexingky.wxopen.cn', '3bW7SDGaAf6fD7ob0Qjl8v2x1Ik88xmZpBTpmY7gVgL', '1', 'Attendance', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('66', 'kr4cqR1416845529', '报销', '0', '40', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'qy.wxopen.cn', 'HkEFgJt0XgQqvef28wEryrwJZRPu972Og27j3Zx3JOh', '4', 'Applyflow', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('67', 'gqUrmE1416879827', '微信考勤', '0', '41', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'm6SETL2gu2yPB0Edef3JOSXflt55g9F6zuqEIzzzF1P', '1', 'Attendance', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('68', 'jXEkZf1416879881', '企业邮箱', null, '41', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'dexingky.wxopen.cn', 'jsBXKGcjNXp0NMjiC5uSzm3XwzBhNbd3gau0f0vkADT', '2', 'Email', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('69', 'Bw7MoP1416906946', '微信考勤', '1', '44', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'VssiHw3JpzSwwG9t1sBXlYqOuRnmUbDtzxWtX1we1e5', '1', 'Attendance', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('70', 'eow3lj1416919798', '微信考勤', '0', '46', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', '5BI7xtWwb66LTuOxZ685kTH6fkzQBomZIy9LsMxU9wD', '1', 'Attendance', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('71', 'VWoqjr1416925252', '通讯录', '3', '49', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', 't7NN1PtfRxWtmJiIkl7H9RvDDg4e9ZSIx2xO7R8KLrg', '8', 'Address', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('72', 'Zk9kxw1416926355', '企业邮箱', null, '50', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'dexingky.wxopen.cn', 'LiHV9dGniFddEKvjb3hZnGL5cdEX6Lcr4U5TzKy8zRj', '2', 'Email', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('73', 'T600YF1416983626', '微信考勤', null, '52', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'dexingky.wxopen.cn', 'PJ40r6Ce3XCVpDvbI0hCHooiyEOP161jkCYkax8YMGu', '1', 'Attendance', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('74', 'prwqDT1417070501', '报销', '0', '61', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'qy.wxopen.cn', 'GT3AkW7AGqOusFApSxrVDlO8ZYGDCKwwMvinaBti0S1', '4', 'Applyflow', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('75', 'PknPe11417078404', '任务协作', null, '62', 'iWork365任务管理应用，轻松安排您与团队每一天的工作分派，实时掌握工作进度，有效提高您和团队的工作效率。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/73b78dd4a9986ac6fb9ba95cb25f10ed.png', 'qy.wxopen.cn', '1Sj1nmZV9BMQytCmkiZzFUR4jGHXsrtOQxEJGOcjHBB', '6', 'Task', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('76', 'bFNpDC1417099462', '企业邮箱', '5', '67', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'qy.wxopen.cn', 'xwmZCclpKL2Y84qfvsXk4MCQznSRc5GYGfwgfImmBPF', '2', 'Email', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('77', 'iZYLo81417145013', '微名片', '23', '25', '微名片', './Static/thumb/thumb_Card.png', 'anlixia.com', 'SJPouXIYFrDAJDGtxwslry3qfI3pltzxyMbwd7ZAbsA', '12', 'Card', '2', './TempFile/admin/image/20141231160713236.png', null, '1', '5');
INSERT INTO `tp_qymyapp` VALUES ('78', 'oPjyWy1417145458', '会议室预定', '24', '25', '会议室预定', './static/thumb/thumb_Knowledge.png', 'anlixia.com', 'vWcqX390ogfq1otezNhygkEZOi3BrAs0RvkiiVD3sbQ', '13', 'Meet', '2', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('79', 'CQaF6m1417183902', '微信考勤', '9', '71', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'TYEkNERsdaOYZu8Bu6TyxXGytxCOaNg3VcJvCJCSAR0', '1', 'Attendance', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('80', 'zq5kuo1417194921', '通讯录', '0', '72', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', '2wwLUZ9EUzkELCyPIXLNrWrDbqzXFKAR6JtUcKIdbCg', '8', 'Address', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('81', 'sqFwtf1417271566', '企业邮箱', '1', '75', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'qy.wxopen.cn', '5KHIfd7oTgbofJSj1YEdrQvKcFSXyiKsb3AklPmbJUx', '2', 'Email', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('82', 'iFOwSf1417360065', '微信考勤', '8', '80', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'cc9pooHRIxEP2Cz1H7yGxYcuTGBHCcl12ZxF12MlUN8', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('83', 'l3YJa31417360559', '报销', '7', '80', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'qy.wxopen.cn', 'ibY8LtY8maUqymYOjFTF59UPRrHC6BvUMe32nrxQPNH', '4', 'Applyflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('84', 'O2W7Ai1417402380', '日程管理', '21', '25', '日程管理', './Static/thumb/thumb_Day.png', '121.40.76.167', 'I2Z9yyLYWL6BOgKnD8U8pZieAV7v9v8ixQwsKx2kdFR', '14', 'Day', '1', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('85', 'HBZmRg1417410142', '微信考勤', '17', '32', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', '6sDhb45S3cQL4hYa5j4NqJfTXx590bFNpDCxwmZCclp', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('86', 'lBeAHV1417490016', '投票', '0', '81', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'qy.wxopen.cn', 'KUBEtRhCo3qaXyh89XyTrntfMoJzE6AH16IYmuneDQg', '3', 'Vote', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('87', 'awC1mx1417505372', '请假', '9', '26', '请假请假请假', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/image_43_65_bc_9e_20140905_deb3a6b32d7069481c97bdcccdf05d8b.png', 'qy.wxopen.cn', 'vXp1p4xNjYseGLo8t13TbQFkLQXMH585VbVCWdxcHNG', '11', 'Leave', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('88', 'qCMrfo1417507689', '微名片', '10', '26', '微名片', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/mp.png', 'qy.wxopen.cn', 'UywmokYQIROGRJKfh30lWpkmkTT6p7sVD9dGYATIUxI', '12', 'Card', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('89', 'zbL80o1417508057', '会议室预定', '12', '26', '会议室预定', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/hh.png', 'qy.wxopen.cn', 'SxEw5mcVUGTrh6rqGJ4H58uDXqV3gb5itvceyZZbYKF', '13', 'Meet', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('90', 'BCtAKx1417508356', '日程管理', '13', '26', '日程管理', 'http://qy.wxopen.cn/Tpl/Qyapp/Appslist/images/123.png', 'qy.wxopen.cn', 'VYpj9JrTICbKIOuQL4GFWACbQ4DQyMzDHoN0k97W4KU', '14', 'Day', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('91', 'dwTX8M1417536195', '任务协作', '0', '87', 'iWork365任务管理应用，轻松安排您与团队每一天的工作分派，实时掌握工作进度，有效提高您和团队的工作效率。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/73b78dd4a9986ac6fb9ba95cb25f10ed.png', 'qy.wxopen.cn', '4hmSRNnUtn8uCm7Hxzh7Wm6S3AxxzA4cJcFtfMNrl9p', '6', 'Task', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('92', 'GJF0jD1417536251', '企业邮箱', '0', '87', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'qy.wxopen.cn', 'bwVM1sAm3KV7AT1gvQsw75l5iygImLjBaD5t3GGxSQG', '2', 'Email', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('93', 'BIObvN1417536345', '投票', '0', '87', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'qy.wxopen.cn', 'V5zpSJ2nEKB3HbuiZFqqZhCiHCOfxMb8wluh5qWycAe', '3', 'Vote', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('94', 'hmXCjv1417536425', '微信考勤', '0', '87', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', '7MZ89Y9bFSa8KKQYYix9tI6DPKST7CIUW1V8oboy5Pr', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('95', '8FqJlf1417536510', '报销', '0', '87', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'qy.wxopen.cn', 'LTN9v7HeC1LQzFdOlGMvn7GJFBCRGdOJnyZGeInzchG', '4', 'Applyflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('96', '33YJLl1417536631', '流程审批', '0', '87', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'qy.wxopen.cn', 'wHF1JP5xHlSS0YmtLVpkzVlUub2a8rNzBSu7ufseSKx', '5', 'Workflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('97', 'lhG17k1417536681', '通讯录', '0', '87', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', 'gAZ47BcmeDry3OXuyIsvdr9r0zLFncwZjW8MhSOSfAi', '8', 'Address', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('98', 'C5bVjZ1417536799', '调研', '0', '87', '调研应用，实时收集来自团队的宝贵意见，数据分析直观明了，有效提高您的调研质量。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140905/62cc0bd387a920806df82266079d8d7a.png', 'qy.wxopen.cn', 'Xa5Un2Wq8QjDutb87f11h0NSF6YNvnwnvaUIUk7ppcB', '9', 'Research', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('99', 'xeCkI61417536827', '请假', '0', '87', '请假请假请假', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/image_43_65_bc_9e_20140905_deb3a6b32d7069481c97bdcccdf05d8b.png', 'qy.wxopen.cn', 'WM0fZU2m8cSGcB8VyBTj0aLxVLOR8lFY0pn5mTAWyil', '11', 'Leave', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('100', 'Kpzhei1417536852', '微名片', '0', '87', '微名片', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/mp.png', 'qy.wxopen.cn', 'bsA36uy1Ntm2fZHrU8O6LuokgbGZoMoqCoKtTBruIuJ', '12', 'Card', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('101', 'i1Gjgi1417536881', '会议室预定', '0', '87', '会议室预定', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/hh.png', 'qy.wxopen.cn', 'focvNIu7ouX6FrVWHMhA4dkvTYWFKNryKRH7sV1QZbh', '13', 'Meet', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('102', 'HVmO8n1417536903', '日程管理', '0', '87', '日程管理', 'http://qy.wxopen.cn/Tpl/Qyapp/Appslist/images/123.png', 'qy.wxopen.cn', 'Gs8VRyaF6Xbc91GCdyCv0WrXKZ9z94crs0yam9HP6mA', '14', 'Day', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('103', 'fTEAOM1417579113', '微名片', '0', '92', '微名片', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/mp.png', 'qy.wxopen.cn', 'Tnf8bnKNs925cOlTnXovsEoOqw38IDBkkCLJIwKbRYh', '12', 'Card', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('104', 'u4hnt91417672718', '企业邮箱', '2', '98', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'qy.wxopen.cn', '1TBmluA1GiEZ1TvCPmoI4jZEdPxhevLUBrSpgeB7IX9', '2', 'Email', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('105', 'b8wluh1417673541', '任务协作', '3', '99', 'iWork365任务管理应用，轻松安排您与团队每一天的工作分派，实时掌握工作进度，有效提高您和团队的工作效率。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/73b78dd4a9986ac6fb9ba95cb25f10ed.png', 'qy.wxopen.cn', '5qWycAehmXCjv7MZ89Y9bFSa8KKQYYix9tI6DPKST7C', '6', 'Task', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('106', 'wN0Du51417674573', '投票', '4', '99', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'qy.wxopen.cn', '5FRrBSAtiBafnHznzveW5R9yE7Mit76KhcA2icbJdum', '3', 'Vote', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('107', 'VvGnh41417683861', '请假', '0', '100', '及时的消息提醒,简单的处理方式,精简的审批流程,方便您及时高效处理请假申请。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/image_43_65_bc_9e_20140905_deb3a6b32d7069481c97bdcccdf05d8b.png', 'qy.wxopen.cn', 'UZ83ClPXSEcIjDAPZuPfwYis0gOp16JzEISVwNCVIAM', '11', 'Leave', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('108', 'j0M3Lq1417683936', '微信考勤', '0', '100', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'sIOus4ibmPxYhfpON1eb1mQ3v0CTo9nFfxtQanKoKnx', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('109', 'dcxvRE1417683975', '报销', '0', '100', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'qy.wxopen.cn', 'vhRdbjj7qCN3yCpfqjKqnaUOg8t7pHxyGPIRpZ5er8f', '4', 'Applyflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('110', 'V3fzN41417685887', '流程审批', '3', '101', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'qy.wxopen.cn', 'YOjgcTAQNMdx6XhyXnoCIvDWdkBfNinLiozb45gLYl4', '5', 'Workflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('111', 'OGa5In1417686115', '通讯录', '2', '101', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', 'S9x3PyMMd9obNfRkKJ7POUFMcDsLEgYSlDaI15vnUtZ', '8', 'Address', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('112', 'WrK9x91417692329', '微信考勤', null, '102', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'dexingky.wxopen.cn', 'bn8ueElcesft3Lq30209XgxtfS9fHRqbGGrw1kPX5fE', '1', 'Attendance', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('113', 'goTXe81417697139', '微信考勤', '2', '103', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'TD4SmKomGLiMFFlTGUESzrOtEMUTNQyRk8PB6CjOsK8', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('114', 'GWg3Cf1417697648', '报销', '3', '103', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'qy.wxopen.cn', 't8wWbdmB8CBlxddK6jFT4MVo8YtlwHgkXkMrEHYhl9k', '4', 'Applyflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('115', 'KfhrI71417707222', '流程审批', null, '105', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'dexingky.wxopen.cn', 'rIqoYNuMd90t1LyeI5de95CeFfQq6xtxPpCNEQQUWjh', '5', 'Workflow', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('116', 'OcI0Gk1417764405', '企业邮箱', null, '109', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'dexingky.wxopen.cn', 'tTHpBiIqHV3RS1AFHhCiiV2KeF9uCKPt2SoaAgHyRD5', '2', 'Email', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('117', 'RjVe851417769367', '微名片', '2', '81', '创建个性名片,收纳海量好友,是一款时尚又新潮,简单又好用的电子名片管理应用。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/mp.png', 'qy.wxopen.cn', 'exTKxk4TAW9Azf6seApAML1yWapsVCxUstT0KyqjxeC', '12', 'Card', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('118', '8wlTZR1417789774', '任务协作', '0', '111', '任务管理应用，轻松安排您与团队每一天的工作分派，实时掌握工作进度，有效提高您和团队的工作效率。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/73b78dd4a9986ac6fb9ba95cb25f10ed.png', 'qy.wxopen.cn', 'UfFfe8S1MER3vokFTsuHTr4wZpiW9ZSkPg2v0PuQaLs', '6', 'Task', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('119', 'eO7t2g1417794963', '企业邮箱', '0', '112', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'qy.wxopen.cn', 'uDR37HyaAls3ZQpHWRKyxFlAlWwhsU7Bvju0xlttbKq', '2', 'Email', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('120', 'bNfRkK1417830241', '会议室预定', '0', '81', '高效的会议室预定管理应用,解决您烦恼的会议室预定管理问题。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/hh.png', 'qy.wxopen.cn', 'J7POUFMcDsLEgYSlDaI15vnUtZrI831ETFGs8kykEYd', '13', 'Meet', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('121', 'kcXkSN1417832332', '微信考勤', '0', '113', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 's3GhQ6lnqVWi4v5L6iR0nhQIfUa8x9oXAvCrgUrgUQY', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('122', '8v8TP41417845512', '微名片', '0', '116', '创建个性名片,收纳海量好友,是一款时尚又新潮,简单又好用的电子名片管理应用。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/mp.png', 'qy.wxopen.cn', '29DuoqCZ2Hpils4B8DcDLIUD4FLioYTQAzR0YYMZr6e', '12', 'Card', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('123', 'TNKc3Y1417848055', '企业邮箱', '10', '118', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'qy.wxopen.cn', 'qO59BSB4BPGWhFVtYPpUxjLWjA3N9BScnPknPe11Sj1', '2', 'Email', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('124', 'DVp2dX1417850906', '微信考勤', '1', '81', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'djoEliZYnGmnqIlQ37iQo53l1lWO18Pc08303BrbLem', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('125', '3mPDk61417878793', '微信考勤', '0', '122', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'B7OjXfDeK0myjQ5xuKpRCbrLy7KYD1rGIR6D76Q2IIf', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('126', 'UPs8CU1417878858', '日程管理', '5', '122', '简洁直观，方便易用，不论工作安排还是日常记事，有了它不再忘东忘西。', 'http://qy.wxopen.cn/Tpl/Qyapp/Appslist/images/123.png', 'qy.wxopen.cn', 'iNzjxxYT9Vx0B5vtRAzEpwXocvo1IC5oUsMQg7FeJbs', '14', 'Day', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('127', '2ivwHm1417937395', '流程审批', null, '124', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'dexingky.wxopen.cn', '4tsZKgGDC9dihOopOv4XOUzqohKK8kWq8f0pYMhbL8C', '5', 'Workflow', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('128', '6JR0G11417962949', '日程管理', '0', '81', '简洁直观，方便易用，不论工作安排还是日常记事，有了它不再忘东忘西。', 'http://qy.wxopen.cn/Tpl/Qyapp/Appslist/images/123.png', 'qy.wxopen.cn', 'wDkjNR3cr4iNF33FbdLUclp9tOsrbsTp3D97kaebIpA', '14', 'Day', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('129', '5TSHOv1418023218', '通讯录', '1', '80', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', 'FEKcKCsGu34aJV8pNHMAxlArikDaVCywLHoHEwMpWyO', '8', 'Address', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('130', 'CZ83dE1418029706', '企业邮箱', null, '81', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'dexingky.wxopen.cn', '3szy94p2U0XWiRUDLIvViasclkZfULPsrzaFTmJcLeL', '2', 'Email', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('131', '6UFnTz1418038000', '微信考勤', '0', '132', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'JXQlmCDz1uw6F9bhMGSWlHirNhEC80HPO0CTNR9ayEw', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('132', 'HCcXjh1418096993', '请假', '1', '136', '及时的消息提醒,简单的处理方式,精简的审批流程,方便您及时高效处理请假申请。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/image_43_65_bc_9e_20140905_deb3a6b32d7069481c97bdcccdf05d8b.png', 'qy.wxopen.cn', 'ueyZoSKeY6KZQCTH6E2lkUvoDC9PAvj5iLRan96wSQT', '11', 'Leave', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('133', 'gxtDzV1418134336', '微信考勤', '0', '140', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'K0XsPzh7l4SnmHAbtbK1LKdRR6kaPtWUhAnyiDu5tmD', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('134', 'trgB6j1418179850', '企业公告', '22', '25', '企业公告企业公告企业公告', './Static/thumb/thumb_Announce.png', '121.40.76.167', 'LfS8DpDUuNJ5qC0E0DN2l1Xf2xPIamfskezTDnC2FuL', '15', 'Announce', '1', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('135', 'qysJkr1418180485', '会议室预定', '5', '142', '高效的会议室预定管理应用,解决您烦恼的会议室预定管理问题。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/hh.png', 'qy.wxopen.cn', 'Sdh4PfDVp2dXdjoEliZYnGmnqIlQ37iQo53l1lWO18P', '13', 'Meet', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('136', '5oCI6V1418180733', '通讯录', '0', '142', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', 'aI1ud9pM5tm1EGtWdeQKF549jJen07Va7IgIsvPJnXH', '8', 'Address', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('137', 'pqjQbT1418200287', '微信考勤', '0', '147', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'i68S78sdLvUhGkFSRctoJbyDjTCX2qSdSn3KkOmokmx', '1', 'Attendance', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('138', 'jNy6W51418201782', '请假', null, '147', '及时的消息提醒,简单的处理方式,精简的审批流程,方便您及时高效处理请假申请。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/image_43_65_bc_9e_20140905_deb3a6b32d7069481c97bdcccdf05d8b.png', 'dexingky.wxopen.cn', 'Xvm0PNNq8yXGlS5BqnRyQ7xnAIPo6fWtmkAWQ20FvYU', '11', 'Leave', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('139', 'goZHKg1418258642', '企业公告', '0', '81', '企业公告企业公告企业公告', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/gg.png', 'qy.wxopen.cn', '5WGR25cqE7SEhtOLN9BtvBk1gNA7qduYPOBjO42meWo', '15', 'Announce', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('140', 'bTTpmn1418258746', '通讯录', '0', '81', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', 'P1qzSVesEM7ufRWEfQ2pLYeInYU3b1SoLTucfLArbmx', '8', 'Address', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('141', '13iTCa1418278865', '流程审批', '0', '81', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'qy.wxopen.cn', 'DSSBFiLX8tJjehLgG2kUIBnR2jpaS0msX2JPtftQaY3', '5', 'Workflow', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('142', 'ZHP0B41418297831', '企业邮箱', '4', '151', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'qy.wxopen.cn', 'TbD5SLsaQZSkqzg1HIrcgbMld86r7lLV6ZBNLOXua1G', '2', 'Email', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('143', 'PxYTxD1418298526', '微信考勤', '5', '151', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'juUbx7Lbets4vMOQVKcXCCsn95VACorwDelHhQv29Ve', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('144', 'F17wR21418299103', '企业公告', '0', '151', '企业公告企业公告企业公告', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/gg.png', 'qy.wxopen.cn', '0sUwUz2iOtXJbgTDYwyoGlaPglshcADAqGq7rI2Hcib', '15', 'Announce', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('145', '4fEkZE1418364250', '微信考勤', '1', '154', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', '0e5gQIQcoDe3ljHUWCemUSivrWQWg9nLBlPyaSHpcAW', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('146', 'n95VAC1418366308', '企业公告', '14', '26', '企业公告企业公告企业公告', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/gg.png', 'qy.wxopen.cn', 'orwDelHhQv29Ve3lIoGrVkpyMTbfYouELHilQa4pqCM', '15', 'Announce', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('147', 'sfM02N1418439970', '企业官网', '81', '25', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.workweixin.com', '9NtEnd7ixrPGfeVhzLg48Nbw0wxANFFKAsoXZB5I4kA', '16', 'Home', '2', null, null, '1', '2');
INSERT INTO `tp_qymyapp` VALUES ('148', 'TOz5Ju1418453022', '企业邮箱', null, '157', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'dexingky.wxopen.cn', 'vuYdU5ACtb2LrFjgvQQdTzEckc9j2zl9I2HOBpaSo4e', '2', 'Email', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('149', 'BvjSIj1418453767', '企业公告', '1', '157', '企业公告企业公告企业公告', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/gg.png', 'qy.wxopen.cn', 'QMAeoj4cwdwHmGLGuraEZIyytegQ1cawekA2cQnnvtR', '15', 'Announce', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('150', 'TGvX641418483026', '企业公告', null, '159', '企业公告企业公告企业公告', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/gg.png', 'dexingky.wxopen.cn', '8Hr0SjeYO0jWwu3m7Zhecdl0Qo5EDfRDHZuVBkk0svd', '15', 'Announce', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('151', 'IFjtuZ1418483824', '微信考勤', '0', '160', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'D6ZBo32sb3Y27jFiLyqHe07e7n5mvSa3ZfILFGyu8U2', '1', 'Attendance', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('152', 'iAYfeV1418483999', '企业邮箱', '5', '160', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'qy.wxopen.cn', 'GhxLnfPPpBcmCld3mVZ8sj7kgZHQCUioSx2eRRv2WkM', '2', 'Email', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('153', 'nC13cx1418493856', '微名片', '0', '161', '创建个性名片,收纳海量好友,是一款时尚又新潮,简单又好用的电子名片管理应用。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/mp.png', 'qy.wxopen.cn', 'OOVSnEEQyzYbG005CWjhHP00MFFWbUplLwNUSYXSlfs', '12', 'Card', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('154', 'WxNpkg1418493894', '流程审批', '5', '161', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'qy.wxopen.cn', 'AoLT5vtghl9IDZ2664QKaDMwNjAKsbsh6P7sdnO8Mne', '5', 'Workflow', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('155', 'xaZEwM1418524199', '任务协作', '3', '162', '任务管理应用，轻松安排您与团队每一天的工作分派，实时掌握工作进度，有效提高您和团队的工作效率。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/73b78dd4a9986ac6fb9ba95cb25f10ed.png', 'qy.wxopen.cn', 'ODkiczPHKalryEItdKjjPGWSX9ZFJngEJ57h2vpxglt', '6', 'Task', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('156', '5SF6mu1418543150', '微信考勤', '0', '161', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'hSPuxOOjz99XXAdSLmO2DakVCfzukiTdRy94OJGvg3k', '1', 'Attendance', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('157', 'SiOMUZ1418606127', '微信考勤', '0', '166', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'xmG4DKOgrqnMNlZl3YJa3ibY8LtY8maUqymYOjFTF59', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('158', 'cNxB0F1418613540', '企业公告', '0', '166', '企业公告企业公告企业公告', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/gg.png', 'qy.wxopen.cn', 'OwtyqIQjlKOg3IBhueXHan3l1KEAwrWfE2EGSDZJ9QH', '15', 'Announce', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('159', 'HUEhgd1418615224', '企业官网', '2147483647', '168', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', 'jMLOyNownUSGddr93iNgmhaS6IgjKJkqgU3z8lFziDT', '16', 'Home', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('160', 'ksGvEm1418616466', '企业官网', '0', '26', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', 'oeC1m9NbUIi2TUIjDb8d0w9ukpRkrMRtI7e7YnA0z40', '16', 'Home', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('161', '09yXtK1418646346', '会议室预定', '5', '172', '高效的会议室预定管理应用,解决您烦恼的会议室预定管理问题。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/hh.png', 'qy.wxopen.cn', 'q4dDs9l2sbsGOBCLkps1n33FMvZqUenvzdNC8Ul0riC', '13', 'Meet', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('162', '3VvGLZ1418646454', '企业官网', '0', '172', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', 'Qpif5gfqCHHKgHfUnJZaMKwdPfVgnbO4K0gONISdSLK', '16', 'Home', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('163', 'dmjbme1418651164', '投票', null, '156', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'dexingky.wxopen.cn', 'fKMyvQrUPRPooBUCXq8EIbt5odp2dmU5SXrkDRYmbqX', '3', 'Vote', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('164', 'vWTtGH1418692150', '企业官网', '99', '174', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', '2dXB1a9Eo1Cgh2csgTfFsPATqzzzgj3GANmItemBxkn', '16', 'Home', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('165', 'uXkSba1418692242', '微名片', '10', '174', '创建个性名片,收纳海量好友,是一款时尚又新潮,简单又好用的电子名片管理应用。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/mp.png', 'qy.wxopen.cn', 'PbAX9Zh1BLlC3tnrPAuIN4gahpNZ7yFVGYZcMDlvN1Q', '12', 'Card', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('166', 'vtakez1418709825', '微信考勤', '0', '176', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'vWB7Jys7qU80GdvM7cTTN39jkwBwOP7tPF2DthbZlmV', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('167', 'TfYo6W1418712774', '微名片', '0', '176', '创建个性名片,收纳海量好友,是一款时尚又新潮,简单又好用的电子名片管理应用。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/mp.png', 'qy.wxopen.cn', 'ZdZeNwbOLNKTH0idZCTZsBaWqrchM5zIP0otrafiW3f', '12', 'Card', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('168', 'JBYWFm1418730589', '企业官网', '2014', '177', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', '5G3rLEtykm1WDJij1hoTlVUnWbU0EZ1vOQk3hGqqoZo', '16', 'Home', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('169', '8cNWHt1418732687', '企业官网', '1', '175', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', 'VCWCeYc6NckUc3FtyJ3NrWQlXVR4IotsLywsK8kyJmK', '16', 'Home', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('170', 'M4hmSR1418781941', '投票', null, '180', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'dexingky.wxopen.cn', 'NnUtn8uCm7Hxzh7Wm6S3AxxzA4cJcFtfMNrl9pGJF0j', '3', 'Vote', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('171', 'JvV5A01418799921', '企业官网', '1', '183', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', 'bXx4xHXa6wFgr72OFKTOm6zHDpWt3nkAJfA0hI3cK0z', '16', 'Home', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('172', 'FoOOdP1418809875', '微信考勤', '1', '185', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'D1KDYddqyK4iztjOLHo5lihI2BsM3sST7d08rIP6KiN', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('173', 'IOuQL41418819543', '投票', null, '186', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'dexingky.wxopen.cn', 'GFWACbQ4DQyMzDHoN0k97W4KUUZr0SIVKjjqYaoE2W1', '3', 'Vote', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('174', 'vd8cbD1418826670', '微信考勤', null, '187', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'dexingky.wxopen.cn', 'tYeIYg8ySVPKSiOocd33z2ZRdACnPepJENkuoDPKhBT', '1', 'Attendance', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('175', 'TDnC2F1418864218', '报销', '12', '181', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'qy.wxopen.cn', 'uLjvOPJL3aJwqDioFxTrZLth5Dx0dZ1c4aqYS2GTlVi', '4', 'Applyflow', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('176', 'rrAnfl1418864924', '流程审批', '0', '181', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'qy.wxopen.cn', 'n7YGWYIE7S2Zfj4Tbfn6g94OlZJLKdtakPRJri1GUyw', '5', 'Workflow', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('177', 'dvbPYo1418866294', '投票', '2', '191', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'qy.wxopen.cn', 'cU6NdVcqymnw5acM7NNqxfJaEZ7fkYxnTF5Lc3m8AAs', '3', 'Vote', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('178', 'yPIXLN1418866947', '微信考勤', '4', '191', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'rWrDbqzXFKAR6JtUcKIdbCgnMIAtdQF7boXoUaqS7wy', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('179', 'Vn1JPG1418873363', '企业邮箱', null, '192', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'dexingky.wxopen.cn', 'QVQzLYktS67nN1xJzXsxPCcfFeDPEw5LTHpZZuV026v', '2', 'Email', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('180', 'xo6gxL1418883046', '流程审批', '2', '192', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'qy.wxopen.cn', 'APiQNo74P9SphPUleE3QhkEnw4yUyC6Usb9kQt1FNIA', '5', 'Workflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('181', 'wQx32L1418893646', '报销', '0', '192', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'qy.wxopen.cn', 'x17DdQmaU1RAtvcCfLuu5MjTj0M3LqsIOus4ibmPxYh', '4', 'Applyflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('182', 'dOJnyZ1418893830', '企业官网', '3', '192', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', 'GeInzchGJLm7ZTxqI2TNKc3YqO59BSB4BPGWhFVtYPp', '16', 'Home', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('183', 'Bnf8MF1418893942', '通讯录', '0', '192', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', 'Yi930ridG4lpQ7QkQ5VbwUaJe5F9Nz0bzPi3oQ8sC4A', '8', 'Address', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('184', 'qkl7jr1418894024', '微信考勤', '0', '192', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', '51kxdqkyk3GZu8cMkofqV2ESRNMCfSrAF01idokFuLI', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('185', 'Ck13c81418897571', '任务协作', null, '192', '任务管理应用，轻松安排您与团队每一天的工作分派，实时掌握工作进度，有效提高您和团队的工作效率。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/73b78dd4a9986ac6fb9ba95cb25f10ed.png', 'dexingky.wxopen.cn', '72qzgC0XXTa88sCthoANnjMsRiqhJWfEqlsmW6LNKip', '6', 'Task', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('186', 'd1EZqc1418974743', '请假', '38', '182', '及时的消息提醒,简单的处理方式,精简的审批流程,方便您及时高效处理请假申请。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/image_43_65_bc_9e_20140905_deb3a6b32d7069481c97bdcccdf05d8b.png', 'qy.wxopen.cn', 'AkDajkk14Nrlx7seY6mh47AA408KF5sQ5exu3LPLMxi', '11', 'Leave', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('187', 'D19W3W1418977008', '微信考勤', '7', '138', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', '1eumkZECxjLxCOyu2yejM9wkhHCpyLhS1tHBGpBT0Ec', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('188', 'iZmtaD1418977287', '企业官网', '8', '138', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', 'bPS2oynMHZbZlYdd2QZAZtqFUa1z3OKT6I4IiJWDlcQ', '16', 'Home', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('189', 'PRJri11419003058', '企业官网', '0', '205', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', 'GUywK56t9PTsAspzhPBpXhW3QFq8EjuHA56nojLfgQp', '16', 'Home', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('190', 'M6ZUJ11419006071', '报销', '0', '206', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'qy.wxopen.cn', 'a3hAFUgM5b03v5npwmHhecOEel5ZCZlgXSWWodIZtJ1', '4', 'Applyflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('191', 'eVFGfx1419017709', '企业官网', '0', '207', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', 'SyWS3vN1rnLBKxkFbOsQuxBdRzLm2fnpdprU8poZ05e', '16', 'Home', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('192', 'aOF2eL1419044422', '微信考勤', '1', '209', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'vHGekh5VugA5ODJpFQD6TRSVP9z4jGjfHXaHOTL81Za', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('193', 'iogeOI1419047583', '投票', '1', '209', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'qy.wxopen.cn', 'aXxGQVsRZt1mQsdM7cvc1yQdiSIV805VhhqiWxHEO8n', '3', 'Vote', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('194', 'coQPvm1419171456', '报销', '5', '216', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'qy.wxopen.cn', 'IuPEP21gNcqEIbSNaII9f0OGyMuSbgAHI9sBgHWzpAo', '4', 'Applyflow', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('195', '7mSL3R1419226977', '会议室预定', '5', '191', '高效的会议室预定管理应用,解决您烦恼的会议室预定管理问题。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Appslist/images/hh.png', 'qy.wxopen.cn', 'Mg4xvX0jDzeHgkyD0WlBWDryE7bZfCpRkQtDX1dhLSY', '13', 'Meet', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('196', 'T5vtgh1419227262', '微信考勤', null, '219', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'dexingky.wxopen.cn', 'l9IDZ2664QKaDMwNjAKsbsh6P7sdnO8MneDeXBOzHD0', '1', 'Attendance', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('197', '08rIP61419263699', '微信考勤', '0', '222', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', 'KiNSgNT4GzALgtQzGP7zbtoltM80Mzj8PcoQPvmIuPE', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('198', '7n5LcE1419290427', '企业邮箱', null, '215', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'dexingky.wxopen.cn', 'Fm6hmFglnwGsqhOHLMDF4lCrzRID0DokzxE8ZTV7uxc', '2', 'Email', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('199', 'vinLTH1419290843', '日程管理', '0', '215', '简洁直观，方便易用，不论工作安排还是日常记事，有了它不再忘东忘西。', 'http://qy.wxopen.cn/Tpl/Qyapp/Appslist/images/123.png', 'qy.wxopen.cn', 'NHLYe74Komh4wimyjfNjZ3wUg52rnaiw2DMeslr9lEL', '14', 'Day', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('200', 'SRctoJ1419301628', '调研', null, '192', '调研应用，实时收集来自团队的宝贵意见，数据分析直观明了，有效提高您的调研质量。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140905/62cc0bd387a920806df82266079d8d7a.png', 'dexingky.wxopen.cn', 'byDjTCX2qSdSn3KkOmokmxul6NTnDQXS3TuNWGSDoqV', '9', 'Research', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('201', 'zqZYF21419305334', '企业邮箱', '0', '225', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'qy.wxopen.cn', 'kw0PSyWgLhhkyqpuld9IJlQsO4lHc5ZUWCC4GnBCtAK', '2', 'Email', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('202', 'vmB81i1419305433', '企业官网', '0', '225', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', '72wjMKdgzSPtWwAOSfcBQbSHOUmqfvRF6z5JSdgtw17', '16', 'Home', null, null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('203', 'OCwOdP1419321293', '企业官网', '0', '216', '企业官网，为企业量身定做官方网站', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.wxopen.cn', 'fkY9F7aMEaptxVLq9mRmRXLuuG5xo0UJpSPMTMWUFGQ', '16', 'Home', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('204', 'eOqP0p1419323843', '微信考勤', '6', '226', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.wxopen.cn', '5KoLZQ0BtBX8nYN64rEHnY7ED2gbGBH0T7vl6AjVDra', '1', 'Attendance', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('205', 'RIeiRU1419324146', '任务协作', '7', '226', '任务管理应用，轻松安排您与团队每一天的工作分派，实时掌握工作进度，有效提高您和团队的工作效率。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/73b78dd4a9986ac6fb9ba95cb25f10ed.png', 'qy.wxopen.cn', '1su0eod65WZOisjd4L7T9eTYKGB0zsI7QqcThTxq7KF', '6', 'Task', '1', null, null, null, '0');
INSERT INTO `tp_qymyapp` VALUES ('211', 'cS4j5p1419663723', '通讯录', '15', '25', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'anlixia.com', null, '8', 'Address', '2', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('232', 'VgabEh1421482391', '外勤', '95', '25', '微信外勤，时下最流行的考勤形式，高效掌控员工出勤状况。', './Static/thumb/thumb_Legwork.png', 'anlixia.com', 'RUe3W0Cb8OiLEbdmdrQ62qazQvEQRwfxMNqKQbb2M2X', '17', 'Legwork', '2', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('233', 'RNnUtn1422935566', '企业邮箱', '12', '229', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'qy.workweixin.com', '8uCm7Hxzh7Wm6S3AxxzA4cJcFtfMNrl9pGJF0jDbwVM', '2', 'Email', '2', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('234', 'sPYAc41422943640', '微信考勤', '15', '229', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.workweixin.com', 'SGjXWhgCpf1CYW43RamxNin90a4ub7UEz0TdSasijqA', '1', 'Attendance', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('235', '1sAm3K1422948536', '流程审批', '14', '229', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'qy.workweixin.com', 'V7AT1gvQsw75l5iygImLjBaD5t3GGxSQGxYAcFbUOEQ', '5', 'Workflow', '2', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('236', 'BmKNFK1423105135', '企业知识库', '85', '25', '企业知识库', 'http://qy.workweixin.com/Logo/zhishiku.png', 'anlixia.com', 'u6ABgBAL3Snyi2cRYFJYySeM0eoBORriVk6cOKA9rHC', '18', 'Knowledge', '2', null, null, '1', '4');
INSERT INTO `tp_qymyapp` VALUES ('237', '4f3D4m1423116810', '请假', '0', '230', '及时的消息提醒,简单的处理方式,精简的审批流程,方便您及时高效处理请假申请。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/image_43_65_bc_9e_20140905_deb3a6b32d7069481c97bdcccdf05d8b.png', 'qy.workweixin.com', 'O21S6qVlB8eTz2U6Hsq4dfKnQJm8OMdWNJMR4p2wjbs', '11', 'Leave', '2', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('238', 'jidMq91423117631', '微信考勤', '14', '230', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.workweixin.com', 'Ly8mgRw8AGdd2shOuakDghqUeLclI6JbyeB77EVoekh', '1', 'Attendance', '1', '', null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('239', 'z1H7yG1423191585', '离职', '6', '25', '离职', './Static/thumb/thumb_Quit.png', 'anlixia.com', 'xYcuTGBHCcl12ZxF12MlUN8ixeeeeQ8mRyspLShBNKc', '19', 'Quit', '2', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('240', 'ChNAUP1423191617', '借书', '84', '25', '借书', './Static/thumb/thumb_Borrow_books.png', 'anlixia.com', 'LtA2TT60pGrk2a25ZdTSZatNfQJsvC8VWjFNjhNbOmu', '20', 'Borrow_books', '2', null, null, '1', '4');
INSERT INTO `tp_qymyapp` VALUES ('241', 'WNqrTV1423192652', '离职', '21', '231', '离职', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/image_43_65_bc_9e_20140905_deb3a6b32d7069481c97bdcccdf05d8b.png', 'qy.workweixin.com', 'OWYCiiwkYKm2rYReNdPQCcEm088LzJEund2x2jCmDfg', '19', 'Quit', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('242', 'oOvhyg1423193027', '借书', '22', '231', '借书', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/image_43_65_bc_9e_20140905_deb3a6b32d7069481c97bdcccdf05d8b.png', 'qy.workweixin.com', 'VXdjZXzNGRk2tMKUjiwJGwRly0v7oTESaK2YlFSfTfS', '20', 'Borrow_books', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('243', 'fFsPAT1423218386', '微信考勤', '69', '232', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.workweixin.com', 'qzzzgj3GANmItemBxknQQjfo0UlI6ktMKi0402Nyvf9', '1', 'Attendance', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('244', 'asTBE51423218516', '企业邮箱', '70', '232', '企业邮箱管理应用，帮您随时随地掌握邮箱动态，收发邮件畅通无阻，让您享受更轻快的移动办公体验', 'http://iwork365.oss.aliyuncs.com/image/c0/b6/8f/46/20141023/ba1c64141d1d5a8ca35186c5af3d0d0b.jpg', 'qy.workweixin.com', 'av75Wow4XCj7p0uP2Vvi4dl6ccrmEKNE9cS5UnDeEEx', '2', 'Email', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('245', 'f7XbZy1423218681', '投票', '71', '232', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'qy.workweixin.com', 'zFeqDUich52Q5WNP8Fq731gcTc91hUr3joXiym4a71C', '3', 'Vote', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('246', 'GjaWr21423219490', '报销', '72', '232', '让传统繁琐，低效，粗略的报销管理工作，变得便捷，高效，精准！', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e61f56d4329479abafee2dc3c67449c7.png', 'qy.workweixin.com', 'uvhMtFb6NOC8IKyrUPs8CUiNzjxxYT9Vx0B5vtRAzEp', '4', 'Applyflow', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('247', 'cBQAAt1423219661', '流程审批', '73', '232', '审批流程完全自定义、审批人员自由配置，满足您个性化的流程审批需求。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/e152afe4f130a43de46bd91d37426ac0.png', 'qy.workweixin.com', 'jdttToskVCDhgPB0gvsKKCMe3EFF2xIL3M1KWkbl1Ei', '5', 'Workflow', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('248', 'VGSeGE1423219794', '任务协作', '74', '232', '任务管理应用，轻松安排您与团队每一天的工作分派，实时掌握工作进度，有效提高您和团队的工作效率。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/73b78dd4a9986ac6fb9ba95cb25f10ed.png', 'qy.workweixin.com', 'q2TOmuht7I3vHhVfyh8yFknKuvTFZpoHE75DrgHROTs', '6', 'Task', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('249', 'c3z7Km1423220140', '通讯录', '75', '232', '员工通讯录快速共享，常用、保密联系人自由设置。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/65c7b2a62c9cbcb71cda6aa91db9ea38.png', 'qy.workweixin.com', 'lNWZPTKxILF4fgDd9H83CX7bnl5GFJZaasiI8lXUgLu', '8', 'Address', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('250', 'POimyH1423301916', '投票', '29', '231', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'qy.workweixin.com', 'WzNiayyaGIgpHQUEYjXWGXoUy8ECPFJGdU5bUHHJFo1', '3', 'Vote', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('251', 'vAI8K41423533794', '企业知识库', '4', '229', '企业知识库', 'http://qy.workweixin.com/Uploads/image-c0-b6-8f-46-20150116.png', 'qy.workweixin.com', 'oxzT1t6isUU03i6dCDgFwnvzCuoDdr35cd3ESgvy6yY', '18', 'Knowledge', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('252', 'lZl3YJ1423539172', '企业知识库', '42', '233', '企业知识库', 'http://qy.workweixin.com/Uploads/image-c0-b6-8f-46-20150116.png', 'qy.workweixin.com', 'a3ibY8LtY8maUqymYOjFTF59UPRrHC6BvUMe32nrxQP', '18', 'Knowledge', '2', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('253', 'L76KGT1423713755', '外勤', '40', '233', '微信外勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.workweixin.com', 'mwBjdn742KkqFCP3rsHdceyBiptrzX4rmlpQwy6lo2e', '17', 'Legwork', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('254', 'wxTKW11424917263', '请假', '1', '233', '及时的消息提醒,简单的处理方式,精简的审批流程,方便您及时高效处理请假申请。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/image_43_65_bc_9e_20140905_deb3a6b32d7069481c97bdcccdf05d8b.png', 'qy.workweixin.com', 'QnT3betQMhh7XYo6yhrvVHtxUa7VRasTBE5av75Wow4', '11', 'Leave', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('255', 'zJWe281425026806', '聊天室', '86', '25', '方便部门内部进行交流和沟通', 'http://qy.wxopen.cn/Tpl/Qyapp/Install/Install/web.png', 'qy.workweixin.com', '7WF38pGlYeOk4uhSqMMjvdxvgmhLakeXcI5qPB601AX', '21', 'Chatroom', '2', null, null, '1', '7');
INSERT INTO `tp_qymyapp` VALUES ('256', 'AxWhmz1425264447', '微信考勤', '11', '233', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.workweixin.com', 'vQfjnQrCtTHOi4cJOYHKtGoHfO0UDsLfzcn2x748vQy', '1', 'Attendance', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('257', 'gYMA821426058325', '考试', '92', '25', '在线考试', '/Tpl/static/images/icon/zhishiku.png', 'anlixia.com', 'vIuwHzFVtnxboQqNAdbICb8qAZ9S6kzxfqdoC1sTjj7', '22', 'Test', '2', null, null, '1', '4');
INSERT INTO `tp_qymyapp` VALUES ('258', 'bXeJAy1426123935', '借书', '44', '233', '借书', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/image_43_65_bc_9e_20140905_deb3a6b32d7069481c97bdcccdf05d8b.png', 'qy.workweixin.com', 'm4zON6YH9zaFvFXHs7Ig69hj2tZlmkHiEoJF0VWp2CF', '20', 'Borrow_books', '1', './TempFile/admin/image/20150312094327843.png', null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('259', 'SXKScs1426486015', '微信考勤', '1', '235', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.workweixin.com', 'zQv2yD0yEPrklw0dAkqzRjVe85exTKxk4TAW9Azf6se', '1', 'Attendance', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('260', 'nJTOXo1426494931', '投票', '3', '235', '快速发起投票，数据自动统计，实时结果显示，为您节省宝贵的时间。', 'http://iwork365-test.oss.aliyuncs.com/image/43/65/bc/9e/20140910/5918a06efae099e60f2727500904fb67.png', 'qy.workweixin.com', 'NckiUPaMFLHH2CFnvtgG2VdW64K0FvzdbkUpE7uWvYv', '3', 'Vote', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('261', 'EKvHTP1426495163', '借书', '44', '230', '借书', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/image_43_65_bc_9e_20140905_deb3a6b32d7069481c97bdcccdf05d8b.png', 'qy.workweixin.com', 'MiuIpYNTtZEjA3prPnTgMGtezcZkLDL1scEhgC0yf7F', '20', 'Borrow_books', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('262', 'vHGekh1427512616', '企业分销', '89', '25', '企业分销', '/Tpl/static/images/icon/zhishiku.png', 'anlixia.com', '5VugA5ODJpFQD6TRSVP9z4jGjfHXaHOTL81ZaL9dZky', '23', 'Distribution', '2', null, null, '1', '5');
INSERT INTO `tp_qymyapp` VALUES ('263', 'AvwGLM1428029606', '绩效', '0', '25', '微信绩效', '/Tpl/static/images/icon/zhishiku.png', 'anlixia.com', 'fXiRjkxdO2kOmM182Ns9rNYjEZqBh68tqmYUFtgn5FQ', '24', 'Performance', '2', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('264', 'iXXTyQ1428472663', '售后', '93', '25', '售后', '/Tpl/static/images/icon/zhishiku.png', 'anlixia.com', 'UXVzk2to28OZpG2CgGJYXz0hjlqfHs77XSEAq57TW18', '25', 'Aftersale', '2', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('265', 'JT1yQO1428473185', '售后', '16', '233', '售后', '/Tpl/static/images/icon/zhishiku.png', 'qy.workweixin.com', 'A6dC2Yr1GBBgoZj2uBDAPocBKP4l6TRud3EgXh2pE18', '25', 'Aftersale', '1', null, null, '1', '0');
INSERT INTO `tp_qymyapp` VALUES ('270', '07ktbr1429422842', '微信考勤', '7', '236', '微信考勤，时下最流行的考勤形式，高效掌控员工出勤状况。', 'http://dexingky.wxopen.cn/Tpl/Qyapp/Install/Install/996bf981aa6dfb832da8c0406cb3408e.png', 'qy.workweixin.com', '4vn74rr6VYJRHk3n2eM6ZUJ1a3hAFUgM5b03v5npwmH', '1', 'Attendance', '1', null, null, '1', '1');
INSERT INTO `tp_qymyapp` VALUES ('271', 'DdsA1D1447050950', '工作日志', '0', '25', '工作日志', './Static/thumb/thumb_Log.png', 'anlixia.com', 'bnLM9xkt3YpoBGhEBu2IxIe1yY2i5JlG2LU4u83raY1', '26', 'Log', '2', null, null, '1', '1');

-- ----------------------------
-- Table structure for `tp_qymyteam`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qymyteam`;
CREATE TABLE `tp_qymyteam` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `teamname` varchar(100) DEFAULT NULL COMMENT '团队名字',
  `captain` varchar(30) DEFAULT NULL COMMENT '队长',
  `pk_time` int(11) DEFAULT NULL COMMENT '团队pk时间',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `userid` int(11) DEFAULT NULL COMMENT '企业id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qymyteam
-- ----------------------------
INSERT INTO `tp_qymyteam` VALUES ('22', '飞鸿对', '189', null, '20150331', '25');
INSERT INTO `tp_qymyteam` VALUES ('21', '飞鹰队', '190', null, '20150330', '25');

-- ----------------------------
-- Table structure for `tp_qymyteaminfo`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qymyteaminfo`;
CREATE TABLE `tp_qymyteaminfo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `myteam_id` int(11) DEFAULT NULL COMMENT '团队表id',
  `users_id` int(11) DEFAULT NULL COMMENT '员工表id',
  `createtime` int(11) DEFAULT NULL COMMENT '时间',
  `type` int(11) DEFAULT '0' COMMENT '0位审核中，1为通过审审核2为删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qymyteaminfo
-- ----------------------------
INSERT INTO `tp_qymyteaminfo` VALUES ('57', '22', '193', '20150330', '1');
INSERT INTO `tp_qymyteaminfo` VALUES ('56', '22', '192', '20150330', '1');
INSERT INTO `tp_qymyteaminfo` VALUES ('55', '22', '191', '20150330', '0');
INSERT INTO `tp_qymyteaminfo` VALUES ('54', '22', '188', '20150330', '1');
INSERT INTO `tp_qymyteaminfo` VALUES ('52', '21', '190', '20150330', '1');
INSERT INTO `tp_qymyteaminfo` VALUES ('53', '21', '189', '20150330', '1');

-- ----------------------------
-- Table structure for `tp_qynav`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qynav`;
CREATE TABLE `tp_qynav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) DEFAULT NULL,
  `parentid` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=244 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qynav
-- ----------------------------
INSERT INTO `tp_qynav` VALUES ('173', '企业号体验19288', '0', null, '1', '1');
INSERT INTO `tp_qynav` VALUES ('174', '部门名称', '1', null, '2', '1');
INSERT INTO `tp_qynav` VALUES ('175', '3453453', '2', null, '3', '1');
INSERT INTO `tp_qynav` VALUES ('176', '新部门', '1', null, '77', '1');
INSERT INTO `tp_qynav` VALUES ('177', '部门第一节', '1', null, '78', '1');
INSERT INTO `tp_qynav` VALUES ('178', '新部门', '78', null, '79', '1');
INSERT INTO `tp_qynav` VALUES ('179', '部门第二节', '78', null, '80', '1');
INSERT INTO `tp_qynav` VALUES ('180', '示范点', '80', null, '82', '1');
INSERT INTO `tp_qynav` VALUES ('181', '新部门', '80', null, '81', '1');
INSERT INTO `tp_qynav` VALUES ('182', 'sadfasf', '80', null, '83', '1');
INSERT INTO `tp_qynav` VALUES ('183', '士大夫', '80', null, '84', '1');
INSERT INTO `tp_qynav` VALUES ('184', '企业号体验19288', '0', null, '1', '10');
INSERT INTO `tp_qynav` VALUES ('185', '部门名称', '1', null, '2', '10');
INSERT INTO `tp_qynav` VALUES ('186', '3453453', '2', null, '3', '10');
INSERT INTO `tp_qynav` VALUES ('187', '新部门', '1', null, '77', '10');
INSERT INTO `tp_qynav` VALUES ('188', '部门第一节', '1', null, '78', '10');
INSERT INTO `tp_qynav` VALUES ('189', '新部门', '78', null, '79', '10');
INSERT INTO `tp_qynav` VALUES ('190', '部门第二节', '78', null, '80', '10');
INSERT INTO `tp_qynav` VALUES ('191', '示范点', '80', null, '82', '10');
INSERT INTO `tp_qynav` VALUES ('192', '新部门', '80', null, '81', '10');
INSERT INTO `tp_qynav` VALUES ('193', 'sadfasf', '80', null, '83', '10');
INSERT INTO `tp_qynav` VALUES ('194', '士大夫', '80', null, '84', '10');
INSERT INTO `tp_qynav` VALUES ('195', '3453', '1', null, '85', '1');
INSERT INTO `tp_qynav` VALUES ('196', '2342', '1', null, '86', '1');
INSERT INTO `tp_qynav` VALUES ('197', '新部门', '86', null, '87', '1');
INSERT INTO `tp_qynav` VALUES ('198', '4353', '86', null, '88', '1');
INSERT INTO `tp_qynav` VALUES ('199', '5353', '1', null, '89', '1');
INSERT INTO `tp_qynav` VALUES ('200', '新部门', '89', null, '90', '1');
INSERT INTO `tp_qynav` VALUES ('201', '123123', '1', null, '91', '1');
INSERT INTO `tp_qynav` VALUES ('202', '435', '1', null, '92', '1');
INSERT INTO `tp_qynav` VALUES ('203', 'retye', '1', null, '93', '1');
INSERT INTO `tp_qynav` VALUES ('204', '新部门', '93', null, '94', '1');
INSERT INTO `tp_qynav` VALUES ('205', '3535', '93', null, '95', '1');
INSERT INTO `tp_qynav` VALUES ('206', '新部门', '95', null, '96', '1');
INSERT INTO `tp_qynav` VALUES ('207', 'ertert', '95', null, '97', '1');
INSERT INTO `tp_qynav` VALUES ('208', '456', '1', null, '98', '1');
INSERT INTO `tp_qynav` VALUES ('209', '24234234', '2', null, '99', '1');
INSERT INTO `tp_qynav` VALUES ('210', '这是真的', '2', null, '103', '1');
INSERT INTO `tp_qynav` VALUES ('211', '微易官方', '0', null, '1', '17');
INSERT INTO `tp_qynav` VALUES ('212', '采购部门', '1', null, '2', '17');
INSERT INTO `tp_qynav` VALUES ('213', 'gggg', '2', null, '6', '17');
INSERT INTO `tp_qynav` VALUES ('214', '新建部门', '6', null, '8', '17');
INSERT INTO `tp_qynav` VALUES ('215', '23423423', '8', null, '9', '17');
INSERT INTO `tp_qynav` VALUES ('216', '234234234', '9', null, '10', '17');
INSERT INTO `tp_qynav` VALUES ('217', '234234234', '10', null, '11', '17');
INSERT INTO `tp_qynav` VALUES ('218', '234234234', '11', null, '12', '17');
INSERT INTO `tp_qynav` VALUES ('219', '新建部门', '2', null, '7', '17');
INSERT INTO `tp_qynav` VALUES ('220', 'vvvv', '1', null, '3', '17');
INSERT INTO `tp_qynav` VALUES ('221', '1212', '3', null, '4', '17');
INSERT INTO `tp_qynav` VALUES ('222', '234234', '4', null, '5', '17');
INSERT INTO `tp_qynav` VALUES ('223', '新建部门30', '5', null, '15', '17');
INSERT INTO `tp_qynav` VALUES ('224', '微易官方', '0', null, '1', '25');
INSERT INTO `tp_qynav` VALUES ('225', '采购部门', '1', null, '2', '25');
INSERT INTO `tp_qynav` VALUES ('226', 'gggg', '2', null, '6', '25');
INSERT INTO `tp_qynav` VALUES ('227', '销售部', '1', null, '3', '25');
INSERT INTO `tp_qynav` VALUES ('228', '1212', '3', null, '4', '25');
INSERT INTO `tp_qynav` VALUES ('229', '234234', '4', null, '5', '25');
INSERT INTO `tp_qynav` VALUES ('230', '新建部门30', '5', null, '15', '25');
INSERT INTO `tp_qynav` VALUES ('231', '新部门', '3', null, '108', '1');
INSERT INTO `tp_qynav` VALUES ('232', 'ceshibum', '103', null, '107', '1');
INSERT INTO `tp_qynav` VALUES ('233', '深圳四十一科技有限公司', '0', null, '1', '80');
INSERT INTO `tp_qynav` VALUES ('234', '河南办事处', '1', null, '33', '80');
INSERT INTO `tp_qynav` VALUES ('235', '技术部', '1', null, '32', '80');
INSERT INTO `tp_qynav` VALUES ('236', '运营部', '1', null, '31', '80');
INSERT INTO `tp_qynav` VALUES ('237', '产品部', '1', null, '30', '80');
INSERT INTO `tp_qynav` VALUES ('238', '市场部', '1', null, '29', '80');
INSERT INTO `tp_qynav` VALUES ('239', '人事行政部', '1', null, '28', '80');
INSERT INTO `tp_qynav` VALUES ('240', '总经办', '1', null, '27', '80');
INSERT INTO `tp_qynav` VALUES ('241', '新部门', '1', null, '16', '25');
INSERT INTO `tp_qynav` VALUES ('242', '新部门', '6', null, '17', '25');
INSERT INTO `tp_qynav` VALUES ('243', '45555', '3', null, '18', '25');

-- ----------------------------
-- Table structure for `tp_qynews`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qynews`;
CREATE TABLE `tp_qynews` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `appid` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `pic` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qynews
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qynorm`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qynorm`;
CREATE TABLE `tp_qynorm` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `KPLnorm` varchar(50) NOT NULL COMMENT 'kpi指标',
  `value` int(11) DEFAULT NULL COMMENT '分值',
  `gradenorm` varchar(50) DEFAULT NULL COMMENT '评分标准',
  `create_time` time DEFAULT NULL COMMENT '创建时间',
  `update_time` time DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qynorm
-- ----------------------------
INSERT INTO `tp_qynorm` VALUES ('1', '完成客户网站订单', '40', '完成一个订单计20分', '00:20:15', '00:20:15');
INSERT INTO `tp_qynorm` VALUES ('2', '客户销售技术服务', '20', '有一个投诉扣20分', '00:20:15', '00:20:15');
INSERT INTO `tp_qynorm` VALUES ('3', '销售业绩考核', '20', '完成1万销售计10分', '00:20:15', '00:20:15');
INSERT INTO `tp_qynorm` VALUES ('4', '专业技术精进', '20', '分享一次计20分', '00:20:15', '00:20:15');
INSERT INTO `tp_qynorm` VALUES ('5', '积极参加公司会议', '20', '缺一个会扣10分', '00:20:15', '00:20:15');

-- ----------------------------
-- Table structure for `tp_qynormgrade`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qynormgrade`;
CREATE TABLE `tp_qynormgrade` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `norm_id` int(11) DEFAULT NULL COMMENT 'kpi指标表id',
  `complete_status` varchar(100) DEFAULT NULL COMMENT '完成情况',
  `grade_me` int(11) DEFAULT NULL COMMENT '自评分',
  `grade_ot` int(11) DEFAULT NULL COMMENT '来自他人评分',
  `grade_metime` time DEFAULT NULL COMMENT '自评时间',
  `grade_ottime` time DEFAULT NULL COMMENT '他人评价时间',
  `users_id` int(11) DEFAULT NULL COMMENT '员工表id',
  `allgrede` int(11) DEFAULT NULL COMMENT '总分',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=156 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qynormgrade
-- ----------------------------
INSERT INTO `tp_qynormgrade` VALUES ('155', '5', '2323', '2323', null, '838:59:59', null, '210', '21321');
INSERT INTO `tp_qynormgrade` VALUES ('154', '4', '323', '2323', null, '838:59:59', null, '210', '21321');
INSERT INTO `tp_qynormgrade` VALUES ('153', '3', '232', '232', null, '838:59:59', null, '210', '21321');
INSERT INTO `tp_qynormgrade` VALUES ('152', '2', '2323', '23', null, '838:59:59', null, '210', '21321');
INSERT INTO `tp_qynormgrade` VALUES ('151', '1', '23', '12', null, '838:59:59', null, '210', '21321');
INSERT INTO `tp_qynormgrade` VALUES ('150', '5', '', '0', null, '838:59:59', null, '230', '0');
INSERT INTO `tp_qynormgrade` VALUES ('149', '4', '', '0', null, '838:59:59', null, '230', '0');
INSERT INTO `tp_qynormgrade` VALUES ('148', '3', '', '0', null, '838:59:59', null, '230', '0');
INSERT INTO `tp_qynormgrade` VALUES ('147', '2', '公交', '0', null, '838:59:59', null, '230', '0');
INSERT INTO `tp_qynormgrade` VALUES ('146', '1', 'ion哦1理论', '558', null, '838:59:59', null, '230', '0');
INSERT INTO `tp_qynormgrade` VALUES ('145', '5', '', '10', null, '838:59:59', null, '235', '0');
INSERT INTO `tp_qynormgrade` VALUES ('144', '4', '', '20', null, '838:59:59', null, '235', '0');
INSERT INTO `tp_qynormgrade` VALUES ('143', '3', '', '15', null, '838:59:59', null, '235', '0');
INSERT INTO `tp_qynormgrade` VALUES ('142', '2', '', '20', null, '838:59:59', null, '235', '0');
INSERT INTO `tp_qynormgrade` VALUES ('141', '1', '哈哈哈哈哈', '30', null, '838:59:59', null, '235', '0');
INSERT INTO `tp_qynormgrade` VALUES ('140', '5', '水电费', '20', null, '838:59:59', null, '227', '20');
INSERT INTO `tp_qynormgrade` VALUES ('139', '4', '水电费', '20', null, '838:59:59', null, '227', '20');
INSERT INTO `tp_qynormgrade` VALUES ('138', '3', '是否', '20', null, '838:59:59', null, '227', '20');
INSERT INTO `tp_qynormgrade` VALUES ('137', '2', '水电费', '120', null, '838:59:59', null, '227', '20');
INSERT INTO `tp_qynormgrade` VALUES ('136', '1', '是', '20', null, '838:59:59', null, '227', '20');
INSERT INTO `tp_qynormgrade` VALUES ('135', null, null, null, null, '838:59:59', null, '227', '0');
INSERT INTO `tp_qynormgrade` VALUES ('134', null, null, null, null, '838:59:59', null, '227', '0');
INSERT INTO `tp_qynormgrade` VALUES ('133', null, null, null, null, '838:59:59', null, '227', '0');
INSERT INTO `tp_qynormgrade` VALUES ('132', null, null, null, null, '838:59:59', null, '227', '0');
INSERT INTO `tp_qynormgrade` VALUES ('131', null, null, '22', null, '838:59:59', null, '227', '0');

-- ----------------------------
-- Table structure for `tp_qyquit_check`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyquit_check`;
CREATE TABLE `tp_qyquit_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_one` varchar(100) DEFAULT NULL,
  `user_two` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '0为未审核1为审核2为驳回',
  `pid` int(11) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyquit_check
-- ----------------------------
INSERT INTO `tp_qyquit_check` VALUES ('1', '1212212', '525', '25', null, '1', '1422412116');
INSERT INTO `tp_qyquit_check` VALUES ('2', '1212212', '6326', '25', null, '1', '1422412116');
INSERT INTO `tp_qyquit_check` VALUES ('3', '1212212', '3626', '25', '0', '1', '1422412116');
INSERT INTO `tp_qyquit_check` VALUES ('4', '1212212', '79846532', '25', '0', '1', '1422412116');
INSERT INTO `tp_qyquit_check` VALUES ('5', '1212212', '525', '25', '0', '3', '1422412394');
INSERT INTO `tp_qyquit_check` VALUES ('6', '1212212', '6326', '25', '0', '3', '1422412394');
INSERT INTO `tp_qyquit_check` VALUES ('7', '1212212', '3626', '25', '0', '3', '1422412394');
INSERT INTO `tp_qyquit_check` VALUES ('8', '1212212', '79846532', '25', '0', '3', '1422412394');
INSERT INTO `tp_qyquit_check` VALUES ('9', '1212212', '525', '25', '0', '4', '1422412488');
INSERT INTO `tp_qyquit_check` VALUES ('10', '1212212', '6326', '25', '0', '4', '1422412488');
INSERT INTO `tp_qyquit_check` VALUES ('11', '1212212', '3626', '25', '0', '4', '1422412488');
INSERT INTO `tp_qyquit_check` VALUES ('12', '1212212', '79846532', '25', '0', '4', '1422412488');
INSERT INTO `tp_qyquit_check` VALUES ('13', 'xtzlyp', '525', '25', '0', '5', '1422427621');
INSERT INTO `tp_qyquit_check` VALUES ('14', 'xtzlyp', '6326', '25', '0', '5', '1422427621');
INSERT INTO `tp_qyquit_check` VALUES ('15', 'xtzlyp', '3626', '25', '0', '5', '1422427621');
INSERT INTO `tp_qyquit_check` VALUES ('16', 'xtzlyp', 'xtzlyp', '25', '0', '5', '1422427621');
INSERT INTO `tp_qyquit_check` VALUES ('17', 'xtzlyp', '525', '25', '0', '6', '1422427755');
INSERT INTO `tp_qyquit_check` VALUES ('18', 'xtzlyp', '6326', '25', '0', '6', '1422427755');
INSERT INTO `tp_qyquit_check` VALUES ('19', 'xtzlyp', '3626', '25', '0', '6', '1422427755');
INSERT INTO `tp_qyquit_check` VALUES ('20', 'xtzlyp', 'xtzlyp', '25', '0', '6', '1422427755');
INSERT INTO `tp_qyquit_check` VALUES ('21', 'mytery___', '525', '25', '0', '7', '1422428052');
INSERT INTO `tp_qyquit_check` VALUES ('22', 'mytery___', '6326', '25', '0', '7', '1422428052');
INSERT INTO `tp_qyquit_check` VALUES ('23', 'mytery___', '3626', '25', '0', '7', '1422428052');
INSERT INTO `tp_qyquit_check` VALUES ('24', 'mytery___', 'xtzlyp', '25', '0', '7', '1422428052');
INSERT INTO `tp_qyquit_check` VALUES ('25', 'mytery___', '525', '25', '0', '8', '1422433141');
INSERT INTO `tp_qyquit_check` VALUES ('26', 'mytery___', '6326', '25', '0', '8', '1422433141');
INSERT INTO `tp_qyquit_check` VALUES ('27', 'mytery___', '3626', '25', '0', '8', '1422433141');
INSERT INTO `tp_qyquit_check` VALUES ('28', 'mytery___', 'xtzlyp', '25', '0', '8', '1422433141');
INSERT INTO `tp_qyquit_check` VALUES ('29', 'mytery___', '525', '25', '0', '9', '1422433164');
INSERT INTO `tp_qyquit_check` VALUES ('30', 'mytery___', '6326', '25', '0', '9', '1422433164');
INSERT INTO `tp_qyquit_check` VALUES ('31', 'mytery___', '3626', '25', '0', '9', '1422433164');
INSERT INTO `tp_qyquit_check` VALUES ('32', 'mytery___', 'xtzlyp', '25', '0', '9', '1422433164');
INSERT INTO `tp_qyquit_check` VALUES ('33', 'mytery___', '525', '25', '0', '10', '1422433165');
INSERT INTO `tp_qyquit_check` VALUES ('34', 'mytery___', '6326', '25', '0', '10', '1422433165');
INSERT INTO `tp_qyquit_check` VALUES ('35', 'mytery___', '3626', '25', '0', '10', '1422433165');
INSERT INTO `tp_qyquit_check` VALUES ('36', 'mytery___', 'xtzlyp', '25', '0', '10', '1422433165');
INSERT INTO `tp_qyquit_check` VALUES ('37', 'mytery___', '525', '25', '0', '11', '1422433166');
INSERT INTO `tp_qyquit_check` VALUES ('38', 'mytery___', '6326', '25', '0', '11', '1422433166');
INSERT INTO `tp_qyquit_check` VALUES ('39', 'mytery___', '3626', '25', '0', '11', '1422433166');
INSERT INTO `tp_qyquit_check` VALUES ('40', 'mytery___', 'xtzlyp', '25', '0', '11', '1422433166');
INSERT INTO `tp_qyquit_check` VALUES ('41', 'mytery___', '525', '25', '0', '12', '1422433177');
INSERT INTO `tp_qyquit_check` VALUES ('42', 'mytery___', '6326', '25', '0', '12', '1422433177');
INSERT INTO `tp_qyquit_check` VALUES ('43', 'mytery___', '3626', '25', '0', '12', '1422433177');
INSERT INTO `tp_qyquit_check` VALUES ('44', 'mytery___', 'xtzlyp', '25', '0', '12', '1422433177');
INSERT INTO `tp_qyquit_check` VALUES ('45', '231312___', '525', '25', '0', '13', '1422433231');
INSERT INTO `tp_qyquit_check` VALUES ('46', '231312___', '6326', '25', '0', '13', '1422433231');
INSERT INTO `tp_qyquit_check` VALUES ('47', '231312___', '3626', '25', '0', '13', '1422433231');
INSERT INTO `tp_qyquit_check` VALUES ('48', '231312___', 'xtzlyp', '25', '0', '13', '1422433231');
INSERT INTO `tp_qyquit_check` VALUES ('49', 'my45446', '525', '25', '0', '14', '1422599222');
INSERT INTO `tp_qyquit_check` VALUES ('50', 'my45446', '6326', '25', '0', '14', '1422599222');
INSERT INTO `tp_qyquit_check` VALUES ('51', 'my45446', '3626', '25', '0', '14', '1422599222');
INSERT INTO `tp_qyquit_check` VALUES ('52', 'my45446', 'xtzlyp', '25', '0', '14', '1422599222');
INSERT INTO `tp_qyquit_check` VALUES ('53', 'my45446', '525', '25', '0', '15', '1422599225');
INSERT INTO `tp_qyquit_check` VALUES ('54', 'my45446', '6326', '25', '0', '15', '1422599225');
INSERT INTO `tp_qyquit_check` VALUES ('55', 'my45446', '3626', '25', '0', '15', '1422599225');
INSERT INTO `tp_qyquit_check` VALUES ('56', 'my45446', 'xtzlyp', '25', '0', '15', '1422599225');
INSERT INTO `tp_qyquit_check` VALUES ('57', 'my45446', '525', '25', '0', '16', '1422599233');
INSERT INTO `tp_qyquit_check` VALUES ('58', 'my45446', '6326', '25', '0', '16', '1422599233');
INSERT INTO `tp_qyquit_check` VALUES ('59', 'my45446', '3626', '25', '0', '16', '1422599233');
INSERT INTO `tp_qyquit_check` VALUES ('60', 'my45446', 'xtzlyp', '25', '0', '16', '1422599233');
INSERT INTO `tp_qyquit_check` VALUES ('61', 'ewqe', '525', '25', '0', '17', '1422599329');
INSERT INTO `tp_qyquit_check` VALUES ('62', 'ewqe', '6326', '25', '0', '17', '1422599329');
INSERT INTO `tp_qyquit_check` VALUES ('63', 'ewqe', '3626', '25', '0', '17', '1422599329');
INSERT INTO `tp_qyquit_check` VALUES ('64', 'ewqe', 'xtzlyp', '25', '0', '17', '1422599329');
INSERT INTO `tp_qyquit_check` VALUES ('65', 'ewqe', '525', '25', '0', '18', '1422599331');
INSERT INTO `tp_qyquit_check` VALUES ('66', 'ewqe', '6326', '25', '0', '18', '1422599331');
INSERT INTO `tp_qyquit_check` VALUES ('67', 'ewqe', '3626', '25', '0', '18', '1422599331');
INSERT INTO `tp_qyquit_check` VALUES ('68', 'ewqe', 'xtzlyp', '25', '0', '18', '1422599331');
INSERT INTO `tp_qyquit_check` VALUES ('69', 'ewqe', '525', '25', '0', '19', '1422599369');
INSERT INTO `tp_qyquit_check` VALUES ('70', 'ewqe', '6326', '25', '0', '19', '1422599369');
INSERT INTO `tp_qyquit_check` VALUES ('71', 'ewqe', '3626', '25', '0', '19', '1422599369');
INSERT INTO `tp_qyquit_check` VALUES ('72', 'ewqe', 'xtzlyp', '25', '0', '19', '1422599369');
INSERT INTO `tp_qyquit_check` VALUES ('76', 'lijiahui_270636852', 'qiu123ok', '231', '1', '23', '1423540436');
INSERT INTO `tp_qyquit_check` VALUES ('77', 'zhc', 'qiu123ok', '231', '1', '24', '1425450440');

-- ----------------------------
-- Table structure for `tp_qyquit_config`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyquit_config`;
CREATE TABLE `tp_qyquit_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `audit` text,
  `time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyquit_config
-- ----------------------------
INSERT INTO `tp_qyquit_config` VALUES ('5', '25', '1', 'a:5:{i:0;N;i:1;s:3:\"525\";i:2;s:4:\"6326\";i:3;s:4:\"3626\";i:4;s:6:\"xtzlyp\";}', '1422413492');
INSERT INTO `tp_qyquit_config` VALUES ('7', '231', '1', 'a:2:{i:0;N;i:1;s:8:\"qiu123ok\";}', '1423274399');

-- ----------------------------
-- Table structure for `tp_qyquit_index`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyquit_index`;
CREATE TABLE `tp_qyquit_index` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `bumen` varchar(100) DEFAULT NULL,
  `zhiwei` varchar(100) DEFAULT NULL,
  `apply_time` varchar(30) DEFAULT NULL,
  `quit_time` varchar(30) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `check_now` varchar(32) DEFAULT NULL,
  `check_order` varchar(500) DEFAULT NULL,
  `reason` varchar(300) DEFAULT NULL COMMENT '离职原因',
  `status` tinyint(1) DEFAULT '0',
  `time` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyquit_index
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyresearch`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyresearch`;
CREATE TABLE `tp_qyresearch` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `type` varchar(100) NOT NULL COMMENT '调研类型',
  `end_time` varchar(16) DEFAULT NULL,
  `departid` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `restrictions` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1未发布2已发布3已暂停4已结束',
  `num` int(11) DEFAULT '0',
  `alldepart` text,
  PRIMARY KEY (`id`),
  KEY `tpye` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyresearch
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyresearch_an`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyresearch_an`;
CREATE TABLE `tp_qyresearch_an` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `answer` text,
  `user_id` int(11) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyresearch_an
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyresearch_option`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyresearch_option`;
CREATE TABLE `tp_qyresearch_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pid` int(10) NOT NULL COMMENT '与qyresearch_ques表对应的id',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '选择人数',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_title` varchar(255) DEFAULT NULL COMMENT '选项描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='调研选项表';

-- ----------------------------
-- Records of tp_qyresearch_option
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyresearch_option_1`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyresearch_option_1`;
CREATE TABLE `tp_qyresearch_option_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pid` int(10) NOT NULL COMMENT '与qyresearch_ques表对应的id',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '选择人数',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_title` varchar(255) DEFAULT NULL COMMENT '选项描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COMMENT='调研单选选项表';

-- ----------------------------
-- Records of tp_qyresearch_option_1
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyresearch_option_2`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyresearch_option_2`;
CREATE TABLE `tp_qyresearch_option_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pid` int(10) NOT NULL COMMENT '与qyresearch_ques表对应的id',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '选择人数',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_title` varchar(255) DEFAULT NULL COMMENT '选项描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COMMENT='调研多选选项表';

-- ----------------------------
-- Records of tp_qyresearch_option_2
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyresearch_option_3`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyresearch_option_3`;
CREATE TABLE `tp_qyresearch_option_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pid` int(10) NOT NULL COMMENT '与qyresearch_ques表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_title` varchar(255) NOT NULL COMMENT '选项描述',
  `score_1` int(11) NOT NULL DEFAULT '0' COMMENT '1分',
  `score_2` int(11) NOT NULL DEFAULT '0' COMMENT '2分',
  `score_3` int(11) NOT NULL DEFAULT '0' COMMENT '3分',
  `score_4` int(11) NOT NULL DEFAULT '0' COMMENT '4分',
  `score_5` int(11) NOT NULL DEFAULT '0' COMMENT '5分',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='调研评分选项表';

-- ----------------------------
-- Records of tp_qyresearch_option_3
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyresearch_option_4`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyresearch_option_4`;
CREATE TABLE `tp_qyresearch_option_4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pid` int(10) NOT NULL COMMENT '与qyresearch_ques表对应的id',
  `wecha_id` varchar(100) DEFAULT NULL COMMENT '选项编号',
  `answer` varchar(255) NOT NULL COMMENT '填空答案',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='调研填空选项表';

-- ----------------------------
-- Records of tp_qyresearch_option_4
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyresearch_option_5`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyresearch_option_5`;
CREATE TABLE `tp_qyresearch_option_5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pid` int(10) NOT NULL COMMENT '与qyresearch_ques表对应的id',
  `wecha_id` varchar(120) DEFAULT NULL,
  `answer` text NOT NULL COMMENT '回答内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='调研简答选项表';

-- ----------------------------
-- Records of tp_qyresearch_option_5
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyresearch_ques`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyresearch_ques`;
CREATE TABLE `tp_qyresearch_ques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `number` varchar(32) NOT NULL COMMENT '编号',
  `p_description` varchar(200) DEFAULT NULL,
  `options` text,
  `total` int(11) NOT NULL DEFAULT '0' COMMENT '调研总人数',
  `disorder` int(11) NOT NULL COMMENT '填入编号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyresearch_ques
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyscorecard`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyscorecard`;
CREATE TABLE `tp_qyscorecard` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL COMMENT '员工id',
  `scoreproject` varchar(100) DEFAULT NULL COMMENT '计分项目',
  `grades` int(11) DEFAULT NULL COMMENT '分数',
  `create_time` int(11) DEFAULT NULL COMMENT '计分时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyscorecard
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyscore_project`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyscore_project`;
CREATE TABLE `tp_qyscore_project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '类别id',
  `name` varchar(100) DEFAULT NULL COMMENT '计分项目名字',
  `score` int(11) DEFAULT '0' COMMENT '分数',
  `createtime` time DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyscore_project
-- ----------------------------
INSERT INTO `tp_qyscore_project` VALUES ('1', '0', '态度类', '0', null);
INSERT INTO `tp_qyscore_project` VALUES ('3', '1', '射弩神父是送的 是', '10', null);
INSERT INTO `tp_qyscore_project` VALUES ('4', '1', '电风扇飞地方飞', '10', null);
INSERT INTO `tp_qyscore_project` VALUES ('5', '1', '的阿斯顿阿斯顿', '-5', null);
INSERT INTO `tp_qyscore_project` VALUES ('6', '0', '成长类', '0', null);
INSERT INTO `tp_qyscore_project` VALUES ('7', '6', '水电费水电费', '0', null);
INSERT INTO `tp_qyscore_project` VALUES ('8', '6', '阿瑟阿斯顿 ', '0', null);
INSERT INTO `tp_qyscore_project` VALUES ('9', '6', '阿斯顿阿瑟阿斯顿', '0', null);
INSERT INTO `tp_qyscore_project` VALUES ('10', '6', '对方水电费', '0', null);
INSERT INTO `tp_qyscore_project` VALUES ('11', '0', '企业文化', '0', null);
INSERT INTO `tp_qyscore_project` VALUES ('12', '11', '我去问请问请问请问', '0', null);
INSERT INTO `tp_qyscore_project` VALUES ('13', '11', '请问请问其二其二请问请问', '0', null);
INSERT INTO `tp_qyscore_project` VALUES ('14', '11', '请问我请问', '0', null);
INSERT INTO `tp_qyscore_project` VALUES ('15', '0', 'hao lei', '0', '838:59:59');

-- ----------------------------
-- Table structure for `tp_qytask`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytask`;
CREATE TABLE `tp_qytask` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order` varchar(100) DEFAULT NULL,
  `helper` varchar(100) DEFAULT NULL,
  `end_time` varchar(16) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `mktime` varchar(16) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `fuzeren` varchar(200) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `head` varchar(100) DEFAULT NULL,
  `follow` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=288 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qytask
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytask_discuss`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytask_discuss`;
CREATE TABLE `tp_qytask_discuss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL COMMENT '任务id',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `content` varchar(255) DEFAULT NULL COMMENT '讨论内容',
  `posttime` int(10) DEFAULT NULL COMMENT '发表时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='任务讨论表';

-- ----------------------------
-- Records of tp_qytask_discuss
-- ----------------------------
INSERT INTO `tp_qytask_discuss` VALUES ('1', '25', 'ding', null, '1', '放vv', '1417232530');
INSERT INTO `tp_qytask_discuss` VALUES ('2', '25', 'ding', null, '1', '很高放', '1417234247');
INSERT INTO `tp_qytask_discuss` VALUES ('3', '25', 'ding', null, '1', '给vv', '1417234926');
INSERT INTO `tp_qytask_discuss` VALUES ('4', '25', 'xtzlyp', null, '1', '啊路哪里了', '1417236064');
INSERT INTO `tp_qytask_discuss` VALUES ('5', '25', 'ding', null, '1', 'uhg', '1417236067');
INSERT INTO `tp_qytask_discuss` VALUES ('6', '25', 'xtzlyp', '6', '1', '了老婆哦哦', '1417236139');
INSERT INTO `tp_qytask_discuss` VALUES ('7', '25', 'ding', null, '1', 'uhg', '1417236159');
INSERT INTO `tp_qytask_discuss` VALUES ('8', '25', 'ding', null, '1', 'uhg人个个', '1417236176');
INSERT INTO `tp_qytask_discuss` VALUES ('9', '25', 'ding', '7', '1', '方法v', '1417236249');
INSERT INTO `tp_qytask_discuss` VALUES ('10', '25', 'ding', '7', '1', '方法v', '1417236298');
INSERT INTO `tp_qytask_discuss` VALUES ('11', '25', 'ding', '7', '1', '光谷放', '1417236728');
INSERT INTO `tp_qytask_discuss` VALUES ('12', '25', 'xtzlyp', '6', '1', '了咯大家了', '1417236767');
INSERT INTO `tp_qytask_discuss` VALUES ('13', '25', 'tang', '7', '1', '哈哈', '1417281428');
INSERT INTO `tp_qytask_discuss` VALUES ('14', '25', 'xtzlyp', '19', '1', '邪恶红军', '1417331848');
INSERT INTO `tp_qytask_discuss` VALUES ('15', '25', 'wangming', '19', '1', '恶龙LOL了', '1417331988');
INSERT INTO `tp_qytask_discuss` VALUES ('16', '25', 'xtzlyp', '19', '1', '了落寞', '1417333183');
INSERT INTO `tp_qytask_discuss` VALUES ('17', '25', 'lanrain', '6', '1', 'jjkk', '1417333312');
INSERT INTO `tp_qytask_discuss` VALUES ('18', '25', 'xtzlyp', '19', '1', '', '1417343762');
INSERT INTO `tp_qytask_discuss` VALUES ('19', '25', 'wangming', '19', '1', 'hhhhhbbbbvg', '1417343954');
INSERT INTO `tp_qytask_discuss` VALUES ('20', '25', 'wangming', '19', '1', 'ghbbb卓', '1417343968');
INSERT INTO `tp_qytask_discuss` VALUES ('21', '25', 'wangming', '19', '1', 'nnnnn', '1417344029');
INSERT INTO `tp_qytask_discuss` VALUES ('22', '25', 'xtzlyp', null, '1', '123213', '1417416931');
INSERT INTO `tp_qytask_discuss` VALUES ('23', '25', 'lanrain', '13', '1', 'hjjn', '1417967513');
INSERT INTO `tp_qytask_discuss` VALUES ('24', '25', 'lanrain', '13', '1', '徰', '1417967530');
INSERT INTO `tp_qytask_discuss` VALUES ('25', '25', '270636852', '22', '1', 'j x n b', '1422178656');
INSERT INTO `tp_qytask_discuss` VALUES ('26', '25', '270636852', '22', '1', '', '1422414655');
INSERT INTO `tp_qytask_discuss` VALUES ('27', '25', '270636852', '22', '1', '', '1422414657');
INSERT INTO `tp_qytask_discuss` VALUES ('28', '25', '270636852', '22', '1', 'fsdgsdf', '1422414663');
INSERT INTO `tp_qytask_discuss` VALUES ('29', '25', 'xtzlyp', '19', '1', '你好', '1423304846');
INSERT INTO `tp_qytask_discuss` VALUES ('30', '25', 'lanrain', '23', '1', '下上', '1425379273');
INSERT INTO `tp_qytask_discuss` VALUES ('31', '25', 'lanrain', '23', '1', '的第一∵睡眠日昨晚上卡卓刀下了说了', '1425379316');
INSERT INTO `tp_qytask_discuss` VALUES ('32', '25', 'qiancheng', '47', '1', '嘿嘿嘿', '1426661687');
INSERT INTO `tp_qytask_discuss` VALUES ('33', '25', '0033', '63', '3', '快点', '1427439763');
INSERT INTO `tp_qytask_discuss` VALUES ('34', '25', '0033', '63', '1', '加速', '1427439770');
INSERT INTO `tp_qytask_discuss` VALUES ('35', '25', '791344275', '231', '1', 'tuyu', '1428918689');
INSERT INTO `tp_qytask_discuss` VALUES ('36', '25', '791344275', '231', '1', 'uyi', '1428918692');
INSERT INTO `tp_qytask_discuss` VALUES ('37', '25', '791344275', '221', '1', '……', '1429088610');
INSERT INTO `tp_qytask_discuss` VALUES ('38', '25', 'li_jun_6', '221', '1', 'CK抹嘴都是这样', '1429254359');
INSERT INTO `tp_qytask_discuss` VALUES ('39', '25', '0033', '271', '1', 'jkhghl', '1429339614');
INSERT INTO `tp_qytask_discuss` VALUES ('40', '25', '0033', '271', '1', '', '1429339617');
INSERT INTO `tp_qytask_discuss` VALUES ('41', '25', '0033', '271', '1', '', '1429339619');
INSERT INTO `tp_qytask_discuss` VALUES ('42', '25', 'li_jun_6', '221', '1', '啥时候回来了我在广州的样子哦', '1429514383');
INSERT INTO `tp_qytask_discuss` VALUES ('43', '25', '270636852', '274', '1', '重做！\r\n', '1429515039');
INSERT INTO `tp_qytask_discuss` VALUES ('44', '25', '270636852', '274', '1', '', '1429515041');
INSERT INTO `tp_qytask_discuss` VALUES ('45', '25', '270636852', '274', '1', '曾经苦苦奋斗的', '1429520187');

-- ----------------------------
-- Table structure for `tp_qytask_record`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytask_record`;
CREATE TABLE `tp_qytask_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `wecha_id` varchar(64) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '该任务的流程类型1创建2完成3讨论4转发',
  `status` tinyint(1) DEFAULT NULL COMMENT '1完成0未完成',
  `outtime` tinyint(1) DEFAULT NULL COMMENT '1为结束0未结束',
  `time` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qytask_record
-- ----------------------------
INSERT INTO `tp_qytask_record` VALUES ('10', '19', 'xtzlyp', '25', '3', null, null, '1417333312');
INSERT INTO `tp_qytask_record` VALUES ('11', '6', 'lanrain', '25', '3', null, null, '1417333312');
INSERT INTO `tp_qytask_record` VALUES ('12', '19', 'wangming', '25', '2', null, null, '1417333931');
INSERT INTO `tp_qytask_record` VALUES ('13', '6', 'lanrain', '25', '2', null, null, '1417335066');
INSERT INTO `tp_qytask_record` VALUES ('14', '19', 'xtzlyp', '25', '2', null, null, '1417340680');
INSERT INTO `tp_qytask_record` VALUES ('15', '19', 'xtzlyp', '25', '2', null, null, '1417341141');
INSERT INTO `tp_qytask_record` VALUES ('16', '19', 'xtzlyp', '25', '3', null, null, '1417343762');
INSERT INTO `tp_qytask_record` VALUES ('17', '19', 'wangming', '25', '3', null, null, '1417343954');
INSERT INTO `tp_qytask_record` VALUES ('18', '19', 'wangming', '25', '3', null, null, '1417343968');
INSERT INTO `tp_qytask_record` VALUES ('19', '19', 'wangming', '25', '3', null, null, '1417344029');
INSERT INTO `tp_qytask_record` VALUES ('20', null, 'xtzlyp', '25', '3', null, null, '1417416931');
INSERT INTO `tp_qytask_record` VALUES ('21', '13', 'lanrain', '25', '3', null, null, '1417967513');
INSERT INTO `tp_qytask_record` VALUES ('22', '13', 'lanrain', '25', '3', null, null, '1417967530');
INSERT INTO `tp_qytask_record` VALUES ('23', '13', 'lanrain', '25', '2', null, null, '1417967586');
INSERT INTO `tp_qytask_record` VALUES ('24', '7', 'ding', '25', '2', null, null, '1419234301');
INSERT INTO `tp_qytask_record` VALUES ('25', '7', 'ding', '25', '2', null, null, '1419234303');
INSERT INTO `tp_qytask_record` VALUES ('26', '7', 'ding', '25', '2', null, null, '1419234304');
INSERT INTO `tp_qytask_record` VALUES ('27', '7', 'ding', '25', '2', null, null, '1419234305');
INSERT INTO `tp_qytask_record` VALUES ('28', '7', 'ding', '25', '2', null, null, '1419234311');
INSERT INTO `tp_qytask_record` VALUES ('29', '7', 'ding', '25', '2', null, null, '1419234313');
INSERT INTO `tp_qytask_record` VALUES ('30', '7', 'ding', '25', '2', null, null, '1419234313');
INSERT INTO `tp_qytask_record` VALUES ('31', '7', 'ding', '25', '2', null, null, '1419234327');
INSERT INTO `tp_qytask_record` VALUES ('32', '7', 'ding', '25', '2', null, null, '1419234339');
INSERT INTO `tp_qytask_record` VALUES ('33', '7', 'ding', '25', '2', null, null, '1419234357');
INSERT INTO `tp_qytask_record` VALUES ('34', '7', 'ding', '25', '2', null, null, '1419234851');
INSERT INTO `tp_qytask_record` VALUES ('35', '7', 'ding', '25', '2', null, null, '1419234851');
INSERT INTO `tp_qytask_record` VALUES ('36', '7', 'ding', '25', '2', null, null, '1419234851');
INSERT INTO `tp_qytask_record` VALUES ('37', '7', 'ding', '25', '2', null, null, '1419584430');
INSERT INTO `tp_qytask_record` VALUES ('38', '22', '270636852', '25', '3', null, null, '1422178656');
INSERT INTO `tp_qytask_record` VALUES ('39', '24', 'xiangshenghong', '25', '2', null, null, '1422359635');
INSERT INTO `tp_qytask_record` VALUES ('40', '24', 'xiangshenghong', '25', '2', null, null, '1422359635');
INSERT INTO `tp_qytask_record` VALUES ('41', '22', '270636852', '25', '2', null, null, '1422414354');
INSERT INTO `tp_qytask_record` VALUES ('42', '22', '270636852', '25', '3', null, null, '1422414655');
INSERT INTO `tp_qytask_record` VALUES ('43', '22', '270636852', '25', '3', null, null, '1422414657');
INSERT INTO `tp_qytask_record` VALUES ('44', '22', '270636852', '25', '3', null, null, '1422414663');
INSERT INTO `tp_qytask_record` VALUES ('45', '20', '270636852', '25', '2', null, null, '1423017252');
INSERT INTO `tp_qytask_record` VALUES ('46', '20', 'qiancheng', '25', '2', null, null, '1423017573');
INSERT INTO `tp_qytask_record` VALUES ('47', '19', 'xtzlyp', '25', '3', null, null, '1423304846');
INSERT INTO `tp_qytask_record` VALUES ('48', '24', 'ding', '25', '2', null, null, '1423727791');
INSERT INTO `tp_qytask_record` VALUES ('49', '24', 'ding', '25', '2', null, null, '1423727819');
INSERT INTO `tp_qytask_record` VALUES ('50', '24', 'ding', '25', '2', null, null, '1423728343');
INSERT INTO `tp_qytask_record` VALUES ('51', '7', 'ding', '25', '2', null, null, '1423736881');
INSERT INTO `tp_qytask_record` VALUES ('52', '23', 'ding', '25', '2', null, null, '1423736943');
INSERT INTO `tp_qytask_record` VALUES ('53', '23', 'ding', '25', '2', null, null, '1423736944');
INSERT INTO `tp_qytask_record` VALUES ('54', '7', 'ding', '25', '2', null, null, '1423737111');
INSERT INTO `tp_qytask_record` VALUES ('55', '19', 'lanrain', '25', '2', null, null, '1424108435');
INSERT INTO `tp_qytask_record` VALUES ('56', '19', 'lanrain', '25', '2', null, null, '1424108463');
INSERT INTO `tp_qytask_record` VALUES ('57', '23', 'lanrain', '25', '3', null, null, '1425379273');
INSERT INTO `tp_qytask_record` VALUES ('58', '23', 'lanrain', '25', '3', null, null, '1425379316');
INSERT INTO `tp_qytask_record` VALUES ('59', '23', 'lanrain', '25', '2', null, null, '1425379348');
INSERT INTO `tp_qytask_record` VALUES ('60', '23', 'lanrain', '25', '2', null, null, '1425379352');
INSERT INTO `tp_qytask_record` VALUES ('61', '47', 'qiancheng', '25', '3', null, null, '1426661687');
INSERT INTO `tp_qytask_record` VALUES ('62', '47', 'qiancheng', '25', '2', null, null, '1426661717');
INSERT INTO `tp_qytask_record` VALUES ('63', '47', 'qiancheng', '25', '2', null, null, '1426662530');
INSERT INTO `tp_qytask_record` VALUES ('64', '26', '270636852', '25', '2', null, null, '1426666091');
INSERT INTO `tp_qytask_record` VALUES ('65', '57', 'ding', '25', '2', null, null, '1427277710');
INSERT INTO `tp_qytask_record` VALUES ('66', '60', 'li_jun_6', '25', '2', null, null, '1427342271');
INSERT INTO `tp_qytask_record` VALUES ('67', '63', '0033', '25', '2', null, null, '1427357254');
INSERT INTO `tp_qytask_record` VALUES ('68', '63', '0033', '25', '2', null, null, '1427358066');
INSERT INTO `tp_qytask_record` VALUES ('69', '63', '0033', '25', '2', null, null, '1427439417');
INSERT INTO `tp_qytask_record` VALUES ('70', '63', '0033', '25', '3', null, null, '1427439763');
INSERT INTO `tp_qytask_record` VALUES ('71', '63', '0033', '25', '3', null, null, '1427439770');
INSERT INTO `tp_qytask_record` VALUES ('72', '63', '0033', '25', '2', null, null, '1427439780');
INSERT INTO `tp_qytask_record` VALUES ('73', '63', '0033', '25', '2', null, null, '1427524899');
INSERT INTO `tp_qytask_record` VALUES ('74', '63', '0033', '25', '2', null, null, '1427524899');
INSERT INTO `tp_qytask_record` VALUES ('75', '78', 'li_jun_6', '25', '2', null, null, '1427540097');
INSERT INTO `tp_qytask_record` VALUES ('76', '84', '0033', '25', '2', null, null, '1427855313');
INSERT INTO `tp_qytask_record` VALUES ('77', '84', '0033', '25', '2', null, null, '1427855607');
INSERT INTO `tp_qytask_record` VALUES ('78', null, '0033', '25', '2', null, null, '1427873640');
INSERT INTO `tp_qytask_record` VALUES ('79', '84', '0033', '25', '2', null, null, '1427873715');
INSERT INTO `tp_qytask_record` VALUES ('80', null, '791344275', '25', '2', null, null, '1428740808');
INSERT INTO `tp_qytask_record` VALUES ('81', null, '791344275', '25', '2', null, null, '1428740808');
INSERT INTO `tp_qytask_record` VALUES ('82', null, '791344275', '25', '2', null, null, '1428740821');
INSERT INTO `tp_qytask_record` VALUES ('83', null, '0033', '25', '2', null, null, '1428744527');
INSERT INTO `tp_qytask_record` VALUES ('84', null, '0033', '25', '2', null, null, '1428744604');
INSERT INTO `tp_qytask_record` VALUES ('85', '199', 'lanrain', '25', '2', null, null, '1428750290');
INSERT INTO `tp_qytask_record` VALUES ('86', '209', '791344275', '25', '2', null, null, '1428890592');
INSERT INTO `tp_qytask_record` VALUES ('87', '209', '791344275', '25', '2', null, null, '1428890790');
INSERT INTO `tp_qytask_record` VALUES ('88', '217', '791344275', '25', '2', null, null, '1428891928');
INSERT INTO `tp_qytask_record` VALUES ('89', '217', '791344275', '25', '2', null, null, '1428891928');
INSERT INTO `tp_qytask_record` VALUES ('90', null, '791344275', '25', '2', null, null, '1428892370');
INSERT INTO `tp_qytask_record` VALUES ('91', null, '791344275', '25', '2', null, null, '1428893077');
INSERT INTO `tp_qytask_record` VALUES ('92', '225', '791344275', '25', '2', null, null, '1428907623');
INSERT INTO `tp_qytask_record` VALUES ('93', '225', '791344275', '25', '2', null, null, '1428907703');
INSERT INTO `tp_qytask_record` VALUES ('94', '225', '791344275', '25', '2', null, null, '1428907715');
INSERT INTO `tp_qytask_record` VALUES ('95', '194', '791344275', '25', '2', null, null, '1428907735');
INSERT INTO `tp_qytask_record` VALUES ('96', '194', '791344275', '25', '2', null, null, '1428907740');
INSERT INTO `tp_qytask_record` VALUES ('97', '221', '791344275', '25', '2', null, null, '1428908845');
INSERT INTO `tp_qytask_record` VALUES ('98', null, '791344275', '25', '2', null, null, '1428908856');
INSERT INTO `tp_qytask_record` VALUES ('99', null, '791344275', '25', '2', null, null, '1428908858');
INSERT INTO `tp_qytask_record` VALUES ('100', null, '791344275', '25', '2', null, null, '1428908863');
INSERT INTO `tp_qytask_record` VALUES ('101', '221', '791344275', '25', '2', null, null, '1428910322');
INSERT INTO `tp_qytask_record` VALUES ('102', '221', '791344275', '25', '2', null, null, '1428917743');
INSERT INTO `tp_qytask_record` VALUES ('103', '231', '791344275', '25', '3', null, null, '1428918689');
INSERT INTO `tp_qytask_record` VALUES ('104', '231', '791344275', '25', '3', null, null, '1428918692');
INSERT INTO `tp_qytask_record` VALUES ('105', null, '791344275', '25', '2', null, null, '1428921438');
INSERT INTO `tp_qytask_record` VALUES ('106', null, '791344275', '25', '2', null, null, '1428921612');
INSERT INTO `tp_qytask_record` VALUES ('107', '240', '791344275', '25', '2', null, null, '1428922543');
INSERT INTO `tp_qytask_record` VALUES ('108', '239', '791344275', '25', '2', null, null, '1428922618');
INSERT INTO `tp_qytask_record` VALUES ('109', '243', '791344275', '25', '2', null, null, '1428922719');
INSERT INTO `tp_qytask_record` VALUES ('110', '221', '791344275', '25', '2', null, null, '1428977445');
INSERT INTO `tp_qytask_record` VALUES ('111', '240', '791344275', '25', '2', null, null, '1429080222');
INSERT INTO `tp_qytask_record` VALUES ('112', '221', '791344275', '25', '3', null, null, '1429088610');
INSERT INTO `tp_qytask_record` VALUES ('113', '193', '0033', '25', '2', null, null, '1429166200');
INSERT INTO `tp_qytask_record` VALUES ('114', '193', '0033', '25', '2', null, null, '1429167010');
INSERT INTO `tp_qytask_record` VALUES ('115', '221', 'li_jun_6', '25', '3', null, null, '1429254359');
INSERT INTO `tp_qytask_record` VALUES ('116', '221', 'li_jun_6', '25', '2', null, null, '1429254370');
INSERT INTO `tp_qytask_record` VALUES ('117', '271', '0033', '25', '3', null, null, '1429339614');
INSERT INTO `tp_qytask_record` VALUES ('118', '271', '0033', '25', '3', null, null, '1429339617');
INSERT INTO `tp_qytask_record` VALUES ('119', '271', '0033', '25', '3', null, null, '1429339619');
INSERT INTO `tp_qytask_record` VALUES ('120', '271', '0033', '25', '2', null, null, '1429339629');
INSERT INTO `tp_qytask_record` VALUES ('121', '271', '0033', '25', '2', null, null, '1429339710');
INSERT INTO `tp_qytask_record` VALUES ('122', '221', 'li_jun_6', '25', '2', null, null, '1429502041');
INSERT INTO `tp_qytask_record` VALUES ('123', '221', 'li_jun_6', '25', '2', null, null, '1429502041');
INSERT INTO `tp_qytask_record` VALUES ('124', '221', 'li_jun_6', '25', '3', null, null, '1429514383');
INSERT INTO `tp_qytask_record` VALUES ('125', '274', '270636852', '25', '3', null, null, '1429515039');
INSERT INTO `tp_qytask_record` VALUES ('126', '274', '270636852', '25', '3', null, null, '1429515041');
INSERT INTO `tp_qytask_record` VALUES ('127', '228', '791344275', '25', '2', null, null, '1429518334');
INSERT INTO `tp_qytask_record` VALUES ('128', '228', '791344275', '25', '2', null, null, '1429518334');
INSERT INTO `tp_qytask_record` VALUES ('129', '274', '270636852', '25', '3', null, null, '1429520187');
INSERT INTO `tp_qytask_record` VALUES ('130', '274', '270636852', '25', '2', null, null, '1429520195');
INSERT INTO `tp_qytask_record` VALUES ('131', '78', 'li_jun_6', '25', '2', null, null, '1429520899');
INSERT INTO `tp_qytask_record` VALUES ('132', '221', 'li_jun_6', '25', '2', null, null, '1429520923');
INSERT INTO `tp_qytask_record` VALUES ('133', '221', 'li_jun_6', '25', '2', null, null, '1429520984');

-- ----------------------------
-- Table structure for `tp_qytemplet`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytemplet`;
CREATE TABLE `tp_qytemplet` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `version` varchar(45) NOT NULL,
  `utime` int(11) NOT NULL,
  `tem_logo` varchar(128) NOT NULL,
  `desc` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qytemplet
-- ----------------------------
INSERT INTO `tp_qytemplet` VALUES ('1', 'fwm_gd', '', '0', '', '');
INSERT INTO `tp_qytemplet` VALUES ('2', 'jbq', '', '0', '', '');
INSERT INTO `tp_qytemplet` VALUES ('3', 'jd', '', '0', '', '');
INSERT INTO `tp_qytemplet` VALUES ('4', 'lanrain', '', '0', '', '');
INSERT INTO `tp_qytemplet` VALUES ('5', 'lsfg', '', '0', '', '');
INSERT INTO `tp_qytemplet` VALUES ('6', 'new', '', '0', '', '');
INSERT INTO `tp_qytemplet` VALUES ('7', 'shis', '', '0', '', '');
INSERT INTO `tp_qytemplet` VALUES ('8', 'wkl', '', '0', '', '');

-- ----------------------------
-- Table structure for `tp_qytest_config`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_config`;
CREATE TABLE `tp_qytest_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `starttime` int(10) DEFAULT NULL COMMENT '创建时间',
  `endtime` int(10) DEFAULT NULL COMMENT '结束时间',
  `times` int(10) DEFAULT NULL COMMENT '答题次数0或空为不限',
  `is_tip` tinyint(1) DEFAULT NULL COMMENT '是否提示',
  `type` tinyint(1) NOT NULL COMMENT '考试分数类型1百分制2为题数制',
  `condition` smallint(4) NOT NULL COMMENT 'type为1表示分数为2表示题数',
  `select_question` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1为随机2为顺序3为。。。',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qytest_config
-- ----------------------------
INSERT INTO `tp_qytest_config` VALUES ('2', '25', '-28800', '2563200', '3', '2', '1', '10', '1');
INSERT INTO `tp_qytest_config` VALUES ('3', '25', '1426089600', '1427558100', null, null, '1', '0', '1');
INSERT INTO `tp_qytest_config` VALUES ('4', '25', '1425484800', '1427558100', null, null, '1', '0', '1');

-- ----------------------------
-- Table structure for `tp_qytest_option_1`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_option_1`;
CREATE TABLE `tp_qytest_option_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `t_id` int(10) NOT NULL COMMENT '与表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `disorder` varchar(50) DEFAULT NULL COMMENT '自定义选项编号',
  `option_title` varchar(100) NOT NULL COMMENT '选项标题',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='考试单选选项表';

-- ----------------------------
-- Records of tp_qytest_option_1
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytest_option_2`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_option_2`;
CREATE TABLE `tp_qytest_option_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `t_id` int(10) NOT NULL COMMENT '与表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `disorder` varchar(50) DEFAULT NULL COMMENT '自定义选项编号',
  `option_title` varchar(100) NOT NULL COMMENT '选项标题',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='考试单选选项表';

-- ----------------------------
-- Records of tp_qytest_option_2
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytest_option_3`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_option_3`;
CREATE TABLE `tp_qytest_option_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `t_id` int(10) NOT NULL COMMENT '与表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_imgurl` varchar(255) NOT NULL COMMENT '该选项图片',
  `option_info` varchar(255) DEFAULT NULL COMMENT '该选项文字说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='多图对比选项表';

-- ----------------------------
-- Records of tp_qytest_option_3
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytest_option_4`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_option_4`;
CREATE TABLE `tp_qytest_option_4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `t_id` int(10) NOT NULL COMMENT '与表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_imgurl` varchar(255) NOT NULL COMMENT '该选项图片',
  `option_info` varchar(255) DEFAULT NULL COMMENT '该选项文字说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='多图对比选项表';

-- ----------------------------
-- Records of tp_qytest_option_4
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytest_paper`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_paper`;
CREATE TABLE `tp_qytest_paper` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sum` int(10) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `starttime` int(10) DEFAULT NULL,
  `endtime` int(10) DEFAULT NULL,
  `condition` smallint(6) NOT NULL,
  `is_tip` tinyint(1) DEFAULT NULL,
  `departid` varchar(255) DEFAULT NULL COMMENT '部门id',
  `alldepart` varchar(255) DEFAULT NULL COMMENT '所有子部门',
  `status` tinyint(1) DEFAULT NULL COMMENT '1开始考试0结束考试',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qytest_paper
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytest_paper_1`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_paper_1`;
CREATE TABLE `tp_qytest_paper_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `t_id` int(10) NOT NULL COMMENT '与表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `disorder` varchar(50) DEFAULT NULL COMMENT '自定义选项编号',
  `option_title` varchar(100) NOT NULL COMMENT '选项标题',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='考试单选选项表';

-- ----------------------------
-- Records of tp_qytest_paper_1
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytest_paper_2`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_paper_2`;
CREATE TABLE `tp_qytest_paper_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `t_id` int(10) NOT NULL COMMENT '与表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `disorder` varchar(50) DEFAULT NULL COMMENT '自定义选项编号',
  `option_title` varchar(100) NOT NULL COMMENT '选项标题',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='考试单选选项表';

-- ----------------------------
-- Records of tp_qytest_paper_2
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytest_paper_3`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_paper_3`;
CREATE TABLE `tp_qytest_paper_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `t_id` int(10) NOT NULL COMMENT '与表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_imgurl` varchar(255) NOT NULL COMMENT '该选项图片',
  `option_info` varchar(255) DEFAULT NULL COMMENT '该选项文字说明',
  `option_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='多图对比选项表';

-- ----------------------------
-- Records of tp_qytest_paper_3
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytest_paper_4`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_paper_4`;
CREATE TABLE `tp_qytest_paper_4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `t_id` int(10) NOT NULL COMMENT '与表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_imgurl` varchar(255) NOT NULL COMMENT '该选项图片',
  `option_info` varchar(255) DEFAULT NULL COMMENT '该选项文字说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='多图对比选项表';

-- ----------------------------
-- Records of tp_qytest_paper_4
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytest_paper_t`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_paper_t`;
CREATE TABLE `tp_qytest_paper_t` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `time` int(10) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL,
  `option` text COMMENT '选项',
  `pid` int(10) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `questionid` int(10) DEFAULT NULL,
  `score` smallint(6) DEFAULT NULL COMMENT '分值',
  `disorder` smallint(6) DEFAULT NULL COMMENT '顺序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qytest_paper_t
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytest_question`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_question`;
CREATE TABLE `tp_qytest_question` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `title` varchar(100) NOT NULL,
  `time` int(10) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `imgurl` varchar(255) DEFAULT NULL,
  `answerinfo` float(6,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qytest_question
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytest_user`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_user`;
CREATE TABLE `tp_qytest_user` (
  `id` int(10) NOT NULL,
  `username` varchar(255) DEFAULT NULL COMMENT '名称',
  `user_id` varchar(255) NOT NULL,
  `sum` smallint(4) NOT NULL COMMENT '做题总数',
  `dotime` mediumint(6) NOT NULL COMMENT '做题时间',
  `score` smallint(6) NOT NULL COMMENT '分数',
  `wecha_id` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '用户状态',
  `starttime` int(10) NOT NULL COMMENT '答题开始时间',
  `endtime` int(10) NOT NULL COMMENT '答题结束时间',
  `times` smallint(4) DEFAULT NULL COMMENT '答题次数',
  `pid` int(10) NOT NULL COMMENT '与qytest_paper表关联id',
  `info` text,
  `result` text COMMENT '已经回答的问题id',
  `is_result` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qytest_user
-- ----------------------------
INSERT INTO `tp_qytest_user` VALUES ('0', null, '25', '0', '0', '10', '0033', '1', '1428999568', '0', '2', '4', null, null, null);

-- ----------------------------
-- Table structure for `tp_qytest_user_check`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytest_user_check`;
CREATE TABLE `tp_qytest_user_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paperid` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sum` tinyint(6) DEFAULT NULL,
  `wecha_id` varchar(30) DEFAULT NULL,
  `old_score` float(6,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qytest_user_check
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qytoken`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qytoken`;
CREATE TABLE `tp_qytoken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL DEFAULT '' COMMENT '企业token',
  `username` varchar(100) NOT NULL COMMENT '用户账号',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `qyname` varchar(100) NOT NULL DEFAULT '' COMMENT '企业名称',
  `host` varchar(100) NOT NULL,
  `shortname` varchar(50) NOT NULL DEFAULT '' COMMENT '企业简称',
  `mp` varchar(11) NOT NULL DEFAULT '' COMMENT '手机',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '电话号码',
  `address` varchar(200) NOT NULL DEFAULT '' COMMENT '企业所在地',
  `industry` varchar(200) NOT NULL DEFAULT '' COMMENT '所属行业',
  `type` varchar(50) NOT NULL DEFAULT '1' COMMENT '用户等级版本 默认1为试用版本',
  `contact` varchar(50) NOT NULL DEFAULT '' COMMENT '联系人',
  `corpid` varchar(100) NOT NULL DEFAULT '',
  `corpsecret` varchar(200) NOT NULL DEFAULT '',
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `intro` text NOT NULL,
  `logourl` varchar(180) NOT NULL DEFAULT '',
  `addtime` int(15) NOT NULL,
  `endtime` int(15) NOT NULL COMMENT '用户到期时间',
  `zt` int(11) NOT NULL,
  `lastlogin` varchar(40) NOT NULL,
  `lastloginip` varchar(40) NOT NULL,
  `headimg` varchar(300) DEFAULT NULL,
  `money` int(8) DEFAULT NULL,
  `permanent_code` varchar(200) DEFAULT NULL COMMENT '第三方永久授权码',
  `th_corpid` varchar(100) DEFAULT NULL COMMENT '第三方授权方企业号id',
  `gid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=MyISAM AUTO_INCREMENT=237 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qytoken
-- ----------------------------
INSERT INTO `tp_qytoken` VALUES ('25', '', 'weiyi', 'b59c67bf196a4758191e42f76670ceba', 'weiyi22', 'qy.workweixin.com', '', '15546578595', '', '临沂市莒南县', 'IT服务(系统/数据/维护)', '2', 'weiyi', 'wxbc139a11baf4348a', 'ye6wz29hy3-IWkTtVar9pJNv5tpPL6SGH13cFKM-SA21sXnxQwS_FqUbOe-fb1y3', '0', '0', '', '', '1416453383', '1456934400', '0', '', '', 'http://qy.workweixin.com/TempFile/admin/image/20150410163802628.jpg', null, '', '', '2');

-- ----------------------------
-- Table structure for `tp_qyuser`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyuser`;
CREATE TABLE `tp_qyuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) DEFAULT NULL,
  `psd` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyuser
-- ----------------------------
INSERT INTO `tp_qyuser` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for `tp_qyusercard`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyusercard`;
CREATE TABLE `tp_qyusercard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `depart` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `userinfo` text,
  `connectinfo` text,
  `companyinfo` text,
  `otherinfo` text,
  `time` varchar(16) DEFAULT NULL,
  `tpl` tinyint(4) DEFAULT '8',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyusercard
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyusernode`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyusernode`;
CREATE TABLE `tp_qyusernode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `nums` int(10) DEFAULT NULL,
  `price` int(5) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyusernode
-- ----------------------------
INSERT INTO `tp_qyusernode` VALUES ('1', '试用版本', '1000', '0', '1', '1');
INSERT INTO `tp_qyusernode` VALUES ('2', 'vip13', '30', '100', '1', '1');
INSERT INTO `tp_qyusernode` VALUES ('3', 'vip2', '100', '200', '1', '1');

-- ----------------------------
-- Table structure for `tp_qyusers`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyusers`;
CREATE TABLE `tp_qyusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(64) DEFAULT NULL,
  `name` varchar(16) DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `department` varchar(64) DEFAULT NULL,
  `position` varchar(64) DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `tel` varchar(16) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `weixinid` varchar(128) DEFAULT NULL,
  `extattr` text,
  `user_id` int(11) DEFAULT NULL,
  `email_psd` varchar(64) DEFAULT NULL,
  `pic` varchar(300) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '关注状态',
  `enable` tinyint(1) DEFAULT '1' COMMENT '禁用状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyusers
-- ----------------------------
INSERT INTO `tp_qyusers` VALUES ('236', ';1;', '廖蓉城', 'cheng', null, null, '18899715686', '1', null, null, 'cheng186350', null, '25', null, 'http://shp.qpic.cn/bizmp/gOLfYjM9G6eK2r0ddTxjjzNl6OiciaXZbqXPoW6oriboeQZmpia4ntL8pQ/', '1', '1');
INSERT INTO `tp_qyusers` VALUES ('237', ';1;1;', '端木', 'duanmu', null, null, null, '2', null, '344151820@qq.com', 'cchhll5240', null, '25', null, null, '1', '1');
INSERT INTO `tp_qyusers` VALUES ('238', ';1;1;1;', '段容', 'duanrong', null, null, null, '2', null, '468524819@qq.com', 'cchhll0524', null, '25', null, 'http://shp.qpic.cn/bizmp/gOLfYjM9G6eK2r0ddTxjjzNl6OiciaXZbqxlBH0oc3rtj3naI0wicYPjw/', '1', '1');
INSERT INTO `tp_qyusers` VALUES ('239', ';1;1;1;1;', '孔德鸿', 'hong', null, null, '18925173738', '1', null, null, null, null, '25', null, 'http://shp.qpic.cn/bizmp/gOLfYjM9G6fibgmRibLicndtmJthfxvTib1cTPWnu3EZXHYib2lLo8Lk5tw/', '1', '1');
INSERT INTO `tp_qyusers` VALUES ('240', ';1;1;1;1;1;', '叶久', 'jiujiu', null, null, null, '2', null, '468763802@qq.com', 'alivezy', null, '25', null, null, '1', '1');
INSERT INTO `tp_qyusers` VALUES ('241', ';1;1;1;1;1;1;', '玖夜', 'jiuye', null, null, null, '1', null, '570538509@qq.com', 'cchhll05240', null, '25', null, 'http://shp.qpic.cn/bizmp/gOLfYjM9G6eK2r0ddTxjjzNl6OiciaXZbqqMQibvA6iaWaMibaAshxnvugQ/', '1', '1');
INSERT INTO `tp_qyusers` VALUES ('242', ';1;1;1;1;1;1;1;', '测试用', 'kong', null, '测试用', null, '1', null, '781747147@qq.com', null, null, '25', null, null, '4', '1');
INSERT INTO `tp_qyusers` VALUES ('243', ';1;1;1;1;1;1;1;2;', '李俊', 'lijun', null, null, null, '1', null, null, 'li_jun_6', null, '25', null, null, '4', '1');
INSERT INTO `tp_qyusers` VALUES ('244', ';1;1;1;1;1;1;1;2;1;', '速递超人', 'superman', null, null, null, '1', null, '565063445@qq.com', 'yibansiyibansheng', null, '25', null, 'http://shp.qpic.cn/bizmp/gOLfYjM9G6cI7nh0MNQJ8oWcjHglZuAJkiasnwHdJEHhBHic50xb4lSA/', '1', '1');
INSERT INTO `tp_qyusers` VALUES ('245', ';1;1;1;1;1;1;1;2;1;1;', '小安', 'xiaoan', null, null, null, '2', null, '3214428011@qq.com', 'xia3179', null, '25', null, 'http://shp.qpic.cn/bizmp/gOLfYjM9G6eK2r0ddTxjjzNl6OiciaXZbqSha5dCj8yPic5024oZ5h0hQ/', '1', '1');
INSERT INTO `tp_qyusers` VALUES ('246', ';1;1;1;1;1;1;1;2;1;1;1;', '颜帼', 'yanguo', null, null, null, '2', null, '1810279900@qq.com', 'fghjjv789', null, '25', null, 'http://shp.qpic.cn/bizmp/gOLfYjM9G6eK2r0ddTxjjzNl6OiciaXZbqpX5FAAkLibWmgdEicBj1qWrw/', '1', '1');
INSERT INTO `tp_qyusers` VALUES ('247', ';1;1;1;1;1;1;1;2;1;1;1;1;', '叶叶', 'yeye', null, null, null, '1', null, '1810270077@qq.com', 'fushenruoshui', null, '25', null, 'http://shp.qpic.cn/bizmp/gOLfYjM9G6eK2r0ddTxjjzNl6OiciaXZbqaFibya1b2icQiana2FBs8X3uQ/', '1', '1');

-- ----------------------------
-- Table structure for `tp_qyvote`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote`;
CREATE TABLE `tp_qyvote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '类型:1文字投票2图片投票',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '投票状态:1进行中3已结束2未开始',
  `info` text COMMENT '相关说明',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `starttime` int(10) NOT NULL COMMENT '开始时间',
  `endtime` int(10) NOT NULL COMMENT '结束时间',
  `nums` int(11) NOT NULL COMMENT '参与人数',
  `content` text NOT NULL COMMENT '投票内容',
  `detail` varchar(300) NOT NULL COMMENT '详情',
  `result` varchar(20) NOT NULL COMMENT '投票结果/百分比',
  `voter` text NOT NULL COMMENT '投票人员',
  `expirationTime` tinyint(1) NOT NULL COMMENT '到期时间提醒',
  `is_radio` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1单选0多选',
  `is_real_name` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1实名0匿名',
  `time` int(10) NOT NULL COMMENT '添加时间',
  `temp` tinyint(1) DEFAULT NULL,
  `imgurl` varchar(300) DEFAULT NULL,
  `depart` varchar(200) DEFAULT NULL,
  `imgurls` text,
  `node` varchar(200) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `switch` tinyint(1) DEFAULT '2' COMMENT '1开启该投票2关闭该投票',
  PRIMARY KEY (`id`),
  KEY `starttime` (`starttime`,`endtime`,`nums`),
  KEY `time` (`time`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COMMENT='投票表';

-- ----------------------------
-- Records of tp_qyvote
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyvote_option`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote_option`;
CREATE TABLE `tp_qyvote_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `vote_id` int(10) NOT NULL COMMENT '与qyvote表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_title` varchar(100) DEFAULT NULL COMMENT '选项标题',
  `vote_number` int(11) NOT NULL COMMENT '该选项投票人数',
  `vote_total` int(11) NOT NULL COMMENT '总投票人数',
  `option_imgurl` varchar(255) DEFAULT NULL,
  `option_info` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='投票选项表';

-- ----------------------------
-- Records of tp_qyvote_option
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyvote_option_1`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote_option_1`;
CREATE TABLE `tp_qyvote_option_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `vote_id` int(10) NOT NULL COMMENT '与qyvote表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_title` varchar(100) NOT NULL COMMENT '选项标题',
  `vote_number` int(11) NOT NULL COMMENT '该选项投票人数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='投票单选选项表';

-- ----------------------------
-- Records of tp_qyvote_option_1
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyvote_option_2`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote_option_2`;
CREATE TABLE `tp_qyvote_option_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `vote_id` int(10) NOT NULL COMMENT '与qyvote表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_title` varchar(100) NOT NULL COMMENT '选项标题',
  `vote_number` int(11) NOT NULL COMMENT '该选项投票人数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='投票多选选项表';

-- ----------------------------
-- Records of tp_qyvote_option_2
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyvote_option_3`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote_option_3`;
CREATE TABLE `tp_qyvote_option_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `vote_id` int(10) NOT NULL COMMENT '与qyvote表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `vote_number` int(11) NOT NULL COMMENT '该选项投票人数',
  `option_imgurl` varchar(255) NOT NULL COMMENT '该选项图片',
  `option_info` varchar(255) DEFAULT NULL COMMENT '该选项文字说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='投票多图对比选项表';

-- ----------------------------
-- Records of tp_qyvote_option_3
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_qyvote_option_4`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote_option_4`;
CREATE TABLE `tp_qyvote_option_4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `vote_id` int(10) NOT NULL COMMENT '与qyvote表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_title` varchar(100) NOT NULL COMMENT '选项标题',
  `vote_number` int(11) NOT NULL COMMENT '该选项投票人数',
  `option_imgurl` varchar(255) DEFAULT NULL COMMENT '该选项图片',
  `option_info` varchar(255) DEFAULT NULL COMMENT '该选项文字说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='投票赞成反对选项表';

-- ----------------------------
-- Records of tp_qyvote_option_4
-- ----------------------------
INSERT INTO `tp_qyvote_option_4` VALUES ('1', '25', '72', '1', '赞成', '1', 'http://qy.workweixin.com/TempFile/admin/image/20150109151035735.jpg', '');
INSERT INTO `tp_qyvote_option_4` VALUES ('2', '25', '72', '2', '反对', '0', 'http://qy.workweixin.com/TempFile/admin/image/20150109151035735.jpg', '');
INSERT INTO `tp_qyvote_option_4` VALUES ('3', '25', '91', '1', '赞成', '0', 'http://qy.workweixin.com/TempFile/admin/image/20150311203910643.jpg', '');
INSERT INTO `tp_qyvote_option_4` VALUES ('4', '25', '91', '2', '反对', '0', 'http://qy.workweixin.com/TempFile/admin/image/20150311203910643.jpg', '');
INSERT INTO `tp_qyvote_option_4` VALUES ('5', '25', '92', '1', '赞成', '0', 'http://qy.workweixin.com/TempFile/admin/image/20150311204043109.jpg', '');
INSERT INTO `tp_qyvote_option_4` VALUES ('6', '25', '92', '2', '反对', '0', 'http://qy.workweixin.com/TempFile/admin/image/20150311204043109.jpg', '');

-- ----------------------------
-- Table structure for `tp_qyvote_option_5`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote_option_5`;
CREATE TABLE `tp_qyvote_option_5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `vote_id` int(10) NOT NULL COMMENT '与qyvote表对应的id',
  `option_number` int(11) NOT NULL COMMENT '选项编号',
  `option_title` varchar(100) NOT NULL COMMENT '选项标题',
  `vote_number` int(11) NOT NULL COMMENT '该选项投票人数',
  `option_imgurl` varchar(255) DEFAULT NULL COMMENT '该选项图片',
  `option_info` varchar(255) DEFAULT NULL COMMENT '该选项文字说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='投票评级选项表';

-- ----------------------------
-- Records of tp_qyvote_option_5
-- ----------------------------
INSERT INTO `tp_qyvote_option_5` VALUES ('1', '25', '73', '1', '1分', '0', 'http://qy.workweixin.com/TempFile/admin/image/20150109151303179.jpg', '');
INSERT INTO `tp_qyvote_option_5` VALUES ('2', '25', '73', '2', '2分', '0', 'http://qy.workweixin.com/TempFile/admin/image/20150109151303179.jpg', '');
INSERT INTO `tp_qyvote_option_5` VALUES ('3', '25', '73', '3', '3分', '2', 'http://qy.workweixin.com/TempFile/admin/image/20150109151303179.jpg', '');
INSERT INTO `tp_qyvote_option_5` VALUES ('4', '25', '73', '4', '4分', '0', 'http://qy.workweixin.com/TempFile/admin/image/20150109151303179.jpg', '');
INSERT INTO `tp_qyvote_option_5` VALUES ('5', '25', '73', '5', '5分', '1', 'http://qy.workweixin.com/TempFile/admin/image/20150109151303179.jpg', '');

-- ----------------------------
-- Table structure for `tp_qyvote_record`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote_record`;
CREATE TABLE `tp_qyvote_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `chose` varchar(200) DEFAULT NULL,
  `zan` varchar(32) DEFAULT NULL,
  `score` varchar(100) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  `chose_t` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyvote_record
-- ----------------------------
INSERT INTO `tp_qyvote_record` VALUES ('9', '10', '1', 'wangming', null, null, '4', null, null);
INSERT INTO `tp_qyvote_record` VALUES ('10', '10', '1', 'xtzlyp', '', null, '3', null, null);
INSERT INTO `tp_qyvote_record` VALUES ('11', '11', '1', 'xtzlyp', null, null, null, null, ';测试速速来投;测试速速23飞;');
INSERT INTO `tp_qyvote_record` VALUES ('12', '7', '1', 'chenyu', null, null, null, null, ';长江;');
INSERT INTO `tp_qyvote_record` VALUES ('13', '0', '1', 'chenyu', null, null, null, null, ';');
INSERT INTO `tp_qyvote_record` VALUES ('14', '10', '1', 'chenyu', null, null, '5', null, null);
INSERT INTO `tp_qyvote_record` VALUES ('15', '7', '1', 'xtzlyp', null, null, null, null, ';长江;');
INSERT INTO `tp_qyvote_record` VALUES ('16', '8', '1', 'ding', null, null, null, null, ';多选测试;多456测试;');
INSERT INTO `tp_qyvote_record` VALUES ('17', '12', '1', 'wangming', null, '1', null, null, null);
INSERT INTO `tp_qyvote_record` VALUES ('18', '11', '1', 'wangming', null, null, null, null, ';测试速速来投;测试速速23飞;');
INSERT INTO `tp_qyvote_record` VALUES ('19', '13', '1', 'xtzlyp', null, '1', null, null, null);
INSERT INTO `tp_qyvote_record` VALUES ('20', '0', null, null, null, null, null, 'http://dexingky.wxopen.cn/TempFile/admin/image/20141120141143640.png', null);
INSERT INTO `tp_qyvote_record` VALUES ('21', '0', null, null, null, null, null, 'http://dexingky.wxopen.cn/TempFile/admin/image/20141120141143640.png', null);
INSERT INTO `tp_qyvote_record` VALUES ('22', '0', null, null, null, null, null, 'http://dexingky.wxopen.cn/TempFile/admin/image/20141120141143640.png', null);
INSERT INTO `tp_qyvote_record` VALUES ('23', null, null, 'xtzlyp', null, null, null, 'http://dexingky.wxopen.cn/TempFile/admin/image/20141120141138837.png', null);
INSERT INTO `tp_qyvote_record` VALUES ('24', null, null, 'xtzlyp', null, null, null, 'http://dexingky.wxopen.cn/TempFile/admin/image/20141120141153892.png', null);
INSERT INTO `tp_qyvote_record` VALUES ('25', '14', '1', 'xtzlyp', null, null, null, 'http://dexingky.wxopen.cn/TempFile/admin/image/20141120141153892.png', null);
INSERT INTO `tp_qyvote_record` VALUES ('26', '14', '1', 'xtzlyp', null, null, null, '', null);
INSERT INTO `tp_qyvote_record` VALUES ('27', '14', '1', 'xtzlyp', null, null, null, '', null);
INSERT INTO `tp_qyvote_record` VALUES ('28', '21', '25', 'ding', null, null, null, null, ';;分店;丰盛的;;;');
INSERT INTO `tp_qyvote_record` VALUES ('37', '0', null, 'ding', null, '2', null, null, null);
INSERT INTO `tp_qyvote_record` VALUES ('38', '22', '25', 'kai', null, '1', null, null, null);
INSERT INTO `tp_qyvote_record` VALUES ('39', '21', '25', 'xtzlyp', null, null, null, null, ';;分店;丰盛的;;;');
INSERT INTO `tp_qyvote_record` VALUES ('40', '21', '25', 'lanrain', null, null, null, null, ';地方;;丰盛的;;;');
INSERT INTO `tp_qyvote_record` VALUES ('43', '15', '25', 'xtzlyp', '多选测试', null, null, null, null);
INSERT INTO `tp_qyvote_record` VALUES ('44', '22', '25', 'xtzlyp', null, '1', null, null, null);
INSERT INTO `tp_qyvote_record` VALUES ('45', '23', '25', 'kai', null, null, '5', null, null);
INSERT INTO `tp_qyvote_record` VALUES ('46', '23', '25', 'lanrain', null, null, '4', null, null);
INSERT INTO `tp_qyvote_record` VALUES ('48', '24', '25', 'xtzlyp', null, null, null, 'http://dexingky.wxopen.cn/TempFile/admin/image/20141123191025425.png', null);
INSERT INTO `tp_qyvote_record` VALUES ('51', '23', '25', 'xtzlyp', null, null, '4', null, null);
INSERT INTO `tp_qyvote_record` VALUES ('52', '23', '25', 'wangming', null, null, '4', null, null);
INSERT INTO `tp_qyvote_record` VALUES ('53', '22', '25', 'lanrain', null, '2', null, null, null);
INSERT INTO `tp_qyvote_record` VALUES ('54', '40', '99', 'Y0193', null, null, null, null, ';1;1;');
INSERT INTO `tp_qyvote_record` VALUES ('55', '15', '25', 'lanrain', '345345', null, null, null, null);
INSERT INTO `tp_qyvote_record` VALUES ('58', '41', '25', 'xtzlyp', null, null, null, null, ';好事;坏事;;');
INSERT INTO `tp_qyvote_record` VALUES ('59', '70', '25', 'ding', null, null, null, null, ';;;;;;');
INSERT INTO `tp_qyvote_record` VALUES ('60', '73', '25', 'ding', null, null, '3', null, null);

-- ----------------------------
-- Table structure for `tp_qyvote_record_1`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote_record_1`;
CREATE TABLE `tp_qyvote_record_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `chose` varchar(200) DEFAULT NULL,
  `zan` varchar(32) DEFAULT NULL,
  `score` varchar(100) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  `chose_t` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyvote_record_1
-- ----------------------------
INSERT INTO `tp_qyvote_record_1` VALUES ('1', '71', '25', 'ding', '1', null, null, null, null);
INSERT INTO `tp_qyvote_record_1` VALUES ('2', '87', '25', 'ding', '2', null, null, null, null);
INSERT INTO `tp_qyvote_record_1` VALUES ('3', '87', '25', 'xiangshenghong', '1', null, null, null, null);

-- ----------------------------
-- Table structure for `tp_qyvote_record_2`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote_record_2`;
CREATE TABLE `tp_qyvote_record_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `chose` varchar(200) DEFAULT NULL,
  `zan` varchar(32) DEFAULT NULL,
  `score` varchar(100) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  `chose_t` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyvote_record_2
-- ----------------------------
INSERT INTO `tp_qyvote_record_2` VALUES ('1', '70', '25', 'ding', '', null, null, null, '3|4|');
INSERT INTO `tp_qyvote_record_2` VALUES ('2', '93', '25', 'li_jun_6', null, null, null, null, '3|2|1|');
INSERT INTO `tp_qyvote_record_2` VALUES ('3', '93', '25', '77484824865', null, null, null, null, '1|2|');
INSERT INTO `tp_qyvote_record_2` VALUES ('4', '93', '25', 'an', null, null, null, null, '1|3|2|');
INSERT INTO `tp_qyvote_record_2` VALUES ('5', '93', '25', 'idodo_2009', null, null, null, null, '1|');
INSERT INTO `tp_qyvote_record_2` VALUES ('6', '96', '25', '270636852', null, null, null, null, '1|2|6|7|');

-- ----------------------------
-- Table structure for `tp_qyvote_record_3`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote_record_3`;
CREATE TABLE `tp_qyvote_record_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `chose` varchar(200) DEFAULT NULL,
  `zan` varchar(32) DEFAULT NULL,
  `score` varchar(100) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  `chose_t` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyvote_record_3
-- ----------------------------
INSERT INTO `tp_qyvote_record_3` VALUES ('1', '77', '25', 'ding', null, null, null, 'http://qy.workweixin.com/TempFile/admin/image/20150109162646650.jpg', null);

-- ----------------------------
-- Table structure for `tp_qyvote_record_4`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote_record_4`;
CREATE TABLE `tp_qyvote_record_4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `chose` varchar(200) DEFAULT NULL,
  `zan` varchar(32) DEFAULT NULL,
  `score` varchar(100) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  `chose_t` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyvote_record_4
-- ----------------------------
INSERT INTO `tp_qyvote_record_4` VALUES ('2', '72', '25', 'ding', null, '1', null, null, null);

-- ----------------------------
-- Table structure for `tp_qyvote_record_5`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyvote_record_5`;
CREATE TABLE `tp_qyvote_record_5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `chose` varchar(200) DEFAULT NULL,
  `zan` varchar(32) DEFAULT NULL,
  `score` varchar(100) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  `chose_t` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyvote_record_5
-- ----------------------------
INSERT INTO `tp_qyvote_record_5` VALUES ('2', '73', '25', 'ding', null, null, '3', null, null);
INSERT INTO `tp_qyvote_record_5` VALUES ('3', '73', '25', '270636852', null, null, '3', null, null);
INSERT INTO `tp_qyvote_record_5` VALUES ('4', '73', '25', '0033', null, null, '5', null, null);

-- ----------------------------
-- Table structure for `tp_qywage`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qywage`;
CREATE TABLE `tp_qywage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '工作表id',
  `users_id` int(11) unsigned NOT NULL COMMENT '员工表id',
  `post_wage` int(10) unsigned DEFAULT NULL COMMENT '岗位工资',
  `merit_pay` int(11) DEFAULT NULL COMMENT '绩效工资',
  `seniority_pay` int(11) DEFAULT NULL COMMENT '工龄工资',
  `travel_subsidy` int(11) DEFAULT NULL COMMENT '交通补贴',
  `communication_subsidy` int(11) DEFAULT NULL COMMENT '通信补贴',
  `lunch_subsidy` int(11) DEFAULT NULL COMMENT '中餐补贴',
  `bonus` int(11) DEFAULT NULL COMMENT '奖金',
  `overtime_wage` int(11) DEFAULT NULL COMMENT '加班工资',
  `push_money` int(11) DEFAULT NULL COMMENT '提成',
  `welfare` int(11) DEFAULT NULL COMMENT '福利',
  `else_subsidy` int(11) DEFAULT NULL COMMENT '其他补贴',
  `checking-in_deduct` int(11) DEFAULT NULL COMMENT '考勤扣去',
  `social_security_deduct` int(11) DEFAULT NULL COMMENT '社保扣除',
  `else_deduct` int(11) DEFAULT NULL COMMENT '其他扣去',
  `total` int(11) DEFAULT NULL COMMENT '合计',
  `firm_id` int(11) DEFAULT NULL COMMENT '企业id',
  `add_time` time DEFAULT NULL COMMENT '添加时间',
  `update_time` time DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qywage
-- ----------------------------
INSERT INTO `tp_qywage` VALUES ('1', '0', '111', '111', '11', '11', null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `tp_qywage` VALUES ('2', '186', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '10', '227', '838:59:59', '00:20:15');
INSERT INTO `tp_qywage` VALUES ('3', '186', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '10', '227', '00:20:15', '00:20:15');
INSERT INTO `tp_qywage` VALUES ('4', '113', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '10', '227', '00:20:15', null);
INSERT INTO `tp_qywage` VALUES ('5', '151', '111', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '10', '227', '00:20:15', null);
INSERT INTO `tp_qywage` VALUES ('6', '192', '23123', '23123', '123', '123123', '123', '123', '123', '123', '123', '1231', '12312', '123', '123', '12', '1000', '227', '00:20:15', null);
INSERT INTO `tp_qywage` VALUES ('7', '227', '10', '20', '20', '20', '202', '2', '2', '2', '2', '2', '2', '2', '2', '20', '308', '25', '00:20:15', null);

-- ----------------------------
-- Table structure for `tp_qywebsite`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qywebsite`;
CREATE TABLE `tp_qywebsite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(3) DEFAULT '0',
  `site_logo` varchar(80) DEFAULT '',
  `site_name` varchar(50) DEFAULT NULL,
  `site_title` varchar(80) DEFAULT NULL,
  `site_url` varchar(80) DEFAULT NULL,
  `site_my` varchar(50) DEFAULT NULL,
  `ischeckuser` int(1) DEFAULT NULL,
  `ipc` varchar(50) DEFAULT NULL,
  `site_qq` varchar(15) DEFAULT NULL,
  `baidu_map_api` varchar(50) DEFAULT NULL,
  `site_email` varchar(50) DEFAULT NULL,
  `keyword` varchar(50) DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  `copyright` varchar(200) DEFAULT NULL,
  `site_gg` varchar(200) DEFAULT NULL,
  `day` varchar(16) DEFAULT '0' COMMENT '免费试用天数',
  `site_tel` varchar(16) DEFAULT NULL,
  `site_ipc` varchar(200) DEFAULT NULL,
  `site_ewm` varchar(300) NOT NULL DEFAULT '1',
  `address` varchar(300) DEFAULT NULL,
  `tpl` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qywebsite
-- ----------------------------
INSERT INTO `tp_qywebsite` VALUES ('32', '1', 'http://qy.wxopen.cn/Tpl/Qyapp/Static/Css/logo.png', '111', '111', 'qy.workweixin.com', null, null, '11222', '11', '11', '11', '111', '111', '111', null, '0', '11', null, '1', '11', 'Weiyi');

-- ----------------------------
-- Table structure for `tp_qywebsite_link`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qywebsite_link`;
CREATE TABLE `tp_qywebsite_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `key` varchar(64) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `agency_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qywebsite_link
-- ----------------------------
INSERT INTO `tp_qywebsite_link` VALUES ('3', null, '22', '222', '1', '1');
INSERT INTO `tp_qywebsite_link` VALUES ('4', null, '333', '333', '1', '18');
INSERT INTO `tp_qywebsite_link` VALUES ('5', null, '3242', '234234', '1', '18');
INSERT INTO `tp_qywebsite_link` VALUES ('6', null, '777', '777', '1', '18');
INSERT INTO `tp_qywebsite_link` VALUES ('7', null, '77788', '8888', '0', '1');
INSERT INTO `tp_qywebsite_link` VALUES ('8', null, '444', '444455', '1', '18');

-- ----------------------------
-- Table structure for `tp_qyworkflow`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyworkflow`;
CREATE TABLE `tp_qyworkflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `qq` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `department` varchar(200) DEFAULT NULL COMMENT '流程范围',
  `name_defined` text COMMENT '自定义字段',
  `examine` text COMMENT '审核人',
  `time` varchar(16) DEFAULT NULL,
  `examine_conf` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyworkflow
-- ----------------------------
INSERT INTO `tp_qyworkflow` VALUES ('56', '25', '审批', '', '1', '1743', 'a:4:{i:0;a:4:{s:4:\"name\";s:6:\"名称\";s:4:\"type\";s:1:\"1\";s:6:\"status\";s:2:\"on\";s:4:\"info\";s:0:\"\";}i:1;a:4:{s:4:\"name\";s:6:\"日期\";s:4:\"type\";s:1:\"3\";s:6:\"status\";s:2:\"on\";s:4:\"info\";s:0:\"\";}i:2;a:4:{s:4:\"name\";s:6:\"图片\";s:4:\"type\";s:1:\"7\";s:6:\"status\";s:2:\"on\";s:4:\"info\";s:0:\"\";}i:3;a:4:{s:4:\"name\";s:6:\"说明\";s:4:\"type\";s:1:\"6\";s:6:\"status\";s:2:\"on\";s:4:\"info\";s:0:\"\";}}', 'a:1:{i:0;a:2:{s:9:\"auditname\";s:1:\"3\";s:11:\"auditselect\";s:6:\"xiaoan\";}}', '1447066881', null);

-- ----------------------------
-- Table structure for `tp_qyworkflow_user`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyworkflow_user`;
CREATE TABLE `tp_qyworkflow_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `name_defined` text COMMENT '自定义字段',
  `exam_status` tinyint(4) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `next_wecha_id` varchar(100) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL,
  `next_num` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyworkflow_user
-- ----------------------------
INSERT INTO `tp_qyworkflow_user` VALUES ('43', '1', null, 'a:2:{s:7:\"field_1\";a:2:{s:3:\"val\";s:6:\"图谋\";s:4:\"name\";s:5:\"24234\";}s:7:\"field_2\";a:2:{s:3:\"val\";s:9:\"啊恶露\";s:4:\"name\";s:5:\"34234\";}}', null, '8', 'xtzlyp', '1', 'werw', '1415516165', 'a:2:{i:0;s:7:\"xtzlyp2\";i:1;s:4:\"werw\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('44', '1', null, 'a:3:{s:7:\"field_1\";a:1:{s:3:\"val\";s:9:\"0:00-1:00\";}s:7:\"field_3\";a:2:{s:3:\"val\";s:6:\"莫子\";s:4:\"name\";s:6:\"第三\";}s:7:\"field_4\";a:2:{s:3:\"val\";s:9:\"2014-11-9\";s:4:\"name\";s:8:\"此次c \";}}', null, '9', 'xtzlyp', '1', 'xtzlyp2', '1415520947', 'a:2:{i:0;s:7:\"xtzlyp2\";i:1;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('45', '1', null, 'a:3:{s:7:\"field_1\";a:1:{s:3:\"val\";s:9:\"0:00-1:00\";}s:7:\"field_3\";a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:6:\"第三\";}s:7:\"field_4\";a:2:{s:3:\"val\";s:10:\"2015-01-12\";s:4:\"name\";s:8:\"此次c \";}}', null, '9', 'xtzlyp', '1', 'xtzlyp2', '1415525746', 'a:2:{i:0;s:7:\"xtzlyp2\";i:1;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('46', '1', null, 'a:2:{s:7:\"field_1\";a:2:{s:3:\"val\";s:9:\"安吐了\";s:4:\"name\";s:12:\"萨芬萨芬\";}s:7:\"field_2\";a:2:{s:3:\"val\";s:12:\"哦哦了额\";s:4:\"name\";s:12:\"士大夫撒\";}}', null, '10', 'xtzlyp', '2', 'wangming', '1415607208', 'a:2:{i:0;s:8:\"wangming\";i:1;s:8:\"wangming\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('47', '26', null, 'a:5:{i:0;a:2:{s:3:\"val\";s:33:\"家具家电维修费的感觉到\";s:4:\"name\";s:1:\"1\";}i:1;a:2:{s:3:\"val\";s:24:\"阿肯吐出来玩吧？\";s:4:\"name\";s:1:\"2\";}i:2;a:2:{s:3:\"val\";s:10:\"2014-11-23\";s:4:\"name\";s:1:\"3\";}i:3;a:1:{s:3:\"val\";s:9:\"0:00-1:00\";}i:4;a:2:{s:3:\"val\";s:15:\"了考虑陌陌\";s:4:\"name\";s:1:\"5\";}}', null, '26', 'fly316', '1', null, '1416558378', 'a:2:{i:0;a:2:{s:9:\"auditname\";i:1;s:11:\"auditselect\";s:12:\"直接上级\";}i:1;a:2:{s:9:\"auditname\";s:1:\"3\";s:11:\"auditselect\";s:0:\"\";}}');
INSERT INTO `tp_qyworkflow_user` VALUES ('48', '25', null, 'a:4:{i:0;a:2:{s:3:\"val\";s:6:\"我去\";s:4:\"name\";s:12:\"报名参加\";}i:1;a:2:{s:3:\"val\";s:6:\"弟弟\";s:4:\"name\";s:12:\"领取报表\";}i:2;a:1:{s:3:\"val\";s:11:\"17:00-18:00\";}i:4;a:2:{s:3:\"val\";s:6:\"哦看\";s:4:\"name\";s:12:\"申请成功\";}}', null, '27', 'ding', '1', null, '1416564167', 'a:4:{i:0;a:2:{s:9:\"auditname\";i:1;s:11:\"auditselect\";s:12:\"直接上级\";}i:1;a:2:{s:9:\"auditname\";s:1:\"3\";s:11:\"auditselect\";s:9:\"赵组长\";}i:2;a:2:{s:9:\"auditname\";s:1:\"3\";s:11:\"auditselect\";s:9:\"钱主管\";}i:3;a:2:');
INSERT INTO `tp_qyworkflow_user` VALUES ('49', '25', null, 'a:4:{i:0;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:12:\"报名参加\";}i:1;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:12:\"领取报表\";}i:2;a:1:{s:3:\"val\";s:9:\"0:00-1:00\";}i:4;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:12:\"申请成功\";}}', null, '27', 'ding', '1', null, '1416566850', 'a:4:{i:0;a:2:{s:9:\"auditname\";i:1;s:11:\"auditselect\";s:12:\"直接上级\";}i:1;a:2:{s:9:\"auditname\";s:1:\"3\";s:11:\"auditselect\";s:9:\"赵组长\";}i:2;a:2:{s:9:\"auditname\";s:1:\"3\";s:11:\"auditselect\";s:9:\"钱主管\";}i:3;a:2:');
INSERT INTO `tp_qyworkflow_user` VALUES ('57', '25', null, 'a:6:{i:0;a:2:{s:3:\"val\";s:15:\"啊贷款利率\";s:4:\"name\";s:6:\"名字\";}i:1;a:2:{s:3:\"val\";s:9:\"155467662\";s:4:\"name\";s:12:\"电话号码\";}i:2;a:2:{s:3:\"val\";s:10:\"2014-09-23\";s:4:\"name\";s:6:\"日期\";}i:3;a:2:{s:3:\"val\";s:15:\"咯巨魔考虑\";s:4:\"name\";s:12:\"多行文本\";}i:4;a:1:{s:3:\"val\";s:12:\"第一选择\";}i:5;a:1:{s:3:\"val\";s:9:\"0:00-1:00\";}}', null, '29', 'kai', '2', '0', '1416727509', 'a:2:{i:0;s:3:\"kai\";i:1;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('58', '25', '流程测试', 'a:6:{i:0;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:6:\"名字\";}i:1;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:12:\"电话号码\";}i:2;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:6:\"日期\";}i:3;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:12:\"多行文本\";}i:4;a:2:{s:3:\"val\";s:12:\"第二选择\";s:4:\"name\";s:12:\"下拉菜单\";}i:5;a:2:{s:3:\"val\";s:9:\"0:00-1:00\";s:4:\"name\";s:6:\"时间\";}}', null, '29', 'xtzlyp', '2', '0', '1417330759', 'a:3:{i:0;s:7:\"xtzlyp2\";i:1;s:3:\"kai\";i:2;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('59', '25', '流程测试', 'a:6:{i:0;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:6:\"名字\";}i:1;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:12:\"电话号码\";}i:2;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:6:\"日期\";}i:3;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:12:\"多行文本\";}i:4;a:2:{s:3:\"val\";s:12:\"第二选择\";s:4:\"name\";s:12:\"下拉菜单\";}i:5;a:2:{s:3:\"val\";s:11:\"17:00-18:00\";s:4:\"name\";s:6:\"时间\";}}', null, '29', 'lanrain', '1', 'xtzlyp', '1417344780', 'a:2:{i:0;s:3:\"kai\";i:1;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('60', '25', '流程测试', 'a:6:{i:0;a:2:{s:3:\"val\";s:6:\"你好\";s:4:\"name\";s:6:\"名字\";}i:1;a:2:{s:3:\"val\";s:11:\"15549156325\";s:4:\"name\";s:12:\"电话号码\";}i:2;a:2:{s:3:\"val\";s:10:\"2015-01-04\";s:4:\"name\";s:6:\"日期\";}i:3;a:2:{s:3:\"val\";s:18:\"刻录机了具体\";s:4:\"name\";s:12:\"多行文本\";}i:4;a:2:{s:3:\"val\";s:12:\"第一选择\";s:4:\"name\";s:12:\"下拉菜单\";}i:5;a:2:{s:3:\"val\";s:9:\"0:00-1:00\";s:4:\"name\";s:6:\"时间\";}}', null, '29', 'xtzlyp', '2', '0', '1420342207', 'a:3:{i:0;s:7:\"xtzlyp2\";i:1;s:3:\"kai\";i:2;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('61', '25', '流程测试', 'a:6:{i:0;a:2:{s:3:\"val\";s:6:\"你好\";s:4:\"name\";s:6:\"名字\";}i:1;a:2:{s:3:\"val\";s:10:\"1255744414\";s:4:\"name\";s:12:\"电话号码\";}i:2;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:6:\"日期\";}i:3;a:2:{s:3:\"val\";s:12:\"234234234234\";s:4:\"name\";s:12:\"多行文本\";}i:4;a:2:{s:3:\"val\";s:12:\"第一选择\";s:4:\"name\";s:12:\"下拉菜单\";}i:5;a:2:{s:3:\"val\";s:9:\"4:00-5:00\";s:4:\"name\";s:6:\"时间\";}}', null, '29', 'xtzlyp', '1', 'xtzlyp', '1420514150', 'a:3:{i:0;s:7:\"xtzlyp2\";i:1;s:3:\"kai\";i:2;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('62', '25', '工作流程', 'a:2:{i:0;a:2:{s:3:\"val\";s:10:\"额额的v\";s:4:\"name\";s:4:\"3534\";}i:1;a:2:{s:3:\"val\";s:6:\"你好\";s:4:\"name\";s:6:\"你好\";}}', null, '35', 'ding', '1', 'xtzlyp', '1421321242', 'a:2:{i:0;s:6:\"xtzlyp\";i:1;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('63', '25', '42342', 'a:1:{i:0;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:6:\"234234\";}}', null, '34', 'ding', '1', 'xtzlyp', '1421321312', 'a:1:{i:0;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('64', '25', '3345345', 'a:1:{i:0;a:2:{s:3:\"val\";s:2:\"11\";s:4:\"name\";s:6:\"243424\";}}', null, '33', 'ding', '1', 'xtzlyp', '1421321368', 'a:1:{i:0;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('65', '25', '3345345', 'a:1:{i:0;a:2:{s:3:\"val\";s:2:\"12\";s:4:\"name\";s:6:\"243424\";}}', null, '33', 'ding', '1', 'xtzlyp', '1421321585', 'a:1:{i:0;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('66', '25', 'M.C流程审批测试', 'a:6:{i:0;a:2:{s:3:\"val\";s:3:\"825\";s:4:\"name\";s:4:\"M.C1\";}i:1;a:2:{s:3:\"val\";s:3:\"855\";s:4:\"name\";s:4:\"M.C2\";}i:2;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:4:\"M.C3\";}i:3;a:2:{s:3:\"val\";s:9:\"3:00-4:00\";s:4:\"name\";s:4:\"M.C4\";}i:4;a:2:{s:3:\"val\";s:4:\"4527\";s:4:\"name\";s:4:\"M.C5\";}i:5;a:2:{s:3:\"val\";s:1:\"6\";s:4:\"name\";s:4:\"M.C6\";}}', null, '30', 'ding', '1', 'xtzlyp', '1421321660', 'a:1:{i:0;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('67', '25', '流程测试', 'a:6:{i:0;a:2:{s:3:\"val\";s:4:\"etbt\";s:4:\"name\";s:6:\"名字\";}i:1;a:2:{s:3:\"val\";s:11:\"15369523614\";s:4:\"name\";s:12:\"电话号码\";}i:2;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:6:\"日期\";}i:3;a:2:{s:3:\"val\";s:4:\"4582\";s:4:\"name\";s:12:\"多行文本\";}i:4;a:2:{s:3:\"val\";s:12:\"第一选择\";s:4:\"name\";s:12:\"下拉菜单\";}i:5;a:2:{s:3:\"val\";s:9:\"7:00-8:00\";s:4:\"name\";s:6:\"时间\";}}', null, '29', 'ding', '1', 'xtzlyp', '1421321749', 'a:3:{i:0;s:6:\"xtzlyp\";i:1;s:3:\"kai\";i:2;s:6:\"xtzlyp\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('68', '25', '大婶刚刚好', 'a:3:{i:0;a:2:{s:3:\"val\";s:15:\"亟待解决的\";s:4:\"name\";s:9:\"计价格\";}i:1;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:9:\"好几科\";}i:2;a:2:{s:3:\"val\";s:9:\"8:00-9:00\";s:4:\"name\";s:9:\"回家了\";}}', null, '42', '270636852', '1', 'lokjl', '1422166275', 'a:3:{i:0;N;i:1;s:3:\"hgj\";i:2;s:5:\"lokjl\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('69', '25', '大婶刚刚好', 'a:3:{i:0;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:9:\"计价格\";}i:1;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:9:\"好几科\";}i:2;a:2:{s:3:\"val\";s:9:\"0:00-1:00\";s:4:\"name\";s:9:\"回家了\";}}', null, '42', '270636852', '1', 'lokjl', '1422167085', 'a:3:{i:0;N;i:1;s:3:\"hgj\";i:2;s:5:\"lokjl\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('70', '25', '大法官', 'a:1:{i:0;a:2:{s:3:\"val\";s:9:\"大塞佛\";s:4:\"name\";s:9:\"大塞弗\";}}', null, '41', '270636852', '1', 'gf', '1422171724', 'a:3:{i:0;s:0:\"\";i:1;s:4:\"dfvs\";i:2;s:2:\"gf\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('71', '25', '大法官', 'a:1:{i:0;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:9:\"大塞弗\";}}', null, '41', '270636852', '1', 'gf', '1422172799', 'a:3:{i:0;s:0:\"\";i:1;s:4:\"dfvs\";i:2;s:2:\"gf\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('72', '25', '大婶刚刚好', 'a:3:{i:0;a:2:{s:3:\"val\";s:12:\"可真心很\";s:4:\"name\";s:9:\"计价格\";}i:1;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:9:\"好几科\";}i:2;a:2:{s:3:\"val\";s:9:\"3:00-4:00\";s:4:\"name\";s:9:\"回家了\";}}', null, '42', '270636852', '1', 'lokjl', '1422172882', 'a:3:{i:0;N;i:1;s:3:\"hgj\";i:2;s:5:\"lokjl\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('73', '25', '大婶刚刚好', 'a:3:{i:0;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:9:\"计价格\";}i:1;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:9:\"好几科\";}i:2;a:2:{s:3:\"val\";s:9:\"0:00-1:00\";s:4:\"name\";s:9:\"回家了\";}}', null, '42', '270636852', '1', 'lokjl', '1423103171', 'a:3:{i:0;N;i:1;s:3:\"hgj\";i:2;s:5:\"lokjl\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('74', '25', 'eee', 'a:6:{i:0;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:3:\"aaa\";}i:1;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:3:\"bbb\";}i:2;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:3:\"ccc\";}i:3;a:2:{s:3:\"val\";s:9:\"0:00-1:00\";s:4:\"name\";s:3:\"ddd\";}i:4;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:3:\"eee\";}i:5;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:3:\"fff\";}}', null, '47', 'ding', '1', 'lanrain(陈雨)', '1423733093', 'a:3:{i:0;N;i:1;s:14:\"xtzlyp(xtzlyp)\";i:2;s:15:\"lanrain(陈雨)\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('75', '25', 'eee', 'a:6:{i:0;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:3:\"aaa\";}i:1;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:3:\"bbb\";}i:2;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:3:\"ccc\";}i:3;a:2:{s:3:\"val\";s:9:\"0:00-1:00\";s:4:\"name\";s:3:\"ddd\";}i:4;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:3:\"eee\";}i:5;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:3:\"fff\";}}', null, '47', 'ding', '1', 'lanrain(陈雨)', '1423733182', 'a:3:{i:0;N;i:1;s:14:\"xtzlyp(xtzlyp)\";i:2;s:15:\"lanrain(陈雨)\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('76', '25', 'rrr', 'a:6:{i:0;a:2:{s:3:\"val\";s:6:\"哈哈\";s:4:\"name\";s:3:\"aaa\";}i:1;a:2:{s:3:\"val\";s:6:\"哈哈\";s:4:\"name\";s:3:\"bbb\";}i:2;a:2:{s:3:\"val\";s:10:\"2015-03-30\";s:4:\"name\";s:3:\"ccc\";}i:3;a:2:{s:3:\"val\";s:9:\"8:00-9:00\";s:4:\"name\";s:3:\"ddd\";}i:4;a:2:{s:3:\"val\";s:6:\"估计\";s:4:\"name\";s:3:\"eee\";}i:5;a:2:{s:3:\"val\";s:3:\"nnn\";s:4:\"name\";s:3:\"fff\";}}', null, '48', '0033', '1', 'xtzlyp(xtzlyp)', '1427685551', 'a:2:{i:0;N;i:1;s:14:\"xtzlyp(xtzlyp)\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('77', '25', '大法官', 'a:1:{i:0;a:2:{s:3:\"val\";s:18:\"给督促个很好\";s:4:\"name\";s:9:\"大塞弗\";}}', null, '41', '270636852', '1', 'gf', '1427702866', 'a:3:{i:0;s:0:\"\";i:1;s:4:\"dfvs\";i:2;s:2:\"gf\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('78', '25', 'rrr', 'a:6:{i:0;a:2:{s:3:\"val\";s:3:\"头\";s:4:\"name\";s:3:\"aaa\";}i:1;a:2:{s:3:\"val\";s:6:\"看看\";s:4:\"name\";s:3:\"bbb\";}i:2;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:3:\"ccc\";}i:3;a:2:{s:3:\"val\";s:9:\"7:00-8:00\";s:4:\"name\";s:3:\"ddd\";}i:4;a:2:{s:3:\"val\";s:9:\"图无图\";s:4:\"name\";s:3:\"eee\";}i:5;a:2:{s:3:\"val\";s:3:\"nnn\";s:4:\"name\";s:3:\"fff\";}}', null, '48', '0033', '1', 'xtzlyp(xtzlyp)', '1427877397', 'a:2:{i:0;N;i:1;s:14:\"xtzlyp(xtzlyp)\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('79', '25', 'eee', 'a:6:{i:0;a:2:{s:3:\"val\";s:9:\"同法国\";s:4:\"name\";s:3:\"aaa\";}i:1;a:2:{s:3:\"val\";s:9:\"的地方\";s:4:\"name\";s:3:\"bbb\";}i:2;a:2:{s:3:\"val\";s:10:\"2015-04-13\";s:4:\"name\";s:3:\"ccc\";}i:3;a:2:{s:3:\"val\";s:9:\"0:00-1:00\";s:4:\"name\";s:3:\"ddd\";}i:4;a:2:{s:3:\"val\";s:0:\"\";s:4:\"name\";s:3:\"eee\";}i:5;a:2:{s:3:\"val\";s:12:\"的 v 规定\";s:4:\"name\";s:3:\"fff\";}}', null, '47', '270636852', '1', 'lanrain(陈雨)', '1428889413', 'a:3:{i:0;N;i:1;s:14:\"xtzlyp(xtzlyp)\";i:2;s:15:\"lanrain(陈雨)\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('80', '25', 'rrr', 'a:6:{i:0;a:2:{s:3:\"val\";s:3:\"aaa\";s:4:\"name\";s:3:\"aaa\";}i:1;a:2:{s:3:\"val\";s:3:\"bbb\";s:4:\"name\";s:3:\"bbb\";}i:2;a:2:{s:3:\"val\";s:10:\"2015-04-13\";s:4:\"name\";s:3:\"ccc\";}i:3;a:2:{s:3:\"val\";s:9:\"0:00-1:00\";s:4:\"name\";s:3:\"ddd\";}i:4;a:2:{s:3:\"val\";s:8:\"dasdadad\";s:4:\"name\";s:3:\"eee\";}i:5;a:2:{s:3:\"val\";s:3:\"nnn\";s:4:\"name\";s:3:\"fff\";}}', null, '48', '270636852', '1', 'xtzlyp(xtzlyp)', '1428892665', 'a:2:{i:0;N;i:1;s:14:\"xtzlyp(xtzlyp)\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('81', '25', 'rrr', 'a:6:{i:0;a:2:{s:3:\"val\";s:9:\"a a a\";s:4:\"name\";s:3:\"aaa\";}i:1;a:2:{s:3:\"val\";s:9:\"b b b\";s:4:\"name\";s:3:\"bbb\";}i:2;a:2:{s:3:\"val\";s:10:\"2015-04-13\";s:4:\"name\";s:3:\"ccc\";}i:3;a:2:{s:3:\"val\";s:9:\"0:00-1:00\";s:4:\"name\";s:3:\"ddd\";}i:4;a:2:{s:3:\"val\";s:30:\"还是誓师大会大好河山\";s:4:\"name\";s:3:\"eee\";}i:5;a:2:{s:3:\"val\";s:3:\"nnn\";s:4:\"name\";s:3:\"fff\";}}', null, '48', '270636852', '1', '270636852(黎先生)', '1428894555', 'a:2:{i:0;N;i:1;s:20:\"270636852(黎先生)\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('82', '25', 'rrr', 'a:6:{i:0;a:2:{s:3:\"val\";s:6:\"本来\";s:4:\"name\";s:3:\"aaa\";}i:1;a:2:{s:3:\"val\";s:12:\"本来就是\";s:4:\"name\";s:3:\"bbb\";}i:2;a:2:{s:3:\"val\";s:10:\"2015-04-14\";s:4:\"name\";s:3:\"ccc\";}i:3;a:2:{s:3:\"val\";s:9:\"5:00-6:00\";s:4:\"name\";s:3:\"ddd\";}i:4;a:2:{s:3:\"val\";s:9:\"苯甲酸\";s:4:\"name\";s:3:\"eee\";}i:5;a:2:{s:3:\"val\";s:3:\"mmm\";s:4:\"name\";s:3:\"fff\";}}', null, '48', 'li_jun_6', '1', '270636852(黎先生)', '1428995550', 'a:2:{i:0;N;i:1;s:20:\"270636852(黎先生)\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('83', '25', 'rrr', 'a:6:{i:0;a:2:{s:3:\"val\";s:12:\"爱情公寓\";s:4:\"name\";s:3:\"aaa\";}i:1;a:2:{s:3:\"val\";s:6:\"十年\";s:4:\"name\";s:3:\"bbb\";}i:2;a:2:{s:3:\"val\";s:10:\"2015-04-17\";s:4:\"name\";s:3:\"ccc\";}i:3;a:2:{s:3:\"val\";s:9:\"6:00-7:00\";s:4:\"name\";s:3:\"ddd\";}i:4;a:2:{s:3:\"val\";s:8:\"昂上YY\";s:4:\"name\";s:3:\"eee\";}i:5;a:2:{s:3:\"val\";s:3:\"mmm\";s:4:\"name\";s:3:\"fff\";}}', null, '48', 'li_jun_6', '1', '270636852(黎先生)', '1429237768', 'a:2:{i:0;N;i:1;s:20:\"270636852(黎先生)\";}');
INSERT INTO `tp_qyworkflow_user` VALUES ('84', '25', '23423423', 'a:1:{i:0;a:2:{s:3:\"val\";s:5:\"dgjkm\";s:4:\"name\";s:7:\"2342342\";}}', null, '55', '0033', '1', null, '1429523554', 'a:1:{i:0;N;}');

-- ----------------------------
-- Table structure for `tp_qyworkflow_witer`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyworkflow_witer`;
CREATE TABLE `tp_qyworkflow_witer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `wecha_id` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `form_wecha_id` varchar(100) DEFAULT NULL COMMENT '需要审核人的id',
  `module` varchar(32) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyworkflow_witer
-- ----------------------------
INSERT INTO `tp_qyworkflow_witer` VALUES ('41', '1', '43', 'xtzlyp', '0', 'xtzlyp2', 'Workflow', null);
INSERT INTO `tp_qyworkflow_witer` VALUES ('42', '1', '43', 'xtzlyp', '0', 'werw', 'Workflow', null);
INSERT INTO `tp_qyworkflow_witer` VALUES ('43', '1', '44', 'xtzlyp', '0', 'xtzlyp2', 'Workflow', null);
INSERT INTO `tp_qyworkflow_witer` VALUES ('44', '1', '44', 'xtzlyp', '0', 'xtzlyp', 'Workflow', null);
INSERT INTO `tp_qyworkflow_witer` VALUES ('45', '1', '45', 'xtzlyp', '0', 'xtzlyp2', 'Workflow', null);
INSERT INTO `tp_qyworkflow_witer` VALUES ('46', '1', '45', 'xtzlyp', '0', 'xtzlyp', 'Workflow', null);
INSERT INTO `tp_qyworkflow_witer` VALUES ('47', '1', '46', 'xtzlyp', '1', 'wangming', 'Workflow', null);
INSERT INTO `tp_qyworkflow_witer` VALUES ('48', '1', '46', 'xtzlyp', '1', 'wangming', 'Workflow', null);
INSERT INTO `tp_qyworkflow_witer` VALUES ('80', '25', '57', 'kai', '1', 'kai', 'Workflow', null);
INSERT INTO `tp_qyworkflow_witer` VALUES ('81', '25', '57', 'kai', '1', 'xtzlyp', 'Workflow', null);
INSERT INTO `tp_qyworkflow_witer` VALUES ('82', '25', '58', 'xtzlyp', '0', 'xtzlyp2', 'Workflow', '1417330759');
INSERT INTO `tp_qyworkflow_witer` VALUES ('83', '25', '58', 'xtzlyp', '0', 'kai', 'Workflow', '1417330759');
INSERT INTO `tp_qyworkflow_witer` VALUES ('84', '25', '58', 'xtzlyp', '1', 'xtzlyp', 'Workflow', '1417330759');
INSERT INTO `tp_qyworkflow_witer` VALUES ('85', '25', '59', 'lanrain', '0', 'kai', 'Workflow', '1417344780');
INSERT INTO `tp_qyworkflow_witer` VALUES ('86', '25', '59', 'lanrain', '2', 'xtzlyp', 'Workflow', '1417344780');
INSERT INTO `tp_qyworkflow_witer` VALUES ('87', '25', '60', 'xtzlyp', '0', 'xtzlyp2', 'Workflow', '1420342207');
INSERT INTO `tp_qyworkflow_witer` VALUES ('88', '25', '60', 'xtzlyp', '0', 'kai', 'Workflow', '1420342207');
INSERT INTO `tp_qyworkflow_witer` VALUES ('89', '25', '60', 'xtzlyp', '1', 'xtzlyp', 'Workflow', '1420342207');
INSERT INTO `tp_qyworkflow_witer` VALUES ('90', '25', '61', 'xtzlyp', '0', 'xtzlyp2', 'Workflow', '1420514150');
INSERT INTO `tp_qyworkflow_witer` VALUES ('91', '25', '61', 'xtzlyp', '0', 'kai', 'Workflow', '1420514150');
INSERT INTO `tp_qyworkflow_witer` VALUES ('92', '25', '61', 'xtzlyp', '0', 'xtzlyp', 'Workflow', '1420514150');
INSERT INTO `tp_qyworkflow_witer` VALUES ('93', '25', '62', 'ding', '0', 'xtzlyp', 'Workflow', '1421321242');
INSERT INTO `tp_qyworkflow_witer` VALUES ('94', '25', '62', 'ding', '0', 'xtzlyp', 'Workflow', '1421321242');
INSERT INTO `tp_qyworkflow_witer` VALUES ('95', '25', '63', 'ding', '0', 'xtzlyp', 'Workflow', '1421321312');
INSERT INTO `tp_qyworkflow_witer` VALUES ('96', '25', '64', 'ding', '0', 'xtzlyp', 'Workflow', '1421321368');
INSERT INTO `tp_qyworkflow_witer` VALUES ('97', '25', '65', 'ding', '0', 'xtzlyp', 'Workflow', '1421321585');
INSERT INTO `tp_qyworkflow_witer` VALUES ('98', '25', '66', 'ding', '0', 'xtzlyp', 'Workflow', '1421321660');
INSERT INTO `tp_qyworkflow_witer` VALUES ('99', '25', '67', 'ding', '0', 'xtzlyp', 'Workflow', '1421321749');
INSERT INTO `tp_qyworkflow_witer` VALUES ('100', '25', '67', 'ding', '0', 'kai', 'Workflow', '1421321749');
INSERT INTO `tp_qyworkflow_witer` VALUES ('101', '25', '67', 'ding', '0', 'xtzlyp', 'Workflow', '1421321749');
INSERT INTO `tp_qyworkflow_witer` VALUES ('102', '25', '68', '270636852', '0', null, 'Workflow', '1422166275');
INSERT INTO `tp_qyworkflow_witer` VALUES ('103', '25', '68', '270636852', '0', 'hgj', 'Workflow', '1422166275');
INSERT INTO `tp_qyworkflow_witer` VALUES ('104', '25', '68', '270636852', '0', 'lokjl', 'Workflow', '1422166275');
INSERT INTO `tp_qyworkflow_witer` VALUES ('105', '25', '69', '270636852', '0', null, 'Workflow', '1422167085');
INSERT INTO `tp_qyworkflow_witer` VALUES ('106', '25', '69', '270636852', '0', 'hgj', 'Workflow', '1422167085');
INSERT INTO `tp_qyworkflow_witer` VALUES ('107', '25', '69', '270636852', '0', 'lokjl', 'Workflow', '1422167085');
INSERT INTO `tp_qyworkflow_witer` VALUES ('108', '25', '70', '270636852', '0', '', 'Workflow', '1422171724');
INSERT INTO `tp_qyworkflow_witer` VALUES ('109', '25', '70', '270636852', '0', 'dfvs', 'Workflow', '1422171724');
INSERT INTO `tp_qyworkflow_witer` VALUES ('110', '25', '70', '270636852', '0', 'gf', 'Workflow', '1422171724');
INSERT INTO `tp_qyworkflow_witer` VALUES ('111', '25', '71', '270636852', '0', '', 'Workflow', '1422172799');
INSERT INTO `tp_qyworkflow_witer` VALUES ('112', '25', '71', '270636852', '0', 'dfvs', 'Workflow', '1422172799');
INSERT INTO `tp_qyworkflow_witer` VALUES ('113', '25', '71', '270636852', '0', 'gf', 'Workflow', '1422172799');
INSERT INTO `tp_qyworkflow_witer` VALUES ('114', '25', '72', '270636852', '0', null, 'Workflow', '1422172882');
INSERT INTO `tp_qyworkflow_witer` VALUES ('115', '25', '72', '270636852', '0', 'hgj', 'Workflow', '1422172882');
INSERT INTO `tp_qyworkflow_witer` VALUES ('116', '25', '72', '270636852', '0', 'lokjl', 'Workflow', '1422172882');
INSERT INTO `tp_qyworkflow_witer` VALUES ('117', '25', '73', '270636852', '0', null, 'Workflow', '1423103171');
INSERT INTO `tp_qyworkflow_witer` VALUES ('118', '25', '73', '270636852', '0', 'hgj', 'Workflow', '1423103171');
INSERT INTO `tp_qyworkflow_witer` VALUES ('119', '25', '73', '270636852', '0', 'lokjl', 'Workflow', '1423103171');
INSERT INTO `tp_qyworkflow_witer` VALUES ('120', '25', '74', 'ding', '0', null, 'Workflow', '1423733094');
INSERT INTO `tp_qyworkflow_witer` VALUES ('121', '25', '74', 'ding', '0', 'xtzlyp(xtzlyp)', 'Workflow', '1423733094');
INSERT INTO `tp_qyworkflow_witer` VALUES ('122', '25', '74', 'ding', '0', 'lanrain(陈雨)', 'Workflow', '1423733094');
INSERT INTO `tp_qyworkflow_witer` VALUES ('123', '25', '75', 'ding', '0', null, 'Workflow', '1423733182');
INSERT INTO `tp_qyworkflow_witer` VALUES ('124', '25', '75', 'ding', '0', 'xtzlyp(xtzlyp)', 'Workflow', '1423733182');
INSERT INTO `tp_qyworkflow_witer` VALUES ('125', '25', '75', 'ding', '0', 'lanrain(陈雨)', 'Workflow', '1423733182');
INSERT INTO `tp_qyworkflow_witer` VALUES ('126', '25', '76', '0033', '0', null, 'Workflow', '1427685551');
INSERT INTO `tp_qyworkflow_witer` VALUES ('127', '25', '76', '0033', '0', 'xtzlyp(xtzlyp)', 'Workflow', '1427685551');
INSERT INTO `tp_qyworkflow_witer` VALUES ('128', '25', '77', '270636852', '0', '', 'Workflow', '1427702866');
INSERT INTO `tp_qyworkflow_witer` VALUES ('129', '25', '77', '270636852', '0', 'dfvs', 'Workflow', '1427702866');
INSERT INTO `tp_qyworkflow_witer` VALUES ('130', '25', '77', '270636852', '0', 'gf', 'Workflow', '1427702866');
INSERT INTO `tp_qyworkflow_witer` VALUES ('131', '25', '78', '0033', '0', null, 'Workflow', '1427877397');
INSERT INTO `tp_qyworkflow_witer` VALUES ('132', '25', '78', '0033', '0', 'xtzlyp(xtzlyp)', 'Workflow', '1427877397');
INSERT INTO `tp_qyworkflow_witer` VALUES ('133', '25', '79', '270636852', '2', '270636852', 'Workflow', '1428892615');
INSERT INTO `tp_qyworkflow_witer` VALUES ('134', '25', '79', '270636852', '0', 'xtzlyp(xtzlyp)', 'Workflow', '1428889413');
INSERT INTO `tp_qyworkflow_witer` VALUES ('135', '25', '79', '270636852', '0', 'lanrain(陈雨)', 'Workflow', '1428889413');
INSERT INTO `tp_qyworkflow_witer` VALUES ('136', '25', '80', '270636852', '0', null, 'Workflow', '1428892665');
INSERT INTO `tp_qyworkflow_witer` VALUES ('137', '25', '80', '270636852', '0', 'xtzlyp(xtzlyp)', 'Workflow', '1428892665');
INSERT INTO `tp_qyworkflow_witer` VALUES ('138', '25', '81', '270636852', '0', null, 'Workflow', '1428894555');
INSERT INTO `tp_qyworkflow_witer` VALUES ('139', '25', '81', '270636852', '0', '270636852(黎先生)', 'Workflow', '1428894555');
INSERT INTO `tp_qyworkflow_witer` VALUES ('140', '25', '82', 'li_jun_6', '0', null, 'Workflow', '1428995550');
INSERT INTO `tp_qyworkflow_witer` VALUES ('141', '25', '82', 'li_jun_6', '0', '270636852(黎先生)', 'Workflow', '1428995550');
INSERT INTO `tp_qyworkflow_witer` VALUES ('142', '25', '83', 'li_jun_6', '0', null, 'Workflow', '1429237768');
INSERT INTO `tp_qyworkflow_witer` VALUES ('143', '25', '83', 'li_jun_6', '0', '270636852(黎先生)', 'Workflow', '1429237768');
INSERT INTO `tp_qyworkflow_witer` VALUES ('144', '25', '84', '0033', '0', null, 'Workflow', '1429523554');

-- ----------------------------
-- Table structure for `tp_qyzhu_menu`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qyzhu_menu`;
CREATE TABLE `tp_qyzhu_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `orders` int(5) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `picurl` varchar(300) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `display` int(1) DEFAULT NULL,
  `pid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qyzhu_menu
-- ----------------------------
INSERT INTO `tp_qyzhu_menu` VALUES ('1', '25', null, 'aaa', null, null, null, '0');

-- ----------------------------
-- Table structure for `tp_qy_node`
-- ----------------------------
DROP TABLE IF EXISTS `tp_qy_node`;
CREATE TABLE `tp_qy_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `node_user` varchar(32) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `node_name` varchar(32) DEFAULT NULL,
  `node_pic` varchar(255) DEFAULT NULL,
  `position` varchar(32) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qy_node
-- ----------------------------
INSERT INTO `tp_qy_node` VALUES ('16', '1', 'xtzlyp2', '0', '1616', null, 'yuangg', null);
INSERT INTO `tp_qy_node` VALUES ('17', '1', 'werw', '16', '1717', 'http://iwork365.oss-cn-hangzhou.aliyuncs.com/image/1d/53/ba/bf/20141101/07b3b1102d3ce6b803cb6122fba261ac.jpg', '成渝线', null);
INSERT INTO `tp_qy_node` VALUES ('18', '1', 'sdfsf', '16', '1818', 'http://iwork365.oss-cn-hangzhou.aliyuncs.com/image/1d/53/ba/bf/20141101/07b3b1102d3ce6b803cb6122fba261ac.jpg', null, null);
INSERT INTO `tp_qy_node` VALUES ('19', '1', '87', '17', '19999', 'http://iwork365.oss-cn-hangzhou.aliyuncs.com/image/1d/53/ba/bf/20141101/07b3b1102d3ce6b803cb6122fba261ac.jpg', null, null);
INSERT INTO `tp_qy_node` VALUES ('21', '1', 'xtzlyp', '16', '345345', null, null, null);
INSERT INTO `tp_qy_node` VALUES ('23', '25', 'xtzlyp', '0', null, 'http://dexingky.wxopen.cn/icon/EFF2xIL31416472979.jpg', null, null);
INSERT INTO `tp_qy_node` VALUES ('24', '25', 'wangming', '23', null, 'http://qy.wxopen.cn/icon/hwfrPGQw1417327988.jpg', null, null);
INSERT INTO `tp_qy_node` VALUES ('25', '25', 'kai', '23', null, 'http://dexingky.wxopen.cn/icon/kblql4gt1416478670.jpg', null, null);
INSERT INTO `tp_qy_node` VALUES ('26', '25', 'ding', '23', null, 'http://dexingky.wxopen.cn/', null, null);
INSERT INTO `tp_qy_node` VALUES ('27', '25', '270636852', '24', null, 'http://qy.wxopen.cn/', null, null);
INSERT INTO `tp_qy_node` VALUES ('28', '26', 'fly316', '0', null, 'http://qy.wxopen.cn/icon/x2xO7R8K1417679358.jpg', null, null);
INSERT INTO `tp_qy_node` VALUES ('29', '26', 'molibaocehua', '28', null, 'http://qy.wxopen.cn/icon/CYkax8YM1418627886.jpg', null, null);

-- ----------------------------
-- Table structure for `tp_scoreadmin`
-- ----------------------------
DROP TABLE IF EXISTS `tp_scoreadmin`;
CREATE TABLE `tp_scoreadmin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL COMMENT '员工id',
  `user_id` int(11) DEFAULT NULL COMMENT '企业id',
  `create_time` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_scoreadmin
-- ----------------------------
INSERT INTO `tp_scoreadmin` VALUES ('1', '222', '25', '20150413');

-- ----------------------------
-- Table structure for `tp_suiteid`
-- ----------------------------
DROP TABLE IF EXISTS `tp_suiteid`;
CREATE TABLE `tp_suiteid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) DEFAULT NULL,
  `apkey` varchar(100) DEFAULT NULL,
  `suiteid` varchar(100) DEFAULT NULL,
  `su_secret` varchar(100) DEFAULT NULL,
  `suiteticket` varchar(300) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_suiteid
-- ----------------------------
INSERT INTO `tp_suiteid` VALUES ('3', 'XwgfjF1421291410', 'W8bh2feET4prmjFJEqAlBiheZ2tSb7X5S9a3R4MMpVN', 'tje8614baee148097c', 'YuLYCkd-GJfvdMCUojXeOtKnw3f-iI6h-2jMKvwcVY53HH3Ip6nWO-OZ9SZ_wzkg', '9Q9deOf8ckc37llYI7UENiTp0i15cWz5oxfzI8E1Om4e8zctvJKNMZrtbT_V9BJi', '基础类', 'http://qy.workweixin.com/TempFile/admin/image/20150115110955407.png', '1');

-- ----------------------------
-- Table structure for `tp_user`
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `role` smallint(6) unsigned NOT NULL COMMENT '组ID',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 1:启用 0:禁止',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `last_login_time` int(11) unsigned NOT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(15) DEFAULT NULL COMMENT '最后登录IP',
  `last_location` varchar(100) DEFAULT NULL COMMENT '最后登录位置',
  `templet` varchar(10) DEFAULT 'lanrain',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1', '1', '', '1417167020', '111.174.9.122', '', 'weiyi');
INSERT INTO `tp_user` VALUES ('2', 'admin123', 'e10adc3949ba59abbe56e057f20f883e', '3', '1', '4刚刚梵蒂冈', '1412395196', '27.19.178.94', '', 'lanrain');
