-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: f5fuck-test
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
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_action`),
  KEY `IDX_47CC8C92E978E64D` (`id_controller`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `action_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `action_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_47CC8C92E978E64D` FOREIGN KEY (`id_controller`) REFERENCES `controller` (`id_controller`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

LOCK TABLES `action` WRITE;
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` VALUES (1,1,'Login','2015-02-10 13:14:41',NULL,1,NULL),(2,1,'SendPasswordRecoveryRequest','2015-02-10 13:14:41',NULL,1,NULL),(3,1,'PasswordRecoveryRequestSent','2015-02-10 13:14:41',NULL,1,NULL),(4,1,'PasswordRecovery','2015-02-10 13:14:41',NULL,1,NULL),(5,1,'PasswordRecoverySuccessful','2015-02-10 13:14:41',NULL,1,NULL),(6,1,'Index','2015-02-10 13:14:41',NULL,1,NULL),(7,1,'ChangePassword','2015-02-10 13:14:41',NULL,1,NULL),(8,1,'ChangePasswordSuccessful','2015-02-10 13:14:41',NULL,1,NULL),(9,1,'Logout','2015-02-10 13:14:41',NULL,1,NULL),(10,1,'InvalidLink','2015-02-10 13:14:41',NULL,1,NULL),(11,2,'Register','2015-02-10 13:14:41',NULL,1,NULL),(12,2,'Acl','2015-02-10 13:14:41',NULL,1,NULL),(13,3,'AutoincrementDatabase','2015-02-10 13:14:41',NULL,1,NULL),(14,3,'DropTable','2015-02-10 13:14:41',NULL,1,NULL),(15,3,'GetOrder','2015-02-10 13:14:41',NULL,1,NULL),(16,3,'AnalyseDatabase','2015-02-10 13:14:41',NULL,1,NULL),(17,3,'AnalyseTable','2015-02-10 13:14:41',NULL,1,NULL),(18,3,'AutoincrementTable','2015-02-10 13:14:41',NULL,1,NULL),(19,3,'ClearTable','2015-02-10 13:14:41',NULL,1,NULL),(20,3,'CreateColumn','2015-02-10 13:14:41',NULL,1,NULL),(21,3,'FixDatabase','2015-02-10 13:14:41',NULL,1,NULL),(22,3,'FixTable','2015-02-10 13:14:41',NULL,1,NULL),(23,3,'MysqlLoad','2015-02-10 13:14:41',NULL,1,NULL),(24,3,'MysqlDump','2015-02-10 13:14:41',NULL,1,NULL),(25,4,'Build','2015-02-10 13:14:41',NULL,1,NULL),(26,5,'Version','2015-02-10 13:14:41',NULL,1,NULL),(27,6,'Action','2015-02-10 13:14:41',NULL,1,NULL),(28,6,'Controller','2015-02-10 13:14:41',NULL,1,NULL),(29,6,'Db','2015-02-10 13:14:41',NULL,1,NULL),(30,6,'Src','2015-02-10 13:14:41',NULL,1,NULL),(31,6,'Test','2015-02-10 13:14:41',NULL,1,NULL),(32,6,'View','2015-02-10 13:14:41',NULL,1,NULL),(33,7,'Entities','2015-02-10 13:14:42',NULL,1,NULL),(34,7,'Entity','2015-02-10 13:14:42',NULL,1,NULL),(35,7,'Dump','2015-02-10 13:14:42',NULL,1,NULL),(36,7,'Create','2015-02-10 13:14:42',NULL,1,NULL),(37,7,'Delete','2015-02-10 13:14:42',NULL,1,NULL),(38,7,'Load','2015-02-10 13:14:42',NULL,1,NULL),(39,7,'Unload','2015-02-10 13:14:42',NULL,1,NULL),(40,7,'Build','2015-02-10 13:14:42',NULL,1,NULL),(41,7,'Push','2015-02-10 13:14:42',NULL,1,NULL),(42,7,'Light','2015-02-10 13:14:42',NULL,1,NULL),(43,8,'Deploy','2015-02-10 13:14:42',NULL,1,NULL),(44,8,'Mysql2sqlite','2015-02-10 13:14:42',NULL,1,NULL),(45,8,'ResetAcl','2015-02-10 13:14:42',NULL,1,NULL),(46,8,'Acl','2015-02-10 13:14:42',NULL,1,NULL),(47,8,'Config','2015-02-10 13:14:42',NULL,1,NULL),(48,8,'Dump','2015-02-10 13:14:42',NULL,1,NULL),(49,8,'Environment','2015-02-10 13:14:42',NULL,1,NULL),(50,8,'Global','2015-02-10 13:14:42',NULL,1,NULL),(51,8,'Local','2015-02-10 13:14:42',NULL,1,NULL),(52,8,'Mysql','2015-02-10 13:14:42',NULL,1,NULL),(53,8,'Project','2015-02-10 13:14:42',NULL,1,NULL),(54,8,'Sqlite','2015-02-10 13:14:42',NULL,1,NULL),(55,9,'Index','2015-02-10 13:14:43',NULL,1,NULL),(56,10,'ListarImagem','2015-02-10 13:14:43',NULL,1,NULL),(57,10,'ExcluirImagem','2015-02-10 13:14:43',NULL,1,NULL),(58,10,'SalvarImagem','2015-02-10 13:14:43',NULL,1,NULL),(59,11,'Index','2015-02-10 13:14:43',NULL,1,NULL),(60,12,'Create','2015-02-10 13:14:43',NULL,1,NULL),(61,12,'Edit','2015-02-10 13:14:43',NULL,1,NULL),(62,12,'List','2015-02-10 13:14:43',NULL,1,NULL),(63,12,'Delete','2015-02-10 13:14:43',NULL,1,NULL),(64,12,'View','2015-02-10 13:14:43',NULL,1,NULL);
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
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `invokable` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_controller`),
  KEY `IDX_4CF2669A2A1393C5` (`id_module`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `controller_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `controller_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_4CF2669A2A1393C5` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controller`
--

LOCK TABLES `controller` WRITE;
/*!40000 ALTER TABLE `controller` DISABLE KEYS */;
INSERT INTO `controller` VALUES (1,1,'Index','Security\\Controller\\Index','2015-02-10 13:14:41',NULL,1,NULL),(2,1,'User','Security\\Controller\\User','2015-02-10 13:14:41',NULL,1,NULL),(3,2,'Db','Gear\\Controller\\Db','2015-02-10 13:14:41',NULL,1,NULL),(4,2,'Build','Gear\\Controller\\Build','2015-02-10 13:14:41',NULL,1,NULL),(5,2,'Gear','Gear\\Controller\\Gear','2015-02-10 13:14:41',NULL,1,NULL),(6,2,'Constructor','Gear\\Controller\\Constructor','2015-02-10 13:14:41',NULL,1,NULL),(7,2,'Module','Gear\\Controller\\Module','2015-02-10 13:14:42',NULL,1,NULL),(8,2,'Project','Gear\\Controller\\Project','2015-02-10 13:14:42',NULL,1,NULL),(9,3,'Index','ImagemUpload\\Controller\\Index','2015-02-10 13:14:43',NULL,1,NULL),(10,3,'Imagem','ImagemUpload\\Controller\\Imagem','2015-02-10 13:14:43',NULL,1,NULL),(11,4,'IndexController','Teste\\Controller\\Index','2015-02-10 13:14:43',NULL,1,NULL),(12,4,'EmailController','Teste\\Controller\\Email','2015-02-10 13:14:43',NULL,1,NULL);
/*!40000 ALTER TABLE `controller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custo`
--

DROP TABLE IF EXISTS `custo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custo` (
  `id_custo` int(11) NOT NULL AUTO_INCREMENT,
  `id_status_custo` int(11) DEFAULT NULL,
  `id_tipo_custo` int(11) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `data_custo` date DEFAULT NULL,
  `planejado` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_custo`),
  KEY `fk_custo_2` (`id_tipo_custo`),
  KEY `fk_custo_1` (`id_status_custo`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `custo_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `custo_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_custo_1` FOREIGN KEY (`id_status_custo`) REFERENCES `status_custo` (`id_status_custo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_custo_2` FOREIGN KEY (`id_tipo_custo`) REFERENCES `tipo_custo` (`id_tipo_custo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custo`
--

LOCK TABLES `custo` WRITE;
/*!40000 ALTER TABLE `custo` DISABLE KEYS */;
/*!40000 ALTER TABLE `custo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email` (
  `id_email` int(11) NOT NULL AUTO_INCREMENT,
  `remetente` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `destino` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `assunto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mensagem` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_email`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `email_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `email_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
INSERT INTO `email` VALUES (1,'1Remetente','1Destino','1Assunto','1Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(2,'2Remetente','2Destino','2Assunto','2Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(3,'3Remetente','3Destino','3Assunto','3Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(4,'4Remetente','4Destino','4Assunto','4Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(5,'5Remetente','5Destino','5Assunto','5Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(6,'6Remetente','6Destino','6Assunto','6Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(7,'7Remetente','7Destino','7Assunto','7Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(8,'8Remetente','8Destino','8Assunto','8Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(9,'9Remetente','9Destino','9Assunto','9Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(10,'10Remetente','10Destino','10Assunto','10Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(11,'11Remetente','11Destino','11Assunto','11Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(12,'12Remetente','12Destino','12Assunto','12Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(13,'13Remetente','13Destino','13Assunto','13Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(14,'14Remetente','14Destino','14Assunto','14Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(15,'15Remetente','15Destino','15Assunto','15Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(16,'16Remetente','16Destino','16Assunto','16Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(17,'17Remetente','17Destino','17Assunto','17Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(18,'18Remetente','18Destino','18Assunto','18Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(19,'19Remetente','19Destino','19Assunto','19Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(20,'20Remetente','20Destino','20Assunto','20Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(21,'21Remetente','21Destino','21Assunto','21Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(22,'22Remetente','22Destino','22Assunto','22Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(23,'23Remetente','23Destino','23Assunto','23Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(24,'24Remetente','24Destino','24Assunto','24Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(25,'25Remetente','25Destino','25Assunto','25Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(26,'26Remetente','26Destino','26Assunto','26Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(27,'27Remetente','27Destino','27Assunto','27Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(28,'28Remetente','28Destino','28Assunto','28Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(29,'29Remetente','29Destino','29Assunto','29Mensagem','2015-02-10 13:14:40',NULL,1,NULL),(30,'30Remetente','30Destino','30Assunto','30Mensagem','2015-02-10 13:14:40',NULL,1,NULL);
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_custo`
--

DROP TABLE IF EXISTS `grupo_custo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_custo` (
  `id_grupo_custo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_grupo_custo`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `grupo_custo_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `grupo_custo_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_custo`
--

LOCK TABLES `grupo_custo` WRITE;
/*!40000 ALTER TABLE `grupo_custo` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_custo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_module`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `module_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (1,'Security','2015-02-10 13:14:41',NULL,1,NULL),(2,'Gear','2015-02-10 13:14:41',NULL,1,NULL),(3,'ImagemUpload','2015-02-10 13:14:42',NULL,1,NULL),(4,'Teste','2015-02-10 13:14:43',NULL,1,NULL);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mytablelog`
--

DROP TABLE IF EXISTS `mytablelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mytablelog` (
  `id_mytablelog` int(11) NOT NULL AUTO_INCREMENT,
  `version` bigint(14) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_mytablelog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mytablelog`
--

LOCK TABLES `mytablelog` WRITE;
/*!40000 ALTER TABLE `mytablelog` DISABLE KEYS */;
/*!40000 ALTER TABLE `mytablelog` ENABLE KEYS */;
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
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_role`),
  KEY `fk_role_1` (`created_by`),
  KEY `fk_role_2` (`updated_by`),
  KEY `fk_role_3` (`id_parent`),
  CONSTRAINT `fk_role_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_3` FOREIGN KEY (`id_parent`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,NULL,'guest','2015-02-10 13:14:40',NULL,1,NULL),(2,1,'admin','2015-02-10 13:14:40',NULL,1,NULL),(3,NULL,'1Name','2015-02-10 13:14:40',NULL,1,NULL),(4,NULL,'2Name','2015-02-10 13:14:40',NULL,1,NULL),(5,NULL,'3Name','2015-02-10 13:14:40',NULL,1,NULL),(6,NULL,'4Name','2015-02-10 13:14:40',NULL,1,NULL),(7,NULL,'5Name','2015-02-10 13:14:40',NULL,1,NULL),(8,NULL,'6Name','2015-02-10 13:14:40',NULL,1,NULL),(9,NULL,'7Name','2015-02-10 13:14:40',NULL,1,NULL),(10,NULL,'8Name','2015-02-10 13:14:40',NULL,1,NULL),(11,NULL,'9Name','2015-02-10 13:14:40',NULL,1,NULL),(12,NULL,'10Name','2015-02-10 13:14:40',NULL,1,NULL),(13,NULL,'11Name','2015-02-10 13:14:40',NULL,1,NULL),(14,NULL,'12Name','2015-02-10 13:14:40',NULL,1,NULL),(15,NULL,'13Name','2015-02-10 13:14:40',NULL,1,NULL),(16,NULL,'14Name','2015-02-10 13:14:40',NULL,1,NULL),(17,NULL,'15Name','2015-02-10 13:14:40',NULL,1,NULL),(18,NULL,'16Name','2015-02-10 13:14:40',NULL,1,NULL),(19,NULL,'17Name','2015-02-10 13:14:40',NULL,1,NULL),(20,NULL,'18Name','2015-02-10 13:14:40',NULL,1,NULL),(21,NULL,'19Name','2015-02-10 13:14:40',NULL,1,NULL),(22,NULL,'20Name','2015-02-10 13:14:40',NULL,1,NULL),(23,NULL,'21Name','2015-02-10 13:14:40',NULL,1,NULL),(24,NULL,'22Name','2015-02-10 13:14:40',NULL,1,NULL),(25,NULL,'23Name','2015-02-10 13:14:40',NULL,1,NULL),(26,NULL,'24Name','2015-02-10 13:14:40',NULL,1,NULL),(27,NULL,'25Name','2015-02-10 13:14:40',NULL,1,NULL),(28,NULL,'26Name','2015-02-10 13:14:40',NULL,1,NULL),(29,NULL,'27Name','2015-02-10 13:14:40',NULL,1,NULL),(30,NULL,'28Name','2015-02-10 13:14:40',NULL,1,NULL),(31,NULL,'29Name','2015-02-10 13:14:40',NULL,1,NULL),(32,NULL,'30Name','2015-02-10 13:14:40',NULL,1,NULL);
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
  `id_role` int(11) NOT NULL,
  `id_controller` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_rule`),
  KEY `IDX_46D8ACCC61FB397F` (`id_action`),
  KEY `IDX_46D8ACCCE978E64D` (`id_controller`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `fk_rule_1` (`id_role`),
  CONSTRAINT `FK_46D8ACCC61FB397F` FOREIGN KEY (`id_action`) REFERENCES `action` (`id_action`) ON DELETE CASCADE,
  CONSTRAINT `FK_46D8ACCCE978E64D` FOREIGN KEY (`id_controller`) REFERENCES `controller` (`id_controller`) ON DELETE CASCADE,
  CONSTRAINT `fk_rule_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rule_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `rule_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rule`
--

LOCK TABLES `rule` WRITE;
/*!40000 ALTER TABLE `rule` DISABLE KEYS */;
INSERT INTO `rule` VALUES (1,1,1,1,'2015-02-10 13:14:41',NULL,1,NULL),(2,2,1,1,'2015-02-10 13:14:41',NULL,1,NULL),(3,3,1,1,'2015-02-10 13:14:41',NULL,1,NULL),(4,4,1,1,'2015-02-10 13:14:41',NULL,1,NULL),(5,5,1,1,'2015-02-10 13:14:41',NULL,1,NULL),(6,6,2,1,'2015-02-10 13:14:41',NULL,1,NULL),(7,7,2,1,'2015-02-10 13:14:41',NULL,1,NULL),(8,8,2,1,'2015-02-10 13:14:41',NULL,1,NULL),(9,9,2,1,'2015-02-10 13:14:41',NULL,1,NULL),(10,10,1,1,'2015-02-10 13:14:41',NULL,1,NULL),(11,11,1,2,'2015-02-10 13:14:41',NULL,1,NULL),(12,12,1,2,'2015-02-10 13:14:41',NULL,1,NULL),(13,13,1,3,'2015-02-10 13:14:41',NULL,1,NULL),(14,14,1,3,'2015-02-10 13:14:41',NULL,1,NULL),(15,15,1,3,'2015-02-10 13:14:41',NULL,1,NULL),(16,16,1,3,'2015-02-10 13:14:41',NULL,1,NULL),(17,17,1,3,'2015-02-10 13:14:41',NULL,1,NULL),(18,18,1,3,'2015-02-10 13:14:41',NULL,1,NULL),(19,19,1,3,'2015-02-10 13:14:41',NULL,1,NULL),(20,20,1,3,'2015-02-10 13:14:41',NULL,1,NULL),(21,21,1,3,'2015-02-10 13:14:41',NULL,1,NULL),(22,22,1,3,'2015-02-10 13:14:41',NULL,1,NULL),(23,23,1,3,'2015-02-10 13:14:41',NULL,1,NULL),(24,24,1,3,'2015-02-10 13:14:41',NULL,1,NULL),(25,25,1,4,'2015-02-10 13:14:41',NULL,1,NULL),(26,26,1,5,'2015-02-10 13:14:41',NULL,1,NULL),(27,27,1,6,'2015-02-10 13:14:41',NULL,1,NULL),(28,28,1,6,'2015-02-10 13:14:41',NULL,1,NULL),(29,29,1,6,'2015-02-10 13:14:41',NULL,1,NULL),(30,30,1,6,'2015-02-10 13:14:41',NULL,1,NULL),(31,31,1,6,'2015-02-10 13:14:41',NULL,1,NULL),(32,32,1,6,'2015-02-10 13:14:42',NULL,1,NULL),(33,33,1,7,'2015-02-10 13:14:42',NULL,1,NULL),(34,34,1,7,'2015-02-10 13:14:42',NULL,1,NULL),(35,35,1,7,'2015-02-10 13:14:42',NULL,1,NULL),(36,36,1,7,'2015-02-10 13:14:42',NULL,1,NULL),(37,37,1,7,'2015-02-10 13:14:42',NULL,1,NULL),(38,38,1,7,'2015-02-10 13:14:42',NULL,1,NULL),(39,39,1,7,'2015-02-10 13:14:42',NULL,1,NULL),(40,40,1,7,'2015-02-10 13:14:42',NULL,1,NULL),(41,41,1,7,'2015-02-10 13:14:42',NULL,1,NULL),(42,42,1,7,'2015-02-10 13:14:42',NULL,1,NULL),(43,43,1,8,'2015-02-10 13:14:42',NULL,1,NULL),(44,44,1,8,'2015-02-10 13:14:42',NULL,1,NULL),(45,45,1,8,'2015-02-10 13:14:42',NULL,1,NULL),(46,46,1,8,'2015-02-10 13:14:42',NULL,1,NULL),(47,47,1,8,'2015-02-10 13:14:42',NULL,1,NULL),(48,48,1,8,'2015-02-10 13:14:42',NULL,1,NULL),(49,49,1,8,'2015-02-10 13:14:42',NULL,1,NULL),(50,50,1,8,'2015-02-10 13:14:42',NULL,1,NULL),(51,51,1,8,'2015-02-10 13:14:42',NULL,1,NULL),(52,52,1,8,'2015-02-10 13:14:42',NULL,1,NULL),(53,53,1,8,'2015-02-10 13:14:42',NULL,1,NULL),(54,54,1,8,'2015-02-10 13:14:42',NULL,1,NULL),(55,55,1,9,'2015-02-10 13:14:43',NULL,1,NULL),(56,56,1,10,'2015-02-10 13:14:43',NULL,1,NULL),(57,57,1,10,'2015-02-10 13:14:43',NULL,1,NULL),(58,58,1,10,'2015-02-10 13:14:43',NULL,1,NULL),(59,59,1,11,'2015-02-10 13:14:43',NULL,1,NULL),(60,60,2,12,'2015-02-10 13:14:43',NULL,1,NULL),(61,61,2,12,'2015-02-10 13:14:43',NULL,1,NULL),(62,62,2,12,'2015-02-10 13:14:43',NULL,1,NULL),(63,63,2,12,'2015-02-10 13:14:43',NULL,1,NULL),(64,64,2,12,'2015-02-10 13:14:43',NULL,1,NULL);
/*!40000 ALTER TABLE `rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_custo`
--

DROP TABLE IF EXISTS `status_custo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_custo` (
  `id_status_custo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_status_custo`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `status_custo_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `status_custo_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_custo`
--

LOCK TABLES `status_custo` WRITE;
/*!40000 ALTER TABLE `status_custo` DISABLE KEYS */;
/*!40000 ALTER TABLE `status_custo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testing_suite`
--

DROP TABLE IF EXISTS `testing_suite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testing_suite` (
  `id_testing_suite` int(11) NOT NULL AUTO_INCREMENT,
  `test_date` date NOT NULL,
  `test_datetime` datetime NOT NULL,
  `test_time` time NOT NULL,
  `test_decimal` decimal(10,2) NOT NULL,
  `test_decimal_money_pt_br` decimal(10,2) NOT NULL,
  `test_date_pt_br` date NOT NULL,
  `test_datetime_pt_br` datetime NOT NULL,
  `test_int` int(11) NOT NULL,
  `test_int_checkbox` int(11) NOT NULL,
  `test_varchar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `test_varchar_image_upload` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `test_tinyint` tinyint(4) NOT NULL,
  `test_tinyint_checkbox` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  `test_text` text COLLATE utf8_unicode_ci NOT NULL,
  `id_test_user` int(11) NOT NULL,
  `test_varchar_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_testing_suite`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `fk_testing_suite_1` (`id_test_user`),
  CONSTRAINT `fk_testing_suite_1` FOREIGN KEY (`id_test_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `testing_suite_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `testing_suite_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testing_suite`
--

LOCK TABLES `testing_suite` WRITE;
/*!40000 ALTER TABLE `testing_suite` DISABLE KEYS */;
/*!40000 ALTER TABLE `testing_suite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_custo`
--

DROP TABLE IF EXISTS `tipo_custo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_custo` (
  `id_tipo_custo` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo_custo` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_custo`),
  KEY `fk_tipo_custo_1` (`id_grupo_custo`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `fk_tipo_custo_1` FOREIGN KEY (`id_grupo_custo`) REFERENCES `grupo_custo` (`id_grupo_custo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tipo_custo_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tipo_custo_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_custo`
--

LOCK TABLES `tipo_custo` WRITE;
/*!40000 ALTER TABLE `tipo_custo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_custo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL,
  `uid` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) DEFAULT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'usuariogear1@gmail.com','$2y$14$JsFDosj5keh8nS0Vg6b8/.onOQIUoLLOJzxvs4jNlXVj8ZJGlZKVS','',1,'154da2059e863b4.86380647','2015-02-10 13:14:33','2015-02-10 13:14:33',1,1),(2,'usuariogear2@gmail.com','$2y$14$s4Z064qbo6h81Kk3wZiw1.Z7osVXH8dDJLb73KYRkmlmKBWS9zs0G','',1,'154da205b3bca43.78503658','2015-02-10 13:14:35','2015-02-10 13:14:35',2,2),(3,'usuariogear3@gmail.com','$2y$14$lGCa6utoiw5sQFOi0ENqr.oZ7bjDnVYMKFwwu6MZilmvuXjiPiw4q','',1,'154da205c7cdcb3.76016929','2015-02-10 13:14:36','2015-02-10 13:14:36',3,3),(4,'usuariogear4@gmail.com','$2y$14$vG4gR2d/joVRgAUjpCjfSel6J2p2uFCjBUKNuuA0Ewq/SsioHkUvC','',1,'154da205db52de8.69392046','2015-02-10 13:14:37','2015-02-10 13:14:37',4,4),(5,'usuariogear5@gmail.com','$2y$14$lF8SsC1V9c3T055MuGV9h.G8mDHYi2PNGiPEaTsu5.LVsnXRb.WcK','',1,'154da205f031732.71080319','2015-02-10 13:14:39','2015-02-10 13:14:39',5,5),(6,'usuariogear6@gmail.com','$2y$14$PD087czV06VAt.nx4xZLmOk2TcuUcHc7LwZY9Pjxjqtfv.CI.Ap7S','',1,'154da2060493ea9.03564978','2015-02-10 13:14:40','2015-02-10 13:14:40',6,6),(7,'1Email','1Password','1Username',1,'1Uid','2015-02-10 13:14:40',NULL,1,NULL),(8,'2Email','2Password','2Username',2,'2Uid','2015-02-10 13:14:40',NULL,1,NULL),(9,'3Email','3Password','3Username',3,'3Uid','2015-02-10 13:14:40',NULL,1,NULL),(10,'4Email','4Password','4Username',4,'4Uid','2015-02-10 13:14:40',NULL,1,NULL),(11,'5Email','5Password','5Username',5,'5Uid','2015-02-10 13:14:40',NULL,1,NULL),(12,'6Email','6Password','6Username',6,'6Uid','2015-02-10 13:14:40',NULL,1,NULL),(13,'7Email','7Password','7Username',7,'7Uid','2015-02-10 13:14:40',NULL,1,NULL),(14,'8Email','8Password','8Username',8,'8Uid','2015-02-10 13:14:40',NULL,1,NULL),(15,'9Email','9Password','9Username',9,'9Uid','2015-02-10 13:14:40',NULL,1,NULL),(16,'10Email','10Password','10Username',10,'10Uid','2015-02-10 13:14:40',NULL,1,NULL),(17,'11Email','11Password','11Username',11,'11Uid','2015-02-10 13:14:40',NULL,1,NULL),(18,'12Email','12Password','12Username',12,'12Uid','2015-02-10 13:14:40',NULL,1,NULL),(19,'13Email','13Password','13Username',13,'13Uid','2015-02-10 13:14:40',NULL,1,NULL),(20,'14Email','14Password','14Username',14,'14Uid','2015-02-10 13:14:40',NULL,1,NULL),(21,'15Email','15Password','15Username',15,'15Uid','2015-02-10 13:14:40',NULL,1,NULL),(22,'16Email','16Password','16Username',16,'16Uid','2015-02-10 13:14:40',NULL,1,NULL),(23,'17Email','17Password','17Username',17,'17Uid','2015-02-10 13:14:40',NULL,1,NULL),(24,'18Email','18Password','18Username',18,'18Uid','2015-02-10 13:14:40',NULL,1,NULL),(25,'19Email','19Password','19Username',19,'19Uid','2015-02-10 13:14:40',NULL,1,NULL),(26,'20Email','20Password','20Username',20,'20Uid','2015-02-10 13:14:40',NULL,1,NULL),(27,'21Email','21Password','21Username',21,'21Uid','2015-02-10 13:14:40',NULL,1,NULL),(28,'22Email','22Password','22Username',22,'22Uid','2015-02-10 13:14:40',NULL,1,NULL),(29,'23Email','23Password','23Username',23,'23Uid','2015-02-10 13:14:40',NULL,1,NULL),(30,'24Email','24Password','24Username',24,'24Uid','2015-02-10 13:14:40',NULL,1,NULL),(31,'25Email','25Password','25Username',25,'25Uid','2015-02-10 13:14:40',NULL,1,NULL),(32,'26Email','26Password','26Username',26,'26Uid','2015-02-10 13:14:40',NULL,1,NULL),(33,'27Email','27Password','27Username',27,'27Uid','2015-02-10 13:14:40',NULL,1,NULL),(34,'28Email','28Password','28Username',28,'28Uid','2015-02-10 13:14:40',NULL,1,NULL),(35,'29Email','29Password','29Username',29,'29Uid','2015-02-10 13:14:40',NULL,1,NULL),(36,'30Email','30Password','30Username',30,'30Uid','2015-02-10 13:14:40',NULL,1,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role_linker`
--

DROP TABLE IF EXISTS `user_role_linker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role_linker` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_role`),
  KEY `IDX_611178996B3CA4B` (`id_user`),
  KEY `IDX_61117899DC499668` (`id_role`),
  KEY `fk_user_role_linker_1` (`id_role`),
  CONSTRAINT `FK_611178996B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `fk_user_role_linker_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role_linker`
--

LOCK TABLES `user_role_linker` WRITE;
/*!40000 ALTER TABLE `user_role_linker` DISABLE KEYS */;
INSERT INTO `user_role_linker` VALUES (1,2),(2,2),(3,2),(4,2),(5,2),(6,2);
/*!40000 ALTER TABLE `user_role_linker` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-10 15:14:43
