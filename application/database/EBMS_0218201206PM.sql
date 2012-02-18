-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2012 at 10:16 AM
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `details` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `audit_trail`
--

REPLACE INTO `audit_trail` (`id`, `user_id`, `subject_id`, `type`, `details`, `date_created`) VALUES
(5, 1, NULL, NULL, 'User logged in', '2012-02-18 07:44:59'),
(6, 1, 1, 2, 'Update user fdfd123', '2012-02-18 09:34:49'),
(7, 1, 1, 2, 'Update profile', '2012-02-18 09:36:11'),
(8, 1, 1, 2, 'Update profile', '2012-02-18 09:36:50'),
(9, 1, 1, 2, 'Update profile', '2012-02-18 09:37:01'),
(10, 1, 1, 2, 'Update profile', '2012-02-18 09:37:09'),
(11, 1, 1, 2, 'Update profile', '2012-02-18 09:37:17'),
(12, 1, 1, 2, 'Update profile', '2012-02-18 09:37:26'),
(13, 1, 1, 2, 'Update profile', '2012-02-18 09:37:35'),
(14, 1, 1, 2, 'Update profile', '2012-02-18 09:37:43'),
(15, 1, 1, 2, 'Update profile', '2012-02-18 09:37:52'),
(16, 1, 1, 2, 'Update profile', '2012-02-18 09:38:05'),
(17, 1, NULL, NULL, 'User logged in', '2012-02-18 09:58:33'),
(18, 1, NULL, NULL, 'User logged in', '2012-02-18 09:58:48');

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
-- Dumping data for table `company`
--

REPLACE INTO `company` (`id`, `name`, `address`, `phone_no`, `mobile_no`, `fax_no`, `email_address`, `website`, `logo`) VALUES
(1, 'SME', '', '0987474743', '8476362', '2342234', 'Dummy@yahoo.com', 'www.dummy.com', '');

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
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `symbol` text,
  `deleted` tinyint(4) DEFAULT '0',
  `flag` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `currency`
--


-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

DROP TABLE IF EXISTS `customer_type`;
CREATE TABLE IF NOT EXISTS `customer_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `customer_type`
--


-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

DROP TABLE IF EXISTS `deduction`;
CREATE TABLE IF NOT EXISTS `deduction` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `flag` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `deduction`
--


-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `department`
--


-- --------------------------------------------------------

--
-- Table structure for table `earning`
--

DROP TABLE IF EXISTS `earning`;
CREATE TABLE IF NOT EXISTS `earning` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `flag` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `earning`
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
-- Table structure for table `industry_type`
--

DROP TABLE IF EXISTS `industry_type`;
CREATE TABLE IF NOT EXISTS `industry_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `industry_type`
--


-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

DROP TABLE IF EXISTS `leave_type`;
CREATE TABLE IF NOT EXISTS `leave_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `no_of_days` int(11) DEFAULT '0',
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `leave_type`
--


-- --------------------------------------------------------

--
-- Table structure for table `location_type`
--

DROP TABLE IF EXISTS `location_type`;
CREATE TABLE IF NOT EXISTS `location_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(100) DEFAULT NULL,
  `deleted` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `location_type`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `meta`
--

REPLACE INTO `meta` (`id`, `user_id`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, 1, 'Marc Lambert', 'Agas', 'Friendster', '0'),
(2, 2, 'jerome', 'know', NULL, NULL),
(3, 3, 'Sherwin', 'Sherwin', NULL, NULL),
(4, 4, 'Jerome', 'Ocampo', NULL, NULL);

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
('84c7475a4b8b557f5f49aa227b1f19a6', '0.0.0.0', 0, 1329559028, 'a:6:{s:9:"user_data";s:0:"";s:5:"email";s:25:"marclambertagas@gmail.com";s:2:"id";s:1:"1";s:7:"user_id";s:1:"1";s:8:"group_id";s:1:"1";s:5:"group";s:5:"admin";}'),
('1d0fc05be8e9990094276c992acd93fd', '0.0.0.0', 0, 1329559493, 'a:6:{s:9:"user_data";s:0:"";s:5:"email";s:25:"marclambertagas@gmail.com";s:2:"id";s:1:"1";s:7:"user_id";s:1:"1";s:8:"group_id";s:1:"1";s:5:"group";s:5:"admin";}'),
('43815f966cd8a29b9a049f649632baa4', '0.0.0.0', 0, 1329551073, 'a:6:{s:9:"user_data";s:0:"";s:5:"email";s:25:"marclambertagas@gmail.com";s:2:"id";s:1:"1";s:7:"user_id";s:1:"1";s:8:"group_id";s:1:"1";s:5:"group";s:5:"admin";}');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `unit`
--


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
  `middle_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `home_phone` varchar(255) DEFAULT NULL,
  `work_phone` varchar(255) DEFAULT NULL,
  `date_hired` date DEFAULT NULL,
  `sss_no` varchar(255) DEFAULT NULL,
  `tin_no` varchar(255) DEFAULT NULL,
  `philhealth` varchar(255) DEFAULT NULL,
  `pagibig` varchar(255) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `employee_status_id` int(11) DEFAULT NULL,
  `security_question_id` int(1) DEFAULT NULL,
  `security_answer` text,
  `archive` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

REPLACE INTO `users` (`id`, `group_id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `remember_code`, `created_on`, `last_login`, `active`, `middle_name`, `address`, `date_of_birth`, `gender`, `status_id`, `home_phone`, `work_phone`, `date_hired`, `sss_no`, `tin_no`, `philhealth`, `pagibig`, `salary`, `updated_at`, `position_id`, `employee_status_id`, `security_question_id`, `security_answer`, `archive`) VALUES
(1, 1, '127.0.0.1', 'fdfd123', '9db33919162e26191d6a18e062185ad054dda28f', '9462e8eee0', 'marclambertagas@gmail.com', '', NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1329559128, 1, 'Test', 'Makati Executive Tower I', '2012-02-18', 0, 1, '11111111111', '09274610041', '2012-02-18', '', '', '', '', '0.00', '2012-02-18', 0, 3, 1, 'breadpan', 0),
(2, 2, '0.0.0.0', 'jerome', 'da4cc76b415e25552e3a2ccc86bf4bd287672d77', NULL, 'jerome@smesoft.com.ph', NULL, NULL, NULL, 1328951211, 1328951211, 1, '', '', '2012-02-18', 0, 0, '', '', '2012-02-18', NULL, NULL, NULL, NULL, NULL, '2012-02-18', NULL, NULL, NULL, NULL, 0),
(3, 2, '0.0.0.0', 'she', 'b336fdf1f08d1cbbe1e0591bfc765db8d6b03e27', NULL, 'she@gmail.com', NULL, NULL, NULL, 1329226985, 1329226985, 1, '', '', '2012-02-18', 0, 0, '', '', '2012-02-18', NULL, NULL, NULL, NULL, NULL, '2012-02-18', NULL, NULL, NULL, NULL, 0),
(4, 2, '0.0.0.0', 'jerome1173', '5fb245b77895243a9e7115e1da597a048ae7193f', NULL, 'jmocampo17@yahoo.com', NULL, NULL, NULL, 1329363497, 1329452109, 1, 'Mellendres', 'Muntinlupa City', '2012-02-18', 0, 0, '86282374512', '09174679947', '2012-02-18', NULL, NULL, NULL, NULL, NULL, '2012-02-18', NULL, NULL, NULL, NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
