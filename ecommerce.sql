-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 12:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`) VALUES
(1, 'Sofa & sectionals', 'sofa'),
(2, 'Chairs', 'chair'),
(3, 'Armchairs', 'arm-chair'),
(4, 'Tea Table', 'tea-table');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `message` text NOT NULL,
  `recieve_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `name`, `email`, `subject`, `phone_number`, `message`, `recieve_at`) VALUES
(1, 'uzair', '', 'test', 0, '', '2024-01-11 12:02:25'),
(2, 'uzair', '', 'test', 0, '', '2024-01-11 12:02:26'),
(3, 'uzair', '', 'test', 0, '', '2024-01-11 12:02:27'),
(4, 'uzair', '', 'test', 0, '', '2024-01-11 12:02:27'),
(5, 'uzair', '', 'test', 0, '', '2024-01-11 12:02:27'),
(6, 'uzair', '', 'test', 0, '', '2024-01-11 12:02:28'),
(7, 'uzair', '', 'test', 0, '', '2024-01-11 12:02:30'),
(8, 'uzair', '', 'test', 0, '', '2024-01-11 12:02:31'),
(9, 'uzair', '', 'test', 0, '', '2024-01-11 12:02:31'),
(10, 'uzair', '', 'test', 0, '', '2024-01-11 12:02:32'),
(11, 'uzair', '', 'test', 0, '', '2024-01-11 12:02:32'),
(12, 'uzair', '', 'test', 0, '', '2024-01-11 12:02:32'),
(13, 'Vaibhav Goswami', 'webdev@gmail.com', 'test', 2147483647, 'ljhgjsdkewjdi', '2024-01-11 12:07:37'),
(14, 'Vaibhav Goswami', 'webdev@gmail.com', 'test', 2147483647, 'ljhgjsdkewjdi', '2024-01-11 12:15:32'),
(15, 'uzair khan', 'uzairkhan7521@gmail.com', 'test', 2147483647, 'ehjtyhteh', '2024-01-11 12:19:06'),
(16, 'mohit', 'one@one.com', 'test', 2147483647, 'sdfthjy', '2024-01-11 12:20:12'),
(17, 'uzair khan', 'uzairkhan7521@gmail.com', 'test23', 2147483647, 'fregre', '2024-01-11 12:22:50'),
(18, 'mohit', 'webdev@gmail.com', 'test23', 2147483647, 'dfgh563', '2024-01-11 12:23:52'),
(19, 'uzair khan', 'uzairkhan7521@gmail.com', '', 2147483647, 'heyyy', '2024-01-12 09:15:47'),
(20, 'uzair khan', 'uzairkhan7521@gmail.com', '', 2147483647, 'ewrtghyjui', '2024-01-12 09:19:02'),
(21, 'uzair khan', 'uzairkhan7521@gmail.com', '', 2147483647, 'dfgty', '2024-01-12 09:22:32'),
(22, 'uzair khan', 'uzairkhan7521@gmail.com', '', 2147483647, 'dergthr', '2024-01-12 09:23:32'),
(23, 'uzair khan', 'uzairkhan7521@gmail.com', '', 2147483647, 'dergthr', '2024-01-12 09:23:34'),
(24, 'uzair khan', 'uzairkhan7521@gmail.com', '', 2147483647, 'ergtr5y', '2024-01-12 09:25:28'),
(25, 'uzair khan', 'uzairkhan7521@gmail.com', '', 2147483647, 'ergtr5y', '2024-01-12 09:25:29'),
(26, 'uzair', 'uzairkhan7521@gmail.com', '', 2147483647, 'dfger', '2024-01-12 09:26:43'),
(27, 'uzair', 'uzairkhan7521@gmail.com', '', 2147483647, 'dfger', '2024-01-12 09:26:44'),
(28, 'dsafsdf', 'viraj223@gmail.com', '', 2147483647, 'sdfds', '2024-01-12 09:27:54'),
(29, 'dsafsdf', 'viraj223@gmail.com', 'dsfsf', 2147483647, 'sdfds', '2024-01-12 09:28:38'),
(30, 'dsafsdf', 'viraj223@gmail.com', 'dsfsf', 2147483647, 'sdfds', '2024-01-12 09:29:16'),
(31, 'uzair khan', 'test@gmail.com', 'wfdsff', 3243, 'sdfsdf', '2024-01-12 09:29:38'),
(32, 'uzair khan', 'test@gmail.com', 'wfdsff', 3243, 'sdfsdf', '2024-01-12 09:29:40'),
(33, 'uzair khan', 'test@gmail.com', 'wfdsff', 3243, 'sdfsdf', '2024-01-12 09:30:16'),
(34, 'uzair khan', 'test@gmail.com', 'wfdsff', 3243, 'sdfsdf', '2024-01-12 09:31:13'),
(35, 'uzair khan', 'test@gmail.com', 'wfdsff', 3243, 'sdfsdf', '2024-01-12 09:33:33'),
(36, 'uzair khan', 'uzairkhan7521@gmail.com', 'test', 2147483647, 'erthyuu', '2024-01-12 09:34:06'),
(37, 'uzair khan', 'uzairkhan7521@gmail.com', 'test', 2147483647, 'iugyftd', '2024-01-12 09:43:35'),
(38, 'uzair khan', 'webdev@gmail.com', 'testing', 2147483647, 'hello world', '2024-01-12 09:44:51'),
(39, 'uzair khan', 'uzairkhan7521@gmail.com', 'wfdsff', 2147483647, 'dscdfer\n', '2024-01-12 09:49:26'),
(40, 'uzair khan', 'webdev@gmail.com', 'test', 2147483647, 'testing', '2024-01-12 09:51:17'),
(41, 'uzair khan', 'uzairkhan7521@gmail.com', 'test', 2147483647, 'testing\n', '2024-01-12 09:52:36'),
(42, 'uzair khan', 'uzairkhan7521@gmail.com', 'test', 2147483647, 'testing\n', '2024-01-12 09:53:05'),
(43, 'sara khan', 'webdev@gmail.com', 'test', 2147483647, 'testing', '2024-01-12 09:53:34'),
(44, 'sara khan', 'webdev@gmail.com', 'test', 2147483647, 'testing', '2024-01-12 09:53:35'),
(45, 'sara khan', 'webdev@gmail.com', 'test', 2147483647, 'testing', '2024-01-12 09:53:35'),
(46, 'sara khan', 'webdev@gmail.com', 'test', 2147483647, 'testing', '2024-01-12 09:55:43'),
(47, 'sara khan', 'uzairkhan7521@gmail.com', 'test', 2147483647, 'uwhsdjich', '2024-01-12 09:56:27'),
(48, 'sara khan', 'webdev@gmail.com', 'test', 2147483647, 'testing', '2024-01-12 09:57:24'),
(49, 'sara khan', 'webdev@gmail.com', 'test', 2147483647, 'testing', '2024-01-12 09:58:47'),
(50, 'uzair khan', 'uzairkhan7521@gmail.com', 'test', 2147483647, 'testing', '2024-01-12 10:41:37'),
(51, 'sara khan', 'webdev@gmail.com', 'test', 2147483647, 'testing', '2024-01-12 10:42:54'),
(52, 'sara khan', 'webdev@gmail.com', 'test23', 2147483647, 'testing', '2024-01-12 10:44:14'),
(53, '', '', '', 0, '', '2024-01-12 11:15:37'),
(54, '', '', '', 0, '', '2024-01-12 11:17:39'),
(55, '', '', '', 0, '', '2024-01-12 11:18:06'),
(56, '', '', '', 0, '', '2024-01-12 11:20:04'),
(57, '', '', '', 0, '', '2024-01-12 11:21:19'),
(58, '', '', '', 0, '', '2024-01-12 11:23:25'),
(59, '', '', '', 0, '', '2024-01-12 11:23:47'),
(60, '', '', '', 0, '', '2024-01-12 11:26:08'),
(61, '', '', '', 0, '', '2024-01-12 11:26:43'),
(62, '', '', '', 0, '', '2024-01-12 11:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `mail_data`
--

CREATE TABLE `mail_data` (
  `id` int(11) NOT NULL,
  `mail_of` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mail_data`
--

INSERT INTO `mail_data` (`id`, `mail_of`, `mail`, `created_at`) VALUES
(1, 'HR', 'affanakhlaq6666@gmail.com', '2024-01-12 11:46:23'),
(2, 'Get Quote', 'vaibhavgoswami2023@gmail.com', '2024-01-12 11:46:54'),
(3, 'contact', 'uzairkhan7521@gmail.com', '2024-01-12 09:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `media_data`
--

CREATE TABLE `media_data` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `alt_text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media_data`
--

INSERT INTO `media_data` (`id`, `image`, `title`, `alt_text`, `created_at`) VALUES
(6, '334191705312546.jpg', 'table', 'tea-table', '2024-01-15 15:25:46'),
(7, '727871705312546.jpg', 'Sofa', 'sofa', '2024-01-15 15:25:46'),
(8, '250531705312546.jpg', 'Sofa_one', 'img_of_sofa', '2024-01-15 15:25:46'),
(9, '669441705312546.jpg', 'table-chair', 'img of table-chair', '2024-01-15 15:25:46'),
(10, '830071705312546.jpg', 'luxury Bed', 'img of bed', '2024-01-15 15:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `meta_data`
--

CREATE TABLE `meta_data` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `page_topic` varchar(255) NOT NULL,
  `distribution` varchar(100) NOT NULL,
  `og_url` text NOT NULL,
  `og_title` varchar(255) NOT NULL,
  `og_image_url` text NOT NULL,
  `twitter_title` varchar(255) NOT NULL,
  `twitter_image_url` text NOT NULL,
  `description` text NOT NULL,
  `og_description` text NOT NULL,
  `twitter_description` text NOT NULL,
  `schema_` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meta_data`
--

INSERT INTO `meta_data` (`id`, `page_name`, `url`, `title`, `keywords`, `page_topic`, `distribution`, `og_url`, `og_title`, `og_image_url`, `twitter_title`, `twitter_image_url`, `description`, `og_description`, `twitter_description`, `schema_`, `created_at`) VALUES
(2, 'index.php', 'http://localhost:8080/projects/ecom/index.php', 'Bisum - Best e-commerce website', 'ecommerce website in lucknow, best website in lucknow for ecommerce', 'Home', '', 'http://localhost:8080/projects/ecom/index.php', 'Digicrowd Solution-Best Digital Marketing Company in Lucknow', 'https://digicrowdsolution.com/mystorage/media/increase-your-sales-min.webp', 'Digicrowd Solution-Best Digital Marketing Company in Lucknow', 'https://twitter.com/DigiCrowd', 'kdfmpke', 'kmjnhbgfvdc', 'sfvbnmyuoi', 'jsjadnjwebf', '2024-01-11 10:31:51'),
(3, 'test', 'testing', 'testing', 'testing', 'testing', 'Global', 'testing', 'testing', 'testing', 'testing', 'testing', 'testing', 'testing', 'testing', 'testing', '2024-01-11 10:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `order_data`
--

CREATE TABLE `order_data` (
  `sno` int(11) NOT NULL,
  `order_id` int(255) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contact` int(10) NOT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zip` int(10) NOT NULL,
  `address` varchar(60) NOT NULL,
  `product_detail` text NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `total_price` int(10) NOT NULL,
  `razorpay_orderId` varchar(255) NOT NULL,
  `prep_shipment` varchar(100) NOT NULL,
  `order_shipped` varchar(100) NOT NULL,
  `delivered` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_data`
--

INSERT INTO `order_data` (`sno`, `order_id`, `name`, `email`, `contact`, `country`, `city`, `zip`, `address`, `product_detail`, `order_status`, `payment_status`, `order_date`, `total_price`, `razorpay_orderId`, `prep_shipment`, `order_shipped`, `delivered`) VALUES
(19, 919034225, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Canada', 'delhi', 23454, 'whsd edhee delhii ', '{\"1\":{\"product_id\":\"1\",\"name\":\"Children Premium Chair\",\"price\":\"89\",\"quantity\":\"1\"}}', 'order complete', 'payment complete', '2023-12-06 11:56:56', 109, 'order_N8xbbKGqLBxw1e', 'shipping', 'shipped', '0'),
(20, 1620095396, 'mohit', 'one@one.com', 2147483647, 'Syria', 'Pune', 23454, 'hdwbhhujhe ifdmcjhbhdh 32ijb dcjn', '{\"1\":{\"product_id\":\"1\",\"name\":\"Children Premium Chair\",\"price\":\"89\",\"quantity\":\"2\"},\"4\":{\"product_id\":\"4\",\"name\":\"Lynchburg Arm Chair\",\"price\":\"199\",\"quantity\":\"1\"}}', 'order complete', 'payment complete', '2023-12-06 12:41:47', 397, 'order_N8yNPRYI3zW0MR', '', '', '0'),
(22, 1044693091, 'viraj dobriyal', 'viraj223@gmail.com', 2147483647, 'Mexico', 'Pune', 8766789, 'whsd edhee delhii ', '{\"1\":{\"product_id\":\"1\",\"name\":\"Children Premium Chair\",\"price\":\"89\",\"quantity\":\"1\"},\"3\":{\"product_id\":\"3\",\"name\":\"Wooden Tea Table\",\"price\":\"189\",\"quantity\":\"1\"}}', 'order complete', 'payment complete', '2023-12-06 16:01:11', 298, 'order_N91lar9xBfdkfK', '', '', '0'),
(23, 167493637, 'tom', 'fakemail@12.com', 2147483647, 'Mexico', 'chandigarh', 8766789, 'Shop No 25/a, Gr Flr, Sir Ratan Bldg, Tata Road, Near Kappaw', '{\"7\":{\"product_id\":\"7\",\"name\":\"velvet bed\",\"price\":\"359\",\"quantity\":\"1\"}}', 'order complete', 'payment complete', '2023-12-08 17:57:32', 379, 'order_N9qoo00UHUZer8', 'shipping', 'shipped', 'delivered'),
(24, 272812396, 'mohit', 'one@one.com', 2147483647, 'India', 'mumbai', 9876556, 'Bhnd Maruti Mandir, Trimurthy Dham,', '{\"1\":{\"product_id\":\"1\",\"name\":\"Children Premium Chair\",\"price\":\"89\",\"quantity\":\"1\"}}', 'order complete', 'payment complete', '2023-12-21 17:01:24', 109, 'order_NEyo0BK90MTvYT', 'shipping', '', '0'),
(25, 0, '', '', 0, '', '', 0, '', '', '', '', '2024-01-16 17:07:46', 0, '', 'shipping', '', '0'),
(26, 1067901776, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'India', 'lucknow', 9876556, 'Shop No 25/a, Gr Flr, Sir Ratan Bldg, Tata Road, Near Kappaw', '', 'order initiated', 'payment initiated', '2024-01-17 15:00:43', 0, '', '', '', ''),
(27, 741844361, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Syria', 'mumbai', 8766789, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:11:52', 0, '', '', '', ''),
(28, 26233882, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Syria', 'mumbai', 8766789, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:12:54', 0, '', '', '', ''),
(29, 33812981, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Syria', 'mumbai', 8766789, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:13:20', 0, '', '', '', ''),
(30, 804965849, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Syria', 'mumbai', 8766789, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:13:40', 0, '', '', '', ''),
(31, 2398029, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Syria', 'mumbai', 8766789, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:13:49', 0, '', '', '', ''),
(32, 1558814474, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Syria', 'mumbai', 8766789, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:14:40', 0, '', '', '', ''),
(33, 1703159754, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Syria', 'mumbai', 8766789, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:14:53', 0, '', '', '', ''),
(34, 1488623589, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Syria', 'mumbai', 8766789, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:15:02', 0, '', '', '', ''),
(35, 343785435, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:24:35', 0, '', '', '', ''),
(36, 1240091131, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:35:52', 0, '', '', '', ''),
(37, 1257589195, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:36:26', 0, '', '', '', ''),
(38, 793609630, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:37:25', 0, '', '', '', ''),
(39, 1159795567, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:37:29', 0, '', '', '', ''),
(40, 1691521502, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:48:06', 0, '', '', '', ''),
(41, 121724018, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:48:41', 0, '', '', '', ''),
(42, 1027683074, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:51:04', 0, '', '', '', ''),
(43, 309177082, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:52:24', 0, '', '', '', ''),
(44, 1470897717, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:52:49', 0, '', '', '', ''),
(45, 629436530, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:55:04', 0, '', '', '', ''),
(46, 799183494, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 15:55:23', 0, '', '', '', ''),
(47, 702538712, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:07:52', 0, '', '', '', ''),
(48, 89701398, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:08:56', 0, '', '', '', ''),
(49, 820360134, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:17:13', 0, '', '', '', ''),
(50, 1014304458, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:20:47', 0, '', '', '', ''),
(51, 1196372823, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:21:33', 0, '', '', '', ''),
(52, 19808497, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:24:54', 0, '', '', '', ''),
(53, 1661811974, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:25:36', 0, '', '', '', ''),
(54, 1273939675, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:26:49', 0, '', '', '', ''),
(55, 663949843, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:27:28', 0, '', '', '', ''),
(56, 1595018315, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:28:34', 0, '', '', '', ''),
(57, 1321674052, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:35:51', 0, '', '', '', ''),
(58, 633150740, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:38:29', 0, '', '', '', ''),
(59, 502430423, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:44:18', 0, '', '', '', ''),
(60, 262350775, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'Russia', 'Pune', 987876, 'Bhnd Maruti Mandir, Trimurthy Dham,', '', 'order initiated', 'payment initiated', '2024-01-17 16:45:15', 0, '', '', '', ''),
(61, 1559752279, 'uzair khan', 'uzairkhan7521@gmail.com', 2147483647, 'India', 'lucknow', 9876556, 'Shop No 25/a, Gr Flr, Sir Ratan Bldg, Tata Road, Near Kappaw', '', 'order initiated', 'payment initiated', '2024-01-17 17:23:40', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_img` varchar(50) NOT NULL,
  `other_images` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `offer_price` int(11) NOT NULL,
  `stock` varchar(15) NOT NULL,
  `sku` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_img`, `other_images`, `product_name`, `slug`, `price`, `offer_price`, `stock`, `sku`) VALUES
(1, 2, '7.jpg', '[\"395701698832261.jpg\",\"414791698823375.jpg\",\"468881698214586.jpg\"]', 'Children Premium Chair', 'cChair', 119, 89, '', 'chh2'),
(2, 2, '28.jpg', '[\"157421698214586.jpg\",\"403651698214586.jpg\",\"468881698214586.jpg\"]', 'Chair with wooden table', 'chairtable', 239, 199, '', 'cwwt'),
(3, 4, '21.jpg', '[\"157421698214586.jpg\",\"403651698214586.jpg\",\"468881698214586.jpg\"]', 'Wooden Tea Table', 'ttable', 199, 189, '', '108'),
(4, 3, '2.jpg', '[\"171241698215163.jpg\",\"909291698215163.jpg\",\"349301698215163.jpg\",\"535311698215163.jpg\"]', 'Lynchburg Arm Chair', 'Lbchair', 219, 199, '', '333'),
(5, 1, '22.jpg', '[\"157421698214586.jpg\",\"403651698214586.jpg\",\"468881698214586.jpg\"]', 'Kaydan Sofa', 'kysofa', 299, 279, '', '198'),
(6, 4, '7.jpg', '[\"157421698214586.jpg\",\"403651698214586.jpg\",\"468881698214586.jpg\"]', 'New Product', 'sds', 1232, 322, '', '2ws2'),
(7, 1, '29.jpg', '[\"171241698215163.jpg\",\"909291698215163.jpg\",\"349301698215163.jpg\",\"535311698215163.jpg\"]', 'velvet bed', 'vbed', 389, 359, '', '120b');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(15) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `two_fa_email` varchar(5) NOT NULL DEFAULT 'NO',
  `password` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `user_id`, `email`, `phone`, `two_fa_email`, `password`, `status`) VALUES
(1, 'admin', '122333', 'uzairkhan7521@gmail.com', '8601972856', 'YES', '$2y$10$SgXbRe/b1MJmHlOKz472/uXb/d.NYgAP5YSSTPA4Ihuom/BmJuh1W', 1),
(2, 'admin', '3454', 'goswamivaibhav72@gmail.com', '354', 'NO', '$2y$10$SgXbRe/b1MJmHlOKz472/uXb/d.NYgAP5YSSTPA4Ihuom/BmJuh1W', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_slug` (`category_slug`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_data`
--
ALTER TABLE `mail_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_data`
--
ALTER TABLE `media_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta_data`
--
ALTER TABLE `meta_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_data`
--
ALTER TABLE `order_data`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `mail_data`
--
ALTER TABLE `mail_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media_data`
--
ALTER TABLE `media_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `meta_data`
--
ALTER TABLE `meta_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_data`
--
ALTER TABLE `order_data`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
