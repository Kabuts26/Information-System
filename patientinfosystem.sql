-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2022 at 03:23 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patientinfosystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `authusers`
--

CREATE TABLE `authusers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authusers`
--

INSERT INTO `authusers` (`id`, `email`, `password`) VALUES
(1, 'admin@admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `checkup_date` date NOT NULL,
  `testtaken` text NOT NULL,
  `diagnosis` text NOT NULL,
  `prescription` text NOT NULL,
  `followup_checkup` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `age`, `address`, `birthday`, `contact_number`, `checkup_date`, `testtaken`, `diagnosis`, `prescription`, `followup_checkup`) VALUES
(3, 'Rae Sean Vitalis V. Amoranto', 21, '111 Sitio Camia, Brgy. Bubukal, Sta. Cruz, Laguna', '2000-12-04', '09194809021', '2020-08-04', 'skin', 'none', 'none', '2020-08-12');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `datetime1` datetime NOT NULL,
  `status` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `datetime1`, `status`, `name`, `email`, `contact_number`) VALUES
(1, '2022-02-21 13:30:00', 'approved', 'Rae Sean Vitalis V. Amoranto', 'raeseanamoranto@gmail.com', '09194809021'),
(4, '2022-03-01 19:05:00', 'approved', 'Luke Skywalker', 'Luke@sample.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(3) NOT NULL,
  `contact_number` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `birthday`, `age`, `contact_number`) VALUES
(2, 'Rae Sean Vitalis V. Amoranto', 'raeseanamoranto@gmail.com', 'raesean', '111 Sitio Camia, Brgy. Bubukal, Sta. Cruz, Laguna', '2000-04-19', 21, '09194809021'),
(3, 'Jomarie Canaria', 'joma@sample.com', 'joma123', 'Gatid, Sta. Cruz, Laguna', '1998-05-05', 22, '09652739359'),
(20, 'Luke Skywalker', 'Luke@sample.com', '123', 'space', '2000-03-02', 21, '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authusers`
--
ALTER TABLE `authusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authusers`
--
ALTER TABLE `authusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
