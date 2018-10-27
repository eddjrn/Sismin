-- MySQL dump 10.16  Distrib 10.1.34-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: SisMin
-- ------------------------------------------------------
-- Server version	10.1.34-MariaDB-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clave_usuario`
--

DROP TABLE IF EXISTS `clave_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clave_usuario` (
  `correo_electronico` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `clave_usuario_correo_electronico_unique` (`correo_electronico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clave_usuario`
--

LOCK TABLES `clave_usuario` WRITE;
/*!40000 ALTER TABLE `clave_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `clave_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compromiso`
--

DROP TABLE IF EXISTS `compromiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compromiso` (
  `id_compromiso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_minuta` int(10) unsigned NOT NULL,
  `id_orden_dia` int(10) unsigned NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_limite` datetime NOT NULL,
  `finalizado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_compromiso`),
  KEY `compromiso_id_minuta_index` (`id_minuta`),
  KEY `compromiso_id_orden_dia_index` (`id_orden_dia`),
  CONSTRAINT `compromiso_id_minuta_foreign` FOREIGN KEY (`id_minuta`) REFERENCES `minuta` (`id_minuta`) ON DELETE CASCADE,
  CONSTRAINT `compromiso_id_orden_dia_foreign` FOREIGN KEY (`id_orden_dia`) REFERENCES `orden_dia` (`id_orden_dia`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compromiso`
--

LOCK TABLES `compromiso` WRITE;
/*!40000 ALTER TABLE `compromiso` DISABLE KEYS */;
INSERT INTO `compromiso` VALUES (1,'2018-10-04 20:42:25','2018-10-04 20:42:25',3,11,'ajbksfis','2018-10-19 10:39:00',0),(2,'2018-10-04 20:42:25','2018-10-04 20:42:25',3,11,'jfisdhfi','2018-10-12 10:41:00',0),(3,'2018-10-04 20:43:38','2018-10-04 20:43:38',3,11,'ajbksfis','2018-10-19 10:39:00',0),(4,'2018-10-04 20:43:38','2018-10-04 20:43:38',3,11,'jfisdhfi','2018-10-12 10:41:00',0);
/*!40000 ALTER TABLE `compromiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compromiso_responsable`
--

DROP TABLE IF EXISTS `compromiso_responsable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compromiso_responsable` (
  `id_compromiso_resp` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_compromiso` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `tarea` text COLLATE utf8mb4_unicode_ci,
  `realizado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_compromiso_resp`),
  KEY `compromiso_responsable_id_compromiso_index` (`id_compromiso`),
  KEY `compromiso_responsable_id_usuario_index` (`id_usuario`),
  CONSTRAINT `compromiso_responsable_id_compromiso_foreign` FOREIGN KEY (`id_compromiso`) REFERENCES `compromiso` (`id_compromiso`) ON DELETE CASCADE,
  CONSTRAINT `compromiso_responsable_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compromiso_responsable`
--

LOCK TABLES `compromiso_responsable` WRITE;
/*!40000 ALTER TABLE `compromiso_responsable` DISABLE KEYS */;
INSERT INTO `compromiso_responsable` VALUES (1,'2018-10-04 20:42:25','2018-10-04 20:44:28',1,1,'anskdjsak',1),(2,'2018-10-04 20:42:25','2018-10-04 20:42:25',1,6,NULL,0),(3,'2018-10-04 20:42:25','2018-10-04 20:42:25',2,1,NULL,0),(4,'2018-10-04 20:43:38','2018-10-04 20:43:38',3,1,NULL,0),(5,'2018-10-04 20:43:38','2018-10-04 20:43:38',3,6,NULL,0),(6,'2018-10-04 20:43:38','2018-10-04 20:43:38',4,1,NULL,0);
/*!40000 ALTER TABLE `compromiso_responsable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_usuario`
--

DROP TABLE IF EXISTS `grupo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_usuario` (
  `id_grupo_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_tipo_reunion` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_grupo_usuario`),
  KEY `grupo_usuario_id_tipo_reunion_index` (`id_tipo_reunion`),
  KEY `grupo_usuario_id_usuario_index` (`id_usuario`),
  CONSTRAINT `grupo_usuario_id_tipo_reunion_foreign` FOREIGN KEY (`id_tipo_reunion`) REFERENCES `tipo_reunion` (`id_tipo_reunion`) ON DELETE CASCADE,
  CONSTRAINT `grupo_usuario_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_usuario`
--

LOCK TABLES `grupo_usuario` WRITE;
/*!40000 ALTER TABLE `grupo_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (13,'2018_03_13_16001_creacion_de_usuarios',1),(14,'2018_03_13_16002_creacion_claves_usuarios',1),(15,'2018_03_13_16003_creacion_del_tipo_de_reunion',1),(16,'2018_03_13_16006_creacion_de_la_reunion',1),(17,'2018_03_13_16007_creacion_de_la_orden_del_dia',1),(18,'2018_03_14_174845_creacion_puesto_usuario',1),(19,'2018_03_14_174909_creacion_reunion_convocado',1),(20,'2018_04_19_16008_creacion_de_la_minuta',1),(21,'2018_04_19_16009_creacion_del_tema_pendiente',1),(22,'2018_04_19_17001_creacion_de_los_compromisos',1),(23,'2018_04_19_17002_creacion_de_compromiso_responsables',1),(24,'2018_09_26_160404_creacion_grupo_usuario',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `minuta`
--

DROP TABLE IF EXISTS `minuta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `minuta` (
  `id_minuta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha_elaboracion` datetime DEFAULT NULL,
  `id_reunion` int(10) unsigned NOT NULL,
  `notas` text COLLATE utf8mb4_unicode_ci,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_minuta`),
  KEY `minuta_id_reunion_index` (`id_reunion`),
  CONSTRAINT `minuta_id_reunion_foreign` FOREIGN KEY (`id_reunion`) REFERENCES `reunion` (`id_reunion`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `minuta`
--

LOCK TABLES `minuta` WRITE;
/*!40000 ALTER TABLE `minuta` DISABLE KEYS */;
INSERT INTO `minuta` VALUES (1,'2018-10-03 06:47:40','2018-10-03 07:21:18','2018-10-02 21:21:00',1,'','vd3Tdw0Ip5'),(2,'2018-10-03 07:29:27','2018-10-03 07:55:23','2018-10-02 21:55:00',2,'','pTG8FC2QsE'),(3,'2018-10-04 20:37:56','2018-10-04 20:43:37','2018-10-04 10:43:00',3,'nodaosidjosdifhosdhfisdjfosdkfnsodfjosdijfosd','A4TjROmZgo');
/*!40000 ALTER TABLE `minuta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orden_dia`
--

DROP TABLE IF EXISTS `orden_dia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orden_dia` (
  `id_orden_dia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_reunion` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_hechos` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id_orden_dia`),
  KEY `orden_dia_id_reunion_index` (`id_reunion`),
  KEY `orden_dia_id_usuario_index` (`id_usuario`),
  CONSTRAINT `orden_dia_id_reunion_foreign` FOREIGN KEY (`id_reunion`) REFERENCES `reunion` (`id_reunion`) ON DELETE CASCADE,
  CONSTRAINT `orden_dia_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orden_dia`
--

LOCK TABLES `orden_dia` WRITE;
/*!40000 ALTER TABLE `orden_dia` DISABLE KEYS */;
INSERT INTO `orden_dia` VALUES (1,'2018-10-03 06:47:40','2018-10-03 07:21:18',1,6,'Lorem ipsum dolor sit amet',''),(2,'2018-10-03 06:47:40','2018-10-03 07:21:18',1,3,'Consectetur adipiscing elit',''),(3,'2018-10-03 06:47:40','2018-10-03 07:21:18',1,5,'Maecenas in quam elit',''),(4,'2018-10-03 06:47:40','2018-10-03 07:21:18',1,4,'Cras ex tellus',''),(5,'2018-10-03 06:47:40','2018-10-03 07:21:18',1,2,'Auctor nec elit eget, porttitor maximus nibh',''),(6,'2018-10-03 06:47:40','2018-10-03 07:21:18',1,6,'Morbi blandit commodo placerat',''),(7,'2018-10-03 07:29:27','2018-10-03 07:29:27',2,5,'dfsdfsdfsd',NULL),(8,'2018-10-03 07:29:27','2018-10-03 07:29:27',2,6,'fsdfsdfs',NULL),(9,'2018-10-03 07:29:27','2018-10-03 07:29:27',2,5,'fsdfs',NULL),(10,'2018-10-03 07:29:27','2018-10-03 07:29:27',2,5,'fsdfs',NULL),(11,'2018-10-04 20:37:56','2018-10-04 20:42:25',3,1,'Tema 1','tehoasdnaodaiohsduiashdohdoasi\nddsfhsidufhisd\nsdnakjsda'),(12,'2018-10-04 20:37:56','2018-10-04 20:42:25',3,6,'yReaksm .com',',naiufhsidufs'),(13,'2018-10-04 20:37:56','2018-10-04 20:42:25',3,3,'ekdkschspsdod',',znkfjsbdfidhbi'),(14,'2018-10-04 20:37:56','2018-10-04 20:42:25',3,4,'jnfisdhf','ndfksfjd');
/*!40000 ALTER TABLE `orden_dia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puesto_usuario`
--

DROP TABLE IF EXISTS `puesto_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puesto_usuario` (
  `id_puesto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_puesto`),
  UNIQUE KEY `puesto_usuario_descripcion_unique` (`descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puesto_usuario`
--

LOCK TABLES `puesto_usuario` WRITE;
/*!40000 ALTER TABLE `puesto_usuario` DISABLE KEYS */;
INSERT INTO `puesto_usuario` VALUES (1,NULL,NULL,'Lorem ipsum'),(2,NULL,NULL,'Neque porro quisquam'),(3,NULL,NULL,'dolorem ipsum'),(4,NULL,NULL,'consectetur');
/*!40000 ALTER TABLE `puesto_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reunion`
--

DROP TABLE IF EXISTS `reunion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reunion` (
  `id_reunion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha_reunion` datetime NOT NULL,
  `id_tipo_reunion` int(10) unsigned NOT NULL,
  `motivo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_secretario` int(10) unsigned NOT NULL,
  `id_moderador` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_reunion`),
  KEY `reunion_id_tipo_reunion_index` (`id_tipo_reunion`),
  KEY `reunion_id_secretario_index` (`id_secretario`),
  KEY `reunion_id_moderador_index` (`id_moderador`),
  CONSTRAINT `reunion_id_moderador_foreign` FOREIGN KEY (`id_moderador`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `reunion_id_secretario_foreign` FOREIGN KEY (`id_secretario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `reunion_id_tipo_reunion_foreign` FOREIGN KEY (`id_tipo_reunion`) REFERENCES `tipo_reunion` (`id_tipo_reunion`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reunion`
--

LOCK TABLES `reunion` WRITE;
/*!40000 ALTER TABLE `reunion` DISABLE KEYS */;
INSERT INTO `reunion` VALUES (1,'2018-10-03 06:47:40','2018-10-03 06:47:40','2018-10-02 23:44:00',1,'Lorem ipsum','In augue neque','bGWkw6oppt',5,6),(2,'2018-10-03 07:29:26','2018-10-03 07:54:19','2018-10-02 23:28:00',1,'Dede','Dedede','WA1rLXgyvM',6,5),(3,'2018-10-04 20:37:55','2018-10-04 20:37:55','2018-10-04 11:36:00',2,'lol Extras :\'c','los extras :\'v','SUe6gotwAJ',1,1);
/*!40000 ALTER TABLE `reunion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reunion_convocado`
--

DROP TABLE IF EXISTS `reunion_convocado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reunion_convocado` (
  `id_convocado` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_reunion` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `asistencia` tinyint(1) NOT NULL DEFAULT '0',
  `id_puesto` int(10) unsigned NOT NULL,
  `enterado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_convocado`),
  KEY `reunion_convocado_id_reunion_index` (`id_reunion`),
  KEY `reunion_convocado_id_usuario_index` (`id_usuario`),
  KEY `reunion_convocado_id_puesto_index` (`id_puesto`),
  CONSTRAINT `reunion_convocado_id_puesto_foreign` FOREIGN KEY (`id_puesto`) REFERENCES `puesto_usuario` (`id_puesto`) ON DELETE CASCADE,
  CONSTRAINT `reunion_convocado_id_reunion_foreign` FOREIGN KEY (`id_reunion`) REFERENCES `reunion` (`id_reunion`) ON DELETE CASCADE,
  CONSTRAINT `reunion_convocado_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reunion_convocado`
--

LOCK TABLES `reunion_convocado` WRITE;
/*!40000 ALTER TABLE `reunion_convocado` DISABLE KEYS */;
INSERT INTO `reunion_convocado` VALUES (1,'2018-10-03 06:47:40','2018-10-03 07:21:18',1,6,1,4,1),(2,'2018-10-03 06:47:40','2018-10-03 07:21:18',1,3,1,2,1),(3,'2018-10-03 06:47:40','2018-10-03 07:21:18',1,5,1,3,1),(4,'2018-10-03 06:47:40','2018-10-03 07:21:18',1,4,1,1,1),(5,'2018-10-03 06:47:40','2018-10-03 07:21:18',1,2,1,3,1),(6,'2018-10-03 07:29:27','2018-10-03 07:55:23',2,5,1,1,1),(7,'2018-10-03 07:29:27','2018-10-03 07:55:23',2,6,1,1,1),(8,'2018-10-03 07:29:27','2018-10-03 07:55:23',2,3,1,1,1),(9,'2018-10-03 07:29:27','2018-10-03 07:55:23',2,4,1,1,1),(10,'2018-10-03 07:29:27','2018-10-03 07:29:27',2,2,0,1,0),(11,'2018-10-04 20:37:56','2018-10-04 20:43:37',3,1,1,2,1),(12,'2018-10-04 20:37:56','2018-10-04 20:43:37',3,6,1,1,1),(13,'2018-10-04 20:37:56','2018-10-04 20:43:37',3,3,1,1,1),(14,'2018-10-04 20:37:56','2018-10-04 20:43:38',3,5,1,1,1),(15,'2018-10-04 20:37:56','2018-10-04 20:43:38',3,4,1,1,1),(16,'2018-10-04 20:37:56','2018-10-04 20:43:38',3,2,1,1,1);
/*!40000 ALTER TABLE `reunion_convocado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tema_pendiente`
--

DROP TABLE IF EXISTS `tema_pendiente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tema_pendiente` (
  `id_tema_pendiente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_minuta` int(10) unsigned NOT NULL,
  `id_orden_dia` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expirado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_tema_pendiente`),
  KEY `tema_pendiente_id_minuta_index` (`id_minuta`),
  KEY `tema_pendiente_id_orden_dia_index` (`id_orden_dia`),
  KEY `tema_pendiente_id_usuario_index` (`id_usuario`),
  CONSTRAINT `tema_pendiente_id_minuta_foreign` FOREIGN KEY (`id_minuta`) REFERENCES `minuta` (`id_minuta`) ON DELETE CASCADE,
  CONSTRAINT `tema_pendiente_id_orden_dia_foreign` FOREIGN KEY (`id_orden_dia`) REFERENCES `orden_dia` (`id_orden_dia`) ON DELETE CASCADE,
  CONSTRAINT `tema_pendiente_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tema_pendiente`
--

LOCK TABLES `tema_pendiente` WRITE;
/*!40000 ALTER TABLE `tema_pendiente` DISABLE KEYS */;
INSERT INTO `tema_pendiente` VALUES (1,'2018-10-04 20:42:25','2018-10-04 20:42:25',3,11,1,'kjsfishdfi',0),(2,'2018-10-04 20:42:25','2018-10-04 20:42:25',3,11,1,'fsdhfiusdf',0),(3,'2018-10-04 20:42:25','2018-10-04 20:42:25',3,11,1,'sdifushdi',0),(4,'2018-10-04 20:42:25','2018-10-04 20:42:25',3,12,6,'jnfkdsjbfs',0),(5,'2018-10-04 20:42:25','2018-10-04 20:42:25',3,12,6,'sdfnsiodf',0),(6,'2018-10-04 20:42:25','2018-10-04 20:42:25',3,12,6,'nsodifjso',0),(7,'2018-10-04 20:43:38','2018-10-04 20:43:38',3,11,1,'kjsfishdfi',0),(8,'2018-10-04 20:43:38','2018-10-04 20:43:38',3,11,1,'fsdhfiusdf',0),(9,'2018-10-04 20:43:38','2018-10-04 20:43:38',3,11,1,'sdifushdi',0),(10,'2018-10-04 20:43:38','2018-10-04 20:43:38',3,12,6,'jnfkdsjbfs',0),(11,'2018-10-04 20:43:38','2018-10-04 20:43:38',3,12,6,'sdfnsiodf',0),(12,'2018-10-04 20:43:38','2018-10-04 20:43:38',3,12,6,'nsodifjso',0);
/*!40000 ALTER TABLE `tema_pendiente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_reunion`
--

DROP TABLE IF EXISTS `tipo_reunion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_reunion` (
  `id_tipo_reunion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen_logo` blob NOT NULL,
  `id_usuario` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_tipo_reunion`),
  UNIQUE KEY `tipo_reunion_descripcion_unique` (`descripcion`),
  KEY `tipo_reunion_id_usuario_index` (`id_usuario`),
  CONSTRAINT `tipo_reunion_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_reunion`
--

LOCK TABLES `tipo_reunion` WRITE;
/*!40000 ALTER TABLE `tipo_reunion` DISABLE KEYS */;
INSERT INTO `tipo_reunion` VALUES (1,'2018-10-03 06:42:14','2018-10-03 06:42:14','Lorem ipsum','����\0JFIF\0\0\0\0\0\0��\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(��\0C\n\n\n\n(\Z\Z((((((((((((((((((((((((((((((((((((((((((((((((((��\0\0�\0�\"\0��\0\0\0\0\0\0\0\0\0\0\0\0\0��\0D\0	\0\0\0\0\0!1AQa\"q�2B��Rb����#$3Sr��&4Dcstv����\0\0\0\0\0\0\0\0\0\0\0\0\0\0��\09\0\0\0\0\0\0\0!1AQ\"aq���#���2Rb��4B�S������\0\0\0?\0�R�!)JP��)B��JV4��8ĉ2�G��%?��6n��յ��7䇒I!<Sy��Jd�x�*bR��	JR�%)J��(BR��	JR�%W�^��iv7�%\0�Dv���O�8�;J�`Dq�f�Z!9K�q�(>H�\'ק��F�}�R~S�<��r�qEJQ�$��5�V\\�]�=����(�o-��涮���)ŷb��z%�Gx����\Z��=O}��y�uIt�?�����ͤ�e�SEzD5!����jZ����\0��T\rJ��L�f��S�\Z���UW؜�hϞ(R����z�?�[{���Z?�K�tf��Ql[������Q5F�E\\��?���\0���e��q���������@����������Dճsd��j��?��s�˷��ϊ�gO!6PO��=+j>��u�X\\c~+����u��:è���9X�\0�|�������q!�og}�ͱ-�WŻ6��,�β=�O���ʯ��ͪx��}�,���?c�>+��X��ѮP���?��C�9VEh�A��JR��JR�%)J���i�i[�v���{�$ �?��\'��W���Y��e�#(��Y�?D�����\\��)kR�����T��O�5C_/�n���-��\\��q-�s<�^}��qҥ,vY7�-)�\"�7?)�G���|\0��=�����\\w�I=�>�d�ARz��á�U�EHj�^B�)���xyY�3��yp�OSry���;A���8�t���Ĥzt���422��Ud�*Ĵ�ˍ��Ԥ]�ݖVJ@B\0kn@\0% �֪���^���j��	Ȩ����YQ=�RxVA�A�5�p�\\�-���rt�,��c<y�=ML\0=�,��z�sNQ9��I:�m�[��ԟ@��*t�p����\n��6d>��iQ�NU��c�Rۉ�wBũ�]R�Wp�x@�ǎ�]Sl��,�B,��cΒ��a-G@&K�)d�pI�\0�5��l��>�*U�ĸ�=LBm��.6��Vw#q	�\'�#�\\G%%C0���%�E�b���au�n��xv��=���=�y`�����Ei*�8�G8�{��6�0Ћ��̎�,�nc�@J�A%��cu�#O�~���+�����`��q��Knn	#<�����TK�,qd!!-��ly�g!.()J�$�Г��4uH%AY�]���\0E����/�ď�栵���u��`Kh?� �P�P �<�EV�Ռ@��eڣM��Eמ��Q��V�(��p0Nጞ�Ɓx���r���+PO|�l��C��\'��>��O)���Ǌ���\'{۸�x N��\0e���%rJZ��>�������ǈ�����rm�K�8��-\'!@� ����W)Ĺ��8TP�ԣ����u?*���A���^{ڞڌ8�#�?h��7��[���j.|��(BR���?Di��\0U\Z:�H>$$�~�RJsj81��.o��o��RP���V�z�}��V~@U�9��)KR�⊖�J�z�z��i؍����m�Ii���$6�<@}X��$�=:l�a�M�C@���>jǢ��YS:}�_�M��Y�![^��pV�`�yI8�	8����:��cB�j���B�\r�)�0BR��в2�\'��żΏ|~�����F�� �A �#W=1/Mȃ��.sN{	q�h���җ[QQ�	���ҥc���B��P{3T��e�Ax\"	�2fd�,-M�/V�����;* Kn%��6�ڶҽ�8�݃�t�.��C�-p��F�8��EA=�n� ���cӊ��jc���g��*2\Z���� ����02I t��M�c̳]%�Ҟؒ�����T9I\np8��1�n��\r��mA������O�H����!L̨���k8SERV�<���S�\\�e�w(R#�h��.|��2��C)*�*.!zU*�\0���-P�.:�BaNB�B�����py ��+#T髴s�3�su��	-np�y8���x\rÊp%��5N�hmP��u�L^ڑ}�+�J�oQ5\"\'N�ܖ�ǛI����Q�:o��V0�D�8�����\\.\"�ۡ�-��/�d$g�s��s_W[d�֩�ޢL�\0�2��-nVтFՍ�t�\Z9	���>�]�rl��Cn(��6�I)<xy�`���5Ǥ��f��\0�L�/\"��r-��	�.7i.nS$�[Jx�6Hl\'�Vx\0�**�\"ڙ�i��Jc�bu�n\Z�v\n��r$H���������S\ZC�~Le�nE�^(y�O�Ut�oYY��{�ҁ�,�P>�$��8��y�Ԩ5ԟP��u�ě����د\rMjE����	\r�DGOU4���`A�\ZĴ��]\"\\\"H��]Fz<������6k��d���NO����|�O��V�u����=-3N��Ƿ��	�]�h����|b{�-%�g��eֶ�橺�\\V�A}m�v�(*�5�I���q�~�15(~RG�o�R����TNۥ*7g ��<�����\Z�ָ��$��2�\'���b��b����hv>�?�y�l������+d���4n7	2u]�[@*W�\nY�U>���CӖi�\\XS�B��}n�CI�z��Ǩ�Zq7�uձ���,�~�L�j�i&�,\"�uy�Ƕ{ZP�C{К��X�M�Qܴ��ܘ\\?e�Jd4���B��8JTw$�q�P������nۉ�g��|\n�N�q�v沛�\\,�;U����e%o����!*px�)O	Y\'�=��AT����w3$@���@��e��#���o,�d�̥��ZRJ�>�=sS�^�&6��K���&q(�Hl�*#k!@��\'� :�*wQ^�خ��վS�\":^��W�>�$����ݯ�\0�H��U��P�l�}��^�1��22^m\0����<��$�����S��m��&9\0/���\n%�i|zDf�Lr��6�X*SM!9��������]Gk�z�-�Ɖs[h.,��7��z��Qt��\"�{���7))�8���F�p&�:Ib%��7D��Ӫ\\�����3��\'�Zksn|�u=q�i=#�A�1y�{n����t��z�<��[��[�;c�N�O�*���E�i	,+�Z��Ҵ��%���#�����/2�Iz�78�\r�2י˫%5��m����;���u�;�6�NRwmW<b��ׂ��t�WPA&�L��uE�v_��A�\0ƿ��4e�5�����c���دi��\0�mJ<�$\r��=?*���a���NLz;�]e=��@F�H	��5X�i����dj�/fIک�NihJ]�\n��HH�\n.:͹�crU�5�kr�os A����/�e��f��VT,�����=V��>ھ;RƩuu��\Z���%EJ�M��IWP�\"-	ϮԌ�!Q?\n���V�0yԵ���%�&�*��I�T�]H�`�\"��h��\'��p\"�g���V��\\�As�j\Z|n�JR�iy��glP���oH��B������αn����eB�)\r)�|�t׷3Ky�J��]��)��������]��H��\r>����9C�x��\"G�EN���\"Hy����$���ka���2�ϡ�|\n�?�y��\n�C*�3���y�oN�n̍o�;|˃��2E�r�����7q�O\'*\0W���wY�z��(�M�o7%,�8XZR~���Ed3�Xj;m����1��KrS�0����~����±�L�\\�μ\\,�-6�C�1ky�����A\'r�\0�x��b�u�E�9�=b&d�A���m�[�(z���{.*��R���Q�\'w����W�>��_�rS�$�d,ǚ�/�iX))��\n��s���I�^�����!��I\nU��֗S����6�	\n��8�GM�V��[���2P��-��d�{���v��;FN9�\'BM������N�8�r���� ZdѢ٧���sp��E�Y�YS͂ݲx�W9���	��v]��.S�{��}����<�<��V�}�x�qP:����L9H�C�6�WLwJP�0��	\nr|kѫ��%�i�n�p{�zR�C�:���w���q�3E�Mht�8����\r\0�v��/N�o)���f�%Q�\\g�).!\'j�K�%����Y4��fhr�)%��L�zr�DP	\0����#֣�P-�~��3P[_j#�|3�q�v���R\0ϙ#��:4A���l���۴�`h�9��£�Cr��{�YS��:�Z�;l\0�Vi�d΃I}�e�v�8�|�U]P\0��|����ԣ��n�4��Y��1�I#iC�J��k�맥��W���Ea����s�\r�~�9V썠rs�5�aoVSa����c�\0��x�]�ܫ����J��e��>�*�W]QnoIY\r�/)��BܗVZSE1��R�A+�#�ST�c�XiV����C\0w䕻�\0&�E-_g({�SL\'�B��5��ح�ڴ580��*R�\n���	��lᛖ����@�q\n�\ZLx[씥*u���(B�N޴�jT]�o.#�#�^��F��Zɧ˨u��PZO�\"��Zi���OJ���J���Kn������˵�U��\"��R�YB��P|�G#�\r\n���q&���]����T��d�,�\0�]P\'2s�o�i��{�ʲ\\�������N�b�\Z:cH��aN��T@VA� �\ZŲO�*�lw�QJˑe��t���[W�����x3�u0�XR�\\�[H�Xs�1����&V�aI��ݕ�Н��Q�=��gE���1[��U\\W\r�\ZRV�}R�B[Cg�}�sY�\Z�i��������D5! *�\n����:��p|j6v���	¸�fC��\\���K;R�^NR�����,��#�N�ݢ,W�C\r�C�ܟu��␅+jA �����&E�<��K���񞮺�5�3a;RD��wsvq0mfB��YZK�JRNӹJR� �ҡm��/vƙ�c��)��/ErR�}h\'�[O-A%@pB�y�+�l�L�h�pR�l�ؚ��Н����P^>�դdqPcIa��/�4B&Bf%|z6=�}1Ms��)��Z�yj=̓k��l\r�͵��}��a�3m���V�r��o��W�IY	V��FBNN3Qڱv�~��j���\\�.6�(kk�^K�s%Y#)��֪Z�r/7v��2��a����.)�<I���*z��pf����ݸF��g�8ÆN�gj6���	 P^����a�H�}w��sx��\'����6�\"F����G�n�jdEi��{��ޔ�e�n$�j�8��Y���m:~�\n��b�*�2I½�7DaG���q�V\0��2�:ْ&m��2f�L%i��R�u@���8�5^�:����X�D0`=�8Tr��@$p�$��,��W87��VQQ���D��ˤH\0͉7u�i�5m��/�f$�X����6�$��d��^�2��԰���wn//)?a�ʎ|8�z�Pu�}��ӧ�ʸ\\�s��JH����OS�\nf�K���/�g\n�u,b\Z>�\0-�ج4�CL�!�$%)H�\0p\0��R�$�)JP��)B��j�\Z��kw���y?���|+`Ҙ��+��&.���DÇ�\\S*;�$�SKe��P��0���EIX5����My�nS;�m~�OC���-������HNI�X�C�κ�I�4����*��8D�{�/�?C�Yh>���5Ӹo��j}�ݧ~�~j�5;��{�w�D}I���u¡��(�GE`�Tm��([������� ��\"��G��VG�Q�:�x���Sm�K��rR��@\'�\rG���^�v+C�\Z?Ә�}F���V�QA�j���eH�q�F՟��	������g����O\"fT��i�L�䜟��%)H��p\0�*����AJ���x%.m\'�9�)�%��%�y|��T��\'�R�F��摸LVbC�gSO�y���1n�c��G��6RO�֕����y��i���-F��@CPw8Hy�\0>US�4ԝ���%���{ɓ���1y��>3pbGn�ji[��H*�5��c����c���Y��d��ĵ�vT�tCc$z�\0=O��;왋Jڸj>�T��Ȏ9i��H��׭:�\'�6Pc���Ӈ����N�{8[����R�Hr$e�T|P��:�t�lR��M�������k\Z�~C`��J�%)J��(BR��	^R��)��%��ecj��B���A�ZP����c����n��W8k�o?�=>\0�Z���ƣ�Ta=\njM�-������Ѵ���R}���N!�C����U��;;�����?�ԇ?�F�\Z�\Z��mE�nY!?y\"�Ε�3�Zc�,T^�~���{od:�XDx�����O�7U��،6��pvZ����>���n\nT���nҨb}�����>�J��Y��H�5�1Y�\r��\'�>��)J�\0�s�\\�$�)JTԥ)B��JR�!)JP��)B��JR�!)JP��)B��JR�!)JP���',6),(2,'2018-10-04 20:35:36','2018-10-04 20:35:36','Edd\'s','����\0JFIF\0\0\0\0\0\0��\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(��\0C\n\n\n\n(\Z\Z((((((((((((((((((((((((((((((((((((((((((((((((((��\0\0�\0�\"\0��\0\0\0\0\0\0\0\0\0\0\0	��\0C\0	\0\0\0\0\0!1\"2A#47Qas�%BCu�FR���Vfq��������\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0��\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0��\0\0\0?\0�a@!��ѭT]=����8�B�OjDP��H[�\0;�r�[�lK��Z��*WFZ�$����۹A%[R<�D$�)�pOW�UR��k\"���R����2���%���J��eH###�\"l��Z��UT��RzmaD��Q\r0\0���#	Nq��NO1��l{���[�f|�︜!�g\nqD%$�NO�ɮ]p�+����9�&��5NW��@)\0�\nQ�9#1��*�*�᛬�\'*e!鷔��<\r�$�)�S��0��q�\0Uݕ�5���^s�8\'-����Ǣ�ߧT�U�7O������\'V��`\r�4P�pO#<�|`!(�z.�T�T����Fvm�3*ԳO�-�0��zP�HH�p1�}�&-B���o떛Ok�%\'S��a��[C�JFI$��9�C��]�\0�+�;PB��� � � � �x���N�튅z��#$�����j%A)JG�T���y d�k���W�<���=,���_�R�r�8 ���\n�$��Rb��~ri驷�~e��]uEKqd�D�I$�Lzw��P�nj�v��*zu���% \0��NԤ��pI�4G�N��[�cPX��ȅ�g�����Cqw#rpS����\n@U�.�#I�jJ�\'-#$�{r��%�ђI�R\0$����N�%�{�l&������&G�۪?��}�\0���h)B�:���x�\0��z��{����N���\0ZW����(n���w�,���PB��� � � � %��w&b�G��\nL�3ӨIB�qCkI\'�J�J�8�u\'�1ZG6uR��)�k����jbfu�g{��s	;\Z���i@�g�y��I�����Bh8%�_rq�g���՝�	$zRH��$1�����sNW-��~�y|��.Ad���%�N��%\\�gtYk�%�Z��Yó�	Ie9/���jC��T�m q�y$�(�f\'%^��e��B�u�R�F\nTH ���[�]wU-rֵ�7�i�rU\'�̱�t����>����P�*��4�r�m��W���R�OY�[$�+?rU�\n�T!N\Z��7��w���\Z������N���Q�<F\n+�+�:���x�\0��z��{����N���\0ZW����(n���w�,���PB��� � � � <�����[�!����/͆�����R����1Ŏ�j��m��\Zs��l�+�:H4M�%K��䘛ݷn;�/m�O��۟�3�q�b�Q�[g��B#*��?X�*)Zh�\nl�֦R���D�Z!�)$pXds�(�|DOG\\�د���l���M\Z����gY��l���,#v܌�9�F~�#ʊO�\rs��m;�k�W\rHT]W�~�	���(����P�*��4�r�m��W���R�OY�[$�+?rU�\n�U��\0ZW����(n���w�,���I�Xt=���e\'`*BR�+�#\\6�ӧm���z�.&%�H[S	L��%i?�7(+d��ҝE�jE���)]������%�?�����\nH�����خP�4������rU����`�c����Pv���܌�\\[s�*�2��-������;�T�#p�P|r*�骲�֋��~m���T.M����Z�����~y �s����D�AK��Q��*H���#h#kn��99gzU��VAZ+�;xU4���hc�G�m�8���{jJ8��M8G��t��5V����)��=���3���њ�>V�J���\Z�IN2�w��S����C �2	����_Gu2Q���%e�S=I����m�����P�m ��\nI#�3r�NJ�+6�o�<�6�N�) �� �A���]~Úr�o6�����d�r\'�,�-�p���*�v�&�+V�Iԩ����D�m)�����pFc�7,��ҳl����Sn��B���J���	+��Xt=���e\'c_u���sNW-��~�y|��.Ad���%�N��%\\�`�=���e\'`����#�ժ��T�J��fJM��>�ҭ��%J8\0��\0f�Ҫ�GZ*�!��M���d�T���U�������wc]�{\"㗭[����*B�m��76�i\'� �A<����v�S�͡�L�&]�u-����	\'\'&<�#��]|�j�-]���\n�Z��Z������<�A��@<� >�/��}F����tj�$�w/FOͺr���Xʎp�9����!\0����#��R7��>~��Rw�,-_6�U�K�#$��I�b���V��թS�ڃ]�)�W.�{�w����dFA<��jYw-BϺ)��2�L����F�(��*aJ�0y��� �k�7E�N�Ҝ�%<�^o%%Iϔ+i )\')P��|#��ç�\r:��)�L�i�-nS�����s�T\0�\n<���r���i\ZuY��փ�[�%����(�88�� ,�����	QdxͣH��Ɋ-�/ޕwԕ��pgk���T2y�A �	ڔ�brU��G�~Y�%ƝiAHqd)$pAD}`�m����`�3l��F�o��*spD̶V�@\0/%Ũ-?�Vq�)NɄ >Sr�NJ�+6�o�<�6�N�) �� �A�K4�SNkW2��Q�e�vI\\�OsseG�H�6�s�Hܭ�!L]a�+l�\"Ħ�s���.%HRP�%Hd�HQPC�� y8���T�4�6����L��<$xC`��D`c\nR`��Bj�U��T�N�<�����Ũ�G\0\02I�@~�:ޜ��e\n���O<��pH@�s�)G�3�����;��W��ީnv����FО�j�>�(`��%>�wc|���o�Tg.ڿo۫�m�D�eU��D���Ռ���T����vG����iL#uI�M�s��@8O*H�$�Q�߻#���>��\'�M-��O-nTdTi�N�$���JVTI*%\nAQ>TU�s�)n�+kj��%�)��DO%}�-, ��yWxs��9�+�BR���uHԋqTڪ{3Mers�N\\�p�G��p7#8 %B�m\Z��q�Qn	~��^��<��g;\\m_���ϐA0�[Pl+z��&F������u(`�\n�pr�R2 \"} �J���v�r�BR\nM1��P��PSJ���$�aY9�M����k߲��v�۳!ݒw��\Z�9���V�T��<�5SB��Ǧ�Yr�Bmf�*�~��w\ZJ@N�J�N6��;F�mjmĭ�)I\nJ�pA0GS�=���[�m�UQW�m*JZ�7�9*���!��Y\0q�65/�9��\ZEVҖ���;-<�W\'B��8���H\'��YB%�o�����7_��rmZU\"�,�6�\\J�d��v�R�rFQ�\0��BǛ�bNU驷�bY�)�]uA(m\0d�D�\0\0�LN��ԍ:���&�Su*����S�Ī¶�F8\n ����c\"&���/���=>ږ�;sk	ZS�)-\'I�y	O�c̷��;��-K��=;?0���hd���	H�Tp\0� ��_��n\Z��Z�6��Bi}Ǟp����\0\0\0\0\0\0\0P}8hg�>�v^����vB��~����!\'��}ʴc�	Z^*��̴��r��8T�aD�F�Ϥ��`p�I�!A\\��2��?�w(ne,M�\'�[���YI�!��F<m�$��J5	�-l�1,�Ƨ����N�w�S�r8������<#7�v��n[b�QrnQ�B�8Hea@�����\0�F��{����\03�\0��~B��� � �o��oY�NNH9N��{ݛ��,��J�ޒ��TIQN��8��	\n��}m���7-6w;�����vx۷osvy�q�9����Rؚy��\r̶�Ԕ����C�$)aX>F@?h{B��ڝ���\0���\0�j��.�TeV��i4��{C3�{���w�V�s�H<<f��lt�A��.�u��iZ�e��P�%ùj!\\IA�����-z�\"%-�T�9��J����9�`��Z��J$���c؄����\'�+���x�z0�{N�Tg\\��5\'L^م5�,:�	±�R���F�\0�c 낡*�VҦ���˳30�{O���Ps��������:9��J�y�ۉG�V����+$�Y%��@�_x��(d����!\0�!\0�!\0�!\0�!\0�!\0�!\0�#���y[2ͫ\\��ԋ%io$w\\$%�d��)Np@�OG�4���H�ݥ8�m������kr���\r�\n/p1� ��ٴ�|�&�\'M��ْ�e�7��chHJFI$��9�9�V��[����N*�%J}3g��j^�+�J�BV��A�pVwl��������<Z���f�5T���S���IU40���ԣ��)V0IR�㰡j����',6);
/*!40000 ALTER TABLE `tipo_reunion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_electronico` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rubrica` blob NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario_correo_electronico_unique` (`correo_electronico`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'2018-10-03 06:40:44','2018-10-03 06:40:44','Mayra','Villavicencio','Marquez','mayra29109@gmail.com','����\0JFIF\0\0\0\0\0\0��\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(��\0\0�\0�\0��\0\0\0\0\0\0\0\0\0\0\0\0	��\0F\0	\0\0\0\0!1AQaq\"�2Br���#b�$3C��R����&4DST������\0\0\0?\0�(���������������������,�V��*WS��}sF撕���M����}���oye��%]%|�&(�#k;�<\ZC�\'�J��������������뾨�M�,O���Ԟ�x9�\"�a�v�˼�Ov�vy�Y���\Z����\0�!&���W~��!a������b���0��#k��Y�x@�}��+f:sDDDDDDDDDDDDE���^��^NΨc{�f�3�7�:�@T_�c}=��6�0�v��Ɲ�\r�؉<O�y����\n�R�5_�u0o5���k�6��w�ҟ�Z�DDDDDDDDDDDDU��UmE�\0+�pz|u2�i��ݳa�~j�Z( �Z���৥����&�\0?Ev����)�6�6�]�����Q���~a�}n��0X残��tᨩ߫���ϩ*XDDDDDDDDDDDDEX��õ�}I������1���VI{���u�k�킊�3$�?�d�@x����+��Uj�\",V�@��w6�7�q0߬�2}U�DDDDDDDDDDDDE�4��%y٬iq>�V^�SEQ�g�e�Hᇋw�!٬{�q$�`������?��L����� ���W>���\0�և�������g�CEJ��8��y��Ȉ������������mR�Ab�܂��x�-�����m���<�$rT�Mmyvso�\rƃ���R*����;�\r�\r�>ܮ��a���f���<��x���u�����5K��i����e\\�Q�֓���i���������t ��_h���������\n�Ku3�nPRӳ���@Əry(SP�F�v\"�<b7_�_T:#�N�}���\0(���O?��[�Wf���Q���E%��~7��������z�#ٲ��G�|5�T�*$ l\\\\�lO����DDE��>[I�a���ݜ f�G��Y&�{��uB�P�u\'R�b������z��-\'w@փ��-K)���!�q01��\r�Ȉ��������驥��:\'���F�a#��U�M2ּn��ܹ������v���,���J����r�U�\0�w\"�F;q��Z.����g%IfIP�<���o���\0�<Csf�[����\0VD���vٿ�r=��\r>��\0;}&��\rs�P���AӜf���-�n=K?��=�m�:���bԲ�\0a�7���<�1��o/rV��#���2긾����9��-��j�u�P]g����=\\�m�Z\Z?�V\n�\0���@Ѱ�&�`�\"\"\"�e��1�b�y�ۺ��|�������9�*k��j��8��ݪ� s..v�|�G���N��a�=��TЎ����y��\0Q+�DDDDDDDDDU��~�m[�� 缬{���h�U�DE������Zxw�+**��(4���~�\\��f\0���|�G�����#�Ǩ��Q���($r3�c��{�vW����{h�ۉ����N���X�E��W}����o�����PӊZVD�s\'̬�_i|��Z�rlO㧷mCm���.V���\Z0�6��<|\n��ʭ�0��O�n��u$�\"\"\"\"\"\".2��e���]�	����R��w�����>{-<w=U��M��m���و��Ȃ� ���Qmd:���@:�7�g���W�ת�Y��x+-5]ʈ�h>�����*+�]�\n��\0ڊ@�����_�C�w�|q�w�1�[����U�E��_���B��ֿ� g3�鿒��ۧl������:ǐ[�Z���?��n�GM$��Hi�|��R]\0ĥ�\rQeUņZ\ZI\r}k�7<[���;�_DDDDDDEkNUS�c1SZ��k�%�%/����p��=\\\n��E�ZY�Y=�f�UU�n�8�-i=\Z�Ԯ���l�����h���%�;om�.-�1�]��x�}]��t�TO)��iwC���!Dݙ1�����e�A�*�������}������9���k�mr������em�-��.Jz(O�e3~/��kwcǨ��&�Z�����8�y-�.o5�1�*�T�w8i����K\'�`�}�*����\0M�cux�=m����s{ں�����~����9��X�.�7K\r����;�k�GMhcĭo\'o�x���5rE�0L�G�Y�@.�\Zx�;���R�\"(����Y���Ƽ�j��8���;�C\\��eu�J��I�3��� ۞��~�8����lls�pk\Z7s�v\0y�\\5k�Ciꤱi�b���wF�7���6��l�����c:t�CS���ڦ������|�U.`�n;���Jm=.S���Y([ECYX�zjv�K#.\0nO2�|W�r��::H)�hlP����a�,Ȉ����������h��+Լ/�.s ��\r;��#ͬc��X����k#�h\rh\0/�X+���(����8)`a�Idv�c@ܒUG��H�5�&n����C�Z�7v\Z�:�C�cG��=��4sF��{Jʩ�ˆ@��\0����b�^��Q�k,�Y�K��K���sZع���^���>���6��kW	��x�#�2�\"�~;|��E���Պ��v�CIL�����OEh&��Z����V蛏�	����O�I<���XTDDDDDDD_�sX�9�5��z\0���0�\Z��gS���\Zj\"�Ӌ�nޢ6�~��(���}t�ܺ,��O����*��I���w�v��O�E���:ǙIH��r�VV�R��y4x��n���XWx�-t�wt��iH�[��}Pf2�(��\'��g�WH?���i=�����b�w�N�3��ʪg���~��z�]���E3�.��Ԑ�n_4���T�]�>MD�~ζ��q�\'ޣ�p�d~@x,Z-�S����������Z���;44�nz��Tj�_`�{u���0��+h�ց�%�o��l;9g�K�V�ݫ��#�Ι�m�n�-;x�Jʢ\"\"\"\"���O��{8�#ou� ?�Gp�#�2@���-[)u�F\n�Vڢw��h��߄��/�u/%Ʀd�7$P�p�6�n�Դ��=��a�[o�-��VEU�Xy��8uЮ�^W���Ց��\Z���(\0<�p<n�7q��p[]��\0s���A+8+foҪ�+�;�8[�Uݢ��R�K�lq���r��ч�s�	�.��鿢�vh���o7Xv���pp�O�#�<��C�Lu�PP��WY+!���I$y٬h�O���\r���W!��2ÎQ�E\0?����=��Vn�)��E5��:*:z8�Q�F�7�Ӆ���O��\Z��2L�ۓa̫�����$���e�ݮ\0ӧ?�{�����U����,\\����sؾ7���ABj焻���Nqc�q�58�Z��\ZQz��lշ�z^?�J���-h��~���dxh��G�� 5l�����q�H�ۚ����	�����5}[�j�\\��m�|�RV�`p�x|4�kMΣik$/����:~+�DDDD\\��d��nw8��!��?��������hV#���V�;�Ղ�y�wpc�&�b	�>�IKM<5P>\n���㑡�p� �QU�\0M�lU���K���9(K�� �n���yy��m�]a�[$7ߣ�[l��4�Ҵ���\\�ѷ�-*�\"�]�4��Ueƹ��-$/�Wy5���Q�~�Q�:�r�/�q�(�.��ۿHb�\0n|�}U��s\Z���u��pݗq<�4sUg^����q���U-������$L\0th�|�y/���Q�-�Kg��=��J�	��W}�=�Oĩg��i�͛#�T������6o�w\'�R���,1pZ�Qrؽч���ە���,����f��;�p�֓��ߒ�m��;Ut��Xiic2(X\Z����A\r��Yo�oQ:�G\r���uG�׻��5D5�wS��ҳɲ0�\\[��KA����p~Y��%�b_2�\'DOW���<􈈈���N��O�\Zӳr�8y��E/QG4pE&Fְ\0%�]��۱PP�]~�oOJ�ss��\0#}��Ej0�����JJ�:���2�3��G�?V�`=� ���˘^1\n����O}9<0\\�8����<ARc�T-���VS����Nd�y�tU紖�Y+0j��5UUr29���������˖Ĩ�H�:�]��݈�=\r��GO5X�!#�ù�� \0�rZ�GOi���Asu��\0#�\'��w��ۻi����9��G����	���Ao��[ɧg}���>\'�<w�-�}2�W3H1@;���\0[��\"\"\"\"\"\"\"\"�;DY�w�닣k�-�X�ѿ�;;�k�~K����y&e��(�GS�9���p��\'؅ԭNU�۱k\rU��0�������|\Z����\ni��y�ړ��[M�-4��ֆ���\0e��>.��s�o��m���wz�))���v��ԟ@���Z)o��d��.��\0��������Gp���P�t��W�B��=��`�����+Ւ���O*��:yh2��v�<�L[�mw&���p��U\Z�r�i0�M��Gn����覜�I��l9�ȍ�.jv����[��c���9<s��~���w���o3$���MNx���c�����z�������|r�+b���������\'�9���\"���c�����*���WhF_SG_�xM�S,�8����<@t�w�=s���ϩ����Cwe<4�q��|@�!Gq[�Z�y� ͣu���4�I�&�bw�~×&���M�\\2E�靯�R1��d?@c�z��^K&��9]kn��v�qs�3_�&�[�VA��1�RɌR�,��)F�9ỽ��<�ݭM��_#�Q�+�! �^�gk�n=�l7��8�>�ǉ����fc�;�YQ��;~_��ر�KT�w=�U��g���Kx������������SWR�M[OE<�g�+���A�T_�Z��N��p��톱�BG�����Ǡ\\�0�J��*_l��\0���&7��*o�p�&!D �R5�����Ow�r]\Z\"\"��\\(��+j����G��J���!sa������̭3��rqm��M�>@O���Y�.�W�m%>|;��}Ōfs�*��G��a\'�e�ǽ��l�����\0䳌W$�������\0ܬ��3�3����#oR�N?��V�ϓAu��%5{G������t\r߄qu�_������O�_�1�~��\\Ouy4u{�F�r�8�j5# �����.��=9$5�x}���X8b��,lq������D^+�ւ�	��Y3=�x���5v��6ji�3�������Z�U��Q�6������;{������4�l��U])���?�]���ښ>�l�m��w�V��k\Z\ZƆ����ru�Uu,��0��J\"͹��F���kk��VPB�S�Y�z�\r�;{���Yb�í�UAMWK���<5�C�{�R�6���ܭU�\'���5�Z8H��(.�5�޵��ݖ�Or�ûo��\\��5-<6[w��G�\0�[���;�ek�\'UL*�����ndn;Q��)\nɌ��q��-�BG�����y��\"\"\"\"\"\"\"\"\"\"/ǵ�ik�s\\6 ��\n.�4S�K$��jm�����<L�ҳCG�2j���\0e��荎\r�q���x�����v�L/��}����8����]\n\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"/��','$2y$10$/JlpMyuhF2CKpMTldI8NHePRoVbTCq5eJmGWPI0Bdf0v4yl1ca5yK',0,'WaKGDGBBmSBDt26EN3knyspUZCCJGG6iv0BKuDbR8Xjnvluyurx84QTYHdKd'),(2,'2018-10-03 06:40:44','2018-10-03 06:40:44','Pedro Pepe','Pereira','Perez','pedro95@gmail.com','����\0JFIF\0\0\0\0\0\0��\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(��\0\0�\0�\0��\0\0\0\0\0\0\0\0\0\0\0\0	��\0F\0	\0\0\0\0!1AQaq\"�2Br���#b�$3C��R����&4DST������\0\0\0?\0�(���������������������,�V��*WS��}sF撕���M����}���oye��%]%|�&(�#k;�<\ZC�\'�J��������������뾨�M�,O���Ԟ�x9�\"�a�v�˼�Ov�vy�Y���\Z����\0�!&���W~��!a������b���0��#k��Y�x@�}��+f:sDDDDDDDDDDDDE���^��^NΨc{�f�3�7�:�@T_�c}=��6�0�v��Ɲ�\r�؉<O�y����\n�R�5_�u0o5���k�6��w�ҟ�Z�DDDDDDDDDDDDU��UmE�\0+�pz|u2�i��ݳa�~j�Z( �Z���৥����&�\0?Ev����)�6�6�]�����Q���~a�}n��0X残��tᨩ߫���ϩ*XDDDDDDDDDDDDEX��õ�}I������1���VI{���u�k�킊�3$�?�d�@x����+��Uj�\",V�@��w6�7�q0߬�2}U�DDDDDDDDDDDDE�4��%y٬iq>�V^�SEQ�g�e�Hᇋw�!٬{�q$�`������?��L����� ���W>���\0�և�������g�CEJ��8��y��Ȉ������������mR�Ab�܂��x�-�����m���<�$rT�Mmyvso�\rƃ���R*����;�\r�\r�>ܮ��a���f���<��x���u�����5K��i����e\\�Q�֓���i���������t ��_h���������\n�Ku3�nPRӳ���@Əry(SP�F�v\"�<b7_�_T:#�N�}���\0(���O?��[�Wf���Q���E%��~7��������z�#ٲ��G�|5�T�*$ l\\\\�lO����DDE��>[I�a���ݜ f�G��Y&�{��uB�P�u\'R�b������z��-\'w@փ��-K)���!�q01��\r�Ȉ��������驥��:\'���F�a#��U�M2ּn��ܹ������v���,���J����r�U�\0�w\"�F;q��Z.����g%IfIP�<���o���\0�<Csf�[����\0VD���vٿ�r=��\r>��\0;}&��\rs�P���AӜf���-�n=K?��=�m�:���bԲ�\0a�7���<�1��o/rV��#���2긾����9��-��j�u�P]g����=\\�m�Z\Z?�V\n�\0���@Ѱ�&�`�\"\"\"�e��1�b�y�ۺ��|�������9�*k��j��8��ݪ� s..v�|�G���N��a�=��TЎ����y��\0Q+�DDDDDDDDDU��~�m[�� 缬{���h�U�DE������Zxw�+**��(4���~�\\��f\0���|�G�����#�Ǩ��Q���($r3�c��{�vW����{h�ۉ����N���X�E��W}����o�����PӊZVD�s\'̬�_i|��Z�rlO㧷mCm���.V���\Z0�6��<|\n��ʭ�0��O�n��u$�\"\"\"\"\"\".2��e���]�	����R��w�����>{-<w=U��M��m���و��Ȃ� ���Qmd:���@:�7�g���W�ת�Y��x+-5]ʈ�h>�����*+�]�\n��\0ڊ@�����_�C�w�|q�w�1�[����U�E��_���B��ֿ� g3�鿒��ۧl������:ǐ[�Z���?��n�GM$��Hi�|��R]\0ĥ�\rQeUņZ\ZI\r}k�7<[���;�_DDDDDDEkNUS�c1SZ��k�%�%/����p��=\\\n��E�ZY�Y=�f�UU�n�8�-i=\Z�Ԯ���l�����h���%�;om�.-�1�]��x�}]��t�TO)��iwC���!Dݙ1�����e�A�*�������}������9���k�mr������em�-��.Jz(O�e3~/��kwcǨ��&�Z�����8�y-�.o5�1�*�T�w8i����K\'�`�}�*����\0M�cux�=m����s{ں�����~����9��X�.�7K\r����;�k�GMhcĭo\'o�x���5rE�0L�G�Y�@.�\Zx�;���R�\"(����Y���Ƽ�j��8���;�C\\��eu�J��I�3��� ۞��~�8����lls�pk\Z7s�v\0y�\\5k�Ciꤱi�b���wF�7���6��l�����c:t�CS���ڦ������|�U.`�n;���Jm=.S���Y([ECYX�zjv�K#.\0nO2�|W�r��::H)�hlP����a�,Ȉ����������h��+Լ/�.s ��\r;��#ͬc��X����k#�h\rh\0/�X+���(����8)`a�Idv�c@ܒUG��H�5�&n����C�Z�7v\Z�:�C�cG��=��4sF��{Jʩ�ˆ@��\0����b�^��Q�k,�Y�K��K���sZع���^���>���6��kW	��x�#�2�\"�~;|��E���Պ��v�CIL�����OEh&��Z����V蛏�	����O�I<���XTDDDDDDD_�sX�9�5��z\0���0�\Z��gS���\Zj\"�Ӌ�nޢ6�~��(���}t�ܺ,��O����*��I���w�v��O�E���:ǙIH��r�VV�R��y4x��n���XWx�-t�wt��iH�[��}Pf2�(��\'��g�WH?���i=�����b�w�N�3��ʪg���~��z�]���E3�.��Ԑ�n_4���T�]�>MD�~ζ��q�\'ޣ�p�d~@x,Z-�S����������Z���;44�nz��Tj�_`�{u���0��+h�ց�%�o��l;9g�K�V�ݫ��#�Ι�m�n�-;x�Jʢ\"\"\"\"���O��{8�#ou� ?�Gp�#�2@���-[)u�F\n�Vڢw��h��߄��/�u/%Ʀd�7$P�p�6�n�Դ��=��a�[o�-��VEU�Xy��8uЮ�^W���Ց��\Z���(\0<�p<n�7q��p[]��\0s���A+8+foҪ�+�;�8[�Uݢ��R�K�lq���r��ч�s�	�.��鿢�vh���o7Xv���pp�O�#�<��C�Lu�PP��WY+!���I$y٬h�O���\r���W!��2ÎQ�E\0?����=��Vn�)��E5��:*:z8�Q�F�7�Ӆ���O��\Z��2L�ۓa̫�����$���e�ݮ\0ӧ?�{�����U����,\\����sؾ7���ABj焻���Nqc�q�58�Z��\ZQz��lշ�z^?�J���-h��~���dxh��G�� 5l�����q�H�ۚ����	�����5}[�j�\\��m�|�RV�`p�x|4�kMΣik$/����:~+�DDDD\\��d��nw8��!��?��������hV#���V�;�Ղ�y�wpc�&�b	�>�IKM<5P>\n���㑡�p� �QU�\0M�lU���K���9(K�� �n���yy��m�]a�[$7ߣ�[l��4�Ҵ���\\�ѷ�-*�\"�]�4��Ueƹ��-$/�Wy5���Q�~�Q�:�r�/�q�(�.��ۿHb�\0n|�}U��s\Z���u��pݗq<�4sUg^����q���U-������$L\0th�|�y/���Q�-�Kg��=��J�	��W}�=�Oĩg��i�͛#�T������6o�w\'�R���,1pZ�Qrؽч���ە���,����f��;�p�֓��ߒ�m��;Ut��Xiic2(X\Z����A\r��Yo�oQ:�G\r���uG�׻��5D5�wS��ҳɲ0�\\[��KA����p~Y��%�b_2�\'DOW���<􈈈���N��O�\Zӳr�8y��E/QG4pE&Fְ\0%�]��۱PP�]~�oOJ�ss��\0#}��Ej0�����JJ�:���2�3��G�?V�`=� ���˘^1\n����O}9<0\\�8����<ARc�T-���VS����Nd�y�tU紖�Y+0j��5UUr29���������˖Ĩ�H�:�]��݈�=\r��GO5X�!#�ù�� \0�rZ�GOi���Asu��\0#�\'��w��ۻi����9��G����	���Ao��[ɧg}���>\'�<w�-�}2�W3H1@;���\0[��\"\"\"\"\"\"\"\"�;DY�w�닣k�-�X�ѿ�;;�k�~K����y&e��(�GS�9���p��\'؅ԭNU�۱k\rU��0�������|\Z����\ni��y�ړ��[M�-4��ֆ���\0e��>.��s�o��m���wz�))���v��ԟ@���Z)o��d��.��\0��������Gp���P�t��W�B��=��`�����+Ւ���O*��:yh2��v�<�L[�mw&���p��U\Z�r�i0�M��Gn����覜�I��l9�ȍ�.jv����[��c���9<s��~���w���o3$���MNx���c�����z�������|r�+b���������\'�9���\"���c�����*���WhF_SG_�xM�S,�8����<@t�w�=s���ϩ����Cwe<4�q��|@�!Gq[�Z�y� ͣu���4�I�&�bw�~×&���M�\\2E�靯�R1��d?@c�z��^K&��9]kn��v�qs�3_�&�[�VA��1�RɌR�,��)F�9ỽ��<�ݭM��_#�Q�+�! �^�gk�n=�l7��8�>�ǉ����fc�;�YQ��;~_��ر�KT�w=�U��g���Kx������������SWR�M[OE<�g�+���A�T_�Z��N��p��톱�BG�����Ǡ\\�0�J��*_l��\0���&7��*o�p�&!D �R5�����Ow�r]\Z\"\"��\\(��+j����G��J���!sa������̭3��rqm��M�>@O���Y�.�W�m%>|;��}Ōfs�*��G��a\'�e�ǽ��l�����\0䳌W$�������\0ܬ��3�3����#oR�N?��V�ϓAu��%5{G������t\r߄qu�_������O�_�1�~��\\Ouy4u{�F�r�8�j5# �����.��=9$5�x}���X8b��,lq������D^+�ւ�	��Y3=�x���5v��6ji�3�������Z�U��Q�6������;{������4�l��U])���?�]���ښ>�l�m��w�V��k\Z\ZƆ����ru�Uu,��0��J\"͹��F���kk��VPB�S�Y�z�\r�;{���Yb�í�UAMWK���<5�C�{�R�6���ܭU�\'���5�Z8H��(.�5�޵��ݖ�Or�ûo��\\��5-<6[w��G�\0�[���;�ek�\'UL*�����ndn;Q��)\nɌ��q��-�BG�����y��\"\"\"\"\"\"\"\"\"\"/ǵ�ik�s\\6 ��\n.�4S�K$��jm�����<L�ҳCG�2j���\0e��荎\r�q���x�����v�L/��}����8����]\n\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"/��','$2y$10$9UeawZRd0.5N9CU6LoZDxe4.AIML6w.vY9PHmJFoHgWlpSb.U3yBC',0,NULL),(3,'2018-10-03 06:40:44','2018-10-03 06:40:44','Juan Jose','Ramirez','Noriega','junaskdw_43@gmail.com','����\0JFIF\0\0\0\0\0\0��\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(��\0\0�\0�\0��\0\0\0\0\0\0\0\0\0\0\0\0	��\0F\0	\0\0\0\0!1AQaq\"�2Br���#b�$3C��R����&4DST������\0\0\0?\0�(���������������������,�V��*WS��}sF撕���M����}���oye��%]%|�&(�#k;�<\ZC�\'�J��������������뾨�M�,O���Ԟ�x9�\"�a�v�˼�Ov�vy�Y���\Z����\0�!&���W~��!a������b���0��#k��Y�x@�}��+f:sDDDDDDDDDDDDE���^��^NΨc{�f�3�7�:�@T_�c}=��6�0�v��Ɲ�\r�؉<O�y����\n�R�5_�u0o5���k�6��w�ҟ�Z�DDDDDDDDDDDDU��UmE�\0+�pz|u2�i��ݳa�~j�Z( �Z���৥����&�\0?Ev����)�6�6�]�����Q���~a�}n��0X残��tᨩ߫���ϩ*XDDDDDDDDDDDDEX��õ�}I������1���VI{���u�k�킊�3$�?�d�@x����+��Uj�\",V�@��w6�7�q0߬�2}U�DDDDDDDDDDDDE�4��%y٬iq>�V^�SEQ�g�e�Hᇋw�!٬{�q$�`������?��L����� ���W>���\0�և�������g�CEJ��8��y��Ȉ������������mR�Ab�܂��x�-�����m���<�$rT�Mmyvso�\rƃ���R*����;�\r�\r�>ܮ��a���f���<��x���u�����5K��i����e\\�Q�֓���i���������t ��_h���������\n�Ku3�nPRӳ���@Əry(SP�F�v\"�<b7_�_T:#�N�}���\0(���O?��[�Wf���Q���E%��~7��������z�#ٲ��G�|5�T�*$ l\\\\�lO����DDE��>[I�a���ݜ f�G��Y&�{��uB�P�u\'R�b������z��-\'w@փ��-K)���!�q01��\r�Ȉ��������驥��:\'���F�a#��U�M2ּn��ܹ������v���,���J����r�U�\0�w\"�F;q��Z.����g%IfIP�<���o���\0�<Csf�[����\0VD���vٿ�r=��\r>��\0;}&��\rs�P���AӜf���-�n=K?��=�m�:���bԲ�\0a�7���<�1��o/rV��#���2긾����9��-��j�u�P]g����=\\�m�Z\Z?�V\n�\0���@Ѱ�&�`�\"\"\"�e��1�b�y�ۺ��|�������9�*k��j��8��ݪ� s..v�|�G���N��a�=��TЎ����y��\0Q+�DDDDDDDDDU��~�m[�� 缬{���h�U�DE������Zxw�+**��(4���~�\\��f\0���|�G�����#�Ǩ��Q���($r3�c��{�vW����{h�ۉ����N���X�E��W}����o�����PӊZVD�s\'̬�_i|��Z�rlO㧷mCm���.V���\Z0�6��<|\n��ʭ�0��O�n��u$�\"\"\"\"\"\".2��e���]�	����R��w�����>{-<w=U��M��m���و��Ȃ� ���Qmd:���@:�7�g���W�ת�Y��x+-5]ʈ�h>�����*+�]�\n��\0ڊ@�����_�C�w�|q�w�1�[����U�E��_���B��ֿ� g3�鿒��ۧl������:ǐ[�Z���?��n�GM$��Hi�|��R]\0ĥ�\rQeUņZ\ZI\r}k�7<[���;�_DDDDDDEkNUS�c1SZ��k�%�%/����p��=\\\n��E�ZY�Y=�f�UU�n�8�-i=\Z�Ԯ���l�����h���%�;om�.-�1�]��x�}]��t�TO)��iwC���!Dݙ1�����e�A�*�������}������9���k�mr������em�-��.Jz(O�e3~/��kwcǨ��&�Z�����8�y-�.o5�1�*�T�w8i����K\'�`�}�*����\0M�cux�=m����s{ں�����~����9��X�.�7K\r����;�k�GMhcĭo\'o�x���5rE�0L�G�Y�@.�\Zx�;���R�\"(����Y���Ƽ�j��8���;�C\\��eu�J��I�3��� ۞��~�8����lls�pk\Z7s�v\0y�\\5k�Ciꤱi�b���wF�7���6��l�����c:t�CS���ڦ������|�U.`�n;���Jm=.S���Y([ECYX�zjv�K#.\0nO2�|W�r��::H)�hlP����a�,Ȉ����������h��+Լ/�.s ��\r;��#ͬc��X����k#�h\rh\0/�X+���(����8)`a�Idv�c@ܒUG��H�5�&n����C�Z�7v\Z�:�C�cG��=��4sF��{Jʩ�ˆ@��\0����b�^��Q�k,�Y�K��K���sZع���^���>���6��kW	��x�#�2�\"�~;|��E���Պ��v�CIL�����OEh&��Z����V蛏�	����O�I<���XTDDDDDDD_�sX�9�5��z\0���0�\Z��gS���\Zj\"�Ӌ�nޢ6�~��(���}t�ܺ,��O����*��I���w�v��O�E���:ǙIH��r�VV�R��y4x��n���XWx�-t�wt��iH�[��}Pf2�(��\'��g�WH?���i=�����b�w�N�3��ʪg���~��z�]���E3�.��Ԑ�n_4���T�]�>MD�~ζ��q�\'ޣ�p�d~@x,Z-�S����������Z���;44�nz��Tj�_`�{u���0��+h�ց�%�o��l;9g�K�V�ݫ��#�Ι�m�n�-;x�Jʢ\"\"\"\"���O��{8�#ou� ?�Gp�#�2@���-[)u�F\n�Vڢw��h��߄��/�u/%Ʀd�7$P�p�6�n�Դ��=��a�[o�-��VEU�Xy��8uЮ�^W���Ց��\Z���(\0<�p<n�7q��p[]��\0s���A+8+foҪ�+�;�8[�Uݢ��R�K�lq���r��ч�s�	�.��鿢�vh���o7Xv���pp�O�#�<��C�Lu�PP��WY+!���I$y٬h�O���\r���W!��2ÎQ�E\0?����=��Vn�)��E5��:*:z8�Q�F�7�Ӆ���O��\Z��2L�ۓa̫�����$���e�ݮ\0ӧ?�{�����U����,\\����sؾ7���ABj焻���Nqc�q�58�Z��\ZQz��lշ�z^?�J���-h��~���dxh��G�� 5l�����q�H�ۚ����	�����5}[�j�\\��m�|�RV�`p�x|4�kMΣik$/����:~+�DDDD\\��d��nw8��!��?��������hV#���V�;�Ղ�y�wpc�&�b	�>�IKM<5P>\n���㑡�p� �QU�\0M�lU���K���9(K�� �n���yy��m�]a�[$7ߣ�[l��4�Ҵ���\\�ѷ�-*�\"�]�4��Ueƹ��-$/�Wy5���Q�~�Q�:�r�/�q�(�.��ۿHb�\0n|�}U��s\Z���u��pݗq<�4sUg^����q���U-������$L\0th�|�y/���Q�-�Kg��=��J�	��W}�=�Oĩg��i�͛#�T������6o�w\'�R���,1pZ�Qrؽч���ە���,����f��;�p�֓��ߒ�m��;Ut��Xiic2(X\Z����A\r��Yo�oQ:�G\r���uG�׻��5D5�wS��ҳɲ0�\\[��KA����p~Y��%�b_2�\'DOW���<􈈈���N��O�\Zӳr�8y��E/QG4pE&Fְ\0%�]��۱PP�]~�oOJ�ss��\0#}��Ej0�����JJ�:���2�3��G�?V�`=� ���˘^1\n����O}9<0\\�8����<ARc�T-���VS����Nd�y�tU紖�Y+0j��5UUr29���������˖Ĩ�H�:�]��݈�=\r��GO5X�!#�ù�� \0�rZ�GOi���Asu��\0#�\'��w��ۻi����9��G����	���Ao��[ɧg}���>\'�<w�-�}2�W3H1@;���\0[��\"\"\"\"\"\"\"\"�;DY�w�닣k�-�X�ѿ�;;�k�~K����y&e��(�GS�9���p��\'؅ԭNU�۱k\rU��0�������|\Z����\ni��y�ړ��[M�-4��ֆ���\0e��>.��s�o��m���wz�))���v��ԟ@���Z)o��d��.��\0��������Gp���P�t��W�B��=��`�����+Ւ���O*��:yh2��v�<�L[�mw&���p��U\Z�r�i0�M��Gn����覜�I��l9�ȍ�.jv����[��c���9<s��~���w���o3$���MNx���c�����z�������|r�+b���������\'�9���\"���c�����*���WhF_SG_�xM�S,�8����<@t�w�=s���ϩ����Cwe<4�q��|@�!Gq[�Z�y� ͣu���4�I�&�bw�~×&���M�\\2E�靯�R1��d?@c�z��^K&��9]kn��v�qs�3_�&�[�VA��1�RɌR�,��)F�9ỽ��<�ݭM��_#�Q�+�! �^�gk�n=�l7��8�>�ǉ����fc�;�YQ��;~_��ر�KT�w=�U��g���Kx������������SWR�M[OE<�g�+���A�T_�Z��N��p��톱�BG�����Ǡ\\�0�J��*_l��\0���&7��*o�p�&!D �R5�����Ow�r]\Z\"\"��\\(��+j����G��J���!sa������̭3��rqm��M�>@O���Y�.�W�m%>|;��}Ōfs�*��G��a\'�e�ǽ��l�����\0䳌W$�������\0ܬ��3�3����#oR�N?��V�ϓAu��%5{G������t\r߄qu�_������O�_�1�~��\\Ouy4u{�F�r�8�j5# �����.��=9$5�x}���X8b��,lq������D^+�ւ�	��Y3=�x���5v��6ji�3�������Z�U��Q�6������;{������4�l��U])���?�]���ښ>�l�m��w�V��k\Z\ZƆ����ru�Uu,��0��J\"͹��F���kk��VPB�S�Y�z�\r�;{���Yb�í�UAMWK���<5�C�{�R�6���ܭU�\'���5�Z8H��(.�5�޵��ݖ�Or�ûo��\\��5-<6[w��G�\0�[���;�ek�\'UL*�����ndn;Q��)\nɌ��q��-�BG�����y��\"\"\"\"\"\"\"\"\"\"/ǵ�ik�s\\6 ��\n.�4S�K$��jm�����<L�ҳCG�2j���\0e��荎\r�q���x�����v�L/��}����8����]\n\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"/��','$2y$10$JyFpLSU4u0o9flQDNbr.2efBcIUHYehiFcxjgyN1iROaaA1QuqOXa',0,NULL),(4,'2018-10-03 06:40:44','2018-10-03 06:40:44','María Luisa','Del Rosario','Lugo','maria_bends@gmail.com','����\0JFIF\0\0\0\0\0\0��\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(��\0\0�\0�\0��\0\0\0\0\0\0\0\0\0\0\0\0	��\0F\0	\0\0\0\0!1AQaq\"�2Br���#b�$3C��R����&4DST������\0\0\0?\0�(���������������������,�V��*WS��}sF撕���M����}���oye��%]%|�&(�#k;�<\ZC�\'�J��������������뾨�M�,O���Ԟ�x9�\"�a�v�˼�Ov�vy�Y���\Z����\0�!&���W~��!a������b���0��#k��Y�x@�}��+f:sDDDDDDDDDDDDE���^��^NΨc{�f�3�7�:�@T_�c}=��6�0�v��Ɲ�\r�؉<O�y����\n�R�5_�u0o5���k�6��w�ҟ�Z�DDDDDDDDDDDDU��UmE�\0+�pz|u2�i��ݳa�~j�Z( �Z���৥����&�\0?Ev����)�6�6�]�����Q���~a�}n��0X残��tᨩ߫���ϩ*XDDDDDDDDDDDDEX��õ�}I������1���VI{���u�k�킊�3$�?�d�@x����+��Uj�\",V�@��w6�7�q0߬�2}U�DDDDDDDDDDDDE�4��%y٬iq>�V^�SEQ�g�e�Hᇋw�!٬{�q$�`������?��L����� ���W>���\0�և�������g�CEJ��8��y��Ȉ������������mR�Ab�܂��x�-�����m���<�$rT�Mmyvso�\rƃ���R*����;�\r�\r�>ܮ��a���f���<��x���u�����5K��i����e\\�Q�֓���i���������t ��_h���������\n�Ku3�nPRӳ���@Əry(SP�F�v\"�<b7_�_T:#�N�}���\0(���O?��[�Wf���Q���E%��~7��������z�#ٲ��G�|5�T�*$ l\\\\�lO����DDE��>[I�a���ݜ f�G��Y&�{��uB�P�u\'R�b������z��-\'w@փ��-K)���!�q01��\r�Ȉ��������驥��:\'���F�a#��U�M2ּn��ܹ������v���,���J����r�U�\0�w\"�F;q��Z.����g%IfIP�<���o���\0�<Csf�[����\0VD���vٿ�r=��\r>��\0;}&��\rs�P���AӜf���-�n=K?��=�m�:���bԲ�\0a�7���<�1��o/rV��#���2긾����9��-��j�u�P]g����=\\�m�Z\Z?�V\n�\0���@Ѱ�&�`�\"\"\"�e��1�b�y�ۺ��|�������9�*k��j��8��ݪ� s..v�|�G���N��a�=��TЎ����y��\0Q+�DDDDDDDDDU��~�m[�� 缬{���h�U�DE������Zxw�+**��(4���~�\\��f\0���|�G�����#�Ǩ��Q���($r3�c��{�vW����{h�ۉ����N���X�E��W}����o�����PӊZVD�s\'̬�_i|��Z�rlO㧷mCm���.V���\Z0�6��<|\n��ʭ�0��O�n��u$�\"\"\"\"\"\".2��e���]�	����R��w�����>{-<w=U��M��m���و��Ȃ� ���Qmd:���@:�7�g���W�ת�Y��x+-5]ʈ�h>�����*+�]�\n��\0ڊ@�����_�C�w�|q�w�1�[����U�E��_���B��ֿ� g3�鿒��ۧl������:ǐ[�Z���?��n�GM$��Hi�|��R]\0ĥ�\rQeUņZ\ZI\r}k�7<[���;�_DDDDDDEkNUS�c1SZ��k�%�%/����p��=\\\n��E�ZY�Y=�f�UU�n�8�-i=\Z�Ԯ���l�����h���%�;om�.-�1�]��x�}]��t�TO)��iwC���!Dݙ1�����e�A�*�������}������9���k�mr������em�-��.Jz(O�e3~/��kwcǨ��&�Z�����8�y-�.o5�1�*�T�w8i����K\'�`�}�*����\0M�cux�=m����s{ں�����~����9��X�.�7K\r����;�k�GMhcĭo\'o�x���5rE�0L�G�Y�@.�\Zx�;���R�\"(����Y���Ƽ�j��8���;�C\\��eu�J��I�3��� ۞��~�8����lls�pk\Z7s�v\0y�\\5k�Ciꤱi�b���wF�7���6��l�����c:t�CS���ڦ������|�U.`�n;���Jm=.S���Y([ECYX�zjv�K#.\0nO2�|W�r��::H)�hlP����a�,Ȉ����������h��+Լ/�.s ��\r;��#ͬc��X����k#�h\rh\0/�X+���(����8)`a�Idv�c@ܒUG��H�5�&n����C�Z�7v\Z�:�C�cG��=��4sF��{Jʩ�ˆ@��\0����b�^��Q�k,�Y�K��K���sZع���^���>���6��kW	��x�#�2�\"�~;|��E���Պ��v�CIL�����OEh&��Z����V蛏�	����O�I<���XTDDDDDDD_�sX�9�5��z\0���0�\Z��gS���\Zj\"�Ӌ�nޢ6�~��(���}t�ܺ,��O����*��I���w�v��O�E���:ǙIH��r�VV�R��y4x��n���XWx�-t�wt��iH�[��}Pf2�(��\'��g�WH?���i=�����b�w�N�3��ʪg���~��z�]���E3�.��Ԑ�n_4���T�]�>MD�~ζ��q�\'ޣ�p�d~@x,Z-�S����������Z���;44�nz��Tj�_`�{u���0��+h�ց�%�o��l;9g�K�V�ݫ��#�Ι�m�n�-;x�Jʢ\"\"\"\"���O��{8�#ou� ?�Gp�#�2@���-[)u�F\n�Vڢw��h��߄��/�u/%Ʀd�7$P�p�6�n�Դ��=��a�[o�-��VEU�Xy��8uЮ�^W���Ց��\Z���(\0<�p<n�7q��p[]��\0s���A+8+foҪ�+�;�8[�Uݢ��R�K�lq���r��ч�s�	�.��鿢�vh���o7Xv���pp�O�#�<��C�Lu�PP��WY+!���I$y٬h�O���\r���W!��2ÎQ�E\0?����=��Vn�)��E5��:*:z8�Q�F�7�Ӆ���O��\Z��2L�ۓa̫�����$���e�ݮ\0ӧ?�{�����U����,\\����sؾ7���ABj焻���Nqc�q�58�Z��\ZQz��lշ�z^?�J���-h��~���dxh��G�� 5l�����q�H�ۚ����	�����5}[�j�\\��m�|�RV�`p�x|4�kMΣik$/����:~+�DDDD\\��d��nw8��!��?��������hV#���V�;�Ղ�y�wpc�&�b	�>�IKM<5P>\n���㑡�p� �QU�\0M�lU���K���9(K�� �n���yy��m�]a�[$7ߣ�[l��4�Ҵ���\\�ѷ�-*�\"�]�4��Ueƹ��-$/�Wy5���Q�~�Q�:�r�/�q�(�.��ۿHb�\0n|�}U��s\Z���u��pݗq<�4sUg^����q���U-������$L\0th�|�y/���Q�-�Kg��=��J�	��W}�=�Oĩg��i�͛#�T������6o�w\'�R���,1pZ�Qrؽч���ە���,����f��;�p�֓��ߒ�m��;Ut��Xiic2(X\Z����A\r��Yo�oQ:�G\r���uG�׻��5D5�wS��ҳɲ0�\\[��KA����p~Y��%�b_2�\'DOW���<􈈈���N��O�\Zӳr�8y��E/QG4pE&Fְ\0%�]��۱PP�]~�oOJ�ss��\0#}��Ej0�����JJ�:���2�3��G�?V�`=� ���˘^1\n����O}9<0\\�8����<ARc�T-���VS����Nd�y�tU紖�Y+0j��5UUr29���������˖Ĩ�H�:�]��݈�=\r��GO5X�!#�ù�� \0�rZ�GOi���Asu��\0#�\'��w��ۻi����9��G����	���Ao��[ɧg}���>\'�<w�-�}2�W3H1@;���\0[��\"\"\"\"\"\"\"\"�;DY�w�닣k�-�X�ѿ�;;�k�~K����y&e��(�GS�9���p��\'؅ԭNU�۱k\rU��0�������|\Z����\ni��y�ړ��[M�-4��ֆ���\0e��>.��s�o��m���wz�))���v��ԟ@���Z)o��d��.��\0��������Gp���P�t��W�B��=��`�����+Ւ���O*��:yh2��v�<�L[�mw&���p��U\Z�r�i0�M��Gn����覜�I��l9�ȍ�.jv����[��c���9<s��~���w���o3$���MNx���c�����z�������|r�+b���������\'�9���\"���c�����*���WhF_SG_�xM�S,�8����<@t�w�=s���ϩ����Cwe<4�q��|@�!Gq[�Z�y� ͣu���4�I�&�bw�~×&���M�\\2E�靯�R1��d?@c�z��^K&��9]kn��v�qs�3_�&�[�VA��1�RɌR�,��)F�9ỽ��<�ݭM��_#�Q�+�! �^�gk�n=�l7��8�>�ǉ����fc�;�YQ��;~_��ر�KT�w=�U��g���Kx������������SWR�M[OE<�g�+���A�T_�Z��N��p��톱�BG�����Ǡ\\�0�J��*_l��\0���&7��*o�p�&!D �R5�����Ow�r]\Z\"\"��\\(��+j����G��J���!sa������̭3��rqm��M�>@O���Y�.�W�m%>|;��}Ōfs�*��G��a\'�e�ǽ��l�����\0䳌W$�������\0ܬ��3�3����#oR�N?��V�ϓAu��%5{G������t\r߄qu�_������O�_�1�~��\\Ouy4u{�F�r�8�j5# �����.��=9$5�x}���X8b��,lq������D^+�ւ�	��Y3=�x���5v��6ji�3�������Z�U��Q�6������;{������4�l��U])���?�]���ښ>�l�m��w�V��k\Z\ZƆ����ru�Uu,��0��J\"͹��F���kk��VPB�S�Y�z�\r�;{���Yb�í�UAMWK���<5�C�{�R�6���ܭU�\'���5�Z8H��(.�5�޵��ݖ�Or�ûo��\\��5-<6[w��G�\0�[���;�ek�\'UL*�����ndn;Q��)\nɌ��q��-�BG�����y��\"\"\"\"\"\"\"\"\"\"/ǵ�ik�s\\6 ��\n.�4S�K$��jm�����<L�ҳCG�2j���\0e��荎\r�q���x�����v�L/��}����8����]\n\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"/��','$2y$10$8pCrIavkkAOvYxu3Q0FL8OnKl4DjLJ78uqS0z7DF52TqEFkNxzW1K',0,NULL),(5,'2018-10-03 06:40:44','2018-10-03 06:40:44','María de los Angeles','Villavicencio','Marquez','villa_22@gmail.com','����\0JFIF\0\0\0\0\0\0��\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(��\0\0�\0�\0��\0\0\0\0\0\0\0\0\0\0\0\0	��\0F\0	\0\0\0\0!1AQaq\"�2Br���#b�$3C��R����&4DST������\0\0\0?\0�(���������������������,�V��*WS��}sF撕���M����}���oye��%]%|�&(�#k;�<\ZC�\'�J��������������뾨�M�,O���Ԟ�x9�\"�a�v�˼�Ov�vy�Y���\Z����\0�!&���W~��!a������b���0��#k��Y�x@�}��+f:sDDDDDDDDDDDDE���^��^NΨc{�f�3�7�:�@T_�c}=��6�0�v��Ɲ�\r�؉<O�y����\n�R�5_�u0o5���k�6��w�ҟ�Z�DDDDDDDDDDDDU��UmE�\0+�pz|u2�i��ݳa�~j�Z( �Z���৥����&�\0?Ev����)�6�6�]�����Q���~a�}n��0X残��tᨩ߫���ϩ*XDDDDDDDDDDDDEX��õ�}I������1���VI{���u�k�킊�3$�?�d�@x����+��Uj�\",V�@��w6�7�q0߬�2}U�DDDDDDDDDDDDE�4��%y٬iq>�V^�SEQ�g�e�Hᇋw�!٬{�q$�`������?��L����� ���W>���\0�և�������g�CEJ��8��y��Ȉ������������mR�Ab�܂��x�-�����m���<�$rT�Mmyvso�\rƃ���R*����;�\r�\r�>ܮ��a���f���<��x���u�����5K��i����e\\�Q�֓���i���������t ��_h���������\n�Ku3�nPRӳ���@Əry(SP�F�v\"�<b7_�_T:#�N�}���\0(���O?��[�Wf���Q���E%��~7��������z�#ٲ��G�|5�T�*$ l\\\\�lO����DDE��>[I�a���ݜ f�G��Y&�{��uB�P�u\'R�b������z��-\'w@փ��-K)���!�q01��\r�Ȉ��������驥��:\'���F�a#��U�M2ּn��ܹ������v���,���J����r�U�\0�w\"�F;q��Z.����g%IfIP�<���o���\0�<Csf�[����\0VD���vٿ�r=��\r>��\0;}&��\rs�P���AӜf���-�n=K?��=�m�:���bԲ�\0a�7���<�1��o/rV��#���2긾����9��-��j�u�P]g����=\\�m�Z\Z?�V\n�\0���@Ѱ�&�`�\"\"\"�e��1�b�y�ۺ��|�������9�*k��j��8��ݪ� s..v�|�G���N��a�=��TЎ����y��\0Q+�DDDDDDDDDU��~�m[�� 缬{���h�U�DE������Zxw�+**��(4���~�\\��f\0���|�G�����#�Ǩ��Q���($r3�c��{�vW����{h�ۉ����N���X�E��W}����o�����PӊZVD�s\'̬�_i|��Z�rlO㧷mCm���.V���\Z0�6��<|\n��ʭ�0��O�n��u$�\"\"\"\"\"\".2��e���]�	����R��w�����>{-<w=U��M��m���و��Ȃ� ���Qmd:���@:�7�g���W�ת�Y��x+-5]ʈ�h>�����*+�]�\n��\0ڊ@�����_�C�w�|q�w�1�[����U�E��_���B��ֿ� g3�鿒��ۧl������:ǐ[�Z���?��n�GM$��Hi�|��R]\0ĥ�\rQeUņZ\ZI\r}k�7<[���;�_DDDDDDEkNUS�c1SZ��k�%�%/����p��=\\\n��E�ZY�Y=�f�UU�n�8�-i=\Z�Ԯ���l�����h���%�;om�.-�1�]��x�}]��t�TO)��iwC���!Dݙ1�����e�A�*�������}������9���k�mr������em�-��.Jz(O�e3~/��kwcǨ��&�Z�����8�y-�.o5�1�*�T�w8i����K\'�`�}�*����\0M�cux�=m����s{ں�����~����9��X�.�7K\r����;�k�GMhcĭo\'o�x���5rE�0L�G�Y�@.�\Zx�;���R�\"(����Y���Ƽ�j��8���;�C\\��eu�J��I�3��� ۞��~�8����lls�pk\Z7s�v\0y�\\5k�Ciꤱi�b���wF�7���6��l�����c:t�CS���ڦ������|�U.`�n;���Jm=.S���Y([ECYX�zjv�K#.\0nO2�|W�r��::H)�hlP����a�,Ȉ����������h��+Լ/�.s ��\r;��#ͬc��X����k#�h\rh\0/�X+���(����8)`a�Idv�c@ܒUG��H�5�&n����C�Z�7v\Z�:�C�cG��=��4sF��{Jʩ�ˆ@��\0����b�^��Q�k,�Y�K��K���sZع���^���>���6��kW	��x�#�2�\"�~;|��E���Պ��v�CIL�����OEh&��Z����V蛏�	����O�I<���XTDDDDDDD_�sX�9�5��z\0���0�\Z��gS���\Zj\"�Ӌ�nޢ6�~��(���}t�ܺ,��O����*��I���w�v��O�E���:ǙIH��r�VV�R��y4x��n���XWx�-t�wt��iH�[��}Pf2�(��\'��g�WH?���i=�����b�w�N�3��ʪg���~��z�]���E3�.��Ԑ�n_4���T�]�>MD�~ζ��q�\'ޣ�p�d~@x,Z-�S����������Z���;44�nz��Tj�_`�{u���0��+h�ց�%�o��l;9g�K�V�ݫ��#�Ι�m�n�-;x�Jʢ\"\"\"\"���O��{8�#ou� ?�Gp�#�2@���-[)u�F\n�Vڢw��h��߄��/�u/%Ʀd�7$P�p�6�n�Դ��=��a�[o�-��VEU�Xy��8uЮ�^W���Ց��\Z���(\0<�p<n�7q��p[]��\0s���A+8+foҪ�+�;�8[�Uݢ��R�K�lq���r��ч�s�	�.��鿢�vh���o7Xv���pp�O�#�<��C�Lu�PP��WY+!���I$y٬h�O���\r���W!��2ÎQ�E\0?����=��Vn�)��E5��:*:z8�Q�F�7�Ӆ���O��\Z��2L�ۓa̫�����$���e�ݮ\0ӧ?�{�����U����,\\����sؾ7���ABj焻���Nqc�q�58�Z��\ZQz��lշ�z^?�J���-h��~���dxh��G�� 5l�����q�H�ۚ����	�����5}[�j�\\��m�|�RV�`p�x|4�kMΣik$/����:~+�DDDD\\��d��nw8��!��?��������hV#���V�;�Ղ�y�wpc�&�b	�>�IKM<5P>\n���㑡�p� �QU�\0M�lU���K���9(K�� �n���yy��m�]a�[$7ߣ�[l��4�Ҵ���\\�ѷ�-*�\"�]�4��Ueƹ��-$/�Wy5���Q�~�Q�:�r�/�q�(�.��ۿHb�\0n|�}U��s\Z���u��pݗq<�4sUg^����q���U-������$L\0th�|�y/���Q�-�Kg��=��J�	��W}�=�Oĩg��i�͛#�T������6o�w\'�R���,1pZ�Qrؽч���ە���,����f��;�p�֓��ߒ�m��;Ut��Xiic2(X\Z����A\r��Yo�oQ:�G\r���uG�׻��5D5�wS��ҳɲ0�\\[��KA����p~Y��%�b_2�\'DOW���<􈈈���N��O�\Zӳr�8y��E/QG4pE&Fְ\0%�]��۱PP�]~�oOJ�ss��\0#}��Ej0�����JJ�:���2�3��G�?V�`=� ���˘^1\n����O}9<0\\�8����<ARc�T-���VS����Nd�y�tU紖�Y+0j��5UUr29���������˖Ĩ�H�:�]��݈�=\r��GO5X�!#�ù�� \0�rZ�GOi���Asu��\0#�\'��w��ۻi����9��G����	���Ao��[ɧg}���>\'�<w�-�}2�W3H1@;���\0[��\"\"\"\"\"\"\"\"�;DY�w�닣k�-�X�ѿ�;;�k�~K����y&e��(�GS�9���p��\'؅ԭNU�۱k\rU��0�������|\Z����\ni��y�ړ��[M�-4��ֆ���\0e��>.��s�o��m���wz�))���v��ԟ@���Z)o��d��.��\0��������Gp���P�t��W�B��=��`�����+Ւ���O*��:yh2��v�<�L[�mw&���p��U\Z�r�i0�M��Gn����覜�I��l9�ȍ�.jv����[��c���9<s��~���w���o3$���MNx���c�����z�������|r�+b���������\'�9���\"���c�����*���WhF_SG_�xM�S,�8����<@t�w�=s���ϩ����Cwe<4�q��|@�!Gq[�Z�y� ͣu���4�I�&�bw�~×&���M�\\2E�靯�R1��d?@c�z��^K&��9]kn��v�qs�3_�&�[�VA��1�RɌR�,��)F�9ỽ��<�ݭM��_#�Q�+�! �^�gk�n=�l7��8�>�ǉ����fc�;�YQ��;~_��ر�KT�w=�U��g���Kx������������SWR�M[OE<�g�+���A�T_�Z��N��p��톱�BG�����Ǡ\\�0�J��*_l��\0���&7��*o�p�&!D �R5�����Ow�r]\Z\"\"��\\(��+j����G��J���!sa������̭3��rqm��M�>@O���Y�.�W�m%>|;��}Ōfs�*��G��a\'�e�ǽ��l�����\0䳌W$�������\0ܬ��3�3����#oR�N?��V�ϓAu��%5{G������t\r߄qu�_������O�_�1�~��\\Ouy4u{�F�r�8�j5# �����.��=9$5�x}���X8b��,lq������D^+�ւ�	��Y3=�x���5v��6ji�3�������Z�U��Q�6������;{������4�l��U])���?�]���ښ>�l�m��w�V��k\Z\ZƆ����ru�Uu,��0��J\"͹��F���kk��VPB�S�Y�z�\r�;{���Yb�í�UAMWK���<5�C�{�R�6���ܭU�\'���5�Z8H��(.�5�޵��ݖ�Or�ûo��\\��5-<6[w��G�\0�[���;�ek�\'UL*�����ndn;Q��)\nɌ��q��-�BG�����y��\"\"\"\"\"\"\"\"\"\"/ǵ�ik�s\\6 ��\n.�4S�K$��jm�����<L�ҳCG�2j���\0e��荎\r�q���x�����v�L/��}����8����]\n\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"/��','$2y$10$N5i6fh5qxS6YCo.Rzg5z2e7YPPDlxZm30IlBjhjzcovojZxbZx61W',0,NULL),(6,'2018-10-03 06:40:44','2018-10-03 06:40:44','Eduardo Javier','Reyes','Norman','eddjrn@gmail.com','����\0JFIF\0\0\0\0\0\0��\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(��\0\0�\0�\0��\0\0\0\0\0\0\0\0\0\0\0\0	��\0F\0	\0\0\0\0!1AQaq\"�2Br���#b�$3C��R����&4DST������\0\0\0?\0�(���������������������,�V��*WS��}sF撕���M����}���oye��%]%|�&(�#k;�<\ZC�\'�J��������������뾨�M�,O���Ԟ�x9�\"�a�v�˼�Ov�vy�Y���\Z����\0�!&���W~��!a������b���0��#k��Y�x@�}��+f:sDDDDDDDDDDDDE���^��^NΨc{�f�3�7�:�@T_�c}=��6�0�v��Ɲ�\r�؉<O�y����\n�R�5_�u0o5���k�6��w�ҟ�Z�DDDDDDDDDDDDU��UmE�\0+�pz|u2�i��ݳa�~j�Z( �Z���৥����&�\0?Ev����)�6�6�]�����Q���~a�}n��0X残��tᨩ߫���ϩ*XDDDDDDDDDDDDEX��õ�}I������1���VI{���u�k�킊�3$�?�d�@x����+��Uj�\",V�@��w6�7�q0߬�2}U�DDDDDDDDDDDDE�4��%y٬iq>�V^�SEQ�g�e�Hᇋw�!٬{�q$�`������?��L����� ���W>���\0�և�������g�CEJ��8��y��Ȉ������������mR�Ab�܂��x�-�����m���<�$rT�Mmyvso�\rƃ���R*����;�\r�\r�>ܮ��a���f���<��x���u�����5K��i����e\\�Q�֓���i���������t ��_h���������\n�Ku3�nPRӳ���@Əry(SP�F�v\"�<b7_�_T:#�N�}���\0(���O?��[�Wf���Q���E%��~7��������z�#ٲ��G�|5�T�*$ l\\\\�lO����DDE��>[I�a���ݜ f�G��Y&�{��uB�P�u\'R�b������z��-\'w@փ��-K)���!�q01��\r�Ȉ��������驥��:\'���F�a#��U�M2ּn��ܹ������v���,���J����r�U�\0�w\"�F;q��Z.����g%IfIP�<���o���\0�<Csf�[����\0VD���vٿ�r=��\r>��\0;}&��\rs�P���AӜf���-�n=K?��=�m�:���bԲ�\0a�7���<�1��o/rV��#���2긾����9��-��j�u�P]g����=\\�m�Z\Z?�V\n�\0���@Ѱ�&�`�\"\"\"�e��1�b�y�ۺ��|�������9�*k��j��8��ݪ� s..v�|�G���N��a�=��TЎ����y��\0Q+�DDDDDDDDDU��~�m[�� 缬{���h�U�DE������Zxw�+**��(4���~�\\��f\0���|�G�����#�Ǩ��Q���($r3�c��{�vW����{h�ۉ����N���X�E��W}����o�����PӊZVD�s\'̬�_i|��Z�rlO㧷mCm���.V���\Z0�6��<|\n��ʭ�0��O�n��u$�\"\"\"\"\"\".2��e���]�	����R��w�����>{-<w=U��M��m���و��Ȃ� ���Qmd:���@:�7�g���W�ת�Y��x+-5]ʈ�h>�����*+�]�\n��\0ڊ@�����_�C�w�|q�w�1�[����U�E��_���B��ֿ� g3�鿒��ۧl������:ǐ[�Z���?��n�GM$��Hi�|��R]\0ĥ�\rQeUņZ\ZI\r}k�7<[���;�_DDDDDDEkNUS�c1SZ��k�%�%/����p��=\\\n��E�ZY�Y=�f�UU�n�8�-i=\Z�Ԯ���l�����h���%�;om�.-�1�]��x�}]��t�TO)��iwC���!Dݙ1�����e�A�*�������}������9���k�mr������em�-��.Jz(O�e3~/��kwcǨ��&�Z�����8�y-�.o5�1�*�T�w8i����K\'�`�}�*����\0M�cux�=m����s{ں�����~����9��X�.�7K\r����;�k�GMhcĭo\'o�x���5rE�0L�G�Y�@.�\Zx�;���R�\"(����Y���Ƽ�j��8���;�C\\��eu�J��I�3��� ۞��~�8����lls�pk\Z7s�v\0y�\\5k�Ciꤱi�b���wF�7���6��l�����c:t�CS���ڦ������|�U.`�n;���Jm=.S���Y([ECYX�zjv�K#.\0nO2�|W�r��::H)�hlP����a�,Ȉ����������h��+Լ/�.s ��\r;��#ͬc��X����k#�h\rh\0/�X+���(����8)`a�Idv�c@ܒUG��H�5�&n����C�Z�7v\Z�:�C�cG��=��4sF��{Jʩ�ˆ@��\0����b�^��Q�k,�Y�K��K���sZع���^���>���6��kW	��x�#�2�\"�~;|��E���Պ��v�CIL�����OEh&��Z����V蛏�	����O�I<���XTDDDDDDD_�sX�9�5��z\0���0�\Z��gS���\Zj\"�Ӌ�nޢ6�~��(���}t�ܺ,��O����*��I���w�v��O�E���:ǙIH��r�VV�R��y4x��n���XWx�-t�wt��iH�[��}Pf2�(��\'��g�WH?���i=�����b�w�N�3��ʪg���~��z�]���E3�.��Ԑ�n_4���T�]�>MD�~ζ��q�\'ޣ�p�d~@x,Z-�S����������Z���;44�nz��Tj�_`�{u���0��+h�ց�%�o��l;9g�K�V�ݫ��#�Ι�m�n�-;x�Jʢ\"\"\"\"���O��{8�#ou� ?�Gp�#�2@���-[)u�F\n�Vڢw��h��߄��/�u/%Ʀd�7$P�p�6�n�Դ��=��a�[o�-��VEU�Xy��8uЮ�^W���Ց��\Z���(\0<�p<n�7q��p[]��\0s���A+8+foҪ�+�;�8[�Uݢ��R�K�lq���r��ч�s�	�.��鿢�vh���o7Xv���pp�O�#�<��C�Lu�PP��WY+!���I$y٬h�O���\r���W!��2ÎQ�E\0?����=��Vn�)��E5��:*:z8�Q�F�7�Ӆ���O��\Z��2L�ۓa̫�����$���e�ݮ\0ӧ?�{�����U����,\\����sؾ7���ABj焻���Nqc�q�58�Z��\ZQz��lշ�z^?�J���-h��~���dxh��G�� 5l�����q�H�ۚ����	�����5}[�j�\\��m�|�RV�`p�x|4�kMΣik$/����:~+�DDDD\\��d��nw8��!��?��������hV#���V�;�Ղ�y�wpc�&�b	�>�IKM<5P>\n���㑡�p� �QU�\0M�lU���K���9(K�� �n���yy��m�]a�[$7ߣ�[l��4�Ҵ���\\�ѷ�-*�\"�]�4��Ueƹ��-$/�Wy5���Q�~�Q�:�r�/�q�(�.��ۿHb�\0n|�}U��s\Z���u��pݗq<�4sUg^����q���U-������$L\0th�|�y/���Q�-�Kg��=��J�	��W}�=�Oĩg��i�͛#�T������6o�w\'�R���,1pZ�Qrؽч���ە���,����f��;�p�֓��ߒ�m��;Ut��Xiic2(X\Z����A\r��Yo�oQ:�G\r���uG�׻��5D5�wS��ҳɲ0�\\[��KA����p~Y��%�b_2�\'DOW���<􈈈���N��O�\Zӳr�8y��E/QG4pE&Fְ\0%�]��۱PP�]~�oOJ�ss��\0#}��Ej0�����JJ�:���2�3��G�?V�`=� ���˘^1\n����O}9<0\\�8����<ARc�T-���VS����Nd�y�tU紖�Y+0j��5UUr29���������˖Ĩ�H�:�]��݈�=\r��GO5X�!#�ù�� \0�rZ�GOi���Asu��\0#�\'��w��ۻi����9��G����	���Ao��[ɧg}���>\'�<w�-�}2�W3H1@;���\0[��\"\"\"\"\"\"\"\"�;DY�w�닣k�-�X�ѿ�;;�k�~K����y&e��(�GS�9���p��\'؅ԭNU�۱k\rU��0�������|\Z����\ni��y�ړ��[M�-4��ֆ���\0e��>.��s�o��m���wz�))���v��ԟ@���Z)o��d��.��\0��������Gp���P�t��W�B��=��`�����+Ւ���O*��:yh2��v�<�L[�mw&���p��U\Z�r�i0�M��Gn����覜�I��l9�ȍ�.jv����[��c���9<s��~���w���o3$���MNx���c�����z�������|r�+b���������\'�9���\"���c�����*���WhF_SG_�xM�S,�8����<@t�w�=s���ϩ����Cwe<4�q��|@�!Gq[�Z�y� ͣu���4�I�&�bw�~×&���M�\\2E�靯�R1��d?@c�z��^K&��9]kn��v�qs�3_�&�[�VA��1�RɌR�,��)F�9ỽ��<�ݭM��_#�Q�+�! �^�gk�n=�l7��8�>�ǉ����fc�;�YQ��;~_��ر�KT�w=�U��g���Kx������������SWR�M[OE<�g�+���A�T_�Z��N��p��톱�BG�����Ǡ\\�0�J��*_l��\0���&7��*o�p�&!D �R5�����Ow�r]\Z\"\"��\\(��+j����G��J���!sa������̭3��rqm��M�>@O���Y�.�W�m%>|;��}Ōfs�*��G��a\'�e�ǽ��l�����\0䳌W$�������\0ܬ��3�3����#oR�N?��V�ϓAu��%5{G������t\r߄qu�_������O�_�1�~��\\Ouy4u{�F�r�8�j5# �����.��=9$5�x}���X8b��,lq������D^+�ւ�	��Y3=�x���5v��6ji�3�������Z�U��Q�6������;{������4�l��U])���?�]���ښ>�l�m��w�V��k\Z\ZƆ����ru�Uu,��0��J\"͹��F���kk��VPB�S�Y�z�\r�;{���Yb�í�UAMWK���<5�C�{�R�6���ܭU�\'���5�Z8H��(.�5�޵��ݖ�Or�ûo��\\��5-<6[w��G�\0�[���;�ek�\'UL*�����ndn;Q��)\nɌ��q��-�BG�����y��\"\"\"\"\"\"\"\"\"\"/ǵ�ik�s\\6 ��\n.�4S�K$��jm�����<L�ҳCG�2j���\0e��荎\r�q���x�����v�L/��}����8����]\n\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"/��','$2y$10$i.RcVuU9My743MpJMS0i5.dvBuxkrVlYX.rksQ26nWildi8wtHpb6',0,'9P6sch9ouBtQj94sPzziaCOjQfAOumW6mxIjhv6RKJsUGmG1GFFUYQlXVZv4');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-26 21:15:24