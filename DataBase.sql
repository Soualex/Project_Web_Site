-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.5.34-MariaDB - mariadb.org binary distribution
-- Serveur OS:                   Win64
-- HeidiSQL Version:             8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table site.account
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rank` tinyint(4) NOT NULL DEFAULT '0',
  `joindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `joinip` varchar(15) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `last_ip` varchar(15) DEFAULT NULL,
  `locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `chatbox_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table site.account: ~1 rows (environ)
DELETE FROM `account`;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`id`, `username`, `email`, `password`, `rank`, `joindate`, `joinip`, `last_login`, `last_ip`, `locked`, `chatbox_status`) VALUES
	(1, 'Soualex', 'soualexduseptsix@gmail.com', '482495b6a09ac8c62002202ed06609e89dd0810f2f19f554764a336118710407eda162c89495fcfb70b198e0624e5a6af4b069c6d760dc783d02bcef4c5e61f0', 3, '2014-01-23 18:36:12', '127.0.0.1', '2014-03-22 14:41:25', '127.0.0.1', 0, 0);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;


-- Dumping structure for table site.account_banned
DROP TABLE IF EXISTS `account_banned`;
CREATE TABLE IF NOT EXISTS `account_banned` (
  `id` int(10) unsigned NOT NULL,
  `ban_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unban_date` timestamp NULL DEFAULT NULL,
  `ban_reason` varchar(50) DEFAULT NULL,
  `bannedby` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk2__account_banned__account` (`bannedby`),
  CONSTRAINT `fk2__account_banned__account` FOREIGN KEY (`bannedby`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk__account_banned__account` FOREIGN KEY (`id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table site.account_banned: ~0 rows (environ)
DELETE FROM `account_banned`;
/*!40000 ALTER TABLE `account_banned` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_banned` ENABLE KEYS */;


-- Dumping structure for table site.chatbox_announces
DROP TABLE IF EXISTS `chatbox_announces`;
CREATE TABLE IF NOT EXISTS `chatbox_announces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table site.chatbox_announces: ~0 rows (environ)
DELETE FROM `chatbox_announces`;
/*!40000 ALTER TABLE `chatbox_announces` DISABLE KEYS */;
/*!40000 ALTER TABLE `chatbox_announces` ENABLE KEYS */;


-- Dumping structure for table site.chatbox_messages
DROP TABLE IF EXISTS `chatbox_messages`;
CREATE TABLE IF NOT EXISTS `chatbox_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk__chatbox_messages__account` (`user_id`),
  CONSTRAINT `fk__chatbox_messages__account` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table site.chatbox_messages: ~0 rows (environ)
DELETE FROM `chatbox_messages`;
/*!40000 ALTER TABLE `chatbox_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `chatbox_messages` ENABLE KEYS */;


-- Dumping structure for table site.files
DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `filesize` int(11) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table site.files: ~0 rows (environ)
DELETE FROM `files`;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;


-- Dumping structure for table site.ip_banned
DROP TABLE IF EXISTS `ip_banned`;
CREATE TABLE IF NOT EXISTS `ip_banned` (
  `ip` varchar(15) NOT NULL,
  `ban_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unban_date` timestamp NULL DEFAULT NULL,
  `ban_reason` varchar(50) DEFAULT NULL,
  `bannedby` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ip`),
  KEY `fk__ip_banned__account` (`bannedby`),
  CONSTRAINT `fk__ip_banned__account` FOREIGN KEY (`bannedby`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table site.ip_banned: ~0 rows (environ)
DELETE FROM `ip_banned`;
/*!40000 ALTER TABLE `ip_banned` DISABLE KEYS */;
/*!40000 ALTER TABLE `ip_banned` ENABLE KEYS */;


-- Dumping structure for table site.news
DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `content` longtext NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk__news__acount` (`author_id`),
  CONSTRAINT `fk__news__acount` FOREIGN KEY (`author_id`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table site.news: ~2 rows (environ)
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `title`, `author_id`, `content`, `add_date`, `update_date`) VALUES
	(1, 'Welcome !', 1, 'Welcome ! &éèà"\\/\'-- \'lol\'', '2014-01-23 18:11:51', NULL),
	(2, 'Premiers essais de la BBCode', 1, '[color=red]Un texte en rouge.[/color]\r\n[color=#FF0000]Un texte en rouge.[/color]\r\n[b]Un texte en gras.[/b]\r\n[i]Un texte en italique.[/i]\r\n[u]Un texte souligné.[/u]\r\n[url=google.fr]test[/url]\r\n\r\ncross-site scripting :\r\n<script> alert(\'helloworld\');</script>\r\n\r\n\\\'.include(\'http://google.com\').\\\'', '2014-02-07 17:57:36', NULL);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


-- Dumping structure for table site.pages
DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `url` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `security` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table site.pages: ~2 rows (environ)
DELETE FROM `pages`;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`url`, `name`, `content`, `security`) VALUES
	('conditions', 'Conditions Générales d\'Utilisation', '[i]Prochainement...[/i]', 0),
	('sitemap', 'Plan du Site', '[i]Prochainement...[/i]', 0);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;


-- Dumping structure for table site.routes
DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(50) NOT NULL,
  `application` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `varsNames` varchar(50) DEFAULT NULL,
  `security` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uri` (`uri`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table site.routes: ~14 rows (environ)
DELETE FROM `routes`;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` (`id`, `uri`, `application`, `module`, `action`, `varsNames`, `security`) VALUES
	(1, '([1-9]*)', 'Frontend', 'News', 'Index', 'page', 0),
	(2, 'error', 'Frontend', 'Error', 'Show', NULL, 0),
	(3, 'pages', 'Frontend', 'Pages', 'Index', NULL, 0),
	(4, 'account/login', 'Frontend', 'Account', 'Login', NULL, 0),
	(5, 'account/register', 'Frontend', 'Account', 'Register', NULL, 0),
	(6, 'files/upload', 'Frontend', 'Files', 'Upload', NULL, 1),
	(7, 'account/logout', 'Frontend', 'Account', 'Logout', NULL, 0),
	(8, 'account', 'Frontend', 'Account', 'Index', NULL, 0),
	(9, 'chatbox', 'Frontend', 'ChatBox', 'Index', NULL, 0),
	(10, 'page/([a-zA-Z0-9]*)', 'Frontend', 'Pages', 'Show', 'page_url', 0),
	(11, 'admin', 'Backend', 'Statue', 'Index', NULL, 3),
	(12, 'admin/pages', 'Backend', 'Pages', 'Index', NULL, 3),
	(13, 'admin/pages/add', 'Backend', 'Pages', 'Add', NULL, 3),
	(14, 'admin/pages/delete/([a-zA-Z0-9]+)', 'Backend', 'Pages', 'Delete', 'page_url', 3);
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
