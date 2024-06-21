-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2024 a las 06:08:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `safeacces`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_area`
--

CREATE TABLE `tbl_area` (
  `area_id` int(3) NOT NULL,
  `area_nombre` varchar(20) NOT NULL,
  `area_aforo` int(4) DEFAULT NULL,
  `area_aforo_max` int(4) NOT NULL,
  `area_tipo` varchar(20) NOT NULL,
  `area_ubicacion` int(5) NOT NULL,
  `area_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_area`
--

INSERT INTO `tbl_area` (`area_id`, `area_nombre`, `area_aforo`, `area_aforo_max`, `area_tipo`, `area_ubicacion`, `area_estado`) VALUES
(3, 'Ambiente 221', NULL, 10, 'Sistemas', 1, 1),
(4, 'Ambiente 302', NULL, 20, 'Sistemas', 1, 1),
(6, 'ADSO1', NULL, 20, 'Sistemas', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_area_ubicacion`
--

CREATE TABLE `tbl_area_ubicacion` (
  `ubicacion_id` int(5) NOT NULL,
  `ubicacion_torre` varchar(20) NOT NULL,
  `ubicacion_piso` varchar(15) DEFAULT NULL,
  `ubicacion_estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_area_ubicacion`
--

INSERT INTO `tbl_area_ubicacion` (`ubicacion_id`, `ubicacion_torre`, `ubicacion_piso`, `ubicacion_estado`) VALUES
(1, 'Torre 2', 'Piso 1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_creacion_acceso`
--

CREATE TABLE `tbl_creacion_acceso` (
  `acceso_id` int(5) NOT NULL,
  `acceso_hora` time NOT NULL,
  `acceso_fecha` date NOT NULL,
  `acceso_estado` tinyint(1) NOT NULL,
  `acceso_empleado` int(15) NOT NULL,
  `acceso_area` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_creacion_acceso`
--

INSERT INTO `tbl_creacion_acceso` (`acceso_id`, `acceso_hora`, `acceso_fecha`, `acceso_estado`, `acceso_empleado`, `acceso_area`) VALUES
(1, '10:41:18', '2024-06-11', 1, 1014976764, 3),
(2, '11:03:00', '2024-06-04', 1, 1014976764, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empleado`
--

CREATE TABLE `tbl_empleado` (
  `emp_documento` int(15) NOT NULL,
  `emp_nombre` varchar(35) NOT NULL,
  `emp_apellidos` varchar(35) NOT NULL,
  `emp_contrasena` varchar(15) NOT NULL,
  `emp_estado` tinyint(1) NOT NULL,
  `emp_cargo` int(2) NOT NULL,
  `emp_depertamento` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_empleado`
--

INSERT INTO `tbl_empleado` (`emp_documento`, `emp_nombre`, `emp_apellidos`, `emp_contrasena`, `emp_estado`, `emp_cargo`, `emp_depertamento`) VALUES
(12120909, 'Gillian Denise', 'Bravo', '1111', 1, 1, 0),
(39544990, 'Myriam', 'Quiroga', '4321', 1, 2, 1),
(54545454, 'Pepe Enrique', 'Bravo Medina', '1221', 1, 1, 0),
(1014976764, 'Juan Manuel', 'Infante Quiroga', '1234', 1, 1, 1212);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_eventos`
--

CREATE TABLE `t_eventos` (
  `id_evento` int(11) NOT NULL,
  `evento` varchar(255) NOT NULL,
  `hora_inicio` datetime NOT NULL,
  `hora_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `t_eventos`
--

INSERT INTO `t_eventos` (`id_evento`, `evento`, `hora_inicio`, `hora_fin`) VALUES
(1, 'CAmbio de seladores', '2024-06-21 04:27:28', '2024-06-21 04:27:28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`area_id`),
  ADD KEY `area_ubicacion` (`area_ubicacion`);

--
-- Indices de la tabla `tbl_area_ubicacion`
--
ALTER TABLE `tbl_area_ubicacion`
  ADD PRIMARY KEY (`ubicacion_id`);

--
-- Indices de la tabla `tbl_creacion_acceso`
--
ALTER TABLE `tbl_creacion_acceso`
  ADD PRIMARY KEY (`acceso_id`),
  ADD KEY `acceso_empleado` (`acceso_empleado`),
  ADD KEY `acceso_area` (`acceso_area`);

--
-- Indices de la tabla `tbl_empleado`
--
ALTER TABLE `tbl_empleado`
  ADD PRIMARY KEY (`emp_documento`);

--
-- Indices de la tabla `t_eventos`
--
ALTER TABLE `t_eventos`
  ADD PRIMARY KEY (`id_evento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `area_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_area_ubicacion`
--
ALTER TABLE `tbl_area_ubicacion`
  MODIFY `ubicacion_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_creacion_acceso`
--
ALTER TABLE `tbl_creacion_acceso`
  MODIFY `acceso_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `t_eventos`
--
ALTER TABLE `t_eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD CONSTRAINT `tbl_area_ibfk_1` FOREIGN KEY (`area_ubicacion`) REFERENCES `tbl_area_ubicacion` (`ubicacion_id`);

--
-- Filtros para la tabla `tbl_creacion_acceso`
--
ALTER TABLE `tbl_creacion_acceso`
  ADD CONSTRAINT `tbl_creacion_acceso_ibfk_1` FOREIGN KEY (`acceso_empleado`) REFERENCES `tbl_empleado` (`emp_documento`),
  ADD CONSTRAINT `tbl_creacion_acceso_ibfk_2` FOREIGN KEY (`acceso_area`) REFERENCES `tbl_area` (`area_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
