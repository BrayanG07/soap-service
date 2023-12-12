<center> 
  SOAP Service
</center>

# Endpoints
```
http://localhost:8080/soap-service/InsertUser.php?wsdl
http://localhost:8080/soap-service/UserListService.php?wsdl
```

# SQL tabla users
1. Crear la base de datos con el nombre: ```db_soap```
2. Ejecutar el siguiente SQL para crear la tabla ```tbl_user``` y llenarla
```
-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: db_soap
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'Brayan','Alvarez','brayan.alvarez@correo.com',1,'brayan.alvarez','$2y$10$ANyqMGUf2FvMK6x9/zdGUO6witlcVtA/BHcxAYmChJ.3AdeUv9vbC','999999999','Colonia Miramontes'),(2,'Josue','Alvarado','josue.alvarado@correo.com',1,'josue.alvarado','$2y$10$MUDTSBhQqfreDVugPedlmeu0YwsI0o/keDzfQhLhkBuhvf1wP17L.','999999999','Colonia Flores'),(3,'Alejandro','Silva','alejandro.silva@gmail.com',1,'alejandro.silva','$2y$10$tcAOu1wHezz8x3YnK21oHOm8GHXQQ16PqDnkNubys37nYdwrIsVci','99201045','Colonia Pedregal'),(4,'Jose','Barahona','jose.barahona@gmail.com',1,'jose.barahona','$2y$10$P6mvbh6mmluzCF2uEn6ghuhDbIceI2uKiJwWFUQ2WxIExLgHVeD4q','99201045','Colonia Pedregal'),(5,'Jose','Barahona','jose.barahona@gmail.com',1,'','$2y$10$W9TpAeMfxbm2afgh42hHdu3LlYj.sPUgNP6p9bIcndCjXdOPzenkS','99201045','Colonia Pedregal'),(6,'Jose','Barahona','jose.barahona@gmail.com',1,'josue.barahona','$2y$10$YEWKKMO9NYUFed1XcArXme6EFISPtSeOerL/qYAfPQwGjM85qpQJe','99201045','Colonia Pedregal'),(7,'?','?','?',1,'?','$2y$10$eaUTZrPGcEEzlzTmU/e6U.cFleNdU9CeraGOH/kqWU6fEC0dKjgAi','?','?'),(8,'Enzo','Fernandez','enzo.fernandez@correo.com',1,'enzo.fernandez','$2y$10$saviH7umG45TpUfvpjwH8OKorUqUzxKv02KVVa8HJRymvcqcfViNS','99999999','Colonia Mirafoles');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;
Q
--
-- Dumping routines for database 'db_soap'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-12  0:55:16
```