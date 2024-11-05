-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2024 at 05:43 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbflower`
--

-- --------------------------------------------------------

--
-- Table structure for table `flowers`
--

CREATE TABLE `flowers` (
  `fName` varchar(100) NOT NULL,
  `fType` varchar(100) NOT NULL,
  `fArrival` date NOT NULL,
  `fQuantity` int(100) NOT NULL,
  `fPrice` int(100) NOT NULL,
  `fImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flowers`
--

INSERT INTO `flowers` (`fName`, `fType`, `fArrival`, `fQuantity`, `fPrice`, `fImage`) VALUES
('Blue Lily', 'Lily', '2024-11-20', 24, 67, NULL),
('Pink Lily', 'Lily', '2024-12-19', 50, 67, NULL),
('Red Rose', 'Rose', '2024-11-07', 100, 38, NULL),
('White Lily', 'Lily', '2024-10-27', 57, 67, NULL),
('White Rose', 'Rose', '2024-11-27', 100, 38, NULL),
('Yellow Rose', 'Rose', '2024-11-18', 150, 34, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`fName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
