-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2023 at 01:38 PM
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
  `remarks` varchar(200) NOT NULL
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
(1, 'Submitted', '2023-02-15 18:36:05', '', 'client'),
(2, 'Submitted', '2023-02-15 18:44:14', '', 'client'),
(3, 'Submitted', '2023-02-15 18:45:43', '', 'client'),
(4, 'Submitted', '2023-02-15 18:47:44', '', 'client2'),
(5, 'Submitted', '2023-02-15 18:47:58', '', 'client2'),
(6, 'Submitted', '2023-02-15 18:47:58', '', 'client2'),
(4, 'Viewed', '2023-02-15 18:51:18', '', 'staff'),
(2, 'Viewed', '2023-02-15 18:51:29', '', 'staff'),
(3, 'Viewed', '2023-02-16 22:04:19', '', 'staff'),
(10, 'Submitted', '2023-02-16 22:04:57', '', 'client'),
(3, 'Approved', '2023-02-16 22:06:36', '', 'staff'),
(2, 'Approved', '2023-02-16 22:12:50', '', 'staff'),
(4, 'Returned', '2023-02-16 22:13:08', '', 'staff'),
(1, 'Viewed', '2023-02-16 22:16:54', '', 'staff'),
(1, 'Returned', '2023-02-16 22:28:51', '', 'staff'),
(10, 'Viewed', '2023-02-16 22:30:40', '', 'staff'),
(10, 'Returned', '2023-02-16 22:30:52', '', 'staff'),
(5, 'Viewed', '2023-02-16 22:31:27', '', 'staff'),
(5, 'Returned', '2023-02-16 22:34:30', '* Reaons 1\n* Reason 2', 'staff'),
(14, 'Submitted', '2023-02-16 22:38:47', '', 'client'),
(15, 'Submitted', '2023-02-16 22:39:05', '', 'client'),
(16, 'Submitted', '2023-02-16 22:39:35', '', 'client2'),
(17, 'Submitted', '2023-02-16 22:39:56', '', 'client2'),
(10, 'Updated', '2023-02-16 23:19:18', '', 'client'),
(5, 'Updated', '2023-02-16 23:21:54', '', 'client2'),
(5, 'Returned', '2023-02-16 23:22:47', '* Reason 3\n* Reason 4', 'staff'),
(5, 'Updated', '2023-02-16 23:23:34', '', 'client2'),
(5, 'Approved', '2023-02-16 23:23:55', '', 'staff'),
(16, 'Viewed', '2023-02-17 11:13:54', '', 'staff'),
(16, 'Returned', '2023-02-17 11:15:02', 'Sample Reason', 'staff'),
(16, 'Updated', '2023-02-17 11:16:21', '', 'client2'),
(16, 'Approved', '2023-02-17 11:16:59', '', 'staff'),
(15, 'Viewed', '2023-02-17 12:16:47', '', 'staff'),
(15, 'Returned', '2023-02-17 12:17:22', 'Sample Reason', 'staff'),
(15, 'Updated', '2023-02-17 12:20:15', '', 'client'),
(15, 'Approved', '2023-02-17 12:23:05', '', 'staff'),
(17, 'Viewed', '2023-02-17 14:11:40', '', 'staff'),
(0, 'Submitted', '2023-02-17 14:12:36', '', 'client'),
(19, 'Submitted', '2023-02-17 14:14:22', '', 'client'),
(19, 'Viewed', '2023-02-17 14:15:04', '', 'staff'),
(19, 'Returned', '2023-02-17 14:15:26', 'Reason 1\nReason 2\nReason 3\nReason 4\nReason 5\nReason 6', 'staff'),
(19, 'Updated', '2023-02-17 14:15:56', '', 'client'),
(19, 'Approved', '2023-02-17 14:16:16', '', 'staff'),
(10, 'Approved', '2023-02-20 19:09:35', '', 'staff'),
(17, 'Approved', '2023-02-20 19:09:57', '', 'staff'),
(20, 'Submitted', '2023-03-02 21:00:11', '', 'client'),
(20, 'Viewed', '2023-03-02 21:00:35', '', 'staff2'),
(21, 'Submitted', '2023-03-02 21:30:55', '', 'client2'),
(22, 'Submitted', '2023-03-03 17:04:40', '', 'client');

-- --------------------------------------------------------

--
-- Table structure for table `filezone`
--

CREATE TABLE `filezone` (
  `fileid` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `fileentity` varchar(200) NOT NULL,
  `filetype` varchar(200) NOT NULL,
  `month` varchar(200) NOT NULL,
  `year` int(11) NOT NULL,
  `fileowner` varchar(200) NOT NULL,
  `clientid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filezone`
--

INSERT INTO `filezone` (`fileid`, `filename`, `fileentity`, `filetype`, `month`, `year`, `fileowner`, `clientid`) VALUES
(1, 'Sample1.xlsx', '01 entity', 'AP', 'February', 2023, 'client', 1),
(2, 'Sample2.csv', '01 entity', 'AP', 'February', 2023, 'client', 1),
(3, 'Sample2.csv', '02 entity', 'AP', 'February', 2023, 'client', 1),
(4, 'Sample4.xls', '01 entity', 'GL', 'February', 2023, 'client2', 2),
(5, 'Sample6.xls', '02 entity', 'GL', 'February', 2023, 'client2', 2),
(10, 'Sample5.xls', '01 entity', 'GL', 'February', 2023, 'client', 1),
(14, 'Sample1.xlsx', '02 entity', 'GL', 'February', 2023, 'client', 1),
(15, 'Sample3.xls', '01 entity', 'AP', 'February', 2023, 'client', 1),
(16, 'Sample5.xls', '02 entity', 'AR', 'February', 2023, 'client2', 2),
(17, 'Sample2.csv', '01 entity', 'GL', 'February', 2023, 'client2', 2),
(19, 'Sample7.xls', '01 entity', 'AP', 'February', 2023, 'client', 1),
(20, 'Sample4.xls', '02 entity', 'AR', 'March', 2023, 'client', 1),
(21, 'Sample6.xls', '01 entity', 'AR', 'March', 2023, 'client2', 2),
(22, 'Sample4.xls', '02 entity', 'AP', 'March', 2023, 'client', 1);

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
('dabe03', 'a2308dcda195e4009533aecbbe7043be', 'Dave Tablante', '', 'dave.tablante@btgi.com.au', 'knfw8mysu6jqg07l2bzxi43e9dahc5', 'staff', 1),
('diosdado', '', 'Diosdado Quinto', '5', 'diosdado.quinto@email.com', '2o3in4gzeqhkrt8x1mvp9l5ujdf6y7', 'client', 2),
('juanito', '', 'Juanito Dela Cruz', '2', 'juanito.delacruz@email.com', 'sfu6m4g7cdqnkl5hr1a3ijpboey9w0', 'client', 2),
('maiden', '', 'Maiden Joy Dela Cruz', '', 'maiden@email.com', 'wojvglehbkn0948pc21f6zxt5sad7i', 'staff', 2),
('raul_7eleven', '', 'Raul De Guzman', '4', 'raul.deguzman@email.com', '', 'client', 2),
('staff', '1253208465b1efa876f982d8a9e73eef', 'Juan Luna', '', 'juan.luna@email.com', '', 'staff', 1);

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
  MODIFY `fileid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
