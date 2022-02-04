-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2021 a las 00:33:05
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mis_estudios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `code` int(4) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_spanish_ci NOT NULL,
  `hour` int(2) UNSIGNED NOT NULL,
  `prof` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`code`, `name`, `hour`, `prof`) VALUES
(374, 'Administración de sistemas operativos', 6, 'Susana Oviedo Bocanegra'),
(375, 'Servicios de red e Internet', 6, 'Rafael Montero González'),
(376, 'Implantación de aplicaciones web.', 4, 'Raúl Gil Sarmiento'),
(377, 'Administración de sistemas gestores de BB.DD.', 3, 'Raúl Gil Sarmiento'),
(378, 'Seguridad y alta disponibilidad.', 4, 'Patricia Vegas Gómez'),
(380, 'Empresa e iniciativa emprendedora.', 4, 'MªCarmen Castaños Berlín');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instrumentos`
--

CREATE TABLE `instrumentos` (
  `clave` int(10) UNSIGNED NOT NULL,
  `unidad` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `peso` int(2) UNSIGNED NOT NULL,
  `calificacion` decimal(10,2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `instrumentos`
--

INSERT INTO `instrumentos` (`clave`, `unidad`, `nombre`, `peso`, `calificacion`) VALUES
(1, 1, 'Examen Teórico', 45, '8.50'),
(2, 1, 'Examen Práctico', 35, '6.30'),
(3, 1, 'Actividades de Aula', 20, NULL),
(4, 2, 'Examen', 70, '9.20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `clave` int(11) NOT NULL,
  `asignatura` int(4) NOT NULL,
  `numero` int(2) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `porcentaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`clave`, `asignatura`, `numero`, `nombre`, `porcentaje`) VALUES
(1, 374, 1, 'Administración de Servicio de Directorios', 15),
(2, 374, 2, 'Procesos del Sistema', 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`code`);

--
-- Indices de la tabla `instrumentos`
--
ALTER TABLE `instrumentos`
  ADD PRIMARY KEY (`clave`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`clave`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `instrumentos`
--
ALTER TABLE `instrumentos`
  MODIFY `clave` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
