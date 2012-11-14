-- MySQL dump 10.13  Distrib 5.5.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: polosac
-- ------------------------------------------------------
-- Server version	5.5.24-0ubuntu0.12.04.1

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
-- Table structure for table `t_boarding`
--

DROP TABLE IF EXISTS `t_boarding`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_boarding` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `active` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_name_idx` (`name`),
  UNIQUE KEY `t_boarding_sluggable_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_boarding`
--

LOCK TABLES `t_boarding` WRITE;
/*!40000 ALTER TABLE `t_boarding` DISABLE KEYS */;
INSERT INTO `t_boarding` VALUES (1,'Plaza Norte','1','plaza_norte','2012-11-06 10:13:57','2012-11-06 10:13:57'),(2,'T Junin','1','t_junin','2012-11-06 10:13:57','2012-11-06 10:13:57'),(3,'Huacho','1','huacho','2012-11-06 10:13:57','2012-11-06 10:13:57'),(4,'Sayan','1','sayan','2012-11-06 10:13:57','2012-11-06 10:13:57'),(5,'Churin','1','churin','2012-11-06 10:13:57','2012-11-06 10:13:57'),(6,'Oyon','1','oyon','2012-11-06 10:13:57','2012-11-06 10:13:57'),(7,'C. Central','1','c_central','2012-11-06 10:13:57','2012-11-06 10:13:57'),(8,'C. Sur','1','c_sur','2012-11-06 10:13:57','2012-11-06 10:13:57');
/*!40000 ALTER TABLE `t_boarding` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_bus`
--

DROP TABLE IF EXISTS `t_bus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_bus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) NOT NULL,
  `code` varchar(100) COLLATE utf8_bin NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `phone` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `mining_unit` varchar(100) COLLATE utf8_bin NOT NULL,
  `padron` varchar(100) COLLATE utf8_bin NOT NULL,
  `category_class` varchar(100) COLLATE utf8_bin NOT NULL,
  `brand` varchar(100) COLLATE utf8_bin NOT NULL,
  `model` varchar(100) COLLATE utf8_bin NOT NULL,
  `year_of_manufacture` varchar(100) COLLATE utf8_bin NOT NULL,
  `fuel` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `serial_number` varchar(100) COLLATE utf8_bin NOT NULL,
  `motor_number` varchar(100) COLLATE utf8_bin NOT NULL,
  `qty_seats` varchar(100) COLLATE utf8_bin NOT NULL,
  `body` varchar(100) COLLATE utf8_bin NOT NULL,
  `card_property_number` varchar(100) COLLATE utf8_bin NOT NULL,
  `effective_soat_from` date DEFAULT NULL,
  `effective_soat_to` date DEFAULT NULL,
  `policy_number` varchar(100) COLLATE utf8_bin NOT NULL,
  `effective_policy_from` date DEFAULT NULL,
  `effective_policy_to` date DEFAULT NULL,
  `effective_technical_review_from` date DEFAULT NULL,
  `effective_technical_review_to` date DEFAULT NULL,
  `circulation_card_number` varchar(100) COLLATE utf8_bin NOT NULL,
  `effective_circulation_card_from` date DEFAULT NULL,
  `effective_circulation_card_to` date DEFAULT NULL,
  `vehicle_use` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `active` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `t_bus_sluggable_idx` (`slug`),
  KEY `company_id_idx` (`company_id`),
  CONSTRAINT `t_bus_company_id_t_company_id` FOREIGN KEY (`company_id`) REFERENCES `t_company` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_bus`
--

LOCK TABLES `t_bus` WRITE;
/*!40000 ALTER TABLE `t_bus` DISABLE KEYS */;
INSERT INTO `t_bus` VALUES (1,1,'A4G-967','Bus 2','976332516','ISCAYCRUZ EXTERNO','167','M3 - OMNIBUS','MERCEDES BENZ','OF 1721/59','2010','1','9BM84075BB729577','377989U0890784','44','OMNIBUS INTERURBANO','275421','2012-10-20','2013-10-20','2101-205669','2010-08-26','2013-10-26','2011-10-11','2013-01-01','15P11007698-01','2011-11-30','2012-11-30','1','1','bus_2','2012-11-06 10:13:57','2012-11-08 11:10:23'),(2,1,'A4G-969','Bus 1','989218026','ISCAYCRUZ EXTERNO','169','M3 - OMNIBUS','MERCEDES BENZ','OF 1721/59','2010','1','9BM384075BB730654','377989U0892091','44','OMNIBUS INTERURBANO','275810','2012-10-19','2013-11-19','2101-205669','2010-08-26','2013-10-26','2011-11-11','2013-01-01','15P11007697-01','2011-11-30','2012-11-30','1','1','bus_1_1','2012-11-06 10:13:57','2012-11-08 11:06:03'),(3,1,'A4N-952','Bus 1','989029075','ISCAYCRUZ EXTERNO','152','M3 - OMNIBUS','MERCEDES BENZ','OF 1721/59','2010','1','9BM384075BB730198','377989U0891864','44','OMNIBUS INTERURBANO','329873','2012-11-03','2013-10-03','2101-205669','2010-08-26','2013-10-26','2011-11-18','2013-01-01','15P11007703-01','2011-11-30','2012-11-30','1','1','bus_1','2012-11-06 10:13:57','2012-11-08 11:01:58'),(4,1,'A4G-968','Bus 2','989218026','ISCAYCRUZ EXTERNO','168','M3-OMNIBUS','MERCEDES BENZ','OF 1721/59','2010','1','9BM384075BB731025','377989U0891592','44','OMNIBUS INTERURBANO','275420','2012-10-19','2013-10-19','2101-205669','2010-08-26','2013-10-26','2011-11-11','2013-01-01','15P11007699-01','2011-11-30','2012-11-30','1','1','bus_2_1','2012-11-07 18:37:01','2012-11-08 11:08:12');
/*!40000 ALTER TABLE `t_bus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_bus_color`
--

DROP TABLE IF EXISTS `t_bus_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_bus_color` (
  `bus_id` bigint(20) NOT NULL DEFAULT '0',
  `color_id` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`bus_id`,`color_id`),
  KEY `t_bus_color_color_id_t_color_id` (`color_id`),
  CONSTRAINT `t_bus_color_bus_id_t_bus_id` FOREIGN KEY (`bus_id`) REFERENCES `t_bus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_bus_color_color_id_t_color_id` FOREIGN KEY (`color_id`) REFERENCES `t_color` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_bus_color`
--

LOCK TABLES `t_bus_color` WRITE;
/*!40000 ALTER TABLE `t_bus_color` DISABLE KEYS */;
INSERT INTO `t_bus_color` VALUES (1,1,'2012-11-06 10:13:57'),(1,2,'2012-11-06 10:13:57'),(1,3,'2012-11-06 10:13:57'),(2,1,'2012-11-06 10:13:57'),(2,2,'2012-11-06 10:13:57'),(2,3,'2012-11-06 10:13:57'),(3,1,'2012-11-06 10:13:57'),(3,2,'2012-11-06 10:13:57'),(3,3,'2012-11-06 10:13:57');
/*!40000 ALTER TABLE `t_bus_color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_color`
--

DROP TABLE IF EXISTS `t_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_color` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `active` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_name_idx` (`name`),
  UNIQUE KEY `t_color_sluggable_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_color`
--

LOCK TABLES `t_color` WRITE;
/*!40000 ALTER TABLE `t_color` DISABLE KEYS */;
INSERT INTO `t_color` VALUES (1,'Rojo','1','rojo','2012-11-06 10:13:57','2012-11-06 10:13:57'),(2,'Dorado','1','dorado','2012-11-06 10:13:57','2012-11-06 10:13:57'),(3,'Plata','1','plata','2012-11-06 10:13:57','2012-11-06 10:13:57');
/*!40000 ALTER TABLE `t_color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_company`
--

DROP TABLE IF EXISTS `t_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_company` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `active` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_name_idx` (`name`),
  UNIQUE KEY `t_company_sluggable_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_company`
--

LOCK TABLES `t_company` WRITE;
/*!40000 ALTER TABLE `t_company` DISABLE KEYS */;
INSERT INTO `t_company` VALUES (1,'AMERIKA FINANCIERA','1','amerika_financiera','2012-11-06 10:13:57','2012-11-06 10:13:57'),(2,'POLO SAC','1','polo_sac','2012-11-06 10:13:57','2012-11-06 12:20:42'),(3,'AESA','1','aesa','2012-11-06 10:13:57','2012-11-06 10:13:57'),(4,'JRC','1','jrc','2012-11-06 10:13:57','2012-11-06 10:13:57'),(5,'MULTICOSAILOR','1','multicosailor','2012-11-06 10:13:57','2012-11-06 10:13:57'),(6,'GISER','1','giser','2012-11-06 10:13:57','2012-11-06 10:13:57'),(7,'TOWER & TOWER','1','tower_tower','2012-11-06 10:13:57','2012-11-06 10:13:57'),(8,'EXPLOMIN','1','explomin','2012-11-06 10:13:57','2012-11-06 10:13:57'),(9,'RENTING','1','renting','2012-11-06 10:13:57','2012-11-06 10:13:57'),(10,'SUBTERRANEA','1','subterranea','2012-11-06 10:13:57','2012-11-06 10:13:57'),(11,'UNICON','1','unicon','2012-11-06 10:13:57','2012-11-06 10:13:57'),(12,'JYL COMPETITION','1','jyl_competition','2012-11-06 10:13:57','2012-11-06 10:13:57'),(13,'ETRASIG','1','etrasig','2012-11-06 10:13:57','2012-11-06 10:13:57'),(14,'T-IMPULSO','1','t_impulso','2012-11-06 10:13:57','2012-11-06 10:13:57'),(15,'CMINSA','1','cminsa','2012-11-06 10:13:57','2012-11-06 10:13:57'),(16,'J&V RESGUARDO','1','j_v_resguardo','2012-11-06 10:13:57','2012-11-06 10:13:57'),(17,'EMQSA','1','emqsa','2012-11-06 10:13:57','2012-11-06 10:13:57'),(18,'','1','','2012-11-09 12:30:01','2012-11-09 12:30:01');
/*!40000 ALTER TABLE `t_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_crew`
--

DROP TABLE IF EXISTS `t_crew`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_crew` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bus_id` bigint(20) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `dni` varchar(8) COLLATE utf8_bin NOT NULL,
  `driver_license` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `position` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `phone` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `natclar` date DEFAULT NULL,
  `mtc` date DEFAULT NULL,
  `expired_drivers_license` date DEFAULT NULL,
  `active` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_name_idx` (`name`),
  UNIQUE KEY `u_dni_idx` (`dni`),
  UNIQUE KEY `t_crew_sluggable_idx` (`slug`),
  KEY `bus_id_idx` (`bus_id`),
  CONSTRAINT `t_crew_bus_id_t_bus_id` FOREIGN KEY (`bus_id`) REFERENCES `t_bus` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_crew`
--

LOCK TABLES `t_crew` WRITE;
/*!40000 ALTER TABLE `t_crew` DISABLE KEYS */;
INSERT INTO `t_crew` VALUES (1,3,'CAMARGO PEÑA EDGAR','20050908','Q - 20050908','1','976332516',NULL,'2013-10-18',NULL,'1','camargo_pena_edgar','2012-11-06 10:13:57','2012-11-08 16:25:48'),(2,3,'GAMARRA SOTO LUIS HERMOGENES','41729173','Q - 41729173','2','964913116',NULL,'2013-06-06',NULL,'1','gamarra_soto_luis_hermogenes','2012-11-06 10:13:57','2012-11-08 16:25:29'),(3,1,'MARTICORENA NUÑEZ GREGORIO HONORATO','10297785','Q - 10297785','1','985268061',NULL,'2013-06-27',NULL,'1','marticorena_nunez_gregorio_honorato','2012-11-08 16:35:17','2012-11-08 16:35:17'),(4,1,'CARRERA ESPINOZA ADOLFO AMERICO','40131859','Q - 40131859','2','945344046',NULL,'2013-10-10',NULL,'1','carrera_espinoza_adolfo_americo','2012-11-08 16:36:45','2012-11-08 16:38:45'),(5,2,'MALQUI JARA MAURO MANUEL','06546916','Q - 06546916','2','951238134',NULL,'2012-11-08',NULL,'1','malqui_jara_mauro_manuel','2012-11-08 16:38:30','2012-11-08 16:38:30'),(6,2,'REQUIS CAPCHA WILFREDO','15282988','Q - 15282988','1','993089600',NULL,'2012-11-07',NULL,'1','requis_capcha_wilfredo','2012-11-08 16:40:21','2012-11-08 16:40:21'),(7,4,'JESUS SANTIAGO JOSE','09549627','Q - 09549627','1','992705518',NULL,'2013-08-14',NULL,'1','jesus_santiago_jose','2012-11-08 16:42:07','2012-11-08 16:42:07'),(8,4,'CARDENAS YLLACONZA LUIS ANTOLIN','40065644','Q - 40065644','2','949251107',NULL,'2013-06-08',NULL,'1','cardenas_yllaconza_luis_antolin','2012-11-08 16:43:56','2012-11-08 16:55:16'),(9,3,'VENTOCILLA VENTOCILLA MAGALY LILIBETH','42961546',NULL,'3','992324649',NULL,NULL,NULL,'1','ventocilla_ventocilla_magaly_lilibeth','2012-11-08 16:52:51','2012-11-09 11:12:52'),(10,1,'IVONNE ORTIZ VALQUI','70935366',NULL,'3','985170833',NULL,NULL,NULL,'1','ivonne_ortiz_valqui','2012-11-08 16:56:02','2012-11-09 11:12:38'),(11,2,'KRYSTEL JHAZMIN PICON SALAZAR','43205404',NULL,'3','986139120',NULL,NULL,NULL,'1','krystel_jhazmin_picon_salazar','2012-11-08 16:56:48','2012-11-09 11:12:16'),(12,4,'CASALLO URIBE ELIZABETH','46969101',NULL,'3','962225124',NULL,NULL,NULL,'1','casallo_uribe_elizabeth','2012-11-08 16:57:17','2012-11-09 11:12:02'),(13,3,'LISSET ISABEL LUJAN ARAMBURU','46289219',NULL,'3','954845589',NULL,NULL,NULL,'1','lisset_isabel_lujan_aramburu','2012-11-09 10:58:23','2012-11-09 10:58:23');
/*!40000 ALTER TABLE `t_crew` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_disembarking`
--

DROP TABLE IF EXISTS `t_disembarking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_disembarking` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `active` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_name_idx` (`name`),
  UNIQUE KEY `t_disembarking_sluggable_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_disembarking`
--

LOCK TABLES `t_disembarking` WRITE;
/*!40000 ALTER TABLE `t_disembarking` DISABLE KEYS */;
INSERT INTO `t_disembarking` VALUES (1,'C. Central','1','c_central','2012-11-06 10:13:57','2012-11-06 10:13:57'),(2,'C. Sur','1','c_sur','2012-11-06 10:13:57','2012-11-06 10:13:57'),(3,'Oyon','1','oyon','2012-11-06 10:13:57','2012-11-06 10:13:57'),(4,'Churin','1','churin','2012-11-06 10:13:57','2012-11-06 10:13:57'),(5,'Sayan','1','sayan','2012-11-06 10:13:57','2012-11-06 10:13:57'),(6,'Huacho','1','huacho','2012-11-06 10:13:57','2012-11-06 10:13:57'),(7,'Chancay','1','chancay','2012-11-06 10:13:57','2012-11-06 10:13:57'),(8,'Ventanilla','1','ventanilla','2012-11-06 10:13:57','2012-11-06 10:13:57'),(9,'Plaza Norte','1','plaza_norte','2012-11-06 10:13:57','2012-11-06 10:13:57'),(10,'T. Junin','1','t_junin','2012-11-06 10:13:57','2012-11-06 10:13:57');
/*!40000 ALTER TABLE `t_disembarking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_passenger`
--

DROP TABLE IF EXISTS `t_passenger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_passenger` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `boarding_id` bigint(20) DEFAULT NULL,
  `disembarking_id` bigint(20) DEFAULT NULL,
  `company_id` bigint(20) NOT NULL,
  `dni` varchar(8) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `active` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_dni_idx` (`dni`),
  UNIQUE KEY `t_passenger_sluggable_idx` (`slug`),
  KEY `boarding_id_idx` (`boarding_id`),
  KEY `disembarking_id_idx` (`disembarking_id`),
  KEY `company_id_idx` (`company_id`),
  CONSTRAINT `t_passenger_boarding_id_t_boarding_id` FOREIGN KEY (`boarding_id`) REFERENCES `t_boarding` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `t_passenger_company_id_t_company_id` FOREIGN KEY (`company_id`) REFERENCES `t_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_passenger_disembarking_id_t_disembarking_id` FOREIGN KEY (`disembarking_id`) REFERENCES `t_disembarking` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_passenger`
--

LOCK TABLES `t_passenger` WRITE;
/*!40000 ALTER TABLE `t_passenger` DISABLE KEYS */;
INSERT INTO `t_passenger` VALUES (1,1,2,1,'40438949','LEYVA ROJAS','ABEL BENJAMIN','1','abel_benjamin','2012-11-09 12:39:46','2012-11-09 13:17:07'),(2,1,5,3,'44796683','David Joan','Tataje Mendoza','1','tataje_mendoza','2012-11-09 12:53:08','2012-11-09 13:15:08'),(3,NULL,NULL,3,'23234234','Nelly','Ayala','1','ayala','2012-11-09 13:12:01','2012-11-09 13:12:01'),(4,1,1,3,'23234231','Beatriz','Tataje Mendoza','1','tataje_mendoza_1','2012-11-09 13:12:20','2012-11-09 13:12:20'),(5,NULL,NULL,3,'87987989','Beatriz','Ayala','1','ayala_1','2012-11-09 13:15:01','2012-11-09 13:15:01');
/*!40000 ALTER TABLE `t_passenger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_place`
--

DROP TABLE IF EXISTS `t_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_place` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `active` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_name_idx` (`name`),
  UNIQUE KEY `t_place_sluggable_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_place`
--

LOCK TABLES `t_place` WRITE;
/*!40000 ALTER TABLE `t_place` DISABLE KEYS */;
INSERT INTO `t_place` VALUES (1,'Lima','1','lima','2012-11-06 10:13:57','2012-11-06 10:13:57'),(2,'Casapalca','1','casapalca','2012-11-06 10:13:57','2012-11-06 10:13:57'),(3,'Pachapaqui','1','pachapaqui','2012-11-06 10:13:57','2012-11-06 10:13:57'),(4,'Iscaycruz','1','iscaycruz','2012-11-06 10:13:57','2012-11-06 10:13:57');
/*!40000 ALTER TABLE `t_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_role`
--

DROP TABLE IF EXISTS `t_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` char(2) COLLATE utf8_bin NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_code_idx` (`code`),
  UNIQUE KEY `u_name_idx` (`name`),
  UNIQUE KEY `t_role_sluggable_idx` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_role`
--

LOCK TABLES `t_role` WRITE;
/*!40000 ALTER TABLE `t_role` DISABLE KEYS */;
INSERT INTO `t_role` VALUES (1,'AD','Administrador','Es el rol administrador del sistema. Tiene acceso a todas las acciones del sistema.','administrador','2012-11-06 10:13:56','2012-11-06 10:13:56'),(2,'CL','Cliente','Es el rol del cliente. Tiene acceso a pasajeros y asignarlos al viaje programado','cliente','2012-11-06 10:13:56','2012-11-06 10:13:56');
/*!40000 ALTER TABLE `t_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_schedule`
--

DROP TABLE IF EXISTS `t_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_schedule` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bus_id` bigint(20) NOT NULL,
  `place_from_id` bigint(20) NOT NULL,
  `place_to_id` bigint(20) NOT NULL,
  `travel_date` date DEFAULT NULL,
  `travel_time` time DEFAULT NULL,
  `number` varchar(2) COLLATE utf8_bin NOT NULL,
  `active` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `t_schedule_sluggable_idx` (`slug`),
  KEY `bus_id_idx` (`bus_id`),
  KEY `place_from_id_idx` (`place_from_id`),
  KEY `place_to_id_idx` (`place_to_id`),
  CONSTRAINT `t_schedule_bus_id_t_bus_id` FOREIGN KEY (`bus_id`) REFERENCES `t_bus` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `t_schedule_place_from_id_t_place_id` FOREIGN KEY (`place_from_id`) REFERENCES `t_place` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `t_schedule_place_to_id_t_place_id` FOREIGN KEY (`place_to_id`) REFERENCES `t_place` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_schedule`
--

LOCK TABLES `t_schedule` WRITE;
/*!40000 ALTER TABLE `t_schedule` DISABLE KEYS */;
INSERT INTO `t_schedule` VALUES (1,1,1,2,'2012-11-06','14:16:00','01','1','2012_11_06','2012-11-06 10:16:34','2012-11-06 10:16:34'),(2,2,1,4,'2012-11-09','14:00:00','01','1','2012_11_09_2','2012-11-07 18:40:23','2012-11-09 13:10:17'),(3,4,1,4,'2012-11-09','14:00:00','01','1','2012_11_09','2012-11-07 18:40:54','2012-11-09 13:20:09'),(4,3,1,4,'2012-11-08','16:00:00','01','1','2012_11_08_1','2012-11-09 10:12:44','2012-11-09 13:19:56'),(5,2,1,4,'2012-11-12','16:00:00','01','1','2012_11_12','2012-11-09 15:28:58','2012-11-09 15:28:58'),(6,4,1,4,'2012-11-12','16:00:00','01','1','2012_11_12_1','2012-11-09 15:33:04','2012-11-09 15:33:04'),(7,3,1,4,'2012-11-13','14:00:00','01','1','2012_11_13','2012-11-09 15:40:06','2012-11-09 15:40:47'),(8,1,1,4,'2012-11-13','14:00:00','01','1','2012_11_13_1','2012-11-09 15:42:52','2012-11-09 15:42:52'),(9,2,1,4,'2012-11-14','14:00:00','01','1','2012_11_14','2012-11-09 15:46:28','2012-11-09 15:46:28'),(10,4,1,4,'2012-11-14','14:00:00','01','1','2012_11_14_1','2012-11-09 15:48:09','2012-11-09 15:48:09');
/*!40000 ALTER TABLE `t_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_schedule_detail`
--

DROP TABLE IF EXISTS `t_schedule_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_schedule_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `schedule_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `qty_seats` varchar(100) COLLATE utf8_bin NOT NULL,
  `active` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `schedule_id_idx` (`schedule_id`),
  KEY `company_id_idx` (`company_id`),
  CONSTRAINT `t_schedule_detail_company_id_t_company_id` FOREIGN KEY (`company_id`) REFERENCES `t_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_schedule_detail_schedule_id_t_schedule_id` FOREIGN KEY (`schedule_id`) REFERENCES `t_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_schedule_detail`
--

LOCK TABLES `t_schedule_detail` WRITE;
/*!40000 ALTER TABLE `t_schedule_detail` DISABLE KEYS */;
INSERT INTO `t_schedule_detail` VALUES (1,1,3,'20','1','2012-11-06 10:16:34','2012-11-06 10:19:47'),(2,1,16,'20','1','2012-11-06 10:19:47','2012-11-06 10:20:14'),(3,1,1,'3','1','2012-11-06 12:21:02','2012-11-06 12:21:02'),(4,2,3,'43','1','2012-11-07 18:40:23','2012-11-07 18:40:23'),(5,3,6,'43','1','2012-11-07 18:40:54','2012-11-07 18:40:54'),(6,4,3,'43','1','2012-11-09 10:12:44','2012-11-09 13:10:51'),(7,5,17,'5','1','2012-11-09 15:28:58','2012-11-09 15:28:58'),(8,5,7,'2','1','2012-11-09 15:28:58','2012-11-09 15:28:58'),(9,6,17,'5','1','2012-11-09 15:33:04','2012-11-09 15:33:04'),(10,7,17,'30','1','2012-11-09 15:40:06','2012-11-09 15:40:06'),(11,7,16,'7','1','2012-11-09 15:40:06','2012-11-09 15:40:06'),(12,7,15,'3','1','2012-11-09 15:40:06','2012-11-09 15:40:06'),(13,7,14,'1','1','2012-11-09 15:40:06','2012-11-09 15:40:06'),(14,8,17,'30','1','2012-11-09 15:42:52','2012-11-09 15:42:52'),(15,8,16,'7','1','2012-11-09 15:42:52','2012-11-09 15:42:52'),(16,8,15,'3','1','2012-11-09 15:42:52','2012-11-09 15:42:52'),(17,8,14,'1','1','2012-11-09 15:42:52','2012-11-09 15:42:52'),(18,9,4,'24','1','2012-11-09 15:46:28','2012-11-09 15:46:28'),(19,9,5,'15','1','2012-11-09 15:46:28','2012-11-09 15:46:28'),(20,10,4,'24','1','2012-11-09 15:48:09','2012-11-09 15:48:09'),(21,10,5,'15','1','2012-11-09 15:48:09','2012-11-09 15:48:09');
/*!40000 ALTER TABLE `t_schedule_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_schedule_detail_passenger`
--

DROP TABLE IF EXISTS `t_schedule_detail_passenger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_schedule_detail_passenger` (
  `schedule_detail_id` bigint(20) NOT NULL DEFAULT '0',
  `passenger_id` bigint(20) NOT NULL DEFAULT '0',
  `rank` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`schedule_detail_id`,`passenger_id`),
  KEY `t_schedule_detail_passenger_passenger_id_t_passenger_id` (`passenger_id`),
  CONSTRAINT `t_schedule_detail_passenger_passenger_id_t_passenger_id` FOREIGN KEY (`passenger_id`) REFERENCES `t_passenger` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tsti` FOREIGN KEY (`schedule_detail_id`) REFERENCES `t_schedule_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_schedule_detail_passenger`
--

LOCK TABLES `t_schedule_detail_passenger` WRITE;
/*!40000 ALTER TABLE `t_schedule_detail_passenger` DISABLE KEYS */;
INSERT INTO `t_schedule_detail_passenger` VALUES (4,2,NULL,'2012-11-09 13:19:06'),(4,3,NULL,'2012-11-09 13:19:06'),(4,4,NULL,'2012-11-09 13:19:06'),(4,5,NULL,'2012-11-09 13:19:06'),(6,2,NULL,'2012-11-09 13:15:16'),(6,3,NULL,'2012-11-09 13:15:16'),(6,4,NULL,'2012-11-09 13:15:16'),(6,5,NULL,'2012-11-09 13:15:16');
/*!40000 ALTER TABLE `t_schedule_detail_passenger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) NOT NULL,
  `company_id` bigint(20) DEFAULT NULL,
  `realname` varchar(200) COLLATE utf8_bin NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `email_boss` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `active` char(1) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `last_access_at` datetime DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_email_idx` (`email`),
  UNIQUE KEY `t_user_sluggable_idx` (`slug`),
  KEY `i_username_idx` (`username`),
  KEY `i_active_idx` (`active`),
  KEY `role_id_idx` (`role_id`),
  KEY `company_id_idx` (`company_id`),
  CONSTRAINT `t_user_company_id_t_company_id` FOREIGN KEY (`company_id`) REFERENCES `t_company` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `t_user_role_id_t_role_id` FOREIGN KEY (`role_id`) REFERENCES `t_role` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user`
--

LOCK TABLES `t_user` WRITE;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
INSERT INTO `t_user` VALUES (1,1,2,'David Tataje','admin','480c0fc1:c2103c11aa9ce6250e94511ad5efe70d','davidtataje@gmail.com',NULL,NULL,'1','2012-11-12 23:17:07','admin','2012-11-06 10:13:57','2012-11-12 23:17:07'),(2,2,3,'Juan Carlos Vizcarra','juan','ee8298a8:5bfa9ddec5d223119077052af1d92994','jvizcarra@aesa.com.pe',NULL,NULL,'1','2012-11-09 15:17:32','juan','2012-11-06 10:13:57','2012-11-09 15:17:32'),(3,2,4,'José Carlos Fierro','jose','e662816b:47315219f2be81a21415c1eb7e7b4962','jfierro@jrcing.com.pe',NULL,NULL,'1',NULL,'jose','2012-11-06 10:13:57','2012-11-06 10:13:57'),(4,2,5,'Sonia Victorio','sonia','02944b06:22dfc2302d505171c6962a2279a8e0ef','bienestar.iscaycruz@multicosailor.com.pe',NULL,NULL,'1',NULL,'sonia','2012-11-06 10:13:57','2012-11-06 10:13:57'),(5,2,6,'Carla Bustamante','carla','a0bdb1d1:ef072404e3dabe9b9436f51c02cf1e0c','gfeldmuth@geserperu.com',NULL,NULL,'1',NULL,'carla','2012-11-06 10:13:57','2012-11-06 10:13:57'),(6,2,8,'Ernesto Ramírez','ernesto','a77b683b:043195f84cf3a79af89889018a593b01','iscaycruz@explomin.com',NULL,NULL,'1',NULL,'ernesto','2012-11-06 10:13:57','2012-11-06 10:13:57'),(7,2,2,'Nélida López M.','nelida','3dd55eda:22db14881a5ad01f7d85c5959399e0c2','eservasmina@polosac.pe',NULL,NULL,'1',NULL,'nelida','2012-11-06 10:13:57','2012-11-06 10:13:57'),(8,2,9,'Aurelio Del Carmen','aurelio','1686de25:b952734dd1ea393748804d3ab68824b9','adelcarmen@rentingsac.com.pe',NULL,NULL,'1',NULL,'aurelio','2012-11-06 10:13:57','2012-11-06 10:13:57'),(9,2,10,'Isabel Fernández','isabel','c1f2f9af:683cff055e2e30a3ea022092c28e3e06','subterranea@glencore.com.pe',NULL,NULL,'1','2012-11-09 12:36:09','isabel','2012-11-06 10:13:57','2012-11-09 13:18:44'),(10,2,10,'Diego Tincopa','diego','d91cb9d2:79558ad97eb0322dab65c17572dd42ba','unicon@glencore.com.pe',NULL,NULL,'1',NULL,'diego','2012-11-06 10:13:57','2012-11-06 10:13:57'),(11,2,12,'Luis Peñarrieta','luis','bc26140e:5f0e65bf010bd638d7ac1553f4b737dd','jylcompetitionsrl@hotmail.com',NULL,NULL,'1',NULL,'luis','2012-11-06 10:13:57','2012-11-06 10:13:57'),(12,2,12,'Odón Espiritú','odon','24836ebc:90bdda2297ae5b248b8093e716693cd4','jpalpa@glencore.com.pe',NULL,NULL,'1',NULL,'odon','2012-11-06 10:13:57','2012-11-06 10:13:57'),(13,2,14,'Mary Ferroa','mary','6e351320:8b37a38ae32312fe80d23214e43d7f9d','centrodocumentario@glencore.com.pe',NULL,NULL,'1',NULL,'mary','2012-11-06 10:13:57','2012-11-06 10:13:57'),(14,2,15,'Francisco Gonzáles','francisco','bfa0d2d4:dec3d229a9a7109134c01347a886bf8a','cminsa@gmail.com',NULL,NULL,'1',NULL,'francisco','2012-11-06 10:13:57','2012-11-06 10:13:57'),(15,2,16,'Edgar Durand','edgar','d87d71f3:0be9d3c5afd2cdfa3f25d5399a630b9c','JLIscaycruz@glencore.com.pe',NULL,NULL,'1','2012-11-06 10:31:26','edgar','2012-11-06 10:13:57','2012-11-06 10:31:26'),(16,2,17,'Rodrigo Valencia Julio Carpio','rodrigo','d4842df5:d015960997b773a85107b5ffc5922044','rvalencia@glencore.com.pe',NULL,NULL,'1',NULL,'rodrigo','2012-11-06 10:13:57','2012-11-06 10:13:57');
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-14  0:52:14
