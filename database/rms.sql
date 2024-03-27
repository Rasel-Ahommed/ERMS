-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 08:27 AM
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
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `work_title` varchar(255) DEFAULT NULL,
  `work_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_report_details`
--

INSERT INTO `daily_report_details` (`id`, `user_id`, `daily_log_id`, `start_time`, `end_time`, `work_title`, `work_details`) VALUES
(33, 1, 32, '10:00:00', '12:03:00', 'this is work title 1', 'this is work details 1'),
(34, 1, 32, '16:04:00', '17:04:00', 'this is work title 2', 'this is work details 2'),
(35, 1, 33, '14:04:00', '15:04:00', 'this is work title', 'this is work details'),
(36, 1, 33, '17:05:00', '18:05:00', 'this is work title', 'abcdefghijk'),
(37, 20, 34, '14:09:00', '15:10:00', 'this is work title', 'work details work details work details'),
(38, 20, 34, '15:09:00', '18:09:00', 'this is work title', 'work detailswork detailswork details'),
(39, 20, 35, '15:10:00', '17:11:00', 'this is work title', 'sdafsadf'),
(40, 20, 35, '15:11:00', '16:11:00', 'this is work title', 'dfsasf'),
(41, 20, 36, '04:42:00', '15:43:00', 'Test Title', 'Test work Details'),
(42, 20, 36, '01:44:00', '01:39:00', 'Test Title', 'work details also test'),
(43, 20, 37, '09:44:00', '08:48:00', 'Test Title', 'haha'),
(45, 1, 39, '17:19:00', '20:19:00', 'this is work title', 'asfadsfafd'),
(46, 1, 40, '22:38:00', '20:38:00', 'this is work title', 'this is test log'),
(47, 1, 41, '19:42:00', '19:42:00', 'this is work title', 'dfsjdjfkldjflk'),
(48, 1, 43, '18:44:00', '19:44:00', 'this is work title', 'aaaaaaaaaaaaa'),
(49, 1, 44, '14:07:00', '15:07:00', 'this is work title', 'qwertyuioytr'),
(55, 1, 44, '15:07:00', '16:59:00', 'this is work title', 'dsfsaf'),
(56, 1, 45, '15:00:00', '16:00:00', 'this is work title', 'this is test'),
(57, 34, 46, '15:20:00', '16:20:00', 'this is work title', 'test'),
(58, 34, 46, '17:21:00', '19:23:00', 'this is work title', 'sssdsds'),
(59, 34, 47, '15:35:00', '16:35:00', 'this is work title', 'test'),
(60, 34, 47, '17:39:00', '18:39:00', 'this is work title', 'fgsd'),
(61, 34, 47, '17:09:00', '17:15:00', 'this is work title', 'If you'),
(62, 34, 48, '16:31:00', '17:31:00', 'this is work title', 'In this'),
(63, 34, 48, '17:33:00', '18:33:00', 'this is work title', 'In this exampl'),
(64, 34, 48, '20:20:00', '21:20:00', 'wqqwe', 'In this example, $formData will contain an array of all the form input values sent from the HTML form fields. You can access individual input values using keys corresponding to the input field'),
(65, 34, 48, '22:46:00', '23:46:00', 'this is work title', 'function auto_grow() {\r\n            console.log(\'start\');\r\n            var textarea = document.querySelectorAll(\'.textareaHeight\');\r\n\r\n            textarea.forEach(element => {\r\n                element.style.height = \"5px\";');

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
(32, 1, '10:00:00', '13:04:48', '2024-03-23', 1),
(34, 20, '11:00:00', '13:10:06', '2024-03-23', 1),
(35, 20, '01:00:00', '13:11:18', '2024-03-22', 1),
(36, 20, '09:00:00', '13:45:19', '2024-03-24', 1),
(37, 20, '14:00:00', '13:49:26', '2024-03-24', 1),
(38, 20, '23:30:00', NULL, '2024-03-24', 0),
(43, 1, '10:00:00', '16:44:18', '2024-03-22', 1),
(44, 1, '10:00:00', '14:59:17', '2024-03-24', 1),
(45, 1, '12:00:00', '15:13:47', '2024-03-26', 1),
(46, 34, '11:00:00', '15:22:20', '2024-03-25', 1),
(47, 34, '10:00:00', '16:14:00', '2024-03-23', 1),
(48, 34, '10:00:00', '16:51:20', '2024-03-26', 1);

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
(6, '2024_03_20_072633_create_employee_reports_table', 2),
(7, '2024_03_20_082135_daily_report_details', 2),
(8, '2024_03_21_093001_report_table', 3);

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
  `date` date NOT NULL,
  `work_title` varchar(255) DEFAULT NULL,
  `work_details` text DEFAULT NULL,
  `day_start_time` time DEFAULT NULL,
  `day_end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report_table`
--

INSERT INTO `report_table` (`id`, `user_id`, `daily_log_id`, `start_time`, `end_time`, `date`, `work_title`, `work_details`, `day_start_time`, `day_end_time`) VALUES
(25, 1, 32, '16:04:00', '17:04:00', '2024-03-23', 'this is work title 2', 'this is work details 2', '10:00:00', '13:04:48'),
(26, 1, 33, '14:04:00', '15:04:00', '2024-03-24', 'this is work title', 'this is work details', '10:00:00', '13:05:43'),
(28, 20, 34, '14:09:00', '15:10:00', '2024-03-23', 'this is work title', 'work details work details work details', '11:00:00', '13:10:06'),
(30, 20, 35, '15:10:00', '17:11:00', '2024-03-22', 'this is work title', 'sdafsadf', '01:00:00', '13:11:18'),
(32, 20, 36, '04:42:00', '15:43:00', '2024-03-24', 'Test Title', 'Test work Details', '09:00:00', '13:45:19'),
(41, 1, 45, '15:00:00', '16:00:00', '2024-03-26', 'this is work title', 'this is test', '12:00:00', '15:13:47'),
(42, 34, 46, '15:20:00', '16:20:00', '2024-03-26', 'this is work title', 'test', '11:00:00', '15:22:20'),
(43, 34, 46, '17:21:00', '19:23:00', '2024-03-26', 'this is work title', 'sssdsds', '11:00:00', '15:22:20'),
(44, 34, 47, '15:35:00', '16:35:00', '2024-03-26', 'this is work title', 'test', '10:00:00', '16:14:00'),
(45, 34, 47, '17:39:00', '18:39:00', '2024-03-26', 'this is work title', 'fgsd', '10:00:00', '16:14:00'),
(46, 34, 47, '17:09:00', '17:15:00', '2024-03-26', 'this is work title', 'If you', '10:00:00', '16:14:00'),
(47, 34, 48, '16:31:00', '17:31:00', '2024-03-26', 'this is work title', 'In this', '10:00:00', '16:51:20'),
(48, 34, 48, '17:33:00', '18:33:00', '2024-03-26', 'this is work title', 'In this exampl', '10:00:00', '16:51:20'),
(49, 34, 48, '20:20:00', '21:20:00', '2024-03-26', 'wqqwe', 'In this example, $formData will contain an array of all the form input values sent from the HTML form fields. You can access individual input values using keys corresponding to the input field', '10:00:00', '16:51:20'),
(50, 34, 48, '22:46:00', '23:46:00', '2024-03-26', 'this is work title', 'function auto_grow() {\r\n            console.log(\'start\');\r\n            var textarea = document.querySelectorAll(\'.textareaHeight\');\r\n\r\n            textarea.forEach(element => {\r\n                element.style.height = \"5px\";', '10:00:00', '16:51:20');

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
(1, 'Rasel Ahammed', 'raselahommed2002@gmail.com', NULL, '$2y$10$kvfELqvA1rYp8956o1Wv0.i8pknVXz7dqLwoJLTCPytu0tl8593YK', '\\images\\1711433237_user.png', 1, 'Developer', 'EkdN1KgzpsRgp8ADu1o2I2xqzQCYcuSkMPvJ2bFoW4Dk1btkbqNU4CPf6J3M', '2024-03-17 23:31:49', '2024-03-26 06:07:17'),
(20, 'hridoy', 'hridoy@gmail.com', NULL, '$2y$10$8kNScqMPyvLrk2/XJGxRMeF3o4juCltUU4SJGw8z0oQUq5Jf1XQai', '\\images\\1711266952_user.jpg', 2, 'Designer', NULL, '2024-03-20 01:08:38', '2024-03-24 07:55:52'),
(33, 'Rasel', 'uyueryreu@jdhdh.com', NULL, '$2y$10$2eOoXTnV4f4Ysz5RaeQ0KuT5laYctcYrPXjgCpvSlbE5XZCHztc.S', '/images/avatar.png', 1, 'Developer', NULL, '2024-03-26 06:06:10', '2024-03-26 08:04:38'),
(34, 'test', 'test@gmail.com', NULL, '$2y$10$CGVueE8/8ufslG78Og/X2e20KwOmybiMq6LBaErExQ4/B2QM3Ip8K', '/images/avatar.png', 2, 'Business', NULL, '2024-03-26 09:19:50', '2024-03-26 09:19:50');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_report_details`
--
ALTER TABLE `daily_report_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `daily_report_logs`
--
ALTER TABLE `daily_report_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_table`
--
ALTER TABLE `report_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
