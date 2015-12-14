-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3307
-- Generation Time: Dec 14, 2015 at 09:54 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `code` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `code`) VALUES
(41, 'Energiteknik', 'Kurs om energilÃ¤ra.', '23');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `time` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `path` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_id`, `id`, `page`, `time`, `path`) VALUES
(1, 2, 1, '2000', 'images/tillcloud-0.png'),
(2, 2, 2, '4000', 'images/tillcloud-1.png'),
(3, 2, 3, '7000', 'images/tillcloud-2.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `lastname` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `school` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `programme` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `school`, `programme`, `email`) VALUES
(10, 'Andersson', '$2y$10$jnAjT/KBFyJcRa6uEAba5.6dWsRGW//ROoDKMLXoLeTOYDk3nD7rS', 'Anders', 'Andersson', 'BTH', 'civ. elteknik', 'and@And.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_course`
--

CREATE TABLE IF NOT EXISTS `user_course` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`,`course_id`),
  KEY `user_id` (`user_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `user_course`
--

INSERT INTO `user_course` (`user_id`, `course_id`, `teacher`) VALUES
(10, 41, 1);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `slide_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  KEY `slide_id` (`slide_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `description`, `course_id`, `slide_id`, `url`) VALUES
(14, 'Grundläggande energiteknik', 'da', 41, 2, 'https://www.youtube.com/embed/ajt2zIVSmaw'),
(15, 'Ellära 1', 'da', 41, 2, 'ad'),
(16, 'Termodynamik', 'da', 41, 2, 'da'),
(21, 'Kvantfysikens byggstenar', 'test', 41, 2, 'test'),
(22, 'Fission', 'test', 41, 2, 'test'),
(24, 'uih', '90u', 41, 2, 'oi');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mycourses`
--
CREATE TABLE IF NOT EXISTS `view_mycourses` (
`user_id` int(11)
,`id` int(11)
,`name` varchar(45)
,`code` varchar(45)
,`description` varchar(250)
);
-- --------------------------------------------------------

--
-- Structure for view `view_mycourses`
--
DROP TABLE IF EXISTS `view_mycourses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mycourses` AS select `u`.`id` AS `user_id`,`c`.`id` AS `id`,`c`.`name` AS `name`,`c`.`code` AS `code`,`c`.`description` AS `description` from ((`users` `u` join `user_course` `b`) join `courses` `c`) where ((`b`.`user_id` = `u`.`id`) and (`b`.`course_id` = `c`.`id`));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `usercourse_courses_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usercourse_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_courses_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
