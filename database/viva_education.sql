-- phpMyAdmin SQL Dump
-- version 5.1.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 03, 2023 at 10:21 AM
-- Server version: 8.0.31-0ubuntu2
-- PHP Version: 8.1.7-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viva_education`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `course_type` enum('under_graduation','post_graduation') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int NOT NULL,
  `university_id` int NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `given_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_expire` date NOT NULL,
  `ielts_score` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `course_type`, `subject_id`, `university_id`, `surname`, `given_name`, `email`, `date_of_birth`, `address`, `passport_no`, `passport_expire`, `ielts_score`, `passport_image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 'under_graduation', 1, 2, 'Hasan', 'Hashibul', 'tester@test.com', '2022-12-16', 'Dhaka', '123', '2022-12-16', '7', 'http://188.166.169.11/storage/passport/passport_1671212215-639cacb7ab898.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('about_us','basic_requirement','company_service','terms','privacy') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `type`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'basic_requirement', '\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n&nbsp;\r\n\r\n\r\nArgentina v Croatia | Semi-finals | FIFA World Cup Qatar 2022&trade; | Highlights\r\n\r\n\r\n\r\n&nbsp;\r\n\r\n\r\n\r\nDec 13, 2022\r\n2min\r\n\r\n\r\nWatch the highlights from the match between Argentina and Croatia played at Lusail Stadium, Lusail on Tuesday, 13 December 2022.\r\n\r\n\r\n\r\n\r\n&nbsp;', NULL, '2022-12-14 07:18:57', '2022-12-14 07:18:57'),
(2, 'company_service', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', NULL, '2022-12-16 17:40:48', '2022-12-16 17:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `basic_profiles`
--

CREATE TABLE `basic_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ielts_score` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `basic_profiles`
--

INSERT INTO `basic_profiles` (`id`, `user_id`, `date_of_birth`, `address`, `ielts_score`, `created_at`, `updated_at`) VALUES
(1, 2, '2022-12-16', 'Dhaka', 7.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `passing_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `user_id`, `title`, `institution_name`, `passing_year`, `grade`, `certificate`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 'Test', 'Test', '2016', 'A', 'certificate/certificate_1671224473-639cdc99e1751.png', NULL, NULL, NULL),
(2, 4, 'Test 2', 'Test', '2016', 'A', 'certificate/certificate_1671224503-639cdcb73f401.png', NULL, NULL, NULL),
(3, 4, 'SSC', 'Testing school', '2022', '5.00', 'certificate/certificate_1671227670-639ce9164b3de.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_statuses`
--

CREATE TABLE `job_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_statuses`
--

INSERT INTO `job_statuses` (`id`, `title`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Applied', NULL, '2022-12-09 23:26:38', '2022-12-09 23:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `inside_london` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `title`, `inside_london`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'Dundee', 0, NULL, '2022-12-10 20:17:08', '2022-12-10 20:17:08'),
(4, 'Aberystwyth', 0, NULL, '2022-12-10 20:17:14', '2022-12-10 20:17:14'),
(5, 'Cambridge', 0, NULL, '2022-12-10 20:17:21', '2022-12-10 20:17:21'),
(6, 'London', 1, NULL, '2022-12-10 20:17:30', '2022-12-10 20:17:38');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_03_154312_create_permission_tables', 1),
(6, '2022_12_08_1670498236_create_news_table', 2),
(7, '2016_06_01_000001_create_oauth_auth_codes_table', 3),
(8, '2016_06_01_000002_create_oauth_access_tokens_table', 3),
(9, '2016_06_01_000003_create_oauth_refresh_tokens_table', 3),
(10, '2016_06_01_000004_create_oauth_clients_table', 3),
(11, '2016_06_01_000005_create_oauth_personal_access_clients_table', 3),
(12, '2022_12_09_152256_create_basic_profiles_table', 3),
(13, '2022_12_09_152337_create_passport_profiles_table', 3),
(14, '2022_12_10_1670649882_create_jobstatuses_table', 4),
(15, '2022_12_10_1670650044_create_subjects_table', 5),
(16, '2022_12_10_1670650999_create_locations_table', 6),
(17, '2022_12_10_1670663652_create_universities_table', 7),
(18, '2022_12_10_1670671520_create_applications_table', 8),
(19, '2022_12_14_1671023353_create_articles_table', 9),
(20, '2022_12_14_1671023562_create_articles_table', 10),
(21, '2022_12_14_1671026156_create_education_table', 11),
(22, '2022_12_14_1671026216_create_education_table', 12),
(23, '2022_12_14_1671026749_create_professionals_table', 13),
(24, '2022_12_14_1671026890_create_otherdcouments_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `short_description`, `description`, `image`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Quam in dolor nostru', 'Ex aut minima libero', 'Iste et quaerat assu', 'news/news1670498509-6391c8cda8b61.jpg', 1, NULL, '2022-12-08 05:21:49', '2022-12-08 05:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('16b0d3a81e5c84b4f4223000b5afa9b32c88926bcd8c27b25c166609d0a805a2aea24a595c027816', 5, 1, 'VivaEducation', '[]', 0, '2022-12-29 20:37:40', '2022-12-29 20:37:40', '2023-12-29 20:37:40'),
('3c35bc1fc52b28414176e97a3a31be6005e30bc52ced64b45112abc1564306fe3f394ff43be30e96', 2, 1, 'VivaEducation', '[]', 0, '2022-12-10 22:09:57', '2022-12-10 22:09:57', '2023-12-11 04:09:57'),
('624297107c4c70445ed48940225441ed141be07cd56f9124d16bec90ab3ec5246ad65af31fae231d', 2, 1, 'VivaEducation', '[]', 0, '2022-12-16 16:29:00', '2022-12-16 16:29:00', '2023-12-16 16:29:00'),
('9f7341d0baf9d82ae32fb0757432b1099786b0def0f5badfd085a5736c824bb017285c306db9c366', 5, 1, 'VivaEducation', '[]', 0, '2022-12-30 12:19:38', '2022-12-30 12:19:38', '2023-12-30 12:19:38'),
('a83cf7c8b674d0f3253adf877b70e2c80591ef78d5a9471540ed898784aee948729269a017b56f94', 2, 1, 'VivaEducation', '[]', 0, '2022-12-10 22:08:28', '2022-12-10 22:08:28', '2023-12-11 04:08:28'),
('b7e9c4dcb3dfb703baed4a2d067f9e182f42387f9983de334e99c4681309d6fa95811794a96c7c2e', 5, 1, 'VivaEducation', '[]', 0, '2022-12-29 20:28:21', '2022-12-29 20:28:21', '2023-12-29 20:28:21'),
('c35f002caa9f0dbfb55d0a085077cfebab6a2c663b8e2cbace4c3b2478bc86eddb8f681f404599ca', 4, 1, 'VivaEducation', '[]', 0, '2022-12-15 14:08:56', '2022-12-15 14:08:56', '2023-12-15 14:08:56'),
('c8b958893159c09f5330502190c2ae991a250ed3b36c5f5a916b872b0d09e1036e5d5ec61cae752c', 2, 1, 'VivaEducation', '[]', 0, '2022-12-10 22:09:54', '2022-12-10 22:09:54', '2023-12-11 04:09:54'),
('df3720ea10a6b913b4577c3dbfeee894a4c672f7c49c51f4777c894921844a09cc8a2438b4589bff', 2, 1, 'VivaEducation', '[]', 0, '2022-12-10 22:09:25', '2022-12-10 22:09:25', '2023-12-11 04:09:25'),
('f2a889d70ca9bf12b427e3237b596325b9cacefa4f6cc0873b1ee8fa20e1711955b48577a2d763c1', 2, 1, 'VivaEducation', '[]', 0, '2022-12-16 16:29:40', '2022-12-16 16:29:40', '2023-12-16 16:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'DInLRTet1jCKttNmzxJhe6BJFyf9PWlUKQdwvE2v', NULL, 'http://localhost', 1, 0, 0, '2022-12-10 22:08:24', '2022-12-10 22:08:24'),
(2, NULL, 'Laravel Password Grant Client', '1b5aDJWO7IPOCygBwFCkmuteWPzzS6zdtersrgUb', 'users', 'http://localhost', 0, 1, 0, '2022-12-10 22:08:24', '2022-12-10 22:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-12-10 22:08:24', '2022-12-10 22:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_dcouments`
--

CREATE TABLE `other_dcouments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `type` enum('sop','cv','personal_reference','academic_reference') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_dcouments`
--

INSERT INTO `other_dcouments` (`id`, `user_id`, `type`, `letter`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 'sop', 'letter/letter_1671235412-639d07548daf5.docx', NULL, NULL, NULL),
(2, 4, 'personal_reference', 'letter/letter_1671235804-639d08dc93120.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `passport_profiles`
--

CREATE TABLE `passport_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `given_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ielts_score` double(8,2) NOT NULL,
  `passport_expire` date NOT NULL,
  `passport_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `passport_profiles`
--

INSERT INTO `passport_profiles` (`id`, `user_id`, `given_name`, `surname`, `passport_no`, `date_of_birth`, `address`, `ielts_score`, `passport_expire`, `passport_image`, `created_at`, `updated_at`) VALUES
(1, 4, 'Hashibul 4', 'Hasan', '123', '2022-12-16', 'Dhaka', 7.50, '2022-12-16', 'passport/passport_1671224231-639cdba7b37ab.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Role Add', 'web', '2022-12-03 10:15:08', '2022-12-03 10:15:08'),
(2, 'Role Update', 'web', '2022-12-03 10:15:18', '2022-12-03 10:15:18'),
(3, 'Role Delete', 'web', '2022-12-03 10:15:28', '2022-12-03 10:15:28'),
(4, 'Role View', 'web', '2022-12-03 10:15:38', '2022-12-03 10:15:38'),
(5, 'Permission Add', 'web', '2022-12-03 10:15:47', '2022-12-03 10:15:47'),
(6, 'Permission Update', 'web', '2022-12-03 10:15:55', '2022-12-03 10:15:55'),
(7, 'Permission Delete', 'web', '2022-12-03 10:16:02', '2022-12-03 10:16:02'),
(8, 'Permission View', 'web', '2022-12-03 10:16:14', '2022-12-03 10:16:14'),
(9, 'User Add', 'web', '2022-12-03 10:16:46', '2022-12-03 10:16:46'),
(10, 'User Update', 'web', '2022-12-03 10:16:54', '2022-12-03 10:16:54'),
(11, 'User Delete', 'web', '2022-12-03 10:17:01', '2022-12-03 10:17:01'),
(12, 'User View', 'web', '2022-12-03 10:17:10', '2022-12-03 10:17:10'),
(13, 'User Menu', 'web', '2022-12-03 10:26:00', '2022-12-03 10:26:00'),
(14, 'Permission Menu', 'web', '2022-12-03 10:26:12', '2022-12-03 10:26:12'),
(15, 'Role Menu', 'web', '2022-12-03 10:26:21', '2022-12-03 10:26:21'),
(16, 'News Menu', 'web', '2022-12-08 05:20:31', '2022-12-08 05:20:31'),
(17, 'Article Menu', 'web', '2022-12-14 07:10:29', '2022-12-14 07:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professionals`
--

CREATE TABLE `professionals` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` date NOT NULL,
  `to` date DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_letter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professionals`
--

INSERT INTO `professionals` (`id`, `user_id`, `title`, `company_name`, `from`, `to`, `location`, `experience_letter`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 'Software Engineer', 'Testing company', '2022-12-17', '2022-12-17', 'Dhaka', 'experience_letter/experience_letter_1671230185-639cf2e9db3fa.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2022-12-03 10:14:55', '2022-12-03 10:14:55'),
(2, 'student', 'web', '2022-12-03 21:49:33', '2022-12-03 21:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `title`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'CSE', NULL, '2022-12-09 23:33:59', '2022-12-09 23:33:59'),
(2, 'sdsd', NULL, '2022-12-10 21:06:23', '2022-12-10 21:06:23'),
(3, 'S1', NULL, '2022-12-20 04:53:31', '2022-12-20 04:53:31'),
(4, 'S2', NULL, '2022-12-20 04:53:31', '2022-12-20 04:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `subject_university`
--

CREATE TABLE `subject_university` (
  `id` int NOT NULL,
  `university_id` int NOT NULL,
  `subject_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `subject_university`
--

INSERT INTO `subject_university` (`id`, `university_id`, `subject_id`) VALUES
(1, 13, 1),
(2, 13, 2),
(3, 1, 1),
(4, 14, 3),
(5, 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` int NOT NULL,
  `tution_fee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `session` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `scholarship` tinyint(1) NOT NULL,
  `ielts` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `title`, `location_id`, `tution_fee`, `session`, `scholarship`, `ielts`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Necessitatibus labor', 6, 'Sequi rerum commodo', 'Consequat Culpa fug', 1, 0, NULL, '2022-12-10 03:28:57', '2022-12-10 03:28:57'),
(2, 'University', 4, '12', '2', 0, 0, NULL, '2022-12-10 20:58:42', '2022-12-10 20:58:42'),
(3, 'Qui iste ipsa repel', 4, 'Omnis ipsa architec', 'Cum minus obcaecati', 1, 0, NULL, '2022-12-10 21:04:16', '2022-12-10 21:04:16'),
(4, 'Qui iste ipsa repel', 4, 'Omnis ipsa architec', 'Cum minus obcaecati', 1, 0, NULL, '2022-12-10 21:04:39', '2022-12-10 21:04:39'),
(5, 'Qui iste ipsa repel', 4, 'Omnis ipsa architec', 'Cum minus obcaecati', 1, 0, NULL, '2022-12-10 21:04:54', '2022-12-10 21:04:54'),
(6, 'Qui iste ipsa repel', 4, 'Omnis ipsa architec', 'Cum minus obcaecati', 1, 0, NULL, '2022-12-10 21:05:10', '2022-12-10 21:05:10'),
(7, 'Qui iste ipsa repel', 4, 'Omnis ipsa architec', 'Cum minus obcaecati', 1, 0, NULL, '2022-12-10 21:05:18', '2022-12-10 21:05:18'),
(8, 'Animi ut dolor atqu', 3, 'Et rerum incididunt', 'Aut voluptate cillum', 1, 0, NULL, '2022-12-10 21:05:52', '2022-12-10 21:05:52'),
(9, 'Blanditiis ut mollit', 6, 'Assumenda eaque cupi', 'Minima deserunt illu', 1, 0, NULL, '2022-12-10 21:06:31', '2022-12-10 21:06:31'),
(10, 'Blanditiis ut mollit', 6, 'Assumenda eaque cupi', 'Minima deserunt illu', 1, 0, NULL, '2022-12-10 21:06:46', '2022-12-10 21:06:46'),
(11, 'Blanditiis ut mollit', 6, 'Assumenda eaque cupi', 'Minima deserunt illu', 1, 0, NULL, '2022-12-10 21:06:56', '2022-12-10 21:06:56'),
(12, 'Est in dolore enim', 3, 'Pariatur Molestias', 'Officiis ratione ad', 1, 0, NULL, '2022-12-10 21:07:06', '2022-12-10 21:07:06'),
(13, 'Est in dolore enim', 3, 'Pariatur Molestias', 'Officiis ratione ad', 1, 0, NULL, '2022-12-10 21:07:14', '2022-12-10 21:07:14'),
(14, 'Test University', 6, '2500', 'First', 1, 8, NULL, '2022-12-20 04:53:31', '2022-12-20 04:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_otp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_first_login` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `image`, `email_verified_at`, `password`, `otp`, `password_otp`, `is_verified`, `remember_token`, `created_at`, `updated_at`, `is_first_login`) VALUES
(1, 'Super Admin', '01710000000', '8IjUyUrfA6@gmail.com', NULL, NULL, '$2y$10$M9R5Kp1V5izlT4PBL9XK4OZUq2KunQoGlW8/SmmrDucC1XCqCKwJm', NULL, NULL, 0, NULL, NULL, '2022-12-20 04:53:21', 0),
(2, 'Hashibul', '01670023434', NULL, NULL, NULL, '$2y$10$d1BPqDR1Y5dM/VrEJJEIiuIawN6SrZoYj9aTanFJX4B16JEFb/.om', NULL, NULL, 1, NULL, '2022-12-10 22:04:35', '2022-12-10 22:07:51', 1),
(3, 'Tester', '+88012345', 'tester@test.com', NULL, NULL, NULL, '2342', NULL, 0, NULL, '2022-12-15 14:05:02', '2022-12-15 14:05:02', 0),
(4, 'Tester', '+880123456', 'tester@test.com', NULL, NULL, '$2y$10$VcnAY.EsQvbP3vwGkv5atu9oTDvP6555y7UZI5PU8G.6aM4x0j8jW', NULL, NULL, 1, NULL, '2022-12-15 14:08:19', '2022-12-15 14:08:56', 1),
(5, 'hamdan', '+447375630669', NULL, NULL, NULL, '$2y$10$EsQVzGv9Q.fqzzptWEPhxOKcq/d0VB4ng19HKJVkl3AFDozWx/5LG', NULL, NULL, 1, NULL, '2022-12-29 20:27:42', '2022-12-29 20:28:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_point_histories`
--

CREATE TABLE `user_point_histories` (
  `user_id` int NOT NULL,
  `match_point_id` int NOT NULL,
  `previous_point` decimal(15,2) NOT NULL,
  `current_point` decimal(15,2) NOT NULL,
  `earn_point` decimal(15,2) NOT NULL,
  `is_multiply` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_profiles`
--
ALTER TABLE `basic_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `job_statuses`
--
ALTER TABLE `job_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
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
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `other_dcouments`
--
ALTER TABLE `other_dcouments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passport_profiles`
--
ALTER TABLE `passport_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `professionals`
--
ALTER TABLE `professionals`
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
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_university`
--
ALTER TABLE `subject_university`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_point_histories`
--
ALTER TABLE `user_point_histories`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `match_point_id` (`match_point_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `basic_profiles`
--
ALTER TABLE `basic_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_statuses`
--
ALTER TABLE `job_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `other_dcouments`
--
ALTER TABLE `other_dcouments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `passport_profiles`
--
ALTER TABLE `passport_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professionals`
--
ALTER TABLE `professionals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject_university`
--
ALTER TABLE `subject_university`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
