-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema project-x
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema project-x
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `project-x` DEFAULT CHARACTER SET latin1 ;
USE `project-x` ;

-- -----------------------------------------------------
-- Table `project-x`.`game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`game` (
  `id` VARCHAR(255) NOT NULL COMMENT '',
  `name` VARCHAR(255) NOT NULL COMMENT '',
  `typ` VARCHAR(255) NOT NULL COMMENT '',
  `icon` VARCHAR(255) NULL COMMENT '',
  `rules` TEXT NOT NULL COMMENT '',
  `genre` VARCHAR(255) NOT NULL COMMENT '',
  `timelimit` INT UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`user` (
  `id` VARCHAR(255) NOT NULL COMMENT '',
  `email` VARCHAR(255) NOT NULL COMMENT '',
  `username` VARCHAR(255) NOT NULL COMMENT '',
  `trusted` TINYINT(1) NULL DEFAULT 0 COMMENT '',
  `password` VARCHAR(255) NOT NULL COMMENT '',
  `icon` VARCHAR(255) NULL COMMENT '',
  `coins` INT UNSIGNED NULL DEFAULT 0 COMMENT '',
  `createdAt` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '',
  UNIQUE INDEX `username_UNIQUE` (`username` ASC)  COMMENT '',
  UNIQUE INDEX `iduser_UNIQUE` (`id` ASC)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`lobby`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`lobby` (
  `id` VARCHAR(255) NOT NULL COMMENT '',
  `ownerId` VARCHAR(255) NOT NULL COMMENT '',
  `gameId` VARCHAR(255) NOT NULL COMMENT '',
  `winnerteam` TINYINT UNSIGNED NULL COMMENT '',
  `createdAt` INT UNSIGNED NOT NULL COMMENT '',
  `starttime` INT UNSIGNED NULL COMMENT '',
  `endtime` INT UNSIGNED NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '',
  INDEX `fk_lobby_game1_idx` (`gameId` ASC)  COMMENT '',
  INDEX `fk_lobby_user1_idx` (`ownerId` ASC)  COMMENT '',
  CONSTRAINT `fk_lobby_game1`
    FOREIGN KEY (`gameId`)
    REFERENCES `project-x`.`game` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lobby_user1`
    FOREIGN KEY (`ownerId`)
    REFERENCES `project-x`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`bet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`bet` (
  `userId` VARCHAR(255) NOT NULL COMMENT '',
  `lobbyId` VARCHAR(255) NOT NULL COMMENT '',
  `amount` SMALLINT UNSIGNED NOT NULL COMMENT '',
  `team` INT UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`userId`, `lobbyId`)  COMMENT '',
  INDEX `fk_bet_lobby1_idx` (`lobbyId` ASC)  COMMENT '',
  CONSTRAINT `fk_bet_lobby1`
    FOREIGN KEY (`lobbyId`)
    REFERENCES `project-x`.`lobby` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bet_user`
    FOREIGN KEY (`userId`)
    REFERENCES `project-x`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`gameaccountType`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`gameaccountType` (
  `id` VARCHAR(255) NOT NULL COMMENT '',
  `name` VARCHAR(255) NOT NULL COMMENT '',
  `icon` VARCHAR(255) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `name_UNIQUE` (`name` ASC)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`gameaccount`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`gameaccount` (
  `userId` VARCHAR(255) NOT NULL COMMENT '',
  `userIdentifier` VARCHAR(255) NULL COMMENT '',
  `gameaccountTypeId` VARCHAR(255) NOT NULL COMMENT '',
  PRIMARY KEY (`userId`, `gameaccountTypeId`)  COMMENT '',
  INDEX `fk_gameaccount_gameaccount_type1_idx` (`gameaccountTypeId` ASC)  COMMENT '',
  CONSTRAINT `fk_gameaccount_user1`
    FOREIGN KEY (`userId`)
    REFERENCES `project-x`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_gameaccount_gameaccount_type1`
    FOREIGN KEY (`gameaccountTypeId`)
    REFERENCES `project-x`.`gameaccountType` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`screenshot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`screenshot` (
  `id` VARCHAR(255) NOT NULL COMMENT '',
  `source` VARCHAR(255) NOT NULL COMMENT '',
  `lobbyId` VARCHAR(255) NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_screenshot_lobby1_idx` (`lobbyId` ASC)  COMMENT '',
  CONSTRAINT `fk_screenshot_lobby1`
    FOREIGN KEY (`lobbyId`)
    REFERENCES `project-x`.`lobby` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;





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
INSERT INTO `bet` (`userId`, `lobbyId`, `amount`, `team`) VALUES
	('e46f9777eccf37189d5e3e7c4173b0e3', '6602d1161f805becdc0ccb110c379ee5', 500, 0),
	('8b2ca685515eb967ccf945070ed0207f', '6602d1161f805becdc0ccb110c379ee5', 500, 1);
/*!40000 ALTER TABLE `bet` ENABLE KEYS */;

-- Dumping data for table project-x.game: ~2 rows (approximately)
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` (`id`, `name`, `typ`, `icon`, `rules`, `genre`, `timelimit`) VALUES
	('b6014be3093b7cad6c583b36ac99f657', 'League of Legends', '5vs5', NULL, 'Create custom game invite all players', 'moba', '10800'),
	('632924b0d6f8b60ad11638baee1913d0', 'League of Legends', '1vs1', NULL, 'Create custom game and invite enemy', 'moba', '7200');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;

-- Dumping data for table project-x.gameaccount: ~3 rows (approximately)
/*!40000 ALTER TABLE `gameaccount` DISABLE KEYS */;
INSERT INTO `gameaccount` (`userId`, `gameaccountTypeId`, `userIdentifier`) VALUES
	('e46f9777eccf37189d5e3e7c4173b0e3', 'bdc5a38f172670e0931f1d7624a45f8c', 'dorbird#2378'),
	('e46f9777eccf37189d5e3e7c4173b0e3', 'e1d0bbe910e3eb4d973973a4de3c5ddd', 'BirdTheBest'),
	('e46f9777eccf37189d5e3e7c4173b0e3', '377be8d9369f1c15015c886a79bcb19b', 'dor_bird');
/*!40000 ALTER TABLE `gameaccount` ENABLE KEYS */;

-- Dumping data for table project-x.gameaccountType: ~5 rows (approximately)
/*!40000 ALTER TABLE `gameaccountType` DISABLE KEYS */;
INSERT INTO `gameaccountType` (`id`, `name`, `icon`) VALUES
	('bdc5a38f172670e0931f1d7624a45f8c', 'Battle.net', NULL),
	('e1d0bbe910e3eb4d973973a4de3c5ddd', 'League of Legends', NULL),
	('3edf8ca26a1ec14dd6e91dd277ae1de6', 'Origin', NULL),
	('4db4563826bad0eb2f60ee6e42d0ea4b', 'Steam', NULL),
	('377be8d9369f1c15015c886a79bcb19b', 'Uplay', NULL);
/*!40000 ALTER TABLE `gameaccountType` ENABLE KEYS */;

-- Dumping data for table project-x.lobby: ~1 rows (approximately)
/*!40000 ALTER TABLE `lobby` DISABLE KEYS */;
INSERT INTO `lobby` (`id`, `ownerId`, `gameId`, `winnerteam`, `createdAt`, `starttime`, `endtime`) VALUES
	('6602d1161f805becdc0ccb110c379ee5', 'e46f9777eccf37189d5e3e7c4173b0e3', 'b6014be3093b7cad6c583b36ac99f657', NULL, 1469389720, NULL, NULL);
/*!40000 ALTER TABLE `lobby` ENABLE KEYS */;

-- Dumping data for table project-x.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `createdAt`, `email`, `username`, `trusted`, `password`, `icon`, `coins`) VALUES
	('e46f9777eccf37189d5e3e7c4173b0e3', 1469389720, 'jonas@oja.de', 'jonasoja', true, 'geheim', NULL, 10000),
	('8b2ca685515eb967ccf945070ed0207f', 1469389720, 'max@mustermann.de', 'maxmustermann', false, 'password', NULL, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping data for table project-x.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `screenshot` DISABLE KEYS */;
INSERT INTO `screenshot` (`id`, `lobbyId`, `source`) VALUES
	('3f7c652823db57cee604a66a127ef09f', '6602d1161f805becdc0ccb110c379ee5', 'http://images.akamai.steamusercontent.com/ugc/362903713110000756/572369BEB6DA8B6832E704132D86B900B0CD1026/'),
    ('6aaf999daf9853de66fd8ab641b3d372', '6602d1161f805becdc0ccb110c379ee5', 'http://images.akamai.steamusercontent.com/ugc/281847490916288370/EE7BFE30892DC177BF637A2306F31A7110664233/');
/*!40000 ALTER TABLE `screenshot` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;