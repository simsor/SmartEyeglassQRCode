-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2016 at 01:49 AM
-- Server version: 5.6.28-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SmartEyeglassQRCode`
--

-- --------------------------------------------------------

--
-- Table structure for table `current_game`
--

CREATE TABLE `current_game` (
  `time_start` datetime DEFAULT NULL,
  `time_stop` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scan`
--

CREATE TABLE `scan` (
  `scan_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `treasure_id` int(11) NOT NULL,
  `date_scan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scan`
--

INSERT INTO `scan` (`scan_id`, `username`, `treasure_id`, `date_scan`) VALUES
(1, 'player1', 2, '2016-04-16 09:21:19'),
(2, 'player1', 3, '2016-04-16 10:26:19');

-- --------------------------------------------------------

--
-- Table structure for table `Treasure`
--

CREATE TABLE `Treasure` (
  `treasure_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `next_hint` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Treasure`
--

INSERT INTO `Treasure` (`treasure_id`, `description`, `next_hint`) VALUES
(1, 'tresor', 'tresor suivant'),
(2, 'hgfdxc', 'sdgnbvc'),
(3, 'tresor', 'tresor suivant'),
(4, 'hgfdxc', 'sdgnbvc');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `username` varchar(200) NOT NULL,
  `displayname` varchar(200) NOT NULL,
  `password_hash` varchar(200) NOT NULL,
  `role` enum('admin','player') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`username`, `displayname`, `password_hash`, `role`) VALUES
('admin', 'admin', 'ab4f63f9ac65152575886860dde480a1', 'admin'),
('player1', 'player1', 'ab4f63f9ac65152575886860dde480a1', 'player');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scan`
--
ALTER TABLE `scan`
  ADD PRIMARY KEY (`scan_id`),
  ADD KEY `username` (`username`),
  ADD KEY `treasure_id` (`treasure_id`);

--
-- Indexes for table `Treasure`
--
ALTER TABLE `Treasure`
  ADD PRIMARY KEY (`treasure_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`username`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `scan`
--
ALTER TABLE `scan`
  MODIFY `scan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Treasure`
--
ALTER TABLE `Treasure`
  MODIFY `treasure_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `scan`
--
ALTER TABLE `scan`
  ADD CONSTRAINT `tr_id` FOREIGN KEY (`treasure_id`) REFERENCES `Treasure` (`treasure_id`),
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `User` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
