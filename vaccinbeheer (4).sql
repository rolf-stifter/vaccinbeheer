-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 13 nov 2018 om 11:13
-- Serverversie: 10.1.36-MariaDB
-- PHP-versie: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaccinbeheer`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `favorite_schools`
--

CREATE TABLE `favorite_schools` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `favorite_schools`
--

INSERT INTO `favorite_schools` (`id`, `user_id`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-11-13 09:01:30', '2018-11-13 09:01:30');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_000000_create_users_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2018_10_12_103241_create_stock_table', 1),
(12, '2018_10_15_141303_create_requests_table', 2),
(13, '2018_10_17_131419_create_vaccinations_table', 3),
(14, '2018_10_22_120954_create_vaccins_table', 4),
(15, '2018_10_22_133607_create_schools_table', 5),
(17, '2018_10_24_130033_create_status_table', 6),
(18, '2018_10_26_115110_create_orders_table', 7),
(19, '2018_11_02_093059_create_external_stock_table', 8),
(21, '2018_11_07_102236_create_favorite_schools_table', 9),
(22, '2018_11_08_103413_check_user_and_admin', 9),
(23, '2018_11_08_112606_create_user_roles_table', 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `quantityNeeded` int(11) NOT NULL,
  `quantityPot` int(11) NOT NULL,
  `string_id` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `deliveryDate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('krisheggen@gmail.com', '$2y$10$brH9wafLz9uyFYlsEXDdsu2fBr.hiuyK8d0ZXCMtZaXa1QA5wkyqC', '2018-10-30 08:26:10'),
('gamesofkenny@gmail.com', '$2y$10$ad1EWY9RzgffD.bZI9.IXe0ZfQA8KV82ajhmRsmLsMYY5YFNT46p.', '2018-10-30 09:25:53'),
('jefke@gmail.com', '$2y$10$xW3rDcT.oLbXuG8n7qM2iOILFvEPmI.5/reH5lIzCNoIVWhnVRTRG', '2018-11-13 08:57:23');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `requests`
--

CREATE TABLE `requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `vaccine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `status_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `vaccine_id`, `quantity`, `request_date`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20, '2018-11-08', '3', '2018-11-08 12:11:40', '2018-11-08 12:53:20');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `schools`
--

CREATE TABLE `schools` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `schools`
--

INSERT INTO `schools` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'KA maasland', 1, '2018-10-22 11:50:05', '2018-10-22 11:50:05'),
(2, 'De Knappe ontdekker', 1, '2018-10-31 12:28:22', '2018-10-31 12:28:22'),
(3, 'Aschool', 1, '2018-11-08 07:34:01', '2018-11-08 07:34:01'),
(4, 'Bschool', 0, '2018-11-08 07:34:07', '2018-11-08 13:08:29');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `status`
--

INSERT INTO `status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Aangevraagd', NULL, NULL),
(2, 'Besteld', NULL, NULL),
(3, 'Toegekend', NULL, NULL),
(4, 'Geannuleerd', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `stock`
--

CREATE TABLE `stock` (
  `id` int(10) UNSIGNED NOT NULL,
  `isUsed` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `vaccine_id` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL,
  `quantityAfterVac` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `stock`
--

INSERT INTO `stock` (`id`, `isUsed`, `user_id`, `vaccine_id`, `quantity`, `quantityAfterVac`, `created_at`, `updated_at`) VALUES
(31, 1, 2, 2, 10, 0, '2018-11-02 10:14:02', '2018-11-08 07:41:20'),
(32, 1, 11, 1, 10, 10, '2018-11-02 10:15:52', '2018-11-02 10:16:52'),
(34, 1, 1, 1, 50, 50, '2018-11-08 12:12:22', '2018-11-08 12:12:22'),
(35, 0, 1, 2, 20, 20, '2018-11-08 13:44:15', '2018-11-08 13:44:15');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `user_roles_id` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `active`, `user_roles_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'kenny', 'kennygiets@gmail.com', NULL, '$2y$10$YHtiywDt3Vqc6xuMwOhb3eszxBmWboIVdnL8JnXXtWX3J8QqV88A.', 1, 3, 'tmGyxhPSFllwLXsPXYPSZlqzKzN6wJAIsrnDiQSScLeaHKuQX2u5duvDVLRZ', '2018-10-12 08:42:29', '2018-10-29 13:55:59'),
(2, 'Fons', 'fons@gmail.com', NULL, '$2y$10$oV14er4dZmDbG87suR3OPe7eNplAY03QEJNNRXc2DE3xYzxdPC.O.', 1, 2, '8KHi6TtguhhGf996DBIQrZKgW9SuvumJJ56zp8mi93Hg8nNIwitFz4kKf4k2', '2018-10-19 11:22:18', '2018-10-29 14:16:16'),
(10, 'Joske', 'Joske@gmail.com', NULL, '$2y$10$G6C0XK5qTAcOmigUp8jRgu7eCOCBlYkydtAQHjmbkTd61pTzbv4ii', 1, 1, 'hKITUFSIBgdtUq8COJ086qI2Lv2yXSWWHtrZB6JDB5oKVrJ1C8cUWyOcvOwg', '2018-10-30 09:38:36', '2018-10-30 09:39:07'),
(11, 'Erik', 'erik@gmail.com', NULL, '$2y$10$tyjLg72Ks7/mf6WZQua7ouuC5n06hpIytqPhsJqWnNaLLe2Hc13Lu', 1, 1, '85deYrAiu5zHktkr7BRteHTQuhbptpQnen4g1TOvUEB4biEJiUYufckPiJww', '2018-10-30 12:03:26', '2018-10-30 12:03:56'),
(12, 'jefke', 'jefke@gmail.com', NULL, NULL, 1, 1, NULL, '2018-11-13 08:57:23', '2018-11-13 08:58:19');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Gebruiker', NULL, NULL),
(2, 'Beheerder', NULL, NULL),
(3, 'Beide', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vaccinations`
--

CREATE TABLE `vaccinations` (
  `id` int(10) UNSIGNED NOT NULL,
  `vaccination_date` date NOT NULL,
  `school_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_class` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL,
  `definitive` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `vaccinations`
--

INSERT INTO `vaccinations` (`id`, `vaccination_date`, `school_id`, `school_class`, `vaccine_id`, `user_id`, `quantity`, `definitive`, `created_at`, `updated_at`) VALUES
(5, '2018-11-08', '4', '1A', 2, 2, 10, 0, '2018-11-08 07:39:40', '2018-11-08 07:39:40');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vaccins`
--

CREATE TABLE `vaccins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_amount` int(11) NOT NULL,
  `total_stock` int(11) NOT NULL DEFAULT '0',
  `total_stock_distributed` int(11) NOT NULL DEFAULT '0',
  `total_stock_after_vac` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `vaccins`
--

INSERT INTO `vaccins` (`id`, `name`, `type`, `minimum_amount`, `total_stock`, `total_stock_distributed`, `total_stock_after_vac`, `active`, `created_at`, `updated_at`) VALUES
(1, 'product5', 'type1', 2, 85, 60, 85, 1, NULL, '2018-11-08 13:04:11'),
(2, 'product6', 'type2', 3, 70, 30, 60, 0, '2018-10-22 10:37:51', '2018-11-08 13:44:15');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `favorite_schools`
--
ALTER TABLE `favorite_schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexen voor tabel `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexen voor tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `vaccins`
--
ALTER TABLE `vaccins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `favorite_schools`
--
ALTER TABLE `favorite_schools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `vaccinations`
--
ALTER TABLE `vaccinations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `vaccins`
--
ALTER TABLE `vaccins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
