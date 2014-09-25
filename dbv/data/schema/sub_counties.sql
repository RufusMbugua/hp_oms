CREATE TABLE `sub_counties` (
  `sub_county_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_county_name` varchar(200) DEFAULT NULL,
  `county_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_county_id`),
  KEY `fk_sub_counties_counties1_idx` (`county_id`),
  CONSTRAINT `fk_sub_counties_counties1` FOREIGN KEY (`county_id`) REFERENCES `counties` (`county_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1