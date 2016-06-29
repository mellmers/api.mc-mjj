-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

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
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(200) NOT NULL COMMENT '',
  `typ` VARCHAR(45) NOT NULL COMMENT '',
  `icon` VARCHAR(255) NULL DEFAULT NULL COMMENT '',
  `rules` TEXT NOT NULL COMMENT '',
  `genre` VARCHAR(100) NOT NULL COMMENT '',
  `timelimit` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`user` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `email` VARCHAR(200) NOT NULL COMMENT '',
  `username` VARCHAR(200) NOT NULL COMMENT '',
  `trusted` TINYINT(1) NULL DEFAULT NULL COMMENT '',
  `password` VARCHAR(50) NOT NULL COMMENT '',
  `icon` VARCHAR(255) NULL DEFAULT NULL COMMENT '',
  `coins` INT(11) NULL DEFAULT 0 COMMENT '',
  `createdAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '',
  UNIQUE INDEX `username_UNIQUE` (`username` ASC)  COMMENT '',
  UNIQUE INDEX `iduser_UNIQUE` (`id` ASC)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`lobby`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`lobby` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `owner_id` INT(11) UNSIGNED NOT NULL COMMENT '',
  `game_id` INT(11) UNSIGNED NOT NULL COMMENT '',
  `winnerteam` INT(11) NULL DEFAULT NULL COMMENT '',
  `createdAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  `starttime` TIMESTAMP NULL DEFAULT NULL COMMENT '',
  `endtime` TIMESTAMP NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '',
  INDEX `fk_lobby_game1_idx` (`game_id` ASC)  COMMENT '',
  INDEX `fk_lobby_user1_idx` (`owner_id` ASC)  COMMENT '',
  CONSTRAINT `fk_lobby_game1`
    FOREIGN KEY (`game_id`)
    REFERENCES `project-x`.`game` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lobby_user1`
    FOREIGN KEY (`owner_id`)
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
  `user_id` INT(11) UNSIGNED NOT NULL COMMENT '',
  `lobby_id` INT(11) UNSIGNED NOT NULL COMMENT '',
  `amount` INT(11) NOT NULL COMMENT '',
  `team` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`user_id`, `lobby_id`)  COMMENT '',
  INDEX `fk_bet_lobby1_idx` (`lobby_id` ASC)  COMMENT '',
  CONSTRAINT `fk_bet_lobby1`
    FOREIGN KEY (`lobby_id`)
    REFERENCES `project-x`.`lobby` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bet_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `project-x`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`gameaccount_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`gameaccount_type` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `name` VARCHAR(200) NOT NULL COMMENT '',
  `icon` VARCHAR(255) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `name_UNIQUE` (`name` ASC)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`gameaccount`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`gameaccount` (
  `user_id` INT(11) UNSIGNED NOT NULL COMMENT '',
  `userIdentifier` VARCHAR(200) NULL DEFAULT NULL COMMENT '',
  `gameaccount_type_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`user_id`, `gameaccount_type_id`)  COMMENT '',
  INDEX `fk_gameaccount_gameaccount_type1_idx` (`gameaccount_type_id` ASC)  COMMENT '',
  CONSTRAINT `fk_gameaccount_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `project-x`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_gameaccount_gameaccount_type1`
    FOREIGN KEY (`gameaccount_type_id`)
    REFERENCES `project-x`.`gameaccount_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`screenshot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`screenshot` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `source` VARCHAR(255) NOT NULL COMMENT '',
  `lobby_id` INT(11) UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_screenshot_lobby1_idx` (`lobby_id` ASC)  COMMENT '',
  CONSTRAINT `fk_screenshot_lobby1`
    FOREIGN KEY (`lobby_id`)
    REFERENCES `project-x`.`lobby` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


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
INSERT INTO `bet` (`user_id`, `lobby_id`, `amount`, `team`) VALUES
	(1, 1, 500, 0),
	(2, 1, 500, 1);
/*!40000 ALTER TABLE `bet` ENABLE KEYS */;

-- Dumping data for table project-x.game: ~2 rows (approximately)
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` (`id`, `name`, `typ`, `icon`, `rules`, `genre`, `timelimit`) VALUES
	(1, 'League of Legends', '5vs5', NULL, 'Create custom game invite all players', 'moba', '10800'),
	(2, 'League of Legends', '1vs1', NULL, 'Create custom game and invite enemy', 'moba', '7200');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;

-- Dumping data for table project-x.gameaccount: ~3 rows (approximately)
/*!40000 ALTER TABLE `gameaccount` DISABLE KEYS */;
INSERT INTO `gameaccount` (`user_id`, `gameaccount_type_id`, `userIdentifier`) VALUES
	(1, 1, 'dorbird#2378'),
	(1, 2, 'BirdTheBest'),
	(1, 5, 'dor_bird');
/*!40000 ALTER TABLE `gameaccount` ENABLE KEYS */;

-- Dumping data for table project-x.gameaccount_type: ~5 rows (approximately)
/*!40000 ALTER TABLE `gameaccount_type` DISABLE KEYS */;
INSERT INTO `gameaccount_type` (`id`, `name`, `icon`) VALUES
	(1, 'Battle.net', NULL),
	(2, 'League of Legends', NULL),
	(3, 'Origin', NULL),
	(4, 'Steam', NULL),
	(5, 'Uplay', NULL);
/*!40000 ALTER TABLE `gameaccount_type` ENABLE KEYS */;

-- Dumping data for table project-x.lobby: ~1 rows (approximately)
/*!40000 ALTER TABLE `lobby` DISABLE KEYS */;
INSERT INTO `lobby` (`id`, `owner_id`, `game_id`, `winnerteam`, `createdAt`, `starttime`, `endtime`) VALUES
	(1, 1, 1, NULL,'2016-05-27 12:34:54', NULL, NULL);
/*!40000 ALTER TABLE `lobby` ENABLE KEYS */;

-- Dumping data for table project-x.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `username`, `trusted`, `password`, `icon`, `coins`) VALUES
	(1, 'jonas@oja.de', 'jonasoja', NULL, 'geheim', NULL, 10000),
	(2, 'max@musterman.de', 'maxmusterman', NULL, 'password', NULL, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping data for table project-x.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `screenshot` DISABLE KEYS */;
INSERT INTO `screenshot` (`id`, `lobby_id`, `source`) VALUES
	(1, 0, 'http://images.akamai.steamusercontent.com/ugc/362903713110000756/572369BEB6DA8B6832E704132D86B900B0CD1026/'),
    (2, 0, 'http://images.akamai.steamusercontent.com/ugc/281847490916288370/EE7BFE30892DC177BF637A2306F31A7110664233/');
/*!40000 ALTER TABLE `screenshot` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;