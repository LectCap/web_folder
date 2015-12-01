-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 01 dec 2015 kl 22:29
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumpning av Data i tabell `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `code`) VALUES
(5, 'project', 'descr', 'pa1415'),
(8, 'at1213', 'cool course', 'the good course'),
(9, 'new project course', 'Very cool course with SImon Pudding', 'pa1112'),
(10, 'asd', 'das ', 'pa1113'),
(11, 'The real deal: How to conduct business', 'This course is being done by Donald Trump, bless his heart', 'pa9090');

-- --------------------------------------------------------

--
-- Tabellstruktur `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(45) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `school`, `programme`, `email`) VALUES
(1, 'sven', '$2y$10$GA0dL5YYgto9hNLD1ld4kOrNFG6ULTtIg6GjGx.TsrxiNa2wkm1S.', 'Sven', 'Svensson', 'Svennes verktygsmekaniska', 'qwe', 'asd@asd.sw'),
(2, 'abba', '$2y$10$lxcGvFcmG640yj4629D35e7Uf5dwesab0IrBALxSbYJGTAso62vSe', 'sven', 'svensson', 'skolan', 'programmet', 'asd@asd.es'),
(3, 'skatan', '$2y$10$pJ3A9LKSwDY7HK.40Y6X5ef6X45jPxB6MmZFiko2.h4djEGZy9JFe', 'alfons', 'albertsson', 'VÃ¤gga', 'NV', 'alfons@albert.se'),
(5, 'benke', '$2y$10$m2lTjfps2wVNZq9DQ/9bue5wZHbX1NI0Nf/UtHOe.eGAxxqr54pUi', 'bengt', 'bengtsson', '', '', 'asd@asd.fr'),
(6, 'asddc', '$2y$10$ofUVdidxgOOJzYIlTcsc0Ou9qRc2IQITdWc20g2UpkIX/7se3wGri', 'asd', 'asd', 'asd', 'Â§asd', 'asd@asd.tv'),
(7, 'arneweisse', '$2y$10$4jVvKyylB0mFFSrSYhPC3.Wtx/StzuSCr.S6MQz2JAyVldIJY/jMi', 'arne', 'weisse', '', '', 'asd@tertad.se');

-- --------------------------------------------------------

--
-- Tabellstruktur `user_course`
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
-- Dumpning av Data i tabell `user_course`
--

INSERT INTO `user_course` (`user_id`, `course_id`, `teacher`) VALUES
(1, 5, 1),
(1, 8, 1),
(1, 9, 1),
(1, 10, 1),
(1, 11, 1);

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
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  KEY `slide_id` (`slide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

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
  ADD CONSTRAINT `videos_courses_fk` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `videos_slides_fk` FOREIGN KEY (`slide_id`) REFERENCES `slides` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
