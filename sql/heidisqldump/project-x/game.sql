-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table project-x.game
DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `typ` varchar(45) NOT NULL,
  `logoData` longblob,
  `logoType` varchar(20) NOT NULL,
  `rules` text NOT NULL,
  `genre` varchar(100) NOT NULL,
  `timelimit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`logoType`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_game_img_type1_idx` (`logoType`),
  CONSTRAINT `fk_game_img_type1` FOREIGN KEY (`logoType`) REFERENCES `img_type` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table project-x.game: ~2 rows (approximately)
DELETE FROM `game`;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` (`id`, `name`, `typ`, `logoData`, `logoType`, `rules`, `genre`, `timelimit`) VALUES
	(0, 'League of Legends', '5vs5', NULL, 'png', 'Create custom game invite all players', 'moba', '2016-05-27 12:32:37'),
	(1, 'League of Legends', '1vs1', NULL, 'png', 'Crete custom game and invite enemy', 'moba', '2016-05-27 12:34:13');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
