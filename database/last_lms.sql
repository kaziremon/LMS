-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 27, 2022 at 07:50 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `last_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `course_id`, `user_id`, `name`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'First Batch', 'first-batch', NULL, '2022-06-29 18:58:15', '2022-06-29 18:58:15'),
(2, 1, 1, 'Under First Batch', 'under-first-batch', NULL, '2022-06-29 18:59:25', '2022-06-29 18:59:25'),
(3, 2, 1, '1st batch under 2nd course', '1st-batch-under-2nd-course', NULL, '2022-06-29 18:59:53', '2022-06-29 18:59:53'),
(4, 4, 6, '1st Batch Under 3rd course', '1st-batch-under-3rd-course', NULL, '2022-07-20 12:47:49', '2022-07-20 12:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `learning_outcome` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `subject_id`, `user_id`, `name`, `learning_outcome`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 6, '1st Chapter', 'Learning Outcome', NULL, '2022-06-30 10:43:34', '2022-06-30 10:43:34'),
(2, 2, 6, '1st bangla chapter', 'delete this chapter', '2022-06-30 10:45:37', '2022-06-30 10:43:57', '2022-06-30 10:45:37'),
(3, 2, 6, '3rd chapter', '3rd bangla chapter about nothing', NULL, '2022-06-30 10:44:32', '2022-06-30 10:44:32'),
(4, 3, 6, 'Test Chapter', 'test', NULL, '2022-06-30 17:59:37', '2022-06-30 17:59:37'),
(5, 6, 6, 'Article', 'Article Chapter', NULL, '2022-07-20 17:25:50', '2022-07-20 17:25:50'),
(6, 7, 6, 'Test Chapter', 'jiods fsjdfaso fsdfjoi a', NULL, '2022-07-20 19:35:57', '2022-07-20 19:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `user_id`, `title`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'First Course', NULL, '2022-06-29 17:51:17', '2022-06-29 17:51:17'),
(2, 1, '2nd Course', NULL, '2022-06-29 17:56:33', '2022-06-29 17:56:33'),
(3, 1, 'last test course', '2022-06-29 17:57:09', '2022-06-29 17:56:49', '2022-06-29 17:57:09'),
(4, 6, '3rd Course', NULL, '2022-07-20 12:46:44', '2022-07-20 12:46:44'),
(5, 6, 'Fourth Course', '2022-07-20 12:47:18', '2022-07-20 12:47:00', '2022-07-20 12:47:18'),
(6, 6, 'First Course', NULL, '2022-08-05 21:06:25', '2022-08-05 21:06:25'),
(7, 6, 'FirstCourse', NULL, '2022-08-05 21:09:45', '2022-08-05 21:09:45'),
(8, 6, 'First Course1', '2022-08-08 12:27:22', '2022-08-08 12:27:14', '2022-08-08 12:27:22'),
(9, 6, 'CSE3245', NULL, '2022-08-08 12:31:24', '2022-08-08 12:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `mark_publish` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_title`, `user_id`, `course_id`, `batch_id`, `start_time`, `end_time`, `date`, `status`, `mark_publish`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Test Exam', 6, 2, 3, '01:20 PM', '01:20 PM', '2022-07-06', 1, 0, NULL, '2022-07-01 17:20:22', '2022-07-20 19:41:21'),
(2, 'Mid Exam', 3, 1, 1, '12:01 AM', '03:30 AM', '2022-07-21', 1, 1, NULL, '2022-07-20 18:04:17', '2022-07-20 21:16:00'),
(3, 'Final exam', 6, 1, 1, '12:54 AM', '04:47 AM', '2022-07-23', 0, 0, NULL, '2022-07-20 20:11:42', '2022-07-20 20:11:42'),
(4, 'Temporibus qui maior', 3, 1, 1, '03:34 AM', '03:55 AM', '2022-07-21', 1, 0, NULL, '2022-07-20 21:35:59', '2022-07-20 21:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `setquestion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mark` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`id`, `exam_id`, `subject_id`, `chapter_id`, `setquestion_id`, `mark`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 6, 2, 1, NULL, NULL, NULL),
(2, 1, 1, 1, 7, 2, 1, NULL, NULL, NULL),
(3, 2, 6, 5, 13, 2, 1, NULL, NULL, NULL),
(4, 2, 6, 5, 14, 5, 1, NULL, NULL, NULL),
(5, 2, 6, 5, 15, 5, 1, NULL, NULL, NULL),
(6, 2, 6, 5, 16, 2, 1, NULL, NULL, NULL),
(7, 1, 6, 5, 13, 2, 1, NULL, NULL, NULL),
(8, 1, 6, 5, 14, 5, 1, NULL, NULL, NULL),
(9, 3, 6, 5, 11, 2, 1, NULL, NULL, NULL),
(10, 3, 6, 5, 13, 2, 1, NULL, NULL, NULL),
(11, 3, 6, 5, 14, 5, 1, NULL, NULL, NULL),
(12, 4, 2, 3, 1, 5, 1, NULL, NULL, NULL),
(13, 4, 2, 3, 4, 0, 1, NULL, NULL, NULL);

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `forum_id` bigint(20) UNSIGNED NOT NULL,
  `favourit` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `forum_id`, `favourit`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 6, 1, 1, NULL, NULL, NULL),
(3, 4, 3, 1, NULL, NULL, NULL),
(4, 6, 3, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forget_passwords`
--

CREATE TABLE `forget_passwords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `forumcategory_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `title`, `description`, `forumcategory_id`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Test Tite', 'What is Forum Tell Me', 3, 6, NULL, '2022-06-30 21:17:06', '2022-06-30 21:17:06'),
(2, 'what is title', 'Tell Me about forum', 2, 6, NULL, '2022-06-30 21:17:43', '2022-06-30 21:17:43'),
(3, 'LMS', 'A learning management system (LMS) is a software application or web-based technology used to plan, implement and assess a specific learning process.', 4, 3, NULL, '2022-07-20 19:25:35', '2022-07-20 19:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE `forum_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `name`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Last Forum', 'last-forum', '2022-06-30 21:14:30', '2022-06-30 21:13:47', '2022-06-30 21:14:30'),
(2, '2nd Forum', '2nd-forum', NULL, '2022-06-30 21:13:56', '2022-06-30 21:13:56'),
(3, 'Test Forum', 'test-forum', NULL, '2022-06-30 21:14:12', '2022-06-30 21:14:12'),
(4, 'Thesis', 'thesis', NULL, '2022-07-20 19:24:13', '2022-07-20 19:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `forum_replies`
--

CREATE TABLE `forum_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `forum_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_replies`
--

INSERT INTO `forum_replies` (`id`, `comment`, `user_id`, `forum_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Nice', 6, 1, NULL, '2022-06-30 21:18:23', '2022-06-30 21:18:23'),
(2, 'Test', 6, 1, '2022-06-30 21:19:35', '2022-06-30 21:19:18', '2022-06-30 21:19:35'),
(3, 'Nice', 3, 3, NULL, '2022-07-20 19:25:43', '2022-07-20 19:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `mark_infos`
--

CREATE TABLE `mark_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` bigint(20) UNSIGNED NOT NULL,
  `total_mark` int(11) DEFAULT NULL,
  `obtained_mark` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mark_infos`
--

INSERT INTO `mark_infos` (`id`, `exam_id`, `user_id`, `course_id`, `batch_id`, `total_mark`, `obtained_mark`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 1, 1, 14, 10, NULL, '2022-07-20 19:20:18', '2022-07-20 20:18:32');

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
(15, '2014_10_12_000000_create_users_table', 1),
(16, '2014_10_12_100000_create_password_resets_table', 1),
(17, '2019_08_19_000000_create_failed_jobs_table', 1),
(18, '2021_06_28_171309_create_modules_table', 1),
(19, '2021_06_28_171510_create_permissions_table', 1),
(20, '2021_06_28_172950_create_roles_table', 1),
(21, '2021_06_28_182347_create_permission_role_table', 1),
(22, '2022_06_29_222639_create_courses_table', 2),
(23, '2022_06_29_222737_create_batches_table', 2),
(24, '2022_06_30_024146_create_subjects_table', 3),
(25, '2022_06_30_024321_create_chapters_table', 3),
(26, '2022_06_30_164656_create_question_types_table', 4),
(27, '2022_06_30_165500_create_questions_table', 5),
(28, '2022_06_30_165550_create_set_questions_table', 6),
(29, '2022_06_30_223812_create_question_mcqs_table', 6),
(30, '2022_06_30_224014_create_question_answers_table', 6),
(31, '2022_07_01_023428_create_forum_categories_table', 7),
(32, '2022_07_01_023709_create_forums_table', 7),
(33, '2022_07_01_023722_create_forum_replies_table', 7),
(34, '2022_07_01_023931_create_favourites_table', 7),
(35, '2022_07_01_222649_create_exams_table', 8),
(36, '2022_07_01_222905_create_exam_questions_table', 8),
(37, '2022_07_17_221430_create_submit_exams_table', 9),
(38, '2022_07_17_222114_create_submit_exam_details_table', 9),
(39, '2022_07_17_230536_create_mark_infos_table', 9),
(41, '2022_07_19_224046_create_forget_passwords_table', 10),
(42, '2022_07_20_015741_create_user_assigneds_table', 11),
(43, '2022_07_21_011719_add_user_id_to_mark_infos_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin Dashboard', NULL, '2022-06-27 18:24:07', '2022-06-27 18:24:07'),
(2, 'Role Managment', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(3, 'User Managment', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(4, 'Module Managment', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(5, 'Permission Managment', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(6, 'Course Module', NULL, '2022-06-29 17:37:04', '2022-06-29 17:37:04'),
(7, 'Batch Module', NULL, '2022-06-29 17:37:14', '2022-06-29 17:37:14'),
(8, 'Subject Module', NULL, '2022-06-29 20:58:36', '2022-06-29 20:58:36'),
(9, 'Chapter Module', NULL, '2022-06-29 21:05:01', '2022-06-29 21:05:01'),
(10, 'Question Module System', NULL, '2022-06-30 17:10:02', '2022-06-30 17:10:02'),
(11, 'Set Question Module System', NULL, '2022-06-30 17:10:15', '2022-06-30 17:10:15'),
(12, 'Review System', NULL, '2022-06-30 19:24:59', '2022-06-30 19:24:59'),
(13, 'Admin Review System', NULL, '2022-06-30 19:27:45', '2022-06-30 19:27:45'),
(14, 'Question Bank Question', NULL, '2022-06-30 19:46:21', '2022-06-30 19:46:21'),
(15, 'Forum Category', NULL, '2022-06-30 20:48:52', '2022-06-30 20:48:52'),
(16, 'Forum Module', NULL, '2022-06-30 20:49:02', '2022-06-30 20:49:02'),
(17, 'Exam Module', NULL, '2022-07-01 16:44:50', '2022-07-01 16:44:50'),
(18, 'Evaluation Managment', NULL, '2022-07-17 16:35:20', '2022-07-17 16:35:20'),
(19, 'Markshit Section', NULL, '2022-07-20 20:43:11', '2022-07-20 20:43:11');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module_id`, `name`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Access Main Dashboard', 'home', NULL, '2022-06-27 18:24:08', '2022-06-30 09:32:30'),
(2, 2, 'Access Role', 'roles.index', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(3, 2, 'Create Role', 'roles.create', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(4, 2, 'Edit Role', 'roles.edit', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(5, 2, 'Delete Role', 'roles.destroy', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(6, 3, 'Access User', 'users.index', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(7, 3, 'Create Users', 'users.create', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(8, 3, 'Edit User', 'users.edit', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(9, 3, 'Delete User', 'users.destroy', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(10, 4, 'Access Module', 'modules.index', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(11, 4, 'Create Module', 'modules.create', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(12, 4, 'Edit Module', 'modules.edit', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(13, 4, 'Delete Module', 'modules.destroy', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(14, 5, 'Access Permission', 'permissions.index', NULL, '2022-06-27 18:24:08', '2022-06-27 18:24:08'),
(15, 5, 'Create Permission', 'permissions.create', NULL, '2022-06-27 18:24:09', '2022-06-27 18:24:09'),
(16, 5, 'Edit Permission', 'permissions.edit', NULL, '2022-06-27 18:24:09', '2022-06-27 18:24:09'),
(17, 5, 'Delete Permission', 'permissions.destroy', NULL, '2022-06-27 18:24:09', '2022-06-27 18:24:09'),
(18, 2, 'Admin', 'llksjdfjajf', '2022-06-29 15:02:58', '2022-06-29 15:02:47', '2022-06-29 15:02:58'),
(19, 1, 'Mahadi hasan shakil', 'sdfasf', '2022-06-29 15:12:16', '2022-06-29 15:11:20', '2022-06-29 15:12:16'),
(20, 7, 'Access Batch', 'batch.index', NULL, '2022-06-29 17:46:44', '2022-06-29 17:46:44'),
(21, 7, 'Create Batch', 'batch.create', NULL, '2022-06-29 17:47:07', '2022-06-29 17:47:07'),
(22, 7, 'Edit  Batch', 'batch.edit', NULL, '2022-06-29 17:47:27', '2022-06-29 17:47:27'),
(23, 7, 'Batch Delete', 'batch.destroy', NULL, '2022-06-29 17:47:54', '2022-06-29 17:47:54'),
(24, 6, 'Access Course', 'course.index', NULL, '2022-06-29 17:48:33', '2022-06-29 17:48:33'),
(25, 6, 'Create Course', 'course.create', NULL, '2022-06-29 17:48:57', '2022-06-29 17:48:57'),
(26, 6, 'Edit Course', 'course.edit', NULL, '2022-06-29 17:49:12', '2022-06-29 17:49:12'),
(27, 6, 'Delete Course', 'course.destroy', NULL, '2022-06-29 17:49:44', '2022-06-29 17:49:44'),
(28, 8, 'Access Subject', 'subject.index', NULL, '2022-06-29 20:59:07', '2022-06-29 20:59:07'),
(29, 8, 'Create Subject', 'subject.create', NULL, '2022-06-29 20:59:31', '2022-06-29 20:59:31'),
(30, 8, 'Edit Subject', 'subject.edit', NULL, '2022-06-29 20:59:50', '2022-06-29 20:59:50'),
(31, 8, 'Delete Subject', 'subject.destroy', NULL, '2022-06-29 21:00:20', '2022-06-29 21:00:20'),
(32, 9, 'Access Chapter', 'chapter.index', NULL, '2022-06-30 09:28:49', '2022-06-30 09:28:49'),
(33, 9, 'Create Chapter', 'chapter.create', NULL, '2022-06-30 09:30:57', '2022-06-30 09:30:57'),
(34, 9, 'Update Chapter', 'chapter.edit', NULL, '2022-06-30 09:31:23', '2022-06-30 09:31:23'),
(35, 9, 'Delete Chapter', 'chapter.destroy', NULL, '2022-06-30 09:32:10', '2022-06-30 09:32:10'),
(36, 10, 'Access Question', 'question.index', NULL, '2022-06-30 17:11:08', '2022-06-30 17:11:08'),
(37, 10, 'Create Question', 'question.create', NULL, '2022-06-30 17:12:22', '2022-06-30 17:12:22'),
(38, 10, 'Edit Question', 'question.edit', NULL, '2022-06-30 17:13:02', '2022-06-30 17:13:02'),
(39, 10, 'Delete Question', 'question.destroy', NULL, '2022-06-30 17:13:28', '2022-06-30 17:13:28'),
(40, 10, 'Question Status', 'question.status', NULL, '2022-06-30 17:44:06', '2022-06-30 17:44:06'),
(41, 11, 'Create Question Set', 'question.make', NULL, '2022-06-30 18:01:08', '2022-06-30 18:01:08'),
(42, 11, 'Edit Question Set', 'questionset.edit', NULL, '2022-06-30 18:01:43', '2022-06-30 18:01:43'),
(43, 11, 'Question Set View', 'questionset.preview', NULL, '2022-06-30 18:02:24', '2022-06-30 18:02:24'),
(44, 11, 'Set Of question Single Delete', 'questionset.destroy', NULL, '2022-06-30 18:58:39', '2022-06-30 18:58:39'),
(45, 12, 'Access Review', 'review.index', NULL, '2022-06-30 19:25:22', '2022-06-30 19:25:22'),
(46, 12, 'Edit Review Question', 'review.edit', NULL, '2022-06-30 19:25:57', '2022-06-30 19:25:57'),
(47, 12, 'Review System Status', 'review.status', NULL, '2022-06-30 19:26:35', '2022-06-30 19:26:35'),
(48, 12, 'Review Question Delete', 'review.destroy', NULL, '2022-06-30 19:27:16', '2022-06-30 19:27:16'),
(49, 13, 'Acces Admin Review System', 'admin_review.index', NULL, '2022-06-30 19:28:06', '2022-06-30 19:33:09'),
(50, 14, 'Access Question Bank', 'questionbankquestion.index', NULL, '2022-06-30 19:46:43', '2022-06-30 19:46:43'),
(51, 15, 'Access Forum Category', 'forum_category.index', NULL, '2022-06-30 20:49:33', '2022-06-30 20:49:33'),
(52, 15, 'Create Forum Category', 'forum_category.create', NULL, '2022-06-30 20:50:08', '2022-06-30 20:50:08'),
(53, 15, 'Edit Forum Category', 'forum_category.edit', NULL, '2022-06-30 20:50:45', '2022-06-30 20:50:45'),
(54, 15, 'Delete Forum Category', 'forum_category.destroy', NULL, '2022-06-30 20:51:13', '2022-06-30 20:51:13'),
(55, 16, 'Access Forum', 'forum.index', NULL, '2022-06-30 20:54:45', '2022-06-30 20:54:45'),
(56, 16, 'create Forum', 'forum.create', NULL, '2022-06-30 20:55:11', '2022-06-30 20:55:11'),
(57, 16, 'Edit Forum', 'forum.edit', NULL, '2022-06-30 20:55:41', '2022-06-30 20:55:41'),
(58, 16, 'Forum view', 'forum.details', NULL, '2022-06-30 20:56:17', '2022-06-30 20:56:17'),
(59, 16, 'Forum Delete', 'forum.destroy', NULL, '2022-06-30 20:56:44', '2022-06-30 20:56:44'),
(60, 17, 'Access Exam', 'exam.index', NULL, '2022-07-01 16:45:44', '2022-07-01 16:45:44'),
(61, 17, 'Create Exam', 'exam.create', NULL, '2022-07-01 16:48:05', '2022-07-01 16:48:05'),
(62, 17, 'Edit Exam', 'exam.edit', NULL, '2022-07-01 16:48:54', '2022-07-01 16:48:54'),
(63, 17, 'Exam Delete', 'exam.destroy', NULL, '2022-07-01 16:49:27', '2022-07-01 16:49:27'),
(64, 17, 'Exam Question Set', 'exam.setquestion', NULL, '2022-07-01 16:50:10', '2022-07-01 16:50:10'),
(65, 17, 'Exam Question Preview', 'exam.preview', NULL, '2022-07-01 16:51:04', '2022-07-01 16:51:04'),
(66, 17, 'Delete Exam Question', 'exam.preview_questiondelete', NULL, '2022-07-01 16:51:55', '2022-07-01 16:51:55'),
(67, 17, 'Exam Status', 'exam.status', NULL, '2022-07-01 16:52:24', '2022-07-01 16:52:24'),
(68, 17, 'Exam Mark Publish', 'exam.mark_publish', NULL, '2022-07-01 16:52:52', '2022-07-01 16:52:52'),
(69, 18, 'Evaluation Access', 'exam.evaluation', NULL, '2022-07-17 16:35:51', '2022-07-17 16:35:51'),
(70, 18, 'Evaluation List', 'exam.evaluation_list', NULL, '2022-07-17 16:36:37', '2022-07-17 16:36:37'),
(71, 18, 'Mark Section', 'exam.evulation_mark', NULL, '2022-07-17 16:37:11', '2022-07-17 16:37:11'),
(72, 18, 'Mark View', 'evaluation.view', NULL, '2022-07-17 16:37:53', '2022-07-17 16:37:53'),
(73, 3, 'User Assigned Access', 'user_assigned.index', NULL, '2022-07-19 19:13:16', '2022-07-19 19:13:16'),
(74, 3, 'User Assigned create', 'user_assigned.create', NULL, '2022-07-19 19:13:52', '2022-07-19 19:13:52'),
(75, 3, 'User Assigned Sow', 'user_assigned.show', NULL, '2022-07-19 19:14:20', '2022-07-19 19:14:20'),
(76, 3, 'User Assigned Delete', 'user_assigned.destroy', NULL, '2022-07-19 19:14:45', '2022-07-19 19:14:45'),
(77, 19, 'Mark Access', 'markinfo.index', NULL, '2022-07-20 20:56:41', '2022-07-20 20:56:41'),
(78, 19, 'Teacher Mark Access', 'teacher.markinfo', NULL, '2022-07-21 10:28:13', '2022-07-21 10:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 1, NULL, NULL),
(7, 7, 1, NULL, NULL),
(8, 8, 1, NULL, NULL),
(9, 9, 1, NULL, NULL),
(10, 10, 1, NULL, NULL),
(11, 11, 1, NULL, NULL),
(12, 12, 1, NULL, NULL),
(13, 13, 1, NULL, NULL),
(14, 14, 1, NULL, NULL),
(15, 15, 1, NULL, NULL),
(16, 16, 1, NULL, NULL),
(17, 17, 1, NULL, NULL),
(18, 1, 2, NULL, NULL),
(19, 2, 2, NULL, NULL),
(20, 3, 2, NULL, NULL),
(21, 4, 2, NULL, NULL),
(22, 5, 2, NULL, NULL),
(23, 6, 2, NULL, NULL),
(24, 7, 2, NULL, NULL),
(25, 8, 2, NULL, NULL),
(26, 9, 2, NULL, NULL),
(27, 10, 2, NULL, NULL),
(28, 11, 2, NULL, NULL),
(29, 12, 2, NULL, NULL),
(30, 13, 2, NULL, NULL),
(31, 14, 2, NULL, NULL),
(32, 15, 2, NULL, NULL),
(33, 16, 2, NULL, NULL),
(34, 17, 2, NULL, NULL),
(35, 24, 1, NULL, NULL),
(36, 25, 1, NULL, NULL),
(37, 26, 1, NULL, NULL),
(38, 27, 1, NULL, NULL),
(39, 20, 1, NULL, NULL),
(40, 21, 1, NULL, NULL),
(41, 22, 1, NULL, NULL),
(42, 23, 1, NULL, NULL),
(43, 28, 1, NULL, NULL),
(44, 29, 1, NULL, NULL),
(45, 30, 1, NULL, NULL),
(46, 31, 1, NULL, NULL),
(47, 32, 1, NULL, NULL),
(48, 33, 1, NULL, NULL),
(49, 34, 1, NULL, NULL),
(50, 35, 1, NULL, NULL),
(51, 36, 1, NULL, NULL),
(52, 37, 1, NULL, NULL),
(53, 38, 1, NULL, NULL),
(54, 39, 1, NULL, NULL),
(55, 40, 1, NULL, NULL),
(56, 41, 1, NULL, NULL),
(57, 42, 1, NULL, NULL),
(58, 43, 1, NULL, NULL),
(59, 44, 1, NULL, NULL),
(60, 45, 1, NULL, NULL),
(61, 46, 1, NULL, NULL),
(62, 47, 1, NULL, NULL),
(63, 48, 1, NULL, NULL),
(64, 49, 1, NULL, NULL),
(65, 50, 1, NULL, NULL),
(66, 51, 1, NULL, NULL),
(67, 52, 1, NULL, NULL),
(68, 53, 1, NULL, NULL),
(69, 54, 1, NULL, NULL),
(70, 55, 1, NULL, NULL),
(71, 56, 1, NULL, NULL),
(72, 57, 1, NULL, NULL),
(73, 58, 1, NULL, NULL),
(74, 59, 1, NULL, NULL),
(75, 60, 1, NULL, NULL),
(76, 61, 1, NULL, NULL),
(77, 62, 1, NULL, NULL),
(78, 63, 1, NULL, NULL),
(79, 64, 1, NULL, NULL),
(80, 65, 1, NULL, NULL),
(81, 66, 1, NULL, NULL),
(82, 67, 1, NULL, NULL),
(83, 68, 1, NULL, NULL),
(84, 69, 1, NULL, NULL),
(85, 70, 1, NULL, NULL),
(86, 71, 1, NULL, NULL),
(87, 72, 1, NULL, NULL),
(88, 28, 3, NULL, NULL),
(89, 29, 3, NULL, NULL),
(90, 30, 3, NULL, NULL),
(91, 31, 3, NULL, NULL),
(92, 32, 3, NULL, NULL),
(93, 33, 3, NULL, NULL),
(94, 34, 3, NULL, NULL),
(95, 35, 3, NULL, NULL),
(96, 36, 3, NULL, NULL),
(97, 37, 3, NULL, NULL),
(98, 38, 3, NULL, NULL),
(99, 39, 3, NULL, NULL),
(100, 40, 3, NULL, NULL),
(101, 41, 3, NULL, NULL),
(102, 42, 3, NULL, NULL),
(103, 43, 3, NULL, NULL),
(104, 44, 3, NULL, NULL),
(105, 50, 3, NULL, NULL),
(106, 51, 3, NULL, NULL),
(107, 52, 3, NULL, NULL),
(108, 53, 3, NULL, NULL),
(109, 54, 3, NULL, NULL),
(110, 55, 3, NULL, NULL),
(111, 56, 3, NULL, NULL),
(112, 57, 3, NULL, NULL),
(113, 58, 3, NULL, NULL),
(114, 59, 3, NULL, NULL),
(115, 60, 3, NULL, NULL),
(116, 61, 3, NULL, NULL),
(117, 62, 3, NULL, NULL),
(118, 63, 3, NULL, NULL),
(119, 64, 3, NULL, NULL),
(120, 65, 3, NULL, NULL),
(121, 66, 3, NULL, NULL),
(122, 67, 3, NULL, NULL),
(123, 68, 3, NULL, NULL),
(124, 69, 3, NULL, NULL),
(125, 70, 3, NULL, NULL),
(126, 72, 3, NULL, NULL),
(127, 71, 3, NULL, NULL),
(128, 51, 4, NULL, NULL),
(129, 52, 4, NULL, NULL),
(130, 53, 4, NULL, NULL),
(131, 54, 4, NULL, NULL),
(132, 55, 4, NULL, NULL),
(133, 56, 4, NULL, NULL),
(134, 57, 4, NULL, NULL),
(135, 58, 4, NULL, NULL),
(136, 59, 4, NULL, NULL),
(137, 73, 1, NULL, NULL),
(138, 74, 1, NULL, NULL),
(139, 75, 1, NULL, NULL),
(140, 76, 1, NULL, NULL),
(141, 77, 1, NULL, NULL),
(142, 77, 4, NULL, NULL),
(143, 78, 1, NULL, NULL),
(144, 78, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `questiontype_id` bigint(20) UNSIGNED NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_bank` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `questiontype_id`, `chapter_id`, `user_id`, `is_bank`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 6, 1, NULL, '2022-06-30 17:54:40', '2022-07-01 17:17:37'),
(2, 2, 1, 6, 1, NULL, '2022-06-30 17:55:52', '2022-07-01 17:17:32'),
(3, 3, 3, 6, 0, '2022-06-30 17:59:59', '2022-06-30 17:56:13', '2022-06-30 17:59:59'),
(4, 3, 4, 6, 1, NULL, '2022-06-30 17:59:48', '2022-06-30 19:00:03'),
(5, 2, 5, 6, 1, NULL, '2022-07-20 17:28:55', '2022-07-20 17:42:43'),
(6, 1, 5, 6, 1, NULL, '2022-07-20 17:38:06', '2022-07-20 17:42:36'),
(7, 3, 5, 6, 1, NULL, '2022-07-20 17:39:58', '2022-07-20 17:41:23'),
(8, 1, 6, 6, 0, NULL, '2022-07-20 19:36:39', '2022-07-20 19:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `question_answers`
--

CREATE TABLE `question_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setquestion_id` bigint(20) UNSIGNED NOT NULL,
  `answer` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_answers`
--

INSERT INTO `question_answers` (`id`, `setquestion_id`, `answer`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 1, NULL, '2022-06-30 18:46:59', '2022-06-30 18:46:59'),
(2, 7, 6, NULL, '2022-06-30 18:50:30', '2022-06-30 18:50:30'),
(3, 8, 9, NULL, '2022-06-30 18:50:30', '2022-06-30 18:50:30'),
(4, 10, 15, NULL, '2022-06-30 18:54:33', '2022-06-30 18:54:33'),
(5, 11, 17, NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(6, 12, 23, NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(7, 13, 25, NULL, '2022-07-20 17:36:44', '2022-07-20 17:36:44'),
(8, 16, 30, NULL, '2022-07-20 17:41:15', '2022-07-20 17:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `question_mcqs`
--

CREATE TABLE `question_mcqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setquestion_id` bigint(20) UNSIGNED NOT NULL,
  `option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_mcqs`
--

INSERT INTO `question_mcqs` (`id`, `setquestion_id`, `option`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 'is', NULL, '2022-06-30 18:46:59', '2022-06-30 18:46:59'),
(2, 6, 'are', NULL, '2022-06-30 18:46:59', '2022-06-30 18:46:59'),
(3, 6, 'also', NULL, '2022-06-30 18:46:59', '2022-06-30 18:46:59'),
(4, 6, 'have', NULL, '2022-06-30 18:46:59', '2022-06-30 18:46:59'),
(5, 7, 'across', NULL, '2022-06-30 18:50:29', '2022-06-30 18:50:29'),
(6, 7, 'besides', NULL, '2022-06-30 18:50:29', '2022-06-30 18:50:29'),
(7, 7, 'besid', NULL, '2022-06-30 18:50:29', '2022-06-30 18:50:29'),
(8, 7, 'both', NULL, '2022-06-30 18:50:30', '2022-06-30 18:50:30'),
(9, 8, 'out of', NULL, '2022-06-30 18:50:30', '2022-06-30 18:50:30'),
(10, 8, 'over', NULL, '2022-06-30 18:50:30', '2022-06-30 18:50:30'),
(11, 8, 'on', NULL, '2022-06-30 18:50:30', '2022-06-30 18:50:30'),
(12, 8, 'in', NULL, '2022-06-30 18:50:30', '2022-06-30 18:50:30'),
(13, 10, 'for', NULL, '2022-06-30 18:54:32', '2022-06-30 18:54:32'),
(14, 10, 'against', NULL, '2022-06-30 18:54:32', '2022-06-30 18:54:32'),
(15, 10, 'at', NULL, '2022-06-30 18:54:32', '2022-06-30 18:54:32'),
(16, 10, 'from', NULL, '2022-06-30 18:54:33', '2022-06-30 18:54:33'),
(17, 11, 'A,The', NULL, '2022-07-20 17:36:42', '2022-07-20 17:36:42'),
(18, 11, 'An,The', NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(19, 11, 'The,A', NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(20, 11, 'The,An', NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(21, 12, 'A', NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(22, 12, 'An', NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(23, 12, 'The', NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(24, 12, 'none of these', NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(25, 13, 'A', NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(26, 13, 'An', NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(27, 13, 'The', NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(28, 13, 'None Of these', NULL, '2022-07-20 17:36:44', '2022-07-20 17:36:44'),
(29, 16, 'A', NULL, '2022-07-20 17:41:14', '2022-07-20 17:41:14'),
(30, 16, 'An', NULL, '2022-07-20 17:41:14', '2022-07-20 17:41:14'),
(31, 16, 'The', NULL, '2022-07-20 17:41:15', '2022-07-20 17:41:15'),
(32, 16, 'None Of These', NULL, '2022-07-20 17:41:15', '2022-07-20 17:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `question_types`
--

CREATE TABLE `question_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_types`
--

INSERT INTO `question_types` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Written Question', NULL, '2022-06-30 10:52:37', '2022-06-30 10:52:37'),
(2, 'MCQ Question', NULL, '2022-06-30 10:52:37', '2022-06-30 10:52:37'),
(3, 'Combined', NULL, '2022-06-30 10:52:37', '2022-06-30 10:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delteable` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `delteable`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', 'This is Super Admin', 0, NULL, '2022-06-27 18:24:09', '2022-06-27 18:24:09'),
(2, 'Admin', 'admin', 'This is Admin', 0, NULL, '2022-06-27 18:24:10', '2022-06-27 18:24:10'),
(3, 'Teacher', 'teacher', 'This is Teacher', 1, NULL, '2022-06-27 18:24:10', '2022-06-27 18:24:10'),
(4, 'Student', 'student', 'This is Student', 1, NULL, '2022-06-27 18:24:10', '2022-06-27 18:24:10');

-- --------------------------------------------------------

--
-- Table structure for table `set_questions`
--

CREATE TABLE `set_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `mark` int(11) NOT NULL,
  `rubric` longtext COLLATE utf8mb4_unicode_ci,
  `defficult_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `draft` tinyint(4) DEFAULT '1',
  `status` tinyint(4) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `set_questions`
--

INSERT INTO `set_questions` (`id`, `question_id`, `subject_id`, `chapter_id`, `user_id`, `question`, `mark`, `rubric`, `defficult_level`, `draft`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, 6, 'what is grammer ?', 5, '1 example Must', 'Easy', 0, 1, NULL, '2022-06-30 18:43:12', '2022-06-30 18:43:12'),
(2, 1, 2, 3, 6, 'what is Voice?', 5, 'With One Example', 'Easy', 1, 0, NULL, '2022-06-30 18:45:22', '2022-06-30 18:45:22'),
(3, 1, 2, 3, 6, 'what is Sentence', 5, '', 'Medium', 1, 0, NULL, '2022-06-30 18:45:22', '2022-06-30 18:45:22'),
(4, 1, 2, 3, 6, 'what is Synonyms?', 0, 'One Example Must', 'Hard', 0, 1, NULL, '2022-06-30 18:45:22', '2022-06-30 18:45:22'),
(6, 2, 1, 1, 6, 'Our country is spiritual country, theirs . . . . . . religious?', 2, NULL, 'Easy', 0, 1, NULL, '2022-06-30 18:46:59', '2022-06-30 18:46:59'),
(7, 2, 1, 1, 6, 'Our sir teaches Mathematics . . . . . . English.', 2, NULL, 'Medium', 0, 1, NULL, '2022-06-30 18:50:29', '2022-06-30 18:50:29'),
(8, 2, 1, 1, 6, 'Please, come . . . . . . the bathroom.', 2, NULL, 'Hard', 1, 0, NULL, '2022-06-30 18:50:30', '2022-06-30 18:50:30'),
(9, 4, 3, 4, 6, 'what is tense', 5, 'Must be one  Example', 'Easy', 0, 1, NULL, '2022-06-30 18:54:32', '2022-06-30 18:54:32'),
(10, 4, 3, 4, 6, 'Please, don’t laugh . . . . . . those beggars.', 2, NULL, 'Medium', 1, 0, NULL, '2022-06-30 18:54:32', '2022-06-30 18:54:32'),
(11, 5, 6, 5, 6, 'There is __ cat in __ garden.', 2, NULL, 'Hard', 0, 1, NULL, '2022-07-20 17:36:42', '2022-07-20 17:36:42'),
(12, 5, 6, 5, 6, '__ setting sun gives a beautiful sight.', 2, NULL, 'Medium', 1, 0, NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(13, 5, 6, 5, 6, 'Swimming is __good exercise.', 2, NULL, 'Easy', 0, 1, NULL, '2022-07-20 17:36:43', '2022-07-20 17:36:43'),
(14, 6, 6, 5, 6, 'what is article?', 5, 'Including two examples.', 'Easy', 0, 1, NULL, '2022-07-20 17:39:39', '2022-07-20 17:39:39'),
(15, 7, 6, 5, 6, 'How do we write article?', 5, '', 'Easy', 0, 1, NULL, '2022-07-20 17:41:14', '2022-07-20 17:41:14'),
(16, 7, 6, 5, 6, 'Our state covers __ area of 88,752 sq kms.', 2, '', 'Medium', 0, 1, NULL, '2022-07-20 17:41:14', '2022-07-20 17:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `title`, `slug`, `description`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Engilish', 'engilish', 'English Subject', 6, NULL, '2022-06-30 09:22:35', '2022-06-30 09:22:35'),
(2, 'Bangla', 'bangla', '', 6, NULL, '2022-06-30 09:23:47', '2022-06-30 09:23:47'),
(3, 'Computer', 'computer', '', 6, NULL, '2022-06-30 09:24:42', '2022-06-30 09:24:42'),
(4, 'Test', 'test', '', 6, '2022-06-30 09:26:36', '2022-06-30 09:26:30', '2022-06-30 09:26:36'),
(5, 'last check', 'last-check', '', 6, '2022-06-30 09:27:20', '2022-06-30 09:27:14', '2022-06-30 09:27:20'),
(6, 'English 2nd Paper', 'english-2nd-paper', '2nd paper', 6, NULL, '2022-07-20 17:21:41', '2022-07-20 17:21:41'),
(7, 'Test subject', 'test-subject', '', 6, NULL, '2022-07-20 19:35:24', '2022-07-20 19:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `submit_exams`
--

CREATE TABLE `submit_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submit_exams`
--

INSERT INTO `submit_exams` (`id`, `user_id`, `exam_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 2, NULL, '2022-07-20 18:19:26', '2022-07-20 18:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `submit_exam_details`
--

CREATE TABLE `submit_exam_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `submitexam_id` bigint(20) UNSIGNED NOT NULL,
  `setquestion_id` bigint(20) UNSIGNED NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci,
  `mark` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submit_exam_details`
--

INSERT INTO `submit_exam_details` (`id`, `submitexam_id`, `setquestion_id`, `answer`, `mark`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 13, '27', 2, NULL, '2022-07-20 18:19:27', '2022-07-20 20:18:32'),
(2, 1, 14, 'bwahduihaod fufuhao sfhfshi', 5, NULL, '2022-07-20 18:19:27', '2022-07-20 20:18:32'),
(3, 1, 15, '', 3, NULL, '2022-07-20 18:19:27', '2022-07-20 20:18:32'),
(4, 1, 16, '31', 0, NULL, '2022-07-20 18:19:27', '2022-07-20 20:18:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `batch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `course_id`, `batch_id`, `teacher_id`, `student_id`, `name`, `full_name`, `email`, `email_verified_at`, `password`, `profile_pic`, `is_active`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, 'Super Admin', 'Super Admin', 'superadmin@gmail.com', NULL, '$2y$10$rcw4RClvtMDAeY.ikFInmeBEP6F6r8xxDpygrPIeJv7OmMDefmuWa', '', 1, NULL, NULL, '2022-06-27 18:24:11', '2022-06-27 18:24:11'),
(2, 2, NULL, NULL, NULL, NULL, 'Admin', 'Admin', 'admin@gmail.com', NULL, '$2y$10$CSv0wPfSW2OQx6yuygRA5.E44bhdUh0zWA6Msjd48niS.Bj0WwzI.', '', 1, NULL, NULL, '2022-06-27 18:24:11', '2022-06-27 18:24:11'),
(3, 3, 1, 1, NULL, NULL, 'Teacher', 'Teacher', 'teacher@gmail.com', NULL, '$2y$10$1lhwKedDQxK9q5UB5Vb2I.HbGs6MY93BC/qut25NoYMHG82QJaUlW', '', 1, NULL, NULL, '2022-06-27 18:24:11', '2022-07-20 12:25:52'),
(4, 4, 1, 1, NULL, NULL, 'Student', 'Student', 'student@gmail.com', NULL, '$2y$10$47i.HRFPl89vgWCSbP/HNui3XFIvitmtXM.ltkAcQcWGJ/GzM2eAu', '', 1, NULL, NULL, '2022-06-27 18:24:11', '2022-07-19 21:00:18'),
(5, 4, NULL, NULL, NULL, NULL, 'siqave', 'Althea Bates', 'cizeqoryr@mailinator.com', NULL, '$2y$10$l2Kz1jAzbfP.pajmv3aNc.8uEQ/gzC87utUMMkGmAzpwgvxABq7Bq', 'uploads/profile_pic/IMG_20190105_224723_674_62bcb4d42a5e2.jpg', 1, NULL, NULL, '2022-06-29 20:23:48', '2022-06-29 20:23:48'),
(6, 1, NULL, NULL, NULL, NULL, 'shakil', 'Mahadi Hasan Shakil', 'shakil3334426@gmail.com', NULL, '$2y$10$/x.M/iXclKWuHzlePMPRauXrqIXg1AwyD6VNEOsxe6yOwt.SavDmG', 'uploads/profile_pic/IMG_20190105_224723_674_62dae9d3f17c9.jpg', 1, NULL, NULL, '2022-06-29 20:24:34', '2022-07-22 18:17:55'),
(7, 4, NULL, NULL, NULL, NULL, 'student1', 'Gregory Gutierrez', 'qybubavu@mailinator.com', NULL, '$2y$10$fq6MAFr/cS.D76oJ2YZ5euN2fx.h3C2eCrU.eEmfcaTxE0TGn.Udi', '0', 1, NULL, NULL, '2022-07-20 12:37:19', '2022-07-20 12:37:19'),
(8, 3, NULL, NULL, NULL, NULL, 'sybumezoq', 'Dieter Mckenzie', 'wugikaho@mailinator.com', NULL, '$2y$10$Zr6W6KwhvA7t/onHoP4oDemHVuufMuADpmqUwnCZPH/8kuEx9GqHm', '0', 1, NULL, NULL, '2022-07-21 11:14:43', '2022-07-21 11:14:43'),
(13, 3, NULL, NULL, NULL, NULL, 'ashraf1', 'ashraful islam', 'ashrafnub1223@gmail.com', NULL, '$2y$10$215ZIR7kBhLbYRvlWfsFb.eECwqtp6kTC2RcBhmXP3OqIf3bRdHQ2', '0', 1, NULL, NULL, '2022-07-21 13:09:39', '2022-07-21 13:09:39'),
(14, 3, NULL, NULL, NULL, NULL, 'dysogajyr', 'Tana Medina', 'shakil3334413@gmail.com', NULL, '$2y$10$zEHJLfuBGutwuNA3AJd/g.Rzg.jTRhl4iltVKjXDIsD096DhtV3By', '0', 1, NULL, NULL, '2022-07-22 20:19:24', '2022-07-22 20:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_assigneds`
--

CREATE TABLE `user_assigneds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `batch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_assigneds`
--

INSERT INTO `user_assigneds` (`id`, `user_id`, `role_id`, `course_id`, `batch_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 1, 1, NULL, '2022-07-19 21:00:18', '2022-07-19 21:00:18'),
(2, 3, 3, 2, 3, '2022-07-20 12:26:07', '2022-07-19 21:06:02', '2022-07-20 12:26:07'),
(3, 3, 3, 1, 1, NULL, '2022-07-20 12:25:52', '2022-07-20 12:25:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batches_user_id_foreign` (`user_id`),
  ADD KEY `batches_course_id_foreign` (`course_id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapters_subject_id_foreign` (`subject_id`),
  ADD KEY `chapters_user_id_foreign` (`user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_user_id_foreign` (`user_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_course_id_foreign` (`course_id`),
  ADD KEY `exams_user_id_foreign` (`user_id`),
  ADD KEY `exams_batch_id_foreign` (`batch_id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_questions_exam_id_foreign` (`exam_id`),
  ADD KEY `exam_questions_subject_id_foreign` (`subject_id`),
  ADD KEY `exam_questions_chapter_id_foreign` (`chapter_id`),
  ADD KEY `exam_questions_setquestion_id_foreign` (`setquestion_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourites_user_id_foreign` (`user_id`),
  ADD KEY `favourites_forum_id_foreign` (`forum_id`);

--
-- Indexes for table `forget_passwords`
--
ALTER TABLE `forget_passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forums_forumcategory_id_foreign` (`forumcategory_id`),
  ADD KEY `forums_user_id_foreign` (`user_id`);

--
-- Indexes for table `forum_categories`
--
ALTER TABLE `forum_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_replies`
--
ALTER TABLE `forum_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_replies_user_id_foreign` (`user_id`),
  ADD KEY `forum_replies_forum_id_foreign` (`forum_id`);

--
-- Indexes for table `mark_infos`
--
ALTER TABLE `mark_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mark_infos_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
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
  ADD KEY `permissions_module_id_foreign` (`module_id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_user_id_foreign` (`user_id`),
  ADD KEY `questions_questiontype_id_foreign` (`questiontype_id`),
  ADD KEY `questions_chapter_id_foreign` (`chapter_id`);

--
-- Indexes for table `question_answers`
--
ALTER TABLE `question_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_answers_setquestion_id_foreign` (`setquestion_id`),
  ADD KEY `question_answers_answer_foreign` (`answer`);

--
-- Indexes for table `question_mcqs`
--
ALTER TABLE `question_mcqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_mcqs_setquestion_id_foreign` (`setquestion_id`);

--
-- Indexes for table `question_types`
--
ALTER TABLE `question_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_questions`
--
ALTER TABLE `set_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `set_questions_question_id_foreign` (`question_id`),
  ADD KEY `set_questions_subject_id_foreign` (`subject_id`),
  ADD KEY `set_questions_chapter_id_foreign` (`chapter_id`),
  ADD KEY `set_questions_user_id_foreign` (`user_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjects_user_id_foreign` (`user_id`);

--
-- Indexes for table `submit_exams`
--
ALTER TABLE `submit_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submit_exams_exam_id_foreign` (`exam_id`),
  ADD KEY `submit_exams_user_id_foreign` (`user_id`);

--
-- Indexes for table `submit_exam_details`
--
ALTER TABLE `submit_exam_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submit_exam_details_submitexam_id_foreign` (`submitexam_id`),
  ADD KEY `submit_exam_details_setquestion_id_foreign` (`setquestion_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_assigneds`
--
ALTER TABLE `user_assigneds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_assigneds_user_id_foreign` (`user_id`),
  ADD KEY `user_assigneds_role_id_foreign` (`role_id`),
  ADD KEY `user_assigneds_course_id_foreign` (`course_id`),
  ADD KEY `user_assigneds_batch_id_foreign` (`batch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forget_passwords`
--
ALTER TABLE `forget_passwords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forum_categories`
--
ALTER TABLE `forum_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forum_replies`
--
ALTER TABLE `forum_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mark_infos`
--
ALTER TABLE `mark_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `question_answers`
--
ALTER TABLE `question_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `question_mcqs`
--
ALTER TABLE `question_mcqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `question_types`
--
ALTER TABLE `question_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `set_questions`
--
ALTER TABLE `set_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `submit_exams`
--
ALTER TABLE `submit_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submit_exam_details`
--
ALTER TABLE `submit_exam_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_assigneds`
--
ALTER TABLE `user_assigneds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batches`
--
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `batches_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chapters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exams_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_questions_setquestion_id_foreign` FOREIGN KEY (`setquestion_id`) REFERENCES `set_questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_questions_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_forum_id_foreign` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forums`
--
ALTER TABLE `forums`
  ADD CONSTRAINT `forums_forumcategory_id_foreign` FOREIGN KEY (`forumcategory_id`) REFERENCES `forum_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forums_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forum_replies`
--
ALTER TABLE `forum_replies`
  ADD CONSTRAINT `forum_replies_forum_id_foreign` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mark_infos`
--
ALTER TABLE `mark_infos`
  ADD CONSTRAINT `mark_infos_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_questiontype_id_foreign` FOREIGN KEY (`questiontype_id`) REFERENCES `question_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_answers`
--
ALTER TABLE `question_answers`
  ADD CONSTRAINT `question_answers_answer_foreign` FOREIGN KEY (`answer`) REFERENCES `question_mcqs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_answers_setquestion_id_foreign` FOREIGN KEY (`setquestion_id`) REFERENCES `set_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_mcqs`
--
ALTER TABLE `question_mcqs`
  ADD CONSTRAINT `question_mcqs_setquestion_id_foreign` FOREIGN KEY (`setquestion_id`) REFERENCES `set_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `set_questions`
--
ALTER TABLE `set_questions`
  ADD CONSTRAINT `set_questions_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `set_questions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `set_questions_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `set_questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submit_exams`
--
ALTER TABLE `submit_exams`
  ADD CONSTRAINT `submit_exams_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submit_exams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submit_exam_details`
--
ALTER TABLE `submit_exam_details`
  ADD CONSTRAINT `submit_exam_details_setquestion_id_foreign` FOREIGN KEY (`setquestion_id`) REFERENCES `set_questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submit_exam_details_submitexam_id_foreign` FOREIGN KEY (`submitexam_id`) REFERENCES `submit_exams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_assigneds`
--
ALTER TABLE `user_assigneds`
  ADD CONSTRAINT `user_assigneds_batch_id_foreign` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_assigneds_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_assigneds_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_assigneds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
