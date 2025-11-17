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
-- Table structure for table `postagens`
--

DROP TABLE IF EXISTS `postagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `postagens` (
  `idpostagens` int(11) NOT NULL AUTO_INCREMENT,
  `idusuarios` int(11) NOT NULL,
  `texto` text DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `publico` varchar(45) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpostagens`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postagens`
--

LOCK TABLES `postagens` WRITE;
/*!40000 ALTER TABLE `postagens` DISABLE KEYS */;
INSERT INTO `postagens` VALUES (4,1,'acho q funcionou agora','2025-11-02 18:43:31','1','img_6907a6539f7066.85578663.png'),(5,1,'funcionou ?????????','2025-11-02 18:48:20','1','img_6907a77419e8a3.63584282.png'),(6,1,'Bumbalacaca','2025-11-02 18:59:44','0','img_6907aa201f5431.45374209.png'),(7,5,'eba','2025-11-02 19:07:50','1','img_6907ac06bb1586.96251754.png'),(8,7,'afasffasfas','2025-11-02 20:32:03','1','img_6907bfc3730416.10996509.png'),(9,9,'teste 131e22wqwfqwfq','2025-11-02 20:48:51','1','img_6907c3b3e2d9b9.55732977.jpg'),(10,8,'teafafaafw','2025-11-02 20:49:31','1','img_6907c3db666315.53552140.jpg'),(11,9,'só privado','2025-11-02 20:50:09','0','img_6907c4017a5e94.31925272.png'),(12,1,'Supino lindo','2025-11-03 02:03:29','0','img_69080d7192fb92.26210560.jpg'),(13,1,'Ronaldo','2025-11-03 02:29:08','1','img_69081374598d71.33330074.jpeg');
/*!40000 ALTER TABLE `postagens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-11 23:49:48
