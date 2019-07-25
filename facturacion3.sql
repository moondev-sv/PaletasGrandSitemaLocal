CREATE DATABASE  IF NOT EXISTS `cajaexpress_v3` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cajaexpress_v3`;
-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cajaexpress_v3
-- ------------------------------------------------------
-- Server version	10.3.16-MariaDB

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categoria` varchar(45) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'bebidas'),(2,'paletas'),(3,'postres'),(4,'dulces');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pago`
--

DROP TABLE IF EXISTS `forma_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pago` (
  `idforma_pago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`idforma_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pago`
--

LOCK TABLES `forma_pago` WRITE;
/*!40000 ALTER TABLE `forma_pago` DISABLE KEYS */;
INSERT INTO `forma_pago` VALUES (1,'TARJ/DEBITO',1),(2,'CHEQUE',1),(3,'CREDITO',1),(4,'EFECTIVO',1),(5,'TARJ/CREDITO',1);
/*!40000 ALTER TABLE `forma_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nom_producto` varchar(45) NOT NULL,
  `cat_producto` int(11) NOT NULL,
  `precio_producto` double NOT NULL,
  `cant_producto` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`idproducto`),
  KEY `fk_producto_categoria_idx` (`cat_producto`),
  CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`cat_producto`) REFERENCES `categoria` (`idcategoria`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'paleta azul',2,1.5,7,1),(2,'paleta roja',2,1.5,9,1),(3,'coca cola',1,0.6,8,1),(4,'pastel',3,2.5,10,1),(5,'chocobola',4,0.1,10,1),(6,'pepsi cola',1,0.5,9,1);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reporte`
--

DROP TABLE IF EXISTS `reporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reporte` (
  `idreporte` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_reporte` int(11) NOT NULL,
  `exento` double NOT NULL,
  `gravado` double NOT NULL,
  `nogravado` double NOT NULL,
  `venta_neta` double NOT NULL,
  `venta_bruta` double NOT NULL,
  `fecha_reporte` datetime NOT NULL,
  PRIMARY KEY (`idreporte`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reporte`
--

LOCK TABLES `reporte` WRITE;
/*!40000 ALTER TABLE `reporte` DISABLE KEYS */;
INSERT INTO `reporte` VALUES (1,1,0,2.5,0,2.5,2.5,'2019-07-26 20:00:00'),(2,2,0,7.5,0,7.5,7.5,'2019-07-26 20:30:00');
/*!40000 ALTER TABLE `reporte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `idticket` int(11) NOT NULL AUTO_INCREMENT,
  `estado` int(1) NOT NULL,
  `fecha` datetime NOT NULL,
  `numero_ticket` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  PRIMARY KEY (`idticket`),
  KEY `fk_ticket_venta_idx` (`id_venta`),
  CONSTRAINT `fk_ticket_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`idventa`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (1,1,'2019-07-24 13:59:59',123456,1),(2,1,'2019-07-25 11:59:59',123457,2);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `id_formapago` int(11) NOT NULL,
  `total` double NOT NULL,
  `subtotal` double NOT NULL,
  PRIMARY KEY (`idventa`),
  KEY `fk_venta_formapago_idx` (`id_formapago`),
  CONSTRAINT `fk_venta_formapago` FOREIGN KEY (`id_formapago`) REFERENCES `forma_pago` (`idforma_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (1,4,2.5,2.5),(2,4,5,5);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_producto`
--

DROP TABLE IF EXISTS `venta_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_producto` (
  `idventa_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  PRIMARY KEY (`idventa_producto`),
  KEY `fk_venta_producto_venta_idx` (`id_venta`),
  KEY `fk_venta_producto_producto_idx` (`id_producto`),
  CONSTRAINT `fk_venta_producto_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`idproducto`) ON UPDATE CASCADE,
  CONSTRAINT `fk_venta_producto_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_producto`
--

LOCK TABLES `venta_producto` WRITE;
/*!40000 ALTER TABLE `venta_producto` DISABLE KEYS */;
INSERT INTO `venta_producto` VALUES (1,1,2),(2,1,3),(3,1,3),(4,2,1),(5,2,1),(6,2,1),(7,2,6);
/*!40000 ALTER TABLE `venta_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta_reporte`
--

DROP TABLE IF EXISTS `venta_reporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta_reporte` (
  `idventa_reporte` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `id_reporte` int(11) NOT NULL,
  PRIMARY KEY (`idventa_reporte`),
  KEY `fk_venta_reporte_venta_idx` (`id_venta`),
  KEY `fk_venta_reporte_reporte_idx` (`id_reporte`),
  CONSTRAINT `fk_venta_reporte_reporte` FOREIGN KEY (`id_reporte`) REFERENCES `reporte` (`idreporte`) ON UPDATE CASCADE,
  CONSTRAINT `fk_venta_reporte_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta_reporte`
--

LOCK TABLES `venta_reporte` WRITE;
/*!40000 ALTER TABLE `venta_reporte` DISABLE KEYS */;
INSERT INTO `venta_reporte` VALUES (1,1,1),(2,1,2),(3,2,2);
/*!40000 ALTER TABLE `venta_reporte` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-25 13:44:55
