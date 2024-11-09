-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 09:58 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `issuance`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificate_requests`
--

CREATE TABLE `certificate_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `certificate_type` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `purpose` text COLLATE utf8_unicode_ci NOT NULL,
  `pickup_datetime` datetime NOT NULL,
  `status` enum('Pending','Approved','Declined','Released') COLLATE utf8_unicode_ci DEFAULT 'Pending',
  `decline_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `certificate_requests`
--

INSERT INTO `certificate_requests` (`id`, `user_id`, `certificate_type`, `purpose`, `pickup_datetime`, `status`, `decline_reason`, `created_at`) VALUES
(60, 64, 'indigency', 'getting job', '2024-10-31 13:06:00', 'Declined', 'not a resident of Puncan', '2024-10-31 05:05:49'),
(61, 64, 'residency', 'getting voters certification', '2024-10-31 13:50:00', 'Declined', '', '2024-10-31 14:44:25'),
(62, 64, 'residency', 'voters certification', '2024-10-31 22:55:00', 'Released', NULL, '2024-10-31 14:55:42'),
(63, 64, 'residency', 'getting voters certification', '2024-10-31 22:57:00', 'Declined', NULL, '2024-10-31 14:57:23'),
(64, 64, 'indigency', 'getting voters certification', '2024-11-08 09:20:00', 'Declined', '', '2024-11-08 01:20:33'),
(65, 64, 'residency', 'getting voters certification', '2024-11-08 09:21:00', 'Declined', '', '2024-11-08 01:21:57'),
(66, 64, 'indigency', 'getting voters certification', '2024-11-08 09:25:00', 'Declined', '', '2024-11-08 01:25:56'),
(67, 64, 'indigency', 'getting voters certification', '2024-11-08 09:29:00', 'Declined', '', '2024-11-08 01:29:44'),
(68, 64, 'residency', 'getting voters certification', '2024-11-08 09:32:00', 'Declined', '', '2024-11-08 01:32:21'),
(69, 64, 'indigency', 'getting voters certification', '2024-11-08 09:34:00', 'Declined', '', '2024-11-08 01:34:22'),
(70, 64, 'indigency', 'getting voters certification', '2024-11-08 09:36:00', 'Declined', '', '2024-11-08 01:36:22'),
(71, 64, 'indigency', 'getting voters certification', '2024-11-08 09:39:00', 'Declined', '', '2024-11-08 01:39:07'),
(72, 64, 'indigency', 'getting voters certification', '2024-11-08 09:41:00', 'Declined', '', '2024-11-08 01:41:37'),
(73, 64, 'indigency', 'getting voters certification', '2024-11-08 09:42:00', 'Declined', '', '2024-11-08 01:43:02'),
(74, 64, 'indigency', 'getting voters certification', '2024-11-08 09:45:00', 'Declined', '', '2024-11-08 01:45:24'),
(75, 64, 'indigency', 'Scholar', '2024-11-09 16:32:00', 'Declined', '', '2024-11-08 08:32:24'),
(76, 64, 'indigency', 'getting voters certification', '2024-11-08 23:29:00', 'Declined', '', '2024-11-08 15:29:59'),
(77, 64, 'indigency', 'getting voters certification', '2024-11-08 23:33:00', 'Declined', 'not a resident of puncan', '2024-11-08 15:33:56'),
(78, 64, 'indigency', 'getting voters certification', '2024-11-09 12:12:00', 'Declined', 'Not a resident of puncan', '2024-11-09 04:12:45'),
(79, 64, 'indigency', 'claiming scholarship', '2024-11-09 15:23:00', 'Declined', 'not resident of barangay puncan', '2024-11-09 07:23:59'),
(80, 64, 'residency', 'getting voters certification', '2024-11-09 15:27:00', 'Released', NULL, '2024-11-09 07:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `term_start` date DEFAULT NULL,
  `term_end` date DEFAULT NULL,
  `status` enum('Active','End Term') COLLATE utf8_unicode_ci DEFAULT 'Active',
  `is_signatory` enum('active','inactive') COLLATE utf8_unicode_ci DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`id`, `fullname`, `position`, `contact`, `term_start`, `term_end`, `status`, `is_signatory`) VALUES
(5, 'Wilson Smith', 'Barangay Captain', '09159285613', '2023-07-30', '2025-07-30', 'Active', 'active'),
(20, 'Harry Potter', 'Barangay Secretary', '1234567890', '2024-10-20', '2024-11-05', 'End Term', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bday` date NOT NULL,
  `gender` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stay` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barangay` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `municipality` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pendingcase` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caseDetails` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes',
  `role` enum('admin','resident') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'resident',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `age`, `phone`, `bday`, `gender`, `status`, `place`, `stay`, `postal`, `zone`, `barangay`, `municipality`, `province`, `mother_name`, `father_name`, `pendingcase`, `caseDetails`, `verify_token`, `verify_status`, `role`, `created_at`) VALUES
(35, 'test', 'test@mailinator.com', '$2y$10$N0cGwHpAQK8KnDWCzANG..gQwZOntr3N7xqMgiSjlApfE0LEwxIN6', 0, '1234567890', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dea13585486c3158943dd4d8a479cfaa', 0, 'admin', '2024-10-22 11:17:07'),
(42, 'Jane Smith', '', '$2y$10$vy6oQq/qeYym9MQEE.5l8ejv5gmIgL1IMRHEWvG49qMu7CTFY19ue', 25, '09123456799', '1999-09-02', 'female', 'single', 'Carranglan', '2002', '3123', 'Sitio Boring', 'Puncan', 'Carranglan', 'Nueva Ecija', 'Jenny Smith', 'Harry Smith', 'no', '', '', 0, 'resident', '2024-10-25 06:07:18'),
(46, 'John Doe', 'doe@gmail.com', '$2y$10$2Lu5Ko4Fon4PpEQJis/lHOyyuyju012O7rFI.OLCRpOnnbaz8mywu', 23, '91787836', '1999-09-02', 'male', 'single', 'Carranglan', '2000', '3123', 'Sitio Curva', 'Puncan', 'Carranglan', 'Nueva Ecija', 'Carol Doe', 'Clark Doe', 'no', '', 'e770d9d09e8647b9ae6d0da1b5ed2994', 1, 'resident', '2024-10-27 04:35:06'),
(47, 'Sherlock Holmes', 'lockholmes@gmail.com', '$2y$10$3Dbhv5nsFYP8dBHyQdVmiurqnvqOyZaWHrhLjd1fP1YJEXdsT3rfi', 25, '09123456799', '1999-09-02', 'male', 'single', 'Carranglan', '2000', '3123', 'Sitio Lahud', 'Puncan', 'Carranglan', 'Nueva Ecija', 'Mrs. Holmes', 'Professor Siger Holmes', 'no', '', '9a141fe010059c64b4450f1267e03837', 0, 'resident', '2024-10-27 04:44:09'),
(48, 'Charlie Davis', 'pauladrianm66@gmail.com', '$2y$10$zM7qLzNHcmPjbHRE1DKtY.lAObXKSjksvn7QaIgSIT9vgWErXiXAq', 25, '09123456799', '1999-09-02', 'male', 'single', 'Carranglan', '2000', '3123', 'Sitio Lahud', 'Puncan', 'Carranglan', 'Nueva Ecija', 'Karen Davis', 'John Davis', 'no', '', '9dfece69d9e1b586cb4491c298e56fda', 0, 'resident', '2024-10-27 04:45:12'),
(55, 'Bob Brown', NULL, '', 50, '909909090', '1973-09-09', 'male', 'widowed', 'Los Angeles California', '2015', '3123', 'Sitio Lahud', 'Puncan', 'Carranglan', 'Nueva Ecija', 'Nancy Brown', 'Peter Brown', 'no', '', '', 0, 'resident', '2024-10-27 05:26:10'),
(57, 'Juan Dela Cruz', 'christineangelabelogot@gmail.com', '$2y$10$t7Tn/gh4H8jkRTdmbtoZTeDxqjPlImp.KnyRSeGk8jPUA9KJi17l.', 50, '09123456799', '1973-08-02', 'male', 'widowed', 'Carranglan', '2000', '3123', 'Sitio Boring', 'Puncan', 'Carranglan', 'Nueva Ecija', 'Segunda Katigbak', 'Jose Rizal', 'no', '', '0d7fff7d96890497754bea58edad9d1e', 0, 'resident', '2024-10-27 05:35:01'),
(58, 'Wilson Smith', NULL, '', 35, '123456789', '1990-09-03', 'male', 'married', 'Pampangan', '2009', '3123', 'Sitio Taktak', 'Puncan', 'Carranglan', 'Nueva Ecija', 'deceased', 'deceased', 'no', '', '', 0, 'resident', '2024-10-27 05:47:29'),
(60, 'Barangay Puncan', 'brgypuncan@gmail.com', '$2y$10$epqqiJAEPTreS3XoLzYdM.2M1sYYjKnkkOC6ixgrveIzHnHVcGX.K', 0, '09156303143', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 'admin', '2024-10-27 09:46:05'),
(63, 'nnn', 'nn2gmail.com', '$2y$10$eTesb.p.GJY88gJQLxoOx.9bHM7.QVYXNB4L0h7caxGbIb1olJAKa', 0, '0909', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 'admin', '2024-10-31 04:28:23'),
(64, 'Julyda Miguel Alfonso', 'elagorjaas@gmail.com', '$2y$10$gOEu9gIZ5.YLiJZBFxNzROEJfjGL4/8TSCUqKtCYqtQMiIuz4sXDa', 22, '111', '2024-10-31', 'female', 'single', 'Carranglan', '2000', '3123', 'Sitio Boring', 'Puncan', 'Carranglan', 'Nueva Ecija', 'Elsa Manaloto', 'Pepito Manaloto', 'no', '', '3fc329178c8b7a7b8cec7c2c76901aad', 1, 'resident', '2024-10-31 05:04:54'),
(65, 'Julyda alfonso', 'julydaalfonso@gmail.com', '$2y$10$8gJ1rRte6Kvq/.XmyWopqeZNeq8qul02Ln5a.3kIqSQYTvv11z22i', 22, '09069912345', '2024-11-08', 'female', 'single', 'Tayabo', '.', '3123', 'Sitio Bukig', 'Puncan', '--Please Select--', '--Please Select--', 'Reve', 'Maximo', '', '', '78b16ac8bcf63e4106be00f390879b1a', 0, 'resident', '2024-11-08 08:39:09'),
(66, 'Lyca Laborera Magday', 'lycamagday4@gmail.com', '$2y$10$JVoOVerF9tTPJrmaO6NYfuytDOfIYMJPWfYkp6aLS7.dieYMSI4TK', 24, '09913441553', '2000-08-04', 'male', 'single', 'Carranglan ', '24', '3123', 'Sitio Taktak', 'Puncan', 'Carranglan', 'Nueva Ecija', 'Perry laborera magday', 'Rizaldy alcantara magday', 'no', '', '688d93093be64e7457271e7aaefb74c9', 0, 'resident', '2024-11-08 08:39:11'),
(69, 'Froilan Organista', 'lyca4@gmail.com', '$2y$10$dFYcMxHZLq7zgzzAjcYMdukRfXSIL8kK7DKwp.nDfL8uzqcxHr8/2', 23, '09159285613', '2024-11-09', 'female', 'single', 'Puncan', '2005', '3123', 'Sitio Lahud', 'Puncan', 'Carranglan', 'Nueva Ecija', 'Di nya mama si riza', 'Papa nya seaman', 'yes', 'Nag sharon ng handa', '63754d08f2257dbed5a8cb90d98a2473', 0, 'resident', '2024-11-09 05:20:51'),
(70, 'Froilan Organista', 'lycamagday04@gmail.com', '$2y$10$Qjk1Q9Zk3nopeGJFShdrfunaaz1.aDDMQurzKTBFe9HCzBaMm5CKG', 23, '09159285613', '2024-11-09', 'female', 'single', 'Puncan', '2005', '3123', 'Sitio Boring', 'Puncan', 'Carranglan', 'Nueva Ecija', 'Di nya mama si riza', 'Papa nya seaman', 'no', '', '0d122b06c93288fa8acc814173a934ef', 0, 'resident', '2024-11-09 05:24:05'),
(71, 'Froilan Organista', 'lycamagday104@gmail.com', '$2y$10$seGvvfkusYAZqOSpZ26LheHT49gIf3I3GrL0UGz9TgXQk68QoJWyK', 23, '09159285613', '2024-11-09', 'female', 'single', 'Puncan', '2005', '3123', 'Sitio Boring', 'Puncan', 'Carranglan', 'Nueva Ecija', 'Di nya mama si riza', 'Papa nya seaman', 'no', '', '80a75860e613e707a5810333297e842d', 0, 'resident', '2024-11-09 05:28:09'),
(75, 'Froilan organista', 'reygieb6@gmail.com', '$2y$10$XgIkgvewICnh6GQ4jprFvek0JzCgZd7rtuNUMbgwIcuL313E/wUKW', 22, '09061068716', '2001-12-23', 'male', 'widowed', 'Carranglan', '2005', '3100', 'Sitio Taktak', 'Bantug', 'Bongabon', 'Albay', 'Hshshshs', 'Papa nya seaman pero wala', 'yes', 'Jshahahha', '3124878c2cd33dfd97a4341bacc00c42', 1, 'resident', '2024-11-09 05:54:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate_requests`
--
ALTER TABLE `certificate_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificate_requests`
--
ALTER TABLE `certificate_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificate_requests`
--
ALTER TABLE `certificate_requests`
  ADD CONSTRAINT `certificate_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
