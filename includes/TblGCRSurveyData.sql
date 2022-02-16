-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 15, 2022 at 09:12 PM
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
  `email` varchar(35) DEFAULT NULL,
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

INSERT INTO `TblGCRSurveyData` (`id`, `firstName`, `lastName`, `phone`, `email`, `preferredContact`, `COVID_Situation`, `ChurchDoBetterJob`, `unansweredQuestGod`, `UnansweredQuestionsGodExplan`, `freqAttendChurch`, `IWouldAttendChurchIf`, `heardOfGCR`, `impressionOfGCR`, `wouldLikeContact`) VALUES
(1, 'Barry', 'Ford', '2148083948', 'bford@futurebroadcast.biz', 'Phone', 'quick test 2/9/2022 4:07', 'quick test 2/9/2022 4:07', 'n', '...', 'Occasionally', '...', 'n', '...', 'contact');

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
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
