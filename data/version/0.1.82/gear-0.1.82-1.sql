-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 12, 2015 at 03:08 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
(1, '2020-12-01', '2020-12-01 01:00:02', '01:00:02', 1, 1, 1.10, '01Column Varchar', '01Column Longtext', '01Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-01 01:00:02', '2020-12-01', 1.10, 1, 1, 'column.varchar.email01@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3b9e5281.57559992', '/upload/columns-columnVarcharUploadImage/%s01columnVarcharUploadImage.gif', 1),
(2, '2020-12-02', '2020-12-02 02:00:02', '02:00:02', 2, 2, 2.20, '02Column Varchar', '02Column Longtext', '02Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-02 02:00:02', '2020-12-02', 2.20, 0, 0, 'column.varchar.email02@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3b9ef712.71460964', '/upload/columns-columnVarcharUploadImage/%s02columnVarcharUploadImage.gif', 2),
(3, '2020-12-03', '2020-12-03 03:00:02', '03:00:02', 3, 3, 3.30, '03Column Varchar', '03Column Longtext', '03Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-03 03:00:02', '2020-12-03', 3.30, 1, 1, 'column.varchar.email03@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3b9fb124.83527644', '/upload/columns-columnVarcharUploadImage/%s03columnVarcharUploadImage.gif', 3),
(4, '2020-12-04', '2020-12-04 04:00:02', '04:00:02', 4, 4, 4.40, '04Column Varchar', '04Column Longtext', '04Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-04 04:00:02', '2020-12-04', 4.40, 0, 0, 'column.varchar.email04@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba03277.65077243', '/upload/columns-columnVarcharUploadImage/%s04columnVarcharUploadImage.gif', 4),
(5, '2020-12-05', '2020-12-05 05:00:02', '05:00:02', 5, 5, 5.50, '05Column Varchar', '05Column Longtext', '05Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-05 05:00:02', '2020-12-05', 5.50, 1, 1, 'column.varchar.email05@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba0a208.08616841', '/upload/columns-columnVarcharUploadImage/%s05columnVarcharUploadImage.gif', 5),
(6, '2020-12-06', '2020-12-06 06:00:02', '06:00:02', 6, 6, 6.60, '06Column Varchar', '06Column Longtext', '06Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-06 06:00:02', '2020-12-06', 6.60, 0, 0, 'column.varchar.email06@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba11b02.69780155', '/upload/columns-columnVarcharUploadImage/%s06columnVarcharUploadImage.gif', 6),
(7, '2020-12-07', '2020-12-07 07:00:02', '07:00:02', 7, 7, 7.70, '07Column Varchar', '07Column Longtext', '07Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-07 07:00:02', '2020-12-07', 7.70, 1, 1, 'column.varchar.email07@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba18972.91076387', '/upload/columns-columnVarcharUploadImage/%s07columnVarcharUploadImage.gif', 7),
(8, '2020-12-08', '2020-12-08 08:00:02', '08:00:02', 8, 8, 8.80, '08Column Varchar', '08Column Longtext', '08Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-08 08:00:02', '2020-12-08', 8.80, 0, 0, 'column.varchar.email08@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba1fa83.12141198', '/upload/columns-columnVarcharUploadImage/%s08columnVarcharUploadImage.gif', 8),
(9, '2020-12-09', '2020-12-09 09:00:02', '09:00:02', 9, 9, 9.90, '09Column Varchar', '09Column Longtext', '09Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-09 09:00:02', '2020-12-09', 9.90, 1, 1, 'column.varchar.email09@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba26d52.92939032', '/upload/columns-columnVarcharUploadImage/%s09columnVarcharUploadImage.gif', 9),
(10, '2020-12-10', '2020-12-10 10:00:02', '10:00:02', 10, 10, 10.10, '10Column Varchar', '10Column Longtext', '10Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-10 10:00:02', '2020-12-10', 10.10, 0, 0, 'column.varchar.email10@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba2de25.39886472', '/upload/columns-columnVarcharUploadImage/%s10columnVarcharUploadImage.gif', 10),
(11, '2020-12-11', '2020-12-11 11:00:02', '11:00:02', 11, 11, 11.11, '11Column Varchar', '11Column Longtext', '11Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-11 11:00:02', '2020-12-11', 11.11, 1, 1, 'column.varchar.email11@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba34d88.75269401', '/upload/columns-columnVarcharUploadImage/%s11columnVarcharUploadImage.gif', 11),
(12, '2020-12-12', '2020-12-12 12:00:02', '12:00:02', 12, 12, 12.12, '12Column Varchar', '12Column Longtext', '12Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-12 12:00:02', '2020-12-12', 12.12, 0, 0, 'column.varchar.email12@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba3b873.87325450', '/upload/columns-columnVarcharUploadImage/%s12columnVarcharUploadImage.gif', 12),
(13, '2020-12-13', '2020-12-13 13:00:02', '13:00:02', 13, 13, 13.13, '13Column Varchar', '13Column Longtext', '13Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-13 13:00:02', '2020-12-13', 13.13, 1, 1, 'column.varchar.email13@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba43113.60406351', '/upload/columns-columnVarcharUploadImage/%s13columnVarcharUploadImage.gif', 13),
(14, '2020-12-14', '2020-12-14 14:00:02', '14:00:02', 14, 14, 14.14, '14Column Varchar', '14Column Longtext', '14Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-14 14:00:02', '2020-12-14', 14.14, 0, 0, 'column.varchar.email14@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba49d40.54119221', '/upload/columns-columnVarcharUploadImage/%s14columnVarcharUploadImage.gif', 14),
(15, '2020-12-15', '2020-12-15 15:00:02', '15:00:02', 15, 15, 15.15, '15Column Varchar', '15Column Longtext', '15Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-15 15:00:02', '2020-12-15', 15.15, 1, 1, 'column.varchar.email15@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba51007.58058840', '/upload/columns-columnVarcharUploadImage/%s15columnVarcharUploadImage.gif', 15),
(16, '2020-12-16', '2020-12-16 16:00:02', '16:00:02', 16, 16, 16.16, '16Column Varchar', '16Column Longtext', '16Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-16 16:00:02', '2020-12-16', 16.16, 0, 0, 'column.varchar.email16@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba57d34.90094103', '/upload/columns-columnVarcharUploadImage/%s16columnVarcharUploadImage.gif', 16),
(17, '2020-12-17', '2020-12-17 17:00:02', '17:00:02', 17, 17, 17.17, '17Column Varchar', '17Column Longtext', '17Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-17 17:00:02', '2020-12-17', 17.17, 1, 1, 'column.varchar.email17@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba5ef74.19927697', '/upload/columns-columnVarcharUploadImage/%s17columnVarcharUploadImage.gif', 17),
(18, '2020-12-18', '2020-12-18 18:00:02', '18:00:02', 18, 18, 18.18, '18Column Varchar', '18Column Longtext', '18Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-18 18:00:02', '2020-12-18', 18.18, 0, 0, 'column.varchar.email18@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba6bbe6.68251566', '/upload/columns-columnVarcharUploadImage/%s18columnVarcharUploadImage.gif', 18),
(19, '2020-12-19', '2020-12-19 19:00:02', '19:00:02', 19, 19, 19.19, '19Column Varchar', '19Column Longtext', '19Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-19 19:00:02', '2020-12-19', 19.19, 1, 1, 'column.varchar.email19@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba78d09.65924506', '/upload/columns-columnVarcharUploadImage/%s19columnVarcharUploadImage.gif', 19),
(20, '2020-12-20', '2020-12-20 20:00:02', '20:00:02', 20, 20, 20.20, '20Column Varchar', '20Column Longtext', '20Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-20 20:00:02', '2020-12-20', 20.20, 0, 0, 'column.varchar.email20@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba7fef8.99868891', '/upload/columns-columnVarcharUploadImage/%s20columnVarcharUploadImage.gif', 20),
(21, '2020-12-21', '2020-12-21 21:00:02', '21:00:02', 21, 21, 21.21, '21Column Varchar', '21Column Longtext', '21Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-21 21:00:02', '2020-12-21', 21.21, 1, 1, 'column.varchar.email21@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba86a74.42270175', '/upload/columns-columnVarcharUploadImage/%s21columnVarcharUploadImage.gif', 21),
(22, '2020-12-22', '2020-12-22 22:00:02', '22:00:02', 22, 22, 22.22, '22Column Varchar', '22Column Longtext', '22Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-22 22:00:02', '2020-12-22', 22.22, 0, 0, 'column.varchar.email22@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba8d777.06628870', '/upload/columns-columnVarcharUploadImage/%s22columnVarcharUploadImage.gif', 22),
(23, '2020-12-23', '2020-12-23 23:00:02', '23:00:02', 23, 23, 23.23, '23Column Varchar', '23Column Longtext', '23Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-23 23:00:02', '2020-12-23', 23.23, 1, 1, 'column.varchar.email23@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba944f1.41497030', '/upload/columns-columnVarcharUploadImage/%s23columnVarcharUploadImage.gif', 23),
(24, '2020-12-24', '2020-12-24 06:00:02', '06:00:02', 24, 24, 24.24, '24Column Varchar', '24Column Longtext', '24Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-24 06:00:02', '2020-12-24', 24.24, 0, 0, 'column.varchar.email24@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3ba9b1a8.93405248', '/upload/columns-columnVarcharUploadImage/%s24columnVarcharUploadImage.gif', 24),
(25, '2020-12-25', '2020-12-25 05:00:02', '05:00:02', 25, 25, 25.25, '25Column Varchar', '25Column Longtext', '25Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-25 05:00:02', '2020-12-25', 25.25, 1, 1, 'column.varchar.email25@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3baa2c20.71397175', '/upload/columns-columnVarcharUploadImage/%s25columnVarcharUploadImage.gif', 25),
(26, '2020-12-26', '2020-12-26 04:00:02', '04:00:02', 26, 26, 26.26, '26Column Varchar', '26Column Longtext', '26Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-26 04:00:02', '2020-12-26', 26.26, 0, 0, 'column.varchar.email26@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3baa98b1.20919991', '/upload/columns-columnVarcharUploadImage/%s26columnVarcharUploadImage.gif', 26),
(27, '2020-12-27', '2020-12-27 03:00:02', '03:00:02', 27, 27, 27.27, '27Column Varchar', '27Column Longtext', '27Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-27 03:00:02', '2020-12-27', 27.27, 1, 1, 'column.varchar.email27@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3bab09d2.64707357', '/upload/columns-columnVarcharUploadImage/%s27columnVarcharUploadImage.gif', 27),
(28, '2020-12-28', '2020-12-28 02:00:02', '02:00:02', 28, 28, 28.28, '28Column Varchar', '28Column Longtext', '28Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-28 02:00:02', '2020-12-28', 28.28, 0, 0, 'column.varchar.email28@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3bab7bf5.75786880', '/upload/columns-columnVarcharUploadImage/%s28columnVarcharUploadImage.gif', 28),
(29, '2020-12-29', '2020-12-29 01:00:02', '01:00:02', 29, 29, 29.29, '29Column Varchar', '29Column Longtext', '29Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-29 01:00:02', '2020-12-29', 29.29, 1, 1, 'column.varchar.email29@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3babefa8.03612086', '/upload/columns-columnVarcharUploadImage/%s29columnVarcharUploadImage.gif', 29),
(30, '2020-12-30', '2020-12-30 00:00:02', '00:00:02', 30, 30, 30.30, '30Column Varchar', '30Column Longtext', '30Column Text', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-30 00:00:02', '2020-12-30', 30.30, 0, 0, 'column.varchar.email30@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c3bac60b1.56190741', '/upload/columns-columnVarcharUploadImage/%s30columnVarcharUploadImage.gif', 30);

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
(1, '/upload/columns-image-uploadImageOne/%s01uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s01uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s01uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:27', NULL),
(2, '/upload/columns-image-uploadImageOne/%s02uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s02uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s02uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:27', NULL),
(3, '/upload/columns-image-uploadImageOne/%s03uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s03uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s03uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:27', NULL),
(4, '/upload/columns-image-uploadImageOne/%s04uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s04uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s04uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:27', NULL),
(5, '/upload/columns-image-uploadImageOne/%s05uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s05uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s05uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:27', NULL),
(6, '/upload/columns-image-uploadImageOne/%s06uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s06uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s06uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(7, '/upload/columns-image-uploadImageOne/%s07uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s07uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s07uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(8, '/upload/columns-image-uploadImageOne/%s08uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s08uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s08uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(9, '/upload/columns-image-uploadImageOne/%s09uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s09uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s09uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(10, '/upload/columns-image-uploadImageOne/%s10uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s10uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s10uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(11, '/upload/columns-image-uploadImageOne/%s11uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s11uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s11uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(12, '/upload/columns-image-uploadImageOne/%s12uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s12uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s12uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(13, '/upload/columns-image-uploadImageOne/%s13uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s13uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s13uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(14, '/upload/columns-image-uploadImageOne/%s14uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s14uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s14uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(15, '/upload/columns-image-uploadImageOne/%s15uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s15uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s15uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(16, '/upload/columns-image-uploadImageOne/%s16uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s16uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s16uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(17, '/upload/columns-image-uploadImageOne/%s17uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s17uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s17uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(18, '/upload/columns-image-uploadImageOne/%s18uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s18uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s18uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(19, '/upload/columns-image-uploadImageOne/%s19uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s19uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s19uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(20, '/upload/columns-image-uploadImageOne/%s20uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s20uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s20uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:28', NULL),
(21, '/upload/columns-image-uploadImageOne/%s21uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s21uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s21uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:29', NULL),
(22, '/upload/columns-image-uploadImageOne/%s22uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s22uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s22uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:29', NULL),
(23, '/upload/columns-image-uploadImageOne/%s23uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s23uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s23uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:29', NULL),
(24, '/upload/columns-image-uploadImageOne/%s24uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s24uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s24uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:29', NULL),
(25, '/upload/columns-image-uploadImageOne/%s25uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s25uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s25uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:29', NULL),
(26, '/upload/columns-image-uploadImageOne/%s26uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s26uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s26uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:29', NULL),
(27, '/upload/columns-image-uploadImageOne/%s27uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s27uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s27uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:29', NULL),
(28, '/upload/columns-image-uploadImageOne/%s28uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s28uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s28uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:29', NULL),
(29, '/upload/columns-image-uploadImageOne/%s29uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s29uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s29uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:29', NULL),
(30, '/upload/columns-image-uploadImageOne/%s30uploadImageOne.gif', '/upload/columns-image-uploadImageTwo/%s30uploadImageTwo.gif', '/upload/columns-image-uploadImageThree/%s30uploadImageThree.gif', 2, NULL, '2015-05-09 18:51:29', NULL);

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
(1, '2020-12-01', '2020-12-01 01:00:02', '01:00:02', 1, 1, 1.10, '01Column Varchar Not Null', '01Column Longtext Not Null', '01Column Text Not Null', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-01 01:00:02', '2020-12-01', 1.10, 1, 1, 'column.varchar.email.not.null01@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da28c31.92417674', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s01columnVarcharUploadImageNotNull.gif', 1),
(2, '2020-12-02', '2020-12-02 02:00:02', '02:00:02', 2, 2, 2.20, '02Column Varchar Not Null', '02Column Longtext Not Null', '02Column Text Not Null', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-02 02:00:02', '2020-12-02', 2.20, 0, 0, 'column.varchar.email.not.null02@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da372d4.83721035', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s02columnVarcharUploadImageNotNull.gif', 2),
(3, '2020-12-03', '2020-12-03 03:00:02', '03:00:02', 3, 3, 3.30, '03Column Varchar Not Null', '03Column Longtext Not Null', '03Column Text Not Null', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-03 03:00:02', '2020-12-03', 3.30, 1, 1, 'column.varchar.email.not.null03@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da45ba9.89535505', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s03columnVarcharUploadImageNotNull.gif', 3),
(4, '2020-12-04', '2020-12-04 04:00:02', '04:00:02', 4, 4, 4.40, '04Column Varchar Not Null', '04Column Longtext Not Null', '04Column Text Not Null', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-04 04:00:02', '2020-12-04', 4.40, 0, 0, 'column.varchar.email.not.null04@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da514b8.12382791', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s04columnVarcharUploadImageNotNull.gif', 4),
(5, '2020-12-05', '2020-12-05 05:00:02', '05:00:02', 5, 5, 5.50, '05Column Varchar Not Null', '05Column Longtext Not Null', '05Column Text Not Null', '2015-05-09 18:51:30', NULL, 2, NULL, '2020-12-05 05:00:02', '2020-12-05', 5.50, 1, 1, 'column.varchar.email.not.null05@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da59ba3.16139804', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s05columnVarcharUploadImageNotNull.gif', 5),
(6, '2020-12-06', '2020-12-06 06:00:02', '06:00:02', 6, 6, 6.60, '06Column Varchar Not Null', '06Column Longtext Not Null', '06Column Text Not Null', '2015-05-09 18:51:30', NULL, 3, NULL, '2020-12-06 06:00:02', '2020-12-06', 6.60, 0, 0, 'column.varchar.email.not.null06@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da62174.21158965', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s06columnVarcharUploadImageNotNull.gif', 6),
(7, '2020-12-07', '2020-12-07 07:00:02', '07:00:02', 7, 7, 7.70, '07Column Varchar Not Null', '07Column Longtext Not Null', '07Column Text Not Null', '2015-05-09 18:51:30', NULL, 3, NULL, '2020-12-07 07:00:02', '2020-12-07', 7.70, 1, 1, 'column.varchar.email.not.null07@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da6a521.44641599', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s07columnVarcharUploadImageNotNull.gif', 7),
(8, '2020-12-08', '2020-12-08 08:00:02', '08:00:02', 8, 8, 8.80, '08Column Varchar Not Null', '08Column Longtext Not Null', '08Column Text Not Null', '2015-05-09 18:51:30', NULL, 3, NULL, '2020-12-08 08:00:02', '2020-12-08', 8.80, 0, 0, 'column.varchar.email.not.null08@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da73630.76791643', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s08columnVarcharUploadImageNotNull.gif', 8),
(9, '2020-12-09', '2020-12-09 09:00:02', '09:00:02', 9, 9, 9.90, '09Column Varchar Not Null', '09Column Longtext Not Null', '09Column Text Not Null', '2015-05-09 18:51:30', NULL, 3, NULL, '2020-12-09 09:00:02', '2020-12-09', 9.90, 1, 1, 'column.varchar.email.not.null09@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da7bca8.92863688', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s09columnVarcharUploadImageNotNull.gif', 9),
(10, '2020-12-10', '2020-12-10 10:00:02', '10:00:02', 10, 10, 10.10, '10Column Varchar Not Null', '10Column Longtext Not Null', '10Column Text Not Null', '2015-05-09 18:51:30', NULL, 3, NULL, '2020-12-10 10:00:02', '2020-12-10', 10.10, 0, 0, 'column.varchar.email.not.null10@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da84745.34918762', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s10columnVarcharUploadImageNotNull.gif', 10),
(11, '2020-12-11', '2020-12-11 11:00:02', '11:00:02', 11, 11, 11.11, '11Column Varchar Not Null', '11Column Longtext Not Null', '11Column Text Not Null', '2015-05-09 18:51:30', NULL, 4, NULL, '2020-12-11 11:00:02', '2020-12-11', 11.11, 1, 1, 'column.varchar.email.not.null11@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da8cce6.98108712', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s11columnVarcharUploadImageNotNull.gif', 11),
(12, '2020-12-12', '2020-12-12 12:00:02', '12:00:02', 12, 12, 12.12, '12Column Varchar Not Null', '12Column Longtext Not Null', '12Column Text Not Null', '2015-05-09 18:51:30', NULL, 4, NULL, '2020-12-12 12:00:02', '2020-12-12', 12.12, 0, 0, 'column.varchar.email.not.null12@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da95320.79461820', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s12columnVarcharUploadImageNotNull.gif', 12),
(13, '2020-12-13', '2020-12-13 13:00:02', '13:00:02', 13, 13, 13.13, '13Column Varchar Not Null', '13Column Longtext Not Null', '13Column Text Not Null', '2015-05-09 18:51:30', NULL, 4, NULL, '2020-12-13 13:00:02', '2020-12-13', 13.13, 1, 1, 'column.varchar.email.not.null13@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4da9df40.85024159', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s13columnVarcharUploadImageNotNull.gif', 13),
(14, '2020-12-14', '2020-12-14 14:00:02', '14:00:02', 14, 14, 14.14, '14Column Varchar Not Null', '14Column Longtext Not Null', '14Column Text Not Null', '2015-05-09 18:51:30', NULL, 4, NULL, '2020-12-14 14:00:02', '2020-12-14', 14.14, 0, 0, 'column.varchar.email.not.null14@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4daa8255.48623048', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s14columnVarcharUploadImageNotNull.gif', 14),
(15, '2020-12-15', '2020-12-15 15:00:02', '15:00:02', 15, 15, 15.15, '15Column Varchar Not Null', '15Column Longtext Not Null', '15Column Text Not Null', '2015-05-09 18:51:30', NULL, 4, NULL, '2020-12-15 15:00:02', '2020-12-15', 15.15, 1, 1, 'column.varchar.email.not.null15@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dab9c67.67750469', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s15columnVarcharUploadImageNotNull.gif', 15),
(16, '2020-12-16', '2020-12-16 16:00:02', '16:00:02', 16, 16, 16.16, '16Column Varchar Not Null', '16Column Longtext Not Null', '16Column Text Not Null', '2015-05-09 18:51:30', NULL, 5, NULL, '2020-12-16 16:00:02', '2020-12-16', 16.16, 0, 0, 'column.varchar.email.not.null16@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dac28f9.69334031', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s16columnVarcharUploadImageNotNull.gif', 16),
(17, '2020-12-17', '2020-12-17 17:00:02', '17:00:02', 17, 17, 17.17, '17Column Varchar Not Null', '17Column Longtext Not Null', '17Column Text Not Null', '2015-05-09 18:51:30', NULL, 5, NULL, '2020-12-17 17:00:02', '2020-12-17', 17.17, 1, 1, 'column.varchar.email.not.null17@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dacb2b5.36470420', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s17columnVarcharUploadImageNotNull.gif', 17),
(18, '2020-12-18', '2020-12-18 18:00:02', '18:00:02', 18, 18, 18.18, '18Column Varchar Not Null', '18Column Longtext Not Null', '18Column Text Not Null', '2015-05-09 18:51:30', NULL, 5, NULL, '2020-12-18 18:00:02', '2020-12-18', 18.18, 0, 0, 'column.varchar.email.not.null18@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dad4944.03471490', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s18columnVarcharUploadImageNotNull.gif', 18),
(19, '2020-12-19', '2020-12-19 19:00:02', '19:00:02', 19, 19, 19.19, '19Column Varchar Not Null', '19Column Longtext Not Null', '19Column Text Not Null', '2015-05-09 18:51:30', NULL, 5, NULL, '2020-12-19 19:00:02', '2020-12-19', 19.19, 1, 1, 'column.varchar.email.not.null19@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dadd725.09030517', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s19columnVarcharUploadImageNotNull.gif', 19),
(20, '2020-12-20', '2020-12-20 20:00:02', '20:00:02', 20, 20, 20.20, '20Column Varchar Not Null', '20Column Longtext Not Null', '20Column Text Not Null', '2015-05-09 18:51:30', NULL, 5, NULL, '2020-12-20 20:00:02', '2020-12-20', 20.20, 0, 0, 'column.varchar.email.not.null20@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dae5db6.38067099', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s20columnVarcharUploadImageNotNull.gif', 20),
(21, '2020-12-21', '2020-12-21 21:00:02', '21:00:02', 21, 21, 21.21, '21Column Varchar Not Null', '21Column Longtext Not Null', '21Column Text Not Null', '2015-05-09 18:51:30', NULL, 6, NULL, '2020-12-21 21:00:02', '2020-12-21', 21.21, 1, 1, 'column.varchar.email.not.null21@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4daee919.52458922', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s21columnVarcharUploadImageNotNull.gif', 21),
(22, '2020-12-22', '2020-12-22 22:00:02', '22:00:02', 22, 22, 22.22, '22Column Varchar Not Null', '22Column Longtext Not Null', '22Column Text Not Null', '2015-05-09 18:51:30', NULL, 6, NULL, '2020-12-22 22:00:02', '2020-12-22', 22.22, 0, 0, 'column.varchar.email.not.null22@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4daf6f12.46801308', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s22columnVarcharUploadImageNotNull.gif', 22),
(23, '2020-12-23', '2020-12-23 23:00:02', '23:00:02', 23, 23, 23.23, '23Column Varchar Not Null', '23Column Longtext Not Null', '23Column Text Not Null', '2015-05-09 18:51:30', NULL, 6, NULL, '2020-12-23 23:00:02', '2020-12-23', 23.23, 1, 1, 'column.varchar.email.not.null23@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4dafff14.09460336', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s23columnVarcharUploadImageNotNull.gif', 23),
(24, '2020-12-24', '2020-12-24 06:00:02', '06:00:02', 24, 24, 24.24, '24Column Varchar Not Null', '24Column Longtext Not Null', '24Column Text Not Null', '2015-05-09 18:51:30', NULL, 6, NULL, '2020-12-24 06:00:02', '2020-12-24', 24.24, 0, 0, 'column.varchar.email.not.null24@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db08619.64997180', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s24columnVarcharUploadImageNotNull.gif', 24),
(25, '2020-12-25', '2020-12-25 05:00:02', '05:00:02', 25, 25, 25.25, '25Column Varchar Not Null', '25Column Longtext Not Null', '25Column Text Not Null', '2015-05-09 18:51:30', NULL, 6, NULL, '2020-12-25 05:00:02', '2020-12-25', 25.25, 1, 1, 'column.varchar.email.not.null25@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db10d43.44336525', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s25columnVarcharUploadImageNotNull.gif', 25),
(26, '2020-12-26', '2020-12-26 04:00:02', '04:00:02', 26, 26, 26.26, '26Column Varchar Not Null', '26Column Longtext Not Null', '26Column Text Not Null', '2015-05-09 18:51:30', NULL, 7, NULL, '2020-12-26 04:00:02', '2020-12-26', 26.26, 0, 0, 'column.varchar.email.not.null26@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db1c2b9.54596867', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s26columnVarcharUploadImageNotNull.gif', 26),
(27, '2020-12-27', '2020-12-27 03:00:02', '03:00:02', 27, 27, 27.27, '27Column Varchar Not Null', '27Column Longtext Not Null', '27Column Text Not Null', '2015-05-09 18:51:30', NULL, 7, NULL, '2020-12-27 03:00:02', '2020-12-27', 27.27, 1, 1, 'column.varchar.email.not.null27@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db24fe2.28774442', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s27columnVarcharUploadImageNotNull.gif', 27),
(28, '2020-12-28', '2020-12-28 02:00:02', '02:00:02', 28, 28, 28.28, '28Column Varchar Not Null', '28Column Longtext Not Null', '28Column Text Not Null', '2015-05-09 18:51:30', NULL, 7, NULL, '2020-12-28 02:00:02', '2020-12-28', 28.28, 0, 0, 'column.varchar.email.not.null28@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db2e8c4.16609774', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s28columnVarcharUploadImageNotNull.gif', 28),
(29, '2020-12-29', '2020-12-29 01:00:02', '01:00:02', 29, 29, 29.29, '29Column Varchar Not Null', '29Column Longtext Not Null', '29Column Text Not Null', '2015-05-09 18:51:30', NULL, 7, NULL, '2020-12-29 01:00:02', '2020-12-29', 29.29, 1, 1, 'column.varchar.email.not.null29@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db3a789.38563893', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s29columnVarcharUploadImageNotNull.gif', 29),
(30, '2020-12-30', '2020-12-30 00:00:02', '00:00:02', 30, 30, 30.30, '30Column Varchar Not Null', '30Column Longtext Not Null', '30Column Text Not Null', '2015-05-09 18:51:30', NULL, 7, NULL, '2020-12-30 00:00:02', '2020-12-30', 30.30, 0, 0, 'column.varchar.email.not.null30@gmail.com', '$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG', '1554d2c4db43249.02671618', '/upload/columns-not-null-columnVarcharUploadImageNotNull/%s30columnVarcharUploadImageNotNull.gif', 30);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
(1, '01Name', '2015-05-09 18:51:26', NULL, 2, NULL),
(2, '02Name', '2015-05-09 18:51:26', NULL, 2, NULL),
(3, '03Name', '2015-05-09 18:51:26', NULL, 2, NULL),
(4, '04Name', '2015-05-09 18:51:26', NULL, 2, NULL),
(5, '05Name', '2015-05-09 18:51:26', NULL, 2, NULL),
(6, '06Name', '2015-05-09 18:51:26', NULL, 3, NULL),
(7, '07Name', '2015-05-09 18:51:26', NULL, 3, NULL),
(8, '08Name', '2015-05-09 18:51:26', NULL, 3, NULL),
(9, '09Name', '2015-05-09 18:51:26', NULL, 3, NULL),
(10, '10Name', '2015-05-09 18:51:26', NULL, 3, NULL),
(11, '11Name', '2015-05-09 18:51:26', NULL, 4, NULL),
(12, '12Name', '2015-05-09 18:51:26', NULL, 4, NULL),
(13, '13Name', '2015-05-09 18:51:26', NULL, 4, NULL),
(14, '14Name', '2015-05-09 18:51:26', NULL, 4, NULL),
(15, '15Name', '2015-05-09 18:51:26', NULL, 4, NULL),
(16, '16Name', '2015-05-09 18:51:26', NULL, 5, NULL),
(17, '17Name', '2015-05-09 18:51:26', NULL, 5, NULL),
(18, '18Name', '2015-05-09 18:51:26', NULL, 5, NULL),
(19, '19Name', '2015-05-09 18:51:26', NULL, 5, NULL),
(20, '20Name', '2015-05-09 18:51:26', NULL, 5, NULL),
(21, '21Name', '2015-05-09 18:51:26', NULL, 6, NULL),
(22, '22Name', '2015-05-09 18:51:26', NULL, 6, NULL),
(23, '23Name', '2015-05-09 18:51:26', NULL, 6, NULL),
(24, '24Name', '2015-05-09 18:51:26', NULL, 6, NULL),
(25, '25Name', '2015-05-09 18:51:26', NULL, 6, NULL),
(26, '26Name', '2015-05-09 18:51:27', NULL, 7, NULL),
(27, '27Name', '2015-05-09 18:51:27', NULL, 7, NULL),
(28, '28Name', '2015-05-09 18:51:27', NULL, 7, NULL),
(29, '29Name', '2015-05-09 18:51:27', NULL, 7, NULL),
(30, '30Name', '2015-05-09 18:51:27', NULL, 7, NULL);

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
(1, '01Name', '2015-05-09 18:51:27', NULL, 2, NULL),
(2, '02Name', '2015-05-09 18:51:27', NULL, 2, NULL),
(3, '03Name', '2015-05-09 18:51:27', NULL, 2, NULL),
(4, '04Name', '2015-05-09 18:51:27', NULL, 2, NULL),
(5, '05Name', '2015-05-09 18:51:27', NULL, 2, NULL),
(6, '06Name', '2015-05-09 18:51:27', NULL, 3, NULL),
(7, '07Name', '2015-05-09 18:51:27', NULL, 3, NULL),
(8, '08Name', '2015-05-09 18:51:27', NULL, 3, NULL),
(9, '09Name', '2015-05-09 18:51:27', NULL, 3, NULL),
(10, '10Name', '2015-05-09 18:51:27', NULL, 3, NULL),
(11, '11Name', '2015-05-09 18:51:27', NULL, 4, NULL),
(12, '12Name', '2015-05-09 18:51:27', NULL, 4, NULL),
(13, '13Name', '2015-05-09 18:51:27', NULL, 4, NULL),
(14, '14Name', '2015-05-09 18:51:27', NULL, 4, NULL),
(15, '15Name', '2015-05-09 18:51:27', NULL, 4, NULL),
(16, '16Name', '2015-05-09 18:51:27', NULL, 5, NULL),
(17, '17Name', '2015-05-09 18:51:27', NULL, 5, NULL),
(18, '18Name', '2015-05-09 18:51:27', NULL, 5, NULL),
(19, '19Name', '2015-05-09 18:51:27', NULL, 5, NULL),
(20, '20Name', '2015-05-09 18:51:27', NULL, 5, NULL),
(21, '21Name', '2015-05-09 18:51:27', NULL, 6, NULL),
(22, '22Name', '2015-05-09 18:51:27', NULL, 6, NULL),
(23, '23Name', '2015-05-09 18:51:27', NULL, 6, NULL),
(24, '24Name', '2015-05-09 18:51:27', NULL, 6, NULL),
(25, '25Name', '2015-05-09 18:51:27', NULL, 6, NULL),
(26, '26Name', '2015-05-09 18:51:27', NULL, 7, NULL),
(27, '27Name', '2015-05-09 18:51:27', NULL, 7, NULL),
(28, '28Name', '2015-05-09 18:51:27', NULL, 7, NULL),
(29, '29Name', '2015-05-09 18:51:27', NULL, 7, NULL),
(30, '30Name', '2015-05-09 18:51:27', NULL, 7, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
(1, NULL, 'guest', '2015-05-09 18:51:26', 2, NULL, NULL),
(2, 1, 'admin', '2015-05-09 18:51:26', 2, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
(1, '/upload/columns-image/%sqgmg3vmpzhlwthzmrpjr.gif', 0, '2015-05-09 18:51:27', 2, NULL, NULL, 1, NULL),
(2, '/upload/columns-image/%s3ag4iqeplm42sg9l2l1s.gif', 1, '2015-05-09 18:51:27', 2, NULL, NULL, 1, NULL),
(3, '/upload/columns-image/%stcfdk5p1kyjezp875dnh.gif', 2, '2015-05-09 18:51:27', 2, NULL, NULL, 1, NULL),
(4, '/upload/columns-image/%sqia8p9khlbz4e57p0nhb.gif', 0, '2015-05-09 18:51:27', 2, NULL, NULL, 2, NULL),
(5, '/upload/columns-image/%scqg15fz1ic8yk9xz977k.gif', 1, '2015-05-09 18:51:27', 2, NULL, NULL, 2, NULL),
(6, '/upload/columns-image/%s9xfescuiq1kshqkdv943.gif', 2, '2015-05-09 18:51:27', 2, NULL, NULL, 2, NULL),
(7, '/upload/columns-image/%sc3sm2fc1dacdxhhgk1o0.gif', 0, '2015-05-09 18:51:27', 2, NULL, NULL, 3, NULL),
(8, '/upload/columns-image/%stzj0fu30tyuvrc8khbck.gif', 1, '2015-05-09 18:51:27', 2, NULL, NULL, 3, NULL),
(9, '/upload/columns-image/%sbenymv4wnjn68xxehr41.gif', 2, '2015-05-09 18:51:27', 2, NULL, NULL, 3, NULL),
(10, '/upload/columns-image/%sfpnxrm7yn99oencq87dm.gif', 0, '2015-05-09 18:51:27', 2, NULL, NULL, 4, NULL),
(11, '/upload/columns-image/%sgrife6jmneettrga3ezg.gif', 1, '2015-05-09 18:51:27', 2, NULL, NULL, 4, NULL),
(12, '/upload/columns-image/%sezuicxybu2n1jw7osh06.gif', 2, '2015-05-09 18:51:27', 2, NULL, NULL, 4, NULL),
(13, '/upload/columns-image/%sl4p5mw6f0wm4l7cov1pg.gif', 0, '2015-05-09 18:51:27', 2, NULL, NULL, 5, NULL),
(14, '/upload/columns-image/%su383p5h8c84o3jjf5flw.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 5, NULL),
(15, '/upload/columns-image/%s1yqdvtrgl7n61lzhg7fj.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 5, NULL),
(16, '/upload/columns-image/%s69xzj74fdg154i8q2qwe.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 6, NULL),
(17, '/upload/columns-image/%soaafl0mryr1uroj1me6p.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 6, NULL),
(18, '/upload/columns-image/%skyke7juzzh4dh4jtvvaj.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 6, NULL),
(19, '/upload/columns-image/%sd23vgcmthi8r6iw3shth.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 7, NULL),
(20, '/upload/columns-image/%spnlxiug3ghdj964g9gzg.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 7, NULL),
(21, '/upload/columns-image/%spxym6lgos0w8e7vms1gy.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 7, NULL),
(22, '/upload/columns-image/%s9j78g2eg94npsb1pn846.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 8, NULL),
(23, '/upload/columns-image/%syq42oqf6hmuhwsf2lk8l.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 8, NULL),
(24, '/upload/columns-image/%sel0wnsb0q5wfmr707cxf.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 8, NULL),
(25, '/upload/columns-image/%sphmb0r3c22n6edtswvid.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 9, NULL),
(26, '/upload/columns-image/%sr5i3mfujihpxp1yfjshb.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 9, NULL),
(27, '/upload/columns-image/%slv8pzr7ldgoubwno28ya.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 9, NULL),
(28, '/upload/columns-image/%sfdyv5n0e58ghufwjxuu0.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 10, NULL),
(29, '/upload/columns-image/%s19k2vyhnw6o2acn5qeal.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 10, NULL),
(30, '/upload/columns-image/%sdgtxlf680rzrq9kcysql.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 10, NULL),
(31, '/upload/columns-image/%so5eo8sjowj00qjo2pl1f.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 11, NULL),
(32, '/upload/columns-image/%s2qxjq7mep2q4xuiwcsaz.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 11, NULL),
(33, '/upload/columns-image/%s20qi94bof2u8ihhzfu4v.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 11, NULL),
(34, '/upload/columns-image/%smkpa5xw7fxx7ndgn7h2d.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 12, NULL),
(35, '/upload/columns-image/%sanbiuj8032lgc1h7o45u.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 12, NULL),
(36, '/upload/columns-image/%srts4wyiu6ay6n0f8ady4.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 12, NULL),
(37, '/upload/columns-image/%s5aa81i6gc20tmjo98wt4.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 13, NULL),
(38, '/upload/columns-image/%sxi1a8688ax26y35pb2we.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 13, NULL),
(39, '/upload/columns-image/%sunx6wc5uypplygmxdlwd.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 13, NULL),
(40, '/upload/columns-image/%s9p9xi5dkxzphccezfaj4.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 14, NULL),
(41, '/upload/columns-image/%sqyge4s173nb32bqb6umu.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 14, NULL),
(42, '/upload/columns-image/%sk11n46c97m3na9r5sj3m.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 14, NULL),
(43, '/upload/columns-image/%sw5fp6wq3g3nquf4ob6n8.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 15, NULL),
(44, '/upload/columns-image/%sihmjh3fzc8bz3he03vt9.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 15, NULL),
(45, '/upload/columns-image/%so7q8ckneh1dq8p0gj55m.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 15, NULL),
(46, '/upload/columns-image/%s47byego8288g5of8zsc7.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 16, NULL),
(47, '/upload/columns-image/%skfojvep49lg3jisoo6mh.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 16, NULL),
(48, '/upload/columns-image/%s5kn1ztzpc1mm71wt5bn4.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 16, NULL),
(49, '/upload/columns-image/%snuyw2gbhdno8y20olp3o.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 17, NULL),
(50, '/upload/columns-image/%shg1e7nx2obx2vmpotqww.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 17, NULL),
(51, '/upload/columns-image/%s4bvs4l6g10u87lc4y0xd.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 17, NULL),
(52, '/upload/columns-image/%s2l5oxk2h1p3vrpel1ass.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 18, NULL),
(53, '/upload/columns-image/%s1dqyottdjhhcscqgnine.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 18, NULL),
(54, '/upload/columns-image/%syhzgw3so4a6wdnls64wg.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 18, NULL),
(55, '/upload/columns-image/%sb3iu6y0j7eowle288km3.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 19, NULL),
(56, '/upload/columns-image/%sljpow07tvtzwm8hjw7su.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 19, NULL),
(57, '/upload/columns-image/%sb7gnb8lajy3u7j9ua7dv.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 19, NULL),
(58, '/upload/columns-image/%sq2i31pcnnv8pte2uddvn.gif', 0, '2015-05-09 18:51:28', 2, NULL, NULL, 20, NULL),
(59, '/upload/columns-image/%s1o8zy7jy5mkmftg79ikn.gif', 1, '2015-05-09 18:51:28', 2, NULL, NULL, 20, NULL),
(60, '/upload/columns-image/%s4j2nnu8ryt4q82gx0pmv.gif', 2, '2015-05-09 18:51:28', 2, NULL, NULL, 20, NULL),
(61, '/upload/columns-image/%s2w78gd5gmgthpmv37tkw.gif', 0, '2015-05-09 18:51:29', 2, NULL, NULL, 21, NULL),
(62, '/upload/columns-image/%sdecc7izxybjqyho5kkbx.gif', 1, '2015-05-09 18:51:29', 2, NULL, NULL, 21, NULL),
(63, '/upload/columns-image/%sqv567qz599rdetfc25zq.gif', 2, '2015-05-09 18:51:29', 2, NULL, NULL, 21, NULL),
(64, '/upload/columns-image/%s797vgmrrwsedea9cqy7q.gif', 0, '2015-05-09 18:51:29', 2, NULL, NULL, 22, NULL),
(65, '/upload/columns-image/%syot37z50uvgsued1qvic.gif', 1, '2015-05-09 18:51:29', 2, NULL, NULL, 22, NULL),
(66, '/upload/columns-image/%senginfk34hjtw3ntsikd.gif', 2, '2015-05-09 18:51:29', 2, NULL, NULL, 22, NULL),
(67, '/upload/columns-image/%s4qvpuzgbkpeo2kxgq8ak.gif', 0, '2015-05-09 18:51:29', 2, NULL, NULL, 23, NULL),
(68, '/upload/columns-image/%sgj42dhmwqwzldl0yb7zl.gif', 1, '2015-05-09 18:51:29', 2, NULL, NULL, 23, NULL),
(69, '/upload/columns-image/%sm30fdnlumm5svzkz7wln.gif', 2, '2015-05-09 18:51:29', 2, NULL, NULL, 23, NULL),
(70, '/upload/columns-image/%siaylmp9nmzzzsp4w3ggf.gif', 0, '2015-05-09 18:51:29', 2, NULL, NULL, 24, NULL),
(71, '/upload/columns-image/%ssbxe183yueb2f0erfe5s.gif', 1, '2015-05-09 18:51:29', 2, NULL, NULL, 24, NULL),
(72, '/upload/columns-image/%s3uhm9b83if90hx58vywf.gif', 2, '2015-05-09 18:51:29', 2, NULL, NULL, 24, NULL),
(73, '/upload/columns-image/%s3y89pdruhmdb6kn6ml0u.gif', 0, '2015-05-09 18:51:29', 2, NULL, NULL, 25, NULL),
(74, '/upload/columns-image/%srzlymhw86jdz8cznfg8n.gif', 1, '2015-05-09 18:51:29', 2, NULL, NULL, 25, NULL),
(75, '/upload/columns-image/%stbopl1myddju2vjf25dy.gif', 2, '2015-05-09 18:51:29', 2, NULL, NULL, 25, NULL),
(76, '/upload/columns-image/%sfhodjeqpko23qgj28wqb.gif', 0, '2015-05-09 18:51:29', 2, NULL, NULL, 26, NULL),
(77, '/upload/columns-image/%sz0wsl5xe11378iaimrxw.gif', 1, '2015-05-09 18:51:29', 2, NULL, NULL, 26, NULL),
(78, '/upload/columns-image/%s6qqmw0evmvxclkuxgh18.gif', 2, '2015-05-09 18:51:29', 2, NULL, NULL, 26, NULL),
(79, '/upload/columns-image/%s9v5736gfn42jkjw791sm.gif', 0, '2015-05-09 18:51:29', 2, NULL, NULL, 27, NULL),
(80, '/upload/columns-image/%smfoyp8mwgeufzpdsljyy.gif', 1, '2015-05-09 18:51:29', 2, NULL, NULL, 27, NULL),
(81, '/upload/columns-image/%sdq8n0vlzm3cz9qnpo0bu.gif', 2, '2015-05-09 18:51:29', 2, NULL, NULL, 27, NULL),
(82, '/upload/columns-image/%s4v0ta3cmd0bghau7v5x7.gif', 0, '2015-05-09 18:51:29', 2, NULL, NULL, 28, NULL),
(83, '/upload/columns-image/%szzwyfadu0ffu05e1zge2.gif', 1, '2015-05-09 18:51:29', 2, NULL, NULL, 28, NULL),
(84, '/upload/columns-image/%s7f8eftc0o0ydpk2vl6gb.gif', 2, '2015-05-09 18:51:29', 2, NULL, NULL, 28, NULL),
(85, '/upload/columns-image/%sblw2h0u67zy44x9agb1v.gif', 0, '2015-05-09 18:51:29', 2, NULL, NULL, 29, NULL),
(86, '/upload/columns-image/%s2pzi0r3bnadplzitq2pn.gif', 1, '2015-05-09 18:51:29', 2, NULL, NULL, 29, NULL),
(87, '/upload/columns-image/%sreim1hn8jetbujjk0dme.gif', 2, '2015-05-09 18:51:29', 2, NULL, NULL, 29, NULL),
(88, '/upload/columns-image/%sdpupe28vvo8dsgpko3ix.gif', 0, '2015-05-09 18:51:29', 2, NULL, NULL, 30, NULL),
(89, '/upload/columns-image/%s72zrb922ce6gtrvyjuj4.gif', 1, '2015-05-09 18:51:29', 2, NULL, NULL, 30, NULL),
(90, '/upload/columns-image/%s8i8rpo13h9re2gw3fpvi.gif', 2, '2015-05-09 18:51:29', 2, NULL, NULL, 30, NULL);

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
(1, 'gear@pibernetwork.com', '$2y$14$XRdrbhksYkjENJtpsJnaLOM5V40Ayg3B7V4m0Z6vMz14qi0Xw3qu.', '', 1, '1554e81574f1df8.26462115', '2015-05-09 18:51:19', '2015-05-09 18:51:19', 1, 1, NULL),
(2, 'usuariogear1@gmail.com', '$2y$14$9tkOoDOHBlJmYdHnMocMJeWsRPPTUvII.ucMp9ZEbLS.qtZFU/nEq', '', 1, '1554e8158982984.32103037', '2015-05-09 18:51:20', NULL, NULL, NULL, 2),
(3, 'usuariogear2@gmail.com', '$2y$14$lyo.1xwr8HZMmATQhBRvMeg96eM7bgwEkll5A4BaAZxiDreXBvVKO', '', 1, '1554e8159d64d80.52635812', '2015-05-09 18:51:21', '2015-05-09 18:51:21', 3, 3, 2),
(4, 'usuariogear3@gmail.com', '$2y$14$fep2s54iOimrMOPx8uLO0ujXMFin5sws6A2jawSQq1jTrjuEAmFW6', '', 1, '1554e815b2596d7.17210323', '2015-05-09 18:51:23', '2015-05-09 18:51:23', 4, 4, 2),
(5, 'usuariogear4@gmail.com', '$2y$14$Ag50.xi5NYua.KtNCRXOWuATbPd5eUjGrnb9HiGjbxk7b5GxZdTTa', '', 1, '1554e815c5de459.91174595', '2015-05-09 18:51:24', '2015-05-09 18:51:24', 5, 5, 2),
(6, 'usuariogear5@gmail.com', '$2y$14$ED5wn2vZO.EHAZ0k2xMD8.Plu8BzHOvDg8b..Fru3YTM1lpP40HHG', '', 1, '1554e815d9a0275.27155114', '2015-05-09 18:51:25', '2015-05-09 18:51:25', 6, 6, 2),
(7, 'usuariogear6@gmail.com', '$2y$14$pxjQ07fm5Qbhh5AVO7Yc8O3jpFrDLyfpip1tZPdyYvvUedrqcbP3q', '', 1, '1554e815ed591e8.70289755', '2015-05-09 18:51:26', '2015-05-09 18:51:26', 7, 7, 2);

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
