-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 24, 2025 at 04:13 PM
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
-- Database: `blood_donation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `ad_type` enum('blood','operation') NOT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `name`, `city`, `contact`, `description`, `ad_type`, `blood_group`, `created_at`) VALUES
(2, 'sdd', 'mahara', '555', 'hshsj', 'blood', 'B+', '2024-12-23 15:15:16'),
(3, 'sdd', 'mahara', '555', 'hshsj', 'blood', 'B+', '2024-12-23 15:15:56'),
(4, 'jsjk', 'kandy', '5555', 'kjbkdbfkbdfbskjcdzc jdbczsdkbckxzjczdbckdbckbdzvbdkslc zxjdbvcidhfdbkfcbiau', 'operation', 'O+', '2024-12-23 15:19:38'),
(5, 'hh', 'yakkala', '84523', 'jnjjs', 'operation', 'O-', '2024-12-23 16:20:35'),
(6, 'hshsh', 'Colombo', '5255612', 'gvdjbsklhva63svdjsbn', 'operation', 'B-', '2024-12-23 16:59:24'),
(7, 'nimal', 'kadawatha', '0454949655', 'want to operation Rs 1000000/-', 'operation', 'B+', '2024-12-25 16:01:30'),
(8, 'sah', 'kadawatha', '0702263636', 'sss', 'operation', 'O+', '2024-12-30 16:59:26');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `message` text DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor`, `appointment_date`, `appointment_time`, `message`, `payment_method`, `invoice_number`, `created_at`) VALUES
(1, 1, 'pediatrician', '2024-12-29', '15:33:00', 'hbdbdabjS', 'credit_card', 'INV-67711EDEA56C3', '2024-12-29 10:05:18'),
(2, 2, 'general_practitioner', '2024-12-29', '21:08:00', 'saa', 'bank_transfer ', 'INV-67716D0F0A441', '2024-12-29 15:38:55'),
(3, 3, 'cardiologist', '2024-12-29', '21:36:00', 'ffkk', 'bank_transfer ', 'INV-6771718A31B55', '2024-12-29 15:58:02'),
(4, 4, 'cardiologist', '2024-12-30', '23:16:00', 'sss', 'debit_card', 'INV-6772C0697E366', '2024-12-30 15:46:49'),
(5, 5, 'orthopedic_surgeon', '2024-12-30', '21:54:00', 'uhddnjs hhjdnm ', 'debit_card', 'INV-6772C93D52573', '2024-12-30 16:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `donor_id` int(11) NOT NULL,
  `unique_registration_number` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `date_of_birth` date NOT NULL,
  `blood_group` varchar(3) NOT NULL,
  `body_weight` decimal(5,2) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `full_address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_donation_date` date DEFAULT NULL,
  `total_donations` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`donor_id`, `unique_registration_number`, `full_name`, `gender`, `date_of_birth`, `blood_group`, `body_weight`, `email`, `contact_number`, `full_address`, `city`, `province`, `pincode`, `registration_date`, `last_donation_date`, `total_donations`, `is_active`) VALUES
(1, 'BLD2024121891', 'sahan', 'Male', '2024-12-25', 'A+', 75.00, 'sahan@gmail.com', '0132555588', '13/2/A, Katuwalamulla, Ganemulla', 'Ganemulla', 'Western', '11020', '2024-12-25 05:44:21', NULL, 0, 1),
(2, 'BLD2024123422', 'Saman', 'Male', '2024-12-11', 'AB+', 50.00, 'sahan200317@gmail.com', '5955555555', '13/2/A, Katuwalamulla, Ganemulla', 'kadawatha', 'Southern', '552232', '2024-12-25 05:47:27', NULL, 0, 1),
(3, 'BLD2024124234', 'kamal', 'Male', '1999-05-09', 'A-', 60.00, 'ksjjs@gmail.com', '0754646988', 'gdggdgggsfsdf', 'malabe', 'Western', '57555', '2024-12-25 15:56:10', NULL, 0, 1),
(4, 'BLD2024122104', 'Namal', 'Male', '1995-06-15', 'A-', 68.00, 'bdcsdj@gmail.com', '0132555588', '624551bhsvdjknm', 'gampaha', 'Western', '655666', '2024-12-30 16:37:02', NULL, 0, 1),
(5, 'BLD2024124305', 'kamala', 'Female', '1960-05-05', 'O+', 50.00, 'hcjjd@gmail.com', '4512045321', 'jsjnsdn', 'galle', 'Southern', '52329', '2024-12-30 16:46:30', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `full_name`, `contact_number`, `email`, `created_at`) VALUES
(1, 'sdjsk', '0254555555', '', '2024-12-29 10:05:18'),
(2, 'Sahan', '0702263636', '', '2024-12-29 15:38:54'),
(3, 'dddd', '5656858579', '', '2024-12-29 15:58:01'),
(4, 'hshsh', '0132555588', '', '2024-12-30 15:46:49'),
(5, 'Kamal', '05564848998', '', '2024-12-30 16:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `created_at`, `reset_token`, `token_expiry`) VALUES
(1, 'sahan', 'thejana', 'sahan@gmail.com', '$2y$10$aArS9hqgtIXeukETRbbFZeWo7TnUdBHjqbw8ihsduPrG2C8YomIBW', '2024-12-29 09:20:47', '632c27e6b9e6c0bb041677a1e17382d50491d06d0edd8ddc2b7f7e49f3fc507a75a8beb03b7d70c0e9a7ec1173106984682c', '2024-12-29 11:38:13'),
(2, 'Kamal', 'Kamal', 'Kamal@gmail.com', '$2y$10$yYSY9s.XqYWee8ErGQl6tOSVLXh1tnKRKvpxK4NCITIxqsCFuHusu', '2024-12-29 09:24:52', NULL, NULL),
(3, 'amal', 'amal', 'amal@gmail.com', '$2y$10$RDDk5.gPam.UorCH77dNk.CJSjJFRGYI4ZOkLXnlgbLlmGhWeoAfG', '2024-12-29 09:41:34', NULL, NULL),
(4, 'Sahan', 'TT', 'S@gmail.com', '$2y$10$.O4oSwsH63mmXvG40xM9O./mU7htrh1fV1IVWzMUeGp3256O0vtla', '2025-01-02 09:02:46', NULL, NULL),
(5, 'Sahan', 'Sahan', 'S12@gmail.com', '$2y$10$Il8OEvoQqGr7clnmFl49se7gqH5hprxFjCWeHgYcFjrQiCNCHkUHS', '2025-02-24 15:04:04', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`donor_id`),
  ADD UNIQUE KEY `unique_registration_number` (`unique_registration_number`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_name` (`full_name`),
  ADD KEY `idx_blood_group` (`blood_group`),
  ADD KEY `idx_province` (`province`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
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
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
