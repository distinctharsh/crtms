-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for tms-laravel
CREATE DATABASE IF NOT EXISTS `tms-laravel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `tms-laravel`;

-- Dumping structure for table tms-laravel.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.cache: ~0 rows (approximately)

-- Dumping structure for table tms-laravel.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.cache_locks: ~0 rows (approximately)

-- Dumping structure for table tms-laravel.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `complaint_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_complaint_id_foreign` (`complaint_id`),
  KEY `comments_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_complaint_id_foreign` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.comments: ~32 rows (approximately)
INSERT INTO `comments` (`id`, `complaint_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
	(1, 17, 1, 'Hey', '2025-06-20 05:15:20', '2025-06-20 05:15:20'),
	(2, 17, 1, 'I am assigning you, could you prefer time when you will be able to fix this issue?', '2025-06-20 05:17:54', '2025-06-20 05:17:54'),
	(3, 17, 7, 'Sir, I will completely solve it approx 4 PM', '2025-06-20 05:19:18', '2025-06-20 05:19:18'),
	(4, 12, 7, 'Sir, can I handle this ?', '2025-06-20 05:25:13', '2025-06-20 05:25:13'),
	(5, 12, 2, 'Go ahead. Let me know if you face any issues.', '2025-06-20 05:28:53', '2025-06-20 05:28:53'),
	(10, 21, 6, 'ok i will handle this...', '2025-06-27 08:10:03', '2025-06-27 08:10:03'),
	(11, 21, 6, 'some details are missing by user', '2025-06-27 08:07:00', '2025-06-27 08:07:00'),
	(12, 21, 6, 's', '2025-06-27 08:16:02', '2025-06-27 08:16:02'),
	(13, 21, 6, 'cc', '2025-06-27 08:16:15', '2025-06-27 08:16:15'),
	(14, 21, 6, 'dd', '2025-06-27 08:16:25', '2025-06-27 08:16:25'),
	(15, 21, 6, 'yes it is done', '2025-06-27 08:22:01', '2025-06-27 08:22:01'),
	(16, 21, 6, 'ok i will check', '2025-06-27 08:42:32', '2025-06-27 08:42:32'),
	(17, 22, 4, 'tuktu tuku', '2025-06-28 08:19:34', '2025-06-28 08:19:34'),
	(18, 22, 4, 'ytttjky ghhhmh', '2025-06-28 08:19:52', '2025-06-28 08:19:52'),
	(19, 22, 4, 'fhmfh fhnfh', '2025-06-28 08:20:11', '2025-06-28 08:20:11'),
	(20, 22, 4, 'rh fhg dfh dfh dfb dhb', '2025-06-28 08:24:22', '2025-06-28 08:24:22'),
	(21, 23, 4, 'checking sir', '2025-06-30 05:03:20', '2025-06-30 05:03:20'),
	(22, 23, 2, 'is it completed?', '2025-06-30 05:04:27', '2025-06-30 05:04:27'),
	(23, 23, 4, 'yes sir completed. cable was faulty. cable changed.', '2025-06-30 05:05:39', '2025-06-30 05:05:39'),
	(24, 19, 5, 'yes its completed', '2025-06-30 05:52:19', '2025-06-30 05:52:19'),
	(25, 24, 3, 'ok i will check', '2025-06-30 09:47:19', '2025-06-30 09:47:19'),
	(26, 24, 5, 'its done', '2025-06-30 09:51:38', '2025-06-30 09:51:38'),
	(27, 30, 10, 'Server is restart.', '2025-07-01 06:59:38', '2025-07-01 06:59:38'),
	(28, 30, 1, 'ok after server on check once the call to the user.', '2025-07-01 07:00:44', '2025-07-01 07:00:44'),
	(29, 30, 10, 'Sir, I am another call shyam is inform to the section.', '2025-07-01 07:16:25', '2025-07-01 07:16:25'),
	(30, 30, 6, 'Sir, Inform to the section it can be open.', '2025-07-01 07:20:25', '2025-07-01 07:20:25'),
	(31, 30, 10, 'No sir, all problem is resolve you can closed the issue.', '2025-07-01 07:24:13', '2025-07-01 07:24:13'),
	(32, 33, 11, 'It is not registered in Pehchan account and also email to the email division', '2025-07-02 05:07:04', '2025-07-02 05:07:04'),
	(33, 37, 7, 'ok i will handle', '2025-07-02 11:26:10', '2025-07-02 11:26:10'),
	(34, 37, 2, 'ok', '2025-07-02 11:26:46', '2025-07-02 11:26:46'),
	(35, 37, 2, 'On priority', '2025-07-02 11:26:58', '2025-07-02 11:26:58'),
	(36, 37, 7, 'its done', '2025-07-02 11:32:48', '2025-07-02 11:32:48');

-- Dumping structure for table tms-laravel.complaints
CREATE TABLE IF NOT EXISTS `complaints` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(20) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `network_type_id` bigint(20) unsigned DEFAULT NULL,
  `vertical_id` bigint(20) unsigned DEFAULT NULL,
  `section_id` bigint(20) unsigned DEFAULT NULL,
  `intercom` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `priority` enum('low','medium','high','urgent') NOT NULL DEFAULT 'medium',
  `status_id` bigint(20) unsigned NOT NULL,
  `assigned_to` bigint(20) unsigned DEFAULT NULL,
  `assigned_by` bigint(20) unsigned DEFAULT NULL,
  `resolution` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `complaints_reference_number_unique` (`reference_number`),
  KEY `complaints_network_type_id_foreign` (`network_type_id`),
  KEY `complaints_vertical_id_foreign` (`vertical_id`),
  KEY `complaints_section_id_foreign` (`section_id`),
  KEY `complaints_assigned_to_foreign` (`assigned_to`),
  KEY `complaints_assigned_by_foreign` (`assigned_by`),
  KEY `complaints_status_id_foreign` (`status_id`),
  CONSTRAINT `complaints_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `complaints_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `complaints_network_type_id_foreign` FOREIGN KEY (`network_type_id`) REFERENCES `network_types` (`id`),
  CONSTRAINT `complaints_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  CONSTRAINT `complaints_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  CONSTRAINT `complaints_vertical_id_foreign` FOREIGN KEY (`vertical_id`) REFERENCES `verticals` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.complaints: ~33 rows (approximately)
INSERT INTO `complaints` (`id`, `reference_number`, `user_name`, `client_id`, `network_type_id`, `vertical_id`, `section_id`, `intercom`, `description`, `file_path`, `priority`, `status_id`, `assigned_to`, `assigned_by`, `resolution`, `created_at`, `updated_at`) VALUES
	(3, 'CMP-20250620001', 'Rahul Sharma', 0, 1, 1, 2, '101', 'No network connectivity since morning.', NULL, 'high', 1, NULL, NULL, NULL, '2025-06-20 04:53:50', '2025-06-20 04:53:50'),
	(4, 'CMP-20250620002', 'Priya Mehta', 0, 2, 1, 1, '202', 'Internet drops frequently.', NULL, 'medium', 1, NULL, NULL, NULL, '2025-06-20 04:54:37', '2025-06-20 04:54:37'),
	(5, 'CMP-20250620003', 'Anil Verma', 0, 2, 3, 3, '303', 'Tally crashes on login.', NULL, 'high', 1, NULL, NULL, NULL, '2025-06-20 04:55:45', '2025-06-20 04:55:45'),
	(6, 'CMP-20250620004', 'Sneha Sinha', 0, 1, 2, 4, '108', 'Video conference room is not connecting.', NULL, 'high', 1, NULL, NULL, NULL, '2025-06-20 04:56:40', '2025-06-20 04:56:40'),
	(7, 'CMP-20250620005', 'Vivek Kumar', 0, 2, 5, 1, '401', 'Unable to send or receive emails.', NULL, 'medium', 1, NULL, NULL, NULL, '2025-06-20 04:57:17', '2025-06-20 04:57:17'),
	(8, 'CMP-20250620006', 'Rajat Singh', 0, 1, 4, 5, '207', 'Requesting renewal of antivirus.', NULL, 'low', 1, NULL, NULL, NULL, '2025-06-20 04:57:56', '2025-06-20 04:57:56'),
	(9, 'CMP-20250620007', 'Ananya Pandey', 0, 1, 1, 7, '305', 'File server not accessible.', NULL, 'high', 1, NULL, NULL, NULL, '2025-06-20 04:58:31', '2025-06-20 04:58:31'),
	(10, 'CMP-20250620008', 'Sunita Joshi', 0, 2, 3, 3, '110', 'Need Adobe Acrobat Reader.', NULL, 'low', 1, NULL, NULL, NULL, '2025-06-20 04:59:39', '2025-06-20 04:59:39'),
	(11, 'CMP-20250620009', 'Manoj Chauhan', 0, 1, 2, 6, '501', 'Audio not working in VC room.', NULL, 'medium', 2, 9, 9, NULL, '2025-06-20 05:00:17', '2025-06-23 20:46:30'),
	(12, 'CMP-20250620010', 'Kavita Raj', 0, 2, 4, 2, '302', 'Received suspicious email.', NULL, 'high', 6, 7, 2, 'its done', '2025-06-20 05:00:58', '2025-06-23 18:19:08'),
	(13, 'CMP-20250620011', 'Ashok Tiwari', 0, 2, 5, 1, '211', 'Outlook closes after 5 seconds.', NULL, 'high', 1, NULL, NULL, NULL, '2025-06-20 05:01:44', '2025-06-20 05:01:44'),
	(14, 'CMP-20250620012', 'Rekha Sharma', 0, 1, 1, 8, '109', 'LAN not detecting on port.', NULL, 'medium', 2, 3, 18, NULL, '2025-06-20 05:02:25', '2025-07-02 09:06:26'),
	(15, 'CMP-20250620013', 'Pankaj Mishra', 0, 1, 3, 5, '408', 'System performance is very slow.', NULL, 'low', 2, 2, 10, NULL, '2025-06-20 05:03:11', '2025-07-01 07:28:53'),
	(16, 'CMP-20250620014', 'Divya Rathi', 0, 2, 2, 4, '504', 'Video lags during meetings.', NULL, 'medium', 2, 5, 9, 'yes it is done', '2025-06-20 05:03:45', '2025-06-23 20:18:21'),
	(17, 'CMP-20250620015', 'Yash Dubey', 0, 1, 4, 3, '606', 'Antivirus detected ransomware activity.', NULL, 'high', 2, 11, 1, NULL, '2025-06-20 05:04:24', '2025-06-23 20:28:40'),
	(19, 'CMP-20250625001', 'Amin Ahmed', 0, 1, 2, 2, '201', 'Website not working', NULL, 'high', 8, 5, 1, NULL, '2025-06-25 08:09:58', '2025-06-30 05:52:19'),
	(21, 'CMP-20250627001', 'Shubham Mishra', 0, 1, 3, 4, '211', 'Test', 'complaint_files/1dp6eNbG0E6yfLIGUG0m4oLEjHd7kZAUMCE6FNeG.jpg', 'medium', 2, 8, 6, NULL, '2025-06-27 07:19:31', '2025-07-02 09:04:03'),
	(22, 'CMP-20250628001', 'ffdd dggd', 0, 1, 1, 2, '258', 'rsh dhr', NULL, 'medium', 6, 4, 2, NULL, '2025-06-28 08:12:08', '2025-06-28 08:24:54'),
	(23, 'CMP-20250630001', 'R K Sharma', 0, 2, 1, 3, '218', 'Internet is not working.', NULL, 'high', 8, 4, 2, NULL, '2025-06-30 05:00:26', '2025-06-30 05:05:39'),
	(24, 'CMP-20250630002', 'Aman Verma', 1, 1, 2, 10, '215', 'sfhbsf dfbdfs', NULL, 'medium', 6, 5, 3, NULL, '2025-06-30 09:23:14', '2025-06-30 09:52:26'),
	(25, 'CMP-20250630003', 'Mohit Chauhan', 1, 1, 2, 10, '215', 'sfhbsf dfbdfs', NULL, 'medium', 1, NULL, NULL, NULL, '2025-06-30 09:24:27', '2025-06-30 09:24:27'),
	(26, 'CMP-20250630004', 'Amit Chauhan', 0, 1, 2, 15, '201', 'Having Issue on LAN', 'complaint_files/PPlx0fLVDFJGAeg62JweAcu9YvLFE32VqkHUJray.png', 'medium', 1, NULL, NULL, NULL, '2025-06-30 09:30:49', '2025-06-30 09:30:49'),
	(27, 'CMP-20250630005', 'Shivam Bindra', 0, 1, 2, 13, '124', 'tedt', 'complaint_files/8Uiwcz05zowWpQrba1NED8QUdzJLQ1AbzOroCWtr.png', 'medium', 1, NULL, NULL, NULL, '2025-06-30 09:37:56', '2025-06-30 09:37:56'),
	(28, 'CMP-20250630006', 'fegte', 0, 1, 1, 14, '258', 'htnyryj', NULL, 'medium', 1, NULL, NULL, NULL, '2025-06-30 11:32:43', '2025-06-30 11:32:43'),
	(29, 'CMP-20250701001', 'Sumit Sharma', 0, 2, 1, 7, '01124305000', 'Internet not working', NULL, 'high', 2, 17, 1, NULL, '2025-07-01 05:21:23', '2025-07-01 06:49:38'),
	(30, 'CMP-20250701002', 'Ankit', 0, 1, 3, 5, '217', 'MMDs software not working', 'complaint_files/2hccjNfH3mFnjucChmbYl2rVciEdzceGGLF4NzKs.jpg', 'medium', 6, 10, 1, NULL, '2025-07-01 05:32:33', '2025-07-01 07:26:31'),
	(31, 'CMP-20250701003', 'Yash Kumar', 0, 2, 1, 10, '210', 'Some website is not working.', 'complaint_files/Y4ecnp3rsD4rzRKgUD4VnjY7Q4I837xBuix5U89F.jpg', 'high', 2, 4, 18, NULL, '2025-07-01 07:37:56', '2025-07-02 09:06:53'),
	(32, 'CMP-20250701004', 'Sushil Sharma', 0, 2, 5, 12, '236', 'Zscaler is not authenticate and email not open please resolve the problem as soon as possible', 'complaint_files/F4ZyyTjTI6nunnEpnE6hcotY1ZLNHNhcEPCEdVC2.pdf', 'high', 1, NULL, NULL, NULL, '2025-07-01 07:39:43', '2025-07-01 07:39:43'),
	(33, 'CMP-20250702001', 'Amit', 0, 2, 5, 15, '211', 'Email migrated but not working', NULL, 'medium', 4, 11, 1, NULL, '2025-07-02 05:01:28', '2025-07-02 05:07:04'),
	(34, 'CMP-20250702002', 'Dinesh', 0, 2, 1, 10, '214', 'Required new connection for a new system', 'complaint_files/mrE13wJ5L96OhxulBDtYbyIvOa5jNoqQAqVbocaw.pdf', 'high', 2, 17, 1, NULL, '2025-07-02 05:02:51', '2025-07-02 05:13:45'),
	(35, 'CMP-20250702003', 'Kusum', 0, 2, 1, 21, '292', 'Internet not working', NULL, 'high', 2, 6, 1, NULL, '2025-07-02 05:11:11', '2025-07-02 05:16:20'),
	(36, 'CMP-20250702004', 'Sanjeev', 0, 2, 3, 5, '211', 'ePatrachar related issue', NULL, 'medium', 1, NULL, NULL, NULL, '2025-07-02 05:12:38', '2025-07-02 05:12:38'),
	(37, 'CMP-20250702005', 'Sumit', 0, 1, 4, 13, '201', 'LAN not working', 'complaint_files/iPwofUxDFQGRLovRp6c8hUx90ZEaYgEB5Ywplblg.png', 'high', 8, 7, 2, NULL, '2025-07-02 11:15:59', '2025-07-02 11:32:48');

-- Dumping structure for table tms-laravel.complaint_actions
CREATE TABLE IF NOT EXISTS `complaint_actions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `complaint_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `assigned_to` bigint(20) unsigned DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `complaint_actions_complaint_id_foreign` (`complaint_id`),
  CONSTRAINT `complaint_actions_complaint_id_foreign` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.complaint_actions: ~90 rows (approximately)
INSERT INTO `complaint_actions` (`id`, `complaint_id`, `user_id`, `assigned_to`, `action`, `description`, `created_at`, `updated_at`) VALUES
	(14, 3, 0, NULL, 'created', 'Complaint created', '2025-06-20 04:53:50', '2025-06-20 04:53:50'),
	(15, 4, 0, NULL, 'created', 'Complaint created', '2025-06-20 04:54:38', '2025-06-20 04:54:38'),
	(16, 5, 0, NULL, 'created', 'Complaint created', '2025-06-20 04:55:45', '2025-06-20 04:55:45'),
	(17, 6, 0, NULL, 'created', 'Complaint created', '2025-06-20 04:56:40', '2025-06-20 04:56:40'),
	(18, 7, 0, NULL, 'created', 'Complaint created', '2025-06-20 04:57:18', '2025-06-20 04:57:18'),
	(19, 8, 0, NULL, 'created', 'Complaint created', '2025-06-20 04:57:56', '2025-06-20 04:57:56'),
	(20, 9, 0, NULL, 'created', 'Complaint created', '2025-06-20 04:58:31', '2025-06-20 04:58:31'),
	(21, 10, 0, NULL, 'created', 'Complaint created', '2025-06-20 04:59:39', '2025-06-20 04:59:39'),
	(22, 11, 0, NULL, 'created', 'Complaint created', '2025-06-20 05:00:17', '2025-06-20 05:00:17'),
	(23, 12, 0, NULL, 'created', 'Complaint created', '2025-06-20 05:00:58', '2025-06-20 05:00:58'),
	(24, 13, 0, NULL, 'created', 'Complaint created', '2025-06-20 05:01:44', '2025-06-20 05:01:44'),
	(25, 14, 0, NULL, 'created', 'Complaint created', '2025-06-20 05:02:25', '2025-06-20 05:02:25'),
	(26, 15, 0, NULL, 'created', 'Complaint created', '2025-06-20 05:03:11', '2025-06-20 05:03:11'),
	(27, 16, 0, NULL, 'created', 'Complaint created', '2025-06-20 05:03:45', '2025-06-20 05:03:45'),
	(28, 17, 0, NULL, 'created', 'Complaint created', '2025-06-20 05:04:24', '2025-06-20 05:04:24'),
	(29, 17, 1, NULL, 'assigned', 'Please fix this issue Immediately', '2025-06-20 05:16:45', '2025-06-20 05:16:45'),
	(30, 12, 2, NULL, 'assigned', 'please take it up and keep me posted.', '2025-06-20 05:31:07', '2025-06-20 05:31:07'),
	(31, 17, 7, NULL, 'reverted', 'Sorry sir, I am some other work so i unable to fix this issue', '2025-06-20 05:35:25', '2025-06-20 05:35:25'),
	(32, 16, 1, NULL, 'assigned', 'do that', '2025-06-20 09:16:08', '2025-06-20 09:16:08'),
	(33, 16, 9, NULL, 'resolved', 'Its done', '2025-06-20 12:03:20', '2025-06-20 12:03:20'),
	(34, 16, 9, NULL, 'resolved', 'yes it is done', '2025-06-20 12:03:39', '2025-06-20 12:03:39'),
	(35, 11, 9, 9, 'assigned', 'Sorry, I am busy', '2025-06-23 20:46:30', '2025-06-23 20:46:30'),
	(36, 19, 0, NULL, 'created', 'Complaint created', '2025-06-25 08:09:59', '2025-06-25 08:09:59'),
	(42, 21, 0, NULL, 'created', 'Complaint created', '2025-06-27 07:19:31', '2025-06-27 07:19:31'),
	(43, 21, 10, 6, 'assigned', 'please handle this immediately', '2025-06-27 07:39:31', '2025-06-27 07:39:31'),
	(44, 21, 6, NULL, 'in_progress', 'ok i will handle this...', '2025-06-27 08:10:04', '2025-06-27 08:10:04'),
	(45, 21, 6, NULL, 'pending_with_user', 'some details are missing by user', '2025-06-27 08:07:00', '2025-06-27 08:07:00'),
	(46, 21, 6, NULL, 'in_progress', 's', '2025-06-27 08:16:02', '2025-06-27 08:16:02'),
	(47, 21, 6, NULL, 'pending_with_user', 'cc', '2025-06-27 08:16:16', '2025-06-27 08:16:16'),
	(48, 21, 6, NULL, 'pending_with_vendor', 'dd', '2025-06-27 08:16:26', '2025-06-27 08:16:26'),
	(49, 21, 6, NULL, 'completed', 'yes it is done', '2025-06-27 08:22:01', '2025-06-27 08:22:01'),
	(50, 21, 1, 6, 'assigned', 'not done yet', '2025-06-27 08:41:36', '2025-06-27 08:41:36'),
	(51, 21, 6, NULL, 'in_progress', 'ok i will check', '2025-06-27 08:42:33', '2025-06-27 08:42:33'),
	(52, 19, 1, 3, 'assigned', 'you have to do', '2025-06-27 09:13:16', '2025-06-27 09:13:16'),
	(53, 19, 1, 5, 'assigned', 'okk', '2025-06-27 10:49:01', '2025-06-27 10:49:01'),
	(54, 15, 1, 10, 'assigned', 'okk', '2025-06-27 10:49:14', '2025-06-27 10:49:14'),
	(55, 22, 0, NULL, 'created', 'Complaint created', '2025-06-28 08:12:08', '2025-06-28 08:12:08'),
	(56, 22, 8, 4, 'assigned', 'fdfb', '2025-06-28 08:18:34', '2025-06-28 08:18:34'),
	(57, 22, 4, NULL, 'pending_with_vendor', 'tuktu tuku', '2025-06-28 08:19:34', '2025-06-28 08:19:34'),
	(58, 22, 4, NULL, 'in_progress', 'ytttjky ghhhmh', '2025-06-28 08:19:52', '2025-06-28 08:19:52'),
	(59, 22, 4, NULL, 'completed', 'fhmfh fhnfh', '2025-06-28 08:20:11', '2025-06-28 08:20:11'),
	(60, 22, 2, 4, 'assigned', 'efhbe rtht', '2025-06-28 08:22:54', '2025-06-28 08:22:54'),
	(61, 22, 4, NULL, 'completed', 'rh fhg dfh dfh dfb dhb', '2025-06-28 08:24:22', '2025-06-28 08:24:22'),
	(62, 22, 2, NULL, 'closed', 'closed', '2025-06-28 08:24:54', '2025-06-28 08:24:54'),
	(63, 23, 0, NULL, 'created', 'Complaint created', '2025-06-30 05:00:26', '2025-06-30 05:00:26'),
	(64, 23, 2, 4, 'assigned', 'check on priority', '2025-06-30 05:01:38', '2025-06-30 05:01:38'),
	(65, 23, 4, NULL, 'in_progress', 'checking sir', '2025-06-30 05:03:20', '2025-06-30 05:03:20'),
	(66, 23, 4, NULL, 'completed', 'yes sir completed. cable was faulty. cable changed.', '2025-06-30 05:05:39', '2025-06-30 05:05:39'),
	(67, 19, 5, NULL, 'completed', 'yes its completed', '2025-06-30 05:52:19', '2025-06-30 05:52:19'),
	(68, 24, 1, NULL, 'created', 'Complaint created', '2025-06-30 09:23:14', '2025-06-30 09:23:14'),
	(69, 25, 1, NULL, 'created', 'Complaint created', '2025-06-30 09:24:27', '2025-06-30 09:24:27'),
	(70, 26, 0, NULL, 'created', 'Complaint created', '2025-06-30 09:30:49', '2025-06-30 09:30:49'),
	(71, 27, 0, NULL, 'created', 'Complaint created', '2025-06-30 09:37:56', '2025-06-30 09:37:56'),
	(72, 24, 1, 3, 'assigned', 'yo have to do', '2025-06-30 09:41:12', '2025-06-30 09:41:12'),
	(73, 24, 3, NULL, 'in_progress', 'ok i will check', '2025-06-30 09:47:19', '2025-06-30 09:47:19'),
	(74, 24, 3, 5, 'assigned', 'i am busy', '2025-06-30 09:48:57', '2025-06-30 09:48:57'),
	(75, 24, 5, NULL, 'completed', 'its done', '2025-06-30 09:51:38', '2025-06-30 09:51:38'),
	(76, 24, 1, NULL, 'closed', 'ok its done', '2025-06-30 09:52:26', '2025-06-30 09:52:26'),
	(77, 28, 0, NULL, 'created', 'Complaint created', '2025-06-30 11:32:43', '2025-06-30 11:32:43'),
	(78, 29, 0, NULL, 'created', 'Complaint created', '2025-07-01 05:21:23', '2025-07-01 05:21:23'),
	(79, 30, 0, NULL, 'created', 'Complaint created', '2025-07-01 05:32:33', '2025-07-01 05:32:33'),
	(80, 12, 1, NULL, 'updated', 'Complaint updated', '2025-07-01 06:38:59', '2025-07-01 06:38:59'),
	(81, 29, 1, NULL, 'updated', 'Complaint updated', '2025-07-01 06:45:29', '2025-07-01 06:45:29'),
	(82, 29, 1, NULL, 'updated', 'Complaint updated', '2025-07-01 06:46:19', '2025-07-01 06:46:19'),
	(83, 29, 1, 17, 'assigned', 'Go to the section and check why the internet is not working.', '2025-07-01 06:49:38', '2025-07-01 06:49:38'),
	(84, 30, 10, 10, 'assigned', 'Check the problem then discuss.', '2025-07-01 06:58:46', '2025-07-01 06:58:46'),
	(85, 30, 10, NULL, 'in_progress', 'Server is restart.', '2025-07-01 06:59:38', '2025-07-01 06:59:38'),
	(86, 30, 10, 6, 'assigned', 'I am another call please check the issue.', '2025-07-01 07:03:49', '2025-07-01 07:03:49'),
	(87, 30, 6, NULL, 'completed', 'Sir, Inform to the section it can be open.', '2025-07-01 07:20:25', '2025-07-01 07:20:25'),
	(88, 30, 1, 10, 'assigned', 'Once check if any problem is pending regarding this', '2025-07-01 07:22:15', '2025-07-01 07:22:15'),
	(89, 30, 10, NULL, 'completed', 'No sir, all problem is resolve you can closed the issue.', '2025-07-01 07:24:13', '2025-07-01 07:24:13'),
	(90, 30, 1, NULL, 'closed', 'Problem resolved', '2025-07-01 07:26:31', '2025-07-01 07:26:31'),
	(91, 15, 10, NULL, 'reverted', 'Sir please discuss first then we can resolve this', '2025-07-01 07:28:53', '2025-07-01 07:28:53'),
	(92, 31, 0, NULL, 'created', 'Complaint created', '2025-07-01 07:37:56', '2025-07-01 07:37:56'),
	(93, 32, 0, NULL, 'created', 'Complaint created', '2025-07-01 07:39:43', '2025-07-01 07:39:43'),
	(94, 33, 0, NULL, 'created', 'Complaint created', '2025-07-02 05:01:28', '2025-07-02 05:01:28'),
	(95, 34, 0, NULL, 'created', 'Complaint created', '2025-07-02 05:02:51', '2025-07-02 05:02:51'),
	(96, 33, 1, 11, 'assigned', 'Check and inform', '2025-07-02 05:03:31', '2025-07-02 05:03:31'),
	(97, 33, 11, NULL, 'pending_with_vendor', 'It is not registered in Pehchan account and also email to the email division', '2025-07-02 05:07:04', '2025-07-02 05:07:04'),
	(98, 35, 0, NULL, 'created', 'Complaint created', '2025-07-02 05:11:11', '2025-07-02 05:11:11'),
	(99, 36, 0, NULL, 'created', 'Complaint created', '2025-07-02 05:12:38', '2025-07-02 05:12:38'),
	(100, 34, 1, 17, 'assigned', 'Check the issue', '2025-07-02 05:13:45', '2025-07-02 05:13:45'),
	(101, 35, 1, 6, 'assigned', 'Check and inform to the network team', '2025-07-02 05:16:20', '2025-07-02 05:16:20'),
	(102, 21, 6, 8, 'assigned', 'Sorry i am busy', '2025-07-02 09:04:03', '2025-07-02 09:04:03'),
	(103, 14, 18, 3, 'assigned', 'Check the issue', '2025-07-02 09:06:26', '2025-07-02 09:06:26'),
	(104, 31, 18, 4, 'assigned', 'Check the issue', '2025-07-02 09:06:53', '2025-07-02 09:06:53'),
	(105, 37, 0, NULL, 'created', 'Complaint created', '2025-07-02 11:15:59', '2025-07-02 11:15:59'),
	(106, 37, 2, 7, 'assigned', 'handle this', '2025-07-02 11:22:51', '2025-07-02 11:22:51'),
	(107, 37, 7, NULL, 'in_progress', 'ok i will handle', '2025-07-02 11:26:10', '2025-07-02 11:26:10'),
	(108, 37, 7, NULL, 'completed', 'its done', '2025-07-02 11:32:48', '2025-07-02 11:32:48');

-- Dumping structure for table tms-laravel.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table tms-laravel.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.jobs: ~0 rows (approximately)

-- Dumping structure for table tms-laravel.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.job_batches: ~0 rows (approximately)

-- Dumping structure for table tms-laravel.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.migrations: ~25 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000001_create_cache_table', 1),
	(2, '0001_01_01_000002_create_jobs_table', 1),
	(3, '2025_06_14_000001_create_network_types_table', 1),
	(4, '2025_06_14_000002_create_sections_table', 1),
	(5, '2025_06_14_000003_create_verticals_table', 1),
	(6, '2025_06_14_082726_create_users_table', 1),
	(7, '2025_06_14_082814_create_complaints_table', 1),
	(9, '2025_06_14_082826_create_tms_table', 1),
	(10, '2025_06_14_084437_create_sessions_table', 1),
	(11, '2025_06_20_013642_add_reverted_to_status_enum_in_complaints_table', 2),
	(12, '2025_06_20_104201_create_comments_table', 3),
	(13, '2025_06_20_172906_add_resolution_to_complaints_table', 4),
	(14, '2025_06_23_100502_create_statuses_table', 5),
	(15, '2025_06_23_100540_update_complaints_table_use_status_foreign_key', 5),
	(16, '2025_06_23_100620_migrate_existing_complaint_statuses_to_status_table', 6),
	(17, '2025_06_23_100640_remove_status_enum_column_from_complaints_table', 6),
	(18, '2025_06_23_111507_create_roles_table', 6),
	(19, '2025_06_23_111603_add_role_id_to_users_table', 6),
	(20, '2025_06_23_111634_migrate_existing_user_roles', 6),
	(21, '2025_06_23_111659_remove_role_from_users_table', 6),
	(22, '2025_06_14_082815_create_complaint_actions_table', 7),
	(23, '2025_06_25_082900_remove_remember_token_from_users', 8),
	(24, '2025_07_02_114310_add_deleted_at_to_users_table', 9),
	(25, '2025_07_04_000000_create_user_vertical_table', 10),
	(26, '2025_07_04_000001_migrate_user_verticals', 10);

-- Dumping structure for table tms-laravel.network_types
CREATE TABLE IF NOT EXISTS `network_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.network_types: ~2 rows (approximately)
INSERT INTO `network_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Air Gap Network', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(2, 'Internet', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL);

-- Dumping structure for table tms-laravel.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.roles: ~5 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Admin', 'admin', NULL, '2025-06-23 17:44:48', '2025-06-23 17:44:48', NULL),
	(2, 'Manager', 'manager', NULL, '2025-06-23 17:44:48', '2025-06-23 17:44:48', NULL),
	(3, 'VM', 'vm', NULL, '2025-06-23 17:44:48', '2025-06-23 17:44:48', NULL),
	(4, 'NFO', 'nfo', NULL, '2025-06-23 17:44:48', '2025-06-23 17:44:48', NULL),
	(5, 'Client', 'client', NULL, '2025-06-23 17:44:48', '2025-06-23 17:44:48', NULL);

-- Dumping structure for table tms-laravel.sections
CREATE TABLE IF NOT EXISTS `sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.sections: ~21 rows (approximately)
INSERT INTO `sections` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'ACC', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(2, 'Ad I', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(3, 'Ad II', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(4, 'CA I', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(5, 'CA II', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(6, 'CA III', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(7, 'CA IV', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(8, 'CA V', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(9, 'Cabinet Section', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(10, 'TS Cell', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(11, 'RTI Cell', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(12, 'VCC Cell', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(13, 'Comp Cell', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(14, 'Imp Cell', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(15, 'General Section', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(16, 'Cash Section', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(17, 'Deregulation Cell', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(18, 'GTE Cell', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(19, 'DPG', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(20, 'DBT', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(21, 'NACWC', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL);

-- Dumping structure for table tms-laravel.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.sessions: ~0 rows (approximately)

-- Dumping structure for table tms-laravel.statuses
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL DEFAULT 'secondary',
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `statuses_name_unique` (`name`),
  UNIQUE KEY `statuses_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.statuses: ~8 rows (approximately)
INSERT INTO `statuses` (`id`, `name`, `slug`, `color`, `description`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'unassigned', 'unassigned', 'warning', 'Complaint is waiting to be assigned', 1, 1, '2025-06-23 17:43:53', '2025-06-23 17:43:53'),
	(2, 'assigned', 'assigned', 'info', 'Complaint has been assigned to a team member', 1, 2, '2025-06-23 17:43:53', '2025-06-23 17:43:53'),
	(3, 'in_progress', 'in_progress', 'primary', 'Work on the complaint is currently in progress', 1, 3, '2025-06-23 17:43:53', '2025-06-23 17:43:53'),
	(4, 'pending_with_vendor', 'pending_with_vendor', 'danger', 'Complaint has been escalated to higher authority', 1, 4, '2025-06-23 17:43:53', '2025-06-23 17:43:53'),
	(5, 'pending_with_user', 'pending_with_user', 'danger', 'Complaint has been resolved successfully', 1, 5, '2025-06-23 17:43:53', '2025-06-23 17:43:53'),
	(6, 'closed', 'closed', 'success', 'Complaint has been closed', 1, 7, '2025-06-23 17:43:53', '2025-06-23 17:43:53'),
	(7, 'assign_to_me', 'assign_to_me', 'warning', 'Complaint has been reverted for further action', 1, 8, '2025-06-23 17:43:53', '2025-06-23 17:43:53'),
	(8, 'completed', 'completed', 'success', NULL, 1, 6, '2025-06-23 17:43:53', '2025-06-23 17:43:53');

-- Dumping structure for table tms-laravel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `vertical_id` bigint(20) unsigned DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_vertical_id_foreign` (`vertical_id`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_vertical_id_foreign` FOREIGN KEY (`vertical_id`) REFERENCES `verticals` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.users: ~13 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `username`, `full_name`, `vertical_id`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, 'rohit', 'Rohit Kumar', NULL, '$2y$12$09LXERDW.YbzvrB6QEbCjOupnW/ptTWgL1z5AHml5jZaPn5u/yaD6', '2025-06-19 18:58:26', '2025-07-02 10:49:48', NULL),
	(2, 2, 'yogesh', 'Yogesh Kumar', NULL, '$2y$12$lv5/E2lK1cgpNwdqR3xQl.q6rXcM5/tyIDIH4Ia80MJXKpzsPK16e', '2025-06-19 18:59:47', '2025-06-19 18:59:47', NULL),
	(3, 4, 'rachit', 'Rachit Sharma', 1, '$2y$12$gyALZ8fk5K4L.G6eqSMx/OfmsRQuXsisUlZ2BzZJXGIIVPKCTM8EK', '2025-06-19 19:00:25', '2025-07-01 08:03:07', NULL),
	(4, 4, 'manish', 'Manish Singh', 1, '$2y$12$xYMS82jk2qXjIi7zpt37gu5xEtQGRPCyo9nmS7XXpJfSu2W5ZTI/K', '2025-06-19 19:06:42', '2025-07-02 07:18:03', NULL),
	(5, 4, 'rajkumar', 'Rajkumar', 2, '$2y$12$W5PszaNMuMcz593y7kkBbO9vdQnndWC7W7ns58BBTMW6YzUujN5JK', '2025-06-19 19:07:23', '2025-07-01 07:52:16', NULL),
	(6, 4, 'sahil', 'Sahil Gulia', 1, '$2y$12$09LXERDW.YbzvrB6QEbCjOupnW/ptTWgL1z5AHml5jZaPn5u/yaD6', '2025-06-19 19:08:12', '2025-07-01 07:52:36', NULL),
	(7, 4, 'anil', 'Anil Singh', 4, '$2y$12$IkJUjKJSu.PktmAMqpKCWeDNNx591O1tgmiX4dM5TCCo1w1cPAxPq', '2025-06-19 19:08:51', '2025-07-01 08:02:14', NULL),
	(8, 3, 'tarun', 'Tarun Kumar', 3, '$2y$12$J34ry.B93C7QKfwJXKmka.L7p6YgHL1WVHD9W782ssL2a27ENeuOa', '2025-06-19 19:10:12', '2025-07-01 07:53:25', NULL),
	(9, 4, 'vikram', 'Vikram Mahlawat', 2, '$2y$12$2pjswFASzGyGQs6Ab/4xOuHVx1hHfJprTNqZ.JveWxNxAYE5Iyf9S', '2025-06-19 19:11:17', '2025-07-01 08:03:17', NULL),
	(10, 3, 'praveen', 'Praveen Bansal', 3, '$2y$12$oy6bE/RrvbWgLxZiIgfEHOYGrhhoc0aMBQYyn7qOlnvInOXVxCnIe', '2025-06-19 19:12:09', '2025-07-01 07:53:46', NULL),
	(11, 3, 'ankit', 'Ankit Chugh', 5, '$2y$12$QUKhtG3ioPD3y3Lr6R0KTOqDWBF3SbpBw6sWTwc6ZBBE.jZ4yn/SG', '2025-06-19 19:13:04', '2025-07-01 07:55:21', NULL),
	(17, 4, 'Ankits', 'Ankit Sharma', 1, '$2y$12$7nMdei6QHXJVVML32vPdXOgO7vcAj2zipRZgvIMTFI8zIKbFyMn8W', '2025-07-01 06:12:47', '2025-07-01 07:55:06', NULL),
	(18, 3, 'prankur', 'Prankur Sharma', 1, '$2y$12$9F0NKviKx51waQhzFFwZwuDWb14hOyeQK.g60uiv1EDK3VrcuZr5e', '2025-07-01 08:02:48', '2025-07-01 08:02:48', NULL);

-- Dumping structure for table tms-laravel.user_vertical
CREATE TABLE IF NOT EXISTS `user_vertical` (
  `user_id` bigint(20) unsigned NOT NULL,
  `vertical_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`vertical_id`),
  KEY `user_vertical_vertical_id_foreign` (`vertical_id`),
  CONSTRAINT `user_vertical_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_vertical_vertical_id_foreign` FOREIGN KEY (`vertical_id`) REFERENCES `verticals` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.user_vertical: ~13 rows (approximately)
INSERT INTO `user_vertical` (`user_id`, `vertical_id`) VALUES
	(3, 1),
	(3, 3),
	(4, 1),
	(5, 2),
	(6, 1),
	(7, 4),
	(8, 1),
	(8, 3),
	(9, 2),
	(10, 3),
	(11, 5),
	(17, 1),
	(18, 1);

-- Dumping structure for table tms-laravel.verticals
CREATE TABLE IF NOT EXISTS `verticals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tms-laravel.verticals: ~5 rows (approximately)
INSERT INTO `verticals` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Network', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(2, 'VC', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(3, 'Software', '2025-06-17 05:29:27', '2025-06-17 05:29:27', NULL),
	(4, 'Cyber Security', '2025-06-20 04:45:03', '2025-06-20 04:45:06', NULL),
	(5, 'Email', '2025-06-20 04:41:20', '2025-06-20 04:41:23', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
