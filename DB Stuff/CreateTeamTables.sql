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
-- Table `mydb`.`teams`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `teams` (
  `s_id` varchar(11) NOT NULL,
  `TeamNum` INT(3) NULL DEFAULT NULL,
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
