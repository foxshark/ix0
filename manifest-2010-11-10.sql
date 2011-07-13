-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 10, 2010 at 01:39 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `manifest`
--

-- --------------------------------------------------------

--
-- Table structure for table `frac_grid`
--

DROP TABLE IF EXISTS `frac_grid`;
CREATE TABLE IF NOT EXISTS `frac_grid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` int(11) NOT NULL,
  `lon` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `popularity` int(11) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `frac_grid`
--

INSERT INTO `frac_grid` (`id`, `lat`, `lon`, `size`, `popularity`, `updated`, `created`) VALUES
(1, 0, 512, 512, 0, '2010-11-10 00:10:42', '0000-00-00 00:00:00'),
(2, 0, 768, 256, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 1024, 256, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 256, 1024, 256, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 256, 768, 256, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 512, 1024, 512, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 512, 512, 128, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 512, 384, 128, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 512, 256, 256, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 640, 512, 128, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 640, 384, 128, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 768, 512, 256, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 896, 256, 128, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 896, 128, 128, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 768, 256, 64, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 768, 192, 64, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 768, 128, 64, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 768, 64, 64, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 832, 256, 64, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 832, 192, 64, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 832, 128, 64, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 832, 64, 64, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `grid_square`
--

DROP TABLE IF EXISTS `grid_square`;
CREATE TABLE IF NOT EXISTS `grid_square` (
  `lat_id` int(11) NOT NULL,
  `lon_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `fort_lvl` int(11) NOT NULL,
  `ping_count` int(11) NOT NULL,
  `resource_value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grid_square`
--

INSERT INTO `grid_square` (`lat_id`, `lon_id`, `owner_id`, `lvl`, `fort_lvl`, `ping_count`, `resource_value`) VALUES
(1, 1, 2, 1, 1, 12, 5),
(2, 1, 1, 1, 1, 11, 5),
(3, 1, 2, 1, 1, 3, 5),
(4, 1, 2, 2, 1, 13, 2),
(5, 1, 2, 2, 1, 8, 2),
(7, 1, 1, 1, 1, 11, 5),
(8, 1, 0, 1, 0, 3, 1),
(9, 1, 0, 1, 0, 12, 2),
(10, 1, 0, 1, 0, 2, 2),
(1, 2, 0, 1, 0, 13, 4),
(2, 2, 2, 1, 0, 5, 1),
(3, 2, 2, 1, 0, 10, 5),
(4, 2, 0, 1, 0, 2, 1),
(6, 2, 0, 1, 0, 3, 4),
(7, 2, 0, 2, 0, 13, 4),
(9, 2, 0, 1, 0, 1, 5),
(10, 2, 0, 1, 0, 7, 3),
(1, 3, 2, 1, 1, 7, 3),
(2, 3, 2, 1, 1, 8, 1),
(3, 3, 0, 1, 0, 8, 1),
(4, 3, 0, 1, 0, 1, 1),
(6, 3, 2, 1, 0, 15, 1),
(7, 3, 2, 1, 1, 3, 3),
(8, 3, 0, 1, 0, 9, 3),
(9, 3, 0, 1, 0, 2, 3),
(10, 3, 0, 2, 0, 2, 5),
(1, 4, 0, 1, 0, 1, 4),
(2, 4, 0, 1, 0, 0, 1),
(3, 4, 0, 1, 0, 1, 2),
(4, 4, 0, 1, 0, 13, 5),
(5, 4, 0, 1, 0, 7, 5),
(6, 4, 0, 1, 0, 14, 4),
(7, 4, 2, 1, 3, 0, 1),
(8, 4, 0, 1, 0, 5, 4),
(9, 4, 0, 2, 0, 5, 1),
(10, 4, 0, 1, 0, 5, 4),
(1, 5, 0, 1, 0, 12, 5),
(2, 5, 0, 1, 0, 6, 3),
(3, 5, 0, 1, 0, 0, 2),
(4, 5, 0, 1, 0, 11, 1),
(5, 5, 0, 2, 0, 5, 3),
(6, 5, 0, 1, 0, 4, 5),
(7, 5, 0, 1, 0, 9, 3),
(8, 5, 0, 2, 0, 2, 1),
(9, 5, 0, 1, 0, 8, 4),
(10, 5, 0, 2, 0, 13, 1),
(1, 6, 0, 1, 0, 4, 1),
(2, 6, 0, 1, 0, 3, 5),
(3, 6, 0, 1, 0, 5, 1),
(4, 6, 0, 1, 0, 4, 4),
(5, 6, 0, 1, 0, 1, 3),
(6, 6, 0, 1, 0, 14, 4),
(7, 6, 0, 1, 0, 9, 3),
(8, 6, 0, 1, 0, 6, 4),
(9, 6, 0, 1, 0, 5, 2),
(10, 6, 0, 1, 0, 11, 3),
(1, 7, 0, 1, 0, 4, 5),
(2, 7, 0, 1, 0, 8, 1),
(3, 7, 0, 1, 0, 0, 1),
(4, 7, 0, 1, 0, 10, 3),
(5, 7, 0, 1, 0, 3, 5),
(6, 7, 0, 2, 0, 5, 5),
(7, 7, 0, 1, 0, 8, 2),
(8, 7, 0, 1, 0, 5, 5),
(9, 7, 0, 1, 0, 6, 2),
(10, 7, 0, 1, 0, 4, 4),
(1, 8, 0, 1, 0, 12, 3),
(2, 8, 0, 1, 0, 12, 1),
(3, 8, 0, 1, 0, 9, 5),
(4, 8, 0, 1, 0, 15, 4),
(5, 8, 0, 1, 0, 1, 2),
(6, 8, 0, 1, 0, 8, 4),
(7, 8, 0, 1, 0, 15, 4),
(8, 8, 0, 1, 0, 13, 3),
(9, 8, 0, 1, 0, 7, 2),
(10, 8, 0, 2, 0, 8, 3),
(1, 9, 0, 1, 0, 1, 5),
(2, 9, 0, 1, 0, 8, 3),
(3, 9, 0, 1, 0, 4, 4),
(4, 9, 0, 2, 0, 5, 1),
(5, 9, 0, 1, 0, 2, 5),
(6, 9, 0, 1, 0, 6, 5),
(7, 9, 0, 1, 0, 7, 2),
(8, 9, 0, 1, 0, 0, 5),
(9, 9, 0, 1, 0, 13, 2),
(10, 9, 0, 1, 0, 2, 2),
(1, 10, 0, 1, 0, 5, 3),
(2, 10, 0, 1, 0, 2, 1),
(3, 10, 0, 1, 0, 5, 4),
(4, 10, 0, 1, 0, 3, 2),
(5, 10, 11, 1, 2, 14, 5),
(6, 10, 11, 1, 1, 11, 5),
(7, 10, 11, 1, 1, 3, 5),
(8, 10, 0, 2, 0, 4, 4),
(9, 10, 0, 1, 0, 8, 1),
(10, 10, 0, 1, 0, 2, 1),
(6, 1, 2, 2, 0, 12, 4),
(5, 2, 2, 3, 0, 8, 2),
(5, 3, 2, 3, 2, 2, 1),
(8, 2, 2, 2, 1, 7, 3);

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
  `atk` int(11) NOT NULL DEFAULT '1',
  `def` int(11) NOT NULL DEFAULT '1',
  `xp` int(11) NOT NULL DEFAULT '0',
  `account` int(11) NOT NULL,
  `last_cash_in` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `atk`, `def`, `xp`, `account`, `last_cash_in`) VALUES
(1, 'jordan@sitegoals.com', 'Jordan', '6d0b5848f76536df0c5b808a15b6ac1c', 1, 1, 0, 640, '2010-10-07 15:14:18'),
(2, 'kyle@sitegoals.com', 'Kyle', '6d0b5848f76536df0c5b808a15b6ac1c', 1, 1, 0, 31654, '2010-11-10 07:26:33'),
(0, 'test@sitegoals.com', 'Nameless', '6d0b5848f76536df0c5b808a15b6ac1c', 1, 1, 0, 10536, '2010-10-08 20:10:24'),
(3, 'chiliconqueso@gmail.com', 'Keith', '6d0b5848f76536df0c5b808a15b6ac1c', 1, 1, 0, 0, '0000-00-00 00:00:00'),
(4, 'spartacus05@gmail.com', 'Seth', '6d0b5848f76536df0c5b808a15b6ac1c', 1, 1, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_rank`
--

DROP TABLE IF EXISTS `user_rank`;
CREATE TABLE IF NOT EXISTS `user_rank` (
  `user_id` int(11) NOT NULL,
  `grid_id` int(11) NOT NULL,
  `user_rank` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rank`
--

INSERT INTO `user_rank` (`user_id`, `grid_id`, `user_rank`, `created`) VALUES
(4, 12, 3, '2010-11-10 01:01:24'),
(3, 12, 2, '2010-11-10 01:01:24'),
(2, 12, 1, '2010-11-10 01:01:24'),
(1, 12, 4, '2010-11-10 01:01:24');
