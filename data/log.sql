/*
 Navicat MySQL Data Transfer

 Source Server         : Example Local
 Source Server Type    : MySQL
 Source Server Version : 50537
 Source Host           : localhost
 Source Database       : bs-dev

 Target Server Type    : MySQL
 Target Server Version : 50537
 File Encoding         : utf-8

 Date: 07/28/2014 09:27:12 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `log`
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventname` varchar(50) NOT NULL,
  `data` text NOT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `params` text,
  `postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
