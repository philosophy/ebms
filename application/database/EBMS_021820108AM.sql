-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2012 at 12:13 AM
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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `account`
--


-- --------------------------------------------------------

--
-- Table structure for table `account_category`
--

DROP TABLE IF EXISTS `account_category`;
CREATE TABLE IF NOT EXISTS `account_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `account_category`
--


-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

DROP TABLE IF EXISTS `account_type`;
CREATE TABLE IF NOT EXISTS `account_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `account_type`
--


-- --------------------------------------------------------

--
-- Table structure for table `approval_list`
--

DROP TABLE IF EXISTS `approval_list`;
CREATE TABLE IF NOT EXISTS `approval_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `approval_list`
--


-- --------------------------------------------------------

--
-- Table structure for table `approvers_list`
--

DROP TABLE IF EXISTS `approvers_list`;
CREATE TABLE IF NOT EXISTS `approvers_list` (
  `approval_id` int(11) NOT NULL DEFAULT '0',
  `emp_id` int(11) NOT NULL DEFAULT '0',
  `granted` tinyint(4) NOT NULL,
  PRIMARY KEY (`approval_id`,`emp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approvers_list`
--


-- --------------------------------------------------------

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `area`
--


-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

DROP TABLE IF EXISTS `audit_trail`;
CREATE TABLE IF NOT EXISTS `audit_trail` (
  `id` int(11) NOT NULL,
  `details` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit_trail`
--


-- --------------------------------------------------------

--
-- Table structure for table `balance_sheet_settings`
--

DROP TABLE IF EXISTS `balance_sheet_settings`;
CREATE TABLE IF NOT EXISTS `balance_sheet_settings` (
  `id` int(11) DEFAULT '0',
  `type` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balance_sheet_settings`
--


-- --------------------------------------------------------

--
-- Table structure for table `button`
--

DROP TABLE IF EXISTS `button`;
CREATE TABLE IF NOT EXISTS `button` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `button`
--


-- --------------------------------------------------------

--
-- Table structure for table `cash_flow`
--

DROP TABLE IF EXISTS `cash_flow`;
CREATE TABLE IF NOT EXISTS `cash_flow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) DEFAULT '0',
  `jan` double(15,3) DEFAULT '0.000',
  `feb` double(15,3) DEFAULT '0.000',
  `mar` double(15,3) DEFAULT '0.000',
  `apr` double(15,3) DEFAULT '0.000',
  `may` double(15,3) DEFAULT '0.000',
  `jun` double(15,3) DEFAULT '0.000',
  `jul` double(15,3) DEFAULT '0.000',
  `aug` double(15,3) DEFAULT '0.000',
  `sep` double(15,3) DEFAULT '0.000',
  `oct` double(15,3) DEFAULT '0.000',
  `nov` double(15,3) DEFAULT '0.000',
  `dec` double(15,3) DEFAULT '0.000',
  `values` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cash_flow`
--


-- --------------------------------------------------------

--
-- Table structure for table `cash_on_hand`
--

DROP TABLE IF EXISTS `cash_on_hand`;
CREATE TABLE IF NOT EXISTS `cash_on_hand` (
  `cash_on_hand_amount` double(15,3) DEFAULT '0.000'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_on_hand`
--


-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `category`
--


-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `city`
--


-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `address` text,
  `phone_no` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(100) DEFAULT NULL,
  `fax_no` varchar(100) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `logo` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company`
--

REPLACE INTO `company` (`id`, `name`, `address`, `phone_no`, `mobile_no`, `fax_no`, `email_address`, `website`, `logo`) VALUES
(1, 'Test', 'dummy', '52342', '2342423423', '', 'test@smesoft.com.ph', 'smesoft.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `control_no`
--

DROP TABLE IF EXISTS `control_no`;
CREATE TABLE IF NOT EXISTS `control_no` (
  `type` varchar(20) DEFAULT NULL,
  `counter` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `control_no`
--


-- --------------------------------------------------------

--
-- Table structure for table `employee_status`
--

DROP TABLE IF EXISTS `employee_status`;
CREATE TABLE IF NOT EXISTS `employee_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `employee_status`
--

REPLACE INTO `employee_status` (`id`, `status`) VALUES
(1, 'Regular'),
(2, 'Contractual'),
(3, 'Probitionary'),
(4, 'Relief');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
CREATE TABLE IF NOT EXISTS `form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `set` tinyint(1) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `form`
--


-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

REPLACE INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

DROP TABLE IF EXISTS `meta`;
CREATE TABLE IF NOT EXISTS `meta` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `meta`
--

REPLACE INTO `meta` (`id`, `user_id`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, 1, 'Lambert', 'Agas', 'ADMIN', '0'),
(6, 6, 'Lexa', 'Morales', NULL, NULL),
(2, 2, 'Jezreel', 'Soriano', NULL, NULL),
(3, 3, '', '', NULL, NULL),
(4, 4, '', '', NULL, NULL),
(5, 5, '', '', NULL, NULL),
(7, 7, 'Jerome', 'David', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

REPLACE INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(100) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` int(10) unsigned NOT NULL DEFAULT '0',
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

REPLACE INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('d99bcb5e2853ef0114354b80d3140bb8', '0.0.0.0', 0, 1329491875, 'a:6:{s:9:"user_data";s:0:"";s:5:"email";s:19:"marc@friendster.com";s:2:"id";s:1:"1";s:7:"user_id";s:1:"1";s:8:"group_id";s:1:"1";s:5:"group";s:5:"admin";}'),
('988db55df8ff52888a5faa0e7f77dd27', '0.0.0.0', 0, 1329496122, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `ip_address` char(16) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `status_id` int(1) DEFAULT NULL,
  `home_phone` varchar(50) DEFAULT NULL,
  `work_phone` varchar(50) DEFAULT NULL,
  `date_hired` datetime DEFAULT NULL,
  `sss_no` varchar(50) DEFAULT NULL,
  `tin_no` varchar(50) DEFAULT NULL,
  `philhealth` varchar(50) DEFAULT NULL,
  `pagibig` varchar(50) DEFAULT NULL,
  `employee_status_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `security_question_id` int(1) DEFAULT NULL,
  `security_answer` varchar(255) DEFAULT NULL,
  `archive` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

REPLACE INTO `users` (`id`, `group_id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `remember_code`, `created_on`, `last_login`, `active`, `middle_name`, `last_name`, `address`, `gender`, `date_of_birth`, `status_id`, `home_phone`, `work_phone`, `date_hired`, `sss_no`, `tin_no`, `philhealth`, `pagibig`, `employee_status_id`, `first_name`, `salary`, `security_question_id`, `security_answer`, `archive`) VALUES
(1, 1, '127.0.0.1', 'marclambertagas', '321ba414bc382914b9f818ee3431cdcd31679af3', '9462e8eee0', 'marclambertagas@gmail.com', '', NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1329483239, 1, 'Ocampo', NULL, 'Makati Executive Tower I', 0, '1989-08-15', 0, '09166594223', '09274610040', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
(2, 2, '0.0.0.0', 'jez', '0', NULL, 'jez@gmail.com', NULL, NULL, NULL, 1328798680, 1328798680, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(7, 2, '0.0.0.0', 'Jerome', '046a906181dcf03f52a24632846050de251bfc62', NULL, 'jerome@gmail.com', NULL, NULL, NULL, 1329489997, 1329489997, 1, '', NULL, '', 0, '0000-00-00', 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(6, 1, '0.0.0.0', 'lexa', '7c917abc4f40022f388fb07a244b62bfb3eec5d0', NULL, 'lexa@gmail.com', NULL, NULL, NULL, 1329488739, 1329488739, 1, 'De Vera', NULL, 'Makati Executive Tower I ', 0, '0000-00-00', 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
