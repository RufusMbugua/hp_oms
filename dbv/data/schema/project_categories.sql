CREATE TABLE `project_categories` (
  `pct_id` int(11) NOT NULL AUTO_INCREMENT,
  `pct_name` varchar(45) DEFAULT NULL,
  `pct_description` text,
  `pct_date_added` varchar(20) DEFAULT NULL,
  `pct_last_updated` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`pct_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1