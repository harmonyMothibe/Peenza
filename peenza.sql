-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2013 at 11:13 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `peenza`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brands`
--

CREATE TABLE IF NOT EXISTS `tbl_brands` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sub_categories_id` int(11) unsigned NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `logo` varchar(80) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brands_name` (`brand_name`),
  KEY `brands_FKIndex1` (`sub_categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `thumb_image` varchar(100) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_cat_name` (`category_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `category_name`, `description`, `thumb_image`, `active`, `date_added`) VALUES
(1, 'Apparel', 'Apparel', 'apparel.png', 1, '2013-02-20 00:00:00'),
(2, 'Appliances', 'Appliances', 'appliances', 1, '2013-02-21 00:00:00'),
(3, 'Books', 'Different books', 'books', 1, '2013-02-20 00:00:00'),
(4, 'Cellular / Electronics', 'Cellular / Electronics', 'none', 1, '2013-02-20 00:00:00'),
(5, 'DVD / Blu Ray', 'Something else', '', 1, '2013-02-21 00:00:00'),
(6, 'Furniture', 'Something else', NULL, 1, '2013-02-22 00:00:00'),
(7, 'Games', 'Something else', NULL, 1, '2013-02-22 00:00:00'),
(8, 'Groceries', 'Something descriptions go here', NULL, 1, '2013-02-22 00:00:00'),
(9, 'Music', 'Description', NULL, 1, '2013-02-22 00:00:00'),
(10, 'Toys', 'Description', NULL, 1, '2013-02-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cities`
--

CREATE TABLE IF NOT EXISTS `tbl_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countries_id` int(11) NOT NULL,
  `city_name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_FKIndex1` (`countries_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE IF NOT EXISTS `tbl_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dealers`
--

CREATE TABLE IF NOT EXISTS `tbl_dealers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dealer_statuses_id` int(11) unsigned NOT NULL,
  `cities_id` int(11) NOT NULL,
  `dealer_name` varchar(200) NOT NULL,
  `trading_as` varchar(200) DEFAULT NULL,
  `email_address` varchar(180) NOT NULL,
  `physical_address` varchar(255) DEFAULT NULL,
  `identification` varchar(200) DEFAULT NULL,
  `profile_image` varchar(150) DEFAULT NULL,
  `password_2` varchar(64) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `retired` int(1) DEFAULT '0',
  `date_added` datetime DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dealers_unique_email` (`email_address`),
  KEY `dealers_name` (`dealer_name`),
  KEY `dealers_FKIndex1` (`cities_id`),
  KEY `dealers_FKIndex2` (`dealer_statuses_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_dealers`
--

INSERT INTO `tbl_dealers` (`id`, `dealer_statuses_id`, `cities_id`, `dealer_name`, `trading_as`, `email_address`, `physical_address`, `identification`, `profile_image`, `password_2`, `description`, `active`, `retired`, `date_added`, `last_updated`, `last_login`) VALUES
(1, 1, 7, 'Naidoo Clothing', 'Naidoo', 'naidoo@yahoo.com', 'something', '78545454545454', 'dealer1', '45454545', 'Lorem juit dolor soit', 1, 0, '2013-02-16 00:00:00', '2013-02-18 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 0, 'test', 'test', 'test', '34535', 'test', NULL, '098f6bcd4621d373cade4e832627b4f6', 'testrtr', 0, NULL, '2013-02-18 12:34:34', NULL, '0000-00-00 00:00:00'),
(3, 0, 0, 'test', 'set', 'setsets', 'Something', 'setset', NULL, '112a711f766db446c2f517b794a1c04a', 'setse', 0, NULL, '2013-02-18 12:43:27', NULL, '0000-00-00 00:00:00'),
(5, 0, 0, 'testsfds', 'setsdfsd22222222', 'setsetssdf22222222222', 'setset234234sfsdf22222222', 'setsetdfs', NULL, '9b2889a3d8318ae830d51c3f556858fb', 'setse', 0, NULL, '2013-02-18 12:45:22', NULL, '0000-00-00 00:00:00'),
(6, 0, 0, 'testsfds22222', 'setsdfsd222', 'setsetssdf222', 'setset234234sfsdf22', 'setsetdfs222', NULL, 'c424c060125c3b693cfd9ea2be84e959', 'setse222', 0, NULL, '2013-02-18 13:43:00', NULL, '0000-00-00 00:00:00'),
(7, 0, 0, 'harmony3232', 'harmony', 'harmony@ctsc.co.za', 'harmony', 'harmony', NULL, 'beb35b7502fa7bb8f1e3ee6da0945d34', 'harmony', 1, NULL, '2013-02-19 08:15:57', NULL, '0000-00-00 00:00:00'),
(8, 0, 0, 'Ngoako', 'Mothibe', 'ngoako@ctsc.co.za', 'Corner something', '8805215757083', '', '271e8e8bfb6fe8efec86aa9f295d7a20', 'ngoako', 0, NULL, '2013-02-21 08:51:31', NULL, '2013-02-21 08:51:31'),
(11, 0, 0, 'wewe', 'wewe', 'wewe', 'wewe', 'wewe', '6425-image_1.jpg', '2a7d544ccb742bd155e55c796de8e511', 'wewe', 1, NULL, '2013-02-21 09:25:15', NULL, '2013-02-21 09:25:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dealer_ratings`
--

CREATE TABLE IF NOT EXISTS `tbl_dealer_ratings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `dealers_id` int(11) unsigned NOT NULL,
  `rating` int(1) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dealer_ratings_FKIndex1` (`dealers_id`),
  KEY `dealer_ratings_FKIndex2` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dealer_statuses`
--

CREATE TABLE IF NOT EXISTS `tbl_dealer_statuses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status_name` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `statuses_name` (`status_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE IF NOT EXISTS `tbl_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dealers_id` int(11) unsigned NOT NULL,
  `brands_id` int(11) unsigned NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `product_year` varchar(4) DEFAULT NULL,
  `quantity` varchar(10) DEFAULT NULL,
  `dimensions` varchar(20) DEFAULT NULL,
  `units` varchar(10) DEFAULT NULL,
  `conditions` varchar(200) DEFAULT NULL,
  `price` varchar(10) DEFAULT NULL,
  `special_price` varchar(10) DEFAULT NULL,
  `thumb_image` varchar(50) DEFAULT NULL,
  `stock` int(1) DEFAULT '1',
  `views` int(30) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `retired` int(1) DEFAULT '0',
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_image` (`thumb_image`),
  KEY `products_name` (`special_price`),
  KEY `products_price` (`price`),
  KEY `products_FKIndex1` (`brands_id`),
  KEY `products_FKIndex2` (`dealers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `dealers_id`, `brands_id`, `product_name`, `description`, `color`, `product_year`, `quantity`, `dimensions`, `units`, `conditions`, `price`, `special_price`, `thumb_image`, `stock`, `views`, `active`, `retired`, `date_added`) VALUES
(1, 2, 2, 'Samsung Galaxy', 'Lorem juit dolor soit', 'green', '2005', '5', '21 * 5', '4', 'good', '45', '00', 'phone', 1, 10, 1, 0, '2013-02-15 00:00:00'),
(2, 0, 0, 'test', 'test', NULL, 'test', 'test', NULL, NULL, NULL, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 0, 0, 'tester344577', 'testrtr5676', 'green', 'test', 'test', 'test', 'test', 'tset', 'test', NULL, NULL, 0, 29, NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE IF NOT EXISTS `tbl_sales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `sale_statuses_id` int(11) NOT NULL,
  `products_id` int(11) unsigned NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `ip_address` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_FKIndex1` (`products_id`),
  KEY `sales_FKIndex2` (`sale_statuses_id`),
  KEY `sales_FKIndex3` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale_statuses`
--

CREATE TABLE IF NOT EXISTS `tbl_sale_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(40) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_sub_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categories_id` int(11) unsigned NOT NULL,
  `sub_category_name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `sub_categories_name` (`sub_category_name`),
  KEY `sub_categories_FKIndex1` (`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `user_surname` varchar(50) DEFAULT NULL,
  `email_address` varchar(180) DEFAULT NULL,
  `password_2` varchar(64) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  `retired` int(1) DEFAULT '0',
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_email_address` (`email_address`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `user_name`, `user_surname`, `email_address`, `password_2`, `active`, `retired`, `date_added`) VALUES
(1, 'harmony', 'mothibe', 'harmony', 'something else', 0, 0, '2013-02-18 07:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_funds`
--

CREATE TABLE IF NOT EXISTS `tbl_user_funds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `current_funds` varchar(25) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_funds_FKIndex1` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
