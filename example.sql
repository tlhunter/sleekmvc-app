-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 17, 2011 at 11:40 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `annarbor`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `all_data`
--
CREATE TABLE `all_data` (
`id` int(10) unsigned
,`name` varchar(32)
,`state_id` int(10) unsigned
,`career_id` int(10) unsigned
,`state` varchar(32)
,`career` varchar(32)
,`industry_id` int(10) unsigned
,`industry` varchar(32)
);
-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE `career` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `industry_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `industry_id` (`industry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `career`
--

INSERT INTO `career` (`id`, `name`, `industry_id`) VALUES
(1, 'Programmer', 3),
(2, 'Caretaker', 1);

-- --------------------------------------------------------

--
-- Table structure for table `industry`
--

CREATE TABLE `industry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `industry`
--

INSERT INTO `industry` (`id`, `name`) VALUES
(2, 'Education'),
(3, 'Information Technology'),
(1, 'Medical'),
(4, 'Military');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `career_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`),
  KEY `career_id` (`career_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `name`, `state_id`, `career_id`) VALUES
(1, 'Thomas Hunter', 1, 2),
(2, 'Jessica Savage', 2, 1),
(3, 'Jobless Joe', 3, NULL),
(4, 'Sandy', 1, 2),
(43, 'test', 3, NULL),
(44, 'test', 3, NULL),
(45, 'test', 3, NULL),
(46, 'test', 3, NULL),
(47, 'test', 3, NULL),
(48, 'test', 3, NULL),
(49, 'test', 3, NULL),
(50, 'test', 3, NULL),
(51, 'test', 3, NULL),
(52, 'test', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `name`) VALUES
(4, 'Florida'),
(1, 'Michigan'),
(2, 'New York'),
(3, 'Washington');

-- --------------------------------------------------------

--
-- Structure for view `all_data`
--
DROP TABLE IF EXISTS `all_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_data` AS select `people`.`id` AS `id`,`people`.`name` AS `name`,`people`.`state_id` AS `state_id`,`people`.`career_id` AS `career_id`,`state`.`name` AS `state`,`career`.`name` AS `career`,`industry`.`id` AS `industry_id`,`industry`.`name` AS `industry` from (((`people` left join `career` on((`people`.`career_id` = `career`.`id`))) left join `state` on((`people`.`state_id` = `state`.`id`))) left join `industry` on((`career`.`industry_id` = `industry`.`id`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `career`
--
ALTER TABLE `career`
  ADD CONSTRAINT `career_ibfk_1` FOREIGN KEY (`industry_id`) REFERENCES `industry` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `people_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `people_ibfk_2` FOREIGN KEY (`career_id`) REFERENCES `career` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
