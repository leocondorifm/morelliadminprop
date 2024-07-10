-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 192.168.0.63
-- Tiempo de generación: 10-07-2024 a las 14:08:50
-- Versión del servidor: 5.7.33
-- Versión de PHP: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `boca_juniors`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sp_provincias`
--

CREATE TABLE `sp_provincias` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(2555) COLLATE utf8_unicode_ci NOT NULL,
  `fk_sp_paises` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sp_provincias`
--

INSERT INTO `sp_provincias` (`id`, `descripcion`, `fk_sp_paises`) VALUES
(0, 'Capital Federal', 54),
(1, 'Buenos Aires', 54),
(2, 'Catamarca', 54),
(3, 'Córdoba', 54),
(4, 'Corrientes', 54),
(5, 'Entre Ríos', 54),
(6, 'Jujuy', 54),
(7, 'Mendoza', 54),
(8, 'La Rioja', 54),
(9, 'Salta', 54),
(10, 'San Juan', 54),
(11, 'San Luis', 54),
(12, 'Santa Fe', 54),
(13, 'Santiago del Estero', 54),
(14, 'Tucumán', 54),
(16, 'Chaco', 54),
(17, 'Chubut', 54),
(18, 'Formosa', 54),
(19, 'Misiones', 54),
(20, 'Neuquén', 54),
(21, 'La Pampa', 54),
(22, 'Río Negro', 54),
(23, 'Santa Cruz', 54),
(24, 'Tierra del Fuego', 54);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sp_provincias`
--
ALTER TABLE `sp_provincias`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
