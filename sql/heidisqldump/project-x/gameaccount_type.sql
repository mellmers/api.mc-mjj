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

-- Dumping structure for table project-x.gameaccount_type
DROP TABLE IF EXISTS `gameaccount_type`;
CREATE TABLE IF NOT EXISTS `gameaccount_type` (
  `name` varchar(200) NOT NULL,
  `icondata` longblob,
  `iconType` varchar(20) NOT NULL,
  PRIMARY KEY (`name`,`iconType`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_gameaccount_type_img_type1_idx` (`iconType`),
  CONSTRAINT `fk_gameaccount_type_img_type1` FOREIGN KEY (`iconType`) REFERENCES `img_type` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table project-x.gameaccount_type: ~4 rows (approximately)
DELETE FROM `gameaccount_type`;
/*!40000 ALTER TABLE `gameaccount_type` DISABLE KEYS */;
INSERT INTO `gameaccount_type` (`name`, `icondata`, `iconType`) VALUES
	('Battle.net', NULL, 'png'),
	('League of Legends', NULL, 'png'),
	('Origin', NULL, 'png'),
	('Steam', NULL, 'png'),
	('Uplay', NULL, 'png');
/*!40000 ALTER TABLE `gameaccount_type` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
