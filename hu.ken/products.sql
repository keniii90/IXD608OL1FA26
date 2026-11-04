-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2026 at 07:12 PM
-- Server version: 10.11.19-MariaDB-cll-lve
-- PHP Version: 8.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `morningbrew`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category`, `stock`) VALUES
(1, 'House Blend', 'Smooth and balanced coffee', 14.99, 'house-blend.jpg', 'coffee', 50),
(2, 'Dark Roast', 'Bold and rich flavor', 15.99, 'dark-roast.jpg', 'coffee', 40),
(3, 'Medium Roast', 'Balanced and aromatic', 14.99, 'medium-roast.jpg', 'coffee', 45),
(4, 'Light Roast', 'Bright and fruity flavor', 13.99, 'light-roast.jpg', 'coffee', 35),
(5, 'Espresso Blend', 'Strong espresso coffee', 16.99, 'espresso-blend.jpg', 'coffee', 50),
(6, 'Colombian Coffee', 'Smooth Colombian beans', 17.99, 'colombian.jpg', 'coffee', 30),
(7, 'Ethiopian Coffee', 'Floral and citrus notes', 18.99, 'ethiopian.jpg', 'coffee', 25),
(8, 'Brazilian Coffee', 'Chocolate and nutty flavor', 16.99, 'brazilian.jpg', 'coffee', 40),
(9, 'French Roast', 'Deep roasted flavor', 15.99, 'french-roast.jpg', 'coffee', 35),
(10, 'Decaf Coffee', 'Rich flavor without caffeine', 14.99, 'decaf.jpg', 'coffee', 30),
(11, 'Cold Brew Blend', 'Perfect for cold brewing', 17.99, 'cold-brew.jpg', 'coffee', 45),
(12, 'Breakfast Blend', 'Light and smooth morning coffee', 13.99, 'breakfast-blend.jpg', 'coffee', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
