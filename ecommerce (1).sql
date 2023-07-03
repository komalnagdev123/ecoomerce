-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2023 at 05:09 PM
-- Server version: 8.0.29
-- PHP Version: 7.4.5RC1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_01_103710_create_products_table', 2),
(6, '2023_07_01_172703_create_cart_table', 3),
(7, '2023_07_02_095429_create_orders_table', 4),
(8, '2023_07_02_103447_create_order_statuses_table', 5),
(9, '2023_07_02_143413_create_payments_table', 6),
(10, '2023_07_03_110310_create_orders_table', 7),
(11, '2023_07_03_110603_create_order_details_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `estimate_delivery_date` date NOT NULL,
  `total_qty` int NOT NULL DEFAULT '0',
  `ship_price` double NOT NULL DEFAULT '0',
  `order_status_id` bigint UNSIGNED NOT NULL,
  `total_amount` double NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `payment_id` int DEFAULT NULL,
  `cancelled_by_user_id` int DEFAULT NULL,
  `product_cancel_reason_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_cancel_feedback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_update_date` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_no`, `order_date`, `estimate_delivery_date`, `total_qty`, `ship_price`, `order_status_id`, `total_amount`, `status`, `payment_id`, `cancelled_by_user_id`, `product_cancel_reason_text`, `product_cancel_feedback`, `status_update_date`, `created_at`, `updated_at`) VALUES
(1, 3, 'SR7ESXUI', '2023-07-03', '2023-07-03', 1, 0, 2, 8010, 1, 1, NULL, NULL, NULL, NULL, '2023-07-03 10:25:39', '2023-07-03 11:35:19'),
(2, 4, 'L2F2V0ZU', '2023-07-03', '2023-07-03', 2, 0, 1, 40010, 1, 2, NULL, NULL, NULL, NULL, '2023-07-03 10:26:46', '2023-07-03 10:27:17'),
(3, 5, 'EQNPU1ZC', '2023-07-03', '2023-07-03', 1, 0, 1, 20010, 1, 3, NULL, NULL, NULL, NULL, '2023-07-03 10:27:44', '2023-07-03 10:28:13'),
(4, 1, '2J3OVLO6', '2023-07-03', '2023-07-03', 3, 0, 3, 48010, 1, 4, NULL, NULL, NULL, NULL, '2023-07-03 10:29:28', '2023-07-03 11:33:16'),
(5, 6, 'NVQFYDYM', '2023-07-03', '2023-07-03', 1, 0, 1, 8010, 1, 5, NULL, NULL, NULL, NULL, '2023-07-03 11:05:41', '2023-07-03 11:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 1, '2023-07-03 10:25:39', '2023-07-03 10:25:39'),
(2, 2, 6, 1, '2023-07-03 10:26:46', '2023-07-03 10:26:46'),
(3, 2, 5, 1, '2023-07-03 10:26:46', '2023-07-03 10:26:46'),
(4, 3, 5, 1, '2023-07-03 10:27:44', '2023-07-03 10:27:44'),
(5, 4, 7, 1, '2023-07-03 10:29:28', '2023-07-03 10:29:28'),
(6, 4, 6, 1, '2023-07-03 10:29:28', '2023-07-03 10:29:28'),
(7, 4, 5, 1, '2023-07-03 10:29:28', '2023-07-03 10:29:28'),
(8, 5, 7, 1, '2023-07-03 11:05:41', '2023-07-03 11:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Pending', '2023-04-25 10:37:07', '2023-04-25 12:49:12'),
(2, 'Cancelled', '2023-04-25 10:37:07', '2023-04-25 10:37:07'),
(3, 'In Progress', '2023-04-25 10:37:07', '2023-04-25 10:37:07'),
(4, 'Shipped', '2023-04-25 10:37:07', '2023-04-25 10:37:07'),
(5, 'Delivered', '2023-04-25 10:37:07', '2023-04-25 10:37:07'),
(6, 'Refund Process', '2023-04-25 10:37:07', '2023-04-25 10:37:07'),
(7, 'Refunded', '2023-04-25 10:37:07', '2023-04-25 07:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int UNSIGNED NOT NULL,
  `i_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `i_payment_id`, `user_id`, `amount`, `payment_status`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, 'MOJO3703Y05A64023215', '3', '8010.00', 'Credit', '2023-07-03', '2023-07-03 10:26:10', '2023-07-03 10:26:10'),
(2, 'MOJO3703205A64023216', '4', '40010.00', 'Credit', '2023-07-03', '2023-07-03 10:27:17', '2023-07-03 10:27:17'),
(3, 'MOJO3703Y05A64023217', '5', '20010.00', 'Credit', '2023-07-03', '2023-07-03 10:28:13', '2023-07-03 10:28:13'),
(4, 'MOJO3703V05A64023221', '1', '48010.00', 'Credit', '2023-07-03', '2023-07-03 10:29:56', '2023-07-03 10:29:56'),
(5, 'MOJO3703Q05A64023232', '6', '8010.00', 'Credit', '2023-07-03', '2023-07-03 11:06:11', '2023-07-03 11:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(12,4) NOT NULL DEFAULT '0.0000',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=active, 0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image`, `name`, `price`, `description`, `status`, `created_at`, `updated_at`) VALUES
(5, 'a05a93e2a7dd21d08ae3f0f36fab9994.jpeg', 'LG TV', 20000.0000, 'LG TV LG TV LG TV LG TV LG TV LG TV LG TV LG TV LG TV LG TV LG TV LG TV LG TV LG TV LG TV LG TV', 1, '2023-07-03 00:18:36', '2023-07-03 00:18:36'),
(6, '4bf0dcb6cd6c636c6de67c0622807d30.jpeg', 'LG Washine Machine', 20000.0000, 'LG Washine Machine', 1, '2023-07-03 00:36:58', '2023-07-03 00:36:58'),
(7, '91276cc8a70acf49615be641e86626ca.jpeg', 'LG Mobile', 8000.0000, 'LG Mobile', 1, '2023-07-03 00:37:56', '2023-07-03 00:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `contact_no`, `address`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Komal Nagdev', 'komal@gmail.com', NULL, '$2y$10$SfHMvtNRshCqpYUw.5KrN..6.dZ4O/4/UJTUWUqKd0bmTkSBGt/kC', '7972687612', 'Test', 0, NULL, '2023-06-30 10:47:31', '2023-06-30 10:47:31'),
(2, 'Admin User', 'admin@gmail.com', NULL, '$2y$10$v8HdJPWYTTTWfwAXnDIOjupMP7tPc8x066VnuYySCdnotcs8pUZUK', '7972687645', 'Test123', 1, NULL, '2023-06-30 10:48:38', '2023-06-30 10:48:38'),
(3, 'Akansha Malik', 'akansha@gmail.com', NULL, '$2y$10$ZBA6ss4aE6h2/DpBDfhhPud2nwzS6S9TbfZb743JHygAbSOAZYkK2', '7972687685', 'Test123567', 0, NULL, '2023-07-01 12:42:21', '2023-07-01 12:42:21'),
(4, 'Rohan Nagdev', 'rohan@gmail.com', NULL, '$2y$10$t//8kezL9E/SAsPUYwgNXuWQ7.AMGX72e8zwAS4wKXelYGO9UGDJq', '7972687684', 'Lashkari Bhag, Nagpur', 0, NULL, '2023-07-03 06:01:27', '2023-07-03 06:01:27'),
(5, 'Taruna Tilwani', 'taruna@gmail.com', NULL, '$2y$10$FahuE38FykFQp.gmqM0zluIW0XtM/VrLX7l0zcklFGr8poWwwFXr6', '7972687682', 'Lashkari Bhag, Nagpur', 0, NULL, '2023-07-03 08:20:36', '2023-07-03 08:20:36'),
(6, 'Bhawna Ramrakhyani', 'bhawna@gmail.com', NULL, '$2y$10$EZQA3y5fQfZih3uxIOWjJulkXCN50TCrjiBkMW54BFKTENHLaJ8Xa', '6754567654', 'Lashkari Bhag, Nagpur123', 0, NULL, '2023-07-03 11:05:22', '2023-07-03 11:05:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_order_status_id_foreign` (`order_status_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_order_status_id_foreign` FOREIGN KEY (`order_status_id`) REFERENCES `order_statuses` (`id`),
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
