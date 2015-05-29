-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL DEFAULT 'Anonymous',
  `comment` mediumtext NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `comments`
--

INSERT INTO `comments` (`id`, `author`, `comment`, `createdDate`, `post_id`) VALUES
(1, 'book1', 'Hello world', '2015-05-26 11:41:12', 1),
(2, 'joro', 'comment number 2', '2015-05-26 14:52:17', 1),
(3, 'dsada', 'dsadgfdgdgdf', '2015-05-26 14:54:42', 6),
(4, 'Joro D.', 'Hello World!', '2015-05-26 14:56:16', 1),
(5, 'dasd', 'asdadasdasdas', '2015-05-26 14:56:54', 6),
(6, 'Huen', 'fdfsdsfdf', '2015-05-26 15:03:09', 6),
(7, 'Huen', 'Jason', '2015-05-27 07:35:32', 7),
(8, 'Huen', 'Nice post!!!!!!', '2015-05-27 09:38:08', 1),
(9, 'Nice Post', 'Test ttststs', '2015-05-27 11:12:23', 3),
(10, 'Testt', 'teststs', '2015-05-27 11:42:40', 6);

-- --------------------------------------------------------

--
-- Структура на таблица `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `created`, `userId`) VALUES
(1, 'Hello1111', 'worl1111', '2015-05-19 07:53:38', 2),
(2, 'test3', 'test', '2015-05-19 07:57:27', 2),
(3, 'Hello111', 'hello11111', '2015-05-19 07:58:05', 2),
(4, '1233', '123', '2015-05-19 08:00:33', 2),
(5, 'test', 'tedt', '2015-05-19 08:02:32', 2),
(6, '111111111', '1111111111', '2015-05-19 08:02:39', 2),
(7, 'test', 'test', '2015-05-19 08:33:50', 2),
(8, 'yeahhh', 'helllll', '2015-05-21 07:46:39', 2),
(9, 'yeahhh', 'Hello', '2015-05-26 07:43:28', 2),
(10, 'yeahhh', 'dfdfd', '2015-05-28 14:39:31', 2),
(11, 'safdasf', 'dfdsf', '2015-05-28 14:42:36', 2),
(12, 'efsd', 'fdsfdsfs', '2015-05-29 11:47:37', 2),
(13, 'Test tag', 'Test tagTest tagTest tagTest tagTest tagTest tag', '2015-05-29 11:54:15', 2),
(14, 'aaa', 'ddddddd', '2015-05-29 11:56:43', 2),
(15, 'aaa', 'sdfadsf', '2015-05-29 12:11:40', 2),
(16, 'huen', 'dfdsgds', '2015-05-29 12:14:10', 2),
(17, 'test', 'test', '2015-05-29 12:19:09', 2),
(18, 'dsfdsgf', 'dsgdsg', '2015-05-29 12:43:49', 2),
(19, 'yeahhh', 'hello', '2015-05-29 12:46:50', 2);

-- --------------------------------------------------------

--
-- Структура на таблица `posts_tags`
--

CREATE TABLE IF NOT EXISTS `posts_tags` (
`id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура на таблица `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(7, 'git12'),
(8, 'Huen'),
(9, 'git1'),
(10, 'git12345');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `roleId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `roleId`) VALUES
(1, 'Huen', 'qwerty', 't@gmail.com', 1),
(2, 'John', '81dc9bdb52d04dc20036dbd8313ed055', 'q@abv.bg', 0),
(3, 'Nikolay', 'd41d8cd98f00b204e9800998ecf8427e', '', 0),
(4, 'Jordan', 'd41d8cd98f00b204e9800998ecf8427e', '', 0),
(6, 'Jay', '81dc9bdb52d04dc20036dbd8313ed055', 'h@abv.bg', 0),
(7, 'Maden', '202cb962ac59075b964b07152d234b70', 'm@avc.bg', 0),
(8, 'Huen1', '202cb962ac59075b964b07152d234b70', 'huen@gmail.com', 0),
(9, 'Huen2', '202cb962ac59075b964b07152d234b70', 'hfdsafads', 0),
(10, 'Huen3', 'e10adc3949ba59abbe56e057f20f883e', 'n@abv.bg', 0),
(11, 'Huen4', '202cb962ac59075b964b07152d234b70', 'asd@abv.bg', 0),
(12, 'h', '81dc9bdb52d04dc20036dbd8313ed055', 'some@mail.com', 0),
(13, 'Huen6', '81dc9bdb52d04dc20036dbd8313ed055', 'g@abv.bg', 0),
(14, 'Chloe', '81dc9bdb52d04dc20036dbd8313ed055', 'h@abv.bg', 0),
(15, 'Huen18', '81dc9bdb52d04dc20036dbd8313ed055', 'l@abv.bg', 0),
(16, 'Lindsie', '81dc9bdb52d04dc20036dbd8313ed055', 'lindsie@gmail.com', 0),
(17, 'Danger', '81dc9bdb52d04dc20036dbd8313ed055', 'd@abv.bg', 0),
(18, 'Tom', 'e10adc3949ba59abbe56e057f20f883e', 'tom@gmail.com', 0),
(19, 'Jerry', '202cb962ac59075b964b07152d234b70', 'jerry@abv.bg', 0),
(20, 'Mike', '81dc9bdb52d04dc20036dbd8313ed055', 'mike@gmail.com', 0),
(21, 'Kiki', '202cb962ac59075b964b07152d234b70', 'kiki@gmail.com', 0),
(22, 'Ð¥ÑƒÐµÐ½', '202cb962ac59075b964b07152d234b70', 'h1@abv.bg', 0),
(23, 'Test', '202cb962ac59075b964b07152d234b70', 'd1@abv.bg', 0),
(24, 'Pipi', '202cb962ac59075b964b07152d234b70', 'pipi@abv.bg', 0),
(25, 'Traikov', '202cb962ac59075b964b07152d234b70', 'traikov@abv.bg', 0),
(26, 'sfasf', '202cb962ac59075b964b07152d234b70', 'n12@abv.bg', 0),
(27, 'huong', 'e10adc3949ba59abbe56e057f20f883e', 'huong@abv.bg', 0),
(28, 'fdsg', '202cb962ac59075b964b07152d234b70', 'fg@abv.bg', 0),
(29, 'Lilyl', '202cb962ac59075b964b07152d234b70', 'asd1@abv.bg', 0),
(30, 'Huen123', '202cb962ac59075b964b07152d234b70', 'huen11@gmail.com', 0),
(31, 'Sponge', '202cb962ac59075b964b07152d234b70', 'bob@abv.bg', 0),
(32, '', 'deaad792606928825c0bf85cd46e9edf', 'vietnamese_gangster@abv.bg', 0),
(33, '', '4d6341896a313c02d55a86eaaa8126b4', 'htechworkshop@gmail.com', 0),
(34, '', 'deaad792606928825c0bf85cd46e9edf', 'g1234@abv.bg', 0),
(35, 'Lilly', '4d6341896a313c02d55a86eaaa8126b4', 'lilly@abv.bg', 0),
(36, 'George1234', '4d6341896a313c02d55a86eaaa8126b4', '1qwerty1N@abv.bg', 0),
(37, 'George', '4d6341896a313c02d55a86eaaa8126b4', 'huen@abv.bg', 0),
(38, 'username', '827ccb0eea8a706c4c34a16891f84e7b', 'g123@abv.bg', 0),
(39, 'hehe', '827ccb0eea8a706c4c34a16891f84e7b', 'hehe@abv.bg', 0),
(40, 'Pesho1', '827ccb0eea8a706c4c34a16891f84e7b', 'pesho@abv.bg', 0),
(41, 'test100', 'f5f97c92ae39d49a4fa87d97eb3d89ff', 'qwerty@abv.bg', 0),
(42, 'didi', 'b0baee9d279d34fa1dfd71aadb908c3f', 'didi@abv.bg', 0),
(43, 'Pesho1231', '827ccb0eea8a706c4c34a16891f84e7b', 'huen111@abv.bg', 0),
(44, 'George121', '827ccb0eea8a706c4c34a16891f84e7b', 'huen121@abv.bg', 0),
(45, 'Huen1234', '827ccb0eea8a706c4c34a16891f84e7b', 'huen1@abv.bg', 0),
(46, 'Binladen', '827ccb0eea8a706c4c34a16891f84e7b', 'bin@abv.bg', 0),
(47, 'Bobby', '827ccb0eea8a706c4c34a16891f84e7b', 'bubi@abv.bg', 0),
(48, 'America', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'america@abv.bg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_tags`
--
ALTER TABLE `posts_tags`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `posts_tags`
--
ALTER TABLE `posts_tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
