-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.5083
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table project-x.lobby
DROP TABLE IF EXISTS `lobby`;
CREATE TABLE IF NOT EXISTS `lobby` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) unsigned NOT NULL,
  `game_id` int(11) unsigned NOT NULL,
  `winnerteam` int(11) DEFAULT NULL,
  `screenshotData` longblob,
  `screenshotType` varchar(20) NOT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `starttime` varchar(45) DEFAULT NULL,
  `endtime` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`screenshotType`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_lobby_game1_idx` (`game_id`),
  KEY `fk_lobby_user1_idx` (`owner_id`),
  KEY `fk_lobby_img_type1_idx` (`screenshotType`),
  CONSTRAINT `fk_lobby_game1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lobby_img_type1` FOREIGN KEY (`screenshotType`) REFERENCES `img_type` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lobby_user1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table project-x.lobby: ~0 rows (approximately)
DELETE FROM `lobby`;
/*!40000 ALTER TABLE `lobby` DISABLE KEYS */;
INSERT INTO `lobby` (`id`, `owner_id`, `game_id`, `winnerteam`, `screenshotData`, `screenshotType`, `createdAt`, `starttime`, `endtime`) VALUES
	(1, 1, 1, NULL, NULL, 'bmp', '2016-05-28 21:36:30', NULL, NULL),
	(2, 3, 2, NULL, NULL, 'bmp', '2016-05-28 21:37:04', NULL, NULL),
	(3, 2, 3, NULL, NULL, 'bmp', '2016-05-28 21:37:03', NULL, NULL);
/*!40000 ALTER TABLE `lobby` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
