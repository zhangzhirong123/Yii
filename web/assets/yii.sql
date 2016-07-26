/*
Navicat MySQL Data Transfer

Source Server         : 南极环境开会
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : yii

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-07-26 20:04:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for my_gong
-- ----------------------------
DROP TABLE IF EXISTS `my_gong`;
CREATE TABLE `my_gong` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `g_name` varchar(255) DEFAULT NULL,
  `g_id` varchar(255) DEFAULT NULL,
  `g_secret` varchar(255) DEFAULT NULL,
  `g_desc` varchar(255) DEFAULT NULL,
  `g_img` varchar(255) DEFAULT NULL,
  `is_show` varchar(255) DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `atok` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_gong
-- ----------------------------

-- ----------------------------
-- Table structure for my_rules
-- ----------------------------
DROP TABLE IF EXISTS `my_rules`;
CREATE TABLE `my_rules` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `g_id` int(11) DEFAULT NULL,
  `rname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `rword` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of my_rules
-- ----------------------------

-- ----------------------------
-- Table structure for my_rules_text
-- ----------------------------
DROP TABLE IF EXISTS `my_rules_text`;
CREATE TABLE `my_rules_text` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) DEFAULT NULL,
  `rcontent` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of my_rules_text
-- ----------------------------

-- ----------------------------
-- Table structure for my_sucai
-- ----------------------------
DROP TABLE IF EXISTS `my_sucai`;
CREATE TABLE `my_sucai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `g_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fword` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `filename` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fcontent` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of my_sucai
-- ----------------------------

-- ----------------------------
-- Table structure for my_user
-- ----------------------------
DROP TABLE IF EXISTS `my_user`;
CREATE TABLE `my_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `poss` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_user
-- ----------------------------
