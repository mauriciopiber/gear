-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: pibernews
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.12.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

LOCK TABLES `action` WRITE;
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` VALUES (1,1,'AutoincrementDatabase','2015-04-15 02:38:13',2,NULL,NULL),(2,1,'DropTable','2015-04-15 02:38:13',2,NULL,NULL),(3,1,'GetOrder','2015-04-15 02:38:13',2,NULL,NULL),(4,1,'AnalyseDatabase','2015-04-15 02:38:13',2,NULL,NULL),(5,1,'AnalyseTable','2015-04-15 02:38:13',2,NULL,NULL),(6,1,'AutoincrementTable','2015-04-15 02:38:13',2,NULL,NULL),(7,1,'ClearTable','2015-04-15 02:38:13',2,NULL,NULL),(8,1,'CreateColumn','2015-04-15 02:38:13',2,NULL,NULL),(9,1,'FixDatabase','2015-04-15 02:38:13',2,NULL,NULL),(10,1,'FixTable','2015-04-15 02:38:13',2,NULL,NULL),(11,1,'MysqlLoad','2015-04-15 02:38:13',2,NULL,NULL),(12,1,'MysqlDump','2015-04-15 02:38:13',2,NULL,NULL),(13,1,'Fixture','2015-04-15 02:38:13',2,NULL,NULL),(14,2,'Build','2015-04-15 02:38:13',2,NULL,NULL),(15,3,'Version','2015-04-15 02:38:13',2,NULL,NULL),(16,4,'Action','2015-04-15 02:38:13',2,NULL,NULL),(17,4,'Controller','2015-04-15 02:38:13',2,NULL,NULL),(18,4,'Db','2015-04-15 02:38:13',2,NULL,NULL),(19,4,'Src','2015-04-15 02:38:13',2,NULL,NULL),(20,4,'Test','2015-04-15 02:38:13',2,NULL,NULL),(21,4,'View','2015-04-15 02:38:13',2,NULL,NULL),(22,5,'Entities','2015-04-15 02:38:13',2,NULL,NULL),(23,5,'Entity','2015-04-15 02:38:13',2,NULL,NULL),(24,5,'Dump','2015-04-15 02:38:13',2,NULL,NULL),(25,5,'Create','2015-04-15 02:38:13',2,NULL,NULL),(26,5,'Delete','2015-04-15 02:38:13',2,NULL,NULL),(27,5,'Load','2015-04-15 02:38:13',2,NULL,NULL),(28,5,'Unload','2015-04-15 02:38:13',2,NULL,NULL),(29,5,'Build','2015-04-15 02:38:13',2,NULL,NULL),(30,5,'Push','2015-04-15 02:38:13',2,NULL,NULL),(31,5,'Light','2015-04-15 02:38:14',2,NULL,NULL),(32,6,'Deploy','2015-04-15 02:38:14',2,NULL,NULL),(33,6,'Mysql2sqlite','2015-04-15 02:38:14',2,NULL,NULL),(34,6,'ResetAcl','2015-04-15 02:38:14',2,NULL,NULL),(35,6,'Acl','2015-04-15 02:38:14',2,NULL,NULL),(36,6,'Config','2015-04-15 02:38:14',2,NULL,NULL),(37,6,'Dump','2015-04-15 02:38:14',2,NULL,NULL),(38,6,'Environment','2015-04-15 02:38:14',2,NULL,NULL),(39,6,'Global','2015-04-15 02:38:14',2,NULL,NULL),(40,6,'Local','2015-04-15 02:38:14',2,NULL,NULL),(41,6,'Mysql','2015-04-15 02:38:14',2,NULL,NULL),(42,6,'Project','2015-04-15 02:38:14',2,NULL,NULL),(43,6,'Sqlite','2015-04-15 02:38:14',2,NULL,NULL),(44,6,'Fixture','2015-04-15 02:38:14',2,NULL,NULL),(45,7,'Acl','2015-04-15 02:38:15',2,NULL,NULL),(46,7,'ResetAcl','2015-04-15 02:38:15',2,NULL,NULL),(47,8,'Version','2015-04-15 02:38:15',2,NULL,NULL),(48,9,'Index','2015-04-15 02:38:15',2,NULL,NULL),(49,10,'Index','2015-04-15 02:38:15',2,NULL,NULL),(50,11,'Login','2015-04-15 02:38:15',2,NULL,NULL),(51,11,'SendPasswordRecoveryRequest','2015-04-15 02:38:15',2,NULL,NULL),(52,11,'PasswordRecoveryRequestSent','2015-04-15 02:38:15',2,NULL,NULL),(53,11,'PasswordRecovery','2015-04-15 02:38:15',2,NULL,NULL),(54,11,'PasswordRecoverySuccessful','2015-04-15 02:38:15',2,NULL,NULL),(55,11,'Index','2015-04-15 02:38:15',2,NULL,NULL),(56,11,'ChangePassword','2015-04-15 02:38:15',2,NULL,NULL),(57,11,'ChangePasswordSuccessful','2015-04-15 02:38:15',2,NULL,NULL),(58,11,'Logout','2015-04-15 02:38:15',2,NULL,NULL),(59,11,'InvalidLink','2015-04-15 02:38:15',2,NULL,NULL),(60,12,'Register','2015-04-15 02:38:16',2,NULL,NULL),(61,12,'Acl','2015-04-15 02:38:16',2,NULL,NULL),(62,13,'Index','2015-04-15 02:38:16',2,NULL,NULL),(63,14,'Create','2015-04-15 02:38:16',2,NULL,NULL),(64,14,'Edit','2015-04-15 02:38:16',2,NULL,NULL),(65,14,'List','2015-04-15 02:38:16',2,NULL,NULL),(66,14,'Delete','2015-04-15 02:38:16',2,NULL,NULL),(67,14,'View','2015-04-15 02:38:16',2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controller`
--

LOCK TABLES `controller` WRITE;
/*!40000 ALTER TABLE `controller` DISABLE KEYS */;
INSERT INTO `controller` VALUES (1,1,'Db','Gear\\Controller\\Db','2015-04-15 02:38:13',2,NULL,NULL),(2,1,'Build','Gear\\Controller\\Build','2015-04-15 02:38:13',2,NULL,NULL),(3,1,'Gear','Gear\\Controller\\Gear','2015-04-15 02:38:13',2,NULL,NULL),(4,1,'Constructor','Gear\\Controller\\Constructor','2015-04-15 02:38:13',2,NULL,NULL),(5,1,'Module','Gear\\Controller\\Module','2015-04-15 02:38:13',2,NULL,NULL),(6,1,'Project','Gear\\Controller\\Project','2015-04-15 02:38:14',2,NULL,NULL),(7,2,'ProjectController','GearAclUp\\Controller\\Project','2015-04-15 02:38:15',2,NULL,NULL),(8,3,'VersionController','GearVersion\\Controller\\Version','2015-04-15 02:38:15',2,NULL,NULL),(9,4,'IndexController','GearJson\\Controller\\Index','2015-04-15 02:38:15',2,NULL,NULL),(10,5,'IndexController','GearBackup\\Controller\\Index','2015-04-15 02:38:15',2,NULL,NULL),(11,6,'Index','Security\\Controller\\Index','2015-04-15 02:38:15',2,NULL,NULL),(12,6,'User','Security\\Controller\\User','2015-04-15 02:38:16',2,NULL,NULL),(13,7,'IndexController','Teste\\Controller\\Index','2015-04-15 02:38:16',2,NULL,NULL),(14,7,'EmailController','Teste\\Controller\\Email','2015-04-15 02:38:16',2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
INSERT INTO `email` VALUES (1,'1Remetente','1Destino','1Assunto','1Mensagem','2015-04-15 02:38:12',2,NULL,NULL),(2,'2Remetente','2Destino','2Assunto','2Mensagem','2015-04-15 02:38:12',2,NULL,NULL),(3,'3Remetente','3Destino','3Assunto','3Mensagem','2015-04-15 02:38:12',2,NULL,NULL),(4,'4Remetente','4Destino','4Assunto','4Mensagem','2015-04-15 02:38:12',2,NULL,NULL),(5,'5Remetente','5Destino','5Assunto','5Mensagem','2015-04-15 02:38:12',2,NULL,NULL),(6,'6Remetente','6Destino','6Assunto','6Mensagem','2015-04-15 02:38:12',3,NULL,NULL),(7,'7Remetente','7Destino','7Assunto','7Mensagem','2015-04-15 02:38:12',3,NULL,NULL),(8,'8Remetente','8Destino','8Assunto','8Mensagem','2015-04-15 02:38:12',3,NULL,NULL),(9,'9Remetente','9Destino','9Assunto','9Mensagem','2015-04-15 02:38:12',3,NULL,NULL),(10,'10Remetente','10Destino','10Assunto','10Mensagem','2015-04-15 02:38:12',3,NULL,NULL),(11,'11Remetente','11Destino','11Assunto','11Mensagem','2015-04-15 02:38:12',4,NULL,NULL),(12,'12Remetente','12Destino','12Assunto','12Mensagem','2015-04-15 02:38:12',4,NULL,NULL),(13,'13Remetente','13Destino','13Assunto','13Mensagem','2015-04-15 02:38:12',4,NULL,NULL),(14,'14Remetente','14Destino','14Assunto','14Mensagem','2015-04-15 02:38:12',4,NULL,NULL),(15,'15Remetente','15Destino','15Assunto','15Mensagem','2015-04-15 02:38:12',4,NULL,NULL),(16,'16Remetente','16Destino','16Assunto','16Mensagem','2015-04-15 02:38:12',5,NULL,NULL),(17,'17Remetente','17Destino','17Assunto','17Mensagem','2015-04-15 02:38:12',5,NULL,NULL),(18,'18Remetente','18Destino','18Assunto','18Mensagem','2015-04-15 02:38:12',5,NULL,NULL),(19,'19Remetente','19Destino','19Assunto','19Mensagem','2015-04-15 02:38:12',5,NULL,NULL),(20,'20Remetente','20Destino','20Assunto','20Mensagem','2015-04-15 02:38:12',5,NULL,NULL),(21,'21Remetente','21Destino','21Assunto','21Mensagem','2015-04-15 02:38:12',6,NULL,NULL),(22,'22Remetente','22Destino','22Assunto','22Mensagem','2015-04-15 02:38:12',6,NULL,NULL),(23,'23Remetente','23Destino','23Assunto','23Mensagem','2015-04-15 02:38:12',6,NULL,NULL),(24,'24Remetente','24Destino','24Assunto','24Mensagem','2015-04-15 02:38:12',6,NULL,NULL),(25,'25Remetente','25Destino','25Assunto','25Mensagem','2015-04-15 02:38:12',6,NULL,NULL),(26,'26Remetente','26Destino','26Assunto','26Mensagem','2015-04-15 02:38:12',7,NULL,NULL),(27,'27Remetente','27Destino','27Assunto','27Mensagem','2015-04-15 02:38:12',7,NULL,NULL),(28,'28Remetente','28Destino','28Assunto','28Mensagem','2015-04-15 02:38:12',7,NULL,NULL),(29,'29Remetente','29Destino','29Assunto','29Mensagem','2015-04-15 02:38:12',7,NULL,NULL),(30,'30Remetente','30Destino','30Assunto','30Mensagem','2015-04-15 02:38:12',7,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (1,'Gear','2015-04-15 02:38:13',2,NULL,NULL),(2,'GearAclUp','2015-04-15 02:38:15',2,NULL,NULL),(3,'GearVersion','2015-04-15 02:38:15',2,NULL,NULL),(4,'GearJson','2015-04-15 02:38:15',2,NULL,NULL),(5,'GearBackup','2015-04-15 02:38:15',2,NULL,NULL),(6,'Security','2015-04-15 02:38:15',2,NULL,NULL),(7,'Teste','2015-04-15 02:38:16',2,NULL,NULL);
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
INSERT INTO `role` VALUES (1,NULL,'guest','2015-04-15 02:38:12',2,NULL,NULL),(2,1,'admin','2015-04-15 02:38:12',2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rule`
--

LOCK TABLES `rule` WRITE;
/*!40000 ALTER TABLE `rule` DISABLE KEYS */;
INSERT INTO `rule` VALUES (1,1,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(2,2,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(3,3,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(4,4,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(5,5,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(6,6,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(7,7,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(8,8,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(9,9,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(10,10,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(11,11,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(12,12,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(13,13,1,1,'2015-04-15 02:38:13',2,NULL,NULL),(14,14,2,1,'2015-04-15 02:38:13',2,NULL,NULL),(15,15,3,1,'2015-04-15 02:38:13',2,NULL,NULL),(16,16,4,1,'2015-04-15 02:38:13',2,NULL,NULL),(17,17,4,1,'2015-04-15 02:38:13',2,NULL,NULL),(18,18,4,1,'2015-04-15 02:38:13',2,NULL,NULL),(19,19,4,1,'2015-04-15 02:38:13',2,NULL,NULL),(20,20,4,1,'2015-04-15 02:38:13',2,NULL,NULL),(21,21,4,1,'2015-04-15 02:38:13',2,NULL,NULL),(22,22,5,1,'2015-04-15 02:38:13',2,NULL,NULL),(23,23,5,1,'2015-04-15 02:38:13',2,NULL,NULL),(24,24,5,1,'2015-04-15 02:38:13',2,NULL,NULL),(25,25,5,1,'2015-04-15 02:38:13',2,NULL,NULL),(26,26,5,1,'2015-04-15 02:38:13',2,NULL,NULL),(27,27,5,1,'2015-04-15 02:38:13',2,NULL,NULL),(28,28,5,1,'2015-04-15 02:38:13',2,NULL,NULL),(29,29,5,1,'2015-04-15 02:38:13',2,NULL,NULL),(30,30,5,1,'2015-04-15 02:38:14',2,NULL,NULL),(31,31,5,1,'2015-04-15 02:38:14',2,NULL,NULL),(32,32,6,1,'2015-04-15 02:38:14',2,NULL,NULL),(33,33,6,1,'2015-04-15 02:38:14',2,NULL,NULL),(34,34,6,1,'2015-04-15 02:38:14',2,NULL,NULL),(35,35,6,1,'2015-04-15 02:38:14',2,NULL,NULL),(36,36,6,1,'2015-04-15 02:38:14',2,NULL,NULL),(37,37,6,1,'2015-04-15 02:38:14',2,NULL,NULL),(38,38,6,1,'2015-04-15 02:38:14',2,NULL,NULL),(39,39,6,1,'2015-04-15 02:38:14',2,NULL,NULL),(40,40,6,1,'2015-04-15 02:38:14',2,NULL,NULL),(41,41,6,1,'2015-04-15 02:38:14',2,NULL,NULL),(42,42,6,1,'2015-04-15 02:38:14',2,NULL,NULL),(43,43,6,1,'2015-04-15 02:38:14',2,NULL,NULL),(44,44,6,1,'2015-04-15 02:38:15',2,NULL,NULL),(45,45,7,1,'2015-04-15 02:38:15',2,NULL,NULL),(46,46,7,1,'2015-04-15 02:38:15',2,NULL,NULL),(47,47,8,1,'2015-04-15 02:38:15',2,NULL,NULL),(48,48,9,1,'2015-04-15 02:38:15',2,NULL,NULL),(49,49,10,1,'2015-04-15 02:38:15',2,NULL,NULL),(50,50,11,1,'2015-04-15 02:38:15',2,NULL,NULL),(51,51,11,1,'2015-04-15 02:38:15',2,NULL,NULL),(52,52,11,1,'2015-04-15 02:38:15',2,NULL,NULL),(53,53,11,1,'2015-04-15 02:38:15',2,NULL,NULL),(54,54,11,1,'2015-04-15 02:38:15',2,NULL,NULL),(55,55,11,2,'2015-04-15 02:38:15',2,NULL,NULL),(56,56,11,2,'2015-04-15 02:38:15',2,NULL,NULL),(57,57,11,2,'2015-04-15 02:38:15',2,NULL,NULL),(58,58,11,2,'2015-04-15 02:38:15',2,NULL,NULL),(59,59,11,1,'2015-04-15 02:38:15',2,NULL,NULL),(60,60,12,1,'2015-04-15 02:38:16',2,NULL,NULL),(61,61,12,1,'2015-04-15 02:38:16',2,NULL,NULL),(62,62,13,1,'2015-04-15 02:38:16',2,NULL,NULL),(63,63,14,2,'2015-04-15 02:38:16',2,NULL,NULL),(64,64,14,2,'2015-04-15 02:38:16',2,NULL,NULL),(65,65,14,2,'2015-04-15 02:38:16',2,NULL,NULL),(66,66,14,2,'2015-04-15 02:38:16',2,NULL,NULL),(67,67,14,2,'2015-04-15 02:38:16',2,NULL,NULL);
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
INSERT INTO `user` VALUES (1,'gear@pibernetwork.com','$2y$14$vwO4Fg0qMbi.j7dQODlzcuq6Yh25o1gxSQiWV.UGXIRXKrSWUUcmi','',1,'1552df93c3ebb61.11412834','2015-04-15 02:38:04','2015-04-15 02:38:04',1,1,NULL),(2,'usuariogear1@gmail.com','$2y$14$4qEU.14VM3Ku8mEzRCt0buvw3FtR2wJKcUIIpxZdOWb4Ms5GFFpzW','',1,'1552df93db21951.81840877','2015-04-15 02:38:05','2015-04-15 02:38:05',2,2,2),(3,'usuariogear2@gmail.com','$2y$14$QOtCMoTLo.bQZVZb4XRrIuvIB5fmopxRO.Ti9yxmgk85uJSzF8lvC','',1,'1552df93f193148.58650683','2015-04-15 02:38:07','2015-04-15 02:38:07',3,3,2),(4,'usuariogear3@gmail.com','$2y$14$HQ4zzHMshnf4FFuIlfUWWOZMuu3Yn.JsGle.L5zmKfsersR.G0LK2','',1,'1552df940620b20.48922836','2015-04-15 02:38:08','2015-04-15 02:38:08',4,4,2),(5,'usuariogear4@gmail.com','$2y$14$6XYX8.mkG4lFXmU76gJiu.IkjhXlEZb1r4hOwvrHn46JILlFvSk9u','',1,'1552df941a65487.07662219','2015-04-15 02:38:09','2015-04-15 02:38:09',5,5,2),(6,'usuariogear5@gmail.com','$2y$14$vJPrADd5j54mBkYfr.9gpOLT/yU3StdkK1MMc4ypdCqG5Ako68OSG','',1,'1552df94301a2a2.57429194','2015-04-15 02:38:11','2015-04-15 02:38:11',6,6,2),(7,'usuariogear6@gmail.com','$2y$14$I/3xDN8JH842IAM53tVGu.k2LUrptVzMneFogBdxSXraz10n073Y.','',1,'1552df9444f12a4.15639402','2015-04-15 02:38:12','2015-04-15 02:38:12',7,7,2);
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

-- Dump completed on 2015-04-15  5:38:17
