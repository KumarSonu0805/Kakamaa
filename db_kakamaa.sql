-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2025 at 01:24 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kakamaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `kb_users`
--

CREATE TABLE `kb_users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `vp` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `salt` varchar(20) NOT NULL,
  `otp` varchar(100) NOT NULL,
  `token` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kb_users`
--

INSERT INTO `kb_users` (`id`, `username`, `mobile`, `name`, `email`, `password`, `vp`, `role`, `salt`, `otp`, `token`, `photo`, `language_id`, `status`, `created_on`, `updated_on`) VALUES
(1, 'admin', '0987654321', 'Admin', 'admin@gmail.com', '$2y$10$f.gRZ4AMsLy1d4CNBrPp8euHIyVICsgu0WSAA0SDDnNZS8gSWx.3W', '12345', 'admin', '6nMwd04UhZ3YvsJx', '', '', '', NULL, 1, '2024-09-19 12:52:30', '2025-09-24 04:53:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kb_users`
--
ALTER TABLE `kb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kb_users`
--
ALTER TABLE `kb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
