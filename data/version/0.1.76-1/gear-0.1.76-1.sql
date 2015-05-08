-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2015 at 02:09 PM
-- Server version: 5.5.40
-- PHP Version: 5.5.22-1+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pibernews`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `id_action` int(11) NOT NULL AUTO_INCREMENT,
  `id_controller` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_action`),
  KEY `id_controller` (`id_controller`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=101 ;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id_action`, `id_controller`, `name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 1, 'AutoincrementDatabase', '2015-05-07 10:04:29', 2, NULL, NULL),
(2, 1, 'DropTable', '2015-05-07 10:04:29', 2, NULL, NULL),
(3, 1, 'GetOrder', '2015-05-07 10:04:29', 2, NULL, NULL),
(4, 1, 'AnalyseDatabase', '2015-05-07 10:04:29', 2, NULL, NULL),
(5, 1, 'AnalyseTable', '2015-05-07 10:04:29', 2, NULL, NULL),
(6, 1, 'AutoincrementTable', '2015-05-07 10:04:29', 2, NULL, NULL),
(7, 1, 'ClearTable', '2015-05-07 10:04:29', 2, NULL, NULL),
(8, 1, 'CreateColumn', '2015-05-07 10:04:29', 2, NULL, NULL),
(9, 1, 'FixDatabase', '2015-05-07 10:04:29', 2, NULL, NULL),
(10, 1, 'FixTable', '2015-05-07 10:04:29', 2, NULL, NULL),
(11, 1, 'MysqlLoad', '2015-05-07 10:04:30', 2, NULL, NULL),
(12, 1, 'MysqlDump', '2015-05-07 10:04:30', 2, NULL, NULL),
(13, 1, 'Fixture', '2015-05-07 10:04:30', 2, NULL, NULL),
(14, 2, 'Build', '2015-05-07 10:04:30', 2, NULL, NULL),
(15, 3, 'Action', '2015-05-07 10:04:30', 2, NULL, NULL),
(16, 3, 'Controller', '2015-05-07 10:04:30', 2, NULL, NULL),
(17, 3, 'Db', '2015-05-07 10:04:30', 2, NULL, NULL),
(18, 3, 'Src', '2015-05-07 10:04:30', 2, NULL, NULL),
(19, 3, 'Test', '2015-05-07 10:04:30', 2, NULL, NULL),
(20, 3, 'View', '2015-05-07 10:04:30', 2, NULL, NULL),
(21, 4, 'Entities', '2015-05-07 10:04:30', 2, NULL, NULL),
(22, 4, 'Entity', '2015-05-07 10:04:30', 2, NULL, NULL),
(23, 4, 'Dump', '2015-05-07 10:04:30', 2, NULL, NULL),
(24, 4, 'Create', '2015-05-07 10:04:30', 2, NULL, NULL),
(25, 4, 'Delete', '2015-05-07 10:04:30', 2, NULL, NULL),
(26, 4, 'Load', '2015-05-07 10:04:30', 2, NULL, NULL),
(27, 4, 'Unload', '2015-05-07 10:04:30', 2, NULL, NULL),
(28, 4, 'Build', '2015-05-07 10:04:30', 2, NULL, NULL),
(29, 4, 'Push', '2015-05-07 10:04:30', 2, NULL, NULL),
(30, 4, 'Light', '2015-05-07 10:04:30', 2, NULL, NULL),
(31, 4, 'Jenkins', '2015-05-07 10:04:30', 2, NULL, NULL),
(32, 4, 'DumpAutoload', '2015-05-07 10:04:30', 2, NULL, NULL),
(33, 5, 'Deploy', '2015-05-07 10:04:30', 2, NULL, NULL),
(34, 5, 'RenewCache', '2015-05-07 10:04:30', 2, NULL, NULL),
(35, 5, 'Push', '2015-05-07 10:04:30', 2, NULL, NULL),
(36, 5, 'Build', '2015-05-07 10:04:30', 2, NULL, NULL),
(37, 5, 'Mysql2sqlite', '2015-05-07 10:04:30', 2, NULL, NULL),
(38, 5, 'ResetAcl', '2015-05-07 10:04:30', 2, NULL, NULL),
(39, 5, 'Acl', '2015-05-07 10:04:30', 2, NULL, NULL),
(40, 5, 'Config', '2015-05-07 10:04:30', 2, NULL, NULL),
(41, 5, 'Dump', '2015-05-07 10:04:30', 2, NULL, NULL),
(42, 5, 'Environment', '2015-05-07 10:04:30', 2, NULL, NULL),
(43, 5, 'Global', '2015-05-07 10:04:30', 2, NULL, NULL),
(44, 5, 'Local', '2015-05-07 10:04:31', 2, NULL, NULL),
(45, 5, 'Mysql', '2015-05-07 10:04:31', 2, NULL, NULL),
(46, 5, 'Project', '2015-05-07 10:04:31', 2, NULL, NULL),
(47, 5, 'Sqlite', '2015-05-07 10:04:31', 2, NULL, NULL),
(48, 5, 'Fixture', '2015-05-07 10:04:31', 2, NULL, NULL),
(49, 5, 'Jenkins', '2015-05-07 10:04:31', 2, NULL, NULL),
(50, 6, 'Acl', '2015-05-07 10:04:31', 2, NULL, NULL),
(51, 6, 'ResetAcl', '2015-05-07 10:04:31', 2, NULL, NULL),
(52, 7, 'ModuleVersion', '2015-05-07 10:04:31', 2, NULL, NULL),
(53, 7, 'ProjectVersion', '2015-05-07 10:04:31', 2, NULL, NULL),
(54, 8, 'Index', '2015-05-07 10:04:31', 2, NULL, NULL),
(55, 9, 'Index', '2015-05-07 10:04:31', 2, NULL, NULL),
(56, 10, 'Login', '2015-05-07 10:04:31', 2, NULL, NULL),
(57, 10, 'SendPasswordRecoveryRequest', '2015-05-07 10:04:31', 2, NULL, NULL),
(58, 10, 'PasswordRecoveryRequestSent', '2015-05-07 10:04:31', 2, NULL, NULL),
(59, 10, 'PasswordRecovery', '2015-05-07 10:04:32', 2, NULL, NULL),
(60, 10, 'PasswordRecoverySuccessful', '2015-05-07 10:04:32', 2, NULL, NULL),
(61, 10, 'Index', '2015-05-07 10:04:32', 2, NULL, NULL),
(62, 10, 'ChangePassword', '2015-05-07 10:04:32', 2, NULL, NULL),
(63, 10, 'ChangePasswordSuccessful', '2015-05-07 10:04:32', 2, NULL, NULL),
(64, 10, 'Logout', '2015-05-07 10:04:32', 2, NULL, NULL),
(65, 10, 'InvalidLink', '2015-05-07 10:04:32', 2, NULL, NULL),
(66, 11, 'Register', '2015-05-07 10:04:32', 2, NULL, NULL),
(67, 11, 'Acl', '2015-05-07 10:04:32', 2, NULL, NULL),
(68, 12, 'Index', '2015-05-07 10:04:32', 2, NULL, NULL),
(69, 13, 'ListarImagem', '2015-05-07 10:04:32', 2, NULL, NULL),
(70, 13, 'ExcluirImagem', '2015-05-07 10:04:32', 2, NULL, NULL),
(71, 13, 'SalvarImagem', '2015-05-07 10:04:32', 2, NULL, NULL),
(72, 14, 'Create', '2015-05-07 10:04:32', 2, NULL, NULL),
(73, 14, 'Edit', '2015-05-07 10:04:33', 2, NULL, NULL),
(74, 14, 'List', '2015-05-07 10:04:33', 2, NULL, NULL),
(75, 14, 'Delete', '2015-05-07 10:04:33', 2, NULL, NULL),
(76, 14, 'View', '2015-05-07 10:04:33', 2, NULL, NULL),
(77, 15, 'Index', '2015-05-07 10:04:33', 2, NULL, NULL),
(78, 16, 'Create', '2015-05-07 10:04:33', 2, NULL, NULL),
(79, 16, 'Edit', '2015-05-07 10:04:33', 2, NULL, NULL),
(80, 16, 'List', '2015-05-07 10:04:33', 2, NULL, NULL),
(81, 16, 'Delete', '2015-05-07 10:04:33', 2, NULL, NULL),
(82, 16, 'View', '2015-05-07 10:04:33', 2, NULL, NULL),
(83, 17, 'Index', '2015-05-07 10:04:33', 2, NULL, NULL),
(84, 18, 'Create', '2015-05-07 10:04:34', 2, NULL, NULL),
(85, 18, 'Edit', '2015-05-07 10:04:34', 2, NULL, NULL),
(86, 18, 'List', '2015-05-07 10:04:34', 2, NULL, NULL),
(87, 18, 'Delete', '2015-05-07 10:04:34', 2, NULL, NULL),
(88, 18, 'View', '2015-05-07 10:04:34', 2, NULL, NULL),
(89, 19, 'Create', '2015-05-07 10:04:34', 2, NULL, NULL),
(90, 19, 'Edit', '2015-05-07 10:04:34', 2, NULL, NULL),
(91, 19, 'List', '2015-05-07 10:04:34', 2, NULL, NULL),
(92, 19, 'Delete', '2015-05-07 10:04:34', 2, NULL, NULL),
(93, 19, 'View', '2015-05-07 10:04:34', 2, NULL, NULL),
(94, 20, 'Index', '2015-05-07 10:04:35', 2, NULL, NULL),
(95, 21, 'Create', '2015-05-07 10:04:35', 2, NULL, NULL),
(96, 21, 'Edit', '2015-05-07 10:04:35', 2, NULL, NULL),
(97, 21, 'List', '2015-05-07 10:04:35', 2, NULL, NULL),
(98, 21, 'Delete', '2015-05-07 10:04:35', 2, NULL, NULL),
(99, 21, 'View', '2015-05-07 10:04:35', 2, NULL, NULL),
(100, 21, 'UploadImage', '2015-05-07 10:04:35', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `columns`
--

CREATE TABLE IF NOT EXISTS `columns` (
  `id_columns` int(11) NOT NULL AUTO_INCREMENT,
  `column_date` date DEFAULT NULL,
  `column_datetime` datetime DEFAULT NULL,
  `column_time` time DEFAULT NULL,
  `column_int` int(11) DEFAULT NULL,
  `column_tinyint` tinyint(4) DEFAULT NULL,
  `column_decimal` decimal(10,2) DEFAULT NULL,
  `column_varchar` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `column_longtext` longtext CHARACTER SET utf8,
  `column_text` text CHARACTER SET utf8,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  `column_datetime_pt_br` datetime DEFAULT NULL,
  `column_date_pt_br` date DEFAULT NULL,
  `column_decimal_pt_br` decimal(10,2) DEFAULT NULL,
  `column_int_checkbox` int(11) DEFAULT NULL,
  `column_tinyint_checkbox` tinyint(4) DEFAULT NULL,
  `column_varchar_email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `column_varchar_password_verify` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `column_varchar_unique_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `column_varchar_upload_image` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `column_foreign_key` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_columns`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `fk_columns_1` (`column_foreign_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `columns_image`
--

CREATE TABLE IF NOT EXISTS `columns_image` (
  `id_columns_image` int(11) NOT NULL AUTO_INCREMENT,
  `upload_image_one` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `upload_image_two` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `upload_image_three` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_columns_image`),
  KEY `fk_columns_image_1` (`created_by`),
  KEY `fk_columns_image_2` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `columns_image`
--

INSERT INTO `columns_image` (`id_columns_image`, `upload_image_one`, `upload_image_two`, `upload_image_three`, `created_by`, `updated_by`, `created`, `updated`) VALUES
(1, '/upload/columns-image-uploadImageOne/%s01uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s01uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s01uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(2, '/upload/columns-image-uploadImageOne/%s02uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s02uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s02uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(3, '/upload/columns-image-uploadImageOne/%s03uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s03uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s03uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(4, '/upload/columns-image-uploadImageOne/%s04uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s04uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s04uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(5, '/upload/columns-image-uploadImageOne/%s05uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s05uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s05uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(6, '/upload/columns-image-uploadImageOne/%s06uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s06uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s06uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(7, '/upload/columns-image-uploadImageOne/%s07uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s07uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s07uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(8, '/upload/columns-image-uploadImageOne/%s08uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s08uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s08uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(9, '/upload/columns-image-uploadImageOne/%s09uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s09uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s09uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(10, '/upload/columns-image-uploadImageOne/%s10uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s10uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s10uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(11, '/upload/columns-image-uploadImageOne/%s11uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s11uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s11uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(12, '/upload/columns-image-uploadImageOne/%s12uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s12uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s12uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(13, '/upload/columns-image-uploadImageOne/%s13uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s13uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s13uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(14, '/upload/columns-image-uploadImageOne/%s14uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s14uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s14uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(15, '/upload/columns-image-uploadImageOne/%s15uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s15uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s15uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(16, '/upload/columns-image-uploadImageOne/%s16uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s16uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s16uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(17, '/upload/columns-image-uploadImageOne/%s17uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s17uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s17uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:27', NULL),
(18, '/upload/columns-image-uploadImageOne/%s18uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s18uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s18uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL),
(19, '/upload/columns-image-uploadImageOne/%s19uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s19uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s19uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL),
(20, '/upload/columns-image-uploadImageOne/%s20uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s20uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s20uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL),
(21, '/upload/columns-image-uploadImageOne/%s21uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s21uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s21uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL),
(22, '/upload/columns-image-uploadImageOne/%s22uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s22uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s22uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL),
(23, '/upload/columns-image-uploadImageOne/%s23uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s23uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s23uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL),
(24, '/upload/columns-image-uploadImageOne/%s24uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s24uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s24uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL),
(25, '/upload/columns-image-uploadImageOne/%s25uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s25uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s25uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL),
(26, '/upload/columns-image-uploadImageOne/%s26uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s26uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s26uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL),
(27, '/upload/columns-image-uploadImageOne/%s27uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s27uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s27uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL),
(28, '/upload/columns-image-uploadImageOne/%s28uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s28uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s28uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL),
(29, '/upload/columns-image-uploadImageOne/%s29uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s29uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s29uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL),
(30, '/upload/columns-image-uploadImageOne/%s30uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s30uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s30uploadImageThree.gif', 2, NULL, '2015-05-07 10:04:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `columns_not_null`
--

CREATE TABLE IF NOT EXISTS `columns_not_null` (
  `id_columns_not_null` int(11) NOT NULL AUTO_INCREMENT,
  `column_date_not_null` date NOT NULL,
  `column_datetime_not_null` datetime NOT NULL,
  `column_time_not_null` time NOT NULL,
  `column_int_not_null` int(11) NOT NULL,
  `column_tinyint_not_null` tinyint(4) NOT NULL,
  `column_decimal_not_null` decimal(10,2) NOT NULL,
  `column_varchar_not_null` varchar(100) CHARACTER SET utf8 NOT NULL,
  `column_longtext_not_null` longtext CHARACTER SET utf8 NOT NULL,
  `column_text_not_null` text CHARACTER SET utf8,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  `column_datetime_pt_br_not_null` datetime NOT NULL,
  `column_date_pt_br_not_null` date NOT NULL,
  `column_decimal_pt_br_not_null` decimal(10,2) NOT NULL,
  `column_int_checkbox_not_null` int(11) NOT NULL,
  `column_tinyint_checkbox_not_null` tinyint(4) NOT NULL,
  `column_varchar_email_not_null` varchar(100) CHARACTER SET utf8 NOT NULL,
  `column_varchar_password_verify_not_null` varchar(100) CHARACTER SET utf8 NOT NULL,
  `column_varchar_unique_id_not_null` varchar(100) CHARACTER SET utf8 NOT NULL,
  `column_varchar_upload_image_not_null` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `column_foreign_key_not_null` int(11) NOT NULL,
  PRIMARY KEY (`id_columns_not_null`),
  KEY `columns_not_null_ibfk_1` (`created_by`),
  KEY `columns_not_null_ibfk_2` (`updated_by`),
  KEY `fk_columns_not_null_1` (`column_foreign_key_not_null`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `columns_not_null`
--

INSERT INTO `columns_not_null` (`id_columns_not_null`, `column_date_not_null`, `column_datetime_not_null`, `column_time_not_null`, `column_int_not_null`, `column_tinyint_not_null`, `column_decimal_not_null`, `column_varchar_not_null`, `column_longtext_not_null`, `column_text_not_null`, `created`, `updated`, `created_by`, `updated_by`, `column_datetime_pt_br_not_null`, `column_date_pt_br_not_null`, `column_decimal_pt_br_not_null`, `column_int_checkbox_not_null`, `column_tinyint_checkbox_not_null`, `column_varchar_email_not_null`, `column_varchar_password_verify_not_null`, `column_varchar_unique_id_not_null`, `column_varchar_upload_image_not_null`, `column_foreign_key_not_null`) VALUES
(1, '2020-12-01', '2020-12-01 01:00:02', '01:00:02', 1, 1, 1.10, '01Column Varchar Not Null', '01Column Longtext Not Null', '01Column Text Not Null', '2015-05-07 10:04:28', NULL, 2, NULL, '2020-12-01 01:00:02', '2020-12-01', 1.10, 1, 1, 'column.varchar.email.not.null01@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c262221292.09063897', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s01columnVarcharUploadImageNotNull.gif', 1),
(2, '2020-12-02', '2020-12-02 02:00:02', '02:00:02', 2, 2, 2.20, '02Column Varchar Not Null', '02Column Longtext Not Null', '02Column Text Not Null', '2015-05-07 10:04:29', NULL, 2, NULL, '2020-12-02 02:00:02', '2020-12-02', 2.20, 0, 0, 'column.varchar.email.not.null02@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c26222ad99.22926902', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s02columnVarcharUploadImageNotNull.gif', 2),
(3, '2020-12-03', '2020-12-03 03:00:02', '03:00:02', 3, 3, 3.30, '03Column Varchar Not Null', '03Column Longtext Not Null', '03Column Text Not Null', '2015-05-07 10:04:29', NULL, 2, NULL, '2020-12-03 03:00:02', '2020-12-03', 3.30, 1, 1, 'column.varchar.email.not.null03@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c262234071.15814835', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s03columnVarcharUploadImageNotNull.gif', 3),
(4, '2020-12-04', '2020-12-04 04:00:02', '04:00:02', 4, 4, 4.40, '04Column Varchar Not Null', '04Column Longtext Not Null', '04Column Text Not Null', '2015-05-07 10:04:29', NULL, 2, NULL, '2020-12-04 04:00:02', '2020-12-04', 4.40, 0, 0, 'column.varchar.email.not.null04@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c26223de74.70215813', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s04columnVarcharUploadImageNotNull.gif', 4),
(5, '2020-12-05', '2020-12-05 05:00:02', '05:00:02', 5, 5, 5.50, '05Column Varchar Not Null', '05Column Longtext Not Null', '05Column Text Not Null', '2015-05-07 10:04:29', NULL, 2, NULL, '2020-12-05 05:00:02', '2020-12-05', 5.50, 1, 1, 'column.varchar.email.not.null05@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c262247c09.74045850', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s05columnVarcharUploadImageNotNull.gif', 5),
(6, '2020-12-06', '2020-12-06 06:00:02', '06:00:02', 6, 6, 6.60, '06Column Varchar Not Null', '06Column Longtext Not Null', '06Column Text Not Null', '2015-05-07 10:04:29', NULL, 3, NULL, '2020-12-06 06:00:02', '2020-12-06', 6.60, 0, 0, 'column.varchar.email.not.null06@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c262251018.68979789', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s06columnVarcharUploadImageNotNull.gif', 6),
(7, '2020-12-07', '2020-12-07 07:00:02', '07:00:02', 7, 7, 7.70, '07Column Varchar Not Null', '07Column Longtext Not Null', '07Column Text Not Null', '2015-05-07 10:04:29', NULL, 3, NULL, '2020-12-07 07:00:02', '2020-12-07', 7.70, 1, 1, 'column.varchar.email.not.null07@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c26225a3d4.70867135', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s07columnVarcharUploadImageNotNull.gif', 7),
(8, '2020-12-08', '2020-12-08 08:00:02', '08:00:02', 8, 8, 8.80, '08Column Varchar Not Null', '08Column Longtext Not Null', '08Column Text Not Null', '2015-05-07 10:04:29', NULL, 3, NULL, '2020-12-08 08:00:02', '2020-12-08', 8.80, 0, 0, 'column.varchar.email.not.null08@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c262263dc7.67275536', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s08columnVarcharUploadImageNotNull.gif', 8),
(9, '2020-12-09', '2020-12-09 09:00:02', '09:00:02', 9, 9, 9.90, '09Column Varchar Not Null', '09Column Longtext Not Null', '09Column Text Not Null', '2015-05-07 10:04:29', NULL, 3, NULL, '2020-12-09 09:00:02', '2020-12-09', 9.90, 1, 1, 'column.varchar.email.not.null09@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c26226fa27.26869073', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s09columnVarcharUploadImageNotNull.gif', 9),
(10, '2020-12-10', '2020-12-10 10:00:02', '10:00:02', 10, 10, 10.10, '10Column Varchar Not Null', '10Column Longtext Not Null', '10Column Text Not Null', '2015-05-07 10:04:29', NULL, 3, NULL, '2020-12-10 10:00:02', '2020-12-10', 10.10, 0, 0, 'column.varchar.email.not.null10@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c262279746.89724220', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s10columnVarcharUploadImageNotNull.gif', 10),
(11, '2020-12-11', '2020-12-11 11:00:02', '11:00:02', 11, 11, 11.11, '11Column Varchar Not Null', '11Column Longtext Not Null', '11Column Text Not Null', '2015-05-07 10:04:29', NULL, 4, NULL, '2020-12-11 11:00:02', '2020-12-11', 11.11, 1, 1, 'column.varchar.email.not.null11@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c262282b84.80147138', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s11columnVarcharUploadImageNotNull.gif', 11),
(12, '2020-12-12', '2020-12-12 12:00:02', '12:00:02', 12, 12, 12.12, '12Column Varchar Not Null', '12Column Longtext Not Null', '12Column Text Not Null', '2015-05-07 10:04:29', NULL, 4, NULL, '2020-12-12 12:00:02', '2020-12-12', 12.12, 0, 0, 'column.varchar.email.not.null12@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c26228c004.07901943', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s12columnVarcharUploadImageNotNull.gif', 12),
(13, '2020-12-13', '2020-12-13 13:00:02', '13:00:02', 13, 13, 13.13, '13Column Varchar Not Null', '13Column Longtext Not Null', '13Column Text Not Null', '2015-05-07 10:04:29', NULL, 4, NULL, '2020-12-13 13:00:02', '2020-12-13', 13.13, 1, 1, 'column.varchar.email.not.null13@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c262295214.13800072', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s13columnVarcharUploadImageNotNull.gif', 13),
(14, '2020-12-14', '2020-12-14 14:00:02', '14:00:02', 14, 14, 14.14, '14Column Varchar Not Null', '14Column Longtext Not Null', '14Column Text Not Null', '2015-05-07 10:04:29', NULL, 4, NULL, '2020-12-14 14:00:02', '2020-12-14', 14.14, 0, 0, 'column.varchar.email.not.null14@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c26229f0c5.57049278', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s14columnVarcharUploadImageNotNull.gif', 14),
(15, '2020-12-15', '2020-12-15 15:00:02', '15:00:02', 15, 15, 15.15, '15Column Varchar Not Null', '15Column Longtext Not Null', '15Column Text Not Null', '2015-05-07 10:04:29', NULL, 4, NULL, '2020-12-15 15:00:02', '2020-12-15', 15.15, 1, 1, 'column.varchar.email.not.null15@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c2622aa3e8.27812252', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s15columnVarcharUploadImageNotNull.gif', 15),
(16, '2020-12-16', '2020-12-16 16:00:02', '16:00:02', 16, 16, 16.16, '16Column Varchar Not Null', '16Column Longtext Not Null', '16Column Text Not Null', '2015-05-07 10:04:29', NULL, 5, NULL, '2020-12-16 16:00:02', '2020-12-16', 16.16, 0, 0, 'column.varchar.email.not.null16@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c2622b6578.15660696', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s16columnVarcharUploadImageNotNull.gif', 16),
(17, '2020-12-17', '2020-12-17 17:00:02', '17:00:02', 17, 17, 17.17, '17Column Varchar Not Null', '17Column Longtext Not Null', '17Column Text Not Null', '2015-05-07 10:04:29', NULL, 5, NULL, '2020-12-17 17:00:02', '2020-12-17', 17.17, 1, 1, 'column.varchar.email.not.null17@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c2622bfc38.26604002', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s17columnVarcharUploadImageNotNull.gif', 17),
(18, '2020-12-18', '2020-12-18 18:00:02', '18:00:02', 18, 18, 18.18, '18Column Varchar Not Null', '18Column Longtext Not Null', '18Column Text Not Null', '2015-05-07 10:04:29', NULL, 5, NULL, '2020-12-18 18:00:02', '2020-12-18', 18.18, 0, 0, 'column.varchar.email.not.null18@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c2622cd134.69669644', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s18columnVarcharUploadImageNotNull.gif', 18),
(19, '2020-12-19', '2020-12-19 19:00:02', '19:00:02', 19, 19, 19.19, '19Column Varchar Not Null', '19Column Longtext Not Null', '19Column Text Not Null', '2015-05-07 10:04:29', NULL, 5, NULL, '2020-12-19 19:00:02', '2020-12-19', 19.19, 1, 1, 'column.varchar.email.not.null19@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c2622d9d51.12614221', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s19columnVarcharUploadImageNotNull.gif', 19),
(20, '2020-12-20', '2020-12-20 20:00:02', '20:00:02', 20, 20, 20.20, '20Column Varchar Not Null', '20Column Longtext Not Null', '20Column Text Not Null', '2015-05-07 10:04:29', NULL, 5, NULL, '2020-12-20 20:00:02', '2020-12-20', 20.20, 0, 0, 'column.varchar.email.not.null20@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c2622e69d6.21025182', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s20columnVarcharUploadImageNotNull.gif', 20),
(21, '2020-12-21', '2020-12-21 21:00:02', '21:00:02', 21, 21, 21.21, '21Column Varchar Not Null', '21Column Longtext Not Null', '21Column Text Not Null', '2015-05-07 10:04:29', NULL, 6, NULL, '2020-12-21 21:00:02', '2020-12-21', 21.21, 1, 1, 'column.varchar.email.not.null21@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c2622f09b3.68672229', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s21columnVarcharUploadImageNotNull.gif', 21),
(22, '2020-12-22', '2020-12-22 22:00:02', '22:00:02', 22, 22, 22.22, '22Column Varchar Not Null', '22Column Longtext Not Null', '22Column Text Not Null', '2015-05-07 10:04:29', NULL, 6, NULL, '2020-12-22 22:00:02', '2020-12-22', 22.22, 0, 0, 'column.varchar.email.not.null22@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c2622fa535.80010296', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s22columnVarcharUploadImageNotNull.gif', 22),
(23, '2020-12-23', '2020-12-23 23:00:02', '23:00:02', 23, 23, 23.23, '23Column Varchar Not Null', '23Column Longtext Not Null', '23Column Text Not Null', '2015-05-07 10:04:29', NULL, 6, NULL, '2020-12-23 23:00:02', '2020-12-23', 23.23, 1, 1, 'column.varchar.email.not.null23@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c2623037f5.23057205', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s23columnVarcharUploadImageNotNull.gif', 23),
(24, '2020-12-24', '2020-12-24 06:00:02', '06:00:02', 24, 24, 24.24, '24Column Varchar Not Null', '24Column Longtext Not Null', '24Column Text Not Null', '2015-05-07 10:04:29', NULL, 6, NULL, '2020-12-24 06:00:02', '2020-12-24', 24.24, 0, 0, 'column.varchar.email.not.null24@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c26230cf47.93021310', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s24columnVarcharUploadImageNotNull.gif', 24),
(25, '2020-12-25', '2020-12-25 05:00:02', '05:00:02', 25, 25, 25.25, '25Column Varchar Not Null', '25Column Longtext Not Null', '25Column Text Not Null', '2015-05-07 10:04:29', NULL, 6, NULL, '2020-12-25 05:00:02', '2020-12-25', 25.25, 1, 1, 'column.varchar.email.not.null25@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c2623165e0.84649803', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s25columnVarcharUploadImageNotNull.gif', 25),
(26, '2020-12-26', '2020-12-26 04:00:02', '04:00:02', 26, 26, 26.26, '26Column Varchar Not Null', '26Column Longtext Not Null', '26Column Text Not Null', '2015-05-07 10:04:29', NULL, 7, NULL, '2020-12-26 04:00:02', '2020-12-26', 26.26, 0, 0, 'column.varchar.email.not.null26@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c26231f971.37353392', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s26columnVarcharUploadImageNotNull.gif', 26),
(27, '2020-12-27', '2020-12-27 03:00:02', '03:00:02', 27, 27, 27.27, '27Column Varchar Not Null', '27Column Longtext Not Null', '27Column Text Not Null', '2015-05-07 10:04:29', NULL, 7, NULL, '2020-12-27 03:00:02', '2020-12-27', 27.27, 1, 1, 'column.varchar.email.not.null27@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c26232a766.71647070', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s27columnVarcharUploadImageNotNull.gif', 27),
(28, '2020-12-28', '2020-12-28 02:00:02', '02:00:02', 28, 28, 28.28, '28Column Varchar Not Null', '28Column Longtext Not Null', '28Column Text Not Null', '2015-05-07 10:04:29', NULL, 7, NULL, '2020-12-28 02:00:02', '2020-12-28', 28.28, 0, 0, 'column.varchar.email.not.null28@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c2623342f4.67056236', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s28columnVarcharUploadImageNotNull.gif', 28),
(29, '2020-12-29', '2020-12-29 01:00:02', '01:00:02', 29, 29, 29.29, '29Column Varchar Not Null', '29Column Longtext Not Null', '29Column Text Not Null', '2015-05-07 10:04:29', NULL, 7, NULL, '2020-12-29 01:00:02', '2020-12-29', 29.29, 1, 1, 'column.varchar.email.not.null29@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c26233d8a0.45645352', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s29columnVarcharUploadImageNotNull.gif', 29),
(30, '2020-12-30', '2020-12-30 00:00:02', '00:00:02', 30, 30, 30.30, '30Column Varchar Not Null', '30Column Longtext Not Null', '30Column Text Not Null', '2015-05-07 10:04:29', NULL, 7, NULL, '2020-12-30 00:00:02', '2020-12-30', 30.30, 0, 0, 'column.varchar.email.not.null30@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '15548c262346fa8.06127878', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s30columnVarcharUploadImageNotNull.gif', 30);

-- --------------------------------------------------------

--
-- Table structure for table `columns_standard`
--

CREATE TABLE IF NOT EXISTS `columns_standard` (
  `id_columns_standard` int(11) NOT NULL AUTO_INCREMENT,
  `column_date` date DEFAULT NULL,
  `column_datetime` datetime DEFAULT NULL,
  `column_time` time DEFAULT NULL,
  `column_int` int(11) DEFAULT NULL,
  `column_tinyint` tinyint(4) DEFAULT NULL,
  `column_decimal` decimal(10,2) DEFAULT NULL,
  `column_varchar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `column_longtext` longtext COLLATE utf8_unicode_ci,
  `column_foreign_key` int(11) DEFAULT NULL,
  `column_text` text COLLATE utf8_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_columns_standard`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `fk_columns_1` (`column_foreign_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `columns_standard_upload_image`
--

CREATE TABLE IF NOT EXISTS `columns_standard_upload_image` (
  `id_columns_standard_upload_image` int(11) NOT NULL AUTO_INCREMENT,
  `column_varchar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_columns_standard_upload_image`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `controller`
--

CREATE TABLE IF NOT EXISTS `controller` (
  `id_controller` int(11) NOT NULL AUTO_INCREMENT,
  `id_module` int(11) NOT NULL,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `invokable` varchar(150) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_controller`),
  KEY `id_module` (`id_module`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `controller`
--

INSERT INTO `controller` (`id_controller`, `id_module`, `name`, `invokable`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 1, 'Db', 'Gear\\Controller\\Db', '2015-05-07 10:04:29', 2, NULL, NULL),
(2, 1, 'Build', 'Gear\\Controller\\Build', '2015-05-07 10:04:30', 2, NULL, NULL),
(3, 1, 'Constructor', 'Gear\\Controller\\Constructor', '2015-05-07 10:04:30', 2, NULL, NULL),
(4, 1, 'Module', 'Gear\\Controller\\Module', '2015-05-07 10:04:30', 2, NULL, NULL),
(5, 1, 'Project', 'Gear\\Controller\\Project', '2015-05-07 10:04:30', 2, NULL, NULL),
(6, 2, 'ProjectController', 'GearAcl\\Controller\\Project', '2015-05-07 10:04:31', 2, NULL, NULL),
(7, 3, 'VersionController', 'GearVersion\\Controller\\Version', '2015-05-07 10:04:31', 2, NULL, NULL),
(8, 4, 'IndexController', 'GearJson\\Controller\\Index', '2015-05-07 10:04:31', 2, NULL, NULL),
(9, 5, 'IndexController', 'GearBackup\\Controller\\Index', '2015-05-07 10:04:31', 2, NULL, NULL),
(10, 6, 'Index', 'GearAdmin\\Controller\\Index', '2015-05-07 10:04:31', 2, NULL, NULL),
(11, 6, 'User', 'GearAdmin\\Controller\\User', '2015-05-07 10:04:32', 2, NULL, NULL),
(12, 7, 'Index', 'GearImage\\Controller\\Index', '2015-05-07 10:04:32', 2, NULL, NULL),
(13, 7, 'Imagem', 'GearImage\\Controller\\Imagem', '2015-05-07 10:04:32', 2, NULL, NULL),
(14, 7, 'MarcaController', 'GearImage\\Controller\\Marca', '2015-05-07 10:04:32', 2, NULL, NULL),
(15, 8, 'IndexController', 'Column\\Controller\\Index', '2015-05-07 10:04:33', 2, NULL, NULL),
(16, 8, 'ColumnsController', 'Column\\Controller\\Columns', '2015-05-07 10:04:33', 2, NULL, NULL),
(17, 9, 'IndexController', 'ColumnNotNull\\Controller\\Index', '2015-05-07 10:04:33', 2, NULL, NULL),
(18, 9, 'ColumnsNotNullController', 'ColumnNotNull\\Controller\\ColumnsNotNull', '2015-05-07 10:04:34', 2, NULL, NULL),
(19, 9, 'ForeignKeysController', 'ColumnNotNull\\Controller\\ForeignKeys', '2015-05-07 10:04:34', 2, NULL, NULL),
(20, 10, 'IndexController', 'ColumnImage\\Controller\\Index', '2015-05-07 10:04:35', 2, NULL, NULL),
(21, 10, 'ColumnsImageController', 'ColumnImage\\Controller\\ColumnsImage', '2015-05-07 10:04:35', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `remetente` varchar(255) CHARACTER SET utf8 NOT NULL,
  `destino` varchar(255) CHARACTER SET utf8 NOT NULL,
  `assunto` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mensagem` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_email`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `foreign_keys`
--

CREATE TABLE IF NOT EXISTS `foreign_keys` (
  `id_foreign_keys` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_foreign_keys`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `foreign_keys`
--

INSERT INTO `foreign_keys` (`id_foreign_keys`, `name`, `created`, `updated`, `created_by`, `updated_by`) VALUES
(1, '01Name', '2015-05-07 10:04:27', NULL, 2, NULL),
(2, '02Name', '2015-05-07 10:04:27', NULL, 2, NULL),
(3, '03Name', '2015-05-07 10:04:27', NULL, 2, NULL),
(4, '04Name', '2015-05-07 10:04:27', NULL, 2, NULL),
(5, '05Name', '2015-05-07 10:04:27', NULL, 2, NULL),
(6, '06Name', '2015-05-07 10:04:27', NULL, 3, NULL),
(7, '07Name', '2015-05-07 10:04:27', NULL, 3, NULL),
(8, '08Name', '2015-05-07 10:04:27', NULL, 3, NULL),
(9, '09Name', '2015-05-07 10:04:27', NULL, 3, NULL),
(10, '10Name', '2015-05-07 10:04:27', NULL, 3, NULL),
(11, '11Name', '2015-05-07 10:04:27', NULL, 4, NULL),
(12, '12Name', '2015-05-07 10:04:27', NULL, 4, NULL),
(13, '13Name', '2015-05-07 10:04:27', NULL, 4, NULL),
(14, '14Name', '2015-05-07 10:04:27', NULL, 4, NULL),
(15, '15Name', '2015-05-07 10:04:27', NULL, 4, NULL),
(16, '16Name', '2015-05-07 10:04:27', NULL, 5, NULL),
(17, '17Name', '2015-05-07 10:04:27', NULL, 5, NULL),
(18, '18Name', '2015-05-07 10:04:27', NULL, 5, NULL),
(19, '19Name', '2015-05-07 10:04:27', NULL, 5, NULL),
(20, '20Name', '2015-05-07 10:04:27', NULL, 5, NULL),
(21, '21Name', '2015-05-07 10:04:27', NULL, 6, NULL),
(22, '22Name', '2015-05-07 10:04:27', NULL, 6, NULL),
(23, '23Name', '2015-05-07 10:04:27', NULL, 6, NULL),
(24, '24Name', '2015-05-07 10:04:27', NULL, 6, NULL),
(25, '25Name', '2015-05-07 10:04:27', NULL, 6, NULL),
(26, '26Name', '2015-05-07 10:04:27', NULL, 7, NULL),
(27, '27Name', '2015-05-07 10:04:27', NULL, 7, NULL),
(28, '28Name', '2015-05-07 10:04:27', NULL, 7, NULL),
(29, '29Name', '2015-05-07 10:04:27', NULL, 7, NULL),
(30, '30Name', '2015-05-07 10:04:27', NULL, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_module`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id_module`, `name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 'Gear', '2015-05-07 10:04:29', 2, NULL, NULL),
(2, 'GearAcl', '2015-05-07 10:04:31', 2, NULL, NULL),
(3, 'GearVersion', '2015-05-07 10:04:31', 2, NULL, NULL),
(4, 'GearJson', '2015-05-07 10:04:31', 2, NULL, NULL),
(5, 'GearBackup', '2015-05-07 10:04:31', 2, NULL, NULL),
(6, 'GearAdmin', '2015-05-07 10:04:31', 2, NULL, NULL),
(7, 'GearImage', '2015-05-07 10:04:32', 2, NULL, NULL),
(8, 'Column', '2015-05-07 10:04:33', 2, NULL, NULL),
(9, 'ColumnNotNull', '2015-05-07 10:04:33', 2, NULL, NULL),
(10, 'ColumnImage', '2015-05-07 10:04:34', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `name` (`name`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `id_parent` (`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `id_parent`, `name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, NULL, 'guest', '2015-05-07 10:04:27', 2, NULL, NULL),
(2, 1, 'admin', '2015-05-07 10:04:27', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE IF NOT EXISTS `rule` (
  `id_rule` int(11) NOT NULL AUTO_INCREMENT,
  `id_action` int(11) NOT NULL,
  `id_controller` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rule`),
  KEY `id_action` (`id_action`),
  KEY `id_controller` (`id_controller`),
  KEY `id_role` (`id_role`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=101 ;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id_rule`, `id_action`, `id_controller`, `id_role`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 1, 1, 1, '2015-05-07 10:04:29', 2, NULL, NULL),
(2, 2, 1, 1, '2015-05-07 10:04:29', 2, NULL, NULL),
(3, 3, 1, 1, '2015-05-07 10:04:29', 2, NULL, NULL),
(4, 4, 1, 1, '2015-05-07 10:04:29', 2, NULL, NULL),
(5, 5, 1, 1, '2015-05-07 10:04:29', 2, NULL, NULL),
(6, 6, 1, 1, '2015-05-07 10:04:29', 2, NULL, NULL),
(7, 7, 1, 1, '2015-05-07 10:04:29', 2, NULL, NULL),
(8, 8, 1, 1, '2015-05-07 10:04:29', 2, NULL, NULL),
(9, 9, 1, 1, '2015-05-07 10:04:29', 2, NULL, NULL),
(10, 10, 1, 1, '2015-05-07 10:04:29', 2, NULL, NULL),
(11, 11, 1, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(12, 12, 1, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(13, 13, 1, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(14, 14, 2, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(15, 15, 3, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(16, 16, 3, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(17, 17, 3, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(18, 18, 3, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(19, 19, 3, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(20, 20, 3, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(21, 21, 4, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(22, 22, 4, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(23, 23, 4, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(24, 24, 4, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(25, 25, 4, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(26, 26, 4, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(27, 27, 4, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(28, 28, 4, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(29, 29, 4, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(30, 30, 4, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(31, 31, 4, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(32, 32, 4, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(33, 33, 5, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(34, 34, 5, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(35, 35, 5, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(36, 36, 5, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(37, 37, 5, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(38, 38, 5, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(39, 39, 5, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(40, 40, 5, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(41, 41, 5, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(42, 42, 5, 1, '2015-05-07 10:04:30', 2, NULL, NULL),
(43, 43, 5, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(44, 44, 5, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(45, 45, 5, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(46, 46, 5, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(47, 47, 5, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(48, 48, 5, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(49, 49, 5, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(50, 50, 6, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(51, 51, 6, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(52, 52, 7, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(53, 53, 7, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(54, 54, 8, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(55, 55, 9, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(56, 56, 10, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(57, 57, 10, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(58, 58, 10, 1, '2015-05-07 10:04:31', 2, NULL, NULL),
(59, 59, 10, 1, '2015-05-07 10:04:32', 2, NULL, NULL),
(60, 60, 10, 1, '2015-05-07 10:04:32', 2, NULL, NULL),
(61, 61, 10, 2, '2015-05-07 10:04:32', 2, NULL, NULL),
(62, 62, 10, 2, '2015-05-07 10:04:32', 2, NULL, NULL),
(63, 63, 10, 2, '2015-05-07 10:04:32', 2, NULL, NULL),
(64, 64, 10, 2, '2015-05-07 10:04:32', 2, NULL, NULL),
(65, 65, 10, 1, '2015-05-07 10:04:32', 2, NULL, NULL),
(66, 66, 11, 1, '2015-05-07 10:04:32', 2, NULL, NULL),
(67, 67, 11, 1, '2015-05-07 10:04:32', 2, NULL, NULL),
(68, 68, 12, 1, '2015-05-07 10:04:32', 2, NULL, NULL),
(69, 69, 13, 1, '2015-05-07 10:04:32', 2, NULL, NULL),
(70, 70, 13, 1, '2015-05-07 10:04:32', 2, NULL, NULL),
(71, 71, 13, 1, '2015-05-07 10:04:32', 2, NULL, NULL),
(72, 72, 14, 2, '2015-05-07 10:04:32', 2, NULL, NULL),
(73, 73, 14, 2, '2015-05-07 10:04:33', 2, NULL, NULL),
(74, 74, 14, 2, '2015-05-07 10:04:33', 2, NULL, NULL),
(75, 75, 14, 2, '2015-05-07 10:04:33', 2, NULL, NULL),
(76, 76, 14, 2, '2015-05-07 10:04:33', 2, NULL, NULL),
(77, 77, 15, 1, '2015-05-07 10:04:33', 2, NULL, NULL),
(78, 78, 16, 2, '2015-05-07 10:04:33', 2, NULL, NULL),
(79, 79, 16, 2, '2015-05-07 10:04:33', 2, NULL, NULL),
(80, 80, 16, 2, '2015-05-07 10:04:33', 2, NULL, NULL),
(81, 81, 16, 2, '2015-05-07 10:04:33', 2, NULL, NULL),
(82, 82, 16, 2, '2015-05-07 10:04:33', 2, NULL, NULL),
(83, 83, 17, 1, '2015-05-07 10:04:33', 2, NULL, NULL),
(84, 84, 18, 2, '2015-05-07 10:04:34', 2, NULL, NULL),
(85, 85, 18, 2, '2015-05-07 10:04:34', 2, NULL, NULL),
(86, 86, 18, 2, '2015-05-07 10:04:34', 2, NULL, NULL),
(87, 87, 18, 2, '2015-05-07 10:04:34', 2, NULL, NULL),
(88, 88, 18, 2, '2015-05-07 10:04:34', 2, NULL, NULL),
(89, 89, 19, 2, '2015-05-07 10:04:34', 2, NULL, NULL),
(90, 90, 19, 2, '2015-05-07 10:04:34', 2, NULL, NULL),
(91, 91, 19, 2, '2015-05-07 10:04:34', 2, NULL, NULL),
(92, 92, 19, 2, '2015-05-07 10:04:34', 2, NULL, NULL),
(93, 93, 19, 2, '2015-05-07 10:04:34', 2, NULL, NULL),
(94, 94, 20, 1, '2015-05-07 10:04:35', 2, NULL, NULL),
(95, 95, 21, 2, '2015-05-07 10:04:35', 2, NULL, NULL),
(96, 96, 21, 2, '2015-05-07 10:04:35', 2, NULL, NULL),
(97, 97, 21, 2, '2015-05-07 10:04:35', 2, NULL, NULL),
(98, 98, 21, 2, '2015-05-07 10:04:35', 2, NULL, NULL),
(99, 99, 21, 2, '2015-05-07 10:04:35', 2, NULL, NULL),
(100, 100, 21, 2, '2015-05-07 10:04:35', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_upload_image`
--

CREATE TABLE IF NOT EXISTS `test_upload_image` (
  `id_test_upload_image` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_test_upload_image`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `upload_image`
--

CREATE TABLE IF NOT EXISTS `upload_image` (
  `id_upload_image` int(11) NOT NULL AUTO_INCREMENT,
  `upload_image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ordination` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `id_columns_image` int(11) DEFAULT NULL,
  `id_columns_standard_upload_image` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_upload_image`),
  UNIQUE KEY `upload_image` (`upload_image`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `fk_upload_image_1` (`id_columns_image`),
  KEY `fk_upload_image_2` (`id_columns_standard_upload_image`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=91 ;

--
-- Dumping data for table `upload_image`
--

INSERT INTO `upload_image` (`id_upload_image`, `upload_image`, `ordination`, `created`, `created_by`, `updated`, `updated_by`, `id_columns_image`, `id_columns_standard_upload_image`) VALUES
(1, '/upload/columns-image/%spwacvtf5lmf495jovj9k.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 1, NULL),
(2, '/upload/columns-image/%sfzmm3dcv0iog4oip8olk.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 1, NULL),
(3, '/upload/columns-image/%s0rf0moe8xei33vfxzhjp.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 1, NULL),
(4, '/upload/columns-image/%sqxvkc40ajclatq06444s.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 2, NULL),
(5, '/upload/columns-image/%s8dl2zqpoyz4fmqpplgpu.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 2, NULL),
(6, '/upload/columns-image/%si1u1hkycftuex66mnm1b.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 2, NULL),
(7, '/upload/columns-image/%sbvgocw3n2j8bat3i4rk9.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 3, NULL),
(8, '/upload/columns-image/%sa4dx0aaen1fpnm3q9x42.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 3, NULL),
(9, '/upload/columns-image/%s7238lwgfeqfelj2cj3gx.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 3, NULL),
(10, '/upload/columns-image/%svmc9z6pyujrrbkpn7wsb.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 4, NULL),
(11, '/upload/columns-image/%sdygo79rg2y4oa6n022om.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 4, NULL),
(12, '/upload/columns-image/%sc64ehkre6ag9ynovm52f.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 4, NULL),
(13, '/upload/columns-image/%suwtut6klzzy1ws533n8z.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 5, NULL),
(14, '/upload/columns-image/%soezcrdy49r9tetexqp9f.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 5, NULL),
(15, '/upload/columns-image/%sey70g3uagszuwpxesm8s.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 5, NULL),
(16, '/upload/columns-image/%s38c8rgv7vvd0jarq3bqa.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 6, NULL),
(17, '/upload/columns-image/%stfvgvikdujwohymz58wr.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 6, NULL),
(18, '/upload/columns-image/%st0i20ziu1zuk5frqo1u8.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 6, NULL),
(19, '/upload/columns-image/%sbgni5071yuiikqabgjv7.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 7, NULL),
(20, '/upload/columns-image/%s9fi4lzkzr4ysbb161zxq.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 7, NULL),
(21, '/upload/columns-image/%sk6yvnzwt9ir8oz2zpdo6.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 7, NULL),
(22, '/upload/columns-image/%s7dp8eg566tngpb130om0.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 8, NULL),
(23, '/upload/columns-image/%sw4yauqz9ue6rhmqmtljp.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 8, NULL),
(24, '/upload/columns-image/%s5wwkxodo2qeol3p5ke54.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 8, NULL),
(25, '/upload/columns-image/%sj2lre24xedd9zzjndn26.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 9, NULL),
(26, '/upload/columns-image/%s47kf0zaa464eygv38pqc.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 9, NULL),
(27, '/upload/columns-image/%ssubiklwozoktlvzbk0cf.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 9, NULL),
(28, '/upload/columns-image/%sw6jlc5ebkvd3ffcpry3h.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 10, NULL),
(29, '/upload/columns-image/%scd1oyqq9gsf2oodrjisu.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 10, NULL),
(30, '/upload/columns-image/%s3wn82qokeirhmivayba4.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 10, NULL),
(31, '/upload/columns-image/%sufx8u1q498p2u31njgxn.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 11, NULL),
(32, '/upload/columns-image/%soeu0mg1ai2528t1skhnk.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 11, NULL),
(33, '/upload/columns-image/%sf2d0w5d5b0ip53gha7ii.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 11, NULL),
(34, '/upload/columns-image/%szebxx2g89ujfnm69ia4j.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 12, NULL),
(35, '/upload/columns-image/%s1dzw75373cgtghh4an2a.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 12, NULL),
(36, '/upload/columns-image/%s8cgloclwcg63kwqhrjfl.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 12, NULL),
(37, '/upload/columns-image/%slm4submupfuoh00w3bj6.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 13, NULL),
(38, '/upload/columns-image/%shg0s2g0jq6v1ipk2rxn7.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 13, NULL),
(39, '/upload/columns-image/%s27laybxsc6okce25lte1.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 13, NULL),
(40, '/upload/columns-image/%sp0txf3qxr3uk15kq6889.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 14, NULL),
(41, '/upload/columns-image/%s5nj8sc33v7ubyez38fqp.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 14, NULL),
(42, '/upload/columns-image/%s9az16ai28g13ub1ceu50.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 14, NULL),
(43, '/upload/columns-image/%ssq1gvqatwr8wsynoyvhx.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 15, NULL),
(44, '/upload/columns-image/%s28qmaipf3l5m1xsmet60.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 15, NULL),
(45, '/upload/columns-image/%sb5mtt07hmf5eemreu6jo.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 15, NULL),
(46, '/upload/columns-image/%shf092jm72ix4danx0l4c.gif', 0, '2015-05-07 10:04:27', 2, NULL, NULL, 16, NULL),
(47, '/upload/columns-image/%sq0huczzxw9b3f138ag53.gif', 1, '2015-05-07 10:04:27', 2, NULL, NULL, 16, NULL),
(48, '/upload/columns-image/%sosxstbfjmam30uo3jdq5.gif', 2, '2015-05-07 10:04:27', 2, NULL, NULL, 16, NULL),
(49, '/upload/columns-image/%sdrzijtgkzbeeu2wd32ng.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 17, NULL),
(50, '/upload/columns-image/%s3zaukonts3pvlf4uya4n.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 17, NULL),
(51, '/upload/columns-image/%sc8sw0e0u7d0030ldfyxx.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 17, NULL),
(52, '/upload/columns-image/%ssdj3ido7dilgh3278tr5.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 18, NULL),
(53, '/upload/columns-image/%swiwp97tewg2ejb8remph.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 18, NULL),
(54, '/upload/columns-image/%sv0o2tg0rzinmq92q7lut.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 18, NULL),
(55, '/upload/columns-image/%srmy1nwis9y0uoen7ldpb.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 19, NULL),
(56, '/upload/columns-image/%sl2n21fizr3i8g70tu9ct.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 19, NULL),
(57, '/upload/columns-image/%sx2eb6r9hvoi7gwz818xj.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 19, NULL),
(58, '/upload/columns-image/%s16i738ro7t7ulcvhuupg.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 20, NULL),
(59, '/upload/columns-image/%s9xdfj2eb01ksyspsq66o.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 20, NULL),
(60, '/upload/columns-image/%sq4816u9rfpxed0jmtooj.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 20, NULL),
(61, '/upload/columns-image/%sfz14ihmzdiduccl9wlq1.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 21, NULL),
(62, '/upload/columns-image/%s0e534fgntvxzkpttw6i0.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 21, NULL),
(63, '/upload/columns-image/%semkhowga7x2y1xrw3yan.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 21, NULL),
(64, '/upload/columns-image/%sjxcucwdzsmpwy04dmbek.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 22, NULL),
(65, '/upload/columns-image/%sy68quqdnfd1o0393pdt7.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 22, NULL),
(66, '/upload/columns-image/%sq9ufzoicpmmeilv31yh7.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 22, NULL),
(67, '/upload/columns-image/%s18ms1lmhp5f540atfivv.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 23, NULL),
(68, '/upload/columns-image/%sv8z4jkxb94802kjtwv1b.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 23, NULL),
(69, '/upload/columns-image/%sq66kw731gpm1ncvxniym.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 23, NULL),
(70, '/upload/columns-image/%sdxd57mpt7gvncsyzpsrv.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 24, NULL),
(71, '/upload/columns-image/%s73nl689jhxwkkzgibv29.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 24, NULL),
(72, '/upload/columns-image/%s1nm45btlta7q4k20j19r.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 24, NULL),
(73, '/upload/columns-image/%spv20l89nt1mkfzea0xmj.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 25, NULL),
(74, '/upload/columns-image/%syj0susi3kikz3cqebpsu.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 25, NULL),
(75, '/upload/columns-image/%sg44lt9mkxztl8j3s2bmd.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 25, NULL),
(76, '/upload/columns-image/%skw2dzji1y0l5vghfftp2.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 26, NULL),
(77, '/upload/columns-image/%si8ehi7zb9bejy7nogwf5.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 26, NULL),
(78, '/upload/columns-image/%snr08x7d2rsv0rz70xx1x.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 26, NULL),
(79, '/upload/columns-image/%sz67n3k2a785kpvjctm5a.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 27, NULL),
(80, '/upload/columns-image/%s5r0ngxd4k5r91onuzfuw.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 27, NULL),
(81, '/upload/columns-image/%sep7tbgvutruo8l2f859j.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 27, NULL),
(82, '/upload/columns-image/%s0rir6wcv2xi6dfpembz5.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 28, NULL),
(83, '/upload/columns-image/%stkkrvcwt8w2ydbg9yjuq.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 28, NULL),
(84, '/upload/columns-image/%s63n982el43gndq5ytrir.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 28, NULL),
(85, '/upload/columns-image/%sdbghdng1w1hsuurtnw4i.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 29, NULL),
(86, '/upload/columns-image/%spawsrrha9psdrykubrly.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 29, NULL),
(87, '/upload/columns-image/%sisg3dymrkhz0iljz3q02.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 29, NULL),
(88, '/upload/columns-image/%s6j6n8g79yiy614z5tcm4.gif', 0, '2015-05-07 10:04:28', 2, NULL, NULL, 30, NULL),
(89, '/upload/columns-image/%sjcuro3hhk8agh6ufdrf1.gif', 1, '2015-05-07 10:04:28', 2, NULL, NULL, 30, NULL),
(90, '/upload/columns-image/%s03yryoniqzc02xigrpo1.gif', 2, '2015-05-07 10:04:28', 2, NULL, NULL, 30, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(150) CHARACTER SET utf8 NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `state` int(11) NOT NULL,
  `uid` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `id_role` (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `username`, `state`, `uid`, `created`, `updated`, `created_by`, `updated_by`, `id_role`) VALUES
(1, 'gear@pibernetwork.com', '$2y$14$VHXAD2DCVrll0i1B/BSft.Ea1dY16mbUvrDLuXAwoJXfIqbEVZel.', '', 1, '1554b62d373ca23.06235270', '2015-05-07 10:04:19', '2015-05-07 10:04:19', 1, 1, NULL),
(2, 'usuariogear1@gmail.com', '$2y$14$zWTh6dZpsawyk0QAspU1qOofn31nAWwAhTUu7E.h17qZYG8v382SS', '', 1, '1554b62d4b76d75.79874902', '2015-05-07 10:04:20', '2015-05-07 10:04:20', 2, 2, 2),
(3, 'usuariogear2@gmail.com', '$2y$14$2JWvpfwdBBz7HRHqV0Y/uukUaOga7NuGpdJaclKeVEuma5Fx8xlH2', '', 1, '1554b62d60b19d0.64545908', '2015-05-07 10:04:22', '2015-05-07 10:04:22', 3, 3, 2),
(4, 'usuariogear3@gmail.com', '$2y$14$pL20s04Q6R33DJaH73gri.EkfzqcjXtU7/Ivy44uYLSzdyeqcvWzW', '', 1, '1554b62d7515e76.81164578', '2015-05-07 10:04:23', '2015-05-07 10:04:23', 4, 4, 2),
(5, 'usuariogear4@gmail.com', '$2y$14$qXSqnPImbfaJTsFwRELkiO5hG52vEYUKvdk8.Qzt7MuZDpCBBBsau', '', 1, '1554b62d896d565.96672078', '2015-05-07 10:04:24', '2015-05-07 10:04:24', 5, 5, 2),
(6, 'usuariogear5@gmail.com', '$2y$14$5t2LL1mYO3I8ezs1h.r1VOW5aitU5Ghm8tBeRyQvHLoxd4q3blJKa', '', 1, '1554b62d9e5acd8.28563501', '2015-05-07 10:04:25', '2015-05-07 10:04:25', 6, 6, 2),
(7, 'usuariogear6@gmail.com', '$2y$14$DLC/dZMjoFevfCZsaXI5d.dW/HD49OlbLWscs.KtsGBK0Fs1uXGAO', '', 1, '1554b62db37cdf5.06029781', '2015-05-07 10:04:27', '2015-05-07 10:04:27', 7, 7, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `action_ibfk_1` FOREIGN KEY (`id_controller`) REFERENCES `controller` (`id_controller`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `action_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `action_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `columns`
--
ALTER TABLE `columns`
  ADD CONSTRAINT `columns_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `columns_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_columns_1` FOREIGN KEY (`column_foreign_key`) REFERENCES `foreign_keys` (`id_foreign_keys`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `columns_image`
--
ALTER TABLE `columns_image`
  ADD CONSTRAINT `fk_columns_image_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_columns_image_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `columns_not_null`
--
ALTER TABLE `columns_not_null`
  ADD CONSTRAINT `columns_not_null_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `columns_not_null_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_columns_not_null_1` FOREIGN KEY (`column_foreign_key_not_null`) REFERENCES `foreign_keys` (`id_foreign_keys`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `columns_standard`
--
ALTER TABLE `columns_standard`
  ADD CONSTRAINT `columns_ibfk_10` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `columns_ibfk_20` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_columns_10` FOREIGN KEY (`column_foreign_key`) REFERENCES `foreign_keys` (`id_foreign_keys`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `columns_standard_upload_image`
--
ALTER TABLE `columns_standard_upload_image`
  ADD CONSTRAINT `columns_ibfk_100` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `columns_ibfk_200` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `controller`
--
ALTER TABLE `controller`
  ADD CONSTRAINT `controller_ibfk_1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `controller_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `controller_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `email_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foreign_keys`
--
ALTER TABLE `foreign_keys`
  ADD CONSTRAINT `foreign_keys_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_keys_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_ibfk_3` FOREIGN KEY (`id_parent`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rule`
--
ALTER TABLE `rule`
  ADD CONSTRAINT `rule_ibfk_1` FOREIGN KEY (`id_action`) REFERENCES `action` (`id_action`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rule_ibfk_2` FOREIGN KEY (`id_controller`) REFERENCES `controller` (`id_controller`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rule_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rule_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rule_ibfk_5` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_upload_image`
--
ALTER TABLE `test_upload_image`
  ADD CONSTRAINT `test_upload_image_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test_upload_image_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `upload_image`
--
ALTER TABLE `upload_image`
  ADD CONSTRAINT `fk_upload_image_2` FOREIGN KEY (`id_columns_standard_upload_image`) REFERENCES `columns_standard_upload_image` (`id_columns_standard_upload_image`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_upload_image_1` FOREIGN KEY (`id_columns_image`) REFERENCES `columns_image` (`id_columns_image`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `upload_image_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `upload_image_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
