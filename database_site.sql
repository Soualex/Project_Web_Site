-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.5.34-MariaDB - mariadb.org binary distribution
-- Serveur OS:                   Win64
-- HeidiSQL Version:             8.2.0.4675
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la base pour site
DROP DATABASE IF EXISTS `site`;
CREATE DATABASE IF NOT EXISTS `site` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `site`;


-- Export de la structure de table site. account
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Export de données de la table site.account: ~1 rows (environ)
DELETE FROM `account`;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`id`, `username`, `email`, `password`, `rank`, `joindate`, `joinip`, `last_login`, `last_ip`, `locked`) VALUES
	(1, 'Soualex', 'soualexduseptsix@gmail.com', '482495b6a09ac8c62002202ed06609e89dd0810f2f19f554764a336118710407eda162c89495fcfb70b198e0624e5a6af4b069c6d760dc783d02bcef4c5e61f0', 3, '2014-01-23 18:36:12', '127.0.0.1', NULL, NULL, 0);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;


-- Export de la structure de table site. account_banned
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

-- Export de données de la table site.account_banned: ~0 rows (environ)
DELETE FROM `account_banned`;
/*!40000 ALTER TABLE `account_banned` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_banned` ENABLE KEYS */;


-- Export de la structure de table site. files
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

-- Export de données de la table site.files: ~0 rows (environ)
DELETE FROM `files`;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;


-- Export de la structure de table site. ip_banned
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

-- Export de données de la table site.ip_banned: ~0 rows (environ)
DELETE FROM `ip_banned`;
/*!40000 ALTER TABLE `ip_banned` DISABLE KEYS */;
/*!40000 ALTER TABLE `ip_banned` ENABLE KEYS */;


-- Export de la structure de table site. news
DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `author` int(10) unsigned DEFAULT NULL,
  `content` longtext NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk__news__acount` (`author`),
  CONSTRAINT `fk__news__acount` FOREIGN KEY (`author`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Export de données de la table site.news: ~1 rows (environ)
DELETE FROM `news`;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `title`, `author`, `content`, `add_date`, `update_date`) VALUES
	(1, 'Physique - Chimie', 1, '<div>        <object id="objFlashCeaAnimation" height="318" width="555" class="flash" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000">        <param name="movie" value="http://www.cea.fr/content/download/3931/298641/file/REP.swf" />        <param name="width" value="555" />        <param name="height" value="318" />        <param name="wmode" value="transparent" />        <embed height="318" width="555" src="http://www.cea.fr/content/download/3931/298641/file/REP.swf" wmode="transparent" ></embed>    </object>                        <p style="margin-top: 0.2em; color: #999999;">Voir l\'animation <a href="http://www.cea.fr/jeunes/mediatheque/animations-flash/radioactivite/le-reacteur-a-eau-pressurisee" style="color: #666666" target="_blank">Le réacteur à eau pressurisée</a> sur <a href="http://www.cea.fr" style="color: #999999" target="_blank"> www.cea.fr </a></p>                    </div>', '2014-01-23 18:11:51', NULL);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


-- Export de la structure de table site. pages
DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `security` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table site.pages: ~0 rows (environ)
DELETE FROM `pages`;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;


-- Export de la structure de table site. routes
DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(50) NOT NULL,
  `application` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `varsNames` varchar(50) DEFAULT NULL,
  `security` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Export de données de la table site.routes: ~7 rows (environ)
DELETE FROM `routes`;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` (`id`, `uri`, `application`, `module`, `action`, `varsNames`, `security`) VALUES
	(1, '', 'Frontend', 'News', 'Index', NULL, 0),
	(2, 'error', 'Frontend', 'Error', 'Show', NULL, 0),
	(3, 'page', 'Frontend', 'Pages', 'Index', NULL, 0),
	(4, 'account/login', 'Frontend', 'Account', 'Login', NULL, 0),
	(5, 'account/register', 'Frontend', 'Account', 'Register', NULL, 0),
	(6, 'files/upload', 'Frontend', 'Files', 'Upload', NULL, 1),
	(7, 'account/logout', 'Frontend', 'Account', 'Logout', NULL, 0);
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
