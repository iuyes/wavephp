-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 07 月 31 日 16:00
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `articles`
--

INSERT INTO `articles` (`id`, `add_author`, `add_date`, `content`, `title`, `post_excerpt`, `status`, `comment_status`, `modify_date`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2013-07-30 13:52:09', '<p>sssssssssssssssssssssssssssssss222</p>\r\n', 'ssssssssssssssaaaaaaaaaa', '', 'publish', 'open', '2013-07-30 17:47:55', 0, '', 0, 'post', '', 0),
(2, 1, '2013-07-30 14:45:02', '<p>wwwwwwwwwwwwwwwwwwwwwwwww</p>\r\n', 'eeeeeeeeeeeeeeeee', '', 'publish', 'open', '2013-07-30 17:47:20', 0, '', 0, 'post', '', 0),
(4, 1, '2013-07-30 15:51:25', '<p>wwwwwwwwwerafasdfsssssss</p>\r\n', 'sssssswwwwwwww', '', 'publish', 'open', '2013-07-30 17:47:12', 0, '', 0, 'post', '', 0),
(5, 1, '2013-07-30 16:06:37', '<p>sssssswwwwwwwwwwwww</p>\r\n', 'dddddddddaaaaaaa', '', 'publish', 'open', '2013-07-30 16:06:37', 0, '', 0, 'post', '', 0),
(12, 1, '2013-07-30 16:18:11', '<p>fasdfsadfsdfsdssss</p>\r\n', 'fffffffff', '', 'publish', 'open', '2013-07-30 18:23:20', 0, '', 0, 'post', '', 0),
(13, 1, '2013-07-30 16:18:25', '<p>asdfasdfadsssssssssssssswwww</p>\r\n', 'ddddddddddaaaaaaaawwaaaa', '', 'publish', 'open', '2013-07-30 18:23:14', 0, '', 0, 'post', '', 0),
(15, 1, '2013-07-30 16:21:43', '<p>wwwwwwwaaaaaaaaaaaa</p>\r\n', 'fsdfsdfsdfsdfdwww', '', 'publish', 'open', '2013-07-30 18:20:45', 0, '', 0, 'post', '', 0),
(16, 1, '2013-07-30 16:21:56', '<p>wefadsdfasdfasd</p>\r\n', 'sssssswww', '', 'publish', 'open', '2013-07-30 16:21:56', 0, '', 0, 'post', '', 0),
(17, 1, '2013-07-30 16:22:31', '<p>sssssssss</p>\r\n', 'wwwwwwwwwa', '', 'publish', 'open', '2013-07-30 16:22:31', 0, '', 0, 'post', '', 0),
(18, 1, '2013-07-30 16:24:33', '<p>wwaaaaaaaaaaa</p>\r\n', 'ssssaaaawww', '', 'publish', 'open', '2013-07-30 16:24:33', 0, '', 0, 'post', '', 0),
(19, 1, '2013-07-30 16:49:46', '<p>aaaaaaaaaaaaaaaa</p>\r\n', 'ssswwwww', '', 'publish', 'open', '2013-07-30 16:49:46', 0, '', 0, 'post', '', 0),
(20, 1, '2013-07-30 17:45:22', '<p>sdfasdfasd</p>\r\n', 'sdfasd', '', 'publish', 'open', '2013-07-30 17:46:09', 0, '', 0, 'post', '', 0),
(21, 1, '2013-07-30 17:45:30', '<p>asdfasdfasd</p>\r\n', 'sdfasdf', '', 'publish', 'open', '2013-07-30 17:47:32', 0, '', 0, 'post', '', 0),
(22, 1, '2013-07-30 17:45:40', '<p>sdfasdfasdf</p>\r\n', 'sfasdfasd', '', 'publish', 'open', '2013-07-30 17:45:52', 0, '', 0, 'post', '', 0),
(23, 1, '2013-07-30 17:46:24', '<p>sdfsdf</p>\r\n', 'saaaaaaaaaaaaaa', '', 'publish', 'open', '2013-07-30 17:46:24', 0, '', 0, 'post', '', 0),
(24, 1, '2013-07-30 18:21:26', '<p>sdfasdfasd</p>\r\n', 'fasdfsdfd', '', 'publish', 'open', '2013-07-30 18:21:26', 0, '', 0, 'post', '', 0),
(25, 1, '2013-07-30 18:22:34', '<p>wwwwwwwww</p>\r\n', 'ssssssssssss', '', 'publish', 'open', '2013-07-30 18:22:34', 0, '', 0, 'post', '', 0),
(26, 1, '2013-07-30 18:22:54', '<p>sdfasdfasd</p>\r\n', 'zdfasdf', '', 'publish', 'open', '2013-07-30 18:22:54', 0, '', 0, 'post', '', 0),
(27, 1, '2013-07-30 18:29:50', '<p>awfadfasdf</p>\r\n', 'wwwwwww', '', 'publish', 'open', '2013-07-31 13:47:03', 0, '', 0, 'post', '', 0),
(28, 1, '2013-07-30 18:31:26', '<p>sdfasdfsdf</p>\r\n', 'sdfas', '', 'publish', 'open', '2013-07-31 13:46:57', 0, '', 0, 'post', '', 0),
(29, 1, '2013-07-30 18:31:47', '<p>dfasdfasdf</p>\r\n', 'sdfs', '', 'publish', 'open', '2013-07-31 13:46:51', 0, '', 0, 'post', '', 0),
(30, 1, '2013-07-30 18:34:26', '<p>sdfsdfsd</p>\r\n', 'sdfsd', '', 'publish', 'open', '2013-07-31 13:46:45', 0, '', 0, 'post', '', 0),
(31, 1, '2013-07-31 13:45:25', '<p><img alt="55555" src="http://localhost//wavephp/examples/blog/uploadfile/images/medium/1375249478.jpg" style="height:300px; width:225px" /></p>\r\n\r\n<p>图片测试</p>\r\n', '小奶', '', 'publish', 'open', '2013-07-31 13:46:34', 0, '', 0, 'post', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `multimedias`
--

CREATE TABLE IF NOT EXISTS `multimedias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_type` varchar(20) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `save_name` varchar(255) DEFAULT NULL,
  `adddate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `multimedias`
--

INSERT INTO `multimedias` (`id`, `file_type`, `file_name`, `save_name`, `adddate`) VALUES
(2, 'images', '小奶.jpg', '1375249478.jpg', '2013-07-31 13:44:38');

-- --------------------------------------------------------

--
-- 表的结构 `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) DEFAULT NULL,
  `option_value` text,
  `autoload` varchar(20) DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `options`
--

INSERT INTO `options` (`id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://localhost/', 'yes'),
(2, 'blogname', '寞踪的技术博客', 'yes'),
(3, 'blogdescription', 'Super Rangers!', 'yes'),
(4, 'thumbnail_size_w', '150', 'yes'),
(5, 'thumbnail_size_h', '150', 'yes'),
(6, 'medium_size_w', '700', 'yes'),
(7, 'medium_size_h', '400', 'yes');

-- --------------------------------------------------------

--
-- 表的结构 `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`term_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

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
(49, 'PHP'),
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
(50, '笑话'),
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

--
-- 转存表中的数据 `term_relationships`
--

INSERT INTO `term_relationships` (`article_id`, `term_taxonomy_id`) VALUES
(1, 1),
(20, 1),
(22, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(1, 4),
(2, 4),
(4, 4),
(17, 4),
(26, 4),
(12, 10),
(2, 14),
(4, 14),
(18, 14),
(21, 14),
(23, 14),
(4, 15),
(5, 15),
(31, 23),
(27, 25),
(28, 26),
(17, 27),
(29, 29),
(30, 31),
(1, 32),
(26, 32),
(5, 33),
(12, 33),
(13, 33),
(15, 33),
(16, 33),
(19, 33),
(20, 33),
(24, 33),
(2, 42),
(4, 42),
(18, 42),
(21, 42),
(22, 42),
(23, 42),
(25, 42),
(31, 45),
(13, 50),
(15, 50),
(16, 50),
(19, 50),
(24, 50),
(25, 50);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- 转存表中的数据 `term_taxonomy`
--

INSERT INTO `term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '发表关于保时捷的文章', 0, 7),
(4, 4, 'category', 'dd', 0, 5),
(9, 9, 'category', 'dda', 4, 0),
(10, 10, 'category', 'asdf', 0, 1),
(14, 14, 'category', 'sdf', 0, 5),
(15, 15, 'category', 'sdfaa', 0, 2),
(16, 16, 'category', 'sdfs', 0, 0),
(17, 17, 'post_tag', 'dfdf', 0, 0),
(18, 18, 'post_tag', 'dfgdf', 0, 0),
(20, 20, 'post_tag', 'fgdfg', 0, 0),
(21, 21, 'post_tag', 'ddd', 0, 0),
(22, 22, 'post_tag', '', 0, 0),
(23, 23, 'post_tag', '', 0, 1),
(24, 24, 'post_tag', '', 0, 0),
(25, 25, 'post_tag', '', 0, 1),
(26, 26, 'post_tag', '', 0, 1),
(27, 9, 'post_tag', '', 0, 1),
(28, 27, 'post_tag', '', 0, 0),
(29, 28, 'post_tag', '', 0, 1),
(30, 29, 'post_tag', '', 0, 0),
(31, 30, 'post_tag', '', 0, 1),
(32, 31, 'post_tag', '', 0, 2),
(33, 32, 'post_tag', '', 0, 8),
(34, 33, 'post_tag', '', 0, 0),
(35, 34, 'post_tag', '', 0, 0),
(36, 35, 'post_tag', '', 0, 0),
(37, 36, 'post_tag', '', 0, 0),
(38, 37, 'post_tag', '', 0, 0),
(39, 38, 'post_tag', '', 0, 0),
(40, 39, 'post_tag', '', 0, 0),
(42, 41, 'post_tag', '', 0, 7),
(45, 44, 'category', '', 0, 1),
(50, 49, 'category', '', 0, 6),
(51, 50, 'post_tag', '', 0, 0);

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
