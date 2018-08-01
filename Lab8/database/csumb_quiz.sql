-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2017 at 01:28 AM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `csumb_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE IF NOT EXISTS `scores` (
  `scoreId` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `score` tinyint(3) unsigned NOT NULL,
  `submissionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`scoreId`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`scoreId`, `username`, `score`, `submissionDate`) VALUES
(1, 'user_1', 2, '2017-09-04 00:00:00'),
(2, 'user_1', 1, '2017-09-04 00:00:00'),
(3, 'user_1', 2, '2017-09-04 00:00:00'),
(4, 'user_1', 1, '2017-09-04 00:00:00'),
(5, 'user_1', 2, '2017-09-04 00:00:00'),
(6, 'user_1', 2, '2017-09-04 00:00:00'),
(7, 'user_1', 0, '2017-09-05 00:00:00'),
(8, 'user_1', 0, '2017-09-05 00:00:00'),
(9, 'user_1', 1, '2017-09-05 00:00:00'),
(10, 'user_1', 1, '2017-09-05 00:00:00'),
(11, 'user_1', 0, '2017-09-05 00:00:00'),
(12, 'user_1', 1, '2017-09-05 00:00:00'),
(13, 'user_1', 2, '2017-09-05 00:00:00'),
(14, 'user_2', 2, '2017-09-05 01:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `username` (`username`),
  KEY `username_2` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`) VALUES
(1, 'user_1', '25ab86bed149ca6ca9c1c0d5db7c9a91388ddeab'),
(2, 'user_2', '25ab86bed149ca6ca9c1c0d5db7c9a91388ddeab');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
