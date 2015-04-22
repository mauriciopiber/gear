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
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

LOCK TABLES `action` WRITE;
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` VALUES (1,1,'AutoincrementDatabase','2015-04-22 00:38:02',2,NULL,NULL),(2,1,'DropTable','2015-04-22 00:38:02',2,NULL,NULL),(3,1,'GetOrder','2015-04-22 00:38:02',2,NULL,NULL),(4,1,'AnalyseDatabase','2015-04-22 00:38:02',2,NULL,NULL),(5,1,'AnalyseTable','2015-04-22 00:38:02',2,NULL,NULL),(6,1,'AutoincrementTable','2015-04-22 00:38:02',2,NULL,NULL),(7,1,'ClearTable','2015-04-22 00:38:02',2,NULL,NULL),(8,1,'CreateColumn','2015-04-22 00:38:02',2,NULL,NULL),(9,1,'FixDatabase','2015-04-22 00:38:02',2,NULL,NULL),(10,1,'FixTable','2015-04-22 00:38:02',2,NULL,NULL),(11,1,'MysqlLoad','2015-04-22 00:38:03',2,NULL,NULL),(12,1,'MysqlDump','2015-04-22 00:38:03',2,NULL,NULL),(13,1,'Fixture','2015-04-22 00:38:03',2,NULL,NULL),(14,2,'Build','2015-04-22 00:38:03',2,NULL,NULL),(15,3,'Action','2015-04-22 00:38:03',2,NULL,NULL),(16,3,'Controller','2015-04-22 00:38:03',2,NULL,NULL),(17,3,'Db','2015-04-22 00:38:03',2,NULL,NULL),(18,3,'Src','2015-04-22 00:38:03',2,NULL,NULL),(19,3,'Test','2015-04-22 00:38:03',2,NULL,NULL),(20,3,'View','2015-04-22 00:38:03',2,NULL,NULL),(21,4,'Entities','2015-04-22 00:38:03',2,NULL,NULL),(22,4,'Entity','2015-04-22 00:38:03',2,NULL,NULL),(23,4,'Dump','2015-04-22 00:38:03',2,NULL,NULL),(24,4,'Create','2015-04-22 00:38:03',2,NULL,NULL),(25,4,'Delete','2015-04-22 00:38:03',2,NULL,NULL),(26,4,'Load','2015-04-22 00:38:03',2,NULL,NULL),(27,4,'Unload','2015-04-22 00:38:03',2,NULL,NULL),(28,4,'Build','2015-04-22 00:38:03',2,NULL,NULL),(29,4,'Push','2015-04-22 00:38:03',2,NULL,NULL),(30,4,'Light','2015-04-22 00:38:03',2,NULL,NULL),(31,4,'Jenkins','2015-04-22 00:38:03',2,NULL,NULL),(32,4,'DumpAutoload','2015-04-22 00:38:03',2,NULL,NULL),(33,5,'Deploy','2015-04-22 00:38:03',2,NULL,NULL),(34,5,'Push','2015-04-22 00:38:03',2,NULL,NULL),(35,5,'Build','2015-04-22 00:38:03',2,NULL,NULL),(36,5,'Mysql2sqlite','2015-04-22 00:38:03',2,NULL,NULL),(37,5,'ResetAcl','2015-04-22 00:38:04',2,NULL,NULL),(38,5,'Acl','2015-04-22 00:38:04',2,NULL,NULL),(39,5,'Config','2015-04-22 00:38:04',2,NULL,NULL),(40,5,'Dump','2015-04-22 00:38:04',2,NULL,NULL),(41,5,'Environment','2015-04-22 00:38:04',2,NULL,NULL),(42,5,'Global','2015-04-22 00:38:04',2,NULL,NULL),(43,5,'Local','2015-04-22 00:38:04',2,NULL,NULL),(44,5,'Mysql','2015-04-22 00:38:04',2,NULL,NULL),(45,5,'Project','2015-04-22 00:38:04',2,NULL,NULL),(46,5,'Sqlite','2015-04-22 00:38:04',2,NULL,NULL),(47,5,'Fixture','2015-04-22 00:38:04',2,NULL,NULL),(48,5,'Jenkins','2015-04-22 00:38:04',2,NULL,NULL),(49,6,'Acl','2015-04-22 00:38:04',2,NULL,NULL),(50,6,'ResetAcl','2015-04-22 00:38:04',2,NULL,NULL),(51,7,'ModuleVersion','2015-04-22 00:38:04',2,NULL,NULL),(52,7,'ProjectVersion','2015-04-22 00:38:04',2,NULL,NULL),(53,8,'Index','2015-04-22 00:38:04',2,NULL,NULL),(54,9,'Index','2015-04-22 00:38:05',2,NULL,NULL),(55,10,'Login','2015-04-22 00:38:05',2,NULL,NULL),(56,10,'SendPasswordRecoveryRequest','2015-04-22 00:38:05',2,NULL,NULL),(57,10,'PasswordRecoveryRequestSent','2015-04-22 00:38:05',2,NULL,NULL),(58,10,'PasswordRecovery','2015-04-22 00:38:05',2,NULL,NULL),(59,10,'PasswordRecoverySuccessful','2015-04-22 00:38:05',2,NULL,NULL),(60,10,'Index','2015-04-22 00:38:05',2,NULL,NULL),(61,10,'ChangePassword','2015-04-22 00:38:05',2,NULL,NULL),(62,10,'ChangePasswordSuccessful','2015-04-22 00:38:05',2,NULL,NULL),(63,10,'Logout','2015-04-22 00:38:05',2,NULL,NULL),(64,10,'InvalidLink','2015-04-22 00:38:05',2,NULL,NULL),(65,11,'Register','2015-04-22 00:38:06',2,NULL,NULL),(66,11,'Acl','2015-04-22 00:38:06',2,NULL,NULL),(67,12,'Index','2015-04-22 00:38:06',2,NULL,NULL),(68,13,'ListarImagem','2015-04-22 00:38:06',2,NULL,NULL),(69,13,'ExcluirImagem','2015-04-22 00:38:06',2,NULL,NULL),(70,13,'SalvarImagem','2015-04-22 00:38:06',2,NULL,NULL),(71,14,'Create','2015-04-22 00:38:06',2,NULL,NULL),(72,14,'Edit','2015-04-22 00:38:06',2,NULL,NULL),(73,14,'List','2015-04-22 00:38:06',2,NULL,NULL),(74,14,'Delete','2015-04-22 00:38:06',2,NULL,NULL),(75,14,'View','2015-04-22 00:38:06',2,NULL,NULL),(76,15,'Index','2015-04-22 00:38:07',2,NULL,NULL),(77,16,'Create','2015-04-22 00:38:07',2,NULL,NULL),(78,16,'Edit','2015-04-22 00:38:07',2,NULL,NULL),(79,16,'List','2015-04-22 00:38:07',2,NULL,NULL),(80,16,'Delete','2015-04-22 00:38:07',2,NULL,NULL),(81,16,'View','2015-04-22 00:38:07',2,NULL,NULL),(82,17,'Index','2015-04-22 00:38:07',2,NULL,NULL),(83,18,'Create','2015-04-22 00:38:07',2,NULL,NULL),(84,18,'Edit','2015-04-22 00:38:07',2,NULL,NULL),(85,18,'List','2015-04-22 00:38:07',2,NULL,NULL),(86,18,'Delete','2015-04-22 00:38:08',2,NULL,NULL),(87,18,'View','2015-04-22 00:38:08',2,NULL,NULL),(88,19,'Create','2015-04-22 00:38:08',2,NULL,NULL),(89,19,'Edit','2015-04-22 00:38:08',2,NULL,NULL),(90,19,'List','2015-04-22 00:38:08',2,NULL,NULL),(91,19,'Delete','2015-04-22 00:38:08',2,NULL,NULL),(92,19,'View','2015-04-22 00:38:08',2,NULL,NULL);
/*!40000 ALTER TABLE `action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `columns`
--

DROP TABLE IF EXISTS `columns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `columns` (
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
  KEY `fk_columns_1` (`column_foreign_key`),
  CONSTRAINT `columns_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `columns_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_columns_1` FOREIGN KEY (`column_foreign_key`) REFERENCES `foreign_keys` (`id_foreign_keys`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `columns`
--

LOCK TABLES `columns` WRITE;
/*!40000 ALTER TABLE `columns` DISABLE KEYS */;
INSERT INTO `columns` VALUES (1,'2020-12-01','2020-12-01 01:00:02','01:00:02',1,1,1.10,'01Column Varchar','01Column Longtext','01Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-01 01:00:02','2020-12-01',1.10,1,1,'column.varchar.email01@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851928f8.39660677','01Column Varchar Upload Image',1),(2,'2020-12-02','2020-12-02 02:00:02','02:00:02',2,2,2.20,'02Column Varchar','02Column Longtext','02Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-02 02:00:02','2020-12-02',2.20,0,0,'column.varchar.email02@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','15537178519c0e1.66490783','02Column Varchar Upload Image',2),(3,'2020-12-03','2020-12-03 03:00:02','03:00:02',3,3,3.30,'03Column Varchar','03Column Longtext','03Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-03 03:00:02','2020-12-03',3.30,1,1,'column.varchar.email03@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851a29b0.37691595','03Column Varchar Upload Image',3),(4,'2020-12-04','2020-12-04 04:00:02','04:00:02',4,4,4.40,'04Column Varchar','04Column Longtext','04Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-04 04:00:02','2020-12-04',4.40,0,0,'column.varchar.email04@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851a9153.52095899','04Column Varchar Upload Image',4),(5,'2020-12-05','2020-12-05 05:00:02','05:00:02',5,5,5.50,'05Column Varchar','05Column Longtext','05Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-05 05:00:02','2020-12-05',5.50,1,1,'column.varchar.email05@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851af161.22998816','05Column Varchar Upload Image',5),(6,'2020-12-06','2020-12-06 06:00:02','06:00:02',6,6,6.60,'06Column Varchar','06Column Longtext','06Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-06 06:00:02','2020-12-06',6.60,0,0,'column.varchar.email06@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851b58d0.58772665','06Column Varchar Upload Image',6),(7,'2020-12-07','2020-12-07 07:00:02','07:00:02',7,7,7.70,'07Column Varchar','07Column Longtext','07Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-07 07:00:02','2020-12-07',7.70,1,1,'column.varchar.email07@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851bb6a9.56638457','07Column Varchar Upload Image',7),(8,'2020-12-08','2020-12-08 08:00:02','08:00:02',8,8,8.80,'08Column Varchar','08Column Longtext','08Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-08 08:00:02','2020-12-08',8.80,0,0,'column.varchar.email08@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851c1139.17784916','08Column Varchar Upload Image',8),(9,'2020-12-09','2020-12-09 09:00:02','09:00:02',9,9,9.90,'09Column Varchar','09Column Longtext','09Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-09 09:00:02','2020-12-09',9.90,1,1,'column.varchar.email09@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851c6ca2.01053943','09Column Varchar Upload Image',9),(10,'2020-12-10','2020-12-10 10:00:02','10:00:02',10,10,10.10,'10Column Varchar','10Column Longtext','10Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-10 10:00:02','2020-12-10',10.10,0,0,'column.varchar.email10@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851cf7b4.17893382','10Column Varchar Upload Image',10),(11,'2020-12-11','2020-12-11 11:00:02','11:00:02',11,11,11.11,'11Column Varchar','11Column Longtext','11Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-11 11:00:02','2020-12-11',11.11,1,1,'column.varchar.email11@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851d5d67.34023009','11Column Varchar Upload Image',11),(12,'2020-12-12','2020-12-12 12:00:02','12:00:02',12,12,12.12,'12Column Varchar','12Column Longtext','12Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-12 12:00:02','2020-12-12',12.12,0,0,'column.varchar.email12@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851dbf56.28334320','12Column Varchar Upload Image',12),(13,'2020-12-13','2020-12-13 13:00:02','13:00:02',13,13,13.13,'13Column Varchar','13Column Longtext','13Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-13 13:00:02','2020-12-13',13.13,1,1,'column.varchar.email13@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851e1a44.05989145','13Column Varchar Upload Image',13),(14,'2020-12-14','2020-12-14 14:00:02','14:00:02',14,14,14.14,'14Column Varchar','14Column Longtext','14Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-14 14:00:02','2020-12-14',14.14,0,0,'column.varchar.email14@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851e76f2.24281292','14Column Varchar Upload Image',14),(15,'2020-12-15','2020-12-15 15:00:02','15:00:02',15,15,15.15,'15Column Varchar','15Column Longtext','15Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-15 15:00:02','2020-12-15',15.15,1,1,'column.varchar.email15@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851ed457.17074323','15Column Varchar Upload Image',15),(16,'2020-12-16','2020-12-16 16:00:02','16:00:02',16,16,16.16,'16Column Varchar','16Column Longtext','16Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-16 16:00:02','2020-12-16',16.16,0,0,'column.varchar.email16@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851f32e0.30306140','16Column Varchar Upload Image',16),(17,'2020-12-17','2020-12-17 17:00:02','17:00:02',17,17,17.17,'17Column Varchar','17Column Longtext','17Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-17 17:00:02','2020-12-17',17.17,1,1,'column.varchar.email17@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851f9186.36311786','17Column Varchar Upload Image',17),(18,'2020-12-18','2020-12-18 18:00:02','18:00:02',18,18,18.18,'18Column Varchar','18Column Longtext','18Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-18 18:00:02','2020-12-18',18.18,0,0,'column.varchar.email18@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717851ff3e7.41115435','18Column Varchar Upload Image',18),(19,'2020-12-19','2020-12-19 19:00:02','19:00:02',19,19,19.19,'19Column Varchar','19Column Longtext','19Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-19 19:00:02','2020-12-19',19.19,1,1,'column.varchar.email19@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','155371785209129.03884083','19Column Varchar Upload Image',19),(20,'2020-12-20','2020-12-20 20:00:02','20:00:02',20,20,20.20,'20Column Varchar','20Column Longtext','20Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-20 20:00:02','2020-12-20',20.20,0,0,'column.varchar.email20@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','15537178520fa54.52114685','20Column Varchar Upload Image',20),(21,'2020-12-21','2020-12-21 21:00:02','21:00:02',21,21,21.21,'21Column Varchar','21Column Longtext','21Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-21 21:00:02','2020-12-21',21.21,1,1,'column.varchar.email21@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','155371785215989.03808550','21Column Varchar Upload Image',21),(22,'2020-12-22','2020-12-22 22:00:02','22:00:02',22,22,22.22,'22Column Varchar','22Column Longtext','22Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-22 22:00:02','2020-12-22',22.22,0,0,'column.varchar.email22@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','15537178521b846.87097170','22Column Varchar Upload Image',22),(23,'2020-12-23','2020-12-23 23:00:02','23:00:02',23,23,23.23,'23Column Varchar','23Column Longtext','23Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-23 23:00:02','2020-12-23',23.23,1,1,'column.varchar.email23@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717852216d7.12045011','23Column Varchar Upload Image',23),(24,'2020-12-24','2020-12-24 06:00:02','06:00:02',24,24,24.24,'24Column Varchar','24Column Longtext','24Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-24 06:00:02','2020-12-24',24.24,0,0,'column.varchar.email24@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','155371785228328.90994574','24Column Varchar Upload Image',24),(25,'2020-12-25','2020-12-25 05:00:02','05:00:02',25,25,25.25,'25Column Varchar','25Column Longtext','25Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-25 05:00:02','2020-12-25',25.25,1,1,'column.varchar.email25@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','15537178522e424.02560625','25Column Varchar Upload Image',25),(26,'2020-12-26','2020-12-26 04:00:02','04:00:02',26,26,26.26,'26Column Varchar','26Column Longtext','26Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-26 04:00:02','2020-12-26',26.26,0,0,'column.varchar.email26@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','155371785234c90.37608191','26Column Varchar Upload Image',26),(27,'2020-12-27','2020-12-27 03:00:02','03:00:02',27,27,27.27,'27Column Varchar','27Column Longtext','27Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-27 03:00:02','2020-12-27',27.27,1,1,'column.varchar.email27@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','15537178523a965.03463593','27Column Varchar Upload Image',27),(28,'2020-12-28','2020-12-28 02:00:02','02:00:02',28,28,28.28,'28Column Varchar','28Column Longtext','28Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-28 02:00:02','2020-12-28',28.28,0,0,'column.varchar.email28@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','155371785240ff1.96188954','28Column Varchar Upload Image',28),(29,'2020-12-29','2020-12-29 01:00:02','01:00:02',29,29,29.29,'29Column Varchar','29Column Longtext','29Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-29 01:00:02','2020-12-29',29.29,1,1,'column.varchar.email29@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','155371785246bc8.87751314','29Column Varchar Upload Image',29),(30,'2020-12-30','2020-12-30 00:00:02','00:00:02',30,30,30.30,'30Column Varchar','30Column Longtext','30Column Text','2015-04-22 00:38:01',NULL,2,NULL,'2020-12-30 00:00:02','2020-12-30',30.30,0,0,'column.varchar.email30@gmail.com','$2y$14$fsnuvWLBU4JH1ygNyGQAn.r2FvXNKD/RwcDj0Zcpmoj5CW6.RfLHG','1553717852540f3.81252028','30Column Varchar Upload Image',30);
/*!40000 ALTER TABLE `columns` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controller`
--

LOCK TABLES `controller` WRITE;
/*!40000 ALTER TABLE `controller` DISABLE KEYS */;
INSERT INTO `controller` VALUES (1,1,'Db','Gear\\Controller\\Db','2015-04-22 00:38:02',2,NULL,NULL),(2,1,'Build','Gear\\Controller\\Build','2015-04-22 00:38:03',2,NULL,NULL),(3,1,'Constructor','Gear\\Controller\\Constructor','2015-04-22 00:38:03',2,NULL,NULL),(4,1,'Module','Gear\\Controller\\Module','2015-04-22 00:38:03',2,NULL,NULL),(5,1,'Project','Gear\\Controller\\Project','2015-04-22 00:38:03',2,NULL,NULL),(6,2,'ProjectController','GearAcl\\Controller\\Project','2015-04-22 00:38:04',2,NULL,NULL),(7,3,'VersionController','GearVersion\\Controller\\Version','2015-04-22 00:38:04',2,NULL,NULL),(8,4,'IndexController','GearJson\\Controller\\Index','2015-04-22 00:38:04',2,NULL,NULL),(9,5,'IndexController','GearBackup\\Controller\\Index','2015-04-22 00:38:05',2,NULL,NULL),(10,6,'Index','Security\\Controller\\Index','2015-04-22 00:38:05',2,NULL,NULL),(11,6,'User','Security\\Controller\\User','2015-04-22 00:38:06',2,NULL,NULL),(12,7,'Index','ImagemUpload\\Controller\\Index','2015-04-22 00:38:06',2,NULL,NULL),(13,7,'Imagem','ImagemUpload\\Controller\\Imagem','2015-04-22 00:38:06',2,NULL,NULL),(14,7,'MarcaController','ImagemUpload\\Controller\\Marca','2015-04-22 00:38:06',2,NULL,NULL),(15,8,'IndexController','TestUpload\\Controller\\Index','2015-04-22 00:38:07',2,NULL,NULL),(16,8,'TestUploadImageController','TestUpload\\Controller\\TestUploadImage','2015-04-22 00:38:07',2,NULL,NULL),(17,9,'IndexController','Column\\Controller\\Index','2015-04-22 00:38:07',2,NULL,NULL),(18,9,'ColumnsController','Column\\Controller\\Columns','2015-04-22 00:38:07',2,NULL,NULL),(19,9,'ForeignKeysController','Column\\Controller\\ForeignKeys','2015-04-22 00:38:08',2,NULL,NULL);
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
-- Table structure for table `foreign_keys`
--

DROP TABLE IF EXISTS `foreign_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foreign_keys` (
  `id_foreign_keys` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_foreign_keys`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `foreign_keys_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `foreign_keys_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foreign_keys`
--

LOCK TABLES `foreign_keys` WRITE;
/*!40000 ALTER TABLE `foreign_keys` DISABLE KEYS */;
INSERT INTO `foreign_keys` VALUES (1,'01Name','2015-04-22 00:38:01',NULL,2,NULL),(2,'02Name','2015-04-22 00:38:01',NULL,2,NULL),(3,'03Name','2015-04-22 00:38:01',NULL,2,NULL),(4,'04Name','2015-04-22 00:38:01',NULL,2,NULL),(5,'05Name','2015-04-22 00:38:01',NULL,2,NULL),(6,'06Name','2015-04-22 00:38:01',NULL,2,NULL),(7,'07Name','2015-04-22 00:38:01',NULL,2,NULL),(8,'08Name','2015-04-22 00:38:01',NULL,2,NULL),(9,'09Name','2015-04-22 00:38:01',NULL,2,NULL),(10,'10Name','2015-04-22 00:38:01',NULL,2,NULL),(11,'11Name','2015-04-22 00:38:01',NULL,2,NULL),(12,'12Name','2015-04-22 00:38:01',NULL,2,NULL),(13,'13Name','2015-04-22 00:38:01',NULL,2,NULL),(14,'14Name','2015-04-22 00:38:01',NULL,2,NULL),(15,'15Name','2015-04-22 00:38:01',NULL,2,NULL),(16,'16Name','2015-04-22 00:38:01',NULL,2,NULL),(17,'17Name','2015-04-22 00:38:01',NULL,2,NULL),(18,'18Name','2015-04-22 00:38:01',NULL,2,NULL),(19,'19Name','2015-04-22 00:38:01',NULL,2,NULL),(20,'20Name','2015-04-22 00:38:01',NULL,2,NULL),(21,'21Name','2015-04-22 00:38:01',NULL,2,NULL),(22,'22Name','2015-04-22 00:38:01',NULL,2,NULL),(23,'23Name','2015-04-22 00:38:01',NULL,2,NULL),(24,'24Name','2015-04-22 00:38:01',NULL,2,NULL),(25,'25Name','2015-04-22 00:38:01',NULL,2,NULL),(26,'26Name','2015-04-22 00:38:01',NULL,2,NULL),(27,'27Name','2015-04-22 00:38:01',NULL,2,NULL),(28,'28Name','2015-04-22 00:38:01',NULL,2,NULL),(29,'29Name','2015-04-22 00:38:01',NULL,2,NULL),(30,'30Name','2015-04-22 00:38:01',NULL,2,NULL);
/*!40000 ALTER TABLE `foreign_keys` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (1,'Gear','2015-04-22 00:38:02',2,NULL,NULL),(2,'GearAcl','2015-04-22 00:38:04',2,NULL,NULL),(3,'GearVersion','2015-04-22 00:38:04',2,NULL,NULL),(4,'GearJson','2015-04-22 00:38:04',2,NULL,NULL),(5,'GearBackup','2015-04-22 00:38:05',2,NULL,NULL),(6,'Security','2015-04-22 00:38:05',2,NULL,NULL),(7,'ImagemUpload','2015-04-22 00:38:06',2,NULL,NULL),(8,'TestUpload','2015-04-22 00:38:07',2,NULL,NULL),(9,'Column','2015-04-22 00:38:07',2,NULL,NULL);
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
INSERT INTO `role` VALUES (1,NULL,'guest','2015-04-22 00:38:01',2,NULL,NULL),(2,1,'admin','2015-04-22 00:38:01',2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rule`
--

LOCK TABLES `rule` WRITE;
/*!40000 ALTER TABLE `rule` DISABLE KEYS */;
INSERT INTO `rule` VALUES (1,1,1,1,'2015-04-22 00:38:02',2,NULL,NULL),(2,2,1,1,'2015-04-22 00:38:02',2,NULL,NULL),(3,3,1,1,'2015-04-22 00:38:02',2,NULL,NULL),(4,4,1,1,'2015-04-22 00:38:02',2,NULL,NULL),(5,5,1,1,'2015-04-22 00:38:02',2,NULL,NULL),(6,6,1,1,'2015-04-22 00:38:02',2,NULL,NULL),(7,7,1,1,'2015-04-22 00:38:02',2,NULL,NULL),(8,8,1,1,'2015-04-22 00:38:02',2,NULL,NULL),(9,9,1,1,'2015-04-22 00:38:02',2,NULL,NULL),(10,10,1,1,'2015-04-22 00:38:02',2,NULL,NULL),(11,11,1,1,'2015-04-22 00:38:03',2,NULL,NULL),(12,12,1,1,'2015-04-22 00:38:03',2,NULL,NULL),(13,13,1,1,'2015-04-22 00:38:03',2,NULL,NULL),(14,14,2,1,'2015-04-22 00:38:03',2,NULL,NULL),(15,15,3,1,'2015-04-22 00:38:03',2,NULL,NULL),(16,16,3,1,'2015-04-22 00:38:03',2,NULL,NULL),(17,17,3,1,'2015-04-22 00:38:03',2,NULL,NULL),(18,18,3,1,'2015-04-22 00:38:03',2,NULL,NULL),(19,19,3,1,'2015-04-22 00:38:03',2,NULL,NULL),(20,20,3,1,'2015-04-22 00:38:03',2,NULL,NULL),(21,21,4,1,'2015-04-22 00:38:03',2,NULL,NULL),(22,22,4,1,'2015-04-22 00:38:03',2,NULL,NULL),(23,23,4,1,'2015-04-22 00:38:03',2,NULL,NULL),(24,24,4,1,'2015-04-22 00:38:03',2,NULL,NULL),(25,25,4,1,'2015-04-22 00:38:03',2,NULL,NULL),(26,26,4,1,'2015-04-22 00:38:03',2,NULL,NULL),(27,27,4,1,'2015-04-22 00:38:03',2,NULL,NULL),(28,28,4,1,'2015-04-22 00:38:03',2,NULL,NULL),(29,29,4,1,'2015-04-22 00:38:03',2,NULL,NULL),(30,30,4,1,'2015-04-22 00:38:03',2,NULL,NULL),(31,31,4,1,'2015-04-22 00:38:03',2,NULL,NULL),(32,32,4,1,'2015-04-22 00:38:03',2,NULL,NULL),(33,33,5,1,'2015-04-22 00:38:03',2,NULL,NULL),(34,34,5,1,'2015-04-22 00:38:03',2,NULL,NULL),(35,35,5,1,'2015-04-22 00:38:03',2,NULL,NULL),(36,36,5,1,'2015-04-22 00:38:03',2,NULL,NULL),(37,37,5,1,'2015-04-22 00:38:04',2,NULL,NULL),(38,38,5,1,'2015-04-22 00:38:04',2,NULL,NULL),(39,39,5,1,'2015-04-22 00:38:04',2,NULL,NULL),(40,40,5,1,'2015-04-22 00:38:04',2,NULL,NULL),(41,41,5,1,'2015-04-22 00:38:04',2,NULL,NULL),(42,42,5,1,'2015-04-22 00:38:04',2,NULL,NULL),(43,43,5,1,'2015-04-22 00:38:04',2,NULL,NULL),(44,44,5,1,'2015-04-22 00:38:04',2,NULL,NULL),(45,45,5,1,'2015-04-22 00:38:04',2,NULL,NULL),(46,46,5,1,'2015-04-22 00:38:04',2,NULL,NULL),(47,47,5,1,'2015-04-22 00:38:04',2,NULL,NULL),(48,48,5,1,'2015-04-22 00:38:04',2,NULL,NULL),(49,49,6,1,'2015-04-22 00:38:04',2,NULL,NULL),(50,50,6,1,'2015-04-22 00:38:04',2,NULL,NULL),(51,51,7,1,'2015-04-22 00:38:04',2,NULL,NULL),(52,52,7,1,'2015-04-22 00:38:04',2,NULL,NULL),(53,53,8,1,'2015-04-22 00:38:05',2,NULL,NULL),(54,54,9,1,'2015-04-22 00:38:05',2,NULL,NULL),(55,55,10,1,'2015-04-22 00:38:05',2,NULL,NULL),(56,56,10,1,'2015-04-22 00:38:05',2,NULL,NULL),(57,57,10,1,'2015-04-22 00:38:05',2,NULL,NULL),(58,58,10,1,'2015-04-22 00:38:05',2,NULL,NULL),(59,59,10,1,'2015-04-22 00:38:05',2,NULL,NULL),(60,60,10,2,'2015-04-22 00:38:05',2,NULL,NULL),(61,61,10,2,'2015-04-22 00:38:05',2,NULL,NULL),(62,62,10,2,'2015-04-22 00:38:05',2,NULL,NULL),(63,63,10,2,'2015-04-22 00:38:05',2,NULL,NULL),(64,64,10,1,'2015-04-22 00:38:05',2,NULL,NULL),(65,65,11,1,'2015-04-22 00:38:06',2,NULL,NULL),(66,66,11,1,'2015-04-22 00:38:06',2,NULL,NULL),(67,67,12,1,'2015-04-22 00:38:06',2,NULL,NULL),(68,68,13,1,'2015-04-22 00:38:06',2,NULL,NULL),(69,69,13,1,'2015-04-22 00:38:06',2,NULL,NULL),(70,70,13,1,'2015-04-22 00:38:06',2,NULL,NULL),(71,71,14,2,'2015-04-22 00:38:06',2,NULL,NULL),(72,72,14,2,'2015-04-22 00:38:06',2,NULL,NULL),(73,73,14,2,'2015-04-22 00:38:06',2,NULL,NULL),(74,74,14,2,'2015-04-22 00:38:06',2,NULL,NULL),(75,75,14,2,'2015-04-22 00:38:06',2,NULL,NULL),(76,76,15,1,'2015-04-22 00:38:07',2,NULL,NULL),(77,77,16,2,'2015-04-22 00:38:07',2,NULL,NULL),(78,78,16,2,'2015-04-22 00:38:07',2,NULL,NULL),(79,79,16,2,'2015-04-22 00:38:07',2,NULL,NULL),(80,80,16,2,'2015-04-22 00:38:07',2,NULL,NULL),(81,81,16,2,'2015-04-22 00:38:07',2,NULL,NULL),(82,82,17,1,'2015-04-22 00:38:07',2,NULL,NULL),(83,83,18,2,'2015-04-22 00:38:07',2,NULL,NULL),(84,84,18,2,'2015-04-22 00:38:07',2,NULL,NULL),(85,85,18,2,'2015-04-22 00:38:08',2,NULL,NULL),(86,86,18,2,'2015-04-22 00:38:08',2,NULL,NULL),(87,87,18,2,'2015-04-22 00:38:08',2,NULL,NULL),(88,88,19,2,'2015-04-22 00:38:08',2,NULL,NULL),(89,89,19,2,'2015-04-22 00:38:08',2,NULL,NULL),(90,90,19,2,'2015-04-22 00:38:08',2,NULL,NULL),(91,91,19,2,'2015-04-22 00:38:08',2,NULL,NULL),(92,92,19,2,'2015-04-22 00:38:08',2,NULL,NULL);
/*!40000 ALTER TABLE `rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_upload_image`
--

DROP TABLE IF EXISTS `test_upload_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_upload_image` (
  `id_test_upload_image` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created_by` int(1) NOT NULL,
  `updated_by` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_test_upload_image`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `test_upload_image_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `test_upload_image_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_upload_image`
--

LOCK TABLES `test_upload_image` WRITE;
/*!40000 ALTER TABLE `test_upload_image` DISABLE KEYS */;
INSERT INTO `test_upload_image` VALUES (1,'01Image','2015-04-22 00:38:01',NULL,2,NULL),(2,'02Image','2015-04-22 00:38:01',NULL,2,NULL),(3,'03Image','2015-04-22 00:38:01',NULL,2,NULL),(4,'04Image','2015-04-22 00:38:01',NULL,2,NULL),(5,'05Image','2015-04-22 00:38:01',NULL,2,NULL),(6,'06Image','2015-04-22 00:38:01',NULL,2,NULL),(7,'07Image','2015-04-22 00:38:01',NULL,2,NULL),(8,'08Image','2015-04-22 00:38:01',NULL,2,NULL),(9,'09Image','2015-04-22 00:38:01',NULL,2,NULL),(10,'10Image','2015-04-22 00:38:01',NULL,2,NULL),(11,'11Image','2015-04-22 00:38:01',NULL,2,NULL),(12,'12Image','2015-04-22 00:38:01',NULL,2,NULL),(13,'13Image','2015-04-22 00:38:01',NULL,2,NULL),(14,'14Image','2015-04-22 00:38:01',NULL,2,NULL),(15,'15Image','2015-04-22 00:38:01',NULL,2,NULL),(16,'16Image','2015-04-22 00:38:01',NULL,2,NULL),(17,'17Image','2015-04-22 00:38:01',NULL,2,NULL),(18,'18Image','2015-04-22 00:38:01',NULL,2,NULL),(19,'19Image','2015-04-22 00:38:01',NULL,2,NULL),(20,'20Image','2015-04-22 00:38:01',NULL,2,NULL),(21,'21Image','2015-04-22 00:38:01',NULL,2,NULL),(22,'22Image','2015-04-22 00:38:01',NULL,2,NULL),(23,'23Image','2015-04-22 00:38:01',NULL,2,NULL),(24,'24Image','2015-04-22 00:38:01',NULL,2,NULL),(25,'25Image','2015-04-22 00:38:01',NULL,2,NULL),(26,'26Image','2015-04-22 00:38:01',NULL,2,NULL),(27,'27Image','2015-04-22 00:38:01',NULL,2,NULL),(28,'28Image','2015-04-22 00:38:01',NULL,2,NULL),(29,'29Image','2015-04-22 00:38:01',NULL,2,NULL),(30,'30Image','2015-04-22 00:38:01',NULL,2,NULL);
/*!40000 ALTER TABLE `test_upload_image` ENABLE KEYS */;
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
INSERT INTO `user` VALUES (1,'gear@pibernetwork.com','$2y$14$51Au//UmKP3HWKg37MZpEui6htT7ewAnOu5S10VT8wPOjy0gWTCIO','',1,'15537179191db62.14925962','2015-04-22 00:37:53','2015-04-22 00:37:53',1,1,NULL),(2,'usuariogear1@gmail.com','$2y$14$rcFctT8yc3fw.drzlUWRXeuGeWH8FvN/6zCpBQfEun.LP4Jhuuh5m','',1,'155371792da0658.71378927','2015-04-22 00:37:54','2015-04-22 00:37:54',2,2,2),(3,'usuariogear2@gmail.com','$2y$14$iRrhDnqHuy9XYQw3gdKEV.z4znCfo.LChOc8t81sBRljBc/RZ7V2u','',1,'155371794285bc4.18486066','2015-04-22 00:37:56','2015-04-22 00:37:56',3,3,2),(4,'usuariogear3@gmail.com','$2y$14$TMaTJ4w3Aw1b5RrAeYX/d.2xDNPNNtoIkNXv6QTQaJqV75kmWpWN2','',1,'155371795699895.10156880','2015-04-22 00:37:57','2015-04-22 00:37:57',4,4,2),(5,'usuariogear4@gmail.com','$2y$14$Vc35Vebu4Y0qJiZrpoAkGOL1FXYyzgaAut48FYkt5RBoQJUqIbaxS','',1,'155371796b0dda6.82076137','2015-04-22 00:37:58','2015-04-22 00:37:58',5,5,2),(6,'usuariogear5@gmail.com','$2y$14$0lEmOJrybJ/mvEK2jUmOBuQX/U7Vf0tk.vsDf01PbUmh561xoeXsa','',1,'155371798019b83.92873351','2015-04-22 00:38:00','2015-04-22 00:38:00',6,6,2),(7,'usuariogear6@gmail.com','$2y$14$qSldL0hzHTU0bbie7I/Y0e4YWIAJWoT/1rOceQbYQofJJx5gV/SKu','',1,'1553717994ef9f1.39668720','2015-04-22 00:38:01','2015-04-22 00:38:01',7,7,2);
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

-- Dump completed on 2015-04-22  3:38:09
