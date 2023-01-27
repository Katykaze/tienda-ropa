-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2023 a las 09:38:55
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_ropa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `ID_ALMACEN` int(11) NOT NULL,
  `LOCALIDAD` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`ID_ALMACEN`, `LOCALIDAD`) VALUES
(1, 'Madrid');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacena`
--

CREATE TABLE `almacena` (
  `ID_ALMACEN` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `CANTIDAD` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `almacena`
--

INSERT INTO `almacena` (`ID_ALMACEN`, `ID_PRODUCTO`, `CANTIDAD`) VALUES
(1, 1, 50),
(1, 2, 50),
(1, 3, 50),
(1, 4, 50),
(1, 5, 50),
(1, 6, 50),
(1, 7, 50),
(1, 8, 50),
(1, 9, 50),
(1, 10, 50),
(1, 11, 50),
(1, 12, 50),
(1, 13, 50),
(1, 14, 50),
(1, 15, 50),
(1, 16, 50),
(1, 17, 50),
(1, 18, 50),
(1, 19, 50),
(1, 20, 50),
(1, 21, 50),
(1, 22, 50),
(1, 23, 50),
(1, 24, 50),
(1, 25, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID_CATEGORIA` int(11) NOT NULL,
  `NOMBRE` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID_CATEGORIA`, `NOMBRE`) VALUES
(1, 'sudadera'),
(2, 'camiseta'),
(3, 'complemento'),
(4, 'ropa deporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID_CLIENTE` int(11) NOT NULL,
  `NOMBRE` varchar(40) DEFAULT NULL,
  `APELLIDO` varchar(40) DEFAULT NULL,
  `EMAIL` varchar(40) DEFAULT NULL,
  `DIRECCION` varchar(40) DEFAULT NULL,
  `CONTRASENA` varchar(6) DEFAULT NULL,
  `TELEFONO` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `ID_COMPRA` int(11) NOT NULL,
  `ID_CLIENTE` int(11) NOT NULL,
  `ID_PRODUCTO` int(11) DEFAULT NULL,
  `FECHA_COMPRA` date NOT NULL,
  `UNIDADES` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encarga`
--

CREATE TABLE `encarga` (
  `ID_ENCARGA` int(11) NOT NULL,
  `ID_CLIENTE` int(11) NOT NULL,
  `ID_SERVICIO` int(11) DEFAULT NULL,
  `FECHA_COMPRA` date NOT NULL,
  `UNIDADES` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_PRODUCTO` int(11) NOT NULL,
  `NOMBRE` varchar(40) DEFAULT NULL,
  `SERVICIO` enum('SERIGRAFIA','BORDADO','AMBAS','NINGUNO') DEFAULT NULL,
  `PRECIO_BASE` double DEFAULT NULL,
  `ID_CATEGORIA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_PRODUCTO`, `NOMBRE`, `SERVICIO`, `PRECIO_BASE`, `ID_CATEGORIA`) VALUES
(1, 'sudadera capucha hombre', 'NINGUNO', 19.5, 1),
(2, 'sudadera capucha hombre', 'SERIGRAFIA', 22, 1),
(3, 'sudadera capucha hombre', 'BORDADO', 20.5, 1),
(4, 'sudadera capucha hombre', 'AMBAS', 23, 1),
(5, 'sudadera capucha mujer', 'NINGUNO', 19.5, 1),
(6, 'sudadera capucha mujer', 'SERIGRAFIA', 22, 1),
(7, 'sudadera capucha mujer', 'BORDADO', 20.5, 1),
(8, 'sudadera capucha mujer', 'AMBAS', 23, 1),
(9, 'sudadera hombre', 'NINGUNO', 17.5, 1),
(10, 'sudadera hombre', 'SERIGRAFIA', 20, 1),
(11, 'sudadera hombre', 'BORDADO', 18.5, 1),
(12, 'sudadera hombre', 'AMBAS', 21, 1),
(13, 'sudadera mujer', 'NINGUNO', 17.5, 1),
(14, 'sudadera mujer', 'SERIGRAFIA', 20, 1),
(15, 'sudadera mujer', 'BORDADO', 18.5, 1),
(16, 'sudadera mujer', 'AMBAS', 21, 1),
(17, 'camiseta hombre', 'NINGUNO', 9, 2),
(18, 'camiseta hombre', 'SERIGRAFIA', 11.5, 2),
(19, 'camiseta hombre', 'BORDADO', 10, 2),
(20, 'camiseta hombre', 'AMBAS', 12, 2),
(21, 'camiseta mujer', 'NINGUNO', 9, 2),
(22, 'camiseta mujer', 'SERIGRAFIA', 11.5, 2),
(23, 'camiseta mujer', 'BORDADO', 10, 2),
(24, 'camiseta mujer', 'AMBAS', 12, 2),
(25, 'camiseta niño', 'NINGUNO', 7, 2),
(26, 'camiseta niño', 'SERIGRAFIA', 9.5, 2),
(27, 'camiseta niño', 'BORDADO', 8, 2),
(28, 'camiseta niño', 'AMBAS', 10, 2),
(29, 'gorra', 'NINGUNO', 10.5, 3),
(30, 'gorra', 'SERIGRAFIA', 13, 3),
(31, 'gorra', 'BORDADO', 12, 3),
(32, 'gorra', 'AMBAS', 15, 3),
(33, 'mochila', 'NINGUNO', 11, 3),
(34, 'mochila', 'SERIGRAFIA', 14, 3),
(35, 'mochila', 'BORDADO', 12, 3),
(36, 'mochila', 'AMBAS', 15, 3),
(37, 'gorro', 'NINGUNO', 12, 3),
(38, 'gorro', 'SERIGRAFIA', 14.5, 3),
(39, 'gorro', 'BORDADO', 13, 3),
(40, 'gorro', 'AMBAS', 16, 3),
(41, 'equipo futbol', 'NINGUNO', 21, 4),
(42, 'equipo futbol', 'SERIGRAFIA', 25, 4),
(43, 'equipo futbol', 'BORDADO', 22, 4),
(44, 'equipo futbol', 'AMBAS', 26, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `ID_SERVICIO` int(11) NOT NULL,
  `NOMBRE` varchar(40) DEFAULT NULL,
  `PRECIO` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`ID_SERVICIO`, `NOMBRE`, `PRECIO`) VALUES
(1, 'SERIGRAFIA', 10),
(2, 'BORDADO', 10),
(3, 'AMBAS', 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`ID_ALMACEN`);

--
-- Indices de la tabla `almacena`
--
ALTER TABLE `almacena`
  ADD PRIMARY KEY (`ID_ALMACEN`,`ID_PRODUCTO`),
  ADD KEY `FK_ALM_PRO` (`ID_PRODUCTO`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_CLIENTE`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`ID_COMPRA`,`ID_CLIENTE`,`FECHA_COMPRA`),
  ADD KEY `FK_COM_CLI` (`ID_CLIENTE`),
  ADD KEY `FK_COM_PRO` (`ID_PRODUCTO`);

--
-- Indices de la tabla `encarga`
--
ALTER TABLE `encarga`
  ADD PRIMARY KEY (`ID_ENCARGA`,`ID_CLIENTE`,`FECHA_COMPRA`),
  ADD KEY `FK_ALM_CLI` (`ID_CLIENTE`),
  ADD KEY `FK_ALM_SERV` (`ID_SERVICIO`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_PRODUCTO`),
  ADD KEY `FK_PROD_CAT` (`ID_CATEGORIA`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`ID_SERVICIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `ID_ALMACEN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_CATEGORIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_CLIENTE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `ID_COMPRA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encarga`
--
ALTER TABLE `encarga`
  MODIFY `ID_ENCARGA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `ID_SERVICIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacena`
--
ALTER TABLE `almacena`
  ADD CONSTRAINT `FK_ALM_ALM` FOREIGN KEY (`ID_ALMACEN`) REFERENCES `almacen` (`ID_ALMACEN`),
  ADD CONSTRAINT `FK_ALM_PRO` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `producto` (`ID_PRODUCTO`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `FK_COM_CLI` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `cliente` (`ID_CLIENTE`),
  ADD CONSTRAINT `FK_COM_PRO` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `producto` (`ID_PRODUCTO`);

--
-- Filtros para la tabla `encarga`
--
ALTER TABLE `encarga`
  ADD CONSTRAINT `FK_ALM_CLI` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `cliente` (`ID_CLIENTE`),
  ADD CONSTRAINT `FK_ALM_SERV` FOREIGN KEY (`ID_SERVICIO`) REFERENCES `servicios` (`ID_SERVICIO`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_PROD_CAT` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `categoria` (`ID_CATEGORIA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
