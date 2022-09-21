-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2022 at 06:32 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lomba_pubg`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` bigint(20) UNSIGNED NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_berita` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_02_03_172058_create_sessions_table', 1),
(7, '2022_03_05_094358_tournament', 1),
(8, '2022_03_05_100409_transaksi', 1),
(9, '2022_03_06_062328_berita', 1),
(10, '2022_03_06_062557_komentar', 1),
(11, '2022_04_25_225109_pemenang', 1),
(12, '2022_07_17_134442_setting', 1),
(13, '2022_08_25_203233_peserta_tournament', 1);

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
-- Table structure for table `pemenang`
--

CREATE TABLE `pemenang` (
  `id_pemenang` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_point` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `norek_pemenang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_tournament` bigint(20) UNSIGNED DEFAULT NULL,
  `id_peserta` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemenang`
--

INSERT INTO `pemenang` (`id_pemenang`, `judul`, `slug`, `isi`, `thumbnail`, `team`, `bukti_point`, `norek_pemenang`, `id_user`, `id_tournament`, `id_peserta`, `created_at`, `updated_at`) VALUES
(1, 'Pemenang yuhuu', 'pemenang-yuhuu', '<p>info menang</p>', '1661869311Screenshot from 2022-08-28 15-11-00.png', 'Kororo', '1661869311Screenshot from 2022-08-29 09-38-52.png', 'BCA 12345678', 2, NULL, NULL, '2022-08-30 21:21:51', '2022-08-30 21:21:51'),
(2, 'srdfg', 'srdfg', '<p>cgvb</p>', '1661870404Screenshot from 2022-08-28 15-11-00.png', 'Dukun 86', '1661870404Screenshot from 2022-08-29 10-12-47.png', 'BCA 12345676', 1, NULL, NULL, '2022-08-30 21:40:04', '2022-08-30 21:40:04'),
(3, 'Pemenang huraa', 'pemenang-huraa', '<p>gsbhs</p>', '1662503363Screenshot from 2022-09-06 19-27-46.png', 'Kororo', '1662503363Screenshot from 2022-09-06 11-27-53.png', NULL, 1, NULL, NULL, '2022-09-07 05:29:23', '2022-09-07 05:29:23'),
(4, 'pemenang hahah', 'pemenang-hahah', '<p>testing</p>', '1662505010Screenshot from 2022-09-06 11-27-53.png', 'S86', '1662505010Screenshot from 2022-09-06 11-27-53.png', 'BCA 1234567678', 3, NULL, NULL, '2022-09-07 05:56:50', '2022-09-07 05:56:50'),
(21, NULL, 'tes-tournament', '<p>ketikkan sesuatu disini...adsadsadasd</p>', '166349225332511358.jpg', 'Lokkk', '166349225332511358.jpg', '41241241', 2, 1, 3, '2022-09-18 16:10:53', '2022-09-18 16:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `peserta_tournament`
--

CREATE TABLE `peserta_tournament` (
  `id_anggota` bigint(20) UNSIGNED NOT NULL,
  `team` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anggota_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anggota_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anggota_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('solo','duo','squad') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'squad',
  `no_rekening` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_tournament` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peserta_tournament`
--

INSERT INTO `peserta_tournament` (`id_anggota`, `team`, `logo`, `anggota_1`, `anggota_2`, `anggota_3`, `anggota_4`, `anggota_5`, `type`, `no_rekening`, `id_tournament`, `id_transaksi`, `id_peserta`, `created_at`, `updated_at`) VALUES
(1, 'Lokkk', '1662507006Screenshot from 2022-09-06 11-27-53.png', 'Samsudin', 'Sugeng', 'Andri', 'Asnawi', NULL, 'squad', '41241241', 1, 1, 3, '2022-09-06 23:30:06', '2022-09-06 23:30:06'),
(2, 'Kretadon', '166349181120220503_205049.jpg', 'joko', 'jaka', 'jiki', 'juku', 'jeke', 'squad', '0923141248', 1, 2, 3, '2022-09-18 09:03:31', '2022-09-18 09:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('78YVXI3XsqnK0xsy3QssW36xupzgOirEYxEfKqDV', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUHdzcjdyYUFTSnVteU9haWt0M05tOEZnVW9GSDNVTFZsZlVaUGYybyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njc6Imh0dHA6Ly9sb2NhbGhvc3QvbG9tYmFfcHViZy9wdWJsaWMvdG91cm5hbWVudC9kZXRhaWwvdGVzLXRvdXJuYW1lbnQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkbWRlN3pMREZUMndjL2xmQVhrYkRkT280SlNxa3pTL2N3WXRzck4vLjVXSndIS0hWRnl2WUsiO30=', 1663648247),
('NMCWkwfoTLcCKIXe7yJ7frnbHjq1o3999lnoq3nx', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiYlJrVEZXMUEwcGg2eFNOanlnYW9JNkJVdURSYUdVR2lsWlZTZmd4NiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1663639568);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` bigint(20) UNSIGNED NOT NULL,
  `daftar_penyelenggara` int(11) NOT NULL,
  `info_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `daftar_penyelenggara`, `info_bank`, `created_at`, `updated_at`) VALUES
(1, 150000, 'BCA 30189818 a/n Prima Pangestu', '2022-08-30 13:55:56', '2022-08-30 13:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE `tournament` (
  `id_tournament` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT 1,
  `biaya_pendaftaran` int(11) NOT NULL,
  `jumlah_slot` int(11) NOT NULL,
  `sisa_slot` int(11) NOT NULL,
  `link_room` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_valid` date NOT NULL,
  `tgl_tournament` date NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('solo','duo','squad') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'squad',
  `id_penyelenggara` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`id_tournament`, `nama`, `slug`, `lokasi`, `online`, `biaya_pendaftaran`, `jumlah_slot`, `sisa_slot`, `link_room`, `tgl_valid`, `tgl_tournament`, `deskripsi`, `thumbnail`, `file`, `type`, `id_penyelenggara`, `created_at`, `updated_at`) VALUES
(1, 'tes tournament', 'tes-tournament', 'banyuwangi', 1, 100000, 20, 19, 'lasdjklajsdkjaksjdlasjkd', '2022-09-09', '2022-09-10', '<p>deskripsi tournament</p>', '1661868202Screenshot from 2022-08-28 15-11-00.png', '1661868202Screenshot from 2022-08-29 10-12-47.png', 'squad', 2, '2022-08-30 14:03:22', '2022-09-20 04:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `team` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','waiting','reject','valid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `tournament` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyelenggara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tournament` bigint(20) UNSIGNED NOT NULL,
  `id_penyelenggara` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `team`, `logo`, `bukti`, `status`, `tournament`, `peserta`, `penyelenggara`, `id_tournament`, `id_penyelenggara`, `id_peserta`, `created_at`, `updated_at`) VALUES
(1, 'Lokkk', '1662507006Screenshot from 2022-09-06 11-27-53.png', NULL, 'pending', 'tes tournament', 'Alex Sobirin', 'Soleh', 1, 2, 4, '2022-09-06 23:30:06', '2022-09-06 23:30:06'),
(2, 'Kretadon', '166349181120220503_205049.jpg', '166355585932511358.jpg', 'waiting', 'tes tournament', 'supono', 'Soleh', 1, 2, 3, '2022-09-18 09:03:31', '2022-09-20 04:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','peserta','penyelenggara') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'peserta',
  `request_penyelenggara` tinyint(1) NOT NULL DEFAULT 0,
  `bukti_tf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biaya_request` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_post` int(11) NOT NULL DEFAULT 4,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `google_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `no_hp`, `email`, `alamat`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `role`, `request_penyelenggara`, `bukti_tf`, `biaya_request`, `remember_token`, `foto`, `max_post`, `active`, `google_foto`, `google_id`, `created_at`, `updated_at`) VALUES
(1, 'Prima Pangestu', NULL, 'primapangestu66@gmail.com', NULL, '2022-08-31 23:24:09', '$2y$10$nD8mmMLUDZzEInyjibqWnu3NqosM5ryz4GcuAy7y6ZVnUGV1MbMgS', NULL, NULL, 'admin', 0, NULL, 0, NULL, NULL, 4, 1, NULL, NULL, '2022-08-30 13:55:56', '2022-08-30 13:55:56'),
(2, 'Soleh', '087987563213', 'soleh@gmail.com', 'banyuwangi', '2022-08-30 13:58:38', '$2y$10$mde7zLDFT2wc/lfAXkbDdOo4JSqkzS/cwYtsrN/.5WJwHKHVFyvYK', NULL, NULL, 'penyelenggara', 3, '1661867942Screenshot from 2022-08-29 10-12-47.png', 150000, NULL, NULL, 4, 1, '', '', '2022-08-30 13:58:38', '2022-08-30 13:59:23'),
(3, 'supono', '085334770514', 'agussupono@gmail.com', 'banyuwangi', '2022-08-30 14:00:33', '$2y$10$34MksrIOQz3plMYytjOj9evR2e.89t2ZxK0UmCQYWPd6TzlurGhLC', NULL, NULL, 'peserta', 1, NULL, 150000, NULL, NULL, 4, 1, '', '', '2022-08-30 14:00:33', '2022-09-20 03:55:20'),
(4, 'Alex Sobirin', '087654345678', 'alexsobirin@gmail.com', 'banyuwangi', '2022-08-30 13:58:38', '$2y$10$mde7zLDFT2wc/lfAXkbDdOo4JSqkzS/cwYtsrN/.5WJwHKHVFyvYK', NULL, NULL, 'penyelenggara', 3, '1661867942Screenshot from 2022-08-29 10-12-47.png', 150000, NULL, NULL, 4, 1, '', '', '2022-08-30 13:58:38', '2022-08-30 13:59:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD UNIQUE KEY `berita_judul_unique` (`judul`),
  ADD UNIQUE KEY `berita_slug_unique` (`slug`),
  ADD KEY `berita_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `komentar_id_berita_foreign` (`id_berita`),
  ADD KEY `komentar_id_user_foreign` (`id_user`);

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
-- Indexes for table `pemenang`
--
ALTER TABLE `pemenang`
  ADD PRIMARY KEY (`id_pemenang`),
  ADD UNIQUE KEY `pemenang_slug_unique` (`slug`),
  ADD UNIQUE KEY `pemenang_judul_unique` (`judul`),
  ADD KEY `pemenang_id_user_foreign` (`id_user`),
  ADD KEY `pemenang_id_tournament_foreign` (`id_tournament`),
  ADD KEY `pemenang_id_peserta_foreign` (`id_peserta`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `peserta_tournament`
--
ALTER TABLE `peserta_tournament`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `peserta_tournament_id_tournament_foreign` (`id_tournament`),
  ADD KEY `peserta_tournament_id_transaksi_foreign` (`id_transaksi`),
  ADD KEY `peserta_tournament_id_peserta_foreign` (`id_peserta`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`id_tournament`),
  ADD UNIQUE KEY `tournament_nama_unique` (`nama`),
  ADD UNIQUE KEY `tournament_slug_unique` (`slug`),
  ADD KEY `tournament_id_penyelenggara_foreign` (`id_penyelenggara`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_id_tournament_foreign` (`id_tournament`),
  ADD KEY `transaksi_id_penyelenggara_foreign` (`id_penyelenggara`),
  ADD KEY `transaksi_id_peserta_foreign` (`id_peserta`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pemenang`
--
ALTER TABLE `pemenang`
  MODIFY `id_pemenang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peserta_tournament`
--
ALTER TABLE `peserta_tournament`
  MODIFY `id_anggota` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `id_tournament` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_id_berita_foreign` FOREIGN KEY (`id_berita`) REFERENCES `berita` (`id_berita`) ON DELETE CASCADE,
  ADD CONSTRAINT `komentar_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `pemenang`
--
ALTER TABLE `pemenang`
  ADD CONSTRAINT `pemenang_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pemenang_id_tournament_foreign` FOREIGN KEY (`id_tournament`) REFERENCES `tournament` (`id_tournament`),
  ADD CONSTRAINT `pemenang_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `peserta_tournament`
--
ALTER TABLE `peserta_tournament`
  ADD CONSTRAINT `peserta_tournament_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `peserta_tournament_id_tournament_foreign` FOREIGN KEY (`id_tournament`) REFERENCES `tournament` (`id_tournament`),
  ADD CONSTRAINT `peserta_tournament_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Constraints for table `tournament`
--
ALTER TABLE `tournament`
  ADD CONSTRAINT `tournament_id_penyelenggara_foreign` FOREIGN KEY (`id_penyelenggara`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_penyelenggara_foreign` FOREIGN KEY (`id_penyelenggara`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `transaksi_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `transaksi_id_tournament_foreign` FOREIGN KEY (`id_tournament`) REFERENCES `tournament` (`id_tournament`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
