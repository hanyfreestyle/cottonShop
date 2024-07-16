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
-- Dumping data for table `shopping_order_addresses`
--

INSERT INTO `shopping_order_addresses` (`id`, `name`, `city`, `address`, `phone`, `phone_option`, `notes`) VALUES
(1, 'هانى محمد محم ددرويش', 'الإسكندرية', 'هانى محمد محم ددرويش', '01221563252', '01221563253', NULL),
(2, 'هانى محمد محمد درويش', 'الإسكندرية', 'وصف العنوان يكتب هنا \r\nوصف العنوان يكتب هنا \r\nوصف العنوان يكتب هنا', '01221563252', '01221563253', NULL),
(3, 'احمد عتمان', 'القليوبية', 'وصف العنوان بالتفصيل وصف العنوان بالتفصيل', '01223129660', '01221563252', NULL),
(4, 'هانى درويش', 'الإسكندرية', 'وصف العنوان بالتفصيل', '01221563252', NULL, NULL),
(5, 'هانى محمد محم ددرويش', 'أسوان', 'وصف العنوان بالتفصيل *وصف العنوان بالتفصيل *', '01221563252', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
