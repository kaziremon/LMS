-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 07, 2021 at 04:04 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment_topics`
--

CREATE TABLE `assignment_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `dua_date` date NOT NULL,
  `assignment_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topics` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marks_distribution` text COLLATE utf8mb4_unicode_ci,
  `marks` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `evalutions_file` varchar(333) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignment_topics`
--

INSERT INTO `assignment_topics` (`id`, `group_id`, `batch_id`, `dua_date`, `assignment_file`, `topics`, `marks_distribution`, `marks`, `evalutions_file`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 12, 2, '2021-12-01', 'uploads/assignment_file/1638820474.png', 'test2', 'ttest', '44', 'uploads/evalution_file/1638820490.png', NULL, '2021-12-06 19:54:34', '2021-12-06 19:54:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment_topics`
--
ALTER TABLE `assignment_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignment_topics_group_id_foreign` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment_topics`
--
ALTER TABLE `assignment_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment_topics`
--
ALTER TABLE `assignment_topics`
  ADD CONSTRAINT `assignment_topics_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `assignment_groups` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
