-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-02-2020 a las 11:00:33
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seguridad_logro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `clients_id` int(11) NOT NULL,
  `date_ini` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `assignment`
--

INSERT INTO `assignment` (`id`, `created_at`, `updated_at`, `clients_id`, `date_ini`) VALUES
(3, '2020-02-27 07:49:26', '2020-02-27 07:49:26', 1, '2020-02-27'),
(4, '2020-02-27 08:02:49', '2020-02-27 08:02:49', 3, '2020-02-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assignment_as_watchmen`
--

CREATE TABLE `assignment_as_watchmen` (
  `id` int(11) NOT NULL,
  `watchmen_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `start` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `assignment_as_watchmen`
--

INSERT INTO `assignment_as_watchmen` (`id`, `watchmen_id`, `assignment_id`, `start`) VALUES
(7, 1, 3, 'D'),
(8, 2, 3, 'N'),
(9, 3, 3, 'X'),
(10, 4, 4, 'D'),
(11, 5, 4, 'N'),
(12, 7, 4, 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `salary` float NOT NULL,
  `num_services` int(11) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shifts_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `name`, `salary`, `num_services`, `is_active`, `created_at`, `updated_at`, `shifts_id`) VALUES
(1, 'Prueba Puesto 1', 1000, 1, 1, '2020-02-21 13:40:24', '2020-02-21 14:18:24', 1),
(2, 'Puesto 2', 2550, 2, 1, '2020-02-21 13:47:33', '2020-02-27 07:41:30', 2),
(3, 'Puesto 3', 0, 1, 1, '2020-02-27 07:41:49', '2020-02-27 07:41:49', 3),
(4, 'Puesto 4', 0, 1, 1, '2020-02-27 07:42:07', '2020-02-27 07:42:07', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shifts`
--

CREATE TABLE `shifts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `shifts`
--

INSERT INTO `shifts` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '2X2', 1, NULL, NULL),
(2, '4X2 Día', 1, NULL, NULL),
(3, '4X2 Noche', 1, NULL, NULL),
(4, '5X2', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(190) NOT NULL,
  `password` varchar(220) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email_verified` int(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `address` longtext,
  `is_active` int(1) NOT NULL DEFAULT '0',
  `is_admin` int(1) NOT NULL DEFAULT '0',
  `is_superadmin` int(1) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT 'user/avatar0.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` longtext,
  `type` int(1) DEFAULT NULL,
  `cellular` varchar(15) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `dni` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `password`, `phone`, `email_verified`, `email_verified_at`, `address`, `is_active`, `is_admin`, `is_superadmin`, `image`, `created_at`, `updated_at`, `remember_token`, `type`, `cellular`, `postal_code`, `dni`) VALUES
(1, 'SuperAdmin', 'root', 'admin@admin.com', '$2y$10$SpOti0isoifqjZJKoMfjDeTx81YmIZWooswGHCASXAO1dJJXJ2IwK', '3212713314', 1, NULL, '000000000', 1, 0, 1, 'user/avatar0.jpg', NULL, '2020-02-21 10:47:22', 'z7cvsvKf9zGTHwU62Ap0Rd1Btr7dSwbKLcBAk7rM5KbGRTwFc1gsVxMkefvN', 0, NULL, '0000', '0000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `watchmen`
--

CREATE TABLE `watchmen` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` longtext,
  `is_active` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `watchmen`
--

INSERT INTO `watchmen` (`id`, `name`, `dni`, `phone`, `email`, `address`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Vigilante pruena', '111111', '021452545454154', 'vigilante@email.com', NULL, 1, '2020-02-21 14:55:58', '2020-02-21 14:58:47'),
(2, 'Vigilante 2', '2222222', '0201210121', 'vigilante@email.com', NULL, 1, '2020-02-21 14:59:07', '2020-02-21 14:59:07'),
(3, 'Vigilante 3', '33333333', '3333333333333', NULL, NULL, 1, '2020-02-21 14:59:54', '2020-02-21 14:59:54'),
(4, 'Vigilante 4', '4444444444', '4444444444', NULL, NULL, 1, '2020-02-21 15:00:10', '2020-02-21 15:00:10'),
(5, 'Vigilante 5', '5555555555', '555555555', 'vigilante@email.com', NULL, 1, '2020-02-21 15:00:26', '2020-02-21 15:00:26'),
(7, 'Vigilante 6', '666666666', '6666666666', 'vigilante@email.com', NULL, 1, '2020-02-21 15:01:43', '2020-02-21 15:01:43');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`,`clients_id`),
  ADD KEY `fk_assignment_clients1_idx` (`clients_id`);

--
-- Indices de la tabla `assignment_as_watchmen`
--
ALTER TABLE `assignment_as_watchmen`
  ADD PRIMARY KEY (`id`,`watchmen_id`,`assignment_id`),
  ADD KEY `fk_assignment_as_watchmen_watchmen1_idx` (`watchmen_id`),
  ADD KEY `fk_assignment_as_watchmen_assignment1_idx` (`assignment_id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`,`shifts_id`),
  ADD KEY `fk_clients_shifts_idx` (`shifts_id`);

--
-- Indices de la tabla `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`);

--
-- Indices de la tabla `watchmen`
--
ALTER TABLE `watchmen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `assignment_as_watchmen`
--
ALTER TABLE `assignment_as_watchmen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `watchmen`
--
ALTER TABLE `watchmen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `fk_assignment_clients1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `assignment_as_watchmen`
--
ALTER TABLE `assignment_as_watchmen`
  ADD CONSTRAINT `fk_assignment_as_watchmen_assignment1` FOREIGN KEY (`assignment_id`) REFERENCES `assignment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assignment_as_watchmen_watchmen1` FOREIGN KEY (`watchmen_id`) REFERENCES `watchmen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `fk_clients_shifts` FOREIGN KEY (`shifts_id`) REFERENCES `shifts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
