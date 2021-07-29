-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 15, 2021 at 01:31 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlines`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categorydetails`
--

DROP TABLE IF EXISTS `categorydetails`;
CREATE TABLE IF NOT EXISTS `categorydetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subcategoryid` int(30) NOT NULL,
  `categoryid` int(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryid` (`categoryid`),
  KEY `subcategoryid` (`subcategoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `errorlog`
--

DROP TABLE IF EXISTS `errorlog`;
CREATE TABLE IF NOT EXISTS `errorlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(30) DEFAULT NULL,
  `errormessage` text,
  `errornumber` int(30) DEFAULT NULL,
  `errorfile` text,
  `errorline` int(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(30) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL,
  `createdtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
CREATE TABLE IF NOT EXISTS `orderdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(30) NOT NULL,
  `productdetailid` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `size` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderid` (`orderid`),
  KEY `productdetailid` (`productdetailid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `code` varchar(30) NOT NULL,
  `cost` int(30) NOT NULL,
  `profit` int(30) NOT NULL,
  `description` text NOT NULL,
  `weight` int(30) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

DROP TABLE IF EXISTS `productdetails`;
CREATE TABLE IF NOT EXISTS `productdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(30) NOT NULL,
  `color` varchar(25) NOT NULL,
  `s` int(25) NOT NULL,
  `m` int(25) NOT NULL,
  `l` int(25) NOT NULL,
  `xl` int(25) NOT NULL,
  `xxl` int(25) NOT NULL,
  `xxxl` int(25) NOT NULL,
  `sold` int(25) NOT NULL,
  `imageUrl` text NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `productid` (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategorydetails`
--

DROP TABLE IF EXISTS `subcategorydetails`;
CREATE TABLE IF NOT EXISTS `subcategorydetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subcategoryid` int(30) NOT NULL,
  `productid` int(30) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ssubcategoryid` (`subcategoryid`),
  KEY `sproductid` (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `apartmant` varchar(60) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `usertype` varchar(25) DEFAULT NULL,
  `isdeleted` tinyint(1) DEFAULT '0',
  `password` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categorydetails`
--
ALTER TABLE `categorydetails`
  ADD CONSTRAINT `categoryid` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `subcategoryid` FOREIGN KEY (`subcategoryid`) REFERENCES `subcategory` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`productdetailid`) REFERENCES `productdetails` (`id`),
  ADD CONSTRAINT `orderid` FOREIGN KEY (`orderid`) REFERENCES `order` (`id`);

--
-- Constraints for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD CONSTRAINT `productid` FOREIGN KEY (`productid`) REFERENCES `product` (`id`);

--
-- Constraints for table `subcategorydetails`
--
ALTER TABLE `subcategorydetails`
  ADD CONSTRAINT `sproductid` FOREIGN KEY (`productid`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `ssubcategoryid` FOREIGN KEY (`subcategoryid`) REFERENCES `subcategory` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
