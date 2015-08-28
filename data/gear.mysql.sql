-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: gear
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

LOCK TABLES `action` WRITE;
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` VALUES (1,1,'Acl','2015-08-27 01:30:10',2,NULL,NULL),(2,1,'ResetAcl','2015-08-27 01:30:10',2,NULL,NULL),(3,2,'AutoincrementDatabase','2015-08-27 01:30:10',2,NULL,NULL),(4,2,'DropTable','2015-08-27 01:30:10',2,NULL,NULL),(5,2,'MockTable','2015-08-27 01:30:10',2,NULL,NULL),(6,2,'GetOrder','2015-08-27 01:30:10',2,NULL,NULL),(7,2,'AnalyseDatabase','2015-08-27 01:30:10',2,NULL,NULL),(8,2,'AnalyseTable','2015-08-27 01:30:10',2,NULL,NULL),(9,2,'AutoincrementTable','2015-08-27 01:30:10',2,NULL,NULL),(10,2,'ClearTable','2015-08-27 01:30:10',2,NULL,NULL),(11,2,'CreateColumn','2015-08-27 01:30:10',2,NULL,NULL),(12,2,'FixDatabase','2015-08-27 01:30:10',2,NULL,NULL),(13,2,'FixTable','2015-08-27 01:30:10',2,NULL,NULL),(14,2,'MysqlLoad','2015-08-27 01:30:10',2,NULL,NULL),(15,2,'MysqlDump','2015-08-27 01:30:10',2,NULL,NULL),(16,2,'Fixture','2015-08-27 01:30:10',2,NULL,NULL),(17,3,'Build','2015-08-27 01:30:10',2,NULL,NULL),(18,4,'Action','2015-08-27 01:30:10',2,NULL,NULL),(19,4,'Controller','2015-08-27 01:30:10',2,NULL,NULL),(20,4,'Db','2015-08-27 01:30:10',2,NULL,NULL),(21,4,'Src','2015-08-27 01:30:10',2,NULL,NULL),(22,4,'Test','2015-08-27 01:30:10',2,NULL,NULL),(23,4,'View','2015-08-27 01:30:10',2,NULL,NULL),(24,5,'Entities','2015-08-27 01:30:10',2,NULL,NULL),(25,5,'Entity','2015-08-27 01:30:10',2,NULL,NULL),(26,5,'Dump','2015-08-27 01:30:10',2,NULL,NULL),(27,5,'Create','2015-08-27 01:30:10',2,NULL,NULL),(28,5,'Delete','2015-08-27 01:30:10',2,NULL,NULL),(29,5,'Load','2015-08-27 01:30:10',2,NULL,NULL),(30,5,'Unload','2015-08-27 01:30:10',2,NULL,NULL),(31,5,'Build','2015-08-27 01:30:10',2,NULL,NULL),(32,5,'Push','2015-08-27 01:30:10',2,NULL,NULL),(33,5,'Diagnostics','2015-08-27 01:30:10',2,NULL,NULL),(34,5,'Light','2015-08-27 01:30:10',2,NULL,NULL),(35,5,'Jenkins','2015-08-27 01:30:11',2,NULL,NULL),(36,5,'DumpAutoload','2015-08-27 01:30:11',2,NULL,NULL),(37,6,'Diagnostics','2015-08-27 01:30:11',2,NULL,NULL),(38,6,'Deploy','2015-08-27 01:30:11',2,NULL,NULL),(39,6,'RenewCache','2015-08-27 01:30:11',2,NULL,NULL),(40,6,'Push','2015-08-27 01:30:11',2,NULL,NULL),(41,6,'Build','2015-08-27 01:30:11',2,NULL,NULL),(42,6,'Mysql2sqlite','2015-08-27 01:30:11',2,NULL,NULL),(43,6,'ResetAcl','2015-08-27 01:30:11',2,NULL,NULL),(44,6,'Acl','2015-08-27 01:30:11',2,NULL,NULL),(45,6,'Config','2015-08-27 01:30:11',2,NULL,NULL),(46,6,'Dump','2015-08-27 01:30:11',2,NULL,NULL),(47,6,'Environment','2015-08-27 01:30:11',2,NULL,NULL),(48,6,'Global','2015-08-27 01:30:11',2,NULL,NULL),(49,6,'Local','2015-08-27 01:30:11',2,NULL,NULL),(50,6,'Mysql','2015-08-27 01:30:11',2,NULL,NULL),(51,6,'Project','2015-08-27 01:30:11',2,NULL,NULL),(52,6,'Sqlite','2015-08-27 01:30:11',2,NULL,NULL),(53,6,'Fixture','2015-08-27 01:30:11',2,NULL,NULL),(54,6,'Jenkins','2015-08-27 01:30:11',2,NULL,NULL),(55,7,'Index','2015-08-27 01:30:11',2,NULL,NULL),(56,8,'ListarImagem','2015-08-27 01:30:11',2,NULL,NULL),(57,8,'ExcluirImagem','2015-08-27 01:30:11',2,NULL,NULL),(58,8,'SalvarImagem','2015-08-27 01:30:11',2,NULL,NULL),(59,9,'Create','2015-08-27 01:30:12',2,NULL,NULL),(60,9,'Edit','2015-08-27 01:30:12',2,NULL,NULL),(61,9,'List','2015-08-27 01:30:12',2,NULL,NULL),(62,9,'Delete','2015-08-27 01:30:12',2,NULL,NULL),(63,9,'View','2015-08-27 01:30:12',2,NULL,NULL),(64,10,'Index','2015-08-27 01:30:12',2,NULL,NULL),(65,11,'ModuleVersion','2015-08-27 01:30:12',2,NULL,NULL),(66,11,'ProjectVersion','2015-08-27 01:30:12',2,NULL,NULL),(67,12,'Login','2015-08-27 01:30:12',2,NULL,NULL),(68,12,'SendPasswordRecoveryRequest','2015-08-27 01:30:12',2,NULL,NULL),(69,12,'PasswordRecoveryRequestSent','2015-08-27 01:30:12',2,NULL,NULL),(70,12,'PasswordRecovery','2015-08-27 01:30:12',2,NULL,NULL),(71,12,'PasswordRecoverySuccessful','2015-08-27 01:30:12',2,NULL,NULL),(72,12,'Index','2015-08-27 01:30:12',2,NULL,NULL),(73,12,'ChangePassword','2015-08-27 01:30:12',2,NULL,NULL),(74,12,'ChangePasswordSuccessful','2015-08-27 01:30:12',2,NULL,NULL),(75,12,'Logout','2015-08-27 01:30:12',2,NULL,NULL),(76,12,'InvalidLink','2015-08-27 01:30:13',2,NULL,NULL),(77,13,'Create','2015-08-27 01:30:13',2,NULL,NULL),(78,13,'Edit','2015-08-27 01:30:13',2,NULL,NULL),(79,13,'List','2015-08-27 01:30:13',2,NULL,NULL),(80,13,'Delete','2015-08-27 01:30:13',2,NULL,NULL),(81,13,'View','2015-08-27 01:30:13',2,NULL,NULL),(82,14,'Create','2015-08-27 01:30:13',2,NULL,NULL),(83,14,'Edit','2015-08-27 01:30:13',2,NULL,NULL),(84,14,'List','2015-08-27 01:30:13',2,NULL,NULL),(85,14,'Delete','2015-08-27 01:30:13',2,NULL,NULL),(86,14,'View','2015-08-27 01:30:13',2,NULL,NULL),(87,15,'Register','2015-08-27 01:30:13',2,NULL,NULL),(88,15,'Acl','2015-08-27 01:30:13',2,NULL,NULL),(89,15,'Create','2015-08-27 01:30:13',2,NULL,NULL),(90,15,'Edit','2015-08-27 01:30:13',2,NULL,NULL),(91,15,'List','2015-08-27 01:30:14',2,NULL,NULL),(92,15,'Delete','2015-08-27 01:30:14',2,NULL,NULL),(93,15,'View','2015-08-27 01:30:14',2,NULL,NULL),(94,15,'UploadImage','2015-08-27 01:30:14',2,NULL,NULL),(95,16,'Index','2015-08-27 01:30:14',2,NULL,NULL),(96,17,'Create','2015-08-27 01:30:14',2,NULL,NULL),(97,17,'Edit','2015-08-27 01:30:14',2,NULL,NULL),(98,17,'List','2015-08-27 01:30:14',2,NULL,NULL),(99,17,'Report','2015-08-27 01:30:14',2,NULL,NULL),(100,17,'Delete','2015-08-27 01:30:14',2,NULL,NULL),(101,17,'View','2015-08-27 01:30:14',2,NULL,NULL),(102,18,'Index','2015-08-27 01:30:15',2,NULL,NULL),(103,20,'Login','2015-08-27 01:30:15',2,NULL,NULL),(104,20,'LoginAjax','2015-08-27 01:30:15',2,NULL,NULL),(105,23,'Index','2015-08-27 01:30:15',2,NULL,NULL),(106,24,'Show','2015-08-27 01:30:15',2,NULL,NULL),(107,25,'Index','2015-08-27 01:30:15',2,NULL,NULL),(108,26,'ShowCard','2015-08-27 01:32:38',2,NULL,NULL),(109,26,'DeleteCard','2015-08-27 01:32:38',2,NULL,NULL),(110,26,'Mix_Card','2015-08-27 01:32:38',2,NULL,NULL),(111,26,'DoCard','2015-08-27 01:32:38',2,NULL,NULL),(112,26,'MixCard','2015-08-27 01:33:54',2,NULL,NULL),(113,27,'MixCard','2015-08-27 01:54:31',2,NULL,NULL),(114,27,'RemixCard','2015-08-27 04:03:14',2,NULL,NULL),(115,27,'Fourmix','2015-08-27 04:03:14',2,NULL,NULL),(116,27,'Level','2015-08-27 04:03:15',2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controller`
--

LOCK TABLES `controller` WRITE;
/*!40000 ALTER TABLE `controller` DISABLE KEYS */;
INSERT INTO `controller` VALUES (1,1,'ProjectController','GearAcl\\Controller\\Project','2015-08-27 01:30:10',2,NULL,NULL),(2,2,'Db','Gear\\Controller\\Db','2015-08-27 01:30:10',2,NULL,NULL),(3,2,'Build','Gear\\Controller\\Build','2015-08-27 01:30:10',2,NULL,NULL),(4,2,'Constructor','Gear\\Controller\\Constructor','2015-08-27 01:30:10',2,NULL,NULL),(5,2,'Module','Gear\\Controller\\Module','2015-08-27 01:30:10',2,NULL,NULL),(6,2,'Project','Gear\\Controller\\Project','2015-08-27 01:30:11',2,NULL,NULL),(7,3,'Index','GearImage\\Controller\\Index','2015-08-27 01:30:11',2,NULL,NULL),(8,3,'Imagem','GearImage\\Controller\\Imagem','2015-08-27 01:30:11',2,NULL,NULL),(9,3,'MarcaController','GearImage\\Controller\\Marca','2015-08-27 01:30:12',2,NULL,NULL),(10,4,'IndexController','GearBackup\\Controller\\Index','2015-08-27 01:30:12',2,NULL,NULL),(11,5,'VersionController','GearVersion\\Controller\\Version','2015-08-27 01:30:12',2,NULL,NULL),(12,6,'Index','GearAdmin\\Controller\\Index','2015-08-27 01:30:12',2,NULL,NULL),(13,6,'RuleController','GearAdmin\\Controller\\Rule','2015-08-27 01:30:13',2,NULL,NULL),(14,6,'RoleController','GearAdmin\\Controller\\Role','2015-08-27 01:30:13',2,NULL,NULL),(15,6,'User','GearAdmin\\Controller\\User','2015-08-27 01:30:13',2,NULL,NULL),(16,7,'IndexController','TestLogin\\Controller\\Index','2015-08-27 01:30:14',2,NULL,NULL),(17,7,'UserLoginController','TestLogin\\Controller\\UserLogin','2015-08-27 01:30:14',2,NULL,NULL),(18,8,'IndexController','Coola\\Controller\\Index','2015-08-27 01:30:15',2,NULL,NULL),(19,8,'Card','Coola\\Controller\\Card','2015-08-27 01:30:15',2,NULL,NULL),(20,8,'Student','Coola\\Controller\\Student','2015-08-27 01:30:15',2,NULL,NULL),(21,8,'Questions','Coola\\Controller\\Questions','2015-08-27 01:30:15',2,NULL,NULL),(22,8,'Ranking','Coola\\Controller\\Ranking','2015-08-27 01:30:15',2,NULL,NULL),(23,9,'IndexController','Factory\\Controller\\Index','2015-08-27 01:30:15',2,NULL,NULL),(24,9,'Card','Factory\\Controller\\Card','2015-08-27 01:30:15',2,NULL,NULL),(25,10,'IndexController','TestActions\\Controller\\Index','2015-08-27 01:30:15',2,NULL,NULL),(26,10,'Card','TestActions\\Controller\\Card','2015-08-27 01:32:38',2,NULL,NULL),(27,10,'CardController','TestActions\\Controller\\Card','2015-08-27 01:54:31',2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (1,'GearAcl','2015-08-27 01:30:10',2,NULL,NULL),(2,'Gear','2015-08-27 01:30:10',2,NULL,NULL),(3,'GearImage','2015-08-27 01:30:11',2,NULL,NULL),(4,'GearBackup','2015-08-27 01:30:12',2,NULL,NULL),(5,'GearVersion','2015-08-27 01:30:12',2,NULL,NULL),(6,'GearAdmin','2015-08-27 01:30:12',2,NULL,NULL),(7,'TestLogin','2015-08-27 01:30:14',2,NULL,NULL),(8,'Coola','2015-08-27 01:30:15',2,NULL,NULL),(9,'Factory','2015-08-27 01:30:15',2,NULL,NULL),(10,'TestActions','2015-08-27 01:30:15',2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,NULL,'guest','2015-08-27 01:30:09',2,NULL,NULL),(2,1,'admin','2015-08-27 01:30:09',2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rule`
--

LOCK TABLES `rule` WRITE;
/*!40000 ALTER TABLE `rule` DISABLE KEYS */;
INSERT INTO `rule` VALUES (1,1,1,1,'2015-08-27 01:30:10',2,NULL,NULL),(2,2,1,1,'2015-08-27 01:30:10',2,NULL,NULL),(3,3,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(4,4,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(5,5,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(6,6,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(7,7,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(8,8,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(9,9,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(10,10,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(11,11,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(12,12,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(13,13,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(14,14,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(15,15,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(16,16,2,1,'2015-08-27 01:30:10',2,NULL,NULL),(17,17,3,1,'2015-08-27 01:30:10',2,NULL,NULL),(18,18,4,1,'2015-08-27 01:30:10',2,NULL,NULL),(19,19,4,1,'2015-08-27 01:30:10',2,NULL,NULL),(20,20,4,1,'2015-08-27 01:30:10',2,NULL,NULL),(21,21,4,1,'2015-08-27 01:30:10',2,NULL,NULL),(22,22,4,1,'2015-08-27 01:30:10',2,NULL,NULL),(23,23,4,1,'2015-08-27 01:30:10',2,NULL,NULL),(24,24,5,1,'2015-08-27 01:30:10',2,NULL,NULL),(25,25,5,1,'2015-08-27 01:30:10',2,NULL,NULL),(26,26,5,1,'2015-08-27 01:30:10',2,NULL,NULL),(27,27,5,1,'2015-08-27 01:30:10',2,NULL,NULL),(28,28,5,1,'2015-08-27 01:30:10',2,NULL,NULL),(29,29,5,1,'2015-08-27 01:30:10',2,NULL,NULL),(30,30,5,1,'2015-08-27 01:30:10',2,NULL,NULL),(31,31,5,1,'2015-08-27 01:30:10',2,NULL,NULL),(32,32,5,1,'2015-08-27 01:30:10',2,NULL,NULL),(33,33,5,1,'2015-08-27 01:30:10',2,NULL,NULL),(34,34,5,1,'2015-08-27 01:30:10',2,NULL,NULL),(35,35,5,1,'2015-08-27 01:30:11',2,NULL,NULL),(36,36,5,1,'2015-08-27 01:30:11',2,NULL,NULL),(37,37,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(38,38,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(39,39,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(40,40,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(41,41,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(42,42,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(43,43,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(44,44,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(45,45,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(46,46,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(47,47,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(48,48,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(49,49,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(50,50,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(51,51,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(52,52,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(53,53,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(54,54,6,1,'2015-08-27 01:30:11',2,NULL,NULL),(55,55,7,1,'2015-08-27 01:30:11',2,NULL,NULL),(56,56,8,1,'2015-08-27 01:30:11',2,NULL,NULL),(57,57,8,1,'2015-08-27 01:30:11',2,NULL,NULL),(58,58,8,1,'2015-08-27 01:30:12',2,NULL,NULL),(59,59,9,2,'2015-08-27 01:30:12',2,NULL,NULL),(60,60,9,2,'2015-08-27 01:30:12',2,NULL,NULL),(61,61,9,2,'2015-08-27 01:30:12',2,NULL,NULL),(62,62,9,2,'2015-08-27 01:30:12',2,NULL,NULL),(63,63,9,2,'2015-08-27 01:30:12',2,NULL,NULL),(64,64,10,1,'2015-08-27 01:30:12',2,NULL,NULL),(65,65,11,1,'2015-08-27 01:30:12',2,NULL,NULL),(66,66,11,1,'2015-08-27 01:30:12',2,NULL,NULL),(67,67,12,1,'2015-08-27 01:30:12',2,NULL,NULL),(68,68,12,1,'2015-08-27 01:30:12',2,NULL,NULL),(69,69,12,1,'2015-08-27 01:30:12',2,NULL,NULL),(70,70,12,1,'2015-08-27 01:30:12',2,NULL,NULL),(71,71,12,1,'2015-08-27 01:30:12',2,NULL,NULL),(72,72,12,2,'2015-08-27 01:30:12',2,NULL,NULL),(73,73,12,2,'2015-08-27 01:30:12',2,NULL,NULL),(74,74,12,2,'2015-08-27 01:30:12',2,NULL,NULL),(75,75,12,2,'2015-08-27 01:30:13',2,NULL,NULL),(76,76,12,1,'2015-08-27 01:30:13',2,NULL,NULL),(77,77,13,2,'2015-08-27 01:30:13',2,NULL,NULL),(78,78,13,2,'2015-08-27 01:30:13',2,NULL,NULL),(79,79,13,2,'2015-08-27 01:30:13',2,NULL,NULL),(80,80,13,2,'2015-08-27 01:30:13',2,NULL,NULL),(81,81,13,2,'2015-08-27 01:30:13',2,NULL,NULL),(82,82,14,2,'2015-08-27 01:30:13',2,NULL,NULL),(83,83,14,2,'2015-08-27 01:30:13',2,NULL,NULL),(84,84,14,2,'2015-08-27 01:30:13',2,NULL,NULL),(85,85,14,2,'2015-08-27 01:30:13',2,NULL,NULL),(86,86,14,2,'2015-08-27 01:30:13',2,NULL,NULL),(87,87,15,1,'2015-08-27 01:30:13',2,NULL,NULL),(88,88,15,1,'2015-08-27 01:30:13',2,NULL,NULL),(89,89,15,2,'2015-08-27 01:30:13',2,NULL,NULL),(90,90,15,2,'2015-08-27 01:30:14',2,NULL,NULL),(91,91,15,2,'2015-08-27 01:30:14',2,NULL,NULL),(92,92,15,2,'2015-08-27 01:30:14',2,NULL,NULL),(93,93,15,2,'2015-08-27 01:30:14',2,NULL,NULL),(94,94,15,2,'2015-08-27 01:30:14',2,NULL,NULL),(95,95,16,1,'2015-08-27 01:30:14',2,NULL,NULL),(96,96,17,2,'2015-08-27 01:30:14',2,NULL,NULL),(97,97,17,2,'2015-08-27 01:30:14',2,NULL,NULL),(98,98,17,2,'2015-08-27 01:30:14',2,NULL,NULL),(99,99,17,2,'2015-08-27 01:30:14',2,NULL,NULL),(100,100,17,2,'2015-08-27 01:30:14',2,NULL,NULL),(101,101,17,2,'2015-08-27 01:30:15',2,NULL,NULL),(102,102,18,1,'2015-08-27 01:30:15',2,NULL,NULL),(103,103,20,1,'2015-08-27 01:30:15',2,NULL,NULL),(104,104,20,1,'2015-08-27 01:30:15',2,NULL,NULL),(105,105,23,1,'2015-08-27 01:30:15',2,NULL,NULL),(106,106,24,1,'2015-08-27 01:30:15',2,NULL,NULL),(107,107,25,1,'2015-08-27 01:30:15',2,NULL,NULL),(108,108,26,1,'2015-08-27 01:32:38',2,NULL,NULL),(109,109,26,1,'2015-08-27 01:32:38',2,NULL,NULL),(110,110,26,1,'2015-08-27 01:32:38',2,NULL,NULL),(111,111,26,1,'2015-08-27 01:32:38',2,NULL,NULL),(112,112,26,1,'2015-08-27 01:33:54',2,NULL,NULL),(113,113,27,1,'2015-08-27 01:54:31',2,NULL,NULL),(114,114,27,1,'2015-08-27 04:03:14',2,NULL,NULL),(115,115,27,1,'2015-08-27 04:03:15',2,NULL,NULL),(116,116,27,1,'2015-08-27 04:03:15',2,NULL,NULL);
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
INSERT INTO `user` VALUES (1,'gear@pibernetwork.com','$2y$14$aIF4b9v2r3UEWIzTvPUtBOSka/8ynE.cSfoem/1gpuzhxDzqAbpGW','',1,'155de92495e2816.63758771','2015-08-27 01:30:01','2015-08-27 01:30:01',1,1,NULL),(2,'usuariogear1@gmail.com','$2y$14$jZIWS4fuhiq1g/Dcr8B45.Td06Q2JKrPqgg.cOA1ea71P0fB894ae','',1,'155de924abe7683.74980343','2015-08-27 01:30:02','2015-08-27 01:30:02',2,2,2),(3,'usuariogear2@gmail.com','$2y$14$3SFZ38H3I8fNvhXozalmmurYhPVXn1d3zPCYTD5lhmo3QH2PpldDG','',1,'155de924c36f540.87609516','2015-08-27 01:30:04','2015-08-27 01:30:04',3,3,2),(4,'usuariogear3@gmail.com','$2y$14$Tr/aI4amnuNRAglKHghpD.rDXcpKXXJZEL.nIDmKlH5myjEDMrjLe','',1,'155de924d9ac250.57748891','2015-08-27 01:30:05','2015-08-27 01:30:05',4,4,2),(5,'usuariogear4@gmail.com','$2y$14$e7pGPWrOWxnlsZQraDnSXunZAOAUjoIIAzqYxn4LpNq4Z97NLY51y','',1,'155de924f019011.58302225','2015-08-27 01:30:07','2015-08-27 01:30:07',5,5,2),(6,'usuariogear5@gmail.com','$2y$14$GlXQu7al6FYUiJ/1qEa1yeCNEPkQj/yQR2LHiFAPNs1Pv5aC9Pl3.','',1,'155de925053ecc6.78379275','2015-08-27 01:30:08','2015-08-27 01:30:08',6,6,2),(7,'usuariogear6@gmail.com','$2y$14$7gqqUM8EEYpcrrDmUJk0n.U8Yxauy.O2x49OgNQg0qP58/ns0vOM2','',1,'155de9251a3b535.18928787','2015-08-27 01:30:09','2015-08-27 01:30:09',7,7,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_login`
--

LOCK TABLES `user_login` WRITE;
/*!40000 ALTER TABLE `user_login` DISABLE KEYS */;
INSERT INTO `user_login` VALUES (1,'2020-12-01 01:00:02','2020-12-01 01:00:02',2,'2015-08-27 01:30:09',NULL,2,NULL),(2,'2020-12-02 02:00:02','2020-12-02 02:00:02',2,'2015-08-27 01:30:09',NULL,2,NULL),(3,'2020-12-03 03:00:02','2020-12-03 03:00:02',2,'2015-08-27 01:30:09',NULL,2,NULL),(4,'2020-12-04 04:00:02','2020-12-04 04:00:02',2,'2015-08-27 01:30:09',NULL,2,NULL),(5,'2020-12-05 05:00:02','2020-12-05 05:00:02',2,'2015-08-27 01:30:09',NULL,2,NULL),(6,'2020-12-06 06:00:02','2020-12-06 06:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(7,'2020-12-07 07:00:02','2020-12-07 07:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(8,'2020-12-08 08:00:02','2020-12-08 08:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(9,'2020-12-09 09:00:02','2020-12-09 09:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(10,'2020-12-10 10:00:02','2020-12-10 10:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(11,'2020-12-11 11:00:02','2020-12-11 11:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(12,'2020-12-12 12:00:02','2020-12-12 12:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(13,'2020-12-13 13:00:02','2020-12-13 13:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(14,'2020-12-14 14:00:02','2020-12-14 14:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(15,'2020-12-15 15:00:02','2020-12-15 15:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(16,'2020-12-16 16:00:02','2020-12-16 16:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(17,'2020-12-17 17:00:02','2020-12-17 17:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(18,'2020-12-18 18:00:02','2020-12-18 18:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(19,'2020-12-19 19:00:02','2020-12-19 19:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(20,'2020-12-20 20:00:02','2020-12-20 20:00:02',3,'2015-08-27 01:30:09',NULL,2,NULL),(21,'2020-12-21 21:00:02','2020-12-21 21:00:02',4,'2015-08-27 01:30:09',NULL,2,NULL),(22,'2020-12-22 22:00:02','2020-12-22 22:00:02',4,'2015-08-27 01:30:09',NULL,2,NULL),(23,'2020-12-23 23:00:02','2020-12-23 23:00:02',5,'2015-08-27 01:30:09',NULL,2,NULL),(24,'2020-12-24 06:00:02','2020-12-24 06:00:02',5,'2015-08-27 01:30:09',NULL,2,NULL),(25,'2020-12-25 05:00:02','2020-12-25 05:00:02',5,'2015-08-27 01:30:09',NULL,2,NULL),(26,'2020-12-26 04:00:02','2020-12-26 04:00:02',5,'2015-08-27 01:30:09',NULL,2,NULL),(27,'2020-12-27 03:00:02','2020-12-27 03:00:02',6,'2015-08-27 01:30:09',NULL,2,NULL),(28,'2020-12-28 02:00:02','2020-12-28 02:00:02',7,'2015-08-27 01:30:09',NULL,2,NULL),(29,'2020-12-29 01:00:02','2020-12-29 01:00:02',7,'2015-08-27 01:30:09',NULL,2,NULL),(30,'2020-12-30 00:00:02','2020-12-30 00:00:02',7,'2015-08-27 01:30:09',NULL,2,NULL),(31,'2015-08-27 02:01:07',NULL,2,'2015-08-27 02:01:07',NULL,2,NULL);
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

-- Dump completed on 2015-08-27  4:17:10
