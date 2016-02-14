-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2015 at 09:25 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` char(9) DEFAULT NULL,
  `adminPass` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `artpiece`
--

CREATE TABLE `artpiece` (
  `apID` char(13) NOT NULL,
  `imageLoc` varchar(30) DEFAULT NULL,
  `apDesc` text,
  `artistID` varchar(30) DEFAULT NULL,
  `apUploadDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `apModifyDate` timestamp NULL DEFAULT NULL,
  `apPrice` decimal(9,2) DEFAULT NULL,
  `apVisible` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artpiece`
--

INSERT INTO `artpiece` (`apID`, `imageLoc`, `apDesc`, `artistID`, `apUploadDate`, `apModifyDate`, `apPrice`, `apVisible`) VALUES
('5664a1015b867', 'images/5664a1015a760.jpg', 'otters are adorable', '932837', '2015-12-06 20:56:33', '2015-12-06 20:56:33', '3.98', 1),
('5664b5fbca8f0', 'images/5664b5fbca1cd.png', 'beginning schema image', '932837', '2015-12-06 22:26:03', '2015-12-06 22:26:03', '3.27', 1),
('5664b92a20b24', 'images/5664b92a2055a.jpg', 'Customer use cases', '932837', '2015-12-06 22:39:38', '2015-12-06 22:39:38', '34.97', 1),
('5664b9b661798', 'images/5664b9b661275.jpg', 'Customer use cases', '932837', '2015-12-06 22:41:58', '2015-12-06 22:41:58', '34.97', 1),
('5664cfe6052d7', 'images/5664cfe604cdc.png', 'yoshi is a sausage', '932837', '2015-12-07 00:16:38', '2015-12-07 00:16:38', '9.99', 1),
('5664d049d2c18', 'images/5664d049d237c.PNG', 'data science flyer', '932837', '2015-12-07 00:18:17', '2015-12-07 00:18:17', '9.87', 1),
('5665d2c14bde7', 'images/5665d2c14b1f7.jpg', 'facebook file photo', '932837', '2015-12-07 18:41:05', '2015-12-07 18:41:05', '9.32', 1),
('5665d8ad3de63', 'images/5665d8ad3d36f.png', 'Client server architecture diagram', '932837', '2015-12-07 19:06:21', '2015-12-07 19:06:21', '3.99', 1),
('5665dc5758198', 'images/5665dc57570bd.PNG', 'BEAUti2 model description screenshot', '932837', '2015-12-07 19:21:59', '2015-12-07 19:21:59', '98.38', 1),
('566a084437bde', 'images/566a0844376f6.PNG', '', '932837', '2015-12-10 23:18:28', NULL, '2.99', 1),
('566a188b7084b', 'images/566a188b6b731.png', '', '932837', '2015-12-11 00:27:55', NULL, '39.00', 1),
('566a18c6b31af', 'images/566a18c6b2865.PNG', '', '932837', '2015-12-11 00:28:54', NULL, '39.00', 1),
('566a1b16bbb5c', 'images/566a1b16bb064.png', 'repository', '932837', '2015-12-11 00:38:46', NULL, '3.37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `arttags`
--

CREATE TABLE `arttags` (
  `artTagID` int(15) NOT NULL,
  `tagName` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arttags`
--

INSERT INTO `arttags` (`artTagID`, `tagName`) VALUES
(9, 'rose'),
(10, 'yeast'),
(11, 'R'),
(12, 'research'),
(13, 'largeleaves'),
(14, 'QQ'),
(15, 'BEAST'),
(16, 'MDS'),
(17, 'kitten'),
(18, 'busted'),
(19, 'cat'),
(20, 'otter'),
(21, 'animal'),
(23, 'usecase'),
(24, 'diagram'),
(25, ''),
(26, 'schema'),
(27, 'customer'),
(28, 'use case'),
(29, 'sequence'),
(30, 'yoshi'),
(31, 'yorkie'),
(32, 'dog'),
(33, 'fat'),
(34, 'sausage'),
(35, 'flyer'),
(36, 'aurora'),
(37, 'facebook'),
(38, 'clientserver'),
(39, 'software engine'),
(40, 'architecture'),
(41, 'BEAUti'),
(42, 'screenshot'),
(43, 'model'),
(44, 'schedule'),
(45, 'september'),
(46, 'repository');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` varchar(26) NOT NULL,
  `apID` char(13) NOT NULL,
  `orderTotal` decimal(9,2) NOT NULL,
  `buyerID` varchar(30) NOT NULL,
  `sellerID` varchar(30) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `apID`, `orderTotal`, `buyerID`, `sellerID`, `orderDate`) VALUES
('ord566dd28d77ec55.33083408', '5664a1015b867', '3.98', '932837', '932837', '2015-12-13 20:18:21');

-- --------------------------------------------------------

--
-- Table structure for table `reguser`
--

CREATE TABLE `reguser` (
  `ruID` varchar(30) NOT NULL,
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
('932837', 'abcd#123', 'Briar', 'T', 'Rose', 'brt@fake.com', NULL, NULL, 1, 1111111111);

-- --------------------------------------------------------

--
-- Table structure for table `taggedpiece`
--

CREATE TABLE `taggedpiece` (
  `apID` char(13) NOT NULL,
  `artTagID` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taggedpiece`
--

INSERT INTO `taggedpiece` (`apID`, `artTagID`) VALUES
('5664a1015b867', 20),
('5664a1015b867', 21),
('5664a1015b867', 25),
('5664b5fbca8f0', 12),
('5664b5fbca8f0', 25),
('5664b5fbca8f0', 26),
('5664b92a20b24', 27),
('5664b92a20b24', 28),
('5664b92a20b24', 29),
('5664b9b661798', 27),
('5664b9b661798', 28),
('5664b9b661798', 29),
('5664cfe6052d7', 30),
('5664cfe6052d7', 31),
('5664cfe6052d7', 32),
('5664cfe6052d7', 33),
('5664cfe6052d7', 34),
('5664d049d2c18', 25),
('5664d049d2c18', 35),
('5665d2c14bde7', 25),
('5665d2c14bde7', 36),
('5665d2c14bde7', 37),
('5665d8ad3de63', 24),
('5665d8ad3de63', 38),
('5665d8ad3de63', 40),
('5665dc5758198', 12),
('5665dc5758198', 41),
('5665dc5758198', 42),
('5665dc5758198', 43),
('566a084437bde', 25),
('566a084437bde', 44),
('566a188b7084b', 25),
('566a18c6b31af', 25),
('566a18c6b31af', 45),
('566a1b16bbb5c', 25),
('566a1b16bbb5c', 40),
('566a1b16bbb5c', 46);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artpiece`
--
ALTER TABLE `artpiece`
  ADD PRIMARY KEY (`apID`),
  ADD KEY `ru_artistID` (`artistID`);

--
-- Indexes for table `arttags`
--
ALTER TABLE `arttags`
  ADD PRIMARY KEY (`artTagID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `reguser`
--
ALTER TABLE `reguser`
  ADD PRIMARY KEY (`ruID`);

--
-- Indexes for table `taggedpiece`
--
ALTER TABLE `taggedpiece`
  ADD PRIMARY KEY (`apID`,`artTagID`),
  ADD KEY `tp_arttag` (`artTagID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arttags`
--
ALTER TABLE `arttags`
  MODIFY `artTagID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `artpiece`
--
ALTER TABLE `artpiece`
  ADD CONSTRAINT `ru_artistID` FOREIGN KEY (`artistID`) REFERENCES `reguser` (`ruID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taggedpiece`
--
ALTER TABLE `taggedpiece`
  ADD CONSTRAINT `tp_artistID` FOREIGN KEY (`apID`) REFERENCES `artpiece` (`apID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_arttag` FOREIGN KEY (`artTagID`) REFERENCES `arttags` (`artTagID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
