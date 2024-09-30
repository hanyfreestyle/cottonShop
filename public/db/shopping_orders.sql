-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 05:00 PM
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

INSERT INTO `shopping_orders` (`id`, `customer_id`, `address_id`, `city_id`, `uuid`, `paymob_id`, `paymob_order_id`, `payment_method`, `order_date`, `invoice_number`, `status`, `total`, `shipping`, `total_invoice`, `units`, `cancellation_date`, `delivery_date`, `cancellation_notes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 4, '45cabc7a-f3e8-4c8b-bcab-33d5d9ae810a', NULL, NULL, 1, '2024-09-30 14:53:39', NULL, 1, 630.00, 700.00, 1330.00, 1, NULL, NULL, NULL, NULL, '2024-09-30 11:53:39', '2024-09-30 11:53:39');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
