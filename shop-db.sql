-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 28, 2022 at 07:33 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop-db`
--
CREATE DATABASE IF NOT EXISTS `shop-db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `shop-db`;

-- --------------------------------------------------------

--
-- Table structure for table `order-products`
--

DROP TABLE IF EXISTS `order-products`;
CREATE TABLE IF NOT EXISTS `order-products` (
  `id` int NOT NULL,
  `product` int NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user-id` int NOT NULL,
  `order-date` varchar(100) NOT NULL,
  `status` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `img-url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `img-url`) VALUES
(1, 'Cecilia', 'Cecilias are a Local Specialty of Mondstadt found in the wild on Starsnatch Cliff.', 30, '/php-webstore/assets/uploads/1661714813.jpg'),
(2, 'Windwheel Aster', 'Windwheel Asters grow in areas of Mondstadt that have a gentle breeze.', 25, '/php-webstore/assets/uploads/1661714869.jpg'),
(3, 'Calla Lily', 'Calla Lilies grow around water bodies throughout Mondstadt', 15, '/php-webstore/assets/uploads/1661714994.jpg'),
(4, 'Small Lamp Grass', 'Small Lamp Grasses will emit a small light blue glow at night ', 40, '/php-webstore/assets/uploads/1661714957.jpg'),
(5, 'Qingxin', 'Qingxin grow on the mountaintops and peaks throughout Liyue', 100, '/php-webstore/assets/uploads/1661715066.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password-hash` varchar(400) NOT NULL,
  `role` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password-hash`, `role`) VALUES
(1, 'admin', '$2y$10$0sT3H0li/XzimSYyb/LxkO2pDEsPx.iEwH.6gmV0oER3kKfj/.wKa', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
