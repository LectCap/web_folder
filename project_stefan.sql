-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 16 dec 2015 kl 14:49
-- Serverversion: 5.6.17
-- PHP-version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `project`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `code` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=45 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `time` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `path` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `user_course`
--

CREATE TABLE IF NOT EXISTS `user_course` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher` tinyint(1) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_id`,`course_id`),
  KEY `user_id` (`user_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `videos`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `view_mycourses`
--
CREATE TABLE IF NOT EXISTS `view_mycourses` (
`user_id` int(11)
,`id` int(11)
,`name` varchar(45)
,`code` varchar(45)
,`description` varchar(250)
,`status` tinyint(4)
);
-- --------------------------------------------------------

--
-- Ersättningsstruktur för vy `view_waitingstudents`
--
CREATE TABLE IF NOT EXISTS `view_waitingstudents` (
`user_id` int(11)
,`course_id` int(11)
,`username` varchar(45)
,`firstname` varchar(45)
,`lastname` varchar(45)
,`school` varchar(45)
,`programme` varchar(45)
,`status` tinyint(4)
);
-- --------------------------------------------------------

--
-- Struktur för vy `view_mycourses`
--
DROP TABLE IF EXISTS `view_mycourses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mycourses` AS select `u`.`id` AS `user_id`,`c`.`id` AS `id`,`c`.`name` AS `name`,`c`.`code` AS `code`,`c`.`description` AS `description`,`b`.`status` AS `status` from ((`users` `u` join `user_course` `b`) join `courses` `c`) where ((`b`.`user_id` = `u`.`id`) and (`b`.`course_id` = `c`.`id`));

-- --------------------------------------------------------

--
-- Struktur för vy `view_waitingstudents`
--
DROP TABLE IF EXISTS `view_waitingstudents`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_waitingstudents` AS select `u`.`id` AS `user_id`,`c`.`id` AS `course_id`,`u`.`username` AS `username`,`u`.`firstname` AS `firstname`,`u`.`lastname` AS `lastname`,`u`.`school` AS `school`,`u`.`programme` AS `programme`,`b`.`status` AS `status` from ((`users` `u` join `user_course` `b`) join `courses` `c`) where ((`b`.`user_id` = `u`.`id`) and (`b`.`course_id` = `c`.`id`));

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `usercourse_courses_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usercourse_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restriktioner för tabell `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_courses_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
