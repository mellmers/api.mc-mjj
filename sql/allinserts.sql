USE `project-x` ;

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
INSERT INTO `bet` (`userid`, `lobbyid`, `amount`, `team`) VALUES
	(0, 0, 500, 0),
	(1, 0, 500, 1);
/*!40000 ALTER TABLE `bet` ENABLE KEYS */;

-- Dumping data for table project-x.game: ~2 rows (approximately)
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` (`name`, `typ`, `icon`, `rules`, `genre`, `timelimit`) VALUES
	('League of Legends', '5vs5', NULL, 'Create custom game invite all players', 'moba', '10800'),
	('League of Legends', '1vs1', NULL, 'Create custom game and invite enemy', 'moba', '7200');
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
INSERT INTO `gameaccount_type` (`name`, `icon`) VALUES
	('Battle.net', NULL),
	('League of Legends', NULL),
	('Origin', NULL),
	('Steam', NULL),
	('Uplay', NULL);
/*!40000 ALTER TABLE `gameaccount_type` ENABLE KEYS */;

-- Dumping data for table project-x.lobby: ~1 rows (approximately)
/*!40000 ALTER TABLE `lobby` DISABLE KEYS */;
INSERT INTO `lobby` (`owner_id`, `game_id`, `winnerteam`, `screenshot`, `createdAt`, `starttime`, `endtime`) VALUES
	(0, 1, NULL, NULL, '2016-05-27 12:34:54', NULL, NULL);
/*!40000 ALTER TABLE `lobby` ENABLE KEYS */;

-- Dumping data for table project-x.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`email`, `username`, `trusted`, `password`, `icon`, `coins`) VALUES
	('jonas@oja.de', 'jonasoja', NULL, 'geheim', NULL, 10000),
	('max@musterman.de', 'maxmusterman', NULL, 'password', NULL, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping data for table project-x.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `screenshot` DISABLE KEYS */;
INSERT INTO `screenshot` (`lobby_id`, `source`) VALUES
	(0, 'http://images.akamai.steamusercontent.com/ugc/362903713110000756/572369BEB6DA8B6832E704132D86B900B0CD1026/'),
    (0, 'http://images.akamai.steamusercontent.com/ugc/281847490916288370/EE7BFE30892DC177BF637A2306F31A7110664233/');
/*!40000 ALTER TABLE `screenshot` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;