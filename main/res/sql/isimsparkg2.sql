-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: isimsparkg2
-- ------------------------------------------------------
-- Server version       8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `isimsparkg2`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `isimsparkg2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `isimsparkg2`;

--
-- Table structure for table `bike`
--

DROP TABLE IF EXISTS `bike`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bike` (
  `bike_id` int NOT NULL AUTO_INCREMENT,
  `bike_type` int NOT NULL,
  `bike_purchase_date` date NOT NULL,
  `bike_color` varchar(255) NOT NULL,
  `bike_size` int NOT NULL COMMENT '1 -> enfant\r\n2 -> ado\r\n3 -> adulte',
  PRIMARY KEY (`bike_id`),
  KEY `fk_bike_type` (`bike_type`),
  CONSTRAINT `fk_bike_type` FOREIGN KEY (`bike_type`) REFERENCES `type` (`type_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bike`
--

LOCK TABLES `bike` WRITE;
/*!40000 ALTER TABLE `bike` DISABLE KEYS */;
/*!40000 ALTER TABLE `bike` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair`
--

DROP TABLE IF EXISTS `repair`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repair` (
  `repair_id` int NOT NULL AUTO_INCREMENT,
  `bike_id` int NOT NULL,
  `repair_start` timestamp NOT NULL COMMENT 'timestamp of repair start',
  `repair_end` timestamp NOT NULL COMMENT 'timestamp of repair end',
  `repair_replacement` int DEFAULT NULL COMMENT 'potential id of replacement bike',
  `user_id` int NOT NULL,
  PRIMARY KEY (`repair_id`),
  KEY `fk_repair_bike` (`bike_id`),
  KEY `fk_repair_replacement` (`repair_replacement`),
  KEY `fk_repair_user` (`user_id`),
  CONSTRAINT `fk_repair_bike` FOREIGN KEY (`bike_id`) REFERENCES `bike` (`bike_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_repair_replacement` FOREIGN KEY (`repair_replacement`) REFERENCES `bike` (`bike_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_repair_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair`
--

LOCK TABLES `repair` WRITE;
/*!40000 ALTER TABLE `repair` DISABLE KEYS */;
/*!40000 ALTER TABLE `repair` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_timeslot`
--

DROP TABLE IF EXISTS `repair_timeslot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repair_timeslot` (
  `rts_id` int NOT NULL AUTO_INCREMENT,
  `rts_start` timestamp NOT NULL,
  `rts_end` timestamp NOT NULL,
  `rts_admin` int NOT NULL,
  `reparation_id` int DEFAULT NULL,
  PRIMARY KEY (`rts_id`),
  KEY `fk_repairtimeslot_admin` (`rts_admin`),
  KEY `fk_repairtimeslot_repair_id` (`reparation_id`),
  CONSTRAINT `fk_repairtimeslot_admin` FOREIGN KEY (`rts_admin`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_repairtimeslot_repair_id` FOREIGN KEY (`reparation_id`) REFERENCES `repair` (`repair_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_timeslot`
--

LOCK TABLES `repair_timeslot` WRITE;
/*!40000 ALTER TABLE `repair_timeslot` DISABLE KEYS */;
/*!40000 ALTER TABLE `repair_timeslot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `reservation_id` int NOT NULL AUTO_INCREMENT,
  `bike_id` int NOT NULL,
  `user_id` int NOT NULL,
  `reservation_start` date NOT NULL COMMENT 'date of reservation start',
  `reservation_end` date NOT NULL COMMENT 'date of reservation end',
  `reservation_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reservation_id`),
  KEY `fk_reservation_bike` (`bike_id`),
  KEY `fk_reservation_user` (`user_id`),
  CONSTRAINT `fk_reservation_bike` FOREIGN KEY (`bike_id`) REFERENCES `bike` (`bike_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_reservation_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_lastname` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_reservation` tinyint(1) NOT NULL,
  `user_admin` tinyint(1) NOT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'fabio','mirasola','',1,1,'$2y$10$nAyZbsKgzcjya.Rlcoo9teCjvXRnr7diGw0ETNYyv6jpS1zFif8Jy');
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

-- Dump completed on 2023-12-20 16:30:00