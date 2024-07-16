-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 01:43 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cottton_shop`
--

--
-- Dumping data for table `shopping_order_logs`
--

INSERT INTO `shopping_order_logs` (`id`, `log_ref`, `order_id`, `user_id`, `add_date`, `notes`) VALUES
(1, 1, 1, 1, '2024-05-01 00:25:09', 'ملاحظات ملاحظات'),
(2, 2, 1, 1, '2024-05-01 00:55:57', NULL),
(3, 1, 2, 1, '2024-05-01 01:09:01', 'منتظر استلام البضاعة'),
(4, 3, 2, 1, '2024-05-01 01:09:37', 'العميل اتصل وقام بالغاء الطلب'),
(5, 1, 3, 1, '2024-05-01 02:38:47', '213132'),
(6, 2, 3, 1, '2024-05-01 02:39:06', NULL),
(7, 1, 5, 1, '2024-07-16 11:41:53', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
