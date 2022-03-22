-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 01:12 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scandiweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `productdash`
--

DROP TABLE IF EXISTS `productdash`;
CREATE TABLE `productdash` (
  `id` int(11) NOT NULL,
  `SKU` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `typeSwitcher` varchar(255) NOT NULL,
  `Size` varchar(255) NOT NULL,
  `Height` varchar(255) NOT NULL,
  `Width` varchar(255) NOT NULL,
  `Length` varchar(255) NOT NULL,
  `Weight` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productdash`
--

INSERT INTO `productdash` (`id`, `SKU`, `Name`, `Price`, `typeSwitcher`, `Size`, `Height`, `Width`, `Length`, `Weight`) VALUES
(31, 'mkkm', 'fouad', '7', '1', '3', '', '', '', ''),
(32, 'mkmk', 'kmMKmk', '45', '3', '', '', '', '', '487'),
(33, '48484884', 'wash', '87', '2', '', '26', '5', '8', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `productdash`
--
ALTER TABLE `productdash`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `SKU` (`SKU`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `productdash`
--
ALTER TABLE `productdash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
