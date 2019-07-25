-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-07-2019 a las 05:06:27
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
-- Base de datos: `cajaexpress_v2`
--
CREATE DATABASE IF NOT EXISTS `cajaexpress_v2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cajaexpress_v2`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categoria` varchar(24) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nom_categoria`) VALUES
(1, 'Frutas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formapago`
--

CREATE TABLE IF NOT EXISTS `formapago` (
  `id_formapago` int(11) NOT NULL AUTO_INCREMENT,
  `tpo_formapago` varchar(64) NOT NULL,
  PRIMARY KEY (`id_formapago`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `formapago`
--

INSERT INTO `formapago` (`id_formapago`, `tpo_formapago`) VALUES
(1, 'Credomatic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `nom_producto` varchar(64) NOT NULL,
  `des_producto` varchar(255) NOT NULL,
  `pre_producto` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `id_categoria`, `nom_producto`, `des_producto`, `pre_producto`) VALUES
(2, 1, 'Aguacate', 'Un Aguacate', '2.10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produ_x_ticket`
--

CREATE TABLE IF NOT EXISTS `produ_x_ticket` (
  `id_produ_x_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `cant_producto` int(11) NOT NULL,
  PRIMARY KEY (`id_produ_x_ticket`),
  KEY `id_producto` (`id_producto`),
  KEY `id_ticket` (`id_ticket`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `produ_x_ticket`
--

INSERT INTO `produ_x_ticket` (`id_produ_x_ticket`, `id_producto`, `id_ticket`, `cant_producto`) VALUES
(1, 2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `id_formapago` int(11) NOT NULL,
  `fec_ticket` datetime NOT NULL,
  `imp_ticket` decimal(10,2) NOT NULL,
  `din_ticket` decimal(10,2) NOT NULL,
  `cam_ticket` decimal(10,2) NOT NULL,
  `tot_ticket` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_ticket`),
  KEY `id_formapago` (`id_formapago`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id_ticket`, `id_formapago`, `fec_ticket`, `imp_ticket`, `din_ticket`, `cam_ticket`, `tot_ticket`) VALUES
(1, 1, '2019-07-25 04:03:04', '52.10', '21.92', '0.14', '13.50');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `produ_x_ticket`
--
ALTER TABLE `produ_x_ticket`
  ADD CONSTRAINT `produ_x_ticket_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produ_x_ticket_ibfk_2` FOREIGN KEY (`id_ticket`) REFERENCES `ticket` (`id_ticket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`id_formapago`) REFERENCES `formapago` (`id_formapago`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
