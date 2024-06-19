-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 07:05 AM
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
-- Database: `a_cart_new`
--

--
-- Dumping data for table `shopping_order_products`
--

INSERT INTO `shopping_order_products` (`id`, `order_id`, `product_id`, `variant_id`, `sku`, `name`, `price`, `regular_price`, `qty`) VALUES
(1, 1, 4, NULL, '4-669386114', 'مرتبة ماريوت يانسن ارتفاع 22 سم', 1091.00, NULL, 1.00),
(2, 1, 19, NULL, '19-159919967', 'مرتبة سويت دريمز يانسن ارتفاع 24 سم', 1755.00, NULL, 1.00),
(3, 2, 4, NULL, '4-669386114', 'مرتبة ماريوت يانسن ارتفاع 22 سم', 1091.00, NULL, 3.00),
(4, 2, 19, NULL, '19-159919967', 'مرتبة سويت دريمز يانسن ارتفاع 24 سم', 1755.00, NULL, 4.00),
(5, 3, 4, NULL, '4-669386114', 'مرتبة ماريوت يانسن ارتفاع 22 سم', 1091.00, NULL, 3.00),
(6, 3, 19, NULL, '19-159919967', 'مرتبة سويت دريمز يانسن ارتفاع 24 سم', 1755.00, NULL, 4.00);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
