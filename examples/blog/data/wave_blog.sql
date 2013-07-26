-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 07 月 26 日 17:24
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `wave_blog`
--

-- --------------------------------------------------------

--
-- 表的结构 `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `add_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `add_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `content` longtext NOT NULL,
  `title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `modify_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type_status_date` (`post_type`,`status`,`add_date`,`id`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`add_author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`term_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- 转存表中的数据 `terms`
--

INSERT INTO `terms` (`term_id`, `name`) VALUES
(34, 'apache'),
(29, 'C'),
(18, 'centos'),
(39, 'html'),
(25, 'http'),
(14, 'IOS'),
(41, 'ios'),
(30, 'java'),
(38, 'javascript'),
(10, 'JS+HTML+DIV+CSS'),
(4, 'Linux'),
(26, 'mysql'),
(35, 'nginx'),
(32, 'php'),
(16, 'Python'),
(31, 'python'),
(27, 'redis'),
(33, 'sae'),
(37, 'ubuntu'),
(36, 'vim'),
(28, 'win7'),
(15, '其他'),
(21, '冷笑话'),
(17, '分页'),
(9, '数据'),
(22, '浏览器'),
(24, '爱好'),
(1, '生活'),
(44, '笑话'),
(20, '苦逼'),
(23, '趣味'),
(2, '链接表');

-- --------------------------------------------------------

--
-- 表的结构 `term_relationships`
--

CREATE TABLE IF NOT EXISTS `term_relationships` (
  `article_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`article_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- 转存表中的数据 `term_taxonomy`
--

INSERT INTO `term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '发表关于保时捷的文章', 0, 0),
(4, 4, 'category', 'dd', 0, 0),
(9, 9, 'category', 'dda', 4, 0),
(10, 10, 'category', 'asdf', 0, 0),
(14, 14, 'category', 'sdf', 0, 0),
(15, 15, 'category', 'sdfaa', 0, 0),
(16, 16, 'category', 'sdfs', 0, 0),
(17, 17, 'post_tag', 'dfdf', 0, 0),
(18, 18, 'post_tag', 'dfgdf', 0, 0),
(20, 20, 'post_tag', 'fgdfg', 0, 0),
(21, 21, 'post_tag', 'ddd', 0, 0),
(22, 22, 'post_tag', '', 0, 0),
(23, 23, 'post_tag', '', 0, 0),
(24, 24, 'post_tag', '', 0, 0),
(25, 25, 'post_tag', '', 0, 0),
(26, 26, 'post_tag', '', 0, 0),
(27, 9, 'post_tag', '', 0, 0),
(28, 27, 'post_tag', '', 0, 0),
(29, 28, 'post_tag', '', 0, 0),
(30, 29, 'post_tag', '', 0, 0),
(31, 30, 'post_tag', '', 0, 0),
(32, 31, 'post_tag', '', 0, 0),
(33, 32, 'post_tag', '', 0, 0),
(34, 33, 'post_tag', '', 0, 0),
(35, 34, 'post_tag', '', 0, 0),
(36, 35, 'post_tag', '', 0, 0),
(37, 36, 'post_tag', '', 0, 0),
(38, 37, 'post_tag', '', 0, 0),
(39, 38, 'post_tag', '', 0, 0),
(40, 39, 'post_tag', '', 0, 0),
(42, 41, 'post_tag', '', 0, 3),
(45, 44, 'category', '', 0, 3);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'xpmozong', 'e10adc3949ba59abbe56e057f20f883e', 'xpmozong', '361131953@qq.com', '', '0000-00-00 00:00:00', '', 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
