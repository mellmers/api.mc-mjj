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
-- Table `project-x`.`img_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`img_type` (
  `name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`name`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`game` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200) NOT NULL,
  `typ` VARCHAR(45) NOT NULL,
  `logoData` LONGBLOB NULL DEFAULT NULL,
  `logoType` VARCHAR(20) NOT NULL,
  `rules` TEXT NOT NULL,
  `genre` VARCHAR(100) NOT NULL,
  `timelimit` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`, `logoType`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_game_img_type1_idx` (`logoType` ASC),
  CONSTRAINT `fk_game_img_type1`
    FOREIGN KEY (`logoType`)
    REFERENCES `project-x`.`img_type` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`user` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(200) NOT NULL,
  `username` VARCHAR(200) NOT NULL,
  `trusted` TINYINT(1) NULL DEFAULT NULL,
  `password` VARCHAR(50) NOT NULL,
  `iconData` LONGBLOB NULL DEFAULT NULL,
  `iconType` VARCHAR(20) NOT NULL,
  `coins` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `iconType`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `iduser_UNIQUE` (`id` ASC),
  INDEX `fk_user_img_type1_idx` (`iconType` ASC),
  CONSTRAINT `fk_user_img_type1`
    FOREIGN KEY (`iconType`)
    REFERENCES `project-x`.`img_type` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`lobby`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`lobby` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `owner_id` INT(11) UNSIGNED NOT NULL,
  `game_id` INT(11) UNSIGNED NOT NULL,
  `winnerteam` INT(11) NULL DEFAULT NULL,
  `screenshotData` LONGBLOB NULL DEFAULT NULL,
  `screenshotType` VARCHAR(20) NOT NULL,
  `createdAt` TIMESTAMP NULL DEFAULT NULL,
  `starttime` VARCHAR(45) NULL DEFAULT NULL,
  `endtime` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `screenshotType`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_lobby_game1_idx` (`game_id` ASC),
  INDEX `fk_lobby_user1_idx` (`owner_id` ASC),
  INDEX `fk_lobby_img_type1_idx` (`screenshotType` ASC),
  CONSTRAINT `fk_lobby_game1`
    FOREIGN KEY (`game_id`)
    REFERENCES `project-x`.`game` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lobby_img_type1`
    FOREIGN KEY (`screenshotType`)
    REFERENCES `project-x`.`img_type` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lobby_user1`
    FOREIGN KEY (`owner_id`)
    REFERENCES `project-x`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`bet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`bet` (
  `user_id` INT(11) UNSIGNED NOT NULL,
  `lobby_id` INT(11) UNSIGNED NOT NULL,
  `amount` INT(11) NOT NULL,
  `team` INT(11) NOT NULL,
  PRIMARY KEY (`user_id`, `lobby_id`),
  INDEX `fk_bet_lobby1_idx` (`lobby_id` ASC),
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
  `name` VARCHAR(200) NOT NULL,
  `icondata` LONGBLOB NULL DEFAULT NULL,
  `iconType` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`name`, `iconType`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  INDEX `fk_gameaccount_type_img_type1_idx` (`iconType` ASC),
  CONSTRAINT `fk_gameaccount_type_img_type1`
    FOREIGN KEY (`iconType`)
    REFERENCES `project-x`.`img_type` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-x`.`gameaccount`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`gameaccount` (
  `user_id` INT(11) UNSIGNED NOT NULL,
  `_type` VARCHAR(200) NOT NULL,
  `userIdentifier` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`, `_type`),
  INDEX `fk_gameaccount_gameaccount_types1_idx` (`_type` ASC),
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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
