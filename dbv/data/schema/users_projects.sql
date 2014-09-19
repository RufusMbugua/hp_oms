CREATE TABLE `users_projects` (
  `usps_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `project_id` int(11) NOT NULL,
  `usps_date_added` varchar(20) DEFAULT NULL,
  `usps_last_updated` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`usps_id`),
  KEY `fk_users_projects_users1_idx` (`user_id`),
  KEY `fk_users_projects_projects1_idx` (`project_id`),
  CONSTRAINT `fk_users_projects_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_projects_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1