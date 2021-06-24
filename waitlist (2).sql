-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2021 at 11:45 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waitlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplates`
--

CREATE TABLE `emailtemplates` (
  `TemplateName` varchar(70) NOT NULL,
  `subject` varchar(70) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emailtemplates`
--

INSERT INTO `emailtemplates` (`TemplateName`, `subject`, `message`) VALUES
('ahaha', 'ahaha', 'ahahahaha');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `isAdmin`) VALUES
('admin', 'admin', 'admin@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `waitlist`
--

CREATE TABLE `waitlist` (
  `waitlist_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `waitlist_start_date` date NOT NULL,
  `waitlist_end_date` date NOT NULL,
  `waitlist_num_passengers` int(11) NOT NULL,
  `waitlist_activity_name` varchar(100) NOT NULL,
  `waitlist_notes` varchar(100) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `waitlist_date_created` date NOT NULL,
  `waitlist_enabled` tinyint(4) NOT NULL,
  `waitlist_approval_sent` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `waitlist`
--

INSERT INTO `waitlist` (`waitlist_id`, `name`, `phone`, `email`, `waitlist_start_date`, `waitlist_end_date`, `waitlist_num_passengers`, `waitlist_activity_name`, `waitlist_notes`, `client_id`, `waitlist_date_created`, `waitlist_enabled`, `waitlist_approval_sent`) VALUES
(1, 'qwe', '123', 'qwe@gmail.com', '2021-06-23', '2021-06-24', 5, 'AFTERNOON SNORKELING TOURS', 't1t1', NULL, '2021-06-22', 0, 0),
(3, 'Norris Hipolito', '05050505050', 'norrishipolito123@gmail.com', '2021-06-24', '2021-06-30', 51, 'GROUPS & PRIVATE CHARTERS', 'none', NULL, '2021-06-22', 0, 1),
(6, 'noqqq', '123', 'noq@gmail.com', '2021-06-24', '2021-06-24', 5151, 'MORNING SNORKELING TOURS', '', NULL, '2021-06-24', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `waitlist`
--
ALTER TABLE `waitlist`
  ADD PRIMARY KEY (`waitlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `waitlist`
--
ALTER TABLE `waitlist`
  MODIFY `waitlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
