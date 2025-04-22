-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2025 at 03:28 AM
-- Server version: 10.11.11-MariaDB-0ubuntu0.24.04.2
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mySite`
--

-- --------------------------------------------------------

--
-- Table structure for table `myFooter`
--

CREATE TABLE `myFooter` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `myFooter`
--

INSERT INTO `myFooter` (`id`, `copyright_text`, `year`) VALUES
(1, '© Eva Lugo. All rights reserved.', '2025');

-- --------------------------------------------------------

--
-- Table structure for table `myLabs`
--

CREATE TABLE `myLabs` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `myLabs`
--

INSERT INTO `myLabs` (`id`, `name`, `description`, `path`, `image`) VALUES
(2, 'Lab 2', 'HTML & CSS Resume', 'labs/3/lab2.html', 'fas fa-flask'),
(3, 'Lab 4', 'XML & RSS', 'labs/4/index.html', 'fas fa-flask'),
(4, 'Lab 8', 'Dynamic Website', 'labs/8/lab8.html', 'fas fa-flask'),
(5, 'Lab 9', 'PHP and MySQL', 'labs/9/inclassexample/index.php', 'fas fa-flask'),
(6, 'Lab 10', 'Final Lab', 'labs/10/index.php', 'fas fa-flask');

-- --------------------------------------------------------

--
-- Table structure for table `myProjects`
--

CREATE TABLE `myProjects` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `myProjects`
--

INSERT INTO `myProjects` (`id`, `name`, `description`, `url`, `image`) VALUES
(1, 'Team 07 Project', 'Beyond the Zodiac', 'http://lugoerpi.eastus.cloudapp.azure.com/iit/team%20project/homepage/home.html', 'fas fa-star');

-- --------------------------------------------------------

--
-- Table structure for table `mySiteUsers`
--

CREATE TABLE `mySiteUsers` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_type` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mySiteUsers`
--

INSERT INTO `mySiteUsers` (`id`, `username`, `password`, `name`, `user_type`) VALUES
(1, 'root', 'PRLugo22!', 'eva', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `myFooter`
--
ALTER TABLE `myFooter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myLabs`
--
ALTER TABLE `myLabs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myProjects`
--
ALTER TABLE `myProjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mySiteUsers`
--
ALTER TABLE `mySiteUsers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `myFooter`
--
ALTER TABLE `myFooter`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `myLabs`
--
ALTER TABLE `myLabs`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `myProjects`
--
ALTER TABLE `myProjects`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mySiteUsers`
--
ALTER TABLE `mySiteUsers`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
