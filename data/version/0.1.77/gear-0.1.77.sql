-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2015 at 03:09 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=106 ;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id_action`, `id_controller`, `name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 1, 'AutoincrementDatabase', '2015-05-08 18:36:46', 2, NULL, NULL),
(2, 1, 'DropTable', '2015-05-08 18:36:46', 2, NULL, NULL),
(3, 1, 'GetOrder', '2015-05-08 18:36:46', 2, NULL, NULL),
(4, 1, 'AnalyseDatabase', '2015-05-08 18:36:46', 2, NULL, NULL),
(5, 1, 'AnalyseTable', '2015-05-08 18:36:46', 2, NULL, NULL),
(6, 1, 'AutoincrementTable', '2015-05-08 18:36:46', 2, NULL, NULL),
(7, 1, 'ClearTable', '2015-05-08 18:36:46', 2, NULL, NULL),
(8, 1, 'CreateColumn', '2015-05-08 18:36:46', 2, NULL, NULL),
(9, 1, 'FixDatabase', '2015-05-08 18:36:46', 2, NULL, NULL),
(10, 1, 'FixTable', '2015-05-08 18:36:46', 2, NULL, NULL),
(11, 1, 'MysqlLoad', '2015-05-08 18:36:46', 2, NULL, NULL),
(12, 1, 'MysqlDump', '2015-05-08 18:36:46', 2, NULL, NULL),
(13, 1, 'Fixture', '2015-05-08 18:36:46', 2, NULL, NULL),
(14, 2, 'Build', '2015-05-08 18:36:46', 2, NULL, NULL),
(15, 3, 'Action', '2015-05-08 18:36:46', 2, NULL, NULL),
(16, 3, 'Controller', '2015-05-08 18:36:46', 2, NULL, NULL),
(17, 3, 'Db', '2015-05-08 18:36:46', 2, NULL, NULL),
(18, 3, 'Src', '2015-05-08 18:36:46', 2, NULL, NULL),
(19, 3, 'Test', '2015-05-08 18:36:46', 2, NULL, NULL),
(20, 3, 'View', '2015-05-08 18:36:46', 2, NULL, NULL),
(21, 4, 'Entities', '2015-05-08 18:36:46', 2, NULL, NULL),
(22, 4, 'Entity', '2015-05-08 18:36:46', 2, NULL, NULL),
(23, 4, 'Dump', '2015-05-08 18:36:46', 2, NULL, NULL),
(24, 4, 'Create', '2015-05-08 18:36:46', 2, NULL, NULL),
(25, 4, 'Delete', '2015-05-08 18:36:46', 2, NULL, NULL),
(26, 4, 'Load', '2015-05-08 18:36:46', 2, NULL, NULL),
(27, 4, 'Unload', '2015-05-08 18:36:46', 2, NULL, NULL),
(28, 4, 'Build', '2015-05-08 18:36:46', 2, NULL, NULL),
(29, 4, 'Push', '2015-05-08 18:36:46', 2, NULL, NULL),
(30, 4, 'Light', '2015-05-08 18:36:46', 2, NULL, NULL),
(31, 4, 'Jenkins', '2015-05-08 18:36:46', 2, NULL, NULL),
(32, 4, 'DumpAutoload', '2015-05-08 18:36:46', 2, NULL, NULL),
(33, 5, 'Deploy', '2015-05-08 18:36:46', 2, NULL, NULL),
(34, 5, 'RenewCache', '2015-05-08 18:36:46', 2, NULL, NULL),
(35, 5, 'Push', '2015-05-08 18:36:47', 2, NULL, NULL),
(36, 5, 'Build', '2015-05-08 18:36:47', 2, NULL, NULL),
(37, 5, 'Mysql2sqlite', '2015-05-08 18:36:47', 2, NULL, NULL),
(38, 5, 'ResetAcl', '2015-05-08 18:36:47', 2, NULL, NULL),
(39, 5, 'Acl', '2015-05-08 18:36:47', 2, NULL, NULL),
(40, 5, 'Config', '2015-05-08 18:36:47', 2, NULL, NULL),
(41, 5, 'Dump', '2015-05-08 18:36:47', 2, NULL, NULL),
(42, 5, 'Environment', '2015-05-08 18:36:47', 2, NULL, NULL),
(43, 5, 'Global', '2015-05-08 18:36:47', 2, NULL, NULL),
(44, 5, 'Local', '2015-05-08 18:36:47', 2, NULL, NULL),
(45, 5, 'Mysql', '2015-05-08 18:36:47', 2, NULL, NULL),
(46, 5, 'Project', '2015-05-08 18:36:47', 2, NULL, NULL),
(47, 5, 'Sqlite', '2015-05-08 18:36:47', 2, NULL, NULL),
(48, 5, 'Fixture', '2015-05-08 18:36:47', 2, NULL, NULL),
(49, 5, 'Jenkins', '2015-05-08 18:36:47', 2, NULL, NULL),
(50, 6, 'Acl', '2015-05-08 18:36:47', 2, NULL, NULL),
(51, 6, 'ResetAcl', '2015-05-08 18:36:47', 2, NULL, NULL),
(52, 7, 'ModuleVersion', '2015-05-08 18:36:47', 2, NULL, NULL),
(53, 7, 'ProjectVersion', '2015-05-08 18:36:47', 2, NULL, NULL),
(54, 8, 'Index', '2015-05-08 18:36:48', 2, NULL, NULL),
(55, 9, 'Index', '2015-05-08 18:36:48', 2, NULL, NULL),
(56, 10, 'Login', '2015-05-08 18:36:48', 2, NULL, NULL),
(57, 10, 'SendPasswordRecoveryRequest', '2015-05-08 18:36:48', 2, NULL, NULL),
(58, 10, 'PasswordRecoveryRequestSent', '2015-05-08 18:36:48', 2, NULL, NULL),
(59, 10, 'PasswordRecovery', '2015-05-08 18:36:48', 2, NULL, NULL),
(60, 10, 'PasswordRecoverySuccessful', '2015-05-08 18:36:48', 2, NULL, NULL),
(61, 10, 'Index', '2015-05-08 18:36:48', 2, NULL, NULL),
(62, 10, 'ChangePassword', '2015-05-08 18:36:48', 2, NULL, NULL),
(63, 10, 'ChangePasswordSuccessful', '2015-05-08 18:36:48', 2, NULL, NULL),
(64, 10, 'Logout', '2015-05-08 18:36:48', 2, NULL, NULL),
(65, 10, 'InvalidLink', '2015-05-08 18:36:48', 2, NULL, NULL),
(66, 11, 'Register', '2015-05-08 18:36:48', 2, NULL, NULL),
(67, 11, 'Acl', '2015-05-08 18:36:48', 2, NULL, NULL),
(68, 12, 'Index', '2015-05-08 18:36:49', 2, NULL, NULL),
(69, 13, 'ListarImagem', '2015-05-08 18:36:49', 2, NULL, NULL),
(70, 13, 'ExcluirImagem', '2015-05-08 18:36:49', 2, NULL, NULL),
(71, 13, 'SalvarImagem', '2015-05-08 18:36:49', 2, NULL, NULL),
(72, 14, 'Create', '2015-05-08 18:36:49', 2, NULL, NULL),
(73, 14, 'Edit', '2015-05-08 18:36:49', 2, NULL, NULL),
(74, 14, 'List', '2015-05-08 18:36:49', 2, NULL, NULL),
(75, 14, 'Delete', '2015-05-08 18:36:49', 2, NULL, NULL),
(76, 14, 'View', '2015-05-08 18:36:49', 2, NULL, NULL),
(77, 15, 'Index', '2015-05-08 18:36:49', 2, NULL, NULL),
(78, 16, 'Create', '2015-05-08 18:36:50', 2, NULL, NULL),
(79, 16, 'Edit', '2015-05-08 18:36:50', 2, NULL, NULL),
(80, 16, 'List', '2015-05-08 18:36:50', 2, NULL, NULL),
(81, 16, 'Delete', '2015-05-08 18:36:50', 2, NULL, NULL),
(82, 16, 'View', '2015-05-08 18:36:50', 2, NULL, NULL),
(83, 16, 'UploadImage', '2015-05-08 18:36:50', 2, NULL, NULL),
(84, 17, 'Index', '2015-05-08 18:36:50', 2, NULL, NULL),
(85, 18, 'Create', '2015-05-08 18:36:50', 2, NULL, NULL),
(86, 18, 'Edit', '2015-05-08 18:36:50', 2, NULL, NULL),
(87, 18, 'List', '2015-05-08 18:36:50', 2, NULL, NULL),
(88, 18, 'Delete', '2015-05-08 18:36:50', 2, NULL, NULL),
(89, 18, 'View', '2015-05-08 18:36:51', 2, NULL, NULL),
(90, 19, 'Create', '2015-05-08 18:36:51', 2, NULL, NULL),
(91, 19, 'Edit', '2015-05-08 18:36:51', 2, NULL, NULL),
(92, 19, 'List', '2015-05-08 18:36:51', 2, NULL, NULL),
(93, 19, 'Delete', '2015-05-08 18:36:51', 2, NULL, NULL),
(94, 19, 'View', '2015-05-08 18:36:51', 2, NULL, NULL),
(95, 20, 'Index', '2015-05-08 18:36:51', 2, NULL, NULL),
(96, 21, 'Create', '2015-05-08 18:36:51', 2, NULL, NULL),
(97, 21, 'Edit', '2015-05-08 18:36:51', 2, NULL, NULL),
(98, 21, 'List', '2015-05-08 18:36:52', 2, NULL, NULL),
(99, 21, 'Delete', '2015-05-08 18:36:52', 2, NULL, NULL),
(100, 21, 'View', '2015-05-08 18:36:52', 2, NULL, NULL),
(101, 22, 'Create', '2015-05-08 18:36:52', 2, NULL, NULL),
(102, 22, 'Edit', '2015-05-08 18:36:52', 2, NULL, NULL),
(103, 22, 'List', '2015-05-08 18:36:52', 2, NULL, NULL),
(104, 22, 'Delete', '2015-05-08 18:36:52', 2, NULL, NULL),
(105, 22, 'View', '2015-05-08 18:36:52', 2, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `columns`
--

INSERT INTO `columns` (`id_columns`, `column_date`, `column_datetime`, `column_time`, `column_int`, `column_tinyint`, `column_decimal`, `column_varchar`, `column_longtext`, `column_text`, `created`, `updated`, `created_by`, `updated_by`, `column_datetime_pt_br`, `column_date_pt_br`, `column_decimal_pt_br`, `column_int_checkbox`, `column_tinyint_checkbox`, `column_varchar_email`, `column_varchar_password_verify`, `column_varchar_unique_id`, `column_varchar_upload_image`, `column_foreign_key`) VALUES
(1, '2020-12-01', '2020-12-01 01:00:02', '01:00:02', 1, 1, 1.10, '01Column Varchar', '01Column Longtext', '01Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-01 01:00:02', '2020-12-01', 1.10, 1, 1, 'column.varchar.email01@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3b9e5281.57559992', '/upload/columns-columnVarcharUploadImage/%s01columnVarcharUploadImage.gif', 1),
(2, '2020-12-02', '2020-12-02 02:00:02', '02:00:02', 2, 2, 2.20, '02Column Varchar', '02Column Longtext', '02Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-02 02:00:02', '2020-12-02', 2.20, 0, 0, 'column.varchar.email02@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3b9ef712.71460964', '/upload/columns-columnVarcharUploadImage/%s02columnVarcharUploadImage.gif', 2),
(3, '2020-12-03', '2020-12-03 03:00:02', '03:00:02', 3, 3, 3.30, '03Column Varchar', '03Column Longtext', '03Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-03 03:00:02', '2020-12-03', 3.30, 1, 1, 'column.varchar.email03@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3b9fb124.83527644', '/upload/columns-columnVarcharUploadImage/%s03columnVarcharUploadImage.gif', 3),
(4, '2020-12-04', '2020-12-04 04:00:02', '04:00:02', 4, 4, 4.40, '04Column Varchar', '04Column Longtext', '04Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-04 04:00:02', '2020-12-04', 4.40, 0, 0, 'column.varchar.email04@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba03277.65077243', '/upload/columns-columnVarcharUploadImage/%s04columnVarcharUploadImage.gif', 4),
(5, '2020-12-05', '2020-12-05 05:00:02', '05:00:02', 5, 5, 5.50, '05Column Varchar', '05Column Longtext', '05Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-05 05:00:02', '2020-12-05', 5.50, 1, 1, 'column.varchar.email05@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba0a208.08616841', '/upload/columns-columnVarcharUploadImage/%s05columnVarcharUploadImage.gif', 5),
(6, '2020-12-06', '2020-12-06 06:00:02', '06:00:02', 6, 6, 6.60, '06Column Varchar', '06Column Longtext', '06Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-06 06:00:02', '2020-12-06', 6.60, 0, 0, 'column.varchar.email06@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba11b02.69780155', '/upload/columns-columnVarcharUploadImage/%s06columnVarcharUploadImage.gif', 6),
(7, '2020-12-07', '2020-12-07 07:00:02', '07:00:02', 7, 7, 7.70, '07Column Varchar', '07Column Longtext', '07Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-07 07:00:02', '2020-12-07', 7.70, 1, 1, 'column.varchar.email07@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba18972.91076387', '/upload/columns-columnVarcharUploadImage/%s07columnVarcharUploadImage.gif', 7),
(8, '2020-12-08', '2020-12-08 08:00:02', '08:00:02', 8, 8, 8.80, '08Column Varchar', '08Column Longtext', '08Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-08 08:00:02', '2020-12-08', 8.80, 0, 0, 'column.varchar.email08@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba1fa83.12141198', '/upload/columns-columnVarcharUploadImage/%s08columnVarcharUploadImage.gif', 8),
(9, '2020-12-09', '2020-12-09 09:00:02', '09:00:02', 9, 9, 9.90, '09Column Varchar', '09Column Longtext', '09Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-09 09:00:02', '2020-12-09', 9.90, 1, 1, 'column.varchar.email09@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba26d52.92939032', '/upload/columns-columnVarcharUploadImage/%s09columnVarcharUploadImage.gif', 9),
(10, '2020-12-10', '2020-12-10 10:00:02', '10:00:02', 10, 10, 10.10, '10Column Varchar', '10Column Longtext', '10Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-10 10:00:02', '2020-12-10', 10.10, 0, 0, 'column.varchar.email10@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba2de25.39886472', '/upload/columns-columnVarcharUploadImage/%s10columnVarcharUploadImage.gif', 10),
(11, '2020-12-11', '2020-12-11 11:00:02', '11:00:02', 11, 11, 11.11, '11Column Varchar', '11Column Longtext', '11Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-11 11:00:02', '2020-12-11', 11.11, 1, 1, 'column.varchar.email11@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba34d88.75269401', '/upload/columns-columnVarcharUploadImage/%s11columnVarcharUploadImage.gif', 11),
(12, '2020-12-12', '2020-12-12 12:00:02', '12:00:02', 12, 12, 12.12, '12Column Varchar', '12Column Longtext', '12Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-12 12:00:02', '2020-12-12', 12.12, 0, 0, 'column.varchar.email12@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba3b873.87325450', '/upload/columns-columnVarcharUploadImage/%s12columnVarcharUploadImage.gif', 12),
(13, '2020-12-13', '2020-12-13 13:00:02', '13:00:02', 13, 13, 13.13, '13Column Varchar', '13Column Longtext', '13Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-13 13:00:02', '2020-12-13', 13.13, 1, 1, 'column.varchar.email13@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba43113.60406351', '/upload/columns-columnVarcharUploadImage/%s13columnVarcharUploadImage.gif', 13),
(14, '2020-12-14', '2020-12-14 14:00:02', '14:00:02', 14, 14, 14.14, '14Column Varchar', '14Column Longtext', '14Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-14 14:00:02', '2020-12-14', 14.14, 0, 0, 'column.varchar.email14@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba49d40.54119221', '/upload/columns-columnVarcharUploadImage/%s14columnVarcharUploadImage.gif', 14),
(15, '2020-12-15', '2020-12-15 15:00:02', '15:00:02', 15, 15, 15.15, '15Column Varchar', '15Column Longtext', '15Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-15 15:00:02', '2020-12-15', 15.15, 1, 1, 'column.varchar.email15@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba51007.58058840', '/upload/columns-columnVarcharUploadImage/%s15columnVarcharUploadImage.gif', 15),
(16, '2020-12-16', '2020-12-16 16:00:02', '16:00:02', 16, 16, 16.16, '16Column Varchar', '16Column Longtext', '16Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-16 16:00:02', '2020-12-16', 16.16, 0, 0, 'column.varchar.email16@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba57d34.90094103', '/upload/columns-columnVarcharUploadImage/%s16columnVarcharUploadImage.gif', 16),
(17, '2020-12-17', '2020-12-17 17:00:02', '17:00:02', 17, 17, 17.17, '17Column Varchar', '17Column Longtext', '17Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-17 17:00:02', '2020-12-17', 17.17, 1, 1, 'column.varchar.email17@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba5ef74.19927697', '/upload/columns-columnVarcharUploadImage/%s17columnVarcharUploadImage.gif', 17),
(18, '2020-12-18', '2020-12-18 18:00:02', '18:00:02', 18, 18, 18.18, '18Column Varchar', '18Column Longtext', '18Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-18 18:00:02', '2020-12-18', 18.18, 0, 0, 'column.varchar.email18@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba6bbe6.68251566', '/upload/columns-columnVarcharUploadImage/%s18columnVarcharUploadImage.gif', 18),
(19, '2020-12-19', '2020-12-19 19:00:02', '19:00:02', 19, 19, 19.19, '19Column Varchar', '19Column Longtext', '19Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-19 19:00:02', '2020-12-19', 19.19, 1, 1, 'column.varchar.email19@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba78d09.65924506', '/upload/columns-columnVarcharUploadImage/%s19columnVarcharUploadImage.gif', 19),
(20, '2020-12-20', '2020-12-20 20:00:02', '20:00:02', 20, 20, 20.20, '20Column Varchar', '20Column Longtext', '20Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-20 20:00:02', '2020-12-20', 20.20, 0, 0, 'column.varchar.email20@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba7fef8.99868891', '/upload/columns-columnVarcharUploadImage/%s20columnVarcharUploadImage.gif', 20),
(21, '2020-12-21', '2020-12-21 21:00:02', '21:00:02', 21, 21, 21.21, '21Column Varchar', '21Column Longtext', '21Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-21 21:00:02', '2020-12-21', 21.21, 1, 1, 'column.varchar.email21@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba86a74.42270175', '/upload/columns-columnVarcharUploadImage/%s21columnVarcharUploadImage.gif', 21),
(22, '2020-12-22', '2020-12-22 22:00:02', '22:00:02', 22, 22, 22.22, '22Column Varchar', '22Column Longtext', '22Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-22 22:00:02', '2020-12-22', 22.22, 0, 0, 'column.varchar.email22@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba8d777.06628870', '/upload/columns-columnVarcharUploadImage/%s22columnVarcharUploadImage.gif', 22),
(23, '2020-12-23', '2020-12-23 23:00:02', '23:00:02', 23, 23, 23.23, '23Column Varchar', '23Column Longtext', '23Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-23 23:00:02', '2020-12-23', 23.23, 1, 1, 'column.varchar.email23@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba944f1.41497030', '/upload/columns-columnVarcharUploadImage/%s23columnVarcharUploadImage.gif', 23),
(24, '2020-12-24', '2020-12-24 06:00:02', '06:00:02', 24, 24, 24.24, '24Column Varchar', '24Column Longtext', '24Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-24 06:00:02', '2020-12-24', 24.24, 0, 0, 'column.varchar.email24@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba9b1a8.93405248', '/upload/columns-columnVarcharUploadImage/%s24columnVarcharUploadImage.gif', 24),
(25, '2020-12-25', '2020-12-25 05:00:02', '05:00:02', 25, 25, 25.25, '25Column Varchar', '25Column Longtext', '25Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-25 05:00:02', '2020-12-25', 25.25, 1, 1, 'column.varchar.email25@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3baa2c20.71397175', '/upload/columns-columnVarcharUploadImage/%s25columnVarcharUploadImage.gif', 25),
(26, '2020-12-26', '2020-12-26 04:00:02', '04:00:02', 26, 26, 26.26, '26Column Varchar', '26Column Longtext', '26Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-26 04:00:02', '2020-12-26', 26.26, 0, 0, 'column.varchar.email26@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3baa98b1.20919991', '/upload/columns-columnVarcharUploadImage/%s26columnVarcharUploadImage.gif', 26),
(27, '2020-12-27', '2020-12-27 03:00:02', '03:00:02', 27, 27, 27.27, '27Column Varchar', '27Column Longtext', '27Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-27 03:00:02', '2020-12-27', 27.27, 1, 1, 'column.varchar.email27@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3bab09d2.64707357', '/upload/columns-columnVarcharUploadImage/%s27columnVarcharUploadImage.gif', 27),
(28, '2020-12-28', '2020-12-28 02:00:02', '02:00:02', 28, 28, 28.28, '28Column Varchar', '28Column Longtext', '28Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-28 02:00:02', '2020-12-28', 28.28, 0, 0, 'column.varchar.email28@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3bab7bf5.75786880', '/upload/columns-columnVarcharUploadImage/%s28columnVarcharUploadImage.gif', 28),
(29, '2020-12-29', '2020-12-29 01:00:02', '01:00:02', 29, 29, 29.29, '29Column Varchar', '29Column Longtext', '29Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-29 01:00:02', '2020-12-29', 29.29, 1, 1, 'column.varchar.email29@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3babefa8.03612086', '/upload/columns-columnVarcharUploadImage/%s29columnVarcharUploadImage.gif', 29),
(30, '2020-12-30', '2020-12-30 00:00:02', '00:00:02', 30, 30, 30.30, '30Column Varchar', '30Column Longtext', '30Column Text', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-30 00:00:02', '2020-12-30', 30.30, 0, 0, 'column.varchar.email30@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3bac60b1.56190741', '/upload/columns-columnVarcharUploadImage/%s30columnVarcharUploadImage.gif', 30);

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
(1, '/upload/columns-image-uploadImageOne/%s01uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s01uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s01uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(2, '/upload/columns-image-uploadImageOne/%s02uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s02uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s02uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(3, '/upload/columns-image-uploadImageOne/%s03uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s03uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s03uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(4, '/upload/columns-image-uploadImageOne/%s04uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s04uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s04uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(5, '/upload/columns-image-uploadImageOne/%s05uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s05uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s05uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(6, '/upload/columns-image-uploadImageOne/%s06uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s06uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s06uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(7, '/upload/columns-image-uploadImageOne/%s07uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s07uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s07uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(8, '/upload/columns-image-uploadImageOne/%s08uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s08uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s08uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(9, '/upload/columns-image-uploadImageOne/%s09uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s09uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s09uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(10, '/upload/columns-image-uploadImageOne/%s10uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s10uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s10uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(11, '/upload/columns-image-uploadImageOne/%s11uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s11uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s11uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(12, '/upload/columns-image-uploadImageOne/%s12uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s12uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s12uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(13, '/upload/columns-image-uploadImageOne/%s13uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s13uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s13uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(14, '/upload/columns-image-uploadImageOne/%s14uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s14uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s14uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(15, '/upload/columns-image-uploadImageOne/%s15uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s15uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s15uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(16, '/upload/columns-image-uploadImageOne/%s16uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s16uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s16uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(17, '/upload/columns-image-uploadImageOne/%s17uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s17uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s17uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(18, '/upload/columns-image-uploadImageOne/%s18uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s18uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s18uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:43', NULL),
(19, '/upload/columns-image-uploadImageOne/%s19uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s19uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s19uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:44', NULL),
(20, '/upload/columns-image-uploadImageOne/%s20uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s20uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s20uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:44', NULL),
(21, '/upload/columns-image-uploadImageOne/%s21uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s21uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s21uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:44', NULL),
(22, '/upload/columns-image-uploadImageOne/%s22uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s22uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s22uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:44', NULL),
(23, '/upload/columns-image-uploadImageOne/%s23uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s23uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s23uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:44', NULL),
(24, '/upload/columns-image-uploadImageOne/%s24uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s24uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s24uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:44', NULL),
(25, '/upload/columns-image-uploadImageOne/%s25uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s25uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s25uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:44', NULL),
(26, '/upload/columns-image-uploadImageOne/%s26uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s26uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s26uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:44', NULL),
(27, '/upload/columns-image-uploadImageOne/%s27uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s27uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s27uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:44', NULL),
(28, '/upload/columns-image-uploadImageOne/%s28uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s28uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s28uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:44', NULL),
(29, '/upload/columns-image-uploadImageOne/%s29uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s29uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s29uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:44', NULL),
(30, '/upload/columns-image-uploadImageOne/%s30uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s30uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s30uploadImageThree.gif', 2, NULL, '2015-05-08 18:36:44', NULL);

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
  `column_foreign_key_copy_not_null` int(11) NOT NULL,
  PRIMARY KEY (`id_columns_not_null`),
  KEY `columns_not_null_ibfk_1` (`created_by`),
  KEY `columns_not_null_ibfk_2` (`updated_by`),
  KEY `fk_columns_not_null_1` (`column_foreign_key_copy_not_null`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `columns_not_null`
--

INSERT INTO `columns_not_null` (`id_columns_not_null`, `column_date_not_null`, `column_datetime_not_null`, `column_time_not_null`, `column_int_not_null`, `column_tinyint_not_null`, `column_decimal_not_null`, `column_varchar_not_null`, `column_longtext_not_null`, `column_text_not_null`, `created`, `updated`, `created_by`, `updated_by`, `column_datetime_pt_br_not_null`, `column_date_pt_br_not_null`, `column_decimal_pt_br_not_null`, `column_int_checkbox_not_null`, `column_tinyint_checkbox_not_null`, `column_varchar_email_not_null`, `column_varchar_password_verify_not_null`, `column_varchar_unique_id_not_null`, `column_varchar_upload_image_not_null`, `column_foreign_key_copy_not_null`) VALUES
(1, '2020-12-01', '2020-12-01 01:00:02', '01:00:02', 1, 1, 1.10, '01Column Varchar Not Null', '01Column Longtext Not Null', '01Column Text Not Null', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-01 01:00:02', '2020-12-01', 1.10, 1, 1, 'column.varchar.email.not.null01@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da28c31.92417674', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s01columnVarcharUploadImageNotNull.gif', 1),
(2, '2020-12-02', '2020-12-02 02:00:02', '02:00:02', 2, 2, 2.20, '02Column Varchar Not Null', '02Column Longtext Not Null', '02Column Text Not Null', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-02 02:00:02', '2020-12-02', 2.20, 0, 0, 'column.varchar.email.not.null02@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da372d4.83721035', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s02columnVarcharUploadImageNotNull.gif', 2),
(3, '2020-12-03', '2020-12-03 03:00:02', '03:00:02', 3, 3, 3.30, '03Column Varchar Not Null', '03Column Longtext Not Null', '03Column Text Not Null', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-03 03:00:02', '2020-12-03', 3.30, 1, 1, 'column.varchar.email.not.null03@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da45ba9.89535505', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s03columnVarcharUploadImageNotNull.gif', 3),
(4, '2020-12-04', '2020-12-04 04:00:02', '04:00:02', 4, 4, 4.40, '04Column Varchar Not Null', '04Column Longtext Not Null', '04Column Text Not Null', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-04 04:00:02', '2020-12-04', 4.40, 0, 0, 'column.varchar.email.not.null04@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da514b8.12382791', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s04columnVarcharUploadImageNotNull.gif', 4),
(5, '2020-12-05', '2020-12-05 05:00:02', '05:00:02', 5, 5, 5.50, '05Column Varchar Not Null', '05Column Longtext Not Null', '05Column Text Not Null', '2015-05-08 18:36:45', NULL, 2, NULL, '2020-12-05 05:00:02', '2020-12-05', 5.50, 1, 1, 'column.varchar.email.not.null05@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da59ba3.16139804', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s05columnVarcharUploadImageNotNull.gif', 5),
(6, '2020-12-06', '2020-12-06 06:00:02', '06:00:02', 6, 6, 6.60, '06Column Varchar Not Null', '06Column Longtext Not Null', '06Column Text Not Null', '2015-05-08 18:36:45', NULL, 3, NULL, '2020-12-06 06:00:02', '2020-12-06', 6.60, 0, 0, 'column.varchar.email.not.null06@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da62174.21158965', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s06columnVarcharUploadImageNotNull.gif', 6),
(7, '2020-12-07', '2020-12-07 07:00:02', '07:00:02', 7, 7, 7.70, '07Column Varchar Not Null', '07Column Longtext Not Null', '07Column Text Not Null', '2015-05-08 18:36:45', NULL, 3, NULL, '2020-12-07 07:00:02', '2020-12-07', 7.70, 1, 1, 'column.varchar.email.not.null07@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da6a521.44641599', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s07columnVarcharUploadImageNotNull.gif', 7),
(8, '2020-12-08', '2020-12-08 08:00:02', '08:00:02', 8, 8, 8.80, '08Column Varchar Not Null', '08Column Longtext Not Null', '08Column Text Not Null', '2015-05-08 18:36:45', NULL, 3, NULL, '2020-12-08 08:00:02', '2020-12-08', 8.80, 0, 0, 'column.varchar.email.not.null08@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da73630.76791643', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s08columnVarcharUploadImageNotNull.gif', 8),
(9, '2020-12-09', '2020-12-09 09:00:02', '09:00:02', 9, 9, 9.90, '09Column Varchar Not Null', '09Column Longtext Not Null', '09Column Text Not Null', '2015-05-08 18:36:45', NULL, 3, NULL, '2020-12-09 09:00:02', '2020-12-09', 9.90, 1, 1, 'column.varchar.email.not.null09@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da7bca8.92863688', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s09columnVarcharUploadImageNotNull.gif', 9),
(10, '2020-12-10', '2020-12-10 10:00:02', '10:00:02', 10, 10, 10.10, '10Column Varchar Not Null', '10Column Longtext Not Null', '10Column Text Not Null', '2015-05-08 18:36:45', NULL, 3, NULL, '2020-12-10 10:00:02', '2020-12-10', 10.10, 0, 0, 'column.varchar.email.not.null10@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da84745.34918762', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s10columnVarcharUploadImageNotNull.gif', 10),
(11, '2020-12-11', '2020-12-11 11:00:02', '11:00:02', 11, 11, 11.11, '11Column Varchar Not Null', '11Column Longtext Not Null', '11Column Text Not Null', '2015-05-08 18:36:45', NULL, 4, NULL, '2020-12-11 11:00:02', '2020-12-11', 11.11, 1, 1, 'column.varchar.email.not.null11@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da8cce6.98108712', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s11columnVarcharUploadImageNotNull.gif', 11),
(12, '2020-12-12', '2020-12-12 12:00:02', '12:00:02', 12, 12, 12.12, '12Column Varchar Not Null', '12Column Longtext Not Null', '12Column Text Not Null', '2015-05-08 18:36:45', NULL, 4, NULL, '2020-12-12 12:00:02', '2020-12-12', 12.12, 0, 0, 'column.varchar.email.not.null12@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da95320.79461820', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s12columnVarcharUploadImageNotNull.gif', 12),
(13, '2020-12-13', '2020-12-13 13:00:02', '13:00:02', 13, 13, 13.13, '13Column Varchar Not Null', '13Column Longtext Not Null', '13Column Text Not Null', '2015-05-08 18:36:45', NULL, 4, NULL, '2020-12-13 13:00:02', '2020-12-13', 13.13, 1, 1, 'column.varchar.email.not.null13@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da9df40.85024159', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s13columnVarcharUploadImageNotNull.gif', 13),
(14, '2020-12-14', '2020-12-14 14:00:02', '14:00:02', 14, 14, 14.14, '14Column Varchar Not Null', '14Column Longtext Not Null', '14Column Text Not Null', '2015-05-08 18:36:45', NULL, 4, NULL, '2020-12-14 14:00:02', '2020-12-14', 14.14, 0, 0, 'column.varchar.email.not.null14@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4daa8255.48623048', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s14columnVarcharUploadImageNotNull.gif', 14),
(15, '2020-12-15', '2020-12-15 15:00:02', '15:00:02', 15, 15, 15.15, '15Column Varchar Not Null', '15Column Longtext Not Null', '15Column Text Not Null', '2015-05-08 18:36:45', NULL, 4, NULL, '2020-12-15 15:00:02', '2020-12-15', 15.15, 1, 1, 'column.varchar.email.not.null15@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dab9c67.67750469', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s15columnVarcharUploadImageNotNull.gif', 15),
(16, '2020-12-16', '2020-12-16 16:00:02', '16:00:02', 16, 16, 16.16, '16Column Varchar Not Null', '16Column Longtext Not Null', '16Column Text Not Null', '2015-05-08 18:36:45', NULL, 5, NULL, '2020-12-16 16:00:02', '2020-12-16', 16.16, 0, 0, 'column.varchar.email.not.null16@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dac28f9.69334031', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s16columnVarcharUploadImageNotNull.gif', 16),
(17, '2020-12-17', '2020-12-17 17:00:02', '17:00:02', 17, 17, 17.17, '17Column Varchar Not Null', '17Column Longtext Not Null', '17Column Text Not Null', '2015-05-08 18:36:45', NULL, 5, NULL, '2020-12-17 17:00:02', '2020-12-17', 17.17, 1, 1, 'column.varchar.email.not.null17@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dacb2b5.36470420', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s17columnVarcharUploadImageNotNull.gif', 17),
(18, '2020-12-18', '2020-12-18 18:00:02', '18:00:02', 18, 18, 18.18, '18Column Varchar Not Null', '18Column Longtext Not Null', '18Column Text Not Null', '2015-05-08 18:36:45', NULL, 5, NULL, '2020-12-18 18:00:02', '2020-12-18', 18.18, 0, 0, 'column.varchar.email.not.null18@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dad4944.03471490', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s18columnVarcharUploadImageNotNull.gif', 18),
(19, '2020-12-19', '2020-12-19 19:00:02', '19:00:02', 19, 19, 19.19, '19Column Varchar Not Null', '19Column Longtext Not Null', '19Column Text Not Null', '2015-05-08 18:36:45', NULL, 5, NULL, '2020-12-19 19:00:02', '2020-12-19', 19.19, 1, 1, 'column.varchar.email.not.null19@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dadd725.09030517', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s19columnVarcharUploadImageNotNull.gif', 19),
(20, '2020-12-20', '2020-12-20 20:00:02', '20:00:02', 20, 20, 20.20, '20Column Varchar Not Null', '20Column Longtext Not Null', '20Column Text Not Null', '2015-05-08 18:36:45', NULL, 5, NULL, '2020-12-20 20:00:02', '2020-12-20', 20.20, 0, 0, 'column.varchar.email.not.null20@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dae5db6.38067099', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s20columnVarcharUploadImageNotNull.gif', 20),
(21, '2020-12-21', '2020-12-21 21:00:02', '21:00:02', 21, 21, 21.21, '21Column Varchar Not Null', '21Column Longtext Not Null', '21Column Text Not Null', '2015-05-08 18:36:45', NULL, 6, NULL, '2020-12-21 21:00:02', '2020-12-21', 21.21, 1, 1, 'column.varchar.email.not.null21@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4daee919.52458922', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s21columnVarcharUploadImageNotNull.gif', 21),
(22, '2020-12-22', '2020-12-22 22:00:02', '22:00:02', 22, 22, 22.22, '22Column Varchar Not Null', '22Column Longtext Not Null', '22Column Text Not Null', '2015-05-08 18:36:45', NULL, 6, NULL, '2020-12-22 22:00:02', '2020-12-22', 22.22, 0, 0, 'column.varchar.email.not.null22@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4daf6f12.46801308', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s22columnVarcharUploadImageNotNull.gif', 22),
(23, '2020-12-23', '2020-12-23 23:00:02', '23:00:02', 23, 23, 23.23, '23Column Varchar Not Null', '23Column Longtext Not Null', '23Column Text Not Null', '2015-05-08 18:36:45', NULL, 6, NULL, '2020-12-23 23:00:02', '2020-12-23', 23.23, 1, 1, 'column.varchar.email.not.null23@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dafff14.09460336', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s23columnVarcharUploadImageNotNull.gif', 23),
(24, '2020-12-24', '2020-12-24 06:00:02', '06:00:02', 24, 24, 24.24, '24Column Varchar Not Null', '24Column Longtext Not Null', '24Column Text Not Null', '2015-05-08 18:36:45', NULL, 6, NULL, '2020-12-24 06:00:02', '2020-12-24', 24.24, 0, 0, 'column.varchar.email.not.null24@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db08619.64997180', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s24columnVarcharUploadImageNotNull.gif', 24),
(25, '2020-12-25', '2020-12-25 05:00:02', '05:00:02', 25, 25, 25.25, '25Column Varchar Not Null', '25Column Longtext Not Null', '25Column Text Not Null', '2015-05-08 18:36:45', NULL, 6, NULL, '2020-12-25 05:00:02', '2020-12-25', 25.25, 1, 1, 'column.varchar.email.not.null25@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db10d43.44336525', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s25columnVarcharUploadImageNotNull.gif', 25),
(26, '2020-12-26', '2020-12-26 04:00:02', '04:00:02', 26, 26, 26.26, '26Column Varchar Not Null', '26Column Longtext Not Null', '26Column Text Not Null', '2015-05-08 18:36:45', NULL, 7, NULL, '2020-12-26 04:00:02', '2020-12-26', 26.26, 0, 0, 'column.varchar.email.not.null26@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db1c2b9.54596867', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s26columnVarcharUploadImageNotNull.gif', 26),
(27, '2020-12-27', '2020-12-27 03:00:02', '03:00:02', 27, 27, 27.27, '27Column Varchar Not Null', '27Column Longtext Not Null', '27Column Text Not Null', '2015-05-08 18:36:45', NULL, 7, NULL, '2020-12-27 03:00:02', '2020-12-27', 27.27, 1, 1, 'column.varchar.email.not.null27@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db24fe2.28774442', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s27columnVarcharUploadImageNotNull.gif', 27),
(28, '2020-12-28', '2020-12-28 02:00:02', '02:00:02', 28, 28, 28.28, '28Column Varchar Not Null', '28Column Longtext Not Null', '28Column Text Not Null', '2015-05-08 18:36:45', NULL, 7, NULL, '2020-12-28 02:00:02', '2020-12-28', 28.28, 0, 0, 'column.varchar.email.not.null28@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db2e8c4.16609774', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s28columnVarcharUploadImageNotNull.gif', 28),
(29, '2020-12-29', '2020-12-29 01:00:02', '01:00:02', 29, 29, 29.29, '29Column Varchar Not Null', '29Column Longtext Not Null', '29Column Text Not Null', '2015-05-08 18:36:45', NULL, 7, NULL, '2020-12-29 01:00:02', '2020-12-29', 29.29, 1, 1, 'column.varchar.email.not.null29@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db3a789.38563893', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s29columnVarcharUploadImageNotNull.gif', 29),
(30, '2020-12-30', '2020-12-30 00:00:02', '00:00:02', 30, 30, 30.30, '30Column Varchar Not Null', '30Column Longtext Not Null', '30Column Text Not Null', '2015-05-08 18:36:45', NULL, 7, NULL, '2020-12-30 00:00:02', '2020-12-30', 30.30, 0, 0, 'column.varchar.email.not.null30@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db43249.02671618', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s30columnVarcharUploadImageNotNull.gif', 30);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `controller`
--

INSERT INTO `controller` (`id_controller`, `id_module`, `name`, `invokable`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 1, 'Db', 'Gear\\Controller\\Db', '2015-05-08 18:36:46', 2, NULL, NULL),
(2, 1, 'Build', 'Gear\\Controller\\Build', '2015-05-08 18:36:46', 2, NULL, NULL),
(3, 1, 'Constructor', 'Gear\\Controller\\Constructor', '2015-05-08 18:36:46', 2, NULL, NULL),
(4, 1, 'Module', 'Gear\\Controller\\Module', '2015-05-08 18:36:46', 2, NULL, NULL),
(5, 1, 'Project', 'Gear\\Controller\\Project', '2015-05-08 18:36:46', 2, NULL, NULL),
(6, 2, 'ProjectController', 'GearAcl\\Controller\\Project', '2015-05-08 18:36:47', 2, NULL, NULL),
(7, 3, 'VersionController', 'GearVersion\\Controller\\Version', '2015-05-08 18:36:47', 2, NULL, NULL),
(8, 4, 'IndexController', 'GearJson\\Controller\\Index', '2015-05-08 18:36:48', 2, NULL, NULL),
(9, 5, 'IndexController', 'GearBackup\\Controller\\Index', '2015-05-08 18:36:48', 2, NULL, NULL),
(10, 6, 'Index', 'GearAdmin\\Controller\\Index', '2015-05-08 18:36:48', 2, NULL, NULL),
(11, 6, 'User', 'GearAdmin\\Controller\\User', '2015-05-08 18:36:48', 2, NULL, NULL),
(12, 7, 'Index', 'GearImage\\Controller\\Index', '2015-05-08 18:36:49', 2, NULL, NULL),
(13, 7, 'Imagem', 'GearImage\\Controller\\Imagem', '2015-05-08 18:36:49', 2, NULL, NULL),
(14, 7, 'MarcaController', 'GearImage\\Controller\\Marca', '2015-05-08 18:36:49', 2, NULL, NULL),
(15, 8, 'IndexController', 'ColumnImage\\Controller\\Index', '2015-05-08 18:36:49', 2, NULL, NULL),
(16, 8, 'ColumnsImageController', 'ColumnImage\\Controller\\ColumnsImage', '2015-05-08 18:36:50', 2, NULL, NULL),
(17, 9, 'IndexController', 'Column\\Controller\\Index', '2015-05-08 18:36:50', 2, NULL, NULL),
(18, 9, 'ColumnsController', 'Column\\Controller\\Columns', '2015-05-08 18:36:50', 2, NULL, NULL),
(19, 9, 'ForeignKeysController', 'Column\\Controller\\ForeignKeys', '2015-05-08 18:36:51', 2, NULL, NULL),
(20, 10, 'IndexController', 'ColumnNotNull\\Controller\\Index', '2015-05-08 18:36:51', 2, NULL, NULL),
(21, 10, 'ColumnsNotNullController', 'ColumnNotNull\\Controller\\ColumnsNotNull', '2015-05-08 18:36:51', 2, NULL, NULL),
(22, 10, 'ForeignKeysCopyController', 'ColumnNotNull\\Controller\\ForeignKeysCopy', '2015-05-08 18:36:52', 2, NULL, NULL);

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
(1, '01Name', '2015-05-08 18:36:42', NULL, 2, NULL),
(2, '02Name', '2015-05-08 18:36:42', NULL, 2, NULL),
(3, '03Name', '2015-05-08 18:36:42', NULL, 2, NULL),
(4, '04Name', '2015-05-08 18:36:42', NULL, 2, NULL),
(5, '05Name', '2015-05-08 18:36:42', NULL, 2, NULL),
(6, '06Name', '2015-05-08 18:36:42', NULL, 3, NULL),
(7, '07Name', '2015-05-08 18:36:42', NULL, 3, NULL),
(8, '08Name', '2015-05-08 18:36:42', NULL, 3, NULL),
(9, '09Name', '2015-05-08 18:36:42', NULL, 3, NULL),
(10, '10Name', '2015-05-08 18:36:42', NULL, 3, NULL),
(11, '11Name', '2015-05-08 18:36:42', NULL, 4, NULL),
(12, '12Name', '2015-05-08 18:36:42', NULL, 4, NULL),
(13, '13Name', '2015-05-08 18:36:42', NULL, 4, NULL),
(14, '14Name', '2015-05-08 18:36:42', NULL, 4, NULL),
(15, '15Name', '2015-05-08 18:36:42', NULL, 4, NULL),
(16, '16Name', '2015-05-08 18:36:42', NULL, 5, NULL),
(17, '17Name', '2015-05-08 18:36:42', NULL, 5, NULL),
(18, '18Name', '2015-05-08 18:36:42', NULL, 5, NULL),
(19, '19Name', '2015-05-08 18:36:42', NULL, 5, NULL),
(20, '20Name', '2015-05-08 18:36:42', NULL, 5, NULL),
(21, '21Name', '2015-05-08 18:36:42', NULL, 6, NULL),
(22, '22Name', '2015-05-08 18:36:42', NULL, 6, NULL),
(23, '23Name', '2015-05-08 18:36:42', NULL, 6, NULL),
(24, '24Name', '2015-05-08 18:36:42', NULL, 6, NULL),
(25, '25Name', '2015-05-08 18:36:42', NULL, 6, NULL),
(26, '26Name', '2015-05-08 18:36:42', NULL, 7, NULL),
(27, '27Name', '2015-05-08 18:36:42', NULL, 7, NULL),
(28, '28Name', '2015-05-08 18:36:43', NULL, 7, NULL),
(29, '29Name', '2015-05-08 18:36:43', NULL, 7, NULL),
(30, '30Name', '2015-05-08 18:36:43', NULL, 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `foreign_keys_copy`
--

CREATE TABLE IF NOT EXISTS `foreign_keys_copy` (
  `id_foreign_keys_copy` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_foreign_keys_copy`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `foreign_keys_copy`
--

INSERT INTO `foreign_keys_copy` (`id_foreign_keys_copy`, `name`, `created`, `updated`, `created_by`, `updated_by`) VALUES
(1, '01Name', '2015-05-08 18:36:43', NULL, 2, NULL),
(2, '02Name', '2015-05-08 18:36:43', NULL, 2, NULL),
(3, '03Name', '2015-05-08 18:36:43', NULL, 2, NULL),
(4, '04Name', '2015-05-08 18:36:43', NULL, 2, NULL),
(5, '05Name', '2015-05-08 18:36:43', NULL, 2, NULL),
(6, '06Name', '2015-05-08 18:36:43', NULL, 3, NULL),
(7, '07Name', '2015-05-08 18:36:43', NULL, 3, NULL),
(8, '08Name', '2015-05-08 18:36:43', NULL, 3, NULL),
(9, '09Name', '2015-05-08 18:36:43', NULL, 3, NULL),
(10, '10Name', '2015-05-08 18:36:43', NULL, 3, NULL),
(11, '11Name', '2015-05-08 18:36:43', NULL, 4, NULL),
(12, '12Name', '2015-05-08 18:36:43', NULL, 4, NULL),
(13, '13Name', '2015-05-08 18:36:43', NULL, 4, NULL),
(14, '14Name', '2015-05-08 18:36:43', NULL, 4, NULL),
(15, '15Name', '2015-05-08 18:36:43', NULL, 4, NULL),
(16, '16Name', '2015-05-08 18:36:43', NULL, 5, NULL),
(17, '17Name', '2015-05-08 18:36:43', NULL, 5, NULL),
(18, '18Name', '2015-05-08 18:36:43', NULL, 5, NULL),
(19, '19Name', '2015-05-08 18:36:43', NULL, 5, NULL),
(20, '20Name', '2015-05-08 18:36:43', NULL, 5, NULL),
(21, '21Name', '2015-05-08 18:36:43', NULL, 6, NULL),
(22, '22Name', '2015-05-08 18:36:43', NULL, 6, NULL),
(23, '23Name', '2015-05-08 18:36:43', NULL, 6, NULL),
(24, '24Name', '2015-05-08 18:36:43', NULL, 6, NULL),
(25, '25Name', '2015-05-08 18:36:43', NULL, 6, NULL),
(26, '26Name', '2015-05-08 18:36:43', NULL, 7, NULL),
(27, '27Name', '2015-05-08 18:36:43', NULL, 7, NULL),
(28, '28Name', '2015-05-08 18:36:43', NULL, 7, NULL),
(29, '29Name', '2015-05-08 18:36:43', NULL, 7, NULL),
(30, '30Name', '2015-05-08 18:36:43', NULL, 7, NULL);

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
(1, 'Gear', '2015-05-08 18:36:46', 2, NULL, NULL),
(2, 'GearAcl', '2015-05-08 18:36:47', 2, NULL, NULL),
(3, 'GearVersion', '2015-05-08 18:36:47', 2, NULL, NULL),
(4, 'GearJson', '2015-05-08 18:36:48', 2, NULL, NULL),
(5, 'GearBackup', '2015-05-08 18:36:48', 2, NULL, NULL),
(6, 'GearAdmin', '2015-05-08 18:36:48', 2, NULL, NULL),
(7, 'GearImage', '2015-05-08 18:36:49', 2, NULL, NULL),
(8, 'ColumnImage', '2015-05-08 18:36:49', 2, NULL, NULL),
(9, 'Column', '2015-05-08 18:36:50', 2, NULL, NULL),
(10, 'ColumnNotNull', '2015-05-08 18:36:51', 2, NULL, NULL);

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
(1, NULL, 'guest', '2015-05-08 18:36:42', 2, NULL, NULL),
(2, 1, 'admin', '2015-05-08 18:36:42', 2, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=106 ;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id_rule`, `id_action`, `id_controller`, `id_role`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 1, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(2, 2, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(3, 3, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(4, 4, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(5, 5, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(6, 6, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(7, 7, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(8, 8, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(9, 9, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(10, 10, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(11, 11, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(12, 12, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(13, 13, 1, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(14, 14, 2, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(15, 15, 3, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(16, 16, 3, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(17, 17, 3, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(18, 18, 3, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(19, 19, 3, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(20, 20, 3, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(21, 21, 4, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(22, 22, 4, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(23, 23, 4, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(24, 24, 4, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(25, 25, 4, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(26, 26, 4, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(27, 27, 4, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(28, 28, 4, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(29, 29, 4, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(30, 30, 4, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(31, 31, 4, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(32, 32, 4, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(33, 33, 5, 1, '2015-05-08 18:36:46', 2, NULL, NULL),
(34, 34, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(35, 35, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(36, 36, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(37, 37, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(38, 38, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(39, 39, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(40, 40, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(41, 41, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(42, 42, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(43, 43, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(44, 44, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(45, 45, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(46, 46, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(47, 47, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(48, 48, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(49, 49, 5, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(50, 50, 6, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(51, 51, 6, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(52, 52, 7, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(53, 53, 7, 1, '2015-05-08 18:36:47', 2, NULL, NULL),
(54, 54, 8, 1, '2015-05-08 18:36:48', 2, NULL, NULL),
(55, 55, 9, 1, '2015-05-08 18:36:48', 2, NULL, NULL),
(56, 56, 10, 1, '2015-05-08 18:36:48', 2, NULL, NULL),
(57, 57, 10, 1, '2015-05-08 18:36:48', 2, NULL, NULL),
(58, 58, 10, 1, '2015-05-08 18:36:48', 2, NULL, NULL),
(59, 59, 10, 1, '2015-05-08 18:36:48', 2, NULL, NULL),
(60, 60, 10, 1, '2015-05-08 18:36:48', 2, NULL, NULL),
(61, 61, 10, 2, '2015-05-08 18:36:48', 2, NULL, NULL),
(62, 62, 10, 2, '2015-05-08 18:36:48', 2, NULL, NULL),
(63, 63, 10, 2, '2015-05-08 18:36:48', 2, NULL, NULL),
(64, 64, 10, 2, '2015-05-08 18:36:48', 2, NULL, NULL),
(65, 65, 10, 1, '2015-05-08 18:36:48', 2, NULL, NULL),
(66, 66, 11, 1, '2015-05-08 18:36:48', 2, NULL, NULL),
(67, 67, 11, 1, '2015-05-08 18:36:49', 2, NULL, NULL),
(68, 68, 12, 1, '2015-05-08 18:36:49', 2, NULL, NULL),
(69, 69, 13, 1, '2015-05-08 18:36:49', 2, NULL, NULL),
(70, 70, 13, 1, '2015-05-08 18:36:49', 2, NULL, NULL),
(71, 71, 13, 1, '2015-05-08 18:36:49', 2, NULL, NULL),
(72, 72, 14, 2, '2015-05-08 18:36:49', 2, NULL, NULL),
(73, 73, 14, 2, '2015-05-08 18:36:49', 2, NULL, NULL),
(74, 74, 14, 2, '2015-05-08 18:36:49', 2, NULL, NULL),
(75, 75, 14, 2, '2015-05-08 18:36:49', 2, NULL, NULL),
(76, 76, 14, 2, '2015-05-08 18:36:49', 2, NULL, NULL),
(77, 77, 15, 1, '2015-05-08 18:36:49', 2, NULL, NULL),
(78, 78, 16, 2, '2015-05-08 18:36:50', 2, NULL, NULL),
(79, 79, 16, 2, '2015-05-08 18:36:50', 2, NULL, NULL),
(80, 80, 16, 2, '2015-05-08 18:36:50', 2, NULL, NULL),
(81, 81, 16, 2, '2015-05-08 18:36:50', 2, NULL, NULL),
(82, 82, 16, 2, '2015-05-08 18:36:50', 2, NULL, NULL),
(83, 83, 16, 2, '2015-05-08 18:36:50', 2, NULL, NULL),
(84, 84, 17, 1, '2015-05-08 18:36:50', 2, NULL, NULL),
(85, 85, 18, 2, '2015-05-08 18:36:50', 2, NULL, NULL),
(86, 86, 18, 2, '2015-05-08 18:36:50', 2, NULL, NULL),
(87, 87, 18, 2, '2015-05-08 18:36:50', 2, NULL, NULL),
(88, 88, 18, 2, '2015-05-08 18:36:51', 2, NULL, NULL),
(89, 89, 18, 2, '2015-05-08 18:36:51', 2, NULL, NULL),
(90, 90, 19, 2, '2015-05-08 18:36:51', 2, NULL, NULL),
(91, 91, 19, 2, '2015-05-08 18:36:51', 2, NULL, NULL),
(92, 92, 19, 2, '2015-05-08 18:36:51', 2, NULL, NULL),
(93, 93, 19, 2, '2015-05-08 18:36:51', 2, NULL, NULL),
(94, 94, 19, 2, '2015-05-08 18:36:51', 2, NULL, NULL),
(95, 95, 20, 1, '2015-05-08 18:36:51', 2, NULL, NULL),
(96, 96, 21, 2, '2015-05-08 18:36:51', 2, NULL, NULL),
(97, 97, 21, 2, '2015-05-08 18:36:51', 2, NULL, NULL),
(98, 98, 21, 2, '2015-05-08 18:36:52', 2, NULL, NULL),
(99, 99, 21, 2, '2015-05-08 18:36:52', 2, NULL, NULL),
(100, 100, 21, 2, '2015-05-08 18:36:52', 2, NULL, NULL),
(101, 101, 22, 2, '2015-05-08 18:36:52', 2, NULL, NULL),
(102, 102, 22, 2, '2015-05-08 18:36:52', 2, NULL, NULL),
(103, 103, 22, 2, '2015-05-08 18:36:52', 2, NULL, NULL),
(104, 104, 22, 2, '2015-05-08 18:36:52', 2, NULL, NULL),
(105, 105, 22, 2, '2015-05-08 18:36:52', 2, NULL, NULL);

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
(1, '/upload/columns-image/%s4ysperytfcwn61jlxqyy.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 1, NULL),
(2, '/upload/columns-image/%syv5se2tpe2i9r1pviefo.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 1, NULL),
(3, '/upload/columns-image/%sg11ctaogrc5gx0y2tihx.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 1, NULL),
(4, '/upload/columns-image/%sbqxsiceqgj5mbwoux21e.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 2, NULL),
(5, '/upload/columns-image/%s5wltnal6ittkah2ij6zp.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 2, NULL),
(6, '/upload/columns-image/%sgu1hhg149t95gkptk1pt.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 2, NULL),
(7, '/upload/columns-image/%sk94lgwtptj504x7b4z53.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 3, NULL),
(8, '/upload/columns-image/%si5zofe7q5nagm4rtrb8b.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 3, NULL),
(9, '/upload/columns-image/%sl31frzglocex74bd99t4.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 3, NULL),
(10, '/upload/columns-image/%smubzpsi6uh85b0asph33.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 4, NULL),
(11, '/upload/columns-image/%sj8qh2sk1s4w5oxu4g300.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 4, NULL),
(12, '/upload/columns-image/%sazvbpwt44myeleldxw5f.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 4, NULL),
(13, '/upload/columns-image/%sqrb5evzkoqbpgxqvjape.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 5, NULL),
(14, '/upload/columns-image/%sndiyiu16gwcxddtiyjtd.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 5, NULL),
(15, '/upload/columns-image/%szut5h9rr96vma3bjn2fu.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 5, NULL),
(16, '/upload/columns-image/%spihtl01a9lez5xvcwctw.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 6, NULL),
(17, '/upload/columns-image/%s9f9a9akm3q7iyf196t96.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 6, NULL),
(18, '/upload/columns-image/%s5dv00h3nknaks9krav43.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 6, NULL),
(19, '/upload/columns-image/%sb2bz73y3nyzi2l9tt263.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 7, NULL),
(20, '/upload/columns-image/%sf6dy6of69azb210zvpt8.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 7, NULL),
(21, '/upload/columns-image/%seih6ugpd8m6eja3fp9cp.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 7, NULL),
(22, '/upload/columns-image/%s92q1threxad1jky3rd6q.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 8, NULL),
(23, '/upload/columns-image/%sq3v04o6jn8ym0eekmwp9.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 8, NULL),
(24, '/upload/columns-image/%sxs063o0lsx19qmzk1vue.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 8, NULL),
(25, '/upload/columns-image/%stirknvuzi9y5sp1l4sxm.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 9, NULL),
(26, '/upload/columns-image/%sfolw1b7swrwg0dqdza37.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 9, NULL),
(27, '/upload/columns-image/%sas2s7u41crei6q4xr1fd.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 9, NULL),
(28, '/upload/columns-image/%sj2j96zcv06t0omjm7ee9.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 10, NULL),
(29, '/upload/columns-image/%svihrycff3kjcdsc9ifv9.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 10, NULL),
(30, '/upload/columns-image/%sbezpr92od6ozevg2yl8r.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 10, NULL),
(31, '/upload/columns-image/%swhuz0wy81k72oxi5xbk0.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 11, NULL),
(32, '/upload/columns-image/%s7ypbkw4883pvaak0x9zo.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 11, NULL),
(33, '/upload/columns-image/%sjxhykqu7r4yoseq20l0z.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 11, NULL),
(34, '/upload/columns-image/%segkfgv63uvi4iqtt7dqo.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 12, NULL),
(35, '/upload/columns-image/%s7f3qjkiav9zzf95mu1gf.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 12, NULL),
(36, '/upload/columns-image/%smpav6te3wvhu0baalja6.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 12, NULL),
(37, '/upload/columns-image/%sizwoyr1jj7ovnohj7mcu.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 13, NULL),
(38, '/upload/columns-image/%s7keyleywnytwnfacx1l6.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 13, NULL),
(39, '/upload/columns-image/%sz0sdfzmdcpx9z2ya7mxl.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 13, NULL),
(40, '/upload/columns-image/%sbg7pm8saz46pups0f53h.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 14, NULL),
(41, '/upload/columns-image/%skrgaj5bhhysj5qyiogid.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 14, NULL),
(42, '/upload/columns-image/%saftvuclz7f6iwdi68jeg.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 14, NULL),
(43, '/upload/columns-image/%s7wp3cebqljumoe79gjyd.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 15, NULL),
(44, '/upload/columns-image/%sovmbzu7y3b41ykv1pwh0.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 15, NULL),
(45, '/upload/columns-image/%s62dl6akdj9gyvtzkdx87.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 15, NULL),
(46, '/upload/columns-image/%sz3znekeu7ml3eofboqey.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 16, NULL),
(47, '/upload/columns-image/%splma4cl8zj5odu2i5622.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 16, NULL),
(48, '/upload/columns-image/%sjdwor1p6huvx58y0a9y0.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 16, NULL),
(49, '/upload/columns-image/%sjtfne7v94n1dror8f75n.gif', 0, '2015-05-08 18:36:43', 2, NULL, NULL, 17, NULL),
(50, '/upload/columns-image/%srqbnpzdpz1g9llmpj7pd.gif', 1, '2015-05-08 18:36:43', 2, NULL, NULL, 17, NULL),
(51, '/upload/columns-image/%slhh2vz11wxeeefrt5u9v.gif', 2, '2015-05-08 18:36:43', 2, NULL, NULL, 17, NULL),
(52, '/upload/columns-image/%smfuyq6ez4t3f0a7mzzdm.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 18, NULL),
(53, '/upload/columns-image/%smhqqn79js844eosvlwlf.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 18, NULL),
(54, '/upload/columns-image/%sgel7fij58mhkux18v1hd.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 18, NULL),
(55, '/upload/columns-image/%s0c84rrp2e08k5jhasr5q.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 19, NULL),
(56, '/upload/columns-image/%s3d1n0tlmktpavn4c5k59.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 19, NULL),
(57, '/upload/columns-image/%sa3j6dr6v82c154fwnr8x.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 19, NULL),
(58, '/upload/columns-image/%saoxw2szx2uw3o6zrowdm.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 20, NULL),
(59, '/upload/columns-image/%spfelak8n17a2lyoegd29.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 20, NULL),
(60, '/upload/columns-image/%syp3dltvzfycv4h64r5hi.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 20, NULL),
(61, '/upload/columns-image/%s2ibe7qjetbdiq6l2p6rv.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 21, NULL),
(62, '/upload/columns-image/%svuhp1dki9sr10s5y8f2s.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 21, NULL),
(63, '/upload/columns-image/%sg51w2coi964uqbahflqe.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 21, NULL),
(64, '/upload/columns-image/%s376uq2ip7a8d6zzz2e81.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 22, NULL),
(65, '/upload/columns-image/%sa3mr4nzayfesdbdu3l90.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 22, NULL),
(66, '/upload/columns-image/%sm73ixt8py6hz0ugu76vw.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 22, NULL),
(67, '/upload/columns-image/%sc0ff1i0utzk6xefkxd0l.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 23, NULL),
(68, '/upload/columns-image/%sa7a0rhlpd6bfwhlopb89.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 23, NULL),
(69, '/upload/columns-image/%s1j5onazbdpmenn55vgkz.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 23, NULL),
(70, '/upload/columns-image/%sdm50tge8hc79l2nz2d06.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 24, NULL),
(71, '/upload/columns-image/%stdb7r62cdc2gox683a6b.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 24, NULL),
(72, '/upload/columns-image/%sd4apwoeps5mb8n9pk1sn.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 24, NULL),
(73, '/upload/columns-image/%s3kti7qh0rd2u82auhfaz.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 25, NULL),
(74, '/upload/columns-image/%san1800oar6olg7uen145.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 25, NULL),
(75, '/upload/columns-image/%s5xp3pqoxvpmv2eus48tm.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 25, NULL),
(76, '/upload/columns-image/%s57yc5igjabe6yuzeae1w.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 26, NULL),
(77, '/upload/columns-image/%steili34d1npxldzhm5qn.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 26, NULL),
(78, '/upload/columns-image/%s6ujve8zfcr2vwa74318v.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 26, NULL),
(79, '/upload/columns-image/%sfniqr8x43eh0yql3pb9s.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 27, NULL),
(80, '/upload/columns-image/%ss1ee2b9w27i7lro3pbyi.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 27, NULL),
(81, '/upload/columns-image/%sf594mky2mxk5poaip94h.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 27, NULL),
(82, '/upload/columns-image/%s7cfjttd8v1h1xgwark24.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 28, NULL),
(83, '/upload/columns-image/%s8cznqzw6zqextj7d3bco.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 28, NULL),
(84, '/upload/columns-image/%s3kgrq2r8cj3bmso3ibz7.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 28, NULL),
(85, '/upload/columns-image/%sr4vbete7ugmnqt47ll6o.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 29, NULL),
(86, '/upload/columns-image/%svzp7i41q5ronl9opttnd.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 29, NULL),
(87, '/upload/columns-image/%sz0rgjlevxb9j1ph9j8pf.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 29, NULL),
(88, '/upload/columns-image/%sp4s146hnpuqfl7mujrg6.gif', 0, '2015-05-08 18:36:44', 2, NULL, NULL, 30, NULL),
(89, '/upload/columns-image/%ssfgjuni4ly91srsnoz04.gif', 1, '2015-05-08 18:36:44', 2, NULL, NULL, 30, NULL),
(90, '/upload/columns-image/%skgawenho4nlntrxe468g.gif', 2, '2015-05-08 18:36:44', 2, NULL, NULL, 30, NULL);

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
(1, 'gear@pibernetwork.com', '$2y$14$UVCpNcVkyne2uKIyfboCa.Xqc3R5PXJ91RPx4N0/g962O.5q/iznK', '', 1, '1554d2c62f3c457.21001248', '2015-05-08 18:36:34', '2015-05-08 18:36:35', 1, 1, NULL),
(2, 'usuariogear1@gmail.com', '$2y$14$.6S2DFm2otuaV.hbxK6vbeVA/VsNQCdl7tWhp2/1T4HphfBwQJQLK', '', 1, '1554d2c64491e45.69458667', '2015-05-08 18:36:36', '2015-05-08 18:36:36', 2, 2, 2),
(3, 'usuariogear2@gmail.com', '$2y$14$j9jwkZJ21gknTf1uYNks2OOjbZyTiuG1uEza31icRmRVGw.GnSrJW', '', 1, '1554d2c658c6a14.52206344', '2015-05-08 18:36:37', '2015-05-08 18:36:37', 3, 3, 2),
(4, 'usuariogear3@gmail.com', '$2y$14$Nf85zdx3AZEbgsrSiwfD9.xTktNjC9C33AMmEcuxVpqXlZ35S1Qde', '', 1, '1554d2c66dd3a58.71689480', '2015-05-08 18:36:38', '2015-05-08 18:36:38', 4, 4, 2),
(5, 'usuariogear4@gmail.com', '$2y$14$DLXZr3MtxXhrjTY822BeqeVO.ne8FR4qeu3VT9ZFdWAWWvSkxb5J2', '', 1, '1554d2c682cbfb8.69634343', '2015-05-08 18:36:40', '2015-05-08 18:36:40', 5, 5, 2),
(6, 'usuariogear5@gmail.com', '$2y$14$MqVXrB/L4nLDYeTg4M86.Oxz5JC8qfun7QRxFKRh93GJ4xkPAwGJ.', '', 1, '1554d2c6987a450.54277592', '2015-05-08 18:36:41', '2015-05-08 18:36:41', 6, 6, 2),
(7, 'usuariogear6@gmail.com', '$2y$14$h0zMELq.Ac71mj1fsiXCEe0l/doDCRXX8cYLI2ZRzWT9Rc2sA/KQG', '', 1, '1554d2c6ad029a1.45814127', '2015-05-08 18:36:42', '2015-05-08 18:36:42', 7, 7, 2);

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
  ADD CONSTRAINT `fk_columns_not_null_1` FOREIGN KEY (`column_foreign_key_copy_not_null`) REFERENCES `foreign_keys_copy` (`id_foreign_keys_copy`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `foreign_keys_copy`
--
ALTER TABLE `foreign_keys_copy`
  ADD CONSTRAINT `foreign_keys_ibfk_10` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_keys_ibfk_20` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_upload_image_1` FOREIGN KEY (`id_columns_image`) REFERENCES `columns_image` (`id_columns_image`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_upload_image_2` FOREIGN KEY (`id_columns_standard_upload_image`) REFERENCES `columns_standard_upload_image` (`id_columns_standard_upload_image`) ON DELETE CASCADE ON UPDATE CASCADE,
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
