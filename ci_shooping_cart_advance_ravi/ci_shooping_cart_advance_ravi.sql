-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3366
-- Generation Time: Aug 20, 2016 at 03:12 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_shooping_cart_advance_ravi`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `addedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_orders`
--

CREATE TABLE IF NOT EXISTS `customer_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `order_total` float NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `payment_txn_id` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `invoice` text COLLATE latin1_general_ci NOT NULL,
  `addedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_order_details`
--

CREATE TABLE IF NOT EXISTS `customer_order_details` (
  `customer_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumb` int(11) DEFAULT '0',
  `name` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'Product Name',
  `description` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `photo` text COLLATE latin1_general_ci,
  `base_rate` float DEFAULT NULL,
  `stock_total` int(11) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `product_brand_id` int(11) DEFAULT NULL,
  `product_category_id` int(11) DEFAULT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  `addedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `thumb`, `name`, `description`, `photo`, `base_rate`, `stock_total`, `views`, `product_brand_id`, `product_category_id`, `is_online`, `addedon`, `updatedon`) VALUES
(1, 0, 'LG Monitor', 'LG Flat Screen LCD, with 3 years on-site warranty', 'products/lg_monitor.jpg', 15000, 50, 0, 0, 0, 1, '2016-06-22 14:55:24', '2016-08-19 21:31:04'),
(2, 0, 'Pen Drive USB 3.0', 'SanDisk Ultra Fit Pen Drive', 'products/SanDisk-pen-drive-Ultra-Fit.jpg', 300, 10, 11, 1, 1, 1, '2016-08-18 04:24:28', '2016-08-18 05:44:03'),
(3, 0, 'Logitech z120', 'Logitech Mini Portable Speaker System 40w', 'products/logitech-z120.jpg', 450, 20, 0, NULL, NULL, 1, '2016-08-18 05:43:42', '2016-08-19 20:55:38'),
(4, 0, 'Logitech Speaker', 'Logitech Speaker System with 200W Sound Power', 'products/logi-z623.jpg', 7200, 1, 1, NULL, NULL, 1, '2016-08-18 05:58:24', '2016-08-18 06:21:34'),
(5, 0, 'NiceLook Shirt', 'A Nice Looking Shirt to style your fashion', 'products/pink_shirt.jpg', 300, 20, 0, NULL, NULL, 1, '2016-08-18 06:10:27', '2016-08-19 19:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE IF NOT EXISTS `product_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `option_color_id` int(11) NOT NULL,
  `addon_price` float NOT NULL DEFAULT '0',
  `instock` int(11) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `option_color_id` (`option_color_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `product_id`, `option_color_id`, `addon_price`, `instock`) VALUES
(5, 5, 6, 6, 10),
(6, 5, 1, 10, 10),
(7, 5, 2, 20, 10),
(8, 5, 3, 30, 10),
(9, 5, 4, 40, 10),
(10, 5, 7, 70, 10),
(11, 5, 8, 80, 10),
(12, 4, 1, 10, 10),
(13, 4, 2, 20, 10),
(14, 2, 1, 10, 10),
(15, 2, 2, 20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_option_category`
--

CREATE TABLE IF NOT EXISTS `product_option_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `product_option_category`
--

INSERT INTO `product_option_category` (`id`, `name`) VALUES
(1, 'Computer'),
(2, 'Man Fashion'),
(3, 'Women Fashion'),
(4, 'Mobile'),
(5, 'Home');

-- --------------------------------------------------------

--
-- Table structure for table `product_option_category_type`
--

CREATE TABLE IF NOT EXISTS `product_option_category_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `product_option_category_type`
--

INSERT INTO `product_option_category_type` (`id`, `category_id`, `name`) VALUES
(1, 1, 'Pen Drive'),
(2, 1, 'Monitor LCD, LED'),
(3, 1, 'HDD Internal'),
(4, 2, 'Shirt Full'),
(5, 2, 'Shirt Short');

-- --------------------------------------------------------

--
-- Table structure for table `product_option_color`
--

CREATE TABLE IF NOT EXISTS `product_option_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `product_option_color`
--

INSERT INTO `product_option_color` (`id`, `color`) VALUES
(1, 'Red'),
(2, 'Green'),
(3, 'Blue'),
(4, 'Black'),
(5, 'White'),
(6, 'Pink'),
(7, 'Silver Black'),
(8, 'Gray');

-- --------------------------------------------------------

--
-- Table structure for table `product_option_size`
--

CREATE TABLE IF NOT EXISTS `product_option_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `size` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `product_option_size`
--

INSERT INTO `product_option_size` (`id`, `type_id`, `size`) VALUES
(4, 2, '15 inch'),
(5, 2, '18 inch'),
(6, 2, '22 inch'),
(7, 2, '24 inch'),
(8, 2, '27 inch'),
(9, 2, '32 inch'),
(10, 3, '40 GB'),
(11, 3, '80 GB'),
(12, 3, '160 GB'),
(13, 3, '320'),
(14, 3, '500 GB'),
(15, 3, '1 TB'),
(16, 3, '2 TB'),
(17, 3, '4 TB'),
(18, 1, '2 GB'),
(19, 1, '4 GB'),
(20, 1, '8 GB'),
(21, 1, '16 GB'),
(22, 1, '32 GB'),
(23, 1, '64 GB'),
(24, 1, '128 GB'),
(25, 4, 'Small'),
(26, 4, 'Medium'),
(27, 4, 'Large'),
(28, 4, 'Extra Large');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE IF NOT EXISTS `product_sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `option_size_id` int(11) NOT NULL,
  `addon_price` float NOT NULL DEFAULT '0',
  `instock` int(11) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  KEY `option_color_id` (`option_size_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `option_size_id`, `addon_price`, `instock`) VALUES
(1, 1, 4, 0, 10),
(2, 1, 5, 3000, 5),
(7, 2, 18, 0, 200),
(8, 2, 19, 200, 400),
(9, 2, 20, 300, 800),
(10, 2, 21, 400, 1600),
(11, 5, 26, 0, 10),
(12, 5, 27, 100, 10),
(13, 5, 28, 200, 10);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_colors_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_colors_ibfk_2` FOREIGN KEY (`option_color_id`) REFERENCES `product_option_color` (`id`);

--
-- Constraints for table `product_option_category_type`
--
ALTER TABLE `product_option_category_type`
  ADD CONSTRAINT `product_option_category_type_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_option_category` (`id`);

--
-- Constraints for table `product_option_size`
--
ALTER TABLE `product_option_size`
  ADD CONSTRAINT `product_option_size_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `product_option_category_type` (`id`);

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`option_size_id`) REFERENCES `product_option_size` (`id`),
  ADD CONSTRAINT `product_sizes_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
