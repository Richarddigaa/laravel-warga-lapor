-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2026 at 05:30 AM
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
-- Database: `warga_lapor`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('asd@gmail.com|127.0.0.1', 'i:1;', 1768790568),
('asd@gmail.com|127.0.0.1:timer', 'i:1768790568;', 1768790568),
('user@example.com|127.0.0.1', 'i:1;', 1792633761),
('user@example.com|127.0.0.1:timer', 'i:1792633761;', 1792633761);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Jalan & Trotoar', 'jalan-trotoar', '2026-01-16 00:18:40', '2026-02-01 19:35:17'),
(2, 'Sampah Menumpuk', 'sampah-menumpuk', '2026-01-16 00:18:49', '2026-01-16 00:18:49'),
(3, 'Jembatan rusak', 'jembatan-rusak', '2026-01-16 00:18:57', '2026-01-16 00:18:57'),
(4, 'Penerangan Jalan', 'penerangan-jalan', '2026-02-01 19:34:16', '2026-02-01 19:34:16'),
(5, 'Saluran Air & Drainase', 'saluran-air-drainase', '2026-02-01 19:34:42', '2026-02-01 19:35:04'),
(6, 'Listrik & Kabel', 'listrik-kabel', '2026-02-01 19:36:21', '2026-02-01 19:36:21');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_13_065427_create_permission_tables', 1),
(5, '2026_01_13_065854_create_categories_table', 1),
(6, '2026_01_13_070016_create_reports_table', 1),
(7, '2026_01_13_070030_create_report_media_table', 1),
(8, '2026_01_13_070042_create_report_statuses_table', 1),
(9, '2026_01_13_070056_create_rewards_table', 1),
(10, '2026_01_13_070133_create_redemptions_table', 1),
(11, '2026_01_13_070156_create_point_ledgers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 1);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage categories', 'web', '2026-01-16 00:10:40', '2026-01-16 00:10:40'),
(2, 'manage reports', 'web', '2026-01-16 00:10:40', '2026-01-16 00:10:40'),
(3, 'manage rewards', 'web', '2026-01-16 00:10:40', '2026-01-16 00:10:40'),
(4, 'manage redemptions', 'web', '2026-01-16 00:10:40', '2026-01-16 00:10:40'),
(5, 'create report', 'web', '2026-01-16 00:10:40', '2026-01-16 00:10:40'),
(6, 'view reports history', 'web', '2026-01-16 00:10:40', '2026-01-16 00:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `point_ledgers`
--

CREATE TABLE `point_ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `points` int(11) NOT NULL,
  `source_type` varchar(255) NOT NULL COMMENT 'report_verified, report_resolved, redemption',
  `source_id` bigint(20) UNSIGNED NOT NULL COMMENT 'report_id, redemption_id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `point_ledgers`
--

INSERT INTO `point_ledgers` (`id`, `user_id`, `points`, `source_type`, `source_id`, `created_at`, `updated_at`) VALUES
(1, 3, 393, 'report_verified', 2, '2026-01-18 20:33:03', '2026-01-18 20:33:03'),
(2, 3, 470, 'report_resolved', 2, '2026-01-18 20:33:17', '2026-01-18 20:33:17'),
(3, 3, 500, 'redemption', 1, '2026-01-18 20:33:43', '2026-01-18 20:33:43'),
(4, 3, 271, 'report_verified', 3, '2026-01-18 20:35:26', '2026-01-18 20:35:26'),
(5, 3, 500, 'redemption', 2, '2026-01-18 20:35:50', '2026-01-18 20:35:50'),
(6, 5, 183, 'report_verified', 5, '2026-02-01 20:09:50', '2026-02-01 20:09:50'),
(7, 5, 445, 'report_verified', 7, '2026-02-01 20:10:24', '2026-02-01 20:10:24'),
(8, 5, 755, 'report_resolved', 7, '2026-02-01 20:10:39', '2026-02-01 20:10:39'),
(9, 5, 468, 'report_verified', 8, '2026-02-01 20:10:56', '2026-02-01 20:10:56'),
(10, 5, 348, 'report_verified', 9, '2026-02-01 23:41:44', '2026-02-01 23:41:44'),
(11, 5, 424, 'report_verified', 10, '2026-02-01 23:42:44', '2026-02-01 23:42:44'),
(12, 5, 709, 'report_resolved', 10, '2026-02-01 23:42:57', '2026-02-01 23:42:57'),
(13, 3, 236, 'report_verified', 11, '2026-02-01 23:43:13', '2026-02-01 23:43:13'),
(14, 3, 305, 'report_verified', 12, '2026-02-01 23:56:25', '2026-02-01 23:56:25'),
(15, 3, 500, 'redemption', 3, '2026-02-01 23:57:10', '2026-02-01 23:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `redemptions`
--

CREATE TABLE `redemptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reward_id` bigint(20) UNSIGNED NOT NULL,
  `point_cost` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `redemptions`
--

INSERT INTO `redemptions` (`id`, `user_id`, `reward_id`, `point_cost`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 500, '2026-01-18 20:33:43', '2026-01-18 20:33:43'),
(2, 3, 2, 500, '2026-01-18 20:35:50', '2026-01-18 20:35:50'),
(3, 3, 3, 500, '2026-02-01 23:57:10', '2026-02-01 23:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `latest_status` enum('pending','verified','in_progress','resolved','rejected','closed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `category_id`, `code`, `title`, `description`, `location`, `latitude`, `longitude`, `latest_status`, `created_at`, `updated_at`) VALUES
(2, 3, 3, 'LP-260119-WCBCX', 'Jalan berlubang di RT 06', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Babelan, Kab Bekasi, West Java, Java, 17610, Indonesia', -6.18850433, 107.03374567, 'resolved', '2026-01-18 20:11:14', '2026-01-18 20:33:17'),
(3, 3, 2, 'LP-260119-W3LEK', 'banyak sampah di dekat lapangan RW 01', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Babelan, Kab Bekasi, West Java, Java, 17610, Indonesia', -6.18828814, 107.03375230, 'in_progress', '2026-01-18 20:34:58', '2026-02-01 23:42:04'),
(4, 5, 6, 'LP-260202-TGYVI', 'Kabel Menjuntai di Jalan Mawar', 'Kabel optik terlepas dari tiang dan menjuntai rendah hingga menyentuh aspal. Sangat membahayakan pengendara motor yang melintas, terutama di malam hari.', 'Sriamur, Kab Bekasi, West Java, Java, 17611, Indonesia', -6.18724554, 107.03991177, 'rejected', '2026-02-01 19:53:09', '2026-02-01 20:09:31'),
(5, 5, 5, 'LP-260202-3J7B1', 'Got Tersumbat Sampah Plastik', 'Air selokan meluap ke jalan setiap hujan deras karena aliran tersumbat tumpukan sampah plastik dan sedimen lumpur di depan Ruko Melati.', 'Jalan Rawamangun Muka Timur, RW 12, Rawamangun, Pulo Gadung, East Jakarta, Special Capital Region of Jakarta, Java, 13220, Indonesia', -6.19834269, 106.88246491, 'verified', '2026-02-01 19:53:55', '2026-02-01 20:09:50'),
(6, 5, 4, 'LP-260202-5WRE0', 'Lampu PJU Mati Total', 'Lampu penerangan jalan di tikungan Sektor 5 sudah mati selama seminggu. Lokasi menjadi sangat gelap dan rawan kecelakaan serta kriminalitas.', 'Jalan KB Melati, Kebon Melati, Tanah Abang, Central Jakarta, Special Capital Region of Jakarta, Java, 10230, Indonesia', -6.19766006, 106.81658171, 'rejected', '2026-02-01 19:54:23', '2026-02-01 20:10:08'),
(7, 5, 3, 'LP-260202-7GPAX', 'Railing Jembatan Keropos', 'Besi pembatas (railing) jembatan penyeberangan orang (JPO) di dekat pasar sudah karatan dan patah di beberapa bagian, berbahaya bagi pejalan kaki.', 'Ministry of Finance, MOF Walking Path, RW 08, Pasar Baru, Sawah Besar, Central Jakarta, Special Capital Region of Jakarta, Java, 10410, Indonesia', -6.17011513, 106.83674648, 'resolved', '2026-02-01 19:54:56', '2026-02-01 20:10:39'),
(8, 5, 6, 'LP-260202-HAHTD', 'Tiang Listrik Miring', 'Tiang beton PLN di perempatan jalan terlihat miring sekitar 20 derajat ke arah jalan raya setelah tertabrak truk kemarin sore.', 'Gang Tirtasabi, RW 03, Rawasari, Cempaka Putih, Central Jakarta, Special Capital Region of Jakarta, Java, 10510, Indonesia', -6.19151633, 106.85895971, 'in_progress', '2026-02-01 19:55:35', '2026-02-01 23:42:32'),
(9, 5, 1, 'LP-260202-O5NOG', 'Paving Block Trotoar Hancur', 'Trotoar tidak bisa dilewati penyandang disabilitas (kursi roda) karena banyak paving block yang lepas dan bergelombang akibat akar pohon.', 'Jalan Penjernihan 1, RW 07, Karet Tengsin, Tanah Abang, Central Jakarta, Special Capital Region of Jakarta, Java, 10220, Indonesia', -6.20141452, 106.81469443, 'verified', '2026-02-01 19:57:35', '2026-02-01 23:41:44'),
(10, 5, 5, 'LP-260202-BGYKM', 'Tutup Drainase Hilang', 'Penutup besi gorong-gorong hilang (diduga dicuri) di trotoar utama, meninggalkan lubang menganga yang membahayakan pejalan kaki.', 'Jalan Kramat Sentiong V, RW 06, Kramat, Senen, Central Jakarta, Special Capital Region of Jakarta, Java, 10450, Indonesia', -6.18605518, 106.85020959, 'resolved', '2026-02-01 19:58:11', '2026-02-01 23:42:56'),
(11, 3, 2, 'LP-260202-V1DFD', 'TPS Liar Mengganggu Warga', 'Terdapat tumpukan sampah liar di lahan kosong samping SD Negeri 01. Baunya sangat menyengat sampai ke pemukiman dan mulai banyak lalat.', 'Taman Kebalen, Satriamekar, Kab Bekasi, West Java, Java, 17150, Indonesia', -6.19122621, 107.03329596, 'verified', '2026-02-01 20:04:43', '2026-02-01 23:43:13'),
(12, 3, 1, 'LP-260202-DW543', 'Lubang besar di tengah jalan', 'Ada lubang aspal diameter 50cm dengan kedalaman 15cm di jalur cepat. Sudah menyebabkan dua pengendara motor jatuh hari ini. Mohon segera ditambal.', 'Babelan, Kab Bekasi, West Java, Java, 17610, Indonesia', -6.18829245, 107.03365185, 'verified', '2026-02-01 23:55:44', '2026-02-01 23:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `report_media`
--

CREATE TABLE `report_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED NOT NULL,
  `media_path` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report_media`
--

INSERT INTO `report_media` (`id`, `report_id`, `media_path`, `type`, `created_at`, `updated_at`) VALUES
(3, 2, 'reports/2_3_QjR3X_20260119_031114.jpg', 'image', '2026-01-18 20:11:14', '2026-01-18 20:11:14'),
(4, 2, 'reports/2_3_qnBIx_20260119_031114.jpg', 'image', '2026-01-18 20:11:14', '2026-01-18 20:11:14'),
(5, 3, 'reports/3_3_qhRxE_20260119_033458.jpg', 'image', '2026-01-18 20:34:59', '2026-01-18 20:34:59'),
(6, 3, 'reports/3_3_F4kTu_20260119_033459.jpg', 'image', '2026-01-18 20:34:59', '2026-01-18 20:34:59'),
(7, 4, 'reports/4_5_2IrA8_20260202_025309.jpg', 'image', '2026-02-01 19:53:09', '2026-02-01 19:53:09'),
(8, 4, 'reports/4_5_nVkRy_20260202_025309.jpg', 'image', '2026-02-01 19:53:09', '2026-02-01 19:53:09'),
(9, 5, 'reports/5_5_TcEKV_20260202_025355.jpg', 'image', '2026-02-01 19:53:56', '2026-02-01 19:53:56'),
(10, 5, 'reports/5_5_ytfKy_20260202_025356.jpg', 'image', '2026-02-01 19:53:56', '2026-02-01 19:53:56'),
(11, 6, 'reports/6_5_bEzbN_20260202_025423.jpg', 'image', '2026-02-01 19:54:23', '2026-02-01 19:54:23'),
(12, 6, 'reports/6_5_EJWL8_20260202_025423.jpg', 'image', '2026-02-01 19:54:23', '2026-02-01 19:54:23'),
(13, 7, 'reports/7_5_M0nDu_20260202_025456.jpg', 'image', '2026-02-01 19:54:56', '2026-02-01 19:54:56'),
(14, 7, 'reports/7_5_tVPys_20260202_025456.jpg', 'image', '2026-02-01 19:54:56', '2026-02-01 19:54:56'),
(15, 8, 'reports/8_5_STcxd_20260202_025535.jpg', 'image', '2026-02-01 19:55:35', '2026-02-01 19:55:35'),
(16, 8, 'reports/8_5_BkpQ3_20260202_025535.jpg', 'image', '2026-02-01 19:55:35', '2026-02-01 19:55:35'),
(17, 9, 'reports/9_5_j1b32_20260202_025735.jpg', 'image', '2026-02-01 19:57:35', '2026-02-01 19:57:35'),
(18, 9, 'reports/9_5_U8Pmp_20260202_025735.jpg', 'image', '2026-02-01 19:57:35', '2026-02-01 19:57:35'),
(19, 10, 'reports/10_5_N35ul_20260202_025811.jpg', 'image', '2026-02-01 19:58:11', '2026-02-01 19:58:11'),
(20, 10, 'reports/10_5_mwAWK_20260202_025811.jpg', 'image', '2026-02-01 19:58:11', '2026-02-01 19:58:11'),
(21, 10, 'reports/10_5_ko8po_20260202_025811.jpg', 'image', '2026-02-01 19:58:11', '2026-02-01 19:58:11'),
(22, 11, 'reports/11_3_WTqHs_20260202_030443.jpg', 'image', '2026-02-01 20:04:43', '2026-02-01 20:04:43'),
(23, 11, 'reports/11_3_QlKHY_20260202_030443.jpg', 'image', '2026-02-01 20:04:43', '2026-02-01 20:04:43'),
(24, 12, 'reports/12_3_qHJHL_20260202_065544.jpg', 'image', '2026-02-01 23:55:44', '2026-02-01 23:55:44'),
(25, 12, 'reports/12_3_08BIq_20260202_065544.jpg', 'image', '2026-02-01 23:55:44', '2026-02-01 23:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `report_statuses`
--

CREATE TABLE `report_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','verified','in_progress','resolved','rejected','closed') NOT NULL DEFAULT 'pending',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `report_statuses`
--

INSERT INTO `report_statuses` (`id`, `report_id`, `status`, `note`, `created_at`, `updated_at`) VALUES
(2, 2, 'pending', 'Laporan telah diterima dan sedang menunggu verifikasi.', '2026-01-18 20:11:14', '2026-01-18 20:11:14'),
(3, 2, 'verified', NULL, '2026-01-18 20:33:03', '2026-01-18 20:33:03'),
(4, 2, 'in_progress', NULL, '2026-01-18 20:33:10', '2026-01-18 20:33:10'),
(5, 2, 'resolved', NULL, '2026-01-18 20:33:17', '2026-01-18 20:33:17'),
(6, 3, 'pending', 'Laporan telah diterima dan sedang menunggu verifikasi.', '2026-01-18 20:34:58', '2026-01-18 20:34:58'),
(7, 3, 'verified', NULL, '2026-01-18 20:35:26', '2026-01-18 20:35:26'),
(8, 4, 'pending', 'Laporan telah diterima dan sedang menunggu verifikasi.', '2026-02-01 19:53:09', '2026-02-01 19:53:09'),
(9, 5, 'pending', 'Laporan telah diterima dan sedang menunggu verifikasi.', '2026-02-01 19:53:55', '2026-02-01 19:53:55'),
(10, 6, 'pending', 'Laporan telah diterima dan sedang menunggu verifikasi.', '2026-02-01 19:54:23', '2026-02-01 19:54:23'),
(11, 7, 'pending', 'Laporan telah diterima dan sedang menunggu verifikasi.', '2026-02-01 19:54:56', '2026-02-01 19:54:56'),
(12, 8, 'pending', 'Laporan telah diterima dan sedang menunggu verifikasi.', '2026-02-01 19:55:35', '2026-02-01 19:55:35'),
(13, 9, 'pending', 'Laporan telah diterima dan sedang menunggu verifikasi.', '2026-02-01 19:57:35', '2026-02-01 19:57:35'),
(14, 10, 'pending', 'Laporan telah diterima dan sedang menunggu verifikasi.', '2026-02-01 19:58:11', '2026-02-01 19:58:11'),
(15, 11, 'pending', 'Laporan telah diterima dan sedang menunggu verifikasi.', '2026-02-01 20:04:43', '2026-02-01 20:04:43'),
(16, 4, 'rejected', NULL, '2026-02-01 20:09:31', '2026-02-01 20:09:31'),
(17, 5, 'verified', NULL, '2026-02-01 20:09:50', '2026-02-01 20:09:50'),
(18, 6, 'rejected', NULL, '2026-02-01 20:10:08', '2026-02-01 20:10:08'),
(19, 7, 'verified', NULL, '2026-02-01 20:10:24', '2026-02-01 20:10:24'),
(20, 7, 'in_progress', NULL, '2026-02-01 20:10:30', '2026-02-01 20:10:30'),
(21, 7, 'resolved', NULL, '2026-02-01 20:10:39', '2026-02-01 20:10:39'),
(22, 8, 'verified', NULL, '2026-02-01 20:10:56', '2026-02-01 20:10:56'),
(23, 9, 'verified', NULL, '2026-02-01 23:41:44', '2026-02-01 23:41:44'),
(24, 3, 'in_progress', NULL, '2026-02-01 23:42:04', '2026-02-01 23:42:04'),
(25, 8, 'in_progress', NULL, '2026-02-01 23:42:32', '2026-02-01 23:42:32'),
(26, 10, 'verified', NULL, '2026-02-01 23:42:44', '2026-02-01 23:42:44'),
(27, 10, 'in_progress', NULL, '2026-02-01 23:42:50', '2026-02-01 23:42:50'),
(28, 10, 'resolved', NULL, '2026-02-01 23:42:56', '2026-02-01 23:42:56'),
(29, 11, 'verified', NULL, '2026-02-01 23:43:13', '2026-02-01 23:43:13'),
(30, 12, 'pending', 'Laporan telah diterima dan sedang menunggu verifikasi.', '2026-02-01 23:55:44', '2026-02-01 23:55:44'),
(31, 12, 'verified', NULL, '2026-02-01 23:56:25', '2026-02-01 23:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `point_cost` int(10) UNSIGNED NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`id`, `name`, `thumbnail`, `point_cost`, `stock`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Ewallet Dana 1rb', 'thumbnails/thumbnail_KiffS_20260116_071528.png', 500, 53, 1, '2026-01-16 00:15:28', '2026-01-18 20:35:50'),
(3, 'Ewallet Gopay 1rb', 'thumbnails/thumbnail_L6tWL_20260116_071944.png', 500, 54, 1, '2026-01-16 00:19:45', '2026-02-01 23:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'citizen', 'web', '2026-01-16 00:10:40', '2026-01-16 00:10:40'),
(2, 'super_admin', 'web', '2026-01-16 00:10:41', '2026-01-16 00:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(4, 1),
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0ftqsevlB6TcT8KpFFjiCiLLKeSV9Gw0yxrNTPJW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2NuZmxSSkdKc0o3VHB5VlpqTUQ5a3dyenlyN1VITXRITWVDejRoNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633431),
('18JqgABsgqZvc4B9qz6hPGfQKAo9ewBUbhJ0S5MN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidk1qWkV2a3RoSENxQUtkQ3ZMZ0d1N25SSlNSSDloVWZqd3h2ZDg5WSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633804),
('1eyRfeGHT20C6Y2tNquKM6iQLHuh5z91cYHXvxcv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGV5ZkFWMkFUd2VuMlJLaEZJUEV2VzhTR2xKRFozWDE1blFXekg3VSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633695),
('1Pso9Vakj3NKLfTPkMSnY7rGy7MnEPjMwnTWFygO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRUIxOUxYTWRneFRlTEFtWDRxckhDYThnM212bHJpQU95ajFTV2VORCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635368),
('2dOsQG52RsSlB7fCOsRZWE29XD2wmHoYzPf5NG4E', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidldtVkYxNzV6c1EzQkJxZVJpY3BYc0xaWmRwWHZadWoyUTRXcnNPNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1792635981),
('4tG4Tt7tonHiraaVh2dZ00a5dAE9fTbKUSUfHlN9', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV3NLWHNRbmlRM2VCeENXOFV3QlU5c2tEVDlabWNmbWFkTDIyRTE4RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634764),
('5gb5UO3s0kfAZuJg5nlWJUHIWwTSMqvcbzvt07Ir', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSUU4Y1dLZGRnTXdFWUpjbnRxTk83ekJXTDFBSmtlcFZPdUxIdk12YiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635073),
('6B0miKiKIaiwWZ7FHd7PSNCKt1MryBMLjPAqZ1ro', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid2VzeEs1cE41ZWp3VFV2cGVIT0QzOGR3T0cyNlltOU5TZDhKZVBocSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633806),
('6qlnJru6Fy0Psq0pQQo11GkS1Z4QqxLVq4CgB8B0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTRyUUY3M0FmckRZN2Q5dGVRd0hxQzhueWF5bllUdFR3bEdvYkJnayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633793),
('7IOZjcZIC9AGgaJtt7l5OeADc31B3lKSkEvUWsWj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzI2UG1nMHFKSXY1bTJsMWFFMjV3d1lGcjVHSjJaWnZoYmxwWDJnMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792636240),
('8ZpgbH44OJAKBotU7Dlk3bTX5LjqFh5n4YoviXpA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUVBVVlZKYWJMSUdJRzhRYWE4ZE5BeEU4MXVwUXA5cXBiM3JYdnQ0aiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635375),
('9P17czwv422cNMLUYW3c3BqyhgSe56twBbNIT5AW', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ2llYzFTWGxMWmlHR0hISlVWQjkyZnpUSFJNYzVyekJycURhWUpybyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634716),
('AbKX2OkDfiUQpbv3MYuz0ocGUN1U6MMCk07GcxzO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZjdSZHZSSUlscmFVbzJ3bW9PUHJpeUlVRkM2TW0wY040ZG1TNXVwciI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635380),
('aoFFWJaoQDmR99DpB2JBNJp79EWA1LfbC5LMEYgT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOWVIM0xIbGZjcnpVOTJBbVNtaHpNOWlpSTNKQUZVdGo1RlN1bklDMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792636239),
('BNGbzOzuQdXPlPLMp0x0eZ00o61WP5kfEUwkCqbY', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNXhmU3JGbGRVeUdneEV4c05lNDFkS3NLUVV3a3A3V1FVTjlSbVc3VSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634708),
('Cao8koRPDEVsl5XBTu9O658QpHLjeEMDpHXbXrqG', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVkJkc21SR28wd0Jwa2loZkVSMG9CUkdvWVlGa0t2dWtSbFg5Um9ITCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634415),
('cJmAmI2nfPNQgbReG90bHIq23Wk7TZQpCETfYr2X', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicVpsU1JvRUNJTE4wdm1vajFRMFlDRGNWTnE1SHc1N0lxZEprRGtlViI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792636275),
('cMbpLNOmsEzV3mvLxgEzTyl1y5RtZpT6Rbg908sr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjlIZk9qTWd1VUE1eW9EUFV0b1JkbjNlWkRueWRVMmllb1c3QVh3dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635971),
('CX4JFOFihUPOLpiXoPwEFdxwOzK5xdiq8AIOmVuW', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVmhCS1VjaUwzMXRPajY2WFFMZG4yTTZ0WkdMN1NFNTF3M3U2TjM4WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634772),
('D2crKqCLSJWmYEqUHFeona006tpw8dRhrLOXntWl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ2VaVjFlajFGRExCZ29keUN3SWtBUE5GYkhydFpUU1RNRzR5Z2x1eSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633531),
('D4l0WPObF90GZdaaFkDcHZrQTi01uzhb4D7DR8dS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid2RnNVdiWnliYlJlZ2ZlODd3cFRlVW1GRDVLdmEzaUFyUDlEeURsWCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635386),
('dN2oC2qh5wMQPYtdnrWZsDEUmnl1LHVEHLyHYdLt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNVhtWWxuZk03amhka2xNVGlibUloc0ZPbDdRczF2YlBMMTQxZEk0VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633416),
('dYfcx45IvCXt6Efz23TdqIcVGyeW5RNv1yC5x3Mj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZEJXd0N1MW9vcTdWR2hvc2NzdmFSWWhuMXFka013T29maGR3Z251WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633805),
('EcjTwSDxoh1FwxdmtWsOEaOcXVCphye5qrrf9GGE', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUmlhY1lITzdDeFVpRU5EakZpR0hybFBsa2NIVXV3REF1WTNodEgxdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXBvcnQvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1792637370),
('fjy7qqcYnPEEN1pl1MsMkpdnKf2voiPjmKO3T48h', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHFGdUVJQ1BLVG5jMUI0eWRQM1p4QTlDWUZFWDV4ZmR6ekw0SVJrSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792636237),
('fzpJPTXDkayjHeYJiXdPHp1Ggi6eHeMFQCaMmaqm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVnhqMVlaR0hMaWtCUHNkUUxwMWcxNmNZaVBWZ2s3NkhianQxZUd4MSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1792636272),
('G7UyIern1fimExWSg8UK3bPvV8mPzO4ePcLSw3X1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidlh2VkNDbm93cExSZ2p2ZDFKUElsTXJ1Q1BiTFF3eWdCOEw3Ym5kQiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635068),
('gp3Bur03wyMiLoaBB5gqq8sMGNE0VcPIT0dpSrDd', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNkF2S3ZURDh2RWJBaFM3all4cmNTUzFzTE5tOENUbVluUmtMQnZaTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792633813),
('gvLBmQ58ybeDCbwr7Rdd5jOXEbi7Vw2BLiXgNHi5', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEFoaUtZTGdlWnBJTmlTeHhuYzA0a0RaUUtYZkhIY29WVHZxbDJITiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633424),
('GW7rd803cCsJMTMXTZo0ousI3bDPZLQpIpmU2Vr2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZldZRFZMVk9Lc3Z2TktDRW5tRXBPRWx6YTBuMkRncTcyODV4cVpXOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633423),
('gzZ1BbzJ48yankqJyiAVvCe2W4uTlHbtkibvTg9d', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYU93NFM0d29kTG8zT0RXaDBNcTdJQ1BQcWM4Q1VlQXBVNU04S0NDQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634407),
('HKQwympuEAX6wTfgCSg9td6O8SWcaf2NZYixUVmU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVQwZ0xpSWt0VlZTWEx6VnN4eEY3d2gxSnJtbU5vcHBnaEdtbkJsRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633697),
('HPwUv9eJ5R2JY17p4cL3WL26qLwqbi6lvFj2h5Rn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGJLWmlLRUxXSWdKWUt1dUxiTjAzbDBYOUxxTFgxQ2M1eXdYcFNoUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633809),
('hXtqCW3ZQdpPNqtU1YqJJ0Sx72qhgypZfEkllyaS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXllTTNES2FHaXVrbjlwMDBISFBnR1puRmxtb3lyTTFWVVlaR1Z3WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633789),
('HYydBjg4Ld4OPxUgwsIiDsSRW63x0N8bVcuTfJbf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2l1R21TV2ZRcjE5TEJGVkhBcEtDTXZlSFBCZGJUb1Y3QUNncHRUWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635971),
('ibcoXIlaoqGLKgpxkvd21Jm7cYdHz4xVE3Gd66hp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkYza3RZeDR1aHdjV2pVY2VxQ3duVnp5ZVJVYkp0OXJNcFFVQzkzQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633696),
('IQxXtobUipgR7XMaXLVJPxZx3Vcf2qa45DmtZoSb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicWlZQzB0QUFUY2doMEdOS2x2anN6RktoQXJkOVlpdldNVTkxbDNmViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633796),
('iRn9YP5oh7EbCy8OAbDNwCN55tP1uSeeYdZ1yKvU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieXdPaklWOHFXS2U0TENqT3hDU1F5eUgxTFFmaGNKWFBHZFBIMDNsVyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635079),
('IUEaAiqW35dhHDHdhcZEIvpfMchsFLSiVOTrWOCP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0FSTnE4NUxZd05kSXZvOTRzWVlLMjE5UEhKZmI1anVDcVppRDR4NSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792636238),
('j1CXFXPfK3uufeYKC4pZisLfnHgYyMcNMwnB1wIV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRE9VVVZwSmU1M3NDT01pcmE3cXd0YTVIWU5QWGJZVExVbGNsZFdScSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jaXRpemVuLzUvZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1792639516),
('jkXbND5XeGcQhJWTxnLZ9eHJ5Qg1SZlYu88l9ba0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzhoY3BlZjY4VEVIa2NNOXQzTENHRTJFREdjUzR4UnZPUzhDbDV4MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633701),
('JQTk3A7U2DV4IUGRz2WhVSDg8teRna6oel0oLRao', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1M0YUVGWTVSN3ljaDgzd2tBeXgzT08xcXM2R0lPb2Foa0oySHJZbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633791),
('jxtB0IQ1VZ6miLyoPOpjwObEAysNZAf0dimQ7dv8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUDg2NVFGVmljbk14V1NQYlhLeG5McnZSNWJ1SEE2REdvT3FrVTJtbiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635091),
('kEQzBnSZ5ZEJAG437qskwIBHppwMjpdZ65j1gowI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkk2ODlWOE8yR29BNFNEVnZCUHFkWVlGeGQ2ZzZwSkFYYWVNRG5PNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633797),
('kpLmoZ7bsVPnoY4ovkfKQ1gxpebiO4HeRen3Xon6', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNGpIZW1XVk9QdkxuRnkzNzI3TGtaTkw5d3BnaUxmaVEzRVdrQUhiciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZXBvcnRzL2NyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1792639075),
('LgrzVayI0ZzzwqqMxLlgiUrmszLXgLORdL18zof3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTXAyRU50RjFsbFl6am54cUk5dFFRSDd4UkNhNTRjRUFjN3NpeXJ0TSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633792),
('MEQeiFd8YslP8j5SLQvltytOzHkEoOVfoc6LhCVs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRTV4T1l4U2RMcTRoNmRrMXZidTBTQkphSXZLUlRsSGNQRUJvb1IwcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633808),
('MKpr9EycgZPHQIu6wDd4lIZQj4ViT9RMAjnR8Znk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHdObUp5b1V1QWxtR0I2MnhhektWcEVsdURsRXNueFdFUUpuajRoQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633420),
('mS2NHWMJJU9neltyONJNHIxFN6zmSDC9r2aEfK83', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0hDT1NjakpMWGEzakw0TEZ3T0xnN1NvR0JxN3hMYnVUcnRucDJxViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633790),
('mxaSggGxC4XZ8N2ggDkjiBuLCC94FTFkSwOt0uYy', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ3I0U3hLZHRucVpvOTAxT0JNOTVSMWh0M1RNVTRqeUJKcjNpTno1dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1792638359),
('N0MZ6wlmfpJPGr4TZft0LQybmI02MAJ2fIApkmmV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmU4RXNJVVZpZzM5a2V2Q3U5TXVGOTB1VHdlTmJCbUxsZEM4a1NaYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1792635966),
('n1Ee8n4j1k4rDMsvIXUFOubiCbMh5vDKPJxmLFIY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0xBNkdqVmFXVFFGOXVQRVFmUUFzV1lZVjkxWTNObjhiVzJ4dnRKTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792634704),
('N1GUfn0Lb4bQpRCeSH9KlcLmpfN3gyIRUFfkN24h', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicjhhNUZrdHJGM0VkUG1MMzBkOWNRbE9wNGZlZEVwenBRN0FBWkZpbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792636239),
('nAuG38BgLK0Nwy1yqgEjkkcnNokPvp43yclVAZjl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUTZJSlFzTllEMkJBUjFPQmtBRkp6eEFMSTB6RjdUUnVVR1dxcUhKaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1792634778),
('ntJ3cghQWD9y5d3P83nAebpWhXgAwgSeOGTlolVY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1h2bTNxREM3NFcwczVPY2d5Rmhxd003ZWNSbzA3YVlvMldWdHVSRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792637293),
('NuONwXNJdUWZZOlkPM219U0Iu5Ephfe3TCaXuVyD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXhISXhHQ2tYb1ZTdHpoTEZIMVkxcDhueGRmQm5NY0hubXpORjdYbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1792634727),
('nVsjcMVAxM3tjyKo71L2aXj1117vT50CGeOXKOII', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTGNJNnIzcERPa2dnWHR4ZFcxQno3bEU1M1hGVjJtYXJMeVFPeExabCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1792634797),
('oKB03Ad9RegJF6ZxTHXHYfidTwruVPoalVQ1Wxen', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibmpidnlqcEJPWGhhYXhTWjViaFR1SkZoVzR1dG5odUtXQ21JVDNJdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1792635482),
('OrjFmqDsGMeKmKlH1Aa3oQ7lMzttwsT1ClKXp7E6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiem45MGxIQktVMmxHblFvamFDdnU4SnVzb3A5VEh4dWFBRXZZb3hCciI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635370),
('p3nIJuoqC65IC3nO1DlEKdsmcdrqprRAjjKIo5sf', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZEMxOW03eGxXY1lETUljUmJkSVE5VDluV2xMVjlSQ3pDaWFWVHIzSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jaXRpemVuLzUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1792639374),
('P5Twopv6OIuyaSxpfGLcJv88tQnYbEC4FnVCHOMd', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibHJLR2VtTk5HR1FrSm5HaHRwem1WY1I3RVp4Z3JqZEx4SnNtNjVaZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXBvcnRzP3BhZ2U9MSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1792636967),
('PfcQEPisiv2tU20zGgAF0xvelDdW9eub9RQVGZSn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVkh1UG1ZR0pDVjZ1RWxYcHA1VWU2bVp6WXhBd2tKQWV3UUN6ZnY2TyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635970),
('PgchSpOCdBiL7akIlmgCZwlaDoOksSmKEQO1bJKE', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYzlodkVZSmp3ckY1ejBDbkl5YjRGWEVWbU1QMjVBUFNhczhCaHRJNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634419),
('pq0ZnwymuJyQbge6RJ2SDlo6hLQShFBb4VyEzBkE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRzRBTjl4SGdYRms0cGJGUzJXMXRrcGdZVGlTRWVWNndIZTBmY2UyViI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635085),
('Q7iEat2PtqdfOYDHVqpifdcLYLodWsjx2QXgD0aQ', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiak1rck81S2NDdDdScllOc211enVmdk5RWXh4d0ZCNXdKQ0FHUHRLMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634720),
('QFsHNpumQuJdc7U6cPTi4nOG56FKIIz4ptlrJyCC', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV1RCM21QazNQbWFoM3JTY25mOEN1U2RsTVc3aGZIbHJxYVpkMWZlbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634761),
('qjsHMDxCNDKryw5WszZ7YyBNQkUSRfSPGKg7h8WI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSk5vTGVmYTNwQ1pHalpnOHJSdjJqem94YkxoSXhFN1JEcVd1bzRGQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633698),
('Qvbs8SZOJcbpZoSAgAJ5dRactcaRJYWFLhJH9nL8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlB1NTcxQWMxRFdmeEpZSHdzenZlbVd2UmZqQ3RFbWlMTEZ6U3BkVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1792636287),
('R13Vb8tTcWNLMP7u0Kq1059yVGADLoZJNGvSDmf2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR3Q2bEZLZER5TWNBbzhXdm9qM2NrOVJNUnVvNG8wQlNHMWY3U0VwciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633794),
('SgLiS0UXCwC3si1vU8vTwHRK64pMQ0R5kYVr8dlR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDFjN21yS01ORU5lMXNPdzhVVGsycFpZVHdCMGtaT1J4VDdxcURxaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633422),
('sML97GE3wOA9rCx642AICorSs9dflrlD378OQLpQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzlibmphTHk4SzEzWDM5OFdPZjFlUlRaYnk2NW13bDExem5Mb2t1NiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1792634426),
('SYqMNhSd5HFYJiVSFhjKhpEgu2uoMICDfxDmj9nM', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieG41V1hyWlNZUnBWWEJmVFBwZUVDMlVuVXRGTVYwckliRmwySnhWUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXdhcmRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1792638132),
('TjPDviEg9KDYfsEpBN9iXPa89JxCJ0UIbm4r383P', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTklPak45YjJzclhYb24wREp0ZVAxMDlic2lSMG00cTNaWjZMcVJHMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792637306),
('Ty92rJLsI4Vs4BuXsKlHyKafxVOxfgLjoW0mn0qP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXExQnpBbkk2alE2aHlJWFBGaUNJT1pBemFHZk1NOUlPVWNzQmhuaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633535),
('U9QHqoZWTjWQaRrmpflSHfp27ARa12Dj2qF1NSNG', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZW00cDJyTVdKZHU2bDR5NDRnb2E4Z21TekpTek9YZXRINUtCWUJJOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634783),
('VNVEPGmWAjdKciGLV8b9UFN1G09Ngtb9XCKoIfDQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGs2ODBSNUZzYTlDU1lVUFNqU2pWMURiZUl0WTlWc3FTYlRJdjVNZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633533),
('vvScnHdw4PhCC8qmBuPZFqdggN1o4lVopxgCpfLX', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM0l2cnZDbXR5VjRUOENHT2hVcU1SamgxWGZZaGNnZ0VJWmJuMWxSYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634768),
('VWurYdhY3FTaowfeZssEybxplyygKMRh4mGQYV0P', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRlVpMXRHSGtuZktrbGtMZVZCVncxcTR4TWNyc1ZYWXRidldtaldzMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792636254),
('wCcy5zyfYgY2nWkDg1vi0u8l7DUhxxLj6pxvDACt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieVZTVk54aFJvSGdQUEQxOG1TcTlMZlRqcTdOREhUYzV3YmpvS3JYYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792634704),
('wEI5TMoO2djvYnqzqjrHhvKJlirJSnbHMvrfhwEk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQk1oOXdjUTl0clNhWFFhR3lkZWQyWE5zOWExMUJEWFV5S1ZZOUFJbiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1792636002),
('wPqC69BtGrSgeBFG40IPGKy2qaNkwtzjI5WIL4nJ', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYmgxNE9kS3c4TFBHNjB6cEgwOXlIQTc3YXlRNUcxZUJ5TlpMVFpwbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1792637957),
('Wvof2g83SzZnVJh9ENFvzRKIVXhy2BKgsdzfFyHq', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWmtMcWJQYjJLV0x3S0tuTldSV2VzWnF1T3A3ZDlXdm5MYzJDeUtIMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZXdhcmRzLzMvZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1792639315),
('wzs1XBfauv9a3PzOSOpps72DuNAJQ9bUNEWtHwoa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzVGWk9zc0hpdHFSRHlOMjdWUkQ3bWM2cktUdDlDR1BWY1JNbkpnVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633695),
('xFeoy6SyAFg3pVO219JoD9wu3VmmeOj3WStExZo6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVkcxeHVBclk5ZjRtVDNHc2FDSzdPME9VRXNJSFhRdDZYcEczWnZqViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633532),
('xYw0OUCsM4qYOoQ3S19dFhNHclRUUArRjs9Ww3Az', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicWEzakk4ZTlDSmFWN1BTYnBxbGJsbWZLSjJwZFp1cmU3S0Z4aTF2NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792636240),
('y8LgsFXR3EwJrlfAqgWPP2aVbvkRa42qgxahkokW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXE1eE5MdGlNMFZlZG9ObUxZY0pETjFRZG9CcVZWaXRFWms4RHA1VyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633530),
('Yc1Py0f64YrIwPuB5yYNSLI7a2yrzHHwDcdgyFOX', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidGJYY1FleGI0WmVMVnFOaHlQN0x3VW1LN0ZNeUZsSXRhMmZaVWpkQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634791),
('yEb9qcoAoZyunTnfXaOMimatqybsSBABCNoD3gvd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGpkSXpDMm4zT1Vhdkp3dDEzNjluWEl4RjA2a2tJZTMxcDhiY0dRZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633530),
('Yk114BpQbt2sZYk8N2lF0Z3DIDlsxG74nTFe2sDj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ3Z0SnhRZExudmNDOWdZeFl4VzNIN1dWSTM2cFpaTGY4MmlWMTdWVSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635366),
('yTb5pNEa7EKJjUUEZXeYsk4LJHEb07sv2JsuCyD3', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN1RSQTA2RWZNRTY3Z0Z2VWt3aHI2UHFQbFE0SGdrVldtSzRIRkhMQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792633803),
('YtfVYCWghRd8NRVvv0JZ2dmXGVaiOUSbBts6xdP3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHNGMjZBelNZaUJDcURrcUx2emdrZVNJbThwZFZHZlU1a1B6TDJBNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635458),
('YUcvx7PBExsoQSKQylRDxsEiEUNkFfXAnvmugiyI', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQWtMZzZON0lUOHg1OGNVU2VwOGRNUUI2YzJxRDA0cnBBUTRuZzM0eCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1792636248),
('YxQA4YdZDvvIJSQjt1KLEleyq8T81MS55qjWfgeR', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV05CRTJCZGFnUzIzYk1lRlF2UW92anNXekttSElicW1JOGNxN0hLQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1792634787),
('YzQO9Kb6vXxaOtGpnt6D9mpkHDJakDA1e8nihU8s', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3FzVXk1Y2U5aEQ2QmNVYWc1R1VqanVndVFoUDg1Njhjb3ZaaDB1dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792633795),
('yzZIZus7HzY15p053L3M3PnIqLxoLizZObXB8CSI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRGJFZThJNGhKOGFBWHlXYW1xckY4YmNyOWNHZUd3aHpHeEZJNkN2byI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1792635737),
('zbjkeo76j4R1AbNwo5O34oFxVs0vl86YAhkwiHJt', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNGU4N0hIQlVoYmZJemFmekNpSDIzalBCV2NNT2JINHVreGlZa2V4WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXdhcmRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1792637605),
('zEB5Mqtlz0E4YZGOXzH9iJAGQ5ZxMfhFk1KdVOnv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR21ySUhnUmpaRnBWV0Y0VEp6RnhkaGRsWmtnOU9UOFJrdVJKNjhINyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3JlcG9ydHM/cGFnZT0xIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792635364),
('ZEbxs2HSKpAQhMurGHYgLfkJRYWn1ZpSICqVYdwa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36 Edg/155.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia3R2ZWhZM1Zhd0xoTUhPcHM0NWhrZFhjcFZUd2tKVGI3UGFYdG8ydSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792636238);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `nik` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `type_of_work` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `avatar`, `nik`, `name`, `email`, `phone`, `date_of_birth`, `type_of_work`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, '3212345678901234', 'Super Admin', 'super@admin.com', '08123456789', NULL, NULL, NULL, NULL, '$2y$12$4zSIP2EiUQzhFfNwgH1Wp.hF1ZM89o9Jhez8S725WEssx.6fiufiW', NULL, '2026-01-16 00:10:43', '2026-01-16 00:10:43'),
(3, 'avatars/avatar_3_ZhahP_20260120_025609.png', '3212345678912309', 'Richard Diga Andreansyah', 'richard@gmail.com', '081122334455', '2003-05-12', 'Software Engineer', 'Bekasi', NULL, '$2y$12$YwPyU/v4H2d7D1e9qEdsiuT0w3c2UowqhdGFT3Za9Ck7Pcg2qgVbO', 'u1zAiSkuRPHj9VQICk8a8BgeGncVCw2WHs6shyaJKHce3BZcAVWrkW3ryFEd', '2026-01-18 19:42:03', '2026-10-21 19:57:21'),
(5, 'avatars/avatar_Uido4_20260202_024231.png', '1234567890012345', 'Linggar Pramudia Adi', 'linggar@gmail.com', '081234562341', '2003-11-13', 'Mahasiswa', NULL, NULL, '$2y$12$n3OIMun3TJbVst9nf5d91eeKPHcjZOj4Pfi6h/NzUQ/bbbwumhAEW', NULL, '2026-02-01 19:42:32', '2026-02-01 19:42:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `point_ledgers`
--
ALTER TABLE `point_ledgers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `point_ledgers_user_id_foreign` (`user_id`),
  ADD KEY `point_ledgers_source_type_source_id_index` (`source_type`,`source_id`);

--
-- Indexes for table `redemptions`
--
ALTER TABLE `redemptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `redemptions_user_id_foreign` (`user_id`),
  ADD KEY `redemptions_reward_id_foreign` (`reward_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reports_code_unique` (`code`),
  ADD KEY `reports_user_id_foreign` (`user_id`),
  ADD KEY `reports_category_id_foreign` (`category_id`);

--
-- Indexes for table `report_media`
--
ALTER TABLE `report_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_media_report_id_foreign` (`report_id`);

--
-- Indexes for table `report_statuses`
--
ALTER TABLE `report_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_statuses_report_id_foreign` (`report_id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `point_ledgers`
--
ALTER TABLE `point_ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `redemptions`
--
ALTER TABLE `redemptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `report_media`
--
ALTER TABLE `report_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `report_statuses`
--
ALTER TABLE `report_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `point_ledgers`
--
ALTER TABLE `point_ledgers`
  ADD CONSTRAINT `point_ledgers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `redemptions`
--
ALTER TABLE `redemptions`
  ADD CONSTRAINT `redemptions_reward_id_foreign` FOREIGN KEY (`reward_id`) REFERENCES `rewards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `redemptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `report_media`
--
ALTER TABLE `report_media`
  ADD CONSTRAINT `report_media_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `report_statuses`
--
ALTER TABLE `report_statuses`
  ADD CONSTRAINT `report_statuses_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
