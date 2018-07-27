-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 24, 2018 at 01:33 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `draugiemgroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question_id` int(10) UNSIGNED NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `is_correct`, `text`) VALUES
(1, 1, 0, 'Riekstu kalns'),
(2, 1, 0, 'Žagarkalns'),
(3, 1, 1, 'Gaiziņkalns'),
(4, 1, 0, 'Sirdskalns'),
(5, 2, 0, 'Daugavpils'),
(6, 2, 0, 'Liepāja'),
(7, 2, 1, 'Rīga'),
(8, 3, 1, 'Krievija'),
(9, 3, 0, 'Igaunija'),
(10, 3, 0, 'Lietuva'),
(11, 3, 0, 'Baltkrievija'),
(12, 3, 0, 'Zviedrija'),
(13, 4, 0, '1'),
(14, 4, 1, '2'),
(15, 5, 0, '12'),
(16, 5, 1, '5'),
(17, 5, 0, '18'),
(18, 5, 0, '45'),
(19, 6, 1, '24'),
(20, 6, 0, '12'),
(21, 6, 0, '28'),
(22, 6, 0, '7777'),
(23, 7, 0, '22'),
(24, 7, 0, '13'),
(25, 7, 0, '20'),
(26, 7, 1, '21'),
(27, 8, 0, '1990'),
(28, 8, 0, '2000'),
(29, 8, 0, '2002'),
(30, 8, 1, '2004'),
(31, 8, 0, '2005'),
(32, 8, 0, '2008'),
(33, 9, 1, '100'),
(34, 9, 0, '146'),
(35, 9, 0, '23'),
(36, 10, 1, 'salīdzini.lv'),
(37, 10, 0, 'Playful TV'),
(38, 10, 0, 'Pērkam kopā'),
(39, 10, 0, 'zip.lv'),
(40, 11, 0, 'LV 100 un ASV 100'),
(41, 11, 0, 'LV 150 un ASV 50'),
(42, 11, 0, 'LV 10 un ASV 200'),
(43, 11, 1, 'LV 230+ un ASV 250+'),
(44, 13, 1, 'Šuvēja'),
(45, 13, 0, 'Modelis'),
(46, 13, 0, 'Programmētājs (attālināti)'),
(47, 13, 0, 'Pārdevējs ASV tirgum'),
(48, 12, 0, 'OJĀRA VĀCIEŠA IELA 6B, RĪGA, LV-1004 LATVIJA'),
(49, 12, 0, 'CARRER PUJADES 55,\r\nPISO 1º - OFICINA 14,\r\n08005, BARCELONA, ESPAÑA'),
(50, 12, 0, '9749 DEARBORN ST\r\nCHATSWORTH, CA 91311\r\nUNITED STATES OF AMERICA'),
(51, 12, 1, 'BRĪVĪBAS IELA 7, RĪGA, LV-1001 LATVIJA');

-- --------------------------------------------------------

--
-- Table structure for table `completed_tests`
--

DROP TABLE IF EXISTS `completed_tests`;
CREATE TABLE IF NOT EXISTS `completed_tests` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `right_answers` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `test_id` (`test_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `test_id` int(10) UNSIGNED NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `test_id` (`test_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `test_id`, `text`) VALUES
(1, 1, 'Kā sauc Latvijas augstāko pauguru (kalnu)?'),
(2, 1, 'Kas ir Latvijas galvaspilsēta?'),
(3, 1, 'Kura ir lielākā kaimiņvalsts?'),
(4, 2, 'Cik ir 1+1 ?'),
(5, 2, 'Cik ir 15/3 ?'),
(6, 2, 'Cik ir 8*3 ?'),
(10, 3, 'Kurš no minētajiem nav Draugiem Group projekts?'),
(7, 2, 'Cik ir 17+4 ?'),
(8, 1, 'Kurā gadā Latvija iestājās Eiropas Savienībā?'),
(9, 2, 'Cik ir 123-23 ?'),
(11, 3, 'CIk darbinieku ir Draugiem Group komandā?'),
(12, 3, 'Kurā no adresēm neatrodas Draugiem Group?'),
(13, 3, 'Kādu vakanci nepiedāvā Draugiem Group komanda?');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `name`) VALUES
(1, 'Latvia test'),
(2, 'Math test'),
(3, 'DraugiemGroup test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'Jack Nicleson');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

DROP TABLE IF EXISTS `user_answers`;
CREATE TABLE IF NOT EXISTS `user_answers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `answer_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `test_id` (`test_id`),
  KEY `question_id` (`question_id`),
  KEY `answer_id` (`answer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
