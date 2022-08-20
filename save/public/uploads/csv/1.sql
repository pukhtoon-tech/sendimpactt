-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2022 at 08:32 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khadyosaas_skeleton`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Automatefood', '2022-01-01 04:25:16', '2022-01-01 04:25:16'),
(2, 'site_email', 'support@softtech-it.com', '2022-01-01 04:25:16', '2022-01-01 04:25:16'),
(3, 'site_phone', '+8801677701493', '2022-01-01 04:25:16', '2022-01-01 04:25:16'),
(4, 'site_facebook', 'https://www.facebook.com/softtechitofficial', '2022-01-01 04:25:16', '2022-01-01 04:25:16'),
(5, 'site_instagram', 'https://www.instagram.com/khadyo_restaurant_software/', '2022-01-01 04:25:16', '2022-01-01 04:25:16'),
(6, 'site_twitter', 'https://twitter.com/SofttechITLtd', '2022-01-01 04:25:16', '2022-01-01 04:25:16'),
(7, 'site_youtube', 'https://www.youtube.com/channel/UCnzDLxpdXEQ2qwwwBmnVSYg', '2022-01-01 04:25:16', '2022-01-01 04:25:16'),
(8, 'site_linkedin', 'https://www.linkedin.com/company/softtech-it-limited', '2022-01-01 04:25:16', '2022-01-01 04:25:16'),
(9, 'site_logo', 'uploads/application/yV0NuIPwxHcGxRSxnuzxgLMwtYBhiFyJVmMYpgbD.png', '2022-01-01 04:26:07', '2022-01-01 04:26:07'),
(10, 'site_dark_logo', 'uploads/application/gm4NzKzEmGB8jsyEbvNXQlJIQVQ6JR8aGjNeyzS0.png', '2022-01-01 04:26:07', '2022-01-01 04:26:07'),
(11, 'site_favicon', 'uploads/application/Mal7ZlPN9F7GzeruNIZbd0refAqUvfJQ7m0ZR5M6.png', '2022-01-01 04:26:07', '2022-01-01 04:26:08'),
(12, 'site_gateway_supports', 'uploads/application/aj9eQEKc4QucNawJlABCal85Qd9WIvKhZEWm6Ige.png', '2022-01-01 04:26:08', '2022-01-01 04:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `domain` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `slug`, `status`, `domain`, `created_at`, `updated_at`) VALUES
(1, 'Uttara', 'uttara', 1, 'dadas.automatefood.com', NULL, NULL),
(2, 'Tejgaon', 'tejgaon', 1, 'dadas.automatefood.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`, `slug`, `active`, `created_at`, `updated_at`) VALUES
(1, 'POS Screen', 'pos-screen', 1, '2021-12-06 23:55:55', '2021-12-06 23:55:55'),
(2, 'Report', 'report', 1, '2021-12-06 23:56:01', '2021-12-06 23:56:01'),
(3, 'Customers', 'customers', 1, '2021-12-08 02:18:52', '2021-12-08 02:18:52'),
(4, 'Stock Management', 'stock-management', 1, '2021-12-08 02:19:13', '2021-12-08 02:19:13'),
(5, 'Frontend', 'frontend', 1, '2021-12-08 02:20:27', '2021-12-08 02:20:27'),
(6, 'Work period', 'work-period', 1, '2021-12-08 02:22:56', '2021-12-08 02:22:56'),
(8, 'Order', 'order', 1, '2021-12-08 03:55:21', '2021-12-31 23:32:44'),
(9, 'Settle', 'settle', 1, '2021-12-08 06:17:50', '2021-12-08 06:17:50'),
(10, 'Online Payment', 'online-payment', 1, '2021-12-09 00:49:41', '2021-12-09 00:49:41'),
(12, 'Maildoll', 'maildoll', 1, '2021-12-14 23:35:32', '2021-12-14 23:35:32'),
(13, 'Manyvendor', 'manyvendor', 1, '2021-12-14 23:36:08', '2021-12-14 23:36:08'),
(17, 'superadmin', 'superadmin', 1, '2021-12-14 23:59:41', '2021-12-31 23:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `item_limit_counts`
--

CREATE TABLE `item_limit_counts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `domain` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_id` bigint(20) UNSIGNED DEFAULT NULL,
  `items` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_limit_counts`
--

INSERT INTO `item_limit_counts` (`id`, `user_id`, `domain`, `subscription_id`, `items`, `branch`, `created_at`, `updated_at`) VALUES
(5, 123, 'dolorem.automatefood.com', 5, '10', '2', '2022-01-01 22:31:12', '2022-01-01 22:31:12'),
(6, 124, 'princed.automatefood.com', 6, '10', '2', '2022-01-01 22:54:46', '2022-01-01 22:54:46'),
(7, 125, 'dadas.automatefood.com', 7, '10', '2', '2022-01-01 23:39:55', '2022-01-01 23:39:55'),
(9, 127, 'mpora.automatefood.com', 9, '10', '2', '2022-01-29 04:52:39', '2022-01-29 04:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(2, 'default', '{\"uuid\":\"8f796237-a1fc-492f-afa3-92a737fe674e\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":29:{s:7:\\\"details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\PaymentHistory\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"bocefunelu@mailinator.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1641009188, 1641009188),
(3, 'default', '{\"uuid\":\"94a76dbd-163c-4775-83b5-92992a2e72f0\",\"displayName\":\"App\\\\Mail\\\\DomainInvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\DomainInvoiceMail\\\":29:{s:7:\\\"details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\PaymentHistory\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"bocefunelu@mailinator.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1641009188, 1641009188),
(4, 'default', '{\"uuid\":\"a65e1ab6-0957-4285-8b1b-83055c515f9f\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":29:{s:7:\\\"details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\PaymentHistory\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"gibetubo@mailinator.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1641038240, 1641038240),
(5, 'default', '{\"uuid\":\"ee425628-32b0-4037-9b7d-0aa98de75a05\",\"displayName\":\"App\\\\Mail\\\\DomainInvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\DomainInvoiceMail\\\":29:{s:7:\\\"details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\PaymentHistory\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"gibetubo@mailinator.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1641038240, 1641038240),
(6, 'default', '{\"uuid\":\"99cd233e-f084-4261-b0b2-2ea23159297b\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":29:{s:7:\\\"details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\PaymentHistory\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"loxogowi@mailinator.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1641097879, 1641097879),
(7, 'default', '{\"uuid\":\"1b1d30fb-39d3-4c40-aed4-8fbf6dfccd4d\",\"displayName\":\"App\\\\Mail\\\\DomainInvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\DomainInvoiceMail\\\":29:{s:7:\\\"details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\PaymentHistory\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"loxogowi@mailinator.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1641097879, 1641097879),
(8, 'default', '{\"uuid\":\"c74dbf75-d6cd-4952-bd9f-05b0ad21b6a7\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":29:{s:7:\\\"details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\PaymentHistory\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"zuji@mailinator.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1641099292, 1641099292),
(9, 'default', '{\"uuid\":\"8b14c856-6a1e-41a1-9a55-5ff2cc24c522\",\"displayName\":\"App\\\\Mail\\\\DomainInvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\DomainInvoiceMail\\\":29:{s:7:\\\"details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\PaymentHistory\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"zuji@mailinator.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1641099292, 1641099292),
(10, 'default', '{\"uuid\":\"22ff73c5-be26-4b6a-9e6b-3782bf834d1b\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":29:{s:7:\\\"details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\PaymentHistory\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"fizi@mailinator.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1641102001, 1641102001),
(11, 'default', '{\"uuid\":\"1ad844b6-a5cb-4c27-9766-3326889f8d44\",\"displayName\":\"App\\\\Mail\\\\DomainInvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\DomainInvoiceMail\\\":29:{s:7:\\\"details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\PaymentHistory\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:19:\\\"fizi@mailinator.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1641102001, 1641102001),
(14, 'default', '{\"uuid\":\"759a5929-9667-4b30-8f51-77e51d095eb8\",\"displayName\":\"App\\\\Mail\\\\InvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:20:\\\"App\\\\Mail\\\\InvoiceMail\\\":29:{s:7:\\\"details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\PaymentHistory\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"hagavoka@mailinator.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"},\"sentry_trace_parent_data\":\"ff78d52a2ec6424092285738c78b0d54-c0e9fbd4aa4f4e2a-1\"}', 0, NULL, 1643453570, 1643453570),
(15, 'default', '{\"uuid\":\"1c89f345-ffc9-4a0b-b2f9-22a38ae63eff\",\"displayName\":\"App\\\\Mail\\\\DomainInvoiceMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:26:\\\"App\\\\Mail\\\\DomainInvoiceMail\\\":29:{s:7:\\\"details\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":4:{s:5:\\\"class\\\";s:25:\\\"App\\\\Models\\\\PaymentHistory\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";}s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"hagavoka@mailinator.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"},\"sentry_trace_parent_data\":\"ff78d52a2ec6424092285738c78b0d54-c0e9fbd4aa4f4e2a-1\"}', 0, NULL, 1643453570, 1643453570);

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
(83, '2014_10_12_000000_create_users_table', 1),
(84, '2014_10_12_100000_create_password_resets_table', 1),
(90, '2019_08_19_000000_create_failed_jobs_table', 1),
(91, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(93, '2021_12_06_090312_create_features_table', 1),
(94, '2021_12_06_091145_create_packages_table', 1),
(98, '2021_12_02_054619_create_subscriptions_table', 2),
(100, '2021_12_06_130511_create_item_limit_counts_table', 2),
(102, '2021_12_06_092549_create_payment_histories_table', 3),
(105, '2021_12_11_103235_create_jobs_table', 4),
(107, '2021_12_12_071853_create_system_currencies_table', 5),
(109, '2021_12_20_061259_create_recent_activities_table', 6),
(110, '2021_12_29_101706_create_newsletters_table', 7),
(111, '2022_01_01_080725_create_seos_table', 8),
(112, '2022_01_01_080956_create_applications_table', 8),
(114, '2022_02_06_045500_create_branches_table', 10),
(120, '2022_02_05_084557_create_carts_table', 11),
(127, '2022_02_10_113226_create_order_items_table', 12),
(128, '2022_02_10_113259_create_order_item_variations_table', 12),
(129, '2022_02_10_113330_create_order_item_properties_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `food_id` bigint(20) UNSIGNED DEFAULT NULL,
  `food_name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `food_price` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_property` tinyint(1) DEFAULT NULL,
  `has_variation` tinyint(1) DEFAULT NULL,
  `quantity` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sum` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `user_id`, `food_id`, `food_name`, `food_price`, `has_property`, `has_variation`, `quantity`, `sum`, `status`, `domain`, `created_at`, `updated_at`) VALUES
(1, 100, 57, 'Pizzale', '90', 1, 1, '4', '460', 'cart', 'dadas.automatefood.com', '2022-02-16 01:14:00', '2022-02-16 01:14:56'),
(2, 100, 56, 'Beef Burger', '100', 1, 0, '1', '160', 'cart', 'dadas.automatefood.com', '2022-02-16 01:14:03', '2022-02-16 01:15:05'),
(3, 100, 55, 'Spicy Chicken Burger', '50', 0, 0, '1', '50', 'cart', 'dadas.automatefood.com', '2022-02-16 01:14:07', '2022-02-16 01:14:07'),
(4, 100, 60, 'Naga Cheese', '150', 1, 0, '1', '210', 'cart', 'dadas.automatefood.com', '2022-02-16 01:14:10', '2022-02-16 01:15:08'),
(5, 100, 58, 'Prince', '20', 1, 1, '6', '234', 'cart', 'dadas.automatefood.com', '2022-02-16 01:14:12', '2022-02-16 01:15:12'),
(6, 100, 57, 'Pizzale', '90', 1, 1, '1', '90', 'cart', 'princed.automatefood.com', '2022-02-16 01:20:21', '2022-02-16 01:20:21'),
(9, 100, 57, 'Pizzale', '90', 1, 1, '3', '355', 'cart', 'chester.automatefood.com', '2022-02-16 01:23:36', '2022-02-16 01:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_item_properties`
--

CREATE TABLE `order_item_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `food_id` bigint(20) UNSIGNED DEFAULT NULL,
  `property_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `property_group_id` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_group_name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_price` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sum` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_item_properties`
--

INSERT INTO `order_item_properties` (`id`, `order_id`, `food_id`, `property_item_id`, `property_group_id`, `property_group_name`, `property_name`, `property_price`, `quantity`, `sum`, `domain`, `created_at`, `updated_at`) VALUES
(1, 1, 57, 1, '1', 'Sauce', 'Egg', '10', '1', '10', 'dadas.automatefood.com', '2022-02-16 01:14:26', '2022-02-16 01:14:26'),
(2, 1, 57, 2, '1', 'Sauce', 'Mild', '10', '1', '10', 'dadas.automatefood.com', '2022-02-16 01:14:28', '2022-02-16 01:14:28'),
(3, 1, 57, 3, '2', 'Spice', 'Mild', '20', '1', '20', 'dadas.automatefood.com', '2022-02-16 01:14:29', '2022-02-16 01:14:29'),
(4, 2, 56, 1, '1', 'Sauce', 'Egg', '10', '2', '20', 'dadas.automatefood.com', '2022-02-16 01:14:30', '2022-02-16 01:15:03'),
(5, 2, 56, 2, '1', 'Sauce', 'Mild', '10', '2', '20', 'dadas.automatefood.com', '2022-02-16 01:14:31', '2022-02-16 01:15:05'),
(6, 2, 56, 3, '2', 'Spice', 'Mild', '20', '1', '20', 'dadas.automatefood.com', '2022-02-16 01:14:33', '2022-02-16 01:14:33'),
(7, 4, 60, 1, '1', 'Sauce', 'Egg', '10', '2', '20', 'dadas.automatefood.com', '2022-02-16 01:14:35', '2022-02-16 01:15:07'),
(8, 4, 60, 2, '1', 'Sauce', 'Mild', '10', '2', '20', 'dadas.automatefood.com', '2022-02-16 01:14:37', '2022-02-16 01:15:08'),
(9, 4, 60, 3, '2', 'Spice', 'Mild', '20', '1', '20', 'dadas.automatefood.com', '2022-02-16 01:14:38', '2022-02-16 01:14:38'),
(10, 5, 58, 1, '1', 'Sauce', 'Egg', '10', '1', '10', 'dadas.automatefood.com', '2022-02-16 01:14:46', '2022-02-16 01:14:46'),
(11, 5, 58, 2, '1', 'Sauce', 'Mild', '10', '1', '10', 'dadas.automatefood.com', '2022-02-16 01:14:48', '2022-02-16 01:14:48'),
(12, 5, 58, 3, '2', 'Spice', 'Mild', '20', '1', '20', 'dadas.automatefood.com', '2022-02-16 01:14:50', '2022-02-16 01:14:50'),
(13, 9, 57, 1, '1', 'Sauce', 'Egg', '10', '1', '10', 'chester.automatefood.com', '2022-02-16 01:23:44', '2022-02-16 01:23:44'),
(14, 9, 57, 2, '1', 'Sauce', 'Mild', '10', '1', '10', 'chester.automatefood.com', '2022-02-16 01:24:04', '2022-02-16 01:24:04'),
(15, 9, 57, 3, '2', 'Spice', 'Mild', '20', '1', '20', 'chester.automatefood.com', '2022-02-16 01:24:06', '2022-02-16 01:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_item_variations`
--

CREATE TABLE `order_item_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `food_id` bigint(20) UNSIGNED DEFAULT NULL,
  `variation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `variation_name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variation_price` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sum` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_item_variations`
--

INSERT INTO `order_item_variations` (`id`, `order_id`, `food_id`, `variation_id`, `variation_name`, `variation_price`, `quantity`, `sum`, `domain`, `created_at`, `updated_at`) VALUES
(1, 1, 57, 73, 'small', '10', '1', '10', 'dadas.automatefood.com', '2022-02-16 01:14:18', '2022-02-16 01:14:18'),
(2, 1, 57, 74, 'large', '20', '1', '20', 'dadas.automatefood.com', '2022-02-16 01:14:24', '2022-02-16 01:14:24'),
(3, 1, 57, 75, 'medium', '15', '2', '30', 'dadas.automatefood.com', '2022-02-16 01:14:26', '2022-02-16 01:14:56'),
(4, 5, 58, 76, 'small', '10', '2', '20', 'dadas.automatefood.com', '2022-02-16 01:14:40', '2022-02-16 01:15:09'),
(5, 5, 58, 77, 'large', '12', '2', '24', 'dadas.automatefood.com', '2022-02-16 01:14:42', '2022-02-16 01:15:11'),
(6, 5, 58, 78, 'medium', '15', '2', '30', 'dadas.automatefood.com', '2022-02-16 01:14:44', '2022-02-16 01:15:12'),
(7, 9, 57, 73, 'small', '10', '1', '10', 'chester.automatefood.com', '2022-02-16 01:23:39', '2022-02-16 01:23:39'),
(8, 9, 57, 74, 'large', '20', '1', '20', 'chester.automatefood.com', '2022-02-16 01:23:40', '2022-02-16 01:23:40'),
(9, 9, 57, 75, 'medium', '15', '1', '15', 'chester.automatefood.com', '2022-02-16 01:23:41', '2022-02-16 01:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `trial` tinyint(1) NOT NULL DEFAULT 0,
  `feature_id` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `items` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `range` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `range_type` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `slug`, `active`, `trial`, `feature_id`, `price`, `items`, `branch`, `range`, `range_type`, `created_at`, `updated_at`) VALUES
(1, 'Free', 'free', 1, 1, '[\"1\",\"2\"]', 0, '10', '2', '7', 'day', '2021-12-06 23:56:21', '2021-12-06 23:56:21'),
(3, 'Standard', 'standard', 1, 0, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"9\",\"8\"]', 20, '20', '1', '31', 'month', '2021-12-08 06:21:20', '2021-12-08 06:21:20'),
(4, 'Premium', 'premium', 1, 0, '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 50, '50', '1', '1', 'month', '2021-12-08 06:55:35', '2022-01-03 03:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_histories`
--

CREATE TABLE `payment_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` longtext COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `payment_status` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_gateway` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `trx_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_at` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_histories`
--

INSERT INTO `payment_histories` (`id`, `user_id`, `invoice`, `domain`, `subscription_id`, `package_id`, `payment_status`, `payment_gateway`, `amount`, `trx_id`, `start_at`, `end_at`, `created_at`, `updated_at`) VALUES
(6, 123, '20229478', 'dolorem.automatefood.com', 5, '1', 'trial', 'Automatefood', 0, '5E8iAevI71', '2022-01-02 04:31:12', '2022-01-09 04:31:12', '2022-01-01 22:31:12', '2022-01-01 22:31:12'),
(7, 124, '20226388', 'princed.automatefood.com', 6, '1', 'trial', 'Automatefood', 0, 'UF4TvJDdi7', '2022-01-02 04:54:46', '2022-01-09 04:54:46', '2022-01-01 22:54:46', '2022-01-01 22:54:46'),
(8, 125, '20228774', 'dadas.automatefood.com', 7, '1', 'trial', 'Automatefood', 0, 'GwtsZQWaRK', '2022-01-02 05:39:55', '2022-01-09 05:39:55', '2022-01-01 23:39:55', '2022-01-01 23:39:55'),
(10, 127, '20228612', 'mpora.automatefood.com', 9, '1', 'trial', 'Automatefood', 0, 'ViTO0FziUK', '2022-01-29 10:52:39', '2022-02-05 10:52:39', '2022-01-29 04:52:39', '2022-01-29 04:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recent_activities`
--

CREATE TABLE `recent_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recent_activities`
--

INSERT INTO `recent_activities` (`id`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Harper Huff is the new customer of Automatefood', '2021-12-31 21:53:14', '2021-12-31 21:53:14'),
(2, 'admin feature status changed', '2021-12-31 23:30:23', '2021-12-31 23:30:23'),
(3, 'admin feature status changed', '2021-12-31 23:30:28', '2021-12-31 23:30:28'),
(4, 'superadmin feature updated', '2021-12-31 23:31:07', '2021-12-31 23:31:07'),
(5, 'Ivor Morales feature deleted', '2021-12-31 23:31:41', '2021-12-31 23:31:41'),
(6, 'Shad Salinas feature deleted', '2021-12-31 23:31:48', '2021-12-31 23:31:48'),
(7, 'Francesca Mcneil feature deleted', '2021-12-31 23:32:19', '2021-12-31 23:32:19'),
(8, 'Test feature deleted', '2021-12-31 23:32:38', '2021-12-31 23:32:38'),
(9, 'Order feature status changed', '2021-12-31 23:32:44', '2021-12-31 23:32:44'),
(10, 'Gold package updated', '2022-01-01 00:00:32', '2022-01-01 00:00:32'),
(11, 'Gold package updated', '2022-01-01 00:00:35', '2022-01-01 00:00:35'),
(12, 'Goldest package updated', '2022-01-01 00:00:57', '2022-01-01 00:00:57'),
(13, 'Goldest package updated', '2022-01-01 00:02:14', '2022-01-01 00:02:14'),
(14, 'Goldest package updated', '2022-01-01 00:02:50', '2022-01-01 00:02:50'),
(15, 'Gold package updated', '2022-01-01 00:02:57', '2022-01-01 00:02:57'),
(16, 'Basic package deleted', '2022-01-01 00:05:55', '2022-01-01 00:05:55'),
(17, 'Enterprise package deleted', '2022-01-01 00:06:44', '2022-01-01 00:06:44'),
(18, 'Gold package deleted', '2022-01-01 00:06:50', '2022-01-01 00:06:50'),
(19, 'SSL COMMERZ Setup done', '2022-01-01 01:38:35', '2022-01-01 01:38:35'),
(20, 'SSL COMMERZ Setup done', '2022-01-01 01:38:51', '2022-01-01 01:38:51'),
(21, 'SSL COMMERZ Setup done', '2022-01-01 01:39:02', '2022-01-01 01:39:02'),
(22, 'SSL COMMERZ Setup done', '2022-01-01 01:39:05', '2022-01-01 01:39:05'),
(23, 'BRAINTREE Setup done', '2022-01-01 01:44:54', '2022-01-01 01:44:54'),
(24, 'BRAINTREE Setup done', '2022-01-01 01:45:00', '2022-01-01 01:45:00'),
(25, 'BRAINTREE Setup done', '2022-01-01 01:45:06', '2022-01-01 01:45:06'),
(26, 'BRAINTREE Setup done', '2022-01-01 01:45:08', '2022-01-01 01:45:08'),
(27, 'Jeremy Blake is the new customer of Automatefood', '2022-01-01 05:57:30', '2022-01-01 05:57:30'),
(28, 'Jeremy Blake  subscription limit updated', '2022-01-01 21:52:57', '2022-01-01 21:52:57'),
(29, 'Jeremy Blake  subscription limit updated', '2022-01-01 21:53:22', '2022-01-01 21:53:22'),
(30, 'Jeremy Blake  subscription limit updated', '2022-01-01 21:53:48', '2022-01-01 21:53:48'),
(31, 'gibetub.automatefood.com domain expiry alert sent', '2022-01-01 22:01:40', '2022-01-01 22:01:40'),
(32, 'prince.automatefood.com domain expeled', '2022-01-01 22:26:22', '2022-01-01 22:26:22'),
(33, 'prince.automatefood.com domain expeled', '2022-01-01 22:26:58', '2022-01-01 22:26:58'),
(34, 'Sydney Price is the new customer of Automatefood', '2022-01-01 22:31:28', '2022-01-01 22:31:28'),
(35, 'Sydney Price has been unblocked', '2022-01-01 22:31:44', '2022-01-01 22:31:44'),
(36, 'Zoe Shannon is the new customer of Automatefood', '2022-01-01 22:54:57', '2022-01-01 22:54:57'),
(37, 'Desiree Mack is the new customer of Automatefood', '2022-01-01 23:40:11', '2022-01-01 23:40:11'),
(38, 'Premium feature status changed', '2022-01-03 03:21:32', '2022-01-03 03:21:32'),
(39, 'Premium feature status changed', '2022-01-03 03:21:35', '2022-01-03 03:21:35'),
(40, 'Beck Soto is the new customer of Automatefood', '2022-01-29 04:52:56', '2022-01-29 04:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_title', 'Automatefood Restaurant Management Solution by SoftTech-IT', '2022-01-01 03:26:19', '2022-01-01 03:34:36'),
(2, 'site_description', 'Automatefood Restaurant Management Solution by SoftTech-IT', '2022-01-01 03:34:36', '2022-01-01 03:34:36'),
(3, 'site_keywords', 'a,b,e,f,q,d', '2022-01-01 03:34:36', '2022-01-01 03:34:36'),
(4, 'site_author', 'SoftTech-IT', '2022-01-01 03:34:36', '2022-01-01 03:34:36'),
(5, 'site_copyright', 'SoftTech-IT', '2022-01-01 03:34:36', '2022-01-01 03:34:36'),
(6, 'site_thumbnail', 'uploads/seo/YNxSnbr8kr5Eoov5LMGRNQSbQb3dU03TGcahHIWf.png', '2022-01-01 03:40:12', '2022-01-01 03:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `domain` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `items` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` longtext COLLATE utf8mb4_unicode_ci DEFAULT '5',
  `start_at` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_at` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `payment_status` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_gateway` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `package_id`, `domain`, `items`, `branch`, `start_at`, `end_at`, `active`, `payment_status`, `payment_gateway`, `amount`, `created_at`, `updated_at`) VALUES
(5, 123, 1, 'dolorem.automatefood.com', '10', '2', '2022-01-02 04:31:12', '2022-01-09 04:31:12', 1, 'trial', 'Automatefood', 0, '2022-01-01 22:31:12', '2022-01-01 22:31:12'),
(6, 124, 1, 'princed.automatefood.com', '10', '2', '2022-01-02 04:54:46', '2022-01-09 04:54:46', 1, 'trial', 'Automatefood', 0, '2022-01-01 22:54:46', '2022-01-01 22:54:46'),
(7, 125, 1, 'dadas.automatefood.com', '10', '2', '2022-01-02 05:39:55', '2022-01-09 05:39:55', 1, 'trial', 'Automatefood', 0, '2022-01-01 23:39:55', '2022-01-01 23:39:55'),
(9, 127, 1, 'mpora.automatefood.com', '10', '2', '2022-01-29 10:52:39', '2022-02-05 10:52:39', 1, 'trial', 'Automatefood', 0, '2022-01-29 04:52:39', '2022-01-29 04:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `system_currencies`
--

CREATE TABLE `system_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_currencies`
--

INSERT INTO `system_currencies` (`id`, `name`, `code`, `symbol`, `icon`, `amount`, `default`, `created_at`, `updated_at`) VALUES
(1, 'US Dollar', '840', 'USD', '$', '1', 1, '2021-12-17 21:18:04', '2021-12-29 06:37:01'),
(2, 'Taka', '50', 'BDT', '৳', '85.83', 0, '2021-12-18 23:27:05', '2021-12-29 06:37:02'),
(3, 'Euro', '978', 'EUR', '€', '0.88', 0, '2021-12-18 23:47:35', '2021-12-29 06:37:03'),
(4, 'Indian Rupee', '356', 'INR', '₹', '74.73', 0, '2021-12-19 21:48:35', '2021-12-29 06:37:05'),
(5, 'Turkish Lira', '949', 'TRY', '₺', '11.88', 0, '2021-12-20 00:40:31', '2021-12-29 06:37:11'),
(6, 'Mexican Peso', '484', 'MXN', '$', '20.67', 0, '2021-12-20 00:43:19', '2021-12-29 06:37:14'),
(7, 'Bulgarian Lev', '975', 'BGN', 'лв', '1.73', 0, '2021-12-28 02:52:11', '2021-12-29 06:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `otp` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domain` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rest_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rest_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` longtext COLLATE utf8mb4_unicode_ci DEFAULT 'Bangladesh',
  `country_code` longtext COLLATE utf8mb4_unicode_ci DEFAULT 'bd',
  `region_name` longtext COLLATE utf8mb4_unicode_ci DEFAULT 'Dhaka Division',
  `city` longtext COLLATE utf8mb4_unicode_ci DEFAULT 'Dhaka',
  `zip` longtext COLLATE utf8mb4_unicode_ci DEFAULT '1207',
  `lat` longtext COLLATE utf8mb4_unicode_ci DEFAULT '23.7731',
  `lon` longtext COLLATE utf8mb4_unicode_ci DEFAULT '90.3657',
  `timezone` longtext COLLATE utf8mb4_unicode_ci DEFAULT 'Asia/Dhaka',
  `restriction` tinyint(1) DEFAULT NULL,
  `active` longtext COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `otp`, `password`, `domain`, `rest_name`, `rest_address`, `role`, `country`, `country_code`, `region_name`, `city`, `zip`, `lat`, `lon`, `timezone`, `restriction`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mail.com', NULL, NULL, 'oQgn6g', '$2y$10$rLeOG5D2jQrZk0qAiZ.Znur7frXTQjGZ/xrt1hqsAKse4QMsp0t8a', NULL, NULL, NULL, 'admin', 'India', 'in', 'Mumbai', 'Gorai', '1207', '23.7731', '90.3657', 'Asia/Dhaka', 0, '1', NULL, '2021-12-06 23:55:23', '2022-01-01 21:42:39'),
(123, 'Sydney Price', 'loxogowi@mailinator.com', '+1 (458) 292-6319', NULL, 'sWU8Dn', '$2y$10$RTXq9Bidx.ca5iXizoQvE.EB0QXNvmczn/jIIItWZ8fJ8sskKY56q', 'dolorem.automatefood.com', 'Meatbox', '272/B, Dhaka', 'customer', 'India', 'in', 'Delhi', 'Alipur', '1212', '23.7908', '90.4109', 'Asia/Dhaka', 0, '1', NULL, '2022-01-01 22:31:12', '2022-01-01 22:31:44'),
(124, 'Zoe Shannon', 'zuji@mailinator.com', '+1 (359) 497-9862', NULL, 'qLowAx', '$2y$10$veBijsWqrCuUTkeYqlDoLe6Ba3Id4fJHxA.tQmOjRrF3kQne79IjC', 'princed.automatefood.com', 'Pizzaburg', '272/B, Dhaka', 'customer', 'Bangladesh', 'bd', 'Khulna Division', 'Koyra', '1212', '23.7908', '90.4109', 'Asia/Dhaka', 0, '1', NULL, '2022-01-01 22:54:46', '2022-01-01 22:54:46'),
(125, 'Desiree Mack', 'fizi@mailinator.com', '+8801533149024', NULL, 'omVbXE', '$2y$10$sUZ4y2QGyUcmo/NvLi9nlOkWvFJlr5kxUntqZlsz8bsU951mmZikS', 'dadas.automatefood.com', 'Food Khan', '272/B, Dhaka', 'customer', 'Bangladesh', 'bd', 'Dhaka Division', 'Dhaka', '1212', '23.7908', '90.4109', 'Asia/Dhaka', 0, '1', NULL, '2022-01-01 23:39:55', '2022-01-01 23:39:55'),
(127, 'Beck Soto', 'hagavoka@mailinator.com', '+1 (331) 671-5638', NULL, '3K1NnC', '$2y$10$2uRV94bFSozMaObB1UNUu.hbtc8WghyuojU8/CQzZSRSC41JkfVjK', 'mpora.automatefood.com', 'Brynne Ware', 'Anim nisi aut sit r', 'customer', 'United States', 'usa', 'New York', 'Queens', '1000', '23.7272', '90.4093', 'Asia/Dhaka', 0, '1', NULL, '2022-01-29 04:52:39', '2022-01-29 04:52:39'),
(128, 'Chester', 'chester@mailinator.com', '+1 (359) 497-9862', NULL, 'qLowAx', '$2y$10$veBijsWqrCuUTkeYqlDoLe6Ba3Id4fJHxA.tQmOjRrF3kQne79IjC', 'chester.automatefood.com', 'Banana Juice', '272/B, Dhaka', 'customer', 'Bangladesh', 'bd', 'Barishal Division', 'Pirojpur', '1212', '23.7908', '90.4109', 'Asia/Dhaka', 0, '1', NULL, '2022-01-01 22:54:46', '2022-01-01 22:54:46'),
(130, 'Zoe Shannon', 'weqe', '+1 (359) 497-9862', NULL, 'qLowAx', '$2y$10$veBijsWqrCuUTkeYqlDoLe6Ba3Id4fJHxA.tQmOjRrF3kQne79IjC', 'princed.automatefood.com', 'Pizzahut', '272/B, Dhaka', 'customer', 'Bangladesh', 'bd', 'Sylhet Division', 'Jaflnog', '1212', '23.7908', '90.4109', 'Asia/Dhaka', 0, '1', NULL, '2022-01-01 22:54:46', '2022-01-01 22:54:46'),
(131, 'Sydney Price', 'ertr@mailinator.com', '+1 (458) 292-6319', NULL, 'sWU8Dn', '$2y$10$RTXq9Bidx.ca5iXizoQvE.EB0QXNvmczn/jIIItWZ8fJ8sskKY56q', 'dolorem.automatefood.com', 'Mollika Snacks', '272/B, Dhaka', 'customer', 'India', 'in', 'Delhi', 'Deoli', '1212', '23.7908', '90.4109', 'Asia/Dhaka', 0, '1', NULL, '2022-01-01 22:31:12', '2022-01-01 22:31:44'),
(132, 'Desiree Mack', 'uytu@mailinator.com', '+8801533149024', NULL, 'omVbXE', '$2y$10$sUZ4y2QGyUcmo/NvLi9nlOkWvFJlr5kxUntqZlsz8bsU951mmZikS', 'dadas.automatefood.com', 'Khayer Cafe', '272/B, Dhaka', 'customer', 'Bangladesh', 'bd', 'Dhaka Division', 'Tejgaon', '1212', '23.7908', '90.4109', 'Asia/Dhaka', 0, '1', NULL, '2022-01-01 23:39:55', '2022-01-01 23:39:55'),
(133, 'Chester', 'ouiopui@mailinator.com', '+1 (359) 497-9862', NULL, 'qLowAx', '$2y$10$veBijsWqrCuUTkeYqlDoLe6Ba3Id4fJHxA.tQmOjRrF3kQne79IjC', 'chester.automatefood.com', 'HoneyBee', '272/B, Dhaka', 'customer', 'Bangladesh', 'bd', 'Barishal Division', 'Hijla', '1212', '23.7908', '90.4109', 'Asia/Dhaka', 0, '1', NULL, '2022-01-01 22:54:46', '2022-01-01 22:54:46'),
(134, 'Beck Soto', 'czxczx@mailinator.com', '+1 (331) 671-5638', NULL, '3K1NnC', '$2y$10$2uRV94bFSozMaObB1UNUu.hbtc8WghyuojU8/CQzZSRSC41JkfVjK', 'mpora.automatefood.com', 'Young Cafe', '272/B, Dhaka', 'customer', 'United States', 'usa', 'New York', 'Albany', '1000', '23.7272', '90.4093', 'Asia/Dhaka', 0, '1', NULL, '2022-01-29 04:52:39', '2022-01-29 04:52:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_limit_counts`
--
ALTER TABLE `item_limit_counts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item_properties`
--
ALTER TABLE `order_item_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item_variations`
--
ALTER TABLE `order_item_variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `recent_activities`
--
ALTER TABLE `recent_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_currencies`
--
ALTER TABLE `system_currencies`
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
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `item_limit_counts`
--
ALTER TABLE `item_limit_counts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_item_properties`
--
ALTER TABLE `order_item_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_item_variations`
--
ALTER TABLE `order_item_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_histories`
--
ALTER TABLE `payment_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recent_activities`
--
ALTER TABLE `recent_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `system_currencies`
--
ALTER TABLE `system_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
