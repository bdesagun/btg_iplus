-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2023 at 11:49 AM
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
-- Table structure for table `filehistory`
--

CREATE TABLE `filehistory` (
  `fileid` int(11) NOT NULL,
  `filestatus` varchar(200) NOT NULL,
  `filedate` datetime NOT NULL,
  `updatedby` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `filezone`
--

CREATE TABLE `filezone` (
  `fileid` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `filetype` varchar(200) NOT NULL,
  `month` varchar(200) NOT NULL,
  `fileowner` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filezone`
--

INSERT INTO `filezone` (`fileid`, `filename`, `filetype`, `month`, `fileowner`) VALUES
(1, 'Sample File', 'CA', 'January', 'admin'),
(2, 'Sample File 2', 'GL', 'February', 'admin'),
(3, 'Sample File 2', 'GL', 'February', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `accountname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`username`, `password`, `accountname`, `email`, `position`, `active`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin.admin@admin.com', 'staff', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filezone`
--
ALTER TABLE `filezone`
  ADD PRIMARY KEY (`fileid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filezone`
--
ALTER TABLE `filezone`
  MODIFY `fileid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
