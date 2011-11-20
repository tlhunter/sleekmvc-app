-- Data for the sample SleekMVC app

CREATE TABLE `clicks` (
  `url_id` bigint(20) NOT NULL,
  `year` year(4) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `count` int(11) NOT NULL,
  KEY `url_id` (`url_id`,`year`,`month`,`count`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE `url` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `url` varchar(511) COLLATE latin1_general_ci NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;