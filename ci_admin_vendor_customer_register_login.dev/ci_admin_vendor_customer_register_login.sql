-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3366
-- Generation Time: Jul 21, 2016 at 02:45 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_admin_vendor_customer_register_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `person_id` int(10) unsigned NOT NULL COMMENT 'is a foreign key from persons table',
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `isonline` bit(1) NOT NULL,
  `last_logged_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`person_id`, `username`, `password`, `status`, `isonline`, `last_logged_on`) VALUES
(1, 'admin@email.com', '25e4ee4e9229397b6b17776bfceaf8e7', 1, b'0', '2016-07-20 20:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `person_id` int(11) unsigned NOT NULL COMMENT 'is a foreign key from persons table',
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` bit(1) NOT NULL,
  `isonline` bit(1) NOT NULL,
  `last_logged_on` timestamp NOT NULL,
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`person_id`, `username`, `password`, `status`, `isonline`, `last_logged_on`) VALUES
(2, 'customer@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', b'1', b'0', '2016-07-20 20:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `photo` text NOT NULL COMMENT 'image full url with domain root',
  `gender` enum('male','female','other','') NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `addedon` int(11) NOT NULL,
  `updatedon` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id`, `first_name`, `last_name`, `photo`, `gender`, `mobile`, `email`, `address`, `city`, `state`, `country`, `zipcode`, `addedon`, `updatedon`) VALUES
(1, 'Ravi Kumar', 'Jangra', '', 'male', '9811669942', 'ravi@email.com', 'MCF 69, Gali No 1, Shiv Colony', 'Faridabad', 'Haryana', 'India', 121004, 1469047654, '2016-07-20 20:54:31'),
(2, 'Customer', 'Kumar', '', 'male', '9811669942', 'customer@email.com', '', '', '', '', 0, 1469047654, '2016-07-20 20:54:19'),
(3, 'Vendor', 'Kumar', '', 'male', '9811669942', 'vendor@email.com', '', '', '', '', 0, 1469047777, '2016-07-20 20:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `person_id` int(11) unsigned NOT NULL COMMENT 'is a foreign key from persons table',
  `business_plan_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `isonline` bit(1) NOT NULL,
  `last_logged_on` timestamp NOT NULL,
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`person_id`, `business_plan_id`, `username`, `password`, `status`, `isonline`, `last_logged_on`) VALUES
(3, 0, 'vendor@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, b'0', '2016-07-20 20:49:45');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrators`
--
ALTER TABLE `administrators`
  ADD CONSTRAINT `cnst_person_id_as_admin_id_from_persons_table` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `cnst_person_id_as_customer_id_from_persons_table` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`);

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `cnst_person_id_as_forign_key_from_persons_table` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `logout_system_user` ON SCHEDULE EVERY 1 MINUTE STARTS '2016-07-21 02:32:50' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'logout every user from system' DO BEGIN
update administrators SET isonline = 0 WHERE isonline = 1;
update vendors SET isonline = 0 WHERE isonline = 1;
update customers SET isonline = 0 WHERE isonline = 1;
END$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
