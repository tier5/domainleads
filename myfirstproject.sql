-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2016 at 01:06 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myfirstproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `bears`
--

CREATE TABLE IF NOT EXISTS `bears` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `danger_level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `bears`
--

INSERT INTO `bears` (`id`, `name`, `type`, `danger_level`, `created_at`, `updated_at`) VALUES
(13, 'Lawly', 'Grizzly', 8, '2016-07-26 05:27:37', '2016-07-26 05:27:37'),
(14, 'Cerms', 'Black', 4, '2016-07-26 05:27:37', '2016-07-26 05:27:37'),
(15, 'Adobot', 'Polar', 3, '2016-07-26 05:27:37', '2016-07-26 05:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `bears_picnics`
--

CREATE TABLE IF NOT EXISTS `bears_picnics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bear_id` int(11) NOT NULL,
  `picnic_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Category1', NULL, NULL),
(2, 'category2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fish`
--

CREATE TABLE IF NOT EXISTS `fish` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weight` int(11) NOT NULL,
  `bear_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `fish`
--

INSERT INTO `fish` (`id`, `weight`, `bear_id`, `created_at`, `updated_at`) VALUES
(13, 5, 13, '2016-07-26 05:27:37', '2016-07-26 05:27:37'),
(14, 12, 14, '2016-07-26 05:27:37', '2016-07-26 05:27:37'),
(15, 4, 15, '2016-07-26 05:27:37', '2016-07-26 05:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_07_20_080741_create_users_table', 1),
('2016_07_21_110723_create_mylogin_table', 2),
('2016_07_22_075050_create_posts_table', 3),
('2016_07_26_064259_create_category_table', 4),
('2016_07_26_102033_create_bears_table', 5),
('2016_07_26_102228_create_fish_table', 5),
('2016_07_26_102326_create_trees_table', 5),
('2016_07_26_102422_create_picnics_table', 5),
('2016_07_26_104957_create_bears_picnics_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `mylogin`
--

CREATE TABLE IF NOT EXISTS `mylogin` (
  `myid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `myname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `myemail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mypassword` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`myid`),
  UNIQUE KEY `mylogin_myemail_unique` (`myemail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `picnics`
--

CREATE TABLE IF NOT EXISTS `picnics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `taste_level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `picnics`
--

INSERT INTO `picnics` (`id`, `name`, `taste_level`, `created_at`, `updated_at`) VALUES
(9, 'Yellowstone', 6, '2016-07-26 05:27:37', '2016-07-26 05:27:37'),
(10, 'Grand Canyon', 5, '2016-07-26 05:27:37', '2016-07-26 05:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(2, 'geygrye', 'werewr', '2016-07-22 03:17:02', '2016-07-22 03:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `cat_id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cat_id`, `name`, `price`, `updated_at`, `created_at`) VALUES
(5, 1, 'jeans', 29, '2016-07-25 10:44:22', '2016-07-25 10:08:52'),
(6, 1, 'boll', 23, '2016-07-25 10:41:30', '2016-07-25 10:41:30'),
(7, 2, 'a1', 10000, '2016-07-25 12:42:41', '2016-07-25 12:42:41'),
(8, 2, 'a2', 5222, '2016-07-25 12:42:57', '2016-07-25 12:42:57'),
(9, 2, 'a3', 788, '2016-07-25 12:43:09', '2016-07-25 12:43:09'),
(10, 0, 'a89', 424, '2016-07-25 12:43:23', '2016-07-25 12:43:23'),
(11, 0, 'sdfsd', 213213, '2016-07-25 12:43:38', '2016-07-25 12:43:38'),
(12, 0, 'rinku shirt', 15000, '2016-07-25 13:16:41', '2016-07-25 13:16:41'),
(13, 0, 'krish tisht', 455, '2016-07-25 13:17:01', '2016-07-25 13:17:01'),
(14, 0, 'ppppp', 56, '2016-07-26 09:17:48', '2016-07-26 09:17:48'),
(15, 0, 'uyt', 100, '2016-07-26 09:22:21', '2016-07-26 09:22:21'),
(16, 1, 'nbcczx', 45646, '2016-07-26 09:29:09', '2016-07-26 09:24:17'),
(17, 2, 'jjjjhjh', 46, '2016-07-26 11:58:38', '2016-07-26 11:58:38');

-- --------------------------------------------------------

--
-- Table structure for table `trees`
--

CREATE TABLE IF NOT EXISTS `trees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `bear_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `trees`
--

INSERT INTO `trees` (`id`, `type`, `age`, `bear_id`, `created_at`, `updated_at`) VALUES
(9, 'Redwood', 500, 13, '2016-07-26 05:27:37', '2016-07-26 05:27:37'),
(10, 'Oak', 400, 13, '2016-07-26 05:27:37', '2016-07-26 05:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Krishna', 'Krishna', 'krishna@nettrackers.net', '8358c17cc24628b7d35f871ddf80028e', 'mOCHw4Uo6atVCdndzK0ifQw1xUpZQ7ZA48sLqBVeUQcMwcZRW1TAOeoDDqdH', '2016-07-20 03:35:35', '2016-07-20 04:32:11'),
(2, 'asAS Assas', '', 'krishnakua44@gmail.com', '123', '9CJUUQGzQnasWKUq0OdxU2dg1GJnnlPpVrfTi8ay', '2016-07-21 07:22:51', '2016-07-21 07:22:51'),
(3, 'hghgh hghgh', '', 'krishna4@gmail.com', '123', '9CJUUQGzQnasWKUq0OdxU2dg1GJnnlPpVrfTi8ay', '2016-07-21 07:29:37', '2016-07-21 07:29:37'),
(4, 'd dfsf', '', 'ww@gmail.com', '123', '9CJUUQGzQnasWKUq0OdxU2dg1GJnnlPpVrfTi8ay', '2016-07-21 07:33:51', '2016-07-21 07:33:51'),
(5, 'krish kush', '', 'kush@gmail.com', '$2y$10$EWtrbYkg/1qbRR3AcghMkOs3ZoqUK8w1XLaaqN2JO39c992vFLcNC', 'Bzunla0EUvovEut7NGT3TGVVHTueofyaBIpeq4DDRSbKR8bxOm31xfw9KxCF', '2016-07-22 01:26:02', '2016-08-18 06:46:00'),
(6, 'kre ertre', '', 'kkk@gmail.com', '$2y$10$2aVhw5tR1IHP.AxA4YRPo.mPr4FgAnroe.GM0Z5R83yY76fn1Rt/6', 'mHlbsZJRM8RVzbf0Kg2doWiaP2fQn3KlIoD3nkwnevOnBJBq0dudcMTZMnSw', '2016-08-18 07:02:23', '2016-08-18 07:02:57'),
(7, 'aaaa aaa', '', 'aaaaaa@gmail.com', '$2y$10$pvE2LnUPE.9MBmFI3i/Y1ub3Zr7/Ix7zKGrSNYJNtiPZJleddWXOC', 'JCxIKeBXsGCMeG9RT2iVRrmNahxUrHhcWwQghzIr', '2016-09-08 04:27:50', '2016-09-08 04:27:50');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
