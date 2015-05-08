-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2015 at 01:59 PM
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
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_action`),
  KEY `id_controller` (`id_controller`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id_action`, `id_controller`, `name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 1, 'AutoincrementDatabase', '2015-05-03 13:50:54', 2, NULL, NULL),
(2, 1, 'DropTable', '2015-05-03 13:50:54', 2, NULL, NULL),
(3, 1, 'GetOrder', '2015-05-03 13:50:54', 2, NULL, NULL),
(4, 1, 'AnalyseDatabase', '2015-05-03 13:50:54', 2, NULL, NULL),
(5, 1, 'AnalyseTable', '2015-05-03 13:50:54', 2, NULL, NULL),
(6, 1, 'AutoincrementTable', '2015-05-03 13:50:54', 2, NULL, NULL),
(7, 1, 'ClearTable', '2015-05-03 13:50:54', 2, NULL, NULL),
(8, 1, 'CreateColumn', '2015-05-03 13:50:54', 2, NULL, NULL),
(9, 1, 'FixDatabase', '2015-05-03 13:50:54', 2, NULL, NULL),
(10, 1, 'FixTable', '2015-05-03 13:50:54', 2, NULL, NULL),
(11, 1, 'MysqlLoad', '2015-05-03 13:50:54', 2, NULL, NULL),
(12, 1, 'MysqlDump', '2015-05-03 13:50:54', 2, NULL, NULL),
(13, 1, 'Fixture', '2015-05-03 13:50:54', 2, NULL, NULL),
(14, 2, 'Build', '2015-05-03 13:50:54', 2, NULL, NULL),
(15, 3, 'Action', '2015-05-03 13:50:54', 2, NULL, NULL),
(16, 3, 'Controller', '2015-05-03 13:50:54', 2, NULL, NULL),
(17, 3, 'Db', '2015-05-03 13:50:54', 2, NULL, NULL),
(18, 3, 'Src', '2015-05-03 13:50:54', 2, NULL, NULL),
(19, 3, 'Test', '2015-05-03 13:50:54', 2, NULL, NULL),
(20, 3, 'View', '2015-05-03 13:50:54', 2, NULL, NULL),
(21, 4, 'Entities', '2015-05-03 13:50:54', 2, NULL, NULL),
(22, 4, 'Entity', '2015-05-03 13:50:54', 2, NULL, NULL),
(23, 4, 'Dump', '2015-05-03 13:50:54', 2, NULL, NULL),
(24, 4, 'Create', '2015-05-03 13:50:54', 2, NULL, NULL),
(25, 4, 'Delete', '2015-05-03 13:50:54', 2, NULL, NULL),
(26, 4, 'Load', '2015-05-03 13:50:54', 2, NULL, NULL),
(27, 4, 'Unload', '2015-05-03 13:50:54', 2, NULL, NULL),
(28, 4, 'Build', '2015-05-03 13:50:54', 2, NULL, NULL),
(29, 4, 'Push', '2015-05-03 13:50:54', 2, NULL, NULL),
(30, 4, 'Light', '2015-05-03 13:50:54', 2, NULL, NULL),
(31, 4, 'Jenkins', '2015-05-03 13:50:54', 2, NULL, NULL),
(32, 4, 'DumpAutoload', '2015-05-03 13:50:54', 2, NULL, NULL),
(33, 5, 'Deploy', '2015-05-03 13:50:54', 2, NULL, NULL),
(34, 5, 'Push', '2015-05-03 13:50:54', 2, NULL, NULL),
(35, 5, 'Build', '2015-05-03 13:50:54', 2, NULL, NULL),
(36, 5, 'Mysql2sqlite', '2015-05-03 13:50:54', 2, NULL, NULL),
(37, 5, 'ResetAcl', '2015-05-03 13:50:54', 2, NULL, NULL),
(38, 5, 'Acl', '2015-05-03 13:50:54', 2, NULL, NULL),
(39, 5, 'Config', '2015-05-03 13:50:55', 2, NULL, NULL),
(40, 5, 'Dump', '2015-05-03 13:50:55', 2, NULL, NULL),
(41, 5, 'Environment', '2015-05-03 13:50:55', 2, NULL, NULL),
(42, 5, 'Global', '2015-05-03 13:50:55', 2, NULL, NULL),
(43, 5, 'Local', '2015-05-03 13:50:55', 2, NULL, NULL),
(44, 5, 'Mysql', '2015-05-03 13:50:55', 2, NULL, NULL),
(45, 5, 'Project', '2015-05-03 13:50:55', 2, NULL, NULL),
(46, 5, 'Sqlite', '2015-05-03 13:50:55', 2, NULL, NULL),
(47, 5, 'Fixture', '2015-05-03 13:50:55', 2, NULL, NULL),
(48, 5, 'Jenkins', '2015-05-03 13:50:55', 2, NULL, NULL),
(49, 6, 'Acl', '2015-05-03 13:50:55', 2, NULL, NULL),
(50, 6, 'ResetAcl', '2015-05-03 13:50:55', 2, NULL, NULL),
(51, 7, 'ModuleVersion', '2015-05-03 13:50:55', 2, NULL, NULL),
(52, 7, 'ProjectVersion', '2015-05-03 13:50:55', 2, NULL, NULL),
(53, 8, 'Index', '2015-05-03 13:50:55', 2, NULL, NULL),
(54, 9, 'Index', '2015-05-03 13:50:55', 2, NULL, NULL),
(55, 10, 'Login', '2015-05-03 13:50:55', 2, NULL, NULL),
(56, 10, 'SendPasswordRecoveryRequest', '2015-05-03 13:50:56', 2, NULL, NULL),
(57, 10, 'PasswordRecoveryRequestSent', '2015-05-03 13:50:56', 2, NULL, NULL),
(58, 10, 'PasswordRecovery', '2015-05-03 13:50:56', 2, NULL, NULL),
(59, 10, 'PasswordRecoverySuccessful', '2015-05-03 13:50:56', 2, NULL, NULL),
(60, 10, 'Index', '2015-05-03 13:50:56', 2, NULL, NULL),
(61, 10, 'ChangePassword', '2015-05-03 13:50:56', 2, NULL, NULL),
(62, 10, 'ChangePasswordSuccessful', '2015-05-03 13:50:56', 2, NULL, NULL),
(63, 10, 'Logout', '2015-05-03 13:50:56', 2, NULL, NULL),
(64, 10, 'InvalidLink', '2015-05-03 13:50:56', 2, NULL, NULL),
(65, 11, 'Register', '2015-05-03 13:50:56', 2, NULL, NULL),
(66, 11, 'Acl', '2015-05-03 13:50:56', 2, NULL, NULL),
(67, 12, 'Index', '2015-05-03 13:50:56', 2, NULL, NULL),
(68, 13, 'ListarImagem', '2015-05-03 13:50:56', 2, NULL, NULL),
(69, 13, 'ExcluirImagem', '2015-05-03 13:50:57', 2, NULL, NULL),
(70, 13, 'SalvarImagem', '2015-05-03 13:50:57', 2, NULL, NULL),
(71, 14, 'Create', '2015-05-03 13:50:57', 2, NULL, NULL),
(72, 14, 'Edit', '2015-05-03 13:50:57', 2, NULL, NULL),
(73, 14, 'List', '2015-05-03 13:50:57', 2, NULL, NULL),
(74, 14, 'Delete', '2015-05-03 13:50:57', 2, NULL, NULL),
(75, 14, 'View', '2015-05-03 13:50:57', 2, NULL, NULL),
(76, 15, 'Index', '2015-05-03 13:50:57', 2, NULL, NULL),
(77, 16, 'Create', '2015-05-03 13:50:57', 2, NULL, NULL),
(78, 16, 'Edit', '2015-05-03 13:50:57', 2, NULL, NULL),
(79, 16, 'List', '2015-05-03 13:50:57', 2, NULL, NULL),
(80, 16, 'Delete', '2015-05-03 13:50:57', 2, NULL, NULL),
(81, 16, 'View', '2015-05-03 13:50:57', 2, NULL, NULL),
(82, 17, 'Create', '2015-05-03 13:50:58', 2, NULL, NULL),
(83, 17, 'Edit', '2015-05-03 13:50:58', 2, NULL, NULL),
(84, 17, 'List', '2015-05-03 13:50:58', 2, NULL, NULL),
(85, 17, 'Delete', '2015-05-03 13:50:58', 2, NULL, NULL),
(86, 17, 'View', '2015-05-03 13:50:58', 2, NULL, NULL);

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
  `column_varchar` varchar(100) DEFAULT NULL,
  `column_longtext` longtext,
  `column_text` text,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  `column_datetime_pt_br` datetime DEFAULT NULL,
  `column_date_pt_br` date DEFAULT NULL,
  `column_decimal_pt_br` decimal(10,2) DEFAULT NULL,
  `column_int_checkbox` int(11) DEFAULT NULL,
  `column_tinyint_checkbox` tinyint(4) DEFAULT NULL,
  `column_varchar_email` varchar(100) DEFAULT NULL,
  `column_varchar_password_verify` varchar(100) DEFAULT NULL,
  `column_varchar_unique_id` varchar(100) DEFAULT NULL,
  `column_varchar_upload_image` varchar(100) DEFAULT NULL,
  `column_foreign_key` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_columns`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `fk_columns_1` (`column_foreign_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `columns`
--

INSERT INTO `columns` (`id_columns`, `column_date`, `column_datetime`, `column_time`, `column_int`, `column_tinyint`, `column_decimal`, `column_varchar`, `column_longtext`, `column_text`, `created`, `updated`, `created_by`, `updated_by`, `column_datetime_pt_br`, `column_date_pt_br`, `column_decimal_pt_br`, `column_int_checkbox`, `column_tinyint_checkbox`, `column_varchar_email`, `column_varchar_password_verify`, `column_varchar_unique_id`, `column_varchar_upload_image`, `column_foreign_key`) VALUES
(1, '2020-12-01', '2020-12-01 01:00:02', '01:00:02', 1, 1, 1.10, '01Column Varchar', '01Column Longtext', '01Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-01 01:00:02', '2020-12-01', 1.10, 1, 1, 'column.varchar.email01@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da94afd4.11602081', '/upload/columns-columnVarcharUploadImage/%s01columnVarcharUploadImage.gif', 1),
(2, '2020-12-02', '2020-12-02 02:00:02', '02:00:02', 2, 2, 2.20, '02Column Varchar', '02Column Longtext', '02Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-02 02:00:02', '2020-12-02', 2.20, 0, 0, 'column.varchar.email02@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da951ad1.41057901', '/upload/columns-columnVarcharUploadImage/%s02columnVarcharUploadImage.gif', 2),
(3, '2020-12-03', '2020-12-03 03:00:02', '03:00:02', 3, 3, 3.30, '03Column Varchar', '03Column Longtext', '03Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-03 03:00:02', '2020-12-03', 3.30, 1, 1, 'column.varchar.email03@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9580f3.67604689', '/upload/columns-columnVarcharUploadImage/%s03columnVarcharUploadImage.gif', 3),
(4, '2020-12-04', '2020-12-04 04:00:02', '04:00:02', 4, 4, 4.40, '04Column Varchar', '04Column Longtext', '04Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-04 04:00:02', '2020-12-04', 4.40, 0, 0, 'column.varchar.email04@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da95f2c9.76171307', '/upload/columns-columnVarcharUploadImage/%s04columnVarcharUploadImage.gif', 4),
(5, '2020-12-05', '2020-12-05 05:00:02', '05:00:02', 5, 5, 5.50, '05Column Varchar', '05Column Longtext', '05Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-05 05:00:02', '2020-12-05', 5.50, 1, 1, 'column.varchar.email05@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da965c44.79854323', '/upload/columns-columnVarcharUploadImage/%s05columnVarcharUploadImage.gif', 5),
(6, '2020-12-06', '2020-12-06 06:00:02', '06:00:02', 6, 6, 6.60, '06Column Varchar', '06Column Longtext', '06Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-06 06:00:02', '2020-12-06', 6.60, 0, 0, 'column.varchar.email06@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da96d3a9.73991338', '/upload/columns-columnVarcharUploadImage/%s06columnVarcharUploadImage.gif', 6),
(7, '2020-12-07', '2020-12-07 07:00:02', '07:00:02', 7, 7, 7.70, '07Column Varchar', '07Column Longtext', '07Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-07 07:00:02', '2020-12-07', 7.70, 1, 1, 'column.varchar.email07@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9747f0.65028825', '/upload/columns-columnVarcharUploadImage/%s07columnVarcharUploadImage.gif', 7),
(8, '2020-12-08', '2020-12-08 08:00:02', '08:00:02', 8, 8, 8.80, '08Column Varchar', '08Column Longtext', '08Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-08 08:00:02', '2020-12-08', 8.80, 0, 0, 'column.varchar.email08@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da97e802.00040592', '/upload/columns-columnVarcharUploadImage/%s08columnVarcharUploadImage.gif', 8),
(9, '2020-12-09', '2020-12-09 09:00:02', '09:00:02', 9, 9, 9.90, '09Column Varchar', '09Column Longtext', '09Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-09 09:00:02', '2020-12-09', 9.90, 1, 1, 'column.varchar.email09@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da985248.83946819', '/upload/columns-columnVarcharUploadImage/%s09columnVarcharUploadImage.gif', 9),
(10, '2020-12-10', '2020-12-10 10:00:02', '10:00:02', 10, 10, 10.10, '10Column Varchar', '10Column Longtext', '10Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-10 10:00:02', '2020-12-10', 10.10, 0, 0, 'column.varchar.email10@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da98c452.56123647', '/upload/columns-columnVarcharUploadImage/%s10columnVarcharUploadImage.gif', 10),
(11, '2020-12-11', '2020-12-11 11:00:02', '11:00:02', 11, 11, 11.11, '11Column Varchar', '11Column Longtext', '11Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-11 11:00:02', '2020-12-11', 11.11, 1, 1, 'column.varchar.email11@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da992ee3.53794702', '/upload/columns-columnVarcharUploadImage/%s11columnVarcharUploadImage.gif', 11),
(12, '2020-12-12', '2020-12-12 12:00:02', '12:00:02', 12, 12, 12.12, '12Column Varchar', '12Column Longtext', '12Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-12 12:00:02', '2020-12-12', 12.12, 0, 0, 'column.varchar.email12@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9993c7.92314792', '/upload/columns-columnVarcharUploadImage/%s12columnVarcharUploadImage.gif', 12),
(13, '2020-12-13', '2020-12-13 13:00:02', '13:00:02', 13, 13, 13.13, '13Column Varchar', '13Column Longtext', '13Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-13 13:00:02', '2020-12-13', 13.13, 1, 1, 'column.varchar.email13@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da99fc42.31338589', '/upload/columns-columnVarcharUploadImage/%s13columnVarcharUploadImage.gif', 13),
(14, '2020-12-14', '2020-12-14 14:00:02', '14:00:02', 14, 14, 14.14, '14Column Varchar', '14Column Longtext', '14Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-14 14:00:02', '2020-12-14', 14.14, 0, 0, 'column.varchar.email14@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9a6208.62938869', '/upload/columns-columnVarcharUploadImage/%s14columnVarcharUploadImage.gif', 14),
(15, '2020-12-15', '2020-12-15 15:00:02', '15:00:02', 15, 15, 15.15, '15Column Varchar', '15Column Longtext', '15Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-15 15:00:02', '2020-12-15', 15.15, 1, 1, 'column.varchar.email15@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9ac8c7.34587537', '/upload/columns-columnVarcharUploadImage/%s15columnVarcharUploadImage.gif', 15),
(16, '2020-12-16', '2020-12-16 16:00:02', '16:00:02', 16, 16, 16.16, '16Column Varchar', '16Column Longtext', '16Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-16 16:00:02', '2020-12-16', 16.16, 0, 0, 'column.varchar.email16@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9b2ed9.10661663', '/upload/columns-columnVarcharUploadImage/%s16columnVarcharUploadImage.gif', 16),
(17, '2020-12-17', '2020-12-17 17:00:02', '17:00:02', 17, 17, 17.17, '17Column Varchar', '17Column Longtext', '17Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-17 17:00:02', '2020-12-17', 17.17, 1, 1, 'column.varchar.email17@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9b9dd3.24189795', '/upload/columns-columnVarcharUploadImage/%s17columnVarcharUploadImage.gif', 17),
(18, '2020-12-18', '2020-12-18 18:00:02', '18:00:02', 18, 18, 18.18, '18Column Varchar', '18Column Longtext', '18Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-18 18:00:02', '2020-12-18', 18.18, 0, 0, 'column.varchar.email18@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9c0144.37007212', '/upload/columns-columnVarcharUploadImage/%s18columnVarcharUploadImage.gif', 18),
(19, '2020-12-19', '2020-12-19 19:00:02', '19:00:02', 19, 19, 19.19, '19Column Varchar', '19Column Longtext', '19Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-19 19:00:02', '2020-12-19', 19.19, 1, 1, 'column.varchar.email19@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9c63c2.07395179', '/upload/columns-columnVarcharUploadImage/%s19columnVarcharUploadImage.gif', 19),
(20, '2020-12-20', '2020-12-20 20:00:02', '20:00:02', 20, 20, 20.20, '20Column Varchar', '20Column Longtext', '20Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-20 20:00:02', '2020-12-20', 20.20, 0, 0, 'column.varchar.email20@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9ccad6.70774642', '/upload/columns-columnVarcharUploadImage/%s20columnVarcharUploadImage.gif', 20),
(21, '2020-12-21', '2020-12-21 21:00:02', '21:00:02', 21, 21, 21.21, '21Column Varchar', '21Column Longtext', '21Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-21 21:00:02', '2020-12-21', 21.21, 1, 1, 'column.varchar.email21@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9d34f7.55088444', '/upload/columns-columnVarcharUploadImage/%s21columnVarcharUploadImage.gif', 21),
(22, '2020-12-22', '2020-12-22 22:00:02', '22:00:02', 22, 22, 22.22, '22Column Varchar', '22Column Longtext', '22Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-22 22:00:02', '2020-12-22', 22.22, 0, 0, 'column.varchar.email22@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9d9f20.40778504', '/upload/columns-columnVarcharUploadImage/%s22columnVarcharUploadImage.gif', 22),
(23, '2020-12-23', '2020-12-23 23:00:02', '23:00:02', 23, 23, 23.23, '23Column Varchar', '23Column Longtext', '23Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-23 23:00:02', '2020-12-23', 23.23, 1, 1, 'column.varchar.email23@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9e0650.90593814', '/upload/columns-columnVarcharUploadImage/%s23columnVarcharUploadImage.gif', 23),
(24, '2020-12-24', '2020-12-24 06:00:02', '06:00:02', 24, 24, 24.24, '24Column Varchar', '24Column Longtext', '24Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-24 06:00:02', '2020-12-24', 24.24, 0, 0, 'column.varchar.email24@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9e7882.94052933', '/upload/columns-columnVarcharUploadImage/%s24columnVarcharUploadImage.gif', 24),
(25, '2020-12-25', '2020-12-25 05:00:02', '05:00:02', 25, 25, 25.25, '25Column Varchar', '25Column Longtext', '25Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-25 05:00:02', '2020-12-25', 25.25, 1, 1, 'column.varchar.email25@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9edc09.98034056', '/upload/columns-columnVarcharUploadImage/%s25columnVarcharUploadImage.gif', 25),
(26, '2020-12-26', '2020-12-26 04:00:02', '04:00:02', 26, 26, 26.26, '26Column Varchar', '26Column Longtext', '26Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-26 04:00:02', '2020-12-26', 26.26, 0, 0, 'column.varchar.email26@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9f7151.70764865', '/upload/columns-columnVarcharUploadImage/%s26columnVarcharUploadImage.gif', 26),
(27, '2020-12-27', '2020-12-27 03:00:02', '03:00:02', 27, 27, 27.27, '27Column Varchar', '27Column Longtext', '27Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-27 03:00:02', '2020-12-27', 27.27, 1, 1, 'column.varchar.email27@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651da9fd593.36916401', '/upload/columns-columnVarcharUploadImage/%s27columnVarcharUploadImage.gif', 27),
(28, '2020-12-28', '2020-12-28 02:00:02', '02:00:02', 28, 28, 28.28, '28Column Varchar', '28Column Longtext', '28Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-28 02:00:02', '2020-12-28', 28.28, 0, 0, 'column.varchar.email28@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651daa03d80.10283004', '/upload/columns-columnVarcharUploadImage/%s28columnVarcharUploadImage.gif', 28),
(29, '2020-12-29', '2020-12-29 01:00:02', '01:00:02', 29, 29, 29.29, '29Column Varchar', '29Column Longtext', '29Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-29 01:00:02', '2020-12-29', 29.29, 1, 1, 'column.varchar.email29@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651daa0afe3.40926628', '/upload/columns-columnVarcharUploadImage/%s29columnVarcharUploadImage.gif', 29),
(30, '2020-12-30', '2020-12-30 00:00:02', '00:00:02', 30, 30, 30.30, '30Column Varchar', '30Column Longtext', '30Column Text', '2015-05-03 13:50:53', NULL, 2, NULL, '2020-12-30 00:00:02', '2020-12-30', 30.30, 0, 0, 'column.varchar.email30@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554651daa13bc4.70473639', '/upload/columns-columnVarcharUploadImage/%s30columnVarcharUploadImage.gif', 30);

-- --------------------------------------------------------

--
-- Table structure for table `controller`
--

CREATE TABLE IF NOT EXISTS `controller` (
  `id_controller` int(11) NOT NULL AUTO_INCREMENT,
  `id_module` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `invokable` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_controller`),
  KEY `id_module` (`id_module`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `controller`
--

INSERT INTO `controller` (`id_controller`, `id_module`, `name`, `invokable`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 1, 'Db', 'Gear\\Controller\\Db', '2015-05-03 13:50:54', 2, NULL, NULL),
(2, 1, 'Build', 'Gear\\Controller\\Build', '2015-05-03 13:50:54', 2, NULL, NULL),
(3, 1, 'Constructor', 'Gear\\Controller\\Constructor', '2015-05-03 13:50:54', 2, NULL, NULL),
(4, 1, 'Module', 'Gear\\Controller\\Module', '2015-05-03 13:50:54', 2, NULL, NULL),
(5, 1, 'Project', 'Gear\\Controller\\Project', '2015-05-03 13:50:54', 2, NULL, NULL),
(6, 2, 'ProjectController', 'GearAcl\\Controller\\Project', '2015-05-03 13:50:55', 2, NULL, NULL),
(7, 3, 'VersionController', 'GearVersion\\Controller\\Version', '2015-05-03 13:50:55', 2, NULL, NULL),
(8, 4, 'IndexController', 'GearJson\\Controller\\Index', '2015-05-03 13:50:55', 2, NULL, NULL),
(9, 5, 'IndexController', 'GearBackup\\Controller\\Index', '2015-05-03 13:50:55', 2, NULL, NULL),
(10, 6, 'Index', 'GearAdmin\\Controller\\Index', '2015-05-03 13:50:55', 2, NULL, NULL),
(11, 6, 'User', 'GearAdmin\\Controller\\User', '2015-05-03 13:50:56', 2, NULL, NULL),
(12, 7, 'Index', 'GearImage\\Controller\\Index', '2015-05-03 13:50:56', 2, NULL, NULL),
(13, 7, 'Imagem', 'GearImage\\Controller\\Imagem', '2015-05-03 13:50:56', 2, NULL, NULL),
(14, 7, 'MarcaController', 'GearImage\\Controller\\Marca', '2015-05-03 13:50:57', 2, NULL, NULL),
(15, 8, 'IndexController', 'Column\\Controller\\Index', '2015-05-03 13:50:57', 2, NULL, NULL),
(16, 8, 'ColumnsController', 'Column\\Controller\\Columns', '2015-05-03 13:50:57', 2, NULL, NULL),
(17, 8, 'ForeignKeysController', 'Column\\Controller\\ForeignKeys', '2015-05-03 13:50:58', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `remetente` varchar(255) NOT NULL,
  `destino` varchar(255) NOT NULL,
  `assunto` varchar(255) NOT NULL,
  `mensagem` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_email`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `foreign_keys`
--

CREATE TABLE IF NOT EXISTS `foreign_keys` (
  `id_foreign_keys` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_foreign_keys`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `foreign_keys`
--

INSERT INTO `foreign_keys` (`id_foreign_keys`, `name`, `created`, `updated`, `created_by`, `updated_by`) VALUES
(1, '01Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(2, '02Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(3, '03Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(4, '04Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(5, '05Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(6, '06Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(7, '07Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(8, '08Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(9, '09Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(10, '10Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(11, '11Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(12, '12Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(13, '13Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(14, '14Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(15, '15Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(16, '16Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(17, '17Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(18, '18Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(19, '19Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(20, '20Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(21, '21Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(22, '22Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(23, '23Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(24, '24Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(25, '25Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(26, '26Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(27, '27Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(28, '28Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(29, '29Name', '2015-05-03 13:50:53', NULL, 2, NULL),
(30, '30Name', '2015-05-03 13:50:53', NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_module`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id_module`, `name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 'Gear', '2015-05-03 13:50:54', 2, NULL, NULL),
(2, 'GearAcl', '2015-05-03 13:50:55', 2, NULL, NULL),
(3, 'GearVersion', '2015-05-03 13:50:55', 2, NULL, NULL),
(4, 'GearJson', '2015-05-03 13:50:55', 2, NULL, NULL),
(5, 'GearBackup', '2015-05-03 13:50:55', 2, NULL, NULL),
(6, 'GearAdmin', '2015-05-03 13:50:55', 2, NULL, NULL),
(7, 'GearImage', '2015-05-03 13:50:56', 2, NULL, NULL),
(8, 'Column', '2015-05-03 13:50:57', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `name` (`name`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `id_parent` (`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `id_parent`, `name`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, NULL, 'guest', '2015-05-03 13:50:53', 2, NULL, NULL),
(2, 1, 'admin', '2015-05-03 13:50:53', 2, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id_rule`, `id_action`, `id_controller`, `id_role`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1, 1, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(2, 2, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(3, 3, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(4, 4, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(5, 5, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(6, 6, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(7, 7, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(8, 8, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(9, 9, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(10, 10, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(11, 11, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(12, 12, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(13, 13, 1, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(14, 14, 2, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(15, 15, 3, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(16, 16, 3, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(17, 17, 3, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(18, 18, 3, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(19, 19, 3, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(20, 20, 3, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(21, 21, 4, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(22, 22, 4, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(23, 23, 4, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(24, 24, 4, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(25, 25, 4, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(26, 26, 4, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(27, 27, 4, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(28, 28, 4, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(29, 29, 4, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(30, 30, 4, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(31, 31, 4, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(32, 32, 4, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(33, 33, 5, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(34, 34, 5, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(35, 35, 5, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(36, 36, 5, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(37, 37, 5, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(38, 38, 5, 1, '2015-05-03 13:50:54', 2, NULL, NULL),
(39, 39, 5, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(40, 40, 5, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(41, 41, 5, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(42, 42, 5, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(43, 43, 5, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(44, 44, 5, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(45, 45, 5, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(46, 46, 5, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(47, 47, 5, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(48, 48, 5, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(49, 49, 6, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(50, 50, 6, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(51, 51, 7, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(52, 52, 7, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(53, 53, 8, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(54, 54, 9, 1, '2015-05-03 13:50:55', 2, NULL, NULL),
(55, 55, 10, 1, '2015-05-03 13:50:56', 2, NULL, NULL),
(56, 56, 10, 1, '2015-05-03 13:50:56', 2, NULL, NULL),
(57, 57, 10, 1, '2015-05-03 13:50:56', 2, NULL, NULL),
(58, 58, 10, 1, '2015-05-03 13:50:56', 2, NULL, NULL),
(59, 59, 10, 1, '2015-05-03 13:50:56', 2, NULL, NULL),
(60, 60, 10, 2, '2015-05-03 13:50:56', 2, NULL, NULL),
(61, 61, 10, 2, '2015-05-03 13:50:56', 2, NULL, NULL),
(62, 62, 10, 2, '2015-05-03 13:50:56', 2, NULL, NULL),
(63, 63, 10, 2, '2015-05-03 13:50:56', 2, NULL, NULL),
(64, 64, 10, 1, '2015-05-03 13:50:56', 2, NULL, NULL),
(65, 65, 11, 1, '2015-05-03 13:50:56', 2, NULL, NULL),
(66, 66, 11, 1, '2015-05-03 13:50:56', 2, NULL, NULL),
(67, 67, 12, 1, '2015-05-03 13:50:56', 2, NULL, NULL),
(68, 68, 13, 1, '2015-05-03 13:50:56', 2, NULL, NULL),
(69, 69, 13, 1, '2015-05-03 13:50:57', 2, NULL, NULL),
(70, 70, 13, 1, '2015-05-03 13:50:57', 2, NULL, NULL),
(71, 71, 14, 2, '2015-05-03 13:50:57', 2, NULL, NULL),
(72, 72, 14, 2, '2015-05-03 13:50:57', 2, NULL, NULL),
(73, 73, 14, 2, '2015-05-03 13:50:57', 2, NULL, NULL),
(74, 74, 14, 2, '2015-05-03 13:50:57', 2, NULL, NULL),
(75, 75, 14, 2, '2015-05-03 13:50:57', 2, NULL, NULL),
(76, 76, 15, 1, '2015-05-03 13:50:57', 2, NULL, NULL),
(77, 77, 16, 2, '2015-05-03 13:50:57', 2, NULL, NULL),
(78, 78, 16, 2, '2015-05-03 13:50:57', 2, NULL, NULL),
(79, 79, 16, 2, '2015-05-03 13:50:57', 2, NULL, NULL),
(80, 80, 16, 2, '2015-05-03 13:50:57', 2, NULL, NULL),
(81, 81, 16, 2, '2015-05-03 13:50:58', 2, NULL, NULL),
(82, 82, 17, 2, '2015-05-03 13:50:58', 2, NULL, NULL),
(83, 83, 17, 2, '2015-05-03 13:50:58', 2, NULL, NULL),
(84, 84, 17, 2, '2015-05-03 13:50:58', 2, NULL, NULL),
(85, 85, 17, 2, '2015-05-03 13:50:58', 2, NULL, NULL),
(86, 86, 17, 2, '2015-05-03 13:50:58', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `test_upload_image`
--

CREATE TABLE IF NOT EXISTS `test_upload_image` (
  `id_test_upload_image` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_test_upload_image`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `upload_image`
--

CREATE TABLE IF NOT EXISTS `upload_image` (
  `id_upload_image` int(11) NOT NULL AUTO_INCREMENT,
  `upload_image` varchar(255) NOT NULL,
  `ordination` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_upload_image`),
  UNIQUE KEY `upload_image` (`upload_image`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `state` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `username`, `state`, `uid`, `created`, `updated`, `created_by`, `updated_by`, `id_role`) VALUES
(1, 'gear@pibernetwork.com', '$2y$14$9ObE0c7BWWHdKVcqT.tvaO1kT5pco8cOvXLy7eNMzKIip8g0iWlU2', '', 1, '1554651e5795308.09172029', '2015-05-03 13:50:45', '2015-05-03 13:50:45', 1, 1, NULL),
(2, 'usuariogear1@gmail.com', '$2y$14$U7pfjNAs0K7hLsl7npfqluQzKBxUXdydKgV9GvwoUOqXSxFaxFwA2', '', 1, '1554651e6b9b023.40765940', '2015-05-03 13:50:46', '2015-05-03 13:50:46', 2, 2, 2),
(3, 'usuariogear2@gmail.com', '$2y$14$nqTPbPeW/YWxqU5TaKdoMett8Ux5K8Y2huSC2o3SwcfZvMwlOv49S', '', 1, '1554651e8062217.49461911', '2015-05-03 13:50:48', '2015-05-03 13:50:48', 3, 3, 2),
(4, 'usuariogear3@gmail.com', '$2y$14$2Lr7./Ieeec8A77WE2Fuj.UnlJRFzeJY7Q49lr5PWRSf0JgfYFEaK', '', 1, '1554651e9454201.28118449', '2015-05-03 13:50:49', '2015-05-03 13:50:49', 4, 4, 2),
(5, 'usuariogear4@gmail.com', '$2y$14$Pz3663WakKqk01sHhpDBkuA.tRfXR6RKiCf8q5k4PljZ/gK.caObe', '', 1, '1554651ea83c374.37273758', '2015-05-03 13:50:50', '2015-05-03 13:50:50', 5, 5, 2),
(6, 'usuariogear5@gmail.com', '$2y$14$hPWuJ32ZA8mwEVqQwfCsVOzR7dXZ.YnoBOHogSyfw4T4bt2Y5x31a', '', 1, '1554651ebc60287.11324415', '2015-05-03 13:50:51', '2015-05-03 13:50:51', 6, 6, 2),
(7, 'usuariogear6@gmail.com', '$2y$14$K7.SYB46Ub2LhK2wnutI9euMknaviUfVYzqblWSptqTFOeAfT/Jti', '', 1, '1554651ed21e377.73872956', '2015-05-03 13:50:53', '2015-05-03 13:50:53', 7, 7, 2);

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
