-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3366
-- Generation Time: Jun 22, 2016 at 11:09 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_add_libraries_ajax_pagination`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created`, `modified`, `status`) VALUES
(1, 'Adding Google Map on Your Website within 5 Minutes', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(2, 'Top Features of AngularJS that Sets it Apart from other Frameworks', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(3, 'Get visitor location using HTML5 Geolocation API and PHP', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(4, 'WordPress – How to Display Most Popular Posts by Views', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(5, 'PayPal Payment Gateway Integration in CodeIgniter', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(6, 'Drupal 8 Installation and Configuration Tutorial', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(7, 'How to Create a MySQL Database in cPanel', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(8, 'CakePHP Tutorial Part 3: Working with Elements and Layout', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(9, 'Build an event calendar using jQuery, Ajax and PHP', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(10, 'Disable mouse right click, cut, copy and paste using jQuery', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(11, 'Dynamic Dependent Select Box using jQuery, Ajax and PHP', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(12, 'Drupal Custom Module &mdash; Create database table during installation', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(13, 'Redirect non-www to www & HTTP to HTTPS using .htaccess file', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(14, 'PayPal Pro payment gateway integration in PHP', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(15, 'Creating PayPal Sandbox Test Account and Website Payments Pro Account', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(16, 'Add featured image or thumbnail to WordPress post', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(17, 'Drupal custom module development tutorial', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1),
(18, 'Multi-Language implementation in CodeIgniter', '', '2016-05-20 13:34:35', '2016-05-20 13:34:35', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
