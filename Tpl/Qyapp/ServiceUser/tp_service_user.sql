/*
Navicat MySQL Data Transfer

Source Server         : aaa
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : pigcms7.9

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2015-05-23 14:48:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tp_service_user`
-- ----------------------------
DROP TABLE IF EXISTS `tp_service_user`;
CREATE TABLE `tp_service_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `token` varchar(60) NOT NULL,
  `userName` varchar(60) NOT NULL,
  `userPwd` varchar(32) NOT NULL,
  `endJoinDate` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_service_user
-- ----------------------------
INSERT INTO `tp_service_user` VALUES ('1', '工号001', 'lxiuwf1418474602', '帐号001', 'e10adc3949ba59abbe56e057f20f883e', '1432361207', '0');
