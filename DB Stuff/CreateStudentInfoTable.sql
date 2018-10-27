CREATE TABLE `studentinfo` (
  `Name` varchar(255) DEFAULT NULL,
  `s_id` varchar(255) NOT NULL,
  `TeamNum` int(11) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
