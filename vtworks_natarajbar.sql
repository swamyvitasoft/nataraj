-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 20, 2023 at 12:38 PM
-- Server version: 10.3.25-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vtworks_natarajbar`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance_sheet`
--

CREATE TABLE `balance_sheet` (
  `bs_id` int(11) NOT NULL,
  `bs_date` date NOT NULL,
  `ac` decimal(10,2) NOT NULL,
  `nonac` decimal(10,2) NOT NULL,
  `janatha` decimal(10,2) NOT NULL,
  `expenditure` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balance_sheet`
--

INSERT INTO `balance_sheet` (`bs_id`, `bs_date`, `ac`, `nonac`, `janatha`, `expenditure`, `grand_total`) VALUES
(13, '2023-02-20', '234.00', '0.00', '0.00', '0.00', '234.00'),
(12, '2023-02-19', '1046.00', '1624.00', '1198.00', '774.00', '3094.00');

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE `expenditure` (
  `expen_id` int(11) NOT NULL,
  `counter` enum('ac','nonac','janatha') NOT NULL,
  `amount` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `edate` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`expen_id`, `counter`, `amount`, `reason`, `edate`, `status`) VALUES
(16, 'janatha', 500, 'Mutton', '2023-02-19', 1),
(15, 'nonac', 24, 'Glases', '2023-02-19', 1),
(14, 'ac', 250, 'Chicken', '2023-02-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `sno` int(11) NOT NULL,
  `brand_name` varchar(20) NOT NULL,
  `ac` int(11) NOT NULL,
  `nonac` int(11) NOT NULL,
  `janatha` int(11) NOT NULL,
  `bdate` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `load_data` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`sno`, `brand_name`, `ac`, `nonac`, `janatha`, `bdate`, `status`, `load_data`) VALUES
(46, 'BSP', 156, 145, 142, '2023-02-20', 1, 1),
(45, 'Black Dog', 456, 435, 411, '2023-02-19', 1, 1),
(44, '100 Pipers', 256, 230, 215, '2023-02-20', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sales_id` int(11) NOT NULL,
  `rates_id` int(11) NOT NULL,
  `counter` enum('ac','nonac','janatha') NOT NULL,
  `bname` varchar(50) NOT NULL,
  `opening` decimal(10,2) NOT NULL,
  `receipts` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `sales` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `rate` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `sdate` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sales_id`, `rates_id`, `counter`, `bname`, `opening`, `receipts`, `total`, `sales`, `balance`, `rate`, `amount`, `sdate`, `status`) VALUES
(112, 44, 'janatha', '100 Pipers', '11.00', '0.00', '11.00', '0.00', '11.00', 215, '0.00', '2023-02-20', 1),
(103, 44, 'ac', '100 Pipers', '0.00', '13.00', '13.00', '2.00', '11.00', 256, '512.00', '2023-02-19', 1),
(102, 44, 'nonac', '100 Pipers', '0.00', '13.00', '13.00', '2.00', '11.00', 232, '464.00', '2023-02-19', 1),
(101, 44, 'janatha', '100 Pipers', '0.00', '13.00', '13.00', '2.00', '11.00', 215, '430.00', '2023-02-19', 1),
(100, 45, 'ac', 'Black Dog', '0.00', '15.50', '15.50', '1.00', '14.50', 456, '456.00', '2023-02-19', 1),
(99, 45, 'nonac', 'Black Dog', '0.00', '15.50', '15.50', '2.00', '13.50', 435, '870.00', '2023-02-19', 1),
(98, 45, 'janatha', 'Black Dog', '0.00', '15.50', '15.50', '1.00', '14.50', 411, '411.00', '2023-02-19', 1),
(97, 46, 'ac', 'BSP', '0.00', '14.00', '14.00', '0.50', '13.50', 156, '78.00', '2023-02-19', 1),
(104, 46, 'ac', 'BSP', '13.50', '1.00', '14.50', '1.50', '13.00', 156, '234.00', '2023-02-20', 1),
(105, 46, 'nonac', 'BSP', '12.00', '0.00', '12.00', '0.00', '12.00', 145, '0.00', '2023-02-20', 1),
(106, 46, 'janatha', 'BSP', '13.00', '0.00', '13.00', '0.00', '13.00', 142, '0.00', '2023-02-20', 1),
(107, 45, 'ac', 'Black Dog', '14.50', '0.00', '14.50', '0.00', '14.50', 456, '0.00', '2023-02-20', 1),
(111, 44, 'nonac', '100 Pipers', '11.00', '0.00', '11.00', '0.00', '11.00', 230, '0.00', '2023-02-20', 1),
(110, 44, 'ac', '100 Pipers', '11.00', '0.00', '11.00', '0.00', '11.00', 256, '0.00', '2023-02-20', 1),
(109, 45, 'janatha', 'Black Dog', '14.50', '0.00', '14.50', '0.00', '14.50', 411, '0.00', '2023-02-20', 1),
(95, 46, 'janatha', 'BSP', '0.00', '14.00', '14.00', '1.00', '13.00', 142, '142.00', '2023-02-19', 1),
(108, 45, 'nonac', 'Black Dog', '13.50', '0.00', '13.50', '0.00', '13.50', 435, '0.00', '2023-02-20', 1),
(96, 46, 'nonac', 'BSP', '0.00', '14.00', '14.00', '2.00', '12.00', 145, '290.00', '2023-02-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `name`, `phone`, `email`, `password`, `status`) VALUES
(1, 'admin', '9876543211', 'admin@gmail.com', '123456', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance_sheet`
--
ALTER TABLE `balance_sheet`
  ADD PRIMARY KEY (`bs_id`);

--
-- Indexes for table `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`expen_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance_sheet`
--
ALTER TABLE `balance_sheet`
  MODIFY `bs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `expenditure`
--
ALTER TABLE `expenditure`
  MODIFY `expen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
