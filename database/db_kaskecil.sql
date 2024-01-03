-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 09:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kaskecil`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_aas`
--

CREATE TABLE `akun_aas` (
  `id` int(2) NOT NULL,
  `kode_aas` char(11) DEFAULT NULL,
  `nama_aas` varchar(50) DEFAULT NULL,
  `status` enum('d','k') DEFAULT NULL,
  `kategori` enum('pembentukan','pengisian','pengeluaran') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_aas`
--

INSERT INTO `akun_aas` (`id`, `kode_aas`, `nama_aas`, `status`, `kategori`) VALUES
(2, '5010001506', 'Perlengkapan Masjid', 'd', 'pengeluaran'),
(3, '5010001507', 'Perlengkapan Kantor', 'd', 'pengeluaran'),
(4, '5010002502', 'Jamuan Tamu', 'd', 'pengeluaran'),
(5, '5010002504', 'Iuran-iuran', 'k', 'pengeluaran'),
(6, '5010002506', 'Rapat-rapat / Raker', 'd', 'pengeluaran'),
(7, '5010002507', 'Transpor Dinas', 'd', 'pengeluaran'),
(8, '5010002508', 'Konsumsi', 'd', 'pengeluaran'),
(9, '5010002512', 'Sumbangan - sumbangan', 'd', 'pengeluaran'),
(10, '5010002513', 'Dokumentasi & Informasi', 'd', 'pengeluaran'),
(11, '5010002514', 'Bensin/Tol/Parkir/Kendaraan Dinas', 'd', 'pengeluaran'),
(12, '5010002517', 'Lain-lain Keperluan Kantor', 'd', 'pengeluaran'),
(13, '5010003505', 'Insentif / Bonus', 'd', 'pengeluaran'),
(14, '5010003514', 'Bantuan Karyawan', 'd', 'pengeluaran'),
(15, '5010005501', 'Pemeliharaan Gedung / Bangunan', 'd', 'pengeluaran'),
(16, '5010005502', 'Pemeliharaan Emplasement', 'd', 'pengeluaran'),
(19, '5010001504', 'Perlengkapan Kebersihan', 'd', 'pengeluaran'),
(88, '1111111111', 'Pembentukan Kas Kecil', 'k', 'pembentukan'),
(89, '1111111112', 'Pengisian Kas Kecil', 'k', 'pengisian');

-- --------------------------------------------------------

--
-- Table structure for table `akun_kelompok`
--

CREATE TABLE `akun_kelompok` (
  `kode_kelompok` int(2) NOT NULL,
  `nama_kelompok` varchar(50) DEFAULT NULL,
  `status_kelompok` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_kelompok`
--

INSERT INTO `akun_kelompok` (`kode_kelompok`, `nama_kelompok`, `status_kelompok`) VALUES
(1, 'Aktiva Lancar', 1),
(2, 'Aktiva Tetap', 1);

-- --------------------------------------------------------

--
-- Table structure for table `akun_matanggaran`
--

CREATE TABLE `akun_matanggaran` (
  `id` int(2) NOT NULL,
  `kode_matanggaran` varchar(11) DEFAULT NULL,
  `kode_aas` char(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_matanggaran`
--

INSERT INTO `akun_matanggaran` (`id`, `kode_matanggaran`, `kode_aas`, `saldo`) VALUES
(2, '2.1.4', '5010001504', 0),
(3, '2.1.6', '5010001506', 0),
(4, '2.1.7', '5010001507', 0),
(5, '2.2.2', '5010002502', 0),
(6, '2.2.4', '5010002504', 0),
(7, '2.2.6', '5010002506', 0),
(8, '2.2.7', '5010002507', 0),
(9, '2.2.8', '5010002508', 0),
(10, '2.2.12', '5010002512', 0),
(11, '2.2.15', '5010003514', 0),
(12, '2.2.17', '5010003505', 0),
(13, '2.2.21', '5010002517', 0),
(14, '2.2.22', '5010002513', 0),
(15, '2.2.23', '5010002514', 0),
(16, '2.5.1', '5010005501', 0),
(17, '2.5.2', '5010005502', 0),
(18, '1.1.1', '1111111111', 0),
(19, '1.1.2', '1111111112', 0);

-- --------------------------------------------------------

--
-- Table structure for table `akun_perkiraan`
--

CREATE TABLE `akun_perkiraan` (
  `kode_perkiraan` char(11) NOT NULL,
  `nama_perkiraan` varchar(50) NOT NULL,
  `kode_kelompok` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun_perkiraan`
--

INSERT INTO `akun_perkiraan` (`kode_perkiraan`, `nama_perkiraan`, `kode_kelompok`) VALUES
('1110000', ' ** K A S **', '');

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
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pimpinan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id`, `nama`, `alamat`, `created_at`, `updated_at`, `pimpinan`) VALUES
(1, 'Masjid Agung Al Azhar', 'Jl. Sisingamangaraja, Kebayoran Baru, Jakarta Selatan.', '2023-12-28 12:17:58', '2024-01-03 03:53:19', 'H. Tatang Komara');

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
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `total` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id`, `total`, `created_at`, `updated_at`) VALUES
(1, 25000000, '2023-12-31 21:57:23', '2023-12-31 21:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `perincian` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `kategori` enum('pembentukan','pengeluaran','pengisian') DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `saldo_id` mediumint(8) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kode_matanggaran` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `perincian`, `jumlah`, `kategori`, `tanggal`, `saldo_id`, `created_at`, `updated_at`, `kode_matanggaran`) VALUES
(1, 'Pembentukan Kas Kecil 2024', 25000000, 'pembentukan', '2024-01-01', 1, '2023-12-31 21:57:23', '2023-12-31 21:57:23', '1.1.1');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `level`) VALUES
(1, 'Donar', 'donarazhar@gmail.com', NULL, '$2y$12$tzom8K9o0QTdaQ72LrYLs.i14Wyq/b9Q7RslUxGN3WSfStq6ZyZu.', 'uBksFwkfPoyR7LRju6rFzAe7NOOMgvP6ZJILT7Uhbo6DUWHPbJJ6EBbXIHc3', '2023-12-28 04:57:36', '2023-12-28 04:57:36', 'admin'),
(12, 'Tya Septiana', 'bostya@email.com', NULL, '$2y$12$fnVcObfrhoMX3gtWv6uIEOdtFx86D.qXhAa3YrS5ENapPAR/A1k.e', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_aas`
--
ALTER TABLE `akun_aas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akun_kelompok`
--
ALTER TABLE `akun_kelompok`
  ADD PRIMARY KEY (`kode_kelompok`);

--
-- Indexes for table `akun_matanggaran`
--
ALTER TABLE `akun_matanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akun_perkiraan`
--
ALTER TABLE `akun_perkiraan`
  ADD PRIMARY KEY (`kode_perkiraan`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `saldo_id` (`saldo_id`);

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
-- AUTO_INCREMENT for table `akun_aas`
--
ALTER TABLE `akun_aas`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `akun_matanggaran`
--
ALTER TABLE `akun_matanggaran`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`saldo_id`) REFERENCES `saldo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
