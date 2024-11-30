-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 03, 2024 at 10:11 AM
-- Server version: 5.7.34
-- PHP Version: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gateway`
--

-- --------------------------------------------------------

--
-- Table structure for table `profit`
--

CREATE TABLE `profit` (
  `id` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Transaction`
--

CREATE TABLE `Transaction` (
  `id` int(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `oid` varchar(255) NOT NULL,
  `vpa` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `tnote` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `time` varchar(2555) NOT NULL,
  `date` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Number` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Balance` varchar(2500) NOT NULL,
  `Password` varchar(2555) NOT NULL,
  `Mid` varchar(255) NOT NULL,
  `Mkey` varchar(255) NOT NULL,
  `TRec` varchar(255) NOT NULL,
  `TWit` varchar(255) NOT NULL,
  `ip` varchar(1500) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profit`
--
ALTER TABLE `profit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Transaction`
--
ALTER TABLE `Transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Transaction`
--
ALTER TABLE `Transaction`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
