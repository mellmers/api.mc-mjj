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

-- Dumping structure for table project-x.bet
DROP TABLE IF EXISTS `bet`;
CREATE TABLE IF NOT EXISTS `bet` (
  `user_id` int(11) unsigned NOT NULL,
  `lobby_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`lobby_id`),
  KEY `fk_bet_lobby1_idx` (`lobby_id`),
  CONSTRAINT `fk_bet_lobby1` FOREIGN KEY (`lobby_id`) REFERENCES `lobby` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table project-x.bet: ~2 rows (approximately)
DELETE FROM `bet`;
/*!40000 ALTER TABLE `bet` DISABLE KEYS */;
INSERT INTO `bet` (`user_id`, `lobby_id`, `amount`, `team`) VALUES
	(0, 0, 500, 0),
	(1, 0, 500, 1);
/*!40000 ALTER TABLE `bet` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
