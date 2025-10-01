-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2025 at 06:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viva_absen_training`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `active` varchar(1) DEFAULT 'y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `active`) VALUES
(1, 'Administrator', 1, '2025-09-21 14:09:13', 1, '2025-09-21 14:09:13', 'y'),
(2, 'Trainee', 1, '2025-09-21 14:11:47', 1, '2025-09-21 14:11:47', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `password` varchar(100) DEFAULT 'password123',
  `role_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `active` varchar(1) DEFAULT 'y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nik`, `password`, `role_id`, `created_by`, `created_at`, `updated_by`, `updated_at`, `active`) VALUES
(1, 'Leon Susanto', '123', '$2y$10$hPmjS0eMO.czuS9wjJ67Ru8H6hKLEQr6ox2iZTXCczgoonaYIgXXm', 1, 1, '2025-09-20 20:39:43', 1, '2025-10-01 20:25:31', 'y'),
(2, 'Elizabeth', '321', '$2y$10$nvBjMsH4ibIEaqmQ5.4fuOYzggDCrQORWm2DZHQqxtVJ5JeA.BIwC', 1, 1, '2025-09-21 15:03:11', 1, '2025-10-01 20:25:46', 'y'),
(3, 'colo', '1234', '$2y$10$BRql0uhfixSK1RcOC5M1Fe0MwUdxhHOml.sAxWqqRRI9mCcVN7CvO', 2, 1, '2025-09-30 21:18:05', 1, '2025-10-01 23:05:09', 'n'),
(14, 'zerlina', '666', '$2y$10$e1C9uPLsfSKVtQfY//788ufLnwBrPgOUD0xrMAnBl7zAyKVitSGV2', 2, 1, '2025-10-01 23:09:39', 1, '2025-10-01 23:10:51', 'y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
