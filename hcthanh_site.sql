-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 05:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hcthanh.site`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_admin`
--

CREATE TABLE `account_admin` (
  `AD_ID` int(11) NOT NULL,
  `AD_username` varchar(50) NOT NULL,
  `AD_password` varchar(100) NOT NULL,
  `AD_email` varchar(50) NOT NULL,
  `AD_image` varchar(50) NOT NULL,
  `AD_link_phone_number` varchar(25) NOT NULL,
  `AD_link_tiktok` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `account_users`
--

CREATE TABLE `account_users` (
  `user_ID` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_security_code` varchar(50) NOT NULL,
  `user_balance` int(10) NOT NULL,
  `user_date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account_users`
--

INSERT INTO `account_users` (`user_ID`, `user_name`, `user_password`, `user_email`, `user_security_code`, `user_balance`, `user_date_created`) VALUES
(1, 'HcThanh', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Thanh@gmail.com', '123456', 0, '2024-11-22 22:54:42');

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `bank_account_ID` int(10) NOT NULL,
  `bank_account_name` varchar(10) NOT NULL,
  `bank_account_number` varchar(12) NOT NULL,
  `bank_account_image` varchar(25) NOT NULL,
  `AD_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_temp`
--

CREATE TABLE `cart_temp` (
  `cart_temp_ID` int(10) NOT NULL,
  `product_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_ID` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_image` varchar(25) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_view` int(10) NOT NULL,
  `product_download` int(10) NOT NULL,
  `product_content` text NOT NULL,
  `product_link` text NOT NULL,
  `product_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_history`
--

CREATE TABLE `purchase_history` (
  `purchase_history_ID` int(10) NOT NULL,
  `product_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `purchase_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `product_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_admin`
--
ALTER TABLE `account_admin`
  ADD PRIMARY KEY (`AD_ID`);

--
-- Indexes for table `account_users`
--
ALTER TABLE `account_users`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`bank_account_ID`);

--
-- Indexes for table `cart_temp`
--
ALTER TABLE `cart_temp`
  ADD PRIMARY KEY (`cart_temp_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_ID`);

--
-- Indexes for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD PRIMARY KEY (`purchase_history_ID`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_admin`
--
ALTER TABLE `account_admin`
  MODIFY `AD_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `account_users`
--
ALTER TABLE `account_users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `bank_account_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_temp`
--
ALTER TABLE `cart_temp`
  MODIFY `cart_temp_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_history`
--
ALTER TABLE `purchase_history`
  MODIFY `purchase_history_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_ID` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
