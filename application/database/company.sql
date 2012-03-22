-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2012 at 06:42 AM
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
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `active`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `company_id`) VALUES
(1, 'Friendster', 1, 1, '2012-03-10 01:58:24', 1, '2012-03-22 06:20:15', 1),
(2, 'Safeway Inc.', 1, 1, '2012-03-22 06:17:16', 1, '2012-03-22 06:17:49', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
