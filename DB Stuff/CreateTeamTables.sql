-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`team 1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `team 1` (
  `s_id` varchar(11) NOT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  `Status` MEDIUMTEXT NULL DEFAULT NULL,
  `Blockers` MEDIUMTEXT NULL DEFAULT NULL,
  `Time Log` INT(11) NULL DEFAULT NULL,
  `Team Health` VARCHAR(45) NULL DEFAULT NULL,
  `Concerns` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `mydb`.`team 2`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`team 2` (
  `s_id` varchar(11) NOT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  `Status` MEDIUMTEXT NULL DEFAULT NULL,
  `Blockers` MEDIUMTEXT NULL DEFAULT NULL,
  `Time Log` INT(11) NULL DEFAULT NULL,
  `Team Health` VARCHAR(45) NULL DEFAULT NULL,
  `Concerns` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `mydb`.`team 3`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`team 3` (
  `s_id` varchar(11) NOT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  `Status` MEDIUMTEXT NULL DEFAULT NULL,
  `Blockers` MEDIUMTEXT NULL DEFAULT NULL,
  `Time Log` INT(11) NULL DEFAULT NULL,
  `Team Health` VARCHAR(45) NULL DEFAULT NULL,
  `Concerns` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `mydb`.`team 4`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`team 4` (
  `s_id` varchar(11) NOT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  `Status` MEDIUMTEXT NULL DEFAULT NULL,
  `Blockers` MEDIUMTEXT NULL DEFAULT NULL,
  `Time Log` INT(11) NULL DEFAULT NULL,
  `Team Health` VARCHAR(45) NULL DEFAULT NULL,
  `Concerns` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE TABLE IF NOT EXISTS `mydb`.`team 5` (
  `s_id` varchar(11) NOT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  `Status` MEDIUMTEXT NULL DEFAULT NULL,
  `Blockers` MEDIUMTEXT NULL DEFAULT NULL,
  `Time Log` INT(11) NULL DEFAULT NULL,
  `Team Health` VARCHAR(45) NULL DEFAULT NULL,
  `Concerns` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE TABLE IF NOT EXISTS `mydb`.`team 6` (
  `s_id` varchar(11) NOT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  `Status` MEDIUMTEXT NULL DEFAULT NULL,
  `Blockers` MEDIUMTEXT NULL DEFAULT NULL,
  `Time Log` INT(11) NULL DEFAULT NULL,
  `Team Health` VARCHAR(45) NULL DEFAULT NULL,
  `Concerns` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE TABLE IF NOT EXISTS `mydb`.`team 7` (
  `s_id` varchar(11) NOT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  `Status` MEDIUMTEXT NULL DEFAULT NULL,
  `Blockers` MEDIUMTEXT NULL DEFAULT NULL,
  `Time Log` INT(11) NULL DEFAULT NULL,
  `Team Health` VARCHAR(45) NULL DEFAULT NULL,
  `Concerns` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE TABLE IF NOT EXISTS `mydb`.`team 8` (
  `s_id` varchar(11) NOT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  `Status` MEDIUMTEXT NULL DEFAULT NULL,
  `Blockers` MEDIUMTEXT NULL DEFAULT NULL,
  `Time Log` INT(11) NULL DEFAULT NULL,
  `Team Health` VARCHAR(45) NULL DEFAULT NULL,
  `Concerns` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE TABLE IF NOT EXISTS `mydb`.`team 9` (
  `s_id` varchar(11) NOT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  `Status` MEDIUMTEXT NULL DEFAULT NULL,
  `Blockers` MEDIUMTEXT NULL DEFAULT NULL,
  `Time Log` INT(11) NULL DEFAULT NULL,
  `Team Health` VARCHAR(45) NULL DEFAULT NULL,
  `Concerns` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE TABLE IF NOT EXISTS `mydb`.`team 10` (
  `s_id` varchar(11) NOT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  `Status` MEDIUMTEXT NULL DEFAULT NULL,
  `Blockers` MEDIUMTEXT NULL DEFAULT NULL,
  `Time Log` INT(11) NULL DEFAULT NULL,
  `Team Health` VARCHAR(45) NULL DEFAULT NULL,
  `Concerns` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
