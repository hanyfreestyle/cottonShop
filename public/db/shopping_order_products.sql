-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 01:44 PM
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
-- Dumping data for table `shopping_order_products`
--

INSERT INTO `shopping_order_products` (`id`, `order_id`, `product_id`, `variant_id`, `sku`, `name`, `price`, `regular_price`, `qty`) VALUES
(1, 1, 4, NULL, '4-669386114', 'مرتبة ماريوت يانسن ارتفاع 22 سم', 1091.00, NULL, 1.00),
(2, 1, 19, NULL, '19-159919967', 'مرتبة سويت دريمز يانسن ارتفاع 24 سم', 1755.00, NULL, 1.00),
(3, 2, 4, NULL, '4-669386114', 'مرتبة ماريوت يانسن ارتفاع 22 سم', 1091.00, NULL, 3.00),
(4, 2, 19, NULL, '19-159919967', 'مرتبة سويت دريمز يانسن ارتفاع 24 سم', 1755.00, NULL, 4.00),
(5, 3, 4, NULL, '4-669386114', 'مرتبة ماريوت يانسن ارتفاع 22 سم', 1091.00, NULL, 3.00),
(6, 3, 19, NULL, '19-159919967', 'مرتبة سويت دريمز يانسن ارتفاع 24 سم', 1755.00, NULL, 4.00),
(7, 4, 269, 892, '269-794342379', 'مرتبة رويالتي يانسن بارتفاع 35 سم - 190 سم -90 سم', 7106.00, 8360.00, 1.00),
(8, 5, 25, 983, '25-447243742', 'مرتبة توت يانسن ارتفاع 25 سم - 190 سم -100 سم', 3791.00, 4460.00, 1.00);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
