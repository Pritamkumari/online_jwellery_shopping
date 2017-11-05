-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 03, 2017 at 12:21 PM
-- Server version: 5.5.46
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `online_shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE IF NOT EXISTS `checkout` (
  `chk_id` int(11) NOT NULL AUTO_INCREMENT,
  `chk_item` int(11) NOT NULL,
  `chk_ref` text NOT NULL,
  `chk_timing` datetime NOT NULL,
  `chk_qty` int(11) NOT NULL,
  PRIMARY KEY (`chk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`chk_id`, `chk_item`, `chk_ref`, `chk_timing`, `chk_qty`) VALUES
(3, 2, '2017-08-02 02:29:50_753305119', '2017-08-02 02:29:50', 10),
(4, 2, '2017-08-02 02:31:04_104380264', '2017-08-02 02:31:04', 10),
(40, 1, '2017-08-02 07:36:46_1504305771', '2017-08-03 05:32:07', 1),
(47, 4, '2017-08-02 07:36:46_1504305771', '2017-08-03 05:40:36', 1),
(48, 4, '2017-08-02 07:36:46_1504305771', '2017-08-03 05:40:48', 1),
(49, 3, '2017-08-02 07:36:46_1504305771', '2017-08-03 05:40:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_image` text NOT NULL,
  `item_title` text NOT NULL,
  `item_description` text NOT NULL,
  `item_cat` text NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_cost` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_discount` int(11) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_image`, `item_title`, `item_description`, `item_cat`, `item_qty`, `item_cost`, `item_price`, `item_discount`) VALUES
(1, 'images/items/img3.jpg', 'Beautiful watch', '<p>This is a very beautifull watch. You should use this watch. It will improve your personality.\r\n						you can buy this by clicking on Buy button.</p>\r\n						<ul>\r\n							<li>It''s beautifull</li>\r\n							<li>Indian product</li>\r\n							<li>Branded and Original</li>\r\n							<li>Made of metal</li>\r\n							<li>Free shipping all over the country</li>\r\n							<li>Pay securely via <b>CASH ON DELIVERY</b> method</li>\r\n						</ul>', 'watches', 50, 400, 500, 50),
(2, 'images/items/img3.jpg', 'Black Watch', '<p>This is a very beautiful Black watch. You should use this watch. It will improve your personality.\r\n						you can buy this by clicking on Buy button.</p>\r\n						<ul>\r\n							<li>It''s beautifull</li>\r\n							<li>Indian product</li>\r\n							<li>Branded and Original</li>\r\n							<li>Made of metal</li>\r\n							<li>Free shipping all over the country</li>\r\n							<li>Pay securely via <b>CASH ON DELIVERY</b> method</li>\r\n						</ul>', 'watches', 80, 890, 1000, 70),
(3, 'images/items/img4.jpg', 'men wear glasses', '<p>This is very good looking glasses. You can read very small waords.  </p>\r\n						<ul>\r\n							<li>It''s beautiful</li>\r\n							<li>Indian product</li>\r\n							<li>Branded and Original</li>\r\n							<li>Made of metal</li>\r\n							<li>Free shipping all over the country</li>\r\n							<li>Pay securely via <b>CASH ON DELIVERY</b> method</li>\r\n						</ul>', 'men', 200, 469, 546, 30),
(4, 'images/items/img1.jpg', 'Best Shoes', '<p>This is a beautiful summer shoes. You should use this shoes. It will improve your personality.\r\n						you can buy this by clicking on Buy button.</p>\r\n						<ul>\r\n							<li>It''s beautifull</li>\r\n							<li>Indian product</li>\r\n							<li>Branded and Original</li>\r\n							<li>Made of metal</li>\r\n							<li>Free shipping all over the country</li>\r\n							<li>Pay securely via <b>CASH ON DELIVERY</b> method</li>\r\n						</ul>', 'shoes', 78, 1467, 1590, 50);

-- --------------------------------------------------------

--
-- Table structure for table `item_cat`
--

CREATE TABLE IF NOT EXISTS `item_cat` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` text NOT NULL,
  `cat_slug` text NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item_cat`
--

INSERT INTO `item_cat` (`cat_id`, `cat_name`, `cat_slug`) VALUES
(1, 'watches', 'watches'),
(2, 'men', 'men'),
(3, 'shoes', 'shoes');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_name` text NOT NULL,
  `order_email` text NOT NULL,
  `order_contact` text NOT NULL,
  `order_state` text NOT NULL,
  `order_delivery_address` text NOT NULL,
  `order_checkout_ref` int(11) NOT NULL,
  `order_total` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `orders`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
