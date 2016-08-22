/*
Navicat MySQL Data Transfer

Source Server         : aaa
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : pigcms7.9

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2015-05-23 14:48:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tp_service_logs`
-- ----------------------------
DROP TABLE IF EXISTS `tp_service_logs`;
CREATE TABLE `tp_service_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `openid` varchar(60) NOT NULL,
  `enddate` int(11) NOT NULL,
  `keyword` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_service_logs
-- ----------------------------
