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

-- Dumping structure for table project-x.gameaccount
DROP TABLE IF EXISTS `gameaccount`;
CREATE TABLE IF NOT EXISTS `gameaccount` (
  `user_id` int(11) unsigned NOT NULL,
  `_type` varchar(200) NOT NULL,
  `userIdentifier` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`_type`),
  KEY `fk_gameaccount_gameaccount_types1_idx` (`_type`),
  CONSTRAINT `fk_gameaccount_gameaccount_types1` FOREIGN KEY (`_type`) REFERENCES `gameaccount_type` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gameaccount_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table project-x.gameaccount: ~0 rows (approximately)
DELETE FROM `gameaccount`;
/*!40000 ALTER TABLE `gameaccount` DISABLE KEYS */;
INSERT INTO `gameaccount` (`user_id`, `_type`, `userIdentifier`) VALUES
	(1, 'battle.net', 'dorbird#2378'),
	(1, 'League of Legends', 'BIRDTheBest'),
	(1, 'Origin', 'dorbird'),
	(1, 'Steam', 'dor_bird'),
	(1, 'Uplay', 'dorbird');
/*!40000 ALTER TABLE `gameaccount` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
