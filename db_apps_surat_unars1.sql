-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 12, 2024 at 03:10 AM
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
-- Database: `db_apps_surat_unars1`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_student_letters`
--

CREATE TABLE `active_student_letters` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `active_student_letters`
--

INSERT INTO `active_student_letters` (`id`, `student_id`, `purpose`, `created_at`, `updated_at`) VALUES
('00ff3db3-03bc-492f-bd23-607186b0151d', '26884778-6610-4b51-8d3b-0a12c9098843', 'Persyaratan mendaftar beasiswa prestasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('0c8a34d0-a498-4fd9-83e2-0501c6a53c09', '983c6097-ec29-416d-9ab5-64ece6ec3f90', 'Persyaratan mendaftar beasiswa prestasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('40ecfcf2-748a-412a-8478-f3b26677dd2f', '98ee7e57-87ab-4080-91c8-0193467dde3b', 'Persyaratan mendaftar beasiswa prestasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('64140391-8da2-4b31-a37c-cbf59550462a', 'b1de470b-d9d2-4876-b855-3f82c9bcafbe', 'Persyaratan mendaftar beasiswa prestasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('88409a40-7d73-421a-b2e2-fe7672eadeac', '13d4520b-a4c2-42c7-afb5-775691b56df4', 'Persyaratan mendaftar beasiswa prestasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('a8a3a43f-6ba4-4da5-bfa9-9d7ab45738b2', '07ab9483-3ccf-4afa-ac68-6bdc84b9689f', 'Persyaratan mendaftar beasiswa prestasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('c0d82aaf-e2fe-4225-8b8d-71c3e2682af9', '3971c3b5-3716-4178-bd35-cf2a3e23ab64', 'Persyaratan mendaftar beasiswa prestasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('ca6b1258-0221-4288-a538-5db88d36f1dc', 'a8e33f14-5197-458c-83c8-b371bf1e8da5', 'Persyaratan mendaftar beasiswa prestasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('edc838bf-5824-44d7-94be-4aecf4a72c5f', '54f9d1e1-97fc-40e1-bcf4-8c3acc083075', 'Persyaratan mendaftar beasiswa prestasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('fa489926-4784-4750-af28-082531b7eee0', '5b32c2a5-83c1-4024-a2af-05d738f6041c', 'Persyaratan mendaftar beasiswa prestasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivable_type` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivable_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`id`, `number`, `archivable_type`, `archivable_id`, `created_at`, `updated_at`) VALUES
('00f43c97-8a80-4af8-b0f8-e3442ee8f176', 'ARCSFVWIG092024', 'App\\Models\\StudentCertificate', 'd12a01ae-5ac9-4952-b7a6-1dee59f82393', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('09c6c7b8-3f95-46d4-b769-30347aa959cc', 'ARCSKQHBT092024', 'App\\Models\\SchoolDocument', '7f5c5a9e-ad0c-4d9b-927e-f3f77c38db8b', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('21e2814a-6174-4bef-89d6-0a05233ca6b1', 'ARCJLIU44092024', 'App\\Models\\StudentCertificate', '9926be49-1a05-4c66-a972-4ec97fdee970', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('23769494-64fd-49c5-9002-b9abd583dbb1', 'ARCSHHJVY092024', 'App\\Models\\StudentCertificate', '87972b6d-8aec-4336-8970-123b666f2dd4', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('26591736-9df5-4756-9d65-6bbc7ec757f4', 'ARCZBLQAC092024', 'App\\Models\\StudentCertificate', 'e3a1d21d-611e-40c1-baed-9899f5191cd3', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('3a5e26a2-e592-45c1-8195-d48296702995', 'ARCZLDZDZ092024', 'App\\Models\\SchoolDocument', 'd69f8a41-4dc1-4b90-9ae8-01400a9b4b0d', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('3b272830-a9ca-475a-8cf9-50812c214c0b', 'ARCJL5WUO092024', 'App\\Models\\StudentCertificate', '4dfadd65-ef7b-4513-ba97-fa880c4a5922', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('48513000-0f4e-42cb-92e3-7ec5cb9d87c9', 'ARCWZG7DY092024', 'App\\Models\\StudentCertificate', '57e6e3bd-1b7e-406d-b7f5-7838f24f8428', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('4f9c2772-319d-494d-ae14-946e0a07a8e5', 'ARCEFENHQ092024', 'App\\Models\\SchoolDocument', 'ce153ac2-2535-4242-9913-cc9bd52b902f', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('624b5458-a5d3-4fdb-b4f5-7632a8ae15cd', 'ARCD5KLLB092024', 'App\\Models\\SchoolDocument', 'c9ad5d0c-5c14-432e-82e1-91171b306773', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('66bb4800-3d56-4b9a-8a2f-ef5fbe087da8', 'ARC2SEHHC092024', 'App\\Models\\StudentCertificate', '44ed2189-dded-4efb-98ad-3fc695c52d9b', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('8ddcbfe9-b708-4588-a2a6-6158072ca34d', 'ARCHECOML092024', 'App\\Models\\StudentCertificate', '576da1fd-0949-4a13-b151-e94ae97a0923', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('b2b14e2c-7916-4fcb-9450-b37f9540188d', 'ARC3LYS3C092024', 'App\\Models\\StudentCertificate', '20f54120-616f-4298-b0b1-915cfefea7e1', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('d215ae23-3de4-444d-b2e3-4bc79b888cab', 'ARCYLSY9A092024', 'App\\Models\\SchoolDocument', '41dde57a-5220-4d27-b2dc-50e1daae7237', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('ecb3d741-9909-4628-9b12-59140288a04a', 'ARCRWHAVC092024', 'App\\Models\\StudentCertificate', '20f6a8f2-481f-45c3-9d74-ab642eab431a', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incoming_letters`
--

CREATE TABLE `incoming_letters` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incoming_letter_category_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter_number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regarding` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `file` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incoming_letters`
--

INSERT INTO `incoming_letters` (`id`, `incoming_letter_category_id`, `letter_number`, `regarding`, `attachment`, `from`, `to`, `date`, `file`, `created_at`, `updated_at`) VALUES
('19f4220c-209c-418f-9f2d-c24ee61ec9f2', '8b5a9c13-e7d8-4a64-9124-cde1c6beb4a4', '421.2/UNARS/SU/2022/V', 'Undangan Perpisahan', '-', 'SDN 1 Keruwing Raya', 'Kepala E-SURAT', '2022-01-04', 'incoming-letters/1.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `incoming_letter_categories`
--

CREATE TABLE `incoming_letter_categories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incoming_letter_categories`
--

INSERT INTO `incoming_letter_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
('0946b4b9-a4db-4c7f-98fc-ba87e5196371', 'Surat Peminjaman', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('17e4a24a-3700-4ebe-8b7d-48de6ecc2578', 'Surat Pemberitahuan', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('8b5a9c13-e7d8-4a64-9124-cde1c6beb4a4', 'Surat Undangan', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `incoming_letter_dispositions`
--

CREATE TABLE `incoming_letter_dispositions` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incoming_letter_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incoming_letter_dispositions`
--

INSERT INTO `incoming_letter_dispositions` (`id`, `incoming_letter_id`, `to`, `type`, `message`, `created_at`, `updated_at`) VALUES
('eb54c10c-4a16-43dc-9ab8-5612cce7c93e', '19f4220c-209c-418f-9f2d-c24ee61ec9f2', 'Tata Usaha Bagian Humas', 'Biasa', 'Segera proses surat yang masuk.', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `leave_permit_letters`
--

CREATE TABLE `leave_permit_letters` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regarding` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_permit_letters`
--

INSERT INTO `leave_permit_letters` (`id`, `user_id`, `regarding`, `attachment`, `reason`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
('302f6fbf-8100-419d-a2a1-728d891786ab', 'de968802-9ca9-4640-b140-79db3a9df4c8', 'Izin Cuti', '-', 'Menghabiskan sisa jatah cuti', '2024-09-12', '2024-09-17', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('754501a8-16e3-4149-8531-94df710e3078', 'd0ce4a08-02a3-4414-874d-a828e53d77db', 'Izin Cuti', '-', 'Menghabiskan sisa jatah cuti', '2024-09-12', '2024-09-17', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('a838dbfd-79d6-4a23-92ce-57658a0b4e86', '50ccc8ce-e408-494d-bfc5-89f84e556c16', 'Izin Cuti', '-', 'Menghabiskan sisa jatah cuti', '2024-09-12', '2024-09-17', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('ab83ce86-f6dc-481b-a2d9-ad8c9ee3e54f', 'f402c4b5-ac82-439c-9b95-5378458c12ab', 'Izin Cuti', '-', 'Menghabiskan sisa jatah cuti', '2024-09-12', '2024-09-17', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

CREATE TABLE `letters` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `letterable_type` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `letterable_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` int DEFAULT NULL,
  `letter_number` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('Menunggu Verifikasi','Diverifikasi','Ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Verifikasi',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `letters`
--

INSERT INTO `letters` (`id`, `letterable_type`, `letterable_id`, `serial_number`, `letter_number`, `verified`, `status`, `note`, `created_at`, `updated_at`) VALUES
('12795380-e847-4507-9002-29e0d6c30629', 'App\\Models\\LeavePermitLetter', '754501a8-16e3-4149-8531-94df710e3078', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('1a71f9e4-902a-4372-996e-e725c952721e', 'App\\Models\\SchoolTransferLetter', '93b79eae-cd67-4ab1-85b1-d1a382f2d162', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('1e1448ed-7a0d-424c-9f38-939634f8297e', 'App\\Models\\SchoolTransferLetter', '165590d2-77c0-4547-8484-1c814d895906', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('2368596b-ca1c-4a6a-b212-dcc7d7572282', 'App\\Models\\LeavePermitLetter', 'a838dbfd-79d6-4a23-92ce-57658a0b4e86', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('2a7f3aba-baaa-4a92-9a95-1b1171fe547e', 'App\\Models\\ActiveStudentLetter', 'ca6b1258-0221-4288-a538-5db88d36f1dc', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('2ab911bc-f3d1-4409-bbfb-01fc5723f018', 'App\\Models\\LeavePermitLetter', '302f6fbf-8100-419d-a2a1-728d891786ab', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('3d36ff5a-98ea-436f-988e-4b4004e2a5d2', 'App\\Models\\ActiveStudentLetter', '88409a40-7d73-421a-b2e2-fe7672eadeac', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('44789c09-baae-43b0-88f3-d58060c94c78', 'App\\Models\\SchoolTransferLetter', '78395c51-37c2-48d4-8faf-27d99c087b69', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('5294b23e-9861-4533-b504-0cb0df79a54b', 'App\\Models\\SppdLetter', '02f5b061-9702-4177-b15a-621706df80ba', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('5477ea28-5453-4734-a838-7c095b69f7f8', 'App\\Models\\ActiveStudentLetter', '40ecfcf2-748a-412a-8478-f3b26677dd2f', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('5d868d8a-8c9d-47d0-ae54-71e84cc0f05e', 'App\\Models\\SppdLetter', '0b42b180-3773-4dab-adee-03f442ae5edb', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('7d969a43-665b-4ea9-b679-abb10f7d5979', 'App\\Models\\SchoolTransferLetter', 'dc941b27-6f83-49f8-95f1-de6c0d5debe5', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('8570f981-8c74-4b18-9d32-a4f1d1078838', 'App\\Models\\SchoolTransferLetter', '5540519d-dbb2-4c00-9a7e-12e680eebea4', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('88acde8b-4dbd-4d52-b103-786c31c2c5e7', 'App\\Models\\LeavePermitLetter', 'ab83ce86-f6dc-481b-a2d9-ad8c9ee3e54f', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('8a33063e-db2d-4e6a-9d44-290945488ede', 'App\\Models\\SchoolTransferLetter', 'f02fbe81-58b5-4db1-b572-7726f7fb6478', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('8c9616dd-036d-474e-83e9-fc37398c4b6b', 'App\\Models\\ActiveStudentLetter', 'fa489926-4784-4750-af28-082531b7eee0', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('9de4b33f-187f-4b4b-9e8d-2db27ed44476', 'App\\Models\\SchoolTransferLetter', 'd4564801-ac89-4331-9dd3-0e51459eb30c', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('a4bee8de-05c9-4c21-b75d-9d648f06ae08', 'App\\Models\\SchoolTransferLetter', '41147d6b-8af5-4134-ae79-d72bf92b4448', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('a5695298-8f14-4da8-b95b-a7630502a4b8', 'App\\Models\\SchoolTransferLetter', '32d8a251-4a97-4903-b197-ae3904edba4c', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('b9798883-b7f2-499c-a859-2a07b2a4ed7d', 'App\\Models\\ActiveStudentLetter', '0c8a34d0-a498-4fd9-83e2-0501c6a53c09', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('bc67f0e3-e012-43d1-89f2-b6d5a341ab12', 'App\\Models\\SppdLetter', '5cc0b155-962d-46e7-be5f-ce344ebe16eb', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('cd51e5a6-055b-4c43-8a24-71fbe8c64ff4', 'App\\Models\\SchoolTransferLetter', '56af00a4-f2f3-4111-a94a-d6d34ccff47b', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('cff5d063-4dcd-4dce-bad8-1d9fa484994a', 'App\\Models\\ActiveStudentLetter', '64140391-8da2-4b31-a37c-cbf59550462a', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('e56e237d-c439-4b4a-8094-47e0b4528e73', 'App\\Models\\ActiveStudentLetter', '00ff3db3-03bc-492f-bd23-607186b0151d', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('ec68871b-402b-48a6-a2a8-3bf833142276', 'App\\Models\\ActiveStudentLetter', 'c0d82aaf-e2fe-4225-8b8d-71c3e2682af9', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('f7a5cb7a-1d92-4830-b537-16b55e597dd1', 'App\\Models\\ActiveStudentLetter', 'a8a3a43f-6ba4-4da5-bfa9-9d7ab45738b2', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('fee82019-d627-4e9c-9754-9d2749cd0878', 'App\\Models\\ActiveStudentLetter', 'edc838bf-5824-44d7-94be-4aecf4a72c5f', NULL, NULL, 0, 'Menunggu Verifikasi', 'Surat telah dibuat dan menunggu untuk diverifikasi', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(23, '2024_09_11_233623_create_pindah_prodi_tablert', 2),
(24, '2014_10_12_000000_create_users_table', 3),
(25, '2014_10_12_100000_create_password_resets_table', 3),
(26, '2019_08_19_000000_create_failed_jobs_table', 3),
(27, '2019_12_14_000001_create_personal_access_tokens_table', 3),
(28, '2022_05_31_120944_create_positions_table', 3),
(29, '2022_05_31_171431_create_notifications_table', 3),
(30, '2022_06_02_020755_create_incoming_letter_categories_table', 3),
(31, '2022_06_02_021128_create_incoming_letters_table', 3),
(32, '2022_06_02_132724_create_incoming_letter_dispositions_table', 3),
(33, '2022_06_04_042650_create_students_table', 3),
(34, '2022_06_04_114728_create_active_student_letters_table', 3),
(35, '2022_06_04_135100_create_student_certificates_table', 3),
(36, '2022_06_05_003038_create_school_documents_table', 3),
(37, '2022_06_05_100718_create_letters_table', 3),
(38, '2022_06_06_101455_create_signatures_table', 3),
(39, '2022_06_06_191344_create_school_transfer_letters_table', 3),
(40, '2022_06_07_115055_create_sppd_letters_table', 3),
(41, '2022_06_07_171821_create_sppd_letter_recipients_table', 3),
(42, '2022_06_07_223339_create_leave_permit_letters_table', 3),
(43, '2022_07_09_023245_create_activities_table', 3),
(44, '2022_08_04_210458_create_archives_table', 3),
(45, '2024_09_11_233420_create_pindah_prodi_table', 3),
(46, '2024_09_12_002100_create_sessions_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pindah_prodi`
--

CREATE TABLE `pindah_prodi` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_prodi` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pindah_prodi`
--

INSERT INTO `pindah_prodi` (`id`, `student_id`, `new_prodi`, `reason`, `created_at`, `updated_at`) VALUES
('f4552deb-7064-11ef-baaa-04d4c47bc510', 'a8e33f14-5197-458c-83c8-b371bf1e8da5', 'SDN 2 Bumi Indah', 'Mengikuti lokasi orang tua bekerja', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `created_at`, `updated_at`) VALUES
('46025654-840f-4765-8adc-7c7e50b880c7', 'Super Admin E-SURAT', '2024-09-11 17:36:11', '2024-09-11 17:36:11'),
('7e2a64c8-6a0e-4b73-afc6-997b31bb7b99', 'Admin E-SURAT', '2024-09-11 17:36:11', '2024-09-11 17:36:11'),
('b26b9403-6b8e-47d7-a512-9d71cd38ea1a', 'Biro E-SURAT', '2024-09-11 17:36:11', '2024-09-11 17:36:11'),
('e71819e1-86f5-4e50-8553-5901605e7a84', 'Rektor E-SURAT', '2024-09-11 17:36:11', '2024-09-11 17:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `school_documents`
--

CREATE TABLE `school_documents` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_documents`
--

INSERT INTO `school_documents` (`id`, `user_id`, `name`, `date`, `number`, `description`, `file`, `created_at`, `updated_at`) VALUES
('41dde57a-5220-4d27-b2dc-50e1daae7237', '50ccc8ce-e408-494d-bfc5-89f84e556c16', 'Sertifikat Lahan Sekolah', '2021-10-22', 'NO. 145-1/2021/X', 'Salinan sertifikat lahan sekolah', 'school-documents/2.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('7f5c5a9e-ad0c-4d9b-927e-f3f77c38db8b', '50ccc8ce-e408-494d-bfc5-89f84e556c16', 'SK Kepala Sekolah', '2022-03-12', 'NO. 862-7/2022/III', 'Salinan SK kepala sekolah', 'school-documents/4.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('c9ad5d0c-5c14-432e-82e1-91171b306773', '50ccc8ce-e408-494d-bfc5-89f84e556c16', 'Sertifikat Lahan Sekolah', '2015-07-14', 'NO. 026/BAN-PT/2015/VII', 'Salinan sertifikat akreditasi sekolah tahun 2015', 'school-documents/3.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('ce153ac2-2535-4242-9913-cc9bd52b902f', '50ccc8ce-e408-494d-bfc5-89f84e556c16', 'Akta Sekolah', '2013-11-08', 'NO. 255-3/2013/XI', 'Salinan akta sekolah', 'school-documents/5.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('d69f8a41-4dc1-4b90-9ae8-01400a9b4b0d', '50ccc8ce-e408-494d-bfc5-89f84e556c16', 'Sertifikat Akreditasi Sekolah 2020', '2020-05-14', 'NO. 825/BAN-PT/2020/V', 'Salinan sertifikat akreditasi sekolah 2020', 'school-documents/1.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `school_transfer_letters`
--

CREATE TABLE `school_transfer_letters` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_school` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_transfer_letters`
--

INSERT INTO `school_transfer_letters` (`id`, `student_id`, `new_school`, `reason`, `created_at`, `updated_at`) VALUES
('165590d2-77c0-4547-8484-1c814d895906', 'a8e33f14-5197-458c-83c8-b371bf1e8da5', 'SDN 2 Bumi Indah', 'Mengikuti lokasi orang tua bekerja', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('32d8a251-4a97-4903-b197-ae3904edba4c', '54f9d1e1-97fc-40e1-bcf4-8c3acc083075', 'SDN 2 Bumi Indah', 'Mengikuti lokasi orang tua bekerja', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('41147d6b-8af5-4134-ae79-d72bf92b4448', '3971c3b5-3716-4178-bd35-cf2a3e23ab64', 'SDN 2 Bumi Indah', 'Mengikuti lokasi orang tua bekerja', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('5540519d-dbb2-4c00-9a7e-12e680eebea4', '98ee7e57-87ab-4080-91c8-0193467dde3b', 'SDN 2 Bumi Indah', 'Mengikuti lokasi orang tua bekerja', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('56af00a4-f2f3-4111-a94a-d6d34ccff47b', 'b1de470b-d9d2-4876-b855-3f82c9bcafbe', 'SDN 2 Bumi Indah', 'Mengikuti lokasi orang tua bekerja', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('78395c51-37c2-48d4-8faf-27d99c087b69', '983c6097-ec29-416d-9ab5-64ece6ec3f90', 'SDN 2 Bumi Indah', 'Mengikuti lokasi orang tua bekerja', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('93b79eae-cd67-4ab1-85b1-d1a382f2d162', '07ab9483-3ccf-4afa-ac68-6bdc84b9689f', 'SDN 2 Bumi Indah', 'Mengikuti lokasi orang tua bekerja', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('d4564801-ac89-4331-9dd3-0e51459eb30c', '26884778-6610-4b51-8d3b-0a12c9098843', 'SDN 2 Bumi Indah', 'Mengikuti lokasi orang tua bekerja', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('dc941b27-6f83-49f8-95f1-de6c0d5debe5', '13d4520b-a4c2-42c7-afb5-775691b56df4', 'SDN 2 Bumi Indah', 'Mengikuti lokasi orang tua bekerja', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('f02fbe81-58b5-4db1-b572-7726f7fb6478', '5b32c2a5-83c1-4024-a2af-05d738f6041c', 'SDN 2 Bumi Indah', 'Mengikuti lokasi orang tua bekerja', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signatures`
--

CREATE TABLE `signatures` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signaturable_type` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signaturable_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signatures`
--

INSERT INTO `signatures` (`id`, `signaturable_type`, `signaturable_id`, `payload`, `created_at`, `updated_at`) VALUES
('2353df38-bd6d-4b54-9ddb-4e71951a1f4b', 'App\\Models\\IncomingLetterDisposition', 'eb54c10c-4a16-43dc-9ab8-5612cce7c93e', '{\"signer\": {\"nip\": \"19670505 198804 1 002\", \"name\": \"Surya\", \"position\": \"Rektor E-SURAT\", \"signed_at\": \"Kamis 12 September 2024\"}, \"details\": {\"Tipe\": \"Disposisi Surat\", \"Nomor Surat\": \"421.2/UNARS/SU/2022/V\"}}', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `sppd_letters`
--

CREATE TABLE `sppd_letters` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sppd_letters`
--

INSERT INTO `sppd_letters` (`id`, `from_user_id`, `destination`, `purpose`, `budget`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
('02f5b061-9702-4177-b15a-621706df80ba', 'de968802-9ca9-4640-b140-79db3a9df4c8', 'SDN 3 Barito Kuala', 'Menjalin hubungan antara sekolah', '2000000', '2024-09-12', '2024-09-17', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('0b42b180-3773-4dab-adee-03f442ae5edb', 'de968802-9ca9-4640-b140-79db3a9df4c8', 'SDN 2 Barito Kuala', 'Menjalin hubungan antara sekolah', '2000000', '2024-09-12', '2024-09-17', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('5cc0b155-962d-46e7-be5f-ce344ebe16eb', 'de968802-9ca9-4640-b140-79db3a9df4c8', 'SDN 1 Barito Kuala', 'Menjalin hubungan antara sekolah', '2000000', '2024-09-12', '2024-09-17', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `sppd_letter_recipients`
--

CREATE TABLE `sppd_letter_recipients` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sppd_letter_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sppd_letter_recipients`
--

INSERT INTO `sppd_letter_recipients` (`id`, `sppd_letter_id`, `user_id`, `created_at`, `updated_at`) VALUES
('22e694f7-59c5-4fa6-8c9a-5a98f1ba3700', '0b42b180-3773-4dab-adee-03f442ae5edb', 'd0ce4a08-02a3-4414-874d-a828e53d77db', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('2866cf16-bc77-4343-9690-c03a2e4a6ac8', '62e44272-68e6-40b4-8727-0b9e4fcd67bd', '1a71eec4-898e-4f2b-85e6-bfeae1e65879', '2024-09-11 17:07:42', '2024-09-11 17:07:42'),
('36fbfa07-59cb-4b06-8602-70c9d6c38598', '0ad9a8d1-c970-48b1-ad77-6136f065ffb7', 'ffef0bbb-4117-4e4c-896a-e9d46258ad18', '2024-09-11 17:00:04', '2024-09-11 17:00:04'),
('51bb13b0-17d6-4f48-aaa4-bfbae7d3a58b', '5307dad7-f8c6-4ca4-9606-75c999ea65d6', 'e10b6357-b074-4474-b1d1-58338c59ef15', '2024-09-11 17:25:03', '2024-09-11 17:25:03'),
('57723436-d910-49e3-a39d-dffe35ee6738', 'deff169d-06f8-4d0f-b80e-7c2088f8bc80', '8cd2db0c-18ba-4194-8846-4fe77176d7b9', '2024-09-11 17:14:05', '2024-09-11 17:14:05'),
('632de19f-2489-43ab-ad2e-1b0774f69d26', '9242849f-a516-4d22-abce-57f5915cbdae', 'c8671600-71a4-4bd3-92ba-ea1c976a02af', '2024-09-11 17:14:05', '2024-09-11 17:14:05'),
('6ae2ce85-9116-4ace-9d02-e24df8b3d498', '6fcd13be-24bb-473f-a6fe-45df9b45c4c4', '1455e192-1c8f-494a-9d31-870ecc0198bc', '2024-09-11 17:25:03', '2024-09-11 17:25:03'),
('6c97e0fa-c48b-47d7-865a-4c0430185dca', '7e920630-ba61-46a1-84fb-e88bacbd5c56', 'e262ffc9-b5b8-4573-bb6e-d1aaeaca1079', '2024-09-11 17:07:42', '2024-09-11 17:07:42'),
('8f02cb77-5dec-4c49-86bd-073c9a0a95cc', 'd203b3e6-ccfc-45b7-91ec-8d4a2b3aa92a', '79dfd758-2296-40e0-9e36-2558a6703a84', '2024-09-11 17:29:15', '2024-09-11 17:29:15'),
('96108d6e-0b0c-4690-96d7-2cd26b204697', 'ba54c37d-3d68-49b2-9d7f-250977215c0a', '876389af-2e85-4d2b-a72a-e6d5119998d3', '2024-09-11 17:29:15', '2024-09-11 17:29:15'),
('a0844383-58cc-46a0-8a08-a18cbe1f3373', '016c95f3-c7fa-4b1a-8287-83aff8d5d65b', '97fd8b92-5ef2-4ad9-ba73-5c320a106aa9', '2024-09-11 17:00:04', '2024-09-11 17:00:04'),
('afef070d-0f37-45ba-9bb1-5aa9eb1f4736', '79dc20d8-6467-4797-a81e-b34d2c699a6d', 'f9e6688e-ad97-4d03-abb4-fbc146a72b99', '2024-09-11 17:29:15', '2024-09-11 17:29:15'),
('b2631cec-ffc1-4cf9-b47f-39af721b90c2', 'fa31817c-f85b-49fc-8f3b-6ff4c1b55312', '66ae868d-7ce6-4379-b50d-4f0858c75045', '2024-09-11 17:00:04', '2024-09-11 17:00:04'),
('c381c612-10ea-40e0-86df-700b4c249367', '2424cbf3-0924-4283-8492-a1f63e861af6', 'd258f9d9-3507-4042-a552-11df5422d8bf', '2024-09-11 17:14:05', '2024-09-11 17:14:05'),
('c7f92ba9-85c3-4871-acfb-a629b1296cc1', '5cc0b155-962d-46e7-be5f-ce344ebe16eb', '50ccc8ce-e408-494d-bfc5-89f84e556c16', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('d155139a-2cf6-4729-8d79-ced5f1fd5daf', 'fa2241d9-6469-473f-b20f-e6743322f0ad', '0b41b0a6-ab2f-4582-84db-f8169010b897', '2024-09-11 17:25:03', '2024-09-11 17:25:03'),
('eacdddcc-0bb1-454e-b298-56eea91bfd0a', 'f3a22d80-3f74-49f7-834b-936026a396ba', 'd805e4ef-e2b3-4642-b592-14931feb6fd1', '2024-09-11 17:07:42', '2024-09-11 17:07:42'),
('ee6111ad-542f-4893-b6d5-9ed767263790', '02f5b061-9702-4177-b15a-621706df80ba', 'f402c4b5-ac82-439c-9b95-5378458c12ab', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_bird` date NOT NULL,
  `gender` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `father` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `student_number`, `date_of_bird`, `gender`, `address`, `father`, `mother`, `guardian`, `created_at`, `updated_at`) VALUES
('07ab9483-3ccf-4afa-ac68-6bdc84b9689f', 'Luthfi Gunawan', '8884099663', '2010-03-13', 'Laki-laki', 'Gg. Kyai Mojo No. 256, Tanjung Pinang 30051, DIY', 'Dipa Tampubolon', 'Fitriani Puspita S.Psi', 'Karya Tampubolon', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('13d4520b-a4c2-42c7-afb5-775691b56df4', 'Dipa Habibi', '8427555759', '2010-02-03', 'Laki-laki', 'Ds. Ekonomi No. 169, Tegal 66613, Sumut', 'Gambira Maryadi', 'Mutia Aisyah Riyanti', 'Rika Rahimah', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('26884778-6610-4b51-8d3b-0a12c9098843', 'Ika Purnawati', '1029524772', '2010-04-12', 'Perempuan', 'Ki. Bah Jaya No. 442, Cilegon 73709, NTB', 'Daliono Prayitna Kurniawan M.M.', 'Usyi Rahmawati', 'Indah Wijayanti', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('3971c3b5-3716-4178-bd35-cf2a3e23ab64', 'Zalindra Usada', '3049489603', '2010-04-12', 'Perempuan', 'Jr. Karel S. Tubun No. 615, Administrasi Jakarta Barat 62613, Kalbar', 'Hari Thamrin', 'Gawati Hilda Suartini', 'Karimah Agustina', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('54f9d1e1-97fc-40e1-bcf4-8c3acc083075', 'Ika Alika Utami', '8568027074', '2010-06-29', 'Perempuan', 'Kpg. HOS. Cjokroaminoto (Pasirkaliki) No. 311, Denpasar 56923, DIY', 'Bakijan Pranawa Irawan', 'Suci Ira Puspita S.Kom', 'Ibun Pradipta', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('5b32c2a5-83c1-4024-a2af-05d738f6041c', 'Diana Pia Usada', '5580205697', '2010-03-13', 'Perempuan', 'Dk. Bakin No. 643, Jambi 55414, Sumbar', 'Timbul Lasmono Salahudin S.E.', 'Zizi Usada', 'Clara Oktaviani', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('983c6097-ec29-416d-9ab5-64ece6ec3f90', 'Malik Uwais', '9796974977', '2010-08-09', 'Laki-laki', 'Ds. Bakin No. 680, Medan 96539, NTB', 'Cahyanto Santoso', 'Ciaobella Lalita Wahyuni', 'Labuh Maryadi S.IP', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('98ee7e57-87ab-4080-91c8-0193467dde3b', 'Enteng Luhung Najmudin', '9114726969', '2010-11-11', 'Laki-laki', 'Dk. Orang No. 414, Lubuklinggau 51355, Sulbar', 'Adinata Hartaka Maulana', 'Zulaikha Puspasari M.Ak', 'Ozy Martaka Utama', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('a8e33f14-5197-458c-83c8-b371bf1e8da5', 'Michelle Victoria Usamah', '2933379134', '2010-02-02', 'Perempuan', 'Jln. Siliwangi No. 697, Yogyakarta 77586, Banten', 'Bagas Kuswoyo', 'Clara Yolanda', 'Suci Maryati', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('b1de470b-d9d2-4876-b855-3f82c9bcafbe', 'Arsipatra Koko Situmorang', '9853198575', '2010-11-16', 'Laki-laki', 'Gg. Labu No. 678, Kediri 27194, Sumut', 'Danuja Hakim S.E.I', 'Nabila Aryani', 'Nabila Astuti S.H.', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `student_certificates`
--

CREATE TABLE `student_certificates` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `academic_year` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_certificates`
--

INSERT INTO `student_certificates` (`id`, `student_id`, `number`, `date`, `academic_year`, `file`, `created_at`, `updated_at`) VALUES
('20f54120-616f-4298-b0b1-915cfefea7e1', '07ab9483-3ccf-4afa-ac68-6bdc84b9689f', 'DN-15 D 7658341', '2024-08-16', '2023/2024', 'student-certificates/07ab9483-3ccf-4afa-ac68-6bdc84b9689f.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('20f6a8f2-481f-45c3-9d74-ab642eab431a', '13d4520b-a4c2-42c7-afb5-775691b56df4', 'DN-15 D 6482221', '2016-11-25', '2023/2024', 'student-certificates/13d4520b-a4c2-42c7-afb5-775691b56df4.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('44ed2189-dded-4efb-98ad-3fc695c52d9b', '983c6097-ec29-416d-9ab5-64ece6ec3f90', 'DN-15 D 8645326', '1984-10-03', '2023/2024', 'student-certificates/983c6097-ec29-416d-9ab5-64ece6ec3f90.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('4dfadd65-ef7b-4513-ba97-fa880c4a5922', '3971c3b5-3716-4178-bd35-cf2a3e23ab64', 'DN-15 D 8024101', '2008-01-07', '2023/2024', 'student-certificates/3971c3b5-3716-4178-bd35-cf2a3e23ab64.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('576da1fd-0949-4a13-b151-e94ae97a0923', 'a8e33f14-5197-458c-83c8-b371bf1e8da5', 'DN-15 D 1068753', '1996-03-23', '2023/2024', 'student-certificates/a8e33f14-5197-458c-83c8-b371bf1e8da5.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('57e6e3bd-1b7e-406d-b7f5-7838f24f8428', '5b32c2a5-83c1-4024-a2af-05d738f6041c', 'DN-15 D 6773280', '1986-06-18', '2023/2024', 'student-certificates/5b32c2a5-83c1-4024-a2af-05d738f6041c.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('87972b6d-8aec-4336-8970-123b666f2dd4', '54f9d1e1-97fc-40e1-bcf4-8c3acc083075', 'DN-15 D 3220832', '1988-09-24', '2023/2024', 'student-certificates/54f9d1e1-97fc-40e1-bcf4-8c3acc083075.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('9926be49-1a05-4c66-a972-4ec97fdee970', '26884778-6610-4b51-8d3b-0a12c9098843', 'DN-15 D 7360978', '1996-10-23', '2023/2024', 'student-certificates/26884778-6610-4b51-8d3b-0a12c9098843.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('d12a01ae-5ac9-4952-b7a6-1dee59f82393', '98ee7e57-87ab-4080-91c8-0193467dde3b', 'DN-15 D 6284176', '1975-02-01', '2023/2024', 'student-certificates/98ee7e57-87ab-4080-91c8-0193467dde3b.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('e3a1d21d-611e-40c1-baed-9899f5191cd3', 'b1de470b-d9d2-4876-b855-3f82c9bcafbe', 'DN-15 D 9567856', '1996-04-26', '2023/2024', 'student-certificates/b1de470b-d9d2-4876-b855-3f82c9bcafbe.pdf', '2024-09-11 17:36:12', '2024-09-11 17:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `role` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_bird` date DEFAULT NULL,
  `gender` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `position_id`, `email`, `email_verified_at`, `password`, `is_active`, `role`, `name`, `nip`, `date_of_bird`, `gender`, `address`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
('50ccc8ce-e408-494d-bfc5-89f84e556c16', 'b26b9403-6b8e-47d7-a512-9d71cd38ea1a', 'biro@gmail.com', NULL, '$2y$10$0TzsdatPJA2HaO4RJu66fuNLi5./gy8ljlthiGkjjh87pWWoiRbLW', 1, 'Biro', 'Pio', '20000420 201505 1 007', '2000-04-20', 'Laki-laki', 'Situbondo', NULL, NULL, '2024-09-11 17:36:11', '2024-09-11 17:36:11'),
('d0ce4a08-02a3-4414-874d-a828e53d77db', '46025654-840f-4765-8adc-7c7e50b880c7', 'superadmin@gmail.com', NULL, '$2y$10$dBFZGW3AviPxw244.G2HeOXZUYrTrHjUn73eRzZN/ANJ8jrOHc.4W', 1, 'Super Admin ', 'Pico', '20000704 201505 1 006', '2000-07-04', 'Laki-laki', 'Situbondo', NULL, NULL, '2024-09-11 17:36:11', '2024-09-11 17:36:11'),
('de968802-9ca9-4640-b140-79db3a9df4c8', 'e71819e1-86f5-4e50-8553-5901605e7a84', 'rektor@gmail.com', NULL, '$2y$10$pyPrlQ/hgLEwqWqjdrGzR.Hl2XF7JJa5M2SF0ObPC13OJenNE0h4a', 1, 'Rektor', 'Surya', '19670505 198804 1 002', '2001-11-09', 'Laki-laki', 'Situbondo', NULL, NULL, '2024-09-11 17:36:12', '2024-09-11 17:36:12'),
('f402c4b5-ac82-439c-9b95-5378458c12ab', '7e2a64c8-6a0e-4b73-afc6-997b31bb7b99', 'admin@gmail.com', NULL, '$2y$10$0Rs3YS1ZP758Tnw5DHtKZ.xYNakyZy4Dms.rQCy8r46HjeqXRz0Oi', 1, 'Admin', 'Andra ', '19730926 201505 1 009', '1973-09-26', 'Laki-laki', 'Situbondo', NULL, NULL, '2024-09-11 17:36:11', '2024-09-11 17:36:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_student_letters`
--
ALTER TABLE `active_student_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archives_archivable_type_archivable_id_index` (`archivable_type`,`archivable_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `incoming_letters`
--
ALTER TABLE `incoming_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incoming_letter_categories`
--
ALTER TABLE `incoming_letter_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incoming_letter_dispositions`
--
ALTER TABLE `incoming_letter_dispositions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_permit_letters`
--
ALTER TABLE `leave_permit_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `letters_letterable_type_letterable_id_index` (`letterable_type`,`letterable_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Indexes for table `pindah_prodi`
--
ALTER TABLE `pindah_prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_documents`
--
ALTER TABLE `school_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_transfer_letters`
--
ALTER TABLE `school_transfer_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `signatures_signaturable_type_signaturable_id_index` (`signaturable_type`,`signaturable_id`);

--
-- Indexes for table `sppd_letters`
--
ALTER TABLE `sppd_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sppd_letter_recipients`
--
ALTER TABLE `sppd_letter_recipients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_certificates`
--
ALTER TABLE `student_certificates`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
