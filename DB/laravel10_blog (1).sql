-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2026 at 03:01 PM
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
-- Database: `laravel10_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `description`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Electronics', 'electronics', 'All electronic products', 'electronics.jpg', 1, '2026-02-27 03:59:18', '2026-02-27 03:59:18', NULL),
(3, 'Fashion', 'fashion', 'Clothing and fashion items', 'fashion.jpg', 1, '2026-02-27 03:59:18', '2026-02-27 03:59:18', NULL),
(4, 'Automobiles', 'automobiles', 'Cars and vehicles', 'automobiles.jpg', 1, '2026-02-27 03:59:18', '2026-02-27 03:59:18', NULL),
(5, 'Real Estate', 'real-estate', 'Property listings', 'realestate.jpg', 1, '2026-02-27 03:59:18', '2026-02-27 03:59:18', NULL),
(6, 'Sports', 'sports', 'Sports equipment and accessories', 'sports.jpg', 1, '2026-02-27 03:59:18', '2026-02-27 03:59:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` longtext NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `message`, `post_id`, `parent_id`, `user_id`, `name`, `email`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'first comment', 1, NULL, 1, NULL, NULL, 1, '2026-02-16 06:19:28', '2026-02-16 06:19:28', NULL),
(2, 'first comment', 15, NULL, 1, NULL, NULL, 1, '2026-02-27 05:22:01', '2026-02-27 05:22:01', NULL),
(3, 'yes this one is first comment', 15, 2, 1, NULL, NULL, 1, '2026-02-27 05:22:18', '2026-02-27 05:22:18', NULL),
(4, 'first comment', 11, NULL, 1, NULL, NULL, 1, '2026-02-27 05:53:05', '2026-02-27 05:53:05', NULL),
(5, 'yes', 11, 4, 1, NULL, NULL, 1, '2026-02-27 05:56:42', '2026-02-27 05:56:42', NULL),
(6, 'first comment', 12, NULL, 2, NULL, NULL, 1, '2026-03-02 08:42:44', '2026-03-02 08:42:44', NULL),
(7, 'thanks', 12, 6, 2, NULL, NULL, 1, '2026-03-02 08:43:02', '2026-03-02 08:43:02', NULL),
(8, 'thejas', 15, NULL, NULL, 'THEJAS', 'thejas@email.com', 0, '2026-03-03 06:26:43', '2026-03-03 06:26:43', NULL),
(9, 'yes', 1, NULL, NULL, 'Hamza Noor', 'za941510@gmail.com', 1, '2026-03-03 06:39:41', '2026-03-03 06:41:48', NULL),
(10, 'adsd', 17, NULL, NULL, 'admin', 'afaqali@gmail.com', 0, '2026-03-03 06:59:46', '2026-03-03 07:00:55', '2026-03-03 07:00:55'),
(11, 'amir', 17, NULL, NULL, 'afaq ali', 'amirali@gmail.com', 1, '2026-03-03 07:01:30', '2026-03-03 07:01:44', NULL),
(12, 'guest', 17, NULL, NULL, 'Sajid Ali', 'guest@gmail.com', 1, '2026-03-03 07:02:17', '2026-03-03 07:02:32', NULL),
(13, 'yes that is first comment', 12, NULL, NULL, 'Sajid Ali', 'sajidalilyallpur@gmail.com', 1, '2026-03-09 08:00:14', '2026-03-09 08:00:39', NULL);

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
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `header_menu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`header_menu`)),
  `footer_menu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`footer_menu`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `header_menu`, `footer_menu`, `created_at`, `updated_at`) VALUES
(1, '[{\"text\":\"Home\",\"href\":\"http://127.0.0.1:8000/\",\"icon\":\"\",\"tooltip\":\"\",\"children\":[]},{\"text\":\"AboutUs\",\"href\":\"/page/about-us\",\"icon\":\"\",\"tooltip\":\"\",\"children\":[]},{\"text\":\"PrivacyPolicy\",\"href\":\"page/privacy-policy\",\"icon\":\"\",\"tooltip\":\"\",\"children\":[]},{\"text\":\"ContactUs\",\"href\":\"#\",\"icon\":\"\",\"tooltip\":\"\",\"children\":[]}]', '[{\"text\":\"Home\",\"href\":\"http://127.0.0.1:8000/\",\"icon\":\"\",\"tooltip\":\"\",\"children\":[]},{\"text\":\"AboutUs\",\"href\":\"/page/about-us\",\"icon\":\"\",\"tooltip\":\"\",\"children\":[]},{\"text\":\"PrivacyPolicy\",\"href\":\"/page/privacy-policy\",\"icon\":\"\",\"tooltip\":\"\",\"children\":[]},{\"text\":\"ContactUs\",\"href\":\"#\",\"icon\":\"\",\"tooltip\":\"\",\"children\":[]}]', '2025-12-09 08:05:21', '2026-02-17 07:52:27');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_11_064757_create_posts_table', 1),
(6, '2023_10_11_070352_create_categories_table', 1),
(7, '2023_10_11_071335_create_comments_table', 1),
(8, '2023_10_13_150155_create_tags_table', 1),
(9, '2023_10_13_153614_create_post_tag_table', 1),
(10, '2023_10_23_121126_create_site_settings_table', 1),
(11, '2023_10_23_143122_create_social_media_table', 1),
(12, '2023_10_23_164448_create_menus_table', 1),
(13, '2023_10_23_184917_add_social_media_to_user_table', 1),
(14, '2023_10_23_234636_create_media_table', 1),
(15, '2023_10_24_145453_create_pages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `status`, `created_at`, `updated_at`, `deleted_at`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, 'About Us', 'about-us', '<p style=\"margin-right: 0px; margin-bottom: 34px; margin-left: 0px; color: rgb(37, 37, 37); font-family: Lora, serif; font-size: 19px; letter-spacing: -0.2px;\">The About Us page of your website is an essential source of information for anyone who wants to know more about your business.</p><p style=\"margin-right: 0px; margin-bottom: 34px; margin-left: 0px; color: rgb(37, 37, 37); font-family: Lora, serif; font-size: 19px; letter-spacing: -0.2px;\">It is where you showcase your history, the unique value of your work, your mission and vision, and the&nbsp;<a href=\"https://www.searchenginejournal.com/what-is-a-target-audience-and-how-do-you-find-it/467926/\" style=\"color: inherit; transition: 0.2s; border-bottom: 2.5px solid rgb(113, 194, 27);\">audiences you serve</a>.</p><p style=\"margin-right: 0px; margin-bottom: 34px; margin-left: 0px; color: rgb(37, 37, 37); font-family: Lora, serif; font-size: 19px; letter-spacing: -0.2px;\">Together,&nbsp;<a href=\"https://www.searchenginejournal.com/ux-design-seo/476959/\" style=\"color: inherit; transition: 0.2s; border-bottom: 2.5px solid rgb(113, 194, 27);\">the design</a>, written content, and visual elements of an About Us page tell an important story about who you are and what matters to you.</p><p style=\"margin-right: 0px; margin-bottom: 34px; margin-left: 0px; color: rgb(37, 37, 37); font-family: Lora, serif; font-size: 19px; letter-spacing: -0.2px;\">How can you make the most of this integral part of your marketing strategy?</p><p style=\"margin-right: 0px; margin-bottom: 34px; margin-left: 0px; color: rgb(37, 37, 37); font-family: Lora, serif; font-size: 19px; letter-spacing: -0.2px;\">In this article, discover what makes an exceptional About Us page and find 25 examples to inspire your own page design and content.</p>', 1, '2025-12-09 11:25:42', '2026-02-17 07:43:46', NULL, 'About Us', 'aboutus,pages', 'create a new page named as aboutus'),
(2, 'Privacy Policy', 'privacy-policy', '<p>We respect your privacy and are committed to protecting your personal information. When you use our website or mobile application, we may collect basic information such as your name, email address, phone number, device details, and usage data to provide and improve our services, process payments, enhance security, and communicate important updates. We do not sell or share your personal information with third parties except as necessary to operate our services (such as payment processors or analytics providers). We implement appropriate security measures to protect your data, but no online system is completely secure. By using our platform, you agree to the collection and use of information in accordance with this Privacy Policy. If you have any questions or requests regarding your data, you may contact us at our official support email.</p>', 1, '2026-02-17 07:47:58', '2026-02-17 07:48:35', NULL, 'Privacy Policy', 'privacy-policy,newpage', 'privacy-policy page create');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `enable_comment` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `meta_title` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `category_id`, `content`, `thumbnail`, `views`, `is_featured`, `enable_comment`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Sports blog: Tobias Becs', 'sports-blog-tobias-becs', 2, '<div data-breakout=\"normal\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; padding-inline: max(48.56px, 50% - 370px); color: rgb(0, 0, 0); font-family: madefor-text, helveticaneuew01-45ligh, helveticaneuew02-45ligh, helveticaneuew10-45ligh, sans-serif; white-space-collapse: preserve;\"><p class=\"IFLJx f1-1G KVAVd sDlj2\" dir=\"auto\" id=\"viewer-evt0m\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font-variant: inherit; font-stretch: inherit; font-size: 18px; line-height: 27px; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; font-language-override: inherit; background: transparent; border: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; min-height: auto; text-decoration-line: initial; text-decoration-color: rgb(0, 0, 0);\"><span class=\"GnvzP\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: transparent; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; display: block;\"><span style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: rgba(0, 0, 0, 0); border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;\">As an award-winning content creator and Guinness World Record holder, football player </span><a target=\"_blank\" href=\"https://www.tobiasbecs.com/blog\" rel=\"noopener noreferrer\" class=\"Y2xcL uFqDN\" data-hook=\"web-link\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; text-decoration-line: initial; text-decoration-color: rgb(22, 106, 234); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; cursor: pointer; color: rgb(22, 106, 234); line-height: 27px; min-height: auto;\"><span style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: transparent; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;\">Tobias Becs</span></a><span style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: rgba(0, 0, 0, 0); border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;\"> continues to deliver with a unique approach to his “News” blog. It not only contains brief notes about his daily life but also vlogs and photo galleries. Every post is light on words, if they contain any at all. Tobias instead uses his blog as a place to centralize and promote existing videos, social posts and products.</span></span></p></div><div type=\"paragraph\" data-hook=\"rcv-block322\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; color: rgb(0, 0, 0); font-family: madefor-text, helveticaneuew01-45ligh, helveticaneuew02-45ligh, helveticaneuew10-45ligh, sans-serif; white-space-collapse: preserve;\"></div><div data-breakout=\"normal\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; padding-inline: max(48.56px, 50% - 370px); color: rgb(0, 0, 0); font-family: madefor-text, helveticaneuew01-45ligh, helveticaneuew02-45ligh, helveticaneuew10-45ligh, sans-serif; white-space-collapse: preserve;\"><div class=\"IFLJx f1-1G KVAVd sDlj2\" dir=\"auto\" id=\"viewer-81a31\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background: transparent; border: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; margin: 0px; font-size: 18px; line-height: 27px; min-height: auto; text-decoration-line: initial; text-decoration-color: rgb(0, 0, 0); margin-inline-start: 0px !important;\"><span class=\"GnvzP\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: transparent; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; display: block;\"><br role=\"presentation\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit;\"></span></div></div><div type=\"empty-line\" data-hook=\"rcv-block323\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; color: rgb(0, 0, 0); font-family: madefor-text, helveticaneuew01-45ligh, helveticaneuew02-45ligh, helveticaneuew10-45ligh, sans-serif; white-space-collapse: preserve;\"></div><div data-breakout=\"normal\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; padding-inline: max(48.56px, 50% - 370px); color: rgb(0, 0, 0); font-family: madefor-text, helveticaneuew01-45ligh, helveticaneuew02-45ligh, helveticaneuew10-45ligh, sans-serif; white-space-collapse: preserve;\"><div class=\"IFLJx f1-1G KVAVd sDlj2\" dir=\"auto\" id=\"viewer-6y15b896995\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background: transparent; border: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; margin: 0px; font-size: 18px; line-height: 27px; min-height: auto; text-decoration-line: initial; text-decoration-color: rgb(0, 0, 0); margin-inline-start: 0px !important;\"><span class=\"GnvzP\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: transparent; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; display: block;\"><br role=\"presentation\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit;\"></span></div></div><div type=\"empty-line\" data-hook=\"rcv-block324\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; color: rgb(0, 0, 0); font-family: madefor-text, helveticaneuew01-45ligh, helveticaneuew02-45ligh, helveticaneuew10-45ligh, sans-serif; white-space-collapse: preserve;\"></div><div data-breakout=\"normal\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; padding-inline: max(48.56px, 50% - 370px); color: rgb(0, 0, 0); font-family: madefor-text, helveticaneuew01-45ligh, helveticaneuew02-45ligh, helveticaneuew10-45ligh, sans-serif; white-space-collapse: preserve;\"><h4 class=\"GytJZ b3yOZ KVAVd sDlj2\" dir=\"auto\" id=\"viewer-amo2h\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font-variant: inherit; font-stretch: inherit; font-size: 20px; line-height: 25px; font-family: madefor-text-bold, helveticaneuew01-65medi, helveticaneuew02-65medi, helveticaneuew10-65medi, sans-serif; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; font-language-override: inherit; background: transparent; border: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; color: rgb(0, 0, 0); min-height: auto; text-decoration-line: initial; text-decoration-color: rgb(0, 0, 0);\"><span class=\"Tcz9z\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: transparent; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; display: block;\"><span style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: rgba(0, 0, 0, 0); border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;\">Key takeaways</span></span></h4></div><div type=\"heading\" data-hook=\"rcv-block325\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; color: rgb(0, 0, 0); font-family: madefor-text, helveticaneuew01-45ligh, helveticaneuew02-45ligh, helveticaneuew10-45ligh, sans-serif; white-space-collapse: preserve;\"></div><div data-breakout=\"normal\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; padding-inline: max(48.56px, 50% - 370px); color: rgb(0, 0, 0); font-family: madefor-text, helveticaneuew01-45ligh, helveticaneuew02-45ligh, helveticaneuew10-45ligh, sans-serif; white-space-collapse: preserve;\"><div class=\"IFLJx f1-1G KVAVd sDlj2\" dir=\"auto\" id=\"viewer-adg0n\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background: transparent; border: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; margin: 0px; font-size: 18px; line-height: 27px; min-height: auto; text-decoration-line: initial; text-decoration-color: rgb(0, 0, 0); margin-inline-start: 0px !important;\"><span class=\"GnvzP\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: transparent; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; display: block;\"><br role=\"presentation\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit;\"></span></div></div><div type=\"empty-line\" data-hook=\"rcv-block326\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; color: rgb(0, 0, 0); font-family: madefor-text, helveticaneuew01-45ligh, helveticaneuew02-45ligh, helveticaneuew10-45ligh, sans-serif; white-space-collapse: preserve;\"></div><div data-breakout=\"normal\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; padding-inline: max(48.56px, 50% - 370px); color: rgb(0, 0, 0); font-family: madefor-text, helveticaneuew01-45ligh, helveticaneuew02-45ligh, helveticaneuew10-45ligh, sans-serif; white-space-collapse: preserve;\"><ul class=\"_4ZJKX KVAVd\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background: transparent; border: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: 0px; padding: 0px; vertical-align: baseline; list-style: outside none; text-align: initial; font-size: 18px; line-height: 27px; min-height: auto; text-decoration-line: initial; text-decoration-color: rgb(0, 0, 0);\"><li dir=\"auto\" aria-level=\"1\" class=\"qUi3b\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background: rgba(0, 0, 0, 0); border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; list-style-type: disc; margin-inline-start: 1.5em; padding-inline-start: 0.5em;\"><p class=\"IFLJx f1-1G KVAVd sDlj2\" dir=\"\" id=\"viewer-fmr1r\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font-variant: inherit; font-stretch: inherit; line-height: 27px; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; font-language-override: inherit; background: transparent; border: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; min-height: auto; text-decoration-line: initial; text-decoration-color: rgb(0, 0, 0);\"><span class=\"GnvzP\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: transparent; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; display: block;\"><span style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background: transparent; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; font-weight: 700;\">Try vlogging if blogging isn’t your forte. </span><span style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: rgba(0, 0, 0, 0); border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;\">Social media creators and influencers have grown up in a time where writing is limited to a couple hundred characters and photos and videos reign supreme. So if you’re not comfortable with writing lengthy blog posts but still have something important to say or interesting to share, create a vlog or photography blog instead.</span><span style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: rgba(0, 0, 0, 0); border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;\">\n</span></span><br role=\"presentation\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; text-align: initial;\"></p></li><li dir=\"auto\" aria-level=\"1\" class=\"qUi3b\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background: rgba(0, 0, 0, 0); border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; list-style-type: disc; margin-inline-start: 1.5em; padding-inline-start: 0.5em;\"><p class=\"IFLJx f1-1G KVAVd sDlj2\" dir=\"\" id=\"viewer-cblsb\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font-variant: inherit; font-stretch: inherit; line-height: 27px; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; font-language-override: inherit; background: transparent; border: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; min-height: auto; text-decoration-line: initial; text-decoration-color: rgb(0, 0, 0);\"><span class=\"GnvzP\" style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: transparent; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; text-align: initial; display: block;\"><span style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; background: transparent; border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; font-weight: 700;\">Experiment with a dark theme. </span><span style=\"-webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-sizing: inherit; font: inherit; background: rgba(0, 0, 0, 0); border: 0px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline;\">For activity blogs like this one, deviating from the traditional light theme can be refreshing. An all-black background will stand out in stark contrast to other blogs that play it safe with their designs and color choices. </span></span></p></li></ul></div>', 'dfafcaba9aa89314a1263595d34b1dd2.jpg', 42, 0, 1, 1, 'Sports blog: Tobias Becs', 'user', 'nothing', '2025-12-09 11:22:32', '2026-03-05 07:29:41', NULL),
(11, 1, 'new post', 'new-post', 3, '<p>asdf</p>', '7f55385755d663a674d00bfa9b4fefd5.png', 45, 1, 1, 1, 'new post', 'sports', 'sports', '2026-02-16 08:37:10', '2026-03-03 08:23:30', NULL),
(12, 1, 'test post', 'test-post', 4, '<p>test post</p>', 'f58a9cd6c836b701f2f2ed89f55c3383.png', 29, 0, 1, 1, 'test post', 'test,post', 'test post', '2026-02-16 08:57:29', '2026-03-09 08:12:34', NULL),
(13, 1, 'Introduction to Laravel 10', 'introduction-to-laravel-10', 5, 'Laravel 10 is a powerful PHP framework used for building modern web applications. In this article, we explore its features and installation process.', 'laravel10.jpg', 2, 1, 1, 1, 'Laravel 10 Guide', 'laravel, php, framework', 'Complete beginner guide to Laravel 10 framework.', '2026-02-27 04:00:13', '2026-03-05 07:29:30', NULL),
(14, 1, 'Top 10 Web Development Trends in 2026', 'web-development-trends-2026', 2, 'Web development is evolving rapidly with AI integration, serverless architecture, and modern JS frameworks leading the way.', 'web-trends.jpg', 2, 0, 1, 1, 'Web Development Trends 2026', 'web, development, trends', 'Latest web development trends you should follow in 2026.', '2026-02-27 04:00:13', '2026-03-09 07:52:52', NULL),
(15, 1, 'How to Optimize MySQL Database', 'optimize-mysql-database', 6, 'Database optimization improves performance. Learn indexing, query optimization, and caching techniques in MySQL.', 'mysql-optimize.jpg', 22, 0, 1, 1, 'Optimize MySQL Performance', 'mysql, database, optimization', 'Best practices to optimize MySQL database performance.', '2026-02-27 04:00:13', '2026-03-03 06:34:52', NULL),
(16, 1, 'SEO Best Practices for Bloggers', 'seo-best-practices-for-bloggers', 3, 'SEO helps your blog rank higher on search engines. This guide explains on-page and off-page SEO techniques.', 'seo-guide.jpg', 1, 1, 1, 1, 'SEO Best Practices for Bloggers', 'seo,blogging,ranking', 'Complete SEO guide to improve blog ranking.', '2026-02-27 04:00:13', '2026-03-05 07:29:04', NULL),
(17, 1, 'Complete Guide to PHP 8', 'complete-guide-to-php-8', 6, 'PHP 8 introduced many powerful features like JIT compiler, union types, and attributes.', 'php8.jpg', 10, 0, 1, 1, 'Complete Guide to PHP 8', 'php,php8,backend', 'Learn everything about PHP 8 new features.', '2026-02-27 04:07:13', '2026-03-03 08:03:09', NULL),
(18, 1, 'Getting Started with Bootstrap 5', 'getting-started-with-bootstrap-5', 2, 'Bootstrap 5 helps you build responsive websites quickly with modern UI components.', 'bootstrap5.jpg', 0, 1, 1, 1, 'Getting Started with Bootstrap 5', 'bootstrap,css,frontend', 'Beginner guide to Bootstrap 5 framework.', '2026-02-27 04:07:13', '2026-03-03 08:02:54', NULL),
(19, 1, 'Understanding REST API in Laravel', 'understanding-rest-api-in-laravel', 6, 'Learn how to create and consume REST APIs using Laravel.', 'laravel-api.jpg', 1, 0, 1, 1, 'Understanding REST API in Laravel', 'laravel,api,rest', 'Step-by-step Laravel REST API development tutorial.', '2026-02-27 04:07:13', '2026-03-03 08:02:42', NULL),
(20, 1, 'How to Improve Website SEO', 'how-to-improve-website-seo', 3, 'SEO techniques to increase traffic and improve search engine ranking.', 'seo-tips.jpg', 1, 1, 1, 1, 'How to Improve Website SEO', 'seo,marketing,ranking', 'Best SEO strategies for websites.', '2026-02-27 04:07:13', '2026-03-03 08:22:22', NULL),
(21, 1, 'Introduction to JavaScript ES6', 'introduction-to-javascript-es6', 2, 'ES6 introduced arrow functions, let/const, promises, and modules.', '77b750db5a7725227403c514dba646bc.jpg', 4, 0, 1, 1, 'Introduction to JavaScript ES6', 'javascript,es6,frontend', 'Modern JavaScript ES6 features explained.', '2026-02-27 04:07:13', '2026-03-09 07:53:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 21, 5, NULL, NULL),
(2, 20, 2, NULL, NULL),
(3, 19, 3, NULL, NULL),
(4, 19, 4, NULL, NULL),
(5, 18, 5, NULL, NULL),
(6, 18, 4, NULL, NULL),
(7, 18, 1, NULL, NULL),
(8, 17, 3, NULL, NULL),
(9, 17, 5, NULL, NULL),
(10, 17, 4, NULL, NULL),
(11, 17, 1, NULL, NULL),
(12, 16, 3, NULL, NULL),
(13, 16, 5, NULL, NULL),
(14, 16, 4, NULL, NULL),
(15, 16, 1, NULL, NULL),
(16, 16, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `icon`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', 'fab fa-facebook', 'web development', '2026-03-10 13:23:56', '2026-03-10 13:23:56');

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
('HA6QWoNIFKLKSpprrg7ToGWFxvIHxRtnrd3tLqwa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibTNBV2YybXNwS0RtRGhla255a2pWVERIY0huSTVaaDdJQ3V6UTdDRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771256752),
('rNPpo1yd6AYhCUfwKlDEuls2uLWljxq018ywZ8DD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVl3aWlJU3paWThIcWJManA5Rk02VU5LbHRSdGZrbk1yNU5qd3pYUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771307225);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `site_introduction` text DEFAULT NULL,
  `about_description` text DEFAULT NULL,
  `logo_dark` varchar(255) NOT NULL,
  `logo_light` varchar(255) NOT NULL,
  `copyright_text` longtext NOT NULL,
  `enable_registration` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_title`, `tagline`, `description`, `site_introduction`, `about_description`, `logo_dark`, `logo_light`, `copyright_text`, `enable_registration`, `created_at`, `updated_at`) VALUES
(1, 'Suchana', 'Laravel Blog Project', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Porro tenetur non laudantium! Autem, similique. Error quidem sequi adipisci, voluptatem sunt possimus cum. Nisi, nobis quia! Odio, vel similique. Corrupti, a!', NULL, NULL, 'logo_dark_tu0Hq.png', 'logo_light_rdAV6.png', '© 2026, Oredoo, All Rights Reserved.', 1, '2025-12-09 08:05:21', '2026-03-03 08:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `title`, `icon`, `link`, `color`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Facebook', 'fab fa-facebook', 'https://web.facebook.com/', '#000000', 1, '2026-02-27 04:51:05', '2026-02-27 04:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'sport', NULL, NULL),
(2, 'Technology', '2026-02-27 03:58:24', '2026-02-27 03:58:24'),
(3, 'Business', '2026-02-27 03:58:24', '2026-02-27 03:58:24'),
(4, 'Health', '2026-02-27 03:58:24', '2026-02-27 03:58:24'),
(5, 'Education', '2026-02-27 03:58:24', '2026-02-27 03:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tools_seo`
--

CREATE TABLE `tools_seo` (
  `id` int(11) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `og_image` varchar(255) NOT NULL,
  `meta_keywords` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tools_seo`
--

INSERT INTO `tools_seo` (`id`, `page_slug`, `meta_title`, `meta_description`, `og_image`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'online-calculator', 'Online Calculator', 'something used for making mathematical calculations, in particular a small electronic device with a keyboard and a visual display.', '1772602277_online-calculator.png', 'calculator, online-calculator', '2026-03-04 05:06:46', '2026-03-04 05:06:46'),
(2, 'online-age-calcluator', 'Age Calculator', 'This free age calculator computes age in terms of years, months, weeks, days, hours, minutes, and seconds, given a date of birth.', '1772601727_online-age-calcluator.png', 'age, age-calculator, calculator', '2026-03-04 05:22:07', '2026-03-04 05:22:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `about` longtext DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `profile`, `about`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`) VALUES
(1, 'Admin', 'admin', 'admin@admin.com', NULL, NULL, 3, 1, NULL, '$2y$10$03gA/M42vx1hcUIt3PnT/uSVqQuN5YTKzGj.f2VPy52R47f0mqfUK', 'pmqU9ZbvkJGcrpR03WEtSCoP9xXHmL9xH8NJfhi1IBPz9tAMJQphKlbpVNfc', '2025-12-09 08:05:21', '2025-12-09 08:05:21', NULL, NULL, NULL, NULL, NULL),
(2, 'Hamza Noor', 'hamzanoor', 'hamzanoor@gmail.com', NULL, 'hamza noor', 2, 1, NULL, '$2y$10$lWVXCi7RUGIlfqDN9Tb0uu0WYP71kIUDgaHXU82fpFmSD8YarknGC', NULL, '2026-03-02 08:39:16', '2026-03-02 08:39:16', NULL, NULL, NULL, NULL, NULL),
(3, 'Sajid Ali', 'eventorg', 'sajid40830@gmail.com', NULL, NULL, 1, 1, NULL, '$2y$10$2AvwqQEffrJ0q7NZFUZtgO9rRgM6XFDEgkPN/8BgieF3jbMjw4/TW', 'oKi9A1pDLSrMslwtkO9F5vfCLWQalsr8GF4IPsaLd2EIvugbejzUM341Cnca', '2026-03-03 04:54:17', '2026-03-03 04:54:17', NULL, NULL, NULL, NULL, NULL),
(4, 'test', 'test', 'test@gmail.com', NULL, NULL, 1, 1, NULL, '$2y$10$.KaojV0K7qZ2CLOWQYcmL.iFS0je687NCJ1XiBvhnKxId8VX0xbxy', NULL, '2026-03-03 05:18:02', '2026-03-03 05:18:02', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tools_seo`
--
ALTER TABLE `tools_seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tools_seo`
--
ALTER TABLE `tools_seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
