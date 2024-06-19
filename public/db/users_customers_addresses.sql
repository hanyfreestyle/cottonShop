-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2024 at 01:56 AM
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
-- Database: `a_cart`
--

--
-- Dumping data for table `users_customers_addresses`
--

INSERT INTO `users_customers_addresses` (`id`, `uuid`, `customer_id`, `name`, `city_id`, `address`, `recipient_name`, `phone`, `phone_option`, `is_default`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '6f41b901-5e4f-4e86-9bb0-b9a812f9b302', 1, 'المكتب', 3, 'العنوان  العنوان  العنوان', 'احمد عتمان', '01223129660', NULL, 0, NULL, '2024-04-07 22:45:52', '2024-04-13 21:36:43'),
(2, '25ea2699-7e1c-45a1-9f56-cdddf945b1b8', 1, 'المنزل', 3, 'وصف العنوان بالتفصيل وصف العنوان بالتفصيل', 'احمد عتمان', '01223129660', '01221563252', 1, NULL, '2024-04-07 23:04:08', '2024-04-13 21:36:43'),
(3, 'f92102d9-ee09-4fd6-9cd3-fd0f324e98dc', 1, 'سابا باشا', 3, 'انشاء حساب على الموقع يساعدك على اتمام عمليه الشراء والاستفادة من العروض والخصومات على منتجات الموقع', 'احمد عتمان', '01223129660', NULL, 0, NULL, '2024-04-13 21:54:22', '2024-04-13 21:54:56'),
(4, '38c353a4-45cf-4b02-b50d-c8c3e1792a5f', 1, 'بحرى', 3, 'انشاء حساب على الموقع يساعدك على اتمام عمليه الشراء والاستفادة من العروض والخصومات على منتجات الموقع', 'احمد عتمان', '01223129660', NULL, 0, NULL, '2024-04-13 21:54:35', '2024-04-13 21:55:09');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
