-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2025 at 07:02 PM
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
-- Database: `gitgud`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `business_name` varchar(100) NOT NULL,
  `business_type` varchar(100) NOT NULL,
  `region_province_city` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `street_building_house` varchar(100) NOT NULL,
  `business_phone` varchar(20) NOT NULL,
  `business_email` varchar(100) NOT NULL,
  `business_permit` varchar(255) NOT NULL,
  `business_status` enum('Approved','Rejected','Pending Approval') NOT NULL DEFAULT 'Pending Approval',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `business_logo` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `user_id`, `business_name`, `business_type`, `region_province_city`, `barangay`, `street_building_house`, `business_phone`, `business_email`, `business_permit`, `business_status`, `created_at`, `updated_at`, `business_logo`, `url`) VALUES
(54, 1, 'Food Park 1', 'Food Park', 'Mindanao, Zamboanga Del Sur, Zamboanga City', 'Sample', 'Sample', '9056321314', 'aprilalvarez@gmail.com', 'uploads/business/permit_67b687b2592e83.97306540.jpg', 'Approved', '2025-02-20 01:38:58', '2025-02-20 01:42:48', 'uploads/business/logo_67b687b259a9a1.03508045.jpg', '67b687b25c070'),
(55, 3, 'Food Park 2', 'Food Park', 'Mindanao, Zamboanga Del Sur, Zamboanga City', 'Sample', 'Sample', '9554638281', 'tomatoregional@soscandia.org', 'uploads/business/permit_67b68a840e8426.72563824.jpg', 'Pending Approval', '2025-02-20 01:51:00', '2025-02-20 01:51:00', 'uploads/business/logo_67b68a840fac60.70426255.jpg', '67b68a8412bfd'),
(56, 3, 'Naila Food Park', 'Food Park', 'Mindanao, Zamboanga Del Sur, Zamboanga City', 'Sample', 'Sample', '9554638281', 'tomatoregional@soscandia.org', 'uploads/business/permit_67b9fd3cc50e00.99547616.jpg', 'Approved', '2025-02-22 16:37:16', '2025-02-22 16:37:34', 'uploads/business/logo_67b9fd3cc54451.26936633.jpg', '67b9fd3ccc928');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `variation_option_id` int(11) DEFAULT NULL,
  `request` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `variation_option_id`, `request`, `quantity`, `created_at`, `updated_at`, `price`) VALUES
(220, 1, 29, 44, '', 2, '2025-02-22 12:01:01', '2025-02-22 12:01:01', 110.00),
(221, 1, 29, 47, '', 2, '2025-02-22 12:01:01', '2025-02-22 12:01:01', 110.00),
(222, 1, 29, 44, '', 1, '2025-02-22 12:22:34', '2025-02-22 12:22:34', 110.00),
(223, 1, 29, 47, '', 1, '2025-02-22 12:22:34', '2025-02-22 12:22:34', 110.00),
(224, 1, 29, 44, 'lol', 1, '2025-02-22 12:24:27', '2025-02-22 12:24:27', 110.00),
(225, 1, 29, 47, 'lol', 1, '2025-02-22 12:24:27', '2025-02-22 12:24:27', 110.00),
(226, 1, 27, NULL, '', 1, '2025-02-22 13:27:54', '2025-02-22 13:27:54', 99.99);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stall_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `stall_id`) VALUES
(12, 'Category 1', '2025-02-22 01:26:05', '2025-02-22 01:26:05', 111),
(13, 'Alfaith Category', '2025-02-22 13:26:55', '2025-02-22 13:26:55', 110);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variation_option_id` int(11) DEFAULT NULL,
  `type` enum('Stock In','Stock Out') NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operating_hours`
--

CREATE TABLE `operating_hours` (
  `id` int(11) NOT NULL,
  `days` varchar(255) DEFAULT NULL,
  `open_time` varchar(10) DEFAULT NULL,
  `close_time` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `business_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operating_hours`
--

INSERT INTO `operating_hours` (`id`, `days`, `open_time`, `close_time`, `created_at`, `business_id`) VALUES
(37, 'Monday, Tuesday, Wednesday, Thursday, Friday, Saturday', '07:00 AM', '07:00 PM', '2025-02-20 01:38:58', 54),
(38, 'Monday, Tuesday, Wednesday, Thursday, Friday, Saturday', '07:00 AM', '07:00 PM', '2025-02-20 01:51:00', 55),
(39, 'Monday, Tuesday, Wednesday, Thursday, Friday, Saturday', '01:00 AM', '01:00 PM', '2025-02-22 16:37:16', 56);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` enum('Cash','GCash') NOT NULL,
  `order_type` enum('Dine In','Take Out') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_class` enum('Immediately','Scheduled') NOT NULL DEFAULT 'Immediately',
  `scheduled_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `payment_method`, `order_type`, `created_at`, `order_class`, `scheduled_time`) VALUES
(67, 1, 979.99, 'Cash', 'Dine In', '2025-02-22 13:28:48', 'Immediately', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_stall_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `variations` varchar(255) DEFAULT NULL,
  `request` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_stall_id`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`, `variations`, `request`) VALUES
(155, 104, 27, 1, 99.99, 99.99, '2025-02-22 13:28:48', NULL, ''),
(156, 105, 29, 3, 220.00, 660.00, '2025-02-22 13:28:48', 'Option 1, Option 1 lol', ''),
(157, 105, 29, 1, 220.00, 220.00, '2025-02-22 13:28:48', 'Option 1, Option 1 lol', 'lol');

-- --------------------------------------------------------

--
-- Table structure for table `order_stalls`
--

CREATE TABLE `order_stalls` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `stall_id` int(10) UNSIGNED NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `status` enum('Pending','Preparing','Ready','Completed','Cancelled','Scheduled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `queue_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_stalls`
--

INSERT INTO `order_stalls` (`id`, `order_id`, `stall_id`, `subtotal`, `status`, `created_at`, `queue_number`) VALUES
(104, 67, 110, 99.99, 'Pending', '2025-02-22 13:28:48', NULL),
(105, 67, 111, 880.00, 'Preparing', '2025-02-22 13:28:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `stall_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `stall_id`, `category_id`, `name`, `code`, `description`, `base_price`, `discount`, `start_date`, `end_date`, `image`, `created_at`) VALUES
(27, 110, 13, 'Food 1', '67b927c5e75d4', 'Sample', 99.99, 0.00, NULL, NULL, 'uploads/images (1).jpg', '2025-02-22 01:26:29'),
(28, 111, 12, 'Food 2', '67b9284f3aea4', 'Sample', 100.00, 0.00, NULL, NULL, 'uploads/images.jpg', '2025-02-22 01:28:47'),
(29, 111, 12, 'Food 3', '67b928ad21506', 'Sample', 100.00, 0.00, NULL, NULL, 'uploads/images (1).jpg', '2025-02-22 01:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `name`) VALUES
(18, 28, 'Variation 1'),
(19, 29, 'Variation 1'),
(20, 29, 'Variation 2');

-- --------------------------------------------------------

--
-- Table structure for table `stalls`
--

CREATE TABLE `stalls` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `park_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stalls`
--

INSERT INTO `stalls` (`id`, `user_id`, `name`, `description`, `email`, `phone`, `website`, `logo`, `created_at`, `updated_at`, `park_id`) VALUES
(110, 2, 'Food Park 1 Stall 1', 'Sample', 'hnailataji@gmail.com', '9554638281', 'Sample', 'uploads/business/stall_67b689279c8e93.44325948.jpg', '2025-02-20 01:45:11', '2025-02-20 01:45:11', 54),
(111, 3, 'Naila Stall', 'Sample', 'hnailataji@gmail.com', '9554638281', 'Sample', 'uploads/business/stall_67b9277ad8b046.85376747.jpg', '2025-02-22 01:25:14', '2025-02-22 01:25:14', 54);

-- --------------------------------------------------------

--
-- Table structure for table `stall_categories`
--

CREATE TABLE `stall_categories` (
  `id` int(11) NOT NULL,
  `stall_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stall_categories`
--

INSERT INTO `stall_categories` (`id`, `stall_id`, `name`) VALUES
(36, 110, 'Drinks'),
(37, 111, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `stall_operating_hours`
--

CREATE TABLE `stall_operating_hours` (
  `id` int(11) NOT NULL,
  `stall_id` int(10) UNSIGNED NOT NULL,
  `days` varchar(255) NOT NULL,
  `open_time` varchar(10) NOT NULL,
  `close_time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stall_operating_hours`
--

INSERT INTO `stall_operating_hours` (`id`, `stall_id`, `days`, `open_time`, `close_time`) VALUES
(43, 110, 'Monday, Tuesday, Wednesday, Thursday, Friday, Saturday', '07:00 AM', '07:00 PM'),
(44, 111, 'Monday, Tuesday, Wednesday, Thursday, Friday, Saturday', '01:00 AM', '01:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `stall_payment_methods`
--

CREATE TABLE `stall_payment_methods` (
  `id` int(11) NOT NULL,
  `stall_id` int(10) UNSIGNED NOT NULL,
  `method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stall_payment_methods`
--

INSERT INTO `stall_payment_methods` (`id`, `stall_id`, `method`) VALUES
(32, 110, 'Cash'),
(33, 110, 'GCash'),
(34, 111, 'Cash'),
(35, 111, 'GCash');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variation_option_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `variation_option_id`, `quantity`) VALUES
(28, 29, 44, -12),
(29, 29, 45, 0),
(30, 29, 46, 0),
(31, 29, 47, -12),
(32, 29, 48, 0),
(33, 29, 49, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` char(255) NOT NULL,
  `birth_date` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `role` enum('Customer','Park Owner','Stall Owner','Admin') NOT NULL DEFAULT 'Customer',
  `profile_img` varchar(255) DEFAULT 'assets/images/profile.jpg',
  `user_session` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `sex`, `phone`, `password`, `birth_date`, `status`, `role`, `profile_img`, `user_session`, `created_at`, `updated_at`) VALUES
(1, 'Alvarez', 'April', 'aprilalvarez@gmail.com', 'male', '9056321314', '$2y$10$8qKZSYay9R/pERywKXLfaOJWqYkQ5qAJspd41TAqGO7EJGVQOhtr6', '2003-12-04', 'Active', 'Park Owner', 'assets/images/profile.jpg', '$2y$10$8qKZSYay9R/pERywKXLfaOJWqYkQ5qAJspd41TAqGO7EJGVQOhtr6', '2025-01-31 10:31:43', '2025-02-20 01:38:58'),
(2, 'Luzon', 'Alfaith', 'alfaithluzon@gmail.com', 'male', '9123456789', '$2y$10$8qKZSYay9R/pERywKXLfaOJWqYkQ5qAJspd41TAqGO7EJGVQOhtr6\r\n', '2003-12-04', 'Active', 'Stall Owner', 'assets/images/profile.jpg', NULL, '2025-02-10 01:57:20', '2025-02-20 01:45:11'),
(3, 'Haliluddin', 'Naila', 'tomatoregional@soscandia.org', 'male', '9554638281', '$2y$10$8qKZSYay9R/pERywKXLfaOJWqYkQ5qAJspd41TAqGO7EJGVQOhtr6', '2003-12-04', 'Active', 'Park Owner', 'assets/images/profile.jpg', 'c7b8409f0f64251c23625859f9982068667d64c0a768bdace4034f7975a900496727629247e450d1f849214bfff0a426ebbf7af9868a5d0f90bc98d209b5173961bc3c5d3ea35ea8779dc3f97952654e55d36bb7b05d', '2025-01-26 15:50:02', '2025-02-22 16:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `variation_options`
--

CREATE TABLE `variation_options` (
  `id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `add_price` decimal(10,2) DEFAULT 0.00,
  `subtract_price` decimal(10,2) DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variation_options`
--

INSERT INTO `variation_options` (`id`, `variation_id`, `name`, `add_price`, `subtract_price`, `image`) VALUES
(44, 19, 'Option 1', 10.00, 0.00, 'uploads/images (1).jpg'),
(45, 19, 'Option 2', 0.00, 10.00, 'uploads/images (1).jpg'),
(46, 19, 'Option 3', 0.00, 0.00, 'uploads/images (1).jpg'),
(47, 20, 'Option 1 lol', 10.00, 0.00, 'uploads/images (1).jpg'),
(48, 20, 'Option 2', 0.00, 10.00, 'uploads/images (1).jpg'),
(49, 20, 'Option 3', 0.00, 0.00, 'uploads/images (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `verification_token` varchar(255) NOT NULL,
  `token_expiration` datetime NOT NULL,
  `is_verified` tinyint(4) DEFAULT 0,
  `last_sent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`user_id`, `verification_token`, `token_expiration`, `is_verified`, `last_sent`) VALUES
(1, '679494f216b71', '2025-01-26 08:38:26', 1, '1737790706'),
(2, '6796581b7f52d', '2025-01-27 16:43:23', 1, '1737906203'),
(3, '679659aa92ce1', '2025-01-27 16:50:02', 1, '1737906602');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variation_option_id` (`variation_option_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stall_id` (`stall_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variation_option_id` (`variation_option_id`);

--
-- Indexes for table `operating_hours`
--
ALTER TABLE `operating_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_stall_id` (`order_stall_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_stalls`
--
ALTER TABLE `order_stalls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `stall_id` (`stall_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `stall_id` (`stall_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stalls`
--
ALTER TABLE `stalls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `park_id` (`park_id`);

--
-- Indexes for table `stall_categories`
--
ALTER TABLE `stall_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stall_id` (`stall_id`);

--
-- Indexes for table `stall_operating_hours`
--
ALTER TABLE `stall_operating_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stall_id` (`stall_id`);

--
-- Indexes for table `stall_payment_methods`
--
ALTER TABLE `stall_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stall_id` (`stall_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variation_option_id` (`variation_option_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `user_session` (`user_session`);

--
-- Indexes for table `variation_options`
--
ALTER TABLE `variation_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_id` (`variation_id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `operating_hours`
--
ALTER TABLE `operating_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `order_stalls`
--
ALTER TABLE `order_stalls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `stall_categories`
--
ALTER TABLE `stall_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `stall_operating_hours`
--
ALTER TABLE `stall_operating_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `stall_payment_methods`
--
ALTER TABLE `stall_payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `variation_options`
--
ALTER TABLE `variation_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `business_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`variation_option_id`) REFERENCES `variation_options` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`variation_option_id`) REFERENCES `variation_options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `operating_hours`
--
ALTER TABLE `operating_hours`
  ADD CONSTRAINT `operating_hours_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_stall_id`) REFERENCES `order_stalls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_stalls`
--
ALTER TABLE `order_stalls`
  ADD CONSTRAINT `order_stalls_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_stalls_ibfk_2` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stalls`
--
ALTER TABLE `stalls`
  ADD CONSTRAINT `stalls_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stalls_ibfk_3` FOREIGN KEY (`park_id`) REFERENCES `business` (`id`);

--
-- Constraints for table `stall_categories`
--
ALTER TABLE `stall_categories`
  ADD CONSTRAINT `stall_categories_ibfk_1` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`);

--
-- Constraints for table `stall_operating_hours`
--
ALTER TABLE `stall_operating_hours`
  ADD CONSTRAINT `stall_operating_hours_ibfk_1` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`);

--
-- Constraints for table `stall_payment_methods`
--
ALTER TABLE `stall_payment_methods`
  ADD CONSTRAINT `stall_payment_methods_ibfk_1` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`id`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_ibfk_2` FOREIGN KEY (`variation_option_id`) REFERENCES `variation_options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variation_options`
--
ALTER TABLE `variation_options`
  ADD CONSTRAINT `variation_options_ibfk_1` FOREIGN KEY (`variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
