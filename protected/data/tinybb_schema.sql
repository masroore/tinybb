-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.25a - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-07-27 03:58:44
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for tinybb_dev
DROP DATABASE IF EXISTS `tinybb_dev`;
CREATE DATABASE IF NOT EXISTS `tinybb_dev` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tinybb_dev`;


-- Dumping structure for table tinybb_dev.tbb_banned
DROP TABLE IF EXISTS `tbb_banned`;
CREATE TABLE IF NOT EXISTS `tbb_banned` (
  `id` int(10) NOT NULL,
  `banned_user` int(10) NOT NULL,
  `ban_creator` int(10) DEFAULT NULL,
  `expires_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message` text,
  PRIMARY KEY (`id`),
  KEY `ix_banned` (`banned_user`,`expires_at`),
  KEY `fk_admin_ban_creator` (`ban_creator`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table tinybb_dev.tbb_forums
DROP TABLE IF EXISTS `tbb_forums`;
CREATE TABLE IF NOT EXISTS `tbb_forums` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` tinyint(2) NOT NULL DEFAULT '0',
  `name` varchar(160) NOT NULL,
  `group_name` varchar(80) NOT NULL,
  `description` text,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `redirect_url` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_forums` (`is_active`,`sort_order`,`name`,`group_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table tinybb_dev.tbb_options
DROP TABLE IF EXISTS `tbb_options`;
CREATE TABLE IF NOT EXISTS `tbb_options` (
  `opt_key` varchar(48) NOT NULL,
  `opt_value` text NOT NULL,
  PRIMARY KEY (`opt_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table tinybb_dev.tbb_posts
DROP TABLE IF EXISTS `tbb_posts`;
CREATE TABLE IF NOT EXISTS `tbb_posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `topic_id` int(10) DEFAULT NULL,
  `forum_id` int(10) DEFAULT NULL,
  `poster_id` int(10) DEFAULT NULL,
  `poster_ip` int(10) unsigned NOT NULL DEFAULT '0',
  `is_edited` tinyint(1) NOT NULL DEFAULT '0',
  `edited_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_topic_posts` (`topic_id`),
  KEY `fk_forum_posts` (`forum_id`),
  KEY `fk_user_posts` (`poster_id`),
  KEY `fk_user_edited_posts` (`edited_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table tinybb_dev.tbb_private_messages
DROP TABLE IF EXISTS `tbb_private_messages`;
CREATE TABLE IF NOT EXISTS `tbb_private_messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) DEFAULT NULL,
  `receiver_id` int(10) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `sent_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_messages` (`sender_id`,`receiver_id`,`is_read`,`sent_at`),
  KEY `fk_received_messages` (`receiver_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table tinybb_dev.tbb_topics
DROP TABLE IF EXISTS `tbb_topics`;
CREATE TABLE IF NOT EXISTS `tbb_topics` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_sticky` tinyint(1) NOT NULL DEFAULT '0',
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `slug` varchar(80) NOT NULL,
  `poster_id` int(10) NOT NULL,
  `forum_id` int(10) NOT NULL,
  `num_hits` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_reply_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_reply_user` varchar(48) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ix_topics` (`is_active`,`title`,`num_hits`,`created_at`,`poster_id`,`forum_id`),
  KEY `fk_user_topics` (`poster_id`),
  KEY `fk_forum_topics` (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table tinybb_dev.tbb_topic_subscriptions
DROP TABLE IF EXISTS `tbb_topic_subscriptions`;
CREATE TABLE IF NOT EXISTS `tbb_topic_subscriptions` (
  `topic_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`topic_id`,`user_id`),
  KEY `user_subscriptions` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table tinybb_dev.tbb_users
DROP TABLE IF EXISTS `tbb_users`;
CREATE TABLE IF NOT EXISTS `tbb_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `display_name` varchar(48) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `password_salt` char(22) NOT NULL,
  `email` varchar(48) NOT NULL,
  `website` varchar(80) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `registration_ip` int(10) unsigned NOT NULL DEFAULT '0',
  `facebook` varchar(80) DEFAULT NULL,
  `twitter` varchar(80) DEFAULT NULL,
  `skype` varchar(32) DEFAULT NULL,
  `msn` varchar(32) DEFAULT NULL,
  `yahoo` varchar(32) DEFAULT NULL,
  `location` varchar(32) DEFAULT NULL,
  `signature` text,
  `show_signature` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ak_user_username` (`username`),
  UNIQUE KEY `ak_user_email` (`email`),
  UNIQUE KEY `ak_user_displayname` (`display_name`),
  KEY `ix_users` (`username`,`is_active`,`created_at`,`last_login_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
