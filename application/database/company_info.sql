-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2012 at 06:44 AM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ebms_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE IF NOT EXISTS `company_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `address` text,
  `phone_no` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(100) DEFAULT NULL,
  `fax_no` varchar(100) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `logo` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`id`, `name`, `address`, `phone_no`, `mobile_no`, `fax_no`, `email_address`, `website`, `logo`) VALUES
(1, 'SME', 'Paco Manila', '0987474743', '8476362', '2342234', 'Dummy@yahoo.com', 'www.dummy.com', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
