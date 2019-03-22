/*
Navicat MySQL Data Transfer

Source Server         : wdn_local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : sample_atb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-03-22 11:07:18
*/
CREATE DATABASE sample_atb;
USE sample_atb;
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for amount
-- ----------------------------
DROP TABLE IF EXISTS `amount`;
CREATE TABLE `amount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msisdn` varchar(25) NOT NULL,
  `money` int(10) NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `msisdn` (`msisdn`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of amount
-- ----------------------------
INSERT INTO `amount` VALUES ('1', '84369803686', '45000', '2019-03-22 01:31:45', '2019-03-22 01:31:45');

-- ----------------------------
-- Table structure for transaction
-- ----------------------------
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` varchar(50) NOT NULL,
  `msisdn` varchar(25) NOT NULL,
  `action` varchar(10) NOT NULL,
  `price` int(10) NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `msisdn` (`msisdn`) USING BTREE,
  KEY `request_id` (`request_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;


-- ----------------------------
-- Records of transaction
-- ----------------------------
