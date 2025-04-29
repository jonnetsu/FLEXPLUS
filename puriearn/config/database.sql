-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 11:36 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puriearn`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_details`
--

CREATE TABLE `account_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `reference` varchar(225) DEFAULT NULL,
  `expiry_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `location` varchar(225) DEFAULT NULL,
  `phone` varchar(225) DEFAULT NULL,
  `level` int(100) DEFAULT 1,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `fullname`, `email`, `location`, `phone`, `level`, `password`, `updationDate`) VALUES
(1, 'admin', '', '', '', '09023334673', 10, '$2y$10$Homv1ffzvLOJcDm9b3fgs./wyHjCDML0W005Mqo4.02qFFu1snkSa', '06-07-2023 10:27:40 AM');

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

CREATE TABLE `adminlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlog`
--

INSERT INTO `adminlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(52, 1, 'admin', 0x3132372e302e302e3100000000000000, '2023-07-21 08:45:25', NULL, 1),
(53, 1, 'admin', 0x3132372e302e302e3100000000000000, '2023-09-02 14:15:09', NULL, 1),
(54, 1, 'admin', 0x3132372e302e302e3100000000000000, '2023-09-10 23:53:29', NULL, 1),
(55, 1, 'admin', 0x3132372e302e302e3100000000000000, '2023-09-12 23:18:15', NULL, 1),
(56, 1, 'admin', 0x3132372e302e302e3100000000000000, '2023-09-13 01:59:39', NULL, 1),
(57, 1, 'admin', 0x3132372e302e302e3100000000000000, '2023-09-13 11:36:34', NULL, 1),
(58, 1, 'admin', 0x3132372e302e302e3100000000000000, '2023-09-26 22:25:09', NULL, 1),
(59, 1, 'admin', 0x3132372e302e302e3100000000000000, '2023-10-04 19:44:27', NULL, 1),
(60, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-04-03 10:03:18', NULL, 1),
(61, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-04-03 23:03:34', '05-04-2024 04:44:46 AM', 1),
(62, 5, 'majorp', 0x3132372e302e302e3100000000000000, '2024-04-04 23:14:52', NULL, 1),
(63, 0, 'admin', 0x3132372e302e302e3100000000000000, '2024-05-24 20:31:46', NULL, 0),
(64, 0, 'majorp', 0x3132372e302e302e3100000000000000, '2024-05-24 20:31:54', NULL, 0),
(65, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-05-24 20:34:08', NULL, 1),
(66, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-05-24 22:20:31', NULL, 1),
(67, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-05-25 10:19:23', NULL, 1),
(68, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-05-25 20:18:05', NULL, 1),
(69, 1, 'admin', 0x3139322e3136382e34332e3100000000, '2024-05-25 23:44:36', NULL, 1),
(70, 1, 'admin', 0x3139322e3136382e34332e3100000000, '2024-05-26 00:04:00', NULL, 1),
(71, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-05-26 00:07:28', NULL, 1),
(72, 5, 'majorp', 0x3132372e302e302e3100000000000000, '2024-05-26 19:11:17', NULL, 1),
(73, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-05-30 07:46:06', NULL, 1),
(74, 0, 'admin', 0x3132372e302e302e3100000000000000, '2024-06-13 09:46:41', NULL, 0),
(75, 0, 'majorp', 0x3132372e302e302e3100000000000000, '2024-06-13 09:46:47', NULL, 0),
(76, 0, 'majorp', 0x3132372e302e302e3100000000000000, '2024-06-13 09:46:54', NULL, 0),
(77, 0, 'admin', 0x3132372e302e302e3100000000000000, '2024-06-13 09:47:02', NULL, 0),
(78, 0, 'devmajorp', 0x3132372e302e302e3100000000000000, '2024-06-13 09:47:12', NULL, 0),
(79, 0, 'majorp', 0x3132372e302e302e3100000000000000, '2024-06-13 10:00:58', NULL, 0),
(80, 0, 'majorp', 0x3132372e302e302e3100000000000000, '2024-06-13 10:01:06', NULL, 0),
(81, 0, 'admin', 0x3132372e302e302e3100000000000000, '2024-06-13 10:05:59', NULL, 0),
(82, 0, 'majorp', 0x3132372e302e302e3100000000000000, '2024-06-13 10:06:11', NULL, 0),
(83, 0, 'majorp', 0x3132372e302e302e3100000000000000, '2024-06-13 10:08:43', NULL, 0),
(84, 0, 'admin', 0x3132372e302e302e3100000000000000, '2024-06-13 10:09:03', NULL, 0),
(85, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-06-13 10:11:09', NULL, 1),
(86, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-06-13 16:03:29', NULL, 1),
(87, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-06-15 07:45:47', NULL, 1),
(88, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-06-15 15:11:30', NULL, 1),
(89, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-06-17 09:35:39', NULL, 1),
(90, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-06-18 14:15:19', NULL, 1),
(91, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-06-20 06:09:23', NULL, 1),
(92, 1, 'admin', 0x3132372e302e302e3100000000000000, '2024-06-20 07:15:38', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `approval_logs`
--

CREATE TABLE `approval_logs` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `action` enum('approve','reject') NOT NULL,
  `action_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Telegram Follow', '2024-06-11 02:24:09', '0000-00-00 00:00:00'),
(2, 'Website Signup', '2024-06-11 02:24:09', '2024-06-11 02:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `claim_task`
--

CREATE TABLE `claim_task` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `amount` varchar(225) DEFAULT NULL,
  `coupon_code` varchar(225) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `used_by` varchar(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `vendor_id`, `plan_id`, `amount`, `coupon_code`, `status`, `used_by`, `created_at`) VALUES
(1, 0, 1, '3000', 'EARU1BY5KH03', 1, 'john', '2023-06-17 22:41:13'),
(2, 0, 1, '3000', 'EARQ46X5C79D', 1, 'Eb', '2023-06-18 06:55:53'),
(6911, 1, 1, '4500', 'MAJ7YRV8QFZE', 0, NULL, '2024-06-08 11:40:32'),
(6912, 1, 1, '4500', 'MAJWVNOBOOXJ', 0, NULL, '2024-06-08 11:57:55'),
(6913, 1, 1, '4500', 'MAJBF3S8FTJG', 0, NULL, '2024-06-08 11:58:46'),
(6914, 1, 1, '4500', 'MAJNERW1KQBK', 0, NULL, '2024-06-08 11:59:03'),
(6915, 1, 1, '4500', 'MAJ7W1RCZZK0', 0, NULL, '2024-06-08 11:59:19'),
(6916, 20, 1, '4500', 'EBIN3WP5NVW', 0, NULL, '2024-06-10 22:09:47'),
(6917, 20, 1, '4500', 'EBIJEFC1LFF', 0, NULL, '2024-06-10 22:10:28'),
(6918, 1, 1, '4500', 'MAJ5XOI302Y2', 0, NULL, '2024-06-10 22:18:23'),
(6919, 1, 1, '3000', 'MAJWXDS1VU1Z', 0, NULL, '2024-06-10 22:19:42'),
(6920, 1, 1, '3000', 'MAJFAGZ6P2FX', 0, NULL, '2024-06-10 22:20:32'),
(6921, 20, 1, '3000', 'EB6N4Y13LUS', 0, NULL, '2024-06-10 22:21:45'),
(6922, 1, 1, '3000', 'MAJ7Z7PY9P48', 0, NULL, '2024-06-10 22:21:47'),
(6923, 20, 1, '3000', 'EBWCCTVIBV6', 0, NULL, '2024-06-10 22:23:20'),
(6924, 1, 1, '3000', 'MAJHRPVLK9LU', 0, NULL, '2024-06-10 22:23:40'),
(6925, 1, 1, '3000', 'MAJFR73UWD1S', 0, NULL, '2024-06-10 22:23:49'),
(6926, 0, 1, '3000', 'PUR69MCGTA44', 0, NULL, '2024-06-13 11:37:24'),
(6927, 0, 1, '3000', 'PURG6CUPW7HJ', 0, NULL, '2024-06-13 11:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `digital_courses`
--

CREATE TABLE `digital_courses` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `book_name` varchar(225) DEFAULT NULL,
  `amount` varchar(225) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `filename` varchar(50) DEFAULT NULL,
  `filepath` varchar(100) DEFAULT NULL,
  `image_filepath` varchar(225) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `digital_courses`
--

INSERT INTO `digital_courses` (`id`, `user_id`, `type`, `book_name`, `amount`, `description`, `filename`, `filepath`, `image_filepath`, `creationDate`, `updationDate`) VALUES
(2, 1, 1, 'First Book', '2000', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1685320606_letter_of_recommendation.pdf', 'ebooks/pdfs/1685319192_letter_of_recommendation.pdf', 'ebooks/images/1.webp', '2023-05-29 01:13:12', '30-11-2023 02:29:24 PM'),
(3, 2, 1, 'Second Book', '1000', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1685319585_letter_of_recommendation.pdf', 'ebooks/pdfs/1685319585_letter_of_recommendation.pdf', 'ebooks/images/2.jpg', '2023-05-29 01:19:45', NULL),
(4, 1, 1, 'Third Book', '25000', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1685319587_letter_of_recommendation.pdf', 'ebooks/pdfs/1685319587_letter_of_recommendation.pdf', 'ebooks/images/4.webp', '2023-05-29 01:19:47', NULL),
(5, 1, 2, 'Fourth Book', '18000', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1685319589_letter_of_recommendation.pdf', 'ebooks/pdfs/1685319589_letter_of_recommendation.pdf', 'ebooks/images/3.jpg', '2023-05-29 01:19:49', NULL),
(6, 1, 2, 'Fifty Book', '12000', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1685320603_letter_of_recommendation.pdf', 'ebooks/pdfs/1685320603_letter_of_recommendation.pdf', 'ebooks/images/5.jpg', '2023-05-29 01:36:44', NULL),
(7, 2, 2, 'Zoom + Google Classroom: 2 Books in 1 - 2020 Complete ', '23000', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1685320605_letter_of_recommendation.pdf', 'ebooks/pdfs/1685320605_letter_of_recommendation.pdf', 'ebooks/images/6.jpg', '2023-05-29 01:36:45', NULL),
(8, 1, 1, 'Online Course Creation: Learn How to Use Your Knowledge and ...', '4500', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1685320606_letter_of_recommendation.pdf', 'ebooks/pdfs/1685320606_letter_of_recommendation.pdf', 'ebooks/images/7.jpg', '2023-05-29 01:36:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `earning_history`
--

CREATE TABLE `earning_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` varchar(225) DEFAULT NULL,
  `type` varchar(225) DEFAULT 'Affiliate',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `earning_history`
--

INSERT INTO `earning_history` (`id`, `user_id`, `amount`, `type`, `created_at`) VALUES
(1, 1, '2000', 'Affiliate', '2024-06-06 11:48:45'),
(2, 1, '250', 'Affiliate', '2024-06-06 11:48:21'),
(1264, 1, '250', 'Job', '2024-06-06 11:48:37'),
(13169, 1, '2000', 'Affiliate', '2024-06-06 11:48:30'),
(13170, 4, '250', 'Affiliate', '2023-11-17 07:56:59'),
(13171, 1, '1700', 'Job', '2024-06-06 11:48:42'),
(13172, 1, '200', 'Affiliate', '2024-06-06 11:32:58'),
(13173, 18, '1700', 'Affiliate', '2024-06-06 11:39:36'),
(13174, 1, '200', 'Affiliate', '2024-06-06 11:39:36'),
(13175, 18, '1700', 'Affiliate', '2024-06-08 10:44:28'),
(13176, 1, '200', 'Affiliate', '2024-06-08 10:44:28'),
(13177, 1, '500', 'Affiliate', '2024-06-13 10:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_url` varchar(225) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_url`, `status`, `created_at`) VALUES
(9, '1717715123819.jpg', 1, '2024-05-25 23:49:46'),
(13, '1717715260784.jpg', 1, '2024-06-11 00:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `job_adverts`
--

CREATE TABLE `job_adverts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `task_url` varchar(255) DEFAULT NULL,
  `amount_per_task` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `num_tasks` int(11) DEFAULT NULL,
  `num_completed` varchar(111) DEFAULT NULL,
  `banner` varchar(225) DEFAULT NULL,
  `screenshots_required` tinyint(1) DEFAULT 0,
  `num_screenshots` int(11) DEFAULT 0,
  `sample_screenshots` text DEFAULT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `completed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_adverts`
--

INSERT INTO `job_adverts` (`id`, `user_id`, `category_id`, `subcategory_id`, `title`, `description`, `task_url`, `amount_per_task`, `total_amount`, `num_tasks`, `num_completed`, `banner`, `screenshots_required`, `num_screenshots`, `sample_screenshots`, `approved`, `completed`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 1, 'Follow on Instagram', 'Follow our Instagram page and like our latest post.', 'https://instagram.com/our_page', '5.00', '100.00', 20, '1', '1.jpg', 1, 1, '666967b23d4be.jpg', 1, 0, '2024-06-11 02:26:09', '2024-06-17 12:34:47'),
(7, 1, 2, 1, 'Write Product Review', 'Write a review for our latest product on our website.', 'https://example.com/product', '10.00', '100.00', 10, '4', NULL, 0, NULL, NULL, 1, 0, '2024-06-11 02:26:09', '2024-06-11 08:56:25'),
(8, 1, 3, 1, 'Survey Participation', 'Participate in a short survey about consumer preferences.', 'https://example.com/survey', '3.00', '150.00', 50, '3', NULL, 1, NULL, NULL, 1, 0, '2024-06-11 02:26:09', '2024-06-11 10:55:10'),
(9, 1, 4, 1, 'Website Registration', 'Register on our website and complete your profile.', 'https://example.com/register', '2.00', '60.00', 30, '3', NULL, 0, NULL, '66696d0a632d3.jpg', 1, 0, '2024-06-11 02:26:09', '2024-06-14 17:59:53'),
(10, 1, 5, 1, 'Social Media Share', 'Share our latest blog post on your social media accounts.', 'https://example.com/blogpost', '1.50', '75.00', 50, NULL, '66696d0a632d3.jpg', 1, 1, '66696d0a632d3.jpg', 1, 0, '2024-06-11 02:26:09', '2024-06-14 17:59:20'),
(16, 1, 1, NULL, 'TEst', 'Test description', NULL, '500.00', '17600.00', 500, NULL, '', 1, 0, '', 0, 0, '2024-06-12 08:10:00', '2024-06-20 06:25:34'),
(19, 1, NULL, NULL, 'Main Test', 'This is the main test', NULL, '100.00', '800.00', 100, NULL, '66696d0a632d3.jpg', 1, 0, '66696d0a632d3.jpg', 0, 0, '2024-06-12 08:20:40', '2024-06-14 17:59:11'),
(22, 1, 0, 1, 'Main Test', '', NULL, '100.00', '10800.00', 100, NULL, '66695ebad6b8d.jpg', 1, 0, '66695ebad68f4.jpg', 0, 0, '2024-06-12 08:39:22', '2024-06-12 08:39:22'),
(23, 1, 0, 1, 'Main Test', '', NULL, '100.00', '10800.00', 100, NULL, '666967b23dc59.jpg', 1, 0, '666967b23d4be.jpg', 0, 0, '2024-06-12 09:17:38', '2024-06-12 09:17:38'),
(24, 1, 0, 1, 'Test Last', '', NULL, '100.00', '5450.00', 50, NULL, '66696b8a1fada.jpg', 1, 0, '66696b8a1f328.jpg', 0, 0, '2024-06-12 09:34:02', '2024-06-12 09:34:02'),
(25, 1, 1, 0, 'Test Last', 'This is the final test', NULL, '100.00', '5450.00', 50, NULL, '66696d0a632d3.jpg', 1, 0, '66696d0a62c56.jpg', 0, 0, '2024-06-12 09:40:26', '2024-06-12 09:40:26'),
(26, 1, 2, 0, 'Second Category', 'Signup and test the website https://chatgpt.com/c/deacf619-ff51-4f4b-86b9-c25005ed1160', NULL, '100.00', '10800.00', 100, NULL, '66696d5964aab.jpg', 0, 0, '', 0, 0, '2024-06-12 09:41:45', '2024-06-12 09:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `job_advert_screenshots`
--

CREATE TABLE `job_advert_screenshots` (
  `id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_advert_screenshots`
--

INSERT INTO `job_advert_screenshots` (`id`, `job_id`, `user_id`, `url`, `created_at`) VALUES
(13, 6, 1, '6668212f11723.png', '2024-06-11 10:04:31'),
(14, 6, 1, '6668212f25b41.png', '2024-06-11 10:04:31'),
(15, 6, 1, '6668217ae7d59.png', '2024-06-11 10:05:47'),
(16, 6, 1, '6668217b15925.png', '2024-06-11 10:05:47'),
(17, 6, 1, '666821a1a501b.jpg', '2024-06-11 10:06:25'),
(18, 6, 1, '666821a1aaa12.jpg', '2024-06-11 10:06:25'),
(19, 10, 1, '66702c2de9ad1.png', '2024-06-17 12:29:33'),
(20, 6, 1, '66702d2604ed3.png', '2024-06-17 12:33:42'),
(21, 6, 1, '66702d679031b.png', '2024-06-17 12:34:47'),
(22, 25, 1, '67a7f082a16a9.jpg', '2025-02-09 00:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `action_type` int(1) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `is_read` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `read_at` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `receiver_id`, `action_type`, `body`, `is_read`, `created_at`, `read_at`) VALUES
(22, 1, 1, 'You received a transfer of ₦1500 from Spencer Omagbemi', 1, '2024-06-15 00:00:54', NULL),
(23, 1, 1, 'You received a transfer of $100 from Spencer Omagbemi', 1, '2024-06-15 00:00:54', NULL),
(24, 1, 1, 'You received a transfer of $100 from Spencer Omagbemi', 1, '2024-06-15 00:00:54', NULL),
(25, 2, 1, 'You received a transfer of $100 from Spencer Omagbemi', 0, '2024-01-08 00:20:47', NULL),
(26, 2, 1, 'You received a transfer of $100 from Spencer Omagbemi', 0, '2024-01-08 00:21:04', NULL),
(27, 2, 1, 'You received a transfer of $100 from Spencer Omagbemi', 0, '2024-01-08 00:21:45', NULL),
(28, 1, 1, 'You received a transfer of ₦1500 from Spencer Omagbemi', 1, '2024-06-15 00:00:54', NULL),
(29, 12, 1, 'You received a transfer of ₦1500 from Spencer Omagbemi', 0, '2024-01-08 00:23:05', NULL),
(30, 12, 1, 'You received a transfer of ₦2000 from Precious Omagbemi', 0, '2024-01-10 13:04:56', NULL),
(31, 15, 1, 'You received a transfer of ₦5000 from Precious Omagbemi', 0, '2024-01-10 13:06:44', NULL),
(32, 16, 1, 'You received a transfer of $100 from Precious Omagbemi', 0, '2024-01-11 12:47:00', NULL),
(41, 1, 0, 'Referral bonus of ₦1700 on john', 1, '2024-06-15 00:00:54', NULL),
(42, 1, 0, 'Referral bonus of ₦1700 on john', 1, '2024-06-15 00:00:54', NULL),
(43, 1, 0, 'Referral bonus of ₦1700 on john', 1, '2024-06-15 00:00:54', NULL),
(44, 1, 0, 'Referral bonus of ₦1700 on john', 1, '2024-06-15 00:00:54', NULL),
(45, 1, 0, 'Indirect referral bonus of ₦200 on john', 1, '2024-06-15 00:00:54', NULL),
(46, 18, 0, 'Referral bonus of ₦1700 on Ally', 0, '2024-06-06 11:39:36', NULL),
(47, 1, 0, 'Indirect referral bonus of ₦200 on Ally', 1, '2024-06-15 00:00:54', NULL),
(48, 18, 0, 'Referral bonus of ₦1700 on Eb', 0, '2024-06-08 10:44:28', NULL),
(49, 1, 0, 'Indirect referral bonus of ₦200 on Eb', 1, '2024-06-15 00:00:54', NULL),
(50, 1, 0, 'Congrats! You just received ₦500 TikTok Task  reward.', 1, '2024-06-15 00:00:54', NULL),
(51, 1, 0, 'Congrats! You just received your daily task reward for today.', 0, '2024-06-28 17:43:42', NULL),
(52, 1, 0, 'Congrats! You just received your daily task reward for today.', 0, '2024-06-28 17:50:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(10) NOT NULL,
  `indirect_referral_bonus` varchar(100) NOT NULL DEFAULT '0',
  `referral_bonus` int(5) NOT NULL,
  `signup_bonus` varchar(225) DEFAULT '1500'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`pid`, `name`, `price`, `indirect_referral_bonus`, `referral_bonus`, `signup_bonus`) VALUES
(1, 'PURIEARN', '3000', '250', 2000, '1500');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL,
  `platform` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `platform`, `link`) VALUES
(1, 'instagram', 'https://instagram.com/officialearnixincome?igshid=MzNlNGNkZWQ4Mg=='),
(2, 'facebook', 'https://www.facebook.com/profile.php?id=100093645186832&mibextid=ZbWKwL'),
(4, 'telegram ', 'https://t.me/officialearnixincome'),
(0, 'facebook', 'https');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Follow', '2024-06-11 12:26:54', '2024-06-11 12:26:54'),
(2, 1, 'Subscribe', '2024-06-11 12:26:54', '2024-06-11 12:26:54'),
(3, 1, 'Signup and Verify.', '2024-06-15 08:14:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tiktok_tasks`
--

CREATE TABLE `tiktok_tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `instructions` text NOT NULL,
  `video_type` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `status` int(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tiktok_tasks`
--

INSERT INTO `tiktok_tasks` (`id`, `title`, `instructions`, `video_type`, `tag`, `status`, `created_at`, `updationDate`) VALUES
(1, 'Make a 1 min video promoting PuriEarn', 'Post your video tag @puriearnofficial Tiktok official account @puriearn.online and also use the hashtag #puriearn ', 'Dancing', '@Puriearn', 1, '2024-06-11 00:59:21', NULL),
(3, 'Test Task', 'This is the', 'Dancing', '@puriearn', 0, '2024-06-12 23:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tiktok_user_drafts`
--

CREATE TABLE `tiktok_user_drafts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `video_link` varchar(255) DEFAULT NULL,
  `admin_approval` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tiktok_user_drafts`
--

INSERT INTO `tiktok_user_drafts` (`id`, `user_id`, `task_id`, `status`, `created_at`, `video_link`, `admin_approval`) VALUES
(1, 1, 1, 'submitted', '2024-06-11 01:04:05', 'https://t.me/xonabsswift', 'Pending'),
(2, 20, 1, 'draft', '2024-06-11 01:07:07', NULL, 'Approved'),
(3, 1, 2, 'draft', '2024-06-11 01:52:41', NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `account_type` varchar(225) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` varchar(10) DEFAULT NULL,
  `updationDate` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `amount`, `account_type`, `type`, `status`, `created_at`, `updationDate`) VALUES
(1, 1, '20500', 'Referral', 'Withdrawal', 'Cancelled', '2023-06-21', '13-06-2024 06:05:27 PM'),
(460, 1, '9000', 'Referral', 'Withdrawal', 'Pending', '2023-12-03', NULL),
(461, 1, '25000', 'Non Affiliate', 'Withdrawal', 'Pending', '2024-02-06', NULL),
(462, 1, '25000', 'Non Affiliate', 'Withdrawal', 'Pending', '2024-02-08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `plan_id` int(2) NOT NULL,
  `password` varchar(255) NOT NULL,
  `referral_code` varchar(100) NOT NULL,
  `referred_by` varchar(100) DEFAULT NULL,
  `referral_level` int(11) DEFAULT 1,
  `coupon_code` varchar(20) DEFAULT NULL,
  `tiktok_balance` varchar(100) DEFAULT '0.00',
  `cashback` varchar(115) DEFAULT '0',
  `cashback_status` int(1) DEFAULT 0,
  `ref_bonus` varchar(100) DEFAULT '0.00',
  `indirect_ref_bonus` varchar(100) DEFAULT '0',
  `job_balance` varchar(225) DEFAULT '0.00',
  `ads_balance` varchar(225) DEFAULT '0.00',
  `bvn` varchar(225) DEFAULT NULL,
  `lastTask` varchar(225) DEFAULT NULL,
  `s_bank_name` varchar(225) DEFAULT '2022-05-04',
  `s_account_name` varchar(225) DEFAULT '0.00',
  `s_account_number` varchar(225) DEFAULT '0.00',
  `s_tracking_number` varchar(225) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `youtube` varchar(225) DEFAULT NULL,
  `twitter` varchar(225) DEFAULT NULL,
  `telegram` varchar(225) DEFAULT NULL,
  `tiktok` varchar(225) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(15) DEFAULT NULL,
  `user_picture` varchar(225) DEFAULT 'avatar.png',
  `withdrawal_pin` varchar(225) DEFAULT NULL,
  `is_vendor` int(1) DEFAULT 0,
  `is_publisher` int(1) DEFAULT 0,
  `point_volume` varchar(225) DEFAULT '0',
  `active_loan` int(1) DEFAULT 0,
  `coupon_account_bal` varchar(100) DEFAULT '0',
  `code` int(6) DEFAULT NULL,
  `last_code_request` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `withdrawn_flag` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `phone`, `username`, `email`, `plan_id`, `password`, `referral_code`, `referred_by`, `referral_level`, `coupon_code`, `tiktok_balance`, `cashback`, `cashback_status`, `ref_bonus`, `indirect_ref_bonus`, `job_balance`, `ads_balance`, `bvn`, `lastTask`, `s_bank_name`, `s_account_name`, `s_account_number`, `s_tracking_number`, `status`, `youtube`, `twitter`, `telegram`, `tiktok`, `bank_name`, `account_name`, `account_number`, `user_picture`, `withdrawal_pin`, `is_vendor`, `is_publisher`, `point_volume`, `active_loan`, `coupon_account_bal`, `code`, `last_code_request`, `created_at`, `updated_at`, `withdrawn_flag`) VALUES
(1, 'Omagbemi Precious', '09033944592', 'majorp', 'bignamepreciousonstage@gmail.com', 1, '$2y$10$.HzLgh8qhqIoTEmtGSnWLOZLYV6OjJkAc2lzLKyi3de3QK6qYMrlK', 'majorp', 'majorp', 1, 'DAP1TQCNLEIZ', '500', '2000', 0, '4400', '900', '200', '915800', NULL, '2024-06-28', '2022-05-04', '2023-11-1', '2023-11-30', NULL, 0, 'Youtube', 'Twitter', 'Telgram', 'Tiktok', 'First Bank of Nigeria', 'Omagbemi Precious', '3125390689', 'IMG-20240606-WA0007.jpg', '$2y$10$iY.NZ0oRqlDlg7DpEtYdFeuaWCngI0XU8iXzZ1.HxFuyKTZGmhjJi', 1, 1, '0', 0, '36600', 768108, '2023-11-16 11:01:46', '2023-11-04 02:16:59', '2024-06-28 17:50:23', 1),
(2, 'Terry', '0033944592', 'ally', 'terry@gmail.com', 1, '$2y$10$TXovIbgMNC/X30lCuvOvE.xGsKQ78B8M3WEXGyMAwSIMIwg4xPDye', 'dkfljdkljfs', 'majorp', 1, 'lkdjfsdf', '5', '0', 0, '0.00', '0', '0.00', '0.00', NULL, NULL, '2022-05-04', '0.00', '0.00', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'avatar.png', NULL, 0, 0, '0', 0, '0', NULL, NULL, '2024-06-14 18:14:39', '2024-06-20 06:40:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userslog`
--

CREATE TABLE `userslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `email` varchar(225) DEFAULT NULL,
  `userip` varchar(250) DEFAULT NULL,
  `phone_model` varchar(225) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userslog`
--

INSERT INTO `userslog` (`id`, `uid`, `email`, `userip`, `phone_model`, `loginTime`, `logout`, `status`) VALUES
(141, 2, 'bignamepreciousonstage@gmail.com', '192.168.158.1', 'sdk_gphone_x86', '2023-06-29 17:55:49', NULL, 'Successful'),
(142, 0, 'bignamepreciousonstage@gmail.com', '192.168.0.181', 'TECNO CC9', '2023-12-20 07:17:45', NULL, 'Failed'),
(143, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.181', 'TECNO CC9', '2023-12-20 07:21:10', NULL, 'Successful'),
(144, 0, 'bignamepreciousonstage@gmail.com', '192.168.0.108', 'iPhone 7', '2023-12-21 06:07:24', NULL, 'Failed'),
(145, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.108', 'iPhone 7', '2023-12-21 06:07:38', NULL, 'Successful'),
(146, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-01-09 17:17:18', NULL, 'Successful'),
(147, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.181', 'TECNO CC9', '2024-01-10 08:54:44', NULL, 'Successful'),
(148, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-01-13 11:41:19', NULL, 'Successful'),
(149, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-01-13 13:08:02', NULL, 'Successful'),
(150, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-01-13 13:14:10', NULL, 'Successful'),
(151, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-01-13 13:23:12', NULL, 'Successful'),
(152, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-01-17 13:52:12', NULL, 'Successful'),
(153, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-01-17 13:55:08', NULL, 'Successful'),
(154, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-01-17 14:17:23', NULL, 'Successful'),
(155, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-01-17 14:20:21', NULL, 'Successful'),
(156, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-01-17 14:22:26', NULL, 'Successful'),
(157, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-01-17 14:25:07', NULL, 'Successful'),
(158, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-01-17 15:04:41', NULL, 'Successful'),
(159, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-03-19 23:09:29', NULL, 'Successful'),
(160, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-03-19 23:09:44', NULL, 'Successful'),
(161, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-03-19 23:16:47', NULL, 'Successful'),
(162, 2, 'bignamepreciousonstage@gmail.com', '192.168.0.145', 'sdk_gphone_x86', '2024-04-14 07:47:24', NULL, 'Successful'),
(163, 2, 'bignamepreciousonstage@gmail.com', '', NULL, '2024-05-22 14:18:42', NULL, 'Failed'),
(164, 2, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-22 14:19:13', NULL, 'Successful'),
(165, 21, 'bignamepreciousonstage@gmail.com', '', NULL, '2024-05-22 18:53:37', NULL, 'Failed'),
(166, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-22 18:53:46', NULL, 'Successful'),
(167, 21, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-05-22 21:19:32', NULL, 'Successful'),
(168, 0, 'omonighoblessing4real@gmail.com', '', NULL, '2024-05-22 21:29:36', NULL, 'Failed'),
(169, 21, 'bignamepreciousonstage@gmail.com', '', NULL, '2024-05-23 13:27:07', NULL, 'Failed'),
(170, 21, 'bignamepreciousonstage@gmail.com', '', NULL, '2024-05-23 14:02:27', NULL, 'Failed'),
(171, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-23 14:02:37', NULL, 'Successful'),
(172, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-24 21:07:00', NULL, 'Successful'),
(173, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-24 22:40:48', NULL, 'Successful'),
(174, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-24 23:19:12', NULL, 'Successful'),
(175, 21, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-05-24 23:20:45', NULL, 'Successful'),
(176, 21, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-05-25 02:44:28', NULL, 'Successful'),
(177, 21, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-05-25 07:13:41', NULL, 'Successful'),
(178, 21, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-05-25 10:16:28', NULL, 'Successful'),
(179, 21, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-05-25 18:38:40', NULL, 'Successful'),
(180, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-25 19:17:38', NULL, 'Successful'),
(181, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-25 22:22:53', NULL, 'Successful'),
(182, 21, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-05-25 23:57:53', NULL, 'Successful'),
(183, 21, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-05-25 23:57:54', NULL, 'Successful'),
(184, 21, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-05-26 00:10:15', NULL, 'Successful'),
(185, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-26 11:22:43', NULL, 'Successful'),
(186, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-26 22:14:20', NULL, 'Successful'),
(187, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-27 12:50:07', NULL, 'Successful'),
(188, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-29 08:52:05', NULL, 'Successful'),
(189, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-05-31 08:49:27', NULL, 'Successful'),
(190, 21, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-01 21:46:41', NULL, 'Successful'),
(191, 1, 'bignamepreciousonstage@gmail.com', '', NULL, '2024-06-04 00:19:49', NULL, 'Failed'),
(192, 1, 'bignamepreciousonstage@gmail.com', '', NULL, '2024-06-04 00:20:26', NULL, 'Failed'),
(193, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-04 00:27:51', NULL, 'Successful'),
(194, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-05 08:29:36', NULL, 'Successful'),
(195, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-05 21:35:02', NULL, 'Successful'),
(196, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-06 09:54:59', NULL, 'Successful'),
(197, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-06 09:56:51', NULL, 'Successful'),
(198, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-06 10:04:42', NULL, 'Successful'),
(199, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-06 17:16:27', NULL, 'Successful'),
(200, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-06 17:47:38', NULL, 'Successful'),
(201, 1, 'bignamepreciousonstage@gmail.com', '', NULL, '2024-06-06 22:47:39', NULL, 'Failed'),
(202, 1, 'bignamepreciousonstage@gmail.com', '', NULL, '2024-06-06 22:47:40', NULL, 'Failed'),
(203, 1, 'bignamepreciousonstage@gmail.com', '', NULL, '2024-06-06 22:49:09', NULL, 'Failed'),
(204, 1, 'bignamepreciousonstage@gmail.com', '172.20.10.1', NULL, '2024-06-06 22:49:20', NULL, 'Successful'),
(205, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-07 09:54:09', NULL, 'Successful'),
(206, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-07 13:39:48', NULL, 'Successful'),
(207, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-07 18:17:57', NULL, 'Successful'),
(208, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-08 09:07:04', NULL, 'Successful'),
(209, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-08 09:07:04', NULL, 'Successful'),
(210, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-08 09:48:33', NULL, 'Successful'),
(211, 19, 'Ally', '', NULL, '2024-06-08 10:26:44', NULL, 'Failed'),
(212, 19, 'emmaboniface98@gmail.com', '', NULL, '2024-06-08 10:26:57', NULL, 'Failed'),
(213, 19, 'emmaboniface98@gmail.com', '', NULL, '2024-06-08 10:27:10', NULL, 'Failed'),
(214, 19, 'Ally', '', NULL, '2024-06-08 10:41:10', NULL, 'Failed'),
(215, 19, 'Ally', '', NULL, '2024-06-08 10:41:26', NULL, 'Failed'),
(216, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-08 10:51:10', NULL, 'Successful'),
(217, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-08 10:55:34', NULL, 'Successful'),
(218, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-08 21:44:43', NULL, 'Successful'),
(219, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-09 10:08:35', NULL, 'Successful'),
(220, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.1', NULL, '2024-06-09 19:52:58', NULL, 'Successful'),
(221, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-10 22:01:14', NULL, 'Successful'),
(222, 1, 'bignamepreciousonstage@gmail.com', '', NULL, '2024-06-10 22:07:59', NULL, 'Failed'),
(223, 1, 'bignamepreciousonstage@gmail.com', '172.20.10.5', NULL, '2024-06-10 22:08:10', NULL, 'Successful'),
(224, 20, 'boniface@gmail.com', '172.20.10.4', NULL, '2024-06-10 22:08:31', NULL, 'Successful'),
(225, 20, 'boniface@gmail.com', '172.20.10.4', NULL, '2024-06-10 22:23:01', NULL, 'Successful'),
(226, 1, 'bignamepreciousonstage@gmail.com', '172.20.10.5', NULL, '2024-06-10 23:47:42', NULL, 'Successful'),
(227, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-11 02:32:29', NULL, 'Successful'),
(228, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-12 00:09:21', NULL, 'Successful'),
(229, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-12 07:45:22', NULL, 'Successful'),
(230, 20, 'boniface@gmail.com', '', NULL, '2024-06-12 09:13:45', NULL, 'Failed'),
(231, 20, 'boniface@gmail.com', '', NULL, '2024-06-12 09:14:05', NULL, 'Failed'),
(232, 20, 'boniface@gmail.com', '', NULL, '2024-06-12 09:14:32', NULL, 'Failed'),
(233, 20, 'boniface@gmail.com', '', NULL, '2024-06-12 09:14:58', NULL, 'Failed'),
(234, 20, 'boniface@gmail.com', '', NULL, '2024-06-12 09:15:09', NULL, 'Failed'),
(235, 20, 'boniface@gmail.com', '', NULL, '2024-06-12 09:15:54', NULL, 'Failed'),
(236, 20, 'boniface@gmail.com', '', NULL, '2024-06-12 09:16:04', NULL, 'Failed'),
(237, 1, 'majorp', '', NULL, '2024-06-12 09:20:11', NULL, 'Failed'),
(238, 1, 'majorp', '172.20.10.4', NULL, '2024-06-12 09:20:20', NULL, 'Successful'),
(239, 1, 'bignamepreciousonstage@gmail.com', '172.20.10.5', NULL, '2024-06-12 09:24:56', NULL, 'Successful'),
(240, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-12 22:51:32', NULL, 'Successful'),
(241, 1, 'bignamepreciousonstage@gmail.com', '', NULL, '2024-06-12 23:29:14', NULL, 'Failed'),
(242, 1, 'majorp', '172.20.10.4', NULL, '2024-06-12 23:29:21', NULL, 'Successful'),
(243, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-13 10:19:11', NULL, 'Successful'),
(244, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-13 15:53:37', NULL, 'Successful'),
(245, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-14 23:27:33', NULL, 'Successful'),
(246, 1, 'majorp', '172.20.10.4', NULL, '2024-06-15 16:20:56', NULL, 'Successful'),
(247, 2, 'Ally', '172.20.10.4', NULL, '2024-06-15 16:21:58', NULL, 'Successful'),
(248, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-15 21:12:04', NULL, 'Successful'),
(249, 2, 'ally', '127.0.0.1', NULL, '2024-06-20 06:39:29', NULL, 'Successful'),
(250, 2, 'ally', '', NULL, '2024-06-20 06:40:57', NULL, 'Failed'),
(251, 2, 'ally', '127.0.0.1', NULL, '2024-06-20 06:41:07', NULL, 'Successful'),
(252, 1, 'bignamepreciousonstage@gmail.com', '127.0.0.1', NULL, '2024-06-28 09:41:45', NULL, 'Successful'),
(253, 1, 'bignamepreciousonstage@gmail.com', '192.168.43.134', NULL, '2025-02-08 23:59:41', NULL, 'Successful');

-- --------------------------------------------------------

--
-- Table structure for table `user_job_tasks`
--

CREATE TABLE `user_job_tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(225) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_job_tasks`
--

INSERT INTO `user_job_tasks` (`id`, `user_id`, `job_id`, `completed`, `completed_at`, `status`) VALUES
(11, 1, 16, 1, '2024-06-17 12:34:47', 'Confirmed'),
(13, 1, 0, 1, '2024-06-28 17:50:23', 'Confirmed'),
(14, 1, 26, 1, '2025-02-09 00:00:10', 'Pending'),
(15, 1, 25, 1, '2025-02-09 00:02:10', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_portals`
--

CREATE TABLE `withdrawal_portals` (
  `id` int(11) NOT NULL,
  `portal_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdrawal_portals`
--

INSERT INTO `withdrawal_portals` (`id`, `portal_name`, `status`) VALUES
(1, 'Tiktok', 1),
(2, 'Affiliate', 1),
(4, 'Cashback', 1),
(5, 'Job', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_details`
--
ALTER TABLE `account_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminlog`
--
ALTER TABLE `adminlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approval_logs`
--
ALTER TABLE `approval_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `claim_task`
--
ALTER TABLE `claim_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `digital_courses`
--
ALTER TABLE `digital_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earning_history`
--
ALTER TABLE `earning_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_adverts`
--
ALTER TABLE `job_adverts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_advert_screenshots`
--
ALTER TABLE `job_advert_screenshots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiktok_tasks`
--
ALTER TABLE `tiktok_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiktok_user_drafts`
--
ALTER TABLE `tiktok_user_drafts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userslog`
--
ALTER TABLE `userslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_job_tasks`
--
ALTER TABLE `user_job_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal_portals`
--
ALTER TABLE `withdrawal_portals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_details`
--
ALTER TABLE `account_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `adminlog`
--
ALTER TABLE `adminlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `approval_logs`
--
ALTER TABLE `approval_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `claim_task`
--
ALTER TABLE `claim_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6928;

--
-- AUTO_INCREMENT for table `digital_courses`
--
ALTER TABLE `digital_courses`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `earning_history`
--
ALTER TABLE `earning_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13178;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `job_adverts`
--
ALTER TABLE `job_adverts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `job_advert_screenshots`
--
ALTER TABLE `job_advert_screenshots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tiktok_tasks`
--
ALTER TABLE `tiktok_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tiktok_user_drafts`
--
ALTER TABLE `tiktok_user_drafts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userslog`
--
ALTER TABLE `userslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `user_job_tasks`
--
ALTER TABLE `user_job_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `withdrawal_portals`
--
ALTER TABLE `withdrawal_portals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
