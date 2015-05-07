-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 05, 2015 at 06:16 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `column_varchar_not_null` varchar(100) NOT NULL,
  `column_longtext_not_null` longtext NOT NULL,
  `column_text_not_null` text,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  `column_datetime_pt_br_not_null` datetime NOT NULL,
  `column_date_pt_br_not_null` date NOT NULL,
  `column_decimal_pt_br_not_null` decimal(10,2) NOT NULL,
  `column_int_checkbox_not_null` int(11) NOT NULL,
  `column_tinyint_checkbox_not_null` tinyint(4) NOT NULL,
  `column_varchar_email_not_null` varchar(100) NOT NULL,
  `column_varchar_password_verify_not_null` varchar(100) NOT NULL,
  `column_varchar_unique_id_not_null` varchar(100) NOT NULL,
  `column_varchar_upload_image_not_null` varchar(100) DEFAULT NULL,
  `column_foreign_key_not_null` int(11) NOT NULL,
  PRIMARY KEY (`id_columns_not_null`),
  KEY `columns_not_null_ibfk_1` (`created_by`),
  KEY `columns_not_null_ibfk_2` (`updated_by`),
  KEY `fk_columns_not_null_1` (`column_foreign_key_not_null`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `columns_not_null`
--

INSERT INTO `columns_not_null` (`id_columns_not_null`, `column_date_not_null`, `column_datetime_not_null`, `column_time_not_null`, `column_int_not_null`, `column_tinyint_not_null`, `column_decimal_not_null`, `column_varchar_not_null`, `column_longtext_not_null`, `column_text_not_null`, `created`, `updated`, `created_by`, `updated_by`, `column_datetime_pt_br_not_null`, `column_date_pt_br_not_null`, `column_decimal_pt_br_not_null`, `column_int_checkbox_not_null`, `column_tinyint_checkbox_not_null`, `column_varchar_email_not_null`, `column_varchar_password_verify_not_null`, `column_varchar_unique_id_not_null`, `column_varchar_upload_image_not_null`, `column_foreign_key_not_null`) VALUES
(1, '2020-12-01', '2020-12-01 01:00:02', '01:00:02', 1, 1, 1.10, '01Column Varchar Not Null', '01Column Longtext Not Null', '01Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-01 01:00:02', '2020-12-01', 1.10, 1, 1, 'column.varchar.email.not.null01@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36d42cd4.25399009', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s01columnVarcharUploadImageNotNull.gif', 1),
(2, '2020-12-02', '2020-12-02 02:00:02', '02:00:02', 2, 2, 2.20, '02Column Varchar Not Null', '02Column Longtext Not Null', '02Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-02 02:00:02', '2020-12-02', 2.20, 0, 0, 'column.varchar.email.not.null02@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36d55859.84886914', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s02columnVarcharUploadImageNotNull.gif', 2),
(3, '2020-12-03', '2020-12-03 03:00:02', '03:00:02', 3, 3, 3.30, '03Column Varchar Not Null', '03Column Longtext Not Null', '03Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-03 03:00:02', '2020-12-03', 3.30, 1, 1, 'column.varchar.email.not.null03@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36d65052.96144711', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s03columnVarcharUploadImageNotNull.gif', 3),
(4, '2020-12-04', '2020-12-04 04:00:02', '04:00:02', 4, 4, 4.40, '04Column Varchar Not Null', '04Column Longtext Not Null', '04Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-04 04:00:02', '2020-12-04', 4.40, 0, 0, 'column.varchar.email.not.null04@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36d6d970.80536776', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s04columnVarcharUploadImageNotNull.gif', 4),
(5, '2020-12-05', '2020-12-05 05:00:02', '05:00:02', 5, 5, 5.50, '05Column Varchar Not Null', '05Column Longtext Not Null', '05Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-05 05:00:02', '2020-12-05', 5.50, 1, 1, 'column.varchar.email.not.null05@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36d7c994.66669422', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s05columnVarcharUploadImageNotNull.gif', 5),
(6, '2020-12-06', '2020-12-06 06:00:02', '06:00:02', 6, 6, 6.60, '06Column Varchar Not Null', '06Column Longtext Not Null', '06Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-06 06:00:02', '2020-12-06', 6.60, 0, 0, 'column.varchar.email.not.null06@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36d873a6.39027138', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s06columnVarcharUploadImageNotNull.gif', 6),
(7, '2020-12-07', '2020-12-07 07:00:02', '07:00:02', 7, 7, 7.70, '07Column Varchar Not Null', '07Column Longtext Not Null', '07Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-07 07:00:02', '2020-12-07', 7.70, 1, 1, 'column.varchar.email.not.null07@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36d99e52.41678843', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s07columnVarcharUploadImageNotNull.gif', 7),
(8, '2020-12-08', '2020-12-08 08:00:02', '08:00:02', 8, 8, 8.80, '08Column Varchar Not Null', '08Column Longtext Not Null', '08Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-08 08:00:02', '2020-12-08', 8.80, 0, 0, 'column.varchar.email.not.null08@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36da53a1.47225431', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s08columnVarcharUploadImageNotNull.gif', 8),
(9, '2020-12-09', '2020-12-09 09:00:02', '09:00:02', 9, 9, 9.90, '09Column Varchar Not Null', '09Column Longtext Not Null', '09Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-09 09:00:02', '2020-12-09', 9.90, 1, 1, 'column.varchar.email.not.null09@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36db2e04.21013636', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s09columnVarcharUploadImageNotNull.gif', 9),
(10, '2020-12-10', '2020-12-10 10:00:02', '10:00:02', 10, 10, 10.10, '10Column Varchar Not Null', '10Column Longtext Not Null', '10Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-10 10:00:02', '2020-12-10', 10.10, 0, 0, 'column.varchar.email.not.null10@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36dc5f73.15711142', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s10columnVarcharUploadImageNotNull.gif', 10),
(11, '2020-12-11', '2020-12-11 11:00:02', '11:00:02', 11, 11, 11.11, '11Column Varchar Not Null', '11Column Longtext Not Null', '11Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-11 11:00:02', '2020-12-11', 11.11, 1, 1, 'column.varchar.email.not.null11@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36dd53e4.99610167', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s11columnVarcharUploadImageNotNull.gif', 11),
(12, '2020-12-12', '2020-12-12 12:00:02', '12:00:02', 12, 12, 12.12, '12Column Varchar Not Null', '12Column Longtext Not Null', '12Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-12 12:00:02', '2020-12-12', 12.12, 0, 0, 'column.varchar.email.not.null12@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36de32d2.21176397', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s12columnVarcharUploadImageNotNull.gif', 12),
(13, '2020-12-13', '2020-12-13 13:00:02', '13:00:02', 13, 13, 13.13, '13Column Varchar Not Null', '13Column Longtext Not Null', '13Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-13 13:00:02', '2020-12-13', 13.13, 1, 1, 'column.varchar.email.not.null13@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36df5c98.82758189', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s13columnVarcharUploadImageNotNull.gif', 13),
(14, '2020-12-14', '2020-12-14 14:00:02', '14:00:02', 14, 14, 14.14, '14Column Varchar Not Null', '14Column Longtext Not Null', '14Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-14 14:00:02', '2020-12-14', 14.14, 0, 0, 'column.varchar.email.not.null14@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36dff965.50915488', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s14columnVarcharUploadImageNotNull.gif', 14),
(15, '2020-12-15', '2020-12-15 15:00:02', '15:00:02', 15, 15, 15.15, '15Column Varchar Not Null', '15Column Longtext Not Null', '15Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-15 15:00:02', '2020-12-15', 15.15, 1, 1, 'column.varchar.email.not.null15@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36e0c143.61965751', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s15columnVarcharUploadImageNotNull.gif', 15),
(16, '2020-12-16', '2020-12-16 16:00:02', '16:00:02', 16, 16, 16.16, '16Column Varchar Not Null', '16Column Longtext Not Null', '16Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-16 16:00:02', '2020-12-16', 16.16, 0, 0, 'column.varchar.email.not.null16@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36e21862.30083599', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s16columnVarcharUploadImageNotNull.gif', 16),
(17, '2020-12-17', '2020-12-17 17:00:02', '17:00:02', 17, 17, 17.17, '17Column Varchar Not Null', '17Column Longtext Not Null', '17Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-17 17:00:02', '2020-12-17', 17.17, 1, 1, 'column.varchar.email.not.null17@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36e30b99.83394052', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s17columnVarcharUploadImageNotNull.gif', 17),
(18, '2020-12-18', '2020-12-18 18:00:02', '18:00:02', 18, 18, 18.18, '18Column Varchar Not Null', '18Column Longtext Not Null', '18Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-18 18:00:02', '2020-12-18', 18.18, 0, 0, 'column.varchar.email.not.null18@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36e427d4.39932118', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s18columnVarcharUploadImageNotNull.gif', 18),
(19, '2020-12-19', '2020-12-19 19:00:02', '19:00:02', 19, 19, 19.19, '19Column Varchar Not Null', '19Column Longtext Not Null', '19Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-19 19:00:02', '2020-12-19', 19.19, 1, 1, 'column.varchar.email.not.null19@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36e50298.94694880', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s19columnVarcharUploadImageNotNull.gif', 19),
(20, '2020-12-20', '2020-12-20 20:00:02', '20:00:02', 20, 20, 20.20, '20Column Varchar Not Null', '20Column Longtext Not Null', '20Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-20 20:00:02', '2020-12-20', 20.20, 0, 0, 'column.varchar.email.not.null20@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36e5f5b2.37577094', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s20columnVarcharUploadImageNotNull.gif', 20),
(21, '2020-12-21', '2020-12-21 21:00:02', '21:00:02', 21, 21, 21.21, '21Column Varchar Not Null', '21Column Longtext Not Null', '21Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-21 21:00:02', '2020-12-21', 21.21, 1, 1, 'column.varchar.email.not.null21@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36e6a693.83794463', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s21columnVarcharUploadImageNotNull.gif', 21),
(22, '2020-12-22', '2020-12-22 22:00:02', '22:00:02', 22, 22, 22.22, '22Column Varchar Not Null', '22Column Longtext Not Null', '22Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-22 22:00:02', '2020-12-22', 22.22, 0, 0, 'column.varchar.email.not.null22@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36e75df8.88036408', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s22columnVarcharUploadImageNotNull.gif', 22),
(23, '2020-12-23', '2020-12-23 23:00:02', '23:00:02', 23, 23, 23.23, '23Column Varchar Not Null', '23Column Longtext Not Null', '23Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-23 23:00:02', '2020-12-23', 23.23, 1, 1, 'column.varchar.email.not.null23@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36e81567.18204678', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s23columnVarcharUploadImageNotNull.gif', 23),
(24, '2020-12-24', '2020-12-24 06:00:02', '06:00:02', 24, 24, 24.24, '24Column Varchar Not Null', '24Column Longtext Not Null', '24Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-24 06:00:02', '2020-12-24', 24.24, 0, 0, 'column.varchar.email.not.null24@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36e8a993.27879670', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s24columnVarcharUploadImageNotNull.gif', 24),
(25, '2020-12-25', '2020-12-25 05:00:02', '05:00:02', 25, 25, 25.25, '25Column Varchar Not Null', '25Column Longtext Not Null', '25Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-25 05:00:02', '2020-12-25', 25.25, 1, 1, 'column.varchar.email.not.null25@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36e947c5.36245770', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s25columnVarcharUploadImageNotNull.gif', 25),
(26, '2020-12-26', '2020-12-26 04:00:02', '04:00:02', 26, 26, 26.26, '26Column Varchar Not Null', '26Column Longtext Not Null', '26Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-26 04:00:02', '2020-12-26', 26.26, 0, 0, 'column.varchar.email.not.null26@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36ea1b36.71354983', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s26columnVarcharUploadImageNotNull.gif', 26),
(27, '2020-12-27', '2020-12-27 03:00:02', '03:00:02', 27, 27, 27.27, '27Column Varchar Not Null', '27Column Longtext Not Null', '27Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-27 03:00:02', '2020-12-27', 27.27, 1, 1, 'column.varchar.email.not.null27@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36eb1041.91464191', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s27columnVarcharUploadImageNotNull.gif', 27),
(28, '2020-12-28', '2020-12-28 02:00:02', '02:00:02', 28, 28, 28.28, '28Column Varchar Not Null', '28Column Longtext Not Null', '28Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-28 02:00:02', '2020-12-28', 28.28, 0, 0, 'column.varchar.email.not.null28@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36ec0464.00971533', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s28columnVarcharUploadImageNotNull.gif', 28),
(29, '2020-12-29', '2020-12-29 01:00:02', '01:00:02', 29, 29, 29.29, '29Column Varchar Not Null', '29Column Longtext Not Null', '29Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-29 01:00:02', '2020-12-29', 29.29, 1, 1, 'column.varchar.email.not.null29@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36ed0269.20533779', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s29columnVarcharUploadImageNotNull.gif', 29),
(30, '2020-12-30', '2020-12-30 00:00:02', '00:00:02', 30, 30, 30.30, '30Column Varchar Not Null', '30Column Longtext Not Null', '30Column Text Not Null', '2015-05-05 06:15:54', NULL, 2, NULL, '2020-12-30 00:00:02', '2020-12-30', 30.30, 0, 0, 'column.varchar.email.not.null30@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '155488a36ee2475.71613546', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s30columnVarcharUploadImageNotNull.gif', 30);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `foreign_keys`
--

INSERT INTO `foreign_keys` (`id_foreign_keys`, `name`, `created`, `updated`, `created_by`, `updated_by`) VALUES
(1, '01Name', '2015-05-05 06:15:54', NULL, 2, NULL),
(2, '02Name', '2015-05-05 06:15:54', NULL, 2, NULL),
(3, '03Name', '2015-05-05 06:15:54', NULL, 2, NULL),
(4, '04Name', '2015-05-05 06:15:54', NULL, 2, NULL),
(5, '05Name', '2015-05-05 06:15:54', NULL, 2, NULL),
(6, '06Name', '2015-05-05 06:15:54', NULL, 3, NULL),
(7, '07Name', '2015-05-05 06:15:54', NULL, 3, NULL),
(8, '08Name', '2015-05-05 06:15:54', NULL, 3, NULL),
(9, '09Name', '2015-05-05 06:15:54', NULL, 3, NULL),
(10, '10Name', '2015-05-05 06:15:54', NULL, 3, NULL),
(11, '11Name', '2015-05-05 06:15:54', NULL, 4, NULL),
(12, '12Name', '2015-05-05 06:15:54', NULL, 4, NULL),
(13, '13Name', '2015-05-05 06:15:54', NULL, 4, NULL),
(14, '14Name', '2015-05-05 06:15:54', NULL, 4, NULL),
(15, '15Name', '2015-05-05 06:15:54', NULL, 4, NULL),
(16, '16Name', '2015-05-05 06:15:54', NULL, 5, NULL),
(17, '17Name', '2015-05-05 06:15:54', NULL, 5, NULL),
(18, '18Name', '2015-05-05 06:15:54', NULL, 5, NULL),
(19, '19Name', '2015-05-05 06:15:54', NULL, 5, NULL),
(20, '20Name', '2015-05-05 06:15:54', NULL, 5, NULL),
(21, '21Name', '2015-05-05 06:15:54', NULL, 6, NULL),
(22, '22Name', '2015-05-05 06:15:54', NULL, 6, NULL),
(23, '23Name', '2015-05-05 06:15:54', NULL, 6, NULL),
(24, '24Name', '2015-05-05 06:15:54', NULL, 6, NULL),
(25, '25Name', '2015-05-05 06:15:54', NULL, 6, NULL),
(26, '26Name', '2015-05-05 06:15:54', NULL, 7, NULL),
(27, '27Name', '2015-05-05 06:15:54', NULL, 7, NULL),
(28, '28Name', '2015-05-05 06:15:54', NULL, 7, NULL),
(29, '29Name', '2015-05-05 06:15:54', NULL, 7, NULL),
(30, '30Name', '2015-05-05 06:15:54', NULL, 7, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(1, NULL, 'guest', '2015-05-05 06:15:54', 2, NULL, NULL),
(2, 1, 'admin', '2015-05-05 06:15:54', 2, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(1, 'gear@pibernetwork.com', '$2y$14$lcPBJL6zsCZWddKa5dlteOgMCHAjQdvoWmY0QKfelcDusL1es9JvG', '', 1, '155488a426d8c75.79716771', '2015-05-05 06:15:46', '2015-05-05 06:15:46', 1, 1, NULL),
(2, 'usuariogear1@gmail.com', '$2y$14$jKndPpCBdUyppUslI9E47OOyBz.CwXnlHpZgUSBM1W84YzyErwSfi', '', 1, '155488a43b9d572.97626570', '2015-05-05 06:15:47', '2015-05-05 06:15:47', 2, 2, 2),
(3, 'usuariogear2@gmail.com', '$2y$14$7G40C3ALAueUl2ARAZZvf.JxE7.ynq.M9ySJXIRntpzYAV2oKPnfq', '', 1, '155488a450fd898.19942406', '2015-05-05 06:15:49', '2015-05-05 06:15:49', 3, 3, 2),
(4, 'usuariogear3@gmail.com', '$2y$14$KXhDcDvmD7rwywfdBD.ZguZrD9zRd.a3SS18J.MtVkP7uYa1Rj0.q', '', 1, '155488a46562aa6.43587889', '2015-05-05 06:15:50', '2015-05-05 06:15:50', 4, 4, 2),
(5, 'usuariogear4@gmail.com', '$2y$14$csyIQ9IBTx76thzZwaAiR.KdZwdeWpcPVxVYZkMphlxyxMjzm7pmy', '', 1, '155488a47a0c9d0.01651577', '2015-05-05 06:15:51', '2015-05-05 06:15:51', 5, 5, 2),
(6, 'usuariogear5@gmail.com', '$2y$14$w46Ybm1S5Pzkbes5dUiNA.kXB2.E4zVwt96JGRKSOZ1Ekr1fwoSJy', '', 1, '155488a48e82977.62124028', '2015-05-05 06:15:52', '2015-05-05 06:15:52', 6, 6, 2),
(7, 'usuariogear6@gmail.com', '$2y$14$qCAbRTGgSVEs/h2xr41vreJWO.8rLxdIcmPeO/oKQ7Tl.KzbqsAcm', '', 1, '155488a4a474e30.80457561', '2015-05-05 06:15:54', '2015-05-05 06:15:54', 7, 7, 2);

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
-- Constraints for table `columns_not_null`
--
ALTER TABLE `columns_not_null`
  ADD CONSTRAINT `columns_not_null_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `columns_not_null_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_columns_not_null_1` FOREIGN KEY (`column_foreign_key_not_null`) REFERENCES `foreign_keys` (`id_foreign_keys`) ON DELETE CASCADE ON UPDATE CASCADE;

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
