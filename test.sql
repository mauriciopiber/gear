-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: financial
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
  PRIMARY KEY (`id_action`),
  KEY `IDX_47CC8C92E978E64D` (`id_controller`),
  CONSTRAINT `FK_47CC8C92E978E64D` FOREIGN KEY (`id_controller`) REFERENCES `controller` (`id_controller`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

LOCK TABLES `action` WRITE;
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
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
  PRIMARY KEY (`id_controller`),
  KEY `IDX_4CF2669A2A1393C5` (`id_module`),
  CONSTRAINT `FK_4CF2669A2A1393C5` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controller`
--

LOCK TABLES `controller` WRITE;
/*!40000 ALTER TABLE `controller` DISABLE KEYS */;
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
  `data_custo` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_custo`),
  KEY `fk_custo_2` (`id_tipo_custo`),
  KEY `fk_custo_1` (`id_status_custo`),
  CONSTRAINT `fk_custo_1` FOREIGN KEY (`id_status_custo`) REFERENCES `status_custo` (`id_status_custo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_custo_2` FOREIGN KEY (`id_tipo_custo`) REFERENCES `tipo_custo` (`id_tipo_custo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custo`
--

LOCK TABLES `custo` WRITE;
/*!40000 ALTER TABLE `custo` DISABLE KEYS */;
INSERT INTO `custo` VALUES (1,3,5,-635.34,'2014-12-08 15:30:48','2014-11-27 13:17:09','2014-11-27 15:30:48'),(2,3,6,-60.00,'2014-12-19 15:31:02','2014-11-27 13:38:52','2014-11-27 15:31:02'),(3,3,11,-103.70,'2014-12-20 13:40:36','2014-11-27 13:40:36',NULL),(4,6,12,-35.00,'2014-11-25 13:41:38','2014-11-27 13:41:38',NULL),(5,3,12,-35.00,'2014-12-25 13:58:23','2014-11-27 13:58:23',NULL),(6,6,13,-255.00,'2014-11-25 14:00:51','2014-11-27 14:00:51',NULL),(7,3,13,-85.00,'2014-12-25 14:01:19','2014-11-27 14:01:19',NULL),(8,3,14,-600.00,'2014-01-15 14:18:22','2014-11-27 14:18:22',NULL),(9,3,15,-314.82,'2014-12-25 14:18:59','2014-11-27 14:18:59',NULL),(10,3,15,-314.82,'2015-01-25 00:46:25','2014-11-27 14:19:30','2014-11-28 00:46:25'),(11,3,15,-314.82,'2015-02-25 01:34:46','2014-11-27 14:19:53','2014-11-28 01:34:46'),(12,3,15,-314.82,'2015-03-25 01:34:59','2014-11-27 14:24:36','2014-11-28 01:34:59'),(13,3,15,-314.82,'2015-04-25 01:35:12','2014-11-27 14:25:08','2014-11-28 01:35:12'),(14,3,16,-5010.96,'2015-06-01 14:27:45','2014-11-27 14:27:45',NULL),(15,6,8,-2.70,'2014-11-27 15:22:18','2014-11-27 15:22:18',NULL),(17,6,8,-0.70,'2014-11-27 17:19:15','2014-11-27 17:19:01','2014-11-27 17:19:15'),(18,6,8,-1.40,'2014-11-27 20:59:00','2014-11-27 20:58:46','2014-11-27 20:59:00'),(19,5,17,-5.54,'2014-11-27 01:35:35','2014-11-28 00:46:08','2014-11-28 01:35:35'),(20,5,18,-2.78,'2014-11-27 01:36:12','2014-11-28 01:36:12',NULL),(21,5,19,-7.18,'2014-11-27 01:36:39','2014-11-28 01:36:39',NULL),(22,5,8,-7.50,'2014-11-27 01:37:50','2014-11-28 01:37:50',NULL),(23,6,8,-3.40,'2014-11-28 16:37:06','2014-11-28 16:33:50','2014-11-28 16:37:06'),(24,6,21,-5.00,'2014-11-28 16:36:43','2014-11-28 16:36:43',NULL);
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
  PRIMARY KEY (`id_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
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
  PRIMARY KEY (`id_grupo_custo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_custo`
--

LOCK TABLES `grupo_custo` WRITE;
/*!40000 ALTER TABLE `grupo_custo` DISABLE KEYS */;
INSERT INTO `grupo_custo` VALUES (1,'Alimentação','2014-11-26 19:26:39',NULL),(3,'Higiene','2014-11-26 19:27:41',NULL),(4,'Transporte','2014-11-26 19:27:49',NULL),(5,'Moradia','2014-11-26 19:28:00',NULL),(6,'Empréstimos','2014-11-26 19:28:12',NULL),(7,'Comunicação','2014-11-27 13:39:18',NULL),(8,'Entretenimento','2014-11-27 13:59:41',NULL);
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
  PRIMARY KEY (`id_module`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preco_tipo_servico`
--

DROP TABLE IF EXISTS `preco_tipo_servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preco_tipo_servico` (
  `id_preco_tipo_servico` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_servico` int(11) DEFAULT NULL,
  `preco_hora` decimal(10,2) NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_final` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_preco_tipo_servico`),
  KEY `fk_preco_tipo_servico_1` (`id_tipo_servico`),
  CONSTRAINT `fk_preco_tipo_servico_1` FOREIGN KEY (`id_tipo_servico`) REFERENCES `tipo_servico` (`id_tipo_servico`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preco_tipo_servico`
--

LOCK TABLES `preco_tipo_servico` WRITE;
/*!40000 ALTER TABLE `preco_tipo_servico` DISABLE KEYS */;
INSERT INTO `preco_tipo_servico` VALUES (1,1,43610.00,'2014-11-26 16:11:22','2015-01-01 16:11:22','2014-11-24 21:52:31','2014-11-26 16:11:22');
/*!40000 ALTER TABLE `preco_tipo_servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_parent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_role`),
  KEY `IDX_57698A6A1BB9D5A2` (`id_parent`),
  CONSTRAINT `FK_57698A6A1BB9D5A2` FOREIGN KEY (`id_parent`) REFERENCES `role` (`id_role`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `id_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_controller` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rule`),
  KEY `IDX_46D8ACCC61FB397F` (`id_action`),
  KEY `IDX_46D8ACCCDC499668` (`id_role`),
  KEY `IDX_46D8ACCCE978E64D` (`id_controller`),
  CONSTRAINT `FK_46D8ACCC61FB397F` FOREIGN KEY (`id_action`) REFERENCES `action` (`id_action`) ON DELETE CASCADE,
  CONSTRAINT `FK_46D8ACCCDC499668` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE,
  CONSTRAINT `FK_46D8ACCCE978E64D` FOREIGN KEY (`id_controller`) REFERENCES `controller` (`id_controller`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rule`
--

LOCK TABLES `rule` WRITE;
/*!40000 ALTER TABLE `rule` DISABLE KEYS */;
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
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_status_custo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_custo`
--

LOCK TABLES `status_custo` WRITE;
/*!40000 ALTER TABLE `status_custo` DISABLE KEYS */;
INSERT INTO `status_custo` VALUES (3,'Gasto Futuro Programado','2014-11-26 19:37:56','2014-11-26 19:38:19'),(4,'Faturado','2014-11-26 19:38:33','2014-11-27 13:25:28'),(5,'Faturar no cartão de crédito','2014-11-27 13:24:56',NULL),(6,'Pagamento Atrasado','2014-11-27 13:41:11',NULL);
/*!40000 ALTER TABLE `status_custo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_custo`
--

DROP TABLE IF EXISTS `tipo_custo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_custo` (
  `id_tipo_custo` int(11) NOT NULL AUTO_INCREMENT,
  `id_gropo_custo` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tipo_custo`),
  KEY `fk_tipo_custo_1` (`id_gropo_custo`),
  CONSTRAINT `fk_tipo_custo_1` FOREIGN KEY (`id_gropo_custo`) REFERENCES `grupo_custo` (`id_grupo_custo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_custo`
--

LOCK TABLES `tipo_custo` WRITE;
/*!40000 ALTER TABLE `tipo_custo` DISABLE KEYS */;
INSERT INTO `tipo_custo` VALUES (1,3,'Escovas de Dente','2014-11-26 19:32:21',NULL),(2,3,'Creme de Barbear','2014-11-26 19:32:38',NULL),(3,4,'Passagem de Ônibus','2014-11-26 19:32:55',NULL),(4,4,'Corrida de Taxi','2014-11-26 19:33:08',NULL),(5,5,'Aluguel','2014-11-26 19:33:19',NULL),(6,5,'Luz Elétrica','2014-11-26 19:33:38',NULL),(7,1,'Água Mineral','2014-11-26 19:34:13',NULL),(8,1,'Café','2014-11-26 19:34:25',NULL),(9,1,'Polenta (Polentina)','2014-11-26 19:34:42',NULL),(10,1,'Bananas','2014-11-26 19:34:55',NULL),(11,7,'Internet GVT','2014-11-27 13:39:34',NULL),(12,7,'Celular Claro','2014-11-27 13:39:49',NULL),(13,8,'Sócio Internacional','2014-11-27 13:59:59',NULL),(14,6,'Banco Kayser','2014-11-27 14:03:12',NULL),(15,6,'Banco Brasil','2014-11-27 14:03:26',NULL),(16,6,'Banco Piber','2014-11-27 14:04:13',NULL),(17,1,'Queijo Mussarela','2014-11-28 00:44:34',NULL),(18,1,'Cacetinhos','2014-11-28 00:44:57',NULL),(19,1,'Atum','2014-11-28 00:45:11',NULL),(20,3,'Papel Higiênico','2014-11-28 00:45:34',NULL),(21,8,'Festas','2014-11-28 16:36:14',NULL);
/*!40000 ALTER TABLE `tipo_custo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_servico`
--

DROP TABLE IF EXISTS `tipo_servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_servico` (
  `id_tipo_servico` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tipo_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_servico`
--

LOCK TABLES `tipo_servico` WRITE;
/*!40000 ALTER TABLE `tipo_servico` DISABLE KEYS */;
INSERT INTO `tipo_servico` VALUES (1,'Desenvolvimento de Sistemas','<p>Desenvolver sistemas escritos em PHP</p>','2014-11-24 21:42:39',NULL),(2,'Consultoria PHP','<p>Vamos a sua empresa ver o que est&aacute; contecendo de errado</p>','2014-11-26 14:36:15',NULL);
/*!40000 ALTER TABLE `tipo_servico` ENABLE KEYS */;
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
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
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
  `id_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`,`id_role`),
  KEY `IDX_611178996B3CA4B` (`id_user`),
  KEY `IDX_61117899DC499668` (`id_role`),
  CONSTRAINT `FK_611178996B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `FK_61117899DC499668` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role_linker`
--

LOCK TABLES `user_role_linker` WRITE;
/*!40000 ALTER TABLE `user_role_linker` DISABLE KEYS */;
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

-- Dump completed on 2014-11-28 17:09:44
