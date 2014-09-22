CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `pct_id` int(11) NOT NULL,
  `project_name` varchar(200) DEFAULT NULL,
  `project_description` text,
  `project_url` varchar(200) DEFAULT NULL,
  `project_date_added` varchar(20) DEFAULT NULL,
  `project_last_updated` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`project_id`),
  KEY `fk_projects_project_categories1_idx` (`pct_id`),
  CONSTRAINT `fk_projects_project_categories1` FOREIGN KEY (`pct_id`) REFERENCES `project_categories` (`pct_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1