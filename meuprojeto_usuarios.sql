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
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'gabrielcavagnoli346@gmail.com','Gabriel Cavagnoli','732002cec7aeb7987bde842b9e00ee3b','foto_1.jpg','el pepe'),(7,'21@gmail.com','Antedeguemon','3c59dc048e8850243be8079a5c74d079','foto_7.jpeg','qq ele disse?'),(8,'1@gmail.com','1','c4ca4238a0b923820dcc509a6f75849b','6907c03128dc8_Faz o L.jpg',NULL),(9,'2@gmail.com','2','c81e728d9d4c2f636f067f89cc14862c','6907c03f70cc8_XD.jpg',NULL),(10,'111@gmail.com','111','698d51a19d8a121ce581499d7b701668','690ec4078146f_1.png',NULL),(11,'222@gmail.com','222','bcbe3365e6ac95ea2c0343a2395834dd','690ec415b60b3_1.png',NULL),(13,'joca@gmail.com','joca','535517356110fdc4187ec29edf0761b8','6911eaa4c13a2_deserto.png',NULL),(14,'3345@gmail.com','3345','38a77aa456fc813af07bb428f2363c8d','691314a915f29_l1.png',NULL),(15,'viniwstorm@gmail.com','Vini','81dc9bdb52d04dc20036dbd8313ed055','foto_15.jpg',NULL),(16,'pedrotryhardgames@gmail.com','PedroVaiTeMoggar','45fe0d6bd845103471507255131f3bf3','691322f8b49ce_img_69079c789646c0.58403775.gif','vo ti umilia zeu ruinsao hahahahaha'),(17,'arthurpintomole@gmail.com','cu','81dc9bdb52d04dc20036dbd8313ed055','691328474939c_6907c03f70cc8_XD.jpg',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
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
