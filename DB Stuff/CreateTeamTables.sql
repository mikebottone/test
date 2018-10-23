
CREATE TABLE IF NOT EXISTS `reports` (
    `ID` BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `s_id` varchar(8) NOT NULL,
    `TeamNum` int(3) DEFAULT NULL,
    `Name` varchar(45) DEFAULT NULL,
    `Status` mediumtext,
    `Blockers` mediumtext,
    `Time Log` int, 
    `Team Health` varchar(45) DEFAULT NULL,
    `Concerns` mediumtext,
    `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
