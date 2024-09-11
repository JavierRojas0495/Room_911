-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-09-2024 a las 04:12:52
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
-- Base de datos: `room_911`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `city`
--

CREATE TABLE `city` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `city`
--

INSERT INTO `city` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Buenos Aires', 1, NULL, NULL),
(2, 'Córdoba', 1, NULL, NULL),
(3, 'Rosario', 1, NULL, NULL),
(4, 'Mendoza', 1, NULL, NULL),
(5, 'La Plata', 1, NULL, NULL),
(6, 'Salta', 1, NULL, NULL),
(7, 'Santa Fe', 1, NULL, NULL),
(8, 'Mar del Plata', 1, NULL, NULL),
(9, 'San Juan', 1, NULL, NULL),
(10, 'Neuquén', 1, NULL, NULL),
(11, 'Tucumán', 1, NULL, NULL),
(12, 'San Miguel de Tucumán', 1, NULL, NULL),
(13, 'Bahía Blanca', 1, NULL, NULL),
(14, 'La Rioja', 1, NULL, NULL),
(15, 'Corrientes', 1, NULL, NULL),
(16, 'Posadas', 1, NULL, NULL),
(17, 'Jujuy', 1, NULL, NULL),
(18, 'Formosa', 1, NULL, NULL),
(19, 'San Luis', 1, NULL, NULL),
(20, 'Rawson', 1, NULL, NULL),
(21, 'Río de Janeiro', 2, NULL, NULL),
(22, 'São Paulo', 2, NULL, NULL),
(23, 'Brasilia', 2, NULL, NULL),
(24, 'Salvador', 2, NULL, NULL),
(25, 'Fortaleza', 2, NULL, NULL),
(26, 'Belo Horizonte', 2, NULL, NULL),
(27, 'Manaos', 2, NULL, NULL),
(28, 'Curitiba', 2, NULL, NULL),
(29, 'Recife', 2, NULL, NULL),
(30, 'Porto Alegre', 2, NULL, NULL),
(31, 'Belém', 2, NULL, NULL),
(32, 'Goiânia', 2, NULL, NULL),
(33, 'Campinas', 2, NULL, NULL),
(34, 'São Luís', 2, NULL, NULL),
(35, 'Guarulhos', 2, NULL, NULL),
(36, 'São Gonçalo', 2, NULL, NULL),
(37, 'Maceió', 2, NULL, NULL),
(38, 'Campo Grande', 2, NULL, NULL),
(39, 'Natal', 2, NULL, NULL),
(40, 'Teresina', 2, NULL, NULL),
(41, 'Bogotá', 3, NULL, NULL),
(42, 'Medellín', 3, NULL, NULL),
(43, 'Cali', 3, NULL, NULL),
(44, 'Barranquilla', 3, NULL, NULL),
(45, 'Cartagena', 3, NULL, NULL),
(46, 'Cúcuta', 3, NULL, NULL),
(47, 'Soledad', 3, NULL, NULL),
(48, 'Ibagué', 3, NULL, NULL),
(49, 'Bucaramanga', 3, NULL, NULL),
(50, 'Santa Marta', 3, NULL, NULL),
(51, 'Villavicencio', 3, NULL, NULL),
(52, 'Pasto', 3, NULL, NULL),
(53, 'Manizales', 3, NULL, NULL),
(54, 'Neiva', 3, NULL, NULL),
(55, 'Pereira', 3, NULL, NULL),
(56, 'Montería', 3, NULL, NULL),
(57, 'Popayán', 3, NULL, NULL),
(58, 'Valledupar', 3, NULL, NULL),
(59, 'Quibdó', 3, NULL, NULL),
(60, 'Armenia', 3, NULL, NULL),
(61, 'Ciudad de México', 4, NULL, NULL),
(62, 'Guadalajara', 4, NULL, NULL),
(63, 'Monterrey', 4, NULL, NULL),
(64, 'Puebla', 4, NULL, NULL),
(65, 'Tijuana', 4, NULL, NULL),
(66, 'León', 4, NULL, NULL),
(67, 'Juárez', 4, NULL, NULL),
(68, 'Zapopan', 4, NULL, NULL),
(69, 'Mérida', 4, NULL, NULL),
(70, 'Mexicali', 4, NULL, NULL),
(71, 'Acapulco', 4, NULL, NULL),
(72, 'Toluca', 4, NULL, NULL),
(73, 'Cancún', 4, NULL, NULL),
(74, 'Querétaro', 4, NULL, NULL),
(75, 'Morelia', 4, NULL, NULL),
(76, 'Culiacán', 4, NULL, NULL),
(77, 'Hermosillo', 4, NULL, NULL),
(78, 'Chihuahua', 4, NULL, NULL),
(79, 'Durango', 4, NULL, NULL),
(80, 'Saltillo', 4, NULL, NULL),
(81, 'Madrid', 5, NULL, NULL),
(82, 'Barcelona', 5, NULL, NULL),
(83, 'Valencia', 5, NULL, NULL),
(84, 'Sevilla', 5, NULL, NULL),
(85, 'Zaragoza', 5, NULL, NULL),
(86, 'Málaga', 5, NULL, NULL),
(87, 'Murcia', 5, NULL, NULL),
(88, 'Palma de Mallorca', 5, NULL, NULL),
(89, 'Las Palmas de Gran Canaria', 5, NULL, NULL),
(90, 'Bilbao', 5, NULL, NULL),
(91, 'Alicante', 5, NULL, NULL),
(92, 'Córdoba', 5, NULL, NULL),
(93, 'Valladolid', 5, NULL, NULL),
(94, 'Vigo', 5, NULL, NULL),
(95, 'Gijón', 5, NULL, NULL),
(96, 'Hospitalet de Llobregat', 5, NULL, NULL),
(97, 'Vitoria-Gasteiz', 5, NULL, NULL),
(98, 'Granada', 5, NULL, NULL),
(99, 'A Coruña', 5, NULL, NULL),
(100, 'Santa Cruz de Tenerife', 5, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_country_id_foreign` (`country_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `city`
--
ALTER TABLE `city`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
