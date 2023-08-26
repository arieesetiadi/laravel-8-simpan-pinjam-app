-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 26, 2023 at 01:25 AM
-- Server version: 8.0.30
-- PHP Version: 7.2.34

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tlp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `no_tlp`, `jenis_kelamin`, `alamat`, `username`, `password`, `email`) VALUES
(1, 'Admin', '081234567890', 'Pria', 'Bali, Indonesia', 'admin', '$2y$10$SXYRIp4XZC1RQ/HgFGJzcOtYlJJP/7sYSYYw2XqNKgaB1RnZUrmd2', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `direktur`
--

CREATE TABLE `direktur` (
  `id_direktur` int UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tlp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `direktur`
--

INSERT INTO `direktur` (`id_direktur`, `nama`, `no_tlp`, `jenis_kelamin`, `alamat`, `username`, `password`, `email`) VALUES
(2, 'I Wayan Tirtayasa', '089671234567', 'Pria', 'Jl. Sidakarya Gg.Taman Suci No.12 Denpasar', 'direktur', '$2y$10$X4GkPhq6QVtz5ut75hDH5ugbElQjTBuFT/SE0iQ7gJ0tr.3GKlLFu', 'wayantirtayasa@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id_kas` int UNSIGNED NOT NULL,
  `id_tabungan` int NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, 1, 'Uang Keluar', '2023-06-02 10:07:01', 700000, 700000),
(6, 4, 'Uang Masuk', '2023-06-15 20:47:08', 250000, 250000),
(7, 4, 'Uang Keluar', '2023-06-15 20:49:27', 100000, 100000),
(8, 5, 'Uang Masuk', '2023-06-15 22:58:06', 2500000, 2500000),
(9, 1, 'Uang Masuk', '2023-06-15 23:00:04', 650000, 650000),
(10, 4, 'Uang Keluar', '2023-06-15 23:00:25', 150000, 150000),
(11, 4, 'Uang Masuk', '2023-07-31 11:34:53', 500000, 500000),
(12, 6, 'Uang Masuk', '2023-07-31 12:12:57', 700000, 700000),
(13, 6, 'Uang Keluar', '2023-07-31 12:15:09', 300000, 300000),
(14, 1, 'Uang Keluar', '2023-08-24 19:47:50', 4000000, 4000000),
(15, 7, 'Uang Masuk', '2023-08-24 22:14:18', 250000, 250000),
(16, 7, 'Uang Masuk', '2023-08-24 22:15:58', 2150000, 2150000),
(17, 5, 'Uang Masuk', '2023-08-24 22:51:01', 100000, 100000),
(18, 6, 'Uang Keluar', '2023-08-24 22:52:00', 100000, 100000),
(19, 9, 'Uang Masuk', '2023-08-25 09:57:02', 200000, 200000),
(20, 9, 'Uang Keluar', '2023-08-25 09:57:45', 50000, 50000);

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
(32, 5, '2023-06-15 23:01:40', 1667000, 300000, 0, 1967000, 16666000, 1),
(33, 6, '2023-06-15 20:59:31', 833500, 150000, 0, 983500, 9166500, 1),
(34, 6, '2023-07-31 11:37:18', 833500, 150000, 0, 983500, 8333000, 1),
(35, 7, '2023-07-10 13:56:27', 208500, 75000, 0, 283500, 4791500, 1),
(36, 5, NULL, 1667000, 300000, 0, 0, 0, 0),
(37, 7, '2023-07-31 11:38:48', 208500, 72000, 0, 280500, 4583000, 1),
(38, 8, '2023-07-31 12:14:13', 417000, 75000, 0, 492000, 4583000, 1),
(39, 6, NULL, 833500, 125000, 0, 0, 0, 0),
(40, 7, NULL, 208500, 69000, 0, 0, 0, 0),
(41, 9, NULL, 208500, 75000, 0, 0, 0, 0),
(42, 8, '2023-08-24 21:57:28', 417000, 69000, 0, 486000, 4166000, 1),
(43, 10, NULL, 833500, 600000, 0, 0, 0, 0),
(44, 11, NULL, 625000, 450000, 0, 0, 0, 0),
(45, 12, NULL, 417000, 150000, 0, 0, 0, 0),
(46, 13, NULL, 417000, 75000, 0, 0, 0, 0),
(47, 14, NULL, 417000, 150000, 0, 0, 0, 0),
(48, 15, NULL, 694500, 375000, 0, 0, 0, 0),
(49, 16, NULL, 417000, 75000, 0, 0, 0, 0),
(50, 17, NULL, 972500, 525000, 0, 0, 0, 0),
(51, 18, NULL, 833500, 450000, 0, 0, 0, 0),
(52, 19, NULL, 625000, 225000, 0, 0, 0, 0),
(53, 20, NULL, 417000, 150000, 0, 0, 0, 0),
(54, 21, NULL, 833500, 450000, 0, 0, 0, 0),
(55, 22, NULL, 625000, 225000, 0, 0, 0, 0),
(56, 23, NULL, 417000, 75000, 0, 0, 0, 0),
(57, 24, NULL, 833500, 150000, 0, 0, 0, 0),
(58, 25, NULL, 833500, 300000, 0, 0, 0, 0),
(59, 26, NULL, 625000, 225000, 0, 0, 0, 0),
(60, 27, NULL, 417000, 75000, 0, 0, 0, 0),
(61, 28, NULL, 417000, 75000, 0, 0, 0, 0),
(62, 29, NULL, 833500, 600000, 0, 0, 0, 0),
(63, 8, NULL, 417000, 62500, 0, 0, 0, 0),
(64, 30, NULL, 417000, 75000, 0, 0, 0, 0),
(65, 31, NULL, 833500, 150000, 0, 0, 0, 0),
(66, 32, NULL, 417000, 75000, 0, 0, 0, 0),
(67, 33, NULL, 417000, 150000, 0, 0, 0, 0),
(68, 34, '2023-08-24 23:00:40', 556000, 300000, 0, 856000, 19444000, 1),
(69, 35, NULL, 417000, 75000, 0, 0, 0, 0),
(70, 34, NULL, 556000, 292000, 0, 0, 0, 0),
(71, 36, '2023-08-25 10:02:29', 417000, 75000, 0, 492000, 4583000, 1),
(72, 36, NULL, 417000, 69000, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(10, '2023_05_02_125952_create_direktur_table', 2),
(11, '2023_05_02_125133_create_admin_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `id_nasabah` int UNSIGNED NOT NULL,
  `id_pegawai` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pinjam` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id_nasabah`, `id_pegawai`, `nama`, `tanggal_lahir`, `pekerjaan`, `alamat`, `no_ktp`, `status_pinjam`) VALUES
(2, 1, 'I Putu Arie Suastra Setiadi', '1999-08-29', 'Pegawai Desa', 'Denpasar, Bali, Indonesia', '123123123123', 0),
(4, 1, 'I Made Karuna', '1980-06-25', 'Pegawai Desa', 'Jl. Mertasari Denpasar', '', 0),
(5, 1, 'I Made Juliarta', '1985-04-15', 'Kepala Dusun Sari', 'Jl. Bedugul Gg. Nuri', '', 0),
(6, 1, 'I Putu Antara', '1977-02-12', 'Kepala Dusun Kerta Dalem', 'Jl. Kerta Dalem Sidakarya', '', 0),
(7, 1, 'I Kadek Artha', '1982-09-07', 'Sopir Kepala Desa', 'Jl. Mertasari Sidakarya', '', 0),
(8, 1, 'Ketut Saputra', '1993-03-25', 'Cleaning Service', 'Jl. Sidakarya', '', 0),
(9, 1, 'I Wayan Karjana', '1975-05-04', 'Sekretaris Desa', 'Jl. Sidakarya, Denpasar', '', 0),
(10, 1, 'Luh Putu Sri Wahyuni', '1982-06-21', 'Kaur Keungan Desa', 'Jl. Mayang Sari', '', 0),
(11, 1, 'I Nyoman Werka', '1975-01-22', 'Kepala Dusun Graha Kerti', 'Jl.Graha Kerti Sidakarya', '', 0),
(12, 1, 'I Wayan Agus Eka Putra', '1990-08-17', 'Kepala Dusun Wirasatya', 'Jl. Tukad Balian', '', 0),
(13, 1, 'I Wayan Suadnyana', '1973-03-15', 'Kepala Dusun Kerta Sari', 'Jl. Dewata I Sidakarya', '', 0),
(14, 1, 'I Wayan Dharma', '1980-02-21', 'Ketua Linmas Desa Sidakarya', 'Jl. Mertasari Sidakarya', '', 0),
(15, 1, 'I Ketut Wijana', '1972-10-09', 'Pegawai Desa', 'Jl. Sidakarya Gg. Garuda', '', 0),
(16, 1, 'I Made Suarjaya', '1978-12-14', 'BPD Dusun Sari', 'Jl. Sidakarya', '', 0),
(17, 1, 'I Wayan Madrayasa', '1967-05-12', 'Kepala Desa', 'Jl. Sidakarya', '', 0),
(18, 1, 'Ni Kadek Karyati', '1993-08-15', 'Pegawai Desa', 'Jl. Sidakarya Gg. Jalak', '', 0),
(19, 1, 'I Wayan Astama', '1975-11-10', 'Kepala Dusun Graha Santi', 'Jl. Pendidikan Gg. Baja', '', 0),
(20, 1, 'I Wayan Sukadana', '1978-12-07', 'Kasi Kesejahteraan', 'Jl. Sidakarya Gg. Jalak', '', 0),
(21, 1, 'Luh Putu Arie Utami', '1980-11-16', 'Kaur Perencanaan', 'Jl. Kebudayaan Sidakarya', '', 0),
(22, 1, 'Imam Safi\'i', '1986-09-27', 'Pegawai TPS3R', 'Jl. Mertasari Sidakarya', '', 0),
(23, 1, 'Gede Suweca Diputra', '1987-04-16', 'Kepala Dusun Dukuh Mertajati', 'Jl. Bedugul Sidakarya', '', 0),
(24, 1, 'Ni Made Sukarniati', '1969-07-18', 'Ketua TP PKK Desa Sidakarya', 'Jl. Sidakarya Denpasar', '', 0),
(25, 1, 'Wayan Agus Ari Wisnawa', '1996-09-16', 'Staff BPD', 'Jl. Sidakarya Denpasar', '', 0),
(26, 1, 'I Made Suartana', '1999-06-24', 'Sekretaris Bumdes', 'Jl. Mertasari Sidakarya', '', 0),
(27, 1, 'Ni Putu Saras Widyastuti', '2002-09-12', 'Bendahara Bumdes', 'Jl. Sidakarya denpasar', '', 0),
(28, 1, 'I Nyoman Sarta', '1974-12-31', 'Kepala Dusun Suwung Kangin', 'Jl. Mertasari Sidakarya', '', 0),
(29, 1, 'Ni Kadek Puspa Andyarini', '1996-10-04', 'Staff Desa', 'Jl. Sidakarya', '', 0),
(30, 1, 'Syukur', '1992-01-19', 'Pegawai TPS3R', 'Jl. Mertasari Sidakarya', '', 0),
(31, 1, 'Ni Made Pany Rahayu', '1994-06-17', 'Staff Desa', 'Jl. Imam Bonjol', '', 0),
(32, 1, 'I Made Tamba Adnyana', '1990-11-14', 'Kaur Tata Usaha', 'Jl. Pendidikan Gg. Mayang Sari', '', 0),
(33, 1, 'I Made Sudiana', '1972-10-28', 'Kasi Pelayanan', 'Jl. Pendidikan Sidakarya', '', 0),
(34, 1, 'I Made Budha', '1964-07-29', 'Kepala TPS', 'Jl. Sidakarya', '', 0),
(36, 1, 'indra', '2001-06-21', 'barista', 'sedap malam', '', 0),
(37, 9, 'Robert', '2000-08-22', 'Driver', 'Denpasar', '5647383939394', 0);

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
(1, 2, '001/SPK/BUMDES/V/2023'),
(2, 5, '002/SPK/BUMDES/VI/2023'),
(3, 6, '003/SPK/BUMDES/VI/2023'),
(4, 7, '004/SPK/BUMDES/VII/2023'),
(5, 8, '005/SPK/BUMDES/VII/2023'),
(6, 9, '006/SPK/BUMDES/VIII/2023'),
(7, 10, '007/SPK/BUMDES/VIII/2023'),
(8, 11, '008/SPK/BUMDES/VIII/2023'),
(9, 12, '009/SPK/BUMDES/VIII/2023'),
(10, 13, '010/SPK/BUMDES/VIII/2023'),
(11, 14, '011/SPK/BUMDES/VIII/2023'),
(12, 15, '012/SPK/BUMDES/VIII/2023'),
(13, 16, '013/SPK/BUMDES/VIII/2023'),
(14, 17, '014/SPK/BUMDES/VIII/2023'),
(15, 18, '015/SPK/BUMDES/VIII/2023'),
(16, 19, '016/SPK/BUMDES/VIII/2023'),
(17, 20, '017/SPK/BUMDES/VIII/2023'),
(18, 21, '018/SPK/BUMDES/VIII/2023'),
(19, 22, '019/SPK/BUMDES/VIII/2023'),
(20, 23, '020/SPK/BUMDES/VIII/2023'),
(21, 24, '021/SPK/BUMDES/VIII/2023'),
(22, 25, '022/SPK/BUMDES/VIII/2023'),
(23, 26, '023/SPK/BUMDES/VIII/2023'),
(24, 27, '024/SPK/BUMDES/VIII/2023'),
(25, 28, '025/SPK/BUMDES/VIII/2023'),
(26, 29, '026/SPK/BUMDES/VIII/2023'),
(27, 30, '027/SPK/BUMDES/VIII/2023'),
(28, 31, '028/SPK/BUMDES/VIII/2023'),
(29, 32, '029/SPK/BUMDES/VIII/2023'),
(30, 33, '030/SPK/BUMDES/VIII/2023'),
(31, 34, '031/SPK/BUMDES/VIII/2023'),
(32, 36, '032/SPK/BUMDES/VIII/2023');

-- --------------------------------------------------------

--
-- Table structure for table `no_tabungan`
--

CREATE TABLE `no_tabungan` (
  `id_tabungan` int UNSIGNED NOT NULL,
  `id_nasabah` int NOT NULL,
  `no_tabungan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `no_tabungan`
--

INSERT INTO `no_tabungan` (`id_tabungan`, `id_nasabah`, `no_tabungan`) VALUES
(1, 2, '001/BUMDES/V/2023'),
(4, 4, '002/BUMDES/VI/2023'),
(5, 6, '003/BUMDES/VI/2023'),
(6, 8, '004/BUMDES/VII/2023'),
(7, 34, '005/BUMDES/VIII/2023'),
(9, 36, '006/BUMDES/VIII/2023');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tlp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `no_tlp`, `jenis_kelamin`, `alamat`, `username`, `password`, `email`) VALUES
(1, 'Mahendra', '089671xxxxxx', 'Pria', 'Denpasar, Bali, Indonesia', 'pegawai', '$2y$10$PYpRjbtLiQ92srTL3i96kuuHO.WCiLP57aHCNWqyNwfS78p.3cEIq', 'mahendrakoyo90@gmail.com'),
(9, 'Arie', '082146335727', 'Pria', 'Mengwi, Badung', 'arie', '$2y$10$S3FxXRaiEP6UYsva0vQdT.S1/JPz2M1rF3ILoIihlsCtm2/s8CNei', 'ariee.setiadi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pengawas`
--

CREATE TABLE `pengawas` (
  `id_pengawas` int UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_tlp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengawas`
--

INSERT INTO `pengawas` (`id_pengawas`, `nama`, `no_tlp`, `jenis_kelamin`, `alamat`, `username`, `password`, `email`) VALUES
(2, 'I Wayan Artha', '085778934562', 'Pria', 'Jl. Sidakarya, Denpasar Selatan', 'pengawas1', '$2y$10$HCfJ7ae2FrwpJEa7k58fU.aKc0c0IApkMkoTqZvU/iiog/IIKVsAa', 'pengawas@gmail.com'),
(4, 'Gede Pasek Ari Wiguna', '089743234551', 'Pria', 'Jl. Sidakarya, Denpasar Selatan', 'pengawas2', '$2y$10$9t.QlYHDtM9R8azao6BIde/asS9ranFQd4qN4PA899Yv0g4kzJSsG', 'Pasekari@gmail.com');

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
(5, 1, 1, '2023-06-10 17:52:35', 20000000, 1667000, 12, '2023-09-10'),
(6, 2, 1, '2023-06-15 20:55:31', 10000000, 833500, 12, '2023-09-15'),
(7, 3, 1, '2023-06-15 22:53:44', 5000000, 208500, 24, '2023-09-15'),
(8, 4, 1, '2023-07-15 12:15:00', 5000000, 417000, 12, '2023-10-15'),
(9, 5, 1, '2023-07-31 12:13:50', 5000000, 208500, 24, '2023-08-31'),
(10, 6, 1, '2023-08-24 19:31:15', 40000000, 833500, 48, '2023-09-24'),
(11, 7, 1, '2023-08-24 19:34:33', 30000000, 625000, 48, '2023-09-24'),
(12, 8, 1, '2023-08-24 19:37:42', 10000000, 417000, 24, '2023-09-24'),
(13, 9, 1, '2023-08-24 19:40:32', 5000000, 417000, 12, '2023-09-24'),
(14, 10, 1, '2023-08-24 19:42:43', 10000000, 417000, 24, '2023-09-24'),
(15, 11, 1, '2023-08-24 19:45:21', 25000000, 694500, 36, '2023-09-24'),
(16, 12, 1, '2023-08-24 19:50:25', 5000000, 417000, 12, '2023-09-24'),
(17, 13, 1, '2023-08-24 19:56:07', 35000000, 972500, 36, '2023-09-24'),
(18, 14, 1, '2023-08-24 21:25:08', 30000000, 833500, 36, '2023-09-24'),
(19, 15, 1, '2023-08-24 21:27:06', 15000000, 625000, 24, '2023-09-24'),
(20, 16, 1, '2023-08-24 21:29:09', 10000000, 417000, 24, '2023-09-24'),
(21, 17, 1, '2023-08-24 21:31:52', 30000000, 833500, 36, '2023-09-24'),
(22, 18, 1, '2023-08-24 21:36:45', 15000000, 625000, 24, '2023-09-24'),
(23, 19, 1, '2023-08-24 21:38:54', 5000000, 417000, 12, '2023-09-24'),
(24, 20, 1, '2023-08-24 21:42:40', 10000000, 833500, 12, '2023-09-24'),
(25, 21, 1, '2023-08-24 21:44:27', 20000000, 833500, 24, '2023-09-24'),
(26, 22, 1, '2023-08-24 21:47:24', 15000000, 625000, 24, '2023-09-24'),
(27, 23, 1, '2023-08-24 21:50:00', 5000000, 417000, 12, '2023-09-24'),
(28, 24, 1, '2023-08-24 21:51:24', 5000000, 417000, 12, '2023-09-24'),
(29, 25, 1, '2023-08-24 21:53:30', 40000000, 833500, 48, '2023-09-24'),
(30, 26, 1, '2023-08-24 22:04:22', 5000000, 417000, 12, '2023-09-24'),
(31, 27, 1, '2023-08-24 22:05:54', 10000000, 833500, 12, '2023-09-24'),
(32, 28, 1, '2023-08-24 22:07:31', 5000000, 417000, 12, '2023-09-24'),
(33, 29, 1, '2023-08-24 22:09:29', 10000000, 417000, 24, '2023-09-24'),
(34, 30, 1, '2023-08-24 22:11:14', 20000000, 556000, 36, '2023-10-24'),
(35, 31, 1, '2023-08-24 22:54:03', 5000000, 417000, 12, '2023-09-24'),
(36, 32, 1, '2023-08-25 09:59:59', 5000000, 417000, 12, '2023-10-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `direktur`
--
ALTER TABLE `direktur`
  MODIFY `id_direktur` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id_kas` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kitir_kredit`
--
ALTER TABLE `kitir_kredit`
  MODIFY `id_kitir` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id_nasabah` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `no_pinjaman`
--
ALTER TABLE `no_pinjaman`
  MODIFY `id_pinjaman` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `no_tabungan`
--
ALTER TABLE `no_tabungan`
  MODIFY `id_tabungan` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pengawas`
--
ALTER TABLE `pengawas`
  MODIFY `id_pengawas` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permohonan_pinjam`
--
ALTER TABLE `permohonan_pinjam`
  MODIFY `id_permohonan_pinjam` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
