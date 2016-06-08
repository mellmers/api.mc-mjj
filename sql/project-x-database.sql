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
  `icon` VARCHAR(255) NULL COMMENT '',
  `rules` TEXT NOT NULL COMMENT '',
  `genre` VARCHAR(100) NOT NULL COMMENT '',
  `timelimit` INT NOT NULL DEFAULT 0 COMMENT '',
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
  `coins` INT(11) NULL DEFAULT NULL COMMENT '',
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
  `id` INT(11) UNSIGNED NOT NULL COMMENT '',
  `owner_id` INT(11) UNSIGNED NOT NULL COMMENT '',
  `game_id` INT(11) UNSIGNED NOT NULL COMMENT '',
  `winnerteam` INT(11) NULL DEFAULT NULL COMMENT '',
  `screenshots` VARCHAR(255) NULL DEFAULT NULL COMMENT '',
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
  `name` VARCHAR(200) NOT NULL COMMENT '',
  `icon` VARCHAR(255) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`name`)  COMMENT '',
  UNIQUE INDEX `name_UNIQUE` (`name` ASC)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`gameaccount`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`gameaccount` (
  `user_id` INT(11) UNSIGNED NOT NULL COMMENT '',
  `_type` VARCHAR(200) NOT NULL COMMENT '',
  `userIdentifier` VARCHAR(200) NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`user_id`, `_type`)  COMMENT '',
  INDEX `fk_gameaccount_gameaccount_types1_idx` (`_type` ASC)  COMMENT '',
  CONSTRAINT `fk_gameaccount_gameaccount_types1`
    FOREIGN KEY (`_type`)
    REFERENCES `project-x`.`gameaccount_type` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_gameaccount_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `project-x`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`img_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`img_type` (
  `name` VARCHAR(20) NOT NULL COMMENT '',
  PRIMARY KEY (`name`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
