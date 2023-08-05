-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 04, 2023 at 07:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `user_id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`user_id`, `user`, `password`) VALUES
(1, 'sarojoffl', 'be8bd76a4208bb669541fb204e41628e'),
(2, 'skhadka', '0367f9e0cf4653f94110318342ea249a');

-- --------------------------------------------------------

--
-- Table structure for table `blood_donation`
--

CREATE TABLE `blood_donation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bloodgroup` varchar(5) NOT NULL,
  `unit` int(11) NOT NULL,
  `disease` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_donation`
--

INSERT INTO `blood_donation` (`id`, `user_id`, `bloodgroup`, `unit`, `disease`, `age`, `date`, `status`) VALUES
(9, 13, 'AB+', 40, 'Nothing', 22, '2023-08-04', 'Approved'),
(10, 16, 'A+', 50, 'Cancer', 21, '2023-08-04', 'Approved'),
(11, 17, 'B+', 40, 'Nothing', 21, '2023-08-04', 'Approved'),
(12, 18, 'A+', 20, 'Nothing', 21, '2023-08-04', 'Approved'),
(13, 18, 'O+', 30, 'Nothing', 34, '2023-08-04', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `blood_units`
--

CREATE TABLE `blood_units` (
  `id` int(11) NOT NULL,
  `bloodgroup` varchar(20) NOT NULL,
  `units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_units`
--

INSERT INTO `blood_units` (`id`, `bloodgroup`, `units`) VALUES
(33, 'A+', 408),
(34, 'B+', 80),
(35, 'O+', 135),
(36, 'AB+', 105),
(37, 'A-', 27),
(38, 'B-', 0),
(39, 'O-', 95),
(40, 'AB-', 83);

-- --------------------------------------------------------

--
-- Table structure for table `donor_info`
--

CREATE TABLE `donor_info` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `bloodgroup` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `mobile` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor_info`
--

INSERT INTO `donor_info` (`user_id`, `firstname`, `lastname`, `user`, `password`, `bloodgroup`, `address`, `mobile`) VALUES
(16, 'Sahil', 'Shrestha', 'Mogambo', '$2y$10$LFfLzBpY.JDwTz78T.Ufkuw.eLGrRFzlQxv0tSvAVc/QyLqXeKrdW', 'A+', 'Kathmandu', 9862015811),
(18, 'Dipesh', 'Thapa Magar', 'dipesh', '$2y$10$w6OIdFfOe6Va0hV03FrNdueX.9KqbpvD7RV8gfncscu3jnV7DaDwS', 'O+', 'balkumari', 9800000000);

-- --------------------------------------------------------

--
-- Table structure for table `patient_info`
--

CREATE TABLE `patient_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `patient_name` varchar(20) NOT NULL,
  `patient_age` int(11) NOT NULL,
  `reason` varchar(20) NOT NULL,
  `bloodgroup` varchar(20) NOT NULL,
  `unit` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_info`
--

INSERT INTO `patient_info` (`id`, `user_id`, `patient_name`, `patient_age`, `reason`, `bloodgroup`, `unit`, `date`, `status`) VALUES
(25, 16, 'Saroj', 21, 'Crash', 'AB+', 50, '2023-08-04', 'Approved'),
(26, 16, 'Krishna', 21, 'Accident', 'B+', 100, '2023-08-04', 'Rejected'),
(27, 17, 'krishna', 21, 'sdfghj', 'B+', 30, '2023-08-04', 'Approved'),
(28, 18, 'Sahil', 21, 'accident', 'B-', 10, '2023-08-04', 'Rejected'),
(29, 18, 'Test', 30, 'Test', 'B-', 72, '2023-08-04', 'Approved'),
(30, 18, 'Test2', 2, 'Test2', 'A-', 20, '2023-08-04', 'Approved'),
(31, 18, 'Keshav', 21, 'accident', 'AB-', 100, '2023-08-04', 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `blood_donation`
--
ALTER TABLE `blood_donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_units`
--
ALTER TABLE `blood_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor_info`
--
ALTER TABLE `donor_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blood_donation`
--
ALTER TABLE `blood_donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `blood_units`
--
ALTER TABLE `blood_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `donor_info`
--
ALTER TABLE `donor_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `patient_info`
--
ALTER TABLE `patient_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
