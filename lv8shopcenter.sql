-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 12:47 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lv8shopcenter`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) NOT NULL,
  `product_id` varchar(191) NOT NULL,
  `product_qty` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `popular` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(191) DEFAULT NULL,
  `meta_tittle` varchar(191) NOT NULL,
  `meta_descrip` varchar(191) NOT NULL,
  `meta_keywords` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `status`, `popular`, `image`, `meta_tittle`, `meta_descrip`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'Mobile Phone', 'Mobile Phone', 'All Kinds of Quality Hand Phones', 0, 0, '4.png', 'Mobile Phone', 'Mobile Phone, HandPhone, Android, IOS', 'Mobile Phone, HandPhone, Android, IOS', '2023-04-09 09:05:35', '2023-04-10 12:11:12'),
(2, 'Laptops', 'Laptops', 'All Kinds of Quality Hand Phones', 0, 1, '3.png', 'Laptops', 'Laptops, Asus, HP, MSI, Dell', 'Laptops, Asus, HP, MSI, Dell', '2023-04-09 09:06:52', '2023-04-09 09:06:52'),
(7, 'Computers', 'Computers', 'All Types of Quality Computers', 0, 1, '5.png', 'Computers', 'Computers, Electronics, Technology', 'Computers, Electronics, Technology', '2023-04-09 11:31:23', '2023-04-09 11:31:23'),
(11, 'Televisions', 'Televisions', 'All Kinds of Television', 0, 1, '6.png', 'Televison, LED, Samsung, Polytron', 'Televison, LED, Samsung, Polytron', 'Televison, LED, Samsung, Polytron', '2023-04-11 10:47:02', '2023-04-11 10:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_04_06_195212_create_categories_table', 2),
(5, '2023_04_06_195853_create_categories_table', 3),
(6, '2023_04_06_200056_create_categories_table', 4),
(7, '2023_04_10_135120_create_products_table', 5),
(8, '2023_04_18_200740_create_carts_table', 6),
(9, '2023_05_08_134754_create_orders_table', 7),
(10, '2023_05_08_135743_create_order_items_table', 7),
(11, '2023_05_15_134634_create_wishlists_table', 8),
(12, '2023_05_25_145208_create_ratings_table', 9),
(15, '2023_05_26_131904_create_reviews_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) NOT NULL,
  `fname` varchar(191) NOT NULL,
  `lname` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `no_telp` varchar(191) NOT NULL,
  `alamat` varchar(191) NOT NULL,
  `kota` varchar(191) NOT NULL,
  `provinsi` varchar(191) NOT NULL,
  `negara` varchar(191) NOT NULL,
  `kode_pos` varchar(191) NOT NULL,
  `total_price` varchar(191) NOT NULL,
  `payment_mode` varchar(191) NOT NULL,
  `payment_id` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `message` varchar(191) DEFAULT NULL,
  `tracking_no` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fname`, `lname`, `email`, `no_telp`, `alamat`, `kota`, `provinsi`, `negara`, `kode_pos`, `total_price`, `payment_mode`, `payment_id`, `status`, `message`, `tracking_no`, `created_at`, `updated_at`) VALUES
(1, '2', 'Nevaz', 'Vince', 'nevaz@gmail.com', '081330657346', 'Perum Sekar Indah 1 Blok R.6', 'Kota Pasuruan', 'Jawa Timur', 'Indonesia', '67127', '9000000', 'Pembayaran melalui Payment', 'pay_LtuJKgXjz7EygD', 0, NULL, 'amar4883', '2023-05-25 06:10:38', '2023-05-25 06:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(191) NOT NULL,
  `product_id` varchar(191) NOT NULL,
  `qty` varchar(191) NOT NULL,
  `price` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(1, '1', '2', '1', '9000000', '2023-05-25 06:10:38', '2023-05-25 06:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_category` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `small_description` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `original_price` varchar(191) NOT NULL,
  `selling_price` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `qty` varchar(191) NOT NULL,
  `tax` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `trending` tinyint(4) NOT NULL,
  `meta_tittle` mediumtext NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `meta_descrip` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `id_category`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`, `image`, `qty`, `tax`, `status`, `trending`, `meta_tittle`, `meta_keywords`, `meta_descrip`, `created_at`, `updated_at`) VALUES
(1, 1, 'Samsung Galaxy S23', 'Samsung Galaxy S23', 'Samsung Galaxy S23 - New Samsung S Series 2023', 'Samsung Galaxy S23 5G', '21999000', '18000000', '1.jpg', '3', '10', 0, 1, 'Samsung Galaxy S23', 'Samsung Galaxy S23, Samsung, S Series, Galaxy', 'Samsung Galaxy S23, Samsung, S Series, Galaxy', '2023-04-10 09:27:14', '2023-05-21 06:17:08'),
(2, 2, 'MSI Modern 14 B5M Ryzen 7', 'MSI Modern 14 B5M Ryzen 7', 'MSI Modern 14 B5M 068 AMD Ryzen 7 5700U', 'Selamat Datang, Silahkan Cek Etalase kami kak Laptop terbarunya.\r\nWarna : Classic Black\r\n\r\nDisplay : 14\" FHD (1920*1080), IPS-Level,Thin Bezel\r\n\r\nCamera : HD type (30fps@720p)\r\n\r\nVGA, V-RAM : AMD Radeon™ Graphics\r\n\r\nCPU : Ryzen 7 5825U\r\n\r\nKeyboard : Single backlight KB (White)\r\n\r\nMemory : DDR IV 8GB (3200MHz)\r\n\r\nStorage : 512GB NVMe PCIe Gen3x4 SSD\r\n\r\nWLAN : AMD Wi-Fi 6E RZ608 + BT5.1\r\n\r\nOS : Windows11 Home\r\n\r\nBattery : 3 cell, 39.3Whr\r\n\r\nI/O Ports :\r\n\r\n1x Type-C USB3.2 Gen2 with PD charging\r\n\r\n1x Type-A USB3.2 Gen2\r\n\r\n1x (4K @ 30Hz) HDMI\r\n\r\n1x Micro SD Card Reader\r\n\r\n2x Type-A USB2.0', '9499000', '9000000', 'msi.jpg', '3', '10', 0, 1, 'Laptops, MSI, Modern 14, Gaming', 'Laptops, MSI, Modern 14, Gaming, Editing', 'Laptops, MSI, Modern 14, Gaming, Editing', '2023-04-10 12:19:00', '2023-05-25 06:10:38'),
(4, 7, 'Computers Apple iMac 2021', 'Computers Apple iMac 2022 Z130', 'Apple iMac 2022 Z130 | M1  8-Core 1TB', 'Apple iMac 2022 Z130 | M1  8-Core 1TB', '25000000', '23500000', '2.jpg', '2', '10', 0, 1, 'Computes, IOS, Dekstop, iMac, Apple', 'Computes, IOS, Dekstop, iMac, Apple', 'Computes, IOS, Dekstop, iMac, Apple', '2023-04-10 12:39:25', '2023-05-24 12:53:56'),
(9, 1, 'Iphonne 12', 'Iphonne 12', 'Apple Iphonne 12|128 gb|New ALL', 'Apple Iphonne 12|128 gb 5G|New All|All Color', '9450000', '8990000', '7.jpg', '5', '10', 0, 0, 'iphone 12, mobile phone, apple, 5G', 'iphone 12, mobile phone, apple, 5G', 'iphone 12, mobile phone, apple, 5G', '2023-04-16 12:33:09', '2023-05-08 10:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) NOT NULL,
  `product_id` varchar(191) NOT NULL,
  `stars_rated` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `product_id`, `stars_rated`, `created_at`, `updated_at`) VALUES
(1, '2', '2', '4', '2023-05-25 08:50:00', '2023-05-26 07:44:34'),
(2, '1', '2', '3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) NOT NULL,
  `product_id` varchar(191) NOT NULL,
  `user_review` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `user_review`, `created_at`, `updated_at`) VALUES
(1, '2', '2', 'Pengiriman dari toko ke kurir sangat cepat, laptop datang dengan selamat. Semoga aman ga berpengaruh apa apa selama di perjalanan. Admin yang ramah, terimakasih', '2023-05-26 08:40:23', '2023-05-26 08:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `last_name` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `no_telp` varchar(191) DEFAULT NULL,
  `alamat` varchar(191) DEFAULT NULL,
  `kota` varchar(191) DEFAULT NULL,
  `provinsi` varchar(191) DEFAULT NULL,
  `negara` varchar(191) DEFAULT NULL,
  `kode_pos` varchar(191) DEFAULT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `no_telp`, `alamat`, `kota`, `provinsi`, `negara`, `kode_pos`, `role_as`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', 'admin@gmail.com', NULL, '$2y$10$kFGDjwMrN7vn1Raw7rEIYeOy.QB5AwF1buq0WmiqZ.9Yrumg8pM06', '', '', '', '', '', '', 1, NULL, '2023-04-06 11:19:36', '2023-04-06 11:19:36'),
(2, 'Nevaz', 'Vince', 'nevaz@gmail.com', NULL, '$2y$10$53cwQZC5sTZTuJzuELZhK.C8pjU3NzUis33bi0IrPbS76qVvzysqG', '081330657346', 'Perum Sekar Indah 1 Blok R.6', 'Kota Pasuruan', 'Jawa Timur', 'Indonesia', '67127', 0, NULL, '2023-05-01 12:00:43', '2023-05-08 08:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) NOT NULL,
  `product_id` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(2, '2', '4', '2023-05-15 08:29:26', '2023-05-15 08:29:26'),
(3, '2', '9', '2023-05-15 08:32:16', '2023-05-15 08:32:16'),
(6, '2', '1', '2023-05-15 14:19:32', '2023-05-15 14:19:32'),
(7, '2', '1', '2023-05-15 14:19:59', '2023-05-15 14:19:59'),
(8, '2', '2', '2023-05-15 14:20:16', '2023-05-15 14:20:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_category_2` (`id_category`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
