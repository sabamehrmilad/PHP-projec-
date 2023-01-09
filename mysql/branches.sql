-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 12, 2021 at 08:34 PM
-- Server version: 5.7.32-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taatlico_panels_personnels`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(255) NOT NULL,
  `branch_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `masul_shobe` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `modir_shobe` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `branch_address` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `branch_postal_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `branch_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `branch_description` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `status` int(1) NOT NULL,
  `start_date_one` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `start_date_two` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `update_date_one` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT '---',
  `update_date_two` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL DEFAULT '---'
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_persian_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `masul_shobe`, `modir_shobe`, `branch_address`, `branch_postal_code`, `branch_phone`, `branch_description`, `status`, `start_date_one`, `start_date_two`, `update_date_one`, `update_date_two`) VALUES
(3, 'رشدیه', 'یاشا مشایخی', 'یاشا مشایخی', 'شهرک رشدیه، خیابان بوستان، کوی نهم، پلاک 432B', '۵۱۵۵۹۳۶۸۹۸', '۰۴۱۳۶۶۹۲۲۳۶', 'شعبه رشدیه (منزل آقای مشایخی): فقط جهت برگزاری کلاس های خصوصی خانم و آقای مشایخی ', 1, '---', '---', '99-12-3', '2021-02-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
