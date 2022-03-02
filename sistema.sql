-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-03-2022 a las 20:17:28
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arriendo`
--

CREATE TABLE `arriendo` (
  `id_arriendo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `arriendo`
--

INSERT INTO `arriendo` (`id_arriendo`, `fecha`, `hora`, `id_usuario`, `estado`) VALUES
(1, '2022-03-01', 1, 1, 1),
(9, '2022-03-05', 1, 1, 1),
(10, '2022-03-05', 2, 1, 1),
(11, '2022-03-05', 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora_arriendo`
--

CREATE TABLE `hora_arriendo` (
  `id_hora` int(11) NOT NULL,
  `hora_desc` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `hora_arriendo`
--

INSERT INTO `hora_arriendo` (`id_hora`, `hora_desc`) VALUES
(1, '18:00'),
(2, '19:00'),
(3, '20:00'),
(4, '21:00'),
(5, '22:00'),
(6, '23:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `clave` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `correo`, `clave`) VALUES
(1, ' Tomas', 'tsalasarancibia@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Claudio Salas Arancibia', 'kako_salas@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arriendo`
--
ALTER TABLE `arriendo`
  ADD PRIMARY KEY (`id_arriendo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `hora` (`hora`);

--
-- Indices de la tabla `hora_arriendo`
--
ALTER TABLE `hora_arriendo`
  ADD PRIMARY KEY (`id_hora`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arriendo`
--
ALTER TABLE `arriendo`
  MODIFY `id_arriendo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `hora_arriendo`
--
ALTER TABLE `hora_arriendo`
  MODIFY `id_hora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `arriendo`
--
ALTER TABLE `arriendo`
  ADD CONSTRAINT `arriendo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `arriendo_ibfk_2` FOREIGN KEY (`hora`) REFERENCES `hora_arriendo` (`id_hora`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
