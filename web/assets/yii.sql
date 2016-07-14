/*
Navicat MySQL Data Transfer

Source Server         : 南极环境开会
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : yii

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-07-13 17:12:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for my_gong
-- ----------------------------
DROP TABLE IF EXISTS `my_gong`;
CREATE TABLE `my_gong` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `g_name` varchar(255) DEFAULT NULL,
  `g_id` int(11) DEFAULT NULL,
  `g_secret` varchar(255) DEFAULT NULL,
  `g_desc` varchar(255) DEFAULT NULL,
  `g_img` varchar(255) DEFAULT NULL,
  `is_show` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_gong
-- ----------------------------

-- ----------------------------
-- Table structure for my_user
-- ----------------------------
DROP TABLE IF EXISTS `my_user`;
CREATE TABLE `my_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `poss` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_user
-- ----------------------------
