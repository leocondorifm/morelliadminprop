-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-07-2024 a las 14:28:23
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `expensas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EXP_ADMIN`
--

CREATE TABLE `EXP_ADMIN` (
  `id` int(11) NOT NULL,
  `fk_exp_owner_admin` int(11) NOT NULL,
  `company` text NOT NULL,
  `email` text NOT NULL,
  `validado` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `tel` int(11) NOT NULL,
  `admin_user` text NOT NULL,
  `admin_pass` text NOT NULL,
  `last_modify` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `EXP_ADMIN`
--

INSERT INTO `EXP_ADMIN` (`id`, `fk_exp_owner_admin`, `company`, `email`, `validado`, `fullname`, `tel`, `admin_user`, `admin_pass`, `last_modify`) VALUES
(1, 1, 'morelliadminprop.com.ar', 'dmorelli@gmail.com', 1, 'Diego Morelli', 1132445555, 'morelli', 'Admin1234', '2024-07-01 02:23:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EXP_BUILDING`
--

CREATE TABLE `EXP_BUILDING` (
  `id` int(11) NOT NULL,
  `fk_exp_admin` int(11) NOT NULL,
  `address` text NOT NULL,
  `number` int(11) NOT NULL,
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

INSERT INTO `EXP_BUILDING` (`id`, `fk_exp_admin`, `address`, `number`, `building_user`, `building_pass`, `num_floors`, `num_dep_start`, `num_dep_end`, `last_modify`) VALUES
(1, 1, 'Primera Junta', 3077, 'junta3077', 'morelli123', 7, 1, 40, '2024-07-01 02:26:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EXP_FILES`
--

CREATE TABLE `EXP_FILES` (
  `id` int(11) NOT NULL,
  `fk_exp_building` int(11) NOT NULL,
  `patch_file` text NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `file_viewer` int(11) NOT NULL DEFAULT 0,
  `files_download` int(11) NOT NULL DEFAULT 0,
  `last_modify` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `EXP_FILES`
--

INSERT INTO `EXP_FILES` (`id`, `fk_exp_building`, `patch_file`, `month`, `year`, `file_viewer`, `files_download`, `last_modify`) VALUES
(1, 1, '/files/032024/expensas.pdf', 3, 2024, 0, 0, '2024-07-01 03:10:46'),
(2, 1, '/files/032024/expensas_gastos.pdf', 3, 2024, 0, 0, '2024-07-01 03:10:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EXP_IMG_PROPERTY`
--

CREATE TABLE `EXP_IMG_PROPERTY` (
  `id` int(11) NOT NULL,
  `fk_exp_property` int(11) NOT NULL,
  `patch` text NOT NULL,
  `disabled` int(11) NOT NULL DEFAULT 0,
  `last_modify` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `EXP_IMG_PROPERTY`
--

INSERT INTO `EXP_IMG_PROPERTY` (`id`, `fk_exp_property`, `patch`, `disabled`, `last_modify`) VALUES
(1, 1, '/upload/property/1/foto_1.jpg', 0, '2024-07-01 03:33:38'),
(2, 1, '/upload/property/1/foto_2.jpg', 0, '2024-07-01 03:33:38'),
(3, 1, '/upload/property/1/foto_3.jpg', 0, '2024-07-01 03:33:38'),
(4, 1, '/upload/property/1/foto_4.jpg', 0, '2024-07-01 03:33:38'),
(5, 1, '/upload/property/1/foto_5.jpg', 0, '2024-07-01 03:33:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EXP_NEWSLETTER`
--

CREATE TABLE `EXP_NEWSLETTER` (
  `id` int(11) NOT NULL,
  `fk_exp_building` int(11) NOT NULL,
  `email` text NOT NULL,
  `email_send` int(11) NOT NULL DEFAULT 0,
  `email_viewer` int(11) NOT NULL DEFAULT 0,
  `last_modify` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `EXP_NEWSLETTER`
--

INSERT INTO `EXP_NEWSLETTER` (`id`, `fk_exp_building`, `email`, `email_send`, `email_viewer`, `last_modify`) VALUES
(1, 1, 'leo.condori@outlook.com', 0, 0, '2024-07-01 03:05:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EXP_OWNER_ADMIN`
--

CREATE TABLE `EXP_OWNER_ADMIN` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL,
  `fullname` text NOT NULL,
  `last_modify` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `EXP_OWNER_ADMIN`
--

INSERT INTO `EXP_OWNER_ADMIN` (`id`, `user`, `pass`, `email`, `fullname`, `last_modify`) VALUES
(1, 'leocondori', 'Genesis2024!', 'lcondori@gmail.com', 'Leo Condorí', '2024-07-01 02:12:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EXP_PAY`
--

CREATE TABLE `EXP_PAY` (
  `id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `fk_exp_building` int(11) NOT NULL,
  `pay_method` int(11) NOT NULL,
  `num_floor` text NOT NULL,
  `num_dep` text NOT NULL,
  `patch_file` text NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `last_modify` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `EXP_PAY`
--

INSERT INTO `EXP_PAY` (`id`, `month`, `year`, `fk_exp_building`, `pay_method`, `num_floor`, `num_dep`, `patch_file`, `verified`, `last_modify`) VALUES
(1, 3, 2024, 1, 0, 'PB', '1', '/upload/paying/032024-0_PB_1.pdf', 0, '2024-07-01 03:16:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EXP_PROPERTY`
--

CREATE TABLE `EXP_PROPERTY` (
  `id` int(11) NOT NULL,
  `fk_exp_admin` int(11) NOT NULL,
  `description` text NOT NULL,
  `long_description` text NOT NULL,
  `price` int(11) NOT NULL,
  `currency` int(11) NOT NULL,
  `count_bedrooms` int(11) NOT NULL,
  `count_bathrooms` int(11) NOT NULL,
  `square_meter` int(11) NOT NULL,
  `last_modify` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EXP_VIDEO_PROPERTY`
--

CREATE TABLE `EXP_VIDEO_PROPERTY` (
  `id` int(11) NOT NULL,
  `fk_exp_property` int(11) NOT NULL,
  `url` text NOT NULL,
  `disabled` int(11) NOT NULL DEFAULT 0,
  `last_modify` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `EXP_VIDEO_PROPERTY`
--

INSERT INTO `EXP_VIDEO_PROPERTY` (`id`, `fk_exp_property`, `url`, `disabled`, `last_modify`) VALUES
(1, 1, 'https://www.youtube.com/watch?v=4P5SSlgLlqw&ab_channel=CortesePropiedades', 0, '2024-07-01 03:51:17'),
(2, 1, 'https://www.youtube.com/watch?v=cfJ1uuv1YaA&ab_channel=BridgeArgentina', 0, '2024-07-01 03:52:11'),
(3, 1, 'https://www.youtube.com/watch?v=cfJ1uuv1YaA&ab_channel=BridgeArgentina', 0, '2024-07-01 03:52:11'),
(4, 1, 'https://www.youtube.com/watch?v=cfJ1uuv1YaA&ab_channel=BridgeArgentina', 0, '2024-07-01 03:52:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `EXP_ADMIN`
--
ALTER TABLE `EXP_ADMIN`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `EXP_BUILDING`
--
ALTER TABLE `EXP_BUILDING`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `EXP_FILES`
--
ALTER TABLE `EXP_FILES`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `EXP_IMG_PROPERTY`
--
ALTER TABLE `EXP_IMG_PROPERTY`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `EXP_NEWSLETTER`
--
ALTER TABLE `EXP_NEWSLETTER`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `EXP_OWNER_ADMIN`
--
ALTER TABLE `EXP_OWNER_ADMIN`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `EXP_PAY`
--
ALTER TABLE `EXP_PAY`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `EXP_PROPERTY`
--
ALTER TABLE `EXP_PROPERTY`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `EXP_VIDEO_PROPERTY`
--
ALTER TABLE `EXP_VIDEO_PROPERTY`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `EXP_ADMIN`
--
ALTER TABLE `EXP_ADMIN`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `EXP_BUILDING`
--
ALTER TABLE `EXP_BUILDING`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `EXP_FILES`
--
ALTER TABLE `EXP_FILES`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `EXP_IMG_PROPERTY`
--
ALTER TABLE `EXP_IMG_PROPERTY`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `EXP_NEWSLETTER`
--
ALTER TABLE `EXP_NEWSLETTER`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `EXP_OWNER_ADMIN`
--
ALTER TABLE `EXP_OWNER_ADMIN`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `EXP_PAY`
--
ALTER TABLE `EXP_PAY`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `EXP_PROPERTY`
--
ALTER TABLE `EXP_PROPERTY`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `EXP_VIDEO_PROPERTY`
--
ALTER TABLE `EXP_VIDEO_PROPERTY`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
