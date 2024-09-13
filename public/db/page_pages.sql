-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 13, 2024 at 04:48 AM
-- Server version: 10.5.22-MariaDB-cll-lve
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realogyc_cotttonshop`
--

--
-- Dumping data for table `page_pages`
--

INSERT INTO `page_pages` (`id`, `user_id`, `is_active`, `photo`, `photo_thum_1`, `url_type`, `youtube`, `published_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, '2024-04-11 03:07:08', '2024-04-11 03:07:08'),
(2, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, '2024-04-16 03:04:07', '2024-04-16 03:04:07'),
(3, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, '2024-04-16 03:41:20', '2024-04-16 03:41:20'),
(4, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, '2024-09-13 12:46:14', '2024-09-13 12:46:14'),
(5, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, '2024-09-13 12:46:27', '2024-09-13 12:46:27'),
(6, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, '2024-09-13 12:46:35', '2024-09-13 12:46:35');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
