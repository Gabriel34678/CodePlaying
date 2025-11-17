-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: localhost    Database: meuprojeto
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `amizades`
--

DROP TABLE IF EXISTS `amizades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amizades` (
  `idamizades` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario1` int(11) NOT NULL,
  `idusuario2` int(11) NOT NULL,
  `aceito` tinyint(4) DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idamizades`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amizades`
--

LOCK TABLES `amizades` WRITE;
/*!40000 ALTER TABLE `amizades` DISABLE KEYS */;
INSERT INTO `amizades` VALUES (3,1,12,NULL,'2025-11-08 17:05:11','pendente'),(5,1,11,NULL,'2025-11-08 17:16:49','aceito'),(6,1,10,NULL,'2025-11-08 17:32:52','aceito'),(8,1,7,NULL,'2025-11-08 17:39:43','aceito'),(10,1,8,NULL,'2025-11-08 17:40:57','aceito'),(12,13,1,NULL,'2025-11-10 19:10:41','aceito'),(13,13,11,NULL,'2025-11-10 22:10:40','pendente'),(14,15,1,NULL,'2025-11-11 11:39:55','aceito'),(15,16,1,NULL,'2025-11-11 11:57:33','aceito'),(16,1,17,NULL,'2025-11-11 13:27:18','pendente');
/*!40000 ALTER TABLE `amizades` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-11 23:49:49
