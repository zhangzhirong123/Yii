/*
Navicat MySQL Data Transfer

Source Server         : 南极环境开会
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : yii

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-07-19 09:53:09
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
  `url` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `atok` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_gong
-- ----------------------------
INSERT INTO `my_gong` VALUES ('2', '第一个', '123', '123', '123', 'upload/1468892943949.jpg', '0', 'http://www.chengjiajia.com/9/Yii/web/rong.php?str=x4Jlo', 'dc5689792e08eb2e219dce49e64c885b', '1', 'x4Jlo');

-- ----------------------------
-- Table structure for my_user
-- ----------------------------
DROP TABLE IF EXISTS `my_user`;
CREATE TABLE `my_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `poss` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_user
-- ----------------------------
INSERT INTO `my_user` VALUES ('1', 'admin', '123');
