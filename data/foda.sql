-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: project_mvc
-- ------------------------------------------------------
-- Server version	5.5.54-0+deb8u1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `action`
--

DROP TABLE IF EXISTS `action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `action` (
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
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `action_ibfk_1` FOREIGN KEY (`id_controller`) REFERENCES `controller` (`id_controller`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `action_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `action_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

LOCK TABLES `action` WRITE;
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
/*!40000 ALTER TABLE `action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `all_columns`
--

DROP TABLE IF EXISTS `all_columns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `all_columns` (
  `id_all_columns` int(11) NOT NULL AUTO_INCREMENT,
  `varchar_password_verify` varchar(255) DEFAULT NULL,
  `varchar_upload_image` varchar(255) DEFAULT NULL,
  `varchar_url` varchar(255) DEFAULT NULL,
  `varchar_varchar` varchar(45) DEFAULT NULL,
  `varchar_unique_id` varchar(255) DEFAULT NULL,
  `varchar_telephone` varchar(255) DEFAULT NULL,
  `varchar_email` varchar(255) DEFAULT NULL,
  `date_date` date DEFAULT NULL,
  `date_date_pt_br` date DEFAULT NULL,
  `datetime_datetime` datetime DEFAULT NULL,
  `datetime_datetime_pt_br` datetime DEFAULT NULL,
  `time_time` time DEFAULT NULL,
  `decimal_decimal` decimal(10,2) DEFAULT NULL,
  `decimal_money_pt_br` decimal(10,2) DEFAULT NULL,
  `int_int` int(11) DEFAULT NULL,
  `int_checkbox` int(11) DEFAULT NULL,
  `id_int_foreign_key` int(11) DEFAULT NULL,
  `tinyint_tinyint` tinyint(1) DEFAULT NULL,
  `tinyint_checkbox` tinyint(1) DEFAULT NULL,
  `text_text` text,
  `text_html` text,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_all_columns`),
  KEY `id_int_foreign_key` (`id_int_foreign_key`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `all_columns_ibfk_1` FOREIGN KEY (`id_int_foreign_key`) REFERENCES `int_foreign_key` (`id_int_foreign_key`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `all_columns_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `all_columns_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `all_columns`
--

LOCK TABLES `all_columns` WRITE;
/*!40000 ALTER TABLE `all_columns` DISABLE KEYS */;
/*!40000 ALTER TABLE `all_columns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controller`
--

DROP TABLE IF EXISTS `controller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `controller` (
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
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `controller_ibfk_1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `controller_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `controller_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controller`
--

LOCK TABLES `controller` WRITE;
/*!40000 ALTER TABLE `controller` DISABLE KEYS */;
/*!40000 ALTER TABLE `controller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email` (
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
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `email_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `email_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `int_foreign_key`
--

DROP TABLE IF EXISTS `int_foreign_key`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `int_foreign_key` (
  `id_int_foreign_key` int(11) NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_int_foreign_key`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `int_foreign_key_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `int_foreign_key_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `int_foreign_key`
--

LOCK TABLES `int_foreign_key` WRITE;
/*!40000 ALTER TABLE `int_foreign_key` DISABLE KEYS */;
/*!40000 ALTER TABLE `int_foreign_key` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (20150223203704,'CreateGearAdmin','2017-03-17 02:36:39','2017-03-17 02:36:39',0),(20150223203705,'CreateGearImage','2017-03-17 02:36:39','2017-03-17 02:36:39',0),(20150304070210,'ReplaceRoleOneToMany','2017-03-17 02:36:39','2017-03-17 02:36:39',0),(20160123222068,'AllColumns','2017-03-17 02:38:22','2017-03-17 02:38:22',0);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_module`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `module_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `module_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phinxlog`
--

DROP TABLE IF EXISTS `phinxlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phinxlog`
--

LOCK TABLES `phinxlog` WRITE;
/*!40000 ALTER TABLE `phinxlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `phinxlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
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
  KEY `id_parent` (`id_parent`),
  CONSTRAINT `role_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_ibfk_3` FOREIGN KEY (`id_parent`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rule`
--

DROP TABLE IF EXISTS `rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rule` (
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
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `rule_ibfk_1` FOREIGN KEY (`id_action`) REFERENCES `action` (`id_action`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rule_ibfk_2` FOREIGN KEY (`id_controller`) REFERENCES `controller` (`id_controller`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rule_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rule_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rule_ibfk_5` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rule`
--

LOCK TABLES `rule` WRITE;
/*!40000 ALTER TABLE `rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_image`
--

DROP TABLE IF EXISTS `upload_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `upload_image` (
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
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `upload_image_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `upload_image_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_image`
--

LOCK TABLES `upload_image` WRITE;
/*!40000 ALTER TABLE `upload_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `state` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  KEY `updated_by` (`updated_by`),
  KEY `id_role` (`id_role`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-17 22:21:45
