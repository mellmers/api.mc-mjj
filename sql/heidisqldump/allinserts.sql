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
-- Dumping data for table project-x.bet: ~2 rows (approximately)
/*!40000 ALTER TABLE `bet` DISABLE KEYS */;
INSERT INTO `bet` (`user_id`, `lobby_id`, `amount`, `team`) VALUES
	(0, 0, 500, 0),
	(1, 0, 500, 1);
/*!40000 ALTER TABLE `bet` ENABLE KEYS */;

-- Dumping data for table project-x.game: ~2 rows (approximately)
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` (`id`, `name`, `typ`, `logoData`, `logoType`, `rules`, `genre`, `timelimit`) VALUES
	(0, 'League of Legends', '5vs5', NULL, 'png', 'Create custom game invite all players', 'moba', '2016-05-27 12:32:37'),
	(1, 'League of Legends', '1vs1', NULL, 'png', 'Crete custom game and invite enemy', 'moba', '2016-05-27 12:34:13');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;

-- Dumping data for table project-x.gameaccount: ~3 rows (approximately)
/*!40000 ALTER TABLE `gameaccount` DISABLE KEYS */;
INSERT INTO `gameaccount` (`user_id`, `_type`, `userIdentifier`) VALUES
	(0, 'Battle.net', 'dorbird#2378'),
	(0, 'League of Legends', 'BirdTheBest'),
	(0, 'Steam', 'dor_bird');
/*!40000 ALTER TABLE `gameaccount` ENABLE KEYS */;

-- Dumping data for table project-x.gameaccount_type: ~5 rows (approximately)
/*!40000 ALTER TABLE `gameaccount_type` DISABLE KEYS */;
INSERT INTO `gameaccount_type` (`name`, `icondata`, `iconType`) VALUES
	('Battle.net', NULL, 'png'),
	('League of Legends', NULL, 'png'),
	('Origin', NULL, 'png'),
	('Steam', NULL, 'png'),
	('Uplay', NULL, 'png');
/*!40000 ALTER TABLE `gameaccount_type` ENABLE KEYS */;

-- Dumping data for table project-x.img_type: ~4 rows (approximately)
/*!40000 ALTER TABLE `img_type` DISABLE KEYS */;
INSERT INTO `img_type` (`name`) VALUES
	('bmp'),
	('gif'),
	('jpg'),
	('png');
/*!40000 ALTER TABLE `img_type` ENABLE KEYS */;

-- Dumping data for table project-x.lobby: ~1 rows (approximately)
/*!40000 ALTER TABLE `lobby` DISABLE KEYS */;
INSERT INTO `lobby` (`id`, `owner_id`, `game_id`, `winnerteam`, `screenshotData`, `screenshotType`, `createdAt`, `starttime`, `endtime`) VALUES
	(0, 0, 1, NULL, NULL, 'png', '2016-05-27 12:34:54', NULL, NULL);
/*!40000 ALTER TABLE `lobby` ENABLE KEYS */;

-- Dumping data for table project-x.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `username`, `trusted`, `password`, `iconData`, `iconType`, `coins`) VALUES
	(0, 'jonas@oja.de', 'jonasoja', NULL, 'geheim', NULL, 'png', 10000),
	(1, 'max@musterman.de', 'maxmusterman', NULL, 'password', NULL, 'gif', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
