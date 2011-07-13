-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2010 at 03:20 PM
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
(1, 3, 0, 1, 0, 7, 3),
(2, 3, 0, 1, 0, 8, 1),
(3, 3, 0, 1, 0, 8, 1),
(4, 3, 0, 1, 0, 1, 1),
(6, 3, 2, 1, 0, 15, 1),
(7, 3, 0, 1, 0, 3, 3),
(8, 3, 0, 1, 0, 9, 3),
(9, 3, 0, 1, 0, 2, 3),
(10, 3, 0, 2, 0, 2, 5),
(1, 4, 0, 1, 0, 1, 4),
(2, 4, 0, 1, 0, 0, 1),
(3, 4, 0, 1, 0, 1, 2),
(4, 4, 0, 1, 0, 13, 5),
(5, 4, 0, 1, 0, 7, 5),
(6, 4, 0, 1, 0, 14, 4),
(7, 4, 0, 1, 0, 0, 1),
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
(5, 10, 0, 1, 0, 14, 5),
(6, 10, 0, 1, 0, 11, 5),
(7, 10, 0, 1, 0, 3, 5),
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
  `account` int(11) NOT NULL,
  `last_cash_in` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `account`, `last_cash_in`) VALUES
(1, 'jordan@sitegoals.com', 'Jordan', '6d0b5848f76536df0c5b808a15b6ac1c', 640, '2010-10-07 15:14:18'),
(2, 'kyle@sitegoals.com', 'Kyle', '6d0b5848f76536df0c5b808a15b6ac1c', 692, '2010-10-07 15:10:39'),
(0, 'test@sitegoals.com', 'Nameless', '6d0b5848f76536df0c5b808a15b6ac1c', 0, '2010-10-07 00:00:00');
