-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 01:42 PM
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
-- Dumping data for table `shopping_orders`
--

INSERT INTO `shopping_orders` (`id`, `customer_id`, `address_id`, `city_id`, `uuid`, `order_date`, `invoice_number`, `status`, `total`, `shipping`, `total_invoice`, `units`, `cancellation_date`, `delivery_date`, `cancellation_notes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 4, '4e8655fb-eeec-4b1d-a5ff-aab2dfeed5c2', '2024-05-05 00:17:07', '1500554', 3, 2846.00, 400.00, 3246.00, 2, NULL, '2024-05-05 01:08:03', NULL, NULL, '2024-04-30 21:17:07', '2024-04-30 21:55:57'),
(2, NULL, 2, 4, 'ab70047a-a145-4edd-88ac-508ba8bba2bb', '2024-05-01 01:08:03', NULL, 4, 10293.00, 0.00, 10293.00, 2, NULL, NULL, NULL, NULL, '2024-04-30 22:08:03', '2024-04-30 22:09:37'),
(3, 1, 3, 3, '526e2530-9fec-44c3-9d5d-06504f4d4ef2', '2024-05-01 01:18:26', NULL, 3, 10293.00, 0.00, 10293.00, 2, NULL, '2024-05-07 02:39:06', NULL, NULL, '2024-04-30 22:18:26', '2024-04-30 23:39:06'),
(4, NULL, 4, 4, '09a69435-8902-4911-bfee-10d3d30317ed', '2024-07-16 11:13:44', NULL, 1, 7106.00, 500.00, 7606.00, 1, NULL, NULL, NULL, NULL, '2024-07-16 08:13:44', '2024-07-16 08:13:44'),
(5, NULL, 5, 6, '3e1087c7-3179-4397-9225-9ee7d85a485a', '2024-07-16 11:22:12', NULL, 2, 3791.00, 0.00, 3791.00, 1, NULL, NULL, NULL, NULL, '2024-07-16 08:22:12', '2024-07-16 08:41:53');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
