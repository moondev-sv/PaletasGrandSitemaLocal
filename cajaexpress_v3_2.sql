-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2019 a las 21:25:30
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cajaexpress_v3`
--
CREATE DATABASE IF NOT EXISTS `cajaexpress_v3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cajaexpress_v3`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categoria` varchar(45) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nom_categoria`, `estado`) VALUES
(1, 'Gase', 1),
(2, 'Paletas', 1),
(4, 'Dulces', 0),
(6, 'Frutas', 1),
(9, 'Soy otra categorias', 0),
(10, 'SOY UNA NUEVA CAT', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

CREATE TABLE IF NOT EXISTS `forma_pago` (
  `idforma_pago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`idforma_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `forma_pago`
--

INSERT INTO `forma_pago` (`idforma_pago`, `descripcion`, `estado`) VALUES
(1, 'TARJ/DEBITO', 1),
(2, 'CHEQUE', 1),
(3, 'CREDITO', 1),
(4, 'EFECTIVO', 1),
(5, 'TARJ/CREDITO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nom_producto` varchar(45) NOT NULL,
  `cat_producto` int(11) NOT NULL,
  `precio_producto` double NOT NULL,
  `cant_producto` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  PRIMARY KEY (`idproducto`),
  KEY `fk_producto_categoria_idx` (`cat_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `nom_producto`, `cat_producto`, `precio_producto`, `cant_producto`, `estado`) VALUES
(1, 'paleta azul', 2, 1.5, 7, 1),
(2, 'paleta roja', 2, 1.5, 9, 1),
(3, 'coca cola', 1, 0.6, 8, 1),
(5, 'chocobola', 4, 0.1, 10, 1),
(6, 'pepsi cola', 1, 0.5, 9, 1),
(7, 'asasa', 2, 0, 2, 1),
(8, 'asasssssssssa', 2, 12.2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE IF NOT EXISTS `reporte` (
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

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`idreporte`, `tipo_reporte`, `exento`, `gravado`, `nogravado`, `venta_neta`, `venta_bruta`, `fecha_reporte`) VALUES
(1, 1, 0, 2.5, 0, 2.5, 2.5, '2019-07-26 20:00:00'),
(2, 2, 0, 7.5, 0, 7.5, 7.5, '2019-07-26 20:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `idticket` int(11) NOT NULL AUTO_INCREMENT,
  `estado` int(1) NOT NULL,
  `fecha` datetime NOT NULL,
  `numero_ticket` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  PRIMARY KEY (`idticket`),
  KEY `fk_ticket_venta_idx` (`id_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`idticket`, `estado`, `fecha`, `numero_ticket`, `id_venta`) VALUES
(1, 1, '2019-07-24 13:59:59', 123456, 1),
(2, 1, '2019-07-25 11:59:59', 123457, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `id_formapago` int(11) NOT NULL,
  `total` double NOT NULL,
  `subtotal` double NOT NULL,
  PRIMARY KEY (`idventa`),
  KEY `fk_venta_formapago_idx` (`id_formapago`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `id_formapago`, `total`, `subtotal`) VALUES
(1, 4, 2.5, 2.5),
(2, 4, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE IF NOT EXISTS `venta_producto` (
  `idventa_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cant_x_producto` int(11) NOT NULL,
  PRIMARY KEY (`idventa_producto`),
  KEY `fk_venta_producto_venta_idx` (`id_venta`),
  KEY `fk_venta_producto_producto_idx` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_producto`
--

INSERT INTO `venta_producto` (`idventa_producto`, `id_venta`, `id_producto`, `cant_x_producto`) VALUES
(1, 1, 2, 2),
(2, 1, 3, 0),
(3, 1, 3, 0),
(4, 2, 1, 0),
(5, 2, 1, 0),
(6, 2, 1, 0),
(7, 2, 6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_reporte`
--

CREATE TABLE IF NOT EXISTS `venta_reporte` (
  `idventa_reporte` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `id_reporte` int(11) NOT NULL,
  PRIMARY KEY (`idventa_reporte`),
  KEY `fk_venta_reporte_venta_idx` (`id_venta`),
  KEY `fk_venta_reporte_reporte_idx` (`id_reporte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_reporte`
--

INSERT INTO `venta_reporte` (`idventa_reporte`, `id_venta`, `id_reporte`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`cat_producto`) REFERENCES `categoria` (`idcategoria`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_ticket_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`idventa`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_formapago` FOREIGN KEY (`id_formapago`) REFERENCES `forma_pago` (`idforma_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD CONSTRAINT `fk_venta_producto_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`idproducto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_venta_producto_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta_reporte`
--
ALTER TABLE `venta_reporte`
  ADD CONSTRAINT `fk_venta_reporte_reporte` FOREIGN KEY (`id_reporte`) REFERENCES `reporte` (`idreporte`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_venta_reporte_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
