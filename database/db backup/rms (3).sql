-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 01:22 PM
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
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_report_details`
--

CREATE TABLE `daily_report_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `daily_log_id` bigint(20) UNSIGNED NOT NULL,
  `work_type` bigint(20) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `date` date DEFAULT NULL,
  `work_title` varchar(255) DEFAULT NULL,
  `work_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_report_details`
--

INSERT INTO `daily_report_details` (`id`, `user_id`, `daily_log_id`, `work_type`, `start_time`, `end_time`, `date`, `work_title`, `work_details`) VALUES
(1, 35, 2, 16, '15:29:00', '16:29:00', NULL, 'this is work title', 'test'),
(2, 35, 3, 18, '13:39:00', '14:39:00', NULL, 'test', 'test'),
(3, 35, 4, 16, '14:59:00', '16:59:00', NULL, 'this is work title', 'test'),
(4, 35, 4, 17, '20:32:00', '21:32:00', NULL, 'this is work title', 'teststs');

-- --------------------------------------------------------

--
-- Table structure for table `daily_report_logs`
--

CREATE TABLE `daily_report_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `date` date NOT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_report_logs`
--

INSERT INTO `daily_report_logs` (`id`, `user_id`, `start_time`, `end_time`, `date`, `is_closed`) VALUES
(1, 1, '10:00:00', NULL, '2024-05-07', 0),
(2, 35, '10:00:00', '13:34:16', '2024-05-02', 1),
(3, 35, '10:00:00', '16:15:34', '2024-05-07', 1),
(4, 35, '10:00:00', '16:32:59', '2024-05-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
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
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2024_05_07_110930_create_work_types_table', 4),
(13, '2024_03_20_072633_create_employee_reports_table', 5),
(15, '2024_03_20_082135_daily_report_details', 6),
(18, '2024_03_21_093001_report_table', 7),
(21, '2024_05_08_104315_create_today_plans_table', 8),
(22, '2024_05_08_153500_create_teams_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_table`
--

CREATE TABLE `report_table` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `daily_log_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day_start_time` time NOT NULL,
  `day_end_time` time NOT NULL,
  `date` date NOT NULL,
  `work_type` varchar(255) DEFAULT NULL,
  `work_title` varchar(255) DEFAULT NULL,
  `work_details` text DEFAULT NULL,
  `day_end` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report_table`
--

INSERT INTO `report_table` (`id`, `user_id`, `daily_log_id`, `start_time`, `end_time`, `day_start_time`, `day_end_time`, `date`, `work_type`, `work_title`, `work_details`, `day_end`) VALUES
(1, 35, 3, '13:39:00', '14:39:00', '10:00:00', '15:20:34', '2024-05-07', 'its a new work type', 'test', 'test', NULL),
(2, 35, 3, '13:39:00', '14:39:00', '10:00:00', '16:15:34', '2024-05-07', 'testststte', 'test', 'test', NULL),
(3, 35, 4, '14:59:00', '16:59:00', '10:00:00', '13:00:06', '2024-05-08', 'its a new work type', 'this is work title', 'test', NULL),
(4, 35, 4, '14:59:00', '16:59:00', '10:00:00', '16:32:59', '2024-05-08', 'its a new work type', 'this is work title', 'test', NULL),
(5, 35, 4, '20:32:00', '21:32:00', '10:00:00', '16:32:59', '2024-05-08', 'add again', 'this is work title', 'teststs', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `today_plans`
--

CREATE TABLE `today_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_dtls` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `today_plans`
--

INSERT INTO `today_plans` (`id`, `plan_dtls`, `date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '<p>this is my today plan:</p>\r\n\r\n<ol>\r\n	<li>test again</li>\r\n	<li>test again</li>\r\n</ol>', '2024-05-05', 35, '2024-05-08 05:45:49', '2024-05-08 06:39:23'),
(2, 'test', '2024-05-03', 35, NULL, NULL),
(3, 'test', '2024-05-08', 1, NULL, NULL),
(4, 'hiii', '2024-05-06', 35, '2024-05-08 06:26:23', '2024-05-08 06:26:23'),
(5, '<p>this is today plan :</p>\r\n\r\n<ol>\r\n	<li>my today plan is edit</li>\r\n	<li>my today plan is create</li>\r\n	<li>my today plan is delete</li>\r\n	<li>my today plan is update</li>\r\n</ol>', '2024-05-08', 35, '2024-05-08 10:19:48', '2024-05-08 10:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 2,
  `team` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `role`, `team`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$YWN/aSNgsBcBMs6dJhXny.GgooEk6hMSQbOS3YA5y/fC2nCheNTKO', 'images\\1713611164_user.png', 1, 'Developer', 'HnTJAcZFmai2f7bIsfeByL36bJuBZEeVyVNieR5MWlhJm6BLWuRumTfEE0Ai', '2024-03-17 23:31:49', '2024-05-07 05:34:50'),
(35, 'rasel', 'rasel@gmail.com', NULL, '$2y$10$WMOGm8andM8XeNwoUYNmP.W/N2uvveN73ZfrIhWjiHgdxTzsml3zi', 'images/avatar.png', 2, 'Designer', '9wJ20DVwGiG0vQuBVKjqahao2rhQhXa3IIYnQBrTvt937mzhZvwUBfB6iSVc', '2024-03-28 15:00:49', '2024-03-29 14:46:26'),
(36, 'dfasd', 'aaa@gmail.com', NULL, '$2y$10$3cuPyvfkbUf.AP5xVXFrrO9KBemGPFDVDaOG67Cq5OTobAon.JbJ6', 'images\\1711726686_user.png', 1, 'Business', NULL, '2024-03-29 14:44:42', '2024-03-29 15:38:06'),
(37, 'Rasel Ahammed', 'uyueryreu@jdhdh.com', NULL, '$2y$10$9eYayM5v6qKu46mptKYZJ.az7r.sm/7fWJGbB2xvBeHIQRaBtRD9.', 'images\\1711726729_user.png', 1, 'Designer', NULL, '2024-03-29 15:33:30', '2024-03-29 15:38:49'),
(38, 'Rasel Ahammed', 'adfaf@gmail.com', NULL, '$2y$10$S3kBD24Nt08CKPDMuZpeY.lHVEadoVXtCLYeOVDRxipNH9e8w13ZO', 'images\\1711726496_user.png', 2, 'Business', NULL, '2024-03-29 15:34:56', '2024-03-29 15:34:56'),
(39, 'Rasel Ahammed', 'raselahommed2002@gmail.com', NULL, '$2y$10$jL0bEM4zvorpSdvUDx3Q1eOrpV/cgbHmdoVLpiFBDYgw.SFn09Xfu', 'images\\1711726846_user.png', 1, 'Business', NULL, '2024-03-29 15:40:46', '2024-03-29 15:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `work_types`
--

CREATE TABLE `work_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `work_type` varchar(255) NOT NULL,
  `team` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_types`
--

INSERT INTO `work_types` (`id`, `work_type`, `team`, `user_id`, `created_at`, `updated_at`) VALUES
(10, 'this is new work type', 'Developer', 1, '2024-05-07 06:56:31', '2024-05-07 06:56:31'),
(11, 'test again', 'Developer', 1, '2024-05-07 06:57:18', '2024-05-07 06:57:18'),
(12, 'again test test', 'Developer', 1, '2024-05-07 07:00:33', '2024-05-07 07:00:33'),
(13, 'new test', 'Developer', 1, '2024-05-07 07:11:00', '2024-05-07 07:11:00'),
(14, 'this is new work type', 'Developer', 1, '2024-05-07 07:13:27', '2024-05-07 07:13:27'),
(15, 'test', 'Developer', 1, '2024-05-07 07:20:32', '2024-05-07 07:20:32'),
(16, 'its a new work type', 'Designer', 35, '2024-05-07 07:27:55', '2024-05-07 07:27:55'),
(17, 'add again', 'Designer', 35, '2024-05-07 10:03:07', '2024-05-07 10:03:07'),
(18, 'testststte', 'Designer', 35, '2024-05-07 10:04:39', '2024-05-07 10:04:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_report_details`
--
ALTER TABLE `daily_report_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_report_logs`
--
ALTER TABLE `daily_report_logs`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `report_table`
--
ALTER TABLE `report_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `today_plans`
--
ALTER TABLE `today_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `work_types`
--
ALTER TABLE `work_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_report_details`
--
ALTER TABLE `daily_report_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `daily_report_logs`
--
ALTER TABLE `daily_report_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_table`
--
ALTER TABLE `report_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `today_plans`
--
ALTER TABLE `today_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `work_types`
--
ALTER TABLE `work_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
