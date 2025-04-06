-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2025 at 02:28 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doublesix`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `idCategory` int NOT NULL,
  `idDept` int NOT NULL,
  `cateName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`idCategory`, `idDept`, `cateName`, `description`, `created_at`, `updated_at`) VALUES
(8, 2, 'Nyapu Resto', 'nyampat', '2023-08-10 07:43:13', '2023-08-10 07:43:13'),
(9, 6, 'Nyapu Halaman', 'nyampat', '2023-08-10 07:47:08', '2023-08-10 07:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `idDept` int NOT NULL,
  `deptName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`idDept`, `deptName`, `description`, `created_at`, `updated_at`) VALUES
(1, 'HR', 'Human Resource', NULL, NULL),
(2, 'FnB Service', 'magang', NULL, '2023-05-17 23:21:37'),
(3, 'Room Service', 'kang nyapu', '2023-05-17 21:32:01', '2023-05-17 21:32:01'),
(6, 'Gardener', 'gdn', '2023-05-18 21:21:05', '2023-05-18 21:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `idLocation` int NOT NULL,
  `locationName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `locationDetail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`idLocation`, `locationName`, `locationDetail`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Loby', 'FO', 'qweqweqwe', '2023-05-18 00:34:59', '2023-05-18 00:45:14'),
(2, 'Basement', 'Heidle', 'qweqweqweq', '2023-05-18 00:35:09', '2023-05-19 01:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_05_18_015121_create_departments_table', 3),
(7, '2014_10_12_000000_create_users_table', 4),
(9, '2023_05_18_075406_create_locations_table', 5),
(11, '2023_05_18_094402_create_categories_table', 6),
(12, '2023_05_18_104857_create_positions_table', 7),
(13, '2023_05_19_084129_create_work_orders_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `idPosition` int NOT NULL,
  `positionName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`idPosition`, `positionName`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Owner', 'CEO', NULL, NULL),
(3, 'Administrator', 'admin', '2023-05-18 21:20:09', '2023-05-18 21:20:09'),
(4, 'Staff', 'just staff', '2023-05-18 21:20:24', '2023-05-18 21:20:24'),
(5, 'Manager', 'manage', '2023-05-18 21:20:34', '2023-05-18 21:20:34'),
(6, 'Supervisor', 'sv', '2023-05-18 21:20:46', '2023-05-18 21:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL,
  `idDept` int NOT NULL,
  `idPosition` int NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `status`, `idDept`, `idPosition`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'admin', 'admin@gmail.com', 1, 1, 1, 1, NULL, '$2a$12$HazbdA2eouweMnz8umqtIuEHJ9oDuiY9ETzpnS7EJmxtRi2z3vP.y', NULL, NULL, NULL),
(4, 'user', 'user@gmail.com', 0, 0, 2, 6, NULL, '$2a$12$HazbdA2eouweMnz8umqtIuEHJ9oDuiY9ETzpnS7EJmxtRi2z3vP.y', NULL, NULL, '2023-08-10 08:15:02'),
(5, 'Arinata', 'arinata@gmail.com', 0, 1, 2, 4, NULL, '$2a$12$rrK/QlUWnzchr/qHHldd2e.eBPvHRXshZHmbld135SykLXgBs0tsK', NULL, '2023-05-18 22:26:08', '2023-08-10 08:15:11'),
(9, 'Bayu', 'bydenuxy@mailinator.com', 1, 1, 3, 4, NULL, '$2a$12$rrK/QlUWnzchr/qHHldd2e.eBPvHRXshZHmbld135SykLXgBs0tsK', NULL, '2023-05-18 22:48:43', '2023-05-18 22:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `work_orders`
--

CREATE TABLE `work_orders` (
  `idWorkOrder` bigint UNSIGNED NOT NULL,
  `workOrderName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` bigint UNSIGNED NOT NULL,
  `fromDept` int NOT NULL,
  `toDept` int NOT NULL,
  `idCategory` int NOT NULL,
  `idLocation` int NOT NULL,
  `startWorkOrder` date NOT NULL,
  `endWorkOrder` date DEFAULT NULL,
  `estimate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = Pending\r\n1 = On Progress\r\n2 = Done',
  `completeBy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_orders`
--

INSERT INTO `work_orders` (`idWorkOrder`, `workOrderName`, `userId`, `fromDept`, `toDept`, `idCategory`, `idLocation`, `startWorkOrder`, `endWorkOrder`, `estimate`, `description`, `status`, `completeBy`, `note`, `photo`, `created_at`, `updated_at`) VALUES
(15, 'Maris Rodriguez', 3, 1, 2, 8, 1, '2023-08-10', NULL, NULL, 'Pariatur Tempora vo', 0, NULL, NULL, NULL, '2023-08-10 08:30:12', '2023-08-10 08:30:12'),
(16, 'Graiden Deleon', 4, 2, 6, 9, 2, '2025-04-06', NULL, NULL, 'Dolor aute architect', 0, NULL, NULL, NULL, '2025-04-05 18:27:44', '2025-04-05 18:27:44'),
(17, 'Gwendolyn Garcia', 4, 2, 2, 8, 1, '2025-04-06', NULL, NULL, 'Ut dolores nisi in d', 0, NULL, NULL, NULL, '2025-04-05 18:28:07', '2025-04-05 18:28:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategory`),
  ADD KEY `idDept` (`idDept`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`idDept`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`idLocation`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`idPosition`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `department_id` (`idDept`),
  ADD KEY `position_id` (`idPosition`);

--
-- Indexes for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD PRIMARY KEY (`idWorkOrder`),
  ADD KEY `userId` (`userId`),
  ADD KEY `formDept` (`fromDept`),
  ADD KEY `toDept` (`toDept`),
  ADD KEY `idCategory` (`idCategory`),
  ADD KEY `idLocation` (`idLocation`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategory` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `idDept` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `idLocation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `idPosition` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `work_orders`
--
ALTER TABLE `work_orders`
  MODIFY `idWorkOrder` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`idDept`) REFERENCES `departments` (`idDept`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `department_id` FOREIGN KEY (`idDept`) REFERENCES `departments` (`idDept`),
  ADD CONSTRAINT `position_id` FOREIGN KEY (`idPosition`) REFERENCES `positions` (`idPosition`);

--
-- Constraints for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD CONSTRAINT `work_orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `work_orders_ibfk_2` FOREIGN KEY (`fromDept`) REFERENCES `departments` (`idDept`),
  ADD CONSTRAINT `work_orders_ibfk_3` FOREIGN KEY (`toDept`) REFERENCES `departments` (`idDept`),
  ADD CONSTRAINT `work_orders_ibfk_4` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`idCategory`),
  ADD CONSTRAINT `work_orders_ibfk_5` FOREIGN KEY (`idLocation`) REFERENCES `locations` (`idLocation`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
