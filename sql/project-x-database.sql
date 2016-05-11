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
CREATE SCHEMA IF NOT EXISTS `project-x` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `project-x` ;

-- -----------------------------------------------------
-- Table `project-x`.`img_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`img_type` (
  `name` VARCHAR(20) NOT NULL COMMENT '',
  PRIMARY KEY (`name`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project-x`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`user` (
  `id` INT NOT NULL COMMENT '',
  `email` VARCHAR(200) NOT NULL COMMENT '',
  `username` VARCHAR(200) NOT NULL COMMENT '',
  `trusted` TINYINT(1) NULL COMMENT '',
  `password` VARCHAR(50) NOT NULL COMMENT '',
  `iconData` LONGBLOB NULL COMMENT '',
  `iconType` VARCHAR(20) NOT NULL COMMENT '',
  `coins` INT NULL COMMENT '',
  PRIMARY KEY (`id`, `iconType`)  COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '',
  UNIQUE INDEX `username_UNIQUE` (`username` ASC)  COMMENT '',
  UNIQUE INDEX `iduser_UNIQUE` (`id` ASC)  COMMENT '',
  INDEX `fk_user_img_type1_idx` (`iconType` ASC)  COMMENT '',
  CONSTRAINT `fk_user_img_type1`
    FOREIGN KEY (`iconType`)
    REFERENCES `project-x`.`img_type` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project-x`.`game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`game` (
  `id` INT NOT NULL COMMENT '',
  `name` VARCHAR(200) NOT NULL COMMENT '',
  `typ` VARCHAR(45) NOT NULL COMMENT '',
  `logoData` LONGBLOB NULL COMMENT '',
  `logoType` VARCHAR(20) NULL COMMENT '',
  `rules` TEXT NOT NULL COMMENT '',
  `genre` VARCHAR(100) NOT NULL COMMENT '',
  `timelimit` TIMESTAMP NOT NULL COMMENT '',
  PRIMARY KEY (`id`, `logoType`)  COMMENT '',
  INDEX `fk_game_img_type1_idx` (`logoType` ASC)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '',
  CONSTRAINT `fk_game_img_type1`
    FOREIGN KEY (`logoType`)
    REFERENCES `project-x`.`img_type` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project-x`.`lobby`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`lobby` (
  `id` INT NOT NULL COMMENT '',
  `owner_id` INT NOT NULL COMMENT '',
  `game_id` INT NOT NULL COMMENT '',
  `winnerteam` INT NULL COMMENT '',
  `screenshotData` LONGBLOB NULL COMMENT '',
  `screenshotType` VARCHAR(20) NOT NULL COMMENT '',
  `createdAt` TIMESTAMP NULL COMMENT '',
  `starttime` VARCHAR(45) NULL COMMENT '',
  `endtime` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`, `screenshotType`)  COMMENT '',
  INDEX `fk_lobby_game1_idx` (`game_id` ASC)  COMMENT '',
  INDEX `fk_lobby_user1_idx` (`owner_id` ASC)  COMMENT '',
  INDEX `fk_lobby_img_type1_idx` (`screenshotType` ASC)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '',
  CONSTRAINT `fk_lobby_game1`
    FOREIGN KEY (`game_id`)
    REFERENCES `project-x`.`game` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lobby_user1`
    FOREIGN KEY (`owner_id`)
    REFERENCES `project-x`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lobby_img_type1`
    FOREIGN KEY (`screenshotType`)
    REFERENCES `project-x`.`img_type` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project-x`.`bet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`bet` (
  `user_id` INT NOT NULL COMMENT '',
  `lobby_id` INT NOT NULL COMMENT '',
  `amount` INT NOT NULL COMMENT '',
  `team` INT NOT NULL COMMENT '',
  PRIMARY KEY (`user_id`, `lobby_id`)  COMMENT '',
  INDEX `fk_bet_lobby1_idx` (`lobby_id` ASC)  COMMENT '',
  CONSTRAINT `fk_bet_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `project-x`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bet_lobby1`
    FOREIGN KEY (`lobby_id`)
    REFERENCES `project-x`.`lobby` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project-x`.`gameaccount_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`gameaccount_type` (
  `name` VARCHAR(200) NOT NULL COMMENT '',
  `icondata` LONGBLOB NULL COMMENT '',
  `iconType` VARCHAR(20) NOT NULL COMMENT '',
  PRIMARY KEY (`name`, `iconType`)  COMMENT '',
  UNIQUE INDEX `name_UNIQUE` (`name` ASC)  COMMENT '',
  INDEX `fk_gameaccount_type_img_type1_idx` (`iconType` ASC)  COMMENT '',
  CONSTRAINT `fk_gameaccount_type_img_type1`
    FOREIGN KEY (`iconType`)
    REFERENCES `project-x`.`img_type` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `project-x`.`gameaccount`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-x`.`gameaccount` (
  `user_id` INT NOT NULL COMMENT '',
  `_type` VARCHAR(200) NOT NULL COMMENT '',
  `userIdentifier` VARCHAR(200) NULL COMMENT '',
  PRIMARY KEY (`user_id`, `_type`)  COMMENT '',
  INDEX `fk_gameaccount_gameaccount_types1_idx` (`_type` ASC)  COMMENT '',
  CONSTRAINT `fk_gameaccount_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `project-x`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_gameaccount_gameaccount_types1`
    FOREIGN KEY (`_type`)
    REFERENCES `project-x`.`gameaccount_type` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
