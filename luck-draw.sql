/*
Navicat MySQL Data Transfer

Source Server         : local sql
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : laravel

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2019-08-12 02:00:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for draw_winners
-- ----------------------------
DROP TABLE IF EXISTS `draw_winners`;
CREATE TABLE `draw_winners` (
  `id` int(10) NOT NULL,
  `first_prize` int(4) DEFAULT NULL,
  `second_prize_one` int(4) DEFAULT NULL,
  `second_prize_two` int(4) DEFAULT NULL,
  `third_prize_one` int(4) DEFAULT NULL,
  `third_prize_two` int(4) DEFAULT NULL,
  `third_prize_three` int(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of draw_winners
-- ----------------------------
INSERT INTO `draw_winners` VALUES ('1', null, null, null, null, null, null, '2019-08-12 01:48:06', '2019-08-12 01:48:06');

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `win_num_count` int(10) NOT NULL DEFAULT '1',
  `win_prize` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of members
-- ----------------------------

-- ----------------------------
-- Table structure for members_win_number
-- ----------------------------
DROP TABLE IF EXISTS `members_win_number`;
CREATE TABLE `members_win_number` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `m_id` int(10) DEFAULT NULL,
  `win_number` int(4) DEFAULT NULL,
  `used_by` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of members_win_number
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'admin@gmail.com', '$2y$10$cV75eUqLHnBr3oqN7dC1zea/8UXR.Qr1QqM4XVXhiXWgxAN9BpSW2', 'WY7tYYD21exmhtuv9ZNwDAOohgmIlQz1thfCazUwxl7o7zi8E0AqwGBbvrqE', '2019-08-10 17:14:25', '2019-08-10 17:14:25');
INSERT INTO `users` VALUES ('2', 'admin', 'admin@gmail.com', '$2y$10$eb7zaZqs/71hdHSr/hYF4udQHYjxVkkF9sAJ8WqbqOdSrfrevqUjK', 'isHPRLTeXf', '2019-08-11 10:45:55', '2019-08-11 10:45:55');
SET FOREIGN_KEY_CHECKS=1;
