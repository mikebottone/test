
CREATE TABLE IF NOT EXISTS `reports` (
    `ID` BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `s_id` varchar(8) NOT NULL,
    `Name` varchar(45) DEFAULT NULL,
	`Week` varchar(100) DEFAULT NULL, 
    `Status` mediumtext,
    `Blockers` mediumtext,
    `Team Health` varchar(45) DEFAULT NULL,
    `Concerns` mediumtext,
    `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;