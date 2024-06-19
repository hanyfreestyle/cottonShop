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
-- Dumping data for table `users_customers`
--

INSERT INTO `users_customers` (`id`, `name`, `email`, `phone`, `whatsapp`, `city_id`, `status`, `is_active`, `photo`, `photo_thum_1`, `email_verified_at`, `password`, `password_temp`, `last_login`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'احمد عتمان', 'etmano@hotmail.com', '01223129660', '01223129660', 3, 1, 1, NULL, NULL, NULL, '$2y$10$ef5p96KOJnaZLB/OXWrfluqslVzih7317s9GDK7rMW.5rsZMNqu.2', NULL, '2024-04-13 23:53:55', NULL, NULL, '2024-04-13 21:53:55', NULL),
(2, 'هانى محمد محم ددرويش', 'hany@hanydarwish.com', '01221563252', '01221563252', 3, 1, 1, NULL, NULL, NULL, '$2y$10$vMuBcuT9iFJfLJaZUnDYleZqweuwPQ90AMaYd2qsbUfK.RfY2jA1G', NULL, '2024-04-13 23:52:28', NULL, '2024-04-07 14:58:44', '2024-04-13 21:52:28', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
