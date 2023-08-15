-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Agu 2023 pada 18.38
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

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
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `idCategory` int(20) NOT NULL,
  `idDept` int(20) NOT NULL,
  `cateName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`idCategory`, `idDept`, `cateName`, `description`, `created_at`, `updated_at`) VALUES
(8, 2, 'Nyapu Resto', 'nyampat', '2023-08-10 07:43:13', '2023-08-10 07:43:13'),
(9, 6, 'Nyapu Halaman', 'nyampat', '2023-08-10 07:47:08', '2023-08-10 07:47:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departments`
--

CREATE TABLE `departments` (
  `idDept` int(20) NOT NULL,
  `deptName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `departments`
--

INSERT INTO `departments` (`idDept`, `deptName`, `description`, `created_at`, `updated_at`) VALUES
(1, 'HR', 'Human Resource', NULL, NULL),
(2, 'FnB Service', 'magang', NULL, '2023-05-17 23:21:37'),
(3, 'Room Service', 'kang nyapu', '2023-05-17 21:32:01', '2023-05-17 21:32:01'),
(6, 'Gardener', 'gdn', '2023-05-18 21:21:05', '2023-05-18 21:21:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `locations`
--

CREATE TABLE `locations` (
  `idLocation` int(20) NOT NULL,
  `locationName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locationDetail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `locations`
--

INSERT INTO `locations` (`idLocation`, `locationName`, `locationDetail`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Loby', 'FO', 'qweqweqwe', '2023-05-18 00:34:59', '2023-05-18 00:45:14'),
(2, 'Basement', 'Heidle', 'qweqweqweq', '2023-05-18 00:35:09', '2023-05-19 01:00:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `positions`
--

CREATE TABLE `positions` (
  `idPosition` int(20) NOT NULL,
  `positionName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `positions`
--

INSERT INTO `positions` (`idPosition`, `positionName`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Owner', 'CEO', NULL, NULL),
(3, 'Administrator', 'admin', '2023-05-18 21:20:09', '2023-05-18 21:20:09'),
(4, 'Staff', 'just staff', '2023-05-18 21:20:24', '2023-05-18 21:20:24'),
(5, 'Manager', 'manage', '2023-05-18 21:20:34', '2023-05-18 21:20:34'),
(6, 'Supervisor', 'sv', '2023-05-18 21:20:46', '2023-05-18 21:20:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL,
  `idDept` int(20) NOT NULL,
  `idPosition` int(20) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `status`, `idDept`, `idPosition`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'admin', 'admin@gmail.com', 1, 1, 1, 1, NULL, '$2a$12$rrK/QlUWnzchr/qHHldd2e.eBPvHRXshZHmbld135SykLXgBs0tsK', NULL, NULL, NULL),
(4, 'user', 'user@gmail.com', 0, 0, 2, 6, NULL, '$2a$12$rrK/QlUWnzchr/qHHldd2e.eBPvHRXshZHmbld135SykLXgBs0tsK', NULL, NULL, '2023-08-10 08:15:02'),
(5, 'Arinata', 'arinata@gmail.com', 0, 1, 2, 4, NULL, '$2a$12$rrK/QlUWnzchr/qHHldd2e.eBPvHRXshZHmbld135SykLXgBs0tsK', NULL, '2023-05-18 22:26:08', '2023-08-10 08:15:11'),
(9, 'Bayu', 'bydenuxy@mailinator.com', 1, 1, 3, 4, NULL, '$2a$12$rrK/QlUWnzchr/qHHldd2e.eBPvHRXshZHmbld135SykLXgBs0tsK', NULL, '2023-05-18 22:48:43', '2023-05-18 22:48:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `work_orders`
--

CREATE TABLE `work_orders` (
  `idWorkOrder` bigint(20) UNSIGNED NOT NULL,
  `workOrderName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `fromDept` int(20) NOT NULL,
  `toDept` int(20) NOT NULL,
  `idCategory` int(20) NOT NULL,
  `idLocation` int(20) NOT NULL,
  `startWorkOrder` date NOT NULL,
  `endWorkOrder` date DEFAULT NULL,
  `estimate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Pending\r\n1 = On Progress\r\n2 = Done',
  `completeBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `work_orders`
--

INSERT INTO `work_orders` (`idWorkOrder`, `workOrderName`, `userId`, `fromDept`, `toDept`, `idCategory`, `idLocation`, `startWorkOrder`, `endWorkOrder`, `estimate`, `description`, `status`, `completeBy`, `note`, `photo`, `created_at`, `updated_at`) VALUES
(15, 'Maris Rodriguez', 3, 1, 2, 8, 1, '2023-08-10', NULL, NULL, 'Pariatur Tempora vo', 0, NULL, NULL, NULL, '2023-08-10 08:30:12', '2023-08-10 08:30:12');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategory`),
  ADD KEY `idDept` (`idDept`);

--
-- Indeks untuk tabel `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`idDept`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`idLocation`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`idPosition`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `department_id` (`idDept`),
  ADD KEY `position_id` (`idPosition`);

--
-- Indeks untuk tabel `work_orders`
--
ALTER TABLE `work_orders`
  ADD PRIMARY KEY (`idWorkOrder`),
  ADD KEY `userId` (`userId`),
  ADD KEY `formDept` (`fromDept`),
  ADD KEY `toDept` (`toDept`),
  ADD KEY `idCategory` (`idCategory`),
  ADD KEY `idLocation` (`idLocation`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategory` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `departments`
--
ALTER TABLE `departments`
  MODIFY `idDept` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `locations`
--
ALTER TABLE `locations`
  MODIFY `idLocation` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `positions`
--
ALTER TABLE `positions`
  MODIFY `idPosition` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `work_orders`
--
ALTER TABLE `work_orders`
  MODIFY `idWorkOrder` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`idDept`) REFERENCES `departments` (`idDept`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `department_id` FOREIGN KEY (`idDept`) REFERENCES `departments` (`idDept`),
  ADD CONSTRAINT `position_id` FOREIGN KEY (`idPosition`) REFERENCES `positions` (`idPosition`);

--
-- Ketidakleluasaan untuk tabel `work_orders`
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
