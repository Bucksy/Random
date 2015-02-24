-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 24, 2015 at 09:00 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `priority` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dueDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `priority`, `created`, `dueDate`) VALUES
(1, 'Task 10', 'Task 10', 1, '2015-01-20 15:00:00', '2015-01-20 16:00:00'),
(2, 'Task 2', 'Description 2', 2, '2015-01-20 15:00:00', '2015-01-20 03:00:00'),
(3, 'Task 3', 'Description 3', 2, '2015-02-11 05:14:08', '2015-02-16 06:14:08'),
(4, 'Task 4', 'Description 4', 1, '2015-02-19 06:14:08', '2015-02-20 15:14:08'),
(5, 'Task 5', 'Description 5', 2, '2015-03-19 06:14:08', '2015-03-20 06:14:08'),
(6, 'Task 6', 'Description 6', 1, '2015-04-19 05:14:08', '2015-04-20 05:14:08'),
(7, 'Task 7', 'Description 7', 0, '2015-05-19 05:18:08', '2015-05-22 05:18:08'),
(8, 'Task 8', 'Description 8', 1, '2015-05-25 05:18:08', '2015-05-26 05:18:08'),
(12, 'Task 12', 'Task 12', 2, '2015-01-20 15:00:00', '2015-01-20 16:00:00'),
(13, 'Task 13', 'Description 13', 2, '2015-01-20 15:00:00', '2015-01-20 16:00:00'),
(15, 'Task 26', 'Task 26', 1, '2015-01-20 15:00:00', '2015-01-20 16:00:00'),
(16, 'Task 25', 'Task 25', 1, '2015-02-19 18:15:59', '2015-01-20 16:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
