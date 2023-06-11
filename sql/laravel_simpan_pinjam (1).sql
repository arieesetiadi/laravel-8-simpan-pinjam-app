-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2023 at 12:56 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_simpan_pinjam`
--
CREATE DATABASE IF NOT EXISTS `laravel_simpan_pinjam` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `laravel_simpan_pinjam`;

-- --------------------------------------------------------

--
-- Table structure for table `direktur`
--

CREATE TABLE `direktur` (
  `id_direktur` int UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tlp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `direktur`
--

INSERT INTO `direktur` (`id_direktur`, `nama`, `no_tlp`, `jenis_kelamin`, `alamat`, `username`, `password`, `email`) VALUES
(2, 'Direktur', '089671234567', 'Pria', 'Bali, Indonesia', 'direktur', '$2y$10$X4GkPhq6QVtz5ut75hDH5ugbElQjTBuFT/SE0iQ7gJ0tr.3GKlLFu', 'direktur@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id_kas` int UNSIGNED NOT NULL,
  `id_tabungan` int NOT NULL,
  `jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `nominal` int NOT NULL,
  `total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`id_kas`, `id_tabungan`, `jenis`, `tanggal`, `nominal`, `total`) VALUES
(1, 1, 'Uang Masuk', '2023-05-27 08:36:18', 500000, 500000),
(2, 1, 'Uang Masuk', '2023-05-27 16:43:56', 1000000, 1000000),
(3, 1, 'Uang Masuk', '2023-05-28 14:36:58', 200000, 200000),
(4, 1, 'Uang Masuk', '2023-06-02 09:55:42', 5000000, 5000000),
(5, 1, 'Uang Keluar', '2023-06-02 10:07:01', 700000, 700000);

-- --------------------------------------------------------

--
-- Table structure for table `kitir_kredit`
--

CREATE TABLE `kitir_kredit` (
  `id_kitir` int UNSIGNED NOT NULL,
  `id_permohonan_pinjam` int NOT NULL,
  `tanggal_transaksi` datetime DEFAULT NULL,
  `pokok` int NOT NULL,
  `bunga` int NOT NULL,
  `denda` int DEFAULT '0',
  `jumlah` int DEFAULT '0',
  `sisa_pinjam` int DEFAULT '0',
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kitir_kredit`
--

INSERT INTO `kitir_kredit` (`id_kitir`, `id_permohonan_pinjam`, `tanggal_transaksi`, `pokok`, `bunga`, `denda`, `jumlah`, `sisa_pinjam`, `status`) VALUES
(27, 4, '2023-06-10 17:33:13', 3333500, 150000, 0, 3483500, 6666500, 1),
(28, 4, '2023-06-10 17:36:16', 3333500, 150000, 0, 3483500, 3333000, 1),
(30, 4, '2023-06-10 17:37:12', 3333000, 150000, 0, 3483000, 0, 1),
(31, 5, '2023-06-10 17:53:06', 1667000, 300000, 0, 1967000, 18333000, 1),
(32, 5, NULL, 1667000, 300000, 0, 0, 0, 0);

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
(1, '2023_05_02_124005_create_nasabah_table', 1),
(2, '2023_05_02_125132_create_pegawai_table', 1),
(3, '2023_05_02_125827_create_pengawas_table', 1),
(4, '2023_05_02_125952_create_tim_verifikasi_table', 1),
(5, '2023_05_02_130149_create_no_pinjaman_table', 1),
(6, '2023_05_02_130353_create_kitir_kredit_table', 1),
(7, '2023_05_02_130759_create_permohonan_pinjam_table', 1),
(8, '2023_05_02_130827_create_kas_table', 1),
(9, '2023_05_02_130841_create_no_tabungan_table', 1),
(10, '2023_05_02_125952_create_direktur_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `id_nasabah` int UNSIGNED NOT NULL,
  `id_pegawai` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pinjam` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id_nasabah`, `id_pegawai`, `nama`, `tanggal_lahir`, `pekerjaan`, `alamat`, `status_pinjam`) VALUES
(2, 1, 'I Putu Arie Suastra Setiadi', '1999-08-29', 'Dokter', 'Badung, Bali, Indonesia', 0);

-- --------------------------------------------------------

--
-- Table structure for table `no_pinjaman`
--

CREATE TABLE `no_pinjaman` (
  `id_pinjaman` int UNSIGNED NOT NULL,
  `id_nasabah` int NOT NULL,
  `no_pinjaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `no_pinjaman`
--

INSERT INTO `no_pinjaman` (`id_pinjaman`, `id_nasabah`, `no_pinjaman`) VALUES
(1, 2, '001/SPK/BUMDES/V/2023');

-- --------------------------------------------------------

--
-- Table structure for table `no_tabungan`
--

CREATE TABLE `no_tabungan` (
  `id_tabungan` int UNSIGNED NOT NULL,
  `id_nasabah` int NOT NULL,
  `no_tabungan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `no_tabungan`
--

INSERT INTO `no_tabungan` (`id_tabungan`, `id_nasabah`, `no_tabungan`) VALUES
(1, 2, '001/BUMDES/V/2023');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tlp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `no_tlp`, `jenis_kelamin`, `alamat`, `username`, `password`, `email`) VALUES
(1, 'Mahendra', '089671xxxxxx', 'Pria', 'Badung, Bali, Indonesia', 'pegawai', '$2y$10$2Pt2AR/MsJf0U/hjScL/COUBY/ra1vVzt6hnP8YyrQJUPchqBhXyO', 'test@gmail.com'),
(3, 'Setiadi', '089675666443', 'Pria', 'Bali, Indonesia Raya', 'pegawai3', '$2y$10$sfn8MI62aVs1gcLbpT5aeOUCNX00udr0WXWrd2rR2c.IDNPypWqbG', 'pegawai3@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pengawas`
--

CREATE TABLE `pengawas` (
  `id_pengawas` int UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tlp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengawas`
--

INSERT INTO `pengawas` (`id_pengawas`, `nama`, `no_tlp`, `jenis_kelamin`, `alamat`, `username`, `password`, `email`) VALUES
(2, 'Pengawas', '089671234566', 'Pria', 'Bali, Indonesia', 'pengawas', '$2y$10$Pf46WokYQiPEgaoxdjp0SO4Dx5KILBUIRUbzHJVfYHXZCWvUA8Kbe', 'pengawas@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_pinjam`
--

CREATE TABLE `permohonan_pinjam` (
  `id_permohonan_pinjam` int UNSIGNED NOT NULL,
  `id_pinjaman` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `tanggal` datetime NOT NULL,
  `besar_permohonan_pinjam` int NOT NULL,
  `jumlah_angsuran` int NOT NULL,
  `jangka_waktu` tinyint NOT NULL,
  `tanggal_terakhir_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permohonan_pinjam`
--

INSERT INTO `permohonan_pinjam` (`id_permohonan_pinjam`, `id_pinjaman`, `status`, `tanggal`, `besar_permohonan_pinjam`, `jumlah_angsuran`, `jangka_waktu`, `tanggal_terakhir_bayar`) VALUES
(4, 1, 1, '2023-06-10 17:11:02', 10000000, 3333500, 3, '2023-11-10'),
(5, 1, 1, '2023-06-10 17:52:35', 20000000, 1667000, 12, '2023-08-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `direktur`
--
ALTER TABLE `direktur`
  ADD PRIMARY KEY (`id_direktur`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indexes for table `kitir_kredit`
--
ALTER TABLE `kitir_kredit`
  ADD PRIMARY KEY (`id_kitir`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id_nasabah`);

--
-- Indexes for table `no_pinjaman`
--
ALTER TABLE `no_pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indexes for table `no_tabungan`
--
ALTER TABLE `no_tabungan`
  ADD PRIMARY KEY (`id_tabungan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pengawas`
--
ALTER TABLE `pengawas`
  ADD PRIMARY KEY (`id_pengawas`);

--
-- Indexes for table `permohonan_pinjam`
--
ALTER TABLE `permohonan_pinjam`
  ADD PRIMARY KEY (`id_permohonan_pinjam`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `direktur`
--
ALTER TABLE `direktur`
  MODIFY `id_direktur` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id_kas` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kitir_kredit`
--
ALTER TABLE `kitir_kredit`
  MODIFY `id_kitir` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id_nasabah` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `no_pinjaman`
--
ALTER TABLE `no_pinjaman`
  MODIFY `id_pinjaman` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `no_tabungan`
--
ALTER TABLE `no_tabungan`
  MODIFY `id_tabungan` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengawas`
--
ALTER TABLE `pengawas`
  MODIFY `id_pengawas` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permohonan_pinjam`
--
ALTER TABLE `permohonan_pinjam`
  MODIFY `id_permohonan_pinjam` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
