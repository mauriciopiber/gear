-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 18, 2014 at 09:58 PM
-- Server version: 5.5.35
-- PHP Version: 5.5.15-1+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zf2-module-gear-admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `id_action` int(11) NOT NULL AUTO_INCREMENT,
  `id_controller` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_action`),
  KEY `IDX_47CC8C92E978E64D` (`id_controller`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id_action`, `id_controller`, `name`, `created`, `updated`) VALUES
(1, 7, 'importrule', '2014-07-23 16:25:38', NULL),
(2, 2, 'login', '2014-07-23 16:25:38', NULL),
(3, 2, 'autenticate', '2014-07-23 16:25:38', NULL),
(4, 2, 'logout', '2014-07-23 16:25:38', NULL),
(5, 2, 'register', '2014-07-23 16:25:38', NULL),
(6, 1, 'register', '2014-07-23 16:25:38', NULL),
(7, 1, 'successfully-register', '2014-07-23 16:25:38', NULL),
(8, 1, 'logout', '2014-07-23 16:25:38', NULL),
(9, 1, 'login', '2014-07-23 16:25:38', NULL),
(10, 1, 'invalid-link', '2014-07-23 16:25:38', NULL),
(11, 1, 'password-recovery', '2014-07-23 16:25:38', NULL),
(12, 1, 'password-recovery-request', '2014-07-23 16:25:38', NULL),
(13, 1, 'password-recovery-successful', '2014-07-23 16:25:38', NULL),
(14, 1, 'activation', '2014-07-23 16:25:38', NULL),
(15, 1, 'activation-request', '2014-07-23 16:25:38', NULL),
(16, 1, 'activation-successful', '2014-07-23 16:25:38', NULL),
(17, 1, 'inactivation', '2014-07-23 16:25:38', NULL),
(18, 1, 'waiting-activation', '2014-07-23 16:25:38', NULL),
(19, 1, 'change-password', '2014-07-23 16:25:38', NULL),
(20, 1, 'details', '2014-07-23 16:25:38', NULL),
(21, 1, 'edit-details', '2014-07-23 16:25:38', NULL),
(22, 3, 'adicionar', '2014-07-23 16:25:38', NULL),
(23, 3, 'editar', '2014-07-23 16:25:38', NULL),
(24, 3, 'listar', '2014-07-23 16:25:38', NULL),
(25, 3, 'deletar', '2014-07-23 16:25:38', NULL),
(26, 3, 'visualizar', '2014-07-23 16:25:38', NULL),
(27, 4, 'adicionar', '2014-07-23 16:25:38', NULL),
(28, 4, 'editar', '2014-07-23 16:25:38', NULL),
(29, 4, 'listar', '2014-07-23 16:25:38', NULL),
(30, 4, 'deletar', '2014-07-23 16:25:38', NULL),
(31, 4, 'visualizar', '2014-07-23 16:25:38', NULL),
(32, 5, 'adicionar', '2014-07-23 16:25:38', NULL),
(33, 5, 'editar', '2014-07-23 16:25:38', NULL),
(34, 5, 'listar', '2014-07-23 16:25:38', NULL),
(35, 5, 'deletar', '2014-07-23 16:25:39', NULL),
(36, 5, 'visualizar', '2014-07-23 16:25:39', NULL),
(37, 6, 'adicionar', '2014-07-23 16:25:39', NULL),
(38, 6, 'editar', '2014-07-23 16:25:39', NULL),
(39, 6, 'listar', '2014-07-23 16:25:39', NULL),
(40, 6, 'deletar', '2014-07-23 16:25:39', NULL),
(41, 6, 'visualizar', '2014-07-23 16:25:39', NULL),
(42, 7, 'adicionar', '2014-07-23 16:25:39', NULL),
(43, 7, 'editar', '2014-07-23 16:25:39', NULL),
(44, 7, 'listar', '2014-07-23 16:25:39', NULL),
(45, 7, 'deletar', '2014-07-23 16:25:39', NULL),
(46, 7, 'visualizar', '2014-07-23 16:25:39', NULL),
(47, 8, 'adicionar', '2014-07-23 16:25:39', NULL),
(48, 8, 'editar', '2014-07-23 16:25:39', NULL),
(49, 8, 'listar', '2014-07-23 16:25:39', NULL),
(50, 8, 'deletar', '2014-07-23 16:25:39', NULL),
(51, 8, 'visualizar', '2014-07-23 16:25:39', NULL),
(52, 1, 'password-recovery-request-successful', '2014-07-23 17:15:58', NULL),
(53, 1, 'index', '2014-07-23 20:09:42', NULL),
(54, 1, 'change-user-data', '2014-07-24 15:41:22', NULL),
(55, 1, 'send-activation', '2014-08-19 00:57:51', NULL),
(56, 1, 'activation-sent', '2014-08-19 00:57:51', NULL),
(57, 1, 'log-on', '2014-08-19 00:57:51', NULL),
(58, 1, 'log-out', '2014-08-19 00:57:51', NULL),
(59, 1, 'log-in', '2014-08-19 00:57:51', NULL),
(60, 1, 'change-data', '2014-08-19 00:57:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `controller`
--

CREATE TABLE IF NOT EXISTS `controller` (
  `id_controller` int(11) NOT NULL AUTO_INCREMENT,
  `id_module` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `invokable` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_controller`),
  KEY `IDX_4CF2669A2A1393C5` (`id_module`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `controller`
--

INSERT INTO `controller` (`id_controller`, `id_module`, `name`, `invokable`, `created`, `updated`) VALUES
(1, 1, 'Index', 'GearAdmin\\Controller\\Index', '2014-07-23 16:25:38', NULL),
(2, 2, 'ZfcUser', 'zfcuser', '2014-07-23 16:25:38', NULL),
(3, 1, 'Module', 'GearAdmin\\Controller\\Module', '2014-07-23 16:25:38', NULL),
(4, 1, 'Controller', 'GearAdmin\\Controller\\Controller', '2014-07-23 16:25:38', NULL),
(5, 1, 'Action', 'GearAdmin\\Controller\\Action', '2014-07-23 16:25:38', NULL),
(6, 1, 'Role', 'GearAdmin\\Controller\\Role', '2014-07-23 16:25:39', NULL),
(7, 1, 'Rule', 'GearAdmin\\Controller\\Rule', '2014-07-23 16:25:39', NULL),
(8, 1, 'User', 'GearAdmin\\Controller\\User', '2014-07-23 16:25:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `remetente` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `destino` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `assunto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mensagem` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_module`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id_module`, `name`, `created`, `updated`) VALUES
(1, 'GearAdmin', '2014-07-23 16:25:38', NULL),
(2, 'ZfcUser', '2014-07-23 16:25:38', '2014-07-23 16:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_parent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_role`),
  KEY `IDX_57698A6A1BB9D5A2` (`id_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `id_parent`, `name`, `created`, `updated`) VALUES
('admin', 'client', 'admin', '2014-07-23 16:25:38', NULL),
('client', 'guest', 'client', '2014-07-23 16:25:38', NULL),
('guest', NULL, 'guest', '2014-07-23 16:25:38', NULL),
('master', 'admin', 'master', '2014-07-23 16:25:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE IF NOT EXISTS `rule` (
  `id_rule` int(11) NOT NULL AUTO_INCREMENT,
  `id_action` int(11) NOT NULL,
  `id_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_controller` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rule`),
  KEY `IDX_46D8ACCC61FB397F` (`id_action`),
  KEY `IDX_46D8ACCCDC499668` (`id_role`),
  KEY `IDX_46D8ACCCE978E64D` (`id_controller`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id_rule`, `id_action`, `id_role`, `id_controller`, `created`, `updated`) VALUES
(1, 1, 'guest', 7, '2014-07-23 16:25:38', NULL),
(2, 2, 'guest', 2, '2014-07-23 16:25:38', NULL),
(3, 3, 'guest', 2, '2014-07-23 16:25:38', NULL),
(4, 4, 'admin', 2, '2014-07-23 16:25:38', NULL),
(5, 5, 'guest', 2, '2014-07-23 16:25:38', NULL),
(6, 6, 'guest', 1, '2014-07-23 16:25:38', NULL),
(7, 7, 'guest', 1, '2014-07-23 16:25:38', NULL),
(8, 8, 'client', 1, '2014-07-23 16:25:38', NULL),
(9, 9, 'guest', 1, '2014-07-23 16:25:38', NULL),
(10, 10, 'guest', 1, '2014-07-23 16:25:38', NULL),
(11, 11, 'guest', 1, '2014-07-23 16:25:38', NULL),
(12, 12, 'guest', 1, '2014-07-23 16:25:38', NULL),
(13, 13, 'guest', 1, '2014-07-23 16:25:38', NULL),
(14, 14, 'guest', 1, '2014-07-23 16:25:38', NULL),
(15, 15, 'guest', 1, '2014-07-23 16:25:38', NULL),
(16, 16, 'guest', 1, '2014-07-23 16:25:38', NULL),
(17, 17, 'client', 1, '2014-07-23 16:25:38', NULL),
(18, 18, 'guest', 1, '2014-07-23 16:25:38', NULL),
(19, 19, 'client', 1, '2014-07-23 16:25:38', NULL),
(20, 20, 'client', 1, '2014-07-23 16:25:38', NULL),
(21, 21, 'client', 1, '2014-07-23 16:25:38', NULL),
(22, 22, 'admin', 3, '2014-07-23 16:25:38', NULL),
(23, 23, 'admin', 3, '2014-07-23 16:25:38', NULL),
(24, 24, 'admin', 3, '2014-07-23 16:25:38', NULL),
(25, 25, 'admin', 3, '2014-07-23 16:25:38', NULL),
(26, 26, 'admin', 3, '2014-07-23 16:25:38', NULL),
(27, 27, 'admin', 4, '2014-07-23 16:25:38', NULL),
(28, 28, 'admin', 4, '2014-07-23 16:25:38', NULL),
(29, 29, 'admin', 4, '2014-07-23 16:25:38', NULL),
(30, 30, 'admin', 4, '2014-07-23 16:25:38', NULL),
(31, 31, 'admin', 4, '2014-07-23 16:25:38', NULL),
(32, 32, 'admin', 5, '2014-07-23 16:25:38', NULL),
(33, 33, 'admin', 5, '2014-07-23 16:25:38', NULL),
(34, 34, 'admin', 5, '2014-07-23 16:25:38', NULL),
(35, 35, 'admin', 5, '2014-07-23 16:25:39', NULL),
(36, 36, 'admin', 5, '2014-07-23 16:25:39', NULL),
(37, 37, 'admin', 6, '2014-07-23 16:25:39', NULL),
(38, 38, 'admin', 6, '2014-07-23 16:25:39', NULL),
(39, 39, 'admin', 6, '2014-07-23 16:25:39', NULL),
(40, 40, 'admin', 6, '2014-07-23 16:25:39', NULL),
(41, 41, 'admin', 6, '2014-07-23 16:25:39', NULL),
(42, 42, 'admin', 7, '2014-07-23 16:25:39', NULL),
(43, 43, 'admin', 7, '2014-07-23 16:25:39', NULL),
(44, 44, 'admin', 7, '2014-07-23 16:25:39', NULL),
(45, 45, 'admin', 7, '2014-07-23 16:25:39', NULL),
(46, 46, 'admin', 7, '2014-07-23 16:25:39', NULL),
(47, 47, 'master', 8, '2014-07-23 16:25:39', NULL),
(48, 48, 'master', 8, '2014-07-23 16:25:39', NULL),
(49, 49, 'master', 8, '2014-07-23 16:25:39', NULL),
(50, 50, 'master', 8, '2014-07-23 16:25:39', NULL),
(51, 51, 'master', 8, '2014-07-23 16:25:39', NULL),
(52, 52, 'guest', 1, '2014-07-23 17:15:58', NULL),
(53, 53, 'guest', 1, '2014-07-23 20:09:42', NULL),
(54, 54, 'client', 1, '2014-07-24 15:41:23', NULL),
(55, 55, 'guest', 1, '2014-08-19 00:57:51', NULL),
(56, 56, 'guest', 1, '2014-08-19 00:57:51', NULL),
(57, 57, 'guest', 1, '2014-08-19 00:57:51', NULL),
(58, 58, 'client', 1, '2014-08-19 00:57:51', NULL),
(59, 59, 'guest', 1, '2014-08-19 00:57:51', NULL),
(60, 60, 'client', 1, '2014-08-19 00:57:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL,
  `uid` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `username`, `state`, `uid`, `created`, `updated`) VALUES
(14, 'email1@gmail.com', '$2y$10$UfBN6QuYiyVoCwgB/1U8yui6ADhACs8GIr0ZC2iOixZqRxD4INAEu', '', 1, NULL, '2014-08-19 00:57:11', NULL),
(15, 'email2@gmail.com', '$2y$10$UfBN6QuYiyVoCwgB/1U8yui6ADhACs8GIr0ZC2iOixZqRxD4INAEu', '', 0, NULL, '2014-08-19 00:57:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role_linker`
--

CREATE TABLE IF NOT EXISTS `user_role_linker` (
  `id_user` int(11) NOT NULL,
  `id_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`,`id_role`),
  KEY `IDX_611178996B3CA4B` (`id_user`),
  KEY `IDX_61117899DC499668` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_role_linker`
--

INSERT INTO `user_role_linker` (`id_user`, `id_role`) VALUES
(1, 'admin'),
(2, 'admin');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `FK_47CC8C92E978E64D` FOREIGN KEY (`id_controller`) REFERENCES `controller` (`id_controller`) ON DELETE CASCADE;

--
-- Constraints for table `controller`
--
ALTER TABLE `controller`
  ADD CONSTRAINT `FK_4CF2669A2A1393C5` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`) ON DELETE CASCADE;

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `FK_57698A6A1BB9D5A2` FOREIGN KEY (`id_parent`) REFERENCES `role` (`id_role`) ON DELETE CASCADE;

--
-- Constraints for table `rule`
--
ALTER TABLE `rule`
  ADD CONSTRAINT `FK_46D8ACCCDC499668` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_46D8ACCC61FB397F` FOREIGN KEY (`id_action`) REFERENCES `action` (`id_action`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_46D8ACCCE978E64D` FOREIGN KEY (`id_controller`) REFERENCES `controller` (`id_controller`) ON DELETE CASCADE;

--
-- Constraints for table `user_role_linker`
--
ALTER TABLE `user_role_linker`
  ADD CONSTRAINT `FK_611178996B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_61117899DC499668` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
