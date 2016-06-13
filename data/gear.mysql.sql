-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: gear
-- ------------------------------------------------------
-- Server version	5.5.47-0+deb8u1

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
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

LOCK TABLES `action` WRITE;
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` VALUES (1,1,'Acl','2015-08-29 06:48:00',2,NULL,NULL),(2,1,'ResetAcl','2015-08-29 06:48:00',2,NULL,NULL),(3,2,'AutoincrementDatabase','2015-08-29 06:48:00',2,NULL,NULL),(4,2,'DropTable','2015-08-29 06:48:00',2,NULL,NULL),(5,2,'MockTable','2015-08-29 06:48:00',2,NULL,NULL),(6,2,'GetOrder','2015-08-29 06:48:00',2,NULL,NULL),(7,2,'AnalyseDatabase','2015-08-29 06:48:00',2,NULL,NULL),(8,2,'AnalyseTable','2015-08-29 06:48:00',2,NULL,NULL),(9,2,'AutoincrementTable','2015-08-29 06:48:00',2,NULL,NULL),(10,2,'ClearTable','2015-08-29 06:48:00',2,NULL,NULL),(11,2,'CreateColumn','2015-08-29 06:48:00',2,NULL,NULL),(12,2,'FixDatabase','2015-08-29 06:48:00',2,NULL,NULL),(13,2,'FixTable','2015-08-29 06:48:00',2,NULL,NULL),(14,2,'MysqlLoad','2015-08-29 06:48:00',2,NULL,NULL),(15,2,'MysqlDump','2015-08-29 06:48:00',2,NULL,NULL),(16,2,'Fixture','2015-08-29 06:48:00',2,NULL,NULL),(17,3,'Build','2015-08-29 06:48:00',2,NULL,NULL),(18,4,'Action','2015-08-29 06:48:00',2,NULL,NULL),(19,4,'Controller','2015-08-29 06:48:00',2,NULL,NULL),(20,4,'Db','2015-08-29 06:48:00',2,NULL,NULL),(21,4,'Src','2015-08-29 06:48:00',2,NULL,NULL),(22,4,'Test','2015-08-29 06:48:00',2,NULL,NULL),(23,4,'View','2015-08-29 06:48:00',2,NULL,NULL),(24,5,'Entities','2015-08-29 06:48:00',2,NULL,NULL),(25,5,'Entity','2015-08-29 06:48:00',2,NULL,NULL),(26,5,'Dump','2015-08-29 06:48:00',2,NULL,NULL),(27,5,'Create','2015-08-29 06:48:00',2,NULL,NULL),(28,5,'Delete','2015-08-29 06:48:00',2,NULL,NULL),(29,5,'Load','2015-08-29 06:48:00',2,NULL,NULL),(30,5,'Unload','2015-08-29 06:48:00',2,NULL,NULL),(31,5,'Build','2015-08-29 06:48:00',2,NULL,NULL),(32,5,'Push','2015-08-29 06:48:00',2,NULL,NULL),(33,5,'Diagnostics','2015-08-29 06:48:00',2,NULL,NULL),(34,5,'Light','2015-08-29 06:48:00',2,NULL,NULL),(35,5,'Jenkins','2015-08-29 06:48:00',2,NULL,NULL),(36,5,'DumpAutoload','2015-08-29 06:48:00',2,NULL,NULL),(37,6,'Diagnostics','2015-08-29 06:48:00',2,NULL,NULL),(38,6,'Deploy','2015-08-29 06:48:00',2,NULL,NULL),(39,6,'RenewCache','2015-08-29 06:48:00',2,NULL,NULL),(40,6,'Push','2015-08-29 06:48:00',2,NULL,NULL),(41,6,'Build','2015-08-29 06:48:00',2,NULL,NULL),(42,6,'Mysql2sqlite','2015-08-29 06:48:00',2,NULL,NULL),(43,6,'ResetAcl','2015-08-29 06:48:00',2,NULL,NULL),(44,6,'Acl','2015-08-29 06:48:01',2,NULL,NULL),(45,6,'Config','2015-08-29 06:48:01',2,NULL,NULL),(46,6,'Dump','2015-08-29 06:48:01',2,NULL,NULL),(47,6,'Environment','2015-08-29 06:48:01',2,NULL,NULL),(48,6,'Global','2015-08-29 06:48:01',2,NULL,NULL),(49,6,'Local','2015-08-29 06:48:01',2,NULL,NULL),(50,6,'Mysql','2015-08-29 06:48:01',2,NULL,NULL),(51,6,'Project','2015-08-29 06:48:01',2,NULL,NULL),(52,6,'Sqlite','2015-08-29 06:48:01',2,NULL,NULL),(53,6,'Fixture','2015-08-29 06:48:01',2,NULL,NULL),(54,6,'Jenkins','2015-08-29 06:48:01',2,NULL,NULL),(55,7,'Index','2015-08-29 06:48:01',2,NULL,NULL),(56,8,'ListarImagem','2015-08-29 06:48:01',2,NULL,NULL),(57,8,'ExcluirImagem','2015-08-29 06:48:01',2,NULL,NULL),(58,8,'SalvarImagem','2015-08-29 06:48:01',2,NULL,NULL),(59,9,'Create','2015-08-29 06:48:01',2,NULL,NULL),(60,9,'Edit','2015-08-29 06:48:01',2,NULL,NULL),(61,9,'List','2015-08-29 06:48:01',2,NULL,NULL),(62,9,'Delete','2015-08-29 06:48:01',2,NULL,NULL),(63,9,'View','2015-08-29 06:48:01',2,NULL,NULL),(64,10,'Index','2015-08-29 06:48:01',2,NULL,NULL),(65,11,'ModuleVersion','2015-08-29 06:48:02',2,NULL,NULL),(66,11,'ProjectVersion','2015-08-29 06:48:02',2,NULL,NULL),(67,12,'Login','2015-08-29 06:48:02',2,NULL,NULL),(68,12,'SendPasswordRecoveryRequest','2015-08-29 06:48:02',2,NULL,NULL),(69,12,'PasswordRecoveryRequestSent','2015-08-29 06:48:02',2,NULL,NULL),(70,12,'PasswordRecovery','2015-08-29 06:48:02',2,NULL,NULL),(71,12,'PasswordRecoverySuccessful','2015-08-29 06:48:02',2,NULL,NULL),(72,12,'Index','2015-08-29 06:48:02',2,NULL,NULL),(73,12,'ChangePassword','2015-08-29 06:48:02',2,NULL,NULL),(74,12,'ChangePasswordSuccessful','2015-08-29 06:48:02',2,NULL,NULL),(75,12,'Logout','2015-08-29 06:48:02',2,NULL,NULL),(76,12,'InvalidLink','2015-08-29 06:48:02',2,NULL,NULL),(77,13,'Create','2015-08-29 06:48:02',2,NULL,NULL),(78,13,'Edit','2015-08-29 06:48:02',2,NULL,NULL),(79,13,'List','2015-08-29 06:48:02',2,NULL,NULL),(80,13,'Delete','2015-08-29 06:48:02',2,NULL,NULL),(81,13,'View','2015-08-29 06:48:02',2,NULL,NULL),(82,14,'Create','2015-08-29 06:48:02',2,NULL,NULL),(83,14,'Edit','2015-08-29 06:48:03',2,NULL,NULL),(84,14,'List','2015-08-29 06:48:03',2,NULL,NULL),(85,14,'Delete','2015-08-29 06:48:03',2,NULL,NULL),(86,14,'View','2015-08-29 06:48:03',2,NULL,NULL),(87,15,'Register','2015-08-29 06:48:03',2,NULL,NULL),(88,15,'Acl','2015-08-29 06:48:03',2,NULL,NULL),(89,15,'Create','2015-08-29 06:48:03',2,NULL,NULL),(90,15,'Edit','2015-08-29 06:48:03',2,NULL,NULL),(91,15,'List','2015-08-29 06:48:03',2,NULL,NULL),(92,15,'Delete','2015-08-29 06:48:03',2,NULL,NULL),(93,15,'View','2015-08-29 06:48:03',2,NULL,NULL),(94,15,'UploadImage','2015-08-29 06:48:03',2,NULL,NULL);
/*!40000 ALTER TABLE `action` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controller`
--

LOCK TABLES `controller` WRITE;
/*!40000 ALTER TABLE `controller` DISABLE KEYS */;
INSERT INTO `controller` VALUES (1,1,'ProjectController','GearAcl\\Controller\\Project','2015-08-29 06:48:00',2,NULL,NULL),(2,2,'Db','Gear\\Controller\\Db','2015-08-29 06:48:00',2,NULL,NULL),(3,2,'Build','Gear\\Controller\\Build','2015-08-29 06:48:00',2,NULL,NULL),(4,2,'Constructor','Gear\\Controller\\Constructor','2015-08-29 06:48:00',2,NULL,NULL),(5,2,'Module','Gear\\Controller\\Module','2015-08-29 06:48:00',2,NULL,NULL),(6,2,'Project','Gear\\Controller\\Project','2015-08-29 06:48:00',2,NULL,NULL),(7,3,'Index','GearImage\\Controller\\Index','2015-08-29 06:48:01',2,NULL,NULL),(8,3,'Imagem','GearImage\\Controller\\Imagem','2015-08-29 06:48:01',2,NULL,NULL),(9,3,'MarcaController','GearImage\\Controller\\Marca','2015-08-29 06:48:01',2,NULL,NULL),(10,4,'IndexController','GearBackup\\Controller\\Index','2015-08-29 06:48:01',2,NULL,NULL),(11,5,'VersionController','GearVersion\\Controller\\Version','2015-08-29 06:48:01',2,NULL,NULL),(12,6,'Index','GearAdmin\\Controller\\Index','2015-08-29 06:48:02',2,NULL,NULL),(13,6,'RuleController','GearAdmin\\Controller\\Rule','2015-08-29 06:48:02',2,NULL,NULL),(14,6,'RoleController','GearAdmin\\Controller\\Role','2015-08-29 06:48:02',2,NULL,NULL),(15,6,'User','GearAdmin\\Controller\\User','2015-08-29 06:48:03',2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (1,'GearAcl','2015-08-29 06:48:00',2,NULL,NULL),(2,'Gear','2015-08-29 06:48:00',2,NULL,NULL),(3,'GearImage','2015-08-29 06:48:01',2,NULL,NULL),(4,'GearBackup','2015-08-29 06:48:01',2,NULL,NULL),(5,'GearVersion','2015-08-29 06:48:01',2,NULL,NULL),(6,'GearAdmin','2015-08-29 06:48:02',2,NULL,NULL);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,NULL,'guest','2015-08-29 06:47:59',2,NULL,NULL),(2,1,'admin','2015-08-29 06:47:59',2,NULL,NULL),(3,2,'master','2015-08-29 06:47:59',2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rule`
--

LOCK TABLES `rule` WRITE;
/*!40000 ALTER TABLE `rule` DISABLE KEYS */;
INSERT INTO `rule` VALUES (1,1,1,1,'2015-08-29 06:48:00',2,NULL,NULL),(2,2,1,1,'2015-08-29 06:48:00',2,NULL,NULL),(3,3,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(4,4,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(5,5,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(6,6,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(7,7,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(8,8,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(9,9,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(10,10,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(11,11,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(12,12,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(13,13,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(14,14,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(15,15,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(16,16,2,1,'2015-08-29 06:48:00',2,NULL,NULL),(17,17,3,1,'2015-08-29 06:48:00',2,NULL,NULL),(18,18,4,1,'2015-08-29 06:48:00',2,NULL,NULL),(19,19,4,1,'2015-08-29 06:48:00',2,NULL,NULL),(20,20,4,1,'2015-08-29 06:48:00',2,NULL,NULL),(21,21,4,1,'2015-08-29 06:48:00',2,NULL,NULL),(22,22,4,1,'2015-08-29 06:48:00',2,NULL,NULL),(23,23,4,1,'2015-08-29 06:48:00',2,NULL,NULL),(24,24,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(25,25,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(26,26,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(27,27,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(28,28,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(29,29,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(30,30,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(31,31,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(32,32,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(33,33,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(34,34,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(35,35,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(36,36,5,1,'2015-08-29 06:48:00',2,NULL,NULL),(37,37,6,1,'2015-08-29 06:48:00',2,NULL,NULL),(38,38,6,1,'2015-08-29 06:48:00',2,NULL,NULL),(39,39,6,1,'2015-08-29 06:48:00',2,NULL,NULL),(40,40,6,1,'2015-08-29 06:48:00',2,NULL,NULL),(41,41,6,1,'2015-08-29 06:48:00',2,NULL,NULL),(42,42,6,1,'2015-08-29 06:48:00',2,NULL,NULL),(43,43,6,1,'2015-08-29 06:48:01',2,NULL,NULL),(44,44,6,1,'2015-08-29 06:48:01',2,NULL,NULL),(45,45,6,1,'2015-08-29 06:48:01',2,NULL,NULL),(46,46,6,1,'2015-08-29 06:48:01',2,NULL,NULL),(47,47,6,1,'2015-08-29 06:48:01',2,NULL,NULL),(48,48,6,1,'2015-08-29 06:48:01',2,NULL,NULL),(49,49,6,1,'2015-08-29 06:48:01',2,NULL,NULL),(50,50,6,1,'2015-08-29 06:48:01',2,NULL,NULL),(51,51,6,1,'2015-08-29 06:48:01',2,NULL,NULL),(52,52,6,1,'2015-08-29 06:48:01',2,NULL,NULL),(53,53,6,1,'2015-08-29 06:48:01',2,NULL,NULL),(54,54,6,1,'2015-08-29 06:48:01',2,NULL,NULL),(55,55,7,1,'2015-08-29 06:48:01',2,NULL,NULL),(56,56,8,1,'2015-08-29 06:48:01',2,NULL,NULL),(57,57,8,1,'2015-08-29 06:48:01',2,NULL,NULL),(58,58,8,1,'2015-08-29 06:48:01',2,NULL,NULL),(59,59,9,2,'2015-08-29 06:48:01',2,NULL,NULL),(60,60,9,2,'2015-08-29 06:48:01',2,NULL,NULL),(61,61,9,2,'2015-08-29 06:48:01',2,NULL,NULL),(62,62,9,2,'2015-08-29 06:48:01',2,NULL,NULL),(63,63,9,2,'2015-08-29 06:48:01',2,NULL,NULL),(64,64,10,1,'2015-08-29 06:48:01',2,NULL,NULL),(65,65,11,1,'2015-08-29 06:48:02',2,NULL,NULL),(66,66,11,1,'2015-08-29 06:48:02',2,NULL,NULL),(67,67,12,1,'2015-08-29 06:48:02',2,NULL,NULL),(68,68,12,1,'2015-08-29 06:48:02',2,NULL,NULL),(69,69,12,1,'2015-08-29 06:48:02',2,NULL,NULL),(70,70,12,1,'2015-08-29 06:48:02',2,NULL,NULL),(71,71,12,1,'2015-08-29 06:48:02',2,NULL,NULL),(72,72,12,2,'2015-08-29 06:48:02',2,NULL,NULL),(73,73,12,2,'2015-08-29 06:48:02',2,NULL,NULL),(74,74,12,2,'2015-08-29 06:48:02',2,NULL,NULL),(75,75,12,2,'2015-08-29 06:48:02',2,NULL,NULL),(76,76,12,1,'2015-08-29 06:48:02',2,NULL,NULL),(77,77,13,3,'2015-08-29 06:48:02',2,NULL,NULL),(78,78,13,3,'2015-08-29 06:48:02',2,NULL,NULL),(79,79,13,3,'2015-08-29 06:48:02',2,NULL,NULL),(80,80,13,3,'2015-08-29 06:48:02',2,NULL,NULL),(81,81,13,3,'2015-08-29 06:48:02',2,NULL,NULL),(82,82,14,3,'2015-08-29 06:48:03',2,NULL,NULL),(83,83,14,3,'2015-08-29 06:48:03',2,NULL,NULL),(84,84,14,3,'2015-08-29 06:48:03',2,NULL,NULL),(85,85,14,3,'2015-08-29 06:48:03',2,NULL,NULL),(86,86,14,3,'2015-08-29 06:48:03',2,NULL,NULL),(87,87,15,1,'2015-08-29 06:48:03',2,NULL,NULL),(88,88,15,1,'2015-08-29 06:48:03',2,NULL,NULL),(89,89,15,2,'2015-08-29 06:48:03',2,NULL,NULL),(90,90,15,2,'2015-08-29 06:48:03',2,NULL,NULL),(91,91,15,2,'2015-08-29 06:48:03',2,NULL,NULL),(92,92,15,2,'2015-08-29 06:48:03',2,NULL,NULL),(93,93,15,2,'2015-08-29 06:48:03',2,NULL,NULL),(94,94,15,2,'2015-08-29 06:48:03',2,NULL,NULL);
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
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'piber@pibernetwork.com','$2y$14$tMMimbg41c/sQOzUPgDrhO596ITy.D.ZeegZBQetgFCzXgwcQ8GVu','',1,'155e17fc8104518.96762119','2015-08-29 06:47:52','2015-08-29 06:47:52',1,1,3),(2,'usuariogear1@gmail.com','$2y$14$rzCoDKVZ7el/fROASYVy/.gHjT/Wgky6SyxIjv06aj7vhlT5XpiOe','',1,'155e17fc9500b46.44217578','2015-08-29 06:47:53','2015-08-29 06:47:53',2,2,2),(3,'usuariogear2@gmail.com','$2y$14$I4hzOkR0eoUUOkaoBv2DQucxwl5G.h.mpFjIAFzIswYtKbUxydH3y','',1,'155e17fca8c9b52.56168874','2015-08-29 06:47:54','2015-08-29 06:47:54',3,3,2),(4,'usuariogear3@gmail.com','$2y$14$wAgWfUxfNgJlP24uuiVr5uA3umXcs/7Kh9TETsQBlsCx1tfAumpQW','',1,'155e17fcbcb5a51.38235302','2015-08-29 06:47:55','2015-08-29 06:47:55',4,4,2),(5,'usuariogear4@gmail.com','$2y$14$OxFh0LbH6qHdxEyEOo8Sk.jItyWf5sjBOZPv9O7OTKbkAHogXqg62','',1,'155e17fcd1d2e53.23871579','2015-08-29 06:47:57','2015-08-29 06:47:57',5,5,2),(6,'usuariogear5@gmail.com','$2y$14$q5WLCWIkR3ygxSTamwTDW.fHHBN47pLTcuGEmq5RCTIfADXKNYGoO','',1,'155e17fce64aa40.11604856','2015-08-29 06:47:58','2015-08-29 06:47:58',6,6,2),(7,'usuariogear6@gmail.com','$2y$14$7iABED/HhoDkuef7PZkwSuQijtbd99ZozE9vLK9k5p9BJ5Lg0YNqS','',1,'155e17fcfa8ece0.43118440','2015-08-29 06:47:59','2015-08-29 06:47:59',7,7,2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_login`
--

DROP TABLE IF EXISTS `user_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_login` (
  `id_user_login` int(11) NOT NULL AUTO_INCREMENT,
  `login_timestamp` datetime DEFAULT NULL,
  `logout_timestamp` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_user_login`),
  KEY `fk_user_login_1` (`id_user`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `fk_user_login_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_login_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_login_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_login`
--

LOCK TABLES `user_login` WRITE;
/*!40000 ALTER TABLE `user_login` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_login` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-13 17:54:54
