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
INSERT INTO `tipo_reunion` VALUES (1,'2018-10-03 06:42:14','2018-10-03 06:42:14','Lorem ipsum','ÿØÿà\0JFIF\0\0\0\0\0\0ÿÛ\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(ÿÛ\0C\n\n\n\n(\Z\Z((((((((((((((((((((((((((((((((((((((((((((((((((ÿÀ\0\0–\0–\"\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0\0\0ÿÄ\0D\0	\0\0\0\0\0!1AQa\"q2B¡±Rb‚‘²Á#$3Sr¢Ñ&4Dcstv’ÄÿÄ\0\0\0\0\0\0\0\0\0\0\0\0\0\0ÿÄ\09\0\0\0\0\0\0\0!1AQ\"aq‘±ğ#¡Á2RbÑá4BñS‚’¢²ÿÚ\0\0\0?\0êšR”!)JP„¥)B”¥JV4‹„8Ä‰2ã²G÷%?‰¯6nö×Õµ›„7ä‡’I!<Sy…›Jdx¥*bR”¡	JR„%)J”¥(BR”¡	JR„%Wµ^±³iv7İ%\0ñDvıçğOó8¯;Jí`DqÛf–Z!9K³q¹(>Hğ\'×§ÇÃFÉ}éR~S®<û‡rÜqEJQó$õª5ñV\\¯]Â=–©‰¶(åo-Ïíæ¶®£íªë)Å·bŠÌz%ÇGxáõÇÕ\Z××=O}º÷y¯uIt¥?úŒº¡êÍ¤´eÇSEzD5!¶°ÓjZ ë„´‚\0ã•‘T\rJµŒL¯fÌ†SÎ\ZæçÇUWØœçhÏ(R“Ôò«Ñz…?Ú[{“äô†Z?¹Køtf¡ÆQl[ßöî¶ñıÈQ5FîE\\÷Ü?ú­ÿ\0ıÔe¾íq¶ãèùòâàËÊ@ıÀÕŞÃÚö¥¶íDÕ³sd§jñå½?‰¨sàË·½ÜÏŠügO!6POÈÖ=+j>†uğX\\c~+ßùÕuí:Ã¨”†é9X‰\0¢|®‡áÁô«Õq!æ¶og}©Í±-¸WÅ»6×Ğ,Î²=ÚO¡çËÊ¯ÑÆÍªx¯Å}’,®Ïé?cö>+£©XöéÑ®P™™ä?äîCˆ9VEhê¼A¦©JR„‰JR„%)J•¤»iíi[ÚvÆöÜ{³$ ò?å¤ş\'åçWÕõYÒÚeÇ#(„¢Y?Dã•şÈûñ\\´µ)kR–¢¥¨’T£’O™5C_/Ãn«Ùû-Á›\\ûåq-„s<ş^}ËäqÒ¥,vY7‡-)¦\"°7?)óµ¦G†ãæ|\0äÖ=¢ŞõÖé\\wÒI=™>€dŸARz¢ìÃ¡»U¥EHjÃ^Bú)åù•xyY­3îªÔyp¥OSryÜíó;A‘‚ì8ît¥•ëÄ¤zt¨åÜ422”Udü*Ä´êËÄÔ¤]¥İ–VJ@B\0kn@\0% •ÖªÒïÉ^—¶µj»»	È¨îŸ·´¥£½YQ=ğRxVAÜAã5ëpº\\ -›®Èrt¤,•ï§c<y=ML\0=Û,ª˜zsNQ9ˆ—I:ímà[’ÔŸ@Á¹*t‹p¹‹´©\nûõ6d>´ïiQÚNU‘Ğc­RÛ‰íwBÅ©§]RœWp’x@ÉÇ…]Slµİ,šB,ÙòcÎ’ÂØa-G@&K€)d¨pIÇ\0ô5‰¥l‰‰>Ù*UÄÄ¸»=LBm÷©.6¤‚Vw#q	ã\'­#˜\\G%%C0ôİÖ%ÂEóbèÊãauç¢nóîxv™Ò=ºÖñ=ìy`¼„¤©Ei*À8ÚG8¯{èÓ6ù0Ğ‹‹¶Ì‰,Énc‚@J²A%¼…cu¯#O³~öø×+µöŸŞ`³¼q·¹Knn	#<­ûäTKø,qd!!-Å¿ly„g!.()J¹$Ğ“À§4uH%AYñ]®¦×\0EÀÌÛó€/µÄµæ µ¢ÚüuÄÚ`Kh?âœ ’PğP ‚<ÅEVÙÕŒ@úÔeÚ£M„ÃE×µ©QˆVä(²¢p0NáŒ£Æx±ˆğ“rµÉí+PO|µl¨ôC¨û\'Èô>£©O)²»ÇŠÌò‘\'{Û¸‘x NÂÿ\0eÚéı%rJZœ³>¯é›ëİöÓüÇˆõ®órmæK8¤-\'!@ô ×ÖğìW)Ä¹¦ç8TP°Ô£áö›ùu?*µƒÄAèİò^{ÚÚŒ8Ú#¬?hçŞ7ìî[ª”¥j.|”¥(BR•©®?Dië•À\0U\Z:İH>$$à~üRJsj81º›.oí†şoºÖRPªÁÌV†z}óóV~@Uğ9¯¥)KR–âŠ–¢J”z’zš°iØí·¹¥Æm©Ii¥¥Ù$6’<@Â”}Xš$î»=:lÀa›M¢C@´éõ>jÇ¢¬ÍYS:}é_×M­÷Y·![^îÊpV¥`÷yI8’	8â±ôÕô:ä×cB…j·ÛâªBÓ\r„)÷0BRõĞ²2¥\'š©Å¼Î|~û½ŸŞ·Fàá …A #W=1/MÈƒ¨ú.sN{	qøh’ÊÒ—[QQ’	ƒœóÒ¥c€ÛBÎÅP{3T¬óeÓAx\"	í±2fd‹,-M©/VËô˜ˆ¹;* Kn%©­6ğÚ¶Ò½ª8ÈİƒŒtğ¯.åıC¤-pÂåF¹8úâEA=Ûn¡ §“´cÓŠñ¸ÃjcÆ÷ªgªî*2\Z‹õå ğ‚ 02I tñ¥ûM»cÌ³]%¶ÒØ’ËñÒêT9I\np8Ï‡1’néô\rØÈmAƒ‹€¹‰OÉH†—û¡!LÌ¨Á¢ók8SERV°<ÕƒçSÖ\\—e©w(R#»h¹¿.|í2ŠòC)*À*.!zU*ÿ\0¤§Û-P®.:™BaNB²B”€±ï…py ‘+#Té«´s©3Õsu×Õ	-npìy8Ê¼x\rÃŠp%º5N°hmP¦ğu’L^Ú‘}´+×JÙoQ5\"\'N²Ü–óÇ›I†²şÒQ:oÁùV0·D±8¹ú¡öæ\\.\"ÚÛ¡Å-Ìç/¬d$gªs¸ús_W[d¸Ö©½Ş¢Lã\0¡2â´ã¥-nVÑ‚FÕÜt£\Z9	²¢ã>ñ]Ërl²ãŠCn(¥²6I)<xyÓ`è±Ò5Ç¤¨øf™æ\0ÜLì/\"ŠÏr-ı¡	‚.7i.nS$©[Jx”6Hl\'¡Vx\0ğ**İ\"Ú™çi¨ÊJc¥bu©n\Z™v\n¥r$Hê¬©±î‚Şõ­½S\ZCâ~Le¥nEŞ^(yØO¥Ut‹oYY»¼{òÒè¤,íP>…$8º½yªÔ¨5ÔŸP†‹u Ä›‚ ÕØ¯\rMjEªäÂì	\r¦DGOU4®™ı`AÔ\ZÄ´Üµ]\"\\\"HŒâ]Fz<¡éó©ù©š6k÷—d›–”NO³º­¤|ÂOíÕV¡uŒ…¯‡=-3N¥âÇ·ü‚	ï]ŸhÍÒ×|b{™-%Ôg®ÍeÖ¶ìæ©ºÙ\\VåA}mvœ(*Ù5»IùØÍqü~İ15(~RGËo¢R”§ª‰TNÛ¥*7g ƒ…<¦šùŸ¸\Z½Ö¸íõ$èÑ2š\'áÈşb¢®b›»–hv>ˆ?˜y®l«…¾Şìı+dµ°´4n7	2u]†[@*W \nYùU>®öÍCÓ–iò\\XS¥B”„}nêCIäzû«Ç¨¬Zq7õuÕ±åÁ,Ö~¹LÚjäi&Ş,\"İuyÇ¶{ZPâ½C{Ğšš³XÛMƒQÜ´ô¥Ü˜\\?e†Jd4¥¸‚B‘È8JTw$qáP«ÑòŒ“ìÓínÛ‰Êg¡|\n’Nğqövæ²›Ÿ\\,¶;UÁøöÖe%oÜ–Öëª!*px¥)O	Y\'­=¶üAT­•íòw3$@½÷Ä@ƒÙe®#¸ûño,»d¨Ì¥·ÊZRJÑ>=sSº^õ&6”¸K½À‰&q(¯Hl‡*#k!@‚¤\'Ÿ :*wQ^äØ®‹Õ¾Sî\":^äWö>É$Œº¦Óİ¯İ\0åHñëUËûP®l¢}İİ^Â1„»22^m\0ôÁÊ¥<Œ®$ª”êûÅSªÈm ƒ&9\0/¦ûë\n%Íi|zDfâLrİ¬6ÜX*SM!9ò§“š˜¹Ş]Gkêzé-åÆ‰s[h.,Ê7‘Æz×åQtåªäµ\"İ{˜úÒ7))´8¢‘ë±F¬p&¿:Ib%õ¹7D—ÛÓª\\¤íà’¢3‘Ó\'ŸZksn|¿u=q‡i=#ªAê¸1yÊ{n ¯–çtzÏ<§é[ƒÉ[©;c´NÂOë¯*‰©Eîi	,+‡ZµÚÒ´©%Çƒò#÷×ì“Ê/2Iz¹78â\r‘2×™Ë«%5ò˜Ïm÷š·ë;¨¸íu×;¤6™NRwmW<b—×‚„ÔtƒWPA&âLœuE®v_‰íAÿ\0Æ¿ø…4eÆ5’Øİâéc„Ì†Ø¯i–ÿ\0mJ<É$\r£©=?*æ‹òÒa ³ìNLz;²]e=ŞÄ@FºH	ä×5X¹iûÕÆædj¬/fIÚ©îNihJ]ˆ\nİğHHø\n.:Í¹ºcrUš5ˆkr¶os A‹÷“È/»e½»f¤ÔVT,¼Ãö×Ã=Vì>Ú¾;RÆ©uu³Ü\Zºö˜%EJ‘M¼ÛIWPÒ\"-	Ï®ÔŒÕ!Q?\n…ñæVÆ0yÔµ„÷Ü%º&Ù*ïÑI÷T†]Hõ`ş\"·hÉÅ\'óŠì¬p\"¤göÇúVş­\\øAsj\Z|nJR•iyôªglPŒîÎoH÷šB°´¨ıÀÕÎ±n›¸ÛeBû)\r)¥|şt×·3Ky«JŞï]•¿)ÀÊâú›Ò÷±]•èHµÜ\r>´Œ–ˆ9C x”Ÿ\"GENŠì²\"Hy‡ÒÇë$àş÷ka®ãº2ÛÏ¡µ|\n€?yö’\níC*Ò3¦¶ñy…oNşnÌoö;|Ëƒ±Õ2EÆr¸±Ø 7q‚O\'*\0W•…¨wYúzòÔ(ğŸMå¨o7%,¼8XZR~©ÁEd3«Xj;mÑô®×1çÙKrSŞ0ÊÂıÅ~ºÇÇÂ±œL„\\¡Î¼\\,Ğ-6×Cì1kyµ÷ªèÛA\'rˆ\0©xÇÀb­u·Eç¾9¦=b&dŞA°ÜÄm§[Ô(z¦ŞØ{.*ÍíR±’·Qõ\'wŸÖÎ¥Wû>üá¾_ÚrSó$Úd,Çš¹/åiX))÷\n¹àsŠ’µI´^µœ»ú®!ÀôI\nU±ÆÖ—Sˆê° 6í	\nÈè8ÍGMÔV”Ş[¼¦ë2P‰—-ÖÏdî›¬{€Ûv¤ã;FN9ñ¥\'BM§š´È¥Nœ8°r›µ…¼ ZdÂÑ¢Ù§¬¡spËç½EÊYîYSÍ‚İ²xêW9ÀÈç	¨ºv]şå.S÷{›°}´¸„£<•<ÙÊV•}ìx„qP:’ÊåæL9H¸C„6˜WLwJP€0¤’	\nr|kÑ«•ª%¬i×nˆp{ìªzRÙC:ÚÂŠwõ€ê¢qŠ3E£MhtŸ8¸¼ŒÀ\r\0ívˆ /NÌo)•ªfá%Qä\\g±).!\'jÜKŠ%²‚ƒŠY4Õ×fhrÔ)%ø¬LzráDP	\0ıÀã#Ö£ìP-Ú~óí3P[_j#©|3¼qÇvœ„€R\0Ï™#ÕÂ:4Aµ•ŸlöôÈÛ´ã`h§9é×Â£ÎCrÕ{İYSÓÒ:»ZÓ;l\0ìVi²dÎƒI}âŸeˆvï8Ï|¡U]P\0Ô×|ø·¿ŒÔ£÷ˆnİ4›ÉYîà1¹I#iC¥JøğkÖë§¥ÎÖW¶–¤Ea§œì—s±\r©~ê†9Vì rsÅ5İaoVSaòáÜícÿ\0¯äx¬]Ü«¬å¢¶JÁıe ´>÷*¹W]QnoIY\r¥/)ù·BÜ—VZSE1ÓÊR®A+É#õSTºcÆXiVğ¯‹«·C\0wä•»ÿ\0&ØE-_g({«SL\'öB”‰5ºê‰Ø­ Ú´580ôÅ*R¾\nú¿å	«İlá›–•ñÜ@Äq\n¯\ZLx[ì”¥*u’”¥(BçNŞ´á¶jT]˜o.#ß#¢^Ÿ†F©İZÉ§Ë¨u£‡PZO‘\"ºóZièú£OJ¶ÉÂJÆæœÆKnª¯õóŠäËµºU¦å\"ö‹R˜YBÒæP|«G#ó\r\néşÌq&âğ¢ƒÏ]–ï±şT¶»dê®,ÿ\0º]P\'2sœoåiø¥{‡Ê²\\·³¨íÖ÷­NÁbá\Z:cH†ë¨aN“‡T@VAç \ZÅ²O‰*Úlw§QJË‘eäÅtõÈê[W€ñõù™x3„u0ÒXRèš\\Ì[HÉXs¦1óô¨&VaI¢›İ•ÌĞûÛQ¨=šÚgE‰£¬1[’ìU\\W\rÕ\ZRVò}R†B[Cg}âsY×\ZÔi’ŸœÒôâåÄD5! *Ú\n¶¸…°:ı’p|j6v’›ƒ	Â¸ñfCŒ–\\’âóK;Rê^NR“ƒÀõ‘,µ§#¹NŒİ¢,WÚC\rÉCÜŸu²‚â…+jA İ‰©î&E–<µùKš¬™ñ®º5±3a;RDÓó•wsvq0mfBŸÛYZKêJRNÓ¹JR¸ ãÒ¡mØ/vÆ™‰cµ³)µ©/ErRš}h\'İ[O-A%@pB¼yÆ+âlèL±hpR‘l¸ØšŠ§ĞİÒĞáP^>ÖÕ¤dqPcIaÍÒ/–4B&Bf%|z6=ò}1Ms¤Ø)ğôZÚyj=Íƒk˜Şl\rÌÍµÒÒ}’ÅaÓ3m÷µ°ÂVør’Ûo¾êWµIY	VäìÂ’FBNN3QÚ±v‹~œ‡jŠ´É\\¨.6è(kkŠ^Kês%Y#)ÙÓÖªZr/7v›¶2ò¢Æa¸‘‘·.)´<IÉôÎ*zıßpfÎõÆêİ¸F€Ôgã8Ã†Nä•gj6àƒ	 P^†ÄöaHÓ}w¸’sxµ€\'¾ı‚Ë6è\"Fª­ßGÃnÙjdEiÒÂ{åÉŞ”¥eÌn$ájÀ8ÀéYé×Öm:~Å\näôbû*Ÿ2IÂ½–7DaG”„ qV\0¯©2­:Ù’&mª¿2f­L%i‘€RÁu@ƒÉ8Ï5^Ö:µ«£’X²D0`=´8TrëÉ@$p”$„,œšW87¬¯VQQ¤úñD²àË¤H\0Í‰7u§iæ¢5mÜß/òf$¸Xá¶„•’6§$øàdú“^š2Âî¥Ô°­…wn//)?a±Ê|8àz‘PuÒ}‹èÓ§¬Ê¸\\ÛsœJHå¦ú„üOSò\nfµKüÕÎ/g\nÁu,b\Z>ÿ\0-ÊØ¬4†CL !´$%)HÀ\0p\0¯ºR·$Õ)JP„¥)Bµ÷jÚ\Z®™kw†„Ày? ¯ä|+`Ò˜ö·+•œ&.®¨­DÃ‡¨\\S*;Ñ$»SKeö”P¶Ö0¤‘àEIX5ÖÀú¶My¤nS;‰m~ŠOCšé -º¹‚â±æ„á¹HNIôXûCïÎº¯IŞ4¼’İÖ*’Ñ8D„{Í/à¯?CƒYh>‘§5Ó¸oÂñj}Àİ§~î~jÚ5;×ç{Øw¤D}IşšÓuÂ¡»ã„(ğGE`TmÎÑ([—›ÖÈáçÚ §Ú\"ŸÖG§øVG•Që:Ûx¹ÚÒSm¸Kˆ’rRÃÊ@\'à\rGÒæü^½v+C‡\Z?Ó˜ú}F¿îïV»QA³j‹ÈåeHqŒFÕŸ¥Ä	ñÁıõßgÓ¸­ıO\"fT’øi™L¶äœŸªØ%)HÉêp\0è*¾æµÔËAJ¯“°x%.m\'æ9¨)½%õ½%×y|©ÇT£ñ\'šRöF“ëæ‘¸LVbCƒgSOÌy°ô 1ncÓğG˜×6ROªÖ•¬ú“ò¨y±íi“ßê-FõŞ@CPw8HyÌ\0>US¥4Ô”Ôğ%ŸİÀ{É“õÕ1y¾¹>3pbGnßji[‘’H*ı5¨òµcÄü€¨cÀÉéY–«dë¼ÄÄµÅvT…tCc$zŸ\0=O½û;ì™‹JÚ¸j>îTäûÈ9i£æHıÃ×­:\'Ö6Pc¸–„Ó‡ì§Öä¨NÇ{8[±¿²RÚHr$eT|Pòò:Şt¥lR¤ÚMÊÕËø­Äk\ZÕ~C`”¥J¨%)J”¥(BR”¡	^R£³)…±%¦ŞecjâB’¡äA¯ZP”…¬õc–’ÖíµnÚŞW8kßo?á=>\0ZúçØÆ£ŒTa=\njM«-¨ü•ÀıõÑ´ªÏÂR}âæÚN!†CóÕ®¿UÉò;;ÕÑÎ°Ê?ôÔ‡?…F¾\ZĞ\Z­ÕmE†nY!?y\"ºÎ•¸3™ZcÛ,T^›~¿ºæ{od:®XDx°şığOù7UâÁØŒ6®ûpvZº–˜Ò>ò£òÅn\nTŒÁÒnÒ¨b}¨âÄÒ>æJ³Y­ÖH¢5ª1Yñ\r§õ\'©>¦¤)J²\0ïsÜ\\ã$¥)JTÔ¥)B”¥JR”!)JP„¥)B”¥JR”!)JP„¥)B”¥JR”!)JP…ÿÙ',6),(2,'2018-10-04 20:35:36','2018-10-04 20:35:36','Edd\'s','ÿØÿà\0JFIF\0\0\0\0\0\0ÿÛ\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(ÿÛ\0C\n\n\n\n(\Z\Z((((((((((((((((((((((((((((((((((((((((((((((((((ÿÀ\0\0–\0–\"\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0	ÿÄ\0C\0	\0\0\0\0\0!1\"2A#47Qas±%BCu³FR„ÄVfq’¤¥´ÓãÿÄ\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0ÿÚ\0\0\0?\0ªa@!ÔÚÑ­T]=•š§Ê8İBêOjDPÎàH[Ê\0;ÜrŸ[€lK–â¤Zô§*WFZŸ$ŒãëÛ¹A%[R<©D$á)œpOWßURåék\"©ÇR¢”ÎÔ2†ï%¤ÊJ“œeH###‚\"l½ïZıïUTıÉRzmaD´ÉQ\r0\0†Ñá#	NqÉÆNO1ı³l{–ô™[Åf|·ï¸œ!´g\nqD%$ã€NOÂÉ®]pÔ+ƒ¸‡î9™&Åä5NW·ç@)\0ã\nQÎ9#1Ö*õ*Ôá›¬Ô\'*e!é·”êğ<\rÊ$â)‹S¥•0íÛq¤\0Uİ•¦5œŒ»^sÇ8\'-ŸˆûÆÇ¢ôß§TéUµ7Oª¸¥•§\'V•¤`\r 4PœpO#<|`!(¯z.«TªT›‘ŠFvm‰3*Ô³OÌ-Ä0®zP’HHàp1à}‚&-B§ÊÒoë–›Ok³%\'S™—a½Å[CªJFI$àÉ9ŠC¡ï ]ÿ\0‹+ù;PB‚„ „ „ „ „x·ËN³íŠ…z²§#$€¥†‘½j%A)JGÚT¤œy dÀk¾¢õWú<·•£=,«š†_©Rírå8 à©\nÀ$“êRb›™~rié©·œ~eå©Ç]uEKqdä©DòI$’Lzw…ÇP»nj…v°´*zuÎâö% \0”NÔ¤Œ’pIó4GèNÏ×[ùcPX§È…g¦òÓÏáCqw#rpS…œ’\n@U½.#IjJ•\'-#$Ö{ròÍ%¦Ñ’IÂR\0$Ÿø“ŸNºîšš%­{æl&¢’©¼®&G€Ûª?¼û}ÿ\0ÕÊéh)B›:¯õ¥xÿ\0œşzâ†è{èâÊşNÄóªÿ\0ZWñ™Ïç®(n‡¾wş,¯äìPB‚„ „ „ „ %õ§w&b£G´¥\nL¨3Ó¨IB€qCkI\'ŞJ‚JÎ8Èu\'1ZG6uRàı)ÔkŠ²™ŸjbfuÏg{·³s	;\Zôàói@ägyÌÛI¬ÇïÛò™Bh8%œ_rqÔgæ¥ÓÊÕª	$zRHÆå$1Ÿõ¢¯ØsNW-æÜ~Õy|Œ•.Adğ…Ÿ%²N³÷%\\à¯gtYkû%¹Z¹¦YÃ³Ï	Ie9/…›åjC‡ÊTµm q–y$(é¹f\'%^•›e·åB›u§R‡F\nTH Á´Š[§]wU-rÖµñ7šiÃrU\'•Ì±ğtŸİıŠ>çƒéåÇPº*ı‡4årŞmÇíW—ÈÉRäOYò[$á+?rUÎ\nô„T!N\Zçò7²Úw¬×ê®\Z¨º¯¢üNû¯€Q÷<F\n+Ø+›:¯õ¥xÿ\0œşzâ†è{èâÊşNÄóªÿ\0ZWñ™Ïç®(n‡¾wş,¯äìPB‚„ „ „ „ <›¾¬ª§[¬! òéò/Í†Š¶…–ÛRö“ğÎ1Å“j¿Õmãü\ZsùlÁ+¢:H4Mµ%Kİîä˜›İ·n;ê/mÆO»ÜÛŸ3ÆqübºQõ[g“şB#*‚´?X·*)ZhÅ\nlÌÖ¦R’…¡DöZ!Å)$pXdsä(à|DOG\\ŸØ¯ó¿éâl´é¤M\Zßö”gY”ïlßÛî,#vÜŒã9ÆF~Ø#ÊŠO§\rsùÙm;ÖkõW\rHT]WÑ~§	ı×À(û£ßPº*ı‡4årŞmÇíW—ÈÉRäOYò[$á+?rUÎ\nô„Uªÿ\0ZWñ™Ïç®(n‡¾wş,¯äìIñXt=ô¿ñe\'`*BR„+õ#\\6³Ó§m©ŞÏz.&%ÜH[S	LËä%i?â7(+dÆôÒE¤jE¸š•)]™¶°‰É¨%œ?ıäœ«ÆÁ\nHÒ„„á¯ÒØ®Pª4™Âà•Ÿ–rUÒÙÂ‚’•`óƒ‚c—±Õç§Pvûöî¯ÜŒ¼\\[s“*¨2êÚ-…¡ãÜôç;‚T¥#pòP|r*½éª²ºÖ‹ÛË~m¹™™T.MÀ‚œ´Z’Úà†ƒ~y ‚sœŸD÷AKõûQíÅ*H©Ëá#h#knäç99gzUããVAZ+¬;xU4¹º³hc¿G›mÕ8¼ïì¸{jJ8ø­M8GÜ”tˆ¶5VÎî…ü¯)§=äãü3ŒıÑÑšµ>V­Jœ¦Ô\ZïIN2¹wÛÜS½µ¤¥C ‚2	äÄ¨_Gu2QôË÷%e§S=I˜ÖÜÃm¸²¹Pô…¤m œ\nI# 3rÌNJ½+6ËoË<…6ëN¤) Œ¨ Aˆ¨]~Ãšr¹o6ãö«Ëäd©r\'„,ù-’p•Ÿ¹*çv½&¡+V¥IÔ©î÷¤§DÃm)ŞÚÒ“‚pFcë7,Ää«Ò³l¶ü³ÈSn´êBâÁJà‚	+–‘Xt=ô¿ñe\'c_u¢¯ØsNW-æÜ~Õy|Œ•.Adğ…Ÿ%²N³÷%\\à¯`ô=ô¿ñe\'`Š‚„„#òÕª´šTåJ ïfJM•Ì>æÒ­¡%J8\0“€\0fêÒªıGZ*¯!´·M–—”d T‚€öU“ÉÜò‡à¼wc]Õ{\"ã—­[ó™¦½*B¹mæÎ76âi\' €A<û†ªıv¿S«Í¡´LÔ&]›u-•¸²¢	\'\'&<ø#¤š]|Èj¡-]¦¶¦\n”Z˜–Z‚”ÃÉÆä<AŒ…@<² >œ/ÏĞ}F•öÇûtj¦$çw/FOÍºr ‘±XÊp…9“ä„!\0‰³¬»#ÛèR7”š>~¶RwŸ,-_6®UKŠ#$îIÂb“ËV§ÊÕ©S”Úƒ]é)ÆW.û{Šw¶´”¨dFA<ƒ˜jYw-BÏº)õê2›Lô’ÊĞFä(”©*aJ”0yàƒƒ µkÒ7E¹N­Òœß%<Ê^o%%IÏ”+i )\')PÉÁ|#ŸÚÃ§•\r:»¦)óL¸i-nS¦”­ÁösÆT\0Ò\n<‚’r®œµi\ZuY˜§Öƒ[µ%¤¼¤•(Ê88î¥‚ ,¸„¤Œí	QdxÍ£H½íÉŠ-Á/Ş•wÔ•§‡pgk«öT2yğA ‚	Ú”™brU™©G›~Yä%ÆiAHqd)$pAD}`­m¤ö­Ã`½3l¼ìµFÏoºı*spDÌ¶V•@\0/%Å¨-?ÜVq¹)NÉ„ >SrÌNJ½+6ËoË<…6ëN¤) Œ¨ AŒK4ÊSNkW2¨ï•Qê‹eÙvI\\±OsseGŞHÜ6’sHÜ­‰!L]aê+lÈ\"Ä¦«sïöæª.%HRPØ%HdHQPC‡İ y8Ùúá«Tí4£6œ¸¦Lœ‘<$xî»C`ƒÇD`c\nR`ŠµBj­Uœ©TïNÎ<¹‡ÜÚ½Å¨©G\0\02Ià@~ë:ŞœºîŠe\nšœÍO<–’pH@ò¥œsµ)Gî3¾¡ô×ú;¼¿W·¶Ş©nvŸ—»ŠFĞãjÏ>•(`œå%>¢wc|ô›¦oÛTg.Ú¿oÛ«Èm¡D–eU…åD¤¹†ÕŒ‘ÎT¤‰®vGéöœÔiL#uIœMÈsŸ@8O*Hõ$©QÀß»#ÑĞ>œï\'¯M-§ÍO-nTdTióN¯$¸¶ÂJVTI*%\nAQ>TUÄsò)n‰+kjä¸è%µ)©™DO%}Î-, €œyWxs‘î9à+¨BR„ªÚuHÔ‹qTÚª{3MersÈN\\–püG÷’p7#8 %B¾m\Z½‘qÌQn	~ÌÓ^¤­<¶óg;\\m_´“ƒÏA0Œ[Pl+zş¥&Fä’öÂŒ¼Â±éu(`©\nàpr’R2 \"} ÖJöœÍvr«BR\nM1çÊPÙÉPSJÁíÊ$àaY9ÁM¥§úkß²¡Ëv¦Û³!İ’wææ\Zá9ÜÙä€VTœ§<5SB®‹Ç¦¥Yr·Bmf¡*Ö~’¥w\ZJ@NÒJ¹N6ú;F§mjmÄ­µ)I\nJ’pA0GS¡=¥Ô [ˆm¥UQW–m*JZª7Ş9*Îâà!ÅÈY\0q65/«9æä\ZEVÒ–™î;-<¦W\'B²8À÷H\'ŒàYB%ëoşåİøÆ7_êì›rmZU\"›,ê6²\\Jæd”ãvòR…rFQ\0ƒÎBÇ›™bNUé©·›bY”)Ç]uA(m\0d©Dğ\0\0’LNúÃÔ:’ÜÅ&ÁSu*‚¶ÕSıÄªÂ¶úF8\n ûœ¤åc\"&¾ûº/«’¹=>Ú–—;sk	ZS´)-\'IÆy	OÚcÌ·¨•;±-K¡É=;?0 –ÙhdŸ¼Ÿ	HòTp\0ä ó_¬Ôn\ZÌİZµ6äåBi}Çpò£ãÀà\0\0\0\0\0\0\0P}8hgË>Ëv^²¿ª¸vBœê~•ñ¸î¾!\'ßò}Ê´c§	Z^*ºŠÌ´üï¡rôÔ8TËaDºFŠÏ¤£”`pÛIÀ!A\\ùê2ƒú?¬w(ne,M¼\'Ú[ãÎğYIÀ!ÂâF<mÁ$ƒ¯J5	©-l¤1,îÆ§™˜—˜NĞw¶S€r8õ¶ƒ‘ƒÆ<#7ëv’†n[b°QrnQÙBŞ8Hea@ƒöùÿ\0”F½é{ëÒÙÿ\03ÿ\0Šì~B‚„ „ ¬oı²oY¥NNH9N¨­{İ›¦©,­ÒJ‰Ş’’…TIQNãÎ8	\n»Ò}mÇÈ7-6w;»¾ÚÂåvxÛ·osvyÎqŒ9ã›éçRØšy¦¨\rÌ¶ÚÔ”¼Ôô¸C€$)aX>F@?h{Bş¯ÚşÌÿ\0×Êÿ\0ìj‰Ó. TeVìÚi4¥¥{C3“{–¡€wÒVœsH<<fâ„ålt©A’š.Üuéê«iZ†eÙ¨P•%Ã¹j!\\IAóÈÆõ¶-z­\"%-ÚT9©J½ •9´`«ŞZ±ûJ$œœcØ„„„¯×\'ö+üïúxÅz0§{N¦Tg\\“ï5\'L^Ù…5¹,:·	Â±éR‘İâFÿ\0†c ë‚¡*åVÒ¦¡ÜÎË³30ë{O¥·ÚPsŒ–œà¼ùÎ:9¶“JÓyšÛ‰G´V¦”¤­+$–Y%´¥@ğ_xñä(düê„„!\0„!\0„!\0„!\0„!\0„!\0„!\0„#À¿®y[2Í«\\ÉŞÔ‹%io$w\\$%´dË)Np@ÎOGÖ4¿ªİH¢İ¥8ßm…¢’—ĞÙkræ µ\rÅ\n/p1¸ œäÙ´š|­&•\'M§µÙ’“eì7¸«chHJFI$àÉ99ÓVšÌ[§®«”N*ì­%J}3gÖÃj^ì+’JÖBV¢®AÂpVwl„„„„„„„„<Z­ŠÅfŸ5TíÌÊS–™™IU40‰¡¸Ô£Å)V0IRã°¡j„„ÿÙ',6);
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
INSERT INTO `usuario` VALUES (1,'2018-10-03 06:40:44','2018-10-03 06:40:44','Mayra','Villavicencio','Marquez','mayra29109@gmail.com','ÿØÿà\0JFIF\0\0\0\0\0\0ÿÛ\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(ÿÀ\0\0ğ\0ğ\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0\0	ÿÄ\0F\0	\0\0\0\0!1AQaq\"2Br‘¡±#b’$3C‚¢R²Ááğ&4DSTÑÒâñÿÚ\0\0\0?\0µ(ˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆ¸,ëV°ü*WSİî}sFæ’•½ì£ÜMùµš}­øoyeªß%]%|&(ë#k;Ò<\ZCˆ\'ÑJˆˆˆˆˆˆˆˆˆˆˆˆŠ¾ë¾¨İMò,O‹¥½Ôê¦x9¾\"ÃağvÜË¼¯Ovšvy±Y©ã­Ì\ZÛİáÿ\0Ù!&ˆíŸW~€í!aµâúƒÔb”´ò½®0ÒÆ#kœÉYÀx@Û}Éú+f:sDDDDDDDDDDDDEÇêÎ^Ì¹^NÎ¨c{ªfµ3¹7ä:Ÿ@T_Ùc}=²§6¾0Ëvº¹Æò\rÜØ‰<O÷yßäš°\nªRÌ5_µu0o5’Á±kÇ6–ÂwüÒŸÁZ´DDDDDDDDDDDDU«µUmEÿ\0+Äpz|u2¶i‡İİ³aÆ~jÅZ( µZ¨íôà§¥…Æß&´\0?Ev•ÔÜÌ)Ô6ù6½]ƒ ƒ„üQÇÑò~aê}nÎÂ0Xæ®‹†ótá¨©ß«·ÁÈÏ©*XDDDDDDDDDDDDEXìŸöÃµÍ}Iøé¬ÁûÌé‚1ş·¬VI{ Æìu—k¼í‚Š–3$?d@x’«•Ú+õ£Ujóœ\",Vé@¥§w6—7œq0ß¬ï2}U®DDDDDDDDDDDDEñ4†%yÙ¬iq>V^ËSEQg¹eÆHá‡‹wÏ!Ù¬{äq$ô`´¹…öíÚ?ƒÆL´ø¥øæ¨ €àÆW>¡ÿ\0Ö‡Çíøµ‚Ïg€CEJÎ8ø’y’¶Èˆˆˆˆˆˆˆˆˆˆˆˆ¹mR¼AbÓÜ‚º¢xá-¢•±—»mŞæĞ<É$rT¯Mmyvso“\rÆƒ¡³ÍR*®ÁÈŞ;Ä\r·\rñ>Ü®®aœ†Óf‹§Å<îòx¹Çôuˆˆ‹ˆÏ5KÁ«i¨ïõîe\\ûQ™Ö“·¶èi¬å‰ÁñÈĞö¸t Á_hˆˆˆˆˆˆˆ¼÷\núKu3ênPRÓ³›¥@Æry(SP»Fãv\"ú<b7_î_T:#ÃN×}ş®ÿ\0(Øù¨O?±ê[‹WfùìòQÛéøE%€³~7†¾Èç¿¹¼z«#Ù²×³G¬|5’T‰*$ l\\\\÷lOŸÂà¤äDDEÌê>[I„aõ÷Êİœ fÑG¾ÆY&´{ŸËuBíPİu\'R©b­•ó×İëzş¼-\'w@Öƒòú-K)©¡‚!´q01£Ğ\r‚Èˆˆˆˆˆˆ±ÔÆé©¥’:\'½…¢Fõa#¨öU‚M2Ö¼n¢İÜ¹ÕôååÍâ­vîÜõ,”ƒìJüıÒírÕUÿ\0èŒw\"ï¦FÍ¾qÖZ.ÍÙò©µæg%IfIPò<ƒäÛoÀ©ƒ\0Ò<Csfµ[„õãÿ\0VD²ºvÙ¿år=®«\r>–Å\0;}&á¨\rs¿P¦ŸAÓœfœ‹-Ğn=K?ªé‘=ím™:õ—ÓbÔ²ÿ\0aµ7½©á<1Ÿéo/rVã±Æ#ßÖİ2ê¸¾¿±Ñî9Èö-ù•j‘uíP]gÅííë=\\’m÷Z\Z?ßV\nß\0¦·Ó@Ñ°Š&°`ô\"\"\"Ôe÷È1¬bçyªÛº¢§|Ä·ù‡Í9ë*k¯÷jŠ‰8§¹İª‰ s..vû|ÜGô¯èNšãaØ=¢ÇTĞõÃíÊy¼ÿ\0Q+¦DDDDDDDDDU¿´~×m[ÓÛ ç¼¬{‡£æhıUDEŠ»×ÉÃõZxwó+**óÛ(4·§~Ó\\¦ïf\0óî™Ğ|ÜGô¨·²®#ûÇ¨‚íQ¾ÈÁ($r3Äcıç{…vW€şÜí{h§Û‰–Ø¿§N“ÅáXôE®¼W}‚Šªo…ŒŸºõPÓŠZVDäs\'Ì¬è¨_i|äZ³rlOã§·mCmúßê.V¯³î\Z0Í6·Á<|\nÑôÊ­Ç0ç³OİnÃßu$¢\"\"\"\"\"\".2ÔÛe†¿ö]º	¯¢î¢Róáw“±çè>{-<w=U¹°M¦×m‰ÜÚÙˆãÛÈ‚â ³Œ‹Qmd:ëŒÒ×@:š7ügäï÷Wº×ª¶Y¥÷x+-5]ÊˆÉh>ãŸâíí÷*+”]í¾®\n˜ÿ\0ÚŠ@í½öè«æŒñ_»CçwÇ|qÓw°1Ş[ÈßôÆUE§½_©­¤BÃßÖ¿“ g3¹é¿’ù±Û§l®¯¹êé:Ç[¤Zœºñ?‹İnóGM$ÜüHiØ|ÎÁR]\0Ä¥Ô\rQeUÅ†Z\ZI\r}kœ7<[µ§ï;ò_DDDDDDEkNUSc1SZ‹¿kİ%ú%/ø›¿Öpõ€=\\\n÷é®E‡ZY»Y=ŞfñUU¸nç8ó-i=\ZãÔ®É’ål¡¹ÅİÜhéê™à%Œ;omú.-À1û]åx£}]µÔtòTO)ÛáiwC¹ğğ!Dİ™1ì™ØíÖıe¹A«*û·¶¡›÷œ}÷Øø¼©®9óØ÷kémríö÷ÛõÑem³-¸ì.Jz(OÖe3~/ÇşkwcÇ¨­&ºZƒõ§”ñ8ûy-Â.o5Î1Ü*ˆTäw8i¿»‹ëK\'İ`æ}ú*¿­šÿ\0M™cuxî=m©§£¨s{Úº‡€÷µ§~Á¾À9ïòXû.æ7K\rş“¤Ç;úk­GMhcÄ­o\'oõxÌüÏ5rE¬0LıGÓY’@.î\Zxâ;ŸÃ‘Rê\"(»´¥ìY´–êÆ¼¶jòÊ8öñâ;¸C\\¶Úeu‡J±êIÃ3éş“ Ûòş~ 8’îÑällsäpk\Z7sœv\0y•\\5k´Ciê¤±iÔbºàçwF¼7İ6‰¿lïãÓÈÊc:t¼CS—êíÚ¦’‘‘š™â|œU.`ün;†åŸJm=.SŸÓÑY([ECYXÊzjv’K#.\0nO2í¹’|WôrŠš::H) hlPÆØØ€aú,Èˆˆˆˆˆˆˆˆˆ«¯h‡»+Ô¼/§.s ¨©\r;ìí·#Í¬cÏÍXˆØØãk#¬h\rh\0/¤X+ªéè(§«­š8)`a’IdvÍc@Ü’UGÔÍHÈ5ƒ&n§ÑÎÛCÜZç7v\Z:¾CöcG¯=€›4sFìÚ{JÊ©šË†@æÿ\0±íå›bê^§òQÏk,îYßK€ØK¥ª©sZØ¹“¹Ü^äìâ>êôŸ6ÑkW	šÚxæ#˜2¶\"÷~;|•İE«Éï´ÕŠ®ív˜CILÂ÷ÔùæOEh&¦åZƒ¨—£Vè›Ç	‘°ÀîOİI<÷ßÕXTDDDDDDD_sXÇ9ä5­’z\0«¾‡0ç\ZÁ–gS´º–\Zj\"áÓ‹ánŞ¢6€~ú±(Š£ë†}tÔÜº,€OİÊø*©æIğ½wèvßÉOºE¦öÍ:Ç™IHÖÍr˜VVüR»Èy4xø¯n©æôXWx¬-tÀwt°ÎiHø[íâ}Pf2¯(Éëµ\'ÂgšWH?½œıi=›¾Ã×Ùb¡wìNÙ3Š£ÊªgËûÈ~Ìì­zñ]®ÖûE3ª.•´Ô´n_4ƒóT»]µ>MD¿~Î¶Ìøqª\'Ş£¿pûd~@x,Z-©Séı¢ã²ÎÚúêùZîñî;44ÀnzŸßTj±_`’{u¥Öú0Òã+høÖ¹%òoËÕl;9gKœVÒİ«ä¸Û#Î™Òm´ná-;xJÊ¢\"\"\"\"‹óİO’İ{8Ş#ouß ?ƒGpŸ#·2@ëĞÔ-[)ušF\n§VÚ¢wş“h÷öß„õ/¸u/%Æ¦dş7$P—pı6nßÔ´üœ=”Ÿa¾[oô-«´VEUêXy´ù8uĞ®´^Wû±¦Õ‘Àş\Zû§ö(\0<Àp<nù7q¿p[]Äÿ\0s´êÙA+8+foÒª+À;º8[şUİ¢‚»RêK±lq˜õrËÍÑ‡¼sÅ	ô.æÑé¿¢övhÓá˜Ûo7Xv¿ÜãppçOæ#÷<‹¾CÁLuµPPÑÏWY+!¦†I$yÙ¬h’O²¦¹\rÂãÚW!¡ 2ÃQí¹E\0?‡ùßà=‡Vn§)ÂğE5­÷:*:z8ÄQÓFî7´Ó…»ıOŠ«\Zé˜Û2LæÛ“aÌ«Š¶‰­ï$‘¼eİ®\0Ó§?ñ{×ìº÷›ûU–ÈÈç,\\ú¹ŸÍsØ¾7–ê¥ìABjç„»øõÕNqc™qı58æZâ\ZQz«¥lÕ·Šz^?¤Jíš¸â-håÓ~»­çdxh¤ÓGÊØ 5l­‘“€qí³HõÛšÕö—Ô	İàøÛİ5}[ƒjÌ\\Èòˆmâ|ıRVŒ`pàx|4kMÎ£ik$/Ûêïä:~+½DDDD\\–ªd§Ánw8Õ!Í?¤äÓòß’ÑhV#ƒ‚çVÎ;ÅÕ‚¢ywpc¾&·b	õ>IKM<5P>\n˜£šã‘¡Ípò õQUÿ\0MëlUî½éÕK¨êÇ9(K¿‡ ònü¿Êyy¢ëmê]aÖ[$7ß£Ò[l­â4ÜÒ´‚àê\\àÑ·û-*Õ\"ò]î4ö‹UeÆ¹ıİ-$/Wy5 “ùQ´~ÓQ¬:ÑrË/±qÛ(¥.‰ÜÛ¿Hbö\0n|ø}U¥És\Zˆ¾õu¦¦pİ—q<û4sUg^µ™ùÌqâø„U-·Èñô‰Ùõ$L\0thê|ùy/§ô´QÛ-ÑKg¤ª=äÒJã	——W}¢=‡OÄ©gìçiÍ›#ºT×ÍÕÑÃü6oîw\'òRƒÆ,1pZì”QrØ½Ñ‡¼û¹Û•©­Ò,²äêêŒf„Ô;ëp‚Ö“çÂß’ìm–ê;Ut–ÚXiic2(X\ZÑòòïA\rÖÕYoªoQ:G\rê©õuG®×»–ß5D5¤wS²Ò³É²0\\[¹©KA´–¶Õp~Yšƒ%òb_2\'DOW»ù½<ôˆˆˆˆŠíN÷·Oè\ZÓ³rŒ8yîE/QG4pE&FÖ°\0%™]¯ùÛ±PPÛ]~»oOJÖssäé\0#}‡©Ej0İ ¢ÓúJJç:‰çé2Ö3™Gü?V·`=÷ ÖÊË˜^1\nÈìùäO}9<0\\Ø8ƒ‡ó¬<ARc®T-·ŠçVS¶ˆ·ˆNd›yñtUç´–¬Y+0jì®5UUr29¥‰§»ƒ»‡ûË–Ä¨÷H­:‡]ˆ²İˆÇ=\rª¦GO5XÚ!#Ã¹ó \0ÁrZ‡GOiº¶ÍAsuúÿ\0#ø\'’›wÇÉÛ»iê÷ïò9–G³¶³	·‹ÖAoÈê[É§g}‡ìç>\'ä<w•-ò}2ûW3H1@;±ïÿ\0[­Ò\"\"\"\"\"\"\"\";DYİwÒë‹£kŸ-ÙXÀÑ¿Õ;;ğkœ~K¢Òûôy&e¸Ç(’GS¶9ùó°p¼˜\'Ø…Ô­NUÛ±k\rUŞñ0Š’»Ÿö|\ZÑâãĞ\niŠá¨yœÚ“•Æ[MË-4®æÖ†’†ÿ\0e¼ö>.Üøsœo—«mŠ‰ÕwzØ))Ûö¥vÛúÔŸ@ ¼ëZ)oñÉdÅì.»¾\0ú˜ÉùµƒşGp¸ˆôƒP®t®¾WÅBÇû=Òü`¥±ôóô+Õ’à¸ÅÏO*­¶:yh2ÈÙv¸<ñL[¿mw&÷äpäìU\ZÇrÆi0›M²éGn‹è¦œ–I™Ûl9‘ÈÇ.jvĞı Á[Úôc¯ÈÜ9<s›~¡›õw›Ëo3$¼²‚MNxëçøc¼ÈßÅz¬³í±Äı»ç|ræ+bˆˆˆˆˆˆˆˆ¾\'Š9á’˜Ù\"‘¥c†áÀˆ*»Ñ×WhF_SG_õxMÒS,Æ8¼¾ğ<@tÙw·=sÀèíÏ©†ìúÉCwe<4òq¼ù|@ó!Gq[ïZ¿y‡ Í£u‹¡ì4òIÀ&çbwñ~Ã—&ù­ÖM¬\\2Eé¯éR1¢¥d?@cÀzòô^K&ä9]knºvœqsú3_Å&Ş[ıVAºš1ŒRÉŒRˆ,–è)FÛ9á»½Şî<Êİ­M÷µ_#á¹QÇ+‡! ø^ßgkšn=Ül7úê8Ï>éÇ‰»üˆıfcÙ;øYQ’Ï;~_ªÜØ±ªKT†w=õU„îg›™ŞKxˆˆˆˆˆˆˆˆˆ°ÖÒSWRÉM[OE<ƒgÅ+ÚáäAäT_–Z´ÛNèİp©Çí†±äºBG½ßÊ¿ßÇ \\“0ÖJï§Ş*_lÇÿ\0…„&7íæ*oÃp»&!D ³R5’´“¿â’OwÀr]\Z\"\"ò×\\(íñ™+j¡ƒÆG†®Jã©Øå!sa¨’­ãÂÌ­3µórqmƒšMú>@OéËóY›.£W´m%>|;Õ}ÅŒfs*¼G¿Ùa\'ôeıÇ½ÉÎl¢«åâÿ\0ä³ŒW$‡şï“Êí¿óÿ\0Ü¬“3µ3ø±Òİ#oRÎN?§èVÚÏ“AuŞÅ%5{GÇƒ˜óÛÍt\rß„quñ_¨ˆˆˆˆ‹O—_é1Œ~®ë\\Ouy4u{Fr¡8Äj5# ªËó½ô.“û=9$5ûx}ÁÓÕX8b™,lq°µàûD^+¥Ö‚Õ	–ãY3=äxûÀŞ5vÓÌ6jiî3ô£…»ş§ğZ¡U¨¹Q6ÙèİÑÇà;{Ÿˆ­“Å4‚l‚ëU])ææ´ì?¹]§°Úš>‡l§míãwâVõ­k\Z\ZÆ†àËõru”Uu,í…Ì0¼—J\"Í¹ëªëF½ èkkôòVPBé„S²Yƒz†\r÷;{²éYb­Ã­”UAMWK…ôò<5ÜC©{õR–6õ‘ƒÜ­UÏ\'±ÚÁ5÷Z8HêÓ(.ü5ÅŞµ¤İ–ÆOr›Ã»oÏò\\øÉ5-<6[wìÚGÿ\0Š[ÃËï;şekÒ\'UL*²«´õ³ndn;Qçù)\nÉŒÙìq†Û-ğBGÛáİÇæy­Â\"\"\"\"\"\"\"\"\"\"/Çµ¯ikÀs\\6 Á\n.È4S¸K$öéjm³½ÅßÃ<LîŸŠÒ³CGñ2jƒíÿ\0e¶µè\rq­­­xõƒúŸÍv¶L/²ë}ª’ñ8İøö]\n\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"/ÿÙ','$2y$10$/JlpMyuhF2CKpMTldI8NHePRoVbTCq5eJmGWPI0Bdf0v4yl1ca5yK',0,'WaKGDGBBmSBDt26EN3knyspUZCCJGG6iv0BKuDbR8Xjnvluyurx84QTYHdKd'),(2,'2018-10-03 06:40:44','2018-10-03 06:40:44','Pedro Pepe','Pereira','Perez','pedro95@gmail.com','ÿØÿà\0JFIF\0\0\0\0\0\0ÿÛ\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(ÿÀ\0\0ğ\0ğ\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0\0	ÿÄ\0F\0	\0\0\0\0!1AQaq\"2Br‘¡±#b’$3C‚¢R²Ááğ&4DSTÑÒâñÿÚ\0\0\0?\0µ(ˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆ¸,ëV°ü*WSİî}sFæ’•½ì£ÜMùµš}­øoyeªß%]%|&(ë#k;Ò<\ZCˆ\'ÑJˆˆˆˆˆˆˆˆˆˆˆˆŠ¾ë¾¨İMò,O‹¥½Ôê¦x9¾\"ÃağvÜË¼¯Ovšvy±Y©ã­Ì\ZÛİáÿ\0Ù!&ˆíŸW~€í!aµâúƒÔb”´ò½®0ÒÆ#kœÉYÀx@Û}Éú+f:sDDDDDDDDDDDDEÇêÎ^Ì¹^NÎ¨c{ªfµ3¹7ä:Ÿ@T_Ùc}=²§6¾0Ëvº¹Æò\rÜØ‰<O÷yßäš°\nªRÌ5_µu0o5’Á±kÇ6–ÂwüÒŸÁZ´DDDDDDDDDDDDU«µUmEÿ\0+Äpz|u2¶i‡İİ³aÆ~jÅZ( µZ¨íôà§¥…Æß&´\0?Ev•ÔÜÌ)Ô6ù6½]ƒ ƒ„üQÇÑò~aê}nÎÂ0Xæ®‹†ótá¨©ß«·ÁÈÏ©*XDDDDDDDDDDDDEXìŸöÃµÍ}Iøé¬ÁûÌé‚1ş·¬VI{ Æìu—k¼í‚Š–3$?d@x’«•Ú+õ£Ujóœ\",Vé@¥§w6—7œq0ß¬ï2}U®DDDDDDDDDDDDEñ4†%yÙ¬iq>V^ËSEQg¹eÆHá‡‹wÏ!Ù¬{äq$ô`´¹…öíÚ?ƒÆL´ø¥øæ¨ €àÆW>¡ÿ\0Ö‡Çíøµ‚Ïg€CEJÎ8ø’y’¶Èˆˆˆˆˆˆˆˆˆˆˆˆ¹mR¼AbÓÜ‚º¢xá-¢•±—»mŞæĞ<É$rT¯Mmyvso“\rÆƒ¡³ÍR*®ÁÈŞ;Ä\r·\rñ>Ü®®aœ†Óf‹§Å<îòx¹Çôuˆˆ‹ˆÏ5KÁ«i¨ïõîe\\ûQ™Ö“·¶èi¬å‰ÁñÈĞö¸t Á_hˆˆˆˆˆˆˆ¼÷\núKu3ênPRÓ³›¥@Æry(SP»Fãv\"ú<b7_î_T:#ÃN×}ş®ÿ\0(Øù¨O?±ê[‹WfùìòQÛéøE%€³~7†¾Èç¿¹¼z«#Ù²×³G¬|5’T‰*$ l\\\\÷lOŸÂà¤äDDEÌê>[I„aõ÷Êİœ fÑG¾ÆY&´{ŸËuBíPİu\'R©b­•ó×İëzş¼-\'w@Öƒòú-K)©¡‚!´q01£Ğ\r‚Èˆˆˆˆˆˆ±ÔÆé©¥’:\'½…¢Fõa#¨öU‚M2Ö¼n¢İÜ¹ÕôååÍâ­vîÜõ,”ƒìJüıÒírÕUÿ\0èŒw\"ï¦FÍ¾qÖZ.ÍÙò©µæg%IfIPò<ƒäÛoÀ©ƒ\0Ò<Csfµ[„õãÿ\0VD²ºvÙ¿år=®«\r>–Å\0;}&á¨\rs¿P¦ŸAÓœfœ‹-Ğn=K?ªé‘=ím™:õ—ÓbÔ²ÿ\0aµ7½©á<1Ÿéo/rVã±Æ#ßÖİ2ê¸¾¿±Ñî9Èö-ù•j‘uíP]gÅííë=\\’m÷Z\Z?ßV\nß\0¦·Ó@Ñ°Š&°`ô\"\"\"Ôe÷È1¬bçyªÛº¢§|Ä·ù‡Í9ë*k¯÷jŠ‰8§¹İª‰ s..vû|ÜGô¯èNšãaØ=¢ÇTĞõÃíÊy¼ÿ\0Q+¦DDDDDDDDDU¿´~×m[ÓÛ ç¼¬{‡£æhıUDEŠ»×ÉÃõZxwó+**óÛ(4·§~Ó\\¦ïf\0óî™Ğ|ÜGô¨·²®#ûÇ¨‚íQ¾ÈÁ($r3Äcıç{…vW€şÜí{h§Û‰–Ø¿§N“ÅáXôE®¼W}‚Šªo…ŒŸºõPÓŠZVDäs\'Ì¬è¨_i|äZ³rlOã§·mCmúßê.V¯³î\Z0Í6·Á<|\nÑôÊ­Ç0ç³OİnÃßu$¢\"\"\"\"\"\".2ÔÛe†¿ö]º	¯¢î¢Róáw“±çè>{-<w=U¹°M¦×m‰ÜÚÙˆãÛÈ‚â ³Œ‹Qmd:ëŒÒ×@:š7ügäï÷Wº×ª¶Y¥÷x+-5]ÊˆÉh>ãŸâíí÷*+”]í¾®\n˜ÿ\0ÚŠ@í½öè«æŒñ_»CçwÇ|qÓw°1Ş[ÈßôÆUE§½_©­¤BÃßÖ¿“ g3¹é¿’ù±Û§l®¯¹êé:Ç[¤Zœºñ?‹İnóGM$ÜüHiØ|ÎÁR]\0Ä¥Ô\rQeUÅ†Z\ZI\r}kœ7<[µ§ï;ò_DDDDDDEkNUSc1SZ‹¿kİ%ú%/ø›¿Öpõ€=\\\n÷é®E‡ZY»Y=ŞfñUU¸nç8ó-i=\ZãÔ®É’ål¡¹ÅİÜhéê™à%Œ;omú.-À1û]åx£}]µÔtòTO)ÛáiwC¹ğğ!Dİ™1ì™ØíÖıe¹A«*û·¶¡›÷œ}÷Øø¼©®9óØ÷kémríö÷ÛõÑem³-¸ì.Jz(OÖe3~/ÇşkwcÇ¨­&ºZƒõ§”ñ8ûy-Â.o5Î1Ü*ˆTäw8i¿»‹ëK\'İ`æ}ú*¿­šÿ\0M™cuxî=m©§£¨s{Úº‡€÷µ§~Á¾À9ïòXû.æ7K\rş“¤Ç;úk­GMhcÄ­o\'oõxÌüÏ5rE¬0LıGÓY’@.î\Zxâ;ŸÃ‘Rê\"(»´¥ìY´–êÆ¼¶jòÊ8öñâ;¸C\\¶Úeu‡J±êIÃ3éş“ Ûòş~ 8’îÑällsäpk\Z7sœv\0y•\\5k´Ciê¤±iÔbºàçwF¼7İ6‰¿lïãÓÈÊc:t¼CS—êíÚ¦’‘‘š™â|œU.`ün;†åŸJm=.SŸÓÑY([ECYXÊzjv’K#.\0nO2í¹’|WôrŠš::H) hlPÆØØ€aú,Èˆˆˆˆˆˆˆˆˆ«¯h‡»+Ô¼/§.s ¨©\r;ìí·#Í¬cÏÍXˆØØãk#¬h\rh\0/¤X+ªéè(§«­š8)`a’IdvÍc@Ü’UGÔÍHÈ5ƒ&n§ÑÎÛCÜZç7v\Z:¾CöcG¯=€›4sFìÚ{JÊ©šË†@æÿ\0±íå›bê^§òQÏk,îYßK€ØK¥ª©sZØ¹“¹Ü^äìâ>êôŸ6ÑkW	šÚxæ#˜2¶\"÷~;|•İE«Éï´ÕŠ®ív˜CILÂ÷ÔùæOEh&¦åZƒ¨—£Vè›Ç	‘°ÀîOİI<÷ßÕXTDDDDDDD_sXÇ9ä5­’z\0«¾‡0ç\ZÁ–gS´º–\Zj\"áÓ‹ánŞ¢6€~ú±(Š£ë†}tÔÜº,€OİÊø*©æIğ½wèvßÉOºE¦öÍ:Ç™IHÖÍr˜VVüR»Èy4xø¯n©æôXWx¬-tÀwt°ÎiHø[íâ}Pf2¯(Éëµ\'ÂgšWH?½œıi=›¾Ã×Ùb¡wìNÙ3Š£ÊªgËûÈ~Ìì­zñ]®ÖûE3ª.•´Ô´n_4ƒóT»]µ>MD¿~Î¶Ìøqª\'Ş£¿pûd~@x,Z-©Séı¢ã²ÎÚúêùZîñî;44ÀnzŸßTj±_`’{u¥Öú0Òã+høÖ¹%òoËÕl;9gKœVÒİ«ä¸Û#Î™Òm´ná-;xJÊ¢\"\"\"\"‹óİO’İ{8Ş#ouß ?ƒGpŸ#·2@ëĞÔ-[)ušF\n§VÚ¢wş“h÷öß„õ/¸u/%Æ¦dş7$P—pı6nßÔ´üœ=”Ÿa¾[oô-«´VEUêXy´ù8uĞ®´^Wû±¦Õ‘Àş\Zû§ö(\0<Àp<nù7q¿p[]Äÿ\0s´êÙA+8+foÒª+À;º8[şUİ¢‚»RêK±lq˜õrËÍÑ‡¼sÅ	ô.æÑé¿¢övhÓá˜Ûo7Xv¿ÜãppçOæ#÷<‹¾CÁLuµPPÑÏWY+!¦†I$yÙ¬h’O²¦¹\rÂãÚW!¡ 2ÃQí¹E\0?‡ùßà=‡Vn§)ÂğE5­÷:*:z8ÄQÓFî7´Ó…»ıOŠ«\Zé˜Û2LæÛ“aÌ«Š¶‰­ï$‘¼eİ®\0Ó§?ñ{×ìº÷›ûU–ÈÈç,\\ú¹ŸÍsØ¾7–ê¥ìABjç„»øõÕNqc™qı58æZâ\ZQz«¥lÕ·Šz^?¤Jíš¸â-håÓ~»­çdxh¤ÓGÊØ 5l­‘“€qí³HõÛšÕö—Ô	İàøÛİ5}[ƒjÌ\\Èòˆmâ|ıRVŒ`pàx|4kMÎ£ik$/Ûêïä:~+½DDDD\\–ªd§Ánw8Õ!Í?¤äÓòß’ÑhV#ƒ‚çVÎ;ÅÕ‚¢ywpc¾&·b	õ>IKM<5P>\n˜£šã‘¡Ípò õQUÿ\0MëlUî½éÕK¨êÇ9(K¿‡ ònü¿Êyy¢ëmê]aÖ[$7ß£Ò[l­â4ÜÒ´‚àê\\àÑ·û-*Õ\"ò]î4ö‹UeÆ¹ıİ-$/Wy5 “ùQ´~ÓQ¬:ÑrË/±qÛ(¥.‰ÜÛ¿Hbö\0n|ø}U¥És\Zˆ¾õu¦¦pİ—q<û4sUg^µ™ùÌqâø„U-·Èñô‰Ùõ$L\0thê|ùy/§ô´QÛ-ÑKg¤ª=äÒJã	——W}¢=‡OÄ©gìçiÍ›#ºT×ÍÕÑÃü6oîw\'òRƒÆ,1pZì”QrØ½Ñ‡¼û¹Û•©­Ò,²äêêŒf„Ô;ëp‚Ö“çÂß’ìm–ê;Ut–ÚXiic2(X\ZÑòòïA\rÖÕYoªoQ:G\rê©õuG®×»–ß5D5¤wS²Ò³É²0\\[¹©KA´–¶Õp~Yšƒ%òb_2\'DOW»ù½<ôˆˆˆˆŠíN÷·Oè\ZÓ³rŒ8yîE/QG4pE&FÖ°\0%™]¯ùÛ±PPÛ]~»oOJÖssäé\0#}‡©Ej0İ ¢ÓúJJç:‰çé2Ö3™Gü?V·`=÷ ÖÊË˜^1\nÈìùäO}9<0\\Ø8ƒ‡ó¬<ARc®T-·ŠçVS¶ˆ·ˆNd›yñtUç´–¬Y+0jì®5UUr29¥‰§»ƒ»‡ûË–Ä¨÷H­:‡]ˆ²İˆÇ=\rª¦GO5XÚ!#Ã¹ó \0ÁrZ‡GOiº¶ÍAsuúÿ\0#ø\'’›wÇÉÛ»iê÷ïò9–G³¶³	·‹ÖAoÈê[É§g}‡ìç>\'ä<w•-ò}2ûW3H1@;±ïÿ\0[­Ò\"\"\"\"\"\"\"\";DYİwÒë‹£kŸ-ÙXÀÑ¿Õ;;ğkœ~K¢Òûôy&e¸Ç(’GS¶9ùó°p¼˜\'Ø…Ô­NUÛ±k\rUŞñ0Š’»Ÿö|\ZÑâãĞ\niŠá¨yœÚ“•Æ[MË-4®æÖ†’†ÿ\0e¼ö>.Üøsœo—«mŠ‰ÕwzØ))Ûö¥vÛúÔŸ@ ¼ëZ)oñÉdÅì.»¾\0ú˜ÉùµƒşGp¸ˆôƒP®t®¾WÅBÇû=Òü`¥±ôóô+Õ’à¸ÅÏO*­¶:yh2ÈÙv¸<ñL[¿mw&÷äpäìU\ZÇrÆi0›M²éGn‹è¦œ–I™Ûl9‘ÈÇ.jvĞı Á[Úôc¯ÈÜ9<s›~¡›õw›Ëo3$¼²‚MNxëçøc¼ÈßÅz¬³í±Äı»ç|ræ+bˆˆˆˆˆˆˆˆ¾\'Š9á’˜Ù\"‘¥c†áÀˆ*»Ñ×WhF_SG_õxMÒS,Æ8¼¾ğ<@tÙw·=sÀèíÏ©†ìúÉCwe<4òq¼ù|@ó!Gq[ïZ¿y‡ Í£u‹¡ì4òIÀ&çbwñ~Ã—&ù­ÖM¬\\2Eé¯éR1¢¥d?@cÀzòô^K&ä9]knºvœqsú3_Å&Ş[ıVAºš1ŒRÉŒRˆ,–è)FÛ9á»½Şî<Êİ­M÷µ_#á¹QÇ+‡! ø^ßgkšn=Ül7úê8Ï>éÇ‰»üˆıfcÙ;øYQ’Ï;~_ªÜØ±ªKT†w=õU„îg›™ŞKxˆˆˆˆˆˆˆˆˆ°ÖÒSWRÉM[OE<ƒgÅ+ÚáäAäT_–Z´ÛNèİp©Çí†±äºBG½ßÊ¿ßÇ \\“0ÖJï§Ş*_lÇÿ\0…„&7íæ*oÃp»&!D ³R5’´“¿â’OwÀr]\Z\"\"ò×\\(íñ™+j¡ƒÆG†®Jã©Øå!sa¨’­ãÂÌ­3µórqmƒšMú>@OéËóY›.£W´m%>|;Õ}ÅŒfs*¼G¿Ùa\'ôeıÇ½ÉÎl¢«åâÿ\0ä³ŒW$‡şï“Êí¿óÿ\0Ü¬“3µ3ø±Òİ#oRÎN?§èVÚÏ“AuŞÅ%5{GÇƒ˜óÛÍt\rß„quñ_¨ˆˆˆˆ‹O—_é1Œ~®ë\\Ouy4u{Fr¡8Äj5# ªËó½ô.“û=9$5ûx}ÁÓÕX8b™,lq°µàûD^+¥Ö‚Õ	–ãY3=äxûÀŞ5vÓÌ6jiî3ô£…»ş§ğZ¡U¨¹Q6ÙèİÑÇà;{Ÿˆ­“Å4‚l‚ëU])ææ´ì?¹]§°Úš>‡l§míãwâVõ­k\Z\ZÆ†àËõru”Uu,í…Ì0¼—J\"Í¹ëªëF½ èkkôòVPBé„S²Yƒz†\r÷;{²éYb­Ã­”UAMWK…ôò<5ÜC©{õR–6õ‘ƒÜ­UÏ\'±ÚÁ5÷Z8HêÓ(.ü5ÅŞµ¤İ–ÆOr›Ã»oÏò\\øÉ5-<6[wìÚGÿ\0Š[ÃËï;şekÒ\'UL*²«´õ³ndn;Qçù)\nÉŒÙìq†Û-ğBGÛáİÇæy­Â\"\"\"\"\"\"\"\"\"\"/Çµ¯ikÀs\\6 Á\n.È4S¸K$öéjm³½ÅßÃ<LîŸŠÒ³CGñ2jƒíÿ\0e¶µè\rq­­­xõƒúŸÍv¶L/²ë}ª’ñ8İøö]\n\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"/ÿÙ','$2y$10$9UeawZRd0.5N9CU6LoZDxe4.AIML6w.vY9PHmJFoHgWlpSb.U3yBC',0,NULL),(3,'2018-10-03 06:40:44','2018-10-03 06:40:44','Juan Jose','Ramirez','Noriega','junaskdw_43@gmail.com','ÿØÿà\0JFIF\0\0\0\0\0\0ÿÛ\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(ÿÀ\0\0ğ\0ğ\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0\0	ÿÄ\0F\0	\0\0\0\0!1AQaq\"2Br‘¡±#b’$3C‚¢R²Ááğ&4DSTÑÒâñÿÚ\0\0\0?\0µ(ˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆ¸,ëV°ü*WSİî}sFæ’•½ì£ÜMùµš}­øoyeªß%]%|&(ë#k;Ò<\ZCˆ\'ÑJˆˆˆˆˆˆˆˆˆˆˆˆŠ¾ë¾¨İMò,O‹¥½Ôê¦x9¾\"ÃağvÜË¼¯Ovšvy±Y©ã­Ì\ZÛİáÿ\0Ù!&ˆíŸW~€í!aµâúƒÔb”´ò½®0ÒÆ#kœÉYÀx@Û}Éú+f:sDDDDDDDDDDDDEÇêÎ^Ì¹^NÎ¨c{ªfµ3¹7ä:Ÿ@T_Ùc}=²§6¾0Ëvº¹Æò\rÜØ‰<O÷yßäš°\nªRÌ5_µu0o5’Á±kÇ6–ÂwüÒŸÁZ´DDDDDDDDDDDDU«µUmEÿ\0+Äpz|u2¶i‡İİ³aÆ~jÅZ( µZ¨íôà§¥…Æß&´\0?Ev•ÔÜÌ)Ô6ù6½]ƒ ƒ„üQÇÑò~aê}nÎÂ0Xæ®‹†ótá¨©ß«·ÁÈÏ©*XDDDDDDDDDDDDEXìŸöÃµÍ}Iøé¬ÁûÌé‚1ş·¬VI{ Æìu—k¼í‚Š–3$?d@x’«•Ú+õ£Ujóœ\",Vé@¥§w6—7œq0ß¬ï2}U®DDDDDDDDDDDDEñ4†%yÙ¬iq>V^ËSEQg¹eÆHá‡‹wÏ!Ù¬{äq$ô`´¹…öíÚ?ƒÆL´ø¥øæ¨ €àÆW>¡ÿ\0Ö‡Çíøµ‚Ïg€CEJÎ8ø’y’¶Èˆˆˆˆˆˆˆˆˆˆˆˆ¹mR¼AbÓÜ‚º¢xá-¢•±—»mŞæĞ<É$rT¯Mmyvso“\rÆƒ¡³ÍR*®ÁÈŞ;Ä\r·\rñ>Ü®®aœ†Óf‹§Å<îòx¹Çôuˆˆ‹ˆÏ5KÁ«i¨ïõîe\\ûQ™Ö“·¶èi¬å‰ÁñÈĞö¸t Á_hˆˆˆˆˆˆˆ¼÷\núKu3ênPRÓ³›¥@Æry(SP»Fãv\"ú<b7_î_T:#ÃN×}ş®ÿ\0(Øù¨O?±ê[‹WfùìòQÛéøE%€³~7†¾Èç¿¹¼z«#Ù²×³G¬|5’T‰*$ l\\\\÷lOŸÂà¤äDDEÌê>[I„aõ÷Êİœ fÑG¾ÆY&´{ŸËuBíPİu\'R©b­•ó×İëzş¼-\'w@Öƒòú-K)©¡‚!´q01£Ğ\r‚Èˆˆˆˆˆˆ±ÔÆé©¥’:\'½…¢Fõa#¨öU‚M2Ö¼n¢İÜ¹ÕôååÍâ­vîÜõ,”ƒìJüıÒírÕUÿ\0èŒw\"ï¦FÍ¾qÖZ.ÍÙò©µæg%IfIPò<ƒäÛoÀ©ƒ\0Ò<Csfµ[„õãÿ\0VD²ºvÙ¿år=®«\r>–Å\0;}&á¨\rs¿P¦ŸAÓœfœ‹-Ğn=K?ªé‘=ím™:õ—ÓbÔ²ÿ\0aµ7½©á<1Ÿéo/rVã±Æ#ßÖİ2ê¸¾¿±Ñî9Èö-ù•j‘uíP]gÅííë=\\’m÷Z\Z?ßV\nß\0¦·Ó@Ñ°Š&°`ô\"\"\"Ôe÷È1¬bçyªÛº¢§|Ä·ù‡Í9ë*k¯÷jŠ‰8§¹İª‰ s..vû|ÜGô¯èNšãaØ=¢ÇTĞõÃíÊy¼ÿ\0Q+¦DDDDDDDDDU¿´~×m[ÓÛ ç¼¬{‡£æhıUDEŠ»×ÉÃõZxwó+**óÛ(4·§~Ó\\¦ïf\0óî™Ğ|ÜGô¨·²®#ûÇ¨‚íQ¾ÈÁ($r3Äcıç{…vW€şÜí{h§Û‰–Ø¿§N“ÅáXôE®¼W}‚Šªo…ŒŸºõPÓŠZVDäs\'Ì¬è¨_i|äZ³rlOã§·mCmúßê.V¯³î\Z0Í6·Á<|\nÑôÊ­Ç0ç³OİnÃßu$¢\"\"\"\"\"\".2ÔÛe†¿ö]º	¯¢î¢Róáw“±çè>{-<w=U¹°M¦×m‰ÜÚÙˆãÛÈ‚â ³Œ‹Qmd:ëŒÒ×@:š7ügäï÷Wº×ª¶Y¥÷x+-5]ÊˆÉh>ãŸâíí÷*+”]í¾®\n˜ÿ\0ÚŠ@í½öè«æŒñ_»CçwÇ|qÓw°1Ş[ÈßôÆUE§½_©­¤BÃßÖ¿“ g3¹é¿’ù±Û§l®¯¹êé:Ç[¤Zœºñ?‹İnóGM$ÜüHiØ|ÎÁR]\0Ä¥Ô\rQeUÅ†Z\ZI\r}kœ7<[µ§ï;ò_DDDDDDEkNUSc1SZ‹¿kİ%ú%/ø›¿Öpõ€=\\\n÷é®E‡ZY»Y=ŞfñUU¸nç8ó-i=\ZãÔ®É’ål¡¹ÅİÜhéê™à%Œ;omú.-À1û]åx£}]µÔtòTO)ÛáiwC¹ğğ!Dİ™1ì™ØíÖıe¹A«*û·¶¡›÷œ}÷Øø¼©®9óØ÷kémríö÷ÛõÑem³-¸ì.Jz(OÖe3~/ÇşkwcÇ¨­&ºZƒõ§”ñ8ûy-Â.o5Î1Ü*ˆTäw8i¿»‹ëK\'İ`æ}ú*¿­šÿ\0M™cuxî=m©§£¨s{Úº‡€÷µ§~Á¾À9ïòXû.æ7K\rş“¤Ç;úk­GMhcÄ­o\'oõxÌüÏ5rE¬0LıGÓY’@.î\Zxâ;ŸÃ‘Rê\"(»´¥ìY´–êÆ¼¶jòÊ8öñâ;¸C\\¶Úeu‡J±êIÃ3éş“ Ûòş~ 8’îÑällsäpk\Z7sœv\0y•\\5k´Ciê¤±iÔbºàçwF¼7İ6‰¿lïãÓÈÊc:t¼CS—êíÚ¦’‘‘š™â|œU.`ün;†åŸJm=.SŸÓÑY([ECYXÊzjv’K#.\0nO2í¹’|WôrŠš::H) hlPÆØØ€aú,Èˆˆˆˆˆˆˆˆˆ«¯h‡»+Ô¼/§.s ¨©\r;ìí·#Í¬cÏÍXˆØØãk#¬h\rh\0/¤X+ªéè(§«­š8)`a’IdvÍc@Ü’UGÔÍHÈ5ƒ&n§ÑÎÛCÜZç7v\Z:¾CöcG¯=€›4sFìÚ{JÊ©šË†@æÿ\0±íå›bê^§òQÏk,îYßK€ØK¥ª©sZØ¹“¹Ü^äìâ>êôŸ6ÑkW	šÚxæ#˜2¶\"÷~;|•İE«Éï´ÕŠ®ív˜CILÂ÷ÔùæOEh&¦åZƒ¨—£Vè›Ç	‘°ÀîOİI<÷ßÕXTDDDDDDD_sXÇ9ä5­’z\0«¾‡0ç\ZÁ–gS´º–\Zj\"áÓ‹ánŞ¢6€~ú±(Š£ë†}tÔÜº,€OİÊø*©æIğ½wèvßÉOºE¦öÍ:Ç™IHÖÍr˜VVüR»Èy4xø¯n©æôXWx¬-tÀwt°ÎiHø[íâ}Pf2¯(Éëµ\'ÂgšWH?½œıi=›¾Ã×Ùb¡wìNÙ3Š£ÊªgËûÈ~Ìì­zñ]®ÖûE3ª.•´Ô´n_4ƒóT»]µ>MD¿~Î¶Ìøqª\'Ş£¿pûd~@x,Z-©Séı¢ã²ÎÚúêùZîñî;44ÀnzŸßTj±_`’{u¥Öú0Òã+høÖ¹%òoËÕl;9gKœVÒİ«ä¸Û#Î™Òm´ná-;xJÊ¢\"\"\"\"‹óİO’İ{8Ş#ouß ?ƒGpŸ#·2@ëĞÔ-[)ušF\n§VÚ¢wş“h÷öß„õ/¸u/%Æ¦dş7$P—pı6nßÔ´üœ=”Ÿa¾[oô-«´VEUêXy´ù8uĞ®´^Wû±¦Õ‘Àş\Zû§ö(\0<Àp<nù7q¿p[]Äÿ\0s´êÙA+8+foÒª+À;º8[şUİ¢‚»RêK±lq˜õrËÍÑ‡¼sÅ	ô.æÑé¿¢övhÓá˜Ûo7Xv¿ÜãppçOæ#÷<‹¾CÁLuµPPÑÏWY+!¦†I$yÙ¬h’O²¦¹\rÂãÚW!¡ 2ÃQí¹E\0?‡ùßà=‡Vn§)ÂğE5­÷:*:z8ÄQÓFî7´Ó…»ıOŠ«\Zé˜Û2LæÛ“aÌ«Š¶‰­ï$‘¼eİ®\0Ó§?ñ{×ìº÷›ûU–ÈÈç,\\ú¹ŸÍsØ¾7–ê¥ìABjç„»øõÕNqc™qı58æZâ\ZQz«¥lÕ·Šz^?¤Jíš¸â-håÓ~»­çdxh¤ÓGÊØ 5l­‘“€qí³HõÛšÕö—Ô	İàøÛİ5}[ƒjÌ\\Èòˆmâ|ıRVŒ`pàx|4kMÎ£ik$/Ûêïä:~+½DDDD\\–ªd§Ánw8Õ!Í?¤äÓòß’ÑhV#ƒ‚çVÎ;ÅÕ‚¢ywpc¾&·b	õ>IKM<5P>\n˜£šã‘¡Ípò õQUÿ\0MëlUî½éÕK¨êÇ9(K¿‡ ònü¿Êyy¢ëmê]aÖ[$7ß£Ò[l­â4ÜÒ´‚àê\\àÑ·û-*Õ\"ò]î4ö‹UeÆ¹ıİ-$/Wy5 “ùQ´~ÓQ¬:ÑrË/±qÛ(¥.‰ÜÛ¿Hbö\0n|ø}U¥És\Zˆ¾õu¦¦pİ—q<û4sUg^µ™ùÌqâø„U-·Èñô‰Ùõ$L\0thê|ùy/§ô´QÛ-ÑKg¤ª=äÒJã	——W}¢=‡OÄ©gìçiÍ›#ºT×ÍÕÑÃü6oîw\'òRƒÆ,1pZì”QrØ½Ñ‡¼û¹Û•©­Ò,²äêêŒf„Ô;ëp‚Ö“çÂß’ìm–ê;Ut–ÚXiic2(X\ZÑòòïA\rÖÕYoªoQ:G\rê©õuG®×»–ß5D5¤wS²Ò³É²0\\[¹©KA´–¶Õp~Yšƒ%òb_2\'DOW»ù½<ôˆˆˆˆŠíN÷·Oè\ZÓ³rŒ8yîE/QG4pE&FÖ°\0%™]¯ùÛ±PPÛ]~»oOJÖssäé\0#}‡©Ej0İ ¢ÓúJJç:‰çé2Ö3™Gü?V·`=÷ ÖÊË˜^1\nÈìùäO}9<0\\Ø8ƒ‡ó¬<ARc®T-·ŠçVS¶ˆ·ˆNd›yñtUç´–¬Y+0jì®5UUr29¥‰§»ƒ»‡ûË–Ä¨÷H­:‡]ˆ²İˆÇ=\rª¦GO5XÚ!#Ã¹ó \0ÁrZ‡GOiº¶ÍAsuúÿ\0#ø\'’›wÇÉÛ»iê÷ïò9–G³¶³	·‹ÖAoÈê[É§g}‡ìç>\'ä<w•-ò}2ûW3H1@;±ïÿ\0[­Ò\"\"\"\"\"\"\"\";DYİwÒë‹£kŸ-ÙXÀÑ¿Õ;;ğkœ~K¢Òûôy&e¸Ç(’GS¶9ùó°p¼˜\'Ø…Ô­NUÛ±k\rUŞñ0Š’»Ÿö|\ZÑâãĞ\niŠá¨yœÚ“•Æ[MË-4®æÖ†’†ÿ\0e¼ö>.Üøsœo—«mŠ‰ÕwzØ))Ûö¥vÛúÔŸ@ ¼ëZ)oñÉdÅì.»¾\0ú˜ÉùµƒşGp¸ˆôƒP®t®¾WÅBÇû=Òü`¥±ôóô+Õ’à¸ÅÏO*­¶:yh2ÈÙv¸<ñL[¿mw&÷äpäìU\ZÇrÆi0›M²éGn‹è¦œ–I™Ûl9‘ÈÇ.jvĞı Á[Úôc¯ÈÜ9<s›~¡›õw›Ëo3$¼²‚MNxëçøc¼ÈßÅz¬³í±Äı»ç|ræ+bˆˆˆˆˆˆˆˆ¾\'Š9á’˜Ù\"‘¥c†áÀˆ*»Ñ×WhF_SG_õxMÒS,Æ8¼¾ğ<@tÙw·=sÀèíÏ©†ìúÉCwe<4òq¼ù|@ó!Gq[ïZ¿y‡ Í£u‹¡ì4òIÀ&çbwñ~Ã—&ù­ÖM¬\\2Eé¯éR1¢¥d?@cÀzòô^K&ä9]knºvœqsú3_Å&Ş[ıVAºš1ŒRÉŒRˆ,–è)FÛ9á»½Şî<Êİ­M÷µ_#á¹QÇ+‡! ø^ßgkšn=Ül7úê8Ï>éÇ‰»üˆıfcÙ;øYQ’Ï;~_ªÜØ±ªKT†w=õU„îg›™ŞKxˆˆˆˆˆˆˆˆˆ°ÖÒSWRÉM[OE<ƒgÅ+ÚáäAäT_–Z´ÛNèİp©Çí†±äºBG½ßÊ¿ßÇ \\“0ÖJï§Ş*_lÇÿ\0…„&7íæ*oÃp»&!D ³R5’´“¿â’OwÀr]\Z\"\"ò×\\(íñ™+j¡ƒÆG†®Jã©Øå!sa¨’­ãÂÌ­3µórqmƒšMú>@OéËóY›.£W´m%>|;Õ}ÅŒfs*¼G¿Ùa\'ôeıÇ½ÉÎl¢«åâÿ\0ä³ŒW$‡şï“Êí¿óÿ\0Ü¬“3µ3ø±Òİ#oRÎN?§èVÚÏ“AuŞÅ%5{GÇƒ˜óÛÍt\rß„quñ_¨ˆˆˆˆ‹O—_é1Œ~®ë\\Ouy4u{Fr¡8Äj5# ªËó½ô.“û=9$5ûx}ÁÓÕX8b™,lq°µàûD^+¥Ö‚Õ	–ãY3=äxûÀŞ5vÓÌ6jiî3ô£…»ş§ğZ¡U¨¹Q6ÙèİÑÇà;{Ÿˆ­“Å4‚l‚ëU])ææ´ì?¹]§°Úš>‡l§míãwâVõ­k\Z\ZÆ†àËõru”Uu,í…Ì0¼—J\"Í¹ëªëF½ èkkôòVPBé„S²Yƒz†\r÷;{²éYb­Ã­”UAMWK…ôò<5ÜC©{õR–6õ‘ƒÜ­UÏ\'±ÚÁ5÷Z8HêÓ(.ü5ÅŞµ¤İ–ÆOr›Ã»oÏò\\øÉ5-<6[wìÚGÿ\0Š[ÃËï;şekÒ\'UL*²«´õ³ndn;Qçù)\nÉŒÙìq†Û-ğBGÛáİÇæy­Â\"\"\"\"\"\"\"\"\"\"/Çµ¯ikÀs\\6 Á\n.È4S¸K$öéjm³½ÅßÃ<LîŸŠÒ³CGñ2jƒíÿ\0e¶µè\rq­­­xõƒúŸÍv¶L/²ë}ª’ñ8İøö]\n\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"/ÿÙ','$2y$10$JyFpLSU4u0o9flQDNbr.2efBcIUHYehiFcxjgyN1iROaaA1QuqOXa',0,NULL),(4,'2018-10-03 06:40:44','2018-10-03 06:40:44','MarÃ­a Luisa','Del Rosario','Lugo','maria_bends@gmail.com','ÿØÿà\0JFIF\0\0\0\0\0\0ÿÛ\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(ÿÀ\0\0ğ\0ğ\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0\0	ÿÄ\0F\0	\0\0\0\0!1AQaq\"2Br‘¡±#b’$3C‚¢R²Ááğ&4DSTÑÒâñÿÚ\0\0\0?\0µ(ˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆ¸,ëV°ü*WSİî}sFæ’•½ì£ÜMùµš}­øoyeªß%]%|&(ë#k;Ò<\ZCˆ\'ÑJˆˆˆˆˆˆˆˆˆˆˆˆŠ¾ë¾¨İMò,O‹¥½Ôê¦x9¾\"ÃağvÜË¼¯Ovšvy±Y©ã­Ì\ZÛİáÿ\0Ù!&ˆíŸW~€í!aµâúƒÔb”´ò½®0ÒÆ#kœÉYÀx@Û}Éú+f:sDDDDDDDDDDDDEÇêÎ^Ì¹^NÎ¨c{ªfµ3¹7ä:Ÿ@T_Ùc}=²§6¾0Ëvº¹Æò\rÜØ‰<O÷yßäš°\nªRÌ5_µu0o5’Á±kÇ6–ÂwüÒŸÁZ´DDDDDDDDDDDDU«µUmEÿ\0+Äpz|u2¶i‡İİ³aÆ~jÅZ( µZ¨íôà§¥…Æß&´\0?Ev•ÔÜÌ)Ô6ù6½]ƒ ƒ„üQÇÑò~aê}nÎÂ0Xæ®‹†ótá¨©ß«·ÁÈÏ©*XDDDDDDDDDDDDEXìŸöÃµÍ}Iøé¬ÁûÌé‚1ş·¬VI{ Æìu—k¼í‚Š–3$?d@x’«•Ú+õ£Ujóœ\",Vé@¥§w6—7œq0ß¬ï2}U®DDDDDDDDDDDDEñ4†%yÙ¬iq>V^ËSEQg¹eÆHá‡‹wÏ!Ù¬{äq$ô`´¹…öíÚ?ƒÆL´ø¥øæ¨ €àÆW>¡ÿ\0Ö‡Çíøµ‚Ïg€CEJÎ8ø’y’¶Èˆˆˆˆˆˆˆˆˆˆˆˆ¹mR¼AbÓÜ‚º¢xá-¢•±—»mŞæĞ<É$rT¯Mmyvso“\rÆƒ¡³ÍR*®ÁÈŞ;Ä\r·\rñ>Ü®®aœ†Óf‹§Å<îòx¹Çôuˆˆ‹ˆÏ5KÁ«i¨ïõîe\\ûQ™Ö“·¶èi¬å‰ÁñÈĞö¸t Á_hˆˆˆˆˆˆˆ¼÷\núKu3ênPRÓ³›¥@Æry(SP»Fãv\"ú<b7_î_T:#ÃN×}ş®ÿ\0(Øù¨O?±ê[‹WfùìòQÛéøE%€³~7†¾Èç¿¹¼z«#Ù²×³G¬|5’T‰*$ l\\\\÷lOŸÂà¤äDDEÌê>[I„aõ÷Êİœ fÑG¾ÆY&´{ŸËuBíPİu\'R©b­•ó×İëzş¼-\'w@Öƒòú-K)©¡‚!´q01£Ğ\r‚Èˆˆˆˆˆˆ±ÔÆé©¥’:\'½…¢Fõa#¨öU‚M2Ö¼n¢İÜ¹ÕôååÍâ­vîÜõ,”ƒìJüıÒírÕUÿ\0èŒw\"ï¦FÍ¾qÖZ.ÍÙò©µæg%IfIPò<ƒäÛoÀ©ƒ\0Ò<Csfµ[„õãÿ\0VD²ºvÙ¿år=®«\r>–Å\0;}&á¨\rs¿P¦ŸAÓœfœ‹-Ğn=K?ªé‘=ím™:õ—ÓbÔ²ÿ\0aµ7½©á<1Ÿéo/rVã±Æ#ßÖİ2ê¸¾¿±Ñî9Èö-ù•j‘uíP]gÅííë=\\’m÷Z\Z?ßV\nß\0¦·Ó@Ñ°Š&°`ô\"\"\"Ôe÷È1¬bçyªÛº¢§|Ä·ù‡Í9ë*k¯÷jŠ‰8§¹İª‰ s..vû|ÜGô¯èNšãaØ=¢ÇTĞõÃíÊy¼ÿ\0Q+¦DDDDDDDDDU¿´~×m[ÓÛ ç¼¬{‡£æhıUDEŠ»×ÉÃõZxwó+**óÛ(4·§~Ó\\¦ïf\0óî™Ğ|ÜGô¨·²®#ûÇ¨‚íQ¾ÈÁ($r3Äcıç{…vW€şÜí{h§Û‰–Ø¿§N“ÅáXôE®¼W}‚Šªo…ŒŸºõPÓŠZVDäs\'Ì¬è¨_i|äZ³rlOã§·mCmúßê.V¯³î\Z0Í6·Á<|\nÑôÊ­Ç0ç³OİnÃßu$¢\"\"\"\"\"\".2ÔÛe†¿ö]º	¯¢î¢Róáw“±çè>{-<w=U¹°M¦×m‰ÜÚÙˆãÛÈ‚â ³Œ‹Qmd:ëŒÒ×@:š7ügäï÷Wº×ª¶Y¥÷x+-5]ÊˆÉh>ãŸâíí÷*+”]í¾®\n˜ÿ\0ÚŠ@í½öè«æŒñ_»CçwÇ|qÓw°1Ş[ÈßôÆUE§½_©­¤BÃßÖ¿“ g3¹é¿’ù±Û§l®¯¹êé:Ç[¤Zœºñ?‹İnóGM$ÜüHiØ|ÎÁR]\0Ä¥Ô\rQeUÅ†Z\ZI\r}kœ7<[µ§ï;ò_DDDDDDEkNUSc1SZ‹¿kİ%ú%/ø›¿Öpõ€=\\\n÷é®E‡ZY»Y=ŞfñUU¸nç8ó-i=\ZãÔ®É’ål¡¹ÅİÜhéê™à%Œ;omú.-À1û]åx£}]µÔtòTO)ÛáiwC¹ğğ!Dİ™1ì™ØíÖıe¹A«*û·¶¡›÷œ}÷Øø¼©®9óØ÷kémríö÷ÛõÑem³-¸ì.Jz(OÖe3~/ÇşkwcÇ¨­&ºZƒõ§”ñ8ûy-Â.o5Î1Ü*ˆTäw8i¿»‹ëK\'İ`æ}ú*¿­šÿ\0M™cuxî=m©§£¨s{Úº‡€÷µ§~Á¾À9ïòXû.æ7K\rş“¤Ç;úk­GMhcÄ­o\'oõxÌüÏ5rE¬0LıGÓY’@.î\Zxâ;ŸÃ‘Rê\"(»´¥ìY´–êÆ¼¶jòÊ8öñâ;¸C\\¶Úeu‡J±êIÃ3éş“ Ûòş~ 8’îÑällsäpk\Z7sœv\0y•\\5k´Ciê¤±iÔbºàçwF¼7İ6‰¿lïãÓÈÊc:t¼CS—êíÚ¦’‘‘š™â|œU.`ün;†åŸJm=.SŸÓÑY([ECYXÊzjv’K#.\0nO2í¹’|WôrŠš::H) hlPÆØØ€aú,Èˆˆˆˆˆˆˆˆˆ«¯h‡»+Ô¼/§.s ¨©\r;ìí·#Í¬cÏÍXˆØØãk#¬h\rh\0/¤X+ªéè(§«­š8)`a’IdvÍc@Ü’UGÔÍHÈ5ƒ&n§ÑÎÛCÜZç7v\Z:¾CöcG¯=€›4sFìÚ{JÊ©šË†@æÿ\0±íå›bê^§òQÏk,îYßK€ØK¥ª©sZØ¹“¹Ü^äìâ>êôŸ6ÑkW	šÚxæ#˜2¶\"÷~;|•İE«Éï´ÕŠ®ív˜CILÂ÷ÔùæOEh&¦åZƒ¨—£Vè›Ç	‘°ÀîOİI<÷ßÕXTDDDDDDD_sXÇ9ä5­’z\0«¾‡0ç\ZÁ–gS´º–\Zj\"áÓ‹ánŞ¢6€~ú±(Š£ë†}tÔÜº,€OİÊø*©æIğ½wèvßÉOºE¦öÍ:Ç™IHÖÍr˜VVüR»Èy4xø¯n©æôXWx¬-tÀwt°ÎiHø[íâ}Pf2¯(Éëµ\'ÂgšWH?½œıi=›¾Ã×Ùb¡wìNÙ3Š£ÊªgËûÈ~Ìì­zñ]®ÖûE3ª.•´Ô´n_4ƒóT»]µ>MD¿~Î¶Ìøqª\'Ş£¿pûd~@x,Z-©Séı¢ã²ÎÚúêùZîñî;44ÀnzŸßTj±_`’{u¥Öú0Òã+høÖ¹%òoËÕl;9gKœVÒİ«ä¸Û#Î™Òm´ná-;xJÊ¢\"\"\"\"‹óİO’İ{8Ş#ouß ?ƒGpŸ#·2@ëĞÔ-[)ušF\n§VÚ¢wş“h÷öß„õ/¸u/%Æ¦dş7$P—pı6nßÔ´üœ=”Ÿa¾[oô-«´VEUêXy´ù8uĞ®´^Wû±¦Õ‘Àş\Zû§ö(\0<Àp<nù7q¿p[]Äÿ\0s´êÙA+8+foÒª+À;º8[şUİ¢‚»RêK±lq˜õrËÍÑ‡¼sÅ	ô.æÑé¿¢övhÓá˜Ûo7Xv¿ÜãppçOæ#÷<‹¾CÁLuµPPÑÏWY+!¦†I$yÙ¬h’O²¦¹\rÂãÚW!¡ 2ÃQí¹E\0?‡ùßà=‡Vn§)ÂğE5­÷:*:z8ÄQÓFî7´Ó…»ıOŠ«\Zé˜Û2LæÛ“aÌ«Š¶‰­ï$‘¼eİ®\0Ó§?ñ{×ìº÷›ûU–ÈÈç,\\ú¹ŸÍsØ¾7–ê¥ìABjç„»øõÕNqc™qı58æZâ\ZQz«¥lÕ·Šz^?¤Jíš¸â-håÓ~»­çdxh¤ÓGÊØ 5l­‘“€qí³HõÛšÕö—Ô	İàøÛİ5}[ƒjÌ\\Èòˆmâ|ıRVŒ`pàx|4kMÎ£ik$/Ûêïä:~+½DDDD\\–ªd§Ánw8Õ!Í?¤äÓòß’ÑhV#ƒ‚çVÎ;ÅÕ‚¢ywpc¾&·b	õ>IKM<5P>\n˜£šã‘¡Ípò õQUÿ\0MëlUî½éÕK¨êÇ9(K¿‡ ònü¿Êyy¢ëmê]aÖ[$7ß£Ò[l­â4ÜÒ´‚àê\\àÑ·û-*Õ\"ò]î4ö‹UeÆ¹ıİ-$/Wy5 “ùQ´~ÓQ¬:ÑrË/±qÛ(¥.‰ÜÛ¿Hbö\0n|ø}U¥És\Zˆ¾õu¦¦pİ—q<û4sUg^µ™ùÌqâø„U-·Èñô‰Ùõ$L\0thê|ùy/§ô´QÛ-ÑKg¤ª=äÒJã	——W}¢=‡OÄ©gìçiÍ›#ºT×ÍÕÑÃü6oîw\'òRƒÆ,1pZì”QrØ½Ñ‡¼û¹Û•©­Ò,²äêêŒf„Ô;ëp‚Ö“çÂß’ìm–ê;Ut–ÚXiic2(X\ZÑòòïA\rÖÕYoªoQ:G\rê©õuG®×»–ß5D5¤wS²Ò³É²0\\[¹©KA´–¶Õp~Yšƒ%òb_2\'DOW»ù½<ôˆˆˆˆŠíN÷·Oè\ZÓ³rŒ8yîE/QG4pE&FÖ°\0%™]¯ùÛ±PPÛ]~»oOJÖssäé\0#}‡©Ej0İ ¢ÓúJJç:‰çé2Ö3™Gü?V·`=÷ ÖÊË˜^1\nÈìùäO}9<0\\Ø8ƒ‡ó¬<ARc®T-·ŠçVS¶ˆ·ˆNd›yñtUç´–¬Y+0jì®5UUr29¥‰§»ƒ»‡ûË–Ä¨÷H­:‡]ˆ²İˆÇ=\rª¦GO5XÚ!#Ã¹ó \0ÁrZ‡GOiº¶ÍAsuúÿ\0#ø\'’›wÇÉÛ»iê÷ïò9–G³¶³	·‹ÖAoÈê[É§g}‡ìç>\'ä<w•-ò}2ûW3H1@;±ïÿ\0[­Ò\"\"\"\"\"\"\"\";DYİwÒë‹£kŸ-ÙXÀÑ¿Õ;;ğkœ~K¢Òûôy&e¸Ç(’GS¶9ùó°p¼˜\'Ø…Ô­NUÛ±k\rUŞñ0Š’»Ÿö|\ZÑâãĞ\niŠá¨yœÚ“•Æ[MË-4®æÖ†’†ÿ\0e¼ö>.Üøsœo—«mŠ‰ÕwzØ))Ûö¥vÛúÔŸ@ ¼ëZ)oñÉdÅì.»¾\0ú˜ÉùµƒşGp¸ˆôƒP®t®¾WÅBÇû=Òü`¥±ôóô+Õ’à¸ÅÏO*­¶:yh2ÈÙv¸<ñL[¿mw&÷äpäìU\ZÇrÆi0›M²éGn‹è¦œ–I™Ûl9‘ÈÇ.jvĞı Á[Úôc¯ÈÜ9<s›~¡›õw›Ëo3$¼²‚MNxëçøc¼ÈßÅz¬³í±Äı»ç|ræ+bˆˆˆˆˆˆˆˆ¾\'Š9á’˜Ù\"‘¥c†áÀˆ*»Ñ×WhF_SG_õxMÒS,Æ8¼¾ğ<@tÙw·=sÀèíÏ©†ìúÉCwe<4òq¼ù|@ó!Gq[ïZ¿y‡ Í£u‹¡ì4òIÀ&çbwñ~Ã—&ù­ÖM¬\\2Eé¯éR1¢¥d?@cÀzòô^K&ä9]knºvœqsú3_Å&Ş[ıVAºš1ŒRÉŒRˆ,–è)FÛ9á»½Şî<Êİ­M÷µ_#á¹QÇ+‡! ø^ßgkšn=Ül7úê8Ï>éÇ‰»üˆıfcÙ;øYQ’Ï;~_ªÜØ±ªKT†w=õU„îg›™ŞKxˆˆˆˆˆˆˆˆˆ°ÖÒSWRÉM[OE<ƒgÅ+ÚáäAäT_–Z´ÛNèİp©Çí†±äºBG½ßÊ¿ßÇ \\“0ÖJï§Ş*_lÇÿ\0…„&7íæ*oÃp»&!D ³R5’´“¿â’OwÀr]\Z\"\"ò×\\(íñ™+j¡ƒÆG†®Jã©Øå!sa¨’­ãÂÌ­3µórqmƒšMú>@OéËóY›.£W´m%>|;Õ}ÅŒfs*¼G¿Ùa\'ôeıÇ½ÉÎl¢«åâÿ\0ä³ŒW$‡şï“Êí¿óÿ\0Ü¬“3µ3ø±Òİ#oRÎN?§èVÚÏ“AuŞÅ%5{GÇƒ˜óÛÍt\rß„quñ_¨ˆˆˆˆ‹O—_é1Œ~®ë\\Ouy4u{Fr¡8Äj5# ªËó½ô.“û=9$5ûx}ÁÓÕX8b™,lq°µàûD^+¥Ö‚Õ	–ãY3=äxûÀŞ5vÓÌ6jiî3ô£…»ş§ğZ¡U¨¹Q6ÙèİÑÇà;{Ÿˆ­“Å4‚l‚ëU])ææ´ì?¹]§°Úš>‡l§míãwâVõ­k\Z\ZÆ†àËõru”Uu,í…Ì0¼—J\"Í¹ëªëF½ èkkôòVPBé„S²Yƒz†\r÷;{²éYb­Ã­”UAMWK…ôò<5ÜC©{õR–6õ‘ƒÜ­UÏ\'±ÚÁ5÷Z8HêÓ(.ü5ÅŞµ¤İ–ÆOr›Ã»oÏò\\øÉ5-<6[wìÚGÿ\0Š[ÃËï;şekÒ\'UL*²«´õ³ndn;Qçù)\nÉŒÙìq†Û-ğBGÛáİÇæy­Â\"\"\"\"\"\"\"\"\"\"/Çµ¯ikÀs\\6 Á\n.È4S¸K$öéjm³½ÅßÃ<LîŸŠÒ³CGñ2jƒíÿ\0e¶µè\rq­­­xõƒúŸÍv¶L/²ë}ª’ñ8İøö]\n\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"/ÿÙ','$2y$10$8pCrIavkkAOvYxu3Q0FL8OnKl4DjLJ78uqS0z7DF52TqEFkNxzW1K',0,NULL),(5,'2018-10-03 06:40:44','2018-10-03 06:40:44','MarÃ­a de los Angeles','Villavicencio','Marquez','villa_22@gmail.com','ÿØÿà\0JFIF\0\0\0\0\0\0ÿÛ\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(ÿÀ\0\0ğ\0ğ\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0\0	ÿÄ\0F\0	\0\0\0\0!1AQaq\"2Br‘¡±#b’$3C‚¢R²Ááğ&4DSTÑÒâñÿÚ\0\0\0?\0µ(ˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆ¸,ëV°ü*WSİî}sFæ’•½ì£ÜMùµš}­øoyeªß%]%|&(ë#k;Ò<\ZCˆ\'ÑJˆˆˆˆˆˆˆˆˆˆˆˆŠ¾ë¾¨İMò,O‹¥½Ôê¦x9¾\"ÃağvÜË¼¯Ovšvy±Y©ã­Ì\ZÛİáÿ\0Ù!&ˆíŸW~€í!aµâúƒÔb”´ò½®0ÒÆ#kœÉYÀx@Û}Éú+f:sDDDDDDDDDDDDEÇêÎ^Ì¹^NÎ¨c{ªfµ3¹7ä:Ÿ@T_Ùc}=²§6¾0Ëvº¹Æò\rÜØ‰<O÷yßäš°\nªRÌ5_µu0o5’Á±kÇ6–ÂwüÒŸÁZ´DDDDDDDDDDDDU«µUmEÿ\0+Äpz|u2¶i‡İİ³aÆ~jÅZ( µZ¨íôà§¥…Æß&´\0?Ev•ÔÜÌ)Ô6ù6½]ƒ ƒ„üQÇÑò~aê}nÎÂ0Xæ®‹†ótá¨©ß«·ÁÈÏ©*XDDDDDDDDDDDDEXìŸöÃµÍ}Iøé¬ÁûÌé‚1ş·¬VI{ Æìu—k¼í‚Š–3$?d@x’«•Ú+õ£Ujóœ\",Vé@¥§w6—7œq0ß¬ï2}U®DDDDDDDDDDDDEñ4†%yÙ¬iq>V^ËSEQg¹eÆHá‡‹wÏ!Ù¬{äq$ô`´¹…öíÚ?ƒÆL´ø¥øæ¨ €àÆW>¡ÿ\0Ö‡Çíøµ‚Ïg€CEJÎ8ø’y’¶Èˆˆˆˆˆˆˆˆˆˆˆˆ¹mR¼AbÓÜ‚º¢xá-¢•±—»mŞæĞ<É$rT¯Mmyvso“\rÆƒ¡³ÍR*®ÁÈŞ;Ä\r·\rñ>Ü®®aœ†Óf‹§Å<îòx¹Çôuˆˆ‹ˆÏ5KÁ«i¨ïõîe\\ûQ™Ö“·¶èi¬å‰ÁñÈĞö¸t Á_hˆˆˆˆˆˆˆ¼÷\núKu3ênPRÓ³›¥@Æry(SP»Fãv\"ú<b7_î_T:#ÃN×}ş®ÿ\0(Øù¨O?±ê[‹WfùìòQÛéøE%€³~7†¾Èç¿¹¼z«#Ù²×³G¬|5’T‰*$ l\\\\÷lOŸÂà¤äDDEÌê>[I„aõ÷Êİœ fÑG¾ÆY&´{ŸËuBíPİu\'R©b­•ó×İëzş¼-\'w@Öƒòú-K)©¡‚!´q01£Ğ\r‚Èˆˆˆˆˆˆ±ÔÆé©¥’:\'½…¢Fõa#¨öU‚M2Ö¼n¢İÜ¹ÕôååÍâ­vîÜõ,”ƒìJüıÒírÕUÿ\0èŒw\"ï¦FÍ¾qÖZ.ÍÙò©µæg%IfIPò<ƒäÛoÀ©ƒ\0Ò<Csfµ[„õãÿ\0VD²ºvÙ¿år=®«\r>–Å\0;}&á¨\rs¿P¦ŸAÓœfœ‹-Ğn=K?ªé‘=ím™:õ—ÓbÔ²ÿ\0aµ7½©á<1Ÿéo/rVã±Æ#ßÖİ2ê¸¾¿±Ñî9Èö-ù•j‘uíP]gÅííë=\\’m÷Z\Z?ßV\nß\0¦·Ó@Ñ°Š&°`ô\"\"\"Ôe÷È1¬bçyªÛº¢§|Ä·ù‡Í9ë*k¯÷jŠ‰8§¹İª‰ s..vû|ÜGô¯èNšãaØ=¢ÇTĞõÃíÊy¼ÿ\0Q+¦DDDDDDDDDU¿´~×m[ÓÛ ç¼¬{‡£æhıUDEŠ»×ÉÃõZxwó+**óÛ(4·§~Ó\\¦ïf\0óî™Ğ|ÜGô¨·²®#ûÇ¨‚íQ¾ÈÁ($r3Äcıç{…vW€şÜí{h§Û‰–Ø¿§N“ÅáXôE®¼W}‚Šªo…ŒŸºõPÓŠZVDäs\'Ì¬è¨_i|äZ³rlOã§·mCmúßê.V¯³î\Z0Í6·Á<|\nÑôÊ­Ç0ç³OİnÃßu$¢\"\"\"\"\"\".2ÔÛe†¿ö]º	¯¢î¢Róáw“±çè>{-<w=U¹°M¦×m‰ÜÚÙˆãÛÈ‚â ³Œ‹Qmd:ëŒÒ×@:š7ügäï÷Wº×ª¶Y¥÷x+-5]ÊˆÉh>ãŸâíí÷*+”]í¾®\n˜ÿ\0ÚŠ@í½öè«æŒñ_»CçwÇ|qÓw°1Ş[ÈßôÆUE§½_©­¤BÃßÖ¿“ g3¹é¿’ù±Û§l®¯¹êé:Ç[¤Zœºñ?‹İnóGM$ÜüHiØ|ÎÁR]\0Ä¥Ô\rQeUÅ†Z\ZI\r}kœ7<[µ§ï;ò_DDDDDDEkNUSc1SZ‹¿kİ%ú%/ø›¿Öpõ€=\\\n÷é®E‡ZY»Y=ŞfñUU¸nç8ó-i=\ZãÔ®É’ål¡¹ÅİÜhéê™à%Œ;omú.-À1û]åx£}]µÔtòTO)ÛáiwC¹ğğ!Dİ™1ì™ØíÖıe¹A«*û·¶¡›÷œ}÷Øø¼©®9óØ÷kémríö÷ÛõÑem³-¸ì.Jz(OÖe3~/ÇşkwcÇ¨­&ºZƒõ§”ñ8ûy-Â.o5Î1Ü*ˆTäw8i¿»‹ëK\'İ`æ}ú*¿­šÿ\0M™cuxî=m©§£¨s{Úº‡€÷µ§~Á¾À9ïòXû.æ7K\rş“¤Ç;úk­GMhcÄ­o\'oõxÌüÏ5rE¬0LıGÓY’@.î\Zxâ;ŸÃ‘Rê\"(»´¥ìY´–êÆ¼¶jòÊ8öñâ;¸C\\¶Úeu‡J±êIÃ3éş“ Ûòş~ 8’îÑällsäpk\Z7sœv\0y•\\5k´Ciê¤±iÔbºàçwF¼7İ6‰¿lïãÓÈÊc:t¼CS—êíÚ¦’‘‘š™â|œU.`ün;†åŸJm=.SŸÓÑY([ECYXÊzjv’K#.\0nO2í¹’|WôrŠš::H) hlPÆØØ€aú,Èˆˆˆˆˆˆˆˆˆ«¯h‡»+Ô¼/§.s ¨©\r;ìí·#Í¬cÏÍXˆØØãk#¬h\rh\0/¤X+ªéè(§«­š8)`a’IdvÍc@Ü’UGÔÍHÈ5ƒ&n§ÑÎÛCÜZç7v\Z:¾CöcG¯=€›4sFìÚ{JÊ©šË†@æÿ\0±íå›bê^§òQÏk,îYßK€ØK¥ª©sZØ¹“¹Ü^äìâ>êôŸ6ÑkW	šÚxæ#˜2¶\"÷~;|•İE«Éï´ÕŠ®ív˜CILÂ÷ÔùæOEh&¦åZƒ¨—£Vè›Ç	‘°ÀîOİI<÷ßÕXTDDDDDDD_sXÇ9ä5­’z\0«¾‡0ç\ZÁ–gS´º–\Zj\"áÓ‹ánŞ¢6€~ú±(Š£ë†}tÔÜº,€OİÊø*©æIğ½wèvßÉOºE¦öÍ:Ç™IHÖÍr˜VVüR»Èy4xø¯n©æôXWx¬-tÀwt°ÎiHø[íâ}Pf2¯(Éëµ\'ÂgšWH?½œıi=›¾Ã×Ùb¡wìNÙ3Š£ÊªgËûÈ~Ìì­zñ]®ÖûE3ª.•´Ô´n_4ƒóT»]µ>MD¿~Î¶Ìøqª\'Ş£¿pûd~@x,Z-©Séı¢ã²ÎÚúêùZîñî;44ÀnzŸßTj±_`’{u¥Öú0Òã+høÖ¹%òoËÕl;9gKœVÒİ«ä¸Û#Î™Òm´ná-;xJÊ¢\"\"\"\"‹óİO’İ{8Ş#ouß ?ƒGpŸ#·2@ëĞÔ-[)ušF\n§VÚ¢wş“h÷öß„õ/¸u/%Æ¦dş7$P—pı6nßÔ´üœ=”Ÿa¾[oô-«´VEUêXy´ù8uĞ®´^Wû±¦Õ‘Àş\Zû§ö(\0<Àp<nù7q¿p[]Äÿ\0s´êÙA+8+foÒª+À;º8[şUİ¢‚»RêK±lq˜õrËÍÑ‡¼sÅ	ô.æÑé¿¢övhÓá˜Ûo7Xv¿ÜãppçOæ#÷<‹¾CÁLuµPPÑÏWY+!¦†I$yÙ¬h’O²¦¹\rÂãÚW!¡ 2ÃQí¹E\0?‡ùßà=‡Vn§)ÂğE5­÷:*:z8ÄQÓFî7´Ó…»ıOŠ«\Zé˜Û2LæÛ“aÌ«Š¶‰­ï$‘¼eİ®\0Ó§?ñ{×ìº÷›ûU–ÈÈç,\\ú¹ŸÍsØ¾7–ê¥ìABjç„»øõÕNqc™qı58æZâ\ZQz«¥lÕ·Šz^?¤Jíš¸â-håÓ~»­çdxh¤ÓGÊØ 5l­‘“€qí³HõÛšÕö—Ô	İàøÛİ5}[ƒjÌ\\Èòˆmâ|ıRVŒ`pàx|4kMÎ£ik$/Ûêïä:~+½DDDD\\–ªd§Ánw8Õ!Í?¤äÓòß’ÑhV#ƒ‚çVÎ;ÅÕ‚¢ywpc¾&·b	õ>IKM<5P>\n˜£šã‘¡Ípò õQUÿ\0MëlUî½éÕK¨êÇ9(K¿‡ ònü¿Êyy¢ëmê]aÖ[$7ß£Ò[l­â4ÜÒ´‚àê\\àÑ·û-*Õ\"ò]î4ö‹UeÆ¹ıİ-$/Wy5 “ùQ´~ÓQ¬:ÑrË/±qÛ(¥.‰ÜÛ¿Hbö\0n|ø}U¥És\Zˆ¾õu¦¦pİ—q<û4sUg^µ™ùÌqâø„U-·Èñô‰Ùõ$L\0thê|ùy/§ô´QÛ-ÑKg¤ª=äÒJã	——W}¢=‡OÄ©gìçiÍ›#ºT×ÍÕÑÃü6oîw\'òRƒÆ,1pZì”QrØ½Ñ‡¼û¹Û•©­Ò,²äêêŒf„Ô;ëp‚Ö“çÂß’ìm–ê;Ut–ÚXiic2(X\ZÑòòïA\rÖÕYoªoQ:G\rê©õuG®×»–ß5D5¤wS²Ò³É²0\\[¹©KA´–¶Õp~Yšƒ%òb_2\'DOW»ù½<ôˆˆˆˆŠíN÷·Oè\ZÓ³rŒ8yîE/QG4pE&FÖ°\0%™]¯ùÛ±PPÛ]~»oOJÖssäé\0#}‡©Ej0İ ¢ÓúJJç:‰çé2Ö3™Gü?V·`=÷ ÖÊË˜^1\nÈìùäO}9<0\\Ø8ƒ‡ó¬<ARc®T-·ŠçVS¶ˆ·ˆNd›yñtUç´–¬Y+0jì®5UUr29¥‰§»ƒ»‡ûË–Ä¨÷H­:‡]ˆ²İˆÇ=\rª¦GO5XÚ!#Ã¹ó \0ÁrZ‡GOiº¶ÍAsuúÿ\0#ø\'’›wÇÉÛ»iê÷ïò9–G³¶³	·‹ÖAoÈê[É§g}‡ìç>\'ä<w•-ò}2ûW3H1@;±ïÿ\0[­Ò\"\"\"\"\"\"\"\";DYİwÒë‹£kŸ-ÙXÀÑ¿Õ;;ğkœ~K¢Òûôy&e¸Ç(’GS¶9ùó°p¼˜\'Ø…Ô­NUÛ±k\rUŞñ0Š’»Ÿö|\ZÑâãĞ\niŠá¨yœÚ“•Æ[MË-4®æÖ†’†ÿ\0e¼ö>.Üøsœo—«mŠ‰ÕwzØ))Ûö¥vÛúÔŸ@ ¼ëZ)oñÉdÅì.»¾\0ú˜ÉùµƒşGp¸ˆôƒP®t®¾WÅBÇû=Òü`¥±ôóô+Õ’à¸ÅÏO*­¶:yh2ÈÙv¸<ñL[¿mw&÷äpäìU\ZÇrÆi0›M²éGn‹è¦œ–I™Ûl9‘ÈÇ.jvĞı Á[Úôc¯ÈÜ9<s›~¡›õw›Ëo3$¼²‚MNxëçøc¼ÈßÅz¬³í±Äı»ç|ræ+bˆˆˆˆˆˆˆˆ¾\'Š9á’˜Ù\"‘¥c†áÀˆ*»Ñ×WhF_SG_õxMÒS,Æ8¼¾ğ<@tÙw·=sÀèíÏ©†ìúÉCwe<4òq¼ù|@ó!Gq[ïZ¿y‡ Í£u‹¡ì4òIÀ&çbwñ~Ã—&ù­ÖM¬\\2Eé¯éR1¢¥d?@cÀzòô^K&ä9]knºvœqsú3_Å&Ş[ıVAºš1ŒRÉŒRˆ,–è)FÛ9á»½Şî<Êİ­M÷µ_#á¹QÇ+‡! ø^ßgkšn=Ül7úê8Ï>éÇ‰»üˆıfcÙ;øYQ’Ï;~_ªÜØ±ªKT†w=õU„îg›™ŞKxˆˆˆˆˆˆˆˆˆ°ÖÒSWRÉM[OE<ƒgÅ+ÚáäAäT_–Z´ÛNèİp©Çí†±äºBG½ßÊ¿ßÇ \\“0ÖJï§Ş*_lÇÿ\0…„&7íæ*oÃp»&!D ³R5’´“¿â’OwÀr]\Z\"\"ò×\\(íñ™+j¡ƒÆG†®Jã©Øå!sa¨’­ãÂÌ­3µórqmƒšMú>@OéËóY›.£W´m%>|;Õ}ÅŒfs*¼G¿Ùa\'ôeıÇ½ÉÎl¢«åâÿ\0ä³ŒW$‡şï“Êí¿óÿ\0Ü¬“3µ3ø±Òİ#oRÎN?§èVÚÏ“AuŞÅ%5{GÇƒ˜óÛÍt\rß„quñ_¨ˆˆˆˆ‹O—_é1Œ~®ë\\Ouy4u{Fr¡8Äj5# ªËó½ô.“û=9$5ûx}ÁÓÕX8b™,lq°µàûD^+¥Ö‚Õ	–ãY3=äxûÀŞ5vÓÌ6jiî3ô£…»ş§ğZ¡U¨¹Q6ÙèİÑÇà;{Ÿˆ­“Å4‚l‚ëU])ææ´ì?¹]§°Úš>‡l§míãwâVõ­k\Z\ZÆ†àËõru”Uu,í…Ì0¼—J\"Í¹ëªëF½ èkkôòVPBé„S²Yƒz†\r÷;{²éYb­Ã­”UAMWK…ôò<5ÜC©{õR–6õ‘ƒÜ­UÏ\'±ÚÁ5÷Z8HêÓ(.ü5ÅŞµ¤İ–ÆOr›Ã»oÏò\\øÉ5-<6[wìÚGÿ\0Š[ÃËï;şekÒ\'UL*²«´õ³ndn;Qçù)\nÉŒÙìq†Û-ğBGÛáİÇæy­Â\"\"\"\"\"\"\"\"\"\"/Çµ¯ikÀs\\6 Á\n.È4S¸K$öéjm³½ÅßÃ<LîŸŠÒ³CGñ2jƒíÿ\0e¶µè\rq­­­xõƒúŸÍv¶L/²ë}ª’ñ8İøö]\n\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"/ÿÙ','$2y$10$N5i6fh5qxS6YCo.Rzg5z2e7YPPDlxZm30IlBjhjzcovojZxbZx61W',0,NULL),(6,'2018-10-03 06:40:44','2018-10-03 06:40:44','Eduardo Javier','Reyes','Norman','eddjrn@gmail.com','ÿØÿà\0JFIF\0\0\0\0\0\0ÿÛ\0C\0\n\n\n		\n\Z%\Z# , #&\')*)-0-(0%()(ÿÀ\0\0ğ\0ğ\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0\0	ÿÄ\0F\0	\0\0\0\0!1AQaq\"2Br‘¡±#b’$3C‚¢R²Ááğ&4DSTÑÒâñÿÚ\0\0\0?\0µ(ˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆˆ¸,ëV°ü*WSİî}sFæ’•½ì£ÜMùµš}­øoyeªß%]%|&(ë#k;Ò<\ZCˆ\'ÑJˆˆˆˆˆˆˆˆˆˆˆˆŠ¾ë¾¨İMò,O‹¥½Ôê¦x9¾\"ÃağvÜË¼¯Ovšvy±Y©ã­Ì\ZÛİáÿ\0Ù!&ˆíŸW~€í!aµâúƒÔb”´ò½®0ÒÆ#kœÉYÀx@Û}Éú+f:sDDDDDDDDDDDDEÇêÎ^Ì¹^NÎ¨c{ªfµ3¹7ä:Ÿ@T_Ùc}=²§6¾0Ëvº¹Æò\rÜØ‰<O÷yßäš°\nªRÌ5_µu0o5’Á±kÇ6–ÂwüÒŸÁZ´DDDDDDDDDDDDU«µUmEÿ\0+Äpz|u2¶i‡İİ³aÆ~jÅZ( µZ¨íôà§¥…Æß&´\0?Ev•ÔÜÌ)Ô6ù6½]ƒ ƒ„üQÇÑò~aê}nÎÂ0Xæ®‹†ótá¨©ß«·ÁÈÏ©*XDDDDDDDDDDDDEXìŸöÃµÍ}Iøé¬ÁûÌé‚1ş·¬VI{ Æìu—k¼í‚Š–3$?d@x’«•Ú+õ£Ujóœ\",Vé@¥§w6—7œq0ß¬ï2}U®DDDDDDDDDDDDEñ4†%yÙ¬iq>V^ËSEQg¹eÆHá‡‹wÏ!Ù¬{äq$ô`´¹…öíÚ?ƒÆL´ø¥øæ¨ €àÆW>¡ÿ\0Ö‡Çíøµ‚Ïg€CEJÎ8ø’y’¶Èˆˆˆˆˆˆˆˆˆˆˆˆ¹mR¼AbÓÜ‚º¢xá-¢•±—»mŞæĞ<É$rT¯Mmyvso“\rÆƒ¡³ÍR*®ÁÈŞ;Ä\r·\rñ>Ü®®aœ†Óf‹§Å<îòx¹Çôuˆˆ‹ˆÏ5KÁ«i¨ïõîe\\ûQ™Ö“·¶èi¬å‰ÁñÈĞö¸t Á_hˆˆˆˆˆˆˆ¼÷\núKu3ênPRÓ³›¥@Æry(SP»Fãv\"ú<b7_î_T:#ÃN×}ş®ÿ\0(Øù¨O?±ê[‹WfùìòQÛéøE%€³~7†¾Èç¿¹¼z«#Ù²×³G¬|5’T‰*$ l\\\\÷lOŸÂà¤äDDEÌê>[I„aõ÷Êİœ fÑG¾ÆY&´{ŸËuBíPİu\'R©b­•ó×İëzş¼-\'w@Öƒòú-K)©¡‚!´q01£Ğ\r‚Èˆˆˆˆˆˆ±ÔÆé©¥’:\'½…¢Fõa#¨öU‚M2Ö¼n¢İÜ¹ÕôååÍâ­vîÜõ,”ƒìJüıÒírÕUÿ\0èŒw\"ï¦FÍ¾qÖZ.ÍÙò©µæg%IfIPò<ƒäÛoÀ©ƒ\0Ò<Csfµ[„õãÿ\0VD²ºvÙ¿år=®«\r>–Å\0;}&á¨\rs¿P¦ŸAÓœfœ‹-Ğn=K?ªé‘=ím™:õ—ÓbÔ²ÿ\0aµ7½©á<1Ÿéo/rVã±Æ#ßÖİ2ê¸¾¿±Ñî9Èö-ù•j‘uíP]gÅííë=\\’m÷Z\Z?ßV\nß\0¦·Ó@Ñ°Š&°`ô\"\"\"Ôe÷È1¬bçyªÛº¢§|Ä·ù‡Í9ë*k¯÷jŠ‰8§¹İª‰ s..vû|ÜGô¯èNšãaØ=¢ÇTĞõÃíÊy¼ÿ\0Q+¦DDDDDDDDDU¿´~×m[ÓÛ ç¼¬{‡£æhıUDEŠ»×ÉÃõZxwó+**óÛ(4·§~Ó\\¦ïf\0óî™Ğ|ÜGô¨·²®#ûÇ¨‚íQ¾ÈÁ($r3Äcıç{…vW€şÜí{h§Û‰–Ø¿§N“ÅáXôE®¼W}‚Šªo…ŒŸºõPÓŠZVDäs\'Ì¬è¨_i|äZ³rlOã§·mCmúßê.V¯³î\Z0Í6·Á<|\nÑôÊ­Ç0ç³OİnÃßu$¢\"\"\"\"\"\".2ÔÛe†¿ö]º	¯¢î¢Róáw“±çè>{-<w=U¹°M¦×m‰ÜÚÙˆãÛÈ‚â ³Œ‹Qmd:ëŒÒ×@:š7ügäï÷Wº×ª¶Y¥÷x+-5]ÊˆÉh>ãŸâíí÷*+”]í¾®\n˜ÿ\0ÚŠ@í½öè«æŒñ_»CçwÇ|qÓw°1Ş[ÈßôÆUE§½_©­¤BÃßÖ¿“ g3¹é¿’ù±Û§l®¯¹êé:Ç[¤Zœºñ?‹İnóGM$ÜüHiØ|ÎÁR]\0Ä¥Ô\rQeUÅ†Z\ZI\r}kœ7<[µ§ï;ò_DDDDDDEkNUSc1SZ‹¿kİ%ú%/ø›¿Öpõ€=\\\n÷é®E‡ZY»Y=ŞfñUU¸nç8ó-i=\ZãÔ®É’ål¡¹ÅİÜhéê™à%Œ;omú.-À1û]åx£}]µÔtòTO)ÛáiwC¹ğğ!Dİ™1ì™ØíÖıe¹A«*û·¶¡›÷œ}÷Øø¼©®9óØ÷kémríö÷ÛõÑem³-¸ì.Jz(OÖe3~/ÇşkwcÇ¨­&ºZƒõ§”ñ8ûy-Â.o5Î1Ü*ˆTäw8i¿»‹ëK\'İ`æ}ú*¿­šÿ\0M™cuxî=m©§£¨s{Úº‡€÷µ§~Á¾À9ïòXû.æ7K\rş“¤Ç;úk­GMhcÄ­o\'oõxÌüÏ5rE¬0LıGÓY’@.î\Zxâ;ŸÃ‘Rê\"(»´¥ìY´–êÆ¼¶jòÊ8öñâ;¸C\\¶Úeu‡J±êIÃ3éş“ Ûòş~ 8’îÑällsäpk\Z7sœv\0y•\\5k´Ciê¤±iÔbºàçwF¼7İ6‰¿lïãÓÈÊc:t¼CS—êíÚ¦’‘‘š™â|œU.`ün;†åŸJm=.SŸÓÑY([ECYXÊzjv’K#.\0nO2í¹’|WôrŠš::H) hlPÆØØ€aú,Èˆˆˆˆˆˆˆˆˆ«¯h‡»+Ô¼/§.s ¨©\r;ìí·#Í¬cÏÍXˆØØãk#¬h\rh\0/¤X+ªéè(§«­š8)`a’IdvÍc@Ü’UGÔÍHÈ5ƒ&n§ÑÎÛCÜZç7v\Z:¾CöcG¯=€›4sFìÚ{JÊ©šË†@æÿ\0±íå›bê^§òQÏk,îYßK€ØK¥ª©sZØ¹“¹Ü^äìâ>êôŸ6ÑkW	šÚxæ#˜2¶\"÷~;|•İE«Éï´ÕŠ®ív˜CILÂ÷ÔùæOEh&¦åZƒ¨—£Vè›Ç	‘°ÀîOİI<÷ßÕXTDDDDDDD_sXÇ9ä5­’z\0«¾‡0ç\ZÁ–gS´º–\Zj\"áÓ‹ánŞ¢6€~ú±(Š£ë†}tÔÜº,€OİÊø*©æIğ½wèvßÉOºE¦öÍ:Ç™IHÖÍr˜VVüR»Èy4xø¯n©æôXWx¬-tÀwt°ÎiHø[íâ}Pf2¯(Éëµ\'ÂgšWH?½œıi=›¾Ã×Ùb¡wìNÙ3Š£ÊªgËûÈ~Ìì­zñ]®ÖûE3ª.•´Ô´n_4ƒóT»]µ>MD¿~Î¶Ìøqª\'Ş£¿pûd~@x,Z-©Séı¢ã²ÎÚúêùZîñî;44ÀnzŸßTj±_`’{u¥Öú0Òã+høÖ¹%òoËÕl;9gKœVÒİ«ä¸Û#Î™Òm´ná-;xJÊ¢\"\"\"\"‹óİO’İ{8Ş#ouß ?ƒGpŸ#·2@ëĞÔ-[)ušF\n§VÚ¢wş“h÷öß„õ/¸u/%Æ¦dş7$P—pı6nßÔ´üœ=”Ÿa¾[oô-«´VEUêXy´ù8uĞ®´^Wû±¦Õ‘Àş\Zû§ö(\0<Àp<nù7q¿p[]Äÿ\0s´êÙA+8+foÒª+À;º8[şUİ¢‚»RêK±lq˜õrËÍÑ‡¼sÅ	ô.æÑé¿¢övhÓá˜Ûo7Xv¿ÜãppçOæ#÷<‹¾CÁLuµPPÑÏWY+!¦†I$yÙ¬h’O²¦¹\rÂãÚW!¡ 2ÃQí¹E\0?‡ùßà=‡Vn§)ÂğE5­÷:*:z8ÄQÓFî7´Ó…»ıOŠ«\Zé˜Û2LæÛ“aÌ«Š¶‰­ï$‘¼eİ®\0Ó§?ñ{×ìº÷›ûU–ÈÈç,\\ú¹ŸÍsØ¾7–ê¥ìABjç„»øõÕNqc™qı58æZâ\ZQz«¥lÕ·Šz^?¤Jíš¸â-håÓ~»­çdxh¤ÓGÊØ 5l­‘“€qí³HõÛšÕö—Ô	İàøÛİ5}[ƒjÌ\\Èòˆmâ|ıRVŒ`pàx|4kMÎ£ik$/Ûêïä:~+½DDDD\\–ªd§Ánw8Õ!Í?¤äÓòß’ÑhV#ƒ‚çVÎ;ÅÕ‚¢ywpc¾&·b	õ>IKM<5P>\n˜£šã‘¡Ípò õQUÿ\0MëlUî½éÕK¨êÇ9(K¿‡ ònü¿Êyy¢ëmê]aÖ[$7ß£Ò[l­â4ÜÒ´‚àê\\àÑ·û-*Õ\"ò]î4ö‹UeÆ¹ıİ-$/Wy5 “ùQ´~ÓQ¬:ÑrË/±qÛ(¥.‰ÜÛ¿Hbö\0n|ø}U¥És\Zˆ¾õu¦¦pİ—q<û4sUg^µ™ùÌqâø„U-·Èñô‰Ùõ$L\0thê|ùy/§ô´QÛ-ÑKg¤ª=äÒJã	——W}¢=‡OÄ©gìçiÍ›#ºT×ÍÕÑÃü6oîw\'òRƒÆ,1pZì”QrØ½Ñ‡¼û¹Û•©­Ò,²äêêŒf„Ô;ëp‚Ö“çÂß’ìm–ê;Ut–ÚXiic2(X\ZÑòòïA\rÖÕYoªoQ:G\rê©õuG®×»–ß5D5¤wS²Ò³É²0\\[¹©KA´–¶Õp~Yšƒ%òb_2\'DOW»ù½<ôˆˆˆˆŠíN÷·Oè\ZÓ³rŒ8yîE/QG4pE&FÖ°\0%™]¯ùÛ±PPÛ]~»oOJÖssäé\0#}‡©Ej0İ ¢ÓúJJç:‰çé2Ö3™Gü?V·`=÷ ÖÊË˜^1\nÈìùäO}9<0\\Ø8ƒ‡ó¬<ARc®T-·ŠçVS¶ˆ·ˆNd›yñtUç´–¬Y+0jì®5UUr29¥‰§»ƒ»‡ûË–Ä¨÷H­:‡]ˆ²İˆÇ=\rª¦GO5XÚ!#Ã¹ó \0ÁrZ‡GOiº¶ÍAsuúÿ\0#ø\'’›wÇÉÛ»iê÷ïò9–G³¶³	·‹ÖAoÈê[É§g}‡ìç>\'ä<w•-ò}2ûW3H1@;±ïÿ\0[­Ò\"\"\"\"\"\"\"\";DYİwÒë‹£kŸ-ÙXÀÑ¿Õ;;ğkœ~K¢Òûôy&e¸Ç(’GS¶9ùó°p¼˜\'Ø…Ô­NUÛ±k\rUŞñ0Š’»Ÿö|\ZÑâãĞ\niŠá¨yœÚ“•Æ[MË-4®æÖ†’†ÿ\0e¼ö>.Üøsœo—«mŠ‰ÕwzØ))Ûö¥vÛúÔŸ@ ¼ëZ)oñÉdÅì.»¾\0ú˜ÉùµƒşGp¸ˆôƒP®t®¾WÅBÇû=Òü`¥±ôóô+Õ’à¸ÅÏO*­¶:yh2ÈÙv¸<ñL[¿mw&÷äpäìU\ZÇrÆi0›M²éGn‹è¦œ–I™Ûl9‘ÈÇ.jvĞı Á[Úôc¯ÈÜ9<s›~¡›õw›Ëo3$¼²‚MNxëçøc¼ÈßÅz¬³í±Äı»ç|ræ+bˆˆˆˆˆˆˆˆ¾\'Š9á’˜Ù\"‘¥c†áÀˆ*»Ñ×WhF_SG_õxMÒS,Æ8¼¾ğ<@tÙw·=sÀèíÏ©†ìúÉCwe<4òq¼ù|@ó!Gq[ïZ¿y‡ Í£u‹¡ì4òIÀ&çbwñ~Ã—&ù­ÖM¬\\2Eé¯éR1¢¥d?@cÀzòô^K&ä9]knºvœqsú3_Å&Ş[ıVAºš1ŒRÉŒRˆ,–è)FÛ9á»½Şî<Êİ­M÷µ_#á¹QÇ+‡! ø^ßgkšn=Ül7úê8Ï>éÇ‰»üˆıfcÙ;øYQ’Ï;~_ªÜØ±ªKT†w=õU„îg›™ŞKxˆˆˆˆˆˆˆˆˆ°ÖÒSWRÉM[OE<ƒgÅ+ÚáäAäT_–Z´ÛNèİp©Çí†±äºBG½ßÊ¿ßÇ \\“0ÖJï§Ş*_lÇÿ\0…„&7íæ*oÃp»&!D ³R5’´“¿â’OwÀr]\Z\"\"ò×\\(íñ™+j¡ƒÆG†®Jã©Øå!sa¨’­ãÂÌ­3µórqmƒšMú>@OéËóY›.£W´m%>|;Õ}ÅŒfs*¼G¿Ùa\'ôeıÇ½ÉÎl¢«åâÿ\0ä³ŒW$‡şï“Êí¿óÿ\0Ü¬“3µ3ø±Òİ#oRÎN?§èVÚÏ“AuŞÅ%5{GÇƒ˜óÛÍt\rß„quñ_¨ˆˆˆˆ‹O—_é1Œ~®ë\\Ouy4u{Fr¡8Äj5# ªËó½ô.“û=9$5ûx}ÁÓÕX8b™,lq°µàûD^+¥Ö‚Õ	–ãY3=äxûÀŞ5vÓÌ6jiî3ô£…»ş§ğZ¡U¨¹Q6ÙèİÑÇà;{Ÿˆ­“Å4‚l‚ëU])ææ´ì?¹]§°Úš>‡l§míãwâVõ­k\Z\ZÆ†àËõru”Uu,í…Ì0¼—J\"Í¹ëªëF½ èkkôòVPBé„S²Yƒz†\r÷;{²éYb­Ã­”UAMWK…ôò<5ÜC©{õR–6õ‘ƒÜ­UÏ\'±ÚÁ5÷Z8HêÓ(.ü5ÅŞµ¤İ–ÆOr›Ã»oÏò\\øÉ5-<6[wìÚGÿ\0Š[ÃËï;şekÒ\'UL*²«´õ³ndn;Qçù)\nÉŒÙìq†Û-ğBGÛáİÇæy­Â\"\"\"\"\"\"\"\"\"\"/Çµ¯ikÀs\\6 Á\n.È4S¸K$öéjm³½ÅßÃ<LîŸŠÒ³CGñ2jƒíÿ\0e¶µè\rq­­­xõƒúŸÍv¶L/²ë}ª’ñ8İøö]\n\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"\"/ÿÙ','$2y$10$i.RcVuU9My743MpJMS0i5.dvBuxkrVlYX.rksQ26nWildi8wtHpb6',0,'9P6sch9ouBtQj94sPzziaCOjQfAOumW6mxIjhv6RKJsUGmG1GFFUYQlXVZv4');
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