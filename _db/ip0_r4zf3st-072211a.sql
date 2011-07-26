-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 22, 2011 at 03:52 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ip0_r4zf3st`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `company`
--


-- --------------------------------------------------------

--
-- Table structure for table `company_event`
--

DROP TABLE IF EXISTS `company_event`;
CREATE TABLE IF NOT EXISTS `company_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `valuation` int(11) NOT NULL DEFAULT '0',
  `valuation_change` int(11) NOT NULL DEFAULT '0',
  `event_type` tinyint(4) NOT NULL DEFAULT '1',
  `notes` varchar(250) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `company_event`
--

INSERT INTO `company_event` (`id`, `company_id`, `valuation`, `valuation_change`, `event_type`, `notes`, `created`) VALUES
(1, 2, 20, 0, 1, NULL, '2011-07-19 09:43:14'),
(2, 2, 18, -2, 1, NULL, '2011-07-20 09:43:14'),
(3, 2, 21, 3, 1, NULL, '2011-07-21 09:42:57'),
(4, 2, 25, 4, 1, NULL, '2011-07-22 09:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `project`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_tag`
--

DROP TABLE IF EXISTS `project_tag`;
CREATE TABLE IF NOT EXISTS `project_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `lvl` int(11) NOT NULL DEFAULT '0',
  `turns_to_complete` int(11) NOT NULL,
  `completed` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `project_tag`
--

INSERT INTO `project_tag` (`id`, `company_id`, `project_id`, `tag_id`, `lvl`, `turns_to_complete`, `completed`) VALUES
(1, 2, 1, 1, 1, 38, '0000-00-00 00:00:00'),
(2, 2, 1, 4, 2, 67, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `company` int(11) NOT NULL,
  `worth` int(11) NOT NULL DEFAULT '0',
  `hire_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `company`, `worth`, `hire_date`) VALUES
(1, 'Frank Sinatra', 0, 0, '0000-00-00 00:00:00'),
(2, 'Sally Fields', 0, 0, '0000-00-00 00:00:00'),
(3, 'Garry Lutz', 2, 0, '0000-00-00 00:00:00'),
(4, 'Barry Lutz', 2, 0, '0000-00-00 00:00:00'),
(5, 'Marry Lutz', 2, 0, '0000-00-00 00:00:00'),
(6, 'Harry Lutz', 2, 0, '0000-00-00 00:00:00'),
(7, 'Mike Dobson', 2, 0, '2011-07-22 14:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `staff_tag`
--

DROP TABLE IF EXISTS `staff_tag`;
CREATE TABLE IF NOT EXISTS `staff_tag` (
  `staff_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `tag_lvl` int(11) NOT NULL DEFAULT '0',
  `tag_points` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_tag`
--

INSERT INTO `staff_tag` (`staff_id`, `tag_id`, `tag_lvl`, `tag_points`) VALUES
(3, 1, 4, 0),
(3, 2, 1, 2),
(3, 3, 2, 4),
(4, 1, 2, 10),
(4, 4, 3, 0),
(5, 5, 1, 7),
(5, 3, 1, 0),
(6, 6, 4, 4),
(6, 4, 1, 0),
(6, 7, 3, 0),
(1, 5, 4, 0),
(1, 4, 1, 0),
(2, 6, 3, 0),
(2, 1, 3, 0),
(7, 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `valueation` int(11) NOT NULL,
  `tag_category` int(11) NOT NULL,
  `updated` datetime NOT NULL,
  `craeted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `valueation`, `tag_category`, `updated`, `craeted`) VALUES
(1, 'Android', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'iOS', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Blackberry', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Photo Sharing', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Social Media', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Cloud', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Music', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'MMO', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Community', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Crowd Sourcing', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tag_event`
--

DROP TABLE IF EXISTS `tag_event`;
CREATE TABLE IF NOT EXISTS `tag_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `valuation_change` int(11) NOT NULL,
  `event_type` tinyint(4) NOT NULL DEFAULT '1',
  `notes` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tag_event`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `password` varchar(64) NOT NULL,
  `account` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `account`) VALUES
(1, 'jordan@sitegoals.com', 'Jordan', '6d0b5848f76536df0c5b808a15b6ac1c', 640),
(2, 'kyle@sitegoals.com', 'Kyle', '6d0b5848f76536df0c5b808a15b6ac1c', 261091),
(12, 'test@sitegoals.com', 'Nameless', '6d0b5848f76536df0c5b808a15b6ac1c', 10536),
(3, 'chiliconqueso@gmail.com', 'Keith', '6d0b5848f76536df0c5b808a15b6ac1c', 0),
(4, 'spartacus05@gmail.com', 'Seth', '6d0b5848f76536df0c5b808a15b6ac1c', 0);
