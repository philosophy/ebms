-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2012 at 08:49 AM
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
  `name` varchar(100) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created_by` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_updated_by` tinyint(4) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`, `active`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `company_id`) VALUES
(5, 'Dela Rosa St.', 1, 1, '2012-02-26 02:30:06', NULL, NULL, 2),
(6, 'Rozal St.', 1, 1, '2012-02-26 03:00:05', 4, '2012-03-06 08:22:00', 1),
(7, 'Burgos St.', 1, 1, '2012-02-26 03:02:36', 4, '2012-03-06 03:34:22', 1),
(8, 'Burgos St.', 0, 1, '2012-02-26 03:03:58', NULL, NULL, 1),
(9, 'Burgos St.', 0, 1, '2012-02-26 03:04:07', NULL, NULL, 1),
(10, 'Yague St.', 1, 1, '2012-02-26 03:05:00', 1, '2012-02-26 14:45:26', 1),
(11, 'Yakal St.', 1, 1, '2012-02-26 03:05:55', 1, '2012-02-26 14:47:28', 1),
(12, 'Paz St.', 0, 1, '2012-02-26 03:32:05', NULL, NULL, 1),
(13, 'San Mig Parongking St.', 1, 1, '2012-02-26 03:34:39', 1, '2012-02-26 13:50:54', 1),
(14, 'Buendia St.', 0, 1, '2012-02-26 04:14:57', NULL, NULL, 1),
(15, 'Zobel St.', 1, 1, '2012-02-26 04:17:21', NULL, NULL, 1),
(16, 'Rizal St.', 1, 1, '2012-02-26 04:18:36', NULL, NULL, 1),
(17, 'Zapote St.', 1, 1, '2012-02-26 04:20:04', NULL, NULL, 1),
(18, 'Batong St.', 0, 1, '2012-02-26 04:20:35', NULL, NULL, 1),
(19, 'Galvan St', 1, 1, '2012-02-26 04:30:55', NULL, NULL, 0),
(20, 'Tapuac St.', 1, 1, '2012-02-26 04:32:15', NULL, NULL, 1),
(21, 'Visita St.', 1, 1, '2012-02-26 04:33:16', NULL, NULL, 1),
(22, 'Gabon St.', 0, 1, '2012-02-26 04:56:05', NULL, NULL, 1),
(23, 'San Miguel St.', 1, 1, '2012-02-26 04:57:25', NULL, NULL, 1),
(24, 'Bagtasan', 1, 1, '2012-02-26 08:04:28', NULL, NULL, 1);

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
  `company_id` int(11) NOT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=290 ;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `user_id`, `subject_id`, `type`, `details`, `date_created`, `company_id`, `table_name`) VALUES
(125, 1, 1, 2, 'Updated profile', '2012-02-27 23:00:31', 1, 'users'),
(126, 1, 1, 2, 'Updated profile', '2012-02-27 23:06:02', 0, 'users'),
(127, 1, 1, 2, 'Updated profile', '2012-02-27 23:06:57', 0, 'users'),
(128, 1, 1, 2, 'Updated profile', '2012-02-27 23:08:47', 1, 'users'),
(129, 1, 1, 2, 'Updated profile', '2012-02-27 23:09:01', 0, 'users'),
(130, 1, 1, 2, 'Updated profile', '2012-02-27 23:10:22', 0, 'users'),
(131, 1, 1, 2, 'Updated profile', '2012-02-27 23:13:05', 0, 'users'),
(132, 1, 1, 2, 'Updated profile', '2012-02-27 23:19:33', 1, 'users'),
(133, 1, NULL, NULL, 'User logged in', '2012-02-28 09:30:17', 0, NULL),
(134, 1, 1, 2, 'Updated user', '2012-02-28 09:31:13', 1, 'users'),
(135, 1, NULL, NULL, 'User logged in', '2012-02-28 12:33:13', 0, NULL),
(136, 1, 1, 1, 'Create new city', '2012-02-28 12:36:56', 1, 'Cities'),
(137, 1, 3, 2, '', '2012-02-28 14:01:19', 1, 'users'),
(138, 1, 3, 3, '', '2012-02-28 14:04:10', 1, 'users'),
(139, 1, 4, 3, '', '2012-02-28 14:04:13', 1, 'users'),
(140, 1, 3, 2, '', '2012-02-28 14:04:18', 1, 'users'),
(141, 1, 4, 2, '', '2012-02-28 14:04:21', 1, 'users'),
(142, 1, 4, 3, 'Deactivate user', '2012-02-28 14:06:02', 1, 'users'),
(143, 1, 1, 1, 'Create new category', '2012-02-28 15:59:04', 1, 'category'),
(144, 1, 2, 1, 'Create new category', '2012-02-28 16:01:56', 1, 'category'),
(145, 1, NULL, NULL, 'User logged in', '2012-02-29 04:14:58', 0, NULL),
(146, 1, 3, 1, 'Create new category', '2012-02-29 04:18:36', 1, 'category'),
(147, 1, 4, 1, 'Create new category', '2012-02-29 04:19:12', 1, 'category'),
(148, 1, 5, 1, 'Create new category', '2012-02-29 04:20:02', 1, 'category'),
(149, 1, 6, 1, 'Create new category', '2012-02-29 04:21:06', 1, 'category'),
(150, 1, NULL, NULL, 'User logged in', '2012-02-29 11:57:52', 0, NULL),
(151, 1, 1, 3, 'Deactivate category', '2012-02-29 12:09:48', 1, 'category'),
(152, 1, 1, 2, 'Restore category', '2012-02-29 12:11:35', 1, 'category'),
(153, 1, 2, 3, 'Deactivate category', '2012-02-29 12:12:13', 1, 'category'),
(154, 1, 2, 2, 'Restore category', '2012-02-29 12:12:18', 1, 'category'),
(155, 1, 1, 2, 'Update category', '2012-02-29 12:36:47', 1, 'category'),
(156, 1, 1, 2, 'Update category', '2012-02-29 12:39:45', 1, 'category'),
(157, 1, 1, 2, 'Update category', '2012-02-29 12:39:53', 1, 'category'),
(158, 1, 2, 2, 'Update unit', '2012-02-29 12:46:14', 1, 'Units'),
(159, 1, 3, 2, 'Update category', '2012-02-29 12:47:26', 1, 'category'),
(160, 1, 2, 2, 'Update category', '2012-02-29 12:47:34', 1, 'category'),
(161, 1, 1, 2, 'Update category', '2012-02-29 12:47:40', 1, 'category'),
(162, 1, 4, 3, 'Deactivate category', '2012-02-29 12:47:47', 1, 'category'),
(163, 1, 5, 3, 'Deactivate category', '2012-02-29 12:47:50', 1, 'category'),
(164, 1, 6, 3, 'Deactivate category', '2012-02-29 12:47:53', 1, 'category'),
(165, 1, 1, 2, 'Update category', '2012-02-29 14:37:58', 1, 'category'),
(166, 1, NULL, NULL, 'User logged in', '2012-02-29 23:57:54', 0, NULL),
(167, 1, NULL, NULL, 'User logged in', '2012-03-01 07:20:30', 0, NULL),
(168, 1, 1, 1, 'Create new category', '2012-03-01 07:42:55', 1, 'category'),
(169, 1, 2, 1, 'Create new category', '2012-03-01 08:31:19', 1, 'category'),
(170, 1, 3, 1, 'Create new category', '2012-03-01 08:33:34', 1, 'category'),
(171, 1, 4, 1, 'Create new category', '2012-03-01 08:34:02', 1, 'category'),
(172, 1, 5, 1, 'Create new category', '2012-03-01 08:34:44', 1, 'category'),
(173, 1, 1, 3, 'Deactivate category', '2012-03-01 08:51:43', 1, 'category'),
(174, 1, 2, 3, 'Deactivate category', '2012-03-01 08:51:50', 1, 'category'),
(175, 1, 3, 3, 'Deactivate category', '2012-03-01 08:52:48', 1, 'category'),
(176, 1, 4, 3, 'Deactivate category', '2012-03-01 08:52:57', 1, 'category'),
(177, 1, 6, 1, 'Create new category', '2012-03-01 09:06:56', 1, 'category'),
(178, 1, 6, 2, 'Update category', '2012-03-01 09:11:02', 1, 'category'),
(179, 1, 6, 2, 'Update category', '2012-03-01 09:11:31', 1, 'category'),
(180, 1, 6, 2, 'Update category', '2012-03-01 09:12:09', 1, 'category'),
(181, 1, 6, 2, 'Update category', '2012-03-01 09:14:02', 1, 'category'),
(182, 1, 5, 3, 'Deactivate category', '2012-03-01 09:15:13', 1, 'sub_category'),
(183, 1, 4, 2, 'Restore category', '2012-03-01 09:18:55', 1, 'sub_category'),
(184, 1, 4, 2, 'Update category', '2012-03-01 10:19:02', 1, 'sub_category'),
(185, 1, 1, 2, 'Restore category', '2012-03-01 10:30:58', 1, 'sub_category'),
(186, 1, 1, 2, 'Update category', '2012-03-01 10:31:12', 1, 'sub_category'),
(187, 1, 3, 2, 'Restore category', '2012-03-01 10:31:25', 1, 'sub_category'),
(188, 1, 3, 2, 'Update category', '2012-03-01 10:31:43', 1, 'sub_category'),
(189, 1, 1, 2, 'Update category', '2012-03-01 10:34:15', 1, 'sub_category'),
(190, 1, 1, 2, 'Update category', '2012-03-01 10:40:31', 1, 'sub_category'),
(191, 1, 3, 2, 'Update category', '2012-03-01 10:41:02', 1, 'sub_category'),
(192, 1, 4, 2, 'Update category', '2012-03-01 10:41:52', 1, 'sub_category'),
(193, 1, 4, 2, 'Restore category', '2012-03-01 10:57:47', 1, 'category'),
(194, 1, 5, 2, 'Restore category', '2012-03-01 10:57:49', 1, 'category'),
(195, 1, 4, 2, 'Update category', '2012-03-01 10:57:59', 1, 'category'),
(196, 1, 4, 2, 'Update category', '2012-03-01 10:58:05', 1, 'category'),
(197, 1, 5, 2, 'Update category', '2012-03-01 10:58:13', 1, 'category'),
(198, 1, 7, 1, 'Create new category', '2012-03-01 10:58:28', 1, 'category'),
(199, 1, 7, 3, 'Deactivate category', '2012-03-01 10:58:33', 1, 'category'),
(200, 1, 3, 2, 'Update category', '2012-03-01 10:59:57', 1, 'sub_category'),
(201, 1, NULL, NULL, 'User logged in', '2012-03-01 11:54:50', 0, NULL),
(202, 1, 4, 3, 'Deactivate category', '2012-03-01 13:12:10', 1, 'category'),
(203, 1, 4, 3, 'Deactivate category', '2012-03-01 13:12:10', 1, 'category'),
(204, 1, 5, 3, 'Deactivate category', '2012-03-01 13:12:13', 1, 'category'),
(205, 1, 3, 3, 'Deactivate category', '2012-03-01 13:14:37', 1, 'sub_category'),
(206, 1, 1, 1, 'Create new brand', '2012-03-01 13:16:06', 1, 'brands'),
(207, 1, 2, 1, 'Create new brand', '2012-03-01 13:19:24', 1, 'brands'),
(208, 1, 2, 3, 'Deactivate brand', '2012-03-01 13:19:39', 1, 'brands'),
(209, 1, 2, 3, 'Deactivate brand', '2012-03-01 13:22:25', 1, 'brands'),
(210, 1, 3, 1, 'Create new brand', '2012-03-01 13:24:13', 1, 'brands'),
(211, 1, 3, 3, 'Deactivate brand', '2012-03-01 13:24:26', 1, 'brands'),
(212, 1, 3, 2, 'Restore brand', '2012-03-01 13:30:07', 1, 'brands'),
(213, 1, 2, 2, 'Restore brand', '2012-03-01 13:30:50', 1, 'brands'),
(214, 1, 2, 3, 'Deactivate brand', '2012-03-01 13:31:52', 1, 'brands'),
(215, 1, 2, 2, 'Restore brand', '2012-03-01 13:32:17', 1, 'brands'),
(216, 1, 2, 3, 'Deactivate brand', '2012-03-01 13:33:09', 1, 'brands'),
(217, 1, 2, 2, 'Restore brand', '2012-03-01 13:33:16', 1, 'brands'),
(218, 1, 2, 3, 'Deactivate brand', '2012-03-01 13:33:28', 1, 'brands'),
(219, 1, 3, 3, 'Deactivate brand', '2012-03-01 13:33:32', 1, 'brands'),
(220, 1, 2, 2, 'Restore brand', '2012-03-01 13:33:40', 1, 'brands'),
(221, 1, NULL, NULL, 'User logged in', '2012-03-02 04:58:43', 0, NULL),
(222, 1, NULL, NULL, 'User logged in', '2012-03-02 13:46:25', 0, NULL),
(223, 1, NULL, NULL, 'User logged in', '2012-03-06 02:07:53', 0, NULL),
(224, 1, 3, 1, 'Create new unit', '2012-03-06 02:12:07', 1, 'Units'),
(225, 1, 3, 2, 'Update unit', '2012-03-06 02:12:33', 1, 'Units'),
(226, 1, 3, 3, 'Deactivate unit', '2012-03-06 02:12:43', 1, 'Units'),
(227, 1, 3, 2, 'Restore unit', '2012-03-06 02:12:49', 1, 'Units'),
(228, 1, 1, 2, 'Restore unit', '2012-03-06 02:12:52', 1, 'Units'),
(229, 1, 16, 1, 'Create city', '2012-03-06 02:15:03', 1, 'city'),
(230, 1, 16, 2, 'Update city', '2012-03-06 02:15:13', 1, 'city'),
(231, 1, 16, 3, 'Deactivate city', '2012-03-06 02:15:18', 1, 'city'),
(232, 1, 16, 2, 'Restore city', '2012-03-06 02:15:25', 1, 'city'),
(233, 1, 15, 2, 'Restore city', '2012-03-06 02:15:28', 1, 'city'),
(234, 1, 2, 1, 'Create industry', '2012-03-06 02:15:54', 1, 'industry'),
(235, 1, 2, 2, 'Update industry', '2012-03-06 02:16:06', 1, 'industry'),
(236, 1, 2, 3, 'Deactivate industry', '2012-03-06 02:16:10', 1, 'industry'),
(237, 1, 2, 2, 'Restore industry', '2012-03-06 02:16:22', 1, 'industry'),
(238, 1, 1, 1, 'Create customer', '2012-03-06 02:32:17', 1, 'customer'),
(239, 1, 1, 2, 'Update customer', '2012-03-06 02:32:36', 1, 'customer'),
(240, 1, 1, 3, 'Deactivate customer', '2012-03-06 02:32:42', 1, 'customer'),
(241, 1, 1, 2, 'Restore customer', '2012-03-06 02:32:49', 1, 'customer'),
(242, 1, 1, 3, 'Deactivate location', '2012-03-06 02:41:47', 1, 'location'),
(243, 1, 2, 1, 'Create location', '2012-03-06 02:43:27', 1, 'location'),
(244, 1, 2, 2, 'Update location', '2012-03-06 02:43:39', 1, 'location'),
(245, 1, 2, 3, 'Deactivate location', '2012-03-06 02:43:45', 1, 'location'),
(246, 1, 1, 2, 'Restore location', '2012-03-06 02:43:52', 1, 'location'),
(247, 1, 2, 2, 'Restore location', '2012-03-06 02:43:57', 1, 'location'),
(248, 1, 1, 2, 'Update location', '2012-03-06 02:44:15', 1, 'location'),
(249, 4, NULL, NULL, 'User logged in', '2012-03-06 03:32:47', 0, NULL),
(250, 4, 6, 2, 'Update area', '2012-03-06 03:34:04', 1, 'area'),
(251, 4, 22, 3, 'Deactivate area', '2012-03-06 03:34:11', 1, 'area'),
(252, 4, 7, 2, 'Restore area', '2012-03-06 03:34:22', 1, 'area'),
(253, 4, 1, 1, 'Create new currency', '2012-03-06 04:05:52', 1, 'currency'),
(254, 4, 2, 1, 'Create new currency', '2012-03-06 04:06:07', 1, 'currency'),
(255, 4, 3, 1, 'Create new currency', '2012-03-06 04:06:20', 1, 'currency'),
(256, 4, 4, 1, 'Create new currency', '2012-03-06 04:06:32', 1, 'currency'),
(257, 4, 4, 2, 'Update currency', '2012-03-06 04:07:06', 1, 'currency'),
(258, 4, 1, 3, 'Deactivate currency', '2012-03-06 04:07:14', 1, 'currency'),
(259, 4, 1, 2, 'Restore currency', '2012-03-06 04:07:21', 1, 'currency'),
(260, 4, 9, 1, 'Create new employee status', '2012-03-06 05:54:30', 1, 'employee_status'),
(261, 4, 9, 3, 'Deactivate employee status', '2012-03-06 06:21:52', 1, 'employee_status'),
(262, 4, 9, 2, 'Restore employee status', '2012-03-06 06:22:06', 1, 'employee_status'),
(263, 4, 9, 2, '', '2012-03-06 06:41:48', 1, 'employee_status'),
(264, 4, NULL, NULL, 'User logged in', '2012-03-06 08:09:41', 0, NULL),
(265, 4, 6, 2, 'Update area', '2012-03-06 08:22:00', 1, 'area'),
(266, 4, 5, 2, 'Restore category', '2012-03-06 08:48:24', 1, 'sub_category'),
(267, 4, 5, 2, 'Restore category', '2012-03-06 08:48:26', 1, 'sub_category'),
(268, 1, NULL, NULL, 'User logged in', '2012-03-06 13:51:33', 0, NULL),
(269, 1, NULL, NULL, 'User logged in', '2012-03-08 01:23:08', 0, NULL),
(270, 1, 1, 1, 'Create new deduction', '2012-03-08 02:43:27', 1, 'deduction'),
(271, 1, 2, 1, 'Create new deduction', '2012-03-08 02:43:38', 1, 'deduction'),
(272, 1, 3, 1, 'Create new deduction', '2012-03-08 02:43:54', 1, 'deduction'),
(273, 1, 3, 2, 'Update deduction', '2012-03-08 02:44:03', 1, 'deduction'),
(274, 1, 3, 2, 'Update deduction', '2012-03-08 02:44:12', 1, 'deduction'),
(275, 1, 3, 3, 'Deactivate deduction', '2012-03-08 02:44:16', 1, 'deduction'),
(276, 1, 3, 2, 'Restore deduction', '2012-03-08 02:44:21', 1, 'deduction'),
(277, 1, 4, 1, 'Create new deduction', '2012-03-08 03:18:59', 1, 'deduction'),
(278, 1, 5, 1, 'Create new deduction', '2012-03-08 03:19:14', 1, 'deduction'),
(279, 1, 6, 1, 'Create new deduction', '2012-03-08 03:19:33', 1, 'deduction'),
(280, 1, 7, 1, 'Create new deduction', '2012-03-08 03:20:32', 1, 'deduction'),
(281, 1, NULL, NULL, 'User logged in', '2012-03-08 06:16:35', 0, NULL),
(282, 1, NULL, NULL, 'User logged in', '2012-03-08 09:24:14', 0, NULL),
(283, 1, NULL, NULL, 'User logged in', '2012-03-09 06:40:43', 0, NULL),
(284, 1, NULL, NULL, 'User logged in', '2012-03-09 08:53:11', 0, NULL),
(285, 1, NULL, NULL, 'User logged in', '2012-03-10 01:58:09', 0, NULL),
(286, 1, 1, 1, 'Create new deduction', '2012-03-10 01:58:24', 1, 'company'),
(287, 1, 1, 3, '', '2012-03-10 01:58:42', 1, 'company'),
(288, 1, NULL, NULL, 'User logged in', '2012-03-10 04:50:51', 0, NULL),
(289, 1, NULL, NULL, 'User logged in', '2012-03-10 08:07:01', 0, NULL);

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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `sub_category_id`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `active`, `company_id`) VALUES
(1, 'Pilot', 4, 1, '2012-03-01 13:16:06', NULL, NULL, 1, 1),
(2, 'xxx', 6, 1, '2012-03-01 13:19:24', 1, '2012-03-01 13:33:40', 1, 1),
(3, 'Panda', 4, 1, '2012-03-01 13:24:13', 1, '2012-03-01 13:30:07', 0, 1);

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
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `code`, `name`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `company_id`, `active`) VALUES
(1, '0001', 'Office Equipment', 1, '2012-02-28 15:59:04', 1, '2012-02-29 14:37:58', 1, 1),
(2, '0002', 'Office Supplies', 1, '2012-02-28 16:01:56', 1, '2012-02-29 12:47:34', 1, 1),
(3, '0003', 'Kitchen Supplies', 1, '2012-02-29 04:18:36', 1, '2012-02-29 12:47:26', 1, 1),
(4, '0004', 'Kitchen Supplies', 1, '2012-02-29 04:19:12', 1, '2012-03-01 10:58:05', 1, 0),
(5, '0005', 'Kitchen Supplies', 1, '2012-02-29 04:20:02', 1, '2012-03-01 10:58:13', 1, 0),
(6, '003', 'Kitchen Supplies', 1, '2012-02-29 04:21:06', NULL, NULL, 1, 0),
(7, '0005', 'Kitchen', 1, '2012-03-01 10:58:28', NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `active`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `company_id`) VALUES
(15, 'Makati', 1, 1, '2012-03-01 03:56:47', 1, '2012-03-06 02:15:28', 1),
(14, 'Alabang', 1, 1, '2012-02-28 12:43:43', 1, '2012-03-01 04:16:43', 1),
(16, 'Manila', 1, 1, '2012-03-06 02:15:03', 1, '2012-03-06 02:15:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `active`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `company_id`) VALUES
(1, 'Friendster', 0, 1, '2012-03-10 01:58:24', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

DROP TABLE IF EXISTS `company_info`;
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
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `symbol`, `active`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `company_id`) VALUES
(1, 'Euro', NULL, 1, 4, '2012-03-06 04:05:52', 4, '2012-03-06 04:07:21', 1),
(2, 'Yen', NULL, 1, 4, '2012-03-06 04:06:07', NULL, NULL, 1),
(3, 'Peso', NULL, 1, 4, '2012-03-06 04:06:20', NULL, NULL, 1),
(4, 'US Dollar', NULL, 1, 4, '2012-03-06 04:06:32', 4, '2012-03-06 04:07:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `code`, `name`, `active`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `company_id`) VALUES
(1, NULL, 'Incorporated', 1, 1, '2012-03-06 02:32:17', 1, '2012-03-06 02:32:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

DROP TABLE IF EXISTS `deduction`;
CREATE TABLE IF NOT EXISTS `deduction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `deduction`
--

INSERT INTO `deduction` (`id`, `name`, `active`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `company_id`) VALUES
(1, 'SSS', 1, 1, '2012-03-08 02:43:27', NULL, NULL, 1),
(2, 'Pag-ibig', 1, 1, '2012-03-08 02:43:38', NULL, NULL, 1),
(3, 'PhilHealth', 1, 1, '2012-03-08 02:43:54', 1, '2012-03-08 02:44:21', 1),
(4, 'Cash Advance', 1, 1, '2012-03-08 03:18:59', NULL, NULL, 1),
(5, 'Late', 1, 1, '2012-03-08 03:19:14', NULL, NULL, 1),
(6, 'Absent', 1, 1, '2012-03-08 03:19:33', NULL, NULL, 1),
(7, 'Tax', 1, 1, '2012-03-08 03:20:32', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_updated_by` int(11) NOT NULL,
  `last_updated_at` datetime NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `active`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `company_id`) VALUES
(1, 'Accounting Department', 1, 1, '2012-02-22 15:32:22', 1, '2012-02-26 08:01:51', 1),
(2, 'test', 0, 1, '2012-02-23 16:08:34', 0, '0000-00-00 00:00:00', 1),
(3, 'sd', NULL, 1, '2012-02-23 23:41:24', 0, '0000-00-00 00:00:00', 1),
(4, 'Purchase Department', 0, 1, '2012-02-24 01:41:21', 1, '2012-02-24 15:10:30', 1),
(5, 'Sales Department', 0, 1, '2012-02-24 15:15:42', 0, '0000-00-00 00:00:00', 1),
(6, 'Engineering Department', 1, 1, '2012-02-24 15:20:03', 1, '2012-02-24 15:46:25', 1),
(7, 'HR Department', 0, 1, '2012-02-24 16:13:59', 0, '0000-00-00 00:00:00', 1),
(8, 'Games Department', 1, 1, '2012-02-24 16:41:33', 0, '0000-00-00 00:00:00', 1),
(9, 'Quality Assurance', 1, 1, '2012-02-26 08:02:07', 0, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `earning`
--

DROP TABLE IF EXISTS `earning`;
CREATE TABLE IF NOT EXISTS `earning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `earning`
--


-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` int(4) NOT NULL,
  `marital_status` int(11) NOT NULL DEFAULT '0',
  `home_phone` varchar(100) DEFAULT NULL,
  `work_phone` varchar(100) DEFAULT NULL,
  `date_hired` date DEFAULT NULL,
  `sss_no` varchar(100) DEFAULT NULL,
  `tin_no` varchar(100) DEFAULT NULL,
  `philhealth` varchar(100) DEFAULT NULL,
  `pagibig` varchar(100) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `active` bit(1) NOT NULL,
  `employee_status_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `employees`
--


-- --------------------------------------------------------

--
-- Table structure for table `employee_status`
--

DROP TABLE IF EXISTS `employee_status`;
CREATE TABLE IF NOT EXISTS `employee_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `active` tinyint(11) DEFAULT '1',
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `employee_status`
--

INSERT INTO `employee_status` (`id`, `name`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `active`, `company_id`) VALUES
(1, NULL, 0, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 1, 0),
(2, NULL, 0, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 1, 0),
(3, NULL, 0, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 1, 0),
(4, NULL, 0, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 1, 0),
(5, 'Regular', 1, '2012-02-26 15:40:11', 1, '2012-02-26 15:43:33', 1, 1),
(6, 'Contractual', 1, '2012-02-26 15:41:05', NULL, NULL, 0, 1),
(7, 'Probitionary', 1, '2012-02-26 15:43:49', NULL, NULL, 0, 1),
(8, 'IT Consultant', 1, '2012-02-26 16:48:24', NULL, NULL, 0, 1),
(9, 'Benefit', 4, '2012-03-06 05:54:30', 4, '2012-03-06 06:41:48', 1, 1);

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

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `industry`
--

DROP TABLE IF EXISTS `industry`;
CREATE TABLE IF NOT EXISTS `industry` (
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
-- Dumping data for table `industry`
--

INSERT INTO `industry` (`id`, `name`, `active`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `company_id`) VALUES
(1, 'Farming', 1, 1, '2012-02-29 04:58:20', 1, '2012-03-01 04:41:29', 1),
(2, 'Mining', 1, 1, '2012-03-06 02:15:54', 1, '2012-03-06 02:16:22', 1);

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
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(100) NOT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `minimum_stock` int(11) DEFAULT NULL,
  `normal_stock` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `items`
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
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
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
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `active`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `company_id`) VALUES
(1, 'Sta. Mesa', 1, 1, '2012-02-29 06:47:00', 1, '2012-03-06 02:44:15', 1),
(2, 'Sta. Ana', 1, 1, '2012-03-06 02:43:27', 1, '2012-03-06 02:43:57', 1);

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

INSERT INTO `meta` (`id`, `user_id`, `first_name`, `last_name`, `company`, `phone`) VALUES
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

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_updated_at` datetime DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `date_created` datetime NOT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `last_updated_at`, `active`, `date_created`, `last_updated_by`, `company_id`, `name`, `created_by`) VALUES
(1, '2012-02-26 16:51:49', 1, '2012-02-26 16:37:22', 1, 1, 'Marketing Head', 1),
(2, NULL, 1, '2012-02-26 16:50:50', NULL, 1, 'IT/Consultant', 1);

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

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('dbd3cc57f8839198752316b01384c82e', '127.0.0.1', 0, 1331368979, 'a:6:{s:9:"user_data";s:0:"";s:5:"email";s:25:"marclambertagas@gmail.com";s:2:"id";s:1:"1";s:7:"user_id";s:1:"1";s:8:"group_id";s:1:"1";s:5:"group";s:5:"admin";}'),
('f05d9bdd4694d6ef817684177ef5ee11', '127.0.0.1', 0, 1331366803, 'a:6:{s:9:"user_data";s:0:"";s:5:"email";s:25:"marclambertagas@gmail.com";s:2:"id";s:1:"1";s:7:"user_id";s:1:"1";s:8:"group_id";s:1:"1";s:5:"group";s:5:"admin";}');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `active` tinyint(4) DEFAULT '1',
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `code`, `name`, `category_id`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `active`, `company_id`) VALUES
(1, 'S003', 'Plates', 3, 1, '2012-03-01 07:42:55', 1, '2012-03-01 10:40:31', 1, 1),
(2, '0', 'test', 3, 1, '2012-03-01 08:31:19', NULL, NULL, 0, 1),
(3, 'S003', 'Office Equipment', 1, 1, '2012-03-01 08:33:34', 1, '2012-03-01 10:59:57', 0, 1),
(4, 'S001', 'Ballpens', 1, 1, '2012-03-01 08:34:02', 1, '2012-03-01 10:41:52', 1, 1),
(5, 'S004', 'Watch', 1, 1, '2012-03-01 08:34:44', 4, '2012-03-06 08:48:26', 1, 1),
(6, 'S005', 'Gloves', 3, 1, '2012-03-01 09:06:56', 1, '2012-03-01 09:14:02', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  `last_updated_at` datetime DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `active`, `created_by`, `date_created`, `last_updated_by`, `last_updated_at`, `company_id`) VALUES
(1, 'Box', 1, 1, '2012-02-27 13:16:32', 1, '2012-03-06 02:12:52', 1),
(2, 'Kilograms', 1, 1, '2012-02-27 22:08:25', 1, '2012-02-29 12:46:14', 1),
(3, 'Pounds', 1, 1, '2012-03-06 02:12:07', 1, '2012-03-06 02:12:49', 1);

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
  `updated_at` datetime DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `employee_status_id` int(11) DEFAULT NULL,
  `security_question_id` int(1) DEFAULT NULL,
  `security_answer` text,
  `archive` int(2) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `remember_code`, `created_on`, `last_login`, `active`, `middle_name`, `address`, `date_of_birth`, `gender`, `status_id`, `home_phone`, `work_phone`, `date_hired`, `sss_no`, `tin_no`, `philhealth`, `pagibig`, `salary`, `updated_at`, `position_id`, `employee_status_id`, `security_question_id`, `security_answer`, `archive`, `company_id`, `created_by`, `last_updated_by`) VALUES
(1, 1, '127.0.0.1', 'marc agas', '9db33919162e26191d6a18e062185ad054dda28f', '9462e8eee0', 'marclambertagas@gmail.com', '', NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1331366821, 1, 'Test', 'Makati Executive Tower I', '2012-02-18', 0, 1, '11111111111', '09274610041', '2012-02-18', '', '', '', '', '0.00', '2012-02-18 00:00:00', 0, 3, 1, 'breadpan', 0, 1, NULL, NULL),
(2, 2, '0.0.0.0', 'jerome', 'da4cc76b415e25552e3a2ccc86bf4bd287672d77', NULL, 'jerome@smesoft.com.ph', NULL, NULL, NULL, 1328951211, 1328951211, 1, '', '', '2012-02-18', 0, 0, '', '', '2012-02-18', NULL, NULL, NULL, NULL, NULL, '2012-02-18 00:00:00', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL),
(3, 2, '0.0.0.0', 'she', 'b336fdf1f08d1cbbe1e0591bfc765db8d6b03e27', NULL, 'she@gmail.com', NULL, NULL, NULL, 1329226985, 1329226985, 1, '', '', '2012-02-18', 0, 0, '', '', '2012-02-18', NULL, NULL, NULL, NULL, NULL, '2012-02-18 00:00:00', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(4, 2, '0.0.0.0', 'jerome1173', '5fb245b77895243a9e7115e1da597a048ae7193f', NULL, 'jmocampo17@yahoo.com', NULL, NULL, NULL, 1329363497, 1331021381, 1, 'Mellendres', 'Muntinlupa City', '2012-02-18', 0, 0, '86282374512', '09174679947', '2012-02-18', NULL, NULL, NULL, NULL, NULL, '2012-02-18 00:00:00', NULL, NULL, NULL, NULL, 1, 1, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
