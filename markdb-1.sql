-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2020 at 07:28 PM
-- Server version: 8.0.19-0ubuntu5
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `markdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresslogs`
--

CREATE TABLE `addresslogs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `city_id` bigint UNSIGNED NOT NULL,
  `consignee_alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consignee_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consignee_contact` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consignee_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresslogs`
--

INSERT INTO `addresslogs` (`id`, `user_id`, `city_id`, `consignee_alias`, `consignee_name`, `consignee_contact`, `consignee_address`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'alias1', 'bla bla', '03462312312', 'asdadsadfsdfsdfsfdg', '2020-05-09 19:50:49', NULL),
(2, 2, 4, 'alias2', 'efsdfsadfsd', '234345432456', 'dxvfgsfgsgsfdgsgf', '2020-05-02 19:51:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `city_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`, `created_at`, `updated_at`) VALUES
(1, 'karachi', '2020-05-02 14:36:18', '2020-05-02 14:36:18'),
(2, 'islamabad', '2020-05-02 14:36:18', '2020-05-02 14:36:18'),
(3, 'lahore', '2020-05-02 14:36:18', '2020-05-02 14:36:18'),
(4, 'quetta', '2020-05-02 14:36:19', '2020-05-02 14:36:19'),
(5, 'faisalabad', '2020-05-02 14:36:19', '2020-05-02 14:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
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
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_03_10_134850_create_parcels_table', 1),
(5, '2020_03_27_184035_create_sessions_table', 1),
(6, '2020_03_28_143126_create_contacts_table', 1),
(7, '2020_04_03_194752_add_mobile_to_users', 1),
(8, '2020_04_03_200821_create_users_roles_table', 1),
(9, '2020_04_03_201519_add_fkey_roles_to_users', 1),
(10, '2020_04_04_015451_add_cnic_originality_users_table', 1),
(11, '2020_04_04_022140_make_cnic_unique_users_table', 1),
(12, '2020_04_16_180916_create_tests_table', 1),
(13, '2020_04_19_053510_create_user_personal_data_table', 1),
(14, '2020_04_19_055339_set_null_fields_user_personal_data', 1),
(15, '2020_04_19_064309_add_confirmation_fields_user_personal_data', 1),
(16, '2020_05_02_234509_create_addresslogs_table', 1),
(17, '2020_05_02_235814_create_statuses_table', 1),
(18, '2020_05_03_000310_parcel_status', 1),
(19, '2020_05_03_000744_create_cities_table', 1),
(20, '2020_05_03_002424_add_fkeys_to_addresslogs', 1),
(21, '2020_05_03_002946_add_fkeys_to_parcels', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `addresslog_id` bigint UNSIGNED NOT NULL,
  `assigned_parcel_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_tracking_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `user_id`, `addresslog_id`, `assigned_parcel_number`, `assigned_tracking_number`, `amount`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '12345', '54321', '2000.00', '2020-05-02 19:47:26', NULL),
(2, 3, 2, '12346', '64321', '3000.00', '2020-05-02 19:53:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parcel_status`
--

CREATE TABLE `parcel_status` (
  `id` bigint UNSIGNED NOT NULL,
  `parcel_id` bigint UNSIGNED NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parcel_status`
--

INSERT INTO `parcel_status` (`id`, `parcel_id`, `status_id`, `created_at`, `updated_at`) VALUES
(7, 1, 1, '2020-05-02 20:12:27', NULL),
(8, 1, 2, '2020-05-02 22:12:27', NULL),
(9, 2, 4, '2020-05-02 20:13:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0qDNpttw6t71m8A7es1abJ98Alg9sw4v6lDMkltA', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.122 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib0lidEVqUnFxMDIwTkZ3U0J2NXlkVWdSbWs4eHRpREh2SXQwaEgxNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9tYXJrcGxhbi5sb2NhbC9jdXN0b21lci9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1588516066);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'initiated', '2020-05-02 14:36:18', '2020-05-02 14:36:18'),
(2, 'on way', '2020-05-02 14:36:18', '2020-05-02 14:36:18'),
(3, 'delivered', '2020-05-02 14:36:18', '2020-05-02 14:36:18'),
(4, 'canceled', '2020-05-02 14:36:18', '2020-05-02 14:36:18'),
(5, 'returned', '2020-05-02 14:36:18', '2020-05-02 14:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `originality_verified` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnic` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `originality_verified`, `remember_token`, `created_at`, `updated_at`, `mobile`, `cnic`) VALUES
(2, 3, 'affan younus', 'dev.twelfth@hotmail.com', NULL, '$2y$10$jJJLX8E1VNU8sHONovVoCu8c/9PSuZrfdRTt.LgaS4XWq3bbYV5ju', 1, NULL, '2020-05-02 14:36:21', '2020-05-02 14:36:21', '03462236136', '42201-1254400-7'),
(3, 3, 'test user', 'dev2.twelfth@hotmail.com', NULL, '$2y$10$jJJLX8E1VNU8sHONovVoCu8c/9PSuZrfdRTt.LgaS4XWq3bbYV5ju', 1, NULL, '2020-05-02 14:36:21', '2020-05-02 14:36:21', '03462236137', '42201-1254400-8');

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-05-02 14:36:18', '2020-05-02 14:36:18'),
(2, 'delivery-boy', '2020-05-02 14:36:18', '2020-05-02 14:36:18'),
(3, 'customer', '2020-05-02 14:36:18', '2020-05-02 14:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_personal_data`
--

CREATE TABLE `user_personal_data` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `bill_file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic_file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_request_confirmation` tinyint(1) DEFAULT NULL,
  `cnic_request_confirmation` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_personal_data`
--

INSERT INTO `user_personal_data` (`id`, `user_id`, `bill_file_name`, `cnic_file_name`, `bill_request_confirmation`, `cnic_request_confirmation`, `created_at`, `updated_at`) VALUES
(1, 2, '42201-1254400-7-pexels-photo-1366919.jpeg', '42201-1254400-7-pexels-photo-1366919.jpeg', 0, 0, '2020-05-02 14:36:30', '2020-05-02 14:36:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresslogs`
--
ALTER TABLE `addresslogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `addresslogs_consignee_alias_unique` (`consignee_alias`),
  ADD KEY `addresslogs_user_id_foreign` (`user_id`),
  ADD KEY `addresslogs_city_id_foreign` (`city_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcels_user_id_foreign` (`user_id`),
  ADD KEY `parcels_addresslog_id_foreign` (`addresslog_id`);

--
-- Indexes for table `parcel_status`
--
ALTER TABLE `parcel_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcel_status_parcel_id_foreign` (`parcel_id`),
  ADD KEY `parcel_status_status_id_foreign` (`status_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_cnic_unique` (`cnic`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_personal_data`
--
ALTER TABLE `user_personal_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_personal_data_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresslogs`
--
ALTER TABLE `addresslogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parcel_status`
--
ALTER TABLE `parcel_status`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_roles`
--
ALTER TABLE `users_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_personal_data`
--
ALTER TABLE `user_personal_data`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresslogs`
--
ALTER TABLE `addresslogs`
  ADD CONSTRAINT `addresslogs_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `addresslogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parcels`
--
ALTER TABLE `parcels`
  ADD CONSTRAINT `parcels_addresslog_id_foreign` FOREIGN KEY (`addresslog_id`) REFERENCES `addresslogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parcels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parcel_status`
--
ALTER TABLE `parcel_status`
  ADD CONSTRAINT `parcel_status_parcel_id_foreign` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parcel_status_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `users_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_personal_data`
--
ALTER TABLE `user_personal_data`
  ADD CONSTRAINT `user_personal_data_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
