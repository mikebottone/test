CREATE TABLE `reports` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `s_id` varchar(8) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Week` varchar(100) DEFAULT NULL,
  `Status` mediumtext,
  `Blockers` mediumtext,
  `Team Health` varchar(45) DEFAULT NULL,
  `Concerns` mediumtext,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Label` varchar(100) DEFAULT NULL,
  `Grade` INT(3) DEFAULT NULL,
  `Comments` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
