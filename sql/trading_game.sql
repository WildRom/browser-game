-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 09:14 AM
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
-- Database: `trading_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `buy_price` int(11) NOT NULL,
  `sell_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`id`, `name`, `port`, `buy_price`, `sell_price`) VALUES
(1, 'Wool', 'England', 10, 20),
(2, 'Wine', 'France', 15, 30),
(3, 'Olive Oil', 'Spain', 20, 40),
(4, 'Silk', 'Italy', 25, 50),
(5, 'Marble', 'Greece', 30, 60),
(6, 'Spices', 'Turkey', 35, 70),
(7, 'Papyrus', 'Egypt', 40, 80),
(8, 'Cotton', 'India', 45, 90),
(9, 'Porcelain', 'China', 50, 100),
(10, 'Tea', 'Japan', 55, 110);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) UNSIGNED NOT NULL,
  `nick_name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `group` tinyint(3) UNSIGNED DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `ip` varchar(191) DEFAULT NULL,
  `gold` int(10) UNSIGNED DEFAULT NULL,
  `ship_capacity` int(10) UNSIGNED DEFAULT NULL,
  `current_port` tinyint(3) UNSIGNED DEFAULT NULL,
  `departed` tinyint(3) UNSIGNED DEFAULT NULL,
  `destination` tinyint(3) NOT NULL DEFAULT 0,
  `departure_time` int(10) UNSIGNED DEFAULT NULL,
  `arriving_time` int(10) NOT NULL DEFAULT 0,
  `created_at` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `nick_name`, `email`, `password`, `group`, `avatar`, `ip`, `gold`, `ship_capacity`, `current_port`, `departed`, `destination`, `departure_time`, `arriving_time`, `created_at`, `updated_at`) VALUES
(1, 'Valdas', 'v@g.com', '$2y$10$PC1DWe1ltS4LS/xKawOXxOHj55UZHMxCe6XV1qsexmFvXU9cSxNve', 1, 'default.png', '::1', 100, 20, 0, 1, 2, 1718615245, 1718633245, 1718603928, 1718603928),
(2, 'Petras', 'v@g.com', '$2y$10$FFtCBSGHzy.wdGSmmJN34uUXZwjSQ1s.dn9FXuFtM3ogBdk0dXL7.', 1, 'default.png', '::1', 100, 20, 1, 0, 0, 1718604838, 0, 1718604838, 1718604838);

-- --------------------------------------------------------

--
-- Table structure for table `ports`
--

CREATE TABLE `ports` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `goods` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `travel_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ports`
--

INSERT INTO `ports` (`id`, `name`, `goods`, `price`, `travel_time`) VALUES
(1, 'England', 'Wool', 10, 0),
(2, 'France', 'Wine', 15, 1),
(3, 'Spain', 'Olive Oil', 20, 2),
(4, 'Italy', 'Silk', 25, 3),
(5, 'Greece', 'Marble', 30, 4),
(6, 'Turkey', 'Spices', 35, 5),
(7, 'Egypt', 'Papyrus', 40, 6),
(8, 'India', 'Cotton', 45, 7),
(9, 'China', 'Porcelain', 50, 8),
(10, 'Japan', 'Tea', 55, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ports`
--
ALTER TABLE `ports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ports`
--
ALTER TABLE `ports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
