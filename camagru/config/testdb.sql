-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 31, 2019 at 10:18 PM
-- Server version: 5.7.23
-- PHP Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--
CREATE DATABASE IF NOT EXISTS `testdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `testdb`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `c_id` int(50) NOT NULL AUTO_INCREMENT,
  `c_text` varchar(300) NOT NULL,
  `c_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_name` varchar(100) NOT NULL,
  `p_id` int(9) NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `FK_COMMENTPOST` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `u_name` varchar(200) NOT NULL,
  PRIMARY KEY (`l_id`),
  KEY `fk_likes_post` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`l_id`, `p_id`, `u_name`) VALUES
(2, 75, 'root'),
(7, 75, 'user1'),
(9, 76, 'user1');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_attachment` varchar(256) NOT NULL,
  `p_caption` varchar(300) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `p_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_edited` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`p_id`),
  KEY `fkusers` (`u_name`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`p_id`, `p_attachment`, `p_caption`, `u_name`, `p_date`, `p_edited`) VALUES
(76, 'img/uploads/15485935966126user1.png', 'magogo', 'user1', '2019-01-27 14:53:16', 0),
(77, 'img/uploads/154859702292432user1.png', '..', 'user1', '2019-01-27 15:50:22', 1),
(78, 'img/uploads/1548981993114309user1.png', 'billy', 'user1', '2019-02-01 02:46:33', 0),
(81, 'img/uploads/154899180571126user11541680558155786s4b3l0.png', 'billy', 'user1', '2019-02-01 05:30:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `u_login` varchar(255) NOT NULL,
  `u_name` varchar(255) DEFAULT NULL,
  `u_surname` varchar(255) DEFAULT NULL,
  `u_sex` enum('unspecified','Female','Male','') NOT NULL DEFAULT 'unspecified',
  `u_email` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `u_passwd` varchar(255) NOT NULL,
  `u_role` enum('Admin','Regular') NOT NULL DEFAULT 'Regular',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`u_login`),
  UNIQUE KEY `u_email` (`u_email`),
  KEY `u_email_2` (`u_email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `u_login`, `u_name`, `u_surname`, `u_sex`, `u_email`, `status`, `u_passwd`, `u_role`) VALUES
(11, 'zzz', NULL, NULL, 'unspecified', 'sankosi@student.wethinkcode1.co.za', 'active', '81dc9bdb52d04dc20036dbd8313ed055', 'Regular'),
(13, 'use', NULL, NULL, 'unspecified', 'sankosi@student.wethinkcode2.com', 'active', '81dc9bdb52d04dc20036dbd8313ed055', 'Regular'),
(17, 'root', NULL, NULL, 'unspecified', 'sabelo.nkosi@rocketmail3.com', 'active', '81dc9bdb52d04dc20036dbd8313ed055', 'Regular'),
(18, 'user12', NULL, NULL, 'unspecified', 'sabelo.nkosi@rocketmail4.com', 'active', '81dc9bdb52d04dc20036dbd8313ed055', 'Regular'),
(19, 'user18', NULL, NULL, 'unspecified', 'sabelo.nkosi@rocketmail5.com', 'active', '81dc9bdb52d04dc20036dbd8313ed055', 'Regular'),
(21, 'sankosiqw', NULL, NULL, 'unspecified', 'sabelo.nkosi@rocketmail6.com', 'active', '81dc9bdb52d04dc20036dbd8313ed055', 'Regular'),
(22, 'user1', NULL, NULL, 'unspecified', 'sabelo.nkosi@rocketmail7.com', 'active', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin'),
(23, 'Sabelo', NULL, NULL, 'unspecified', 'nexekib@braun4email.com', 'active', '827ccb0eea8a706c4c34a16891f84e7b', 'Regular'),
(24, 'sabelo2', NULL, NULL, 'unspecified', 'sankosi@student.wethinkcode.co.za2', 'inactive', '81dc9bdb52d04dc20036dbd8313ed055', 'Regular');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_COMMENTPOST` FOREIGN KEY (`p_id`) REFERENCES `posts` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
