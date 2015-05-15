-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 15, 2015 at 05:51 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=97 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `columns_not_null_unique`
--

CREATE TABLE IF NOT EXISTS `columns_not_null_unique` (
  `id_columns_not_null_unique` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id_columns_not_null_unique`),
  UNIQUE KEY `column_date_not_null_UNIQUE` (`column_date_not_null`),
  UNIQUE KEY `column_datetime_not_null_UNIQUE` (`column_datetime_not_null`),
  UNIQUE KEY `column_time_not_null_UNIQUE` (`column_time_not_null`),
  UNIQUE KEY `column_int_not_null_UNIQUE` (`column_int_not_null`),
  UNIQUE KEY `column_decimal_not_null_UNIQUE` (`column_decimal_not_null`),
  UNIQUE KEY `column_varchar_not_null_UNIQUE` (`column_varchar_not_null`),
  UNIQUE KEY `column_datetime_pt_br_not_null_UNIQUE` (`column_datetime_pt_br_not_null`),
  UNIQUE KEY `column_date_pt_br_not_null_UNIQUE` (`column_date_pt_br_not_null`),
  UNIQUE KEY `column_decimal_pt_br_not_null_UNIQUE` (`column_decimal_pt_br_not_null`),
  UNIQUE KEY `column_varchar_email_not_null_UNIQUE` (`column_varchar_email_not_null`),
  UNIQUE KEY `column_varchar_unique_id_not_null_UNIQUE` (`column_varchar_unique_id_not_null`),
  UNIQUE KEY `column_foreign_key_copy_not_null_UNIQUE` (`column_foreign_key_copy_not_null`),
  UNIQUE KEY `column_varchar_upload_image_not_null_UNIQUE` (`column_varchar_upload_image_not_null`),
  KEY `columns_not_null_ibfk_1` (`created_by`),
  KEY `columns_not_null_ibfk_2` (`updated_by`),
  KEY `fk_columns_not_null_1` (`column_foreign_key_copy_not_null`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=97 ;

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
-- Constraints for table `columns_not_null_unique`
--
ALTER TABLE `columns_not_null_unique`
  ADD CONSTRAINT `columns_not_null_ibfk_10` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `columns_not_null_ibfk_20` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_columns_not_null_10` FOREIGN KEY (`column_foreign_key_copy_not_null`) REFERENCES `foreign_keys_copy` (`id_foreign_keys_copy`) ON DELETE CASCADE ON UPDATE CASCADE;

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
