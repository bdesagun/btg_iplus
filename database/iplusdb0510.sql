-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 03:02 PM
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
-- Table structure for table `audittrail`
--

CREATE TABLE `audittrail` (
  `id` int(11) NOT NULL,
  `activity` text NOT NULL,
  `updatedby` varchar(200) NOT NULL,
  `updateddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'JOLLIBEE', 'Lolomboy, Bocaue, Bulacan, Philippines', 'Food', 1),
(7, 'MANG INASAL', 'Lolomboy Bocaue Bulacan', 'Food', 1);

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
('client', '1', '03 entity', '03 entity', 1),
('client', '7', '02 Modern Entity', '02 Modern Entity', 1),
('client', '7', '01 Modern Entity', '01 Modern Entity', 1);

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

--
-- Dumping data for table `fileaudittrail`
--

INSERT INTO `fileaudittrail` (`trailid`, `clientid`, `entity`, `month`, `year`, `updatedby`, `trailstatus`, `remarks`, `updateddate`) VALUES
(38, 1, '01 entity', 'May', 2023, 'client', 'Confirmed', 'Confirmed', '2023-05-10 19:09:28'),
(39, 1, '01 entity', 'May', 2023, 'staff', 'Approved', 'Approved', '2023-05-10 19:18:53'),
(40, 1, '01 entity', 'May', 2023, 'reviewer', 'Reviewed', 'Reviewed', '2023-05-10 19:26:38'),
(43, 1, '01 entity', 'May', 2023, 'client', 'ConfirmedBAS', 'ConfirmedBAS', '2023-05-10 20:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `filedue`
--

CREATE TABLE `filedue` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `month` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `data_request` int(11) NOT NULL,
  `data_upload` int(11) NOT NULL,
  `bas_preparation` int(11) NOT NULL,
  `bas_review` int(11) NOT NULL,
  `bas_sign_off` int(11) NOT NULL,
  `bas_lodgement` int(11) NOT NULL
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

--
-- Dumping data for table `filehistory`
--

INSERT INTO `filehistory` (`fileid`, `filestatus`, `filedate`, `remarks`, `updatedby`) VALUES
(1, 'Submitted', '2023-04-18 21:07:33', '', 'client'),
(1, 'Viewed', '2023-04-18 21:09:17', '', 'staff'),
(1, 'Approved', '2023-04-18 21:09:21', '', 'staff'),
(2, 'Submitted', '2023-04-18 21:22:46', '', 'staff'),
(3, 'Submitted', '2023-04-25 19:31:08', '', 'client'),
(4, 'Submitted', '2023-04-25 19:37:26', '', 'client'),
(4, 'Viewed', '2023-04-25 19:37:50', '', 'staff'),
(4, 'Approved', '2023-04-25 19:37:54', '', 'staff'),
(5, 'Submitted', '2023-04-25 19:38:09', '', 'staff'),
(6, 'Submitted', '2023-05-04 19:21:59', '', 'client'),
(6, 'Updated', '2023-05-04 19:22:11', '', 'client'),
(6, 'Returned', '2023-05-04 19:26:36', 'some reason', 'staff'),
(6, 'Updated', '2023-05-04 19:27:12', '', 'client'),
(6, 'Approved', '2023-05-04 19:58:42', '', 'staff'),
(13, 'Submitted', '2023-05-04 20:28:37', '', 'client'),
(14, 'Submitted', '2023-05-04 20:32:15', '', 'staff'),
(13, 'Viewed', '2023-05-08 18:04:32', '', 'staff'),
(19, 'Submitted', '2023-05-08 19:31:45', '', 'client');

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

--
-- Dumping data for table `filezone`
--

INSERT INTO `filezone` (`fileid`, `filename`, `fileentity`, `filetype`, `month`, `year`, `fileowner`, `clientid`, `filecategory`) VALUES
(1, 'Sample1.xlsx', '01 entity', 'GL', 'April', 2023, 'client', 1, 'clientfile'),
(2, 'Sample BAS1.pdf', '01 entity', NULL, 'April', 2023, 'staff', 1, 'btgfile'),
(3, 'Sample2.csv', '02 entity', 'AP', 'April', 2023, 'client', 1, 'clientfile'),
(4, 'Sample3.xls', '03 entity', 'AR', 'April', 2023, 'client', 1, 'clientfile'),
(5, 'Sample BAS3.pdf', '03 entity', NULL, 'April', 2023, 'staff', 1, 'btgfile'),
(6, 'Sample1.xlsx', '01 entity', 'AP', 'May', 2023, 'client', 1, 'clientfile'),
(13, 'Sample2.csv', '02 entity', 'AP', 'May', 2023, 'client', 1, 'clientfile'),
(14, 'Sample BAS2.pdf', '01 entity', NULL, 'May', 2023, 'staff', 1, 'btgfile'),
(19, 'Sample1 - Copy.xlsx', '03 entity', 'GL', 'May', 2023, 'client', 1, 'clientfile');

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
('dabe0203', '0bfb67a3de33b58ad8d6cb86c4002347', 'Juan Dela Cruz', '2', 'dave.tablante03@gmail.com', 'zhj1e0dbf6wv4sylamqp2t75rco3g8', 'client', 1),
('reviewer', '7ba917e4e5158c8a9ed6eda08a6ec572', 'Ron Dela Vega', '', 'ron.ron@email.com', '3ujqw0iexh21clbpa6kvnsmf9rd7go', 'reviewer', 1),
('sample3123', 'd48fc380581f3e2a9c341eea0527d1ad', 'Sample Account 2', '', 'dave.tablante03@gmail.com', '7u04n92yjp8fozqs6dra5hxikml3cw', 'staff', 1),
('samplelangto', '1685d3d41e5e2b4056b562ca8135c3fa', 'Sample Account', '', 'dave.tablante03@gmail.com', '1gipwftnuj2dqclx9ryvesa5h4ko8b', 'staff', 3),
('staff', '1253208465b1efa876f982d8a9e73eef', 'Juan Luna', '', 'juan.luna@email.com', '', 'staff', 1),
('staffsample', '67184fff19483079f4c4f59584f56793', 'Dave Tablante', '1', 'dave.tablante03@gmail.com', 'c2zstl1ay4qehinkg3xofmw5d86uj0', 'client', 1);

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
('reviewer', 1, '01 entity', 1),
('reviewer', 1, '02 entity', 1),
('reviewer', 1, '03 entity', 1),
('staff', 1, '01 entity', 1),
('staff', 1, '02 entity', 1),
('staff', 1, '03 entity', 1),
('staff', 7, '01 Modern Entity', 1),
('staff', 7, '02 Modern Entity', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audittrail`
--
ALTER TABLE `audittrail`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `filedue`
--
ALTER TABLE `filedue`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `audittrail`
--
ALTER TABLE `audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `checklistid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fileaudittrail`
--
ALTER TABLE `fileaudittrail`
  MODIFY `trailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `filedue`
--
ALTER TABLE `filedue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `filezone`
--
ALTER TABLE `filezone`
  MODIFY `fileid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
