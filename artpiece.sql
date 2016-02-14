-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2015 at 04:30 AM
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
-- Table structure for table `artpiece`
--

CREATE TABLE `artpiece` (
  `apID` char(13) NOT NULL,
  `imageLoc` varchar(15) DEFAULT NULL,
  `apDesc` text,
  `artistID` char(9) DEFAULT NULL,
  `apUploadDate` date DEFAULT NULL,
  `apModifyDate` date DEFAULT NULL,
  `apPrice` decimal(9,2) DEFAULT NULL,
  `apVisible` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artpiece`
--

INSERT INTO `artpiece` (`apID`, `imageLoc`, `apDesc`, `artistID`, `apUploadDate`, `apModifyDate`, `apPrice`, `apVisible`) VALUES
(1, 'a;skdh', 'rose thorny plant', 'thorny', '2015-11-22', '2015-11-22', '5.40', 1),
(2, 'lakds;', 'rose soft', 'thorny', '2015-11-22', '2015-11-22', '2.50', 1),
(3, 'kdl;ah', 'flowers are pretty', 'briars', '2015-11-22', '2015-11-15', '1.99', 1),
(4, ';laksdh', 'an actual rose here', 'briars', '2015-11-22', '2015-11-22', '7.50', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artpiece`
--
ALTER TABLE `artpiece`
  ADD PRIMARY KEY (`apID`),
  ADD KEY `artistID` (`artistID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artpiece`
--
ALTER TABLE `artpiece`
  ADD CONSTRAINT `artpiece_ibfk_1` FOREIGN KEY (`artistID`) REFERENCES `reguser` (`ruID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
