-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2025 a las 06:36:37
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
-- Base de datos: `estadia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `numero_factura` varchar(100) NOT NULL,
  `cliente` varchar(255) DEFAULT NULL,
  `fecha_factura` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros_envio`
--

CREATE TABLE `registros_envio` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) DEFAULT NULL,
  `cajas` int(11) DEFAULT NULL,
  `tarimas` int(11) DEFAULT NULL,
  `piezas` int(11) DEFAULT NULL,
  `paqueteria` varchar(100) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario` varchar(100) DEFAULT NULL,
  `tipo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registros_envio`
--

INSERT INTO `registros_envio` (`id`, `factura_id`, `cajas`, `tarimas`, `piezas`, `paqueteria`, `fecha_registro`, `usuario`, `tipo`) VALUES
(47, NULL, 2, 0, 2, 'Estafeta', '2025-08-07 06:30:27', 'Rodrigo', 1),
(48, NULL, 1, 0, 5, 'PaqueteExpress', '2025-08-07 06:45:45', 'Juan', 1),
(49, NULL, 0, 1, 10, 'PaqueteExpress', '2025-08-07 06:46:44', 'Michelle', 1),
(50, NULL, 5, 0, 10, 'Estafeta', '2025-08-07 06:53:09', 'Juan ', 3),
(51, NULL, 4, 2, 48, 'DHL', '2025-08-07 07:16:57', 'Rodrigo', 2),
(52, NULL, 5, 0, 4, 'es', '2025-08-08 20:23:24', 'Rodrigo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios3`
--

CREATE TABLE `usuarios3` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','usuario') NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios3`
--

INSERT INTO `usuarios3` (`id`, `nombre`, `password`, `rol`, `fecha_registro`) VALUES
(5, 'Carlos', '$2y$10$maggqPzDjJPmp0FlhuIIk.O3WsvBksIUR3adEbiuM35CjXzRKB0Rq', 'admin', '2025-08-07 04:30:11'),
(20, 'Rodrigo', '$2y$10$La1a72ifT9kmkbXez71yN.UtNfMcB3Xff8OH9wdiXVUTLo3nLpH6y', 'usuario', '2025-08-07 06:28:53'),
(21, 'Israel', '$2y$10$2UW9.yW9r4MY8eu2Q.LPAe.qW0Pd3omPM.lLINUz1MQeO0V.1mRni', 'admin', '2025-08-07 06:29:02'),
(22, 'Michelle', '$2y$10$vLZhxV4IVwKs3RyNv.cqx.XI5I6V0zqcsitBMr11FC3OUgUroNrLy', 'usuario', '2025-08-07 06:44:52'),
(23, 'Juan', '$2y$10$NCL5MLUqJYb.J0OhXXURS.DgvY4d3lIbhzDWRMsXrGyNdvIR5umQa', 'admin', '2025-08-07 06:45:04'),
(24, 'Pirru', '$2y$10$pmy5eBuLfEWMGl29yhHhbuReY/kMn9mnTHS0zafura/u/HNO6O9Nq', 'usuario', '2025-08-07 07:18:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_factura` (`numero_factura`);

--
-- Indices de la tabla `registros_envio`
--
ALTER TABLE `registros_envio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factura_id` (`factura_id`);

--
-- Indices de la tabla `usuarios3`
--
ALTER TABLE `usuarios3`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registros_envio`
--
ALTER TABLE `registros_envio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `usuarios3`
--
ALTER TABLE `usuarios3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `registros_envio`
--
ALTER TABLE `registros_envio`
  ADD CONSTRAINT `registros_envio_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
