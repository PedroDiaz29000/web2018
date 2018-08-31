-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-07-2018 a las 22:09:51
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `web2018`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE `acceso` (
  `usuario` char(10) DEFAULT NULL,
  `clave` char(50) DEFAULT NULL,
  `rol` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`usuario`, `clave`, `rol`) VALUES
('admin', '**2015**wasap', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contador`
--

CREATE TABLE `contador` (
  `idpk` int(11) NOT NULL,
  `noticia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contador`
--

INSERT INTO `contador` (`idpk`, `noticia`) VALUES
(1, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

CREATE TABLE `detalle` (
  `id` int(11) NOT NULL,
  `noticia` int(11) DEFAULT NULL,
  `rutafoto` longtext,
  `orden` varchar(200) DEFAULT NULL,
  `estado_foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle`
--

INSERT INTO `detalle` (`id`, `noticia`, `rutafoto`, `orden`, `estado_foto`) VALUES
(1, 1, 'subidas/8-2018.png', '2', '1'),
(2, 1, 'subidas/9-2018.png', '1', '1'),
(3, 2, 'subidas/10-2018.png', '2', '1'),
(4, 2, 'subidas/11-2018.png', '1', '1'),
(5, 2, 'subidas/12-2018.png', '2', '1'),
(6, 3, 'subidas/13-2018.png', '1', '1'),
(7, 3, 'subidas/14-2018.png', '2', '1'),
(8, 3, 'subidas/15-2018.png', '2', '1'),
(9, 4, 'subidas/16-2018.png', '1', '1'),
(10, 5, '', '1', '1'),
(11, 6, 'subidas/17-2018.jpg', '2', '1'),
(12, 6, 'subidas/18-2018.jpg', '1', '1'),
(13, 6, 'subidas/19-2018.jpg', '2', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `idpersona` char(10) DEFAULT NULL,
  `titulo` varchar(20) DEFAULT NULL,
  `detalle` longtext,
  `fecha` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `fecha_act` datetime DEFAULT NULL,
  `area` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `idpersona`, `titulo`, `detalle`, `fecha`, `estado`, `calificacion`, `categoria`, `fecha_act`, `area`) VALUES
(1, NULL, 'prueba 001', 'jajaj de  todos son tus datos \njajaja', '2018-07-04 02:58:13', 1, NULL, NULL, '2018-07-05 11:54:35', NULL),
(2, NULL, 'prueba  002', 'see  ', '2018-07-04 03:01:23', 1, NULL, NULL, NULL, NULL),
(3, NULL, 'prueba 003', 'dsgsdgsdgfgfgd', '2018-07-04 03:02:49', 1, NULL, NULL, '2018-07-05 01:21:24', NULL),
(4, NULL, 'probando InformaciÃ³', 'seee', '2018-07-04 03:17:46', 1, NULL, NULL, '2018-07-05 11:15:28', NULL),
(5, NULL, 'prueba 001', 'jajaj de  todos son tus datos \r\njajaja', '2018-07-05 10:18:13', 2, NULL, NULL, '2018-07-05 12:12:23', NULL),
(6, NULL, 'prueba10', 'prueba10 prueba10 prueba10prueba10', '2018-07-05 12:28:17', 1, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contador`
--
ALTER TABLE `contador`
  ADD PRIMARY KEY (`idpk`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contador`
--
ALTER TABLE `contador`
  MODIFY `idpk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
