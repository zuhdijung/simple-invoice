-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2023 at 06:42 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoicedetail`
--

CREATE TABLE `invoicedetail` (
  `idinvoicedetail` bigint(20) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `itemtype` varchar(20) NOT NULL,
  `description` longtext NOT NULL,
  `qty` decimal(10,0) NOT NULL,
  `unitprice` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoicedetail`
--

INSERT INTO `invoicedetail` (`idinvoicedetail`, `invoiceID`, `itemtype`, `description`, `qty`, `unitprice`) VALUES
(1, 1, 'Service', 'Meetings', '5', '60'),
(2, 1, 'Service', 'Development', '57', '330'),
(3, 1, 'Service', 'Design', '41', '230'),
(4, 2, 'Service', 'Meetings', '5', '60'),
(5, 2, 'Service', 'Development', '57', '330');

-- --------------------------------------------------------

--
-- Table structure for table `invoiceheader`
--

CREATE TABLE `invoiceheader` (
  `invoiceID` int(11) NOT NULL,
  `issueDate` date NOT NULL,
  `dueDate` date NOT NULL,
  `subject` varchar(50) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `senderAddress` longtext NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `receiverAddress` longtext NOT NULL,
  `statusinvoice` tinyint(1) NOT NULL COMMENT '0: Unpaid, 1: Paid, 2: Terminated',
  `tax` decimal(10,0) NOT NULL,
  `payment` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoiceheader`
--

INSERT INTO `invoiceheader` (`invoiceID`, `issueDate`, `dueDate`, `subject`, `sender`, `senderAddress`, `receiver`, `receiverAddress`, `statusinvoice`, `tax`, `payment`) VALUES
(1, '2023-02-13', '2023-02-28', 'Spring Marketing Camp', 'Discovery Designs', 'Scotland', 'Barrington Publisher', 'United Kingdom', 1, '10', '31394'),
(2, '2023-02-06', '2023-02-20', 'Invoice for A Material', 'PT ABC', 'Jakarta Barat', 'PT BCD', 'Banten', 0, '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoicedetail`
--
ALTER TABLE `invoicedetail`
  ADD PRIMARY KEY (`idinvoicedetail`);

--
-- Indexes for table `invoiceheader`
--
ALTER TABLE `invoiceheader`
  ADD PRIMARY KEY (`invoiceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoicedetail`
--
ALTER TABLE `invoicedetail`
  MODIFY `idinvoicedetail` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoiceheader`
--
ALTER TABLE `invoiceheader`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
