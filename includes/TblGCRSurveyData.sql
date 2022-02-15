-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2022 at 10:47 AM
-- Server version: 5.6.51-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BFORDMUSICIAN`
--

-- --------------------------------------------------------

--
-- Table structure for table `TblGCRSurveyData`
--

CREATE TABLE `TblGCRSurveyData` (
  `id` int(6) UNSIGNED NOT NULL,
  `firstName` varchar(20) DEFAULT NULL,
  `lastName` varchar(25) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `preferredContact` varchar(5) DEFAULT NULL,
  `COVID_Situation` varchar(500) DEFAULT NULL,
  `ChurchDoBetterJob` varchar(300) DEFAULT NULL,
  `unansweredQuestGod` varchar(1) DEFAULT NULL COMMENT 'y/n',
  `UnansweredQuestionsGodExplan` varchar(300) DEFAULT NULL,
  `freqAttendChurch` varchar(15) DEFAULT NULL,
  `IWouldAttendChurchIf` varchar(300) DEFAULT NULL,
  `heardOfGCR` varchar(1) DEFAULT NULL,
  `impressionOfGCR` varchar(8) DEFAULT NULL,
  `wouldLikeContact` varchar(7) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TblGCRSurveyData`
--

INSERT INTO `TblGCRSurveyData` (`id`, `firstName`, `lastName`, `phone`, `preferredContact`, `COVID_Situation`, `ChurchDoBetterJob`, `unansweredQuestGod`, `UnansweredQuestionsGodExplan`, `freqAttendChurch`, `IWouldAttendChurchIf`, `heardOfGCR`, `impressionOfGCR`, `wouldLikeContact`) VALUES
(1, 'William', 'Jackson', '(932) 487-9995', 'email', 'My family has been devastated by COVID. My wife and I have experienced the loss of a parent each, with my children losing 2 grandparents. The restrictions that COVID has caused on travel has left my family with a sense of void and disconnect.', 'The average church stays tucked away in a corner, until Sunday. But we need God every day. More presence.', 'y', 'I wonder whether COVID is an expression of God\'s wrath or His way of strengthing our character', 'Occasionally', 'n/a', 'n', 'n/a', 'contact'),
(2, 'left_blank', 'left_blank', 'left_blank', 'n/a', 'I lost my job due to COVID-19.', 'left_blank', 'n', 'n/a', 'Rarely', 'left_blank', 'n', 'n/a', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `TblGCRSurveyData`
--
ALTER TABLE `TblGCRSurveyData`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `TblGCRSurveyData`
--
ALTER TABLE `TblGCRSurveyData`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
