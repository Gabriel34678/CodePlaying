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
-- Table structure for table `mensagens`
--

DROP TABLE IF EXISTS `mensagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mensagens` (
  `idmensagens` int(11) NOT NULL AUTO_INCREMENT,
  `idremetente` int(11) NOT NULL,
  `iddestinatario` int(11) NOT NULL,
  `mensagem` text NOT NULL,
  `criado_em` timestamp NULL DEFAULT NULL,
  `vista` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idmensagens`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensagens`
--

LOCK TABLES `mensagens` WRITE;
/*!40000 ALTER TABLE `mensagens` DISABLE KEYS */;
INSERT INTO `mensagens` VALUES (1,1,8,'oi',NULL,NULL),(2,8,1,'eae',NULL,NULL),(3,1,8,'bumbalacaca',NULL,NULL),(4,1,8,'XD',NULL,NULL),(5,1,8,'asfsaf',NULL,NULL),(6,1,8,'pq nn quer funcionar',NULL,NULL),(7,7,1,'oi',NULL,NULL),(8,1,7,'eae',NULL,NULL),(9,1,7,'aoooaoaoaoaaoaaoaoaoaoaoaoaoaoaoaoaoaaooaoaaoaoaooaooaoaoaooa',NULL,NULL),(10,7,1,'afasfaafaffafafafafafafafafafa',NULL,NULL),(11,7,1,'afsafsfas',NULL,NULL),(12,8,1,'sla, faz o L aí kkkkkkkkkkkkkkkkk',NULL,NULL),(13,1,8,'jkbkbhkbkjsavsa',NULL,NULL),(14,1,8,'fsafsaafsfsaafs',NULL,NULL),(15,1,8,'fasfsafsafassfa',NULL,NULL),(16,1,8,'fsafas',NULL,NULL),(17,8,1,'qq foi seu autista',NULL,NULL),(18,8,1,'para de me mandar mensagem',NULL,NULL),(19,8,1,'??????????',NULL,NULL),(20,1,8,'nossa ?',NULL,NULL),(21,1,8,'fsafasafsaafs',NULL,NULL),(22,1,8,'fafsaf',NULL,NULL),(23,1,8,'ai que site lindo',NULL,NULL),(24,8,1,'verdade, ta muito bonito',NULL,NULL),(25,8,1,'me da um 10 aí professor',NULL,NULL),(26,8,1,':)',NULL,NULL),(27,8,1,'olha q bonito',NULL,NULL),(28,8,1,'slkk',NULL,NULL),(29,8,1,':0',NULL,NULL),(30,8,1,'verdade',NULL,NULL),(31,1,8,'fasfsafasf',NULL,NULL),(32,1,8,'coisa bela né',NULL,NULL),(33,8,1,'demais mano',NULL,NULL),(34,1,8,'slkk',NULL,NULL),(35,1,10,'ta bonito o chat hj man',NULL,NULL),(36,1,9,'asfasfa',NULL,NULL),(37,8,1,'kkkkk',NULL,NULL),(38,1,13,'fala truta',NULL,NULL),(39,13,1,'eae peixe',NULL,NULL),(40,13,1,'vai sfd vc aí',NULL,NULL),(41,1,13,'calaboca vacilão',NULL,NULL),(42,1,13,'betinha',NULL,NULL),(43,1,13,'tenho mais ponto q vc',NULL,NULL),(44,13,1,'quem?',NULL,NULL),(45,1,13,'quem oq',NULL,NULL),(46,13,1,'pediu',NULL,NULL),(47,1,13,'slk ?',NULL,NULL),(48,1,7,'seu betinha',NULL,NULL),(49,1,7,'ainda é bronze',NULL,NULL),(50,1,7,'kkkkkkkkkkkkkkkkkk',NULL,NULL),(51,13,1,'vai catar um coco',NULL,NULL),(52,1,13,'vai tu',NULL,NULL),(53,1,16,'betinha',NULL,NULL),(54,16,1,'gdsgdsgsd',NULL,NULL),(55,16,1,'RUIM',NULL,NULL),(56,16,1,'to chegando no teu rank',NULL,NULL),(57,16,1,'xd',NULL,NULL),(58,16,1,'seu bosta',NULL,NULL);
/*!40000 ALTER TABLE `mensagens` ENABLE KEYS */;
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
