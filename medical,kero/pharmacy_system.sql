-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2026 at 01:49 AM
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
-- Database: `pharmacy system`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacies`
--

CREATE TABLE `pharmacies` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacies`
--

INSERT INTO `pharmacies` (`id`, `name`, `email`, `password`, `address`, `phone`, `image`) VALUES
(8, 'شفاء', 'shafa345@gmail.com', '11', '', '01274839373', ''),
(9, 'العزبي', 'azabee1234@gmail.com', '12', 'شبرا مصر', '01283637822', 'upload/og1HYzTGjDCbeErm0KnO.jpg'),
(10, 'العزبي', 'azabee1234@gmail.com', '13', '', '01283637822', ''),
(11, 'العزبي', 'azabee1234@gmail.com', '13', '', '01283637822', ''),
(12, 'العزبي', 'azabee1234@gmail.com', '133', '', '01283637822', ''),
(13, 'العزبي', 'azabee1234@gmail.com', '117', 'شبرا مصر', '01283637822', ''),
(14, 'العزبي', 'azabee1234@gmail.com', '1175432', 'شبرا مصر', '0128363', ''),
(15, 'العزبي', 'azabee1234@gmail.com', '1175432111111111111', 'شبرا مصر', '0128363222222222', ''),
(16, 'العزبي', 'azabee1234@gmail.com', '1175432111111111111', 'شبرا مصر', '0128363222222222', ''),
(17, 'العزبي', 'azabee1234@gmail.com', 'wi011`', 'شبرا مصر', '01283637822', 'upload/tyl.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_medicines`
--

CREATE TABLE `pharmacy_medicines` (
  `id` int(11) NOT NULL,
  `pharmacy_id` int(11) NOT NULL,
  `medicinename` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_medicines`
--

INSERT INTO `pharmacy_medicines` (`id`, `pharmacy_id`, `medicinename`, `price`, `description`, `image`) VALUES
(3, 17, 'بنادول', 120.00, 'بيساعد في الصداع', 'upload/6a849c8697b43_images.jpg'),
(4, 17, 'بنادول', 120.00, 'بيساعد في الصداع', 'upload/6a849c95bf719_images.jpg'),
(12, 17, 'fjl', 120.00, 'بيساعد في الصداع', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacies`
--
ALTER TABLE `pharmacies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_medicines`
--
ALTER TABLE `pharmacy_medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pharmacy_id` (`pharmacy_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pharmacies`
--
ALTER TABLE `pharmacies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pharmacy_medicines`
--
ALTER TABLE `pharmacy_medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pharmacy_medicines`
--
ALTER TABLE `pharmacy_medicines`
  ADD CONSTRAINT `pharmacy_medicines_ibfk_1` FOREIGN KEY (`pharmacy_id`) REFERENCES `pharmacies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
