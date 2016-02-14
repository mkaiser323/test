-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2015 at 04:29 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `reguser`
--

CREATE TABLE `reguser` (
  `ruID` char(9) NOT NULL,
  `ruPass` varchar(15) NOT NULL,
  `ruFname` varchar(15) NOT NULL,
  `ruminit` varchar(1) DEFAULT NULL,
  `ruLname` varchar(15) NOT NULL,
  `ruEmail` varchar(15) NOT NULL,
  `ruDateCreated` date DEFAULT NULL,
  `ruDateModified` date DEFAULT NULL,
  `artistFlag` tinyint(1) DEFAULT NULL,
  `ruPhone` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reguser`
--

INSERT INTO `reguser` (`ruID`, `ruPass`, `ruFname`, `ruminit`, `ruLname`, `ruEmail`, `ruDateCreated`, `ruDateModified`, `artistFlag`, `ruPhone`) VALUES
('briars', 'slkd2378*', 'Briar', 'T', 'Rosey', 'asldk@ahksd.com', '2015-11-22', '2015-11-22', 1, 123872987),
('thorny', 'asdf1234*', 'Briar', 'T', 'Rose', '', '2015-11-22', '2015-11-22', 0, 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reguser`
--
ALTER TABLE `reguser`
  ADD PRIMARY KEY (`ruID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
