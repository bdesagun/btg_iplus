-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 11:50 AM
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
(1, 'JOLLIBEE', 'Lolomboy, Bocaue, Bulacan, Philippines', 'Food', 1),
(2, 'MANG-INASAL', 'Lolomboy, Bocaue, Bulacan, Philippines', 'Food', 1),
(3, 'MINISTOP', 'Bancal, Meycauayan, Bulacan, Philippines', 'Store', 1),
(4, '7-ELEVEN', 'Bancal, Meycauayan, Bulacan, Philippines', 'Store', 1),
(5, 'CHOWKING', 'Lolomboy, Bocaue, Bulacan, Philippines', 'Food', 1),
(6, 'PUREGOLD', 'Abangan Sur, Marilao, Bulacan, Philippines', 'Store', 1);

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
('client', '2', '01 entity', '01 entity', 1),
('client', '2', '02 entity', '02 entity', 1),
('client', '3', '01 entity', '01 entity', 1),
('client', '4', '01 entity', '01 entity', 1),
('client', '5', '01 entity', '01 entity', 1),
('client', '4', '02 entity', '02 entity', 1),
('client', '1', '03 entity', '03 entity', 1),
('client', '6', '01 entity', '01 entity', 1);

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
(10, 1, '01 entity', 'March', 2023, 'daveclient', 'Confirmed', 'Confirmed', '2023-03-28 22:37:19'),
(11, 1, '01 entity', 'March', 2023, 'staff', 'Approved', 'Approved', '2023-03-28 22:41:24'),
(13, 1, '01 entity', 'March', 2023, 'davereviewer', 'Reviewed', 'Reviewed', '2023-03-28 22:43:41'),
(14, 1, '01 entity', 'March', 2023, 'client', 'ConfirmedBAS', 'ConfirmedBAS', '2023-03-28 22:45:09'),
(15, 1, '02 entity', 'March', 2023, 'client', 'Confirmed', 'Confirmed', '2023-03-29 10:53:53'),
(16, 1, '01 entity', 'February', 2023, 'client', 'Confirmed', 'Confirmed', '2023-03-29 12:22:51'),
(17, 1, '02 entity', 'March', 2023, 'staff', 'Approved', 'Approved', '2023-03-29 12:28:00'),
(18, 1, '02 entity', 'March', 2023, 'reviewer', 'Reviewed', 'Reviewed', '2023-03-29 12:28:54'),
(19, 1, '02 entity', 'March', 2023, 'client', 'ConfirmedBAS', 'ConfirmedBAS', '2023-03-29 12:30:01');

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
(1, 'Submitted', '2023-03-28 21:58:57', '', 'daveclient'),
(2, 'Submitted', '2023-03-28 21:59:12', '', 'daveclient'),
(2, 'Viewed', '2023-03-28 22:00:41', '', 'staff'),
(1, 'Viewed', '2023-03-28 22:00:42', '', 'staff'),
(1, 'Approved', '2023-03-28 22:00:46', '', 'staff'),
(2, 'Approved', '2023-03-28 22:00:48', '', 'staff'),
(3, 'Submitted', '2023-03-28 22:06:27', '', 'staff'),
(4, 'Submitted', '2023-03-28 22:06:39', '', 'staff'),
(5, 'Submitted', '2023-03-29 10:52:32', '', 'daveclient'),
(6, 'Submitted', '2023-03-29 10:53:05', '', 'daveclient'),
(6, 'Viewed', '2023-03-29 10:54:31', '', 'staff'),
(5, 'Viewed', '2023-03-29 10:54:33', '', 'staff'),
(5, 'Returned', '2023-03-29 10:56:08', 'Some Reason', 'staff'),
(6, 'Approved', '2023-03-29 10:56:12', '', 'staff'),
(5, 'Updated', '2023-03-29 10:56:43', '', 'client'),
(5, 'Approved', '2023-03-29 10:57:19', '', 'staff'),
(7, 'Submitted', '2023-03-29 11:01:25', '', 'staff'),
(8, 'Submitted', '2023-03-29 11:01:41', '', 'staff'),
(10, 'Submitted', '2023-03-29 12:21:31', '', 'client'),
(11, 'Submitted', '2023-03-29 12:22:10', '', 'client'),
(11, 'Viewed', '2023-03-29 12:23:36', '', 'staff');

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
(1, 'Sample1.xlsx', '01 entity', 'GL', 'March', 2023, 'daveclient', 1, 'clientfile'),
(2, 'Sample2.csv', '01 entity', 'AP', 'March', 2023, 'daveclient', 1, 'clientfile'),
(3, 'Sample BAS1.pdf', '01 entity', NULL, 'March', 2023, 'staff', 1, 'btgfile'),
(4, 'Sample BAS2.pdf', '01 entity', NULL, 'March', 2023, 'staff', 1, 'btgfile'),
(5, 'Sample3.xls', '02 entity', 'AP', 'March', 2023, 'daveclient', 1, 'clientfile'),
(6, 'Sample4.xls', '02 entity', 'AR', 'March', 2023, 'daveclient', 1, 'clientfile'),
(7, 'Sample BAS3.pdf', '02 entity', NULL, 'March', 2023, 'staff', 1, 'btgfile'),
(8, 'Sample BAS4.pdf', '02 entity', NULL, 'March', 2023, 'staff', 1, 'btgfile'),
(10, 'Sample6.xls', '01 entity', 'AP', 'March', 2023, 'client', 1, 'clientfile'),
(11, 'Sample6.xls', '01 entity', 'AP', 'February', 2023, 'client', 1, 'clientfile');

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

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`address`, `mobilenumber`, `telephonenumber`, `username`) VALUES
('Philippines', '123', '123', 'staff2'),
('', '', '', 'dabe03');

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
('admin2', '', 'Account Admin', '', 'admin@email.com', '', 'admin', 2),
('anazeth03', '', 'Anazeth De Guzman', '', 'anazeth@email.com', 'jd9v5n217z034ywtxelh68koirucbq', 'staff', 2),
('chowking', '', 'Kenneth Lee', '5', 'chowking@email.com', '', 'client', 2),
('client', '62608e08adc29a8d6dbc9754e659f125', 'Jolo Cruz', '1', 'jollibee@email.com', '', 'client', 1),
('client2', '2c66045d4e4a90814ce9280272e510ec', 'Maria Juanita', '2', 'mang_inasal@email.com', '', 'client', 1),
('client3', '61f6efe2b994f4bfc37745cf2c4d97f7', 'Stephan Dela Cruz', '3', 'mini_stop@email.com', '', 'client', 1),
('client4', '', 'Steven Grantt', '4', '7_eleven@email.com', '', 'client', 2),
('dabe03', 'b7b22406608b1e2da9ea6672f3f6743d', 'Dave Tablante', '', 'dave.tablante@btgi.com.au', 'knfw8mysu6jqg07l2bzxi43e9dahc5', 'staff', 1),
('daveclient', '39349c9849eaa2c3e7070513e49b6368', 'Dave Jollibee', '1', 'dave.tablante@btgi.com.au', 'dyqt7rj6x3ek5npb02cwmozfvl18ag', 'client', 1),
('davereviewer', '353c227c8160eae1af84f6ba6bd267de', 'Dave Reviewer', '', 'dave.tablante@btgi.com.au', 'jpzuefi26m80dkly41wqnsv75t9xbg', 'reviewer', 1),
('diosdado', '', 'Diosdado Quinto', '5', 'diosdado.quinto@email.com', '2o3in4gzeqhkrt8x1mvp9l5ujdf6y7', 'client', 2),
('juanito', '', 'Juanito Dela Cruz', '2', 'juanito.delacruz@email.com', 'sfu6m4g7cdqnkl5hr1a3ijpboey9w0', 'client', 2),
('maiden', '', 'Maiden Joy Dela Cruz', '', 'maiden@email.com', 'wojvglehbkn0948pc21f6zxt5sad7i', 'staff', 2),
('raul_7eleven', '', 'Raul De Guzman', '4', 'raul.deguzman@email.com', '', 'client', 2),
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
('anazeth03', 1, '01 entity', 1),
('anazeth03', 1, '03 entity', 1),
('staff', 1, '01 entity', 1),
('staff', 2, '01 entity', 1),
('staff', 1, '02 entity', 1),
('reviewer', 1, '01 entity', 1),
('reviewer', 2, '01 entity', 1),
('reviewer', 1, '02 entity', 1),
('dabe03', 1, '01 entity', 1),
('davereviewer', 1, '01 entity', 1);

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
  MODIFY `trailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `filezone`
--
ALTER TABLE `filezone`
  MODIFY `fileid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
