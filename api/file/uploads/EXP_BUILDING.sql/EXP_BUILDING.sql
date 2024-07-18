-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-07-2024 a las 20:48:56
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `MORELLI`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EXP_BUILDING`
--

CREATE TABLE `EXP_BUILDING` (
  `id` int(11) NOT NULL,
  `fk_exp_admin` int(11) NOT NULL,
  `short_name` text NOT NULL,
  `fk_exp_tip_pro` int(11) NOT NULL,
  `address` text NOT NULL,
  `number` int(11) NOT NULL,
  `cp` int(11) NOT NULL,
  `fk_sp_provincias` int(11) NOT NULL,
  `fk_sp_partidos` int(11) NOT NULL,
  `fk_sp_localidades` int(11) NOT NULL,
  `building_user` text NOT NULL,
  `building_pass` text NOT NULL,
  `num_floors` int(11) NOT NULL,
  `num_dep_start` int(11) NOT NULL,
  `num_dep_end` int(11) NOT NULL,
  `last_modify` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `EXP_BUILDING`
--

INSERT INTO `EXP_BUILDING` (`id`, `fk_exp_admin`, `short_name`, `fk_exp_tip_pro`, `address`, `number`, `cp`, `fk_sp_provincias`, `fk_sp_partidos`, `fk_sp_localidades`, `building_user`, `building_pass`, `num_floors`, `num_dep_start`, `num_dep_end`, `last_modify`) VALUES
(1, 1, '', 0, 'Primera Junta', 3077, 0, 0, 0, 0, 'junta3077', 'morelli123', 7, 1, 40, '2024-07-01 02:26:53');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `EXP_BUILDING`
--
ALTER TABLE `EXP_BUILDING`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `EXP_BUILDING`
--
ALTER TABLE `EXP_BUILDING`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
