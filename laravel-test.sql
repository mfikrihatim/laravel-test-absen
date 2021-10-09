-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 08 Okt 2021 pada 11.42
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id_absen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_id_users` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `masuk` int(11) DEFAULT NULL,
  `telat` int(11) DEFAULT NULL,
  `izin` int(11) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_izin` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waktu_absen` time DEFAULT NULL,
  `waktu_absen_keluar` time DEFAULT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 = izin, 0 = tidak',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id_absen`, `fk_id_users`, `nama_user`, `masuk`, `telat`, `izin`, `keterangan`, `tanggal_izin`, `waktu_absen`, `waktu_absen_keluar`, `deleted_at`, `created_at`, `updated_at`) VALUES
('307cf968-b187-4078-8a86-dca42591e892', '36acd0d4-886e-4e84-80d1-5de0f1455a1c', 'Wardaya Hidiyanto', 0, NULL, 1, 'Nggak Masuk Karena Sakit', '[\"2021-09-12\",\"2021-09-11\",\"2021-09-13\"]', NULL, NULL, '0', '2021-10-08 02:08:26', NULL);

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
(1, '2021_10_08_074202_create_users_table', 1),
(2, '2021_10_08_074215_create_absen_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
('1917b91c-8c56-4e0f-a6f8-067e0b3b93d8', 'Raisa Farida', 'jumadi97@gmail.com', '$2y$10$oUPvybPVtu8oeOdCgT58EOo2FW.EwpUXu3oWHi2Mg8KYZbdaiBKkW', NULL, NULL),
('36acd0d4-886e-4e84-80d1-5de0f1455a1c', 'Imam Anom Tamba', 'riyanti.puspa@purwanti.co.id', '$2y$10$RfIpgIWWh/gQDdqdOAv3aerBbCFQFf8W7FvnL3qN45EHGKwY9BR9a', NULL, NULL),
('40298f08-c493-444b-a9e6-2211a853f1bc', 'Kasiran Caraka Anggriawan M.M.', 'agnes05@marbun.asia', '$2y$10$BlxscOZfZQ.ZLsUq9PgViend0uZClO.uBPFqLOnt2tQzHcicePu0i', NULL, NULL),
('5fa557f6-46b8-4035-b6a2-64b78fccb489', 'Bakidin Sihombing', 'jarwi69@padmasari.co.id', '$2y$10$S8AVfGDiIp.4l.XbcR5TA.NxB2nLx6aSK0m82D4JGeelabPCrXE3y', NULL, NULL),
('84c601b7-8d8d-4d81-8922-77c07fee4e3b', 'Galar Wahyu Thamrin S.T.', 'lembah27@yahoo.co.id', '$2y$10$JGoBgldCMdgOgGa9HokL7ukK56AmMtpsieOqaqUQ0Q5kIJq5Ru6CC', NULL, NULL),
('b69f76f3-a95d-4223-a7c5-3cc60d9f9e16', 'Sari Gabriella Nasyiah', 'artawan.wijaya@firgantoro.in', '$2y$10$QjozBK4LIOZlZCCYlhK/e.EkNxsNKyvbVqHSvh0Gvt1Ze3qkMXjV2', NULL, NULL),
('f466e264-d9af-4729-9f32-5a0ab11102fa', 'Jaiman Asmianto Rajasa', 'safitri.saadat@yahoo.co.id', '$2y$10$3r4Y5ajSNBkLiL7vuiFdYuj/TZfcku3.jV6ZkvK9E5.eY5eL1tLEW', NULL, NULL),
('ff1f42ec-b27c-44ab-877c-ea4bfa7e81f8', 'Oni Anastasia Riyanti', 'ouyainah@yahoo.com', '$2y$10$cj9nPB2mQFvfflznxbO44uhCXOLreAP5yY8oXxBVzujZmzDNRtym2', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `users_id_users_index` (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
