-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2025 at 03:42 PM
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
-- Database: `booking_ruangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `booking_code` varchar(255) NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `total_hours` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `booking_code`, `booking_date`, `start_time`, `end_time`, `total_hours`, `purpose`, `status`, `admin_notes`, `approved_at`, `rejected_at`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'BKsVtYdB85', '2025-12-22', '08:00:00', '10:00:00', 2, 'Latihan', 'completed', NULL, NULL, NULL, '2025-12-21 08:02:54', '2025-12-21 18:34:56'),
(2, 4, 2, 'BKsVdJjSAM', '2025-12-22', '11:00:00', '13:00:00', 2, 'Kerja kelompok', 'completed', NULL, NULL, NULL, '2025-12-21 18:32:41', '2025-12-21 18:34:47'),
(3, 6, 2, 'BKItrzyStK', '2025-12-22', '08:00:00', '10:00:00', 2, 'Kerja Kelompok', 'completed', 'Siap', NULL, NULL, '2025-12-21 19:40:50', '2025-12-21 19:45:43'),
(4, 4, 2, 'BKsT06mGGo', '2025-12-22', '11:00:00', '13:00:00', 2, 'Kerja kelompok 2', 'rejected', 'Data tidak lengkap', NULL, '2025-12-21 19:44:26', '2025-12-21 19:43:33', '2025-12-21 19:44:26'),
(5, 7, 6, 'BKMJgGFbIp', '2025-12-22', '08:00:00', '10:00:00', 2, 'Latihan tari', 'approved', NULL, '2025-12-21 21:19:35', NULL, '2025-12-21 21:18:53', '2025-12-21 21:19:35'),
(6, 7, 1, 'BKFWlnH9qn', '2025-12-22', '14:00:00', '16:00:00', 2, 'acara bazzar', 'completed', NULL, NULL, NULL, '2025-12-21 22:40:05', '2025-12-22 05:45:08'),
(7, 3, 4, 'BKjMZTZRMN', '2025-12-22', '08:00:00', '10:00:00', 2, 'cek', 'completed', NULL, NULL, NULL, '2025-12-22 02:25:49', '2025-12-22 06:40:01'),
(8, 3, 1, 'BKOidRo9Um', '2025-12-23', '08:00:00', '10:00:00', 2, 'Pelatihan Coding', 'approved', NULL, '2025-12-22 07:13:59', NULL, '2025-12-22 07:12:03', '2025-12-22 07:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2025_12_20_142321_create_rooms_table', 1),
(5, '2025_12_20_142410_create_bookings_table', 1),
(6, '2025_12_20_142451_create_sop_table', 1),
(7, '2025_12_20_151248_add_extra_columns_to_users_table', 1),
(8, '2025_12_20_160929_remove_price_from_rooms_table', 1);

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
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `facilities` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `slug`, `description`, `capacity`, `facilities`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'LOBI', 'lobi', 'Ruang lobi yang luas untuk pertemuan informal dan penerimaan tamu', 50, 'AC, Sofa, Meja, WiFi, Proyektor', 'lobi.jpg', 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56'),
(2, 'RUANGAN KELAS', 'ruangan-kelas', 'Ruang kelas untuk workshop, pelatihan, dan pendidikan, tugas belajar', 30, 'AC, Whiteboard, Proyektor, Meja & Kursi, WiFi', 'kelas.jpg', 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56'),
(3, 'RUANGAN AUDITORIUM', 'ruangan-auditorium', 'Auditorium dengan kapasitas besar untuk seminar dan presentasi', 200, 'AC, Panggung, Sound System, Proyektor, Lighting', 'auditorium.jpg', 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56'),
(4, 'RUANGAN CO-WORKING SPACE', 'ruangan-co-working-space', 'Ruang kerja bersama untuk freelancer dan startup', 40, 'AC, Meja Kerja, WiFi, Printer, Coffee Corner', 'coworking.jpg', 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56'),
(5, 'RUANGAN STUDIO MUSIK', 'ruangan-studio-musik', 'Studio musik lengkap dengan peralatan rekaman', 10, 'Instrumen Musik, Sound System, Mixer, Ruang Kedap Suara', 'studio-musik.jpg', 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56'),
(6, 'RUANGAN TEATER', 'ruangan-teater', 'Teater untuk pertunjukan seni dan drama', 150, 'Panggung, Lighting, Sound System, Gorden, Ruang Ganti', 'teater.jpg', 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56'),
(7, 'RUANG EDITING', 'ruang-editing', 'Ruang editing video dan audio dengan komputer spesifikasi tinggi', 8, 'PC Editing, Monitor 4K, Software Editing, Headphone', 'editing.jpg', 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56'),
(8, 'RUANG SENI PERTUNJUKAN', 'ruang-seni-pertunjukan', 'Ruang untuk latihan dan pertunjukan seni', 25, 'Cermin Besar, Barre, Sound System, AC', 'seni-pertunjukan.jpg', 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56'),
(9, 'RUANG SENI RUPAA', 'ruang-seni-rupa', 'Studio untuk melukis dan seni rupa lainnya', 20, 'Easel, Pencahayaan Alami, Wastafel, Rak Penyimpanan', 'seni-rupa.jpg', 1, '2025-12-21 07:10:56', '2025-12-22 06:43:35'),
(10, 'RUANGAN FOTOGRAFI', 'ruangan-fotografi', 'Studio fotografi dengan backdrop dan lighting profesional', 15, 'Lighting Kit, Backdrop, Kamera Stand, Changing Room', 'fotografi.jpg', 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56');

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
('ZlihC6dkBlYcZ9Zmp1xKp00PkpyxMrEVmxzkrckp', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQXdHd1BFUlNyaHVCa1hqQXAySlNTNGtoTWlLaWRLTEZvSTN0a3pwTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zb3AiO3M6NToicm91dGUiO3M6Mzoic29wIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1766414415);

-- --------------------------------------------------------

--
-- Table structure for table `sops`
--

CREATE TABLE `sops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sops`
--

INSERT INTO `sops` (`id`, `title`, `content`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Pendaftaran dan Persyaratan', '1. Pengguna harus terdaftar sebagai member Sumedang Creative Center\n2. Menyiapkan KTP/Kartu Pelajar sebagai identitas\n3. Mengisi formulir peminjaman secara lengkap\n4. Menyertakan proposal kegiatan (untuk keperluan tertentu)', 1, 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56'),
(2, 'Proses Pemesanan', '1. Pilih ruangan yang tersedia pada jadwal yang diinginkan\n2. Lakukan booking minimal 2 hari sebelum penggunaan\n3. Booking dapat dilakukan maksimal 30 hari sebelumnya\n4. Durasi minimal peminjaman adalah 2 jam\n5. Konfirmasi booking akan diterima dalam 1x24 jam\n6. Booking dapat dibatalkan maksimal 24 jam sebelum waktu penggunaan', 2, 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56'),
(3, 'Persetujuan Booking', '1. Admin akan meninjau booking dalam 1x24 jam\n2. Status booking dapat dicek di dashboard pengguna\n3. Booking yang disetujui akan mendapatkan kode booking\n4. Booking yang ditolak akan diberikan alasan penolakan', 3, 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56'),
(4, 'Saat Penggunaan Ruangan', '1. Datang 15 menit sebelum waktu booking\n2. Lapor ke resepsionis dengan menunjukkan bukti booking\n3. Jaga kebersihan dan kerapihan ruangan\n4. Laporkan kerusakan peralatan sebelum menggunakan\n5. Tidak diperbolehkan merokok di dalam ruangan\n6. Patuhi kapasitas maksimal ruangan', 4, 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56'),
(5, 'Setelah Penggunaan', '1. Kembalikan ruangan dalam keadaan bersih\n2. Matikan semua peralatan elektronik\n3. Laporkan ke resepsionis untuk pengecekan\n4. Isi form evaluasi penggunaan ruangan\n5. Ambil barang bawaan pribadi\n6. Laporkan jika ada kerusakan selama penggunaan', 5, 1, '2025-12-21 07:10:56', '2025-12-21 07:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `is_admin`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Boss Admin', 'scc@admin.com', NULL, NULL, 1, '2025-12-21 07:18:31', '$2y$12$Nl6jFjEtnPmx8vT67ynMU.VWLY0LiWw5emmg2mNdTE381OJxjTfiu', NULL, '2025-12-21 07:18:39', '2025-12-22 07:36:36'),
(2, 'Muhammad Lazuardi Al-Farisi12', 'risuunava@gmail.com', '082115276734', 'Cisitu, Sumedang', 0, NULL, '$2y$12$uZBmmibVDR0k8GOVynV6AexnCTx2JFp1vUdcvsqfezExJqkRyrLGe', NULL, '2025-12-21 07:28:15', '2025-12-21 07:54:29'),
(3, 'Aqila Audia Farisna', 'aqila@gmail.com', '0821152767342', 'Cisitu, Sumedang', 0, NULL, '$2y$12$6DLo7YhA3Ku0CY3U/rTgW..ZIr3zajD628d3tcnu8SfH.lLHmrJBy', NULL, '2025-12-21 08:00:15', '2025-12-21 08:01:30'),
(4, 'rama bagus p', 'rama@gmail.com', '082115276755', 'Sumedang', 0, NULL, '$2y$12$AUoE6ibsbEX0DFDglvq4VO6lx9zUg0NAmUQdsNcY0/tunFLmO354q', NULL, '2025-12-21 18:31:26', '2025-12-21 18:38:36'),
(5, 'risunava', 'risu@gmail.com', '0821152734356', 'Cisitu', 0, NULL, '$2y$12$x3MUXnSZv55wY3Cd3JhsguhuVI9MudyOCl3Fc0hOyxmyNBi69UoDe', NULL, '2025-12-21 18:53:46', '2025-12-21 18:53:46'),
(6, 'Dara Davina', 'dara@gmail.com', '0821154353635', 'Sumedang', 0, NULL, '$2y$12$7jkusLhXTIDPVu/MtsbSoO/EKawr7AqUDf4OYV4OFhbB4YFYZPzqq', NULL, '2025-12-21 19:39:59', '2025-12-21 19:39:59'),
(7, 'Deniiii', 'deni@gmail.com', '0821152394174', 'Sumedang', 0, NULL, '$2y$12$SXGOXDiBhIUYChaEqlXZ9uutQ5whaJJXv.ccqI9onhJTs5OV2Zjiu', NULL, '2025-12-21 21:17:54', '2025-12-21 22:00:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_booking_code_unique` (`booking_code`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_room_id_foreign` (`room_id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rooms_slug_unique` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sops`
--
ALTER TABLE `sops`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sops`
--
ALTER TABLE `sops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
