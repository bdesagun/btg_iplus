-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2023 at 12:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iplusdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE `checklist` (
  `checklistid` int(11) NOT NULL,
  `checklistprocedure` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checklist`
--

INSERT INTO `checklist` (`checklistid`, `checklistprocedure`, `active`) VALUES
(1, 'Sample Procedure 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientid` int(11) NOT NULL,
  `clientname` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `industry` varchar(200) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientid`, `clientname`, `address`, `industry`, `active`) VALUES
(1, 'JOLLIBEE', 'Lolomboy, Bocaue, Bulacan, Philippines', 'Food', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dropdown`
--

CREATE TABLE `dropdown` (
  `category` varchar(200) NOT NULL,
  `subcategory` varchar(200) NOT NULL,
  `value` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dropdown`
--

INSERT INTO `dropdown` (`category`, `subcategory`, `value`, `name`, `active`) VALUES
('filezone', '', 'GL', 'GL', 1),
('filezone', '', 'AP', 'AP', 1),
('filezone', '', 'AR', 'AR', 1),
('client', '1', '01 entity', '01 entity', 1),
('client', '1', '02 entity', '02 entity', 1),
('client', '1', '03 entity', '03 entity', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fileaudittrail`
--

CREATE TABLE `fileaudittrail` (
  `trailid` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `entity` varchar(200) NOT NULL,
  `month` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `updatedby` varchar(200) NOT NULL,
  `trailstatus` varchar(200) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `updateddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `filehistory`
--

CREATE TABLE `filehistory` (
  `fileid` int(11) NOT NULL,
  `filestatus` varchar(200) NOT NULL,
  `filedate` datetime NOT NULL,
  `remarks` text NOT NULL,
  `updatedby` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `filezone`
--

CREATE TABLE `filezone` (
  `fileid` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `fileentity` varchar(200) NOT NULL,
  `filetype` varchar(200) DEFAULT NULL,
  `month` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `fileowner` varchar(200) NOT NULL,
  `clientid` int(11) NOT NULL,
  `filecategory` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `iframe`
--

CREATE TABLE `iframe` (
  `pagename` varchar(200) NOT NULL,
  `pageurl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iframe`
--

INSERT INTO `iframe` (`pagename`, `pageurl`) VALUES
('Dashboard', 'https://www.example.com'),
('Workflow', 'http://18.204.165.1:8503/');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `address` text NOT NULL,
  `mobilenumber` varchar(200) NOT NULL,
  `telephonenumber` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `accountname` varchar(200) NOT NULL,
  `clientid` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `emailcode` text NOT NULL,
  `position` varchar(200) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`username`, `password`, `accountname`, `clientid`, `email`, `emailcode`, `position`, `active`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '', 'admin.admin@admin.com', '', 'admin', 1),
('client', '62608e08adc29a8d6dbc9754e659f125', 'Jolo Cruz', '1', 'jollibee@email.com', '', 'client', 1),
('dabe0203', '81cabb307c57a4818197e27872d26800', 'Juan Dela Cruz', '2', 'dave.tablante03@gmail.com', 'zhj1e0dbf6wv4sylamqp2t75rco3g8', 'client', 1),
('reviewer', '7ba917e4e5158c8a9ed6eda08a6ec572', 'Ron Dela Vega', '', 'ron.ron@email.com', '3ujqw0iexh21clbpa6kvnsmf9rd7go', 'reviewer', 1),
('staff', '1253208465b1efa876f982d8a9e73eef', 'Juan Luna', '', 'juan.luna@email.com', '', 'staff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userentity`
--

CREATE TABLE `userentity` (
  `username` varchar(200) NOT NULL,
  `clientid` int(11) NOT NULL,
  `entity` varchar(200) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userentity`
--

INSERT INTO `userentity` (`username`, `clientid`, `entity`, `active`) VALUES
('staff', 1, '01 entity', 1),
('staff', 1, '02 entity', 1),
('staff', 1, '03 entity', 1),
('reviewer', 1, '01 entity', 1),
('reviewer', 1, '02 entity', 1),
('reviewer', 1, '03 entity', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`checklistid`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientid`);

--
-- Indexes for table `fileaudittrail`
--
ALTER TABLE `fileaudittrail`
  ADD PRIMARY KEY (`trailid`);

--
-- Indexes for table `filezone`
--
ALTER TABLE `filezone`
  ADD PRIMARY KEY (`fileid`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `checklistid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fileaudittrail`
--
ALTER TABLE `fileaudittrail`
  MODIFY `trailid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filezone`
--
ALTER TABLE `filezone`
  MODIFY `fileid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
