-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 07:59 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_register`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins`
(
  `id` int
(11) NOT NULL,
  `full_name` varchar
(128) NOT NULL,
  `email` varchar
(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`
id`,
`full_name
`, `email`, `password`) VALUES
(1, 'Admin User', 'admin@example.com', 'admin@123'),
(2, 'Admin', 'admin@purple.com', '$2y$10$j9hZFRdjQafRXhyenWeeHuVIif5OPFOxkhZ7pytWjq0TTTYw.Rpny');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products`
(
  `id` int
(11) NOT NULL,
  `name` varchar
(100) NOT NULL,
  `price` decimal
(10,2) NOT NULL,
  `image` varchar
(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`
(
  `id` int
(11) NOT NULL,
  `full_name` varchar
(128) NOT NULL,
  `email` varchar
(255) NOT NULL,
  `password` varchar
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`
id`,
`full_name
`, `email`, `password`) VALUES
(1, 'Aktar', 'aktar@gmail.com', '$2y$10$Jmf9Xk2y8m.fo3c/ZgKmzOrdIRkU05KSGLI0picKLEtr68ll7hjB.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
ADD PRIMARY KEY
(`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
ADD PRIMARY KEY
(`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY
(`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

-- Table structure for table `sellers`
CREATE TABLE `sellers`
(
  `id` int
(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar
(128) NOT NULL,
  `email` varchar
(255) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY
(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `products`
CREATE TABLE `products`
(
  `id` int
(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int
(11) NOT NULL,
  `name` varchar
(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal
(10,2) NOT NULL,
  `stock` int
(11) NOT NULL,
  PRIMARY KEY
(`id`),
  FOREIGN KEY
(`seller_id`) REFERENCES `sellers`
(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `orders`
CREATE TABLE `orders`
(
  `id` int
(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int
(11) NOT NULL,
  `product_id` int
(11) NOT NULL,
  `quantity` int
(11) NOT NULL,
  `total_price` decimal
(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY
(`id`),
  FOREIGN KEY
(`customer_id`) REFERENCES `users`
(`id`),
  FOREIGN KEY
(`product_id`) REFERENCES `products`
(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `addresses`
CREATE TABLE `addresses`
(
  `id` int
(11) NOT NULL AUTO_INCREMENT,
  `user_id` int
(11) NOT NULL,
  `address_line1` varchar
(255) NOT NULL,
  `address_line2` varchar
(255),
  `city` varchar
(128) NOT NULL,
  `state` varchar
(128) NOT NULL,
  `zip_code` varchar
(10) NOT NULL,
  `country` varchar
(128) NOT NULL,
  PRIMARY KEY
(`id`),
  FOREIGN KEY
(`user_id`) REFERENCES `users`
(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
